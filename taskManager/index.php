<?php
include_once "config.php";
$connection = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);

if(!$connection){
    throw new Exeption("Connection Failed");
}
$query = "SELECT * FROM tasks WHERE complete =0";
$result = mysqli_query($connection, $query);
$CompleteTasksQuery = "SELECT * FROM tasks WHERE complete =1";
$resultComplateTasks = mysqli_query($connection, $CompleteTasksQuery);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TaskManager</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,300italic,700,700italic">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/milligram/1.4.1/milligram.css">
<style>
    body{
        margin-top: 30px;
    }
    #main{
        padding:0px 150px 0px 150px;
    }
    #action{
        width:150px;
    }

</style>
</head>
<body>
    <div class="container" id="main">
        <h1>Task Manager</h1>
        <p>
            This is a Simple project for managing our daily task. We're going to use HTML , CSS, PHP, JavaScript for this project.
        </p>
        <?php
        if(mysqli_num_rows($resultComplateTasks)>0){
          ?>
          <h4>Complete Task</h4>

          <form action="tasks.php" method="POST">
          <table>
                <thead>
                    <tr>
                        <th></th>
                        <th>Id</th>
                        <th>Task</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
          <?php  
            while($cdata= mysqli_fetch_assoc($resultComplateTasks)){
                $timeStamp = strtotime($cdata['date']);
                $cdate = date("jS-M-Y", $timeStamp);
                ?>
                <tr>
                <td><input class="label-line" type="checkbox" value="<?php echo $cdata['id'] ?>"></td>
                <td><?php echo $cdata['id']?></td>
                <td><?php echo $cdata['task']?></td>
                <td><?php echo $cdate?></td>
                <td><a class="delete" data-taskId="<?php echo $cdata['id']?>" href="#">Delete</a> || <a class="incomplate" data-taskId="<?php echo $cdata['id']?>" href="#">Mark Incomplete</a></td>
            </tr>
            <?php
            }
            ?>
                 </tbody>
            </table>
            <?php
        }
        ?>
        
        <?php
        if(mysqli_num_rows($result)==0){
          ?>
          <p>No Task Found </p>
          <?php  
        }else{
        ?>
        <h4>Up Comeing Task</h4>
            <table>
                <thead>
                    <tr>
                        <th></th>
                        <th>Id</th>
                        <th>Task</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while($data=mysqli_fetch_assoc($result)){
                        $timeStamp = strtotime($data['date']);
                        $date = date("jS-M-Y", $timeStamp);
                    ?>
                    <tr>
                        <td><input name="taskids[]" class="label-line" type="checkbox" value="<?php echo $data['id'] ?>"></td>
                        <td><?php echo $data['id']?></td>
                        <td><?php echo $data['task']?></td>
                        <td><?php echo $date?></td>
                        <td><a class="delete" data-taskId="<?php echo $data['id']?>" href="#">Delete</a> || <a class="complete" data-taskId="<?php echo $data['id']?>" href="#">Complete</a></td>
                    </tr>
                    <?php
                        }
                    ?>
                </tbody>
            </table>
            <select name="action" id="action">
                <option value="0">With Selected</option>
                <option value="bulkdelete">Delete</option>
                <option value="bulkcomplete">Mark as Complete</option>
            </select>
            <input class="button-primary" id="bulksubmit" type="submit" value="submit">
        </form>
        <?php
        }
        ?>




        <hr>
        <h4>Add Task</h4>
        <form action="tasks.php" method="post">
            <fieldset>
                <?php
                $added = $_GET['added']??'';
                if($added){
                    echo '<p>Task Successfully Added .</p>';
                }
                ?>
                <label for="task">Task</label>
                <input type="text" placeholder="Task Details" name="task" id="task">
                <label for="date">Date</label>
                <input type="text" placeholder="Task Date" name="date" id="date">
                <input type="submit" value="Add Task" class="button-primary">
                <input type="hidden" name="action" value="add">
            </fieldset>

        </form>


    </div>
    <form action="tasks.php" method="POST" id="completeForm">
        <input type="hidden" name="action" value="complete">
        <input type="hidden" id="taskId" name="taskId">
    </form>
    <form action="tasks.php" method="POST" id="deleteForm">
        <input type="hidden" name="action" value="delete">
        <input type="hidden" id="dtaskId" name="taskId">
    </form>
    <form action="tasks.php" method="POST" id="incompleteForm">
        <input type="hidden" name="action" value="incomplete">
        <input type="hidden" id="itaskId" name="taskId">
    </form>
</body>
<script src="jquery-3.6.3.slim.min.js"></script>
<script>
    ;(function($){
        $(document).ready(function (){
           $(".complete").on('click',function(){
                var id = $(this).data("taskid"); 
                // alert(id);
                $("#taskId").val(id);
                $("#completeForm").submit();
                
           });
           $(".delete").on('click',function(){
            if(confirm("Are You Sure to delete This task..?")){
                var id = $(this).data("taskid"); 
                // alert(id);
                $("#dtaskId").val(id);
                $("#deleteForm").submit();
            }    
           });
           $(".incomplate").on('click',function(){
                var id = $(this).data("taskid"); 
                // alert(id);
                $("#itaskId").val(id);
                $("#incompleteForm").submit();  
           });
           $("#bulksubmit").on('click',function(){
            if($("#action").val() == "bulkdelete"){
                if(!confirm("Are You Sure to Delete...?")){
                    return false;
                }
            }
           })
        });
    })(jQuery);
</script>
</html>