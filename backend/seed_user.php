<?php
require 'vendor/autoload.php';
$app = require 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$user = new App\Models\User;
$user->name = 'Test User';
$user->email = 'test@example.com';
$user->password = password_hash('password123', PASSWORD_BCRYPT);
$user->role = 'artisan';
$user->save();

echo $user->id . PHP_EOL;
