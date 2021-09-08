<?php require_once('header.php'); ?>
<!-- Start Breadcame -->
<div class="row">
    <div class="col-xl-12">
        <div class="breadcrumb-holder">
            <h1 class="main-title float-left">Employees</h1>
            <ol class="breadcrumb float-right">
                <li class="breadcrumb-item">Employee Options</li>
                <li class="breadcrumb-item active">All Employees</li>
            </ol>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<!-- End Breadcame -->

<!-- Add Employee to database -->
<?php 
	if (isset($_POST['add_emp'])) {
		$emid = $_POST['emid'];
		$empfullname = $_POST['empfullname'];
		$emp_mail = $_POST['emp_mail'];
		$emp_phone = $_POST['emp_phone'];
		$emp_desg = $_POST['emp_desg'];
		$emp_salary = $_POST['emp_salary'];
		$emp_address = $_POST['emp_address'];
		$emp_pass = $_POST['emp_pass'];
		$conpass = $_POST['conpass'];
		$emp_bio = $_POST['emp_bio'];


		try {
			if (empty($emid)) {
				throw new Exception('This id can\'t be empty!');
			}
			if (!is_numeric($emid)) {
				throw new Exception('This id mustbe number!');
			}
			if (empty($empfullname)) {
				throw new Exception('Please fill in the fullname!');
			}
			if (empty($emp_mail)) {
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
			if (empty($emp_pass)) {
				throw new Exception('Please set your password!');
			}
			if (empty($conpass)) {
				throw new Exception('Confirm password can\'t be empty!');
			}
			if ($emp_pass != $conpass) {
				throw new Exception('Password & Confirm password doesn\'t match!');
			}
			if (empty($emp_bio)) {
				throw new Exception('Please write your bio!');
			}

			// checking photo
	        $profile_pic = $_FILES['profile_pic']['name'];
	        $tmp_name_pic = $_FILES['profile_pic']['tmp_name'];
	        $emp_pic_size = $_FILES['profile_pic']['size'];

	        if (empty($profile_pic)) {
	          throw new Exception('Please attach your image!');
	        }
	        if ($emp_pic_size > '5000000') {
	          throw new Exception('Your image is too large!');
	        }

	        $ex = explode(".",$profile_pic);
	        $final_ex = end($ex);

	      
	        if($final_ex != 'jpg' AND $final_ex != 'jpeg' AND $final_ex != 'png' AND $final_ex != 'gif'
	          AND $final_ex != 'JPG' AND $final_ex != 'JPEG' AND $final_ex != 'PNG'
	          AND $final_ex != 'GIF') {
	          throw new Exception('Only jpg,jpeg,png,gif,JPG,JPEG,PNG,GIF file allowed');
	        }


	        // Existing checking
	        $stm = $pdo->prepare('SELECT * FROM employee_info WHERE employee_id=? || emp_mail=?');
	        $stm->execute(array($emid,$emp_mail));
	        $exist = $stm->rowCount();
	       	if($exist == 1){
	       		$error = 'Employee id or email already exist!';
	       	}
	       	else{
	       		$new_name_pic = "Image".rand(1,1000).rand(1,10000).".".$final_ex;
	        	move_uploaded_file($tmp_name_pic,'../uploads/'.$new_name_pic);

	       		$Nemp_pass = sha1($emp_pass);
	       		$statement = $pdo->prepare("INSERT INTO employee_info(employee_id,emp_fullname,emp_mail,emp_phone,emp_designation,emp_salary,emp_address,emp_password,emp_bio,profile_pic) VALUES(?,?,?,?,?,?,?,?,?,?)");
          		$statement->execute(array($emid,$empfullname,$emp_mail,$emp_phone,$emp_desg,$emp_salary,$emp_address,$Nemp_pass,$emp_bio,$new_name_pic));

	       		$success = 'Employee Add Successfully!';

	       		unset($_POST['emid']);
	       		unset($_POST['empfullname']);
	       		unset($_POST['emp_mail']);
	       		unset($_POST['emp_phone']);
	       		unset($_POST['emp_desg']);
	       		unset($_POST['emp_salary']);
	       		unset($_POST['emp_address']);
	       		unset($_POST['emp_pass']);
	       		unset($_POST['conpass']);
	       		unset($_POST['emp_bio']);
	       	}
		}

		catch (Exception $e) {
			$error = $e->getMessage();
		}
	}

?>
<!-- end database query -->


<!-- delete success message -->
<?php if(isset($_REQUEST['deleted'])) : ?>
  <div class="alert alert-success">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <i class="material-icons">close</i>
    </button>
    <span>Employee Account Deleted Successfully!</span>
  </div>
<?php endif; ?>

<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
	    <div class="card mb-3">
	        <div class="card-header">
	            <span class="pull-right">
	                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap"><i class="fas fa-user-plus" aria-hidden="true"></i> Add new employee</button>
	            </span>
					<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
					  <div class="modal-dialog">
					    <div class="modal-content">
					      <div class="modal-header bg-danger text-white">
					        <h5 class="modal-title" id="exampleModalLabel">Add New Employee</h5>
					        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					          <span aria-hidden="true">&times;</span>
					        </button>
					      </div>

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
					      <div class="modal-body">
					        <form class="needs-validation" novalidate action="" method="POST" enctype="multipart/form-data">
							  <div class="form-row">
							    <div class="col-md-6 mb-3">
							      <label for="validationCustom01">Employee Id</label>
							      <input type="number" name="emid" class="form-control" id="validationCustom01" value="<?php if(isset($_POST['emid'])){echo $_POST['emid'];} ?>" required>
							      <div class="valid-feedback">
							        Looks good!
							      </div>
							    </div>
							    <div class="col-md-6 mb-3">
							      <label for="validationCustom02">Full name</label>
							      <input type="text" name="empfullname" class="form-control" id="validationCustom02" value="<?php if(isset($_POST['empfullname'])){echo $_POST['empfullname'];} ?>" required>
							      <div class="valid-feedback">
							        Looks good!
							      </div>
							    </div>
							  </div>

							  <div class="form-row">
							    <div class="col-md-6 mb-3">
							      <label for="validationCustom03">Email</label>
							      <input type="email" name="emp_mail" class="form-control" id="validationCustom03" value="<?php if(isset($_POST['emp_mail'])){echo $_POST['emp_mail'];} ?>" required>
							      <div class="invalid-feedback">
							        Please provide a valid email.
							      </div>
							    </div>
							    <div class="col-md-6 mb-3">
							      <label for="validationCustom04">Phone No.</label>
							      <input type="number" name="emp_phone" class="form-control" id="validationCustom04" value="<?php if(isset($_POST['emp_phone'])){echo $_POST['emp_phone'];} ?>" required>
							      <div class="invalid-feedback">
							        Please select a valid Phone NO.
							      </div>
							    </div>
							  </div>

							<div class="form-row">
								<div class="col-md-6 mb-3">
							      <label for="validationCustom05">Designation</label>
							      <input type="text" name="emp_desg" class="form-control" id="validationCustom05" value="<?php if(isset($_POST['emp_desg'])){echo $_POST['emp_desg'];} ?>" required>
							      <div class="invalid-feedback">
							        Please provide your designation.
							      </div>
							    </div>
							    <div class="col-md-6 mb-3">
							      <label for="validationCustom06">Employee Salary</label>
							      <input type="number" name="emp_salary" class="form-control" id="validationCustom06" value="<?php if(isset($_POST['emp_salary'])){echo $_POST['emp_salary'];} ?>" required>
							      <div class="valid-feedback">
							        Looks good!
							      </div>
							    </div>
							 </div>
							 <div class="form-row">
								<div class="col-md-12 mb-3">
							      <label for="validationCustom07">Address</label>
							      <input type="text" name="emp_address" class="form-control" id="validationCustom07" value="<?php if(isset($_POST['emp_address'])){echo $_POST['emp_address'];} ?>" required>
							      <div class="valid-feedback">
							        Looks good!
							      </div>
							    </div>							 	
							 </div>

							 <div class="form-row">
							    <div class="col-md-6 mb-3">
							      <label for="validationCustom08">Password</label>
							      <input type="Password" name="emp_pass" class="form-control" id="validationCustom08" value="<?php if(isset($_POST['emp_pass'])){echo $_POST['emp_pass'];} ?>" required>
							      <div class="valid-feedback">
							        Looks good!
							      </div>
							    </div>
							    <div class="col-md-6 mb-3">
							      <label for="validationCustom09">Confirm Password</label>
							      <input type="Password" name="conpass" class="form-control" id="validationCustom09" value="<?php if(isset($_POST['conpass'])){echo $_POST['conpass'];} ?>" required>
							      <div class="valid-feedback">
							        Looks good!
							      </div>
							    </div>
							 </div>
							 <div class="form-row">
							    <div class="col-md-12 mb-3">
							      <label for="validationCustom10">Bio</label>
							      <textarea name="emp_bio" class="form-control" id="validationCustom10" value="<?php if(isset($_POST['emp_bio'])){echo $_POST['emp_bio'];} ?>"
							      required></textarea>
							      <div class="valid-feedback">
							        Looks good!
							      </div>
							    </div>
							 </div>
							 <div class="form-row">
							 	<div class="col-md-3 mb-3">
							      <label for="validationCustom11">Profile Picture</label>
							      <input type="file" name="profile_pic" id="validationCustom11" required>
							    </div>
							 </div>
							  <button class="btn btn-primary pull-right" name="add_emp" type="submit">Submit form</button>
							</form>
					        <script>
					            // Example starter JavaScript for disabling form submissions if there are invalid fields
					            (function() {
					              'use strict';
					              window.addEventListener('load', function() {
					                // Fetch all the forms we want to apply custom Bootstrap validation styles to
					                var forms = document.getElementsByClassName('needs-validation');
					                // Loop over them and prevent submission
					                var validation = Array.prototype.filter.call(forms, function(form) {
					                  form.addEventListener('submit', function(event) {
					                    if (form.checkValidity() === false) {
					                      event.preventDefault();
					                      event.stopPropagation();
					                    }
					                    form.classList.add('was-validated');
					                  }, false);
					                });
					              }, false);
					            })();
					        </script>
					      </div>
					    </div>
					  </div>
					</div>

					<!-- end check -->

	            <h3>
	                <i class="far fa-user"></i> All Employees</h3>
	        </div>
	        <!-- end card-header -->

	        <div class="card-body">
	            <div class="table-responsive">
	                <table class="table table-bordered">
	                    <thead>
	                        <tr>
	                            <th style="min-width:300px">Employee details</th>
	                            <th style="width:120px">Role</th>
	                            <th style="width:120px;min-width:110px;">Actions</th>
	                        </tr>
	                    </thead>
	                    <tbody>

	                    	<?php 
								$viewdata = $pdo->prepare('SELECT * FROM employee_info ORDER BY id DESC');
								$viewdata->execute();
								$result = $viewdata->fetchAll(PDO::FETCH_ASSOC);
								foreach ($result as $row) :
						 	?>
	                        <tr>
	                            <td>
	                                <div class="user_avatar_list d-none d-none d-lg-block"><img alt="image" src="../uploads/<?php echo $row['profile_pic']; ?>"></div>
	                                <h4><?php echo $row['emp_fullname']; ?></h4>
	                                <p><?php echo $row['emp_mail']; ?></p>
	                                <p>Bio: <?php echo $row['emp_bio']; ?></p>
	                            </td>
	                            <td><?php echo $row['emp_designation']; ?></td>
	                            <td>
	                                <a href="emAll.php?viewid=<?php echo $row['id'];?>" style="margin: 0 auto;width:100px" class="btn btn-info btn-sm btn-block" data-toggle="modal" data-target="#profileview<?php echo $row['id'];?>"><i class="far fa-eye"></i>&nbsp;&nbsp;View</a>
	                <!-- =================== Single View ======================= -->
	                				<div class="modal fade custom-modal" tabindex="-1" role="dialog" aria-labelledby="profileview<?php echo $row['id'];?>" aria-hidden="true" id="profileview<?php echo $row['id'];?>">
					                	<div class="modal-dialog">
						                    <div class="modal-content">
						                       <div class="profile_view_area">
						                       		<div class="modal-header">
						                                <h6 class="modal-title"><?php echo $row['emp_fullname'];?>'s Profile</h6>
						                                <button type="button" class="close" data-dismiss="modal">
						                                    <span aria-hidden="true">×</span>
						                                    <span class="sr-only">Close</span>
						                                </button>
	                            					</div>
	                            					<div class="modal-body">
	                            						<div class="row">
															<div class="col-md-12">
																<div class="emp_info">
												                    <div class="emp_info_single">
												                      <div class="emp_profile">
												                        <div class="emp_avatar">
												                          <a href="#emp_pablo">
												                            <img class="img" src="../uploads/<?php echo $row['profile_pic']; ?>" alt="no-photo">
												                          </a>
												                        </div>
												                        <div class="emp_body table-responsive">
												                          <h4><?php echo $row['emp_fullname'];?></h4>
												                          <br\>
												                          <table class="table">
												                            <tbody>
													                            <tr>
													                                <td>Employee id</td>
													                                <td><b>:</b></td>
													                                <td><?php echo $row['employee_id'];?></td>
													                            </tr>

													                            <tr>
													                                <td>Designation</td>
													                                <td><b>:</b></td>
													                                <td><?php echo $row['emp_designation'];?></td>
													                            </tr>

													                            <tr>
													                                <td>Mobile Number</td>
													                                <td><b>:</b></td>
													                                <td>+880<?php echo $row['emp_phone'];?></td>
													                            </tr>

													                            <tr>
													                                <td>E-mail</td>
													                                <td><b>:</b></td>
													                                <td><?php echo $row['emp_mail'];?></td>
													                            </tr>

													                            <tr>
													                                <td>Address</td>
													                                <td><b>:</b></td>
													                                <td><?php echo $row['emp_address'];?></td>
													                            </tr>

													                            <tr>
													                                <td>Joining Date &amp; time</td>
													                                <td><b>:</b></td>
													                                <td><?php echo $row['register_timedate'];?></td>
													                            </tr>

													                            <tr>
													                                <td>Now Total Earn</td>
													                                <td><b>:</b></td>
													                                <td>$<?php echo $row['total_salary'];?></td>
													                            </tr>
												                            </tbody>
												                        </table>
												                        </br\></div>
												                      </div>
												                    </div>
												                  </div>
											              		</div>
											                </div>
		                            					</div>
							                       </div>
							                    </div>
						                	</div>
		            					</div>
		            				
	 	<!-- ===================== Start Single Edit ===================== -->
	                                <a href="emEdit.php?editId=<?php echo $row['id'];?>" style="margin: 10px auto;width:100px" class="btn btn-primary btn-sm btn-block"><i class="far fa-edit"></i>&nbsp;&nbsp;Edit</a>
	                        <!-- =============== End Single Edit ================= -->
	                                <a onclick="return confirm('Are sure delete this data?')" href="emAll.php?delEmId=<?php echo $row['id']; ?>" style="width:100px;margin:0 auto" class="btn btn-danger btn-sm btn-block mt-2"><i class="fas fa-trash"></i>&nbsp;&nbsp;Delete</a>
	                            </td>
	                        </tr>
	                        <?php endforeach; ?>
	                    </tbody>
	                </table>
	            </div>

	        </div>
	        <!-- end card-body -->
 
	    </div>
	    <!-- end card -->

	</div>
	<!-- end col -->

	</div>

<?php require_once('footer.php'); ?>

<!-- ============ Delete Employee from table ============= -->
<?php 
	if (isset($_REQUEST['delEmId'])) {
	    $delete = $_REQUEST['delEmId'];


	    $img_search = $pdo->prepare("SELECT * FROM employee_info WHERE id=?");
	    $img_search->execute(array($delete));
	    $photo = $img_search->fetchAll(PDO::FETCH_ASSOC);
	    foreach ($photo as $pic) {
	      $old_photo = $pic['emp_ppic'];
	      $real_path = "../uploads/".$old_photo;
	      unlink($real_path);
	    }


	    $stm = $pdo->prepare("DELETE FROM employee_info WHERE id=?");
	    $stm->execute(array($delete));

	    header('location: emAll.php?deleted');

	  }

 ?>