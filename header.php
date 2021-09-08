<?php require_once('config.php'); ?>

<!-- 360 = 6 Minutes * 60 second -->
<?php 
    ob_start();
    session_start();
    if(isset($_SESSION['logged_emp'])){
        if((time() - $_SESSION['last_login_timestamp']) > 600){
            header('location: logout.php');
        }
        else{
            $_SESSION['last_login_timestamp'] = time();
        }
    }
    else{
        header('location: login.php');
    }
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Friends It Point | Dashboard</title>
    <meta name="description" content="Dashboard | Majharul">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Majharul">

    <!-- Favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!-- Bootstrap CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />

    <!-- Font Awesome CSS -->
    <link href="assets/font-awesome/css/all.css" rel="stylesheet" type="text/css" />

    <!-- Plugins -->
    <script type="text/javascript" src="ckeditor/ckeditor.js"></script>
    <link rel="stylesheet" href="fancybox-master/dist/jquery.fancybox.min.css">
    <!-- livecalendar -->
    <link rel="stylesheet" href="livedatetime/clock.css">
    <link rel="stylesheet" href="livedatetime/calendar.css">
    <link href='https://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
    <link href='https://netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css' rel='stylesheet' type='text/css'>

    <!-- BEGIN CSS for this page -->
    <link rel="stylesheet" type="text/css" href="assets/css/dataTables.bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="assets/plugins/datatables/datatables.min.css" />
    <!-- Custom CSS -->
    <link href="assets/css/style.css" rel="stylesheet" type="text/css" />
    <style>
        tfoot {
            display: table-header-group;
        }
    </style>
    <!-- END CSS for this page -->
</head>

