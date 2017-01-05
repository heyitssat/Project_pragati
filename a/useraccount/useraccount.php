
  <?php
session_start();
if(isset($_SESSION['signed_in']) && $_SESSION['signed_in']==true){

    $uid=$_SESSION['user_id'];

 

}else{ header('Location: http://localhost/a/reg/reg.php');}


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
<!DOCTYPE html>
<html>
<head>

<link href="styles.css" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="css-pop.js"></script>


    
    <title>PRAGATI</title>

   <link rel="stylesheet" href="default.css">
	<link rel="stylesheet" href="layout.css">
    <!-- BOOTSTRAP STYLES-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONTAWESOME STYLES-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
       <!--CUSTOM BASIC STYLES-->
    <link href="assets/css/basic.css" rel="stylesheet" />
    <!--CUSTOM MAIN STYLES-->
    
    <!-- GOOGLE FONTS-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
	<script src="ckeditor/ckeditor.js"></script> 
	<link href="materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>

</head>
<body>
<?php include "header2.php" ;?>
<br><br><br>
    <div id="wrapper">
        <!-- /. NAV TOP  -->
        <nav class="navbar-side">
           
        
<?php 
          $sql = "SELECT * from `users` WHERE user_id=$uid";
            $result = $conn->query($sql);
      $row = $result->fetch_assoc(); 
$rowcount=0;
         $sq = "SELECT * FROM `master` WHERE uid=$uid";
         $resul = mysqli_query($conn,$sq);
         $rowcount=mysqli_num_rows($resul);

      //NO OF ANSWERS

          $sqls = "SELECT qans from `users` WHERE user_id=$uid";
            $results = $conn->query($sqls);
      $rows = $results->fetch_assoc(); 
      $id=$rows['qans'];
if(!(is_null($id))){
            
                $la=0;
                $arra=explode(",",$id);
                  $la=count($arra);
                   $i=0;

                  //  echo "<div>A: ".$l."</div>";
            }else{
                    $la=0;
            }

         
            $id=$row['fav_tags'];
        
         if(!(is_null($id))){

//to delete the fav tag
if(isset($_GET['del'])){
                                      $del = $_GET['del'];
                                    //  echo "kdfjk";
                                      $sap= $_SESSION['user_id'];

                                       $sql= "SELECT fav_tags FROM users WHERE user_id=$sap";
                                              $result = mysqli_query($conn,$sql);
                                              $rowzz = $result->fetch_assoc();
                                                  $fav_tags=$rowzz['fav_tags'];

                                                  $fav_tags=str_replace("$del","","$fav_tags");
                                                  $fav_tags=str_replace(",,",",","$fav_tags");
                                                  $fav_tags= trim($fav_tags,",");
                                                  $fav_tags=str_replace("","","$fav_tags");
                                                  //remove that no. 
              if($fav_tags==''){
                 // echo "bad_shah";
               $sql="UPDATE `users` SET `fav_tags`= NULL WHERE user_id=$sap";           //inverted commas had to be used in '$qans' as it is string
                echo ' <p><a href="">Refresh</a>the Page</p> ';                      
                                      if($conn->query($sql)){
                                                    //  echo "deleted1";
                                                      header('Location: http://localhost/a/useraccount/useraccount.php');
                                      }
              }else{
                                      $sql="UPDATE `users` SET `fav_tags`= '$fav_tags' WHERE user_id=$sap";           //inverted commas had to be used in '$qans' as it is string
                                                           
                                      if($conn->query($sql)){
                                                  //    echo "deleted2";
                                                      header('Location: http://localhost/a/question/question.php');
                                      }
                              }
}   // deletion code end
        


                                				            $arr=explode(",",$id);
                                				             $l=count($arr);
                                				             $i=0;
                                ?>

                                		<div class="collection" style="margin:10px;margin-top:50px">
                                <?php
                                				            while($l--){
                                				               $temp= $arr[$i];
                                				                $i++;
                                				                $sqa = "SELECT cat_name FROM `categories` WHERE cat_id=$temp";
                                				                $resa = mysqli_query($conn,$sqa);
                                				               $roa = $resa->fetch_assoc();
                                							   
                                							   
                                							   ?>
                                							   
                                								<a href="http://localhost/a/useraccount/useraccount.php?del=<?php echo $temp;?>" class="collection-item active">
                                								<?php echo "$roa[cat_name] ";?>
                                                  
                                                </a>
                                								<?php } ?>
                                				        </div>
                                                <?php
				        
        }else{ echo "You have no Favorite Tags.";}

        ?>

                   <br><center>
           				 <form> 
                  Add Favorites <br><input type="text" onkeyup="showHint(this.value)">
                  </form>
                  
          				<span id="txtHint"></span>

          				<p><span id="chosed"></span></p>
          				<p id="refresh"></p>
                  
                  </center>
                              

        </nav>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper">    
    

			
                <div class="row">
                    <div class="col-md-12">
					
                        <h1 class="page-head-line">PERSONALIA</h1>
                        

                    </div>
					
					<div class="row" style="margin:50px;">
					
					<div class="card">
					<div class="card-image col s12 m6 l4">
