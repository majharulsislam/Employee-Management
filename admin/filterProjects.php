<?php require_once('header.php'); ?>



<!-- Start Breadcame -->
<div class="row">
    <div class="col-xl-12">
        <div class="breadcrumb-holder">
            <h1 class="main-title float-left">Filtering Project</h1>
            <ol class="breadcrumb float-right">
                <li class="breadcrumb-item">Projects</li>
                <li class="breadcrumb-item active">Fileter Project</li>
            </ol>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<!-- End Breadcame -->


<!--========================= Filter by year with Project assign ============================= -->
<div class="row">
	<div class="col-md-8 col-xs-12 col-sm-12">
        <div class="card mb-3">
            <div class="card-header bg-primary text-white">
                <h3><i class="fas fa-filter"></i> Filter By Year With Project Assign</h3>
               	You can filter here yearly with employee.
            </div>
            <!-- Filter form -->
            <div class="card-body">
                <form action="" method="POST">
                  <div class="col-md-12">
                      <div class="form-group">
                          <select name="project_assign" class="form-control">
                                <?php 
                                    $view = $pdo->prepare('SELECT emp_fullname FROM employee_info');
                                    $view->execute();
                                    $view_all = $view->fetchAll(PDO::FETCH_ASSOC);
                                    foreach($view_all as $allemp) :
                                 ?>
                                <option value="<?php echo $allemp['emp_fullname']; ?>"><?php echo $allemp['emp_fullname']; ?></option>
                                <?php endforeach; ?>
                            </select>
                      </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="fromyear">From Year<span class="text-danger">*</span></label>
                            <input type="date" name="fromyear" class="form-control" id="fromyear" value="<?php if(isset($_POST['fromyear'])){echo $_POST['fromyear'];}?>">
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="toyear">To Year<span class="text-danger">*</span></label>
                            <input type="date" name="toyear" class="form-control" id="toyear" value="<?php if(isset($_POST['toyear'])){echo $_POST['toyear'];}?>">
                        </div>
                    </div>

                    <div class="col-md-12">
                      <div class="form-group text-right m-b-0">
                          <button class="btn btn-primary" type="submit" name="filter_year_emp">
                              Submit
                          </button>
                          <button type="reset" class="btn btn-secondary m-l-5">
                              Cancel
                          </button>
                      </div>
                    </div>
                </form>
              <!-- view filter -->
              <?php if(isset($_POST['filter_year_emp'])) :
                  $project_assign = $_POST['project_assign'];
                  $fromyear = $_POST['fromyear'];
                  $toyear = $_POST['toyear'];

                  if (empty($fromyear) || empty($toyear)) {
                      echo "<span style=\"color:red;font-size:20px;\">"."No Data View. Please Select from and to date!"."</span>";
                  }
              ?>
              <table class="table table-responsive-xl table-bordered">
                  <h6>Show filtering details <i class="fas fa-arrow-down"></i></h6>
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
                            $stm = $pdo->prepare('SELECT * FROM projects WHERE start_date BETWEEN ? AND ? AND project_assign=?');
                            $stm->execute(array($fromyear,$toyear,$project_assign));
                            $result = $stm->fetchAll(PDO::FETCH_ASSOC);
                            $sl = 1;
                            $total_earn = 0;
                            foreach ($result as $row) :
                         ?>
                        <tr>
                            <th scope="row"><?php echo $sl;$sl++; ?></th>
                            <td><?php echo $row['client_name']; ?></td>
                            <td>$<?php echo $row['budget']; $total_earn = $total_earn+$row['budget'];?></td>
                            <td><?php echo $row['project_assign']; ?></td>
                        </tr>
                      <?php endforeach; ?>
                    </tbody>
                </table>
                <h6 style="text-align:center;color:green">Total Earn = $<?php echo $total_earn; ?></h6>
              <?php endif; ?>
            </div>
        </div><!-- end card-->
    </div>
 <!-- =================== End filter by year with Projecct Assign ======================== -->

    
  <div class="col-md-4">
    <div class="filter_text">
      <h6>Friends It Point</h6>
      <p>Lorem ipsum dolor, sit amet, consectetur adipisicing elit. Alias, sed autem. Fuga, ratione! Accusantium fugit nesciunt neque explicabo hic ut, dolore ad repellendus repudiandae animi, placeat illum, molestias ratione similique sunt error nostrum in quam natus iusto vero expedita, dolorum. Amet veniam sit eos, facilis eaque et sint quod dolores?</p>
      <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Eius doloribus impedit voluptatem ex maxime labore molestias ullam nostrum, ipsam sunt.</p>
    </div>
  </div>
    
</div>



