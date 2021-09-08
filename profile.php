<?php require_once('header.php'); ?>
<!-- ===================== Single Edit Employee Profile ===================== -->
<?php

    if (isset($_POST['submit_emp'])) {
        $empfullname = $_POST['empfullname'];
        $emp_email = $_POST['emp_email'];
        $emp_phone = $_POST['emp_phone'];
        $emp_desg = $_POST['emp_desg'];
        $emp_salary = $_POST['emp_salary'];
        $emp_address = $_POST['emp_address'];
        $emp_bio = $_POST['emp_bio'];
        try {
            if (empty($empfullname)) {
                throw new Exception('Please fill in the fullname!');
            }
            if (empty($emp_email)) {
                throw new Exception('Please fill in the email!');
            }
            if (empty($emp_phone)) {
                throw new Exception('Please fill in the phone number!');
            }
            if (!is_numeric($emp_phone)) {
                throw new Exception('Phone mustbe number!');
            }
            if (strlen($emp_phone) != 11) {
                throw new Exception('Phone number not valid!');
            }
            if (empty($emp_desg)) {
                throw new Exception('Please fill in the designation!');
            }
            if (empty($emp_salary)) {
                throw new Exception('Please fill in the salary field!');
            }
            if (empty($emp_address)) {
                throw new Exception('Please fill your right address!');
            }
            if (empty($emp_bio)) {
                throw new Exception('Please fill your right bio!');
            }

            // Update Database ->
            $emp_upd = $pdo->prepare('UPDATE employee_info SET emp_fullname=?,emp_mail=?,emp_phone=?,emp_designation=?,emp_salary=?,emp_address=?,emp_bio=? WHERE id=?');
            $emp_upd->execute(array($empfullname,$emp_email,$emp_phone,$emp_desg,$emp_salary,$emp_address,$emp_bio,$_SESSION['logged_emp']));

            $success = 'Your Data Updated Successfully!';

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
            <h1 class="main-title float-left">Profile</h1>
            <ol class="breadcrumb float-right">
                <li class="breadcrumb-item">Home</li>
                <li class="breadcrumb-item active">Profile</li>
            </ol>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<!-- End Breadcame -->


	<div class="row">
        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-9 col-xl-9">
            <div class="card mb-3">
                <div class="card-header">
                    <h3><i class="far fa-user"></i> Profile details</h3>
                </div>
                <div class="card-body">
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

                    <form action="" method="POST" enctype="multipart/form-data">
                    <?php 
                        $em_all = $pdo->prepare('SELECT * FROM employee_info WHERE id=?');
                        $em_all->execute(array($_SESSION['logged_emp']));
                        $result = $em_all->fetchAll(PDO::FETCH_ASSOC);
                        foreach($result as $row) :
                    ?>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="empid">Employee Id</label>
                                <input class="form-control" name="emid" type="text" id="empid" value="<?php echo $row['employee_id']; ?>" disabled>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="empfname">Full Name</label>
                                <input class="form-control" name="empfullname" type="text" id="empfname" value="<?php echo $row['emp_fullname']; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="empmail">Valid Email</label>
                                <input class="form-control" name="emp_email" type="email" id="empmail" value="<?php echo $row['emp_mail']; ?>">
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="emphone">Phone No.</label>
                                <input class="form-control" name="emp_phone" type="number" id="emphone" value="0<?php echo $row['emp_phone']; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="emrole">Designation</label>
                                <input class="form-control" name="emp_desg" type="text" id="emrole" value="<?php echo $row['emp_designation']; ?>">
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="emsalary">Salary</label>
                                <input class="form-control" name="emp_salary" type="number" id="emsalary" value="<?php echo $row['emp_salary']; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="emaddress">Address</label>
                                <input class="form-control" name="emp_address" type="text" id="emaddress" value="<?php echo $row['emp_address']; ?>">
                            </div>
                        </div>
                    </div>

                     <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="bio">Your Bio :</label>
                                <textarea id="bio" name="emp_bio" class="form-control" value="<?php echo $row['emp_bio']; ?>"><?php echo $row['emp_bio']; ?></textarea>
                            </div>
                        </div>
                    </div>
                
                   <div class="row">
                        <div class="col-lg-12">
                             <div class="modal-footer">
                                <button type="submit" name="submit_emp" class="btn btn-primary">Update</button>
                            </div>
                        </div>
                   </div>
                <?php endforeach; ?>
                </form>

                </div>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-3 col-xl-3">
            <div class="card mb-3">
                <div class="card-header">
                    <h3><i class="far fa-file-image"></i> Profile Image</h3>
                </div>

                <div class="card-body text-center">
                    <?php 
                        $profile_pic = $pdo->prepare('SELECT profile_pic FROM employee_info WHERE id=?');
                        $profile_pic->execute(array($_SESSION['logged_emp']));
                        $pics = $profile_pic->fetchAll(PDO::FETCH_ASSOC);
                        foreach ($pics as $pic) :
                            $photos = $pic['profile_pic'];
                            if ($photos == 'avatar') :
                    ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <img alt="avatar" class="img-fluid" src="assets/images/avatars/admin.png">
                        </div>
                    </div>
                    <?php else : ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <img alt="avatar" class="img-fluid" src="uploads/<?php echo $pic['profile_pic']; ?>">
                        </div>
                    </div>
                     <?php endif; endforeach;?>
                     
                    <div class="row">
                        <div class="col-lg-12">
                            <a onclick="return confirm('Are you sure delete this image?')" href="profile.php?delId=<?php echo $_SESSION['logged_emp'];?>" type="button" class="btn btn-danger btn-block mt-3">Delete Image</a>
                        </div>
                        <!-- Change profile image form -->
                        <div class="col-lg-12 change_pic_btn">
                            <button type="button" class="btn btn-info btn-block mt-3">Change Image</button>
                            <div class="change_image">
                                <?php 
                                    if (isset($_POST['savepic'])) {
                                        $change_pic = $_FILES['change_pic']['name'];
                                        $tmp_name = $_FILES['change_pic']['tmp_name'];
                                        $pic_size = $_FILES['change_pic']['size'];

                                        try {
                                        
                                            if (empty($change_pic)) {
                                              throw new Exception('Please attach your image!');
                                            }
                                            if ($pic_size > '5000000') {
                                              throw new Exception('Your image is too large!');
                                            }
                                           
                                            $ex = explode(".",$change_pic);
                                            $final_ex = end($ex);

                                            
                                            if($final_ex != 'jpg' AND $final_ex != 'jpeg' AND $final_ex != 'png' AND $final_ex != 'gif'
                                                AND $final_ex != 'JPG' AND $final_ex != 'JPEG' AND $final_ex != 'PNG'
                                                AND $final_ex != 'GIF') {

                                                throw new Exception('Only jpg,jpeg,png,gif,JPG,JPEG,PNG,GIF file allowed');

                                            }
                                            // pic unlink from file
                                            $showpic = $pdo->prepare('SELECT profile_pic FROM employee_info WHERE id=?');
                                            $showpic->execute(array($_SESSION['logged_emp']));
                                            $emp_pics = $showpic->fetchAll(PDO::FETCH_ASSOC);
                                            foreach ($emp_pics as $emp_old_pic) {
                                                $old_photo = $emp_old_pic['admin_pic'];
                                                $real_path = "uploads/".$old_photo;
                                                unlink($real_path);
                                            }

                                            $new_name_pic = "Image".rand(1,1000).rand(1,10000).".".$final_ex;
                                            move_uploaded_file($tmp_name,'uploads/'.$new_name_pic);

                                            $update_pic = $pdo->prepare('UPDATE employee_info SET profile_pic=? WHERE id=?');
                                            $update_pic->execute(array($new_name_pic,$_SESSION['logged_emp']));

                                            $success = "Image uploaded successfully!";
                                            header('location:profile.php');

                                        }

                                        catch (Exception $e) {
                                            $error = $e->getMessage();
                                        }
                                    }
                                ?>
                            	<form action="" method="POST" enctype="multipart/form-data">
                            		<div class="col-md-12">
		                                <div class="form-group">
		                                    <label>Change Profile Image</label>
                                            <?php if (isset($error)) {
                                                echo '<p style="color:red">'.$error.'</p>';
                                            } ?>
		                                    <input name="change_pic" type="file">
		                                    <button type="submit" name="savepic">Save</button>
		                                </div>
				                    </div>
                            	</form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php require_once('footer.php'); ?>

<?php 
    if (isset($_REQUEST['delId'])) {
        $delimg = $_REQUEST['delId'];

        $showpic = $pdo->prepare('SELECT profile_pic FROM employee_info WHERE id=?');
        $showpic->execute(array($delimg));
        $emp_pics = $showpic->fetchAll(PDO::FETCH_ASSOC);
        foreach ($emp_pics as $emp_old_pic) {
            $old_photo = $emp_old_pic['profile_pic'];
            $real_path = "uploads/".$old_photo;
            unlink($real_path);
        }

        $upimg = $pdo->prepare('UPDATE employee_info SET profile_pic=? WHERE id=?');
        $upimg->execute(array('avatar',$delimg));

        header('location:profile.php');

    }

 ?>
