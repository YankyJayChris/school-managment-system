<?php
    include('include/header.php');
    include('include/sidebar.php');
    include('data/exam_model.php');
    
    $search = isset($_POST['search']) ? $_POST['search']: null;
    $class = $class->getclass($search);
?>
<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    <small>EXAM/TEXT INFORMATION</small>
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-dashboard"></i> <a href="index.php">Dashboard</a>
                    </li>
                    <li class="active">
                        exam/test
                    </li>
                </ol>
            </div>
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="form-inline form-padding">
                    <form action="class.php" method="post">
                        <input type="text" class="form-control" name="search" placeholder="Search Class Info...">
                        <button type="submit" name="submitsearch" class="btn btn-success"><i class="fa fa-search"></i> Search</button>                                
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addclass">Add Exam/test</button>
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
                            $classs='success';   
                        }else if($r=='updated'){
                            $classs='info';   
                        }else if($r=='deleted'){
                            $classs='danger';   
                        }else{
                            $classs='hide';
                        }
                    ?>
                    <div class="alert alert-<?php echo $classs?> <?php echo $classs; ?>">
                        <strong>Class info successfully <?php echo $r; ?>!</strong>    
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
                                <th>Exam Name</th>
                                <th>Type</th>
                                <th>Type</th>
                                <th class="text-center">Term</th>
                                <th class="text-center">academic year</th>
                                <th class="text-center">Teacher</th>
                                <th class="text-center">Students</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $c = 1; ?>
                            <?php while($row = mysql_fetch_array($class)): ?>                            
                                <tr>
                                    <td><?php echo $c;?></td>
                                    <td><?php echo $row['subject'];?></td>
                                    <td><?php echo $row['course'].' '.$row['year'].' - '.$row['section'];?></td>
                                    <td><?php echo $row['course'].' '.$row['year'].' - '.$row['section'];?></td>
                                    <td class="text-center"><?php echo $row['sem'];?></td>                                
                                    <td class="text-center"><?php echo $row['SY'];?></td>                                
                                    <td class="text-center"><a href="classteacher.php?classid=<?php echo $row['id'];?>&teacherid=<?php echo $row['teacher'];?>" title="update teacher">View</a></td>
                                    <td class="text-center"><a href="classstudent.php?classid=<?php echo $row['id'];?>" title="update students" title="add student">View</a></td>
                                    <td class="text-center">                                                                               
                                        <a href="edit.php?type=class&id=<?php echo $row['id']?>" title="update class"><i class="fa fa-edit fa-2x text-primary"></i></a>
                                        <a href="data/data_model.php?q=delete&table=class&id=<?php echo $row['id']?>" title="delete class"><i class="fa fa-times-circle fa-2x text-danger confirmation"></i></a></td>
                                </tr>
                            <?php $c++; ?>
                            <?php endwhile; ?>
                            <?php if(mysql_num_rows($class) < 1): ?>
                                <tr>
                                    <td colspan="7" class="bg-danger text-danger text-center">*** EMPTY ***</td>
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
<!-- /#page-wrapper -->    
<?php include('include/modal.php'); ?>
<?php include('include/footer.php'); ?>