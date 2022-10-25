<!doctype html>
<html lang="en">
    <head>
        <title> Login to File Sharing Site </title>
        <link rel="stylesheet" type="text/css" href="loginFormat.css">
    </head>
    
    <body>
        <h1> Welcome to Our Sharing Site</h1>
    
        <form name="input" action="Login.php" method="POST">
        UserID:<br><input type="text" name="UserID">
        <input type="submit" name="submit" value="Login">
		</form>

    <?php
    
	// retrieve the current user list
	// from CSE330 wiki
	$userlist = array();
	$file = fopen("/home/ec2-user/UserID.txt", "r");
	$linenum = 1;
	while( !feof($file) ){
		$linenum++;
		array_push($userlist,trim(fgets($file)));
	}
	fclose($file);
	if (isset($_POST["UserID"]) ) {
		$UserID = $_POST["UserID"];
		
		if (!preg_match('/^[\w_\.\-]+$/', $UserID) || $UserID == "") {
			echo "INVALID INPUT";
			exit;
		}
		// check if user exists
		if(in_array($UserID,$userlist)) {
			// record the current user
			session_start();
			$_SESSION['UserID'] = $UserID;
			session_write_close();
		
			echo 'Login successfully;';
			header("Location:FileManagement.php");
			exit;
		}
		else {
			echo 'User not exists!<br>';
		}
	}
    ?>
    </body>
</html>