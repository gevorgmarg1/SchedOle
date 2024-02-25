<?php 
    include $_SERVER['DOCUMENT_ROOT'] . "/header.php"; 
    if(isset($_SESSION['user']) && isset($_SESSION['user']['id']))
    {
        echo "<script>window.location.href='/index.php';</script>";
        exit;
    }
?>


<form class="w-75" style="max-width: 300px" method="POST" action="action.php">
        <div class="mb-3 form-group">
            <label class="form-label">Username</label>
            <input type="text" name="username" class="form-control"  required>
        </div>
        <div class="mb-3 form-group">
            <label class="form-label">Password</label>
            <input type="password"  name="password" minlength="8" class="form-control" required>
            <div  class="form-text">Minimum 8 characters</div>
        </div>
        <?php 
        if(isset($_GET['error']))
        {
            if($_GET['error'] == 106)
            {
                ?>
                <div class="alert alert-danger" role="alert">
                  Incorrect email or password <br> Please try again
                </div>
                <?php
            }
        }

    ?>
        <button type="submit" class="original-button" name='signin'>Sign In</button>
    </form>
    

    <?php include $_SERVER['DOCUMENT_ROOT'] . "/footer.php"; ?>