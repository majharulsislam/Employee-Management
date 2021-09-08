<?php require_once('header.php'); ?>
<!-- Start breadcame -->
    <div class="row">
        <div class="col-xl-12">
            <div class="breadcrumb-holder">
                <h1 class="main-title float-left">Admin Dashboard</h1>
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
            <div class="card-box noradius noborder bg-success">
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
                <i class="fas fa-dollar-sign float-right text-white"></i>
                <h6 class="text-white text-uppercase m-b-20">Salaries</h6>
                    <?php
                        $stm = $pdo->prepare('SELECT * FROM empsalary');
                        $stm->execute();
                        $rslt = $stm->fetchAll(PDO::FETCH_ASSOC);
                        $total_salary = 0;
                        foreach ($rslt as $row) {
                            $total_salary = $total_salary + $row['amount'];
                        }
                    ?>
                <h1 class="m-b-20 text-white counter"><?php echo $total_salary; ?></h1>
                <span class="text-white">Total Salary Paid</span>
            </div>
        </div>

        <div class="col-xs-12 col-md-4">
            <div class="card-box noradius noborder bg-info">
                <i class="fa fa-cubes float-right text-white"></i>
                <h6 class="text-white text-uppercase m-b-20">Projects</h6>
                    <?php
                        $stm = $pdo->prepare('SELECT * FROM projects WHERE completed=?');
                        $stm->execute(array(1));
                        $total_project  = $stm->rowCount();
                    ?>
                <h1 class="m-b-20 text-white counter"><?php echo $total_project;?></h1>
                <span class="text-white">Total Completed Project</span>
            </div>
        </div>

        <div class="col-xs-12 col-md-4">
            <div class="card-box noradius noborder bg-purple">
                <i class="far fa-money-bill-alt float-right text-white"></i>
                <h6 class="text-white text-uppercase m-b-20">Earns</h6>
                    <?php
                        $statement = $pdo->prepare('SELECT * FROM projects');
                        $statement->execute();
                        $rslt = $statement->fetchAll(PDO::FETCH_ASSOC);
                        $project_earn = 0;
                        foreach ($rslt as $singleProject) {
                            $complete = $singleProject['completed'];
                            if ($complete != 0) {
                                $project_earn =  $project_earn + $singleProject['budget'];
                            }
                        }
                    ?>

                    <?php
                        $stm = $pdo->prepare('SELECT * FROM earning');
                        $stm->execute();
                        $total_earn = $stm->fetchAll(PDO::FETCH_ASSOC);
                        $total_earn_amount = 0;
                        foreach($total_earn as $earn){
                            $total_earn_amount = $total_earn_amount + $earn['earn_amount'];
                        }
                        
                    ?>
                <h1 class="m-b-20 text-white counter"><?php $earning =  $total_earn_amount+$project_earn; echo $earning;?></h1>
                <span class="text-white">Company's Total Earn</span>
            </div>
        </div>

        <div class="col-xs-12 col-md-4">
            <div class="card-box noradius noborder bg-warning">
                <i class="fas fa-funnel-dollar float-right text-white"></i>
                <h6 class="text-white text-uppercase m-b-20">Spent</h6>
                
                    <?php
                        $stm = $pdo->prepare('SELECT * FROM spending');
                        $stm->execute();
                        $total_spend = $stm->fetchAll(PDO::FETCH_ASSOC);
                        $total_spend_amount = 0;
                        foreach($total_spend as $spend){
                            $total_spend_amount = $total_spend_amount + $spend['spend_amount'];
                        }
                        
                    ?>
                <h1 class="m-b-20 text-white counter"><?php $total_spent =  $total_spend_amount+$total_salary; echo $total_spent;?></h1>
                <span class="text-white">Company's Total Spent</span>
            </div>
        </div>
        <div class="col-xs-12 col-md-4">
            <div class="card-box noradius noborder bg-primary">
                <i class="fas fa-hand-holding-usd float-right text-white"></i>
                <h6 class="text-white text-uppercase m-b-20">Balance</h6>
                <h1 class="m-b-20 text-white counter">
                    <?php 
                        $savings = $earning - ($total_spend_amount+$total_salary);
                        echo $savings;
                    ?>
                </h1>
                <span class="text-white">Company's Total Balance</span>
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