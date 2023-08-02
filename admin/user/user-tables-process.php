<?php
session_start();
require("../../require/connection.php");

$query_pending = "SELECT * FROM USER WHERE is_approved = 'Pending' AND role_id = '2' ORDER BY user_id DESC";
$result_pending = mysqli_query($connection, $query_pending);

$query_approved = "SELECT * FROM USER WHERE is_approved = 'Approved' AND role_id = '2' ORDER BY user_id DESC";
$result_approved = mysqli_query($connection, $query_approved);

$query_rejected = "SELECT * FROM USER WHERE is_approved = 'Rejected' AND role_id = '2' ORDER BY user_id DESC";
$result_rejected = mysqli_query($connection, $query_rejected);
?>

<?php

if (isset($_REQUEST['action']) && $_REQUEST['action'] == "pending") {?>
	<h2 class="text-uppercase fw-bolder text-center mt-5">Pending Account Requests</h2>
	<div class="px-2 mb-2">
		<table class="table table-dark table-striped text-center display" id="example">
		    <thead>
		    <tr>
		      <th scope="col">S. No 			</th>
		      <th scope="col">Image 			</th>
		      <th scope="col">First Name 		</th>
		      <th scope="col">Last Name 		</th>
		      <th scope="col">Email 			</th>
		      <th scope="col">Gender 			</th>
		      <th scope="col">Date Of Birth 	</th>
		      <th scope="col">Address 			</th>
		      <th scope="col">Status 			</th>
		      <th scope="col">Active/InActive 	</th>
		      <th scope="col">Created At 		</th>
		      <th scope="col">Approve/Reject 	</th>
		    </tr>
		  </thead>
		  <tbody>
  		<?php if ($result_pending->num_rows > 0) {
  				$serial = 0;
	  			while ($row = mysqli_fetch_assoc($result_pending)) {
		  			echo "<tr>";
		  			echo "<td>".++$serial."</td>";
		  			echo "<td><img class='rounded' class='rounded' src='../../images/".$row['user_image']."' alt='No Image' style='height: 50px;'></td>";
		  			echo "<td>".$row['first_name']."</td>";
		  			echo "<td>".$row['last_name']."</td>";
		  			echo "<td>".$row['email']."</td>";
		  			echo "<td>".$row['gender']."</td>";
		  			echo "<td>".$row['date_of_birth']."</td>";
		  			echo "<td>".$row['address']."</td>";
		  			if ($row['is_active'] == 'Active') {
			  			echo "<td><button class='btn btn-success'>".$row['is_active']."</button></td>";
		  			} else if ($row['is_active'] == 'InActive') {
			  			echo "<td><button class='btn btn-danger'>".$row['is_active']."</button></td>";
		  			} else {
		  				echo "<td></td>";
		  			}
		  			echo "<td><button class='btn btn-outline-success' onclick='active(".$row['user_id'].")'>Active</button>
		  			<button class='btn btn-outline-danger' onclick='inactive(".$row['user_id'].")'>InActive</button></td>";
		  			echo "<td>".date("F dS", strtotime($row['created_at']))."</td>";
		  			echo "<td><button class='btn btn-outline-success' onclick='approve(".$row['user_id'].")'>Approve</button> 
		  			<button class='btn btn-outline-danger' onclick='reject(".$row['user_id'].")'>Reject</button></td>";
		  			echo "</tr>";
		  		}
	  		} ?>
		  </tbody>
		</table>
	</div>
<?php } ?>

<?php

