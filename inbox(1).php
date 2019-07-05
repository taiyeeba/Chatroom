<html>
	<head></head>
	
	<body>
	
		<?php 
			session_start();
			if($_SESSION['logged_in']!=true)
			{
				ob_start();
				header("Location: login.html");  
			}
		?>
		
		<!--<form action="" method="post" enctype="multipart/form-data">
			Select image to upload:
			<input type="file" name="fileToUpload" id="fileToUpload">
			<input type="button" value="Upload Image" name="upload" onclick="checkUser()">
		</form>-->
		
		<form action="" method="post" enctype="multipart/form-data" id="form">
		Type username you want to send file to: 
			<input type="text" name="username" id="username">
			<input type="submit" name="search" value="Search" onclick="submitForm('searchUser.php')"><br><br><br>
			<input type="file" name="fileToUpload" id="fileToUpload">
			<input type="submit" value="Upload Image" name="upload" id="upload" onclick="submitForm('upload.php')">
			<!--<div id="ib"></div>-->
			<div id="inbox"><br><br><br>
				<b>Inbox</b><br>
				<table border="1"><tr> <th>FILE NAME </th> <th>SENT BY USER</th> <th>DOWNLOAD</th></tr>
				<?php
					$user = $_SESSION['user'];
					if(file_exists($user.".html") && filesize($user.".html") > 0)
					{
						$handle = fopen($user.".html", "r");
						$contents = fread($handle, filesize($user.".html"));
						fclose($handle);
     
						echo $contents;
					}
				?>
			</div>
		</form>
		
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js"></script>
		
		<script>		
			var btn_status = "<?php echo $_SESSION['disable']; ?>";
			
			if(btn_status==1)
				document.getElementById("upload").disabled=true;
			else
			{
				$('#upload').removeAttr('disabled');
				<?php $_SESSION['disable']=1; ?>
				$("#username").val("<?php echo $_SESSION['sendTo'];?>");
			}
			
			function submitForm(action)
			{
					document.getElementById('form').action = action;
					document.getElementById('form').submit();
			}
			
		</script>
		
	</body>
</html>