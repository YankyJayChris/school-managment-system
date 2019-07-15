<?php
    include('include/header.php');
    include('include/sidebar.php');
    include('data/teacher_model.php');
    $search = isset($_POST['search']) ? $_POST['search']: null;
    $teacher = $teacher->getteacher($search);
    $classid = $_GET['classid'];

    $teacherid = $_GET['teacherid'];
    $rt = mysql_query("select * from teacher where id=$teacherid");
    $rs = mysql_fetch_array($rt);
    $teacherbyid = $rs['fname'].' '.$rs['lname'];
    
    $rc = mysql_query("select * from class where id=$classid");
    $rc = mysql_fetch_array($rc);
    $subject = $rc['subject'];
    
    
?>
<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    <small>CLASS TEACHER</small>
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-dashboard"></i> <a href="index.php">Dashboard</a>
                    </li>
                    <li>
                        <a href="class.php">Class Info</a>
                    </li>
                    <li class="active">
                        Class Teacher
                    </li>
                </ol>
            </div>
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="form-inline form-padding">
                    <form action="classteacher.php?classid=<?php echo $classid;?>&teacherid=<?php echo $teacherid; ?>" method="post">
                        <input type="text" class="form-control" name="search" placeholder="Search by ID # or Name..." required autofocus>
                        <button type="submit" name="submitsearch" class="btn btn-success"><i class="fa fa-search"></i> Search</button>                         
                    </form>
                </div>
            </div>
        </div>
        <hr />
        <div class="row">
            <div class="col-lg-12">
                <div class="alert alert-info">
                    <table>
                        <tr>
                            <td width="100"><strong>SUBJECT</strong></td>                            
                            <td><?php echo $subject; ?></td>
                        </tr>
                        <tr>
                            <td width="100"><strong>TEACHER</strong></td>                            
                            <td><?php echo $teacherbyid; ?></td>
                        </tr>
                    </table>     
                </div>
                <div class="table-responsive">     
                <?php if($search): ?>
                    
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Teacher ID</th>
                                    <th>Firstname</th>
                                    <th>Lastname</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while($row = mysql_fetch_array($teacher)): ?>
                                <tr>
                                    <td><?php echo $row['teachid']; ?></td>
                                    <td><?php echo $row['fname']; ?></td>
                                    <td><?php echo $row['lname']; ?></td>
                                    <td class="text-center"><a href="data/class_model.php?q=updateteacher&teachid=<?php echo $row['id']; ?>&classid=<?php echo $classid;?>" class="btn btn-warning">Make as Teacher</a></td>     
                                </tr>
                                <?php endwhile;?>
                                <?php if(mysql_num_rows($teacher) < 1): ?>
                                    <tr>
                                        <td colspan="4" class="text-center text-danger"><strong>*** NO RESULT ***</strong></td>
                                    </tr>
                                <?php endif;?>
                            </tbody>
                        </table>
                   
                <?php endif; ?>
                    </div>                
            </div>
        </div>


    </div>
    <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->    
<?php include('include/footer.php');