<?php require_once('config.php'); ?>

<?php 
  if (isset($_POST['submit_leave'])) {
      $left_emp = $_POST['left_emp'];
      $left_empid = $_POST['left_empid'];
      $company = $_POST['company'];
      $left_report = $_POST['left_report'];
      $left_day = $_POST['left_day'];
      $left_from = $_POST['left_from'];
      $left_to = $_POST['left_to'];
      $left_desc = $_POST['left_desc'];
      $app_sign = $_POST['app_sign'];
      $app_date = $_POST['app_date'];

      try {
          if (empty($company)) {
            throw new Exception('Please write your company name!!');
          }
          if (empty($left_report)) {
            throw new Exception('Reporting name can\'t be empty!!');
          }
          if (empty($left_day)) {
            throw new Exception('Leaving can\'t be empty!!');
          }
          if (empty($left_from)) {
            throw new Exception('Leave from date can\'t be empty!!');
          }
          if (empty($left_to)) {
            throw new Exception('Leave to date can\'t be empty!!');
          }
          if (empty($left_desc)) {
            throw new Exception('Please write your leave reason!!');
          }
          if (empty($app_sign)) {
            throw new Exception('Application signature can\'t be empty!!');
          }
          if (empty($app_date)) {
            throw new Exception('Application date can\'t be empty!!');
          }

          if (isset($_POST['left_reason'])) {
              $left_reason = $_POST['left_reason'];
              $left_coz = implode(',', $left_reason);

              $stm = $pdo->prepare('INSERT INTO leaving(left_emp,left_empid,company,left_report,left_day,left_from,left_to,left_desc,left_reason,app_sign,app_date) VALUES (?,?,?,?,?,?,?,?,?,?,?)');
              $stm->execute(array($left_emp,$left_empid,$company,$left_report,$left_day,$left_from,$left_to,$left_desc,$left_coz,$app_sign,$app_date));
          }
          else{
            throw new Exception('Please tick any leave requested option');  
          }

          $success = "Your leaving form submit successfully!!";

          unset($_POST['company']);
          unset($_POST['left_day']);
          unset($_POST['left_from']);
          unset($_POST['left_to']);
          unset($_POST['left_desc']);
          unset($_POST['left_reason']);
          unset($_POST['app_sign']);
          unset($_POST['app_date']);

      }
      catch (Exception $e) {
          $error = $e->getMessage(); 
      }

  }

 ?>


<?php require_once('header.php'); ?>

<!-- Start Breadcame -->
<div class="row">
    <div class="col-xl-12">
        <div class="breadcrumb-holder">
            <h1 class="main-title float-left">Leave Application</h1>
            <ol class="breadcrumb float-right">
                <li class="breadcrumb-item">Leave</li>
                <li class="breadcrumb-item active">Leaving Form</li>
            </ol>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<!-- End Breadcame -->

