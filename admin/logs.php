<?php
    include('include/header.php');
    include('include/sidebar.php');
?>
<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                   <small>LOGS</small>
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-dashboard"></i> <a href="index.php">Dashboard</a>
                    </li>
                    <li class="active">
                        Logs
                    </li>
                </ol>
            </div>
        </div>
        <!-- /.row -->
        <div class="row">           
             <div class="col-lg-12">
                <div class="panel panel-green">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-clock-o fa-fw"></i> Latest Log Activity</h3>
                    </div>
                    <div class="panel-body">
                        <div class="list-group">
                            <?php $r = mysql_query("select * from log order by date desc limit 0,100");?>

                            <?php while($row = mysql_fetch_array($r)): ?>       
                            <a href="#" class="list-group-item">
                                <span class="badge"><?php echo $row['date']?></span>
                                <i class="fa fa-fw fa-tasks"></i> <?php echo $row['activity']?>
                            </a>                                   
                            <?php endwhile; ?>
                        </div>        
                    </div>
                </div>
            </div>           
        </div>
       


    </div>
    <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->    
<?php include('include/footer.php');