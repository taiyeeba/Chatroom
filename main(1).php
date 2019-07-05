<html>
	<head>	
		<link type="text/css" rel="stylesheet" href="style.css" />
		<style>
		#wrapper
		{
			background: rgba(130,130,130,.3);
			opacity: .4;
			
		 }
		#wrapper{
			opacity: 1.0;
			filter: alpha(opacity=100);
			background: rgba(244,239,239,.3);
			  position: relative;
		}
		#menu{
			background: rgba(130,130,130,.3);
			  position: relative;
		}
		.welcome{
			background: rgba(130,130,130,.3);
			  position: relative;
		}
		#chatbox{
			background: rgba(130,130,130,.3);
			  position: relative;
		}
		#bro{
			background: rgba(130,130,130,.3);
			  position: relative;
		}
		
		
		
		</style>
	</head>
	
	<?php 
		session_start();
		if($_SESSION['logged_in']!=true)
		{
			ob_start();
			header("Location: login.html");  
		}
		$_SESSION["disable"]=1;
	?>
	<body background= "chatting4.jpg" style= "background-repeat:no-repeat; background-size:1366px ;
	background-position: center center; background-size: cover; ">
		<center>
		<h1><div>Welcome to Chatroom </div></h1>
		<div style=" color:white; height: 50px; font-size:20px;">
		<br>
			<a href="update_profile.php" style="color: black;">Profile</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<a href="inbox.php" style="color: black;">Inbox</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<a href="profileView.php" style="color: black;">View Profile</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<!--<a href="list_pm.php" style="color: black;">Personal Message</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-->
			<a href="logout.php" style="color: black;">Log Out</a>
			
		</div>
		
		<br>
		
		<div id="wrapper">
			<div id="menu">
				<p class="welcome"><b style="color:#11079"><strong>Welcome </strong></b><b><?php echo $_SESSION['user']; ?></b></p>
				<div style="clear:both"></div>
			</div>
     
		<div id="chatbox">
			<?php
				/*if(file_exists("log.html") && filesize("log.html") > 0)
				{
					$handle = fopen("log.html", "r");
					$contents = fread($handle, filesize("log.html"));
					fclose($handle);
     
					echo $contents;
				}*/
			?>
		</div id="bro">
			
			<form name="message" method="post" action="http://localhost/Chat/post.php">
				<input name="usermsg" type="text" id="usermsg" size="63" />
				<input name="submitmsg" type="submit"  id="submitmsg" value="Send" />
				
				<input type="text" id="msg" name="msg" style="display: none;">
			</form>
		</div>
		
		
		
		</center>
		
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js"></script>
		<script type="text/javascript">
		
			// jQuery Document
			$(document).ready(function(){
				/*$("#exit").click(function(){
					var exit = confirm("Are you sure you want to end the session?");
					if(exit==true)
					{
						window.location = 'main.php?logout=true';
					}
				}*/
			
				var timeout = setInterval(reloadChat, 200);    
				function reloadChat () {
					//alert("pg reload");
					$('#chatbox').load('loadChat.php');
				}
			
				$("#submitmsg").click(function(){
					var clientmsg = $("#usermsg").val();
					$("#msg").val(clientmsg);
					//var a = $("#msg").val();
					//alert(a);
					$("#usermsg").attr("value", "");
					//return false;
					//loadLog();
				});
			
			});
			
			function loadLog()
			{
					alert("function called");
				var oldscrollHeight = $("#chatbox").attr("scrollHeight") - 20; //Scroll height before the request
				$.ajax({
					url: "log.html",
					cache: false,
					success: function(html){
						$("#chatbox").html(html); //Insert chat log into the #chatbox div	
				
						//Auto-scroll			
						var newscrollHeight = $("#chatbox").attr("scrollHeight") - 20; //Scroll height after the request
						if(newscrollHeight > oldscrollHeight)
						{
							$("#chatbox").animate({ scrollTop: newscrollHeight }, 'normal'); //Autoscroll to bottom of div
						}				
					},
				});
			}
		</script>
		
	</body>
</html>