<?php
if (isset($connection)) {
	$query_category = "SELECT * FROM category";
	$result_category = mysqli_query($connection, $query_category);

	if (isset($_SESSION['user_id'])) {
		$query_blog = "SELECT * FROM blog WHERE user_id = '".$_SESSION['user_id']."'";
		$result_blog = mysqli_query($connection, $query_blog);
	}
}

?>

<!-- Modal Register -->

	<div class="modal fade" id="staticBackdropRegister" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h1 class="modal-title fs-5" id="staticBackdropLabel">Register<p class="text-<?php if (isset($_REQUEST['color'])) { echo $_REQUEST['color']; } else { echo "danger"; }?> md-3"><?php if (isset($_REQUEST['register_msg'])) { echo $_REQUEST['register_msg']; } ?></p></h1>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<form class="row g-3 needs-validation" <?php if (isset($page) && $page != "index.php") { echo "action='../../register-process.php'"; } else { echo "action='register-process.php'"; } ?> method="POST" enctype="multipart/form-data" accept="image/*" novalidate>
						<div class="col-md-6 position-relative">
							<label for="validationCustom01" class="form-label">First Name</label>
							<input type="text" name="first_name" class="form-control" id="validationCustom01" placeholder="Enter First Name" required>
							<div class="valid-tooltip">
								Looks good!
							</div>
							<div class="invalid-tooltip">
								Please Enter First Name!
							</div>
						</div>
						<div class="col-md-6 position-relative">
							<label for="validationCustom02" class="form-label">Last Name</label>
							<input type="text" name="last_name" class="form-control" id="validationCustom02" placeholder="Enter Last Name" required>
							<div class="valid-tooltip">
								Looks good!
							</div>
							<div class="invalid-tooltip">
								Please Enter Last Name!
							</div>
						</div>
						<div class="col-md-6 position-relative">
							<label for="validationCustom03" class="form-label">Email</label>
							<input type="email" name="email" class="form-control" id="validationCustom03" placeholder="Enter Email" required>
							<div class="valid-tooltip">
								Looks good!
							</div>
							<div class="invalid-tooltip">
								Please Enter Email!
							</div>
						</div>
						<div class="col-md-6 position-relative">
							<label for="validationCustom04" class="form-label">Password</label>
							<input type="password" name="password" class="form-control" id="validationCustom04" placeholder="Enter Password" required>
							<div class="valid-tooltip">
								Looks good!
							</div>
							<div class="invalid-tooltip">
								Please Enter Password!
							</div>
						</div>
						<div class="col-md-6 position-relative">
							<label for="gender" class="form-label">Gender</label>
							<div class="form-check">
								<input class="form-check-input" value="Male" type="radio" name="gender" id="flexRadioDefault1" checked>
								<label class="form-check-label" for="flexRadioDefault1">
									Male
								</label>
							</div>
							<div class="form-check position-relative">
								<input class="form-check-input" value="Female" type="radio" name="gender" id="flexRadioDefault2">
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
							<input type="date" name="date_of_birth" class="form-control" id="validationCustom06" required>
							<div class="valid-tooltip">
								Looks good!
							</div>
							<div class="invalid-tooltip">
								Please Select Date of Birth!
							</div>
						</div>
						<div class="col-md-8 position-relative">
							<label for="validationCustom07" class="form-label">Upload Image</label>
							<input type="file" name="upload_image" class="form-control" id="validationCustom07" required>
							<div class="valid-tooltip">
								Looks good!
							</div>
							<div class="invalid-tooltip">
								Please Upload Image!
							</div>
						</div>
						<div class="col-md-8 position-relative">
							<label for="validationTextarea" class="form-label">Address</label>
							<textarea class="form-control" name="address" id="validationTextarea" placeholder="Enter Address" required></textarea>
							<div class="valid-tooltip">
								Looks good!
							</div>
							<div class="invalid-tooltip">
								Please Provide a Valid Address!
							</div>
						</div>
					</div>
					<div class="modal-footer">
				      	<input type="hidden" name="post_id" value="<?php if (isset($post_id)) { echo $post_id; } ?>">
	      				<input type="hidden" name="category_id" value="<?php if (isset($category_id)) { echo $category_id; } ?>">
				      	<input type="hidden" name="blog_id" value="<?php if (isset($blog_id)) { echo $blog_id; } ?>">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
						<input type="submit" name="register" value="Register" class="btn" style="background-color: #2D2727; color: white;">
					</form>
				</div>
			</div>
		</div>
	</div>

