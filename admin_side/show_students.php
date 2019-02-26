

<?php

  require_once ('../db/database_connection.php');
  $sql= "SELECT * FROM ". $TABLE_STUDENT_INFO." ORDER BY ". $COL_STUDENT_ID;
  
  $result= mysqli_query($connection,$sql);

?>

<head>
    <title> Show Students</title>



 

      <link rel="stylesheet" href="../css/pure/pure-min.css">
      <link rel="stylesheet" href="../css/table.css">


</head>




<body>



 
<table class="container">

        <thead>
       
        <th>Student ID </th>
        <th>Student Name </th>
        <th>Courses </th>

        <th>Department </th>
     
        </thead>
        
  <?php
        foreach ($result as $key=>$value){



        $sql=  $sql= "SELECT * FROM ". $TABLE_COURSE_INFO.
        " JOIN ".$TABLE_COURSE_REG_STUDENT.
        " ON ".$TABLE_COURSE_INFO.".".$COL_COURSE_ID.
        " = ".$TABLE_COURSE_REG_STUDENT.".".$COL_COURSE_ID.
        " WHERE ".$TABLE_COURSE_REG_STUDENT.".".$COL_STUDENT_ID." = '".$value[$COL_STUDENT_ID]. 
        "' ORDER BY ".$TABLE_COURSE_INFO.".".$COL_COURSE_ID; 
        // echo $sql;

        $resultcourse= mysqli_query($connection,$sql);

         $courses=" ";
         foreach ($resultcourse as $key=>$value2){

              $courses=$courses.$value2[$COL_COURSE_ID]." ";
         }

                
                echo "<tr>
                <td>".$value[$COL_STUDENT_ID]."</td>
                <td>".$value[$COL_STUDENT_NAME]."</td>


                <td>".$courses."</td>
                <td>".$value[$COL_DEPT_CODE]."</td>";



                echo "<td>


                </td>
                </tr>";
                  
                
            }
            ?>
        </tbody>



</table>



<div>

                 

     <form   method="post" style="text-align: center;margin-top: 60px;color: #000">

     
                 
          <button name="home" type="submit" class="pure-button warning" id=""  formaction="admin_home.php" > 
              Go home
          </button>
             
      </form>
  

</div>

       
</body>









   