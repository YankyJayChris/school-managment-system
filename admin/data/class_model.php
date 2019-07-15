<?php

    $class = new Dataclass();
    if(isset($_GET['q'])){
        $class->$_GET['q']();
    }
    class Dataclass {
        
        function __construct(){
            if(!isset($_SESSION['id'])){
               header('location:../../');   
            }
        }
        
        //create logs
        function logs($act){            
            $date = date('m-d-Y h:i:s A');
            echo $q = "insert into log values(null,'$date','$act')";   
            mysql_query($q);
            return true;
        }
        
        //get all class info
        function getclass($search){
            $q = "select * from class where course like '%$search%' or year like '%$search%' or section like '%$search%' or sem like '%$search%' or subject like '%$search%' order by course,year,section,sem asc";
            $r = mysql_query($q);
            
            return $r;
        }
        
        //get class by ID
        function getclassbyid($id){
            $q = "select * from class where id=$id";
            $r = mysql_query($q);
            
            return $r;
        }
        //add class
        function addclass(){
            include('../../config.php');
            $course = $_POST['course'];
            $year = $_POST['year'];
            $section = $_POST['section'];
            $sem = $_POST['sem'];
            $subject = $_POST['subject'];
            $sy = $_POST['sy'];
            
            echo $q = "insert into class values('','$course','$year','$section','$sem','','$subject','$sy')";
            mysql_query($q);
            $act = "create new class $course $year - $section with the subject of $subject";
            $this->logs($act);
            header('location:../class.php?r=added');
        }
        
        //update class
        function updateclass(){
            include('../../config.php');
            $id = $_GET['id'];
            $course = $_POST['course'];
            $year = $_POST['year'];
            $section = $_POST['section'];
            $sem = $_POST['sem'];
            $subject = $_POST['subject'];
            $sy = $_POST['sy'];
            
            echo $q = "update class set course='$course', year='$year', section='$section', sem='$sem', subject='$subject', SY='$sy' where id=$id";
            mysql_query($q);
            $act = "update class $course $year - $section with the subject of $subject";
            $this->logs($act);
            header('location:../class.php?r=updated');
        }
        
        //get all students in that class
        function getstudentsubject(){ 
            $classid = $_GET['classid'];
            $q = "select * from studentsubject where classid=$classid";
            $r = mysql_query($q);
            $result = array();
            while($row = mysql_fetch_array($r)){
                $q2 = 'select * from student where id='.$row['studid'].'';
                $r2 = mysql_query($q2);
                $result[] = mysql_fetch_array($r2);
            }
            return $result;
        }
        
        //add student to class
        function addstudent(){
            include('../../config.php');  
            $classid = $_GET['classid'];
            $studid = $_GET['studid'];
            $verify = $this->verifystudent($studid,$classid);
            if($verify){
                echo $q = "INSERT INTO studentsubject (studid,classid) VALUES ('$studid', '$classid');";
                mysql_query($q);
                header('location:../classstudent.php?r=success&classid='.$classid.'');
            }else{
                header('location:../classstudent.php?r=duplicate&classid='.$classid.'');
            }
            
            $tmp = mysql_query("select * from class where id=$classid");
            $tmp_row = mysql_fetch_array($tmp);
            $tmp_subject = $tmp_row['subject'];
            $tmp_class = $tmp_row['course'].' '.$tmp_row['year'].'-'.$tmp_row['section'];
            
            $tmp = mysql_query("select * from student where id=$studid");
            $tmp_row = mysql_fetch_array($tmp);
            $tmp_student = $tmp_row['fname'].' '.$tmp_row['lname'];
            
            $act = "add student $tmp_student to class $tmp_class with the subject of $tmp_subject";
            $this->logs($act);
        }
        //verify if he/she is enrolled
        function verifystudent($studid,$classid){
            include('../../config.php');  
            $q = "select * from studentsubject where studid=$studid and classid=$classid";
            $r = mysql_query($q);
            if(mysql_num_rows($r) < 1){
                return true;
            }else{
                return false;   
            }
        }
        //remove student to the class
        function removestudent(){
            $classid = $_GET['classid'];
            $studid = $_GET['studid'];
            include('../../config.php');  
            $q = "delete from studentsubject where studid=$studid and classid=$classid";
            mysql_query($q);
            
            $tmp = mysql_query("select * from class where id=$classid");
            $tmp_row = mysql_fetch_array($tmp);
            $tmp_subject = $tmp_row['subject'];
            $tmp_class = $tmp_row['course'].' '.$tmp_row['year'].'-'.$tmp_row['section'];
            
            $tmp = mysql_query("select * from student where id=$studid");
            $tmp_row = mysql_fetch_array($tmp);
            $tmp_student = $tmp_row['fname'].' '.$tmp_row['lname'];
            
            $act = "remove student $tmp_student from class $tmp_class with the subject of $tmp_subject";
            $this->logs($act);
            
            header('location:../classstudent.php?r=success&classid='.$classid.'');
        }
        
        //update teacher
        function updateteacher(){
            $classid = $_GET['classid'];
            $teachid = $_GET['teachid'];
            include('../../config.php'); 
            $q = "update class set teacher=$teachid where id=$classid";
            mysql_query($q);
            
            $tmp = mysql_query("select * from class where id=$classid");
            $tmp_row = mysql_fetch_array($tmp);
            $tmp_subject = $tmp_row['subject'];
            $tmp_class = $tmp_row['course'].' '.$tmp_row['year'].'-'.$tmp_row['section'];
            
            $tmp = mysql_query("select * from teacher where id=$teachid");
            $tmp_row = mysql_fetch_array($tmp);
            $tmp_teacher = $tmp_row['fname'].' '.$tmp_row['lname'];
            
            $act = "assign teacher $tmp_teacher to class $tmp_class with the subject of $tmp_subject";
            $this->logs($act);
            
            header('location:../classteacher.php?classid='.$classid.'&teacherid='.$teachid.'');
        }
        
    }
?>