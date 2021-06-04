<?php
include_once 'koneksi.php';
  if (isset($_POST['submit'])) {
    $fullname=$_POST['fullname'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    $password1=$_POST['password1'];
    if($_POST['password']==$_POST['password']){
      $result= mysqli_query ($koneksi, "SELECT count(*) as total from 05_users where email = '$email'");
      $data= mysqli_fetch_assoc($result);
      if($data['total']>0){
          echo "<script>alert('Your Email Has Already Been Used')</script>";
      }else{
          $sql = "INSERT into 05_users VALUES('$fullname', '$email', '$password', current_timestamp())";
          $result = $koneksi->query($sql);
          if ($result)
          {
            echo 'User Added';
            header('Location: login.php');
          exit;
          }
          else
          {
            echo 'sql error';
          }
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
    <meta name="description" content="" />
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
      <h1 class="h3 mb-3 font-weight-normal">Register</h1>
      <label for="inputEmail" class="sr-only">Email address</label>
      <input type="text" class="form-control" placeholder="Fullname" name="fullname" required autofocus/>
      <input type="email" class="form-control" placeholder="Email address" name="email" required autofocus/>
      <input type="password" class="form-control" placeholder="Password" name="password" required autofocus/>
      <input type="password" class="form-control" placeholder="Retype Password" name="password1" required autofocus/>
      <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit"> 
        Register
      </button>
      <div class="enroll">Already Have Account? <a href="login.php">Sign In</a></div>
      <p class="mt-5 mb-3 text-muted">&copy; 2021</p>
    </form>
  </body>
</html>
