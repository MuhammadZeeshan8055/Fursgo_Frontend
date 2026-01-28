<?php include '../function_helper.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fursgo - Signup page</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/responsive.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/bootstrap.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/media_query.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/login_signup.css">
    <style>
        :root {
            --border: #E6E6E6;
            --error: #FF6E6E;
            --success: #C9DDA0;
        }

        .form-card {
            width: 100%;
            max-width: 420px;
            padding: 32px;
        }


        .form-field {
            margin-bottom: 40px;
        }

        label {
            display: block;
            font-size: 14px;
            margin-bottom: 6px;
        }

        .form-field .input-wrapper {
            position: relative;
            width: 100%;
        }

        input {
            width: 100%;
            padding: 14px 44px 14px 14px;
            border-radius: 10px;
            border: 1.5px solid var(--border);
            font-size: 14px;
            outline: none;
        }

        input.error {
            border-color: var(--error);
        }

        input.success {
            border-color: var(--success);
        }

        .icon {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 18px;
            display: none;
        }

        .icon.success {
            color: var(--success);
        }

        .icon.error {
            color: var(--error);
        }

        .error-text {
            color: var(--error);
            margin-top: 6px;
            display: none;
            font-family: Lato;
            font-size: 16px;
            font-style: normal;
            font-weight: 400;
            line-height: normal;
        }

        .password-rules {
            color: #9D9B98;
            font-family: Lato;
            font-size: 14px;
            font-style: normal;
            font-weight: 400;
            line-height: normal;
        }

        .password-rules p {
            color: #3B3731;
        }

        .password-rules span {
            display: block;
        }

        .password-status {
            color: #FFC97A;
            text-align: right;
            font-family: Lato;
            font-size: 14px;
            font-style: normal;
            font-weight: 500;
            line-height: normal;
        }

        input[type="checkbox"] {
            width: auto;
        }

        .checkbox-group {
            margin-top: 18px;
        }

        .checkbox-group label {
            display: flex;
            align-items: flex-start;
            justify-content: flex-start;
            gap: 8px;
            cursor: pointer;
            color: #3B3731;
            font-family: Lato;
            font-size: 14px;
            font-style: normal;
            font-weight: 400;
            line-height: normal;
            position: relative;
        }

        .checkbox-group input[type="checkbox"] {
            margin: 0;
            margin-top: 3px;
            flex-shrink: 0;
        }


        .divider {
            margin: 28px 0;
            height: 1px;
            background: #e6e6e6;
        }

        .footer-text {
            color: #3B3731;
            font-family: Lato;
            font-size: 16px;
            font-style: normal;
            font-weight: 600;
            line-height: normal;
            text-align: center;
        }

        .footer-text a {
            color: #333;
            font-weight: 700;
            line-height: normal;
            text-decoration-line: underline;
            text-decoration-style: solid;
            text-decoration-skip-ink: auto;
            text-decoration-thickness: auto;
            text-underline-offset: 4px;
            text-underline-position: from-font;
        }

        /* === Custom Checkbox === */


        .custom-check input {
            display: none;
            /* hide default checkbox */
        }

        .custom-check .checkmark {
            width: 20px;
            height: 20px;
            border-radius: 100px;
            border: 1px solid #FFD88C;
            background: #FFF;
            flex-shrink: 0;
            position: absolute;
            left: 0;
            top: 11px;
            /* remove margin-top */
        }

        .custom-check .checkmark::after {
            content: "";
            position: absolute;
            width: 13.333px;
            height: 13.333px;
            border-radius: 100px;
            background: #FFD88C;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            opacity: 0;
        }

        .custom-check input:checked+.checkmark::after {
            opacity: 1;
        }

        .check-text {
            color: #3B3731;
            font-family: Lato;
            font-size: 16px;
            font-style: normal;
            font-weight: 400;
            line-height: normal;
            margin-left: 30px;
        }
    </style>
</head>

