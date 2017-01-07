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
$qUery = "SELECT * from `master` ORDER BY qid DESC";
$result = $conn->query($qUery);
$crow = $result->fetch_assoc();
$num = $crow['qid']+1;
$tname ="question$num";
// sql to create table
$sql = "CREATE TABLE $tname (
  `id` int(6) PRIMARY KEY AUTO_INCREMENT NOT NULL,
  `uid` int(6) DEFAULT NULL,
  `aname` varchar(30) NOT NULL,
  `acmmnt` LONGTEXT NOT NULL,
  `avote_up` int(6) NOT NULL DEFAULT '0',
  `avote_down` int(6) NOT NULL DEFAULT '0',
  `aqvote` int(6) NOT NULL DEFAULT '0',
  `reg_date` datetime DEFAULT NULL
)";

if ($conn->query($sql) === TRUE) {
 #   echo "Table $tname created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

$z;
$check=0;


if(isset($_POST['cat_name']) && $_POST['cat_name']!=''){
        $cat_nam=test_input($_POST['cat_name']);
        $cat_nam=mysqli_real_escape_string($conn,$cat_nam); 
        //write code to validate new category. cat_name



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

$v=date('Y-m-d h:i:s');
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

$sql = "INSERT INTO `master` (`uid`, `qname`, `question`, `cat_id`, `reg_date`, `vote_up`, `vote_down`, `qvote`, `ans`, `anonymous`) VALUES
('$k', '$name', '$x', '$z', '$v', 0, 0, 0, 0, '$anonymous')";

if ($conn->query($sql) === TRUE) {
   echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
header('Location: http://localhost/a/question/questions.php');
$conn->close();

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($datsa);
  return $data;
}

?>
