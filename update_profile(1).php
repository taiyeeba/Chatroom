<html>
	<head>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<?php 
			session_start();
			/*if($_SESSION['logged_in'])!=true)
			{
				ob_start();
				header("Location: login.php");  
			}*/
		?>
	</head>
	
	<body>
	<center>
		<form id="form" method="post">
		<table>
			<tr>
				<td>User Name: </td>
				<td><p id="p1"></p></td>
				<td colspan="2"><input type="button" onClick="changeUserName()" value="Edit"></td>
			</tr>
			<tr>
				<td>First Name: </td>
				<td><p id="p2"></p></td>
				<td colspan="2"><input type="button" onClick="changeFirstName()" value="Edit"></td>
			</tr>
			<tr>
				<td>Last Name: </td>
				<td><p id="p3"></p></td>
				<td colspan="2"><input type="button" onClick="changeLastName()" value="Edit"></td>
			</tr>
			<tr>
				<td>Mobile Number: </td>
				<td><p id="p4"></p></td>
				<td colspan="2"><input type="button" onClick="changeMobNo()" value="Edit"></td>
			</tr>
			<tr>
				<td>Email ID: </td>
				<td><p id="p5"></p></td>
				<td colspan="2"><input type="button" onClick="changeEmail()" value="Edit"></td>
			</tr>
			<tr>
				<td>Password: </td>
				<td><p id="p6"></p></td>
				<td colspan="2"><input type="button" onClick="changePassword()" value="Edit"></td>
			</tr>
			<tr>
				<td colspan="2" align="center"><input type="Submit" onclick="submitForm('updateSave.php')" value="Save"></td>
				<td colspan="2" align="center"><input type="button" onclick="delConfirm()" value="Delete"></td>
			</tr>
		</table>
		<input type="text" name="cUserName" id="cUserName" style="display: none;">
		<input type="text" name="cFirstName" id="cFirstName" style="display: none;">
		<input type="text" name="cLastName" id="cLastName" style="display: none;">
		<input type="text" name="cMobile" id="cMobile" style="display: none;">
		<input type="text" name="cEmail" id="cEmail" style="display: none;">
		<input type="text" name="cPwd" id="cPwd" style="display: none;">
		</form>
	</center>
	
	
	
		<script>
			<?php
				$link = mysqli_connect("localhost", "root", "", "userinfo");

				//check connection
				if($link === false){
					die("ERROR: Could not connect. " . mysqli_connect_error());
				}
				
				$u = $_SESSION['user'];
				$query = mysqli_query($link, "SELECT first_name, last_name, mobile_number, email, password FROM user_details where userName='$u';");
				$row = mysqli_fetch_array($query);
				$_SESSION["fName"] = $row['first_name'];
				$_SESSION["lName"] = $row['last_name'];
				$_SESSION["mob"] = $row['mobile_number'];
				$_SESSION["email"] = $row['email'];
				$_SESSION["password"] = $row['password'];		
				
				mysqli_close($link);
			?>

			var un = "<?php echo $_SESSION['user'];?>";
			var fn = "<?php echo $_SESSION['fName'];?>";
			var ln = "<?php echo $_SESSION['lName'];?>";
			var m = "<?php echo $_SESSION['mob'];?>";
			var email = "<?php echo $_SESSION['email'];?>";
			var pwd = "<?php echo $_SESSION['password'];?>";
			
			$(document).ready(function(){			
				$("#p1").text(un);
				$("#p2").text(fn);
				$("#p3").text(ln);
				$("#p4").text(m);
				$("#p5").text(email);
				$("#p6").text("****");
			});	
			
			document.getElementById("cUserName").value = un;
			document.getElementById("cFirstName").value = fn;
			document.getElementById("cLastName").value = ln;
			document.getElementById("cMobile").value = m;	
			document.getElementById("cEmail").value = email;
			document.getElementById("cPwd").value = pwd;
			
			var userName, firstName, lastName, mob_num, Email, password;
			
			function changeUserName()
			{
				userName = prompt("Please Enter Your New User Name:");
				if(userName)
				{
					document.getElementById("p1").innerHTML = userName;				
					document.getElementById("cUserName").value = userName;
				}
				else
				{
					$("#p1").text(un);
				}
			}
			
			function changeFirstName()
			{
				firstName = prompt("Please Enter Your New First Name:");
				if(firstName)
				{
					document.getElementById("p2").innerHTML = firstName;				
					document.getElementById("cFirstName").value = firstName;
				}
				else
					$("#p2").text(fn);
			}
			
			function changeLastName()
			{
				lastName = prompt("Please Enter Your New Last Name:");
				if(lastName)
				{
					document.getElementById("p3").innerHTML = lastName;				
					document.getElementById("cLastName").value = lastName;
				}
				else
					$("#p3").text(ln);
			}
			
			function changeMobNo()
			{
				mob_num = prompt("Please Enter Your New Mobile Number:");
				if(mob_num)
				{
					document.getElementById("p4").innerHTML = mob_num;				
					document.getElementById("cMobile").value = mob_num;
				}
				else
					$("#p4").text(m);					
			}
			
			
			function changeEmail()
			{
				Email = prompt("Please Enter Your New Email ID:");
				if(Email)
				{
					document.getElementById("p5").innerHTML = Email;				
					document.getElementById("cEmail").value = Email;
				}
				else
					$("#p5").text(email);
			}
			
			
			function changePassword()
			{
				var old = prompt("Please Enter Your Old Password:");
				if(old)
				{
					if(old==pwd)
					{
						password = prompt("Please Enter Your New Password");
						var confirm = prompt("Please Retype Your New Password");
						if(password == confirm)
						{
							document.getElementById("p6").innerHTML = password;				
							document.getElementById("cPwd").value = password;
						}
						else
						{
							alert("Retyped password doesn't match");
						}
					}
					else
					{
						alert("Sorry, Wrong Password...!!!");
					}	
				}
				else
					$("#p6").text("****");
			}
			function submitForm(action)
			{
				if(confirm("Are You Sure You Want To Save The Changes...???")==true)
				{
					document.getElementById('form').action = action;
					document.getElementById('form').submit();
				}
				else
				{
					$("#p1").text(un);
					$("#p2").text(fn);
					$("#p3").text(ln);
					$("#p4").text(m);
					$("#p5").text(email);
					$("#p6").text("****");
				}
			}
			
			function delConfirm()
			{
				if(confirm("Are You Sure You Want to Delete Your Account..??")==true)
				{
						document.location.href = 'http://localhost/Chat/delete.php';
				}
			}

			
			
		</script>
	
	</body>
</html>