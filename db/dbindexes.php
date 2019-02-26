<?php 

 


 	 const DB_NAME ='onlinequize'; 
 	
 	$TABLE_ADMIN_INFO= 'admininfo'; 
    $COL_ADMIN_ID= 'adid'; 
 	$COL_ADMIN_PASSWORD= 'adpw'; 
 	
 	$TABLE_COURSE_INFO='courseinfo'; 
 	$COL_COURSE_ID=  'cid'; 
 	$COL_COURSE_TITLE=  'ctitle'; 
    $COL_COURSE_CREDIT=  'ccredit'; 
 	$COL_DEPT_CODE=  'dept_code'; 


	$TABLE_STUDENT_INFO=  'studentinfo'; 
 	$COL_STUDENT_ID= 'sid'; 
 	$COL_STUDENT_NAME= 'sname'; 
 	$COL_STUDENT_PASSWORD= 'spw'; 
 	$COL_STUDENT_STATUS= 'sstatus'; 


 	$TABLE_TEACHER_INFO=  'teacherinfo'; 
 	$COL_TEACHER_ID= 'tid'; 
 	$COL_TEACHER_NAME=  'tname'; 
 	$COL_TEACHER_PASSWORD= 'tpw'; 
    $COL_OTHERS=  'others'; 

 	
 	$TABLE_COURSE_REG_STUDENT=  'courseregstudent'; 
 	$COL_CS_ID= 'csid'; 
 	$COL_YEAR=  'year'; 
 	$COL_SEMESTER= 'semester'; 

 	$TABLE_COURSE_REG_TEACHER=  'courseteacher'; 
 	$COL_CT_ID= 'ctid'; 
 	
 	
 	$TABLE_EXAM_INFO='examinfo'; 
 		$COL_EXAM_ID=  'exid'; 

	$COL_EXAM_NAME=  'exname'; 
    $COL_EXAM_FULL_MARKS=  'exfullmarks'; 
 	$COL_EXAM_DATE=  'exdate'; 
 	$COL_EXAM_DURATION=  'exduration'; 
    $COL_EXAM_STATUS=  'exstatus'; 
    $COL_MARKS_PER_Q=  'marks_per_q'; 
    $COL_NEGATIVE_MARKS_PER_Q=  'negative_marks_per_q'; 


    $TABLE_EXAM_QUESTION_INFO='examquestioninfo'; 
 	$COL_QUESTION_ID=  'qid'; 
    $COL_QUESTION_DESC=  'qdesc'; 
    $COL_QUESTION_IMAGE=  'qimage'; 
 	$COL_QOP_1=  'qop1'; 
 	$COL_QOP_2=  'qop2'; 
 	$COL_QOP_3=  'qop3'; 
 	$COL_QOP_4=  'qop4'; 
    $COL_ANS=  'ans'; 

    $TABLE_EXAM_STUDENT_RESULT='examstudentresult'; 
    $COL_MARKS='marks';


 $TABLE_EXAM_STUDENT_PARTICIPATION='examstudentparticipation'; 
        $COL_EXSID=  'exsid'; 


        $TABLE_EXAM_STUDENT_ANS='examstudentanswer';
        $COL_QANS_ID='qansid';
        $COL_STUDENT_ANS='stdent_answer';


?>