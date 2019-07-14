<?php
    $page= 'dashboard';
    include('include/header.php');
    include('include/navbar.php');
    
    $tmp = $_SESSION['id'];
    $q = "select * from teachers where teacherid='$tmp'";
    $stmt = $pdo->prepare($q);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $teacherid = $result['teacherid'];

    $r = "select * from class where teacherid='$teacherid' ORDER BY id DESC";
    $stmt2 = $pdo->prepare($r);
    $stmt2->execute();
    $count1 = $stmt2->rowCount();

    $r = "select * from exams where teacherid='$teacherid' ORDER BY id DESC";
    $stmt3 = $pdo->prepare($r);
    $stmt3->execute();
    $examcount= $stmt3->rowCount();
    



?>
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="panel">
                                    <div class="panel-heading " data-color="blue">
                                        <h4 class="title panel-title">Dashbord </h4>
                                        <p class="category">statistic over view</p>
                                    </div>
                                    <div class="panel-body">
                                    <div class="row">
                                    <div class="col-lg-12 col-md-6">
                                        <div class="panel panel-primary">
                                            <div class="panel-heading">
                                                <div class="row">
                                                    <div class="col-xs-3">
                                                        <i class="fa fa-bar-chart-o fa-5x"></i>
                                                    </div>
                                                    <div class="col-xs-9 text-right">
                                                        <div class="huge"><?php echo $count1;?></div>
                                                        <div>Classes!</div>
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
                                     
                                </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                            <div class="card">
                            <div class="header">
                                <h4 class="title">EXAM</h4>

                                <p class="category">The list of exam you created, You have <?php echo $examcount?> exam </p>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-hover table-striped">
                                    <thead>
                                        <th>#</th>
                                    	<th>Name</th>
                                    	<th>class detail</th>
                                        <th>Add Marks</th>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $r = "select * from exams where teacherid='$teacherid' ORDER BY id DESC";
                                            $stmt4 = $pdo->prepare($r);
                                            $stmt4->execute();
                                            $c=1;
                                            while($row = $stmt4->fetch(PDO::FETCH_ASSOC)){
                                                    extract($row);
                                    
                                            echo "<tr><td>$c</td><td>$examname-($examtype)</td><td>$classid</td><td><a href='addmarks.php?examname=$examname&examid=$id'>Add</a></td></tr>";
                                            $c++;
                                            }
                                        ?>
                                        
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
<?php include('include/footer.php'); ?>

