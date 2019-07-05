<?php

$link = mysqli_connect("localhost", "root", "", "userinfo");

//check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

session_start();

//Fetch username and password from login form
$user_name = mysqli_real_escape_string($link, $_POST['userName']);
$password = mysqli_real_escape_string($link, $_POST['pwd']);
$_SESSION["user"]=$user_name;


$sql = "SELECT username and password FROM user_details where username='$user_name' and password='$password'";
$q = mysqli_query($link, $sql);
if (!$q || mysqli_num_rows($q)==0)
{
	echo "<script>alert(\"Username or password incorrect. Please try again\");
        window.location.href='login.html'</script>";
	//ob_start();
	//header("Location: login.html");
	//header( "refresh:5; url=login.html" );
	//die("pls die");
}
else
{
	$_SESSION["logged_in"]=true;
	ob_start();
	header("Location: main.php");
	die("pls die");
}

//Close The Connection
mysqli_close($link);
?>