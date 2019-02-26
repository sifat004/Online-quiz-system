

<?php

        include("start_session.php");

  
 
  if(isset($_POST['exid']) ){
  
    $_SESSION['exid'] = $_POST['exid'];

    

  }

    if(isset($_POST['sid']) ){
  
    $_SESSION['sid'] = $_POST['sid'];

    

  }

  $exid=$_SESSION['exid'];

  require_once ('../db/database_connection.php');
  
  // $sql= "SELECT * FROM ". $TABLE_COURSE_INFO." WHERE ".$COL_COURSE_ID." = '$cid'";
  // $course= mysqli_query($connection,$sql);
  
  $sql= " SELECT * FROM ".$TABLE_EXAM_QUESTION_INFO." WHERE ".$COL_EXAM_ID." = '$exid'";
  $questions=mysqli_query($connection,$sql);







?>

<head>
    <title> Show Questions</title>
            <link rel="stylesheet" href="../css/navbar.css">

      <link rel="stylesheet" href="../css/pure/pure-min.css">

      <link rel="stylesheet" href="../css/table.css">


</head>




<body>



    <?php 

   if(!isset($_POST['sid']) ){
  

        include("navbar.php");


  }


    ?>

 
<table class="container">

        <thead>
       
         <th>SL </th>
<!--     <th>Course Title </th>
         <th>Department </th> -->
         <th>Description </th>
         <th>Image </th>
         <th>Option 1 </th>
         <th>Option 2 </th>
         <th>Option 3 </th>
         <th>Option 4 </th>
         <th>Given ans </th>

         <th>Correct ans </th>


     
        </thead>
        
  <?php

  $sl=0;
        foreach ($questions as $key=>$value){

          $sid=$_SESSION['sid'];
            $sql= " SELECT ".$COL_STUDENT_ANS." FROM ".$TABLE_EXAM_STUDENT_ANS." WHERE ".
                    $COL_QUESTION_ID." = '$value[$COL_QUESTION_ID]' "." AND ".
                    $COL_STUDENT_ID." = '$sid'";



            $result=mysqli_query($connection,$sql);
            $row = $result->fetch_assoc();
            $ans=$row[$COL_STUDENT_ANS];





$sl++;


                echo "<tr>
                 
                <td>".$sl."</td>.

                 <td>".$value[$COL_QUESTION_DESC]."</td>";

                if ($value[$COL_QUESTION_IMAGE]!=null) {
                         echo  "<td>".   

                          "<img src='../admin_side/".$value[$COL_QUESTION_IMAGE]."'  border=3 height=100 width=100></img>".
                          "</td> ";

                  }

                  else echo " <td></td>";
                
                echo "
                <td>".$value[$COL_QOP_1]."</td>
                <td>".$value[$COL_QOP_2]."</td>
                <td>".$value[$COL_QOP_3]."</td>
                <td>".$value[$COL_QOP_4]."</td>
                <td>".$ans."</td>

                <td>".$value[$COL_ANS]."</td>


                ";



                echo "
                </tr>";
                  
                
            }
            ?>
        </tbody>



</table>



<div>

                 

   

</div>

       
</body>









   