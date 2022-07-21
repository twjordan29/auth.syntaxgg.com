<?php 
    require_once('../functions.php');
    $agreeFrom = $username;
    $insertAgree = mysqli_prepare($conn, "INSERT INTO thumbs (agree_from) VALUES (?)");
    mysqli_stmt_bind_param($insertAgree, "s", $agreeFrom);
    mysqli_stmt_execute($insertAgree);

    mysqli_stmt_close($insertAgree);