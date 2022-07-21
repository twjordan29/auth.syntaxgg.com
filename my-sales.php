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
                    <div class="card">
                        <div class="card-body">
                            
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
