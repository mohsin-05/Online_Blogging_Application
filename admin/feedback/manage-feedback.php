<?php
session_start();
if (isset($_SESSION['user_id']) && $_SESSION['role_id'] == 1) {
	
require("../../require/connection.php");

$query = "SELECT * FROM user_feedback ORDER BY feedback_id DESC";
$result = mysqli_query($connection, $query);

$page = "feedback/manage-feedback.php";
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Manage Feedback</title>
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
	setInterval(function() { document.getElementById('show_message').innerHTML = "" }, 3000);

	function show_feedback() {
		var obj;
		if (window.ActiveXObject) {
			obj = new ActiveXObject("Microsoft.XMLHTTP");
		} else {
			obj = new XMLHttpRequest();
		}

		obj.onreadystatechange = function() {
			if (obj.readyState == 4 && obj.status == 200) {
				document.getElementById('feedback_table').innerHTML = obj.responseText;
				$('#example').DataTable();
			}
		}

		obj.open("GET", "feedback-table-process.php?action=show_feedback")
		obj.send();
	}

	function active(feedback_id) {
		var obj;
		if (window.ActiveXObject) {
			obj = new ActiveXObject("Microsoft.XMLHTTP");
		} else {
			obj = new XMLHttpRequest();
		}

		obj.onreadystatechange = function() {
			if (obj.readyState == 4 && obj.status == 200) {
				document.getElementById('show_message').innerHTML = obj.responseText;
				show_feedback();
			}
		}

		obj.open("GET", "update-feedback-process.php?action=active&feedback_id="+feedback_id)
		obj.send();
	}

	function inactive(feedback_id) {
		var obj;
		if (window.ActiveXObject) {
			obj = new ActiveXObject("Microsoft.XMLHTTP");
		} else {
			obj = new XMLHttpRequest();
		}

		obj.onreadystatechange = function() {
			if (obj.readyState == 4 && obj.status == 200) {
				document.getElementById('show_message').innerHTML = obj.responseText;
				show_feedback();
			}
		}

		obj.open("GET", "update-feedback-process.php?action=inactive&feedback_id="+feedback_id)
		obj.send();
	}
</script>

<div class="text-center mt-5" id="show_message"></div>

<center>
	<button class="btn btn-outline-dark" onclick="show_feedback();">Show Feedback Table</button>
</center>

<div id="feedback_table"></div>

<?php
if ($result->num_rows > 0) {
	while ($row = mysqli_fetch_assoc($result)) { ?>

		<!-- Modal Update Feedback -->

			<div class="modal fade" id="staticBackdropUpdateFeedback<?php echo $row['feedback_id']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h1 class="modal-title fs-5" id="staticBackdropLabel">Feedback</h1>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">
							<form class="row g-3 needs-validation" action="../feedback/update-feedback-process.php" method="POST" novalidate>
								<div class="mb-3 position-relative">
									<label for="validationCustom01" class="form-label">Name</label>
									<input type="text" name="sender_name" class="form-control" id="validationCustom01" placeholder="Enter Name" value="<?php echo $row['user_name']; ?>" required>
									<div class="valid-tooltip">
										Looks good!
									</div>
								</div>
								<div class="mb-3 position-relative">
									<label for="validationCustom02" class="form-label">Email</label>
									<input type="text" name="sender_email" class="form-control" id="validationCustom02" placeholder="Enter Email" value="<?php echo $row['user_email']; ?>" required>
									<div class="valid-feedback">
										Looks good!
									</div>
									<div class="invalid-tooltip">
										Please Enter Email.
									</div>
								</div>
								<div class="mb-3 position-relative">
									<label for="validationTextarea" class="form-label">Message</label>
									<textarea class="form-control" name="feedback" id="validationTextarea" placeholder="Enter Message" required><?php echo $row['feedback']; ?></textarea>
									<div class="invalid-tooltip">
										Please Enter Message.
									</div>
								</div>
							</div>
							<div class="modal-footer">
								<input type="hidden" name="feedback_id" value="<?php echo $row['feedback_id']; ?>">
								<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
								<input type="submit" name="update_feedback" value="Send" class="btn" style="background-color: #2D2727; color: white;">
							</form>
						</div>
					</div>
				</div>
			</div>

		<!-- Modal Update Feedback End -->
		
	<?php
	}
}

include ("../../require/footer.php");

} else {
	header("location:../../index.php");
}
?>