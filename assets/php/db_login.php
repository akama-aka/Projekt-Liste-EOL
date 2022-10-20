<?php
use project_list\config\config;
$conn = new pdo("mysql:host=".Config::DB_HOST.";dbname=".Config::DB_NAME, Config::DB_USER, Config::DB_PASSW);
try {
    $conn;
} catch (Exception $e) {
    echo "Connection failed: " . $e->getMessage();
}