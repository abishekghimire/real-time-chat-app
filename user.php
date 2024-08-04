<?php
session_start();
if (!isset($_SESSION['unique_id'])) {
   header("location: signin.php"); //as session is set when user signin/signup, so if session is not set then user will be redirected to signin page
}
?>

<?php include_once "header.php"; ?>

<body>
   <div class="wrapper">
      <section class="users">
         <header>
            <?php
            require_once "php/config.php";
            $query = "SELECT * FROM users WHERE unique_id = {$_SESSION['unique_id']}";
            $sql = pg_query($dbconn, $query);
            if (pg_num_rows($sql) > 0) {
               $row = pg_fetch_assoc($sql);
            }
            ?>
            <div class="content">
               <img src="php/images/<?php echo $row['image'] ?>" alt="">
               <div class="details">
                  <span><?php echo $row['fname'] . " " . $row['lname'];  ?></span>
                  <p><?php echo $row['status']; ?></p>
               </div>
            </div>
            <a href="php/signout.php?signout_id=<?php echo $row['unique_id']; ?>" class="logout">Sign out</a>
         </header>
         <div class="search">
            <span class="text">Tap on user to start chat</span>
            <input type="text" placeholder="Search...">
            <button><i class="fas fa-search"></i></button>
         </div>
         <div class="users-list">

         </div>
      </section>
   </div>

   <script src="js/user.js"></script>

</body>

</html>