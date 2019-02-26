

<?php
    

     include("start_session.php");

 
    require_once ('../db/database_connection.php');

  if(isset($_POST['cid']) ){
  
    $_SESSION['cid'] = $_POST['cid'];

    $_SESSION['sid'] = $_POST['sid'];

   



}

 $cid=$_SESSION['cid'];

  $sql= "SELECT * FROM ". $TABLE_COURSE_INFO." WHERE ".$COL_COURSE_ID." = '$cid'";
  $course= mysqli_query($connection,$sql);

         // echo $sql;

  
  $sql= " SELECT * FROM ".$TABLE_EXAM_INFO." WHERE ".$COL_COURSE_ID." = '$cid'";
  $exams_of_course=mysqli_query($connection,$sql);

        //  echo $sql;


?>

<head>
    <title> Show Course</title>
          <link rel="stylesheet" href="../css/navbar.css">


      <link rel="stylesheet" href="../css/pure/pure-min.css">
      <link rel="stylesheet" href="../css/table.css">
            <link rel="stylesheet" href="../css/buttons.css">



</head>




<body>
    <?php include("navbar.php");?>



 
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
                <td>".$value[$COL_EXAM_STATUS]."</td>


                ";

                                     $sql= "SELECT * FROM " .$TABLE_EXAM_STUDENT_PARTICIPATION.
                       
                                " WHERE ".$COL_STUDENT_ID." = '".$_SESSION['sid']. 
                                "' AND ".$COL_EXAM_ID." = '".$value[$COL_EXAM_ID]."'";

                        //   echo  $sql; 


                            $res= mysqli_query($connection,$sql); 
                            $count = mysqli_num_rows($res);;



                            if (!$count==0) {


            echo "<td>
                       


                        <form action='show_result.php' method='POST' style='display:inline'>

                            <input type= 'hidden' name='exid' value='".$value[$COL_EXAM_ID]."' readonly='true'/>
                            <input type= 'hidden' name='cid' value='".$value[$COL_COURSE_ID]."' readonly='true'/>
                            <input type= 'hidden' name='sid' value='".$_SESSION['sid']."' readonly='true'/>


                            <input type= 'submit' class='button-error' id='' value='PARTICIPATED EXAM' class='btn btn-success'/>

                        </form>

                       

                </td>
                </tr>";
                }


               else if ($value[$COL_EXAM_STATUS]==2) {

                   echo "<td>
                       


                        <form action='give_exam.php' method='POST' style='display:inline'>

                            <input type= 'hidden' name='exid' value='".$value[$COL_EXAM_ID]."' readonly='true'/>
                            <input type= 'hidden' name='cid' value='".$value[$COL_COURSE_ID]."' readonly='true'/>
                           <input type= 'hidden' name='sid' value='".$_SESSION['sid']."' readonly='true'/>


                            <input type= 'submit' class='button-success' id='' value='GIVE EXAM' class='btn btn-success'/>

                        </form>

                       

                </td>
                </tr>";
                }


                else if ($value[$COL_EXAM_STATUS]==3) {

                   echo "<td>
                       


                        <form action='#' method='POST' style='display:inline'>

       

                            <input type= 'button' class='button-error' id='' value='EXAM TIME OVER' />

                        </form>

                       

                </td>
                </tr>";
                }

                else if ($value[$COL_EXAM_STATUS]==1) {

                      echo "<td>
                       


                        <form action='#' method='POST' style='display:inline'>

                            <input type= 'button' class='button-secondary' id='' value='EXAM UNAVAILABLE'/>

                        </form>

                       

                </td>
                </tr>";
                  }


               
                  
                
            }
            ?>
        </tbody>



</table>



<div>

                 


  

</div>

       
</body>









   