<?php
include('../database/connection.php');
$sql = "SELECT orders.*, users.firstname, users.lastname FROM orders LEFT JOIN users ON orders.user_id = users.id";
$q = $db->query($sql);
$q->setFetchMode(PDO::FETCH_ASSOC);

?>
<div class="content">
    <div class="card">
        <table id="myTable" class="hover stripe cell-border">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Vrsta proizvoda</th>
                    <th>Traženi proizvod</th>
                    <th>Napomena</th>
                    <th>Datum narudžbe</th>
                    <th>Kupac</th>
                    <th>Slika</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php while($order = $q->fetch()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($order['id']); ?></td>
                        <td><?php echo htmlspecialchars($order['product']); ?></td>
                        <td><?php echo htmlspecialchars($order['product_real_name']); ?></td>
                        <td><?php echo htmlspecialchars($order['note']); ?></td>
                        <td><?php $timestamp = $order['created_at']; echo date('d/m/Y', strtotime($timestamp)); ?></td>
                        <td><?php echo htmlspecialchars($order['firstname']). ' ' . htmlspecialchars($order['lastname']); ?></td>
                        <td><img onclick="myModal(this)" class="myImg" src="../img/orders/<?php echo htmlspecialchars($order['image']); ?>" alt="Image not found" style="object-fit: cover; width: 30px; height: 30px; border-radius:50%; cursor:pointer;"></td>
                        <?php
                            if($order['status'] == '0'){
                                echo '<td id="order-' . $order['id'] . '" style="color:#f44336; cursor:pointer;" class="status" href="javascript:void(0)" data-id="'.$order['id'].'" data-status="'.$order['status'].'" >Završeno</td>';
                            }elseif($order['status'] == '1'){
                                echo '<td id="order-' . $order['id'] . '" style="color:#8fce00; cursor:pointer;" class="status" href="javascript:void(0)" data-id="'.$order['id'].'" data-status="'.$order['status'].'" >Pročitano</td>';
                            }else{
                                echo '<td id="order-' . $order['id'] . '" style="color:#F1C232; cursor:pointer;" class="status" href="javascript:void(0)" data-id="'.$order['id'].'" data-status="'.$order['status'].'" >Nepročitano</td>';
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
<script>
    $('.status').click(function(){
        var status = $(this).data('status');
        var id = $(this).data('id');
        
        $.ajax({
            method  :   'post',
            url     :   'notistatus.php',
            data    :   {status : status, id : id},
            success :   function(response){  
                if(response==0){
                    $("#order-"+id).html("Završeno").css("color", "#f44336");
                    $("#order-"+id).data('status', '0');
                }else if(response==1){
                    $("#order-"+id).html("Pročitano").css("color", "#8fce00");
                    $("#order-"+id).data('status', '1');
                }
            },error:function(){
                alert("Greška");
            }
        });
    });
</script>