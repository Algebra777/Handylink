<?php
session_start();

// Simple admin check — set $_SESSION['is_admin']=true for access in local dev
if (empty($_SESSION['is_admin'])) {
    echo '<h2>Not authorized</h2><p>Set $_SESSION["is_admin"] = true in your session for local testing.</p>';
    exit;
}

$uploadsDir = __DIR__ . '/../uploads';
if (!is_dir($uploadsDir)) {
    @mkdir($uploadsDir, 0755, true);
}

try {
    $dsn = getenv('DB_DSN') ?: 'mysql:host=127.0.0.1;dbname=handylink;charset=utf8mb4';
    $dbUser = getenv('DB_USER') ?: 'root';
    $dbPass = getenv('DB_PASS') ?: '';
    $pdo = new PDO($dsn, $dbUser, $dbPass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
} catch (PDOException $e) {
    die('DB connection failed: ' . htmlspecialchars($e->getMessage()));
}

// Handle approve/reject actions
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['profile_id']) && !empty($_POST['action'])) {
    $pid = (int) $_POST['profile_id'];
    $action = $_POST['action'] === 'approve' ? 'approved' : 'rejected';
    $stmt = $pdo->prepare('UPDATE artisan_profiles SET background_check_status = :status, updated_at = NOW() WHERE id = :id');
    $stmt->execute([':status' => $action, ':id' => $pid]);
    header('Location: ' . $_SERVER['REQUEST_URI']);
    exit;
}

// Fetch pending profiles
$q = $pdo->prepare('SELECT ap.id as profile_id, ap.user_id, u.email, u.name, ap.created_at FROM artisan_profiles ap LEFT JOIN users u ON u.id = ap.user_id WHERE ap.background_check_status = :st ORDER BY ap.created_at ASC');
$q->execute([':st' => 'pending']);
$rows = $q->fetchAll(PDO::FETCH_ASSOC);
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Admin - Verification Queue</title>
    <style>body{font-family:Arial,Helvetica,sans-serif;max-width:980px;margin:24px} .card{border:1px solid #ddd;padding:12px;margin-bottom:12px;border-radius:6px}</style>
    </head>
<body>
<h1>Verification Queue (pending)</h1>
<?php if (empty($rows)): ?>
    <p>No pending verifications.</p>
<?php else: ?>
    <?php foreach ($rows as $r): ?>
        <div class="card">
            <strong>User:</strong> <?= htmlspecialchars($r['name'] ?? $r['email'] ?? 'User '.$r['user_id']) ?> (ID <?= (int)$r['user_id'] ?>)<br/>
            <strong>Submitted:</strong> <?= htmlspecialchars($r['created_at']) ?><br/>
            <div style="margin-top:8px">
                <strong>Files:</strong>
                <ul>
                    <?php
                    $uid = (int)$r['user_id'];
                    $folder = $uploadsDir . '/' . preg_replace('/[^a-z0-9_-]/i', '_', (string)$uid);
                    if (is_dir($folder)) {
                        $files = array_values(array_diff(scandir($folder), ['.','..']));
                        foreach ($files as $f) {
                            $url = '/Handylink/uploads/' . basename($folder) . '/' . rawurlencode($f);
                            echo '<li><a href="' . htmlspecialchars($url) . '" target="_blank">' . htmlspecialchars($f) . '</a></li>';
                        }
                    } else {
                        echo '<li><em>No files uploaded</em></li>';
                    }
                    ?>
                </ul>
            </div>
            <form method="post" style="margin-top:8px;display:inline-block">
                <input type="hidden" name="profile_id" value="<?= (int)$r['profile_id'] ?>" />
                <button name="action" value="approve" style="background:#16a34a;color:#fff;border:none;padding:8px 12px;border-radius:4px">Approve</button>
            </form>
            <form method="post" style="margin-top:8px;display:inline-block;margin-left:8px">
                <input type="hidden" name="profile_id" value="<?= (int)$r['profile_id'] ?>" />
                <button name="action" value="reject" style="background:#dc2626;color:#fff;border:none;padding:8px 12px;border-radius:4px">Reject</button>
            </form>
        </div>
    <?php endforeach; ?>
<?php endif; ?>
</body>
</html>