<body class="adminbody">
    <div id="main">
        <!-- top bar navigation -->
        <div class="headerbar">

            <!-- LOGO -->
            <?php 
                $stm = $pdo->prepare('SELECT * FROM employee_info WHERE id=?');
                $stm->execute(array($_SESSION['logged_emp']));
                $rslt = $stm->fetchAll(PDO::FETCH_ASSOC);
                foreach($rslt as $row) :
            ?>
            <div class="headerbar-left">
                <a href="index.php" class="logo">
                    <img alt="Logo" src="assets/images/logo.png" />
                    <span><?php echo $row['emp_fullname']; ?></span>
                </a>
            </div>
        
            <nav class="navbar-custom">
                <ul class="list-inline float-right mb-0">

                    <li class="list-inline-item dropdown notif">
                        <a class="nav-link dropdown-toggle arrow-none" data-toggle="dropdown" href="#" aria-haspopup="false" aria-expanded="false">
                            <i class="far fa-envelope"></i>
                            <?php 
                                $notify_s = $pdo->prepare('SELECT * FROM notification WHERE emp_id=? AND type=? AND status=? ORDER BY date DESC');
                                $notify_s->execute(array($_SESSION['logged_emp'],'salary','unread'));
                                $notify_result = $notify_s->fetchAll(PDO::FETCH_ASSOC);
                                if(count($notify_result) > 0 ) :
                             ?>
                            <span class="mycounter"><?php echo count($notify_result); ?></span>
                            <?php endif; ?>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right dropdown-arrow dropdown-arrow-success dropdown-lg">
                            <!-- item-->
                        <?php if(count($notify_result) > 0 ) : 

                               foreach ($notify_result as $notifyr) :
                                $notify_id = $notifyr['id'];
                            ?>
                            <a style="<?php if($notifyr['status'] == 'unread'){echo 'font-weight:bold';}?>" href="salaryHistory.php?notyId=<?php echo $notify_id;?>" class="dropdown-item notify-item">
                                <p class="notify-details ml-0">
                                    <small><i><?php echo date('F j,Y g:i a',strtotime($notifyr['date'])); ?></i></small>
                                    You get your salary from pocket..!!
                                </p>
                            </a>
                            <div class="dropdown-divider"></div>
                        <?php endforeach; else : ?>
                            <!-- All-->
                            <a href="#" class="dropdown-item notify-item notify-all">
                                Your salary coming soon from pocket to rocket
                            </a>
                            <?php endif; ?>
                        </div>
                    </li>

                    <li class="list-inline-item dropdown notif">
                        <a class="nav-link dropdown-toggle arrow-none" data-toggle="dropdown" href="#" aria-haspopup="false" aria-expanded="false">
                            <i class="far fa-bell"></i>
                            <?php 
                                $notify_s = $pdo->prepare('SELECT * FROM notification WHERE type=? AND status=? ORDER BY date DESC');
                                $notify_s->execute(array('notice','unread'));
                                $notify_result = $notify_s->fetchAll(PDO::FETCH_ASSOC);
                                if(count($notify_result) > 0 ) :
                             ?>
                            <span class="mycounter"><?php echo count($notify_result); ?></span>
                            <?php endif; ?>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right dropdown-arrow dropdown-arrow-success dropdown-lg">
                            <!-- item-->
                        <?php if(count($notify_result) > 0 ) : 

                               foreach ($notify_result as $notifyr) :
                                $notify_id = $notifyr['id'];
                            ?>
                            <a style="<?php if($notifyr['status'] == 'unread'){echo 'font-weight:bold';}?>" href="noticeHistory.php?notyIds=<?php echo $notify_id;?>" class="dropdown-item notify-item">
                                <p class="notify-details ml-0">
                                    <small><i><?php echo date('F j,Y g:i a',strtotime($notifyr['date'])); ?></i></small>
                                    New Notice Publish ..!!
                                </p>
                            </a>
                            <div class="dropdown-divider"></div>
                        <?php endforeach; else : ?>
                            <!-- All-->
                            <a href="#" class="dropdown-item notify-item notify-all">
                                No New Notice Yet
                            </a>
                            <?php endif; ?>
                        </div>
                    </li>

                    <li class="list-inline-item dropdown notif">
                        <a class="nav-link dropdown-toggle arrow-none" data-toggle="dropdown" href="#" aria-haspopup="false" aria-expanded="false">
                            <i class="fas fa-cog"></i>
                        </a>

                       <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                            <!-- item-->
                            <div class="dropdown-item noti-title">
                                <h5 class="text-overflow">
                                    <small>Settings</small>
                                </h5>
                            </div>
                            <!-- item-->
                            <a href="changepassword.php" class="dropdown-item notify-item" style="padding:16px;">
                                <i class="fas fa-unlock-alt"></i>
                                <span>Change Password</span>
                            </a>
                        </div>
                    </li>


                    <li class="list-inline-item dropdown notif">
                        <a class="nav-link dropdown-toggle nav-user" data-toggle="dropdown" href="#" aria-haspopup="false" aria-expanded="false">
                            <?php if($row['profile_pic'] != 'avatar') : ?>
                            <img src="uploads/<?php echo $row['profile_pic']; ?>" alt="Profile image" class="avatar-rounded">
                            <?php else : ?>
                            <img src="assets/images/avatars/admin.png" alt="Profile image" class="avatar-rounded">
                        </a>
                        <?php endif; endforeach; ?>
                        <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                            <!-- item-->
                            <div class="dropdown-item noti-title hello_admin">
                                <h5 class="text-overflow">
                                    <small>Hello, <?php echo $row['emp_fullname']; ?></small>
                                </h5>
                            </div>
                            <!-- item-->
                            <a href="profile.php" class="dropdown-item notify-item">
                                <i class="fas fa-user"></i>
                                <span>Profile</span>
                            </a>
                            <!-- item-->
                            <a href="logout.php" class="dropdown-item notify-item">
                                <i class="fas fa-power-off"></i>
                                <span>Logout</span>
                            </a>
                        </div>
                    </li>

                </ul>
                <ul class="list-inline menu-left mb-0">
                    <li class="float-left">
                        <button class="button-menu-mobile open-left">
                            <i class="fas fa-bars"></i>
                        </button>
                    </li>
                </ul>
            </nav>
        </div>
        <!-- End Navigation -->

        <!-- Left Sidebar -->
        <div class="left main-sidebar">
            <div class="sidebar-inner leftscroll">
                <div id="sidebar-menu">
                    <ul>
                        <li class="submenu">
                            <a class="active" href="index.php">
                                <i class="fas fa-home"></i>
                                <span> Dashboard </span>
                            </a>
                        </li>
                        <li class="submenu">
                            <a id="tables" href="#">
                                <i class="fas fa-users"></i>
                                <span> Profile </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <ul class="list-unstyled">
                                <li>
                                    <a href="myprofile.php">My Profile </a>
                                </li>
                                <li>
                                    <a href="emEdit.php">Edit Profile </a>
                                </li>
                            </ul>
                        </li>
                        <li class="submenu">
                            <a id="tables" href="#">
                                <i class="far fa-money-bill-alt"></i>
                                <span> Salary Options </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <ul class="list-unstyled">
                                <li>
                                    <a href="salaryHistory.php">Salary History</a>
                                </li>
                            </ul>
                        </li>
                        <li class="submenu">
                            <a id="tables" href="#">
                                <i class="fas fa-project-diagram"></i>
                                <span> Projects </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <ul class="list-unstyled">
                                <li>
                                    <a href="projectOverview.php">Project Overviews</a>
                                </li>
                            </ul>
                        </li>
                        <li class="submenu">
                            <a id="tables" href="#">
                                <i class="fas fa-exclamation-circle"></i>
                                <span> Notice </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <ul class="list-unstyled">
                                <li>
                                    <a href="noticeHistory.php">Notice History</a>
                                </li>
                            </ul>
                        </li>
                        <li class="submenu">
                            <a id="tables" href="#">
                                <i class="fab fa-autoprefixer"></i>
                                <span> Attendence </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <ul class="list-unstyled">
                                <li>
                                    <a href="attendence.php">Present Sheet</a>
                                </li>
                            </ul>
                        </li>
                        <li class="submenu">
                            <a id="tables" href="#">
                                <i class="fas fa-skiing-nordic"></i>
                                <span> Leave </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <ul class="list-unstyled">
                                <li>
                                    <a href="leaveform.php">Leaving Form</a>
                                </li>
                                <li>
                                    <a href="leavingDetails.php">Leaving Details</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
        <!-- End Sidebar -->

        <div class="content-page">
            <!-- Start content -->
            <div class="content">
                <div class="container-fluid">