<?php

session_start();

if (!isset($_SESSION['userlogin'])){
    header("Location: index");
}

require_once('database/connection.php');

include "database/protection.php";
include "database/password.php";

if(isset($_POST['password']) && !empty($_POST['password'])){
    if(isset($_POST['newpassword']) && !empty($_POST['newpassword'])){
        if(isset($_POST['confirmpassword']) && !empty($_POST['confirmpassword'])){
            $id = $_SESSION['userlogin'][0]['id'];

            $password = protection($_POST['password']);
            $password = password($password);

            if($password === $_SESSION['userlogin'][0]['password']){
                $newpassword = $_POST['newpassword'];
                $confirmpassword = $_POST['confirmpassword'];

                if($newpassword == $confirmpassword){

                    $newpassword = protection($_POST['newpassword']);
                    $newpassword = password($newpassword);

                    $sql = "UPDATE users SET password=? WHERE id = '$id'";
                    $stmtupdate = $db->prepare($sql);
                    $result = $stmtupdate->execute([$newpassword]);
                    if($result){
                        $_SESSION['userlogin'][0]['password'] = $newpassword;
                        echo 'Uspješno ste ažurirali lozinku!';
                        $_SESSION['message'] = "Uspješno ste ažurirali lozinku!";
                        $_SESSION['icon'] = "success";
                    }else{
                        echo 'Ažuriranje lozinke nije uspjelo, dogodila se greška.';
                    }
                }else{
                    echo 'Lozinke se ne poklapaju.';
                }

            }else{
                echo 'Molimo Vas unesite tačne podatke.';
            }

        }else{
            echo 'Popunite sva polja!';
        }
    }else{
        echo 'Popunite sva polja!';
    }
}else{
    echo 'Popunite sva polja!';
}
?>