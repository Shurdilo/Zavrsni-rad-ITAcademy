<?php 

function protection($data) {
    $input = $data;
    $input = trim($input);
    $input = htmlspecialchars($input);

    return $input;
}

?>