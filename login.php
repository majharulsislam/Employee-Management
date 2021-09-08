<?php require_once('config.php') ?>

<?php
  
    ob_start();
    session_start();
    if(isset($_SESSION['logged_emp'])){
        header('location:index.php');
    }

 ?>


 <!-- Login Employee -->
 <?php 
    if (isset($_POST['login'])) {
        $emp_email = $_POST['emp_email'];
        $emp_password = $_POST['emp_password'];
        

        try {
            if (empty($emp_email)) {
                throw new Exception('Your email Can\'t be empty!');
            }
            if (empty($emp_password)) {
                throw new Exception('Password Can\' be empty!');
            }


            $statement = $pdo->prepare("SELECT * FROM employee_info WHERE emp_mail=?");
            $statement->execute(array($emp_email));
            $userCount = $statement->rowCount();
            $userData = $statement->fetchAll(PDO::FETCH_ASSOC);
            foreach($userData as $singleUser){
               $db_password = $singleUser['emp_password'];
            }
          
            if ($userCount == 0) {     
               throw new Exception ('Email is Wrong! Please try again');
            }
            $login_pass = sha1($emp_password);
            if($db_password == $login_pass) {
               session_start();
               $_SESSION['logged_emp'] = $singleUser['id'];
               $_SESSION['last_login_timestamp'] = time();

               header('location: index.php');

            }
            else{
               throw new Exception('Invalid username or password');
            }
        }
        catch (Exception $e) {
            $error = $e->getMessage();
        }
    }

  ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>Friends It Point | Employee Login</title>
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
    <!-- Custom CSS -->
    <link href="assets/css/style.css" rel="stylesheet" type="text/css" />
</head>
<body class="login_form_body">

    <div class="login_form_area">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card mb-3">
                    <div class="card-header">
                        <h3 class="text-center"><!-- <i class="far fa-hand-pointer"></i> -->Log Into Employee</h3>
                    </div>

                    <div class="card-body">
                        <form action=" " method="POST" enctype="multipart/form-data">
                            <!-- Error-->
                            <?php if(isset($error)) : ?>
                              <div class="alert alert-danger">
                                <?php echo $error; ?>
                              </div>
                            <?php endif; ?>
                            <div class="form-group">
                                <label for="emailAddress">Email address<span class="text-danger">*</span></label>
                                <input type="email" name="emp_email" data-parsley-trigger="change" placeholder="Enter email" class="form-control" id="emailAddress" value="<?php if(isset($_POST['emp_email'])){echo $_POST['emp_email']; } ?>">
                            </div>
                            <div class="form-group">
                                <label for="pass1">Password<span class="text-danger">*</span></label>
                                <input id="pass1" type="password" placeholder="Password" class="form-control" name="emp_password" value="<?php if(isset($_POST['emp_password'])){echo $_POST['emp_password']; } ?>">
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

     <script src="assets/js/modernizr.min.js"></script>
     <script src="assets/js/jquery.min.js"></script>
     <script src="assets/js/moment.min.js"></script>

     <script src="assets/js/popper.min.js"></script>
     <script src="assets/js/bootstrap.min.js"></script>

     <!-- App js -->
     <script src="assets/js/admin.js"></script>
</body>
</html>