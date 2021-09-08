<?php require_once('header.php'); ?>

<!-- Start Breadcame -->
<div class="row">
    <div class="col-xl-12">
        <div class="breadcrumb-holder">
            <h1 class="main-title float-left">Project Overviews</h1>
            <ol class="breadcrumb float-right">
                <li class="breadcrumb-item">Projects</li>
                <li class="breadcrumb-item active">Project Overviews</li>
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
                <h3><i class="fas fa-upload"></i> Our Project Status</h3>
               	If you find any data of project please search here.
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
			                            	<th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1">Client Name
			                            	</th>
			                            	<th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1">Budget
			                            	</th>
			                            	<th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1">Project Assign
			                            	</th>
			                            	<th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1">Start Date
			                            	</th>
			                            	<th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1">End Date
			                            	</th>
			                            </tr>
                        			</thead>
                    				<tbody>
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
                                            $stm = $pdo->prepare('SELECT * FROM projects WHERE project_assign=? ORDER BY project_id DESC');
                                            $stm->execute(array($mynames));
                                            $result = $stm->fetchAll(PDO::FETCH_ASSOC);
                                            $sl = 1;
                                            foreach ($result as $row) :
                                                $completed = $row['completed'];
                                                if($completed != 1) :
                                        ?>
				                    	<tr role="row">
				                    		<td><?php echo $sl;$sl++; ?></td>
				                    		<td><?php echo $row['client_name'] ?></td>
				                    		<td>$<?php echo $row['budget']; ?></td>
				                    		<td><?php echo $row['project_assign']; ?></td>
				                    		<td>
                                                <?php 
                                                    $start_date = $row['start_date'];
                                                    $day = substr($start_date,8,2);
                                                    $month = substr($start_date,5,2);
                                                    $year = substr($start_date,0,4);

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

                                                    echo $day.' '.$month.' '.$year;
                                                 ?>                  
                                            </td>
				                    		<td>
                                                <?php 
                                                    $end_date = $row['end_date'];
                                                    $day = substr($end_date,8,2);
                                                    $month = substr($end_date,5,2);
                                                    $year = substr($end_date,0,4);

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

                                                    echo $day.' '.$month.' '.$year;
                                                ?>                
                                            </td>
				                    	</tr>
                                    <?php endif; endforeach; ?>
				                    </tbody>
				                </table>
				            </div>
				        </div>
        			</div>
                </div>
            </div>
        </div>
    </div>
</div><br>

<div class="row">
    <div class="col-xs-12 col-sm-12">
        <div class="card mb-3">
            <div class="card-header">
                <h3><i class="fas fa-check-square"></i> Completed Project</h3>
                <i>Notice: </i> All Complited Project Show here.
            </div>

            <div class="card-body">
                <table class="table table-responsive-xl table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">#SL</th>
                            <th scope="col">Client Name</th>
                            <th scope="col">Earn</th>
                            <th scope="col">Project Work</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $statement = $pdo->prepare('SELECT * FROM projects WHERE project_assign=? ORDER BY project_id DESC');
                            $statement->execute(array($mynames));
                            $rslt = $statement->fetchAll(PDO::FETCH_ASSOC);
                            $sl = 1;
                            foreach ($rslt as $singleProject) :
                                $complete = $singleProject['completed'];
                                if ($complete != 0) :
                         ?>
                        <tr>
                            <th scope="row"><?php echo $sl;$sl++; ?></th>
                            <td><?php echo $singleProject['client_name']; ?></td>
                            <td>$<?php echo $singleProject['budget']; ?></td>
                            <td><?php echo $singleProject['project_assign']; ?></td>
                        </tr>
                    <?php endif; endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php require_once('footer.php'); ?>

<!-- Delete project -->
<?php 
    if (isset($_REQUEST['delid'])) {
       $delid = $_REQUEST['delid'];

       $stm = $pdo->prepare('DELETE FROM projects WHERE project_id=?');
       $stm->execute(array($delid));

       header('location:projectOverview.php');
    }
 ?>

