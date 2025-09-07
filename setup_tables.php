<?php
require_once 'database.php';

$pdo = Database::connect();

try {
    // Table for UID from ESP8266
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS uids (
            id SERIAL PRIMARY KEY,
            uid VARCHAR(255) NOT NULL,
            created_at TIMESTAMP WITH TIME ZONE DEFAULT now()
        );
    ");

    // Table for user info
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS user_info (
            id SERIAL PRIMARY KEY,
            name VARCHAR(255) NOT NULL,
            email VARCHAR(255) UNIQUE NOT NULL,
            created_at TIMESTAMP WITH TIME ZONE DEFAULT now()
        );
    ");

    echo "✅ All tables created successfully!";
} catch (PDOException $e) {
    die("❌ Failed: " . $e->getMessage());
}
?>
