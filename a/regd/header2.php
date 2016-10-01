<!DOCTYPE html>
<html lang="en">

<head>
<style>
header { width: 100%; position: fixed; top: 0px; left: 0px; height: 105px; background: rgba(0, 0, 0, 0.5); z-index: 9; }
header .Center { max-width: 1100px; margin: auto; }
header .site-logo { padding: 30px 0px 0px 0px; width: 220px; float: left; transition: all 0.3s;  }
header .site-logo h1 { margin: 0px; }
header .site-logo h1 a { font-size: 36px; color: #fff; font-family: 'Open Sans', sans-serif; font-weight: 800; text-decoration: none; text-transform: uppercase; text-shadow: rgb(3, 3, 3) 0px 2px 5px; transition: all 0.7s ease;  }
header .site-logo h1 a span { color: #ff9000; }
header.smaller { padding: 0px 0px 0px 0px; height: 60px; transition: all 0.3s; background: rgba(0, 0, 0, 0.75); }
header.smaller .site-logo {padding: 13px 0px 0px 0px; }
header.smaller .site-logo h1 { line-height: 30px; }
header.smaller .site-logo h1 a { font-size: 30px;  }

/* <<< Navigation >>> */
.Navigation { float: right; width: 68.18%; margin-right: 11px; }
.Navigation ul { list-style: none; margin: 0px; float: right; }
.Navigation li { float: left; padding: 0px;  margin: 0px; height: 105px; position: relative; transition: all 0.3s ease; }
.Navigation li a { padding: 42px 41px 36px 41px; font-size: 16px; color: #fff; font-family: 'Open Sans', sans-serif; font-weight: 400; text-decoration: none; display: block; -webkit-transition: all 0.3s ease; transition: all 0.3s ease; }
.Navigation li span { 
	border-bottom: solid 5px #ff9000;
	background: rgba(56,87,122,1);
	background: -webkit-gradient(left top, left bottom, color-stop(0%, rgba(56,87,122,1)), color-stop(0%, rgba(56,87,122,1)), color-stop(0%, rgba(56,87,122,1)), color-stop(100%, rgba(44,68,94,1)));
	background: linear-gradient(to bottom, rgba(56,87,122,1) 0%, rgba(56,87,122,1) 0%, rgba(56,87,122,1) 0%, rgba(44,68,94,1) 100%);
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#38577a', endColorstr='#2c445e', GradientType=0 );
	width: 100%;
	height: 100%;
	display: block;
	position: absolute;
	top: 0;
	left: 0;
	z-index: -10;
	opacity: 0;
	transition: all 0.5s ease;
}
.Navigation li:hover span, .Navigation li.active span {
	opacity: 1;
}

header.smaller .Navigation li a { padding: 16px 41px; }
header.smaller .Navigation li { height: 60px; }

.mobile { display: none;  }
.mobile .fa { padding: 12px 14px; font-size: 31px; width: 55px; height: 55px; color: #fff; cursor: pointer; background: #ff9408; }
.mobile .fa:hover { background: #e3860e; }
.mobile.closed .fa-bars { display: none; }
.mobile .fa-times { padding: 11px 15px; width: 55px; height: 55px; display: none; font-size: 31px; }
.mobile.closed .fa-times { display: block; }


</style>




    <meta charset="utf-8" />
    
    <!-- Title Tag -->
    <title>PRAGATI</title>

    <!-- <<Mobile Viewport Code>> -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
            
    <!-- <<Attched Stylesheets>> -->
    
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
                                <a href="http://localhost/a/home/homes.php">Home</a>
                                <span class="menu-item-bg"></span>
                            </li>
                            <li>
                                <a href="http://localhost/a/question/questions.php">Forum</a>
                                <span class="menu-item-bg"></span>
                            </li>
                            <li>
                                <a href="#services">Discussion Topics</a>
                                <span class="menu-item-bg"></span>
                            </li>
                            <li>
                                <a href="http://localhost/a/user.php">Users</a>
                                <span class="menu-item-bg"></span>
                            </li>
                            <li>
                                                                    <?php
                                    session_start();
                                    if(!isset($_SESSION['signed_in'])){
                                    echo"<li class='b' style='float:right' ><a href='http://localhost/a/reg/reg.php'>Sign in</a><span class='menu-item-bg'></span></li>";
                                    }else{
                                    echo"<li class='b' style='float:right' ><a href='http://localhost/a/reg/signout.php'>Sign out</a><span class='menu-item-bg'></span></li>
                                    ";
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
</body>