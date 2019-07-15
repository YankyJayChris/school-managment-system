<?php
    include('include/header.php');
    include('include/sidebar.php');
    $username = isset($_GET['username']) ? $_GET['username'] : $_SESSION['id'];
?>
<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Settings <small>Change Password</small>
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-dashboard"></i> <a href="index.php">Dashboard</a>
                    </li>
                    <li class="active">
                        Change Password
                    </li>
                </ol>
            </div>
        </div>
        <!-- /.row -->
         <div class="row">
            <div class="col-lg-12">
                <?php if(isset($_GET['msg'])): ?>
                    <?php if($_GET['msg']=='success'){
                            echo '
                                <div class="alert alert-success">
                                    <strong>Password Changed!</strong>
                                </div>
                            ';
                        }else{
                             echo '
                                <div class="alert alert-danger">
                                    <strong>Password incorrect. Please try again!</strong>
                                </div>
                            ';
                        }
                        
                    ?>
                <?php endif;?>
                <form action="data/settings_model.php?q=changepassword&username=<?php echo $username;?>" method="post">
                    <div class="form-group">
                        <label>Current Password</label>
                        <input type="password" name="current" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>New Password</label>
                        <input type="password" name="new" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Confirm Password</label>
                        <input type="password" name="confirm" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-success btn-lg" name="submit">Update Password</button>
                </form>  
             </div>
        </div>
       


    </div>
    <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->    
<?php include('include/footer.php');