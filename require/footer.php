<!-- Feedback -->

<div class="container-fluid">
	<div class="row text-center p-5 mt-5 text-white" style="background-color: #2D2727;">
		<div class="col">
			<h5>Necessity is the Mother of Invention</h5>
			<button type="button" class="btn mt-4" data-bs-toggle="modal" data-bs-target="#staticBackdrop" style="background-color: white; color: #2D2727;">
				<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope-at mx-2" viewBox="0 0 16 16"><path d="M2 2a2 2 0 0 0-2 2v8.01A2 2 0 0 0 2 14h5.5a.5.5 0 0 0 0-1H2a1 1 0 0 1-.966-.741l5.64-3.471L8 9.583l7-4.2V8.5a.5.5 0 0 0 1 0V4a2 2 0 0 0-2-2H2Zm3.708 6.208L1 11.105V5.383l4.708 2.825ZM1 4.217V4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v.217l-7 4.2-7-4.2Z"/><path d="M14.247 14.269c1.01 0 1.587-.857 1.587-2.025v-.21C15.834 10.43 14.64 9 12.52 9h-.035C10.42 9 9 10.36 9 12.432v.214C9 14.82 10.438 16 12.358 16h.044c.594 0 1.018-.074 1.237-.175v-.73c-.245.11-.673.18-1.18.18h-.044c-1.334 0-2.571-.788-2.571-2.655v-.157c0-1.657 1.058-2.724 2.64-2.724h.04c1.535 0 2.484 1.05 2.484 2.326v.118c0 .975-.324 1.39-.639 1.39-.232 0-.41-.148-.41-.42v-2.19h-.906v.569h-.03c-.084-.298-.368-.63-.954-.63-.778 0-1.259.555-1.259 1.4v.528c0 .892.49 1.434 1.26 1.434.471 0 .896-.227 1.014-.643h.043c.118.42.617.648 1.12.648Zm-2.453-1.588v-.227c0-.546.227-.791.573-.791.297 0 .572.192.572.708v.367c0 .573-.253.744-.564.744-.354 0-.581-.215-.581-.8Z"/></svg>
				Feedback
			</button>
		</div>
	</div>
	<div class="row">
		<div class="col text-center text-white py-2 bg-secondary">
			<span class="fw-lighter">@ <?php echo date("Y"); ?></span><span class="fw-bold"> | Hidaya Institute Of Science And Technology </span>
		</div>
	</div>
</div>

<!-- Feedback End -->



<!-- Modal Feedback -->

	<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h1 class="modal-title fs-5" id="staticBackdropLabel">Feedback</h1>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<form class="row g-3 needs-validation" <?php if (isset($page) && $page == "index.php") {
						echo "action='admin/feedback/feedback-process.php'";
					} else if (isset($_SESSION['role_id']) && $_SESSION['role_id'] == 2) {
						echo "action='../../admin/feedback/feedback-process.php'";
					} else { echo "action='../feedback/feedback-process.php'"; } ?> method="POST" novalidate>
					<div class="mb-3 position-relative">
						<label for="validationCustom01" class="form-label">Name</label>
						<input type="text" name="sender_name" class="form-control" id="validationCustom01" placeholder="Enter Name" required>
						<div class="valid-tooltip">
							Looks good!
						</div>
					</div>
					<div class="mb-3 position-relative">
						<label for="validationCustom02" class="form-label">Email</label>
						<input type="text" name="sender_email" class="form-control" id="validationCustom02" placeholder="Enter Email" required>
						<div class="valid-feedback">
							Looks good!
						</div>
						<div class="invalid-tooltip">
							Please Enter Email.
						</div>
					</div>
					<div class="mb-3 position-relative">
						<label for="validationTextarea" class="form-label">Message</label>
						<textarea class="form-control" name="feedback" id="validationTextarea" placeholder="Enter Message" required></textarea>
						<div class="invalid-tooltip">
							Please Enter Message.
						</div>
					</div>

				</div>
				<div class="modal-footer">
					<input type="hidden" name="page" value="<?php if (isset($page) && $page == "index.php") { echo "../../index.php"; }
					else if (isset($page)) { echo $page; } ?>">
					<input type="hidden" name="post_id" value="<?php if (isset($post_id)) { echo $post_id; } ?>">
					<input type="hidden" name="blog_id" value="<?php if (isset($blog_id)) { echo $blog_id; } ?>">
					<input type="hidden" name="category_id" value="<?php if (isset($category_id)) { echo $category_id; } ?>">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
					<input type="submit" name="send_feedback" value="Send" class="btn" style="background-color: #2D2727; color: white;">
				</form>
			</div>
		</div>
	</div>
</div>

<!-- Modal Feedback End -->



<script>
(() => {
	'use strict'

	const forms = document.querySelectorAll('.needs-validation')

	Array.from(forms).forEach(form => {
		form.addEventListener('submit', event => {
			if (!form.checkValidity()) {
				event.preventDefault()
				event.stopPropagation()
			}

			form.classList.add('was-validated')
		}, false)
	})
})()
</script>



</body>
</html>