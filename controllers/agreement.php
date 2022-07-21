<?php 
require_once('../functions.php');
    $getAgreement = mysqli_prepare($conn, "SELECT agree_from FROM thumbs");
    mysqli_stmt_execute($getAgreement);
    mysqli_stmt_bind_result($getAgreement, $ab);
    mysqli_stmt_fetch($getAgreement);
    echo $ab . ' | ';
    mysqli_stmt_close($getAgreement);
?>