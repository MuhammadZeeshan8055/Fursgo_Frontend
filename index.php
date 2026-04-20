<?php include 'function_helper.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FursGo</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/responsive.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/bootstrap.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/media_query.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/common.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        /* Fixed button bottom left */
        #chat-btn {
            position: fixed;
            bottom: 44px;
            z-index: 1001;
            cursor: pointer;
            border: none;
            background: #FFC97A;
            padding: 20px;
            border-radius: 100px;
            width: 60px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Chat panel */
        #chat-panel {
            position: fixed;
            bottom: 130px;
            border-radius: 16px;
            display: none;
            flex-direction: column;
            overflow: hidden;
        }

        #chat-panel.open {
            display: flex;
        }

        /* Header */
        .chat-header {
            background: #F5A05A;
            color: white;
            padding: 14px 16px;
            font-weight: bold;
            font-size: 15px;
        }

        /* Body - place your divs here */
        .chat-body {
            padding: 16px;
            background: #fafafa;
            min-height: 200px;
        }

        .need-help-chat {
            border-radius: 103px;
            background: #FFC97A;
            box-shadow: 0 10px 20px 2px rgba(0, 0, 0, 0.05);
            align-items: center;
            justify-content: space-between;
            padding: 15px;
            width: 295px;
            color: #FFF;
            text-align: center;
            font-family: Lato;
            font-size: 16px;
            font-style: normal;
            font-weight: 600;
            line-height: normal;
            position: fixed;
            bottom: 50px;
            z-index: 1001;
            cursor: pointer;
            left: calc((100vw - 1140px) / 2);
        }

        .need-help-chat {
            display: flex;
            /* always in layout */
            opacity: 0;
            visibility: hidden;
            transform: translateY(10px);
            transition: all 0.3s ease;
        }

        /* Hover effect */
        #chat-btn:hover+.need-help-chat,
        .need-help-chat:hover {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        /* Overlay behind chat panel */
        body.chat-open::before {
            content: "";
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: #0000009e;
            z-index: 12;
            backdrop-filter: blur(2px);
        }

        /* Chat panel above overlay */
        #chat-panel {
            position: fixed;
            z-index: 12;
            /* higher than overlay */
        }

        body.chat-open #chat-btn:hover+.need-help-chat,
        body.chat-open .need-help-chat:hover {
            opacity: 0;
            visibility: hidden;
            transform: translateY(10px);
        }

        /* card styles */
        /* Base Card Styling */
        .fs-card {
            width: 400px;
            height: 550px;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            display: flex;
            flex-direction: column;
            border: 1px solid #ffc97a;
            box-shadow: 0 10px 20px 2px rgba(0, 0, 0, 0.05);
        }

        /* Header */
        .fs-card-header {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 16px;
            padding: 20px;
            color: #fff;
            font-family: Lato;
            font-size: 20px;
            font-style: normal;
            font-weight: 600;
            line-height: normal;
            text-align: center;
            border-radius: 10px 10px 0 0;
            border: 1px solid #ffc97a;
            background: #ffc97a;
            z-index: 1000;
        }

        .fs-back-arrow {
            position: relative;
            right: 4.5rem;
            display: flex;
            align-items: center;
            cursor: pointer;
            font-size: 14px;
        }

        /* Body & Backgrounds */
        .fs-card-body {
            margin-top: -3rem;
            padding: 20px;
            /* flex-grow: 1; */
        }

        .fs-2 {
            padding: 12px;
            margin-top: 0;
            padding-left: 1.1rem;
        }

        .fs-gradient-bg {
            background: linear-gradient(180deg, #ffc97a 0%, #fff 75%);
        }

        /* Card 1 Specifics */

        .fs-welcome-text {
            margin-top: 5rem;
        }

        .fs-welcome-text h2 {
            color: #fff;
            font-family: Lato;
            font-size: 30px;
            font-style: normal;
            font-weight: 500;
            line-height: normal;
            margin: 0;
        }

        .fs-welcome-text p {
            color: #fff;
            font-family: Lato;
            font-size: 22px;
            font-style: normal;
            font-weight: 500;
            line-height: normal;
            margin: 0;
        }

        .fs-content {
            display: flex;
            align-items: center;
            gap: 1.2rem;
        }

        .fs-menu-list {
            border-radius: 10px;
            border: 1px solid #e2e2e2;
            background: #fff;
            box-shadow: 0 10px 20px 2px rgba(0, 0, 0, 0.03);
            margin-top: 1.5rem;
        }

        .fs-menu-item {
            display: flex;
            justify-content: space-between;
            padding: 18px 15px;
            /* border-radius: 10px; */
            border-bottom: 1px solid #f0f0f0;
            color: #3b3731;
            text-align: center;
            font-family: Lato;
            font-size: 16px;
            font-style: normal;
            font-weight: 400;
            line-height: normal;
            cursor: pointer;
            transition: 0.2s;
        }

        .fs-menu-item:hover {
            background-color: #fff8e1;
        }

        .fs-menu-item:first-child {
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }

        .fs-menu-item:last-child {
            border-bottom-left-radius: 10px;
            border-bottom-right-radius: 10px;

        }

        .fs-status-msg {
            text-align: center;
            color: #9d9b98;
            text-align: center;
            font-family: Lato;
            font-size: 16px;
            font-style: normal;
            font-weight: 400;
            line-height: normal;
            margin-bottom: 10px;
        }

        .fs-chat-bubble {
            padding: 10px 14px;
            border-radius: 12px;
            margin-bottom: 10px;
            max-width: 80%;
            color: #3b3731;
            font-family: Lato;
            font-size: 16px;
            font-style: normal;
            font-weight: 400;
            line-height: normal;
        }

        .fs-user-msg {
            width: 241px;
            background: #fdfcf8;
            margin-left: auto;
            color: #3b3731;
            font-family: Lato;
            font-size: 16px;
            font-style: normal;
            font-weight: 400;
            line-height: normal;
        }

        .fs-bot-msg {
            width: 275px;
            height: 67px;
            border-radius: 10px 10px 10px 0px;
            background: rgba(255, 201, 122, 0.13);
            padding-left: 1rem;
        }

        .fs-option-buttons {
            margin-top: 15px;
            margin-left: 7rem;
        }

        .fs-opt-btn {
            width: 251px;
            height: 48px;
            padding: 18px;
            margin-bottom: 8px;
            border: 1px solid #eee;
            background: #fff;
            text-align: left;
            display: flex;
            gap: 10px;
            justify-content: space-between;
            align-items: center;
            border-radius: 10px 10px 0px 10px;
        }

        .fs-opt-btn p {
            color: #3b3731;
            font-family: Lato;
            font-size: 16px;
            font-style: normal;
            font-weight: 400;
            line-height: normal;
        }

        .fs-chat-input {
            width: 360px;
            height: 72px;
            padding: 10px;
            border: 1px solid #e2e2e2;
            border-radius: 6px;
            color: #9d9b98;
            font-family: Lato;
            font-size: 16px;
            font-style: normal;
            font-weight: 400;
            line-height: normal;
            border-radius: 10px 10px 0px 0px;
        }

        .fs-input-footer {
            display: flex;
            justify-content: space-around;
            border: 1px solid #e2e2e2;
            background: #f8f8f8;
            width: 360px;
            height: 48px;
            border-radius: 0px 0 10px 10px;
        }

        .fs-input-footer span {
            display: flex;
            align-items: center;
            gap: 0.6rem;
        }

        .fs-input-footer div:nth-of-type(1) {
            color: #3b3731;
            font-family: Lato;
            font-size: 14px;
            font-weight: 600;
            margin-top: 14px;
            gap: 1rem;
            display: flex;
            align-items: self-start;
            margin-right: 4rem;
        }

        .fs-input-footer div:nth-of-type(2) {
            color: #d4d4d4;
            font-family: Lato;
            font-size: 14px;
            font-style: normal;
            font-weight: 400;
            line-height: normal;
            margin-top: 14px;
        }

        .fs-msg-section {
            width: 370px;
        }

        .fs-chat-input-wrapper {
            position: relative;
        }

        .fs-chat-input-wrapper input {
            color: #3b3731;
        }

        .fs-chat-input-wrapper input .placeholder {
            color: #9d9b98;
            /* border: 1px solid #ddd; */
        }

        .fs-send-icon {
            position: absolute;
            right: 28px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
        }

        .fs-rating-overlay {
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>

    <style>
        /* fs-cookie-overlay */

        .fs-cookie-overlay {
            width: 100%;
            background: rgba(0, 0, 0, 0.2);
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* modal */

        .fs-cookie-modal {
            width: 440px;
            height: auto;
            background: white;
            border-radius: 15px;
            overflow: hidden;
            font-family: Arial;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        /* header */

        .fs-cookie-header {
            background: #ffc97a;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: #fff;
            font-family: Lato;
            font-size: 16px;
            font-style: normal;
            font-weight: 600;
            line-height: normal;
            padding: 15px 40px;
        }

        .fs-close-btn {
            cursor: pointer;
        }

        /* content */

        .fs-cookie-content {
            padding: 0 40px;
        }

        .fs-cookie-content p {
            color: #3b3731;
            font-family: Lato;
            font-size: 14px;
            font-style: normal;
            font-weight: 400;
            line-height: normal;
        }

        /* buttons row */

        .fs-cookie-buttons {
            display: flex;
            justify-content: space-between;
            gap: 10px;
        }

        .fs-allow-btn {
            background: #ffc97a;
            border: none;
            width: 118px;
            height: 48px;
            padding: 10px 20px;
            border-radius: 25px;
            cursor: pointer;
            color: #fff;
            text-align: center;
            font-family: Lato;
            font-size: 16px;
            font-style: normal;
            font-weight: 400;
            line-height: normal;
        }

        .fs-decline-btn {
            background: #ffc97a;
            border: none;
            width: 252px;
            height: 48px;
            /* padding: 5px 1px; */
            padding: 0.9px;
            border-radius: 25px;
            cursor: pointer;
            color: #fff;
            text-align: center;
            font-family: Lato;
            font-size: 16px;
            font-style: normal;
            font-weight: 400;
            line-height: normal;
        }

        /* manage button */

        .fs-manage-btn {
            width: 100%;
            height: 48px;
            border-radius: 25px;
            border: 1px solid #d4d4d4;
            background-color: #ffffff;
            cursor: pointer;
        }

        .fs-manage-btn p {
            color: #3b3731;
            text-align: center;
            font-family: Lato;
            font-size: 16px;
            font-style: normal;
            font-weight: 400;
            line-height: normal;
        }

        /* link */

        .fs-learn-more {
            text-align: center;
        }

        .fs-learn-more a {
            color: #3b3731;
            text-align: center;
            font-family: Lato;
            font-size: 14px;
            font-style: normal;
            font-weight: 600;
            line-height: normal;
            text-decoration-line: underline;
            text-decoration-style: solid;
            text-decoration-skip-ink: auto;
            text-decoration-thickness: auto;
            text-underline-offset: 4px;
            text-underline-position: from-font;
        }

        /* fs-consent-overlay */
        .fs-card-header-overlay {
            display: flex;
            align-items: center;
            justify-content: start;
            gap: 35px;
            padding: 20px;
            color: #FFF;
            font-family: Lato;
            font-size: 16px;
            font-style: normal;
            font-weight: 600;
            line-height: normal;
            text-align: center;
            border-radius: 10px 10px 0 0;
            border: 1px solid #ffc97a;
            background: #ffc97a;
            z-index: 1000;
        }

        .fs-consent-modal {
            width: 400px;
            max-width: 100%;
            max-height: 90vh;
            overflow-y: auto;
            border-radius: 15px;
            background: #fff;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.25);
        }

        /* modal */
        .fs-consent-modal {
            width: 400px;
            height: 526px;
            background: white;
            border-radius: 15px;
            overflow: hidden;
            font-family: Arial;
        }

        /* header */
        .fs-consent-header {
            background: #f4b86a;
            color: white;
            padding: 12px;
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 500;
        }

        /* content */
        .fs-consent-content {
            padding: 17px;
        }

        .fs-consent-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            gap: 12px;
        }

        .fs-consent-item>div:first-child {
            flex: 1;
            min-width: 0;
        }

        .switch {
            flex-shrink: 0;
        }

        .fs-consent-item h4 {
            margin: 0;
            color: #3b3731;
            font-family: Lato;
            font-size: 16px;
            font-style: normal;
            font-weight: 600;
            line-height: normal;
        }

        .fs-consent-item p {
            margin: 5px 0 0;
            color: #9d9b98;
            font-family: Lato;
            font-size: 14px;
            font-style: normal;
            font-weight: 400;
            line-height: normal;
        }


        /* buttons */
        .fs-consent-buttons {
            text-align: center;
        }

        .fs-accept-all {
            width: 360px;
            height: 48px;
            padding: 12px;
            border: none;
            border-radius: 25px;
            background: #FFC97A;
            color: white;
            margin-bottom: 10px;
            cursor: pointer;
            color: #fff;
            text-align: center;
            font-family: Lato;
            font-size: 16px;
            font-style: normal;
            font-weight: 400;
            line-height: normal;
        }

        .fs-save-btn {
            width: 360px;
            height: 48px;
            padding: 12px;
            border-radius: 25px;
            border: 1px solid #ccc;
            background: white;
            cursor: pointer;
            color: #3b3731;
            text-align: center;
            font-family: Lato;
            font-size: 16px;
            font-style: normal;
            font-weight: 400;
            line-height: normal;
        }

        .vertical-line-1 {
            width: 1px;
            height: 20px;
            background: #d4d4d4;
        }

        .manage-pref-button {
            padding: 10px;
            background: #FFC97A;
            border-radius: 50%;
            height: 60px;
            aspect-ratio: 1 / 1;
            display: flex;
            align-items: center;
            justify-content: center;
            filter: drop-shadow(0 10px 20px rgba(0, 0, 0, 0.02));
            margin: 20px 0;
        }

        .fs-consent-modal {
            margin: 0;
        }

        .fs-switch {
            position: relative;
            display: inline-block;
            width: 44px;
            height: 24px;
        }

        .fs-switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        /* track */
        .fs-slider {
            position: absolute;
            inset: 0;
            background: #ccc;
            border-radius: 24px;
            transition: 0.25s ease;
            display: flex;
            align-items: center;
            padding: 2px;
        }

        /* thumb */
        .fs-thumb {
            width: 20px;
            height: 20px;
            background: #fff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transform: translateX(0);
            transition: 0.25s cubic-bezier(0.2, 0.8, 0.2, 1);
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.2);
        }

        /* icon */
        .fs-thumb i {
            font-size: 11px;
            color: #FFC97A;
            opacity: 0;
            transform: scale(0.6);
            transition: 0.2s ease;
        }

        /* checked state */
        .fs-switch input:checked+.fs-slider {
            background: #FFC97A;
        }

        /* move thumb */
        .fs-switch input:checked+.fs-slider .fs-thumb {
            transform: translateX(20px);
        }

        /* show icon on checked */
        .fs-switch input:checked+.fs-slider .fs-thumb i {
            opacity: 1;
            transform: scale(1);
        }

        .manage-pref-outer {
            position: relative;
            width: 400px;
        }

        .manage-pref-button {
            position: absolute;
            /* adjust as needed */
            right: 20px;
            /* adjust as needed */
            width: 60px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            z-index: 999;
        }

        section.fs-consent-overlay {
            position: fixed;
            inset: 0;

            display: none;

            /* align modal to right-bottom */
            justify-content: flex-end;
            align-items: flex-end;

            /* container alignment */
            padding-right: max(20px, calc((100vw - 1350px) / 2 + 20px));
            padding-bottom: 118px;

            /* modal backdrop */
            background: #0000009e;

            z-index: 9999;
            backdrop-filter: blur(2px);

        }

        .cookie-overlay {
            position: fixed;
            inset: 0;
            display: none;
            /* hidden by default */
            justify-content: center;
            align-items: center;
            background: #0000009e;
            z-index: 9999;
            padding: 20px;
            backdrop-filter: blur(2px);
        }
    </style>
</head>

<body>

    <?php include 'components/header.php'; ?>


    <!-- cookies popup  -->
    <section class="cookie-overlay booking-container">

        <div class="fs-cookie-modal">


            <div class="fs-cookie-header">
                <span>Privacy Preference Center</span>
                <span class="fs-close-btn"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                        viewBox="0 0 20 20" fill="none">
                        <circle cx="10" cy="10" r="9.5" stroke="white" />
                        <path d="M7.11133 13.3331L13.3336 7.11084M7.11133 7.11084L13.3336 13.3331" stroke="white"
                            stroke-width="1.5" stroke-linecap="round" />
                    </svg></span>
            </div>


            <div class="fs-cookie-content">

                <p class="mt-4">
                    We use cookies to make our site work and improve your experience.
                    You can manage your cookie <br> preferences at any time.
                </p>

                <div class="fs-cookie-buttons mt-4">

                    <button class="fs-allow-btn">Allow All</button>
                    <button class="fs-decline-btn">Decline unnecessary cookies</button>

                </div>

                <button class="fs-manage-btn mt-4">
                    <p>Manage consent preferences</p>
                </button>


                <div class="fs-learn-more mt-4 mb-4">
                    <a href="#">Learn More</a>
                </div>



            </div>

        </div>

    </section>

    <section class="fs-consent-overlay">
        <div class="manage-pref-outer">
            <div class="fs-consent-modal">
                <div class="fs-card-header-overlay">
                    <svg xmlns="http://www.w3.org/2000/svg" width="9" height="16" viewBox="0 0 9 16" fill="none">
                        <path d="M7.74365 14.3735L1.00021 7.63009L7.63045 0.999853" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    </span> <span class="fs-header-title"> Manage Consent Preferences</span>
                </div>
                <!-- Content -->
                <div class="fs-consent-content">
                    <!-- Item -->
                    <div class="fs-consent-item">
                        <div>
                            <h4>Strictly Necessary Cookies</h4>
                            <p>Required for the website to function and cannot be switched off.</p>
                        </div>
                        <div class="disabled ">
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="44" height="24" viewBox="0 0 44 24" fill="none">
                                    <rect width="44" height="24" rx="12" fill="#D4D4D4" />
                                    <path d="M18.3333 18C17.9667 18 17.6529 17.8696 17.392 17.6087C17.1311 17.3478 17.0004 17.0338 17 16.6667V10C17 9.63333 17.1307 9.31956 17.392 9.05867C17.6533 8.79778 17.9671 8.66711 18.3333 8.66667H19V7.33333C19 6.41111 19.3251 5.62511 19.9753 4.97533C20.6256 4.32556 21.4116 4.00044 22.3333 4C23.2551 3.99956 24.0413 4.32467 24.692 4.97533C25.3427 5.626 25.6676 6.412 25.6667 7.33333V8.66667H26.3333C26.7 8.66667 27.014 8.79733 27.2753 9.05867C27.5367 9.32 27.6671 9.63378 27.6667 10V16.6667C27.6667 17.0333 27.5362 17.3473 27.2753 17.6087C27.0144 17.87 26.7004 18.0004 26.3333 18H18.3333ZM22.3333 14.6667C22.7 14.6667 23.014 14.5362 23.2753 14.2753C23.5367 14.0144 23.6671 13.7004 23.6667 13.3333C23.6662 12.9662 23.5358 12.6524 23.2753 12.392C23.0149 12.1316 22.7009 12.0009 22.3333 12C21.9658 11.9991 21.652 12.1298 21.392 12.392C21.132 12.6542 21.0013 12.968 21 13.3333C20.9987 13.6987 21.1293 14.0127 21.392 14.2753C21.6547 14.538 21.9684 14.6684 22.3333 14.6667ZM20.3333 8.66667H24.3333V7.33333C24.3333 6.77778 24.1389 6.30556 23.75 5.91667C23.3611 5.52778 22.8889 5.33333 22.3333 5.33333C21.7778 5.33333 21.3056 5.52778 20.9167 5.91667C20.5278 6.30556 20.3333 6.77778 20.3333 7.33333V8.66667Z" fill="white" />
                                </svg>
                            </span>
                        </div>
                    </div>
                    <div class="fs-consent-item">
                        <div>
                            <h4>Performance Cookies</h4>
                            <p>Help us understand how the site is used so we can improve performance and experience.</p>
                        </div>
                        <label class="fs-switch"> <input type="checkbox" checked> <span class="fs-slider"> <span class="fs-thumb"> <i class="fa-solid fa-check"></i> </span> </span> </label>
                    </div>
                    <div class="fs-consent-item">
                        <div>
                            <h4>Functional Cookies</h4>
                            <p>Enable extra features and remember your preferences.</p>
                        </div>
                        <label class="fs-switch"> <input type="checkbox"> <span class="fs-slider"> <span class="fs-thumb"> <i class="fa-solid fa-check"></i> </span> </span> </label>
                    </div>
                    <div class="fs-consent-item">
                        <div>
                            <h4>Marketing Cookies</h4>
                            <p>Used to show relevant content and measure marketing effectiveness.</p>
                        </div>
                        <label class="fs-switch"> <input type="checkbox" checked> <span class="fs-slider"> <span class="fs-thumb"> <i class="fa-solid fa-check"></i> </span> </span> </label>
                    </div>
                </div>
                <!-- Buttons -->
                <div class="fs-consent-buttons"> <button class="fs-accept-all">Accept all cookies</button> <button class="fs-save-btn">Save settings</button> </div>
            </div>
            <div class="manage-pref-button">
                <svg xmlns="http://www.w3.org/2000/svg" width="27" height="27" viewBox="0 0 27 27" fill="none">
                    <path d="M20.0211 11.1824C20.3661 11.5276 20.7758 11.8015 21.2268 11.9883C21.6777 12.1751 22.161 12.2713 22.6491 12.2713C23.1372 12.2713 23.6205 12.1751 24.0715 11.9883C24.5224 11.8015 24.9321 11.5276 25.2771 11.1824C25.4487 11.0094 25.7662 11.0797 25.8081 11.3202C26.2723 13.9386 25.8892 16.6367 24.7146 19.0224C23.54 21.4081 21.635 23.357 19.2767 24.5857C16.9184 25.8145 14.2297 26.259 11.6014 25.8547C8.97316 25.4504 6.54234 24.2183 4.66237 22.3376C2.78168 20.4577 1.54962 18.0268 1.14532 15.3986C0.741011 12.7703 1.18553 10.0816 2.41425 7.72327C3.64298 5.36497 5.59185 3.46005 7.97755 2.28543C10.3633 1.11081 13.0614 0.727724 15.6798 1.19187C15.9203 1.23375 15.9906 1.55128 15.8176 1.72422C15.2662 2.27563 14.9022 2.98655 14.7773 3.75629C14.6523 4.52604 14.7727 5.31559 15.1214 6.01311C15.4701 6.71063 16.0294 7.28077 16.7201 7.64277C17.4108 8.00477 18.1979 8.14029 18.9699 8.03012C18.8884 8.60109 18.941 9.18318 19.1235 9.73031C19.3059 10.2774 19.6132 10.7746 20.0211 11.1824Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M8.43359 19.5801C9.36637 19.5801 10.1225 18.8239 10.1225 17.8911C10.1225 16.9583 9.36637 16.2021 8.43359 16.2021C7.5008 16.2021 6.74463 16.9583 6.74463 17.8911C6.74463 18.8239 7.5008 19.5801 8.43359 19.5801Z" fill="white" />
                    <path d="M7.08251 11.4726C8.0153 11.4726 8.77147 10.7165 8.77147 9.78369C8.77147 8.8509 8.0153 8.09473 7.08251 8.09473C6.14973 8.09473 5.39355 8.8509 5.39355 9.78369C5.39355 10.7165 6.14973 11.4726 7.08251 11.4726Z" fill="white" />
                    <path d="M13.8384 15.5268C14.7712 15.5268 15.5273 14.7707 15.5273 13.8379C15.5273 12.9051 14.7712 12.1489 13.8384 12.1489C12.9056 12.1489 12.1494 12.9051 12.1494 13.8379C12.1494 14.7707 12.9056 15.5268 13.8384 15.5268Z" fill="white" />
                    <path d="M17.8916 20.9311C18.8244 20.9311 19.5806 20.175 19.5806 19.2422C19.5806 18.3094 18.8244 17.5532 17.8916 17.5532C16.9588 17.5532 16.2026 18.3094 16.2026 19.2422C16.2026 20.175 16.9588 20.9311 17.8916 20.9311Z" fill="white" />
                </svg>
            </div>
        </div>
    </section>
    
    <!-- cookies popup  -->


    <!-- hero section -->
    <section>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <div class="hero-section">
                        <div class="inverted-radius">
                            <img src="<?= BASE_URL ?>/assets/images/hero_section.png">
                        </div>
                        <div class="bottom-left">
                            <div class="find-grommer-content">
                                <div class="find-groomer active">
                                    <p>Find Groomer</p>
                                </div>
                                <div class="find-groomer-content-area">
                                    <form action="">
                                        <div class="select-box-first-row">
                                            <div class="pet-type-wrapper">
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
                                            <div class="pet-weight-wrapper">
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
                                            <div class="service-select-wrapper">
                                                <p class="label">Select Service Type</p>

                                                <!-- <div class="select-container">
                                                    <select id="serviceType" class="service-select">
                                                        <option value="" disabled selected hidden>
                                                            Full Grooming, Pet Spa ...
                                                        </option>
                                                        <option value="full-groom">Full Groom</option>
                                                        <option value="face-trim-only">Face Trim Only</option>
                                                        <option value="tail-trim-only">Tail Trim Only</option>
                                                        <option value="bath-and-wash">Bath & Wash</option>
                                                        <option value="nail-trim">Nail Trim</option>
                                                    </select>
                                                </div> -->
                                                <div class="custom-select">
                                                    <div class="select-trigger">
                                                        <span class="selected-text">Full Groom, Face Trim ...</span>
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="8" viewBox="0 0 15 8" fill="none">
                                                            <path d="M13.5105 0.5L6.95017 7.06033L0.499971 0.610127" stroke="#3B3731" stroke-linecap="round" stroke-linejoin="round" />
                                                        </svg>
                                                    </div>

                                                    <ul class="select-options">
                                                        <li data-value="full-groom">Full Groom</li>
                                                        <li data-value="face-trim-only">Face Trim Only</li>
                                                        <li data-value="tail-trim-only">Tail Trim Only</li>
                                                        <li data-value="bath-and-wash">Bath & Brush</li>
                                                        <li data-value="nail-trim">Nail Trim</li>
                                                    </ul>

                                                    <input type="hidden" name="serviceType">
                                                </div>
                                            </div>

                                        </div>
                                        <div class="select-box-second-row">
                                            <div class="search-box">
                                                <p class="label">Search Groomer</p>

                                                <input type="text" id="search-groomer"
                                                    placeholder="Search address, postcode, name ...">
                                                <svg class="search-icon" xmlns="http://www.w3.org/2000/svg" width="16"
                                                    height="16" fill="gray" viewBox="0 0 16 16">
                                                    <path
                                                        d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85zm-5.242.656a5 5 0 1 1 0-10 5 5 0 0 1 0 10z" />
                                                </svg>
                                            </div>

                                            <div class="datetime-wrapper" id="datetime">
                                                <!-- Date field -->
                                                <div class="field-group">
                                                    <p class="label">Date</p>
                                                    <div class="field date" id="dateField">
                                                        <div class="input-row" tabindex="0" role="button"
                                                            aria-haspopup="dialog" aria-expanded="false">
                                                            <input class="fake-input" id="dateInput" readonly
                                                                placeholder="02 November 2025"
                                                                aria-label="Date input" />
                                                            <!-- chevron down svg -->
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="8" viewBox="0 0 15 8" fill="none">
                                                                <path d="M13.5105 0.5L6.95017 7.06033L0.499971 0.610127" stroke="#3B3731" stroke-linecap="round" stroke-linejoin="round" />
                                                            </svg>
                                                        </div>

                                                        <div class="popover" id="datePopover" data-type="date">
                                                            <div style="display:flex;">
                                                                <div class="panel calendar">
                                                                    <div class="month-nav">
                                                                        <button type="button" id="prevMonth"
                                                                            title="Previous month"
                                                                            aria-label="Previous month">
                                                                            <svg class="chev rotate-left"
                                                                                viewBox="0 0 24 24" fill="none"
                                                                                xmlns="http://www.w3.org/2000/svg">
                                                                                <path d="M6 9l6 6 6-6" stroke="#444"
                                                                                    stroke-width="1.6"
                                                                                    stroke-linecap="round"
                                                                                    stroke-linejoin="round" />
                                                                            </svg>
                                                                        </button>

                                                                        <div id="monthLabel">November 2025</div>

                                                                        <button type="button" id="nextMonth"
                                                                            title="Next month" aria-label="Next month">
                                                                            <svg class="chev rotate-right"
                                                                                viewBox="0 0 24 24" fill="none"
                                                                                xmlns="http://www.w3.org/2000/svg">
                                                                                <path d="M6 9l6 6 6-6" stroke="#444"
                                                                                    stroke-width="1.6"
                                                                                    stroke-linecap="round"
                                                                                    stroke-linejoin="round" />
                                                                            </svg>
                                                                        </button>
                                                                    </div>
                                                                    <div class="weekday-row" id="weekdayRow"></div>
                                                                    <div class="days-grid" id="daysGrid"></div>
                                                                </div>

                                                                <div class="time-col">
                                                                    <div class="title">
                                                                        <p class="time-text">Time</p>
                                                                    </div>
                                                                    <div class="time-list" id="timeList" role="listbox"
                                                                        aria-label="Time options"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Time field -->
                                                <div class="field-group">
                                                    <p class="label">Time</p>
                                                    <div class="field time" id="timeField">
                                                        <div class="input-row" tabindex="0" role="button"
                                                            aria-haspopup="dialog" aria-expanded="false">
                                                            <input class="fake-input" id="timeInput" readonly
                                                                placeholder="13:00" aria-label="Time input" />
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="8" viewBox="0 0 15 8" fill="none">
                                                                <path d="M13.5105 0.5L6.95017 7.06033L0.499971 0.610127" stroke="#3B3731" stroke-linecap="round" stroke-linejoin="round" />
                                                            </svg>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>



                                            <div class="submit-button">
                                                <button type="submit" class="form-submit-button">Search</button>
                                            </div>

                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="find-space-content">
                                <div class="find-space">
                                    <p>Find Space</p>
                                </div>
                                <div class="find-space-content-area">
                                    <form action="">
                                        <div class="select-box-first-row">
                                            <div class="pet-type-wrapper">
                                                <p class="label">Select Pet Type</p>

                                                <div class="pet-toggle">
                                                    <button type="button" class="pet-option" data-pet="cat">
                                                        <span>Cat</span>
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="23"
                                                            viewBox="0 0 16 23" fill="none">
                                                            <path
                                                                d="M7.06607 3.58301C7.8265 3.48922 8.87941 3.51287 9.88638 3.85352C10.9998 4.23021 12.076 5.00399 12.6022 6.43945L14.7711 7.47949L14.818 7.64941C15.1058 8.68692 15.2774 10.2987 14.8317 11.7656C14.6072 12.5047 14.2229 13.2153 13.611 13.791C12.9973 14.3682 12.1722 14.7931 11.0944 14.9854C7.21594 15.6769 5.01487 18.9931 4.40787 20.5596C4.16903 21.2436 3.62369 22.8966 3.62369 23C-3.55897 11.9396 1.57217 3.05801 5.0358 0L7.06607 3.58301ZM9.46841 7.20898C8.89932 7.20905 8.29568 7.49145 8.29556 8.62109C8.29556 9.40123 9.29039 8.62109 9.93814 8.62109C10.5855 8.6214 10.6413 9.40108 10.6413 8.62109C10.6411 7.84111 10.1161 7.20898 9.46841 7.20898Z"
                                                                fill="#D4D4D4" />
                                                        </svg>
                                                    </button>

                                                    <button type="button" class="pet-option" data-pet="dog">
                                                        <span>Dog</span>
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="21"
                                                            viewBox="0 0 22 21" fill="none">
                                                            <path
                                                                d="M11.4592 0C12.0763 -1.81872e-05 12.6594 0.284475 13.0383 0.771484L16.2531 4.90625C16.4122 5.1107 16.6451 5.24555 16.9016 5.28223L19.9856 5.72266C20.3435 5.77379 20.646 6.01307 20.759 6.35645C21.0768 7.32331 21.6368 9.33324 21.2541 10.5C20.7993 11.8862 20.0695 12.5798 18.7541 12.9189C16.5012 13.4996 14.6389 12.8358 12.4377 14.5137C11.758 15.0318 11.2942 15.7094 10.9895 16.4668C9.95231 19.0452 6.72483 21.7058 4.32932 20.2969L1.40646 18.5781L2.88596 12.9932C3.03734 12.9827 3.18545 12.9709 3.32639 12.9531C3.72903 12.9023 4.11589 12.815 4.36935 12.6543C4.5727 12.5253 4.78067 12.3019 4.97775 12.0498C5.17867 11.7928 5.3839 11.4855 5.57834 11.168C5.96741 10.5326 6.32411 9.84071 6.53439 9.39648C6.59333 9.27178 6.53985 9.1226 6.41525 9.06348C6.29076 9.00482 6.14244 9.05746 6.08322 9.18164C5.87884 9.61345 5.53038 10.2892 5.15256 10.9062C4.96359 11.2149 4.76927 11.5055 4.5842 11.7422C4.39523 11.9839 4.23009 12.1511 4.10178 12.2324C3.94892 12.3293 3.65905 12.4071 3.26389 12.457C2.87952 12.5055 2.43081 12.5234 1.98947 12.5225C1.58423 12.5216 1.18935 12.5013 0.862518 12.4795C0.852878 12.4768 0.842809 12.4744 0.833221 12.4717C0.259699 12.3089 -0.117574 11.6851 0.0334167 11.1084C1.50838 5.48346 2.34844 2.92212 3.76584 1.50488C5.26577 0.00544894 8.2594 1.93192e-05 8.28146 0H11.4592ZM11.8508 5.01758C11.2139 5.01758 10.5383 5.33425 10.5383 6.59863C10.5386 7.47085 11.6506 6.59869 12.3752 6.59863C13.0999 6.59863 13.1623 7.47088 13.1623 6.59863C13.1623 5.72593 12.5754 5.01786 11.8508 5.01758Z"
                                                                fill="#D4D4D4" />
                                                        </svg>
                                                    </button>

                                                    <button type="button" class="pet-option highlight" data-pet="other">
                                                        <span>Other</span>
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="16"
                                                            viewBox="0 0 20 16" fill="none">
                                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                                d="M6.42074 0C5.71446 0 5.16085 0.437285 4.81841 0.961736C4.47169 1.49055 4.28049 2.18061 4.28049 2.90555C4.28049 3.63048 4.47169 4.32055 4.81841 4.84936C5.16085 5.37236 5.71446 5.8111 6.42074 5.8111C7.12702 5.8111 7.68063 5.37381 8.02307 4.84936C8.36979 4.32055 8.56099 3.63048 8.56099 2.90555C8.56099 2.18061 8.36979 1.49055 8.02307 0.961736C7.68063 0.438738 7.12702 0 6.42074 0ZM13.5549 0C12.8486 0 12.295 0.437285 11.9526 0.961736C11.6058 1.49055 11.4147 2.18061 11.4147 2.90555C11.4147 3.63048 11.6058 4.32055 11.9526 4.84936C12.295 5.37236 12.8486 5.8111 13.5549 5.8111C14.2612 5.8111 14.8148 5.37381 15.1572 4.84936C15.504 4.32055 15.6951 3.63048 15.6951 2.90555C15.6951 2.18061 15.504 1.49055 15.1572 0.961736C14.8148 0.438738 14.2612 0 13.5549 0ZM2.14025 6.53748C1.43397 6.53748 0.880355 6.97477 0.537915 7.49922C0.191195 8.02803 0 8.7181 0 9.44303C0 10.168 0.191195 10.858 0.537915 11.3868C0.880355 11.9098 1.43397 12.3486 2.14025 12.3486C2.84653 12.3486 3.40014 11.9113 3.74258 11.3868C4.0893 10.858 4.28049 10.168 4.28049 9.44303C4.28049 8.7181 4.0893 8.02803 3.74258 7.49922C3.40014 6.97622 2.84653 6.53748 2.14025 6.53748ZM9.98782 6.53748C8.27562 6.53748 7.00717 7.47307 6.19673 8.63383C5.39628 9.77717 4.99391 11.1965 4.99391 12.3486C4.99391 13.6909 5.7858 14.6251 6.75747 15.1844C7.71345 15.7364 8.91199 15.9805 9.98782 15.9805C11.0637 15.9805 12.2622 15.7379 13.2182 15.1844C14.1884 14.6236 14.9817 13.6909 14.9817 12.3486C14.9817 11.1965 14.5794 9.77717 13.7789 8.63383C12.9699 7.47162 11.7014 6.53748 9.98782 6.53748ZM17.8354 6.53748C17.1291 6.53748 16.5755 6.97477 16.2331 7.49922C15.8863 8.02803 15.6951 8.7181 15.6951 9.44303C15.6951 10.168 15.8863 10.858 16.2331 11.3868C16.5755 11.9098 17.1291 12.3486 17.8354 12.3486C18.5417 12.3486 19.0953 11.9113 19.4377 11.3868C19.7844 10.858 19.9756 10.168 19.9756 9.44303C19.9756 8.7181 19.7844 8.02803 19.4377 7.49922C19.0953 6.97622 18.5417 6.53748 17.8354 6.53748Z"
                                                                fill="white" />
                                                        </svg>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="pet-weight-wrapper">
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
                                            <div class="service-select-wrapper">
                                                <p class="label">Select Space Type</p>

                                                <div class="custom-select">
                                                    <div class="select-trigger">
                                                        <span class="selected-text">Private Rooms, Salon...</span>
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="8" viewBox="0 0 15 8" fill="none">
                                                            <path d="M13.5105 0.5L6.95017 7.06033L0.499971 0.610127" stroke="#3B3731" stroke-linecap="round" stroke-linejoin="round" />
                                                        </svg>
                                                    </div>

                                                    <ul class="select-options">
                                                        <li data-value="private-rooms">Private Rooms</li>
                                                        <li data-value="salon">Salon</li>
                                                        <li data-value="mobile-station">Mobile Station</li>
                                                        <li data-value="garden/shed">Garden / Shed</li>
                                                        <li data-value="others">Others</li>
                                                    </ul>

                                                    <input type="hidden" name="serviceType">
                                                </div>

                                            </div>

                                        </div>
                                        <div class="select-box-second-row">
                                            <div class="search-box">
                                                <p class="label">Search Space</p>

                                                <input type="text" placeholder="Search address, postcode, name ...">
                                                <svg class="search-icon" xmlns="http://www.w3.org/2000/svg" width="16"
                                                    height="16" fill="gray" viewBox="0 0 16 16">
                                                    <path
                                                        d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85zm-5.242.656a5 5 0 1 1 0-10 5 5 0 0 1 0 10z" />
                                                </svg>
                                            </div>

                                            <div class="datetime-wrapper" id="datetime">
                                                <!-- Date field -->
                                                <div class="field-group">
                                                    <p class="label">Date</p>
                                                    <div class="field date" id="dateField">
                                                        <div class="input-row" tabindex="0" role="button"
                                                            aria-haspopup="dialog" aria-expanded="false">
                                                            <input class="fake-input" id="dateInput" readonly
                                                                placeholder="02 November 2025"
                                                                aria-label="Date input" />
                                                            <!-- chevron down svg -->
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="8" viewBox="0 0 15 8" fill="none">
                                                                <path d="M13.5105 0.5L6.95017 7.06033L0.499971 0.610127" stroke="#3B3731" stroke-linecap="round" stroke-linejoin="round" />
                                                            </svg>
                                                        </div>

                                                        <div class="popover" id="datePopover" data-type="date">
                                                            <div style="display:flex;">
                                                                <div class="panel calendar">
                                                                    <div class="month-nav">
                                                                        <button type="button" id="prevMonth"
                                                                            title="Previous month"
                                                                            aria-label="Previous month">
                                                                            <svg class="chev rotate-left"
                                                                                viewBox="0 0 24 24" fill="none"
                                                                                xmlns="http://www.w3.org/2000/svg">
                                                                                <path d="M6 9l6 6 6-6" stroke="#444"
                                                                                    stroke-width="1.6"
                                                                                    stroke-linecap="round"
                                                                                    stroke-linejoin="round" />
                                                                            </svg>
                                                                        </button>
                                                                        <div id="monthLabel">November 2025</div>
                                                                        <button type="button" id="nextMonth"
                                                                            title="Next month" aria-label="Next month">
                                                                            <svg class="chev rotate-right"
                                                                                viewBox="0 0 24 24" fill="none"
                                                                                xmlns="http://www.w3.org/2000/svg">
                                                                                <path d="M6 9l6 6 6-6" stroke="#444"
                                                                                    stroke-width="1.6"
                                                                                    stroke-linecap="round"
                                                                                    stroke-linejoin="round" />
                                                                            </svg>
                                                                        </button>
                                                                    </div>
                                                                    <div class="weekday-row" id="weekdayRow"></div>
                                                                    <div class="days-grid" id="daysGrid"></div>
                                                                </div>

                                                                <div class="time-col">
                                                                    <div class="title">
                                                                        <p class="time-text">Time</p>
                                                                    </div>
                                                                    <div class="time-list" id="timeList" role="listbox"
                                                                        aria-label="Time options"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Time field -->
                                                <div class="field-group">
                                                    <p class="label">Time</p>
                                                    <div class="field time" id="timeField">
                                                        <div class="input-row" tabindex="0" role="button"
                                                            aria-haspopup="dialog" aria-expanded="false">
                                                            <input class="fake-input" id="timeInput" readonly
                                                                placeholder="13:00" aria-label="Time input" />
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="8" viewBox="0 0 15 8" fill="none">
                                                                <path d="M13.5105 0.5L6.95017 7.06033L0.499971 0.610127" stroke="#3B3731" stroke-linecap="round" stroke-linejoin="round" />
                                                            </svg>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="submit-button">
                                                <button type="submit" class="form-submit-button">Search</button>
                                            </div>

                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                        <div class="bottom-right">
                            <p class="hero-text">
                                <span class="book-text">Book</span> trusted <br>
                                pet grooming <br>
                                in minutes!
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- rating section -->

    <!-- rating section -->
    <section class="rating-section section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <div class="rating-text">
                        <div class="rating-stars">
                            <svg xmlns="http://www.w3.org/2000/svg" width="31" height="30" viewBox="0 0 31 30"
                                fill="none">
                                <path
                                    d="M13.3944 1.38199C13.9931 -0.460633 16.5999 -0.460628 17.1986 1.38199L19.4385 8.27576C19.7063 9.0998 20.4742 9.65772 21.3407 9.65772H28.5892C30.5266 9.65772 31.3322 12.137 29.7647 13.2758L23.9006 17.5363C23.1996 18.0456 22.9063 18.9484 23.174 19.7724L25.4139 26.6662C26.0126 28.5088 23.9037 30.041 22.3363 28.9022L16.4721 24.6417C15.7711 24.1324 14.8219 24.1324 14.1209 24.6417L8.25675 28.9022C6.68932 30.041 4.58036 28.5088 5.17907 26.6662L7.41899 19.7724C7.68674 18.9484 7.39342 18.0456 6.69244 17.5363L0.828256 13.2758C-0.739171 12.1369 0.0663853 9.65772 2.00383 9.65772H9.25236C10.1188 9.65772 10.8867 9.0998 11.1545 8.27575L13.3944 1.38199Z"
                                    fill="#FFC97A" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" width="31" height="30" viewBox="0 0 31 30"
                                fill="none">
                                <path
                                    d="M13.3944 1.38199C13.9931 -0.460633 16.5999 -0.460628 17.1986 1.38199L19.4385 8.27576C19.7063 9.0998 20.4742 9.65772 21.3407 9.65772H28.5892C30.5266 9.65772 31.3322 12.137 29.7647 13.2758L23.9006 17.5363C23.1996 18.0456 22.9063 18.9484 23.174 19.7724L25.4139 26.6662C26.0126 28.5088 23.9037 30.041 22.3363 28.9022L16.4721 24.6417C15.7711 24.1324 14.8219 24.1324 14.1209 24.6417L8.25675 28.9022C6.68932 30.041 4.58036 28.5088 5.17907 26.6662L7.41899 19.7724C7.68674 18.9484 7.39342 18.0456 6.69244 17.5363L0.828256 13.2758C-0.739171 12.1369 0.0663853 9.65772 2.00383 9.65772H9.25236C10.1188 9.65772 10.8867 9.0998 11.1545 8.27575L13.3944 1.38199Z"
                                    fill="#FFC97A" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" width="31" height="30" viewBox="0 0 31 30"
                                fill="none">
                                <path
                                    d="M13.3944 1.38199C13.9931 -0.460633 16.5999 -0.460628 17.1986 1.38199L19.4385 8.27576C19.7063 9.0998 20.4742 9.65772 21.3407 9.65772H28.5892C30.5266 9.65772 31.3322 12.137 29.7647 13.2758L23.9006 17.5363C23.1996 18.0456 22.9063 18.9484 23.174 19.7724L25.4139 26.6662C26.0126 28.5088 23.9037 30.041 22.3363 28.9022L16.4721 24.6417C15.7711 24.1324 14.8219 24.1324 14.1209 24.6417L8.25675 28.9022C6.68932 30.041 4.58036 28.5088 5.17907 26.6662L7.41899 19.7724C7.68674 18.9484 7.39342 18.0456 6.69244 17.5363L0.828256 13.2758C-0.739171 12.1369 0.0663853 9.65772 2.00383 9.65772H9.25236C10.1188 9.65772 10.8867 9.0998 11.1545 8.27575L13.3944 1.38199Z"
                                    fill="#FFC97A" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" width="31" height="30" viewBox="0 0 31 30"
                                fill="none">
                                <path
                                    d="M13.3944 1.38199C13.9931 -0.460633 16.5999 -0.460628 17.1986 1.38199L19.4385 8.27576C19.7063 9.0998 20.4742 9.65772 21.3407 9.65772H28.5892C30.5266 9.65772 31.3322 12.137 29.7647 13.2758L23.9006 17.5363C23.1996 18.0456 22.9063 18.9484 23.174 19.7724L25.4139 26.6662C26.0126 28.5088 23.9037 30.041 22.3363 28.9022L16.4721 24.6417C15.7711 24.1324 14.8219 24.1324 14.1209 24.6417L8.25675 28.9022C6.68932 30.041 4.58036 28.5088 5.17907 26.6662L7.41899 19.7724C7.68674 18.9484 7.39342 18.0456 6.69244 17.5363L0.828256 13.2758C-0.739171 12.1369 0.0663853 9.65772 2.00383 9.65772H9.25236C10.1188 9.65772 10.8867 9.0998 11.1545 8.27575L13.3944 1.38199Z"
                                    fill="#FFC97A" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" width="31" height="30" viewBox="0 0 31 30"
                                fill="none">
                                <path
                                    d="M13.3944 1.38199C13.9931 -0.460633 16.5999 -0.460628 17.1986 1.38199L19.4385 8.27576C19.7063 9.0998 20.4742 9.65772 21.3407 9.65772H28.5892C30.5266 9.65772 31.3322 12.137 29.7647 13.2758L23.9006 17.5363C23.1996 18.0456 22.9063 18.9484 23.174 19.7724L25.4139 26.6662C26.0126 28.5088 23.9037 30.041 22.3363 28.9022L16.4721 24.6417C15.7711 24.1324 14.8219 24.1324 14.1209 24.6417L8.25675 28.9022C6.68932 30.041 4.58036 28.5088 5.17907 26.6662L7.41899 19.7724C7.68674 18.9484 7.39342 18.0456 6.69244 17.5363L0.828256 13.2758C-0.739171 12.1369 0.0663853 9.65772 2.00383 9.65772H9.25236C10.1188 9.65772 10.8867 9.0998 11.1545 8.27575L13.3944 1.38199Z"
                                    fill="#FFC97A" />
                            </svg>
                        </div>
                        <h1>4.9 average rating from 5,000 + pet owners.</h1>
                    </div>
                    <p class="rating-sub-text text-center pt-3">All groomers are ID-verified and insured through FursGo
                        Protect.</p>
                </div>
            </div>
        </div>
    </section>
    <!-- rating section -->

    <section class="section">
        <div class="container">
            <div class="row d-flex">
                <div class="col-lg-4 p-0 m-0">
                    <h1 class="text-styling">
                        <span class="groom">Groom</span> from anywhere<span class="dot1">.</span>
                        <br>
                        <span class="book">Book</span> from anywhere<span class="dot2">.</span>
                        <br>
                        <span class="earn">Earn</span> from anywhere<span class="dot3">.</span>
                    </h1>
                </div>
                <div class="col-lg-4 p-0 m-0">
                    <div class="img-fluid">
                        <img src="<?= BASE_URL ?>/assets/images/dog.png" alt="" style="border-radius: 10px;">
                    </div>
                </div>
                <div class="col-lg-4 align-items-center">
                    <div class="points">
                        <div class="point">
                            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 50 50"
                                fill="none">
                                <path
                                    d="M25 0C11.25 0 0 11.25 0 25C0 38.75 11.25 50 25 50C38.75 50 50 38.75 50 25C50 11.25 38.75 0 25 0ZM20 37.5L7.5 25L11.025 21.475L20 30.425L38.975 11.45L42.5 15L20 37.5Z"
                                    fill="#D8E8B7" />
                            </svg>
                            <div class="text">
                                <h1>Booked in Minutes</h1>
                                <span>No calls, no quotes.</span>
                            </div>
                        </div>
                        <div class="point">
                            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 50 50"
                                fill="none">
                                <path
                                    d="M25 0C11.25 0 0 11.25 0 25C0 38.75 11.25 50 25 50C38.75 50 50 38.75 50 25C50 11.25 38.75 0 25 0ZM20 37.5L7.5 25L11.025 21.475L20 30.425L38.975 11.45L42.5 15L20 37.5Z"
                                    fill="#D8E8B7" />
                            </svg>
                            <div class="text">
                                <h1>Trusted Professionals</h1>
                                <span>Verified & insured.</span>
                            </div>
                        </div>
                        <div class="point">
                            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 50 50"
                                fill="none">
                                <path
                                    d="M25 0C11.25 0 0 11.25 0 25C0 38.75 11.25 50 25 50C38.75 50 50 38.75 50 25C50 11.25 38.75 0 25 0ZM20 37.5L7.5 25L11.025 21.475L20 30.425L38.975 11.45L42.5 15L20 37.5Z"
                                    fill="#D8E8B7" />
                            </svg>
                            <div class="text">
                                <h1>Happy Pets</h1>
                                <span>Gentle grooming, stress-free service.</span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <!-- How it works -->
    <section class="how-it-works section">
        <div class="container">
            <div class="row justify-content-center">

                <!-- Heading -->
                <div class="col-lg-12 text-center">
                    <h1>How it works</h1>
                    <span>
                        Finding the right groomer shouldn’t be overwhelming — and with FursGo, it isn’t. <br>
                        We give you clear profiles and real availability, so you can confidently choose the <br>
                        groomer who’s the right fit for your pet’s needs.
                    </span>
                </div>

                <div class="how-it-works-grid section">

                    <!-- Step 1 -->
                    <div class="how-step">
                        <div class="how-it-works-image-content-area">
                            <div class="search-image">
                                <img src="<?= BASE_URL ?>/assets/images/search.png" class="how-it-works-images" alt="">
                            </div>
                            <div class="numbering">
                                <span>1</span>
                            </div>
                            <div class="content">
                                <h2>Search</h2>
                                <span>
                                    No more guessing or endless calling around. We help you find the right groomer with
                                    total confidence.
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Arrow -->
                    <div class="how-up-arrow">
                        <svg xmlns="http://www.w3.org/2000/svg" width="171" height="26" viewBox="0 0 171 26"
                            fill="none">
                            <path d="M0.558105 0.851562C27.4847 18.9625 98.982 44.3179 169.558 0.851562"
                                stroke="#3B3731" stroke-width="2" stroke-dasharray="10 10" />
                        </svg>
                    </div>

                    <!-- Step 2 -->
                    <div class="how-step">
                        <div class="how-it-works-image-content-area">
                            <div class="book-and-pay-content">
                                <img src="<?= BASE_URL ?>/assets/images/book_and_pay.png" class="how-it-works-images" alt="">
                            </div>
                            <div class="numbering">
                                <span>2</span>
                            </div>
                            <div class="content">
                                <h2>Book & Pay</h2>
                                <span>
                                    Simple, secure, and built to save you time. Book in seconds, pay safely, and manage
                                    everything in one place.
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Arrow -->
                    <div class="how-down-arrow">
                        <svg xmlns="http://www.w3.org/2000/svg" width="171" height="26" viewBox="0 0 171 26"
                            fill="none">
                            <path d="M0.558105 24.9469C27.4847 6.83593 98.982 -18.5194 169.558 24.9469" stroke="#3B3731"
                                stroke-width="2" stroke-dasharray="10 10" />
                        </svg>
                    </div>

                    <!-- Step 3 -->
                    <div class="how-step">
                        <div class="how-it-works-image-content-area">
                            <div class="relax-content">
                                <img src="<?= BASE_URL ?>/assets/images/relax.png" class="how-it-works-images" alt="">
                            </div>
                            <div class="numbering">
                                <span>3</span>
                            </div>
                            <div class="content">
                                <h2>Relax</h2>
                                <span>
                                    Calm, clear, and stress-free appointments so your pet feels comfortable and you stay
                                    informed.
                                </span>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </section>
    <!-- How it works -->

    <section class="section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 ">
                    <div class="popular-section d-flex flex-column align-items-end align-items-xs-center">
                        <h1 class="popular-services-heading">Popular Services</h1>
                        <span>
                            Our most trusted services — chosen by owners who want comfort,
                            reliability, and peace of mind.
                        </span>
                    </div>
                </div>
            </div>
            <div class="popular-services-content-grid section">
                <div class="popular-content-area">
                    <div class="image-wrapper oval">
                        <img src="<?= BASE_URL ?>/assets/images/popular-services-1.png" alt="">
                    </div>
                    <div class="text-area">
                        <h2>Full Groom</h2>
                        <span>Bath, trim, blow-dry, <br> and essential hygiene.</span>
                    </div>
                </div>
                <div class="popular-content-area">
                    <div class="image-wrapper circle">
                        <img src="<?= BASE_URL ?>/assets/images/popular-services-2.png" alt="">
                    </div>
                    <div class="text-area">
                        <h2>Bath & Tidy</h2>
                        <span>A quick refresh to keep your <br> pet clean between full grooms.</span>
                    </div>
                </div>
                <div class="popular-content-area">
                    <div class="image-wrapper rectangle">
                        <img src="<?= BASE_URL ?>/assets/images/popular-services-3.png" alt="">
                    </div>
                    <div class="text-area">
                        <h2>Nail Trim</h2>
                        <span>Quality and careful nail care <br> focused on comfort and safety.</span>
                    </div>
                </div>
                <div class="popular-content-area">
                    <div class="image-wrapper oval">
                        <img src="<?= BASE_URL ?>/assets/images/popular-services-4.png" alt="">
                    </div>
                    <div class="text-area">
                        <h2>Pet Spa</h2>
                        <span>Soothing coat and skin <br> treatments to nourish & refresh.</span>
                    </div>
                </div>
                <div class="popular-content-area">
                    <div class="image-wrapper circle">
                        <img src="<?= BASE_URL ?>/assets/images/popular-services-5.png" alt="">
                    </div>
                    <div class="text-area">
                        <h2>Mobile Grooming</h2>
                        <span>Grooming at home, for a <br> stress-free experience.</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonial Section -->
    <section class="testimonial-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="testimonial-section d-flex flex-column align-items-start">
                        <h1 class="testimonial-heading">Testimonials</h1>
                        <span class="testimonial-heading-text">
                            Hear from real pet owners who’ve used FursGo and found the care they were looking for.
                        </span>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="layout">
                        <div class="left">
                            <div class="quote">
                                <svg xmlns="http://www.w3.org/2000/svg" width="41" height="35" viewBox="0 0 41 35"
                                    fill="none">
                                    <path
                                        d="M10.0516 35C8.11183 35 6.52473 34.5833 5.29032 33.75C4.05591 32.9167 3.04193 31.8519 2.24839 30.5556C1.36667 28.9815 0.749462 27.3611 0.396774 25.6945C0.132258 23.9352 0 22.5 0 21.3889C0 16.8519 1.10215 12.7315 3.30645 9.02779C5.51075 5.32408 8.94946 2.31482 13.6226 0L14.8129 2.5C12.0796 3.70371 9.69893 5.60185 7.67097 8.19445C5.73118 10.787 4.76129 13.4259 4.76129 16.1111C4.76129 17.2222 4.89355 18.1944 5.15806 19.0278C6.56882 17.8241 8.2 17.2222 10.0516 17.2222C12.3441 17.2222 14.328 18.0093 16.0032 19.5833C17.6785 21.1574 18.5161 23.3333 18.5161 26.1111C18.5161 28.7037 17.6785 30.8333 16.0032 32.5C14.328 34.1667 12.3441 35 10.0516 35ZM32.5355 35C30.5957 35 29.0086 34.5833 27.7742 33.75C26.5398 32.9167 25.5258 31.8519 24.7323 30.5556C23.8505 28.9815 23.2333 27.3611 22.8806 25.6945C22.6161 23.9352 22.4839 22.5 22.4839 21.3889C22.4839 16.8519 23.586 12.7315 25.7903 9.02779C27.9946 5.32408 31.4333 2.31482 36.1064 0L37.2968 2.5C34.5634 3.70371 32.1828 5.60185 30.1548 8.19445C28.2151 10.787 27.2452 13.4259 27.2452 16.1111C27.2452 17.2222 27.3774 18.1944 27.6419 19.0278C29.0527 17.8241 30.6839 17.2222 32.5355 17.2222C34.828 17.2222 36.8118 18.0093 38.4871 19.5833C40.1624 21.1574 41 23.3333 41 26.1111C41 28.7037 40.1624 30.8333 38.4871 32.5C36.8118 34.1667 34.828 35 32.5355 35Z"
                                        fill="#3B3731" />
                                </svg>
                            </div>
                            <br>
                            <h3 class="testimonial-sub-heading">Loved by Pet Parents</h3>
                            <p>Your pet’s safety comes first. <br> Every groomer is background- <br> checked, insured,
                                and trained
                                in <br> animal
                                handling.</p>

                            <!-- arrows + dots BELOW text (left column) -->
                            <div class="controls left-controls">
                                <div class="dots" id="dots"></div>

                                <div class="control-buttons">
                                    <button id="prev" class="circle-btn">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40"
                                            viewBox="0 0 40 40" fill="none">
                                            <g filter="url(#filter_prev)">
                                                <circle cx="20" cy="16" r="16" fill="white" />
                                            </g>
                                            <path d="M22 21L16.9657 15.9657L21.9155 11.016" stroke="#3B3731"
                                                stroke-linecap="round" stroke-linejoin="round" />
                                            <defs>
                                                <filter id="filter_prev" x="0" y="0" width="40" height="40"
                                                    filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                                                    <feFlood flood-opacity="0" result="BackgroundImageFix" />
                                                    <feColorMatrix in="SourceAlpha" type="matrix"
                                                        values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0"
                                                        result="hardAlpha" />
                                                    <feOffset dy="4" />
                                                    <feGaussianBlur stdDeviation="2" />
                                                    <feComposite in2="hardAlpha" operator="out" />
                                                    <feColorMatrix type="matrix"
                                                        values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.03 0" />
                                                    <feBlend mode="normal" in2="BackgroundImageFix"
                                                        result="effect1_dropShadow" />
                                                    <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow"
                                                        result="shape" />
                                                </filter>
                                            </defs>
                                        </svg>
                                    </button>

                                    <button id="next" class="circle-btn">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40"
                                            viewBox="0 0 40 40" fill="none">
                                            <g filter="url(#filter_next)">
                                                <circle cx="20" cy="16" r="16" fill="white" />
                                            </g>
                                            <path d="M18 21L23.0343 15.9657L18.0845 11.016" stroke="#3B3731"
                                                stroke-linecap="round" stroke-linejoin="round" />
                                            <defs>
                                                <filter id="filter_next" x="0" y="0" width="40" height="40"
                                                    filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                                                    <feFlood flood-opacity="0" result="BackgroundImageFix" />
                                                    <feColorMatrix in="SourceAlpha" type="matrix"
                                                        values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0"
                                                        result="hardAlpha" />
                                                    <feOffset dy="4" />
                                                    <feGaussianBlur stdDeviation="2" />
                                                    <feComposite in2="hardAlpha" operator="out" />
                                                    <feColorMatrix type="matrix"
                                                        values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.03 0" />
                                                    <feBlend mode="normal" in2="BackgroundImageFix"
                                                        result="effect1_dropShadow" />
                                                    <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow"
                                                        result="shape" />
                                                </filter>
                                            </defs>
                                        </svg>
                                    </button>
                                </div>

                            </div>
                        </div>

                        <div class="slider-wrap">
                            <div class="viewport" id="viewport">
                                <div class="ending-quotes">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="41" height="35" viewBox="0 0 41 35"
                                        fill="none">
                                        <path
                                            d="M30.9484 0C32.8882 0 34.4753 0.416664 35.7097 1.25C36.9441 2.08333 37.9581 3.14815 38.7516 4.44444C39.6333 6.01852 40.2505 7.63889 40.6032 9.30555C40.8677 11.0648 41 12.5 41 13.6111C41 18.1481 39.8978 22.2685 37.6935 25.9722C35.4892 29.6759 32.0505 32.6852 27.3774 35L26.1871 32.5C28.9204 31.2963 31.3011 29.3981 33.329 26.8056C35.2688 24.213 36.2387 21.5741 36.2387 18.8889C36.2387 17.7778 36.1065 16.8056 35.8419 15.9722C34.4312 17.1759 32.8 17.7778 30.9484 17.7778C28.6559 17.7778 26.672 16.9907 24.9968 15.4167C23.3215 13.8426 22.4839 11.6667 22.4839 8.88889C22.4839 6.29629 23.3215 4.16666 24.9968 2.5C26.672 0.833328 28.6559 0 30.9484 0ZM8.46452 0C10.4043 0 11.9914 0.416664 13.2258 1.25C14.4602 2.08333 15.4742 3.14815 16.2677 4.44444C17.1495 6.01852 17.7667 7.63889 18.1194 9.30555C18.3839 11.0648 18.5161 12.5 18.5161 13.6111C18.5161 18.1481 17.414 22.2685 15.2097 25.9722C13.0054 29.6759 9.56667 32.6852 4.89355 35L3.70322 32.5C6.43656 31.2963 8.8172 29.3981 10.8452 26.8056C12.7849 24.213 13.7548 21.5741 13.7548 18.8889C13.7548 17.7778 13.6226 16.8056 13.3581 15.9722C11.9473 17.1759 10.3161 17.7778 8.46452 17.7778C6.17204 17.7778 4.18817 16.9907 2.5129 15.4167C0.837631 13.8426 0 11.6667 0 8.88889C0 6.29629 0.837631 4.16666 2.5129 2.5C4.18817 0.833328 6.17204 0 8.46452 0Z"
                                            fill="#3B3731" />
                                    </svg>
                                </div>
                                <div class="track" id="track">
                                    <div class="card active default">
                                        <div class="svg-div">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="card-shape" width="400"
                                                height="257" viewBox="0 0 400 257" fill="none">
                                                <path
                                                    d="M10 0.5H390C395.247 0.5 399.5 4.75329 399.5 10V198C399.5 203.247 395.247 207.5 390 207.5H219C213.201 207.5 208.5 212.201 208.5 218V247C208.5 252.247 204.247 256.5 199 256.5H10C4.7533 256.5 0.5 252.247 0.5 247V10C0.500001 4.7533 4.7533 0.5 10 0.5Z" />
                                            </svg>
                                        </div>
                                        <div class="text-stars">
                                            <p>The easiest booking I’ve ever made! My dog looked amazing and the groomer
                                                was so
                                                kind.
                                            </p>
                                            <div class="stars">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="110" height="17"
                                                    viewBox="0 0 110 17" fill="none">
                                                    <path
                                                        d="M7.58756 0.802006C7.92671 -0.267338 9.40341 -0.267334 9.74255 0.80201L11.0114 4.80273C11.1631 5.28095 11.5981 5.60473 12.0889 5.60473H16.195C17.2925 5.60473 17.7488 7.04353 16.8609 7.70442L13.539 10.177C13.1419 10.4726 12.9758 10.9964 13.1275 11.4747L14.3963 15.4754C14.7355 16.5447 13.5408 17.434 12.6529 16.7731L9.33099 14.3005C8.9339 14.0049 8.39621 14.0049 7.99913 14.3005L4.67723 16.7731C3.78932 17.434 2.59466 16.5447 2.9338 15.4754L4.20266 11.4747C4.35433 10.9964 4.18817 10.4726 3.79109 10.177L0.469188 7.70442C-0.418717 7.04353 0.0376084 5.60473 1.13512 5.60473H5.24122C5.73204 5.60473 6.16704 5.28095 6.31871 4.80273L7.58756 0.802006Z"
                                                        fill="#FFC97A" />
                                                    <path
                                                        d="M53.9225 0.802006C54.2617 -0.267338 55.7384 -0.267334 56.0775 0.80201L57.3464 4.80273C57.498 5.28095 57.933 5.60473 58.4239 5.60473H62.53C63.6275 5.60473 64.0838 7.04353 63.1959 7.70442L59.874 10.177C59.4769 10.4726 59.3107 10.9964 59.4624 11.4747L60.7313 15.4754C61.0704 16.5447 59.8758 17.434 58.9878 16.7731L55.6659 14.3005C55.2689 14.0049 54.7312 14.0049 54.3341 14.3005L51.0122 16.7731C50.1243 17.434 48.9296 16.5447 49.2688 15.4754L50.5376 11.4747C50.6893 10.9964 50.5231 10.4726 50.126 10.177L46.8041 7.70442C45.9162 7.04353 46.3726 5.60473 47.4701 5.60473H51.5762C52.067 5.60473 52.502 5.28095 52.6537 4.80273L53.9225 0.802006Z"
                                                        fill="#FFC97A" />
                                                    <path
                                                        d="M30.755 0.802006C31.0942 -0.267338 32.5709 -0.267334 32.91 0.80201L34.1789 4.80273C34.3306 5.28095 34.7656 5.60473 35.2564 5.60473H39.3625C40.46 5.60473 40.9163 7.04353 40.0284 7.70442L36.7065 10.177C36.3094 10.4726 36.1433 10.9964 36.2949 11.4747L37.5638 15.4754C37.9029 16.5447 36.7083 17.434 35.8204 16.7731L32.4985 14.3005C32.1014 14.0049 31.5637 14.0049 31.1666 14.3005L27.8447 16.7731C26.9568 17.434 25.7621 16.5447 26.1013 15.4754L27.3701 11.4747C27.5218 10.9964 27.3557 10.4726 26.9586 10.177L23.6367 7.70442C22.7488 7.04353 23.2051 5.60473 24.3026 5.60473H28.4087C28.8995 5.60473 29.3345 5.28095 29.4862 4.80273L30.755 0.802006Z"
                                                        fill="#FFC97A" />
                                                    <path
                                                        d="M77.09 0.802006C77.4291 -0.267338 78.9058 -0.267334 79.245 0.80201L80.5138 4.80273C80.6655 5.28095 81.1005 5.60473 81.5913 5.60473H85.6974C86.7949 5.60473 87.2512 7.04353 86.3633 7.70442L83.0414 10.177C82.6443 10.4726 82.4782 10.9964 82.6299 11.4747L83.8987 15.4754C84.2379 16.5447 83.0432 17.434 82.1553 16.7731L78.8334 14.3005C78.4363 14.0049 77.8986 14.0049 77.5015 14.3005L74.1796 16.7731C73.2917 17.434 72.0971 16.5447 72.4362 15.4754L73.7051 11.4747C73.8567 10.9964 73.6906 10.4726 73.2935 10.177L69.9716 7.70442C69.0837 7.04353 69.54 5.60473 70.6375 5.60473H74.7436C75.2344 5.60473 75.6694 5.28095 75.8211 4.80273L77.09 0.802006Z"
                                                        fill="#FFC97A" />
                                                    <path
                                                        d="M100.257 0.802006C100.597 -0.267338 102.073 -0.267334 102.412 0.80201L103.681 4.80273C103.833 5.28095 104.268 5.60473 104.759 5.60473H108.865C109.962 5.60473 110.419 7.04353 109.531 7.70442L106.209 10.177C105.812 10.4726 105.646 10.9964 105.797 11.4747L107.066 15.4754C107.405 16.5447 106.211 17.434 105.323 16.7731L102.001 14.3005C101.604 14.0049 101.066 14.0049 100.669 14.3005L97.3471 16.7731C96.4592 17.434 95.2645 16.5447 95.6037 15.4754L96.8725 11.4747C97.0242 10.9964 96.858 10.4726 96.461 10.177L93.1391 7.70442C92.2512 7.04353 92.7075 5.60473 93.805 5.60473H97.9111C98.4019 5.60473 98.8369 5.28095 98.9886 4.80273L100.257 0.802006Z"
                                                        fill="#FFC97A" />
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="testimonial-photo"><img src="<?= BASE_URL ?>/assets/images/testimonial-1.png" />
                                        </div>
                                        <div class="avatar-meta">
                                            <div class="avatar">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35"
                                                    viewBox="0 0 35 35" fill="none">
                                                    <circle cx="17.5" cy="17.5" r="17.5" fill="#FFC97A" />
                                                </svg>
                                            </div>
                                            <div class="meta">
                                                <p>Sarah M. <br> <span>1 day ago</span></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="svg-div">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="card-shape" width="296"
                                                height="257" fill="none">
                                                <path
                                                    d="M10 0.5H286C291.247 0.5 295.5 4.75329 295.5 10V198C295.5 203.247 291.247 207.5 286 207.5H164.66C158.861 207.5 154.16 212.201 154.16 218V247C154.16 252.247 149.907 256.5 144.66 256.5H10C4.7533 256.5 0.5 252.247 0.5 247V10C0.500001 4.7533 4.7533 0.5 10 0.5Z" />
                                            </svg>
                                        </div>
                                        <div class="text-stars">
                                            <p>
                                                Five stars every time. Reliable and professional.
                                            </p>
                                            <div class="stars">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="110" height="17"
                                                    viewBox="0 0 110 17" fill="none">
                                                    <path
                                                        d="M7.58756 0.802006C7.92671 -0.267338 9.40341 -0.267334 9.74255 0.80201L11.0114 4.80273C11.1631 5.28095 11.5981 5.60473 12.0889 5.60473H16.195C17.2925 5.60473 17.7488 7.04353 16.8609 7.70442L13.539 10.177C13.1419 10.4726 12.9758 10.9964 13.1275 11.4747L14.3963 15.4754C14.7355 16.5447 13.5408 17.434 12.6529 16.7731L9.33099 14.3005C8.9339 14.0049 8.39621 14.0049 7.99913 14.3005L4.67723 16.7731C3.78932 17.434 2.59466 16.5447 2.9338 15.4754L4.20266 11.4747C4.35433 10.9964 4.18817 10.4726 3.79109 10.177L0.469188 7.70442C-0.418717 7.04353 0.0376084 5.60473 1.13512 5.60473H5.24122C5.73204 5.60473 6.16704 5.28095 6.31871 4.80273L7.58756 0.802006Z"
                                                        fill="#FFC97A" />
                                                    <path
                                                        d="M53.9225 0.802006C54.2617 -0.267338 55.7384 -0.267334 56.0775 0.80201L57.3464 4.80273C57.498 5.28095 57.933 5.60473 58.4239 5.60473H62.53C63.6275 5.60473 64.0838 7.04353 63.1959 7.70442L59.874 10.177C59.4769 10.4726 59.3107 10.9964 59.4624 11.4747L60.7313 15.4754C61.0704 16.5447 59.8758 17.434 58.9878 16.7731L55.6659 14.3005C55.2689 14.0049 54.7312 14.0049 54.3341 14.3005L51.0122 16.7731C50.1243 17.434 48.9296 16.5447 49.2688 15.4754L50.5376 11.4747C50.6893 10.9964 50.5231 10.4726 50.126 10.177L46.8041 7.70442C45.9162 7.04353 46.3726 5.60473 47.4701 5.60473H51.5762C52.067 5.60473 52.502 5.28095 52.6537 4.80273L53.9225 0.802006Z"
                                                        fill="#FFC97A" />
                                                    <path
                                                        d="M30.755 0.802006C31.0942 -0.267338 32.5709 -0.267334 32.91 0.80201L34.1789 4.80273C34.3306 5.28095 34.7656 5.60473 35.2564 5.60473H39.3625C40.46 5.60473 40.9163 7.04353 40.0284 7.70442L36.7065 10.177C36.3094 10.4726 36.1433 10.9964 36.2949 11.4747L37.5638 15.4754C37.9029 16.5447 36.7083 17.434 35.8204 16.7731L32.4985 14.3005C32.1014 14.0049 31.5637 14.0049 31.1666 14.3005L27.8447 16.7731C26.9568 17.434 25.7621 16.5447 26.1013 15.4754L27.3701 11.4747C27.5218 10.9964 27.3557 10.4726 26.9586 10.177L23.6367 7.70442C22.7488 7.04353 23.2051 5.60473 24.3026 5.60473H28.4087C28.8995 5.60473 29.3345 5.28095 29.4862 4.80273L30.755 0.802006Z"
                                                        fill="#FFC97A" />
                                                    <path
                                                        d="M77.09 0.802006C77.4291 -0.267338 78.9058 -0.267334 79.245 0.80201L80.5138 4.80273C80.6655 5.28095 81.1005 5.60473 81.5913 5.60473H85.6974C86.7949 5.60473 87.2512 7.04353 86.3633 7.70442L83.0414 10.177C82.6443 10.4726 82.4782 10.9964 82.6299 11.4747L83.8987 15.4754C84.2379 16.5447 83.0432 17.434 82.1553 16.7731L78.8334 14.3005C78.4363 14.0049 77.8986 14.0049 77.5015 14.3005L74.1796 16.7731C73.2917 17.434 72.0971 16.5447 72.4362 15.4754L73.7051 11.4747C73.8567 10.9964 73.6906 10.4726 73.2935 10.177L69.9716 7.70442C69.0837 7.04353 69.54 5.60473 70.6375 5.60473H74.7436C75.2344 5.60473 75.6694 5.28095 75.8211 4.80273L77.09 0.802006Z"
                                                        fill="#FFC97A" />
                                                    <path
                                                        d="M100.257 0.802006C100.597 -0.267338 102.073 -0.267334 102.412 0.80201L103.681 4.80273C103.833 5.28095 104.268 5.60473 104.759 5.60473H108.865C109.962 5.60473 110.419 7.04353 109.531 7.70442L106.209 10.177C105.812 10.4726 105.646 10.9964 105.797 11.4747L107.066 15.4754C107.405 16.5447 106.211 17.434 105.323 16.7731L102.001 14.3005C101.604 14.0049 101.066 14.0049 100.669 14.3005L97.3471 16.7731C96.4592 17.434 95.2645 16.5447 95.6037 15.4754L96.8725 11.4747C97.0242 10.9964 96.858 10.4726 96.461 10.177L93.1391 7.70442C92.2512 7.04353 92.7075 5.60473 93.805 5.60473H97.9111C98.4019 5.60473 98.8369 5.28095 98.9886 4.80273L100.257 0.802006Z"
                                                        fill="#FFC97A" />
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="avatar">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35"
                                                viewBox="0 0 35 35" fill="none">
                                                <circle cx="17.5" cy="17.5" r="17.5" fill="#FFC97A" />
                                            </svg>
                                        </div>
                                        <div class="meta">
                                            <p>David R. <br> <span>1 week ago</span></p>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="svg-div">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="card-shape" width="296"
                                                height="257" fill="none">
                                                <path
                                                    d="M10 0.5H286C291.247 0.5 295.5 4.75329 295.5 10V198C295.5 203.247 291.247 207.5 286 207.5H164.66C158.861 207.5 154.16 212.201 154.16 218V247C154.16 252.247 149.907 256.5 144.66 256.5H10C4.7533 256.5 0.5 252.247 0.5 247V10C0.500001 4.7533 4.7533 0.5 10 0.5Z" />
                                            </svg>
                                        </div>
                                        <div class="text-stars">
                                            <p>
                                                Such a smooth <br> experience — my <br> pup loved it!
                                            </p>
                                            <div class="stars">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="110" height="17"
                                                    viewBox="0 0 110 17" fill="none">
                                                    <path
                                                        d="M7.58756 0.802006C7.92671 -0.267338 9.40341 -0.267334 9.74255 0.80201L11.0114 4.80273C11.1631 5.28095 11.5981 5.60473 12.0889 5.60473H16.195C17.2925 5.60473 17.7488 7.04353 16.8609 7.70442L13.539 10.177C13.1419 10.4726 12.9758 10.9964 13.1275 11.4747L14.3963 15.4754C14.7355 16.5447 13.5408 17.434 12.6529 16.7731L9.33099 14.3005C8.9339 14.0049 8.39621 14.0049 7.99913 14.3005L4.67723 16.7731C3.78932 17.434 2.59466 16.5447 2.9338 15.4754L4.20266 11.4747C4.35433 10.9964 4.18817 10.4726 3.79109 10.177L0.469188 7.70442C-0.418717 7.04353 0.0376084 5.60473 1.13512 5.60473H5.24122C5.73204 5.60473 6.16704 5.28095 6.31871 4.80273L7.58756 0.802006Z"
                                                        fill="#FFC97A" />
                                                    <path
                                                        d="M53.9225 0.802006C54.2617 -0.267338 55.7384 -0.267334 56.0775 0.80201L57.3464 4.80273C57.498 5.28095 57.933 5.60473 58.4239 5.60473H62.53C63.6275 5.60473 64.0838 7.04353 63.1959 7.70442L59.874 10.177C59.4769 10.4726 59.3107 10.9964 59.4624 11.4747L60.7313 15.4754C61.0704 16.5447 59.8758 17.434 58.9878 16.7731L55.6659 14.3005C55.2689 14.0049 54.7312 14.0049 54.3341 14.3005L51.0122 16.7731C50.1243 17.434 48.9296 16.5447 49.2688 15.4754L50.5376 11.4747C50.6893 10.9964 50.5231 10.4726 50.126 10.177L46.8041 7.70442C45.9162 7.04353 46.3726 5.60473 47.4701 5.60473H51.5762C52.067 5.60473 52.502 5.28095 52.6537 4.80273L53.9225 0.802006Z"
                                                        fill="#FFC97A" />
                                                    <path
                                                        d="M30.755 0.802006C31.0942 -0.267338 32.5709 -0.267334 32.91 0.80201L34.1789 4.80273C34.3306 5.28095 34.7656 5.60473 35.2564 5.60473H39.3625C40.46 5.60473 40.9163 7.04353 40.0284 7.70442L36.7065 10.177C36.3094 10.4726 36.1433 10.9964 36.2949 11.4747L37.5638 15.4754C37.9029 16.5447 36.7083 17.434 35.8204 16.7731L32.4985 14.3005C32.1014 14.0049 31.5637 14.0049 31.1666 14.3005L27.8447 16.7731C26.9568 17.434 25.7621 16.5447 26.1013 15.4754L27.3701 11.4747C27.5218 10.9964 27.3557 10.4726 26.9586 10.177L23.6367 7.70442C22.7488 7.04353 23.2051 5.60473 24.3026 5.60473H28.4087C28.8995 5.60473 29.3345 5.28095 29.4862 4.80273L30.755 0.802006Z"
                                                        fill="#FFC97A" />
                                                    <path
                                                        d="M77.09 0.802006C77.4291 -0.267338 78.9058 -0.267334 79.245 0.80201L80.5138 4.80273C80.6655 5.28095 81.1005 5.60473 81.5913 5.60473H85.6974C86.7949 5.60473 87.2512 7.04353 86.3633 7.70442L83.0414 10.177C82.6443 10.4726 82.4782 10.9964 82.6299 11.4747L83.8987 15.4754C84.2379 16.5447 83.0432 17.434 82.1553 16.7731L78.8334 14.3005C78.4363 14.0049 77.8986 14.0049 77.5015 14.3005L74.1796 16.7731C73.2917 17.434 72.0971 16.5447 72.4362 15.4754L73.7051 11.4747C73.8567 10.9964 73.6906 10.4726 73.2935 10.177L69.9716 7.70442C69.0837 7.04353 69.54 5.60473 70.6375 5.60473H74.7436C75.2344 5.60473 75.6694 5.28095 75.8211 4.80273L77.09 0.802006Z"
                                                        fill="#FFC97A" />
                                                    <path
                                                        d="M100.257 0.802006C100.597 -0.267338 102.073 -0.267334 102.412 0.80201L103.681 4.80273C103.833 5.28095 104.268 5.60473 104.759 5.60473H108.865C109.962 5.60473 110.419 7.04353 109.531 7.70442L106.209 10.177C105.812 10.4726 105.646 10.9964 105.797 11.4747L107.066 15.4754C107.405 16.5447 106.211 17.434 105.323 16.7731L102.001 14.3005C101.604 14.0049 101.066 14.0049 100.669 14.3005L97.3471 16.7731C96.4592 17.434 95.2645 16.5447 95.6037 15.4754L96.8725 11.4747C97.0242 10.9964 96.858 10.4726 96.461 10.177L93.1391 7.70442C92.2512 7.04353 92.7075 5.60473 93.805 5.60473H97.9111C98.4019 5.60473 98.8369 5.28095 98.9886 4.80273L100.257 0.802006Z"
                                                        fill="#FFC97A" />
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="avatar">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35"
                                                viewBox="0 0 35 35" fill="none">
                                                <circle cx="17.5" cy="17.5" r="17.5" fill="#FFC97A" />
                                            </svg>
                                        </div>
                                        <div class="meta">
                                            <p>Sarah M. <br> <span>1 day ago</span></p>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="payments-protected-text d-flex align-items-center justify-content-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 15 15" fill="none">
                            <path
                                d="M7.5 0C3.375 0 0 3.375 0 7.5C0 11.625 3.375 15 7.5 15C11.625 15 15 11.625 15 7.5C15 3.375 11.625 0 7.5 0ZM6 11.25L2.25 7.5L3.3075 6.4425L6 9.1275L11.6925 3.435L12.75 4.5L6 11.25Z"
                                fill="#D8E8B7" />
                        </svg>
                        &nbsp;
                        &nbsp;
                        <p class="protected-text">All payments and messages are protected through FursGo.</p>
                    </div>

                </div>
            </div>
        </div>

    </section>

    <!-- Our Mission  -->
    <section class="section">
        <div class="container">
            <div class="our-mission row d-flex justify-content-center align-items-center">
                <div class="col-lg-7">
                    <div class="image-wrapper">
                        <img src="<?= BASE_URL ?>/assets/images/our_mission.png" style="border-radius: 10px;">
                    </div>
                </div>
                <div class="col-lg-5 content-column">
                    <h1 class="main-heading">Our Mission</h1>
                    <p class="description">To create a harmonious grooming community—where pets receive gentle, timely
                        care; owners enjoy convenience and peace of mind; groomers find flexible, rewarding
                        opportunities; space owners foster meaningful connections; and Fetchers enable smooth,
                        stress‑free journeys.
                    </p>
                    <button class="action-button">About Us</button>
                </div>
            </div>
        </div>
    </section>
    <!-- Our Mission  -->

    <section class="section">
        <div class="container">
            <div class="row">
                <div class="col-lg-1 d-flex justify-content-lg-center">
                    <div class="location-svg">
                        <svg xmlns="http://www.w3.org/2000/svg" width="33" height="46" viewBox="0 0 33 46" fill="none">
                            <path
                                d="M16.5 21.85C14.9371 21.85 13.4382 21.2442 12.3331 20.1659C11.228 19.0875 10.6071 17.625 10.6071 16.1C10.6071 14.575 11.228 13.1125 12.3331 12.0341C13.4382 10.9558 14.9371 10.35 16.5 10.35C18.0629 10.35 19.5618 10.9558 20.6669 12.0341C21.772 13.1125 22.3929 14.575 22.3929 16.1C22.3929 16.8551 22.2404 17.6028 21.9443 18.3004C21.6481 18.9981 21.2141 19.6319 20.6669 20.1659C20.1197 20.6998 19.4701 21.1233 18.7551 21.4123C18.0401 21.7013 17.2739 21.85 16.5 21.85ZM16.5 0C12.1239 0 7.92709 1.69624 4.83274 4.71558C1.73839 7.73492 0 11.83 0 16.1C0 28.175 16.5 46 16.5 46C16.5 46 33 28.175 33 16.1C33 11.83 31.2616 7.73492 28.1673 4.71558C25.0729 1.69624 20.8761 0 16.5 0Z"
                                fill="#FFC97A" />
                        </svg>
                    </div>
                </div>
                <div class="col-lg-11 mt-xs-5">
                    <div class="fursgo-address-map">
                        <h1 class="fursgo-address-heading">FursGo across the UK</h1>
                        <p class="fursgo-sub-heading">Now serving pet owners across the UK .</p>
                        <ul class="fursgo-locations">
                            <li>London</li>
                            <li>Manchester</li>
                            <li>Birmingham Leeds</li>
                            <li>Bristol</li>
                            <li>Edinburgh</li>
                        </ul>
                        <p class="link">More Coming soon.</p>
                        <div class="fursgo-map-image-wrapper">
                            <img src="<?= BASE_URL ?>/assets/images/Intersect.png" alt="" style="border-bottom-right-radius: 10%;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="container">
        <!-- Chat Toggle Button -->
        <button id="chat-btn" onclick="toggleChat()">
            <span id="chat-open-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="34" height="25" viewBox="0 0 34 25" fill="none">
                    <path d="M27.6424 11.2471C30.7873 12.249 32.19 13.7434 32.19 16.0949C32.19 18.1864 30.282 19.8096 29.1457 20.5918C29.0918 20.6287 29.0478 20.6782 29.0174 20.736C28.987 20.7938 28.971 20.8581 28.971 20.9233V22.5512C28.971 23.251 28.2678 23.7266 27.6859 23.3379C27.2333 23.0356 26.8194 22.6756 26.4554 22.2657C26.4091 22.2135 26.35 22.1743 26.284 22.1519C26.218 22.1295 26.1472 22.1246 26.0788 22.1377C25.8494 22.182 25.6152 22.2447 25.3778 22.3083C24.9674 22.4186 24.5441 22.5328 24.1425 22.5328C22.076 22.5328 20.629 22.0886 19.1499 21.0014" stroke="white" stroke-width="2" stroke-linecap="round" />
                    <path d="M13.0184 19.318C11.9642 19.318 10.7659 19.116 9.7326 18.9188C9.66412 18.9065 9.59363 18.9118 9.52775 18.9341C9.46187 18.9565 9.40276 18.9953 9.35598 19.0468C8.33359 20.1998 7.20024 21.0924 6.26259 21.7256C5.63442 22.1499 4.82848 21.6769 4.82848 20.9189V17.7045C4.82845 17.6392 4.81254 17.5749 4.78211 17.5171C4.75169 17.4594 4.70767 17.4099 4.65385 17.3729C2.53093 15.9123 0 13.4594 0 10.061C0 4.41892 5.54148 6.10352e-05 12.616 6.10352e-05C19.6463 6.10352e-05 24.9471 4.32477 24.9471 10.0594C24.9471 15.5976 20.1533 19.318 13.0184 19.318Z" fill="white" />
                </svg>
            </span>

            <span id="chat-close-icon" style="display: none;">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                    <path d="M1.25 16.25L16.25 1.25M1.25 1.25L16.25 16.25" stroke="white" stroke-width="2.5" stroke-linecap="round" />
                </svg>
            </span>
        </button>

        <div class="need-help-chat">
            <svg xmlns="http://www.w3.org/2000/svg" width="34" height="25" viewBox="0 0 34 25" fill="none">
                <path d="M27.6424 11.2471C30.7873 12.249 32.19 13.7434 32.19 16.0949C32.19 18.1864 30.282 19.8096 29.1457 20.5918C29.0918 20.6287 29.0478 20.6782 29.0174 20.736C28.987 20.7938 28.971 20.8581 28.971 20.9233V22.5512C28.971 23.251 28.2678 23.7266 27.6859 23.3379C27.2333 23.0356 26.8194 22.6756 26.4554 22.2657C26.4091 22.2135 26.35 22.1743 26.284 22.1519C26.218 22.1295 26.1472 22.1246 26.0788 22.1377C25.8494 22.182 25.6152 22.2447 25.3778 22.3083C24.9674 22.4186 24.5441 22.5328 24.1425 22.5328C22.076 22.5328 20.629 22.0886 19.1499 21.0014" stroke="white" stroke-width="2" stroke-linecap="round" />
                <path d="M13.0184 19.318C11.9642 19.318 10.7659 19.116 9.7326 18.9188C9.66412 18.9065 9.59363 18.9118 9.52775 18.9341C9.46187 18.9565 9.40276 18.9953 9.35598 19.0468C8.33359 20.1998 7.20024 21.0924 6.26259 21.7256C5.63442 22.1499 4.82848 21.6769 4.82848 20.9189V17.7045C4.82845 17.6392 4.81254 17.5749 4.78211 17.5171C4.75169 17.4594 4.70767 17.4099 4.65385 17.3729C2.53093 15.9123 0 13.4594 0 10.061C0 4.41892 5.54148 6.10352e-05 12.616 6.10352e-05C19.6463 6.10352e-05 24.9471 4.32477 24.9471 10.0594C24.9471 15.5976 20.1533 19.318 13.0184 19.318Z" fill="white" />
            </svg>
            <p>Need Help? Chat with FursGo</p>
        </div>

        <!-- Chat Panel -->
        <div id="chat-panel">
            <div class="fs-container d-flex align-items-center gap-25">

                <div class="fs-card fs-card-1">
                    <div class="fs-card-header">
                        <span class="fs-icon"><svg xmlns="http://www.w3.org/2000/svg" width="34" height="25" viewBox="0 0 34 25"
                                fill="none">
                                <path
                                    d="M27.6424 11.2471C30.7873 12.249 32.19 13.7434 32.19 16.0949C32.19 18.1864 30.282 19.8096 29.1457 20.5918C29.0918 20.6287 29.0478 20.6782 29.0174 20.736C28.987 20.7938 28.971 20.8581 28.971 20.9233V22.5512C28.971 23.251 28.2678 23.7266 27.6859 23.3379C27.2333 23.0356 26.8194 22.6756 26.4554 22.2657C26.4091 22.2135 26.35 22.1743 26.284 22.1519C26.218 22.1295 26.1472 22.1246 26.0788 22.1377C25.8494 22.182 25.6152 22.2447 25.3778 22.3083C24.9674 22.4186 24.5441 22.5328 24.1425 22.5328C22.076 22.5328 20.629 22.0886 19.1499 21.0014"
                                    stroke="#FFF8EE" stroke-width="2" stroke-linecap="round" />
                                <path
                                    d="M13.0184 19.3179C11.9642 19.3179 10.7659 19.1159 9.7326 18.9188C9.66412 18.9064 9.59363 18.9117 9.52775 18.9341C9.46187 18.9565 9.40276 18.9952 9.35598 19.0467C8.33359 20.1998 7.20024 21.0923 6.26259 21.7256C5.63442 22.1499 4.82848 21.6768 4.82848 20.9188V17.7044C4.82845 17.6391 4.81254 17.5748 4.78211 17.5171C4.75169 17.4593 4.70767 17.4098 4.65385 17.3729C2.53093 15.9122 0 13.4594 0 10.0609C0 4.41886 5.54148 0 12.616 0C19.6463 0 24.9471 4.3247 24.9471 10.0593C24.9471 15.5976 20.1533 19.3179 13.0184 19.3179Z"
                                    fill="#FFF8EE" />
                            </svg></span> FursGo Support
                    </div>

                    <div class="fs-card-body fs-gradient-bg">
                        <div class="fs-welcome-text">
                            <h2>Hi Bella 👋
                            </h2>
                            <p>What can we help you with today?</p>
                        </div>

                        <div class="fs-menu-list">
                            <div class="fs-menu-item">
                                <div class="fs-content">
                                    <div><span><svg xmlns="http://www.w3.org/2000/svg" width="21" height="20"
                                                viewBox="0 0 21 20" fill="none">
                                                <path
                                                    d="M1.30105 7.45312C1.26025 8.18844 1.26025 9.06324 1.26025 10.1142V11.7765C1.26025 14.9108 1.26118 16.4775 2.34253 17.4517C3.42388 18.4258 5.1655 18.4258 8.6478 18.4258H12.3416C15.8239 18.4258 17.5646 18.4249 18.6468 17.4517C19.7291 16.4784 19.7291 14.9108 19.7291 11.7765V10.1142C19.7291 9.06315 19.729 8.18838 19.6881 7.45312H1.30105Z"
                                                    fill="#EFEFEF" fill-opacity="0.933333" />
                                                <path
                                                    d="M7.56141 13.0002L9.54623 14.985L13.38 11.1513C13.5601 10.9712 13.5606 10.6793 13.3811 10.4985C13.2007 10.3168 12.907 10.3163 12.726 10.4973L9.54623 13.6771L8.21308 12.3477C8.03293 12.168 7.74131 12.1682 7.56141 12.3481C7.38133 12.5282 7.38133 12.8202 7.56141 13.0002Z"
                                                    fill="#E2E2E2" />
                                                <path
                                                    d="M0.5 9.59437C0.5 5.98454 0.5 4.17914 1.672 3.05819C2.844 1.93724 4.729 1.93628 8.5 1.93628H12.5C16.271 1.93628 18.157 1.93628 19.328 3.05819C20.499 4.1801 20.5 5.98454 20.5 9.59437V11.5089C20.5 15.1187 20.5 16.9241 19.328 18.0451C18.156 19.166 16.271 19.167 12.5 19.167H8.5C4.729 19.167 2.843 19.167 1.672 18.0451C0.501 16.9232 0.5 15.1187 0.5 11.5089V9.59437Z"
                                                    stroke="#9D9B98" />
                                                <path d="M5.3488 1.92903V0.5M15.641 1.92903V0.5M0.717285 6.69248H20.2726"
                                                    stroke="#9D9B98" stroke-linecap="round" />
                                            </svg></span></div>
                                    <span>Bookings</span>
                                </div>

                                <span class="fs-arrow"><svg xmlns="http://www.w3.org/2000/svg" width="8" height="15"
                                        viewBox="0 0 8 15" fill="none">
                                        <path d="M0.5 0.5L7.06033 7.06033L0.610127 13.5105" stroke="#9D9B98"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg></span>
                            </div>

                            <div class="fs-menu-item">
                                <div class="fs-content">
                                    <div><span><svg xmlns="http://www.w3.org/2000/svg" width="21" height="17"
                                                viewBox="0 0 21 17" fill="none">
                                                <path
                                                    d="M17.8077 0.5H3.19231C1.70539 0.5 0.5 1.70539 0.5 3.19231V13.1923C0.5 14.6792 1.70539 15.8846 3.19231 15.8846H17.8077C19.2946 15.8846 20.5 14.6792 20.5 13.1923V3.19231C20.5 1.70539 19.2946 0.5 17.8077 0.5Z"
                                                    stroke="#9D9B98" stroke-linecap="round" stroke-linejoin="round" />
                                                <path d="M0.5 5.11548H20.5H0.5Z" fill="#E2E2E2" />
                                                <path d="M0.5 5.11548H20.5" stroke="#9D9B98" stroke-linejoin="round" />
                                                <rect x="0.916504" y="5.5" width="19.1667" height="1.66667" fill="#EFEFEF" />
                                                <rect x="3.70508" y="11.3975" width="4.80769" height="1.28205" rx="0.641026"
                                                    fill="#E2E2E2" />
                                            </svg></span></div>
                                    <span>Payments</span>
                                </div>

                                <span class="fs-arrow"><svg xmlns="http://www.w3.org/2000/svg" width="8" height="15"
                                        viewBox="0 0 8 15" fill="none">
                                        <path d="M0.5 0.5L7.06033 7.06033L0.610127 13.5105" stroke="#9D9B98"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg></span>
                            </div>

                            <div class="fs-menu-item">
                                <div class="fs-content">
                                    <div><span><svg xmlns="http://www.w3.org/2000/svg" width="21" height="24"
                                                viewBox="0 0 21 24" fill="none">
                                                <path
                                                    d="M0.5 22.9998V21.7498C0.5 17.6123 3.8625 14.2498 8 14.2498H13C17.1375 14.2498 20.5 17.6123 20.5 21.7498V22.9998"
                                                    stroke="#9D9B98" stroke-linecap="round" stroke-linejoin="round" />
                                                <path
                                                    d="M1.4375 23.146C1.4375 18.9347 4.51101 15.1774 8.2929 15.1774H12.8632C16.6451 15.1774 19.7185 18.9347 19.7185 23.146"
                                                    fill="#EFEFEF" />
                                                <path
                                                    d="M10.4995 10.5C7.73701 10.5 5.49951 8.2625 5.49951 5.5C5.49951 2.7375 7.73701 0.5 10.4995 0.5C13.262 0.5 15.4995 2.7375 15.4995 5.5C15.4995 8.2625 13.262 10.5 10.4995 10.5Z"
                                                    stroke="#9D9B98" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg></span></div>
                                    <span>Account</span>
                                </div>

                                <span class="fs-arrow"><svg xmlns="http://www.w3.org/2000/svg" width="8" height="15"
                                        viewBox="0 0 8 15" fill="none">
                                        <path d="M0.5 0.5L7.06033 7.06033L0.610127 13.5105" stroke="#9D9B98"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg></span>
                            </div>

                            <div class="fs-menu-item">
                                <div class="fs-content">
                                    <div><span><svg xmlns="http://www.w3.org/2000/svg" width="20" height="16"
                                                viewBox="0 0 20 16" fill="none">
                                                <path
                                                    d="M10 7.0459C11.5107 7.0459 12.6428 7.86238 13.3857 8.92969V8.93066C14.1273 9.98987 14.4999 11.3108 14.5 12.3633C14.5 13.4761 13.8525 14.2676 12.9844 14.7695L12.9834 14.7705C12.1204 15.27 11.0124 15.5 10 15.5C8.98789 15.5 7.87921 15.2682 7.01562 14.7695L6.85547 14.6729C6.06858 14.1698 5.5 13.4075 5.5 12.3633C5.50008 11.3766 5.82756 10.1545 6.47949 9.13281L6.61426 8.93066C7.35909 7.86387 8.49106 7.0459 10 7.0459ZM2.14258 7.0459C2.62465 7.0459 3.04274 7.34487 3.3291 7.78223C3.61535 8.21881 3.78605 8.8114 3.78613 9.4541C3.78613 10.097 3.61542 10.6903 3.3291 11.127H3.32812C3.04229 11.5647 2.62511 11.8633 2.14258 11.8633C1.66068 11.8632 1.24334 11.5641 0.957031 11.127C0.670713 10.6903 0.5 10.097 0.5 9.4541C0.500079 8.8114 0.670779 8.21881 0.957031 7.78223V7.78125C1.24281 7.34371 1.66025 7.04601 2.14258 7.0459ZM17.8574 7.0459C18.3393 7.04601 18.7567 7.345 19.043 7.78223C19.3292 8.21881 19.4999 8.8114 19.5 9.4541C19.5 10.0167 19.37 10.5413 19.1455 10.9561L19.043 11.127C18.7572 11.5646 18.3398 11.8632 17.8574 11.8633C17.3754 11.8633 16.9573 11.5643 16.6709 11.127C16.3846 10.6903 16.2139 10.097 16.2139 9.4541C16.2139 8.8114 16.3846 8.21881 16.6709 7.78223L16.6719 7.78125C16.9577 7.34376 17.3751 7.0459 17.8574 7.0459ZM6.42871 0.5C6.91055 0.500058 7.32793 0.799265 7.61426 1.23633V1.2373C7.90058 1.67399 8.07129 2.2663 8.07129 2.90918C8.07127 3.55202 7.90056 4.14439 7.61426 4.58105V4.58203C7.32845 5.01972 6.91116 5.3183 6.42871 5.31836C5.94664 5.31836 5.52855 5.01841 5.24219 4.58105C4.95594 4.1444 4.78615 3.55195 4.78613 2.90918C4.78613 2.26644 4.95598 1.67396 5.24219 1.2373L5.24316 1.23633C5.529 0.798602 5.9462 0.5 6.42871 0.5ZM13.5713 0.5C14.0533 0.5 14.4715 0.799049 14.7578 1.23633V1.2373C15.044 1.67396 15.2139 2.26644 15.2139 2.90918C15.2139 3.55195 15.0441 4.1444 14.7578 4.58105L14.7568 4.58203C14.471 5.01969 14.0538 5.31836 13.5713 5.31836C13.1495 5.31831 12.7774 5.08862 12.499 4.73828L12.3857 4.58105L12.2832 4.41016C12.0589 3.99547 11.9287 3.47158 11.9287 2.90918C11.9287 2.2663 12.0994 1.67399 12.3857 1.2373V1.23633C12.6715 0.798611 13.0888 0.500058 13.5713 0.5Z"
                                                    fill="#E5E5E5" stroke="#9D9B98" />
                                            </svg></span></div>
                                    <span>Pets</span>
                                </div>

                                <span class="fs-arrow"><svg xmlns="http://www.w3.org/2000/svg" width="8" height="15"
                                        viewBox="0 0 8 15" fill="none">
                                        <path d="M0.5 0.5L7.06033 7.06033L0.610127 13.5105" stroke="#9D9B98"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg></span>
                            </div>
                            <div class="fs-menu-item">
                                <div class="fs-content">
                                    <div><span><svg xmlns="http://www.w3.org/2000/svg" width="20" height="25"
                                                viewBox="0 0 20 25" fill="none">
                                                <path
                                                    d="M9.62652 2.16654C9.83944 2.09197 10.0713 2.09159 10.2845 2.16546L17.7891 4.76602C18.1917 4.90553 18.4617 5.28481 18.4617 5.71089V13.6401C18.4617 17.9053 12.1238 21.4721 10.4184 22.3547C10.1529 22.4921 9.84737 22.4921 9.58183 22.3547C7.87642 21.4721 1.53857 17.9053 1.53857 13.6401V5.70842C1.53857 5.28355 1.80705 4.90506 2.20804 4.76463L9.62652 2.16654Z"
                                                    fill="#EFEFEF" />
                                                <path
                                                    d="M9.78125 0.589844C9.88907 0.551502 10.0073 0.550884 10.1152 0.588867L19.166 3.77344C19.366 3.84382 19.4999 4.03309 19.5 4.24512V13.9062C19.5 16.2585 17.7427 18.5031 15.6045 20.3408C13.4925 22.1559 11.1379 23.4649 10.1963 23.9561C10.0725 24.0205 9.92748 24.0205 9.80371 23.9561C8.86207 23.4649 6.50748 22.1559 4.39551 20.3408C2.25728 18.5031 0.5 16.2585 0.5 13.9062V4.24316C0.5 4.0317 0.632852 3.84244 0.832031 3.77148L9.78125 0.589844Z"
                                                    stroke="#9D9B98" />
                                                <path
                                                    d="M6.58377 12.964L9.20107 15.5813L14.2565 10.5259C14.494 10.2884 14.4947 9.90345 14.258 9.66507C14.0201 9.4255 13.6328 9.42481 13.3941 9.66355L9.20107 13.8566L7.4431 12.1035C7.20554 11.8666 6.821 11.8669 6.58377 12.1041C6.34631 12.3416 6.34631 12.7266 6.58377 12.964Z"
                                                    fill="#E2E2E2" />
                                            </svg></span></div>
                                    <span>Safety</span>
                                </div>

                                <span class="fs-arrow"><svg xmlns="http://www.w3.org/2000/svg" width="8" height="15"
                                        viewBox="0 0 8 15" fill="none">
                                        <path d="M0.5 0.5L7.06033 7.06033L0.610127 13.5105" stroke="#9D9B98"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg></span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="fs-card fs-card-2">

                    <div class="fs-card-header">
                        <span class="fs-back-arrow"><svg xmlns="http://www.w3.org/2000/svg" width="9" height="16"
                                viewBox="0 0 9 16" fill="none">
                                <path d="M7.74365 14.3737L1.00021 7.63022L7.63045 0.999976" stroke="white" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg></span>
                        <span class="fs-icon"><svg xmlns="http://www.w3.org/2000/svg" width="34" height="25" viewBox="0 0 34 25"
                                fill="none">
                                <path
                                    d="M27.6424 11.2471C30.7873 12.249 32.19 13.7434 32.19 16.0949C32.19 18.1864 30.282 19.8096 29.1457 20.5918C29.0918 20.6287 29.0478 20.6782 29.0174 20.736C28.987 20.7938 28.971 20.8581 28.971 20.9233V22.5512C28.971 23.251 28.2678 23.7266 27.6859 23.3379C27.2333 23.0356 26.8194 22.6756 26.4554 22.2657C26.4091 22.2135 26.35 22.1743 26.284 22.1519C26.218 22.1295 26.1472 22.1246 26.0788 22.1377C25.8494 22.182 25.6152 22.2447 25.3778 22.3083C24.9674 22.4186 24.5441 22.5328 24.1425 22.5328C22.076 22.5328 20.629 22.0886 19.1499 21.0014"
                                    stroke="#FFF8EE" stroke-width="2" stroke-linecap="round" />
                                <path
                                    d="M13.0184 19.3179C11.9642 19.3179 10.7659 19.1159 9.7326 18.9188C9.66412 18.9064 9.59363 18.9117 9.52775 18.9341C9.46187 18.9565 9.40276 18.9952 9.35598 19.0467C8.33359 20.1998 7.20024 21.0923 6.26259 21.7256C5.63442 22.1499 4.82848 21.6768 4.82848 20.9188V17.7044C4.82845 17.6391 4.81254 17.5748 4.78211 17.5171C4.75169 17.4593 4.70767 17.4098 4.65385 17.3729C2.53093 15.9122 0 13.4594 0 10.0609C0 4.41886 5.54148 0 12.616 0C19.6463 0 24.9471 4.3247 24.9471 10.0593C24.9471 15.5976 20.1533 19.3179 13.0184 19.3179Z"
                                    fill="#FFF8EE" />
                            </svg></span> FursGo Support
                    </div>

                    <div class="fs-card-body fs-2">
                        <p class="fs-status-msg">You are speaking with FursGo.</p>

                        <div class="fs-chat-bubble fs-user-msg">
                            I need support with bookings.
                        </div>

                        <div class="fs-chat-bubble fs-bot-msg">
                            Got it 👍 What's the issue with your booking?
                        </div>

                        <div class="fs-option-buttons">
                            <button class="fs-opt-btn">
                                <div>
                                    <p> Change or cancel a booking</p>
                                </div>

                                <div> <span><svg xmlns="http://www.w3.org/2000/svg" width="8" height="15" viewBox="0 0 8 15"
                                            fill="none">
                                            <path d="M0.5 0.5L7.06033 7.06033L0.610127 13.5105" stroke="#9D9B98"
                                                stroke-linecap="round" stroke-linejoin="round" />
                                        </svg></div>
                                </span>
                            </button>

                            <button class="fs-opt-btn">
                                <div>
                                    <p>Booking is pending</p>
                                </div>

                                <div> <span><svg xmlns="http://www.w3.org/2000/svg" width="8" height="15" viewBox="0 0 8 15"
                                            fill="none">
                                            <path d="M0.5 0.5L7.06033 7.06033L0.610127 13.5105" stroke="#9D9B98"
                                                stroke-linecap="round" stroke-linejoin="round" />
                                        </svg></div>
                            </button>

                            <button class="fs-opt-btn">
                                <div>
                                    <p>Something else</p>
                                </div>

                                <div> <span><svg xmlns="http://www.w3.org/2000/svg" width="8" height="15" viewBox="0 0 8 15"
                                            fill="none">
                                            <path d="M0.5 0.5L7.06033 7.06033L0.610127 13.5105" stroke="#9D9B98"
                                                stroke-linecap="round" stroke-linejoin="round" />
                                        </svg></div>
                            </button>
                        </div>

                        <div class="fs-msg-section">
                            <div class="fs-input-area">
                                <div class="fs-chat-input-wrapper">
                                    <input type="text" class="fs-chat-input" placeholder="Write a message...">

                                    <span class="fs-send-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"
                                            fill="none">
                                            <path
                                                d="M18.2448 0.0763204C19.2868 -0.287756 20.2878 0.713198 19.9237 1.75518L13.8471 19.118C13.4522 20.2441 11.8831 20.3077 11.399 19.2175L8.46685 12.6211L12.5938 8.49316C12.7297 8.34735 12.8036 8.15449 12.8001 7.95522C12.7966 7.75595 12.7159 7.56583 12.575 7.4249C12.434 7.28398 12.2439 7.20325 12.0446 7.19974C11.8454 7.19622 11.6525 7.27019 11.5067 7.40605L7.3787 11.5329L0.782123 8.60084C-0.308075 8.11575 -0.243464 6.54765 0.881605 6.15281L18.2448 0.0763204Z"
                                                fill="#FFC97A" />
                                        </svg>
                                    </span>
                                </div>


                                <div class="fs-input-footer">
                                    <div><span><svg xmlns="http://www.w3.org/2000/svg" width="11" height="12"
                                                viewBox="0 0 11 12" fill="none">
                                                <path
                                                    d="M10.5 6.04469L6.17551 10.5107C5.54818 11.1481 4.70239 11.5037 3.82235 11.5C2.94232 11.4963 2.09936 11.1336 1.47707 10.4909C0.854792 9.8483 0.503611 8.97775 0.500028 8.06891C0.496444 7.16008 0.840748 6.2866 1.45794 5.63874L5.78243 1.17272C5.98895 0.95944 6.23412 0.790259 6.50395 0.674834C6.77378 0.559409 7.06298 0.5 7.35504 0.5C7.64711 0.5 7.93631 0.559409 8.20614 0.674834C8.47597 0.790259 8.72114 0.95944 8.92766 1.17272C9.13418 1.386 9.298 1.63919 9.40977 1.91785C9.52153 2.19652 9.57906 2.49518 9.57906 2.7968C9.57906 3.09842 9.52153 3.39709 9.40977 3.67575C9.298 3.95441 9.13418 4.20761 8.92766 4.42089L4.60317 8.88691C4.3946 9.10231 4.1117 9.22333 3.81673 9.22333C3.52175 9.22333 3.23886 9.10231 3.03028 8.88691C2.8217 8.6715 2.70452 8.37935 2.70452 8.07472C2.70452 7.77009 2.8217 7.47794 3.03028 7.26254L6.96168 3.20304"
                                                    stroke="#3B3731" stroke-linecap="round" />
                                            </svg> Attach &nbsp;</span>
                                        <hr class="vertical-line-1">
                                        <span>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12"
                                                fill="none">
                                                <path
                                                    d="M10.2778 0.5H1.72222C1.04721 0.5 0.5 1.04721 0.5 1.72222V10.2778C0.5 10.9528 1.04721 11.5 1.72222 11.5H10.2778C10.9528 11.5 11.5 10.9528 11.5 10.2778V1.72222C11.5 1.04721 10.9528 0.5 10.2778 0.5Z"
                                                    stroke="#3B3731" stroke-linecap="round" stroke-linejoin="round" />
                                                <path
                                                    d="M4.16656 5.3889C4.84157 5.3889 5.38878 4.84169 5.38878 4.16668C5.38878 3.49167 4.84157 2.94446 4.16656 2.94446C3.49154 2.94446 2.94434 3.49167 2.94434 4.16668C2.94434 4.84169 3.49154 5.3889 4.16656 5.3889Z"
                                                    stroke="#3B3731" stroke-linecap="round" stroke-linejoin="round" />
                                                <path
                                                    d="M11.5002 7.83346L9.61427 5.94757C9.38507 5.71844 9.07425 5.58972 8.75016 5.58972C8.42607 5.58972 8.11525 5.71844 7.88605 5.94757L2.3335 11.5001"
                                                    stroke="#3B3731" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg> Upload
                                        </span>

                                    </div>
                                    <div> <span>0/3,000</span></div>


                                </div>
                            </div>
                        </div>


                    </div>

                </div>

                <div class="fs-card fs-card-3">

                    <div class="fs-card-header">
                        <span class="fs-back-arrow"><svg xmlns="http://www.w3.org/2000/svg" width="9" height="16"
                                viewBox="0 0 9 16" fill="none">
                                <path d="M7.74365 14.3737L1.00021 7.63022L7.63045 0.999976" stroke="white" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg></span>
                        <span class="fs-icon"><svg xmlns="http://www.w3.org/2000/svg" width="34" height="25" viewBox="0 0 34 25"
                                fill="none">
                                <path
                                    d="M27.6424 11.2471C30.7873 12.249 32.19 13.7434 32.19 16.0949C32.19 18.1864 30.282 19.8096 29.1457 20.5918C29.0918 20.6287 29.0478 20.6782 29.0174 20.736C28.987 20.7938 28.971 20.8581 28.971 20.9233V22.5512C28.971 23.251 28.2678 23.7266 27.6859 23.3379C27.2333 23.0356 26.8194 22.6756 26.4554 22.2657C26.4091 22.2135 26.35 22.1743 26.284 22.1519C26.218 22.1295 26.1472 22.1246 26.0788 22.1377C25.8494 22.182 25.6152 22.2447 25.3778 22.3083C24.9674 22.4186 24.5441 22.5328 24.1425 22.5328C22.076 22.5328 20.629 22.0886 19.1499 21.0014"
                                    stroke="#FFF8EE" stroke-width="2" stroke-linecap="round" />
                                <path
                                    d="M13.0184 19.3179C11.9642 19.3179 10.7659 19.1159 9.7326 18.9188C9.66412 18.9064 9.59363 18.9117 9.52775 18.9341C9.46187 18.9565 9.40276 18.9952 9.35598 19.0467C8.33359 20.1998 7.20024 21.0923 6.26259 21.7256C5.63442 22.1499 4.82848 21.6768 4.82848 20.9188V17.7044C4.82845 17.6391 4.81254 17.5748 4.78211 17.5171C4.75169 17.4593 4.70767 17.4098 4.65385 17.3729C2.53093 15.9122 0 13.4594 0 10.0609C0 4.41886 5.54148 0 12.616 0C19.6463 0 24.9471 4.3247 24.9471 10.0593C24.9471 15.5976 20.1533 19.3179 13.0184 19.3179Z"
                                    fill="#FFF8EE" />
                            </svg></span> FursGo Support
                    </div>

                    <div class="fs-card-body fs-2">

                        <div class="fs-chat-bubble fs-user-msg" style="height: 56px;">
                            lorem ipsum dolor sit amet.
                        </div>

                        <div class="fs-chat-bubble fs-bot-msg">
                            Thanks! Most future bookings can be changed, depending on the provider’s policy.
                        </div>

                        <div class="fs-chat-bubble fs-user-msg">
                            That’s not what i’m asking.
                        </div>

                        <div class="fs-chat-bubble fs-bot-msg">
                            I couldn’t find an exact answer for that. Would you like to:
                        </div>

                        <div class="fs-chat-bubble fs-bot-msg"
                            style="background-color:#FBAC83; color:#fff; padding:7px; padding-left:12px; width:251; height: 48px; display: flex;  gap: 3rem;  align-items: center;">
                            <div>
                                <p> Submit a support request</p>

                            </div>
                            <div><span><svg xmlns="http://www.w3.org/2000/svg" width="8" height="15" viewBox="0 0 8 15"
                                        fill="none">
                                        <path d="M0.5 0.5L7.06033 7.06033L0.610127 13.5105" stroke="white"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg></span></div>

                        </div>

                        <div class="fs-msg-section">
                            <div class="fs-input-area">
                                <div class="fs-chat-input-wrapper">
                                    <input type="text" class="fs-chat-input" placeholder="Write a message...">

                                    <span class="fs-send-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"
                                            fill="none">
                                            <path
                                                d="M18.2448 0.0763204C19.2868 -0.287756 20.2878 0.713198 19.9237 1.75518L13.8471 19.118C13.4522 20.2441 11.8831 20.3077 11.399 19.2175L8.46685 12.6211L12.5938 8.49316C12.7297 8.34735 12.8036 8.15449 12.8001 7.95522C12.7966 7.75595 12.7159 7.56583 12.575 7.4249C12.434 7.28398 12.2439 7.20325 12.0446 7.19974C11.8454 7.19622 11.6525 7.27019 11.5067 7.40605L7.3787 11.5329L0.782123 8.60084C-0.308075 8.11575 -0.243464 6.54765 0.881605 6.15281L18.2448 0.0763204Z"
                                                fill="#FFC97A" />
                                        </svg>
                                    </span>
                                </div>


                                <div class="fs-input-footer">
                                    <div><span><svg xmlns="http://www.w3.org/2000/svg" width="11" height="12"
                                                viewBox="0 0 11 12" fill="none">
                                                <path
                                                    d="M10.5 6.04469L6.17551 10.5107C5.54818 11.1481 4.70239 11.5037 3.82235 11.5C2.94232 11.4963 2.09936 11.1336 1.47707 10.4909C0.854792 9.8483 0.503611 8.97775 0.500028 8.06891C0.496444 7.16008 0.840748 6.2866 1.45794 5.63874L5.78243 1.17272C5.98895 0.95944 6.23412 0.790259 6.50395 0.674834C6.77378 0.559409 7.06298 0.5 7.35504 0.5C7.64711 0.5 7.93631 0.559409 8.20614 0.674834C8.47597 0.790259 8.72114 0.95944 8.92766 1.17272C9.13418 1.386 9.298 1.63919 9.40977 1.91785C9.52153 2.19652 9.57906 2.49518 9.57906 2.7968C9.57906 3.09842 9.52153 3.39709 9.40977 3.67575C9.298 3.95441 9.13418 4.20761 8.92766 4.42089L4.60317 8.88691C4.3946 9.10231 4.1117 9.22333 3.81673 9.22333C3.52175 9.22333 3.23886 9.10231 3.03028 8.88691C2.8217 8.6715 2.70452 8.37935 2.70452 8.07472C2.70452 7.77009 2.8217 7.47794 3.03028 7.26254L6.96168 3.20304"
                                                    stroke="#3B3731" stroke-linecap="round" />
                                            </svg> Attach</span>
                                        <hr class="vertical-line-1">
                                        <span>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12"
                                                fill="none">
                                                <path
                                                    d="M10.2778 0.5H1.72222C1.04721 0.5 0.5 1.04721 0.5 1.72222V10.2778C0.5 10.9528 1.04721 11.5 1.72222 11.5H10.2778C10.9528 11.5 11.5 10.9528 11.5 10.2778V1.72222C11.5 1.04721 10.9528 0.5 10.2778 0.5Z"
                                                    stroke="#3B3731" stroke-linecap="round" stroke-linejoin="round" />
                                                <path
                                                    d="M4.16656 5.3889C4.84157 5.3889 5.38878 4.84169 5.38878 4.16668C5.38878 3.49167 4.84157 2.94446 4.16656 2.94446C3.49154 2.94446 2.94434 3.49167 2.94434 4.16668C2.94434 4.84169 3.49154 5.3889 4.16656 5.3889Z"
                                                    stroke="#3B3731" stroke-linecap="round" stroke-linejoin="round" />
                                                <path
                                                    d="M11.5002 7.83346L9.61427 5.94757C9.38507 5.71844 9.07425 5.58972 8.75016 5.58972C8.42607 5.58972 8.11525 5.71844 7.88605 5.94757L2.3335 11.5001"
                                                    stroke="#3B3731" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg> Upload
                                        </span>

                                    </div>
                                    <div> <span>0/3,000</span></div>


                                </div>
                            </div>
                        </div>


                    </div>

                </div>

            </div>
        </div>
    </div>



    <script>
        function toggleChat(e) {
            e.stopPropagation(); // prevent outside click from firing

            const panel = document.getElementById('chat-panel');
            const openIcon = document.getElementById('chat-open-icon');
            const closeIcon = document.getElementById('chat-close-icon');
            const body = document.body;

            panel.classList.toggle('open');
            body.classList.toggle('chat-open');

            const isOpen = panel.classList.contains('open');

            // Toggle icons
            openIcon.style.display = isOpen ? 'none' : 'block';
            closeIcon.style.display = isOpen ? 'block' : 'none';
        }

        // Attach click properly (remove inline onclick from HTML)
        document.getElementById('chat-btn').addEventListener('click', toggleChat);


        // Close on outside click
        document.addEventListener('click', function(e) {
            const panel = document.getElementById('chat-panel');
            const btn = document.getElementById('chat-btn');
            const openIcon = document.getElementById('chat-open-icon');
            const closeIcon = document.getElementById('chat-close-icon');
            const body = document.body;

            if (!panel.contains(e.target) && !btn.contains(e.target)) {
                panel.classList.remove('open');
                body.classList.remove('chat-open');

                // Reset icons
                openIcon.style.display = 'block';
                closeIcon.style.display = 'none';
            }
        });
    </script>

    <?php include('components/footer.php'); ?>


    <script src="<?= BASE_URL ?>/assets/js/custom.js"></script>

    <!-- cookies popup  -->
    
    <script>
        document.addEventListener("DOMContentLoaded", function() {

            const COOKIE_KEY = "fs_cookie_consent";

            const cookieOverlay = document.querySelector(".cookie-overlay");
            const consentOverlay = document.querySelector(".fs-consent-overlay");

            const manageBtn = document.querySelector(".fs-manage-btn");
            const closeBtn = document.querySelector(".fs-close-btn");
            const managePrefBtn = document.querySelector(".manage-pref-button");

            const acceptAllBtn = document.querySelector(".fs-accept-all");
            const saveBtn = document.querySelector(".fs-save-btn");
            const allowBtn = document.querySelector(".fs-allow-btn");
            const declineBtn = document.querySelector(".fs-decline-btn");

            function lockScroll() {
                document.body.style.overflow = "hidden";
            }

            function unlockScroll() {
                document.body.style.overflow = "";
            }

            function show(el) {
                if (!el) return;
                el.style.display = "flex";
                lockScroll();
            }

            function hide(el) {
                if (!el) return;
                el.style.display = "none";
            }

            function hideAll() {
                hide(cookieOverlay);
                hide(consentOverlay);
                unlockScroll();
            }

            function saveConsent(value = "accepted") {
                localStorage.setItem(COOKIE_KEY, value);
                hideAll();
            }

            /* FIRST VISIT */
            if (!localStorage.getItem(COOKIE_KEY)) {
                show(cookieOverlay);
            }

            /* open manage modal */
            manageBtn?.addEventListener("click", () => {
                hide(cookieOverlay);
                show(consentOverlay);
            });

            /* floating button */
            managePrefBtn?.addEventListener("click", () => {
                show(consentOverlay);
            });

            /* close icon */
            closeBtn?.addEventListener("click", () => {
                saveConsent("dismissed");
            });

            /* ACCEPT ALL (main modal) */
            allowBtn?.addEventListener("click", () => {
                saveConsent("accepted");
            });

            /* DECLINE */
            declineBtn?.addEventListener("click", () => {
                saveConsent("declined");
            });

            /* ACCEPT ALL (consent modal) */
            acceptAllBtn?.addEventListener("click", () => {
                saveConsent("accepted");
            });

            /* SAVE SETTINGS */
            saveBtn?.addEventListener("click", () => {
                saveConsent("custom");
            });

            /* click outside cookie modal */
            cookieOverlay?.addEventListener("click", (e) => {
                if (e.target === cookieOverlay) {
                    saveConsent("dismissed");
                }
            });

            /* click outside consent modal */
            consentOverlay?.addEventListener("click", (e) => {
                if (e.target === consentOverlay) {
                    hide(consentOverlay);
                    unlockScroll();
                }
            });

        });
    </script>

    <!-- cookies popup  -->

</body>

</html>