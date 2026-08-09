<?php
session_start();

// Flash messages support: persist messages across POST->Redirect->GET
if (!empty($_SESSION['flash_messages']) && is_array($_SESSION['flash_messages'])) {
        $messages = $_SESSION['flash_messages'];
        unset($_SESSION['flash_messages']);
} else {
        $messages = [];
}

// If bg=started, we'll show a transient client-side banner and not render
// the 'Background check started' message server-side to ensure it auto-hides.
$showStartedBanner = false;
if (isset($_GET['bg']) && $_GET['bg'] === 'started') {
        $showStartedBanner = true;
}

// Deduplicate messages so the same message doesn't render multiple times
if (!empty($messages) && is_array($messages)) {
        $messages = array_values(array_unique($messages));
        // Remove any server-side 'Background check started' if present (handled client-side)
        foreach ($messages as $k => $v) {
                if ($v === 'Background check started' || $v === 'Background check started.') {
                        unset($messages[$k]);
                }
        }
        $messages = array_values($messages);
}

$uploadsDir = __DIR__ . '/../uploads';
if (!is_dir($uploadsDir)) {
        @mkdir($uploadsDir, 0755, true);
}

$uid = isset($_SESSION['user_id']) ? (int)$_SESSION['user_id'] : session_id();
$userDir = $uploadsDir . '/' . preg_replace('/[^a-z0-9_-]/i', '_', (string)$uid);
if (!is_dir($userDir)) {
        @mkdir($userDir, 0755, true);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Government ID upload
        if (!empty($_FILES['gov_id']) && $_FILES['gov_id']['error'] === UPLOAD_ERR_OK) {
                $tmp = $_FILES['gov_id']['tmp_name'];
                $name = basename($_FILES['gov_id']['name']);
                $safe = preg_replace('/[^a-z0-9._-]/i', '_', $name);
                $target = $userDir . '/govid_' . time() . '_' . $safe;
                if (move_uploaded_file($tmp, $target)) {
                        $_SESSION['artisan_uploads']['gov_id'] = $target;
                        $messages[] = 'Government ID uploaded.';
                } else {
                        $messages[] = 'Failed to save Government ID.';
                }
        }

        // Document upload
        if (!empty($_FILES['doc_file']) && $_FILES['doc_file']['error'] === UPLOAD_ERR_OK) {
                $tmp = $_FILES['doc_file']['tmp_name'];
                $name = basename($_FILES['doc_file']['name']);
                $safe = preg_replace('/[^a-z0-9._-]/i', '_', $name);
                $target = $userDir . '/doc_' . time() . '_' . $safe;
                if (move_uploaded_file($tmp, $target)) {
                        if (!isset($_SESSION['artisan_uploads']['docs']) || !is_array($_SESSION['artisan_uploads']['docs'])) {
                                $_SESSION['artisan_uploads']['docs'] = [];
                        }
                        $_SESSION['artisan_uploads']['docs'][] = $target;
                        $messages[] = 'Document uploaded.';
                } else {
                        $messages[] = 'Failed to save document.';
                }
        }

        // Background check trigger
        $shouldSetPending = false;
        $startTriggered = false;
        if (isset($_POST['start_check'])) {
                $_SESSION['artisan_verification']['background_check_started'] = true;
                // Force single user-visible message for this action
                $messages = ['Background check started'];
                $shouldSetPending = true;
                $startTriggered = true;
        }

        // If any upload occurred, mark for pending
        if (!empty($_SESSION['artisan_uploads']['gov_id']) || !empty($_SESSION['artisan_uploads']['docs'])) {
                $shouldSetPending = true;
        }

        // Persist pending status to DB if we have a logged-in user
        // NOTE: Admin review UI is not implemented in this pass. An admin page
        // (Verification Queue) exists as a static export only; approval/rejection
        // must be performed by an admin UI which will update
        // `artisan_profiles.background_check_status` to 'approved' or 'rejected'.
        $dbUpdated = false;
        if ($shouldSetPending) {
                if (!empty($_SESSION['user_id'])) {
                        try {
                                $dsn = getenv('DB_DSN') ?: 'mysql:host=127.0.0.1;dbname=handylink;charset=utf8mb4';
                                $dbUser = getenv('DB_USER') ?: 'root';
                                $dbPass = getenv('DB_PASS') ?: '';
                                $pdo = new PDO($dsn, $dbUser, $dbPass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

                                $uidInt = (int) $_SESSION['user_id'];
                                $check = $pdo->prepare('SELECT id FROM artisan_profiles WHERE user_id = :uid LIMIT 1');
                                $check->execute([':uid' => $uidInt]);
                                $found = $check->fetch(PDO::FETCH_ASSOC);
                                if ($found) {
                                        $update = $pdo->prepare('UPDATE artisan_profiles SET background_check_status = :status, updated_at = NOW() WHERE user_id = :uid');
                                        $update->execute([':status' => 'pending', ':uid' => $uidInt]);
                                } else {
                                        $insert = $pdo->prepare('INSERT INTO artisan_profiles (user_id, background_check_status, created_at, updated_at) VALUES (:uid, :status, NOW(), NOW())');
                                        $insert->execute([':uid' => $uidInt, ':status' => 'pending']);
                                }
                                // do not add extra user-visible messages here; keep single 'Background check started.'
                                $dbUpdated = true;
                        } catch (PDOException $ex) {
                                // If DB update fails, log to messages but continue so artisan UX isn't blocked
                                // don't expose DB errors to the UI for this flow
                                $dbUpdated = false;
                        }
                } else {
                        // Not logged in — still show the single 'Background check started.' message
                }
        }

        // Persist flash messages for display after redirect
        if (!empty($messages)) {
                $_SESSION['flash_messages'] = $messages;
        }

        // Build status query param so GET shows visible feedback even if sessions fail
        $statusParam = '';
        if ($shouldSetPending) {
                // Always show the short 'started' feedback client-side; server updates may be async
                $statusParam = 'bg=started';
        }

        $redirectTo = $_SERVER['REQUEST_URI'];
        if ($statusParam) {
                $redirectTo .= (strpos($redirectTo, '?') === false ? '?' : '&') . $statusParam;
        }

        // Redirect to avoid form resubmission
        header('Location: ' . $redirectTo);
        exit;
}

// Determine current background check status from DB when available
$backgroundStatus = 'not_started';
if (!empty($_SESSION['user_id'])) {
        try {
                $dsn = getenv('DB_DSN') ?: 'mysql:host=127.0.0.1;dbname=handylink;charset=utf8mb4';
                $dbUser = getenv('DB_USER') ?: 'root';
                $dbPass = getenv('DB_PASS') ?: '';
                $pdo = new PDO($dsn, $dbUser, $dbPass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
                $q = $pdo->prepare('SELECT background_check_status FROM artisan_profiles WHERE user_id = :uid LIMIT 1');
                $q->execute([':uid' => (int)$_SESSION['user_id']]);
                $r = $q->fetch(PDO::FETCH_ASSOC);
                if ($r && isset($r['background_check_status'])) {
                        $backgroundStatus = $r['background_check_status'];
                }
        } catch (PDOException $e) {
                // ignore — default to not_started
        }
}
?>

<!DOCTYPE html>

<html class="light" lang="en"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>HandyLink - Artisan Verification</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@400;500;600;700&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<script id="tailwind-config">
        tailwind.config = {
          darkMode: "class",
          theme: {
            extend: {
              "colors": {
                      "on-primary-container": "#87beb8",
                      "error-container": "#ffdad6",
                      "surface-container-low": "#eff4ff",
                      "on-tertiary-container": "#b1b4b6",
                      "primary-fixed-dim": "#9ad1cb",
                      "on-surface-variant": "#404847",
                      "surface": "#f8f9ff",
                      "surface-container-lowest": "#ffffff",
                      "secondary-fixed": "#ffddb8",
                      "secondary": "#855300",
                      "on-error": "#ffffff",
                      "tertiary": "#2c3032",
                      "surface-container-high": "#dce9ff",
                      "inverse-primary": "#9ad1cb",
                      "inverse-on-surface": "#eaf1ff",
                      "error": "#ba1a1a",
                      "surface-bright": "#f8f9ff",
                      "tertiary-container": "#434648",
                      "on-secondary-fixed": "#2a1700",
                      "secondary-container": "#fea619",
                      "surface-container-highest": "#d5e3fc",
                      "on-tertiary": "#ffffff",
                      "on-secondary": "#ffffff",
                      "primary": "#003633",
                      "on-primary-fixed-": "#00201e",
                      "surface-dim": "#ccdbf3",
                      "surface-tint": "#316763",
                      "on-surface": "#0d1c2e",
                      "outline-variant": "#bfc8c6",
                      "on-primary": "#ffffff",
                      "tertiary-fixed-dim": "#c4c7c9",
                      "background": "#f8f9ff",
                      "on-secondary-container": "#684000",
                      "surface-variant": "#d5e3fc",
                      "surface-container": "#e6eeff",
                      "on-tertiary-fixed": "#191c1e",
                      "on-primary-fixed-variant": "#144f4b",
                      "inverse-surface": "#233144",
                      "secondary-fixed-dim": "#ffb95f",
                      "on-secondary-fixed-variant": "#653e00",
                      "on-tertiary-fixed-variant": "#444749",
                      "on-background": "#0d1c2e",
                      "outline": "#707977",
                      "primary-fixed": "#b5ede7",
                      "tertiary-fixed": "#e0e3e5",
                      "primary-container": "#134e4a",
                      "on-error-container": "#93000a"
              },
              "borderRadius": {
                      "DEFAULT": "0.25rem",
                      "lg": "0.5rem",
                      "xl": "0.75rem",
                      "full": "9999px"
              },
              "spacing": {
                      "margin-desktop": "auto",
                      "xl": "64px",
                      "lg": "40px",
                      "base": "8px",
                      "gutter": "16px",
                      "margin-mobile": "20px",
                      "xs": "4px",
                      "max-width": "1200px",
                      "sm": "12px",
                      "md": "24px"
              },
              "fontFamily": {
                      "headline-md": [
                              "Public Sans"
                      ],
                      "body-lg": [
                              "Public Sans"
                      ],
                      "headline-lg-mobile": [
                              "Public Sans"
                      ],
                      "label-sm": [
                              "Public Sans"
                      ],
                      "display-lg": [
                              "Public Sans"
                      ],
                      "body-md": [
                              "Public Sans"
                      ],
                      "label-md": [
                              "Public Sans"
                      ],
                      "headline-lg": [
                              "Public Sans"
                      ]
              },
              "fontSize": {
                      "headline-md": [
                              "24px",
                              {
                                      "lineHeight": "32px",
                                      "fontWeight": "600"
                              }
                      ],
                      "body-lg": [
                              "18px",
                              {
                                      "lineHeight": "28px",
                                      "fontWeight": "400"
                              }
                      ],
                      "headline-lg-mobile": [
                              "28px",
                              {
                                      "lineHeight": "34px",
                                      "fontWeight": "600"
                              }
                      ],
                      "label-sm": [
                              "12px",
                              {
                                      "lineHeight": "16px",
                                      "fontWeight": "600"
                              }
                      ],
                      "display-lg": [
                              "48px",
                              {
                                      "lineHeight": "56px",
                                      "letterSpacing": "-0.02em",
                                      "fontWeight": "700"
                              }
                      ],
                      "body-md": [
                              "16px",
                              {
                                      "lineHeight": "24px",
                                      "fontWeight": "400"
                              }
                      ],
                      "label-md": [
                              "14px",
                              {
                                      "lineHeight": "20px",
                                      "letterSpacing": "0.01em",
                                      "fontWeight": "500"
                              }
                      ],
                      "headline-lg": [
                              "32px",
                              {
                                      "lineHeight": "40px",
                                      "letterSpacing": "-0.01em",
                                      "fontWeight": "600"
                              }
                      ]
              }
      },
          },
        }
    </script>
<style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 1;
        }
        .glass-card {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.5);
        }
    </style>
