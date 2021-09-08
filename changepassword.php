<?php require_once('header.php'); ?>

<?php 
    if (isset($_POST['sendnewpass'])) {
        $newpass = $_POST['newpass'];
        $confpass = $_POST['confpass'];

        try {

            // Checking old password->
            $oldpass = $_POST['oldpass'];
            $password = sha1($oldpass);

            $statement = $pdo->prepare("SELECT * FROM employee_info WHERE emp_password=?");
            $statement->execute(array($password));
            $userCount = $statement->rowCount();
            $userData = $statement->fetchAll(PDO::FETCH_ASSOC);
            foreach($userData as $singleUser){
                $db_password = $singleUser['emp_password'];
            }

             if ($userCount == 0) {      
              throw new Exception ('Old password is wrong!!');
            }
            if ($newpass != $confpass) {
                throw new Exception('New password and confirm password does\'n match!!');
            }
            $emp_id = $_SESSION['logged_emp'];
            $new_password = sha1($newpass);
            $statement = $pdo->prepare("UPDATE employee_info SET emp_password=? WHERE id=?");
            $statement->execute(array($new_password,$emp_id));

            $success = "Password is change successfully!!";

            unset($_POST['oldpass']);
            unset($_POST['newpass']);
            unset($_POST['confpass']);

        }
        catch (Exception $e) {
            $error = $e->getMessage();  
        }

    }

 ?>

<!-- Start Breadcame -->
<div class="row">
    <div class="col-xl-12">
        <div class="breadcrumb-holder">
            <h1 class="main-title float-left">Change Password</h1>
            <ol class="breadcrumb float-right">
                <li class="breadcrumb-item">Settings</li>
                <li class="breadcrumb-item active">Change Password</li>
            </ol>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<!-- End Breadcame -->

<div class="row">
	<div class="col-xs-12 col-sm-12">
        <div class="card mb-3">
            <div class="card-header">
                <h3><i class="far fa-hand-pointer"></i> Password Update Form</h3>You can change here current passowrd and set new password.
            </div>

            <div class="card-body">
                <div class="col-md-8">
                    <!-- Error & Success -->
                    <?php if(isset($error)): ?>
                        <div class="alert alert-danger">
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <i class="fas fa-times"></i>
                          </button>
                          <span><?php echo $error; ?></span>
                        </div>
                    <?php endif; ?>
                   <?php if(isset($success)): ?>
                        <div class="alert alert-success">
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <i class="fas fa-times"></i>
                          </button>
                          <span><?php echo $success ;?></span>
                        </div>
                    <?php endif; ?>
                </div>
                <form action="" method="POST">
	                <div class="col-md-8">
                        <div class="form-group">
                            <label for="oldpass">Current Password<span class="text-danger">*</span></label>
                            <input type="password" name="oldpass" class="form-control" id="oldpass" value="<?php if(isset($_POST['oldpass'])){echo $_POST['oldpass'];}?>" required>
                        </div>
                    </div>

                    <div class="col-md-8">
	                   	<div class="form-group">
	                        <label for="newpass">New Password<span class="text-danger">*</span></label>
	                        <input type="password" name="newpass" class="form-control" id="newpass" value="<?php if(isset($_POST['newpass'])){echo $_POST['newpass'];}?>" required>
	                    </div>
                    </div>

                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="conpass">Confirm Password<span class="text-danger">*</span></label>
                            <input type="password" name="confpass" class="form-control" id="conpass" value="<?php if(isset($_POST['confpass'])){echo $_POST['confpass'];}?>" required>
                        </div>
                    </div>

                    <div class="col-md-8">
                    	<div class="form-group text-right m-b-0">
	                        <button class="btn btn-primary" type="submit" name="sendnewpass">
	                            Submit
	                        </button>
                    	</div>
                    </div>
                </form>
            </div>
        </div><!-- end card-->
    </div>
</div>

<?php require_once('footer.php'); ?>