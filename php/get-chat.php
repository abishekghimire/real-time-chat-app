<?php
session_start();
if (isset($_SESSION['unique_id'])) {
    include_once "config.php";
    $outgoing_id = pg_escape_string($dbconn, $_POST['outgoing_id']);
    $incoming_id = pg_escape_string($dbconn, $_POST['incoming_id']);
    $result = "";

    $query = "SELECT * FROM messages 
              LEFT JOIN users ON users.unique_id = messages.outgoing_msg_id
              WHERE (outgoing_msg_id = {$outgoing_id} AND incoming_msg_id ={$incoming_id}) 
              OR (outgoing_msg_id = {$incoming_id} AND incoming_msg_id ={$outgoing_id}) ORDER BY msg_id ";
    $sql = pg_query($dbconn, $query);
    if (pg_num_rows($sql) > 0) {
        while ($row = pg_fetch_assoc($sql)) {
            if ($row['outgoing_msg_id'] === $outgoing_id) { //if this is true then the user is a message sender
                $result .= '<div class="chat outgoing">
                            <div class="details">
                            <p>' . $row['message'] . '</p>
                            </div>
                            </div>';
            } else { //else the user is msg receiver
                $result .= ' <div class="chat incoming">
                            <img src="php/images/' . $row['image'] . '" alt="">
                            <div class="details">
                              <p>' . $row['message'] . '</p>
                            </div>
                            </div>';
            }
        }
        echo $result;
    }
} else {
    header("../signin.php");
}
