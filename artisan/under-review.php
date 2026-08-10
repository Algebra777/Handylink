<?php
session_start();
$pageTitle = 'Application Under Review';
include dirname(__DIR__) . '/includes/header.php';
$name = $_SESSION['businessName'] ?? ($_SESSION['profile_submission']['name'] ?? 'Artisan');
$ver = $_SESSION['profile_submission']['verification'] ?? ['government_id'=>'received','selfie'=>'received','certificates'=>'received','admin'=>'pending'];
?>
<main class="min-h-screen flex items-center justify-center px-4 py-8">
  <div class="max-w-md w-full bg-surface-container-lowest rounded-xl p-8 shadow-[0_8px_30px_rgba(0,0,0,0.06)] text-center border border-surface-variant">
    <div class="mx-auto w-20 h-20 rounded-full bg-primary-container flex items-center justify-center mb-6">
      <span class="material-symbols-outlined text-on-primary" style="font-size:28px">check_circle</span>
    </div>
    <h1 class="font-headline-lg text-headline-lg mb-2">You're all set, <?= htmlspecialchars($name) ?>!</h1>
    <p class="text-on-surface-variant mb-6">Your profile is under review. This usually takes 24–48 hours.</p>
    <div class="bg-surface p-4 rounded-xl text-left mb-6">
      <div class="font-label-md text-label-md font-semibold mb-3">Verification Status</div>
      <div class="space-y-3">
        <style>
          .ver-card { background: var(--surface); padding:16px; border-radius:12px; box-shadow: 0 8px 20px rgba(3,18,14,0.04); }
          .ver-row { display:flex; align-items:center; justify-content:space-between; padding:12px 0; }
          .ver-row + .ver-row { border-top:1px solid rgba(13,28,46,0.06); }
          .ver-left { display:flex; align-items:center; gap:12px; }
          .ver-icon { width:36px; height:36px; border-radius:10px; background: rgba(3,18,14,0.04); display:flex; align-items:center; justify-content:center; }
          .status-badge { display:inline-flex; align-items:center; gap:8px; font-weight:500; }
          .status-dot { width:18px; height:18px; border-radius:9999px; display:inline-flex; align-items:center; justify-content:center; }
          .status-received { color: #0f766e; }
          .status-received .status-dot { background:#0f766e; color:white; }
          .status-pending { color:#b45309; }
          .status-pending .status-dot { background:#f59e0b; color:white; }
        </style>
        <div class="ver-card mb-6">
          <div class="font-label-md text-label-md font-semibold mb-3">Verification Status</div>
          <div>
            <div class="ver-row">
              <div class="ver-left"><div class="ver-icon"><span class="material-symbols-outlined" style="font-size:18px;color:#0f766e">badge</span></div><div>Government ID</div></div>
              <div class="status-badge <?= ($ver['government_id']==='received') ? 'status-received' : '' ?>"><?= $ver['government_id'] === 'received' ? '<span class="status-dot"><span class="material-symbols-outlined" style="font-size:12px">check</span></span><span>Received</span>' : ucfirst($ver['government_id']) ?></div>
            </div>
            <div class="ver-row">
              <div class="ver-left"><div class="ver-icon"><span class="material-symbols-outlined" style="font-size:18px;color:#0f766e">face</span></div><div>Selfie Verification</div></div>
              <div class="status-badge <?= ($ver['selfie']==='received') ? 'status-received' : '' ?>"><?= $ver['selfie'] === 'received' ? '<span class="status-dot"><span class="material-symbols-outlined" style="font-size:12px">check</span></span><span>Received</span>' : ucfirst($ver['selfie']) ?></div>
            </div>
            <div class="ver-row">
              <div class="ver-left"><div class="ver-icon"><span class="material-symbols-outlined" style="font-size:18px;color:#0f766e">workspace_premium</span></div><div>Professional Certificates</div></div>
              <div class="status-badge <?= ($ver['certificates']==='received') ? 'status-received' : '' ?>"><?= $ver['certificates'] === 'received' ? '<span class="status-dot"><span class="material-symbols-outlined" style="font-size:12px">check</span></span><span>Received</span>' : ucfirst($ver['certificates']) ?></div>
            </div>
            <div class="ver-row">
              <div class="ver-left"><div class="ver-icon"><span class="material-symbols-outlined" style="font-size:18px;color:#b45309">admin_panel_settings</span></div><div>Admin Approval</div></div>
              <div class="status-badge <?= ($ver['admin']==='pending') ? 'status-pending' : '' ?>"><?= $ver['admin'] === 'pending' ? '<span class="status-dot"><span class="material-symbols-outlined" style="font-size:12px">more_horiz</span></span><span>Pending</span>' : ucfirst($ver['admin']) ?></div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <p class="text-on-surface-variant mb-6">We'll notify you the moment you're approved.</p>
    <div class="flex flex-col gap-3">
      <a href="/Handylink/artisan/dashboard.php" class="bg-primary text-on-primary px-6 py-3 rounded-xl">Go to My Dashboard</a>
      <a href="/Handylink/artisan/onboarding-step1.php" class="text-primary">Edit my profile</a>
    </div>
  </div>
</main>
</body>
</html>
