<?php
include "header2.php";
?>

<?php
session_start();
if(isset($_GET['qid'])){
$pid = $_GET['qid'];}else{
  header('Location:http://localhost/a/question/questions.php');
}
//  create connection

$servername = "localhost";
  $username = "root";
  $database = "questions";
  $password = "";

  // Create connection
  $conn = new mysqli($servername, $username, $password, $database);

  // http://localhost/a/check.phpnection
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }


?>



<?php

//to vote
if(isset($_GET['vote'])){

    echo "Dbg vote is set.";

            $vote=intval($_GET['vote']);
        // comment id is cid
            if(isset($_GET['cid'])){
                $cid=$_GET['cid'];
                echo "Dbg comment is voted.";}
                        
                        $sql= "SELECT * FROM master WHERE qid=$pid";
                        $result = mysqli_query($conn,$sql);
                        $question = $result->fetch_assoc();
                   
                    if(isset($_GET['cid'])){
                       
                        $sqla= "SELECT * FROM question$pid WHERE id=$cid";
                        $resulta = mysqli_query($conn,$sqla);
                        $comment = $resulta->fetch_assoc();
                   
                    }

                        echo $pid;
            if($vote==1){

                echo "Dbg vote to be increase.";
                    if(isset($_SESSION['signed_in'])){
                        $sid=$_SESSION['user_id'];

                      if(!isset($_GET['cid']))
                        { $Query= "SELECT * from `likes` WHERE question_id=$pid AND user_id=$_SESSION[user_id] AND comment_id is NULL ";}else{
                        $Query= "SELECT * from `likes` WHERE question_id=$pid AND user_id=$_SESSION[user_id] AND comment_id = $cid";
                      }
                      
                        $Result = $conn->query($Query);
                        $Row = $Result->fetch_assoc();
                        $rowcount=mysqli_num_rows($Result);
                        if(!$rowcount){
                            echo "Dbg rowcount is 0"; 
                            if(isset($_GET['cid'])){
                                            $nvote=intval($comment['aqvote']);                                   
                                            $v=$comment['avote_up'];
                                            $v++;
                                            $nvote++;
                                               
                                            echo $v;
                                             $sql="UPDATE `question$pid` SET `avote_up`= '$v' WHERE id=$cid";
                                                if($conn->query($sql)){
                                        echo "  updated ";
                                                      }
                                                                
                                           $sql="UPDATE `question$pid` SET `aqvote`= '$nvote' WHERE id=$cid";
                                                         
                                            if($conn->query($sql)){
                                                        echo "  updated ";
                                            }

                                        // insert in the likes table
                                        //comment voted

                                        $sql = "INSERT INTO `likes` ( `user_id`,`question_id`,`comment_id`) VALUES ($sid,$pid,$cid)";
                                      //  $result = mysqli_query($conn,$sql);
                                         if($conn->query($sql)){
                                                    echo "  inserted ";
                                                }

                            } else {


                                            $nvote=intval($question['qvote']);
                                            $v=$question['vote_up'];
                                            $v++;
                                            $nvote++;
                                               
                                            echo $v;
                                             $sql="UPDATE `master` SET `vote_up`= '$v' WHERE qid=$pid";
                                                if($conn->query($sql)){
                                        echo "  updated ";
                                                      }

                                           $sql="UPDATE `master` SET `qvote`= '$nvote' WHERE qid=$pid";
                                                         
                                            if($conn->query($sql)){
                                                        echo "  updated ";
                                            }
                                        // insert in the likes table
                                        //comment voted

                                        $sql = "INSERT INTO likes ( `question_id`,`comment_id`,`user_id`) VALUES ($pid,NULL,$sid)";
 //                                       $result = mysqli_query($conn,$sql);
                                       if($conn->query($sql)){
                                                        echo "  inserted ";
                                                    }
                                # question voted
                            }
                        }
                      }   //close http://localhost/a/check.phpsion                     

                    }else if($vote==0){
                        echo "Dbg vote to be decreased";

                        if(isset($_SESSION['signed_in'])){
                            $sid=$_SESSION['user_id'];

                          if(!isset($_GET['cid'])){ $Query= "SELECT * from `likes` WHERE question_id=$pid AND user_id=$_SESSION[user_id] AND comment_id is NULL ";}else{
                            $Query= "SELECT * from `likes` WHERE question_id=$pid AND user_id=$_SESSION[user_id] AND comment_id = $cid";
                          }
                          
                            $Result = $conn->query($Query);
                            $Row = $Result->fetch_assoc();
                            $rowcount=mysqli_num_rows($Result);
                            if($rowcount){


                                if(isset($_GET['cid'])){
                                            $nvote=intval($comment['aqvote']);
                                            $v=$comment['avote_down'];    
                                             $v++;
                                             $nvote--;
                                               
                                             $sql="UPDATE `question$pid` SET `avote_down`= '$v' WHERE id=$cid";
                                             if($conn->query($sql)){
                                                    echo "  updated ";
                                                }

                                               $sql="UPDATE `question$pid` SET `aqvote`= '$nvote' WHERE id=$cid";
                                                             
                                                if($conn->query($sql)){
                                                            echo "  updated ";
                                                }

                                            $sql = "DELETE FROM likes WHERE question_id=$pid AND user_id=$_SESSION[user_id] AND comment_id = $cid";
                                            $result = mysqli_query($conn,$sql);
                                            //delete the row in likes
                                }else{
                                            $nvote=intval($question['qvote']);
                                            $v=$question['vote_down'];    
                                             $v++;
                                             $nvote--;
                                               
                                             $sql="UPDATE `master` SET `vote_down`= '$v' WHERE qid=$pid";
                                             if($conn->query($sql)){
                                                    echo "  updated ";
                                                }

                                           $sql="UPDATE `master` SET `qvote`= '$nvote' WHERE qid=$pid";
                                                         
                                            if($conn->query($sql)){
                                                        echo "  updated ";
                                            }

                                            $sql = "DELETE FROM likes WHERE question_id=$pid AND user_id=$_SESSION[user_id] AND comment_id is NULL";
                                                $result = mysqli_query($conn,$sql);
                                            //delete the row in likes
                                }
                            }
                        }// close http://localhost/a/check.phpsion
                 } 

}


