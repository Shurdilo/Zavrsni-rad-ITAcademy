<?php

session_start();

require_once('../database/connection.php');
include "../database/protection.php";


if(isset($_POST['name']) && !empty($_POST['name'])){
    if(isset($_POST['description']) && !empty($_POST['description'])){
        if(isset($_FILES['image']) && !empty($_FILES['image']['name'])){
            $name = protection($_POST['name']);
            $description = protection($_POST['description']);
            $admin_id = $_SESSION['userlogin'][0]['id'];
            $image = $_FILES['image'];
            $status = protection($_POST['status']);

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
                    }
                }
            }
            $data = [
                'name' => $name,
                'admin_id' => $admin_id,
                'image' => $imageName,
                'description' => $description,
                'status' => $status,
            ];
            $sql = "INSERT INTO products (name, admin_id, image, description, status) VALUES (:name, :admin_id, :image, :description, :status)";
            $stmtupdate= $db->prepare($sql);
            $result = $stmtupdate->execute($data);
            header('Location: http://localhost/wizardprint/dashboard/dashboard');
        }
    }
}

?>
<div class="content">
    <a id="add" href="#" data-target="products" onclick="loadContent()"><i class="far fa-chevron-left"></i></a>
    <form action="addproduct.php" method="POST" autocomplete="on" enctype="multipart/form-data">
        <div class="form-group gray">
            <h5>Ime proizvoda</h5>
            <input class="input" type="text" name="name" autocomplete="off" required>
        </div>
        <div class="form-group gray">
            <h5>Opis proizvoda</h5>
            <textarea class="input" id="description" name="description"></textarea>
        </div>
        <div class="form-group blue">
            <div class="custom-select">
                <select name="status" id="status">
                    <option value="1">Aktivan</option>
                    <option value="0">Neaktivan</option>
                </select>
                <span class="custom-arrow"></span>
            </div>
        </div>
        <div class="form-group blue">
            <h5>Slika</h5>
            <div class="custom-file">
                <input type="file" id="custom-file-input" name="image" accept="image/*" hidden>
                <button type="button" id="custom-button">Izaberite sliku</button>
                <span id="custom-text">Niste odabrali sliku.</span>
            </div>  
        </div>
        <input class="submit" type="submit" value="Dodaj">
    </form>
</div>
<script src="../js/dataTables.js"></script>
<script src="../js/form.js"></script>

<script>
    const realFileBtn = document.getElementById("custom-file-input");
			const customTxt = document.getElementById("custom-text");
			const customBtn = document.getElementById("custom-button");

			customBtn.addEventListener("click", function(){
				realFileBtn.click();
			});

			customTxt.addEventListener("click", function(){
				realFileBtn.click();
			});

			realFileBtn.addEventListener("change", function(){
				if(realFileBtn.value){
					customTxt.innerHTML = realFileBtn.value.match(/[\/\\]([\w\d\s\.\-\(\)]+)$/)[1];
				}else{
					customTxt.innerHTML = "Niste odabrali sliku.";
				}
			});
</script>