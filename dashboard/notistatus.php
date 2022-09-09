<?php  

require_once('../database/connection.php');

if(isset($_POST['id'])){
    $id = $_POST['id'];
    if($_POST['status'] == 0){
        $status = 1;
    }elseif($_POST['status'] == 1){
        $status = 0;
    }else{
        $status = 1;
    }
    $sql = "UPDATE orders SET status=? WHERE id=?";
    $stmtupdate= $db->prepare($sql);
    $result = $stmtupdate->execute([$status, $id]);
    echo json_encode($status);
}
?>