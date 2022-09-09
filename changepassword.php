<?php

session_start();

if (!isset($_SESSION['userlogin'])){
    header("Location: index");
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include "layouts/head.php" ?>
        <link rel="stylesheet" href="css/password-style.css">
    </head>
<body>

    <!-- Navigation -->
    <?php include "layouts/navigation.php" ?>
    <!-- End Navigation -->

    <!-- Content -->
    <div class="main-content"> 
        <div class="password-section">
            <div class="password-left">
                <h2>Promjena lozinke</h2>
                <form action="changepassword.php" method="POST" autocomplete="on">
                    <div class="form-group">
                        <h5>Lozinka</h5>
                        <input class="input" type="password" name="password" id="password" autocomplete="off" required>
                    </div>     
                    <div class="form-group">
                        <h5>Nova lozinka</h5>
                        <input class="input" type="password" name="newpassword" id="newpassword" autocomplete="off" required>
                    </div>    
                    <div class="form-group">
                        <h5>Potvrda nove lozinke</h5>
                        <input class="input" type="password" name="confirmpassword" id="confirmpassword" autocomplete="off" required>
                    </div>  
                    <span id="message"></span>         
                    <input class="submit" id="save" type="submit" value="Ažuriraj lozinku">
                </form>
            </div>
            <div class="password-right">
                <?php include "password.svg" ?>
            </div>
        </div>
    </div>
    <!-- End Content -->

    <!-- Footer -->
    <?php include "layouts/footer.php" ?>
    <!-- End Footer -->

    <!-- Theme Dark/Light -->
    <script src="js/theme.js"></script>
    <!-- Form Script -->
    <script src="js/form.js"></script>
    <!-- Ajax -->
    <script src="js/ajax.js"></script>
    <!-- Scripts -->
    <script type="text/javascript">
        <?php include "js/sweetalertJS.php" ?>
    </script>
</body>
</html>