<?php require_once('header.php'); ?>

<!-- Start Breadcame -->
<div class="row">
    <div class="col-xl-12">
        <div class="breadcrumb-holder">
            <h1 class="main-title float-left">Leaving Details</h1>
            <ol class="breadcrumb float-right">
                <li class="breadcrumb-item">Leave</li>
                <li class="breadcrumb-item active">Leaving Details</li>
            </ol>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<!-- End Breadcame -->

<div class="row">
	<div class="col-md-12">
   		<div class="table-responsive">
			<table class="table">
			  <thead>
			    <th>#SL</th>
			    <th>Leave</th>
			    <th>Types</th>
			    <th>Reason</th>
			    <th>Date & Time</th>
			    <th>Action</th>
			  </thead>
			  <!-- All Notice Info -->
			  <tbody>
			    <?php 
			        $stm  = $pdo->prepare('SELECT * FROM leaving ORDER BY app_date DESC');
			        $stm->execute();
			        $result = $stm->fetchAll(PDO::FETCH_ASSOC);
			        $sl = 1;
			        foreach ($result as $row) :
			     ?>
			    <tr>
			      <td><?php echo $sl;$sl++; ?></td>
			      <td><?php echo $row['left_emp']; ?></td>
			      <td><?php echo $row['left_reason']; ?></td>
			      <td>
			        <?php 
			            $long_desc = explode(" ", $row['left_desc']);
			            $short = array_slice($long_desc,0,10);
			            $final_desc = implode(" ",$short);
			            echo $final_desc;
			         ?>
			      </td>
			      <td>
			        <?php 
			            $apply_date = $row['app_date'];
			            $day = substr($apply_date,8,2);
			            $month = substr($apply_date,5,2);
			            $year = substr($apply_date,0,4);

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
			      <td>
			        <a data-fancybox data-src="#hidden-content<?php echo $row['left_id'];?>" href="javascript:;<?php echo $row['left_id'];?>">Details</a>&nbsp;
			<!--============  Single notice information or View  =========-->
			    <div class="notice_view_area" style="display: none;width:750px;" id="hidden-content<?php echo $row['left_id'];?>">
			      <div class="content-wrapper">
			      <div class="container-fluid">
			        <div class="row">
			          <div class="col-md-12">
			            <h2 class="page-title dash_title">Leaving Details</h2>
			            <div class="row">
			                <div class="col-md-1">
			                    I'm
			                </div>
			                <div class="col-md-5">
			                    <div class="form-group">
			                      <?php echo $row['left_emp']; ?>
			                    </div>
			                </div>
			                <div class="col-md-1">.EID</div>
			                <div class="col-md-1">
			                    <div class="form-group">
			                        <?php echo $row['left_empid']; ?>
			                    </div>
			                </div>
			                <div class="col-md-4">
			                    ,under the Company
			                </div>
			                
			            </div>
			          <div class="row">
			              <div class="col-md-3">
			                  <div class="form-group">
			                      <?php echo $row['company']; ?>
			                  </div>
			              </div>
			              <div class="col-md-2">
			                  ,reporting to
			              </div>
			              <div class="col-md-2">
			                  <div class="form-group">
			                      <?php echo $row['left_report']; ?>
			                  </div>
			              </div>
			              <div class="col-md-3">
			                  with to apply for
			              </div>
			              <div class="col-md-2">
			                  <div class="form-group">
			                      <?php echo $row['left_day']; ?>
			                  </div>
			              </div>
			          </div>
			          <div class="row">
			              <div class="col-md-4">
			                  days of leave from
			              </div>
			              <div class="col-md-3">
			                  <div class="form-group">
			                     <?php 
			                        $left_from = $row['left_from'];
			                        $lday = substr($left_from,8,2);
			                        $lmonth = substr($left_from,5,2);
			                        $lyear = substr($left_from,0,4);

			                        if($lmonth == '01') { $lmonth = 'Jan';}
			                        if($lmonth == '02') { $lmonth = 'Feb';}
			                        if($lmonth == '03') { $lmonth = 'Mar';}
			                        if($lmonth == '04') { $lmonth = 'Apr';}
			                        if($lmonth == '05') { $lmonth = 'May';}
			                        if($lmonth == '06') { $lmonth = 'Jun';}
			                        if($lmonth == '07') { $lmonth = 'July';}
			                        if($lmonth == '08') { $lmonth = 'Aug';}
			                        if($lmonth == '09') { $lmonth = 'Sep';}
			                        if($lmonth == '10') { $lmonth = 'Oct';}
			                        if($lmonth == '11') { $lmonth = 'Nov';}
			                        if($lmonth == '12') { $lmonth = 'Dec';}

			                        echo $lday." ".$lmonth." ".$lyear;
			                      ?>
			                  </div>
			              </div>
			              <div class="col-md-1">
			                  to
			              </div>
			               <div class="col-md-3">
			                  <div class="form-group">
			                      <?php 
			                        $left_to = $row['left_to'];
			                        $ltoday = substr($left_to,8,2);
			                        $ltomonth = substr($left_to,5,2);
			                        $ltoyear = substr($left_to,0,4);

			                        if($ltomonth == '01') { $ltomonth = 'Jan';}
			                        if($ltomonth == '02') { $ltomonth = 'Feb';}
			                        if($ltomonth == '03') { $ltomonth = 'Mar';}
			                        if($ltomonth == '04') { $ltomonth = 'Apr';}
			                        if($ltomonth == '05') { $ltomonth = 'May';}
			                        if($ltomonth == '06') { $ltomonth = 'Jun';}
			                        if($ltomonth == '07') { $ltomonth = 'July';}
			                        if($ltomonth == '08') { $ltomonth = 'Aug';}
			                        if($ltomonth == '09') { $ltomonth = 'Sep';}
			                        if($ltomonth == '10') { $ltomonth = 'Oct';}
			                        if($ltomonth == '11') { $ltomonth = 'Nov';}
			                        if($ltomonth == '12') { $ltomonth = 'Dec';}

			                        echo $ltoday." ".$lmonth." ".$ltoyear;
			                      ?>
			                  </div>
			              </div>
			          </div>
			         <div class="row">
			             <div class="col-md-4 mb-3">
			                  for  the following reason(s):
			             </div> 
			         </div> 
			       <div class="row">
			           <div class="col-md-12">
			              <div class="form-group">
			                  <?php echo $row['left_desc']; ?>      
			              </div>
			           </div>
			       </div>
			       <div class="row mb">
			           <div class="col-md-6">Types of Leave Requested: <?php echo $row['left_reason']; ?></div>
			       </div>
			       <div class="row mb-5 mt-5">
			           <div class="col-md-6">
			               <?php echo $row['app_sign']; ?><br>
			               -------------------------------------------<br>
			               Applicant's Signature
			           </div>
			           <div class="col-md-6">
			            <?php 
			                $app_date = $row['app_date'];
			                $aday = substr($app_date,8,2);
			                $amonth = substr($app_date,5,2);
			                $ayear = substr($app_date,0,4);

			                echo $aday."-".$amonth."-".$ayear;
			              ?><br>
			               -----------------------------------------<br>
			               Date
			           </div>
			       </div>

			  <?php 
			      // Approve or rejected check
			      $idd = $row['left_id'];
			      $check = $pdo->prepare('SELECT * FROM leaving WHERE left_id=?');
			      $check->execute(array($idd));
			      $rslt = $check->fetchAll(PDO::FETCH_ASSOC);
			      foreach($rslt as $check_rslt) :
			        $exist = $check_rslt['approval'];
			        if($exist != 1) :
			   ?>
			   <h5 class="text-center"><i class="far fa-grin-tongue-squint"></i> Waiting For Admin Response <i class="far fa-grin-tongue-squint"></i></h5>
              <?php else : ?>
              <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th colspan="2" class="text-center">For Official Use</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td class="left_accept">
                            <div class="form-check form-check-inline">
                                <?php echo $check_rslt['left_accept']; ?>
                            </div>
                          </td>
                      </tbody>
                  </table>
                  <div class="row mt-5 mb-5">
                      <div class="col-md-6">
                        <?php echo $check_rslt['approve_by']; ?><br>
                          -------------------------------------------<br>
                           Signed By<br><br><br>
                      </div>
                      <div class="col-md-6">
                        <?php 
                          $app_date = $check_rslt['approve_date'];
                          $d = substr($app_date,8,2);
                          $m = substr($app_date,5,2);
                          $y = substr($app_date,0,4);
                          echo $d."-".$m."_".$y
                        ?><br>
                          -----------------------------------------<br>
                          Date
                      </div>
                  </div>
                <?php endif; endforeach; ?>
		          </div>
		        </div>
		      </div>
		    </div>
		  </div>
          </td>
        </tr>
      <?php endforeach; ?>
      </tbody>
    </table>
  </div>
	</div>
</div>

<?php require_once('footer.php'); ?>