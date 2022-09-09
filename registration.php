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
    if(isset($_POST['firstname']) && !empty($_POST['firstname'])){
        if(isset($_POST['lastname']) && !empty($_POST['lastname'])){
            if(isset($_POST['email']) && !empty($_POST['email'])){
                if(isset($_POST['password']) && !empty($_POST['password'])){

                    $firstname = protection($_POST['firstname']);
                    $lastname = protection($_POST['lastname']);
                    $email = protection($_POST['email']);
                    
                    $password = protection($_POST['password']);
                    $password = password($password);

                    $phone = protection($_POST['phone']);

                    if (is_numeric($phone) || $phone == "" || (substr($phone, 0, 1) === "+" && is_numeric(substr($phone, 1)))) {
                        $user = $funObj->UserRegister($firstname, $lastname, $email, $password, $phone);
                    }else {
                        $_SESSION['message'] = "Telefon nije ispravan.";
                        $_SESSION['icon'] = "error";
                    }
                }elseif(isset($_POST['password']) && empty($_POST['password'])){
                    $_SESSION['message'] = "Molimo Vas popunite sva polja.";
                    $_SESSION['icon'] = "error";
                }
            }elseif(isset($_POST['email']) && empty($_POST['email'])){
                $_SESSION['message'] = "Molimo Vas popunite sva polja.";
                $_SESSION['icon'] = "error";
            }
        }elseif(isset($_POST['lastname']) && empty($_POST['lastname'])){
            $_SESSION['message'] = "Molimo Vas popunite sva polja.";
            $_SESSION['icon'] = "error";
        }
    }elseif(isset($_POST['firstname']) && empty($_POST['firstname'])){
        $_SESSION['message'] = "Molimo Vas popunite sva polja.";
        $_SESSION['icon'] = "error";
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include "layouts/head.php" ?>
        <link rel="stylesheet" href="css/registration-style.css">
    </head>
<body>

    <!-- Navigation -->
    <?php include "layouts/navigation.php" ?>
    <!-- End Navigation -->

    <!-- Content -->
    <div class="main-content"> 
        <div class="registration-section">
            <div class="registration-left">
                <h2>Registracija</h2>
                <form action="registration.php" method="POST" autocomplete="on">
                    <div class="form-group">
                        <h5>Ime</h5>
                        <input class="input" type="text" name="firstname" autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <h5>Prezime</h5>
                        <input class="input" type="text" name="lastname" autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <h5>E-mail</h5>
                        <input class="input" type="email" name="email" autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <h5>Lozinka</h5>
                        <input class="input" type="password" name="password" autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <h5>Telefon</h5>
                        <input class="input" type="tel" name="phone" autocomplete="on">
                    </div>
                    <input class="submit" type="submit" value="Registruj se">
                </form>
                <p>Već imaš nalog? <a href="login.php"> Prijavi se</a></p>
            </div>
            <div class="registration-right">
                <?php include "registration.svg" ?>
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
    <!-- Scripts -->
    <script type="text/javascript">
        <?php include "js/sweetalertJS.php" ?>
    </script>

</body>
</html>