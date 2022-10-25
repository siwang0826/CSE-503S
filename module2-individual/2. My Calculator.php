<!DOCTYPE HTML>
<html lang="en">
<head>
    <title>My Calculator</title>
</head>
<body>
<?php
        $results="";
        $num1=isset($_POST['num1']) ? $_POST['num1'] : "";
        $num2=isset($_POST['num2']) ? $_POST['num2'] : "";


        if($_POST['action'] == "+"){
            $results=$num1+$num2;
        }

        if($_POST['action'] == '-'){
            $results=$num1-$num2;
        }
 
        if($_POST['action'] == 'x'){
            $results=$num1*$num2;
        }

        if($_POST['action'] == '/'){
            $results=$num1/$num2;
        }
        else{
            echo "Please Enter Content";
        }

?>

<form method="post">
    First Number: <input type="text" name="num1" value="<?php echo $num1;?>">
    <select name="action">
        <option value="+">+</option>
        <option value="-">-</option>
        <option value="x">x</option>
        <option value="/">/</option>
    </select>
    Second Number:<input type="text" name="num2" value="<?php echo $num2;?>">
    <input type="submit" name="submit" value="=">
    Results:<input type="text" name="sum" value="<?php echo $results;?>">

</form>
</body>
</html>


 