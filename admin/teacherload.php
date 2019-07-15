<?php
    include('include/header.php');
    include('include/sidebar.php');
    include('data/teacher_model.php');
    include('data/data_model.php');
    
    $id = $_GET['id'];
    $teacher = $teacher->getteacherbyid($id);
?>
<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    <small>TEACHER'S LOAD</small>
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-dashboard"></i> <a href="index.php">Dashboard</a>
                    </li>
                    <li>
                        <a href="teacherlist.php">Teachers</a>
                    </li>
                    <li class="active">
                        Teacher's Load
                    </li>
                </ol>
            </div>
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <?php while($row = mysql_fetch_array($teacher)): ?>
                <h4>Teacher ID : <?php echo $row['teachid']; ?></h4>
                <h4>Name : <?php echo $row['fname'].' '.$row['lname']; ?></h4>
                <?php endwhile; ?>
                <hr />
                <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">Subject</th>
                            <th class="text-center">Students</th>
                            <th class="text-center">Section</th>
                            <th class="text-center">Semester</th>
                            <th class="text-center">Remove</th>
                        </tr>
                    </thead>
                    <tbody>
<?php
    $r1 = mysql_query("select * from class where teacher=$id");
    while($row = mysql_fetch_array($r1)):?>
            <tr>
                <td class="text-center"><?php echo $row['subject']?></td>            
                <td class="text-center"><a href="classstudent.php?classid=<?php echo $row['id']?>" target="_blank">View</a></td>     
                <td class="text-center"><?php echo $row['section']?></td>
                <td class="text-center"><?php echo $row['sem']?></td>
                <td class="text-center"><a href="data/teacher_model.php?q=removesubject&teachid=<?php echo $id;?>&classid=<?php echo $row['id']; ?>"><i class="fa fa-times-circle text-danger fa-2x confirmation"></i></a></td>
            </tr>
    <?php endwhile;
?>
                    </tbody>
                </table>    
            </div>
            </div>
        </div>
       


    </div>
    <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->    
<?php include('include/footer.php');