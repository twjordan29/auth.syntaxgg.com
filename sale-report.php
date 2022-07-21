<?php 
    include('functions.php');
    
    if(!isLoggedIn()) {
        header("location: index.php");
    }

    if(isset($_POST['submitSale'])) {
        $item_sold = $_POST['item_sold'];
        $sold_to = $_POST['sold_to'];
        $by = $username;
        $status = "Pending";
        $amount = $_POST['amount'];
        $transfer = $_POST['transfer'];
        $read_terms = $_POST['read_terms'];
        $seller_level = $_POST['seller_level'];

        $insertSaleReport = mysqli_prepare($conn, "INSERT INTO sales (`item_sold`, `sold_to`, `by`, `status`, `amount`, `transfer`, `read_terms`, `seller_level`) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        mysqli_stmt_bind_param($insertSaleReport, "ssssssss", $item_sold, $sold_to, $by, $status, $amount, $transfer, $read_terms, $seller_level);
        $report = mysqli_stmt_execute($insertSaleReport);

        if($report) {
            header("location: sale-report.php?report=success");
        } else {
            header("location: sale-report.php?report=failed");
        }

        mysqli_stmt_close($insertSaleReport);
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>SyntaxScripts | Seller Sale Report</title>
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
                                <b>Important Information</b>
                            </div>
                            <div class="mb-3">
                                <ul>
                                    <li>As a seller, you are required to fill out a sale report everytime you make a sale from one of our scripts/services.</li>
                                    <li>Failing to create a sale report once you've completed a sale - we reserve the right to terminate your account with no payout of any commission.</li>
                                    <li>Your commission is automatically generated for you once you submit your sale report.</li>
                                    <li>Once your sale report has been submitted and approved, your <b><a href="seller-tracker.php">seller tracker</a></b> will automatically update with your progress!</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <?php if(isset($_GET['report']) && $_GET['report'] == "success") { ?>
                    <div class="alert alert-success shadow">
                        Great! You've submitted your sale report, we will review it!
                    </div>
                    <?php } ?>
                    <?php if(isset($_GET['report']) && $_GET['report'] == "failed") { ?>
                    <div class="alert alert-danger shadow">
                        Oh no, something happened. Please try again later!
                    </div>
                    <?php } ?>
                    <div class="card">
                        <div class="card-body">
                            <div class="text-center mb-3">
                                <b>Sale Report Form</b>
                            </div>
                            <form action="sale-report.php" method="POST">
                                <div class="mb-3">
                                    <label>Product/Item Sold</label>
                                    <input type="text" class="form-control" name="item_sold">
                                </div>
                                <div class="mb-3">
                                    <label>Sold To (Discord Username of Buyer)</label>
                                    <input type="text" class="form-control" name="sold_to">
                                </div>
                                <div class="mb-3">
                                    <label>Your Username</label>
                                    <input type="text" class="form-control" name="by" value="<?php echo $username; ?>" readonly>
                                </div>
                                <div class="mb-3">
                                    <label>Your Level</label>
                                    <input type="text" class="form-control" name="seller_level" value="<?php echo $level; ?>" readonly>
                                </div>
                                <div class="mb-3">
                                    <label>Sold For (Amount)</label>
                                    <input type="text" class="form-control" name="amount">
                                </div>
                                <div class="mb-3">
                                    <label>Did you get the buyer to pay SyntaxScripts directly?</label>
                                    <select name="transfer" class="form-select">
                                        <option value="">Please Select</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label>Have you read our terms as a seller? <b><a href="seller-tracker.php" target="_blank">Our Seller Program Terms</a></b></label>
                                    <select name="read_terms" class="form-select">
                                        <option value="">Please Select</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <input type="submit" value="Submit Sale Report" class="btn btn-info btn-sm text-white float-end" name="submitSale">
                                </div>
                            </form>
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
