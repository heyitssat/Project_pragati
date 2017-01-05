<!DOCTYPE html>
<html>


<head>
<link href="materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
</head>
<body>

<?php
session_start();
$q = intval($_GET['q']);


 $servername = "localhost";
  $username = "root";
  $database = "questions";
  $password = "";

  // Create connection
  $conn = new mysqli($servername, $username, $password, $database);

  // Check connection
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }
//echo $q;

$sql = "SELECT * FROM `categories` WHERE cat_id='".$q."'";
$result = mysqli_query($conn,$sql);
$ro = $result->fetch_assoc();



//to update the fav tags
$value= strval($q);
$sap=$_SESSION['user_id'];

    $sql= "SELECT fav_tags FROM users WHERE user_id=$sap";
    $result = mysqli_query($conn,$sql);
    $row = $result->fetch_assoc();
        $fav_tags=$row['fav_tags'];
$u=0;
if(isset($row['fav_tags']) && $row['fav_tags'] !='' ){
            if (check($fav_tags,$value) == false){
              //  echo "adg";
                $fav_tags=$fav_tags.",".$value;
            }else{
                        $u=1;
                //if u want to say something "it is already selected"
            }

}else{
    $fav_tags=$value;
}

$sql="UPDATE `users` SET `fav_tags`= '$fav_tags' WHERE user_id=$sap";           //inverted commas had to be used in '$fav_tags' as it is string
                     
if($conn->query($sql)  && $u!=1){
               //to display
echo "<div class='collection' style='margin:10px;margin-top:50px'>";
    
    echo "<a class='collection-item active'>" . $ro['cat_name'] . "</a>";

echo "</div>";
}

function check($tag,$tag_id){
         $arr=explode(",",$tag);
           $l=count($arr);
           $i=0;
        while($l--){
          if($tag_id== $arr[$i]){
            return true;
          }
            $i++;
          }
return false;
}



mysqli_close($conn);
?>
</body>
</html>