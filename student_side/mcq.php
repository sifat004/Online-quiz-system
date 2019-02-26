 <?php
    session_start();

				

 ?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>
			MCQ
		</title>
		<link href='http://fonts.googleapis.com/css?family=Sintony:400,700' rel='stylesheet' type='text/css'>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>

	    <link href="../css/navbar.css" rel="stylesheet">

		<link href="../css/bootstrap.css" rel="stylesheet">
		<link href="../css/mcq_style.css" rel="stylesheet">
		<link href="../css/buttons.css" rel="stylesheet">


		<script type="text/javascript">var duration = "<?= $_SESSION['duration'] ?>";</script>
	    
	    <script src="../js/countdown.js"></script>

		<script type="text/javascript">
		function finish(clicked_name)
		{
			var x;
			if(clicked_name=="done")
			{
				x = confirm("Are you sure to submit all your answers");
				if(x==true)
				{
					document.cookie="proceed=1";
					return true;
				}
				else
				{
					document.cookie="proceed=0";
					return false;
				}
			}
		}



		</script>






	</head>
	<body>



</script>

    <?php include("navbar.php");?>
    

    <input type="hidden" id="duration" value="<?php echo $_SESSION['duration'] ?>" />

	



	<?php  
		

			$_SESSION['prev_id']=$_SESSION['id'];
			$_SESSION['id']++;
			if($_SESSION['id']==$_SESSION['no_of_ques']+1 && !isset($_GET['question']))
				{
					$_SESSION['id']=1;
				}
			else
				if(isset($_GET['question']))
					if($_GET['question']==-9 && $_SESSION['id']==2)
						$_SESSION['id']=intval($_SESSION['no_of_ques']);
					else
						if($_SESSION['id']>=1)
							$_SESSION['id']=$_SESSION['id']-2;
			if(isset($_SESSION['mcqdone']))
				if($_SESSION['mcqdone']==1)
					$_SESSION['id']=$_SESSION['no_of_ques']+9;
			/*Submitting All answers and ending mcq*/

			if (!empty($_POST['done'])) 
			{
				if($_COOKIE['proceed']==1)
					{
						$_SESSION['id']=$_SESSION['no_of_ques']+9;
						$_SESSION['mcqdone']=1;


						header('Location: mcq.php');

					}
				else
					$_SESSION['id']=$_SESSION['prev_id'];
			}


		


	

			/*----------------------------------------------*/

			if($_SESSION['id']<=$_SESSION['no_of_ques']+9)
				{
					if(array_key_exists($_SESSION['id']-1, $_SESSION['arr']))
						$c=$_SESSION['arr'][$_SESSION['id']-1];
					else
						$c=-1;
				}
			else
				$c=-1;
			

		

