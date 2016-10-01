<?php include "header2.php" ?>

﻿<?php
    session_start();
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
    
    <title>PRAGATI</title>

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
<script>
function myFunction() {
 
  var x= document.getElementById("but").value;
    if(x==1){
    document.getElementById("demo").innerHTML = '<div class="col-md-6"> <input  type="text" class="form-control" required="required" placeholder="Enter" form="a" name="cat_name" /></div>';

}
</script>

</head>
<body>
<br><br><br><br>





<?php
if(isset($_SESSION['signed_in']))
{
?>
    <div id="wrapper">


        <!-- /. NAV TOP  -->
        <nav class="navbar-default navbar-side" role="navigation">
           
                <ul class="nav" id="main-menu">


                    <li>
                        <a class="active-menu" href="#"><strong>ADD TAGS</strong></a>
                    </li><br>
                    <center>
                    <font color="white" size="2" >
                    <form style="margin:5px;" class="collection">

                    
     <?php
	 $i=0;
     $query = "SELECT * from `categories`";
                $result = $conn->query($query);
            while($row = $result->fetch_assoc()) {

                   echo "<li>
                          
                          <strong><label for='filled-in-box".$i."' style='text-transform: uppercase;'> ".$row['cat_name']."</label></strong>
                          <input type='checkbox' id='filled-in-box".$i."' style='float:right' name='topics[]' form='a' value=".$row['cat_id']." style='float:right'/>
                        
                    </li>";
                   $i++; 
            }



      ?>          </ul>
        </form>
        </font>
        </center>
            

        </nav>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper">




            <div id="page-inner">
                <div class="row">


                    <div class="col-md-12">
                        <h1 class="page-head-line">What You Want to Discuss</h1>
                        

                    </div>
                </div>
               
               
                <div class="row" style="padding-bottom: 100px; `">


                    <div class="col-md-12">
                        <div id="comments-sec">
                            <h4><strong>POST YOUR QUESTION</strong></h4>

							<form method='post' action='http://localhost/a/qpost/qsubmit.php' id='a'>
							
							
							<textarea name='question' class='ckeditor' required style='width:100%'></textarea><br><br>
							
							<br><br>
							<hr>
							&nbsp;&nbsp;&nbsp;&nbsp;<strong>CREATE YOUR OWN TAG</strong><br><br>
                            <div classs="form-group">
                                
                            </div>
                            <div class="form-group  ">
                            
                                <div class="col-md-6">
                                
                                <input  type="text" class="form-control"  placeholder="Enter" form="a" name="cat_name"/> 
                                </div>
                            
                                <button type="submit" class="btn btn-success">SUBMIT</button><br><br>
                                &nbsp;&nbsp;&nbsp;<input type='checkbox' form='a' name='anonymous' >Post As Anonymous</input>
                            
                                </form>
                            </div>
                            
                            
							<hr>
							
	
                        </div>

                    </div>
                  
                </div>
                

            </div>
           
        </div>

    </div>
    
    
<?php
}else{
    header('Location:http://localhost/a/reg/reg.php?error=1.php'); //error =1 would imply that 'you need to sign in should be shown'
}
?>
</body>
</html>
