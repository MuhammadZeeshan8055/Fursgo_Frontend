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
            margin-bottom: 30px !important;
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
            display: flex;
            gap: 1rem;
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

        .conf-msg-btn {
            background: transparent;
            width: 295px;
            height: 48px;
            color: #3B3731;
            text-align: center;
            font-family: Lato;
            font-size: 18px;
            font-style: normal;
            font-weight: 400;
            line-height: normal;
            border-radius: 75px;
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
            <h1>Your grooming session is <i>confirmed!</i></h1>
            <p style="margin-bottom: 0;">Your grooming session with [Groomer Name] &<br>your selected space at [Space
                name] has been successfully confirmed.</p>
            <p style="margin-top: 1rem;">Everything is scheduled and synced for the same time slot.</p>
        </div>

        <div class="conf-card">
            <div class="conf-card-header">
                <h2>Groomer Details</h2>
            </div>
            <div class="conf-card-body" style="border-radius: 0 0 12px 12px; padding-bottom: 24px;">
                <div class="conf-host-info" style="margin-bottom: 0;">
                    <div class="conf-host-img-container"
                        style="align-items: center; justify-content: flex-start; margin-bottom: 24px;">
                        <div class="conf-img-icon"
                            style="top: -25px; left: 7px; transform: none; position: relative; margin-right: -20px; z-index: 1;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="33" height="36" viewBox="0 0 33 36"
                                fill="none">
                                <ellipse cx="17.5579" cy="18.2806" rx="10.3587" ry="9.74934" fill="white" />
                                <path
                                    d="M17.0792 0.204724C16.7961 0.0705945 16.4928 0 16.176 0C15.8592 0 15.5559 0.0705945 15.2729 0.204724L2.58145 5.84523C1.09865 6.50176 -0.00670934 8.03366 3.06568e-05 9.88323C0.0337307 16.8862 2.78365 29.6991 14.3967 35.5232C15.5222 36.0879 16.8298 36.0879 17.9554 35.5232C29.5684 29.6991 32.3183 16.8862 32.352 9.88323C32.3588 8.03366 31.2534 6.50176 29.7706 5.84523L17.0792 0.204724ZM9.76629 20.2041C10.0898 20.2889 10.4335 20.3312 10.784 20.3312C13.1632 20.3312 15.0976 18.3052 15.0976 15.8132V11.2951H18.0767C18.8922 11.2951 19.6404 11.7752 20.0043 12.5446L20.4896 13.5541H24.8032C25.3963 13.5541 25.8816 14.0624 25.8816 14.6837V16.9427C25.8816 20.063 23.4687 22.5902 20.4896 22.5902H17.2544V26.1694C17.2544 26.6847 16.8568 27.1083 16.358 27.1083C16.2367 27.1083 16.1154 27.0801 16.0075 27.0306L9.35515 24.0445C8.91031 23.8468 8.62723 23.388 8.62723 22.8867C8.62723 22.6891 8.66767 22.4985 8.75529 22.322L9.76629 20.2041ZM9.70563 11.2951H12.9408V15.8132C12.9408 17.0627 11.977 18.0722 10.784 18.0722C9.59105 18.0722 8.62723 17.0627 8.62723 15.8132V12.4246C8.62723 11.8034 9.11251 11.2951 9.70563 11.2951ZM18.3328 14.6837C18.3328 14.3841 18.2192 14.0968 18.017 13.885C17.8147 13.6731 17.5404 13.5541 17.2544 13.5541C16.9684 13.5541 16.6941 13.6731 16.4919 13.885C16.2896 14.0968 16.176 14.3841 16.176 14.6837C16.176 14.9832 16.2896 15.2705 16.4919 15.4823C16.6941 15.6942 16.9684 15.8132 17.2544 15.8132C17.5404 15.8132 17.8147 15.6942 18.017 15.4823C18.2192 15.2705 18.3328 14.9832 18.3328 14.6837Z"
                                    fill="#C9DDA0" />
                            </svg>
                        </div>
                        <img src="<?= BASE_URL ?>/assets/images/profile-img-1.png"
                            style="width: 100px; height: 100px; border-radius: 50%; object-fit: cover; z-index: 0;"
                            alt="">
                        <div style="margin-left: 1.5rem;">
                            <p
                                style="color: #3B3731; font-family: Lato; font-size: 18px; font-weight: 600; margin: 0 0 4px 0;">
                                Sarah’s Grooming Studio</p>
                            <p
                                style="color: #9D9B98; font-family: Lato; font-size: 18px; font-weight: 400; margin: 0 0 8px 0;">
                                Sarah W.</p>
                            <div class="conf-host-tag" style="background: #FFC97A;">
                                <span>Home Visits</span>
                            </div>
                        </div>
                    </div>

                    <div class="conf-grid">
                        <div class="conf-grid-item">
                            <div class="conf-grid-label" style="display: flex; align-items: center; gap: 8px;">
                                <svg width="16" height="17" viewBox="0 0 16 17" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M4.94591 11.5544C6.23114 12.8397 9.35699 11.798 11.9274 9.22713C14.4983 6.65667 15.54 3.53082 14.2548 2.24559M8.72754 1.37259L9.30927 1.95473M6.6915 3.40904L7.27322 3.99077M4.9455 5.73636L5.52722 6.31809M4.36377 8.6454L4.9455 9.22713M11.9274 0.5L12.5092 1.08173M11.3457 3.99118L12.5092 5.15463M9.30968 6.02763L10.4731 7.19109M6.98236 7.77281L8.14581 8.93627"
                                        stroke="#3B3731" stroke-linecap="round" stroke-linejoin="round" />
                                    <path
                                        d="M4.94547 13.2998C5.42747 12.8178 5.42747 12.0364 4.94548 11.5544C4.46348 11.0724 3.68202 11.0724 3.20003 11.5544L0.872775 13.8816C0.390784 14.3636 0.390784 15.1451 0.872775 15.6271C1.35477 16.1091 2.13623 16.1091 2.61822 15.6271L4.94547 13.2998Z"
                                        stroke="#3B3731" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>

                                Service
                            </div>
                            <div class="conf-grid-value">Full Groom</div>
                        </div>
                        <div class="conf-grid-item" style="padding-left: 10px;">
                            <div class="conf-grid-label" style="display: flex; align-items: center; gap: 8px;">
                                <svg width="19" height="17" viewBox="0 0 19 17" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M0.5 8.29456C0.5 5.20041 0.5 3.65293 1.50457 2.69211C2.50914 1.73129 4.12486 1.73047 7.35714 1.73047H10.7857C14.018 1.73047 15.6346 1.73047 16.6383 2.69211C17.642 3.65375 17.6429 5.20041 17.6429 8.29456V9.93559C17.6429 13.0297 17.6429 14.5772 16.6383 15.538C15.6337 16.4989 14.018 16.4997 10.7857 16.4997H7.35714C4.12486 16.4997 2.50829 16.4997 1.50457 15.538C0.500857 14.5764 0.5 13.0297 0.5 9.93559V8.29456Z"
                                        stroke="#3B3731" />
                                    <path d="M4.78585 1.73077V0.5M13.3573 1.73077V0.5M0.928711 5.83333H17.2144"
                                        stroke="#3B3731" stroke-linecap="round" />
                                    <path
                                        d="M14.2139 12.3975C14.2139 12.6151 14.1236 12.8238 13.9629 12.9777C13.8021 13.1315 13.5841 13.218 13.3568 13.218C13.1295 13.218 12.9114 13.1315 12.7507 12.9777C12.59 12.8238 12.4997 12.6151 12.4997 12.3975C12.4997 12.1799 12.59 11.9712 12.7507 11.8173C12.9114 11.6634 13.1295 11.577 13.3568 11.577C13.5841 11.577 13.8021 11.6634 13.9629 11.8173C14.1236 11.9712 14.2139 12.1799 14.2139 12.3975ZM14.2139 9.11543C14.2139 9.33305 14.1236 9.54175 13.9629 9.69562C13.8021 9.8495 13.5841 9.93595 13.3568 9.93595C13.1295 9.93595 12.9114 9.8495 12.7507 9.69562C12.59 9.54175 12.4997 9.33305 12.4997 9.11543C12.4997 8.89782 12.59 8.68912 12.7507 8.53524C12.9114 8.38137 13.1295 8.29492 13.3568 8.29492C13.5841 8.29492 13.8021 8.38137 13.9629 8.53524C14.1236 8.68912 14.2139 8.89782 14.2139 9.11543ZM9.92822 12.3975C9.92822 12.6151 9.83792 12.8238 9.67717 12.9777C9.51643 13.1315 9.29841 13.218 9.07108 13.218C8.84375 13.218 8.62573 13.1315 8.46499 12.9777C8.30424 12.8238 8.21394 12.6151 8.21394 12.3975C8.21394 12.1799 8.30424 11.9712 8.46499 11.8173C8.62573 11.6634 8.84375 11.577 9.07108 11.577C9.29841 11.577 9.51643 11.6634 9.67717 11.8173C9.83792 11.9712 9.92822 12.1799 9.92822 12.3975ZM9.92822 9.11543C9.92822 9.33305 9.83792 9.54175 9.67717 9.69562C9.51643 9.8495 9.29841 9.93595 9.07108 9.93595C8.84375 9.93595 8.62573 9.8495 8.46499 9.69562C8.30424 9.54175 8.21394 9.33305 8.21394 9.11543C8.21394 8.89782 8.30424 8.68912 8.46499 8.53524C8.62573 8.38137 8.84375 8.29492 9.07108 8.29492C9.29841 8.29492 9.51643 8.38137 9.67717 8.53524C9.83792 8.68912 9.92822 8.89782 9.92822 9.11543ZM5.64251 12.3975C5.64251 12.6151 5.5522 12.8238 5.39146 12.9777C5.23071 13.1315 5.01269 13.218 4.78537 13.218C4.55804 13.218 4.34002 13.1315 4.17927 12.9777C4.01853 12.8238 3.92822 12.6151 3.92822 12.3975C3.92822 12.1799 4.01853 11.9712 4.17927 11.8173C4.34002 11.6634 4.55804 11.577 4.78537 11.577C5.01269 11.577 5.23071 11.6634 5.39146 11.8173C5.5522 11.9712 5.64251 12.1799 5.64251 12.3975ZM5.64251 9.11543C5.64251 9.33305 5.5522 9.54175 5.39146 9.69562C5.23071 9.8495 5.01269 9.93595 4.78537 9.93595C4.55804 9.93595 4.34002 9.8495 4.17927 9.69562C4.01853 9.54175 3.92822 9.33305 3.92822 9.11543C3.92822 8.89782 4.01853 8.68912 4.17927 8.53524C4.34002 8.38137 4.55804 8.29492 4.78537 8.29492C5.01269 8.29492 5.23071 8.38137 5.39146 8.53524C5.5522 8.68912 5.64251 8.89782 5.64251 9.11543Z"
                                        fill="#3B3731" />
                                </svg>

                                Date
                            </div>
                            <div class="conf-grid-value">18/12/2025</div>
                        </div>
                        <div class="conf-grid-item" style="padding-left: 10px;">
                            <div class="conf-grid-label" style="display: flex; align-items: center; gap: 8px;">
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

                    <div
                        style="background: #F4F7FB; border-radius: 8px; padding: 24px; display: flex; gap: 20px; margin-top: 24px;">
                        <div style="display: flex; align-items: center; gap: 15px; flex: 1;">
                            <img src="<?= BASE_URL ?>/assets/images/dog2.png"
                                onerror="this.src='<?= BASE_URL ?>/assets/images/dog.png';"
                                style="width: 60px; height: 60px; border-radius: 50%; object-fit: cover; background: #EAE8E5;"
                                alt="">
                            <div>
                                <p
                                    style="font-size: 16px; font-weight: 600; color: #3B3731; margin: 0 0 4px 0; display: flex; align-items: center; gap: 6px;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 18 17"
                                        fill="none">
                                        <path
                                            d="M3.75 6.02083C4.57843 6.02083 5.25 5.34926 5.25 4.52083C5.25 3.69241 4.57843 3.02083 3.75 3.02083C2.92157 3.02083 2.25 3.69241 2.25 4.52083C2.25 5.34926 2.92157 6.02083 3.75 6.02083Z"
                                            stroke="#3B3731" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path
                                            d="M14.25 6.02083C15.0784 6.02083 15.75 5.34926 15.75 4.52083C15.75 3.69241 15.0784 3.02083 14.25 3.02083C13.4216 3.02083 12.75 3.69241 12.75 4.52083C12.75 5.34926 13.4216 6.02083 14.25 6.02083Z"
                                            stroke="#3B3731" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path
                                            d="M6 3.77083C6.82843 3.77083 7.5 3.09926 7.5 2.27083C7.5 1.44241 6.82843 0.770833 6 0.770833C5.17157 0.770833 4.5 1.44241 4.5 2.27083C4.5 3.09926 5.17157 3.77083 6 3.77083Z"
                                            stroke="#3B3731" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path
                                            d="M12 3.77083C12.8284 3.77083 13.5 3.09926 13.5 2.27083C13.5 1.44241 12.8284 0.770833 12 0.770833C11.1716 0.770833 10.5 1.44241 10.5 2.27083C10.5 3.09926 11.1716 3.77083 12 3.77083Z"
                                            stroke="#3B3731" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path
                                            d="M9.00003 16.5208C12.6395 16.5208 14.8893 12.5923 14.9961 10.43C15.011 10.1265 14.7831 9.86616 14.4828 9.83177L9.00003 9.20456L3.51731 9.83177C3.21695 9.86616 2.98906 10.1265 3.004 10.43C3.11075 12.5923 5.36053 16.5208 9.00003 16.5208Z"
                                            stroke="#3B3731" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                    Louis
                                </p>
                                <p style="font-size: 14px; color: #3B3731; margin: 0;">Dog • Labrador</p>
                            </div>
                        </div>

                        <div style="display: flex; align-items: center; gap: 15px; flex: 1;">
                            <img src="<?= BASE_URL ?>/assets/images/pet_details_1.png"
                                style="width: 60px; height: 60px; border-radius: 50%; object-fit: cover; background: #EAE8E5;"
                                alt="">
                            <div>
                                <p
                                    style="font-size: 16px; font-weight: 600; color: #3B3731; margin: 0 0 4px 0; display: flex; align-items: center; gap: 6px;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 18 17"
                                        fill="none">
                                        <path
                                            d="M3.75 6.02083C4.57843 6.02083 5.25 5.34926 5.25 4.52083C5.25 3.69241 4.57843 3.02083 3.75 3.02083C2.92157 3.02083 2.25 3.69241 2.25 4.52083C2.25 5.34926 2.92157 6.02083 3.75 6.02083Z"
                                            stroke="#3B3731" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path
                                            d="M14.25 6.02083C15.0784 6.02083 15.75 5.34926 15.75 4.52083C15.75 3.69241 15.0784 3.02083 14.25 3.02083C13.4216 3.02083 12.75 3.69241 12.75 4.52083C12.75 5.34926 13.4216 6.02083 14.25 6.02083Z"
                                            stroke="#3B3731" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path
                                            d="M6 3.77083C6.82843 3.77083 7.5 3.09926 7.5 2.27083C7.5 1.44241 6.82843 0.770833 6 0.770833C5.17157 0.770833 4.5 1.44241 4.5 2.27083C4.5 3.09926 5.17157 3.77083 6 3.77083Z"
                                            stroke="#3B3731" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path
                                            d="M12 3.77083C12.8284 3.77083 13.5 3.09926 13.5 2.27083C13.5 1.44241 12.8284 0.770833 12 0.770833C11.1716 0.770833 10.5 1.44241 10.5 2.27083C10.5 3.09926 11.1716 3.77083 12 3.77083Z"
                                            stroke="#3B3731" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path
                                            d="M9.00003 16.5208C12.6395 16.5208 14.8893 12.5923 14.9961 10.43C15.011 10.1265 14.7831 9.86616 14.4828 9.83177L9.00003 9.20456L3.51731 9.83177C3.21695 9.86616 2.98906 10.1265 3.004 10.43C3.11075 12.5923 5.36053 16.5208 9.00003 16.5208Z"
                                            stroke="#3B3731" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                    Bella
                                </p>
                                <p style="font-size: 14px; color: #3B3731; margin: 0;">Rabbit • Mini Lop</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="conf-card">
            <div class="conf-card-header">
                <h2>Space Details</h2>
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
                    <li>The groomer and space host have both been notified.</li>
                    <li>You’ll receive the exact address and access instructions closer to your booking time via email
                        and in your booking details.</li>
                    <li>You can manage or cancel your bookings from your account.</li>
                </ul>
                <div class="conf-btn-container">
                    <button class="conf-msg-btn">Message Groomer</button>
                    <button class="conf-view-btn">View Booking</button>
                </div>
            </div>


        </div>

    </section>

    <?php include '../components/footer.php'; ?>
</body>

</html>