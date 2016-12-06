<?php include "header2.php" ?>


<!DOCTYPE html>
<html lang="en-US">
   <head>
      <link rel="stylesheet" href="assist/css/components.css">
      <link rel="stylesheet" href="assist/css/icons.css">
      <link rel="stylesheet" href="assist/css/responsee.css"> 
      <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
        <link href="materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>


      <script type="text/javascript" src="assist/js/jquery-1.8.3.min.js"></script>
      <script type="text/javascript" src="assist/js/jquery-ui.min.js"></script>    
   </head>
   
   <body class="size-1280">
 <br><br><br><br><br>


       <!-- ASIDE NAV AND CONTENT -->
      <div class="line">
         <div class="box">
            <div class="margin2x">
               <!-- CONTENT -->
               <section class="s-12 m-8 l-9 right">
               <div class="fixed-action-btn horizontal" style="top: 120px; right: 5px;">
    <a href="http://localhost/a/qpost/qpost.php" class="btn-floating btn-large red">
      <img src='discuss.png' alt='discuss' class='responsive-img'>
    </a>
  </div>

  <div class="fixed-action-btn horizontal" style="bottom: 45px; right: 5px;">
    <a href="http://localhost/a/useraccount/useraccount.php" class="btn-floating btn-large red">
      <img src='account.png' alt='my account' class='responsive-img'>
    </a>
  </div>

                
                  <div class="margin">
 
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
   

          $sql = "SELECT * from `users` ";
            $result = $conn->query($sql);
         while($row = $result->fetch_assoc()){
               $rowcount=0;
               $sq = "SELECT * FROM `master` WHERE uid=$row[user_id]";
               $resul = mysqli_query($conn,$sq);
               $rowcount=mysqli_num_rows($resul);

                // NO OF ANSWERS
                $sqls = "SELECT qans from `users` WHERE user_id=$row[user_id]";
            $results = $conn->query($sqls);
      $rows = $results->fetch_assoc(); 
      $id=$rows['qans'];

         //TAGS
            $id=$row['fav_tags'];
            $arr=explode(",",$id);
             $l=count($arr);
             $i=0;
             $tag=array();
            while($l--){
                     $temp= $arr[$i];
                      $i++;
                  if(is_numeric($temp)){
                          $sqa = "SELECT cat_name FROM `categories` WHERE cat_id=$temp";
                      $resa = mysqli_query($conn,$sqa);
                     $roa = $resa->fetch_assoc();
                     $tag[] = $roa['cat_name'] ;
                   }

              }


  
                echo"  
                     <div class='col s-12 m-6 l-2' title='$row[user_name] &#13 Questions: $rowcount  ";
    /*            if(!(is_null($id))){
            
                                                    $l=0;
                                                    $arra=explode(',',$id);
                                                   $l=count($arra);
                                                    $i=0;

                                                      echo $l;
                                                                            echo " &#13";
                                             }else{
                                                   echo 0;                       }
                                                   */
              echo " &#13";
              if(is_numeric($temp)){
               $arrlength = count($tag);
if($arrlength){echo "Favorite Tags:&#13";}
                  for($x = 0; $x < $arrlength; $x++) {
                      echo $tag[$x] ;
                      echo " &#13";
                  }
              }   
               echo " '>";
           //    echo $row['user_id'];
              ?>
                                                    
                     <a href="http://localhost/a/detail/userdetail.php?uid=<?php echo $row['user_id']; ?>"> <img height="100%" src='<?php  if(is_null($row['user_pic'])){
                        echo " http://localhost/a/useraccount/images/default.jpg";
                      }else{
                        echo "http://localhost/a/useraccount/$row[user_pic]";}?> '></a>
                  
                        <strong><?php echo "$row[user_name]";?></strong><br>
                        
                     </div>







                  
             
<?php
}
}else{
      $uid= $_GET['uid'];

      header('Location:userdetail.php?uid=$uid');
}
?>
		
		
		</div>		  
               </section>
			   
			   <!-- ASIDE NAV -->
               <aside class="s-12 m-4 l-3">
                  <img class="responsive" src="users.gif">
                  <h1>USERS</h1>
               </aside>
			   
			   

      <script type="text/javascript" src="js/responsee.js"></script>      
   </body>
</html>
