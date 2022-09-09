<?php 
    session_start();

    if (isset($_SESSION['userlogin'])){
        header("Location: index");
    }

    require_once('database/connection.php');

    include "database/protection.php";
    include "database/password.php";
    include('loginRegisterFunction.php');  
       
    $funObj = new Database(); 
    if(isset($_POST['email']) && !empty($_POST['email'])){
        if(isset($_POST['password']) && !empty($_POST['password'])){
            
            $email = protection($_POST['email']);
            $password = protection($_POST['password']);
            $password = password($password);
            $user = $funObj->Login($email, $password);

        }elseif(isset($_POST['password']) && empty($_POST['password'])){
            $_SESSION['message'] = "Molimo Vas popunite sva polja.";
            $_SESSION['icon'] = "error";
        }
    }elseif(isset($_POST['email']) && empty($_POST['email'])){
        $_SESSION['message'] = "Molimo Vas popunite sva polja.";
        $_SESSION['icon'] = "error";
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include "layouts/head.php" ?>
        <link rel="stylesheet" href="css/login-style.css">
    </head>
<body>

    <!-- Navigation -->
    <?php include "layouts/navigation.php" ?>
    <!-- End Navigation -->

    <!-- Content -->
    <div class="main-content"> 
        <div class="login-section">
            <div class="login-left">
                <h2>Prijavljivanje</h2>
                <form action="login.php" method="POST" autocomplete="on">
                    <div class="form-group">
                        <h5>E-mail</h5>
                        <input class="input" type="email" name="email" id="email" autocomplete="off" require>
                    </div>
                    <div class="form-group">
                        <h5>Lozinka</h5>
                        <input class="input" type="password" name="password" id="password" autocomplete="off" require>
                    </div>
                    <input class="submit" id="login" type="submit" value="Prijavi se">
                </form>
                <p>Nemaš nalog? <a href="registration.php"> Registruj se</a></p>
            </div>
            <div class="login-right">
                <?php include "login.svg" ?>
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

    <script type="text/javascript">
        <?php include "js/sweetalertJS.php" ?>
    </script>

</body>
</html>