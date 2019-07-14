<?php
    $page= 'addmarks';
    include('include/header.php');
    include('include/navbar.php');

    if (isset($_GET['examname'])){
        $examname1 = $_GET['examname'];
        $classname1 = $_GET['classid'];
        $r = "select * from exams where examname='$examname1' and classid='$classname1'";
        $stmt5 = $pdo->prepare($r);
        $stmt5->execute();
        $setings = $stmt5->fetch(PDO::FETCH_ASSOC);
        $classname1= $setings['classid'];
        $course1= $setings['course'];
        $section1 = $setings['section'];
        $subject1 = $setings['subject'];
        $examtype1 = $setings['examtype'];
        $sy1 = $setings['sy'];
        $maxmarks1 = $setings['maxmarks'];
        $year1 = $setings['year'];
        $examstatus= $setings['aproved'];

            $q2= "SELECT * From marks where classid='$classname1' and examtype='$examtype1' and examid='$examname1'";
            $stmt8 = $pdo->prepare($q2);
            $stmt8->execute();
            $students = $stmt8->fetchall(PDO::FETCH_OBJ);
            
    }

    if(isset($_POST['getseting'])){

        $examid = $_POST['examid'];

        $r = "select * from exams where id='$examid'";
        $stmt6 = $pdo->prepare($r);
        $stmt6->execute();
        $setings = $stmt6->fetch(PDO::FETCH_ASSOC);
        $classname1= $setings['classid'];
        $examname1= $setings['examname'];
        $course1= $setings['course'];
        $section1 = $setings['section'];
        $subject1 = $setings['subject'];
        $examtype1 = $setings['examtype'];
        $sy1 = $setings['sy'];
        $maxmarks1 = $setings['maxmarks'];
        $year1 = $setings['year'];
        $examstatus= $setings['aproved'];

            $q2= "SELECT * From marks where subjectid='$course1' and classid='$classname1' and year='$year1' and sy='$sy1' and examtype='$examtype1' and examid='$examname1' ";
            $stmt8 = $pdo->prepare($q2);
            $stmt8->execute();
            $students = $stmt8->fetchall(PDO::FETCH_OBJ);
    }
?>

