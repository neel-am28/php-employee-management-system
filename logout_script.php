<?php 

// print_r($_GET);
// die(); ?>

 <div class="col-sm-6 clearfix">
    <div class="user-profile pull-right">
        <img class="avatar user-thumb" src="assets/images/author/avatar.png" alt="avatar">
        <h4 class="user-name dropdown-toggle" data-toggle="dropdown">
        	<?php if(isset($_SESSION['ADMIN_ROLE'])) { 
			echo $_SESSION['ADMIN_USERNAME']; } else { 
			echo $_SESSION['USER_USERNAME']; } ?>
			<i class="fa fa-angle-down"></i>
		</h4>
        <div class="dropdown-menu">
        	<?php if(isset($_SESSION['ADMIN_ROLE'])) {  ?>
            <a class="dropdown-item" href="logout.php?user_type=admin">Log Out</a>
        	<?php } else {  ?>
            <a class="dropdown-item" href="logout.php?user_type=user">Log Out</a>
        	<?php } ?>
        </div>
    </div>
</div>