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
table#t tr:nth-child(even) {
    background-color: powderblue;
}
table#t tr:nth-child(odd) {
   background-color:#fff;
}
table#t th {
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
		<center>
		<form method="post" action="">
			<table>
				<tr>
					<td>Enter User Name: </td>
					<td><input type="text" id="username" name="username"></td>
					<td><input type="submit" value="Search"></td>
				</tr>
			</table>
			<br><br>
			<table id="t" style="display:none;">
				<tr>
					<td>User Name: </td>
					<td><p id="p1"></p></td>
				</tr>
				<tr>
					<td>First Name: </td>
					<td><p id="p2"></p></td>
				</tr>
				<tr>
					<td>Last Name: </td>
					<td><p id="p3"></p></td>
				</tr>
				<tr>
					<td>Mobile Number: </td>
					<td><p id="p4"></p></td>
				</tr>
				<tr>
					<td>Email ID: </td>
					<td><p id="p5"></p></td>
				</tr>
			</table>
			</form>
		</center>
	</body>
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script>
	<?php
	if($_SERVER['REQUEST_METHOD']=='POST')
	{
			//echo "<script>";
			$link = mysqli_connect("localhost","root","","userinfo");
		
			$username = $_REQUEST['username'];
			$sql = "SELECT * FROM user_details WHERE username='$username'";
			$result = mysqli_query($link,$sql);
		
			if(mysqli_num_rows($result)==0)
			{
				echo "alert('Username doesn\'t exsist')";
			}
			else
			{
				echo "$('#username').val('$username');";
				
				$row = mysqli_fetch_array($result);
				$fn = $row["first_name"];
				$ln = $row["last_name"];
				$mob = $row["mobile_number"];
				$email = $row["email"];
				
				echo "$('#t').show();";
				echo "$('#p1').text('$username');";
				echo "$('#p2').text('$fn');";
				echo "$('#p3').text('$ln');";
				echo "$('#p4').text('$mob');";
				echo "$('#p5').text('$email');";
			}
		
			mysqli_close($link);
			//echo "</script>";
		}
	?>
	</script>
</html>

