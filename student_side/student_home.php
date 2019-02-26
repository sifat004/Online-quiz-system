
  <?php include("start_session.php");?>
 

<!DOCTYPE html>
<html>
<head>

		<title> STUDENT HOME</title>
           <link href="../css/card.css" rel="stylesheet" >
           <link href="../css/navbar.css" rel="stylesheet" >


		
</head>


<body>

                
<div class="container">
  


    <?php include("navbar.php");?>


  


  	      
  <form id="form" action="" method="post" style="text-align: center;margin-top: 200px">

    <div class="wrapper">

  <div class="card">
    <h3 class="card-title">Upcoming</h3>
    <p class="card-content"> Visit upcoming exams</p>
    <button class="card-btn" formaction="upcoming_exams.php">Show</button>
  </div>


  <div class="card">
    <h3 class="card-title">Show courses</h3>
    <p class="card-content"> Show registered courses</p>
    <button class="card-btn" formaction="show_courses.php">Show</button>
  </div>


  <div class="card">
    <h3 class="card-title">Current exams</h3>
    <p class="card-content"> Give available exams</p>
    <button class="card-btn" formaction="current_exams.php">Show</button>
  </div>

  </div>

 




 </div>


</body>
</html>