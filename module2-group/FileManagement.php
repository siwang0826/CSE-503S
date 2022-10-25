<!doctype html>
<?php
session_start();
$UserID = $_SESSION["UserID"];
if (!isset($_SESSION["UserID"])){
  header("location:Login.html");
  exit;

}
?>

<html lang="en">
  <head>
    <title>Upload File Here</title>
    <link rel="stylesheet" type="text/css" href="FileManageFormat.css" />
  </head>

  <h1>Manage Your Files Here</h1>

    <form action="FileManagement.php" method="POST" enctype="multipart/form-data">
      <input type="file" name="myFile"/>
      <input type="submit" name="upload" value="Upload"/>
    </form>
    <br>
    

    <form action="deleteFile.php" method="POST">
      <label>
      Please enter the file name you want to delete:
      </label><br>
      <input type="text" name="deleteFileName"/>
      <input type="submit" name="delete" value="Delete"/>
    </form>
    <br>

    <form action="openFile.php" method="POST">
      <label>
      Please enter the file name you want to open:
      </label><br>
      <input type="text" name="openFile"/>
      <input type="submit" name="submit" value="Open"/>
    </form>
    <br>

    <form action="shareFile.php" method="POST">
      <label>
      Share File (file name)
      </label> <input type="text" name="share"/>
      <label>
      To (user name)
      </label><input type="text" name="shareUser"/>
      <input type="submit" name="shareFile" value="Share"/>
    </form>

    <form action="FileList.php" method="POST">
    <h2>Show Your File List:</h2>
      <input type="submit" name="File List" value="File List"/>
    </form>
    <br>


    <form action="Logout.php" method="POST">
      <input type="submit" name="logout" value="Log Out"/>
    </form>
    <br>



    


<?php
    // if the upload button is clicked
if (isset($_POST["upload"])){
  $theFile = basename($_FILES["myFile"]["name"]);
  //create a new directory for the new user
  if (!file_exists("/home/ec2-user/public_html/module2-group-module2-501370-501898/".$UserID."/")){
    mkdir("/home/ec2-user/public_html/module2-group-module2-501370-501898/".$UserID."/", 0755, true);
  }

  $filePath = "/home/ec2-user/public_html/module2-group-module2-501370-501898/".$UserID."/";

  if ($theFile == NULL){
    echo "<p>Choose a file before you upload it</p>";
    exit;
  }

  if( !preg_match('/^[\w_\.\-]+$/', $theFile) ){
    echo "Invalid filename";
    exit;
  }

  // the file path to stored at
  $filePath = $filePath.basename($theFile);
  // check if the file exists
  if (file_exists($filePath)){
    echo "<p>The file already exist.</p>";
    exit;
  }
  else {
    if (move_uploaded_file($_FILES["myFile"]["tmp_name"], $filePath)){
      echo "<p>Upload Successfully.</p>";
      exit;
    }
    else {
      echo "<p>Upload Unsuccessfully. Please try again.</p>";
      exit;
    }
  }
}

?>
  </body>
</html>