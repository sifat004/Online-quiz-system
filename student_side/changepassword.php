<?php

if(isset($_POST['sid']) ){
  
     include("start_session.php");


  $sid= $_POST['sid'];
  $old_spw= $_POST['old_spw'];
  $new_spw= $_POST['new_spw'];
  $conf_spw= $_POST['conf_spw'];



  require_once ('../db/database_connection.php');
  $sql= "SELECT * FROM ". $TABLE_STUDENT_INFO;
  
  $students= mysqli_query($connection,$sql);

   foreach ($students as $key=>$value)

            {
               
            	if (strcmp($value[$COL_STUDENT_ID],$sid)==0 & strcmp($value[$COL_STUDENT_PASSWORD],$old_spw)==0) {

            		
                     //session_register("username");


                if (strcmp($new_spw,$conf_spw)==0) {
                    $sql= "UPDATE " .$TABLE_STUDENT_INFO.
                    " SET ".$COL_STUDENT_PASSWORD." = '".$new_spw."'".
                    " WHERE ".$COL_STUDENT_ID." = '".$sid."'";

                  //  echo $sql;

                   $a= mysqli_query($connection,$sql);


                   header('Location: student_login.php');


                }


            	}


            }
        }

?>

<head>
	<title>Change Password</title>

      <link rel="stylesheet" href="../css/form.css">

  
</head>

<body>
  <div class="container" >  
    

	<form id="form" action="changepassword.php" method="post" style="text-align: center;margin-top: 200px">
    

    <fieldset>
      <input  type="text" name="sid" placeholder="STUDENT ID" name="username"  autofocus>
    </fieldset>
   

      <fieldset>
      <input  type="text" name="old_spw" placeholder="Old Password" name="password" >
    </fieldset>
    <fieldset>
      <input  type="text" name="new_spw" placeholder="New Password" name="password" >
    </fieldset>


    <fieldset>
      <input  type="text" name="conf_spw" placeholder="Confirm Password" name="password" >
    </fieldset>
     <fieldset>

      <button name="submit" type="submit" style="width: 25%">OK</button>
    </fieldset>
  
  </form>







</div>

</body>
