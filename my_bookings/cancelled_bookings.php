<?php include '../function_helper.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bookings - Cancelled Bookings</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/responsive.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/bootstrap.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/media_query.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/common.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/bookings_status.css">

</head>

<body class="status-cancel">

    <?php include '../components/header.php' ?>

    <div class="container mb-5 mt-5">
        <div class="row">
            <div class="col-lg-1"></div>
            <div class="col-lg-10">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="top-head d-flex align-items-center justify-content-center">
                            <h1 class="large-font">Change Booking</h1>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <button type="button" class="btn-custom btn-no-bg text-center mt-5">← Back to My Bookings</button>
                    </div>
                    <div class="col-lg-12">
                        <div class="change-booking-outer d-flex flex-column align-items-center">
                            <div class="svg-div">
                                <svg xmlns="http://www.w3.org/2000/svg" width="102" height="96" viewBox="0 0 102 96" fill="none">
                                    <path d="M5.00624 36C4.80225 39.6766 4.80225 44.0506 4.80225 49.3053V57.6169C4.80225 73.2884 4.80686 81.1221 10.2136 85.9926C15.6204 90.8632 24.3285 90.8632 41.74 90.8632H60.2088C77.6204 90.8632 86.3238 90.8591 91.7352 85.9926C97.1466 81.1262 97.1466 73.2884 97.1466 57.6169V49.3053C97.1466 44.0501 97.146 39.6763 96.9415 36H5.00624Z" fill="#FFEDED" />
                                    <path d="M1 46.4721C1 28.4229 0.999999 19.396 6.86 13.7912C12.72 8.18643 22.145 8.18164 41 8.18164H61C79.855 8.18164 89.285 8.18164 95.14 13.7912C100.995 19.4007 101 28.4229 101 46.4721V56.0447C101 74.0938 101 83.1208 95.14 88.7256C89.28 94.3303 79.855 94.3351 61 94.3351H41C22.145 94.3351 12.715 94.3351 6.86 88.7256C1.005 83.116 1 74.0938 1 56.0447V46.4721Z" stroke="#3B3731" stroke-width="2" />
                                    <path d="M25.244 8.14517V1M76.7052 8.14517V1M2.08643 31.9624H99.8628" stroke="#3B3731" stroke-width="2" stroke-linecap="round" />
                                    <circle cx="51.5" cy="63.5" r="11.25" stroke="#FF6E6E" stroke-width="2.5" />
                                    <path d="M47.8887 67.6664L55.6664 59.8887M47.8887 59.8887L55.6664 67.6664" stroke="#FF6E6E" stroke-width="2.5" stroke-linecap="round" />
                                </svg>
                            </div>

                            <div class="d-flex align-items-center gap-10 mt-5">
                                <h1 class="large-font d-flex">Your booking has been </h1>
                                <h1 class="large-font-bold">cancelled!</h1>
                            </div>
                            <p class="medium-light-font font-color">Your grooming appointment with Sarah has been cancelled.</p>


                            <div class="content-wrap">
                                <div class="booking-cards mt-5">
                                    <div class="booking-card-top bg-color d-flex align-items-center justify-content-between">
                                        <h2 class="medium-font color">Appointment Details</h2>
                                        <p class="simple-font color">Booking reference: FG-10294</p>
                                    </div>
                                    <div class="booking-card-bottom-section">
                                        <div class="d-flex align-items-center gap-20">
                                            <div class="avatar-wrap">
                                                <img class="avatar" src="<?= BASE_URL ?>assets/images/groomer-profile.png" alt="Sarah's avatar">
                                                <div class="badge-shield" title="Verified">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="33" viewBox="0 0 30 33" fill="none">
                                                        <ellipse cx="15.873" cy="16.5256" rx="9.3645" ry="8.81365" fill="white"></ellipse>
                                                        <path d="M15.44 0.185076C15.1841 0.0638192 14.9099 0 14.6235 0C14.3372 0 14.063 0.0638192 13.8071 0.185076L2.3337 5.28423C0.993208 5.87775 -0.00606541 7.26263 2.77146e-05 8.93469C0.0304934 15.2656 2.51649 26.8487 13.015 32.1138C14.0325 32.6244 15.2146 32.6244 16.2321 32.1138C26.7306 26.8487 29.2166 15.2656 29.247 8.93469C29.2531 7.26263 28.2539 5.87775 26.9134 5.28423L15.44 0.185076ZM8.82897 18.2651C9.12144 18.3416 9.43219 18.3799 9.74903 18.3799C11.8999 18.3799 13.6486 16.5483 13.6486 14.2955V10.2111H16.3418C17.0791 10.2111 17.7554 10.645 18.0844 11.3407L18.5231 12.2533H22.4227C22.9589 12.2533 23.3976 12.7128 23.3976 13.2744V15.3166C23.3976 18.1374 21.2163 20.4222 18.5231 20.4222H15.5984V23.6578C15.5984 24.1237 15.2389 24.5066 14.7881 24.5066C14.6784 24.5066 14.5687 24.4811 14.4712 24.4364L8.45729 21.7368C8.05514 21.5581 7.79923 21.1433 7.79923 20.6902C7.79923 20.5115 7.83579 20.3392 7.915 20.1796L8.82897 18.2651ZM8.77413 10.2111H11.6988V14.2955C11.6988 15.4251 10.8275 16.3377 9.74903 16.3377C8.67055 16.3377 7.79923 15.4251 7.79923 14.2955V11.2322C7.79923 10.6706 8.23794 10.2111 8.77413 10.2111ZM16.5733 13.2744C16.5733 13.0036 16.4706 12.7439 16.2878 12.5524C16.105 12.3609 15.857 12.2533 15.5984 12.2533C15.3399 12.2533 15.0919 12.3609 14.9091 12.5524C14.7262 12.7439 14.6235 13.0036 14.6235 13.2744C14.6235 13.5452 14.7262 13.8049 14.9091 13.9964C15.0919 14.1879 15.3399 14.2955 15.5984 14.2955C15.857 14.2955 16.105 14.1879 16.2878 13.9964C16.4706 13.8049 16.5733 13.5452 16.5733 13.2744Z" fill="#C9DDA0"></path>
                                                    </svg>
                                                </div>
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <p class="medium-font-bold">Sarah’s Grooming Studio</p>
                                                <p class="medium-muted-font">Sarah W.</p>
                                                <div class="tag mt-2">Home Visits</div>
                                            </div>

                                        </div>
                                        <div class="booking-details-listing d-flex align-items-center justify-content-between mt-5">
                                            <div class="d-flex flex-column">
                                                <div class="d-flex align-items-center gap-15">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="17" viewBox="0 0 16 17" fill="none">
                                                        <path d="M4.94591 11.5544C6.23114 12.8397 9.35699 11.798 11.9274 9.22713C14.4983 6.65667 15.54 3.53082 14.2548 2.24559M8.72754 1.37259L9.30927 1.95473M6.6915 3.40904L7.27322 3.99077M4.9455 5.73636L5.52722 6.31809M4.36377 8.6454L4.9455 9.22713M11.9274 0.5L12.5092 1.08173M11.3457 3.99118L12.5092 5.15463M9.30968 6.02763L10.4731 7.19109M6.98236 7.77281L8.14581 8.93627" stroke="#3B3731" stroke-linecap="round" stroke-linejoin="round" />
                                                        <path d="M4.94499 13.2979C5.42698 12.8159 5.42698 12.0344 4.94499 11.5524C4.463 11.0704 3.68153 11.0704 3.19954 11.5524L0.872287 13.8797C0.390296 14.3617 0.390296 15.1431 0.872287 15.6251C1.35428 16.1071 2.13574 16.1071 2.61773 15.6251L4.94499 13.2979Z" stroke="#3B3731" stroke-linecap="round" stroke-linejoin="round" />
                                                    </svg>
                                                    <p class="medium-font-bold">Service</p>
                                                </div>
                                                <p class="medium-light-font mt-2">Full Groom</p>
                                            </div>

                                            <hr class="vertical-line">

                                            <div class="d-flex flex-column">
                                                <div class="d-flex align-items-center gap-15">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="19" height="17" viewBox="0 0 19 17" fill="none">
                                                        <path d="M0.5 8.29456C0.5 5.20041 0.5 3.65293 1.50457 2.69211C2.50914 1.73129 4.12486 1.73047 7.35714 1.73047H10.7857C14.018 1.73047 15.6346 1.73047 16.6383 2.69211C17.642 3.65375 17.6429 5.20041 17.6429 8.29456V9.93559C17.6429 13.0297 17.6429 14.5772 16.6383 15.538C15.6337 16.4989 14.018 16.4997 10.7857 16.4997H7.35714C4.12486 16.4997 2.50829 16.4997 1.50457 15.538C0.500857 14.5764 0.5 13.0297 0.5 9.93559V8.29456Z" stroke="#3B3731" />
                                                        <path d="M4.78585 1.73077V0.5M13.3573 1.73077V0.5M0.928711 5.83333H17.2144" stroke="#3B3731" stroke-linecap="round" />
                                                        <path d="M14.2144 12.3955C14.2144 12.6131 14.1241 12.8218 13.9634 12.9757C13.8026 13.1296 13.5846 13.216 13.3573 13.216C13.13 13.216 12.9119 13.1296 12.7512 12.9757C12.5904 12.8218 12.5001 12.6131 12.5001 12.3955C12.5001 12.1779 12.5904 11.9692 12.7512 11.8153C12.9119 11.6615 13.13 11.575 13.3573 11.575C13.5846 11.575 13.8026 11.6615 13.9634 11.8153C14.1241 11.9692 14.2144 12.1779 14.2144 12.3955ZM14.2144 9.11348C14.2144 9.33109 14.1241 9.53979 13.9634 9.69367C13.8026 9.84755 13.5846 9.93399 13.3573 9.93399C13.13 9.93399 12.9119 9.84755 12.7512 9.69367C12.5904 9.53979 12.5001 9.33109 12.5001 9.11348C12.5001 8.89587 12.5904 8.68717 12.7512 8.53329C12.9119 8.37942 13.13 8.29297 13.3573 8.29297C13.5846 8.29297 13.8026 8.37942 13.9634 8.53329C14.1241 8.68717 14.2144 8.89587 14.2144 9.11348ZM9.92871 12.3955C9.92871 12.6131 9.83841 12.8218 9.67766 12.9757C9.51691 13.1296 9.2989 13.216 9.07157 13.216C8.84424 13.216 8.62622 13.1296 8.46548 12.9757C8.30473 12.8218 8.21443 12.6131 8.21443 12.3955C8.21443 12.1779 8.30473 11.9692 8.46548 11.8153C8.62622 11.6615 8.84424 11.575 9.07157 11.575C9.2989 11.575 9.51691 11.6615 9.67766 11.8153C9.83841 11.9692 9.92871 12.1779 9.92871 12.3955ZM9.92871 9.11348C9.92871 9.33109 9.83841 9.53979 9.67766 9.69367C9.51691 9.84755 9.2989 9.93399 9.07157 9.93399C8.84424 9.93399 8.62622 9.84755 8.46548 9.69367C8.30473 9.53979 8.21443 9.33109 8.21443 9.11348C8.21443 8.89587 8.30473 8.68717 8.46548 8.53329C8.62622 8.37942 8.84424 8.29297 9.07157 8.29297C9.2989 8.29297 9.51691 8.37942 9.67766 8.53329C9.83841 8.68717 9.92871 8.89587 9.92871 9.11348ZM5.643 12.3955C5.643 12.6131 5.55269 12.8218 5.39195 12.9757C5.2312 13.1296 5.01318 13.216 4.78585 13.216C4.55853 13.216 4.34051 13.1296 4.17976 12.9757C4.01902 12.8218 3.92871 12.6131 3.92871 12.3955C3.92871 12.1779 4.01902 11.9692 4.17976 11.8153C4.34051 11.6615 4.55853 11.575 4.78585 11.575C5.01318 11.575 5.2312 11.6615 5.39195 11.8153C5.55269 11.9692 5.643 12.1779 5.643 12.3955ZM5.643 9.11348C5.643 9.33109 5.55269 9.53979 5.39195 9.69367C5.2312 9.84755 5.01318 9.93399 4.78585 9.93399C4.55853 9.93399 4.34051 9.84755 4.17976 9.69367C4.01902 9.53979 3.92871 9.33109 3.92871 9.11348C3.92871 8.89587 4.01902 8.68717 4.17976 8.53329C4.34051 8.37942 4.55853 8.29297 4.78585 8.29297C5.01318 8.29297 5.2312 8.37942 5.39195 8.53329C5.55269 8.68717 5.643 8.89587 5.643 9.11348Z" fill="#3B3731" />
                                                    </svg>
                                                    <p class="medium-font-bold">Date</p>
                                                </div>
                                                <p class="medium-light-font mt-2">18/12/2025</p>
                                            </div>

                                            <hr class="vertical-line">

                                            <div class="d-flex flex-column">
                                                <div class="d-flex align-items-center gap-15">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                                        <!-- Clock circle -->
                                                        <path d="M8 0.5C12.1423 0.5 15.5 3.85774 15.5 8C15.5 12.1423 12.1423 15.5 8 15.5C3.85774 15.5 0.5 12.1423 0.5 8C0.5 3.85774 3.85774 0.5 8 0.5Z" stroke="#3B3731" stroke-linecap="round" />
                                                        <!-- Hour hand (pointing to ~10) -->
                                                        <line x1="8" y1="8" x2="5.5" y2="5" stroke="#3B3731" stroke-width="1.2" stroke-linecap="round" />
                                                        <!-- Minute hand (pointing to ~12) -->
                                                        <line x1="8" y1="8" x2="8" y2="3.5" stroke="#3B3731" stroke-width="1.2" stroke-linecap="round" />
                                                        <!-- Center dot -->
                                                        <circle cx="8" cy="8" r="0.8" fill="#3B3731" />
                                                    </svg>
                                                    <p class="medium-font-bold">Time</p>
                                                </div>
                                                <p class="medium-light-font mt-2">14:30 - 15:30 (90 mins)</p>
                                            </div>



                                        </div>
                                    </div>
                                </div>

                                <div class="booking-cards no-border bg-color mt-5">

                                    <div class="booking-card-bottom-section">
                                        <div class="d-flex align-items-center gap-20">
                                            <div class="avatar-wrap">
                                                <img class="avatar" src="<?= BASE_URL ?>assets/images/pet_details_1.png" alt="Sarah's avatar">
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <p class="medium-font-bold">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="19" height="17" viewBox="0 0 19 17" fill="none">
                                                        <path d="M9.5 6.81579C6.78543 6.81579 4.49171 9.14463 3.75114 12.1358C3.42543 13.4512 3.91657 14.8474 5.12214 15.5034C6.07786 16.0234 7.49943 16.5 9.5 16.5C11.5006 16.5 12.9226 16.0234 13.8783 15.5034C15.0839 14.8474 15.5746 13.4512 15.2489 12.1358C14.5083 9.14421 12.2146 6.81579 9.5 6.81579ZM0.5 6.16063C0.5 7.32358 1.26714 8.5 2.21429 8.5C3.16143 8.5 3.92857 7.32358 3.92857 6.16063C3.92857 4.99768 3.16143 4.28947 2.21429 4.28947C1.26714 4.28947 0.5 4.99811 0.5 6.16063ZM18.5 6.16063C18.5 7.32358 17.7329 8.5 16.7857 8.5C15.8386 8.5 15.0714 7.32358 15.0714 6.16063C15.0714 4.99768 15.8386 4.28947 16.7857 4.28947C17.7329 4.28947 18.5 4.99811 18.5 6.16063ZM5 2.37116C5 3.53411 5.76714 4.71053 6.71429 4.71053C7.66143 4.71053 8.42857 3.53411 8.42857 2.37116C8.42857 1.20821 7.66143 0.5 6.71429 0.5C5.76714 0.5 5 1.20863 5 2.37116ZM14 2.37116C14 3.53411 13.2329 4.71053 12.2857 4.71053C11.3386 4.71053 10.5714 3.53411 10.5714 2.37116C10.5714 1.20821 11.3386 0.5 12.2857 0.5C13.2329 0.5 14 1.20863 14 2.37116Z" stroke="#3B3731" stroke-linecap="round" stroke-linejoin="round" />
                                                    </svg>
                                                    Bella
                                                </p>
                                                <p class="medium-light-font mt-2">Rabbit • Mini Lop</p>
                                            </div>

                                        </div>
                                        <div class="booking-details-listing d-flex align-items-center justify-content-between mt-5">
                                            <div class="d-flex flex-column">
                                                <div class="d-flex align-items-center gap-15">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="17" viewBox="0 0 16 17" fill="none">
                                                        <path d="M1.3 12.1V14.9C1.3 15.3243 1.46857 15.7313 1.76863 16.0314C2.06869 16.3314 2.47565 16.5 2.9 16.5H12.5C12.9243 16.5 13.3313 16.3314 13.6314 16.0314C13.9314 15.7313 14.1 15.3243 14.1 14.9V12.1M0.5 10.1V9.3C0.5 8.87565 0.668571 8.46869 0.968629 8.16863C1.26869 7.86857 1.67565 7.7 2.1 7.7H13.3C13.7243 7.7 14.1313 7.86857 14.4314 8.16863C14.7314 8.46869 14.9 8.87565 14.9 9.3V10.1M7.7 5.3V7.7M7.7 5.3C8.7096 5.3 9.3 4.5256 9.3 3.2C9.3 1.8744 7.7 0.5 7.7 0.5C7.7 0.5 6.1 1.8744 6.1 3.2C6.1 4.5256 6.6904 5.3 7.7 5.3Z" stroke="#3B3731" stroke-linecap="round" stroke-linejoin="round" />
                                                        <path d="M0.5 10.0977C0.5 10.7342 0.752856 11.3446 1.20294 11.7947C1.65303 12.2448 2.26348 12.4977 2.9 12.4977C3.53652 12.4977 4.14697 12.2448 4.59706 11.7947C5.04714 11.3446 5.3 10.7342 5.3 10.0977C5.3 10.7342 5.55286 11.3446 6.00294 11.7947C6.45303 12.2448 7.06348 12.4977 7.7 12.4977C8.33652 12.4977 8.94697 12.2448 9.39706 11.7947C9.84714 11.3446 10.1 10.7342 10.1 10.0977C10.1 10.7342 10.3529 11.3446 10.8029 11.7947C11.253 12.2448 11.8635 12.4977 12.5 12.4977C13.1365 12.4977 13.747 12.2448 14.1971 11.7947C14.6471 11.3446 14.9 10.7342 14.9 10.0977" stroke="#3B3731" stroke-linecap="round" stroke-linejoin="round" />
                                                    </svg>
                                                    <p class="medium-font-bold">Birthday</p>
                                                </div>
                                                <p class="medium-light-font mt-2">22/08/2020</p>
                                            </div>

                                            <hr class="vertical-line">

                                            <div class="d-flex flex-column">
                                                <div class="d-flex align-items-center gap-15">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="11" height="16" viewBox="0 0 11 16" fill="none">
                                                        <path d="M5.5 0.5C8.25285 0.5 10.4998 2.7746 10.5 5.59961C10.5 8.30137 8.44411 10.5013 5.85742 10.6875L5.5 10.7129L5.14258 10.6875C2.55591 10.5013 0.5 8.30099 0.5 5.59961C0.500207 2.7746 2.74715 0.5 5.5 0.5Z" stroke="#3B3731" />
                                                    </svg>
                                                    <p class="medium-font-bold">Sex</p>
                                                </div>
                                                <p class="medium-light-font mt-2">Female</p>
                                            </div>

                                            <hr class="vertical-line">

                                            <div class="d-flex flex-column">
                                                <div class="d-flex align-items-center gap-15">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 17 17" fill="none">
                                                        <path d="M15.1513 9.01871L15.565 7.47298C16.0482 5.66882 16.2906 4.76714 16.109 3.98627C15.9651 3.36981 15.6415 2.80989 15.1793 2.37733C14.5945 1.82928 13.692 1.58766 11.8879 1.10442C10.0837 0.620377 9.18124 0.378756 8.40117 0.560371C7.78472 0.704314 7.2248 1.02785 6.79224 1.49005C6.3226 1.9909 6.07778 2.72456 5.71375 4.05748L5.51854 4.78154L5.1049 6.32728C4.62086 8.13143 4.37924 9.03311 4.56086 9.81398C4.7048 10.4304 5.02833 10.9904 5.49054 11.4229C6.07538 11.971 6.97786 12.2126 8.78201 12.6966C10.4077 13.1319 11.3014 13.3711 12.0335 13.2807C12.1135 13.2705 12.1919 13.2567 12.2687 13.2391C12.885 13.0956 13.4449 12.7726 13.8776 12.311C14.4257 11.7253 14.6673 10.8229 15.1513 9.01871Z" stroke="#3B3731" />
                                                        <path d="M12.0333 13.2787C11.8661 13.791 11.5722 14.2528 11.1788 14.6212C10.594 15.1693 9.69152 15.4109 7.88737 15.8941C6.08322 16.3774 5.18075 16.6198 4.40069 16.4374C3.78433 16.2936 3.22442 15.9704 2.79175 15.5085C2.24371 14.9236 2.00129 14.0212 1.51805 12.217L1.10442 10.6713C0.620376 8.86711 0.378756 7.96463 0.560371 7.18456C0.704313 6.5681 1.02785 6.00818 1.49005 5.57562C2.0749 5.02757 2.97737 4.78595 4.78152 4.30191C5.12181 4.21017 5.4325 4.12776 5.71359 4.05469" stroke="#3B3731" />
                                                        <path d="M8.32282 6.89844L12.1871 7.93373M7.70117 9.21704L10.0198 9.83789" stroke="#3B3731" stroke-linecap="round" />
                                                    </svg>
                                                    <p class="medium-font-bold">Notes</p>
                                                </div>
                                                <p class="medium-light-font mt-2">Nervous around hair-dryers. </p>
                                            </div>



                                        </div>
                                    </div>
                                </div>

                                <div class="what-next mt-5">
                                    <h3 class="medium-font">What happens next?</h3>
                                    <ul class="medium-muted-font list-style-default mt-4">
                                        <li>Your groomer will review your booking and prepare for your appointment.</li>
                                        <li>You’ll receive a reminder before the session.</li>
                                        <li>You can message your groomer anytime via FursGo.</li>
                                    </ul>
                                </div>

                                <div class="d-flex align-items-center justify-content-between">
                                    <button type="button" class="btn-custom btn-no-bg blue-btn text-center mt-5">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 17 17" fill="none">
                                            <path d="M2.28125 15.5449V12.6621H5.16408" stroke="white" stroke-width="1.1" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M15.4154 6.67233C15.7213 8.30432 15.4767 9.99169 14.72 11.4697C13.9633 12.9476 12.7373 14.1326 11.2344 14.8385C9.73156 15.5444 8.03684 15.7315 6.4162 15.3702C4.79556 15.009 3.34071 14.1199 2.27994 12.8425M0.678108 9.42728C0.372236 7.79528 0.616841 6.10792 1.37354 4.62995C2.13024 3.15198 3.35621 1.96706 4.85908 1.26111C6.36195 0.555159 8.05666 0.368136 9.6773 0.729384C11.2979 1.09063 12.7528 1.97971 13.8136 3.25711" stroke="white" stroke-width="1.1" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M13.8118 0.554688V3.43751H10.9289M4.66343 8.43829C4.25542 8.36738 4.25542 7.78152 4.66343 7.71061C5.38562 7.58429 6.05393 7.24607 6.5834 6.73895C7.11287 6.23183 7.47959 5.57872 7.63693 4.86265L7.66134 4.7499C7.74968 4.34653 8.32392 4.34421 8.41576 4.74641L8.44598 4.87776C8.60835 5.59106 8.97807 6.2404 9.50862 6.74406C10.0392 7.24772 10.7068 7.5832 11.4276 7.70828C11.8379 7.77919 11.8379 8.36854 11.4276 8.44061C10.707 8.56561 10.0394 8.90092 9.50889 9.40436C8.97836 9.9078 8.60855 10.5569 8.44598 11.27L8.41576 11.4002C8.32392 11.8024 7.74968 11.8 7.66134 11.3967L7.63809 11.2851C7.48059 10.5687 7.11353 9.91536 6.58361 9.40821C6.0537 8.90106 5.38488 8.56303 4.66227 8.43713" stroke="white" stroke-width="1.1" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        Book again
                                    </button>
                                    <button type="button" class="btn-custom btn-no-bg green-btn text-center mt-5">My Bookings</button>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-1"></div>
        </div>
    </div>

    <?php include '../components/footer.php' ?>

</body>

</html>