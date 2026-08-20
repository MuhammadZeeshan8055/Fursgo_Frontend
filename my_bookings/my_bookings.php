<?php include '../function_helper.php'; ?>
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
                                            <a href="<?= BASE_URL ?>my_bookings/change_groomer_booking.php" class="mb-btn"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                                    <path d="M2.23096 15.4951V12.6123H5.11378" stroke="#3B3731" stroke-linecap="round" stroke-linejoin="round" />
                                                    <path d="M15.3656 6.62252C15.6715 8.25452 15.4269 9.94189 14.6702 11.4199C13.9135 12.8978 12.6875 14.0827 11.1846 14.7887C9.68175 15.4946 7.98704 15.6817 6.3664 15.3204C4.74575 14.9592 3.2909 14.0701 2.23013 12.7927M0.628303 9.37748C0.322432 7.74548 0.567036 6.05811 1.32373 4.58014C2.08043 3.10218 3.3064 1.91725 4.80927 1.2113C6.31214 0.505355 8.00686 0.318331 9.6275 0.679579C11.2481 1.04083 12.703 1.9299 13.7638 3.2073" stroke="#3B3731" stroke-linecap="round" stroke-linejoin="round" />
                                                    <path d="M13.7624 0.504883V3.38771H10.8796M4.61412 8.38848C4.2061 8.31757 4.2061 7.73171 4.61412 7.6608C5.3363 7.53448 6.00461 7.19626 6.53409 6.68914C7.06356 6.18203 7.43027 5.52892 7.58761 4.81285L7.61202 4.70009C7.70037 4.29673 8.27461 4.2944 8.36644 4.6966L8.39666 4.82796C8.55903 5.54126 8.92875 6.19059 9.4593 6.69425C9.98985 7.19791 10.6575 7.53339 11.3783 7.65848C11.7886 7.72938 11.7886 8.31874 11.3783 8.39081C10.6577 8.51581 9.99011 8.85111 9.45958 9.35455C8.92904 9.85799 8.55923 10.5071 8.39666 11.2202L8.36644 11.3504C8.27461 11.7526 7.70037 11.7502 7.61202 11.3469L7.58877 11.2353C7.43128 10.5189 7.06422 9.86555 6.5343 9.3584C6.00438 8.85125 5.33556 8.51322 4.61295 8.38732" stroke="#3B3731" stroke-linecap="round" stroke-linejoin="round" />
                                                </svg> Change booking</a>
                                            <a href="<?= BASE_URL ?>messages_notification/messages.php" class="mb-btn-icon" title="Message groomer"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="15" viewBox="0 0 16 15" fill="none">
                                                    <path d="M8 0.5C12.2044 0.5 15.5 3.48321 15.5 7.03223C15.5 10.4703 12.4072 13.3772 8.3916 13.5557L8 13.5645H7.99902C7.251 13.5661 6.50584 13.4687 5.7832 13.2744L5.59766 13.2246L5.42676 13.3115C5.00713 13.5247 4.13103 13.9084 2.72363 14.2393L2.08691 14.377C1.99742 14.3948 1.9071 14.4082 1.81738 14.4248C1.85085 14.3352 1.88498 14.2458 1.91602 14.1553L1.91895 14.1455C2.17667 13.3938 2.38924 12.5229 2.46777 11.7012L2.49023 11.4678L2.3252 11.3008C1.18119 10.1487 0.500003 8.65476 0.5 7.03223C0.5 3.48321 3.79561 0.5 8 0.5Z" stroke="#3B3731" />
                                                </svg></a>
                                        </div>
                                        <a href="<?= BASE_URL ?>my_bookings/cancelled_bookings.php" class="mb-cancel-link">Cancel</a>
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
                                            <a href="<?= BASE_URL ?>my_bookings/change_space_booking.php" class="mb-btn"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                                    <path d="M2.23096 15.4951V12.6123H5.11378" stroke="#3B3731" stroke-linecap="round" stroke-linejoin="round" />
                                                    <path d="M15.3656 6.62252C15.6715 8.25452 15.4269 9.94189 14.6702 11.4199C13.9135 12.8978 12.6875 14.0827 11.1846 14.7887C9.68175 15.4946 7.98704 15.6817 6.3664 15.3204C4.74575 14.9592 3.2909 14.0701 2.23013 12.7927M0.628303 9.37748C0.322432 7.74548 0.567036 6.05811 1.32373 4.58014C2.08043 3.10218 3.3064 1.91725 4.80927 1.2113C6.31214 0.505355 8.00686 0.318331 9.6275 0.679579C11.2481 1.04083 12.703 1.9299 13.7638 3.2073" stroke="#3B3731" stroke-linecap="round" stroke-linejoin="round" />
                                                    <path d="M13.7624 0.504883V3.38771H10.8796M4.61412 8.38848C4.2061 8.31757 4.2061 7.73171 4.61412 7.6608C5.3363 7.53448 6.00461 7.19626 6.53409 6.68914C7.06356 6.18203 7.43027 5.52892 7.58761 4.81285L7.61202 4.70009C7.70037 4.29673 8.27461 4.2944 8.36644 4.6966L8.39666 4.82796C8.55903 5.54126 8.92875 6.19059 9.4593 6.69425C9.98985 7.19791 10.6575 7.53339 11.3783 7.65848C11.7886 7.72938 11.7886 8.31874 11.3783 8.39081C10.6577 8.51581 9.99011 8.85111 9.45958 9.35455C8.92904 9.85799 8.55923 10.5071 8.39666 11.2202L8.36644 11.3504C8.27461 11.7526 7.70037 11.7502 7.61202 11.3469L7.58877 11.2353C7.43128 10.5189 7.06422 9.86555 6.5343 9.3584C6.00438 8.85125 5.33556 8.51322 4.61295 8.38732" stroke="#3B3731" stroke-linecap="round" stroke-linejoin="round" />
                                                </svg> Change booking</a>
                                            <a href="<?= BASE_URL ?>messages_notification/messages.php" class="mb-btn-icon" title="Message host"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                                    <path d="M2.2 7.4C2.2 4.9 4.4 2.8 7.1 2.8H8.9C11.6 2.8 13.8 4.9 13.8 7.4C13.8 9.9 11.6 12 8.9 12H7.8L5.2 13.7V12C3.4 11.4 2.2 9.5 2.2 7.4Z" stroke="currentColor" stroke-width="1.3" stroke-linejoin="round" />
                                                </svg></a>
                                        </div>
                                        <a href="<?= BASE_URL ?>my_bookings/cancelled_bookings.php" class="mb-cancel-link">Cancel</a>
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
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="17" viewBox="0 0 16 17" fill="none">
                                                        <path d="M4.94591 11.5544C6.23114 12.8397 9.35699 11.798 11.9274 9.22713C14.4983 6.65667 15.54 3.53082 14.2548 2.24559M8.72754 1.37259L9.30927 1.95473M6.6915 3.40904L7.27322 3.99077M4.9455 5.73636L5.52722 6.31809M4.36377 8.6454L4.9455 9.22713M11.9274 0.5L12.5092 1.08173M11.3457 3.99118L12.5092 5.15463M9.30968 6.02763L10.4731 7.19109M6.98236 7.77281L8.14581 8.93627" stroke="#9D9B98" stroke-linecap="round" stroke-linejoin="round" />
                                                        <path d="M4.94547 13.2998C5.42747 12.8178 5.42747 12.0364 4.94548 11.5544C4.46348 11.0724 3.68202 11.0724 3.20003 11.5544L0.872775 13.8816C0.390784 14.3636 0.390784 15.1451 0.872775 15.6271C1.35477 16.1091 2.13623 16.1091 2.61822 15.6271L4.94547 13.2998Z" stroke="#9D9B98" stroke-linecap="round" stroke-linejoin="round" />
                                                    </svg>
                                                    Service
                                                </div>
                                                <p class="bd-tile-value">Bath &amp; Brush</p>
                                            </div>
                                            <div class="bd-tile">
                                                <div class="bd-tile-label">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="19" height="17" viewBox="0 0 19 17" fill="none">
                                                        <path d="M0.5 8.29554C0.5 5.20139 0.5 3.6539 1.50457 2.69308C2.50914 1.73227 4.12486 1.73145 7.35714 1.73145H10.7857C14.018 1.73145 15.6346 1.73145 16.6383 2.69308C17.642 3.65472 17.6429 5.20139 17.6429 8.29554V9.93656C17.6429 13.0307 17.6429 14.5782 16.6383 15.539C15.6337 16.4998 14.018 16.5007 10.7857 16.5007H7.35714C4.12486 16.5007 2.50829 16.5007 1.50457 15.539C0.500857 14.5774 0.5 13.0307 0.5 9.93656V8.29554Z" stroke="#9D9B98" />
                                                        <path d="M4.78585 1.73077V0.5M13.3573 1.73077V0.5M0.928711 5.83333H17.2144" stroke="#9D9B98" stroke-linecap="round" />
                                                        <path d="M14.2139 12.3975C14.2139 12.6151 14.1236 12.8238 13.9629 12.9777C13.8021 13.1315 13.5841 13.218 13.3568 13.218C13.1295 13.218 12.9114 13.1315 12.7507 12.9777C12.59 12.8238 12.4997 12.6151 12.4997 12.3975C12.4997 12.1799 12.59 11.9712 12.7507 11.8173C12.9114 11.6634 13.1295 11.577 13.3568 11.577C13.5841 11.577 13.8021 11.6634 13.9629 11.8173C14.1236 11.9712 14.2139 12.1799 14.2139 12.3975ZM14.2139 9.11543C14.2139 9.33305 14.1236 9.54175 13.9629 9.69562C13.8021 9.8495 13.5841 9.93595 13.3568 9.93595C13.1295 9.93595 12.9114 9.8495 12.7507 9.69562C12.59 9.54175 12.4997 9.33305 12.4997 9.11543C12.4997 8.89782 12.59 8.68912 12.7507 8.53524C12.9114 8.38137 13.1295 8.29492 13.3568 8.29492C13.5841 8.29492 13.8021 8.38137 13.9629 8.53524C14.1236 8.68912 14.2139 8.89782 14.2139 9.11543ZM9.92822 12.3975C9.92822 12.6151 9.83792 12.8238 9.67717 12.9777C9.51643 13.1315 9.29841 13.218 9.07108 13.218C8.84375 13.218 8.62573 13.1315 8.46499 12.9777C8.30424 12.8238 8.21394 12.6151 8.21394 12.3975C8.21394 12.1799 8.30424 11.9712 8.46499 11.8173C8.62573 11.6634 8.84375 11.577 9.07108 11.577C9.29841 11.577 9.51643 11.6634 9.67717 11.8173C9.83792 11.9712 9.92822 12.1799 9.92822 12.3975ZM9.92822 9.11543C9.92822 9.33305 9.83792 9.54175 9.67717 9.69562C9.51643 9.8495 9.29841 9.93595 9.07108 9.93595C8.84375 9.93595 8.62573 9.8495 8.46499 9.69562C8.30424 9.54175 8.21394 9.33305 8.21394 9.11543C8.21394 8.89782 8.30424 8.68912 8.46499 8.53524C8.62573 8.38137 8.84375 8.29492 9.07108 8.29492C9.29841 8.29492 9.51643 8.38137 9.67717 8.53524C9.83792 8.68912 9.92822 8.89782 9.92822 9.11543ZM5.64251 12.3975C5.64251 12.6151 5.5522 12.8238 5.39146 12.9777C5.23071 13.1315 5.01269 13.218 4.78537 13.218C4.55804 13.218 4.34002 13.1315 4.17927 12.9777C4.01853 12.8238 3.92822 12.6151 3.92822 12.3975C3.92822 12.1799 4.01853 11.9712 4.17927 11.8173C4.34002 11.6634 4.55804 11.577 4.78537 11.577C5.01269 11.577 5.23071 11.6634 5.39146 11.8173C5.5522 11.9712 5.64251 12.1799 5.64251 12.3975ZM5.64251 9.11543C5.64251 9.33305 5.5522 9.54175 5.39146 9.69562C5.23071 9.8495 5.01269 9.93595 4.78537 9.93595C4.55804 9.93595 4.34002 9.8495 4.17927 9.69562C4.01853 9.54175 3.92822 9.33305 3.92822 9.11543C3.92822 8.89782 4.01853 8.68912 4.17927 8.53524C4.34002 8.38137 4.55804 8.29492 4.78537 8.29492C5.01269 8.29492 5.23071 8.38137 5.39146 8.53524C5.5522 8.68912 5.64251 8.89782 5.64251 9.11543Z" fill="#9D9B98" />
                                                    </svg>
                                                    Date
                                                </div>
                                                <p class="bd-tile-value">Wed, 18 Dec 2025</p>
                                            </div>
                                            <div class="bd-tile">
                                                <div class="bd-tile-label">
                                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
                                                        <circle cx="8" cy="8" r="6" stroke="#9D9B98" stroke-width="1.5" />
                                                        <path d="M8 4.5V8L10.5 10" stroke="#9D9B98" stroke-width="1.5" stroke-linecap="round" />
                                                    </svg>
                                                    Time
                                                </div>
                                                <p class="bd-tile-value">14:30 - 15:30</p>
                                            </div>
                                            <div class="bd-tile">
                                                <div class="bd-tile-label">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="16" viewBox="0 0 12 16" fill="none">
                                                        <path d="M6 0.5C7.4694 0.5 8.87214 1.04525 9.90137 2.00586C10.9293 2.96529 11.4999 4.25871 11.5 5.59961C11.5 7.10011 10.6408 8.95946 9.51855 10.7236C8.41048 12.4655 7.10434 14.0263 6.32227 14.9082C6.14625 15.1067 5.85375 15.1067 5.67773 14.9082C4.89566 14.0263 3.58952 12.4655 2.48145 10.7236C1.35919 8.95946 0.5 7.10011 0.5 5.59961C0.500111 4.25871 1.07068 2.96529 2.09863 2.00586C3.12786 1.04525 4.53061 0.5 6 0.5ZM6 3.09961C5.30978 3.09961 4.64141 3.35564 4.14355 3.82031C3.64466 4.28597 3.35753 4.92517 3.35742 5.59961C3.35742 6.27422 3.64453 6.91413 4.14355 7.37988C4.64141 7.84453 5.30979 8.09961 6 8.09961C6.34236 8.09961 6.68202 8.03695 7 7.91406C7.31807 7.7911 7.60965 7.61022 7.85645 7.37988C8.10326 7.14952 8.30086 6.87397 8.43652 6.56836C8.57224 6.26256 8.64258 5.93289 8.64258 5.59961C8.64247 4.92517 8.35534 4.28597 7.85645 3.82031C7.35859 3.35564 6.69022 3.09961 6 3.09961Z" stroke="#9D9B98" />
                                                    </svg>
                                                    Location
                                                </div>
                                                <p class="bd-tile-value">At your home</p>
                                            </div>
                                        </div>

                                        <p class="bd-section-label">PET</p>
                                        <div class="bd-pet-card">
                                            <img src="<?= BASE_URL ?>/assets/images/pet_details_1.png" alt="Bella" class="bd-pet-avatar">
                                            <div class="bd-pet-details">
                                                <div class="bd-pet-meta">
                                                    <p class="bd-pet-name">Bella - Rabbit (Mini Lop)</p>

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
                                            <a href="<?= BASE_URL ?>my_bookings/cancelled_bookings.php" class="bd-cancel-link">Cancel Booking</a>
                                            <div class="bd-footer-actions">
                                                <a href="<?= BASE_URL ?>messages_notification/messages.php" class="bd-btn bd-btn-message">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="15" viewBox="0 0 16 15" fill="none">
                                                        <path d="M8 0.5C12.2044 0.5 15.5 3.48321 15.5 7.03223C15.5 10.4703 12.4072 13.3772 8.3916 13.5557L8 13.5645H7.99902C7.251 13.5661 6.50584 13.4687 5.7832 13.2744L5.59766 13.2246L5.42676 13.3115C5.00713 13.5247 4.13103 13.9084 2.72363 14.2393L2.08691 14.377C1.99742 14.3948 1.9071 14.4082 1.81738 14.4248C1.85085 14.3352 1.88498 14.2458 1.91602 14.1553L1.91895 14.1455C2.17667 13.3938 2.38924 12.5229 2.46777 11.7012L2.49023 11.4678L2.3252 11.3008C1.18119 10.1487 0.500003 8.65476 0.5 7.03223C0.5 3.48321 3.79561 0.5 8 0.5Z" stroke="#3B3731" />
                                                    </svg>
                                                    Message groomer
                                                </a>
                                                <a href="<?= BASE_URL ?>/my_bookings/change_groomer_booking.php" class="bd-btn bd-btn-change">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                                        <path d="M2.23096 15.4953V12.6124H5.11378" stroke="white" stroke-linecap="round" stroke-linejoin="round" />
                                                        <path d="M15.3656 6.62252C15.6715 8.25452 15.4269 9.94189 14.6702 11.4199C13.9135 12.8978 12.6875 14.0827 11.1846 14.7887C9.68175 15.4946 7.98704 15.6817 6.3664 15.3204C4.74575 14.9592 3.2909 14.0701 2.23013 12.7927M0.628303 9.37748C0.322432 7.74548 0.567036 6.05811 1.32373 4.58014C2.08043 3.10218 3.3064 1.91725 4.80927 1.2113C6.31214 0.505355 8.00686 0.318331 9.6275 0.679579C11.2481 1.04083 12.703 1.9299 13.7638 3.2073" stroke="white" stroke-linecap="round" stroke-linejoin="round" />
                                                        <path d="M13.7624 0.504883V3.38771H10.8796M4.61412 8.38848C4.2061 8.31757 4.2061 7.73171 4.61412 7.6608C5.3363 7.53448 6.00461 7.19626 6.53409 6.68914C7.06356 6.18203 7.43027 5.52892 7.58761 4.81285L7.61202 4.70009C7.70037 4.29673 8.27461 4.2944 8.36644 4.6966L8.39666 4.82796C8.55903 5.54126 8.92875 6.19059 9.4593 6.69425C9.98985 7.19791 10.6575 7.53339 11.3783 7.65848C11.7886 7.72938 11.7886 8.31874 11.3783 8.39081C10.6577 8.51581 9.99011 8.85111 9.45958 9.35455C8.92904 9.85799 8.55923 10.5071 8.39666 11.2202L8.36644 11.3504C8.27461 11.7526 7.70037 11.7502 7.61202 11.3469L7.58877 11.2353C7.43128 10.5189 7.06422 9.86555 6.5343 9.3584C6.00438 8.85125 5.33556 8.51322 4.61295 8.38732" stroke="white" stroke-linecap="round" stroke-linejoin="round" />
                                                    </svg>
                                                    Change booking
                                                </a>
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
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="17" viewBox="0 0 16 17" fill="none">
                                                        <path d="M4.94591 11.5544C6.23114 12.8397 9.35699 11.798 11.9274 9.22713C14.4983 6.65667 15.54 3.53082 14.2548 2.24559M8.72754 1.37259L9.30927 1.95473M6.6915 3.40904L7.27322 3.99077M4.9455 5.73636L5.52722 6.31809M4.36377 8.6454L4.9455 9.22713M11.9274 0.5L12.5092 1.08173M11.3457 3.99118L12.5092 5.15463M9.30968 6.02763L10.4731 7.19109M6.98236 7.77281L8.14581 8.93627" stroke="#9D9B98" stroke-linecap="round" stroke-linejoin="round" />
                                                        <path d="M4.94547 13.2998C5.42747 12.8178 5.42747 12.0364 4.94548 11.5544C4.46348 11.0724 3.68202 11.0724 3.20003 11.5544L0.872775 13.8816C0.390784 14.3636 0.390784 15.1451 0.872775 15.6271C1.35477 16.1091 2.13623 16.1091 2.61822 15.6271L4.94547 13.2998Z" stroke="#9D9B98" stroke-linecap="round" stroke-linejoin="round" />
                                                    </svg>
                                                    Service
                                                </div>
                                                <p class="bd-tile-value">Bath &amp; Brush</p>
                                            </div>
                                            <div class="bd-tile">
                                                <div class="bd-tile-label">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="19" height="17" viewBox="0 0 19 17" fill="none">
                                                        <path d="M0.5 8.29554C0.5 5.20139 0.5 3.6539 1.50457 2.69308C2.50914 1.73227 4.12486 1.73145 7.35714 1.73145H10.7857C14.018 1.73145 15.6346 1.73145 16.6383 2.69308C17.642 3.65472 17.6429 5.20139 17.6429 8.29554V9.93656C17.6429 13.0307 17.6429 14.5782 16.6383 15.539C15.6337 16.4998 14.018 16.5007 10.7857 16.5007H7.35714C4.12486 16.5007 2.50829 16.5007 1.50457 15.539C0.500857 14.5774 0.5 13.0307 0.5 9.93656V8.29554Z" stroke="#9D9B98" />
                                                        <path d="M4.78585 1.73077V0.5M13.3573 1.73077V0.5M0.928711 5.83333H17.2144" stroke="#9D9B98" stroke-linecap="round" />
                                                        <path d="M14.2139 12.3975C14.2139 12.6151 14.1236 12.8238 13.9629 12.9777C13.8021 13.1315 13.5841 13.218 13.3568 13.218C13.1295 13.218 12.9114 13.1315 12.7507 12.9777C12.59 12.8238 12.4997 12.6151 12.4997 12.3975C12.4997 12.1799 12.59 11.9712 12.7507 11.8173C12.9114 11.6634 13.1295 11.577 13.3568 11.577C13.5841 11.577 13.8021 11.6634 13.9629 11.8173C14.1236 11.9712 14.2139 12.1799 14.2139 12.3975ZM14.2139 9.11543C14.2139 9.33305 14.1236 9.54175 13.9629 9.69562C13.8021 9.8495 13.5841 9.93595 13.3568 9.93595C13.1295 9.93595 12.9114 9.8495 12.7507 9.69562C12.59 9.54175 12.4997 9.33305 12.4997 9.11543C12.4997 8.89782 12.59 8.68912 12.7507 8.53524C12.9114 8.38137 13.1295 8.29492 13.3568 8.29492C13.5841 8.29492 13.8021 8.38137 13.9629 8.53524C14.1236 8.68912 14.2139 8.89782 14.2139 9.11543ZM9.92822 12.3975C9.92822 12.6151 9.83792 12.8238 9.67717 12.9777C9.51643 13.1315 9.29841 13.218 9.07108 13.218C8.84375 13.218 8.62573 13.1315 8.46499 12.9777C8.30424 12.8238 8.21394 12.6151 8.21394 12.3975C8.21394 12.1799 8.30424 11.9712 8.46499 11.8173C8.62573 11.6634 8.84375 11.577 9.07108 11.577C9.29841 11.577 9.51643 11.6634 9.67717 11.8173C9.83792 11.9712 9.92822 12.1799 9.92822 12.3975ZM9.92822 9.11543C9.92822 9.33305 9.83792 9.54175 9.67717 9.69562C9.51643 9.8495 9.29841 9.93595 9.07108 9.93595C8.84375 9.93595 8.62573 9.8495 8.46499 9.69562C8.30424 9.54175 8.21394 9.33305 8.21394 9.11543C8.21394 8.89782 8.30424 8.68912 8.46499 8.53524C8.62573 8.38137 8.84375 8.29492 9.07108 8.29492C9.29841 8.29492 9.51643 8.38137 9.67717 8.53524C9.83792 8.68912 9.92822 8.89782 9.92822 9.11543ZM5.64251 12.3975C5.64251 12.6151 5.5522 12.8238 5.39146 12.9777C5.23071 13.1315 5.01269 13.218 4.78537 13.218C4.55804 13.218 4.34002 13.1315 4.17927 12.9777C4.01853 12.8238 3.92822 12.6151 3.92822 12.3975C3.92822 12.1799 4.01853 11.9712 4.17927 11.8173C4.34002 11.6634 4.55804 11.577 4.78537 11.577C5.01269 11.577 5.23071 11.6634 5.39146 11.8173C5.5522 11.9712 5.64251 12.1799 5.64251 12.3975ZM5.64251 9.11543C5.64251 9.33305 5.5522 9.54175 5.39146 9.69562C5.23071 9.8495 5.01269 9.93595 4.78537 9.93595C4.55804 9.93595 4.34002 9.8495 4.17927 9.69562C4.01853 9.54175 3.92822 9.33305 3.92822 9.11543C3.92822 8.89782 4.01853 8.68912 4.17927 8.53524C4.34002 8.38137 4.55804 8.29492 4.78537 8.29492C5.01269 8.29492 5.23071 8.38137 5.39146 8.53524C5.5522 8.68912 5.64251 8.89782 5.64251 9.11543Z" fill="#9D9B98" />
                                                    </svg>
                                                    Date
                                                </div>
                                                <p class="bd-tile-value">Wed, 18 Dec 2025</p>
                                            </div>
                                            <div class="bd-tile">
                                                <div class="bd-tile-label">
                                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
                                                        <circle cx="8" cy="8" r="6" stroke="#9D9B98" stroke-width="1.5" />
                                                        <path d="M8 4.5V8L10.5 10" stroke="#9D9B98" stroke-width="1.5" stroke-linecap="round" />
                                                    </svg>
                                                    Time
                                                </div>
                                                <p class="bd-tile-value">14:30 - 15:30</p>
                                            </div>
                                            <div class="bd-tile">
                                                <div class="bd-tile-label">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="16" viewBox="0 0 12 16" fill="none">
                                                        <path d="M6 0.5C7.4694 0.5 8.87214 1.04525 9.90137 2.00586C10.9293 2.96529 11.4999 4.25871 11.5 5.59961C11.5 7.10011 10.6408 8.95946 9.51855 10.7236C8.41048 12.4655 7.10434 14.0263 6.32227 14.9082C6.14625 15.1067 5.85375 15.1067 5.67773 14.9082C4.89566 14.0263 3.58952 12.4655 2.48145 10.7236C1.35919 8.95946 0.5 7.10011 0.5 5.59961C0.500111 4.25871 1.07068 2.96529 2.09863 2.00586C3.12786 1.04525 4.53061 0.5 6 0.5ZM6 3.09961C5.30978 3.09961 4.64141 3.35564 4.14355 3.82031C3.64466 4.28597 3.35753 4.92517 3.35742 5.59961C3.35742 6.27422 3.64453 6.91413 4.14355 7.37988C4.64141 7.84453 5.30979 8.09961 6 8.09961C6.34236 8.09961 6.68202 8.03695 7 7.91406C7.31807 7.7911 7.60965 7.61022 7.85645 7.37988C8.10326 7.14952 8.30086 6.87397 8.43652 6.56836C8.57224 6.26256 8.64258 5.93289 8.64258 5.59961C8.64247 4.92517 8.35534 4.28597 7.85645 3.82031C7.35859 3.35564 6.69022 3.09961 6 3.09961Z" stroke="#9D9B98" />
                                                    </svg>
                                                    Location
                                                </div>
                                                <p class="bd-tile-value">At your home</p>
                                            </div>
                                        </div>

                                        <p class="bd-section-label">PET</p>
                                        <div class="bd-pet-card">
                                            <img src="<?= BASE_URL ?>/assets/images/pet_details_1.png" alt="Bella" class="bd-pet-avatar">
                                            <div class="bd-pet-details">
                                                <div class="bd-pet-meta">
                                                    <p class="bd-pet-name">Bella - Rabbit (Mini Lop)</p>

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

                            <!-- Up Coming Space Booking Modal  -->

                            <div class="modal" id="view_booking_space_modal">
                                <div class="modal-content size">
                                    <div class="booking-modal main-container">
                                        <button class="close-x" data-modal-close><svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 36 36"
                                                fill="none">
                                                <circle cx="18" cy="18" r="17.5" stroke="#3B3731" />
                                                <path d="M12.7998 23.9998L23.9998 12.7998M12.7998 12.7998L23.9998 23.9998" stroke="#3B3731"
                                                    stroke-width="1.5" stroke-linecap="round" />
                                            </svg></button>

                                        <div class="booking-modal-header">
                                            <h1>My Bookings</h1>
                                            <p>Your upcoming booking.</p>
                                        </div>

                                        <div class="booking-modal-page-2">
                                            <div class="modal-booking-card">
                                                <div class="modal-header">
                                                    <span class="modal-header-status">Confirmed</span>

                                                    <div class="ref-container d-flex align-items-center gap-20">
                                                        Booking reference: FG-10294
                                                        <span class="pdf-download d-flex align-items-center gap-5"><svg xmlns="http://www.w3.org/2000/svg" width="13" height="15"
                                                                viewBox="0 0 13 15" fill="none">
                                                                <path
                                                                    d="M3.07717 14.5H9.27418C9.95769 14.5 10.6132 14.2209 11.0965 13.7242C11.5798 13.2275 11.8514 12.5538 11.8514 11.8514V7.66649C11.8516 6.96411 11.5804 6.29039 11.0973 5.79351L6.70216 1.27568C6.46282 1.02973 6.1787 0.834645 5.86601 0.701554C5.55331 0.568463 5.21817 0.499975 4.87972 0.5H3.07717C2.39367 0.5 1.73815 0.779053 1.25484 1.27577C0.771523 1.77249 0.5 2.44618 0.5 3.14865V11.8514C0.5 12.5538 0.771523 13.2275 1.25484 13.7242C1.73815 14.2209 2.39367 14.5 3.07717 14.5Z"
                                                                    stroke="#3B3731" stroke-linecap="round" stroke-linejoin="round" />
                                                                <path
                                                                    d="M5.9458 0.772461V5.0557C5.9458 5.45711 6.10096 5.84208 6.37714 6.12592C6.65332 6.40976 7.0279 6.56922 7.41847 6.56922H11.5876"
                                                                    stroke="#3B3731" stroke-linecap="round" stroke-linejoin="round" />
                                                                <path
                                                                    d="M2.67822 10.9055V10.1488M2.67822 10.1488V8.63525H3.41456C3.60985 8.63525 3.79714 8.71498 3.93523 8.8569C4.07332 8.99882 4.15089 9.19131 4.15089 9.39201C4.15089 9.59272 4.07332 9.7852 3.93523 9.92712C3.79714 10.069 3.60985 10.1488 3.41456 10.1488H2.67822ZM8.56891 10.9055V9.95958M8.56891 9.95958V8.63525H9.67341M8.56891 9.95958H9.67341M5.62357 10.9055V8.63525H5.99173C6.28467 8.63525 6.5656 8.75485 6.77274 8.96773C6.97987 9.18061 7.09624 9.46933 7.09624 9.77039C7.09624 10.0714 6.97987 10.3602 6.77274 10.5731C6.5656 10.7859 6.28467 10.9055 5.99173 10.9055H5.62357Z"
                                                                    stroke="#3B3731" stroke-linecap="round" stroke-linejoin="round" />
                                                            </svg> PDF</span>
                                                    </div>
                                                </div>
                                                <div style="padding: 21px; ">
                                                    <div class="modal-content-page-2">

                                                        <div class="modal-studio">
                                                            <div class="studio-image">
                                                                <img src="<?= BASE_URL ?>assets/images/message_profile_1.png" class="inverted-radius" alt="Grooming">
                                                                <div class="badge-shield" title="Verified" style="left: 12px;">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="29" height="31" viewBox="0 0 29 31" fill="none">
                                                                        <path d="M15.3096 0.175208C15.0558 0.0604166 14.784 0 14.5 0C14.216 0 13.9442 0.0604166 13.6904 0.175208L2.31398 5.00249C0.984817 5.56436 -0.00601417 6.8754 2.74804e-05 8.45832C0.0302358 14.4516 2.49523 25.4172 12.905 30.4016C13.914 30.8849 15.086 30.8849 16.095 30.4016C26.5048 25.4172 28.9698 14.4516 29 8.45832C29.006 6.8754 28.0152 5.56436 26.686 5.00249L15.3096 0.175208Z" fill="#CBDCE8"></path>
                                                                        <path d="M22.3736 8.3902L16.1586 14.9936L22.3736 8.3902ZM13.3976 14.6712C11.471 15.4108 9.93043 15.2842 8.38989 14.6735C8.77833 19.6789 11.112 21.6032 14.2234 22.3739C14.2234 22.3739 16.5672 20.716 16.9052 16.7858C16.9417 16.3601 16.9596 16.148 16.8718 15.908C16.7832 15.6679 16.6092 15.4962 16.2619 15.1521C15.6902 14.5865 15.405 14.3037 15.0655 14.2323C14.7261 14.1624 14.2832 14.3317 13.3976 14.6712Z" fill="#CBDCE8"></path>
                                                                        <path d="M22.3736 8.3902L16.1586 14.9936M13.3976 14.6712C11.471 15.4108 9.93043 15.2842 8.38989 14.6735C8.77833 19.6789 11.112 21.6032 14.2234 22.3739C14.2234 22.3739 16.5672 20.716 16.9052 16.7858C16.9417 16.3601 16.9596 16.148 16.8718 15.908C16.7832 15.6679 16.6092 15.4962 16.2619 15.1521C15.6902 14.5865 15.405 14.3037 15.0655 14.2323C14.7261 14.1624 14.2832 14.3317 13.3976 14.6712Z" stroke="white" stroke-linecap="round" stroke-linejoin="round"></path>
                                                                        <path d="M9.55615 18.8365C9.55615 18.8365 11.4983 19.2125 13.4405 17.7131L9.55615 18.8365Z" fill="#CBDCE8"></path>
                                                                        <path d="M9.55615 18.8365C9.55615 18.8365 11.4983 19.2125 13.4405 17.7131" stroke="white" stroke-linecap="round" stroke-linejoin="round"></path>
                                                                        <path d="M12.6631 11.6924C12.6631 11.95 12.5608 12.197 12.3787 12.3791C12.1966 12.5612 11.9496 12.6635 11.692 12.6635C11.4345 12.6635 11.1875 12.5612 11.0054 12.3791C10.8233 12.197 10.7209 11.95 10.7209 11.6924C10.7209 11.4349 10.8233 11.1879 11.0054 11.0057C11.1875 10.8236 11.4345 10.7213 11.692 10.7213C11.9496 10.7213 12.1966 10.8236 12.3787 11.0057C12.5608 11.1879 12.6631 11.4349 12.6631 11.6924Z" fill="#CBDCE8" stroke="white"></path>
                                                                        <path d="M14.6052 9.16711V9.2448V9.16711Z" fill="#CBDCE8"></path>
                                                                        <path d="M14.6052 9.16711V9.2448" stroke="white" stroke-linecap="round" stroke-linejoin="round"></path>
                                                                    </svg>
                                                                </div>
                                                                <div class="modal-host">
                                                                    <div>
                                                                        <h3>Furs & Co. Studio</h3>
                                                                        <p class="hosted">Hosted <span>by Dev É.</span> </p>
                                                                    </div>
                                                                    <div class="modal-category">
                                                                        <p>Garden / Shed</p>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="modal-tags" gap="10px">
                                                                <div class="tags">
                                                                    <div>
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="10" height="9" viewBox="0 0 10 9"
                                                                            fill="none">
                                                                            <path
                                                                                d="M2 8.99999C1.85833 8.99999 1.73967 8.95199 1.644 8.85599C1.54833 8.75999 1.50033 8.64133 1.5 8.49999C1.49967 8.35866 1.54767 8.23999 1.644 8.14399C1.74033 8.04799 1.859 7.99999 2 7.99999H8C8.14166 7.99999 8.2605 8.04799 8.3565 8.14399C8.4525 8.23999 8.50033 8.35866 8.5 8.49999C8.49966 8.64133 8.45166 8.76016 8.356 8.85649C8.26033 8.95283 8.14166 9.00066 8 8.99999H2ZM2.35 7.24999C2.10833 7.24999 1.89383 7.17083 1.7065 7.0125C1.51917 6.85416 1.4045 6.65416 1.3625 6.4125L0.862501 3.2375C0.845834 3.2375 0.827167 3.23967 0.806501 3.244C0.785834 3.24833 0.767001 3.25033 0.750001 3.25C0.541667 3.25 0.364668 3.17717 0.219001 3.0315C0.0733344 2.88583 0.000334469 2.70867 1.13636e-06 2.5C-0.000332197 2.29133 0.0726677 2.11433 0.219001 1.969C0.365334 1.82367 0.542334 1.75067 0.750001 1.75C0.957667 1.74933 1.13483 1.82233 1.2815 1.969C1.42817 2.11567 1.501 2.29267 1.5 2.5C1.5 2.55833 1.49367 2.6125 1.481 2.6625C1.46833 2.7125 1.45383 2.75833 1.4375 2.8L3 3.5L4.5625 1.3625C4.47083 1.29583 4.39583 1.20833 4.3375 1.1C4.27917 0.991667 4.25 0.875 4.25 0.75C4.25 0.541667 4.323 0.364501 4.469 0.218501C4.615 0.0725011 4.792 -0.000332194 5 1.13895e-06C5.208 0.000334472 5.38516 0.0733344 5.5315 0.219001C5.67783 0.364667 5.75066 0.541667 5.75 0.75C5.75 0.875 5.72083 0.991667 5.6625 1.1C5.60416 1.20833 5.52916 1.29583 5.4375 1.3625L7 3.5L8.5625 2.8C8.54583 2.75833 8.53116 2.7125 8.5185 2.6625C8.50583 2.6125 8.49966 2.55833 8.5 2.5C8.5 2.29167 8.573 2.1145 8.719 1.9685C8.865 1.8225 9.042 1.74967 9.25 1.75C9.458 1.75033 9.63516 1.82333 9.7815 1.969C9.92783 2.11467 10.0007 2.29167 10 2.5C9.99933 2.70833 9.92649 2.8855 9.7815 3.0315C9.6365 3.1775 9.45933 3.25033 9.25 3.25C9.23333 3.25 9.21466 3.248 9.194 3.244C9.17333 3.24 9.1545 3.23783 9.1375 3.2375L8.6375 6.4125C8.59583 6.65416 8.48133 6.85416 8.294 7.0125C8.10666 7.17083 7.892 7.24999 7.65 7.24999H2.35ZM2.35 6.25H7.65L7.975 4.1625L7.4 4.4125C7.18333 4.50416 6.9625 4.52083 6.7375 4.4625C6.5125 4.40416 6.32916 4.27916 6.1875 4.0875L5 2.45L3.8125 4.0875C3.67083 4.27916 3.4875 4.40416 3.2625 4.4625C3.0375 4.52083 2.81667 4.50416 2.6 4.4125L2.025 4.1625L2.35 6.25Z"
                                                                                fill="white" />
                                                                        </svg>
                                                                        <span>Popular</span>
                                                                    </div>
                                                                    <div>
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="9" height="11" viewBox="0 0 9 11"
                                                                            fill="none">
                                                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                                                d="M6.41322 7.89398C6.44215 7.34453 6.31579 6.79804 6.0486 6.31706C5.78142 5.83608 5.3842 5.44005 4.90243 5.1743C4.81687 5.12481 4.71545 5.11047 4.61952 5.1343C4.5236 5.15813 4.44068 5.21827 4.38824 5.30205L3.77553 6.28276L3.26579 5.66624C3.23778 5.63245 3.20308 5.60482 3.16387 5.5851C3.12466 5.56538 3.08178 5.554 3.03795 5.55167C2.99413 5.54934 2.95029 5.55612 2.90921 5.57157C2.86813 5.58702 2.83069 5.61082 2.79926 5.64146C2.49919 5.93182 2.2648 6.2831 2.11186 6.67164C1.95892 7.06019 1.89098 7.47698 1.91262 7.89398C1.91262 8.49072 2.14967 9.06301 2.57162 9.48496C2.99358 9.90692 3.56587 10.144 4.1626 10.144C4.75934 10.144 5.33163 9.90692 5.75358 9.48496C6.17554 9.06301 6.41259 8.49072 6.41259 7.89398M3.01028 6.35586L2.97087 6.40798C2.67197 6.82551 2.52221 7.33145 2.54566 7.84441L2.54757 7.88191C2.54757 8.31007 2.71766 8.7207 3.02042 9.02346C3.32317 9.32621 3.7338 9.4963 4.16197 9.4963C4.59013 9.4963 5.00076 9.32621 5.30352 9.02346C5.60628 8.7207 5.77636 8.31007 5.77636 7.88191L5.77827 7.84504C5.78272 7.80373 5.88187 6.6673 4.84205 5.89442L4.79056 5.85692L4.12701 6.91835C4.09497 6.96954 4.05123 7.01239 3.99939 7.04337C3.94755 7.07435 3.8891 7.09258 3.82884 7.09655C3.76858 7.10052 3.70823 7.09013 3.65278 7.06622C3.59732 7.04231 3.54834 7.00557 3.50985 6.95903L3.01028 6.35586Z"
                                                                                fill="#FEFEFE" />
                                                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                                                d="M3.79701 0.30821C3.81025 0.23997 3.84191 0.176658 3.88858 0.125138C3.93524 0.0736173 3.99512 0.0358558 4.06172 0.0159479C4.12832 -0.00396001 4.1991 -0.00525449 4.26638 0.0122049C4.33367 0.0296642 4.39489 0.0652111 4.4434 0.114991C4.56671 0.240837 4.80378 0.489988 5.04467 0.777274C5.28111 1.05884 5.53916 1.39761 5.68788 1.69951C5.8328 1.99443 5.98661 2.37578 6.10801 2.69421L6.67305 1.75354C6.70456 1.701 6.74826 1.65683 6.80046 1.62476C6.85265 1.59269 6.91181 1.57367 6.97292 1.56931C7.03402 1.56494 7.09528 1.57536 7.1515 1.59969C7.20773 1.62401 7.25727 1.66152 7.29592 1.70905C8.09867 2.70057 8.49846 3.76263 8.6974 4.57365C8.79718 4.97979 8.8474 5.32491 8.87282 5.57025C8.88576 5.69278 8.89424 5.81574 8.89824 5.93889V5.97131C8.89824 8.4482 6.93364 10.4649 4.44785 10.4649C1.96206 10.4649 0 8.44756 0 5.97004C0 5.28805 0.322244 3.68192 1.27563 2.36498C1.31266 2.31422 1.36166 2.27341 1.41826 2.24615C1.47487 2.2189 1.53734 2.20605 1.60011 2.20876C1.66287 2.21146 1.724 2.22963 1.77806 2.26166C1.83211 2.29368 1.87741 2.33856 1.90994 2.39231L2.55507 3.46709C2.75083 3.16073 3.01269 2.73044 3.21163 2.3332C3.49765 1.76117 3.72455 0.682572 3.79701 0.308845M4.3201 0.912655C4.20506 1.42113 4.01501 2.14697 3.77985 2.61858C3.46714 3.24336 3.0165 3.9298 2.86142 4.16051C2.82554 4.21345 2.77693 4.25651 2.72005 4.28574C2.66317 4.31497 2.59986 4.32943 2.53593 4.32778C2.472 4.32614 2.40952 4.30844 2.35422 4.27632C2.29892 4.24421 2.25258 4.1987 2.21948 4.14399L1.57118 3.06476C0.87457 4.19166 0.635589 5.45839 0.635589 5.97131C0.635589 8.10561 2.32244 9.82806 4.44785 9.82806C6.57326 9.82806 8.26265 8.10561 8.26265 5.97131V5.95351L8.26011 5.88995C8.25568 5.80484 8.24911 5.71986 8.24041 5.63508C8.20712 5.3287 8.15362 5.02487 8.08024 4.72555C7.87826 3.89157 7.52027 3.10334 7.02516 2.40248L6.38068 3.47535C6.34338 3.53732 6.28925 3.58743 6.22459 3.61985C6.15993 3.65227 6.08739 3.66566 6.01542 3.65847C5.94344 3.65128 5.87499 3.6238 5.81802 3.57923C5.76105 3.53466 5.71791 3.47483 5.6936 3.40671C5.59064 3.11815 5.33831 2.42917 5.11713 1.98044C5.00463 1.751 4.78916 1.46117 4.55781 1.18596C4.4801 1.09353 4.40086 1.00242 4.3201 0.912655Z"
                                                                                fill="#FEFEFE" />
                                                                        </svg>
                                                                        <span>Top Rated</span>
                                                                    </div>
                                                                </div>
                                                                <div class="ratings">
                                                                    <div><svg xmlns="http://www.w3.org/2000/svg" width="10" height="14"
                                                                            viewBox="0 0 10 14" fill="none">
                                                                            <path
                                                                                d="M5 6.65C4.5264 6.65 4.0722 6.46563 3.73731 6.13744C3.40242 5.80925 3.21429 5.36413 3.21429 4.9C3.21429 4.43587 3.40242 3.99075 3.73731 3.66256C4.0722 3.33437 4.5264 3.15 5 3.15C5.4736 3.15 5.9278 3.33437 6.26269 3.66256C6.59758 3.99075 6.78571 4.43587 6.78571 4.9C6.78571 5.12981 6.73953 5.35738 6.64979 5.5697C6.56004 5.78202 6.42851 5.97493 6.26269 6.13744C6.09687 6.29994 5.90002 6.42884 5.68336 6.51679C5.46671 6.60473 5.2345 6.65 5 6.65ZM5 0C3.67392 0 2.40215 0.516248 1.46447 1.43518C0.526784 2.3541 0 3.60044 0 4.9C0 8.575 5 14 5 14C5 14 10 8.575 10 4.9C10 3.60044 9.47322 2.3541 8.53553 1.43518C7.59785 0.516248 6.32608 0 5 0Z"
                                                                                fill="#FFC97A" />
                                                                        </svg>
                                                                        <p>2.5 mi</p>
                                                                    </div>
                                                                    <div><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                                            viewBox="0 0 14 14" fill="none">
                                                                            <path
                                                                                d="M6.12956 0.660476C6.40354 -0.220161 7.59647 -0.220158 7.87045 0.660479L8.89548 3.95519C9.01801 4.34902 9.36942 4.61566 9.76593 4.61566H13.083C13.9696 4.61566 14.3383 5.80055 13.621 6.34481L10.9374 8.38106C10.6166 8.62446 10.4824 9.0559 10.6049 9.44973L11.63 12.7444C11.9039 13.6251 10.9388 14.3574 10.2215 13.8131L7.53797 11.7769C7.21719 11.5335 6.78282 11.5335 6.46204 11.7769L3.77846 13.8131C3.06117 14.3574 2.09607 13.6251 2.37005 12.7444L3.39508 9.44973C3.51761 9.0559 3.38338 8.62446 3.0626 8.38106L0.37903 6.34481C-0.338258 5.80055 0.0303816 4.61566 0.916998 4.61566H4.23408C4.63058 4.61566 4.98199 4.34902 5.10452 3.95519L6.12956 0.660476Z"
                                                                                fill="#FFC97A" />
                                                                        </svg>
                                                                        <p>4.3</p><span> (20 reviews)</span>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class="modal-booking-meta">

                                                            <div class="modal-meta-item">
                                                                <div class="d-flex align-items-center gap-10">
                                                                    <span>
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="20"
                                                                            height="16" viewBox="0 0 20 16" fill="none">
                                                                            <path
                                                                                d="M16.7801 15.5092V4.90774C16.7801 4.8823 16.7822 4.85737 16.7861 4.83297L13.9198 2.38869C13.3102 1.86965 12.8891 1.51192 12.5318 1.2787C12.1869 1.05357 11.955 0.981548 11.7333 0.981548C11.5117 0.981548 11.2813 1.05383 10.9367 1.2787C10.5794 1.51195 10.1571 1.86936 9.54677 2.38869L6.67838 4.83297C6.68232 4.85747 6.68642 4.8822 6.68642 4.90774V15.5092C6.68599 15.7799 6.45561 16 6.17148 16C5.88754 15.9998 5.65697 15.7798 5.65654 15.5092V5.70333L5.1255 6.15768C4.91349 6.33835 4.5869 6.31948 4.39734 6.11742C4.20853 5.91549 4.2262 5.60589 4.43757 5.42535L8.85884 1.65828H8.86085C9.45081 1.15631 9.92858 0.747109 10.3534 0.469686C10.791 0.184003 11.2255 2.87993e-07 11.7333 0C12.241 0 12.6754 0.183991 13.1132 0.469686C13.5382 0.747176 14.018 1.15613 14.6077 1.65828L19.029 5.42535C19.2403 5.60589 19.258 5.91549 19.0692 6.11742C18.8796 6.31948 18.553 6.33835 18.341 6.15768L17.81 5.70333V15.5092C17.8096 15.7798 17.579 15.9998 17.2951 16C17.0109 16 16.7805 15.7799 16.7801 15.5092Z"
                                                                                fill="#9D9B98" />
                                                                            <path
                                                                                d="M2.33495 8.53426C2.33495 8.16407 2.22966 7.84645 2.07983 7.63201C1.92995 7.41771 1.75582 7.32764 1.6 7.32764C1.44427 7.32777 1.26995 7.41787 1.12017 7.63201C0.970467 7.84645 0.865048 8.16427 0.865048 8.53426C0.865185 8.90438 0.970282 9.22221 1.12017 9.43651C1.26992 9.65054 1.44431 9.73895 1.6 9.73908C1.75569 9.73908 1.93003 9.65044 2.07983 9.43651C2.22972 9.22221 2.33481 8.90438 2.33495 8.53426ZM3.2 8.53426C3.19986 9.08569 3.04508 9.60303 2.77254 9.99272C2.49976 10.3827 2.08915 10.6667 1.6 10.6667C1.11119 10.6666 0.701863 10.3824 0.429145 9.99272C0.156583 9.60302 0.000136435 9.08572 0 8.53426C0 7.98254 0.156463 7.46387 0.429145 7.07399C0.701863 6.68442 1.11129 6.40016 1.6 6.40002C2.08908 6.40002 2.49976 6.68407 2.77254 7.07399C3.04523 7.46387 3.2 7.98254 3.2 8.53426Z"
                                                                                fill="#9D9B98" />
                                                                            <path
                                                                                d="M1.06689 15.5V10.0999C1.06689 9.82382 1.30568 9.59998 1.60023 9.59998C1.89478 9.59998 2.13356 9.82382 2.13356 10.0999V15.5C2.13334 15.776 1.89464 16 1.60023 16C1.30581 16 1.06712 15.776 1.06689 15.5Z"
                                                                                fill="#9D9B98" />
                                                                            <path
                                                                                d="M13.6421 11.9202C13.6421 11.4847 13.6402 11.2082 13.6125 11.0056C13.5868 10.8177 13.5475 10.7688 13.5237 10.7453C13.4999 10.7219 13.4506 10.6814 13.2592 10.656C13.0531 10.6287 12.7707 10.6288 12.3276 10.6288H11.4197C10.9766 10.6288 10.6942 10.6287 10.4882 10.656C10.2968 10.6814 10.2475 10.7219 10.2237 10.7453C10.1999 10.7688 10.1606 10.8177 10.1349 11.0056C10.1072 11.2082 10.1053 11.4847 10.1053 11.9202V15.0041H13.6421V11.9202ZM12.7836 6.94881C13.0622 6.94902 13.2884 7.17187 13.2888 7.44595C13.2888 7.72038 13.0624 7.94288 12.7836 7.94309H10.9638C10.6849 7.94288 10.4586 7.72038 10.4586 7.44595C10.459 7.17187 10.6852 6.94901 10.9638 6.94881H12.7836ZM12.7836 4.26501L12.8842 4.27472C13.1149 4.32077 13.2888 4.52163 13.2888 4.76216C13.2888 5.00269 13.1149 5.20354 12.8842 5.24959L12.7836 5.2593H10.9638C10.6849 5.25909 10.4586 5.03659 10.4586 4.76216C10.4586 4.48772 10.6849 4.26522 10.9638 4.26501H12.7836ZM14.6526 15.0041H18.6947C18.9738 15.0041 19.2 15.2266 19.2 15.5012C19.1996 15.7754 18.9735 15.9983 18.6947 15.9983H0.505263C0.226477 15.9983 0.000425559 15.7754 0 15.5012C0 15.2266 0.226214 15.0041 0.505263 15.0041H9.09474V11.9202C9.09474 11.513 9.09346 11.1577 9.13224 10.8735C9.17309 10.5747 9.26667 10.2811 9.50921 10.0424C9.7519 9.80356 10.0502 9.71164 10.3539 9.67144C10.643 9.6332 11.0053 9.63454 11.4197 9.63454H12.3276C12.742 9.63454 13.1043 9.6332 13.3934 9.67144C13.6972 9.71164 13.9955 9.80356 14.2382 10.0424C14.4807 10.2811 14.5743 10.5747 14.6151 10.8735C14.6539 11.1577 14.6526 11.513 14.6526 11.9202V15.0041Z"
                                                                                fill="#9D9B98" />
                                                                        </svg>
                                                                    </span>
                                                                    <p class="modal-meta-title">Space</p>
                                                                </div>
                                                                <span class="modal-meta-value">Garden / Shed</span>
                                                            </div>
                                                            <hr class="vertical-line">

                                                            <div class="modal-meta-item">
                                                                <div class="d-flex align-items-center gap-10">
                                                                    <span>
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="19"
                                                                            height="17" viewBox="0 0 19 17" fill="none">
                                                                            <path
                                                                                d="M0.5 8.29443C0.5 5.20012 0.5 3.65254 1.50463 2.69167C2.50925 1.7308 4.12506 1.72998 7.35752 1.72998H10.7863C14.0187 1.72998 15.6354 1.72998 16.6392 2.69167C17.6429 3.65337 17.6438 5.20012 17.6438 8.29443V9.93555C17.6438 13.0299 17.6438 14.5774 16.6392 15.5383C15.6345 16.4992 14.0187 16.5 10.7863 16.5H7.35752C4.12506 16.5 2.5084 16.5 1.50463 15.5383C0.500857 14.5766 0.5 13.0299 0.5 9.93555V8.29443Z"
                                                                                stroke="#9D9B98" />
                                                                            <path d="M4.78607 1.73084V0.5M13.358 1.73084V0.5M0.928711 5.83362H17.2153"
                                                                                stroke="#9D9B98" stroke-linecap="round" />
                                                                            <path
                                                                                d="M14.215 12.3978C14.215 12.6155 14.1247 12.8242 13.9639 12.978C13.8032 13.1319 13.5851 13.2184 13.3578 13.2184C13.1305 13.2184 12.9124 13.1319 12.7517 12.978C12.5909 12.8242 12.5006 12.6155 12.5006 12.3978C12.5006 12.1802 12.5909 11.9715 12.7517 11.8176C12.9124 11.6637 13.1305 11.5773 13.3578 11.5773C13.5851 11.5773 13.8032 11.6637 13.9639 11.8176C14.1247 11.9715 14.215 12.1802 14.215 12.3978ZM14.215 9.1156C14.215 9.33323 14.1247 9.54194 13.9639 9.69582C13.8032 9.84971 13.5851 9.93616 13.3578 9.93616C13.1305 9.93616 12.9124 9.84971 12.7517 9.69582C12.5909 9.54194 12.5006 9.33323 12.5006 9.1156C12.5006 8.89798 12.5909 8.68926 12.7517 8.53538C12.9124 8.3815 13.1305 8.29504 13.3578 8.29504C13.5851 8.29504 13.8032 8.3815 13.9639 8.53538C14.1247 8.68926 14.215 8.89798 14.215 9.1156ZM9.92904 12.3978C9.92904 12.6155 9.83873 12.8242 9.67798 12.978C9.51722 13.1319 9.29919 13.2184 9.07185 13.2184C8.84451 13.2184 8.62648 13.1319 8.46573 12.978C8.30497 12.8242 8.21466 12.6155 8.21466 12.3978C8.21466 12.1802 8.30497 11.9715 8.46573 11.8176C8.62648 11.6637 8.84451 11.5773 9.07185 11.5773C9.29919 11.5773 9.51722 11.6637 9.67798 11.8176C9.83873 11.9715 9.92904 12.1802 9.92904 12.3978ZM9.92904 9.1156C9.92904 9.33323 9.83873 9.54194 9.67798 9.69582C9.51722 9.84971 9.29919 9.93616 9.07185 9.93616C8.84451 9.93616 8.62648 9.84971 8.46573 9.69582C8.30497 9.54194 8.21466 9.33323 8.21466 9.1156C8.21466 8.89798 8.30497 8.68926 8.46573 8.53538C8.62648 8.3815 8.84451 8.29504 9.07185 8.29504C9.29919 8.29504 9.51722 8.3815 9.67798 8.53538C9.83873 8.68926 9.92904 8.89798 9.92904 9.1156ZM5.64309 12.3978C5.64309 12.6155 5.55278 12.8242 5.39203 12.978C5.23127 13.1319 5.01324 13.2184 4.7859 13.2184C4.55856 13.2184 4.34053 13.1319 4.17978 12.978C4.01902 12.8242 3.92871 12.6155 3.92871 12.3978C3.92871 12.1802 4.01902 11.9715 4.17978 11.8176C4.34053 11.6637 4.55856 11.5773 4.7859 11.5773C5.01324 11.5773 5.23127 11.6637 5.39203 11.8176C5.55278 11.9715 5.64309 12.1802 5.64309 12.3978ZM5.64309 9.1156C5.64309 9.33323 5.55278 9.54194 5.39203 9.69582C5.23127 9.84971 5.01324 9.93616 4.7859 9.93616C4.55856 9.93616 4.34053 9.84971 4.17978 9.69582C4.01902 9.54194 3.92871 9.33323 3.92871 9.1156C3.92871 8.89798 4.01902 8.68926 4.17978 8.53538C4.34053 8.3815 4.55856 8.29504 4.7859 8.29504C5.01324 8.29504 5.23127 8.3815 5.39203 8.53538C5.55278 8.68926 5.64309 8.89798 5.64309 9.1156Z"
                                                                                fill="#9D9B98" />
                                                                        </svg>
                                                                    </span>
                                                                    <p class="modal-meta-title">Date</p>
                                                                </div>
                                                                <span class="modal-meta-value">18/12/2025</span>
                                                            </div>
                                                            <hr class="vertical-line">

                                                            <div class="modal-meta-item">
                                                                <div class="d-flex align-items-center gap-10">
                                                                    <span>
                                                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
                                                                            <circle cx="8" cy="8" r="6" stroke="#9D9B98"
                                                                                stroke-width="1.5" />
                                                                            <path d="M8 4.5V8L10.5 10" stroke="#9D9B98" stroke-width="1.5"
                                                                                stroke-linecap="round" />
                                                                        </svg>
                                                                    </span>
                                                                    <p class="modal-meta-title">Time</p>
                                                                </div>
                                                                <span class="modal-meta-value">Half-Day (14:30 - 18:30)</span>
                                                            </div>
                                                            <hr class="vertical-line">

                                                            <div class="modal-meta-item">
                                                                <div class="d-flex align-items-center gap-10">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="12"
                                                                        height="16" viewBox="0 0 12 16" fill="none">
                                                                        <path
                                                                            d="M6 0.5C7.4694 0.5 8.87214 1.04525 9.90137 2.00586C10.9293 2.96529 11.4999 4.25871 11.5 5.59961C11.5 7.10011 10.6408 8.95946 9.51855 10.7236C8.41048 12.4655 7.10434 14.0263 6.32227 14.9082C6.14625 15.1067 5.85375 15.1067 5.67773 14.9082C4.89566 14.0263 3.58952 12.4655 2.48145 10.7236C1.35919 8.95946 0.5 7.10011 0.5 5.59961C0.500111 4.25871 1.07068 2.96529 2.09863 2.00586C3.12786 1.04525 4.53061 0.5 6 0.5ZM6 3.09961C5.30978 3.09961 4.64141 3.35564 4.14355 3.82031C3.64466 4.28597 3.35753 4.92517 3.35742 5.59961C3.35742 6.27422 3.64453 6.91413 4.14355 7.37988C4.64141 7.84453 5.30979 8.09961 6 8.09961C6.34236 8.09961 6.68202 8.03695 7 7.91406C7.31807 7.7911 7.60965 7.61022 7.85645 7.37988C8.10326 7.14952 8.30086 6.87397 8.43652 6.56836C8.57224 6.26256 8.64258 5.93289 8.64258 5.59961C8.64247 4.92517 8.35534 4.28597 7.85645 3.82031C7.35859 3.35564 6.69022 3.09961 6 3.09961Z"
                                                                            stroke="#9D9B98" />
                                                                    </svg>
                                                                    <p class="modal-meta-title">Location</p>
                                                                </div>
                                                                <span class="modal-meta-value">Victoria Embankment</span>
                                                            </div>

                                                        </div>

                                                        <div class="modal-pet-selection">

                                                            <div class="modal-pet-card">
                                                                <img src="<?= BASE_URL ?>assets/images/pet_details_2.png" alt="Louis">

                                                                <div class="modal-pet-info">
                                                                    <p class="modal-pet-name"><span><svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                                height="15" viewBox="0 0 16 15" fill="none">
                                                                                <path
                                                                                    d="M8 6.02632C5.73786 6.02632 3.82643 8.06405 3.20929 10.6813C2.93786 11.8323 3.34714 13.0539 4.35179 13.6279C5.14821 14.0829 6.33286 14.5 8 14.5C9.66714 14.5 10.8521 14.0829 11.6486 13.6279C12.6532 13.0539 13.0621 11.8323 12.7907 10.6813C12.1736 8.06368 10.2621 6.02632 8 6.02632ZM0.5 5.45305C0.5 6.47063 1.13929 7.5 1.92857 7.5C2.71786 7.5 3.35714 6.47063 3.35714 5.45305C3.35714 4.43547 2.71786 3.81579 1.92857 3.81579C1.13929 3.81579 0.5 4.43584 0.5 5.45305ZM15.5 5.45305C15.5 6.47063 14.8607 7.5 14.0714 7.5C13.2821 7.5 12.6429 6.47063 12.6429 5.45305C12.6429 4.43547 13.2821 3.81579 14.0714 3.81579C14.8607 3.81579 15.5 4.43584 15.5 5.45305ZM4.25 2.13726C4.25 3.15484 4.88929 4.18421 5.67857 4.18421C6.46786 4.18421 7.10714 3.15484 7.10714 2.13726C7.10714 1.11968 6.46786 0.5 5.67857 0.5C4.88929 0.5 4.25 1.12005 4.25 2.13726ZM11.75 2.13726C11.75 3.15484 11.1107 4.18421 10.3214 4.18421C9.53214 4.18421 8.89286 3.15484 8.89286 2.13726C8.89286 1.11968 9.53214 0.5 10.3214 0.5C11.1107 0.5 11.75 1.12005 11.75 2.13726Z"
                                                                                    stroke="#9D9B98" stroke-linecap="round" stroke-linejoin="round" />
                                                                            </svg></span> Louis</p>
                                                                    <span>Dog • Labrador</span>
                                                                </div>

                                                                <div class="modal-pet-arrow">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48"
                                                                        fill="none">
                                                                        <rect width="48" height="48" rx="24" transform="matrix(1 0 0 -1 0 48)"
                                                                            fill="#E3E3E3" />
                                                                        <path
                                                                            d="M32.7098 24.8277C33.1054 24.4359 33.1048 23.7964 32.7085 23.4053L28.1513 18.9082C27.796 18.5576 27.2233 18.5622 26.8737 18.9185C26.7351 19.0552 26.6797 19.1919 26.7074 19.3286C26.7421 19.4653 26.8182 19.5951 26.936 19.7181L29.9174 22.6397C30.0836 22.8037 30.2394 22.9507 30.3848 23.0805C30.5 23.1833 30.4113 23.3889 30.2577 23.3734C30.0799 23.3554 29.8972 23.3397 29.7096 23.3265C29.3287 23.2992 28.934 23.2855 28.5254 23.2855H15.8355C15.3741 23.2855 15 23.6596 15 24.121C15 24.5824 15.3741 24.9565 15.8355 24.9565H28.5254C28.934 24.9565 29.3322 24.9428 29.72 24.9154C29.9048 24.9024 30.0849 24.8871 30.2602 24.8694C30.416 24.8537 30.504 25.0599 30.3848 25.1615C30.2394 25.2913 30.0836 25.4383 29.9174 25.6023L26.9152 28.5443C26.7905 28.6674 26.7144 28.7972 26.6867 28.9339C26.659 29.0706 26.7109 29.2072 26.8425 29.3439C27.1977 29.7058 27.7795 29.7099 28.1398 29.3531L32.7098 24.8277Z"
                                                                            fill="white" />
                                                                    </svg>
                                                                </div>
                                                            </div>

                                                            <div class="modal-pet-card">
                                                                <img src="<?= BASE_URL ?>assets/images/pet_details_1.png" alt="Bella">

                                                                <div class="modal-pet-info">
                                                                    <p class="modal-pet-name"><span><svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                                height="15" viewBox="0 0 16 15" fill="none">
                                                                                <path
                                                                                    d="M8 6.02632C5.73786 6.02632 3.82643 8.06405 3.20929 10.6813C2.93786 11.8323 3.34714 13.0539 4.35179 13.6279C5.14821 14.0829 6.33286 14.5 8 14.5C9.66714 14.5 10.8521 14.0829 11.6486 13.6279C12.6532 13.0539 13.0621 11.8323 12.7907 10.6813C12.1736 8.06368 10.2621 6.02632 8 6.02632ZM0.5 5.45305C0.5 6.47063 1.13929 7.5 1.92857 7.5C2.71786 7.5 3.35714 6.47063 3.35714 5.45305C3.35714 4.43547 2.71786 3.81579 1.92857 3.81579C1.13929 3.81579 0.5 4.43584 0.5 5.45305ZM15.5 5.45305C15.5 6.47063 14.8607 7.5 14.0714 7.5C13.2821 7.5 12.6429 6.47063 12.6429 5.45305C12.6429 4.43547 13.2821 3.81579 14.0714 3.81579C14.8607 3.81579 15.5 4.43584 15.5 5.45305ZM4.25 2.13726C4.25 3.15484 4.88929 4.18421 5.67857 4.18421C6.46786 4.18421 7.10714 3.15484 7.10714 2.13726C7.10714 1.11968 6.46786 0.5 5.67857 0.5C4.88929 0.5 4.25 1.12005 4.25 2.13726ZM11.75 2.13726C11.75 3.15484 11.1107 4.18421 10.3214 4.18421C9.53214 4.18421 8.89286 3.15484 8.89286 2.13726C8.89286 1.11968 9.53214 0.5 10.3214 0.5C11.1107 0.5 11.75 1.12005 11.75 2.13726Z"
                                                                                    stroke="#9D9B98" stroke-linecap="round" stroke-linejoin="round" />
                                                                            </svg></span> Bella</p>
                                                                    <span>Rabbit • Mini Lop</span>
                                                                </div>

                                                                <div class="modal-pet-arrow">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48"
                                                                        fill="none">
                                                                        <rect width="48" height="48" rx="24" transform="matrix(1 0 0 -1 0 48)"
                                                                            fill="#E3E3E3" />
                                                                        <path
                                                                            d="M32.7098 24.8277C33.1054 24.4359 33.1048 23.7964 32.7085 23.4053L28.1513 18.9082C27.796 18.5576 27.2233 18.5622 26.8737 18.9185C26.7351 19.0552 26.6797 19.1919 26.7074 19.3286C26.7421 19.4653 26.8182 19.5951 26.936 19.7181L29.9174 22.6397C30.0836 22.8037 30.2394 22.9507 30.3848 23.0805C30.5 23.1833 30.4113 23.3889 30.2577 23.3734C30.0799 23.3554 29.8972 23.3397 29.7096 23.3265C29.3287 23.2992 28.934 23.2855 28.5254 23.2855H15.8355C15.3741 23.2855 15 23.6596 15 24.121C15 24.5824 15.3741 24.9565 15.8355 24.9565H28.5254C28.934 24.9565 29.3322 24.9428 29.72 24.9154C29.9048 24.9024 30.0849 24.8871 30.2602 24.8694C30.416 24.8537 30.504 25.0599 30.3848 25.1615C30.2394 25.2913 30.0836 25.4383 29.9174 25.6023L26.9152 28.5443C26.7905 28.6674 26.7144 28.7972 26.6867 28.9339C26.659 29.0706 26.7109 29.2072 26.8425 29.3439C27.1977 29.7058 27.7795 29.7099 28.1398 29.3531L32.7098 24.8277Z"
                                                                            fill="white" />
                                                                    </svg>
                                                                </div>
                                                            </div>

                                                        </div>

                                                        <div class="map-div mt-4">
                                                            <img src="<?= BASE_URL ?>assets/images/modal_map.png" class="map-image" alt="">
                                                        </div>

                                                        <div class="amenities-section">

                                                            <h3>Amenities Include</h3>

                                                            <div class="amenities-list">
                                                                <p><span><svg xmlns="http://www.w3.org/2000/svg" width="12" height="9"
                                                                            viewBox="0 0 12 9" fill="none">
                                                                            <path d="M0.75 4.75L4.25 8.25L11.25 0.75" stroke="#3B3731"
                                                                                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                                        </svg></span> Grooming Table</p>
                                                                <p><span><svg xmlns="http://www.w3.org/2000/svg" width="12" height="9"
                                                                            viewBox="0 0 12 9" fill="none">
                                                                            <path d="M0.75 4.75L4.25 8.25L11.25 0.75" stroke="#3B3731"
                                                                                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                                        </svg></span> Bath</p>
                                                                <p><span><svg xmlns="http://www.w3.org/2000/svg" width="12" height="9"
                                                                            viewBox="0 0 12 9" fill="none">
                                                                            <path d="M0.75 4.75L4.25 8.25L11.25 0.75" stroke="#3B3731"
                                                                                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                                        </svg></span> Dryer</p>
                                                                <p><span><svg xmlns="http://www.w3.org/2000/svg" width="12" height="9"
                                                                            viewBox="0 0 12 9" fill="none">
                                                                            <path d="M0.75 4.75L4.25 8.25L11.25 0.75" stroke="#3B3731"
                                                                                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                                        </svg></span> Towels</p>
                                                                <p><span><svg xmlns="http://www.w3.org/2000/svg" width="12" height="9"
                                                                            viewBox="0 0 12 9" fill="none">
                                                                            <path d="M0.75 4.75L4.25 8.25L11.25 0.75" stroke="#3B3731"
                                                                                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                                        </svg></span> Waiting area</p>
                                                                <p><span><svg xmlns="http://www.w3.org/2000/svg" width="12" height="9"
                                                                            viewBox="0 0 12 9" fill="none">
                                                                            <path d="M0.75 4.75L4.25 8.25L11.25 0.75" stroke="#3B3731"
                                                                                stroke-width="1.5" stroke-linecap="round" stroke-linejoin("round") />
                                                                        </svg></span> Parking</p>
                                                                <p><span>✔</span> Wi-Fi</p>
                                                            </div>

                                                            <p class="amenities-desc">
                                                                Extra towels · Premium shampoos · Drying crates · Tool storage (where available).
                                                            </p>

                                                            <div class="d-flex align-items-center justify-content-center">
                                                                <div class="access-info">
                                                                    <h4>Access information</h4>
                                                                    <p>
                                                                        You'll receive the exact address and access instructions closer to your booking
                                                                        time via email and in your booking details.
                                                                    </p>
                                                                </div>
                                                            </div>


                                                        </div>

                                                        <div class="modal-booking-next">

                                                            <div class="modal-next-left">
                                                                <h3>What happens next?</h3>

                                                                <ul class="list-style-default">
                                                                    <li>The groomer and space host have both been notified.</li>
                                                                    <li>You’ll receive the exact address and access instructions closer to your booking
                                                                        time via email and in your booking details.</li>
                                                                    <li>You can manage or cancel your bookings from your account.</li>
                                                                </ul>
                                                            </div>

                                                            <div class="modal-next-right">
                                                                <p class="modal-total">Total <span>£158.00</span></p>
                                                            </div>

                                                        </div>

                                                        <div class="card-actions d-flex justify-content-center gap-20 mt-5">
                                                            <a href="<?= BASE_URL ?>/my_bookings/change_space_booking.php" class="btn-outline medium-light-font text-center">Change Booking</a>
                                                            <a href="<?= BASE_URL ?>messages_notification/messages.php" class="btn-green text-center medium-light-font">Message Host</a>
                                                        </div>


                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="booking-footer">
                                            <div class="cancel-policy">
                                                <a href="<?= BASE_URL ?>my_bookings/cancelled_bookings.php">Cancel Booking</a>
                                                <p>Free cancellations up to 24 hours before appointment.</p>
                                            </div>
                                            <a href="<?= BASE_URL ?>profile_pets_preferences/company_information.php#tab-terms-conditions" class="view-policy">View cancellation policy</a>
                                        </div>

                                        <div class="help-text d-flex align-items-center justify-content-center gap-10 mt-5">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="34" height="28" viewBox="0 0 34 28" fill="none">
                                                <path
                                                    d="M3.08333 13.875C1.3875 13.875 0 12.4875 0 10.7917V3.08333C0 1.3875 1.3875 0 3.08333 0H15.4167C17.1125 0 18.5 1.3875 18.5 3.08333V10.7917C18.5 12.4875 17.1125 13.875 15.4167 13.875H12.3333V18.5L7.70833 13.875H3.08333ZM30.8333 23.125C32.5292 23.125 33.9167 21.7375 33.9167 20.0417V12.3333C33.9167 10.6375 32.5292 9.25 30.8333 9.25H21.5833V10.7917C21.5833 14.1833 18.8083 16.9583 15.4167 16.9583V20.0417C15.4167 21.7375 16.8042 23.125 18.5 23.125H21.5833V27.75L26.2083 23.125H30.8333Z"
                                                    fill="#D8E8B7" />
                                            </svg> Need help? Chat with <a class="view-policy" style="font-weight:600" href="#" data-open-chat>Fursgo Support</a>.
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Up Coming Space Booking Modal  -->

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
                                                    <path d="M3.2 6.2A5.5 5.5 0 0 1 12.8 5.1M12.8 9.8A5.5 5.5 0 0 1 3.2 10.9" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" />
                                                    <path d="M12.8 2.5V5.3H10M3.2 13.5V10.7H6" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round" />
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
                                                    <path d="M3.2 6.2A5.5 5.5 0 0 1 12.8 5.1M12.8 9.8A5.5 5.5 0 0 1 3.2 10.9" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" />
                                                    <path d="M12.8 2.5V5.3H10M3.2 13.5V10.7H6" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round" />
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
                                            <button type="button" class="mb-btn"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="14" viewBox="0 0 18 14" fill="none">
                                                    <path d="M1.5 7C1.5 7 4.1 1.5 9 1.5C13.9 1.5 16.5 7 16.5 7C16.5 7 13.9 12.5 9 12.5C4.1 12.5 1.5 7 1.5 7Z" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round" />
                                                    <circle cx="9" cy="7" r="2.25" stroke="currentColor" stroke-width="1.4" />
                                                </svg> View details</button>
                                            <a href="<?= BASE_URL ?>profiles/groomer/groomer_profile.php" class="mb-btn mb-btn--blue"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                                    <path d="M3.2 6.2A5.5 5.5 0 0 1 12.8 5.1M12.8 9.8A5.5 5.5 0 0 1 3.2 10.9" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" />
                                                    <path d="M12.8 2.5V5.3H10M3.2 13.5V10.7H6" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round" />
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
                                            <button type="button" class="mb-btn"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="14" viewBox="0 0 18 14" fill="none">
                                                    <path d="M1.5 7C1.5 7 4.1 1.5 9 1.5C13.9 1.5 16.5 7 16.5 7C16.5 7 13.9 12.5 9 12.5C4.1 12.5 1.5 7 1.5 7Z" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round" />
                                                    <circle cx="9" cy="7" r="2.25" stroke="currentColor" stroke-width="1.4" />
                                                </svg> View details</button>
                                            <a href="<?= BASE_URL ?>profiles/space/space_profile.php" class="mb-btn mb-btn--blue"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                                    <path d="M3.2 6.2A5.5 5.5 0 0 1 12.8 5.1M12.8 9.8A5.5 5.5 0 0 1 3.2 10.9" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" />
                                                    <path d="M12.8 2.5V5.3H10M3.2 13.5V10.7H6" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round" />
                                                </svg> Rebook</a>
                                        </div>
                                    </div>
                                </article>
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

                                                <div data-modal-close class="position-absolute top-0 end-0">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 36 36" fill="none">
                                                        <circle cx="18" cy="18" r="17.5" stroke="#3B3731" />
                                                        <path d="M12.8 24.0008L24 12.8008M12.8 12.8008L24 24.0008" stroke="#3B3731" stroke-width="1.5" stroke-linecap="round" />
                                                    </svg>
                                                </div>
                                                <style>
                                                    [data-modal-close] {
                                                        position: absolute;
                                                        /* top: 10px; */
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