<?php
    session_start();
    include('database/connection.php');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include "layouts/head.php" ?>
        <link rel="stylesheet" href="css/portfolio-style.css">
    </head>
<body>

    <!-- Navigation -->
    <?php include "layouts/navigation.php" ?>
    <!-- End Navigation -->

    <!-- Content -->
    <div class="main-content">
        <div class="title">
            <h1>Projekti</h1>
        </div>

        <!-- Projects -->
        <div class="projects">
            <div class="recent-wrapper">
            </div>
            <div class="message"></div>
        </div>
        <!-- End Projects -->
    </div>
    <!-- End Content -->

    <!-- Footer -->
    <?php include "layouts/footer.php" ?>
    <!-- End Footer -->

    <!-- Theme Dark/Light -->
    <script src="js/theme.js"></script>
    <script>

        $(document).ready(function(){

            var limit = 6;
            var start = 0;
            var action = 'inactive';
            function load_project_data(limit, start){
                $.ajax({
                    url: "fetch.php",
                    method:"POST",
                    data:{limit:limit, start:start},
                    cache:false,
                    success:function(data){
                        $(".recent-wrapper").append(data);
                        if(data == ''){
                            $('.message').html("Nema više podataka");
                            action = 'active';
                        }else{
                            $('.message').html("Podaci se učitavaju...");
                            action = 'inactive';
                        }
                    }
                });
            }

            if(action == 'inactive'){
                action = 'active';
                load_project_data(limit, start);
            }
            $(window).scroll(function(){
                if($(window).scrollTop() + $(window).height() > $(".recent-wrapper").height() && action == 'inactive'){
                    action = 'active';
                    start = start + limit;
                    setTimeout(function(){
                        load_project_data(limit, start);
                    }, 1000);
                }
            });

        });

        var intervalId = window.setInterval(function(){
            var ri = $('.recent-item').width();
            $('.recent-item').css({'height':(ri/3*2)+'px'});
            $('.recent-item a').css({'height':(ri/3*2)+'px'});
        }, 350);
    </script>
</body>
</html>