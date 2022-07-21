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
        <title>SyntaxScripts | Seller Tracker</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link rel="stylesheet" href="assets/plugins/notifications/css/lobibox.min.css" />  
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
                    <div class="card">
                        <div class="card-body">
                            <div class="text-center mb-3">
                                <b>Your Perks</b>
                            </div>
                            <?php if($level == "1") { ?>
                            <div class="mb-3">
                                As a <span class="badge bg-primary"><i class="fa-solid fa-crown"></i> Seller Level 1</span>, you have have the following perks!
                                <ul class="mt-3">
                                    <li><b>10% commission earned</b> - on all things you sell. Your commission will go into an internal account that you can withdraw once you reach a total balance of <b>$20.00</b>.</li>
                                    <li><b>Non collection of payments</b> - means when you make a sale, you must get the buyer to send the payment to the SyntaxScripts account (PayPal, BTC wallet).</li>
                                    <li><b>Level 1 discord role</b> - let customers know that you're an authorized reseller of SyntaxScripts product!</li>
                                    <li><b>Limit of 5 license key grants</b> - which means that you can only grant 5 license keys as a limit until you reach level 2.</li>
                                </ul>
                                <div class="mt-3">
                                    <p class="text-small">Please note, that as a level 1 seller, you license keys grants must go through an approval process before being activated.</p>
                                </div>
                            </div>
                            <?php } elseif($level == "2") { ?>
                            <div class="mb-3">
                                As a <span class="badge bg-danger"><i class="fa-solid fa-crown"></i> Seller Level 2</span>, you have have the following perks!
                                <ul class="mt-3">
                                    <li><b>15% commission earned</b> - on all things you sell. Your commission will go into an internal account that you can withdraw once you reach a total balance of <b>$10.00</b>.</li>
                                    <li><b>Non collection of payments</b> - means when you make a sale, you must get the buyer to send the payment to the SyntaxScripts account (PayPal, BTC wallet).</li>
                                    <li><b>Level 2 discord role</b> - let customers know that you're an authorized reseller of SyntaxScripts product!</li>
                                    <li><b>Limit of 10 license key grants</b> - which means that you can only grant 5 license keys as a limit until you reach level 3.</li>
                                </ul>
                            </div>
                            <?php } elseif($level == "3") { ?>
                            <div class="mb-3">
                                As a <span class="badge bg-info"><i class="fa-solid fa-crown"></i> Seller Level 3</span>, you have have the following perks!
                                <ul class="mt-3">
                                    <li><b>25% commission earned</b> - on all things you sell. Your commission will go into an internal account that you can withdraw once you reach a total balance of <b>$10.00</b>.</li>
                                    <li><b>Collection of payments</b> - means when you make a sale, you have the option for the buyer to send the money to your account and then you pay us (minus your commission) or get the buyer to send the payment to the SyntaxScripts account (PayPal, BTC wallet).</li>
                                    <li><b>Level 3 discord role</b> - let customers know that you're an authorized reseller of SyntaxScripts product!</li>
                                    <li><b>Unlimited license key grants</b></li>
                                </ul>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="text-center mb-3">
                                <b>Seller Tracker</b>
                                <p class="text-small">Keep in touch with your tracker and rank by using this page!</p>
                            </div>
                            <div class="mb-3 text-center">
                                You are currently <?php  if($level == "1") {
                                echo '<span class="badge bg-primary"><i class="fa-solid fa-crown"></i> Seller Level 1</span>';
                            } elseif($level == "2") {
                                echo '<span class="badge bg-danger"><i class="fa-solid fa-crown"></i> Seller Level 2</span>';
                            } elseif($level == "3") {
                                echo '<span class="badge bg-info"><i class="fa-solid fa-crown"></i> Seller Level 3</span>';
                            }  ?>
                            </div>
                            <?php if($level == "1") { ?>
                            <div class="mb-3">
                                Below is your progress bar showing how far away you are until your next level. Keep working at it and you'll unlock more features and freedom!
                            </div>
                            <div class="progress">
                                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="1" aria-valuemin="0" aria-valuemax="10" style="
                                    <?php 
                                        $saleStatus = "Approved";
                                        $getSales = mysqli_prepare($conn, "SELECT id FROM sales WHERE `by` = ? AND `status` = ?");
                                        mysqli_stmt_bind_param($getSales, "s", $username, $saleStatus);
                                        mysqli_stmt_execute($getSales);
                                        mysqli_stmt_store_result($getSales);
                                        if(mysqli_stmt_num_rows($getSales) == 0) {
                                            echo 'width: 0%';
                                        } elseif(mysqli_stmt_num_rows($getSales) == 1) {
                                            echo 'width: 20%';
                                        } elseif(mysqli_stmt_num_rows($getSales) == 2) {
                                            echo 'width: 40%';
                                        } elseif(mysqli_stmt_num_rows($getSales) == 3) {
                                            echo 'width: 60%';
                                        } elseif(mysqli_stmt_num_rows($getSales) == 4) {
                                            echo 'width: 80%';
                                        } elseif(mysqli_stmt_num_rows($getSales) == 5) {
                                            echo 'width: 100%';
                                        }
                                    ?>
                                "></div>
                            </div>
                            <?php } ?>
                            <?php if($level == "2") { ?>
                            <div class="mb-3">
                                Below is your progress bar showing how far away you are until your next level. Keep working at it and you'll unlock more features and freedom!
                            </div>
                            <div class="progress">
                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-danger" role="progressbar" aria-valuenow="1" aria-valuemin="0" aria-valuemax="10" style="
                                    <?php 
                                        $saleStatus = "Approved";
                                        $getSales = mysqli_prepare($conn, "SELECT id FROM sales WHERE `by` = ? AND `status` = ?");
                                        mysqli_stmt_bind_param($getSales, "s", $username, $saleStatus);
                                        mysqli_stmt_execute($getSales);
                                        mysqli_stmt_store_result($getSales);
                                        if(mysqli_stmt_num_rows($getSales) == 0) {
                                            echo 'width: 0%';
                                        } elseif(mysqli_stmt_num_rows($getSales) == 1) {
                                            echo 'width: 10%';
                                        } elseif(mysqli_stmt_num_rows($getSales) == 2) {
                                            echo 'width: 20%';
                                        } elseif(mysqli_stmt_num_rows($getSales) == 3) {
                                            echo 'width: 30%';
                                        } elseif(mysqli_stmt_num_rows($getSales) == 4) {
                                            echo 'width: 40%';
                                        } elseif(mysqli_stmt_num_rows($getSales) == 5) {
                                            echo 'width: 50%';
                                        } elseif(mysqli_stmt_num_rows($getSales) == 6) {
                                            echo 'width: 60%';
                                        } elseif(mysqli_stmt_num_rows($getSales) == 7) {
                                            echo 'width: 70%';
                                        } elseif(mysqli_stmt_num_rows($getSales) == 8) {
                                            echo 'width: 80%';
                                        } elseif(mysqli_stmt_num_rows($getSales) == 9) {
                                            echo 'width: 90%';
                                        } elseif(mysqli_stmt_num_rows($getSales) == 10) {
                                            echo 'width: 100%';
                                        }
                                    ?>
                                "></div>
                            </div>
                            <?php } ?>
                            <?php if($level == "3") { ?>
                                <div>
                                    <b>Nice work!</b> You've reached the max level as a seller, congratulations and thank you so much for your continuous support for SyntaxScripts!
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="card mt-3">
                        <div class="card-body">
                            <div class="text-center mb-3">
                                <b>Terms of Seller Program</b>
                                <p class="text-small">All the rules and terms of being a seller for SyntaxScripts!</p>
                            </div>
                            <div class="mt-3">
                                <ol>
                                    <li><b>Seller Account</b> - your seller account is automatically created when you fill out a seller application form and get approved for a seller account.</li>
                                    <ol>
                                        <li>Your seller account gives you access to all license keys in the SyntaxScripts database, seller accounts have the access to generate keys for new customers, as well as revoke keys where they see fit.</li>
                                        <li>Sellers are <b>not allowed</b> to share their SyntaxScripts Auth site login information. All accounts have a "last login" log that is stored automatically and if your account is logged in from a different IP address then what is known, your account will be flagged and suspended.</li>
                                    </ol>
                                    <li><b>License Keys</b> - all of our scripts come protected by domain and license keys. We do this to help stop piracy of our products, though we know it probably will only stop a few.</li>
                                    <ol>
                                        <li>The license key grant page gives you access to grant new license keys to customers, or to customers whos keys are lost or compromised.</li>
                                        <li>You are not authorized to generate a license key for someone who has not paid for our product, by doing this your seller account will be banned and your commission <b>will not</b> be paid out to you.</li>
                                        <li>Sellers get access to their own license keys, sellers can purchase a product of ours for 50-75% off of the regular price, depending on your seller level.</li>
                                        <li>If you made a mistake when granting a new license key, you must immediately revoke it and then get in touch with the developer or administration team to remove it from your license key limit (if you're a level 1 or 2 seller).</li>
                                        <li>Sellers <b>are not allowed to share</b> their personal license keys with other people, nor share the products we have. By doing this; your account will be deleted, any outstanding commission will be kept, and all your personal keys will be revoked. We don't want to do this; we want your support just as much as we want to support you. We're a team here!</li>
                                    </ol>
                                    <li><b>Payment Collections</b> - as a level 1 and level 2 seller, you cannot accept money on behalf of SyntaxScripts.</li>
                                    <ol>
                                        <li>If you make a sale as a level 1 or level 2 seller, you must direct the payments to SyntaxScripts directly, you can't collect it to your account, then send it to ours - this is a level 3 seller perk.</li>
                                        <li>If you collect money on behalf of a us as a level 1 or level 2 seller, you risk the chance of your seller account being removed as well as all the license keys you've granted + your personal keys.</li>
                                        <li>As a level 3 seller, you can collect payments on behalf of SyntaxScripts - but any funds occured must be delivered to our account within 48 hours.</li>
                                        <ul>
                                            <li>Level 3 sellers keep the commission and only send the remaining balance to us <b>after</b> their commission is counted out.</li>
                                            <li>Level 3 sellers have the option to directly collect the money and then send it to us afterward, or they also have the choice to directly send it to us and keep their wallet on our site. If you choose to collect money on our behalf, your wallet will no longer be active.</li>
                                        </ul>
                                    </ol>
                                </ol>
                            </div>  
                            <div class="mb-3">
                                <p>Please leave a thumbs up if you have read and understand these terms. Those who haven't put a thumbs up will be warned once then banned if they still haven't read these terms.</p>
                                <p class="text-small">Please note that we reserve the right to delete seller accounts and keys without warning. Accounts can be deleted for multiple reasons from breaking our terms or if sellers aren't producing results.</p>
                            </div> 
                            <div class="d-flex justify-content-between mb-3">
                                <div id="thumbsUp">

                                </div>
                                <div>
                                    <input type="hidden" name="agreeFrom" id="agreeFrom" value="<?php echo $username; ?>">
                                    <?php 
                                        $didAgree = mysqli_prepare($conn, "SELECT id FROM thumbs WHERE agree_from = ?");
                                        mysqli_stmt_bind_param($didAgree, "s", $username);
                                        mysqli_stmt_execute($didAgree);
                                        mysqli_stmt_store_result($didAgree);
                                        mysqli_stmt_fetch($didAgree);
                                        if(mysqli_stmt_num_rows($didAgree) == 1) {
                                            echo '<button class="btn btn-success btn-stm float-end" id="sellerAgree" disabled><i class="fa-solid fa-thumbs-up"></i> Thank you for your agreement!</button>';
                                        } else {
                                            echo '<button class="btn btn-success btn-stm float-end" id="sellerAgree"><i class="fa-solid fa-thumbs-up"></i> Agree</button>';
                                        }

                                        mysqli_stmt_close($didAgree);
                                    ?>
                                </div>
                            </div>  
                            <div class="text-small mb-3">
                                <b>Agreement:</b> <span id="agreement"></span>
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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
        <!--notification js -->
	    <script src="assets/plugins/notifications/js/lobibox.min.js"></script>
	    <script src="assets/plugins/notifications/js/notifications.min.js"></script>
	    <script src="assets/plugins/notifications/js/notification-custom-script.js"></script>
        <script>
            $(function(){
                setInterval(function(){
                    $('#thumbsUp').load('controllers/thumbs.php');
                },10);
                setInterval(function(){
                    $('#agreement').load('controllers/agreement.php');
                },10);

                $('#sellerAgree').click(function(){
                    $.ajax({
                        type: "POST",
                        url: "controllers/agree.php",
                        data: {
                        },
                        cache: false,
                        success: function(data) {
                            anim1_noti();
                            $('#sellerAgree').prop('disabled', true);
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr);
                        }
                    });
                })
            })
        </script>
    </body>
</html>
