



<?php 

  require_once ('../db/database_connection.php');
   require_once('../libraries/spreadsheet-reader-master/php-excel-reader/excel_reader2.php');
  require_once('../libraries/spreadsheet-reader-master/SpreadsheetReader.php');


ini_set('session.cache_limiter','public');
    session_cache_limiter(false);
   session_start();




    

if (isset($_FILES["file"])) {

 $allowedFileType =    ['application/vnd.ms-excel','text/xls','text/xlsx','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];

  
  if(in_array($_FILES["file"]["type"],$allowedFileType)){

        $targetPath = 'uploads/'.$_FILES['file']['name'];

     //   echo  $targetPath;
        move_uploaded_file($_FILES['file']['tmp_name'], $targetPath);
        
        $Reader = new SpreadsheetReader($targetPath);


        
        $sheetCount = count($Reader->sheets());
        



          
        for($i=0;$i<$sheetCount;$i++)
        {
            $Reader->ChangeSheet($i);
            
            foreach ($Reader as $Row)
            {
          
                              $sid="";
                               $cid= "";
                               $year= "";
                               $semester= "";


 
 
                if(isset($Row[0])) {
                   $sid = mysqli_real_escape_string($conn,$Row[0]);
                }
            
                
                if(isset($Row[1])) {
                  $year= mysqli_real_escape_string($conn,$Row[1]);
                }
                
                if(isset($Row[2])) {
                       $semester= mysqli_real_escape_string($conn,$Row[2]);
                }

                $cid= $_SESSION['cid'];


                 
                if (!empty($cid) || !empty($sid)) {
                    
                        $sql= "SELECT * FROM " .$TABLE_COURSE_REG_STUDENT.
                       
                                " WHERE ".$COL_STUDENT_ID." = '".$sid. 
                                "' AND ".$COL_COURSE_ID." = '".$cid."'";

                            $res= mysqli_query($connection,$sql); 
                            $count = mysqli_num_rows($res);;


                            if ($count==0) {
                            $sql="INSERT INTO " .$TABLE_COURSE_REG_STUDENT." ( "
                           .$COL_CS_ID." , " 
                           .$COL_STUDENT_ID." , " 
                           .$COL_COURSE_ID." , " 
                           .$COL_YEAR." , " 
                           .$COL_SEMESTER." )
                          
                           VALUES ('','$sid','$cid','$year','$semester');";
 

                         //  echo  $sql; 
                           mysqli_query($connection,$sql);   
                       
                                       }


                               else{

                           echo "<script>
                                  alert('Same student id already exists in database. Please change the id and retry');
                                  window.location.href='course_reg_student.php';
                                  </script>";
                                }

  

 


                }
             }
        
        }
  


}
}

 else
  { 
        $type = "error";
        $message = "Invalid File Type. Upload Excel File.";
  }
 
  if(isset($_POST['cid']) ){
  
    $_SESSION['cid'] = $_POST['cid'];

  }
  
  if(isset($_POST['sid'])  )

   
  {
     if ($_POST['sid']!="") {
    

  $sid= $_POST['sid'];
  $cid= $_SESSION['cid'];

 
	$year= $_POST['year'];
	$semester= $_POST['semester'];

  $sql= "SELECT * FROM " .$TABLE_COURSE_REG_STUDENT.
                       
                     " WHERE ".$COL_STUDENT_ID." = '".$sid. 
                     "' AND ".$COL_COURSE_ID." = '".$cid."'";

                        //   echo  $sql; 


                            $res= mysqli_query($connection,$sql); 
                            $count = mysqli_num_rows($res);;



                            if ($count==0) {
                            $sql="INSERT INTO " .$TABLE_COURSE_REG_STUDENT." ( "
                           .$COL_CS_ID." , " 
                           .$COL_STUDENT_ID." , " 
                           .$COL_COURSE_ID." , " 
                           .$COL_YEAR." , " 
                           .$COL_SEMESTER." )
                          
                           VALUES ('','$sid','$cid','$year','$semester');";

                   
                           

                         //  echo  $sql; 
                           mysqli_query($connection,$sql);

	
                       }

                          else{

                           echo "<script>
                                  alert('Same student id already exists in database. Please change the id and retry');
                                  window.location.href='course_reg_student.php';
                                  </script>";
                                }

      





	
}
}
           //header('Location: course_reg_student.php');

?>





<head>

  <title> REGISTER STUDENT</title>

  <link rel="stylesheet" href="../css/form.css">


</head>

<body>




<div class="container">  
  <form id="form" action="course_reg_student.php" method="post" enctype="multipart/form-data">
    <h3>Register Student</h3>




    <fieldset>
<!--       <input placeholder="Course ID" type="text"  id="cid" name="cid" maxlength="15" required autofocus >
 -->      
        Course Code <?php echo $_SESSION['cid'];?> <br>

      <input placeholder="Student ID" type="text" id="small_input" id="sid" name="sid" maxlength="15" required  > <br>
      <input placeholder="Year" type="number" id="small_input" id="year" name="year" maxlength="4" required><br>
      <input placeholder="Semester" type="number" id="small_input" id="semester" name="semester" maxlength="2" required ><br>
      <button name="save" type="submit" id="small_button" >Save</button>


    </fieldset>
 

   
   
    
  </form>


  <form id="form" action="course_reg_student.php" method="post" enctype="multipart/form-data">
    <h4>Import Excel Sheet</h4>




    <fieldset>
      
          <input type="file" name="file" id="file" accept=".xls,.xlsx" >
      <button name="save" type="submit" id="small_button" >Save</button>


    </fieldset>
 

  
    
  </form>



</div>

    <form  action="admin_home.php" method="post" style="text-align: center;margin-top: 60px;color: #000">

       
             
      <button name="home" class="pure-button" type="submit" id="" style="background: #8DC26F;padding: 10px;margin: 10px;color: #fff"> Go home
      </button>
             
      </form>

</body>