// getting question row

			// include("components/db_connect.php");
			require_once ('../db/database_connection.php');
			          $exid=$_SESSION['exid'];



          $query=" SELECT * FROM ".$TABLE_EXAM_QUESTION_INFO." WHERE ".$COL_EXAM_ID." = '$exid'";

				if ($result=mysqli_query($con,$query))
				  {
				  // Seek to row number 15
				



				  mysqli_data_seek($result,$c-1);

				  // Fetch row
				  $row=mysqli_fetch_row($result);


				  // Free result set
				 // mysqli_free_result($result);
				}

			// $q_sec="SELECT * FROM questions WHERE id='$c'";
			// $result_sec=mysqli_query($con,$q_sec);
		
			$h_sec=$row;


			/*Storing answers in answers array and questions answered in question array*/

		

			if(!empty($_POST['choice'])&& !empty($_POST['submitted']))
			{	
				if(array_key_exists($_SESSION['index'], $_SESSION['arr']))
				{
					$d=$_SESSION['arr'][$_SESSION['index']];	

					$_SESSION['ansarray'][$d]=$_POST['choice'];

					$sid=$_SESSION['sid'];
					$qid=$_SESSION['qid'][$d-1];
					$ans=substr($_POST['choice'],0,1);


             $query= "INSERT INTO " .$TABLE_EXAM_STUDENT_ANS." ( "
                            .$COL_QANS_ID." , "  

                           .$COL_STUDENT_ID." , " 
                           .$COL_QUESTION_ID." , " 

                           .$COL_STUDENT_ANS." )
          
                  VALUES ('','$sid','$qid','$ans');";			
                  	}

                  	mysqli_query($con,$query);

				if(!in_array($d,$_SESSION['ques_id']))
					array_push($_SESSION['ques_id'],$d);
			}
			$_SESSION['index']=$_SESSION['id']-1;

			/*---------------------------------------------------*/
			/*Timer*/


			if($_SESSION['id']<=$_SESSION['no_of_ques']+5)	
				echo '<div id="time" ></div>';
				
			/*-------------------------*/			

			/*Side menu of questions links*/	

			if($_SESSION['id']<=$_SESSION['no_of_ques']+5)
			{

				echo '<div class="container">';   
				echo '<div id="question_links">';
				for ($link=0; $link < $_SESSION['no_of_ques']; $link++) 
				{
					$button="linkbutton";
					if(array_key_exists($_SESSION['arr'][$link], $_SESSION['ansarray']))
						$button="answered";
					if($link==$_SESSION['id']-1) 
						$button="current_ques";	
					echo "<a class='$button' id='buttons' href='link.php?question=$link'>".($link+1).'</a>';
				} 
				echo '</div>';				
			}

			/*------------------------------------------------------*/

			$ques=htmlspecialchars($h_sec[2]);
			// $no=intval($h_sec[0]);
			$no=array_search($h_sec[0], $_SESSION['qid'])+1;
			$op1=htmlspecialchars($h_sec[4]);
			$op2=htmlspecialchars($h_sec[5]);
			$op3=htmlspecialchars($h_sec[6]);
			$op4=htmlspecialchars($h_sec[7]);
			$img=htmlspecialchars($h_sec[3]);

			// var_dump($_SESSION['qid']);
			// var_dump($_POST);

			if(in_array($no,$_SESSION['ques_id']))
				$x=$_SESSION['ansarray'][$no];	
			if($_SESSION['id']<=$_SESSION['no_of_ques']+5)
			{
				echo '<div class="container" id="mainarea">';
				?>	
				<form action="mcq.php" method="POST" id="form">
					<legend>
						MCQ

				
<!-- 
						<?php

							//var_dump($_SESSION['ansarray']);

						 ?> -->




<!-- s -->

						
					</legend>

					<table class="table">
						<tr class="question">
							<td>
								<?php echo 'Q' . $_SESSION['id'];?>
							</td>
							<td >
								<?php echo nl2br($ques);?>
							</td>


						</tr>

				
					</table>

							<?php 


								if ($img!=null) {

								
								echo     

								"<img src='../admin_side/".$img."'  border=3 height=50 width=150></img>"
								;

							   	var_dump($x);


							   }

							?>

					<table class="table table-striped">
						<tr>
							<td>
								(A)
							</td>
							<td>
								<label class="radio" for="a"> 
									<input onChange="this.form.submit();" id="a" type="radio" name="choice" value="<?php echo 'a' . $no;?>" <?php 

									 if(isset($x)) 
									 	if($x==('a'.$no))
									 	 echo 'checked';?>/> <?php echo nl2br($op1); ?>
								</label>
							</td>
						</tr>
						<tr>
							<td>
								(B)
							</td>
							<td>
								<label class="radio" for="b">
									<input onChange="this.form.submit();" id="b" type="radio" name="choice" value="<?php echo 'b' . $no;?>" <?php if(isset($x)) if($x==('b'.$no)) echo 'checked';?>/> <?php echo nl2br($op2); ?>
								</label>
							</td>
						</tr>
						<tr>
							<td>
								(C)
							</td>
							<td>
								<label class="radio" for="c">
									<input onChange="this.form.submit();" id="c" type="radio" name="choice" value="<?php echo 'c' . $no; ?>" <?php if(isset($x)) if($x==('c'.$no)) echo 'checked';?>/> <?php echo nl2br($op3); ?>
								</label>
							</td>
						</tr>
						<tr>
							<td>
								(D)
							</td>
							<td>
								<label class="radio" for="d"> 
									<input onChange="this.form.submit();" id="d" type="radio" name="choice" value="<?php echo 'd' . $no; ?>" <?php if(isset($x)) if($x==('d'.$no)) echo 'checked';?>/> <?php echo nl2br($op4); ?>
								</label>
							</td>
						</tr>
					</table>


					<div id="button_container" class="prev-next">
						<input type="button"  class="button-warning" value="Back" onclick="self.location='mcq.php?question=-9'">
						<input type="submit"  class="button-success" value="Submit" name="submitted">

						<input type="submit"  class="button-warning" value="Next" >	
	
					</div>
					<div class="alert alert-success done" id="submit_container">
					<p class="pull-left">Press <strong>Done</strong> to submit all answers</p>
					<div id="button_container">
						<input type="submit" id="submit" onclick="finish(this.name)"  name="done" class="btn btn-success btn-large" value="Done">
					</div>
					</div>							
				</form>								
<?php			
					}
			else
			{
				echo '<div class="container">';
				echo '<div class="container" id="mainarea2">';	
				$res=0;
				// for($i=0;$i<count($_SESSION['ques_id']);$i++)
				// { 	
				// 	if(array_key_exists($i, $_SESSION['ques_id']))
				// 	{
				// 		$f=$_SESSION['ques_id'][$i];
				// 		$q_sec=" SELECT * FROM ".$TABLE_EXAM_QUESTION_INFO." WHERE ".$COL_QUESTION_ID." = '$f'";
				// 		$result_sec=mysqli_query($con,$q_sec);
				// 		$h_sec=mysqli_fetch_array($result_sec);
				// 		$d=$_SESSION['ques_id'][$i];	
				// 		// $_SESSION['actualans'][$d]=($h_sec['ans'].$h_sec['id']);

				// 		$_SESSION['actualans'][$d]=(htmlspecialchars($h_sec[8]).
				// 			array_search(intval($h_sec[0]), $_SESSION['qid']));

				// 	}
				// }


	   //         for($i=0;$i<count($_SESSION['qid']);$i++)
				// { 	
				// 	if(array_key_exists($i, $_SESSION['qid']))
				// 	{
				// 		$f=$_SESSION['qid'][$i];
				// 		$q_sec=" SELECT * FROM ".$TABLE_EXAM_QUESTION_INFO." WHERE ".$COL_QUESTION_ID." = '$f'";
				// 		$result_sec=mysqli_query($con,$q_sec);
				// 		$h_sec=mysqli_fetch_array($result_sec);
				// 		// $_SESSION['actualans'][$d]=($h_sec['ans'].$h_sec['id']);

				// 		$_SESSION['actualans'][$i]=(htmlspecialchars($h_sec[8]).
				// 			$i);

				// 	}
				// }

				// echo '<script>DeleteAllCookies();</script>';
				echo '<div class="alert alert-success"><strong>Thanks</strong> for Participating</div>';
				$e=count($_SESSION['ansarray']);
				/*--------------- Checking of answers ------------ */

        // $query="SELECT * FROM marking_scheme";
        // $qresult=mysqli_query($con,$query);
        // $result=mysqli_fetch_array($qresult);
        // $pos=$result ["positive"];
        // $neg=$result["negative"];
        // $marking=$result["negative_marking"];



				  $sql= "SELECT * FROM " .$TABLE_EXAM_INFO.
                       
                                " WHERE ".$COL_EXAM_ID." = '".$exid."'";

                       $result_sec=mysqli_query($con,$sql);
						$h_sec=mysqli_fetch_array($result_sec);
                            $pos= intval($h_sec[9]); 


				
                   $neg= floatval($h_sec[10]); 


				$marking=0;


        if($marking==0)				
					for($i=0;$i<$e;$i++)
					{	

						$g=$_SESSION['arr'][$i];
						if($_SESSION['ansarray'][$g]==$_SESSION['actualans'][$g-1])
						$res=$res+$pos;
						else $res-=$neg;

						$p=$_SESSION['ansarray'][$g];
						$q=	$_SESSION['actualans'][$g-1];


				
					}
				else
				for($i=0;$i<$e;$i++)
					{	
						$g=$_SESSION['ques_id'][$i];
						if($_SESSION['ansarray'][$g]==$_SESSION['actualans'][$g])
							$res=$res+$pos;
						else
							$res=$res-$neg;
					}				

				/* ------------------------------- */
				$p=$_SESSION['sname'];

				echo "Your result is ";
				echo "<h1>".$res."</h1>";
	

							// var_dump($_SESSION['ansarray']);
							// echo "<br>";
							// 							var_dump($_SESSION['actualans']);


						
				// $q_sec="UPDATE  details SET score='$res' WHERE email = '$p'";

				$exid=$_SESSION['exid'];
				$sid=$_SESSION['sid'];

				  $sql= "SELECT * FROM " .$TABLE_EXAM_STUDENT_RESULT.
                       
                                " WHERE ".$COL_STUDENT_ID." = '".$sid. 
                                "' AND ".$COL_EXAM_ID." = '".$exid."'";


                            $result= mysqli_query($connection,$sql); 
                            $count = mysqli_num_rows($result);;



                 if ($count==0) {

				$query= "INSERT INTO " .$TABLE_EXAM_STUDENT_RESULT." ( "
                            .$COL_EXAM_ID." , "  

                           .$COL_STUDENT_ID." , " 
                           .$COL_MARKS." )
          
                  VALUES ('$exid','$sid','$res');";


				mysqli_query($con,$query);

			     }
				echo '<div class="alert alert-error"><p>Please Logout before leaving.</p></div>';
    			//echo '<p class="lead">No of questions correct answered = ' . $res . ' Out of '. $_SESSION['no_of_ques'] . '</p>';
				$_SESSION['completed']=1;
				//include("components/db_disconnect.php");
			}
			echo '</div>';
			echo '</div>';
			setcookie("id",serialize($_SESSION['id']),time()+3600);
			setcookie("ques_id",serialize($_SESSION['ques_id']),time()+3600);
			setcookie("ansarray",serialize($_SESSION['ansarray']),time()+3600);
		//}
		// else
		// {
		// 	echo '<div class="container" id="content">';
		// 	echo '<div class="container" id="mainarea2">';
		// 	echo '<div class="alert alert-error"><strong>Error !</strong>  You need to login to continue</div>';
		// 	echo '</div>';
		// 	echo '</div>';	
		// }
	?>
</body>
</html>
