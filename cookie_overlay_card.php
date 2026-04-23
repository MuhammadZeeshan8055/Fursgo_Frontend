<?php include 'function_helper.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="icon" href="<?= BASE_URL ?>assets/images/favicon.ico" type="image/x-icon">
    <title>Fursgo - Cookies</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/common.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

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
    </style>
    <style>
        /* fs-consent-overlay */
        .fs-card-header {
            display: flex;
            align-items: center;
            gap: 16px;
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
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            z-index: 999;
        }
    </style>

    <style>
        section.fs-consent-overlay {
            position: fixed;
            inset: 0;

            display: none;

            /* align modal to right-bottom */
            justify-content: flex-end;
            align-items: flex-end;

            /* container alignment */
            padding-right: max(20px, calc((100vw - 1350px) / 2 + 20px));
            padding-bottom: 115px;

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
                <div class="fs-card-header">
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
</body>

</html>