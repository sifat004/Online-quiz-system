
<?php 

  require_once ('../db/database_connection.php');
  require_once('../libraries/spreadsheet-reader-master/php-excel-reader/excel_reader2.php');
  require_once('../libraries/spreadsheet-reader-master/SpreadsheetReader.php');

if (isset($_FILES["file"])) {

  $allowedFileType =    ['application/vnd.ms-excel','text/xls','text/xlsx','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];

  
  if(in_array($_FILES["file"]["type"],$allowedFileType)){

        $targetPath = 'uploads/'.$_FILES['file']['name'];

       // echo  $targetPath;
        move_uploaded_file($_FILES['file']['tmp_name'], $targetPath);
        
        $Reader = new SpreadsheetReader($targetPath);
        $sheetCount = count($Reader->sheets());
      
                 
        for($i=0;$i<$sheetCount;$i++)
        {
            $Reader->ChangeSheet($i);
            
            foreach ($Reader as $Row)
            {
          
                        $sid= "";
                     $sname = "";
                     $spw= "";
                     $sstatus= "";
                     $dept_code="";
                
 
 
          if(isset($Row[0])) {
                   $sid = mysqli_real_escape_string($conn,$Row[0]);
                }
                
                if(isset($Row[1])) {
                     $sname = mysqli_real_escape_string($conn,$Row[1]);
                }
                
                if(isset($Row[2])) {
                   $spw = mysqli_real_escape_string($conn,$Row[2]);
                }
                
                if(isset($Row[3])) {
                     $sstatus = mysqli_real_escape_string($conn,$Row[3]);
                }

                 if(isset($Row[4])) {
                     $dept_code = mysqli_real_escape_string($conn,$Row[4]);
                }
                if (!empty($sname) || !empty($sid)) {
                    
                      $sql="INSERT INTO " .$TABLE_STUDENT_INFO." ( "
                           .$COL_STUDENT_ID." , " 
                           .$COL_STUDENT_NAME." , " 
                           .$COL_STUDENT_PASSWORD." , " 
                           .$COL_STUDENT_STATUS." , " 
                           .$COL_DEPT_CODE." )
          
                  VALUES ('$sid','$sname','$spw','$sstatus','$dept_code');";

           

                          //   echo  $sql; 
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



  if(isset($_POST['sid']) & isset($_POST['sname'])&isset($_POST['dept_code']) & !empty($_POST['sid']) ){


 $sid= $_POST['sid'];
 $sname= $_POST['sname'];
 $spw= $_POST['spw'];
  $sstatus= $_POST['sstatus'];
 $dept_code= $_POST['dept_code'];


  


           $sql="INSERT INTO " .$TABLE_STUDENT_INFO." ( "
           .$COL_STUDENT_ID." , " 
           .$COL_STUDENT_NAME." , " 
           .$COL_STUDENT_PASSWORD." , " 
           .$COL_STUDENT_STATUS." , " 
           .$COL_DEPT_CODE." )
          
           VALUES ('$sid','$sname','$spw','$sstatus','$dept_code');";

           

         //  echo  $sql; 
           mysqli_query($connection,$sql); 





  
}
 
  else{
            //   echo  "Give sid"; 

  }      

?>


<head>
   <title> Add Student</title>

  <link rel="stylesheet" href="../css/form.css">
        <link rel="stylesheet" href="../css/pure/pure-min.css">



<head>

  <title> ADD STUDENT</title>

  <link rel="stylesheet" href="../css/form.css">


</head>

<body>




<div class="container">  
   <form id="form" action="add_student.php" method="post" enctype="multipart/form-data">
    <h3>Add a Student</h3>






    <fieldset>
      <input placeholder="Student ID" type="text" id="sid" name="sid" maxlength="15"  required>
      <input placeholder="Student Name" type="text" id="sname" name="sname" required>
      <input placeholder="Student Password" type="text" id="spw" name="spw" maxlength="10">
      <input placeholder="Student Status" type="number" id="sstatus" name="sstatus" maxlength="1">
      <input placeholder="Department" type="text" id="dept_code" name="dept_code" maxlength="10">
      <button name="save" type="submit" id="small_button" >Save</button>



    </fieldset>

   

     
   
    

     
  </form>



  <form id="form" action="add_student.php" method="post" enctype="multipart/form-data">
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



