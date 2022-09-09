<?php
    session_start();
    include('database/connection.php');
    if(isset($_GET['varname'])){
        $_SESSION['order']=$_GET['varname'];
        header("Location: order");
        die;
    }elseif(!isset($_SESSION['order'])){
        header("Location: orders");
    }elseif(!isset($_SESSION['userlogin'])){
        $_SESSION['message'] = "Molimo Vas prijavite se da biste naručili proizvod.";
        $_SESSION['icon'] = "warning";
        header("Location: login");
    }

    include "database/protection.php";

    if(isset($_POST['product']) && !empty($_POST['product'])){
        if(isset($_POST['product_real_name']) && !empty($_POST['product_real_name'])){
            if(isset($_FILES['image']) && !empty($_FILES['image']['name'])){
                $user_id = $_SESSION['userlogin'][0]['id'];
                $product = protection($_POST['product']);
                $product_real_name = protection($_POST['product_real_name']);
                $note = protection($_POST['note']);
                $image = $_FILES['image'];
                $status = 2;
    
                $imageName = $_FILES['image']['name'];
                $imageTmpName = $_FILES['image']['tmp_name'];
                $imageSize = $_FILES['image']['size'];
                $imageError = $_FILES['image']['error'];
                $imageType = $_FILES['image']['type'];
                $imagePath = 'img/orders/';
                $imageExtension = explode('.', $imageName);
                $imageActualExtension = strtolower(end($imageExtension));
    
                $allowedImages = array('jpg', 'jpeg', 'png');
    
                if (in_array($imageActualExtension, $allowedImages)) {
                    if ($imageError === 0) {
                        if($imageSize < 100000000){
                            $imageName = uniqid('', true).".".$imageActualExtension;
                            $imageDestination = "img/orders/".$imageName;
                            move_uploaded_file($imageTmpName, $imageDestination);
                        }
                    }
                }
                $data = [
                    'user_id' => $user_id,
                    'product' => $product,
                    'product_real_name' => $product_real_name,
                    'note' => $note,
                    'image' => $imageName,
                    'status' => $status,
                ];
                $sql = "INSERT INTO orders (user_id, product, product_real_name, note, image, status) VALUES (:user_id, :product, :product_real_name, :note, :image, :status)";
                $stmtupdate= $db->prepare($sql);
                $result = $stmtupdate->execute($data);
                $_SESSION['message'] = "Vaša narudžba je primljena.";
                $_SESSION['icon'] = "success";
                header('Location: orders');
            }
        }
    }
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
                <form action="order.php" method="POST" autocomplete="on" enctype="multipart/form-data">
                    <div class="form-cards">
                        <div class="left-form">
                            <div class="form-group blue focus">
                                <h5>Odaberite vrstu proizvoda</h5>
                                <div class="custom-select">
                                    <select name="product" id="product">
                                        <option <?php if($_SESSION['order']==="tshirt"){
                                            echo "selected";
                                        } ?> value="Majica">Majice</option>
                                        <option <?php if($_SESSION['order']==="pen"){
                                            echo "selected";
                                        } ?> value="Olovka">Olovke</option>
                                        <option <?php if($_SESSION['order']==="mug"){
                                            echo "selected";
                                        } ?> value="Šolja">Šolje</option>
                                        <option <?php if($_SESSION['order']==="book"){
                                            echo "selected";
                                        } ?> value="Knjiga">Knjige</option>
                                        <option <?php if($_SESSION['order']==="flag"){
                                            echo "selected";
                                        } ?> value="Bilbordi">Bilbordi</option>
                                        <option <?php if($_SESSION['order']==="pictures"){
                                            echo "selected";
                                        } ?> value="Slike">Slike</option>
                                        <option <?php if($_SESSION['order']==="fire"){
                                            echo "selected";
                                        } ?> value="Upaljači">Upaljači</option>
                                    </select>
                                    <span class="custom-arrow"></span>
                                </div>
                            </div>
                            <div class="form-group gray">
                                <h5>Tačan naziv(zahtjev) proizvoda</h5>
                                <input class="input" type="text" name="product_real_name" autocomplete="off" required>
                            </div>
                            <div class="form-group gray">
                                <h5>Dodatna napomena</h5>
                                <textarea class="input" id="note" name="note"></textarea>
                            </div>
                        </div>
                        <div class="right-form">
                            <div class="form-group blue">
                                <h5>Slika</h5>
                                <div class="custom-file">
                                    <input type="file" id="custom-file-input" name="image" accept="image/*" hidden>
                                    <button type="button" id="custom-button">Izaberite sliku</button>
                                    <span id="custom-text">Niste odabrali sliku.</span>
                                </div>  
                            </div>
                            <div class="image-preview" id="imagePreview">
                                <img src="" alt="Pregled Slike" class="image-preview-image">
                                <span class="image-preview-default-text">Pregled slike</span>
                            </div>
                        </div>
                    </div>
                    <input class="submit" type="submit" value="Naruči">
                </form>
            </div>
        </div>
        <!-- End Orders -->
    </div>
    <!-- End Content -->
    <?php /*
        echo $_SESSION['order']; 
        unset($_SESSION['order']);
    */?>
    <!-- Footer -->
    <?php include "layouts/footer.php" ?>
    <!-- End Footer -->

    <!-- Theme Dark/Light -->
    <script src="js/theme.js"></script>
    <script src="js/form.js"></script>
    <script>
        const realFileBtn = document.getElementById("custom-file-input");
        const customTxt = document.getElementById("custom-text");
        const customBtn = document.getElementById("custom-button");
        const previewContainer = document.getElementById("imagePreview");
        const previewImage = previewContainer.querySelector(".image-preview-image");
        const previewDefaultText = previewContainer.querySelector(".image-preview-default-text");

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

        realFileBtn.addEventListener("change", function(){
            const file = this.files[0];

            if(file){
                const reader = new FileReader();

                previewDefaultText.style.display = "none";
                previewImage.style.display = "block";
                previewContainer.style.width = "auto";

                reader.addEventListener("load", function(){
                    previewImage.setAttribute("src", this.result);
                });

                reader.readAsDataURL(file);
            }else{
                previewDefaultText.style.display = null;
                previewImage.style.display = null;
                previewContainer.style.width = null;
                previewImage.setAttribute("src", "");
            }
        });
    </script>
</body>
</html>