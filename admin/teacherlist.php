<?php
    include('include/header.php');
    include('include/sidebar.php');
    include('data/teacher_model.php');
    
    $search = isset($_POST['search']) ? $_POST['search']: null;
    $teacher = $teacher->getteacher($search);
?>
<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    <small>TEACHER'S LIST</small>
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-dashboard"></i> <a href="index.php">Dashboard</a>
                    </li>
                    <li class="active">
                        Teacher's List
                    </li>
                </ol>
            </div>
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="form-inline form-padding">
                    <form action="teacherlist.php" method="post">
                        <input type="text" class="form-control" name="search" placeholder="Search Teachers...">
                        <button type="submit" name="submitsearch" class="btn btn-success"><i class="fa fa-search"></i> Search</button>                                
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addteacher"><i class="fa fa-user"></i> Add Teacher</button>
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
                        }else{
                            $class='hide';
                        }
                    ?>
                    <div class="alert alert-<?php echo $class?> <?php echo $classs; ?>">
                        <strong>1 teacher successfully <?php echo $r; ?>!</strong>    
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
                                <th>Teacher ID</th>
                                <th>Firstname</th>
                                <th>Lastname</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $c = 1; ?>
                            <?php while($row = mysql_fetch_array($teacher)): ?>                            
                                <tr>
                                    <td><?php echo $c;?></td>
                                    <td><a href="edit.php?type=teacher&id=<?php echo $row['id']?>"><?php echo $row['teachid'];?></a></td>
                                    <td><?php echo $row['fname'];?></td>
                                    <td><?php echo $row['lname'];?></td>
                                    <td class="text-center">
                                        <a href="data/settings_model.php?q=addaccount&level=teacher&id=<?php echo $row['id']?>" class="confirmacc"><i class="fa fa-key fa-2x text-warning"></i></a>&nbsp;
                                        <a href="teacherload.php?id=<?php echo $row['id'];?>" title="Update Subject"><i class="fa fa-bar-chart-o fa-2x text-success"></i></a> &nbsp;
                                        <a href="data/data_model.php?q=delete&table=teacher&id=<?php echo $row['id']?>" title="Remove"><i class="fa fa-times-circle fa-2x text-danger confirmation"></i></a></td>
                                </tr>
                            <?php $c++; ?>
                            <?php endwhile; ?>
                            <?php if(mysql_num_rows($teacher) < 1): ?>
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
<!-- /#page-wrapper -->    
<?php include('include/modal.php'); ?>
<?php include('include/footer.php'); ?>