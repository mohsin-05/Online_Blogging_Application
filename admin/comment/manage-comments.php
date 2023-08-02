<?php
session_start();
require("../../require/connection.php");

if (isset($_SESSION['user_id']) && $_SESSION['role_id'] == 1) {

$query_comment = "SELECT * FROM post_comment ORDER BY post_comment_id DESC";
$result_comment = mysqli_query($connection, $query_comment);

$page = "comment/manage-comments.php";
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Manage Comments</title>
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

	function comment_table() {
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

		obj.open("GET", "comment-table-process.php?action=show_table");
		obj.send();
	}

	function active(comment_id) {
		var obj;
		if (window.ActiveXObject) {
			obj = new ActiveXObject("Microsoft.XMLHTTP");
		} else {
			obj = new XMLHttpRequest();
		}

		obj.onreadystatechange = function() {
			if (obj.readyState == 4 && obj.status == 200) {
				document.getElementById('show_message').innerHTML = obj.responseText;
				comment_table();
			}
		}

		obj.open("GET", "comment-table-process.php?action=active&comment_id="+comment_id)
		obj.send();
	}

	function inactive(comment_id) {
		var obj;
		if (window.ActiveXObject) {
			obj = new ActiveXObject("Microsoft.XMLHTTP");
		} else {
			obj = new XMLHttpRequest();
		}

		obj.onreadystatechange = function() {
			if (obj.readyState == 4 && obj.status == 200) {
				document.getElementById('show_message').innerHTML = obj.responseText;
				comment_table();
			}
		}

		obj.open("GET", "comment-table-process.php?action=inactive&comment_id="+comment_id)
		obj.send();
	}
</script>

<div class="m-5" align="center">
<button class="btn btn-outline-dark mx-2" onclick="comment_table();">Show All Comments</button>
</div>

<div class="text-center" id="show_message"><?php if (isset($_REQUEST['update_message'])) {
	echo "<h4>".$_REQUEST['update_message']."</h4>";
} ?></div>

<div id="show_table"></div>


<?php
if ($result_comment->num_rows > 0) {
	while ($row = mysqli_fetch_assoc($result_comment)) { ?>

<!-- Modal Update Comment -->

	<div class="modal fade" id="staticBackdropUpdateComment<?php echo $row['post_comment_id']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h1 class="modal-title fs-5" id="staticBackdropLabel">Update Comment</h1>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<form class="row g-3 needs-validation" action="update-comment-process.php" method="POST" novalidate>
						<div class="col-md-6 position-relative">
							<label for="validationCustom01" class="form-label">Post Comment</label>
							<input type="text" name="comment" class="form-control" id="validationCustom01" placeholder="Enter Post Comment" value="<?php echo $row['comment']; ?>" required>
							<div class="valid-tooltip">
								Looks good!
							</div>
							<div class="invalid-tooltip">
								Please Enter Post Comment!
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<input type="hidden" name="post_comment_id" value="<?php echo $row['post_comment_id']; ?>">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
						<input type="submit" name="update_comment" value="Send" class="btn" style="background-color: #2D2727; color: white;">
					</form>
				</div>
			</div>
		</div>
	</div>

<!-- Modal Update Comment End -->

	<?php
	}
} 


include ("../../require/footer.php");

} else {
	header("location:../../index.php");
}
?>