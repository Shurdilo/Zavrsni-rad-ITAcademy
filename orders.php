<?php
    session_start();
    include('database/connection.php');

    
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include "layouts/head.php" ?>
        <link rel="stylesheet" href="css/orders-style.css">
    </head>
<body>

    <!-- Navigation -->
    <?php include "layouts/navigation.php" ?>
    <!-- End Navigation -->

    <!-- Content -->
    <div class="main-content">
        <div class="title">
            <h1>Naruči</h1>
        </div>

        <!-- Orders -->
        <div class="orders">
            <div class="recent-wrapper">
                <div class="cards">
                    <div class="card">
                        <a href="order?varname=tshirt" class="item-link">
                            <i class="fas fa-tshirt"></i>
                            <div class="item-titles">
                                <h2 class="item-title">Majice</h2>
                                <p class="item-description">Visoko kvalitetna štampa i vez na majicama</p>
                            </div>
                        </a>
                    </div>
                    <div class="card">
                        <a href="order?varname=pen" class="item-link">
                            <i class="fas fa-pen"></i>
                            <div class="item-titles">
                                <h2 class="item-title">Olovke i ostali gedžeti</h2>
                                <p class="item-description">Lasersko štampanje olovki i ostalih gedžeta</p>
                            </div>
                        </a>
                    </div>
                    <div class="card">
                        <a href="order?varname=mug" class="item-link">
                            <i class="fas fa-mug-hot"></i>
                            <div class="item-titles">
                                <h2 class="item-title">Šolje</h2>
                                <p class="item-description">Štampa šolja po vašoj želji uz vaš ili naš dizajn</p>
                            </div>
                        </a>
                    </div>
                    <div class="card">
                        <a href="order?varname=book" class="item-link">
                            <i class="fas fa-book-open"></i>
                            <div class="item-titles">
                                <h2 class="item-title">Knjige</h2>
                                <p class="item-description">Štampanje i koričenje knjiga</p>
                            </div>
                        </a>
                    </div>
                    <div class="card">
                        <a href="order?varname=flag" class="item-link">
                            <i class="fas fa-flag"></i>
                            <div class="item-titles">
                                <h2 class="item-title">Bilbordi i svijetleće reklame</h2>
                                <p class="item-description">Proizvodnja i postavljanje bilborda i svijetlećih reklama</p>
                            </div>
                        </a>
                    </div>
                    <div class="card">
                        <a href="order?varname=pictures" class="item-link">
                            <i class="fas fa-image"></i>
                            <div class="item-titles">
                                <h2 class="item-title">Slike</h2>
                                <p class="item-description">Najkvalitetnija štampa i obrada slika</p>
                            </div>
                        </a>
                    </div>
                    <div class="card">
                        <a href="order?varname=fire" class="item-link">
                            <i class="fas fa-fire"></i>
                            <div class="item-titles">
                                <h2 class="item-title">Upaljači</h2>
                                <p class="item-description">Štampa i graviranje na upaljačima</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Orders -->
    </div>
    <!-- End Content -->

    <!-- Footer -->
    <?php include "layouts/footer.php" ?>
    <!-- End Footer -->

    <!-- Theme Dark/Light -->
    <script src="js/theme.js"></script>
    <script type="text/javascript">
        <?php include "js/sweetalertJS.php" ?>
    </script>
</body>
</html>