<?php
echo $_POST['month'];
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