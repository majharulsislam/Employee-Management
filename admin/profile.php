<?php require_once('header.php'); ?>

<?php 
    if (isset($_POST['updateProfile'])) {
        $admin_name = $_POST['admin_name'];
        $admin_user = $_POST['admin_user'];
        $admin_email = $_POST['admin_email'];

        try {
            if (empty($admin_name)) {
                throw new Exception('Admin name can\'t be empty..!');
            }
            if (empty($admin_user)) {
                throw new Exception('Admin username can\'t be empty..!');
            }
            if (empty($admin_email)) {
                throw new Exception('Admin email can\'t be empty..!');
            }

            $update_profile = $pdo->prepare('UPDATE admin_info SET admin_name=?,admin_username=?,admin_email=? WHERE admin_id=?');
            $update_profile->execute(array($admin_name,$admin_user,$admin_email,$_SESSION['logged_in']));

            $success = 'Your Profile Updated Successfully..!';
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
            <h1 class="main-title float-left">My Profile</h1>
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
                    <form action=" " method="POST" enctype="multipart/form-data">
                        <?php 
                            $stm = $pdo->prepare('SELECT * FROM admin_info WHERE admin_id=?');
                            $stm->execute(array($_SESSION['logged_in']));
                            $rslt = $stm->fetchAll(PDO::FETCH_ASSOC);
                            foreach($rslt as $row) :
                        ?>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input class="form-control" name="admin_name" type="text" value="<?php echo $row['admin_name'] ?>">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Username</label>
                                    <input class="form-control" name="admin_user" type="text" value="<?php echo $row['admin_username']; ?>">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input class="form-control" name="admin_email" type="email" value="<?php echo $row['admin_email']; ?>">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Select country:</label>
                                    <select class="form-control" name="state" disabled>
                                            <option value="BD">Bangladesh</option>
                                            <option value="CA">Canada</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                        <label>Select birth year:</label>
                                        <select class="form-control" name="year" disabled>
                                                <option value="2001">2001</option>
                                                <option value="2002">2002</option>
                                        </select>
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Skype ID</label>
                                    <input class="form-control" name="skype" type="text" value="skype id" disabled>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Facebook page</label>
                                    <input class="form-control" name="skype" type="text" value="facebook" disabled>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <hr>
                                <button type="submit" class="btn btn-primary" name="updateProfile">Update profile</button>
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
                        $profile_pic = $pdo->prepare('SELECT admin_pic FROM admin_info WHERE admin_id=?');
                        $profile_pic->execute(array($_SESSION['logged_in']));
                        $pics = $profile_pic->fetchAll(PDO::FETCH_ASSOC);
                        foreach ($pics as $pic) :
                            $photos = $pic['admin_pic'];
                            if ($photos == 'avatar') :
                    ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <img alt="avatar" class="img-fluid" src="../assets/images/avatars/admin.png">
                        </div>
                    </div>
                    <?php else : ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <img alt="avatar" class="img-fluid" src="../uploads/<?php echo $pic['admin_pic']; ?>">
                        </div>
                    </div>
                     <?php endif; endforeach;?>
                     
                    <div class="row">
                        <div class="col-lg-12">
                            <a onclick="return confirm('Are you sure delete this image?')" href="profile.php?delId=<?php echo $_SESSION['logged_in'];?>" type="button" class="btn btn-danger btn-block mt-3">Delete Image</a>
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
                                            $showpic = $pdo->prepare('SELECT admin_pic FROM admin_info WHERE admin_id=?');
                                            $showpic->execute(array($_SESSION['logged_in']));
                                            $admin_pics = $showpic->fetchAll(PDO::FETCH_ASSOC);
                                            foreach ($admin_pics as $admin_old_pic) {
                                                $old_photo = $admin_old_pic['admin_pic'];
                                                $real_path = "../uploads/".$old_photo;
                                                unlink($real_path);
                                            }

                                            $new_name_pic = "Image".rand(1,1000).rand(1,10000).".".$final_ex;
                                            move_uploaded_file($tmp_name,'../uploads/'.$new_name_pic);

                                            $update_pic = $pdo->prepare('UPDATE admin_info SET admin_pic=? WHERE admin_id=?');
                                            $update_pic->execute(array($new_name_pic,$_SESSION['logged_in']));

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

        $showpic = $pdo->prepare('SELECT admin_pic FROM admin_info WHERE admin_id=?');
        $showpic->execute(array($delimg));
        $admin_pics = $showpic->fetchAll(PDO::FETCH_ASSOC);
        foreach ($admin_pics as $admin_old_pic) {
            $old_photo = $admin_old_pic['admin_pic'];
            $real_path = "../uploads/".$old_photo;
            unlink($real_path);
        }

        $upimg = $pdo->prepare('UPDATE admin_info SET admin_pic=? WHERE admin_id=?');
        $upimg->execute(array('avatar',$delimg));
        header('location:profile.php');

    }

 ?>
