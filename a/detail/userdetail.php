<!DOCTYPE html>
<?php include "header2.php" ;?>

<html  lang="en">
<head>
	<title>PRAGATI</title>
   <link rel="stylesheet" href="assist/css/default.css">
	<link rel="stylesheet" href="assist/css/layout.css">
 
     <link href="materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>



</head>

<body>
<br><br><br>
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



  <?php


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

   
 if(!isset($_GET['uid'])){
   header('Location:user.php');}else {
    
         $uid= $_GET['uid'];                                
          $sql = "SELECT * from `users` WHERE user_id=$uid";
            $result = $conn->query($sql);
      $row = $result->fetch_assoc(); 
$rowcount=0;
         $sq = "SELECT * FROM `master` WHERE uid=$uid && anonymous=0";
         $resul = mysqli_query($conn,$sq);
         $rowcount=mysqli_num_rows($resul);

      //NO OF ANSWERS

    /*      $sqls = "SELECT qans from `users` WHERE user_id=$uid";
            $results = $conn->query($sqls);
      $rows = $results->fetch_assoc(); 
      $id=$rows['qans'];
if(!(is_null($id))){
            
                $l=0;
                $arra=explode(",",$id);
                  $l=count($arra);
                   $i=0;

                  //  echo "<div>A: ".$l."</div>";
            }else{
                    $l=0;
            }
*/

   ?>
   <section id="about">

      <div class="row">

         <div class="three columns">

       <?php    
        if(is_null($row['user_pic'])){
           echo " <img class='profile-pic' src='http://localhost/a/useraccount/images/default.png'>";
        }else{
            echo " <img class='profile-pic' src='http://localhost/a/useraccount/$row[user_pic]'>";
        }?>
         </div>

         <div class="nine columns main-col">


            <div class="row">
			
               <div class="columns contact-details">
				
                  <h2>Contact Details</h2>
                  <p class="address">
						   <span>NAME  : <?php echo $row['user_name'];?></span><br>
                     <span>EMAIL Id   :   <?php echo $row['user_email'];?></span>
					   </p>

               </div>
			   
			   <div class="columns contact-details">

                  <h2>No Of Ques: <?php echo $rowcount;?></h2>
                  <h2><?php// echo "No Of Ans:" .$l."";?></h2>
                  

               </div>
			   </div> 
<?php			   
         //TAGS
         
            $id=$row['fav_tags'];
        if(!(is_null($id))){
            $arr=explode(",",$id);
             $l=count($arr);
             $i=0;
            while($l--){
               $temp= $arr[$i];
                $i++;
                $sqa = "SELECT cat_name FROM `categories` WHERE cat_id=$temp";
                $resa = mysqli_query($conn,$sqa);
               $roa = $resa->fetch_assoc();
			   
			   
			   ?>
			   
			   <div class="chip">
				<?php echo "$roa[cat_name] ";?>
				</div>
               <?php
            }
        }

?>
               

            

         </div>

      </div>

   </section>


  
   <section id="resume">
   <div class="row">
<!--Question-->
<div class="">
      <div class="row education">

         <div class="nine columns main-col">

            <div class="row item">

               <div class="twelve columns">
<?php
// QUESTIONS BY USER
            

             $sql = "SELECT * FROM `master` WHERE uid=$uid && anonymous=0";
             $result = mysqli_query($conn,$sql);
 if($rowcount!=0){
      $no=0;
         while($row = $result->fetch_assoc()){
            $no++;
            

           echo "    <h3><a href ='http://localhost/a/answer/answer.php?qid=$row[qid]'> $row[question] </a></h3>";   
           ?>
<p class="info">
              <div class="row">
              <div class="col s6 m6 l6">&nbsp;&nbsp;No Of Votes:<?php echo $row['qvote'];?></div>
              <div class="col s6 m6 l6"><em class="date"><?php echo $row['reg_date'];?></em></div>
              
              </div> 
               <details>
               <summary>Tags</summary>
<?php
            $id=$row['cat_id'];
            $arr=explode(",",$id);
            $la=count($arr);
            $i=0;
         while($la--){
            $temp= $arr[$i];
             $i++;    
             $sq = "SELECT cat_name FROM `categories` WHERE cat_id=$temp";
             $res = mysqli_query($conn,$sq);
            $ro = $res->fetch_assoc();
            echo $ro['cat_name']."<br>";
            }


         ?>
               </details>
</p>




<?php }


      }else{
         echo "NO QUESTIONS TO SHOW";
      }
?>
</div>
            </div> <!-- item end -->

      </div> 
</div>
</div>

	  <!--Answers-->
    <!--
<div class="col s12 m12 l6" >	  
      <div class="row education" style="float:right">

         <div class="nine columns main-col">

            <div class="row item">


<div class="twelve columns">
-->
<?php
/*
// TABLE FOR ANSERES BY USER
      

          $sqls = "SELECT qans from `users` WHERE user_id=$uid";
            $results = $conn->query($sqls);
    $rows = $results->fetch_assoc(); 
    $id=$rows['qans'];

if(!(is_null($id))){
           $arra=explode(",",$id);
           $l=count($arra);
           $j=0;
//echo $l."k";
echo $arra[0]."p".$arra[1]."k".arra[2];

    while($l-- ){ echo "l is".$l;

                                      $tempq= $arra[$j];   
                                      $j++;
                                            echo "dj".$id."dk".$tempq."jk";
                                            $sql = "SELECT * FROM `master` WHERE qid=$tempq ";
                                            $result = mysqli_query($conn,$sql);
                                            $row = $result->fetch_assoc();
                              

                                                             echo "    <h3><a style='color:black;' href ='answer.php?qid=$row[qid]'> $row[question] </a></h3>";   
                                                             ?>
                                                            <p class="info">
                                                                <div class="row">
                                                                <div class="col s6 m6 l6">&nbsp;&nbsp;No Of Votes:<?php echo $row['qvote'];?></div>
                                                                <div class="col s6 m6 l6"><em class="date"><?php echo $row['reg_date'];?></em></div>
                                                               <div class="col s9">&nbsp;&nbsp;Posted By: &nbsp;&nbsp;&nbsp;<font color="#b800e6" face="Copperplate Gothic Light" style="text-transform: uppercase;"><?php 
                                                                       if($row['anonymous'] =='0'){
                                                                       echo "$row[qname]";}
                                                                        else{ echo "anonymous"; }
                                                                     ?></font></div>
                                                                </div> 
                                                                 <details>
                                                                 <summary>Tags</summary>
                                                            <?php
                                                              $id=$row['cat_id'];
                                                              $arr=explode(",",$id);
                                                              $la=count($arr);
                                                              $i=0;
                                                            while($la--){
                                                              $temp= $arr[$i];
                                                               $i++;    
                                                               $sq = "SELECT cat_name FROM `categories` WHERE cat_id=$temp";
                                                               $res = mysqli_query($conn,$sq);
                                                              $ro = $res->fetch_assoc();
                                                              echo $ro['cat_name']."<br>";
                                                              }


                                                            ?>
                                                                 </details>
                                                            </p>
                            <?php

                                        $query = "SELECT * from `question$tempq` WHERE uid=$uid ";
                                        $result = $conn->query($query);
                                
                                        
                                     $no=0;
                                        
                           while($rowl = $result->fetch_assoc() ){
                                                                  $no++;

                                                                 echo "    <h6><a style='color:brown; href ='answer.php?qid=$row[qid]'> $rowl[acmmnt] </a></h6>";   
                                                                 ?>
                                                                        <p class="info">
                                                                    <div class="row">
                                                                    <div class="col s6 m6 l6">&nbsp;&nbsp;No Of Votes:<?php echo $rowl['aqvote'];?></div>
                                                                    <div class="col s6 m6 l6"><em class="date"><?php echo $rowl['reg_date'];?></em></div>
                                                                    </div> 
                                                      </p>
                                                           
                                                              

                            <?php } ?><hr style="border-color:#604020;border-width:1px;"><br><br><?php

                            
                                   
 }
        
}else{
   echo "</div></div>NO ANSWERS TO SHOW";
}
*/?>
 <!-- </div>


                                                                  </div> 
      </div> 
</div>
     

 
            </div> <!-- item end -->


         </div> 

      </div> 

</div>
</div>
   </section>

      
<?php } ?>

</body>

</html>