<div class="content">
    <div class="container-fluid">
        <div class="row">
        <div class="col-md-12">
                <div class="card">
                    <div class="container-fluid">

                        <!-- Page Heading -->
                        <div class="row">
                            <div class="col-lg-12">
                                <h1 class="page-header">
                                    <small>Edit Marks</small>
                                </h1>
                                <ol class="breadcrumb">
                                    <li>
                                        <i class="fa fa-dashboard"></i> <a href="index.php">Dashboard</a>
                                    </li>
                                    <li>
                                        <a href="addmarks.php">Add Marks</a>
                                    </li>
                                    <li class="active">
                                        Edit Marks
                                    </li>
                                </ol>
                            </div>
                        </div>
                        <!-- /.row -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-inline form-padding">
                                    <form method="post">
                                        <!-- <input type="text" class="form-control" name="search" placeholder="Search by ID or Name"> -->
                                        <select name="examid" class="form-control" required>
                                            <option value="">Select Subject...</option>  
                                            <?php 
                                            $one='1';
                                            $tmp = $_SESSION['id'];
                                            $q = "select * from teachers where teacherid='$tmp'";
                                            $stmt = $pdo->prepare($q);
                                            $stmt->execute();
                                            $result = $stmt->fetch(PDO::FETCH_ASSOC);
                                            $teacherid = $result['teacherid'];

                                            $r = "select * from exams where teacherid='$teacherid' and marksadded='$one' ORDER BY id DESC";
                                            $stmt = $pdo->prepare($r);
                                            $stmt->execute();
                                            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                                                    extract($row);
                                    
                                            echo "<option value='$id'>$examname ($classid)</option>";}
                                        ?>                          

                                        </select>
                                        <button type="submit" name="getseting" class="btn btn-primary"><i class="fa fa-search"></i> Search</button>                       
                                        <a href="print.php?classid=<?php echo $classid; ?>" target="_blank"><button type="button" name="submit" class="btn btn-success"><i class="fa fa-print"></i> Print</button></a>            
                                    </form>
                                </div>
                                <div class="form-inline form-padding">
                                <form method="post">

                                    <h3>Setings</h3>
                                    <?php
                                     echo '<input type="text" class="form-control" style="width:300px" readonly value= "Class Name: '.$classname1.'" name="classname" placeholder="Class..."> 
                                     <input type="text" class="form-control" style="width:200px" readonly value= "Exam Name: '.$examname1.'" name="search" placeholder="Exam Name...">
                                     <input type="text" class="form-control" style="width:200px" readonly value= "Maximum Marks: '.$maxmarks1.'" name="search" placeholder="Max marks...">
                                     <input type="text" class="form-control" style="width:200px" readonly value= "Type : '.$examtype1.'" name="search" placeholder="Max marks...">';
                                    ?>
                        
                                </form>
                            </div>
                            </div>
                        </div>
                        <hr />
                        <div class="row">
                            <div class="col-lg-12">                

                                <div class="table-responsive">
                                <form action="data/updatemarks_model.php" method="post">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th class="text-center">Student ID</th>
                                                <th class="text-center">Marks</th>
                                                <!-- <th class="text-center">reapet</th> -->
                                                <th class="text-center">Max Marks</th>
                                                <th class="text-center">Marks</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $c = 1; ?>
                                            <?php  foreach($students as $row): ?>                   
                                                <tr>
                                                    <td><?php echo $c;?></td>                      
                                                    <td class="text-center" ><input type= "text" name="studentid[]" readonly class="studentid form-control" value= "<?php echo $row->studentid;?>"></td>
                                                    <td  class="text-center"><input type="number" <?php $one='1'; $readonly='readonly'; if($examstatus == $one ){ echo $readonly; } ?> name="studentmarks[]" class="studentid form-control" value= "<?php echo $row->marks; ?>" max="<?php echo $row->maxmarks; ?>"></td>
                                                    
                                                    <!-- <td  class="text-center"><input type="<?php $number='number'; $norep='text'; if($row->secmarks !== null){echo $number;}else{ echo $norep;} ?>" name="studentmarks[]" class="studentid form-control" value= "<?php $norep='no reapet'; if($row->secmarks !== null){echo $row->secmarks;}else{ echo $norep;} ?>" max="<?php echo $row->maxmarks; ?>"></td> -->
                                                    <td  class="text-center"><?php echo $row->maxmarks; ?></td>
                                                    
                                                
                                                    <td class="text-center">
                                                        <a href="#" title="delete class" data-toggle="modal" data-target="#editmarks">View</a></td>
                                                        
                                                </tr>
                                            <?php $c++; ?>
                                            <?php endforeach; ?>
                                            <?php if($students < 1): ?>
                                                <tr>
                                                    <td colspan="5" class="bg-danger text-danger text-center">*** EMPTY ***</td>
                                                </tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                    <?php $one='1'; $adminmessage ='Admin aproved the marks '; 
                                    if($examstatus == $one ){ 
                                        echo "<div class='alert alert-success'>
                                            <strong>$adminmessage!</strong>    
                                        </div>"; 
                                    }else{
                                        echo " <div class='form-group'>
                                        <input id='marksfield' style='width:200px' name='classid' required class='studentmarks form-control' value='<?php echo $classname1; ?>' type='hidden' placeholder=' <?php echo $classname1; ?>'>
                                        <input id='marksfield' style='width:200px' name='examid' required class='studentmarks form-control' value='<?php echo $examname1; ?>' type='hidden' placeholder=' <?php echo $examname1; ?>'>
                                        <input id='marksfield' style='width:200px' name='examtype' required class='studentmarks form-control' value='<?php echo $examtype1 ; ?>' type='hidden' placeholder=' <?php echo $examtype1; ?>'>
                                        <input id='marksfield' style='width:200px' name='maxmarks' required class='studentmarks form-control' value='<?php echo $maxmarks1 ; ?>' type='hidden' placeholder=' <?php echo $$maxmarks1; ?>'>
                                    <input id='submitmarks' name='submitmarks' class='btn btn-primary' value='Submit' type='submit'>
                                    </div>";
                                    } ?>
                                   
                                </form>   
                                </div>        
                            </div>
                        </div>
                        </div>
                        <!-- /.container-fluid -->
                </div>
            </div>
        </div>
    </div>
</div>
<?php include('include/footer.php'); ?>