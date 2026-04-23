<?php include '../function_helper.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="icon" href="<?= BASE_URL ?>assets/images/favicon.ico" type="image/x-icon">
    <title>Fursgo - Booking Confirmed</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/responsive.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/bootstrap.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/media_query.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/common.css">
    <style>
        body {
            background: #FDFCF8;
            font-family: Lato, sans-serif;
            color: #3B3731;
        }

        .conf-wrapper {
            max-width: 1000px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* Top Title */
        .conf-header {
            text-align: center;
            margin: 30px 0;
        }

        .conf-main-icon {
            display: inline-block;
            margin-bottom: 20px;
        }

        .conf-header h1 {
            color: #3B3731;
            text-align: center;
            font-family: "Playfair Display";
            font-size: 28px;
            font-style: normal;
            font-weight: 600;
            line-height: normal;
        }

        .conf-header h1 i {
            color: #3B3731;
            font-family: "Playfair Display";
            font-size: 28px;
            font-style: italic;
            font-weight: 900;
            line-height: normal;
        }

        .conf-header p {
            color: #000;
            text-align: center;
            font-family: Lato;
            font-size: 18px;
            font-style: normal;
            font-weight: 400;
            line-height: normal;
            margin-top: 2rem;
            margin-bottom: 1rem;
        }

        /* Card container */
        .conf-card {

            overflow: hidden;
            margin-bottom: 30px;
            max-width: 650px;
            margin: 0 auto;
        }

        .conf-card-header {
            border-radius: 10px 10px 0 0;
            border: 1px solid #D8E8B7;
            background: #F5F9ED;
            width: 100%;
            height: 68px;
            display: flex;
            align-items: center;
        }

        .conf-card-header h2 {
            color: #3B3731;
            font-family: Lato;
            font-size: 20px;
            font-style: normal;
            font-weight: 600;
            line-height: normal;
            margin-left: 2rem;
        }

        .conf-card-body {
            padding: 24px;
            padding-bottom: 0;
            background: #FFFFFF;
            border: 1px solid #D8E8B7;
            border-top: none;
            border-radius: 0 0 12px 12px;
        }

        /* Card Intro (Image + host info) */
        .conf-host-info {
            align-items: center;
            gap: 20px;
            margin-bottom: 24px;
        }

        .conf-host-img-container {
            position: relative;
            display: flex;
            align-items: end;
        }

        .conf-img-icon {
            position: absolute;
            top: 1rem;
            left: 1rem;
            transform: translate(-50%, -50%);
        }

        .conf-host-tag {
            width: 107px;
            height: 24px;
            border-radius: 100px;
            background: #FFA899;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .conf-host-tag>span {
            color: #FFF;
            text-align: center;
            font-family: Lato;
            font-size: 14px;
            font-style: normal;
            font-weight: 500;
            line-height: normal;

        }

        .conf-host-img-container>div:nth-child(3) {
            margin-left: 1rem;
        }

        .conf-host-img-container>div:nth-child(3)>p:nth-child(1) {
            color: #3B3731;
            font-family: Lato;
            font-size: 18px;
            font-style: normal;
            font-weight: 600;
            line-height: normal;
        }

        .conf-host-img-container>div:nth-child(3)>p:nth-child(2) {
            color: #3B3731;
            font-family: Lato;
            font-size: 18px;
            font-style: normal;
            font-weight: 400;
            line-height: normal;
            margin-bottom: 1rem;
        }

        .conf-host-img-container>div:nth-child(3)>p:nth-child(2)>span {
            color: #9D9B98;
            font-family: Lato;
            font-size: 18px;
            font-style: normal;
            font-weight: 400;
            line-height: normal;
        }

        .conf-host-img {
            width: 150px;
            height: 90px;
            border-radius: 8px;
            object-fit: cover;
        }


        .conf-host-details h3 {
            font-size: 16px;
            font-weight: 600;
            margin: 0 0 4px;
        }

        .conf-host-details p {
            font-size: 14px;
            color: #9D9B98;
            margin: 0 0 8px;
        }


        /* Grid */
        .conf-grid {
            display: flex;
            justify-content: space-between;
            margin: 2rem 0;
        }

        .conf-grid-item {
            display: flex;
            flex-direction: column;
            gap: 6px;
            position: relative;
            flex: 1;
        }

        .conf-grid-item:not(:last-child)::after {
            content: '';
            position: absolute;
            right: 0;
            top: 5px;
            bottom: 5px;
            width: 1px;
            background: #EBEBEB;
        }

        .conf-grid-label {
            color: #3B3731;
            font-family: Lato;
            font-size: 18px;
            font-style: normal;
            font-weight: 600;
            line-height: normal;
        }

        .conf-grid-value {
            color: #3B3731;
            font-family: Lato;
            font-size: 18px;
            font-style: normal;
            font-weight: 400;
            line-height: normal;
        }

        /* Access info */
        .conf-access-box {
            background: #F4F7FB;
            border-radius: 8px;
            padding: 16px 20px;
            width: 526px;
            height: 105px;
            margin: 0 auto 1.5rem auto;
        }

        .conf-access-box h4 {
            font-size: 14px;
            font-weight: 600;
            margin: 0 0 6px;
            color: #3B3731;
        }

        .conf-access-box p {
            font-size: 13px;
            color: #9D9B98;
            margin: 0;
            line-height: 1.5;
        }

        /* Map */
        .conf-map {
            width: 560px;
            height: 242.162px;
            aspect-ratio: 37/16;
            margin: 0 auto 1.5rem auto;
        }

        .conf-map img {
            width: 560px;
            height: 242.162px;
            aspect-ratio: 37/16;
            object-fit: cover;
            border-radius: 8px;
        }

        /* Amenities */
        .conf-amenities h4 {
            color: #3B3731;
            font-family: Lato;
            font-size: 18px;
            font-style: normal;
            font-weight: 600;
            line-height: normal;
        }

        .conf-amenities-list {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            margin: 20px 0;
        }

        .conf-amenity-pill {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: #EBEBEB;
            border-radius: 20px;
            padding: 6px 14px;
            color: #3B3731;
            font-family: Lato;
            font-size: 14px;
            font-style: normal;
            font-weight: 500;
            line-height: normal;
        }

        .conf-amenities-footer {
            color: #3B3731;
            font-family: Lato;
            font-size: 14px;
            font-style: normal;
            font-weight: 400;
            line-height: normal;
        }

        /* What happens next */
        .conf-next {
            margin: 40px 0;
        }

        .conf-next h3 {
            color: #3B3731;
            font-family: Lato;
            font-size: 20px;
            font-style: normal;
            font-weight: 600;
            line-height: normal;
        }

        .conf-next ul {
            margin: 20px 0 35px 0;
            padding-left: 20px;
            color: #9D9B98;
            font-family: Lato;
            font-size: 18px;
            font-style: normal;
            font-weight: 400;
            line-height: normal;
        }

        .conf-next li {
            list-style-type: disc;
        }

        .conf-btn-container {
            text-align: center;
        }

        .conf-view-btn {
            width: 295px;
            height: 48px;
            border-radius: 75px;
            background: #C9DDA0;
            color: #FFF;
            text-align: center;
            font-family: Lato;
            font-size: 18px;
            font-style: normal;
            font-weight: 600;
            line-height: normal;
            border: none;
            cursor: pointer;
        }

        .conf-view-btn:hover {
            color: #FFF;
        }

        /* Bottom groomer box */
        .conf-groomer-box {
            width: 1320px;
            height: 245px;
            border-radius: 10px;
            background: rgba(255, 201, 122, 0.13);
            margin: 0 auto;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .conf-groomer-icon {
            display: inline-flex;
            justify-content: center;
            margin-bottom: 12px;
        }

        .conf-groomer-box h3 {
            color: #3B3731;
            text-align: center;
            font-family: Lato;
            font-size: 28px;
            font-style: normal;
            font-weight: 600;
            line-height: normal;
        }

        .conf-groomer-box p {
            color: #9D9B98;
            font-family: Lato;
            font-size: 16px;
            font-style: normal;
            font-weight: 400;
            line-height: normal;
        }

        .conf-groomer-box p>a {
            color: #9D9B98 !important;
            font-family: Lato;
            font-size: 16px;
            font-style: normal;
            font-weight: 400;
            line-height: normal;
            text-decoration-line: underline;
            text-decoration-style: solid;
            text-decoration-skip-ink: auto;
            text-decoration-thickness: auto;
            text-underline-offset: auto;
            text-underline-position: from-font;
        }

        .conf-find-btn {
            width: 295px;
            height: 48px;
            border-radius: 75px;
            border: 1px solid #3B3731;
            background: #FFF;
            color: #3B3731;
            text-align: center;
            font-family: Lato;
            font-size: 18px;
            font-style: normal;
            font-weight: 400;
            line-height: normal;
            margin-top: 20px;
        }

        .conf-find-btn:hover {
            background: #f8f8f8;
            color: #3B3731;
        }
    </style>
</head>

<body>
    <?php include '../components/header.php'; ?>

    <section class="conf-wrapper">
        <div class="conf-header">
            <div class="conf-main-icon">
                <svg width="102" height="96" viewBox="0 0 102 96" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M5.00624 35.7656C4.80225 39.4422 4.80225 43.8162 4.80225 49.0709V57.3825C4.80225 73.054 4.80686 80.8877 10.2136 85.7583C15.6204 90.6289 24.3285 90.6289 41.74 90.6289H60.2088C77.6204 90.6289 86.3238 90.6247 91.7352 85.7583C97.1466 80.8918 97.1466 73.054 97.1466 57.3825V49.0709C97.1466 43.8157 97.146 39.4419 96.9415 35.7656H5.00624Z"
                        fill="#F2F6F9" />
                    <path
                        d="M36.309 63.5009L46.2331 73.425L65.4018 54.2563C66.3025 53.3556 66.3051 51.8961 65.4076 50.9922C64.5056 50.0838 63.0372 50.0812 62.132 50.9864L46.2331 66.8852L39.5673 60.2381C38.6666 59.3398 37.2085 59.3408 36.309 60.2403C35.4086 61.1407 35.4086 62.6005 36.309 63.5009Z"
                        fill="#CBDCE8" />
                    <path
                        d="M1 46.4721C1 28.4229 0.999999 19.396 6.86 13.7912C12.72 8.18643 22.145 8.18164 41 8.18164H61C79.855 8.18164 89.285 8.18164 95.14 13.7912C100.995 19.4007 101 28.4229 101 46.4721V56.0447C101 74.0938 101 83.1208 95.14 88.7256C89.28 94.3303 79.855 94.3351 61 94.3351H41C22.145 94.3351 12.715 94.3351 6.86 88.7256C1.005 83.116 1 74.0938 1 56.0447V46.4721Z"
                        stroke="#3B3731" stroke-width="2" />
                    <path d="M25.244 8.14517V1M76.7052 8.14517V1M2.08643 31.9624H99.8628" stroke="#3B3731"
                        stroke-width="2" stroke-linecap="round" />
                </svg>

            </div>
            <h1>Your space booking is <i>confirmed!</i></h1>
            <p>Your grooming space at [Space Name] has been successfully reserved for the time below.</p>
        </div>

        <div class="conf-card">
            <div class="conf-card-header">
                <h2>Booking Details</h2>
            </div>
            <div class="conf-card-body">
                <div class="conf-host-info">
                    <div class="conf-host-img-container">
                        <div class="conf-img-icon">
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
                                <path d="M6.83325 13.4703C6.83325 13.4703 8.22214 13.7392 9.61103 12.667" stroke="white"
                                    stroke-linecap="round" stroke-linejoin="round" />
                                <path
                                    d="M9.05564 8.36144C9.05564 8.54561 8.98247 8.72225 8.85224 8.85248C8.72201 8.98272 8.54537 9.05588 8.36119 9.05588C8.17701 9.05588 8.00038 8.98272 7.87015 8.85248C7.73991 8.72225 7.66675 8.54561 7.66675 8.36144C7.66675 8.17726 7.73991 8.00062 7.87015 7.87039C8.00038 7.74016 8.17701 7.66699 8.36119 7.66699C8.54537 7.66699 8.72201 7.74016 8.85224 7.87039C8.98247 8.00062 9.05564 8.17726 9.05564 8.36144Z"
                                    fill="#CBDCE8" stroke="white" />
                                <path d="M10.4443 6.55566V6.61122V6.55566Z" fill="#CBDCE8" />
                                <path d="M10.4443 6.55566V6.61122" stroke="white" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                        </div>
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="255" height="129" viewBox="0 0 255 129"
                                fill="none">

                                <defs>
                                    <pattern id="pattern0" patternUnits="objectBoundingBox" width="1" height="1">
                                        <image href="<?= BASE_URL ?>/assets/images/login-page.png" width="255"
                                            height="129" preserveAspectRatio="xMidYMid slice" />
                                    </pattern>
                                </defs>

                                <path
                                    d="M255 124C255 126.761 252.761 129 250 129H5C2.23858 129 0 126.761 0 124V37C0 34.2386 2.23858 32 5 32H27C29.7614 32 32 29.7614 32 27V5C32 2.23858 34.2386 0 37 0H250C252.761 0 255 2.23858 255 5V124Z"
                                    fill="url(#pattern0)" />

                            </svg>
                        </div>
                        <div>
                            <p>Furs & Co. Studio</p>
                            <p>Hosted by<span> Dev É.</span></p>
                            <div class="conf-host-tag">
                                <span>Garden / Shed</span>
                            </div>
                        </div>
                    </div>

                    <div class="conf-grid">
                        <div class="conf-grid-item">
                            <div class="conf-grid-label">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                    <circle cx="12" cy="10" r="3"></circle>
                                </svg>
                                Location
                            </div>
                            <div class="conf-grid-value">Victoria Embankment</div>
                        </div>
                        <div class="conf-grid-item" style="padding-left: 10px;">
                            <div class="conf-grid-label">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                    <line x1="16" y1="2" x2="16" y2="6"></line>
                                    <line x1="8" y1="2" x2="8" y2="6"></line>
                                    <line x1="3" y1="10" x2="21" y2="10"></line>
                                </svg>
                                Date
                            </div>
                            <div class="conf-grid-value">18/12/2025</div>
                        </div>
                        <div class="conf-grid-item" style="padding-left: 10px;">
                            <div class="conf-grid-label">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <polyline points="12 6 12 12 16 14"></polyline>
                                </svg>
                                Time
                            </div>
                            <div class="conf-grid-value">14:30 - 15:30 (90 mins)</div>
                        </div>
                    </div>

                    <div class="conf-access-box">
                        <h4>Access Information</h4>
                        <p>You'll receive the exact address and access instructions closer to your booking time via
                            email
                            and in your booking details.</p>
                    </div>

                    <div class="conf-map">
                        <img src="<?= BASE_URL ?>/assets/images/map.png" alt="Map" />
                    </div>

                    <div class="conf-amenities">
                        <h4>Amenities Include</h4>
                        <div class="conf-amenities-list">
                            <?php
                            $amenities = [
                                'Grooming Table',
                                'Bath',
                                'Dryer',
                                'Towels',
                                'Waiting area',
                                'Parking',
                                'Wi-Fi'
                            ];
                            foreach ($amenities as $amenity):
                                ?>
                                <div class="conf-amenity-pill">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="9" viewBox="0 0 12 9"
                                        fill="none">
                                        <path d="M0.75 4.75L4.25 8.25L11.25 0.75" stroke="#3B3731" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <?= $amenity ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <p class="conf-amenities-footer">Extra towels · Premium shampoos · Drying crates · Tool storage
                            (where available).</p>
                    </div>
                </div>
            </div>

            <div class="conf-next">
                <h3>What happens next?</h3>
                <ul>
                    <li>Your booking is secured for the selected time.</li>
                    <li>You can manage or cancel your booking from your account.</li>
                </ul>
                <div class="conf-btn-container">
                    <button class="conf-view-btn">View Booking</button>
                </div>
            </div>


        </div>

    </section>
    <div class="conf-groomer-box">
        <div class="conf-groomer-icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="84" height="52" viewBox="0 0 84 52" fill="none">
                <rect x="11.8813" y="2" width="50.0001" height="17.8218" rx="8.91091" fill="#FFC97A" />
                <rect y="19.3271" width="50.0001" height="17.3268" rx="8.66339" fill="#FFC97A" />
                <rect x="25.2476" y="34.1777" width="50.0001" height="17.8218" rx="8.91091" fill="#FFC97A" />
                <path
                    d="M37.5 27.5448C34.2602 27.5448 31.4854 26.3909 29.1754 24.0831C26.8654 21.7754 25.7117 19.0045 25.7143 15.7705C25.7169 12.5365 26.8706 9.76298 29.1754 7.44998C31.4801 5.13699 34.255 3.98703 37.5 4.00011C40.745 4.01319 43.5199 5.16446 45.8246 7.45391C48.1294 9.74335 49.2831 12.5169 49.2857 15.7744C49.2883 19.032 48.1346 21.8029 45.8246 24.0871C43.5146 26.3713 40.7398 27.5212 37.5 27.5448ZM10 47.9261V45.5712C10 43.9045 10.4806 42.3726 11.4418 40.9753C12.403 39.5781 13.6654 38.4883 15.2289 37.706C18.7542 36.0445 22.3815 34.7415 26.1111 33.7969C29.8406 32.8524 33.6421 32.3788 37.5157 32.3762C41.3893 32.3736 45.1856 32.8471 48.9046 33.7969C52.6237 34.7467 56.2458 36.0498 59.7711 37.706C61.3346 38.4857 62.597 39.5755 63.5582 40.9753C64.5194 42.3752 65 43.9058 65 45.5673V47.9222C65 49.0734 64.6085 50.0415 63.8254 50.8265C63.0423 51.6088 62.0732 52 60.9182 52H14.0857C12.9307 52 11.9617 51.6075 11.1786 50.8226C10.3929 50.0402 10 49.0774 10 47.9261ZM37.5 23.62C39.6607 23.62 41.5111 22.8508 43.0511 21.3123C44.5911 19.7737 45.3598 17.9265 45.3571 15.7705C45.3545 13.6145 44.5858 11.7659 43.0511 10.2248C41.5163 8.68367 39.666 7.91572 37.5 7.92095C35.334 7.92619 33.485 8.69413 31.9529 10.2248C30.4207 11.7555 29.6507 13.604 29.6429 15.7705C29.635 17.937 30.405 19.7842 31.9529 21.3123C33.5007 22.8403 35.3498 23.6096 37.5 23.62ZM50.9475 38.3654V48.0752H61.0714V45.5359C61.0714 44.5652 60.7571 43.7109 60.1286 42.973C59.5 42.2352 58.7562 41.6255 57.8971 41.1441C56.7788 40.5685 55.6369 40.0569 54.4714 39.6095C53.306 39.1621 52.1313 38.7474 50.9475 38.3654ZM27.9811 37.3645V42.1881H47.0189V37.3606C45.458 36.9995 43.8774 36.7327 42.2771 36.56C40.6795 36.3873 39.0819 36.3009 37.4843 36.3009C35.8814 36.3009 34.2877 36.3873 32.7032 36.56C31.1187 36.7327 29.5446 37.0009 27.9811 37.3645ZM13.9286 48.0752H24.0525V38.3654C22.8687 38.7448 21.694 39.1595 20.5286 39.6095C19.3631 40.0596 18.2212 40.5711 17.1029 41.1441C16.2464 41.6229 15.5039 42.2326 14.8754 42.973C14.2442 43.7109 13.9286 44.5652 13.9286 45.5359V48.0752Z"
                    fill="#3B3731" />
                <path
                    d="M79.5056 12.1945L75.0523 10.0763C74.2465 9.69593 73.7499 10.8177 74.5276 11.1796L78.9809 13.2977L78.7116 13.8639L74.2583 11.7457C73.4612 11.3586 72.9642 12.4795 73.7335 12.849L78.1868 14.9672L77.9116 15.5457L73.4584 13.4276C72.6582 13.047 72.1615 14.1672 72.9336 14.5308L77.3869 16.649L77.1246 17.2003L72.6713 15.0822C71.8853 14.7148 71.3714 15.8283 72.1404 16.1985L76.5937 18.3166L76.3309 18.8692L71.8776 16.751C71.0952 16.376 70.5661 17.4801 71.3528 17.8543L75.8061 19.9724L75.5439 20.5238L71.0906 18.4056C70.3059 18.0353 69.7763 19.1406 70.5655 19.5095L75.0188 21.6277L74.7501 22.1926L70.2968 20.0745C69.5164 19.6953 68.9873 20.7994 69.7721 21.1777L74.2253 23.2959L73.9637 23.8461L69.5104 21.7279C68.7271 21.3546 68.2129 22.4687 68.9853 22.8318L73.4386 24.9499L68.3291 35.6923C67.5531 37.3304 70.2599 38.5816 71.0321 36.9779L82.9891 11.8391C83.3371 11.0877 83.1217 9.82603 82.0289 9.3026L76.6396 6.73924C75.8346 6.35709 75.338 7.47884 76.1148 7.84252L80.5616 9.97428L80.3 10.5244L75.8467 8.40629C75.045 8.02061 74.5486 9.14176 75.3216 9.51016L79.7749 11.6283L79.5056 12.1945ZM65.6875 28.9757C66.5938 27.0637 65.4263 23.9884 62.2306 24.1005L65.7067 16.7922L69.7823 3.9506C69.8993 3.61529 69.6423 3.4009 69.4481 3.30202C69.2425 3.21075 68.8 3.09238 68.6041 3.39021L61.222 14.6591L57.7459 21.9674C55.8163 19.4175 52.7569 20.4983 51.8606 22.381C51.0644 24.0566 51.8066 26.0969 53.6985 26.9917C55.6006 27.9015 57.7039 27.0108 58.4217 25.5017L62.0326 17.91L62.6732 18.2147L59.0624 25.8064C58.2587 27.4959 59.0811 29.4206 60.6181 30.2489C60.1512 31.1628 59.85 32.6401 60.217 33.4573C60.6471 34.4163 61.8817 34.0388 61.8335 33.2302C61.7762 32.4718 61.6098 31.9595 62.5007 30.7867C63.8667 30.8416 65.1109 30.1813 65.6875 28.9757ZM54.4989 25.4972C54.0669 25.2917 53.7279 24.9362 53.5566 24.5089C53.3853 24.0815 53.3957 23.6173 53.5854 23.2184C53.7751 22.8195 54.1287 22.5185 54.5683 22.3818C55.008 22.245 55.4977 22.2836 55.9297 22.4891C56.8154 22.9162 57.2188 23.9328 56.8316 24.7635C56.6414 25.1594 56.29 25.4583 55.8535 25.5957C55.4169 25.733 54.9302 25.6976 54.4989 25.4972ZM60.705 26.6059C60.8953 26.2097 61.2468 25.9105 61.6836 25.7729C62.1204 25.6353 62.6074 25.6704 63.0392 25.8706C63.4672 26.079 63.8019 26.4346 63.9707 26.8603C64.1395 27.286 64.1289 27.7476 63.9411 28.145C63.7516 28.5416 63.4003 28.8411 62.9635 28.9785C62.5266 29.1159 62.0396 29.0801 61.6084 28.8788C61.1805 28.6707 60.8458 28.3155 60.6768 27.8901C60.5077 27.4647 60.5178 27.0033 60.705 26.6059Z"
                    fill="#3B3731" />
            </svg>
        </div>
        <h3>Need a Groomer?</h3>
        <p>You can book one separately on <a href="#" style="color:#3B3731;">FursGo</a>.</p>
        <button class="conf-find-btn">Find a Groomer</button>
    </div>

    <?php include '../components/footer.php'; ?>
</body>

</html>