<body>

    <!-- header starts -->
    <?php include '../components/header.php' ?>
    <!-- header ends -->

    <div class="container-fluid mt-5">
        <div class="row" style="gap: 4%;">
            <div class="col-lg-6">
                <div class="login-image-form">
                    <div class="login-image-wrapper">
                        <img src="<?= BASE_URL ?>/assets/images/login-page.png" alt="">
                    </div>
                </div>
            </div>
            <div class="col-lg-3 d-flex align-items-center">
                <div class="login-form">
                    <h1 class="heading">Sign Up to Fursgo</h1>

                    <form action="" class="mt-4">
                        <!-- Name -->
                        <div class="form-field mt-4">
                            <label>Full Name</label>
                            <div class="input-wrapper">
                                <input type="text" id="name">
                                <span class="icon success">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 19 19" fill="none">
                                        <path
                                            d="M9.5 0C4.275 0 0 4.275 0 9.5C0 14.725 4.275 19 9.5 19C14.725 19 19 14.725 19 9.5C19 4.275 14.725 0 9.5 0ZM7.6 14.25L2.85 9.5L4.1895 8.1605L7.6 11.5615L14.8105 4.351L16.15 5.7L7.6 14.25Z"
                                            fill="#C9DDA0" />
                                    </svg>
                                </span>
                                <span class="icon error">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 19 19" fill="none">
                                        <path
                                            d="M9.5 0C14.7467 0 19 4.25329 19 9.5C19 14.7467 14.7467 19 9.5 19C4.25329 19 0 14.7467 0 9.5C0 4.25329 4.25329 0 9.5 0ZM13.1973 6.22559C12.9044 5.9327 12.4296 5.9327 12.1367 6.22559L9.71094 8.65039L7.28613 6.22559C6.99324 5.93269 6.51848 5.93269 6.22559 6.22559C5.93294 6.5185 5.93277 6.99332 6.22559 7.28613L8.65039 9.71094L6.22559 12.1367C5.93295 12.4296 5.93278 12.9045 6.22559 13.1973C6.51841 13.4898 6.9933 13.4898 7.28613 13.1973L9.71094 10.7715L12.1367 13.1973C12.4296 13.4898 12.9044 13.4898 13.1973 13.1973C13.4901 12.9045 13.4899 12.4296 13.1973 12.1367L10.7715 9.71094L13.1973 7.28613C13.4901 6.99332 13.4899 6.5185 13.1973 6.22559Z"
                                            fill="#FF6E6E" />
                                    </svg>
                                </span>
                                <div class="error-text" id="nameError">Please enter your full name</div>
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="form-field mt-4">
                            <label>Email Address</label>
                            <div class="input-wrapper">
                                <input type="email" id="email">
                                <span class="icon success">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 19 19" fill="none">
                                        <path
                                            d="M9.5 0C4.275 0 0 4.275 0 9.5C0 14.725 4.275 19 9.5 19C14.725 19 19 14.725 19 9.5C19 4.275 14.725 0 9.5 0ZM7.6 14.25L2.85 9.5L4.1895 8.1605L7.6 11.5615L14.8105 4.351L16.15 5.7L7.6 14.25Z"
                                            fill="#C9DDA0" />
                                    </svg>
                                </span>
                                <span class="icon error">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 19 19" fill="none">
                                        <path
                                            d="M9.5 0C14.7467 0 19 4.25329 19 9.5C19 14.7467 14.7467 19 9.5 19C4.25329 19 0 14.7467 0 9.5C0 4.25329 4.25329 0 9.5 0ZM13.1973 6.22559C12.9044 5.9327 12.4296 5.9327 12.1367 6.22559L9.71094 8.65039L7.28613 6.22559C6.99324 5.93269 6.51848 5.93269 6.22559 6.22559C5.93294 6.5185 5.93277 6.99332 6.22559 7.28613L8.65039 9.71094L6.22559 12.1367C5.93295 12.4296 5.93278 12.9045 6.22559 13.1973C6.51841 13.4898 6.9933 13.4898 7.28613 13.1973L9.71094 10.7715L12.1367 13.1973C12.4296 13.4898 12.9044 13.4898 13.1973 13.1973C13.4901 12.9045 13.4899 12.4296 13.1973 12.1367L10.7715 9.71094L13.1973 7.28613C13.4901 6.99332 13.4899 6.5185 13.1973 6.22559Z"
                                            fill="#FF6E6E" />
                                    </svg>
                                </span>
                            </div>
                            <div class="error-text" id="emailError">
                                Please enter a valid email address
                            </div>
                        </div>

                        <!-- Password -->
                        <div class="form-field mt-4">
                            <label>Create a Password</label>
                            <div class="input-wrapper">
                                <input type="password" id="password">
                                <span class="icon success">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 19 19" fill="none">
                                        <path
                                            d="M9.5 0C4.275 0 0 4.275 0 9.5C0 14.725 4.275 19 9.5 19C14.725 19 19 14.725 19 9.5C19 4.275 14.725 0 9.5 0ZM7.6 14.25L2.85 9.5L4.1895 8.1605L7.6 11.5615L14.8105 4.351L16.15 5.7L7.6 14.25Z"
                                            fill="#C9DDA0" />
                                    </svg>
                                </span>
                                <span class="icon error">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 19 19" fill="none">
                                        <path
                                            d="M9.5 0C14.7467 0 19 4.25329 19 9.5C19 14.7467 14.7467 19 9.5 19C4.25329 19 0 14.7467 0 9.5C0 4.25329 4.25329 0 9.5 0ZM13.1973 6.22559C12.9044 5.9327 12.4296 5.9327 12.1367 6.22559L9.71094 8.65039L7.28613 6.22559C6.99324 5.93269 6.51848 5.93269 6.22559 6.22559C5.93294 6.5185 5.93277 6.99332 6.22559 7.28613L8.65039 9.71094L6.22559 12.1367C5.93295 12.4296 5.93278 12.9045 6.22559 13.1973C6.51841 13.4898 6.9933 13.4898 7.28613 13.1973L9.71094 10.7715L12.1367 13.1973C12.4296 13.4898 12.9044 13.4898 13.1973 13.1973C13.4901 12.9045 13.4899 12.4296 13.1973 12.1367L10.7715 9.71094L13.1973 7.28613C13.4901 6.99332 13.4899 6.5185 13.1973 6.22559Z"
                                            fill="#FF6E6E" />
                                    </svg>
                                </span>
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
                                    Sign up to receive updates, promotions, & personalised offers <br>
                                    from FursGo.
                                    <span style="color:#9D9B98">
                                        (You can unsubscribe at any time.)
                                    </span>
                                </span>
                            </label>
                        </div>

                        <div class="submit-button d-flex justify-content-center mt-4">
                            <button type="button" class="btn-custom login-width text-center" id="submitBtn" disabled>Sign Up</button>
                        </div>
                    </form>
                    <div class="divider"></div>
                    <div class="footer-text"> Already have a Fursgo account? <a href="#">Log in now</a> </div>

                </div>
            </div>
        </div>
    </div>


    <!-- footer starts -->
    <?php include '../components/footer.php' ?>
    <!-- footer ends -->
    <script>
        const nameInput = document.getElementById('name');
        const emailInput = document.getElementById('email');
        const passwordInput = document.getElementById('password');
        const termsCheckbox = document.getElementById('terms');
        const submitBtn = document.getElementById('submitBtn');
        const nameError = document.getElementById('nameError');
        const emailError = document.getElementById('emailError');
        const passwordStatus = document.getElementById('passwordStatus');



        // Track if fields have been interacted with
        const touched = {
            name: false,
            email: false,
            password: false
        };

        // Mark field as touched on blur (when user leaves the field)
        nameInput.addEventListener('blur', () => {
            touched.name = true;
            validateName();
            checkFormValidity();
        });

        emailInput.addEventListener('blur', () => {
            touched.email = true;
            validateEmail();
            checkFormValidity();
        });

        passwordInput.addEventListener('blur', () => {
            touched.password = true;
            validatePassword();
            checkFormValidity();
        });

        // Real-time validation on input
        nameInput.addEventListener('input', () => {
            if (touched.name) validateName();
            checkFormValidity();
        });

        emailInput.addEventListener('input', () => {
            if (touched.email) validateEmail();
            checkFormValidity();
        });

        passwordInput.addEventListener('input', () => {
            if (touched.password) validatePassword();
            checkFormValidity();
        });

        termsCheckbox.addEventListener('change', checkFormValidity);

        // Validation functions
        function validateName() {
            const value = nameInput.value.trim();
            const isValid = value.length > 0;

            if (touched.name) {
                showFieldState(nameInput, nameError, isValid);
            }

            return isValid;
        }

        function validateEmail() {
            const value = emailInput.value.trim();
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            const isValid = value.length > 0 && emailRegex.test(value);

            if (touched.email) {
                showFieldState(emailInput, emailError, isValid);
            }

            return isValid;
        }

        function validatePassword() {
            const value = passwordInput.value;
            const hasMinLength = value.length >= 8;
            const hasUpperCase = /[A-Z]/.test(value);
            const hasNumberOrSymbol = /[\d\W]/.test(value);
            const isValid = value.length > 0 && hasMinLength && hasUpperCase && hasNumberOrSymbol;

            if (touched.password) {
                showFieldState(passwordInput, null, isValid);

                // Update password status
                if (value.length === 0) {
                    passwordStatus.textContent = '';
                } else if (isValid) {
                    passwordStatus.textContent = 'Good Password';
                    passwordStatus.style.color = '#C9DDA0';
                } else {
                    passwordStatus.textContent = 'Weak Password';
                    passwordStatus.style.color = '#FFC97A';
                }
            }

            return isValid;
        }

        // Show field validation state (icons, borders, error messages)
        function showFieldState(input, errorElement, isValid) {
            const wrapper = input.closest('.input-wrapper');
            const successIcon = wrapper.querySelector('.icon.success');
            const errorIcon = wrapper.querySelector('.icon.error');

            if (isValid) {
                // Field is valid
                input.classList.remove('error');
                input.classList.add('success');
                successIcon.style.display = 'block';
                errorIcon.style.display = 'none';
                if (errorElement) errorElement.style.display = 'none';
            } else {
                // Field is invalid (empty or wrong format)
                input.classList.remove('success');
                input.classList.add('error');
                successIcon.style.display = 'none';
                errorIcon.style.display = 'block';
                if (errorElement) errorElement.style.display = 'block';
            }
        }

        // Check if entire form is valid and enable/disable submit button
        function checkFormValidity() {
            const nameValid = nameInput.value.trim().length > 0;
            const emailValue = emailInput.value.trim();
            const emailValid = emailValue.length > 0 && /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(emailValue);
            const passwordValue = passwordInput.value;
            const passwordValid = passwordValue.length >= 8 &&
                /[A-Z]/.test(passwordValue) &&
                /[\d\W]/.test(passwordValue);

            const isFormValid = nameValid && emailValid && passwordValid && termsCheckbox.checked;

            submitBtn.disabled = !isFormValid;
        }

        // Handle form submission
        submitBtn.addEventListener('click', (e) => {
            e.preventDefault();

            // Mark all fields as touched
            touched.name = true;
            touched.email = true;
            touched.password = true;

            // Validate and show errors for all fields
            const nameValid = validateName();
            const emailValid = validateEmail();
            const passwordValid = validatePassword();

            // Force show errors even if validation already ran
            showFieldState(nameInput, nameError, nameValid);
            showFieldState(emailInput, emailError, emailValid);
            showFieldState(passwordInput, null, passwordValid);

            if (nameValid && emailValid && passwordValid && termsCheckbox.checked) {
                alert('Form submitted successfully!');
                // Here you would typically submit the form data
                // form.submit() or send via AJAX
            }
        });
    </script>


</body>

</html>