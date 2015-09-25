<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Welcome</title>
</head>
<body>

	<h1>Welcome <?= $name ?> <a href="/">logout</a></h1>

 	<h3>Here are your appointments for today, <?= date("M d, Y") ?>:</h3>


		<table>
			<tr>
				<td>Tasks</td>
				<td>Time</td>
				<td>Status</td>
				<td>Action</td>
			</tr>
			<?php
			if(isset($current_apps)){


				foreach($current_apps as $key)
				{ ?>
					<tr>
						<td><?= $key['task'] ?></td>
						<td><?= $key['time'] ?></td>
						<td><?= $key['status'] ?></td>
						<td>
							<a href="/main/editView/<?= $key['id'] ?>">Edit</a>
						</td>
						<td>
							<a href="/main/deleteCurrent/<?= $key['id'] ?>">Remove</a>
						</td>

					</tr>
					<?php }
			}?>
			</table>


	<h3>Your Other Appointments: </h3>
	<table>
		<tr>
			<td>Tasks</td>
			<td>Date</td>
			<td>Time</td>
		</tr>
		<?php
		if(isset($future_apps)){

		foreach($future_apps as $key)
		{ ?>
			<tr>
				<td><?= $key['task'] ?></td>
				<td><?= $key['date'] ?></td>
				<td><?= $key['time'] ?></td>
			</tr>
		<?php }
	}?>
		</table>


	<h2>Add Appointment</h2>
	<form action='/main/add_appointment' method='post'>
		<!-- 'hidden' input to  have one process.php page that handles both login & registration -->
		<input type='hidden' name='action' value='login' />
		<p>Date:<input type='text' name='date' /></p>
		<p>Time:<input type='time' name='time' /></p>
		<p>Tasks:<input type='text' name='task' /></p>
		<input type='submit' value='Add Appointment' />
	</form>


</body>
</html>
