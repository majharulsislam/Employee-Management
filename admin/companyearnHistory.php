<?php require_once('header.php'); ?>

<!-- Start Breadcame -->
<div class="row">
    <div class="col-xl-12">
        <div class="breadcrumb-holder">
            <h1 class="main-title float-left">Earn History</h1>
            <ol class="breadcrumb float-right">
                <li class="breadcrumb-item">Company Earn</li>
                <li class="breadcrumb-item active">Earn History</li>
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
                <h3><i class="fas fa-table"></i> Company Earn History</h3>
               	If you find any earn source please search here any data.
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
			                            	<th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1">Source
			                            	</th>
			                            	<th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1">Amount
			                            	</th>
			                            	<th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1">Date
			                            	</th>
			                            </tr>
                        			</thead>
                    				<tbody>
				                   	<?php 
				                        $stm = $pdo->prepare('SELECT * FROM earning ORDER BY earn_date DESC');
				                        $stm->execute();
				                        $result = $stm->fetchAll(PDO::FETCH_ASSOC);
				                        $sl=1;
				                        foreach($result as $row) :
				                     ?>
					                    <tr>
					                      <td><?php echo $sl;$sl++; ?></td>
					                      <td><?php echo $row['earn_source']; ?></td>
					                      <td>$<?php echo $row['earn_amount']; ?></td>
					                      <td>
					                        <?php 
					                          $earn_date = $row['earn_date'];
					                          $day = substr($earn_date,8,2);
					                          $month = substr($earn_date,5,2);
					                          $year = substr($earn_date,0,4);

					                          if($month == '01'){$month = 'JAN';}
					                          if($month == '02'){$month = 'FEB';}
					                          if($month == '03'){$month = 'MAR';}
					                          if($month == '04'){$month = 'APR';}
					                          if($month == '05'){$month = 'MAY';}
					                          if($month == '06'){$month = 'JUN';}
					                          if($month == '07'){$month = 'JUL';}
					                          if($month == '08'){$month = 'AUG';}
					                          if($month == '09'){$month = 'SEP';}
					                          if($month == '10'){$month = 'OCT';}
					                          if($month == '11'){$month = 'NOV';}
					                          if($month == '12'){$month = 'DEC';}

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