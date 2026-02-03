<?php include '../function_helper.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FursGo - Signup page</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/responsive.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/bootstrap.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/media_query.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/login_signup.css">

</head>

<body>

    <!-- header starts -->
    <?php include '../components/header.php' ?>
    <!-- header ends -->

    <div class="container-fluid mt-5 mb-5">
        <div class="row"  style="gap: 4%;">
            <div class="col-lg-6">
                <div class="login-image-form">
                    <div class="login-image-wrapper">
                        <img src="<?= BASE_URL ?>/assets/images/login-page.png" alt="">
                    </div>
                </div>
            </div>
            <div class="col-lg-3 d-flex align-items-center">
                <div class="login-form mt-5">
                    <h1 class="heading">Sign Up to Fursgo</h1>

                    <div class="social-login mt-5">
                        <button class="social-btn" aria-label="Sign in with Facebook">
                            <svg viewBox="0 0 24 24" fill="#1877F2">
                                <path
                                    d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                            </svg>
                        </button>

                        <button class="social-btn" aria-label="Sign in with Google">
                            <svg viewBox="0 0 24 24">
                                <path fill="#4285F4"
                                    d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" />
                                <path fill="#34A853"
                                    d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" />
                                <path fill="#FBBC05"
                                    d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" />
                                <path fill="#EA4335"
                                    d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" />
                            </svg>
                        </button>

                        <button class="social-btn" aria-label="Sign in with LinkedIn">
                            <svg viewBox="0 0 24 24" fill="#0A66C2">
                                <path
                                    d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z" />
                            </svg>
                        </button>

                        <button class="social-btn" aria-label="Sign in with X">
                            <svg viewBox="0 0 24 24" fill="#000000">
                                <path
                                    d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z" />
                            </svg>
                        </button>

                        <button class="social-btn" aria-label="Sign in with Apple">
                            <svg viewBox="0 0 24 24" fill="#000000">
                                <path
                                    d="M17.05 20.28c-.98.95-2.05.8-3.08.35-1.09-.46-2.09-.48-3.24 0-1.44.62-2.2.44-3.06-.35C2.79 15.25 3.51 7.59 9.05 7.31c1.35.07 2.29.74 3.08.8 1.18-.24 2.31-.93 3.57-.84 1.51.12 2.65.72 3.4 1.8-3.12 1.87-2.38 5.98.48 7.13-.57 1.5-1.31 2.99-2.54 4.09l.01-.01zM12.03 7.25c-.15-2.23 1.66-4.07 3.74-4.25.29 2.58-2.34 4.5-3.74 4.25z" />
                            </svg>
                        </button>
                    </div>


                    <div class="divider">— Or Sign in with —</div>

                    <button type="submit" class="sign-up-email-btn text-center d-flex align-items-center justify-content-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="19" height="15" viewBox="0 0 19 15" fill="none">
                            <path
                                d="M1.5 0.5H17.5C18.05 0.5 18.5 0.95 18.5 1.5V13.5C18.5 14.05 18.05 14.5 17.5 14.5H1.5C0.95 14.5 0.5 14.05 0.5 13.5V1.5C0.5 0.95 0.95 0.5 1.5 0.5Z"
                                stroke="#3B3731" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M0.5 2L9.5 7.5L18.5 2" stroke="#3B3731" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                        &nbsp;
                        &nbsp;
                        Sign up with email
                    </button>

                </div>
            </div>
        </div>
    </div>


    <!-- footer starts -->
    <?php include '../components/footer.php' ?>
    <!-- footer ends -->


</body>

</html>