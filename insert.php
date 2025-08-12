<?php
// Database configuration
session_start();

// Replace with your database connection details
require_once('admin/ultramsg.class.php');

include 'admin/db_connection.php';

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$company_number="9145468464";
// Retrieve form data
$name = $_POST['name'];
$email = $_POST['email'];
$mobile = $_POST['mobile'];
$exp = $_POST['exp'];
$city = $_POST['city'];
$utr = $_POST['utr_no'];
$course = $_POST['course'];


// Insert data into the database
$sql = "INSERT INTO user_enrollment (name, mail, mobile,trading_exp,city,utr_no,course_type) VALUES ('$name', '$email', '$mobile','$exp','$city','$utr','$course')";
if ($conn->query($sql) === TRUE) {
    echo "Data inserted successfully.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close connection
$conn->close();

$params=array(
    'token' => 'cgsaht5u1guyn6wq',
    'to' => "+91$company_number",
    'body' => "📢 New User Registration Alert!

Hello Team,
A new user has successfully registered on our platform. Below are the details:

👤 Name: $name
📧 Email: $email
📱 Mobile Number: $mobile
💼 Experience: $exp
🎓 course: $course
📍 city: $city

Please make a note of this and proceed with the necessary next steps for user onboarding.

If you have any questions or need further information, feel free to reach out!");

    $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_URL => "https://api.ultramsg.com/instance103473/messages/chat",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_SSL_VERIFYHOST => 0,
      CURLOPT_SSL_VERIFYPEER => 0,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_POSTFIELDS => http_build_query($params),
      CURLOPT_HTTPHEADER => array(
        "content-type: application/x-www-form-urlencoded"
      ),
    ));
    
    $response = curl_exec($curl);
    $err = curl_error($curl);
    
    curl_close($curl);
    
    if ($err) {
      echo "cURL Error #:" . $err;
    } else {
      echo $response;
    }



?>