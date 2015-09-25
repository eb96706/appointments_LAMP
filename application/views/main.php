<!doctype html>
<html lang="en">
<?php
// $this->session->sess_destroy();
// die();
?>

<head>

  <title>Login Registration</title>
  <meta charset="utf-8">
  <meta name="description" content="PHP login registration ">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <style type='text/css'>
    *{
      font-family: sans-serif;
    }
    .errors{
      color: red;
    }
    .success{
      color: green;
    }
  </style>

</head>

<body>

  </div>
    <h1>Welcome !</h1>
  <h2>Register</h2>
  <form action='/main/register' method='post'>
      <!-- 'hidden' input to  have one process.php page that handles both login & registration -->
      <input type='hidden' name='action' value='register' />
      <p>Name:<input type='text' name='name' /></p>
      <p>Email Address:<input type='text' name='email' /></p>
      <p>Password:<input type='password' name='password' /></p>
      <p>Confirm Password:<input type='password' name='confirm_password' /></p>
      <p>Date of Birth:<input type='date' name='birthday'/></p>
      <input type='submit' value='Register' />
  </form>


  <h2>Login</h2>
  <form action='/main/login' method='post'>
    <!-- 'hidden' input to  have one process.php page that handles both login & registration -->
    <input type='hidden' name='action' value='login' />
    <p>Email Address:<input type='text' name='email' /></p>
    <p>Password:<input type='password' name='password' /></p>
    <input type='submit' value='Login' />
  </form>

</body>
</html>
