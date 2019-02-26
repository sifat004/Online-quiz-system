


<div class="nav_wrapper">
  <header id="nav_header">
  
    <div id="nav_logo">
      <h1 id ="nav_h1">OQS</h1>
    </div>
    <div id="nav_custom">
      <ul id="nav_ui">
        <?php
        echo '<li class="nav_li">Logged in as ';

     
        echo $_SESSION['sname'];
       

        echo '</li>';

        echo '<li class="nav_li"><a class="nav_a" href="student_home.php"> Home</a></li>';       


        echo  '<li class="nav_li"><a class="nav_a" href="changepassword.php">Change Password </a></li>';


        echo  '<li class="nav_li"><a class="nav_a" href="logout.php" > Logout</a></li>';
        ?>
      </ul>
    </div>
  </header>
</div>