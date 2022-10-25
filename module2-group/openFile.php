
<?php
session_start();

// Keep tracking the user who logged in
// Back to the login page if the person did not log in
$UserID = $_SESSION["UserID"];
if (!isset($_SESSION["UserID"])){
  header("location:Login.html");
  exit;

}

$fileName = $_POST["openFile"];
$getAction = $_POST["submit"];
$open = false;

if ($getAction == "Open"){
  $open = true;
}
else{
  $open = false;
}

// Enter= null: return to the file management page
if ($fileName == NULL){
    header("Location:FileManagement.php");
    exit;
}

if( !preg_match('/^[\w_\.\-]+$/', $fileName) ){
	echo "Invalid filename";
	exit;
}

// open the file if the file can be found
if ($open){
  $filePath = "/home/ec2-user/public_html/module2-group-module2-501370-501898/".$UserID."/".$fileName;
  if (file_exists($filePath)){
    $finfo = new finfo(FILEINFO_MIME_TYPE);
    $fileInfo = $finfo->file($filePath);
    ob_clean();
    header("Content-Type: ".$fileInfo);
    readfile($filePath);
  }
  else {
    echo "<p>The file does not exist. <br>
    Returning to file management page...</p>";
    header("refresh: 4; url=FileManagement.php");
    exit;
  }
}

else {
    echo "<p>Cannot access to the file or it does not exist. <br>
    Returning to file management page...</p>";
    header("refresh: 4; url=FileManagement.php");
    exit;
}
?>
