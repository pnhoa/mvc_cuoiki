<?php
	 session_unset();
	 require_once "Controller/C_Student.php";
	 $controller = new svController();
	 $controller->mvcHandler();
 ?>
