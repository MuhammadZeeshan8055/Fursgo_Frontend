<?php include '../function_helper.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="icon" href="<?= BASE_URL ?>assets/images/favicon.ico" type="image/x-icon">
    <title>FursGo - Login page</title>
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
        <div class="row g-0">

            <!-- LEFT SIDE: FLUID IMAGE -->
            <div class="col-lg-6 p-0">
                <div class="login-image-form h-100">
                    <div class="login-image-wrapper h-100">
                        <img
                            src="<?= BASE_URL ?>/assets/images/login-page.png"
                            alt="Login Image"
                            style="width: 100%; height: 100%; object-fit: cover;">
                    </div>
                </div>
            </div>

            <!-- RIGHT SIDE: CONTAINER FORM -->
            <div class="col-lg-6 d-flex align-items-center justify-content-center">

                <div class="container">
                    <div class="row justify-content-center">

                        <div class="col-lg-8">

                            <div class="login-form">
                                <h1 class="heading">Log in to Fursgo</h1>

                                <form class="mt-5">
                                    <div class="form-inner d-flex flex-column align-items-center justify-content-center">

                                        <div class="form-group mt-3">
                                            <label for="email">Email Address</label>
                                            <div class="input-wrapper">
                                                <input type="email" id="email" value="Bella@outlook.com">
                                                <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 19 19" fill="none">
                                                    <path d="M9.5 0C4.275 0 0 4.275 0 9.5C0 14.725 4.275 19 9.5 19C14.725 19 19 14.725 19 9.5C19 4.275 14.725 0 9.5 0ZM7.6 14.25L2.85 9.5L4.1895 8.1605L7.6 11.5615L14.8105 4.351L16.15 5.7L7.6 14.25Z" fill="#C9DDA0" />
                                                </svg>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <div class="input-wrapper">
                                                <input type="password" id="password" value="••••••••••••••••••••">
                                                <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 19 19" fill="none">
                                                    <path d="M9.5 0C4.275 0 0 4.275 0 9.5C0 14.725 4.275 19 9.5 19C14.725 19 19 14.725 19 9.5C19 4.275 14.725 0 9.5 0ZM7.6 14.25L2.85 9.5L4.1895 8.1605L7.6 11.5615L14.8105 4.351L16.15 5.7L7.6 14.25Z" fill="#C9DDA0" />
                                                </svg>
                                            </div>

                                            <div class="forgot-password">
                                                <a href="#">Forgot Password</a>
                                            </div>
                                        </div>

                                        <button type="submit"
                                            class="btn-custom btn-active-bg btn-custom-hover btn-shadow login-width text-center">
                                            Log in
                                        </button>
                                    </div>
                                </form>

                                <div class="divider">— Or Sign in with —</div>

                                <div class="social-login">
                                    <!-- unchanged social buttons -->
                                    <!-- keep your existing SVG buttons as-is -->
                                </div>

                                <div class="signup-text">
                                    Not signed up yet?
                                    <a href="<?= BASE_URL ?>login-signup/signup_form.php">Sign up now</a>
                                </div>

                            </div>

                        </div>

                    </div>
                </div>

            </div>

        </div>
    </div>

    <!-- footer starts -->
    <?php include '../components/footer.php' ?>
    <!-- footer starts -->

</body>

</html>