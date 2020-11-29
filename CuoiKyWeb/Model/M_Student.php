<?php
  class Model_Student {
    public function __construct($connectSetUp) {
      $this ->host = $connectSetUp ->host;
      $this ->username = $connectSetUp ->username;
      $this ->password = $connectSetUp ->password;
      $this ->database = $connectSetUp ->database;
    }
    public function open_database(){
      $this ->connectDatabase = new mysqli($this ->host,$this ->username,$this ->password,$this ->database);
      if($this->connectDatabase->connect_error){
        die("Error connect database". $this ->connectDatabase->connect_error);
      }
    }
    public function close_database(){
      $this ->connectDatabase ->close();
    }
    public function insertSV($object){
      try{
        $this ->open_database();
        $query = $this ->connectDatabase ->prepare("INSERT INTO sinhvien(username,password,lastname,role) VALUES (?,?,?,?) ");
        $query ->bind_param("ssss",$object->username,$object->password,$object->lastname);
        $query ->execute();
        $res = $query->get_result();
        $last_id = $this ->connectDatabase->insert_id;
        $query ->close();
        $this ->close_database();
        return $last_id;
      }
      catch(Exception $e){
        $this ->close_database();
        throw $e;
      }
    }
    public function updateSV($object){
      try{
        $this->open_database();
        $query = $this->connectDatabase->prepare("UPDATE sinhvien SET username =?, password=?,lastname=?,role=? WHERE id =?");
        $query->bind_param("ssssi",$object->username,$object->password,$object->lastname,$object->role,$object ->id);
        $query->execute();
        $res = $query->get_result();
        $query->close();
        $this->close_database();
        return true;
      }
      catch(Expection $e){
        $this ->close_database();
        throw $e;
      }
    }
    public function deleteSV($id){
      try{
        $this->open_database();
        $query = $this->connectDatabase->prepare("DELETE FROM sinhvien WHERE id=?");
        $query->bind_param("i",$id);
        $query->execute();
        $res = $query->get_result();
        $query->close();
        $this->close_database();
        return true;
      }
      catch(Expection $e){
        $this ->close_database();
        throw $e;
      }
    }
    public function selectSV($id){
      try{
        $this->open_database();
        if($id>0){
          $query = $this ->connectDatabase->prepare("SELECT * FROM sinhvien WHERE id=?");
          $query->bind_param("i",$id);
        }
        else{
          $query = $this ->connectDatabase->prepare("SELECT * FROM sinhvien");
          }
          $query->execute();
          $res = $query->get_result();
          $query->close();
          $this->close_database();
          return $res;
      }
      catch(Expection $e){
        $this ->close_database();
        throw $e;
      }
    }
    public function checkAcc($username,$password){
    try{
      $check = false;
       $this->open_database();
        $query = $this ->connectDatabase->prepare("SELECT * FROM sinhvien WHERE username=? AND password=?");
        $query->bind_param("ss",$username,$password);
        $query->execute();
        $res = $query->get_result();
        $row=mysqli_fetch_array($res);
        if($row>0){
          $check = true;
        }
        $query->close();
        $this->close_database();
        return $check;
    }
    catch(Expection $e){
      $this ->close_database();
      throw $e;
    }
  }
  public function searchStudent($name ){
    try{
        $this->open_database();
        $query = $this ->connectDatabase->prepare("SELECT * FROM sinhvien WHERE lastname LIKE '$SearchString'");
        $query->bind_param("s",$lastname);
        $query->execute();
        $res = $query->get_result();
        $row=mysqli_fetch_array($res);
        if($row>0){
          $id=$row["id"];
          $username=$row["username"];
          $password=$row["password"];
          $role=$row["role"];
          return new Entity_Student($id,$username,$password,$role);
        }
        else return null;
        $query->close();
        $this->close_database();
        return $check;
    }
    catch(Expection $e){
      $this ->close_database();
      throw $e;
    }

  }
  }

 ?>