<!-- Modal Register End -->



<!-- Modal Login -->

	<div class="modal fade" id="staticBackdropLogin" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h1 class="modal-title fs-5" id="staticBackdropLabel">Login<p class="text-danger md-3"><?php if (isset($_REQUEST['login_msg'])) { echo $_REQUEST['login_msg']; } ?></p></h1>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<form class="row g-3 needs-validation" <?php if (isset($page) && ($page == "post/post-page.php" || $page == "category/category-page.php" || $page == "blog/blog-page.php")) {
						echo "action='../../login-process.php'"; } else { echo "action='login-process.php'"; } ?> method="POST" novalidate>
						<div class="md-3 position-relative">
							<label for="validationCustom01" class="form-label">Email</label>
							<input type="email" name="email" class="form-control" id="validationCustom01" placeholder="Enter Email" required>
							<div class="valid-tooltip">
								Looks good!
							</div>
							<div class="invalid-tooltip">
								Please Enter Email!
							</div>
						</div>
						<div class="md-3 position-relative">
							<label for="validationCustom02" class="form-label">Password</label>
							<input type="password" name="password" class="form-control" id="validationCustom02" placeholder="Enter Password" required>
							<div class="valid-tooltip">
								Looks good!
							</div>
							<div class="invalid-tooltip">
								Please Enter Password!
							</div>
						</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
					<input type="submit" name="submit" value="Login" class="btn" style="background-color: #2D2727; color: white;">
				</form>
					<button class="btn btn-light" data-bs-toggle="modal" data-bs-target="#staticBackdropForgotPassword">Forgot Password</button>
				</div>
			</div>
		</div>
	</div>

<!-- Modal Login End -->



<!-- Modal Forgot Password -->

	<div class="modal fade" id="staticBackdropForgotPassword" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h1 class="modal-title fs-5" id="staticBackdropLabel">Forgot Password</h1>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<form class="row g-3 needs-validation" <?php if (isset($page) && ($page == "post/post-page.php" || $page == "category/category-page.php" || $page == "blog/blog-page.php")) {
						echo "action='../../forgot-password-process.php'"; } else { echo "action='forgot-password-process.php'"; } ?> method="POST" novalidate>
						<div class="md-3 position-relative">
							<label for="validationCustom03" class="form-label">Email</label>
							<input type="email" name="email" class="form-control" id="validationCustom03" placeholder="Enter Email" required>
							<div class="valid-tooltip">
								Looks good!
							</div>
							<div class="invalid-tooltip">
								Please Enter Email!
							</div>
						</div>
						<div class="modal-footer">
							<input type="hidden" name="post_id" value="<?php if (isset($post_id)) { echo $post_id; } ?>">
					      	<input type="hidden" name="category_id" value="<?php if (isset($category_id)) { echo $category_id; } ?>">
					      	<input type="hidden" name="blog_id" value="<?php if (isset($blog_id)) { echo $blog_id; } ?>">
					        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
					        <input type="submit" name="send" value="Send" class="btn" style="background-color: #2D2727; color: white;">
					    </form>
					</div>
				</div>
			</div>
		</div>
	</div>

<!-- Modal Forgot Password End -->



<!-- Modal Create Blog -->

	<div class="modal fade" id="staticBackdropCreateBlog" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h1 class="modal-title fs-5" id="staticBackdropLabel">Create Blog</h1>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<form class="row g-3 needs-validation" action="../blog/create-blog-process.php" method="POST" enctype="multipart/form-data" novalidate>
						<div class="col-md-6 position-relative">
							<label for="validationCustom01" class="form-label">Blog Title</label>
							<input type="text" name="blog_title" class="form-control" id="validationCustom01" placeholder="Enter Blog Title" required>
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
								<option selected value="">Choose...</option>
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
						    <input type="file" name="upload_image" class="form-control" id="validationCustom07" required>
						    <div class="valid-tooltip">
						    	Looks good!
						    </div>
						    <div class="invalid-tooltip">
						    	Please Upload Image!
						    </div>
						</div>
					</div>
					<div class="modal-footer">
				      	<input type="hidden" name="page" value="<?php if (isset($page)) { echo $page; } ?>">
				      	<input type="hidden" name="post_id" value="<?php if (isset($post_id)) { echo $post_id; } ?>">
				      	<input type="hidden" name="category_id" value="<?php if (isset($category_id)) { echo $category_id; } ?>">
				      	<input type="hidden" name="blog_id" value="<?php if (isset($blog_id)) { echo $blog_id; } ?>">
				        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
				        <input type="submit" name="create_blog" value="Create Blog" class="btn" style="background-color: #2D2727; color: white;">
				    </form>
				</div>
			</div>
		</div>
	</div>

