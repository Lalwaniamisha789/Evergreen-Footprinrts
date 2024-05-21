<?php
$host = 'localhost';
$dbname = 'evergreenfootprints';
$username = 'root';
$password = '';
$port = '3307'; // Change this port to the correct one if needed

try {
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbname", $username, $password);
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    die();
}
