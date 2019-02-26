<?php

        include("start_session.php");

    


  
 
 
    if (isset($_POST['exid'])) {
  $exid =$_POST['exid'];
   $sid=$_POST['sid'] ;

  $cid=$_POST['cid'] ;  


  $_SESSION['sid']=$sid;
    $_SESSION['cid']=$cid;
  $_SESSION['exid']=$exid;

    }

    else{
  $exid =$_SESSION['exid'];
   $sid=$_SESSION['sid'] ;

  $cid=$_SESSION['cid'] ;


    }
  
 


  

  require_once ('../db/database_connection.php');



  $sql= " SELECT * FROM ".$TABLE_EXAM_STUDENT_RESULT.
        " JOIN ".$TABLE_EXAM_INFO.
        " ON ".$TABLE_EXAM_STUDENT_RESULT.".".$COL_EXAM_ID.
        " = ".$TABLE_EXAM_INFO.".".$COL_EXAM_ID.

        " WHERE ".$TABLE_EXAM_STUDENT_RESULT.".".$COL_EXAM_ID." = '$exid'".
        " AND ".$TABLE_EXAM_STUDENT_RESULT.".".$COL_STUDENT_ID." = '$sid'";




          $result=mysqli_query($con,$sql);
          $value=mysqli_fetch_array($result);
          


?>

<head>
    <title> Show Results</title>

   
      <link rel="stylesheet" href="../css/navbar.css">

      <link rel="stylesheet" href="../css/card.css">


</head>




<body>



 
    <?php include("navbar.php");?>


 

  <div class="wrapper">
   
  <?php



                  echo "<div class='card'>
                      <h3 class='card-title'>".$value[$COL_STUDENT_ID]."</h3>
                      
                      <p class='card-content'>Couse ID:   ".$value[$COL_COURSE_ID]."<br>
                      Exam ID:  ".$value[$COL_EXAM_NAME]."<br><br>
                      Marks:".
                     "<h2>".$value[$COL_MARKS]."/".$value[$COL_EXAM_FULL_MARKS]."</h2".


                      "</p>


                           <form action='show_answers_of_exam.php' method='POST' style='display:inline'>

                            <input type= 'hidden' name='cid' value='".$value[$COL_EXAM_ID]."' readonly='true'/>


                            <input type= 'submit' class='card-btn' id='' value='SHOW ANSWERS' />

                        </form>

                     
                    </div>";




                       ?>

                     </div>
       
</body>








