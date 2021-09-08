<?php require_once('header.php'); ?>
<!-- Start Breadcame -->
<div class="row">
    <div class="col-xl-12">
        <div class="breadcrumb-holder">
            <h1 class="main-title float-left">My Profile</h1>
            <ol class="breadcrumb float-right">
                <li class="breadcrumb-item">Home</li>
                <li class="breadcrumb-item active">Profile</li>
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
                <h3><i class="fas fa-table"></i> My Profile View</h3>
            </div>
            <div class="card-body">
          <div class="emp_info">
                <div class="emp_info_single">
                  <div class="emp_profile">
                    <div class="emp_avatar">
                      <a href="#emp_pablo">
                        <img class="img" src="uploads/<?php echo $row['profile_pic']; ?>" alt="no-photo">
                      </a>
                    </div>
                    <div class="emp_body table-responsive">
                      <h4><?php echo $row['emp_fullname'];?></h4>
                      <br\>
                      <table class="table">
                        <tbody>
                            <tr>
                                <td>Employee id</td>
                                <td><b>:</b></td>
                                <td><?php echo $row['employee_id'];?></td>
                            </tr>

                            <tr>
                                <td>Designation</td>
                                <td><b>:</b></td>
                                <td><?php echo $row['emp_designation'];?></td>
                            </tr>

                            <tr>
                                <td>Mobile Number</td>
                                <td><b>:</b></td>
                                <td>+880<?php echo $row['emp_phone'];?></td>
                            </tr>

                            <tr>
                                <td>E-mail</td>
                                <td><b>:</b></td>
                                <td><?php echo $row['emp_mail'];?></td>
                            </tr>

                            <tr>
                                <td>Address</td>
                                <td><b>:</b></td>
                                <td><?php echo $row['emp_address'];?></td>
                            </tr>

                            <tr>
                                <td>Joining Date &amp; time</td>
                                <td><b>:</b></td>
                                <td><?php echo $row['register_timedate'];?></td>
                            </tr>

                            <tr>
                                <td>Now Total Earn</td>
                                <td><b>:</b></td>
                                <td>$<?php echo $row['total_salary'];?></td>
                            </tr>
                        </tbody>
                    </table>
                    </br\></div>
                  </div>
                </div>
              </div>  
            </div>
        </div>
    </div>
</div>
<?php require_once('footer.php'); ?>