<html>
<head>
	<meta charset="UTF-8">
	<title>Thong tin chi tiet sinh vien</title>
</head>
<body>
	<h2>Chi tiet sinh vien</h2>
	  <?php
      	echo "<p>ID: <b>".$student->id."</b></p>";
        echo "<p>Username: <b>".$student->username."</b></p>";
        echo "<p>Password: <b>".$student->password."</b></p>";
      	echo "<p>Lastname: <b>".$student->lastname."</b></p>";
      	echo "<p>Role: <b>".$student->role."</b></p>";
    ?>
    <br>
   	<button style="float: left;"><a href="javascript:history.back()">BACK</a></button>
</body>
</html>
