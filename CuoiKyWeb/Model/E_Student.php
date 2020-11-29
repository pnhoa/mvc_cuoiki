<?php
  class Entity_Student{
    //table fields
    public $id;
    public $username;
    public $password;
    public $lastname;
    public $role;

      public function __construct(){
        $this->id = 0;
        $this->username = "";
        $this->password = "";
        $this->lastname = "";
        $this ->role = "";

      }
  }
?>
