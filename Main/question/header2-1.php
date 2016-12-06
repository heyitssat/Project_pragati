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
<div class="DesignHolder">
	<!-- \\ Begin Frame \\ -->
	<div class="LayoutFrame">
        <!-- \\ Begin Header \\ -->
        <header>
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
                            <li class="active">                                
                                <a href="#home">Home</a>
                                <span class="menu-item-bg"></span>
                            </li>
                            <li>
                                <a href="#about">Forum</a>
                                <span class="menu-item-bg"></span>
                            </li>
                            <li>
                                <a href="#services">Discussion Topics</a>
                                <span class="menu-item-bg"></span>
                            </li>
                            <li>
                                <a href="#pricing">Users</a>
                                <span class="menu-item-bg"></span>
                            </li>
                            
                                    <?php
                                        session_start();
                                    if(!isset($_SESSION['signed_in'])){
                                    echo "<li class='b' style='display:inline;float:right' ><a href='signin.php'>Sign in</a>
                                                <span class='menu-item-bg'></span>
                                                </li>
                                        ";
                                    }else{
                                    echo"<li class='b' style='display:inline; float:right' ><a href='signout.php'>Sign out</a>
                                                <span class='menu-item-bg'></span>
                                                 </li>
                                        ";
                                    }
                                    ?>
                            
                            
                               <li>
                                <a href="#contact">Register</a>
                                <span class="menu-item-bg"></span>
                            </li>


   


                        </ul>
                    </nav>
                    <!-- // End Navigation // -->
				</div>
				</div>
                <div class="clear"></div>
            </div>
        </header>
</body>