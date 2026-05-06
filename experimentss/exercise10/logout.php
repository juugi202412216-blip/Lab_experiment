<?php
session_start();

// Set last visit cookie
setcookie('last_visit', date('F j, Y, g:i a'), time() + (86400 * 30), "/");

// Destroy session
session_unset();
session_destroy();

// Redirect to home
header("Location: index.php");
exit();
?>
