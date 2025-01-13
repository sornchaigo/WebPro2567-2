<?php
require_once("pdoconnection.php");
if (!empty($_GET['id'])) {
    $id = $_GET['id'];
}
if (!empty($_POST['action'])) {

    if ($_POST['action'] == 'Update') {
        $name = $_POST['subject'];
        $day = $_POST['day'];
        $start_hour = $_POST['start_hour'];
        $hour = $_POST['hour'];
        updateSubject($conn, $id, $name, $day, $start_hour, $hour);

    } else if ($_POST['action'] == 'Delete') {
        deleteSubject($conn, $id);
    }
}
$subject = getSubject($conn, $id);
?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $subject['name'] ?></title>
    <style>
        
        button {
            width: 100%;
        }

        form div label {
            width: 100px;
            display: inline-block;
            margin-bottom: 10px;
        }

        input {
            width: 400px;
        }
    </style>
</head>

<body>
    <form action="" method="POST">
        <fieldset>
            <input type="number" value="<?= $subject['id']; ?>" hidden>
            <div>
                <label for="">Subject</label>
                <input type="text" name="subject" value="<?= $subject['name'] ?>">
            </div>
            <div>
                <label for="">Day</label>
                <input type="text" name="day" value="<?= $subject['day'] ?>">
            </div>
            <div>
                <label for="">Start Hour</label>
                <input type="number" name="start_hour" value="<?= $subject['start_hour'] ?>">
            </div>
            <div>
                <label for="">Hour</label>
                <input type="number" name="hour" value="<?= $subject['hour'] ?>">
            </div>
            <div>
                <input type="submit" name="action" value="Update">
                <input type="submit" name="action" value="Delete">
            </div>
        </fieldset>
    </form>
</body>

</html>