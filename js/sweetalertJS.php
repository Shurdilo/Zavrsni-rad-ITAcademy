<?php 
    if(isset($_SESSION['message'])){
        echo "
            Swal.fire({
                title: '".$_SESSION['message']."',
                icon: '".$_SESSION['icon']."',
                confirmButtonText: 'U redu!',
            })
        ";
        unset($_SESSION['message']);
        unset($_SESSION['icon']);
    }
?>