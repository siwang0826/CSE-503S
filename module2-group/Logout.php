<!doctype html>
<html lang="en">
    <head>
        <title>Log out</title>
        <link rel="stylesheet" type="text/css" href="function.css" />
    </head>
</html>
<?php
session_start();

$UserID = $_SESSION["UserID"];
if (!isset($_SESSION["UserID"])){
  header("location:Login.html");
  exit;
}

// Destroy the session
session_destroy();
echo "<p>Log out successfully.</p><br> <p>Returning to log in page...</p>";
header("refresh: 2; url = Login.html");
?>