<?php
    include('include/header.php');
    include('include/sidebar.php');

    $tmp = $_SESSION['id'];
    $q = "select * from teacher where teachid='$tmp'";
    $r = mysql_query($q);
    $result = mysql_fetch_array($r);
    $teachid = $result[0];

    $r1 = mysql_query("select count(*) from class where teacher=$teachid");
    $count1 = mysql_fetch_array($r1);

    $r2 = mysql_query("select * from class where teacher=$teachid");
    $students = 0;
    while($row = mysql_fetch_array($r2)){
        $id = $row['id'];   
        $r3 = mysql_query("select count(*) from studentsubject where classid=$id");
        $count3 = mysql_fetch_array($r3);
        $students = $students + $count3[0];
    }

?>
<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Dashboard <small>Statistics Overview</small>
                </h1>
                <ol class="breadcrumb">
                    <li class="active">
                        <i class="fa fa-dashboard"></i> Dashboard
                    </li>
                </ol>
            </div>
        </div>
        <!-- /.row -->

        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-bar-chart-o fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge"><?php echo $count1[0];?></div>
                                <div>Subjects!</div>
                            </div>
                        </div>
                    </div>
                    <a href="subject.php">
                        <div class="panel-footer">
                            <span class="pull-left">View Details</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right fa-2x"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="panel panel-green">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-users fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge"><?php echo $students; ?></div>
                                <div>Students!</div>
                            </div>
                        </div>
                    </div>
                    <a href="student.php">
                        <div class="panel-footer">
                            <span class="pull-left">View Details</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right fa-2x"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>            
        </div>
        <!-- /.row -->
        

    </div>
    <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->    
<?php include('include/footer.php');