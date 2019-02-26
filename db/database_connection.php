



<?php

  require_once ('../db/dbindexes.php');


 $connection= mysqli_connect('127.0.0.1','root','', DB_NAME);
 $conn= $connection;
 $con=$connection;
 
 if(!$connection){
             exit('DB not connected');
 }

 else{
       // echo "Database Connected!";
 } 

 ?> 