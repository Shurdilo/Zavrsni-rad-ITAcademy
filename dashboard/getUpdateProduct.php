<?php

include('../database/connection.php');
if(isset($_POST["product_id"])){
    $output = array();
    $sql = "SELECT * FROM products WHERE id = '". $_POST["product_id"] ."' LIMIT 1";
    $stmtupdate = $db->prepare($sql);
    $stmtupdate->execute();
    $result = $stmtupdate->fetchAll();
    foreach($result as $row){
        $output["name"] = $row["name"];
        $output["description"] = $row["description"];
        $output["status"] = $row["status"];
        if($row["image"] != ''){
            $output["image"] = '
            <img class="myImg" src="../img/projects/' . $row["image"] . '" alt="Image not found" style="object-fit: cover; width: 63.73px; height: 63.73px; border-radius:50%">
            <input type="hidden" name="hidden_product_image" value="' . $row["image"] . '" />
            ';
        }else{
            $output["image"] = '<input type="hidden" name="hidden_product_image" value="" />';
        }
    }
    echo json_encode($output);
}

?>