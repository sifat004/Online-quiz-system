

<?php

  require_once ('../db/database_connection.php');
  $sql= "SELECT * FROM ". $TABLE_COURSE_INFO." ORDER BY ". $COL_COURSE_ID;
  
  $result= mysqli_query($connection,$sql);

?>

<head>
    <title> Show Course</title>



 

      <link rel="stylesheet" href="../css/pure/pure-min.css">
      <link rel="stylesheet" href="../css/table.css">


</head>




<body>



 
<table class="container">

        <thead>
       
        <th>Course Code </th>
        <th>Course Title </th>
        <th>Course Credit </th>
        <th>Department </th>
        <th>Action </th>
     
        </thead>
        
  <?php
        foreach ($result as $key=>$value){

                echo "<tr>
                <td>".$value[$COL_COURSE_ID]."</td>
                <td>".$value[$COL_COURSE_TITLE]."</td>
                <td>".$value[$COL_COURSE_CREDIT]."</td>
                <td>".$value[$COL_DEPT_CODE]."</td>";



                echo "<td>
                       
                        
                        <form action='course_reg_student.php' method='POST' style='display:inline'>

                            <input type= 'hidden' name='cid' value='".$value[$COL_COURSE_ID]."' readonly='true'/>
                            <input type= 'submit' class='pure-button success' id='' value='REG STUDENT' class='btn btn-success'/>

                        </form>

                        <form action='course_reg_teacher.php' method='POST' style='display:inline'>

                            <input type= 'hidden' name='cid' value='".$value[$COL_COURSE_ID]."' readonly='true'/>
                            <input type= 'submit' class='pure-button success' id='' value='REG TEACHER' class='btn btn-success'/>

                        </form>

                         <form action='add_exam.php' method='POST' style='display:inline'>

                            <input type= 'hidden' name='cid' value='".$value[$COL_COURSE_ID]."' readonly='true'/>
                            <input type= 'submit' class='pure-button success' id='' value='ADD EXAM' class='btn btn-success'/>

                        </form>

                        <form action='show_exams_of_course.php' method='POST' style='display:inline'>

                            <input type= 'hidden' name='cid' value='".$value[$COL_COURSE_ID]."' readonly='true'/>
                            <input type= 'submit' class='pure-button success' id='' value='SHOW EXAMS' class='btn btn-success'/>

                        </form>

                        <form action='delete_course.php' method='POST' style='display:inline'>

                            <input type= 'hidden' name='cid' value='".$value[$COL_COURSE_ID]."' readonly='true'/>
                            <input type= 'submit' class='pure-button error' id='' value='Delete' class='btn btn-warning'/>

                        </form>


                </td>
                </tr>";
                  
                
            }
            ?>
        </tbody>



</table>



<div>

                 

     <form   method="post" style="text-align: center;margin-top: 60px;color: #000">

         <button name="home" type="submit" class="btn-success pure-button" id="" formaction="add_course.php" >
             Add Course
          </button>
                 
          <button name="home" type="submit" class="pure-button warning" id=""  formaction="admin_home.php" > 
              Go home
          </button>
             
      </form>
  

</div>

       
</body>









   