<?php header('x-xss-protection:0') ;
include "form1_functions.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,300italic,700,700italic">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/milligram/1.4.1/milligram.css">
    <title>WebPage</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class=".column column-70 column-offset-50">



                <h1>WelCome!</h1>
                <h3><?php echo "Hello World"?></h3>
                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Cupiditate est voluptas consequatur qui
                    quisquam placeat id pariatur ducimus dicta dolorem.</p>
                <?php
        $fName ='';
        $lName='';
        $fruits = ['mango','apple','banana','lice','lemon'];
    ?>
                <p>

                    <?php if(isset($_POST['fname']) && !empty($_POST['fname'])){
        $fName = htmlspecialchars($_REQUEST['fname']);
    } ?>
                    <?php if(isset($_POST['lname']) && !empty($_POST['lname'])){
            $lName = htmlspecialchars($_REQUEST['lname']);
        }
        
         ?>
                </p>
                <p>
                    <?php
                    // print_r($_POST);
                        echo "FristName : ".$fName;
                        echo "<br>";
                        echo "LastName : ".$lName;
                        echo "<br>";
                       /*  // single value
                        if(isset($_POST['fruits']) && $_POST['fruits'] !==''){
                                printf("You have Selected : %s", filter_input(INPUT_POST, 'fruits',FILTER_SANITIZE_STRING));
                        } */
                        // multiple value
                        // $sfruits = isset($_POST['fruits'])? $_POST['fruits']:array();
                        $sfruits = $_POST['fruits']??array();
                        if($sfruits && $sfruits>0){
                            echo "You have Selected : ".join(",",$sfruits);
                        }
                    ?>
                </p>
                <form action="" method="post">
                    <fieldset>
                        <input type="text" name="fname" placeholder="Enter Your firstName" value="<?php echo $fName?>">
                        <br>
                        <input type="text" name="lname" placeholder="Enter Your lastName" value="<?php echo $lName?>">
                        <br>
                        <select style="height:200px" name="fruits[]" id="fruits" multiple>
                            <option value="" selected disabled>Select Some Fruits</option>
                            <?php displayOption($fruits, $sfruits); ?>
                        </select>
                        <button type="submit" class="button">Upload</button>
                        
                    </fieldset>
                </form>
                
            </div>
        </div>
    </div>
</body>

</html>