<?php 
// session_start();
// print_r($_GET);
// print_r($_SESSION);
// die();
require('header.php');
$name = "";
$email = "";
$mobile = "";
$password = "";
$department_id = "";
$address = "";
$birthday = "";
$id = "";
if(isset($_GET['id']) && $_GET['id'] !=""){
	$id = mysqli_real_escape_string($conn,$_GET['id']);
    if($_SESSION['USER_ROLE'] == 2 && $_SESSION['USER_USER_ID'] != $id){
        die('Access denied');
    }// if the logged in user tries to see another user's data
	$result = mysqli_query($conn, "select * from `employee` where `id` = '$id' ");
	$row = mysqli_fetch_assoc($result);
	$name = $row['name'];
    $email = $row['email'];
    $mobile = $row['mobile'];
    $password = $row['password'];
    $department_id = $row['department_id'];
    $address = $row['address'];
    $birthday = $row['birthday'];
}

if(isset($_POST['submit'])){
    $name = mysqli_real_escape_string($conn,$_POST['name']);
    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $mobile = mysqli_real_escape_string($conn,$_POST['mobile']);
    $password = mysqli_real_escape_string($conn,$_POST['password']);
    $department_id = mysqli_real_escape_string($conn,$_POST['department_id']);
    $address = mysqli_real_escape_string($conn,$_POST['address']);
    $birthday = mysqli_real_escape_string($conn,$_POST['birthday']);
    if($id > 0){
    	$sql = "update `employee` set `name` = '$name',`email` = '$email',`mobile` = '$mobile',`password` = '$password',`department_id` = '$department_id',`address` = '$address',`birthday` = '$birthday' where `id` = '$id' ";
    }
    else{
    	$sql = "insert into `employee`(`name`,`email`,`mobile`,`password`,`department_id`,`address`,`birthday`,`role`) values('$name','$email','$mobile','$password','$department_id','$address','$birthday','2')";
	}
	$query = mysqli_query($conn, $sql);
    header("location:employee.php");
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
	                                <label>Name</label>
	                                <input class="form-control" type="text" placeholder="Enter employee name" name="name" value="<?php echo $name;	 ?>"required>
	                            </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input class="form-control" type="email" placeholder="Enter employee email" name="email" value="<?php echo $email;   ?>"required>
                                </div>
                                <div class="form-group">
                                    <label>Mobile</label>
                                    <input class="form-control" type="text" placeholder="Enter employee mobile number" name="mobile" value="<?php echo $mobile;   ?>"required>
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input class="form-control" type="password" placeholder="Enter employee password" name="password" required>
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label">Employee Department</label>
                                    <select class="form-control" name="department_id">
                                        <option value="">Select Department</option>
                                        <?php 
                                        $result = mysqli_query($conn, "select * from `department` order by department desc");
                                        while($row = mysqli_fetch_assoc($result)) { ?>
                                            <?php if($department_id == $row['id']){ ?>
                                            <option selected="selected" value="<?php echo $row['id'] ?>"><?php echo $row['department']?></option>
                                             <?php } // if end 
                                             else{ 
                                                ?>
                                        <option value="<?php echo $row['id'] ?>"><?php echo $row['department']?></option>
                                        <?php
                                            }//else end
                                         } // while end
                                         ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Address</label>
                                    <input class="form-control" type="text" placeholder="Enter employee address" name="address" value="<?php echo $address;?>"required>
                                </div>
                                <div class="form-group">
                                    <label>Birthdate</label>
                                    <input class="form-control" type="date" value="<?php echo $birthday;?>" placeholder="Enter employee birthdate" name="birthday" required>
                                </div>
                                <?php if(!isset($_SESSION['ADMIN_ROLE'])){ ?>
	                            <button type="submit" name="submit" class="btn btn-primary mt-2 pr-4 pl-4">Submit</button>
                            <?php } ?>
                        	</form>                           
                        </div>
                    </div>
                </div>            
   			</div>
		</div>
	</div>
</div>
<?php require('footer.php'); ?>