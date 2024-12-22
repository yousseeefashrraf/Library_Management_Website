<?php
session_start(); // Start the session

// Clear all session variables
$_SESSION['status']="";
$_SESSION['adminId']="";
$_SESSION = [];

// Unset the session entirely
session_unset();

// Destroy the session
session_destroy();

// Delete the session cookie
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(), 
        '', 
        time() - 42000, 
        $params["path"], 
        $params["domain"], 
        $params["secure"], 
        $params["httponly"]
    );
}

// Redirect or provide a confirmation message
header("Location: ../LoginPage/Project.php");
exit;

?>
