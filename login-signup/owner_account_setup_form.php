<?php include '../function_helper.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fursgo - Owner Account / Pet Details</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/responsive.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/bootstrap.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/media_query.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/login_signup.css">
    <style>
        :root {
            --owner-account-inside-padding: 2% 12%;
            --bg: #fbf7f2;
            --accent: #f7b86b;
            /* orange */
            --muted: #9D9B98;
            --card-radius: 12px;
            --shadow: 0 6px 18px rgba(34, 34, 34, 0.06);
            --soft-shadow: 0 4px 10px rgba(34, 34, 34, 0.04);
        }

        .form-outer-div {
            width: 100%;
            background: #fff;
            height: auto;
            border-radius: 10px;
            position: relative;
            padding-bottom: 80px;
            /* space for buttons */
        }

        .steps-and-btn {
            position: relative;
        }

        #goBack {
            position: absolute;
            top: 15px;
        }

        .steps-buttons {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            padding: var(--owner-account-inside-padding);
        }


        .sub-heading-div {
            padding: 15px 20px;
            border-radius: 10px 10px 0 0;
            border: 1px solid #F2F2F2;
            background: #FFF;
        }

        .sub-heading {
            color: #3B3731;
            font-family: Lato;
            font-size: 16px;
            font-style: normal;
            font-weight: 600;
            line-height: normal;
        }

        .upload-card::after {
            content: "";
            border: 1px solid #F2F2F2;
            height: 280px;
            position: absolute;
            right: 0;
            bottom: -35px;
        }

        .upload-card.pet-details::after{
            right: 0;
        }



        .step {
            display: none;
            padding: var(--owner-account-inside-padding);
        }

        .step.active {
            display: block;
        }

        .upload-card {
            gap: 15px;
            position: relative;
        }

        .user-icon-size-details {
            color: #3B3731;
            text-align: center;
            font-family: Lato;
            font-size: 14px;
            font-style: normal;
            font-weight: 600;
            line-height: normal;
        }

        .upload-btn {
            display: inline-block;
            padding: 10px 22px;
            background: #FFC97A;
            border-radius: 20px;
            cursor: pointer;
            transition: background 0.2s ease;
            color: #FFF;
            text-align: center;
            font-family: Lato;
            font-size: 16px;
            font-style: normal;
            font-weight: 600;
            line-height: normal;
        }

        .upload-btn:hover {
            background: #eaa44f;
        }

        input[type="file"] {
            display: none;
        }

        .custom-select.open .select-trigger,
        .custom-select.has-value .select-trigger {
            border-color: var(--border);
        }

        .input-wrapper textarea {
            width: 100%;
            max-width: auto;
            resize: vertical;
            /* allow up/down resize only */
            padding: 14px;
            border-radius: 10px;
            border: 1px solid var(--border);
            outline: none;
            min-height: 96px;
            resize: none;
            color: var(--font-color);
            font-family: Lato;
            font-size: 16px;
            font-style: normal;
            font-weight: 400;
            line-height: normal;
        }

        textarea::placeholder,
        input::placeholder {
            color: #D4D4D4;
            font-family: Lato;
            font-size: 16px;
            font-style: normal;
            font-weight: 400;
            line-height: normal;
        }

        .icon.success {
            display: block;
        }


        /* step css  */

        .step-indicator {
            width: 100%;
            max-width: 250px;
        }

        .steps-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 12px;
        }

        .step-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            flex: 1;
            position: relative;
        }

        .step-circle {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 10px;
            position: relative;
            z-index: 2;
            color: #FDFCF8;
            text-align: center;
            font-family: Lato;
            font-size: 14px;
            font-style: normal;
            font-weight: 600;
            line-height: normal;
        }

        .step-item.active .step-circle {
            background-color: #C9DDA0;
        }

        .step-item.inactive .step-circle {
            background-color: #e8e8e8;
            color: #c0c0c0;
        }

        .step-label {
            color: #C9DDA0;
            text-align: center;
            font-family: Lato;
            font-size: 14px;
            font-style: normal;
            font-weight: 600;
            line-height: normal;
        }

        .step-item.active .step-label {
            color: #C9DDA0;
        }

        .step-item.inactive .step-label {
            color: #d0d0d0;
        }

        .progress-bar {
            width: 100%;
            height: 8px;
            background-color: #e8e8e8;
            border-radius: 4px;
            overflow: hidden;
            position: relative;
        }

        .progress-fill {
            height: 100%;
            background-color: #C9DDA0;
            border-radius: 4px;
            transition: width 0.3s ease;
        }

        /* Animation for demo purposes */
        @keyframes pulse {

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }
        }

        .step-item.active .step-circle {
            animation: pulse 2s infinite;
        }

        /* step css  */



        .custom-select .select-trigger {
            width: 100%;
        }

        .custom-wf-btn {
            border: 1px solid var(--font-color);
            background: none;
            padding: 12px 32px 12px 32px;
            text-align: center;
            font-family: Lato;
            font-size: 16px;
            font-style: normal;
            font-weight: 600;
            line-height: normal;
            cursor: pointer;
            border-radius: 25px;
        }


        /* pet list details css  */

        .select-default-label {
            background: #fff;
            border-radius: 8px;
            padding: 18px 22px;
            margin-bottom: 18px;
            border: 1px solid #f0e7dd;
            color: #3B3731;
            font-family: Lato;
            font-size: 16px;
            font-style: normal;
            font-weight: 600;
            line-height: normal;
        }

        .pet-list-section {
            display: none;
        }

        .pet-list {
            gap: 18px;
        }

        .pet-card.selected {
            border-color: rgba(247, 184, 107, 0.5);
            box-shadow: 0 6px 0 rgba(247, 184, 107, 0.12), var(--shadow);
        }

        .pet-card {
            gap: 50px;
            padding: 30px 100px;
            border-radius: 12px;
            background: #fff;
            box-shadow: var(--soft-shadow);
            position: relative;
            border: 1px solid transparent;
            cursor: pointer;
        }

        .avatar {
            flex: 0 0 88px;
            height: 88px;
            border-radius: 50%;
            overflow: hidden;
            display: inline-block;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.06);
        }

        .avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .info {
            flex: 1;
        }

        .pet-name {
            font-weight: 600;
            gap: 10px;
            color: #9D9B98;
            font-family: Lato;
            font-size: 14px;
            font-style: normal;
            font-weight: 600;
            line-height: normal;
        }

        .pet-label {
            color: #3B3731;
            font-family: Lato;
            font-size: 14px;
            font-style: normal;
            font-weight: 400;
            line-height: 2rem;
        }

        .meta {
            gap: 18px;
            margin-top: 10px;
            color: #6b6b6b;
            font-size: 14px;
        }

        .meta span {
            display: inline-flex;
            align-items: center;
            gap: 10px;
        }

        .icon-label {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: #3B3731;
            font-family: Lato;
            font-size: 14px;
            font-style: normal;
            font-weight: 400;
            line-height: normal;
        }

        .meta svg {
            width: 16px;
            height: 16px;
            opacity: 0.7;
        }

        .actions {
            gap: 12px;
            padding: 30px 0 0 0;
        }

        .btn-edit {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 18px;
            border-radius: 30px;
            border: 1px solid #e6e1db;
            background: #fff;
            cursor: pointer;
            box-shadow: var(--soft-shadow);
            color: #3B3731;
            text-align: center;
            font-family: Lato;
            font-size: 16px;
            font-style: normal;
            font-weight: 500;
            line-height: normal;
        }

        .btn-edit svg {
            width: 16px;
            height: 16px;
        }

        .btn-delete {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            display: inline-grid;
            place-items: center;
            border: 1px solid #d7d3cf;
            background: #fff;
            cursor: pointer;
        }

        .btn-delete svg {
            width: 16px;
            height: 16px;
        }

        .check {
            position: absolute;
            right: 18px;
            top: 18px;
            width: 34px;
            height: 34px;
            border-radius: 50%;
            display: grid;
            place-items: center;
        }

        .check.hidden {
            display: none
        }

        /* layout for the right actions on the card */
        .card-right {
            display: flex;
            align-items: center;
            gap: 18px
        }

        /* layout for the right actions on the card */
        .card-right {
            display: flex;
            align-items: center;
            gap: 18px
        }

        /* responsive */
        @media (max-width:720px) {
            .pet-card {
                flex-direction: column;
                align-items: flex-start;
                padding: 26px;
            }

            .card-right {
                align-self: stretch;
                width: 100%;
                justify-content: space-between
            }

            .actions {
                order: 99;
                padding: 0;
            }
        }

        .pet-card.alt {
            background: #fbf0e4;
        }

        .pet-card .check {
            opacity: 0;
            /* start hidden */
            pointer-events: none;
            /* prevent interaction while hidden */
            transition: opacity 0.3s ease-in-out;
            /* smooth transition */
        }

        .pet-card.selected .check {
            opacity: 1;
            /* show */
        }
    </style>
