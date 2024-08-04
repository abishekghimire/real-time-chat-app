<?php
session_start();
include_once "config.php";

$email = pg_escape_string($dbconn, $_POST['email']);
$password = pg_escape_string($dbconn, sha1($_POST['password']));

if (!empty($email) && !empty($password)) {
    //login verification with database data
    $query = "SELECT * FROM users WHERE email = '{$email}' AND password = '{$password}'";
    $sql = pg_query($dbconn, $query);
    if (pg_num_rows($sql) > 0) { //if users credentials matches
        $row = pg_fetch_assoc($sql);
        $status = "Active now";
        $sql2 = pg_query($dbconn, "UPDATE users SET status = '{$status}' WHERE unique_id = {$row['unique_id']}");
        if ($sql2) {
            $_SESSION['unique_id'] = $row['unique_id']; //using this session we use user unique_id in other php files
            echo "success";
        }
    } else {
        echo "Invalid email or password";
    }
} else {
    echo "All input fields are required!";
}
