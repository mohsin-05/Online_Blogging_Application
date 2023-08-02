<?php
session_start();
require("../../require/connection.php");

if (isset($_SESSION['user_id']) && $_SESSION['role_id'] == 1) {

$query_category = "SELECT * FROM category";
$result_category = mysqli_query($connection, $query_category);

while ($row = mysqli_fetch_assoc($result_category)) {
	$categories[] = $row;
}

$query_blog = "SELECT * FROM blog";
$result_blog = mysqli_query($connection, $query_blog);

while ($row = mysqli_fetch_assoc($result_blog)) {
	$blogs[] = $row;
}

$query_blog = "SELECT * FROM blog WHERE user_id = '".$_SESSION['user_id']."'";
$result_blog = mysqli_query($connection, $query_blog);

$query = "SELECT * FROM post INNER JOIN blog ON post.blog_id = blog.blog_id WHERE blog.user_id = '".$_SESSION['user_id']."' ORDER BY post_id DESC";
$result = mysqli_query($connection, $query);

$page = "post/manage-posts.php";
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Manage Posts</title>
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



<div id="show_table"></div>



<!-- Sidebar -->

<?php
include("../admin-require/admin-sidebar.php");
?>

<!-- Sidebar End -->



<script>
	setInterval(function() { document.getElementById('show_message').innerHTML = "" }, 3000);

	function show_post() {
		var obj;
		if (window.ActiveXObject) {
			obj = new ActiveXObject("Microsoft.XMLHTTP");
		} else {
			obj = new XMLHttpRequest();
		}

		obj.onreadystatechange = function() {
			if (obj.readyState == 4 && obj.status == 200) {
				document.getElementById('table').innerHTML = obj.responseText;
				$('#example').DataTable();
			}
		}

		obj.open("GET", "post-table-process.php?action=show_post")
		obj.send();
	}

	function show_attachments(post_id) {
		var obj;
		if (window.ActiveXObject) {
			obj = new ActiveXObject("Microsoft.XMLHTTP");
		} else {
			obj = new XMLHttpRequest();
		}

		obj.onreadystatechange = function() {
			if (obj.readyState == 4 && obj.status == 200) {
				document.getElementById('table').innerHTML = obj.responseText;
				$('#example').DataTable();
			}
		}

		obj.open("GET", "post-table-process.php?action=show_attachment&post_id="+post_id)
		obj.send();
	}

	function active(post_id) {
		var obj;
		if (window.ActiveXObject) {
			obj = new ActiveXObject("Microsoft.XMLHTTP");
		} else {
			obj = new XMLHttpRequest();
		}

		obj.onreadystatechange = function() {
			if (obj.readyState == 4 && obj.status == 200) {
				document.getElementById('show_message').innerHTML = obj.responseText;
				show_post();
			}
		}

		obj.open("GET", "update-post-process.php?action=active&post_id="+post_id)
		obj.send();
	}

	function inactive(post_id) {
		var obj;
		if (window.ActiveXObject) {
			obj = new ActiveXObject("Microsoft.XMLHTTP");
		} else {
			obj = new XMLHttpRequest();
		}

		obj.onreadystatechange = function() {
			if (obj.readyState == 4 && obj.status == 200) {
				document.getElementById('show_message').innerHTML = obj.responseText;
				show_post();
			}
		}

		obj.open("GET", "update-post-process.php?action=inactive&post_id="+post_id)
		obj.send();
	}

	function active_attachment(post_attachment_id, post_id) {
		var obj;
		if (window.ActiveXObject) {
			obj = new ActiveXObject("Microsoft.XMLHTTP");
		} else {
			obj = new XMLHttpRequest();
		}

		obj.onreadystatechange = function() {
			if (obj.readyState == 4 && obj.status == 200) {
				document.getElementById('show_message').innerHTML = obj.responseText;
				show_attachments(post_id);
			}
		}

		obj.open("GET", "update-post-process.php?action=active_attachment&post_attachment_id="+post_attachment_id)
		obj.send();
	}

	function inactive_attachment(post_attachment_id, post_id) {
		var obj;
		if (window.ActiveXObject) {
			obj = new ActiveXObject("Microsoft.XMLHTTP");
		} else {
			obj = new XMLHttpRequest();
		}

		obj.onreadystatechange = function() {
			if (obj.readyState == 4 && obj.status == 200) {
				document.getElementById('show_message').innerHTML = obj.responseText;
				show_attachments(post_id);
			}
		}

		obj.open("GET", "update-post-process.php?action=inactive_attachment&post_attachment_id="+post_attachment_id)
		obj.send();
	}
</script>

<div class="text-center mt-5" id="show_message"></div>

<center>
	<button class="btn btn-outline-dark" onclick="show_post();">Show Post Table</button>
</center>

<div id="table"></div>

<?php
if ($result->num_rows > 0) {
	while ($rows = mysqli_fetch_assoc($result)) {
		$query_category = "SELECT * FROM category INNER JOIN post_category ON category.`category_id` = post_category.`category_id` 
		INNER JOIN post ON post_category.`post_id` = post.`post_id` WHERE post.`post_id` = '".$rows['post_id']."'";
		$result_category = mysqli_query($connection, $query_category);
		$row_category = mysqli_fetch_assoc($result_category);

		$query_blog = "SELECT * FROM blog INNER JOIN post ON blog.`blog_id` = post.`blog_id` WHERE post.`post_id` = '".$rows['post_id']."'";
		$result_blog = mysqli_query($connection, $query_blog);
		$row_blog = mysqli_fetch_assoc($result_blog);
		?>

		<!-- Modal Update Post -->

			<div class="modal fade" id="staticBackdropUpdatePost<?php echo $rows['post_id']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h1 class="modal-title fs-5" id="staticBackdropLabel">Update Post</h1>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">
							<form class="row g-3 needs-validation" action="../post/update-post-process.php" method="POST" enctype="multipart/form-data" novalidate>
								<div class="col-md-6 position-relative">
									<label for="validationCustom01" class="form-label">Post Title</label>
									<input type="text" value="<?php echo $rows['post_title']; ?>" name="post_title" class="form-control" id="validationCustom01" placeholder="Enter Post Title" required>
									<div class="valid-tooltip">
										Looks good!
									</div>
									<div class="invalid-tooltip">
										Please Enter Post Title!
									</div>
								</div>
								<div class="col-md-6 position-relative">
									<label for="validationCustom02" class="form-label">Post Summary</label>
									<input type="text" value="<?php echo $rows['post_summary']; ?>" name="post_summary" class="form-control" id="validationCustom02" placeholder="Enter Post Summary" required>
									<div class="valid-tooltip">
										Looks good!
									</div>
									<div class="invalid-tooltip">
										Please Enter Post Summary!
									</div>
								</div>
								<div class="col-md-4">
									<label for="validationCustom02" class="form-label">Category</label>
									<select class="form-select" name="category" id="validationCustom02" required>
										<option selected value="<?php echo $row_category['category_id']; ?>"><?php echo $row_category['category_title']; ?></option>
										<?php foreach ($categories as $key => $value) { ?>
											<option value="<?php echo $value['category_id']; ?>"><?php echo $value['category_title']; ?></option>
											<?php
										} ?>
									</select>
									<div class="invalid-feedback">
										Please select an option.
									</div>
								</div>
								<div class="col-md-4">
									<label for="validationCustom03" class="form-label">Blog</label>
									<select class="form-select" name="blog" id="validationCustom03" required>
										<option selected value="<?php echo $row_blog['blog_id']; ?>"><?php echo $row_blog['blog_title']; ?></option>
										<?php foreach ($blogs as $key => $value) { ?>
											<option value="<?php echo $value['blog_id']; ?>"><?php echo $value['blog_title']; ?></option>
											<?php
										} ?>
									</select>
									<div class="invalid-feedback">
										Please select an option.
									</div>
								</div>
								<div class="col-md-6 position-relative">
									<label for="comment_allowed" class="form-label">Comment Allowed</label>
									<div class="form-check">
										<input class="form-check-input" type="radio" name="comment_allowed" value="1" id="flexRadioDefault1" <?php if ($rows['is_comment_allowed'] == 1) { echo "checked"; } ?>>
										<label class="form-check-label" for="flexRadioDefault1">
											Yes
										</label>
									</div>
									<div class="form-check position-relative">
										<input class="form-check-input" type="radio" name="comment_allowed" value="0" id="flexRadioDefault2" <?php if ($rows['is_comment_allowed'] == 0) { echo "checked"; } ?>>
										<label class="form-check-label" for="flexRadioDefault2">
											No
										</label>
									</div>
									<div class="valid-tooltip">
										Looks good!
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
									<label for="validationCustom08" class="form-label">Add Attachments</label>
									<input type="file" name="upload_attachment[]" class="form-control" id="validationCustom08" multiple>
								</div>
								<div class="col-md-8 position-relative">
									<label for="validationTextarea" class="form-label">Post Description</label>
									<textarea class="form-control" name="post_description" id="validationTextarea" placeholder="Enter Post Description" required><?php echo $rows['post_description']; ?></textarea>
									<div class="valid-tooltip">
										Looks good!
									</div>
									<div class="invalid-tooltip">
										Please Provide a Post Description!
									</div>
								</div>
							</div>
							<div class="modal-footer">
								<input type="hidden" name="post_id" value="<?php echo $rows['post_id']; ?>">
								<input type="hidden" name="page" value="<?php if (isset($page)) { echo $page; } ?>">
								<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
								<input type="submit" name="update_post" value="Update Post" class="btn" style="background-color: #2D2727; color: white;">
							</form>
							<button class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#staticBackdropUpdateAttachment<?php echo $rows['post_id']; ?>">Update Attachments</button>
						</div>
					</div>
				</div>
			</div>

		<!-- Modal Update Post End -->

<?php
	}	
} 



include ("../../require/footer.php");

} else {
	header("location:../../index.php");
}
?>