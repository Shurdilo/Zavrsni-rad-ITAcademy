<?php
    session_start();
    if (!isset($_SESSION['userlogin'])){
        header("Location: index");
    }

    require_once('database/connection.php');

    include "database/protection.php";
    include "database/password.php";

    if (isset($_GET['deleteimage'])){
        $userImage = $_SESSION['userlogin'][0]['image'];
        $imagePath = 'img/users/';
        $image = "";
        $id = $_SESSION['userlogin'][0]['id'];

        if(file_exists($imagePath.$userImage)){
            unlink($imagePath.$userImage);
        }

        $sql = "UPDATE users SET image=? WHERE id = '$id'";
        $stmtupdate = $db->prepare($sql);
        $result = $stmtupdate->execute([$image]);
        if($result){
            $_SESSION['message'] = "Uspješno ste obrisali sliku!";
            $_SESSION['icon'] = "success";
            $_SESSION['userlogin'][0]['image'] = $image;
        }else{
            $_SESSION['message'] = "Brisanje nije uspjelo, dogodila se greška.";
            $_SESSION['icon'] = "error";
        }
    }

    if(isset($_POST['firstname']) && !empty($_POST['firstname'])){
        if(isset($_POST['lastname']) && !empty($_POST['lastname'])){
            if(isset($_POST['email']) && !empty($_POST['email'])){
                if(isset($_POST['password']) && !empty($_POST['password'])){
                    $password = protection($_POST['password']);
                    $password = password($password);

                    if($password === $_SESSION['userlogin'][0]['password']){
                        $id = $_SESSION['userlogin'][0]['id'];

                        $firstname = protection($_POST['firstname']);
                        $lastname = protection($_POST['lastname']);
                        $email = protection($_POST['email']);

                        $phone = protection($_POST['phone']);

                        if (is_numeric($phone) || $phone == "" || (substr($phone, 0, 1) === "+" && is_numeric(substr($phone, 1)))) {
                            
                            if(isset($_FILES['image']) && !empty($_FILES['image']['name'])){
                                $image = $_FILES['image'];

                                $imageName = $_FILES['image']['name'];
                                $imageTmpName = $_FILES['image']['tmp_name'];
                                $imageSize = $_FILES['image']['size'];
                                $imageError = $_FILES['image']['error'];
                                $imageType = $_FILES['image']['type'];
                                $imagePath = 'img/users/';

                                $imageExtension = explode('.', $imageName);
                                $imageActualExtension = strtolower(end($imageExtension));

                                $allowedImages = array('jpg', 'jpeg', 'png');

                                if (in_array($imageActualExtension, $allowedImages)) {
                                    if ($imageError === 0) {
                                        if($imageSize < 10000000){
                                            $imageName = uniqid('', true).".".$imageActualExtension;
                                            $imageDestination = "img/users/".$imageName;
                                            move_uploaded_file($imageTmpName, $imageDestination);

                                            if(!empty($_SESSION['userlogin'][0]['image'])){
                                                $userImage = $_SESSION['userlogin'][0]['image'];
                                                $imageEmpty = "";

                                                if(file_exists($imagePath.$userImage)){
                                                    unlink($imagePath.$userImage);
                                                }

                                                $sql = "UPDATE users SET image=? WHERE id = '$id'";
                                                $stmtupdate = $db->prepare($sql);
                                                $result = $stmtupdate->execute([$imageEmpty]);
                                                if($result){
                                                    $_SESSION['userlogin'][0]['image'] = $imageEmpty;
                                                }
                                            }
                                        }else{
                                            $_SESSION['message'] = "Veličina slike mora biti manja od 10MB";
                                            $_SESSION['icon'] = "error";
                                        }
                                    }else{
                                        $_SESSION['message'] = "Desila se greška prilikom otpremanja slike";
                                        $_SESSION['icon'] = "error";
                                    }
                                }else{
                                    $_SESSION['message'] = "Ovaj format slike nije dozvoljen";
                                    $_SESSION['icon'] = "error";
                                }
                            }else if(!empty($_POST['current_admin_image'])){
                                $imageName = $_POST['current_admin_image'];
                            }else{
                                $imageName = "";
                            }

                            $data = [
                                'firstname' => $firstname,
                                'lastname' => $lastname,
                                'email' => $email,
                                'password' => $password,
                                'phone' => $phone,
                                'image' => $imageName,
                                'id' => $id,
                            ];
                            $sql = "UPDATE users SET firstname=:firstname, lastname=:lastname, email=:email, password=:password, phone=:phone, image=:image WHERE id=:id";
                            $stmtupdate= $db->prepare($sql);
                            $result = $stmtupdate->execute($data);
                            if($result){
                                $_SESSION['message'] = "Uspješno ste ažurirali podatke!";
                                $_SESSION['icon'] = "success";

                                $_SESSION['userlogin'][0]['firstname'] = $firstname;
                                $_SESSION['userlogin'][0]['lastname'] = $lastname;
                                $_SESSION['userlogin'][0]['email'] = $email;
                                $_SESSION['userlogin'][0]['password'] = $password;
                                $_SESSION['userlogin'][0]['phone'] = $phone;
                                $_SESSION['userlogin'][0]['image'] = $imageName;
                            }else{
                                $_SESSION['message'] = "Ažuriranje podatka nije uspjelo, dogodila se greška.";
                                $_SESSION['icon'] = "error";
                            }

                        }else {
                            $_SESSION['message'] = "Telefon nije ispravan.";
                            $_SESSION['icon'] = "error";
                        }
                    }else{
                        $_SESSION['message'] = "Molimo Vas unesite tačnu lozinku.";
                        $_SESSION['icon'] = "error";
                    }

                }elseif(isset($_POST['password']) && empty($_POST['password'])){
                    $_SESSION['message'] = "Molimo Vas popunite sva polja.";
                    $_SESSION['icon'] = "error";
                }
            }elseif(isset($_POST['email']) && empty($_POST['email'])){
                $_SESSION['message'] = "Molimo Vas popunite sva polja.";
                $_SESSION['icon'] = "error";
            }
        }elseif(isset($_POST['lastname']) && empty($_POST['lastname'])){
            $_SESSION['message'] = "Molimo Vas popunite sva polja.";
            $_SESSION['icon'] = "error";
        }
    }elseif(isset($_POST['firstname']) && empty($_POST['firstname'])){
        $_SESSION['message'] = "Molimo Vas popunite sva polja.";
        $_SESSION['icon'] = "error";
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include "layouts/head.php" ?>
        <link rel="stylesheet" href="css/profile-style.css">
    </head>
<body>

    <!-- Navigation -->
    <?php include "layouts/navigation.php" ?>
    <!-- End Navigation -->

    <!-- Content -->
    <div class="main-content"> 
        <div class="profile-section">
            <div class="profile-left">
                <h2>Podešavanja profila</h2>

                <?php
                    if(empty($_SESSION['userlogin'][0]['image'])){
                        echo '<svg id="457bf273-24a3-4fd8-a857-e9b918267d6a" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="698" height="698" viewBox="0 0 698 698"><defs><linearGradient id="b247946c-c62f-4d08-994a-4c3d64e1e98f" x1="349" y1="698" x2="349" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="gray" stop-opacity="0.25"/><stop offset="0.54" stop-color="gray" stop-opacity="0.12"/><stop offset="1" stop-color="gray" stop-opacity="0.1"/></linearGradient></defs><title>profile pic</title><g opacity="0.5"><circle cx="349" cy="349" r="349" fill="url(#b247946c-c62f-4d08-994a-4c3d64e1e98f)"/></g><circle cx="349.68" cy="346.77" r="341.64" fill="var(--color5)"/><path d="M601,790.76a340,340,0,0,0,187.79-56.2c-12.59-68.8-60.5-72.72-60.5-72.72H464.09s-45.21,3.71-59.33,67A340.07,340.07,0,0,0,601,790.76Z" transform="translate(-251 -101)" fill="#5ba1c1"/><circle cx="346.37" cy="339.57" r="164.9" fill="#333"/><path d="M293.15,476.92H398.81a0,0,0,0,1,0,0v84.53A52.83,52.83,0,0,1,346,614.28h0a52.83,52.83,0,0,1-52.83-52.83V476.92a0,0,0,0,1,0,0Z" opacity="0.1"/><path d="M296.5,473h99a3.35,3.35,0,0,1,3.35,3.35v81.18A52.83,52.83,0,0,1,346,610.37h0a52.83,52.83,0,0,1-52.83-52.83V476.35A3.35,3.35,0,0,1,296.5,473Z" fill="#fdb797"/><path d="M544.34,617.82a152.07,152.07,0,0,0,105.66.29v-13H544.34Z" transform="translate(-251 -101)" opacity="0.1"/><circle cx="346.37" cy="372.44" r="151.45" fill="#fdb797"/><path d="M489.49,335.68S553.32,465.24,733.37,390l-41.92-65.73-74.31-26.67Z" transform="translate(-251 -101)" opacity="0.1"/><path d="M489.49,333.78s63.83,129.56,243.88,54.3l-41.92-65.73-74.31-26.67Z" transform="translate(-251 -101)" fill="#333"/><path d="M488.93,325a87.49,87.49,0,0,1,21.69-35.27c29.79-29.45,78.63-35.66,103.68-69.24,6,9.32,1.36,23.65-9,27.65,24-.16,51.81-2.26,65.38-22a44.89,44.89,0,0,1-7.57,47.4c21.27,1,44,15.4,45.34,36.65.92,14.16-8,27.56-19.59,35.68s-25.71,11.85-39.56,14.9C608.86,369.7,462.54,407.07,488.93,325Z" transform="translate(-251 -101)" fill="#333"/><ellipse cx="194.86" cy="372.3" rx="14.09" ry="26.42" fill="#fdb797"/><ellipse cx="497.8" cy="372.3" rx="14.09" ry="26.42" fill="#fdb797"/></svg>';
                    }else{
                        echo '<img onclick="myFunction(this)" class="myImg" src="img/users/' . $_SESSION['userlogin'][0]['image'] . '" alt="Image not found" dataDesc="' . $_SESSION['userlogin'][0]['firstname'] . ' ' . $_SESSION['userlogin'][0]['lastname'] . '">';
                    }
                ?>                                   
                    
                <form action="profile.php" method="POST" autocomplete="on" enctype="multipart/form-data">
                    <div class="form-group focus">
                        <h5>Ime</h5>
                        <input class="input" type="text" name="firstname" autocomplete="off" required value="<?php echo $_SESSION['userlogin'][0]['firstname'] ?>">
                    </div>
                    <div class="form-group focus">
                        <h5>Prezime</h5>
                        <input class="input" type="text" name="lastname" autocomplete="off" required value="<?php echo $_SESSION['userlogin'][0]['lastname'] ?>">
                    </div>
                    <div class="form-group focus">
                        <h5>E-mail</h5>
                        <input class="input" type="email" name="email" autocomplete="off" required value="<?php echo $_SESSION['userlogin'][0]['email'] ?>">
                    </div>
                    <div class="form-group">
                        <h5>Lozinka</h5>
                        <input class="input" type="password" name="password" autocomplete="off" required>
                    </div>
                    <div class="form-group focus">
                        <h5>Telefon</h5>
                        <input class="input" type="tel" name="phone" autocomplete="on" value="<?php echo $_SESSION['userlogin'][0]['phone'] ?>">
                    </div>
                    <div class="form-group focus">
                        <h5>Slika</h5>
                        <div class="custom-file">
                            <input type="file" id="custom-file-input" name="image" accept="image/*" hidden>
                            <button type="button" id="custom-button">Izaberite sliku</button>
                            <span id="custom-text">Niste odabrali sliku.</span>
                            <input type="hidden" name="current_admin_image" value="<?php echo $_SESSION['userlogin'][0]['image'] ?>">
                        </div>  
                    </div>
                    <?php 
                        if(!empty($_SESSION['userlogin'][0]['image'])){
                            echo '<div class="form-group user-picture">
                            <img onclick="myFunction(this)" class="myImg" src="img/users/' . $_SESSION['userlogin'][0]['image'] . '" alt="Image not found" style="object-fit: cover; width: 63.73px; height: 63.73px; border-radius:50%">
                            <a href="'.$activePage.'.php?deleteimage=true"><span>Obriši sliku</span></a>
                            </div>';
                        }
                    ?>                    
                    <input class="submit" id="save" type="submit" value="Ažuriraj podatke">
                </form>
            </div>
            <div class="profile-right">
                <?php include "profile.svg" ?>
            </div>
        </div>
    </div>
    <!-- End Content -->

    <!-- Footer -->
    <?php include "layouts/footer.php" ?>
    <!-- End Footer -->

    <!-- The Modal -->
    <div id="myModal" class="modal">
        <span class="close">&times;</span>
        <div class="close-outside"></div>
        <img class="modal-content" id="img01">
        <div id="caption"></div>
    </div>

    <!-- Theme Dark/Light -->
    <script src="js/theme.js"></script>
    <!-- Form Script -->
    <script src="js/form.js"></script>
    <!-- Profile Script -->
    <script src="js/profile.js"></script>
    <!-- Scripts -->
    <script type="text/javascript">
        <?php include "js/sweetalertJS.php" ?>
        
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
</body>
</html>