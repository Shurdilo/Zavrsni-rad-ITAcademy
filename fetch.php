<?php
include('database/connection.php');
if(isset($_POST['limit'], $_POST['start'])){
    $sql = "SELECT * FROM `products` WHERE STATUS='1' ORDER BY Id DESC LIMIT ".$_POST['start'].", ".$_POST['limit']."";
    $q = $db->query($sql);
    $q->setFetchMode(PDO::FETCH_ASSOC);
    while($product = $q->fetch()){
        echo '<div class="recent-item">
                <a href="#">
                    <h2><i class="fas fa-external-link-alt"></i> '.$product['name'].'</h2>
                    <img src="img/projects/'.$product['image'].'" alt="Slika nije pronadjena">
                </a>
            </div>';
    }
}

?>