
<?php
include'header2.php';

?>
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
session_start();
?>
<?php
    if(isset($_GET['otp'])){



                            $otp=$_GET['otp'];

            if(isset($_SESSION['check'])){
                    $msg = $_SESSION['check'];
                $username=$_SESSION['name'];
                $email=$_SESSION['email'];
                $pass=$_SESSION['pass'];}
             
             if($otp==$msg){
                            
                            $sql = "INSERT INTO
                                        users (user_name, user_pass, user_email ,user_date, user_level)
                                    VALUES('" . mysqli_real_escape_string($conn,$username) . "',
                                           '" . sha1($pass) . "',
                                           '" . mysqli_real_escape_string($conn,$email) . "',
                                            NOW(),
                                            0)";
                                            
                                            if ($conn->query($sql) === TRUE) {
                                                    echo "rlly";
                                                } else {
                                                    echo "Error : " . $conn->error;
                                                }



                            $query = "SELECT  
                                                user_id,
                                                user_name,
                                                user_level
                                            FROM
                                                users
                                            WHERE
                                                user_name = '" . mysqli_real_escape_string($conn,$username) . "'
                                            AND
                                                user_pass = '" . sha1($pass) . "'";

                            $result = $conn->query($query);
                            $row = $result->fetch_assoc();
                            $uid= $row['user_id'];
                            echo "dfd".$uid;
                                        //set the $_SESSION['signed_in'] variable to TRUE
                                $_SESSION['signed_in'] = true;
                                 
                                //we also put the user_id and user_name values in the $_SESSION, so we can use it at various pages
                                    $_SESSION['user_id'] = $row['user_id'];
                                    $_SESSION['user_name']  = $row['user_name'];
                                    $_SESSION['user_level'] = $row['user_level'];
                                     
                                                 
                                if(!$result)
                                {
                                    //something went wrong, display the error
                                    echo '<br><br><br>Something went wrong while registering. Please try again later.';
                                    //echo mysql_error(); //debugging purposes, uncomment when needed
                                }
                                else
                                {
                                    header("Location:check.php?s=4&t=$uid");
                                }
                 }else{
                               // echo 'OTP entered does not match<br>';
                                 //echo '<a href="changepass.php?user='.$user1.' ">  Resend OTP.</a>';}
                                header('Location: http://localhost/a/reg/reg.php?error=3');


                 } 
        }
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
 

    <div id="home" >
        <div class="overlay">
            <div class="container">
                <div class="row ">
                    

<?php

