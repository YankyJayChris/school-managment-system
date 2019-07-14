<?php
    $page= 'students';
    include('include/header.php');
    include('include/navbar.php');
    $q = "select * from students order by lname,fname,studentid";
    $stmt = $pdo->prepare($q);
    $stmt->execute();
    $student = $stmt->fetchall(PDO::FETCH_OBJ);
    

    if (isset($_POST['submitsearch'])){
        $search = $_POST['search'];
        $q = "select * from students where studid like '%$search%' or fname like '%$search%' or lname like '%$search%' order by lname,fname,studid";
        $stmt = $pdo->prepare($q);
        $stmt->execute();
        $student = $stmt->fetchall(PDO::FETCH_OBJ);
    }
    $r="";

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
                                    <small>STUDENT'S LIST</small>
                                </h1>
                                <ol class="breadcrumb">
                                    <li>
                                        <i class="fa fa-dashboard"></i> <a href="index.php">Dashboard</a>
                                    </li>
                                    <li class="active">
                                        Student's List
                                    </li>
                                </ol>
                            </div>
                        </div>
                        <!-- /.row -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-inline form-padding">
                                    <form action="studentlist.php" method="post">
                                        <input type="text" class="form-control" name="search" placeholder="Search Students...">
                                        <button type="submit" name="submitsearch" class="btn btn-success"><i class="fa fa-search"></i> Search</button>                                          
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addstudent"><i class="fa fa-user"></i> Add Student</button>
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
                                            $class='success';   
                                        }else if($r=='updated'){
                                            $class='info';   
                                        }else if($r=='deleted'){
                                            $class='danger';   
                                        }else if($r=='added an account'){
                                            $class='success';   
                                        }else if($r=='has already an account'){
                                            $class='info';   
                                        }else{
                                            $class='hide';
                                        }
                                    ?>
                                    <div class="alert alert-<?php echo $class?> <?php echo $classs; ?>">
                                        <strong>1 student successfully <?php echo $r; ?>!</strong>    
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
                                                <th>#</th>
                                                <th>Student ID</th>
                                                <th>Firstname</th>
                                                <th>Lastname</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php $c = 1; ?>
                                        <?php foreach($student as $row): ?>                            
                                            <tr>
                                                <td><?php echo $c;?></td>
                                                <td><a href="edit.php?type=student&id=<?php echo $row->id?>"><?php echo $row->studentid;?></a></td>
                                                <td><?php echo $row->fname;?></td>
                                                <td><?php echo $row->lname;?></td>
                                                <td class="text-center">
                                                    <a href="data/settings_model.php?q=addaccount&level=student&id=<?php echo $row->id?>" class="confirmacc"><i class="fa fa-key fa-2x text-warning"></i></a>
                                                    <a href="studentsubject.php?id=<?php echo $row->id;?>" title="Update Subject"><i class="fa fa-bar-chart-o fa-2x text-success"></i></a> &nbsp;
                                                    <a href="data/data_model.php?q=delete&table=student&id=<?php echo $row->id?>" title="Remove"><i class="fa fa-times-circle fa-2x text-danger confirmation"></i></a></td>
                                            </tr>
                                        <?php $c++; ?>
                                        <?php endforeach; ?>
                                        <?php if($student < 1): ?>
                                            <tr>
                                                <td colspan="5" class="bg-danger text-danger text-center">*** EMPTY ***</td>
                                            </tr>
                                        <?php endif; ?>
                                        </tbody>
                                    </table>
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