<style>
    body {
      min-height: max(884px, 100dvh);
    }
  </style>
  </head>
<body class="bg-background text-on-background min-h-screen flex flex-col font-body-md antialiased selection:bg-primary selection:text-on-primary">
<!-- Top Navigation (Transactional, no shell nav) -->
<header class="bg-surface-container-lowest sticky top-0 z-50">
<div class="max-w-max-width mx-margin-desktop px-margin-mobile md:px-md py-sm flex items-center justify-between">
<a aria-label="Go back" href="/Handylink/artisan/onboarding-step1.php" class="w-10 h-10 inline-flex items-center justify-center rounded-full hover:bg-surface-container-low transition-colors text-primary active:opacity-80">
<span class="material-symbols-outlined" data-icon="arrow_back">arrow_back</span>
</a>
<div class="font-headline-md text-headline-md font-bold text-primary">HandyLink</div>
<div class="font-label-md text-label-md text-on-surface-variant font-medium">STEP 2 OF 3</div>
</div>
<!-- Progress Bar -->
<div class="w-full bg-surface-container-high h-1">
<div class="bg-primary h-1 w-[66%] transition-all duration-500 ease-in-out"></div>
</div>
</header>
<!-- Main Content Canvas -->
<main class="flex-grow max-w-[600px] mx-auto w-full px-margin-mobile py-lg pb-32">
<!-- Header Text -->
<div class="mb-lg">
<h1 class="font-headline-lg-mobile md:font-headline-lg text-headline-lg-mobile md:text-headline-lg text-on-surface mb-sm">Verify your credentials</h1>
<p class="font-body-md text-body-md text-on-surface-variant">To maintain a safe and professional community, we require all artisans to verify their identity and certifications.</p>
</div>
<!-- Section 1: Government ID -->
<section class="mb-lg bg-surface-container-lowest rounded-xl shadow-[0_4px_12px_rgba(0,0,0,0.05)] p-gutter transition-all duration-300 hover:shadow-[0_8px_20px_rgba(0,0,0,0.08)]">
<div class="flex items-start gap-sm mb-md">
<div class="w-10 h-10 rounded-full bg-surface-container-high flex items-center justify-center text-primary flex-shrink-0">
<span class="material-symbols-outlined" data-icon="id_card">id_card</span>
</div>
<div>
<h2 class="font-headline-md text-headline-md text-on-surface text-lg leading-tight mb-1">Government-Issued ID</h2>
<p class="font-body-md text-body-md text-on-surface-variant text-sm">Upload a clear photo of your driver's license, passport, or national ID.</p>
</div>
</div>
<?php if (!empty($_SESSION['artisan_uploads']['gov_id'])): ?>
        <div class="mb-sm flex items-center justify-between bg-surface-container-low rounded-lg p-sm border border-outline-variant">
                <div class="truncate"><?= htmlspecialchars(basename($_SESSION['artisan_uploads']['gov_id'])) ?></div>
                <a class="text-primary font-semibold" href="<?= htmlspecialchars('/Handylink/uploads/' . basename(dirname($_SESSION['artisan_uploads']['gov_id'])) . '/' . basename($_SESSION['artisan_uploads']['gov_id'])) ?>" target="_blank">View</a>
        </div>