<div class="row">
<!--========================= Filter by Year ============================= -->
    <div class="col-md-6 col-xs-12 col-sm-12">
      <div class="card mb-3">
          <div class="card-header bg-info text-white">
              <h3><i class="fas fa-filter"></i> All Projects Filter By Year</h3>
              You can filter here yearly.
          </div>
          <!-- Filter form -->
          <div class="card-body">
              <form action="" method="POST">
                  <div class="col-md-12">
                      <div class="form-group">
                          <label for="from_year">From Year<span class="text-danger">*</span></label>
                          <input type="date" name="from_year" class="form-control" id="from_year" value="<?php if(isset($_POST['from_year'])){echo $_POST['from_year'];}?>">
                      </div>
                  </div>

                  <div class="col-md-12">
                      <div class="form-group">
                          <label for="to_year">To Year<span class="text-danger">*</span></label>
                          <input type="date" name="to_year" class="form-control" id="to_year" value="<?php if(isset($_POST['to_year'])){echo $_POST['to_year'];}?>">
                      </div>
                  </div>

                  <div class="col-md-12">
                    <div class="form-group text-right m-b-0">
                        <button class="btn btn-danger" type="submit" name="filter_year">
                            Submit
                        </button>
                        <button type="reset" class="btn btn-secondary m-l-5">
                            Cancel
                        </button>
                    </div>
                  </div>
              </form>
            <!-- view filter -->
            <?php if(isset($_POST['filter_year'])) :
                $from_year = $_POST['from_year'];
                $to_year = $_POST['to_year'];

                if (empty($from_year) || empty($to_year)) {
                    echo "<span style=\"color:red;font-size:20px;\">"."No Data View. Please Select from and to date!"."</span>";
                }
            ?>
            <table class="table table-responsive-xl table-bordered">
                <h6>Show filtering details <i class="fas fa-arrow-down"></i></h6>
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
                          $stm = $pdo->prepare('SELECT * FROM projects WHERE start_date BETWEEN ? AND ? ORDER BY start_date DESC');
                          $stm->execute(array($from_year,$to_year));
                          $rslt = $stm->fetchAll(PDO::FETCH_ASSOC);
                          $sl = 1;
                          $total_earns = 0;
                          foreach ($rslt as $view) :
                       ?>
                      <tr>
                          <th scope="row"><?php echo $sl;$sl++; ?></th>
                          <td><?php echo $view['client_name']; ?></td>
                          <td>$<?php echo $view['budget']; $total_earns = $total_earns+$view['budget'];?></td>
                          <td><?php echo $view['project_assign']; ?></td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
              </table>
              <h6 style="text-align:center;color:green">Total Earn = $<?php echo $total_earns; ?></h6>
            <?php endif; ?>
          </div>
      </div><!-- end card-->
  </div>
 <!-- =================== End filter by Year ======================== -->



 <!--========================= Filter by Month ============================= -->
  <div class="col-md-6 col-xs-12 col-sm-12">
        <div class="card mb-3">
            <div class="card-header bg-success text-white">
                <h3><i class="fas fa-filter"></i> All Projects Filter By Monthly</h3>
                You can filter here monthly project.
            </div>
            <!-- Filter form -->
            <div class="card-body">
                <form action="" method="POST">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="select_year">Select Year <span class="text-danger">*</span></label>
                            <select class="form-control" name="select_year" id="select_year">
                              <option value="">- Select year -</option>
                              <?php for($i=2020;$i <= date('Y');$i++) : ?>
                              <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                            <?php endfor; ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="select_month">Select Month <span class="text-danger">*</span></label>
                            <select class="form-control" name="select_month" id="select_month">
                              <option value="">- Select year -</option>
                              <?php for($j=1;$j <= 12;$j++) : ?>
                              <option value="<?php echo $j; ?>"><?php echo $j; ?></option>
                            <?php endfor; ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-12">
                      <div class="form-group text-right m-b-0">
                          <button class="btn btn-warning" type="submit" name="filter_month">
                              Submit
                          </button>
                          <button type="reset" class="btn btn-secondary m-l-5">
                              Cancel
                          </button>
                      </div>
                    </div>
                </form>
              <!-- view filter -->
              <?php if(isset($_POST['filter_month'])) :
                  $select_year = $_POST['select_year'];
                  $select_month = $_POST['select_month'];

                  if (empty($select_year) || empty($select_month)) {
                      echo "<span style=\"color:red;font-size:20px;\">"."No Data View. Please Select year and month!"."</span>";
                  }
              ?>
              <table class="table table-responsive-xl table-bordered">
                  <h6>Show filtering details <i class="fas fa-arrow-down"></i></h6>
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
                            $stm = $pdo->prepare('SELECT * FROM projects WHERE YEAR(start_date)=? AND MONTH(start_date)=? ORDER BY start_date DESC');
                            $stm->execute(array($select_year,$select_month));
                            $rslts = $stm->fetchAll(PDO::FETCH_ASSOC);
                            $sl = 1;
                            $total_earning = 0;
                            foreach ($rslts as $views) :
                         ?>
                        <tr>
                            <th scope="row"><?php echo $sl;$sl++; ?></th>
                            <td><?php echo $views['client_name']; ?></td>
                            <td>$<?php echo $views['budget']; $total_earning = $total_earning+$views['budget'];?></td>
                            <td><?php echo $views['project_assign']; ?></td>
                        </tr>
                      <?php endforeach; ?>
                    </tbody>
                </table>
                <h6 style="text-align:center;color:green">Total Earn = $<?php echo $total_earning; ?></h6>
              <?php endif; ?>
            </div>
        </div><!-- end card-->
    </div>
</div>
 <!-- =================== End filter by Month ======================== -->


<?php require_once('footer.php'); ?>