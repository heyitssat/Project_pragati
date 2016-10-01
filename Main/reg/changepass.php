<?php
include'header2.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    
    <title>PRAGATI</title>
    <!--  Bootstrap Style -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!--  Font-Awesome Style -->
    <link href="assets/css/font-awesome.min.css" rel="stylesheet" />

    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <!--  Custom Style -->
    <link href="assets/css/style.css" rel="stylesheet" />

</head>
<body>
<center>

<?php
session_start();
//echo "string";
    
    if(isset($_SESSION['signed_in'])){
        $user=$_SESSION['user_name'];}
    else{
            $user2=$_GET['user'];
            $user1 = trim($user2, '()');
        //echo "y".$user1 ."kjf";
        if(isset($_SESSION['check'])){
                $msg = $_SESSION['check'];
            }
    }
    
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


 

    <div id="home" >
        <div class="overlay">
            <div class="container">
                <div class="row ">
                	<div class="col-sm-12 col-lg-4 col-md-12 head-text"></div>




<?php

//Case when signed in user changes the password

if($_SERVER['REQUEST_METHOD'] != 'POST' && isset($_SESSION['signed_in']))
{
    /*the form hasn't been posted yet, display it
      note that the action="" will cause the form to post to the same page it is on */
   /* echo '<form method="post" action="">
        Current Password: <input type="password" name="user_pass">
        New Password: <input type="password" name="user_pass1">
        New Password again: <input type="password" name="user_pass_check">
        <input type="submit" class="submit_button" value="Change password" />
     </form>';
     */
?>


     	<div class="col-sm-12 col-lg-4 col-md-12 head-text">
                <div class="div-trans text-center">
                            <h3>Change Password</h3>
                    <div class="col-lg-12 col-md-12 col-sm-12" >

                           <form method="post" action="">
                                <div class="form-group">

                                    <input type="text" class="form-control" required="required" placeholder="Current Password" name="user_pass" />
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" required="required" placeholder="New Password"  name="user_pass1">
                                </div>

                                <div class="form-group">
                                    <input type="password" class="form-control" required="required" placeholder="Re Enter New Password"  name="user_pass_check">
                                </div>
                                
                                
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success btn-block btn-lg" value="Change Password" />SUBMIT</button>
                                </div>
                            </form>
                                
                    </div>

                </div>
         </div>





<?php

}
else if(isset($_SESSION['signed_in']))
{


//Case when signed in user has entered new password

                        /* so, the form has been posted, we'll process the data in three steps:
                            1.  Check the data
                            2.  Let the user refill the wrong fields (if necessary)
                            3.  Save the data 
                        */
                        $errors = array(); /* declare the array for later use */
                            $pass =test_input($_POST['user_pass']);
                            $pass1 =test_input($_POST['user_pass1']);
                            $pass2 =test_input($_POST['user_pass_check']);        
                        if(isset($pass))
                        {
                            if($pass1 != $pass2)
                            {
                                $errors[] = 'The two passwords did not match.';
                            }
                        }
                        else
                        {
                            $errors[] = 'The password field cannot be empty.';
                        }
                         
                        if(!empty($errors)) /*check for an empty array, if there are errors, they're in this array (note the ! operator)*/
                        {
                            echo 'Uh-oh.. a couple of fields are not filled in correctly..';
                            echo '<ul>';
                            foreach($errors as $key => $value) /* walk through the array so all the errors get displayed */
                            {
                                echo '<li>' . $value . '</li>'; /* this generates a nice error list */
                            }
                            echo '</ul>';
                            echo '<a href="changepass.php?user=".$user." "> Try Again</a>';
                        }
                        else
                        {
                            //the form has been posted without, so save it
                            //notice the use of mysql_real_escape_string, keep everything safe!
                            //also notice the sha1 function which hashes the password
                        $sql= "SELECT * FROM users WHERE user_name='$user'";
                        $result = mysqli_query($conn,$sql);
                        $row = $result->fetch_assoc();
                    $pas=sha1($pass);
                    $pass1=sha1($pass1);
                    $oldpass= $row['user_pass'];
                     /*   echo $row['user_pass'];
                        echo '  ';
                        echo $pas;
                        echo '';
                        echo $pass1;
                    */    if(!isset($row['user_pass'])){
                        header ('Location: http://localhost/a/reg/reg.php');
                        }
                        if($pas==$oldpass){
              //         echo "fhi";
                            $sql = "UPDATE users SET user_pass='$pass1' WHERE user_name='$user'";
                            $result = mysqli_query($conn,$sql);
                            if(!$result)
                            {
                                //something went wrong, display the error
                                 echo 'Something went wrong while registering. Please try again later.';
                                //echo mysql_error(); //debugging purposes, uncomment when needed
                            }
                            else
                            {

                                ?><script>alert('Successfully Changed.');</script><?php
                                   header('Location: http://localhost/a/useraccount/useraccount.php');
                           //echo "abc";

                        }
                        }else{  //user filled current pass wrong
                        echo 'You have supplied invalid password, ';
                        echo '<a href="http://localhost/a/reg/reg.php">Try Again</a>';
                        }
                  }   

}
else if($_SERVER['REQUEST_METHOD'] != 'POST')
{

//echo 'testing1';


  // Case when user has entered the otp

    if(isset($_GET['otp'])){
                                                      
        $otp=$_GET['otp'];
    //    echo "otp is";
      //  echo $otp;
     //   echo "this";
     //   echo $msg;
     //   echo"m";
        
        if($otp==$msg){
            /*echo '<form method="post" action="">
        New Password: <input type="password" name="user_pass1">
        New Password again: <input type="password" name="user_pass1_check">
        <input type="submit" class="submit_button" value="Change password" />
     </form>';
	*/
?>
     <div class="col-sm-12 col-lg-4 col-md-12 head-text">
                <div class="div-trans text-center">
                            <h3>Change Password</h3>
                    <div class="col-lg-12 col-md-12 col-sm-12" >

                           <form method="post" action="">
                                
                                <div class="form-group">
                                    <input type="password" class="form-control" required="required" placeholder="New Password"  name="user_pass1">
                                </div>

                                <div class="form-group">
                                    <input type="password" class="form-control" required="required" placeholder="Re Enter New Password"  name="user_pass1_check">
                                </div>
                                
                                
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success btn-block btn-lg" value="Change password" />SUBMIT</button>
                                </div>
                            </form>
                                
                    </div>

                </div>
         </div>

<?php





        }else{
                //echo 'OTP entered does not match<br>';
                 //echo '<a href="changepass.php?user='.$user1.' ">  Resend OTP.</a>';

                 ?>
                 <div class="col-sm-12 col-lg-4 col-md-12 head-text">
                <div class="div-trans text-center">
                            <h3>OTP Entered Does Not Match</h3>
                    <div class="col-lg-12 col-md-12 col-sm-12" >

                           
                                
                                
                                <div class="form-group"><?php

                 echo '<a href="changepass.php?user='.$user1.' "><button type="submit" class="btn btn-success btn-block btn-lg" value="Change Password" />Re Send OTP</button></a>';
                               ?> </div>
                            
                                
                    </div>

                </div>
         </div>

<?php

        }
    }else{
//echo 'testing';
 // Case when user has to enter otp

    $sql= "SELECT * FROM users WHERE user_name='$user1'";
    $result = mysqli_query($conn,$sql);
    $row = $result->fetch_assoc();
    $mail= $row['user_email'];


?>



<div class="col-sm-12 col-lg-4 col-md-12 head-text">
                        <div class="div-trans text-center">
                            <h3> <?php echo "OTP is sent to your email<br>".$mail; ?> </h3><br>
                            

<?php

//echo "is it working";
            //generate mail msg is $msg
            $msg=rand();
 //           echo $msg;
            $_SESSION['check']=$msg;
 //           echo 'msg';


            //write here Code to send otp to user

 require 'phpmailer/PHPMailerAutoload.php';
                               $email = $row['user_email'];                    
                
                    $message = 'The one time password You requested to change your password for your Pragati-CWC account is'.$msg;
                    $subject ='change Password Otp';

                    $mail = new PHPMailer;

                    $mail->isSMTP();

                    $mail->Host = 'smtp.gmail.com';

                    $mail->Port = 587;

                    $mail->SMTPSecure = 'tls';

                    $mail->SMTPAuth = true;

                    $mail->Username = 'satyamtheboss333@gmail.com';

                    $mail->Password = 'maytas332s';

                    $mail->setFrom('Pragati-CWC email', 'Pragati-CWC');

                    $mail->addReplyTo('Pragati-CWC email', 'Pragati-CWC ');

                    $mail->addAddress($email);  //send to email

                    $mail->Subject = $subject;

                    $mail->msgHTML($message);

                    if (!$mail->send()) {
                       $error = "Mailer Error: " . $mail->ErrorInfo;
                        ?><script>alert('<?php echo $error ?>');</script><?php
                    } 
                 //   else {
                 //      echo '<script>alert("Message sent!");</script>';
                //    }
?>
<div class="col-lg-12 col-md-12 col-sm-12" >

                                <div class="form-group">
                                
                                    <input type="text" class="form-control" required="required"  id="otp" placeholder="Enter One Time Password" />
                                </div><br>
                                
                                
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success btn-block btn-lg" value="SUBMIT"  onClick="myfunc()"/>SUBMIT</button>
                                </div>
                                 <p id="error"></p>

                                
                             </div>

                        </div>
                


            
            <?php
            //mail("$mail","subject",$msg);
           
            }

}