<?php endif; ?>
<form method="post" enctype="multipart/form-data" id="govForm">
        <input type="file" name="gov_id" id="gov_id_input" accept="image/*,application/pdf" style="display:none" />
        <button type="button" onclick="document.getElementById('gov_id_input').click()" class="w-full h-32 border-2 border-dashed border-outline-variant rounded-xl overflow-hidden flex items-center justify-center gap-sm text-on-surface-variant hover:border-primary hover:text-primary hover:bg-surface-container-low transition-all duration-200 group">
                <?php if (!empty($_SESSION['artisan_uploads']['gov_id'])): ?>
                        <?php $govUrl = '/Handylink/uploads/' . basename(dirname($_SESSION['artisan_uploads']['gov_id'])) . '/' . basename($_SESSION['artisan_uploads']['gov_id']); ?>
                        <?php $ext = strtolower(pathinfo($govUrl, PATHINFO_EXTENSION)); ?>
                        <?php if (in_array($ext, ['jpg','jpeg','png','gif','webp'])): ?>
                                <img src="<?= htmlspecialchars($govUrl) ?>" alt="Government ID" style="max-width:100%; max-height:100%; object-fit:cover; display:block;"/>
                        <?php else: ?>
                                <div class="w-full px-sm flex items-center justify-between">
                                        <div class="truncate"><?= htmlspecialchars(basename($_SESSION['artisan_uploads']['gov_id'])) ?></div>
                                        <a class="text-primary font-semibold" href="<?= htmlspecialchars($govUrl) ?>" target="_blank">View</a>
                                </div>
                        <?php endif; ?>
                <?php else: ?>
                        <div class="w-12 h-12 rounded-full bg-surface-container flex items-center justify-center group-hover:bg-primary-fixed transition-colors">
                                <span class="material-symbols-outlined group-hover:text-primary-container" data-icon="photo_camera">photo_camera</span>
                        </div>
                        <span class="font-label-md text-label-md font-medium">Tap to upload photo</span>
                <?php endif; ?>
        </button>
