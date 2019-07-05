<?php
	echo "<script>";
					
					$link = mysqli_connect("localhost", "root", "", "userinfo");
					//check connection
					if($link === false){
						die("ERROR: Could not connect. " . mysqli_connect_error());
					}
					$username = $_REQUEST['username'];
					
					$sql="SELECT username FROM user_details WHERE username='$username' ";
					$q = mysqli_query($link,$sql);
					if( !$q || mysqli_num_rows($q)==0 )
					{
						echo "alert('User Not Found. Please type the username correctly');
								window.location.href='inbox.php'";
					}
					else
					{
						//echo "alert('work');";
						//echo "$(ib).append('<input type=\"file\" name=\"fileToUpload\" id=\"fileToUpload\" />');";
						//echo "$(ib).append('<input type=\"button\" value=\"Send\"  id=\"send\" />');";
						//echo "document.getElementById(\"upload\").enabled=true;";
						
						session_start();
						$_SESSION['sendTo']=$username;
						$_SESSION['disable']=0;
						ob_start();
						header("Location: inbox.php");
					}
	echo "</script>";
					
					
				
?>