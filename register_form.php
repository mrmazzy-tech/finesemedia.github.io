<?php

@include 'config.php';

if(isset($_POST['submit'])){
  $name = mysqli_real_escape_string($conn, $_POST['name']);
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $pass = md5($_POST['password']);
  $cpass = md5($_POST['cpassword']);
  $user_type = $_POST['user_type'];


  $select = " SELECT * FROM  user_form WHERE email ='$email' && password = '$pass' ";

  $result = mysqli_query($conn, $select);

  if(mysqli_num_rows($result) > 0){

    $error[] = 'user already existed!';
  } else{
    if($pass != $cpass){
        $error[] = 'Password not matched';
    }else{
        $insert = "INSERT INTO user_form (name, email, password, user_type) VALUES  ('$name', '$email', '$pass', '$user_type') ";
        mysqli_query($conn, $insert);
        header('location:login_form.php');
    }
  } 

};
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page - FINESE MEDIA</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Link css file -->
    <link rel="stylesheet" href="style.css">

</head>
<body>
    <div class="form-container">
        <form action="" method ="post">
            <h3>Register Now</h3>

            <?php
            
                if(isset($error)){
                    foreach($error as $error){
                        echo '<span class="error-msg">'.$error.'</span>';
                    };
                };
            ?>

            <input type="text" name="name" required placeholder="Enter your Name">
            <input type="email" name="email" required placeholder="Enter your Email">
            
             <!-- ... (other HTML code) ... -->
            <div class="password-field">
            <input type="password" name="password" required placeholder="Enter your Password">
            <i class="fa fa-eye eye-icon" id="password-eye" onclick="togglePasswordVisibility('password')"></i>
            </div>
            <div class="password-field">
            <input type="password" name="cpassword" required placeholder="Confirm your Password">
            <i class="fa fa-eye eye-icon" id="cpassword-eye" onclick="togglePasswordVisibility('cpassword')"></i>
            </div>

            <!-- ... (other HTML code) ... -->



            <!-- For Image javaScript will be applied here -->
<script>
function togglePasswordVisibility(fieldName) {
  const passwordField = document.getElementsByName(fieldName)[0];
  const eyeIcon = document.querySelector(`input[name=${fieldName}] + i`);

  if (passwordField.type === "password") {
    passwordField.type = "text";
    eyeIcon.classList.remove("fa-eye");
    eyeIcon.classList.add("fa-eye-slash");
  } else {
    passwordField.type = "password";
    eyeIcon.classList.remove("fa-eye-slash");
    eyeIcon.classList.add("fa-eye");
  }
}
</script>


            <select name="user_type">
                <option value="user">user</option>
                <option value="admin">admin</option>
            </select>

            <input type="submit" name="submit" value="register now" class="form-btn">

            <p>Already have an Account? <a href="login_form.php">Login Now</a>  </p>
        </form>
    </div>
</body>
</html>