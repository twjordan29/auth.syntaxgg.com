<?php if(!isLoggedIn()) { ?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow">
    <div class="container">
        <a class="navbar-brand" href="#">SyntaxScripts Auth</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link" aria-current="page" href="#">Home</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">More</a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#exampleModal" href="#">Staff Login</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
<?php } elseif(isLoggedIn()) { ?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow">
    <div class="container">
        <a class="navbar-brand" href="#">SyntaxScripts Auth</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link text-white" href="admin.php">Home</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="sale-report.php">Sale Report</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Keys</a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="keys.php">Key List</a></li>
                        <li><a class="dropdown-item" href="grant-keys.php">Grant Keys</a></li>
                        <li><a class="dropdown-item" href="revoke-keys.php">Revoke Keys</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><?php echo $username; ?> 
                </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a href="seller-tracker.php" class="dropdown-item text-center">
                        <b>Wallet: <?php echo $money; ?></b>
                        </a></li>
                        <hr>
                        <li><a href="seller-tracker.php" class="dropdown-item text-center">
                        <?php 
                            if($level == "1") {
                                echo '<span class="badge bg-primary"><i class="fa-solid fa-crown"></i> Seller Level 1</span>';
                            } elseif($level == "2") {
                                echo '<span class="badge bg-danger"><i class="fa-solid fa-crown"></i> Seller Level 2</span>';
                            } elseif($level == "3") {
                                echo '<span class="badge bg-info"><i class="fa-solid fa-crown"></i> Seller Level 3</span>';
                            } 
                        ?>
                        </a></li>
                        <hr>
                        <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                    </ul>
                </li>
                <?php if($job == "Administrator") { ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Tasks </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="logout.php">Pending Sale Reports <span class="badge bg-danger">
                            <?php 
                                $status = "Pending";
                                $getPendingSales = mysqli_prepare($conn, "SELECT id FROM sales WHERE `status` = ?");
                                mysqli_stmt_bind_param($getPendingSales, "s", $status);
                                mysqli_stmt_execute($getPendingSales);
                                mysqli_stmt_store_result($getPendingSales);
                                mysqli_stmt_fetch($getPendingSales);
                                    echo mysqli_stmt_num_rows($getPendingSales);
                                mysqli_stmt_close($getPendingSales);
                            ?>
                        </span></a></li>
                        <li><a class="dropdown-item" href="logout.php">Pending Seller Applications <span class="badge bg-danger">
                            <?php 
                                $status = "Pending";
                                $getPendingApps = mysqli_prepare($conn, "SELECT id FROM applications WHERE `status` = ?");
                                mysqli_stmt_bind_param($getPendingApps, "s", $status);
                                mysqli_stmt_execute($getPendingApps);
                                mysqli_stmt_store_result($getPendingApps);
                                mysqli_stmt_fetch($getPendingApps);
                                    echo mysqli_stmt_num_rows($getPendingApps);
                                mysqli_stmt_close($getPendingApps);
                            ?>
                        </span></a></li>
                    </ul>
                </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</nav>
<?php } ?>