<div class="row">
	<div class="col-md-12">
		<div class="row">
		  <div class="col-md-6">
		    <!-- Error & Success -->
		  <?php if(isset($error)): ?>
		        <div class="alert alert-danger">
		          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		          <i class="fas fa-times"></i>
		          </button>
		          <span><?php echo $error ;?></span>
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

		 <form action="" method="POST" enctype="multipart/form-data">
		        <div class="row">
		            <div class="col-md-1">
		                I'm
		            </div>
		            <div class="col-md-5">
		                <div class="form-group">
		                  <select name="left_emp" class="form-control" id="exampleFormControlSelect1">
		                      <?php 
		                          $empall = $pdo->prepare('SELECT * FROM employee_info');
		                          $empall->execute();
		                          $emps = $empall->fetchAll(PDO::FETCH_ASSOC);
		                          foreach($emps as $emp) :
		                       ?>
		                       <option value="<?php echo $emp['emp_fullname']; ?>"><?php echo $emp['emp_fullname']; ?></option>
		                     <?php endforeach; ?>
		                  </select>
		                </div>
		            </div>
		            <div class="col-md-1">.EID</div>
		            <div class="col-md-3">
		                <div class="form-group">
		                  <select name="left_empid" class="form-control" id="exampleFormControlSelect1">
		                      <?php 
		                          $empall = $pdo->prepare('SELECT * FROM employee_info');
		                          $empall->execute();
		                          $emps = $empall->fetchAll(PDO::FETCH_ASSOC);
		                          foreach($emps as $emp) :
		                       ?>
		                       <option value="<?php echo $emp['employee_id']; ?>">Employee Id - <?php echo $emp['employee_id']; ?></option>
		                     <?php endforeach; ?>
		                  </select>
		                </div>
		            </div>
		            <div class="col-md-2">
		                ,under the Company
		            </div>
		            
		        </div>
		        <div class="row">
		            <div class="col-md-4">
		                <div class="form-group">
		                  <input class="form-control" type="text" placeholder="Company name" name="company" value="<?php if(isset($_POST['company'])){echo $_POST['company'];} ?>">
		                </div>
		            </div>
		            <div class="col-md-2">
		                ,reporting to
		            </div>
		            <div class="col-md-4">
		                <div class="form-group">
		                  <select name="left_report" class="form-control" id="exampleFormControlSelect1">
		                      <?php 
		                          $admin = $pdo->prepare('SELECT * FROM admin_info');
		                          $admin->execute();
		                          $admins = $admin->fetchAll(PDO::FETCH_ASSOC);
		                          foreach($admins as $adm) :
		                       ?>
		                       <option value="<?php echo $adm['admin_name'] ?>"><?php echo $adm['admin_name']; ?></option>
		                     <?php endforeach; ?>
		                  </select>
		                </div>
		            </div>
		            <div class="col-md-2">
		                with to apply for
		            </div>
		        </div>
		        <div class="row">
		            <div class="col-md-3">
		                <div class="form-group">
		                  <input class="form-control" type="number" placeholder="Number of days" name="left_day" value="<?php if(isset($_POST['left_day'])){echo $_POST['left_day'];} ?>">
		                </div>
		            </div>
		            <div class="col-md-2">
		                days of leave from
		            </div>
		            <div class="col-md-3">
		                <div class="form-group">
		                  <input class="form-control" type="date" placeholder="start date" name="left_from" value="<?php if(isset($_POST['left_from'])){echo $_POST['left_from'];} ?>">
		                </div>
		            </div>
		            <div class="col-md-1">
		                to
		            </div>
		             <div class="col-md-3">
		                <div class="form-group">
		                  <input class="form-control" type="date" placeholder="End date" name="left_to" value="<?php if(isset($_POST['left_to'])){echo $_POST['left_to'];} ?>">
		                </div>
		            </div>
		        </div>
		       <div class="row">
		           <div class="col-md-3 mb-3">
		                for  the following reason(s):
		           </div> 
		       </div> 
		       <div class="row">
		           <div class="col-md-12">
		              <div class="form-group">
		                  <input type="text" cols="100" class="form-control" rows="2" name="left_desc" style="width:100%;" value="<?php if(isset($_POST['left_desc'])){echo $_POST['left_desc'];} ?>">
		                </div>
		           </div>
		       </div>
		       <div class="row mb">
		           <div class="col-md-6">Types of Leave Requested:(please tick)</div>
		       </div>
		       <div class="row mb-2x">
		           <div class="col-md-2">
		             <div class="form-check form-check-inline">
		                <input class="form-check-input" type="checkbox" id="an" name="left_reason[]" value="<?php if(isset($_POST['left_reason'])){echo $_POST['left_reason'];} ?>">
		                <label class="form-check-label" for="an">Annual</label>
		              </div>  
		           </div>
		           <div class="col-md-2">
		               <div class="form-check form-check-inline">
		                <input class="form-check-input" type="checkbox" id="medi" name="left_reason[]" value="<?php if(isset($_POST['left_reason'])){echo $_POST['left_reason'];} ?>">
		                <label class="form-check-label" for="medi">Medical</label>
		              </div>
		           </div>
		           <div class="col-md-2">
		               <div class="form-check form-check-inline">
		                <input class="form-check-input" type="checkbox" id="sick" name="left_reason[]" value="<?php if(isset($_POST['left_reason'])){echo $_POST['left_reason'];} ?>">
		                <label class="form-check-label" for="sick">Sick</label>
		              </div>
		           </div>
		           <div class="col-md-2">
		               <div class="form-check form-check-inline">
		                <input class="form-check-input" type="checkbox" id="reserve" name="left_reason[]" value="<?php if(isset($_POST['left_reason'])){echo $_POST['left_reason'];} ?>">
		                <label class="form-check-label" for="reserve">Reservist/Military</label>
		              </div>
		           </div>
		           <div class="col-md-2">
		               <div class="form-check form-check-inline">
		                <input class="form-check-input" type="checkbox" id="compa" name="left_reason[]" value="<?php if(isset($_POST['left_reason'])){echo $_POST['left_reason'];} ?>">
		                <label class="form-check-label" for="compa">Compassionate</label>
		              </div>
		           </div>
		           <div class="col-md-2">
		               <div class="form-check form-check-inline">
		                <input class="form-check-input" type="checkbox" id="other" name="left_reason[]" value="<?php if(isset($_POST['left_reason'])){echo $_POST['left_reason'];} ?>">
		                <label class="form-check-label" for="other">Others</label>
		              </div>
		           </div>
		       </div>
		       
		       <div class="row mb-5 mt-5">
		           <div class="col-md-6">
		               <input type="text" name="app_sign" value="<?php if(isset($_POST['app_sign'])){echo $_POST['app_sign'];} ?>"><br>
		               -------------------------------------------<br>
		               Applicant's Signature
		           </div>
		           <div class="col-md-6">
		           	<input type="date" name="app_date" value="<?php if(isset($_POST['app_date'])){echo $_POST['app_date'];} ?>"><br>
		               -----------------------------------------<br>
		               Date
		           </div>
		       </div><hr>
		       
		       <table class="table table-bordered">
		          <thead>
		            <tr>
		              <th colspan="2" class="text-center">For Official Use</th>
		            </tr>
		          </thead>
		          <tbody>
		            <tr>
		              <td>
		                <div class="form-check form-check-inline">
		                  <input type="radio" id="approve" name="left_accept" value="Approve" disabled>&nbsp;&nbsp;
		                  <label for="approve"> Approve</label>
		                </div>
		              </td>
		              <td>
		                <div class="form-check form-check-inline">
		                  <input type="radio" id="reject" name="left_accept" value="Rejected" disabled>&nbsp;&nbsp;
		                  <label for="reject">Rejected</label> 
		                </div>
		              </td>
		              
		          </tbody>
		      </table>
		      
		      <div class="row mt-5 mb-5">
		          <div class="col-md-6">
		          	<input type="text" name="approve_by" disabled><br>
		              -------------------------------------------<br>
		               Signed By<br><br><br>
		          </div>
		          <div class="col-md-6">
		          	<input type="date" name="approve_date" disabled><br>
		              -----------------------------------------<br>
		              Date
		          </div>
		      </div>

		      <div class="form-group">
		        <div class="col-md-12 btn_s">
		          <button class="btn btn-primary pull-right" name="submit_leave" type="submit">Submit</button>
		        </div>
		      </div>
		      <div class="clearfix"></div>
		 </form>
	</div>
</div>

<?php require_once('footer.php'); ?>