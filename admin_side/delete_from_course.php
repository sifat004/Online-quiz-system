<?php
  require_once ('../db/database_connection.php');


if(isset($_POST['exid'])& isset($_POST['cid'])){
    $exid =$_POST['exid'];
        $cid =$_POST['cid'];

  
   $sql= "DELETE FROM ".$TABLE_EXAM_INFO." WHERE ".$COL_EXAM_ID." = '$exid'AND ".$COL_COURSE_ID." = '$cid'";

      //echo  $sql; 

    $result= mysqli_query($connection,$sql);

   

  
    header('location:show_course_list.php?msg=Data Deleted ');
    
    
}


if(isset($_POST['tid']) & isset($_POST['cid'])){
    $tid =$_POST['tid'];
    $cid =$_POST['cid'];

  
   $sql= "DELETE FROM ".$TABLE_COURSE_REG_TEACHER." WHERE ".$COL_TEACHER_ID." = '$tid' AND ".$COL_COURSE_ID." = '$cid'";

      //echo  $sql; 

    $result= mysqli_query($connection,$sql);

  
    header('location:show_course_list.php?msg=Data Deleted ');
    
    
}


if(isset($_POST['sid']) & isset($_POST['cid'])){
    $sid =$_POST['sid'];
    $cid =$_POST['cid'];

  
   $sql= "DELETE FROM ".$TABLE_COURSE_REG_STUDENT." WHERE ".$COL_STUDENT_ID." = '$sid' AND ".$COL_COURSE_ID." = '$cid'";

      //echo  $sql; 

    $result= mysqli_query($connection,$sql);

  
    header('location:show_course_list.php?msg=Data Deleted ');
    
    
}


if(isset($_POST['qid']) & isset($_POST['exid'])){
    $qid =$_POST['qid'];
    $exid =$_POST['exid'];

  
   $sql= "DELETE FROM ".$TABLE_EXAM_QUESTION_INFO." WHERE ".$COL_QUESTION_ID." = '$qid' AND ".$COL_EXAM_ID." = '$exid'";

      //echo  $sql; 

    $result= mysqli_query($connection,$sql);

  
    header('location:show_questions_of_exam.php?msg=Data Deleted ');
    
    
}

?>