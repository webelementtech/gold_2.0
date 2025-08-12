<?php
session_start();

// Replace with your database connection details
include 'db_connection.php';

// Create connection to MySQL


// Set headers to download the file as an Excel file
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=employee_data.xls");

// Fetch all records from the employee table
$query = "SELECT * FROM user_enrollment";
$result = $conn->query($query);

// Start output buffering
ob_start();
?>

<table border="1">
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Mobile</th>
            <th>Experience</th>
            <th>City</th>
            <th>Utr No</th>
            <th>Course type</th>
            <th>Date of Registration</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = $result->fetch_assoc()) : ?>
        <tr>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['mail']; ?></td>
            <td><?php echo $row['mobile']; ?></td>
            <td><?php echo $row['trading_exp']; ?></td>
            <td><?php echo $row['city']; ?></td>
            <td><?php echo $row['utr_no']; ?></td> 
            <td><?php echo $row['course_type']; ?></td>
            <td><?php echo $row['created']; ?></td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<?php
// Flush the output buffer to download the file
ob_end_flush();
exit;
?>
