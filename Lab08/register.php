<?php
require_once(dirname(__FILE__) ."/pdoconnection.php");
if (
    !empty($_POST["username"])
    && !empty($_POST["password"])
    && !empty($_POST["first_name"])
    && !empty($_POST["last_name"])
) {
    insertUser(
        $conn,
        $_POST['username'],
        $_POST['password'],
        $_POST['first_name'],
        $_POST['last_name']
    );
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>

<body>
    <form action="" method="post">
        <fieldset>
            <div>
                <label for="username">Username</label>
                <input type="text" name="username">
            </div>
            <div>
                <label for="password">Password</label>
                <input type="text" name="password">
            </div>
            <div>
                <label for="first_name">First Name</label>
                <input type="text" name="first_name">
            </div>
            <div>
                <label for="last_name">Last Name</label>
                <input type="text" name="last_name">
            </div>
            <div>
                <input type="submit" name="register" value="Register">
            </div>
        </fieldset>
    </form>
</body>

</html>