<?php
    $page= 'addedmarks';
    include('include/header.php');
    include('include/navbar.php');

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
                                    Added Marks <small>Exams Which has marks</small>
                                </h1>
                                <ol class="breadcrumb">
                                    <li>
                                        <i class="fa fa-dashboard"></i> <a href="index.php">Dashboard</a>
                                    </li>
                                    <li class="active">
                                        Added Marks
                                    </li>
                                </ol>
                            </div>
                        </div>
                        <!-- /.row -->
                        <div class="row">
                            <div class="col-lg-12">
                                <?php if(isset($_GET['r']) && $_GET['r']=='deleted'): ?>
                                    <div class="alert alert-danger">
                                        <strong>marks successfully Aproved!</strong>
                                    </div>
                                <?php endif; ?>
                                <div class="form-inline form-padding">
                                    <form action="users.php" method="post">
                                        <input type="text" class="form-control" name="search" placeholder="Search by username">
                                        <button type="submit" name="submitsearch" class="btn btn-success"><i class="fa fa-search"></i> Search</button>                                                                 
                                    </form>
                                </div>
                            </div>
                        </div>
                        <hr />
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered">
                                        <thead><tr>
                                            <th>#</th>
                                            <th>Exam Name</th>    
                                            <th>Class</th>    
                                            <th>Teacher ID</th>    
                                            <th>student</th>
                                            <th>Aprove</th>    
                                        </tr></thead>
                                        <tbody>

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