<html>
	<head>
    
        <style>
        table {
    width:75%;
}
table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
}
th, td {
    padding: 5px;
    text-align: left;
}
table#t01 tr:nth-child(even) {
    background-color: powderblue;
}
table#t01 tr:nth-child(odd) {
   background-color:#fff;
}
table#t01 th {
    /*background-color: beige;
    color: black;*/
}
.button {
    background-color: #3e79b5;
    border: none;
    color: white;
    padding: 5px 16px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 14px;
    margin: 4px 2px;
    /*cursor: pointer;*/
}
</style>
    
    </head>
	
	<body bgcolor="#E6E6FA">
	
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
            
			<input type="submit" class="button" name="search" value="Search" onclick="submitForm('searchUser.php')"><br><br><br>
            
			<input type="file" name="fileToUpload" class="button" id="fileToUpload">
            
			<input type="submit" class="button" value="Upload Image" name="upload" id="upload" onclick="submitForm('upload.php')">
			<!--<div id="ib"></div>-->
			<div id="inbox"><br><br><br>
				<b>Inbox</b><br>
				<table border="1" id="t01">
                    <tr> <th>FILE NAME </th> <th>SENT BY USER</th> <th>DOWNLOAD</th></tr>
                    <!--<tr> <td>chat.jpg </td> <td>as</td> <td>yes </td></tr>
                    <tr> <td>chat.jpg </td> <td>as</td> <td>yes </td></tr>
                    <tr> <td>chat.jpg </td> <td>as</td> <td>yes </td></tr>
                    <tr> <td>chat.jpg </td> <td>as</td> <td>yes </td></tr>
                    <tr> <td>chat.jpg </td> <td>as</td> <td>yes </td></tr>-->
				<?php
					$user = $_SESSION['user'];
					if(file_exists($user.".html") && filesize($user.".html") > 0)
					{
						$handle = fopen($user.".html", "r+");
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