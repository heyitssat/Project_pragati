<?php
$servername = "localhost";
$username = "root";
$database="questions";
$password = "";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);


function GetImageExtension($imagetype)
{
       if(empty($imagetype)) return false;
       switch($imagetype)
       {
           case 'image/bmp': return '.bmp';
           case 'image/gif': return '.gif';
           case 'image/jpeg': return '.jpg';
           case 'image/png': return '.png';
           default:
		   return false;

       }

}
    
	if (!empty($_FILES["uploadedimage"]["name"])) 
	{
		$file_name=$_FILES["uploadedimage"]["name"];
		$temp_name=$_FILES["uploadedimage"]["tmp_name"];
		$imgtype=$_FILES["uploadedimage"]["type"];
		$ext= GetImageExtension($imgtype);
		$imagename=date("d-m-Y")."-".time().$ext;
		$target_path = "http://localhost/a/useraccount/images/".$imagename;
		if(move_uploaded_file($temp_name, $target_path))
		{
		    $query_upload="INSERT into users(user_pic)
			VALUES('".$target_path."')";
			
			
			if($conn->query($query_upload) === true)
			{ echo "1";
			//header("location:useraccount.php");
			}else{
			// write not uploaded here.
			//header("location:useraccount.php");
			}
				echo "2";
   		}
		else
		{	echo "string";
				//write can't upload
				//header("location:useraccount.php");
		}
	}else{
		//write select a file
		header('Location: http://localhost/a/useraccount/useraccount.php');
	}
	

 

?>
