<html>
<head>
<link href="materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
</head>
</html>
<?php
// Array with names

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


$sql = "SELECT * FROM `categories`";
$result = mysqli_query($conn,$sql);
while($row = $result->fetch_assoc()){
    $a[]=$row['cat_name'];
}
// get the q parameter from URL
$q = $_REQUEST["q"];

$hint= array();

// lookup all hints from array if $q is different from "" 
if ($q !== "") {
    $q = strtolower($q);
    $len=strlen($q);
    foreach($a as $name) {
        if (stristr($q, substr($name, 0, $len))) {

                $hint[] = $name;
            
        }
    }
}

// Output "no suggestion" if no hint was found or output correct values 
$length=count($hint);

if(empty($hint)){echo "no suggestion";
}else{

for($x=0;$x<$length;$x++)
  {
            $sq = "SELECT cat_id FROM `categories` WHERE cat_name='$hint[$x]'";
            $resul = mysqli_query($conn,$sq);
            $ro = $resul->fetch_assoc();
                $temp=$ro['cat_id'];

            echo  "<div class='chip' id='myBtn' onclick='showUser(".$temp.")'>".$hint[$x]."</div>";
            //echo $temp;
}
}
?>