</head>

<body>

    <!-- header starts -->
    <?php include '../components/header.php' ?>
    <!-- header ends -->


    <div class="container mb-5">
        <div class="row">
            <div class="col-lg-12 ">

                <h1 class="heading mt-5 mb-5">Set up your Owner Account</h1>

                <div class="steps-and-btn">
                    <div class="active-inactive-div d-flex align-items-center justify-content-center">

                        <div class="step-indicator mb-5 ">
                            <div class="steps-container">
                                <div class="step-item active">
                                    <div class="step-circle">1</div>
                                    <div class="step-label">Owner Details</div>
                                </div>
                                <div class="step-item inactive">
                                    <div class="step-circle">2</div>
                                    <div class="step-label">Pet Details</div>
                                </div>
                            </div>
                            <div class="progress-bar">
                                <div class="progress-fill" style="width: 50%;"></div>
                            </div>
                        </div>
                    </div>

                    <button type="button" class="btn-custom btn-no-bg text-center" id="goBack" onclick="nextPrev(-1)">Go Back</button>

                </div>


                <div class="form-outer-div mb-5">
                    <div class="sub-heading-div">
                        <h2 class="sub-heading">Owner Details</h2>
                    </div>
                    <form id="multiForm">
                        <!-- Step 1 -->
                        <div class="step active">

                            <div class="row">
                                <div class="col-lg-5">
                                    <div class="upload-card d-flex flex-column align-items-center justify-content-center mt-5">

                                        <div class="user-icon-size-details d-flex flex-column align-items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="85" height="85" viewBox="0 0 85 85" fill="none">
                                                <circle cx="42.5" cy="42.5" r="42" fill="#E3E3E3" stroke="#F6F6F6" />
                                                <path
                                                    d="M16.4331 75.7448C18.0848 43.5072 66.8863 43.5073 68.538 75.7448C68.538 75.7448 59.009 84.8116 42.5757 84.8116C26.1424 84.8116 16.4331 75.7448 16.4331 75.7448Z"
                                                    fill="white" />
                                                <path
                                                    d="M55.5193 33.4264C55.5193 36.8812 54.1468 40.1945 51.704 42.6374C49.2611 45.0803 45.9478 46.4527 42.493 46.4527C39.0383 46.4527 35.725 45.0803 33.2821 42.6374C30.8392 40.1945 29.4668 36.8812 29.4668 33.4264C29.4668 29.9716 30.8392 26.6583 33.2821 24.2154C35.725 21.7725 39.0383 20.4001 42.493 20.4001C45.9478 20.4001 49.2611 21.7725 51.704 24.2154C54.1468 26.6583 55.5193 29.9716 55.5193 33.4264Z"
                                                    fill="white" />
                                                <path
                                                    d="M73.993 20.1799C68.9349 20.1799 64.8203 16.0653 64.8203 11.0072C64.8203 5.94913 68.9349 1.83453 73.993 1.83453C79.051 1.83453 83.1656 5.94913 83.1656 11.0072C83.1656 16.0653 79.051 20.1799 73.993 20.1799Z"
                                                    fill="#9D9B98" />
                                                <path
                                                    d="M73.9931 15.5935C73.6262 15.5935 73.3379 15.3052 73.3379 14.9383V7.07603C73.3379 6.70912 73.6262 6.42084 73.9931 6.42084C74.36 6.42084 74.6483 6.70912 74.6483 7.07603V14.9383C74.6483 15.3052 74.36 15.5935 73.9931 15.5935Z"
                                                    fill="white" />
                                                <path
                                                    d="M77.9237 11.6624H70.0614C69.6945 11.6624 69.4062 11.3741 69.4062 11.0072C69.4062 10.6403 69.6945 10.352 70.0614 10.352H77.9237C78.2906 10.352 78.5789 10.6403 78.5789 11.0072C78.5789 11.3741 78.2906 11.6624 77.9237 11.6624Z"
                                                    fill="white" />
                                            </svg>
                                            <div class="title mt-3">
                                                Upload Image
                                            </div>
                                            <div class="subtitle">Max file size: 1 MB</div>
                                        </div>


                                        <label class="upload-btn">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                                                <path d="M7 10.3162C6.72386 10.3162 6.5 10.0923 6.5 9.8162V1.6662L4.52903 3.63716C4.33115 3.83504 4.00998 3.83392 3.81349 3.63465C3.61896 3.43738 3.62005 3.1201 3.81593 2.92416L6.55492 0.184403C6.80072 -0.0614672 7.19931 -0.0614954 7.44514 0.184341L10.185 2.92419C10.3809 3.12014 10.3822 3.43747 10.1877 3.63493C9.99116 3.83455 9.66959 3.83579 9.47149 3.63769L7.5 1.6662V9.8162C7.5 10.0923 7.27614 10.3162 7 10.3162ZM1.616 13.7392C1.15533 13.7392 0.771 13.5852 0.463 13.2772C0.155 12.9692 0.000666667 12.5845 0 12.1232V10.2002C0 9.92405 0.223858 9.7002 0.5 9.7002C0.776142 9.7002 1 9.92406 1 10.2002V12.1232C1 12.2772 1.064 12.4185 1.192 12.5472C1.32 12.6759 1.461 12.7399 1.615 12.7392H12.385C12.5383 12.7392 12.6793 12.6752 12.808 12.5472C12.9367 12.4192 13.0007 12.2779 13 12.1232V10.2002C13 9.92405 13.2239 9.7002 13.5 9.7002C13.7761 9.7002 14 9.92406 14 10.2002V12.1232C14 12.5839 13.846 12.9682 13.538 13.2762C13.23 13.5842 12.8453 13.7385 12.384 13.7392H1.616Z" fill="white" />
                                            </svg>
                                            &nbsp;
                                            Upload Photo
                                            <input type="file" name="owner_profile_image" accept="image/*">
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-1"></div>
                                <div class="col-lg-6">
                                    <!-- Name -->
                                    <div class="form-field mt-4">
                                        <label>Full Name</label>
                                        <div class="input-wrapper">
                                            <input type="text" id="owner_name" placeholder="Enter your full name">
                                        </div>
                                    </div>
                                    <!-- Email Address -->
                                    <div class="form-field mt-4">
                                        <label>Email Address</label>
                                        <div class="input-wrapper">
                                            <input type="text" id="name" value="Bella@outlook.com">
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
                                    </div>
                                    <!-- Phone Number -->
                                    <div class="form-field mt-4">
                                        <label>Phone Number</label>
                                        <div class="input-wrapper">
                                            <input type="text" id="name" placeholder="+44">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <!-- Address Line 1 -->
                                    <div class="form-field mt-4">
                                        <label>Address Line 1</label>
                                        <div class="input-wrapper">
                                            <input type="text" id="name" placeholder="Enter your address">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <!-- Address Line 2 -->
                                    <div class="form-field mt-4">
                                        <label>Address Line 2</label>
                                        <div class="input-wrapper">
                                            <input type="text" id="name" placeholder="Optional">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <!-- City -->
                                    <div class="form-field mt-4">
                                        <label>City</label>
                                        <div class="input-wrapper">
                                            <input type="text" id="name" value="London">
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
                                    </div>
                                    <!-- Preferred City / Area -->
                                    <div class="form-field mt-4">
                                        <label>Preferred City / Area</label>
                                        <div class="input-wrapper">
                                            <input type="text" id="name" placeholder="Where do you usually book grooming?">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <!-- Postcode -->
                                    <div class="form-field mt-4">
                                        <label>Postcode</label>
                                        <div class="input-wrapper">
                                            <input type="text" id="name" value="SW3 4JP">
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
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-field mt-4">
                                        <label>Bio</label>
                                        <div class="input-wrapper">
                                            <textarea
                                                id="bio"
                                                name="bio"
                                                rows="3"
                                                placeholder="Tell us a bit about you and your pets…"></textarea>
                                        </div>
                                    </div>
                                </div>

                            </div>



                        </div>

                        <!-- Step 2 -->
                        <div class="step">
                            <div class="row">
                                <div class="col-lg-5">
                                    <div class="upload-card pet-details d-flex flex-column align-items-center justify-content-center mt-5">

                                        <div class="user-icon-size-details d-flex flex-column align-items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="85" height="85" viewBox="0 0 85 85" fill="none">
                                                <circle cx="42.5" cy="42.5" r="42" fill="#E3E3E3" stroke="#F6F6F6" />
                                                <path
                                                    d="M16.4331 75.7448C18.0848 43.5072 66.8863 43.5073 68.538 75.7448C68.538 75.7448 59.009 84.8116 42.5757 84.8116C26.1424 84.8116 16.4331 75.7448 16.4331 75.7448Z"
                                                    fill="white" />
                                                <path
                                                    d="M55.5193 33.4264C55.5193 36.8812 54.1468 40.1945 51.704 42.6374C49.2611 45.0803 45.9478 46.4527 42.493 46.4527C39.0383 46.4527 35.725 45.0803 33.2821 42.6374C30.8392 40.1945 29.4668 36.8812 29.4668 33.4264C29.4668 29.9716 30.8392 26.6583 33.2821 24.2154C35.725 21.7725 39.0383 20.4001 42.493 20.4001C45.9478 20.4001 49.2611 21.7725 51.704 24.2154C54.1468 26.6583 55.5193 29.9716 55.5193 33.4264Z"
                                                    fill="white" />
                                                <path
                                                    d="M73.993 20.1799C68.9349 20.1799 64.8203 16.0653 64.8203 11.0072C64.8203 5.94913 68.9349 1.83453 73.993 1.83453C79.051 1.83453 83.1656 5.94913 83.1656 11.0072C83.1656 16.0653 79.051 20.1799 73.993 20.1799Z"
                                                    fill="#9D9B98" />
                                                <path
                                                    d="M73.9931 15.5935C73.6262 15.5935 73.3379 15.3052 73.3379 14.9383V7.07603C73.3379 6.70912 73.6262 6.42084 73.9931 6.42084C74.36 6.42084 74.6483 6.70912 74.6483 7.07603V14.9383C74.6483 15.3052 74.36 15.5935 73.9931 15.5935Z"
                                                    fill="white" />
                                                <path
                                                    d="M77.9237 11.6624H70.0614C69.6945 11.6624 69.4062 11.3741 69.4062 11.0072C69.4062 10.6403 69.6945 10.352 70.0614 10.352H77.9237C78.2906 10.352 78.5789 10.6403 78.5789 11.0072C78.5789 11.3741 78.2906 11.6624 77.9237 11.6624Z"
                                                    fill="white" />
                                            </svg>
                                            <div class="title mt-3">
                                                Upload Image
                                            </div>
                                            <div class="subtitle">Max file size: 1 MB</div>
                                        </div>


                                        <label class="upload-btn">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                                                <path d="M7 10.3162C6.72386 10.3162 6.5 10.0923 6.5 9.8162V1.6662L4.52903 3.63716C4.33115 3.83504 4.00998 3.83392 3.81349 3.63465C3.61896 3.43738 3.62005 3.1201 3.81593 2.92416L6.55492 0.184403C6.80072 -0.0614672 7.19931 -0.0614954 7.44514 0.184341L10.185 2.92419C10.3809 3.12014 10.3822 3.43747 10.1877 3.63493C9.99116 3.83455 9.66959 3.83579 9.47149 3.63769L7.5 1.6662V9.8162C7.5 10.0923 7.27614 10.3162 7 10.3162ZM1.616 13.7392C1.15533 13.7392 0.771 13.5852 0.463 13.2772C0.155 12.9692 0.000666667 12.5845 0 12.1232V10.2002C0 9.92405 0.223858 9.7002 0.5 9.7002C0.776142 9.7002 1 9.92406 1 10.2002V12.1232C1 12.2772 1.064 12.4185 1.192 12.5472C1.32 12.6759 1.461 12.7399 1.615 12.7392H12.385C12.5383 12.7392 12.6793 12.6752 12.808 12.5472C12.9367 12.4192 13.0007 12.2779 13 12.1232V10.2002C13 9.92405 13.2239 9.7002 13.5 9.7002C13.7761 9.7002 14 9.92406 14 10.2002V12.1232C14 12.5839 13.846 12.9682 13.538 13.2762C13.23 13.5842 12.8453 13.7385 12.384 13.7392H1.616Z" fill="white" />
                                            </svg>
                                            &nbsp;
                                            Upload Photo
                                            <input type="file" name="pet_profile_image" accept="image/*">
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-2"></div>
                                <div class="col-lg-5 mt-lg-4">
                                    <div class="pet-type-wrapper mt-4">
                                        <p class="label">Select Pet Type</p>

                                        <div class="pet-toggle">
                                            <button type="button" class="pet-option" data-pet="cat">
                                                <span>Cat</span>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="23"
                                                    viewBox="0 0 16 23" fill="none">
                                                    <path
                                                        d="M7.06607 3.58301C7.8265 3.48922 8.87941 3.51287 9.88638 3.85352C10.9998 4.23021 12.076 5.00399 12.6022 6.43945L14.7711 7.47949L14.818 7.64941C15.1058 8.68692 15.2774 10.2987 14.8317 11.7656C14.6072 12.5047 14.2229 13.2153 13.611 13.791C12.9973 14.3682 12.1722 14.7931 11.0944 14.9854C7.21594 15.6769 5.01487 18.9931 4.40787 20.5596C4.16903 21.2436 3.62369 22.8966 3.62369 23C-3.55897 11.9396 1.57217 3.05801 5.0358 0L7.06607 3.58301ZM9.46841 7.20898C8.89932 7.20905 8.29568 7.49145 8.29556 8.62109C8.29556 9.40123 9.29039 8.62109 9.93814 8.62109C10.5855 8.6214 10.6413 9.40108 10.6413 8.62109C10.6411 7.84111 10.1161 7.20898 9.46841 7.20898Z" />
                                                </svg>
                                            </button>

                                            <button type="button" class="pet-option" data-pet="dog">
                                                <span>Dog</span>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="21"
                                                    viewBox="0 0 22 21" fill="none">
                                                    <path
                                                        d="M11.4592 0C12.0763 -1.81872e-05 12.6594 0.284475 13.0383 0.771484L16.2531 4.90625C16.4122 5.1107 16.6451 5.24555 16.9016 5.28223L19.9856 5.72266C20.3435 5.77379 20.646 6.01307 20.759 6.35645C21.0768 7.32331 21.6368 9.33324 21.2541 10.5C20.7993 11.8862 20.0695 12.5798 18.7541 12.9189C16.5012 13.4996 14.6389 12.8358 12.4377 14.5137C11.758 15.0318 11.2942 15.7094 10.9895 16.4668C9.95231 19.0452 6.72483 21.7058 4.32932 20.2969L1.40646 18.5781L2.88596 12.9932C3.03734 12.9827 3.18545 12.9709 3.32639 12.9531C3.72903 12.9023 4.11589 12.815 4.36935 12.6543C4.5727 12.5253 4.78067 12.3019 4.97775 12.0498C5.17867 11.7928 5.3839 11.4855 5.57834 11.168C5.96741 10.5326 6.32411 9.84071 6.53439 9.39648C6.59333 9.27178 6.53985 9.1226 6.41525 9.06348C6.29076 9.00482 6.14244 9.05746 6.08322 9.18164C5.87884 9.61345 5.53038 10.2892 5.15256 10.9062C4.96359 11.2149 4.76927 11.5055 4.5842 11.7422C4.39523 11.9839 4.23009 12.1511 4.10178 12.2324C3.94892 12.3293 3.65905 12.4071 3.26389 12.457C2.87952 12.5055 2.43081 12.5234 1.98947 12.5225C1.58423 12.5216 1.18935 12.5013 0.862518 12.4795C0.852878 12.4768 0.842809 12.4744 0.833221 12.4717C0.259699 12.3089 -0.117574 11.6851 0.0334167 11.1084C1.50838 5.48346 2.34844 2.92212 3.76584 1.50488C5.26577 0.00544894 8.2594 1.93192e-05 8.28146 0H11.4592ZM11.8508 5.01758C11.2139 5.01758 10.5383 5.33425 10.5383 6.59863C10.5386 7.47085 11.6506 6.59869 12.3752 6.59863C13.0999 6.59863 13.1623 7.47088 13.1623 6.59863C13.1623 5.72593 12.5754 5.01786 11.8508 5.01758Z" />
                                                </svg>
                                            </button>

                                            <button type="button" class="pet-option highlight" data-pet="other">
                                                <span>Other</span>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="16"
                                                    viewBox="0 0 20 16" fill="none">
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M6.42074 0C5.71446 0 5.16085 0.437285 4.81841 0.961736C4.47169 1.49055 4.28049 2.18061 4.28049 2.90555C4.28049 3.63048 4.47169 4.32055 4.81841 4.84936C5.16085 5.37236 5.71446 5.8111 6.42074 5.8111C7.12702 5.8111 7.68063 5.37381 8.02307 4.84936C8.36979 4.32055 8.56099 3.63048 8.56099 2.90555C8.56099 2.18061 8.36979 1.49055 8.02307 0.961736C7.68063 0.438738 7.12702 0 6.42074 0ZM13.5549 0C12.8486 0 12.295 0.437285 11.9526 0.961736C11.6058 1.49055 11.4147 2.18061 11.4147 2.90555C11.4147 3.63048 11.6058 4.32055 11.9526 4.84936C12.295 5.37236 12.8486 5.8111 13.5549 5.8111C14.2612 5.8111 14.8148 5.37381 15.1572 4.84936C15.504 4.32055 15.6951 3.63048 15.6951 2.90555C15.6951 2.18061 15.504 1.49055 15.1572 0.961736C14.8148 0.438738 14.2612 0 13.5549 0ZM2.14025 6.53748C1.43397 6.53748 0.880355 6.97477 0.537915 7.49922C0.191195 8.02803 0 8.7181 0 9.44303C0 10.168 0.191195 10.858 0.537915 11.3868C0.880355 11.9098 1.43397 12.3486 2.14025 12.3486C2.84653 12.3486 3.40014 11.9113 3.74258 11.3868C4.0893 10.858 4.28049 10.168 4.28049 9.44303C4.28049 8.7181 4.0893 8.02803 3.74258 7.49922C3.40014 6.97622 2.84653 6.53748 2.14025 6.53748ZM9.98782 6.53748C8.27562 6.53748 7.00717 7.47307 6.19673 8.63383C5.39628 9.77717 4.99391 11.1965 4.99391 12.3486C4.99391 13.6909 5.7858 14.6251 6.75747 15.1844C7.71345 15.7364 8.91199 15.9805 9.98782 15.9805C11.0637 15.9805 12.2622 15.7379 13.2182 15.1844C14.1884 14.6236 14.9817 13.6909 14.9817 12.3486C14.9817 11.1965 14.5794 9.77717 13.7789 8.63383C12.9699 7.47162 11.7014 6.53748 9.98782 6.53748ZM17.8354 6.53748C17.1291 6.53748 16.5755 6.97477 16.2331 7.49922C15.8863 8.02803 15.6951 8.7181 15.6951 9.44303C15.6951 10.168 15.8863 10.858 16.2331 11.3868C16.5755 11.9098 17.1291 12.3486 17.8354 12.3486C18.5417 12.3486 19.0953 11.9113 19.4377 11.3868C19.7844 10.858 19.9756 10.168 19.9756 9.44303C19.9756 8.7181 19.7844 8.02803 19.4377 7.49922C19.0953 6.97622 18.5417 6.53748 17.8354 6.53748Z" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="pet-weight-wrapper mt-4">
                                        <p class="label">Select Pet Size</p>

                                        <div class="weight-toggle">
                                            <button type="button" class="weight-option" data-weight="small">
                                                <span>Small 0–7 kg</span>
                                            </button>

                                            <button type="button" class="weight-option medium"
                                                data-weight="medium">
                                                <span>Medium 8–18 kg</span>
                                            </button>

                                            <button type="button" class="weight-option large active"
                                                data-weight="large">
                                                <span>Large 19+ kg</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 mt-lg-5">
                                    <!-- Name -->
                                    <div class="form-field mt-4">
                                        <label>Name</label>
                                        <div class="input-wrapper">
                                            <input type="text" id="pet_name" value="Bella" placeholder="Enter your full name">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 mt-lg-5">
                                    <!-- Birth -->
                                    <div class="form-field mt-4">
                                        <label>Birthday</label>
                                        <div class="input-wrapper">
                                            <input type="date" id="Birth">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-5 mt-lg-5">
                                    <!-- Pet Type -->
                                    <div class="form-field mt-4">
                                        <label>Pet Type</label>
                                        <div class="input-wrapper">
                                            <input type="text" id="pet_type" placeholder="e.g. Rabbit, Guinea Pig ...">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-field mt-4">
                                        <label>Breed(s)</label>
                                        <div class="custom-select has-value">
                                            <div class="select-trigger">
                                                <span class="selected-text">Labrador</span>
                                                <svg width="16" height="16" viewBox="0 0 24 24">
                                                    <path d="M6 9l6 6 6-6" fill="none" stroke="#666"
                                                        stroke-width="2" />
                                                </svg>
                                            </div>

                                            <ul class="select-options">
                                                <li data-value="labrador">Labrador</li>
                                                <li data-value="mini-lop">Mini Lop</li>
                                            </ul>

                                            <input type="hidden" name="serviceType" value="labrador">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <!-- Pet Type -->
                                    <div class="form-field mt-4">
                                        <label>Sex</label>
                                        <div class="radio-container">
                                            <div class="radio-item">
                                                <input type="radio" name="gender" value="male" id="male">
                                                <span class="custom-radio"></span>
                                                <span class="radio-text">Male</span>
                                            </div>

                                            <div class="radio-item">
                                                <input type="radio" name="gender" value="female" id="female">
                                                <span class="custom-radio"></span>
                                                <span class="radio-text">Female</span>
                                            </div>
                                        </div>

                                        <style>
                                            .radio-container {
                                                display: flex;
                                                gap: 24px;
                                                align-items: center;
                                            }

                                            .radio-item {
                                                display: flex;
                                                align-items: center;
                                                gap: 10px;
                                                cursor: pointer;
                                                position: relative;
                                                margin-top: 12px;
                                            }

                                            /* Hide native radio */
                                            .radio-item input {
                                                position: absolute;
                                                opacity: 0;
                                                pointer-events: none;
                                            }

                                            /* Custom outer circle */
                                            .custom-radio {
                                                width: 24px;
                                                height: 24px;
                                                border: 3px solid #EAE8E5;
                                                border-radius: 50%;
                                                display: inline-block;
                                                position: relative;
                                            }

                                            /* Inner filled circle */
                                            .radio-item input:checked+.custom-radio::after {
                                                content: '';
                                                width: 12px;
                                                height: 12px;
                                                background: #EAE8E5;
                                                border-radius: 50%;
                                                position: absolute;
                                                top: 50%;
                                                left: 50%;
                                                transform: translate(-50%, -50%);
                                            }

                                            /* Text styling */
                                            .radio-text {
                                                color: #9D9B98;
                                                font-family: Lato;
                                                font-size: 16px;
                                                font-weight: 400;
                                            }


                                            /* Remove native arrows */
                                            input[type=number]::-webkit-inner-spin-button,
                                            input[type=number]::-webkit-outer-spin-button {
                                                -webkit-appearance: none;
                                                margin: 0;
                                            }



                                            .weight-field {
                                                width: 140px;
                                                font-family: Arial, sans-serif;
                                            }

                                            .weight-field label {
                                                display: block;
                                                font-size: 14px;
                                                color: #555;
                                                margin-bottom: 6px;
                                            }

                                            .number-wrapper {
                                                position: relative;
                                            }

                                            .number-wrapper input {
                                                width: 100%;
                                                height: 44px;
                                                padding: 0 34px 0 12px;
                                                font-size: 16px;
                                                border: 1.5px solid #e5e5e5;
                                                border-radius: 10px;
                                                outline: none;
                                            }

                                            .custom-arrows {
                                                position: absolute;
                                                right: 10px;
                                                top: 50%;
                                                transform: translateY(-50%);
                                                display: flex;
                                                flex-direction: column;
                                                gap: 5px;
                                            }

                                            .custom-arrows button {
                                                background: none;
                                                border: none;
                                                padding: 2px;
                                                cursor: pointer;
                                                line-height: 1;
                                            }

                                            .custom-arrows button:hover svg path {
                                                stroke: #000;
                                            }
                                        </style>


                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <!-- Weight -->
                                    <div class="form-field mt-4">
                                        <label>Weight (kg)</label>
                                        <div class="input-wrapper" style="width: 30%;">
                                            <input type="number" value="4" min="0" id="weightInput">

                                            <div class="custom-arrows">
                                                <button type="button" onclick="changeValue(1)">
                                                    <!-- UP -->
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="11" height="14" viewBox="0 0 11 14" fill="none">
                                                        <path d="M10.374 13.4788L5.3952 8.49994L0.499963 13.3952"
                                                            stroke="#3B3731" stroke-linecap="round" stroke-linejoin="round" />
                                                    </svg>
                                                </button>

                                                <button type="button" onclick="changeValue(-1)">
                                                    <!-- DOWN -->
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="11" height="14" viewBox="0 0 11 14" fill="none">
                                                        <path d="M10.374 0.499941L5.3952 5.47876L0.499963 0.615181"
                                                            stroke="#3B3731" stroke-linecap="round" stroke-linejoin="round" />
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-5">
                                    <div class="form-field mt-4">
                                        <label>Vaccination status</label>
                                        <div class="radio-container">
                                            <div class="radio-item">
                                                <input type="radio" name="vac_status" value="yes" id="yes">
                                                <span class="custom-radio"></span>
                                                <span class="radio-text">Yes</span>
                                            </div>

                                            <div class="radio-item">
                                                <input type="radio" name="vac_status" value="no" id="no">
                                                <span class="custom-radio"></span>
                                                <span class="radio-text">No</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-field mt-4">
                                        <label>Medical Notes</label>
                                        <div class="input-wrapper">
                                            <textarea
                                                id="bio"
                                                name="bio"
                                                rows="3"
                                                placeholder="Help us keep your pets healthy and safe!
