<?php
session_start();

if(isset($_SESSION['user_name'])){
    $name = $_SESSION['user_name'];
}

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "questions";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
$num=1;
$query = "SELECT * from `master`";
    $result = $conn->query($query);
	 while($row = $result->fetch_assoc()) {
        $num++;   
	 }
$tname ="question$num";
// sql to create table
$sql = "CREATE TABLE $tname (
id INT(6) AUTO_INCREMENT PRIMARY KEY,
uid INT(6),
aname VARCHAR(30) NOT NULL,
acmmnt TEXT(255) NOT NULL,
avote_up INT(6) NOT NULL DEFAULT 0,
avote_down INT(6) NOT NULL DEFAULT 0,
aqvote INT(6) NOT NULL DEFAULT 0,

reg_date DATETIME
)";

if ($conn->query($sql) === TRUE) {
 #   echo "Table $tname created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

$z;
$check=0;


if(isset($_POST['cat_name'])){
        $cat_nam=test_input($_POST['cat_name']);
        $sql="INSERT INTO `categories`( `cat_name`) VALUES ('$cat_nam')";
   
        if ($conn->query($sql) === TRUE) {
  //  echo "New record created successfully";
    
        } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        }
    $sql ="SELECT * FROM `categories` WHERE cat_name='$cat_nam'";
     $result = $conn->query($sql);
     $row = $result->fetch_assoc();
    
    
    $GLOBALS['z']= $row['cat_id'];
    $check=1;
    // echo "fjdskjf";
    }
if(!empty($_POST["topics"])){  
   
      $count=0;
           foreach($_POST["topics"] as $var_topic)  
           {    global $count;
                
                  if( $count++>=1 || $GLOBALS['check']==1){
                  $GLOBALS['z']=$GLOBALS['z'].",".$var_topic;
                  echo "dijfdks";
                  }else {
                  $GLOBALS['z']= $var_topic;
                  }
           
           }  

}else{
  $GLOBALS['z']=1;
}
$k=$_SESSION['user_id'];
$x=$_POST['question'];
//$x= str_replace('"',"'",$x);
date_default_timezone_set("Asia/Kolkata");

$v=date('Y-m-d h:i:sa');
echo $v;
/*$sql="SELECT convert(varchar(19), getdate(), 100)";
$v= $conn->query($sql);
echo $v;
*/
$anonymous=0;
if(isset($_POST['anonymous'])){
  if($_POST['anonymous']=='on'){
  $anonymous=1;
}
}

//$sql = "INSERT INTO `master` ( `qname`,`question`,`uid`,`cat_id`,`reg_date`,`anonymous`) VALUES ('$name','$x','$k','$z','$v','$anonymous')";


if ($conn->query($sql) === TRUE) {
 #   echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
header('Location: http://localhost/a/news.php');
$conn->close();

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?>
