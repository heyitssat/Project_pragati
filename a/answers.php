<?php
session_start();
if(isset($_GET['qid'])){
$pid = $_GET['qid'];}else{
  header('Location:news.php');
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
    echo "<p class='error_message'>Oops!You are not signed in!</p> <a href='http://localhost/a/reg/reg.'> Click here </a>to sign in.<br>";
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
           


                $rown=0;
                $query = "SELECT * from `question$pid`";
                $result = $conn->query($query);
            while($row = $result->fetch_assoc()) {
                $rown++;   
            }                  
                $count=$sid;                                    //updating the values which come after $pid to -1.
                while($count<=$rown){
                $z=$count+1;
                $sql="UPDATE `question$pid` SET `id`=$count WHERE id=$z";
                
                if($conn->query($sql)){
#echo " row $count  updated ";
        }
                
                $count++;
                }
               $y=$rown +1;
                $sql="ALTER TABLE `question$pid` AUTO_INCREMENT = $y";
        
        if($conn->query($sql)){
#echo "auto increment updated";
        }
             
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
                $count=$pid;                                    //updating the values which come after $pid to -1.
                while($count<=$rown){        //= is applied as the rown is the no. of rows after deletion.
                $z=$count +1;
                $sql="UPDATE `master` SET `qid`=$count WHERE qid= $z";
                if($conn->query($sql)){
                    #echo " row $count  updated ";
                    }
                $count++;
                }
                $y=$rown +1;
                $sql="ALTER TABLE `master` AUTO_INCREMENT = $y";
if($conn->query($sql)){
#echo "auto increment updated";
}
                $pql = "DROP TABLE question$pid";
if($conn->query($pql)){
#echo "table question$pid dropped";
}
                $count=$pid;                                    //updating the values which come after $pid to -1.
            while($count<=$rown){       // = is applied as the rown is the no. of rows after deletion.
                $y=$count+1;
                $pql="RENAME TABLE `question$y` TO `question$count`";
            if($conn->query($pql)){
                    #echo "table question$y renamed";
                    }

                $count++;
                }
                header('Location: news.php');
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
    echo "check";
        if(!isset($_SESSION['signed_in'])) {
            header('Location: http://localhost/a/reg/reg.php?error=1');
  }
  else {
    $b=test_input($_POST['cmmnt']);
    $a=$_SESSION['user_name'];
    $c=$_SESSION['user_id'];

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
        if (strpos($row['qans'], $pid) == false){
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
   $sql="INSERT INTO `question1` (`uid`, `aname`, `acmmnt`, `avote_up`, `avote_down`, `aqvote`, `reg_date`) VALUES
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

<html>

<head>

<script src="ckeditor/ckeditor.js"></script>
 
<link href="ans.css" rel="stylesheet">
<meta charset="UTF-8">
<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">
<link href="font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">

 <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
</head>

<body>
<div id="body_wrapper">
<div id="rightcolumn">


<div id="centercolumn">


      <div id="centercolumn_2">
	<?php 
// fetch the question
 $query = "SELECT * from `master` WHERE qid= $pid";
 $result = $conn->query($query);
 $row = $result->fetch_assoc();

?>      
        <!-- Start of News Box 1 -->
  <div class="newsbox">
          <div class="newsbox_header">
            <!-- News Date and time-->
            <strong style="float:left">POSTED BY:<?php echo "$row[qname]";?></strong>
             <strong><?php echo "$row[qvote]";?></strong><br>    
            <strong><?php echo "$row[reg_date]";?></strong>
            <div class="clearthis">&nbsp;</div>
          </div>
          <div class="newsbox_content">
            <!-- News Text -->
            <h4><?php echo "$row[question]";?></h4>
      
      <div class="col s12 m8 offset-m2 l6 offset-l3">
      <div class="row valign-wrapper">
             
       <div class="col s2">
              <details>
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
            </details>
            </div>
      
            <div class="col s8">
            <center><div> No of Ans:<?php echo "$row[ans]";?></div></center>
            </div>
      <?php
      if(isset($_SESSION['user_name']) && $_SESSION['user_name']==$row['qname']){
       
                    echo "<a role='button' class='btn btn-succes'href='http://localhost/a/check.php?s=2&qid=$pid&x=1' >Delete your question</a>";}?>
      


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
         echo "<a href='answers.php?vote=1&qid=$pid'><div class='col s1'>
               <img src='up.png' alt='' class='circle responsive-img' >upvote
            </div></a>";

     }else{
         echo "<a href='answers.php?vote=0&qid=$pid'><div class='col s1'>
               <img src='down.png' alt='' class='circle responsive-img' >downvote
            </div></a>";
     }
}
      ?>
      
          </div>
      </div>
          </div>
        </div>

<?php 
// fetch all the answers
$pid=$row['qid'];
echo $pid;
$query = "SELECT * from `question$pid` ";
$result2 = $conn->query($query);
if($rowcount=mysqli_num_rows($result2)){

while($row2 = $result2->fetch_assoc()){

?> 
        <div class="newsbox">
                  <div class="newsbox_header">
            <!-- News Date and time-->
             <strong><?php echo "$row2[aqvote]";?></strong><br>             
            <strong><?php echo "$row2[reg_date]";?></strong>
          </div>            <div class="clearthis">&nbsp;</div>

          <div class="newsbox_content">
            <!-- News Text -->
      
      <div class="col s12 m8 offset-m2 l6 offset-l3">
      <div class="row valign-wrapper">
            <div class="col s2">
              <img src="satyam.jpg" alt="" class="circle responsive-img" > <!-- notice the "circle" class -->
            </div>
            <div class="col s8">
                <?php echo "$row2[aname]";?><br>
               
            </div>

<?php
//vote the comment
    if(isset($_SESSION['signed_in'])){
        $Query= "SELECT * from `likes` WHERE question_id=$pid AND user_id=$_SESSION[user_id] AND comment_id=$row2[id] ";
        $Result = $conn->query($Query);
        $Row = $Result->fetch_assoc();
        $rowcount=mysqli_num_rows($Result);
             
        if(!$rowcount){

         echo "<a href='answers.php?vote=1&qid=$pid&cid=$row2[id]'><div class='col s1'>
               <img src='up.png' alt='' class='circle responsive-img' >upvote
            </div></a>";
         }else{
            echo "<a href='answers.php?vote=0&qid=$pid&cid=$row2[id]'><div class='col s1'>
               <img src='down.png' alt='' class='circle responsive-img' >downvote
            </div></a>";

         }  
    }
?>

      
          </div>
      </div>
            <p> <?php echo "$row2[acmmnt]<br>";?>
                               </p>
    <?php if(isset($_SESSION['user_name']) && $_SESSION['user_name']==$row2['aname']){?>
            <a class='btn btn-succes' style='font-size:90%' role='button' href='http://localhost/a/check.php?s=1&t=$row[id]&qid=$pid' >Delete</a>
          </div>
        </div><?php }?>
        <!-- End of News Box 1 -->

<?php

  }
}?>
  <!-- End of News Box 1 -->
  

    </div>
      </div>
	  <!--RIGHT SIDE BAR-->
	  <div id="rightsidebar">


	  
	  </div>
	  
    </div>
	<!--LEFT COLOUMN-->
	<div id="leftcolumn">
	<div id="leftsidebar">
	
	<form method='post' action='http://localhost/a/qpost/qsubmit.php' id='a'>
	<center>
	<table>
		<ul class="collection">
		<li class="collection-item">
			<textarea name='question' class='ckeditor' required style='width:100%'></textarea>
		</li>
		<li class="collection-item">
			<button class="btn waves-effect waves-light" type="submit" name="action">Submit
			<i class="material-icons right">send</i>
			</button>
		</li>
		</ul>
	</table>
	</center>
	</form>
	
		
	</div>
	
	
	</div>
	
	</div>
	
	
	
	
	<script type='text/javascript' src='js/jquery.js'></script>
<script type='text/javascript' src='js/bootstrap.min.js'></script>
<script type='text/javascript' src='js/scrollReveal.js'></script>
<script type='text/javascript'>
jQuery(document).ready(function(){  
		
			
				$(".top").click(function(){
					$("html, body").animate({ scrollTop: 0 }, "slow");
					return false;
				});
				$(".btMenu").click(function(){
			
					if($(".menu").children(".menuItem").css("display") == "none"){
						$(".menu").children(".menuItem").slideDown();
					}
					else{
						$(".menu").children(".menuItem").slideUp();
					}
				});
				$(window).resize(function(){
					if($(window).innerWidth() > 900){
						$(".menu").children(".menuItem").css("display", "block");
					}
					else{
						$(".menu").children(".menuItem").css("display", "none");
					}
				});
				
				(function(k){'use strict';k(['jquery'],function($){var j=$.scrollTo=function(a,b,c){return $(window).scrollTo(a,b,c)};j.defaults={axis:'xy',duration:parseFloat($.fn.jquery)>=1.3?0:1,limit:!0};j.window=function(a){return $(window)._scrollable()};$.fn._scrollable=function(){return this.map(function(){var a=this,isWin=!a.nodeName||$.inArray(a.nodeName.toLowerCase(),['iframe','#document','html','body'])!=-1;if(!isWin)return a;var b=(a.contentWindow||a).document||a.ownerDocument||a;return/webkit/i.test(navigator.userAgent)||b.compatMode=='BackCompat'?b.body:b.documentElement})};$.fn.scrollTo=function(f,g,h){if(typeof g=='object'){h=g;g=0}if(typeof h=='function')h={onAfter:h};if(f=='max')f=9e9;h=$.extend({},j.defaults,h);g=g||h.duration;h.queue=h.queue&&h.axis.length>1;if(h.queue)g/=2;h.offset=both(h.offset);h.over=both(h.over);return this._scrollable().each(function(){if(f==null)return;var d=this,$elem=$(d),targ=f,toff,attr={},win=$elem.is('html,body');switch(typeof targ){case'number':case'string':if(/^([+-]=?)?\d+(\.\d+)?(px|%)?$/.test(targ)){targ=both(targ);break}targ=win?$(targ):$(targ,this);if(!targ.length)return;case'object':if(targ.is||targ.style)toff=(targ=$(targ)).offset()}var e=$.isFunction(h.offset)&&h.offset(d,targ)||h.offset;$.each(h.axis.split(''),function(i,a){var b=a=='x'?'Left':'Top',pos=b.toLowerCase(),key='scroll'+b,old=d[key],max=j.max(d,a);if(toff){attr[key]=toff[pos]+(win?0:old-$elem.offset()[pos]);if(h.margin){attr[key]-=parseInt(targ.css('margin'+b))||0;attr[key]-=parseInt(targ.css('border'+b+'Width'))||0}attr[key]+=e[pos]||0;if(h.over[pos])attr[key]+=targ[a=='x'?'width':'height']()*h.over[pos]}else{var c=targ[pos];attr[key]=c.slice&&c.slice(-1)=='%'?parseFloat(c)/100*max:c}if(h.limit&&/^\d+$/.test(attr[key]))attr[key]=attr[key]<=0?0:Math.min(attr[key],max);if(!i&&h.queue){if(old!=attr[key])animate(h.onAfterFirst);delete attr[key]}});animate(h.onAfter);function animate(a){$elem.animate(attr,g,h.easing,a&&function(){a.call(this,targ,h)})}}).end()};j.max=function(a,b){var c=b=='x'?'Width':'Height',scroll='scroll'+c;if(!$(a).is('html,body'))return a[scroll]-$(a)[c.toLowerCase()]();var d='client'+c,html=a.ownerDocument.documentElement,body=a.ownerDocument.body;return Math.max(html[scroll],body[scroll])-Math.min(html[d],body[d])};function both(a){return $.isFunction(a)||typeof a=='object'?a:{top:a,left:a}}return j})}(typeof define==='function'&&define.amd?define:function(a,b){if(typeof module!=='undefined'&&module.exports){module.exports=b(require('jquery'))}else{b(jQuery)}}));
				
				$(".menu").children("li:nth-child(3)").click(function(){
				$("body").scrollTo("#about", 600);
                				
				});
				
				$(".menu").children("li:nth-child(4)").click(function(){
				$("body").scrollTo("#mission", 600);
				});
				
				$(".menu").children("li:nth-child(5)").click(function(){
				
				$("body").scrollTo("#whyus", 600);
				});
				
				$(".menu").children("li:nth-child(6)").click(function(){
				$("body").scrollTo("#whychose", 600);
				});
				
			});

			(function($) {
      window.scrollReveal = new scrollReveal();
    })();
			
</script>
	

	</body>
	</html>