<!-- Modal Create Blog End -->



<!-- Modal Create Category -->

	<div class="modal fade" id="staticBackdropCreateCategory" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h1 class="modal-title fs-5" id="staticBackdropLabel">Create Category</h1>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<form class="row g-3 needs-validation" action="../category/create-category-process.php" method="POST" novalidate>
						<div class="col-md-6 position-relative">
							<label for="validationCustom01" class="form-label">Category Title</label>
							<input type="text" name="category_title" class="form-control" id="validationCustom01" placeholder="Enter Category Title" required>
							<div class="valid-tooltip">
								Looks good!
							</div>
							<div class="invalid-tooltip">
						    	Please Enter Category Title!
						    </div>
						</div>
						<div class="col-md-6 position-relative">
							<label for="validationCustom02" class="form-label">Category Description</label>
						    <input type="text" name="category_description" class="form-control" id="validationCustom02" placeholder="Enter Category Description" required>
						    <div class="valid-tooltip">
						    	Looks good!
						    </div>
						    <div class="invalid-tooltip">
						    	Please Enter Category Description!
						    </div>
						</div>
					</div>
					<div class="modal-footer">
				      	<input type="hidden" name="page" value="<?php if (isset($page)) { echo $page; } ?>">
				      	<input type="hidden" name="post_id" value="<?php if (isset($post_id)) { echo $post_id; } ?>">
				      	<input type="hidden" name="category_id" value="<?php if (isset($category_id)) { echo $category_id; } ?>">
				      	<input type="hidden" name="blog_id" value="<?php if (isset($blog_id)) { echo $blog_id; } ?>">
				        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
				        <input type="submit" name="create_category" value="Create Category" class="btn" style="background-color: #2D2727; color: white;">
				    </form>
				</div>
			</div>
		</div>
	</div>

<!-- Modal Create Category End -->



<!-- Modal Add Post -->

	<div class="modal fade" id="staticBackdropAddPost" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h1 class="modal-title fs-5" id="staticBackdropLabel">Add Post</h1>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<form class="row g-3 needs-validation" action="../post/add-post-process.php" method="POST" enctype="multipart/form-data" novalidate>
						<div class="col-md-6 position-relative">
							<label for="validationCustom01" class="form-label">Post Title</label>
							<input type="text" name="post_title" class="form-control" id="validationCustom01" placeholder="Enter Post Title" required>
						    <div class="valid-tooltip">
						    	Looks good!
						    </div>
						    <div class="invalid-tooltip">
						    	Please Enter Post Title!
						    </div>
						</div>
						<div class="col-md-6 position-relative">
						    <label for="validationCustom02" class="form-label">Post Summary</label>
						    <input type="text" name="post_summary" class="form-control" id="validationCustom02" placeholder="Enter Post Summary" required>
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
						    	<option selected value="">Choose...</option>
						    	<?php if ($result_category->num_rows > 0) {
						    		while ($row = mysqli_fetch_assoc($result_category)) { ?>
						    			<option value="<?php echo $row['category_id']; ?>"><?php echo $row['category_title']; ?></option>
						    			<?php
						    		}
						    	} ?>
						    </select>
						    <div class="invalid-feedback">
						    	Please select an option.
						    </div>
						</div>
						<div class="col-md-4">
						    <label for="validationCustom03" class="form-label">Blog</label>
						    <select class="form-select" name="blog" id="validationCustom03" required>
						    	<option selected value="">Choose...</option>
						    	<?php if ($result_blog->num_rows > 0) {
						    		while ($row = mysqli_fetch_assoc($result_blog)) { ?>
						    			<option value="<?php echo $row['blog_id']; ?>"><?php echo $row['blog_title']; ?></option>
						    			<?php
						    		}
						    	} ?>
						    </select>
						    <div class="invalid-feedback">
						    	Please select an option.
						    </div>
						</div>
						<div class="col-md-6 position-relative">
						    <label for="comment_allowed" class="form-label">Comment Allowed</label>
						    <div class="form-check">
						    	<input class="form-check-input" type="radio" name="comment_allowed" value="1" id="flexRadioDefault1" checked>
						    	<label class="form-check-label" for="flexRadioDefault1">
						    		Yes
						    	</label>
						    </div>
							<div class="form-check position-relative">
								<input class="form-check-input" type="radio" name="comment_allowed" value="0" id="flexRadioDefault2">
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
						    <input type="file" name="upload_image" class="form-control" id="validationCustom07" required>
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
						    <textarea class="form-control" name="post_description" id="validationTextarea" placeholder="Enter Post Description" required></textarea>
						    <div class="valid-tooltip">
						    	Looks good!
						    </div>
						    <div class="invalid-tooltip">
						    	Please Provide a Post Description!
						    </div>
						</div>
					</div>
					<div class="modal-footer">
				      	<input type="hidden" name="page" value="<?php if (isset($page)) { echo $page; } ?>">
				      	<input type="hidden" name="post_id" value="<?php if (isset($post_id)) { echo $post_id; } ?>">
				      	<input type="hidden" name="category_id" value="<?php if (isset($category_id)) { echo $category_id; } ?>">
				      	<input type="hidden" name="blog_id" value="<?php if (isset($blog_id)) { echo $blog_id; } ?>">
				        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
				        <input type="submit" name="add_post" value="Add Post" class="btn" style="background-color: #2D2727; color: white;">
				    </form>
				</div>
		    </div>
		</div>
	</div>

