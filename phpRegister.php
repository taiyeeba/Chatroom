<?php

$link = mysqli_connect("localhost", "root", "", "userinfo");

//check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

// Escape user inputs for security
$first_name = mysqli_real_escape_string($link, $_POST['firstName']);
$last_name = mysqli_real_escape_string($link, $_REQUEST['lastName']);
$mobile = mysqli_real_escape_string($link, $_REQUEST['mobileNumber']);
$email = mysqli_real_escape_string($link, $_REQUEST['email']);
$username = mysqli_real_escape_string($link, $_REQUEST['userName']);
$password = mysqli_real_escape_string($link, $_REQUEST['reg_pwd']);

$result = mysqli_query($link,"SELECT username FROM user_details where username='$username'");
if(mysqli_num_rows($result)==0)
{
	$ok=1;
}
else
	$ok=0;

if($ok==0)
{
	echo "<script>alert(\"Username already exists. Please try some other username\");
        window.location.href='registration.html'</script>";
}
else
{
	// attempt insert query execution
	$sql = "INSERT INTO user_details (first_name, last_name, mobile_number, email, username, password) VALUES ('$first_name', '$last_name', '$mobile', '$email', '$username', '$password')";
	if(mysqli_query($link, $sql)){
		ob_start();
		header("Location: login.html");
		die("pls die");
		//echo "<script> window.location.replace('D:\Taiyeeba\Mca\FYMCA\Mini_Project\Project\login.html') </script>";
		//echo "<br>try";
	} else{
		echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
	}
}
// close connection
mysqli_close($link);
?>