else if($_SERVER['REQUEST_METHOD'] == 'POST'){


// Case when new password is entered by user

            $errors = array(); /* declare the array for later use */
                    
                    $pass2 =test_input($_POST['user_pass1']);
                    $pass2check =test_input($_POST['user_pass1_check']);        
            $pass2=sha1($pass2);
            $pass2check=sha1($pass2check);

                if(isset($pass2))
                {
                    if($pass2 != $pass2check)
                    {
                        $errors[] = 'The two passwords did not match.';
                    }
                }
                else
                {
                    $errors[] = 'The password field cannot be empty.';
                }
                 
                if(!empty($errors)) /*check for an empty array, if there are errors, they're in this array (note the ! operator)*/
                {
                    echo 'Uh-oh.. a couple of fields are not filled in correctly..';
                    echo '<ul>';
                    foreach($errors as $key => $value) /* walk through the array so all the errors get displayed */
                    {
                        echo '<li>' . $value . '</li>'; /* this generates a nice error list */
                    }
                    echo '</ul>';
                    echo '<a href="changepass.php?user=".$user1." "> Try Again</a>';
                }
                else
                {

                    $sql = "UPDATE users SET user_pass='$pass2' WHERE user_name='$user1'";
                   
                   
                   $result = mysqli_query($conn,$sql);
                    if(!$result)
                    {
                        //something went wrong, display the error
                        echo 'Something went wrong while registering. Please try again later.';
                        //echo mysql_error(); //debugging purposes, uncomment when needed
                    }
                    else
                    {
                        ?>

                        <div class="col-sm-12 col-lg-4 col-md-12 head-text">
                <div class="div-trans text-center">
                            <h3>Password Successfully Changed </h3><br>
                            <h4>You can now </h4><br>
                            <a href="http://localhost/a/reg/reg.php" class="btn btn-success btn-block btn-lg" >SIGN IN</a>
                             <br>
                             <h4>With your new password and <br>Start Posting! :-)</h4>
                    <div class="col-lg-12 col-md-12 col-sm-12" >

                           
                                
                                
                                <div class="form-group">
                                    
                                </div>
                            
                                
                    </div>

                </div>
         </div>


                        <?php


                       // echo 'Successfully Changed. You can now <a href="http://localhost/a/reg/reg.php">sign in </a>with your new password and start posting! :-)';




                    }
                }
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}?>
<div class="col-sm-12 col-lg-4 col-md-12 head-text"></div>
</center>

</div>
</div>
</div>
</div>
<script>
function myfunc(){
     var x= document.getElementById("otp").value;
    if(x==''){
    document.getElementById("error").innerHTML='Fill Otp sent to your email.';
    }
    else{
    var y = "(<?php echo $user1 ?>)";

    window.location.assign("changepass.php?otp="+x+"&user="+y+"")
    }
}

</script>
</body>
</html>

					