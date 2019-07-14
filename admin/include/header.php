<?php 
    include('../config.php'); 
    $level = isset($_SESSION['level']) ? $_SESSION['level']: null;
    if($level == null){
        header('location:../index.php');
    }else if($level != 'admin'){
        header('location:../'.$level.'');
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
	<!-- Custom Fonts -->
    <link href="../assets/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="../assets/css/pe-icon-7-stroke.css" rel="stylesheet" />

</head>
<body>

<div class="wrapper">
    <div class="sidebar" data-color="blue">


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
				<li class="<?php if($page==='classinfo'){echo 'active';}?>">
					<a href="class.php">
						<i class="pe-7s-note2"></i>
						<p>Classinfo</p>
					</a>
                </li>
				<li class="<?php if($page==='subject'){echo 'active';}?>">
					<a href="subject.php">
						<i class="pe-7s-note2"></i>
						<p>Subjects</p>
					</a>
                </li>
				<li class="<?php if($page==='teachers'){echo 'active';}?>">
					<a href="teacherslist.php">
						<i class="pe-7s-note2"></i>
						<p>Teachers</p>
					</a>
				</li>
                <li class="<?php if($page==='students'){echo 'active';}?>">
					<a href="studentslist.php">
						<i class="pe-7s-note2"></i>
						<p>Students</p>
					</a>
				</li>

				<li class="<?php if($page==='addedmarks'){echo 'active';}?>">
					<a href="addedmarks.php">
						<i class="pe-7s-upload"></i>
						<p>Added Marks</p>
					</a>
                </li>
                <li class="<?php if($page==='users'){echo 'active';}?>">
					<a href="users.php">
						<i class="pe-7s-note"></i>
						<p>Users</p>
					</a>
				</li>
				<li class="<?php if($page==='setting'){echo 'active';}?>">
					<a href="settings.php">
						<i class="pe-7s-plugin"></i>
						<p>setings</p>
					</a>
				</li>
				<li>
					<a href="javascript:;" data-toggle="collapse" data-target="#setting"><i class="fa fa-fw fa-gear"></i> Settings <i class="fa fa-fw fa-caret-down"></i></a>
					<ul id="setting" class="collapse">
						<li>
							<a href="settings.php">Change Password</a>
						</li>
						<li>
							<a href="users.php">Users</a>
						</li>
					</ul>
				</li>


            </ul>
    	</div>
    </div>