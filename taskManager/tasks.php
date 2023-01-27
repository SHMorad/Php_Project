<?php
include_once "config.php";
// $action =isset($POST['action'])?$POST['action']:'';
$connection = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);

if(!$connection){
    throw new Exeption("Connection Failed");

}else{
$action =$_POST['action']??'';
if(!$action){
    header("Location:index.php");
    // die();
}else{
    if('add'==$action){
        // insert record
        $task = $_POST['task'];
        $date = $_POST['date'];
        if($task && $date){
            $query = "INSERT INTO ". DB_TABLE . "(task,date) VALUES ('{$task}','{$date}')";
            mysqli_query($connection, $query);
            header("Location:index.php?added=true");
        }
    }else if('complete'==$action){
        $taskId = $_POST['taskId'];
        // echo $taskId;
        if($taskId){
            $query= "UPDATE tasks SET complete=1 WHERE id={$taskId} LIMIT 1";
            mysqli_query($connection, $query);
        }
        header("Location:index.php");

    }else if('delete'==$action){
        $taskId = $_POST['taskId'];
        // echo $taskId;
        if($taskId){
            $query= "DELETE FROM tasks WHERE id={$taskId} LIMIT 1";
            mysqli_query($connection, $query);
        }
        header("Location:index.php");

    }else if('incomplete'==$action){
        $taskId = $_POST['taskId'];
        // echo $taskId;
        if($taskId){
            $query= "UPDATE tasks SET complete=0 WHERE id={$taskId} LIMIT 1";
            mysqli_query($connection, $query);
        }
        header("Location:index.php");

    }else if('bulkcomplete'==$action){
        $taskIds = $_POST['taskids'];
        // print_r($taskIds);
        $_taskids =join(',',$taskIds);
        if($_taskids){
            $query= "UPDATE tasks SET complete=1 WHERE id in ($_taskids)";
            // print_r($query);
            mysqli_query($connection, $query);
        }
        header("Location:index.php");

    }else if('bulkdelete'==$action){
        $taskIds = $_POST['taskids'];
        // print_r($taskIds);
        $_taskids =join(',',$taskIds);
        if($_taskids){
            $query= "DELETE FROM tasks WHERE id in ($_taskids)";
            // print_r($query);
            mysqli_query($connection, $query);
        }
        header("Location:index.php");

    }

}
}
mysqli_close($connection);
?>