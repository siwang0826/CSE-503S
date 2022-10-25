<!doctype html>
<html lang="en">
    <head>
        <title>Sharing File</title>
        <link rel="stylesheet" type="text/css" href="function.css" />
    </head>
</html>
<?php
session_start();
$UserID = $_SESSION["UserID"];
$shareTo = $_POST["shareUser"];
$shareFile = $_POST["share"];

// keeps tracking whether the user logged in
if ($UserID == NULL) {
    header("Location:Login.html");
    exit;
}

// if the user we want to share is empty, echo
// and go back to the file management page
if ($shareTo == NULL){
    echo "<p>Please enter the name you want to share with.<br>Returning to file management page...</p>";
    header("refresh: 4; url=FileManagement.php");
    exit;
}

// if the file name user inputs is empty, echo, and go back to the file management page
if ($shareFile == NULL){
    echo "<p>Please enter the name you want to share with.<br>Returning to file management page...</p>";
    header("refresh: 4; url=FileManagement.php");
    exit;
}

// make sure the user we are sharing to exist

// retrieve the current user list
$userlist = array();
$file = fopen("/home/ec2-user/UserID.txt", "r");
$linenum = 1;
while( !feof($file) ){
	$linenum++;
	array_push($userlist,trim(fgets($file)));
}
fclose($file);
// check if user exists
if(in_array($UserID,$userlist)) {
    // record the current user
    $_SESSION['UserID'] = $UserID;
    session_write_close();
    $userExist = true;
}
// go back to the file management page if the user does not exist
if (!$userExist) {
    echo "<p>The user you share to does not exist.<br>Returning to file management page...</p>";
    header("refresh: 4; url=FileManagement.php");
    exit;
}

// check if the file exist, and share the file if it does.
// Or, go back to file management page
$filePath = "/home/ec2-user/public_html/module2-group-module2-501370-501898/".$UserID."/";
$fileExist = false;
if (file_exists($filePath)){
    if ($fileList = opendir($filePath)){
        while (($file = readdir($fileList)) !== false){
            if ($file == $shareFile){
                $fileExist = true;
            }
        }
        closedir($fileList);
    }
}

if ($fileExist){
    $shareToPath = "/home/ec2-user/public_html/module2-group-module2-501370-501898/".$shareTo."/";
    // if the user we share to does not have a directory in the system, we create one for him
    if (!file_exists($shareToPath)){
        mkdir($shareToPath, 0777, true);
    }

    // we want to make sure the user we share to does not have the same file
    if (file_exists($shareToPath.basename($shareFile))){
      echo "<p>The user already had the file, try to share other files.
      <br>Returning to file management page...</p>";
      header("refresh: 4; url=FileManagement.php");
      exit;
    }
    // Otherwise, just share the file
    else {
      if (copy($filePath.basename($shareFile), $shareToPath.basename($shareFile))){
          echo "<p>share the file ".$shareFile." to user ".$shareTo." successfully.
          <br>Returning to file management page...</p>";
          header("refresh: 4; url=FileManagement.php");
          exit;
      }
      else{
          echo "<p>share the file ".$shareFile." to user ".$shareTo." unsuccessfully.
          <br>Returning to file management page...</p>";
          header("refresh: 4; url=FileManagement.php");
          exit;
      }
    }
}
else{
    echo "<p>The file you share does not exist.<br>Returning to file management page...</p>";
    header("refresh: 4; url=FileManagement.php");
    exit;
}
?>