<?php
        if(is_null($row['user_pic'])){
           echo " <img src='http://localhost/a/useraccount/images/default.png' style='width:200px;height:200px'>";
        }else{
            echo " <img src='http://localhost/a/useraccount/$row[user_pic]' style='width:200px;height:200px'>";
				}?>
					<div id="container">
					<div id="mainContent">
					<div id="blanket" style="display:none;"></div>
					
						<div id="popUpDiv" style="display:none;" class="collection">
    
						<a href="#" onclick="popup('popUpDiv')" >Close</a>
						
						<form action="saveimage.php" enctype="multipart/form-data" method="post" style="margin:2px;" >
						
<input type="file" name="fileToUpload" id="fileToUpload">
<center>
<input class="waves-effect waves-light btn" type="submit" value="Upload Image" name="submit">

</center>
</form>


						</div>	
						<button onclick="popup('popUpDiv')" class="waves-effect waves-light btn" style="margin-top:10px;">Change Profile Pic</button>
					
					
					
					</div>
					</div>
					</div>
					
					<div class="card-action col s12 m6 l8">

            <div class="row">
			
               <div class="columns contact-details">
				
                  <h2>Details</h2>
                  <p class="address">
						   <span>NAME  : <?php echo $row['user_name'];?></span><br>
                     <span>EMAIL Id   :   <?php echo $row['user_email'];?></span>
					   </p>

               </div>
			   
			   <div class="columns contact-details" style="float:right;">

                  <h5><b>No Of Ques:</b><?php echo $rowcount;?></h5>
                  <h5><b></b><?php// echo "No Of Ans:" .$la."";?></h5>
                  
                  
                  <a href="http://localhost/a/reg/changepass.php" ><button class="waves-effect waves-light btn" >Change Password</button></a>

               </div>
               
			   </div> 
					
					</div>
					</div>
					
					</div>
                </div>
