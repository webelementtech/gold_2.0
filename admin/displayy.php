<?php
session_start();
include 'db_connection.php';
// Create connection to MySQL


$dateFilter = $_GET['dateFilter'] ?? '';
$courseFilter = $_GET['courseFilter'] ?? '';
$page = $_GET['page'] ?? 1;
$limit = 10;
$offset = ($page - 1) * $limit;

$query = "SELECT * FROM user_enrollment WHERE 1=1";

// Apply filters
if ($dateFilter === 'today') {
    $query .= " AND DATE(created) = CURDATE()";
} elseif ($dateFilter === 'yesterday') {
    $query .= " AND DATE(created) = CURDATE() - INTERVAL 1 DAY";
} elseif ($dateFilter === 'last7Days') {
    $query .= " AND DATE(created) >= CURDATE() - INTERVAL 7 DAY";
} elseif ($dateFilter === 'last30Days') {
    $query .= " AND DATE(created) >= CURDATE() - INTERVAL 30 DAY";
}

if (!empty($courseFilter)) {
    $query .= " AND course_type = '$courseFilter'";
}

$totalQuery = "SELECT COUNT(*) AS total FROM user_enrollment WHERE 1=1";
$totalResult = $conn->query($totalQuery);
$total = $totalResult->fetch_assoc()['total'];
$totalPages = ceil($total / $limit);

$query .= " LIMIT $limit OFFSET $offset";
$result = $conn->query($query);

$employees = [];
while ($row = $result->fetch_assoc()) {
    $employees[] = $row;
}

header('Content-Type: application/json');
echo json_encode([
    'employees' => $employees,
    'current_page' => $page,
    'total_pages' => $totalPages
]);
?>
