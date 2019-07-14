<?php
    $page= 'setting';
    include('include/header.php');
    include('include/navbar.php');
    include('data/class_model.php');

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
                                <small>EDIT</small>
                            </h1>
                            <?php 
                                $edit = new Edit();
                                $type = $_GET['type'];
                                if($type=='subject'){
                                    $edit->editsubject($subject);
                                }else if($type=='class'){
                                    $edit->editclass($class);
                                }else if($type=='student'){
                                    $edit->editstudent($student);   
                                }else if($type=='teacher'){
                                    $edit->editteacher($teacher);   
                                }
                            ?>
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
<?php include('include/footer.php'); 


class Edit {
    
    function editsubject($subject){ ?>
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-dashboard"></i> <a href="index.php">Dashboard</a>
            </li>
            <li>
                <a href="subject.php">Subject</a>
            </li>
            <li class="active">
                Edit
            </li>
        </ol>
        <hr />
        <div class="modal-body">
            <?php foreach($subject as $row): ?>
            <form action="data/data_model.php?q=updatesubject&id=<?php echo $row->id;?>" method="post">
            
                <div class="form-group">
                    <label>Code</label>
                    <input type="text" class="form-control" value="<?php echo $row->code; ?>" name="code" placeholder="subject code" />
                </div>
                <div class="form-group">
                    <label>Title</label>
                    <input type="text" class="form-control" value="<?php echo $row->title; ?>" name="title" placeholder="subject title" />
                </div>
                <div class="form-group">
                    <label>No. Of Units</label>
                    <input type="number" min="1" max="5" class="form-control" value="<?php echo $row->unit; ?>" name="unit" placeholder="no. of units" />
                </div>
        </div>
        <div class="modal-footer">
            <a href="subject.php"><button type="button" class="btn btn-default"><i class="fa fa-arrow-left"></i> Back</button></a>
            <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Update</button>
            <?php endforeach; ?>
            </form>
        </div>
        
<?php    }
    
    function editclass($class){ ?>
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-dashboard"></i> <a href="index.php">Dashboard</a>
            </li>
            <li>
                <a href="class.php">Class Info</a>
            </li>
            <li class="active">
                Edit
            </li>
        </ol>
        <hr />
        <div class="modal-body">
            <?php foreach($class as $row): ?>
            <form action="data/class_model.php?q=updateclass&id=<?php echo $row->id?>" method="post">
                <div class="form-group">  
                    <select name="subject" class="form-control" required>
                        <option value="">Select Subject...</option>
                    <?php 
                        $r = "select * from subject";
                        $stmt= $pdo->prepare($r);
                        $stmt->execute();
                        $re = $stmt->fetchall(PDO::FETCH_OBJ);
                        foreach($re as $row):
                    ?>  
                        <option <?php  if($row->subject == $re->code) echo "selected"?> value="<?php echo $re->code; ?>"><?php echo $re->code; ?> - (<?php echo $re->title; ?>)</option>
                    <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <select name="course" class="form-control" required>
                        <option value="">Select Course...</option>
                        <option <?php  if($row->course == 'BSIT') echo "selected"?>>BSIT</option>
                        <option <?php  if($row->course == 'BSCRIM') echo "selected"?>>BSCRIM</option>
                        <option <?php  if($row->course == 'BSAT') echo "selected"?>>BSAT</option>
                    </select>
                </div>
                <div class="form-group">
                    <select name="year" class="form-control" required>
                        <option value="">Select Year...</option>
                        <option <?php  if($row->year == 'I') echo "selected"?>>I</option>
                        <option <?php  if($row->year == 'II') echo "selected"?>>II</option>
                        <option <?php  if($row->year == 'III') echo "selected"?>>III</option>
                        <option <?php  if($row->year == 'IV') echo "selected"?>>IV</option>
                    </select>
                </div>
                <div class="form-group">
                    <select name="section" class="form-control" required>
                        <option value="">Select Section...</option>
                        <option <?php  if($row->section == 'A') echo "selected"?>>A</option>
                        <option <?php  if($row->section == 'B') echo "selected"?>>B</option>
                        <option <?php  if($row->section == 'C') echo "selected"?>>C</option>
                        <option <?php  if($row->section == 'D') echo "selected"?>>D</option>
                    </select>
                </div>
                <div class="form-group">
                    <select name="sem" class="form-control" required>
                        <option value="">Select Semester...</option>
                        <option <?php  if($row->sem == '1st') echo "selected"?>>1st</option>
                        <option <?php  if($row->sem == '2nd') echo "selected"?>>2nd</option>
                    </select>
                </div>
                <div class="form-group">
                    <select name="sy" class="form-control" required>
                        <option value="">Select S.Y.</option>
                        <?php $year = date('Y'); ?>
                        <?php for($c=10; $c > 0; $c--): ?>
                        <?php $sy = ($year).'-'.($year+1); ?>
                        <option <?php  if($row->SY == $sy) echo "selected"?>><?php echo $sy;?></option>
                        <?php $year--; ?>
                        <?php endfor; ?>
                    </select>
                </div>
        </div>
        <div class="modal-footer">
            <a href="class.php"><button type="button" class="btn btn-default"><i class="fa fa-arrow-left"></i> Back</button></a>
            <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Update</button>
            </form>
            <?php endforeach; ?>
        </div>
    <?php
    }
    
    function editstudent($student){ ?>
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-dashboard"></i> <a href="index.php">Dashboard</a>
            </li>
            <li>
                <a href="studentlist.php">Student's List</a>
            </li>
            <li class="active">
                Edit
            </li>
        </ol>
        <hr />
        <div class="modal-body">
            <?php foreach($student as $row): ?>
            <form action="data/student_model.php?q=updatestudent&id=<?php echo $row->id;?>" method="post">
                <div class="form-group">
                    <input type="text" class="form-control" name="studid" value="<?php echo $row->studid; ?>" />
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="fname" value="<?php echo $row->fname; ?>" />
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="lname" value="<?php echo $row->lname; ?>" />
                </div>
        </div>
        <div class="modal-footer">
            <a href="studentlist.php"><button type="button" class="btn btn-default"><i class="fa fa-arrow-left"></i> Back</button></a>
            <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Update</button>
            </form>
            </form>
            <?php endforeach; ?>
        </div>

    <?php    
    }
    
    function editteacher($teacher){ ?>
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-dashboard"></i> <a href="index.php">Dashboard</a>
            </li>
            <li>
                <a href="studentlist.php">Teacher's List</a>
            </li>
            <li class="active">
                Edit
            </li>
        </ol>
        <hr />
        <div class="modal-body">
            <?php foreach($teacher as $row): ?>
            <form action="data/teacher_model.php?q=updateteacher&id=<?php echo $row->id;?>" method="post">
                <div class="form-group">
                    <input type="text" class="form-control" name="teachid" value="<?php echo $row->teachid; ?>" />
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="fname" value="<?php echo $row->fname; ?>" />
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="lname" value="<?php echo $row->lname; ?>" />
                </div>
        </div>
        <div class="modal-footer">
            <a href="teacherlist.php"><button type="button" class="btn btn-default"><i class="fa fa-arrow-left"></i> Back</button></a>
            <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Update</button>
            </form>
            <?php endforeach; ?>
        </div>

    <?php    
    }
}

?>