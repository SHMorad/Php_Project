<?php
include_once "../config/config.php";
// include_once "../helpers/Formate.php";
class Database{
    public $host = HOST;
    public $user = USER;
    public $password = PASSWORD;
    public $database = DATABASE;

    public $link;
    public $error;

    public function __construct(){
        $this->dbConnect();
    }

    public function dbConnect(){
        $this->link = mysqli_connect($this->host, $this->user, $this->password, $this->database);
        if(!$this->link){
            $this->error = "Database Connection Failed...!";
        }
        return false;
    }

    // select query

    public function select($query){
        $result = mysqli_query($this->link, $query) or die($this->link->error.__LINE__);
        if(mysqli_num_rows($result)>0 ){
            return $result;
        }else{
            return false;
        }
    }

    // insert query
    public function insert($query){
        $result =mysqli_query($this->link, $query) or die($this->link->error.__LINE__);
        if($result){
            return $result;
        }else{
            return false;
        }
    }

    // update Query

    public function update(){
        $result= mysqli_query($this->link, $query) or die($this->link->error.__LINE__);
        if($result){
            return $result;
        }else{
            return false;
        }
    }

    // delete Query

    public function delete(){
        $result= mysqli_query($this->link, $query) or die($this->link->error.__LINE__);
        if($result){
            return $result;
        }else{
            return false;
        }
    }
}
?>