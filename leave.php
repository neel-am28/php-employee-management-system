<?php 
require('header.php');

if(isset($_GET['type']) && $_GET['type']=='delete' && isset($_GET['id'])){
    $id=mysqli_real_escape_string($conn,$_GET['id']);
    mysqli_query($conn,"delete from `leave` where id='$id'");
    header('location:leave.php');
    die();
}
if(isset($_GET['type']) && $_GET['type']=='update' && isset($_GET['id'])){
    $id=mysqli_real_escape_string($conn,$_GET['id']);
    $status=mysqli_real_escape_string($conn,$_GET['status']);
    mysqli_query($conn,"update `leave` set leave_status='$status' where id='$id'");
}

if(isset($_SESSION['ADMIN_ROLE'])){ 
    $sql="select `leave`.*, employee.name,employee.id as eid from `leave`,employee where `leave`.employee_id=employee.id order by `leave`.id desc";
}else{
    $eid=$_SESSION['USER_USER_ID'];
    $sql="select `leave`.*, employee.name ,employee.id as eid from `leave`,employee where `leave`.employee_id='$eid' and `leave`.employee_id=employee.id order by `leave`.id desc";
}
$result = mysqli_query($conn, $sql);
?>
 <div class="main-content">
    <div class="page-title-area">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <div class="breadcrumbs-area clearfix">
                    <h4 class="page-title pull-left">Employee Leave</h4>
                    <?php if(isset($_SESSION['USER_ROLE'])){  ?>
                    <a href="add_leave.php" class="btn btn-primary mb-3 pull-right btn-xs"><i class="fa fa-plus"></i> &nbsp;Add Leave</a>
                <?php } ?>
                </div>
            </div>
            <?php require('logout_script.php'); ?>
        </div>
    </div>

    <div class="main-content-inner">
        <div class="row">
            <!-- Progress Table start -->
            <div class="col-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">Department Table</h4>
                        <div class="single-table">
                            <div class="table-responsive">
                                <table class="table table-hover progress-table text-center">
                                    <thead class="text-uppercase">
                                        <tr>
                                            <th scope="col">Sr.No.</th>
                                            <th scope="col">ID</th>
                                            <th scope="col">Employee Name</th>
                                            <th scope="col">Leave From</th>
                                            <th scope="col">Leave To</th>
                                            <th scope="col">Leave Description</th>
                                            <th scope="col">Leave Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        while($row = mysqli_fetch_assoc($result)) {
                                        ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo $row['id']; ?></td>
                                            <td><?php echo $row['name']; ?></td>
                                            <td><?php echo $row['leave_from']; ?></td>
                                            <td><?php echo $row['leave_to']; ?></td>
                                            <td><?php echo $row['leave_description']; ?></td>
                                            <td>
                                                <?php if($row['leave_status'] == 1) { ?>
                                                <span class="status-p bg-primary">Applied</span>
                                                <?php }
                                                if($row['leave_status'] == 2) { ?>
                                                    <span class="status-p bg-success">Approved</span>
                                                    <?php }
                                                if($row['leave_status'] == 3) { ?>
                                                    <span class="status-p bg-danger">Rejected</span>
                                                <?php } ?>
                                                <?php if(isset($_SESSION['ADMIN_ROLE'])){  ?>
                                                    <select class="form-control mt-1 py-2" onchange="update_leave_status('<?php echo $row['id']?>',this.options[this.selectedIndex].value)">
                                                        <option value="">Select Status</option>
                                                        <option value="2">Approved</option>
                                                        <option value="3">Rejected</option>
                                                    </select>
                                                <?php } ?>
                                                <?php if($row['leave_status'] == 1) { ?>
                                                    <td>
                                                        <ul class="d-flex justify-content-center">
                                                            <li><a href="leave.php?id=<?php echo $row['id']; ?>&type=delete" class="text-danger"><i class="ti-trash"></i></a></li>
                                                        </ul>
                                                    </td>
                                                <?php } ?>
                                        </tr>                                        
                                        <?php
                                        $i++;
                                         } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Progress Table end -->
        </div>
    </div>
    <script type="text/javascript">
        function update_leave_status(id, selected_value){
            window.location.href='leave.php?id='+id+'&type=update&status='+selected_value;
        }
    </script>
<?php require('footer.php');?>