<?php 
require('header.php');
if(!isset($_SESSION['ADMIN_USER_ID'])){
    header("location:add_employee.php?id=".$_SESSION['USER_USER_ID']);// when the user is trying to get into admin's page from URL
    die();
} 
$leave_type = "";
$id = "";
if(isset($_GET['id']) && $_GET['id'] !=""){
	$id = mysqli_real_escape_string($conn,$_GET['id']);
	$result = mysqli_query($conn, "select * from `leave_type` where `id` = '$id' ");
	$row = mysqli_fetch_assoc($result);
	$leave_type = $row['leave_type'];
}

if(isset($_POST['leave_type'])){
    $leave_type = mysqli_real_escape_string($conn,$_POST['leave_type']);
    if($id > 0){
    	$sql = "update `leave_type` set `leave_type` = '$leave_type' where `id` = '$id' ";
    }
    else{
    	$sql = "insert into `leave_type`(`leave_type`) values('$leave_type')";
	}
	mysqli_query($conn, $sql);
    header("location:leave_type.php");
    die();
}
?>
 <div class="main-content">
    <div class="page-title-area">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <div class="breadcrumbs-area clearfix">
                    <h4 class="page-title pull-left">Leave Type Form</h4>
                </div>
            </div>
            <?php require('logout_script.php'); ?>
        </div>
    </div>
 <div class="main-content-inner">
    <div class="row">
        <div class="col-lg-6 col-ml-12">
            <div class="row">
                <!-- Textual inputs start -->
                <div class="col-12 mt-5">
                    <div class="card">
                        <div class="card-body">
                        	<form method="post">
	                            <div class="form-group">
	                                <label>Leave Type</label>
	                                <input class="form-control" type="text" placeholder="Enter leave type" name="leave_type" value="<?php echo $leave_type;	 ?>"required>
	                            </div>
	                            <button type="submit" class="btn btn-primary mt-2 pr-4 pl-4">Submit</button>
                        	</form>                           
                        </div>
                    </div>
                </div>            
   			</div>
		</div>
	</div>
</div>
<?php require('footer.php'); ?>