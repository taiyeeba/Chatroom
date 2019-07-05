<?php
	$link = mysqli_connect("localhost", "root", "", "userinfo");

	//check connection
	if($link === false){
		die("ERROR: Could not connect. " . mysqli_connect_error());
	}

	session_start(); 
	$old= $_SESSION['user'];
	
	$userName = mysqli_real_escape_string($link, $_REQUEST['cUserName']);
	$firstName = mysqli_real_escape_string($link, $_REQUEST['cFirstName']);
	$lastName = mysqli_real_escape_string($link, $_REQUEST['cLastName']);
	$mob = mysqli_real_escape_string($link, $_REQUEST['cMobile']);
	$email = mysqli_real_escape_string($link, $_REQUEST['cEmail']);
	$pwd = mysqli_real_escape_string($link, $_REQUEST['cPwd']);
	
	$sql = "UPDATE user_details SET username='$userName', first_name='$firstName', last_name='$lastName', mobile_number='$mob', email='$email', password='$pwd' where username='$old' ";
	if(mysqli_query($link, $sql)){
		echo "<script>alert('Records updated successfully.');</script>";
	}
	
	$_SESSION['user'] = $userName;
	
	ob_start();
	header("Location: main.php");
	die("please die");
	
	mysqli_close($link);
?>