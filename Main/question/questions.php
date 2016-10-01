<?php
include "header2.php";
?>

<?php
session_start();
if(isset($_GET['qid'])){
$pid = $_GET['qid'];}
//  create connection

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


?>



<?php

//to vote
if(isset($_GET['vote'])){

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
                      }   //close check session                     

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
                        }// close check session
                 } 

}




?>
<?php
// Sort code

if(isset($_POST['view'])){
  if($_POST['view']=='recent'){
    
echo "1";
  $query = "SELECT * from `master` ORDER BY qid DESC";

  }else if($_POST['view']=='top voted'){
echo"2";
  $query = "SELECT * from `master` ORDER BY qvote DESC";
  
  }else if($_POST['view']=='featured'){

    $query = "SELECT * from `master` ORDER BY ans DESC";
echo "3";
  }
  $result = $conn->query($query);

}else{
echo "def";
  $query = "SELECT * from `master` ORDER BY qid DESC";
  $result = $conn->query($query);

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



  <link href="materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>


</head>

<body>
<div id="wrap">


      <div class="fixed-action-btn horizontal" style="bottom: 45px; left: 24px;">
    <a href="http://localhost/a/qpost/qpost.php" class="btn-floating btn-large red">
      <img src='discuss.png' alt='discuss' class='responsive-img'>
    </a>
  </div>

  <div class="fixed-action-btn horizontal" style="bottom: 45px; right: 24px;">
    <a href="http://localhost/a/useraccount/useraccount.php" class="btn-floating btn-large red">
      <img src='account.png' alt='my account' class='responsive-img'>
    </a>
  </div>
  <!-- wrapper -->
  <div id="sidebar" style="overflow-bottom:auto">
    <!-- the  sidebar -->
    <!-- logo -->
    <!-- navigation menu -->
    <ul id="navigation">
    <form method="post" action="">
		<li class="collection-item" style="margin:10%">
			<input type="submit" value="recent" name="view" class="btn btnAbout btn-clear border-color color-primary btn-lg linear  " style="width:100%"></input>
		</li>
		<li class="collection-item" style="margin:10%">
			<input type="submit" value="top voted" name="view" class="btn btnAbout btn-clear border-color color-primary btn-lg linear " style="width:100%"></input>
		</li>
		<li class="collection-item" style="margin:10%">
			<input type="submit" name="view" value="featured" class="btn btnAbout btn-clear border-color color-primary btn-lg linear" style="width:100%"></input>
		</li></form>
		<br>
<?php
$rown=0;
$cquery = "SELECT * FROM `categories`";
$cresult = mysqli_query($conn,$cquery);

echo '<form method="post" style="text-transform: uppercase;margin:5px;">
  <font size="4">';
while($crow = $cresult->fetch_assoc()){
    $rown++;

   echo "<li><input type='checkbox' name='select_tag[]'  value='$crow[cat_id]' id='test$rown' />
      <label for='test$rown'>$crow[cat_name]</label></li>";
  
}

echo '
</font>
<center>
<li class="collection-item" style="margin:10%;text-align:center;">
      <input type="submit" name="post" class="btn btnAbout btn-clear border-color color-primary btn-lg linear  " style="width:100%" />
    </li>
  </center>
</form>';
?> 

    </ul>
  </div>

  <?php 
// fetch the question rows

$no=0;
while($row = $result->fetch_assoc()){
$no++;


if(!empty($_POST["select_tag"])){  

$count=0;
   foreach($_POST["select_tag"] as $topic_id)  
   {    
        
    if( $count==0){
      if (strpos($row['cat_id'], $topic_id) !== false){
            $count++;
            $no++;

?>  
<div id="container" style="padding:5px;">
    <!-- page container -->
<?php/*

if(!empty($_POST["select_tag"])){  

    $sqlss = "SELECT * FROM `categories`";
    $resultss = mysqli_query($conn,$sqlss);
    while($rowss = $resultss->fetch_assoc()){
        foreach($_POST["select_tag"] as $topic_id)  
        {  

          if($rowss['cat_id']==$topic_id){
            echo "<b>$rowss[cat_name]   </b> ";
          }
        } 
    }              
}
  */
?>        <!-- Start of News Box 1 -->
 <div class="page" id="home">
 <div class="row">
   <strong><i>
   <div class="col s4">POSTED BY:&nbsp;&nbsp;&nbsp;<font color="red" face="Copperplate Gothic Light" style="text-transform: uppercase;"><?php 
   if($row['anonymous'] =='0'){
   echo "$row[qname]";}
    else{ echo "anonymous"; }
 ?></font></div>
   <div class="col s4"></div>
   
   <div class="col s4"><?php echo "$row[reg_date]";?></div>
   </i></strong>
  </div>
  <div class="row" style="margin-left:10px">
  <h1 style="color:white;font-family:Cooper Black;font-size:200%;"><?php echo "$row[question]";?></h1>
  </div>
  <div class="row" style="margin-left:10px">
  <div class='col s8 l4 m4'>
  <div class='col s8'>
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
         echo "<a href='questions.php?vote=1&qid=$pid'> <img src='like.png' alt='upvote' class='responsive-img' style='width:50%'></a>";

     }else{
         echo "<a href='questions.php?vote=0&qid=$pid'> <img src='unlike.png' alt='downvote' class='responsive-img' style='width:50%'></a>";
     }
}
      ?>
<?php echo "$row[qvote]";?>
</div>
 </div>
   <div class="col s4">No Of Ans : <?php echo "$row[ans]";?></div>
   <div class="col s12 m2 l2" style="float:left">
   <details>
            <summary>Tags</summary>             <?php
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
  
                      
                      <?php echo "<a href=http://localhost/a/answer/answer.php?qid=$row[qid]>More...</a>" ?> 
					</div>
                      <hr>


          <?php 
          // fetch the top answer
          $pid=$row['qid'];

          $query = "SELECT * from `question$pid` ";
          $result2 = $conn->query($query);
          if($rowcount=mysqli_num_rows($result2)){

          $row2 = $result2->fetch_assoc();

          ?>  


                     <!--Class row for answer begins-->
                     <div class="row">
					 <div class="row" style="margin-left:10px">
					<strong><i>
					<div class="col s4"><?php echo "$row2[reg_date]";?></div>
					<div class="col s4"></div>
					</i></strong>
					</div>
                     <div class="col s4 m4 l2">
                     <img src="user.jpg" class="circle left no_border" alt="" style="margin-top:10px;width:100%;"><br>
                     
					 
                     
                     </div>
                     <div class="col s8 m8 l10">
                     <div class="row">
                     <div class="col s8 m8 l10">
                     <blockquote> 
                     <?php echo "$row2[aname]<br>";?> 
                    </blockquote>
                    </div>
					<div class="col s4 m4 l2">

                    <?php
                    //vote the comment
                        if(isset($_SESSION['signed_in'])){
                            $Query= "SELECT * from `likes` WHERE question_id=$pid AND user_id=$_SESSION[user_id] AND comment_id=$row2[id] ";
                            $Result = $conn->query($Query);
                            $Row = $Result->fetch_assoc();
                            $rowcount=mysqli_num_rows($Result);
                                 
                            if(!$rowcount){

                             echo "<a href='questions.php?vote=1&qid=$pid&cid=$row2[id]'>";?> <img src='like.png' alt='downvote' class='responsive-img' style='width:50%'><?php echo "</a>";
                             }else{
                                echo "<a href='questions.php?vote=0&qid=$pid&cid=$row2[id]'>"; ?> <img src='unlike.png' alt='upvote' class='responsive-img' style='width:50%'><?php echo "</a>";

                             }  
                        }
                    ?>
					<?php echo "$row2[aqvote]";?>
                    </div>
					</div>

                                <p> <big> <?php echo "$row2[acmmnt]";?></big></p>

                     
                     </div>
                     <!--Class row for answer ends-->
                     </div>
                    <?php
                      }?>
                      <!-- End of News Box 1 -->
                      

</div><!-- class page ends-->
</div>
<div class="space"> </div>
        <div class="clear"> </div>
        <!-- put some blank space -->
		
 <?php 
 }}}}else{

?>  
<div id="container" style="padding:5px;">
    <!-- page container -->


  
        <!-- Start of News Box 1 -->
 <div class="page" id="home">
 <div class="row">
   <strong><i>
   <div class="col s4">POSTED BY:&nbsp;&nbsp;&nbsp;<font color="red" face="Copperplate Gothic Light" style="text-transform: uppercase;"><?php 
   if($row['anonymous'] =='0'){
   echo "$row[qname]";}
    else{ echo "anonymous"; }
 ?></font></div>
   <div class="col s4"></div>
   
   <div class="col s4"><?php echo "$row[reg_date]";?></div>
   </i></strong>
  </div>
  <div class="row" style="margin-left:10px">
  <h1 style="color:white;font-family:Cooper Black;font-size:200%;"><?php echo "$row[question]";?></h1>
  </div>
  <div class="row" style="margin-left:10px">
  <div class='col s8 l4 m4'>
  <div class='col s8'>
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
         echo "<a href='questions.php?vote=1&qid=$pid'> <img src='like.png' alt='upvote' class='responsive-img' style='width:50%'></a>";

     }else{
         echo "<a href='questions.php?vote=0&qid=$pid'> <img src='unlike.png' alt='downvote' class='responsive-img' style='width:50%'></a>";
     }
}
      ?>
