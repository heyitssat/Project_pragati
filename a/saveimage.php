<?php
$servername = "localhost";
$username = "root";
$database="aryan";
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
		$target_path = "images/".$imagename;
		if(move_uploaded_file($temp_name, $target_path))
		{
		    $query_upload="INSERT into image1(image_sour,u_date)
			VALUES('".$target_path."','".date("Y-m-d")."')";
			
			
			if($conn->query($query_upload) === true)
			{ 
			echo"Image Upload Successfully";
			}
			else{echo "error in uploading";}
   		}
		else
		{
				exit("Error While uploading image on the server");
		}
	}
	

 

?>
