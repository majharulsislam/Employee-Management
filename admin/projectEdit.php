<?php require_once('header.php'); ?>

<?php 
    if ($_REQUEST['projectId']) {
        $id = $_REQUEST['projectId'];
    }
    else{
        header('location:projectOverview.php');
    } 
?>

<?php 
    if (isset($_POST['updateProject'])) {
        $client_name = $_POST['client_name'];
        $client_budget = $_POST['client_budget'];
        $project_assign = $_POST['project_assign'];
        $start_date = $_POST['start_date'];
        $end_date = $_POST['end_date'];

        try {
            if (empty($client_name)) {
                throw new Exception('Client name can\'t be empty..!');   
            }
            if (empty($client_budget)) {
                throw new Exception('Client budget can\'t be empty..!');   
            }
            if (empty($project_assign)) {
                throw new Exception('Project assign can\'t be empty..!');   
            }
            if (empty($start_date)) {
                throw new Exception('Project start date can\'t be empty..!');   
            }
            if (empty($end_date)) {
                throw new Exception('Project end date can\'t be empty..!');   
            }

           
            $currentdate = date('Y-m');

            if (isset($_POST['completed'])) {
                $update = $pdo->prepare('UPDATE projects SET client_name=?,budget=?,project_assign=?,start_date=?,end_date=?,completed=?,monthly_project_date=? WHERE project_id=?');
                $update->execute(array($client_name,$client_budget,$project_assign,$start_date,$end_date,1,$currentdate,$id));

                header('location:projectOverview.php');
            }
            else{
                $update = $pdo->prepare('UPDATE projects SET client_name=?,budget=?,project_assign=?,start_date=?,end_date=?,monthly_project_date=? WHERE project_id=?');
                $update->execute(array($client_name,$client_budget,$project_assign,$start_date,$end_date,$currentdate,$id));

                header('location:projectOverview.php');
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
            <h1 class="main-title float-left">Projects</h1>
            <ol class="breadcrumb float-right">
                <li class="breadcrumb-item">Projects</li>
                <li class="breadcrumb-item active">Project Edit</li>
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
                <h3><i class="far fa-hand-pointer"></i> Update Your Project</h3> You can update here any project overview of your company's.
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
                    <?php 
                        $viewproject = $pdo->prepare('SELECT * FROM projects WHERE project_id=?');
                        $viewproject->execute(array($id));
                        $projectall = $viewproject->fetchAll(PDO::FETCH_ASSOC);
                        foreach ($projectall as $singleProject) :
                     ?>
	                <div class="col-md-8">
                        <div class="form-group">
                            <label for="clname">Client Name<span class="text-danger">*</span></label>
                            <input type="text" name="client_name" class="form-control" id="clname" value="<?php echo $singleProject['client_name']; ?>">
                        </div>
                    </div>

                    <div class="col-md-8">
	                   	<div class="form-group">
	                        <label for="bdgt">Budget<span class="text-danger">*</span></label>
	                        <input type="number" name="client_budget" class="form-control" id="bdgt" value="<?php echo $singleProject['budget']; ?>">
	                    </div>
                    </div>

                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="pasg">Project Assign<span class="text-danger">*</span></label>
                            <input type="text" name="project_assign" class="form-control" id="pasg" value="<?php echo $singleProject['project_assign']; ?>">
                        </div>
                    </div>

                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="startdate">Start Date<span class="text-danger">*</span></label>
                            <input type="date" name="start_date" class="form-control" id="startdate" value="<?php echo $singleProject['start_date']; ?>">
                        </div>
                    </div>

                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="enddate">End Date<span class="text-danger">*</span></label>
                            <input type="date" name="end_date" class="form-control" id="enddate" value="<?php echo $singleProject['end_date']; ?>">
                        </div>
                    </div>

                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="complete"><strong>If project completed tick this :&nbsp;</strong></label>
                            <input type="checkbox" name="completed" id="complete">
                        </div>
                    </div>

                    <div class="col-md-8">
                    	<div class="form-group text-right m-b-0">
	                        <button class="btn btn-primary" type="submit" name="updateProject">
	                            Submit
	                        </button>
                    	</div>
                    </div>
                <?php endforeach; ?>
                </form>
            </div>
        </div><!-- end card-->
    </div>
</div>

<?php require_once('footer.php'); ?>