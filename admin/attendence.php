<?php require_once('header.php'); ?>

<?php 

    if (isset($_POST['present'])) {

        $emp_id = $_POST['emp_id'];
        $attend_status = $_POST['attend_status'];

        try {
            if (empty($emp_id)) {
                throw new Exception('Please select your name');
            }
            if (empty($attend_status)) {
                throw new Exception('Please select your name');
            }

           
            $today_date = date('d-m-Y');
            $stm = $pdo->prepare('SELECT * FROM attendence WHERE emp_id=? AND today_date=?');
            $stm->execute(array($emp_id,$today_date));
            $exists = $stm->rowCount();

            if($exists == 1){
                $error = 'You already responsed!';
            }
            else{
                date_default_timezone_set('Asia/Dhaka');
                $present_time = date('h:i:s a', time());
                $today_date = date('d-m-Y');

                $statement = $pdo->prepare('INSERT INTO attendence(emp_id,attend_status,present_time,today_date) VALUES (?,?,?,?)');
                $statement->execute(array($emp_id,$attend_status,$present_time,$today_date));

                header('location:attendence.php');
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
            <h1 class="main-title float-left">Attendence Sheet</h1>
            <ol class="breadcrumb float-right">
                <li class="breadcrumb-item">Employee Options</li>
                <li class="breadcrumb-item active">Addendence Sheet</li>
            </ol>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<!-- End Breadcame -->


<!-- Attendence Form -->
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
    <p style="font-size:17px">Enter your present here <small style="color:green">(If you are present select Yes, absent select No or others select Holiday)</small></p style="font-size:17px">
    <form action="" method="POST">
        <div class="row">
            <div class="col-md-4">
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
            <div class="col-md-4">
                <div class="form-group">
                    <select name="attend_status" class="form-control">
                        <option value="p">Yes</option>
                        <option value="a">No</option>
                        <option value="h">Holiday</option>
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group m-b-0">
                    <button class="btn btn-primary" type="submit" name="present">
                        Submit
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>

<!-- Attendence Sheet -->
<div class="row">
	<div class="col-md-12">
        <div class="table-responsive">
           <table class="table table-bordered bg-light">
              <thead>
                <tr>
                  <th scope="col" colspan="31">Date: <?php echo date('F - Y') ?></th>
                </tr>
              </thead>
              <tbody>
                <tr>
                    <th>Name</th>
                    <?php for($i = 1;$i <= date('t');$i++) : ?>
                    <td><?php echo $i; ?></td>
                    <?php endfor; ?>
                </tr>

                <?php 
                    $viewdata = $pdo->prepare('SELECT * FROM employee_info ORDER BY id DESC');
                    $viewdata->execute();
                    $result = $viewdata->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($result as $row) :
                ?>
                <tr>
                    <td><?php echo  $row['emp_fullname']; ?></td>

                    <?php 
                        $statement = $pdo->prepare('SELECT * FROM attendence WHERE emp_id=?');
                        $statement->execute(array($row['id']));
                        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                        foreach ($result as $attend) :
                    ?>
                    <td>
                        <?php
                            if($attend['attend_status'] == 'p') {
                                if($attend['present_time'] < '08:01:00 am' AND $attend['present_time'] < '12:00:00 pm') {
                                    echo '<span style="color:green;font-weight:500">P</span>';
                                }
                                else{
                                    echo '<span style="color:red;font-weight:500">L</span>';
                                }
                            }
                            else{
                                if($attend['attend_status'] == 'a'){
                                    echo '<span style="color:red;font-weight:500">A</span>';
                                }
                                else{
                                    echo '<span style="color:blue;font-weight:500">H</span>';
                                }
                            }
                        ?>  
                    </td>
                    <?php endforeach; ?>
                </tr>
                <?php endforeach; ?>    
              </tbody>
            </table>
        </div>
    </div>
</div>

<?php require_once('footer.php'); ?>