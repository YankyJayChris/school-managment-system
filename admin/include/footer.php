<footer class="footer">
    <div class="container-fluid">
        <nav class="pull-left">
            <ul>
                <li>
                    <a href="#">
                        Home
                    </a>
                </li>

            </ul>
        </nav>
        <p class="copyright pull-right">
            &copy; 2019 <a href="index.php">WEC</a>, Marks Recording
        </p>
    </div>
</footer>

</div>
</div>
<?php include('include/modal.php'); ?>



<!--   Core JS Files   -->
<script src="../assets/js/jquery-1.10.2.js" type="text/javascript"></script>
<script src="../assets/js/bootstrap.min.js" type="text/javascript"></script>

<!--  Checkbox, Radio & Switch Plugins -->
<script src="../assets/js/bootstrap-checkbox-radio-switch.js"></script>

<!--  Notifications Plugin    -->
<script src="../assets/js/bootstrap-notify.js"></script>



<!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
<script src="../assets/js/light-bootstrap-dashboard.js"></script>

<!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
    <!-- jQuery Version 1.11.0 -->
    <!-- <script src="../js/jquery.min.js"></script> -->
    <!-- <script src="../js/myscript.js"></script> -->
    <script>
    $(document).ready(function(){
        $('#addclassmodal').on('submit', function (e) {
            e.preventDefault();
            var subject = $('#subject_c').val();
            console.log(subject);
            $.ajax({
                url:"data/class_model.php?q=addclass"
                data: $('#addclassmodal').serialize(),
                success:fuction(data){
                    console.log(data)
                }
            });
        });
    });

</script>
</body>



</html>