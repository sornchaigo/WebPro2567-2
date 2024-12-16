<?php
$list_month = [
	1 => "January",
	2 => "Febuary",
	3 => "March",
	4 => "April",
	5 => "May",
	6 => "June",
	7 => "July",
	8 => "Augus",
	9 => "September",
	10 => "October",
	11 => "November",
	12 => "December",
];
$month = !empty($_POST['month']) ? $_POST['month'] : 0;
if ($month >= 1 && $month <= count($list_month)) {
	echo $list_month[$month];
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