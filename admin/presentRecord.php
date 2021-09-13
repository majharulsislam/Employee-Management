<?php require_once('header.php'); ?>

<!-- Start Breadcame -->
<div class="row">
    <div class="col-xl-12">
        <div class="breadcrumb-holder">
            <h1 class="main-title float-left">Present Record</h1>
            <ol class="breadcrumb float-right">
                <li class="breadcrumb-item">Employee Options</li>
                <li class="breadcrumb-item active">Present Record</li>
            </ol>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<!-- End Breadcame -->


<!-- Record Form -->
<div class="card-body">
    <div class="row">
        <div class="col-md-7">
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
    </div>
    <p style="font-size:17px">Please Select Name <small style="color:green">(If you can check any employee present record then select name & enter)</small></p style="font-size:17px">
    <form action="" method="POST">
        <div class="row">
            <div class="col-md-3">
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
            <div class="col-md-3">
                <div class="form-group">
                    <select class="form-control" name="select_month" id="select_month">
                          <option value="">- select month -</option>
                        <?php for($j=1;$j <= 12;$j++) : ?>
                          <option value="<?php echo $j; ?>"><?php echo $j; ?></option>
                        <?php endfor; ?>
                    </select>
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <select class="form-control" name="select_year" id="select_year">
                        <option value="">- select year -</option>
                        <?php for($i=2020;$i <= date('Y');$i++) : ?>
                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                        <?php endfor; ?>
                    </select>
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group m-b-0">
                    <button class="btn btn-primary" type="submit" name="present_record">
                        Submit
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>

<!-- Attendence Record -->
<div class="row">
	<div class="col-md-8">
        <div class="table-responsive">
           <table class="table table-bordered bg-light">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Status</th>
                  <th>Date</th>
                </tr>
              </thead>
              <tbody>
                <?php if(isset($_POST['present_record'])) :
                    $emp_id = $_POST['emp_id'];
                    $select_month = $_POST['select_month'];
                    $select_year = $_POST['select_year'];
                    
                    if (empty($select_year) || empty($select_month)) {
                      echo "<span style=\"color:red;font-size:20px;\">"."No Data View. Please Select year and month!"."</span>";
                    }

                    $stm = $pdo->prepare('SELECT * FROM attendence WHERE emp_id=? AND MONTH(today_date)=? AND YEAR(today_date)=? ORDER BY today_date ASC');
                    $stm->execute(array($emp_id,$select_month,$select_year));
                    $result = $stm->fetchAll(PDO::FETCH_ASSOC);

                    $totalday = $stm->rowCount();

                    foreach($result as $row) :

                 ?>
                    <tr>
                        <td>
                            <?php 
                                $stm = $pdo->prepare('SELECT * FROM employee_info WHERE id=?');
                                $stm->execute(array($row['emp_id']));
                                $result = $stm->fetchAll(PDO::FETCH_ASSOC);

                                foreach ($result as $emp){
                                    echo $emp['emp_fullname'];
                                }
                             ?>
                        </td>
                        <td><?php echo $row['attend_status']; ?></td>
                        <td>
                            <?php 
                                $date = $row['today_date'];

                                $day = substr($date,8,2);
                                $month = substr($date,5,2);
                                $year = substr($date,0,4);

                                echo $day.'-'.$month.'-'.$year;
                            ?>
                        </td>
                    </tr> 
                <?php endforeach; ?>
                <h6 style="color:#0f9df7">Total Attend Day = <?php echo $totalday; ?></h6 style="color:green">
            <?php endif; ?>
              </tbody>
            </table>
        </div>
    </div>
</div>

<table id="maja"></table>
<?php require_once('footer.php'); ?>