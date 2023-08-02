<?php
session_start();
require("require/connection.php");

if (isset($_POST['submit'])) {
	$query = "SELECT * FROM user";
	$result = mysqli_query($connection, $query);
	if ($result->num_rows > 0) {
		while ($row = mysqli_fetch_assoc($result)) {
			if ($row['email'] == $_POST['email'] && $row['password'] == $_POST['password']) {
				if ($row['is_approved'] == 'Approved') {
					if ($row['is_active'] == 'Active') {
						if ($row['role_id'] == 1) {
							$_SESSION = $row;
							header("location:admin/admin-page/admin.php");
						} else if ($row['role_id'] == 2) {
							$_SESSION = $row;
							header("location:user/user-page/user.php");
						} else {
							header("location:index.php");
						}
					} else {
						header("location:index.php?login_msg=This Account is InActive");
					}
				} else {
					header("location:index.php?login_msg=This Account is not Approved");
				}
			} else {
				header("location:index.php?login_msg=Incorrect Email/Password");
			}
		}
	}
}

?>