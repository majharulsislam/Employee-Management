<?php require_once('header.php'); ?>

 <?php
    if(isset($_POST['admin_regi'])){
        $admin_name = $_POST['admin_name'];
        $admin_user = $_POST['admin_user'];
        $admin_email = $_POST['admin_email'];
        $admin_pass = $_POST['admin_pass'];
        $admin_cpass = $_POST['admin_cpass'];

        try {
            if (empty($admin_name)) {
                throw new Exception('Name can\'t be empty!');
            }
            if (empty($admin_user)) {
                throw new Exception('Username can\'t be empty!');
            }
            if (empty($admin_email)) {
                throw new Exception('Email can\'t be empty!');
            }
            if (empty($admin_pass)) {
                throw new Exception('Password can\'t be empty!');
            }
            if (empty($admin_cpass)) {
                throw new Exception('Confirm password can\'t be empty!');
            }
            if ($admin_pass != $admin_cpass) {
              throw new Exception ('New password and confirm password doesn\'t match!!');
            }

            // checking photo
            $admin_pic = $_FILES['admin_pic']['name'];
            $tmp_name_pic = $_FILES['admin_pic']['tmp_name'];
            $admin_pic_size = $_FILES['admin_pic']['size'];

            if (empty($admin_pic)) {
              throw new Exception('Please attach your image!');
            }
            if ($admin_pic_size > '5000000') {
              throw new Exception('Your image is too large!');
            }

            $ex = explode(".",$admin_pic);
            $final_ex = end($ex);

          
            if($final_ex != 'jpg' AND $final_ex != 'jpeg' AND $final_ex != 'png' AND $final_ex != 'gif'
              AND $final_ex != 'JPG' AND $final_ex != 'JPEG' AND $final_ex != 'PNG'
              AND $final_ex != 'GIF') {
              throw new Exception('Only jpg,jpeg,png,gif,JPG,JPEG,PNG,GIF file allowed');
            }


            $add_new_pass = sha1($admin_pass);
            // Exist checking
            $stm = $pdo->prepare("SELECT * FROM admin_info WHERE admin_email=?");
            $stm->execute(array($admin_email));
            $exist = $stm->rowCount();
            if ($exist == 1) {
              $error = 'This Email Already Access! Please Another Try.';
            }
            else{
            	$new_name_pic = "Image".rand(1,1000).rand(1,10000).".".$final_ex;
            	move_uploaded_file($tmp_name_pic,'../uploads/'.$new_name_pic);
              	//-> Insert data to database
              	$statement = $pdo->prepare("INSERT INTO admin_info(admin_name,admin_username,admin_email,admin_pass,admin_pic) VALUES(?,?,?,?,?)");
              	$statement->execute(array($admin_name,$admin_user,$admin_email,$add_new_pass,$new_name_pic));
            }

            $success = 'Your Registration Successfull!';

            unset($_POST['admin_name']);
            unset($_POST['admin_user']);
            unset($_POST['admin_email']);
            unset($_POST['admin_pass']);
            unset($_POST['admin_cpass']);

        }
        catch (Exception $e) {
            $error = $e->getMessage();
        }

    }

?>


<!-- Start breadcame -->
    <div class="row">
        <div class="col-xl-12">
            <div class="breadcrumb-holder">
                <h1 class="main-title float-left">Create New Admin</h1>
                <ol class="breadcrumb float-right">
                    <li class="breadcrumb-item">Home</li>
                    <li class="breadcrumb-item active">Create Admin</li>
                </ol>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
<!-- End Breadcaame -->

<div class="row">
	<div class="col-xs-12 col-sm-12">
        <div class="card mb-3">
            <div class="card-header">
                <h3><i class="far fa-hand-pointer"></i> Create New Admin</h3>
               	You can add here new admin who will get permission your all access.
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
                <form action="" method="POST" enctype="multipart/form-data"> 
                	<div class="row">
					    <div class="col-lg-8">
					        <div class="form-group">
					            <label for="adname">Name</label>
					            <input type="text" class="form-control" name="admin_name" id="adname" value="<?php if(isset($_POST['admin_name'])){echo $_POST['admin_name']; } ?>">
					        </div>
					    </div>
					</div>

					<div class="row">
					    <div class="col-lg-8">
					        <div class="form-group">
					            <label for="aduser">User Name</label>
					            <input type="text" class="form-control" name="admin_user" id="aduser" value="<?php if(isset($_POST['admin_user'])){echo $_POST['admin_user']; } ?>">
					        </div>
					    </div>
					</div>

					<div class="row">
					    <div class="col-lg-8">
					        <div class="form-group">
					            <label for="admail">Email</label>
					            <input type="email" class="form-control" name="admin_email" id="admail" value="<?php if(isset($_POST['admin_email'])){echo $_POST['admin_email']; } ?>">
					        </div>
					    </div>
					</div>

					<div class="row">
					    <div class="col-lg-4">
					        <div class="form-group">
					            <label for="adpass">Password</label>
					            <input type="password" class="form-control" name="admin_pass" id="adpass" value="<?php if(isset($_POST['admin_pass'])){echo $_POST['admin_pass']; } ?>">
					        </div>
					    </div>

					    <div class="col-lg-4">
					        <div class="form-group">
					            <label for="adconpass">Confirn Password</label>
					            <input type="password" class="form-control" name="admin_cpass" id="adconpass" value="<?php if(isset($_POST['admin_cpass'])){echo $_POST['admin_cpass']; } ?>">
					        </div>
					    </div>
					</div>

					<div class="form-group">
					    <label>Profile Image:</label>
					    <br>
					    <input type="file" name="admin_pic" value="<?php if(isset($_FILES['admin_pic'])){echo $_FILES['admin_pic']; } ?>">
					</div>
                    
                    <div class="col-md-8">
                    	<div class="form-group text-right m-b-0">
	                        <button class="btn btn-primary" type="submit" name="admin_regi">
	                            Submit
	                        </button>
	                        <button type="reset" class="btn btn-secondary m-l-5">
	                            Cancel
	                        </button>
                    	</div>
                    </div>
                </form>
            </div>
        </div><!-- end card-->
    </div>
</div>

<?php require_once('footer.php'); ?>