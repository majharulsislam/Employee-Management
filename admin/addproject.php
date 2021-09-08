<?php require_once('header.php'); ?>

<?php 
    if (isset($_POST['addproject'])) {
        $client_name = $_POST['client_name'];
        $client_budget = $_POST['client_budget'];
        $project_assign = $_POST['project_assign'];
        $start_date = $_POST['start_date'];
        $end_date = $_POST['end_date'];

        try {
            if (empty($client_name)) {
                throw new Exception('Client name fill required..!');   
            }
            if (empty($client_budget)) {
                throw new Exception('Budget fill required..!');   
            }
            if (empty($project_assign)) {
                throw new Exception('Project assign fill required..!');   
            }
            if (empty($start_date)) {
                throw new Exception('Project start date fill required..!');   
            }
            if (empty($end_date)) {
                throw new Exception('Project end date fill required..!');  
            }
           
            $current_date = date('Y-m');
            $stm = $pdo->prepare('INSERT INTO projects (client_name,budget,project_assign,start_date,end_date,monthly_project_date) VALUES (?,?,?,?,?,?)');
            $stm->execute(array($client_name,$client_budget,$project_assign,$start_date,$end_date,$current_date));

            $success = 'Project added successfully!!';

            unset($_POST['client_name']);
            unset($_POST['client_budget']);
            unset($_POST['project_assign']);
            unset($_POST['start_date']);
            unset($_POST['end_date']);
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
            <h1 class="main-title float-left">Ours Project</h1>
            <ol class="breadcrumb float-right">
                <li class="breadcrumb-item">Projects</li>
                <li class="breadcrumb-item active">Add new project</li>
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
                <h3><i class="far fa-hand-pointer"></i> Add New Project</h3> You can add here any project overview of our company's.
            </div>

            <div class="card-body">
                <div class="col-md-8">
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
                          <span><?php echo $success ;?></span>
                        </div>
                    <?php endif; ?>
                </div>
                <form action="" method="POST">
	                <div class="col-md-8">
                        <div class="form-group">
                            <label for="clname">Client Name<span class="text-danger">*</span></label>
                            <input type="text" name="client_name" placeholder="Enter client name" class="form-control" id="clname" value="<?php if(isset($_POST['client_name'])){echo $_POST['client_name'];}?>">
                        </div>
                    </div>

                    <div class="col-md-8">
	                   	<div class="form-group">
	                        <label for="bdgt">Budget<span class="text-danger">*</span></label>
	                        <input type="number" name="client_budget" placeholder="Enter budget amount" class="form-control" id="bdgt" value="<?php if(isset($_POST['client_budget'])){echo $_POST['client_budget'];}?>">
	                    </div>
                    </div>

                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="pasg">Project Assign<span class="text-danger">*</span></label>
                           <select name="project_assign" class="form-control" id="pasg">
                                <?php 
                                    $statement = $pdo->prepare('SELECT * FROM employee_info');
                                    $statement->execute();
                                    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                                    foreach ($result as $row) :
                                 ?>
                               <option value="<?php echo $row['emp_fullname']; ?>"><?php echo $row['emp_fullname']; ?></option>
                           <?php endforeach; ?>
                           </select>
                        </div>
                    </div>

                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="startdate">Start Date<span class="text-danger">*</span></label>
                            <input type="date" name="start_date" class="form-control" id="startdate" value="<?php if(isset($_POST['start_date'])){echo $_POST['start_date'];}?>">
                        </div>
                    </div>

                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="enddate">End Date<span class="text-danger">*</span></label>
                            <input type="date" name="end_date" class="form-control" id="enddate" value="<?php if(isset($_POST['end_date'])){echo $_POST['end_date'];}?>">
                        </div>
                    </div>

                    <div class="col-md-8">
                    	<div class="form-group text-right m-b-0">
	                        <button class="btn btn-primary" type="submit" name="addproject">
	                            Submit
	                        </button>
	                        <button type="reset" class="btn btn-secondary m-l-5">
	                            Cancel
	                        </button>
                    	</div>
                    </div>
                </form>
            </div>
        </div><!-- end card-->
    </div>
</div>

<?php require_once('footer.php'); ?>