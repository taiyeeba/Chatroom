<?php

	session_start();
	
	$_SESSION['logged_in']=false;  
    session_destroy();  
	  
	ob_start();
	header("Location: login.html");
?>