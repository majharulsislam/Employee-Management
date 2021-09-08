<?php require_once('header.php'); ?>

<!-- Start Breadcame -->
<div class="row">
    <div class="col-xl-12">
        <div class="breadcrumb-holder">
            <h1 class="main-title float-left">Salary History</h1>
            <ol class="breadcrumb float-right">
                <li class="breadcrumb-item">Home</li>
                <li class="breadcrumb-item active">Salary History</li>
            </ol>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<!-- End Breadcame -->

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
        <div class="card mb-3">
            <div class="card-header">
                <h3><i class="fas fa-table"></i> Employee Salary History</h3>
               	If you find any data of employee please search here employee any data.
                <a target="_blank" href="emAll.php">(more details)</a>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                    	<div class="row">
                    		<div class="col-sm-12">
                    			<table id="dataTable" class="table table-bordered table-hover display dataTable no-footer" style="width: 100%;" role="grid" aria-describedby="dataTable_info">
                        			<thead>
			                            <tr role="row">
			                            	<th class="sorting_asc" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-sort="ascending">SL
			                            	</th>
			                            	<th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1">Name
			                            	</th>
			                            	<th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1">Phone No
			                            	</th>
			                            	<th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1">Amount
			                            	</th>
			                            	<th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1">Date
			                            	</th>
			                            </tr>
                        			</thead>
                    				<tbody>
				                    	<?php 
					                        $salaryH = $pdo->prepare('SELECT * FROM empsalary');
					                        $salaryH->execute();
					                        $result = $salaryH->fetchAll(PDO::FETCH_ASSOC);
					                        $sl = 1;
					                        foreach ($result as $salaries) :
                     					?>
					                    <tr>
					                      <td><?php echo $sl;$sl++; ?></td>
					                      <?php 
					                        $stm = $pdo->prepare('SELECT * FROM employee_info');
					                        $stm->execute();
					                        $allem = $stm->fetchAll(PDO::FETCH_ASSOC);
					                        foreach($allem as $row) :
					                          if($salaries['emp_id'] == $row['id']) :
					                      ?>
					                        <td><?php echo $row['emp_fullname']; ?></td>
					                        <td>+880<?php echo $row['emp_phone']; ?></td>
					                      <?php endif; endforeach; ?>
					                      <td>$<?php echo $salaries['amount'] ?></td>
					                      <td>
					                          <?php 
					                              $send_date = $salaries['send_date'];

					                              $day = substr($send_date,8,2);
					                              $month = substr($send_date,5,2);
					                              $year = substr($send_date,0,4);

					                              if($month == '01') { $month = 'Jan';}
					                              if($month == '02') { $month = 'Feb';}
					                              if($month == '03') { $month = 'Mar';}
					                              if($month == '04') { $month = 'Apr';}
					                              if($month == '05') { $month = 'May';}
					                              if($month == '06') { $month = 'Jun';}
					                              if($month == '07') { $month = 'July';}
					                              if($month == '08') { $month = 'Aug';}
					                              if($month == '09') { $month = 'Sep';}
					                              if($month == '10') { $month = 'Oct';}
					                              if($month == '11') { $month = 'Nov';}
					                              if($month == '12') { $month = 'Dec';}

					                              echo $day." ".$month." ".$year;
					                           ?>
					                      </td>
					                    </tr>
					                  <?php endforeach; ?>
				                    </tbody>
				                </table>
				            </div>
				        </div>
        			</div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once('footer.php'); ?>