<?php
session_start();
if (!isset($_SESSION['unique_id'])) {
   header("location: signin.php"); //as session is set when user signin/signup, so if session is not set then user will be redirected to signin page
}
?>
<?php include_once "header.php"; ?>

<body>
   <div class="wrapper">
      <section class="chat-area">
         <header>
            <?php
            include_once "php/config.php";
            $user_id = pg_escape_string($dbconn, $_GET['user_id']);
            $sql = pg_query($dbconn, "SELECT * FROM users WHERE unique_id = {$user_id}");
            if (pg_num_rows($sql) > 0) {
               $row = pg_fetch_assoc($sql);
            }
            ?>
            <a href="user.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>
            <img src="php/images/<?php echo $row['image'] ?>" alt="">
            <div class="details">
               <span><?php echo $row['fname'] . " " . $row['lname'];  ?></span>
               <p><?php echo $row['status']; ?></p>
            </div>
         </header>
         <div class="chat-box">

         </div>
         <form action="#" class="typing-area">
            <!-- getting msg_sender_id -->
            <input type="text" name="outgoing_id" value="<?php echo $_SESSION['unique_id']; ?>" hidden>
            <!-- getting msg_receiver_id -->
            <input type="text" name="incoming_id" value="<?php echo $user_id ?>" hidden>
            <input type="text" name="message" class="input-field" placeholder="Type a message">
            <button><i class="fab fa-telegram-plane"></i></button>
         </form>
      </section>
   </div>
   <script src="js/chat.js"></script>
</body>

</html>