</form>
</section>
<!-- Section 2: Professional Certifications -->
<section class="mb-lg bg-surface-container-lowest rounded-xl shadow-[0_4px_12px_rgba(0,0,0,0.05)] p-gutter transition-all duration-300 hover:shadow-[0_8px_20px_rgba(0,0,0,0.08)]">
<div class="flex items-start gap-sm mb-md">
<div class="w-10 h-10 rounded-full bg-surface-container-high flex items-center justify-center text-primary flex-shrink-0">
<span class="material-symbols-outlined" data-icon="workspace_premium">workspace_premium</span>
</div>
<div>
<h2 class="font-headline-md text-headline-md text-on-surface text-lg leading-tight mb-1">Certifications &amp; Licenses <span class="text-on-surface-variant font-normal text-sm ml-1">(Optional)</span></h2>
<p class="font-body-md text-body-md text-on-surface-variant text-sm">Add any trade licenses or professional certifications to earn a "Verified" badge.</p>
</div>
</div>
<!-- Documents List / Add Document -->
<div class="bg-surface rounded-lg p-sm flex flex-col gap-2 border border-outline-variant/30 mb-sm min-h-[64px]">
        <?php if (!empty($_SESSION['artisan_uploads']['docs'])): ?>
                <?php foreach ($_SESSION['artisan_uploads']['docs'] as $idx => $docPath): ?>
                        <div class="flex items-center justify-between bg-surface-container-low px-3 py-2 rounded-lg border border-outline-variant">
                                <div class="truncate max-w-[70%]"><?= htmlspecialchars(basename($docPath)) ?></div>
                                <a class="text-primary font-semibold" href="<?= htmlspecialchars('/Handylink/uploads/' . basename(dirname($docPath)) . '/' . basename($docPath)) ?>" target="_blank">View</a>
                        </div>
                <?php endforeach; ?>
        <?php else: ?>
                <div class="flex items-center justify-center text-center text-on-surface-variant italic p-sm">No files uploaded yet</div>
        <?php endif; ?>
