<?php require_once('header.php'); ?>

<!-- Start Breadcame -->
<div class="row">
    <div class="col-xl-12">
        <div class="breadcrumb-holder">
            <h1 class="main-title float-left">Employee Cost</h1>
            <ol class="breadcrumb float-right">
                <li class="breadcrumb-item">Employee Options</li>
                <li class="breadcrumb-item active">Employee Cost History</li>
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
                <h3><i class="fas fa-table"></i> Employee Cost Details</h3>
                <i>Costing: </i> When you can add employee cost then show here employee costing descriptions.
            </div>

            <div class="card-body">
                <table class="table table-responsive-xl table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">#SL</th>
                            <th scope="col">Employee Name</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Cost Reason</th>
                            <th scope="col">Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $current_cost_month = date('Y-m');
                            $stm = $pdo->prepare('SELECT * FROM emp_costs WHERE monthly_cost_date=? ORDER BY cost_date DESC');
                            $stm->execute(array($current_cost_month));
                            $result = $stm->fetchAll(PDO::FETCH_ASSOC);
                            $sl = 1;
                            $total = 0;
                            foreach($result as $row) :
                                $total = $total + $row['cost_amount'];
                        ?>
                        <tr>
                            <th scope="row"><?php echo $sl;$sl++; ?></th>
                            <?php 
                                $statement = $pdo->prepare('SELECT * FROM employee_info');
                                $statement->execute();
                                $rslt = $statement->fetchAll(PDO::FETCH_ASSOC);
                                foreach ($rslt as $view_emp ):
                                    if($view_emp['id'] == $row['emp_id']) :
                             ?>
                            <td><?php echo $view_emp['emp_fullname']; ?></td>
                            <?php endif; endforeach; ?>
                            <td><?php echo $row['cost_amount']; ?></td>
                            <td><?php echo $row['cost_reason']; ?></td>
                            <td><?php echo date('j F Y ,g:i a',strtotime($row['cost_date'])); ?></td>
                        </tr>
                    <?php endforeach; ?>
                    <h4>Total Cost = <?php echo $total;?></h4>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php require_once('footer.php'); ?>