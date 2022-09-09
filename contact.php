<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include "layouts/head.php" ?>
        <link rel="stylesheet" href="css/contact-style.css">
    </head>
<body>

    <!-- Navigation -->
    <?php include "layouts/navigation.php" ?>
    <!-- End Navigation -->

    <!-- Content -->
    <div class="main-content">
        <div class="contact-section">
            <div class="contact-left">
                <div class="mapouter"><div class="gmap_canvas"><iframe width="100%" height="500" id="gmap_canvas" src="https://maps.google.com/maps?q=16%20Zmaja%20od%20Bosne,%20Kubus%20D,%20Sarajevo%2071000&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><a href="https://123movies-a.com"></a><br><style>.mapouter{position:relative;;height:500px;width:100%;}</style><a href="https://www.embedgooglemap.net">how to embed google map in email</a><style>.gmap_canvas {overflow:hidden;background:none!important;height:500px;width:100%;}</style></div></div>
            </div>
            <div class="contact-right">
                <form action="#" autocomplete="on">
                    <div class="form-group">
                        <h5>Ime</h5>
                        <input class="input" type="text" name="firstname" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <h5>Prezime</h5>
                        <input class="input" type="text" name="lastname" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <h5>E-mail</h5>
                        <input class="input" type="email" name="email" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <h5>Telefon</h5>
                        <input class="input" type="tel" name="phone" pattern="[0-9]{3}-[0-9]{2}-[0-9]{3}" autocomplete="off">
                    </div>
                    <div class="form-group text-area">
                        <h5>Poruka</h5>
                        <textarea class="input" name="message"></textarea>
                    </div>
                    <input class="submit" type="submit" value="Pošalji poruku">
                </form>
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

</body>
</html>