<!-- Modal Add Post End -->



<!-- Modal Add User -->

	<div class="modal fade" id="staticBackdropAddUser" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h1 class="modal-title fs-5" id="staticBackdropLabel">Add User</h1>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<form class="row g-3 needs-validation" action="../user/add-user-process.php" method="POST" enctype="multipart/form-data" novalidate>
						<div class="col-md-6 position-relative">
						    <label for="validationCustom01" class="form-label">First Name</label>
						    <input type="text" name="first_name" class="form-control" id="validationCustom01" placeholder="Enter First Name" required>
						    <div class="valid-tooltip">
						    	Looks good!
						    </div>
						    <div class="invalid-tooltip">
						    	Please Enter First Name!
						    </div>
						</div>
						<div class="col-md-6 position-relative">
						    <label for="validationCustom02" class="form-label">Last Name</label>
						    <input type="text" name="last_name" class="form-control" id="validationCustom02" placeholder="Enter Last Name" required>
						    <div class="valid-tooltip">
						    	Looks good!
						    </div>
						    <div class="invalid-tooltip">
						    	Please Enter Last Name!
						    </div>
						</div>
						<div class="col-md-6 position-relative">
						    <label for="validationCustom03" class="form-label">Email</label>
						    <input type="email" name="email" class="form-control" id="validationCustom03" placeholder="Enter Email" required>
						    <div class="valid-tooltip">
						    	Looks good!
						    </div>
						    <div class="invalid-tooltip">
						    	Please Enter Email!
						    </div>
						</div>
						<div class="col-md-6 position-relative">
						    <label for="validationCustom04" class="form-label">Password</label>
						    <input type="password" name="password" class="form-control" id="validationCustom04" placeholder="Enter Password" required>
						    <div class="valid-tooltip">
						    	Looks good!
						    </div>
						    <div class="invalid-tooltip">
						    	Please Enter Password!
						    </div>
						</div>
						<div class="col-md-6 position-relative">
						    <label for="gender" class="form-label">Gender</label>
						    <div class="form-check">
								<input class="form-check-input" value="Male" type="radio" name="gender" id="flexRadioDefault1" checked>
								<label class="form-check-label" for="flexRadioDefault1">
								    Male
								</label>
							</div>
							<div class="form-check position-relative">
								<input class="form-check-input" value="Female" type="radio" name="gender" id="flexRadioDefault2">
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
						    <input type="date" name="date_of_birth" class="form-control" id="validationCustom06" required>
						    <div class="valid-tooltip">
						    	Looks good!
						    </div>
						    <div class="invalid-tooltip">
						    	Please Select Date of Birth!
						    </div>
						</div>
						<div class="col-md-8 position-relative">
						    <label for="validationCustom07" class="form-label">Upload Image</label>
						    <input type="file" name="upload_image" class="form-control" id="validationCustom07" required>
						    <div class="valid-tooltip">
						    	Looks good!
						    </div>
						    <div class="invalid-tooltip">
						    	Please Upload Image!
						    </div>
						</div>
						<div class="col-md-8 position-relative">
						    <label for="validationTextarea" class="form-label">Address</label>
						    <textarea class="form-control" name="address" id="validationTextarea" placeholder="Enter Address" required></textarea>
						    <div class="valid-tooltip">
						    	Looks good!
						    </div>
						    <div class="invalid-tooltip">
						    	Please Provide a Valid Address!
						    </div>
						</div>
					</div>
					<div class="modal-footer">
				      	<input type="hidden" name="page" value="<?php if (isset($page)) { echo $page; } ?>">
				      	<input type="hidden" name="post_id" value="<?php if (isset($post_id)) { echo $post_id; } ?>">
				      	<input type="hidden" name="category_id" value="<?php if (isset($category_id)) { echo $category_id; } ?>">
				      	<input type="hidden" name="blog_id" value="<?php if (isset($blog_id)) { echo $blog_id; } ?>">
				        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
				        <input type="submit" name="register" value="Add User" class="btn" style="background-color: #2D2727; color: white;">
				    </form>
				</div>
			</div>
		</div>
	</div>

