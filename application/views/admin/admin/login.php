<?php
include_once("test.php");


?>

<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
    <title>Login</title>
    
    
    
    
        <link rel="stylesheet" href="assets/style.css">

    
    
    
  </head>

  <body>

    <body class="align">

  <div class="site__container">

    <div class="grid__container">

     <form action="createlogin.php?login=manual" method="POST" class="form form--login">

        <div class="form__field">
          <label class="fontawesome-user" for="login__username"><span class="hidden">Email</span></label>
          <input id="login__username" type="text" name="email" class="form__input" placeholder="Email" required>
        </div>

        <div class="form__field">
          <label class="fontawesome-lock" for="login__password"><span class="hidden">Password</span></label>
          <input id="login__password" type="password" name="password" class="form__input" placeholder="Password" required>
        </div>

        <div class="form__field">
          <input type="submit" value="Sign In">
        </div>

      </form>
        <div>
      <p class="text--center">Not a member? <a href="signup.html">Sign up now</a>
       <span class="fontawesome-arrow-right"></span></p>
    </div>

      
      
      
        
        
       
        
     
    </div>

  </div>

    
    
    
    
    
  </body>
</html>




