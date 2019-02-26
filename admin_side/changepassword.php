<?php

if(isset($_POST['adid']) ){
  ini_set('session.cache_limiter','public');
    session_cache_limiter(false);

	   session_start();

  $adid= $_POST['adid'];
  $old_adpw= $_POST['old_adpw'];
  $new_adpw= $_POST['new_adpw'];
  $conf_adpw= $_POST['conf_adpw'];



  require_once ('../db/database_connection.php');
  $sql= "SELECT * FROM ". $TABLE_ADMIN_INFO;
  
  $admins= mysqli_query($connection,$sql);

   foreach ($admins as $key=>$value)

            {
               
            	if (strcmp($value[$COL_ADMIN_ID],$adid)==0 & strcmp($value[$COL_ADMIN_PASSWORD],$old_adpw)==0) {

            		
                     //session_register("username");


                if (strcmp($new_adpw,$conf_adpw)==0) {
                    $sql= "UPDATE " .$TABLE_ADMIN_INFO.
                    " SET ".$COL_ADMIN_PASSWORD." = '".$new_adpw."'".
                    " WHERE ".$COL_ADMIN_ID." = '".$adid."'";

                   // echo $sql;

                   $a= mysqli_query($connection,$sql);


                   header('Location: admin_login.php');


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
      <input  type="text" name="adid" placeholder="Admin ID" name="username"  autofocus>
    </fieldset>
   

      <fieldset>
      <input  type="text" name="old_adpw" placeholder="Old Password" name="password" >
    </fieldset>
    <fieldset>
      <input  type="text" name="new_adpw" placeholder="New Password" name="password" >
    </fieldset>


    <fieldset>
      <input  type="text" name="conf_adpw" placeholder="Confirm Password" name="password" >
    </fieldset>
     <fieldset>

      <button name="submit" type="submit" style="width: 25%">OK</button>
    </fieldset>
  
  </form>







</div>

</body>
