<?php
    $page= 'dashboard';
    include('include/header.php');
    include('include/navbar.php');

    $r1 = 'select * from students';
    $stmt = $pdo->prepare($r1);
    $stmt->execute();
    $count1 = $stmt->rowCount();

    $r2 = 'select * from subject';
    $stmt2 = $pdo->prepare($r2);
    $stmt2->execute();
    $count2 = $stmt2->rowCount();

    $r3 = 'select * from teachers';
    $stmt3 = $pdo->prepare($r3);
    $stmt3->execute();
    $count3 = $stmt3->rowCount();

    $r4 = 'select * from userdata';
    $stmt4 = $pdo->prepare($r4);
    $stmt4->execute();
    $count4 = $stmt4->rowCount();
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
                            <div class="col-md-6">
                                <div class="panel panel-primary">
                                    <div class="panel-heading">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <i class="fa fa-bar-chart-o fa-5x"></i>
                                            </div>
                                            <div class="col-xs-9 text-right">
                                                <div class="huge"><?php echo $count2; ?></div>
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
                            <div class="col-md-6">
                                <div class="panel panel-green">
                                    <div class="panel-heading">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <i class="fa fa-users fa-5x"></i>
                                            </div>
                                            <div class="col-xs-9 text-right">
                                                <div class="huge"><?php echo $count1; ?></div>
                                                <div>Students!</div>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="studentslist.php">
                                        <div class="panel-footer">
                                            <span class="pull-left">View Details</span>
                                            <span class="pull-right"><i class="fa fa-arrow-circle-right fa-2x"></i></span>
                                            <div class="clearfix"></div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="panel panel-yellow">
                                    <div class="panel-heading">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <i class="fa fa-user fa-5x"></i>
                                            </div>
                                            <div class="col-xs-9 text-right">
                                                <div class="huge"><?php echo $count3; ?></div>
                                                <div>Teachers!</div>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="teacherlist.php">
                                        <div class="panel-footer">
                                            <span class="pull-left">View Details</span>
                                            <span class="pull-right"><i class="fa fa-arrow-circle-right fa-2x"></i></span>
                                            <div class="clearfix"></div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="panel panel-red">
                                    <div class="panel-heading">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <i class="fa fa-gear fa-5x"></i>
                                            </div>
                                            <div class="col-xs-9 text-right">
                                                <div class="huge"><?php echo $count4; ?></div>
                                                <div>Users!</div>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="users.php">
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
            </div>
        </div>
    </div>
</div>
<?php include('include/footer.php'); ?>