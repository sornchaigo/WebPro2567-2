<?php
try {
    $username = "root";
    $password = "";
    $host = "localhost";
    $dbname = "classroom";

    $servername = "mysql:host=$host;dbname=$dbname;charset=utf8";
    $conn = new PDO(
        $servername,
        $username,
        $password
    );

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


} catch (Exception $e) {
    echo "Database connection error : " . $e->getMessage();
    exit();
}
function listSubject($conn)
{
    $classRoomData = [
        "Mon" => [],
        "Tue" => [],
        "Wed" => [],
        "Thu" => [],
        "Fri" => [],
    ];
    $stm = $conn->prepare(
        "SELECT * FROM `classroom`;"
    );
    $stm->execute();

    $rows = $stm->fetchAll(PDO::FETCH_ASSOC);
    if (!empty($rows)) {
        foreach ($rows as $row) {
            $classRoomData[$row['day']][$row['start_hour']][] = $row;
        }
    }
    return $classRoomData;
}

function findSubject($conn, $day, $hour)
{
    $stm = $conn->prepare(
        "SELECT * 
        FROM classroom 
        WHERE `day` = :day 
        AND `hour` = :hour "
    );

    $stm->execute([
        'day' => $day,
        'hour' => $hour
    ]);

    $rows = $stm->fetch(PDO::FETCH_ASSOC);
    if ($rows) {
        echo $rows['name'];
    }
}
function addSubject($conn, $day, $start_hour, $hour, $subject)
{
    $stm = $conn->prepare("INSERT INTO classroom 
            (`name`, `day`, `start_hour`, `hour`) 
            VALUES (:name, :day, :start_hour, :hour) ");
    $stm->execute([
        'name' => $subject,
        'day' => $day,
        'start_hour'=> $start_hour,
        'hour' => $hour
    ]);
}


$days = [
    "Mon",
    "Tue",
    "Wed",
    "Thu",
    "Fri",
];

if (
    !empty($_POST['day']) &&
    !empty($_POST['hour']) &&
    !empty($_POST['subject'])
) {

    $day = $_POST['day'];
    $start_hour = $_POST['start_hour'];
    $hour = $_POST['hour'];
    $subject = $_POST['subject'];
    addSubject($conn, $day, $start_hour, $hour, $subject);
}

$classRoomData = listSubject($conn);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Class room</title>

    <style>
        table,
        th,
        td {
            width: 100%;
            border: white 2px solid;
            border-collapse: collapse;
            min-width: 90px;
        }

        #classroom {
            background-color: lightgray;
        }

        #classroom th {
            color: white;
        }

        #classroom thead {
            background-color: #0f0f0f;
        }

        #classroom tbody th {
            background-color: darkgray;
        }

        .holiday {
            background-color: crimson !important;
        }
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
    <table id="classroom">
        <thead>
            <tr>
                <th>Day / Time</th>
                <th>08:00-09:00</th>
                <th>09:00-10:00</th>
                <th>10:00-11:00</th>
                <th>11:00-12:00</th>
                <th>12:00-13:00</th>
                <th>13:00-14:00</th>
                <th>14:00-15:00</th>
                <th>15:00-16:00</th>
                <th>16:00-17:00</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($classRoomData as $day => $subject) { ?>
                <tr>
                    <th> <?php echo $day ?> </th>
                    <?php for ($hour = 8; $hour < 17;) {
                        if ( !empty($subject[$hour]) ) {
                            $colspan = $subject[$hour][0]['hour'];
                        } else {
                            $colspan = 1;
                        }
                        ?>
                        <td colspan="<?= $colspan ?>">
                            <?php
                            //echo !empty($subject[$hour]) ? $subject[$i][0] : "" 
                            ?>
                            <?php
                            if (!empty($subject[$hour])) {
                                foreach ($subject[$hour] as $s) {
                                    echo "<a href='subject_detail.php?id=$s[id]'><button>$s[name]</button></a>";
                                }
                            }

                            ?>
                        </td>
                        <?php
                        $hour += $colspan;
                    } ?>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <form action="" method="POST">
        <fieldset>
            <div>
                <label for="">Subject</label>
                <input type="text" name="subject">
            </div>
            <div>
                <label for="">Day</label>
                <input type="text" name="day">
            </div>
            <div>
                <label for="">Start Hour</label>
                <input type="number" name="start_hour">
            </div>
            <div>
                <label for="">Hour</label>
                <input type="number" name="hour">
            </div>
            <div>
                <button type="submit">ยืนยัน</button>
            </div>
        </fieldset>
    </form>
</body>

</html>