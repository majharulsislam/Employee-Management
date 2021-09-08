<?php require_once('header.php'); ?>

<!-- Start Breadcame -->
<div class="row">
    <div class="col-xl-12">
        <div class="breadcrumb-holder">
            <h1 class="main-title float-left">Notice Details</h1>
            <ol class="breadcrumb float-right">
                <li class="breadcrumb-item">Notice</li>
                <li class="breadcrumb-item active">Notice History</li>
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
                <h3><i class="fas fa-table"></i> All Notice History</h3>
                <i>Notice: </i> When you can add notice then show here notice descriptions.
            </div>

            <div class="card-body">
                <table class="table table-responsive-xl table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">#SL</th>
                            <th scope="col">Title</th>
                            <th scope="col">Description</th>
                            <th scope="col">Date & Time</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                      <?php 
                          $stm = $pdo->prepare('SELECT * FROM notice ORDER BY notice_datetime DESC');
                          $stm->execute();
                          $result = $stm->fetchAll(PDO::FETCH_ASSOC);
                          $sl = 1;
                          foreach($result as $row) :
                       ?>
                        <tr>
                            <th scope="row"><?php echo $sl;$sl++; ?></th>
                            <td><?php echo $row['notice_title']; ?></td>
                            <td>
                              <?php 
                                  $notice_desc = explode(" ", $row['notice_desc']);
                                  $short = array_slice($notice_desc,0,8);
                                  $final_desc = implode(" ",$short);
                                  echo $final_desc."...";
                                ?>
                            </td>
                            <td><?php echo $row['notice_datetime']; ?></td>
                            <td>
                                <a class="btn btn-sm btn-info" data-fancybox data-src="#hidden-content<?php echo $row['notice_id'];?>" href="javascript:;<?php echo $row['notice_id'];?>"><i class="fas fa-eye"></i></a>&nbsp;
                <!--============  Single notice information or View  =========-->
                          <div class="notice_view_area" style="display: none;width:750px;" id="hidden-content<?php echo $row['notice_id'];?>">
                               <div class="notice_view">
                                 <h5>Notice Information</h5>
                                 <div class="notice_table">
                                   <div class="notice_title"><h6>Title :</h6><p><?php echo $row['notice_title']; ?></p></div>
                                   <div class="timedate"><strong>Date & Time :</strong> <?php echo $row['notice_datetime']; ?></div>
                                 </div>
                                  <div class="notice_desc">
                                    <h6>Description :</h6>
                                    <p><?php echo $row['notice_desc']; ?></p>
                                 </div>
                               </div>
                            </div>
                              <a class="btn btn-sm btn-danger" onclick="return confirm('Are you sure delete this notice?')" href="noticeHistory.php?delNid=<?php echo $row['notice_id']; ?>">
                                <i class="fas fa-trash-restore"></i>
                              </a>
                            </td>
                        </tr>
                      <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php require_once('footer.php'); ?>

<!-- ================== Delete Notice ====================== -->
<?php 
    if (isset($_REQUEST['delNid'])) {
      $id = $_REQUEST['delNid'];

      $statement = $pdo->prepare('DELETE FROM notice WHERE notice_id=?');
      $statement->execute(array($id));

    }


 ?>