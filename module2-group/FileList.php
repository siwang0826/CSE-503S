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
        <title>Your File List</title>
        <link rel="stylesheet" type="text/css" href="function.css" />
    </head>
    <body>
        <h3>File List</h3>
        <form action="FileList.php" method="POST">
            <input type="submit" name="back" value="Back"/>
        </form>

    <?php
    // Check if null: -> No directory: no file uploaded
    // Has files uploaded: open & get their names

    $filePath = "/home/ec2-user/public_html/module2-group-module2-501370-501898/".$UserID;
    if (is_dir($filePath)){
        $fileList = opendir($filePath);
        while (false !== ($file= readdir($fileList))){
            echo htmlentities($file);
            echo '<br>';
        }
        closedir($fileList);
    }
    else {
        echo "<p>No file uploaded.</p>";
    }
    
    // button "back": return to previous page
    if (isset($_POST["back"])){
        header("Location:FileManagement.php");
        exit;
    }
    ?>
    </body>
</html>
