<?php require_once('header.php'); ?>

<?php 
    if (isset($_POST['cost_send'])) {
        $emcost_id = $_POST['emcost_id'];
        $cost_amount = $_POST['cost_amount'];
        $cost_reason = $_POST['cost_reason'];

        try {
            if (empty($cost_amount)) {
                throw new Exception('Your Cost Amount Fill Required');
            }
            if (empty($cost_reason)) {
                throw new Exception('Your Cost Reason Fill Required');
            }
            $current_month = date('Y-m');
            $statement = $pdo->prepare('INSERT INTO emp_costs(emp_id,cost_amount,cost_reason,monthly_cost_date) VALUES(?,?,?,?)');
            $statement->execute(array($emcost_id,$cost_amount,$cost_reason,$current_month));

            $success = 'Your Cost Added Successfully!!';
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
            <h1 class="main-title float-left">Add Employee Cost</h1>
            <ol class="breadcrumb float-right">
                <li class="breadcrumb-item">Employee Options</li>
                <li class="breadcrumb-item active">Add employee cost</li>
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
                <h3><i class="far fa-hand-pointer"></i> Add new employee cost</h3>
               	You can add here any employee cost.
            </div>
            <div class="col-md-8 mt-2">
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
            <div class="card-body">
                <form action="" method="POST">
	                <div class="col-md-8">
	                   	<div class="form-group">
	                        <select name="emcost_id" class="form-control">
                                    <?php 
                                    $stm = $pdo->prepare('SELECT * FROM employee_info');
                                    $stm->execute();
                                    $result = $stm->fetchAll(PDO::FETCH_ASSOC);
                                    foreach($result as $row) :
                                ?>
                                    <option value="<?php echo $row['id'] ?>"><?php echo $row['emp_fullname'];?></option>
                                <?php endforeach; ?>
                            </select>
	                    </div>
                    </div>

                    <div class="col-md-8">
	                   	<div class="form-group">
	                        <label for="amount">Amount<span class="text-danger">*</span></label>
	                        <input type="text" name="cost_amount" placeholder="Enter cost amount" class="form-control" id="amount" value="<?php if(isset($_POST['cost_amount'])){echo $_POST['cost_amount'];}?>">
	                    </div>
                    </div>

                    <div class="col-md-8">
	                   	<div class="form-group">
	                        <label for="costr">Cost Reason</label>
	                        <div>
	                            <textarea class="form-control" placeholder="Your Cost Reason" id="costr" name="cost_reason" value="<?php if(isset($_POST['cost_reason'])){echo $_POST['cost_reason'];}?>"></textarea>
	                        </div>
                        </div>
                    </div>

                    <div class="col-md-8">
                    	<div class="form-group text-right m-b-0">
	                        <button class="btn btn-primary" type="submit" name="cost_send">
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