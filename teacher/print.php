<?php
    error_reporting(0);
    include('../config.php');
    include('data/subject_model.php');
    include('data/student_model.php');
    $id = $_SESSION['id'];
    $q = "select * from teacher where teachid='$id'";
    $r = mysql_query($q);
    if($row = mysql_fetch_array($r)){
        $teacher = $row['fname'].' '.$row['lname'];
    }
    $classid = $_GET['classid'];
    $mystudent = $student->getstudentbyclass($classid);
    $mysubject = $subject->getsubjectbyid($classid);
?>
<!DOCTYPE html>
<html>
<head>
    
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Print Report</title>

    <!-- Bootstrap Core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <style type="text/css">
        .wrapper {
            margin-top:20px !important;            
            border:1px solid #777;
            background:#fff;
            margin:0 auto;
            padding: 20px;
        }
        body {
            background:#ccc;   
        }
        img {
            max-height:150px;   
            max-width:150px;   
            margin-right:10px;
        }
        .table>thead>tr>th, .table>tbody>tr>th, .table>tfoot>tr>th, .table>thead>tr>td, .table>tbody>tr>td, .table>tfoot>tr>td {
            border-top: none !important;   
        }
        
    </style>
</head>
<body>
    <div class="container wrapper">
        <div class="row">
            <div class="col-lg-12">
                <div class="text-center">                    
                    <h3>Grade Sheet</h3> 
                    <hr />
                    <?php while($row = @mysql_fetch_array($mysubject)): ?>
                    <?php $mysubjectname = $subject->getsubjectbycode($row['subject']); ?>
                    <table class="table">
                        <tr>
                            <td style="width:20%;text-align:left;"><strong>SUBJ CODE:</strong></td>
                            <td style="width:*;text-align:left;"><?php echo $row['subject'];?></td>
                            <td style="width:10%;text-align:left;"><strong>DATE:</strong></td>
                            <td style="width:25%;text-align:left;"><?php echo date('F d, Y')?></td>
                        </tr>
                        <tr>
                            <td class="text-left"><strong>SECTION:</strong></td>
                            <td class="text-left"><?php echo $row['section'];?></td>
                            <td class="text-left"><strong>UNITS:</strong></td>
                            <td class="text-left"><?php echo $mysubjectname['unit'];?></td>
                        </tr>
                        <tr>
                            <td class="text-left"><strong>SUBJ NAME:</strong></td>
                            <td class="text-left"><?php echo $mysubjectname['title'];?></td>
                            <td class="text-left"><strong>S.Y :</strong></td>
                            <td class="text-left"><?php echo $row['SY'];?></td>
                        </tr>
                        <tr>
                            <td class="text-left"><strong>INSTRUCTOR:</strong></td>
                            <td class="text-left"><?php echo strtoupper($teacher);?></td>
                            <td class="text-left"><strong>COURSE:</strong></td>
                            <td class="text-left"><?php echo $row['course'];?></td>
                        </tr>
                    </table>                    
                    <?php endwhile; ?>
                </div>               
            </div>
        </div> 
        
        
        
        <div class="row">
            <div class="col-lg-12">                

                <div class="">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th class="text-center">Student's Name</th>
                                <th class="text-center">Prelim</th>
                                <th class="text-center">Midterm</th>
                                <th class="text-center">Final</th>
                                <th class="text-center">FINAL GRADE</th>
                                <th class="text-center">EQUIVALENT</th>
                                <th class="text-center">REMARKS</th>
                            </tr>
                        </thead>
                        <tbody>
                    <?php $c=1; ?>
                    <?php foreach($mystudent as $row): ?>
                        <tr>
                            <td><?php echo $c; ?></td>       
                            <td><?php echo $row['lname'].', '.$row['fname']; ?></td>  
                            <?php $grade = $student->getstudentgrade($row['id'],$classid); ?>
                            <td class="text-center"><?php echo $grade['prelim'];?></td>    
                            <td class="text-center"><?php echo $grade['midterm'];?></td>    
                            <td class="text-center"><?php echo $grade['final'];?></td>    
                            <td class="text-center"><?php echo $grade['total'];?></td>                                
                            <td class="text-center"><?php echo $grade['eqtotal'];?></td> 
                            <?php
                                if($grade['eqtotal']<=3.0){
                                    $remarks = 'PASSED';
                                    $class = 'text-success';
                                }else{
                                    $remarks = 'FAILED';
                                    $class = 'text-danger';   
                                }
                            ?>
                            <td class="text-center <?php echo $class;?>"><?php echo $remarks;?></td> 
                        </tr>
                    <?php $c++; ?>
                    <?php endforeach; ?>
                    <?php if(!$mystudent): ?>
                        <tr><td colspan="8" class="text-center text-danger"><strong>*** No Result ***</strong></td></tr>
                    <?php endif; ?>
                        </tbody>
                    </table>
                </div>        
            </div>
        </div>
    </div>
    
</body>

</html>