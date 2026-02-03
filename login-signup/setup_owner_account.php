<?php include '../function_helper.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FursGo - Setup Owner Account</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/responsive.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/bootstrap.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/media_query.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/login_signup.css">

</head>

<body>

    <!-- header starts -->
    <?php include '../components/header.php' ?>
    <!-- header ends -->

    <div class="container mt-4 mb-5">
        <div class="row">
            <div class="col-lg-12 d-flex align-items-center justify-content-center">
                <div class="setup-page-wrapper d-flex flex-column align-items-center justify-content-center">
                    <img src="<?= BASE_URL ?>/assets/icons/setup_owner_account.svg" alt="Setup Owner Account Icon" width="151" height="100">
                    <h1 class="heading">Setup Owner Account</h1>
                    <a href="owner_account_setup_form.php" type="submit" class="btn-custom btn-active-bg text-center">Lets get started!</a>
                    <a href="" class="skip">Skip</a>
                </div>
            </div>
        </div>
    </div>

    <!-- footer starts -->
    <?php include '../components/footer.php' ?>
    <!-- footer starts -->

</body>

</html>