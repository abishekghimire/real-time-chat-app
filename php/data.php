<?php
while ($row = pg_fetch_assoc($sql)) {
   $query2 = "SELECT * FROM messages 
              WHERE (incoming_msg_id = {$row['unique_id']} OR outgoing_msg_id = {$row['unique_id']})
              AND (outgoing_msg_id = {$outgoing_id} OR incoming_msg_id = {$outgoing_id}) 
              ORDER BY msg_id DESC LIMIT 1";
   $sql2 = pg_query($dbconn, $query2);
   $row2 = pg_fetch_assoc($sql2);
   if (pg_num_rows($sql2) > 0) {
      $result2 = $row2['message'];
   } else {
      $result2 = "Tap to chat";
   }

   // trimming messages if word are more than 28
   (strlen($result2) > 28) ? $msg = substr($result2, 0, 28) . '...' : $msg = $result2;
   // adding you before message if message is sent by login id
   $you = ($row2 && $outgoing_id == $row2['outgoing_msg_id']) ? "You: " : "";

   //checking if user is online or offline
   ($row['status'] == "Offline now") ? $offline = "offline" : $offline = "";

   $result .= '<a href="chat.php?user_id=' . $row['unique_id'] . '">
             <div class="content">
                <img src="php/images/' . $row['image'] . '" alt="">
                <div class="details">
                   <span>' . $row['fname'] . " " . $row['lname'] . '</span>
                   <p>' . $you  . $msg . '</p>
                </div>
             </div>
             <div class="status-dot ' . $offline . '"><i class="fas fa-circle"></i></div>
          </a>';
}
