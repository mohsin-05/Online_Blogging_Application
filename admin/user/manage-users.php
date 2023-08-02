<?php
session_start();
require("../../require/connection.php");

if (isset($_SESSION['first_name']) && $_SESSION['role_id'] == 1) {

$query_pending = "SELECT * FROM USER WHERE is_approved = 'Pending' ORDER BY user_id DESC";
$result_pending = mysqli_query($connection, $query_pending);

$query_approved = "SELECT * FROM USER WHERE is_approved = 'Approved' ORDER BY user_id DESC";
$result_approved = mysqli_query($connection, $query_approved);

$query_rejected = "SELECT * FROM USER WHERE is_approved = 'Rejected' ORDER BY user_id DESC";
$result_rejected = mysqli_query($connection, $query_rejected);

$page = "user/manage-users.php"
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Manage Users</title>
	<link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
	<script type="text/javascript" src="../../bootstrap/js/bootstrap.bundle.min.js"></script>
	<style>
		.navbar{
			background-color: #2D2727;
		}
		td{
			text-align: center;
  			vertical-align: middle;
		}
		th{
			text-align: center;
  			vertical-align: middle;
		}
	</style>
</head>
<body>


<!-- Navbar -->

<?php
include("../admin-require/admin-navbar.php");
?>

<!-- Navbar End -->


<!-- Sidebar -->

<?php
include("../admin-require/admin-sidebar.php");
?>

<!-- Sidebar End -->


<script>
	setInterval(function() { document.getElementById('show_message').innerHTML = "" }, 7000);

	function user_table(table) {
		var obj;
		if (window.ActiveXObject) {
			obj = new ActiveXObject("Microsoft.XMLHTTP");
		} else {
			obj = new XMLHttpRequest();
		}

		obj.onreadystatechange = function() {
			if (obj.readyState == 4 && obj.status == 200) {
				document.getElementById('show_table').innerHTML = obj.responseText;
				$('#example').DataTable();
			}
		}

		obj.open("GET", "user-tables-process.php?action="+table);
		obj.send();
	}

	function approve(user_id) {
		var obj;
		if (window.ActiveXObject) {
			obj = new ActiveXObject("Microsoft.XMLHTTP");
		} else {
			obj = new XMLHttpRequest();
		}

		obj.onreadystatechange = function() {
			if (obj.readyState == 4 && obj.status == 200) {
				user_table("Pending");
				document.getElementById('show_message').innerHTML = obj.responseText;
				user_table('pending');
			}
		}

		obj.open("GET", "user-tables-process.php?action=approve&user_id="+user_id)
		obj.send();
	}

	function reject(user_id) {
		var obj;
		if (window.ActiveXObject) {
			obj = new ActiveXObject("Microsoft.XMLHTTP");
		} else {
			obj = new XMLHttpRequest();
		}

		obj.onreadystatechange = function() {
			if (obj.readyState == 4 && obj.status == 200) {
				user_table("Pending");
				document.getElementById('show_message').innerHTML = obj.responseText;
				user_table('pending');
			}
		}

		obj.open("GET", "user-tables-process.php?action=reject&user_id="+user_id)
		obj.send();
	}

	function active(user_id) {
		var obj;
		if (window.ActiveXObject) {
			obj = new ActiveXObject("Microsoft.XMLHTTP");
		} else {
			obj = new XMLHttpRequest();
		}

		obj.onreadystatechange = function() {
			if (obj.readyState == 4 && obj.status == 200) {
				document.getElementById('show_message').innerHTML = obj.responseText;
				user_table('approved');
			}
		}

		obj.open("GET", "user-tables-process.php?action=active&user_id="+user_id)
		obj.send();
	}

	function inactive(user_id) {
		var obj;
		if (window.ActiveXObject) {
			obj = new ActiveXObject("Microsoft.XMLHTTP");
		} else {
			obj = new XMLHttpRequest();
		}

		obj.onreadystatechange = function() {
			if (obj.readyState == 4 && obj.status == 200) {
				document.getElementById('show_message').innerHTML = obj.responseText;
				user_table('approved');
			}
		}

		obj.open("GET", "user-tables-process.php?action=inactive&user_id="+user_id)
		obj.send();
	}
</script>

<div class="m-5" align="center">
	<button class="btn btn-outline-primary mx-2" onclick="user_table('pending');">Pending</button>
	<button class="btn btn-outline-success mx-2" onclick="user_table('approved');">Approved</button>
	<button class="btn btn-outline-danger mx-2" onclick="user_table('rejected');">Rejected</button>
</div>

<div id="show_table"></div>

<?php
include ("../../require/footer.php");


if ($result_approved->num_rows > 0) {
	while ($row = mysqli_fetch_assoc($result_approved)) { ?>
		<div class="modal fade" id="staticBackdropUpdateUser<?php echo $row['user_id']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h1 class="modal-title fs-5" id="staticBackdropLabel">Update User</h1>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<form class="row g-3 needs-validation" action="update-user-process.php" method="POST" enctype="multipart/form-data" accept="image/*" novalidate>
							<?php if (isset($_REQUEST['update_user_message'])) {
								echo "<div class='text-danger'>".$_REQUEST['update_user_message']."</div>";
							} ?>
							<div class="col-md-6 position-relative">
								<label for="validationCustom01" class="form-label">First Name</label>
								<input type="text" name="first_name" class="form-control" id="validationCustom01" placeholder="Enter First Name" 
								<?php if (isset($row['first_name'])) {
									echo "value='".$row['first_name']."'";
								} ?> required>
								<div class="valid-tooltip">
									Looks good!
								</div>
								<div class="invalid-tooltip">
									Please Enter First Name!
								</div>
							</div>
							<div class="col-md-6 position-relative">
								<label for="validationCustom02" class="form-label">Last Name</label>
								<input type="text" name="last_name" class="form-control" id="validationCustom02" placeholder="Enter Last Name" 
								<?php if (isset($row['last_name'])) {
									echo "value='".$row['last_name']."'";
								} ?> required>
								<div class="valid-tooltip">
									Looks good!
								</div>
								<div class="invalid-tooltip">
									Please Enter Last Name!
								</div>
							</div>
							<div class="col-md-6 position-relative">
								<label for="gender" class="form-label">Gender</label>
								<div class="form-check">
									<input class="form-check-input" value="Male" name="gender" type="radio" id="flexRadioDefault1" <?php if (isset($row['gender']) && $row['gender'] == "Male") {
										echo "checked"; 
									} ?>>
									<label class="form-check-label" for="flexRadioDefault1">
										Male
									</label>
								</div>
								<div class="form-check position-relative">
									<input class="form-check-input" value="Female" type="radio" name="gender" id="flexRadioDefault2" <?php if (isset($row['gender']) && $row['gender'] == "Female") {
										echo "checked";
									} ?>>
									<label class="form-check-label" for="flexRadioDefault2">
										Female
									</label>
								</div>
								<div class="valid-tooltip">
									Looks good!
								</div>
								<div class="invalid-tooltip">
									Please Select Gender!
								</div>
							</div>
							<div class="col-md-6 position-relative">
								<label for="validationCustom06" class="form-label">Date of Birth</label>
								<input type="date" name="date_of_birth" class="form-control" id="validationCustom06" 
								<?php if (isset($row['date_of_birth'])) {
									echo "value='".$row['date_of_birth']."'";
								} ?> required>
								<div class="valid-tooltip">
									Looks good!
								</div>
								<div class="invalid-tooltip">
									Please Select Date of Birth!
								</div>
							</div>
							<div class="col-md-8 position-relative">
								<label for="validationCustom07" class="form-label">Upload Image</label>
								<input type="file" name="upload_image" class="form-control" id="validationCustom07">
								<div class="valid-tooltip">
									Looks good!
								</div>
								<div class="invalid-tooltip">
									Please Upload Image!
								</div>
							</div>
							<div class="col-md-8 position-relative">
								<label for="validationTextarea" class="form-label">Address</label>
								<textarea class="form-control" name="address" id="validationTextarea" required><?php if (isset($row['address'])) {
									echo $row['address'];
								} ?></textarea>
								<div class="valid-tooltip">
									Looks good!
								</div>
								<div class="invalid-tooltip">
									Please Provide a Valid Address!
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<input type="hidden" name="user_id" value="<?php echo $row['user_id'] ?>">
							<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
		        			<input type="submit" name="register" value="Update" class="btn" style="background-color: #2D2727; color: white;">
		        		</form>
		        		<button class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#staticBackdropChangeRole<?php echo $row['user_id']; ?>">Change Role</button>
		        	</div>
		        </div>
		    </div>
		</div>

		<div class="modal fade" id="staticBackdropChangeRole<?php echo $row['user_id']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h1 class="modal-title fs-5" id="staticBackdropLabel">Change Role</h1>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<form class="row g-3 needs-validation" action="update-user-process.php" method="POST" novalidate>
							<div class="col-md-6 position-relative">
								<label for="role" class="form-label">Role</label>
								<div class="form-check">
									<input class="form-check-input" value="1" name="role" type="radio" id="flexRadioDefault1">
									<label class="form-check-label" for="flexRadioDefault1">
										Admin
									</label>
								</div>
								<div class="form-check position-relative">
									<input class="form-check-input" value="2" type="radio" name="role" id="flexRadioDefault2" checked>
									<label class="form-check-label" for="flexRadioDefault2">
										User
									</label>
								</div>
								<div class="valid-tooltip">
									Looks good!
								</div>
								<div class="invalid-tooltip">
									Please Select Gender!
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<input type="hidden" name="user_id" value="<?php echo $row['user_id'] ?>">
					        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
					        <input type="submit" name="change_role" value="Update" class="btn" style="background-color: #2D2727; color: white;">
					    </form>
					</div>
				</div>
			</div>
		</div>
		<?php
	}
} 

} else {
	header("location:../../index.php");
}
?>