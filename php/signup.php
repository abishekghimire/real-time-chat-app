<?php
session_start();
include_once "config.php";
$fname = pg_escape_string($dbconn, $_POST['fname']);
$lname = pg_escape_string($dbconn, $_POST['lname']);
$email = pg_escape_string($dbconn, $_POST['email']);
$password = pg_escape_string($dbconn, sha1($_POST['password']));

if (!empty($fname) && !empty($lname) && !empty($email) && !empty($password)) {
   //checking email validity
   if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
      //checking if email already exists
      $query = "SELECT email FROM users WHERE email = '{$email}'";
      $sql = pg_query($dbconn, $query);
      if (pg_num_rows($sql) > 0) {
         echo "$email already exists!";
      } else {
         //checking if user uploaded file
         if (isset($_FILES['image'])) { //if file is uploaded
            $img_name = $_FILES['image']['name']; //getting user uploaded image name
            $tmp_name = $_FILES['image']['tmp_name']; //temporary name is used to save/move file in our folder

            //exploding image and getting extension like jpg png
            $img_explode = explode('.', $img_name);
            $img_ext = end($img_explode); //here we get the extension of user uploaded image file

            $extensions = ['png', 'jpeg', 'jpg']; //these are valid extension and stored in array
            if (in_array($img_ext, $extensions) === true) { //if user uploaded img extension is matched with valid extensions
               $time = time(); // this will return current time so that we can rename user upload file with current time in order to have unique name for each file in our folder
               //moving uploaded file in particular folder
               $new_img_name = $time . $img_name;
               if (move_uploaded_file($tmp_name, "images/" . $new_img_name)) {
                  $status = "Active now"; //after signuing up user staus will be active now
                  $random_id = rand(time(), 10000000); //creating random id for user

                  //Inserting all user data into tabel
                  $query2 = "INSERT INTO users (unique_id, fname, lname, email, password, image, status) VALUES ({$random_id}, '{$fname}', '{$lname}', '{$email}', '{$password}', '{$new_img_name}', '{$status}' ) ";
                  $sql2 = pg_query($dbconn, $query2);
                  if ($sql2) {
                     $query3 = "SELECT * FROM users WHERE email = '{$email}'";
                     $sql3 = pg_query($dbconn, $query3);
                     if (pg_num_rows($sql3) > 0) {
                        $row = pg_fetch_assoc($sql3);
                        $_SESSION['unique_id'] = $row['unique_id']; //using this session we use user unique_id in other php files
                        echo "success";
                     }
                  } else {
                     echo "Something went wrong!";
                  }
               }
            } else {
               echo "Please select png, jpeg, jpg image type!";
            }
         } else {
            echo "Please select the image! ";
         }
      }
   } else {
      echo "$email . is not valid email";
   }
} else {
   echo "All input fields are required";
}
