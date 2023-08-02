<?php
require("../../require/forms.php");
?>

<!-- Sidebar -->

<div class="offcanvas offcanvas-start text-white opacity-75" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel" style="background-color: #2D2727;">
	<div class="offcanvas-header" data-bs-theme="dark">
		<h5 class="offcanvas-title" id="offcanvasExampleLabel">Menu</h5>
		<button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
	</div>

	<div class="offcanvas-body">
		<li class="list-group-item text-white fw-bolder" style="background-color: #2D2727;">
			<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-kanban mx-2" viewBox="0 0 16 16"><path d="M13.5 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1h-11a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h11zm-11-1a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h11a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2h-11z"/><path d="M6.5 3a1 1 0 0 1 1-1h1a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1a1 1 0 0 1-1-1V3zm-4 0a1 1 0 0 1 1-1h1a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1h-1a1 1 0 0 1-1-1V3zm8 0a1 1 0 0 1 1-1h1a1 1 0 0 1 1 1v10a1 1 0 0 1-1 1h-1a1 1 0 0 1-1-1V3z"/></svg>
			Manage
		</li>
		<ul class="list-group list-group-flush">
			<li class="list-group-item text-white" style="background-color: #2D2727;"></li>
			<div class="accordion accordion-flush" id="accordionFlushExample">
				<div class="accordion-item">
					<h2 class="accordion-header">
	    				<button class="accordion-button collapsed text-white" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne" style="background-color: #2D2727;">
	    					<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-people mx-2" viewBox="0 0 16 16"><path d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1h8Zm-7.978-1A.261.261 0 0 1 7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002a.274.274 0 0 1-.014.002H7.022ZM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0ZM6.936 9.28a5.88 5.88 0 0 0-1.23-.247A7.35 7.35 0 0 0 5 9c-4 0-5 3-5 4 0 .667.333 1 1 1h4.216A2.238 2.238 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816ZM4.92 10A5.493 5.493 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275ZM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0Zm3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4Z"/></svg>
	    					Users 
	    				</button>
	    			</h2>
	    			<div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
	    				<div class="accordion-body" style="background-color: #2D2727;">
	    					<button class="btn btn-dark border-white"><a class="nav-link active fw-light" aria-current="page" href="../user/manage-users.php">Manage Users</a></button>
	    					<button class="btn btn-dark mx-2 border-white" type="button" data-bs-toggle="modal" data-bs-target="#staticBackdropAddUser">Add User</button>
	    				</div>
	    			</div>
	    		</div>

	    		<div class="accordion-item">
	    			<h2 class="accordion-header">
	    				<button class="accordion-button collapsed text-white" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo" style="background-color: #2D2727;">
	    					<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-post mx-2" viewBox="0 0 16 16"><path d="M4 3.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 .5.5v8a.5.5 0 0 1-.5.5h-7a.5.5 0 0 1-.5-.5v-8z"/><path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2zm10-1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1z"/></svg>
	    					Posts
	    				</button>
	    			</h2>
	    			<div id="flush-collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
	    				<div class="accordion-body" style="background-color: #2D2727;">
	    					<button class="btn btn-dark border-white"><a class="nav-link active fw-light" aria-current="page" href="../post/manage-posts.php">Manage Posts</a></button>
	    					<button class="btn btn-dark mx-2 border-white" type="button" data-bs-toggle="modal" data-bs-target="#staticBackdropAddPost">Add Post</button>
	    				</div>
	    			</div>
	    		</div>

	    		<div class="accordion-item">
	    			<h2 class="accordion-header">
	    				<button class="accordion-button collapsed text-white" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree" style="background-color: #2D2727;">
	    					<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chat-square-text mx-2" viewBox="0 0 16 16"><path d="M14 1a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1h-2.5a2 2 0 0 0-1.6.8L8 14.333 6.1 11.8a2 2 0 0 0-1.6-.8H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h2.5a1 1 0 0 1 .8.4l1.9 2.533a1 1 0 0 0 1.6 0l1.9-2.533a1 1 0 0 1 .8-.4H14a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/><path d="M3 3.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM3 6a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 6zm0 2.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5z"/></svg>
	    					Comments
	    				</button>
	    			</h2>
	    			<div id="flush-collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
	    				<div class="accordion-body" style="background-color: #2D2727;"><button class="btn btn-dark border-white"><a class="nav-link active fw-light" aria-current="page" href="../comment/manage-comments.php">Manage Comments</a></button></div>
	    			</div>
	    		</div>

	    		<div class="accordion-item">
	    			<h2 class="accordion-header">
	    				<button class="accordion-button collapsed text-white" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseFour" style="background-color: #2D2727;">
	    					<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope-fill mx-2" viewBox="0 0 16 16"><path d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414.05 3.555ZM0 4.697v7.104l5.803-3.558L0 4.697ZM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586l-1.239-.757Zm3.436-.586L16 11.801V4.697l-5.803 3.546Z"/></svg>
	    					Feedback
	    				</button>
	    			</h2>
	    			<div id="flush-collapseFour" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
	    				<div class="accordion-body" style="background-color: #2D2727;"><button class="btn btn-dark border-white"><a class="nav-link active fw-light" aria-current="page" href="../feedback/manage-feedback.php">Manage Feedback</a></button></div>
	    			</div>
	    		</div>

	    		<div class="accordion-item">
	    			<h2 class="accordion-header">
	    				<button class="accordion-button collapsed text-white" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFive" aria-expanded="false" aria-controls="flush-collapseFive" style="background-color: #2D2727;">
	    					<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-tag mx-2" viewBox="0 0 16 16"><path d="M6 4.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm-1 0a.5.5 0 1 0-1 0 .5.5 0 0 0 1 0z"/><path d="M2 1h4.586a1 1 0 0 1 .707.293l7 7a1 1 0 0 1 0 1.414l-4.586 4.586a1 1 0 0 1-1.414 0l-7-7A1 1 0 0 1 1 6.586V2a1 1 0 0 1 1-1zm0 5.586 7 7L13.586 9l-7-7H2v4.586z"/>
	    					</svg> Category
	    				</button>
	    			</h2>
	    			<div id="flush-collapseFive" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
	    				<div class="accordion-body" style="background-color: #2D2727;">
	    					<button class="btn btn-dark border-white"><a class="nav-link active fw-light" aria-current="page" href="../category/manage-category.php">Manage Category</a></button>
	    					<button class="btn btn-dark mx-2 border-white" type="button" data-bs-toggle="modal" data-bs-target="#staticBackdropCreateCategory">Create Category</button>
	    				</div>
	    			</div>
	    		</div>

	    		<div class="accordion-item">
	    			<h2 class="accordion-header">
	    				<button class="accordion-button collapsed text-white" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseSix" aria-expanded="false" aria-controls="flush-collapseSix" style="background-color: #2D2727;">
	    					<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark mx-2" viewBox="0 0 16 16"><path d="M14 4.5V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h5.5L14 4.5zm-3 0A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V4.5h-2z"/></svg>
	    					Blogs
	    				</button>
	    			</h2>
	    			<div id="flush-collapseSix" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
	    				<div class="accordion-body" style="background-color: #2D2727;">
	    					<button class="btn btn-dark border-white"><a class="nav-link active fw-light" aria-current="page" href="../blog/manage-blogs.php">Manage Blogs</a></button>
	    					<button class="btn btn-dark mx-2 border-white" type="button" data-bs-toggle="modal" data-bs-target="#staticBackdropCreateBlog">Create Blog</button>
	    				</div>
	    			</div>
	    		</div>
	    	</div>
	    </ul>
	    <br>
	    <li class="list-group-item text-white fw-bolder" style="background-color: #2D2727;">
	    	<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-tags mx-2" viewBox="0 0 16 16"><path d="M3 2v4.586l7 7L14.586 9l-7-7H3zM2 2a1 1 0 0 1 1-1h4.586a1 1 0 0 1 .707.293l7 7a1 1 0 0 1 0 1.414l-4.586 4.586a1 1 0 0 1-1.414 0l-7-7A1 1 0 0 1 2 6.586V2z"/><path d="M5.5 5a.5.5 0 1 1 0-1 .5.5 0 0 1 0 1zm0 1a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3zM1 7.086a1 1 0 0 0 .293.707L8.75 15.25l-.043.043a1 1 0 0 1-1.414 0l-7-7A1 1 0 0 1 0 7.586V3a1 1 0 0 1 1-1v5.086z"/></svg>
	    	Categories
	    </li>
	    <ul class="list-group list-group-flush">
			<?php if (isset($category_title)) {
				foreach ($category_title as $key => $value) { ?>
					<li class="list-group-item text-white" style="background-color: #2D2727;"><a class="page-link" href="../../admin/category/category-page.php?category_id=<?php echo $row_category_id[$key]; ?>"><?php echo $value; ?></a></li>
				<?php } 
			} else { echo "<li class='list-group-item text-white' style='background-color: #2D2727;'>No Categories!</li>"; } ?>
		</ul>
		<br>
			<li class="list-group-item text-white fw-bolder" style="background-color: #2D2727;">
				<a class="page-link" href="../../admin/about-us/about-us.php">
				<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-person mx-2" viewBox="0 0 16 16"><path d="M12 1a1 1 0 0 1 1 1v10.755S12 11 8 11s-5 1.755-5 1.755V2a1 1 0 0 1 1-1h8zM4 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H4z"/><path d="M8 10a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/></svg>
				About Us</a>
			</li>
		</ul>
	</div>
</div>

<!-- Sidebar End -->



<div class="text-center" id="show_message"></div>



<?php

if (isset($_REQUEST['update_msg'])) {
  ?>
  <div class="alert alert-info alert-dismissible fade show text-center" role="alert">
  <?php echo "<h6>".$_REQUEST['update_msg']."</h6>"; ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  <?php
}


if (isset($_REQUEST['setting_msg'])) {
  ?>
  <div class="alert alert-info alert-dismissible fade show text-center" role="alert">
  <?php echo "<h6>".$_REQUEST['setting_msg']."</h6>"; ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  <?php
}

?>