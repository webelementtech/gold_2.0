<?php
session_start();

// Replace with your database connection details
include 'db_connection.php';

// Create connection to MySQL


$query = "SELECT DISTINCT course FROM employees";
$result = $conn->query($query);

$courses = [];
while ($row = $result->fetch_assoc()) {
    $courses[] = $row['course'];
}

header('Content-Type: application/json');
echo json_encode(['courses' => $courses]);
?>
