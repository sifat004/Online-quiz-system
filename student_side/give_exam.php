

<?php

  include("start_session.php");

        echo '<script src="../js/cookies.js"></script>';
        echo '<script>DeleteAllCookies();</script>';



          $username=$_SESSION['sid'];
          $exid=$_SESSION['exid'];




      
          // session_destroy();
          // include("start_session.php");

          //   $_SESSION['sid']=$username;
          //   $_SESSION['exid']=$exid;

  
 
  if(isset($_POST['exid']) ){
  
    $_SESSION['exid'] = $_POST['exid'];
          $username=$_POST['sid'];

    $_SESSION['sid']=$username;

  //  echo $username;

  }

  $exid=$_SESSION['exid'];
  require_once ('../db/database_connection.php');

  
  $sql= " SELECT * FROM ".$TABLE_EXAM_QUESTION_INFO." WHERE ".$COL_EXAM_ID." = '$exid'";
  $questions=mysqli_query($connection,$sql);

          $_SESSION['qid']=array();
          $_SESSION['actualans']=array();

$i=1;
        foreach ($questions as $key=>$value){

               $d = $value[$COL_QUESTION_ID];
               $r=  $value[$COL_ANS].$i;

                        array_push($_SESSION['qid'],$d);
                        array_push($_SESSION['actualans'],$r);
                        $i++;

           }


          include("../db/database_connection.php");
            require_once ('../db/database_connection.php');




          $query="SELECT * FROM ". $TABLE_STUDENT_INFO." WHERE ".$COL_STUDENT_ID." = '$username'";
          $result=mysqli_query($con,$query);
          $value=mysqli_fetch_array($result);
          $_SESSION['name']=$value[$COL_STUDENT_NAME];
          // $logout_status=$value['Logout_status'];
          

          $query=" SELECT * FROM ".$TABLE_EXAM_INFO." WHERE ".$COL_EXAM_ID." = '$exid'";
          $result=mysqli_query($con,$query);
          $value=mysqli_fetch_array($result);
          setcookie("timer",$value[$COL_EXAM_DURATION],time()+3600*24);

          $_SESSION['duration']=$value[$COL_EXAM_DURATION];

          
          $query=" SELECT * FROM ".$TABLE_EXAM_QUESTION_INFO." WHERE ".$COL_EXAM_ID." = '$exid'";
          $result=mysqli_prepare($con,$query);
          mysqli_stmt_execute($result);
          mysqli_stmt_store_result($result);
          $value= mysqli_stmt_num_rows($result);
          $_SESSION['no_of_ques']=$value;
          $_SESSION['arr']=range(1,$value);
                    shuffle($_SESSION['arr']);


          $_SESSION['completed']=0;
          $_SESSION['id']=0;
          $_SESSION['ansarray']=array();
          // $_SESSION['actualans']=array();
          $_SESSION['ques_id']=array();

          $_SESSION['logged']=true;

                      $_SESSION['mcqdone']=0;



                           $sql= "SELECT * FROM " .$TABLE_EXAM_STUDENT_PARTICIPATION.
                       
                                " WHERE ".$COL_STUDENT_ID." = '".$_SESSION['sid']. 
                                "' AND ".$COL_EXAM_ID." = '".$exid."'";

                        //   echo  $sql; 


                            $res= mysqli_query($connection,$sql); 
                            $count = mysqli_num_rows($res);;


                              $sid=$_SESSION['sid'];

                            if ($count==0) {

                      $sql="INSERT INTO " .$TABLE_EXAM_STUDENT_PARTICIPATION." ( "
                           .$COL_EXSID." , " 
                           .$COL_EXAM_ID." , " 
                      
                           .$COL_STUDENT_ID." )
                          
                           VALUES ('','$exid','$sid');";

                   
                           

                       //    echo  $sql; 
                           mysqli_query($connection,$sql);   


                   header('Location: mcq.php');
                 }

                 else{


               

                                  echo "<script>
                                  alert('Cannot attempt again, you have already participated this exam.');
                                  window.location.href='student_home.php';
                                  </script>";
                                    
                                     }
                 


          // include("components/db_disconnect.php");
          
          // if($_SESSION['log_out_status'])
          // {
          //   echo "<script>self.location='resume.php?logout_stat=1&us=$username'</script>";
          // }
          // else
          // {
          //   echo '<script>self.location="resume.php?logout_stat=0"</script>';
          // } 
        


       // content();


?>

