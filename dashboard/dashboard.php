<?php

session_start();

if (!isset($_SESSION['userlogin'])){
    header("Location: ../index");
}elseif(!($_SESSION['userlogin'][0]['status'] == "3" || $_SESSION['userlogin'][0]['status'] == "2")){
    header("Location: profile");
}

include('../database/connection.php');
include "../database/protection.php";

if(isset($_POST['name']) && !empty($_POST['name'])){
    if(isset($_POST['description']) && !empty($_POST['description'])){
            $name = protection($_POST['name']);
            $description = protection($_POST['description']);
            $admin_id = $_SESSION['userlogin'][0]['id'];
            $image = $_FILES['image'];
            $status = protection($_POST['status']);
            $id = ($_POST['product_id']);
            if(isset($_FILES['image']) && !empty($_FILES['image']['name'])){
                $imageName = $_FILES['image']['name'];
                $imageTmpName = $_FILES['image']['tmp_name'];
                $imageSize = $_FILES['image']['size'];
                $imageError = $_FILES['image']['error'];
                $imageType = $_FILES['image']['type'];
                $imagePath = '../img/projects/';
                $imageExtension = explode('.', $imageName);
                $imageActualExtension = strtolower(end($imageExtension));

                $allowedImages = array('jpg', 'jpeg', 'png');

                if (in_array($imageActualExtension, $allowedImages)) {
                    if ($imageError === 0) {
                        if($imageSize < 100000000){
                            $imageName = uniqid('', true).".".$imageActualExtension;
                            $imageDestination = "../img/projects/".$imageName;
                            move_uploaded_file($imageTmpName, $imageDestination);

                            if(!empty($_POST['hidden_product_image'])){
                                $productImage = $_POST['hidden_product_image'];
                                $imageEmpty = "";

                                if(file_exists($imagePath.$productImage)){
                                    unlink($imagePath.$productImage);
                                }

                                $sql = "UPDATE products SET image=? WHERE id = '$id'";
                                $stmtupdate = $db->prepare($sql);
                                $result = $stmtupdate->execute([$imageEmpty]);
                            }
                        }
                    }
                }
            }else if(!empty($_POST['hidden_product_image'])){
                $imageName = $_POST['hidden_product_image'];
            }else{
                $imageName = "";
            }

            
            $data = [
                'name' => $name,
                'admin_id' => $admin_id,
                'image' => $imageName,
                'description' => $description,
                'status' => $status,
                'id' => $id,
            ];
            $sql = "UPDATE products SET name=:name, admin_id=:admin_id, image=:image, description=:description, status=:status WHERE id=:id";
            $stmtupdate= $db->prepare($sql);
            $result = $stmtupdate->execute($data);
            header('Location: http://localhost/wizardprint/dashboard/dashboard');
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include "layouts/head.php" ?>
    <link id="themecss" rel="stylesheet" href="css/products.css">
</head>
<body>
<?php include "layouts/navigation.php" ?>    
<?php include "layouts/sidebar.php" ?>
<?php include "layouts/scripts.php" ?>
    <div id="content">
        <?php include('products.php'); ?>
    </div>

</body>
</html>