</div>
<form method="post" enctype="multipart/form-data" id="docForm">
        <input type="file" name="doc_file" id="doc_file_input" accept="image/*,application/pdf" style="display:none" />
        <button type="button" onclick="document.getElementById('doc_file_input').click()" class="w-full py-3 px-4 rounded-lg border border-outline text-primary font-label-md text-label-md font-semibold flex items-center justify-center gap-xs hover:bg-surface-container-low transition-colors active:opacity-80">
                <span class="material-symbols-outlined text-sm" data-icon="add">add</span>
                Add Document
        </button>
</form>
</section>
<!-- Section 3: Background Check -->
<section class="mb-lg bg-surface-container-lowest rounded-xl shadow-[0_4px_12px_rgba(0,0,0,0.05)] p-gutter transition-all duration-300 hover:shadow-[0_8px_20px_rgba(0,0,0,0.08)] relative overflow-hidden">
<!-- Decorative Accent -->
<div class="absolute top-0 right-0 w-24 h-24 bg-secondary-container/20 rounded-bl-full -mr-4 -mt-4 pointer-events-none"></div>
<div class="flex items-start gap-sm mb-md relative z-10">
<div class="w-10 h-10 rounded-full bg-secondary-fixed flex items-center justify-center text-secondary-container flex-shrink-0">
<span class="material-symbols-outlined" data-icon="security">security</span>
</div>
<div>
<h2 class="font-headline-md text-headline-md text-on-surface text-lg leading-tight mb-1">Background Check <span class="text-on-surface-variant font-normal text-sm ml-1">(Optional)</span></h2>
<p class="font-body-md text-body-md text-on-surface-variant text-sm">Complete a secure background check via our partner to increase booking rates by up to 40%.</p>
</div>
</div>
<?php
        // Render button state based on DB-backed background status
        // $backgroundStatus may be: not_started, pending, approved, rejected
        if ($backgroundStatus === 'not_started') {
                $btnLabel = 'Start Check';
                $btnClass = 'bg-surface-container-high text-primary';
                $btnDisabled = '';
        } elseif ($backgroundStatus === 'pending') {
                $btnLabel = 'Under Review';
                $btnClass = 'bg-surface-container-low text-on-surface-variant';
                $btnDisabled = 'disabled';
        } elseif ($backgroundStatus === 'approved') {
                $btnLabel = 'Background Checked';
                $btnClass = 'bg-primary text-on-primary';
                $btnDisabled = 'disabled';
        } else { // rejected
                $btnLabel = 'Resubmit';
                $btnClass = 'bg-surface-container-high text-primary';
                $btnDisabled = '';
        }
