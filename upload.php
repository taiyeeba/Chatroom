<?php
	session_start();

	$target_dir = 'uploads/';
	$target_file =$target_dir. basename($_FILES["fileToUpload"]["name"]);
	$server_path = "C:/xampp/htdocs/Chat/Uploads/";
	$file = $server_path.basename($_FILES["fileToUpload"]["tmp_name"]);
	$name = basename($_FILES["fileToUpload"]["name"]);
	chmod($server_path,777);
	$uploadOk = 1;
	//$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
	
	/*if(file_exists($target_file))
	{
		echo "Sorry the file already exists<br>";
		$uploadOk = 0;
	}*/
	
	if($uploadOk==0)
		echo "sorry your file was not uploaded";
	else
	{
		move_uploaded_file($_FILES["fileToUpload"]["tmp_name"],$target_file);
		if(copy($target_file,$file))
		{
			echo "Your file was uploaded successfully...!!!";
			//echo "$file";
			//http://localhost/Chat/upload.php
			$path = "http://172.16.90.23:81/Chat/Uploads/".basename($_FILES["fileToUpload"]["tmp_name"]);
			$user = $_SESSION["sendTo"];
			
			
			$handle = fopen($user.".html", "a");
			//fwrite($handle, "<div>File Name: ".$name." <a href='".$path. "'><input type='button' value='Download'></a> <br> </div>");
			fwrite($handle, "<tr> <td>".$name."</td> <td>".$_SESSION['user']. "</td> <td><a href='".$path. "'><input type='button' value='Download'></a></td> </tr>");
			fclose($handle);
			echo "</table>";
			
			header("Location: inbox.php");
		}
	}
	
?>