<?php 
    require_once('../functions.php');
    $getThumbs = mysqli_prepare($conn, "SELECT id FROM thumbs");
    mysqli_stmt_execute($getThumbs);
    mysqli_stmt_store_result($getThumbs);
    mysqli_stmt_fetch($getThumbs);
    echo '<button class="btn btn-success btn-stm" disabled><i class="fa-solid fa-thumbs-up"></i> ' . mysqli_stmt_num_rows($getThumbs) . '</button>';

    mysqli_stmt_close($getThumbs);