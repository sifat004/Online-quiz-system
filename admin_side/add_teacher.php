



<?php 

  
  require_once ('../db/database_connection.php');
  require_once('../libraries/spreadsheet-reader-master/php-excel-reader/excel_reader2.php');
  require_once('../libraries/spreadsheet-reader-master/SpreadsheetReader.php');




 // if(isset($_POST['file'])) {


if (isset($_FILES["file"])) {

     $allowedFileType =    ['application/vnd.ms-excel','text/xls','text/xlsx','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];


  
  if(in_array($_FILES["file"]["type"],$allowedFileType)){

        $targetPath = 'uploads/'.$_FILES['file']['name'];

      //  echo  $targetPath;
        move_uploaded_file($_FILES['file']['tmp_name'], $targetPath);
        
        $Reader = new SpreadsheetReader($targetPath);


        
        $sheetCount = count($Reader->sheets());
        
             //   echo  $sheetCount;


        for($i=0;$i<$sheetCount;$i++)
        {
            $Reader->ChangeSheet($i);
            
            foreach ($Reader as $Row)
            {
                
                
 
                  $tid= "";
                  $tname= "";
                  $tpw= "";
                  $dept_code="";
 
                if(isset($Row[0])) {
                   $tid = mysqli_real_escape_string($conn,$Row[0]);
                }
                
                if(isset($Row[1])) {
                     $tname = mysqli_real_escape_string($conn,$Row[1]);
                }
                
                if(isset($Row[2])) {
                   $tpw= mysqli_real_escape_string($conn,$Row[2]);
                }
                
                if(isset($Row[3])) {
                    $dept_code = mysqli_real_escape_string($conn,$Row[3]);
                }

               
                if (!empty($tname) || !empty($tid)) {
                    
                          $sql="INSERT INTO " .$TABLE_TEACHER_INFO." ( "
                           .$COL_TEACHER_ID." , " 
                           .$COL_TEACHER_NAME." , " 
                           .$COL_TEACHER_PASSWORD." , " 
                           .$COL_DEPT_CODE." )
                          
                           VALUES ('$tid','$tname','$tpw','$dept_code');";
           

                            // echo  $sql; 
                             mysqli_query($connection,$sql);  


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



  if(isset($_POST['tid']) & !empty($_POST['tid'])){
	$tid= $_POST['tid'];
	$tname= $_POST['tname'];
	$tpw= $_POST['tpw'];
	$dept_code= $_POST['dept_code'];



	

  


           $sql="INSERT INTO " .$TABLE_TEACHER_INFO." ( "
           .$COL_TEACHER_ID." , " 
           .$COL_TEACHER_NAME." , " 
           .$COL_TEACHER_PASSWORD." , " 
           .$COL_DEPT_CODE." )
          
           VALUES ('$tid','$tname','$tpw','$dept_code');";

           

       //    echo  $sql; 
           mysqli_query($connection,$sql);	





	
}

?>





<head>

  <title> ADD TEACHER</title>

  <link rel="stylesheet" href="../css/form.css">
        <link rel="stylesheet" href="../css/pure/pure-min.css">



</head>

<body>




<div class="container">  
  <form id="form" action="add_teacher.php" method="post" enctype="multipart/form-data">
    <h3>Add Teacher</h3>






    <fieldset>
      <input placeholder="Teacher ID" type="text" id="tid" name="tid" maxlength="15" required >
      <input placeholder="Teacher Name" type="text" id="tname" name="tname" required>
      <input placeholder="Teacher Password" type="text" id="tpw" name="tpw" maxlength="10">
      <input placeholder="Department" type="text" id="dept_code" name="dept_code" maxlength="10">

      <button name="save" type="submit" id="small_button" >Save</button>



    </fieldset>

   

     
     </form>
    


  <form id="form" action="add_teacher.php" method="post" enctype="multipart/form-data">
    <h4>Import Excel Sheet</h4>




    <fieldset>
      
          <input type="file" name="file" id="file" accept=".xls,.xlsx" >
      <button name="save" type="submit" id="small_button" >Save</button>


    </fieldset>
 

  
    
  </form>

</div>

     <form  action="admin_home.php" method="post" style="text-align: center;margin-top: 60px;color: #000">

       
             
      <button name="home" class="pure-button" type="submit" id="" style="padding: 10px;margin: 10px;color: #000"> Go home
      </button>
             
      </form>


</body>