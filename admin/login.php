<?php require_once('../config.php') ?>

<?php
  
    ob_start();
    session_start();
    if(isset($_SESSION['logged_in'])){
        header('location:index.php');
    }

 ?>


 <!-- Login Admin -->
 <?php 
    if (isset($_POST['login'])) {
        $admin_email = $_POST['admin_email'];
        $admin_password = $_POST['admin_password'];
        

        try {
            if (empty($admin_email)) {
                throw new Exception('Your email Can\'t be empty!');
            }
            if (empty($admin_password)) {
                throw new Exception('Password Can\' be empty!');
            }


            $statement = $pdo->prepare("SELECT * FROM admin_info WHERE admin_email=?");
            $statement->execute(array($admin_email));
            $userCount = $statement->rowCount();
            $userData = $statement->fetchAll(PDO::FETCH_ASSOC);
            foreach($userData as $singleUser){
               $db_password = $singleUser['admin_pass'];
            }
          
            if ($userCount == 0) {     
               throw new Exception ('Email is Wrong! Please try again');
            }
            $login_pass = sha1($admin_password);
            if($db_password == $login_pass) {
               session_start();
               $_SESSION['logged_in'] = $singleUser['admin_id'];
               $_SESSION['last_login_timestamp'] = time();

               header('location: index.php');

            }
            else{
               throw new Exception('Invalid username or password');
            }
        }
        catch (Exception $e) {
            $error_l = $e->getMessage();
        }
    }

  ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>Friends It Point | Admin Login</title>
    <meta name="description" content="Dashboard | Majharul">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Your website">

    <!-- Favicon -->
    <link rel="shortcut icon" href="../assets/images/favicon.ico">
    <!-- Bootstrap CSS -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome CSS -->
    <link href="../assets/font-awesome/css/all.css" rel="stylesheet" type="text/css" />
    <!-- Custom CSS -->
    <link href="../assets/css/style.css" rel="stylesheet" type="text/css" />
</head>
<body class="login_form_body">

    <div class="login_form_area">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card mb-3">
                    <div class="card-header">
                        <h3 class="text-center"><!-- <i class="far fa-hand-pointer"></i> -->Log Into Admin</h3>
                    </div>

                    <div class="card-body">
                        <form action=" " method="POST" enctype="multipart/form-data">
                            <!-- Error-->
                            <?php if(isset($error_l)) : ?>
                              <div class="alert alert-danger">
                                <?php echo $error_l; ?>
                              </div>
                            <?php endif; ?>
                            <div class="form-group">
                                <label for="emailAddress">Email address<span class="text-danger">*</span></label>
                                <input type="email" name="admin_email" data-parsley-trigger="change"placeholder="Enter email" class="form-control" id="emailAddress" value="<?php if(isset($_POST['admin_email'])){echo $_POST['admin_email']; } ?>">
                            </div>
                            <div class="form-group">
                                <label for="pass1">Password<span class="text-danger">*</span></label>
                                <input id="pass1" type="password" placeholder="Password" class="form-control" name="admin_password" value="<?php if(isset($_POST['admin_password'])){echo $_POST['admin_password']; } ?>">
                            </div>

                            <div class="form-group text-right m-b-0">
                                <button class="btn btn-primary" type="submit" name="login">
                                    Submit
                                </button>
                            </div>
                        </form>
                    </div>
                </div><!-- end card-->
            </div>
        </div>      
    </div>

     <script src="../assets/js/modernizr.min.js"></script>
     <script src="../assets/js/jquery.min.js"></script>
     <script src="../assets/js/moment.min.js"></script>

     <script src="../assets/js/popper.min.js"></script>
     <script src="../assets/js/bootstrap.min.js"></script>

     <!-- App js -->
     <script src="../assets/js/admin.js"></script>
</body>
</html>