// to delete 

if(isset($_GET['x'])){   
    if(!isset($_SESSION['signed_in'])) {
    echo "<p class='error_message'>Oops!You are not signed in!</p> <a href='http://localhost/a/reg/reg.php'> Click here </a>to sign in.<br>";
  }
  else {
    
    #echo "x is set";
        $change= $_GET['x'];
        #echo "$change is change";
//to delete the comment
            if($change=='2'){            
            $sid=$_GET['t'];
            #echo $pid;
            #echo $sid;
            $sql= "SELECT uid FROM question$pid WHERE id='$sid'";
              $result = mysqli_query($conn,$sql);
              $row = $result->fetch_assoc();
                $id=$row['uid'];



                $nowid= $_SESSION['user_id'];
            if($id==$nowid || ($_SESSION['user_level']==1)){
                                        $sql = "DELETE FROM question$pid WHERE id='$sid'";
                         if($conn->query($sql)){

                        #echo "comment deleted ";
                                }

                          $sql= "SELECT ans FROM master WHERE qid=$pid";
                            $result = mysqli_query($conn,$sql);
                            $row = $result->fetch_assoc();
                                $asr=$row['ans'];
                                echo $asr;
                                echo "dkjdkj";
                            $asr--;
                            echo $asr;
                            echo $pid;
                        $sql="UPDATE `master` SET `ans`= $asr WHERE qid=$pid";
                                             
                                        if($conn->query($sql)){
                        echo "  updated ";
                                }
                                   


   
  $qUery = "SELECT * from `master` ORDER BY qid DESC";
  $result = $conn->query($qUery);
   $crow = $result->fetch_assoc();
    $y= $crow['qid'];
    $y++;
                                        $sql="ALTER TABLE `question$pid` AUTO_INCREMENT = $y";
                                
                                if($conn->query($sql)){
                        #echo "auto increment updated";
                                }




       //   header('Location: http://localhost/answer/answer.php?qid=$pid');                           
          header('Location: http://localhost/a/question/questions.php');                           
   }else{ echo" <p class='error_message' >You don't have permission to delete it!</p>";}             
       
            }else if($change=='1'){                                     // to delete the question
        
              $sql= "SELECT uid FROM master WHERE qid='$pid'";
              $result = mysqli_query($conn,$sql);
              $row = $result->fetch_assoc();
                $id=$row['uid'];
                $nowid= $_SESSION['user_id'];
            if(($id==$nowid) || ($_SESSION['user_level']==1)){
            
                $sql = "DELETE FROM master WHERE qid='$pid'";
            if($conn->query($sql)){
                #echo "question deleted ";
                }

            $rown=0;    
            $query = "SELECT * from `master`";
            $result = $conn->query($query);
     while($row = $result->fetch_assoc()) {
            $rown++;   
   }                
                  
  $qUery = "SELECT * from `master` ORDER BY qid DESC";
  $result = $conn->query($qUery);
   $crow = $result->fetch_assoc();
    $y= $crow['qid'];
    $y++;
                $sql="ALTER TABLE `master` AUTO_INCREMENT = $y";
if($conn->query($sql)){
#echo "auto increment updated";
}
                $pql = "DROP TABLE question$pid";
if($conn->query($pql)){
#echo "table question$pid dropped";
}


                header('Location: http://localhost/a/question/questions.php');
            }else{
                echo "<p class='error_message'>You don't have right to delete this content.</p>";
                }
            }
    }
    }        
