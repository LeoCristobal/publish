<?php
$dbUrl = getenv('DATABASE_URL');
$dbopts = parse_url($dbUrl);

$host = $dbopts['host'];
$port = isset($dbopts['port']) ? $dbopts['port'] : 5432; // default 5432 kung walang port
$user = $dbopts['user'];
$pass = $dbopts['pass'];
$dbname = ltrim($dbopts['path'], '/');

try {
    $dsn = "pgsql:host=$host;port=$port;dbname=$dbname;";
    $pdo = new PDO($dsn, $user, $pass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    echo "✅ Database connection successful!";
} catch (PDOException $e) {
    echo "❌ Connection failed: " . $e->getMessage();
}
