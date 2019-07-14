<?php
    $page= 'classinfo';
    
    include('include/header.php');
    include('include/navbar.php');
    $rr="";
    $q = "select * from class order by course,year,section,term,sy asc";
    $stmt = $pdo->prepare($q);
    $stmt->execute();
    $class = $stmt->fetchall(PDO::FETCH_OBJ);
    $class;

    if (isset($_POST['submitsearch'])){
        $search = $_POST['search'];
        $q = "select * from class where course like '%$search%' or year like '%$search%' or section like '%$search%' or term like '%$search%' or subject like '%$search%' or sy like '%$search%' order by course,year,section,term,sy asc";
        $stmt = $pdo->prepare($q);
        $stmt->execute();
        $class = $stmt->fetchall(PDO::FETCH_OBJ);
        $class;
    }

                                 

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
                                    <small>CLASS INFORMATION</small>
                                </h1>
                                <ol class="breadcrumb">
                                    <li>
                                        <i class="fa fa-dashboard"></i> <a href="index.php">Dashboard</a>
                                    </li>
                                    <li class="active">
                                        Class
                                    </li>
                                </ol>
                            </div>
                        </div>
                        <!-- /.row -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-inline form-padding">
                                    <form action="class.php" method="post">
                                        <input type="text" class="form-control" name="search" placeholder="Search Class Info...">
                                        <button type="submit" name="submitsearch" class="btn btn-success"><i class="fa fa-search"></i> Search</button>                                
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addclass">Add Class</button>
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
                                        $rr = $_GET['r'];
                                        if($rr=='added'){
                                            $classs='success';   
                                        }else if($rr=='updated'){
                                            $classs='info';   
                                        }else if($rr=='deleted'){
                                            $classs='danger';   
                                        }else{
                                            $classs='hide';
                                        }
                                    ?>
                                    <div class="alert alert-<?php echo $classs?> <?php echo $classs; ?>">
                                        <strong>Class info successfully <?php echo $rr; ?>!</strong>    
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
                                                <th class="text-center">#</th>
                                                <th class="text-center">Subject</th>
                                                <th class="text-center">Class Name</th>
                                                <th class="text-center">Term</th>
                                                <th class="text-center">S.Y.</th>
                                                <th class="text-center">Teacher</th>
                                                <th class="text-center">Students</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        
                                        <?php $c = 1; ?>
                                                <?php  foreach($class as $row): ?>                        
                                                    <tr>
                                                        <td><?php echo $c;?></td>
                                                        <td><?php echo $row->subject;?></td>
                                                        <td><?php echo $row->course.' '.$row->year.' - '.$row->section;?></td>
                                                        <td class="text-center"><?php echo $row->term;?></td>                                
                                                        <td class="text-center"><?php echo $row->sy;?></td>                        
                                                        <td class="text-center"><a href="classteacher.php?classid=<?php echo $row->id;?>&teacherid=<?php echo $row->teacherid;?>" title="update teacher">View</a></td>
                                                        <td class="text-center"><a href="classstudent.php?classid=<?php echo $row->id;?>" title="update students" title="add student">View</a></td>
                                                        <td class="text-center">                                                                               
                                                            <a href="edit.php?type=class&id=<?php echo $row->id?>" title="update class"><i class="fa fa-edit fa-2x text-primary"></i></a>
                                                            <a href="data/data_model.php?q=delete&table=class&id=<?php echo $row->id?>" title="delete class"><i class="fa fa-times-circle fa-2x text-danger confirmation"></i></a></td>
                                                    </tr>
                                                <?php $c++; ?>
                                                <?php endforeach; ?>
                                                <?php if($class < 1): ?>
                                                    <tr>
                                                        <td colspan="7" class="bg-danger text-danger text-center">*** EMPTY ***</td>
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
            </div>
        </div>
    </div>
</div>
<!-- <script>
    $(document).ready(function(){
        $('#addclassmodal').on('submit', function (e) {
            e.preventDefault();
            $.ajax({
                url:"data/class_model.php?q=addclass"
                data: $('#addclassmodal').serialize(),
                success:fuction(data){
                    console.log(data)
                }
            });
        });
    });

</script> -->
<?php include('include/footer.php'); ?>