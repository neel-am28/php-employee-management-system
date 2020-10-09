<?php 
// session_start();
// print_r($_SESSION);
// die();
require('header.php');
if(!isset($_SESSION['ADMIN_USER_ID'])){
    header("location:add_employee.php?id=".$_SESSION['USER_USER_ID']);
    die();
}  
$result = mysqli_query($conn, "select * from `department` order by `id` desc");
if(isset($_GET['type']) && isset($_GET['type']) == "delete" && isset($_GET['id'])){
    $id = mysqli_real_escape_string($conn,$_GET['id']);
    mysqli_query($conn, "delete from `department` where `id` = '$id' ");
    header("location:index.php");
    die();
}
?>
 <div class="main-content">
    <div class="page-title-area">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <div class="breadcrumbs-area clearfix">
                    <h4 class="page-title pull-left">Department Master</h4>
                    <a href="add_department.php" class="btn btn-primary mb-3 pull-right btn-xs"><i class="fa fa-plus"></i> &nbsp;Add Department</a>
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
                                            <th scope="col">Department</th>
                                            <th scope="col" colspan="2">Action</th>
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
                                            <td><?php echo $row['department']; ?></td>
                                            <td>
                                                <ul class="d-flex justify-content-center">
                                                    <li class="mr-3"><a href="add_department.php?id=<?php echo $row['id']; ?>" class="text-secondary"><i class="fa fa-edit"></i></a></li>
                                                    <li><a href="index.php?id=<?php echo $row['id']; ?>&type=delete" class="text-danger"><i class="ti-trash"></i></a></li>
                                                </ul>
                                            </td>
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
<?php require('footer.php');?>