<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    
    <!-- Title Tag -->
    <title>PRAGATI</title>

    <!-- <<Mobile Viewport Code>> -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
            
    <!-- <<Attched Stylesheets>> -->
    <link rel="stylesheet" href="css/theme.css" type="text/css" />
    <link rel="stylesheet" href="css/media.css" type="text/css" />
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css" />
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,600italic,400italic,800,700' rel='stylesheet' type='text/css'>    
    <link href='https://fonts.googleapis.com/css?family=Oswald:400,700,300' rel='stylesheet' type='text/css'>

</head>
<body>

<!-- \\ Begin Holder \\ -->
<div >
    <!-- \\ Begin Frame \\ -->
  
        <!-- \\ Begin Header \\ -->
        <header >
            <div class="Center">
                <div class="site-logo">
                    <h1><a href="#">PRAGATI </a></h1>
                </div>
               <div id="mobile_sec">
               <div class="mobile"><i class="fa fa-bars"></i><i class="fa fa-times"></i></div>
                <div class="menumobile">
                    <!-- \\ Begin Navigation \\ -->
                    <nav class="Navigation">
                        <ul>
                            <li >                                
                                <a href="http://localhost/a/home/homes.php">Home</a>
                                <span class="menu-item-bg"></span>
                            </li>
                            <li class="active">
                                <a href="http://localhost/a/question/questions.php">Forum</a>
                                <span class="menu-item-bg"></span>
                            </li>
                            
                            <li>
                                <a href="http://localhost/a/user/user.php">Users</a>
                                <span class="menu-item-bg"></span>
                            </li>
                            <li>
                                <a href="http://localhost/a/home/homes.php">Contact</a>
                                <span class="menu-item-bg"></span>
                            </li>
                            <li>
                                                                    <?php
                                        session_start();
                                    if(!isset($_SESSION['signed_in'])){
                                    echo"<a href='http://localhost/a/reg/reg.php'>Sign in</a><span class='menu-item-bg'></span>";
                                    }else{
                                    echo"<a href='http://localhost/a/reg/signout.php'>Sign out</a><span class='menu-item-bg'></span> ";
                                    }
                                    ?>
                                
                            </li>
                              
                           

   


                        </ul>
                    </nav>
                    <!-- // End Navigation // -->
                </div>
                </div>
                <div class="clear"></div>
            </div>
        </header>

        <script type="text/javascript" src="js/jquery-1.11.0.min.js"></script>
<script type="text/javascript" src="js/jquery.sudoSlider.min.js"></script>
<script type="text/javascript" src="js/global.js"></script>
<script type="text/javascript" src="js/modernizr.js"></script>
</body>
