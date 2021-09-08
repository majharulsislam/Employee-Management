<?php require_once('header.php'); ?>
<!-- ===================== Single Edit Employee Profile ===================== -->
<?php 

	if (isset($_REQUEST['editId'])) {
		$editid = $_REQUEST['editId'];
	}
	else{
		header('location:emAll.php');
	}

	if (isset($_POST['submit_emp'])) {
		$empfullname = $_POST['empfullname'];
		$emp_email = $_POST['emp_email'];
		$emp_phone = $_POST['emp_phone'];
		$emp_desg = $_POST['emp_desg'];
		$emp_salary = $_POST['emp_salary'];
		$emp_address = $_POST['emp_address'];
		$emp_pass = $_POST['emp_pass'];
		$emp_bio = $_POST['emp_bio'];

		$emp_picture = $_FILES['emp_pic']['name'];
		$db_pass = $_POST['db_pass'];

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
			$passwords = sha1($emp_pass);
			if (empty($emp_pass)) {
				$password = $db_pass;
			}
			else{
				$update = $pdo->prepare('UPDATE employee_info SET emp_password=? WHERE id=?');
				$update->execute(array($passwords,$editid));
			}

			if (empty($emp_picture)) {
				$emp_upd = $pdo->prepare('UPDATE employee_info SET emp_fullname=?,emp_mail=?,emp_phone=?,emp_designation=?,emp_salary=?,emp_address=?,emp_bio=? WHERE id=?');
				$emp_upd->execute(array($empfullname,$emp_email,$emp_phone,$emp_desg,$emp_salary,$emp_address,$emp_bio,$editid));

				$success = 'Your Data Updated Successfully!';
			}
			else{
				// checking photo
	          	$emp_picture = $_FILES['emp_pic']['name'];
	          	$tmp_name_pic = $_FILES['emp_pic']['tmp_name'];
	          	$emp_pic_size = $_FILES['emp_pic']['size'];

	          	if ($emp_pic_size > '5000000') {
	            	throw new Exception('Your image is too large!');
	          	}

	          	$ex = explode(".",$emp_picture);
	          	$final_ex = end($ex);

	        
	          	if($final_ex != 'jpg' AND $final_ex != 'jpeg' AND $final_ex != 'png' AND $final_ex != 'gif'
	            	AND $final_ex != 'JPG' AND $final_ex != 'JPEG' AND $final_ex != 'PNG'
	            	AND $final_ex != 'GIF') {
	            		throw new Exception('Only jpg,jpeg,png,gif,JPG,JPEG,PNG,GIF file allowed');
	          	}

	          	$img_search = $pdo->prepare("SELECT * FROM employee_info WHERE id=?");
	            $img_search->execute(array($editid));
	            $photo = $img_search->fetchAll(PDO::FETCH_ASSOC);
	            foreach ($photo as $pic) {
			        $old_photo = $pic['profile_pic'];
			        $real_path = "../uploads/".$old_photo;
			        unlink($real_path);
	          	}

	          	$pic_new_name = "Image".rand(1,1000).rand(1,10000).".".$final_ex;
			   	move_uploaded_file($tmp_name_pic,'../uploads/'.$pic_new_name);

			    $statement = $pdo->prepare('UPDATE employee_info SET emp_fullname=?,emp_mail=?,emp_phone=?,emp_designation=?,emp_salary=?,emp_address=?,emp_bio=?,profile_pic=? WHERE id=?');
			    $statement->execute(array($empfullname,$emp_email,$emp_phone,$emp_desg,$emp_salary,$emp_address,$emp_bio,$pic_new_name,$editid));

			    $success = "Your account updated successfully!";
			}

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
            <h1 class="main-title float-left">Update Your Data</h1>
            <ol class="breadcrumb float-right">
                <li class="breadcrumb-item">All Employee</li>
                <li class="breadcrumb-item active">Edit</li>
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
                <h3><i class="far fa-hand-pointer"></i> Update Information</h3>
               	You can update your information or data.
            </div>

            <div class="card-body">
                <form action="" method="POST" enctype="multipart/form-data">
	                <div class="row">
	                	<div class="col-md-6">
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
	                </div>


			        <?php 
						$em_all = $pdo->prepare('SELECT * FROM employee_info WHERE id=?');
						$em_all->execute(array($editid));
						$result = $em_all->fetchAll(PDO::FETCH_ASSOC);
						foreach($result as $row) :
					?>

	                <div class="row">
	                    <div class="col-lg-8">
	                        <div class="form-group">
	                            <label for="empid">Employee Id</label>
	                            <input class="form-control" name="emid" type="text" id="empid" value="<?php echo $row['employee_id']; ?>" disabled>
	                        </div>
	                    </div>
	                </div>

	                <div class="row">
	                    <div class="col-lg-8">
	                        <div class="form-group">
	                            <label for="empfname">Full Name</label>
	                            <input class="form-control" name="empfullname" type="text" id="empfname" value="<?php echo $row['emp_fullname']; ?>">
	                        </div>
	                    </div>
	                </div>

	                <div class="row">
	                    <div class="col-lg-4">
	                        <div class="form-group">
	                            <label for="empmail">Valid Email</label>
	                            <input class="form-control" name="emp_email" type="email" id="empmail" value="<?php echo $row['emp_mail']; ?>">
	                        </div>
	                    </div>

	                    <div class="col-lg-4">
	                        <div class="form-group">
	                            <label for="emphone">Phone No.</label>
	                            <input class="form-control" name="emp_phone" type="number" id="emphone" value="0<?php echo $row['emp_phone']; ?>">
	                        </div>
	                    </div>
	                </div>

	                <div class="row">
	                    <div class="col-lg-4">
	                        <div class="form-group">
	                            <label for="emrole">Designation</label>
	                            <input class="form-control" name="emp_desg" type="text" id="emrole" value="<?php echo $row['emp_designation']; ?>">
	                        </div>
	                    </div>

	                    <div class="col-lg-4">
	                        <div class="form-group">
	                            <label for="emsalary">Salary</label>
	                            <input class="form-control" name="emp_salary" type="number" id="emsalary" value="<?php echo $row['emp_salary']; ?>">
	                        </div>
	                    </div>
	                </div>

	                <div class="row">
	                    <div class="col-lg-8">
	                        <div class="form-group">
	                            <label for="emaddress">Address</label>
	                            <input class="form-control" name="emp_address" type="text" id="emaddress" value="<?php echo $row['emp_address']; ?>">
	                        </div>
	                    </div>
	                </div>

	                <div class="row">
	                    <div class="col-lg-4">
	                        <div class="form-group">
	                            <label for="empass">Password</label>
	                            <input class="form-control" name="emp_pass" type="password" id="empass">
	                            <input name="db_pass" type="hidden">
	                        </div>
	                    </div>

	                    <div class="col-lg-4">
	                        <div class="form-group">
	                            <label for="emp_cpass">Confirm Password</label>
	                            <input class="form-control" name="emp_cpass" type="password" id="emp_cpass" disabled>
	                        </div>
	                    </div>
	                </div>

	                 <div class="row">
	                    <div class="col-lg-8">
	                        <div class="form-group">
	                            <label for="bio">Your Bio :</label>
	                            <textarea id="bio" name="emp_bio" class="form-control" value="<?php echo $row['emp_bio']; ?>"><?php echo $row['emp_bio']; ?></textarea>
	                        </div>
	                    </div>
	                </div>

	                <div class="row">
	                	<div class="col-lg-8">
	                		<div class="form-group">
			                    <label>Profile Image:</label>
			                    <br>
			                    <input type="file" name="emp_pic">
	                		</div>
	                	</div>
	                </div>
	            
		           <div class="row">
		           		<div class="col-lg-8">
		           			 <div class="modal-footer">
		                		<button type="submit" name="submit_emp" class="btn btn-primary">Update</button>
		            		</div>
		           		</div>
		           </div>
		        <?php endforeach; ?>
                </form>
            </div>
        </div><!-- end card-->
    </div>
</div>

<?php require_once('footer.php'); ?>