<!doctype html>
<?php
session_start();

// Keep tracking the user who logged in
// Back to the login page if the person did not log in
$UserID = $_SESSION["UserID"];
if (!isset($_SESSION["UserID"])){
  header("location:Login.html");
  exit;

}
?>

<html lang="en">
    <head>
        <title>Deleting File</title>
        <link rel="stylesheet" type="text/css" href="function.css" />
    </head>
</html>

<?php

// Get the name of the file we want to delete
// Return to previous page if nothing inputed
$fileName = $_POST["deleteFileName"];
if ($fileName == NULL){
    header("Location:FileManagement.php");
    exit;
}

// Can find the file: unlink (delete)
$filePath = "/home/ec2-user/public_html/module2-group-module2-501370-501898/".$UserID."/".$fileName;
if (file_exists($filePath)){
    if (unlink($filePath)){
        echo 
        "<p>File has been deleted successfully.<br>;
        Returning to previous page...</p>";
        header("refresh: 4; url=FileManagement.php");
        exit;
    }
    else {
        echo 
        "<p>Unable to delete the file.<br>Please try again. <br>;
        Returning to previous page...</p>";
        header("refresh: 4; url=FileManagement.php");
        exit;
    }
}
else{
    echo 
    "<p>The file does not exist! <br>;
    Returning to previous page...</p>";
    header("refresh: 4; url=FileManagement.php");
    exit;
}
?>