<?php
	$link = mysqli_connect("localhost", "root", "", "userinfo");

	//check connection
	if($link === false){
		die("ERROR: Could not connect. " . mysqli_connect_error());
	}

	session_start(); 
	$old= $_SESSION['user'];
	
	$sql = "DELETE FROM user_details where username='$old'";
	mysqli_query($link, $sql);
	
	session_destroy();
	mysqli_close($link);
	
	ob_start();
	header("Location: login.html");
?>