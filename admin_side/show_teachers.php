

<?php

  require_once ('../db/database_connection.php');
  $sql= "SELECT * FROM ". $TABLE_TEACHER_INFO." ORDER BY ". $COL_TEACHER_ID;
  
  $result= mysqli_query($connection,$sql);

?>

<head>
    <title> Show Teachers</title>



 

      <link rel="stylesheet" href="../css/pure/pure-min.css">
      <link rel="stylesheet" href="../css/table.css">


</head>




<body>



 
<table class="container">

        <thead>
       
        <th>Teacher ID </th>
        <th>Teacher Name </th>
        <th>Courses </th>

        <th>Department </th>
     
        </thead>
        
  <?php
        foreach ($result as $key=>$value){



        $sql=  $sql= "SELECT * FROM ". $TABLE_COURSE_INFO.
        " JOIN ".$TABLE_COURSE_REG_TEACHER.
        " ON ".$TABLE_COURSE_INFO.".".$COL_COURSE_ID.
        " = ".$TABLE_COURSE_REG_TEACHER.".".$COL_COURSE_ID.
        " WHERE ".$TABLE_COURSE_REG_TEACHER.".".$COL_TEACHER_ID." = '".$value[$COL_TEACHER_ID]. 
        "' ORDER BY ".$TABLE_COURSE_INFO.".".$COL_COURSE_ID; 
        // echo $sql;

      
        $resultcourse= mysqli_query($connection,$sql);

         $courses=" ";
         foreach ($resultcourse as $key=>$value2){

              $courses=$courses.$value2[$COL_COURSE_ID]." ";
         }

                
                echo "<tr>
                <td>".$value[$COL_TEACHER_ID]."</td>
                <td>".$value[$COL_TEACHER_NAME]."</td>


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









   