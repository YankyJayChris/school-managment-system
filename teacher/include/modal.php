<!-- add modal for exam info -->
<div class="modal fade" id="addexam" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
        <div class="modal-header">
            <h3>Add Exam Info</h3>
        </div>

        <div class="modal-body">
            <form action="data/addexam_model.php" method="post" >
                <div class="form-group">
                    <select name="class" class="form-control" required>
                        <option value="">Select Class...</option>
                        <?php 
                        $tmp = $_SESSION['id'];
                        $q = "select * from teachers where teacherid='$tmp'";
                        $stmt = $pdo->prepare($q);
                        $stmt->execute();
                        $result = $stmt->fetch(PDO::FETCH_ASSOC);
                        $teacherid = $result['teacherid'];
                            
                        $r = "select * from class where teacherid='$teacherid' ORDER BY id DESC";
                        $stmt = $pdo->prepare($r);
                        $stmt->execute();
                        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                                extract($row);
                   
                        echo "<option value='$classid'>$classid</option>";}
                    ?>
                    </select>
                </div>
                <div class="form-group">
                    <select name="type" class="form-control" required>
                        <option value="">Select Exam type...</option>
                        <option>Exam</option>
                        <option>Quiz</option>
                        <option>Assignement</option>
                    </select>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="examname" placeholder="Exam name">
                </div>
                <div class="form-group">
                    <input type="number" class="form-control" name="maxmarks" placeholder="Max Marks" min="0">
                </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Add Exam</button>
        </div>
        </form>
    </div>
  </div>
</div>

<!-- add modal for EDIT STUDENT MARKS  -->
<div class="modal fade" id="editmarks" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
        <div class="modal-header">
            <h3>Add Exam Info</h3>
        </div>

        <div class="modal-body">
            <form action="data/editmarks_model.php" method="post" >
                
                <div class="form-group">
                    <input type="text" class="form-control" required name="studentid" placeholder="Student ID">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="marks" placeholder="Marks">
                </div>
                <div class="form-group">
                    <input type="number" class="form-control" name="reapetmarks" placeholder="reapet Marks" min="0">
                </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Add Exam</button>
        </div>
        </form>
    </div>
  </div>
</div>