<?php 
    include('functions.php');
    
    if(!isLoggedIn()) {
        header("location: index.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>SyntaxScripts | Grant Keys</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css?v=<?php echo time(); ?>" rel="stylesheet" />
    </head>
    <body>
        <!-- Responsive navbar-->
        <?php include('inc/nav.php'); ?>
        <!-- Page content-->
        <div class="container">
            <div class="row mt-5">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="text-center mb-3">
                                <b>Important Information</b>
                            </div>
                            <div class="mb-3">
                                You can <b><i>only grant new keys</i></b> when someone has purchased a product from us, their key has been compromised, or they lost their key. 
                            </div>
                            <div class="mb-3">
                                <b>For new keys</b> - make sure all the information in the form matches what the customer told you. This can only be set once and <b><i>cannot be edited</i></b> in the future!
                            </div>
                            <div class="mb-3">
                                <b>For compromised keys</b> - make sure you <b><a href="revoke-keys.php">revoke their old key</a></b> prior to granting a new key. Please also advise them that they can only get a new key because of compromisation <b>ONCE</b>. If their key gets compromised again they will not be allowed to get a new one.
                            </div>
                            <div class="mb-3">
                                <b>For lost keys</b> - like compromised keys, make sure you <b><a href="revoke-keys.php">revoke their old key</a></b> prior to granting a new key. Please also advise them that there only allowed to get a new key for free once if they lost their old one. Anything more than the one free key will cost <b><i>$1.00 per key</i></b>.
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="text-center mb-3">
                                <b>Grant A New Key</b>
                                <p class="text-small">Please be sure to read the important information on the left!</p>
                            </div>
                            <div class="mb-3">
                                <form action="grant-keys">
                                    <div class="mb-3">
                                        <label>License Key (Automatically Generated)</label>
                                        <input type="text" class="form-control" name="license_key" value="<?php echo genLicenseKey() . '-' . genLicenseKey() . '-' . genLicenseKey() . '-' . genLicenseKey(); ?>" readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label>Name of Key Owner</label>
                                        <input type="text" class="form-control" name="owner">
                                    </div>
                                    <div class="mb-3">
                                        <label>Grant Reason</label>
                                        <select name="issued_for" class="form-select">
                                            <option value="New Purchase">New Purchase</option>
                                            <option value="Compromised Key">Compromised Key</option>
                                            <option value="Lost Key">Lost Key</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label>Discord of Key Owner</label>
                                        <input type="text" class="form-control" name="discord">
                                        <small class="text-small">Enter the owners discord username here.</small>
                                    </div>
                                    <div class="mb-3">
                                        <label>Issued By</label>
                                        <input type="text" class="form-control" name="issued_by" value="<?php echo $username; ?>" readonly>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-5">
                <p class="text-small float-end"><i>
                    <?php 
                        $settingId = "1";
                        $getVersion = mysqli_prepare($conn, "SELECT version FROM settings WHERE id = ?");
                        mysqli_stmt_bind_param($getVersion, "i", $settingId);
                        mysqli_stmt_execute($getVersion);
                        mysqli_stmt_bind_result($getVersion, $ver);
                        mysqli_stmt_fetch($getVersion);
                            echo $ver;
                        mysqli_stmt_close($getVersion);
                    ?>
                </i></p>
            </div>
        </div>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>
