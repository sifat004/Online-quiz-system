

<?php
   ini_set('session.cache_limiter','public');
    session_cache_limiter(false);

    session_start();
 
 
    require_once ('../db/database_connection.php');

  if(isset($_POST['cid']) ){
  
    $_SESSION['cid'] = $_POST['cid']; 


}

 $cid=$_SESSION['cid'];

  if(isset($_POST['status']) ){

    $status=$_POST['status'];
    $exid=$_POST['exid'];
  
    $sql=" UPDATE ".$TABLE_EXAM_INFO." SET ".$COL_EXAM_STATUS." = ".$status." WHERE ".$COL_EXAM_ID." = '$exid'"." AND "
       .$COL_COURSE_ID." = '$cid'";
   mysqli_query($connection,$sql);

}




  $sql= "SELECT * FROM ". $TABLE_COURSE_INFO." WHERE ".$COL_COURSE_ID." = '$cid'";
  $course= mysqli_query($connection,$sql);
  
  $sql= " SELECT * FROM ".$TABLE_EXAM_INFO." WHERE ".$COL_COURSE_ID." = '$cid'";
  $exams_of_course=mysqli_query($connection,$sql);

?>

<head>
    <title> Show Exams</title>

      <link rel="stylesheet" href="../css/pure/pure-min.css">
      <link rel="stylesheet" href="../css/table.css">

            <link rel="stylesheet" href="../css/buttons.css">



</head>




<body>



 
<table class="container">

        <thead>
       
         <th>Course Code </th>
<!--     <th>Course Title </th>
         <th>Department </th> -->
         <th>Exam Name </th>
         <th>Year </th>
         <th>Semester </th>
         <th>Full Marks </th>
         <th>Duration </th>
         <th>Date </th>
         <th>Status </th>
         <th>Action </th>
     
        </thead>
        
  <?php
        foreach ($exams_of_course as $key=>$value){





                echo 

                "<tr>
                <td>".$value[$COL_COURSE_ID]."</td>
                <td>".$value[$COL_EXAM_NAME]."</td>
                <td>".$value[$COL_YEAR]."</td>
                <td>".$value[$COL_SEMESTER]."</td>
                
                <td>".$value[$COL_EXAM_FULL_MARKS]."</td>
                <td>".$value[$COL_EXAM_DURATION]."</td>
                <td>".$value[$COL_EXAM_DATE]."</td>
                <td>"."



     
                        <form action='show_exams_of_course.php' method='POST' style='display:inline'>

                            <input type= 'hidden' name='exid' value='".$value[$COL_EXAM_ID]."' readonly='true'/>".
                            

                        ($value[$COL_EXAM_STATUS]==1 ? 
                        "<input type= 'submit' name='status' class='button-success' id='' value='1' />"
                        :
                        "<input type= 'submit' name='status' class='button-primary' id='' value='1' />").

                       

                        ($value[$COL_EXAM_STATUS]==2 ? 
                       "<input type= 'submit' name='status' class='button-success' id='' value='2' />"
                        :
                       "<input type= 'submit' name='status' class='button-primary ' id='' value='2' />").


                        ($value[$COL_EXAM_STATUS]==3 ? 

                        "<input type= 'submit' name='status' class='button-success' id='' value='3' />"
                        : 
                       "<input type= 'submit' name='status' class='button-primary' id='' value='3' />").

                        "</form>
                </td>


                ";




              





                echo "<td>
                       
                        
                        <form action='add_question_for_exam.php' method='POST' style='display:inline'>

                            <input type= 'hidden' name='exid' value='".$value[$COL_EXAM_ID]."' readonly='true'/>
                            <input type= 'submit' class='button-primary' id='' value='ADD QUES' />

                        </form>

                        <form action='show_questions_of_exam.php' method='POST' style='display:inline'>

                            <input type= 'hidden' name='exid' value='".$value[$COL_EXAM_ID]."' readonly='true'/>
                            <input type= 'submit' class='button-primary' id='' value='SHOW QUES' />

                        </form>


                        <form action='show_results_of_exam.php' method='POST' style='display:inline'>

                            <input type= 'hidden' name='exid' value='".$value[$COL_EXAM_ID]."' readonly='true'/>
                            <input type= 'submit' class='button-primary' id='' value='RESULTS' />

                        </form>


                        <form action='delete_from_course.php' method='POST' style='display:inline'>

                            <input type= 'hidden' name='exid' value='".$value[$COL_EXAM_ID]."' readonly='true'/>
                            <input type= 'hidden' name='cid' value='".$value[$COL_COURSE_ID]."' readonly='true'/>

                            <input type= 'submit' class='button-error' id='' value='REMOVE'/>

                        </form>

                       

                </td>
                </tr>";
                  
                
            }
            ?>
        </tbody>



</table>



<div>

                 

     <form   method="post" style="text-align: center;margin-top: 60px;color: #000">

   <!--       <button name="home" type="submit" class="btn-success pure-button" id="" formaction="add_course.html" >
             Add Course
          </button> -->
                 
          <button name="home" type="submit" class="pure-button warning" id=""  formaction="admin_home.php" > 
              Go home
          </button>
             
      </form>
  

</div>

       
</body>









   