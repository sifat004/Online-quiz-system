<?php
  require_once ('../db/database_connection.php');


if(isset($_POST['cid'])){
    $C_ID =$_POST['cid'];
  
   $sql= "DELETE FROM ".$TABLE_COURSE_INFO." WHERE ".$COL_COURSE_ID." = '$C_ID'";

    //  echo  $sql; 

    $result= mysqli_query($connection,$sql);

  
        header('location:show_course_list.php?msg=Data Deleted ');
    
    
}

?>