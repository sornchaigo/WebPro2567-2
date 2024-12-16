<?php
const list_month = [
    'มกราคม',
    'กุมภาพันธ์',
    'มีนาคม',
    'เมษายน',
    'พฤษภาคม',
    'มิถุนายน',
    'กรกฏาคม',
    'สิงหาคม',
    'กันยายน',
    'ตุลาคม',
    'พฤศจิกายน',
    'ธันวาคม',
];

$digit_month = [];
foreach (list_month as $m => $v) {
    $digit_month[$v] = $m;
}

function year_convert($year)
{
    if ($year > 2500) {
        $year = $year - 543;
    }
    return $year;
}

function month_convert($month)
{
    $digit_month = [];
    foreach (list_month as $m => $v) {
        $digit_month[$v] = $m+1;
    }
    if (!in_array($month, list_month))
        return false;

    return $digit_month[$month];
}

function last_day_of_month($year, $month, )
{
    if (in_array($month, [1, 3, 5, 7, 8, 10, 12])) {
        $day = 31;
    } elseif (in_array($month, [4, 6, 9, 11])) {
        $day = 31;
    } elseif (($year % 400) == 0) {
        $day = 29;
    } elseif (($year % 100) == 0) {
        $day = 28;
    } elseif (($year % 4) == 0) {
        $day = 29;
    } else {
        $day = 28;
    }
    return $day;
}

$year = !empty($_POST['year']) ? $_POST['year'] : '';
$month = !empty($_POST['month']) ? $_POST['month'] : '';
$cal_day = false;
if ($year && $month) {
    $cal_year = year_convert($year);
    $cal_month = month_convert($month);
    $day = last_day_of_month($cal_year, $cal_month);
    $cal_day = $day - 3;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>คำนวณหาวันจ่ายเงินเดือน</title>
    <style>
        input {
            width: 100%
        }
    </style>

</head>

<body>
    <form action="" method="post">
        <div>
            <label for="">เดือน</label>
            <input list="month" name="month">
            <datalist id="month">
                <?php foreach (list_month as $m): ?>
                    <option value="<?= $m ?>"><?= $m ?></option>
                <?php endforeach ?>
            </datalist>
        </div>
        <div>
            <label for="">ปี (พ.ศ.)</label>
            <input type="number" name="year">
        </div>
        <button type="submit">Calulate</button>
    </form>

    <?php
    if ($cal_day)
        echo "$cal_day $month $year";
    ?>
</body>

</html>