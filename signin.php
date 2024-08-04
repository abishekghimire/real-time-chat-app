<?php
session_start();
if (isset($_SESSION['unique_id'])) { //if user is already logged in
    header("location: user.php");
}
?>
<?php include_once "header.php"; ?>

<body>
    <div class="wrapper">
        <section class="form signin">
            <header>Guff Gaff</header>
            <form action="#">
                <div class="error-text"></div>
                <div class="field input">
                    <label for="email">Email</label>
                    <input type="text" name="email" placeholder="Enter your email">
                </div>
                <div class="field input">
                    <label for="password">Password</label>
                    <input type="password" name="password" placeholder="Enter your password">
                    <i class="fas fa-eye"></i>
                </div>
                <div class="field button">
                    <input type="submit" value="Sign In">
                </div>

            </form>
            <div class="link">New to Guff Gaff?<a href="index.php"> Sign up now.</a></div>
        </section>

    </div>

    <script src="js/password-show-hide.js"></script>
    <script src="js/signin.js"></script>


</body>

</html>