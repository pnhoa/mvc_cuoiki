<?php
require '../Model/E_Student.php';
session_start();
$studenttb=isset($_SESSION['studenttbl0'])?unserialize($_SESSION['studenttbl0']):new Entity_Student();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Update</title>
</head>
<body>
    <div class="form" >
    <h2>Add Student</h2>
                    <form action="../index.php?action=add" method="post" >

                      <label><b>Username  </b></label>
                      <input type="text" name="username"  value="">
                      <br><br>
                      <label><b>Password    </b></label>
                      <input type="text" name="password"  value="">
                      <br><br>
                      <label><b>Lastname </b></label>
                      <input type="text" name="lastname"  value="">
                      <br> <br>
                        <input class ="button" type="submit" name="addBtn" class="btn btn-primary" value="Submit">
                        <a href="../index.php" >Cancel</a>
</div>
</body>
</html>
