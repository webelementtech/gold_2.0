<?php
include 'db_connection.php';

$username = "admin";
$password = password_hash("admin123", PASSWORD_DEFAULT);

$query = "INSERT INTO admin (username, password) VALUES (?, ?)";
$stmt = $conn->prepare($query);
$stmt->bind_param("ss", $username, $password);
$stmt->execute();
echo "Admin user created successfully.";
?>
