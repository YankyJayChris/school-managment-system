<?php
    $page= 'addexam';
    include('include/header.php');
    include('include/navbar.php');
    $r="";
    $tmp = $_SESSION['id'];
    $q = "select * from teachers where teacherid='$tmp'";
    $stmt = $pdo->prepare($q);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $teacherid = $result['teacherid'];

    // $exams = array();

    $q3 = "select * from exams WHERE teacherid='$teacherid' ORDER BY id DESC";
    $stmt1 = $pdo->prepare($q3);
    $stmt1->execute();
    $exams = $stmt1->fetchall(PDO::FETCH_OBJ);
    $exams;
     

    if (isset($_POST['submitsearch'])){

        $search = $_POST['search'];
        if(!empty($search)){
            $q2 = "select * from exams where teacherid='$teacherid' course like '%$search%' or year like '%$search%' or section like '%$search%' or term like '%$search%' or subject like '%$search%' or sy like '%$search%' order by course,year,section,term,sy asc";
            $stmt = $pdo->prepare($q2);
            $stmt->execute();
            $exams = $stmt->fetchall(PDO::FETCH_OBJ);
            $exams;
        }else{
            $q = "select * from exams WHERE teacherid='$teacherid' ORDER BY id DESC";
            $stmt1 = $pdo->prepare($q);
            $stmt1->execute();
            $exams = $stmt1->fetchall(PDO::FETCH_OBJ);
            $exams;
        }
        
    }

?>

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                <div class="col-md-12">
                        <div class="card">
                            <!-- Page Heading -->
                            <div class="container-fluid">
                            <div class="row">
                                <div class="col-lg-12">
                                    <h1 class="page-header">
                                        <small>ADD EXAM</small>
                                    </h1>
                                    <ol class="breadcrumb">
                                        <li>
                                            <i class="fa fa-dashboard"></i> <a href="index.php">Dashboard</a>
                                        </li>
                                        <li class="active">
                                            Exams
                                        </li>
                                    </ol>
                                </div>
                            </div>
                            <!-- /.row -->
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-inline form-padding">
                                        <form  method="POST">
                                            <input type="text" class="form-control" name="search" placeholder="Search Class Info...">
                                            <button type="submit" name="submitsearch" class="btn btn-success"><i class="fa fa-search"></i> Search</button>                                
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addexam">Add Exam</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!--/.row -->
                            <hr />   
                            <div class="row">
                                <div class="col-lg-12">
                                    <?php if(isset($_GET['r'])): ?>
                                        <?php
                                            $r = $_GET['r'];
                                            if($r=='added'){
                                                $exma='success';   
                                            }else if($r=='updated'){
                                                $exam='info';   
                                            }else if($r=='deleted'){
                                                $exam='danger';   
                                            }else{
                                                $exam='hide';
                                            }
                                        ?>
                                        <div class="alert alert-<?php echo $exam?> <?php echo $exam; ?>">
                                            <strong>Exam info successfully <?php echo $r; ?>!</strong>    
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">#</th>
                                                    <th class="text-center">Subject</th>
                                                    <th class="text-center">Exam Name</th>
                                                    <th class="text-center">class</th>
                                                    <th class="text-center">section</th>
                                                    <th class="text-center">S.Y.</th>
                                                    <th class="text-center">Type</th>
                                                    <th class="text-center">max marks</th>
                                                    <th class="text-center">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>                         
                                                <tr>
                                                    
                                                    <?php $c = 1; ?>
                                                    <?php  foreach($exams as $row): ?>                        
                                                        <tr>
                                                            <td class="text-center"><?php echo $c;?></td>
                                                            <td class="text-center"><?php echo $row->subject;?></td>
                                                            <td class="text-center"><?php echo $row->examname;?></td>
                                                            <td class="text-center"><?php echo $row->classid;?></td>                                
                                                            <td class="text-center"><?php echo $row->section;?></td>                        
                                                            <td class="text-center"><?php echo $row->sy;?></td>
                                                            <td class="text-center"><?php echo $row->examtype;?></td>
                                                            <td class="text-center"><?php echo $row->maxmarks;?></td>
                                                            <td class="text-center">                                                                               
                                                                <a href="edit.php?type=class&id=<?php echo $row->id?>" title="update class"><i class="fa fa-edit fa-2x text-primary"></i></a>
                                                                <a href="data/data_model.php?q=delete&table=class&id=<?php echo $row->id?>" title="delete class"><i class="fa fa-times-circle fa-2x text-danger confirmation"></i></a></td>
                                                        </tr>
                                                    <?php $c++; ?>
                                                    <?php endforeach; ?>
                                                    <?php if($exams < 1): ?>
                                                        <tr>
                                                            <td colspan="9" class="bg-danger text-danger text-center">*** EMPTY ***</td>
                                                        </tr>
                                                    <?php endif; ?>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
<?php include('include/footer.php'); ?>