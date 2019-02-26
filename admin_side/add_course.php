



<?php 

 
  require_once ('../db/database_connection.php');
  require_once('../libraries/spreadsheet-reader-master/php-excel-reader/excel_reader2.php');
  require_once('../libraries/spreadsheet-reader-master/SpreadsheetReader.php');



     


if (isset($_FILES["file"])) {

  $allowedFileType =    ['application/vnd.ms-excel','text/xls','text/xlsx','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];

  
  if(in_array($_FILES["file"]["type"],$allowedFileType)){

        $targetPath = 'uploads/'.$_FILES['file']['name'];

        //echo  $targetPath;
        move_uploaded_file($_FILES['file']['tmp_name'], $targetPath);
        
        $Reader = new SpreadsheetReader($targetPath);


        
        $sheetCount = count($Reader->sheets());
        
              //  echo  $sheetCount;

        

                 
        for($i=0;$i<$sheetCount;$i++)
        {
            $Reader->ChangeSheet($i);
            
            foreach ($Reader as $Row)
            {
          
                          $code= "";
                          $title= "";
                          $credit= "";
                          $dept_code= "";
                
 
 
                if(isset($Row[0])) {
                   $code = mysqli_real_escape_string($conn,$Row[0]);
                }
                
                if(isset($Row[1])) {
                     $title = mysqli_real_escape_string($conn,$Row[1]);
                }
                
                if(isset($Row[2])) {
                   $credit = mysqli_real_escape_string($conn,$Row[2]);
                }
                
                if(isset($Row[3])) {
                     $dept_code = mysqli_real_escape_string($conn,$Row[3]);
                }

                 
                if (!empty($code) || !empty($title)) {
                                 


                           $sql= "SELECT * FROM " .$TABLE_COURSE_INFO.
                       
                                " WHERE ".$COL_COURSE_ID." = '".$code. 
                                "' AND ".$COL_DEPT_CODE." = '".$dept_code."'";

                        //   echo  $sql; 


                            $res= mysqli_query($connection,$sql); 
                            $count = mysqli_num_rows($res);;



                            if ($count==0) {
                          

                                   $sql="INSERT INTO " .$TABLE_COURSE_INFO." ( "
                                   .$COL_COURSE_ID." , " 
                                   .$COL_COURSE_TITLE." , " 
                                   .$COL_COURSE_CREDIT." , " 
                                   .$COL_DEPT_CODE." )
                                  
                                   VALUES ('$code','$title','$credit','$dept_code');";


                                   //echo  $sql; 
                                   mysqli_query($connection,$sql);  

                                }

                                  else{

                                  echo "<script>
                                  alert('Same course already exists in database. Please change the id and retry');
                                  window.location.href='add_course.php';
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



  if(isset($_POST['c_code']) & !empty($_POST['c_code'])){
	$code= $_POST['c_code'];
	$title= $_POST['c_title'];
	$credit= $_POST['c_credit'];
	$dept_code= $_POST['c_dept'];


 $sql= "SELECT * FROM " .$TABLE_COURSE_INFO.
 " WHERE ".$COL_COURSE_ID." = '".$code. 
  "' AND ".$COL_DEPT_CODE." = '".$dept_code."'";



 $res= mysqli_query($connection,$sql); 
 $count = mysqli_num_rows($res);;


 if ($count==0) {

           $sql="INSERT INTO " .$TABLE_COURSE_INFO." ( "
           .$COL_COURSE_ID." , " 
           .$COL_COURSE_TITLE." , " 
           .$COL_COURSE_CREDIT." , " 
           .$COL_DEPT_CODE." )
          
           VALUES ('$code','$title','$credit','$dept_code');";


          // echo  $sql; 
           mysqli_query($connection,$sql);	


}

else{

        echo "<script>
          alert('Same course already exists in database. Please change the id and retry');
           window.location.href='add_course.php';
            </script>";
                                    
                                     }


}
        // header('Location: add_course.php');

?>


<head>

  <title> ADD COURSE</title>
  <link rel="stylesheet" href="../css/form.css">
        <link rel="stylesheet" href="../css/pure/pure-min.css">



</head>

<body>







<div class="container">  
  <form id="form" action="add_course.php" method="post">
    <h3>Add a course</h3>
    
    <fieldset>
      <input placeholder="Course Code" type="text" id="c_code" name="c_code" tabindex="1" maxlength="15" required autofocus>
    </fieldset>
    
    <fieldset>
      <input placeholder="Course Title" type="text" id="c_title" name="c_title" tabindex="2" required>
    </fieldset>

     <fieldset>
      <input placeholder="Credit" type="number"  id="c_credit" name="c_credit" tabindex="2" required>
    </fieldset>  

    <fieldset>
      <input placeholder="Department Code" type="text" id="c_dept" name="c_dept" tabindex="2" maxlength="10" required>
    </fieldset>

      <button name="submit" class="pure-button" type="submit" id="" data-submit="...Sending">Submit</button>
    </fieldset>
  </form>


  <form id="form" action="add_course.php" method="post" enctype="multipart/form-data">
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





