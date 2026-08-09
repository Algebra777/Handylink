<?php
session_start();

$pageTitle = 'HandyLink - Create Account';
$bodyClass = 'bg-surface min-h-screen flex flex-col text-on-surface';

$role = strtolower($_GET['role'] ?? '');
if ($role !== 'customer' && $role !== 'artisan') {
    header('Location: /Handylink/get_started_role_selection/index.php');
    exit;
}

if ($role === 'artisan') {
    header('Location: /Handylink/artisan/onboarding-step1.php');
    exit;
}

include dirname(__DIR__) . '/includes/header.php';

$errors = [];
$submittedValues = [
    'fullName' => '',
    'email' => '',
    'password' => '',
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $submittedValues['fullName'] = trim($_POST['fullName'] ?? '');
    $submittedValues['email'] = trim($_POST['email'] ?? '');
    $submittedValues['password'] = trim($_POST['password'] ?? '');

    if ($submittedValues['fullName'] === '') {
        $errors['fullName'] = 'Please enter your full name.';
    } elseif (mb_strlen($submittedValues['fullName']) < 2) {
        $errors['fullName'] = 'Please enter a name with at least 2 characters.';
    }

    if ($submittedValues['email'] === '') {
        $errors['email'] = 'Please enter your email address.';
    } elseif (!filter_var($submittedValues['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Please enter a valid email address.';
    }

    if ($submittedValues['password'] === '') {
        $errors['password'] = 'Please enter a password.';
    } elseif (mb_strlen($submittedValues['password']) < 8) {
        $errors['password'] = 'Password must be at least 8 characters long.';
    }

    if (!$errors) {
        try {
            $dsn = getenv('DB_DSN') ?: 'mysql:host=127.0.0.1;dbname=handylink;charset=utf8mb4';
            $dbUser = getenv('DB_USER') ?: 'root';
            $dbPass = getenv('DB_PASS') ?: '';
            $pdo = new PDO($dsn, $dbUser, $dbPass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

            $checkTable = $pdo->query("SHOW TABLES LIKE 'users'");
            if ($checkTable->fetch() === false) {
                $errors['database'] = 'The users table is not available yet. Please confirm the table schema before registering.';
            } else {
                $stmt = $pdo->prepare('SELECT id FROM users WHERE email = :email LIMIT 1');
                $stmt->execute([':email' => $submittedValues['email']]);
                if ($stmt->fetch()) {
                    $errors['email'] = 'An account with this email already exists.';
                } else {
                    $passwordHash = password_hash($submittedValues['password'], PASSWORD_DEFAULT);
                    $insert = $pdo->prepare('INSERT INTO users (name, email, password_hash, role, status, created_at) VALUES (:name, :email, :password_hash, :role, :status, NOW())');
                    $insert->execute([
                        ':name' => $submittedValues['fullName'],
                        ':email' => $submittedValues['email'],
                        ':password_hash' => $passwordHash,
                        ':role' => 'customer',
                        ':status' => 'active',
                    ]);

                    $_SESSION['user_id'] = (int) $pdo->lastInsertId();
                    $_SESSION['role'] = 'customer';

                    header('Location: /Handylink/customer/home.php');
                    exit;
                }
            }
        } catch (PDOException $e) {
            $errors['database'] = 'Registration is temporarily unavailable. Please confirm the database setup first.';
        }
    }
}

function errorClass($fieldName, $errors): string {
    return isset($errors[$fieldName]) ? 'border-error focus:border-error focus:ring-error/20' : 'border-outline-variant focus:border-primary focus:ring-primary/20';
}
?>
<!-- Top Navigation (Transactional, no shell nav) -->
<header class="w-full flex justify-between items-center px-margin-mobile md:px-md py-sm max-w-max-width mx-margin-desktop bg-surface-container-lowest border-b border-outline-variant">
<a aria-label="Go back" class="text-primary flex items-center justify-center p-2 rounded-full hover:bg-surface-container-low transition-colors" href="/Handylink/get_started_role_selection/index.php">
<span class="material-symbols-outlined text-2xl">arrow_back</span>
</a>
<div class="font-label-md text-label-md text-on-surface-variant flex items-center gap-2">
            Already have an account? 
            <a class="text-primary font-bold hover:underline" href="/Handylink/auth/login.php">Log in</a>
</div>
</header>
<!-- Main Content -->
<main class="flex-grow flex items-center justify-center p-margin-mobile md:p-md">
<div class="w-full max-w-md bg-surface-container-lowest rounded-xl shadow-[0_4px_12px_rgba(0,0,0,0.05)] p-md md:p-lg border border-outline-variant/40">
<!-- Header Text -->
<div class="mb-lg text-center">
<h1 class="font-headline-lg-mobile md:font-headline-lg text-headline-lg-mobile md:text-headline-lg text-primary mb-sm font-bold">Create your account</h1>
<p class="font-body-md text-body-md text-on-surface-variant">Join HandyLink to find and book trusted local artisans.</p>
</div>
<?php if (!empty($errors['database'])): ?>
<div class="mb-md rounded-lg border border-error/30 bg-error-container px-sm py-sm text-sm text-error">
    <?= htmlspecialchars($errors['database']) ?>
</div>
<?php endif; ?>
<!-- Signup Form -->
<form class="flex flex-col gap-md" action="/Handylink/auth/register.php?role=customer" method="post">
<!-- Full Name Input -->
<div class="flex flex-col gap-xs">
<label class="font-label-md text-label-md text-on-surface" for="fullName">Full Name</label>
<div class="relative">
<span class="material-symbols-outlined absolute left-sm top-1/2 -translate-y-1/2 text-outline-variant">person</span>
<input class="w-full h-12 pl-10 pr-sm rounded-xl border <?= errorClass('fullName', $errors) ?> focus:ring-2 focus:outline-none transition-all bg-surface font-body-md text-body-md placeholder:text-outline" id="fullName" name="fullName" placeholder="e.g. Jane Doe" type="text" value="<?= htmlspecialchars($submittedValues['fullName']) ?>" aria-invalid="<?= isset($errors['fullName']) ? 'true' : 'false' ?>"/>
</div>
<?php if (isset($errors['fullName'])): ?>
<p class="text-sm text-error"><?= htmlspecialchars($errors['fullName']) ?></p>
<?php endif; ?>
</div>
<!-- Email Input -->
<div class="flex flex-col gap-xs">
<label class="font-label-md text-label-md text-on-surface" for="email">Email Address</label>
<div class="relative">
<span class="material-symbols-outlined absolute left-sm top-1/2 -translate-y-1/2 text-outline-variant">mail</span>
<input class="w-full h-12 pl-10 pr-sm rounded-xl border <?= errorClass('email', $errors) ?> focus:ring-2 focus:outline-none transition-all bg-surface font-body-md text-body-md placeholder:text-outline" id="email" name="email" placeholder="you@example.com" type="email" value="<?= htmlspecialchars($submittedValues['email']) ?>" aria-invalid="<?= isset($errors['email']) ? 'true' : 'false' ?>"/>
</div>
<?php if (isset($errors['email'])): ?>
<p class="text-sm text-error"><?= htmlspecialchars($errors['email']) ?></p>
<?php endif; ?>
</div>
<!-- Password Input -->
<div class="flex flex-col gap-xs">
<label class="font-label-md text-label-md text-on-surface" for="password">Password</label>
<div class="relative">
<span class="material-symbols-outlined absolute left-sm top-1/2 -translate-y-1/2 text-outline-variant">lock</span>
<input class="w-full h-12 pl-10 pr-10 rounded-xl border <?= errorClass('password', $errors) ?> focus:ring-2 focus:outline-none transition-all bg-surface font-body-md text-body-md placeholder:text-outline" id="password" name="password" placeholder="••••••••" type="password" value="<?= htmlspecialchars($submittedValues['password']) ?>" aria-invalid="<?= isset($errors['password']) ? 'true' : 'false' ?>"/>
<button aria-label="Toggle password visibility" class="absolute right-sm top-1/2 -translate-y-1/2 text-outline-variant hover:text-on-surface transition-colors" type="button">
<span class="material-symbols-outlined">visibility_off</span>
</button>
</div>
<?php if (isset($errors['password'])): ?>
<p class="text-sm text-error"><?= htmlspecialchars($errors['password']) ?></p>
<?php endif; ?>
</div>
<!-- Primary Action -->
<button class="w-full h-12 bg-primary-container text-on-primary rounded-xl font-label-md text-label-md flex items-center justify-center hover:bg-primary transition-colors shadow-[0_4px_12px_rgba(0,0,0,0.05)] hover:shadow-[0_8px_20px_rgba(0,0,0,0.08)] mt-sm" type="submit">
                    Create Account
                </button>
</form>
<!-- Divider -->
<div class="flex items-center gap-sm my-md">
<div class="h-px bg-outline-variant flex-grow"></div>
<span class="font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider">Or sign up with</span>
<div class="h-px bg-outline-variant flex-grow"></div>
</div>
<!-- Social Signup -->
<div class="flex flex-col gap-sm">
<button class="w-full h-12 bg-surface border border-outline-variant rounded-xl font-label-md text-label-md flex items-center justify-center gap-sm hover:bg-surface-container-low transition-colors text-on-surface" type="button" aria-disabled="true" disabled>
<img alt="Google Logo" class="w-5 h-5" src="https://lh3.googleusercontent.com/aida-public/AB6AXuD5FJncwEQqpjDI7q9VEXhsxU6w3H-IJkjwNNy-XWOTbdlVLxpRrvFOV0doYa0GyWv1nCEGhPgRfOCJXTj5HOyHK44X5jQBYNXUkhrUAnfEgbRipOiDWVZOUB3B6YZ3JYNIb4aFvspAgKP88w0wswpQGdUL_W6E-OuNvA1BH1-2-5STSDESrn7bdMNviGTJLsh5brplUbM3a4Sn2Jth21zVQeIEj0gqSHPuLfbAYtzEmYXgtfj2IKPu"/>
                    Continue with Google
                </button>
<button class="w-full h-12 bg-surface border border-outline-variant rounded-xl font-label-md text-label-md flex items-center justify-center gap-sm hover:bg-surface-container-low transition-colors text-on-surface" type="button" aria-disabled="true" disabled>
<span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">file_download</span>
                    Continue with Apple
                </button>
<p class="text-center text-sm text-on-surface-variant">Google and Apple sign-in are currently stubbed and will be enabled later.</p>
</div>
<!-- Legal Text -->
<p class="font-label-sm text-label-sm text-on-surface-variant text-center mt-lg max-w-[280px] mx-auto">
                By signing up, you agree to our <a class="text-primary hover:underline" href="#">Terms of Service</a> and <a class="text-primary hover:underline" href="#">Privacy Policy</a>.
            </p>
</div>
</main>
</body></html>
