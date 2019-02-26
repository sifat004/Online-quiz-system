

<?php

 ini_set('session.cache_limiter','public');
 session_cache_limiter(false);

 session_start();
  
 
  if(isset($_POST['exid']) ){
  
    $_SESSION['exid'] = $_POST['exid'];

    

  }

  $exid=$_SESSION['exid'];


  require_once ('../db/database_connection.php');
  
  // $sql= "SELECT * FROM ". $TABLE_COURSE_INFO." WHERE ".$COL_COURSE_ID." = '$cid'";
  // $course= mysqli_query($connection,$sql);
  
  $sql= " SELECT * FROM ".$TABLE_EXAM_STUDENT_RESULT." WHERE ".$COL_EXAM_ID." = '$exid'";
  $results=mysqli_query($connection,$sql);







?>

<head>
    <title> Show Results</title>

      <link rel="stylesheet" href="../css/pure/pure-min.css">
      <link rel="stylesheet" href="../css/table.css">
                  <link rel="stylesheet" href="../css/buttons.css">



</head>




<body>



 
<table class="container">

        <thead>
       
         <th>SID </th>

         <th>Marks </th>

        <th>Action </th>

        
     
        </thead>
        
  <?php
        foreach ($results as $key=>$value){


                echo "<tr>
                <td>".$value[$COL_STUDENT_ID]."</td>
                <td>".$value[$COL_MARKS]."</td>
              ";

                echo "<td>
                       
                        
                        <form action='../student_side/show_answers_of_exam.php' method='POST' style='display:inline'>

                            <input type= 'hidden' name='exid' value='".$value[$COL_EXAM_ID]."' readonly='true'/>
                            <input type= 'hidden' name='sid' value='".$value[$COL_STUDENT_ID]."' readonly='true'/>
                            <input type= 'submit' class='button-primary' id='' value='SHOW ANS' />

                        </form>

                </td>";



                echo "</tr>";
                  
                
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









   