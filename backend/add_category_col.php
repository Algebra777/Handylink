<?php
$pdo = new PDO('mysql:host=127.0.0.1;port=3306;dbname=handylink;charset=utf8mb4', 'root', '');
$pdo->exec('ALTER TABLE artisans ADD COLUMN category_id BIGINT UNSIGNED NULL AFTER business_name');
echo "done\n";
