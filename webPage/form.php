<?php header('x-xss-protection:0') ;
include "function.php";
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
        $checked='';
        if(isset($_GET['cb1']) && ($_GET['cb1'])==1){
            $checked='checked';
        }
    ?>
                <p>

                    <?php if(isset($_GET['fname']) && !empty($_GET['fname'])){
        $fName = htmlspecialchars($_REQUEST['fname']);
    } ?>
                    <?php if(isset($_GET['lname']) && !empty($_GET['lname'])){
            $lName = htmlspecialchars($_REQUEST['lname']);
        }
        
         ?>
                </p>
                <p>
                    <?php
                        echo "FristName : ".$fName;
                        echo "<br>";
                        echo "LastName : ".$lName;
                        echo "<br>";
                        echo 'Check : '.$checked;
                    ?>
                </p>
                <form action="" method="get">
                    <fieldset>
                        <input type="text" name="fname" placeholder="Enter Your firstName" value="<?php echo $fName?>">
                        <br><br>
                        <input type="text" name="lname" placeholder="Enter Your lastName" value="<?php echo $lName?>">
                        <br><br>
                        <input type="checkbox" name="cb1" id="cb1" value="1" <?php echo $checked; ?> >
                        <label for="cb1" class="label-inline">Some Checkbox</label>
                        <br><br>
                        <label class="label" for="">Select Some Fruits</label>
                        <input type="checkbox" name="fruits[]" value="orange" <?php isChecked('orange' ) ?> >
                        <label class="label-inline">Orange</label><br>
                        <input type="checkbox" name="fruits[]" value="mango" <?php isChecked('mango' ) ?>>
                        <label class="label-inline">Mango</label><br>
                        <input type="checkbox" name="fruits[]" value="lice" <?php isChecked('lice' ) ?>>
                        <label class="label-inline">Lice</label><br> 
                        <input type="checkbox" name="fruits[]" value="banana" <?php isChecked('banana' ) ?>>
                        <label class="label-inline">Banana</label><br>
                        <input type="checkbox" name="fruits[]" value="lemon" <?php isChecked('lemon' ) ?>>
                        <label class="label-inline">Lemon</label><br>
                        <button type="submit" class="button">upload</button> 
                    </fieldset>
                </form>
                
            </div>
        </div>
    </div>
</body>

</html>