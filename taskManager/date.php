<?php
include_once "config.php";
$connection = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);

if(!$connection){
    throw new Exeption("Connection Failed");

}else{
    echo "Connected";
    // insert record
    // "INSERT INTO tasks (task, date) VALUES('Do Something More', '2023-1-26')"
    // echo mysqli_query($connection,"INSERT INTO tasks (task, date) VALUES('Do Something More','2023-1-26')");
    // select From task
    // $result = mysqli_query($connection, "SELECT * FROM tasks");
    /* while($data = mysqli_fetch_array($result)){ 
        echo "<pre>";
        print_r($data);
        echo "</pre>";
    } */

    // mysqli_fetch_assoc() mysqli_fetch_array() mysqli_fetch_object()

   /*  $result = mysqli_query($connection, "SELECT * FROM tasks");
    while($data = mysqli_fetch_assoc($result)){
        echo "<pre>";
        print_r($data);
        echo "</pre>";
    } */

    // delete Querya
    // mysqli_query($connection, "DELETE FROM tasks");
    // mysqli_close($connection);
}

?>