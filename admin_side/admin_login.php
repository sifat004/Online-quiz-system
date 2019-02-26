<?php

if(isset($_POST['adid']) ){

ini_set('session.cache_limiter','public');
    session_cache_limiter(false);
	   session_start();

  $adid= $_POST['adid'];
  $adpw= $_POST['adpw'];



  require_once ('../db/database_connection.php');
  $sql= "SELECT * FROM ". $TABLE_ADMIN_INFO;
  
  $admins= mysqli_query($connection,$sql);

   foreach ($admins as $key=>$value)

            {
               
            	if (strcmp($value[$COL_ADMIN_ID],$adid)==0 & strcmp($value[$COL_ADMIN_PASSWORD],$adpw)==0) {

            		
                     //session_register("username");
                      $_SESSION['login_user'] = $adid;
            		header('Location: admin_home.php');


            	}


            }
        }

?>

<head>
	<title> ADMIN LOGIN</title>

      <link rel="stylesheet" href="../css/form.css">

  
</head>

<body>
  <div class="container" >  
    

	<form id="form" action="admin_login.php" method="post" style="text-align: center;margin-top: 200px">
    

    <fieldset>
      <input  type="text" name="adid" placeholder="Admin ID"  autofocus>
    </fieldset>
   
    <fieldset>
      <input  type="text" name="adpw" placeholder="Password" autocomplete="off" >
    </fieldset>

     <fieldset>

      <button name="submit" type="submit" style="width: 25%">OK</button>
    </fieldset>
  
  </form>







</div>

</body>
