<?php
session_start();
require("../../require/connection.php");
if (isset($_SESSION['first_name'])) {

$query_setting = "SELECT * FROM setting WHERE user_id = '".$_SESSION['user_id']."'";
$result_setting = mysqli_query($connection, $query_setting);

$page = "setting/manage-settings.php";

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Theme Settings</title>
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
include("../user-require/user-navbar.php");
?>

<!-- Navbar End -->


<!-- Sidebar -->

<?php
include("../user-require/user-sidebar.php");
?>

<!-- Sidebar End -->

<script>
	setInterval(function() { document.getElementById('show_message').innerHTML = "" }, 7000);

	function show_table() {
		var obj;
		if (window.ActiveXObject) {
			obj = new ActiveXObject("Microsoft.XMLHTTP");
		} else {
			obj = new XMLHttpRequest();
		}

		obj.onreadystatechange = function() {
			if (obj.readyState == 4 && obj.status == 200) {
				document.getElementById('show_table').innerHTML = obj.responseText;
			}
		}

		obj.open("GET", "update-theme-settings-process.php?action=show_table");
		obj.send();
	}

	function active(setting_id) {
		var obj;
		if (window.ActiveXObject) {
			obj = new ActiveXObject("Microsoft.XMLHTTP");
		} else {
			obj = new XMLHttpRequest();
		}

		obj.onreadystatechange = function() {
			if (obj.readyState == 4 && obj.status == 200) {
				document.getElementById('show_message').innerHTML = obj.responseText;
				show_table();
			}
		}

		obj.open("GET", "update-theme-settings-process.php?action=active&setting_id="+setting_id)
		obj.send();
	}

	function inactive(setting_id) {
		var obj;
		if (window.ActiveXObject) {
			obj = new ActiveXObject("Microsoft.XMLHTTP");
		} else {
			obj = new XMLHttpRequest();
		}

		obj.onreadystatechange = function() {
			if (obj.readyState == 4 && obj.status == 200) {
				document.getElementById('show_message').innerHTML = obj.responseText;
				show_table();
			}
		}

		obj.open("GET", "update-theme-settings-process.php?action=inactive&setting_id="+setting_id)
		obj.send();
	}
</script>

<div class="m-5" align="center">
<button class="btn btn-outline-dark" onclick="show_table();">Show Settings Table</button>
</div>

<div id="show_table"></div>

<?php
if ($result_setting->num_rows > 0) {
	$serial = 0;
	while ($rows_setting = mysqli_fetch_assoc($result_setting)) {
?>

<!-- Modal Update Theme -->

	<div class="modal fade" id="staticBackdropUpdateTheme<?php echo $rows_setting['setting_id']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h1 class="modal-title fs-5" id="staticBackdropLabel">Update Theme</h1>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body row">
					<form class="row g-3 needs-validation" action="../setting/update-theme-settings-process.php" method="POST" novalidate>
						<div class="col-md-6 position-relative">
							<label for="validationCustom01" class="form-label">Post Theme Key</label>
							<input type="text" name="setting_key" class="form-control" id="validationCustom01" placeholder="Enter Post Theme Key" value="<?php echo $rows_setting['setting_key']; ?>" required>
							<div class="valid-tooltip">
								Looks good!
							</div>
							<div class="invalid-tooltip">
								Please Enter Post Theme Key!
							</div>
						</div>
						<div class="col-md-6 position-relative">
							<label for="validationCustom02" class="form-label">Post Theme Value</label>
							<input type="text" name="setting_value" class="form-control" id="validationCustom02" placeholder="Enter Post Theme Value" value="<?php echo $rows_setting['setting_value']; ?>" required>
							<div class="valid-tooltip">
								Looks good!
							</div>
							<div class="invalid-tooltip">
								Please Enter Post Theme Value!
							</div>
						</div>
				</div>
				<div class="modal-footer">
			      	<input type="hidden" name="setting_id" value="<?php echo $rows_setting['setting_id']; ?>">
			      	<input type="hidden" name="page" value="<?php if (isset($page)) { echo $page; } ?>">
			        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
			        <input type="submit" name="update_setting" value="Update Theme" class="btn" style="background-color: #2D2727; color: white;">
					</form>
				</div>
	    	</div>
	    </div>
	</div>

<!-- Modal Update Theme End -->
<?php
	}
}
?>

<?php
include ("../../require/footer.php");

} else {
	header("location:../../index.php");
}
?>