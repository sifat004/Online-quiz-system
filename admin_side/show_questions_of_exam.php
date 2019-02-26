

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
  
  $sql= " SELECT * FROM ".$TABLE_EXAM_QUESTION_INFO." WHERE ".$COL_EXAM_ID." = '$exid'";
  $questions=mysqli_query($connection,$sql);



   // $image = $questions->fetch_assoc();
        
   //      //Render image
   // header("Content-type: image/jpg"); 
   //      echo $image[$COL_QUESTION_IMAGE];
    




?>

<head>
    <title> Show Questions</title>

      <link rel="stylesheet" href="../css/pure/pure-min.css">
      <link rel="stylesheet" href="../css/table.css">


</head>




<body>



 
<table class="container">

        <thead>

          <th>SL</th>
       
<!--          <th>QID </th>
 --><!--     <th>Course Title </th>
         <th>Department </th> -->
         <th>Description </th>
         <th>Image </th>
         <th>Option 1 </th>
         <th>Option 2 </th>
         <th>Option 3 </th>
         <th>Option 4 </th>
         <th>Correct ans </th>
         <th>Action </th>
     
        </thead>
        
  <?php
        
$sl=0;
        foreach ($questions as $key=>$value){
            $sl++;




                echo "<tr>

                <td>".$sl."</td>

                <td>".$value[$COL_QUESTION_DESC]."</td>";

                if ($value[$COL_QUESTION_IMAGE]!=null) {
                         echo  "<td>".   

                          "<img src='".$value[$COL_QUESTION_IMAGE]."'  border=3 height=100 width=100></img>".
                          "</td> ";

                  }

                  else echo " <td></td>";
                
                echo "
                <td>".$value[$COL_QOP_1]."</td>
                <td>".$value[$COL_QOP_2]."</td>
                <td>".$value[$COL_QOP_3]."</td>
                <td>".$value[$COL_QOP_4]."</td>
                <td>".$value[$COL_ANS]."</td>


                ";





                echo "<td>
                       
                        



                        <form action='delete_from_course.php' method='POST' style='display:inline'>

                            <input type= 'hidden' name='exid' value='".$value[$COL_EXAM_ID]."' readonly='true'/>
                            <input type= 'hidden' name='qid' value='".$value[$COL_QUESTION_ID]."' readonly='true'/>


                            <input type= 'submit' class='pure-button success' id='' value='REMOVE' class='btn btn-success'/>

                        </form>

                       

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









   