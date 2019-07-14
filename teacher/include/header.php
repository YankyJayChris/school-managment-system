<?php 
    include('../config.php'); 
    $level = isset($_SESSION['level']) ? $_SESSION['level']: null;
    if($level == null){
        header('location:../index.php');
    }else if($level != 'teacher'){
        header('location:../'.$level.'');
    }
    $id = $_SESSION['id'];
    $q = "select * from teacher where teachid='$id'";
    $stmt = $pdo->prepare($q);
    $stmt->execute();
    if($row = $stmt->fetchObject()){
        $id = $row->id;   
    }
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="assets/img/favicon.ico">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>Marks Recording system</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />


    <!-- Bootstrap core CSS     -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="../assets/css/animate.min.css" rel="stylesheet"/>

    <!--  Light Bootstrap Table core CSS    -->
    <link href="../assets/css/light-bootstrap-dashboard.css" rel="stylesheet"/>

	<link href="../assets/css/my-style.css" rel="stylesheet"/>

    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="../assets/css/pe-icon-7-stroke.css" rel="stylesheet" />
    <style>
        input[readonly]{
        background-color:transparent;
        border: 0;
        font-size: 1em;
        }
    </style>

</head>
<body>

<div class="wrapper">
    <div class="sidebar" data-color="blue" >


    	<div class="sidebar-wrapper">
            <div class="logo">
                <a href="index.php" class="simple-text">
                    Marks Recording
                </a>
            </div>

			<ul class="nav">
                <li class="<?php if($page==='dashboard'){echo 'active';}?>">
                    <a href="index.php">
                        <i class="pe-7s-graph"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
				<li class="<?php if($page==='subject'){echo 'active';}?>">
					<a href="subject.php">
						<i class="pe-7s-note2"></i>
						<p>My subjects</p>
					</a>
                </li>
                <li class="<?php if($page==='student'){echo 'active';}?>">
					<a href="student.php">
						<i class="pe-7s-note2"></i>
						<p>My students</p>
					</a>
				</li>

				<li class="<?php if($page==='addexam'){echo 'active';}?>">
					<a href="addexam.php">
						<i class="pe-7s-upload"></i>
						<p>Add Exam</p>
					</a>
                </li>
                <li class="<?php if($page==='addmarks'){echo 'active';}?>">
					<a href="addmarks.php">
						<i class="pe-7s-note"></i>
						<p>Add Marks</p>
					</a>
				</li>
				<li class="<?php if($page==='setting'){echo 'active';}?>">
					<a href="setting.php">
						<i class="pe-7s-plugin"></i>
						<p>setings</p>
					</a>
				</li>


            </ul>
    	</div>
    </div>