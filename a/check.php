<?php
session_start();
$temp=$_GET['s'];
   $l='';
       $pid='';
       
if(isset($_GET['qid'])){
    $l=$_GET['qid'];
}
if(isset($_GET['t'])){
    $pid=$_GET['t'];
    echo "dfjkf";
    echo $pid;
}

if(isset($_SESSION['signed_in']) && $_SESSION['signed_in'] == true)
{
    if($temp==3){                                                         //when clicked start a new discussion
        header('Location: http://localhost/a/qpost/qpost.php');          
    }else if ($temp==2){                                                  // when signed in after clicking on delete question
        
        header("Location: http://localhost/a/answer/answer.php?x=1&qid=$l");    
        
    }else if ($temp==1){                                                    // when signed in after clicking on delete comment

        header("Location: http://localhost/a/answer/answer.php?x=2&qid=$l&t=$pid");    
        
    }else if($temp==4){
        header("Location: http://localhost/a/useraccount/useraccount.php?uid=$pid");
    }
    
}
    else{                                                                  //error =1 would imply that 'you need to sign in should be shown'
      header('Location:http://localhost/a/reg/reg?error=1.php'); 
}



?>
