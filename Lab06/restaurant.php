<?php require_once("pdoconnection.php"); ?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        hr {
            margin: 10px 0;
            clear: both;
        }
        form {
            margin-right: 0;
            float: left;
            width: calc(20vw);
        }
        table {
            width: calc(60vw - 20px);
            float: left;
            margin-bottom: 10px;
        }
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
        }
    </style>
</head>
<body>
    
<table>
        <thead>
            <tr>
                <th>id</th>
                <th>name</th>
                <th>city</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach (getCustomer($conn) as $row): ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= $row['name'] ?></td>
                    <td><?= $row['city'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <form action="add_customer.php" method="post">
        <fieldset>
            <div>
                <label for="">Name</label>
                <input type="text" name="name" required>
            </div><br>
            <div>
                <label for="">City</label>
                <input type="text" name="city" required>
            </div><br>
            <div>
                <button type="submit">Add Customer</button>
            </div>
        </fieldset>
    </form>
    <hr>
    <table>
        <thead>
            <tr>
                <th>id</th>
                <th>name</th>
                <th>city</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach (getMenu($conn) as $row): ?>
                <tr>
                    <td><?= $row['menu_id'] ?></td>
                    <td><?= $row['menu_name'] ?></td>
                    <td><?= $row['price'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>