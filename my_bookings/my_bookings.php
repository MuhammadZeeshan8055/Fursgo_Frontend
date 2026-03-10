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

    <style>
        .top-head.d-flex.align-items-center.justify-content-center {
            padding: 25px 50px;
            border-radius: 10px;
            background: #F8F8F8;
        }

        /* Cards */

        .booking-stats {
            display: flex;
            justify-content: center;
            gap: 30px;
            margin-top: 30px;
        }

        .booking-card {
            width: 190px;
            height: 150px;
            border-radius: 10px;
            text-align: center;
            padding-top: 52px;
        }

        .booking-card h3 {
            color: #3b3731;
            text-align: center;
            font-family: Lato;
            font-size: 30px;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .active-bookings {
            background: #f5f9ed;
        }

        .total-bookings {
            background: #f2f6f9;
        }

        .total-spend {
            background: #feeae0;
        }

        .booking-filters {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .booking-filters .booking-tabs {
            display: flex;
            gap: 10px;
        }

        .booking-filters .tabs .tab {
            border: none;
        }

        .search-container {
            position: relative;
            width: 405px;
        }

        .search-container input {
            width: 100%;
            height: 48px;
            padding: 10px 45px 10px 15px;
            border-radius: 10px;
            border: 1px solid #ddd;
            font-size: 16px;
            outline: none;
            color: #333;
        }

        .search-container input::placeholder {
            color: #ccc;
        }

        .search-icon {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #999;
            font-size: 18px;
            pointer-events: none;
        }

        .tabs button {
            border: none;
            padding: 10px 20px;
            border-radius: 20px;
            border: 1px solid #d4d4d4;
            background: #ffffff;
            cursor: pointer;
            margin-right: 10px;
        }

        .tabs .active {
            color: #fff;
            font-weight: 600;
            background: #ffc97a;
        }

        .bookings-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .btn-filled {
            background-color: #fbac83;
            border: none;
            color: #fff;
        }

        .btn {
            padding: 8px 18px;
            border-radius: 25px;
            font-size: 14px;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: 0.3s;
        }

        .btn-outline {
            background: transparent;
            border: 1px solid #FBAC83;
            color: #FBAC83;
        }

        /* Filter Chips */
        .chips-container {
            display: flex;
            gap: 10px;
            margin-top: 2rem;
        }

        .chip {
            background-color: #fcf1e9;
            color: #fbac83;
            padding: 10px 20px;
            border-radius: 20px;
        }

        .close {
            font-size: 11px;
            cursor: pointer;
            opacity: 0.7;
        }

        .bookings-cards {
            border-radius: 15px;
            margin-bottom: 3rem;
            overflow: hidden;
            height: auto;
        }

        .bookings-cards-pink {
            /* border: 1px solid #d8e8b7; */
            border-radius: 15px;
            margin-bottom: 3rem;
            overflow: hidden;
            width: 820px;
            height: auto;
        }

        .bookings-cards-light {
            border: 1px solid #f8f8f8;
            border-radius: 15px;
            margin-bottom: 3rem;
            /* overflow: hidden; */
            width: 820px;
            height: auto;
        }

        .cards-header-light {
            background-color: #efefef;
            padding: 15px;
            border-radius: 12px 0px 0px 0px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .cards-header {
            display: flex;
            justify-content: space-between;
            padding: 20px 20px;
            border-bottom: 1px solid #e0eed4;
            align-items: center;
            border-radius: 12px 0px 0px 0px;
        }

        .cards-header-light {
            display: flex;
            justify-content: space-between;
            padding: 20px 20px;
            border-bottom: 1px solid #f8f8f8;
            align-items: center;
            background: #efefef;
        }

        .status-badge {
            padding: 4px 12px;
            border-radius: 20px;
            color: #fff;
        }

        .profile-section {
            padding: 20px 20px;
        }

        .service-type {
            background: #ffc97a;
            color: #fff;
            text-align: center;
            font-family: Lato;
            font-size: 14px;
            font-style: normal;
            font-weight: 500;
            line-height: normal;
            padding: 4px 10px;
            border-radius: 20px;
        }

        .vertical-line {
            width: 1px;
            height: 54px;
            background: #d4d4d4;
        }

        .card-body {
            padding-right: 2%;
        }

        /* .profile-section {
            width: min(90%, 100%);
        }

        .profile-section .listing-section,
        .profile-section .listing {
            width: 100%;
        } */

        .profile-section .item-label {
            color: #3B3731;
            font-family: Lato;
            font-size: 16px;
            font-weight: 600;
        }

        .profile-section .value {
            color: #3B3731;
            font-family: Lato;
            font-size: 16px;
            font-weight: 400;
        }

        .details-item.images-div {
            position: relative;
        }

        img.rounded-image.second-image {
            position: absolute;
            left: 30px;
        }

        .bg-green-header {
            background: #F5F9ED;
        }

        .bg-status-green-header {
            background: #C9DDA0;
        }

        .bg-border-green-header {
            border: 1px solid #d8e8b7;
        }

        .bg-gray-header {
            background: #EFEFEF;
        }

        .bg-status-gray-header {
            background: #D2D2D2;
        }

        .bg-border-gray-header {
            border: 1px solid #F8F8F8;
        }

        .bg-pink-header {
            background: #FFEDED;
        }

        .bg-status-pink-header {
            background: #FF6E6E;
        }

        .bg-border-pink-header {
            border: 1px solid #F8F8F8;
        }
    </style>
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
                            <h1 class="large-font">My Bookings</h1>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <!-- Stats Cards -->
                        <div class="booking-stats mt-5">

                            <div class="booking-card active-bookings">
                                <h3>2</h3>
                                <p class="normal-font-weight">Active Bookings</p>
                            </div>

                            <div class="booking-card total-bookings">
                                <h3>20</h3>
                                <p class="normal-font-weight">Total Booking</p>
                            </div>

                            <div class="booking-card total-spend">
                                <h3>£250</h3>
                                <p class="normal-font-weight">Total Spend</p>
                            </div>

                        </div>

                        <!-- Filters -->
                        <div class="booking-filters mt-5">

                            <div class="tabs">
                                <button class="tab active">All</button>
                                <button class="tab normal-light-color-font">Upcoming</button>
                                <button class="tab normal-light-color-font">Past</button>
                                <button class="tab normal-light-color-font">Cancelled</button>
                            </div>

                            <div class="search-container">
                                <input type="text" placeholder="Search bookings by groomer, service, or pet...">
                                <span class="search-icon"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        viewBox="0 0 16 16" fill="none">
                                        <path
                                            d="M5.73535 0.5C8.6267 0.500031 10.9707 2.844 10.9707 5.73535C10.9707 7.22006 10.3528 8.55933 9.35938 9.5127C8.41826 10.4158 7.14221 10.9707 5.73535 10.9707C2.844 10.9707 0.500031 8.6267 0.5 5.73535C0.5 2.84398 2.84398 0.5 5.73535 0.5Z"
                                            stroke="#9D9B98" />
                                        <path
                                            d="M14.6466 15.3537C14.8419 15.549 15.1585 15.549 15.3537 15.3537C15.549 15.1585 15.549 14.8419 15.3537 14.6466L15.0002 15.0002L14.6466 15.3537ZM9.70605 9.70605L9.3525 10.0596L14.6466 15.3537L15.0002 15.0002L15.3537 14.6466L10.0596 9.3525L9.70605 9.70605Z"
                                            fill="#9D9B98" />
                                    </svg></span>
                            </div>

                        </div>


                        <div class="bookings-header mt-4">
                            <div class="bookings-title">
                                <h1 class="large-font">All Bookings</h1>
                            </div>


                            <div class="actions d-flex align-items-center gap-10">
                                <button class="btn btn-filled light-color-font">
                                    2 Feb - 4 March <span class="btn-arrow"><svg xmlns="http://www.w3.org/2000/svg" width="13"
                                            height="7" viewBox="0 0 13 7" fill="none">
                                            <path d="M11.9102 0.5L6.15672 6.25344L0.499867 0.596581" stroke="white"
                                                stroke-linecap="round" stroke-linejoin="round" />
                                        </svg></span>
                                </button>
                                <button class="btn btn-outline light-color-font">
                                    Sort <span class="btn-arrow"><svg xmlns="http://www.w3.org/2000/svg" width="13" height="7"
                                            viewBox="0 0 13 7" fill="none">
                                            <path d="M11.9102 0.5L6.15672 6.25344L0.499867 0.596581" stroke="#FBAC83"
                                                stroke-linecap="round" stroke-linejoin="round" />
                                        </svg></span>
                                </button>
                            </div>
                        </div>


                        <div class="chips-container">
                            <div class="chip light-color-font d-flex align-items-center gap-10">Most Recent <span class="close"><svg xmlns="http://www.w3.org/2000/svg" width="9"
                                        height="9" viewBox="0 0 9 9" fill="none">
                                        <path d="M0.5 7.57L7.572 0.5M0.5 0.5L7.572 7.57" stroke="#FBAC83" stroke-linecap="round" />
                                    </svg></span></div>
                            <div class="chip light-color-font d-flex align-items-center gap-10">2 Feb - 4 Mar <span class="close"><svg xmlns="http://www.w3.org/2000/svg" width="9"
                                        height="9" viewBox="0 0 9 9" fill="none">
                                        <path d="M0.5 7.57L7.572 0.5M0.5 0.5L7.572 7.57" stroke="#FBAC83" stroke-linecap="round" />
                                    </svg></span></div>
                        </div>

                    </div>


                    <div class="col-lg-1"></div>

                    <div class="col-lg-10">

                        <div class="upcoming-section">
                            <h2 class="medium-font mt-5">Upcoming Bookings</h2>

                            <hr class="mt-4" style="border-top: 1px solid #D4D4D4;">

                            <div class="bookings-cards bg-border-green-header mt-5">
                                <div class="cards-header bg-green-header">
                                    <div class="header-left d-flex align-items-center gap-15">
                                        <span class="status-badge light-color-font bg-status-green-header">Confirmed</span>
                                        <span class="studio-name medium-font-bold">Sarah’s Grooming Studio - <span class="host medium-muted-font">Sarah W.</span></span>
                                    </div>
                                    <div class="booking-ref simple-font">Booking reference: FG-10294</div>
                                </div>

                                <div class="card-body d-flex justify-content-between">
                                    <div class="profile-section d-flex align-items-center gap-25">
                                        <div class="avatar-wrap">
                                            <img class="avatar" src="http://localhost:8000/assets/images/groomer-profile.png" alt="Sarah's avatar">
                                            <div class="badge-shield" title="Verified">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="33" viewBox="0 0 30 33" fill="none">
                                                    <ellipse cx="15.873" cy="16.5256" rx="9.3645" ry="8.81365" fill="white"></ellipse>
                                                    <path d="M15.44 0.185076C15.1841 0.0638192 14.9099 0 14.6235 0C14.3372 0 14.063 0.0638192 13.8071 0.185076L2.3337 5.28423C0.993208 5.87775 -0.00606541 7.26263 2.77146e-05 8.93469C0.0304934 15.2656 2.51649 26.8487 13.015 32.1138C14.0325 32.6244 15.2146 32.6244 16.2321 32.1138C26.7306 26.8487 29.2166 15.2656 29.247 8.93469C29.2531 7.26263 28.2539 5.87775 26.9134 5.28423L15.44 0.185076ZM8.82897 18.2651C9.12144 18.3416 9.43219 18.3799 9.74903 18.3799C11.8999 18.3799 13.6486 16.5483 13.6486 14.2955V10.2111H16.3418C17.0791 10.2111 17.7554 10.645 18.0844 11.3407L18.5231 12.2533H22.4227C22.9589 12.2533 23.3976 12.7128 23.3976 13.2744V15.3166C23.3976 18.1374 21.2163 20.4222 18.5231 20.4222H15.5984V23.6578C15.5984 24.1237 15.2389 24.5066 14.7881 24.5066C14.6784 24.5066 14.5687 24.4811 14.4712 24.4364L8.45729 21.7368C8.05514 21.5581 7.79923 21.1433 7.79923 20.6902C7.79923 20.5115 7.83579 20.3392 7.915 20.1796L8.82897 18.2651ZM8.77413 10.2111H11.6988V14.2955C11.6988 15.4251 10.8275 16.3377 9.74903 16.3377C8.67055 16.3377 7.79923 15.4251 7.79923 14.2955V11.2322C7.79923 10.6706 8.23794 10.2111 8.77413 10.2111ZM16.5733 13.2744C16.5733 13.0036 16.4706 12.7439 16.2878 12.5524C16.105 12.3609 15.857 12.2533 15.5984 12.2533C15.3399 12.2533 15.0919 12.3609 14.9091 12.5524C14.7262 12.7439 14.6235 13.0036 14.6235 13.2744C14.6235 13.5452 14.7262 13.8049 14.9091 13.9964C15.0919 14.1879 15.3399 14.2955 15.5984 14.2955C15.857 14.2955 16.105 14.1879 16.2878 13.9964C16.4706 13.8049 16.5733 13.5452 16.5733 13.2744Z" fill="#C9DDA0"></path>
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="listing-section d-flex flex-column align-items-start gap-15">
                                            <div class="service-type">Home Visits</div>

                                            <div class="listing d-flex align-items-center gap-25">
                                                <div class="details-item d-flex flex-column gap-10">
                                                    <div class="d-flex gap-10">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="17"
                                                            viewBox="0 0 16 17" fill="none">
                                                            <path
                                                                d="M4.94591 11.5544C6.23114 12.8397 9.35699 11.798 11.9274 9.22713C14.4983 6.65667 15.54 3.53082 14.2548 2.24559M8.72754 1.37259L9.30927 1.95473M6.6915 3.40904L7.27322 3.99077M4.9455 5.73636L5.52722 6.31809M4.36377 8.6454L4.9455 9.22713M11.9274 0.5L12.5092 1.08173M11.3457 3.99118L12.5092 5.15463M9.30968 6.02763L10.4731 7.19109M6.98236 7.77281L8.14581 8.93627"
                                                                stroke="#3B3731" stroke-linecap="round" stroke-linejoin="round" />
                                                            <path
                                                                d="M4.94547 13.2998C5.42747 12.8178 5.42747 12.0364 4.94548 11.5544C4.46348 11.0724 3.68202 11.0724 3.20003 11.5544L0.872775 13.8816C0.390784 14.3636 0.390784 15.1451 0.872775 15.6271C1.35477 16.1091 2.13623 16.1091 2.61822 15.6271L4.94547 13.2998Z"
                                                                stroke="#3B3731" stroke-linecap="round" stroke-linejoin="round" />
                                                        </svg>
                                                        <p class="item-label">Service</p>
                                                    </div>
                                                    <p class="value">Full Groom</p>
                                                </div>
                                                <hr class="vertical-line">
                                                <div class="details-item d-flex flex-column gap-10">
                                                    <div class="d-flex gap-10">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="19" height="17"
                                                            viewBox="0 0 19 17" fill="none">
                                                            <path
                                                                d="M0.5 8.29554C0.5 5.20139 0.5 3.6539 1.50457 2.69308C2.50914 1.73227 4.12486 1.73145 7.35714 1.73145H10.7857C14.018 1.73145 15.6346 1.73145 16.6383 2.69308C17.642 3.65472 17.6429 5.20139 17.6429 8.29554V9.93656C17.6429 13.0307 17.6429 14.5782 16.6383 15.539C15.6337 16.4998 14.018 16.5007 10.7857 16.5007H7.35714C4.12486 16.5007 2.50829 16.5007 1.50457 15.539C0.500857 14.5774 0.5 13.0307 0.5 9.93656V8.29554Z"
                                                                stroke="#3B3731" />
                                                            <path d="M4.78585 1.73077V0.5M13.3573 1.73077V0.5M0.928711 5.83333H17.2144"
                                                                stroke="#3B3731" stroke-linecap="round" />
                                                            <path
                                                                d="M14.2139 12.3975C14.2139 12.6151 14.1236 12.8238 13.9629 12.9777C13.8021 13.1315 13.5841 13.218 13.3568 13.218C13.1295 13.218 12.9114 13.1315 12.7507 12.9777C12.59 12.8238 12.4997 12.6151 12.4997 12.3975C12.4997 12.1799 12.59 11.9712 12.7507 11.8173C12.9114 11.6634 13.1295 11.577 13.3568 11.577C13.5841 11.577 13.8021 11.6634 13.9629 11.8173C14.1236 11.9712 14.2139 12.1799 14.2139 12.3975ZM14.2139 9.11543C14.2139 9.33305 14.1236 9.54175 13.9629 9.69562C13.8021 9.8495 13.5841 9.93595 13.3568 9.93595C13.1295 9.93595 12.9114 9.8495 12.7507 9.69562C12.59 9.54175 12.4997 9.33305 12.4997 9.11543C12.4997 8.89782 12.59 8.68912 12.7507 8.53524C12.9114 8.38137 13.1295 8.29492 13.3568 8.29492C13.5841 8.29492 13.8021 8.38137 13.9629 8.53524C14.1236 8.68912 14.2139 8.89782 14.2139 9.11543ZM9.92822 12.3975C9.92822 12.6151 9.83792 12.8238 9.67717 12.9777C9.51643 13.1315 9.29841 13.218 9.07108 13.218C8.84375 13.218 8.62573 13.1315 8.46499 12.9777C8.30424 12.8238 8.21394 12.6151 8.21394 12.3975C8.21394 12.1799 8.30424 11.9712 8.46499 11.8173C8.62573 11.6634 8.84375 11.577 9.07108 11.577C9.29841 11.577 9.51643 11.6634 9.67717 11.8173C9.83792 11.9712 9.92822 12.1799 9.92822 12.3975ZM9.92822 9.11543C9.92822 9.33305 9.83792 9.54175 9.67717 9.69562C9.51643 9.8495 9.29841 9.93595 9.07108 9.93595C8.84375 9.93595 8.62573 9.8495 8.46499 9.69562C8.30424 9.54175 8.21394 9.33305 8.21394 9.11543C8.21394 8.89782 8.30424 8.68912 8.46499 8.53524C8.62573 8.38137 8.84375 8.29492 9.07108 8.29492C9.29841 8.29492 9.51643 8.38137 9.67717 8.53524C9.83792 8.68912 9.92822 8.89782 9.92822 9.11543ZM5.64251 12.3975C5.64251 12.6151 5.5522 12.8238 5.39146 12.9777C5.23071 13.1315 5.01269 13.218 4.78537 13.218C4.55804 13.218 4.34002 13.1315 4.17927 12.9777C4.01853 12.8238 3.92822 12.6151 3.92822 12.3975C3.92822 12.1799 4.01853 11.9712 4.17927 11.8173C4.34002 11.6634 4.55804 11.577 4.78537 11.577C5.01269 11.577 5.23071 11.6634 5.39146 11.8173C5.5522 11.9712 5.64251 12.1799 5.64251 12.3975ZM5.64251 9.11543C5.64251 9.33305 5.5522 9.54175 5.39146 9.69562C5.23071 9.8495 5.01269 9.93595 4.78537 9.93595C4.55804 9.93595 4.34002 9.8495 4.17927 9.69562C4.01853 9.54175 3.92822 9.33305 3.92822 9.11543C3.92822 8.89782 4.01853 8.68912 4.17927 8.53524C4.34002 8.38137 4.55804 8.29492 4.78537 8.29492C5.01269 8.29492 5.23071 8.38137 5.39146 8.53524C5.5522 8.68912 5.64251 8.89782 5.64251 9.11543Z"
                                                                fill="#3B3731" />
                                                        </svg>
                                                        <p class="item-label">Date</p>
                                                    </div>
                                                    <p class="value">18/12/2025</p>
                                                </div>
                                                <hr class="vertical-line">
                                                <div class="details-item d-flex flex-column gap-10">
                                                    <div class="d-flex gap-10">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                            viewBox="0 0 16 16" fill="none">
                                                            <path
                                                                d="M8 0.5C12.1423 0.5 15.5 3.85774 15.5 8C15.5 12.1423 12.1423 15.5 8 15.5C3.85774 15.5 0.5 12.1423 0.5 8C0.5 3.85774 3.85774 0.5 8 0.5Z"
                                                                stroke="#3B3731" stroke-linecap="round" />
                                                        </svg>
                                                        <p class="item-label">Time</p>
                                                    </div>
                                                    <p class="value">14:30 - 15:30</p>
                                                </div>
                                                <hr class="vertical-line">
                                                <div class="details-item d-flex flex-column gap-10">
                                                    <div class="d-flex gap-10">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="16"
                                                            viewBox="0 0 12 16" fill="none">
                                                            <path
                                                                d="M6 0.5C7.4694 0.5 8.87214 1.04525 9.90137 2.00586C10.9293 2.96529 11.4999 4.25871 11.5 5.59961C11.5 7.10011 10.6408 8.95946 9.51855 10.7236C8.41048 12.4655 7.10434 14.0263 6.32227 14.9082C6.14625 15.1067 5.85375 15.1067 5.67773 14.9082C4.89566 14.0263 3.58952 12.4655 2.48145 10.7236C1.35919 8.95946 0.5 7.10011 0.5 5.59961C0.500111 4.25871 1.07068 2.96529 2.09863 2.00586C3.12786 1.04525 4.53061 0.5 6 0.5ZM6 3.09961C5.30978 3.09961 4.64141 3.35564 4.14355 3.82031C3.64466 4.28597 3.35753 4.92517 3.35742 5.59961C3.35742 6.27422 3.64453 6.91413 4.14355 7.37988C4.64141 7.84453 5.30979 8.09961 6 8.09961C6.34236 8.09961 6.68202 8.03695 7 7.91406C7.31807 7.7911 7.60965 7.61022 7.85645 7.37988C8.10326 7.14952 8.30086 6.87397 8.43652 6.56836C8.57224 6.26256 8.64258 5.93289 8.64258 5.59961C8.64247 4.92517 8.35534 4.28597 7.85645 3.82031C7.35859 3.35564 6.69022 3.09961 6 3.09961Z"
                                                                stroke="#3B3731" />
                                                        </svg>
                                                        <p class="item-label">Location</p>
                                                    </div>
                                                    <p class="value">At your home</p>
                                                </div>
                                                <hr class="vertical-line">
                                                <div class="details-item">
                                                    <img src="<?= BASE_URL ?>assets/images/pet_details_1.png" class="rounded-image" height="50px" width="50px" alt="">
                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                    <div class="action-btns d-flex flex-column justify-content-center gap-20">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48" fill="none">
                                            <rect width="48" height="48" rx="24" fill="#C9DDA0" />
                                            <path d="M33.4955 23.7425C33.8911 24.1343 33.8906 24.7738 33.4942 25.1649L28.4257 30.1665C28.0359 30.5512 27.4078 30.5461 27.0242 30.1552C26.8723 30.0053 26.8115 29.8554 26.8419 29.7055C26.8799 29.5555 26.9634 29.4131 27.0926 29.2782L30.3629 26.0735C30.5452 25.8936 30.7161 25.7324 30.8756 25.59C31.0019 25.4772 30.9047 25.2517 30.7362 25.2687C30.5411 25.2885 30.3407 25.3056 30.135 25.3201C29.7172 25.3501 29.2842 25.3651 28.836 25.3651H14.9164C14.4103 25.3651 14 24.9548 14 24.4487C14 23.9426 14.4103 23.5323 14.9164 23.5323H28.836C29.2842 23.5323 29.721 23.5473 30.1464 23.5772C30.3491 23.5915 30.5466 23.6084 30.7389 23.6278C30.9098 23.645 31.0063 23.4188 30.8756 23.3074C30.7161 23.1649 30.5452 23.0038 30.3629 22.8239L27.0698 19.5967C26.933 19.4618 26.8495 19.3193 26.8191 19.1694C26.7887 19.0195 26.8457 18.8696 26.99 18.7196C27.3781 18.3243 28.0165 18.3169 28.4101 18.7067L33.4955 23.7425Z" fill="white" />
                                        </svg>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48" fill="none">
                                            <rect width="48" height="48" rx="24" fill="#C9DDA0" />
                                            <path d="M24.5273 14.75C30.0131 14.75 34.3056 18.6821 34.3057 23.3516C34.3057 28.021 30.0131 31.9531 24.5273 31.9531H24.5264C23.5507 31.9553 22.5785 31.8265 21.6357 31.5703L21.3555 31.4941L21.0967 31.627C20.5511 31.9071 19.4053 32.414 17.5605 32.853L16.7275 33.035C16.6613 33.048 16.5947 33.060 16.5283 33.073C16.555 32.999 16.5839 32.925 16.6094 32.85L16.6143 32.835L16.6182 32.821L16.6172 32.82C16.9556 31.8196 17.2354 30.6619 17.3389 29.5674L17.3721 29.2197L17.127 28.9717C15.6361 27.4545 14.75 25.4871 14.75 23.3516C14.75 18.6822 19.0418 14.7502 24.5273 14.75Z" stroke="white" stroke-width="1.5" />
                                        </svg>
                                    </div>
                                </div>


                            </div>

                            <div class="bookings-cards bg-border-green-header mt-5">
                                <div class="cards-header bg-green-header">
                                    <div class="header-left d-flex align-items-center gap-15">
                                        <span class="status-badge light-color-font bg-status-green-header">Confirmed</span>
                                        <span class="studio-name medium-font-bold">Furs & Co. Studio - <span class="medium-light-font">Hosted by</span> <span class="host medium-muted-font">Dev É.</span></span>
                                    </div>
                                    <div class="booking-ref simple-font">Booking reference: FG-10294</div>
                                </div>

                                <div class="card-body d-flex justify-content-between">
                                    <div class="profile-section d-flex align-items-center gap-25">
                                        <div class="avatar-wrap">
                                            <img class="avatar" src="http://localhost:8000/assets/images/space_card3.png" alt="Sarah's avatar">
                                            <div class="badge-shield" title="Verified">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="29" height="30" viewBox="0 0 29 30" fill="none">
                                                    <path d="M14.9293 0.170856C14.6819 0.058916 14.4168 0 14.1399 0C13.8629 0 13.5978 0.058916 13.3504 0.170856L2.25651 4.87824C0.960357 5.42616 -0.0058648 6.70463 2.67979e-05 8.24823C0.0294848 14.0927 2.43326 24.7859 12.5845 29.6465C13.5684 30.1178 14.7113 30.1178 15.6952 29.6465C25.8465 24.7859 28.2502 14.0927 28.2797 8.24823C28.2856 6.70463 27.3194 5.42616 26.0232 4.87824L14.9293 0.170856Z" fill="#CBDCE8" />
                                                    <path d="M21.818 8.18213L15.7574 14.6215L21.818 8.18213ZM13.065 14.3071C11.1862 15.0283 9.68391 14.9049 8.18164 14.3094C8.56043 19.1905 10.8362 21.067 13.8703 21.8185C13.8703 21.8185 16.1559 20.2018 16.4854 16.3693C16.521 15.9541 16.5385 15.7473 16.4529 15.5132C16.3665 15.2791 16.1968 15.1117 15.8582 14.7761C15.3006 14.2246 15.0226 13.9488 14.6915 13.8791C14.3604 13.8109 13.9286 13.9761 13.065 14.3071Z" fill="#CBDCE8" />
                                                    <path d="M21.818 8.18213L15.7574 14.6215M13.065 14.3071C11.1862 15.0283 9.68391 14.9049 8.18164 14.3094C8.56043 19.1905 10.8362 21.067 13.8703 21.8185C13.8703 21.8185 16.1559 20.2018 16.4854 16.3693C16.521 15.9541 16.5385 15.7473 16.4529 15.5132C16.3665 15.2791 16.1968 15.1117 15.8582 14.7761C15.3006 14.2246 15.0225 13.9488 14.6915 13.8791C14.3604 13.8109 13.9286 13.9761 13.065 14.3071Z" stroke="white" stroke-linecap="round" stroke-linejoin="round" />
                                                    <path d="M9.31836 18.3679C9.31836 18.3679 11.2123 18.7346 13.1062 17.2725L9.31836 18.3679Z" fill="#CBDCE8" />
                                                    <path d="M9.31836 18.3679C9.31836 18.3679 11.2123 18.7346 13.1062 17.2725" stroke="white" stroke-linecap="round" stroke-linejoin="round" />
                                                    <path d="M12.3485 11.4016C12.3485 11.6527 12.2488 11.8936 12.0712 12.0712C11.8936 12.2488 11.6527 12.3485 11.4016 12.3485C11.1504 12.3485 10.9095 12.2488 10.732 12.0712C10.5544 11.8936 10.4546 11.6527 10.4546 11.4016C10.4546 11.1504 10.5544 10.9095 10.732 10.732C10.9095 10.5544 11.1504 10.4546 11.4016 10.4546C11.6527 10.4546 11.8936 10.5544 12.0712 10.732C12.2488 10.9095 12.3485 11.1504 12.3485 11.4016Z" fill="#CBDCE8" stroke="white" />
                                                    <path d="M14.2432 8.93896V9.01472V8.93896Z" fill="#CBDCE8" />
                                                    <path d="M14.2432 8.93896V9.01472" stroke="white" stroke-linecap="round" stroke-linejoin="round" />
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="listing-section d-flex flex-column align-items-start gap-15">
                                            <div class="service-type" style="background:#FFA899">Garden / Shed</div>

                                            <div class="listing d-flex align-items-center gap-25">
                                                <div class="details-item d-flex flex-column gap-10">
                                                    <div class="d-flex gap-10">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="19" height="17" viewBox="0 0 19 17" fill="none">
                                                            <path d="M0.5 8.29554C0.5 5.20139 0.5 3.6539 1.50457 2.69308C2.50914 1.73227 4.12486 1.73145 7.35714 1.73145H10.7857C14.018 1.73145 15.6346 1.73145 16.6383 2.69308C17.642 3.65472 17.6429 5.20139 17.6429 8.29554V9.93656C17.6429 13.0307 17.6429 14.5782 16.6383 15.539C15.6337 16.4998 14.018 16.5007 10.7857 16.5007H7.35714C4.12486 16.5007 2.50829 16.5007 1.50457 15.539C0.500857 14.5774 0.5 13.0307 0.5 9.93656V8.29554Z" stroke="#3B3731" />
                                                            <path d="M4.78585 1.73077V0.5M13.3573 1.73077V0.5M0.928711 5.83333H17.2144" stroke="#3B3731" stroke-linecap="round" />
                                                            <path d="M14.2139 12.3975C14.2139 12.6151 14.1236 12.8238 13.9629 12.9777C13.8021 13.1315 13.5841 13.218 13.3568 13.218C13.1295 13.218 12.9114 13.1315 12.7507 12.9777C12.59 12.8238 12.4997 12.6151 12.4997 12.3975C12.4997 12.1799 12.59 11.9712 12.7507 11.8173C12.9114 11.6634 13.1295 11.577 13.3568 11.577C13.5841 11.577 13.8021 11.6634 13.9629 11.8173C14.1236 11.9712 14.2139 12.1799 14.2139 12.3975ZM14.2139 9.11543C14.2139 9.33305 14.1236 9.54175 13.9629 9.69562C13.8021 9.8495 13.5841 9.93595 13.3568 9.93595C13.1295 9.93595 12.9114 9.8495 12.7507 9.69562C12.59 9.54175 12.4997 9.33305 12.4997 9.11543C12.4997 8.89782 12.59 8.68912 12.7507 8.53524C12.9114 8.38137 13.1295 8.29492 13.3568 8.29492C13.5841 8.29492 13.8021 8.38137 13.9629 8.53524C14.1236 8.68912 14.2139 8.89782 14.2139 9.11543ZM9.92822 12.3975C9.92822 12.6151 9.83792 12.8238 9.67717 12.9777C9.51643 13.1315 9.29841 13.218 9.07108 13.218C8.84375 13.218 8.62573 13.1315 8.46499 12.9777C8.30424 12.8238 8.21394 12.6151 8.21394 12.3975C8.21394 12.1799 8.30424 11.9712 8.46499 11.8173C8.62573 11.6634 8.84375 11.577 9.07108 11.577C9.29841 11.577 9.51643 11.6634 9.67717 11.8173C9.83792 11.9712 9.92822 12.1799 9.92822 12.3975ZM9.92822 9.11543C9.92822 9.33305 9.83792 9.54175 9.67717 9.69562C9.51643 9.8495 9.29841 9.93595 9.07108 9.93595C8.84375 9.93595 8.62573 9.8495 8.46499 9.69562C8.30424 9.54175 8.21394 9.33305 8.21394 9.11543C8.21394 8.89782 8.30424 8.68912 8.46499 8.53524C8.62573 8.38137 8.84375 8.29492 9.07108 8.29492C9.29841 8.29492 9.51643 8.38137 9.67717 8.53524C9.83792 8.68912 9.92822 8.89782 9.92822 9.11543ZM5.64251 12.3975C5.64251 12.6151 5.5522 12.8238 5.39146 12.9777C5.23071 13.1315 5.01269 13.218 4.78537 13.218C4.55804 13.218 4.34002 13.1315 4.17927 12.9777C4.01853 12.8238 3.92822 12.6151 3.92822 12.3975C3.92822 12.1799 4.01853 11.9712 4.17927 11.8173C4.34002 11.6634 4.55804 11.577 4.78537 11.577C5.01269 11.577 5.23071 11.6634 5.39146 11.8173C5.5522 11.9712 5.64251 12.1799 5.64251 12.3975ZM5.64251 9.11543C5.64251 9.33305 5.5522 9.54175 5.39146 9.69562C5.23071 9.8495 5.01269 9.93595 4.78537 9.93595C4.55804 9.93595 4.34002 9.8495 4.17927 9.69562C4.01853 9.54175 3.92822 9.33305 3.92822 9.11543C3.92822 8.89782 4.01853 8.68912 4.17927 8.53524C4.34002 8.38137 4.55804 8.29492 4.78537 8.29492C5.01269 8.29492 5.23071 8.38137 5.39146 8.53524C5.5522 8.68912 5.64251 8.89782 5.64251 9.11543Z" fill="#3B3731" />
                                                        </svg>
                                                        <p class="item-label">Date</p>
                                                    </div>
                                                    <p class="value">18/12/2025</p>
                                                </div>
                                                <hr class="vertical-line">

                                                <div class="details-item d-flex flex-column gap-10">
                                                    <div class="d-flex gap-10">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                            viewBox="0 0 16 16" fill="none">
                                                            <path
                                                                d="M8 0.5C12.1423 0.5 15.5 3.85774 15.5 8C15.5 12.1423 12.1423 15.5 8 15.5C3.85774 15.5 0.5 12.1423 0.5 8C0.5 3.85774 3.85774 0.5 8 0.5Z"
                                                                stroke="#3B3731" stroke-linecap="round" />
                                                        </svg>
                                                        <p class="item-label">Time</p>
                                                    </div>
                                                    <p class="value">14:30 - 15:30</p>
                                                </div>
                                                <hr class="vertical-line">
                                                <div class="details-item d-flex flex-column gap-10">
                                                    <div class="d-flex gap-10">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="16"
                                                            viewBox="0 0 12 16" fill="none">
                                                            <path
                                                                d="M6 0.5C7.4694 0.5 8.87214 1.04525 9.90137 2.00586C10.9293 2.96529 11.4999 4.25871 11.5 5.59961C11.5 7.10011 10.6408 8.95946 9.51855 10.7236C8.41048 12.4655 7.10434 14.0263 6.32227 14.9082C6.14625 15.1067 5.85375 15.1067 5.67773 14.9082C4.89566 14.0263 3.58952 12.4655 2.48145 10.7236C1.35919 8.95946 0.5 7.10011 0.5 5.59961C0.500111 4.25871 1.07068 2.96529 2.09863 2.00586C3.12786 1.04525 4.53061 0.5 6 0.5ZM6 3.09961C5.30978 3.09961 4.64141 3.35564 4.14355 3.82031C3.64466 4.28597 3.35753 4.92517 3.35742 5.59961C3.35742 6.27422 3.64453 6.91413 4.14355 7.37988C4.64141 7.84453 5.30979 8.09961 6 8.09961C6.34236 8.09961 6.68202 8.03695 7 7.91406C7.31807 7.7911 7.60965 7.61022 7.85645 7.37988C8.10326 7.14952 8.30086 6.87397 8.43652 6.56836C8.57224 6.26256 8.64258 5.93289 8.64258 5.59961C8.64247 4.92517 8.35534 4.28597 7.85645 3.82031C7.35859 3.35564 6.69022 3.09961 6 3.09961Z"
                                                                stroke="#3B3731" />
                                                        </svg>
                                                        <p class="item-label">Location</p>
                                                    </div>
                                                    <p class="value">Victoria Embankment</p>
                                                </div>
                                                <hr class="vertical-line">
                                                <div class="details-item images-div">
                                                    <img src="<?= BASE_URL ?>assets/images/pet_details_1.png" class="rounded-image first-image" height="50px" width="50px" alt="">
                                                    <img src="<?= BASE_URL ?>assets/images/pet_details_2.png" class="rounded-image second-image" height="50px" width="50px" alt="">
                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                    <div class="action-btns d-flex flex-column justify-content-center gap-20">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48" fill="none">
                                            <rect width="48" height="48" rx="24" fill="#C9DDA0" />
                                            <path d="M33.4955 23.7425C33.8911 24.1343 33.8906 24.7738 33.4942 25.1649L28.4257 30.1665C28.0359 30.5512 27.4078 30.5461 27.0242 30.1552C26.8723 30.0053 26.8115 29.8554 26.8419 29.7055C26.8799 29.5555 26.9634 29.4131 27.0926 29.2782L30.3629 26.0735C30.5452 25.8936 30.7161 25.7324 30.8756 25.59C31.0019 25.4772 30.9047 25.2517 30.7362 25.2687C30.5411 25.2885 30.3407 25.3056 30.135 25.3201C29.7172 25.3501 29.2842 25.3651 28.836 25.3651H14.9164C14.4103 25.3651 14 24.9548 14 24.4487C14 23.9426 14.4103 23.5323 14.9164 23.5323H28.836C29.2842 23.5323 29.721 23.5473 30.1464 23.5772C30.3491 23.5915 30.5466 23.6084 30.7389 23.6278C30.9098 23.645 31.0063 23.4188 30.8756 23.3074C30.7161 23.1649 30.5452 23.0038 30.3629 22.8239L27.0698 19.5967C26.933 19.4618 26.8495 19.3193 26.8191 19.1694C26.7887 19.0195 26.8457 18.8696 26.99 18.7196C27.3781 18.3243 28.0165 18.3169 28.4101 18.7067L33.4955 23.7425Z" fill="white" />
                                        </svg>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48" fill="none">
                                            <rect width="48" height="48" rx="24" fill="#C9DDA0" />
                                            <path d="M24.5273 14.75C30.0131 14.75 34.3056 18.6821 34.3057 23.3516C34.3057 28.021 30.0131 31.9531 24.5273 31.9531H24.5264C23.5507 31.9553 22.5785 31.8265 21.6357 31.5703L21.3555 31.4941L21.0967 31.627C20.5511 31.9071 19.4053 32.414 17.5605 32.853L16.7275 33.035C16.6613 33.048 16.5947 33.060 16.5283 33.073C16.555 32.999 16.5839 32.925 16.6094 32.85L16.6143 32.835L16.6182 32.821L16.6172 32.82C16.9556 31.8196 17.2354 30.6619 17.3389 29.5674L17.3721 29.2197L17.127 28.9717C15.6361 27.4545 14.75 25.4871 14.75 23.3516C14.75 18.6822 19.0418 14.7502 24.5273 14.75Z" stroke="white" stroke-width="1.5" />
                                        </svg>
                                    </div>
                                </div>


                            </div>

                            <h2 class="medium-font mt-5">Past & Cancelled Bookings</h2>

                            <hr class="mt-4" style="border-top: 1px solid #D4D4D4;">

                            <div class="bookings-cards bg-border-gray-header mt-5">
                                <div class="cards-header bg-gray-header">
                                    <div class="header-left d-flex align-items-center gap-15">
                                        <span class="status-badge light-color-font bg-status-gray-header">Completed</span>
                                        <span class="studio-name medium-font-bold">Sarah’s Grooming Studio - <span class="host medium-muted-font">Sarah W.</span></span>
                                    </div>
                                    <div class="booking-ref simple-font">Booking reference: FG-10294</div>
                                </div>

                                <div class="card-body d-flex justify-content-between">
                                    <div class="profile-section d-flex align-items-center gap-25">
                                        <div class="avatar-wrap">
                                            <img class="avatar" src="http://localhost:8000/assets/images/groomer-profile.png" alt="Sarah's avatar">
                                            <div class="badge-shield" title="Verified">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="33" viewBox="0 0 30 33" fill="none">
                                                    <ellipse cx="15.873" cy="16.5256" rx="9.3645" ry="8.81365" fill="white"></ellipse>
                                                    <path d="M15.44 0.185076C15.1841 0.0638192 14.9099 0 14.6235 0C14.3372 0 14.063 0.0638192 13.8071 0.185076L2.3337 5.28423C0.993208 5.87775 -0.00606541 7.26263 2.77146e-05 8.93469C0.0304934 15.2656 2.51649 26.8487 13.015 32.1138C14.0325 32.6244 15.2146 32.6244 16.2321 32.1138C26.7306 26.8487 29.2166 15.2656 29.247 8.93469C29.2531 7.26263 28.2539 5.87775 26.9134 5.28423L15.44 0.185076ZM8.82897 18.2651C9.12144 18.3416 9.43219 18.3799 9.74903 18.3799C11.8999 18.3799 13.6486 16.5483 13.6486 14.2955V10.2111H16.3418C17.0791 10.2111 17.7554 10.645 18.0844 11.3407L18.5231 12.2533H22.4227C22.9589 12.2533 23.3976 12.7128 23.3976 13.2744V15.3166C23.3976 18.1374 21.2163 20.4222 18.5231 20.4222H15.5984V23.6578C15.5984 24.1237 15.2389 24.5066 14.7881 24.5066C14.6784 24.5066 14.5687 24.4811 14.4712 24.4364L8.45729 21.7368C8.05514 21.5581 7.79923 21.1433 7.79923 20.6902C7.79923 20.5115 7.83579 20.3392 7.915 20.1796L8.82897 18.2651ZM8.77413 10.2111H11.6988V14.2955C11.6988 15.4251 10.8275 16.3377 9.74903 16.3377C8.67055 16.3377 7.79923 15.4251 7.79923 14.2955V11.2322C7.79923 10.6706 8.23794 10.2111 8.77413 10.2111ZM16.5733 13.2744C16.5733 13.0036 16.4706 12.7439 16.2878 12.5524C16.105 12.3609 15.857 12.2533 15.5984 12.2533C15.3399 12.2533 15.0919 12.3609 14.9091 12.5524C14.7262 12.7439 14.6235 13.0036 14.6235 13.2744C14.6235 13.5452 14.7262 13.8049 14.9091 13.9964C15.0919 14.1879 15.3399 14.2955 15.5984 14.2955C15.857 14.2955 16.105 14.1879 16.2878 13.9964C16.4706 13.8049 16.5733 13.5452 16.5733 13.2744Z" fill="#C9DDA0"></path>
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="listing-section d-flex flex-column align-items-start gap-15">
                                            <div class="service-type">Home Visits</div>

                                            <div class="listing d-flex align-items-center gap-25">
                                                <div class="details-item d-flex flex-column gap-10">
                                                    <div class="d-flex gap-10">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="17"
                                                            viewBox="0 0 16 17" fill="none">
                                                            <path
                                                                d="M4.94591 11.5544C6.23114 12.8397 9.35699 11.798 11.9274 9.22713C14.4983 6.65667 15.54 3.53082 14.2548 2.24559M8.72754 1.37259L9.30927 1.95473M6.6915 3.40904L7.27322 3.99077M4.9455 5.73636L5.52722 6.31809M4.36377 8.6454L4.9455 9.22713M11.9274 0.5L12.5092 1.08173M11.3457 3.99118L12.5092 5.15463M9.30968 6.02763L10.4731 7.19109M6.98236 7.77281L8.14581 8.93627"
                                                                stroke="#3B3731" stroke-linecap="round" stroke-linejoin="round" />
                                                            <path
                                                                d="M4.94547 13.2998C5.42747 12.8178 5.42747 12.0364 4.94548 11.5544C4.46348 11.0724 3.68202 11.0724 3.20003 11.5544L0.872775 13.8816C0.390784 14.3636 0.390784 15.1451 0.872775 15.6271C1.35477 16.1091 2.13623 16.1091 2.61822 15.6271L4.94547 13.2998Z"
                                                                stroke="#3B3731" stroke-linecap="round" stroke-linejoin="round" />
                                                        </svg>
                                                        <p class="item-label">Service</p>
                                                    </div>
                                                    <p class="value">Full Groom</p>
                                                </div>
                                                <hr class="vertical-line">
                                                <div class="details-item d-flex flex-column gap-10">
                                                    <div class="d-flex gap-10">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="19" height="17"
                                                            viewBox="0 0 19 17" fill="none">
                                                            <path
                                                                d="M0.5 8.29554C0.5 5.20139 0.5 3.6539 1.50457 2.69308C2.50914 1.73227 4.12486 1.73145 7.35714 1.73145H10.7857C14.018 1.73145 15.6346 1.73145 16.6383 2.69308C17.642 3.65472 17.6429 5.20139 17.6429 8.29554V9.93656C17.6429 13.0307 17.6429 14.5782 16.6383 15.539C15.6337 16.4998 14.018 16.5007 10.7857 16.5007H7.35714C4.12486 16.5007 2.50829 16.5007 1.50457 15.539C0.500857 14.5774 0.5 13.0307 0.5 9.93656V8.29554Z"
                                                                stroke="#3B3731" />
                                                            <path d="M4.78585 1.73077V0.5M13.3573 1.73077V0.5M0.928711 5.83333H17.2144"
                                                                stroke="#3B3731" stroke-linecap="round" />
                                                            <path
                                                                d="M14.2139 12.3975C14.2139 12.6151 14.1236 12.8238 13.9629 12.9777C13.8021 13.1315 13.5841 13.218 13.3568 13.218C13.1295 13.218 12.9114 13.1315 12.7507 12.9777C12.59 12.8238 12.4997 12.6151 12.4997 12.3975C12.4997 12.1799 12.59 11.9712 12.7507 11.8173C12.9114 11.6634 13.1295 11.577 13.3568 11.577C13.5841 11.577 13.8021 11.6634 13.9629 11.8173C14.1236 11.9712 14.2139 12.1799 14.2139 12.3975ZM14.2139 9.11543C14.2139 9.33305 14.1236 9.54175 13.9629 9.69562C13.8021 9.8495 13.5841 9.93595 13.3568 9.93595C13.1295 9.93595 12.9114 9.8495 12.7507 9.69562C12.59 9.54175 12.4997 9.33305 12.4997 9.11543C12.4997 8.89782 12.59 8.68912 12.7507 8.53524C12.9114 8.38137 13.1295 8.29492 13.3568 8.29492C13.5841 8.29492 13.8021 8.38137 13.9629 8.53524C14.1236 8.68912 14.2139 8.89782 14.2139 9.11543ZM9.92822 12.3975C9.92822 12.6151 9.83792 12.8238 9.67717 12.9777C9.51643 13.1315 9.29841 13.218 9.07108 13.218C8.84375 13.218 8.62573 13.1315 8.46499 12.9777C8.30424 12.8238 8.21394 12.6151 8.21394 12.3975C8.21394 12.1799 8.30424 11.9712 8.46499 11.8173C8.62573 11.6634 8.84375 11.577 9.07108 11.577C9.29841 11.577 9.51643 11.6634 9.67717 11.8173C9.83792 11.9712 9.92822 12.1799 9.92822 12.3975ZM9.92822 9.11543C9.92822 9.33305 9.83792 9.54175 9.67717 9.69562C9.51643 9.8495 9.29841 9.93595 9.07108 9.93595C8.84375 9.93595 8.62573 9.8495 8.46499 9.69562C8.30424 9.54175 8.21394 9.33305 8.21394 9.11543C8.21394 8.89782 8.30424 8.68912 8.46499 8.53524C8.62573 8.38137 8.84375 8.29492 9.07108 8.29492C9.29841 8.29492 9.51643 8.38137 9.67717 8.53524C9.83792 8.68912 9.92822 8.89782 9.92822 9.11543ZM5.64251 12.3975C5.64251 12.6151 5.5522 12.8238 5.39146 12.9777C5.23071 13.1315 5.01269 13.218 4.78537 13.218C4.55804 13.218 4.34002 13.1315 4.17927 12.9777C4.01853 12.8238 3.92822 12.6151 3.92822 12.3975C3.92822 12.1799 4.01853 11.9712 4.17927 11.8173C4.34002 11.6634 4.55804 11.577 4.78537 11.577C5.01269 11.577 5.23071 11.6634 5.39146 11.8173C5.5522 11.9712 5.64251 12.1799 5.64251 12.3975ZM5.64251 9.11543C5.64251 9.33305 5.5522 9.54175 5.39146 9.69562C5.23071 9.8495 5.01269 9.93595 4.78537 9.93595C4.55804 9.93595 4.34002 9.8495 4.17927 9.69562C4.01853 9.54175 3.92822 9.33305 3.92822 9.11543C3.92822 8.89782 4.01853 8.68912 4.17927 8.53524C4.34002 8.38137 4.55804 8.29492 4.78537 8.29492C5.01269 8.29492 5.23071 8.38137 5.39146 8.53524C5.5522 8.68912 5.64251 8.89782 5.64251 9.11543Z"
                                                                fill="#3B3731" />
                                                        </svg>
                                                        <p class="item-label">Date</p>
                                                    </div>
                                                    <p class="value">18/12/2025</p>
                                                </div>
                                                <hr class="vertical-line">
                                                <div class="details-item d-flex flex-column gap-10">
                                                    <div class="d-flex gap-10">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                            viewBox="0 0 16 16" fill="none">
                                                            <path
                                                                d="M8 0.5C12.1423 0.5 15.5 3.85774 15.5 8C15.5 12.1423 12.1423 15.5 8 15.5C3.85774 15.5 0.5 12.1423 0.5 8C0.5 3.85774 3.85774 0.5 8 0.5Z"
                                                                stroke="#3B3731" stroke-linecap="round" />
                                                        </svg>
                                                        <p class="item-label">Time</p>
                                                    </div>
                                                    <p class="value">14:30 - 15:30</p>
                                                </div>
                                                <hr class="vertical-line">
                                                <div class="details-item d-flex flex-column gap-10">
                                                    <div class="d-flex gap-10">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="16"
                                                            viewBox="0 0 12 16" fill="none">
                                                            <path
                                                                d="M6 0.5C7.4694 0.5 8.87214 1.04525 9.90137 2.00586C10.9293 2.96529 11.4999 4.25871 11.5 5.59961C11.5 7.10011 10.6408 8.95946 9.51855 10.7236C8.41048 12.4655 7.10434 14.0263 6.32227 14.9082C6.14625 15.1067 5.85375 15.1067 5.67773 14.9082C4.89566 14.0263 3.58952 12.4655 2.48145 10.7236C1.35919 8.95946 0.5 7.10011 0.5 5.59961C0.500111 4.25871 1.07068 2.96529 2.09863 2.00586C3.12786 1.04525 4.53061 0.5 6 0.5ZM6 3.09961C5.30978 3.09961 4.64141 3.35564 4.14355 3.82031C3.64466 4.28597 3.35753 4.92517 3.35742 5.59961C3.35742 6.27422 3.64453 6.91413 4.14355 7.37988C4.64141 7.84453 5.30979 8.09961 6 8.09961C6.34236 8.09961 6.68202 8.03695 7 7.91406C7.31807 7.7911 7.60965 7.61022 7.85645 7.37988C8.10326 7.14952 8.30086 6.87397 8.43652 6.56836C8.57224 6.26256 8.64258 5.93289 8.64258 5.59961C8.64247 4.92517 8.35534 4.28597 7.85645 3.82031C7.35859 3.35564 6.69022 3.09961 6 3.09961Z"
                                                                stroke="#3B3731" />
                                                        </svg>
                                                        <p class="item-label">Location</p>
                                                    </div>
                                                    <p class="value">At your home</p>
                                                </div>
                                                <hr class="vertical-line">
                                                <div class="details-item">
                                                    <img src="<?= BASE_URL ?>assets/images/pet_details_1.png" class="rounded-image" height="50px" width="50px" alt="">
                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                    <div class="action-btns d-flex flex-column justify-content-center gap-20">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48" fill="none">
                                            <rect width="48" height="48" rx="24" fill="#D4D4D4" />
                                            <path d="M33.4955 23.7425C33.8911 24.1343 33.8906 24.7738 33.4942 25.1649L28.4257 30.1665C28.0359 30.5512 27.4078 30.5461 27.0242 30.1552C26.8723 30.0053 26.8115 29.8554 26.8419 29.7055C26.8799 29.5555 26.9634 29.4131 27.0926 29.2782L30.3629 26.0735C30.5452 25.8936 30.7161 25.7324 30.8756 25.59C31.0019 25.4772 30.9047 25.2517 30.7362 25.2687C30.5411 25.2885 30.3407 25.3056 30.135 25.3201C29.7172 25.3501 29.2842 25.3651 28.836 25.3651H14.9164C14.4103 25.3651 14 24.9548 14 24.4487C14 23.9426 14.4103 23.5323 14.9164 23.5323H28.836C29.2842 23.5323 29.721 23.5473 30.1464 23.5772C30.3491 23.5915 30.5466 23.6084 30.7389 23.6278C30.9098 23.645 31.0063 23.4188 30.8756 23.3074C30.7161 23.1649 30.5452 23.0038 30.3629 22.8239L27.0698 19.5967C26.933 19.4618 26.8495 19.3193 26.8191 19.1694C26.7887 19.0195 26.8457 18.8696 26.99 18.7196C27.3781 18.3243 28.0165 18.3169 28.4101 18.7067L33.4955 23.7425Z" fill="white" />
                                        </svg>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48" fill="none">
                                            <rect width="48" height="48" rx="24" fill="#D4D4D4" />
                                            <path d="M16.3081 33.994V30.1499H20.1519" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M33.8208 22.1634C34.2286 24.3394 33.9025 26.5892 32.8935 28.5598C31.8846 30.5304 30.25 32.11 28.2462 33.052C26.2423 33.993 23.9827 34.242 21.8219 33.761C19.661 33.279 17.7212 32.093 16.3068 30.3903M14.1711 25.8366C13.7632 23.6606 14.0894 21.4108 15.0983 19.4402C16.1072 17.4696 17.7419 15.8897 19.7457 14.9484C21.7495 14.0071 24.0091 13.7578 26.17 14.2394C28.3309 14.7211 30.2707 15.9065 31.685 17.6097" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M31.6834 14.0063V17.8501H27.8396M19.4856 24.5178C18.9416 24.4233 18.9416 23.6421 19.4856 23.5476C20.4486 23.3791 21.3396 22.9282 22.0456 22.252C22.7516 21.5759 23.2405 20.7051 23.4503 19.7503L23.4829 19.6C23.6007 19.0621 24.3663 19.059 24.4887 19.5953L24.529 19.7704C24.7455 20.7215 25.2385 21.5873 25.9459 22.2588C26.6533 22.9304 27.5435 23.3777 28.5046 23.5445C29.0517 23.639 29.0517 24.4248 28.5046 24.5209C27.5437 24.6876 26.6536 25.1347 25.9463 25.8059C25.2389 26.4772 24.7458 27.3426 24.529 28.2934L24.4887 28.467C24.3663 29.0032 23.6007 29.0001 23.4829 28.4623L23.4519 28.3135C23.2419 27.3584 22.7525 26.4872 22.0459 25.811C21.3393 25.1348 20.4476 24.6841 19.4841 24.5163" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </div>
                                </div>


                            </div>

                            <div class="bookings-cards bg-border-pink-header mt-5">
                                <div class="cards-header bg-pink-header">
                                    <div class="header-left d-flex align-items-center gap-15">
                                        <span class="status-badge light-color-font bg-status-pink-header">Cancelled</span>
                                        <span class="studio-name medium-font-bold">Furs & Co. Studio - <span class="medium-light-font">Hosted by</span> <span class="host medium-muted-font">Dev É.</span></span>
                                    </div>
                                    <div class="booking-ref simple-font">Booking reference: FG-10294</div>
                                </div>

                                <div class="card-body d-flex justify-content-between">
                                    <div class="profile-section d-flex align-items-center gap-25">
                                        <div class="avatar-wrap">
                                            <img class="avatar" src="http://localhost:8000/assets/images/space_card3.png" alt="Sarah's avatar">
                                            <div class="badge-shield" title="Verified">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="29" height="30" viewBox="0 0 29 30" fill="none">
                                                    <path d="M14.9293 0.170856C14.6819 0.058916 14.4168 0 14.1399 0C13.8629 0 13.5978 0.058916 13.3504 0.170856L2.25651 4.87824C0.960357 5.42616 -0.0058648 6.70463 2.67979e-05 8.24823C0.0294848 14.0927 2.43326 24.7859 12.5845 29.6465C13.5684 30.1178 14.7113 30.1178 15.6952 29.6465C25.8465 24.7859 28.2502 14.0927 28.2797 8.24823C28.2856 6.70463 27.3194 5.42616 26.0232 4.87824L14.9293 0.170856Z" fill="#CBDCE8" />
                                                    <path d="M21.818 8.18213L15.7574 14.6215L21.818 8.18213ZM13.065 14.3071C11.1862 15.0283 9.68391 14.9049 8.18164 14.3094C8.56043 19.1905 10.8362 21.067 13.8703 21.8185C13.8703 21.8185 16.1559 20.2018 16.4854 16.3693C16.521 15.9541 16.5385 15.7473 16.4529 15.5132C16.3665 15.2791 16.1968 15.1117 15.8582 14.7761C15.3006 14.2246 15.0226 13.9488 14.6915 13.8791C14.3604 13.8109 13.9286 13.9761 13.065 14.3071Z" fill="#CBDCE8" />
                                                    <path d="M21.818 8.18213L15.7574 14.6215M13.065 14.3071C11.1862 15.0283 9.68391 14.9049 8.18164 14.3094C8.56043 19.1905 10.8362 21.067 13.8703 21.8185C13.8703 21.8185 16.1559 20.2018 16.4854 16.3693C16.521 15.9541 16.5385 15.7473 16.4529 15.5132C16.3665 15.2791 16.1968 15.1117 15.8582 14.7761C15.3006 14.2246 15.0225 13.9488 14.6915 13.8791C14.3604 13.8109 13.9286 13.9761 13.065 14.3071Z" stroke="white" stroke-linecap="round" stroke-linejoin="round" />
                                                    <path d="M9.31836 18.3679C9.31836 18.3679 11.2123 18.7346 13.1062 17.2725L9.31836 18.3679Z" fill="#CBDCE8" />
                                                    <path d="M9.31836 18.3679C9.31836 18.3679 11.2123 18.7346 13.1062 17.2725" stroke="white" stroke-linecap="round" stroke-linejoin="round" />
                                                    <path d="M12.3485 11.4016C12.3485 11.6527 12.2488 11.8936 12.0712 12.0712C11.8936 12.2488 11.6527 12.3485 11.4016 12.3485C11.1504 12.3485 10.9095 12.2488 10.732 12.0712C10.5544 11.8936 10.4546 11.6527 10.4546 11.4016C10.4546 11.1504 10.5544 10.9095 10.732 10.732C10.9095 10.5544 11.1504 10.4546 11.4016 10.4546C11.6527 10.4546 11.8936 10.5544 12.0712 10.732C12.2488 10.9095 12.3485 11.1504 12.3485 11.4016Z" fill="#CBDCE8" stroke="white" />
                                                    <path d="M14.2432 8.93896V9.01472V8.93896Z" fill="#CBDCE8" />
                                                    <path d="M14.2432 8.93896V9.01472" stroke="white" stroke-linecap="round" stroke-linejoin="round" />
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="listing-section d-flex flex-column align-items-start gap-15">
                                            <div class="service-type" style="background:#FFA899">Garden / Shed</div>

                                            <div class="listing d-flex align-items-center gap-25">
                                                <div class="details-item d-flex flex-column gap-10">
                                                    <div class="d-flex gap-10">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="19" height="17" viewBox="0 0 19 17" fill="none">
                                                            <path d="M0.5 8.29554C0.5 5.20139 0.5 3.6539 1.50457 2.69308C2.50914 1.73227 4.12486 1.73145 7.35714 1.73145H10.7857C14.018 1.73145 15.6346 1.73145 16.6383 2.69308C17.642 3.65472 17.6429 5.20139 17.6429 8.29554V9.93656C17.6429 13.0307 17.6429 14.5782 16.6383 15.539C15.6337 16.4998 14.018 16.5007 10.7857 16.5007H7.35714C4.12486 16.5007 2.50829 16.5007 1.50457 15.539C0.500857 14.5774 0.5 13.0307 0.5 9.93656V8.29554Z" stroke="#3B3731" />
                                                            <path d="M4.78585 1.73077V0.5M13.3573 1.73077V0.5M0.928711 5.83333H17.2144" stroke="#3B3731" stroke-linecap="round" />
                                                            <path d="M14.2139 12.3975C14.2139 12.6151 14.1236 12.8238 13.9629 12.9777C13.8021 13.1315 13.5841 13.218 13.3568 13.218C13.1295 13.218 12.9114 13.1315 12.7507 12.9777C12.59 12.8238 12.4997 12.6151 12.4997 12.3975C12.4997 12.1799 12.59 11.9712 12.7507 11.8173C12.9114 11.6634 13.1295 11.577 13.3568 11.577C13.5841 11.577 13.8021 11.6634 13.9629 11.8173C14.1236 11.9712 14.2139 12.1799 14.2139 12.3975ZM14.2139 9.11543C14.2139 9.33305 14.1236 9.54175 13.9629 9.69562C13.8021 9.8495 13.5841 9.93595 13.3568 9.93595C13.1295 9.93595 12.9114 9.8495 12.7507 9.69562C12.59 9.54175 12.4997 9.33305 12.4997 9.11543C12.4997 8.89782 12.59 8.68912 12.7507 8.53524C12.9114 8.38137 13.1295 8.29492 13.3568 8.29492C13.5841 8.29492 13.8021 8.38137 13.9629 8.53524C14.1236 8.68912 14.2139 8.89782 14.2139 9.11543ZM9.92822 12.3975C9.92822 12.6151 9.83792 12.8238 9.67717 12.9777C9.51643 13.1315 9.29841 13.218 9.07108 13.218C8.84375 13.218 8.62573 13.1315 8.46499 12.9777C8.30424 12.8238 8.21394 12.6151 8.21394 12.3975C8.21394 12.1799 8.30424 11.9712 8.46499 11.8173C8.62573 11.6634 8.84375 11.577 9.07108 11.577C9.29841 11.577 9.51643 11.6634 9.67717 11.8173C9.83792 11.9712 9.92822 12.1799 9.92822 12.3975ZM9.92822 9.11543C9.92822 9.33305 9.83792 9.54175 9.67717 9.69562C9.51643 9.8495 9.29841 9.93595 9.07108 9.93595C8.84375 9.93595 8.62573 9.8495 8.46499 9.69562C8.30424 9.54175 8.21394 9.33305 8.21394 9.11543C8.21394 8.89782 8.30424 8.68912 8.46499 8.53524C8.62573 8.38137 8.84375 8.29492 9.07108 8.29492C9.29841 8.29492 9.51643 8.38137 9.67717 8.53524C9.83792 8.68912 9.92822 8.89782 9.92822 9.11543ZM5.64251 12.3975C5.64251 12.6151 5.5522 12.8238 5.39146 12.9777C5.23071 13.1315 5.01269 13.218 4.78537 13.218C4.55804 13.218 4.34002 13.1315 4.17927 12.9777C4.01853 12.8238 3.92822 12.6151 3.92822 12.3975C3.92822 12.1799 4.01853 11.9712 4.17927 11.8173C4.34002 11.6634 4.55804 11.577 4.78537 11.577C5.01269 11.577 5.23071 11.6634 5.39146 11.8173C5.5522 11.9712 5.64251 12.1799 5.64251 12.3975ZM5.64251 9.11543C5.64251 9.33305 5.5522 9.54175 5.39146 9.69562C5.23071 9.8495 5.01269 9.93595 4.78537 9.93595C4.55804 9.93595 4.34002 9.8495 4.17927 9.69562C4.01853 9.54175 3.92822 9.33305 3.92822 9.11543C3.92822 8.89782 4.01853 8.68912 4.17927 8.53524C4.34002 8.38137 4.55804 8.29492 4.78537 8.29492C5.01269 8.29492 5.23071 8.38137 5.39146 8.53524C5.5522 8.68912 5.64251 8.89782 5.64251 9.11543Z" fill="#3B3731" />
                                                        </svg>
                                                        <p class="item-label">Date</p>
                                                    </div>
                                                    <p class="value">18/12/2025</p>
                                                </div>
                                                <hr class="vertical-line">

                                                <div class="details-item d-flex flex-column gap-10">
                                                    <div class="d-flex gap-10">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                            viewBox="0 0 16 16" fill="none">
                                                            <path
                                                                d="M8 0.5C12.1423 0.5 15.5 3.85774 15.5 8C15.5 12.1423 12.1423 15.5 8 15.5C3.85774 15.5 0.5 12.1423 0.5 8C0.5 3.85774 3.85774 0.5 8 0.5Z"
                                                                stroke="#3B3731" stroke-linecap="round" />
                                                        </svg>
                                                        <p class="item-label">Time</p>
                                                    </div>
                                                    <p class="value">14:30 - 15:30</p>
                                                </div>
                                                <hr class="vertical-line">
                                                <div class="details-item d-flex flex-column gap-10">
                                                    <div class="d-flex gap-10">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="16"
                                                            viewBox="0 0 12 16" fill="none">
                                                            <path
                                                                d="M6 0.5C7.4694 0.5 8.87214 1.04525 9.90137 2.00586C10.9293 2.96529 11.4999 4.25871 11.5 5.59961C11.5 7.10011 10.6408 8.95946 9.51855 10.7236C8.41048 12.4655 7.10434 14.0263 6.32227 14.9082C6.14625 15.1067 5.85375 15.1067 5.67773 14.9082C4.89566 14.0263 3.58952 12.4655 2.48145 10.7236C1.35919 8.95946 0.5 7.10011 0.5 5.59961C0.500111 4.25871 1.07068 2.96529 2.09863 2.00586C3.12786 1.04525 4.53061 0.5 6 0.5ZM6 3.09961C5.30978 3.09961 4.64141 3.35564 4.14355 3.82031C3.64466 4.28597 3.35753 4.92517 3.35742 5.59961C3.35742 6.27422 3.64453 6.91413 4.14355 7.37988C4.64141 7.84453 5.30979 8.09961 6 8.09961C6.34236 8.09961 6.68202 8.03695 7 7.91406C7.31807 7.7911 7.60965 7.61022 7.85645 7.37988C8.10326 7.14952 8.30086 6.87397 8.43652 6.56836C8.57224 6.26256 8.64258 5.93289 8.64258 5.59961C8.64247 4.92517 8.35534 4.28597 7.85645 3.82031C7.35859 3.35564 6.69022 3.09961 6 3.09961Z"
                                                                stroke="#3B3731" />
                                                        </svg>
                                                        <p class="item-label">Location</p>
                                                    </div>
                                                    <p class="value">Victoria Embankment</p>
                                                </div>
                                                <hr class="vertical-line">
                                                <div class="details-item images-div">
                                                    <img src="<?= BASE_URL ?>assets/images/pet_details_1.png" class="rounded-image first-image" height="50px" width="50px" alt="">
                                                    <img src="<?= BASE_URL ?>assets/images/pet_details_2.png" class="rounded-image second-image" height="50px" width="50px" alt="">
                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                    <div class="action-btns d-flex flex-column justify-content-center gap-20">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48" fill="none">
                                            <rect width="48" height="48" rx="24" fill="#FF6E6E" />
                                            <path d="M33.4955 23.7425C33.8911 24.1343 33.8906 24.7738 33.4942 25.1649L28.4257 30.1665C28.0359 30.5512 27.4078 30.5461 27.0242 30.1552C26.8723 30.0053 26.8115 29.8554 26.8419 29.7055C26.8799 29.5555 26.9634 29.4131 27.0926 29.2782L30.3629 26.0735C30.5452 25.8936 30.7161 25.7324 30.8756 25.59C31.0019 25.4772 30.9047 25.2517 30.7362 25.2687C30.5411 25.2885 30.3407 25.3056 30.135 25.3201C29.7172 25.3501 29.2842 25.3651 28.836 25.3651H14.9164C14.4103 25.3651 14 24.9548 14 24.4487C14 23.9426 14.4103 23.5323 14.9164 23.5323H28.836C29.2842 23.5323 29.721 23.5473 30.1464 23.5772C30.3491 23.5915 30.5466 23.6084 30.7389 23.6278C30.9098 23.645 31.0063 23.4188 30.8756 23.3074C30.7161 23.1649 30.5452 23.0038 30.3629 22.8239L27.0698 19.5967C26.933 19.4618 26.8495 19.3193 26.8191 19.1694C26.7887 19.0195 26.8457 18.8696 26.99 18.7196C27.3781 18.3243 28.0165 18.3169 28.4101 18.7067L33.4955 23.7425Z" fill="white" />
                                        </svg>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48" fill="none">
                                            <rect width="48" height="48" rx="24" fill="#FF6E6E" />
                                            <path d="M16.3081 33.994V30.1499H20.1519" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M33.8208 22.1634C34.2286 24.3394 33.9025 26.5892 32.8935 28.5598C31.8846 30.5304 30.25 32.11 28.2462 33.052C26.2423 33.993 23.9827 34.242 21.8219 33.761C19.661 33.279 17.7212 32.093 16.3068 30.3903M14.1711 25.8366C13.7632 23.6606 14.0894 21.4108 15.0983 19.4402C16.1072 17.4696 17.7419 15.8897 19.7457 14.9484C21.7495 14.0071 24.0091 13.7578 26.17 14.2394C28.3309 14.7211 30.2707 15.9065 31.685 17.6097" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M31.6834 14.0063V17.8501H27.8396M19.4856 24.5178C18.9416 24.4233 18.9416 23.6421 19.4856 23.5476C20.4486 23.3791 21.3396 22.9282 22.0456 22.252C22.7516 21.5759 23.2405 20.7051 23.4503 19.7503L23.4829 19.6C23.6007 19.0621 24.3663 19.059 24.4887 19.5953L24.529 19.7704C24.7455 20.7215 25.2385 21.5873 25.9459 22.2588C26.6533 22.9304 27.5435 23.3777 28.5046 23.5445C29.0517 23.639 29.0517 24.4248 28.5046 24.5209C27.5437 24.6876 26.6536 25.1347 25.9463 25.8059C25.2389 26.4772 24.7458 27.3426 24.529 28.2934L24.4887 28.467C24.3663 29.0032 23.6007 29.0001 23.4829 28.4623L23.4519 28.3135C23.2419 27.3584 22.7525 26.4872 22.0459 25.811C21.3393 25.1348 20.4476 24.6841 19.4841 24.5163" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </div>
                                </div>


                            </div>

                            <div class="bookings-cards bg-border-gray-header mt-5">
                                <div class="cards-header bg-gray-header">
                                    <div class="header-left d-flex align-items-center gap-15">
                                        <span class="status-badge light-color-font bg-status-gray-header">Completed</span>
                                        <span class="studio-name medium-font-bold">Sarah’s Grooming Studio - <span class="host medium-muted-font">Sarah W.</span></span>
                                    </div>
                                    <div class="booking-ref simple-font">Booking reference: FG-10294</div>
                                </div>

                                <div class="card-body d-flex justify-content-between">
                                    <div class="profile-section d-flex align-items-center gap-25">
                                        <div class="avatar-wrap">
                                            <img class="avatar" src="http://localhost:8000/assets/images/groomer-profile.png" alt="Sarah's avatar">
                                            <div class="badge-shield" title="Verified">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="33" viewBox="0 0 30 33" fill="none">
                                                    <ellipse cx="15.873" cy="16.5256" rx="9.3645" ry="8.81365" fill="white"></ellipse>
                                                    <path d="M15.44 0.185076C15.1841 0.0638192 14.9099 0 14.6235 0C14.3372 0 14.063 0.0638192 13.8071 0.185076L2.3337 5.28423C0.993208 5.87775 -0.00606541 7.26263 2.77146e-05 8.93469C0.0304934 15.2656 2.51649 26.8487 13.015 32.1138C14.0325 32.6244 15.2146 32.6244 16.2321 32.1138C26.7306 26.8487 29.2166 15.2656 29.247 8.93469C29.2531 7.26263 28.2539 5.87775 26.9134 5.28423L15.44 0.185076ZM8.82897 18.2651C9.12144 18.3416 9.43219 18.3799 9.74903 18.3799C11.8999 18.3799 13.6486 16.5483 13.6486 14.2955V10.2111H16.3418C17.0791 10.2111 17.7554 10.645 18.0844 11.3407L18.5231 12.2533H22.4227C22.9589 12.2533 23.3976 12.7128 23.3976 13.2744V15.3166C23.3976 18.1374 21.2163 20.4222 18.5231 20.4222H15.5984V23.6578C15.5984 24.1237 15.2389 24.5066 14.7881 24.5066C14.6784 24.5066 14.5687 24.4811 14.4712 24.4364L8.45729 21.7368C8.05514 21.5581 7.79923 21.1433 7.79923 20.6902C7.79923 20.5115 7.83579 20.3392 7.915 20.1796L8.82897 18.2651ZM8.77413 10.2111H11.6988V14.2955C11.6988 15.4251 10.8275 16.3377 9.74903 16.3377C8.67055 16.3377 7.79923 15.4251 7.79923 14.2955V11.2322C7.79923 10.6706 8.23794 10.2111 8.77413 10.2111ZM16.5733 13.2744C16.5733 13.0036 16.4706 12.7439 16.2878 12.5524C16.105 12.3609 15.857 12.2533 15.5984 12.2533C15.3399 12.2533 15.0919 12.3609 14.9091 12.5524C14.7262 12.7439 14.6235 13.0036 14.6235 13.2744C14.6235 13.5452 14.7262 13.8049 14.9091 13.9964C15.0919 14.1879 15.3399 14.2955 15.5984 14.2955C15.857 14.2955 16.105 14.1879 16.2878 13.9964C16.4706 13.8049 16.5733 13.5452 16.5733 13.2744Z" fill="#C9DDA0"></path>
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="listing-section d-flex flex-column align-items-start gap-15">
                                            <div class="service-type">Home Visits</div>

                                            <div class="listing d-flex align-items-center gap-25">
                                                <div class="details-item d-flex flex-column gap-10">
                                                    <div class="d-flex gap-10">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="17"
                                                            viewBox="0 0 16 17" fill="none">
                                                            <path
                                                                d="M4.94591 11.5544C6.23114 12.8397 9.35699 11.798 11.9274 9.22713C14.4983 6.65667 15.54 3.53082 14.2548 2.24559M8.72754 1.37259L9.30927 1.95473M6.6915 3.40904L7.27322 3.99077M4.9455 5.73636L5.52722 6.31809M4.36377 8.6454L4.9455 9.22713M11.9274 0.5L12.5092 1.08173M11.3457 3.99118L12.5092 5.15463M9.30968 6.02763L10.4731 7.19109M6.98236 7.77281L8.14581 8.93627"
                                                                stroke="#3B3731" stroke-linecap="round" stroke-linejoin="round" />
                                                            <path
                                                                d="M4.94547 13.2998C5.42747 12.8178 5.42747 12.0364 4.94548 11.5544C4.46348 11.0724 3.68202 11.0724 3.20003 11.5544L0.872775 13.8816C0.390784 14.3636 0.390784 15.1451 0.872775 15.6271C1.35477 16.1091 2.13623 16.1091 2.61822 15.6271L4.94547 13.2998Z"
                                                                stroke="#3B3731" stroke-linecap="round" stroke-linejoin="round" />
                                                        </svg>
                                                        <p class="item-label">Service</p>
                                                    </div>
                                                    <p class="value">Full Groom</p>
                                                </div>
                                                <hr class="vertical-line">
                                                <div class="details-item d-flex flex-column gap-10">
                                                    <div class="d-flex gap-10">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="19" height="17"
                                                            viewBox="0 0 19 17" fill="none">
                                                            <path
                                                                d="M0.5 8.29554C0.5 5.20139 0.5 3.6539 1.50457 2.69308C2.50914 1.73227 4.12486 1.73145 7.35714 1.73145H10.7857C14.018 1.73145 15.6346 1.73145 16.6383 2.69308C17.642 3.65472 17.6429 5.20139 17.6429 8.29554V9.93656C17.6429 13.0307 17.6429 14.5782 16.6383 15.539C15.6337 16.4998 14.018 16.5007 10.7857 16.5007H7.35714C4.12486 16.5007 2.50829 16.5007 1.50457 15.539C0.500857 14.5774 0.5 13.0307 0.5 9.93656V8.29554Z"
                                                                stroke="#3B3731" />
                                                            <path d="M4.78585 1.73077V0.5M13.3573 1.73077V0.5M0.928711 5.83333H17.2144"
                                                                stroke="#3B3731" stroke-linecap="round" />
                                                            <path
                                                                d="M14.2139 12.3975C14.2139 12.6151 14.1236 12.8238 13.9629 12.9777C13.8021 13.1315 13.5841 13.218 13.3568 13.218C13.1295 13.218 12.9114 13.1315 12.7507 12.9777C12.59 12.8238 12.4997 12.6151 12.4997 12.3975C12.4997 12.1799 12.59 11.9712 12.7507 11.8173C12.9114 11.6634 13.1295 11.577 13.3568 11.577C13.5841 11.577 13.8021 11.6634 13.9629 11.8173C14.1236 11.9712 14.2139 12.1799 14.2139 12.3975ZM14.2139 9.11543C14.2139 9.33305 14.1236 9.54175 13.9629 9.69562C13.8021 9.8495 13.5841 9.93595 13.3568 9.93595C13.1295 9.93595 12.9114 9.8495 12.7507 9.69562C12.59 9.54175 12.4997 9.33305 12.4997 9.11543C12.4997 8.89782 12.59 8.68912 12.7507 8.53524C12.9114 8.38137 13.1295 8.29492 13.3568 8.29492C13.5841 8.29492 13.8021 8.38137 13.9629 8.53524C14.1236 8.68912 14.2139 8.89782 14.2139 9.11543ZM9.92822 12.3975C9.92822 12.6151 9.83792 12.8238 9.67717 12.9777C9.51643 13.1315 9.29841 13.218 9.07108 13.218C8.84375 13.218 8.62573 13.1315 8.46499 12.9777C8.30424 12.8238 8.21394 12.6151 8.21394 12.3975C8.21394 12.1799 8.30424 11.9712 8.46499 11.8173C8.62573 11.6634 8.84375 11.577 9.07108 11.577C9.29841 11.577 9.51643 11.6634 9.67717 11.8173C9.83792 11.9712 9.92822 12.1799 9.92822 12.3975ZM9.92822 9.11543C9.92822 9.33305 9.83792 9.54175 9.67717 9.69562C9.51643 9.8495 9.29841 9.93595 9.07108 9.93595C8.84375 9.93595 8.62573 9.8495 8.46499 9.69562C8.30424 9.54175 8.21394 9.33305 8.21394 9.11543C8.21394 8.89782 8.30424 8.68912 8.46499 8.53524C8.62573 8.38137 8.84375 8.29492 9.07108 8.29492C9.29841 8.29492 9.51643 8.38137 9.67717 8.53524C9.83792 8.68912 9.92822 8.89782 9.92822 9.11543ZM5.64251 12.3975C5.64251 12.6151 5.5522 12.8238 5.39146 12.9777C5.23071 13.1315 5.01269 13.218 4.78537 13.218C4.55804 13.218 4.34002 13.1315 4.17927 12.9777C4.01853 12.8238 3.92822 12.6151 3.92822 12.3975C3.92822 12.1799 4.01853 11.9712 4.17927 11.8173C4.34002 11.6634 4.55804 11.577 4.78537 11.577C5.01269 11.577 5.23071 11.6634 5.39146 11.8173C5.5522 11.9712 5.64251 12.1799 5.64251 12.3975ZM5.64251 9.11543C5.64251 9.33305 5.5522 9.54175 5.39146 9.69562C5.23071 9.8495 5.01269 9.93595 4.78537 9.93595C4.55804 9.93595 4.34002 9.8495 4.17927 9.69562C4.01853 9.54175 3.92822 9.33305 3.92822 9.11543C3.92822 8.89782 4.01853 8.68912 4.17927 8.53524C4.34002 8.38137 4.55804 8.29492 4.78537 8.29492C5.01269 8.29492 5.23071 8.38137 5.39146 8.53524C5.5522 8.68912 5.64251 8.89782 5.64251 9.11543Z"
                                                                fill="#3B3731" />
                                                        </svg>
                                                        <p class="item-label">Date</p>
                                                    </div>
                                                    <p class="value">18/12/2025</p>
                                                </div>
                                                <hr class="vertical-line">
                                                <div class="details-item d-flex flex-column gap-10">
                                                    <div class="d-flex gap-10">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                            viewBox="0 0 16 16" fill="none">
                                                            <path
                                                                d="M8 0.5C12.1423 0.5 15.5 3.85774 15.5 8C15.5 12.1423 12.1423 15.5 8 15.5C3.85774 15.5 0.5 12.1423 0.5 8C0.5 3.85774 3.85774 0.5 8 0.5Z"
                                                                stroke="#3B3731" stroke-linecap="round" />
                                                        </svg>
                                                        <p class="item-label">Time</p>
                                                    </div>
                                                    <p class="value">14:30 - 15:30</p>
                                                </div>
                                                <hr class="vertical-line">
                                                <div class="details-item d-flex flex-column gap-10">
                                                    <div class="d-flex gap-10">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="16"
                                                            viewBox="0 0 12 16" fill="none">
                                                            <path
                                                                d="M6 0.5C7.4694 0.5 8.87214 1.04525 9.90137 2.00586C10.9293 2.96529 11.4999 4.25871 11.5 5.59961C11.5 7.10011 10.6408 8.95946 9.51855 10.7236C8.41048 12.4655 7.10434 14.0263 6.32227 14.9082C6.14625 15.1067 5.85375 15.1067 5.67773 14.9082C4.89566 14.0263 3.58952 12.4655 2.48145 10.7236C1.35919 8.95946 0.5 7.10011 0.5 5.59961C0.500111 4.25871 1.07068 2.96529 2.09863 2.00586C3.12786 1.04525 4.53061 0.5 6 0.5ZM6 3.09961C5.30978 3.09961 4.64141 3.35564 4.14355 3.82031C3.64466 4.28597 3.35753 4.92517 3.35742 5.59961C3.35742 6.27422 3.64453 6.91413 4.14355 7.37988C4.64141 7.84453 5.30979 8.09961 6 8.09961C6.34236 8.09961 6.68202 8.03695 7 7.91406C7.31807 7.7911 7.60965 7.61022 7.85645 7.37988C8.10326 7.14952 8.30086 6.87397 8.43652 6.56836C8.57224 6.26256 8.64258 5.93289 8.64258 5.59961C8.64247 4.92517 8.35534 4.28597 7.85645 3.82031C7.35859 3.35564 6.69022 3.09961 6 3.09961Z"
                                                                stroke="#3B3731" />
                                                        </svg>
                                                        <p class="item-label">Location</p>
                                                    </div>
                                                    <p class="value">At your home</p>
                                                </div>
                                                <hr class="vertical-line">
                                                <div class="details-item">
                                                    <img src="<?= BASE_URL ?>assets/images/pet_details_1.png" class="rounded-image" height="50px" width="50px" alt="">
                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                    <div class="action-btns d-flex flex-column justify-content-center gap-20">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48" fill="none">
                                            <rect width="48" height="48" rx="24" fill="#D4D4D4" />
                                            <path d="M33.4955 23.7425C33.8911 24.1343 33.8906 24.7738 33.4942 25.1649L28.4257 30.1665C28.0359 30.5512 27.4078 30.5461 27.0242 30.1552C26.8723 30.0053 26.8115 29.8554 26.8419 29.7055C26.8799 29.5555 26.9634 29.4131 27.0926 29.2782L30.3629 26.0735C30.5452 25.8936 30.7161 25.7324 30.8756 25.59C31.0019 25.4772 30.9047 25.2517 30.7362 25.2687C30.5411 25.2885 30.3407 25.3056 30.135 25.3201C29.7172 25.3501 29.2842 25.3651 28.836 25.3651H14.9164C14.4103 25.3651 14 24.9548 14 24.4487C14 23.9426 14.4103 23.5323 14.9164 23.5323H28.836C29.2842 23.5323 29.721 23.5473 30.1464 23.5772C30.3491 23.5915 30.5466 23.6084 30.7389 23.6278C30.9098 23.645 31.0063 23.4188 30.8756 23.3074C30.7161 23.1649 30.5452 23.0038 30.3629 22.8239L27.0698 19.5967C26.933 19.4618 26.8495 19.3193 26.8191 19.1694C26.7887 19.0195 26.8457 18.8696 26.99 18.7196C27.3781 18.3243 28.0165 18.3169 28.4101 18.7067L33.4955 23.7425Z" fill="white" />
                                        </svg>

                                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48" fill="none">
                                            <rect width="48" height="48" rx="24" fill="#D4D4D4" />
                                            <path d="M16.3081 33.994V30.1499H20.1519" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M33.8208 22.1634C34.2286 24.3394 33.9025 26.5892 32.8935 28.5598C31.8846 30.5304 30.25 32.11 28.2462 33.052C26.2423 33.993 23.9827 34.242 21.8219 33.761C19.661 33.279 17.7212 32.093 16.3068 30.3903M14.1711 25.8366C13.7632 23.6606 14.0894 21.4108 15.0983 19.4402C16.1072 17.4696 17.7419 15.8897 19.7457 14.9484C21.7495 14.0071 24.0091 13.7578 26.17 14.2394C28.3309 14.7211 30.2707 15.9065 31.685 17.6097" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M31.6834 14.0063V17.8501H27.8396M19.4856 24.5178C18.9416 24.4233 18.9416 23.6421 19.4856 23.5476C20.4486 23.3791 21.3396 22.9282 22.0456 22.252C22.7516 21.5759 23.2405 20.7051 23.4503 19.7503L23.4829 19.6C23.6007 19.0621 24.3663 19.059 24.4887 19.5953L24.529 19.7704C24.7455 20.7215 25.2385 21.5873 25.9459 22.2588C26.6533 22.9304 27.5435 23.3777 28.5046 23.5445C29.0517 23.639 29.0517 24.4248 28.5046 24.5209C27.5437 24.6876 26.6536 25.1347 25.9463 25.8059C25.2389 26.4772 24.7458 27.3426 24.529 28.2934L24.4887 28.467C24.3663 29.0032 23.6007 29.0001 23.4829 28.4623L23.4519 28.3135C23.2419 27.3584 22.7525 26.4872 22.0459 25.811C21.3393 25.1348 20.4476 24.6841 19.4841 24.5163" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </div>
                                </div>


                            </div>

                            <div class="bookings-cards bg-border-pink-header mt-5">
                                <div class="cards-header bg-pink-header">
                                    <div class="header-left d-flex align-items-center gap-15">
                                        <span class="status-badge light-color-font bg-status-pink-header">Cancelled</span>
                                        <span class="studio-name medium-font-bold">Furs & Co. Studio - <span class="medium-light-font">Hosted by</span> <span class="host medium-muted-font">Dev É.</span></span>
                                    </div>
                                    <div class="booking-ref simple-font">Booking reference: FG-10294</div>
                                </div>

                                <div class="card-body d-flex justify-content-between">
                                    <div class="profile-section d-flex align-items-center gap-25">
                                        <div class="avatar-wrap">
                                            <img class="avatar" src="http://localhost:8000/assets/images/space_card3.png" alt="Sarah's avatar">
                                            <div class="badge-shield" title="Verified">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="29" height="30" viewBox="0 0 29 30" fill="none">
                                                    <path d="M14.9293 0.170856C14.6819 0.058916 14.4168 0 14.1399 0C13.8629 0 13.5978 0.058916 13.3504 0.170856L2.25651 4.87824C0.960357 5.42616 -0.0058648 6.70463 2.67979e-05 8.24823C0.0294848 14.0927 2.43326 24.7859 12.5845 29.6465C13.5684 30.1178 14.7113 30.1178 15.6952 29.6465C25.8465 24.7859 28.2502 14.0927 28.2797 8.24823C28.2856 6.70463 27.3194 5.42616 26.0232 4.87824L14.9293 0.170856Z" fill="#CBDCE8" />
                                                    <path d="M21.818 8.18213L15.7574 14.6215L21.818 8.18213ZM13.065 14.3071C11.1862 15.0283 9.68391 14.9049 8.18164 14.3094C8.56043 19.1905 10.8362 21.067 13.8703 21.8185C13.8703 21.8185 16.1559 20.2018 16.4854 16.3693C16.521 15.9541 16.5385 15.7473 16.4529 15.5132C16.3665 15.2791 16.1968 15.1117 15.8582 14.7761C15.3006 14.2246 15.0226 13.9488 14.6915 13.8791C14.3604 13.8109 13.9286 13.9761 13.065 14.3071Z" fill="#CBDCE8" />
                                                    <path d="M21.818 8.18213L15.7574 14.6215M13.065 14.3071C11.1862 15.0283 9.68391 14.9049 8.18164 14.3094C8.56043 19.1905 10.8362 21.067 13.8703 21.8185C13.8703 21.8185 16.1559 20.2018 16.4854 16.3693C16.521 15.9541 16.5385 15.7473 16.4529 15.5132C16.3665 15.2791 16.1968 15.1117 15.8582 14.7761C15.3006 14.2246 15.0225 13.9488 14.6915 13.8791C14.3604 13.8109 13.9286 13.9761 13.065 14.3071Z" stroke="white" stroke-linecap="round" stroke-linejoin="round" />
                                                    <path d="M9.31836 18.3679C9.31836 18.3679 11.2123 18.7346 13.1062 17.2725L9.31836 18.3679Z" fill="#CBDCE8" />
                                                    <path d="M9.31836 18.3679C9.31836 18.3679 11.2123 18.7346 13.1062 17.2725" stroke="white" stroke-linecap="round" stroke-linejoin="round" />
                                                    <path d="M12.3485 11.4016C12.3485 11.6527 12.2488 11.8936 12.0712 12.0712C11.8936 12.2488 11.6527 12.3485 11.4016 12.3485C11.1504 12.3485 10.9095 12.2488 10.732 12.0712C10.5544 11.8936 10.4546 11.6527 10.4546 11.4016C10.4546 11.1504 10.5544 10.9095 10.732 10.732C10.9095 10.5544 11.1504 10.4546 11.4016 10.4546C11.6527 10.4546 11.8936 10.5544 12.0712 10.732C12.2488 10.9095 12.3485 11.1504 12.3485 11.4016Z" fill="#CBDCE8" stroke="white" />
                                                    <path d="M14.2432 8.93896V9.01472V8.93896Z" fill="#CBDCE8" />
                                                    <path d="M14.2432 8.93896V9.01472" stroke="white" stroke-linecap="round" stroke-linejoin="round" />
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="listing-section d-flex flex-column align-items-start gap-15">
                                            <div class="service-type" style="background:#FFA899">Garden / Shed</div>

                                            <div class="listing d-flex align-items-center gap-25">
                                                <div class="details-item d-flex flex-column gap-10">
                                                    <div class="d-flex gap-10">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="19" height="17" viewBox="0 0 19 17" fill="none">
                                                            <path d="M0.5 8.29554C0.5 5.20139 0.5 3.6539 1.50457 2.69308C2.50914 1.73227 4.12486 1.73145 7.35714 1.73145H10.7857C14.018 1.73145 15.6346 1.73145 16.6383 2.69308C17.642 3.65472 17.6429 5.20139 17.6429 8.29554V9.93656C17.6429 13.0307 17.6429 14.5782 16.6383 15.539C15.6337 16.4998 14.018 16.5007 10.7857 16.5007H7.35714C4.12486 16.5007 2.50829 16.5007 1.50457 15.539C0.500857 14.5774 0.5 13.0307 0.5 9.93656V8.29554Z" stroke="#3B3731" />
                                                            <path d="M4.78585 1.73077V0.5M13.3573 1.73077V0.5M0.928711 5.83333H17.2144" stroke="#3B3731" stroke-linecap="round" />
                                                            <path d="M14.2139 12.3975C14.2139 12.6151 14.1236 12.8238 13.9629 12.9777C13.8021 13.1315 13.5841 13.218 13.3568 13.218C13.1295 13.218 12.9114 13.1315 12.7507 12.9777C12.59 12.8238 12.4997 12.6151 12.4997 12.3975C12.4997 12.1799 12.59 11.9712 12.7507 11.8173C12.9114 11.6634 13.1295 11.577 13.3568 11.577C13.5841 11.577 13.8021 11.6634 13.9629 11.8173C14.1236 11.9712 14.2139 12.1799 14.2139 12.3975ZM14.2139 9.11543C14.2139 9.33305 14.1236 9.54175 13.9629 9.69562C13.8021 9.8495 13.5841 9.93595 13.3568 9.93595C13.1295 9.93595 12.9114 9.8495 12.7507 9.69562C12.59 9.54175 12.4997 9.33305 12.4997 9.11543C12.4997 8.89782 12.59 8.68912 12.7507 8.53524C12.9114 8.38137 13.1295 8.29492 13.3568 8.29492C13.5841 8.29492 13.8021 8.38137 13.9629 8.53524C14.1236 8.68912 14.2139 8.89782 14.2139 9.11543ZM9.92822 12.3975C9.92822 12.6151 9.83792 12.8238 9.67717 12.9777C9.51643 13.1315 9.29841 13.218 9.07108 13.218C8.84375 13.218 8.62573 13.1315 8.46499 12.9777C8.30424 12.8238 8.21394 12.6151 8.21394 12.3975C8.21394 12.1799 8.30424 11.9712 8.46499 11.8173C8.62573 11.6634 8.84375 11.577 9.07108 11.577C9.29841 11.577 9.51643 11.6634 9.67717 11.8173C9.83792 11.9712 9.92822 12.1799 9.92822 12.3975ZM9.92822 9.11543C9.92822 9.33305 9.83792 9.54175 9.67717 9.69562C9.51643 9.8495 9.29841 9.93595 9.07108 9.93595C8.84375 9.93595 8.62573 9.8495 8.46499 9.69562C8.30424 9.54175 8.21394 9.33305 8.21394 9.11543C8.21394 8.89782 8.30424 8.68912 8.46499 8.53524C8.62573 8.38137 8.84375 8.29492 9.07108 8.29492C9.29841 8.29492 9.51643 8.38137 9.67717 8.53524C9.83792 8.68912 9.92822 8.89782 9.92822 9.11543ZM5.64251 12.3975C5.64251 12.6151 5.5522 12.8238 5.39146 12.9777C5.23071 13.1315 5.01269 13.218 4.78537 13.218C4.55804 13.218 4.34002 13.1315 4.17927 12.9777C4.01853 12.8238 3.92822 12.6151 3.92822 12.3975C3.92822 12.1799 4.01853 11.9712 4.17927 11.8173C4.34002 11.6634 4.55804 11.577 4.78537 11.577C5.01269 11.577 5.23071 11.6634 5.39146 11.8173C5.5522 11.9712 5.64251 12.1799 5.64251 12.3975ZM5.64251 9.11543C5.64251 9.33305 5.5522 9.54175 5.39146 9.69562C5.23071 9.8495 5.01269 9.93595 4.78537 9.93595C4.55804 9.93595 4.34002 9.8495 4.17927 9.69562C4.01853 9.54175 3.92822 9.33305 3.92822 9.11543C3.92822 8.89782 4.01853 8.68912 4.17927 8.53524C4.34002 8.38137 4.55804 8.29492 4.78537 8.29492C5.01269 8.29492 5.23071 8.38137 5.39146 8.53524C5.5522 8.68912 5.64251 8.89782 5.64251 9.11543Z" fill="#3B3731" />
                                                        </svg>
                                                        <p class="item-label">Date</p>
                                                    </div>
                                                    <p class="value">18/12/2025</p>
                                                </div>
                                                <hr class="vertical-line">

                                                <div class="details-item d-flex flex-column gap-10">
                                                    <div class="d-flex gap-10">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                            viewBox="0 0 16 16" fill="none">
                                                            <path
                                                                d="M8 0.5C12.1423 0.5 15.5 3.85774 15.5 8C15.5 12.1423 12.1423 15.5 8 15.5C3.85774 15.5 0.5 12.1423 0.5 8C0.5 3.85774 3.85774 0.5 8 0.5Z"
                                                                stroke="#3B3731" stroke-linecap="round" />
                                                        </svg>
                                                        <p class="item-label">Time</p>
                                                    </div>
                                                    <p class="value">14:30 - 15:30</p>
                                                </div>
                                                <hr class="vertical-line">
                                                <div class="details-item d-flex flex-column gap-10">
                                                    <div class="d-flex gap-10">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="16"
                                                            viewBox="0 0 12 16" fill="none">
                                                            <path
                                                                d="M6 0.5C7.4694 0.5 8.87214 1.04525 9.90137 2.00586C10.9293 2.96529 11.4999 4.25871 11.5 5.59961C11.5 7.10011 10.6408 8.95946 9.51855 10.7236C8.41048 12.4655 7.10434 14.0263 6.32227 14.9082C6.14625 15.1067 5.85375 15.1067 5.67773 14.9082C4.89566 14.0263 3.58952 12.4655 2.48145 10.7236C1.35919 8.95946 0.5 7.10011 0.5 5.59961C0.500111 4.25871 1.07068 2.96529 2.09863 2.00586C3.12786 1.04525 4.53061 0.5 6 0.5ZM6 3.09961C5.30978 3.09961 4.64141 3.35564 4.14355 3.82031C3.64466 4.28597 3.35753 4.92517 3.35742 5.59961C3.35742 6.27422 3.64453 6.91413 4.14355 7.37988C4.64141 7.84453 5.30979 8.09961 6 8.09961C6.34236 8.09961 6.68202 8.03695 7 7.91406C7.31807 7.7911 7.60965 7.61022 7.85645 7.37988C8.10326 7.14952 8.30086 6.87397 8.43652 6.56836C8.57224 6.26256 8.64258 5.93289 8.64258 5.59961C8.64247 4.92517 8.35534 4.28597 7.85645 3.82031C7.35859 3.35564 6.69022 3.09961 6 3.09961Z"
                                                                stroke="#3B3731" />
                                                        </svg>
                                                        <p class="item-label">Location</p>
                                                    </div>
                                                    <p class="value">Victoria Embankment</p>
                                                </div>
                                                <hr class="vertical-line">
                                                <div class="details-item images-div">
                                                    <img src="<?= BASE_URL ?>assets/images/pet_details_1.png" class="rounded-image first-image" height="50px" width="50px" alt="">
                                                    <img src="<?= BASE_URL ?>assets/images/pet_details_2.png" class="rounded-image second-image" height="50px" width="50px" alt="">
                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                    <div class="action-btns d-flex flex-column justify-content-center gap-20">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48" fill="none">
                                            <rect width="48" height="48" rx="24" fill="#FF6E6E" />
                                            <path d="M33.4955 23.7425C33.8911 24.1343 33.8906 24.7738 33.4942 25.1649L28.4257 30.1665C28.0359 30.5512 27.4078 30.5461 27.0242 30.1552C26.8723 30.0053 26.8115 29.8554 26.8419 29.7055C26.8799 29.5555 26.9634 29.4131 27.0926 29.2782L30.3629 26.0735C30.5452 25.8936 30.7161 25.7324 30.8756 25.59C31.0019 25.4772 30.9047 25.2517 30.7362 25.2687C30.5411 25.2885 30.3407 25.3056 30.135 25.3201C29.7172 25.3501 29.2842 25.3651 28.836 25.3651H14.9164C14.4103 25.3651 14 24.9548 14 24.4487C14 23.9426 14.4103 23.5323 14.9164 23.5323H28.836C29.2842 23.5323 29.721 23.5473 30.1464 23.5772C30.3491 23.5915 30.5466 23.6084 30.7389 23.6278C30.9098 23.645 31.0063 23.4188 30.8756 23.3074C30.7161 23.1649 30.5452 23.0038 30.3629 22.8239L27.0698 19.5967C26.933 19.4618 26.8495 19.3193 26.8191 19.1694C26.7887 19.0195 26.8457 18.8696 26.99 18.7196C27.3781 18.3243 28.0165 18.3169 28.4101 18.7067L33.4955 23.7425Z" fill="white" />
                                        </svg>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48" fill="none">
                                            <rect width="48" height="48" rx="24" fill="#FF6E6E" />
                                            <path d="M16.3081 33.994V30.1499H20.1519" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M33.8208 22.1634C34.2286 24.3394 33.9025 26.5892 32.8935 28.5598C31.8846 30.5304 30.25 32.11 28.2462 33.052C26.2423 33.993 23.9827 34.242 21.8219 33.761C19.661 33.279 17.7212 32.093 16.3068 30.3903M14.1711 25.8366C13.7632 23.6606 14.0894 21.4108 15.0983 19.4402C16.1072 17.4696 17.7419 15.8897 19.7457 14.9484C21.7495 14.0071 24.0091 13.7578 26.17 14.2394C28.3309 14.7211 30.2707 15.9065 31.685 17.6097" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M31.6834 14.0063V17.8501H27.8396M19.4856 24.5178C18.9416 24.4233 18.9416 23.6421 19.4856 23.5476C20.4486 23.3791 21.3396 22.9282 22.0456 22.252C22.7516 21.5759 23.2405 20.7051 23.4503 19.7503L23.4829 19.6C23.6007 19.0621 24.3663 19.059 24.4887 19.5953L24.529 19.7704C24.7455 20.7215 25.2385 21.5873 25.9459 22.2588C26.6533 22.9304 27.5435 23.3777 28.5046 23.5445C29.0517 23.639 29.0517 24.4248 28.5046 24.5209C27.5437 24.6876 26.6536 25.1347 25.9463 25.8059C25.2389 26.4772 24.7458 27.3426 24.529 28.2934L24.4887 28.467C24.3663 29.0032 23.6007 29.0001 23.4829 28.4623L23.4519 28.3135C23.2419 27.3584 22.7525 26.4872 22.0459 25.811C21.3393 25.1348 20.4476 24.6841 19.4841 24.5163" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </div>
                                </div>


                            </div>


                            <div class="d-flex align-items-center justify-content-center">
                                <button type="button" class="btn-custom btn-no-bg text-center mt-5 medium-font-bold">Load More</button>
                            </div>

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