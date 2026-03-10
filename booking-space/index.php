<!-- Booking Space -->

<?php include '../function_helper.php';
include_once __DIR__ . '/../components/birthday-calendar.php';
$imagePath = BASE_URL . '/assets/images/booking-space-card-image.svg';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FursGo - Booking</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/responsive.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/bootstrap.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/media_query.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/common.css">
    <style>
        body {
            background: #FDFCF8;
        }

        /* ── STEPPER ── */
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
        }

        .step-label {
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

        .step-one h1 {
            color: #3B3731;
            font-family: "Playfair Display";
            font-size: 28px;
            font-style: normal;
            font-weight: 800;
            line-height: normal;
        }

        .card {
            margin-top: 2rem;
            border-radius: 10px;
            background: #F8F8F8;
            padding: 30px;
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .card>div {
            display: flex;
            justify-content: space-between;
        }


        .card>div>.card-img {
            display: flex;
            align-items: end;
            gap: 1.5rem;
            position: relative;
        }

        .card>div>.card-img>svg>image {
            width: 100%;
            height: 100%;
        }

        .card>div>.card-img>.svg-icon {
            position: absolute;
            left: 3px;
            top: 3px;
        }

        .card-img>:nth-child(3) p {
            display: flex;
            gap: 5px;
            color: #3B3731;
            font-family: Lato;
            font-size: 14px;
            font-style: normal;
            font-weight: 600;
            line-height: normal;
        }

        .card-img-content p>span {
            color: #9D9B98;
            font-family: Lato;
            font-size: 14px;
            font-style: normal;
            font-weight: 400;
            line-height: normal;
        }

        .card-img-content>div:nth-child(1) {
            margin-bottom: 2rem;
        }

        .card-img-content>div:nth-child(2)>p {
            color: #FFF;
            text-align: center;
            font-family: Lato;
            font-size: 14px;
            font-style: normal;
            font-weight: 500;
            line-height: normal;
            width: 107px;
            height: 24px;
            border-radius: 100px;
            background: #FFA899;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .ratings {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .ratings>div {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.8rem;
        }

        .ratings>div>div {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
        }

        .ratings>div:first-child>div:nth-child(1) {
            width: 82px;
            height: 24px;
            border-radius: 100px;
            background: #CBDCE8;
            color: #FFF;
            font-family: Lato;
            font-size: 14px;
            font-style: normal;
            font-weight: 500;
            line-height: normal;
        }

        .ratings>div:first-child>div:nth-child(2) {
            width: 93px;
            height: 24px;
            color: #FFF;
            font-family: Lato;
            font-size: 14px;
            font-style: normal;
            font-weight: 500;
            line-height: normal;
            border-radius: 100px;
            background: #FFA899;
        }

        .ratings>div:last-child>div>p {
            color: #3B3731;
            font-family: Lato;
            font-size: 14px;
            font-style: normal;
            font-weight: 500;
            line-height: normal;
        }

        .ratings>div:last-child>div>span {
            color: #9D9B98;
            font-family: Lato;
            font-size: 14px;
            font-style: normal;
            font-weight: 500;
            line-height: normal;
        }

        .card-booking-info>div:first-child {
            display: flex;
            gap: 3.5rem;
            justify-content: start;
            align-items: center;
        }

        .card-booking-info>div:first-child>div>span {
            display: flex;
            gap: 0.5rem;
            justify-content: start;
            align-items: center;
            color: #9D9B98;
            font-family: Lato;
            font-size: 14px;
            font-style: normal;
            font-weight: 600;
            line-height: normal;
        }

        .card-booking-info>div:first-child>div>p {
            color: #3B3731;
            font-family: Lato;
            font-size: 14px;
            font-style: normal;
            font-weight: 400;
            line-height: normal;
        }



        .card-booking-info>div:last-child>button {
            background: transparent;
            border: none;
            width: 67px;
            height: 32px;
            border-radius: 100px;
            background: #EAE8E5;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            color: #3B3731;
            text-align: center;
            font-family: Lato;
            font-size: 14px;
            font-style: normal;
            font-weight: 500;
            line-height: normal;
        }

        .information {
            margin-top: 2rem;
        }

        .information>h2 {
            color: #3B3731;
            font-family: "Playfair Display";
            font-size: 28px;
            font-style: normal;
            font-weight: 800;
            line-height: normal;
        }

        .information>.btns {
            display: flex;
            gap: 1rem;
            justify-content: center;
            align-items: center;
            margin-top: 1rem;
        }

        .information>.btns>button:nth-child(1) {
            background: transparent;
            border: none;
            border-radius: 75px;
            background: #FFC97A;
            width: 400px;
            height: 48px;
            color: #FFF;
            text-align: center;
            font-family: Lato;
            font-size: 18px;
            font-style: normal;
            font-weight: 700;
            line-height: normal;
            cursor: pointer;
        }

        .information>.btns>button:nth-child(2) {
            border-radius: 75px;
            border: 1px solid #3B3731;
            background: #FFF;
            width: 400px;
            height: 48px;
            color: #3B3731;
            text-align: center;
            font-family: Lato;
            font-size: 18px;
            font-style: normal;
            font-weight: 600;
            line-height: normal;
            cursor: pointer;
        }

        /* ── ADD-ONS ── */
        .add-ons {
            margin-top: 3rem;
            margin-bottom: 2rem;
        }

        .add-ons-title {
            color: #3B3731;
            font-family: "Playfair Display";
            font-size: 28px;
            font-style: normal;
            font-weight: 800;
            line-height: normal;
            margin-bottom: 1.5rem;
        }

        .add-ons-list {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
        }

        .add-on-card {
            position: relative;
            cursor: pointer;
            flex: 1;
            min-width: 200px;
            border-radius: 8px;
            background: #F8F8F8;
            padding: 25px 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            border: 1px solid transparent;
            transition: all 0.3s ease;
        }

        .add-on-checkbox {
            display: none;
        }

        .add-on-card.active {
            background: #FFF;
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.03);
            border: 1px solid #EAE8E5;
        }

        .add-on-content {
            display: flex;
            align-items: baseline;
            gap: 15px;
            width: 100%;
            justify-content: center;
        }

        .add-on-name {
            color: #3B3731;
            font-family: Lato;
            font-size: 18px;
            font-style: normal;
            font-weight: 500;
            line-height: normal;
        }

        .add-on-price-container {
            display: flex;
            align-items: baseline;
            gap: 4px;
        }

        .add-on-price {
            color: #3B3731;
            text-align: right;
            font-family: Lato;
            font-size: 20px;
            font-style: normal;
            font-weight: 600;
            line-height: 25px;
            /* 125% */
            text-decoration-line: underline;
            text-decoration-style: solid;
            text-decoration-skip-ink: auto;
            text-decoration-thickness: auto;
            text-underline-offset: auto;
            text-underline-position: from-font;
        }

        .add-on-unit {
            color: #9D9B98;
            font-family: Lato;
            font-size: 14px;
            font-style: normal;
            font-weight: 600;
            line-height: 25px;
        }

        .checkmark-icon {
            position: absolute;
            top: 10px;
            right: 10px;
            display: none;
            align-items: center;
            justify-content: center;
        }

        .add-on-card.active .checkmark-icon {
            display: flex;
        }

        .add-ons-actions {
            margin-top: 2.5rem;
            display: flex;
            justify-content: flex-end;
        }

        .continue-action-btn {
            background-color: #C9DDA0;
            color: #FFF;
            border: none;
            border-radius: 75px;
            width: 400px;
            height: 48px;
            text-align: center;
            font-family: Lato;
            font-size: 18px;
            font-style: normal;
            font-weight: 700;
            line-height: normal;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: opacity 0.3s;
        }

        .continue-action-btn:hover {
            opacity: 0.9;
        }


        /* ── Pet List Container ── */
        .pet-list {
            display: none;
            flex-direction: column;
            gap: 14px;
            margin-top: 1.5rem;
            animation: petListFadeIn 0.25s ease;
        }

        .pet-list.visible {
            display: flex;
        }

        @keyframes petListFadeIn {
            from {
                opacity: 0;
                transform: translateY(8px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* ── Pet Card ── */
        .pet-card {
            background: #F8F8F8;
            border-radius: 14px;
            padding: 18px 22px;
            display: flex;
            align-items: center;
            gap: 18px;
            cursor: pointer;
            border: 2px solid transparent;
            transition: border-color 0.2s, background 0.2s, box-shadow 0.2s;
        }

        .pet-card:hover {
            background: #fff;
            box-shadow: 0 4px 14px rgba(59, 55, 49, 0.06);
        }

        .pet-card.selected {
            border-color: #C9DDA0;
            background: #fff;
            box-shadow: 0 4px 14px rgba(201, 221, 160, 0.18);
        }

        /* ── Radio Dot ── */
        .pet-radio {
            width: 22px;
            height: 22px;
            border-radius: 50%;
            border: 2px solid #D0CEC9;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: border-color 0.2s, background 0.2s;
        }

        .pet-card.selected .pet-radio {
            border-color: #FFC97A;
            background: #FFC97A;
        }

        .pet-radio-inner {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #fff;
            opacity: 0;
            transition: opacity 0.2s;
        }

        .pet-card.selected .pet-radio-inner {
            opacity: 1;
        }

        /* ── Avatar ── */
        .pet-avatar {
            width: 64px;
            height: 64px;
            border-radius: 50%;
            overflow: hidden;
            flex-shrink: 0;
            background: #EAE8E5;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 26px;
        }

        .pet-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* ── Info Grid ── */
        .pet-info-grid {
            flex: 1;
            display: flex;
            align-items: center;
            gap: 28px;
            flex-wrap: wrap;
        }

        .pet-info-primary .pet-name {
            color: #3B3731;
            font-family: Lato, sans-serif;
            font-size: 15px;
            font-weight: 700;
            margin: 0 0 3px;
        }

        .pet-info-primary .pet-breed {
            color: #9D9B98;
            font-family: Lato, sans-serif;
            font-size: 13px;
            font-weight: 400;
            margin: 0;
        }

        .pet-field {
            display: flex;
            flex-direction: column;
            gap: 2px;
            min-width: 80px;
        }

        .pet-field-label {
            display: flex;
            align-items: center;
            gap: 4px;
            color: #9D9B98;
            font-family: Lato, sans-serif;
            font-size: 12px;
            font-weight: 600;
        }

        .pet-field-value {
            color: #3B3731;
            font-family: Lato, sans-serif;
            font-size: 13px;
            font-weight: 400;
            margin: 0;
        }

        .pet-field.notes .pet-field-value {
            max-width: 200px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        /* ── Edit Button ── */
        .pet-edit-btn {
            background: #EAE8E5;
            border: none;
            border-radius: 100px;
            padding: 7px 20px;
            color: #3B3731;
            font-family: Lato, sans-serif;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            white-space: nowrap;
            flex-shrink: 0;
            transition: background 0.2s;
        }

        .pet-edit-btn:hover {
            background: #d6d3cf;
        }

        /* ── Confirm Row ── */
        .pet-list-actions {
            display: flex;
            justify-content: flex-end;
            margin-top: 8px;
            gap: 2rem;
        }

        .pet-save-btn {
            width: 120px;
            height: 48px;
            border-radius: 96px;
            border: 1px solid #FFC97A;
            background: #FFF;
            box-shadow: 0 5px 8px 0 rgba(0, 0, 0, 0.05);

            color: #FFC97A;
            text-align: center;
            font-family: Lato;
            font-size: 16px;
            font-style: normal;
            font-weight: 600;
            line-height: normal;
            transition: opacity 0.2s;
        }

        .pet-save-btn:disabled {
            opacity: 0.4;
            cursor: not-allowed;
        }

        .pet-save-btn:not(:disabled):hover {
            opacity: 0.88;
        }

        pet-save-btn:not(:disabled):hover {
            opacity: 0.88;
        }

        .pet-cancel-btn {
            color: #3B3731;
            text-align: center;
            font-family: Lato;
            font-size: 16px;
            font-style: normal;
            font-weight: 600;
            line-height: normal;
            text-decoration-line: underline;
            text-decoration-style: solid;
            text-decoration-skip-ink: auto;
            text-decoration-thickness: auto;
            text-underline-offset: auto;
            text-underline-position: from-font;
            background: transparent;
            border: none;
        }
    </style>
</head>

<body>
    <?php include '../components/header.php'; ?>

    <!-- STEPPER -->
    <section class="container">
        <div class="d-flex align-items-end justify-content-between">
            <!-- Back button -->
            <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 2rem;">
                <button
                    style="display: flex; align-items: center; gap: 8px; background: transparent; border: none; cursor: pointer; font-family: Lato; font-size: 16px; font-weight: 600; color: #3B3731; text-decoration: underline;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48" fill="none">
                        <rect width="48" height="48" rx="24" transform="matrix(-1 0 0 1 48 0)" fill="#EAE8E5" />
                        <path
                            d="M15.2902 23.1723C14.8946 23.5641 14.8952 24.2036 15.2915 24.5947L19.8487 29.0918C20.204 29.4424 20.7767 29.4378 21.1263 29.0815C21.2649 28.9448 21.3203 28.8081 21.2926 28.6714C21.2579 28.5347 21.1818 28.4049 21.064 28.2819L18.0826 25.3603C17.9164 25.1963 17.7606 25.0493 17.6152 24.9195C17.5 24.8167 17.5887 24.6111 17.7423 24.6266C17.9201 24.6446 18.1028 24.6603 18.2904 24.6735C18.6713 24.7008 19.066 24.7145 19.4746 24.7145H32.1645C32.6259 24.7145 33 24.3404 33 23.879C33 23.4176 32.6259 23.0435 32.1645 23.0435H19.4746C19.066 23.0435 18.6678 23.0572 18.28 23.0846C18.0952 23.0976 17.9151 23.1129 17.7398 23.1306C17.584 23.1463 17.496 22.9401 17.6152 22.8385C17.7606 22.7087 17.9164 22.5617 18.0826 22.3977L21.0848 19.4557C21.2095 19.3326 21.2856 19.2028 21.3133 19.0661C21.341 18.9294 21.2891 18.7928 21.1575 18.6561C20.8023 18.2942 20.2205 18.2901 19.8602 18.6469L15.2902 23.1723Z"
                            fill="#3B3731" />
                    </svg>
                </button>
            </div>
            <div class="steps-and-btn w-15">
                <div class="active-inactive-div d-flex align-items-center justify-content-center">
                    <div class="step-indicator">
                        <div class="steps-container">
                            <div class="step-item active">
                                <div class="step-circle">1</div>
                                <div class="step-label">Groomer Details</div>
                            </div>
                            <div class="step-item inactive">
                                <div class="step-circle">2</div>
                                <div class="step-label">Confirm & Pay</div>
                            </div>
                        </div>
                        <div class="progress-bar">
                            <div class="progress-fill" style="width: 50%;"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div>
            </div>
        </div>
    </section>
    <section class="container">
        <div class="row" style="margin-top: 4rem;">
            <div class="col-lg-8">
                <div class="step-one">
                    <h1>
                        Booking Details
                    </h1>
                    <div class="card">
                        <div>
                            <div class="card-img">
                                <div class="svg-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="21" height="22" viewBox="0 0 21 22"
                                        fill="none">
                                        <path
                                            d="M10.9482 0.125295C10.7667 0.043205 10.5723 0 10.3692 0C10.1662 0 9.97174 0.043205 9.79028 0.125295L1.65477 3.57738C0.704261 3.97918 -0.00430085 4.91673 1.96518e-05 6.0487C0.0216222 10.3346 1.78439 18.1764 9.22861 21.7408C9.95014 22.0864 10.7883 22.0864 11.5098 21.7408C18.9541 18.1764 20.7168 10.3346 20.7384 6.0487C20.7428 4.91673 20.0342 3.97918 19.0837 3.57738L10.9482 0.125295Z"
                                            fill="#CBDCE8" />
                                        <path
                                            d="M16 6L11.5556 10.7222L16 6ZM9.58111 10.4917C8.20333 11.0206 7.10167 10.93 6 10.4933C6.27778 14.0728 7.94667 15.4489 10.1717 16C10.1717 16 11.8478 14.8144 12.0894 12.0039C12.1156 11.6994 12.1283 11.5478 12.0656 11.3761C12.0022 11.2044 11.8778 11.0817 11.6294 10.8356C11.2206 10.4311 11.0167 10.2289 10.7739 10.1778C10.5311 10.1278 10.2144 10.2489 9.58111 10.4917Z"
                                            fill="#CBDCE8" />
                                        <path
                                            d="M16 6L11.5556 10.7222M9.58111 10.4917C8.20333 11.0206 7.10167 10.93 6 10.4933C6.27778 14.0728 7.94667 15.4489 10.1717 16C10.1717 16 11.8478 14.8144 12.0894 12.0039C12.1156 11.6994 12.1283 11.5478 12.0656 11.3761C12.0022 11.2044 11.8778 11.0817 11.6294 10.8356C11.2206 10.4311 11.0167 10.2289 10.7739 10.1778C10.5311 10.1278 10.2144 10.2489 9.58111 10.4917Z"
                                            stroke="white" stroke-linecap="round" stroke-linejoin="round" />
                                        <path
                                            d="M6.83325 13.4703C6.83325 13.4703 8.22214 13.7392 9.61103 12.667L6.83325 13.4703Z"
                                            fill="#CBDCE8" />
                                        <path d="M6.83325 13.4703C6.83325 13.4703 8.22214 13.7392 9.61103 12.667"
                                            stroke="white" stroke-linecap="round" stroke-linejoin="round" />
                                        <path
                                            d="M9.05564 8.36144C9.05564 8.54561 8.98247 8.72225 8.85224 8.85248C8.72201 8.98272 8.54537 9.05588 8.36119 9.05588C8.17701 9.05588 8.00038 8.98272 7.87015 8.85248C7.73991 8.72225 7.66675 8.54561 7.66675 8.36144C7.66675 8.17726 7.73991 8.00062 7.87015 7.87039C8.00038 7.74016 8.17701 7.66699 8.36119 7.66699C8.54537 7.66699 8.72201 7.74016 8.85224 7.87039C8.98247 8.00062 9.05564 8.17726 9.05564 8.36144Z"
                                            fill="#CBDCE8" stroke="white" />
                                        <path d="M10.4443 6.55554V6.6111V6.55554Z" fill="#CBDCE8" />
                                        <path d="M10.4443 6.55554V6.6111" stroke="white" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                </div>
                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        width="255" height="129" viewBox="0 0 255 129" fill="none">

                                        <path
                                            d="M255 124C255 126.761 252.761 129 250 129H5C2.23858 129 0 126.761 0 124V37C0 34.2386 2.23858 32 5 32H27C29.7614 32 32 29.7614 32 27V5C32 2.23858 34.2386 0 37 0H250C252.761 0 255 2.23858 255 5V124Z"
                                            fill="url(#pattern0)" />

                                        <defs>
                                            <pattern id="pattern0" patternContentUnits="objectBoundingBox" width="1"
                                                height="1">
                                                <use xlink:href="#image0" transform="scale(0.0039 0.0078)" />
                                            </pattern>

                                            <image id="image0" href="<?php echo htmlspecialchars($imagePath); ?>"
                                                width="255" height="129" preserveAspectRatio="xMidYMid slice" />
                                        </defs>

                                    </svg>
                                </div>
                                <div class="card-img-content">
                                    <div>
                                        <p>Furs & Co. Studio</p>
                                        <p>Hosted by<span> Dev É.</span></p>
                                    </div>
                                    <div>
                                        <p>Garden / Shed</p>
                                    </div>
                                </div>
                            </div>
                            <div class="ratings">
                                <div>
                                    <div>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="10" height="9" viewBox="0 0 10 9"
                                            fill="none">
                                            <path
                                                d="M2 8.99999C1.85833 8.99999 1.73967 8.95199 1.644 8.85599C1.54833 8.75999 1.50033 8.64133 1.5 8.49999C1.49967 8.35866 1.54767 8.23999 1.644 8.14399C1.74033 8.04799 1.859 7.99999 2 7.99999H8C8.14166 7.99999 8.2605 8.04799 8.3565 8.14399C8.4525 8.23999 8.50033 8.35866 8.5 8.49999C8.49966 8.64133 8.45166 8.76016 8.356 8.85649C8.26033 8.95283 8.14166 9.00066 8 8.99999H2ZM2.35 7.24999C2.10833 7.24999 1.89383 7.17083 1.7065 7.0125C1.51917 6.85416 1.4045 6.65416 1.3625 6.4125L0.862501 3.2375C0.845834 3.2375 0.827167 3.23967 0.806501 3.244C0.785834 3.24833 0.767001 3.25033 0.750001 3.25C0.541667 3.25 0.364668 3.17717 0.219001 3.0315C0.0733344 2.88583 0.000334469 2.70867 1.13636e-06 2.5C-0.000332197 2.29133 0.0726677 2.11433 0.219001 1.969C0.365334 1.82367 0.542334 1.75067 0.750001 1.75C0.957667 1.74933 1.13483 1.82233 1.2815 1.969C1.42817 2.11567 1.501 2.29267 1.5 2.5C1.5 2.55833 1.49367 2.6125 1.481 2.6625C1.46833 2.7125 1.45383 2.75833 1.4375 2.8L3 3.5L4.5625 1.3625C4.47083 1.29583 4.39583 1.20833 4.3375 1.1C4.27917 0.991667 4.25 0.875 4.25 0.75C4.25 0.541667 4.323 0.364501 4.469 0.218501C4.615 0.0725011 4.792 -0.000332194 5 1.13895e-06C5.208 0.000334472 5.38516 0.0733344 5.5315 0.219001C5.67783 0.364667 5.75066 0.541667 5.75 0.75C5.75 0.875 5.72083 0.991667 5.6625 1.1C5.60416 1.20833 5.52916 1.29583 5.4375 1.3625L7 3.5L8.5625 2.8C8.54583 2.75833 8.53116 2.7125 8.5185 2.6625C8.50583 2.6125 8.49966 2.55833 8.5 2.5C8.5 2.29167 8.573 2.1145 8.719 1.9685C8.865 1.8225 9.042 1.74967 9.25 1.75C9.458 1.75033 9.63516 1.82333 9.7815 1.969C9.92783 2.11467 10.0007 2.29167 10 2.5C9.99933 2.70833 9.92649 2.8855 9.7815 3.0315C9.6365 3.1775 9.45933 3.25033 9.25 3.25C9.23333 3.25 9.21466 3.248 9.194 3.244C9.17333 3.24 9.1545 3.23783 9.1375 3.2375L8.6375 6.4125C8.59583 6.65416 8.48133 6.85416 8.294 7.0125C8.10666 7.17083 7.892 7.24999 7.65 7.24999H2.35ZM2.35 6.25H7.65L7.975 4.1625L7.4 4.4125C7.18333 4.50416 6.9625 4.52083 6.7375 4.4625C6.5125 4.40416 6.32916 4.27916 6.1875 4.0875L5 2.45L3.8125 4.0875C3.67083 4.27916 3.4875 4.40416 3.2625 4.4625C3.0375 4.52083 2.81667 4.50416 2.6 4.4125L2.025 4.1625L2.35 6.25Z"
                                                fill="white" />
                                        </svg>
                                        <p>Popular</p>
                                    </div>
                                    <div>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="9" height="11" viewBox="0 0 9 11"
                                            fill="none">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M6.41298 7.89331C6.44191 7.34386 6.31555 6.79737 6.04836 6.31639C5.78117 5.83541 5.38396 5.43938 4.90218 5.17363C4.81663 5.12414 4.7152 5.1098 4.61928 5.13363C4.52336 5.15746 4.44044 5.2176 4.38799 5.30138L3.77528 6.28209L3.26554 5.66557C3.23754 5.63178 3.20283 5.60415 3.16362 5.58443C3.12441 5.56471 3.08154 5.55333 3.03771 5.551C2.99388 5.54867 2.95005 5.55545 2.90896 5.5709C2.86788 5.58635 2.83045 5.61015 2.79902 5.64078C2.49895 5.93115 2.26456 6.28243 2.11162 6.67097C1.95868 7.05952 1.89074 7.47631 1.91237 7.89331C1.91237 8.49004 2.14943 9.06234 2.57138 9.48429C2.99333 9.90624 3.56563 10.1433 4.16236 10.1433C4.75909 10.1433 5.33138 9.90624 5.75334 9.48429C6.17529 9.06234 6.41234 8.49004 6.41234 7.89331M3.01004 6.35519L2.97063 6.4073C2.67173 6.82484 2.52196 7.33078 2.54542 7.84374L2.54733 7.88124C2.54733 8.3094 2.71741 8.72003 3.02017 9.02279C3.32293 9.32554 3.73356 9.49563 4.16172 9.49563C4.58989 9.49563 5.00052 9.32554 5.30327 9.02279C5.60603 8.72003 5.77612 8.3094 5.77612 7.88124L5.77803 7.84437C5.78247 7.80306 5.88163 6.66662 4.8418 5.89375L4.79032 5.85625L4.12677 6.91768C4.09473 6.96887 4.05098 7.01172 3.99915 7.0427C3.94731 7.07368 3.88885 7.09191 3.82859 7.09588C3.76833 7.09985 3.70799 7.08946 3.65253 7.06555C3.59708 7.04164 3.54809 7.0049 3.50961 6.95836L3.01004 6.35519Z"
                                                fill="#FEFEFE" />
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M3.79701 0.30821C3.81025 0.23997 3.84191 0.176658 3.88858 0.125138C3.93524 0.0736173 3.99512 0.0358558 4.06172 0.0159479C4.12832 -0.00396001 4.1991 -0.00525449 4.26638 0.0122049C4.33367 0.0296642 4.39489 0.0652111 4.4434 0.114991C4.56671 0.240837 4.80378 0.489988 5.04467 0.777274C5.28111 1.05884 5.53916 1.39761 5.68788 1.69951C5.8328 1.99443 5.98661 2.37578 6.10801 2.69421L6.67305 1.75354C6.70456 1.701 6.74826 1.65683 6.80046 1.62476C6.85265 1.59269 6.91181 1.57367 6.97292 1.56931C7.03402 1.56494 7.09528 1.57536 7.1515 1.59969C7.20773 1.62401 7.25727 1.66152 7.29592 1.70905C8.09867 2.70057 8.49846 3.76263 8.6974 4.57365C8.79718 4.97979 8.8474 5.32491 8.87282 5.57025C8.88576 5.69278 8.89424 5.81574 8.89824 5.93889V5.97131C8.89824 8.4482 6.93364 10.4649 4.44785 10.4649C1.96206 10.4649 0 8.44756 0 5.97004C0 5.28805 0.322244 3.68192 1.27563 2.36498C1.31266 2.31422 1.36166 2.27341 1.41826 2.24615C1.47487 2.2189 1.53734 2.20605 1.60011 2.20876C1.66287 2.21146 1.724 2.22963 1.77806 2.26166C1.83211 2.29368 1.87741 2.33856 1.90994 2.39231L2.55507 3.46709C2.75083 3.16073 3.01269 2.73044 3.21163 2.3332C3.49765 1.76117 3.72455 0.682572 3.79701 0.308845M4.3201 0.912655C4.20506 1.42113 4.01501 2.14697 3.77985 2.61858C3.46714 3.24336 3.0165 3.9298 2.86142 4.16051C2.82554 4.21345 2.77693 4.25651 2.72005 4.28574C2.66317 4.31497 2.59986 4.32943 2.53593 4.32778C2.472 4.32614 2.40952 4.30844 2.35422 4.27632C2.29892 4.24421 2.25258 4.1987 2.21948 4.14399L1.57118 3.06476C0.87457 4.19166 0.635589 5.45839 0.635589 5.97131C0.635589 8.10561 2.32244 9.82806 4.44785 9.82806C6.57326 9.82806 8.26265 8.10561 8.26265 5.97131V5.95351L8.26011 5.88995C8.25568 5.80484 8.24911 5.71986 8.24041 5.63508C8.20712 5.3287 8.15362 5.02487 8.08024 4.72555C7.87826 3.89157 7.52027 3.10334 7.02516 2.40248L6.38068 3.47535C6.34338 3.53732 6.28925 3.58743 6.22459 3.61985C6.15993 3.65227 6.08739 3.66566 6.01542 3.65847C5.94344 3.65128 5.87499 3.6238 5.81802 3.57923C5.76105 3.53466 5.71791 3.47483 5.6936 3.40671C5.59064 3.11815 5.33831 2.42917 5.11713 1.98044C5.00463 1.751 4.78916 1.46117 4.55781 1.18596C4.4801 1.09353 4.40086 1.00242 4.3201 0.912655Z"
                                                fill="#FEFEFE" />
                                        </svg>
                                        <p>Top Rated</p>
                                    </div>
                                </div>
                                <div>
                                    <div>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="10" height="14"
                                            viewBox="0 0 10 14" fill="none">
                                            <path
                                                d="M5 6.65C4.5264 6.65 4.0722 6.46563 3.73731 6.13744C3.40242 5.80925 3.21429 5.36413 3.21429 4.9C3.21429 4.43587 3.40242 3.99075 3.73731 3.66256C4.0722 3.33437 4.5264 3.15 5 3.15C5.4736 3.15 5.9278 3.33437 6.26269 3.66256C6.59758 3.99075 6.78571 4.43587 6.78571 4.9C6.78571 5.12981 6.73953 5.35738 6.64979 5.5697C6.56004 5.78202 6.42851 5.97493 6.26269 6.13744C6.09687 6.29994 5.90002 6.42884 5.68336 6.51679C5.46671 6.60473 5.2345 6.65 5 6.65ZM5 0C3.67392 0 2.40215 0.516248 1.46447 1.43518C0.526784 2.3541 0 3.60044 0 4.9C0 8.575 5 14 5 14C5 14 10 8.575 10 4.9C10 3.60044 9.47322 2.3541 8.53553 1.43518C7.59785 0.516248 6.32608 0 5 0Z"
                                                fill="#FFC97A" />
                                        </svg>
                                        <p>2.5 mi</p>
                                    </div>
                                    <div>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                            viewBox="0 0 14 14" fill="none">
                                            <path
                                                d="M6.12956 0.660476C6.40354 -0.220161 7.59647 -0.220158 7.87045 0.660479L8.89548 3.95519C9.01801 4.34902 9.36942 4.61566 9.76593 4.61566H13.083C13.9696 4.61566 14.3383 5.80055 13.621 6.34481L10.9374 8.38106C10.6166 8.62446 10.4824 9.0559 10.6049 9.44973L11.63 12.7444C11.9039 13.6251 10.9388 14.3574 10.2215 13.8131L7.53797 11.7769C7.21719 11.5335 6.78282 11.5335 6.46204 11.7769L3.77846 13.8131C3.06117 14.3574 2.09607 13.6251 2.37005 12.7444L3.39508 9.44973C3.51761 9.0559 3.38338 8.62446 3.0626 8.38106L0.37903 6.34481C-0.338258 5.80055 0.0303816 4.61566 0.916998 4.61566H4.23408C4.63058 4.61566 4.98199 4.34902 5.10452 3.95519L6.12956 0.660476Z"
                                                fill="#FFC97A" />
                                        </svg>
                                        <p>4.3</p>
                                        <span>
                                            (20 reviews)
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-booking-info">
                            <div>
                                <div>
                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="13"
                                            viewBox="0 0 15 13" fill="none">
                                            <path
                                                d="M13.1094 12.1166V3.83417C13.1094 3.81429 13.1111 3.79482 13.1141 3.77576L10.8748 1.86616C10.3986 1.46067 10.0696 1.18119 9.79046 0.998982C9.52095 0.823101 9.33983 0.766834 9.16658 0.766834C8.99347 0.766835 8.81349 0.823306 8.54428 0.998982C8.26512 1.18121 7.93524 1.46044 7.45838 1.86616L5.21745 3.77576C5.22054 3.7949 5.22374 3.81422 5.22374 3.83417V12.1166C5.2234 12.3281 5.04341 12.5 4.82144 12.5C4.59961 12.4998 4.41948 12.328 4.41914 12.1166V4.45573L4.00427 4.81069C3.83864 4.95183 3.58349 4.93709 3.43539 4.77924C3.28788 4.62148 3.30169 4.3796 3.46682 4.23856L6.92094 1.29553H6.92251C7.38342 0.90337 7.75667 0.583679 8.08855 0.366942C8.43046 0.143752 8.76989 2.24995e-07 9.16658 0C9.56323 0 9.9026 0.143743 10.2446 0.366942C10.5767 0.583731 10.9515 0.903225 11.4122 1.29553L14.8663 4.23856C15.0315 4.3796 15.0453 4.62148 14.8978 4.77924C14.7497 4.93709 14.4945 4.95183 14.3289 4.81069L13.914 4.45573V12.1166C13.9137 12.328 13.7336 12.4998 13.5117 12.5C13.2898 12.5 13.1098 12.3281 13.1094 12.1166Z"
                                                fill="#9D9B98" />
                                            <path
                                                d="M1.82418 6.66737C1.82418 6.37816 1.74192 6.13002 1.62487 5.96249C1.50777 5.79507 1.37173 5.7247 1.25 5.7247C1.12833 5.7248 0.992145 5.79519 0.875132 5.96249C0.758177 6.13002 0.675818 6.37832 0.675818 6.66737C0.675926 6.95653 0.758033 7.20483 0.875132 7.37226C0.992124 7.53946 1.12837 7.60853 1.25 7.60863C1.37164 7.60863 1.50783 7.53939 1.62487 7.37226C1.74197 7.20483 1.82407 6.95653 1.82418 6.66737ZM2.5 6.66737C2.49989 7.09818 2.37897 7.50235 2.16605 7.80679C1.95294 8.11149 1.63215 8.33333 1.25 8.33333C0.868121 8.33323 0.548331 8.11124 0.335269 7.80679C0.12233 7.50234 0.000106589 7.0982 0 6.66737C0 6.23634 0.122237 5.83113 0.335269 5.52654C0.548331 5.22219 0.868196 5.0001 1.25 5C1.63209 5 1.95294 5.22191 2.16605 5.52654C2.37908 5.83113 2.5 6.23634 2.5 6.66737Z"
                                                fill="#9D9B98" />
                                            <path
                                                d="M0.833252 12.1094V7.8906C0.833252 7.67488 1.0198 7.5 1.24992 7.5C1.48004 7.5 1.66659 7.67488 1.66659 7.8906V12.1094C1.66641 12.325 1.47993 12.5 1.24992 12.5C1.01991 12.5 0.833428 12.325 0.833252 12.1094Z"
                                                fill="#9D9B98" />
                                            <path
                                                d="M10.6579 9.31364C10.6579 8.9734 10.6564 8.75738 10.6348 8.59906C10.6147 8.4523 10.584 8.41411 10.5654 8.39576C10.5468 8.37748 10.5083 8.34577 10.3588 8.32597C10.1978 8.30466 9.97715 8.30473 9.63096 8.30473H8.92167C8.57549 8.30473 8.35488 8.30466 8.19387 8.32597C8.04438 8.34577 8.00583 8.37748 7.98725 8.39576C7.96865 8.41411 7.93793 8.4523 7.91787 8.59906C7.89622 8.75738 7.89474 8.9734 7.89474 9.31364V11.7229H10.6579V9.31364ZM9.98715 5.42972C10.2048 5.42988 10.3816 5.60399 10.3819 5.81811C10.3819 6.03251 10.205 6.20634 9.98715 6.2065H8.56548C8.34762 6.20634 8.17074 6.03251 8.17074 5.81811C8.17108 5.60399 8.34782 5.42988 8.56548 5.42972H9.98715ZM9.98715 3.33301L10.0658 3.34059C10.246 3.37657 10.3819 3.53349 10.3819 3.7214C10.3819 3.90931 10.246 4.06623 10.0658 4.10221L9.98715 4.10979H8.56548C8.34762 4.10963 8.17074 3.9358 8.17074 3.7214C8.17074 3.507 8.34762 3.33317 8.56548 3.33301H9.98715ZM11.4474 11.7229H14.6053C14.8233 11.7229 15 11.8968 15 12.1113C14.9997 12.3255 14.8231 12.4997 14.6053 12.4997H0.394737C0.176935 12.4997 0.000332468 12.3255 0 12.1113C0 11.8968 0.17673 11.7229 0.394737 11.7229H7.10526V9.31364C7.10526 8.99552 7.10427 8.71791 7.13456 8.4959C7.16648 8.26247 7.23958 8.03308 7.42907 7.84655C7.61867 7.66 7.85172 7.58819 8.08902 7.55678C8.31486 7.52691 8.59793 7.52795 8.92167 7.52795H9.63096C9.95471 7.52795 10.2378 7.52691 10.4636 7.55678C10.7009 7.58819 10.934 7.66 11.1236 7.84655C11.313 8.03308 11.3862 8.26247 11.4181 8.4959C11.4484 8.71791 11.4474 8.99552 11.4474 9.31364V11.7229Z"
                                                fill="#9D9B98" />
                                        </svg>
                                        Space
                                    </span>
                                    <p>Garden / Shed</p>
                                </div>
                                <div>
                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="15"
                                            viewBox="0 0 16 15" fill="none">
                                            <path
                                                d="M0.5 7.32052C0.5 4.61314 0.5 3.25909 1.379 2.41837C2.258 1.57765 3.67175 1.57693 6.5 1.57693H9.5C12.3282 1.57693 13.7427 1.57693 14.621 2.41837C15.4992 3.2598 15.5 4.61314 15.5 7.32052V8.75641C15.5 11.4638 15.5 12.8178 14.621 13.6586C13.742 14.4993 12.3282 14.5 9.5 14.5H6.5C3.67175 14.5 2.25725 14.5 1.379 13.6586C0.50075 12.8171 0.5 11.4638 0.5 8.75641V7.32052Z"
                                                stroke="#9D9B98" />
                                            <path d="M4.25 1.57692V0.5M11.75 1.57692V0.5M0.875 5.16666H15.125"
                                                stroke="#9D9B98" stroke-linecap="round" />
                                            <path
                                                d="M12.5 10.9101C12.5 11.1005 12.421 11.2831 12.2803 11.4177C12.1397 11.5524 11.9489 11.628 11.75 11.628C11.5511 11.628 11.3603 11.5524 11.2197 11.4177C11.079 11.2831 11 11.1005 11 10.9101C11 10.7196 11.079 10.537 11.2197 10.4024C11.3603 10.2677 11.5511 10.1921 11.75 10.1921C11.9489 10.1921 12.1397 10.2677 12.2803 10.4024C12.421 10.537 12.5 10.7196 12.5 10.9101ZM12.5 8.03826C12.5 8.22867 12.421 8.41128 12.2803 8.54593C12.1397 8.68057 11.9489 8.75621 11.75 8.75621C11.5511 8.75621 11.3603 8.68057 11.2197 8.54593C11.079 8.41128 11 8.22867 11 8.03826C11 7.84785 11.079 7.66524 11.2197 7.53059C11.3603 7.39595 11.5511 7.32031 11.75 7.32031C11.9489 7.32031 12.1397 7.39595 12.2803 7.53059C12.421 7.66524 12.5 7.84785 12.5 8.03826ZM8.75 10.9101C8.75 11.1005 8.67098 11.2831 8.53033 11.4177C8.38968 11.5524 8.19891 11.628 8 11.628C7.80109 11.628 7.61032 11.5524 7.46967 11.4177C7.32902 11.2831 7.25 11.1005 7.25 10.9101C7.25 10.7196 7.32902 10.537 7.46967 10.4024C7.61032 10.2677 7.80109 10.1921 8 10.1921C8.19891 10.1921 8.38968 10.2677 8.53033 10.4024C8.67098 10.537 8.75 10.7196 8.75 10.9101ZM8.75 8.03826C8.75 8.22867 8.67098 8.41128 8.53033 8.54593C8.38968 8.68057 8.19891 8.75621 8 8.75621C7.80109 8.75621 7.61032 8.68057 7.46967 8.54593C7.32902 8.41128 7.25 8.22867 7.25 8.03826C7.25 7.84785 7.32902 7.66524 7.46967 7.53059C7.61032 7.39595 7.80109 7.32031 8 7.32031C8.19891 7.32031 8.38968 7.39595 8.53033 7.53059C8.67098 7.66524 8.75 7.84785 8.75 8.03826ZM5 10.9101C5 11.1005 4.92098 11.2831 4.78033 11.4177C4.63968 11.5524 4.44891 11.628 4.25 11.628C4.05109 11.628 3.86032 11.5524 3.71967 11.4177C3.57902 11.2831 3.5 11.1005 3.5 10.9101C3.5 10.7196 3.57902 10.537 3.71967 10.4024C3.86032 10.2677 4.05109 10.1921 4.25 10.1921C4.44891 10.1921 4.63968 10.2677 4.78033 10.4024C4.92098 10.537 5 10.7196 5 10.9101ZM5 8.03826C5 8.22867 4.92098 8.41128 4.78033 8.54593C4.63968 8.68057 4.44891 8.75621 4.25 8.75621C4.05109 8.75621 3.86032 8.68057 3.71967 8.54593C3.57902 8.41128 3.5 8.22867 3.5 8.03826C3.5 7.84785 3.57902 7.66524 3.71967 7.53059C3.86032 7.39595 4.05109 7.32031 4.25 7.32031C4.44891 7.32031 4.63968 7.39595 4.78033 7.53059C4.92098 7.66524 5 7.84785 5 8.03826Z"
                                                fill="#9D9B98" />
                                        </svg>
                                        Date
                                    </span>
                                    <p>18/12/2025</p>
                                </div>
                                <div>
                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            viewBox="0 0 48 48">
                                            <path
                                                d="M 24 4 C 12.972066 4 4 12.972074 4 24 C 4 35.027926 12.972066 44 24 44 C 35.027934 44 44 35.027926 44 24 C 44 12.972074 35.027934 4 24 4 z
       M 24 7 C 33.406615 7 41 14.593391 41 24 C 41 33.406609 33.406615 41 24 41 C 14.593385 41 7 33.406609 7 24 C 7 14.593391 14.593385 7 24 7 z
       M 22.476562 11.978516 A 1.50015 1.50015 0 0 0 21 13.5 L 21 24.5 A 1.50015 1.50015 0 0 0 21.439453 25.560547 L 26.439453 30.560547 A 1.50015 1.50015 0 1 0 28.560547 28.439453 L 24 23.878906 L 24 13.5 A 1.50015 1.50015 0 0 0 22.476562 11.978516 z"
                                                fill="#9D9B98" />
                                        </svg>
                                        Time
                                    </span>
                                    <p>Half-Day (14:30 - 18:30)</p>
                                </div>
                                <div>
                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="11" height="15"
                                            viewBox="0 0 11 15" fill="none">
                                            <path
                                                d="M5.5 0.5C6.83339 0.5 8.10786 1.00588 9.04395 1.89941C9.9792 2.79219 10.5 3.99796 10.5 5.25C10.5 6.6294 9.73861 8.338 8.73145 9.9707C7.73727 11.5823 6.5574 13.0362 5.82422 13.8867C5.6489 14.0901 5.3511 14.0901 5.17578 13.8867C4.4426 13.0362 3.26273 11.5823 2.26855 9.9707C1.26139 8.338 0.5 6.6294 0.5 5.25C0.5 3.99796 1.0208 2.79219 1.95605 1.89941C2.89214 1.00588 4.16661 0.5 5.5 0.5ZM5.5 2.875C4.85374 2.875 4.22936 3.11984 3.76562 3.5625C3.30115 4.00591 3.03613 4.61245 3.03613 5.25C3.03613 5.88755 3.30115 6.49409 3.76562 6.9375C4.22936 7.38016 4.85374 7.625 5.5 7.625C5.82047 7.625 6.13831 7.56479 6.43555 7.44727C6.73282 7.32973 7.00457 7.15686 7.23438 6.9375C7.46409 6.7182 7.64771 6.45659 7.77344 6.16699C7.89921 5.87715 7.96387 5.5652 7.96387 5.25C7.96387 4.61245 7.69885 4.00591 7.23438 3.5625C6.77064 3.11984 6.14626 2.875 5.5 2.875Z"
                                                stroke="#9D9B98" />
                                        </svg>
                                        Location
                                    </span>
                                    <p>Victoria Embankment</p>
                                </div>
                            </div>
                            <div>
                                <button>Change</button>
                            </div>
                        </div>
                    </div>
                    <div class="information">
                        <h2>Pet Information for Space Use</h2>

                        <!-- Buttons — hidden once list is shown -->
                        <div class="btns" id="petActionBtns">
                            <button id="selectPetsBtn">Select existing pet/s</button>
                            <button id="addNewPetBtn">+ Add new pet/s</button>
                        </div>

                        <!-- Inline pet list (shown in place of buttons) -->
                        <div class="pet-list" id="petList"></div>
                    </div>
                    <div class="add-ons">
                        <h2 class="add-ons-title">Add-ons Services</h2>
                        <div class="add-ons-list">
                            <label class="add-on-card">
                                <input type="checkbox" name="addons[]" value="storage_locker" class="add-on-checkbox"
                                    checked>
                                <div class="add-on-content">
                                    <span class="add-on-name">Storage Locker</span>
                                    <span class="add-on-price-container">
                                        <span class="add-on-price">£5</span> <span class="add-on-unit">/ day</span>
                                    </span>
                                </div>
                                <div class="checkmark-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"
                                        fill="none">
                                        <circle cx="10" cy="10" r="10" fill="#C9DDA0" />
                                        <path d="M6 10L8.5 12.5L14 7" stroke="white" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </div>
                            </label>

                            <label class="add-on-card">
                                <input type="checkbox" name="addons[]" value="deep_clean" class="add-on-checkbox"
                                    checked>
                                <div class="add-on-content">
                                    <span class="add-on-name">Deep Clean</span>
                                    <span class="add-on-price-container">
                                        <span class="add-on-price">£10</span>
                                    </span>
                                </div>
                                <div class="checkmark-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"
                                        fill="none">
                                        <circle cx="10" cy="10" r="10" fill="#C9DDA0" />
                                        <path d="M6 10L8.5 12.5L14 7" stroke="white" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </div>
                            </label>

                            <label class="add-on-card">
                                <input type="checkbox" name="addons[]" value="after_hours_access"
                                    class="add-on-checkbox">
                                <div class="add-on-content">
                                    <span class="add-on-name">After-hours access</span>
                                    <span class="add-on-price-container">
                                        <span class="add-on-price">£20</span>
                                    </span>
                                </div>
                                <div class="checkmark-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"
                                        fill="none">
                                        <circle cx="10" cy="10" r="10" fill="#C9DDA0" />
                                        <path d="M6 10L8.5 12.5L14 7" stroke="white" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </div>
                            </label>
                        </div>
                        <div class="add-ons-actions">
                            <button type="button" class="continue-action-btn" id="addonsContinueBtn">
                                Continue
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path d="M5 12h14"></path>
                                    <path d="m12 5 7 7-7 7"></path>
                                </svg>
                            </button>
                        </div>
                    </div>

                </div>
                <!-- <div class="step-two"></div> -->
            </div>
            <div class="col-lg-4"></div>
        </div>
    </section>
    <?php include('../components/footer.php'); ?>
    <?php
    bcAssets(); ?>
    <script src=" <?= BASE_URL ?>/assets/js/custom.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // JS to handle add-on card selection styling
            const addonCards = document.querySelectorAll('.add-on-card');
            addonCards.forEach(card => {
                const checkbox = card.querySelector('.add-on-checkbox');

                // Initialize state
                if (checkbox && checkbox.checked) {
                    card.classList.add('active');
                }

                checkbox.addEventListener('change', function () {
                    if (this.checked) {
                        card.classList.add('active');
                    } else {
                        card.classList.remove('active');
                    }
                });
            });

            const continueBtn = document.getElementById("addonsContinueBtn");
            if (continueBtn) {
                continueBtn.addEventListener("click", function () {
                    const selectedAddons = Array.from(document.querySelectorAll('.add-on-checkbox:checked'))
                        .map(cb => cb.value);
                    console.log("Selected Add-ons:", selectedAddons);
                });
            }
        });


        (function () {

            const icons = {
                birthday: `<svg xmlns="http://www.w3.org/2000/svg" width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="#9D9B98" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-8a2 2 0 0 0-2-2H6a2 2 0 0 0-2 2v8"/><path d="M4 16s.5-1 2-1 2.5 2 4 2 2.5-2 4-2 2.5 2 4 2 2-1 2-1"/><path d="M2 21h20"/><path d="M7 8v2"/><path d="M12 8v2"/><path d="M17 8v2"/></svg>`,
                sex: `<svg xmlns="http://www.w3.org/2000/svg" width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="#9D9B98" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="11" r="4"/><path d="M12 15v6"/><path d="m9 18 3 3 3-3"/></svg>`,
                notes: `<svg xmlns="http://www.w3.org/2000/svg" width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="#9D9B98" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>`,
            };

            function petEmoji(type) {
                return { Dog: '🐶', Cat: '🐱', Rabbit: '🐰', Bird: '🐦', Fish: '🐟', Hamster: '🐹' }[type] || '🐾';
            }

            let allPets = [];
            let selectedIds = new Set();

            const actionBtns = document.getElementById('petActionBtns');
            const petList = document.getElementById('petList');
            const selectBtn = document.getElementById('selectPetsBtn');

            // ── Open: hide buttons, show list ─────────────────────────────────────
            selectBtn.addEventListener('click', async function () {
                actionBtns.style.display = 'none';
                petList.classList.add('visible');
                if (allPets.length === 0) await loadPets();
                else renderCards();
            });

            // ── Load pets ──────────────────────────────────────────────────────────
            async function loadPets() {
                petList.innerHTML = '<p style="color:#9D9B98;font-family:Lato,sans-serif;font-size:14px;padding:8px 0;">Loading…</p>';
                try {
                    const res = await fetch('pets-data.json');
                    allPets = await res.json();
                } catch (_) {
                    // Fallback to your provided sample data
                    allPets = [
                        { id: 1, name: "Buddy", type: "Dog", breed: "Golden Retriever", birthday: "22/08/2018", sex: "Male", image: "images/buddy.jpg", notes: "Very friendly and loves to play fetch." },
                        { id: 2, name: "Luna", type: "Cat", breed: "Persian", birthday: "14/03/2020", sex: "Female", image: "images/luna.jpg", notes: "A bit shy but enjoys petting. Needs regular grooming." },
                        { id: 3, name: "Charlie", type: "Dog", breed: "Bulldog", birthday: "05/11/2017", sex: "Male", image: "images/charlie.jpg", notes: "Has a sensitive stomach, needs special diet plan." }
                    ];
                }
                allPets = allPets.map((p, i) => ({ id: p.id ?? i + 1, ...p }));
                renderCards();
            }

            // ── Render ─────────────────────────────────────────────────────────────
            function renderCards() {
                petList.innerHTML = '';

                allPets.forEach(pet => {
                    const card = document.createElement('div');
                    card.className = 'pet-card' + (selectedIds.has(pet.id) ? ' selected' : '');
                    card.dataset.petId = pet.id;

                    card.innerHTML = `
        <div class="pet-radio"><div class="pet-radio-inner"></div></div>
        <div class="pet-avatar">
          <img src="${pet.image}" alt="${pet.name}"
               onerror="this.parentElement.innerHTML='${petEmoji(pet.type)}'">
        </div>
        <div class="pet-info-grid">
          <div class="pet-info-primary">
            <p class="pet-name">${pet.name}</p>
            <p class="pet-breed">${pet.type} &bull; ${pet.breed}</p>
          </div>
          ${pet.birthday ? `<div class="pet-field">
            <span class="pet-field-label">${icons.birthday} Birthday</span>
            <p class="pet-field-value">${pet.birthday}</p>
          </div>` : ''}
          <div class="pet-field">
            <span class="pet-field-label">${icons.sex} Sex</span>
            <p class="pet-field-value">${pet.sex}</p>
          </div>
          ${pet.notes ? `<div class="pet-field notes">
            <span class="pet-field-label">${icons.notes} Notes</span>
            <p class="pet-field-value" title="${pet.notes}">${pet.notes}</p>
          </div>` : ''}
        </div>
        <button class="pet-edit-btn" data-pet-id="${pet.id}">Edit</button>
      `;

                    card.addEventListener('click', function (e) {
                        if (e.target.closest('.pet-edit-btn')) return;
                        selectedIds.has(pet.id) ? selectedIds.delete(pet.id) : selectedIds.add(pet.id);
                        card.classList.toggle('selected');
                        updateConfirmBtn();
                    });

                    card.querySelector('.pet-edit-btn').addEventListener('click', function (e) {
                        e.stopPropagation();
                        // Wire to your edit pet flow here
                        console.log('Edit pet:', pet);
                    });

                    petList.appendChild(card);
                });

                // Confirm + Cancel button row
                const actions = document.createElement('div');
                actions.className = 'pet-list-actions';
                actions.innerHTML = `
      <button class="pet-cancel-btn" id="petCancelBtn">Cancel</button>
      <button class="pet-save-btn" id="petConfirmBtn" disabled>
        Save
      </button>
    `;
                petList.appendChild(actions);

                document.getElementById('petCancelBtn').addEventListener('click', function () {
                    selectedIds.clear();
                    petList.classList.remove('visible');
                    petList.innerHTML = '';
                    actionBtns.style.display = '';
                });

                document.getElementById('petConfirmBtn').addEventListener('click', function () {
                    const chosen = allPets.filter(p => selectedIds.has(p.id));
                    console.log('Selected pets:', chosen);
                    // Fire your next step / form submit here
                });
            }

            function updateConfirmBtn() {
                const btn = document.getElementById('petConfirmBtn');
                if (btn) btn.disabled = selectedIds.size === 0;
            }

        })();
    </script>
</body>

</html>