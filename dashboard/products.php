<?php
include('../database/connection.php');
$sql = "SELECT products.*, users.firstname, users.lastname FROM products LEFT JOIN users ON products.admin_id = users.id";
$q = $db->query($sql);
$q->setFetchMode(PDO::FETCH_ASSOC);

?>
<div class="content">
    <a id="add" href="#" data-target="addproduct"><i class="far fa-plus"></i> Dodaj proizvod</a>
    <div class="card">
        <table id="myTable" class="hover stripe cell-border">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Ime proizvoda</th>
                    <th>Datum objave</th>
                    <th>Admin</th>
                    <th>Slika</th>
                    <th>Opcije</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php while($product = $q->fetch()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($product['id']); ?></td>
                        <td><?php echo htmlspecialchars($product['name']); ?></td>
                        <td><?php $timestamp = $product['date']; echo date('d/m/Y h:m:s', strtotime($timestamp)); ?></td>
                        <td><?php echo htmlspecialchars($product['firstname']). ' ' . htmlspecialchars($product['lastname']); ?></td>
                        <td><img onclick="myModal(this)" class="myImg" src="../img/projects/<?php echo htmlspecialchars($product['image']); ?>" alt="Image not found" style="object-fit: cover; width: 30px; height: 30px; border-radius:50%; cursor:pointer;"></td>
                        <td><a class="update" data-adminId="<?php echo $_SESSION['userlogin'][0]['id'] ?>" data-id="<?php echo $product['id']; ?>" href="javascript:void(0)"><i class="fal fa-edit"></i></a> | <a id="status-<?php echo $product['id']; ?>" class="status" href="javascript:void(0)" data-id="<?php echo $product['id']; ?>" data-status="<?php echo $product['status']; ?>"><?php 
                            if($product['status'] == '0'){
                                echo '<i id="eye-'.$product['id'].'" class="far fa-eye"><span id="tooltip-'.$product['id'].'" class="tooltiptext">Aktiviraj</span></i>';
                            }else{
                                echo '<i id="eye-'.$product['id'].'" class="far fa-eye-slash"><span id="tooltip-'.$product['id'].'" class="tooltiptext">Deaktiviraj</span></i>';
                            }
                        ?></a></td>
                        <?php
                            if($product['status'] == '0'){
                                echo '<td id="product-' . $product['id'] . '" style="color:#f44336;">Neaktivan</td>';
                            }else{
                                echo '<td id="product-' . $product['id'] . '" style="color:#8fce00;">Aktivan</td>';
                            }
                        ?>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div> 
</div>
<!-- The Modal -->
<div id="myModal" class="modal">
    <div class="close-outside"></div>
    <img class="modal-content" id="img01">
    <div id="caption"></div>
</div>

<div id="productModal" class="modal fade">
    <div class="close-outside" onclick="closeModal()"></div>
    <div class="modal-dialog">
        <form method="POST" action="dashboard.php" id="product-form" enctype="multipart/form-data">
            <div class="form-group gray focus">
                <h5>Ime proizvoda</h5>
                <input class="input" type="text" name="name" id="name" autocomplete="off" required>
            </div>
            <div class="form-group gray focus">
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
                    <input type="hidden" name="current_product_image" value="">
                </div>  
            </div>
            <div class="form-group product-picture"></div>
            <input type="hidden" name="product_id" id="product_id"/>
            <input class="submit" type="submit" value="Ažuriraj">
        </form>
    </div>
</div>
<script>
    $( document ).ready(function() {
        dataTable.ajax.reload();
    });
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
<script>
    // Get the modal
    var modal = document.getElementById("myModal");

    // Get the image and insert it inside the modal - use its "alt" text as a caption
    var img = document.getElementById("myImg");
    var modalImg = document.getElementById("img01");
    var captionText = document.getElementById("caption");
    function myModal(elmnt){
        modal.style.display = "flex";
        modalImg.src = elmnt.src;
        captionText.innerHTML = elmnt.getAttribute('dataDesc');
    }

    // Get the <span> element that closes the modal
    var close = document.getElementsByClassName("close-outside")[0];

    // When the user clicks on <span> (x), close the modal
    close.onclick = function() { 
        modal.style.display = "none";
    }

    function noscroll() {
        window.scrollTo(0, 0);
    }

    document.getElementsByClassName("close")[0].addEventListener('click', () => {
        window.removeEventListener("scroll", noscroll);
    });

    document.getElementsByClassName("close-outside")[0].addEventListener('click', () => {
        window.removeEventListener("scroll", noscroll);
    });

    document.getElementsByClassName("myImg")[0].addEventListener('click', () => {
        window.addEventListener("scroll", noscroll);  
    });
</script>
<script src="../js/dataTables.js"></script>
<script src="../js/form.js"></script>
<script>
    $('.status').click(function(){
        var status = $(this).data('status');
        var id = $(this).data('id');
        
        $.ajax({
            method  :   'post',
            url     :   'status.php',
            data    :   {status : status, id : id},
            success :   function(response){  
                if(response==0){
                    $("#product-"+id).html("Neaktivan").css("color", "#f44336");
                    $("#status-"+id).data('status', '0');
                    $("#eye-"+id).removeClass("fa-eye-slash").addClass("fa-eye");
                    $("#tooltip-"+id).html("Aktiviraj");
                }else if(response==1){
                    $("#product-"+id).html("Aktivan").css("color", "#8fce00");
                    $("#status-"+id).data('status', '1');
                    $("#eye-"+id).removeClass("fa-eye").addClass("fa-eye-slash");
                    $("#tooltip-"+id).html("Deaktiviraj");
                }
            },error:function(){
                alert("Greška");
            }
        });
    });
</script>
<script>
    $(document).on('click', '.update', function(){
        var product_id = $(this).data('id');
        var admin_id = $(this).data('adminId');
        var modal = document.getElementById("productModal");
        $.ajax({
            url: "getUpdateProduct.php",
            method: "POST",
            data:{product_id:product_id},
            dataType:"json",
            success:function(data){
                modal.style.display = "flex";
                $('#name').val(data.name);
                $('#description').val(data.description);
                $('#status').val(data.status);
                $('#product_id').val(product_id);
                $('#custom-file-input').val("");
                $('#custom-text').html("Niste odabrali sliku.");
                $('.product-picture').html(data.image);
            },error:function(){
                alert("Greška");
            }
        });
    });

    function closeModal(){
        var modal = document.getElementById("productModal");
        modal.style.display = "none";
    }

    
</script>