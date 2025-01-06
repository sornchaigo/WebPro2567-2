<?php require_once("pdoconnection.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant management</title>
    <style>
        table {
            width: calc(80% - 30px);
            border-collapse: collapse;
            border: 1px solid black;
            margin: 10px;
            float:left;
        }
        form {
            width: calc(20%);
            margin: 10px 0;
            float:right;
        }
        .clear {
            clear: both;
        }

        th,
        td {
            border: 1px solid black;
            padding: 10px;
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
    <hr class="clear">
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

    <form action="add_menu.php" method="post">
        <fieldset>
            <div>
                <label for="">Name</label>
                <input type="text" name="menu_name" required>
            </div><br>
            <div>
                <label for="">Price</label>
                <input type="text" name="price" required>
            </div><br>
            <div>
                <button type="submit">Add Menu</button>
            </div>
        </fieldset>
    </form>
    <hr class="clear">
</body>

</html>