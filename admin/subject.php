<?php
    include('include/header.php');
    include('include/sidebar.php');
    include('data/data_model.php');
    
    $search = isset($_POST['search']) ? $_POST['search']: null;
    $subject = $data->getsubject($search);
?>
<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    <small>SUBJECT</small>
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-dashboard"></i> <a href="index.php">Dashboard</a>
                    </li>
                    <li class="active">
                        Subject
                    </li>
                </ol>
            </div>
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="form-inline form-padding">
                    <form action="subject.php" method="post">
                        <input type="text" class="form-control" name="search" placeholder="Search Subject...">
                        <button type="submit" name="submitsearch" class="btn btn-success"><i class="fa fa-search"></i> Search</button>                                
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addsubject">Add Subject</button>
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
                        }else{
                            $class='hide';
                        }
                    ?>
                    <div class="alert alert-<?php echo $class?> <?php echo $class; ?>">
                        <strong>Subject successfully <?php echo $r; ?>!</strong>    
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
                                <th>Subject Code</th>
                                <th>Subject Title</th>
                                <th class="text-center">Units</th>
                                <th class="text-center">Remove</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $c = 1; ?>
                            <?php while($row = mysql_fetch_array($subject)): ?>                            
                                <tr>
                                    <td><?php echo $c;?></td>
                                    <td><a href="edit.php?type=subject&id=<?php echo $row['id']?>"><?php echo $row['code'];?></a></td>
                                    <td><?php echo $row['title'];?></td>
                                    <td class="text-center"><?php echo $row['unit'];?></td>
                                    <td class="text-center"><a href="data/data_model.php?q=delete&table=subject&id=<?php echo $row['id']?>"><i class="fa fa-times-circle fa-lg text-danger confirmation"></i></a></td>
                                </tr>
                            <?php $c++; ?>
                            <?php endwhile; ?>
                            <?php if(mysql_num_rows($subject) < 1): ?>
                                <tr>
                                    <td colspan="4" class="bg-danger text-danger text-center">*** EMPTY ***</td>
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