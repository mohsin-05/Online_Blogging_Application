<?php
session_start();
require("../../require/connection.php");
date_default_timezone_set("Asia/Karachi");

$query_setting = "SELECT * FROM setting WHERE user_id = '".$_SESSION['user_id']."'";
$result_setting = mysqli_query($connection, $query_setting);

$updated_at = date("Y-m-d H:i:s");
if (isset($_POST['update_setting'])) {
	extract($_POST);
	$query = "SELECT * FROM setting WHERE setting_id <> '".$setting_id."' AND user_id = '".$_SESSION['user_id']."'";
	$result = mysqli_query($connection, $query);
	if ($result->num_rows > 0) {
		while ($rows = mysqli_fetch_assoc($result)) {
			if ($_POST['setting_key'] == $rows['setting_key']) {
				header("location:../".$page."?setting_msg=Setting already exits&color=danger");
				die();
			} 
		}
	}
	$query = "UPDATE setting SET setting_key = '".$setting_key."', setting_value = '".$setting_value."', updated_at = '".$updated_at."' WHERE setting_id = '".$setting_id."'";
	$result = mysqli_query($connection, $query);
	if ($result) {
		header("location:../".$page."?setting_msg=Setting Updated Successfully&color=success");
	} else {
		header("location:../".$page."?setting_msg=Setting was not updated&color=danger");
	}
}

if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'show_table') {
?>

<div class="px-2 py-5">
	<table class="table table-dark table-striped display" id="table">
	    <thead>
	    <tr>
	      <th scope="col">S. No 			</th>
	      <th scope="col">Key 				</th>
	      <th scope="col">Value 			</th>
	      <th scope="col">Active/InActive 	</th>
	      <th scope="col">Status 			</th>
	      <th scope="col">Created At 		</th>
	      <th scope="col">Edit 				</th>
	    </tr>
	  </thead>
	  <tbody>

	    <?php
	    if ($result_setting->num_rows > 0) {
	    	$serial = 0;
	    	while ($rows_setting = mysqli_fetch_assoc($result_setting)) {
	    		echo "<tr>";
	    		echo "<td>".++$serial."</td>";
	    		echo "<td>".$rows_setting['setting_key']."</td>";
	    		echo "<td>".$rows_setting['setting_value']."</td>";
	    		echo "<td><button class='btn btn-outline-success' onclick='active(".$rows_setting['setting_id'].")'>Active</button>
		  			<button class='btn btn-outline-danger' onclick='inactive(".$rows_setting['setting_id'].")'>InActive</button></td>";
	    		if ($rows_setting['setting_status'] == 'Active') {
		  			echo "<td><button class='btn btn-success'>".$rows_setting['setting_status']."</button></td>";
	  			} else if ($rows_setting['setting_status'] == 'InActive') {
		  			echo "<td><button class='btn btn-danger'>".$rows_setting['setting_status']."</button></td>";
	  			} else {
	  				echo "<td></td>";
	  			}
	    		echo "<td>".date("F dS", strtotime($rows_setting['created_at']))."</td>";
	    		echo "<td><button class='btn btn-outline-light' type='button' data-bs-toggle='modal' data-bs-target='#staticBackdropUpdateTheme".$rows_setting['setting_id']."'><svg class='me-2' xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil-square' viewBox='0 0 16 16'>
					  <path d='M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z'/>
					  <path fill-rule='evenodd' d='M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z'/>
					</svg>Edit</button></td>";
	    		echo "</tr>";
	    	}
	    }
	    ?>
	  </tbody>
	</table>
</div>
<?php
}

if (isset($_REQUEST['action']) && $_REQUEST['action'] == "active") {
	$setting_id = $_REQUEST['setting_id'];
	$query = "UPDATE setting SET setting_status = 'Active' WHERE setting_id = $setting_id";
	$result = mysqli_query($connection, $query);
	if ($result) {
		echo "<div class='alert alert-primary alert-dismissible fade show text-center' role='alert'>
		<h4 class='text-center'>The Setting is Active</h4>
		<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
	}
}

if (isset($_REQUEST['action']) && $_REQUEST['action'] == "inactive") {
	$setting_id = $_REQUEST['setting_id'];
	$query = "UPDATE setting SET setting_status = 'InActive' WHERE setting_id = $setting_id";
	$result = mysqli_query($connection, $query);
	if ($result) {
		echo "<div class='alert alert-primary alert-dismissible fade show text-center' role='alert'>
		<h4 class='text-center'>The Setting is InActive</h4>
		<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
	}
}

?>