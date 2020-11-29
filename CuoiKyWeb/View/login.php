<?php require '../Model/E_Student.php';
session_start();
    ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset ="utf-8">
 <title>Login</title>
</head>

<body >
    <div class="form" >
         <form  action="../index.php?action=login" method="POST">
           <h2>LOGIN</h2>
           <label for="Username"><b>Username </b></label>
           <input id="username" type="text" placeholder="Enter Username" name="username" ><br><br>
           <label for="Password"><b>Password  </b></label>
           <input id="password" type="password" placeholder="Enter Password" name="password"><br><br>
            <span style="color:red"> <?php
             echo $error;?></span>
         <input class="button" type="submit" name="loginBtn" value="Login">
         <input class="button" type="reset" name="" value="Reset">
        </form>
        <a href="../View/login.php" >Try Again</a>
        <a href="../View/insertStudent.php">Resgister </a>

  </div>
</body>
</html>