<!-- Modal Add User End -->



<!-- Modal Update Account -->

	<div class="modal fade" id="staticBackdropUpdateAccount" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h1 class="modal-title fs-5" id="staticBackdropLabel">Update Account</h1>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<form class="row g-3 needs-validation" <?php if (isset($_SESSION) && $_SESSION['role_id'] == 1) {
						echo "action='../admin-page/update-process.php'"; 
					} else if (isset($_SESSION) && $_SESSION['role_id'] == 2) { echo "action='../user-page/update-process.php'"; 
					} else if (isset($page) && ($page == "post/post-page.php" || $page == "category/category-page.php" || $page == "blog/blog-page.php")) { echo "action='../admin-page/update-process.php'";
					} else { echo "action='../user-page/update-process.php'"; } ?> method="POST" enctype="multipart/form-data" accept="image/*" novalidate>
					<div class="col-md-6 position-relative">
						<label for="validationCustom01" class="form-label">First Name</label>
						<input type="text" name="first_name" class="form-control" id="validationCustom01" placeholder="Enter First Name" 
						<?php if (isset($_SESSION['first_name'])) {
							echo "value='".$_SESSION['first_name']."'";
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
						<?php if (isset($_SESSION['last_name'])) {
							echo "value='".$_SESSION['last_name']."'";
						} ?> required>
						<div class="valid-tooltip">
							Looks good!
						</div>
						<div class="invalid-tooltip">
							Please Enter Last Name!
						</div>
					</div>

					<?php if (isset($_REQUEST['message'])) {
						echo "<div class='text-danger'>".$_REQUEST['message']."</div>";
					}?>

					<div class="col-md-6 position-relative">
						<label for="validationCustom04" class="form-label">Password</label>
					    <input type="password" name="password" class="form-control" id="validationCustom04" placeholder="Enter Password" 
					    <?php if (isset($_SESSION['password'])) {
					    	echo "value='".$_SESSION['password']."'";
					    } ?> required>
					    <div class="valid-tooltip">
					    	Looks good!
					    </div>
					    <div class="invalid-tooltip">
					    	Please Enter Password!
					    </div>
					</div>
					<div class="col-md-6 position-relative">
						<label for="gender" class="form-label">Gender</label>
						<div class="form-check">
							<input class="form-check-input" value="Male" name="gender" type="radio" name="gender" id="flexRadioDefault1" <?php if (isset($_SESSION['gender']) && $_SESSION['gender'] == "Male") {echo "checked"; } ?>>
							<label class="form-check-label" for="flexRadioDefault1">
								Male
							</label>
						</div>
						<div class="form-check position-relative">
							<input class="form-check-input" value="Female" type="radio" name="gender" id="flexRadioDefault2" <?php if (isset($_SESSION['gender']) && $_SESSION['gender'] == "Female") {echo "checked"; } ?>>
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
					    <?php if (isset($_SESSION['date_of_birth'])) {
					    	echo "value='".$_SESSION['date_of_birth']."'";
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
						<textarea class="form-control" name="address" id="validationTextarea" required><?php if (isset($_SESSION['address'])) {
							echo $_SESSION['address'];
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
			      	<input type="hidden" name="page" value="<?php if (isset($page)) { echo $page; } ?>">
			      	<input type="hidden" name="post_id" value="<?php if (isset($post_id)) { echo $post_id; } ?>">
			      	<input type="hidden" name="category_id" value="<?php if (isset($category_id)) { echo $category_id; } ?>">
			      	<input type="hidden" name="blog_id" value="<?php if (isset($blog_id)) { echo $blog_id; } ?>">
			        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
			        <input type="submit" name="register" value="Update" class="btn" style="background-color: #2D2727; color: white;">
			    	</form>
				</div>
			</div>
		</div>
	</div>

<!-- Modal Update Account End -->



<!-- Modal Add Comment -->

	<div class="modal fade" id="staticBackdropAddComment" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h1 class="modal-title fs-5" id="staticBackdropLabel">Add Comment</h1>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<form class="row g-3 needs-validation" action="../post/post-comment.php" method="POST" novalidate>
						<div class="col-md-6 position-relative">
							<label for="validationCustom01" class="form-label">Post Comment</label>
							<input type="text" name="comment" class="form-control" id="validationCustom01" placeholder="Enter Post Comment" required>
							<div class="valid-tooltip">
								Looks good!
							</div>
							<div class="invalid-tooltip">
								Please Enter Post Comment!
							</div>
						</div>
				</div>
				<div class="modal-footer">
					<input type="hidden" name="post_id" value="<?php if (isset($_REQUEST['post_id'])) { echo $_REQUEST['post_id']; } ?>">
			      	<input type="hidden" name="user_id" value="<?php if (isset($_REQUEST['user_id'])) { echo $_REQUEST['user_id']; } ?>">
			      	<input type="hidden" name="page" value="post/post-page.php">
			        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
			        <input type="submit" name="add_comment" value="Send" class="btn" style="background-color: #2D2727; color: white;">
				    </form>
				</div>
			</div>
		</div>
	</div>

<!-- Modal Add Comment End -->



<!-- Modal Add Theme -->

	<div class="modal fade" id="staticBackdropAddTheme" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h1 class="modal-title fs-5" id="staticBackdropLabel">Add Theme</h1>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<form class="row g-3 needs-validation" action="../setting/add-theme-settings-process.php" method="POST" novalidate>
						<div class="col-md-6 position-relative">
							<label for="validationCustom01" class="form-label">Post Theme Key</label>
							<input type="text" name="setting_key" class="form-control" id="validationCustom01" placeholder="Enter Post Theme Key" required>
							<div class="valid-tooltip">
								Looks good!
							</div>
							<div class="invalid-tooltip">
								Please Enter Post Theme Key!
							</div>
						</div>
						<div class="col-md-6 position-relative">
							<label for="validationCustom02" class="form-label">Post Theme Value</label>
							<input type="text" name="setting_value" class="form-control" id="validationCustom02" placeholder="Enter Post Theme Value" required>
							<div class="valid-tooltip">
								Looks good!
							</div>
							<div class="invalid-tooltip">
								Please Enter Post Theme Value!
							</div>
						</div>
				</div>
				<div class="modal-footer">
			      	<input type="hidden" name="page" value="<?php if (isset($page)) { echo $page; } ?>">
			      	<input type="hidden" name="post_id" value="<?php if (isset($post_id)) { echo $post_id; } ?>">
			      	<input type="hidden" name="category_id" value="<?php if (isset($category_id)) { echo $category_id; } ?>">
			      	<input type="hidden" name="blog_id" value="<?php if (isset($blog_id)) { echo $blog_id; } ?>">
			        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
			        <input type="submit" name="add_setting" value="Add Theme" class="btn" style="background-color: #2D2727; color: white;">
			    </form>
			    </div>
			</div>
		</div>
	</div>

<!-- Modal Add Theme End -->