<?php echo "$row[qvote]";?>
</div>
 </div>
   <div class="col s4">No Of Ans : <?php echo "$row[ans]";?></div>
   <div class="col s12 m2 l2" style="float:left">
   <details>
            <summary>Tags</summary>             <?php
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
  
                      
                      <?php echo "<a href=http://localhost/a/answer/answer.php?qid=$row[qid]>More...</a>" ?> 
          </div>
                      <hr>


          <?php 
          // fetch the top answer
          $pid=$row['qid'];

          $query = "SELECT * from `question$pid` ";
          $result2 = $conn->query($query);
          if($rowcount=mysqli_num_rows($result2)){

          $row2 = $result2->fetch_assoc();

          ?>  


                     <!--Class row for answer begins-->
                     <div class="row">
           <div class="row" style="margin-left:10px">
          <strong><i>
          <div class="col s4"><?php echo "$row2[reg_date]";?></div>
          <div class="col s4"></div>
          </i></strong>
          </div>
                     <div class="col s4 m4 l2">
                     <img src="user.jpg" class="circle left no_border" alt="" style="margin-top:10px;width:100%;"><br>
                     
           
                     
                     </div>
                     <div class="col s8 m8 l10">
                     <div class="row">
                     <div class="col s8 m8 l10">
                     <blockquote> 
                     <?php echo "$row2[aname]<br>";?> 
                    </blockquote>
                    </div>
          <div class="col s4 m4 l2">

                    <?php
                    //vote the comment
                        if(isset($_SESSION['signed_in'])){
                            $Query= "SELECT * from `likes` WHERE question_id=$pid AND user_id=$_SESSION[user_id] AND comment_id=$row2[id] ";
                            $Result = $conn->query($Query);
                            $Row = $Result->fetch_assoc();
                            $rowcount=mysqli_num_rows($Result);
                                 
                            if(!$rowcount){

                             echo "<a href='questions.php?vote=1&qid=$pid&cid=$row2[id]'>";?> <img src='like.png' alt='downvote' class='responsive-img' style='width:50%'><?php echo "</a>";
                             }else{
                                echo "<a href='questions.php?vote=0&qid=$pid&cid=$row2[id]'>"; ?> <img src='unlike.png' alt='upvote' class='responsive-img' style='width:50%'><?php echo "</a>";

                             }  
                        }
                    ?>
          <?php echo "$row2[aqvote]";?>
                    </div>
          </div>

                                <p> <big> <?php echo "$row2[acmmnt]";?></big></p>

                     
                     </div>
                     <!--Class row for answer ends-->
                     </div>
                    <?php
                      }?>
                      <!-- End of News Box 1 -->
                      

</div><!-- class page ends-->
</div>
<div class="space"> </div>
        <div class="clear"> </div>
        <!-- put some blank space -->
    
 <?php 


  
 }

 } ?>    


</div> 
</body>
</html>
