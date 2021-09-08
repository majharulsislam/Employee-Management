<?php require_once('header.php'); ?>

<?php 

  if (isset($_POST['sendSpend'])) {
    $spendsource = $_POST['spendsource'];
    $spendamount = $_POST['spendamount'];
    $spend_date = $_POST['spend_date'];


    try {

      if (empty($spendsource)) {
        throw new Exception('Your spend source can\'t be empty!');
      }
      if (empty($spendamount)) {
        throw new Exception('Amount is required!');
      }
      if (!is_numeric($spendamount)) {
        throw new Exception('Amount must be number!');
      }
      if (empty($spend_date)) {
        throw new Exception('Please select date!');
      }

      $thisMonth = substr($spend_date,5,2);
      $thisYear = substr($spend_date,0,4);
      $spendmonth = $thisYear."-".$thisMonth;
      // insert database
      $stm = $pdo->prepare("INSERT INTO spending(spend_source,spend_amount,spend_date,spend_month) VALUES (?,?,?,?)");
      $stm->execute(array($spendsource,$spendamount,$spend_date,$spendmonth));

      $success = "Your Spend Added Successfully!";
      

      unset($_POST['spendsource']);
      unset($_POST['spendamount']);
      unset($_POST['spend_date']);
      
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
            <h1 class="main-title float-left">Company's Spend</h1>
            <ol class="breadcrumb float-right">
                <li class="breadcrumb-item">Company Spend</li>
                <li class="breadcrumb-item active">New Spend</li>
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
                <h3><i class="far fa-hand-pointer"></i> Add Company Spend Source</h3>
               	You can add here company spend source and amount.
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
                            <label for="spends">Spend Source<span class="text-danger">*</span></label>
                            <input type="text" name="spendsource" placeholder="Enter spend source" class="form-control" id="spends" value="<?php if(isset($_POST['spendsource'])){echo $_POST['spendsource'];}?>">
                        </div>
                    </div>

                    <div class="col-md-8">
	                   	<div class="form-group">
	                        <label for="samount">Earn Amount<span class="text-danger">*</span></label>
	                        <input type="number" name="spendamount" placeholder="Enter spend amount" class="form-control" id="samount" value="<?php if(isset($_POST['spendamount'])){echo $_POST['spendamount'];}?>">
	                    </div>
                    </div>

                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="spdate">Date<span class="text-danger">*</span></label>
                            <input type="date" name="spend_date" class="form-control" id="spdate" value="<?php if(isset($_POST['spend_date'])){echo $_POST['spend_date'];}?>">
                        </div>
                    </div>

                    <div class="col-md-8">
                    	<div class="form-group text-right m-b-0">
	                        <button class="btn btn-primary" type="submit" name="sendSpend">
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