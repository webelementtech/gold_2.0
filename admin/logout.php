<?php
// Start the session
session_start();

// Destroy the session to log out the user
session_destroy();

// Redirect to login page after logout
header('Location: index.html');
exit();
?>