?>
<form method="post" id="startCheckForm">
        <input type="hidden" name="start_check" value="1" />
        <button type="submit" <?= $btnDisabled ?> class="w-full py-3 px-4 rounded-lg <?= $btnClass ?> font-label-md text-label-md font-semibold hover:bg-surface-variant transition-colors active:opacity-80">
                <?= htmlspecialchars($btnLabel) ?>
        </button>
</form>
</section>
<?php if (!empty($messages)): ?>
        <div id="flashMessages" class="max-w-[600px] mx-auto mt-md px-margin-mobile" aria-live="polite">
                <?php foreach ($messages as $m): ?>
                        <div class="mb-2 rounded-lg border border-surface-variant bg-surface p-sm text-sm text-on-surface"><?= htmlspecialchars($m) ?></div>
                <?php endforeach; ?>
        </div>
<?php endif; ?>
<?php if (!empty($showStartedBanner)): ?>
                <div id="transientBanner" class="max-w-[600px] mx-auto mt-md px-margin-mobile" aria-live="polite">
                                <div class="mb-2 rounded-lg border border-surface-variant bg-surface p-sm text-sm text-on-surface">Background check started</div>
                </div>
                <script>
                // Auto-hide transient banner after 3s and update button state
                (function(){
                        try {
                                const b = document.getElementById('transientBanner');
                                if (b) {
                                        setTimeout(()=>{
                                                b.style.transition = 'opacity 300ms ease';
                                                b.style.opacity = '0';
                                                setTimeout(()=>b.remove(),350);
                                        },3000);
                                }
                                const btn = document.querySelector('form#startCheckForm button[type=submit]');
                                if (btn) {
                                        btn.innerText = 'Under Review';
                                        btn.disabled = true;
                                        btn.classList.remove('bg-surface-container-high','text-primary');
                                        btn.classList.add('bg-surface-container-low','text-on-surface-variant');
                                }
                        } catch(e){}
                })();
                </script>
<?php endif; ?>
</main>
<!-- Fixed Bottom Action Bar -->
<div class="fixed bottom-0 w-full bg-surface-container-lowest border-t border-outline-variant/50 p-margin-mobile z-40 shadow-[0_-4px_12px_rgba(0,0,0,0.05)]">
<div class="max-w-[600px] mx-auto">
        <a href="/Handylink/artisan/availability-service-area.php" class="w-full h-12 inline-flex items-center justify-center bg-primary-container text-on-primary rounded-xl font-label-md text-label-md font-semibold flex items-center justify-center gap-xs hover:opacity-90 active:scale-[0.98] transition-all duration-200">
                Continue to Step 3
                <span class="material-symbols-outlined text-sm" data-icon="arrow_forward">arrow_forward</span>
        </a>
</div>
</div>

<script>
document.getElementById('gov_id_input')?.addEventListener('change', function(){
        if(this.files && this.files.length) document.getElementById('govForm').submit();
});
document.getElementById('doc_file_input')?.addEventListener('change', function(){
        if(this.files && this.files.length) document.getElementById('docForm').submit();
});
</script>
<script>
// If redirect includes bg=started, show immediate UI change for Start Check and auto-hide flash
// Always update Start Check button if present and auto-hide flash messages after 3s
(function(){
        try {
                const btn = document.querySelector('form#startCheckForm button[type=submit]');
                if (btn) {
                        // if server already set DB status, reflect 'Under Review' state
                        // we conservatively don't change text unless bg=started was used on redirect
                }
                const flash = document.getElementById('flashMessages');
                if (flash) {
                        setTimeout(() => {
                                flash.style.transition = 'opacity 300ms ease';
                                flash.style.opacity = '0';
                                setTimeout(() => flash.remove(), 350);
                        }, 3000);
                }
        } catch (e) {
                // noop
        }
})();
</script>
</body></html>
