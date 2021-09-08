<?php require_once('header.php'); ?>
<!-- Start breadcame -->
    <div class="row">
        <div class="col-xl-12">
            <div class="breadcrumb-holder">
                <h1 class="main-title float-left">Employee Dashboard</h1>
                <ol class="breadcrumb float-right">
                    <li class="breadcrumb-item">Home</li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
<!-- End Breadcaame -->

    <div class="row">
        <div class="col-md-12">
            <div class="view_all"><a href="index2.php" class="btn btn-primary pull-right">View All</a></div>
            <div class="this_month"><a href="index.php" class="btn btn-success pull-right">This Month</a></div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-md-4">
            <div class="card-box noradius noborder bg-secondary">
                <i class="far fa-user float-right text-white"></i>
                <h6 class="text-white text-uppercase m-b-20">All Employee</h6>
                <h1 class="m-b-20 text-white counter">
                    <?php 
                        $stm = $pdo->prepare('SELECT * FROM employee_info');
                        $stm->execute();
                        $userData = $stm->rowCount();
                        echo $userData;
                     ?>
                </h1>
                <span class="text-white">Total Employee In Company</span>
            </div>
        </div>

        <div class="col-xs-12 col-md-4">
            <div class="card-box noradius noborder bg-danger">
                <i class="far fa-check-square float-right text-white"></i>
                <h6 class="text-white text-uppercase m-b-20">Complete Projects</h6>
                    <?php
                        $id = $_SESSION['logged_emp'];
                        $myname = $pdo->prepare('SELECT * FROM employee_info WHERE id=?');
                        $myname->execute(array($id));
                        $names = $myname->fetchAll(PDO::FETCH_ASSOC);
                        foreach ($names as $name) {
                           $mynames = $name['emp_fullname'];
                        }
                     ?>
                     <?php
                        $stm = $pdo->prepare('SELECT * FROM projects WHERE completed=? AND project_assign=?');
                        $stm->execute(array(1,$mynames));
                        $total_project  = $stm->rowCount();
                    ?>
                    
                <h1 class="m-b-20 text-white counter"><?php echo $total_project;?></h1>
                <span class="text-white">All Completed Project</span>
            </div>
        </div>

        <div class="col-xs-12 col-md-4">
            <div class="card-box noradius noborder bg-dark">
                <i class="fas fa-dollar-sign float-right text-white"></i>
                <h6 class="text-white text-uppercase m-b-20">Salaries</h6>
                    <?php
                        $stm = $pdo->prepare('SELECT * FROM empsalary WHERE emp_id=?');
                        $stm->execute(array($_SESSION['logged_emp']));
                        $rslt = $stm->fetchAll(PDO::FETCH_ASSOC);
                        $total_salary = 0;
                        foreach ($rslt as $row) {
                            $total_salary = $total_salary + $row['amount'];
                        }
                    ?>
                <h1 class="m-b-20 text-white counter"><?php echo $total_salary; ?></h1>
                <span class="text-white">Total Salary or Earn</span>
            </div>
        </div>

        <div class="col-xs-12 col-md-4">
            <div class="card-box noradius noborder bg-primary">
                <i class="fas fa-funnel-dollar float-right text-white"></i>
                <h6 class="text-white text-uppercase m-b-20">Spent</h6>
                
                    <?php
                        $stm = $pdo->prepare('SELECT * FROM emp_costs WHERE emp_id=?');
                        $stm->execute(array($_SESSION['logged_emp']));
                        $total_spend = $stm->fetchAll(PDO::FETCH_ASSOC);
                        $total_spend_amount = 0;
                        foreach($total_spend as $spend){
                            $total_spend_amount = $total_spend_amount + $spend['cost_amount'];
                        }
                        
                    ?>
                <h1 class="m-b-20 text-white counter"><?php echo $total_spend_amount; ?></h1>
                <span class="text-white">Current Month Spent</span>
            </div>
        </div>

        <div class="col-xs-12 col-md-4">
            <div class="card-box noradius noborder bg-success">
                <i class="fas fa-hand-holding-usd float-right text-white"></i>
                <h6 class="text-white text-uppercase m-b-20">Balance</h6>
                <h1 class="m-b-20 text-white counter">
                    <?php 
                        $savings = $total_salary - $total_spend_amount;
                        echo $savings;
                    ?>
                </h1>
                <span class="text-white">Current Month Balance</span>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6" style="margin:30px 0;">
            <div id="calendar">
                <div id="calendar_header"><i class="icon-chevron-left"></i><h1></h1><i class="icon-chevron-right"></i>
                </div>
                <div id="calendar_weekdays"></div>
                <div id="calendar_content"></div>
            </div>
        </div>
        <div class="col-md-6" style="margin:40px 0;border-left:2px solid green;border-bottom: 2px solid green;">
            <div class="live_clock">
                 <div class="clock-box">
                  <div class="clock">
                    <div class="number number-1">1</div>
                    <div class="number number-2">2</div>
                    <div class="number number-3">3</div>
                    <div class="number number-4">4</div>
                    <div class="number number-5">5</div>
                    <div class="number number-6">6</div>
                    <div class="number number-7">7</div>
                    <div class="number number-8">8</div>
                    <div class="number number-9">9</div>
                    <div class="number number-10">10</div>
                    <div class="number number-11">11</div>
                    <div class="number number-12">12</div>

                    <div class="hands second" second-hand></div>
                    <div class="hands minute" minute-hand></div>
                    <div class="hands hour" hour-hand></div>
                    <div class="circle"></div>
                  </div>
                </div>
                <h2 class="text-center" style="margin-top:50px">You See The Time Here</h2>
            </div>
        </div>
    </div>

<?php require_once('footer.php'); ?>