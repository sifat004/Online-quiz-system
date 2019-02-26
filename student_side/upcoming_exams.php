

<?php

     include("start_session.php");
  
 
    require_once ('../db/database_connection.php');


 $sid=$_SESSION['sid'];

$sql= "SELECT * FROM ". $TABLE_COURSE_INFO.
        " JOIN ".$TABLE_COURSE_REG_STUDENT.
        " ON ".$TABLE_COURSE_INFO.".".$COL_COURSE_ID.
        " = ".$TABLE_COURSE_REG_STUDENT.".".$COL_COURSE_ID.
        " JOIN ".$TABLE_EXAM_INFO.
        " ON ".$TABLE_COURSE_INFO.".".$COL_COURSE_ID.
        " = ".$TABLE_EXAM_INFO.".".$COL_COURSE_ID.

        " WHERE ".$TABLE_COURSE_REG_STUDENT.".".$COL_STUDENT_ID." = '".$_SESSION['sid']. 
        "' AND ".$TABLE_EXAM_INFO.".".$COL_EXAM_STATUS." = 1". 


        " ORDER BY ".$TABLE_COURSE_INFO.".".$COL_COURSE_ID;

     //   echo $sql;

  
  $upcoming_exams=mysqli_query($connection,$sql);


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
        foreach ($upcoming_exams as $key=>$value){




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

              


                if ($value[$COL_EXAM_STATUS]==2) {

                   echo "<td>
                       


                        <form action='give_exam.php' method='POST' style='display:inline'>

                            <input type= 'hidden' name='exid' value='".$value[$COL_EXAM_ID]."' readonly='true'/>
                            <input type= 'hidden' name='cid' value='".$value[$COL_COURSE_ID]."' readonly='true'/>

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









   