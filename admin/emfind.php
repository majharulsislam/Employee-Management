<?php require_once('header.php'); ?>

<!-- Start Breadcame -->
<div class="row">
    <div class="col-xl-12">
        <div class="breadcrumb-holder">
            <h1 class="main-title float-left">Find Employee</h1>
            <ol class="breadcrumb float-right">
                <li class="breadcrumb-item">Home</li>
                <li class="breadcrumb-item active">Find Employee</li>
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
                <h3><i class="fas fa-table"></i> Find Employee</h3>
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
			                            	<th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1">Employee Id
			                            	</th>
			                            	<th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1">Phone No
			                            	</th>
			                            	<th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1">Email
			                            	</th>
			                            	<th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1">Designation
			                            	</th>
			                            </tr>
                        			</thead>
                    				<tbody>
                    					<?php 
                    						$stm = $pdo->prepare('SELECT * FROM employee_info ORDER BY employee_id ASC');
                    						$stm->execute();
                    						$result = $stm->fetchAll(PDO::FETCH_ASSOC);
                    						$sl = 1;
                    						foreach($result as $row) :
                    					 ?>
				                    	<tr role="row">
				                    		<td><?php echo $sl;$sl++; ?></td>
				                    		<td><?php echo $row['emp_fullname']; ?></td>
				                    		<td>EMID - <?php echo $row['employee_id']; ?></td>
				                    		<td>0<?php echo $row['emp_phone']; ?></td>
				                    		<td><?php echo $row['emp_mail']; ?></td>
				                    		<td><?php echo $row['emp_designation']; ?></td>
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