if($_SERVER['REQUEST_METHOD'] != 'POST')
{
    /*the form hasn't been posted yet, display it
      note that the action="" will cause the form to post to the same page it is on */
//first, check if the user is already signed in. If that is the case, there is no need to display this page
if(isset($_SESSION['signed_in']) && $_SESSION['signed_in'] == true){
    header('Location:http://localhost/a/useraccount/useraccount.php');
}
if(isset($_GET['error']) && $_GET['error']==1){
    echo "<br><br><br><strong><h3 style='text-align:center'>You Need to Sign In</h3></strong>";
}elseif(isset($_GET['error']) && $_GET['error']==2){
    echo "<br><br><br><strong><h3 style='text-align:center'>You Are successfully logged out. THANKS for Signing In</h3></strong>";
}elseif(isset($_GET['error']) && $_GET['error']==3){
    echo "<strong><h3 style='text-align:center'>You did not provide the correct challenge response.</h3></strong>";
}
?>
                    <div class="col-sm-12 col-lg-6 col-md-9 head-text">
                        <div class="div-trans text-center">
                            <h3>REGISTER HERE</h3>
                            <div class="col-lg-12 col-md-12 col-sm-12" >

                           <form method="post" action="">
                                <div class="form-group">
                                    <input type="text" class="form-control" required="required" placeholder="User Id" name="user_name" />
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" required="required" placeholder="Password"  name="user_pass">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" required="required" placeholder="Re-Enter Password" name="user_pass_check">
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control" required="required" placeholder="Email address" name="user_email">
                                </div>
                                
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success btn-block btn-lg" value="Sign Up" name="submit"/>REGISTER</button>
                                </div>
                            </form>
                                
                             </div>

                        </div>
                    </div>
                    <?php

 /*   echo '<form method="post" action="">
        Username: <input type="text" name="user_name" />
        Password: <input type="password" name="user_pass">
        Password again: <input type="password" name="user_pass_check">
        E-mail: <input type="email" name="user_email">
        <input type="submit" class="submit_button" value="Sign Up" />
     </form>';


        /*the form hasn't been posted yet, display it
          note that the action="" will cause the form to post to the same page it is on 
         echo '<form method="post" action="">
            Username: <input type="text" name="user_name" id="nam" />
            Password: <input type="password" name="user_pass">
            <input type="submit" class="submit_button" value="Sign in" />
         </form>';
         echo '<p class="error_message" style="font-family:verdana;">Forgot Password?</p><div style="text-align:center;"<button type="button" class="btn btn-primary" style=" margin:auto;
  display:block;" onclick="newDoc()" id="but" value="1">Change your Password</button><br><p id ="error1"></p></div>';
         echo'<p class="error_message" style="font-family:verdana; color:brown;">Do not have an account,yet?</p> <a class="error_message" style="display:block; font-family:verdana;" href="signup.php">Create an account</a>';
     */

?>
                 <form method="post" action="#">
                    <div class=" col-sm-12 col-lg-4 col-md-3" style="float:right">
                        <div class="div-trans text-center">
                            <h3>Already a Member</h3>
                            <h3>SIGN IN HERE</h3>
                            <div class="col-lg-12 col-md-12 col-sm-12" >
                               
                                <div class="form-group">
                                    <input id="UserName" type="text" class="form-control" required="required" placeholder="User Id" name="user_name" />
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" required="required" placeholder="Password" name="user_pass"/>
                                </div>
                               
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success btn-block btn-lg" value="Sign in" name="submit"/>ENTER</button>
                                </div>

                                <div class="form-group">
                                    <?php
                                             echo '<p class="error_message" style="font-family:verdana;" onclick="newDoc()" id="but" value="1" >Forgot Password?</p>

                                              <div style="text-align:center;"> <p id ="error1"></p></div>';


                                            
?>
                                </div>
                             </div>

                        </div>
                    </div>

                    </form>
                </div>

            </div>

        </div>


    </div>
<?php

}
else if(isset($_POST['submit']) && $_POST['submit']==='Sign Up')
{

    echo"script";
    /* so, the form has been posted, we'll process the data in three steps:
        1.  Check the data
        2.  Let the user refill the wrong fields (if necessary)
        3.  Save the data 
    */
    $errors = array(); /* declare the array for later use */
        $username=test_input($_POST['user_name']);
        $pass =test_input($_POST['user_pass']);
        $email = test_input($_POST['user_email']); 
    if(isset($username))
    {
        //the user name exists
        if(!ctype_alnum($username))
        {
            $errors[] = 'The username can only contain letters and digits.';
        }
        if(strlen($username) > 30)
        {
            $errors[] = 'The username cannot be longer than 30 characters.';
        }
    }
    else
    {
        $errors[] = 'The username field must not be empty.';
    }
     
     
    if(isset($pass))
    {
        if($pass != $_POST['user_pass_check'])
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
        echo '<p class="error_message" style="color:#380000;">Error! A few fields are not filled properly</p>';
        echo '<ul>';
        foreach($errors as $key => $value) /* walk through the array so all the errors get displayed */
        {
            echo '<li>' . $value . '</li>'; /* this generates a nice error list */
        }
        echo '</ul>';
        echo '<a href="http://localhost/a/reg/reg.php"> Try Again!</a>';
    }
    else
    {
                        //the form has been posted without errors, so save it
                        //notice the use of mysql_real_escape_string, keep everything safe!
                        //also notice the sha1 function which hashes the password
                       
                //WRITE THE OTP CODE HERE

     if(!isset($_GET['otp'])){
                 $Mail= mysqli_real_escape_string($conn,$email);
                 ?>
                 <div class="col-sm-12 col-lg-4 col-md-12 head-text"></div>
                 <div class="col-sm-12 col-lg-4 col-md-12 head-text">
                        <div class="div-trans text-center">
                            <h3> <?php echo "OTP is sent to your email<br>".$Mail; ?> </h3><br>


<?php
                    //echo "An One Time Password is sent to your registered email address<br>".$Mail;
               // echo "is it working";
                            //generate mail msg is $msg
                            $msg=rand();
                           echo $msg;
                            $_SESSION['check']=$msg;
                           echo 'msg';


                            //write here Code to send otp to user
echo "st1";
                 require 'phpmailer/PHPMailerAutoload.php';
echo "string";
                                    $message = 'The one time password to create your account on  Pragati-CWC account is'.$msg;
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

                                    $mail->addAddress($Mail);  //send to email

                                    $mail->Subject = $subject;

                                    $mail->msgHTML($message);

                                    if (!$mail->send()) {
                                       $error = "Mailer Error: " . $mail->ErrorInfo;
                                        ?><script>alert('<?php echo $error ?>');</script><?php
                                    } 
                                   else {
                                      echo '<script>alert("Message sent!");</script>';
                                   }

                $_SESSION['name']=$username;
                $_SESSION['email']=$email;
                $_SESSION['pass']=$pass;
                            //mail("$mail","subject",$msg);


?>
                <div class="col-lg-12 col-md-12 col-sm-12" >

                                <div class="form-group">
                                    <h3> Enter OTP: </h3>
                                    <input type="text" class="form-control" required="required"  id="otp" placeholder="Enter One Time Password" />
                                </div><br>
                                
                                
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success btn-block btn-lg" value="SUBMIT"  onClick="myfunc()"/>SUBMIT</button>
                                </div>
                                 <p id="error"></p>

                                
                             </div>

                        </div>
                        <div class="col-sm-12 col-lg-4 col-md-12 head-text"></div>

<?php
                //echo "string";
                           // echo 'Enter OTP: <input type="text" id="otp" >';
                           // echo '<input type="submit" value="SUBMIT" onClick="myfunc()">';   //user have to fill the otp 

                           // echo '<p id="error"></p>';
        }   
  
    } 
}elseif (isset($_POST['submit']) && $_POST['submit']==='Sign in') {
            /* so, the form has been posted, we'll process the data in three steps:
            1.  Check the data
            2.  Let the user refill the wrong fields (if necessary)
            3.  Varify if the data is correct and return the correct response
        */

            //echo"dfd";
        $errors = array(); /* declare the array for later use */
                     $name=test_input($_POST['user_name']);
                    $pass=test_input($_POST['user_pass']);
        if(!isset($name))
        {
            $errors[] = 'The username field must not be empty.';
        }
         
        if(!isset($pass))
        {
            $errors[] = 'The password field must not be empty.';
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
        }
        else
        {
            //the form has been posted without errors, so save it
            //notice the use of mysql_real_escape_string, keep everything safe!
            //also notice the sha1 function which hashes the password
            
            $sql = "SELECT  
                        user_id,
                        user_name,
                        user_level
                    FROM
                        users
                    WHERE
                        user_name = '" . mysqli_real_escape_string($conn,$name) . "'
                    AND
                        user_pass = '" . sha1($pass) . "'";
                         
            $result = mysqli_query($conn,$sql);
            if(!$result)
            {
                //something went wrong, display the error
                echo '<p class="error_message">Something went wrong while signing in. Please try again later.</p>';
                //echo mysql_error(); //debugging purposes, uncomment when needed
            }
            else
            {
                //the query was successfully executed, there are 2 possibilities
                //1. the query returned data, the user can be signed in
                //2. the query returned an empty result set, the credentials were wrong
                if(mysqli_num_rows($result) == 0)
                {


?>
                    <div class="col-sm-12 col-lg-4 col-md-12 head-text"></div>
                 <div class="col-sm-12 col-lg-4 col-md-12 head-text">
                        <div class="div-trans text-center">
                            



                            <div class="col-lg-12 col-md-12 col-sm-12" >

                                <div class="form-group">
                                    <h3> <p>You have supplied a wrong user/password combination.
                    <a  class="btn btn-success btn-block btn-lg"  href="reg.php">Try again</a>
                    <br>Do not have an account,yet?</p></h3>
                                </div><br>
                                
                                
                                <div class="form-group">
                                    <a  class="btn btn-success btn-block btn-lg" href="reg.php"> Sign Up</a>   
                                </div>
                                 

                                
                             </div>

                        </div>
                        <div class="col-sm-12 col-lg-4 col-md-12 head-text"></div>

<?php



                    //echo '<br><br><br><p class="error_message">You have supplied a wrong user/password combination.
                   /// <a href="">Try again</a>
                   // <br>Do not have an account,yet?<a href="reg.php"> Sign Up</a></p>';
                }
                else
                {
                    //set the $_SESSION['signed_in'] variable to TRUE
                    $_SESSION['signed_in'] = true;
                     
                    //we also put the user_id and user_name values in the $_SESSION, so we can use it at various pages
                    $row = mysqli_fetch_assoc($result);
                        $_SESSION['user_id'] = $row['user_id'];
                        $_SESSION['user_name']  = $row['user_name'];
                        $_SESSION['user_level'] = $row['user_level'];
            
   //                 echo $_SESSION['user_name']  ;

         
                    if(isset($_GET['s'])){
                        $t=$_GET['s'];                  //index to decide what to do after signing in
                        if(isset($_GET['qid'])){        
                            $pid=$_GET['qid'];          //index to be set if to delete question or comment on that question afer signing in
                        }
                        if(isset($_GET['t'])){
                            $colindex=$_GET['t'];       //index to be set if to delete comment after signing in
                        }
                        header("Location: http://localhost/a/check.php?s=$t&qid=$pid&t=$colindex");
                    }else{
                            header("Location: http://localhost/a/question/questions.php");
                 //   echo "string";
                 /*   echo"<div style='float:right'><a href='signout.php'>Sign out</a></div>";
                    echo '<p class="text1">Welcome, ' . $_SESSION['user_name'] . '. <a href="qpost.php">Start a new discussion.</a>.</p>';   
                    echo '<br><a style="font-family:verdana; text-align:center;" href="changepass.php">Change your password</a><br><p id="error"></p>';  */
                    }
                }
            }
        }
    
}
?>
					
					<!--
                    <div class="col-sm-12 col-lg-3 col-md-3" style="float:right">
                        <div class="div-trans text-center">
                            <h3>Upload Your</h3>
                            <h3>Profile Pic</h3>
                            <div class="col-lg-12 col-md-12 col-sm-12" >

                           
                                
                                <div class="form-group" >
                                    <button type="submit" class="btn btn-success btn-block btn-lg">Choose a Pic</button>
                                </div>
                               
							   <div class="form-group">
                                    <input type="text" class="form-control" required="required">
                                </div>
							   
                                <div class="form-group" >
                                    <button type="submit" class="btn btn-success btn-block btn-lg">Upload</button>
                                </div>
                             </div>

                        </div>
                    </div>
					
					-->

    
<?php

 function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?>
</body>


<script type="text/javascript">
function newDoc() {
    var x= document.getElementById("UserName").value;
    if(x==''){
    document.getElementById("error1").innerHTML='Username field is Empty';
    }
    else{
    window.location.assign("http://localhost/a/reg/changepass.php?user="+x+"")
    }
}

</script>

<script>
function myfunc(){
     var x= document.getElementById("otp").value;
    if(x==''){
    document.getElementById("error").innerHTML='Fill Otp sent to your email.';
    }
    else{
    var y = "(<?php echo $user1 ?>)";

    window.location.assign("reg.php?otp="+x+"")
    
        }
}

</script>
</html>
