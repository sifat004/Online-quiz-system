



<?php 

  require_once ('../db/database_connection.php');

ini_set('session.cache_limiter','public');
    session_cache_limiter(false);
   session_start();


if(isset($_POST['cid']) ){
  
    $_SESSION['cid'] = $_POST['cid'];

  }
  


  if(isset($_POST['exname'])){
	$exname= $_POST['exname'];
	$year= $_POST['year'];
	$semester= $_POST['semester'];
  $exfullmarks= $_POST['exfullmarks'];
  $exduration= $_POST['exduration'];
  $exdate= $_POST['exdate'];

  $exstatus= $_POST['exstatus'];
  $mpq=$_POST['mpq'];
  $nmpq=$_POST['nmpq'];


  $cid= $_SESSION['cid'];


	$date = date('m/d/Y h:i:s', time());
	


           $sql="INSERT INTO " .$TABLE_EXAM_INFO." ( "
           .$COL_EXAM_ID." , " 
           .$COL_COURSE_ID." , " 
           .$COL_YEAR." , " 
           .$COL_SEMESTER." , " 
           .$COL_EXAM_NAME." , " 
           .$COL_EXAM_FULL_MARKS." , " 
           .$COL_EXAM_DATE." , " 
           .$COL_EXAM_DURATION." , " 
            .$COL_EXAM_STATUS." , " 
           . $COL_MARKS_PER_Q." , " 

           .$COL_NEGATIVE_MARKS_PER_Q." )
          
           VALUES ('','$cid','$year','$semester','$exname','$exfullmarks','$exdate','$exduration','$exstatus','$mpq','$nmpq');";


           //echo  $sql; 
           mysqli_query($connection,$sql);	



                  header('Location: show_course_list.php');



	
}

?>





<head>
   <title> ADD EXAM</title>

  <link rel="stylesheet" href="../css/form.css">



</head>


<body>


<div class="container">  
  <form id="form" action="add_exam.php" method="post">
    <h3>Add Exam</h3>



    <fieldset>

       Course Code <?php echo $_SESSION['cid'];?> <br>

      <input placeholder="Exam Name" type="text" id="exname" name="exname" maxlength="10" required>

      <input placeholder="Year" type="number" id="small_input" id="year" name="year" maxlength="4" required>
      <input placeholder="Semester" type="number" id="small_input" id="semester" name="semester" maxlength="2" required >

      <input placeholder="Full Marks" type="number" id="exfullmarks" name="exfullmarks" required >
      <input placeholder="Marks per question" type="number" id="mpq" name="mpq"  >
      <input placeholder="Negative marks per wrong answer" type="float" id="nmpq" name="nmpq" >

      <input placeholder="Duration (Minutes)" type="number" id="exduration" name="exduration" required>

      <input placeholder="Date" type="date" id="exdate" name="exdate" required >

      <input placeholder="Status" type="number" id="exstatus" name="exstatus" required>

      <button name="save" type="submit" id="small_button" >Save</button>



    </fieldset>

   
  
  </form>



   
</body>