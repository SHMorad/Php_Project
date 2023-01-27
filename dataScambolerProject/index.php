<?php
include_once 'function.php';
$task='encode';
if(isset($_GET['task']) && $_GET['task'] !=''){
    $task= $_GET['task'];
}
$key='abcdefghijklmnopqrstuvwxyz1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ';
if('key'==$task){
    $key_orginal = str_split($key);
    shuffle($key_orginal);
    $key = join('',$key_orginal);
// print_r($key_orginal);
}elseif(isset($_POST['key']) && $_POST['key'] != ''){
        $key=$_POST['key'];
}
if('encode' == $task){
    $data = $_POST['data']??'';
    if($data !=''){
        $scrambolData = scrambolData($data, $key);
    }
}
if('decode'==$task){
    $data = $_POST['data']??'';
    if($data !=''){
        $scrambolData = decodeData($data, $key);
    }
}

?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,300italic,700,700italic">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/milligram/1.4.1/milligram.css">
        <style>
            body{
                margin-top:30px;
            }
            #data{
                width:100%;
                height:160px;
            }
            #result{
                width:100%;
                height:160px;
            }
            .hidden{
                display:none;
            }
            a{
                margin-right:10px;
            }
        </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="column column-60 column-offset-20">
                <h2>Data Scambolar</h2>
                <p>Use This Application to Scambel your data.</p>
                <p>
                    <a href="index.php?task=encode">Encode</a>|
                    <a href="index.php?task=decode">Decode</a>|
                    <a href="index.php?task=key">Genarate Key</a>
                </p>
                <p>
                    <?php
                    
                    ?>
                </p>
            </div>
        </div>
        
        <div class="row">
            <div class="column column-60 column-offset-20">
                <form action="index.php<?php if('decode'==$task) {echo "?task==decode" ;} ?>" method="post">
                    <label for="key">Key</label>
                    <input type="text" id="key" name="key" <?php displayKey($key); ?> >
                    <label for="data">Data</label>
                    <textarea name="data" id="data"><?php if(isset($_POST['data'])) { echo $_POST['data'];} ?></textarea>
                    <label for="result">Result</label>
                    <textarea name="result" id="result" ><?php echo $scrambolData??'';?></textarea>
                    <button class="button" type="submit">Go it for Me</button>
                </form>
            </div>
        </div>
        
    </div>
</body>
</html>