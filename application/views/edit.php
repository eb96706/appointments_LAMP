<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Edit Appointment</title>
</head>
<body>

	<h2>Edit Appointment</h2>
	<form action='/main/editCurrent/<?= $my_id ?>' method='post'>
		<!-- 'hidden' input to  have one process.php page that handles both login & registration -->
		<input type='hidden' name='id' value= '<?= $my_id ?>'/>
		<p>Date:<input type='text' name='date' /></p>
		<p>Time:<input type='time' name='time' /></p>
		<p>Tasks:<input type='text' name='task' /></p>
		Status: <select name = 'status'>
			<option value="Pending">Pending</option>
			<option value="Done">Done</option>
			<option value="Missed">Missed</option>
		</select><br><br>
		<input type='submit' value='Edit Appointment' />
	</form>
</body>
</html>
