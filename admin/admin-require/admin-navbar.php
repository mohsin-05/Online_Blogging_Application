<link rel="stylesheet" type="text/css" href="../table-files/jquery.dataTables.min.css">
<script type="text/javascript" src="../table-files/jquery-3.5.1.js"></script>
<script type="text/javascript" src="../table-files/jquery.dataTables.min.js"></script>

<script>
	setInterval(function() { document.getElementById('show_message').innerHTML = "" }, 7000);
</script>

<?php
$query = "SELECT * FROM category WHERE category_status = 'Active'";
$result_category = mysqli_query($connection, $query);
if ($result_category->num_rows > 0) {
	while ($row_category = mysqli_fetch_assoc($result_category)) {
		$category_title[] = $row_category['category_title'];
		$row_category_id[] = $row_category['category_id'];
	}
}
?>



<!-- Navbar -->

	<nav class="navbar navbar-expand-lg" data-bs-theme="dark">
		<div class="container-fluid">
			<button class="btn text-white" style="background-color: #2D2727;" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
				<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/></svg>
				Menu
			</button>
			<img class="rounded-circle px-2 my-1" src="../../images/logo3.jpg" alt="logo" style="height: 60px;">
			<a class="navbar-brand my-2" href="#">Online Blogging Application</a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav me-auto mb-2 mb-lg-0">
					<li class="nav-item">
						<a class="nav-link active fw-light" aria-current="page" href="../admin-page/admin.php">Home</a>
					</li>
				</ul>

				<h4 class="text-white px-2">
					<?php
					if (isset($_SESSION['first_name'])) {
						echo $_SESSION['first_name'];
					}
					?>
				</h4>
				<img class="rounded-4" src="../../images/<?php if (isset($_SESSION['user_image'])) { echo $_SESSION['user_image']; } ?>" alt="..." style="height: 60px;">

				<div id="navbarNavDarkDropdown">
					<ul class="navbar-nav">
						<li class="nav-item dropdown px-5">
							<button class="btn btn-dark dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" style="background-color: #2D2727;" >
								<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-gear" viewBox="0 0 16 16"><path d="M8 4.754a3.246 3.246 0 1 0 0 6.492 3.246 3.246 0 0 0 0-6.492zM5.754 8a2.246 2.246 0 1 1 4.492 0 2.246 2.246 0 0 1-4.492 0z"/><path d="M9.796 1.343c-.527-1.79-3.065-1.79-3.592 0l-.094.319a.873.873 0 0 1-1.255.52l-.292-.16c-1.64-.892-3.433.902-2.54 2.541l.159.292a.873.873 0 0 1-.52 1.255l-.319.094c-1.79.527-1.79 3.065 0 3.592l.319.094a.873.873 0 0 1 .52 1.255l-.16.292c-.892 1.64.901 3.434 2.541 2.54l.292-.159a.873.873 0 0 1 1.255.52l.094.319c.527 1.79 3.065 1.79 3.592 0l.094-.319a.873.873 0 0 1 1.255-.52l.292.16c1.64.893 3.434-.902 2.54-2.541l-.159-.292a.873.873 0 0 1 .52-1.255l.319-.094c1.79-.527 1.79-3.065 0-3.592l-.319-.094a.873.873 0 0 1-.52-1.255l.16-.292c.893-1.64-.902-3.433-2.541-2.54l-.292.159a.873.873 0 0 1-1.255-.52l-.094-.319zm-2.633.283c.246-.835 1.428-.835 1.674 0l.094.319a1.873 1.873 0 0 0 2.693 1.115l.291-.16c.764-.415 1.6.42 1.184 1.185l-.159.292a1.873 1.873 0 0 0 1.116 2.692l.318.094c.835.246.835 1.428 0 1.674l-.319.094a1.873 1.873 0 0 0-1.115 2.693l.16.291c.415.764-.42 1.6-1.185 1.184l-.291-.159a1.873 1.873 0 0 0-2.693 1.116l-.094.318c-.246.835-1.428.835-1.674 0l-.094-.319a1.873 1.873 0 0 0-2.692-1.115l-.292.16c-.764.415-1.6-.42-1.184-1.185l.159-.291A1.873 1.873 0 0 0 1.945 8.93l-.319-.094c-.835-.246-.835-1.428 0-1.674l.319-.094A1.873 1.873 0 0 0 3.06 4.377l-.16-.292c-.415-.764.42-1.6 1.185-1.184l.292.159a1.873 1.873 0 0 0 2.692-1.115l.094-.319z"/></svg>
								Settings
							</button>
							<ul class="dropdown-menu dropdown-menu-dark">
								<li><a class="dropdown-item" href="#"><button class="btn" type="button" data-bs-toggle="modal" data-bs-target="#staticBackdropUpdateAccount">Update Account</button></a></li>
								<li><a class="dropdown-item" href="#"><button class="btn" type="button" data-bs-toggle="modal" data-bs-target="#staticBackdropAddTheme">Add Blog Setting</button></a></li>
								<li><a class="dropdown-item" href="../setting/manage-settings.php"><button class="btn" type="button" data-bs-toggle="modal" data-bs-target="#staticBackdropUpdateTheme">Update Blog Settings</button></a></li>
								<li><hr class="dropdown-divider"></li>
								<li><a class="dropdown-item" href="../../logout.php"><button class="btn btn-outline-light">
									<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-in-left" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M10 3.5a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-2a.5.5 0 0 1 1 0v2A1.5 1.5 0 0 1 9.5 14h-8A1.5 1.5 0 0 1 0 12.5v-9A1.5 1.5 0 0 1 1.5 2h8A1.5 1.5 0 0 1 11 3.5v2a.5.5 0 0 1-1 0v-2z"/><path fill-rule="evenodd" d="M4.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H14.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3z"/></svg>Logout
								</button></a></li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</nav>

<!-- Navbar End -->