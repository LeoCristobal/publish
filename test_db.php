<?php
$dbUrl = getenv('DATABASE_URL');
$dbopts = parse_url($dbUrl);

$dsn = "pgsql:host={$dbopts['host']};port={$dbopts['port']};dbname=" . ltrim($dbopts['path'],'/');
$user = $dbopts['user'];
$pass = $dbopts['pass'];

try {
    $pdo = new PDO($dsn, $user, $pass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    echo "✅ Database connection successful!";
} catch (PDOException $e) {
    echo "❌ Connection failed: " . $e->getMessage();
}
