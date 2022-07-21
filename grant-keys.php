<?php 
    include('functions.php');
    
    if(!isLoggedIn()) {
        header("location: index.php");
    }

    if(isset($_POST['grant_key'])) {
        $license_key = $_POST['license_key'];
        $domain_name = $_POST['domain_name'];
        $owner = $_POST['owner'];
        $issued_for = $_POST['issued_for'];
        $discord = $_POST['discord'];
        $status = $_POST['status'];
        $issued_by = $_POST['issued_by'];

        $grantKey = mysqli_prepare($conn, "INSERT INTO licenses (`license_key`, `domain_name`, `owner`, `issued_for`, `discord`, `status`, `issued_by`) VALUES (?, ?, ?, ?, ?, ?, ?)");
        mysqli_stmt_bind_param($grantKey, "sssssss", $license_key, $domain_name, $owner, $issued_for, $discord, $status, $issued_by);
        $keySuccess = mysqli_stmt_execute($grantKey);

        if($keySuccess) {
            header("location: grant-keys.php?key=added");
        } else {
            header("location: grant-keys.php?key=error");
        }
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
        <link rel="stylesheet" href="notifications/css/lobibox.css"/>    
        <link href="css/styles.css?v=<?php echo time(); ?>" rel="stylesheet" />
        <script src="https://kit.fontawesome.com/026ca76167.js" crossorigin="anonymous"></script>
    </head>
    <body>
        <!-- Responsive navbar-->
        <?php include('inc/nav.php'); ?>
        <!-- Page content-->
        <div class="container">
            <div class="row mt-5">
                <div class="col-md-4">
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="text-center mb-3">
                                <b>Field Information</b>
                            </div>
                            <div class="mb-3">
                                <ul>
                                    <li><b>License Key</b> - This is the license key where the owner of the product will have to be authorized through https://auth.syntaxgg.com/.</li>
                                    <li><b>Domain</b> - This is where the owner of the license key will host our script(s). It must not contain https://, http://, or www. and it cannot be changed (unless it's being changed from a domain to a localhost environment).</li>
                                    <li><b>Name of Key Owner</b> - This is the customers first name.</li>
                                    <li><b>Grant Reason</b> - Why are you generating a new key for this customer?</li>
                                    <li><b>Discord of Key Owner</b> - This is the owners discord username.</li>
                                    <li><b>Issued By</b> - This is un-editable, and it contains your username. This logs who granted what keys and helps us keep track of abuse of the auth system.</li>
                                </ul>
                            </div>
                        </div>
                    </div>
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
                    <?php if(isset($_GET['key']) && $_GET['key'] == "added") { ?>
                    <div class="alert alert-success shadow">
                        License key was successfully granted and activated!
                    </div>
                    <?php } ?>
                    <?php if(isset($_GET['key']) && $_GET['key'] == "error") { ?>
                    <div class="alert alert-danger shadow">
                        Something went wrong when trying to issue a key. Please try again in a little bit.
                    </div>
                    <?php } ?>
                    <div class="card">
                        <div class="card-body">
                            <div class="text-center mb-3">
                                <b>Grant A New Key</b>
                                <p class="text-small">Please be sure to read the important information on the left!</p>
                            </div>
                            <div class="mb-3">
                                <?php if($level == "1") { ?>
                                    <form action="grant-keys.php" method="POST">
                                    <div class="mb-3">
                                        <label>License Key (Automatically Generated)</label>
                                        <input type="text" class="form-control" name="license_key" value="<?php echo genLicenseKey() . '-' . genLicenseKey() . '-' . genLicenseKey() . '-' . genLicenseKey(); ?>" readonly>
                                        <small class="text-small">Be sure to copy this key to give to the customer!</small>
                                    </div>
                                    <div class="mb-3">
                                        <label>Domain</label>
                                        <input type="text" class="form-control" name="domain_name">
                                        <small class="text-small">This is the domain where the item will be hosted. It <b>must not</b> contain www. or https://. For exmaple: syntaxgg.com or auth.syntaxgg.com.</small>
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
                                    <input type="hidden" name="status" value="Pending">
                                    <div class="mb-3">
                                        <label>Issued By</label>
                                        <input type="text" class="form-control" name="issued_by" value="<?php echo $username; ?>" readonly>
                                    </div>
                                    <div class="mb-3">
                                        <input type="button" value="Notif" class="btn btn-info btn-sm float-start" id="test">
                                        <input type="submit" value="Grant Key" class="btn btn-info btn-sm float-end" name="grant_key">
                                    </div>
                                </form>
                                <?php } else { ?>
                                <form action="grant-keys.php" method="POST">
                                    <div class="mb-3">
                                        <label>License Key (Automatically Generated)</label>
                                        <input type="text" class="form-control" name="license_key" value="<?php echo genLicenseKey() . '-' . genLicenseKey() . '-' . genLicenseKey() . '-' . genLicenseKey(); ?>" readonly>
                                        <small class="text-small">Be sure to copy this key to give to the customer!</small>
                                    </div>
                                    <div class="mb-3">
                                        <label>Domain</label>
                                        <input type="text" class="form-control" name="domain_name">
                                        <small class="text-small">This is the domain where the item will be hosted. It <b>must not</b> contain www. or https://. For exmaple: syntaxgg.com or auth.syntaxgg.com.</small>
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
                                    <input type="hidden" name="status" value="Valid">
                                    <div class="mb-3">
                                        <label>Issued By</label>
                                        <input type="text" class="form-control" name="issued_by" value="<?php echo $username; ?>" readonly>
                                    </div>
                                    <div class="mb-3">
                                        <input type="submit" value="Grant Key" class="btn btn-info btn-sm float-end" name="grant_key">
                                    </div>
                                </form>
                                <?php } ?>
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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
        <script src="notifications/js/lobibox.min.js"></script>
	    <script src="notifications/js/notifications.min.js"></script>
	    <script src="notifications/js/notification-custom-script.js"></script>
    </body>
</html>
