<?php
session_start();
if (isset($_SESSION['unique_id'])) { //if user is already logged in
    header("location: user.php");
}
?>
<?php include_once "header.php"; ?>

<body>
    <div class="wrapper">
        <section class="form signup">
            <header>Guff Gaff</header>
            <form action="#" enctype="multipart/form-data">
                <div class="error-text"></div>
                <div class="name-details">
                    <div class="field input">
                        <label for="fname">First Name</label>
                        <input type="text" name="fname" placeholder="First Name" required>
                    </div>
                    <div class="field input">
                        <label for="lname">Last Name</label>
                        <input type="text" name="lname" placeholder="Last Name" required>
                    </div>
                </div>
                <div class="field input">
                    <label for="email">Email</label>
                    <input type="text" name="email" placeholder="Enter your email" required>
                </div>
                <div class="field input">
                    <label for="password">Password</label>
                    <input type="password" name="password" placeholder="Enter your password" required>
                    <i class="fas fa-eye"></i>

                </div>
                <div class="field image">
                    <label>Select Image</label>
                    <input type="file" name="image">
                </div>
                <div class="field button">
                    <input type="submit" value="Sign Up">
                </div>

            </form>
            <div class="link">Already signed up?<a href="signin.php">Sign in now.</a></div>
        </section>

    </div>

    <script src="js/password-show-hide.js"></script>
    <script src="js/signup.js"></script>

</body>

</html>