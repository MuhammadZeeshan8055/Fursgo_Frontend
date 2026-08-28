<?php
include '../function_helper.php';
include_once __DIR__ . '/../components/extras-addons.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="icon" href="<?= BASE_URL ?>assets/images/favicon.ico" type="image/x-icon">
    <title>Bookings - My Bookings</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/responsive.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/bootstrap.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/media_query.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/common.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/my_bookings.css">
    <style>
        /* .hint {
            font-size: 13px;
            color: #a09080;
            margin-bottom: 16px;
            letter-spacing: .02em;
            min-height: 20px;
        } */
        .sort-by {
            position: relative;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            border: 1px solid #FBAC83;
            color: #FBAC83;
            padding: 8px 16px;
            border-radius: 100px;
            cursor: pointer;
        }

        .sort-dropdown {
            position: absolute;
            top: 120%;
            right: 0;
            background: #fff;
            border: 1px solid #ccc;
            border-radius: 10px;
            min-width: 230px;
            display: none;
            z-index: 1000;
        }

        .sort-dropdown ul {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .sort-dropdown li {
            padding: 12px 16px;
            border-bottom: 1px solid #eee;
            color: #3b3731;
            font-family: Lato;
            font-size: 14px;
            font-style: normal;
            font-weight: 400;
            line-height: normal;
        }

        .sort-dropdown li:last-child {
            border-bottom: none;
        }

        .sort-dropdown label {
            display: flex;
            justify-content: space-between;
            align-items: center;
            cursor: pointer;

        }

        .sort-dropdown input {
            display: none;
        }

        .check-circle {
            width: 20px;
            height: 20px;
            border: 1px solid #FBAC83;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-sizing: border-box;
        }

        .check-circle::after {
            content: "";
            width: 12px;
            height: 12px;
            background: #FBAC83;
            border-radius: 50%;
            display: none;
        }

        input:checked+.check-circle::after {
            display: block;
        }

        .sort-dropdown.show {
            display: block;
        }

        .calendar-wrapper {
            position: relative;
            display: inline-block;
        }

        .card.show {
            display: block;
        }

        .card {
            background: #fff;
            border-radius: 20px;
            padding: 8px 8px 8px;
            width: 300px;
            user-select: none;
            border-radius: 10px;
            border: 1px solid #D4D4D4;
            background: #FFF;
            position: absolute;
            top: 100%;
            /* below button */
            right: 0;
            margin-top: 8px;
            z-index: 999;
            display: none;
        }

        .header {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 18px;
        }

        .pill {
            background: #fff;
            padding: 7px 14px;
            color: #9D9B98;
            text-align: center;
            font-family: Lato;
            font-size: 14px;
            font-style: normal;
            font-weight: 600;
            line-height: normal;
            border-radius: 5px;
            border: 1px solid #F7F7F7;
            background: #FFF;
        }

        .arrows {
            margin-left: auto;
            display: flex;
            gap: 4px;
        }

        .nav {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            border: none;
            background: #f3ede8;
            color: #7a6e66;
            font-size: 18px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background .15s;
        }

        .nav:hover {
            background: #e8dfd7;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
        }

        .lbl {
            text-align: center;
            color: #9C9790;
            font-family: Lato;
            font-size: 14px;
            font-style: normal;
            font-weight: 600;
            line-height: normal;
            padding-bottom: 10px;
        }

        .cell {
            position: relative;
            height: 42px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }

        .cell.empty {
            pointer-events: none;
        }

        /* range strip */
        .cell::before {
            content: '';
            position: absolute;
            top: 0px;
            bottom: 0px;
            left: 0;
            right: 0;
            background: transparent;
            z-index: 0;
            pointer-events: none;
        }

        .cell.in-range::before {
            background: rgba(255, 201, 122, 0.25);
        }

        .cell.rng-s::before {
            background: #fdf0e4;
            left: 50%;
        }

        .cell.rng-e::before {
            background: #fdf0e4;
            right: 50%;
        }

        .num {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            z-index: 1;
            pointer-events: none;
            transition: background .1s, color .1s;

            color: #3B3731;
            font-family: Lato;
            font-size: 14px;
            font-style: normal;
            font-weight: 600;
            line-height: normal;
        }

        .cell:not(.empty):hover .num {
            background: #f5e6d6;
        }

        .cell.sel-s .num,
        .cell.sel-e .num {
            background: #FFC97A !important;
            color: #fff;
        }

        .cell.empty .num {
            color: transparent;
        }

        .furs-addons-root .radio {
            width: 16px !important;
            height: 16px !important;
        }

        .furs-addons-root .radio::after {
            width: 10px !important;
            height: 10px !important;
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

                            <div class="booking-stat-card active-bookings">
                                <span class="booking-stat-value">2</span>
                                <span class="booking-stat-label">Upcoming</span>
                            </div>

                            <div class="booking-stat-card all-time-bookings">
                                <span class="booking-stat-value">20</span>
                                <span class="booking-stat-label">All time</span>
                            </div>

                            <div class="booking-stat-card total-spent">
                                <span class="booking-stat-value">£250</span>
                                <span class="booking-stat-label">Total Spent</span>
                            </div>

                        </div>

                        <!-- Filters -->
                        <div class="booking-filters mt-5">

                            <div class="tabs">
                                <button type="button" class="tab active" data-filter="all">All <span class="tab-count">8</span></button>
                                <button type="button" class="tab" data-filter="upcoming">Upcoming <span class="tab-count">2</span></button>
                                <button type="button" class="tab" data-filter="past">Completed <span class="tab-count">6</span></button>
                                <button type="button" class="tab" data-filter="cancelled">Cancelled <span class="tab-count">1</span></button>
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
                            <div class="chips-container"></div>

                            <div class="actions d-flex align-items-center gap-10">

                                <div class="calendar-wrapper">
                                    <button class="btn btn-filled light-color-font" id="toggleCalendar">
                                        <p class="hint" id="hint">Click a start date</p> <span class="btn-arrow"><svg xmlns="http://www.w3.org/2000/svg" width="13"
                                                height="7" viewBox="0 0 13 7" fill="none">
                                                <path d="M11.9102 0.5L6.15672 6.25344L0.499867 0.596581" stroke="white"
                                                    stroke-linecap="round" stroke-linejoin="round" />
                                            </svg></span>
                                    </button>
                                    <div class="card" id="calendarCard">
                                        <div class="header">
                                            <div class="pill" id="pLabel"></div>
                                            <div class="pill" id="cLabel"></div>
                                            <div class="arrows">
                                                <svg class="cursor" id="prev" xmlns="http://www.w3.org/2000/svg" width="34" height="34" viewBox="0 0 34 34" fill="none">
                                                    <g filter="url(#filter0_d_13_2914)">
                                                        <circle cx="17" cy="13" r="13" fill="white" />
                                                    </g>
                                                    <path d="M18.625 17.0625L14.5347 12.9722L18.5563 8.9505" stroke="#3B3731" stroke-linecap="round" stroke-linejoin="round" />
                                                    <defs>
                                                        <filter id="filter0_d_13_2914" x="0" y="0" width="34" height="34" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                                                            <feFlood flood-opacity="0" result="BackgroundImageFix" />
                                                            <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha" />
                                                            <feOffset dy="4" />
                                                            <feGaussianBlur stdDeviation="2" />
                                                            <feComposite in2="hardAlpha" operator="out" />
                                                            <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.03 0" />
                                                            <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_13_2914" />
                                                            <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_13_2914" result="shape" />
                                                        </filter>
                                                    </defs>
                                                </svg>
                                                <svg class="cursor" id="next" xmlns="http://www.w3.org/2000/svg" width="34" height="34" viewBox="0 0 34 34" fill="none">
                                                    <g filter="url(#filter0_d_13_2930)">
                                                        <circle cx="13" cy="13" r="13" transform="matrix(-1 0 0 1 30 0)" fill="white" />
                                                    </g>
                                                    <path d="M15.375 17.0625L19.4653 12.9722L15.4437 8.9505" stroke="#3B3731" stroke-linecap="round" stroke-linejoin="round" />
                                                    <defs>
                                                        <filter id="filter0_d_13_2930" x="0" y="0" width="34" height="34" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                                                            <feFlood flood-opacity="0" result="BackgroundImageFix" />
                                                            <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha" />
                                                            <feOffset dy="4" />
                                                            <feGaussianBlur stdDeviation="2" />
                                                            <feComposite in2="hardAlpha" operator="out" />
                                                            <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.03 0" />
                                                            <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_13_2930" />
                                                            <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_13_2930" result="shape" />
                                                        </filter>
                                                    </defs>
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="grid" id="grid">
                                            <div class="lbl">M</div>
                                            <div class="lbl">T</div>
                                            <div class="lbl">W</div>
                                            <div class="lbl">T</div>
                                            <div class="lbl">F</div>
                                            <div class="lbl">S</div>
                                            <div class="lbl">S</div>
                                        </div>
                                    </div>
                                </div>


                                <div class="fs-14-500-f-color sort-by">
                                    Sort
                                    <svg xmlns="http://www.w3.org/2000/svg" width="13" height="7" viewBox="0 0 13 7" fill="none">
                                        <path d="M11.9102 0.5L6.15672 6.25344L0.499867 0.596581" stroke="#FBAC83" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>

                                    <div class="sort-dropdown">
                                        <ul>
                                            <li>
                                                <label>
                                                    <span class="option-text">Recommended (default)</span>
                                                    <input type="radio" name="sort" value="recommended" checked>
                                                    <span class="check-circle"></span>
                                                </label>
                                            </li>
                                            <li>
                                                <label>
                                                    <span class="option-text">Distance</span>
                                                    <input type="radio" name="sort" value="distance">
                                                    <span class="check-circle"></span>
                                                </label>
                                            </li>
                                            <li>
                                                <label>
                                                    <span class="option-text">Lowest price</span>
                                                    <input type="radio" name="sort" value="lowest_price">
                                                    <span class="check-circle"></span>
                                                </label>
                                            </li>
                                            <li>
                                                <label>
                                                    <span class="option-text">Soonest available</span>
                                                    <input type="radio" name="sort" value="soonest_available">
                                                    <span class="check-circle"></span>
                                                </label>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12">

                        <div class="upcoming-section">

                            <div class="mb-section">
                                <h2 class="mb-section-label section-title">Upcoming</h2>

                                <!-- Confirmed: Groomer -->
                                <article class="mb-card mb-card--confirmed">
                                    <div class="mb-card__inner">
                                        <div class="mb-card__top">
                                            <div class="mb-card__top-left">
                                                <span class="mb-status"><span class="mb-status__dot"></span> Confirmed</span>
                                            </div>
                                            <div class="mb-card__ref">
                                                <span class="mb-card__ref-id">FG-10294</span>
                                                <a href="#" class="mb-card__pdf">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="13" height="15" viewBox="0 0 13 15" fill="none">
                                                        <path d="M3.07717 14.5H9.27418C9.95769 14.5 10.6132 14.2209 11.0965 13.7242C11.5798 13.2275 11.8514 12.5538 11.8514 11.8514V7.66649C11.8516 6.96411 11.5804 6.29039 11.0973 5.79351L6.70216 1.27568C6.46282 1.02973 6.1787 0.834645 5.86601 0.701554C5.55331 0.568463 5.21817 0.499975 4.87972 0.5H3.07717C2.39367 0.5 1.73815 0.779053 1.25484 1.27577C0.771523 1.77249 0.5 2.44618 0.5 3.14865V11.8514C0.5 12.5538 0.771523 13.2275 1.25484 13.7242C1.73815 14.2209 2.39367 14.5 3.07717 14.5Z" stroke="#3B3731" stroke-linecap="round" stroke-linejoin="round" />
                                                        <path d="M5.9458 0.772461V5.0557C5.9458 5.45711 6.10096 5.84208 6.37714 6.12592C6.65332 6.40976 7.0279 6.56922 7.41847 6.56922H11.5876" stroke="#3B3731" stroke-linecap="round" stroke-linejoin="round" />
                                                        <path d="M2.67822 10.9055V10.1488M2.67822 10.1488V8.63525H3.41456C3.60985 8.63525 3.79714 8.71498 3.93523 8.8569C4.07332 8.99882 4.15089 9.19131 4.15089 9.39201C4.15089 9.59272 4.07332 9.7852 3.93523 9.92712C3.79714 10.069 3.60985 10.1488 3.41456 10.1488H2.67822ZM8.56891 10.9055V9.95958M8.56891 9.95958V8.63525H9.67341M8.56891 9.95958H9.67341M5.62357 10.9055V8.63525H5.99173C6.28467 8.63525 6.5656 8.75485 6.77274 8.96773C6.97987 9.18061 7.09624 9.46933 7.09624 9.77039C7.09624 10.0714 6.97987 10.3602 6.77274 10.5731C6.5656 10.7859 6.28467 10.9055 5.99173 10.9055H5.62357Z" stroke="#3B3731" stroke-linecap="round" stroke-linejoin="round" />
                                                    </svg>
                                                    PDF
                                                </a>
                                            </div>
                                        </div>
                                        <div class="mb-card__provider">
                                            <div class="mb-card__provider-left">
                                                <div class="avatar-wrap">
                                                    <img class="avatar" src="<?= BASE_URL ?>assets/images/groomer-profile.png" alt="Sarah’s Grooming Studio">
                                                    <div class="badge-shield" title="Verified"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="33" viewBox="0 0 30 33" fill="none">
                                                            <ellipse cx="15.873" cy="16.5256" rx="9.3645" ry="8.81365" fill="white"></ellipse>
                                                            <path d="M15.44 0.185076C15.1841 0.0638192 14.9099 0 14.6235 0C14.3372 0 14.063 0.0638192 13.8071 0.185076L2.3337 5.28423C0.993208 5.87775 -0.00606541 7.26263 2.77146e-05 8.93469C0.0304934 15.2656 2.51649 26.8487 13.015 32.1138C14.0325 32.6244 15.2146 32.6244 16.2321 32.1138C26.7306 26.8487 29.2166 15.2656 29.247 8.93469C29.2531 7.26263 28.2539 5.87775 26.9134 5.28423L15.44 0.185076ZM8.82897 18.2651C9.12144 18.3416 9.43219 18.3799 9.74903 18.3799C11.8999 18.3799 13.6486 16.5483 13.6486 14.2955V10.2111H16.3418C17.0791 10.2111 17.7554 10.645 18.0844 11.3407L18.5231 12.2533H22.4227C22.9589 12.2533 23.3976 12.7128 23.3976 13.2744V15.3166C23.3976 18.1374 21.2163 20.4222 18.5231 20.4222H15.5984V23.6578C15.5984 24.1237 15.2389 24.5066 14.7881 24.5066C14.6784 24.5066 14.5687 24.4811 14.4712 24.4364L8.45729 21.7368C8.05514 21.5581 7.79923 21.1433 7.79923 20.6902C7.79923 20.5115 7.83579 20.3392 7.915 20.1796L8.82897 18.2651ZM8.77413 10.2111H11.6988V14.2955C11.6988 15.4251 10.8275 16.3377 9.74903 16.3377C8.67055 16.3377 7.79923 15.4251 7.79923 14.2955V11.2322C7.79923 10.6706 8.23794 10.2111 8.77413 10.2111ZM16.5733 13.2744C16.5733 13.0036 16.4706 12.7439 16.2878 12.5524C16.105 12.3609 15.857 12.2533 15.5984 12.2533C15.3399 12.2533 15.0919 12.3609 14.9091 12.5524C14.7262 12.7439 14.6235 13.0036 14.6235 13.2744C14.6235 13.5452 14.7262 13.8049 14.9091 13.9964C15.0919 14.1879 15.3399 14.2955 15.5984 14.2955C15.857 14.2955 16.105 14.1879 16.2878 13.9964C16.4706 13.8049 16.5733 13.5452 16.5733 13.2744Z" fill="#C9DDA0"></path>
                                                        </svg></div>
                                                </div>
                                                <div class="mb-card__provider-meta">
                                                    <div class="mb-card__title-row">
                                                        <h3 class="mb-card__studio">Sarah’s Grooming Studio</h3>
                                                        <span class="mb-tag mb-tag--orange">Home Visits</span>
                                                    </div>
                                                    <p class="mb-card__host">Sarah W.</p>
                                                </div>
                                            </div>
                                            <div class="mb-card__price-block">
                                                <p class="mb-card__date">18 Dec 2025</p>
                                                <p class="mb-card__price">£48.00</p>
                                            </div>
                                        </div>
                                        <div class="mb-card__summary">
                                            <div class="mb-card__meta">
                                                <div class="mb-meta-item"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="17" viewBox="0 0 16 17" fill="none">
                                                        <path d="M4.94591 11.5544C6.23114 12.8397 9.35699 11.798 11.9274 9.22713C14.4983 6.65667 15.54 3.53082 14.2548 2.24559M8.72754 1.37259L9.30927 1.95473M6.6915 3.40904L7.27322 3.99077M4.9455 5.73636L5.52722 6.31809M4.36377 8.6454L4.9455 9.22713M11.9274 0.5L12.5092 1.08173M11.3457 3.99118L12.5092 5.15463M9.30968 6.02763L10.4731 7.19109M6.98236 7.77281L8.14581 8.93627" stroke="#3B3731" stroke-linecap="round" stroke-linejoin="round" />
                                                        <path d="M4.94547 13.2998C5.42747 12.8178 5.42747 12.0364 4.94548 11.5544C4.46348 11.0724 3.68202 11.0724 3.20003 11.5544L0.872775 13.8816C0.390784 14.3636 0.390784 15.1451 0.872775 15.6271C1.35477 16.1091 2.13623 16.1091 2.61822 15.6271L4.94547 13.2998Z" stroke="#3B3731" stroke-linecap="round" stroke-linejoin="round" />
                                                    </svg> Bath &amp; Brush</div>
                                                <div class="mb-meta-item"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 19 17" fill="none">
                                                        <path d="M0.5 8.29554C0.5 5.20139 0.5 3.6539 1.50457 2.69308C2.50914 1.73227 4.12486 1.73145 7.35714 1.73145H10.7857C14.018 1.73145 15.6346 1.73145 16.6383 2.69308C17.642 3.65472 17.6429 5.20139 17.6429 8.29554V9.93656C17.6429 13.0307 17.6429 14.5782 16.6383 15.539C15.6337 16.4998 14.018 16.5007 10.7857 16.5007H7.35714C4.12486 16.5007 2.50829 16.5007 1.50457 15.539C0.500857 14.5774 0.5 13.0307 0.5 9.93656V8.29554Z" stroke="#3B3731" />
                                                        <path d="M4.78585 1.73077V0.5M13.3573 1.73077V0.5M0.928711 5.83333H17.2144" stroke="#3B3731" stroke-linecap="round" />
                                                    </svg> Wed, 18 Dec 2025</div>
                                                <div class="mb-meta-item"><svg width="15" height="15" viewBox="0 0 16 16" fill="none">
                                                        <circle cx="8" cy="8" r="6" stroke="#3B3731" stroke-width="1.5" />
                                                        <path d="M8 4.5V8L10.5 10" stroke="#3B3731" stroke-width="1.5" stroke-linecap="round" />
                                                    </svg> 14:30 - 15:30</div>
                                                <div class="mb-meta-item"><svg xmlns="http://www.w3.org/2000/svg" width="12" height="16" viewBox="0 0 12 16" fill="none">
                                                        <path d="M6 0.5C7.4694 0.5 8.87214 1.04525 9.90137 2.00586C10.9293 2.96529 11.4999 4.25871 11.5 5.59961C11.5 7.10011 10.6408 8.95946 9.51855 10.7236C8.41048 12.4655 7.10434 14.0263 6.32227 14.9082C6.14625 15.1067 5.85375 15.1067 5.67773 14.9082C4.89566 14.0263 3.58952 12.4655 2.48145 10.7236C1.35919 8.95946 0.5 7.10011 0.5 5.59961C0.500111 4.25871 1.07068 2.96529 2.09863 2.00586C3.12786 1.04525 4.53061 0.5 6 0.5ZM6 3.09961C5.30978 3.09961 4.64141 3.35564 4.14355 3.82031C3.64466 4.28597 3.35753 4.92517 3.35742 5.59961C3.35742 6.27422 3.64453 6.91413 4.14355 7.37988C4.64141 7.84453 5.30979 8.09961 6 8.09961C6.69022 8.09961 7.35859 7.84453 7.85645 7.37988C8.35534 6.91413 8.64247 6.27422 8.64258 5.59961C8.64258 4.92517 8.35534 4.28597 7.85645 3.82031C7.35859 3.35564 6.69022 3.09961 6 3.09961Z" stroke="#3B3731" />
                                                    </svg> At your home</div>
                                            </div>
                                            <div class="mb-pet">
                                                <div class="mb-pet__avatars">
                                                    <img src="<?= BASE_URL ?>assets/images/pet_details_1.png" alt="Pet">
                                                </div>
                                                <span class="mb-pet__label">Bella · Rabbit <span class="mb-pet__label-sub">(Mini Lop)</span></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-card__footer">
                                        <div class="mb-card__footer-left">
                                            <button type="button" class="mb-btn" data-modal-open="view_booking_groom_modal"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="14" viewBox="0 0 18 14" fill="none">
                                                    <path d="M1.5 7C1.5 7 4.1 1.5 9 1.5C13.9 1.5 16.5 7 16.5 7C16.5 7 13.9 12.5 9 12.5C4.1 12.5 1.5 7 1.5 7Z" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round" />
                                                    <circle cx="9" cy="7" r="2.25" stroke="currentColor" stroke-width="1.4" />
                                                </svg> View details</button>
                                            <button type="button" class="mb-btn" data-modal-open="change_groomer_booking_modal"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                                    <path d="M2.23096 15.4951V12.6123H5.11378" stroke="#3B3731" stroke-linecap="round" stroke-linejoin="round" />
                                                    <path d="M15.3656 6.62252C15.6715 8.25452 15.4269 9.94189 14.6702 11.4199C13.9135 12.8978 12.6875 14.0827 11.1846 14.7887C9.68175 15.4946 7.98704 15.6817 6.3664 15.3204C4.74575 14.9592 3.2909 14.0701 2.23013 12.7927M0.628303 9.37748C0.322432 7.74548 0.567036 6.05811 1.32373 4.58014C2.08043 3.10218 3.3064 1.91725 4.80927 1.2113C6.31214 0.505355 8.00686 0.318331 9.6275 0.679579C11.2481 1.04083 12.703 1.9299 13.7638 3.2073" stroke="#3B3731" stroke-linecap="round" stroke-linejoin="round" />
                                                    <path d="M13.7624 0.504883V3.38771H10.8796M4.61412 8.38848C4.2061 8.31757 4.2061 7.73171 4.61412 7.6608C5.3363 7.53448 6.00461 7.19626 6.53409 6.68914C7.06356 6.18203 7.43027 5.52892 7.58761 4.81285L7.61202 4.70009C7.70037 4.29673 8.27461 4.2944 8.36644 4.6966L8.39666 4.82796C8.55903 5.54126 8.92875 6.19059 9.4593 6.69425C9.98985 7.19791 10.6575 7.53339 11.3783 7.65848C11.7886 7.72938 11.7886 8.31874 11.3783 8.39081C10.6577 8.51581 9.99011 8.85111 9.45958 9.35455C8.92904 9.85799 8.55923 10.5071 8.39666 11.2202L8.36644 11.3504C8.27461 11.7526 7.70037 11.7502 7.61202 11.3469L7.58877 11.2353C7.43128 10.5189 7.06422 9.86555 6.5343 9.3584C6.00438 8.85125 5.33556 8.51322 4.61295 8.38732" stroke="#3B3731" stroke-linecap="round" stroke-linejoin="round" />
                                                </svg> Change booking</button>
                                            <a href="<?= BASE_URL ?>messages_notification/messages.php" class="mb-btn-icon" title="Message groomer"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="15" viewBox="0 0 16 15" fill="none">
                                                    <path d="M8 0.5C12.2044 0.5 15.5 3.48321 15.5 7.03223C15.5 10.4703 12.4072 13.3772 8.3916 13.5557L8 13.5645H7.99902C7.251 13.5661 6.50584 13.4687 5.7832 13.2744L5.59766 13.2246L5.42676 13.3115C5.00713 13.5247 4.13103 13.9084 2.72363 14.2393L2.08691 14.377C1.99742 14.3948 1.9071 14.4082 1.81738 14.4248C1.85085 14.3352 1.88498 14.2458 1.91602 14.1553L1.91895 14.1455C2.17667 13.3938 2.38924 12.5229 2.46777 11.7012L2.49023 11.4678L2.3252 11.3008C1.18119 10.1487 0.500003 8.65476 0.5 7.03223C0.5 3.48321 3.79561 0.5 8 0.5Z" stroke="#3B3731" />
                                                </svg></a>
                                        </div>
                                        <button type="button" class="mb-cancel-link" data-modal-open="cancel_groomer_booking_modal">Cancel</button>
                                    </div>
                                </article>

                                <!-- Confirmed: Space -->
                                <article class="mb-card mb-card--confirmed">
                                    <div class="mb-card__inner">
                                        <div class="mb-card__top">
                                            <div class="mb-card__top-left">
                                                <span class="mb-status"><span class="mb-status__dot"></span> Confirmed</span>
                                            </div>
                                            <div class="mb-card__ref">
                                                <span class="mb-card__ref-id">FG-10294</span>
                                                <a href="#" class="mb-card__pdf"><svg xmlns="http://www.w3.org/2000/svg" width="12" height="14" viewBox="0 0 13 15" fill="none">
                                                        <path d="M3.07717 14.5H9.27418C9.95769 14.5 10.6132 14.2209 11.0965 13.7242C11.5798 13.2275 11.8514 12.5538 11.8514 11.8514V7.66649C11.8516 6.96411 11.5804 6.29039 11.0973 5.79351L6.70216 1.27568C6.46282 1.02973 6.1787 0.834645 5.86601 0.701554C5.55331 0.568463 5.21817 0.499975 4.87972 0.5H3.07717C2.39367 0.5 1.73815 0.779053 1.25484 1.27577C0.771523 1.77249 0.5 2.44618 0.5 3.14865V11.8514C0.5 12.5538 0.771523 13.2275 1.25484 13.7242C1.73815 14.2209 2.39367 14.5 3.07717 14.5Z" stroke="#3B3731" stroke-linecap="round" stroke-linejoin="round" />
                                                        <path d="M5.9458 0.772461V5.0557C5.9458 5.45711 6.10096 5.84208 6.37714 6.12592C6.65332 6.40976 7.0279 6.56922 7.41847 6.56922H11.5876" stroke="#3B3731" stroke-linecap="round" stroke-linejoin="round" />
                                                    </svg> PDF</a>
                                            </div>
                                        </div>
                                        <div class="mb-card__provider">
                                            <div class="mb-card__provider-left">
                                                <div class="avatar-wrap">
                                                    <img class="avatar" src="<?= BASE_URL ?>assets/images/space_card3.png" alt="Furs &amp; Co. Studio">
                                                    <div class="badge-shield" title="Verified"><svg xmlns="http://www.w3.org/2000/svg" width="29" height="30" viewBox="0 0 29 30" fill="none">
                                                            <path d="M14.9293 0.170856C14.6819 0.058916 14.4168 0 14.1399 0C13.8629 0 13.5978 0.058916 13.3504 0.170856L2.25651 4.87824C0.960357 5.42616 -0.0058648 6.70463 2.67979e-05 8.24823C0.0294848 14.0927 2.43326 24.7859 12.5845 29.6465C13.5684 30.1178 14.7113 30.1178 15.6952 29.6465C25.8465 24.7859 28.2502 14.0927 28.2797 8.24823C28.2856 6.70463 27.3194 5.42616 26.0232 4.87824L14.9293 0.170856Z" fill="#CBDCE8" />
                                                            <path d="M21.818 8.18213L15.7574 14.6215M13.065 14.3071C11.1862 15.0283 9.68391 14.9049 8.18164 14.3094C8.56043 19.1905 10.8362 21.067 13.8703 21.8185C13.8703 21.8185 16.1559 20.2018 16.4854 16.3693C16.521 15.9541 16.5385 15.7473 16.4529 15.5132C16.3665 15.2791 16.1968 15.1117 15.8582 14.7761C15.3006 14.2246 15.0225 13.9488 14.6915 13.8791C14.3604 13.8109 13.9286 13.9761 13.065 14.3071Z" stroke="white" stroke-linecap="round" stroke-linejoin="round" />
                                                        </svg></div>
                                                </div>
                                                <div class="mb-card__provider-meta">
                                                    <div class="mb-card__title-row">
                                                        <h3 class="mb-card__studio">Furs &amp; Co. Studio</h3>
                                                        <span class="mb-tag mb-tag--coral">Garden / Shed</span>
                                                    </div>
                                                    <p class="mb-card__host">Dev É.</p>
                                                </div>
                                            </div>
                                            <div class="mb-card__price-block">
                                                <p class="mb-card__date">18 Dec 2025</p>
                                                <p class="mb-card__price">£158.00</p>
                                            </div>
                                        </div>
                                        <div class="mb-card__summary">
                                            <div class="mb-card__meta">
                                                <div class="mb-meta-item"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="17" viewBox="0 0 16 17" fill="none">
                                                        <path d="M4.94591 11.5544C6.23114 12.8397 9.35699 11.798 11.9274 9.22713C14.4983 6.65667 15.54 3.53082 14.2548 2.24559M8.72754 1.37259L9.30927 1.95473M6.6915 3.40904L7.27322 3.99077M4.9455 5.73636L5.52722 6.31809M4.36377 8.6454L4.9455 9.22713M11.9274 0.5L12.5092 1.08173M11.3457 3.99118L12.5092 5.15463M9.30968 6.02763L10.4731 7.19109M6.98236 7.77281L8.14581 8.93627" stroke="#3B3731" stroke-linecap="round" stroke-linejoin="round" />
                                                        <path d="M4.94547 13.2998C5.42747 12.8178 5.42747 12.0364 4.94548 11.5544C4.46348 11.0724 3.68202 11.0724 3.20003 11.5544L0.872775 13.8816C0.390784 14.3636 0.390784 15.1451 0.872775 15.6271C1.35477 16.1091 2.13623 16.1091 2.61822 15.6271L4.94547 13.2998Z" stroke="#3B3731" stroke-linecap="round" stroke-linejoin="round" />
                                                    </svg> Half-Day</div>
                                                <div class="mb-meta-item"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 19 17" fill="none">
                                                        <path d="M0.5 8.29554C0.5 5.20139 0.5 3.6539 1.50457 2.69308C2.50914 1.73227 4.12486 1.73145 7.35714 1.73145H10.7857C14.018 1.73145 15.6346 1.73145 16.6383 2.69308C17.642 3.65472 17.6429 5.20139 17.6429 8.29554V9.93656C17.6429 13.0307 17.6429 14.5782 16.6383 15.539C15.6337 16.4998 14.018 16.5007 10.7857 16.5007H7.35714C4.12486 16.5007 2.50829 16.5007 1.50457 15.539C0.500857 14.5774 0.5 13.0307 0.5 9.93656V8.29554Z" stroke="#3B3731" />
                                                        <path d="M4.78585 1.73077V0.5M13.3573 1.73077V0.5M0.928711 5.83333H17.2144" stroke="#3B3731" stroke-linecap="round" />
                                                    </svg> Wed, 18 Dec 2025</div>
                                                <div class="mb-meta-item"><svg width="15" height="15" viewBox="0 0 16 16" fill="none">
                                                        <circle cx="8" cy="8" r="6" stroke="#3B3731" stroke-width="1.5" />
                                                        <path d="M8 4.5V8L10.5 10" stroke="#3B3731" stroke-width="1.5" stroke-linecap="round" />
                                                    </svg> 14:30 - 18:30</div>
                                                <div class="mb-meta-item"><svg xmlns="http://www.w3.org/2000/svg" width="12" height="16" viewBox="0 0 12 16" fill="none">
                                                        <path d="M6 0.5C7.4694 0.5 8.87214 1.04525 9.90137 2.00586C10.9293 2.96529 11.4999 4.25871 11.5 5.59961C11.5 7.10011 10.6408 8.95946 9.51855 10.7236C8.41048 12.4655 7.10434 14.0263 6.32227 14.9082C6.14625 15.1067 5.85375 15.1067 5.67773 14.9082C4.89566 14.0263 3.58952 12.4655 2.48145 10.7236C1.35919 8.95946 0.5 7.10011 0.5 5.59961C0.500111 4.25871 1.07068 2.96529 2.09863 2.00586C3.12786 1.04525 4.53061 0.5 6 0.5ZM6 3.09961C5.30978 3.09961 4.64141 3.35564 4.14355 3.82031C3.64466 4.28597 3.35753 4.92517 3.35742 5.59961C3.35742 6.27422 3.64453 6.91413 4.14355 7.37988C4.64141 7.84453 5.30979 8.09961 6 8.09961C6.69022 8.09961 7.35859 7.84453 7.85645 7.37988C8.35534 6.91413 8.64247 6.27422 8.64258 5.59961C8.64258 4.92517 8.35534 4.28597 7.85645 3.82031C7.35859 3.35564 6.69022 3.09961 6 3.09961Z" stroke="#3B3731" />
                                                    </svg> Victoria Embankment</div>
                                            </div>
                                            <div class="mb-pet">
                                                <div class="mb-pet__avatars">
                                                    <img src="<?= BASE_URL ?>assets/images/pet_details_1.png" alt="Pet">
                                                    <img src="<?= BASE_URL ?>assets/images/pet_details_2.png" alt="Pet">
                                                </div>
                                                <span class="mb-pet__label">Bella +1</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-card__footer">
                                        <div class="mb-card__footer-left">
                                            <button type="button" class="mb-btn" data-modal-open="view_booking_space_modal"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="14" viewBox="0 0 18 14" fill="none">
                                                    <path d="M1.5 7C1.5 7 4.1 1.5 9 1.5C13.9 1.5 16.5 7 16.5 7C16.5 7 13.9 12.5 9 12.5C4.1 12.5 1.5 7 1.5 7Z" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round" />
                                                    <circle cx="9" cy="7" r="2.25" stroke="currentColor" stroke-width="1.4" />
                                                </svg> View details</button>
                                            <button type="button" class="mb-btn" data-modal-open="change_space_booking_modal"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                                    <path d="M2.23096 15.4951V12.6123H5.11378" stroke="#3B3731" stroke-linecap="round" stroke-linejoin="round" />
                                                    <path d="M15.3656 6.62252C15.6715 8.25452 15.4269 9.94189 14.6702 11.4199C13.9135 12.8978 12.6875 14.0827 11.1846 14.7887C9.68175 15.4946 7.98704 15.6817 6.3664 15.3204C4.74575 14.9592 3.2909 14.0701 2.23013 12.7927M0.628303 9.37748C0.322432 7.74548 0.567036 6.05811 1.32373 4.58014C2.08043 3.10218 3.3064 1.91725 4.80927 1.2113C6.31214 0.505355 8.00686 0.318331 9.6275 0.679579C11.2481 1.04083 12.703 1.9299 13.7638 3.2073" stroke="#3B3731" stroke-linecap="round" stroke-linejoin="round" />
                                                    <path d="M13.7624 0.504883V3.38771H10.8796M4.61412 8.38848C4.2061 8.31757 4.2061 7.73171 4.61412 7.6608C5.3363 7.53448 6.00461 7.19626 6.53409 6.68914C7.06356 6.18203 7.43027 5.52892 7.58761 4.81285L7.61202 4.70009C7.70037 4.29673 8.27461 4.2944 8.36644 4.6966L8.39666 4.82796C8.55903 5.54126 8.92875 6.19059 9.4593 6.69425C9.98985 7.19791 10.6575 7.53339 11.3783 7.65848C11.7886 7.72938 11.7886 8.31874 11.3783 8.39081C10.6577 8.51581 9.99011 8.85111 9.45958 9.35455C8.92904 9.85799 8.55923 10.5071 8.39666 11.2202L8.36644 11.3504C8.27461 11.7526 7.70037 11.7502 7.61202 11.3469L7.58877 11.2353C7.43128 10.5189 7.06422 9.86555 6.5343 9.3584C6.00438 8.85125 5.33556 8.51322 4.61295 8.38732" stroke="#3B3731" stroke-linecap="round" stroke-linejoin="round" />
                                                </svg> Change booking</button>
                                            <a href="<?= BASE_URL ?>messages_notification/messages.php" class="mb-btn-icon" title="Message host"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                                    <path d="M2.2 7.4C2.2 4.9 4.4 2.8 7.1 2.8H8.9C11.6 2.8 13.8 4.9 13.8 7.4C13.8 9.9 11.6 12 8.9 12H7.8L5.2 13.7V12C3.4 11.4 2.2 9.5 2.2 7.4Z" stroke="currentColor" stroke-width="1.3" stroke-linejoin="round" />
                                                </svg></a>
                                        </div>
                                        <button type="button" class="mb-cancel-link" data-modal-open="cancel_space_booking_modal">Cancel</button>
                                    </div>
                                </article>
                            </div>

                            <!-- Up Coming Groomer Booking Modal  -->

                            <div class="modal" id="view_booking_groom_modal">
                                <div class="modal-content size bd-modal-content">
                                    <div class="bd-modal">
                                        <button class="bd-close" type="button" data-modal-close aria-label="Close">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 36 36" fill="none">
                                                <circle cx="18" cy="18" r="17.5" stroke="#3B3731" />
                                                <path d="M12.8 24.0008L24 12.8008M12.8 12.8008L24 24.0008" stroke="#3B3731" stroke-width="1.5" stroke-linecap="round" />
                                            </svg>
                                        </button>

                                        <div class="bd-header">
                                            <h1>Booking Details</h1>
                                            <p>Your upcoming booking</p>
                                        </div>
                                        <hr class="bd-divider">

                                        <div class="bd-status-bar">
                                            <span class="bd-status-badge">
                                                <span class="bd-status-dot"></span>
                                                Confirmed
                                            </span>
                                            <div class="bd-ref-actions">
                                                <span class="bd-ref-id">FG-10294</span>
                                                <a href="#" class="bd-pdf-link">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="13" height="15" viewBox="0 0 13 15" fill="none">
                                                        <path d="M3.07717 14.5H9.27418C9.95769 14.5 10.6132 14.2209 11.0965 13.7242C11.5798 13.2275 11.8514 12.5538 11.8514 11.8514V7.66649C11.8516 6.96411 11.5804 6.29039 11.0973 5.79351L6.70216 1.27568C6.46282 1.02973 6.1787 0.834645 5.86601 0.701554C5.55331 0.568463 5.21817 0.499975 4.87972 0.5H3.07717C2.39367 0.5 1.73815 0.779053 1.25484 1.27577C0.771523 1.77249 0.5 2.44618 0.5 3.14865V11.8514C0.5 12.5538 0.771523 13.2275 1.25484 13.7242C1.73815 14.2209 2.39367 14.5 3.07717 14.5Z" stroke="#3B3731" stroke-linecap="round" stroke-linejoin="round" />
                                                        <path d="M5.9458 0.772461V5.0557C5.9458 5.45711 6.10096 5.84208 6.37714 6.12592C6.65332 6.40976 7.0279 6.56922 7.41847 6.56922H11.5876" stroke="#3B3731" stroke-linecap="round" stroke-linejoin="round" />
                                                        <path d="M2.67822 10.9055V10.1488M2.67822 10.1488V8.63525H3.41456C3.60985 8.63525 3.79714 8.71498 3.93523 8.8569C4.07332 8.99882 4.15089 9.19131 4.15089 9.39201C4.15089 9.59272 4.07332 9.7852 3.93523 9.92712C3.79714 10.069 3.60985 10.1488 3.41456 10.1488H2.67822ZM8.56891 10.9055V9.95958M8.56891 9.95958V8.63525H9.67341M8.56891 9.95958H9.67341M5.62357 10.9055V8.63525H5.99173C6.28467 8.63525 6.5656 8.75485 6.77274 8.96773C6.97987 9.18061 7.09624 9.46933 7.09624 9.77039C7.09624 10.0714 6.97987 10.3602 6.77274 10.5731C6.5656 10.7859 6.28467 10.9055 5.99173 10.9055H5.62357Z" stroke="#3B3731" stroke-linecap="round" stroke-linejoin="round" />
                                                    </svg>
                                                    Download PDF
                                                </a>
                                            </div>
                                        </div>

                                        <div class="bd-groomer-card">
                                            <div class="bd-groomer-left">
                                                <div class="bd-groomer-avatar-wrap">
                                                    <img src="<?= BASE_URL ?>/assets/images/card1.png" alt="Sarah's Grooming Studio" class="bd-groomer-avatar">
                                                    <div class="bd-verified-badge" title="Verified">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="22" viewBox="0 0 30 33" fill="none">
                                                            <ellipse cx="15.873" cy="16.5256" rx="9.3645" ry="8.81365" fill="white"></ellipse>
                                                            <path d="M15.44 0.185076C15.1841 0.0638192 14.9099 0 14.6235 0C14.3372 0 14.063 0.0638192 13.8071 0.185076L2.3337 5.28423C0.993208 5.87775 -0.00606541 7.26263 2.77146e-05 8.93469C0.0304934 15.2656 2.51649 26.8487 13.015 32.1138C14.0325 32.6244 15.2146 32.6244 16.2321 32.1138C26.7306 26.8487 29.2166 15.2656 29.247 8.93469C29.2531 7.26263 28.2539 5.87775 26.9134 5.28423L15.44 0.185076ZM8.82897 18.2651C9.12144 18.3416 9.43219 18.3799 9.74903 18.3799C11.8999 18.3799 13.6486 16.5483 13.6486 14.2955V10.2111H16.3418C17.0791 10.2111 17.7554 10.645 18.0844 11.3407L18.5231 12.2533H22.4227C22.9589 12.2533 23.3976 12.7128 23.3976 13.2744V15.3166C23.3976 18.1374 21.2163 20.4222 18.5231 20.4222H15.5984V23.6578C15.5984 24.1237 15.2389 24.5066 14.7881 24.5066C14.6784 24.5066 14.5687 24.4811 14.4712 24.4364L8.45729 21.7368C8.05514 21.5581 7.79923 21.1433 7.79923 20.6902C7.79923 20.5115 7.83579 20.3392 7.915 20.1796L8.82897 18.2651ZM8.77413 10.2111H11.6988V14.2955C11.6988 15.4251 10.8275 16.3377 9.74903 16.3377C8.67055 16.3377 7.79923 15.4251 7.79923 14.2955V11.2322C7.79923 10.6706 8.23794 10.2111 8.77413 10.2111ZM16.5733 13.2744C16.5733 13.0036 16.4706 12.7439 16.2878 12.5524C16.105 12.3609 15.857 12.2533 15.5984 12.2533C15.3399 12.2533 15.0919 12.3609 14.9091 12.5524C14.7262 12.7439 14.6235 13.0036 14.6235 13.2744C14.6235 13.5452 14.7262 13.8049 14.9091 13.9964C15.0919 14.1879 15.3399 14.2955 15.5984 14.2955C15.857 14.2955 16.105 14.1879 16.2878 13.9964C16.4706 13.8049 16.5733 13.5452 16.5733 13.2744Z" fill="#C9DDA0"></path>
                                                        </svg>
                                                    </div>
                                                </div>
                                                <div class="bd-groomer-identity">
                                                    <div class="bd-groomer-title-row">
                                                        <h3>Sarah's Grooming Studio</h3>
                                                        <span class="bd-service-badge">Home Visits</span>
                                                    </div>
                                                    <p class="bd-groomer-name">Sarah W.</p>
                                                </div>
                                            </div>
                                            <div class="bd-groomer-right">
                                                <div class="bd-groomer-badges">
                                                    <span class="bd-badge bd-badge-popular">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="10" height="9" viewBox="0 0 10 9" fill="none">
                                                            <path d="M2 8.99999C1.85833 8.99999 1.73967 8.95199 1.644 8.85599C1.54833 8.75999 1.50033 8.64133 1.5 8.49999C1.49967 8.35866 1.54767 8.23999 1.644 8.14399C1.74033 8.04799 1.859 7.99999 2 7.99999H8C8.14166 7.99999 8.2605 8.04799 8.3565 8.14399C8.4525 8.23999 8.50033 8.35866 8.5 8.49999C8.49966 8.64133 8.45166 8.76016 8.356 8.85649C8.26033 8.95283 8.14166 9.00066 8 8.99999H2ZM2.35 7.24999C2.10833 7.24999 1.89383 7.17083 1.7065 7.0125C1.51917 6.85416 1.4045 6.65416 1.3625 6.4125L0.862501 3.2375C0.845834 3.2375 0.827167 3.23967 0.806501 3.244C0.785834 3.24833 0.767001 3.25033 0.750001 3.25C0.541667 3.25 0.364668 3.17717 0.219001 3.0315C0.0733344 2.88583 0.000334469 2.70867 1.13636e-06 2.5C-0.000332197 2.29133 0.0726677 2.11433 0.219001 1.969C0.365334 1.82367 0.542334 1.75067 0.750001 1.75C0.957667 1.74933 1.13483 1.82233 1.2815 1.969C1.42817 2.11567 1.501 2.29267 1.5 2.5C1.5 2.55833 1.49367 2.6125 1.481 2.6625C1.46833 2.7125 1.45383 2.75833 1.4375 2.8L3 3.5L4.5625 1.3625C4.47083 1.29583 4.39583 1.20833 4.3375 1.1C4.27917 0.991667 4.25 0.875 4.25 0.75C4.25 0.541667 4.323 0.364501 4.469 0.218501C4.615 0.0725011 4.792 -0.000332194 5 1.13895e-06C5.208 0.000334472 5.38516 0.0733344 5.5315 0.219001C5.67783 0.364667 5.75066 0.541667 5.75 0.75C5.75 0.875 5.72083 0.991667 5.6625 1.1C5.60416 1.20833 5.52916 1.29583 5.4375 1.3625L7 3.5L8.5625 2.8C8.54583 2.75833 8.53116 2.7125 8.5185 2.6625C8.50583 2.6125 8.49966 2.55833 8.5 2.5C8.5 2.29167 8.573 2.1145 8.719 1.9685C8.865 1.8225 9.042 1.74967 9.25 1.75C9.458 1.75033 9.63516 1.82333 9.7815 1.969C9.92783 2.11467 10.0007 2.29167 10 2.5C9.99933 2.70833 9.92649 2.8855 9.7815 3.0315C9.6365 3.1775 9.45933 3.25033 9.25 3.25C9.23333 3.25 9.21466 3.248 9.194 3.244C9.17333 3.24 9.1545 3.23783 9.1375 3.2375L8.6375 6.4125C8.59583 6.65416 8.48133 6.85416 8.294 7.0125C8.10666 7.17083 7.892 7.24999 7.65 7.24999H2.35ZM2.35 6.25H7.65L7.975 4.1625L7.4 4.4125C7.18333 4.50416 6.9625 4.52083 6.7375 4.4625C6.5125 4.40416 6.32916 4.27916 6.1875 4.0875L5 2.45L3.8125 4.0875C3.67083 4.27916 3.4875 4.40416 3.2625 4.4625C3.0375 4.52083 2.81667 4.50416 2.6 4.4125L2.025 4.1625L2.35 6.25Z" fill="white" />
                                                        </svg>
                                                        Popular
                                                    </span>
                                                    <span class="bd-badge bd-badge-rated">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="9" height="11" viewBox="0 0 9 11" fill="none">
                                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M6.41322 7.89398C6.44215 7.34453 6.31579 6.79804 6.0486 6.31706C5.78142 5.83608 5.3842 5.44005 4.90243 5.1743C4.81687 5.12481 4.71545 5.11047 4.61952 5.1343C4.5236 5.15813 4.44068 5.21827 4.38824 5.30205L3.77553 6.28276L3.26579 5.66624C3.23778 5.63245 3.20308 5.60482 3.16387 5.5851C3.12466 5.56538 3.08178 5.554 3.03795 5.55167C2.99413 5.54934 2.95029 5.55612 2.90921 5.57157C2.86813 5.58702 2.83069 5.61082 2.79926 5.64146C2.49919 5.93182 2.2648 6.2831 2.11186 6.67164C1.95892 7.06019 1.89098 7.47698 1.91262 7.89398C1.91262 8.49072 2.14967 9.06301 2.57162 9.48496C2.99358 9.90692 3.56587 10.144 4.1626 10.144C4.75934 10.144 5.33163 9.90692 5.75358 9.48496C6.17554 9.06301 6.41259 8.49072 6.41259 7.89398M3.01028 6.35586L2.97087 6.40798C2.67197 6.82551 2.52221 7.33145 2.54566 7.84441L2.54757 7.88191C2.54757 8.31007 2.71766 8.7207 3.02042 9.02346C3.32317 9.32621 3.7338 9.4963 4.16197 9.4963C4.59013 9.4963 5.00076 9.32621 5.30352 9.02346C5.60628 8.7207 5.77636 8.31007 5.77636 7.88191L5.77827 7.84504C5.78272 7.80373 5.88187 6.6673 4.84205 5.89442L4.79056 5.85692L4.12701 6.91835C4.09497 6.96954 4.05123 7.01239 3.99939 7.04337C3.94755 7.07435 3.8891 7.09258 3.82884 7.09655C3.76858 7.10052 3.70823 7.09013 3.65278 7.06622C3.59732 7.04231 3.54834 7.00557 3.50985 6.95903L3.01028 6.35586Z" fill="#FEFEFE" />
                                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M3.79701 0.30821C3.81025 0.23997 3.84191 0.176658 3.88858 0.125138C3.93524 0.0736173 3.99512 0.0358558 4.06172 0.0159479C4.12832 -0.00396001 4.1991 -0.00525449 4.26638 0.0122049C4.33367 0.0296642 4.39489 0.0652111 4.4434 0.114991C4.56671 0.240837 4.80378 0.489988 5.04467 0.777274C5.28111 1.05884 5.53916 1.39761 5.68788 1.69951C5.8328 1.99443 5.98661 2.37578 6.10801 2.69421L6.67305 1.75354C6.70456 1.701 6.74826 1.65683 6.80046 1.62476C6.85265 1.59269 6.91181 1.57367 6.97292 1.56931C7.03402 1.56494 7.09528 1.57536 7.1515 1.59969C7.20773 1.62401 7.25727 1.66152 7.29592 1.70905C8.09867 2.70057 8.49846 3.76263 8.6974 4.57365C8.79718 4.97979 8.8474 5.32491 8.87282 5.57025C8.88576 5.69278 8.89424 5.81574 8.89824 5.93889V5.97131C8.89824 8.4482 6.93364 10.4649 4.44785 10.4649C1.96206 10.4649 0 8.44756 0 5.97004C0 5.28805 0.322244 3.68192 1.27563 2.36498C1.31266 2.31422 1.36166 2.27341 1.41826 2.24615C1.47487 2.2189 1.53734 2.20605 1.60011 2.20876C1.66287 2.21146 1.724 2.22963 1.77806 2.26166C1.83211 2.29368 1.87741 2.33856 1.90994 2.39231L2.55507 3.46709C2.75083 3.16073 3.01269 2.73044 3.21163 2.3332C3.49765 1.76117 3.72455 0.682572 3.79701 0.308845M4.3201 0.912655C4.20506 1.42113 4.01501 2.14697 3.77985 2.61858C3.46714 3.24336 3.0165 3.9298 2.86142 4.16051C2.82554 4.21345 2.77693 4.25651 2.72005 4.28574C2.66317 4.31497 2.59986 4.32943 2.53593 4.32778C2.472 4.32614 2.40952 4.30844 2.35422 4.27632C2.29892 4.24421 2.25258 4.1987 2.21948 4.14399L1.57118 3.06476C0.87457 4.19166 0.635589 5.45839 0.635589 5.97131C0.635589 8.10561 2.32244 9.82806 4.44785 9.82806C6.57326 9.82806 8.26265 8.10561 8.26265 5.97131V5.95351L8.26011 5.88995C8.25568 5.80484 8.24911 5.71986 8.24041 5.63508C8.20712 5.3287 8.15362 5.02487 8.08024 4.72555C7.87826 3.89157 7.52027 3.10334 7.02516 2.40248L6.38068 3.47535C6.34338 3.53732 6.28925 3.58743 6.22459 3.61985C6.15993 3.65227 6.08739 3.66566 6.01542 3.65847C5.94344 3.65128 5.87499 3.6238 5.81802 3.57923C5.76105 3.53466 5.71791 3.47483 5.6936 3.40671C5.59064 3.11815 5.33831 2.42917 5.11713 1.98044C5.00463 1.751 4.78916 1.46117 4.55781 1.18596C4.4801 1.09353 4.40086 1.00242 4.3201 0.912655Z" fill="#FEFEFE" />
                                                        </svg>
                                                        Top Rated
                                                    </span>
                                                </div>
                                                <div class="bd-groomer-stats">
                                                    <span>
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="10" height="14" viewBox="0 0 10 14" fill="none">
                                                            <path d="M5 6.65C4.5264 6.65 4.0722 6.46563 3.73731 6.13744C3.40242 5.80925 3.21429 5.36413 3.21429 4.9C3.21429 4.43587 3.40242 3.99075 3.73731 3.66256C4.0722 3.33437 4.5264 3.15 5 3.15C5.4736 3.15 5.9278 3.33437 6.26269 3.66256C6.59758 3.99075 6.78571 4.43587 6.78571 4.9C6.78571 5.12981 6.73953 5.35738 6.64979 5.5697C6.56004 5.78202 6.42851 5.97493 6.26269 6.13744C6.09687 6.29994 5.90002 6.42884 5.68336 6.51679C5.46671 6.60473 5.2345 6.65 5 6.65ZM5 0C3.67392 0 2.40215 0.516248 1.46447 1.43518C0.526784 2.3541 0 3.60044 0 4.9C0 8.575 5 14 5 14C5 14 10 8.575 10 4.9C10 3.60044 9.47322 2.3541 8.53553 1.43518C7.59785 0.516248 6.32608 0 5 0Z" fill="#FFC97A" />
                                                        </svg>
                                                        2.5 mi
                                                    </span>
                                                    <span>
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                                                            <path d="M6.12956 0.660476C6.40354 -0.220161 7.59647 -0.220158 7.87045 0.660479L8.89548 3.95519C9.01801 4.34902 9.36942 4.61566 9.76593 4.61566H13.083C13.9696 4.61566 14.3383 5.80055 13.621 6.34481L10.9374 8.38106C10.6166 8.62446 10.4824 9.0559 10.6049 9.44973L11.63 12.7444C11.9039 13.6251 10.9388 14.3574 10.2215 13.8131L7.53797 11.7769C7.21719 11.5335 6.78282 11.5335 6.46204 11.7769L3.77846 13.8131C3.06117 14.3574 2.09607 13.6251 2.37005 12.7444L3.39508 9.44973C3.51761 9.0559 3.38338 8.62446 3.0626 8.38106L0.37903 6.34481C-0.338258 5.80055 0.0303816 4.61566 0.916998 4.61566H4.23408C4.63058 4.61566 4.98199 4.34902 5.10452 3.95519L6.12956 0.660476Z" fill="#FFC97A" />
                                                        </svg>
                                                        4.3 <span class="bd-muted">(20 reviews)</span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                        <p class="bd-section-label">APPOINTMENT</p>
                                        <div class="bd-appointment-grid">
                                            <div class="bd-tile">
                                                <div class="bd-tile-label">
                                                    Service
                                                </div>
                                                <p class="bd-tile-value">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="17" viewBox="0 0 16 17" fill="none">
                                                        <path d="M4.94591 11.5544C6.23114 12.8397 9.35699 11.798 11.9274 9.22713C14.4983 6.65667 15.54 3.53082 14.2548 2.24559M8.72754 1.37259L9.30927 1.95473M6.6915 3.40904L7.27322 3.99077M4.9455 5.73636L5.52722 6.31809M4.36377 8.6454L4.9455 9.22713M11.9274 0.5L12.5092 1.08173M11.3457 3.99118L12.5092 5.15463M9.30968 6.02763L10.4731 7.19109M6.98236 7.77281L8.14581 8.93627" stroke="#3B3731" stroke-linecap="round" stroke-linejoin="round" />
                                                        <path d="M4.94547 13.2998C5.42747 12.8178 5.42747 12.0364 4.94548 11.5544C4.46348 11.0724 3.68202 11.0724 3.20003 11.5544L0.872775 13.8816C0.390784 14.3636 0.390784 15.1451 0.872775 15.6271C1.35477 16.1091 2.13623 16.1091 2.61822 15.6271L4.94547 13.2998Z" stroke="#3B3731" stroke-linecap="round" stroke-linejoin="round" />
                                                    </svg>
                                                    Bath &amp; Brush
                                                </p>
                                            </div>
                                            <div class="bd-tile">
                                                <div class="bd-tile-label">
                                                    Date
                                                </div>
                                                <p class="bd-tile-value">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="19" height="17" viewBox="0 0 19 17" fill="none">
                                                        <path d="M0.5 8.29554C0.5 5.20139 0.5 3.6539 1.50457 2.69308C2.50914 1.73227 4.12486 1.73145 7.35714 1.73145H10.7857C14.018 1.73145 15.6346 1.73145 16.6383 2.69308C17.642 3.65472 17.6429 5.20139 17.6429 8.29554V9.93656C17.6429 13.0307 17.6429 14.5782 16.6383 15.539C15.6337 16.4998 14.018 16.5007 10.7857 16.5007H7.35714C4.12486 16.5007 2.50829 16.5007 1.50457 15.539C0.500857 14.5774 0.5 13.0307 0.5 9.93656V8.29554Z" stroke="#3B3731" />
                                                        <path d="M4.78585 1.73077V0.5M13.3573 1.73077V0.5M0.928711 5.83333H17.2144" stroke="#3B3731" stroke-linecap="round" />
                                                        <path d="M14.2139 12.3975C14.2139 12.6151 14.1236 12.8238 13.9629 12.9777C13.8021 13.1315 13.5841 13.218 13.3568 13.218C13.1295 13.218 12.9114 13.1315 12.7507 12.9777C12.59 12.8238 12.4997 12.6151 12.4997 12.3975C12.4997 12.1799 12.59 11.9712 12.7507 11.8173C12.9114 11.6634 13.1295 11.577 13.3568 11.577C13.5841 11.577 13.8021 11.6634 13.9629 11.8173C14.1236 11.9712 14.2139 12.1799 14.2139 12.3975ZM14.2139 9.11543C14.2139 9.33305 14.1236 9.54175 13.9629 9.69562C13.8021 9.8495 13.5841 9.93595 13.3568 9.93595C13.1295 9.93595 12.9114 9.8495 12.7507 9.69562C12.59 9.54175 12.4997 9.33305 12.4997 9.11543C12.4997 8.89782 12.59 8.68912 12.7507 8.53524C12.9114 8.38137 13.1295 8.29492 13.3568 8.29492C13.5841 8.29492 13.8021 8.38137 13.9629 8.53524C14.1236 8.68912 14.2139 8.89782 14.2139 9.11543ZM9.92822 12.3975C9.92822 12.6151 9.83792 12.8238 9.67717 12.9777C9.51643 13.1315 9.29841 13.218 9.07108 13.218C8.84375 13.218 8.62573 13.1315 8.46499 12.9777C8.30424 12.8238 8.21394 12.6151 8.21394 12.3975C8.21394 12.1799 8.30424 11.9712 8.46499 11.8173C8.62573 11.6634 8.84375 11.577 9.07108 11.577C9.29841 11.577 9.51643 11.6634 9.67717 11.8173C9.83792 11.9712 9.92822 12.1799 9.92822 12.3975ZM9.92822 9.11543C9.92822 9.33305 9.83792 9.54175 9.67717 9.69562C9.51643 9.8495 9.29841 9.93595 9.07108 9.93595C8.84375 9.93595 8.62573 9.8495 8.46499 9.69562C8.30424 9.54175 8.21394 9.33305 8.21394 9.11543C8.21394 8.89782 8.30424 8.68912 8.46499 8.53524C8.62573 8.38137 8.84375 8.29492 9.07108 8.29492C9.29841 8.29492 9.51643 8.38137 9.67717 8.53524C9.83792 8.68912 9.92822 8.89782 9.92822 9.11543ZM5.64251 12.3975C5.64251 12.6151 5.5522 12.8238 5.39146 12.9777C5.23071 13.1315 5.01269 13.218 4.78537 13.218C4.55804 13.218 4.34002 13.1315 4.17927 12.9777C4.01853 12.8238 3.92822 12.6151 3.92822 12.3975C3.92822 12.1799 4.01853 11.9712 4.17927 11.8173C4.34002 11.6634 4.55804 11.577 4.78537 11.577C5.01269 11.577 5.23071 11.6634 5.39146 11.8173C5.5522 11.9712 5.64251 12.1799 5.64251 12.3975ZM5.64251 9.11543C5.64251 9.33305 5.5522 9.54175 5.39146 9.69562C5.23071 9.8495 5.01269 9.93595 4.78537 9.93595C4.55804 9.93595 4.34002 9.8495 4.17927 9.69562C4.01853 9.54175 3.92822 9.33305 3.92822 9.11543C3.92822 8.89782 4.01853 8.68912 4.17927 8.53524C4.34002 8.38137 4.55804 8.29492 4.78537 8.29492C5.01269 8.29492 5.23071 8.38137 5.39146 8.53524C5.5522 8.68912 5.64251 8.89782 5.64251 9.11543Z" fill="#3B3731" />
                                                    </svg>
                                                    Wed, 18 Dec 2025
                                                </p>
                                            </div>
                                            <div class="bd-tile">
                                                <div class="bd-tile-label">
                                                    Time
                                                </div>
                                                <p class="bd-tile-value">
                                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
                                                        <circle cx="8" cy="8" r="6" stroke="#3B3731" stroke-width="1.5" />
                                                        <path d="M8 4.5V8L10.5 10" stroke="#3B3731" stroke-width="1.5" stroke-linecap="round" />
                                                    </svg>
                                                    14:30 - 15:30
                                                </p>
                                            </div>
                                            <div class="bd-tile">
                                                <div class="bd-tile-label">
                                                    Location
                                                </div>
                                                <p class="bd-tile-value">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="16" viewBox="0 0 12 16" fill="none">
                                                        <path d="M6 0.5C7.4694 0.5 8.87214 1.04525 9.90137 2.00586C10.9293 2.96529 11.4999 4.25871 11.5 5.59961C11.5 7.10011 10.6408 8.95946 9.51855 10.7236C8.41048 12.4655 7.10434 14.0263 6.32227 14.9082C6.14625 15.1067 5.85375 15.1067 5.67773 14.9082C4.89566 14.0263 3.58952 12.4655 2.48145 10.7236C1.35919 8.95946 0.5 7.10011 0.5 5.59961C0.500111 4.25871 1.07068 2.96529 2.09863 2.00586C3.12786 1.04525 4.53061 0.5 6 0.5ZM6 3.09961C5.30978 3.09961 4.64141 3.35564 4.14355 3.82031C3.64466 4.28597 3.35753 4.92517 3.35742 5.59961C3.35742 6.27422 3.64453 6.91413 4.14355 7.37988C4.64141 7.84453 5.30979 8.09961 6 8.09961C6.34236 8.09961 6.68202 8.03695 7 7.91406C7.31807 7.7911 7.60965 7.61022 7.85645 7.37988C8.10326 7.14952 8.30086 6.87397 8.43652 6.56836C8.57224 6.26256 8.64258 5.93289 8.64258 5.59961C8.64247 4.92517 8.35534 4.28597 7.85645 3.82031C7.35859 3.35564 6.69022 3.09961 6 3.09961Z" stroke="#3B3731" />
                                                    </svg>
                                                    At your home
                                                </p>
                                            </div>
                                        </div>

                                        <p class="bd-section-label">PET</p>
                                        <div class="bd-pet-card">
                                            <img src="<?= BASE_URL ?>/assets/images/pet_details_1.png" alt="Bella" class="bd-pet-avatar">
                                            <div class="bd-pet-details">
                                                <div class="bd-pet-meta">
                                                    <p class="bd-pet-name">Bella - Rabbit <span class="bd-pet-breed">(Mini Lop)</span></p>

                                                    <span>
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                                                            <circle cx="7" cy="4.5" r="3.25" stroke="#9D9B98" stroke-width="1" />
                                                            <path d="M7 7.75V13M4.25 10.75H9.75" stroke="#9D9B98" stroke-width="1" stroke-linecap="round" />
                                                        </svg>
                                                        Female
                                                    </span>
                                                    <span>
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="16" viewBox="0 0 15 16" fill="none">
                                                            <path d="M4.7373 3.14703C4.7373 3.84907 5.01619 4.52235 5.51261 5.01876C6.00903 5.51518 6.68232 5.79406 7.38436 5.79406C8.08641 5.79406 8.7597 5.51518 9.25612 5.01876C9.75254 4.52235 10.0314 3.84907 10.0314 3.14703C10.0314 2.44499 9.75254 1.77171 9.25612 1.2753C8.7597 0.778883 8.08641 0.5 7.38436 0.5C6.68232 0.5 6.00903 0.778883 5.51261 1.2753C5.01619 1.77171 4.7373 2.44499 4.7373 3.14703Z" stroke="#9D9B98" stroke-linecap="round" stroke-linejoin="round" />
                                                            <path d="M2.8269 5.79419H11.9416C12.1482 5.79416 12.3483 5.86665 12.507 5.99904C12.6657 6.13142 12.7728 6.31529 12.8098 6.51859L14.2542 14.4597C14.2774 14.5869 14.2723 14.7176 14.2394 14.8425C14.2064 14.9675 14.1464 15.0838 14.0636 15.183C13.9807 15.2822 13.8771 15.3621 13.76 15.4168C13.643 15.4716 13.5153 15.5 13.386 15.5H1.38249C1.25323 15.5 1.12554 15.4716 1.00846 15.4168C0.891377 15.3621 0.78776 15.2822 0.704935 15.183C0.62211 15.0838 0.5621 14.9675 0.52915 14.8425C0.496199 14.7176 0.491113 14.5869 0.514251 14.4597L1.95866 6.51859C1.99565 6.31529 2.10282 6.13142 2.26149 5.99904C2.42016 5.86665 2.62026 5.79416 2.8269 5.79419Z" stroke="#9D9B98" stroke-linecap="round" stroke-linejoin="round" />
                                                        </svg>
                                                        5 kg
                                                    </span>
                                                    <span>
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="16" viewBox="0 0 15 16" fill="none">
                                                            <path d="M13.5905 8.11123L13.9601 6.73016C14.3918 5.1182 14.6084 4.31257 14.4462 3.61489C14.3176 3.0641 14.0285 2.56382 13.6155 2.17734C13.093 1.68768 12.2866 1.4718 10.6747 1.04003C9.0627 0.607553 8.25636 0.391671 7.55939 0.55394C7.0086 0.682549 6.50833 0.971618 6.12185 1.38458C5.70224 1.83207 5.4835 2.48758 5.15824 3.67851L4.98382 4.32544L4.61425 5.70651C4.18177 7.31847 3.96589 8.1241 4.12816 8.82178C4.25677 9.37257 4.54584 9.87285 4.9588 10.2593C5.48135 10.749 6.28769 10.9649 7.89966 11.3974C9.35221 11.7862 10.1507 12 10.8048 11.9192C10.8763 11.9101 10.9463 11.8977 11.0149 11.882C11.5655 11.7538 12.0658 11.4652 12.4525 11.0528C12.9421 10.5295 13.158 9.7232 13.5905 8.11123Z" stroke="#9D9B98" />
                                                            <path d="M10.8047 11.9191C10.6553 12.3769 10.3927 12.7895 10.0413 13.1186C9.51875 13.6083 8.71241 13.8242 7.10045 14.2559C5.48848 14.6877 4.68214 14.9043 3.98517 14.7413C3.43447 14.6129 2.9342 14.3241 2.54763 13.9114C2.05796 13.3888 1.84137 12.5825 1.4096 10.9705L1.04003 9.58946C0.607553 7.9775 0.391671 7.17116 0.55394 6.47419C0.682549 5.9234 0.971618 5.42313 1.38458 5.03665C1.90713 4.54698 2.71347 4.3311 4.32544 3.89862C4.62948 3.81665 4.90708 3.74302 5.15823 3.67773" stroke="#9D9B98" />
                                                            <path d="M7.48902 6.21899L10.9417 7.144M6.93359 8.2906L9.0052 8.84532" stroke="#9D9B98" stroke-linecap="round" />
                                                        </svg>
                                                        Nervous around hair-dryers
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="bd-next-steps">
                                            <h3>What happens next?</h3>
                                            <ul>
                                                <li>Your booking is secured for the selected time.</li>
                                                <li>You will receive a reminder 24 hours before your appointment.</li>
                                                <li>You can manage or cancel your booking from your account.</li>
                                            </ul>
                                        </div>

                                        <div class="bd-total-row">
                                            <span class="bd-total-label">Total Paid</span>
                                            <span class="bd-total-amount">£48.00</span>
                                        </div>

                                        <div class="bd-footer">
                                            <button type="button" class="bd-cancel-link" data-modal-open="cancel_groomer_booking_modal" data-close-parent-modal>Cancel Booking</button>
                                            <div class="bd-footer-actions">
                                                <a href="<?= BASE_URL ?>messages_notification/messages.php" class="bd-btn bd-btn-message">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="15" viewBox="0 0 16 15" fill="none">
                                                        <path d="M8 0.5C12.2044 0.5 15.5 3.48321 15.5 7.03223C15.5 10.4703 12.4072 13.3772 8.3916 13.5557L8 13.5645H7.99902C7.251 13.5661 6.50584 13.4687 5.7832 13.2744L5.59766 13.2246L5.42676 13.3115C5.00713 13.5247 4.13103 13.9084 2.72363 14.2393L2.08691 14.377C1.99742 14.3948 1.9071 14.4082 1.81738 14.4248C1.85085 14.3352 1.88498 14.2458 1.91602 14.1553L1.91895 14.1455C2.17667 13.3938 2.38924 12.5229 2.46777 11.7012L2.49023 11.4678L2.3252 11.3008C1.18119 10.1487 0.500003 8.65476 0.5 7.03223C0.5 3.48321 3.79561 0.5 8 0.5Z" stroke="#3B3731" />
                                                    </svg>
                                                    Message groomer
                                                </a>
                                                <button type="button" class="bd-btn bd-btn-change" data-modal-open="change_groomer_booking_modal" data-close-parent-modal>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                                        <path d="M2.23096 15.4953V12.6124H5.11378" stroke="white" stroke-linecap="round" stroke-linejoin="round" />
                                                        <path d="M15.3656 6.62252C15.6715 8.25452 15.4269 9.94189 14.6702 11.4199C13.9135 12.8978 12.6875 14.0827 11.1846 14.7887C9.68175 15.4946 7.98704 15.6817 6.3664 15.3204C4.74575 14.9592 3.2909 14.0701 2.23013 12.7927M0.628303 9.37748C0.322432 7.74548 0.567036 6.05811 1.32373 4.58014C2.08043 3.10218 3.3064 1.91725 4.80927 1.2113C6.31214 0.505355 8.00686 0.318331 9.6275 0.679579C11.2481 1.04083 12.703 1.9299 13.7638 3.2073" stroke="white" stroke-linecap="round" stroke-linejoin="round" />
                                                        <path d="M13.7624 0.504883V3.38771H10.8796M4.61412 8.38848C4.2061 8.31757 4.2061 7.73171 4.61412 7.6608C5.3363 7.53448 6.00461 7.19626 6.53409 6.68914C7.06356 6.18203 7.43027 5.52892 7.58761 4.81285L7.61202 4.70009C7.70037 4.29673 8.27461 4.2944 8.36644 4.6966L8.39666 4.82796C8.55903 5.54126 8.92875 6.19059 9.4593 6.69425C9.98985 7.19791 10.6575 7.53339 11.3783 7.65848C11.7886 7.72938 11.7886 8.31874 11.3783 8.39081C10.6577 8.51581 9.99011 8.85111 9.45958 9.35455C8.92904 9.85799 8.55923 10.5071 8.39666 11.2202L8.36644 11.3504C8.27461 11.7526 7.70037 11.7502 7.61202 11.3469L7.58877 11.2353C7.43128 10.5189 7.06422 9.86555 6.5343 9.3584C6.00438 8.85125 5.33556 8.51322 4.61295 8.38732" stroke="white" stroke-linecap="round" stroke-linejoin="round" />
                                                    </svg>
                                                    Change booking
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Completed Groom Booking Modal -->

                            <div class="modal" id="view_booking_groom_completed_modal">
                                <div class="modal-content size bd-modal-content">
                                    <div class="bd-modal">
                                        <button class="bd-close" type="button" data-modal-close aria-label="Close">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 36 36" fill="none">
                                                <circle cx="18" cy="18" r="17.5" stroke="#3B3731" />
                                                <path d="M12.8 24.0008L24 12.8008M12.8 12.8008L24 24.0008" stroke="#3B3731" stroke-width="1.5" stroke-linecap="round" />
                                            </svg>
                                        </button>

                                        <div class="bd-header">
                                            <h1>Booking Details</h1>
                                            <p>Your completed booking</p>
                                        </div>
                                        <hr class="bd-divider">

                                        <div class="bd-status-bar">
                                            <span class="bd-status-badge bd-status-badge--completed">
                                                <span class="bd-status-dot"></span>
                                                Completed
                                            </span>
                                            <div class="bd-ref-actions">
                                                <span class="bd-ref-id">FG-10294</span>
                                                <a href="#" class="bd-pdf-link">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="13" height="15" viewBox="0 0 13 15" fill="none">
                                                        <path d="M3.07717 14.5H9.27418C9.95769 14.5 10.6132 14.2209 11.0965 13.7242C11.5798 13.2275 11.8514 12.5538 11.8514 11.8514V7.66649C11.8516 6.96411 11.5804 6.29039 11.0973 5.79351L6.70216 1.27568C6.46282 1.02973 6.1787 0.834645 5.86601 0.701554C5.55331 0.568463 5.21817 0.499975 4.87972 0.5H3.07717C2.39367 0.5 1.73815 0.779053 1.25484 1.27577C0.771523 1.77249 0.5 2.44618 0.5 3.14865V11.8514C0.5 12.5538 0.771523 13.2275 1.25484 13.7242C1.73815 14.2209 2.39367 14.5 3.07717 14.5Z" stroke="#3B3731" stroke-linecap="round" stroke-linejoin="round" />
                                                        <path d="M5.9458 0.772461V5.0557C5.9458 5.45711 6.10096 5.84208 6.37714 6.12592C6.65332 6.40976 7.0279 6.56922 7.41847 6.56922H11.5876" stroke="#3B3731" stroke-linecap="round" stroke-linejoin="round" />
                                                        <path d="M2.67822 10.9055V10.1488M2.67822 10.1488V8.63525H3.41456C3.60985 8.63525 3.79714 8.71498 3.93523 8.8569C4.07332 8.99882 4.15089 9.19131 4.15089 9.39201C4.15089 9.59272 4.07332 9.7852 3.93523 9.92712C3.79714 10.069 3.60985 10.1488 3.41456 10.1488H2.67822ZM8.56891 10.9055V9.95958M8.56891 9.95958V8.63525H9.67341M8.56891 9.95958H9.67341M5.62357 10.9055V8.63525H5.99173C6.28467 8.63525 6.5656 8.75485 6.77274 8.96773C6.97987 9.18061 7.09624 9.46933 7.09624 9.77039C7.09624 10.0714 6.97987 10.3602 6.77274 10.5731C6.5656 10.7859 6.28467 10.9055 5.99173 10.9055H5.62357Z" stroke="#3B3731" stroke-linecap="round" stroke-linejoin="round" />
                                                    </svg>
                                                    Download PDF
                                                </a>
                                            </div>
                                        </div>

                                        <div class="bd-groomer-card">
                                            <div class="bd-groomer-left">
                                                <div class="bd-groomer-avatar-wrap">
                                                    <img src="<?= BASE_URL ?>/assets/images/card1.png" alt="Sarah's Grooming Studio" class="bd-groomer-avatar">
                                                    <div class="bd-verified-badge" title="Verified">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="22" viewBox="0 0 30 33" fill="none">
                                                            <ellipse cx="15.873" cy="16.5256" rx="9.3645" ry="8.81365" fill="white"></ellipse>
                                                            <path d="M15.44 0.185076C15.1841 0.0638192 14.9099 0 14.6235 0C14.3372 0 14.063 0.0638192 13.8071 0.185076L2.3337 5.28423C0.993208 5.87775 -0.00606541 7.26263 2.77146e-05 8.93469C0.0304934 15.2656 2.51649 26.8487 13.015 32.1138C14.0325 32.6244 15.2146 32.6244 16.2321 32.1138C26.7306 26.8487 29.2166 15.2656 29.247 8.93469C29.2531 7.26263 28.2539 5.87775 26.9134 5.28423L15.44 0.185076ZM8.82897 18.2651C9.12144 18.3416 9.43219 18.3799 9.74903 18.3799C11.8999 18.3799 13.6486 16.5483 13.6486 14.2955V10.2111H16.3418C17.0791 10.2111 17.7554 10.645 18.0844 11.3407L18.5231 12.2533H22.4227C22.9589 12.2533 23.3976 12.7128 23.3976 13.2744V15.3166C23.3976 18.1374 21.2163 20.4222 18.5231 20.4222H15.5984V23.6578C15.5984 24.1237 15.2389 24.5066 14.7881 24.5066C14.6784 24.5066 14.5687 24.4811 14.4712 24.4364L8.45729 21.7368C8.05514 21.5581 7.79923 21.1433 7.79923 20.6902C7.79923 20.5115 7.83579 20.3392 7.915 20.1796L8.82897 18.2651ZM8.77413 10.2111H11.6988V14.2955C11.6988 15.4251 10.8275 16.3377 9.74903 16.3377C8.67055 16.3377 7.79923 15.4251 7.79923 14.2955V11.2322C7.79923 10.6706 8.23794 10.2111 8.77413 10.2111ZM16.5733 13.2744C16.5733 13.0036 16.4706 12.7439 16.2878 12.5524C16.105 12.3609 15.857 12.2533 15.5984 12.2533C15.3399 12.2533 15.0919 12.3609 14.9091 12.5524C14.7262 12.7439 14.6235 13.0036 14.6235 13.2744C14.6235 13.5452 14.7262 13.8049 14.9091 13.9964C15.0919 14.1879 15.3399 14.2955 15.5984 14.2955C15.857 14.2955 16.105 14.1879 16.2878 13.9964C16.4706 13.8049 16.5733 13.5452 16.5733 13.2744Z" fill="#C9DDA0"></path>
                                                        </svg>
                                                    </div>
                                                </div>
                                                <div class="bd-groomer-identity">
                                                    <div class="bd-groomer-title-row">
                                                        <h3>Sarah's Grooming Studio</h3>
                                                        <span class="bd-service-badge">Home Visits</span>
                                                    </div>
                                                    <p class="bd-groomer-name">Sarah W.</p>
                                                </div>
                                            </div>
                                            <div class="bd-groomer-right">
                                                <div class="bd-groomer-badges">
                                                    <span class="bd-badge bd-badge-popular">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="10" height="9" viewBox="0 0 10 9" fill="none">
                                                            <path d="M2 8.99999C1.85833 8.99999 1.73967 8.95199 1.644 8.85599C1.54833 8.75999 1.50033 8.64133 1.5 8.49999C1.49967 8.35866 1.54767 8.23999 1.644 8.14399C1.74033 8.04799 1.859 7.99999 2 7.99999H8C8.14166 7.99999 8.2605 8.04799 8.3565 8.14399C8.4525 8.23999 8.50033 8.35866 8.5 8.49999C8.49966 8.64133 8.45166 8.76016 8.356 8.85649C8.26033 8.95283 8.14166 9.00066 8 8.99999H2ZM2.35 7.24999C2.10833 7.24999 1.89383 7.17083 1.7065 7.0125C1.51917 6.85416 1.4045 6.65416 1.3625 6.4125L0.862501 3.2375C0.845834 3.2375 0.827167 3.23967 0.806501 3.244C0.785834 3.24833 0.767001 3.25033 0.750001 3.25C0.541667 3.25 0.364668 3.17717 0.219001 3.0315C0.0733344 2.88583 0.000334469 2.70867 1.13636e-06 2.5C-0.000332197 2.29133 0.0726677 2.11433 0.219001 1.969C0.365334 1.82367 0.542334 1.75067 0.750001 1.75C0.957667 1.74933 1.13483 1.82233 1.2815 1.969C1.42817 2.11567 1.501 2.29267 1.5 2.5C1.5 2.55833 1.49367 2.6125 1.481 2.6625C1.46833 2.7125 1.45383 2.75833 1.4375 2.8L3 3.5L4.5625 1.3625C4.47083 1.29583 4.39583 1.20833 4.3375 1.1C4.27917 0.991667 4.25 0.875 4.25 0.75C4.25 0.541667 4.323 0.364501 4.469 0.218501C4.615 0.0725011 4.792 -0.000332194 5 1.13895e-06C5.208 0.000334472 5.38516 0.0733344 5.5315 0.219001C5.67783 0.364667 5.75066 0.541667 5.75 0.75C5.75 0.875 5.72083 0.991667 5.6625 1.1C5.60416 1.20833 5.52916 1.29583 5.4375 1.3625L7 3.5L8.5625 2.8C8.54583 2.75833 8.53116 2.7125 8.5185 2.6625C8.50583 2.6125 8.49966 2.55833 8.5 2.5C8.5 2.29167 8.573 2.1145 8.719 1.9685C8.865 1.8225 9.042 1.74967 9.25 1.75C9.458 1.75033 9.63516 1.82333 9.7815 1.969C9.92783 2.11467 10.0007 2.29167 10 2.5C9.99933 2.70833 9.92649 2.8855 9.7815 3.0315C9.6365 3.1775 9.45933 3.25033 9.25 3.25C9.23333 3.25 9.21466 3.248 9.194 3.244C9.17333 3.24 9.1545 3.23783 9.1375 3.2375L8.6375 6.4125C8.59583 6.65416 8.48133 6.85416 8.294 7.0125C8.10666 7.17083 7.892 7.24999 7.65 7.24999H2.35ZM2.35 6.25H7.65L7.975 4.1625L7.4 4.4125C7.18333 4.50416 6.9625 4.52083 6.7375 4.4625C6.5125 4.40416 6.32916 4.27916 6.1875 4.0875L5 2.45L3.8125 4.0875C3.67083 4.27916 3.4875 4.40416 3.2625 4.4625C3.0375 4.52083 2.81667 4.50416 2.6 4.4125L2.025 4.1625L2.35 6.25Z" fill="white" />
                                                        </svg>
                                                        Popular
                                                    </span>
                                                    <span class="bd-badge bd-badge-rated">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="9" height="11" viewBox="0 0 9 11" fill="none">
                                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M6.41322 7.89398C6.44215 7.34453 6.31579 6.79804 6.0486 6.31706C5.78142 5.83608 5.3842 5.44005 4.90243 5.1743C4.81687 5.12481 4.71545 5.11047 4.61952 5.1343C4.5236 5.15813 4.44068 5.21827 4.38824 5.30205L3.77553 6.28276L3.26579 5.66624C3.23778 5.63245 3.20308 5.60482 3.16387 5.5851C3.12466 5.56538 3.08178 5.554 3.03795 5.55167C2.99413 5.54934 2.95029 5.55612 2.90921 5.57157C2.86813 5.58702 2.83069 5.61082 2.79926 5.64146C2.49919 5.93182 2.2648 6.2831 2.11186 6.67164C1.95892 7.06019 1.89098 7.47698 1.91262 7.89398C1.91262 8.49072 2.14967 9.06301 2.57162 9.48496C2.99358 9.90692 3.56587 10.144 4.1626 10.144C4.75934 10.144 5.33163 9.90692 5.75358 9.48496C6.17554 9.06301 6.41259 8.49072 6.41259 7.89398M3.01028 6.35586L2.97087 6.40798C2.67197 6.82551 2.52221 7.33145 2.54566 7.84441L2.54757 7.88191C2.54757 8.31007 2.71766 8.7207 3.02042 9.02346C3.32317 9.32621 3.7338 9.4963 4.16197 9.4963C4.59013 9.4963 5.00076 9.32621 5.30352 9.02346C5.60628 8.7207 5.77636 8.31007 5.77636 7.88191L5.77827 7.84504C5.78272 7.80373 5.88187 6.6673 4.84205 5.89442L4.79056 5.85692L4.12701 6.91835C4.09497 6.96954 4.05123 7.01239 3.99939 7.04337C3.94755 7.07435 3.8891 7.09258 3.82884 7.09655C3.76858 7.10052 3.70823 7.09013 3.65278 7.06622C3.59732 7.04231 3.54834 7.00557 3.50985 6.95903L3.01028 6.35586Z" fill="#FEFEFE" />
                                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M3.79701 0.30821C3.81025 0.23997 3.84191 0.176658 3.88858 0.125138C3.93524 0.0736173 3.99512 0.0358558 4.06172 0.0159479C4.12832 -0.00396001 4.1991 -0.00525449 4.26638 0.0122049C4.33367 0.0296642 4.39489 0.0652111 4.4434 0.114991C4.56671 0.240837 4.80378 0.489988 5.04467 0.777274C5.28111 1.05884 5.53916 1.39761 5.68788 1.69951C5.8328 1.99443 5.98661 2.37578 6.10801 2.69421L6.67305 1.75354C6.70456 1.701 6.74826 1.65683 6.80046 1.62476C6.85265 1.59269 6.91181 1.57367 6.97292 1.56931C7.03402 1.56494 7.09528 1.57536 7.1515 1.59969C7.20773 1.62401 7.25727 1.66152 7.29592 1.70905C8.09867 2.70057 8.49846 3.76263 8.6974 4.57365C8.79718 4.97979 8.8474 5.32491 8.87282 5.57025C8.88576 5.69278 8.89424 5.81574 8.89824 5.93889V5.97131C8.89824 8.4482 6.93364 10.4649 4.44785 10.4649C1.96206 10.4649 0 8.44756 0 5.97004C0 5.28805 0.322244 3.68192 1.27563 2.36498C1.31266 2.31422 1.36166 2.27341 1.41826 2.24615C1.47487 2.2189 1.53734 2.20605 1.60011 2.20876C1.66287 2.21146 1.724 2.22963 1.77806 2.26166C1.83211 2.29368 1.87741 2.33856 1.90994 2.39231L2.55507 3.46709C2.75083 3.16073 3.01269 2.73044 3.21163 2.3332C3.49765 1.76117 3.72455 0.682572 3.79701 0.308845M4.3201 0.912655C4.20506 1.42113 4.01501 2.14697 3.77985 2.61858C3.46714 3.24336 3.0165 3.9298 2.86142 4.16051C2.82554 4.21345 2.77693 4.25651 2.72005 4.28574C2.66317 4.31497 2.59986 4.32943 2.53593 4.32778C2.472 4.32614 2.40952 4.30844 2.35422 4.27632C2.29892 4.24421 2.25258 4.1987 2.21948 4.14399L1.57118 3.06476C0.87457 4.19166 0.635589 5.45839 0.635589 5.97131C0.635589 8.10561 2.32244 9.82806 4.44785 9.82806C6.57326 9.82806 8.26265 8.10561 8.26265 5.97131V5.95351L8.26011 5.88995C8.25568 5.80484 8.24911 5.71986 8.24041 5.63508C8.20712 5.3287 8.15362 5.02487 8.08024 4.72555C7.87826 3.89157 7.52027 3.10334 7.02516 2.40248L6.38068 3.47535C6.34338 3.53732 6.28925 3.58743 6.22459 3.61985C6.15993 3.65227 6.08739 3.66566 6.01542 3.65847C5.94344 3.65128 5.87499 3.6238 5.81802 3.57923C5.76105 3.53466 5.71791 3.47483 5.6936 3.40671C5.59064 3.11815 5.33831 2.42917 5.11713 1.98044C5.00463 1.751 4.78916 1.46117 4.55781 1.18596C4.4801 1.09353 4.40086 1.00242 4.3201 0.912655Z" fill="#FEFEFE" />
                                                        </svg>
                                                        Top Rated
                                                    </span>
                                                </div>
                                                <div class="bd-groomer-stats">
                                                    <span>
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="10" height="14" viewBox="0 0 10 14" fill="none">
                                                            <path d="M5 6.65C4.5264 6.65 4.0722 6.46563 3.73731 6.13744C3.40242 5.80925 3.21429 5.36413 3.21429 4.9C3.21429 4.43587 3.40242 3.99075 3.73731 3.66256C4.0722 3.33437 4.5264 3.15 5 3.15C5.4736 3.15 5.9278 3.33437 6.26269 3.66256C6.59758 3.99075 6.78571 4.43587 6.78571 4.9C6.78571 5.12981 6.73953 5.35738 6.64979 5.5697C6.56004 5.78202 6.42851 5.97493 6.26269 6.13744C6.09687 6.29994 5.90002 6.42884 5.68336 6.51679C5.46671 6.60473 5.2345 6.65 5 6.65ZM5 0C3.67392 0 2.40215 0.516248 1.46447 1.43518C0.526784 2.3541 0 3.60044 0 4.9C0 8.575 5 14 5 14C5 14 10 8.575 10 4.9C10 3.60044 9.47322 2.3541 8.53553 1.43518C7.59785 0.516248 6.32608 0 5 0Z" fill="#FFC97A" />
                                                        </svg>
                                                        2.5 mi
                                                    </span>
                                                    <span>
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                                                            <path d="M6.12956 0.660476C6.40354 -0.220161 7.59647 -0.220158 7.87045 0.660479L8.89548 3.95519C9.01801 4.34902 9.36942 4.61566 9.76593 4.61566H13.083C13.9696 4.61566 14.3383 5.80055 13.621 6.34481L10.9374 8.38106C10.6166 8.62446 10.4824 9.0559 10.6049 9.44973L11.63 12.7444C11.9039 13.6251 10.9388 14.3574 10.2215 13.8131L7.53797 11.7769C7.21719 11.5335 6.78282 11.5335 6.46204 11.7769L3.77846 13.8131C3.06117 14.3574 2.09607 13.6251 2.37005 12.7444L3.39508 9.44973C3.51761 9.0559 3.38338 8.62446 3.0626 8.38106L0.37903 6.34481C-0.338258 5.80055 0.0303816 4.61566 0.916998 4.61566H4.23408C4.63058 4.61566 4.98199 4.34902 5.10452 3.95519L6.12956 0.660476Z" fill="#FFC97A" />
                                                        </svg>
                                                        4.3 <span class="bd-muted">(20 reviews)</span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                        <p class="bd-section-label">APPOINTMENT</p>
                                        <div class="bd-appointment-grid">
                                            <div class="bd-tile">
                                                <div class="bd-tile-label">
                                                    Service
                                                </div>
                                                <p class="bd-tile-value">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="17" viewBox="0 0 16 17" fill="none">
                                                        <path d="M4.94591 11.5544C6.23114 12.8397 9.35699 11.798 11.9274 9.22713C14.4983 6.65667 15.54 3.53082 14.2548 2.24559M8.72754 1.37259L9.30927 1.95473M6.6915 3.40904L7.27322 3.99077M4.9455 5.73636L5.52722 6.31809M4.36377 8.6454L4.9455 9.22713M11.9274 0.5L12.5092 1.08173M11.3457 3.99118L12.5092 5.15463M9.30968 6.02763L10.4731 7.19109M6.98236 7.77281L8.14581 8.93627" stroke="#3B3731" stroke-linecap="round" stroke-linejoin="round" />
                                                        <path d="M4.94547 13.2998C5.42747 12.8178 5.42747 12.0364 4.94548 11.5544C4.46348 11.0724 3.68202 11.0724 3.20003 11.5544L0.872775 13.8816C0.390784 14.3636 0.390784 15.1451 0.872775 15.6271C1.35477 16.1091 2.13623 16.1091 2.61822 15.6271L4.94547 13.2998Z" stroke="#3B3731" stroke-linecap="round" stroke-linejoin="round" />
                                                    </svg>
                                                    Bath &amp; Brush
                                                </p>
                                            </div>
                                            <div class="bd-tile">
                                                <div class="bd-tile-label">
                                                    Date
                                                </div>
                                                <p class="bd-tile-value">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="19" height="17" viewBox="0 0 19 17" fill="none">
                                                        <path d="M0.5 8.29554C0.5 5.20139 0.5 3.6539 1.50457 2.69308C2.50914 1.73227 4.12486 1.73145 7.35714 1.73145H10.7857C14.018 1.73145 15.6346 1.73145 16.6383 2.69308C17.642 3.65472 17.6429 5.20139 17.6429 8.29554V9.93656C17.6429 13.0307 17.6429 14.5782 16.6383 15.539C15.6337 16.4998 14.018 16.5007 10.7857 16.5007H7.35714C4.12486 16.5007 2.50829 16.5007 1.50457 15.539C0.500857 14.5774 0.5 13.0307 0.5 9.93656V8.29554Z" stroke="#3B3731" />
                                                        <path d="M4.78585 1.73077V0.5M13.3573 1.73077V0.5M0.928711 5.83333H17.2144" stroke="#3B3731" stroke-linecap="round" />
                                                        <path d="M14.2139 12.3975C14.2139 12.6151 14.1236 12.8238 13.9629 12.9777C13.8021 13.1315 13.5841 13.218 13.3568 13.218C13.1295 13.218 12.9114 13.1315 12.7507 12.9777C12.59 12.8238 12.4997 12.6151 12.4997 12.3975C12.4997 12.1799 12.59 11.9712 12.7507 11.8173C12.9114 11.6634 13.1295 11.577 13.3568 11.577C13.5841 11.577 13.8021 11.6634 13.9629 11.8173C14.1236 11.9712 14.2139 12.1799 14.2139 12.3975ZM14.2139 9.11543C14.2139 9.33305 14.1236 9.54175 13.9629 9.69562C13.8021 9.8495 13.5841 9.93595 13.3568 9.93595C13.1295 9.93595 12.9114 9.8495 12.7507 9.69562C12.59 9.54175 12.4997 9.33305 12.4997 9.11543C12.4997 8.89782 12.59 8.68912 12.7507 8.53524C12.9114 8.38137 13.1295 8.29492 13.3568 8.29492C13.5841 8.29492 13.8021 8.38137 13.9629 8.53524C14.1236 8.68912 14.2139 8.89782 14.2139 9.11543ZM9.92822 12.3975C9.92822 12.6151 9.83792 12.8238 9.67717 12.9777C9.51643 13.1315 9.29841 13.218 9.07108 13.218C8.84375 13.218 8.62573 13.1315 8.46499 12.9777C8.30424 12.8238 8.21394 12.6151 8.21394 12.3975C8.21394 12.1799 8.30424 11.9712 8.46499 11.8173C8.62573 11.6634 8.84375 11.577 9.07108 11.577C9.29841 11.577 9.51643 11.6634 9.67717 11.8173C9.83792 11.9712 9.92822 12.1799 9.92822 12.3975ZM9.92822 9.11543C9.92822 9.33305 9.83792 9.54175 9.67717 9.69562C9.51643 9.8495 9.29841 9.93595 9.07108 9.93595C8.84375 9.93595 8.62573 9.8495 8.46499 9.69562C8.30424 9.54175 8.21394 9.33305 8.21394 9.11543C8.21394 8.89782 8.30424 8.68912 8.46499 8.53524C8.62573 8.38137 8.84375 8.29492 9.07108 8.29492C9.29841 8.29492 9.51643 8.38137 9.67717 8.53524C9.83792 8.68912 9.92822 8.89782 9.92822 9.11543ZM5.64251 12.3975C5.64251 12.6151 5.5522 12.8238 5.39146 12.9777C5.23071 13.1315 5.01269 13.218 4.78537 13.218C4.55804 13.218 4.34002 13.1315 4.17927 12.9777C4.01853 12.8238 3.92822 12.6151 3.92822 12.3975C3.92822 12.1799 4.01853 11.9712 4.17927 11.8173C4.34002 11.6634 4.55804 11.577 4.78537 11.577C5.01269 11.577 5.23071 11.6634 5.39146 11.8173C5.5522 11.9712 5.64251 12.1799 5.64251 12.3975ZM5.64251 9.11543C5.64251 9.33305 5.5522 9.54175 5.39146 9.69562C5.23071 9.8495 5.01269 9.93595 4.78537 9.93595C4.55804 9.93595 4.34002 9.8495 4.17927 9.69562C4.01853 9.54175 3.92822 9.33305 3.92822 9.11543C3.92822 8.89782 4.01853 8.68912 4.17927 8.53524C4.34002 8.38137 4.55804 8.29492 4.78537 8.29492C5.01269 8.29492 5.23071 8.38137 5.39146 8.53524C5.5522 8.68912 5.64251 8.89782 5.64251 9.11543Z" fill="#3B3731" />
                                                    </svg>
                                                    Wed, 18 Dec 2025
                                                </p>
                                            </div>
                                            <div class="bd-tile">
                                                <div class="bd-tile-label">
                                                    Time
                                                </div>
                                                <p class="bd-tile-value">
                                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
                                                        <circle cx="8" cy="8" r="6" stroke="#3B3731" stroke-width="1.5" />
                                                        <path d="M8 4.5V8L10.5 10" stroke="#3B3731" stroke-width="1.5" stroke-linecap="round" />
                                                    </svg>
                                                    14:30 - 15:30
                                                </p>
                                            </div>
                                            <div class="bd-tile">
                                                <div class="bd-tile-label">
                                                    Location
                                                </div>
                                                <p class="bd-tile-value">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="16" viewBox="0 0 12 16" fill="none">
                                                        <path d="M6 0.5C7.4694 0.5 8.87214 1.04525 9.90137 2.00586C10.9293 2.96529 11.4999 4.25871 11.5 5.59961C11.5 7.10011 10.6408 8.95946 9.51855 10.7236C8.41048 12.4655 7.10434 14.0263 6.32227 14.9082C6.14625 15.1067 5.85375 15.1067 5.67773 14.9082C4.89566 14.0263 3.58952 12.4655 2.48145 10.7236C1.35919 8.95946 0.5 7.10011 0.5 5.59961C0.500111 4.25871 1.07068 2.96529 2.09863 2.00586C3.12786 1.04525 4.53061 0.5 6 0.5ZM6 3.09961C5.30978 3.09961 4.64141 3.35564 4.14355 3.82031C3.64466 4.28597 3.35753 4.92517 3.35742 5.59961C3.35742 6.27422 3.64453 6.91413 4.14355 7.37988C4.64141 7.84453 5.30979 8.09961 6 8.09961C6.34236 8.09961 6.68202 8.03695 7 7.91406C7.31807 7.7911 7.60965 7.61022 7.85645 7.37988C8.10326 7.14952 8.30086 6.87397 8.43652 6.56836C8.57224 6.26256 8.64258 5.93289 8.64258 5.59961C8.64247 4.92517 8.35534 4.28597 7.85645 3.82031C7.35859 3.35564 6.69022 3.09961 6 3.09961Z" stroke="#3B3731" />
                                                    </svg>
                                                    At your home
                                                </p>
                                            </div>
                                        </div>

                                        <p class="bd-section-label">PET</p>
                                        <div class="bd-pet-card">
                                            <img src="<?= BASE_URL ?>/assets/images/pet_details_1.png" alt="Bella" class="bd-pet-avatar">
                                            <div class="bd-pet-details">
                                                <div class="bd-pet-meta">
                                                    <p class="bd-pet-name">Bella - Rabbit <span class="bd-pet-breed">(Mini Lop)</span></p>

                                                    <span>
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                                                            <circle cx="7" cy="4.5" r="3.25" stroke="#9D9B98" stroke-width="1" />
                                                            <path d="M7 7.75V13M4.25 10.75H9.75" stroke="#9D9B98" stroke-width="1" stroke-linecap="round" />
                                                        </svg>
                                                        Female
                                                    </span>
                                                    <span>
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="16" viewBox="0 0 15 16" fill="none">
                                                            <path d="M4.7373 3.14703C4.7373 3.84907 5.01619 4.52235 5.51261 5.01876C6.00903 5.51518 6.68232 5.79406 7.38436 5.79406C8.08641 5.79406 8.7597 5.51518 9.25612 5.01876C9.75254 4.52235 10.0314 3.84907 10.0314 3.14703C10.0314 2.44499 9.75254 1.77171 9.25612 1.2753C8.7597 0.778883 8.08641 0.5 7.38436 0.5C6.68232 0.5 6.00903 0.778883 5.51261 1.2753C5.01619 1.77171 4.7373 2.44499 4.7373 3.14703Z" stroke="#9D9B98" stroke-linecap="round" stroke-linejoin="round" />
                                                            <path d="M2.8269 5.79419H11.9416C12.1482 5.79416 12.3483 5.86665 12.507 5.99904C12.6657 6.13142 12.7728 6.31529 12.8098 6.51859L14.2542 14.4597C14.2774 14.5869 14.2723 14.7176 14.2394 14.8425C14.2064 14.9675 14.1464 15.0838 14.0636 15.183C13.9807 15.2822 13.8771 15.3621 13.76 15.4168C13.643 15.4716 13.5153 15.5 13.386 15.5H1.38249C1.25323 15.5 1.12554 15.4716 1.00846 15.4168C0.891377 15.3621 0.78776 15.2822 0.704935 15.183C0.62211 15.0838 0.5621 14.9675 0.52915 14.8425C0.496199 14.7176 0.491113 14.5869 0.514251 14.4597L1.95866 6.51859C1.99565 6.31529 2.10282 6.13142 2.26149 5.99904C2.42016 5.86665 2.62026 5.79416 2.8269 5.79419Z" stroke="#9D9B98" stroke-linecap="round" stroke-linejoin="round" />
                                                        </svg>
                                                        5 kg
                                                    </span>
                                                    <span>
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="16" viewBox="0 0 15 16" fill="none">
                                                            <path d="M13.5905 8.11123L13.9601 6.73016C14.3918 5.1182 14.6084 4.31257 14.4462 3.61489C14.3176 3.0641 14.0285 2.56382 13.6155 2.17734C13.093 1.68768 12.2866 1.4718 10.6747 1.04003C9.0627 0.607553 8.25636 0.391671 7.55939 0.55394C7.0086 0.682549 6.50833 0.971618 6.12185 1.38458C5.70224 1.83207 5.4835 2.48758 5.15824 3.67851L4.98382 4.32544L4.61425 5.70651C4.18177 7.31847 3.96589 8.1241 4.12816 8.82178C4.25677 9.37257 4.54584 9.87285 4.9588 10.2593C5.48135 10.749 6.28769 10.9649 7.89966 11.3974C9.35221 11.7862 10.1507 12 10.8048 11.9192C10.8763 11.9101 10.9463 11.8977 11.0149 11.882C11.5655 11.7538 12.0658 11.4652 12.4525 11.0528C12.9421 10.5295 13.158 9.7232 13.5905 8.11123Z" stroke="#9D9B98" />
                                                            <path d="M10.8047 11.9191C10.6553 12.3769 10.3927 12.7895 10.0413 13.1186C9.51875 13.6083 8.71241 13.8242 7.10045 14.2559C5.48848 14.6877 4.68214 14.9043 3.98517 14.7413C3.43447 14.6129 2.9342 14.3241 2.54763 13.9114C2.05796 13.3888 1.84137 12.5825 1.4096 10.9705L1.04003 9.58946C0.607553 7.9775 0.391671 7.17116 0.55394 6.47419C0.682549 5.9234 0.971618 5.42313 1.38458 5.03665C1.90713 4.54698 2.71347 4.3311 4.32544 3.89862C4.62948 3.81665 4.90708 3.74302 5.15823 3.67773" stroke="#9D9B98" />
                                                            <path d="M7.48902 6.21899L10.9417 7.144M6.93359 8.2906L9.0052 8.84532" stroke="#9D9B98" stroke-linecap="round" />
                                                        </svg>
                                                        Nervous around hair-dryers
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="bd-review-prompt">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 13 13" fill="none">
                                                <path d="M6.25 11.75C9.275 11.75 11.75 9.275 11.75 6.25C11.75 3.225 9.275 0.75 6.25 0.75C3.225 0.75 0.75 3.225 0.75 6.25C0.75 9.275 3.225 11.75 6.25 11.75Z" stroke="#FFBF61" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                <path d="M3.9126 6.25023L5.4691 7.80673L8.5876 4.69373" stroke="#FFBF61" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                            <p>How did it go? Leave a <a href="#" data-modal-open="review-modal">review</a> to help other pet owners, or rebook the same service.</p>
                                        </div>

                                        <div class="bd-total-row">
                                            <span class="bd-total-label">Total Paid</span>
                                            <span class="bd-total-amount">£48.00</span>
                                        </div>

                                        <div class="bd-footer bd-footer--completed">
                                            <a href="<?= BASE_URL ?>messages_notification/messages.php" class="bd-btn bd-btn-message">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="15" viewBox="0 0 16 15" fill="none">
                                                    <path d="M8 0.5C12.2044 0.5 15.5 3.48321 15.5 7.03223C15.5 10.4703 12.4072 13.3772 8.3916 13.5557L8 13.5645H7.99902C7.251 13.5661 6.50584 13.4687 5.7832 13.2744L5.59766 13.2246L5.42676 13.3115C5.00713 13.5247 4.13103 13.9084 2.72363 14.2393L2.08691 14.377C1.99742 14.3948 1.9071 14.4082 1.81738 14.4248C1.85085 14.3352 1.88498 14.2458 1.91602 14.1553L1.91895 14.1455C2.17667 13.3938 2.38924 12.5229 2.46777 11.7012L2.49023 11.4678L2.3252 11.3008C1.18119 10.1487 0.500003 8.65476 0.5 7.03223C0.5 3.48321 3.79561 0.5 8 0.5Z" stroke="#3B3731" />
                                                </svg>
                                                Message groomer
                                            </a>
                                            <div class="bd-footer-actions">
                                                <button type="button" class="bd-btn bd-btn-review" data-modal-open="review-modal">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="14" viewBox="0 0 15 14" fill="none">
                                                        <path d="M6.12774 0.705048C6.41791 -0.235029 7.74859 -0.235029 8.03877 0.705048L8.9985 3.81427C9.12789 4.23343 9.51534 4.51933 9.95402 4.51933H13.1646C14.1209 4.51933 14.5317 5.73274 13.7721 6.31366L11.0879 8.36647C10.7553 8.62087 10.6164 9.0556 10.7399 9.45574L11.7441 12.7091C12.0313 13.6395 10.9545 14.3899 10.1811 13.7983L7.69074 11.8938C7.33217 11.6195 6.83433 11.6195 6.47576 11.8938L3.98542 13.7983C3.21196 14.3899 2.13522 13.6395 2.42242 12.7091L3.42663 9.45574C3.55014 9.0556 3.41124 8.62087 3.0786 8.36647L0.394412 6.31365C-0.365175 5.73274 0.0456378 4.51933 1.0019 4.51933H4.21249C4.65116 4.51933 5.03862 4.23343 5.168 3.81427L6.12774 0.705048Z" fill="#FFBF61" />
                                                    </svg>
                                                    Write a review
                                                </button>
                                                <a href="<?= BASE_URL ?>profiles/groomer/groomer_profile.php" class="bd-btn bd-btn-rebook">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                                        <path d="M2.2312 15.4953V12.6124H5.11403" stroke="#6FA0C3" stroke-linecap="round" stroke-linejoin="round" />
                                                        <path d="M15.3656 6.62252C15.6715 8.25452 15.4269 9.94189 14.6702 11.4199C13.9135 12.8978 12.6875 14.0827 11.1846 14.7887C9.68175 15.4946 7.98704 15.6817 6.3664 15.3204C4.74575 14.9592 3.2909 14.0701 2.23013 12.7927M0.628303 9.37748C0.322432 7.74548 0.567036 6.05811 1.32373 4.58014C2.08043 3.10218 3.3064 1.91725 4.80927 1.2113C6.31214 0.505355 8.00686 0.318331 9.6275 0.679579C11.2481 1.04083 12.703 1.9299 13.7638 3.2073" stroke="#6FA0C3" stroke-linecap="round" stroke-linejoin="round" />
                                                        <path d="M13.7626 0.504883V3.38771H10.8798" stroke="#6FA0C3" stroke-linecap="round" stroke-linejoin="round" />
                                                    </svg>
                                                    Rebook
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Cancelled Groom Booking Modal -->

                            <div class="modal" id="view_booking_groom_cancelled_modal">
                                <div class="modal-content size bd-modal-content">
                                    <div class="bd-modal">
                                        <button class="bd-close" type="button" data-modal-close aria-label="Close">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 36 36" fill="none">
                                                <circle cx="18" cy="18" r="17.5" stroke="#3B3731" />
                                                <path d="M12.8 24.0008L24 12.8008M12.8 12.8008L24 24.0008" stroke="#3B3731" stroke-width="1.5" stroke-linecap="round" />
                                            </svg>
                                        </button>

                                        <div class="bd-header">
                                            <h1>Booking Details</h1>
                                            <p>Your cancelled booking</p>
                                        </div>
                                        <hr class="bd-divider">

                                        <div class="bd-status-bar">
                                            <span class="bd-status-badge bd-status-badge--cancelled">
                                                <span class="bd-status-dot"></span>
                                                Cancelled
                                            </span>
                                            <div class="bd-ref-actions">
                                                <span class="bd-ref-id">FG-10294</span>
                                                <a href="#" class="bd-pdf-link">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="13" height="15" viewBox="0 0 13 15" fill="none">
                                                        <path d="M3.07717 14.5H9.27418C9.95769 14.5 10.6132 14.2209 11.0965 13.7242C11.5798 13.2275 11.8514 12.5538 11.8514 11.8514V7.66649C11.8516 6.96411 11.5804 6.29039 11.0973 5.79351L6.70216 1.27568C6.46282 1.02973 6.1787 0.834645 5.86601 0.701554C5.55331 0.568463 5.21817 0.499975 4.87972 0.5H3.07717C2.39367 0.5 1.73815 0.779053 1.25484 1.27577C0.771523 1.77249 0.5 2.44618 0.5 3.14865V11.8514C0.5 12.5538 0.771523 13.2275 1.25484 13.7242C1.73815 14.2209 2.39367 14.5 3.07717 14.5Z" stroke="#3B3731" stroke-linecap="round" stroke-linejoin="round" />
                                                        <path d="M5.9458 0.772461V5.0557C5.9458 5.45711 6.10096 5.84208 6.37714 6.12592C6.65332 6.40976 7.0279 6.56922 7.41847 6.56922H11.5876" stroke="#3B3731" stroke-linecap="round" stroke-linejoin="round" />
                                                        <path d="M2.67822 10.9055V10.1488M2.67822 10.1488V8.63525H3.41456C3.60985 8.63525 3.79714 8.71498 3.93523 8.8569C4.07332 8.99882 4.15089 9.19131 4.15089 9.39201C4.15089 9.59272 4.07332 9.7852 3.93523 9.92712C3.79714 10.069 3.60985 10.1488 3.41456 10.1488H2.67822ZM8.56891 10.9055V9.95958M8.56891 9.95958V8.63525H9.67341M8.56891 9.95958H9.67341M5.62357 10.9055V8.63525H5.99173C6.28467 8.63525 6.5656 8.75485 6.77274 8.96773C6.97987 9.18061 7.09624 9.46933 7.09624 9.77039C7.09624 10.0714 6.97987 10.3602 6.77274 10.5731C6.5656 10.7859 6.28467 10.9055 5.99173 10.9055H5.62357Z" stroke="#3B3731" stroke-linecap="round" stroke-linejoin="round" />
                                                    </svg>
                                                    Download PDF
                                                </a>
                                            </div>
                                        </div>

                                        <div class="bd-cancel-notice">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22" fill="none" aria-hidden="true">
                                                <circle cx="11" cy="11" r="10" stroke="#9D9B98" stroke-width="1.4" />
                                                <path d="M7.5 7.5L14.5 14.5M14.5 7.5L7.5 14.5" stroke="#9D9B98" stroke-width="1.4" stroke-linecap="round" />
                                            </svg>
                                            <div class="bd-cancel-notice-text">
                                                <p class="bd-cancel-notice-title">You cancelled this booking &bull; 19 Oct 2025</p>
                                                <p class="bd-cancel-notice-sub">Cancelled more than 24 hours before the appointment.</p>
                                            </div>
                                        </div>

                                        <div class="bd-groomer-card">
                                            <div class="bd-groomer-left">
                                                <div class="bd-groomer-avatar-wrap">
                                                    <img src="<?= BASE_URL ?>/assets/images/card1.png" alt="Sarah's Grooming Studio" class="bd-groomer-avatar">
                                                    <div class="bd-verified-badge" title="Verified">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="22" viewBox="0 0 30 33" fill="none">
                                                            <ellipse cx="15.873" cy="16.5256" rx="9.3645" ry="8.81365" fill="white"></ellipse>
                                                            <path d="M15.44 0.185076C15.1841 0.0638192 14.9099 0 14.6235 0C14.3372 0 14.063 0.0638192 13.8071 0.185076L2.3337 5.28423C0.993208 5.87775 -0.00606541 7.26263 2.77146e-05 8.93469C0.0304934 15.2656 2.51649 26.8487 13.015 32.1138C14.0325 32.6244 15.2146 32.6244 16.2321 32.1138C26.7306 26.8487 29.2166 15.2656 29.247 8.93469C29.2531 7.26263 28.2539 5.87775 26.9134 5.28423L15.44 0.185076ZM8.82897 18.2651C9.12144 18.3416 9.43219 18.3799 9.74903 18.3799C11.8999 18.3799 13.6486 16.5483 13.6486 14.2955V10.2111H16.3418C17.0791 10.2111 17.7554 10.645 18.0844 11.3407L18.5231 12.2533H22.4227C22.9589 12.2533 23.3976 12.7128 23.3976 13.2744V15.3166C23.3976 18.1374 21.2163 20.4222 18.5231 20.4222H15.5984V23.6578C15.5984 24.1237 15.2389 24.5066 14.7881 24.5066C14.6784 24.5066 14.5687 24.4811 14.4712 24.4364L8.45729 21.7368C8.05514 21.5581 7.79923 21.1433 7.79923 20.6902C7.79923 20.5115 7.83579 20.3392 7.915 20.1796L8.82897 18.2651ZM8.77413 10.2111H11.6988V14.2955C11.6988 15.4251 10.8275 16.3377 9.74903 16.3377C8.67055 16.3377 7.79923 15.4251 7.79923 14.2955V11.2322C7.79923 10.6706 8.23794 10.2111 8.77413 10.2111ZM16.5733 13.2744C16.5733 13.0036 16.4706 12.7439 16.2878 12.5524C16.105 12.3609 15.857 12.2533 15.5984 12.2533C15.3399 12.2533 15.0919 12.3609 14.9091 12.5524C14.7262 12.7439 14.6235 13.0036 14.6235 13.2744C14.6235 13.5452 14.7262 13.8049 14.9091 13.9964C15.0919 14.1879 15.3399 14.2955 15.5984 14.2955C15.857 14.2955 16.105 14.1879 16.2878 13.9964C16.4706 13.8049 16.5733 13.5452 16.5733 13.2744Z" fill="#C9DDA0"></path>
                                                        </svg>
                                                    </div>
                                                </div>
                                                <div class="bd-groomer-identity">
                                                    <div class="bd-groomer-title-row">
                                                        <h3>Sarah's Grooming Studio</h3>
                                                        <span class="bd-service-badge">Home Visits</span>
                                                    </div>
                                                    <p class="bd-groomer-name">Sarah W.</p>
                                                </div>
                                            </div>
                                            <div class="bd-groomer-right">
                                                <div class="bd-groomer-badges">
                                                    <span class="bd-badge bd-badge-popular">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="10" height="9" viewBox="0 0 10 9" fill="none">
                                                            <path d="M2 8.99999C1.85833 8.99999 1.73967 8.95199 1.644 8.85599C1.54833 8.75999 1.50033 8.64133 1.5 8.49999C1.49967 8.35866 1.54767 8.23999 1.644 8.14399C1.74033 8.04799 1.859 7.99999 2 7.99999H8C8.14166 7.99999 8.2605 8.04799 8.3565 8.14399C8.4525 8.23999 8.50033 8.35866 8.5 8.49999C8.49966 8.64133 8.45166 8.76016 8.356 8.85649C8.26033 8.95283 8.14166 9.00066 8 8.99999H2ZM2.35 7.24999C2.10833 7.24999 1.89383 7.17083 1.7065 7.0125C1.51917 6.85416 1.4045 6.65416 1.3625 6.4125L0.862501 3.2375C0.845834 3.2375 0.827167 3.23967 0.806501 3.244C0.785834 3.24833 0.767001 3.25033 0.750001 3.25C0.541667 3.25 0.364668 3.17717 0.219001 3.0315C0.0733344 2.88583 0.000334469 2.70867 1.13636e-06 2.5C-0.000332197 2.29133 0.0726677 2.11433 0.219001 1.969C0.365334 1.82367 0.542334 1.75067 0.750001 1.75C0.957667 1.74933 1.13483 1.82233 1.2815 1.969C1.42817 2.11567 1.501 2.29267 1.5 2.5C1.5 2.55833 1.49367 2.6125 1.481 2.6625C1.46833 2.7125 1.45383 2.75833 1.4375 2.8L3 3.5L4.5625 1.3625C4.47083 1.29583 4.39583 1.20833 4.3375 1.1C4.27917 0.991667 4.25 0.875 4.25 0.75C4.25 0.541667 4.323 0.364501 4.469 0.218501C4.615 0.0725011 4.792 -0.000332194 5 1.13895e-06C5.208 0.000334472 5.38516 0.0733344 5.5315 0.219001C5.67783 0.364667 5.75066 0.541667 5.75 0.75C5.75 0.875 5.72083 0.991667 5.6625 1.1C5.60416 1.20833 5.52916 1.29583 5.4375 1.3625L7 3.5L8.5625 2.8C8.54583 2.75833 8.53116 2.7125 8.5185 2.6625C8.50583 2.6125 8.49966 2.55833 8.5 2.5C8.5 2.29167 8.573 2.1145 8.719 1.9685C8.865 1.8225 9.042 1.74967 9.25 1.75C9.458 1.75033 9.63516 1.82333 9.7815 1.969C9.92783 2.11467 10.0007 2.29167 10 2.5C9.99933 2.70833 9.92649 2.8855 9.7815 3.0315C9.6365 3.1775 9.45933 3.25033 9.25 3.25C9.23333 3.25 9.21466 3.248 9.194 3.244C9.17333 3.24 9.1545 3.23783 9.1375 3.2375L8.6375 6.4125C8.59583 6.65416 8.48133 6.85416 8.294 7.0125C8.10666 7.17083 7.892 7.24999 7.65 7.24999H2.35ZM2.35 6.25H7.65L7.975 4.1625L7.4 4.4125C7.18333 4.50416 6.9625 4.52083 6.7375 4.4625C6.5125 4.40416 6.32916 4.27916 6.1875 4.0875L5 2.45L3.8125 4.0875C3.67083 4.27916 3.4875 4.40416 3.2625 4.4625C3.0375 4.52083 2.81667 4.50416 2.6 4.4125L2.025 4.1625L2.35 6.25Z" fill="white" />
                                                        </svg>
                                                        Popular
                                                    </span>
                                                    <span class="bd-badge bd-badge-rated">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="9" height="11" viewBox="0 0 9 11" fill="none">
                                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M6.41322 7.89398C6.44215 7.34453 6.31579 6.79804 6.0486 6.31706C5.78142 5.83608 5.3842 5.44005 4.90243 5.1743C4.81687 5.12481 4.71545 5.11047 4.61952 5.1343C4.5236 5.15813 4.44068 5.21827 4.38824 5.30205L3.77553 6.28276L3.26579 5.66624C3.23778 5.63245 3.20308 5.60482 3.16387 5.5851C3.12466 5.56538 3.08178 5.554 3.03795 5.55167C2.99413 5.54934 2.95029 5.55612 2.90921 5.57157C2.86813 5.58702 2.83069 5.61082 2.79926 5.64146C2.49919 5.93182 2.2648 6.2831 2.11186 6.67164C1.95892 7.06019 1.89098 7.47698 1.91262 7.89398C1.91262 8.49072 2.14967 9.06301 2.57162 9.48496C2.99358 9.90692 3.56587 10.144 4.1626 10.144C4.75934 10.144 5.33163 9.90692 5.75358 9.48496C6.17554 9.06301 6.41259 8.49072 6.41259 7.89398M3.01028 6.35586L2.97087 6.40798C2.67197 6.82551 2.52221 7.33145 2.54566 7.84441L2.54757 7.88191C2.54757 8.31007 2.71766 8.7207 3.02042 9.02346C3.32317 9.32621 3.7338 9.4963 4.16197 9.4963C4.59013 9.4963 5.00076 9.32621 5.30352 9.02346C5.60628 8.7207 5.77636 8.31007 5.77636 7.88191L5.77827 7.84504C5.78272 7.80373 5.88187 6.6673 4.84205 5.89442L4.79056 5.85692L4.12701 6.91835C4.09497 6.96954 4.05123 7.01239 3.99939 7.04337C3.94755 7.07435 3.8891 7.09258 3.82884 7.09655C3.76858 7.10052 3.70823 7.09013 3.65278 7.06622C3.59732 7.04231 3.54834 7.00557 3.50985 6.95903L3.01028 6.35586Z" fill="#FEFEFE" />
                                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M3.79701 0.30821C3.81025 0.23997 3.84191 0.176658 3.88858 0.125138C3.93524 0.0736173 3.99512 0.0358558 4.06172 0.0159479C4.12832 -0.00396001 4.1991 -0.00525449 4.26638 0.0122049C4.33367 0.0296642 4.39489 0.0652111 4.4434 0.114991C4.56671 0.240837 4.80378 0.489988 5.04467 0.777274C5.28111 1.05884 5.53916 1.39761 5.68788 1.69951C5.8328 1.99443 5.98661 2.37578 6.10801 2.69421L6.67305 1.75354C6.70456 1.701 6.74826 1.65683 6.80046 1.62476C6.85265 1.59269 6.91181 1.57367 6.97292 1.56931C7.03402 1.56494 7.09528 1.57536 7.1515 1.59969C7.20773 1.62401 7.25727 1.66152 7.29592 1.70905C8.09867 2.70057 8.49846 3.76263 8.6974 4.57365C8.79718 4.97979 8.8474 5.32491 8.87282 5.57025C8.88576 5.69278 8.89424 5.81574 8.89824 5.93889V5.97131C8.89824 8.4482 6.93364 10.4649 4.44785 10.4649C1.96206 10.4649 0 8.44756 0 5.97004C0 5.28805 0.322244 3.68192 1.27563 2.36498C1.31266 2.31422 1.36166 2.27341 1.41826 2.24615C1.47487 2.2189 1.53734 2.20605 1.60011 2.20876C1.66287 2.21146 1.724 2.22963 1.77806 2.26166C1.83211 2.29368 1.87741 2.33856 1.90994 2.39231L2.55507 3.46709C2.75083 3.16073 3.01269 2.73044 3.21163 2.3332C3.49765 1.76117 3.72455 0.682572 3.79701 0.308845M4.3201 0.912655C4.20506 1.42113 4.01501 2.14697 3.77985 2.61858C3.46714 3.24336 3.0165 3.9298 2.86142 4.16051C2.82554 4.21345 2.77693 4.25651 2.72005 4.28574C2.66317 4.31497 2.59986 4.32943 2.53593 4.32778C2.472 4.32614 2.40952 4.30844 2.35422 4.27632C2.29892 4.24421 2.25258 4.1987 2.21948 4.14399L1.57118 3.06476C0.87457 4.19166 0.635589 5.45839 0.635589 5.97131C0.635589 8.10561 2.32244 9.82806 4.44785 9.82806C6.57326 9.82806 8.26265 8.10561 8.26265 5.97131V5.95351L8.26011 5.88995C8.25568 5.80484 8.24911 5.71986 8.24041 5.63508C8.20712 5.3287 8.15362 5.02487 8.08024 4.72555C7.87826 3.89157 7.52027 3.10334 7.02516 2.40248L6.38068 3.47535C6.34338 3.53732 6.28925 3.58743 6.22459 3.61985C6.15993 3.65227 6.08739 3.66566 6.01542 3.65847C5.94344 3.65128 5.87499 3.6238 5.81802 3.57923C5.76105 3.53466 5.71791 3.47483 5.6936 3.40671C5.59064 3.11815 5.33831 2.42917 5.11713 1.98044C5.00463 1.751 4.78916 1.46117 4.55781 1.18596C4.4801 1.09353 4.40086 1.00242 4.3201 0.912655Z" fill="#FEFEFE" />
                                                        </svg>
                                                        Top Rated
                                                    </span>
                                                </div>
                                                <div class="bd-groomer-stats">
                                                    <span>
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="10" height="14" viewBox="0 0 10 14" fill="none">
                                                            <path d="M5 6.65C4.5264 6.65 4.0722 6.46563 3.73731 6.13744C3.40242 5.80925 3.21429 5.36413 3.21429 4.9C3.21429 4.43587 3.40242 3.99075 3.73731 3.66256C4.0722 3.33437 4.5264 3.15 5 3.15C5.4736 3.15 5.9278 3.33437 6.26269 3.66256C6.59758 3.99075 6.78571 4.43587 6.78571 4.9C6.78571 5.12981 6.73953 5.35738 6.64979 5.5697C6.56004 5.78202 6.42851 5.97493 6.26269 6.13744C6.09687 6.29994 5.90002 6.42884 5.68336 6.51679C5.46671 6.60473 5.2345 6.65 5 6.65ZM5 0C3.67392 0 2.40215 0.516248 1.46447 1.43518C0.526784 2.3541 0 3.60044 0 4.9C0 8.575 5 14 5 14C5 14 10 8.575 10 4.9C10 3.60044 9.47322 2.3541 8.53553 1.43518C7.59785 0.516248 6.32608 0 5 0Z" fill="#FFC97A" />
                                                        </svg>
                                                        2.5 mi
                                                    </span>
                                                    <span>
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                                                            <path d="M6.12956 0.660476C6.40354 -0.220161 7.59647 -0.220158 7.87045 0.660479L8.89548 3.95519C9.01801 4.34902 9.36942 4.61566 9.76593 4.61566H13.083C13.9696 4.61566 14.3383 5.80055 13.621 6.34481L10.9374 8.38106C10.6166 8.62446 10.4824 9.0559 10.6049 9.44973L11.63 12.7444C11.9039 13.6251 10.9388 14.3574 10.2215 13.8131L7.53797 11.7769C7.21719 11.5335 6.78282 11.5335 6.46204 11.7769L3.77846 13.8131C3.06117 14.3574 2.09607 13.6251 2.37005 12.7444L3.39508 9.44973C3.51761 9.0559 3.38338 8.62446 3.0626 8.38106L0.37903 6.34481C-0.338258 5.80055 0.0303816 4.61566 0.916998 4.61566H4.23408C4.63058 4.61566 4.98199 4.34902 5.10452 3.95519L6.12956 0.660476Z" fill="#FFC97A" />
                                                        </svg>
                                                        4.3 <span class="bd-muted">(20 reviews)</span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                        <p class="bd-section-label">APPOINTMENT</p>
                                        <div class="bd-appointment-grid">
                                            <div class="bd-tile">
                                                <div class="bd-tile-label">
                                                    Service
                                                </div>
                                                <p class="bd-tile-value">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="17" viewBox="0 0 16 17" fill="none">
                                                        <path d="M4.94591 11.5544C6.23114 12.8397 9.35699 11.798 11.9274 9.22713C14.4983 6.65667 15.54 3.53082 14.2548 2.24559M8.72754 1.37259L9.30927 1.95473M6.6915 3.40904L7.27322 3.99077M4.9455 5.73636L5.52722 6.31809M4.36377 8.6454L4.9455 9.22713M11.9274 0.5L12.5092 1.08173M11.3457 3.99118L12.5092 5.15463M9.30968 6.02763L10.4731 7.19109M6.98236 7.77281L8.14581 8.93627" stroke="#3B3731" stroke-linecap="round" stroke-linejoin="round" />
                                                        <path d="M4.94547 13.2998C5.42747 12.8178 5.42747 12.0364 4.94548 11.5544C4.46348 11.0724 3.68202 11.0724 3.20003 11.5544L0.872775 13.8816C0.390784 14.3636 0.390784 15.1451 0.872775 15.6271C1.35477 16.1091 2.13623 16.1091 2.61822 15.6271L4.94547 13.2998Z" stroke="#3B3731" stroke-linecap="round" stroke-linejoin="round" />
                                                    </svg>
                                                    Bath &amp; Brush
                                                </p>
                                            </div>
                                            <div class="bd-tile">
                                                <div class="bd-tile-label">
                                                    Date
                                                </div>
                                                <p class="bd-tile-value">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="19" height="17" viewBox="0 0 19 17" fill="none">
                                                        <path d="M0.5 8.29554C0.5 5.20139 0.5 3.6539 1.50457 2.69308C2.50914 1.73227 4.12486 1.73145 7.35714 1.73145H10.7857C14.018 1.73145 15.6346 1.73145 16.6383 2.69308C17.642 3.65472 17.6429 5.20139 17.6429 8.29554V9.93656C17.6429 13.0307 17.6429 14.5782 16.6383 15.539C15.6337 16.4998 14.018 16.5007 10.7857 16.5007H7.35714C4.12486 16.5007 2.50829 16.5007 1.50457 15.539C0.500857 14.5774 0.5 13.0307 0.5 9.93656V8.29554Z" stroke="#3B3731" />
                                                        <path d="M4.78561 1.73077V0.5M13.357 1.73077V0.5M0.928467 5.83333H17.2142" stroke="#3B3731" stroke-linecap="round" />
                                                        <path d="M14.2139 12.3975C14.2139 12.6151 14.1236 12.8238 13.9629 12.9777C13.8021 13.1315 13.5841 13.218 13.3568 13.218C13.1295 13.218 12.9114 13.1315 12.7507 12.9777C12.59 12.8238 12.4997 12.6151 12.4997 12.3975C12.4997 12.1799 12.59 11.9712 12.7507 11.8173C12.9114 11.6634 13.1295 11.577 13.3568 11.577C13.5841 11.577 13.8021 11.6634 13.9629 11.8173C14.1236 11.9712 14.2139 12.1799 14.2139 12.3975ZM14.2139 9.11543C14.2139 9.33305 14.1236 9.54175 13.9629 9.69562C13.8021 9.8495 13.5841 9.93595 13.3568 9.93595C13.1295 9.93595 12.9114 9.8495 12.7507 9.69562C12.59 9.54175 12.4997 9.33305 12.4997 9.11543C12.4997 8.89782 12.59 8.68912 12.7507 8.53524C12.9114 8.38137 13.1295 8.29492 13.3568 8.29492C13.5841 8.29492 13.8021 8.38137 13.9629 8.53524C14.1236 8.68912 14.2139 8.89782 14.2139 9.11543ZM9.92822 12.3975C9.92822 12.6151 9.83792 12.8238 9.67717 12.9777C9.51643 13.1315 9.29841 13.218 9.07108 13.218C8.84375 13.218 8.62573 13.1315 8.46499 12.9777C8.30424 12.8238 8.21394 12.6151 8.21394 12.3975C8.21394 12.1799 8.30424 11.9712 8.46499 11.8173C8.62573 11.6634 8.84375 11.577 9.07108 11.577C9.29841 11.577 9.51643 11.6634 9.67717 11.8173C9.83792 11.9712 9.92822 12.1799 9.92822 12.3975ZM9.92822 9.11543C9.92822 9.33305 9.83792 9.54175 9.67717 9.69562C9.51643 9.8495 9.29841 9.93595 9.07108 9.93595C8.84375 9.93595 8.62573 9.8495 8.46499 9.69562C8.30424 9.54175 8.21394 9.33305 8.21394 9.11543C8.21394 8.89782 8.30424 8.68912 8.46499 8.53524C8.62573 8.38137 8.84375 8.29492 9.07108 8.29492C9.29841 8.29492 9.51643 8.38137 9.67717 8.53524C9.83792 8.68912 9.92822 8.89782 9.92822 9.11543ZM5.64251 12.3975C5.64251 12.6151 5.5522 12.8238 5.39146 12.9777C5.23071 13.1315 5.01269 13.218 4.78537 13.218C4.55804 13.218 4.34002 13.1315 4.17927 12.9777C4.01853 12.8238 3.92822 12.6151 3.92822 12.3975C3.92822 12.1799 4.01853 11.9712 4.17927 11.8173C4.34002 11.6634 4.55804 11.577 4.78537 11.577C5.01269 11.577 5.23071 11.6634 5.39146 11.8173C5.5522 11.9712 5.64251 12.1799 5.64251 12.3975ZM5.64251 9.11543C5.64251 9.33305 5.5522 9.54175 5.39146 9.69562C5.23071 9.8495 5.01269 9.93595 4.78537 9.93595C4.55804 9.93595 4.34002 9.8495 4.17927 9.69562C4.01853 9.54175 3.92822 9.33305 3.92822 9.11543C3.92822 8.89782 4.01853 8.68912 4.17927 8.53524C4.34002 8.38137 4.55804 8.29492 4.78537 8.29492C5.01269 8.29492 5.23071 8.38137 5.39146 8.53524C5.5522 8.68912 5.64251 8.89782 5.64251 9.11543Z" fill="#3B3731" />
                                                    </svg>
                                                    Wed, 18 Dec 2025
                                                </p>
                                            </div>
                                            <div class="bd-tile">
                                                <div class="bd-tile-label">
                                                    Time
                                                </div>
                                                <p class="bd-tile-value">
                                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
                                                        <circle cx="8" cy="8" r="6" stroke="#3B3731" stroke-width="1.5" />
                                                        <path d="M8 4.5V8L10.5 10" stroke="#3B3731" stroke-width="1.5" stroke-linecap="round" />
                                                    </svg>
                                                    14:30 - 15:30
                                                </p>
                                            </div>
                                            <div class="bd-tile">
                                                <div class="bd-tile-label">
                                                    Location
                                                </div>
                                                <p class="bd-tile-value">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="16" viewBox="0 0 12 16" fill="none">
                                                        <path d="M6 0.5C7.4694 0.5 8.87214 1.04525 9.90137 2.00586C10.9293 2.96529 11.4999 4.25871 11.5 5.59961C11.5 7.10011 10.6408 8.95946 9.51855 10.7236C8.41048 12.4655 7.10434 14.0263 6.32227 14.9082C6.14625 15.1067 5.85375 15.1067 5.67773 14.9082C4.89566 14.0263 3.58952 12.4655 2.48145 10.7236C1.35919 8.95946 0.5 7.10011 0.5 5.59961C0.500111 4.25871 1.07068 2.96529 2.09863 2.00586C3.12786 1.04525 4.53061 0.5 6 0.5ZM6 3.09961C5.30978 3.09961 4.64141 3.35564 4.14355 3.82031C3.64466 4.28597 3.35753 4.92517 3.35742 5.59961C3.35742 6.27422 3.64453 6.91413 4.14355 7.37988C4.64141 7.84453 5.30979 8.09961 6 8.09961C6.34236 8.09961 6.68202 8.03695 7 7.91406C7.31807 7.7911 7.60965 7.61022 7.85645 7.37988C8.10326 7.14952 8.30086 6.87397 8.43652 6.56836C8.57224 6.26256 8.64258 5.93289 8.64258 5.59961C8.64247 4.92517 8.35534 4.28597 7.85645 3.82031C7.35859 3.35564 6.69022 3.09961 6 3.09961Z" stroke="#3B3731" />
                                                    </svg>
                                                    At your home
                                                </p>
                                            </div>
                                        </div>

                                        <p class="bd-section-label">PET</p>
                                        <div class="bd-pet-card">
                                            <img src="<?= BASE_URL ?>/assets/images/pet_details_1.png" alt="Bella" class="bd-pet-avatar">
                                            <div class="bd-pet-details">
                                                <div class="bd-pet-meta">
                                                    <p class="bd-pet-name">Bella - Rabbit <span class="bd-pet-breed">(Mini Lop)</span></p>

                                                    <span>
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                                                            <circle cx="7" cy="4.5" r="3.25" stroke="#9D9B98" stroke-width="1" />
                                                            <path d="M7 7.75V13M4.25 10.75H9.75" stroke="#9D9B98" stroke-width="1" stroke-linecap="round" />
                                                        </svg>
                                                        Female
                                                    </span>
                                                    <span>
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="16" viewBox="0 0 15 16" fill="none">
                                                            <path d="M4.7373 3.14703C4.7373 3.84907 5.01619 4.52235 5.51261 5.01876C6.00903 5.51518 6.68232 5.79406 7.38436 5.79406C8.08641 5.79406 8.7597 5.51518 9.25612 5.01876C9.75254 4.52235 10.0314 3.84907 10.0314 3.14703C10.0314 2.44499 9.75254 1.77171 9.25612 1.2753C8.7597 0.778883 8.08641 0.5 7.38436 0.5C6.68232 0.5 6.00903 0.778883 5.51261 1.2753C5.01619 1.77171 4.7373 2.44499 4.7373 3.14703Z" stroke="#9D9B98" stroke-linecap="round" stroke-linejoin="round" />
                                                            <path d="M2.8269 5.79419H11.9416C12.1482 5.79416 12.3483 5.86665 12.507 5.99904C12.6657 6.13142 12.7728 6.31529 12.8098 6.51859L14.2542 14.4597C14.2774 14.5869 14.2723 14.7176 14.2394 14.8425C14.2064 14.9675 14.1464 15.0838 14.0636 15.183C13.9807 15.2822 13.8771 15.3621 13.76 15.4168C13.643 15.4716 13.5153 15.5 13.386 15.5H1.38249C1.25323 15.5 1.12554 15.4716 1.00846 15.4168C0.891377 15.3621 0.78776 15.2822 0.704935 15.183C0.62211 15.0838 0.5621 14.9675 0.52915 14.8425C0.496199 14.7176 0.491113 14.5869 0.514251 14.4597L1.95866 6.51859C1.99565 6.31529 2.10282 6.13142 2.26149 5.99904C2.42016 5.86665 2.62026 5.79416 2.8269 5.79419Z" stroke="#9D9B98" stroke-linecap="round" stroke-linejoin="round" />
                                                        </svg>
                                                        5 kg
                                                    </span>
                                                    <span>
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="16" viewBox="0 0 15 16" fill="none">
                                                            <path d="M13.5905 8.11123L13.9601 6.73016C14.3918 5.1182 14.6084 4.31257 14.4462 3.61489C14.3176 3.0641 14.0285 2.56382 13.6155 2.17734C13.093 1.68768 12.2866 1.4718 10.6747 1.04003C9.0627 0.607553 8.25636 0.391671 7.55939 0.55394C7.0086 0.682549 6.50833 0.971618 6.12185 1.38458C5.70224 1.83207 5.4835 2.48758 5.15824 3.67851L4.98382 4.32544L4.61425 5.70651C4.18177 7.31847 3.96589 8.1241 4.12816 8.82178C4.25677 9.37257 4.54584 9.87285 4.9588 10.2593C5.48135 10.749 6.28769 10.9649 7.89966 11.3974C9.35221 11.7862 10.1507 12 10.8048 11.9192C10.8763 11.9101 10.9463 11.8977 11.0149 11.882C11.5655 11.7538 12.0658 11.4652 12.4525 11.0528C12.9421 10.5295 13.158 9.7232 13.5905 8.11123Z" stroke="#9D9B98" />
                                                            <path d="M10.8047 11.9191C10.6553 12.3769 10.3927 12.7895 10.0413 13.1186C9.51875 13.6083 8.71241 13.8242 7.10045 14.2559C5.48848 14.6877 4.68214 14.9043 3.98517 14.7413C3.43447 14.6129 2.9342 14.3241 2.54763 13.9114C2.05796 13.3888 1.84137 12.5825 1.4096 10.9705L1.04003 9.58946C0.607553 7.9775 0.391671 7.17116 0.55394 6.47419C0.682549 5.9234 0.971618 5.42313 1.38458 5.03665C1.90713 4.54698 2.71347 4.3311 4.32544 3.89862C4.62948 3.81665 4.90708 3.74302 5.15823 3.67773" stroke="#9D9B98" />
                                                            <path d="M7.48902 6.21899L10.9417 7.144M6.93359 8.2906L9.0052 8.84532" stroke="#9D9B98" stroke-linecap="round" />
                                                        </svg>
                                                        Nervous around hair-dryers
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="bd-refund-banner">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22" fill="none" aria-hidden="true">
                                                <circle cx="11" cy="11" r="10" stroke="#A0BE63" stroke-width="1.4" />
                                                <path d="M6.8 11.2L9.6 14L15.2 8.2" stroke="#A0BE63" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                            <div class="bd-refund-banner-text">
                                                <p class="bd-refund-banner-title">Full refund of £48.00 processed</p>
                                                <p class="bd-refund-banner-sub">Refunded to Visa ending 4242 on 19 Oct 2025</p>
                                            </div>
                                        </div>

                                        <div class="bd-total-row">
                                            <span class="bd-total-label">Total Paid</span>
                                            <span class="bd-total-amount">£48.00</span>
                                        </div>

                                        <div class="bd-footer bd-footer--cancelled">
                                            <span class="bd-closed-label">This booking is closed</span>
                                            <a href="<?= BASE_URL ?>profiles/groomer/groomer_profile.php" class="bd-btn bd-btn-rebook">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                                    <path d="M2.2312 15.4953V12.6124H5.11403" stroke="#6FA0C3" stroke-linecap="round" stroke-linejoin="round" />
                                                    <path d="M15.3656 6.62252C15.6715 8.25452 15.4269 9.94189 14.6702 11.4199C13.9135 12.8978 12.6875 14.0827 11.1846 14.7887C9.68175 15.4946 7.98704 15.6817 6.3664 15.3204C4.74575 14.9592 3.2909 14.0701 2.23013 12.7927M0.628303 9.37748C0.322432 7.74548 0.567036 6.05811 1.32373 4.58014C2.08043 3.10218 3.3064 1.91725 4.80927 1.2113C6.31214 0.505355 8.00686 0.318331 9.6275 0.679579C11.2481 1.04083 12.703 1.9299 13.7638 3.2073" stroke="#6FA0C3" stroke-linecap="round" stroke-linejoin="round" />
                                                    <path d="M13.7626 0.504883V3.38771H10.8798" stroke="#6FA0C3" stroke-linecap="round" stroke-linejoin="round" />
                                                </svg>
                                                Rebook
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Upcoming Space Booking Modal -->

                            <div class="modal" id="view_booking_space_modal">
                                <div class="modal-content size bd-modal-content">
                                    <div class="bd-modal">
                                        <button class="bd-close" type="button" data-modal-close aria-label="Close">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 36 36" fill="none">
                                                <circle cx="18" cy="18" r="17.5" stroke="#3B3731" />
                                                <path d="M12.8 24.0008L24 12.8008M12.8 12.8008L24 24.0008" stroke="#3B3731" stroke-width="1.5" stroke-linecap="round" />
                                            </svg>
                                        </button>

                                        <div class="bd-header">
                                            <h1>Booking Details</h1>
                                            <p>Your upcoming booking</p>
                                        </div>
                                        <hr class="bd-divider">

                                        <div class="bd-status-bar">
                                            <span class="bd-status-badge">
                                                <span class="bd-status-dot"></span>
                                                Confirmed
                                            </span>
                                            <div class="bd-ref-actions">
                                                <span class="bd-ref-id">FG-10294</span>
                                                <a href="#" class="bd-pdf-link">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="13" height="15" viewBox="0 0 13 15" fill="none">
                                                        <path d="M3.07717 14.5H9.27418C9.95769 14.5 10.6132 14.2209 11.0965 13.7242C11.5798 13.2275 11.8514 12.5538 11.8514 11.8514V7.66649C11.8516 6.96411 11.5804 6.29039 11.0973 5.79351L6.70216 1.27568C6.46282 1.02973 6.1787 0.834645 5.86601 0.701554C5.55331 0.568463 5.21817 0.499975 4.87972 0.5H3.07717C2.39367 0.5 1.73815 0.779053 1.25484 1.27577C0.771523 1.77249 0.5 2.44618 0.5 3.14865V11.8514C0.5 12.5538 0.771523 13.2275 1.25484 13.7242C1.73815 14.2209 2.39367 14.5 3.07717 14.5Z" stroke="#3B3731" stroke-linecap="round" stroke-linejoin="round" />
                                                        <path d="M5.9458 0.772461V5.0557C5.9458 5.45711 6.10096 5.84208 6.37714 6.12592C6.65332 6.40976 7.0279 6.56922 7.41847 6.56922H11.5876" stroke="#3B3731" stroke-linecap="round" stroke-linejoin="round" />
                                                        <path d="M2.67822 10.9055V10.1488M2.67822 10.1488V8.63525H3.41456C3.60985 8.63525 3.79714 8.71498 3.93523 8.8569C4.07332 8.99882 4.15089 9.19131 4.15089 9.39201C4.15089 9.59272 4.07332 9.7852 3.93523 9.92712C3.79714 10.069 3.60985 10.1488 3.41456 10.1488H2.67822ZM8.56891 10.9055V9.95958M8.56891 9.95958V8.63525H9.67341M8.56891 9.95958H9.67341M5.62357 10.9055V8.63525H5.99173C6.28467 8.63525 6.5656 8.75485 6.77274 8.96773C6.97987 9.18061 7.09624 9.46933 7.09624 9.77039C7.09624 10.0714 6.97987 10.3602 6.77274 10.5731C6.5656 10.7859 6.28467 10.9055 5.99173 10.9055H5.62357Z" stroke="#3B3731" stroke-linecap="round" stroke-linejoin="round" />
                                                    </svg>
                                                    Download PDF
                                                </a>
                                            </div>
                                        </div>

                                        <div class="bd-groomer-card bd-space-card">
                                            <div class="bd-groomer-left">
                                                <div class="bd-groomer-avatar-wrap bd-space-thumb-wrap">
                                                    <img src="<?= BASE_URL ?>assets/images/space_card1.png" alt="Furs & Co. Studio" class="bd-space-thumb">
                                                    <div class="bd-verified-badge bd-verified-badge--space" title="Verified">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="22" viewBox="0 0 29 31" fill="none">
                                                            <path d="M15.3096 0.175208C15.0558 0.0604166 14.784 0 14.5 0C14.216 0 13.9442 0.0604166 13.6904 0.175208L2.31398 5.00249C0.984817 5.56436 -0.00601417 6.8754 2.74804e-05 8.45832C0.0302358 14.4516 2.49523 25.4172 12.905 30.4016C13.914 30.8849 15.086 30.8849 16.095 30.4016C26.5048 25.4172 28.9698 14.4516 29 8.45832C29.006 6.8754 28.0152 5.56436 26.686 5.00249L15.3096 0.175208Z" fill="#CBDCE8"></path>
                                                            <path d="M22.3736 8.3902L16.1586 14.9936M13.3976 14.6712C11.471 15.4108 9.93043 15.2842 8.38989 14.6735C8.77833 19.6789 11.112 21.6032 14.2234 22.3739C14.2234 22.3739 16.5672 20.716 16.9052 16.7858C16.9417 16.3601 16.9596 16.148 16.8718 15.908C16.7832 15.6679 16.6092 15.4962 16.2619 15.1521C15.6902 14.5865 15.405 14.3037 15.0655 14.2323C14.7261 14.1624 14.2832 14.3317 13.3976 14.6712Z" stroke="white" stroke-linecap="round" stroke-linejoin="round"></path>
                                                        </svg>
                                                    </div>
                                                </div>
                                                <div class="bd-groomer-identity">
                                                    <div class="bd-groomer-title-row">
                                                        <h3>Furs &amp; Co. Studio</h3>
                                                        <span class="bd-service-badge bd-service-badge--space">Garden/Shed</span>
                                                    </div>
                                                    <p class="bd-groomer-name">Hosted by Dev E.</p>
                                                </div>
                                            </div>
                                            <div class="bd-groomer-right">
                                                <div class="bd-groomer-badges">
                                                    <span class="bd-badge bd-badge-popular">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="10" height="9" viewBox="0 0 10 9" fill="none">
                                                            <path d="M2 8.99999C1.85833 8.99999 1.73967 8.95199 1.644 8.85599C1.54833 8.75999 1.50033 8.64133 1.5 8.49999C1.49967 8.35866 1.54767 8.23999 1.644 8.14399C1.74033 8.04799 1.859 7.99999 2 7.99999H8C8.14166 7.99999 8.2605 8.04799 8.3565 8.14399C8.4525 8.23999 8.50033 8.35866 8.5 8.49999C8.49966 8.64133 8.45166 8.76016 8.356 8.85649C8.26033 8.95283 8.14166 9.00066 8 8.99999H2ZM2.35 7.24999C2.10833 7.24999 1.89383 7.17083 1.7065 7.0125C1.51917 6.85416 1.4045 6.65416 1.3625 6.4125L0.862501 3.2375C0.845834 3.2375 0.827167 3.23967 0.806501 3.244C0.785834 3.24833 0.767001 3.25033 0.750001 3.25C0.541667 3.25 0.364668 3.17717 0.219001 3.0315C0.0733344 2.88583 0.000334469 2.70867 1.13636e-06 2.5C-0.000332197 2.29133 0.0726677 2.11433 0.219001 1.969C0.365334 1.82367 0.542334 1.75067 0.750001 1.75C0.957667 1.74933 1.13483 1.82233 1.2815 1.969C1.42817 2.11567 1.501 2.29267 1.5 2.5C1.5 2.55833 1.49367 2.6125 1.481 2.6625C1.46833 2.7125 1.45383 2.75833 1.4375 2.8L3 3.5L4.5625 1.3625C4.47083 1.29583 4.39583 1.20833 4.3375 1.1C4.27917 0.991667 4.25 0.875 4.25 0.75C4.25 0.541667 4.323 0.364501 4.469 0.218501C4.615 0.0725011 4.792 -0.000332194 5 1.13895e-06C5.208 0.000334472 5.38516 0.0733344 5.5315 0.219001C5.67783 0.364667 5.75066 0.541667 5.75 0.75C5.75 0.875 5.72083 0.991667 5.6625 1.1C5.60416 1.20833 5.52916 1.29583 5.4375 1.3625L7 3.5L8.5625 2.8C8.54583 2.75833 8.53116 2.7125 8.5185 2.6625C8.50583 2.6125 8.49966 2.55833 8.5 2.5C8.5 2.29167 8.573 2.1145 8.719 1.9685C8.865 1.8225 9.042 1.74967 9.25 1.75C9.458 1.75033 9.63516 1.82333 9.7815 1.969C9.92783 2.11467 10.0007 2.29167 10 2.5C9.99933 2.70833 9.92649 2.8855 9.7815 3.0315C9.6365 3.1775 9.45933 3.25033 9.25 3.25C9.23333 3.25 9.21466 3.248 9.194 3.244C9.17333 3.24 9.1545 3.23783 9.1375 3.2375L8.6375 6.4125C8.59583 6.65416 8.48133 6.85416 8.294 7.0125C8.10666 7.17083 7.892 7.24999 7.65 7.24999H2.35ZM2.35 6.25H7.65L7.975 4.1625L7.4 4.4125C7.18333 4.50416 6.9625 4.52083 6.7375 4.4625C6.5125 4.40416 6.32916 4.27916 6.1875 4.0875L5 2.45L3.8125 4.0875C3.67083 4.27916 3.4875 4.40416 3.2625 4.4625C3.0375 4.52083 2.81667 4.50416 2.6 4.4125L2.025 4.1625L2.35 6.25Z" fill="white" />
                                                        </svg>
                                                        Popular
                                                    </span>
                                                </div>
                                                <div class="bd-groomer-stats">
                                                    <span>
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="10" height="14" viewBox="0 0 10 14" fill="none">
                                                            <path d="M5 6.65C4.5264 6.65 4.0722 6.46563 3.73731 6.13744C3.40242 5.80925 3.21429 5.36413 3.21429 4.9C3.21429 4.43587 3.40242 3.99075 3.73731 3.66256C4.0722 3.33437 4.5264 3.15 5 3.15C5.4736 3.15 5.9278 3.33437 6.26269 3.66256C6.59758 3.99075 6.78571 4.43587 6.78571 4.9C6.78571 5.12981 6.73953 5.35738 6.64979 5.5697C6.56004 5.78202 6.42851 5.97493 6.26269 6.13744C6.09687 6.29994 5.90002 6.42884 5.68336 6.51679C5.46671 6.60473 5.2345 6.65 5 6.65ZM5 0C3.67392 0 2.40215 0.516248 1.46447 1.43518C0.526784 2.3541 0 3.60044 0 4.9C0 8.575 5 14 5 14C5 14 10 8.575 10 4.9C10 3.60044 9.47322 2.3541 8.53553 1.43518C7.59785 0.516248 6.32608 0 5 0Z" fill="#FFC97A" />
                                                        </svg>
                                                        2.5 mi
                                                    </span>
                                                    <span>
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                                                            <path d="M6.12956 0.660476C6.40354 -0.220161 7.59647 -0.220158 7.87045 0.660479L8.89548 3.95519C9.01801 4.34902 9.36942 4.61566 9.76593 4.61566H13.083C13.9696 4.61566 14.3383 5.80055 13.621 6.34481L10.9374 8.38106C10.6166 8.62446 10.4824 9.0559 10.6049 9.44973L11.63 12.7444C11.9039 13.6251 10.9388 14.3574 10.2215 13.8131L7.53797 11.7769C7.21719 11.5335 6.78282 11.5335 6.46204 11.7769L3.77846 13.8131C3.06117 14.3574 2.09607 13.6251 2.37005 12.7444L3.39508 9.44973C3.51761 9.0559 3.38338 8.62446 3.0626 8.38106L0.37903 6.34481C-0.338258 5.80055 0.0303816 4.61566 0.916998 4.61566H4.23408C4.63058 4.61566 4.98199 4.34902 5.10452 3.95519L6.12956 0.660476Z" fill="#FFC97A" />
                                                        </svg>
                                                        4.3 <span class="bd-muted">(20 reviews)</span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                        <p class="bd-section-label">APPOINTMENT</p>
                                        <div class="bd-appointment-grid">
                                            <div class="bd-tile">
                                                <div class="bd-tile-label">
                                                    Service
                                                </div>
                                                <p class="bd-tile-value">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="15" viewBox="0 0 18 15" fill="none">
                                                        <path d="M15.7313 14.5399V4.60101C15.7313 4.57715 15.7333 4.55379 15.7369 4.53091L13.0497 2.2394C12.4783 1.7528 12.0835 1.41742 11.7486 1.19878C11.4252 0.987721 11.2078 0.920201 10.9999 0.920201C10.7922 0.920202 10.5762 0.987967 10.2532 1.19878C9.91817 1.41745 9.52232 1.75253 8.9501 2.2394L6.26101 4.53091C6.26472 4.55387 6.26856 4.57706 6.26856 4.60101V14.5399C6.26815 14.7937 6.05217 15 5.7858 15C5.51961 14.9998 5.30346 14.7936 5.30305 14.5399V5.34687L4.80521 5.77283C4.60646 5.9422 4.30028 5.92451 4.12257 5.73508C3.94556 5.54577 3.96212 5.25552 4.16028 5.08627L8.30518 1.55464H8.30706C8.86014 1.08404 9.30804 0.700414 9.70629 0.440331C10.1166 0.172503 10.5239 2.69994e-07 10.9999 0C11.4759 0 11.8831 0.172492 12.2936 0.440331C12.6921 0.700477 13.1418 1.08387 13.6947 1.55464L17.8396 5.08627C18.0377 5.25552 18.0543 5.54577 17.8773 5.73508C17.6996 5.92451 17.3934 5.9422 17.1946 5.77283L16.6968 5.34687V14.5399C16.6964 14.7936 16.4802 14.9998 16.214 15C15.9477 15 15.7317 14.7937 15.7313 14.5399Z" fill="#3B3731" />
                                                        <path d="M2.18899 8.00073C2.18899 7.65367 2.09029 7.3559 1.94982 7.15487C1.8093 6.95396 1.64606 6.86952 1.49998 6.86952C1.35398 6.86964 1.19056 6.95411 1.05015 7.15487C0.909803 7.3559 0.810973 7.65386 0.810973 8.00073C0.811102 8.34771 0.90963 8.64568 1.05015 8.84659C1.19054 9.04724 1.35402 9.13012 1.49998 9.13024C1.64595 9.13024 1.80938 9.04714 1.94982 8.84659C2.09034 8.64568 2.18886 8.34771 2.18899 8.00073ZM2.99997 8.00073C2.99984 8.51769 2.85473 9.00269 2.59923 9.36803C2.3435 9.73367 1.95855 9.99988 1.49998 9.99988C1.04173 9.99975 0.65799 9.73336 0.402319 9.36803C0.146795 9.00269 0.000127906 8.51772 0 8.00073C0 7.48348 0.146683 6.99723 0.402319 6.63173C0.65799 6.2665 1.04182 6 1.49998 5.99988C1.95849 5.99988 2.3435 6.26617 2.59923 6.63173C2.85487 6.99723 2.99997 7.48348 2.99997 8.00073Z" fill="#3B3731" />
                                                        <path d="M1 14.5312V9.4686C1 9.20973 1.22386 8.99988 1.49999 8.99988C1.77613 8.99988 1.99999 9.20973 1.99999 9.4686V14.5312C1.99978 14.7899 1.776 14.9999 1.49999 14.9999C1.22399 14.9999 1.00021 14.7899 1 14.5312Z" fill="#3B3731" />
                                                        <path d="M12.7893 11.1765C12.7893 10.7682 12.7875 10.509 12.7616 10.319C12.7375 10.1429 12.7006 10.0971 12.6783 10.0751C12.656 10.0531 12.6098 10.0151 12.4304 9.99131C12.2372 9.96574 11.9724 9.96583 11.557 9.96583H10.7059C10.2905 9.96583 10.0257 9.96574 9.83254 9.99131C9.65315 10.0151 9.60689 10.0531 9.5846 10.0751C9.56228 10.0971 9.52541 10.1429 9.50133 10.319C9.47536 10.509 9.47358 10.7682 9.47358 11.1765V14.0676H12.7893V11.1765ZM11.9844 6.51581C12.2456 6.51601 12.4577 6.72493 12.4581 6.98188C12.4581 7.23916 12.2459 7.44775 11.9844 7.44795H10.2785C10.017 7.44775 9.80478 7.23916 9.80478 6.98188C9.80518 6.72493 10.0173 6.51601 10.2785 6.51581H11.9844ZM11.9844 3.99976L12.0788 4.00886C12.295 4.05203 12.4581 4.24033 12.4581 4.46583C12.4581 4.69132 12.295 4.87963 12.0788 4.92279L11.9844 4.9319H10.2785C10.017 4.9317 9.80478 4.72311 9.80478 4.46583C9.80478 4.20854 10.017 3.99995 10.2785 3.99976H11.9844ZM13.7367 14.0676H17.5261C17.7877 14.0676 17.9998 14.2763 17.9998 14.5337C17.9994 14.7908 17.7875 14.9998 17.5261 14.9998H0.473679C0.21232 14.9998 0.000398957 14.7908 0 14.5337C0 14.2763 0.212073 14.0676 0.473679 14.0676H8.52622V11.1765C8.52622 10.7948 8.52503 10.4616 8.56138 10.1952C8.59968 9.91511 8.6874 9.63984 8.91479 9.41601C9.14231 9.19214 9.42195 9.10597 9.70672 9.06828C9.97773 9.03243 10.3174 9.03368 10.7059 9.03368H11.557C11.9455 9.03368 12.2852 9.03243 12.5562 9.06828C12.841 9.10597 13.1206 9.19214 13.3481 9.41601C13.5755 9.63984 13.6632 9.91511 13.7015 10.1952C13.7379 10.4616 13.7367 10.7948 13.7367 11.1765V14.0676Z" fill="#3B3731" />
                                                    </svg>
                                                    Half-Day
                                                </p>
                                            </div>
                                            <div class="bd-tile">
                                                <div class="bd-tile-label">
                                                    Date
                                                </div>
                                                <p class="bd-tile-value">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="19" height="17" viewBox="0 0 19 17" fill="none">
                                                        <path d="M0.5 8.29554C0.5 5.20139 0.5 3.6539 1.50457 2.69308C2.50914 1.73227 4.12486 1.73145 7.35714 1.73145H10.7857C14.018 1.73145 15.6346 1.73145 16.6383 2.69308C17.642 3.65472 17.6429 5.20139 17.6429 8.29554V9.93656C17.6429 13.0307 17.6429 14.5782 16.6383 15.539C15.6337 16.4998 14.018 16.5007 10.7857 16.5007H7.35714C4.12486 16.5007 2.50829 16.5007 1.50457 15.539C0.500857 14.5774 0.5 13.0307 0.5 9.93656V8.29554Z" stroke="#3B3731" />
                                                        <path d="M4.78561 1.73077V0.5M13.357 1.73077V0.5M0.928467 5.83333H17.2142" stroke="#3B3731" stroke-linecap="round" />
                                                        <path d="M14.2139 12.3975C14.2139 12.6151 14.1236 12.8238 13.9629 12.9777C13.8021 13.1315 13.5841 13.218 13.3568 13.218C13.1295 13.218 12.9114 13.1315 12.7507 12.9777C12.59 12.8238 12.4997 12.6151 12.4997 12.3975C12.4997 12.1799 12.59 11.9712 12.7507 11.8173C12.9114 11.6634 13.1295 11.577 13.3568 11.577C13.5841 11.577 13.8021 11.6634 13.9629 11.8173C14.1236 11.9712 14.2139 12.1799 14.2139 12.3975ZM14.2139 9.11543C14.2139 9.33305 14.1236 9.54175 13.9629 9.69562C13.8021 9.8495 13.5841 9.93595 13.3568 9.93595C13.1295 9.93595 12.9114 9.8495 12.7507 9.69562C12.59 9.54175 12.4997 9.33305 12.4997 9.11543C12.4997 8.89782 12.59 8.68912 12.7507 8.53524C12.9114 8.38137 13.1295 8.29492 13.3568 8.29492C13.5841 8.29492 13.8021 8.38137 13.9629 8.53524C14.1236 8.68912 14.2139 8.89782 14.2139 9.11543ZM9.92822 12.3975C9.92822 12.6151 9.83792 12.8238 9.67717 12.9777C9.51643 13.1315 9.29841 13.218 9.07108 13.218C8.84375 13.218 8.62573 13.1315 8.46499 12.9777C8.30424 12.8238 8.21394 12.6151 8.21394 12.3975C8.21394 12.1799 8.30424 11.9712 8.46499 11.8173C8.62573 11.6634 8.84375 11.577 9.07108 11.577C9.29841 11.577 9.51643 11.6634 9.67717 11.8173C9.83792 11.9712 9.92822 12.1799 9.92822 12.3975ZM9.92822 9.11543C9.92822 9.33305 9.83792 9.54175 9.67717 9.69562C9.51643 9.8495 9.29841 9.93595 9.07108 9.93595C8.84375 9.93595 8.62573 9.8495 8.46499 9.69562C8.30424 9.54175 8.21394 9.33305 8.21394 9.11543C8.21394 8.89782 8.30424 8.68912 8.46499 8.53524C8.62573 8.38137 8.84375 8.29492 9.07108 8.29492C9.29841 8.29492 9.51643 8.38137 9.67717 8.53524C9.83792 8.68912 9.92822 8.89782 9.92822 9.11543ZM5.64251 12.3975C5.64251 12.6151 5.5522 12.8238 5.39146 12.9777C5.23071 13.1315 5.01269 13.218 4.78537 13.218C4.55804 13.218 4.34002 13.1315 4.17927 12.9777C4.01853 12.8238 3.92822 12.6151 3.92822 12.3975C3.92822 12.1799 4.01853 11.9712 4.17927 11.8173C4.34002 11.6634 4.55804 11.577 4.78537 11.577C5.01269 11.577 5.23071 11.6634 5.39146 11.8173C5.5522 11.9712 5.64251 12.1799 5.64251 12.3975ZM5.64251 9.11543C5.64251 9.33305 5.5522 9.54175 5.39146 9.69562C5.23071 9.8495 5.01269 9.93595 4.78537 9.93595C4.55804 9.93595 4.34002 9.8495 4.17927 9.69562C4.01853 9.54175 3.92822 9.33305 3.92822 9.11543C3.92822 8.89782 4.01853 8.68912 4.17927 8.53524C4.34002 8.38137 4.55804 8.29492 4.78537 8.29492C5.01269 8.29492 5.23071 8.38137 5.39146 8.53524C5.5522 8.68912 5.64251 8.89782 5.64251 9.11543Z" fill="#3B3731" />
                                                    </svg>
                                                    Wed, 18 Dec 2025
                                                </p>
                                            </div>
                                            <div class="bd-tile">
                                                <div class="bd-tile-label">
                                                    Time
                                                </div>
                                                <p class="bd-tile-value">
                                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
                                                        <circle cx="8" cy="8" r="6" stroke="#3B3731" stroke-width="1.5" />
                                                        <path d="M8 4.5V8L10.5 10" stroke="#3B3731" stroke-width="1.5" stroke-linecap="round" />
                                                    </svg>
                                                    14:30 - 18:30
                                                </p>
                                            </div>
                                            <div class="bd-tile">
                                                <div class="bd-tile-label">
                                                    Location
                                                </div>
                                                <p class="bd-tile-value">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="16" viewBox="0 0 12 16" fill="none">
                                                        <path d="M6 0.5C7.4694 0.5 8.87214 1.04525 9.90137 2.00586C10.9293 2.96529 11.4999 4.25871 11.5 5.59961C11.5 7.10011 10.6408 8.95946 9.51855 10.7236C8.41048 12.4655 7.10434 14.0263 6.32227 14.9082C6.14625 15.1067 5.85375 15.1067 5.67773 14.9082C4.89566 14.0263 3.58952 12.4655 2.48145 10.7236C1.35919 8.95946 0.5 7.10011 0.5 5.59961C0.500111 4.25871 1.07068 2.96529 2.09863 2.00586C3.12786 1.04525 4.53061 0.5 6 0.5ZM6 3.09961C5.30978 3.09961 4.64141 3.35564 4.14355 3.82031C3.64466 4.28597 3.35753 4.92517 3.35742 5.59961C3.35742 6.27422 3.64453 6.91413 4.14355 7.37988C4.64141 7.84453 5.30979 8.09961 6 8.09961C6.34236 8.09961 6.68202 8.03695 7 7.91406C7.31807 7.7911 7.60965 7.61022 7.85645 7.37988C8.10326 7.14952 8.30086 6.87397 8.43652 6.56836C8.57224 6.26256 8.64258 5.93289 8.64258 5.59961C8.64247 4.92517 8.35534 4.28597 7.85645 3.82031C7.35859 3.35564 6.69022 3.09961 6 3.09961Z" stroke="#3B3731" />
                                                    </svg>
                                                    Victoria Embankment
                                                </p>
                                            </div>
                                        </div>

                                        <p class="bd-section-label">PET</p>
                                        <div class="bd-pets-row">
                                            <div class="bd-pet-card bd-pet-card--compact">
                                                <img src="<?= BASE_URL ?>assets/images/pet_details_1.png" alt="Bella" class="bd-pet-avatar">
                                                <p class="bd-pet-name">Bella - Rabbit <span class="bd-pet-breed">(Mini Lop)</span></p>
                                            </div>
                                            <div class="bd-pet-card bd-pet-card--compact">
                                                <img src="<?= BASE_URL ?>assets/images/pet_details_2.png" alt="Louis" class="bd-pet-avatar">
                                                <p class="bd-pet-name">Louis - Dog <span class="bd-pet-breed">(Labrador)</span></p>
                                            </div>
                                        </div>

                                        <p class="bd-section-label">LOCATION &amp; ACCESS</p>
                                        <div class="bd-map-wrap">
                                            <img src="<?= BASE_URL ?>assets/images/modal_map.png" alt="Location map" class="bd-map-image">
                                        </div>
                                        <div class="bd-access-info">
                                            <svg class="mt-1" xmlns="http://www.w3.org/2000/svg" width="10" height="14" viewBox="0 0 10 14" fill="none">
                                                <path d="M5 0.5C6.19662 0.5 7.34239 0.965778 8.18555 1.79199C9.02838 2.61797 9.5 3.73674 9.5 4.90039C9.49988 5.97161 9.01676 7.26623 8.31055 8.56836C7.61164 9.857 6.72793 11.0923 5.99707 12.0283C5.47794 12.6931 4.52206 12.6931 4.00293 12.0283C3.27207 11.0923 2.38836 9.857 1.68945 8.56836C0.983241 7.26623 0.500117 5.97161 0.5 4.90039C0.5 3.73674 0.971622 2.61797 1.81445 1.79199C2.65761 0.965778 3.80338 0.5 5 0.5ZM5 2.65039C4.39705 2.65039 3.81708 2.8849 3.3877 3.30566C2.95796 3.72681 2.71387 4.30036 2.71387 4.90039C2.71397 5.50027 2.95807 6.07309 3.3877 6.49414C3.81709 6.91495 4.39701 7.15039 5 7.15039C5.29863 7.15039 5.59465 7.09262 5.87109 6.98047C6.14768 6.8682 6.39961 6.70258 6.6123 6.49414C6.82494 6.28575 6.99467 6.03825 7.11035 5.76465C7.226 5.49104 7.28608 5.19715 7.28613 4.90039C7.28613 4.30036 7.04204 3.72681 6.6123 3.30566C6.18292 2.8849 5.60295 2.65039 5 2.65039Z" stroke="#6FA0C3" />
                                            </svg>
                                            <p><strong>Access information</strong> — You'll receive the exact address and access instructions closer to your booking time via email and in your booking details.</p>
                                        </div>

                                        <p class="bd-section-label">AMENITIES INCLUDED</p>
                                        <div class="bd-amenities">
                                            <div class="bd-amenity-tags">
                                                <span class="bd-amenity-tag"><svg xmlns="http://www.w3.org/2000/svg" width="12" height="9" viewBox="0 0 12 9" fill="none">
                                                        <path d="M0.75 4.75L4.25 8.25L11.25 0.75" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                    </svg> Grooming Table</span>
                                                <span class="bd-amenity-tag"><svg xmlns="http://www.w3.org/2000/svg" width="12" height="9" viewBox="0 0 12 9" fill="none">
                                                        <path d="M0.75 4.75L4.25 8.25L11.25 0.75" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                    </svg> Bath</span>
                                                <span class="bd-amenity-tag"><svg xmlns="http://www.w3.org/2000/svg" width="12" height="9" viewBox="0 0 12 9" fill="none">
                                                        <path d="M0.75 4.75L4.25 8.25L11.25 0.75" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                    </svg> Dryer</span>
                                                <span class="bd-amenity-tag"><svg xmlns="http://www.w3.org/2000/svg" width="12" height="9" viewBox="0 0 12 9" fill="none">
                                                        <path d="M0.75 4.75L4.25 8.25L11.25 0.75" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                    </svg> Towels</span>
                                                <span class="bd-amenity-tag"><svg xmlns="http://www.w3.org/2000/svg" width="12" height="9" viewBox="0 0 12 9" fill="none">
                                                        <path d="M0.75 4.75L4.25 8.25L11.25 0.75" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                    </svg> Waiting area</span>
                                                <span class="bd-amenity-tag"><svg xmlns="http://www.w3.org/2000/svg" width="12" height="9" viewBox="0 0 12 9" fill="none">
                                                        <path d="M0.75 4.75L4.25 8.25L11.25 0.75" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                    </svg> Parking</span>
                                                <span class="bd-amenity-tag"><svg xmlns="http://www.w3.org/2000/svg" width="12" height="9" viewBox="0 0 12 9" fill="none">
                                                        <path d="M0.75 4.75L4.25 8.25L11.25 0.75" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                    </svg> Wi-Fi</span>
                                            </div>
                                            <p class="bd-amenities-note">Extra towels - Premium shampoos - Drying crates - Tool storage (where available).</p>
                                        </div>

                                        <div class="bd-next-steps">
                                            <h3>What happens next?</h3>
                                            <ul>
                                                <li>Your space is booked. The groomer and host have both been notified.</li>
                                                <li>You'll get a reminder 24 hours before your booking.</li>
                                                <li>You can change or cancel from My Bookings up to 24 hours before.</li>
                                            </ul>
                                        </div>

                                        <div class="bd-total-row">
                                            <span class="bd-total-label">Total Paid</span>
                                            <span class="bd-total-amount">£48.00</span>
                                        </div>

                                        <div class="bd-footer">
                                            <button type="button" class="bd-cancel-link" data-modal-open="cancel_space_booking_modal" data-close-parent-modal>Cancel Booking</button>
                                            <div class="bd-footer-actions">
                                                <a href="<?= BASE_URL ?>messages_notification/messages.php" class="bd-btn bd-btn-message">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="15" viewBox="0 0 16 15" fill="none">
                                                        <path d="M8 0.5C12.2044 0.5 15.5 3.48321 15.5 7.03223C15.5 10.4703 12.4072 13.3772 8.3916 13.5557L8 13.5645H7.99902C7.251 13.5661 6.50584 13.4687 5.7832 13.2744L5.59766 13.2246L5.42676 13.3115C5.00713 13.5247 4.13103 13.9084 2.72363 14.2393L2.08691 14.377C1.99742 14.3948 1.9071 14.4082 1.81738 14.4248C1.85085 14.3352 1.88498 14.2458 1.91602 14.1553L1.91895 14.1455C2.17667 13.3938 2.38924 12.5229 2.46777 11.7012L2.49023 11.4678L2.3252 11.3008C1.18119 10.1487 0.500003 8.65476 0.5 7.03223C0.5 3.48321 3.79561 0.5 8 0.5Z" stroke="#3B3731" />
                                                    </svg>
                                                    Message host
                                                </a>
                                                <button type="button" class="bd-btn bd-btn-change" data-modal-open="change_space_booking_modal" data-close-parent-modal>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                                        <path d="M2.23096 15.4953V12.6124H5.11378" stroke="white" stroke-linecap="round" stroke-linejoin="round" />
                                                        <path d="M15.3656 6.62252C15.6715 8.25452 15.4269 9.94189 14.6702 11.4199C13.9135 12.8978 12.6875 14.0827 11.1846 14.7887C9.68175 15.4946 7.98704 15.6817 6.3664 15.3204C4.74575 14.9592 3.2909 14.0701 2.23013 12.7927M0.628303 9.37748C0.322432 7.74548 0.567036 6.05811 1.32373 4.58014C2.08043 3.10218 3.3064 1.91725 4.80927 1.2113C6.31214 0.505355 8.00686 0.318331 9.6275 0.679579C11.2481 1.04083 12.703 1.9299 13.7638 3.2073" stroke="white" stroke-linecap="round" stroke-linejoin="round" />
                                                        <path d="M13.7624 0.504883V3.38771H10.8796M4.61412 8.38848C4.2061 8.31757 4.2061 7.73171 4.61412 7.6608C5.3363 7.53448 6.00461 7.19626 6.53409 6.68914C7.06356 6.18203 7.43027 5.52892 7.58761 4.81285L7.61202 4.70009C7.70037 4.29673 8.27461 4.2944 8.36644 4.6966L8.39666 4.82796C8.55903 5.54126 8.92875 6.19059 9.4593 6.69425C9.98985 7.19791 10.6575 7.53339 11.3783 7.65848C11.7886 7.72938 11.7886 8.31874 11.3783 8.39081C10.6577 8.51581 9.99011 8.85111 9.45958 9.35455C8.92904 9.85799 8.55923 10.5071 8.39666 11.2202L8.36644 11.3504C8.27461 11.7526 7.70037 11.7502 7.61202 11.3469L7.58877 11.2353C7.43128 10.5189 7.06422 9.86555 6.5343 9.3584C6.00438 8.85125 5.33556 8.51322 4.61295 8.38732" stroke="white" stroke-linecap="round" stroke-linejoin="round" />
                                                    </svg>
                                                    Change booking
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Completed Space Booking Modal -->

                            <div class="modal" id="view_booking_space_completed_modal">
                                <div class="modal-content size bd-modal-content">
                                    <div class="bd-modal">
                                        <button class="bd-close" type="button" data-modal-close aria-label="Close">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 36 36" fill="none">
                                                <circle cx="18" cy="18" r="17.5" stroke="#3B3731" />
                                                <path d="M12.8 24.0008L24 12.8008M12.8 12.8008L24 24.0008" stroke="#3B3731" stroke-width="1.5" stroke-linecap="round" />
                                            </svg>
                                        </button>

                                        <div class="bd-header">
                                            <h1>Booking Details</h1>
                                            <p>Your completed booking</p>
                                        </div>
                                        <hr class="bd-divider">

                                        <div class="bd-status-bar">
                                            <span class="bd-status-badge bd-status-badge--completed">
                                                <span class="bd-status-dot"></span>
                                                Completed
                                            </span>
                                            <div class="bd-ref-actions">
                                                <span class="bd-ref-id">FG-10294</span>
                                                <a href="#" class="bd-pdf-link">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="13" height="15" viewBox="0 0 13 15" fill="none">
                                                        <path d="M3.07717 14.5H9.27418C9.95769 14.5 10.6132 14.2209 11.0965 13.7242C11.5798 13.2275 11.8514 12.5538 11.8514 11.8514V7.66649C11.8516 6.96411 11.5804 6.29039 11.0973 5.79351L6.70216 1.27568C6.46282 1.02973 6.1787 0.834645 5.86601 0.701554C5.55331 0.568463 5.21817 0.499975 4.87972 0.5H3.07717C2.39367 0.5 1.73815 0.779053 1.25484 1.27577C0.771523 1.77249 0.5 2.44618 0.5 3.14865V11.8514C0.5 12.5538 0.771523 13.2275 1.25484 13.7242C1.73815 14.2209 2.39367 14.5 3.07717 14.5Z" stroke="#3B3731" stroke-linecap="round" stroke-linejoin="round" />
                                                        <path d="M5.9458 0.772461V5.0557C5.9458 5.45711 6.10096 5.84208 6.37714 6.12592C6.65332 6.40976 7.0279 6.56922 7.41847 6.56922H11.5876" stroke="#3B3731" stroke-linecap="round" stroke-linejoin="round" />
                                                        <path d="M2.67822 10.9055V10.1488M2.67822 10.1488V8.63525H3.41456C3.60985 8.63525 3.79714 8.71498 3.93523 8.8569C4.07332 8.99882 4.15089 9.19131 4.15089 9.39201C4.15089 9.59272 4.07332 9.7852 3.93523 9.92712C3.79714 10.069 3.60985 10.1488 3.41456 10.1488H2.67822ZM8.56891 10.9055V9.95958M8.56891 9.95958V8.63525H9.67341M8.56891 9.95958H9.67341M5.62357 10.9055V8.63525H5.99173C6.28467 8.63525 6.5656 8.75485 6.77274 8.96773C6.97987 9.18061 7.09624 9.46933 7.09624 9.77039C7.09624 10.0714 6.97987 10.3602 6.77274 10.5731C6.5656 10.7859 6.28467 10.9055 5.99173 10.9055H5.62357Z" stroke="#3B3731" stroke-linecap="round" stroke-linejoin="round" />
                                                    </svg>
                                                    Download PDF
                                                </a>
                                            </div>
                                        </div>

                                        <div class="bd-groomer-card bd-space-card">
                                            <div class="bd-groomer-left">
                                                <div class="bd-groomer-avatar-wrap bd-space-thumb-wrap">
                                                    <img src="<?= BASE_URL ?>assets/images/space_card1.png" alt="Furs & Co. Studio" class="bd-space-thumb">
                                                    <div class="bd-verified-badge bd-verified-badge--space" title="Verified">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="22" viewBox="0 0 29 31" fill="none">
                                                            <path d="M15.3096 0.175208C15.0558 0.0604166 14.784 0 14.5 0C14.216 0 13.9442 0.0604166 13.6904 0.175208L2.31398 5.00249C0.984817 5.56436 -0.00601417 6.8754 2.74804e-05 8.45832C0.0302358 14.4516 2.49523 25.4172 12.905 30.4016C13.914 30.8849 15.086 30.8849 16.095 30.4016C26.5048 25.4172 28.9698 14.4516 29 8.45832C29.006 6.8754 28.0152 5.56436 26.686 5.00249L15.3096 0.175208Z" fill="#CBDCE8"></path>
                                                            <path d="M22.3736 8.3902L16.1586 14.9936M13.3976 14.6712C11.471 15.4108 9.93043 15.2842 8.38989 14.6735C8.77833 19.6789 11.112 21.6032 14.2234 22.3739C14.2234 22.3739 16.5672 20.716 16.9052 16.7858C16.9417 16.3601 16.9596 16.148 16.8718 15.908C16.7832 15.6679 16.6092 15.4962 16.2619 15.1521C15.6902 14.5865 15.405 14.3037 15.0655 14.2323C14.7261 14.1624 14.2832 14.3317 13.3976 14.6712Z" stroke="white" stroke-linecap="round" stroke-linejoin="round"></path>
                                                        </svg>
                                                    </div>
                                                </div>
                                                <div class="bd-groomer-identity">
                                                    <div class="bd-groomer-title-row">
                                                        <h3>Furs &amp; Co. Studio</h3>
                                                        <span class="bd-service-badge bd-service-badge--space">Garden/Shed</span>
                                                    </div>
                                                    <p class="bd-groomer-name">Hosted by Dev E.</p>
                                                </div>
                                            </div>
                                            <div class="bd-groomer-right">
                                                <div class="bd-groomer-badges">
                                                    <span class="bd-badge bd-badge-popular">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="10" height="9" viewBox="0 0 10 9" fill="none">
                                                            <path d="M2 8.99999C1.85833 8.99999 1.73967 8.95199 1.644 8.85599C1.54833 8.75999 1.50033 8.64133 1.5 8.49999C1.49967 8.35866 1.54767 8.23999 1.644 8.14399C1.74033 8.04799 1.859 7.99999 2 7.99999H8C8.14166 7.99999 8.2605 8.04799 8.3565 8.14399C8.4525 8.23999 8.50033 8.35866 8.5 8.49999C8.49966 8.64133 8.45166 8.76016 8.356 8.85649C8.26033 8.95283 8.14166 9.00066 8 8.99999H2ZM2.35 7.24999C2.10833 7.24999 1.89383 7.17083 1.7065 7.0125C1.51917 6.85416 1.4045 6.65416 1.3625 6.4125L0.862501 3.2375C0.845834 3.2375 0.827167 3.23967 0.806501 3.244C0.785834 3.24833 0.767001 3.25033 0.750001 3.25C0.541667 3.25 0.364668 3.17717 0.219001 3.0315C0.0733344 2.88583 0.000334469 2.70867 1.13636e-06 2.5C-0.000332197 2.29133 0.0726677 2.11433 0.219001 1.969C0.365334 1.82367 0.542334 1.75067 0.750001 1.75C0.957667 1.74933 1.13483 1.82233 1.2815 1.969C1.42817 2.11567 1.501 2.29267 1.5 2.5C1.5 2.55833 1.49367 2.6125 1.481 2.6625C1.46833 2.7125 1.45383 2.75833 1.4375 2.8L3 3.5L4.5625 1.3625C4.47083 1.29583 4.39583 1.20833 4.3375 1.1C4.27917 0.991667 4.25 0.875 4.25 0.75C4.25 0.541667 4.323 0.364501 4.469 0.218501C4.615 0.0725011 4.792 -0.000332194 5 1.13895e-06C5.208 0.000334472 5.38516 0.0733344 5.5315 0.219001C5.67783 0.364667 5.75066 0.541667 5.75 0.75C5.75 0.875 5.72083 0.991667 5.6625 1.1C5.60416 1.20833 5.52916 1.29583 5.4375 1.3625L7 3.5L8.5625 2.8C8.54583 2.75833 8.53116 2.7125 8.5185 2.6625C8.50583 2.6125 8.49966 2.55833 8.5 2.5C8.5 2.29167 8.573 2.1145 8.719 1.9685C8.865 1.8225 9.042 1.74967 9.25 1.75C9.458 1.75033 9.63516 1.82333 9.7815 1.969C9.92783 2.11467 10.0007 2.29167 10 2.5C9.99933 2.70833 9.92649 2.8855 9.7815 3.0315C9.6365 3.1775 9.45933 3.25033 9.25 3.25C9.23333 3.25 9.21466 3.248 9.194 3.244C9.17333 3.24 9.1545 3.23783 9.1375 3.2375L8.6375 6.4125C8.59583 6.65416 8.48133 6.85416 8.294 7.0125C8.10666 7.17083 7.892 7.24999 7.65 7.24999H2.35ZM2.35 6.25H7.65L7.975 4.1625L7.4 4.4125C7.18333 4.50416 6.9625 4.52083 6.7375 4.4625C6.5125 4.40416 6.32916 4.27916 6.1875 4.0875L5 2.45L3.8125 4.0875C3.67083 4.27916 3.4875 4.40416 3.2625 4.4625C3.0375 4.52083 2.81667 4.50416 2.6 4.4125L2.025 4.1625L2.35 6.25Z" fill="white" />
                                                        </svg>
                                                        Popular
                                                    </span>
                                                </div>
                                                <div class="bd-groomer-stats">
                                                    <span>
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="10" height="14" viewBox="0 0 10 14" fill="none">
                                                            <path d="M5 6.65C4.5264 6.65 4.0722 6.46563 3.73731 6.13744C3.40242 5.80925 3.21429 5.36413 3.21429 4.9C3.21429 4.43587 3.40242 3.99075 3.73731 3.66256C4.0722 3.33437 4.5264 3.15 5 3.15C5.4736 3.15 5.9278 3.33437 6.26269 3.66256C6.59758 3.99075 6.78571 4.43587 6.78571 4.9C6.78571 5.12981 6.73953 5.35738 6.64979 5.5697C6.56004 5.78202 6.42851 5.97493 6.26269 6.13744C6.09687 6.29994 5.90002 6.42884 5.68336 6.51679C5.46671 6.60473 5.2345 6.65 5 6.65ZM5 0C3.67392 0 2.40215 0.516248 1.46447 1.43518C0.526784 2.3541 0 3.60044 0 4.9C0 8.575 5 14 5 14C5 14 10 8.575 10 4.9C10 3.60044 9.47322 2.3541 8.53553 1.43518C7.59785 0.516248 6.32608 0 5 0Z" fill="#FFC97A" />
                                                        </svg>
                                                        2.5 mi
                                                    </span>
                                                    <span>
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                                                            <path d="M6.12956 0.660476C6.40354 -0.220161 7.59647 -0.220158 7.87045 0.660479L8.89548 3.95519C9.01801 4.34902 9.36942 4.61566 9.76593 4.61566H13.083C13.9696 4.61566 14.3383 5.80055 13.621 6.34481L10.9374 8.38106C10.6166 8.62446 10.4824 9.0559 10.6049 9.44973L11.63 12.7444C11.9039 13.6251 10.9388 14.3574 10.2215 13.8131L7.53797 11.7769C7.21719 11.5335 6.78282 11.5335 6.46204 11.7769L3.77846 13.8131C3.06117 14.3574 2.09607 13.6251 2.37005 12.7444L3.39508 9.44973C3.51761 9.0559 3.38338 8.62446 3.0626 8.38106L0.37903 6.34481C-0.338258 5.80055 0.0303816 4.61566 0.916998 4.61566H4.23408C4.63058 4.61566 4.98199 4.34902 5.10452 3.95519L6.12956 0.660476Z" fill="#FFC97A" />
                                                        </svg>
                                                        4.3 <span class="bd-muted">(20 reviews)</span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                        <p class="bd-section-label">APPOINTMENT</p>
                                        <div class="bd-appointment-grid">
                                            <div class="bd-tile">
                                                <div class="bd-tile-label">
                                                    Service
                                                </div>
                                                <p class="bd-tile-value">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                                        <path d="M2.5 6.5L8 2L13.5 6.5V13.5C13.5 13.7652 13.3946 14.0196 13.2071 14.2071C13.0196 14.3946 12.7652 14.5 12.5 14.5H3.5C3.23478 14.5 2.98043 14.3946 2.79289 14.2071C2.60536 14.0196 2.5 13.7652 2.5 13.5V6.5Z" stroke="#3B3731" stroke-linecap="round" stroke-linejoin="round" />
                                                        <path d="M6.5 14.5V8.5H9.5V14.5" stroke="#3B3731" stroke-linecap="round" stroke-linejoin="round" />
                                                    </svg>
                                                    Half-Day
                                                </p>
                                            </div>
                                            <div class="bd-tile">
                                                <div class="bd-tile-label">
                                                    Date
                                                </div>
                                                <p class="bd-tile-value">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="19" height="17" viewBox="0 0 19 17" fill="none">
                                                        <path d="M0.5 8.29554C0.5 5.20139 0.5 3.6539 1.50457 2.69308C2.50914 1.73227 4.12486 1.73145 7.35714 1.73145H10.7857C14.018 1.73145 15.6346 1.73145 16.6383 2.69308C17.642 3.65472 17.6429 5.20139 17.6429 8.29554V9.93656C17.6429 13.0307 17.6429 14.5782 16.6383 15.539C15.6337 16.4998 14.018 16.5007 10.7857 16.5007H7.35714C4.12486 16.5007 2.50829 16.5007 1.50457 15.539C0.500857 14.5774 0.5 13.0307 0.5 9.93656V8.29554Z" stroke="#3B3731" />
                                                        <path d="M4.78561 1.73077V0.5M13.357 1.73077V0.5M0.928467 5.83333H17.2142" stroke="#3B3731" stroke-linecap="round" />
                                                        <path d="M14.2139 12.3975C14.2139 12.6151 14.1236 12.8238 13.9629 12.9777C13.8021 13.1315 13.5841 13.218 13.3568 13.218C13.1295 13.218 12.9114 13.1315 12.7507 12.9777C12.59 12.8238 12.4997 12.6151 12.4997 12.3975C12.4997 12.1799 12.59 11.9712 12.7507 11.8173C12.9114 11.6634 13.1295 11.577 13.3568 11.577C13.5841 11.577 13.8021 11.6634 13.9629 11.8173C14.1236 11.9712 14.2139 12.1799 14.2139 12.3975ZM14.2139 9.11543C14.2139 9.33305 14.1236 9.54175 13.9629 9.69562C13.8021 9.8495 13.5841 9.93595 13.3568 9.93595C13.1295 9.93595 12.9114 9.8495 12.7507 9.69562C12.59 9.54175 12.4997 9.33305 12.4997 9.11543C12.4997 8.89782 12.59 8.68912 12.7507 8.53524C12.9114 8.38137 13.1295 8.29492 13.3568 8.29492C13.5841 8.29492 13.8021 8.38137 13.9629 8.53524C14.1236 8.68912 14.2139 8.89782 14.2139 9.11543ZM9.92822 12.3975C9.92822 12.6151 9.83792 12.8238 9.67717 12.9777C9.51643 13.1315 9.29841 13.218 9.07108 13.218C8.84375 13.218 8.62573 13.1315 8.46499 12.9777C8.30424 12.8238 8.21394 12.6151 8.21394 12.3975C8.21394 12.1799 8.30424 11.9712 8.46499 11.8173C8.62573 11.6634 8.84375 11.577 9.07108 11.577C9.29841 11.577 9.51643 11.6634 9.67717 11.8173C9.83792 11.9712 9.92822 12.1799 9.92822 12.3975ZM9.92822 9.11543C9.92822 9.33305 9.83792 9.54175 9.67717 9.69562C9.51643 9.8495 9.29841 9.93595 9.07108 9.93595C8.84375 9.93595 8.62573 9.8495 8.46499 9.69562C8.30424 9.54175 8.21394 9.33305 8.21394 9.11543C8.21394 8.89782 8.30424 8.68912 8.46499 8.53524C8.62573 8.38137 8.84375 8.29492 9.07108 8.29492C9.29841 8.29492 9.51643 8.38137 9.67717 8.53524C9.83792 8.68912 9.92822 8.89782 9.92822 9.11543ZM5.64251 12.3975C5.64251 12.6151 5.5522 12.8238 5.39146 12.9777C5.23071 13.1315 5.01269 13.218 4.78537 13.218C4.55804 13.218 4.34002 13.1315 4.17927 12.9777C4.01853 12.8238 3.92822 12.6151 3.92822 12.3975C3.92822 12.1799 4.01853 11.9712 4.17927 11.8173C4.34002 11.6634 4.55804 11.577 4.78537 11.577C5.01269 11.577 5.23071 11.6634 5.39146 11.8173C5.5522 11.9712 5.64251 12.1799 5.64251 12.3975ZM5.64251 9.11543C5.64251 9.33305 5.5522 9.54175 5.39146 9.69562C5.23071 9.8495 5.01269 9.93595 4.78537 9.93595C4.55804 9.93595 4.34002 9.8495 4.17927 9.69562C4.01853 9.54175 3.92822 9.33305 3.92822 9.11543C3.92822 8.89782 4.01853 8.68912 4.17927 8.53524C4.34002 8.38137 4.55804 8.29492 4.78537 8.29492C5.01269 8.29492 5.23071 8.38137 5.39146 8.53524C5.5522 8.68912 5.64251 8.89782 5.64251 9.11543Z" fill="#3B3731" />
                                                    </svg>
                                                    Wed, 18 Dec 2025
                                                </p>
                                            </div>
                                            <div class="bd-tile">
                                                <div class="bd-tile-label">
                                                    Time
                                                </div>
                                                <p class="bd-tile-value">
                                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
                                                        <circle cx="8" cy="8" r="6" stroke="#3B3731" stroke-width="1.5" />
                                                        <path d="M8 4.5V8L10.5 10" stroke="#3B3731" stroke-width="1.5" stroke-linecap="round" />
                                                    </svg>
                                                    14:30 - 18:30
                                                </p>
                                            </div>
                                            <div class="bd-tile">
                                                <div class="bd-tile-label">
                                                    Location
                                                </div>
                                                <p class="bd-tile-value">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="16" viewBox="0 0 12 16" fill="none">
                                                        <path d="M6 0.5C7.4694 0.5 8.87214 1.04525 9.90137 2.00586C10.9293 2.96529 11.4999 4.25871 11.5 5.59961C11.5 7.10011 10.6408 8.95946 9.51855 10.7236C8.41048 12.4655 7.10434 14.0263 6.32227 14.9082C6.14625 15.1067 5.85375 15.1067 5.67773 14.9082C4.89566 14.0263 3.58952 12.4655 2.48145 10.7236C1.35919 8.95946 0.5 7.10011 0.5 5.59961C0.500111 4.25871 1.07068 2.96529 2.09863 2.00586C3.12786 1.04525 4.53061 0.5 6 0.5ZM6 3.09961C5.30978 3.09961 4.64141 3.35564 4.14355 3.82031C3.64466 4.28597 3.35753 4.92517 3.35742 5.59961C3.35742 6.27422 3.64453 6.91413 4.14355 7.37988C4.64141 7.84453 5.30979 8.09961 6 8.09961C6.69022 8.09961 7.35859 7.84453 7.85645 7.37988C8.35534 6.91413 8.64247 6.27422 8.64258 5.59961C8.64258 4.92517 8.35534 4.28597 7.85645 3.82031C7.35859 3.35564 6.69022 3.09961 6 3.09961Z" stroke="#3B3731" />
                                                    </svg>
                                                    Victoria Embankment
                                                </p>
                                            </div>
                                        </div>

                                        <p class="bd-section-label">PET</p>
                                        <div class="bd-pets-row">
                                            <div class="bd-pet-card bd-pet-card--compact">
                                                <img src="<?= BASE_URL ?>assets/images/pet_details_1.png" alt="Bella" class="bd-pet-avatar">
                                                <p class="bd-pet-name">Bella - Rabbit <span class="bd-pet-breed">(Mini Lop)</span></p>
                                            </div>
                                            <div class="bd-pet-card bd-pet-card--compact">
                                                <img src="<?= BASE_URL ?>assets/images/pet_details_2.png" alt="Louis" class="bd-pet-avatar">
                                                <p class="bd-pet-name">Louis - Dog <span class="bd-pet-breed">(Labrador)</span></p>
                                            </div>
                                        </div>

                                        <p class="bd-section-label">LOCATION &amp; ACCESS</p>
                                        <div class="bd-map-wrap">
                                            <img src="<?= BASE_URL ?>assets/images/modal_map.png" alt="Location map" class="bd-map-image">
                                        </div>

                                        <p class="bd-section-label">AMENITIES INCLUDED</p>
                                        <div class="bd-amenities">
                                            <div class="bd-amenity-tags">
                                                <span class="bd-amenity-tag"><svg xmlns="http://www.w3.org/2000/svg" width="12" height="9" viewBox="0 0 12 9" fill="none">
                                                        <path d="M0.75 4.75L4.25 8.25L11.25 0.75" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                    </svg> Grooming Table</span>
                                                <span class="bd-amenity-tag"><svg xmlns="http://www.w3.org/2000/svg" width="12" height="9" viewBox="0 0 12 9" fill="none">
                                                        <path d="M0.75 4.75L4.25 8.25L11.25 0.75" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                    </svg> Bath</span>
                                                <span class="bd-amenity-tag"><svg xmlns="http://www.w3.org/2000/svg" width="12" height="9" viewBox="0 0 12 9" fill="none">
                                                        <path d="M0.75 4.75L4.25 8.25L11.25 0.75" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                    </svg> Dryer</span>
                                                <span class="bd-amenity-tag"><svg xmlns="http://www.w3.org/2000/svg" width="12" height="9" viewBox="0 0 12 9" fill="none">
                                                        <path d="M0.75 4.75L4.25 8.25L11.25 0.75" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                    </svg> Towels</span>
                                                <span class="bd-amenity-tag"><svg xmlns="http://www.w3.org/2000/svg" width="12" height="9" viewBox="0 0 12 9" fill="none">
                                                        <path d="M0.75 4.75L4.25 8.25L11.25 0.75" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                    </svg> Waiting area</span>
                                                <span class="bd-amenity-tag"><svg xmlns="http://www.w3.org/2000/svg" width="12" height="9" viewBox="0 0 12 9" fill="none">
                                                        <path d="M0.75 4.75L4.25 8.25L11.25 0.75" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                    </svg> Parking</span>
                                                <span class="bd-amenity-tag"><svg xmlns="http://www.w3.org/2000/svg" width="12" height="9" viewBox="0 0 12 9" fill="none">
                                                        <path d="M0.75 4.75L4.25 8.25L11.25 0.75" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                    </svg> Wi-Fi</span>
                                            </div>
                                            <p class="bd-amenities-note">Extra towels - Premium shampoos - Drying crates - Tool storage (where available).</p>
                                        </div>

                                        <div class="bd-reviewed-banner">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12" fill="none">
                                                <path d="M6 11.5C9.025 11.5 11.5 9.025 11.5 6C11.5 2.975 9.025 0.5 6 0.5C2.975 0.5 0.5 2.975 0.5 6C0.5 9.025 2.975 11.5 6 11.5Z" stroke="#AAA6A0" stroke-linecap="round" stroke-linejoin="round" />
                                                <path d="M3.6626 6.00023L5.2191 7.55673L8.3376 4.44373" stroke="#AAA6A0" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                            <p>You've reviewed this booking — thank you! Your feedback helps other pet owners.</p>
                                        </div>

                                        <div class="bd-total-row">
                                            <span class="bd-total-label">Total Paid</span>
                                            <span class="bd-total-amount">£48.00</span>
                                        </div>

                                        <div class="bd-footer bd-footer--completed">
                                            <a href="<?= BASE_URL ?>messages_notification/messages.php" class="bd-btn bd-btn-message">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="15" viewBox="0 0 16 15" fill="none">
                                                    <path d="M8 0.5C12.2044 0.5 15.5 3.48321 15.5 7.03223C15.5 10.4703 12.4072 13.3772 8.3916 13.5557L8 13.5645H7.99902C7.251 13.5661 6.50584 13.4687 5.7832 13.2744L5.59766 13.2246L5.42676 13.3115C5.00713 13.5247 4.13103 13.9084 2.72363 14.2393L2.08691 14.377C1.99742 14.3948 1.9071 14.4082 1.81738 14.4248C1.85085 14.3352 1.88498 14.2458 1.91602 14.1553L1.91895 14.1455C2.17667 13.3938 2.38924 12.5229 2.46777 11.7012L2.49023 11.4678L2.3252 11.3008C1.18119 10.1487 0.500003 8.65476 0.5 7.03223C0.5 3.48321 3.79561 0.5 8 0.5Z" stroke="#3B3731" />
                                                </svg>
                                                Message groomer
                                            </a>
                                            <div class="bd-footer-actions">
                                                <span class="bd-btn bd-btn-reviewed">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                                                        <path d="M2.5 7.2L5.5 10.2L11.5 3.8" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                    </svg>
                                                    Reviewed
                                                </span>
                                                <a href="<?= BASE_URL ?>profiles/space/space_profile.php" class="bd-btn bd-btn-rebook">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                                        <path d="M3.2 6.2A5.5 5.5 0 0 1 12.8 5.1M12.8 9.8A5.5 5.5 0 0 1 3.2 10.9" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" />
                                                        <path d="M12.8 2.5V5.3H10M3.2 13.5V10.7H6" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round" />
                                                    </svg>
                                                    Rebook
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <!-- Cancelled Space Booking Modal -->

                            <div class="modal" id="view_booking_space_cancelled_modal">
                                <div class="modal-content size bd-modal-content">
                                    <div class="bd-modal">
                                        <button class="bd-close" type="button" data-modal-close aria-label="Close">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 36 36" fill="none">
                                                <circle cx="18" cy="18" r="17.5" stroke="#3B3731" />
                                                <path d="M12.8 24.0008L24 12.8008M12.8 12.8008L24 24.0008" stroke="#3B3731" stroke-width="1.5" stroke-linecap="round" />
                                            </svg>
                                        </button>

                                        <div class="bd-header">
                                            <h1>Booking Details</h1>
                                            <p>Your cancelled booking</p>
                                        </div>
                                        <hr class="bd-divider">

                                        <div class="bd-status-bar">
                                            <span class="bd-status-badge bd-status-badge--cancelled">
                                                <span class="bd-status-dot"></span>
                                                Cancelled
                                            </span>
                                            <div class="bd-ref-actions">
                                                <span class="bd-ref-id">FG-10294</span>
                                                <a href="#" class="bd-pdf-link">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="13" height="15" viewBox="0 0 13 15" fill="none">
                                                        <path d="M3.07717 14.5H9.27418C9.95769 14.5 10.6132 14.2209 11.0965 13.7242C11.5798 13.2275 11.8514 12.5538 11.8514 11.8514V7.66649C11.8516 6.96411 11.5804 6.29039 11.0973 5.79351L6.70216 1.27568C6.46282 1.02973 6.1787 0.834645 5.86601 0.701554C5.55331 0.568463 5.21817 0.499975 4.87972 0.5H3.07717C2.39367 0.5 1.73815 0.779053 1.25484 1.27577C0.771523 1.77249 0.5 2.44618 0.5 3.14865V11.8514C0.5 12.5538 0.771523 13.2275 1.25484 13.7242C1.73815 14.2209 2.39367 14.5 3.07717 14.5Z" stroke="#3B3731" stroke-linecap="round" stroke-linejoin="round" />
                                                        <path d="M5.9458 0.772461V5.0557C5.9458 5.45711 6.10096 5.84208 6.37714 6.12592C6.65332 6.40976 7.0279 6.56922 7.41847 6.56922H11.5876" stroke="#3B3731" stroke-linecap="round" stroke-linejoin="round" />
                                                        <path d="M2.67822 10.9055V10.1488M2.67822 10.1488V8.63525H3.41456C3.60985 8.63525 3.79714 8.71498 3.93523 8.8569C4.07332 8.99882 4.15089 9.19131 4.15089 9.39201C4.15089 9.59272 4.07332 9.7852 3.93523 9.92712C3.79714 10.069 3.60985 10.1488 3.41456 10.1488H2.67822ZM8.56891 10.9055V9.95958M8.56891 9.95958V8.63525H9.67341M8.56891 9.95958H9.67341M5.62357 10.9055V8.63525H5.99173C6.28467 8.63525 6.5656 8.75485 6.77274 8.96773C6.97987 9.18061 7.09624 9.46933 7.09624 9.77039C7.09624 10.0714 6.97987 10.3602 6.77274 10.5731C6.5656 10.7859 6.28467 10.9055 5.99173 10.9055H5.62357Z" stroke="#3B3731" stroke-linecap="round" stroke-linejoin="round" />
                                                    </svg>
                                                    Download PDF
                                                </a>
                                            </div>
                                        </div>

                                        <div class="bd-cancel-notice bd-cancel-notice--host">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12" fill="none">
                                                <circle cx="6" cy="6" r="5.5" stroke="#FF6E6E" />
                                                <path d="M4.2666 7.99994L7.99994 4.2666M4.2666 4.2666L7.99994 7.99994" stroke="#FF6E6E" stroke-linecap="round" />
                                            </svg>
                                            <div class="bd-cancel-notice-text">
                                                <p class="bd-cancel-notice-title">Dev É. cancelled this booking &bull; 8 Oct 2025</p>
                                                <p class="bd-cancel-notice-sub">The host had to cancel due to an unexpected maintenance issue at the space.</p>
                                            </div>
                                        </div>

                                        <div class="bd-groomer-card bd-space-card">
                                            <div class="bd-groomer-left">
                                                <div class="bd-groomer-avatar-wrap bd-space-thumb-wrap">
                                                    <img src="<?= BASE_URL ?>assets/images/space_card1.png" alt="Furs & Co. Studio" class="bd-space-thumb">
                                                    <div class="bd-verified-badge bd-verified-badge--space" title="Verified">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="22" viewBox="0 0 29 31" fill="none">
                                                            <path d="M15.3096 0.175208C15.0558 0.0604166 14.784 0 14.5 0C14.216 0 13.9442 0.0604166 13.6904 0.175208L2.31398 5.00249C0.984817 5.56436 -0.00601417 6.8754 2.74804e-05 8.45832C0.0302358 14.4516 2.49523 25.4172 12.905 30.4016C13.914 30.8849 15.086 30.8849 16.095 30.4016C26.5048 25.4172 28.9698 14.4516 29 8.45832C29.006 6.8754 28.0152 5.56436 26.686 5.00249L15.3096 0.175208Z" fill="#CBDCE8"></path>
                                                            <path d="M22.3736 8.3902L16.1586 14.9936M13.3976 14.6712C11.471 15.4108 9.93043 15.2842 8.38989 14.6735C8.77833 19.6789 11.112 21.6032 14.2234 22.3739C14.2234 22.3739 16.5672 20.716 16.9052 16.7858C16.9417 16.3601 16.9596 16.148 16.8718 15.908C16.7832 15.6679 16.6092 15.4962 16.2619 15.1521C15.6902 14.5865 15.405 14.3037 15.0655 14.2323C14.7261 14.1624 14.2832 14.3317 13.3976 14.6712Z" stroke="white" stroke-linecap="round" stroke-linejoin="round"></path>
                                                        </svg>
                                                    </div>
                                                </div>
                                                <div class="bd-groomer-identity">
                                                    <div class="bd-groomer-title-row">
                                                        <h3>Furs &amp; Co. Studio</h3>
                                                        <span class="bd-service-badge bd-service-badge--space">Garden/Shed</span>
                                                    </div>
                                                    <p class="bd-groomer-name">Hosted by Dev E.</p>
                                                </div>
                                            </div>
                                            <div class="bd-groomer-right">
                                                <div class="bd-groomer-badges">
                                                    <span class="bd-badge bd-badge-popular">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="10" height="9" viewBox="0 0 10 9" fill="none">
                                                            <path d="M2 8.99999C1.85833 8.99999 1.73967 8.95199 1.644 8.85599C1.54833 8.75999 1.50033 8.64133 1.5 8.49999C1.49967 8.35866 1.54767 8.23999 1.644 8.14399C1.74033 8.04799 1.859 7.99999 2 7.99999H8C8.14166 7.99999 8.2605 8.04799 8.3565 8.14399C8.4525 8.23999 8.50033 8.35866 8.5 8.49999C8.49966 8.64133 8.45166 8.76016 8.356 8.85649C8.26033 8.95283 8.14166 9.00066 8 8.99999H2ZM2.35 7.24999C2.10833 7.24999 1.89383 7.17083 1.7065 7.0125C1.51917 6.85416 1.4045 6.65416 1.3625 6.4125L0.862501 3.2375C0.845834 3.2375 0.827167 3.23967 0.806501 3.244C0.785834 3.24833 0.767001 3.25033 0.750001 3.25C0.541667 3.25 0.364668 3.17717 0.219001 3.0315C0.0733344 2.88583 0.000334469 2.70867 1.13636e-06 2.5C-0.000332197 2.29133 0.0726677 2.11433 0.219001 1.969C0.365334 1.82367 0.542334 1.75067 0.750001 1.75C0.957667 1.74933 1.13483 1.82233 1.2815 1.969C1.42817 2.11567 1.501 2.29267 1.5 2.5C1.5 2.55833 1.49367 2.6125 1.481 2.6625C1.46833 2.7125 1.45383 2.75833 1.4375 2.8L3 3.5L4.5625 1.3625C4.47083 1.29583 4.39583 1.20833 4.3375 1.1C4.27917 0.991667 4.25 0.875 4.25 0.75C4.25 0.541667 4.323 0.364501 4.469 0.218501C4.615 0.0725011 4.792 -0.000332194 5 1.13895e-06C5.208 0.000334472 5.38516 0.0733344 5.5315 0.219001C5.67783 0.364667 5.75066 0.541667 5.75 0.75C5.75 0.875 5.72083 0.991667 5.6625 1.1C5.60416 1.20833 5.52916 1.29583 5.4375 1.3625L7 3.5L8.5625 2.8C8.54583 2.75833 8.53116 2.7125 8.5185 2.6625C8.50583 2.6125 8.49966 2.55833 8.5 2.5C8.5 2.29167 8.573 2.1145 8.719 1.9685C8.865 1.8225 9.042 1.74967 9.25 1.75C9.458 1.75033 9.63516 1.82333 9.7815 1.969C9.92783 2.11467 10.0007 2.29167 10 2.5C9.99933 2.70833 9.92649 2.8855 9.7815 3.0315C9.6365 3.1775 9.45933 3.25033 9.25 3.25C9.23333 3.25 9.21466 3.248 9.194 3.244C9.17333 3.24 9.1545 3.23783 9.1375 3.2375L8.6375 6.4125C8.59583 6.65416 8.48133 6.85416 8.294 7.0125C8.10666 7.17083 7.892 7.24999 7.65 7.24999H2.35ZM2.35 6.25H7.65L7.975 4.1625L7.4 4.4125C7.18333 4.50416 6.9625 4.52083 6.7375 4.4625C6.5125 4.40416 6.32916 4.27916 6.1875 4.0875L5 2.45L3.8125 4.0875C3.67083 4.27916 3.4875 4.40416 3.2625 4.4625C3.0375 4.52083 2.81667 4.50416 2.6 4.4125L2.025 4.1625L2.35 6.25Z" fill="white" />
                                                        </svg>
                                                        Popular
                                                    </span>
                                                </div>
                                                <div class="bd-groomer-stats">
                                                    <span>
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="10" height="14" viewBox="0 0 10 14" fill="none">
                                                            <path d="M5 6.65C4.5264 6.65 4.0722 6.46563 3.73731 6.13744C3.40242 5.80925 3.21429 5.36413 3.21429 4.9C3.21429 4.43587 3.40242 3.99075 3.73731 3.66256C4.0722 3.33437 4.5264 3.15 5 3.15C5.4736 3.15 5.9278 3.33437 6.26269 3.66256C6.59758 3.99075 6.78571 4.43587 6.78571 4.9C6.78571 5.12981 6.73953 5.35738 6.64979 5.5697C6.56004 5.78202 6.42851 5.97493 6.26269 6.13744C6.09687 6.29994 5.90002 6.42884 5.68336 6.51679C5.46671 6.60473 5.2345 6.65 5 6.65ZM5 0C3.67392 0 2.40215 0.516248 1.46447 1.43518C0.526784 2.3541 0 3.60044 0 4.9C0 8.575 5 14 5 14C5 14 10 8.575 10 4.9C10 3.60044 9.47322 2.3541 8.53553 1.43518C7.59785 0.516248 6.32608 0 5 0Z" fill="#FFC97A" />
                                                        </svg>
                                                        2.5 mi
                                                    </span>
                                                    <span>
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                                                            <path d="M6.12956 0.660476C6.40354 -0.220161 7.59647 -0.220158 7.87045 0.660479L8.89548 3.95519C9.01801 4.34902 9.36942 4.61566 9.76593 4.61566H13.083C13.9696 4.61566 14.3383 5.80055 13.621 6.34481L10.9374 8.38106C10.6166 8.62446 10.4824 9.0559 10.6049 9.44973L11.63 12.7444C11.9039 13.6251 10.9388 14.3574 10.2215 13.8131L7.53797 11.7769C7.21719 11.5335 6.78282 11.5335 6.46204 11.7769L3.77846 13.8131C3.06117 14.3574 2.09607 13.6251 2.37005 12.7444L3.39508 9.44973C3.51761 9.0559 3.38338 8.62446 3.0626 8.38106L0.37903 6.34481C-0.338258 5.80055 0.0303816 4.61566 0.916998 4.61566H4.23408C4.63058 4.61566 4.98199 4.34902 5.10452 3.95519L6.12956 0.660476Z" fill="#FFC97A" />
                                                        </svg>
                                                        4.3 <span class="bd-muted">(20 reviews)</span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                        <p class="bd-section-label">APPOINTMENT</p>
                                        <div class="bd-appointment-grid">
                                            <div class="bd-tile">
                                                <div class="bd-tile-label">
                                                    Service
                                                </div>
                                                <p class="bd-tile-value">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                                        <path d="M2.5 6.5L8 2L13.5 6.5V13.5C13.5 13.7652 13.3946 14.0196 13.2071 14.2071C13.0196 14.3946 12.7652 14.5 12.5 14.5H3.5C3.23478 14.5 2.98043 14.3946 2.79289 14.2071C2.60536 14.0196 2.5 13.7652 2.5 13.5V6.5Z" stroke="#3B3731" stroke-linecap="round" stroke-linejoin="round" />
                                                        <path d="M6.5 14.5V8.5H9.5V14.5" stroke="#3B3731" stroke-linecap="round" stroke-linejoin="round" />
                                                    </svg>
                                                    Half-Day
                                                </p>
                                            </div>
                                            <div class="bd-tile">
                                                <div class="bd-tile-label">
                                                    Date
                                                </div>
                                                <p class="bd-tile-value">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="19" height="17" viewBox="0 0 19 17" fill="none">
                                                        <path d="M0.5 8.29554C0.5 5.20139 0.5 3.6539 1.50457 2.69308C2.50914 1.73227 4.12486 1.73145 7.35714 1.73145H10.7857C14.018 1.73145 15.6346 1.73145 16.6383 2.69308C17.642 3.65472 17.6429 5.20139 17.6429 8.29554V9.93656C17.6429 13.0307 17.6429 14.5782 16.6383 15.539C15.6337 16.4998 14.018 16.5007 10.7857 16.5007H7.35714C4.12486 16.5007 2.50829 16.5007 1.50457 15.539C0.500857 14.5774 0.5 13.0307 0.5 9.93656V8.29554Z" stroke="#3B3731" />
                                                        <path d="M4.78561 1.73077V0.5M13.357 1.73077V0.5M0.928467 5.83333H17.2142" stroke="#3B3731" stroke-linecap="round" />
                                                        <path d="M14.2139 12.3975C14.2139 12.6151 14.1236 12.8238 13.9629 12.9777C13.8021 13.1315 13.5841 13.218 13.3568 13.218C13.1295 13.218 12.9114 13.1315 12.7507 12.9777C12.59 12.8238 12.4997 12.6151 12.4997 12.3975C12.4997 12.1799 12.59 11.9712 12.7507 11.8173C12.9114 11.6634 13.1295 11.577 13.3568 11.577C13.5841 11.577 13.8021 11.6634 13.9629 11.8173C14.1236 11.9712 14.2139 12.1799 14.2139 12.3975ZM14.2139 9.11543C14.2139 9.33305 14.1236 9.54175 13.9629 9.69562C13.8021 9.8495 13.5841 9.93595 13.3568 9.93595C13.1295 9.93595 12.9114 9.8495 12.7507 9.69562C12.59 9.54175 12.4997 9.33305 12.4997 9.11543C12.4997 8.89782 12.59 8.68912 12.7507 8.53524C12.9114 8.38137 13.1295 8.29492 13.3568 8.29492C13.5841 8.29492 13.8021 8.38137 13.9629 8.53524C14.1236 8.68912 14.2139 8.89782 14.2139 9.11543ZM9.92822 12.3975C9.92822 12.6151 9.83792 12.8238 9.67717 12.9777C9.51643 13.1315 9.29841 13.218 9.07108 13.218C8.84375 13.218 8.62573 13.1315 8.46499 12.9777C8.30424 12.8238 8.21394 12.6151 8.21394 12.3975C8.21394 12.1799 8.30424 11.9712 8.46499 11.8173C8.62573 11.6634 8.84375 11.577 9.07108 11.577C9.29841 11.577 9.51643 11.6634 9.67717 11.8173C9.83792 11.9712 9.92822 12.1799 9.92822 12.3975ZM9.92822 9.11543C9.92822 9.33305 9.83792 9.54175 9.67717 9.69562C9.51643 9.8495 9.29841 9.93595 9.07108 9.93595C8.84375 9.93595 8.62573 9.8495 8.46499 9.69562C8.30424 9.54175 8.21394 9.33305 8.21394 9.11543C8.21394 8.89782 8.30424 8.68912 8.46499 8.53524C8.62573 8.38137 8.84375 8.29492 9.07108 8.29492C9.29841 8.29492 9.51643 8.38137 9.67717 8.53524C9.83792 8.68912 9.92822 8.89782 9.92822 9.11543ZM5.64251 12.3975C5.64251 12.6151 5.5522 12.8238 5.39146 12.9777C5.23071 13.1315 5.01269 13.218 4.78537 13.218C4.55804 13.218 4.34002 13.1315 4.17927 12.9777C4.01853 12.8238 3.92822 12.6151 3.92822 12.3975C3.92822 12.1799 4.01853 11.9712 4.17927 11.8173C4.34002 11.6634 4.55804 11.577 4.78537 11.577C5.01269 11.577 5.23071 11.6634 5.39146 11.8173C5.5522 11.9712 5.64251 12.1799 5.64251 12.3975ZM5.64251 9.11543C5.64251 9.33305 5.5522 9.54175 5.39146 9.69562C5.23071 9.8495 5.01269 9.93595 4.78537 9.93595C4.55804 9.93595 4.34002 9.8495 4.17927 9.69562C4.01853 9.54175 3.92822 9.33305 3.92822 9.11543C3.92822 8.89782 4.01853 8.68912 4.17927 8.53524C4.34002 8.38137 4.55804 8.29492 4.78537 8.29492C5.01269 8.29492 5.23071 8.38137 5.39146 8.53524C5.5522 8.68912 5.64251 8.89782 5.64251 9.11543Z" fill="#3B3731" />
                                                    </svg>
                                                    Wed, 18 Dec 2025
                                                </p>
                                            </div>
                                            <div class="bd-tile">
                                                <div class="bd-tile-label">
                                                    Time
                                                </div>
                                                <p class="bd-tile-value">
                                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
                                                        <circle cx="8" cy="8" r="6" stroke="#3B3731" stroke-width="1.5" />
                                                        <path d="M8 4.5V8L10.5 10" stroke="#3B3731" stroke-width="1.5" stroke-linecap="round" />
                                                    </svg>
                                                    14:30 - 18:30
                                                </p>
                                            </div>
                                            <div class="bd-tile">
                                                <div class="bd-tile-label">
                                                    Location
                                                </div>
                                                <p class="bd-tile-value">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="16" viewBox="0 0 12 16" fill="none">
                                                        <path d="M6 0.5C7.4694 0.5 8.87214 1.04525 9.90137 2.00586C10.9293 2.96529 11.4999 4.25871 11.5 5.59961C11.5 7.10011 10.6408 8.95946 9.51855 10.7236C8.41048 12.4655 7.10434 14.0263 6.32227 14.9082C6.14625 15.1067 5.85375 15.1067 5.67773 14.9082C4.89566 14.0263 3.58952 12.4655 2.48145 10.7236C1.35919 8.95946 0.5 7.10011 0.5 5.59961C0.500111 4.25871 1.07068 2.96529 2.09863 2.00586C3.12786 1.04525 4.53061 0.5 6 0.5ZM6 3.09961C5.30978 3.09961 4.64141 3.35564 4.14355 3.82031C3.64466 4.28597 3.35753 4.92517 3.35742 5.59961C3.35742 6.27422 3.64453 6.91413 4.14355 7.37988C4.64141 7.84453 5.30979 8.09961 6 8.09961C6.69022 8.09961 7.35859 7.84453 7.85645 7.37988C8.35534 6.91413 8.64247 6.27422 8.64258 5.59961C8.64258 4.92517 8.35534 4.28597 7.85645 3.82031C7.35859 3.35564 6.69022 3.09961 6 3.09961Z" stroke="#3B3731" />
                                                    </svg>
                                                    Victoria Embankment
                                                </p>
                                            </div>
                                        </div>

                                        <p class="bd-section-label">LOCATION &amp; ACCESS</p>
                                        <div class="bd-map-wrap">
                                            <img src="<?= BASE_URL ?>assets/images/modal_map.png" alt="Location map" class="bd-map-image">
                                        </div>

                                        <p class="bd-section-label">AMENITIES INCLUDED</p>
                                        <div class="bd-amenities">
                                            <div class="bd-amenity-tags">
                                                <span class="bd-amenity-tag"><svg xmlns="http://www.w3.org/2000/svg" width="12" height="9" viewBox="0 0 12 9" fill="none">
                                                        <path d="M0.75 4.75L4.25 8.25L11.25 0.75" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                    </svg> Grooming Table</span>
                                                <span class="bd-amenity-tag"><svg xmlns="http://www.w3.org/2000/svg" width="12" height="9" viewBox="0 0 12 9" fill="none">
                                                        <path d="M0.75 4.75L4.25 8.25L11.25 0.75" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                    </svg> Bath</span>
                                                <span class="bd-amenity-tag"><svg xmlns="http://www.w3.org/2000/svg" width="12" height="9" viewBox="0 0 12 9" fill="none">
                                                        <path d="M0.75 4.75L4.25 8.25L11.25 0.75" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                    </svg> Dryer</span>
                                                <span class="bd-amenity-tag"><svg xmlns="http://www.w3.org/2000/svg" width="12" height="9" viewBox="0 0 12 9" fill="none">
                                                        <path d="M0.75 4.75L4.25 8.25L11.25 0.75" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                    </svg> Towels</span>
                                                <span class="bd-amenity-tag"><svg xmlns="http://www.w3.org/2000/svg" width="12" height="9" viewBox="0 0 12 9" fill="none">
                                                        <path d="M0.75 4.75L4.25 8.25L11.25 0.75" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                    </svg> Waiting area</span>
                                                <span class="bd-amenity-tag"><svg xmlns="http://www.w3.org/2000/svg" width="12" height="9" viewBox="0 0 12 9" fill="none">
                                                        <path d="M0.75 4.75L4.25 8.25L11.25 0.75" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                    </svg> Parking</span>
                                                <span class="bd-amenity-tag"><svg xmlns="http://www.w3.org/2000/svg" width="12" height="9" viewBox="0 0 12 9" fill="none">
                                                        <path d="M0.75 4.75L4.25 8.25L11.25 0.75" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                    </svg> Wi-Fi</span>
                                            </div>
                                            <p class="bd-amenities-note">Extra towels - Premium shampoos - Drying crates - Tool storage (where available).</p>
                                        </div>

                                        <div class="bd-refund-banner">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 13 13" fill="none">
                                                <path d="M6.25 11.75C9.275 11.75 11.75 9.275 11.75 6.25C11.75 3.225 9.275 0.75 6.25 0.75C3.225 0.75 0.75 3.225 0.75 6.25C0.75 9.275 3.225 11.75 6.25 11.75Z" stroke="#A0BE63" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                <path d="M3.9126 6.24986L5.4691 7.80636L8.5876 4.69336" stroke="#A0BE63" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                            <div class="bd-refund-banner-text">
                                                <p class="bd-refund-banner-title">Partial refund of £48.00 processed</p>
                                                <p class="bd-refund-banner-sub">Refunded to Visa ending 4242 on 19 Oct 2025</p>
                                            </div>
                                        </div>

                                        <div class="bd-total-row">
                                            <span class="bd-total-label">Total Paid</span>
                                            <span class="bd-total-amount">£48.00</span>
                                        </div>

                                        <div class="bd-footer bd-footer--cancelled">
                                            <span class="bd-closed-label">This booking is closed</span>
                                            <a href="<?= BASE_URL ?>profiles/space/space_profile.php" class="bd-btn bd-btn-rebook">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                                    <path d="M3.2 6.2A5.5 5.5 0 0 1 12.8 5.1M12.8 9.8A5.5 5.5 0 0 1 3.2 10.9" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" />
                                                    <path d="M12.8 2.5V5.3H10M3.2 13.5V10.7H6" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round" />
                                                </svg>
                                                Rebook
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>



                            <div class="past-bookings">
                                <div class="mb-section">
                                    <h2 class="mb-section-label section-title">Completed</h2>

                                    <!-- Completed: Write a review -->
                                    <article class="mb-card mb-card--completed">
                                        <div class="mb-card__inner">
                                            <div class="mb-card__top">
                                                <div class="mb-card__top-left">
                                                    <span class="mb-status"><span class="mb-status__dot"></span> Completed</span>
                                                </div>
                                                <div class="mb-card__ref">
                                                    <span class="mb-card__ref-id">FG-10294</span>
                                                    <a href="#" class="mb-card__pdf"><svg xmlns="http://www.w3.org/2000/svg" width="12" height="14" viewBox="0 0 13 15" fill="none">
                                                            <path d="M3.07717 14.5H9.27418C9.95769 14.5 10.6132 14.2209 11.0965 13.7242C11.5798 13.2275 11.8514 12.5538 11.8514 11.8514V7.66649C11.8516 6.96411 11.5804 6.29039 11.0973 5.79351L6.70216 1.27568C6.46282 1.02973 6.1787 0.834645 5.86601 0.701554C5.55331 0.568463 5.21817 0.499975 4.87972 0.5H3.07717C2.39367 0.5 1.73815 0.779053 1.25484 1.27577C0.771523 1.77249 0.5 2.44618 0.5 3.14865V11.8514C0.5 12.5538 0.771523 13.2275 1.25484 13.7242C1.73815 14.2209 2.39367 14.5 3.07717 14.5Z" stroke="#3B3731" stroke-linecap="round" stroke-linejoin="round" />
                                                            <path d="M5.9458 0.772461V5.0557C5.9458 5.45711 6.10096 5.84208 6.37714 6.12592C6.65332 6.40976 7.0279 6.56922 7.41847 6.56922H11.5876" stroke="#3B3731" stroke-linecap="round" stroke-linejoin="round" />
                                                        </svg> PDF</a>
                                                </div>
                                            </div>
                                            <div class="mb-card__provider">
                                                <div class="mb-card__provider-left">
                                                    <div class="avatar-wrap">
                                                        <img class="avatar" src="<?= BASE_URL ?>assets/images/groomer-profile.png" alt="Sarah’s Grooming Studio">
                                                        <div class="badge-shield" title="Verified"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="33" viewBox="0 0 30 33" fill="none">
                                                                <ellipse cx="15.873" cy="16.5256" rx="9.3645" ry="8.81365" fill="white"></ellipse>
                                                                <path d="M15.44 0.185076C15.1841 0.0638192 14.9099 0 14.6235 0C14.3372 0 14.063 0.0638192 13.8071 0.185076L2.3337 5.28423C0.993208 5.87775 -0.00606541 7.26263 2.77146e-05 8.93469C0.0304934 15.2656 2.51649 26.8487 13.015 32.1138C14.0325 32.6244 15.2146 32.6244 16.2321 32.1138C26.7306 26.8487 29.2166 15.2656 29.247 8.93469C29.2531 7.26263 28.2539 5.87775 26.9134 5.28423L15.44 0.185076ZM8.82897 18.2651C9.12144 18.3416 9.43219 18.3799 9.74903 18.3799C11.8999 18.3799 13.6486 16.5483 13.6486 14.2955V10.2111H16.3418C17.0791 10.2111 17.7554 10.645 18.0844 11.3407L18.5231 12.2533H22.4227C22.9589 12.2533 23.3976 12.7128 23.3976 13.2744V15.3166C23.3976 18.1374 21.2163 20.4222 18.5231 20.4222H15.5984V23.6578C15.5984 24.1237 15.2389 24.5066 14.7881 24.5066C14.6784 24.5066 14.5687 24.4811 14.4712 24.4364L8.45729 21.7368C8.05514 21.5581 7.79923 21.1433 7.79923 20.6902C7.79923 20.5115 7.83579 20.3392 7.915 20.1796L8.82897 18.2651ZM8.77413 10.2111H11.6988V14.2955C11.6988 15.4251 10.8275 16.3377 9.74903 16.3377C8.67055 16.3377 7.79923 15.4251 7.79923 14.2955V11.2322C7.79923 10.6706 8.23794 10.2111 8.77413 10.2111ZM16.5733 13.2744C16.5733 13.0036 16.4706 12.7439 16.2878 12.5524C16.105 12.3609 15.857 12.2533 15.5984 12.2533C15.3399 12.2533 15.0919 12.3609 14.9091 12.5524C14.7262 12.7439 14.6235 13.0036 14.6235 13.2744C14.6235 13.5452 14.7262 13.8049 14.9091 13.9964C15.0919 14.1879 15.3399 14.2955 15.5984 14.2955C15.857 14.2955 16.105 14.1879 16.2878 13.9964C16.4706 13.8049 16.5733 13.5452 16.5733 13.2744Z" fill="#C9DDA0"></path>
                                                            </svg></div>
                                                    </div>
                                                    <div class="mb-card__provider-meta">
                                                        <div class="mb-card__title-row">
                                                            <h3 class="mb-card__studio">Sarah’s Grooming Studio</h3>
                                                            <span class="mb-tag mb-tag--orange">Home Visits</span>
                                                        </div>
                                                        <p class="mb-card__host">Sarah W.</p>
                                                    </div>
                                                </div>
                                                <div class="mb-card__price-block">
                                                    <p class="mb-card__date">18 Dec 2025</p>
                                                    <p class="mb-card__price">£48.00</p>
                                                </div>
                                            </div>
                                            <div class="mb-card__summary">
                                                <div class="mb-card__meta">
                                                    <div class="mb-meta-item"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="17" viewBox="0 0 16 17" fill="none">
                                                            <path d="M4.94591 11.5544C6.23114 12.8397 9.35699 11.798 11.9274 9.22713C14.4983 6.65667 15.54 3.53082 14.2548 2.24559M8.72754 1.37259L9.30927 1.95473M6.6915 3.40904L7.27322 3.99077M4.9455 5.73636L5.52722 6.31809M4.36377 8.6454L4.9455 9.22713M11.9274 0.5L12.5092 1.08173M11.3457 3.99118L12.5092 5.15463M9.30968 6.02763L10.4731 7.19109M6.98236 7.77281L8.14581 8.93627" stroke="#3B3731" stroke-linecap="round" stroke-linejoin="round" />
                                                            <path d="M4.94547 13.2998C5.42747 12.8178 5.42747 12.0364 4.94548 11.5544C4.46348 11.0724 3.68202 11.0724 3.20003 11.5544L0.872775 13.8816C0.390784 14.3636 0.390784 15.1451 0.872775 15.6271C1.35477 16.1091 2.13623 16.1091 2.61822 15.6271L4.94547 13.2998Z" stroke="#3B3731" stroke-linecap="round" stroke-linejoin="round" />
                                                        </svg> Full Groom</div>
                                                    <div class="mb-meta-item"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 19 17" fill="none">
                                                            <path d="M0.5 8.29554C0.5 5.20139 0.5 3.6539 1.50457 2.69308C2.50914 1.73227 4.12486 1.73145 7.35714 1.73145H10.7857C14.018 1.73145 15.6346 1.73145 16.6383 2.69308C17.642 3.65472 17.6429 5.20139 17.6429 8.29554V9.93656C17.6429 13.0307 17.6429 14.5782 16.6383 15.539C15.6337 16.4998 14.018 16.5007 10.7857 16.5007H7.35714C4.12486 16.5007 2.50829 16.5007 1.50457 15.539C0.500857 14.5774 0.5 13.0307 0.5 9.93656V8.29554Z" stroke="#3B3731" />
                                                            <path d="M4.78585 1.73077V0.5M13.3573 1.73077V0.5M0.928711 5.83333H17.2144" stroke="#3B3731" stroke-linecap="round" />
                                                        </svg> Wed, 18 Dec 2025</div>
                                                    <div class="mb-meta-item"><svg width="15" height="15" viewBox="0 0 16 16" fill="none">
                                                            <circle cx="8" cy="8" r="6" stroke="#3B3731" stroke-width="1.5" />
                                                            <path d="M8 4.5V8L10.5 10" stroke="#3B3731" stroke-width="1.5" stroke-linecap="round" />
                                                        </svg> 14:30 - 15:30</div>
                                                    <div class="mb-meta-item"><svg xmlns="http://www.w3.org/2000/svg" width="12" height="16" viewBox="0 0 12 16" fill="none">
                                                            <path d="M6 0.5C7.4694 0.5 8.87214 1.04525 9.90137 2.00586C10.9293 2.96529 11.4999 4.25871 11.5 5.59961C11.5 7.10011 10.6408 8.95946 9.51855 10.7236C8.41048 12.4655 7.10434 14.0263 6.32227 14.9082C6.14625 15.1067 5.85375 15.1067 5.67773 14.9082C4.89566 14.0263 3.58952 12.4655 2.48145 10.7236C1.35919 8.95946 0.5 7.10011 0.5 5.59961C0.500111 4.25871 1.07068 2.96529 2.09863 2.00586C3.12786 1.04525 4.53061 0.5 6 0.5ZM6 3.09961C5.30978 3.09961 4.64141 3.35564 4.14355 3.82031C3.64466 4.28597 3.35753 4.92517 3.35742 5.59961C3.35742 6.27422 3.64453 6.91413 4.14355 7.37988C4.64141 7.84453 5.30979 8.09961 6 8.09961C6.69022 8.09961 7.35859 7.84453 7.85645 7.37988C8.35534 6.91413 8.64247 6.27422 8.64258 5.59961C8.64258 4.92517 8.35534 4.28597 7.85645 3.82031C7.35859 3.35564 6.69022 3.09961 6 3.09961Z" stroke="#3B3731" />
                                                        </svg> At your home</div>
                                                </div>
                                                <div class="mb-pet">
                                                    <div class="mb-pet__avatars">
                                                        <img src="<?= BASE_URL ?>assets/images/pet_details_1.png" alt="Pet">
                                                    </div>
                                                    <span class="mb-pet__label">Bella · Rabbit <span class="mb-pet__label-sub">(Mini Lop)</span></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-card__footer">
                                            <div class="mb-card__footer-left">
                                                <button type="button" class="mb-btn" data-modal-open="view_booking_groom_completed_modal"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="14" viewBox="0 0 18 14" fill="none">
                                                        <path d="M1.5 7C1.5 7 4.1 1.5 9 1.5C13.9 1.5 16.5 7 16.5 7C16.5 7 13.9 12.5 9 12.5C4.1 12.5 1.5 7 1.5 7Z" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round" />
                                                        <circle cx="9" cy="7" r="2.25" stroke="currentColor" stroke-width="1.4" />
                                                    </svg> View details</button>
                                                <a href="<?= BASE_URL ?>profiles/groomer/groomer_profile.php" class="mb-btn mb-btn--blue"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                                        <path d="M2.2312 15.4953V12.6124H5.11403" stroke="#6FA0C3" stroke-linecap="round" stroke-linejoin="round" />
                                                        <path d="M15.3656 6.62252C15.6715 8.25452 15.4269 9.94189 14.6702 11.4199C13.9135 12.8978 12.6875 14.0827 11.1846 14.7887C9.68175 15.4946 7.98704 15.6817 6.3664 15.3204C4.74575 14.9592 3.2909 14.0701 2.23013 12.7927M0.628303 9.37748C0.322432 7.74548 0.567036 6.05811 1.32373 4.58014C2.08043 3.10218 3.3064 1.91725 4.80927 1.2113C6.31214 0.505355 8.00686 0.318331 9.6275 0.679579C11.2481 1.04083 12.703 1.9299 13.7638 3.2073" stroke="#6FA0C3" stroke-linecap="round" stroke-linejoin="round" />
                                                        <path d="M13.7626 0.504883V3.38771H10.8798" stroke="#6FA0C3" stroke-linecap="round" stroke-linejoin="round" />
                                                    </svg> Rebook</a>
                                                <a href="<?= BASE_URL ?>messages_notification/messages.php" class="mb-btn-icon" title="Message groomer"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                                        <path d="M2.2 7.4C2.2 4.9 4.4 2.8 7.1 2.8H8.9C11.6 2.8 13.8 4.9 13.8 7.4C13.8 9.9 11.6 12 8.9 12H7.8L5.2 13.7V12C3.4 11.4 2.2 9.5 2.2 7.4Z" stroke="currentColor" stroke-width="1.3" stroke-linejoin="round" />
                                                    </svg></a>
                                            </div>
                                            <button type="button" class="mb-btn mb-btn--orange" data-modal-open="review-modal"><svg xmlns="http://www.w3.org/2000/svg" width="15" height="14" viewBox="0 0 15 14" fill="none">
                                                    <path d="M6.12798 0.704926C6.41816 -0.235151 7.74883 -0.235151 8.03901 0.704926L8.99875 3.81415C9.12813 4.23331 9.51559 4.51921 9.95426 4.51921H13.1649C14.1211 4.51921 14.5319 5.73262 13.7723 6.31353L11.0881 8.36635C10.7555 8.62075 10.6166 9.05548 10.7401 9.45562L11.7443 12.7089C12.0315 13.6393 10.9548 14.3897 10.1813 13.7982L7.69098 11.8936C7.33241 11.6194 6.83458 11.6194 6.47601 11.8936L3.98566 13.7982C3.2122 14.3897 2.13547 13.6393 2.42266 12.7089L3.42687 9.45562C3.55038 9.05548 3.41149 8.62075 3.07884 8.36635L0.394656 6.31353C-0.364931 5.73262 0.045882 4.51921 1.00214 4.51921H4.21273C4.65141 4.51921 5.03886 4.23331 5.16825 3.81415L6.12798 0.704926Z" fill="#FFBF61" />
                                                </svg> Write a review</button>
                                        </div>
                                    </article>

                                    <!-- Completed: Reviewed -->
                                    <article class="mb-card mb-card--completed">
                                        <div class="mb-card__inner">
                                            <div class="mb-card__top">
                                                <div class="mb-card__top-left">
                                                    <span class="mb-status"><span class="mb-status__dot"></span> Completed</span>
                                                </div>
                                                <div class="mb-card__ref">
                                                    <span class="mb-card__ref-id">FG-10294</span>
                                                    <a href="#" class="mb-card__pdf"><svg xmlns="http://www.w3.org/2000/svg" width="12" height="14" viewBox="0 0 13 15" fill="none">
                                                            <path d="M3.07717 14.5H9.27418C9.95769 14.5 10.6132 14.2209 11.0965 13.7242C11.5798 13.2275 11.8514 12.5538 11.8514 11.8514V7.66649C11.8516 6.96411 11.5804 6.29039 11.0973 5.79351L6.70216 1.27568C6.46282 1.02973 6.1787 0.834645 5.86601 0.701554C5.55331 0.568463 5.21817 0.499975 4.87972 0.5H3.07717C2.39367 0.5 1.73815 0.779053 1.25484 1.27577C0.771523 1.77249 0.5 2.44618 0.5 3.14865V11.8514C0.5 12.5538 0.771523 13.2275 1.25484 13.7242C1.73815 14.2209 2.39367 14.5 3.07717 14.5Z" stroke="#3B3731" stroke-linecap="round" stroke-linejoin="round" />
                                                            <path d="M5.9458 0.772461V5.0557C5.9458 5.45711 6.10096 5.84208 6.37714 6.12592C6.65332 6.40976 7.0279 6.56922 7.41847 6.56922H11.5876" stroke="#3B3731" stroke-linecap="round" stroke-linejoin="round" />
                                                        </svg> PDF</a>
                                                </div>
                                            </div>
                                            <div class="mb-card__provider">
                                                <div class="mb-card__provider-left">
                                                    <div class="avatar-wrap">
                                                        <img class="avatar" src="<?= BASE_URL ?>assets/images/groomer-profile.png" alt="Sarah’s Grooming Studio">
                                                        <div class="badge-shield" title="Verified"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="33" viewBox="0 0 30 33" fill="none">
                                                                <ellipse cx="15.873" cy="16.5256" rx="9.3645" ry="8.81365" fill="white"></ellipse>
                                                                <path d="M15.44 0.185076C15.1841 0.0638192 14.9099 0 14.6235 0C14.3372 0 14.063 0.0638192 13.8071 0.185076L2.3337 5.28423C0.993208 5.87775 -0.00606541 7.26263 2.77146e-05 8.93469C0.0304934 15.2656 2.51649 26.8487 13.015 32.1138C14.0325 32.6244 15.2146 32.6244 16.2321 32.1138C26.7306 26.8487 29.2166 15.2656 29.247 8.93469C29.2531 7.26263 28.2539 5.87775 26.9134 5.28423L15.44 0.185076ZM8.82897 18.2651C9.12144 18.3416 9.43219 18.3799 9.74903 18.3799C11.8999 18.3799 13.6486 16.5483 13.6486 14.2955V10.2111H16.3418C17.0791 10.2111 17.7554 10.645 18.0844 11.3407L18.5231 12.2533H22.4227C22.9589 12.2533 23.3976 12.7128 23.3976 13.2744V15.3166C23.3976 18.1374 21.2163 20.4222 18.5231 20.4222H15.5984V23.6578C15.5984 24.1237 15.2389 24.5066 14.7881 24.5066C14.6784 24.5066 14.5687 24.4811 14.4712 24.4364L8.45729 21.7368C8.05514 21.5581 7.79923 21.1433 7.79923 20.6902C7.79923 20.5115 7.83579 20.3392 7.915 20.1796L8.82897 18.2651ZM8.77413 10.2111H11.6988V14.2955C11.6988 15.4251 10.8275 16.3377 9.74903 16.3377C8.67055 16.3377 7.79923 15.4251 7.79923 14.2955V11.2322C7.79923 10.6706 8.23794 10.2111 8.77413 10.2111ZM16.5733 13.2744C16.5733 13.0036 16.4706 12.7439 16.2878 12.5524C16.105 12.3609 15.857 12.2533 15.5984 12.2533C15.3399 12.2533 15.0919 12.3609 14.9091 12.5524C14.7262 12.7439 14.6235 13.0036 14.6235 13.2744C14.6235 13.5452 14.7262 13.8049 14.9091 13.9964C15.0919 14.1879 15.3399 14.2955 15.5984 14.2955C15.857 14.2955 16.105 14.1879 16.2878 13.9964C16.4706 13.8049 16.5733 13.5452 16.5733 13.2744Z" fill="#C9DDA0"></path>
                                                            </svg></div>
                                                    </div>
                                                    <div class="mb-card__provider-meta">
                                                        <div class="mb-card__title-row">
                                                            <h3 class="mb-card__studio">Sarah’s Grooming Studio</h3>
                                                            <span class="mb-tag mb-tag--orange">Home Visits</span>
                                                        </div>
                                                        <p class="mb-card__host">Sarah W.</p>
                                                    </div>
                                                </div>
                                                <div class="mb-card__price-block">
                                                    <p class="mb-card__date">18 Dec 2025</p>
                                                    <p class="mb-card__price">£48.00</p>
                                                </div>
                                            </div>
                                            <div class="mb-card__summary">
                                                <div class="mb-card__meta">
                                                    <div class="mb-meta-item"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="17" viewBox="0 0 16 17" fill="none">
                                                            <path d="M4.94591 11.5544C6.23114 12.8397 9.35699 11.798 11.9274 9.22713C14.4983 6.65667 15.54 3.53082 14.2548 2.24559M8.72754 1.37259L9.30927 1.95473M6.6915 3.40904L7.27322 3.99077M4.9455 5.73636L5.52722 6.31809M4.36377 8.6454L4.9455 9.22713M11.9274 0.5L12.5092 1.08173M11.3457 3.99118L12.5092 5.15463M9.30968 6.02763L10.4731 7.19109M6.98236 7.77281L8.14581 8.93627" stroke="#3B3731" stroke-linecap="round" stroke-linejoin="round" />
                                                            <path d="M4.94547 13.2998C5.42747 12.8178 5.42747 12.0364 4.94548 11.5544C4.46348 11.0724 3.68202 11.0724 3.20003 11.5544L0.872775 13.8816C0.390784 14.3636 0.390784 15.1451 0.872775 15.6271C1.35477 16.1091 2.13623 16.1091 2.61822 15.6271L4.94547 13.2998Z" stroke="#3B3731" stroke-linecap="round" stroke-linejoin="round" />
                                                        </svg> Full Groom</div>
                                                    <div class="mb-meta-item"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 19 17" fill="none">
                                                            <path d="M0.5 8.29554C0.5 5.20139 0.5 3.6539 1.50457 2.69308C2.50914 1.73227 4.12486 1.73145 7.35714 1.73145H10.7857C14.018 1.73145 15.6346 1.73145 16.6383 2.69308C17.642 3.65472 17.6429 5.20139 17.6429 8.29554V9.93656C17.6429 13.0307 17.6429 14.5782 16.6383 15.539C15.6337 16.4998 14.018 16.5007 10.7857 16.5007H7.35714C4.12486 16.5007 2.50829 16.5007 1.50457 15.539C0.500857 14.5774 0.5 13.0307 0.5 9.93656V8.29554Z" stroke="#3B3731" />
                                                            <path d="M4.78585 1.73077V0.5M13.3573 1.73077V0.5M0.928711 5.83333H17.2144" stroke="#3B3731" stroke-linecap="round" />
                                                        </svg> Wed, 18 Dec 2025</div>
                                                    <div class="mb-meta-item"><svg width="15" height="15" viewBox="0 0 16 16" fill="none">
                                                            <circle cx="8" cy="8" r="6" stroke="#3B3731" stroke-width="1.5" />
                                                            <path d="M8 4.5V8L10.5 10" stroke="#3B3731" stroke-width="1.5" stroke-linecap="round" />
                                                        </svg> 14:30 - 15:30</div>
                                                    <div class="mb-meta-item"><svg xmlns="http://www.w3.org/2000/svg" width="12" height="16" viewBox="0 0 12 16" fill="none">
                                                            <path d="M6 0.5C7.4694 0.5 8.87214 1.04525 9.90137 2.00586C10.9293 2.96529 11.4999 4.25871 11.5 5.59961C11.5 7.10011 10.6408 8.95946 9.51855 10.7236C8.41048 12.4655 7.10434 14.0263 6.32227 14.9082C6.14625 15.1067 5.85375 15.1067 5.67773 14.9082C4.89566 14.0263 3.58952 12.4655 2.48145 10.7236C1.35919 8.95946 0.5 7.10011 0.5 5.59961C0.500111 4.25871 1.07068 2.96529 2.09863 2.00586C3.12786 1.04525 4.53061 0.5 6 0.5ZM6 3.09961C5.30978 3.09961 4.64141 3.35564 4.14355 3.82031C3.64466 4.28597 3.35753 4.92517 3.35742 5.59961C3.35742 6.27422 3.64453 6.91413 4.14355 7.37988C4.64141 7.84453 5.30979 8.09961 6 8.09961C6.69022 8.09961 7.35859 7.84453 7.85645 7.37988C8.35534 6.91413 8.64247 6.27422 8.64258 5.59961C8.64258 4.92517 8.35534 4.28597 7.85645 3.82031C7.35859 3.35564 6.69022 3.09961 6 3.09961Z" stroke="#3B3731" />
                                                        </svg> At your home</div>
                                                </div>
                                                <div class="mb-pet">
                                                    <div class="mb-pet__avatars">
                                                        <img src="<?= BASE_URL ?>assets/images/pet_details_1.png" alt="Pet">
                                                        <img src="<?= BASE_URL ?>assets/images/pet_details_2.png" alt="Pet">
                                                    </div>
                                                    <span class="mb-pet__label">Bella <span class="mb-pet__label-sub muted-color">+1</span></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-card__footer">
                                            <div class="mb-card__footer-left">
                                                <button type="button" class="mb-btn" data-modal-open="view_booking_groom_completed_modal"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="14" viewBox="0 0 18 14" fill="none">
                                                        <path d="M1.5 7C1.5 7 4.1 1.5 9 1.5C13.9 1.5 16.5 7 16.5 7C16.5 7 13.9 12.5 9 12.5C4.1 12.5 1.5 7 1.5 7Z" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round" />
                                                        <circle cx="9" cy="7" r="2.25" stroke="currentColor" stroke-width="1.4" />
                                                    </svg> View details</button>
                                                <a href="<?= BASE_URL ?>profiles/groomer/groomer_profile.php" class="mb-btn mb-btn--blue"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                                        <path d="M2.2312 15.4953V12.6124H5.11403" stroke="#6FA0C3" stroke-linecap="round" stroke-linejoin="round" />
                                                        <path d="M15.3656 6.62252C15.6715 8.25452 15.4269 9.94189 14.6702 11.4199C13.9135 12.8978 12.6875 14.0827 11.1846 14.7887C9.68175 15.4946 7.98704 15.6817 6.3664 15.3204C4.74575 14.9592 3.2909 14.0701 2.23013 12.7927M0.628303 9.37748C0.322432 7.74548 0.567036 6.05811 1.32373 4.58014C2.08043 3.10218 3.3064 1.91725 4.80927 1.2113C6.31214 0.505355 8.00686 0.318331 9.6275 0.679579C11.2481 1.04083 12.703 1.9299 13.7638 3.2073" stroke="#6FA0C3" stroke-linecap="round" stroke-linejoin="round" />
                                                        <path d="M13.7626 0.504883V3.38771H10.8798" stroke="#6FA0C3" stroke-linecap="round" stroke-linejoin="round" />
                                                    </svg> Rebook</a>
                                                <a href="<?= BASE_URL ?>messages_notification/messages.php" class="mb-btn-icon" title="Message groomer"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                                        <path d="M2.2 7.4C2.2 4.9 4.4 2.8 7.1 2.8H8.9C11.6 2.8 13.8 4.9 13.8 7.4C13.8 9.9 11.6 12 8.9 12H7.8L5.2 13.7V12C3.4 11.4 2.2 9.5 2.2 7.4Z" stroke="currentColor" stroke-width="1.3" stroke-linejoin="round" />
                                                    </svg></a>
                                            </div>
                                            <span class="mb-btn mb-btn--muted"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                                                    <path d="M2.5 7.2L5.5 10.2L11.5 3.8" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                </svg> Reviewed</span>
                                        </div>
                                    </article>

                                    <!-- Completed: Space (Reviewed) -->
                                    <article class="mb-card mb-card--completed">
                                        <div class="mb-card__inner">
                                            <div class="mb-card__top">
                                                <div class="mb-card__top-left">
                                                    <span class="mb-status"><span class="mb-status__dot"></span> Completed</span>
                                                </div>
                                                <div class="mb-card__ref">
                                                    <span class="mb-card__ref-id">FG-10294</span>
                                                    <a href="#" class="mb-card__pdf">PDF</a>
                                                </div>
                                            </div>
                                            <div class="mb-card__provider">
                                                <div class="mb-card__provider-left">
                                                    <div class="avatar-wrap">
                                                        <img class="avatar" src="<?= BASE_URL ?>assets/images/space_card3.png" alt="Furs &amp; Co. Studio">
                                                    </div>
                                                    <div class="mb-card__provider-meta">
                                                        <div class="mb-card__title-row">
                                                            <h3 class="mb-card__studio">Furs &amp; Co. Studio</h3>
                                                            <span class="mb-tag mb-tag--coral">Garden / Shed</span>
                                                        </div>
                                                        <p class="mb-card__host">Dev É.</p>
                                                    </div>
                                                </div>
                                                <div class="mb-card__price-block">
                                                    <p class="mb-card__date">18 Dec 2025</p>
                                                    <p class="mb-card__price">£48.00</p>
                                                </div>
                                            </div>
                                            <div class="mb-card__summary">
                                                <div class="mb-card__meta">
                                                    <div class="mb-meta-item">Half-Day</div>
                                                    <div class="mb-meta-item">Wed, 18 Dec 2025</div>
                                                    <div class="mb-meta-item">14:30 - 18:30</div>
                                                    <div class="mb-meta-item">Victoria Embankment</div>
                                                </div>
                                                <div class="mb-pet">
                                                    <div class="mb-pet__avatars">
                                                        <img src="<?= BASE_URL ?>assets/images/pet_details_1.png" alt="Pet">
                                                        <img src="<?= BASE_URL ?>assets/images/pet_details_2.png" alt="Pet">
                                                    </div>
                                                    <span class="mb-pet__label">Bella <span class="mb-pet__label-sub muted-color">+1</span></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-card__footer">
                                            <div class="mb-card__footer-left">
                                                <button type="button" class="mb-btn" data-modal-open="view_booking_space_completed_modal">View details</button>
                                                <a href="<?= BASE_URL ?>profiles/space/space_profile.php" class="mb-btn mb-btn--blue">Rebook</a>
                                            </div>
                                            <span class="mb-btn mb-btn--muted">Reviewed</span>
                                        </div>
                                    </article>

                                </div>
                            </div>


                            <div class="cancelled-bookings">
                                <div class="mb-section">
                                    <h2 class="mb-section-label section-title">Cancelled</h2>

                                    <!-- Cancelled by you -->
                                    <article class="mb-card mb-card--cancelled">
                                        <div class="mb-card__inner">
                                            <div class="mb-card__top">
                                                <div class="mb-card__top-left">
                                                    <span class="mb-status"><span class="mb-status__dot"></span> Cancelled</span>
                                                    <span class="mb-refund"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="10" viewBox="0 0 14 10" fill="none">
                                                            <path d="M4.32184 8.08144L1.42224 5.32189C1.266 5.17319 1.05409 5.08966 0.83313 5.08966C0.61217 5.08966 0.40026 5.17319 0.244018 5.32189C0.0877759 5.47058 0 5.67226 0 5.88255C0 5.98667 0.0215497 6.08977 0.0634184 6.18597C0.105287 6.28217 0.166655 6.36958 0.244018 6.4432L3.73691 9.76739C4.0628 10.0775 4.58924 10.0775 4.91513 9.76739L13.756 1.35355C13.9122 1.20485 14 1.00318 14 0.79289C14 0.582602 13.9122 0.380928 13.756 0.232232C13.5997 0.0835365 13.3878 0 13.1669 0C12.9459 0 12.734 0.0835365 12.5778 0.232232L4.32184 8.08144Z" fill="#A4C463" />
                                                        </svg> Full refund of £48.00 processed</span>
                                                    <span class="mb-cancel-by"><svg xmlns="http://www.w3.org/2000/svg" width="12" height="13" viewBox="0 0 12 13" fill="none">
                                                            <circle cx="6" cy="3.5" r="2.5" stroke="currentColor" />
                                                            <path d="M1 11.5C1 9.29086 3.23858 7.5 6 7.5C8.76142 7.5 11 9.29086 11 11.5" stroke="currentColor" stroke-linecap="round" />
                                                        </svg> Cancelled by you</span>
                                                </div>
                                                <div class="mb-card__ref">
                                                    <span class="mb-card__ref-id">FG-10294</span>
                                                    <a href="#" class="mb-card__pdf"><svg xmlns="http://www.w3.org/2000/svg" width="12" height="14" viewBox="0 0 13 15" fill="none">
                                                            <path d="M3.07717 14.5H9.27418C9.95769 14.5 10.6132 14.2209 11.0965 13.7242C11.5798 13.2275 11.8514 12.5538 11.8514 11.8514V7.66649C11.8516 6.96411 11.5804 6.29039 11.0973 5.79351L6.70216 1.27568C6.46282 1.02973 6.1787 0.834645 5.86601 0.701554C5.55331 0.568463 5.21817 0.499975 4.87972 0.5H3.07717C2.39367 0.5 1.73815 0.779053 1.25484 1.27577C0.771523 1.77249 0.5 2.44618 0.5 3.14865V11.8514C0.5 12.5538 0.771523 13.2275 1.25484 13.7242C1.73815 14.2209 2.39367 14.5 3.07717 14.5Z" stroke="#3B3731" stroke-linecap="round" stroke-linejoin="round" />
                                                            <path d="M5.9458 0.772461V5.0557C5.9458 5.45711 6.10096 5.84208 6.37714 6.12592C6.65332 6.40976 7.0279 6.56922 7.41847 6.56922H11.5876" stroke="#3B3731" stroke-linecap="round" stroke-linejoin="round" />
                                                        </svg> PDF</a>
                                                </div>
                                            </div>
                                            <div class="mb-card__provider">
                                                <div class="mb-card__provider-left">
                                                    <div class="avatar-wrap">
                                                        <img class="avatar" src="<?= BASE_URL ?>assets/images/groomer-profile.png" alt="Sarah’s Grooming Studio">
                                                        <div class="badge-shield" title="Verified"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="33" viewBox="0 0 30 33" fill="none">
                                                                <ellipse cx="15.873" cy="16.5256" rx="9.3645" ry="8.81365" fill="white"></ellipse>
                                                                <path d="M15.44 0.185076C15.1841 0.0638192 14.9099 0 14.6235 0C14.3372 0 14.063 0.0638192 13.8071 0.185076L2.3337 5.28423C0.993208 5.87775 -0.00606541 7.26263 2.77146e-05 8.93469C0.0304934 15.2656 2.51649 26.8487 13.015 32.1138C14.0325 32.6244 15.2146 32.6244 16.2321 32.1138C26.7306 26.8487 29.2166 15.2656 29.247 8.93469C29.2531 7.26263 28.2539 5.87775 26.9134 5.28423L15.44 0.185076ZM8.82897 18.2651C9.12144 18.3416 9.43219 18.3799 9.74903 18.3799C11.8999 18.3799 13.6486 16.5483 13.6486 14.2955V10.2111H16.3418C17.0791 10.2111 17.7554 10.645 18.0844 11.3407L18.5231 12.2533H22.4227C22.9589 12.2533 23.3976 12.7128 23.3976 13.2744V15.3166C23.3976 18.1374 21.2163 20.4222 18.5231 20.4222H15.5984V23.6578C15.5984 24.1237 15.2389 24.5066 14.7881 24.5066C14.6784 24.5066 14.5687 24.4811 14.4712 24.4364L8.45729 21.7368C8.05514 21.5581 7.79923 21.1433 7.79923 20.6902C7.79923 20.5115 7.83579 20.3392 7.915 20.1796L8.82897 18.2651ZM8.77413 10.2111H11.6988V14.2955C11.6988 15.4251 10.8275 16.3377 9.74903 16.3377C8.67055 16.3377 7.79923 15.4251 7.79923 14.2955V11.2322C7.79923 10.6706 8.23794 10.2111 8.77413 10.2111ZM16.5733 13.2744C16.5733 13.0036 16.4706 12.7439 16.2878 12.5524C16.105 12.3609 15.857 12.2533 15.5984 12.2533C15.3399 12.2533 15.0919 12.3609 14.9091 12.5524C14.7262 12.7439 14.6235 13.0036 14.6235 13.2744C14.6235 13.5452 14.7262 13.8049 14.9091 13.9964C15.0919 14.1879 15.3399 14.2955 15.5984 14.2955C15.857 14.2955 16.105 14.1879 16.2878 13.9964C16.4706 13.8049 16.5733 13.5452 16.5733 13.2744Z" fill="#C9DDA0"></path>
                                                            </svg></div>
                                                    </div>
                                                    <div class="mb-card__provider-meta">
                                                        <div class="mb-card__title-row">
                                                            <h3 class="mb-card__studio">Sarah’s Grooming Studio</h3>
                                                            <span class="mb-tag mb-tag--orange">Home Visits</span>
                                                        </div>
                                                        <p class="mb-card__host">Sarah W.</p>
                                                    </div>
                                                </div>
                                                <div class="mb-card__price-block">
                                                    <p class="mb-card__date">18 Dec 2025</p>
                                                    <p class="mb-card__price">£48.00</p>
                                                </div>
                                            </div>
                                            <div class="mb-card__summary">
                                                <div class="mb-card__meta">
                                                    <div class="mb-meta-item"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="17" viewBox="0 0 16 17" fill="none">
                                                            <path d="M4.94591 11.5544C6.23114 12.8397 9.35699 11.798 11.9274 9.22713C14.4983 6.65667 15.54 3.53082 14.2548 2.24559M8.72754 1.37259L9.30927 1.95473M6.6915 3.40904L7.27322 3.99077M4.9455 5.73636L5.52722 6.31809M4.36377 8.6454L4.9455 9.22713M11.9274 0.5L12.5092 1.08173M11.3457 3.99118L12.5092 5.15463M9.30968 6.02763L10.4731 7.19109M6.98236 7.77281L8.14581 8.93627" stroke="#3B3731" stroke-linecap="round" stroke-linejoin="round" />
                                                            <path d="M4.94547 13.2998C5.42747 12.8178 5.42747 12.0364 4.94548 11.5544C4.46348 11.0724 3.68202 11.0724 3.20003 11.5544L0.872775 13.8816C0.390784 14.3636 0.390784 15.1451 0.872775 15.6271C1.35477 16.1091 2.13623 16.1091 2.61822 15.6271L4.94547 13.2998Z" stroke="#3B3731" stroke-linecap="round" stroke-linejoin="round" />
                                                        </svg> Face Trim Only</div>
                                                    <div class="mb-meta-item"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 19 17" fill="none">
                                                            <path d="M0.5 8.29554C0.5 5.20139 0.5 3.6539 1.50457 2.69308C2.50914 1.73227 4.12486 1.73145 7.35714 1.73145H10.7857C14.018 1.73145 15.6346 1.73145 16.6383 2.69308C17.642 3.65472 17.6429 5.20139 17.6429 8.29554V9.93656C17.6429 13.0307 17.6429 14.5782 16.6383 15.539C15.6337 16.4998 14.018 16.5007 10.7857 16.5007H7.35714C4.12486 16.5007 2.50829 16.5007 1.50457 15.539C0.500857 14.5774 0.5 13.0307 0.5 9.93656V8.29554Z" stroke="#3B3731" />
                                                            <path d="M4.78585 1.73077V0.5M13.3573 1.73077V0.5M0.928711 5.83333H17.2144" stroke="#3B3731" stroke-linecap="round" />
                                                        </svg> Wed, 18 Dec 2025</div>
                                                    <div class="mb-meta-item"><svg width="15" height="15" viewBox="0 0 16 16" fill="none">
                                                            <circle cx="8" cy="8" r="6" stroke="#3B3731" stroke-width="1.5" />
                                                            <path d="M8 4.5V8L10.5 10" stroke="#3B3731" stroke-width="1.5" stroke-linecap="round" />
                                                        </svg> 14:30 - 15:30</div>
                                                    <div class="mb-meta-item"><svg xmlns="http://www.w3.org/2000/svg" width="12" height="16" viewBox="0 0 12 16" fill="none">
                                                            <path d="M6 0.5C7.4694 0.5 8.87214 1.04525 9.90137 2.00586C10.9293 2.96529 11.4999 4.25871 11.5 5.59961C11.5 7.10011 10.6408 8.95946 9.51855 10.7236C8.41048 12.4655 7.10434 14.0263 6.32227 14.9082C6.14625 15.1067 5.85375 15.1067 5.67773 14.9082C4.89566 14.0263 3.58952 12.4655 2.48145 10.7236C1.35919 8.95946 0.5 7.10011 0.5 5.59961C0.500111 4.25871 1.07068 2.96529 2.09863 2.00586C3.12786 1.04525 4.53061 0.5 6 0.5ZM6 3.09961C5.30978 3.09961 4.64141 3.35564 4.14355 3.82031C3.64466 4.28597 3.35753 4.92517 3.35742 5.59961C3.35742 6.27422 3.64453 6.91413 4.14355 7.37988C4.64141 7.84453 5.30979 8.09961 6 8.09961C6.69022 8.09961 7.35859 7.84453 7.85645 7.37988C8.35534 6.91413 8.64247 6.27422 8.64258 5.59961C8.64258 4.92517 8.35534 4.28597 7.85645 3.82031C7.35859 3.35564 6.69022 3.09961 6 3.09961Z" stroke="#3B3731" />
                                                        </svg> At your home</div>
                                                </div>
                                                <div class="mb-pet">
                                                    <div class="mb-pet__avatars">
                                                        <img src="<?= BASE_URL ?>assets/images/pet_details_1.png" alt="Pet">
                                                        <img src="<?= BASE_URL ?>assets/images/pet_details_2.png" alt="Pet">
                                                    </div>
                                                    <span class="mb-pet__label">Bella <span class="mb-pet__label-sub muted-color">+1</span></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-card__footer">
                                            <div class="mb-card__footer-left">
                                                <button type="button" class="mb-btn" data-modal-open="view_booking_groom_cancelled_modal"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="14" viewBox="0 0 18 14" fill="none">
                                                        <path d="M1.5 7C1.5 7 4.1 1.5 9 1.5C13.9 1.5 16.5 7 16.5 7C16.5 7 13.9 12.5 9 12.5C4.1 12.5 1.5 7 1.5 7Z" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round" />
                                                        <circle cx="9" cy="7" r="2.25" stroke="currentColor" stroke-width="1.4" />
                                                    </svg> View details</button>
                                                <a href="<?= BASE_URL ?>profiles/groomer/groomer_profile.php" class="mb-btn mb-btn--blue"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                                        <path d="M2.2312 15.4953V12.6124H5.11403" stroke="#6FA0C3" stroke-linecap="round" stroke-linejoin="round" />
                                                        <path d="M15.3656 6.62252C15.6715 8.25452 15.4269 9.94189 14.6702 11.4199C13.9135 12.8978 12.6875 14.0827 11.1846 14.7887C9.68175 15.4946 7.98704 15.6817 6.3664 15.3204C4.74575 14.9592 3.2909 14.0701 2.23013 12.7927M0.628303 9.37748C0.322432 7.74548 0.567036 6.05811 1.32373 4.58014C2.08043 3.10218 3.3064 1.91725 4.80927 1.2113C6.31214 0.505355 8.00686 0.318331 9.6275 0.679579C11.2481 1.04083 12.703 1.9299 13.7638 3.2073" stroke="#6FA0C3" stroke-linecap="round" stroke-linejoin="round" />
                                                        <path d="M13.7626 0.504883V3.38771H10.8798" stroke="#6FA0C3" stroke-linecap="round" stroke-linejoin="round" />
                                                    </svg> Rebook</a>
                                            </div>
                                        </div>
                                    </article>

                                    <!-- Cancelled by host (space, no pet) -->
                                    <article class="mb-card mb-card--cancelled">
                                        <div class="mb-card__inner">
                                            <div class="mb-card__top">
                                                <div class="mb-card__top-left">
                                                    <span class="mb-status"><span class="mb-status__dot"></span> Cancelled</span>
                                                    <span class="mb-refund"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="10" viewBox="0 0 14 10" fill="none">
                                                            <path d="M4.32184 8.08144L1.42224 5.32189C1.266 5.17319 1.05409 5.08966 0.83313 5.08966C0.61217 5.08966 0.40026 5.17319 0.244018 5.32189C0.0877759 5.47058 0 5.67226 0 5.88255C0 5.98667 0.0215497 6.08977 0.0634184 6.18597C0.105287 6.28217 0.166655 6.36958 0.244018 6.4432L3.73691 9.76739C4.0628 10.0775 4.58924 10.0775 4.91513 9.76739L13.756 1.35355C13.9122 1.20485 14 1.00318 14 0.79289C14 0.582602 13.9122 0.380928 13.756 0.232232C13.5997 0.0835365 13.3878 0 13.1669 0C12.9459 0 12.734 0.0835365 12.5778 0.232232L4.32184 8.08144Z" fill="#A4C463" />
                                                        </svg> Partial refund of £24.00 processed</span>
                                                    <span class="mb-cancel-by mb-cancel-by--host"><svg xmlns="http://www.w3.org/2000/svg" width="12" height="13" viewBox="0 0 12 13" fill="none">
                                                            <circle cx="6" cy="3.5" r="2.5" stroke="currentColor" />
                                                            <path d="M1 11.5C1 9.29086 3.23858 7.5 6 7.5C8.76142 7.5 11 9.29086 11 11.5" stroke="currentColor" stroke-linecap="round" />
                                                        </svg> Dev É. cancelled this booking</span>
                                                </div>
                                                <div class="mb-card__ref">
                                                    <span class="mb-card__ref-id">FG-10294</span>
                                                    <a href="#" class="mb-card__pdf"><svg xmlns="http://www.w3.org/2000/svg" width="12" height="14" viewBox="0 0 13 15" fill="none">
                                                            <path d="M3.07717 14.5H9.27418C9.95769 14.5 10.6132 14.2209 11.0965 13.7242C11.5798 13.2275 11.8514 12.5538 11.8514 11.8514V7.66649C11.8516 6.96411 11.5804 6.29039 11.0973 5.79351L6.70216 1.27568C6.46282 1.02973 6.1787 0.834645 5.86601 0.701554C5.55331 0.568463 5.21817 0.499975 4.87972 0.5H3.07717C2.39367 0.5 1.73815 0.779053 1.25484 1.27577C0.771523 1.77249 0.5 2.44618 0.5 3.14865V11.8514C0.5 12.5538 0.771523 13.2275 1.25484 13.7242C1.73815 14.2209 2.39367 14.5 3.07717 14.5Z" stroke="#3B3731" stroke-linecap="round" stroke-linejoin="round" />
                                                            <path d="M5.9458 0.772461V5.0557C5.9458 5.45711 6.10096 5.84208 6.37714 6.12592C6.65332 6.40976 7.0279 6.56922 7.41847 6.56922H11.5876" stroke="#3B3731" stroke-linecap="round" stroke-linejoin="round" />
                                                        </svg> PDF</a>
                                                </div>
                                            </div>
                                            <div class="mb-card__provider">
                                                <div class="mb-card__provider-left">
                                                    <div class="avatar-wrap">
                                                        <img class="avatar" src="<?= BASE_URL ?>assets/images/space_card3.png" alt="Furs &amp; Co. Studio">
                                                        <div class="badge-shield" title="Verified"><svg xmlns="http://www.w3.org/2000/svg" width="29" height="30" viewBox="0 0 29 30" fill="none">
                                                                <path d="M14.9293 0.170856C14.6819 0.058916 14.4168 0 14.1399 0C13.8629 0 13.5978 0.058916 13.3504 0.170856L2.25651 4.87824C0.960357 5.42616 -0.0058648 6.70463 2.67979e-05 8.24823C0.0294848 14.0927 2.43326 24.7859 12.5845 29.6465C13.5684 30.1178 14.7113 30.1178 15.6952 29.6465C25.8465 24.7859 28.2502 14.0927 28.2797 8.24823C28.2856 6.70463 27.3194 5.42616 26.0232 4.87824L14.9293 0.170856Z" fill="#CBDCE8" />
                                                                <path d="M21.818 8.18213L15.7574 14.6215M13.065 14.3071C11.1862 15.0283 9.68391 14.9049 8.18164 14.3094C8.56043 19.1905 10.8362 21.067 13.8703 21.8185C13.8703 21.8185 16.1559 20.2018 16.4854 16.3693C16.521 15.9541 16.5385 15.7473 16.4529 15.5132C16.3665 15.2791 16.1968 15.1117 15.8582 14.7761C15.3006 14.2246 15.0225 13.9488 14.6915 13.8791C14.3604 13.8109 13.9286 13.9761 13.065 14.3071Z" stroke="white" stroke-linecap="round" stroke-linejoin="round" />
                                                            </svg></div>
                                                    </div>
                                                    <div class="mb-card__provider-meta">
                                                        <div class="mb-card__title-row">
                                                            <h3 class="mb-card__studio">Furs &amp; Co. Studio</h3>
                                                            <span class="mb-tag mb-tag--coral">Garden / Shed</span>
                                                        </div>
                                                        <p class="mb-card__host">Dev É.</p>
                                                    </div>
                                                </div>
                                                <div class="mb-card__price-block">
                                                    <p class="mb-card__date">18 Dec 2025</p>
                                                    <p class="mb-card__price">£48.00</p>
                                                </div>
                                            </div>
                                            <div class="mb-card__summary">
                                                <div class="mb-card__meta">
                                                    <div class="mb-meta-item"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="17" viewBox="0 0 16 17" fill="none">
                                                            <path d="M4.94591 11.5544C6.23114 12.8397 9.35699 11.798 11.9274 9.22713C14.4983 6.65667 15.54 3.53082 14.2548 2.24559M8.72754 1.37259L9.30927 1.95473M6.6915 3.40904L7.27322 3.99077M4.9455 5.73636L5.52722 6.31809M4.36377 8.6454L4.9455 9.22713M11.9274 0.5L12.5092 1.08173M11.3457 3.99118L12.5092 5.15463M9.30968 6.02763L10.4731 7.19109M6.98236 7.77281L8.14581 8.93627" stroke="#3B3731" stroke-linecap="round" stroke-linejoin="round" />
                                                            <path d="M4.94547 13.2998C5.42747 12.8178 5.42747 12.0364 4.94548 11.5544C4.46348 11.0724 3.68202 11.0724 3.20003 11.5544L0.872775 13.8816C0.390784 14.3636 0.390784 15.1451 0.872775 15.6271C1.35477 16.1091 2.13623 16.1091 2.61822 15.6271L4.94547 13.2998Z" stroke="#3B3731" stroke-linecap="round" stroke-linejoin="round" />
                                                        </svg> Half-Day</div>
                                                    <div class="mb-meta-item"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 19 17" fill="none">
                                                            <path d="M0.5 8.29554C0.5 5.20139 0.5 3.6539 1.50457 2.69308C2.50914 1.73227 4.12486 1.73145 7.35714 1.73145H10.7857C14.018 1.73145 15.6346 1.73145 16.6383 2.69308C17.642 3.65472 17.6429 5.20139 17.6429 8.29554V9.93656C17.6429 13.0307 17.6429 14.5782 16.6383 15.539C15.6337 16.4998 14.018 16.5007 10.7857 16.5007H7.35714C4.12486 16.5007 2.50829 16.5007 1.50457 15.539C0.500857 14.5774 0.5 13.0307 0.5 9.93656V8.29554Z" stroke="#3B3731" />
                                                            <path d="M4.78585 1.73077V0.5M13.3573 1.73077V0.5M0.928711 5.83333H17.2144" stroke="#3B3731" stroke-linecap="round" />
                                                        </svg> Wed, 18 Dec 2025</div>
                                                    <div class="mb-meta-item"><svg width="15" height="15" viewBox="0 0 16 16" fill="none">
                                                            <circle cx="8" cy="8" r="6" stroke="#3B3731" stroke-width="1.5" />
                                                            <path d="M8 4.5V8L10.5 10" stroke="#3B3731" stroke-width="1.5" stroke-linecap="round" />
                                                        </svg> 14:30 - 18:30</div>
                                                    <div class="mb-meta-item"><svg xmlns="http://www.w3.org/2000/svg" width="12" height="16" viewBox="0 0 12 16" fill="none">
                                                            <path d="M6 0.5C7.4694 0.5 8.87214 1.04525 9.90137 2.00586C10.9293 2.96529 11.4999 4.25871 11.5 5.59961C11.5 7.10011 10.6408 8.95946 9.51855 10.7236C8.41048 12.4655 7.10434 14.0263 6.32227 14.9082C6.14625 15.1067 5.85375 15.1067 5.67773 14.9082C4.89566 14.0263 3.58952 12.4655 2.48145 10.7236C1.35919 8.95946 0.5 7.10011 0.5 5.59961C0.500111 4.25871 1.07068 2.96529 2.09863 2.00586C3.12786 1.04525 4.53061 0.5 6 0.5ZM6 3.09961C5.30978 3.09961 4.64141 3.35564 4.14355 3.82031C3.64466 4.28597 3.35753 4.92517 3.35742 5.59961C3.35742 6.27422 3.64453 6.91413 4.14355 7.37988C4.64141 7.84453 5.30979 8.09961 6 8.09961C6.69022 8.09961 7.35859 7.84453 7.85645 7.37988C8.35534 6.91413 8.64247 6.27422 8.64258 5.59961C8.64258 4.92517 8.35534 4.28597 7.85645 3.82031C7.35859 3.35564 6.69022 3.09961 6 3.09961Z" stroke="#3B3731" />
                                                        </svg> Victoria Embankment</div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="mb-card__footer">
                                            <div class="mb-card__footer-left">
                                                <button type="button" class="mb-btn" data-modal-open="view_booking_space_cancelled_modal"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="14" viewBox="0 0 18 14" fill="none">
                                                        <path d="M1.5 7C1.5 7 4.1 1.5 9 1.5C13.9 1.5 16.5 7 16.5 7C16.5 7 13.9 12.5 9 12.5C4.1 12.5 1.5 7 1.5 7Z" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round" />
                                                        <circle cx="9" cy="7" r="2.25" stroke="currentColor" stroke-width="1.4" />
                                                    </svg> View details</button>
                                                <a href="<?= BASE_URL ?>profiles/space/space_profile.php" class="mb-btn mb-btn--blue"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                                        <path d="M2.2312 15.4953V12.6124H5.11403" stroke="#6FA0C3" stroke-linecap="round" stroke-linejoin="round" />
                                                        <path d="M15.3656 6.62252C15.6715 8.25452 15.4269 9.94189 14.6702 11.4199C13.9135 12.8978 12.6875 14.0827 11.1846 14.7887C9.68175 15.4946 7.98704 15.6817 6.3664 15.3204C4.74575 14.9592 3.2909 14.0701 2.23013 12.7927M0.628303 9.37748C0.322432 7.74548 0.567036 6.05811 1.32373 4.58014C2.08043 3.10218 3.3064 1.91725 4.80927 1.2113C6.31214 0.505355 8.00686 0.318331 9.6275 0.679579C11.2481 1.04083 12.703 1.9299 13.7638 3.2073" stroke="#6FA0C3" stroke-linecap="round" stroke-linejoin="round" />
                                                        <path d="M13.7626 0.504883V3.38771H10.8798" stroke="#6FA0C3" stroke-linecap="round" stroke-linejoin="round" />
                                                    </svg> Rebook</a>
                                            </div>
                                        </div>
                                    </article>
                                </div>
                            </div>


                            <!-- Change Groomer Booking Modal -->
                            <div class="modal" id="change_groomer_booking_modal">
                                <div class="modal-content size cbm-modal-content">
                                    <div class="cbm-modal">
                                        <button class="cbm-close" type="button" data-modal-close aria-label="Close">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 36 36" fill="none">
                                                <circle cx="18" cy="18" r="17.5" stroke="#3B3731" />
                                                <path d="M12.8 24.0008L24 12.8008M12.8 12.8008L24 24.0008" stroke="#3B3731" stroke-width="1.5" stroke-linecap="round" />
                                            </svg>
                                        </button>

                                        <div class="cbm-header">
                                            <h1>Change booking</h1>
                                            <p>Sarah's Grooming Studio · FG-10294</p>
                                        </div>

                                        <div class="cbm-body">
                                            <!-- Update Date & Time -->
                                            <section class="cbm-card">
                                                <h2 class="cbm-card-title">Update Date &amp; Time</h2>
                                                <div class="cbm-datetime">
                                                    <div class="cbm-calendar">
                                                        <div class="cbm-cal-header">
                                                            <button type="button" class="cbm-nav-btn" id="cbm-cal-prev" aria-label="Previous month">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="7" height="11" viewBox="0 0 7 11" fill="none">
                                                                    <path d="M5.53426 10.484L0.499999 5.44975L5.44975 0.500005" stroke="#3B3731" stroke-linecap="round" stroke-linejoin="round" />
                                                                </svg>
                                                            </button>
                                                            <span id="cbm-cal-title">December 2025</span>
                                                            <button type="button" class="cbm-nav-btn" id="cbm-cal-next" aria-label="Next month">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="7" height="11" viewBox="0 0 7 11" fill="none">
                                                                    <path d="M0.5 10.484L5.53426 5.44975L0.58451 0.500005" stroke="#3B3731" stroke-linecap="round" stroke-linejoin="round" />
                                                                </svg>
                                                            </button>
                                                        </div>
                                                        <div class="cbm-weekdays">
                                                            <div>M</div>
                                                            <div>T</div>
                                                            <div>W</div>
                                                            <div>T</div>
                                                            <div>F</div>
                                                            <div>S</div>
                                                            <div>S</div>
                                                        </div>
                                                        <div class="cbm-dates" id="cbm-cal-dates"></div>
                                                    </div>

                                                    <div class="cbm-times">
                                                        <p class="cbm-times-label" id="cbm-times-label">AVAILABLE TIMES · 18 DEC</p>
                                                        <div class="cbm-time-list" id="cbm-time-list">
                                                            <button type="button" class="cbm-time" data-range="09:00 - 10:00">09:00 AM</button>
                                                            <button type="button" class="cbm-time" data-range="11:00 - 12:00">11:00 AM</button>
                                                            <button type="button" class="cbm-time" data-range="12:00 - 13:00">12:00 PM</button>
                                                            <button type="button" class="cbm-time selected" data-range="14:30 - 15:30">14:30 PM</button>
                                                            <button type="button" class="cbm-time" data-range="16:00 - 17:00">16:00 PM</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </section>

                                            <!-- Extras & Add-ons -->
                                            <section class="cbm-card cbm-extras">
                                                <?php renderExtrasAddons([], [
                                                    'instance_id' => 'change-modal',
                                                    'on_change_js' => 'handleChangeBookingExtras',
                                                    'default_selected' => [1, 2, 12],
                                                ]); ?>
                                            </section>

                                            <!-- Price summary -->
                                            <div class="cbm-price-box">
                                                <div class="cbm-price-row">
                                                    <span>Total Paid</span>
                                                    <span id="cbm-total-paid">£48.00</span>
                                                </div>
                                                <div class="cbm-price-row cbm-price-addons">
                                                    <span>Add-ons</span>
                                                    <span id="cbm-addons-delta">+£0.00</span>
                                                </div>
                                                <div class="cbm-price-row cbm-price-updated">
                                                    <span>Updated total</span>
                                                    <span id="cbm-updated-total">£48.00</span>
                                                </div>
                                            </div>

                                            <div class="cbm-alert" id="cbm-alert" style="display:none;">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none" aria-hidden="true">
                                                    <path d="M6.625 9.025H6.6298M6.625 4.225V7.225M12.625 6.625C12.625 3.3112 9.9388 0.625 6.625 0.625C3.3112 0.625 0.625 3.3112 0.625 6.625C0.625 9.9388 3.3112 12.625 6.625 12.625C9.9388 12.625 12.625 9.9388 12.625 6.625Z" stroke="#FF6E6E" stroke-width="1.25" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                                                </svg>
                                                <span id="cbm-alert-text"></span>
                                            </div>
                                        </div>

                                        <div class="cbm-footer">
                                            <button type="button" class="cbm-btn-cancel" data-modal-close>Cancel changes</button>
                                            <button type="button" class="cbm-btn-confirm is-disabled" id="cbm-confirm" aria-disabled="true">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                                    <path d="M2.23096 15.4951V12.6123H5.11378" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" />
                                                    <path d="M15.3656 6.62252C15.6715 8.25452 15.4269 9.94189 14.6702 11.4199C13.9135 12.8978 12.6875 14.0827 11.1846 14.7887C9.68175 15.4946 7.98704 15.6817 6.3664 15.3204C4.74575 14.9592 3.2909 14.0701 2.23013 12.7927M0.628303 9.37748C0.322432 7.74548 0.567036 6.05811 1.32373 4.58014C2.08043 3.10218 3.3064 1.91725 4.80927 1.2113C6.31214 0.505355 8.00686 0.318331 9.6275 0.679579C11.2481 1.04083 12.703 1.9299 13.7638 3.2073" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" />
                                                    <path d="M13.7624 0.504883V3.38771H10.8796M4.61412 8.38848C4.2061 8.31757 4.2061 7.73171 4.61412 7.6608C5.3363 7.53448 6.00461 7.19626 6.53409 6.68914C7.06356 6.18203 7.43027 5.52892 7.58761 4.81285L7.61202 4.70009C7.70037 4.29673 8.27461 4.2944 8.36644 4.6966L8.39666 4.82796C8.55903 5.54126 8.92875 6.19059 9.4593 6.69425C9.98985 7.19791 10.6575 7.53339 11.3783 7.65848C11.7886 7.72938 11.7886 8.31874 11.3783 8.39081C10.6577 8.51581 9.99011 8.85111 9.45958 9.35455C8.92904 9.85799 8.55923 10.5071 8.39666 11.2202L8.36644 11.3504C8.27461 11.7526 7.70037 11.7502 7.61202 11.3469L7.58877 11.2353C7.43128 10.5189 7.06422 9.86555 6.5343 9.3584C6.00438 8.85125 5.33556 8.51322 4.61295 8.38732" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" />
                                                </svg>
                                                Change booking
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Change Space Booking Modal -->
                            <div class="modal" id="change_space_booking_modal">
                                <div class="modal-content size cbm-modal-content">
                                    <div class="cbm-modal cbm-modal--space">
                                        <button class="cbm-close" type="button" data-modal-close aria-label="Close">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 36 36" fill="none">
                                                <circle cx="18" cy="18" r="17.5" stroke="#3B3731" />
                                                <path d="M12.8 24.0008L24 12.8008M12.8 12.8008L24 24.0008" stroke="#3B3731" stroke-width="1.5" stroke-linecap="round" />
                                            </svg>
                                        </button>

                                        <div class="cbm-header">
                                            <h1>Change booking</h1>
                                            <p>Furs &amp; Co. Studio · FG-10294</p>
                                        </div>

                                        <div class="cbm-body">
                                            <section class="cbm-card">
                                                <h2 class="cbm-card-title">Update Date &amp; Time</h2>
                                                <div class="cbm-datetime">
                                                    <div class="cbm-calendar">
                                                        <div class="cbm-cal-header">
                                                            <button type="button" class="cbm-nav-btn" id="cbs-cal-prev" aria-label="Previous month">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="7" height="11" viewBox="0 0 7 11" fill="none">
                                                                    <path d="M5.53426 10.484L0.499999 5.44975L5.44975 0.500005" stroke="#3B3731" stroke-linecap="round" stroke-linejoin="round" />
                                                                </svg>
                                                            </button>
                                                            <span id="cbs-cal-title">December 2025</span>
                                                            <button type="button" class="cbm-nav-btn" id="cbs-cal-next" aria-label="Next month">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="7" height="11" viewBox="0 0 7 11" fill="none">
                                                                    <path d="M0.5 10.484L5.53426 5.44975L0.58451 0.500005" stroke="#3B3731" stroke-linecap="round" stroke-linejoin="round" />
                                                                </svg>
                                                            </button>
                                                        </div>
                                                        <div class="cbm-weekdays">
                                                            <div>M</div>
                                                            <div>T</div>
                                                            <div>W</div>
                                                            <div>T</div>
                                                            <div>F</div>
                                                            <div>S</div>
                                                            <div>S</div>
                                                        </div>
                                                        <div class="cbm-dates" id="cbs-cal-dates"></div>
                                                    </div>

                                                    <div class="cbm-times">
                                                        <p class="cbm-times-label" id="cbs-times-label">AVAILABLE TIMES · 18 DEC</p>
                                                        <div class="cbm-time-list" id="cbs-time-list">
                                                            <button type="button" class="cbm-time" data-range="09:00 - 10:00">09:00 AM</button>
                                                            <button type="button" class="cbm-time" data-range="11:00 - 12:00">11:00 AM</button>
                                                            <button type="button" class="cbm-time" data-range="12:00 - 13:00">12:00 PM</button>
                                                            <button type="button" class="cbm-time selected" data-range="14:30 - 18:30">14:30 PM</button>
                                                            <button type="button" class="cbm-time" data-range="16:00 - 17:00">16:00 PM</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </section>

                                            <section class="cbm-card cbm-extras cbm-extras--space">
                                                <?php renderExtrasAddons([
                                                    ['id' => 1, 'name' => 'Storage Locker', 'price' => 5, 'col' => 'left'],
                                                    ['id' => 2, 'name' => 'Deep Clean', 'price' => 10, 'col' => 'left'],
                                                    ['id' => 3, 'name' => 'After-hours access', 'price' => 20, 'col' => 'right'],
                                                ], [
                                                    'instance_id' => 'change-space-modal',
                                                    'on_change_js' => 'handleChangeSpaceExtras',
                                                    'default_selected' => [2],
                                                ]); ?>
                                            </section>

                                            <div class="cbm-price-box">
                                                <div class="cbm-price-row">
                                                    <span>Total Paid</span>
                                                    <span id="cbs-total-paid">£48.00</span>
                                                </div>
                                                <div class="cbm-price-row cbm-price-addons">
                                                    <span>Add-ons</span>
                                                    <span id="cbs-addons-delta">£10.00</span>
                                                </div>
                                                <div class="cbm-price-row cbm-price-updated">
                                                    <span>Updated total</span>
                                                    <span id="cbs-updated-total">£48.00</span>
                                                </div>
                                            </div>

                                            <div class="cbm-alert cbm-alert--charge" id="cbs-alert-charge" style="display:none;">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none" aria-hidden="true">
                                                    <path d="M6.625 9.025H6.6298M6.625 4.225V7.225M12.625 6.625C12.625 3.3112 9.9388 0.625 6.625 0.625C3.3112 0.625 0.625 3.3112 0.625 6.625C0.625 9.9388 3.3112 12.625 6.625 12.625C9.9388 12.625 12.625 9.9388 12.625 6.625Z" stroke="#FF6E6E" stroke-width="1.25" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                                                </svg>
                                                <span id="cbs-alert-charge-text"></span>
                                            </div>

                                            <div class="cbm-alert cbm-alert--refund" id="cbs-alert-refund" style="display:none;">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 13 13" fill="none">
                                                    <path d="M6.25 11.75C9.275 11.75 11.75 9.275 11.75 6.25C11.75 3.225 9.275 0.75 6.25 0.75C3.225 0.75 0.75 3.225 0.75 6.25C0.75 9.275 3.225 11.75 6.25 11.75Z" stroke="#6FA0C3" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                    <path d="M3.9126 6.25023L5.4691 7.80673L8.5876 4.69373" stroke="#6FA0C3" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                </svg>
                                                <span id="cbs-alert-refund-text"></span>
                                            </div>
                                        </div>

                                        <div class="cbm-footer">
                                            <button type="button" class="cbm-btn-cancel" data-modal-close>Cancel changes</button>
                                            <button type="button" class="cbm-btn-confirm is-disabled" id="cbs-confirm" aria-disabled="true">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                                    <path d="M2.23096 15.4951V12.6123H5.11378" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" />
                                                    <path d="M15.3656 6.62252C15.6715 8.25452 15.4269 9.94189 14.6702 11.4199C13.9135 12.8978 12.6875 14.0827 11.1846 14.7887C9.68175 15.4946 7.98704 15.6817 6.3664 15.3204C4.74575 14.9592 3.2909 14.0701 2.23013 12.7927M0.628303 9.37748C0.322432 7.74548 0.567036 6.05811 1.32373 4.58014C2.08043 3.10218 3.3064 1.91725 4.80927 1.2113C6.31214 0.505355 8.00686 0.318331 9.6275 0.679579C11.2481 1.04083 12.703 1.9299 13.7638 3.2073" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" />
                                                    <path d="M13.7624 0.504883V3.38771H10.8796M4.61412 8.38848C4.2061 8.31757 4.2061 7.73171 4.61412 7.6608C5.3363 7.53448 6.00461 7.19626 6.53409 6.68914C7.06356 6.18203 7.43027 5.52892 7.58761 4.81285L7.61202 4.70009C7.70037 4.29673 8.27461 4.2944 8.36644 4.6966L8.39666 4.82796C8.55903 5.54126 8.92875 6.19059 9.4593 6.69425C9.98985 7.19791 10.6575 7.53339 11.3783 7.65848C11.7886 7.72938 11.7886 8.31874 11.3783 8.39081C10.6577 8.51581 9.99011 8.85111 9.45958 9.35455C8.92904 9.85799 8.55923 10.5071 8.39666 11.2202L8.36644 11.3504C8.27461 11.7526 7.70037 11.7502 7.61202 11.3469L7.58877 11.2353C7.43128 10.5189 7.06422 9.86555 6.5343 9.3584C6.00438 8.85125 5.33556 8.51322 4.61295 8.38732" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" />
                                                </svg>
                                                Change booking
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Groomer Booking Updated Modal -->
                            <div class="modal" id="groomer_booking_updated_modal">
                                <div class="modal-content size bum-modal-content">
                                    <div class="bum-modal">
                                        <button class="bum-close" type="button" data-modal-close aria-label="Close">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 36 36" fill="none">
                                                <circle cx="18" cy="18" r="17.5" stroke="#3B3731" />
                                                <path d="M12.8 24.0008L24 12.8008M12.8 12.8008L24 24.0008" stroke="#3B3731" stroke-width="1.5" stroke-linecap="round" />
                                            </svg>
                                        </button>

                                        <div class="bum-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="77" height="72" viewBox="0 0 77 72" fill="none">
                                                <path d="M4.00456 27.2497C3.85156 30.0071 3.85156 33.2875 3.85156 37.2285V43.4621C3.85156 55.2155 3.85503 61.0906 7.91002 64.7435C11.965 68.3964 18.4959 68.3964 31.5543 68.3964H45.4057C58.4641 68.3964 64.9916 68.3933 69.05 64.7435C73.1085 61.0937 73.1085 55.2155 73.1085 43.4621V37.2285C73.1085 33.2872 73.1081 30.0069 72.9547 27.2497H4.00456Z" fill="#F2F6F9" />
                                                <path d="M38.8741 57.2489C37.572 57.2489 36.3526 57.0017 35.2158 56.5073C34.079 56.0128 33.0895 55.3445 32.2471 54.5021C31.4048 53.6598 30.7364 52.6702 30.242 51.5334C29.7475 50.3966 29.5 49.1769 29.4993 47.8741C29.4986 46.5713 29.7461 45.3519 30.242 44.2158C30.7378 43.0797 31.4058 42.0902 32.2461 41.2471C33.0863 40.4041 34.0759 39.7357 35.2148 39.242C36.3536 38.7482 37.5734 38.5007 38.8741 38.4993C40.2977 38.4993 41.6476 38.8031 42.924 39.4107C44.2004 40.0183 45.2809 40.8777 46.1656 41.9888V40.5826C46.1656 40.2874 46.2656 40.0402 46.4656 39.8409C46.6656 39.6416 46.9128 39.5416 47.2072 39.5409C47.5017 39.5402 47.7493 39.6402 47.9499 39.8409C48.1506 40.0416 48.2503 40.2888 48.2489 40.5826V44.7492C48.2489 45.0443 48.1489 45.2919 47.9489 45.4919C47.7489 45.6918 47.5017 45.7915 47.2072 45.7908H43.0407C42.7455 45.7908 42.4983 45.6908 42.299 45.4908C42.0997 45.2908 41.9997 45.0436 41.999 44.7492C41.9983 44.4547 42.0983 44.2075 42.299 44.0075C42.4997 43.8075 42.7469 43.7075 43.0407 43.7075H44.8635C44.1518 42.7353 43.275 41.9714 42.2334 41.4159C41.1917 40.8603 40.072 40.5826 38.8741 40.5826C36.8429 40.5826 35.12 41.2902 33.7054 42.7054C32.2909 44.1207 31.5833 45.8436 31.5826 47.8741C31.5819 49.9046 32.2895 51.6279 33.7054 53.0438C35.1214 54.4597 36.8443 55.167 38.8741 55.1656C40.5234 55.1656 41.999 54.6709 43.3011 53.6813C44.6031 52.6917 45.4625 51.4157 45.8791 49.8532C45.966 49.5755 46.1222 49.3671 46.3479 49.2282C46.5736 49.0894 46.8253 49.0373 47.1031 49.072C47.3982 49.1067 47.6326 49.2324 47.8062 49.4491C47.9798 49.6657 48.0319 49.9046 47.9624 50.1657C47.459 52.2317 46.3652 53.9289 44.6813 55.2573C42.9973 56.5858 41.0615 57.2496 38.8741 57.2489ZM39.9157 47.4574L42.5198 50.0616C42.7108 50.2525 42.8063 50.4956 42.8063 50.7907C42.8063 51.0858 42.7108 51.3289 42.5198 51.5199C42.3289 51.7108 42.0858 51.8063 41.7907 51.8063C41.4956 51.8063 41.2525 51.7108 41.0615 51.5199L38.1449 48.6033C38.0408 48.4991 37.9626 48.3821 37.9106 48.2522C37.8585 48.1224 37.8324 47.9876 37.8324 47.8481V43.7075C37.8324 43.4124 37.9324 43.1652 38.1324 42.9659C38.3324 42.7666 38.5796 42.6666 38.8741 42.6659C39.1685 42.6652 39.4161 42.7652 39.6168 42.9659C39.8175 43.1665 39.9171 43.4138 39.9157 43.7075V47.4574Z" fill="#CBDCE8" />
                                                <path d="M1 35.1034C1 21.5667 1 14.7966 5.39492 10.5931C9.78983 6.38964 16.8584 6.38605 30.9994 6.38605H45.9991C60.1401 6.38605 67.2125 6.38605 71.6036 10.5931C75.9948 14.8002 75.9986 21.5667 75.9986 35.1034V42.2827C75.9986 55.8193 75.9986 62.5894 71.6036 66.7929C67.2087 70.9964 60.1401 71 45.9991 71H30.9994C16.8584 71 9.78608 71 5.39492 66.7929C1.00375 62.5858 1 55.8193 1 42.2827V35.1034Z" stroke="#3B3731" stroke-width="2" />
                                                <path d="M19.1828 6.35879V1M57.778 6.35879V1M1.81494 24.2214H75.1458" stroke="#3B3731" stroke-width="2" stroke-linecap="round" />
                                            </svg>
                                        </div>

                                        <h1 class="bum-title">Your booking has been <em>updated!</em></h1>
                                        <p class="bum-desc">Your grooming appointment with Sarah has been updated. Please allow 24 hours for the groomer to approve changes.</p>

                                        <div class="bum-card">
                                            <p class="bum-card-label">UPDATED BOOKING</p>
                                            <div class="bum-card-inner">
                                                <div class="bum-card-top">
                                                    <div class="bum-provider">
                                                        <img src="<?= BASE_URL ?>assets/images/groomer-profile.png" alt="Sarah's Grooming Studio">
                                                        <div>
                                                            <p class="bum-provider-name">Sarah's Grooming Studio</p>
                                                            <p class="bum-provider-sub">Sarah W.</p>
                                                        </div>
                                                    </div>
                                                    <p class="bum-price" id="bum-groomer-price">£48.00</p>
                                                </div>
                                                <div class="bum-meta">
                                                    <span><svg xmlns="http://www.w3.org/2000/svg" width="14" height="15" viewBox="0 0 16 17" fill="none">
                                                            <path d="M4.94591 11.5544C6.23114 12.8397 9.35699 11.798 11.9274 9.22713C14.4983 6.65667 15.54 3.53082 14.2548 2.24559M8.72754 1.37259L9.30927 1.95473M6.6915 3.40904L7.27322 3.99077M4.9455 5.73636L5.52722 6.31809M4.36377 8.6454L4.9455 9.22713M11.9274 0.5L12.5092 1.08173M11.3457 3.99118L12.5092 5.15463M9.30968 6.02763L10.4731 7.19109M6.98236 7.77281L8.14581 8.93627" stroke="#3B3731" stroke-linecap="round" stroke-linejoin="round" />
                                                            <path d="M4.94547 13.2998C5.42747 12.8178 5.42747 12.0364 4.94548 11.5544C4.46348 11.0724 3.68202 11.0724 3.20003 11.5544L0.872775 13.8816C0.390784 14.3636 0.390784 15.1451 0.872775 15.6271C1.35477 16.1091 2.13623 16.1091 2.61822 15.6271L4.94547 13.2998Z" stroke="#3B3731" stroke-linecap="round" stroke-linejoin="round" />
                                                        </svg> Bath &amp; Brush</span>
                                                    <span><svg xmlns="http://www.w3.org/2000/svg" width="15" height="14" viewBox="0 0 19 17" fill="none">
                                                            <path d="M0.5 8.29554C0.5 5.20139 0.5 3.6539 1.50457 2.69308C2.50914 1.73227 4.12486 1.73145 7.35714 1.73145H10.7857C14.018 1.73145 15.6346 1.73145 16.6383 2.69308C17.642 3.65472 17.6429 5.20139 17.6429 8.29554V9.93656C17.6429 13.0307 17.6429 14.5782 16.6383 15.539C15.6337 16.4998 14.018 16.5007 10.7857 16.5007H7.35714C4.12486 16.5007 2.50829 16.5007 1.50457 15.539C0.500857 14.5774 0.5 13.0307 0.5 9.93656V8.29554Z" stroke="#3B3731" />
                                                            <path d="M4.78585 1.73077V0.5M13.3573 1.73077V0.5M0.928711 5.83333H17.2144" stroke="#3B3731" stroke-linecap="round" />
                                                        </svg> <span id="bum-groomer-date">Wed, 18 Dec 2025</span></span>
                                                    <span><svg width="14" height="14" viewBox="0 0 16 16" fill="none">
                                                            <circle cx="8" cy="8" r="6" stroke="#3B3731" stroke-width="1.5" />
                                                            <path d="M8 4.5V8L10.5 10" stroke="#3B3731" stroke-width="1.5" stroke-linecap="round" />
                                                        </svg> <span id="bum-groomer-time">14:30 – 15:30</span></span>
                                                    <span><svg xmlns="http://www.w3.org/2000/svg" width="11" height="14" viewBox="0 0 12 16" fill="none">
                                                            <path d="M6 0.5C7.4694 0.5 8.87214 1.04525 9.90137 2.00586C10.9293 2.96529 11.4999 4.25871 11.5 5.59961C11.5 7.10011 10.6408 8.95946 9.51855 10.7236C8.41048 12.4655 7.10434 14.0263 6.32227 14.9082C6.14625 15.1067 5.85375 15.1067 5.67773 14.9082C4.89566 14.0263 3.58952 12.4655 2.48145 10.7236C1.35919 8.95946 0.5 7.10011 0.5 5.59961C0.500111 4.25871 1.07068 2.96529 2.09863 2.00586C3.12786 1.04525 4.53061 0.5 6 0.5ZM6 3.09961C5.30978 3.09961 4.64141 3.35564 4.14355 3.82031C3.64466 4.28597 3.35753 4.92517 3.35742 5.59961C3.35742 6.27422 3.64453 6.91413 4.14355 7.37988C4.64141 7.84453 5.30979 8.09961 6 8.09961C6.69022 8.09961 7.35859 7.84453 7.85645 7.37988C8.35534 6.91413 8.64247 6.27422 8.64258 5.59961C8.64258 4.92517 8.35534 4.28597 7.85645 3.82031C7.35859 3.35564 6.69022 3.09961 6 3.09961Z" stroke="#3B3731" />
                                                        </svg> At your home</span>
                                                </div>
                                            </div>
                                            <div class="bum-pet">
                                                <img src="<?= BASE_URL ?>assets/images/pet_details_1.png" alt="Bella">
                                                <span>Bella · Rabbit (Mini Lop)</span>
                                            </div>
                                        </div>

                                        <div class="bum-footer">
                                            <a href="<?= BASE_URL ?>messages_notification/messages.php" class="bum-btn-outline">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="15" viewBox="0 0 16 15" fill="none">
                                                    <path d="M8 0.5C12.2044 0.5 15.5 3.48321 15.5 7.03223C15.5 10.4703 12.4072 13.3772 8.3916 13.5557L8 13.5645H7.99902C7.251 13.5661 6.50584 13.4687 5.7832 13.2744L5.59766 13.2246L5.42676 13.3115C5.00713 13.5247 4.13103 13.9084 2.72363 14.2393L2.08691 14.377C1.99742 14.3948 1.9071 14.4082 1.81738 14.4248C1.85085 14.3352 1.88498 14.2458 1.91602 14.1553L1.91895 14.1455C2.17667 13.3938 2.38924 12.5229 2.46777 11.7012L2.49023 11.4678L2.3252 11.3008C1.18119 10.1487 0.500003 8.65476 0.5 7.03223C0.5 3.48321 3.79561 0.5 8 0.5Z" stroke="#3B3731" />
                                                </svg>
                                                Message groomer
                                            </a>
                                            <button type="button" class="bum-btn-primary" data-modal-close>Back to my bookings</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Space Booking Updated Modal -->
                            <div class="modal" id="space_booking_updated_modal">
                                <div class="modal-content size bum-modal-content">
                                    <div class="bum-modal">
                                        <button class="bum-close" type="button" data-modal-close aria-label="Close">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 36 36" fill="none">
                                                <circle cx="18" cy="18" r="17.5" stroke="#3B3731" />
                                                <path d="M12.8 24.0008L24 12.8008M12.8 12.8008L24 24.0008" stroke="#3B3731" stroke-width="1.5" stroke-linecap="round" />
                                            </svg>
                                        </button>

                                        <div class="bum-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="56" height="52" viewBox="0 0 56 52" fill="none">
                                                <path d="M3 25C3 15.5 3 10.8 6.2 7.8C9.4 4.8 14.6 4.8 25 4.8H31C41.4 4.8 46.6 4.8 49.8 7.8C53 10.8 53 15.5 53 25V30.5C53 40 53 44.7 49.8 47.7C46.6 50.7 41.4 50.7 31 50.7H25C14.6 50.7 9.4 50.7 6.2 47.7C3 44.7 3 40 3 30.5V25Z" stroke="#3B3731" stroke-width="1.6" />
                                                <path d="M14.5 4.8V1M41.5 4.8V1M3.6 17.5H52.4" stroke="#3B3731" stroke-width="1.6" stroke-linecap="round" />
                                                <path d="M28 40.5C25.2 40.5 22.8 39.5 21 37.7C19.2 35.9 18.2 33.5 18.2 30.7C18.2 27.9 19.2 25.5 21 23.7C22.8 21.9 25.2 20.9 28 20.9C30.8 20.9 33.2 21.9 35 23.7V22.3C35 22 35.2 21.8 35.5 21.8C35.8 21.8 36 22 36 22.3V26.3C36 26.6 35.8 26.8 35.5 26.8H31.5C31.2 26.8 31 26.6 31 26.3C31 26 31.2 25.8 31.5 25.8H33.5C32.7 24.5 31.6 23.6 30.2 23C28.8 22.4 27.4 22.1 26 22.1C23.6 22.1 21.6 22.9 20.1 24.5C18.6 26.1 17.8 28.2 17.8 30.7C17.8 33.2 18.6 35.3 20.1 36.9C21.6 38.5 23.6 39.3 26 39.3C28 39.3 29.7 38.7 31.1 37.5C32.5 36.3 33.4 34.8 33.8 33C34 32.6 34.3 32.4 34.7 32.5C35.1 32.6 35.3 32.9 35.2 33.3C34.6 35.8 33.3 37.8 31.3 39.3C29.3 40.8 27 40.5 28 40.5ZM28.9 29.7L31.6 32.4C31.8 32.6 31.9 32.9 31.9 33.2C31.9 33.5 31.8 33.8 31.6 34C31.4 34.2 31.1 34.3 30.8 34.3C30.5 34.3 30.2 34.2 30 34L27.1 31.1C27 31 26.9 30.8 26.9 30.6V26.3C26.9 26 27.1 25.8 27.4 25.8C27.7 25.8 27.9 26 27.9 26.3V29.7H28.9Z" fill="#CBDCE8" />
                                            </svg>
                                        </div>

                                        <h1 class="bum-title">Your booking has been <em>updated!</em></h1>
                                        <p class="bum-desc">Your space booking with Furs &amp; Co. Studio has been updated. Please allow 24 hours for the host to approve changes.</p>

                                        <div class="bum-card">
                                            <p class="bum-card-label">UPDATED BOOKING</p>
                                            <div class="bum-card-inner">
                                                <div class="bum-card-top">
                                                    <div class="bum-provider">
                                                        <img src="<?= BASE_URL ?>assets/images/space_card3.png" alt="Furs &amp; Co. Studio">
                                                        <div>
                                                            <p class="bum-provider-name">Furs &amp; Co. Studio</p>
                                                            <p class="bum-provider-sub">Hosted by Dev É.</p>
                                                        </div>
                                                    </div>
                                                    <p class="bum-price" id="bum-space-price">£48.00</p>
                                                </div>
                                                <div class="bum-meta">
                                                    <span><svg xmlns="http://www.w3.org/2000/svg" width="16" height="13" viewBox="0 0 20 16" fill="none">
                                                            <path d="M16.7806 15.5092V4.90774C16.7806 4.8823 16.7827 4.85737 16.7866 4.83297L13.9203 2.38869C13.3107 1.86965 12.8896 1.51192 12.5323 1.2787C12.1873 1.05357 11.9555 0.981548 11.7338 0.981548C11.5122 0.981548 11.2818 1.05383 10.9372 1.2787C10.5799 1.51195 10.1576 1.86936 9.54726 2.38869L6.67887 4.83297C6.68281 4.85747 6.68691 4.8822 6.68691 4.90774V15.5092C6.68648 15.7799 6.4561 16 6.17197 16C5.88803 15.9998 5.65746 15.7798 5.65703 15.5092V5.70333L5.12599 6.15768C4.91398 6.33835 4.58739 6.31948 4.39783 6.11742C4.20902 5.91549 4.22669 5.60589 4.43806 5.42535L8.85933 1.65828H8.86134C9.4513 1.15631 9.92906 0.747109 10.3539 0.469686C10.7915 0.184003 11.226 2.87993e-07 11.7338 0C12.2415 0 12.6759 0.183991 13.1136 0.469686C13.5387 0.747176 14.0185 1.15613 14.6082 1.65828L19.0295 5.42535C19.2408 5.60589 19.2585 5.91549 19.0697 6.11742C18.8801 6.31948 18.5535 6.33835 18.3415 6.15768L17.8105 5.70333V15.5092C17.8101 15.7798 17.5795 15.9998 17.2955 16C17.0114 16 16.781 15.7799 16.7806 15.5092Z" fill="#3B3731" />
                                                        </svg> Half-Day</span>
                                                    <span><svg xmlns="http://www.w3.org/2000/svg" width="15" height="14" viewBox="0 0 19 17" fill="none">
                                                            <path d="M0.5 8.29554C0.5 5.20139 0.5 3.6539 1.50457 2.69308C2.50914 1.73227 4.12486 1.73145 7.35714 1.73145H10.7857C14.018 1.73145 15.6346 1.73145 16.6383 2.69308C17.642 3.65472 17.6429 5.20139 17.6429 8.29554V9.93656C17.6429 13.0307 17.6429 14.5782 16.6383 15.539C15.6337 16.4998 14.018 16.5007 10.7857 16.5007H7.35714C4.12486 16.5007 2.50829 16.5007 1.50457 15.539C0.500857 14.5774 0.5 13.0307 0.5 9.93656V8.29554Z" stroke="#3B3731" />
                                                            <path d="M4.78585 1.73077V0.5M13.3573 1.73077V0.5M0.928711 5.83333H17.2144" stroke="#3B3731" stroke-linecap="round" />
                                                        </svg> <span id="bum-space-date">Wed, 18 Dec 2025</span></span>
                                                    <span><svg width="14" height="14" viewBox="0 0 16 16" fill="none">
                                                            <circle cx="8" cy="8" r="6" stroke="#3B3731" stroke-width="1.5" />
                                                            <path d="M8 4.5V8L10.5 10" stroke="#3B3731" stroke-width="1.5" stroke-linecap="round" />
                                                        </svg> <span id="bum-space-time">14:30 – 15:30</span></span>
                                                    <span><svg xmlns="http://www.w3.org/2000/svg" width="11" height="14" viewBox="0 0 12 16" fill="none">
                                                            <path d="M6 0.5C7.4694 0.5 8.87214 1.04525 9.90137 2.00586C10.9293 2.96529 11.4999 4.25871 11.5 5.59961C11.5 7.10011 10.6408 8.95946 9.51855 10.7236C8.41048 12.4655 7.10434 14.0263 6.32227 14.9082C6.14625 15.1067 5.85375 15.1067 5.67773 14.9082C4.89566 14.0263 3.58952 12.4655 2.48145 10.7236C1.35919 8.95946 0.5 7.10011 0.5 5.59961C0.500111 4.25871 1.07068 2.96529 2.09863 2.00586C3.12786 1.04525 4.53061 0.5 6 0.5ZM6 3.09961C5.30978 3.09961 4.64141 3.35564 4.14355 3.82031C3.64466 4.28597 3.35753 4.92517 3.35742 5.59961C3.35742 6.27422 3.64453 6.91413 4.14355 7.37988C4.64141 7.84453 5.30979 8.09961 6 8.09961C6.69022 8.09961 7.35859 7.84453 7.85645 7.37988C8.35534 6.91413 8.64247 6.27422 8.64258 5.59961C8.64258 4.92517 8.35534 4.28597 7.85645 3.82031C7.35859 3.35564 6.69022 3.09961 6 3.09961Z" stroke="#3B3731" />
                                                        </svg> Victoria Embankment</span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="bum-footer">
                                            <a href="<?= BASE_URL ?>messages_notification/messages.php" class="bum-btn-outline">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="15" viewBox="0 0 16 15" fill="none">
                                                    <path d="M8 0.5C12.2044 0.5 15.5 3.48321 15.5 7.03223C15.5 10.4703 12.4072 13.3772 8.3916 13.5557L8 13.5645H7.99902C7.251 13.5661 6.50584 13.4687 5.7832 13.2744L5.59766 13.2246L5.42676 13.3115C5.00713 13.5247 4.13103 13.9084 2.72363 14.2393L2.08691 14.377C1.99742 14.3948 1.9071 14.4082 1.81738 14.4248C1.85085 14.3352 1.88498 14.2458 1.91602 14.1553L1.91895 14.1455C2.17667 13.3938 2.38924 12.5229 2.46777 11.7012L2.49023 11.4678L2.3252 11.3008C1.18119 10.1487 0.500003 8.65476 0.5 7.03223C0.5 3.48321 3.79561 0.5 8 0.5Z" stroke="#3B3731" />
                                                </svg>
                                                Message host
                                            </a>
                                            <button type="button" class="bum-btn-primary" data-modal-close>Back to my bookings</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Cancel Groomer Booking Modal -->
                            <div class="modal" id="cancel_groomer_booking_modal">
                                <div class="modal-content size cnl-modal-content">
                                    <div class="cnl-modal">
                                        <button class="cnl-close" type="button" data-modal-close aria-label="Close">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 36 36" fill="none">
                                                <circle cx="18" cy="18" r="17.5" stroke="#3B3731" />
                                                <path d="M12.8 24.0008L24 12.8008M12.8 12.8008L24 24.0008" stroke="#3B3731" stroke-width="1.5" stroke-linecap="round" />
                                            </svg>
                                        </button>

                                        <h1 class="cnl-title">Cancel this booking?</h1>
                                        <p class="cnl-subtitle">Please review before proceeding</p>

                                        <div class="cnl-card">
                                            <div class="cnl-card-top">
                                                <div class="cnl-provider">
                                                    <img src="<?= BASE_URL ?>assets/images/groomer-profile.png" alt="Sarah's Grooming Studio">
                                                    <div>
                                                        <p class="cnl-provider-name">Sarah's Grooming Studio</p>
                                                        <p class="cnl-provider-sub">Sarah W.</p>
                                                    </div>
                                                </div>
                                                <div class="cnl-price-block">
                                                    <p class="cnl-date">18 Dec 2025</p>
                                                    <p class="cnl-price">£48.00</p>
                                                </div>
                                            </div>
                                            <div class="cnl-meta">
                                                <span><svg xmlns="http://www.w3.org/2000/svg" width="14" height="15" viewBox="0 0 16 17" fill="none">
                                                        <path d="M4.94591 11.5544C6.23114 12.8397 9.35699 11.798 11.9274 9.22713C14.4983 6.65667 15.54 3.53082 14.2548 2.24559M8.72754 1.37259L9.30927 1.95473M6.6915 3.40904L7.27322 3.99077M4.9455 5.73636L5.52722 6.31809M4.36377 8.6454L4.9455 9.22713M11.9274 0.5L12.5092 1.08173M11.3457 3.99118L12.5092 5.15463M9.30968 6.02763L10.4731 7.19109M6.98236 7.77281L8.14581 8.93627" stroke="#3B3731" stroke-linecap="round" stroke-linejoin="round" />
                                                        <path d="M4.94547 13.2998C5.42747 12.8178 5.42747 12.0364 4.94548 11.5544C4.46348 11.0724 3.68202 11.0724 3.20003 11.5544L0.872775 13.8816C0.390784 14.3636 0.390784 15.1451 0.872775 15.6271C1.35477 16.1091 2.13623 16.1091 2.61822 15.6271L4.94547 13.2998Z" stroke="#3B3731" stroke-linecap="round" stroke-linejoin="round" />
                                                    </svg> Bath &amp; Brush</span>
                                                <span><svg xmlns="http://www.w3.org/2000/svg" width="15" height="14" viewBox="0 0 19 17" fill="none">
                                                        <path d="M0.5 8.29554C0.5 5.20139 0.5 3.6539 1.50457 2.69308C2.50914 1.73227 4.12486 1.73145 7.35714 1.73145H10.7857C14.018 1.73145 15.6346 1.73145 16.6383 2.69308C17.642 3.65472 17.6429 5.20139 17.6429 8.29554V9.93656C17.6429 13.0307 17.6429 14.5782 16.6383 15.539C15.6337 16.4998 14.018 16.5007 10.7857 16.5007H7.35714C4.12486 16.5007 2.50829 16.5007 1.50457 15.539C0.500857 14.5774 0.5 13.0307 0.5 9.93656V8.29554Z" stroke="#3B3731" />
                                                        <path d="M4.78585 1.73077V0.5M13.3573 1.73077V0.5M0.928711 5.83333H17.2144" stroke="#3B3731" stroke-linecap="round" />
                                                    </svg> Wed, 18 Dec 2025</span>
                                                <span><svg width="14" height="14" viewBox="0 0 16 16" fill="none">
                                                        <circle cx="8" cy="8" r="6" stroke="#3B3731" stroke-width="1.5" />
                                                        <path d="M8 4.5V8L10.5 10" stroke="#3B3731" stroke-width="1.5" stroke-linecap="round" />
                                                    </svg> 14:30 - 15:30</span>
                                                <span><svg xmlns="http://www.w3.org/2000/svg" width="11" height="14" viewBox="0 0 12 16" fill="none">
                                                        <path d="M6 0.5C7.4694 0.5 8.87214 1.04525 9.90137 2.00586C10.9293 2.96529 11.4999 4.25871 11.5 5.59961C11.5 7.10011 10.6408 8.95946 9.51855 10.7236C8.41048 12.4655 7.10434 14.0263 6.32227 14.9082C6.14625 15.1067 5.85375 15.1067 5.67773 14.9082C4.89566 14.0263 3.58952 12.4655 2.48145 10.7236C1.35919 8.95946 0.5 7.10011 0.5 5.59961C0.500111 4.25871 1.07068 2.96529 2.09863 2.00586C3.12786 1.04525 4.53061 0.5 6 0.5ZM6 3.09961C5.30978 3.09961 4.64141 3.35564 4.14355 3.82031C3.64466 4.28597 3.35753 4.92517 3.35742 5.59961C3.35742 6.27422 3.64453 6.91413 4.14355 7.37988C4.64141 7.84453 5.30979 8.09961 6 8.09961C6.69022 8.09961 7.35859 7.84453 7.85645 7.37988C8.35534 6.91413 8.64247 6.27422 8.64258 5.59961C8.64258 4.92517 8.35534 4.28597 7.85645 3.82031C7.35859 3.35564 6.69022 3.09961 6 3.09961Z" stroke="#3B3731" />
                                                    </svg> At your home</span>
                                            </div>
                                            <div class="cnl-pet">
                                                <img src="<?= BASE_URL ?>assets/images/pet_details_1.png" alt="Bella">
                                                <span>Bella · Rabbit (Mini Lop)</span>
                                            </div>
                                            <div class="cnl-refund">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none" aria-hidden="true">
                                                    <circle cx="9" cy="9" r="8" stroke="#A0BE63" stroke-width="1.5" />
                                                    <path d="M5.5 9.2L7.8 11.5L12.5 6.5" stroke="#A0BE63" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                </svg>
                                                <p>Free cancellation applies — this booking is more than 24 hours away. You'll receive a full refund of £48.00 in 3–5 business days.</p>
                                            </div>
                                        </div>

                                        <div class="cnl-policy">
                                            <p class="cnl-policy-title">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 12 12" fill="none" aria-hidden="true">
                                                    <circle cx="6" cy="6" r="5.5" stroke="#FF6E6E" />
                                                    <path d="M4.2666 7.99993L7.99993 4.2666M4.2666 4.2666L7.99993 7.99993" stroke="#FF6E6E" stroke-linecap="round" />
                                                </svg>
                                                <span>Cancellation policy</span>
                                            </p>
                                            <ul>
                                                <li>Free cancellation if cancelled more than 24 hours before the appointment.</li>
                                                <li>Cancellations within 24 hour incur a fee of up to 50% of the booking cost.</li>
                                                <li>You can reschedule instead — your groomer will be notified.</li>
                                            </ul>
                                        </div>

                                        <p class="cnl-reschedule">
                                            Need to change the date or add-ons instead?
                                            <button type="button" class="cnl-reschedule-link" data-modal-open="change_groomer_booking_modal" data-close-parent-modal>Reschedule this booking</button>
                                        </p>

                                        <div class="cnl-footer">
                                            <button type="button" class="cnl-btn-keep" data-modal-close>Keep booking</button>
                                            <button type="button" class="cnl-btn-cancel" id="cnl-confirm-groomer">Yes, cancel booking</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Cancel Space Booking Modal -->
                            <div class="modal" id="cancel_space_booking_modal">
                                <div class="modal-content size cnl-modal-content">
                                    <div class="cnl-modal">
                                        <button class="cnl-close" type="button" data-modal-close aria-label="Close">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 36 36" fill="none">
                                                <circle cx="18" cy="18" r="17.5" stroke="#3B3731" />
                                                <path d="M12.8 24.0008L24 12.8008M12.8 12.8008L24 24.0008" stroke="#3B3731" stroke-width="1.5" stroke-linecap="round" />
                                            </svg>
                                        </button>

                                        <h1 class="cnl-title">Cancel this booking?</h1>
                                        <p class="cnl-subtitle">Please review before proceeding</p>

                                        <div class="cnl-card">
                                            <div class="cnl-card-top">
                                                <div class="cnl-provider">
                                                    <img src="<?= BASE_URL ?>assets/images/space_card3.png" alt="Furs &amp; Co. Studio">
                                                    <div>
                                                        <p class="cnl-provider-name">Furs &amp; Co. Studio</p>
                                                        <p class="cnl-provider-sub">Hosted by Dev É.</p>
                                                    </div>
                                                </div>
                                                <div class="cnl-price-block">
                                                    <p class="cnl-date">18 Dec 2025</p>
                                                    <p class="cnl-price">£148.00</p>
                                                </div>
                                            </div>
                                            <div class="cnl-meta">
                                                <span><svg xmlns="http://www.w3.org/2000/svg" width="18" height="15" viewBox="0 0 18 15" fill="none">
                                                        <path d="M15.7313 14.5399V4.60101C15.7313 4.57715 15.7333 4.55379 15.7369 4.53091L13.0497 2.2394C12.4783 1.7528 12.0835 1.41742 11.7486 1.19878C11.4252 0.987721 11.2078 0.920201 10.9999 0.920201C10.7922 0.920202 10.5762 0.987967 10.2532 1.19878C9.91817 1.41745 9.52232 1.75253 8.9501 2.2394L6.26101 4.53091C6.26472 4.55387 6.26856 4.57706 6.26856 4.60101V14.5399C6.26815 14.7937 6.05217 15 5.7858 15C5.51961 14.9998 5.30346 14.7936 5.30305 14.5399V5.34687L4.80521 5.77283C4.60646 5.9422 4.30028 5.92451 4.12257 5.73508C3.94556 5.54577 3.96212 5.25552 4.16028 5.08627L8.30518 1.55464H8.30706C8.86014 1.08404 9.30804 0.700414 9.70629 0.440331C10.1166 0.172503 10.5239 2.69994e-07 10.9999 0C11.4759 0 11.8831 0.172492 12.2936 0.440331C12.6921 0.700477 13.1418 1.08387 13.6947 1.55464L17.8396 5.08627C18.0377 5.25552 18.0543 5.54577 17.8773 5.73508C17.6996 5.92451 17.3934 5.9422 17.1946 5.77283L16.6968 5.34687V14.5399C16.6964 14.7936 16.4802 14.9998 16.214 15C15.9477 15 15.7317 14.7937 15.7313 14.5399Z" fill="#3B3731" />
                                                        <path d="M2.18899 8.00085C2.18899 7.6538 2.09029 7.35602 1.94982 7.15499C1.8093 6.95408 1.64606 6.86964 1.49998 6.86964C1.35398 6.86976 1.19056 6.95423 1.05015 7.15499C0.909803 7.35602 0.810973 7.65398 0.810973 8.00085C0.811102 8.34783 0.90963 8.6458 1.05015 8.84671C1.19054 9.04736 1.35402 9.13024 1.49998 9.13036C1.64595 9.13036 1.80938 9.04727 1.94982 8.84671C2.09034 8.6458 2.18886 8.34783 2.18899 8.00085ZM2.99997 8.00085C2.99984 8.51781 2.85473 9.00282 2.59923 9.36815C2.3435 9.73379 1.95855 10 1.49998 10C1.04173 9.99988 0.65799 9.73349 0.402319 9.36815C0.146795 9.00281 0.000127906 8.51784 0 8.00085C0 7.4836 0.146683 6.99735 0.402319 6.63185C0.65799 6.26662 1.04182 6.00012 1.49998 6C1.95849 6 2.3435 6.26629 2.59923 6.63185C2.85487 6.99735 2.99997 7.4836 2.99997 8.00085Z" fill="#3B3731" />
                                                        <path d="M1 14.531V9.46848C1 9.20961 1.22386 8.99976 1.49999 8.99976C1.77613 8.99976 1.99999 9.20961 1.99999 9.46848V14.531C1.99978 14.7897 1.776 14.9998 1.49999 14.9998C1.22399 14.9998 1.00021 14.7897 1 14.531Z" fill="#3B3731" />
                                                        <path d="M12.7893 11.1765C12.7893 10.7682 12.7875 10.509 12.7616 10.319C12.7375 10.1429 12.7006 10.0971 12.6783 10.0751C12.656 10.0531 12.6098 10.0151 12.4304 9.99131C12.2372 9.96574 11.9724 9.96583 11.557 9.96583H10.7059C10.2905 9.96583 10.0257 9.96574 9.83254 9.99131C9.65315 10.0151 9.60689 10.0531 9.5846 10.0751C9.56228 10.0971 9.52541 10.1429 9.50133 10.319C9.47536 10.509 9.47358 10.7682 9.47358 11.1765V14.0676H12.7893V11.1765ZM11.9844 6.51581C12.2456 6.51601 12.4577 6.72493 12.4581 6.98188C12.4581 7.23916 12.2459 7.44775 11.9844 7.44795H10.2785C10.017 7.44775 9.80478 7.23916 9.80478 6.98188C9.80518 6.72493 10.0173 6.51601 10.2785 6.51581H11.9844ZM11.9844 3.99976L12.0788 4.00886C12.295 4.05203 12.4581 4.24033 12.4581 4.46583C12.4581 4.69132 12.295 4.87963 12.0788 4.92279L11.9844 4.9319H10.2785C10.017 4.9317 9.80478 4.72311 9.80478 4.46583C9.80478 4.20854 10.017 3.99995 10.2785 3.99976H11.9844ZM13.7367 14.0676H17.5261C17.7877 14.0676 17.9998 14.2763 17.9998 14.5337C17.9994 14.7908 17.7875 14.9998 17.5261 14.9998H0.473679C0.21232 14.9998 0.000398957 14.7908 0 14.5337C0 14.2763 0.212073 14.0676 0.473679 14.0676H8.52622V11.1765C8.52622 10.7948 8.52503 10.4616 8.56138 10.1952C8.59968 9.91511 8.6874 9.63984 8.91479 9.41601C9.14231 9.19214 9.42195 9.10597 9.70672 9.06828C9.97773 9.03243 10.3174 9.03368 10.7059 9.03368H11.557C11.9455 9.03368 12.2852 9.03243 12.5562 9.06828C12.841 9.10597 13.1206 9.19214 13.3481 9.41601C13.5755 9.63984 13.6632 9.91511 13.7015 10.1952C13.7379 10.4616 13.7367 10.7948 13.7367 11.1765V14.0676Z" fill="#3B3731" />
                                                    </svg> Half-Day</span>
                                                <span><svg xmlns="http://www.w3.org/2000/svg" width="19" height="17" viewBox="0 0 19 17" fill="none">
                                                        <path d="M0.5 8.29554C0.5 5.20139 0.5 3.6539 1.50457 2.69308C2.50914 1.73227 4.12486 1.73145 7.35714 1.73145H10.7857C14.018 1.73145 15.6346 1.73145 16.6383 2.69308C17.642 3.65472 17.6429 5.20139 17.6429 8.29554V9.93656C17.6429 13.0307 17.6429 14.5782 16.6383 15.539C15.6337 16.4998 14.018 16.5007 10.7857 16.5007H7.35714C4.12486 16.5007 2.50829 16.5007 1.50457 15.539C0.500857 14.5774 0.5 13.0307 0.5 9.93656V8.29554Z" stroke="#3B3731" />
                                                        <path d="M4.78585 1.73077V0.5M13.3573 1.73077V0.5M0.928711 5.83333H17.2144" stroke="#3B3731" stroke-linecap="round" />
                                                        <path d="M14.2139 12.3975C14.2139 12.6151 14.1236 12.8238 13.9629 12.9777C13.8021 13.1315 13.5841 13.218 13.3568 13.218C13.1295 13.218 12.9114 13.1315 12.7507 12.9777C12.59 12.8238 12.4997 12.6151 12.4997 12.3975C12.4997 12.1799 12.59 11.9712 12.7507 11.8173C12.9114 11.6634 13.1295 11.577 13.3568 11.577C13.5841 11.577 13.8021 11.6634 13.9629 11.8173C14.1236 11.9712 14.2139 12.1799 14.2139 12.3975ZM14.2139 9.11543C14.2139 9.33305 14.1236 9.54175 13.9629 9.69562C13.8021 9.8495 13.5841 9.93595 13.3568 9.93595C13.1295 9.93595 12.9114 9.8495 12.7507 9.69562C12.59 9.54175 12.4997 9.33305 12.4997 9.11543C12.4997 8.89782 12.59 8.68912 12.7507 8.53524C12.9114 8.38137 13.1295 8.29492 13.3568 8.29492C13.5841 8.29492 13.8021 8.38137 13.9629 8.53524C14.1236 8.68912 14.2139 8.89782 14.2139 9.11543ZM9.92822 12.3975C9.92822 12.6151 9.83792 12.8238 9.67717 12.9777C9.51643 13.1315 9.29841 13.218 9.07108 13.218C8.84375 13.218 8.62573 13.1315 8.46499 12.9777C8.30424 12.8238 8.21394 12.6151 8.21394 12.3975C8.21394 12.1799 8.30424 11.9712 8.46499 11.8173C8.62573 11.6634 8.84375 11.577 9.07108 11.577C9.29841 11.577 9.51643 11.6634 9.67717 11.8173C9.83792 11.9712 9.92822 12.1799 9.92822 12.3975ZM9.92822 9.11543C9.92822 9.33305 9.83792 9.54175 9.67717 9.69562C9.51643 9.8495 9.29841 9.93595 9.07108 9.93595C8.84375 9.93595 8.62573 9.8495 8.46499 9.69562C8.30424 9.54175 8.21394 9.33305 8.21394 9.11543C8.21394 8.89782 8.30424 8.68912 8.46499 8.53524C8.62573 8.38137 8.84375 8.29492 9.07108 8.29492C9.29841 8.29492 9.51643 8.38137 9.67717 8.53524C9.83792 8.68912 9.92822 8.89782 9.92822 9.11543ZM5.64251 12.3975C5.64251 12.6151 5.5522 12.8238 5.39146 12.9777C5.23071 13.1315 5.01269 13.218 4.78537 13.218C4.55804 13.218 4.34002 13.1315 4.17927 12.9777C4.01853 12.8238 3.92822 12.6151 3.92822 12.3975C3.92822 12.1799 4.01853 11.9712 4.17927 11.8173C4.34002 11.6634 4.55804 11.577 4.78537 11.577C5.01269 11.577 5.23071 11.6634 5.39146 11.8173C5.5522 11.9712 5.64251 12.1799 5.64251 12.3975ZM5.64251 9.11543C5.64251 9.33305 5.5522 9.54175 5.39146 9.69562C5.23071 9.8495 5.01269 9.93595 4.78537 9.93595C4.55804 9.93595 4.34002 9.8495 4.17927 9.69562C4.01853 9.54175 3.92822 9.33305 3.92822 9.11543C3.92822 8.89782 4.01853 8.68912 4.17927 8.53524C4.34002 8.38137 4.55804 8.29492 4.78537 8.29492C5.01269 8.29492 5.23071 8.38137 5.39146 8.53524C5.5522 8.68912 5.64251 8.89782 5.64251 9.11543Z" fill="#3B3731" />
                                                    </svg> Wed, 18 Dec 2025</span>
                                                <span><svg width="14" height="14" viewBox="0 0 16 16" fill="none">
                                                        <circle cx="8" cy="8" r="6" stroke="#3B3731" stroke-width="1.5" />
                                                        <path d="M8 4.5V8L10.5 10" stroke="#3B3731" stroke-width="1.5" stroke-linecap="round" />
                                                    </svg> 14:30 - 15:30</span>
                                                <span><svg xmlns="http://www.w3.org/2000/svg" width="12" height="16" viewBox="0 0 12 16" fill="none">
                                                        <path d="M6 0.5C7.4694 0.5 8.87214 1.04525 9.90137 2.00586C10.9293 2.96529 11.4999 4.25871 11.5 5.59961C11.5 7.10011 10.6408 8.95946 9.51855 10.7236C8.41048 12.4655 7.10434 14.0263 6.32227 14.9082C6.14625 15.1067 5.85375 15.1067 5.67773 14.9082C4.89566 14.0263 3.58952 12.4655 2.48145 10.7236C1.35919 8.95946 0.5 7.10011 0.5 5.59961C0.500111 4.25871 1.07068 2.96529 2.09863 2.00586C3.12786 1.04525 4.53061 0.5 6 0.5ZM6 3.09961C5.30978 3.09961 4.64141 3.35564 4.14355 3.82031C3.64466 4.28597 3.35753 4.92517 3.35742 5.59961C3.35742 6.27422 3.64453 6.91413 4.14355 7.37988C4.64141 7.84453 5.30979 8.09961 6 8.09961C6.34236 8.09961 6.68202 8.03695 7 7.91406C7.31807 7.7911 7.60965 7.61022 7.85645 7.37988C8.10326 7.14952 8.30086 6.87397 8.43652 6.56836C8.57224 6.26256 8.64258 5.93289 8.64258 5.59961C8.64247 4.92517 8.35534 4.28597 7.85645 3.82031C7.35859 3.35564 6.69022 3.09961 6 3.09961Z" stroke="#3B3731" />
                                                    </svg> Victoria Embankment</span>
                                            </div>
                                            <div class="cnl-pet">
                                                <img src="<?= BASE_URL ?>assets/images/pet_details_1.png" alt="Bella">
                                                <span>Bella · Rabbit (Mini Lop)</span>
                                            </div>
                                            <div class="cnl-refund">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none" aria-hidden="true">
                                                    <circle cx="9" cy="9" r="8" stroke="#A0BE63" stroke-width="1.5" />
                                                    <path d="M5.5 9.2L7.8 11.5L12.5 6.5" stroke="#A0BE63" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                </svg>
                                                <p>Free cancellation applies — this booking is more than 24 hours away. You'll receive a full refund of £148.00 in 3–5 business days.</p>
                                            </div>
                                        </div>

                                        <div class="cnl-policy">
                                            <p class="cnl-policy-title">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 12 12" fill="none" aria-hidden="true">
                                                    <circle cx="6" cy="6" r="5.5" stroke="#FF6E6E" />
                                                    <path d="M4.2666 7.99993L7.99993 4.2666M4.2666 4.2666L7.99993 7.99993" stroke="#FF6E6E" stroke-linecap="round" />
                                                </svg>
                                                <span>Cancellation policy</span>
                                            </p>
                                            <ul>
                                                <li>Free cancellation if cancelled more than 24 hours before the appointment.</li>
                                                <li>Cancellations within 24 hour incur a fee of up to 50% of the booking cost.</li>
                                                <li>You can reschedule instead — your host will be notified.</li>
                                            </ul>
                                        </div>

                                        <p class="cnl-reschedule">
                                            Need to change the date or add-ons instead?
                                            <button type="button" class="cnl-reschedule-link" data-modal-open="change_space_booking_modal" data-close-parent-modal>Reschedule this booking</button>
                                        </p>

                                        <div class="cnl-footer">
                                            <button type="button" class="cnl-btn-keep" data-modal-close>Keep booking</button>
                                            <button type="button" class="cnl-btn-cancel" id="cnl-confirm-space">Yes, cancel booking</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Groomer Booking Cancelled Modal -->
                            <div class="modal" id="groomer_booking_cancelled_modal">
                                <div class="modal-content size bcm-modal-content">
                                    <div class="bcm-modal">
                                        <button class="bcm-close" type="button" data-modal-close aria-label="Close">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 36 36" fill="none">
                                                <circle cx="18" cy="18" r="17.5" stroke="#3B3731" />
                                                <path d="M12.8 24.0008L24 12.8008M12.8 12.8008L24 24.0008" stroke="#3B3731" stroke-width="1.5" stroke-linecap="round" />
                                            </svg>
                                        </button>

                                        <div class="bcm-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="102" height="96" viewBox="0 0 102 96" fill="none" aria-hidden="true">
                                                <path d="M5.00624 36C4.80225 39.6766 4.80225 44.0506 4.80225 49.3053V57.6169C4.80225 73.2884 4.80686 81.1221 10.2136 85.9926C15.6204 90.8632 24.3285 90.8632 41.74 90.8632H60.2088C77.6204 90.8632 86.3238 90.8591 91.7352 85.9926C97.1466 81.1262 97.1466 73.2884 97.1466 57.6169V49.3053C97.1466 44.0501 97.146 39.6763 96.9415 36H5.00624Z" fill="#FFEDED" />
                                                <path d="M1 46.4721C1 28.4229 0.999999 19.396 6.86 13.7912C12.72 8.18643 22.145 8.18164 41 8.18164H61C79.855 8.18164 89.285 8.18164 95.14 13.7912C100.995 19.4007 101 28.4229 101 46.4721V56.0447C101 74.0938 101 83.1208 95.14 88.7256C89.28 94.3303 79.855 94.3351 61 94.3351H41C22.145 94.3351 12.715 94.3351 6.86 88.7256C1.005 83.116 1 74.0938 1 56.0447V46.4721Z" stroke="#3B3731" stroke-width="2" />
                                                <path d="M25.244 8.14517V1M76.7052 8.14517V1M2.08643 31.9624H99.8628" stroke="#3B3731" stroke-width="2" stroke-linecap="round" />
                                                <circle cx="51.5" cy="63.5" r="11.25" stroke="#FF6E6E" stroke-width="2.5" />
                                                <path d="M47.8887 67.6664L55.6664 59.8887M47.8887 59.8887L55.6664 67.6664" stroke="#FF6E6E" stroke-width="2.5" stroke-linecap="round" />
                                            </svg>
                                        </div>

                                        <h1 class="bcm-title">Your booking has been <em>cancelled.</em></h1>
                                        <p class="bcm-desc">Your grooming appointment with Sarah has been cancelled.</p>

                                        <div class="bcm-card">
                                            <p class="bcm-card-label">UPDATED BOOKING</p>
                                            <div class="bcm-card-inner">
                                                <div class="bcm-card-top">
                                                    <div>
                                                        <p class="bcm-provider-name">Sarah's Grooming Studio</p>
                                                        <p class="bcm-provider-sub">Sarah W.</p>
                                                    </div>
                                                    <p class="bcm-price">£48.00</p>
                                                </div>
                                                <div class="bcm-meta">
                                                    <span><svg xmlns="http://www.w3.org/2000/svg" width="14" height="15" viewBox="0 0 16 17" fill="none">
                                                            <path d="M4.94591 11.5544C6.23114 12.8397 9.35699 11.798 11.9274 9.22713C14.4983 6.65667 15.54 3.53082 14.2548 2.24559M8.72754 1.37259L9.30927 1.95473M6.6915 3.40904L7.27322 3.99077M4.9455 5.73636L5.52722 6.31809M4.36377 8.6454L4.9455 9.22713M11.9274 0.5L12.5092 1.08173M11.3457 3.99118L12.5092 5.15463M9.30968 6.02763L10.4731 7.19109M6.98236 7.77281L8.14581 8.93627" stroke="#FF6E6E" stroke-linecap="round" stroke-linejoin="round" />
                                                            <path d="M4.94547 13.2998C5.42747 12.8178 5.42747 12.0364 4.94548 11.5544C4.46348 11.0724 3.68202 11.0724 3.20003 11.5544L0.872775 13.8816C0.390784 14.3636 0.390784 15.1451 0.872775 15.6271C1.35477 16.1091 2.13623 16.1091 2.61822 15.6271L4.94547 13.2998Z" stroke="#FF6E6E" stroke-linecap="round" stroke-linejoin="round" />
                                                        </svg> Bath &amp; Brush</span>
                                                    <span><svg xmlns="http://www.w3.org/2000/svg" width="15" height="14" viewBox="0 0 19 17" fill="none">
                                                            <path d="M0.5 8.29554C0.5 5.20139 0.5 3.6539 1.50457 2.69308C2.50914 1.73227 4.12486 1.73145 7.35714 1.73145H10.7857C14.018 1.73145 15.6346 1.73145 16.6383 2.69308C17.642 3.65472 17.6429 5.20139 17.6429 8.29554V9.93656C17.6429 13.0307 17.6429 14.5782 16.6383 15.539C15.6337 16.4998 14.018 16.5007 10.7857 16.5007H7.35714C4.12486 16.5007 2.50829 16.5007 1.50457 15.539C0.500857 14.5774 0.5 13.0307 0.5 9.93656V8.29554Z" stroke="#FF6E6E" />
                                                            <path d="M4.78585 1.73077V0.5M13.3573 1.73077V0.5M0.928711 5.83333H17.2144" stroke="#FF6E6E" stroke-linecap="round" />
                                                        </svg> Wed, 18 Dec 2025</span>
                                                    <span><svg width="14" height="14" viewBox="0 0 16 16" fill="none">
                                                            <circle cx="8" cy="8" r="6" stroke="#3B3731" stroke-width="1.5" />
                                                            <path d="M8 4.5V8L10.5 10" stroke="#3B3731" stroke-width="1.5" stroke-linecap="round" />
                                                        </svg> 14:30 - 15:30</span>
                                                    <span><svg xmlns="http://www.w3.org/2000/svg" width="11" height="14" viewBox="0 0 12 16" fill="none">
                                                            <path d="M6 0.5C7.4694 0.5 8.87214 1.04525 9.90137 2.00586C10.9293 2.96529 11.4999 4.25871 11.5 5.59961C11.5 7.10011 10.6408 8.95946 9.51855 10.7236C8.41048 12.4655 7.10434 14.0263 6.32227 14.9082C6.14625 15.1067 5.85375 15.1067 5.67773 14.9082C4.89566 14.0263 3.58952 12.4655 2.48145 10.7236C1.35919 8.95946 0.5 7.10011 0.5 5.59961C0.500111 4.25871 1.07068 2.96529 2.09863 2.00586C3.12786 1.04525 4.53061 0.5 6 0.5ZM6 3.09961C5.30978 3.09961 4.64141 3.35564 4.14355 3.82031C3.64466 4.28597 3.35753 4.92517 3.35742 5.59961C3.35742 6.27422 3.64453 6.91413 4.14355 7.37988C4.64141 7.84453 5.30979 8.09961 6 8.09961C6.69022 8.09961 7.35859 7.84453 7.85645 7.37988C8.35534 6.91413 8.64247 6.27422 8.64258 5.59961C8.64258 4.92517 8.35534 4.28597 7.85645 3.82031C7.35859 3.35564 6.69022 3.09961 6 3.09961Z" stroke="#FF6E6E" />
                                                        </svg> At your home</span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="bcm-refund">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none" aria-hidden="true">
                                                <circle cx="9" cy="9" r="8" stroke="#A0BE63" stroke-width="1.5" />
                                                <path d="M5.5 9.2L7.8 11.5L12.5 6.5" stroke="#A0BE63" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                            <p>You'll receive a full refund of £48.00. Refunds processed in 3-5 days.</p>
                                        </div>

                                        <div class="bcm-footer">
                                            <a href="<?= BASE_URL ?>profiles/groomer/groomer_profile.php" class="bcm-btn-rebook">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                                    <path d="M2.23096 15.4951V12.6123H5.11378" stroke="#6FA0C3" stroke-linecap="round" stroke-linejoin="round" />
                                                    <path d="M15.3656 6.62252C15.6715 8.25452 15.4269 9.94189 14.6702 11.4199C13.9135 12.8978 12.6875 14.0827 11.1846 14.7887C9.68175 15.4946 7.98704 15.6817 6.3664 15.3204C4.74575 14.9592 3.2909 14.0701 2.23013 12.7927M0.628303 9.37748C0.322432 7.74548 0.567036 6.05811 1.32373 4.58014C2.08043 3.10218 3.3064 1.91725 4.80927 1.2113C6.31214 0.505355 8.00686 0.318331 9.6275 0.679579C11.2481 1.04083 12.703 1.9299 13.7638 3.2073" stroke="#6FA0C3" stroke-linecap="round" stroke-linejoin="round" />
                                                    <path d="M13.7627 0.504883V3.38771H10.8799" stroke="#6FA0C3" stroke-linecap="round" stroke-linejoin="round" />
                                                </svg>
                                                Rebook
                                            </a>
                                            <button type="button" class="bcm-btn-primary" data-modal-close>Back to my bookings</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Space Booking Cancelled Modal -->
                            <div class="modal" id="space_booking_cancelled_modal">
                                <div class="modal-content size bcm-modal-content">
                                    <div class="bcm-modal">
                                        <button class="bcm-close" type="button" data-modal-close aria-label="Close">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 36 36" fill="none">
                                                <circle cx="18" cy="18" r="17.5" stroke="#3B3731" />
                                                <path d="M12.8 24.0008L24 12.8008M12.8 12.8008L24 24.0008" stroke="#3B3731" stroke-width="1.5" stroke-linecap="round" />
                                            </svg>
                                        </button>

                                        <div class="bcm-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="102" height="96" viewBox="0 0 102 96" fill="none" aria-hidden="true">
                                                <path d="M5.00624 36C4.80225 39.6766 4.80225 44.0506 4.80225 49.3053V57.6169C4.80225 73.2884 4.80686 81.1221 10.2136 85.9926C15.6204 90.8632 24.3285 90.8632 41.74 90.8632H60.2088C77.6204 90.8632 86.3238 90.8591 91.7352 85.9926C97.1466 81.1262 97.1466 73.2884 97.1466 57.6169V49.3053C97.1466 44.0501 97.146 39.6763 96.9415 36H5.00624Z" fill="#FFEDED" />
                                                <path d="M1 46.4721C1 28.4229 0.999999 19.396 6.86 13.7912C12.72 8.18643 22.145 8.18164 41 8.18164H61C79.855 8.18164 89.285 8.18164 95.14 13.7912C100.995 19.4007 101 28.4229 101 46.4721V56.0447C101 74.0938 101 83.1208 95.14 88.7256C89.28 94.3303 79.855 94.3351 61 94.3351H41C22.145 94.3351 12.715 94.3351 6.86 88.7256C1.005 83.116 1 74.0938 1 56.0447V46.4721Z" stroke="#3B3731" stroke-width="2" />
                                                <path d="M25.244 8.14517V1M76.7052 8.14517V1M2.08643 31.9624H99.8628" stroke="#3B3731" stroke-width="2" stroke-linecap="round" />
                                                <circle cx="51.5" cy="63.5" r="11.25" stroke="#FF6E6E" stroke-width="2.5" />
                                                <path d="M47.8887 67.6664L55.6664 59.8887M47.8887 59.8887L55.6664 67.6664" stroke="#FF6E6E" stroke-width="2.5" stroke-linecap="round" />
                                            </svg>
                                        </div>

                                        <h1 class="bcm-title">Your booking has been <em>cancelled.</em></h1>
                                        <p class="bcm-desc">Your space booking with Furs &amp; Co. Studio has been cancelled.</p>

                                        <div class="bcm-card">
                                            <p class="bcm-card-label">UPDATED BOOKING</p>
                                            <div class="bcm-card-inner">
                                                <div class="bcm-card-top">
                                                    <div>
                                                        <p class="bcm-provider-name">Furs &amp; Co. Studio</p>
                                                        <p class="bcm-provider-sub">Hosted by Dev É.</p>
                                                    </div>
                                                    <p class="bcm-price">£148.00</p>
                                                </div>
                                                <div class="bcm-meta">
                                                    <span><svg xmlns="http://www.w3.org/2000/svg" width="16" height="13" viewBox="0 0 20 16" fill="none">
                                                            <path d="M16.7806 15.5092V4.90774C16.7806 4.8823 16.7827 4.85737 16.7866 4.83297L13.9203 2.38869C13.3107 1.86965 12.8896 1.51192 12.5323 1.2787C12.1873 1.05357 11.9555 0.981548 11.7338 0.981548C11.5122 0.981548 11.2818 1.05383 10.9372 1.2787C10.5799 1.51195 10.1576 1.86936 9.54726 2.38869L6.67887 4.83297C6.68281 4.85747 6.68691 4.8822 6.68691 4.90774V15.5092C6.68648 15.7799 6.4561 16 6.17197 16C5.88803 15.9998 5.65746 15.7798 5.65703 15.5092V5.70333L5.12599 6.15768C4.91398 6.33835 4.58739 6.31948 4.39783 6.11742C4.20902 5.91549 4.22669 5.60589 4.43806 5.42535L8.85933 1.65828H8.86134C9.4513 1.15631 9.92906 0.747109 10.3539 0.469686C10.7915 0.184003 11.226 2.87993e-07 11.7338 0C12.2415 0 12.6759 0.183991 13.1136 0.469686C13.5387 0.747176 14.0185 1.15613 14.6082 1.65828L19.0295 5.42535C19.2408 5.60589 19.2585 5.91549 19.0697 6.11742C18.8801 6.31948 18.5535 6.33835 18.3415 6.15768L17.8105 5.70333V15.5092C17.8101 15.7798 17.5795 15.9998 17.2955 16C17.0114 16 16.781 15.7799 16.7806 15.5092Z" fill="#FF6E6E" />
                                                        </svg> Half-Day</span>
                                                    <span><svg xmlns="http://www.w3.org/2000/svg" width="15" height="14" viewBox="0 0 19 17" fill="none">
                                                            <path d="M0.5 8.29554C0.5 5.20139 0.5 3.6539 1.50457 2.69308C2.50914 1.73227 4.12486 1.73145 7.35714 1.73145H10.7857C14.018 1.73145 15.6346 1.73145 16.6383 2.69308C17.642 3.65472 17.6429 5.20139 17.6429 8.29554V9.93656C17.6429 13.0307 17.6429 14.5782 16.6383 15.539C15.6337 16.4998 14.018 16.5007 10.7857 16.5007H7.35714C4.12486 16.5007 2.50829 16.5007 1.50457 15.539C0.500857 14.5774 0.5 13.0307 0.5 9.93656V8.29554Z" stroke="#FF6E6E" />
                                                            <path d="M4.78585 1.73077V0.5M13.3573 1.73077V0.5M0.928711 5.83333H17.2144" stroke="#FF6E6E" stroke-linecap="round" />
                                                        </svg> Wed, 18 Dec 2025</span>
                                                    <span><svg width="14" height="14" viewBox="0 0 16 16" fill="none">
                                                            <circle cx="8" cy="8" r="6" stroke="#3B3731" stroke-width="1.5" />
                                                            <path d="M8 4.5V8L10.5 10" stroke="#3B3731" stroke-width="1.5" stroke-linecap="round" />
                                                        </svg> 14:30 - 15:30</span>
                                                    <span><svg xmlns="http://www.w3.org/2000/svg" width="11" height="14" viewBox="0 0 12 16" fill="none">
                                                            <path d="M6 0.5C7.4694 0.5 8.87214 1.04525 9.90137 2.00586C10.9293 2.96529 11.4999 4.25871 11.5 5.59961C11.5 7.10011 10.6408 8.95946 9.51855 10.7236C8.41048 12.4655 7.10434 14.0263 6.32227 14.9082C6.14625 15.1067 5.85375 15.1067 5.67773 14.9082C4.89566 14.0263 3.58952 12.4655 2.48145 10.7236C1.35919 8.95946 0.5 7.10011 0.5 5.59961C0.500111 4.25871 1.07068 2.96529 2.09863 2.00586C3.12786 1.04525 4.53061 0.5 6 0.5ZM6 3.09961C5.30978 3.09961 4.64141 3.35564 4.14355 3.82031C3.64466 4.28597 3.35753 4.92517 3.35742 5.59961C3.35742 6.27422 3.64453 6.91413 4.14355 7.37988C4.64141 7.84453 5.30979 8.09961 6 8.09961C6.69022 8.09961 7.35859 7.84453 7.85645 7.37988C8.35534 6.91413 8.64247 6.27422 8.64258 5.59961C8.64258 4.92517 8.35534 4.28597 7.85645 3.82031C7.35859 3.35564 6.69022 3.09961 6 3.09961Z" stroke="#FF6E6E" />
                                                        </svg> Victoria Embankment</span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="bcm-refund">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none" aria-hidden="true">
                                                <circle cx="9" cy="9" r="8" stroke="#A0BE63" stroke-width="1.5" />
                                                <path d="M5.5 9.2L7.8 11.5L12.5 6.5" stroke="#A0BE63" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                            <p>You'll receive a full refund of £148.00. Refunds processed in 3-5 days.</p>
                                        </div>

                                        <div class="bcm-footer">
                                            <a href="<?= BASE_URL ?>profiles/space/space_profile.php" class="bcm-btn-rebook">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                                    <path d="M2.23096 15.4951V12.6123H5.11378" stroke="#6FA0C3" stroke-linecap="round" stroke-linejoin="round" />
                                                    <path d="M15.3656 6.62252C15.6715 8.25452 15.4269 9.94189 14.6702 11.4199C13.9135 12.8978 12.6875 14.0827 11.1846 14.7887C9.68175 15.4946 7.98704 15.6817 6.3664 15.3204C4.74575 14.9592 3.2909 14.0701 2.23013 12.7927M0.628303 9.37748C0.322432 7.74548 0.567036 6.05811 1.32373 4.58014C2.08043 3.10218 3.3064 1.91725 4.80927 1.2113C6.31214 0.505355 8.00686 0.318331 9.6275 0.679579C11.2481 1.04083 12.703 1.9299 13.7638 3.2073" stroke="#6FA0C3" stroke-linecap="round" stroke-linejoin="round" />
                                                    <path d="M13.7627 0.504883V3.38771H10.8799" stroke="#6FA0C3" stroke-linecap="round" stroke-linejoin="round" />
                                                </svg>
                                                Rebook
                                            </a>
                                            <button type="button" class="bcm-btn-primary" data-modal-close>Back to my bookings</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Review Modal  -->

                            <div class="modal" id="review-modal">
                                <div class="modal-content size">
                                    <div class="container">
                                        <div class="row mt-4">
                                            <div class="col-lg-1"></div>
                                            <div class="col-lg-9">
                                                <div class="modal-head d-flex flex-column align-items-center justify-content-center">
                                                    <h1 class="large-font line-default">Write a Review</h1>
                                                    <h3 class="normal-light-color mt-2 text-center">Share your experience with [Groomer Name / Space Name].</h3>
                                                </div>
                                            </div>
                                            <div class="col-lg-2">
                                                <div class="d-flex align-items-center justify-content-end cursor modal-cross mt-3" data-modal-close>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 36 36" fill="none">
                                                        <circle cx="18" cy="18" r="17.5" stroke="#3B3731" />
                                                        <path d="M12.8 24.0008L24 12.8008M12.8 12.8008L24 24.0008" stroke="#3B3731" stroke-width="1.5" stroke-linecap="round" />
                                                    </svg>
                                                </div>
                                            </div>
                                            <div class="col-lg-12" style="padding: 15px 35px;">

                                                <form id="reviewForm" enctype="multipart/form-data">
                                                    <div class="review-profile-section d-flex align-items-center gap-25 mt-5">
                                                        <div class="avatar-wrap">
                                                            <img class="avatar" src="<?= BASE_URL ?>assets/images/groomer-profile.png" alt="Sarah's avatar">
                                                            <div class="badge-shield" title="Verified">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="33" viewBox="0 0 30 33" fill="none">
                                                                    <ellipse cx="15.873" cy="16.5256" rx="9.3645" ry="8.81365" fill="white"></ellipse>
                                                                    <path d="M15.44 0.185076C15.1841 0.0638192 14.9099 0 14.6235 0C14.3372 0 14.063 0.0638192 13.8071 0.185076L2.3337 5.28423C0.993208 5.87775 -0.00606541 7.26263 2.77146e-05 8.93469C0.0304934 15.2656 2.51649 26.8487 13.015 32.1138C14.0325 32.6244 15.2146 32.6244 16.2321 32.1138C26.7306 26.8487 29.2166 15.2656 29.247 8.93469C29.2531 7.26263 28.2539 5.87775 26.9134 5.28423L15.44 0.185076ZM8.82897 18.2651C9.12144 18.3416 9.43219 18.3799 9.74903 18.3799C11.8999 18.3799 13.6486 16.5483 13.6486 14.2955V10.2111H16.3418C17.0791 10.2111 17.7554 10.645 18.0844 11.3407L18.5231 12.2533H22.4227C22.9589 12.2533 23.3976 12.7128 23.3976 13.2744V15.3166C23.3976 18.1374 21.2163 20.4222 18.5231 20.4222H15.5984V23.6578C15.5984 24.1237 15.2389 24.5066 14.7881 24.5066C14.6784 24.5066 14.5687 24.4811 14.4712 24.4364L8.45729 21.7368C8.05514 21.5581 7.79923 21.1433 7.79923 20.6902C7.79923 20.5115 7.83579 20.3392 7.915 20.1796L8.82897 18.2651ZM8.77413 10.2111H11.6988V14.2955C11.6988 15.4251 10.8275 16.3377 9.74903 16.3377C8.67055 16.3377 7.79923 15.4251 7.79923 14.2955V11.2322C7.79923 10.6706 8.23794 10.2111 8.77413 10.2111ZM16.5733 13.2744C16.5733 13.0036 16.4706 12.7439 16.2878 12.5524C16.105 12.3609 15.857 12.2533 15.5984 12.2533C15.3399 12.2533 15.0919 12.3609 14.9091 12.5524C14.7262 12.7439 14.6235 13.0036 14.6235 13.2744C14.6235 13.5452 14.7262 13.8049 14.9091 13.9964C15.0919 14.1879 15.3399 14.2955 15.5984 14.2955C15.857 14.2955 16.105 14.1879 16.2878 13.9964C16.4706 13.8049 16.5733 13.5452 16.5733 13.2744Z" fill="#C9DDA0"></path>
                                                                </svg>
                                                            </div>
                                                        </div>
                                                        <div class="review-details d-flex flex-column gap-15">
                                                            <div class="review-info-details">
                                                                <div class="review-info d-flex justify-content-between">
                                                                    <div>
                                                                        <h3 class="review-name normal-font-bold">Sarah's Grooming Studio</h3>
                                                                        <p class="review-studio-name normal-light-color ">Cathy P.</p>
                                                                    </div>
                                                                    <div class="review-page-tags">
                                                                        <span class="review-page-tag">Home Visit</span>
                                                                    </div>
                                                                </div>
                                                                <div class="review-info-row d-flex align-items-center gap-25 mt-3">
                                                                    <div class="d-flex align-items-center gap-10">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="17" viewBox="0 0 16 17" fill="none">
                                                                            <path d="M4.94591 11.5544C6.23114 12.8397 9.35699 11.798 11.9274 9.22713C14.4983 6.65667 15.54 3.53082 14.2548 2.24559M8.72754 1.37259L9.30927 1.95473M6.6915 3.40904L7.27322 3.99077M4.9455 5.73636L5.52722 6.31809M4.36377 8.6454L4.9455 9.22713M11.9274 0.5L12.5092 1.08173M11.3457 3.99118L12.5092 5.15463M9.30968 6.02763L10.4731 7.19109M6.98236 7.77281L8.14581 8.93627" stroke="#3B3731" stroke-linecap="round" stroke-linejoin="round"></path>
                                                                            <path d="M4.94547 13.2998C5.42747 12.8178 5.42747 12.0364 4.94548 11.5544C4.46348 11.0724 3.68202 11.0724 3.20003 11.5544L0.872775 13.8816C0.390784 14.3636 0.390784 15.1451 0.872775 15.6271C1.35477 16.1091 2.13623 16.1091 2.61822 15.6271L4.94547 13.2998Z" stroke="#3B3731" stroke-linecap="round" stroke-linejoin="round"></path>
                                                                        </svg>
                                                                        <span class="normal-light-color font-color">Full Groom</span>
                                                                    </div>
                                                                    <div class="d-flex align-items-center gap-10">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="19" height="17" viewBox="0 0 19 17" fill="none">
                                                                            <path d="M0.5 8.29554C0.5 5.20139 0.5 3.6539 1.50457 2.69308C2.50914 1.73227 4.12486 1.73145 7.35714 1.73145H10.7857C14.018 1.73145 15.6346 1.73145 16.6383 2.69308C17.642 3.65472 17.6429 5.20139 17.6429 8.29554V9.93656C17.6429 13.0307 17.6429 14.5782 16.6383 15.539C15.6337 16.4998 14.018 16.5007 10.7857 16.5007H7.35714C4.12486 16.5007 2.50829 16.5007 1.50457 15.539C0.500857 14.5774 0.5 13.0307 0.5 9.93656V8.29554Z" stroke="#3B3731"></path>
                                                                            <path d="M4.78585 1.73077V0.5M13.3573 1.73077V0.5M0.928711 5.83333H17.2144" stroke="#3B3731" stroke-linecap="round"></path>
                                                                            <path d="M14.2144 12.3975C14.2144 12.6151 14.1241 12.8238 13.9634 12.9777C13.8026 13.1315 13.5846 13.218 13.3573 13.218C13.13 13.218 12.9119 13.1315 12.7512 12.9777C12.5904 12.8238 12.5001 12.6151 12.5001 12.3975C12.5001 12.1799 12.5904 11.9712 12.7512 11.8173C12.9119 11.6634 13.13 11.577 13.3573 11.577C13.5846 11.577 13.8026 11.6634 13.9634 11.8173C14.1241 11.9712 14.2144 12.1799 14.2144 12.3975ZM14.2144 9.11543C14.2144 9.33305 14.1241 9.54175 13.9634 9.69562C13.8026 9.8495 13.5846 9.93595 13.3573 9.93595C13.13 9.93595 12.9119 9.8495 12.7512 9.69562C12.5904 9.54175 12.5001 9.33305 12.5001 9.11543C12.5001 8.89782 12.5904 8.68912 12.7512 8.53524C12.9119 8.38137 13.13 8.29492 13.3573 8.29492C13.5846 8.29492 13.8026 8.38137 13.9634 8.53524C14.1241 8.68912 14.2144 8.89782 14.2144 9.11543ZM9.92871 12.3975C9.92871 12.6151 9.83841 12.8238 9.67766 12.9777C9.51691 13.1315 9.2989 13.218 9.07157 13.218C8.84424 13.218 8.62622 13.1315 8.46548 12.9777C8.30473 12.8238 8.21443 12.6151 8.21443 12.3975C8.21443 12.1799 8.30473 11.9712 8.46548 11.8173C8.62622 11.6634 8.84424 11.577 9.07157 11.577C9.2989 11.577 9.51691 11.6634 9.67766 11.8173C9.83841 11.9712 9.92871 12.1799 9.92871 12.3975ZM9.92871 9.11543C9.92871 9.33305 9.83841 9.54175 9.67766 9.69562C9.51691 9.8495 9.2989 9.93595 9.07157 9.93595C8.84424 9.93595 8.62622 9.8495 8.46548 9.69562C8.30473 9.54175 8.21443 9.33305 8.21443 9.11543C8.21443 8.89782 8.30473 8.68912 8.46548 8.53524C8.62622 8.38137 8.84424 8.29492 9.07157 8.29492C9.2989 8.29492 9.51691 8.38137 9.67766 8.53524C9.83841 8.68912 9.92871 8.89782 9.92871 9.11543ZM5.643 12.3975C5.643 12.6151 5.55269 12.8238 5.39195 12.9777C5.2312 13.1315 5.01318 13.218 4.78585 13.218C4.55853 13.218 4.34051 13.1315 4.17976 12.9777C4.01902 12.8238 3.92871 12.6151 3.92871 12.3975C3.92871 12.1799 4.01902 11.9712 4.17976 11.8173C4.34051 11.6634 4.55853 11.577 4.78585 11.577C5.01318 11.577 5.2312 11.6634 5.39195 11.8173C5.55269 11.9712 5.643 12.1799 5.643 12.3975ZM5.643 9.11543C5.643 9.33305 5.55269 9.54175 5.39195 9.69562C5.2312 9.8495 5.01318 9.93595 4.78585 9.93595C4.55853 9.93595 4.34051 9.8495 4.17976 9.69562C4.01902 9.54175 3.92871 9.33305 3.92871 9.11543C3.92871 8.89782 4.01902 8.68912 4.17976 8.53524C4.34051 8.38137 4.55853 8.29492 4.78585 8.29492C5.01318 8.29492 5.2312 8.38137 5.39195 8.53524C5.55269 8.68912 5.643 8.89782 5.643 9.11543Z" fill="#3B3731"></path>
                                                                        </svg>
                                                                        <span class="normal-light-color font-color">18/12/2025</span>
                                                                    </div>
                                                                    <div class="d-flex align-items-center gap-10">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="15" viewBox="0 0 16 15" fill="none">
                                                                            <path d="M8 6.02632C5.73786 6.02632 3.82643 8.06405 3.20929 10.6813C2.93786 11.8323 3.34714 13.0539 4.35179 13.6279C5.14821 14.0829 6.33286 14.5 8 14.5C9.66714 14.5 10.8521 14.0829 11.6486 13.6279C12.6532 13.0539 13.0621 11.8323 12.7907 10.6813C12.1736 8.06368 10.2621 6.02632 8 6.02632ZM0.5 5.45305C0.5 6.47063 1.13929 7.5 1.92857 7.5C2.71786 7.5 3.35714 6.47063 3.35714 5.45305C3.35714 4.43547 2.71786 3.81579 1.92857 3.81579C1.13929 3.81579 0.5 4.43584 0.5 5.45305ZM15.5 5.45305C15.5 6.47063 14.8607 7.5 14.0714 7.5C13.2821 7.5 12.6429 6.47063 12.6429 5.45305C12.6429 4.43547 13.2821 3.81579 14.0714 3.81579C14.8607 3.81579 15.5 4.43584 15.5 5.45305ZM4.25 2.13726C4.25 3.15484 4.88929 4.18421 5.67857 4.18421C6.46786 4.18421 7.10714 3.15484 7.10714 2.13726C7.10714 1.11968 6.46786 0.5 5.67857 0.5C4.88929 0.5 4.25 1.12005 4.25 2.13726ZM11.75 2.13726C11.75 3.15484 11.1107 4.18421 10.3214 4.18421C9.53214 4.18421 8.89286 3.15484 8.89286 2.13726C8.89286 1.11968 9.53214 0.5 10.3214 0.5C11.1107 0.5 11.75 1.12005 11.75 2.13726Z" stroke="#3B3731" stroke-linecap="round" stroke-linejoin="round"></path>
                                                                        </svg>
                                                                        <span class="normal-light-color font-color">Bella</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="rating-group mt-5">
                                                        <h4 class="rating-section-title normal-font-bold">Overall Rating</h4>

                                                        <div class="stars mt-4 rating-stars justify-content-end">

                                                            <input type="radio" name="overall_rating" id="overall5" value="5">
                                                            <label for="overall5">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="34" height="33" viewBox="0 0 34 33">
                                                                    <path d="M14.9871 1.39799C15.5755 -0.466011 18.2133 -0.466007 18.8016 1.39799L21.3879 9.59177C21.6505 10.424 22.4225 10.9898 23.2951 10.9898L31.785 10.9898C33.7084 10.9898 34.5231 13.4394 32.9828 14.5914L26.0156 19.8022C25.3349 20.3113 25.0503 21.1952 25.3062 22.0058L27.9438 30.3621C28.5286 32.2149 26.3946 33.7294 24.8387 32.5657L18.0922 27.52C17.382 26.9888 16.4067 26.9888 15.6965 27.52L8.95006 32.5657C7.39412 33.7294 5.26012 32.2149 5.84496 30.3621L8.4825 22.0058C8.73837 21.1952 8.45385 20.3113 7.77311 19.8022L0.80589 14.5914C-0.734361 13.4394 0.0803623 10.9898 2.00374 10.9898L10.4936 10.9898C11.3663 10.9898 12.1382 10.424 12.4008 9.59177L14.9871 1.39799Z" fill="currentColor" />
                                                                </svg>
                                                            </label>

                                                            <input type="radio" name="overall_rating" id="overall4" value="4">
                                                            <label for="overall4">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="34" height="33" viewBox="0 0 34 33">
                                                                    <path d="M14.9871 1.39799C15.5755 -0.466011 18.2133 -0.466007 18.8016 1.39799L21.3879 9.59177C21.6505 10.424 22.4225 10.9898 23.2951 10.9898L31.785 10.9898C33.7084 10.9898 34.5231 13.4394 32.9828 14.5914L26.0156 19.8022C25.3349 20.3113 25.0503 21.1952 25.3062 22.0058L27.9438 30.3621C28.5286 32.2149 26.3946 33.7294 24.8387 32.5657L18.0922 27.52C17.382 26.9888 16.4067 26.9888 15.6965 27.52L8.95006 32.5657C7.39412 33.7294 5.26012 32.2149 5.84496 30.3621L8.4825 22.0058C8.73837 21.1952 8.45385 20.3113 7.77311 19.8022L0.80589 14.5914C-0.734361 13.4394 0.0803623 10.9898 2.00374 10.9898L10.4936 10.9898C11.3663 10.9898 12.1382 10.424 12.4008 9.59177L14.9871 1.39799Z" fill="currentColor" />
                                                                </svg>
                                                            </label>

                                                            <input type="radio" name="overall_rating" id="overall3" value="3">
                                                            <label for="overall3">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="34" height="33" viewBox="0 0 34 33">
                                                                    <path d="M14.9871 1.39799C15.5755 -0.466011 18.2133 -0.466007 18.8016 1.39799L21.3879 9.59177C21.6505 10.424 22.4225 10.9898 23.2951 10.9898L31.785 10.9898C33.7084 10.9898 34.5231 13.4394 32.9828 14.5914L26.0156 19.8022C25.3349 20.3113 25.0503 21.1952 25.3062 22.0058L27.9438 30.3621C28.5286 32.2149 26.3946 33.7294 24.8387 32.5657L18.0922 27.52C17.382 26.9888 16.4067 26.9888 15.6965 27.52L8.95006 32.5657C7.39412 33.7294 5.26012 32.2149 5.84496 30.3621L8.4825 22.0058C8.73837 21.1952 8.45385 20.3113 7.77311 19.8022L0.80589 14.5914C-0.734361 13.4394 0.0803623 10.9898 2.00374 10.9898L10.4936 10.9898C11.3663 10.9898 12.1382 10.424 12.4008 9.59177L14.9871 1.39799Z" fill="currentColor" />
                                                                </svg>
                                                            </label>

                                                            <input type="radio" name="overall_rating" id="overall2" value="2">
                                                            <label for="overall2">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="34" height="33" viewBox="0 0 34 33">
                                                                    <path d="M14.9871 1.39799C15.5755 -0.466011 18.2133 -0.466007 18.8016 1.39799L21.3879 9.59177C21.6505 10.424 22.4225 10.9898 23.2951 10.9898L31.785 10.9898C33.7084 10.9898 34.5231 13.4394 32.9828 14.5914L26.0156 19.8022C25.3349 20.3113 25.0503 21.1952 25.3062 22.0058L27.9438 30.3621C28.5286 32.2149 26.3946 33.7294 24.8387 32.5657L18.0922 27.52C17.382 26.9888 16.4067 26.9888 15.6965 27.52L8.95006 32.5657C7.39412 33.7294 5.26012 32.2149 5.84496 30.3621L8.4825 22.0058C8.73837 21.1952 8.45385 20.3113 7.77311 19.8022L0.80589 14.5914C-0.734361 13.4394 0.0803623 10.9898 2.00374 10.9898L10.4936 10.9898C11.3663 10.9898 12.1382 10.424 12.4008 9.59177L14.9871 1.39799Z" fill="currentColor" />
                                                                </svg>
                                                            </label>

                                                            <input type="radio" name="overall_rating" id="overall1" value="1">
                                                            <label for="overall1">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="34" height="33" viewBox="0 0 34 33">
                                                                    <path d="M14.9871 1.39799C15.5755 -0.466011 18.2133 -0.466007 18.8016 1.39799L21.3879 9.59177C21.6505 10.424 22.4225 10.9898 23.2951 10.9898L31.785 10.9898C33.7084 10.9898 34.5231 13.4394 32.9828 14.5914L26.0156 19.8022C25.3349 20.3113 25.0503 21.1952 25.3062 22.0058L27.9438 30.3621C28.5286 32.2149 26.3946 33.7294 24.8387 32.5657L18.0922 27.52C17.382 26.9888 16.4067 26.9888 15.6965 27.52L8.95006 32.5657C7.39412 33.7294 5.26012 32.2149 5.84496 30.3621L8.4825 22.0058C8.73837 21.1952 8.45385 20.3113 7.77311 19.8022L0.80589 14.5914C-0.734361 13.4394 0.0803623 10.9898 2.00374 10.9898L10.4936 10.9898C11.3663 10.9898 12.1382 10.424 12.4008 9.59177L14.9871 1.39799Z" fill="currentColor" />
                                                                </svg>
                                                            </label>

                                                        </div>
                                                    </div>

                                                    <!-- HTML -->
                                                    <div class="specific-row mt-4 d-flex align-items-center justify-content-between">
                                                        <span class="simple-font">Professionalism</span>

                                                        <div class="stars rating-stars">

                                                            <input type="radio" name="professionalism" id="prof-5" value="5">
                                                            <label for="prof-5">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="34" height="33" viewBox="0 0 34 33">
                                                                    <path d="M14.9871 1.39799C15.5755 -0.466011 18.2133 -0.466007 18.8016 1.39799L21.3879 9.59177C21.6505 10.424 22.4225 10.9898 23.2951 10.9898L31.785 10.9898C33.7084 10.9898 34.5231 13.4394 32.9828 14.5914L26.0156 19.8022C25.3349 20.3113 25.0503 21.1952 25.3062 22.0058L27.9438 30.3621C28.5286 32.2149 26.3946 33.7294 24.8387 32.5657L18.0922 27.52C17.382 26.9888 16.4067 26.9888 15.6965 27.52L8.95006 32.5657C7.39412 33.7294 5.26012 32.2149 5.84496 30.3621L8.4825 22.0058C8.73837 21.1952 8.45385 20.3113 7.77311 19.8022L0.80589 14.5914C-0.734361 13.4394 0.0803623 10.9898 2.00374 10.9898L10.4936 10.9898C11.3663 10.9898 12.1382 10.424 12.4008 9.59177L14.9871 1.39799Z" fill="currentColor" />
                                                                </svg>
                                                            </label>

                                                            <input type="radio" name="professionalism" id="prof-4" value="4"><label for="prof-4"><svg xmlns="http://www.w3.org/2000/svg" width="34" height="33" viewBox="0 0 34 33">
                                                                    <path d="M14.9871 1.39799C15.5755 -0.466011 18.2133 -0.466007 18.8016 1.39799L21.3879 9.59177C21.6505 10.424 22.4225 10.9898 23.2951 10.9898L31.785 10.9898C33.7084 10.9898 34.5231 13.4394 32.9828 14.5914L26.0156 19.8022C25.3349 20.3113 25.0503 21.1952 25.3062 22.0058L27.9438 30.3621C28.5286 32.2149 26.3946 33.7294 24.8387 32.5657L18.0922 27.52C17.382 26.9888 16.4067 26.9888 15.6965 27.52L8.95006 32.5657C7.39412 33.7294 5.26012 32.2149 5.84496 30.3621L8.4825 22.0058C8.73837 21.1952 8.45385 20.3113 7.77311 19.8022L0.80589 14.5914C-0.734361 13.4394 0.0803623 10.9898 2.00374 10.9898L10.4936 10.9898C11.3663 10.9898 12.1382 10.424 12.4008 9.59177L14.9871 1.39799Z" fill="currentColor" />
                                                                </svg></label>

                                                            <input type="radio" name="professionalism" id="prof-3" value="3"><label for="prof-3"><svg xmlns="http://www.w3.org/2000/svg" width="34" height="33" viewBox="0 0 34 33">
                                                                    <path d="M14.9871 1.39799C15.5755 -0.466011 18.2133 -0.466007 18.8016 1.39799L21.3879 9.59177C21.6505 10.424 22.4225 10.9898 23.2951 10.9898L31.785 10.9898C33.7084 10.9898 34.5231 13.4394 32.9828 14.5914L26.0156 19.8022C25.3349 20.3113 25.0503 21.1952 25.3062 22.0058L27.9438 30.3621C28.5286 32.2149 26.3946 33.7294 24.8387 32.5657L18.0922 27.52C17.382 26.9888 16.4067 26.9888 15.6965 27.52L8.95006 32.5657C7.39412 33.7294 5.26012 32.2149 5.84496 30.3621L8.4825 22.0058C8.73837 21.1952 8.45385 20.3113 7.77311 19.8022L0.80589 14.5914C-0.734361 13.4394 0.0803623 10.9898 2.00374 10.9898L10.4936 10.9898C11.3663 10.9898 12.1382 10.424 12.4008 9.59177L14.9871 1.39799Z" fill="currentColor" />
                                                                </svg></label>

                                                            <input type="radio" name="professionalism" id="prof-2" value="2"><label for="prof-2"><svg xmlns="http://www.w3.org/2000/svg" width="34" height="33" viewBox="0 0 34 33">
                                                                    <path d="M14.9871 1.39799C15.5755 -0.466011 18.2133 -0.466007 18.8016 1.39799L21.3879 9.59177C21.6505 10.424 22.4225 10.9898 23.2951 10.9898L31.785 10.9898C33.7084 10.9898 34.5231 13.4394 32.9828 14.5914L26.0156 19.8022C25.3349 20.3113 25.0503 21.1952 25.3062 22.0058L27.9438 30.3621C28.5286 32.2149 26.3946 33.7294 24.8387 32.5657L18.0922 27.52C17.382 26.9888 16.4067 26.9888 15.6965 27.52L8.95006 32.5657C7.39412 33.7294 5.26012 32.2149 5.84496 30.3621L8.4825 22.0058C8.73837 21.1952 8.45385 20.3113 7.77311 19.8022L0.80589 14.5914C-0.734361 13.4394 0.0803623 10.9898 2.00374 10.9898L10.4936 10.9898C11.3663 10.9898 12.1382 10.424 12.4008 9.59177L14.9871 1.39799Z" fill="currentColor" />
                                                                </svg></label>

                                                            <input type="radio" name="professionalism" id="prof-1" value="1"><label for="prof-1"><svg xmlns="http://www.w3.org/2000/svg" width="34" height="33" viewBox="0 0 34 33">
                                                                    <path d="M14.9871 1.39799C15.5755 -0.466011 18.2133 -0.466007 18.8016 1.39799L21.3879 9.59177C21.6505 10.424 22.4225 10.9898 23.2951 10.9898L31.785 10.9898C33.7084 10.9898 34.5231 13.4394 32.9828 14.5914L26.0156 19.8022C25.3349 20.3113 25.0503 21.1952 25.3062 22.0058L27.9438 30.3621C28.5286 32.2149 26.3946 33.7294 24.8387 32.5657L18.0922 27.52C17.382 26.9888 16.4067 26.9888 15.6965 27.52L8.95006 32.5657C7.39412 33.7294 5.26012 32.2149 5.84496 30.3621L8.4825 22.0058C8.73837 21.1952 8.45385 20.3113 7.77311 19.8022L0.80589 14.5914C-0.734361 13.4394 0.0803623 10.9898 2.00374 10.9898L10.4936 10.9898C11.3663 10.9898 12.1382 10.424 12.4008 9.59177L14.9871 1.39799Z" fill="currentColor" />
                                                                </svg></label>

                                                        </div>
                                                    </div>

                                                    <div class="section-divider mt-2" style="border-top: 1px solid #E0E0E0"></div>

                                                    <div class="specific-row mt-2 d-flex align-items-center justify-content-between">
                                                        <span class="simple-font">Cleanlines</span>

                                                        <div class="stars rating-stars">

                                                            <input type="radio" name="cleanlines" id="cleanlines-5" value="5">
                                                            <label for="cleanlines-5">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="34" height="33" viewBox="0 0 34 33">
                                                                    <path d="M14.9871 1.39799C15.5755 -0.466011 18.2133 -0.466007 18.8016 1.39799L21.3879 9.59177C21.6505 10.424 22.4225 10.9898 23.2951 10.9898L31.785 10.9898C33.7084 10.9898 34.5231 13.4394 32.9828 14.5914L26.0156 19.8022C25.3349 20.3113 25.0503 21.1952 25.3062 22.0058L27.9438 30.3621C28.5286 32.2149 26.3946 33.7294 24.8387 32.5657L18.0922 27.52C17.382 26.9888 16.4067 26.9888 15.6965 27.52L8.95006 32.5657C7.39412 33.7294 5.26012 32.2149 5.84496 30.3621L8.4825 22.0058C8.73837 21.1952 8.45385 20.3113 7.77311 19.8022L0.80589 14.5914C-0.734361 13.4394 0.0803623 10.9898 2.00374 10.9898L10.4936 10.9898C11.3663 10.9898 12.1382 10.424 12.4008 9.59177L14.9871 1.39799Z" fill="currentColor" />
                                                                </svg>
                                                            </label>

                                                            <input type="radio" name="cleanlines" id="cleanlines-4" value="4"><label for="cleanlines-4"><svg xmlns="http://www.w3.org/2000/svg" width="34" height="33" viewBox="0 0 34 33">
                                                                    <path d="M14.9871 1.39799C15.5755 -0.466011 18.2133 -0.466007 18.8016 1.39799L21.3879 9.59177C21.6505 10.424 22.4225 10.9898 23.2951 10.9898L31.785 10.9898C33.7084 10.9898 34.5231 13.4394 32.9828 14.5914L26.0156 19.8022C25.3349 20.3113 25.0503 21.1952 25.3062 22.0058L27.9438 30.3621C28.5286 32.2149 26.3946 33.7294 24.8387 32.5657L18.0922 27.52C17.382 26.9888 16.4067 26.9888 15.6965 27.52L8.95006 32.5657C7.39412 33.7294 5.26012 32.2149 5.84496 30.3621L8.4825 22.0058C8.73837 21.1952 8.45385 20.3113 7.77311 19.8022L0.80589 14.5914C-0.734361 13.4394 0.0803623 10.9898 2.00374 10.9898L10.4936 10.9898C11.3663 10.9898 12.1382 10.424 12.4008 9.59177L14.9871 1.39799Z" fill="currentColor" />
                                                                </svg></label>

                                                            <input type="radio" name="cleanlines" id="cleanlines-3" value="3"><label for="cleanlines-3"><svg xmlns="http://www.w3.org/2000/svg" width="34" height="33" viewBox="0 0 34 33">
                                                                    <path d="M14.9871 1.39799C15.5755 -0.466011 18.2133 -0.466007 18.8016 1.39799L21.3879 9.59177C21.6505 10.424 22.4225 10.9898 23.2951 10.9898L31.785 10.9898C33.7084 10.9898 34.5231 13.4394 32.9828 14.5914L26.0156 19.8022C25.3349 20.3113 25.0503 21.1952 25.3062 22.0058L27.9438 30.3621C28.5286 32.2149 26.3946 33.7294 24.8387 32.5657L18.0922 27.52C17.382 26.9888 16.4067 26.9888 15.6965 27.52L8.95006 32.5657C7.39412 33.7294 5.26012 32.2149 5.84496 30.3621L8.4825 22.0058C8.73837 21.1952 8.45385 20.3113 7.77311 19.8022L0.80589 14.5914C-0.734361 13.4394 0.0803623 10.9898 2.00374 10.9898L10.4936 10.9898C11.3663 10.9898 12.1382 10.424 12.4008 9.59177L14.9871 1.39799Z" fill="currentColor" />
                                                                </svg></label>

                                                            <input type="radio" name="cleanlines" id="cleanlines-2" value="2"><label for="cleanlines-2"><svg xmlns="http://www.w3.org/2000/svg" width="34" height="33" viewBox="0 0 34 33">
                                                                    <path d="M14.9871 1.39799C15.5755 -0.466011 18.2133 -0.466007 18.8016 1.39799L21.3879 9.59177C21.6505 10.424 22.4225 10.9898 23.2951 10.9898L31.785 10.9898C33.7084 10.9898 34.5231 13.4394 32.9828 14.5914L26.0156 19.8022C25.3349 20.3113 25.0503 21.1952 25.3062 22.0058L27.9438 30.3621C28.5286 32.2149 26.3946 33.7294 24.8387 32.5657L18.0922 27.52C17.382 26.9888 16.4067 26.9888 15.6965 27.52L8.95006 32.5657C7.39412 33.7294 5.26012 32.2149 5.84496 30.3621L8.4825 22.0058C8.73837 21.1952 8.45385 20.3113 7.77311 19.8022L0.80589 14.5914C-0.734361 13.4394 0.0803623 10.9898 2.00374 10.9898L10.4936 10.9898C11.3663 10.9898 12.1382 10.424 12.4008 9.59177L14.9871 1.39799Z" fill="currentColor" />
                                                                </svg></label>

                                                            <input type="radio" name="cleanlines" id="cleanlines-1" value="1"><label for="cleanlines-1"><svg xmlns="http://www.w3.org/2000/svg" width="34" height="33" viewBox="0 0 34 33">
                                                                    <path d="M14.9871 1.39799C15.5755 -0.466011 18.2133 -0.466007 18.8016 1.39799L21.3879 9.59177C21.6505 10.424 22.4225 10.9898 23.2951 10.9898L31.785 10.9898C33.7084 10.9898 34.5231 13.4394 32.9828 14.5914L26.0156 19.8022C25.3349 20.3113 25.0503 21.1952 25.3062 22.0058L27.9438 30.3621C28.5286 32.2149 26.3946 33.7294 24.8387 32.5657L18.0922 27.52C17.382 26.9888 16.4067 26.9888 15.6965 27.52L8.95006 32.5657C7.39412 33.7294 5.26012 32.2149 5.84496 30.3621L8.4825 22.0058C8.73837 21.1952 8.45385 20.3113 7.77311 19.8022L0.80589 14.5914C-0.734361 13.4394 0.0803623 10.9898 2.00374 10.9898L10.4936 10.9898C11.3663 10.9898 12.1382 10.424 12.4008 9.59177L14.9871 1.39799Z" fill="currentColor" />
                                                                </svg></label>

                                                        </div>
                                                    </div>

                                                    <div class="section-divider mt-2" style="border-top: 1px solid #E0E0E0"></div>

                                                    <div class="specific-row mt-2 d-flex align-items-center justify-content-between">
                                                        <span class="simple-font">Quality</span>

                                                        <div class="stars rating-stars">

                                                            <input type="radio" name="quality" id="qual-5" value="5">
                                                            <label for="qual-5">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="34" height="33" viewBox="0 0 34 33">
                                                                    <path d="M14.9871 1.39799C15.5755 -0.466011 18.2133 -0.466007 18.8016 1.39799L21.3879 9.59177C21.6505 10.424 22.4225 10.9898 23.2951 10.9898L31.785 10.9898C33.7084 10.9898 34.5231 13.4394 32.9828 14.5914L26.0156 19.8022C25.3349 20.3113 25.0503 21.1952 25.3062 22.0058L27.9438 30.3621C28.5286 32.2149 26.3946 33.7294 24.8387 32.5657L18.0922 27.52C17.382 26.9888 16.4067 26.9888 15.6965 27.52L8.95006 32.5657C7.39412 33.7294 5.26012 32.2149 5.84496 30.3621L8.4825 22.0058C8.73837 21.1952 8.45385 20.3113 7.77311 19.8022L0.80589 14.5914C-0.734361 13.4394 0.0803623 10.9898 2.00374 10.9898L10.4936 10.9898C11.3663 10.9898 12.1382 10.424 12.4008 9.59177L14.9871 1.39799Z" fill="currentColor" />
                                                                </svg>
                                                            </label>

                                                            <input type="radio" name="quality" id="qual-4" value="4"><label for="qual-4"><svg xmlns="http://www.w3.org/2000/svg" width="34" height="33" viewBox="0 0 34 33">
                                                                    <path d="M14.9871 1.39799C15.5755 -0.466011 18.2133 -0.466007 18.8016 1.39799L21.3879 9.59177C21.6505 10.424 22.4225 10.9898 23.2951 10.9898L31.785 10.9898C33.7084 10.9898 34.5231 13.4394 32.9828 14.5914L26.0156 19.8022C25.3349 20.3113 25.0503 21.1952 25.3062 22.0058L27.9438 30.3621C28.5286 32.2149 26.3946 33.7294 24.8387 32.5657L18.0922 27.52C17.382 26.9888 16.4067 26.9888 15.6965 27.52L8.95006 32.5657C7.39412 33.7294 5.26012 32.2149 5.84496 30.3621L8.4825 22.0058C8.73837 21.1952 8.45385 20.3113 7.77311 19.8022L0.80589 14.5914C-0.734361 13.4394 0.0803623 10.9898 2.00374 10.9898L10.4936 10.9898C11.3663 10.9898 12.1382 10.424 12.4008 9.59177L14.9871 1.39799Z" fill="currentColor" />
                                                                </svg></label>

                                                            <input type="radio" name="quality" id="qual-3" value="3"><label for="qual-3"><svg xmlns="http://www.w3.org/2000/svg" width="34" height="33" viewBox="0 0 34 33">
                                                                    <path d="M14.9871 1.39799C15.5755 -0.466011 18.2133 -0.466007 18.8016 1.39799L21.3879 9.59177C21.6505 10.424 22.4225 10.9898 23.2951 10.9898L31.785 10.9898C33.7084 10.9898 34.5231 13.4394 32.9828 14.5914L26.0156 19.8022C25.3349 20.3113 25.0503 21.1952 25.3062 22.0058L27.9438 30.3621C28.5286 32.2149 26.3946 33.7294 24.8387 32.5657L18.0922 27.52C17.382 26.9888 16.4067 26.9888 15.6965 27.52L8.95006 32.5657C7.39412 33.7294 5.26012 32.2149 5.84496 30.3621L8.4825 22.0058C8.73837 21.1952 8.45385 20.3113 7.77311 19.8022L0.80589 14.5914C-0.734361 13.4394 0.0803623 10.9898 2.00374 10.9898L10.4936 10.9898C11.3663 10.9898 12.1382 10.424 12.4008 9.59177L14.9871 1.39799Z" fill="currentColor" />
                                                                </svg></label>

                                                            <input type="radio" name="quality" id="qual-2" value="2"><label for="qual-2"><svg xmlns="http://www.w3.org/2000/svg" width="34" height="33" viewBox="0 0 34 33">
                                                                    <path d="M14.9871 1.39799C15.5755 -0.466011 18.2133 -0.466007 18.8016 1.39799L21.3879 9.59177C21.6505 10.424 22.4225 10.9898 23.2951 10.9898L31.785 10.9898C33.7084 10.9898 34.5231 13.4394 32.9828 14.5914L26.0156 19.8022C25.3349 20.3113 25.0503 21.1952 25.3062 22.0058L27.9438 30.3621C28.5286 32.2149 26.3946 33.7294 24.8387 32.5657L18.0922 27.52C17.382 26.9888 16.4067 26.9888 15.6965 27.52L8.95006 32.5657C7.39412 33.7294 5.26012 32.2149 5.84496 30.3621L8.4825 22.0058C8.73837 21.1952 8.45385 20.3113 7.77311 19.8022L0.80589 14.5914C-0.734361 13.4394 0.0803623 10.9898 2.00374 10.9898L10.4936 10.9898C11.3663 10.9898 12.1382 10.424 12.4008 9.59177L14.9871 1.39799Z" fill="currentColor" />
                                                                </svg></label>

                                                            <input type="radio" name="quality" id="qual-1" value="1"><label for="qual-1"><svg xmlns="http://www.w3.org/2000/svg" width="34" height="33" viewBox="0 0 34 33">
                                                                    <path d="M14.9871 1.39799C15.5755 -0.466011 18.2133 -0.466007 18.8016 1.39799L21.3879 9.59177C21.6505 10.424 22.4225 10.9898 23.2951 10.9898L31.785 10.9898C33.7084 10.9898 34.5231 13.4394 32.9828 14.5914L26.0156 19.8022C25.3349 20.3113 25.0503 21.1952 25.3062 22.0058L27.9438 30.3621C28.5286 32.2149 26.3946 33.7294 24.8387 32.5657L18.0922 27.52C17.382 26.9888 16.4067 26.9888 15.6965 27.52L8.95006 32.5657C7.39412 33.7294 5.26012 32.2149 5.84496 30.3621L8.4825 22.0058C8.73837 21.1952 8.45385 20.3113 7.77311 19.8022L0.80589 14.5914C-0.734361 13.4394 0.0803623 10.9898 2.00374 10.9898L10.4936 10.9898C11.3663 10.9898 12.1382 10.424 12.4008 9.59177L14.9871 1.39799Z" fill="currentColor" />
                                                                </svg></label>

                                                        </div>
                                                    </div>

                                                    <div class="section-divider mt-2" style="border-top: 1px solid #E0E0E0"></div>

                                                    <div class="specific-row mt-2 d-flex align-items-center justify-content-between">
                                                        <span class="simple-font">Communication</span>

                                                        <div class="stars rating-stars">

                                                            <input type="radio" name="communication" id="comm-5" value="5"><label for="comm-5"><svg xmlns="http://www.w3.org/2000/svg" width="34" height="33" viewBox="0 0 34 33">
                                                                    <path d="M14.9871 1.39799C15.5755 -0.466011 18.2133 -0.466007 18.8016 1.39799L21.3879 9.59177C21.6505 10.424 22.4225 10.9898 23.2951 10.9898L31.785 10.9898C33.7084 10.9898 34.5231 13.4394 32.9828 14.5914L26.0156 19.8022C25.3349 20.3113 25.0503 21.1952 25.3062 22.0058L27.9438 30.3621C28.5286 32.2149 26.3946 33.7294 24.8387 32.5657L18.0922 27.52C17.382 26.9888 16.4067 26.9888 15.6965 27.52L8.95006 32.5657C7.39412 33.7294 5.26012 32.2149 5.84496 30.3621L8.4825 22.0058C8.73837 21.1952 8.45385 20.3113 7.77311 19.8022L0.80589 14.5914C-0.734361 13.4394 0.0803623 10.9898 2.00374 10.9898L10.4936 10.9898C11.3663 10.9898 12.1382 10.424 12.4008 9.59177L14.9871 1.39799Z" fill="currentColor" />
                                                                </svg></label>
                                                            <input type="radio" name="communication" id="comm-4" value="4"><label for="comm-4"><svg xmlns="http://www.w3.org/2000/svg" width="34" height="33" viewBox="0 0 34 33">
                                                                    <path d="M14.9871 1.39799C15.5755 -0.466011 18.2133 -0.466007 18.8016 1.39799L21.3879 9.59177C21.6505 10.424 22.4225 10.9898 23.2951 10.9898L31.785 10.9898C33.7084 10.9898 34.5231 13.4394 32.9828 14.5914L26.0156 19.8022C25.3349 20.3113 25.0503 21.1952 25.3062 22.0058L27.9438 30.3621C28.5286 32.2149 26.3946 33.7294 24.8387 32.5657L18.0922 27.52C17.382 26.9888 16.4067 26.9888 15.6965 27.52L8.95006 32.5657C7.39412 33.7294 5.26012 32.2149 5.84496 30.3621L8.4825 22.0058C8.73837 21.1952 8.45385 20.3113 7.77311 19.8022L0.80589 14.5914C-0.734361 13.4394 0.0803623 10.9898 2.00374 10.9898L10.4936 10.9898C11.3663 10.9898 12.1382 10.424 12.4008 9.59177L14.9871 1.39799Z" fill="currentColor" />
                                                                </svg></label>
                                                            <input type="radio" name="communication" id="comm-3" value="3"><label for="comm-3"><svg xmlns="http://www.w3.org/2000/svg" width="34" height="33" viewBox="0 0 34 33">
                                                                    <path d="M14.9871 1.39799C15.5755 -0.466011 18.2133 -0.466007 18.8016 1.39799L21.3879 9.59177C21.6505 10.424 22.4225 10.9898 23.2951 10.9898L31.785 10.9898C33.7084 10.9898 34.5231 13.4394 32.9828 14.5914L26.0156 19.8022C25.3349 20.3113 25.0503 21.1952 25.3062 22.0058L27.9438 30.3621C28.5286 32.2149 26.3946 33.7294 24.8387 32.5657L18.0922 27.52C17.382 26.9888 16.4067 26.9888 15.6965 27.52L8.95006 32.5657C7.39412 33.7294 5.26012 32.2149 5.84496 30.3621L8.4825 22.0058C8.73837 21.1952 8.45385 20.3113 7.77311 19.8022L0.80589 14.5914C-0.734361 13.4394 0.0803623 10.9898 2.00374 10.9898L10.4936 10.9898C11.3663 10.9898 12.1382 10.424 12.4008 9.59177L14.9871 1.39799Z" fill="currentColor" />
                                                                </svg></label>
                                                            <input type="radio" name="communication" id="comm-2" value="2"><label for="comm-2"><svg xmlns="http://www.w3.org/2000/svg" width="34" height="33" viewBox="0 0 34 33">
                                                                    <path d="M14.9871 1.39799C15.5755 -0.466011 18.2133 -0.466007 18.8016 1.39799L21.3879 9.59177C21.6505 10.424 22.4225 10.9898 23.2951 10.9898L31.785 10.9898C33.7084 10.9898 34.5231 13.4394 32.9828 14.5914L26.0156 19.8022C25.3349 20.3113 25.0503 21.1952 25.3062 22.0058L27.9438 30.3621C28.5286 32.2149 26.3946 33.7294 24.8387 32.5657L18.0922 27.52C17.382 26.9888 16.4067 26.9888 15.6965 27.52L8.95006 32.5657C7.39412 33.7294 5.26012 32.2149 5.84496 30.3621L8.4825 22.0058C8.73837 21.1952 8.45385 20.3113 7.77311 19.8022L0.80589 14.5914C-0.734361 13.4394 0.0803623 10.9898 2.00374 10.9898L10.4936 10.9898C11.3663 10.9898 12.1382 10.424 12.4008 9.59177L14.9871 1.39799Z" fill="currentColor" />
                                                                </svg></label>
                                                            <input type="radio" name="communication" id="comm-1" value="1"><label for="comm-1"><svg xmlns="http://www.w3.org/2000/svg" width="34" height="33" viewBox="0 0 34 33">
                                                                    <path d="M14.9871 1.39799C15.5755 -0.466011 18.2133 -0.466007 18.8016 1.39799L21.3879 9.59177C21.6505 10.424 22.4225 10.9898 23.2951 10.9898L31.785 10.9898C33.7084 10.9898 34.5231 13.4394 32.9828 14.5914L26.0156 19.8022C25.3349 20.3113 25.0503 21.1952 25.3062 22.0058L27.9438 30.3621C28.5286 32.2149 26.3946 33.7294 24.8387 32.5657L18.0922 27.52C17.382 26.9888 16.4067 26.9888 15.6965 27.52L8.95006 32.5657C7.39412 33.7294 5.26012 32.2149 5.84496 30.3621L8.4825 22.0058C8.73837 21.1952 8.45385 20.3113 7.77311 19.8022L0.80589 14.5914C-0.734361 13.4394 0.0803623 10.9898 2.00374 10.9898L10.4936 10.9898C11.3663 10.9898 12.1382 10.424 12.4008 9.59177L14.9871 1.39799Z" fill="currentColor" />
                                                                </svg></label>

                                                        </div>
                                                    </div>

                                                    <div class="section-divider mt-2" style="border-top: 1px solid #E0E0E0"></div>

                                                    <div class="review-text-section mt-5">
                                                        <h4 class="review-text-title normal-font-bold">Your Review</h4>
                                                        <textarea class="simple-font mt-4" placeholder="Tell others what you liked or what could be improved."></textarea>
                                                    </div>

                                                    <div class="photos-section mt-5 mb-5">
                                                        <h4 class="photos-section-title normal-font-bold">Add Photos <span class="optional normal-light-color">(Optional)</span></h4>
                                                        <p class="sub-text simple-light-font">Photos help others understand your experience.</p>

                                                        <div class="upload-flex d-flex align-items-center justify-content-between gap-20 mt-4">

                                                            <div class="upload-box" data-index="1">


                                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 14 14" fill="none">
                                                                    <path d="M7 10.3163C6.72386 10.3163 6.5 10.0924 6.5 9.81626V1.66626L4.52903 3.63722C4.33115 3.8351 4.00998 3.83398 3.81349 3.63471C3.61896 3.43744 3.62005 3.12016 3.81593 2.92422L6.55492 0.184464C6.80072 -0.0614062 7.19931 -0.0614344 7.44514 0.184402L10.185 2.92425C10.3809 3.1202 10.3822 3.43753 10.1877 3.63499C9.99116 3.83461 9.66959 3.83585 9.47149 3.63775L7.5 1.66626V9.81626C7.5 10.0924 7.27614 10.3163 7 10.3163ZM1.616 13.7393C1.15533 13.7393 0.771 13.5853 0.463 13.2773C0.155 12.9693 0.000666667 12.5846 0 12.1233V10.2003C0 9.92412 0.223858 9.70026 0.5 9.70026C0.776142 9.70026 1 9.92412 1 10.2003V12.1233C1 12.2773 1.064 12.4186 1.192 12.5473C1.32 12.6759 1.461 12.7399 1.615 12.7393H12.385C12.5383 12.7393 12.6793 12.6753 12.808 12.5473C12.9367 12.4193 13.0007 12.2779 13 12.1233V10.2003C13 9.92412 13.2239 9.70026 13.5 9.70026C13.7761 9.70026 14 9.92412 14 10.2003V12.1233C14 12.5839 13.846 12.9683 13.538 13.2763C13.23 13.5843 12.8453 13.7386 12.384 13.7393H1.616Z" fill="#9D9B98" />
                                                                </svg>

                                                                <div class="preview-container" style="display:none;"></div>

                                                                <!-- hidden input + accessible label -->
                                                                <input class="file-input" type="file" name="photo1" id="file-1" accept="image/*" style="display:none" aria-label="Upload photo 1">
                                                                <button type="button" class="upload-btn" aria-controls="file-1">
                                                                    Add Photo
                                                                </button>
                                                                <button type="button" class="delete-btn" style="display:none;">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="11" height="12" viewBox="0 0 8 9" fill="none">
                                                                        <path d="M1.5 9C1.225 9 0.989668 8.90217 0.794001 8.7065C0.598335 8.51083 0.500335 8.27533 0.500001 8V1.5C0.358335 1.5 0.239668 1.452 0.144002 1.356C0.0483351 1.26 0.000335057 1.14133 1.72414e-06 1C-0.000331609 0.858667 0.0476684 0.74 0.144002 0.644C0.240335 0.548 0.359002 0.5 0.500001 0.5H2.5C2.5 0.358333 2.548 0.239667 2.644 0.144C2.74 0.0483334 2.85867 0.000333333 3 0H5C5.14167 0 5.2605 0.048 5.3565 0.144C5.4525 0.24 5.50033 0.358667 5.5 0.5H7.5C7.64166 0.5 7.7605 0.548 7.8565 0.644C7.9525 0.74 8.00033 0.858667 8 1C7.99966 1.14133 7.95166 1.26017 7.856 1.3565C7.76033 1.45283 7.64166 1.50067 7.5 1.5V8C7.5 8.275 7.40216 8.5105 7.2065 8.7065C7.01083 8.9025 6.77533 9.00033 6.5 9H1.5ZM3 7C3.14167 7 3.2605 6.952 3.3565 6.856C3.4525 6.76 3.50033 6.64133 3.5 6.5V3C3.5 2.85833 3.452 2.73967 3.356 2.644C3.26 2.54833 3.14133 2.50033 3 2.5C2.85867 2.49967 2.74 2.54767 2.644 2.644C2.548 2.74033 2.5 2.859 2.5 3V6.5C2.5 6.64167 2.548 6.7605 2.644 6.8565C2.74 6.9525 2.85867 7.00033 3 7ZM5 7C5.14167 7 5.2605 6.952 5.3565 6.856C5.4525 6.76 5.50033 6.64133 5.5 6.5V3C5.5 2.85833 5.452 2.73967 5.356 2.644C5.26 2.54833 5.14133 2.50033 5 2.5C4.85867 2.49967 4.74 2.54767 4.644 2.644C4.548 2.74033 4.5 2.859 4.5 3V6.5C4.5 6.64167 4.548 6.7605 4.644 6.8565C4.74 6.9525 4.85867 7.00033 5 7Z" fill="white" />
                                                                    </svg>
                                                                </button>

                                                            </div>

                                                            <!-- Upload Box 2 -->
                                                            <div class="upload-box" data-index="2">


                                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 14 14" fill="none">
                                                                    <path d="M7 10.3163C6.72386 10.3163 6.5 10.0924 6.5 9.81626V1.66626L4.52903 3.63722C4.33115 3.8351 4.00998 3.83398 3.81349 3.63471C3.61896 3.43744 3.62005 3.12016 3.81593 2.92422L6.55492 0.184464C6.80072 -0.0614062 7.19931 -0.0614344 7.44514 0.184402L10.185 2.92425C10.3809 3.1202 10.3822 3.43753 10.1877 3.63499C9.99116 3.83461 9.66959 3.83585 9.47149 3.63775L7.5 1.66626V9.81626C7.5 10.0924 7.27614 10.3163 7 10.3163ZM1.616 13.7393C1.15533 13.7393 0.771 13.5853 0.463 13.2773C0.155 12.9693 0.000666667 12.5846 0 12.1233V10.2003C0 9.92412 0.223858 9.70026 0.5 9.70026C0.776142 9.70026 1 9.92412 1 10.2003V12.1233C1 12.2773 1.064 12.4186 1.192 12.5473C1.32 12.6759 1.461 12.7399 1.615 12.7393H12.385C12.5383 12.7393 12.6793 12.6753 12.808 12.5473C12.9367 12.4193 13.0007 12.2779 13 12.1233V10.2003C13 9.92412 13.2239 9.70026 13.5 9.70026C13.7761 9.70026 14 9.92412 14 10.2003V12.1233C14 12.5839 13.846 12.9683 13.538 13.2763C13.23 13.5843 12.8453 13.7386 12.384 13.7393H1.616Z" fill="#9D9B98" />
                                                                </svg>

                                                                <div class="preview-container" style="display:none;"></div>

                                                                <!-- hidden input + accessible label -->
                                                                <input class="file-input" type="file" name="photo1" id="file-1" accept="image/*" style="display:none" aria-label="Upload photo 1">
                                                                <button type="button" class="upload-btn" aria-controls="file-1">
                                                                    Add Photo
                                                                </button>
                                                                <button type="button" class="delete-btn" style="display:none;">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="11" height="12" viewBox="0 0 8 9" fill="none">
                                                                        <path d="M1.5 9C1.225 9 0.989668 8.90217 0.794001 8.7065C0.598335 8.51083 0.500335 8.27533 0.500001 8V1.5C0.358335 1.5 0.239668 1.452 0.144002 1.356C0.0483351 1.26 0.000335057 1.14133 1.72414e-06 1C-0.000331609 0.858667 0.0476684 0.74 0.144002 0.644C0.240335 0.548 0.359002 0.5 0.500001 0.5H2.5C2.5 0.358333 2.548 0.239667 2.644 0.144C2.74 0.0483334 2.85867 0.000333333 3 0H5C5.14167 0 5.2605 0.048 5.3565 0.144C5.4525 0.24 5.50033 0.358667 5.5 0.5H7.5C7.64166 0.5 7.7605 0.548 7.8565 0.644C7.9525 0.74 8.00033 0.858667 8 1C7.99966 1.14133 7.95166 1.26017 7.856 1.3565C7.76033 1.45283 7.64166 1.50067 7.5 1.5V8C7.5 8.275 7.40216 8.5105 7.2065 8.7065C7.01083 8.9025 6.77533 9.00033 6.5 9H1.5ZM3 7C3.14167 7 3.2605 6.952 3.3565 6.856C3.4525 6.76 3.50033 6.64133 3.5 6.5V3C3.5 2.85833 3.452 2.73967 3.356 2.644C3.26 2.54833 3.14133 2.50033 3 2.5C2.85867 2.49967 2.74 2.54767 2.644 2.644C2.548 2.74033 2.5 2.859 2.5 3V6.5C2.5 6.64167 2.548 6.7605 2.644 6.8565C2.74 6.9525 2.85867 7.00033 3 7ZM5 7C5.14167 7 5.2605 6.952 5.3565 6.856C5.4525 6.76 5.50033 6.64133 5.5 6.5V3C5.5 2.85833 5.452 2.73967 5.356 2.644C5.26 2.54833 5.14133 2.50033 5 2.5C4.85867 2.49967 4.74 2.54767 4.644 2.644C4.548 2.74033 4.5 2.859 4.5 3V6.5C4.5 6.64167 4.548 6.7605 4.644 6.8565C4.74 6.9525 4.85867 7.00033 5 7Z" fill="white" />
                                                                    </svg>
                                                                </button>

                                                            </div>

                                                            <!-- Upload Box 3 -->
                                                            <div class="upload-box" data-index="3">


                                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 14 14" fill="none">
                                                                    <path d="M7 10.3163C6.72386 10.3163 6.5 10.0924 6.5 9.81626V1.66626L4.52903 3.63722C4.33115 3.8351 4.00998 3.83398 3.81349 3.63471C3.61896 3.43744 3.62005 3.12016 3.81593 2.92422L6.55492 0.184464C6.80072 -0.0614062 7.19931 -0.0614344 7.44514 0.184402L10.185 2.92425C10.3809 3.1202 10.3822 3.43753 10.1877 3.63499C9.99116 3.83461 9.66959 3.83585 9.47149 3.63775L7.5 1.66626V9.81626C7.5 10.0924 7.27614 10.3163 7 10.3163ZM1.616 13.7393C1.15533 13.7393 0.771 13.5853 0.463 13.2773C0.155 12.9693 0.000666667 12.5846 0 12.1233V10.2003C0 9.92412 0.223858 9.70026 0.5 9.70026C0.776142 9.70026 1 9.92412 1 10.2003V12.1233C1 12.2773 1.064 12.4186 1.192 12.5473C1.32 12.6759 1.461 12.7399 1.615 12.7393H12.385C12.5383 12.7393 12.6793 12.6753 12.808 12.5473C12.9367 12.4193 13.0007 12.2779 13 12.1233V10.2003C13 9.92412 13.2239 9.70026 13.5 9.70026C13.7761 9.70026 14 9.92412 14 10.2003V12.1233C14 12.5839 13.846 12.9683 13.538 13.2763C13.23 13.5843 12.8453 13.7386 12.384 13.7393H1.616Z" fill="#9D9B98" />
                                                                </svg>

                                                                <div class="preview-container" style="display:none;"></div>

                                                                <!-- hidden input + accessible label -->
                                                                <input class="file-input" type="file" name="photo1" id="file-1" accept="image/*" style="display:none" aria-label="Upload photo 1">
                                                                <button type="button" class="upload-btn" aria-controls="file-1">
                                                                    Add Photo
                                                                </button>
                                                                <button type="button" class="delete-btn" style="display:none;">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="11" height="12" viewBox="0 0 8 9" fill="none">
                                                                        <path d="M1.5 9C1.225 9 0.989668 8.90217 0.794001 8.7065C0.598335 8.51083 0.500335 8.27533 0.500001 8V1.5C0.358335 1.5 0.239668 1.452 0.144002 1.356C0.0483351 1.26 0.000335057 1.14133 1.72414e-06 1C-0.000331609 0.858667 0.0476684 0.74 0.144002 0.644C0.240335 0.548 0.359002 0.5 0.500001 0.5H2.5C2.5 0.358333 2.548 0.239667 2.644 0.144C2.74 0.0483334 2.85867 0.000333333 3 0H5C5.14167 0 5.2605 0.048 5.3565 0.144C5.4525 0.24 5.50033 0.358667 5.5 0.5H7.5C7.64166 0.5 7.7605 0.548 7.8565 0.644C7.9525 0.74 8.00033 0.858667 8 1C7.99966 1.14133 7.95166 1.26017 7.856 1.3565C7.76033 1.45283 7.64166 1.50067 7.5 1.5V8C7.5 8.275 7.40216 8.5105 7.2065 8.7065C7.01083 8.9025 6.77533 9.00033 6.5 9H1.5ZM3 7C3.14167 7 3.2605 6.952 3.3565 6.856C3.4525 6.76 3.50033 6.64133 3.5 6.5V3C3.5 2.85833 3.452 2.73967 3.356 2.644C3.26 2.54833 3.14133 2.50033 3 2.5C2.85867 2.49967 2.74 2.54767 2.644 2.644C2.548 2.74033 2.5 2.859 2.5 3V6.5C2.5 6.64167 2.548 6.7605 2.644 6.8565C2.74 6.9525 2.85867 7.00033 3 7ZM5 7C5.14167 7 5.2605 6.952 5.3565 6.856C5.4525 6.76 5.50033 6.64133 5.5 6.5V3C5.5 2.85833 5.452 2.73967 5.356 2.644C5.26 2.54833 5.14133 2.50033 5 2.5C4.85867 2.49967 4.74 2.54767 4.644 2.644C4.548 2.74033 4.5 2.859 4.5 3V6.5C4.5 6.64167 4.548 6.7605 4.644 6.8565C4.74 6.9525 4.85867 7.00033 5 7Z" fill="white" />
                                                                    </svg>
                                                                </button>

                                                            </div>

                                                            <!-- Upload Box 4 -->
                                                            <div class="upload-box" data-index="4">


                                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 14 14" fill="none">
                                                                    <path d="M7 10.3163C6.72386 10.3163 6.5 10.0924 6.5 9.81626V1.66626L4.52903 3.63722C4.33115 3.8351 4.00998 3.83398 3.81349 3.63471C3.61896 3.43744 3.62005 3.12016 3.81593 2.92422L6.55492 0.184464C6.80072 -0.0614062 7.19931 -0.0614344 7.44514 0.184402L10.185 2.92425C10.3809 3.1202 10.3822 3.43753 10.1877 3.63499C9.99116 3.83461 9.66959 3.83585 9.47149 3.63775L7.5 1.66626V9.81626C7.5 10.0924 7.27614 10.3163 7 10.3163ZM1.616 13.7393C1.15533 13.7393 0.771 13.5853 0.463 13.2773C0.155 12.9693 0.000666667 12.5846 0 12.1233V10.2003C0 9.92412 0.223858 9.70026 0.5 9.70026C0.776142 9.70026 1 9.92412 1 10.2003V12.1233C1 12.2773 1.064 12.4186 1.192 12.5473C1.32 12.6759 1.461 12.7399 1.615 12.7393H12.385C12.5383 12.7393 12.6793 12.6753 12.808 12.5473C12.9367 12.4193 13.0007 12.2779 13 12.1233V10.2003C13 9.92412 13.2239 9.70026 13.5 9.70026C13.7761 9.70026 14 9.92412 14 10.2003V12.1233C14 12.5839 13.846 12.9683 13.538 13.2763C13.23 13.5843 12.8453 13.7386 12.384 13.7393H1.616Z" fill="#9D9B98" />
                                                                </svg>

                                                                <div class="preview-container" style="display:none;"></div>

                                                                <!-- hidden input + accessible label -->
                                                                <input class="file-input" type="file" name="photo1" id="file-1" accept="image/*" style="display:none" aria-label="Upload photo 1">
                                                                <button type="button" class="upload-btn" aria-controls="file-1">
                                                                    Add Photo
                                                                </button>
                                                                <button type="button" class="delete-btn" style="display:none;">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="11" height="12" viewBox="0 0 8 9" fill="none">
                                                                        <path d="M1.5 9C1.225 9 0.989668 8.90217 0.794001 8.7065C0.598335 8.51083 0.500335 8.27533 0.500001 8V1.5C0.358335 1.5 0.239668 1.452 0.144002 1.356C0.0483351 1.26 0.000335057 1.14133 1.72414e-06 1C-0.000331609 0.858667 0.0476684 0.74 0.144002 0.644C0.240335 0.548 0.359002 0.5 0.500001 0.5H2.5C2.5 0.358333 2.548 0.239667 2.644 0.144C2.74 0.0483334 2.85867 0.000333333 3 0H5C5.14167 0 5.2605 0.048 5.3565 0.144C5.4525 0.24 5.50033 0.358667 5.5 0.5H7.5C7.64166 0.5 7.7605 0.548 7.8565 0.644C7.9525 0.74 8.00033 0.858667 8 1C7.99966 1.14133 7.95166 1.26017 7.856 1.3565C7.76033 1.45283 7.64166 1.50067 7.5 1.5V8C7.5 8.275 7.40216 8.5105 7.2065 8.7065C7.01083 8.9025 6.77533 9.00033 6.5 9H1.5ZM3 7C3.14167 7 3.2605 6.952 3.3565 6.856C3.4525 6.76 3.50033 6.64133 3.5 6.5V3C3.5 2.85833 3.452 2.73967 3.356 2.644C3.26 2.54833 3.14133 2.50033 3 2.5C2.85867 2.49967 2.74 2.54767 2.644 2.644C2.548 2.74033 2.5 2.859 2.5 3V6.5C2.5 6.64167 2.548 6.7605 2.644 6.8565C2.74 6.9525 2.85867 7.00033 3 7ZM5 7C5.14167 7 5.2605 6.952 5.3565 6.856C5.4525 6.76 5.50033 6.64133 5.5 6.5V3C5.5 2.85833 5.452 2.73967 5.356 2.644C5.26 2.54833 5.14133 2.50033 5 2.5C4.85867 2.49967 4.74 2.54767 4.644 2.644C4.548 2.74033 4.5 2.859 4.5 3V6.5C4.5 6.64167 4.548 6.7605 4.644 6.8565C4.74 6.9525 4.85867 7.00033 5 7Z" fill="white" />
                                                                    </svg>
                                                                </button>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="section-divider mt-2" style="border-top: 1px solid #E0E0E0"></div>

                                                    <div class="footer-actions">


                                                        <div class="anonymous-section">
                                                            <label class="custom-checkbox-container">
                                                                <input type="checkbox">
                                                                <span class="circle-check"></span>
                                                                <span class="label-text normal-font-bold">Post Annonymously</span>
                                                            </label>
                                                        </div>
                                                        <div>
                                                            <button class="footer-btn-cancel medium-font-bold">Cancel</button>
                                                            <button class="footer-btn-submit medium-font-bold">Submit Review</button>
                                                        </div>

                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Review Modal  -->


                            <button data-modal-open="review-submitted-modal" style="display: none;">Review Submitted</button>

                            <!-- Review submitted Modal  -->

                            <div class="modal" id="review-submitted-modal">
                                <div class="modal-content size">
                                    <div class="container">
                                        <div class="row mt-4">
                                            <!-- <div class="col-lg-1"></div> -->
                                            <div class="col-lg-12">
                                                <div class="d-flex justify-content-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="75" height="75" viewBox="0 0 75 75" fill="none">
                                                        <circle cx="37.5" cy="37.5" r="36.5" fill="#D8E8B7" stroke="#B5CA89" stroke-width="2" />
                                                        <path d="M24.5 37.75L33.1667 46.5L50.5 29" stroke="#B5CA89" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                                    </svg>

                                                    <div data-modal-close class="position-absolute top-0 end-0 review-submitted-close">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 36 36" fill="none">
                                                            <circle cx="18" cy="18" r="17.5" stroke="#3B3731" />
                                                            <path d="M12.8 24.0008L24 12.8008M12.8 12.8008L24 24.0008" stroke="#3B3731" stroke-width="1.5" stroke-linecap="round" />
                                                        </svg>
                                                    </div>
                                                    <style>
                                                        #review-submitted-modal .review-submitted-close {
                                                            position: absolute;
                                                            right: 50px;
                                                            cursor: pointer;
                                                        }
                                                    </style>
                                                </div>
                                            </div>
                                            <!-- <div class="col-lg-1">
                                            
                                        </div> -->
                                            <div class="col-lg-12" style="padding: 15px 35px;">

                                                <div class="modal-head d-flex flex-column align-items-center justify-content-center">
                                                    <h1 class="large-font line-default">Review submitted!</h1>
                                                    <h3 class="normal-light-color mt-2 text-center">Your feedback helps other pet owners find groomers they can trust.</h3>
                                                </div>

                                                <p class="text-center fs-16-600 mt-4">4 out of 5 stars</p>
                                                <div class="stars d-flex align-items-center justify-content-center gap-20 mt-4">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="34" height="33" viewBox="0 0 34 33" fill="none">
                                                        <path d="M14.9871 1.39799C15.5755 -0.466011 18.2133 -0.466007 18.8016 1.39799L21.3879 9.59177C21.6505 10.424 22.4225 10.9898 23.2951 10.9898L31.785 10.9898C33.7084 10.9898 34.5231 13.4394 32.9828 14.5914L26.0156 19.8022C25.3349 20.3113 25.0503 21.1952 25.3062 22.0058L27.9438 30.3621C28.5286 32.2149 26.3946 33.7294 24.8387 32.5657L18.0922 27.52C17.382 26.9888 16.4067 26.9888 15.6965 27.52L8.95006 32.5657C7.39412 33.7294 5.26012 32.2149 5.84496 30.3621L8.4825 22.0058C8.73837 21.1952 8.45385 20.3113 7.77311 19.8022L0.80589 14.5914C-0.734361 13.4394 0.0803623 10.9898 2.00374 10.9898L10.4936 10.9898C11.3663 10.9898 12.1382 10.424 12.4008 9.59177L14.9871 1.39799Z" fill="#FFC97A" />
                                                    </svg>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="34" height="33" viewBox="0 0 34 33" fill="none">
                                                        <path d="M14.9871 1.39799C15.5755 -0.466011 18.2133 -0.466007 18.8016 1.39799L21.3879 9.59177C21.6505 10.424 22.4225 10.9898 23.2951 10.9898L31.785 10.9898C33.7084 10.9898 34.5231 13.4394 32.9828 14.5914L26.0156 19.8022C25.3349 20.3113 25.0503 21.1952 25.3062 22.0058L27.9438 30.3621C28.5286 32.2149 26.3946 33.7294 24.8387 32.5657L18.0922 27.52C17.382 26.9888 16.4067 26.9888 15.6965 27.52L8.95006 32.5657C7.39412 33.7294 5.26012 32.2149 5.84496 30.3621L8.4825 22.0058C8.73837 21.1952 8.45385 20.3113 7.77311 19.8022L0.80589 14.5914C-0.734361 13.4394 0.0803623 10.9898 2.00374 10.9898L10.4936 10.9898C11.3663 10.9898 12.1382 10.424 12.4008 9.59177L14.9871 1.39799Z" fill="#FFC97A" />
                                                    </svg>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="34" height="33" viewBox="0 0 34 33" fill="none">
                                                        <path d="M14.9871 1.39799C15.5755 -0.466011 18.2133 -0.466007 18.8016 1.39799L21.3879 9.59177C21.6505 10.424 22.4225 10.9898 23.2951 10.9898L31.785 10.9898C33.7084 10.9898 34.5231 13.4394 32.9828 14.5914L26.0156 19.8022C25.3349 20.3113 25.0503 21.1952 25.3062 22.0058L27.9438 30.3621C28.5286 32.2149 26.3946 33.7294 24.8387 32.5657L18.0922 27.52C17.382 26.9888 16.4067 26.9888 15.6965 27.52L8.95006 32.5657C7.39412 33.7294 5.26012 32.2149 5.84496 30.3621L8.4825 22.0058C8.73837 21.1952 8.45385 20.3113 7.77311 19.8022L0.80589 14.5914C-0.734361 13.4394 0.0803623 10.9898 2.00374 10.9898L10.4936 10.9898C11.3663 10.9898 12.1382 10.424 12.4008 9.59177L14.9871 1.39799Z" fill="#FFC97A" />
                                                    </svg>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="34" height="33" viewBox="0 0 34 33" fill="none">
                                                        <path d="M14.9871 1.39799C15.5755 -0.466011 18.2133 -0.466007 18.8016 1.39799L21.3879 9.59177C21.6505 10.424 22.4225 10.9898 23.2951 10.9898L31.785 10.9898C33.7084 10.9898 34.5231 13.4394 32.9828 14.5914L26.0156 19.8022C25.3349 20.3113 25.0503 21.1952 25.3062 22.0058L27.9438 30.3621C28.5286 32.2149 26.3946 33.7294 24.8387 32.5657L18.0922 27.52C17.382 26.9888 16.4067 26.9888 15.6965 27.52L8.95006 32.5657C7.39412 33.7294 5.26012 32.2149 5.84496 30.3621L8.4825 22.0058C8.73837 21.1952 8.45385 20.3113 7.77311 19.8022L0.80589 14.5914C-0.734361 13.4394 0.0803623 10.9898 2.00374 10.9898L10.4936 10.9898C11.3663 10.9898 12.1382 10.424 12.4008 9.59177L14.9871 1.39799Z" fill="#FFC97A" />
                                                    </svg>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="34" height="33" viewBox="0 0 34 33" fill="none">
                                                        <path d="M14.9874 1.39799C15.5757 -0.466011 18.2135 -0.466007 18.8018 1.39799L21.3881 9.59177C21.6508 10.424 22.4227 10.9898 23.2954 10.9898L31.7852 10.9898C33.7086 10.9898 34.5233 13.4394 32.9831 14.5914L26.0158 19.8022C25.3351 20.3113 25.0506 21.1952 25.3065 22.0058L27.944 30.3621C28.5288 32.2149 26.3948 33.7294 24.8389 32.5657L18.0925 27.52C17.3822 26.9888 16.407 26.9888 15.6967 27.52L8.9503 32.5657C7.39436 33.7294 5.26036 32.2149 5.8452 30.3621L8.48275 22.0058C8.73862 21.1952 8.45409 20.3113 7.77335 19.8022L0.806134 14.5914C-0.734117 13.4394 0.0806065 10.9898 2.00399 10.9898L10.4938 10.9898C11.3665 10.9898 12.1384 10.424 12.4011 9.59177L14.9874 1.39799Z" fill="#EFEFEF" />
                                                    </svg>
                                                </div>

                                                <div class="review-profile-section d-flex align-items-center gap-25 mt-5">
                                                    <div class="avatar-wrap">
                                                        <img class="avatar" src="<?= BASE_URL ?>assets/images/groomer-profile.png" alt="Sarah's avatar">
                                                        <div class="badge-shield" title="Verified">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="33" viewBox="0 0 30 33" fill="none">
                                                                <ellipse cx="15.873" cy="16.5256" rx="9.3645" ry="8.81365" fill="white"></ellipse>
                                                                <path d="M15.44 0.185076C15.1841 0.0638192 14.9099 0 14.6235 0C14.3372 0 14.063 0.0638192 13.8071 0.185076L2.3337 5.28423C0.993208 5.87775 -0.00606541 7.26263 2.77146e-05 8.93469C0.0304934 15.2656 2.51649 26.8487 13.015 32.1138C14.0325 32.6244 15.2146 32.6244 16.2321 32.1138C26.7306 26.8487 29.2166 15.2656 29.247 8.93469C29.2531 7.26263 28.2539 5.87775 26.9134 5.28423L15.44 0.185076ZM8.82897 18.2651C9.12144 18.3416 9.43219 18.3799 9.74903 18.3799C11.8999 18.3799 13.6486 16.5483 13.6486 14.2955V10.2111H16.3418C17.0791 10.2111 17.7554 10.645 18.0844 11.3407L18.5231 12.2533H22.4227C22.9589 12.2533 23.3976 12.7128 23.3976 13.2744V15.3166C23.3976 18.1374 21.2163 20.4222 18.5231 20.4222H15.5984V23.6578C15.5984 24.1237 15.2389 24.5066 14.7881 24.5066C14.6784 24.5066 14.5687 24.4811 14.4712 24.4364L8.45729 21.7368C8.05514 21.5581 7.79923 21.1433 7.79923 20.6902C7.79923 20.5115 7.83579 20.3392 7.915 20.1796L8.82897 18.2651ZM8.77413 10.2111H11.6988V14.2955C11.6988 15.4251 10.8275 16.3377 9.74903 16.3377C8.67055 16.3377 7.79923 15.4251 7.79923 14.2955V11.2322C7.79923 10.6706 8.23794 10.2111 8.77413 10.2111ZM16.5733 13.2744C16.5733 13.0036 16.4706 12.7439 16.2878 12.5524C16.105 12.3609 15.857 12.2533 15.5984 12.2533C15.3399 12.2533 15.0919 12.3609 14.9091 12.5524C14.7262 12.7439 14.6235 13.0036 14.6235 13.2744C14.6235 13.5452 14.7262 13.8049 14.9091 13.9964C15.0919 14.1879 15.3399 14.2955 15.5984 14.2955C15.857 14.2955 16.105 14.1879 16.2878 13.9964C16.4706 13.8049 16.5733 13.5452 16.5733 13.2744Z" fill="#C9DDA0"></path>
                                                            </svg>
                                                        </div>
                                                    </div>
                                                    <div class="review-details d-flex flex-column gap-15">
                                                        <div class="review-info-details">
                                                            <div class="review-info d-flex justify-content-between">
                                                                <div>
                                                                    <h3 class="review-name normal-font-bold">Sarah's Grooming Studio</h3>
                                                                    <p class="review-studio-name normal-light-color ">Cathy P.</p>
                                                                </div>
                                                                <div class="review-page-tags">
                                                                    <span class="review-page-tag">Home Visit</span>
                                                                </div>
                                                            </div>
                                                            <div class="review-info-row d-flex align-items-center gap-25 mt-3">
                                                                <div class="d-flex align-items-center gap-10">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="17" viewBox="0 0 16 17" fill="none">
                                                                        <path d="M4.94591 11.5544C6.23114 12.8397 9.35699 11.798 11.9274 9.22713C14.4983 6.65667 15.54 3.53082 14.2548 2.24559M8.72754 1.37259L9.30927 1.95473M6.6915 3.40904L7.27322 3.99077M4.9455 5.73636L5.52722 6.31809M4.36377 8.6454L4.9455 9.22713M11.9274 0.5L12.5092 1.08173M11.3457 3.99118L12.5092 5.15463M9.30968 6.02763L10.4731 7.19109M6.98236 7.77281L8.14581 8.93627" stroke="#3B3731" stroke-linecap="round" stroke-linejoin="round"></path>
                                                                        <path d="M4.94547 13.2998C5.42747 12.8178 5.42747 12.0364 4.94548 11.5544C4.46348 11.0724 3.68202 11.0724 3.20003 11.5544L0.872775 13.8816C0.390784 14.3636 0.390784 15.1451 0.872775 15.6271C1.35477 16.1091 2.13623 16.1091 2.61822 15.6271L4.94547 13.2998Z" stroke="#3B3731" stroke-linecap="round" stroke-linejoin="round"></path>
                                                                    </svg>
                                                                    <span class="normal-light-color font-color">Full Groom</span>
                                                                </div>
                                                                <div class="d-flex align-items-center gap-10">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="19" height="17" viewBox="0 0 19 17" fill="none">
                                                                        <path d="M0.5 8.29554C0.5 5.20139 0.5 3.6539 1.50457 2.69308C2.50914 1.73227 4.12486 1.73145 7.35714 1.73145H10.7857C14.018 1.73145 15.6346 1.73145 16.6383 2.69308C17.642 3.65472 17.6429 5.20139 17.6429 8.29554V9.93656C17.6429 13.0307 17.6429 14.5782 16.6383 15.539C15.6337 16.4998 14.018 16.5007 10.7857 16.5007H7.35714C4.12486 16.5007 2.50829 16.5007 1.50457 15.539C0.500857 14.5774 0.5 13.0307 0.5 9.93656V8.29554Z" stroke="#3B3731"></path>
                                                                        <path d="M4.78585 1.73077V0.5M13.3573 1.73077V0.5M0.928711 5.83333H17.2144" stroke="#3B3731" stroke-linecap="round"></path>
                                                                        <path d="M14.2144 12.3975C14.2144 12.6151 14.1241 12.8238 13.9634 12.9777C13.8026 13.1315 13.5846 13.218 13.3573 13.218C13.13 13.218 12.9119 13.1315 12.7512 12.9777C12.5904 12.8238 12.5001 12.6151 12.5001 12.3975C12.5001 12.1799 12.5904 11.9712 12.7512 11.8173C12.9119 11.6634 13.13 11.577 13.3573 11.577C13.5846 11.577 13.8026 11.6634 13.9634 11.8173C14.1241 11.9712 14.2144 12.1799 14.2144 12.3975ZM14.2144 9.11543C14.2144 9.33305 14.1241 9.54175 13.9634 9.69562C13.8026 9.8495 13.5846 9.93595 13.3573 9.93595C13.13 9.93595 12.9119 9.8495 12.7512 9.69562C12.5904 9.54175 12.5001 9.33305 12.5001 9.11543C12.5001 8.89782 12.5904 8.68912 12.7512 8.53524C12.9119 8.38137 13.13 8.29492 13.3573 8.29492C13.5846 8.29492 13.8026 8.38137 13.9634 8.53524C14.1241 8.68912 14.2144 8.89782 14.2144 9.11543ZM9.92871 12.3975C9.92871 12.6151 9.83841 12.8238 9.67766 12.9777C9.51691 13.1315 9.2989 13.218 9.07157 13.218C8.84424 13.218 8.62622 13.1315 8.46548 12.9777C8.30473 12.8238 8.21443 12.6151 8.21443 12.3975C8.21443 12.1799 8.30473 11.9712 8.46548 11.8173C8.62622 11.6634 8.84424 11.577 9.07157 11.577C9.2989 11.577 9.51691 11.6634 9.67766 11.8173C9.83841 11.9712 9.92871 12.1799 9.92871 12.3975ZM9.92871 9.11543C9.92871 9.33305 9.83841 9.54175 9.67766 9.69562C9.51691 9.8495 9.2989 9.93595 9.07157 9.93595C8.84424 9.93595 8.62622 9.8495 8.46548 9.69562C8.30473 9.54175 8.21443 9.33305 8.21443 9.11543C8.21443 8.89782 8.30473 8.68912 8.46548 8.53524C8.62622 8.38137 8.84424 8.29492 9.07157 8.29492C9.2989 8.29492 9.51691 8.38137 9.67766 8.53524C9.83841 8.68912 9.92871 8.89782 9.92871 9.11543ZM5.643 12.3975C5.643 12.6151 5.55269 12.8238 5.39195 12.9777C5.2312 13.1315 5.01318 13.218 4.78585 13.218C4.55853 13.218 4.34051 13.1315 4.17976 12.9777C4.01902 12.8238 3.92871 12.6151 3.92871 12.3975C3.92871 12.1799 4.01902 11.9712 4.17976 11.8173C4.34051 11.6634 4.55853 11.577 4.78585 11.577C5.01318 11.577 5.2312 11.6634 5.39195 11.8173C5.55269 11.9712 5.643 12.1799 5.643 12.3975ZM5.643 9.11543C5.643 9.33305 5.55269 9.54175 5.39195 9.69562C5.2312 9.8495 5.01318 9.93595 4.78585 9.93595C4.55853 9.93595 4.34051 9.8495 4.17976 9.69562C4.01902 9.54175 3.92871 9.33305 3.92871 9.11543C3.92871 8.89782 4.01902 8.68912 4.17976 8.53524C4.34051 8.38137 4.55853 8.29492 4.78585 8.29492C5.01318 8.29492 5.2312 8.38137 5.39195 8.53524C5.55269 8.68912 5.643 8.89782 5.643 9.11543Z" fill="#3B3731"></path>
                                                                    </svg>
                                                                    <span class="normal-light-color font-color">18/12/2025</span>
                                                                </div>
                                                                <div class="d-flex align-items-center gap-10">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="15" viewBox="0 0 16 15" fill="none">
                                                                        <path d="M8 6.02632C5.73786 6.02632 3.82643 8.06405 3.20929 10.6813C2.93786 11.8323 3.34714 13.0539 4.35179 13.6279C5.14821 14.0829 6.33286 14.5 8 14.5C9.66714 14.5 10.8521 14.0829 11.6486 13.6279C12.6532 13.0539 13.0621 11.8323 12.7907 10.6813C12.1736 8.06368 10.2621 6.02632 8 6.02632ZM0.5 5.45305C0.5 6.47063 1.13929 7.5 1.92857 7.5C2.71786 7.5 3.35714 6.47063 3.35714 5.45305C3.35714 4.43547 2.71786 3.81579 1.92857 3.81579C1.13929 3.81579 0.5 4.43584 0.5 5.45305ZM15.5 5.45305C15.5 6.47063 14.8607 7.5 14.0714 7.5C13.2821 7.5 12.6429 6.47063 12.6429 5.45305C12.6429 4.43547 13.2821 3.81579 14.0714 3.81579C14.8607 3.81579 15.5 4.43584 15.5 5.45305ZM4.25 2.13726C4.25 3.15484 4.88929 4.18421 5.67857 4.18421C6.46786 4.18421 7.10714 3.15484 7.10714 2.13726C7.10714 1.11968 6.46786 0.5 5.67857 0.5C4.88929 0.5 4.25 1.12005 4.25 2.13726ZM11.75 2.13726C11.75 3.15484 11.1107 4.18421 10.3214 4.18421C9.53214 4.18421 8.89286 3.15484 8.89286 2.13726C8.89286 1.11968 9.53214 0.5 10.3214 0.5C11.1107 0.5 11.75 1.12005 11.75 2.13726Z" stroke="#3B3731" stroke-linecap="round" stroke-linejoin="round"></path>
                                                                    </svg>
                                                                    <span class="normal-light-color font-color">Bella</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Review submitted Modal  -->



                            <div class="d-flex align-items-center justify-content-center">
                                <button type="button" class="btn-custom btn-no-bg text-center mt-5 medium-font-bold">Load More</button>
                            </div>

                        </div>

                    </div>
                </div>
                <div class="col-lg-1"></div>
            </div>
        </div>

        <?php include '../components/footer.php' ?>
        <script src="<?= BASE_URL ?>/assets/js/common.js"></script>
        <script>
            const tabs = document.querySelectorAll('.booking-filters .tab');

            const upcomingSection = document.querySelector('.upcoming-section');
            const pastBookings = document.querySelectorAll('.past-bookings');
            const cancelledBookings = document.querySelectorAll('.cancelled-bookings');

            function hideAll() {
                if (upcomingSection) upcomingSection.style.display = 'none';
                pastBookings.forEach(el => el.style.display = 'none');
                cancelledBookings.forEach(el => el.style.display = 'none');
            }

            function show(type) {
                hideAll();

                if (type === 'all') {
                    if (upcomingSection) upcomingSection.style.display = 'block';
                    pastBookings.forEach(el => el.style.display = 'block');
                    cancelledBookings.forEach(el => el.style.display = 'block');
                    return;
                }

                if (type === 'upcoming' && upcomingSection) {
                    upcomingSection.style.display = 'block';
                }

                if (type === 'past') {
                    pastBookings.forEach(el => el.style.display = 'block');
                }

                if (type === 'cancelled') {
                    cancelledBookings.forEach(el => el.style.display = 'block');
                }
            }

            // default: All — show every section with its own label
            show('all');

            tabs.forEach(tab => {
                tab.addEventListener('click', function() {
                    tabs.forEach(t => t.classList.remove('active'));
                    this.classList.add('active');
                    show(this.dataset.filter || 'all');
                });
            });
        </script>


        <script>
            const MONTHS = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

            let vy = new Date().getFullYear();
            const d = new Date();
            let month = d.getMonth() + 1;

            vm = month; // view year/month
            let start = null; // Date – lower bound
            let end = null; // Date – upper bound
            // phase: 'none' | 'picking' | 'done'
            let phase = 'none';
            let hover = null; // Date – only used in 'picking' phase

            const key = d => d ? `${d.getFullYear()}-${d.getMonth()}-${d.getDate()}` : '';
            const same = (a, b) => key(a) === key(b);
            const fmt = d => d.toLocaleDateString('en-GB', {
                day: 'numeric',
                month: 'long'
            });
            const fmtShort = d => d.getDate() + ' ' + MONTHS[d.getMonth()];
            const CHIP_CLOSE_SVG = `<span><svg xmlns="http://www.w3.org/2000/svg" width="9" height="9" viewBox="0 0 9 9" fill="none"><path d="M0.5 7.57L7.572 0.5M0.5 0.5L7.572 7.57" stroke="#FBAC83" stroke-linecap="round" /></svg></span>`;

            function getChipsContainer() {
                return document.querySelector('.chips-container');
            }

            function createFilterChip(filter, value, label) {
                const chip = document.createElement('div');
                chip.className = 'chip light-color-font d-flex align-items-center gap-10 close cursor';
                chip.dataset.filter = filter;
                chip.dataset.value = value;
                chip.innerHTML = `${label} ${CHIP_CLOSE_SVG}`;
                return chip;
            }

            function upsertFilterChip(filter, value, label) {
                const container = getChipsContainer();
                if (!container) return;

                let chip = container.querySelector(`.chip[data-filter="${filter}"]`);
                if (!chip) {
                    chip = createFilterChip(filter, value, label);
                    container.appendChild(chip);
                    return;
                }

                chip.dataset.value = value;
                chip.innerHTML = `${label} ${CHIP_CLOSE_SVG}`;
            }

            function removeFilterChip(filter) {
                const container = getChipsContainer();
                container?.querySelector(`.chip[data-filter="${filter}"]`)?.remove();
            }

            function updateDateChip() {
                if (phase === 'done' && start && end) {
                    upsertFilterChip('date', `${key(start)}_${key(end)}`, `${fmtShort(start)} - ${fmtShort(end)}`);
                } else {
                    removeFilterChip('date');
                }
            }

            function clearDateRange() {
                start = null;
                end = null;
                phase = 'none';
                hover = null;
                render();
                setHint();
                updateDateChip();
            }

            function setHint() {
                const el = document.getElementById('hint');
                if (phase === 'none') el.textContent = 'Click a start date';
                else if (phase === 'picking') el.textContent = 'Now click an end date';
                else el.textContent = fmt(start) + '  -  ' + fmt(end);
            }

            function header() {
                let pm = vm - 1,
                    py = vy;
                if (pm < 0) {
                    pm = 11;
                    py--;
                }
                document.getElementById('pLabel').textContent = MONTHS[pm] + ' ' + py;
                document.getElementById('cLabel').textContent = MONTHS[vm] + ' ' + vy;
            }

            function render() {
                const grid = document.getElementById('grid');
                while (grid.children.length > 7) grid.removeChild(grid.lastChild);

                const off = (new Date(vy, vm, 1).getDay() + 6) % 7;
                const days = new Date(vy, vm + 1, 0).getDate();

                // effective lo/hi
                let lo = start,
                    hi = end;
                if (phase === 'picking' && hover) {
                    lo = start <= hover ? start : hover;
                    hi = start <= hover ? hover : start;
                }

                const loK = key(lo),
                    hiK = key(hi);

                const empty = () => {
                    const c = document.createElement('div');
                    c.className = 'cell empty';
                    const n = document.createElement('div');
                    n.className = 'num';
                    c.appendChild(n);
                    return c;
                };

                for (let i = 0; i < off; i++) grid.appendChild(empty());

                for (let d = 1; d <= days; d++) {
                    const date = new Date(vy, vm, d);
                    const dk = key(date);
                    const c = document.createElement('div');
                    c.className = 'cell';
                    c.dataset.d = d;

                    const isLo = dk === loK;
                    const isHi = dk === hiK && !same(lo, hi);
                    const solo = same(lo, hi) && isLo;
                    const mid = lo && hi && date > lo && date < hi;

                    if (solo) {
                        c.classList.add('sel-s', 'sel-e');
                    } else if (isLo) {
                        c.classList.add('rng-s', 'sel-s');
                    } else if (isHi) {
                        c.classList.add('rng-e', 'sel-e');
                    } else if (mid) {
                        c.classList.add('in-range');
                    }

                    const n = document.createElement('div');
                    n.className = 'num';
                    n.textContent = d;
                    c.appendChild(n);
                    grid.appendChild(c);
                }

                const rem = (off + days) % 7 === 0 ? 0 : 7 - (off + days) % 7;
                for (let i = 0; i < rem; i++) grid.appendChild(empty());
            }

            // ── Click: delegate on grid ─────────────────────────────────────────────
            document.getElementById('grid').addEventListener('click', e => {
                const cell = e.target.closest('.cell:not(.empty)');
                if (!cell) return;
                const date = new Date(vy, vm, +cell.dataset.d);

                if (phase === 'none') {
                    // First click — set start, begin picking
                    start = date;
                    end = null;
                    hover = null;
                    phase = 'picking';

                } else if (phase === 'picking') {
                    // Second click — lock range, stop hover completely
                    if (same(date, start)) {
                        // Same day clicked — cancel
                        start = null;
                        phase = 'none';
                    } else {
                        if (date < start) {
                            end = start;
                            start = date;
                        } else {
                            end = date;
                        }
                        phase = 'done';
                        hover = null; // kill hover permanently
                    }

                } else {
                    // Range locked — expand by moving nearest boundary
                    if (date < start) start = date;
                    else if (date > end) end = date;
                    else {
                        const ds = Math.abs(date - start),
                            de = Math.abs(date - end);
                        if (ds <= de) start = date;
                        else end = date;
                    }
                    // stay in 'done', hover stays null
                }

                render();
                setHint();
                updateDateChip();
            });

            // ── Hover preview ONLY while picking ────────────────────────────────────
            document.getElementById('grid').addEventListener('mousemove', e => {
                if (phase !== 'picking') return; // hard gate
                const cell = e.target.closest('.cell:not(.empty)');
                const d = cell ? new Date(vy, vm, +cell.dataset.d) : null;
                if (key(d) !== key(hover)) {
                    hover = d;
                    render();
                }
            });

            document.getElementById('grid').addEventListener('mouseleave', () => {
                if (phase !== 'picking') return;
                hover = null;
                render();
            });

            // ── Nav ─────────────────────────────────────────────────────────────────
            document.getElementById('prev').addEventListener('click', () => {
                vm--;
                if (vm < 0) {
                    vm = 11;
                    vy--;
                }
                hover = null;
                header();
                render();
            });
            document.getElementById('next').addEventListener('click', () => {
                vm++;
                if (vm > 11) {
                    vm = 0;
                    vy++;
                }
                hover = null;
                header();
                render();
            });

            header();
            render();
            setHint();
        </script>
        <script>
            document.querySelectorAll('.upload-box').forEach(box => {
                const input = box.querySelector('.file-input');
                const btn = box.querySelector('.upload-btn');
                const placeholder = box.querySelector('svg');
                const previewContainer = box.querySelector('.preview-container');
                const deleteBtn = box.querySelector('.delete-btn');

                // open file picker
                btn.addEventListener('click', () => input.click());

                input.addEventListener('change', (e) => {
                    const file = e.target.files[0];
                    if (!file) return;

                    const url = URL.createObjectURL(file);

                    // hide UI
                    placeholder.style.display = 'none';
                    btn.style.display = 'none';

                    // show preview
                    previewContainer.innerHTML = `<img src="${url}" />`;
                    previewContainer.style.display = 'block';

                    deleteBtn.style.display = 'block';
                });

                // delete / reset
                deleteBtn.addEventListener('click', () => {
                    input.value = '';

                    previewContainer.innerHTML = '';
                    previewContainer.style.display = 'none';

                    placeholder.style.display = 'block';
                    btn.style.display = 'flex';

                    deleteBtn.style.display = 'none';
                });
            });
        </script>

</body>
<script>
    document.addEventListener("DOMContentLoaded", function() {

        const calendarBtn = document.getElementById("toggleCalendar");
        const calendar = document.getElementById("calendarCard");
        const sortBtn = document.querySelector(".sort-by");
        const sortDropdown = document.querySelector(".sort-dropdown");
        const chipsContainer = document.querySelector(".chips-container");
        const sortRadios = document.querySelectorAll('input[name="sort"]');

        function getSortLabel(radio) {
            return radio.closest('label')?.querySelector('.option-text')?.textContent.trim() || radio.value;
        }

        function syncSortChip() {
            const selected = Array.from(sortRadios).find(radio => radio.checked);
            if (!selected) {
                removeFilterChip('sort');
                return;
            }
            upsertFilterChip('sort', selected.value, getSortLabel(selected));
        }

        calendarBtn.addEventListener("click", function(e) {
            e.stopPropagation();
            sortDropdown.classList.remove("show");
            calendar.classList.toggle("show");
        });

        sortBtn.addEventListener("click", function(e) {
            e.stopPropagation();
            if (sortDropdown.contains(e.target)) return;
            calendar.classList.remove("show");
            sortDropdown.classList.toggle("show");
        });

        calendar.addEventListener("click", e => e.stopPropagation());
        sortDropdown.addEventListener("click", e => e.stopPropagation());

        document.addEventListener("click", function() {
            calendar.classList.remove("show");
            sortDropdown.classList.remove("show");
        });

        sortRadios.forEach(radio => {
            radio.addEventListener('change', function() {
                syncSortChip();
                sortDropdown.classList.remove('show');
            });
        });

        chipsContainer?.addEventListener('click', function(e) {
            const chip = e.target.closest('.chip');
            if (!chip) return;

            const filter = chip.dataset.filter;

            if (filter === 'sort') {
                sortRadios.forEach(radio => {
                    radio.checked = false;
                });
                chip.remove();
                return;
            }

            if (filter === 'date') {
                clearDateRange();
                return;
            }

            chip.remove();
        });

        syncSortChip();
    });
</script>
<script>
    // Change booking modal
    (function() {
        const ORIGINAL = {
            dateKey: '2025-12-18',
            time: '14:30 - 15:30',
            extras: [1, 2, 12],
            totalPaid: 48,
            originalExtrasTotal: 44
        };

        const monthNames = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        const monthShort = ['JAN', 'FEB', 'MAR', 'APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC'];
        const availableDates = ['2025-12-14', '2025-12-15', '2025-12-18', '2025-12-20', '2025-12-26', '2025-12-29', '2025-12-30'];

        let viewDate = new Date(2025, 11);
        let selectedDateKey = ORIGINAL.dateKey;
        let selectedTime = ORIGINAL.time;
        let currentExtrasTotal = ORIGINAL.originalExtrasTotal;
        let currentExtrasIds = ORIGINAL.extras.slice();

        function sameExtras(a, b) {
            if (a.length !== b.length) return false;
            const aa = a.slice().sort(function(x, y) {
                return x - y;
            });
            const bb = b.slice().sort(function(x, y) {
                return x - y;
            });
            return aa.every(function(id, i) {
                return id === bb[i];
            });
        }

        function hasChanges() {
            return selectedDateKey !== ORIGINAL.dateKey ||
                selectedTime !== ORIGINAL.time ||
                !sameExtras(currentExtrasIds, ORIGINAL.extras);
        }

        function updateConfirm() {
            const btn = document.getElementById('cbm-confirm');
            if (!btn) return;
            if (hasChanges()) {
                btn.classList.remove('is-disabled');
                btn.setAttribute('aria-disabled', 'false');
            } else {
                btn.classList.add('is-disabled');
                btn.setAttribute('aria-disabled', 'true');
            }
        }

        function updatePrices() {
            const extrasTotal = currentExtrasTotal || 0;
            const updated = ORIGINAL.totalPaid + extrasTotal;

            document.getElementById('cbm-addons-delta').textContent = '£' + extrasTotal.toFixed(2);
            document.getElementById('cbm-updated-total').textContent = '£' + updated.toFixed(2);

            const alertEl = document.getElementById('cbm-alert');
            const alertText = document.getElementById('cbm-alert-text');
            if (extrasTotal > 0) {
                alertEl.style.display = 'flex';
                alertText.textContent = "You'll be charged an additional £" + extrasTotal.toFixed(2) + ' when you confirm.';
            } else {
                alertEl.style.display = 'none';
            }

            updateConfirm();
        }

        function updateTimesLabel() {
            const parts = selectedDateKey.split('-');
            const day = parseInt(parts[2], 10);
            const month = parseInt(parts[1], 10) - 1;
            document.getElementById('cbm-times-label').textContent = 'AVAILABLE TIMES · ' + day + ' ' + monthShort[month];
        }

        function renderCalendar() {
            const datesContainer = document.getElementById('cbm-cal-dates');
            const headerTitle = document.getElementById('cbm-cal-title');
            if (!datesContainer || !headerTitle) return;

            datesContainer.innerHTML = '';
            const year = viewDate.getFullYear();
            const month = viewDate.getMonth();
            headerTitle.textContent = monthNames[month].toUpperCase() + ' ' + year;

            const firstDay = new Date(year, month, 1).getDay() || 7;
            const daysInMonth = new Date(year, month + 1, 0).getDate();

            for (let i = 1; i < firstDay; i++) {
                datesContainer.appendChild(document.createElement('div'));
            }

            for (let day = 1; day <= daysInMonth; day++) {
                const dateDiv = document.createElement('div');
                dateDiv.className = 'cbm-date';
                dateDiv.textContent = day;

                const dateKey = year + '-' + String(month + 1).padStart(2, '0') + '-' + String(day).padStart(2, '0');

                if (availableDates.includes(dateKey)) {
                    dateDiv.classList.add('available');
                    if (dateKey === selectedDateKey) dateDiv.classList.add('selected');
                    dateDiv.addEventListener('click', function() {
                        selectedDateKey = dateKey;
                        updateTimesLabel();
                        renderCalendar();
                        updateConfirm();
                    });
                }

                datesContainer.appendChild(dateDiv);
            }
        }

        window.handleChangeBookingExtras = function(ids, total) {
            currentExtrasIds = ids.slice();
            currentExtrasTotal = total;
            updatePrices();
        };

        document.getElementById('cbm-cal-prev')?.addEventListener('click', function() {
            viewDate.setMonth(viewDate.getMonth() - 1);
            renderCalendar();
        });

        document.getElementById('cbm-cal-next')?.addEventListener('click', function() {
            viewDate.setMonth(viewDate.getMonth() + 1);
            renderCalendar();
        });

        document.querySelectorAll('#cbm-time-list .cbm-time').forEach(function(slot) {
            slot.addEventListener('click', function() {
                document.querySelectorAll('#cbm-time-list .cbm-time').forEach(function(t) {
                    t.classList.remove('selected');
                });
                slot.classList.add('selected');
                selectedTime = slot.dataset.range || slot.textContent.trim();
                updateConfirm();
            });
        });

        document.getElementById('cbm-confirm')?.addEventListener('click', function(e) {
            e.preventDefault();
            if (this.classList.contains('is-disabled') || this.getAttribute('aria-disabled') === 'true') {
                return;
            }

            // Fill confirmation modal with selected values
            const dateEl = document.getElementById('bum-groomer-date');
            const timeEl = document.getElementById('bum-groomer-time');
            const priceEl = document.getElementById('bum-groomer-price');
            if (dateEl) dateEl.textContent = formatFriendlyDate(selectedDateKey);
            if (timeEl) timeEl.textContent = selectedTime.replace(' - ', ' – ');
            if (priceEl) priceEl.textContent = document.getElementById('cbm-updated-total')?.textContent || '£48.00';

            // Close change modal, open updated modal
            const changeModal = document.getElementById('change_groomer_booking_modal');
            const updatedModal = document.getElementById('groomer_booking_updated_modal');
            if (changeModal) changeModal.style.display = 'none';
            if (updatedModal) updatedModal.style.display = 'flex';
        });

        function formatFriendlyDate(key) {
            const parts = key.split('-');
            const d = new Date(parseInt(parts[0], 10), parseInt(parts[1], 10) - 1, parseInt(parts[2], 10));
            const days = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
            const months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
            return days[d.getDay()] + ', ' + d.getDate() + ' ' + months[d.getMonth()] + ' ' + d.getFullYear();
        }

        // Close parent modal when opening change booking from booking details
        document.addEventListener('click', function(e) {
            const trigger = e.target.closest('[data-close-parent-modal]');
            if (!trigger) return;
            const parentModal = trigger.closest('.modal');
            if (parentModal) parentModal.style.display = 'none';
        });

        renderCalendar();
        updateTimesLabel();
        updatePrices();
    })();
</script>
<script>
    // Change space booking modal
    (function() {
        // Current booking state — Confirm stays disabled until date, time, or extras change.
        const ORIGINAL = {
            dateKey: '2025-12-18',
            time: '14:30 - 18:30',
            extras: [2], // Deep Clean (matches default_selected)
            totalPaid: 48,
            originalExtrasTotal: 10
        };

        const monthNames = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        const monthShort = ['JAN', 'FEB', 'MAR', 'APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC'];
        const availableDates = ['2025-12-14', '2025-12-15', '2025-12-18', '2025-12-20', '2025-12-26', '2025-12-29', '2025-12-30'];

        let viewDate = new Date(2025, 11);
        let selectedDateKey = ORIGINAL.dateKey;
        let selectedTime = ORIGINAL.time;
        let currentExtrasTotal = ORIGINAL.originalExtrasTotal;
        let currentExtrasIds = ORIGINAL.extras.slice();

        function sameExtras(a, b) {
            if (a.length !== b.length) return false;
            const aa = a.slice().sort(function(x, y) {
                return x - y;
            });
            const bb = b.slice().sort(function(x, y) {
                return x - y;
            });
            return aa.every(function(id, i) {
                return id === bb[i];
            });
        }

        function hasChanges() {
            return selectedDateKey !== ORIGINAL.dateKey ||
                selectedTime !== ORIGINAL.time ||
                !sameExtras(currentExtrasIds, ORIGINAL.extras);
        }

        function updateConfirm() {
            const btn = document.getElementById('cbs-confirm');
            if (!btn) return;
            if (hasChanges()) {
                btn.classList.remove('is-disabled');
                btn.setAttribute('aria-disabled', 'false');
            } else {
                btn.classList.add('is-disabled');
                btn.setAttribute('aria-disabled', 'true');
            }
        }

        function updatePrices() {
            const extrasTotal = currentExtrasTotal || 0;
            const serviceOnly = ORIGINAL.totalPaid - ORIGINAL.originalExtrasTotal;
            const updated = serviceOnly + extrasTotal;
            const delta = updated - ORIGINAL.totalPaid;

            document.getElementById('cbs-addons-delta').textContent = '£' + extrasTotal.toFixed(2);
            document.getElementById('cbs-updated-total').textContent = '£' + updated.toFixed(2);

            const chargeEl = document.getElementById('cbs-alert-charge');
            const chargeText = document.getElementById('cbs-alert-charge-text');
            const refundEl = document.getElementById('cbs-alert-refund');
            const refundText = document.getElementById('cbs-alert-refund-text');

            chargeEl.style.display = 'none';
            refundEl.style.display = 'none';

            if (delta > 0) {
                chargeEl.style.display = 'flex';
                chargeText.textContent = "You'll be charged an additional £" + delta.toFixed(2) + ' when you confirm.';
            } else if (delta < 0) {
                refundEl.style.display = 'flex';
                refundText.textContent = "You'll receive a £" + Math.abs(delta).toFixed(2) + ' refund. Refunds processed in 3-5 days.';
            }

            updateConfirm();
        }

        function updateTimesLabel() {
            const parts = selectedDateKey.split('-');
            const day = parseInt(parts[2], 10);
            const month = parseInt(parts[1], 10) - 1;
            document.getElementById('cbs-times-label').textContent = 'AVAILABLE TIMES · ' + day + ' ' + monthShort[month];
        }

        function renderCalendar() {
            const datesContainer = document.getElementById('cbs-cal-dates');
            const headerTitle = document.getElementById('cbs-cal-title');
            if (!datesContainer || !headerTitle) return;

            datesContainer.innerHTML = '';
            const year = viewDate.getFullYear();
            const month = viewDate.getMonth();
            headerTitle.textContent = monthNames[month].toUpperCase() + ' ' + year;

            const firstDay = new Date(year, month, 1).getDay() || 7;
            const daysInMonth = new Date(year, month + 1, 0).getDate();

            for (let i = 1; i < firstDay; i++) {
                datesContainer.appendChild(document.createElement('div'));
            }

            for (let day = 1; day <= daysInMonth; day++) {
                const dateDiv = document.createElement('div');
                dateDiv.className = 'cbm-date';
                dateDiv.textContent = day;

                const dateKey = year + '-' + String(month + 1).padStart(2, '0') + '-' + String(day).padStart(2, '0');

                if (availableDates.includes(dateKey)) {
                    dateDiv.classList.add('available');
                    if (dateKey === selectedDateKey) dateDiv.classList.add('selected');
                    dateDiv.addEventListener('click', function() {
                        selectedDateKey = dateKey;
                        updateTimesLabel();
                        renderCalendar();
                        updateConfirm();
                    });
                }

                datesContainer.appendChild(dateDiv);
            }
        }

        window.handleChangeSpaceExtras = function(ids, total) {
            currentExtrasIds = ids.slice();
            currentExtrasTotal = total;
            updatePrices();
        };

        document.getElementById('cbs-cal-prev')?.addEventListener('click', function() {
            viewDate.setMonth(viewDate.getMonth() - 1);
            renderCalendar();
        });

        document.getElementById('cbs-cal-next')?.addEventListener('click', function() {
            viewDate.setMonth(viewDate.getMonth() + 1);
            renderCalendar();
        });

        document.querySelectorAll('#cbs-time-list .cbm-time').forEach(function(slot) {
            slot.addEventListener('click', function() {
                document.querySelectorAll('#cbs-time-list .cbm-time').forEach(function(t) {
                    t.classList.remove('selected');
                });
                slot.classList.add('selected');
                selectedTime = slot.dataset.range || slot.textContent.trim();
                updateConfirm();
            });
        });

        document.getElementById('cbs-confirm')?.addEventListener('click', function(e) {
            e.preventDefault();
            if (this.classList.contains('is-disabled') || this.getAttribute('aria-disabled') === 'true') {
                return;
            }

            // Fill confirmation modal with selected values
            const dateEl = document.getElementById('bum-space-date');
            const timeEl = document.getElementById('bum-space-time');
            const priceEl = document.getElementById('bum-space-price');
            if (dateEl) dateEl.textContent = formatFriendlyDate(selectedDateKey);
            if (timeEl) timeEl.textContent = selectedTime.replace(' - ', ' – ');
            if (priceEl) priceEl.textContent = document.getElementById('cbs-updated-total')?.textContent || '£48.00';

            // Close change modal, open updated modal
            const changeModal = document.getElementById('change_space_booking_modal');
            const updatedModal = document.getElementById('space_booking_updated_modal');
            if (changeModal) changeModal.style.display = 'none';
            if (updatedModal) updatedModal.style.display = 'flex';
        });

        function formatFriendlyDate(key) {
            const parts = key.split('-');
            const d = new Date(parseInt(parts[0], 10), parseInt(parts[1], 10) - 1, parseInt(parts[2], 10));
            const days = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
            const months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
            return days[d.getDay()] + ', ' + d.getDate() + ' ' + months[d.getMonth()] + ' ' + d.getFullYear();
        }

        renderCalendar();
        updateTimesLabel();
        updatePrices();
    })();
</script>
<script>
    // Cancel booking confirmation flow
    (function() {
        document.getElementById('cnl-confirm-groomer')?.addEventListener('click', function() {
            const changeModal = document.getElementById('cancel_groomer_booking_modal');
            const cancelledModal = document.getElementById('groomer_booking_cancelled_modal');
            if (changeModal) changeModal.style.display = 'none';
            if (cancelledModal) cancelledModal.style.display = 'flex';
        });

        document.getElementById('cnl-confirm-space')?.addEventListener('click', function() {
            const changeModal = document.getElementById('cancel_space_booking_modal');
            const cancelledModal = document.getElementById('space_booking_cancelled_modal');
            if (changeModal) changeModal.style.display = 'none';
            if (cancelledModal) cancelledModal.style.display = 'flex';
        });
    })();
</script>
<script>
    document.getElementById('reviewForm').addEventListener('submit', function(e) {
        e.preventDefault();

        // open success modal
        document.querySelector('[data-modal-open="review-submitted-modal"]').click();

        // hide review modal
        const reviewModal = document.getElementById('review-modal');
        if (reviewModal) {
            reviewModal.style.display = 'none';
        }

        // reset everything (ONE CALL)
        resetReviewUI(this);
    });

    function resetReviewUI(form) {

        // reset form fields
        form.querySelectorAll('input, textarea, select').forEach(el => {
            if (el.type === 'checkbox' || el.type === 'radio') {
                el.checked = false;
            } else {
                el.value = '';
            }
        });

        // remove chips inside the review form only
        form.querySelectorAll('.chip').forEach(c => c.remove());

        // reset upload boxes
        document.querySelectorAll('.upload-box').forEach(box => {
            const input = box.querySelector('.file-input');
            const btn = box.querySelector('.upload-btn');
            const placeholder = box.querySelector('svg');
            const previewContainer = box.querySelector('.preview-container');
            const deleteBtn = box.querySelector('.delete-btn');

            if (input) input.value = '';

            if (previewContainer) {
                previewContainer.innerHTML = '';
                previewContainer.style.display = 'none';
            }

            if (placeholder) placeholder.style.display = 'block';
            if (btn) btn.style.display = 'flex';
            if (deleteBtn) deleteBtn.style.display = 'none';
        });
    }
</script>

</html>