if (isset($_REQUEST['action']) && $_REQUEST['action'] == "approved") {?>
	<h2 class="text-uppercase fw-bolder text-center mt-5">Approved Users</h2>
	<div class="px-2">
		<table class="table table-dark table-striped text-center display" id="example">
		    <thead>
		    <tr>
		      <th scope="col">S. No 			</th>
		      <th scope="col">Image 			</th>
		      <th scope="col">Fullname 			</th>
		      <th scope="col">Email 			</th>
		      <th scope="col">Gender 			</th>
		      <th scope="col">Date Of Birth 	</th>
		      <th scope="col">Address 			</th>
		      <th scope="col">Status 			</th>
		      <th scope="col">Active/InActive 	</th>
		      <th scope="col">Created At 		</th>
		      <th scope="col">Update 			</th>
		    </tr>
		  </thead>
		  <tbody>
	    <?php if ($result_approved->num_rows > 0) {
	    		$serial = 0;
	  			while ($row = mysqli_fetch_assoc($result_approved)) {
		  			echo "<tr>";
		  			echo "<td>".++$serial."</td>";
		  			echo "<td><img class='rounded' src='../../images/".$row['user_image']."' alt='No Image' style='height: 50px;'></td>";
		  			echo "<td>".$row['first_name']." ".$row['last_name']."</td>";
		  			echo "<td>".$row['email']."</td>";
		  			echo "<td>".$row['gender']."</td>";
		  			echo "<td>".$row['date_of_birth']."</td>";
		  			echo "<td>".$row['address']."</td>";
		  			if ($row['is_active'] == 'Active') {
			  			echo "<td><button class='btn btn-success'>".$row['is_active']."</button></td>";
		  			} else if ($row['is_active'] == 'InActive') {
			  			echo "<td><button class='btn btn-danger'>".$row['is_active']."</button></td>";
		  			} else {
		  				echo "<td></td>";
		  			}
		  			echo "<td><button class='btn btn-outline-success' onclick='active(".$row['user_id'].")'>Active</button>
		  			<button class='btn btn-outline-danger' onclick='inactive(".$row['user_id'].")'>InActive</button></td>";
		  			echo "<td>".date("F dS", strtotime($row['created_at']))."</td>";
		  			echo "<td><button class='btn btn-outline-light' type='button' data-bs-toggle='modal' data-bs-target='#staticBackdropUpdateUser".$row['user_id']."'><svg class='me-2' xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil-square' viewBox='0 0 16 16'><path d='M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z'/><path fill-rule='evenodd' d='M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z'/></svg>Edit</button></td>";
		  			echo "</tr>";
		  		}
	  		} ?>
		  </tbody>
		</table>
	</div>

<?php } 

