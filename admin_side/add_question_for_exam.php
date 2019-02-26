



<?php 

   require_once ('../db/database_connection.php');
  require_once('../libraries/spreadsheet-reader-master/php-excel-reader/excel_reader2.php');
  require_once('../libraries/spreadsheet-reader-master/SpreadsheetReader.php');


     $sql="SELECT COUNT(*) FROM ".$TABLE_EXAM_QUESTION_INFO;
     $count=mysqli_query($connection,$sql);

     $_SESSION["count"]=$count;

ini_set('session.cache_limiter','public');
    session_cache_limiter(false);
  session_start();

     


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
          
                                                        $qid="";

               
                            $qdesc= "";
                            $qimage= "";
                            $qop1="";
                            $qop2= "";
                            $qop3= "";
                            $qop4="";
                            $exid="";
                            $ans= "";
                


 
           if(isset($Row[0])) {
                    $qid = mysqli_real_escape_string($conn,$Row[0]);

                    // $qid= $_SESSION["count"]+1;
                    // $_SESSION["count"]=$qid;

                 


                }

                    $qid= $_SESSION["count"]+1;
                    $_SESSION["count"]=$qid;
             
                
                if(isset($Row[1])) {
                     $qdesc = mysqli_real_escape_string($conn,$Row[1]);
                }
                
                if(isset($Row[2])) {
                   $qimage = mysqli_real_escape_string($conn,$Row[2]);
                }
                
                if(isset($Row[3])) {
                     $qop1 = mysqli_real_escape_string($conn,$Row[3]);
                }

                if(isset($Row[4])) {
                     $qop2 = mysqli_real_escape_string($conn,$Row[4]);
                }
                if(isset($Row[5])) {
                     $qop3 = mysqli_real_escape_string($conn,$Row[5]);
                }
               if(isset($Row[6])) {
                     $qop4 = mysqli_real_escape_string($conn,$Row[6]);
                }

                   if(isset($Row[7])) {
                     $ans = mysqli_real_escape_string($conn,$Row[7]);
                }

                $exid=$_SESSION['exid'] ;
                // $ans-$_POST['ans'];


                 
                if (!empty($qid) || !empty($qdesc)) {
                          
               $sql= "SELECT * FROM " .$TABLE_EXAM_QUESTION_INFO.
                                     
                            " WHERE ".$COL_EXAM_ID." = '".$exid. 
                            "' AND ".$COL_QUESTION_DESC." = '".$qdesc."'";

                    //   echo  $sql; 

                         


                        $res= mysqli_query($connection,$sql); 
                        $count = mysqli_num_rows($res);;



                        if ($count==0) {

  


           $sql="INSERT INTO " .$TABLE_EXAM_QUESTION_INFO." ( "
           .$COL_QUESTION_ID." , " 
           .$COL_EXAM_ID." , " 
           .$COL_QUESTION_DESC." , " 
           .$COL_QUESTION_IMAGE." , " 
           .$COL_QOP_1." , " 
           .$COL_QOP_2." , " 
           .$COL_QOP_3." , " 
           .$COL_QOP_4." , " 
           .$COL_ANS." )
          
           VALUES ('$qid','$exid','$qdesc','$qimage','$qop1','$qop2','$qop3','$qop4','$ans');";


          // echo  $sql; 
           mysqli_query($connection,$sql);  


                 header('Location: show_exams_of_course.php');

                }


                else{

                     echo "<script>
                                  alert('Same quesion already exists in database. Please change the id and retry');
                                  window.location.href='add_question_for_exam.php';
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



  if(isset($_POST['exid']) ){

    $_SESSION['exid'] = $_POST['exid'];


  }

  if(isset($_FILES["qimage"])){


  $Randomimg = uniqid();
         $targetPath = 'uploads/'.$Randomimg;


        $qimage=$_FILES['qimage']['tmp_name'];
        move_uploaded_file($qimage, $targetPath);



    // $check = getimagesize($_FILES["qimage"]["tmp_name"]);
    // if($check !== false){

    //     $image = $_FILES['qimage']['tmp_name'];
    //     $qimage = addslashes(file_get_contents($image));

      //}

      // else {
      //           $qimage=null;

      // }
}

    
     else $qimage=null;



  if(isset($_POST['qdesc']) ){
    if (!empty($_POST['ans'])) {
      
    


	$qid= $_POST['qid'];
	$qdesc= $_POST['qdesc'];
	$qop1= $_POST['qop1'];
  $qop2= $_POST['qop2'];
  $qop3= $_POST['qop3'];
  $qop4= $_POST['qop4'];

  $exid=$_SESSION['exid'] ;



  $ans= $_POST['ans'];;


	
   $sql= "SELECT * FROM " .$TABLE_EXAM_QUESTION_INFO.
                                     
                            " WHERE ".$COL_EXAM_ID." = '".$exid. 
                            "' AND ".$COL_QUESTION_ID." = '".$qid."'";

                    //   echo  $sql; 

                         


                        $res= mysqli_query($connection,$sql); 
                        $count = mysqli_num_rows($res);;



                        if ($count==0) {

    $qid= $_SESSION["count"]+1;
                    $_SESSION["count"]=$qid;

           $sql="INSERT INTO " .$TABLE_EXAM_QUESTION_INFO." ( "
           .$COL_QUESTION_ID." , " 
           .$COL_EXAM_ID." , " 
           .$COL_QUESTION_DESC." , " 
           .$COL_QUESTION_IMAGE." , " 
           .$COL_QOP_1." , " 
           .$COL_QOP_2." , " 
           .$COL_QOP_3." , " 
           .$COL_QOP_4." , " 
           .$COL_ANS." )
          
           VALUES ('$qid','$exid','$qdesc','$targetPath','$qop1','$qop2','$qop3','$qop4','$ans');";


          // echo  $sql; 
           mysqli_query($connection,$sql);	


                 header('Location: show_exams_of_course.php');

}

   else{

                     echo "<script>
                                  alert('Same quesion id already exists in database. Please change the id and retry');
                                  window.location.href='add_question_for_exam.php';
                                  </script>";
                }


	
}
}

 // else{

 //                     echo "<script>
 //                                  alert(' Please put description and answer, then retry');
 //                                  window.location.href='add_question_for_exam.php';
 //                                  </script>";
 //                }



?>


<head>

  <title> ADD QUESTION</title>

  <link rel="stylesheet" href="../css/form.css">


</head>

<body>




<div class="container">  
  <form id="form" action="add_question_for_exam.php" method="post" enctype="multipart/form-data">
    <h3>Add a question</h3>


     <fieldset>
<!--       <input placeholder="ID" type="text" id="qid" name="qid" tabindex="1" required >
 -->

      <textarea placeholder="Type the qquestion"  type="text" id="qdesc" name="qdesc" tabindex="2"  required></textarea>

      <input type="file" accept="image/*"  id="qimage" name="qimage" tabindex="3" >
      

    </fieldset>


    <h2> Show options </h2>

     <fieldset>
      <input placeholder="Option 1 " type="text" id="qop1" name="qop1" tabindex="4" required >
   
  
      <input placeholder="Option 2" type="text" id="qop2" name="qop2" tabindex="5" required>
   
      <input placeholder="Option 3" type="text" id="qop3" name="qop3" tabindex="6" >
   
      <input placeholder="Option 4" type="text" id="qop4" name="qop4" tabindex="7" >
      <input placeholder="Correct Ans" type="text" id="ans" name="ans" tabindex="8" required>



    </fieldset>
   

      <fieldset>
             

            <button name="save" type="submit" id="small_button"    >Save</button>

    </fieldset>
   
    
  </form>

  <form id="form" action="add_question_for_exam.php" method="post" enctype="multipart/form-data">
    <h4>Import Excel Sheet</h4>




    <fieldset>
      
          <input type="file" name="file" id="file" accept=".xls,.xlsx" >
         <!--  <input placeholder="Author" type="text" id="author" name="author" 
         > -->

      <button name="save" type="submit" id="small_button" >Save</button>


    </fieldset>
 

  
    
  </form>
</div>



</body>





