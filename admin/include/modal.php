<!-- add modal for subject -->
<div class="modal fade" id="addsubject" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
        <div class="modal-header">
            <h3>Add Subject</h3>
        </div>
        <div class="modal-body">
            <form action="data/data_model.php?q=addsubject" method="post">
                <div class="form-group">
                    <input type="text" class="form-control" name="code" placeholder="subject code" />
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="title" placeholder="subject title" />
                </div>
                <div class="form-group">
                    <input type="number" min="1" max="5" class="form-control" name="unit" placeholder='no. of units' required />
                </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Add</button>
            </form>
        </div>
    </div>
  </div>
</div>

<!-- add modal for class info -->
<div class="modal fade" id="addclass" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
        <div class="modal-header">
            <h3>Add Class Info</h3>
        </div>
        <div class="modal-body">
            <form id= "addclassmodal" action="data/class_model.php" method="POST">
            <div class="form-group">  
                    <select id="subject_c" name="subject" class="form-control" required>
                        <option value="">Select Subject...</option>
                        <?php 
                        $r = "select * from subject";
                        $stmt = $pdo->prepare($r);
                        $stmt->execute();
                        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                                extract($row);
                   
                        echo "<option value='$code'>$code- ($title)</option>";}
                    ?>
                    </select>
                    
                    </select>
                </div>
                <div class="form-group">
                    <select id="course_c" name="course" class="form-control" required>
                        <option value="">Select Course...</option>
                        <?php 
                            include('../../config.php');
                            $r = "select * from courses";
                            $stmt = $pdo->prepare($r);
                            $stmt->execute();
                            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                                extract($row);
                                echo $course;
                                echo $title;
                            echo "<option value='$course'>$course - ($title)</option>";
                        }
                        ?>

                    </select>
                </div>
                <div class="form-group">
                    <select id="year_c" name="year" class="form-control" required>
                        <option value="">Select Year...</option>
                        <option value="I">I</option>
                        <option value="II">II</option>
                        <option value="III">III</option>
                        <option value="IV">IV</option>
                    </select>
                </div>
                <div class="form-group">
                    <select id="section_c" name="section" class="form-control" required>
                        <option value="">Select Section...</option>
                        <?php 
                            $r = "select * from section";
                            $stmt = $pdo->prepare($r);
                            $stmt->execute();
                            
                            while($row = $stmt->fetch(PDO::FETCH_ASSOC)):
                        ?>
                            <option value="<?php echo $row['shortname']; ?>"><?php echo $row['sectionname']; ?> - (<?php echo $row['shortname']; ?>)</option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div class="form-group">  
                    <select id="Teacher_c" name="teacherid" class="form-control" required>
                        <option value="">Select Teacher...</option>
                        <?php 
                        $r = "select * from teachers";
                        $stmt = $pdo->prepare($r);
                        $stmt->execute();
                        while($row = $stmt->fetch(PDO::FETCH_ASSOC)):
                    ?>
                        <option value="<?php echo $row['teacherid']; ?>"><?php echo $row['teacherid']; ?> - (<?php echo $row['fname'].''.$row['lname']; ?>)</option>
                    <?php endwhile; ?>
                    </select>
                    
                    </select>
                </div>
                <div class="form-group">
                    <select id="term_c" name="term" class="form-control" required>
                        <option value="">Select Term...</option>
                        <option value="1">1st</option>
                        <option value="2">2nd</option>
                        <option value="3">3nd</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <select id="sy_c" name="sy" class="form-control" required>
                        <option value="">Select S.Y.</option>
                        <?php $year = date('Y'); ?>
                        <?php for($c=5; $c > 0; $c--): ?>
                        <option><?php echo $year; ?>-<?php echo $year+1?></option>
                        <?php $year--; ?>
                        <?php endfor; ?>
                    </select>
                </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button id="submit_c" type="submit" name="addclass" class="btn btn-primary"><i class="fa fa-plus"></i> Add</button>
        </form>
        </div>
    </div>
  </div>
</div>

<!-- add modal for student -->
<div class="modal fade" id="addstudent" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
        <div class="modal-header">
            <h3><i class="fa fa-user"></i> Add Student</h3>
        </div>
        <div class="modal-body">
            <form action="data/student_model.php" method="post">
                <div class="form-group">
                    <input type="text" class="form-control" name="studid" placeholder="student ID" />
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="fname" placeholder="firstname" />
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="lname" placeholder="lastname" />
                </div>
                <div class="form-group">
                <div class="form-group">
                    <select id="sy_s" name="sy_s" class="form-control" required>
                        <option value="">Select School Year</option>
                        <?php $year = date('Y'); ?>
                        <?php for($c=10; $c > 0; $c--): ?>
                        <option><?php echo $year; ?>-<?php echo $year+1?></option>
                        <?php $year--; ?>
                        <?php endfor; ?>
                    </select>
                </div>
                <div class="form-group">
                    <select id="year_s" name="year_s" class="form-control" required>
                        <option value="">Select Year...</option>
                        <option value="I">I</option>
                        <option value="II">II</option>
                        <option value="III">III</option>
                        <option value="IV">IV</option>
                    </select>
                </div>
                <div class="form-group">
                    <select id="section_s" name="section_s" class="form-control" required>
                        <option value="">Select Section...</option>
                        <?php 
                            $r2 = "select * from section";
                            $stmt2 = $pdo->prepare($r2);
                            $stmt2->execute();
                            
                            while($row = $stmt2->fetch(PDO::FETCH_ASSOC)):
                        ?>
                            <option value="<?php echo $row['shortname']; ?>"><?php echo $row['sectionname']; ?> - (<?php echo $row['shortname']; ?>)</option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <select id="course_c" name="course" class="form-control" required>
                        <option value="">Select Course...</option>
                        <?php 
                            include('../../config.php');
                            $r = "select * from courses";
                            $stmt = $pdo->prepare($r);
                            $stmt->execute();
                            
                         while($row = $stmt->fetch(PDO::FETCH_ASSOC)):
                    ?>
                        <option value="<?php echo $row['course']; ?>"><?php echo $row['course']; ?> - (<?php echo $row['title']; ?>)</option>
                    <?php endwhile; ?>

                    </select>
                </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Add</button>
            </form>
        </div>
    </div>
  </div>
</div>

<!-- add modal for teacher -->
<div class="modal fade" id="addteacher" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
        <div class="modal-header">
            <h3><i class="fa fa-user"></i> Add Teacher</h3>
        </div>
        <div class="modal-body">
            <form action="data/teacher_model.php" method="post">
                <div class="form-group">
                    <input type="text" class="form-control" name="teachid" placeholder="teacher ID" />
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="fname" placeholder="firstname" />
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="lname" placeholder="lastname" />
                </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Add</button>
            </form>
        </div>
    </div>
  </div>
</div>