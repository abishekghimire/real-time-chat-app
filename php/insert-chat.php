<?php
session_start();
if (isset($_SESSION['unique_id'])) {
    include_once "config.php";
    $outgoing_id = pg_escape_string($dbconn, $_POST['outgoing_id']);
    $incoming_id = pg_escape_string($dbconn, $_POST['incoming_id']);
    $message = pg_escape_string($dbconn, $_POST['message']);

    if (!empty($message)) {
        $sql = pg_query($dbconn, "INSERT INTO messages (incoming_msg_id, outgoing_msg_id, message) VALUES ({$incoming_id}, {$outgoing_id}, '{$message}')") or die(pg_last_error());
    }
} else {
    header("../signin.php");
}
