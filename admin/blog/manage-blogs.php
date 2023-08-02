<?php
session_start();
require("../../require/connection.php");

if (isset($_SESSION['user_id']) && $_SESSION['role_id'] == 1) {

$query = "SELECT * FROM blog WHERE user_id = '".$_SESSION['user_id']."' ORDER BY blog_id DESC";
$result = mysqli_query($connection, $query);

$page = "blog/manage-blogs.php";
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Manage Blogs</title>
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
	setInterval(function() { document.getElementById('show_message').innerHTML = "" }, 3000);

	function show_blog() {
		var obj;
		if (window.ActiveXObject) {
			obj = new ActiveXObject("Microsoft.XMLHTTP");
		} else {
			obj = new XMLHttpRequest();
		}

		obj.onreadystatechange = function() {
			if (obj.readyState == 4 && obj.status == 200) {
				document.getElementById('blog_table').innerHTML = obj.responseText;
				$('#example').DataTable();
			}
		}

		obj.open("GET", "blog-table-process.php?action=show_blog")
		obj.send();
	}

	function active(blog_id) {
		var obj;
		if (window.ActiveXObject) {
			obj = new ActiveXObject("Microsoft.XMLHTTP");
		} else {
			obj = new XMLHttpRequest();
		}

		obj.onreadystatechange = function() {
			if (obj.readyState == 4 && obj.status == 200) {
				document.getElementById('show_message').innerHTML = obj.responseText;
				show_blog();
			}
		}

		obj.open("GET", "update-blog-process.php?action=active&blog_id="+blog_id)
		obj.send();
	}

	function inactive(blog_id) {
		var obj;
		if (window.ActiveXObject) {
			obj = new ActiveXObject("Microsoft.XMLHTTP");
		} else {
			obj = new XMLHttpRequest();
		}

		obj.onreadystatechange = function() {
			if (obj.readyState == 4 && obj.status == 200) {
				document.getElementById('show_message').innerHTML = obj.responseText;
				show_blog();
			}
		}

		obj.open("GET", "update-blog-process.php?action=inactive&blog_id="+blog_id)
		obj.send();
	}
</script>



<div class="text-center mt-5" id="show_message"></div>



<center>
	<button class="btn btn-outline-dark" onclick="show_blog();">Show Blog Table</button>
</center>



<div id="blog_table"></div>



<?php
if ($result->num_rows > 0) {
	while ($row = mysqli_fetch_assoc($result)) { ?>

		<!-- Modal Update Blog -->

			<div class="modal fade" id="staticBackdropUpdateBlog<?php echo $row['blog_id']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h1 class="modal-title fs-5" id="staticBackdropLabel">Update Blog</h1>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">
							<form class="row g-3 needs-validation" action="../blog/update-blog-process.php" method="POST" enctype="multipart/form-data" novalidate>
								<div class="col-md-6 position-relative">
									<label for="validationCustom01" class="form-label">Blog Title</label>
									<input type="text" name="blog_title" class="form-control" id="validationCustom01" placeholder="Enter Blog Title" value="<?php echo $row['blog_title']; ?>" required>
									<div class="valid-tooltip">
										Looks good!
									</div>
									<div class="invalid-tooltip">
										Please Enter Blog Title!
									</div>
								</div>
								<div class="col-md-4">
									<label for="validationCustom02" class="form-label">Post Per Page</label>
									<select class="form-select" name="post_per_page" id="validationCustom02" required>
										<option selected value="<?php echo $row['post_per_page']; ?>"><?php echo $row['post_per_page']; ?></option>
										<option value="5">5</option>
										<option value="10">10</option>
										<option value="15">15</option>
									</select>
									<div class="invalid-feedback">
										Please select an option.
									</div>
								</div>
								<div class="col-md-8 position-relative">
									<label for="validationCustom07" class="form-label">Upload Blog Background Image</label>
									<input type="file" name="upload_image" class="form-control" id="validationCustom07">
									<div class="valid-tooltip">
										Looks good!
									</div>
									<div class="invalid-tooltip">
										Please Upload Image!
									</div>
								</div>
							</div>
							<div class="modal-footer">
								<input type="hidden" name="blog_id" value="<?php echo $row['blog_id']; ?>">
								<input type="hidden" name="page" value="<?php if (isset($page)) { echo $page; } ?>">
								<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
								<input type="submit" name="update_blog" value="Update Blog" class="btn" style="background-color: #2D2727; color: white;">
							</form>
						</div>
					</div>
				</div>
			</div>

		<!-- Modal Update Blog End -->

<?php
	}
}

include ("../../require/footer.php");
} else {
	header("location:../../index.php");
}
?>