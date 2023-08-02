<?php
session_start();
require("../../require/connection.php");

if (isset($_SESSION['user_id']) && $_SESSION['role_id'] == 1) {

$query = "SELECT * FROM category ORDER BY category_id DESC";
$result = mysqli_query($connection, $query);

$page = "category/manage-category.php";
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Manage Category</title>
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

	function show_category() {
		var obj;
		if (window.ActiveXObject) {
			obj = new ActiveXObject("Microsoft.XMLHTTP");
		} else {
			obj = new XMLHttpRequest();
		}

		obj.onreadystatechange = function() {
			if (obj.readyState == 4 && obj.status == 200) {
				document.getElementById('category_table').innerHTML = obj.responseText;
				$('#example').DataTable();
			}
		}

		obj.open("GET", "category-table-process.php?action=show_category")
		obj.send();
	}

	function active(category_id) {
		var obj;
		if (window.ActiveXObject) {
			obj = new ActiveXObject("Microsoft.XMLHTTP");
		} else {
			obj = new XMLHttpRequest();
		}

		obj.onreadystatechange = function() {
			if (obj.readyState == 4 && obj.status == 200) {
				document.getElementById('show_message').innerHTML = obj.responseText;
				show_category();
			}
		}

		obj.open("GET", "update-category-process.php?action=active&category_id="+category_id)
		obj.send();
	}

	function inactive(category_id) {
		var obj;
		if (window.ActiveXObject) {
			obj = new ActiveXObject("Microsoft.XMLHTTP");
		} else {
			obj = new XMLHttpRequest();
		}

		obj.onreadystatechange = function() {
			if (obj.readyState == 4 && obj.status == 200) {
				document.getElementById('show_message').innerHTML = obj.responseText;
				show_category();
			}
		}

		obj.open("GET", "update-category-process.php?action=inactive&category_id="+category_id)
		obj.send();
	}
</script>

<div class="text-center mt-5" id="show_message"></div>

<center>
<button class="btn btn-outline-dark" onclick="show_category();">Show Category Table</button>
</center>

<div id="category_table"></div>

<?php
if ($result->num_rows > 0) {
	while ($row = mysqli_fetch_assoc($result)) { ?>

		<!-- Modal Update Category -->

			<div class="modal fade" id="staticBackdropUpdateCategory<?php echo $row['category_id']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h1 class="modal-title fs-5" id="staticBackdropLabel">Update Category</h1>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">
							<form class="row g-3 needs-validation" action="../category/update-category-process.php" method="POST" novalidate>
								<div class="col-md-6 position-relative">
									<label for="validationCustom01" class="form-label">Category Title</label>
									<input type="text" value="<?php echo $row['category_title']; ?>" name="category_title" class="form-control" id="validationCustom01" placeholder="Enter Category Title" required>
									<div class="valid-tooltip">
										Looks good!
									</div>
									<div class="invalid-tooltip">
										Please Enter Category Title!
									</div>
								</div>
								<div class="col-md-6 position-relative">
									<label for="validationCustom02" class="form-label">Category Description</label>
									<input type="text" value="<?php echo $row['category_description']; ?>" name="category_description" class="form-control" id="validationCustom02" placeholder="Enter Category Description" required>
									<div class="valid-tooltip">
										Looks good!
									</div>
									<div class="invalid-tooltip">
										Please Enter Category Description!
									</div>
								</div>
							</div>
							<div class="modal-footer">
								<input type="hidden" name="category_id" value="<?php echo $row['category_id']; ?>">
								<input type="hidden" name="page" value="<?php if (isset($page)) { echo $page; } ?>">
								<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
								<input type="submit" name="update_category" value="Update Category" class="btn" style="background-color: #2D2727; color: white;">
							</form>
						</div>
					</div>
				</div>
			</div>

		<!-- Modal Create Category End -->

		<?php
	}
} ?>

<?php
include ("../../require/footer.php");
} else {
	header("location:../../index.php");
}
?>