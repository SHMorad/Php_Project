<p>
    <div class="float-left">
        <p>
        <a href="index.php?task=report">All Students</a>
        <?php
            if(isAdmin() || isEditor()){
        ?>
        |
        <a href="index.php?task=add">Add New Students</a>
        <?php
         }
        ?>
       
       
        <?php
        if(isAdmin()):
        ?>
        |
        <a href="index.php?task=seed">Seed</a>
        <?php
        endif;
        ?>
        </p>
    </div>
    <div class="float-right">
        <?php
        if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] = false){
          ?>
            <a class="button-primary" href="auth.php">Log In</a>
          <?php  
        }else{
        ?>
        <a href="auth.php?logout=true">Log Out (<?php echo $_SESSION['role']; ?>)</a>
        <?php
        }
        ?>
        
    </div>
    <hr>
    
</p>
