<?php

if(isset($_POST['sid']) ){

     ini_set('session.cache_limiter','public');
     session_cache_limiter(false);
	   session_start();


  $sid= $_POST['sid'];
  $spw= $_POST['spw'];



  require_once ('../db/database_connection.php');
  $sql= "SELECT * FROM ". $TABLE_STUDENT_INFO;
  
  $students = mysqli_query($connection,$sql);


   foreach ($students as $key=>$value)

            {
               
            	if (strcmp($value[$COL_STUDENT_ID],$sid)==0 & strcmp($value[$COL_STUDENT_PASSWORD],$spw)==0) {

            		
                     //session_register("username");
                      $_SESSION['sid'] = $sid;
                       $_SESSION['sname'] = $value[$COL_STUDENT_NAME];

                      $_SESSION['logged'] = $true;

            		header('Location: student_home.php');


            	}


            }
        }

?>

<head>
	<title> STUDENT LOGIN</title>

      <link rel="stylesheet" href="../css/form.css">

  
</head>

<body>
  <div class="container" >  
    

	<form id="form" action="student_login.php" method="post" style="text-align: center;margin-top: 200px">
    

    <fieldset>
      <input  type="text" name="sid" placeholder="STUDENT ID" autofocus>
    </fieldset>
   
    <fieldset>
      <input  type="text" name="spw" placeholder="Password"  autocomplete="off"  >
    </fieldset>

     <fieldset>

      <button name="submit" type="submit" style="width: 25%">OK</button>
    </fieldset>
  
  </form>







</div>

</body>
