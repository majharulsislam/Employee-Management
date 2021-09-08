<?php require_once('header.php'); ?>

<?php 

  if (isset($_POST['earn_send'])) {
    $earns = $_POST['earns'];
    $earnamount = $_POST['earnamount'];
    $earn_date = $_POST['earn_date'];


    try {

      if (empty($earns)) {
        throw new Exception('Your earn source can\'t be empty!');
      }
      if (empty($earnamount)) {
        throw new Exception('Amount is required!');
      }
      if (!is_numeric($earnamount)) {
        throw new Exception('Amount must be number!');
      }
      if (empty($earn_date)) {
        throw new Exception('Please select date!');
      }

      $thisMonth = substr($earn_date,5,2);
      $thisYear = substr($earn_date,0,4);
      $currentdate = $thisYear."-".$thisMonth;
      // insert database
      $stm = $pdo->prepare("INSERT INTO earning(earn_source,earn_amount,earn_date,currentdate) VALUES (?,?,?,?)");
      $stm->execute(array($earns,$earnamount,$earn_date,$currentdate));

      $success = "New Earn Added Successfully!";
      

      unset($_POST['earns']);
      unset($_POST['earnamount']);
      unset($_POST['earn_date']);
      
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
            <h1 class="main-title float-left">Company's Earn</h1>
            <ol class="breadcrumb float-right">
                <li class="breadcrumb-item">Company Earn</li>
                <li class="breadcrumb-item active">New Earn</li>
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
                <h3><i class="far fa-hand-pointer"></i> Add Company Earn Source</h3>
               	You can add here company earn source and amount.
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
                            <label for="earns">Earn Source<span class="text-danger">*</span></label>
                            <input type="text" name="earns" placeholder="Enter earn source" class="form-control" id="earns" value="<?php if(isset($_POST['earns'])){echo $_POST['earns'];}?>">
                        </div>
                    </div>

                    <div class="col-md-8">
	                   	<div class="form-group">
	                        <label for="eamount">Earn Amount<span class="text-danger">*</span></label>
	                        <input type="number" name="earnamount" placeholder="Enter earn amount" class="form-control" id="eamount" value="<?php if(isset($_POST['earnamount'])){echo $_POST['earnamount'];}?>">
	                    </div>
                    </div>

                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="sdate">Date<span class="text-danger">*</span></label>
                            <input type="date" name="earn_date" class="form-control" id="sdate" value="<?php if(isset($_POST['earn_date'])){echo $_POST['earn_date'];}?>">
                        </div>
                    </div>

                    <div class="col-md-8">
                    	<div class="form-group text-right m-b-0">
	                        <button class="btn btn-primary" type="submit" name="earn_send">
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