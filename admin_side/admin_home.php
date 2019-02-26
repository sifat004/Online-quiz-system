 
<!DOCTYPE html>
<html>
<head>

		<title> ADMIN HOME</title>
		      <link rel="stylesheet" href="../css/form.css">
                <link rel="stylesheet" href="../css/pure/pure-min.css">


		
</head>


<body>

                
<div class="container">
  





  	      
  <form id="form" action="" method="post" style="text-align: center;margin-top: 200px">




<fieldset>
         
         <button name="" type="submit" id="small_button"  formaction="add_student.php" >Add Student </button>
         <button name="" type="submit" id="small_button"  formaction="add_teacher.php" >Add Teacher </button>
         <button name="" type="submit" id="small_button"  formaction="add_course.php" >Add Course</button>



</fieldset>

<fieldset>
         <button name="" type="submit" id="small_button"  formaction="show_course_list.php" >Show Courses</button>

    <!--     <button name="" type="submit" id="small_button"  formaction="show_students.php" >Show Students</button>
        <button name="" type="submit" id="small_button"  formaction="show_teachers.php" >Show Teachers</button> -->



</fieldset>



 </form>



       
    <form>        
      <button name="home" type="submit" class="btn-success pure-button" id="small_button" formaction="changepassword.php" > Change Password
      </button>
          
                 
     </form>  

      <form>        
 
          <button name="home" type="submit" class="btn-success pure-button" id="small_button" formaction="logout.php" >
             LOG OUT
          </button>

          
                 
     </form>  


 </div>


</body>
</html>