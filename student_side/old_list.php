

<?php

        include("start_session.php");




  require_once ('../db/database_connection.php');
  $sql=  $sql= "SELECT * FROM ". $TABLE_COURSE_INFO.
        " JOIN ".$TABLE_COURSE_REG_STUDENT.
        " ON ".$TABLE_COURSE_INFO.".".$COL_COURSE_ID.
        " = ".$TABLE_COURSE_REG_STUDENT.".".$COL_COURSE_ID.
        " WHERE ".$TABLE_COURSE_REG_STUDENT.".".$COL_STUDENT_ID." = '".$_SESSION['sid']. 
        "' ORDER BY ".$TABLE_COURSE_INFO.".".$COL_COURSE_ID;

// $sql= "SELECT * FROM ". $TABLE_COURSE_INFO.
//         " JOIN ".$TABLE_COURSE_REG_STUDENT.
//         " ON ".$TABLE_COURSE_INFO.".".$COL_COURSE_ID.
//         " = ".$TABLE_COURSE_REG_STUDENT.".".$COL_COURSE_ID.
//         " WHERE ".$TABLE_COURSE_REG_STUDENT.".".$COL_COURSE_ID." = CSE-0101";

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
                       
                        
     

                        <form action='show_exams_of_course.php' method='POST' style='display:inline'>

                            <input type= 'hidden' name='cid' value='".$value[$COL_COURSE_ID]."' readonly='true'/>

                            <input type= 'submit' class='pure-button success' id='' value='SHOW EXAMS' class='btn btn-success'/>

                        </form>

                   


                </td>
                </tr>";
                  
                
            }
            ?>
        </tbody>



</table>



<div>

                 

     <form   method="post" style="text-align: center;margin-top: 60px;color: #000">


          <button name="home" type="submit" class="pure-button warning" id=""  formaction="student_home.php" > 
              Go home
          </button>
             
      </form>
  

</div>

       
</body>









   