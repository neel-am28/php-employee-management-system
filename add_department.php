<?php 
require('header.php');
if(!isset($_SESSION['ADMIN_USER_ID'])){
    header("location:add_employee.php?id=".$_SESSION['USER_USER_ID']);// when the user is trying to get into admin's page from URL
    die();
}  
$department = "";
$id = "";
if(isset($_GET['id'])){
	$id = mysqli_real_escape_string($conn,$_GET['id']);
	$result = mysqli_query($conn, "select * from `department` where `id` = '$id' ");
	$row = mysqli_fetch_assoc($result);
	$department = $row['department'];
}

if(isset($_POST['department'])){
    $department = mysqli_real_escape_string($conn,$_POST['department']);
    if($id > 0){
    	$sql = "update `department` set `department` = '$department' where `id` = '$id' ";
    }
    else{
    	$sql = "insert into `department`(`department`) values('$department')";
	}
	mysqli_query($conn, $sql);
    header("location:index.php");
    die();
}
?>
 <div class="main-content">
    <div class="page-title-area">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <div class="breadcrumbs-area clearfix">
                    <h4 class="page-title pull-left">Department Form</h4>
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
	                                <label>Department</label>
	                                <input class="form-control" type="text" placeholder="Enter department" name="department" value="<?php echo $department;	 ?>"required>
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