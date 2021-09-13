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

                <?php 
                    $stm = $pdo->prepare('SELECT * FROM attendence WHERE emp_id=?');
                    $stm->execute(array($_SESSION['logged_emp']));
                    $result = $stm->fetchAll(PDO::FETCH_ASSOC);

                    foreach($result as $row) :
                ?>
                <tr>
                    <td>
                        <?php 
                            $stam = $pdo->prepare('SELECT * FROM employee_info WHERE id=?');
                            $stam->execute(array($row['emp_id']));
                            $rslt = $stam->fetchAll(PDO::FETCH_ASSOC);

                            foreach ($rslt as $emp){
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
              </tbody>
            </table>
        </div>
    </div>
</div>

<table id="maja"></table>
<?php require_once('footer.php'); ?>