<?php include '../function_helper.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="icon" href="<?= BASE_URL ?>assets/images/favicon.ico" type="image/x-icon">
    <title>FursGo - Signup page</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/responsive.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/bootstrap.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/media_query.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/login_signup.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/common.css">

</head>

<body>

    <!-- header starts -->
    <?php include '../components/header.php' ?>
    <!-- header ends -->

    <div class="container-fluid mb-5">
        <div class="row" style="gap: 2%;">
            <div class="col-lg-6">
                <div class="login-image-form">
                    <div class="login-image-wrapper">
                        <img src="<?= BASE_URL ?>/assets/images/login-page.png" alt="">
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4">
                <div class="login-form mt-3">
                    <h1 class="heading">Sign Up to FursGo</h1>
                    <form class="mt-5">
                        <div class="form-inner d-flex flex-column align-items-center align-items-stretch">
                            <div class="form-group">
                                <label for="full_name">Full Name</label>
                                <div class="input-wrapper">
                                    <input type="full_name" id="full_name">
                                    <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" width="19" height="19"
                                        viewBox="0 0 19 19" fill="none">
                                        <path
                                            d="M9.5 0C4.275 0 0 4.275 0 9.5C0 14.725 4.275 19 9.5 19C14.725 19 19 14.725 19 9.5C19 4.275 14.725 0 9.5 0ZM7.6 14.25L2.85 9.5L4.1895 8.1605L7.6 11.5615L14.8105 4.351L16.15 5.7L7.6 14.25Z"
                                            fill="#C9DDA0" />
                                    </svg>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="email">Email Address</label>
                                <div class="input-wrapper">
                                    <input type="email" id="email" value="Bella@outlook.com">
                                    <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" width="19" height="19"
                                        viewBox="0 0 19 19" fill="none">
                                        <path
                                            d="M9.5 0C4.275 0 0 4.275 0 9.5C0 14.725 4.275 19 9.5 19C14.725 19 19 14.725 19 9.5C19 4.275 14.725 0 9.5 0ZM7.6 14.25L2.85 9.5L4.1895 8.1605L7.6 11.5615L14.8105 4.351L16.15 5.7L7.6 14.25Z"
                                            fill="#C9DDA0" />
                                    </svg>
                                </div>
                            </div>

                            <div class="form-group mb-2">
                                <label for="password">Create a Password</label>
                                <div class="input-wrapper">
                                    <input type="password" id="password" value="••••••••••••••••••••">
                                    <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" width="19" height="19"
                                        viewBox="0 0 19 19" fill="none">
                                        <path
                                            d="M9.5 0C4.275 0 0 4.275 0 9.5C0 14.725 4.275 19 9.5 19C14.725 19 19 14.725 19 9.5C19 4.275 14.725 0 9.5 0ZM7.6 14.25L2.85 9.5L4.1895 8.1605L7.6 11.5615L14.8105 4.351L16.15 5.7L7.6 14.25Z"
                                            fill="#C9DDA0" />
                                    </svg>
                                </div>

                                <div class="d-flex justify-content-between mt-3">
                                    <div class="password-rules">
                                        <p>Password requirements</p>
                                        <span>• At least 8 characters</span>
                                        <span>• Includes a capital letter</span>
                                        <span>• Includes a number or symbol</span>
                                    </div>

                                    <div class="password-status" id="passwordStatus"></div>
                                </div>
                            </div>

                            <div class="checkbox-wrapper">
                                <!-- Checkboxes -->
                                <div class="checkbox-group custom-check-group">
                                    <label class="custom-check">
                                        <input type="checkbox" id="terms">
                                        <span class="checkmark"></span>
                                        <span class="check-text">
                                            I agree to the Terms of Service and Privacy Policy.
                                        </span>
                                    </label>
                                </div>

                                <div class="checkbox-group custom-check-group">
                                    <label class="custom-check">
                                        <input type="checkbox" id="terms">
                                        <span class="checkmark"></span>
                                        <span class="check-text">
                                            Sign up to receive updates, promotions, & personalised offers
                                            from FursGo.
                                            <span style="color:#9D9B98">
                                                (You can unsubscribe at any time.)
                                            </span>
                                        </span>
                                    </label>
                                </div>
                            </div>

                            <div class="d-flex align-items-center justify-content-center mt-4">
                                <button type="submit" class="btn-custom btn-active-bg btn-custom-hover btn-shadow login-width text-center">Sign Up</button>
                            </div>

                        </div>
                    </form>
                    <div class="signup-divider"></div>
                    <div class="footer-text"> Already have a FursGo account? <a href="<?= BASE_URL ?>login-signup/login.php">Log in now</a> </div>
                </div>
            </div>
        </div>
    </div>

    <!-- footer starts -->
    <?php include '../components/footer.php' ?>
    <!-- footer starts -->

</body>

</html>