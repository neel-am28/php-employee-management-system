<?php 
require('header.php');
if(isset($_POST['submit'])){
    $employee_id = $_SESSION['USER_USER_ID'];
    $leave_id = mysqli_real_escape_string($conn,$_POST['leave_id']);
    $leave_from = mysqli_real_escape_string($conn,$_POST['leave_from']);
    $leave_to = mysqli_real_escape_string($conn,$_POST['leave_to']);
    $leave_description = mysqli_real_escape_string($conn,$_POST['leave_description']);
    $sql = "insert into `leave`(`employee_id`,`leave_id`,`leave_from`,`leave_to`,`leave_description`,`leave_status`) values('$employee_id','$leave_id','$leave_from','$leave_to','$leave_description',1)";
    
	$query = mysqli_query($conn, $sql);
    header("location:leave.php");
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
                                    <label>Employee Leave Type</label>
                                    <select class="form-control py-1" name="leave_id">
                                        <option>Select Leave Type</option>
                                        <?php 
                                        $result = mysqli_query($conn, "select * from `leave_type` order by leave_type desc");
                                        while($row = mysqli_fetch_assoc($result)) { ?>
                                        <option value="<?php echo $row['id'] ?>"><?php echo $row['leave_type']?></option>
                                        <?php
                                         } // while end
                                         ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Leave From</label>
                                    <input class="form-control" type="date" name="leave_from" required>
                                </div>
                                <div class="form-group">
                                    <label>Leave To</label>
                                    <input class="form-control" type="date" name="leave_to" required>
                                </div>
                                <div class="form-group">
                                    <label>Leave Description</label>
                                    <input class="form-control" type="text" placeholder="Enter leave description" name="leave_description">
                                </div>
	                            <button type="submit" name="submit" class="btn btn-primary mt-2 pr-4 pl-4">Submit</button>
                        	</form>                           
                        </div>
                    </div>
                </div>            
   			</div>
		</div>
	</div>
</div>
<?php require('footer.php'); ?>