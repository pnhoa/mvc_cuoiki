<?php
 session_start();
//require_once 'DAO/permission.php';
require 'Model/M_Student.php';
require 'Model/E_Student.php';
require_once 'Model/dao.php';
session_status() === PHP_SESSION_ACTIVE ? TRUE : session_start();
class svController{
  function __construct(){
    $this->objectConfig = new config();
    $this->objectModel = new Model_Student($this->objectConfig);
  }
  public function mvcHandler(){
    $action =isset($_GET['action']) ? $_GET['action'] : NULL;
    switch($action){
      case 'add' :
        $this->insert();
        break;
      case 'update':
        $this->update();
        break;
      case 'delete':
        $this->delete();
        break;
      case 'login':
        $this ->login();
        break;
        case 'search':
          $this ->search();
          break;
        case 'admin':
          $this ->list();
          break;
      default:
          $this->login();
    }
  }
  public function pageRedirect($url){
    header('Location:'.$url);
  }
  public function home(){
    $this ->pageRedirect("View/home.php");
  }
  public function insert(){

    try{
      $studenttb = new Entity_Student();
      if(isset($_POST['addBtn'])){
        $studenttb ->username = trim($_POST['username']);
        $studenttb ->password = trim($_POST['password']);
        $studenttb ->lastname= trim($_POST['lastname']);
        $studenttb ->role= "user";
        $check = $this ->checkValidation($studenttb);

          $id = $this ->objectModel ->insertSV($studenttb);
          if($id>0){
            $this ->list();
          } else {
            echo "Something is wrong ...., try again.";
            $_SESSION['studenttbl0'] = serialize($studenttb);
          }

      }
    }
    catch(Expection $e){
      $this ->close_database();
      throw $e;
    }
  }
  public function update(){
    try{
      if(isset($_POST['updateBtn'])){
        $studenttb = unserialize($_SESSION['studenttbl0']);
        $studenttb ->id =trim($_POST['id']);
        $studenttb ->username = trim($_POST['username']);
        $studenttb ->password = trim($_POST['password']);
        $studenttb ->lastname= trim($_POST['lastname']);
        $studenttb ->role= trim($_POST['role']);


          $res = $this ->objectModel ->updateSV($studenttb);
          if($res>0){
            $this ->list();
          } else {
            echo "Something is wrong ...., try again.";
            $_SESSION['studenttbl0'] = serialize($studenttb);
            $this ->pageRedirect("View/updateStudent.php");
          }

    } elseif (isset($_GET["id"]) && !empty(trim($_GET["id"]))){
      $id = $_GET['id'];
      $result = $this ->objectModel ->selectSV($id);
      $row=mysqli_fetch_array($result);
      $studenttb = new Entity_Student();
      $studenttb ->id = $row["id"];
      $studenttb ->username = $row["username"];
      $studenttb ->password = $row["password"];
      $studenttb ->lastname= $row["lastname"];
      $studenttb ->role= $row["role"];
      $_SESSION['studenttbl0'] = serialize($studenttb);
      $this ->pageRedirect("View/updateStudent.php");
    }
    else{
      echo "Invalid operation.";
    }
    }
    catch(Expection $e){
      $this ->close_database();
      throw $e;
    }
  }
  public function delete(){
    try{
      if(isset($_GET['id'])){
          $id=$_GET['id'];
        $res = $this ->objectModel ->deleteSV($id);
        if($res){
          $this ->pageRedirect('index.php');
        }
        else{
          echo "Something is wrong ..., try again.";
        }
      }
      else {
        echo "Invalid operation.";
      }
    }
    catch(Expection $e){
      $this ->close_database();
      throw $e;
    }
  }
  public function list(){

    $result = $this ->objectModel ->selectSV(0);
    include "View/listStudent.php";
  }

  public function login(){

    try{
        $error ="";
    //  $accounttb = new Entity_Account();
      if(isset($_POST['loginBtn'])){
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
        $check = $this->objectModel ->checkAcc($username,$password);
        if($check == true){
          $result = $this->objectModel->selectSV($username);
           $row=mysqli_fetch_array($result);
           $accounttb = new Entity_Student();
           $accounttb->id = $row["id"];
           $accounttb->username = $row["username"];
           $accounttb->password = $row["password"];
           $accounttb->lastname = $row["lastname"];
           $accounttb->role = $row["role"];
           $_SESSION["username"] = $row["username"];

           $_SESSION['password'] =$row["password"];
           $_SESSION["role"] = $row["role"];
          if(strcmp($row["role"],'admin') == 0){
              $this ->pageRedirect("View/search.php");
          } else {
            $this ->pageRedirect("View/cannotAccessPage.php");
          }
        } else {
           $error = "Invaild username and password";
           $this ->pageRedirect("View/login.php");
        }
      }
    }
    catch(Expection $e){
      $this ->close_database();
      throw $e;
    }
  }
  public function search(){

    if (isset($_POST['search'])){
      $student = $this->objectModel->searchStudent($_POST["lastname"]);
      if ($student != null)
        include_once('../View/StudentDetail.php');
      else
        echo "Not Found";
    }
    else {
      include_once('../View/search.php');
    }
  }


}

 ?>
