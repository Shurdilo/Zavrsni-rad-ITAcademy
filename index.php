<?php
session_start();

require_once('database/connection.php');
$sql = "SELECT * FROM `products` WHERE STATUS='1' ORDER BY Id DESC LIMIT 8";
$q = $db->query($sql);
$q->setFetchMode(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include "layouts/head.php" ?>
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/owl.carousel.min.css">
    </head>
<body>
    <!-- Header -->
    <header>
        <div id="particles-js"></div>
        <!-- Navigation -->
        <?php include "layouts/navigation.php" ?>
        <!-- End Navigation -->
        <!-- Header content -->
        <div class="header-container">
            <div class="header-left">
                <div class="header-subtitle">Dobrodošli na Wizardprint</div>
                <div class="header-title">Izaberite<br>Svoj<br>Dizajn</div>
                <a class="explore" href="portfolio.php">Istražite <i class="far fa-angle-double-right"></i></a>
                <div class="down"><a href="#orders"><i class="fal fa-long-arrow-down"></i></a></div>
            </div>
            <div class="header-right">
                <img class="shape" src="img/shapes/abstractshape.png" alt="Slika nije pronadjena">
                <img class="tshirt" src="img/tshirt.png" alt="Slika nije pronadjena">
                <img class="elipse" src="img/shapes/Gradientelipse.png" alt="Slika nije pronadjena">
                <img class="elipse" src="img/shapes/Gradientelipse.png" alt="Slika nije pronadjena">
                <img class="elipse" src="img/shapes/Gradientelipse.png" alt="Slika nije pronadjena">
            </div>
        </div>
        <!-- End Header content -->
    </header>
    <!-- End Header -->

    <!-- Main content -->
    <div class="main-content">
        <!-- Oreders content -->
        <section class="section orders-section m-section" id="orders">
            <div class="titles">
                <div class="title">
                    <h1>Naručite najkvalitetnije odštampane proizvode</h1>
                </div>
            </div>
            <div class="cards">
                <div class="card">
                    <a href="orders" class="item-link">
                        <i class="fas fa-tshirt"></i>
                        <div class="item-titles">
                            <h2 class="item-title">Majice</h2>
                            <p class="item-description">Visoko kvalitetna štampa i vez na majicama</p>
                        </div>
                    </a>
                </div>
                <div class="card">
                    <a href="orders" class="item-link">
                        <i class="fas fa-pen"></i>
                        <div class="item-titles">
                            <h2 class="item-title">Olovke i ostali gedžeti</h2>
                            <p class="item-description">Lasersko štampanje olovki, upaljača i ostalih gedžeta</p>
                        </div>
                    </a>
                </div>
                <div class="card">
                    <a href="orders" class="item-link">
                        <i class="fas fa-copy"></i>
                        <div class="item-titles">
                            <h2 class="item-title">Flyeri i vizit kartice</h2>
                            <p class="item-description">Štampa flyera, vizit kartica i mnogo drugih stvari po vašoj želji uz vaš ili naš dizajn</p>
                        </div>
                    </a>
                </div>
                <div class="card">
                    <a href="orders" class="item-link">
                        <i class="fas fa-book-open"></i>
                        <div class="item-titles">
                            <h2 class="item-title">Knjige</h2>
                            <p class="item-description">Štampanje i koričenje knjiga</p>
                        </div>
                    </a>
                </div>
            </div>
        </section>
        <!-- End Orders content -->
    </div>
    <!-- End Main content -->

    <!-- Recent content -->
    <section class="section recent-section">
        <div class="title">
            <h1>Naši nedavni radovi</h1>
        </div>
        <div class="recent-wrapper">
            <?php while($product = $q->fetch()): ?>
            <div class="recent-item">
                <a href="#">
                    <h2><i class="fas fa-external-link-alt"></i> <?php echo htmlspecialchars($product['name']); ?></h2>
                    <img src="img/projects/<?php echo htmlspecialchars($product['image']); ?>" alt="Slika nije pronadjena">
                </a>
            </div>
            <?php endwhile; ?>
        </div>
        <a href="portfolio.php" class="portfolio-link">Pogledajte sve projekte <i class="fal fa-long-arrow-alt-right"></i></a>
    </section>
    <!-- End Recent content -->
        
    <!-- Main content -->
    <div class="main-content">
        <!-- Clients content -->
        <section class="section clients-section m-section">
            <div class="titles">
                <div class="title">
                    <h1>Šta naši klijenti kažu o nama</h1>
                </div>
            </div>
            <div class="owl-carousel owl-theme">
                <div class="item">
                    <div class="card">
                        <div class="card-left">
                            <img src="img/clients/pajapatak.jpg" alt="Image not found">
                            <div class="client">
                                <h2>Paja Patak<br><span>Dizni junak</span></h2>
                                <i class="fas fa-user"></i>
                            </div>
                        </div>
                        <div class="card-right">
                            <div class="comment">
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nam repellendus nemo excepturi fugit tempore impedit quisquam aperiam atque neque pariatur soluta, nulla et assumenda. Maxime.</p>
                                <?php include "img/shapes/quote.svg" ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="card">
                        <div class="card-left">
                            <img src="img/clients/spiderman.jpg" alt="Image not found">
                            <div class="client">
                                <h2>Spajdermen<br><span>Marvelov junak</span></h2>
                                <i class="fas fa-user"></i>
                            </div>
                        </div>
                        <div class="card-right">
                            <div class="comment">
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas fuga porro officia, at qui accusantium iste ab quidem odit facere nesciunt magnam asperiores aspernatur, blanditiis consequuntur nemo odio reprehenderit repellat modi, nobis officiis dolores eveniet? Error laborum asperiores blanditiis molestiae perferendis facilis quis aut non. Velit maiores facilis distinctio sint!</p>
                                <?php include "img/shapes/quote.svg" ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="card">
                        <div class="card-left">
                            <img src="img/clients/spongebob.jpg" alt="Image not found">
                            <div class="client">
                                <h2>Spužva Bob<br><span>Crtani lik</span></h2>
                                <i class="fas fa-user"></i>
                            </div>
                        </div>
                        <div class="card-right">
                            <div class="comment">
                                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Dolores, iste ullam odit repellendus voluptas numquam. Enim magnam fuga voluptates libero, aliquid asperiores tempore quam nemo optio eligendi perferendis nihil atque cupiditate voluptatibus exercitationem sit reiciendis neque suscipit quod ullam facere culpa, natus explicabo. Non, ab, fugiat tempora illum odit praesentium excepturi voluptatibus facilis debitis suscipit eum quidem cupiditate consectetur quam nemo ipsum voluptatum sed tempore. Nam eius quibusdam placeat quidem amet consectetur asperiores, voluptate eos?</p>
                                <?php include "img/shapes/quote.svg" ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="card">
                        <div class="card-left">
                            <img src="img/clients/tomidzeri.jpg" alt="Image not found">
                            <div class="client">
                                <h2>Tom i Džeri<br><span>Crtani likovi</span></h2>
                                <i class="fas fa-user"></i>
                            </div>
                        </div>
                        <div class="card-right">
                            <div class="comment">
                                <p>Tom: Lorem ipsum dolor sit amet consectetur adipisicing elit. Aut quos quis dolores? Odio repellat doloremque ratione illum porro quos fugit, neque laborum accusantium ad veniam voluptatum minima error ducimus dolore vel nihil dolor cum, adipisci unde ipsum perferendis voluptatibus. Illum delectus vero eius? Labore asperiores minima, aut ratione sint adipisci!<br><br>Džeri: Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolor tempora quia ducimus molestias nulla assumenda exercitationem? Excepturi quaerat provident sed consequuntur suscipit cumque pariatur dolorem vero corporis. Odio corporis temporibus incidunt tempore, sed pariatur veritatis illo deleniti eligendi voluptate amet iste adipisci quis, explicabo placeat doloribus nostrum impedit laudantium magnam.</p>
                                <?php include "img/shapes/quote.svg" ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Clients content -->
    </div>
    <!-- End Main content -->

    <!-- Location content -->
    <section class="section location-section">
        <div class="mapouter"><div class="gmap_canvas"><iframe width="100%" height="500" id="gmap_canvas" src="https://maps.google.com/maps?q=16%20Zmaja%20od%20Bosne,%20Kubus%20D,%20Sarajevo%2071000&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><a href="https://123movies-a.com"></a><br><style>.mapouter{position:relative;;height:500px;width:100%;}</style><a href="https://www.embedgooglemap.net">how to embed google map in email</a><style>.gmap_canvas {overflow:hidden;background:none!important;height:500px;width:100%;}</style></div></div>
    </section>
    <!-- End Location content -->

    <!-- Footer -->
    <?php include "layouts/footer.php" ?>
    <!-- End Footer -->
    
    <script src="js/jquery-3.5.1.min.js"></script>
    <!-- Particles script -->
    <script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
    <!-- Testimonial script -->
    <script src="js/owl.carousel.min.js"></script>
    <!-- Theme Dark/Light -->
    <script src="js/theme.js"></script>

    <script>
        particlesJS.load('particles-js', 'js/particles.json', function() {
            console.log('particles.js config loaded');
        });

        $('a').click(function(){
            $('html, body').animate({
                scrollTop: $( $(this).attr('href') ).offset().top
            }, 1000);
            return false;
        });

        $('.owl-carousel').owlCarousel({
            loop:true,
            margin:10,
            nav:true,
            dots:false,
            responsive:{
                0:{
                    items:1
                },
                600:{
                    items:1
                },
                1000:{
                    items:1
                }
            }
        })

        var intervalId = window.setInterval(function(){
            var ri = $('.recent-item').width();
            $('.recent-item').css({'height':(ri/3*2)+'px'});
            $('.recent-item a').css({'height':(ri/3*2)+'px'});
        }, 350);
    </script>
</body>
</html>