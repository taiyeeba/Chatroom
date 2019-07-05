<?php
	session_start();
	if(isset($_SESSION['user']))
	{
		date_default_timezone_set('Asia/Calcutta');
		
		$text = $_REQUEST['msg'];
		//echo date('g:i A');
		$fp = fopen("log.html", 'a');
		fwrite($fp, "<div class='msgln'>(".date("g:i A").") <b>".$_SESSION['user']."</b>: ".stripslashes(htmlspecialchars($text))."<br></div>");
		fclose($fp);
		
		ob_start();
		header("Location: main.php");
	}
?>