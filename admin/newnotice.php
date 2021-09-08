<?php require_once('header.php'); ?>

<?php 
    if (isset($_POST['noticeSend'])) {
        $notice_title = $_POST['notice_title'];
        $notice_desc = $_POST['notice_desc'];

        try {
            if (empty($notice_title)) {
                throw new Exception('Notice title can\'t be empty!');   
            }
            if (empty($notice_desc)) {
                throw new Exception('Notice description can\'t be empty!');   
            }

            // date & time together
            date_default_timezone_set('Asia/Dhaka');
            $notice_datetime = date('Y-M-d')." // ";
            $notice_datetime .= date('g:i:s a');

            $stm = $pdo->prepare('INSERT INTO notice (notice_title,notice_desc,notice_datetime) VALUES (?,?,?)');
            $stm->execute(array($notice_title,$notice_desc,$notice_datetime));

            $notify = $pdo->prepare('INSERT INTO  notification (type,status) VALUES (?,?)');
            $notify->execute(array('notice','unread'));
            header('location:newnotice.php');

            $success = "Your Notice Publish Successfully!!";

            unset($_POST['notice_title']);
            unset($_POST['notice_desc']);
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
            <h1 class="main-title float-left">New Notice</h1>
            <ol class="breadcrumb float-right">
                <li class="breadcrumb-item">Notice</li>
                <li class="breadcrumb-item active">Add new notice</li>
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
                <h3><i class="far fa-hand-pointer"></i> Add new notice</h3>
               	You can add here notice.
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
	                        <label for="ntitle">Notice Title<span class="text-danger">*</span></label>
	                        <input type="text" name="notice_title" placeholder="Enter notice title" class="form-control" id="ntitle" value="<?php if(isset($_POST['notice_title'])){echo $_POST['notice_title'];}?>">
	                    </div>
                    </div>

                    <div class="col-md-8">
	                   	<div class="form-group">
	                        <label for="ndesc">Description</label>
	                        <div>
	                            <textarea class="form-control" id="ndesc" name="notice_desc" value="<?php if(isset($_POST['notice_desc'])){echo $_POST['notice_desc'];}?>"></textarea>
                                <script>
                                  // Replace the <textarea id="editor1"> with a CKEditor
                                  // instance, using default configuration.
                                  CKEDITOR.replace( 'ndesc' );
                                </script>
	                        </div>
                        </div>
                    </div>

                    <div class="col-md-8">
                    	<div class="form-group text-right m-b-0">
	                        <button class="btn btn-primary" type="submit" name="noticeSend">
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