<?php
$month = $_POST['month'];
if ($month == 1) {
	echo "January";
} else if ($month == 2) {
	echo "Febuary";
} else if ($month == 3) {
	echo "March";
} else if ($month == 4) {
	echo "April";
} else if ($month == 5) {
	echo "May";
} else if ($month == 6) {
	echo "June";
} else if ($month == 7) {
	echo "July";
} else if ($month == 8) {
	echo "Augus";
} else if ($month == 9) {
	echo "September";
} else if ($month == 10) {
	echo "October";
} else if ($month == 11) {
	echo "November";
} else if ($month == 12) {
	echo "December";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
<body>

	<form action="" method="POST">
		<div>
			<label for="">Price</label>
			<input type="number" name="month" min="1" max="12">
		</div>
		<div>
			<button type="submit">ยืนยัน</button>
		</div>
	</form>

</body>
</html>