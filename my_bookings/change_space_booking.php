<?php
include '../function_helper.php';
include_once __DIR__ . '/../components/extras-addons.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bookings - My Bookings</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/responsive.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/bootstrap.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/media_query.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/common.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/change_groomer_space_bookings.css">

</head>

<body class="change-space">

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

                    <div class="col-lg-1"></div>

                    <div class="col-lg-10">

                        <div class="cb-nav-container mt-5">
                            <button class="cb-back-btn">
                                ← Back to My Bookings
                            </button>
                        </div>

                        <div class="cb-booking-groomer-card mt-5">
                            <div class="cb-profile-section">
                                <div class="avatar-wrap">
                                    <img class="avatar" src="http://localhost:8000/assets/images/space_card3.png" alt="Sarah's avatar">
                                    <div class="badge-shield" title="Verified">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="29" height="30" viewBox="0 0 29 30" fill="none">
                                            <path d="M14.9293 0.170856C14.6819 0.058916 14.4168 0 14.1399 0C13.8629 0 13.5978 0.058916 13.3504 0.170856L2.25651 4.87824C0.960357 5.42616 -0.0058648 6.70463 2.67979e-05 8.24823C0.0294848 14.0927 2.43326 24.7859 12.5845 29.6465C13.5684 30.1178 14.7113 30.1178 15.6952 29.6465C25.8465 24.7859 28.2502 14.0927 28.2797 8.24823C28.2856 6.70463 27.3194 5.42616 26.0232 4.87824L14.9293 0.170856Z" fill="#CBDCE8"></path>
                                            <path d="M21.818 8.18213L15.7574 14.6215L21.818 8.18213ZM13.065 14.3071C11.1862 15.0283 9.68391 14.9049 8.18164 14.3094C8.56043 19.1905 10.8362 21.067 13.8703 21.8185C13.8703 21.8185 16.1559 20.2018 16.4854 16.3693C16.521 15.9541 16.5385 15.7473 16.4529 15.5132C16.3665 15.2791 16.1968 15.1117 15.8582 14.7761C15.3006 14.2246 15.0226 13.9488 14.6915 13.8791C14.3604 13.8109 13.9286 13.9761 13.065 14.3071Z" fill="#CBDCE8"></path>
                                            <path d="M21.818 8.18213L15.7574 14.6215M13.065 14.3071C11.1862 15.0283 9.68391 14.9049 8.18164 14.3094C8.56043 19.1905 10.8362 21.067 13.8703 21.8185C13.8703 21.8185 16.1559 20.2018 16.4854 16.3693C16.521 15.9541 16.5385 15.7473 16.4529 15.5132C16.3665 15.2791 16.1968 15.1117 15.8582 14.7761C15.3006 14.2246 15.0225 13.9488 14.6915 13.8791C14.3604 13.8109 13.9286 13.9761 13.065 14.3071Z" stroke="white" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M9.31836 18.3679C9.31836 18.3679 11.2123 18.7346 13.1062 17.2725L9.31836 18.3679Z" fill="#CBDCE8"></path>
                                            <path d="M9.31836 18.3679C9.31836 18.3679 11.2123 18.7346 13.1062 17.2725" stroke="white" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M12.3485 11.4016C12.3485 11.6527 12.2488 11.8936 12.0712 12.0712C11.8936 12.2488 11.6527 12.3485 11.4016 12.3485C11.1504 12.3485 10.9095 12.2488 10.732 12.0712C10.5544 11.8936 10.4546 11.6527 10.4546 11.4016C10.4546 11.1504 10.5544 10.9095 10.732 10.732C10.9095 10.5544 11.1504 10.4546 11.4016 10.4546C11.6527 10.4546 11.8936 10.5544 12.0712 10.732C12.2488 10.9095 12.3485 11.1504 12.3485 11.4016Z" fill="#CBDCE8" stroke="white"></path>
                                            <path d="M14.2432 8.93896V9.01472V8.93896Z" fill="#CBDCE8"></path>
                                            <path d="M14.2432 8.93896V9.01472" stroke="white" stroke-linecap="round" stroke-linejoin="round"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            <div class="cb-info-grid d-flex flex-column gap-15">
                                <div class="cb-tag-row">
                                    <span class="cb-category-tag">Garden / Shed</span>
                                    <span class="cb-booking-ref">Booking reference: FG-10294</span>
                                </div>

                                <div class="cb-details-row">

                                    <div class="cb-detail-item">
                                        <div class="d-flex align-items-center gap-5">
                                            <span><svg xmlns="http://www.w3.org/2000/svg" width="19" height="17"
                                                    viewBox="0 0 19 17" fill="none">
                                                    <path
                                                        d="M0.5 8.29554C0.5 5.20139 0.5 3.6539 1.50457 2.69308C2.50914 1.73227 4.12486 1.73145 7.35714 1.73145H10.7857C14.018 1.73145 15.6346 1.73145 16.6383 2.69308C17.642 3.65472 17.6429 5.20139 17.6429 8.29554V9.93656C17.6429 13.0307 17.6429 14.5782 16.6383 15.539C15.6337 16.4998 14.018 16.5007 10.7857 16.5007H7.35714C4.12486 16.5007 2.50829 16.5007 1.50457 15.539C0.500857 14.5774 0.5 13.0307 0.5 9.93656V8.29554Z"
                                                        stroke="#3B3731" />
                                                    <path d="M4.78585 1.73077V0.5M13.3573 1.73077V0.5M0.928711 5.83333H17.2144"
                                                        stroke="#3B3731" stroke-linecap="round" />
                                                    <path
                                                        d="M14.2139 12.3975C14.2139 12.6151 14.1236 12.8238 13.9629 12.9777C13.8021 13.1315 13.5841 13.218 13.3568 13.218C13.1295 13.218 12.9114 13.1315 12.7507 12.9777C12.59 12.8238 12.4997 12.6151 12.4997 12.3975C12.4997 12.1799 12.59 11.9712 12.7507 11.8173C12.9114 11.6634 13.1295 11.577 13.3568 11.577C13.5841 11.577 13.8021 11.6634 13.9629 11.8173C14.1236 11.9712 14.2139 12.1799 14.2139 12.3975ZM14.2139 9.11543C14.2139 9.33305 14.1236 9.54175 13.9629 9.69562C13.8021 9.8495 13.5841 9.93595 13.3568 9.93595C13.1295 9.93595 12.9114 9.8495 12.7507 9.69562C12.59 9.54175 12.4997 9.33305 12.4997 9.11543C12.4997 8.89782 12.59 8.68912 12.7507 8.53524C12.9114 8.38137 13.1295 8.29492 13.3568 8.29492C13.5841 8.29492 13.8021 8.38137 13.9629 8.53524C14.1236 8.68912 14.2139 8.89782 14.2139 9.11543ZM9.92822 12.3975C9.92822 12.6151 9.83792 12.8238 9.67717 12.9777C9.51643 13.1315 9.29841 13.218 9.07108 13.218C8.84375 13.218 8.62573 13.1315 8.46499 12.9777C8.30424 12.8238 8.21394 12.6151 8.21394 12.3975C8.21394 12.1799 8.30424 11.9712 8.46499 11.8173C8.62573 11.6634 8.84375 11.577 9.07108 11.577C9.29841 11.577 9.51643 11.6634 9.67717 11.8173C9.83792 11.9712 9.92822 12.1799 9.92822 12.3975ZM9.92822 9.11543C9.92822 9.33305 9.83792 9.54175 9.67717 9.69562C9.51643 9.8495 9.29841 9.93595 9.07108 9.93595C8.84375 9.93595 8.62573 9.8495 8.46499 9.69562C8.30424 9.54175 8.21394 9.33305 8.21394 9.11543C8.21394 8.89782 8.30424 8.68912 8.46499 8.53524C8.62573 8.38137 8.84375 8.29492 9.07108 8.29492C9.29841 8.29492 9.51643 8.38137 9.67717 8.53524C9.83792 8.68912 9.92822 8.89782 9.92822 9.11543ZM5.64251 12.3975C5.64251 12.6151 5.5522 12.8238 5.39146 12.9777C5.23071 13.1315 5.01269 13.218 4.78537 13.218C4.55804 13.218 4.34002 13.1315 4.17927 12.9777C4.01853 12.8238 3.92822 12.6151 3.92822 12.3975C3.92822 12.1799 4.01853 11.9712 4.17927 11.8173C4.34002 11.6634 4.55804 11.577 4.78537 11.577C5.01269 11.577 5.23071 11.6634 5.39146 11.8173C5.5522 11.9712 5.64251 12.1799 5.64251 12.3975ZM5.64251 9.11543C5.64251 9.33305 5.5522 9.54175 5.39146 9.69562C5.23071 9.8495 5.01269 9.93595 4.78537 9.93595C4.55804 9.93595 4.34002 9.8495 4.17927 9.69562C4.01853 9.54175 3.92822 9.33305 3.92822 9.11543C3.92822 8.89782 4.01853 8.68912 4.17927 8.53524C4.34002 8.38137 4.55804 8.29492 4.78537 8.29492C5.01269 8.29492 5.23071 8.38137 5.39146 8.53524C5.5522 8.68912 5.64251 8.89782 5.64251 9.11543Z"
                                                        fill="#3B3731" />
                                                </svg></span>
                                            <p class="cb-label"> Date</p>
                                        </div>
                                        <p class="cb-value">18/12/2025</p>
                                    </div>

                                    <hr class="vertical-line">

                                    <div class="cb-detail-item">
                                        <div class="d-flex align-items-center gap-5">
                                            <span><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    viewBox="0 0 16 16" fill="none">
                                                    <path
                                                        d="M8 0.5C12.1423 0.5 15.5 3.85774 15.5 8C15.5 12.1423 12.1423 15.5 8 15.5C3.85774 15.5 0.5 12.1423 0.5 8C0.5 3.85774 3.85774 0.5 8 0.5Z"
                                                        stroke="#3B3731" stroke-linecap="round" />
                                                </svg></span>
                                            <p class="cb-label"> Time</p>
                                        </div>
                                        <p class="cb-value">14:30 - 15:30</p>
                                    </div>

                                    <hr class="vertical-line">

                                    <div class="cb-detail-item">
                                        <div class="d-flex align-items-center gap-5">
                                            <span><svg xmlns="http://www.w3.org/2000/svg" width="12" height="16"
                                                    viewBox="0 0 12 16" fill="none">
                                                    <path
                                                        d="M6 0.5C7.4694 0.5 8.87214 1.04525 9.90137 2.00586C10.9293 2.96529 11.4999 4.25871 11.5 5.59961C11.5 7.10011 10.6408 8.95946 9.51855 10.7236C8.41048 12.4655 7.10434 14.0263 6.32227 14.9082C6.14625 15.1067 5.85375 15.1067 5.67773 14.9082C4.89566 14.0263 3.58952 12.4655 2.48145 10.7236C1.35919 8.95946 0.5 7.10011 0.5 5.59961C0.500111 4.25871 1.07068 2.96529 2.09863 2.00586C3.12786 1.04525 4.53061 0.5 6 0.5ZM6 3.09961C5.30978 3.09961 4.64141 3.35564 4.14355 3.82031C3.64466 4.28597 3.35753 4.92517 3.35742 5.59961C3.35742 6.27422 3.64453 6.91413 4.14355 7.37988C4.64141 7.84453 5.30979 8.09961 6 8.09961C6.34236 8.09961 6.68202 8.03695 7 7.91406C7.31807 7.7911 7.60965 7.61022 7.85645 7.37988C8.10326 7.14952 8.30086 6.87397 8.43652 6.56836C8.57224 6.26256 8.64258 5.93289 8.64258 5.59961C8.64247 4.92517 8.35534 4.28597 7.85645 3.82031C7.35859 3.35564 6.69022 3.09961 6 3.09961Z"
                                                        stroke="#3B3731" />
                                                </svg></span>
                                            <p class="cb-label"> Location</p>
                                        </div>
                                        <p class="cb-value">At your home</p>
                                    </div>

                                    <hr class="vertical-line">

                                    <div class="cb-pet-section">
                                        <div class="details-item images-div">
                                            <img src="<?= BASE_URL ?>assets/images/pet_details_1.png" class="rounded-image first-image" height="50px" width="50px" alt="">
                                            <img src="<?= BASE_URL ?>assets/images/pet_details_2.png" class="rounded-image second-image" height="50px" width="50px" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <section class="cb-update-section cb-container">
                            <h2 class="cb-update-title">Update Date & Time</h2>

                            <div class="cb-selection-container">
                                <div class="cb-current-info">
                                    <div class="cb-info-group">
                                        <div class="d-flex align-items-center gap-5">
                                            <span><svg xmlns="http://www.w3.org/2000/svg" width="19" height="17"
                                                    viewBox="0 0 19 17" fill="none">
                                                    <path
                                                        d="M0.5 8.29554C0.5 5.20139 0.5 3.6539 1.50457 2.69308C2.50914 1.73227 4.12486 1.73145 7.35714 1.73145H10.7857C14.018 1.73145 15.6346 1.73145 16.6383 2.69308C17.642 3.65472 17.6429 5.20139 17.6429 8.29554V9.93656C17.6429 13.0307 17.6429 14.5782 16.6383 15.539C15.6337 16.4998 14.018 16.5007 10.7857 16.5007H7.35714C4.12486 16.5007 2.50829 16.5007 1.50457 15.539C0.500857 14.5774 0.5 13.0307 0.5 9.93656V8.29554Z"
                                                        stroke="#3B3731" />
                                                    <path d="M4.78585 1.73077V0.5M13.3573 1.73077V0.5M0.928711 5.83333H17.2144"
                                                        stroke="#3B3731" stroke-linecap="round" />
                                                    <path
                                                        d="M14.2139 12.3975C14.2139 12.6151 14.1236 12.8238 13.9629 12.9777C13.8021 13.1315 13.5841 13.218 13.3568 13.218C13.1295 13.218 12.9114 13.1315 12.7507 12.9777C12.59 12.8238 12.4997 12.6151 12.4997 12.3975C12.4997 12.1799 12.59 11.9712 12.7507 11.8173C12.9114 11.6634 13.1295 11.577 13.3568 11.577C13.5841 11.577 13.8021 11.6634 13.9629 11.8173C14.1236 11.9712 14.2139 12.1799 14.2139 12.3975ZM14.2139 9.11543C14.2139 9.33305 14.1236 9.54175 13.9629 9.69562C13.8021 9.8495 13.5841 9.93595 13.3568 9.93595C13.1295 9.93595 12.9114 9.8495 12.7507 9.69562C12.59 9.54175 12.4997 9.33305 12.4997 9.11543C12.4997 8.89782 12.59 8.68912 12.7507 8.53524C12.9114 8.38137 13.1295 8.29492 13.3568 8.29492C13.5841 8.29492 13.8021 8.38137 13.9629 8.53524C14.1236 8.68912 14.2139 8.89782 14.2139 9.11543ZM9.92822 12.3975C9.92822 12.6151 9.83792 12.8238 9.67717 12.9777C9.51643 13.1315 9.29841 13.218 9.07108 13.218C8.84375 13.218 8.62573 13.1315 8.46499 12.9777C8.30424 12.8238 8.21394 12.6151 8.21394 12.3975C8.21394 12.1799 8.30424 11.9712 8.46499 11.8173C8.62573 11.6634 8.84375 11.577 9.07108 11.577C9.29841 11.577 9.51643 11.6634 9.67717 11.8173C9.83792 11.9712 9.92822 12.1799 9.92822 12.3975ZM9.92822 9.11543C9.92822 9.33305 9.83792 9.54175 9.67717 9.69562C9.51643 9.8495 9.29841 9.93595 9.07108 9.93595C8.84375 9.93595 8.62573 9.8495 8.46499 9.69562C8.30424 9.54175 8.21394 9.33305 8.21394 9.11543C8.21394 8.89782 8.30424 8.68912 8.46499 8.53524C8.62573 8.38137 8.84375 8.29492 9.07108 8.29492C9.29841 8.29492 9.51643 8.38137 9.67717 8.53524C9.83792 8.68912 9.92822 8.89782 9.92822 9.11543ZM5.64251 12.3975C5.64251 12.6151 5.5522 12.8238 5.39146 12.9777C5.23071 13.1315 5.01269 13.218 4.78537 13.218C4.55804 13.218 4.34002 13.1315 4.17927 12.9777C4.01853 12.8238 3.92822 12.6151 3.92822 12.3975C3.92822 12.1799 4.01853 11.9712 4.17927 11.8173C4.34002 11.6634 4.55804 11.577 4.78537 11.577C5.01269 11.577 5.23071 11.6634 5.39146 11.8173C5.5522 11.9712 5.64251 12.1799 5.64251 12.3975ZM5.64251 9.11543C5.64251 9.33305 5.5522 9.54175 5.39146 9.69562C5.23071 9.8495 5.01269 9.93595 4.78537 9.93595C4.55804 9.93595 4.34002 9.8495 4.17927 9.69562C4.01853 9.54175 3.92822 9.33305 3.92822 9.11543C3.92822 8.89782 4.01853 8.68912 4.17927 8.53524C4.34002 8.38137 4.55804 8.29492 4.78537 8.29492C5.01269 8.29492 5.23071 8.38137 5.39146 8.53524C5.5522 8.68912 5.64251 8.89782 5.64251 9.11543Z"
                                                        fill="#3B3731" />
                                                </svg></span>
                                            <p class="cb-label"> Date</p>
                                        </div>
                                        <p class="cb-value">18/12/2025</p>
                                    </div>

                                    <div class="cb-info-group">
                                        <div class="d-flex align-items-center gap-5">
                                            <span><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    viewBox="0 0 16 16" fill="none">
                                                    <path
                                                        d="M8 0.5C12.1423 0.5 15.5 3.85774 15.5 8C15.5 12.1423 12.1423 15.5 8 15.5C3.85774 15.5 0.5 12.1423 0.5 8C0.5 3.85774 3.85774 0.5 8 0.5Z"
                                                        stroke="#3B3731" stroke-linecap="round" />
                                                </svg></span>
                                            <p class="cb-label"> Time</p>
                                        </div>
                                        <p class="cb-value">14:30 - 15:30</p>
                                        <span class="cb-sub-text">(80 minutes)</span>
                                    </div>
                                </div>

                                <div class="calendar mt-4">
                                    <div class="calendar-header">
                                        <button class="nav-btn">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="7" height="11" viewBox="0 0 7 11" fill="none">
                                                <path d="M5.53426 10.484L0.499999 5.44975L5.44975 0.500005" stroke="#3B3731"
                                                    stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                        </button>
                                        <span>October 2025</span>
                                        <button class="nav-btn">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="7" height="11" viewBox="0 0 7 11" fill="none">
                                                <path d="M0.5 10.484L5.53426 5.44975L0.58451 0.500005" stroke="#3B3731"
                                                    stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                        </button>
                                    </div>

                                    <div class="weekdays mt-4">
                                        <div>M</div>
                                        <div>T</div>
                                        <div>W</div>
                                        <div>T</div>
                                        <div>F</div>
                                        <div>S</div>
                                        <div>S</div>
                                    </div>

                                    <div class="dates mt-4">
                                        <div></div>
                                        <div></div>
                                        <div class="date">1</div>
                                        <div class="date">2</div>
                                        <div class="date">3</div>
                                        <div class="date">4</div>

                                        <div class="date">5</div>
                                        <div class="date">6</div>
                                        <div class="date">7</div>
                                        <div class="date">8</div>
                                        <div class="date">9</div>
                                        <div class="date">10</div>
                                        <div class="date">11</div>

                                        <div class="date">12</div>
                                        <div class="date">13</div>
                                        <div class="date available selected">14</div>
                                        <div class="date">15</div>
                                        <div class="date">16</div>
                                        <div class="date">17</div>
                                        <div class="date">18</div>

                                        <div class="date">19</div>
                                        <div class="date">20</div>
                                        <div class="date">21</div>
                                        <div class="date">22</div>
                                        <div class="date">23</div>
                                        <div class="date">24</div>
                                        <div class="date">25</div>

                                        <div class="date">26</div>
                                        <div class="date">27</div>
                                        <div class="date">28</div>
                                        <div class="date">29</div>
                                        <div class="date">30</div>
                                        <div class="date">31</div>
                                    </div>


                                </div>

                                <div class="cb-time-slots">
                                    <p class="cb-availability-title"><span><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                viewBox="0 0 18 18" fill="none">
                                                <path
                                                    d="M9 0C4.05 0 0 4.05 0 9C0 13.95 4.05 18 9 18C13.95 18 18 13.95 18 9C18 4.05 13.95 0 9 0ZM7.2 13.5L2.7 9L3.969 7.731L7.2 10.953L14.031 4.122L15.3 5.4L7.2 13.5Z"
                                                    fill="#D8E8B7" />
                                            </svg></span> Availability</p>
                                    <div class="time">09:00 AM</div>
                                    <div class="time selected">11:00 AM</div>
                                    <div class="time">12:00 PM</div>
                                    <div class="time" id="halfDay">16:00 PM</div>
                                    <div class="time" id="fullDay">20:00 PM</div>
                                </div>
                            </div>

                            <div class="cb-modal-footer">
                                <button class="cb-btn-cancel">Cancel</button>
                                <button class="cb-btn-save">Save</button>
                            </div>
                        </section>

                        <script>
                            // calendar
                            const monthNames = [
                                "January", "February", "March", "April", "May", "June",
                                "July", "August", "September", "October", "November", "December"
                            ];

                            let currentDate = new Date(2025, 9); // October 2025

                            const headerTitle = document.querySelector('.calendar-header span');
                            const datesContainer = document.querySelector('.dates');
                            const prevBtn = document.querySelector('.nav-btn:first-child');
                            const nextBtn = document.querySelector('.nav-btn:last-child');

                            // Example available dates (can come from backend later)
                            const availableDates = [
                                "2025-10-07",
                                "2025-10-09",
                                "2025-10-14",
                                "2025-10-15",
                                "2025-10-20",
                                "2025-10-26",
                                "2025-10-29",
                                "2025-10-30"
                            ];

                            function renderCalendar() {
                                datesContainer.innerHTML = '';

                                const year = currentDate.getFullYear();
                                const month = currentDate.getMonth();

                                headerTitle.textContent = `${monthNames[month]} ${year}`;

                                const firstDay = new Date(year, month, 1).getDay() || 7;
                                const daysInMonth = new Date(year, month + 1, 0).getDate();

                                for (let i = 1; i < firstDay; i++) {
                                    datesContainer.appendChild(document.createElement('div'));
                                }

                                for (let day = 1; day <= daysInMonth; day++) {
                                    const dateDiv = document.createElement('div');
                                    dateDiv.classList.add('date');
                                    dateDiv.textContent = day;

                                    const dateKey = `${year}-${String(month + 1).padStart(2, '0')}-${String(day).padStart(2, '0')}`;

                                    if (availableDates.includes(dateKey)) {
                                        dateDiv.classList.add('available');

                                        dateDiv.addEventListener('click', () => {
                                            document.querySelectorAll('.date').forEach(d => d.classList.remove('selected'));
                                            dateDiv.classList.add('selected');
                                        });
                                    }

                                    datesContainer.appendChild(dateDiv);
                                }
                            }

                            prevBtn.addEventListener('click', () => {
                                currentDate.setMonth(currentDate.getMonth() - 1);
                                renderCalendar();
                            });

                            nextBtn.addEventListener('click', () => {
                                currentDate.setMonth(currentDate.getMonth() + 1);
                                renderCalendar();
                            });

                            // Time selection (unchanged)
                            document.querySelectorAll('.time').forEach(time => {
                                time.addEventListener('click', () => {
                                    document.querySelectorAll('.time').forEach(t => t.classList.remove('selected'));
                                    time.classList.add('selected');
                                });
                            });

                            renderCalendar();
                        </script>

                        <div class="addons-section cb-container">
                            <h2>Add-ons Services</h2>

                            <div class="addons-grid">
                                <div class="addon-card selected">
                                    <span class="addon-name">Storage Locker</span>
                                    <div class="addon-price">
                                        <span class="currency">£5</span> <span class="unit">/ day</span>
                                    </div>
                                    <i class="fas fa-check-circle check-icon"></i>
                                </div>

                                <div class="addon-card selected">
                                    <span class="addon-name">Deep Clean</span>
                                    <div class="addon-price">
                                        <span class="currency">£10</span>
                                    </div>
                                    <i class="fas fa-check-circle check-icon"></i>
                                </div>

                                <div class="addon-card ed-4">
                                    <span class="addon-name">After-hours access</span>
                                    <div class="addon-price">
                                        <span class="currency">£20</span>
                                    </div>
                                </div>
                            </div>

                            <div class="cb-modal-footer">
                                <button class="cb-btn-cancel">Cancel</button>
                                <button class="cb-btn-save">Save</button>
                            </div>
                        </div>

                        <div class="charge-summary cb-container">
                            <div class="charge-alert">
                                You'll be charged an additional £3.00.
                            </div>
                            <div class="price-breakdown">
                                <div class="price-row">
                                    <span>Original Total</span>
                                    <span class="underline">£48.00</span>
                                </div>
                                <div class="price-row bold">
                                    <span style="color: #3B3731">Updated Total</span>
                                    <span class="underline">£61.00</span>
                                </div>
                            </div>
                        </div>

                        <div class="cb-action-footer cb-container">
                            <button class="cb-btn-outline">Cancel changes</button>
                            <button class="cb-btn-filled">Confirm changes</button>
                        </div>

                    </div>

                    <div class="col-lg-1"></div>


                </div>
            </div>
            <div class="col-lg-1"></div>
        </div>
    </div>

    <?php include '../components/footer.php' ?>

</body>

</html>