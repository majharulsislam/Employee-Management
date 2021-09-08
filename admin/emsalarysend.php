<?php require_once('header.php'); ?>

<?php 

  if (isset($_POST['submit_salary'])) {
    $emp_id = $_POST['emp_id'];
    $amount = $_POST['amount'];
    $send_date = $_POST['send_date'];


    try {

      if (empty($emp_id)) {
        throw new Exception('Select Any name!');
      }
      if (empty($amount)) {
        throw new Exception('Amount is required!');
      }
      if (!is_numeric($amount)) {
        throw new Exception('Amount must be number!');
      }
      if (empty($send_date)) {
        throw new Exception('Please select date!');
      }

      // it's important query
      $thisMonth = substr($send_date,5,2);
      $thisYear = substr($send_date,0,4);
      $currentdate = $thisYear."-".$thisMonth;

      $statement = $pdo->prepare("SELECT * FROM empsalary WHERE YEAR(send_date)=? AND MONTH(send_date)=? AND emp_id=?");
      $statement->execute(array($thisYear,$thisMonth,$emp_id));
      $dataCounts = $statement->rowCount();

      if ($dataCounts != 1) {

        $insert = $pdo->prepare("INSERT INTO empsalary(emp_id,amount,send_date,currentdate) VALUES (?,?,?,?)");
        $insert->execute(array($emp_id,$amount,$send_date,$currentdate));

        $update = $pdo->prepare("UPDATE employee_info SET total_salary = total_salary+? WHERE id=?");
        $update->execute(array($amount,$emp_id));

        $notify = $pdo->prepare('INSERT INTO  notification (emp_id,type,status) VALUES (?,?,?)');
        $notify->execute(array($emp_id,'salary','unread'));
        header('location:emsalarysend.php');

        // mail send
        $emp = $pdo->prepare('SELECT * FROM employee_info WHERE id=?');
        $emp->execute(array($emp_id));
        $result = $emp->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $row) {
          $empname = $row['emp_fullname'];
          $emp_designation = $row['emp_designation'];
          $empmail = $row['emp_mail'];
          $emp_address = $row['emp_address'];
        }
        $final_msg = "Name :".$empname."\r\n";
        $final_msg .= "Designation :".$emp_designation."\r\n";
        $final_msg .= "Amount :".$amount."\r\n";
        $final_msg .= "Address :".$emp_address."\r\n";
        $final_msg .= "Date :".$send_date."\r\n";

        $admin = $pdo->prepare('SELECT * FROM admin_info WHERE admin_id=?');
        $admin->execute(array($_SESSION['logged_in']));
        $rslt = $admin->fetchAll(PDO::FETCH_ASSOC);
        foreach ($rslt as $admin_row){
          $admin_mail = $admin_row['admin_email'];
        }

        $headers = "From:".$admin_mail;
        
        mail($empmail,'Paid Your Salary',$final_msg,$headers);
       
        $success = 'Salary send successfully!';

      }
      else{
        throw new Exception('Salary Already Send!');
      }

      unset($_POST['amount']);
      unset($_POST['send_date']);
      
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
            <h1 class="main-title float-left">Employee Salary Form</h1>
            <ol class="breadcrumb float-right">
                <li class="breadcrumb-item">Salary Options</li>
                <li class="breadcrumb-item active">Send Salary</li>
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
                <h3><i class="far fa-hand-pointer"></i> Add New Employee Salary</h3>
               	You can add here employee salary.
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
                          <span><?php echo $success;?></span>
                        </div>
                    <?php endif; ?>
                </div>
                <form action="" method="POST">
	                <div class="col-md-8">
	                   	<div class="form-group">
	                        <select name="emp_id" class="form-control">
                                <?php 
                                    $view = $pdo->prepare('SELECT id,emp_fullname FROM employee_info');
                                    $view->execute();
                                    $view_all = $view->fetchAll(PDO::FETCH_ASSOC);
                                    foreach($view_all as $allemp) :
                                 ?>
                                <option value="<?php echo $allemp['id']; ?>"><?php echo $allemp['emp_fullname']; ?></option>
                                <?php endforeach; ?>
                            </select>
	                    </div>
                    </div>

                    <div class="col-md-8">
	                   	<div class="form-group">
	                        <label for="amount">Amount<span class="text-danger">*</span></label>
	                        <input type="number" name="amount" placeholder="Enter amount" class="form-control" id="amount" value="<?php if(isset($_POST['amount'])){echo $_POST['amount'];}?>">
	                    </div>
                    </div>

                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="sdate">Date<span class="text-danger">*</span></label>
                            <input type="date" name="send_date" class="form-control" id="sdate" value="<?php if(isset($_POST['send_date'])){echo $_POST['send_date'];}?>">
                        </div>
                    </div>

                    <div class="col-md-8">
                    	<div class="form-group text-right m-b-0">
	                        <button class="btn btn-primary" type="submit" name="submit_salary">
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

<?php 
  
  $admin = $pdo->prepare('SELECT * FROM admin_info WHERE admin_id=?');
      $admin->execute(array($_SESSION['logged_in']));
      $rslt = $admin->fetchAll(PDO::FETCH_ASSOC);
      foreach ($rslt as $admin_row){
        $admin_mail = $admin_row['admin_email'];
  }

 ?>


<?php require_once('footer.php'); ?>