if (isset($_REQUEST['action']) && $_REQUEST['action'] == "rejected") {?>
	<h2 class="text-uppercase fw-bolder text-center mt-5">Rejected Accounts</h2>
	<div class="px-2 mb-2">
		<table class="table table-dark table-striped text-center display" id="example">
		    <thead>
		    <tr>
		      <th scope="col">S. No 			</th>
		      <th scope="col">Image 			</th>
		      <th scope="col">First Name 		</th>
		      <th scope="col">Last Name 		</th>
		      <th scope="col">Email 			</th>
		      <th scope="col">Gender 			</th>
		      <th scope="col">Date Of Birth 	</th>
		      <th scope="col">Address 			</th>
		      <th scope="col">Created At 		</th>
		    </tr>
		  </thead>
		  <tbody>
  		<?php if ($result_rejected->num_rows > 0) {
  				$serial = 0;
	  			while ($row = mysqli_fetch_assoc($result_rejected)) {
		  			echo "<tr>";
		  			echo "<td>".++$serial."</td>";
		  			echo "<td><img class='rounded' class='rounded' src='../../images/".$row['user_image']."' alt='No Image' style='height: 50px;'></td>";
		  			echo "<td>".$row['first_name']."</td>";
		  			echo "<td>".$row['last_name']."</td>";
		  			echo "<td>".$row['email']."</td>";
		  			echo "<td>".$row['gender']."</td>";
		  			echo "<td>".$row['date_of_birth']."</td>";
		  			echo "<td>".$row['address']."</td>";
		  			echo "<td>".date("F dS", strtotime($row['created_at']))."</td>";
		  			echo "</tr>";
		  		}
	  		} ?>
		  </tbody>
		</table>
	</div>
<?php
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';

$mail = new PHPMailer();
$mail->isSMTP();

$mail->Host = 'smtp.gmail.com';
$mail->Port = 587;
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$mail->SMTPAuth = true;
$mail->Username = 'hist6782@gmail.com';
$mail->Password = 'cfyapyrqekhngjod';

if (isset($_REQUEST['action']) && $_REQUEST['action'] == "approve") {
	$user_id = $_REQUEST['user_id'];
	
	$query = "SELECT * FROM user WHERE user_id = $user_id";
	$result = mysqli_query($connection, $query);
	if ($result->num_rows > 0) {
		$row = mysqli_fetch_assoc($result);
		$mail->setFrom($_SESSION['email']);
		$mail->addAddress($row['email']);
		$mail->Subject = "Account Approved";
		$mail->msgHTML("Congratulations! Your Account Has Been Approved");
	}

	if ($mail->send()) {
		$query = "UPDATE user SET is_approved = 'Approved' WHERE user_id = $user_id";
		$result = mysqli_query($connection, $query);
		if ($result) {
			$query = "SELECT * FROM user WHERE user_id = $user_id";
			$result = mysqli_query($connection, $query);
			if ($result->num_rows > 0) {
				$row = mysqli_fetch_assoc($result);
				echo "<div class='alert alert-primary alert-dismissible fade show text-center' role='alert'>
				<h4 class='text-center'>The Pending Account With Email '".$row['email']."' is Approved</h4>
				<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
			}
		}
	}
}

if (isset($_REQUEST['action']) && $_REQUEST['action'] == "reject") {
	$updated_at = date("Y-m-d H:i:s");
	$user_id = $_REQUEST['user_id'];
;
	$query = "SELECT * FROM user WHERE user_id = $user_id";
	$result = mysqli_query($connection, $query);
	if ($result->num_rows > 0) {
		$row = mysqli_fetch_assoc($result);
		$mail->setFrom($_SESSION['email']);
		$mail->addAddress($row['email']);
		$mail->Subject = "Account Rejected";
		$mail->msgHTML("Your Account Request Has Been Rejected");
	}
	if ($mail->send()) {
		$query = "UPDATE user SET is_approved = 'Rejected', updated_at = '".$updated_at."' WHERE user_id = $user_id";
		$result = mysqli_query($connection, $query);
		if ($result) {
			$query = "SELECT * FROM user WHERE user_id = $user_id";
			$result = mysqli_query($connection, $query);
			if ($result->num_rows > 0) {
				$row = mysqli_fetch_assoc($result);
				echo "<div class='alert alert-primary alert-dismissible fade show text-center' role='alert'>
				<h4 class='text-center'>The Pending Account With Email '".$row['email']."' is Rejected</h4>
				<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
			}
		}
	}
}

if (isset($_REQUEST['action']) && $_REQUEST['action'] == "active") {
	$user_id = $_REQUEST['user_id'];
;
	$query = "SELECT * FROM user WHERE user_id = $user_id";
	$result = mysqli_query($connection, $query);
	if ($result->num_rows > 0) {
		$row = mysqli_fetch_assoc($result);
		$mail->setFrom($_SESSION['email']);
		$mail->addAddress($row['email']);
		$mail->Subject = "Account Active";
		$mail->msgHTML("Your Account has been set Active");
	}
	if ($mail->send()) {
		$query = "UPDATE user SET is_active = 'Active' WHERE user_id = $user_id";
		$result = mysqli_query($connection, $query);
		if ($result) {
			$query = "SELECT * FROM user WHERE user_id = $user_id";
			$result = mysqli_query($connection, $query);
			if ($result->num_rows > 0) {
				$row = mysqli_fetch_assoc($result);
				echo "<div class='alert alert-primary alert-dismissible fade show text-center' role='alert'>
				<h4 class='text-center'>The Pending Account With Email '".$row['email']."' is Active</h4>
				<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
			}
		}
	}
}

if (isset($_REQUEST['action']) && $_REQUEST['action'] == "inactive") {
	$user_id = $_REQUEST['user_id'];
;
	$query = "SELECT * FROM user WHERE user_id = $user_id";
	$result = mysqli_query($connection, $query);
	if ($result->num_rows > 0) {
		$row = mysqli_fetch_assoc($result);
		$mail->setFrom($_SESSION['email']);
		$mail->addAddress($row['email']);
		$mail->Subject = "Account InActive";
		$mail->msgHTML("Your Account has been set InActive");
	}
	if ($mail->send()) {
		$query = "UPDATE user SET is_active = 'InActive' WHERE user_id = $user_id";
		$result = mysqli_query($connection, $query);
		if ($result) {
			$query = "SELECT * FROM user WHERE user_id = $user_id";
			$result = mysqli_query($connection, $query);
			if ($result->num_rows > 0) {
				$row = mysqli_fetch_assoc($result);
				echo "<div class='alert alert-primary alert-dismissible fade show text-center' role='alert'>
				<h4 class='text-center'>The Pending Account With Email '".$row['email']."' is InActive</h4>
				<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
			}
		}
	}
}

?>