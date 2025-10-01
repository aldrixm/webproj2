<?php
session_start();

// Unset all session variables
session_unset();

// Destroy the session
session_destroy();

// Clear any session cookies
if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time() - 0, '/'); // Expire the session cookie
}

// Clear other cookies if you have them
setcookie("user_preferences", "", time() - 0, "/"); // Example: clear user preferences cookie
setcookie("user_theme", "", time() - 0, "/"); // Example: clear user theme cookie

// Redirect to the login page
header("Location: login.html");
exit();
?>
