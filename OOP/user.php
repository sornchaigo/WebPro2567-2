<?php
require_once(dirname(__FILE__) . "/database.php");

class User extends DataMapper
{
    public const table = "user";
    public const fields = ['username', 'password', 'first_name', 'last_name'];
}

$new = User::find(User::table, 1);
$user = new User($new);

// User::insert(
//     User::table,
//     [
//         'username' => 'worawit', 
//         'password' => '123456',
//         'first_name'=> 'worawit',
//         'last_name'=> 'pulsawatdi',
//     ]
// );