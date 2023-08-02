<?php
require("../../require/connection.php");

$query = "SELECT * FROM user_feedback ORDER BY feedback_id DESC";
$result = mysqli_query($connection, $query);

if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'show_feedback') { ?>
	<div class="px-2 py-5">
		<table class="table table-dark table-striped display" id="example">
			<thead>
				<tr>
					<th class="text-center" scope="col">S. No 		</th>
					<th class="text-center" scope="col">User Name 	</th>
					<th class="text-center" scope="col">Email 		</th>
					<th class="text-center" scope="col">Feedback 	</th>
					<th class="text-center" scope="col">Created At 	</th>
				</tr>
			</thead>
			<tbody>

				<?php 
				if ($result->num_rows > 0) {
					$serial = 0;
					while ($row = mysqli_fetch_assoc($result)) {
						echo "<tr>";
			  			echo "<td>".++$serial."</td>";
			  			echo "<td>".$row['user_name']."</td>";
			  			echo "<td>".$row['user_email']."</td>";
			  			echo "<td>".$row['feedback']."</td>";
			  			echo "<td>".date("F dS", strtotime($row['created_at']))."</td>";
			  			echo "</tr>";
			  		}
			  	} ?>
			</tbody>
		</table>
	</div>
<?php
} ?>