<div class="row" style="margin:50px;padding:50px;">

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
             $rowcount=mysqli_num_rows($result);

             $sql2 = "SELECT * FROM `master` WHERE uid=$uid && anonymous=1";
             $result2 = mysqli_query($conn,$sql2);
             $rowcount2=mysqli_num_rows($result2);
             $rowcount3= $rowcount + $rowcount2;
 if($rowcount3!=0){
      $no=0;
         while($row = $result->fetch_assoc()){
            $no++;
            
<<<<<<< HEAD

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


?>

<br><br>
<div class="row">
  
<div class="col s12">
          
                        <h6 style="font-family:Saab;font-size:20px" class="page-head-line">Anonymous</h6>
                        

                    
          

</div>

</div>

<?php
        if($rowcount2!=0){
               $no=0;
         while($row2 = $result2->fetch_assoc()){
            $no++;
            

           echo "    <h3><a href ='http://localhost/a/answer/answer.php?qid=$row2[qid]'> $row2[question] </a></h3>";   
           ?>
<p class="info">
              <div class="row">
              <div class="col s6 m6 l6">&nbsp;&nbsp;No Of Votes:<?php echo $row2['qvote'];?></div>
              <div class="col s6 m6 l6"><em class="date"><?php echo $row2['reg_date'];?></em></div>
=======

           echo "    <h3><a href ='http://localhost/a/answer/answer.php?qid=$row[qid]'> $row[question] </a></h3>";   
           ?>
<p class="info">
              <div class="row">
              <div class="col s6 m6 l6">&nbsp;&nbsp;No Of Votes:<?php echo $row['qvote'];?></div>
              <div class="col s6 m6 l6"><em class="date"><?php echo $row['reg_date'];?></em></div>
>>>>>>> bfca6adece6f9cafa65f3716b511d2e8e9ff1ff3
              
              </div> 
               <details>
               <summary>Tags</summary>
<?php
<<<<<<< HEAD
            $id=$row2['cat_id'];
=======
            $id=$row['cat_id'];
>>>>>>> bfca6adece6f9cafa65f3716b511d2e8e9ff1ff3
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
<<<<<<< HEAD
=======




<?php }

>>>>>>> bfca6adece6f9cafa65f3716b511d2e8e9ff1ff3




<?php }
       }}else{
         echo "NO QUESTIONS TO SHOW";
      }
?>
</div>
            </div> <!-- item end -->

      </div> 
</div>
</div>

    <!--Answers
<div class="col s12 m12 l6" >   
      <div class="row education" style="float:right">

         <div class="nine columns main-col">

            <div class="row item">


<div class="twelve columns">
-->
<?php
// TABLE FOR ANSERES BY USER
      /*

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
                              

                                                             echo "    <h3><a style='color:black;' href ='http://localhost/a/answer/answer.php?qid=$row[qid]'> $row[question] </a></h3>";   
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

                                                                 echo "    <h6><a style='color:brown; href ='http://localhost/a/answer/answer.php?qid=$row[qid]'> $rowl[acmmnt] </a></h6>";   
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
*/
?><!--
  </div>
<<<<<<< HEAD


                                                                  </div> 
      </div> 
</div>
     

 
            </div> -->                            <!-- item end -->


=======


                                                                  </div> 
      </div> 
</div>
     

 
            </div> -->                            <!-- item end -->


>>>>>>> bfca6adece6f9cafa65f3716b511d2e8e9ff1ff3
         </div> 

      </div> 

</div>
</div>

        </div>

    </div>
    
    


</body>

 <!--SCRIPT FUNCTION FOR ADDING FAV TAGS -->

<script>
function showHint(str) {
    if (str.length == 0) { 
        document.getElementById("txtHint").innerHTML = "";
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
            }
        };
        xmlhttp.open("GET", "gethint.php?q=" + str, true);
        xmlhttp.send();
    }
}
</script>

<script>
function showUser(str) {


    if (str == "") {
        document.getElementById("chosed").innerHTML = "";
        return;
    } else { 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                var x=  document.getElementById("chosed").innerHTML;

                if(x==""){
                document.getElementById("chosed").innerHTML = "You added" + xmlhttp.responseText;
                document.getElementById("refresh").innerHTML ='<a href="">Refresh</a> the Page';
                
                }else{
                document.getElementById("chosed").innerHTML =""+x +xmlhttp.responseText;
                document.getElementById("refresh").innerHTML ='<a href="http://localhost/a/useraccount/useraccount.php">Refresh</a> the Page';
                
                }
            }
        };
        xmlhttp.open("GET","getuser.php?q="+str,true);
        xmlhttp.send();
    }
}
</script>
</html>
