<?php 
$activePage = basename($_SERVER['PHP_SELF'], ".php");

if (isset($_GET['logout'])){
    session_destroy();
    unset($_SESSION['userlogin']);
    header("Location: $activePage");
}

?>
<nav>
    <div class="nav-left">
        <a href="index" class="logo">
            <i class="fas fa-hat-wizard"></i>
            <p><span>Wizard</span>print</p>
        </a>
        <div class="nav-links">
            <ul>
                <li class="<?= ($activePage == 'index') ? 'active':''; ?>"><a href="index">Početna</a></li>
                <li class="<?= ($activePage == 'portfolio') ? 'active':''; ?>"><a href="portfolio">Portfolio</a></li>
                <li class="<?= ($activePage == 'orders') ? 'active':''; ?>"><a href="orders">Naruči</a></li>
                <li class="<?= ($activePage == 'about') ? 'active':''; ?>"><a href="#">O nama</a></li>
                <li class="<?= ($activePage == 'contact') ? 'active':''; ?>"><a href="contact">Kontakt</a></li>
            </ul>
        </div>
    </div>
    <div class="nav-right">
        <div class="nav-links">
            <ul>
                <li id="icon">
                    <a onclick="switchTheme()">
                        <i class="fas fa-moon dark-icon"></i>
                        <i class="fas fa-sun light-icon"></i>
                    </a>
                </li>
                <?php
                    if (isset($_SESSION['userlogin'])){
                        echo '
                            <li id="user-settings">
                                <div class="toggler-user">
                                    <p>'.$_SESSION['userlogin'][0]['firstname'].'</p>'?>
                                    <?php
                                        if(empty($_SESSION['userlogin'][0]['image'])){
                                            echo '<svg id="457bf273-24a3-4fd8-a857-e9b918267d6a" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="698" height="698" viewBox="0 0 698 698"><defs><linearGradient id="b247946c-c62f-4d08-994a-4c3d64e1e98f" x1="349" y1="698" x2="349" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="gray" stop-opacity="0.25"/><stop offset="0.54" stop-color="gray" stop-opacity="0.12"/><stop offset="1" stop-color="gray" stop-opacity="0.1"/></linearGradient></defs><title>profile pic</title><g opacity="0.5"><circle cx="349" cy="349" r="349" fill="url(#b247946c-c62f-4d08-994a-4c3d64e1e98f)"/></g><circle cx="349.68" cy="346.77" r="341.64" fill="var(--color5)"/><path d="M601,790.76a340,340,0,0,0,187.79-56.2c-12.59-68.8-60.5-72.72-60.5-72.72H464.09s-45.21,3.71-59.33,67A340.07,340.07,0,0,0,601,790.76Z" transform="translate(-251 -101)" fill="#5ba1c1"/><circle cx="346.37" cy="339.57" r="164.9" fill="#333"/><path d="M293.15,476.92H398.81a0,0,0,0,1,0,0v84.53A52.83,52.83,0,0,1,346,614.28h0a52.83,52.83,0,0,1-52.83-52.83V476.92a0,0,0,0,1,0,0Z" opacity="0.1"/><path d="M296.5,473h99a3.35,3.35,0,0,1,3.35,3.35v81.18A52.83,52.83,0,0,1,346,610.37h0a52.83,52.83,0,0,1-52.83-52.83V476.35A3.35,3.35,0,0,1,296.5,473Z" fill="#fdb797"/><path d="M544.34,617.82a152.07,152.07,0,0,0,105.66.29v-13H544.34Z" transform="translate(-251 -101)" opacity="0.1"/><circle cx="346.37" cy="372.44" r="151.45" fill="#fdb797"/><path d="M489.49,335.68S553.32,465.24,733.37,390l-41.92-65.73-74.31-26.67Z" transform="translate(-251 -101)" opacity="0.1"/><path d="M489.49,333.78s63.83,129.56,243.88,54.3l-41.92-65.73-74.31-26.67Z" transform="translate(-251 -101)" fill="#333"/><path d="M488.93,325a87.49,87.49,0,0,1,21.69-35.27c29.79-29.45,78.63-35.66,103.68-69.24,6,9.32,1.36,23.65-9,27.65,24-.16,51.81-2.26,65.38-22a44.89,44.89,0,0,1-7.57,47.4c21.27,1,44,15.4,45.34,36.65.92,14.16-8,27.56-19.59,35.68s-25.71,11.85-39.56,14.9C608.86,369.7,462.54,407.07,488.93,325Z" transform="translate(-251 -101)" fill="#333"/><ellipse cx="194.86" cy="372.3" rx="14.09" ry="26.42" fill="#fdb797"/><ellipse cx="497.8" cy="372.3" rx="14.09" ry="26.42" fill="#fdb797"/></svg>';
                                        }else{
                                            echo '<img src="img/users/' . $_SESSION['userlogin'][0]['image'] . '" alt="Image not found">';
                                        }
                                    ?>      
                                    <?php
                                    echo'</div>
                                <ul id="dropdown-user" class="dropdown">
                                    <li id="dropdown-menu"><a href="profile"><i class="fas fa-user"></i><span>Profil</span></a></li>
                                    <li id="dropdown-menu"><a href="changepassword"><i class="fas fa-key"></i><span>Promjena lozinke</span></a></li>';
                                    if($_SESSION['userlogin'][0]['status'] == "3" || $_SESSION['userlogin'][0]['status'] == "2"){
                                        echo '<li id="dropdown-menu"><a href="dashboard/dashboard"><i class="fas fa-users-cog"></i><span>Admin panel</span></a></li>';
                                    }
                                    echo '<li id="dropdown-menu"><a href="'.$activePage.'?logout=true"><i class="fas fa-sign-out-alt"></i><span>Odjava</span></a></li>
                                </ul>
                            </li>
                        ';
                    }else{
                        echo '<li class="'?><?= ($activePage == 'login') ? 'active':''; ?><?php    
                        echo'"><a href="login"><i class="far fa-user"></i> Prijavi se</a></li>
                            <li id="reg"><a href="registration"><i class="fas fa-sign-in"></i> Registruj se</a></li>';
                    }
                ?>
                <li id="hamburger-menu"><a href="#"><i class="far fa-bars"></i></a></li>
            </ul>
        </div>
    </div>
</nav>

<script src="js/dropdown.js"></script>