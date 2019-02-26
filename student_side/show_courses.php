

<?php

        include("start_session.php");




  require_once ('../db/database_connection.php');
  $sql=  $sql= "SELECT * FROM ". $TABLE_COURSE_INFO.
        " JOIN ".$TABLE_COURSE_REG_STUDENT.
        " ON ".$TABLE_COURSE_INFO.".".$COL_COURSE_ID.
        " = ".$TABLE_COURSE_REG_STUDENT.".".$COL_COURSE_ID.
        " WHERE ".$TABLE_COURSE_REG_STUDENT.".".$COL_STUDENT_ID." = '".$_SESSION['sid']. 
        "' ORDER BY ".$TABLE_COURSE_INFO.".".$COL_COURSE_ID; 
  // echo $sql;

  $result= mysqli_query($connection,$sql);


?>

<head>
    <title> Show Course</title>



 
      <link rel="stylesheet" href="../css/navbar.css">

      <link rel="stylesheet" href="../css/card.css">




</head>




<body>

    <?php include("navbar.php");?>


 

  <div class="wrapper">
   
  <?php
        foreach ($result as $key=>$value){



                  echo "<div class='card'>
                      <h3 class='card-title'>".$value[$COL_COURSE_ID]."</h3>
                      
                      <p class='card-content'>Couse Title:".$value[$COL_COURSE_TITLE]."<br>
                      Credit:".$value[$COL_COURSE_CREDIT]."<br>
                      Department:".$value[$COL_DEPT_CODE]."</p>

                      <form action='show_exams_of_course.php' method='POST' style='display:inline'>

                            <input type= 'hidden' name='cid' value='".$value[$COL_COURSE_ID]."' readonly='true'/>
                             <input type= 'hidden' name='sid' value='".$_SESSION['sid']."' readonly='true'/>


                            <input type= 'submit' class='card-btn' id='' value='SHOW EXAMS' />

                        </form>
                    </div>";


}

                       ?>

                     </div>
                        
       
</body>









   