<?php
    $page= 'subject';
    include('include/header.php');
    include('include/navbar.php');

    $tmp = $_SESSION['id'];
    $q = "select * from teachers where teacherid='$tmp'";
    $stmt = $pdo->prepare($q);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $teacherid = $result['teacherid'];

    $r = "select * from class where teacherid='$teacherid' and term='1' ORDER BY id DESC";
    $stmt1 = $pdo->prepare($r);
    $stmt1->execute();
    $term1 = $stmt1->fetchall(PDO::FETCH_OBJ);

    $r = "select * from class where teacherid='$teacherid' and term='2' ORDER BY id DESC";
    $stmt2 = $pdo->prepare($r);
    $stmt2->execute();
    $term2 = $stmt2->fetchall(PDO::FETCH_OBJ);

    $r = "select * from class where teacherid='$teacherid' and term='3' ORDER BY id DESC";
    $stmt3 = $pdo->prepare($r);
    $stmt3->execute();
    $term3 = $stmt3->fetchall(PDO::FETCH_OBJ);

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
                                    <small>MY SUBJECTS</small>
                                </h1>
                                <ol class="breadcrumb">
                                    <li>
                                        <i class="fa fa-dashboard"></i> <a href="index.php">Dashboard</a>
                                    </li>
                                    <li class="active">
                                        My Subjects
                                    </li>
                                </ol>
                            </div>
                        </div>
                        <!-- /.row -->
                        <div class="row">
                            <div class="col-lg-12">
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="active"><a href="#data1" role="tab" data-toggle="tab">First term</a></li>
                                    <li><a href="#data2" role="tab" data-toggle="tab">Second term</a></li>
                                    <li><a href="#data3" role="tab" data-toggle="tab">third term</a></li>
                                </ul>

                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <div class="tab-pane active" id="data1">
                                        <br />
                                        <div class="table-responsive">
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th class="text-center">Subject</th>
                                                        <th class="text-center">Course</th>
                                                        <th class="text-center">Year</th>
                                                        <th class="text-center">Academic Year</th>
                                                        <th class="text-center">Section</th>
                                                        <th class="text-center">Students</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <?php $c = 1; ?>
                                                <?php  foreach($term1 as $row): ?>                       
                                                    <tr>
                                                        <td class="text-center"><?php echo $c;?></td>
                                                        <td class="text-center"><?php echo $row->subject;?></td>
                                                        <td class="text-center"><?php echo $row->course;?></td>
                                                        <td class="text-center"><?php echo $row->year;?></td>                                
                                                        <td class="text-center"><?php echo $row->sy;?></td>                        
                                                        <!-- <td class="text-center"><?php echo $row->sy;?></td> -->
                                                        <td class="text-center"><?php echo $row->section;?></td>
                                                        <td class="text-center"><a href='student.php?classname=<?php echo $row->classid;?>'>view</a></td>
                                
                                                <?php $c++; ?>
                                                <?php endforeach; ?>
                                                <?php if($term1 < 1): ?>
                                                    <tr>
                                                    <tr><td colspan="7" class="text-center text-danger"><strong>*** EMPTY ***</strong></td></tr>
                                                    </tr>
                                                <?php endif; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="data2">
                                        <br />
                                        <div class="table-responsive">
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th class="text-center">Subject</th>
                                                        <th class="text-center">Course</th>
                                                        <th class="text-center">Year</th>
                                                        <th class="text-center">Academic Year</th>
                                                        <th class="text-center">Section</th>
                                                        <th class="text-center">Students</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                               
                                                
                                                <?php $c = 1; ?>
                                                <?php  foreach($term2 as $row): ?>                       
                                                    <tr>
                                                        <td><?php echo $c;?></td>
                                                        <td><?php echo $row->subject;?></td>
                                                        <td><?php echo $row->course;?></td>
                                                        <td class="text-center"><?php echo $row->year;?></td>                                
                                                        <td class="text-center"><?php echo $row->sy;?></td>                        
                                                        <!-- <td class="text-center"><?php echo $row->sy;?></td> -->
                                                        <td class="text-center"><?php echo $row->section;?></td>
                                                        <td class="text-center"><a href='student.php?classname=<?php echo $row->classid;?>'>view</a></td>
                                
                                                <?php $c++; ?>
                                                <?php endforeach; ?>
                                                <?php if($term2 < 1): ?>
                                                    <tr>
                                                    <tr><td colspan="7" class="text-center text-danger"><strong>*** EMPTY ***</strong></td></tr>
                                                    </tr>
                                                <?php endif; ?>       
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="data3">
                                        <br />
                                        <div class="table-responsive">
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th class="text-center">Subject</th>
                                                        <th class="text-center">Course</th>
                                                        <th class="text-center">Year</th>
                                                        <th class="text-center">Academic Year</th>
                                                        <th class="text-center">Section</th>
                                                        <th class="text-center">Students</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <?php $c = 1; ?>
                                                <?php  foreach($term3 as $row): ?>                       
                                                    <tr>
                                                        <td><?php echo $c;?></td>
                                                        <td><?php echo $row->subject;?></td>
                                                        <td><?php echo $row->course;?></td>
                                                        <td class="text-center"><?php echo $row->year;?></td>                                
                                                        <td class="text-center"><?php echo $row->sy;?></td>                        
                                                        <!-- <td class="text-center"><?php echo $row->sy;?></td> -->
                                                        <td class="text-center"><?php echo $row->section;?></td>
                                                        <td class="text-center"><a href='student.php?classname=<?php echo $row->classid;?>'>view</a></td>
                                
                                                <?php $c++; ?>
                                                <?php endforeach; ?>
                                                <?php if($term3 < 1): ?>
                                                    <tr>
                                                    <tr><td colspan="7" class="text-center text-danger"><strong>*** EMPTY ***</strong></td></tr>
                                                    </tr>
                                                <?php endif; ?>       
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>   
                            </div>
                        </div>
                        <!-- /.row -->



                        </div>
                        <!-- /.container-fluid -->

                </div>
            </div>
        </div>
    </div>
</div>
<?php include('include/footer.php'); ?>