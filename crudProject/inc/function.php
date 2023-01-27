<?php
// define('DB_NAME','C:\xampp\htdocs\PhpByHasinHayder\Php_Project\crudProject\data\data.txt');
define('DB_NAME','data/data.txt');
function seed(){
    $data = array(
                array(
                    'id'=>1,
                    'fname'=>'morad',
                    'lname'=>"patwary",
                    'roll'=>'11'
                ),
                array(
                    'id'=>2,
                    'fname'=>'abdur',
                    'lname'=>"rahaman",
                    'roll'=>'12'
                    
                ),
                array(
                    'id'=>3,
                    'fname'=>'ibrahim',
                    'lname'=>"hossain",
                    'roll'=>'9'
                    
                ),
                array(
                    'id'=>4,
                    'fname'=>'mehedi',
                    'lname'=>"hossain",
                    'roll'=>'8'
                    
                ),
                array(
                    'id'=>5,
                    'fname'=>'mazharul',
                    'lname'=>"islam",
                    'roll'=>'7'
                    
                ),

    );
    $serializeData =serialize($data);
    file_put_contents(DB_NAME,$serializeData,LOCK_EX);
}


function genarateReport(){
    $serializeData=file_get_contents(DB_NAME);
    $data =unserialize($serializeData);
?>
<table>
<tr>
    <th>Id</th>
    <th>Name</th>
    <th>Roll</th>
    <?php
    if(isAdmin() || isEditor()){
    ?>
    <th width='25%'>Action</th>
    <?php
    }
    ?> 
</tr>
<?php
foreach ($data as $student) {
    ?>
    <tr>
        <td><?php printf('%d',$student['id']) ?></td>
        <td><?php printf('%s %s',$student['fname'],$student['lname'])?></td>
        <td><?php printf('%s',$student['roll'])?></td>
        <?php
        if(isAdmin()){
        ?>
        <td><?php printf('<a href="index.php?task=edit&id=%s">Edit</a> || <a class="delete" href="index.php?task=delete&id=%s">Delete</a>',$student['id'],$student['id'])?></td>
        <?php
        }elseif(isEditor()){
        ?>
        <td><?php printf('<a href="index.php?task=edit&id=%s">Edit</a>',$student['id'])?></td>
        <?php
        }
        ?>
        
    </tr>
    <?php
}
?>

</table>

<?php
}
// start Adding student
function addStudent($fname, $lname, $roll){
    $found =false;
    $serializeData = file_get_contents(DB_NAME);
    $students = unserialize($serializeData);
    foreach($students as $_student){
        if($_student['roll'] ==$roll){
            $found = true;
            break;
        }
    }
    if(!$found){
    $newId =getNewId($students);
    $student=array(
        'id'=>$newId,
        'fname'=>$fname,
        'lname'=>$lname,
        'roll'=>$roll
    );
    array_push($students, $student);
    $serializeData = serialize($students);
    file_put_contents(DB_NAME, $serializeData,LOCK_EX);
    return true;
}
return false;
}
// Adding student end
function getStudent($id){
    $serializeData = file_get_contents(DB_NAME);
    $students = unserialize($serializeData);
    foreach($students as $student){
        if($student['id'] == $id){
            return $student;
        }           
    }
    return false;
    
}

function updateStudent($id, $fname, $lname, $roll){
    $found=false;
    $serializeData = file_get_contents(DB_NAME);
    $students = unserialize($serializeData);
    foreach($students as $_student){
        if($_student['roll'] ==$roll && $_student['id'] != $id){
            $found = true;
            break;
        }
    }
    if(!$found){
    $students[$id-1]['fname']=$fname;
    $students[$id-1]['lname']=$lname;
    $students[$id-1]['roll']=$roll;
    $serializeData = serialize($students);
    file_put_contents(DB_NAME, $serializeData,LOCK_EX);
    return true;
}
    return false;
}

function deleteStudent($id){
    $serializeData = file_get_contents(DB_NAME);
    $students = unserialize($serializeData);
    
    foreach($students as $offset=>$student){
        if($student['id'] ==$id){
            unset($students[$offset]);
        }      
    }
    

    $serializeData = serialize($students);
    file_put_contents(DB_NAME, $serializeData,LOCK_EX);
}

function getNewId($students){
    $maxId= max(array_column($students,'id'));
    return $maxId +1;
}

// Admin Role for Authentication sedd And Delete

function isAdmin(){
    if(isset($_SESSION['role'])){
    return ($_SESSION['role']=='admin');
    }
}

function isEditor(){
    if(isset($_SESSION['role'])){
        return ($_SESSION['role'] == 'editor');
    }
    
}
function hasPrevilent(){
    return isAdmin() || isEditor();
}

?>