(e.g allergies, sensitivities, medications, or ongoing treatments).
                                                "></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-field mt-4">
                                        <label>Personality & behaviour</label>
                                        <div class="input-wrapper">
                                            <textarea
                                                id="bio"
                                                name="bio"
                                                rows="3"
                                                placeholder="Any behaviour we should know about?
(e.g. Friendly with people, nervous around loud noises, doesn’t like paws touched).
                                                "></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-field mt-4">
                                        <label>Grooming preferences</label>
                                        <div class="input-wrapper">
                                            <textarea
                                                id="bio"
                                                name="bio"
                                                rows="3"
                                                placeholder="Any style preferences? 
(e.g clip length, shampoo type, sensitive areas).
                                                "></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <!-- Preferred groomer service -->
                                    <div class="form-field mt-4">
                                        <label>Preferred groomer service</label>
                                        <div class="input-wrapper d-flex align-items-center" style="gap:20px">
                                            <button type="button" class="btn-custom btn-groomer-bg">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="10" viewBox="0 0 14 10" fill="none">
                                                    <path d="M13.6793 0.289386C13.5867 0.197689 13.4765 0.124907 13.3551 0.0752394C13.2337 0.0255714 13.1035 0 12.972 0C12.8405 0 12.7103 0.0255714 12.5889 0.0752394C12.4675 0.124907 12.3574 0.197689 12.2647 0.289386L4.84329 7.58766L1.72529 4.51573C1.62913 4.42451 1.51563 4.35279 1.39125 4.30465C1.26688 4.25652 1.13406 4.23291 1.0004 4.23518C0.86673 4.23745 0.734828 4.26555 0.612221 4.31789C0.489614 4.37022 0.378704 4.44576 0.285823 4.54019C0.192942 4.63462 0.119909 4.74609 0.0708932 4.86824C0.0218778 4.99039 -0.00216024 5.12082 0.000152332 5.25209C0.0024649 5.38336 0.0310826 5.5129 0.0843711 5.63331C0.13766 5.75372 0.214575 5.86265 0.310727 5.95386L4.13601 9.71062C4.22862 9.80231 4.3388 9.87509 4.46019 9.92476C4.58158 9.97443 4.71179 10 4.84329 10C4.9748 10 5.105 9.97443 5.22639 9.92476C5.34779 9.87509 5.45796 9.80231 5.55057 9.71062L13.6793 1.72752C13.7804 1.63591 13.8611 1.52472 13.9163 1.40096C13.9715 1.2772 14 1.14356 14 1.00845C14 0.873344 13.9715 0.7397 13.9163 0.615943C13.8611 0.492186 13.7804 0.380998 13.6793 0.289386Z" fill="white" />
                                                </svg>
                                                Mobile Groomer
                                            </button>
                                            <button type="button" class="btn-custom btn-groomer-bg">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="10" viewBox="0 0 14 10" fill="none">
                                                    <path d="M13.6793 0.289386C13.5867 0.197689 13.4765 0.124907 13.3551 0.0752394C13.2337 0.0255714 13.1035 0 12.972 0C12.8405 0 12.7103 0.0255714 12.5889 0.0752394C12.4675 0.124907 12.3574 0.197689 12.2647 0.289386L4.84329 7.58766L1.72529 4.51573C1.62913 4.42451 1.51563 4.35279 1.39125 4.30465C1.26688 4.25652 1.13406 4.23291 1.0004 4.23518C0.86673 4.23745 0.734828 4.26555 0.612221 4.31789C0.489614 4.37022 0.378704 4.44576 0.285823 4.54019C0.192942 4.63462 0.119909 4.74609 0.0708932 4.86824C0.0218778 4.99039 -0.00216024 5.12082 0.000152332 5.25209C0.0024649 5.38336 0.0310826 5.5129 0.0843711 5.63331C0.13766 5.75372 0.214575 5.86265 0.310727 5.95386L4.13601 9.71062C4.22862 9.80231 4.3388 9.87509 4.46019 9.92476C4.58158 9.97443 4.71179 10 4.84329 10C4.9748 10 5.105 9.97443 5.22639 9.92476C5.34779 9.87509 5.45796 9.80231 5.55057 9.71062L13.6793 1.72752C13.7804 1.63591 13.8611 1.52472 13.9163 1.40096C13.9715 1.2772 14 1.14356 14 1.00845C14 0.873344 13.9715 0.7397 13.9163 0.615943C13.8611 0.492186 13.7804 0.380998 13.6793 0.289386Z" fill="white" />
                                                </svg>
                                                At-home Groomer
                                            </button>
                                            <button type="button" class="btn-custom btn-no-bg">
                                                Salon Groomer
                                            </button>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>


                    </form>



                    <div class="row">
                        <div class="col-lg-12">
                            <div class="steps-buttons mt-5" id="buttonsContainer">
                                <button type="button" class="btn-custom btn-no-bg text-center" id="prevBtn" onclick="nextPrev(-1)">Cancel</button>
                                <button type="button" class="btn-custom btn-active-bg text-center" id="nextBtn" onclick="nextPrev(1)">Next</button>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- pet list details -->


                <div class="pet-list-section mb-5">
                    <div class="select-default-label mt-4">Select Default Pet <small style="color:#9D9B98">(optional)</small></div>

                    <div class="pet-list d-flex flex-column">
                        <!-- Selected card -->
                        <div class="pet-card selected d-flex align-items-center">
                            <div class="avatar"><img src="<?= BASE_URL ?>/assets/images/pet_details_1.png" alt="pet"></div>
                            <div class="info">
                                <div class="topline">
                                    <div class="pet-name d-flex align-items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="15" viewBox="0 0 16 15" fill="none">
                                            <path d="M8 6.02632C5.73786 6.02632 3.82643 8.06405 3.20929 10.6813C2.93786 11.8323 3.34714 13.0539 4.35179 13.6279C5.14821 14.0829 6.33286 14.5 8 14.5C9.66714 14.5 10.8521 14.0829 11.6486 13.6279C12.6532 13.0539 13.0621 11.8323 12.7907 10.6813C12.1736 8.06368 10.2621 6.02632 8 6.02632ZM0.5 5.45305C0.5 6.47063 1.13929 7.5 1.92857 7.5C2.71786 7.5 3.35714 6.47063 3.35714 5.45305C3.35714 4.43547 2.71786 3.81579 1.92857 3.81579C1.13929 3.81579 0.5 4.43584 0.5 5.45305ZM15.5 5.45305C15.5 6.47063 14.8607 7.5 14.0714 7.5C13.2821 7.5 12.6429 6.47063 12.6429 5.45305C12.6429 4.43547 13.2821 3.81579 14.0714 3.81579C14.8607 3.81579 15.5 4.43584 15.5 5.45305ZM4.25 2.13726C4.25 3.15484 4.88929 4.18421 5.67857 4.18421C6.46786 4.18421 7.10714 3.15484 7.10714 2.13726C7.10714 1.11968 6.46786 0.5 5.67857 0.5C4.88929 0.5 4.25 1.12005 4.25 2.13726ZM11.75 2.13726C11.75 3.15484 11.1107 4.18421 10.3214 4.18421C9.53214 4.18421 8.89286 3.15484 8.89286 2.13726C8.89286 1.11968 9.53214 0.5 10.3214 0.5C11.1107 0.5 11.75 1.12005 11.75 2.13726Z" stroke="#9D9B98" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        Bella
                                    </div>
                                    <div class="pet-label">Rabbit • Mini Lop</div>
                                </div>
                                <div class="meta d-flex align-items-center flex-wrap">
                                    <span class="icon-label">
                                        <svg viewBox="0 0 200 300" xmlns="http://www.w3.org/2000/svg">
                                            <!-- Circle -->
                                            <circle cx="100" cy="80" r="60" fill="none" stroke="#808080" stroke-width="12" />

                                            <!-- Vertical line -->
                                            <line x1="100" y1="140" x2="100" y2="240" stroke="#808080" stroke-width="12" />

                                            <!-- Horizontal line -->
                                            <line x1="60" y1="200" x2="140" y2="200" stroke="#808080" stroke-width="12" />
                                        </svg>
                                        Female
                                    </span>
                                    <span class="icon-label">
                                        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="none" stroke="#666666" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                            <!-- Candle flame -->
                                            <path d="M12 3c0 1.5-1 2-1 3.5 0 1 .5 1.5 1 1.5s1-.5 1-1.5c0-1.5-1-2-1-3.5z" />

                                            <!-- Cake top layer -->
                                            <rect x="4" y="11" width="16" height="4" rx="1" />

                                            <!-- Cake bottom layer -->
                                            <path d="M4 15c0 0 1 3 3 3h10c2 0 3-3 3-3" />

                                            <!-- Frosting waves -->
                                            <path d="M6 11c.5-1 1.5-1 2-1s1.5 0 2 1 1.5 1 2 1 1.5 0 2-1 1.5-1 2-1 1.5 0 2 1" />
                                        </svg>
                                        22/08/2020
                                    </span>
                                    <span class="icon-label">
                                        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="none" stroke="#666666" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                            <!-- Bag body -->
                                            <path d="M6 6h12l1 13H5L6 6z" />

                                            <!-- Bag handles -->
                                            <path d="M9 6V5c0-1.7 1.3-3 3-3s3 1.3 3 3v1" />
                                        </svg>
                                        5 kg
                                    </span>
                                    <span class="icon-label">
                                        <svg viewBox="0 0 100 120" xmlns="http://www.w3.org/2000/svg">
                                            <!-- Outer tilted rectangle -->
                                            <rect x="20" y="15" width="50" height="70" rx="8"
                                                fill="none" stroke="#808080" stroke-width="5"
                                                transform="rotate(15 45 50)" />

                                            <!-- Inner tilted rectangle -->
                                            <rect x="32" y="25" width="50" height="70" rx="8"
                                                fill="none" stroke="#808080" stroke-width="5"
                                                transform="rotate(15 57 60)" />

                                            <!-- Text lines on front document -->
                                            <line x1="48" y1="45" x2="68" y2="50"
                                                stroke="#808080" stroke-width="3" stroke-linecap="round"
                                                transform="rotate(15 58 47.5)" />

                                            <line x1="48" y1="55" x2="68" y2="60"
                                                stroke="#808080" stroke-width="3" stroke-linecap="round"
                                                transform="rotate(15 58 57.5)" />

                                            <line x1="48" y1="65" x2="63" y2="69"
                                                stroke="#808080" stroke-width="3" stroke-linecap="round"
                                                transform="rotate(15 55.5 67)" />
                                        </svg>
                                        <span class="note">Nervous around hair-dryers.</span>
                                    </span>
                                </div>
                            </div>
                            <div class="card-right">
                                <div class="actions d-flex align-items-center">
                                    <button class="btn-edit">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="15" viewBox="0 0 16 15" fill="none">
                                            <path d="M10.2059 2.37997L12.8529 4.97712M8.44118 14.5H15.5M1.38235 11.0371L0.5 14.5L4.02941 13.6343L14.2524 3.60409C14.5832 3.2794 14.769 2.83908 14.769 2.37997C14.769 1.92085 14.5832 1.48054 14.2524 1.15584L14.1006 1.00694C13.7697 0.682347 13.3209 0.5 12.8529 0.5C12.385 0.5 11.9362 0.682347 11.6053 1.00694L1.38235 11.0371Z" stroke="#3B3731" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        Edit
                                    </button>
                                    <button class="btn-delete" aria-label="Delete">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="18" viewBox="0 0 16 18" fill="none">
                                            <path d="M3 18C2.45 18 1.97934 17.8043 1.588 17.413C1.19667 17.0217 1.00067 16.5507 1 16V3C0.71667 3 0.479337 2.904 0.288004 2.712C0.0966702 2.52 0.000670115 2.28267 3.44827e-06 2C-0.000663218 1.71733 0.0953369 1.48 0.288004 1.288C0.48067 1.096 0.718003 1 1 1H5C5 0.716667 5.096 0.479333 5.288 0.288C5.48 0.0966668 5.71734 0.000666667 6 0H10C10.2833 0 10.521 0.0960001 10.713 0.288C10.905 0.48 11.0007 0.717333 11 1H15C15.2833 1 15.521 1.096 15.713 1.288C15.905 1.48 16.0007 1.71733 16 2C15.9993 2.28267 15.9033 2.52033 15.712 2.713C15.5207 2.90567 15.2833 3.00133 15 3V16C15 16.55 14.8043 17.021 14.413 17.413C14.0217 17.805 13.5507 18.0007 13 18H3ZM6 14C6.28334 14 6.521 13.904 6.713 13.712C6.905 13.52 7.00067 13.2827 7 13V6C7 5.71667 6.904 5.47933 6.712 5.288C6.52 5.09667 6.28267 5.00067 6 5C5.71734 4.99933 5.48 5.09533 5.288 5.288C5.096 5.48067 5 5.718 5 6V13C5 13.2833 5.096 13.521 5.288 13.713C5.48 13.905 5.71734 14.0007 6 14ZM10 14C10.2833 14 10.521 13.904 10.713 13.712C10.905 13.52 11.0007 13.2827 11 13V6C11 5.71667 10.904 5.47933 10.712 5.288C10.52 5.09667 10.2827 5.00067 10 5C9.71734 4.99933 9.48 5.09533 9.288 5.288C9.096 5.48067 9 5.718 9 6V13C9 13.2833 9.096 13.521 9.288 13.713C9.48 13.905 9.71734 14.0007 10 14Z" fill="#3B3731" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <div class="check" title="Selected">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path d="M12 0C5.4 0 0 5.4 0 12C0 18.6 5.4 24 12 24C18.6 24 24 18.6 24 12C24 5.4 18.6 0 12 0ZM9.6 18L3.6 12L5.292 10.308L9.6 14.604L18.708 5.496L20.4 7.2L9.6 18Z" fill="#B5CA89" />
                                </svg>
                            </div>
                        </div>
                        <!-- alt card -->
                        <div class="pet-card alt d-flex align-items-center">
                            <div class="avatar"><img src="<?= BASE_URL ?>/assets/images/pet_details_2.png" alt="pet"></div>
                            <div class="info">
                                <div class="topline">
                                    <div class="pet-name d-flex align-items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="15" viewBox="0 0 16 15" fill="none">
                                            <path d="M8 6.02632C5.73786 6.02632 3.82643 8.06405 3.20929 10.6813C2.93786 11.8323 3.34714 13.0539 4.35179 13.6279C5.14821 14.0829 6.33286 14.5 8 14.5C9.66714 14.5 10.8521 14.0829 11.6486 13.6279C12.6532 13.0539 13.0621 11.8323 12.7907 10.6813C12.1736 8.06368 10.2621 6.02632 8 6.02632ZM0.5 5.45305C0.5 6.47063 1.13929 7.5 1.92857 7.5C2.71786 7.5 3.35714 6.47063 3.35714 5.45305C3.35714 4.43547 2.71786 3.81579 1.92857 3.81579C1.13929 3.81579 0.5 4.43584 0.5 5.45305ZM15.5 5.45305C15.5 6.47063 14.8607 7.5 14.0714 7.5C13.2821 7.5 12.6429 6.47063 12.6429 5.45305C12.6429 4.43547 13.2821 3.81579 14.0714 3.81579C14.8607 3.81579 15.5 4.43584 15.5 5.45305ZM4.25 2.13726C4.25 3.15484 4.88929 4.18421 5.67857 4.18421C6.46786 4.18421 7.10714 3.15484 7.10714 2.13726C7.10714 1.11968 6.46786 0.5 5.67857 0.5C4.88929 0.5 4.25 1.12005 4.25 2.13726ZM11.75 2.13726C11.75 3.15484 11.1107 4.18421 10.3214 4.18421C9.53214 4.18421 8.89286 3.15484 8.89286 2.13726C8.89286 1.11968 9.53214 0.5 10.3214 0.5C11.1107 0.5 11.75 1.12005 11.75 2.13726Z" stroke="#9D9B98" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        Louis
                                    </div>
                                    <div class="pet-label">Dog • Labrador</div>
                                </div>
                                <div class="meta d-flex align-items-center flex-wrap">
                                    <span class="icon-label">
                                        <svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                                            <!-- Circle -->
                                            <circle cx="80" cy="120" r="50" fill="none" stroke="#808080" stroke-width="10" />

                                            <!-- Diagonal arrow line -->
                                            <line x1="120" y1="80" x2="170" y2="30" stroke="#808080" stroke-width="10" />

                                            <!-- Arrow head - horizontal part -->
                                            <line x1="170" y1="30" x2="145" y2="30" stroke="#808080" stroke-width="10" />

                                            <!-- Arrow head - vertical part -->
                                            <line x1="170" y1="30" x2="170" y2="55" stroke="#808080" stroke-width="10" />
                                        </svg>
                                        Male
                                    </span>
                                    <span class="icon-label">
                                        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="none" stroke="#666666" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                            <!-- Candle flame -->
                                            <path d="M12 3c0 1.5-1 2-1 3.5 0 1 .5 1.5 1 1.5s1-.5 1-1.5c0-1.5-1-2-1-3.5z" />

                                            <!-- Cake top layer -->
                                            <rect x="4" y="11" width="16" height="4" rx="1" />

                                            <!-- Cake bottom layer -->
                                            <path d="M4 15c0 0 1 3 3 3h10c2 0 3-3 3-3" />

                                            <!-- Frosting waves -->
                                            <path d="M6 11c.5-1 1.5-1 2-1s1.5 0 2 1 1.5 1 2 1 1.5 0 2-1 1.5-1 2-1 1.5 0 2 1" />
                                        </svg>
                                        22/08/2020
                                    </span>
                                    <span class="icon-label">
                                        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="none" stroke="#666666" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                            <!-- Bag body -->
                                            <path d="M6 6h12l1 13H5L6 6z" />

                                            <!-- Bag handles -->
                                            <path d="M9 6V5c0-1.7 1.3-3 3-3s3 1.3 3 3v1" />
                                        </svg>
                                        40 kg
                                    </span>
                                    <span class="icon-label">
                                        <svg viewBox="0 0 100 120" xmlns="http://www.w3.org/2000/svg">
                                            <!-- Outer tilted rectangle -->
                                            <rect x="20" y="15" width="50" height="70" rx="8"
                                                fill="none" stroke="#808080" stroke-width="5"
                                                transform="rotate(15 45 50)" />

                                            <!-- Inner tilted rectangle -->
                                            <rect x="32" y="25" width="50" height="70" rx="8"
                                                fill="none" stroke="#808080" stroke-width="5"
                                                transform="rotate(15 57 60)" />

                                            <!-- Text lines on front document -->
                                            <line x1="48" y1="45" x2="68" y2="50"
                                                stroke="#808080" stroke-width="3" stroke-linecap="round"
                                                transform="rotate(15 58 47.5)" />

                                            <line x1="48" y1="55" x2="68" y2="60"
                                                stroke="#808080" stroke-width="3" stroke-linecap="round"
                                                transform="rotate(15 58 57.5)" />

                                            <line x1="48" y1="65" x2="63" y2="69"
                                                stroke="#808080" stroke-width="3" stroke-linecap="round"
                                                transform="rotate(15 55.5 67)" />
                                        </svg>
                                        <span class="note">Allergic to dust.</span>
                                    </span>
                                </div>
                            </div>
                            <div class="card-right">
                                <div class="actions d-flex align-items-center">
                                    <button class="btn-edit">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="15" viewBox="0 0 16 15" fill="none">
                                            <path d="M10.2059 2.37997L12.8529 4.97712M8.44118 14.5H15.5M1.38235 11.0371L0.5 14.5L4.02941 13.6343L14.2524 3.60409C14.5832 3.2794 14.769 2.83908 14.769 2.37997C14.769 1.92085 14.5832 1.48054 14.2524 1.15584L14.1006 1.00694C13.7697 0.682347 13.3209 0.5 12.8529 0.5C12.385 0.5 11.9362 0.682347 11.6053 1.00694L1.38235 11.0371Z" stroke="#3B3731" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        Edit
                                    </button>
                                    <button class="btn-delete" aria-label="Delete">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="18" viewBox="0 0 16 18" fill="none">
                                            <path d="M3 18C2.45 18 1.97934 17.8043 1.588 17.413C1.19667 17.0217 1.00067 16.5507 1 16V3C0.71667 3 0.479337 2.904 0.288004 2.712C0.0966702 2.52 0.000670115 2.28267 3.44827e-06 2C-0.000663218 1.71733 0.0953369 1.48 0.288004 1.288C0.48067 1.096 0.718003 1 1 1H5C5 0.716667 5.096 0.479333 5.288 0.288C5.48 0.0966668 5.71734 0.000666667 6 0H10C10.2833 0 10.521 0.0960001 10.713 0.288C10.905 0.48 11.0007 0.717333 11 1H15C15.2833 1 15.521 1.096 15.713 1.288C15.905 1.48 16.0007 1.71733 16 2C15.9993 2.28267 15.9033 2.52033 15.712 2.713C15.5207 2.90567 15.2833 3.00133 15 3V16C15 16.55 14.8043 17.021 14.413 17.413C14.0217 17.805 13.5507 18.0007 13 18H3ZM6 14C6.28334 14 6.521 13.904 6.713 13.712C6.905 13.52 7.00067 13.2827 7 13V6C7 5.71667 6.904 5.47933 6.712 5.288C6.52 5.09667 6.28267 5.00067 6 5C5.71734 4.99933 5.48 5.09533 5.288 5.288C5.096 5.48067 5 5.718 5 6V13C5 13.2833 5.096 13.521 5.288 13.713C5.48 13.905 5.71734 14.0007 6 14ZM10 14C10.2833 14 10.521 13.904 10.713 13.712C10.905 13.52 11.0007 13.2827 11 13V6C11 5.71667 10.904 5.47933 10.712 5.288C10.52 5.09667 10.2827 5.00067 10 5C9.71734 4.99933 9.48 5.09533 9.288 5.288C9.096 5.48067 9 5.718 9 6V13C9 13.2833 9.096 13.521 9.288 13.713C9.48 13.905 9.71734 14.0007 10 14Z" fill="#3B3731" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <div class="check" title="Selected">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path d="M12 0C5.4 0 0 5.4 0 12C0 18.6 5.4 24 12 24C18.6 24 24 18.6 24 12C24 5.4 18.6 0 12 0ZM9.6 18L3.6 12L5.292 10.308L9.6 14.604L18.708 5.496L20.4 7.2L9.6 18Z" fill="#B5CA89" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="pet-list-action-buttons d-flex justify-content-between mt-5">
                        <button class="btn-custom btn-no-bg mt-5" id="add-pet">+ Add a Pet</button>
                        <a href="setup_owner_account_complete.php" class="btn-custom btn-active-bg mt-5">Complete</a>
                    </div>

                </div>

            </div>
        </div>
    </div>


    <!-- footer starts -->
    <?php include '../components/footer.php' ?>
    <!-- footer starts -->

    <script>
        // custom select dropdown js  

        document.querySelectorAll('.custom-select').forEach(select => {
            const trigger = select.querySelector('.select-trigger');
            const options = select.querySelectorAll('.select-options li');
            const datePopovers = document.querySelectorAll('.popover');
            const text = select.querySelector('.selected-text');
            const hiddenInput = select.querySelector('input[type="hidden"]');

            trigger.addEventListener('click', e => {
                e.stopPropagation();

                datePopovers.forEach(popover => {
                    popover.style.display = 'none';
                });

                document.querySelectorAll('.custom-select').forEach(s => {
                    if (s !== select) {
                        s.classList.remove('open');
                        const t = s.querySelector('.select-trigger');
                        t.style.cssText = `
                    border-bottom-left-radius: 12px;
                    border-bottom-right-radius: 12px;
                `;
                    }
                });

                const isOpen = select.classList.toggle('open');

                trigger.style.cssText = isOpen ?
                    `border-bottom-left-radius: 0; border-bottom-right-radius: 0;` :
                    `border-bottom-left-radius: 12px; border-bottom-right-radius: 12px;`;
            });

            options.forEach(option => {
                option.addEventListener('click', () => {
                    text.textContent = option.textContent;
                    hiddenInput.value = option.dataset.value;

                    select.classList.remove('open');
                    select.classList.add('has-value'); // add class to highlight border

                    trigger.style.cssText = `
                border-bottom-left-radius: 12px;
                border-bottom-right-radius: 12px;
            `;
                });
            });
        });

        const pet_options = document.querySelectorAll('.pet-option');
        const weight_options = document.querySelectorAll('.weight-option');

        toggleActive(pet_options, 'highlight');
        toggleActive(weight_options, 'active');

        function toggleActive(items, activeClass) {
            items.forEach(item => {
                item.addEventListener('click', () => {
                    items.forEach(i => i.classList.remove(activeClass));
                    item.classList.add(activeClass);
                });
            });
        }


        let currentStep = 0;
        const steps = document.querySelectorAll(".step");
        const stepItems = document.querySelectorAll(".step-item");
        const progressFill = document.querySelector(".progress-fill");

        showStep(currentStep);

        function showStep(n) {
            // Show step content
            steps.forEach(step => step.classList.remove("active"));
            steps[n].classList.add("active");

            // Update step indicators (RESET → APPLY)
            stepItems.forEach((item, index) => {
                item.classList.remove("active", "inactive");

                if (index <= n) {
                    // current + all previous steps
                    item.classList.add("active");
                } else {
                    // future steps
                    item.classList.add("inactive");
                }
            });


            // Update progress bar
            const progressPercent = ((n + 1) / stepItems.length) * 100;
            progressFill.style.width = progressPercent + "%";

            // Buttons
            const goBack = document.getElementById("goBack");
            const prevBtn = document.getElementById("prevBtn");
            const nextBtn = document.getElementById("nextBtn");
            const buttonsContainer = document.getElementById("buttonsContainer");
            const sub_heading = document.querySelector(".sub-heading");
            const activeLabels = document.querySelectorAll(".step-item.active .step-label");
            const activeLabelElement = activeLabels[activeLabels.length - 1];

            if (activeLabelElement) {
                sub_heading.innerHTML = activeLabelElement.innerHTML;
            }

            // Show/hide Prev button
            prevBtn.style.display = n === 0 ? "none" : "inline";
            goBack.style.display = n === 0 ? "none" : "inline";

            // Update Next button text
            nextBtn.innerHTML = n === steps.length - 1 ? "Save & Continue" : "Next";

            // Update container justify-content
            if (n === 0) {
                // Only Next button → right
                buttonsContainer.style.justifyContent = "flex-end";
            } else {
                // Both buttons → spread apart
                buttonsContainer.style.justifyContent = "space-between";
            }
        }


        const petListSection = document.querySelector(".pet-list-section");
        const formOuterDiv = document.querySelector(".form-outer-div");

        function nextPrev(n) {
            // Guard: step might not exist (pet list view)
            if (!steps[currentStep]) return;

            // Optional validation
            const input = steps[currentStep].querySelector("input, textarea");
            if (n === 1 && input && !input.checkValidity()) {
                input.reportValidity();
                return;
            }

            currentStep += n;

            if (currentStep >= steps.length) {
                formOuterDiv.style.display = "none";
                petListSection.style.display = "block";
                petListSection.classList.add("active");
                return;
            }

            showStep(currentStep);
        }


        function changeValue(step) {
            const input = document.getElementById('weightInput');
            const current = parseInt(input.value) || 0;
            const min = input.min ? parseInt(input.min) : -Infinity;
            const newValue = current + step;

            if (newValue >= min) {
                input.value = newValue;
            }
        }


        const goBackBtn = document.getElementById("goBack");
        const addPetBtn = document.getElementById("add-pet");

        function handleBackNavigation() {
            // Pet list → go back to last form step
            if (petListSection.classList.contains("active")) {
                petListSection.classList.remove("active");
                petListSection.style.display = "none";

                formOuterDiv.style.display = "block";

                currentStep = steps.length - 1;
                showStep(currentStep);
                return;
            }

            // Normal form back behavior
            if (currentStep > 0) {
                currentStep--;
                showStep(currentStep);
            }
        }

        // Bind once, reuse everywhere
        goBackBtn.addEventListener("click", handleBackNavigation);
        addPetBtn.addEventListener("click", handleBackNavigation);


        // Radio item click to select
        document.querySelectorAll('.radio-item').forEach(item => {
            item.addEventListener('click', () => {
                item.querySelector('input').checked = true;
            });
        });


        const petCards = document.querySelectorAll('.pet-card');

        petCards.forEach(card => {
            card.addEventListener('click', () => {
                petCards.forEach(c => {
                    c.classList.remove('selected');
                    c.classList.add('alt');
                });

                card.classList.remove('alt');
                card.classList.add('selected');
            });
        });
    </script>



</body>

</html>