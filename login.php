<?php
session_start();

include_once 'koneksi.php';
  if (isset($_POST['submit'])) {
    $email=$_POST['email'];
    $password=$_POST['password'];
    if($email=='user@admin.com'){
      $result= mysqli_query ($koneksi, "SELECT * from 05_users where email = '$email' AND password='$password'");
      if( mysqli_num_rows($result) === 1 ) {
        $_SESSION["admin"] = true;
        header('Location: adminpage.php');
        exit;
      }
    }else{
      $result= mysqli_query ($koneksi, "SELECT * from 05_users where email = '$email' AND password='$password'");
      if( mysqli_num_rows($result) === 1 ) {
        $_SESSION["login"] = true;
        $_SESSION["email"]=$email;
        while(
          $d = mysqli_fetch_array($result)
        ){

          $_SESSION["nama_user"]=$d['fullname'];
        }
        header('Location: index.php');
        exit;
	  }else {
      echo "<script>alert('Invalid email or password, Try again')</script>";
    }
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <title>Register</title>
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

    <!-- Custom styles for this template -->
    <link href="signin.css" rel="stylesheet" />
  </head>
  <body class="text-center">
    <form action="" class="form-signin" method="post">
      <img
        class="mb-4"
        src="img/logo.png"
        alt=""
        width="200"
        height="200"
      />
      <h1 class="h3 mb-3 font-weight-normal">Login</h1>
      <input type="email" class="form-control" placeholder="Email address" name="email" required autofocus/>
      <input type="password" class="form-control" placeholder="Password" name="password" required autofocus/>
      <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit"> 
        Sign in
      </button>
      <div class="enroll">Not Registered? <a href="enroll.php">Click Here to Register</a></div>
      <p class="mt-5 mb-3 text-muted">&copy; 2021</p>
    </form>
  </body>
</html>