// selecting the row
    $query = "SELECT * from `master` WHERE qid=$pid ";
    $result = $conn->query($query);
    $row = $result->fetch_assoc();
/*    $no = 0;
while($no<=$pid) {
    $row = $result->fetch_assoc();
    $no++;
    }
    */
?>
    <?php                                               //to insert the comments
    
    if ($_SERVER["REQUEST_METHOD"] == "POST" ) {
    echo "chedjck";
        if(!isset($_SESSION['signed_in'])) {
            header('Location: http://localhost/a/reg/reg.php?error=1');
  }
  else {echo "string";
    $b=$_POST['cmmnt'];
    echo $b;
    $a=$_SESSION['user_name'];
    $c=$_SESSION['user_id'];
echo "string";
  $sql= "SELECT ans FROM master WHERE qid=$pid";
    $result = mysqli_query($conn,$sql);
    $row = $result->fetch_assoc();
        $ansr=$row['ans'];
        echo $ansr;
        echo "dkjdkj";
    $ansr++;
    echo $ansr;
    echo $pid;
$sql="UPDATE `master` SET `ans`= $ansr WHERE qid=$pid";
                     
                if($conn->query($sql)){
echo "  updated ";
}
$sap=$_SESSION['user_id'];

    $sql= "SELECT qans FROM users WHERE user_id=$sap";
    $result = mysqli_query($conn,$sql);
    $row = $result->fetch_assoc();
        $qans=$row['qans'];
        echo $qans;
        echo "sjfkaj";


if(!(is_null($row['qans'])) ){    
        if (strpos($row['qans'], $pid) === false){
                    echo "adg";
                        $qans=$qans.",".$pid;
                echo $qans;
                    echo $pid;
                $sql="UPDATE `users` SET `qans`= '$qans' WHERE user_id=$sap";           //inverted commas had to be used in '$qans' as it is string
                                     
                if($conn->query($sql)){
                                echo "  updated ";
                }
            
        }
            
}else{
    $qans=$pid;

    echo $qans;
    echo $pid;
$sql="UPDATE `users` SET `qans`= '$qans' WHERE user_id=$sap";           //inverted commas had to be used in '$qans' as it is string
                     
if($conn->query($sql)){
                echo "  updated ";
}
}
           

date_default_timezone_set("Asia/Kolkata");

    $v= date('Y-m-d h:i:s');
  //  $sql="INSERT INTO `question$pid`( `aname`, `acmmnt`,`uid`,`reg_date`) VALUES ('$a','$b','$c','$v')";
   $sql="INSERT INTO `question$pid` (`uid`, `aname`, `acmmnt`, `avote_up`, `avote_down`, `aqvote`, `reg_date`) VALUES
('$c', '$a', '$b', 0, 0, 0, '$v');
";
   if ($conn->query($sql) === TRUE) {
    #echo "New record created successfully";
    header('Location: ');
    
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
        
    
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Pragati</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<link rel="stylesheet" href="styles/style.css" media="screen">
<link rel="stylesheet" href="styles/media-queries.css">
<link rel="stylesheet" href="flex-slider/flexslider.css" type="text/css" media="screen">


  <link href="materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
<script src="ckeditor/ckeditor.js"></script>

</head>
<body>
<div id="wrap">


      <div class="fixed-action-btn horizontal" style="top: 120px; right: 24px;">
    <a href="http://localhost/a/qpost/qpost.php" class="btn-floating btn-large red">
      <img src='discuss.png' alt='discuss' class='responsive-img'>
    </a>
  </div>

  <div class="fixed-action-btn horizontal" style="bottom: 10px; right: 24px;">
    <a href="http://localhost/a/useraccount/useraccount.php" class="btn-floating btn-large red">
      <img src='account.png' alt='my account' class='responsive-img'>
    </a>
  </div>
  <!-- wrapper -->
  <div id="sidebar" style="overflow:auto">
  <form method='post' action="" id='a'>
    <center>
            <div style="margin:5px;"><textarea name='cmmnt' class='ckeditor' required style='width:100%' rows="2"></textarea></div>
        
    <br>
            <div style="margin:10px;"><button class="btn waves-effect waves-light" type="submit" name="action" style="width:100%">
            SUBMIT
            </button></div>

    </center>
    </form>

<?php 
// fetch the question
 $query = "SELECT * from `master` WHERE qid= $pid";
 $result = $conn->query($query);
 $row = $result->fetch_assoc();

?>      

  </div>
<div id="container">
    <!-- page container -->
 <div class="page" id="home">
 
 <div class="row" style="margin-left:10px">
     <strong><i>
     <div class="col s4">POSTED BY:<?php 
   if($row['anonymous'] =='0'){
   echo "$row[qname]";}
    else{ echo "anonymous"; }
 ?></div>
     <div class="col s2"></div>
     
     <div class="col s4"><?php echo "$row[reg_date]";?></div><div class="col s2"><a class="waves-effect"><i class="material-icons left">  <?php  if(isset($_SESSION['user_name']) && $_SESSION['user_name']==$row['qname']){
       
                    echo "<a role='button' class='btn btn-succes'href='http://localhost/a/check.php?s=2&qid=$pid&x=1' >Delete</a>";}?></i></a></div>
     </i></strong>
  </div>
  <div class="row" style="margin-left:10px">
  <h1 style="font-family:Cooper Black;font-size:200%;"><?php echo "$row[question]";?></h1>
  </div>
  <div class="row" style="margin-left:10px">
  
  <div class="col s8 l4 m4"><div class="col s8">
<?php
$pid=$row['qid'];
 // vote the question
// if already like show vote down else up
if(isset($_SESSION['signed_in'])){
    $Query= "SELECT * from `likes` WHERE question_id=$pid AND user_id=$_SESSION[user_id] AND comment_id is NULL ";
    $Result = $conn->query($Query);
    $Row = $Result->fetch_assoc();
    $rowcount=mysqli_num_rows($Result);
         
    if(!$rowcount){
         echo "<a href='answer.php?vote=1&qid=$pid'>
               <img src='like.png' alt='upvote' class='responsive-img' style='width:50%'>
            </a>";

     }else{
         echo "<a href='answer.php?vote=0&qid=$pid'>
               <img src='unlike.png' alt='downvote' class='responsive-img' style='width:50%' >
            </a>";
     }
}
      ?>

  




  </div><div class="col s4" style="bottom: 0px;"><?php echo "$row[qvote]";?></div></div>
     <div class="col s4"><?php echo "No Of Ans:&nbsp;&nbsp;&nbsp;$row[ans]";?></div>
     <div class="col s12 m2 l2" style="float:left"><details>
            <summary>Tags</summary>
             <?php
                                                    // view the tags
                                                               $id=$row['cat_id'];
                                                           $arr=explode(",",$id);
                                                           $l=count($arr);
                                                           $i=0;
                                                        while($l--){
                                                          $temp= $arr[$i];
                                                            $i++;
                                                            $sq = "SELECT cat_name FROM `categories` WHERE cat_id=$temp";
                                                          $res = mysqli_query($conn,$sq);
                                                          $ro = $res->fetch_assoc();
                                                          echo "<p>$ro[cat_name]</p>";
                                                          }
                                                      ?>         
            </details></div>
  
  </div>
  



<?php 
// fetch all the answers
$pid=$row['qid'];
//echo $pid;
$query = "SELECT * from `question$pid` ";
$result2 = $conn->query($query);
if($rowcount=mysqli_num_rows($result2)){

while($row2 = $result2->fetch_assoc()){

?> 
<hr style="margin-left:10px;">
 <div class="row">
   <div class="col s4" style="float:right"><?php echo "$row2[reg_date]";?></div>
 <div class="col s4 m4 l3">


<?php    
      $saquery = "SELECT * FROM `users` WHERE user_id= $row2[uid]";
      $raquery = mysqli_query($conn,$saquery);

      if($rowquery = $raquery -> fetch_assoc()){
                      if(is_null($rowquery['user_pic'])){
                        echo " <img class='circle left no_border' alt='' style='margin-top:10px;width:100%;' src='http://localhost/a/useraccount/images/default.png'>";
                      }else{
                                
                                 echo " <img class='circle left no_border' alt='' style='margin-top:10px;width:100%;' src='http://localhost/a/useraccount/$rowquery[user_pic]'>";
                        }
              }
 ?>
 
 </div>
 <div class="col s8 m8 l9">
 <div class="row">
 <div class="col s8 m8 l10">
 <blockquote> 
 <?php echo "$row2[aname]";?>
</blockquote>
</div>


<?php
//vote the comment
    if(isset($_SESSION['signed_in'])){
        $Query= "SELECT * from `likes` WHERE question_id=$pid AND user_id=$_SESSION[user_id] AND comment_id=$row2[id] ";
        $Result = $conn->query($Query);
        $Row = $Result->fetch_assoc();
        $rowcount=mysqli_num_rows($Result);
             
        if(!$rowcount){

         echo "<a href='http://localhost/a/answer/answer.php?vote=1&qid=$pid&cid=$row2[id]'><div class='col s4 m4 l2' style='float:right'><img src='like.png' alt='upvote' class='responsive-img' style='width:80%'>
</div>
</a>";
         }else{
            echo "<a href='http://localhost/a/answer/answer.php?vote=0&qid=$pid&cid=$row2[id]'><div class='col s4 m4 l2' style='float:right'><img src='unlike.png' alt='downvote' class='responsive-img' style='width:80%'>
</div>
</a>";

         }  
    }
?>
   <div class="col s4" style="float:right"><?php echo "$row2[aqvote]";?></div>
</div>
            <p> <big> <?php echo "$row2[acmmnt]<br>";?></big></p>
<div style="float:right">

<?php if(isset($_SESSION['user_name']) && $_SESSION['user_name']==$row2['aname']){
         echo "   <a class='btn btn-succes' style='font-size:90%' role='button' href='http://localhost/a/check.php?s=1&t=$row2[id]&qid=$pid' ><i class='material-icons left'>Delete</i></a>";
     }?>

 </div>
 </div>
 </div>
<?php }} ?>

  <hr style="margin-left:10px;">

 
<a class="gotop" href="#top">Top</a>
</div>
</div>
<div class="space"> </div>
        <div class="clear"> </div>
<a class="gotop" href="#top">Top</a>
</div>
</div>

</div>
<?php 

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>
 </div>
</body>
</html>
