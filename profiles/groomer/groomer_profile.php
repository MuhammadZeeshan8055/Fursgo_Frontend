<?php include '../../function_helper.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FursGo - Groomer Profile</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/responsive.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/bootstrap.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/media_query.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/groomer_space_profile.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/common.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <style>
        /* Apply grayscale filter only to tiles, not markers */
        #map .leaflet-tile {
            filter: grayscale(100%) brightness(1.08) contrast(0.95) saturate(0%);
        }

        .leaflet-top.leaflet-left {
            display: none;
        }

        .inverted-radius {
            --r: 21px;
            --s: 18px;
            --x: 222px;
            --y: 38px;
            width: 100%;
            aspect-ratio: 1;
            border-radius: var(--r);
            --_m: /calc(2*var(--r)) calc(2*var(--r)) radial-gradient(#000 70%, #0000 72%);
            --_g: conic-gradient(at var(--r) var(--r), #000 75%, #0000 0);
            --_d: (var(--s) + var(--r));
            mask: calc(var(--_d) + var(--x)) 0 var(--_m), 0 calc(var(--_d) + var(--y)) var(--_m), radial-gradient(var(--s) at 0 0, #0000 99%, #000 calc(100% + 1px)) calc(var(--r) + var(--x)) calc(var(--r) + var(--y)), var(--_g) calc(var(--_d) + var(--x)) 0, var(--_g) 0 calc(var(--_d) + var(--y));
            mask-repeat: no-repeat;
        }


        #map {
            border-bottom-left-radius: var(--r);
            border-bottom-right-radius: var(--r);
        }

        /* modal css starts */
        #groomer_book_space .modal-content {
            width: 1200px;
            height: auto;
            background: #FDFCF8;
            padding: 45px;
        }

        .modal-top-card {
            border-radius: 10px;
            background: rgba(217, 217, 217, 0.13);
            padding: 10px 22px;
        }

        .name-reviews {
            width: 25%;
        }

        .modal-card-right-section,
        .details-section {
            width: 100%;
        }

        /* modal css ends */


        /* mid section css starts */
        .heading-count span.count {
            padding: 2px 0 0 0;
            border-radius: 100px;
            background: #F8F8F8;
            width: 36px;
            height: 24px;
            text-align: center;
            color: #999794;
            font-family: Lato;
            font-size: 14px;
            font-style: normal;
            font-weight: 500;
            line-height: normal;
        }

        .groomer-tabs {
            display: flex;
            gap: 1.5em 1em;
            height: 48px;
            border-radius: 75px;
            background: #F7F7F5;
            padding: 1.5px;
        }

        .groomer-tabs a.active {
            background: var(--groomer-color);
            color: #fff;
            animation: shake 0.3s;
        }

        /* Shake keyframes */
        @keyframes shake {
            0% {
                transform: translateX(0);
            }

            25% {
                transform: translateX(-3px);
            }

            50% {
                transform: translateX(3px);
            }

            75% {
                transform: translateX(-3px);
            }

            100% {
                transform: translateX(0);
            }
        }

        .groomer-tabs a {
            border-radius: 75px;
            color: rgba(59, 55, 49, 0.50);
            text-align: center;
            font-family: Lato;
            font-size: 18px;
            font-style: normal;
            font-weight: 400;
            line-height: normal;
            padding: 10px;
            display: block;
            height: 44px;
            width: 155px;
            cursor: pointer;
        }

        /* venu-sorting-section */

        .sort-by,
        .venue-selection {
            position: relative;
            display: flex;
            align-items: center;
        }

        .venue-selection,
        .sort-by {
            border-radius: 100px;
            color: var(--groomer-color);
            border: 1px solid var(--groomer-color);
            padding: 10px 20px 10px 20px;
            text-align: center;
            font-family: "Lato";
            font-size: 14px;
            font-style: normal;
            font-weight: 500;
            line-height: normal;
            cursor: pointer;
            height: 32px;
        }

        /* venu-sorting-section */



        .filter .selected-item {
            border-radius: 100px;
            /* border: 1px solid var(--groomer-color);
            background: var(--groomer-color); */
            padding: 10px 20px 10px 20px;
            color: var(--groomer-color);
            text-align: center;
            font-family: Lato;
            font-size: 14px;
            font-weight: 500;
            background: #fff;
            color: var(--groomer-color) !important;
            padding: 10px;
        }


        /* mid section css Ends */






        /* card css  */

        .card {
            width: 100%;
            display: flex;
            gap: 10px;
            background: #FFF;
            border-radius: 16px;
            padding: 18px;
            border: 1px solid #D4D4D4;
            cursor: pointer;
        }

        .card:hover {
            border: 1px solid var(--active-bg);
            box-shadow: 0 5px 20px 0 rgba(0, 0, 0, 0.15);
        }

        /* map card styling */

        .custom-popup .leaflet-popup-content-wrapper {
            padding: 12px;
            border-radius: 5px;
            background: #FFF;
            box-shadow: 0 0 8px 0 rgba(0, 0, 0, 0.05);
        }

        .custom-popup .leaflet-popup-content {
            margin: 0;
            min-width: 200px;
        }

        .custom-popup .leaflet-popup-tip {
            background: white;
        }

        .map-top-left-svg {
            position: absolute;
            top: -1px;
            left: 10px;
        }

        a.leaflet-popup-close-button {
            display: none;
        }

        .leaflet-popup.custom-popup.leaflet-zoom-animated {
            bottom: 8px !important;
        }

        /* map card styling */


        .card .left {
            width: 180px;
            min-width: 170px;
            display: flex;
            align-items: flex-start;
            position: relative
        }

        .card .left image {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .card .top-left-svg {
            position: absolute;
            left: 6%;
            top: 1%;
        }

        .card .right {
            flex: 1;
        }

        .card .top-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .card .tags {
            display: flex;
            gap: 10px
        }

        .card .tag {
            background: #FFA899;
            border: 1px solid rgba(246, 168, 127, 0.15);
            color: #FFF;
            padding: 6px 10px;
            border-radius: 999px;
            text-align: center;
            font-family: "Lato";
            font-size: 14px;
            font-style: normal;
            font-weight: 400;
            line-height: normal;
        }

        .icons button.first-icon,
        .icons button.second-icon,
        .icons button.third-icon {
            width: 24px;
            height: 24px;
            padding: 0;
            border: none;
            border-radius: 50%;
        }

        .icons button.first-icon {
            background: #cbdce8;
        }

        .icons button.second-icon {
            background: #ffa899;
        }

        .icons button.third-icon {
            background: #D8E8B7;
        }


        .card .name {
            color: var(--font-color);
            font-family: "Lato";
            font-size: 20px;
            font-style: normal;
            font-weight: 600;
            line-height: normal;
            margin: 10px 0 0px;
        }

        .card .studio {
            color: #9D9B98;
            font-family: "Lato";
            font-size: 14px;
            font-style: normal;
            font-weight: 400;
            line-height: normal;
        }

        .card .meta {
            display: flex;
            gap: 14px;
            align-items: center;
            color: var(--font-color);
            font-family: "Lato";
            font-size: 14px;
            font-style: normal;
            font-weight: 500;
            line-height: normal;
        }

        .card .meta .distance {
            display: flex;
            align-items: center;
            gap: 6px
        }

        .card .meta .rating {
            display: flex;
            align-items: center;
            gap: 6px
        }

        .experience {
            margin: 25px 0 25px 0;
            color: var(--font-color);
            font-family: "Lato";
            font-size: 14px;
            font-style: normal;
            font-weight: 400;
            line-height: normal;
        }

        .availability {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-top: 6px;
            color: #BACF8E;
            font-family: "Lato";
            font-size: 14px;
            font-style: normal;
            font-weight: 500;
            line-height: normal;

        }

        .slots {
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 8px;
            width: 100%;
            max-width: 278px;
        }

        #groomer-list-view .slots {
            width: 100%;
        }

        #groomer-list-view .price {
            width: 12%;
        }

        #groomer-list-view .name {
            margin: 20px 0 0px;
        }

        #groomer-list-view .slots {
            width: 100%;
        }

        .slot {
            color: #BACF8E;
            text-align: center;
            font-family: "Lato";
            font-size: 14px;
            font-style: normal;
            font-weight: 400;
            line-height: normal;
            border-radius: 68px;
            border: 1px solid #BACF8E;
            /* padding: 5px 10px 5px 10px; */
            padding: 5px;
        }

        .slot.highlight {
            background-color: #D1E3A6;
            color: #FFF;
            border: none;
        }

        .slot {
            background-color: #fff;
        }

        .price {
            color: var(--font-color);
            font-family: "Lato";
            font-size: 20px;
            font-style: normal;
            font-weight: 600;
            line-height: normal;
            margin-left: auto;
            align-self: end;
        }

        .price span:not(.time-frame) {
            text-decoration-line: underline;
            text-decoration-style: solid;
            text-decoration-skip-ink: auto;
            text-decoration-thickness: auto;
            text-underline-offset: auto;
            text-underline-position: from-font;
        }

        button.load-more {
            padding: 10px 20px;
            border-radius: 75px;
            border: 1px solid var(--font-color);
            background: none;
            color: var(--font-color);
            text-align: center;
            font-family: "Lato";
            font-size: 18px;
            font-style: normal;
            font-weight: 600;
            line-height: normal;
            cursor: pointer;
        }

        /* space cards  */

        .space-cards.card,
        .space-cards-list-view.card {
            gap: 20px;
        }

        .space-cards .left {
            width: 100%;
        }

        .space-cards .top-left-svg {
            position: absolute;
            left: 2%;
            top: 1%;
        }

        .space-cards .slots {
            width: 60%;
        }

        .space-cards .price {
            margin-top: 10px;
            margin-left: 0;
            align-self: flex-start;
        }

        .space-cards-list-view .price {
            margin-left: auto;
            align-self: auto;
        }

        .list-view-desc {
            color: var(--font-color);
            font-family: Lato;
            font-size: 14px;
            font-style: normal;
            font-weight: 400;
            line-height: normal;
        }

        .space-cards-list-view.specific .list-view-desc {
            padding: 44px 0 44px 0;
        }

        .card.specific .price {
            margin-left: auto;
            align-self: auto;
        }

        .card.specific .left {
            width: auto;
        }

        .hosted-by {
            color: var(--font-color);
            font-family: Lato;
            font-size: 14px;
            font-style: normal;
            font-weight: 400;
            line-height: normal;
        }

        .hosted-by span {
            color: #9D9B98;
            font-family: Lato;
            font-size: 14px;
            font-style: normal;
            font-weight: 400;
            line-height: normal;
        }

        .time-frame {
            color: #9D9B98;
            font-family: Lato;
            font-size: 14px;
            font-style: normal;
            font-weight: 600;
            line-height: normal;
        }

        .amenities {
            color: var(--font-color);
            font-family: Lato;
            font-size: 14px;
            font-style: normal;
            font-weight: 400;
            line-height: normal;
        }

        .space-cards-list-view .left {
            width: auto;
        }

        .space-cards-list-view .list-view-desc {
            padding: 15px 0 15px 0;
        }

        .space-cards-list-view p.amenities.d-flex {
            padding: 10px 0;
        }

        .space-cards-list-view .top-left-svg {
            position: absolute;
            left: 2%;
            top: 1%;
        }

        /* space cards css end */

        .space-scroll-wrapper {
            position: relative;
            overflow: hidden;
            width: 100%;
        }

        .space-scroll {
            overflow-x: auto;
            overflow-y: hidden;
            scrollbar-width: none;
        }

        .space-scroll::-webkit-scrollbar {
            display: none;
        }

        /* bottom controls */
        .scroll-controls {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-top: 14px;
        }

        /* arrows */
        .scroll-btn {
            background: none;
            border: none;
            padding: 0;
            cursor: pointer;
            z-index: 2;
        }

        /* track */
        .scroll-track {
            position: relative;
            flex: 1;
            height: 5px;
            background: #eee;
            border-radius: 10px;
            pointer-events: none;
            /* allow clicks to pass through */
        }

        /* progress bar */
        .scroll-progress {
            position: absolute;
            top: 0;
            left: 0;
            height: 5px;
            border-radius: 21px;
            background: #FFC97A;
            min-width: 40px;
        }

        .map-image {
            height: 550px;
            aspect-ratio: 107 / 32;
            border-radius: 10px 0 0 10px;
            object-fit: none;
        }
    </style>
</head>

<body class="groomer-profile">

    <?php include '../../components/header.php' ?>





    <div class="container mt-5" style="padding: 0 80px">

        <button class="book-btn" data-modal-open="groomer_book_space">Book a Space for Your Groomer</button>

        <!-- Modal 1 -->

        <div class="modal" id="groomer_book_space">
            <div class="modal-content">
                <div class="d-flex align-items-center justify-content-between">
                    <button type="button" class="btn-custom btn-no-bg text-center" id="goBack" onclick="nextPrev(-1)" fdprocessedid="y45oyo" style="display: inline;">Go Back</button>
                    <div>
                        <h1 class="large-font line-default">Book a Space for Your Groomer</h1>
                        <p class="normal-light-color text-center">Please select a space.</p>
                    </div>
                    <svg data-modal-close class="cursor" xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 36 36" fill="none">
                        <circle cx="18" cy="18" r="17.5" stroke="#3B3731" />
                        <path d="M12.8 23.9998L24 12.7998M12.8 12.7998L24 23.9998" stroke="#3B3731" stroke-width="1.5" stroke-linecap="round" />
                    </svg>
                </div>

                <div class="modal-top-card d-flex align-items-center mt-5 gap-20">
                    <div class="modal-card-left-section">
                        <div class="avatar-wrap">
                            <img class="avatar" src="<?= BASE_URL ?>assets/images/groomer-profile.png" alt="Sarah's avatar">
                            <div class="badge-shield" title="Verified">
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="33" viewBox="0 0 30 33" fill="none">
                                    <ellipse cx="15.873" cy="16.5256" rx="9.3645" ry="8.81365" fill="white"></ellipse>
                                    <path d="M15.44 0.185076C15.1841 0.0638192 14.9099 0 14.6235 0C14.3372 0 14.063 0.0638192 13.8071 0.185076L2.3337 5.28423C0.993208 5.87775 -0.00606541 7.26263 2.77146e-05 8.93469C0.0304934 15.2656 2.51649 26.8487 13.015 32.1138C14.0325 32.6244 15.2146 32.6244 16.2321 32.1138C26.7306 26.8487 29.2166 15.2656 29.247 8.93469C29.2531 7.26263 28.2539 5.87775 26.9134 5.28423L15.44 0.185076ZM8.82897 18.2651C9.12144 18.3416 9.43219 18.3799 9.74903 18.3799C11.8999 18.3799 13.6486 16.5483 13.6486 14.2955V10.2111H16.3418C17.0791 10.2111 17.7554 10.645 18.0844 11.3407L18.5231 12.2533H22.4227C22.9589 12.2533 23.3976 12.7128 23.3976 13.2744V15.3166C23.3976 18.1374 21.2163 20.4222 18.5231 20.4222H15.5984V23.6578C15.5984 24.1237 15.2389 24.5066 14.7881 24.5066C14.6784 24.5066 14.5687 24.4811 14.4712 24.4364L8.45729 21.7368C8.05514 21.5581 7.79923 21.1433 7.79923 20.6902C7.79923 20.5115 7.83579 20.3392 7.915 20.1796L8.82897 18.2651ZM8.77413 10.2111H11.6988V14.2955C11.6988 15.4251 10.8275 16.3377 9.74903 16.3377C8.67055 16.3377 7.79923 15.4251 7.79923 14.2955V11.2322C7.79923 10.6706 8.23794 10.2111 8.77413 10.2111ZM16.5733 13.2744C16.5733 13.0036 16.4706 12.7439 16.2878 12.5524C16.105 12.3609 15.857 12.2533 15.5984 12.2533C15.3399 12.2533 15.0919 12.3609 14.9091 12.5524C14.7262 12.7439 14.6235 13.0036 14.6235 13.2744C14.6235 13.5452 14.7262 13.8049 14.9091 13.9964C15.0919 14.1879 15.3399 14.2955 15.5984 14.2955C15.857 14.2955 16.105 14.1879 16.2878 13.9964C16.4706 13.8049 16.5733 13.5452 16.5733 13.2744Z" fill="#C9DDA0"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="modal-card-right-section d-flex align-items-center gap-45">

                        <div class="name-reviews d-flex flex-column gap-10">
                            <div>
                                <p class="dark-color-font">Sarah’s Grooming Studio</p>
                                <p class="dark-color-font muted-color">Sarah W.</p>
                            </div>
                            <div class="star-rating d-flex gap-5">
                                <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 17 17" fill="none">
                                    <path d="M7.44303 0.802006C7.77572 -0.267338 9.22428 -0.267334 9.55697 0.80201L10.8017 4.80273C10.9504 5.28095 11.3772 5.60473 11.8586 5.60473H15.8865C16.9631 5.60473 17.4107 7.04353 16.5397 7.70442L13.2811 10.177C12.8916 10.4726 12.7286 10.9964 12.8774 11.4747L14.1221 15.4754C14.4548 16.5447 13.2829 17.434 12.4119 16.7731L9.15324 14.3005C8.76373 14.0049 8.23628 14.0049 7.84676 14.3005L4.58813 16.7731C3.71714 17.434 2.54523 16.5447 2.87792 15.4754L4.1226 11.4747C4.27139 10.9964 4.1084 10.4726 3.71888 10.177L0.46025 7.70442C-0.410741 7.04353 0.036892 5.60473 1.1135 5.60473H5.14138C5.62285 5.60473 6.04956 5.28095 6.19835 4.80273L7.44303 0.802006Z" fill="#FFC97A" />
                                </svg>
                                <p class="light-color-font font-color">4.3 <span class="muted-color">(10 reviews)</span></p>
                            </div>
                        </div>

                        <div class="details-section d-flex align-items-center justify-content-between">
                            <div class="details">
                                <div class="d-flex align-items-center gap-10">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="15" viewBox="0 0 14 15" fill="none">
                                        <path d="M4.38016 10.1726C5.50473 11.2972 8.23986 10.3857 10.489 8.13624C12.7385 5.88709 13.65 3.15197 12.5254 2.02739M7.68909 1.26352L8.1981 1.77289M5.90755 3.04541L6.41656 3.55442M4.3798 5.08182L4.88881 5.59083M3.87079 7.62723L4.3798 8.13624M10.489 0.5L10.998 1.00901M9.97999 3.55478L10.998 4.5728M8.19846 5.33668L9.21648 6.3547M6.16206 6.86371L7.18008 7.88173" stroke="#9D9B98" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M4.3799 11.7001C4.80164 11.2783 4.80164 10.5946 4.3799 10.1728C3.95816 9.75107 3.27438 9.75107 2.85264 10.1728L0.81629 12.2092C0.394548 12.6309 0.394549 13.3147 0.81629 13.7364C1.23803 14.1582 1.92181 14.1582 2.34355 13.7364L4.3799 11.7001Z" stroke="#9D9B98" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <p class="light-bold-color-font">Service</p>
                                </div>
                                <p class="simple-font mt-1">Full Groom</p>
                            </div>
                            <div class="details">
                                <div class="d-flex align-items-center gap-10">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="15" viewBox="0 0 16 15" fill="none">
                                        <path d="M0.5 7.32073C0.5 4.61335 0.5 3.2593 1.379 2.41858C2.258 1.57787 3.67175 1.57715 6.5 1.57715H9.5C12.3282 1.57715 13.7427 1.57715 14.621 2.41858C15.4992 3.26002 15.5 4.61335 15.5 7.32073V8.75663C15.5 11.464 15.5 12.8181 14.621 13.6588C13.742 14.4995 12.3282 14.5002 9.5 14.5002H6.5C3.67175 14.5002 2.25725 14.5002 1.379 13.6588C0.50075 12.8173 0.5 11.464 0.5 8.75663V7.32073Z" stroke="#9D9B98" />
                                        <path d="M4.25 1.57692V0.5M11.75 1.57692V0.5M0.875 5.16666H15.125" stroke="#9D9B98" stroke-linecap="round" />
                                        <path d="M12.5 10.9101C12.5 11.1005 12.421 11.2831 12.2803 11.4177C12.1397 11.5524 11.9489 11.628 11.75 11.628C11.5511 11.628 11.3603 11.5524 11.2197 11.4177C11.079 11.2831 11 11.1005 11 10.9101C11 10.7196 11.079 10.537 11.2197 10.4024C11.3603 10.2677 11.5511 10.1921 11.75 10.1921C11.9489 10.1921 12.1397 10.2677 12.2803 10.4024C12.421 10.537 12.5 10.7196 12.5 10.9101ZM12.5 8.03826C12.5 8.22867 12.421 8.41128 12.2803 8.54593C12.1397 8.68057 11.9489 8.75621 11.75 8.75621C11.5511 8.75621 11.3603 8.68057 11.2197 8.54593C11.079 8.41128 11 8.22867 11 8.03826C11 7.84785 11.079 7.66524 11.2197 7.53059C11.3603 7.39595 11.5511 7.32031 11.75 7.32031C11.9489 7.32031 12.1397 7.39595 12.2803 7.53059C12.421 7.66524 12.5 7.84785 12.5 8.03826ZM8.75 10.9101C8.75 11.1005 8.67098 11.2831 8.53033 11.4177C8.38968 11.5524 8.19891 11.628 8 11.628C7.80109 11.628 7.61032 11.5524 7.46967 11.4177C7.32902 11.2831 7.25 11.1005 7.25 10.9101C7.25 10.7196 7.32902 10.537 7.46967 10.4024C7.61032 10.2677 7.80109 10.1921 8 10.1921C8.19891 10.1921 8.38968 10.2677 8.53033 10.4024C8.67098 10.537 8.75 10.7196 8.75 10.9101ZM8.75 8.03826C8.75 8.22867 8.67098 8.41128 8.53033 8.54593C8.38968 8.68057 8.19891 8.75621 8 8.75621C7.80109 8.75621 7.61032 8.68057 7.46967 8.54593C7.32902 8.41128 7.25 8.22867 7.25 8.03826C7.25 7.84785 7.32902 7.66524 7.46967 7.53059C7.61032 7.39595 7.80109 7.32031 8 7.32031C8.19891 7.32031 8.38968 7.39595 8.53033 7.53059C8.67098 7.66524 8.75 7.84785 8.75 8.03826ZM5 10.9101C5 11.1005 4.92098 11.2831 4.78033 11.4177C4.63968 11.5524 4.44891 11.628 4.25 11.628C4.05109 11.628 3.86032 11.5524 3.71967 11.4177C3.57902 11.2831 3.5 11.1005 3.5 10.9101C3.5 10.7196 3.57902 10.537 3.71967 10.4024C3.86032 10.2677 4.05109 10.1921 4.25 10.1921C4.44891 10.1921 4.63968 10.2677 4.78033 10.4024C4.92098 10.537 5 10.7196 5 10.9101ZM5 8.03826C5 8.22867 4.92098 8.41128 4.78033 8.54593C4.63968 8.68057 4.44891 8.75621 4.25 8.75621C4.05109 8.75621 3.86032 8.68057 3.71967 8.54593C3.57902 8.41128 3.5 8.22867 3.5 8.03826C3.5 7.84785 3.57902 7.66524 3.71967 7.53059C3.86032 7.39595 4.05109 7.32031 4.25 7.32031C4.44891 7.32031 4.63968 7.39595 4.78033 7.53059C4.92098 7.66524 5 7.84785 5 8.03826Z" fill="#9D9B98" />
                                    </svg>
                                    <p class="light-bold-color-font">Date</p>
                                </div>
                                <p class="simple-font mt-1">18/12/2025</p>
                            </div>
                            <div class="details">
                                <div class="d-flex align-items-center gap-10">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                                        <path d="M7 0.5C10.59 0.5 13.5 3.41004 13.5 7C13.5 10.59 10.59 13.5 7 13.5C3.41004 13.5 0.5 10.59 0.5 7C0.5 3.41004 3.41004 0.5 7 0.5Z" stroke="#9D9B98" stroke-linecap="round" />
                                    </svg>
                                    <p class="light-bold-color-font">Time</p>
                                </div>
                                <p class="simple-font mt-1">14:30 - 15:30 (90 mins)</p>
                            </div>
                            <div class="details">
                                <div class="d-flex align-items-center gap-10">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="15" viewBox="0 0 16 15" fill="none">
                                        <path d="M8 6.02632C5.73786 6.02632 3.82643 8.06405 3.20929 10.6813C2.93786 11.8323 3.34714 13.0539 4.35179 13.6279C5.14821 14.0829 6.33286 14.5 8 14.5C9.66714 14.5 10.8521 14.0829 11.6486 13.6279C12.6532 13.0539 13.0621 11.8323 12.7907 10.6813C12.1736 8.06368 10.2621 6.02632 8 6.02632ZM0.5 5.45305C0.5 6.47063 1.13929 7.5 1.92857 7.5C2.71786 7.5 3.35714 6.47063 3.35714 5.45305C3.35714 4.43547 2.71786 3.81579 1.92857 3.81579C1.13929 3.81579 0.5 4.43584 0.5 5.45305ZM15.5 5.45305C15.5 6.47063 14.8607 7.5 14.0714 7.5C13.2821 7.5 12.6429 6.47063 12.6429 5.45305C12.6429 4.43547 13.2821 3.81579 14.0714 3.81579C14.8607 3.81579 15.5 4.43584 15.5 5.45305ZM4.25 2.13726C4.25 3.15484 4.88929 4.18421 5.67857 4.18421C6.46786 4.18421 7.10714 3.15484 7.10714 2.13726C7.10714 1.11968 6.46786 0.5 5.67857 0.5C4.88929 0.5 4.25 1.12005 4.25 2.13726ZM11.75 2.13726C11.75 3.15484 11.1107 4.18421 10.3214 4.18421C9.53214 4.18421 8.89286 3.15484 8.89286 2.13726C8.89286 1.11968 9.53214 0.5 10.3214 0.5C11.1107 0.5 11.75 1.12005 11.75 2.13726Z" stroke="#9D9B98" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <p class="light-bold-color-font">Pet</p>
                                </div>
                                <p class="simple-font mt-1"> Other • Medium</p>
                            </div>
                            <div class="details">
                                <div class="d-flex align-items-center gap-10">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="11" height="15" viewBox="0 0 11 15" fill="none">
                                        <path d="M5.5 0.5C6.83339 0.5 8.10786 1.00588 9.04395 1.89941C9.9792 2.79219 10.5 3.99796 10.5 5.25C10.5 6.6294 9.73861 8.338 8.73145 9.9707C7.73727 11.5823 6.5574 13.0362 5.82422 13.8867C5.6489 14.0901 5.3511 14.0901 5.17578 13.8867C4.4426 13.0362 3.26273 11.5823 2.26855 9.9707C1.26139 8.338 0.5 6.6294 0.5 5.25C0.5 3.99796 1.0208 2.79219 1.95605 1.89941C2.89214 1.00588 4.16661 0.5 5.5 0.5ZM5.5 2.875C4.85374 2.875 4.22936 3.11984 3.76562 3.5625C3.30115 4.00591 3.03613 4.61245 3.03613 5.25C3.03613 5.88755 3.30115 6.49409 3.76562 6.9375C4.22936 7.38016 4.85374 7.625 5.5 7.625C5.82047 7.625 6.13831 7.56479 6.43555 7.44727C6.73282 7.32973 7.00457 7.15686 7.23438 6.9375C7.46409 6.7182 7.64771 6.45659 7.77344 6.16699C7.89921 5.87715 7.96387 5.5652 7.96387 5.25C7.96387 4.61245 7.69885 4.00591 7.23438 3.5625C6.77064 3.11984 6.14626 2.875 5.5 2.875Z" stroke="#9D9B98" />
                                    </svg>
                                    <p class="light-bold-color-font">Location</p>
                                </div>
                                <p class="simple-font mt-1">West London</p>
                            </div>
                        </div>

                    </div>

                </div>

                <div class="d-flex align-items-center justify-content-between mt-5">
                    <div class="heading-count d-flex align-items-center gap-30">
                        <h1 class="heading">Space Results</h1>
                        <span class="count">5</span>
                    </div>

                    <div class="tab-wrapper">
                        <div class="tabs groomer-tabs text-center">
                            <a data-tab="groomer-map-view" class="tablinks active">Map View</a>
                            <a data-tab="groomer-list-view" class="tablinks">List View</a>
                        </div>

                    </div>




                    <div class="venu-sorting-section d-flex gap-10">
                        <div class="venue-selection">
                            Space Venue
                            &nbsp;
                            <svg xmlns="http://www.w3.org/2000/svg" width="13" height="7" viewBox="0 0 13 7" fill="none">
                                <path d="M11.9103 0.5L6.15684 6.25344L0.499989 0.596581" stroke="#FBAC83" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <div class="venue-list">
                                <div class="venu dropdown">
                                    <ul>
                                        <li>
                                            <label>
                                                <span class="option-text">Salons</span>
                                                <input type="checkbox" name="groomer-venue[]" value="Full Groom (bath, dry, haircut)" checked="">
                                                <span class="check-circle"></span>

                                            </label>
                                        </li>
                                        <li>
                                            <label>
                                                <span class="option-text">Groomer’s studio</span>
                                                <input type="checkbox" name="groomer-venue[]" value="Face Trim Only">
                                                <span class="check-circle"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label>
                                                <span class="option-text">Homevisit</span>
                                                <input type="checkbox" name="groomer-venue[]" value="Tail Trim Only">
                                                <span class="check-circle"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label>
                                                <span class="option-text">Visiting Groomers
                                                    &nbsp;&nbsp;

                                                    <span class="tooltip">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12" fill="none">
                                                            <path d="M5.4 8.4C5.4 8.73137 5.66863 9 6 9C6.33137 9 6.6 8.73137 6.6 8.4V6C6.6 5.66863 6.33137 5.4 6 5.4C5.66863 5.4 5.4 5.66863 5.4 6V8.4ZM6 4.2C6.17 4.2 6.3126 4.1424 6.4278 4.0272C6.543 3.912 6.6004 3.7696 6.6 3.6C6.5996 3.4304 6.542 3.288 6.4272 3.1728C6.3124 3.0576 6.17 3 6 3C5.83 3 5.6876 3.0576 5.5728 3.1728C5.458 3.288 5.4004 3.4304 5.4 3.6C5.3996 3.7696 5.4572 3.9122 5.5728 4.0278C5.6884 4.1434 5.8308 4.2008 6 4.2ZM6 12C5.17 12 4.39 11.8424 3.66 11.5272C2.93 11.212 2.295 10.7846 1.755 10.245C1.215 9.7054 0.7876 9.0704 0.4728 8.34C0.158001 7.6096 0.000400759 6.8296 7.59493e-07 6C-0.00039924 5.1704 0.157201 4.3904 0.4728 3.66C0.7884 2.9296 1.2158 2.2946 1.755 1.755C2.2942 1.2154 2.9292 0.788 3.66 0.4728C4.3908 0.1576 5.1708 0 6 0C6.8292 0 7.6092 0.1576 8.33999 0.4728C9.07079 0.788 9.7058 1.2154 10.245 1.755C10.7842 2.2946 11.2118 2.9296 11.5278 3.66C11.8438 4.3904 12.0012 5.1704 12 6C11.9988 6.8296 11.8412 7.6096 11.5272 8.34C11.2132 9.0704 10.7858 9.7054 10.245 10.245C9.7042 10.7846 9.06919 11.2122 8.33999 11.5278C7.6108 11.8434 6.8308 12.0008 6 12ZM6 10.8C7.34 10.8 8.47499 10.335 9.40499 9.405C10.335 8.475 10.8 7.34 10.8 6C10.8 4.66 10.335 3.525 9.40499 2.595C8.47499 1.665 7.34 1.2 6 1.2C4.66 1.2 3.525 1.665 2.595 2.595C1.665 3.525 1.2 4.66 1.2 6C1.2 7.34 1.665 8.475 2.595 9.405C3.525 10.335 4.66 10.8 6 10.8Z" fill="#9D9B98"></path>
                                                        </svg>

                                                        <span class="tooltiptext">
                                                            Visiting Groomers provide mobile services
                                                            and don’t have
                                                            a
                                                            grooming space.
                                                        </span>
                                                    </span>
                                                </span>
                                                <input type="checkbox" name="groomer-venue[]" value="Bath &amp; Brush">
                                                <span class="check-circle"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label>
                                                <span class="option-text">Mobile Station</span>
                                                <input type="checkbox" name="groomer-venue[]" value="Nail Trim">
                                                <span class="check-circle"></span>
                                            </label>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="sort-by">
                            Sort
                            &nbsp;
                            <svg xmlns="http://www.w3.org/2000/svg" width="13" height="7" viewBox="0 0 13 7" fill="none">
                                <path d="M11.9103 0.5L6.15684 6.25344L0.499989 0.596581" stroke="#FBAC83" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <div class="sort-by-filter">
                                <div class="sort dropdown">
                                    <ul>
                                        <li>
                                            <label>
                                                <span class="option-text">Recommended (default)</span>
                                                <input type="checkbox" name="space-venue[]" value="default" checked=""> <span class="check-circle"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label>
                                                <span class="option-text">Distance</span>
                                                <input type="checkbox" name="space-venue[]" value="distance">
                                                <span class="check-circle"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label>
                                                <span class="option-text">Lowest price</span>
                                                <input type="checkbox" name="space-venue[]" value="lowest_price">
                                                <span class="check-circle"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label>
                                                <span class="option-text">Soonest available</span>
                                                <input type="checkbox" name="space-venue[]" value="soonest_available">
                                                <span class="check-circle"></span>
                                            </label>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="filter mt-5">
                    <div class="selected-item-section d-flex align-items-center flex-wrap gap-10" id="groomerSelectedSection" style="width: 100%; max-width: 75%;">
                        <div class="selected-item d-flex align-items-center gap-10">
                            <svg xmlns="http://www.w3.org/2000/svg" width="10" height="11" viewBox="0 0 10 11" fill="none">
                                <path d="M4.44243 0.607422C4.5719 0.744073 4.7462 0.931439 4.91997 1.13867C5.10308 1.35674 5.28263 1.59 5.41508 1.80273L5.53032 2.00781C5.67193 2.29613 5.82695 2.67871 5.95317 3.00977L6.31938 3.9707L6.84868 3.08984L7.36821 2.22363C8.00039 3.03951 8.36482 3.89752 8.57329 4.61523L8.6563 4.92676C8.75482 5.32776 8.80438 5.66743 8.82915 5.90625V5.90723L8.85356 6.25879V6.27637C8.85356 8.61074 7.00467 10.5 4.67485 10.5C2.3458 10.4997 0.5001 8.61074 0.500046 6.27539C0.500046 5.67251 0.793558 4.17103 1.65923 2.90527L2.25688 3.90137L2.6729 4.59375L3.10747 3.91406C3.31665 3.5867 3.60267 3.11726 3.82329 2.67676V2.67578C3.99822 2.3258 4.14303 1.84921 4.25102 1.43652C4.33337 1.12184 4.39793 0.822897 4.44243 0.607422Z" fill="#FBAC83" stroke="#FBAC83" />
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M6.74106 8.29738C6.77147 7.71984 6.63865 7.1454 6.3578 6.63983C6.07695 6.13426 5.65943 5.71798 5.15302 5.43864C5.06309 5.38662 4.95648 5.37154 4.85565 5.39659C4.75482 5.42164 4.66766 5.48486 4.61254 5.57292L3.9685 6.60378L3.43269 5.95574C3.40326 5.92021 3.36678 5.89117 3.32556 5.87045C3.28435 5.84972 3.23928 5.83776 3.19321 5.83531C3.14714 5.83286 3.10107 5.83998 3.05789 5.85622C3.0147 5.87247 2.97536 5.89748 2.94232 5.92968C2.62691 6.2349 2.38053 6.60413 2.21977 7.01254C2.05901 7.42095 1.9876 7.85906 2.01034 8.29738C2.01034 8.92463 2.25951 9.52618 2.70304 9.96971C3.14657 10.4132 3.74812 10.6624 4.37537 10.6624C5.00261 10.6624 5.60417 10.4132 6.04769 9.96971C6.49122 9.52618 6.74106 8.92463 6.74106 8.29738Z" fill="white" />
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M6.74106 8.29738C6.77147 7.71984 6.63865 7.1454 6.3578 6.63983C6.07695 6.13426 5.65943 5.71798 5.15302 5.43864C5.06309 5.38662 4.95648 5.37154 4.85565 5.39659C4.75482 5.42164 4.66766 5.48486 4.61254 5.57292L3.9685 6.60378L3.4327 5.95574C3.40326 5.92021 3.36678 5.89117 3.32556 5.87045C3.28435 5.84972 3.23928 5.83776 3.19321 5.83531C3.14714 5.83286 3.10107 5.83998 3.05789 5.85622C3.0147 5.87247 2.97536 5.89748 2.94232 5.92968C2.62691 6.2349 2.38053 6.60413 2.21977 7.01254C2.05901 7.42095 1.9876 7.85906 2.01034 8.29738C2.01034 8.92463 2.25951 9.52618 2.70304 9.96971C3.14657 10.4132 3.74812 10.6624 4.37537 10.6624C5.00261 10.6624 5.60417 10.4132 6.04769 9.96971C6.49122 9.52618 6.74106 8.92463 6.74106 8.29738ZM3.16412 6.68061L3.1227 6.73539C2.80852 7.17428 2.65109 7.70608 2.67575 8.24527L2.67776 8.28469C2.67776 8.73474 2.85654 9.16637 3.17478 9.48461C3.49302 9.80284 3.92464 9.98163 4.3747 9.98163C4.82476 9.98163 5.25638 9.80284 5.57462 9.48461C5.89286 9.16637 6.07164 8.73474 6.07164 8.28469L6.07364 8.24594C6.07832 8.20251 6.18254 7.00797 5.08955 6.19558L5.03544 6.15616L4.33795 7.27187C4.30427 7.32568 4.2583 7.37072 4.20381 7.40328C4.14932 7.43585 4.08788 7.455 4.02453 7.45918C3.96119 7.46335 3.89777 7.45243 3.83947 7.42729C3.78118 7.40216 3.72969 7.36355 3.68924 7.31463L3.16412 6.68061Z" fill="#FBAC83" />
                                <mask id="path-4-inside-1_1_1112" fill="white">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M3.9912 0.323969C4.00511 0.25224 4.0384 0.18569 4.08745 0.131536C4.1365 0.0773814 4.19944 0.0376891 4.26945 0.0167633C4.33945 -0.00416248 4.41385 -0.00552315 4.48457 0.0128289C4.5553 0.031181 4.61965 0.0685454 4.67064 0.12087C4.80025 0.253151 5.04945 0.515042 5.30265 0.817017C5.55118 1.11298 5.82242 1.46907 5.97876 1.78641C6.13108 2.0964 6.29276 2.49726 6.42036 2.83197L7.01429 1.8432C7.04741 1.78798 7.09335 1.74155 7.14822 1.70784C7.20308 1.67413 7.26526 1.65414 7.32949 1.64955C7.39372 1.64496 7.45811 1.65591 7.51721 1.68148C7.57631 1.70705 7.62838 1.74648 7.66902 1.79643C8.51281 2.83865 8.93304 3.95502 9.14215 4.8075C9.24704 5.23441 9.29982 5.59718 9.32654 5.85506C9.34014 5.98386 9.34905 6.11311 9.35326 6.24255V6.27662C9.35326 8.88016 7.28821 11 4.67532 11C2.06243 11 4.57764e-05 8.87949 4.57764e-05 6.27529C4.57764e-05 5.55843 0.338766 3.87017 1.3409 2.4859C1.37982 2.43255 1.43133 2.38965 1.49083 2.361C1.55033 2.33235 1.61599 2.31885 1.68197 2.3217C1.74794 2.32454 1.8122 2.34364 1.86901 2.3773C1.92583 2.41095 1.97345 2.45813 2.00765 2.51463L2.68576 3.64436C2.89153 3.32234 3.16678 2.87005 3.37589 2.45249C3.67653 1.85122 3.91504 0.717472 3.9912 0.324637M4.54103 0.959319C4.42011 1.49379 4.22035 2.25674 3.97316 2.75247C3.64446 3.40919 3.17079 4.13073 3.00777 4.37324C2.97006 4.42889 2.91896 4.47415 2.85917 4.50488C2.79939 4.5356 2.73284 4.5508 2.66564 4.54907C2.59844 4.54734 2.53276 4.52874 2.47464 4.49498C2.41651 4.46122 2.36781 4.41338 2.33301 4.35587L1.65156 3.22146C0.919334 4.40598 0.668133 5.73748 0.668133 6.27662C0.668133 8.52006 2.44124 10.3306 4.67532 10.3306C6.9094 10.3306 8.68518 8.52006 8.68518 6.27662V6.25792L8.6825 6.19111C8.67785 6.10165 8.67094 6.01232 8.66179 5.92321C8.62681 5.60117 8.57056 5.28179 8.49344 4.96717C8.28112 4.09054 7.90483 3.26201 7.38441 2.52532L6.70697 3.65305C6.66776 3.71819 6.61087 3.77086 6.5429 3.80494C6.47493 3.83901 6.39869 3.85309 6.32304 3.84553C6.24738 3.83797 6.17543 3.80909 6.11555 3.76224C6.05566 3.71539 6.01031 3.6525 5.98477 3.58089C5.87654 3.27758 5.61131 2.55338 5.37881 2.08171C5.26056 1.84053 5.03408 1.53588 4.7909 1.2466C4.70922 1.14945 4.62592 1.05368 4.54103 0.959319Z" />
                                </mask>
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M3.9912 0.323969C4.00511 0.25224 4.0384 0.18569 4.08745 0.131536C4.1365 0.0773814 4.19944 0.0376891 4.26945 0.0167633C4.33945 -0.00416248 4.41385 -0.00552315 4.48457 0.0128289C4.5553 0.031181 4.61965 0.0685454 4.67064 0.12087C4.80025 0.253151 5.04945 0.515042 5.30265 0.817017C5.55118 1.11298 5.82242 1.46907 5.97876 1.78641C6.13108 2.0964 6.29276 2.49726 6.42036 2.83197L7.01429 1.8432C7.04741 1.78798 7.09335 1.74155 7.14822 1.70784C7.20308 1.67413 7.26526 1.65414 7.32949 1.64955C7.39372 1.64496 7.45811 1.65591 7.51721 1.68148C7.57631 1.70705 7.62838 1.74648 7.66902 1.79643C8.51281 2.83865 8.93304 3.95502 9.14215 4.8075C9.24704 5.23441 9.29982 5.59718 9.32654 5.85506C9.34014 5.98386 9.34905 6.11311 9.35326 6.24255V6.27662C9.35326 8.88016 7.28821 11 4.67532 11C2.06243 11 4.57764e-05 8.87949 4.57764e-05 6.27529C4.57764e-05 5.55843 0.338766 3.87017 1.3409 2.4859C1.37982 2.43255 1.43133 2.38965 1.49083 2.361C1.55033 2.33235 1.61599 2.31885 1.68197 2.3217C1.74794 2.32454 1.8122 2.34364 1.86901 2.3773C1.92583 2.41095 1.97345 2.45813 2.00765 2.51463L2.68576 3.64436C2.89153 3.32234 3.16678 2.87005 3.37589 2.45249C3.67653 1.85122 3.91504 0.717472 3.9912 0.324637M4.54103 0.959319C4.42011 1.49379 4.22035 2.25674 3.97316 2.75247C3.64446 3.40919 3.17079 4.13073 3.00777 4.37324C2.97006 4.42889 2.91896 4.47415 2.85917 4.50488C2.79939 4.5356 2.73284 4.5508 2.66564 4.54907C2.59844 4.54734 2.53276 4.52874 2.47464 4.49498C2.41651 4.46122 2.36781 4.41338 2.33301 4.35587L1.65156 3.22146C0.919334 4.40598 0.668133 5.73748 0.668133 6.27662C0.668133 8.52006 2.44124 10.3306 4.67532 10.3306C6.9094 10.3306 8.68518 8.52006 8.68518 6.27662V6.25792L8.6825 6.19111C8.67785 6.10165 8.67094 6.01232 8.66179 5.92321C8.62681 5.60117 8.57056 5.28179 8.49344 4.96717C8.28112 4.09054 7.90483 3.26201 7.38441 2.52532L6.70697 3.65305C6.66776 3.71819 6.61087 3.77086 6.5429 3.80494C6.47493 3.83901 6.39869 3.85309 6.32304 3.84553C6.24738 3.83797 6.17543 3.80909 6.11555 3.76224C6.05566 3.71539 6.01031 3.6525 5.98477 3.58089C5.87654 3.27758 5.61131 2.55338 5.37881 2.08171C5.26056 1.84053 5.03408 1.53588 4.7909 1.2466C4.70922 1.14945 4.62592 1.05368 4.54103 0.959319Z" fill="#FBAC83" />
                                <path d="M4.67064 0.12087L3.95451 0.818836L3.95636 0.820725L4.67064 0.12087ZM5.30265 0.817017L4.53638 1.45953L4.53685 1.46009L5.30265 0.817017ZM5.97876 1.78641L6.87626 1.3454L6.87581 1.34449L5.97876 1.78641ZM6.42036 2.83197L5.48596 3.1882L6.21859 5.10991L7.2776 3.34689L6.42036 2.83197ZM7.01429 1.8432L7.87153 2.35812L7.87186 2.35756L7.01429 1.8432ZM7.66902 1.79643L8.44623 1.16719L8.44478 1.1654L7.66902 1.79643ZM9.14215 4.8075L8.17094 5.04574L8.17103 5.0461L9.14215 4.8075ZM9.32654 5.85506L8.33186 5.95814L8.33207 5.96007L9.32654 5.85506ZM9.35326 6.24255H10.3533V6.22629L10.3527 6.21005L9.35326 6.24255ZM1.3409 2.4859L0.533077 1.89646L0.530877 1.89949L1.3409 2.4859ZM2.00765 2.51463L2.86506 1.99998L2.86317 1.99686L2.00765 2.51463ZM2.68576 3.64436L1.82835 4.15901L2.65916 5.54314L3.52841 4.18282L2.68576 3.64436ZM3.37589 2.45249L4.27003 2.90028L4.27032 2.89971L3.37589 2.45249ZM4.54103 0.959319L5.28446 0.290499L3.99209 -1.14602L3.56569 0.738647L4.54103 0.959319ZM3.97316 2.75247L4.8674 3.20004L4.86807 3.19871L3.97316 2.75247ZM3.00777 4.37324L3.83556 4.9343L3.83771 4.93111L3.00777 4.37324ZM2.33301 4.35587L1.47578 4.87082L1.47745 4.87359L2.33301 4.35587ZM1.65156 3.22146L2.50878 2.70652L1.66379 1.29985L0.800955 2.69565L1.65156 3.22146ZM8.68518 6.25792H9.68518V6.23793L9.68438 6.21795L8.68518 6.25792ZM8.6825 6.19111L9.68178 6.15114L9.68115 6.13912L8.6825 6.19111ZM8.66179 5.92321L9.65658 5.82109L9.65594 5.8152L8.66179 5.92321ZM8.49344 4.96717L7.52153 5.20256L7.5222 5.20527L8.49344 4.96717ZM7.38441 2.52532L8.20117 1.94834L7.31663 0.69619L6.52719 2.01037L7.38441 2.52532ZM6.70697 3.65305L7.56376 4.16871L7.56419 4.16799L6.70697 3.65305ZM5.98477 3.58089L6.92665 3.24493L6.92661 3.24482L5.98477 3.58089ZM5.37881 2.08171L4.48093 2.52194L4.48186 2.52383L5.37881 2.08171ZM4.7909 1.2466L5.55636 0.603115L5.55632 0.60307L4.7909 1.2466ZM3.9912 0.323969L4.97289 0.51442C4.95204 0.621931 4.90214 0.721679 4.82863 0.802848L4.08745 0.131536L3.34628 -0.539776C3.17466 -0.350298 3.05819 -0.117451 3.0095 0.133517L3.9912 0.323969ZM4.08745 0.131536L4.82863 0.802848C4.75511 0.884017 4.66077 0.94351 4.55584 0.974874L4.26945 0.0167633L3.98305 -0.941348C3.73811 -0.868132 3.51789 -0.729254 3.34628 -0.539776L4.08745 0.131536ZM4.26945 0.0167633L4.55584 0.974874C4.45092 1.00624 4.3394 1.00828 4.2334 0.980771L4.48457 0.0128289L4.73574 -0.955114C4.48829 -1.01932 4.22799 -1.01456 3.98305 -0.941348L4.26945 0.0167633ZM4.48457 0.0128289L4.2334 0.980771C4.1274 0.953265 4.03095 0.897261 3.95451 0.818834L4.67064 0.12087L5.38678 -0.577094C5.20834 -0.760171 4.98319 -0.890903 4.73574 -0.955114L4.48457 0.0128289ZM4.67064 0.12087L3.95636 0.820725C4.07521 0.942031 4.30533 1.18398 4.53638 1.45953L5.30265 0.817017L6.06892 0.174501C5.79356 -0.153898 5.52529 -0.435728 5.38493 -0.578985L4.67064 0.12087ZM5.30265 0.817017L4.53685 1.46009C4.77675 1.74578 4.98163 2.0252 5.0817 2.22833L5.97876 1.78641L6.87581 1.34449C6.66322 0.912941 6.32561 0.480181 6.06846 0.173946L5.30265 0.817017ZM5.97876 1.78641L5.08126 2.22742C5.21245 2.49442 5.36085 2.86002 5.48596 3.1882L6.42036 2.83197L7.35476 2.47574C7.22466 2.13449 7.04971 1.69839 6.87626 1.3454L5.97876 1.78641ZM6.42036 2.83197L7.2776 3.34689L7.87153 2.35812L7.01429 1.8432L6.15705 1.32828L5.56312 2.31705L6.42036 2.83197ZM7.01429 1.8432L7.87186 2.35756C7.82236 2.4401 7.75369 2.5095 7.67169 2.55988L7.14822 1.70784L6.62474 0.855795C6.43301 0.973593 6.27247 1.13585 6.15672 1.32884L7.01429 1.8432ZM7.14822 1.70784L7.67169 2.55988C7.58968 2.61026 7.49675 2.64015 7.40074 2.64701L7.32949 1.64955L7.25824 0.652089C7.03378 0.668122 6.81648 0.737997 6.62474 0.855795L7.14822 1.70784ZM7.32949 1.64955L7.40074 2.64701C7.30473 2.65386 7.20849 2.63749 7.12016 2.59928L7.51721 1.68148L7.91427 0.763687C7.70773 0.674336 7.48271 0.636056 7.25824 0.652089L7.32949 1.64955ZM7.51721 1.68148L7.12016 2.59928C7.03182 2.56106 6.95399 2.50213 6.89326 2.42746L7.66902 1.79643L8.44478 1.1654C8.30277 0.99083 8.1208 0.853037 7.91427 0.763687L7.51721 1.68148ZM7.66902 1.79643L6.89181 2.42567C7.61852 3.32328 7.98632 4.2931 8.17094 5.04574L9.14215 4.8075L10.1134 4.56927C9.87975 3.61695 9.4071 2.35402 8.44623 1.16719L7.66902 1.79643ZM9.14215 4.8075L8.17103 5.0461C8.26329 5.42159 8.30909 5.73834 8.33187 5.95814L9.32654 5.85506L10.3212 5.75199C10.2905 5.45602 10.2308 5.04722 10.1133 4.5689L9.14215 4.8075ZM9.32654 5.85506L8.33207 5.96007C8.34312 6.06477 8.35037 6.16984 8.35379 6.27506L9.35326 6.24255L10.3527 6.21005C10.3477 6.05638 10.3372 5.90295 10.321 5.75005L9.32654 5.85506ZM9.35326 6.24255H8.35326V6.27662H9.35326H10.3533V6.24255H9.35326ZM9.35326 6.27662H8.35326C8.35326 8.34183 6.72207 10 4.67532 10V11V12C7.85435 12 10.3533 9.41848 10.3533 6.27662H9.35326ZM4.67532 11V10C2.62959 10 1.00005 8.3422 1.00005 6.27529H4.57764e-05H-0.999954C-0.999954 9.41679 1.49527 12 4.67532 12V11ZM4.57764e-05 6.27529H1.00005C1.00005 5.74637 1.28494 4.26851 2.15092 3.0723L1.3409 2.4859L0.530877 1.89949C-0.607404 3.47184 -0.999954 5.3705 -0.999954 6.27529H4.57764e-05ZM1.3409 2.4859L2.14871 3.07534C2.09053 3.15507 2.01355 3.2192 1.92461 3.26202L1.49083 2.361L1.05704 1.45998C0.849101 1.56009 0.669115 1.71003 0.533082 1.89646L1.3409 2.4859ZM1.49083 2.361L1.92461 3.26202C1.83567 3.30484 1.73753 3.32502 1.63892 3.32077L1.68197 2.3217L1.72501 1.32262C1.49444 1.31269 1.26499 1.35987 1.05704 1.45998L1.49083 2.361ZM1.68197 2.3217L1.63892 3.32077C1.5403 3.31652 1.44427 3.28797 1.35934 3.23766L1.86901 2.3773L2.37869 1.51693C2.18013 1.3993 1.95558 1.33256 1.72501 1.32262L1.68197 2.3217ZM1.86901 2.3773L1.35934 3.23766C1.27442 3.18735 1.20324 3.11684 1.15213 3.0324L2.00765 2.51463L2.86317 1.99686C2.74367 1.79941 2.57725 1.63455 2.37869 1.51693L1.86901 2.3773ZM2.00765 2.51463L1.15024 3.02927L1.82835 4.15901L2.68576 3.64436L3.54316 3.12972L2.86505 1.99998L2.00765 2.51463ZM2.68576 3.64436L3.52841 4.18282C3.74106 3.85004 4.03789 3.36382 4.27003 2.90028L3.37589 2.45249L2.48175 2.00471C2.29567 2.37628 2.042 2.79465 1.8431 3.1059L2.68576 3.64436ZM3.37589 2.45249L4.27032 2.89971C4.46998 2.50039 4.6258 1.98129 4.73513 1.56364C4.84922 1.12779 4.9325 0.723448 4.97292 0.51497L3.9912 0.324637L3.00948 0.134303C2.97374 0.31866 2.89968 0.677604 2.80032 1.05715C2.6962 1.45491 2.58244 1.80332 2.48146 2.00528L3.37589 2.45249ZM4.54103 0.959319L3.56569 0.738647C3.44423 1.27548 3.26567 1.93036 3.07825 2.30622L3.97316 2.75247L4.86807 3.19871C5.17503 2.58313 5.39599 1.7121 5.51638 1.17999L4.54103 0.959319ZM3.97316 2.75247L3.07891 2.30489C2.78056 2.90099 2.3373 3.57815 2.17784 3.81538L3.00777 4.37324L3.83771 4.93111C4.00427 4.68331 4.50836 3.9174 4.8674 3.20004L3.97316 2.75247ZM3.00777 4.37324L2.17999 3.81219C2.23636 3.72903 2.31274 3.66137 2.4021 3.61545L2.85917 4.50488L3.31625 5.3943C3.52518 5.28693 3.70376 5.12875 3.83555 4.9343L3.00777 4.37324ZM2.85917 4.50488L2.4021 3.61545C2.49146 3.56952 2.59094 3.54681 2.69137 3.5494L2.66564 4.54907L2.63991 5.54873C2.87473 5.55478 3.10731 5.50167 3.31625 5.3943L2.85917 4.50488ZM2.66564 4.54907L2.69137 3.5494C2.79181 3.55198 2.88999 3.57978 2.97687 3.63024L2.47464 4.49498L1.9724 5.35971C2.17554 5.47769 2.40507 5.54269 2.63991 5.54873L2.66564 4.54907ZM2.47464 4.49498L2.97687 3.63024C3.06375 3.6807 3.13654 3.7522 3.18856 3.83816L2.33301 4.35587L1.47745 4.87359C1.59907 5.07457 1.76927 5.24173 1.9724 5.35971L2.47464 4.49498ZM2.33301 4.35587L3.19023 3.84093L2.50878 2.70652L1.65156 3.22146L0.794331 3.7364L1.47578 4.87082L2.33301 4.35587ZM1.65156 3.22146L0.800955 2.69565C-0.0307343 4.04108 -0.331867 5.55519 -0.331867 6.27662H0.668133H1.66813C1.66813 5.91977 1.8694 4.77088 2.50216 3.74727L1.65156 3.22146ZM0.668133 6.27662H-0.331867C-0.331867 9.05867 1.87537 11.3306 4.67532 11.3306V10.3306V9.33058C3.0071 9.33058 1.66813 7.98146 1.66813 6.27662H0.668133ZM4.67532 10.3306V11.3306C7.4744 11.3306 9.68518 9.05954 9.68518 6.27662H8.68518H7.68518C7.68518 7.98058 6.3444 9.33058 4.67532 9.33058V10.3306ZM8.68518 6.27662H9.68518V6.25792H8.68518H7.68518V6.27662H8.68518ZM8.68518 6.25792L9.68438 6.21795L9.68171 6.15114L8.6825 6.19111L7.6833 6.23107L7.68598 6.29788L8.68518 6.25792ZM8.6825 6.19111L9.68115 6.13912C9.67562 6.03292 9.66743 5.92688 9.65657 5.82109L8.66179 5.92321L7.66702 6.02532C7.67446 6.09776 7.68007 6.17038 7.68386 6.2431L8.6825 6.19111ZM8.66179 5.92321L9.65594 5.8152C9.6162 5.44934 9.5523 5.0865 9.46468 4.72907L8.49344 4.96717L7.5222 5.20527C7.58883 5.47708 7.63742 5.753 7.66764 6.03121L8.66179 5.92321ZM8.49344 4.96717L9.46534 4.73179C9.22333 3.73253 8.79439 2.78809 8.20117 1.94834L7.38441 2.52532L6.56765 3.10229C7.01527 3.73593 7.33892 4.44856 7.52153 5.20256L8.49344 4.96717ZM7.38441 2.52532L6.52719 2.01037L5.84975 3.1381L6.70697 3.65305L7.56419 4.16799L8.24164 3.04026L7.38441 2.52532ZM6.70697 3.65305L5.85018 3.13739C5.90862 3.04029 5.99342 2.96178 6.09473 2.91099L6.5429 3.80494L6.99107 4.69888C7.22832 4.57994 7.42691 4.39609 7.56376 4.16871L6.70697 3.65305ZM6.5429 3.80494L6.09473 2.91099C6.19603 2.8602 6.30968 2.83922 6.42245 2.85048L6.32304 3.84553L6.22362 4.84058C6.4877 4.86696 6.75383 4.81782 6.99107 4.69888L6.5429 3.80494ZM6.32304 3.84553L6.42245 2.85048C6.53521 2.86175 6.64246 2.9048 6.73172 2.97463L6.11555 3.76224L5.49937 4.54985C5.70839 4.71338 5.95955 4.81419 6.22362 4.84058L6.32304 3.84553ZM6.11555 3.76224L6.73172 2.97463C6.82098 3.04446 6.88857 3.13819 6.92665 3.24493L5.98477 3.58089L5.04289 3.91685C5.13205 4.16681 5.29035 4.38633 5.49937 4.54985L6.11555 3.76224ZM5.98477 3.58089L6.92661 3.24482C6.82036 2.94707 6.53743 2.17042 6.27577 1.63958L5.37881 2.08171L4.48186 2.52383C4.68519 2.93633 4.93272 3.60809 5.04293 3.91697L5.98477 3.58089ZM5.37881 2.08171L6.2767 1.64147C6.10178 1.28472 5.80811 0.902591 5.55636 0.603115L4.7909 1.2466L4.02544 1.89008C4.26005 2.16917 4.41934 2.39633 4.48093 2.52194L5.37881 2.08171ZM4.7909 1.2466L5.55632 0.60307C5.46745 0.497369 5.37682 0.393164 5.28446 0.290499L4.54103 0.959319L3.79761 1.62814C3.87502 1.71419 3.95099 1.80153 4.02547 1.89012L4.7909 1.2466Z" fill="#FBAC83" mask="url(#path-4-inside-1_1_1112)" />
                            </svg>
                            <p>Top Rated</p>
                            <svg class="cross svg cursor" xmlns="http://www.w3.org/2000/svg" width="9" height="9" viewBox="0 0 9 9" fill="none">
                                <path d="M0.5 7.57L7.572 0.5M0.5 0.5L7.572 7.57" stroke="#FBAC83" stroke-linecap="round" />
                            </svg>
                        </div>
                        <div class="selected-item d-flex align-items-center gap-10">
                            <p>Mobile Station</p>
                            <svg class="cross svg cursor" xmlns="http://www.w3.org/2000/svg" width="9" height="9" viewBox="0 0 9 9" fill="none">
                                <path d="M0.5 7.57L7.572 0.5M0.5 0.5L7.572 7.57" stroke="#FBAC83" stroke-linecap="round" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div data-tab-content="groomer-list-view" class="tabcontent" data-display="block" style="padding: 0 35px;">

                    <div class="space-scroll-wrapper mt-5">

                        <div class="space-scroll">
                            <div class="row flex-nowrap g-3">
                                <div class="col-lg-4">
                                    <div class="card space-cards flex-column active">
                                        <div class="left">
                                            <div class="top-left-svg">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="21" height="22"
                                                    viewBox="0 0 21 22" fill="none">
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
                                                        d="M6.83331 13.4703C6.83331 13.4703 8.2222 13.7392 9.61109 12.667L6.83331 13.4703Z"
                                                        fill="#CBDCE8" />
                                                    <path d="M6.83331 13.4703C6.83331 13.4703 8.2222 13.7392 9.61109 12.667"
                                                        stroke="white" stroke-linecap="round" stroke-linejoin="round" />
                                                    <path
                                                        d="M9.05558 8.36144C9.05558 8.54561 8.98241 8.72225 8.85218 8.85248C8.72194 8.98272 8.54531 9.05588 8.36113 9.05588C8.17695 9.05588 8.00032 8.98272 7.87009 8.85248C7.73985 8.72225 7.66669 8.54561 7.66669 8.36144C7.66669 8.17726 7.73985 8.00062 7.87009 7.87039C8.00032 7.74016 8.17695 7.66699 8.36113 7.66699C8.54531 7.66699 8.72194 7.74016 8.85218 7.87039C8.98241 8.00062 9.05558 8.17726 9.05558 8.36144Z"
                                                        fill="#CBDCE8" stroke="white" />
                                                    <path d="M10.4445 6.55554V6.6111V6.55554Z" fill="#CBDCE8" />
                                                    <path d="M10.4445 6.55554V6.6111" stroke="white" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                </svg>
                                            </div>
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 255 130" fill="none">
                                                <defs>
                                                    <pattern id="pattern-card-1" patternUnits="userSpaceOnUse" width="255"
                                                        height="130">
                                                        <image href="<?= BASE_URL ?>/assets/images/space_card1.png" width="255"
                                                            height="130" preserveAspectRatio="xMidYMid slice" />
                                                    </pattern>
                                                </defs>

                                                <path
                                                    d="M255 124.417C255 127.178 252.761 129.417 250 129.417H5C2.23858 129.417 0 127.178 0 124.417V37C0 34.2386 2.23858 32 5 32H27C29.7614 32 32 29.7614 32 27V5C32 2.23858 34.2386 0 37 0H250C252.761 0 255 2.23858 255 5V124.417Z"
                                                    fill="url(#pattern-card-1)" />
                                            </svg>

                                        </div>
                                        <div class="right">
                                            <div class="top-row">
                                                <div class="tags" aria-hidden="true">
                                                    <div class="tag">Salons</div>
                                                </div>
                                                <div class="icons" aria-hidden="true">
                                                    <button class="first-icon" title="Top-rated">
                                                        <!-- crown -->
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="10" height="9"
                                                            viewBox="0 0 10 9" fill="none">
                                                            <path
                                                                d="M2 8.99999C1.85833 8.99999 1.73967 8.95199 1.644 8.85599C1.54833 8.75999 1.50033 8.64133 1.5 8.49999C1.49967 8.35866 1.54767 8.23999 1.644 8.14399C1.74033 8.04799 1.859 7.99999 2 7.99999H8C8.14166 7.99999 8.2605 8.04799 8.3565 8.14399C8.4525 8.23999 8.50033 8.35866 8.5 8.49999C8.49966 8.64133 8.45166 8.76016 8.356 8.85649C8.26033 8.95283 8.14166 9.00066 8 8.99999H2ZM2.35 7.24999C2.10833 7.24999 1.89383 7.17083 1.7065 7.0125C1.51917 6.85416 1.4045 6.65416 1.3625 6.4125L0.862501 3.2375C0.845834 3.2375 0.827167 3.23967 0.806501 3.244C0.785834 3.24833 0.767001 3.25033 0.750001 3.25C0.541667 3.25 0.364668 3.17717 0.219001 3.0315C0.0733344 2.88583 0.000334469 2.70867 1.13636e-06 2.5C-0.000332197 2.29133 0.0726677 2.11433 0.219001 1.969C0.365334 1.82367 0.542334 1.75067 0.750001 1.75C0.957667 1.74933 1.13483 1.82233 1.2815 1.969C1.42817 2.11567 1.501 2.29267 1.5 2.5C1.5 2.55833 1.49367 2.6125 1.481 2.6625C1.46833 2.7125 1.45383 2.75833 1.4375 2.8L3 3.5L4.5625 1.3625C4.47083 1.29583 4.39583 1.20833 4.3375 1.1C4.27917 0.991667 4.25 0.875 4.25 0.75C4.25 0.541667 4.323 0.364501 4.469 0.218501C4.615 0.0725011 4.792 -0.000332194 5 1.13895e-06C5.208 0.000334472 5.38516 0.0733344 5.5315 0.219001C5.67783 0.364667 5.75066 0.541667 5.75 0.75C5.75 0.875 5.72083 0.991667 5.6625 1.1C5.60416 1.20833 5.52916 1.29583 5.4375 1.3625L7 3.5L8.5625 2.8C8.54583 2.75833 8.53116 2.7125 8.5185 2.6625C8.50583 2.6125 8.49966 2.55833 8.5 2.5C8.5 2.29167 8.573 2.1145 8.719 1.9685C8.865 1.8225 9.042 1.74967 9.25 1.75C9.458 1.75033 9.63516 1.82333 9.7815 1.969C9.92783 2.11467 10.0007 2.29167 10 2.5C9.99933 2.70833 9.92649 2.8855 9.7815 3.0315C9.6365 3.1775 9.45933 3.25033 9.25 3.25C9.23333 3.25 9.21466 3.248 9.194 3.244C9.17333 3.24 9.1545 3.23783 9.1375 3.2375L8.6375 6.4125C8.59583 6.65416 8.48133 6.85416 8.294 7.0125C8.10666 7.17083 7.892 7.24999 7.65 7.24999H2.35ZM2.35 6.25H7.65L7.975 4.1625L7.4 4.4125C7.18333 4.50416 6.9625 4.52083 6.7375 4.4625C6.5125 4.40416 6.32916 4.27916 6.1875 4.0875L5 2.45L3.8125 4.0875C3.67083 4.27916 3.4875 4.40416 3.2625 4.4625C3.0375 4.52083 2.81667 4.50416 2.6 4.4125L2.025 4.1625L2.35 6.25Z"
                                                                fill="white" />
                                                        </svg>
                                                    </button>
                                                    <button class="second-icon" title="Favourite">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="9" height="11"
                                                            viewBox="0 0 9 11" fill="none">
                                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                                d="M3.79701 0.30821C3.81025 0.23997 3.84191 0.176658 3.88858 0.125138C3.93524 0.0736173 3.99512 0.0358558 4.06172 0.0159479C4.12832 -0.00396001 4.1991 -0.00525449 4.26638 0.0122049C4.33367 0.0296642 4.39489 0.0652111 4.4434 0.114991C4.56671 0.240837 4.80378 0.489988 5.04467 0.777274C5.28111 1.05884 5.53916 1.39761 5.68788 1.69951C5.8328 1.99443 5.98661 2.37578 6.10801 2.69421L6.67305 1.75354C6.70456 1.701 6.74826 1.65683 6.80046 1.62476C6.85265 1.59269 6.91181 1.57367 6.97292 1.56931C7.03402 1.56494 7.09528 1.57536 7.1515 1.59969C7.20773 1.62401 7.25727 1.66152 7.29592 1.70905C8.09867 2.70057 8.49846 3.76263 8.6974 4.57365C8.79718 4.97979 8.8474 5.32491 8.87282 5.57025C8.88576 5.69278 8.89424 5.81574 8.89824 5.93889V5.97131C8.89824 8.4482 6.93364 10.4649 4.44785 10.4649C1.96206 10.4649 0 8.44756 0 5.97004C0 5.28805 0.322244 3.68192 1.27563 2.36498C1.31266 2.31422 1.36166 2.27341 1.41826 2.24615C1.47487 2.2189 1.53734 2.20605 1.60011 2.20876C1.66287 2.21146 1.724 2.22963 1.77806 2.26166C1.83211 2.29368 1.87741 2.33856 1.90994 2.39231L2.55507 3.46709C2.75083 3.16073 3.01269 2.73044 3.21163 2.3332C3.49765 1.76117 3.72455 0.682572 3.79701 0.308845M4.3201 0.912655C4.20506 1.42113 4.01501 2.14697 3.77985 2.61858C3.46714 3.24336 3.0165 3.9298 2.86142 4.16051C2.82554 4.21345 2.77693 4.25651 2.72005 4.28574C2.66317 4.31497 2.59986 4.32943 2.53593 4.32778C2.472 4.32614 2.40952 4.30844 2.35422 4.27632C2.29892 4.24421 2.25258 4.1987 2.21948 4.14399L1.57118 3.06476C0.87457 4.19166 0.635589 5.45839 0.635589 5.97131C0.635589 8.10561 2.32244 9.82806 4.44785 9.82806C6.57326 9.82806 8.26265 8.10561 8.26265 5.97131V5.95351L8.26011 5.88995C8.25568 5.80484 8.24911 5.71986 8.24041 5.63508C8.20712 5.3287 8.15362 5.02487 8.08024 4.72555C7.87826 3.89157 7.52027 3.10334 7.02516 2.40248L6.38068 3.47535C6.34338 3.53732 6.28925 3.58743 6.22459 3.61985C6.15993 3.65227 6.08739 3.66566 6.01542 3.65847C5.94344 3.65128 5.87499 3.6238 5.81802 3.57923C5.76105 3.53466 5.71791 3.47483 5.6936 3.40671C5.59064 3.11815 5.33831 2.42917 5.11713 1.98044C5.00463 1.751 4.78916 1.46117 4.55781 1.18596C4.4801 1.09353 4.40086 1.00242 4.3201 0.912655Z"
                                                                fill="#FEFEFE" />
                                                        </svg>
                                                    </button>
                                                    <button class="third-icon" title="lock">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="8" height="10"
                                                            viewBox="0 0 8 10" fill="none">
                                                            <path
                                                                d="M4 7.61905C3.73478 7.61905 3.48043 7.51871 3.29289 7.3401C3.10536 7.1615 3 6.91925 3 6.66667C3 6.1381 3.445 5.71429 4 5.71429C4.26522 5.71429 4.51957 5.81463 4.70711 5.99323C4.89464 6.17184 5 6.41408 5 6.66667C5 6.91925 4.89464 7.1615 4.70711 7.3401C4.51957 7.51871 4.26522 7.61905 4 7.61905ZM7 9.04762V4.28571H1V9.04762H7ZM7 3.33333C7.26522 3.33333 7.51957 3.43367 7.70711 3.61228C7.89464 3.79089 8 4.03313 8 4.28571V9.04762C8 9.30021 7.89464 9.54245 7.70711 9.72105C7.51957 9.89966 7.26522 10 7 10H1C0.734784 10 0.48043 9.89966 0.292893 9.72105C0.105357 9.54245 0 9.30021 0 9.04762V4.28571C0 3.75714 0.445 3.33333 1 3.33333H1.5V2.38095C1.5 1.74948 1.76339 1.14388 2.23223 0.697365C2.70107 0.25085 3.33696 0 4 0C4.3283 0 4.65339 0.0615852 4.95671 0.181239C5.26002 0.300893 5.53562 0.476273 5.76777 0.697365C5.99991 0.918457 6.18406 1.18093 6.3097 1.4698C6.43534 1.75867 6.5 2.06828 6.5 2.38095V3.33333H7ZM4 0.952381C3.60218 0.952381 3.22064 1.10289 2.93934 1.3708C2.65804 1.63871 2.5 2.00207 2.5 2.38095V3.33333H5.5V2.38095C5.5 2.00207 5.34196 1.63871 5.06066 1.3708C4.77936 1.10289 4.39782 0.952381 4 0.952381Z"
                                                                fill="white" />
                                                        </svg>
                                                    </button>
                                                </div>
                                            </div>

                                            <h2 class="name">Furs & Co. Studio</h2>
                                            <p class="hosted-by">Hosted by <span>Dev É.</span></p>

                                            <div class="studio-details mt-1 d-flex flex-column justify-content-between mt-2">

                                                <div class="meta d-flex align-items-center justify-content-between">
                                                    <div class="distance" title="Distance">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="10" height="14"
                                                            viewBox="0 0 10 14" fill="none">
                                                            <path
                                                                d="M5 6.65C4.5264 6.65 4.0722 6.46563 3.73731 6.13744C3.40242 5.80925 3.21429 5.36413 3.21429 4.9C3.21429 4.43587 3.40242 3.99075 3.73731 3.66256C4.0722 3.33437 4.5264 3.15 5 3.15C5.4736 3.15 5.9278 3.33437 6.26269 3.66256C6.59758 3.99075 6.78571 4.43587 6.78571 4.9C6.78571 5.12981 6.73953 5.35738 6.64979 5.5697C6.56004 5.78202 6.42851 5.97493 6.26269 6.13744C6.09687 6.29994 5.90002 6.42884 5.68336 6.51679C5.46671 6.60473 5.2345 6.65 5 6.65ZM5 0C3.67392 0 2.40215 0.516248 1.46447 1.43518C0.526784 2.3541 0 3.60044 0 4.9C0 8.575 5 14 5 14C5 14 10 8.575 10 4.9C10 3.60044 9.47322 2.3541 8.53553 1.43518C7.59785 0.516248 6.32608 0 5 0Z"
                                                                fill="var(--active-bg)" />
                                                        </svg>
                                                        <span>2.5 mi</span>
                                                    </div>


                                                    <div class="rating" title="Rating">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                            viewBox="0 0 14 14" fill="none">
                                                            <path
                                                                d="M6.12956 0.660476C6.40354 -0.220161 7.59647 -0.220158 7.87045 0.660479L8.89548 3.95519C9.01801 4.34902 9.36942 4.61566 9.76593 4.61566H13.083C13.9696 4.61566 14.3383 5.80055 13.621 6.34481L10.9374 8.38106C10.6166 8.62446 10.4824 9.0559 10.6049 9.44973L11.63 12.7444C11.9039 13.6251 10.9388 14.3574 10.2215 13.8131L7.53797 11.7769C7.21719 11.5335 6.78282 11.5335 6.46204 11.7769L3.77846 13.8131C3.06117 14.3574 2.09607 13.6251 2.37005 12.7444L3.39508 9.44973C3.51761 9.0559 3.38338 8.62446 3.0626 8.38106L0.37903 6.34481C-0.338258 5.80055 0.0303816 4.61566 0.916998 4.61566H4.23408C4.63058 4.61566 4.98199 4.34902 5.10452 3.95519L6.12956 0.660476Z"
                                                                fill="var(--active-bg)" />
                                                        </svg>
                                                        <span>4.3 <small style="color:var(--muted)">(20)</small></span>
                                                    </div>
                                                </div>
                                            </div>



                                            <p class="experience">Professional grooming spaces in <br> London.
                                                Spotless, well-equipped, easy <br> to access.</p>


                                            <p class="amenities d-flex">
                                                <b>Amenities:</b>&nbsp;Bath &#8226; Table &#8226; Dryer ...
                                            </p>


                                            <div class="availability mt-3">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15"
                                                    viewBox="0 0 15 15" fill="none">
                                                    <path
                                                        d="M7.5 0C3.375 0 0 3.375 0 7.5C0 11.625 3.375 15 7.5 15C11.625 15 15 11.625 15 7.5C15 3.375 11.625 0 7.5 0ZM6 11.25L2.25 7.5L3.3075 6.4425L6 9.1275L11.6925 3.435L12.75 4.5L6 11.25Z"
                                                        fill="#D8E8B7" />
                                                </svg>
                                                <span>Availability</span>
                                            </div>


                                            <div class="slots-price d-flex flex-column">
                                                <div class="slots d-flex flex-column" aria-label="Available slots">
                                                    <div class="slot highlight">Mon 1, 08:30 AM</div>
                                                    <div class="slot">Wed 27, 09:15 AM</div>
                                                </div>
                                                <div class="price">From <span>£38</span> <span class="time-frame">/
                                                        hour</span></div>
                                            </div>



                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="card space-cards flex-column active">
                                        <div class="left">
                                            <div class="top-left-svg">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="21" height="22"
                                                    viewBox="0 0 21 22" fill="none">
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
                                                        d="M6.83331 13.4703C6.83331 13.4703 8.2222 13.7392 9.61109 12.667L6.83331 13.4703Z"
                                                        fill="#CBDCE8" />
                                                    <path d="M6.83331 13.4703C6.83331 13.4703 8.2222 13.7392 9.61109 12.667"
                                                        stroke="white" stroke-linecap="round" stroke-linejoin="round" />
                                                    <path
                                                        d="M9.05558 8.36144C9.05558 8.54561 8.98241 8.72225 8.85218 8.85248C8.72194 8.98272 8.54531 9.05588 8.36113 9.05588C8.17695 9.05588 8.00032 8.98272 7.87009 8.85248C7.73985 8.72225 7.66669 8.54561 7.66669 8.36144C7.66669 8.17726 7.73985 8.00062 7.87009 7.87039C8.00032 7.74016 8.17695 7.66699 8.36113 7.66699C8.54531 7.66699 8.72194 7.74016 8.85218 7.87039C8.98241 8.00062 9.05558 8.17726 9.05558 8.36144Z"
                                                        fill="#CBDCE8" stroke="white" />
                                                    <path d="M10.4445 6.55554V6.6111V6.55554Z" fill="#CBDCE8" />
                                                    <path d="M10.4445 6.55554V6.6111" stroke="white" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                </svg>
                                            </div>
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 255 130" fill="none">
                                                <defs>
                                                    <pattern id="pattern-card-2" patternUnits="userSpaceOnUse" width="255"
                                                        height="130">
                                                        <image href="<?= BASE_URL ?>/assets/images/space_card2.png" width="255"
                                                            height="130" preserveAspectRatio="xMidYMid slice" />
                                                    </pattern>
                                                </defs>

                                                <path
                                                    d="M255 124.417C255 127.178 252.761 129.417 250 129.417H5C2.23858 129.417 0 127.178 0 124.417V37C0 34.2386 2.23858 32 5 32H27C29.7614 32 32 29.7614 32 27V5C32 2.23858 34.2386 0 37 0H250C252.761 0 255 2.23858 255 5V124.417Z"
                                                    fill="url(#pattern-card-2)" />
                                            </svg>

                                        </div>
                                        <div class="right">
                                            <div class="top-row">
                                                <div class="tags" aria-hidden="true">
                                                    <div class="tag">Salons</div>
                                                </div>
                                                <div class="icons" aria-hidden="true">
                                                    <button class="first-icon" title="Top-rated">
                                                        <!-- crown -->
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="10" height="9"
                                                            viewBox="0 0 10 9" fill="none">
                                                            <path
                                                                d="M2 8.99999C1.85833 8.99999 1.73967 8.95199 1.644 8.85599C1.54833 8.75999 1.50033 8.64133 1.5 8.49999C1.49967 8.35866 1.54767 8.23999 1.644 8.14399C1.74033 8.04799 1.859 7.99999 2 7.99999H8C8.14166 7.99999 8.2605 8.04799 8.3565 8.14399C8.4525 8.23999 8.50033 8.35866 8.5 8.49999C8.49966 8.64133 8.45166 8.76016 8.356 8.85649C8.26033 8.95283 8.14166 9.00066 8 8.99999H2ZM2.35 7.24999C2.10833 7.24999 1.89383 7.17083 1.7065 7.0125C1.51917 6.85416 1.4045 6.65416 1.3625 6.4125L0.862501 3.2375C0.845834 3.2375 0.827167 3.23967 0.806501 3.244C0.785834 3.24833 0.767001 3.25033 0.750001 3.25C0.541667 3.25 0.364668 3.17717 0.219001 3.0315C0.0733344 2.88583 0.000334469 2.70867 1.13636e-06 2.5C-0.000332197 2.29133 0.0726677 2.11433 0.219001 1.969C0.365334 1.82367 0.542334 1.75067 0.750001 1.75C0.957667 1.74933 1.13483 1.82233 1.2815 1.969C1.42817 2.11567 1.501 2.29267 1.5 2.5C1.5 2.55833 1.49367 2.6125 1.481 2.6625C1.46833 2.7125 1.45383 2.75833 1.4375 2.8L3 3.5L4.5625 1.3625C4.47083 1.29583 4.39583 1.20833 4.3375 1.1C4.27917 0.991667 4.25 0.875 4.25 0.75C4.25 0.541667 4.323 0.364501 4.469 0.218501C4.615 0.0725011 4.792 -0.000332194 5 1.13895e-06C5.208 0.000334472 5.38516 0.0733344 5.5315 0.219001C5.67783 0.364667 5.75066 0.541667 5.75 0.75C5.75 0.875 5.72083 0.991667 5.6625 1.1C5.60416 1.20833 5.52916 1.29583 5.4375 1.3625L7 3.5L8.5625 2.8C8.54583 2.75833 8.53116 2.7125 8.5185 2.6625C8.50583 2.6125 8.49966 2.55833 8.5 2.5C8.5 2.29167 8.573 2.1145 8.719 1.9685C8.865 1.8225 9.042 1.74967 9.25 1.75C9.458 1.75033 9.63516 1.82333 9.7815 1.969C9.92783 2.11467 10.0007 2.29167 10 2.5C9.99933 2.70833 9.92649 2.8855 9.7815 3.0315C9.6365 3.1775 9.45933 3.25033 9.25 3.25C9.23333 3.25 9.21466 3.248 9.194 3.244C9.17333 3.24 9.1545 3.23783 9.1375 3.2375L8.6375 6.4125C8.59583 6.65416 8.48133 6.85416 8.294 7.0125C8.10666 7.17083 7.892 7.24999 7.65 7.24999H2.35ZM2.35 6.25H7.65L7.975 4.1625L7.4 4.4125C7.18333 4.50416 6.9625 4.52083 6.7375 4.4625C6.5125 4.40416 6.32916 4.27916 6.1875 4.0875L5 2.45L3.8125 4.0875C3.67083 4.27916 3.4875 4.40416 3.2625 4.4625C3.0375 4.52083 2.81667 4.50416 2.6 4.4125L2.025 4.1625L2.35 6.25Z"
                                                                fill="white" />
                                                        </svg>
                                                    </button>
                                                    <button class="second-icon" title="Favourite">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="9" height="11"
                                                            viewBox="0 0 9 11" fill="none">
                                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                                d="M3.79701 0.30821C3.81025 0.23997 3.84191 0.176658 3.88858 0.125138C3.93524 0.0736173 3.99512 0.0358558 4.06172 0.0159479C4.12832 -0.00396001 4.1991 -0.00525449 4.26638 0.0122049C4.33367 0.0296642 4.39489 0.0652111 4.4434 0.114991C4.56671 0.240837 4.80378 0.489988 5.04467 0.777274C5.28111 1.05884 5.53916 1.39761 5.68788 1.69951C5.8328 1.99443 5.98661 2.37578 6.10801 2.69421L6.67305 1.75354C6.70456 1.701 6.74826 1.65683 6.80046 1.62476C6.85265 1.59269 6.91181 1.57367 6.97292 1.56931C7.03402 1.56494 7.09528 1.57536 7.1515 1.59969C7.20773 1.62401 7.25727 1.66152 7.29592 1.70905C8.09867 2.70057 8.49846 3.76263 8.6974 4.57365C8.79718 4.97979 8.8474 5.32491 8.87282 5.57025C8.88576 5.69278 8.89424 5.81574 8.89824 5.93889V5.97131C8.89824 8.4482 6.93364 10.4649 4.44785 10.4649C1.96206 10.4649 0 8.44756 0 5.97004C0 5.28805 0.322244 3.68192 1.27563 2.36498C1.31266 2.31422 1.36166 2.27341 1.41826 2.24615C1.47487 2.2189 1.53734 2.20605 1.60011 2.20876C1.66287 2.21146 1.724 2.22963 1.77806 2.26166C1.83211 2.29368 1.87741 2.33856 1.90994 2.39231L2.55507 3.46709C2.75083 3.16073 3.01269 2.73044 3.21163 2.3332C3.49765 1.76117 3.72455 0.682572 3.79701 0.308845M4.3201 0.912655C4.20506 1.42113 4.01501 2.14697 3.77985 2.61858C3.46714 3.24336 3.0165 3.9298 2.86142 4.16051C2.82554 4.21345 2.77693 4.25651 2.72005 4.28574C2.66317 4.31497 2.59986 4.32943 2.53593 4.32778C2.472 4.32614 2.40952 4.30844 2.35422 4.27632C2.29892 4.24421 2.25258 4.1987 2.21948 4.14399L1.57118 3.06476C0.87457 4.19166 0.635589 5.45839 0.635589 5.97131C0.635589 8.10561 2.32244 9.82806 4.44785 9.82806C6.57326 9.82806 8.26265 8.10561 8.26265 5.97131V5.95351L8.26011 5.88995C8.25568 5.80484 8.24911 5.71986 8.24041 5.63508C8.20712 5.3287 8.15362 5.02487 8.08024 4.72555C7.87826 3.89157 7.52027 3.10334 7.02516 2.40248L6.38068 3.47535C6.34338 3.53732 6.28925 3.58743 6.22459 3.61985C6.15993 3.65227 6.08739 3.66566 6.01542 3.65847C5.94344 3.65128 5.87499 3.6238 5.81802 3.57923C5.76105 3.53466 5.71791 3.47483 5.6936 3.40671C5.59064 3.11815 5.33831 2.42917 5.11713 1.98044C5.00463 1.751 4.78916 1.46117 4.55781 1.18596C4.4801 1.09353 4.40086 1.00242 4.3201 0.912655Z"
                                                                fill="#FEFEFE" />
                                                        </svg>
                                                    </button>
                                                    <button class="third-icon" title="lock">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="8" height="10"
                                                            viewBox="0 0 8 10" fill="none">
                                                            <path
                                                                d="M4 7.61905C3.73478 7.61905 3.48043 7.51871 3.29289 7.3401C3.10536 7.1615 3 6.91925 3 6.66667C3 6.1381 3.445 5.71429 4 5.71429C4.26522 5.71429 4.51957 5.81463 4.70711 5.99323C4.89464 6.17184 5 6.41408 5 6.66667C5 6.91925 4.89464 7.1615 4.70711 7.3401C4.51957 7.51871 4.26522 7.61905 4 7.61905ZM7 9.04762V4.28571H1V9.04762H7ZM7 3.33333C7.26522 3.33333 7.51957 3.43367 7.70711 3.61228C7.89464 3.79089 8 4.03313 8 4.28571V9.04762C8 9.30021 7.89464 9.54245 7.70711 9.72105C7.51957 9.89966 7.26522 10 7 10H1C0.734784 10 0.48043 9.89966 0.292893 9.72105C0.105357 9.54245 0 9.30021 0 9.04762V4.28571C0 3.75714 0.445 3.33333 1 3.33333H1.5V2.38095C1.5 1.74948 1.76339 1.14388 2.23223 0.697365C2.70107 0.25085 3.33696 0 4 0C4.3283 0 4.65339 0.0615852 4.95671 0.181239C5.26002 0.300893 5.53562 0.476273 5.76777 0.697365C5.99991 0.918457 6.18406 1.18093 6.3097 1.4698C6.43534 1.75867 6.5 2.06828 6.5 2.38095V3.33333H7ZM4 0.952381C3.60218 0.952381 3.22064 1.10289 2.93934 1.3708C2.65804 1.63871 2.5 2.00207 2.5 2.38095V3.33333H5.5V2.38095C5.5 2.00207 5.34196 1.63871 5.06066 1.3708C4.77936 1.10289 4.39782 0.952381 4 0.952381Z"
                                                                fill="white" />
                                                        </svg>
                                                    </button>
                                                </div>
                                            </div>

                                            <h2 class="name">Paws & Bubbles</h2>
                                            <p class="hosted-by">Hosted by <span>Dev É.</span></p>

                                            <div class="studio-details mt-1 d-flex flex-column justify-content-between mt-2">

                                                <div class="meta d-flex align-items-center justify-content-between">
                                                    <div class="distance" title="Distance">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="10" height="14"
                                                            viewBox="0 0 10 14" fill="none">
                                                            <path
                                                                d="M5 6.65C4.5264 6.65 4.0722 6.46563 3.73731 6.13744C3.40242 5.80925 3.21429 5.36413 3.21429 4.9C3.21429 4.43587 3.40242 3.99075 3.73731 3.66256C4.0722 3.33437 4.5264 3.15 5 3.15C5.4736 3.15 5.9278 3.33437 6.26269 3.66256C6.59758 3.99075 6.78571 4.43587 6.78571 4.9C6.78571 5.12981 6.73953 5.35738 6.64979 5.5697C6.56004 5.78202 6.42851 5.97493 6.26269 6.13744C6.09687 6.29994 5.90002 6.42884 5.68336 6.51679C5.46671 6.60473 5.2345 6.65 5 6.65ZM5 0C3.67392 0 2.40215 0.516248 1.46447 1.43518C0.526784 2.3541 0 3.60044 0 4.9C0 8.575 5 14 5 14C5 14 10 8.575 10 4.9C10 3.60044 9.47322 2.3541 8.53553 1.43518C7.59785 0.516248 6.32608 0 5 0Z"
                                                                fill="var(--active-bg)" />
                                                        </svg>
                                                        <span>2.5 mi</span>
                                                    </div>


                                                    <div class="rating" title="Rating">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                            viewBox="0 0 14 14" fill="none">
                                                            <path
                                                                d="M6.12956 0.660476C6.40354 -0.220161 7.59647 -0.220158 7.87045 0.660479L8.89548 3.95519C9.01801 4.34902 9.36942 4.61566 9.76593 4.61566H13.083C13.9696 4.61566 14.3383 5.80055 13.621 6.34481L10.9374 8.38106C10.6166 8.62446 10.4824 9.0559 10.6049 9.44973L11.63 12.7444C11.9039 13.6251 10.9388 14.3574 10.2215 13.8131L7.53797 11.7769C7.21719 11.5335 6.78282 11.5335 6.46204 11.7769L3.77846 13.8131C3.06117 14.3574 2.09607 13.6251 2.37005 12.7444L3.39508 9.44973C3.51761 9.0559 3.38338 8.62446 3.0626 8.38106L0.37903 6.34481C-0.338258 5.80055 0.0303816 4.61566 0.916998 4.61566H4.23408C4.63058 4.61566 4.98199 4.34902 5.10452 3.95519L6.12956 0.660476Z"
                                                                fill="var(--active-bg)" />
                                                        </svg>
                                                        <span>4.3 <small style="color:var(--muted)">(20)</small></span>
                                                    </div>
                                                </div>
                                            </div>



                                            <p class="experience">Fully equipped mobile grooming van. <br> Clean,
                                                convenient, and perfect for on-<br>the-go appointments!</p>


                                            <p class="amenities d-flex">
                                                <b>Amenities:</b>&nbsp;Bath &#8226; Table &#8226; Dryer ...
                                            </p>


                                            <div class="availability mt-3">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15"
                                                    viewBox="0 0 15 15" fill="none">
                                                    <path
                                                        d="M7.5 0C3.375 0 0 3.375 0 7.5C0 11.625 3.375 15 7.5 15C11.625 15 15 11.625 15 7.5C15 3.375 11.625 0 7.5 0ZM6 11.25L2.25 7.5L3.3075 6.4425L6 9.1275L11.6925 3.435L12.75 4.5L6 11.25Z"
                                                        fill="#D8E8B7" />
                                                </svg>
                                                <span>Availability</span>
                                            </div>


                                            <div class="slots-price d-flex flex-column">
                                                <div class="slots d-flex flex-column" aria-label="Available slots">
                                                    <div class="slot highlight">Mon 1, 08:30 AM</div>
                                                    <div class="slot">Wed 27, 09:15 AM</div>
                                                </div>
                                                <div class="price">From <span>£38</span> <span class="time-frame">/
                                                        hour</span></div>
                                            </div>



                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="card space-cards flex-column active">
                                        <div class="left">
                                            <div class="top-left-svg">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="21" height="22"
                                                    viewBox="0 0 21 22" fill="none">
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
                                                        d="M6.83331 13.4703C6.83331 13.4703 8.2222 13.7392 9.61109 12.667L6.83331 13.4703Z"
                                                        fill="#CBDCE8" />
                                                    <path d="M6.83331 13.4703C6.83331 13.4703 8.2222 13.7392 9.61109 12.667"
                                                        stroke="white" stroke-linecap="round" stroke-linejoin="round" />
                                                    <path
                                                        d="M9.05558 8.36144C9.05558 8.54561 8.98241 8.72225 8.85218 8.85248C8.72194 8.98272 8.54531 9.05588 8.36113 9.05588C8.17695 9.05588 8.00032 8.98272 7.87009 8.85248C7.73985 8.72225 7.66669 8.54561 7.66669 8.36144C7.66669 8.17726 7.73985 8.00062 7.87009 7.87039C8.00032 7.74016 8.17695 7.66699 8.36113 7.66699C8.54531 7.66699 8.72194 7.74016 8.85218 7.87039C8.98241 8.00062 9.05558 8.17726 9.05558 8.36144Z"
                                                        fill="#CBDCE8" stroke="white" />
                                                    <path d="M10.4445 6.55554V6.6111V6.55554Z" fill="#CBDCE8" />
                                                    <path d="M10.4445 6.55554V6.6111" stroke="white" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                </svg>
                                            </div>
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 255 130" fill="none">
                                                <defs>
                                                    <pattern id="pattern-card-3" patternUnits="userSpaceOnUse" width="255"
                                                        height="130">
                                                        <image href="<?= BASE_URL ?>/assets/images/space_card3.png" width="255"
                                                            height="130" preserveAspectRatio="xMidYMid slice" />
                                                    </pattern>
                                                </defs>

                                                <path
                                                    d="M255 124.417C255 127.178 252.761 129.417 250 129.417H5C2.23858 129.417 0 127.178 0 124.417V37C0 34.2386 2.23858 32 5 32H27C29.7614 32 32 29.7614 32 27V5C32 2.23858 34.2386 0 37 0H250C252.761 0 255 2.23858 255 5V124.417Z"
                                                    fill="url(#pattern-card-3)" />
                                            </svg>

                                        </div>
                                        <div class="right">
                                            <div class="top-row">
                                                <div class="tags" aria-hidden="true">
                                                    <div class="tag">Salons</div>
                                                </div>
                                                <div class="icons" aria-hidden="true">
                                                    <button class="first-icon" title="Top-rated">
                                                        <!-- crown -->
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="10" height="9"
                                                            viewBox="0 0 10 9" fill="none">
                                                            <path
                                                                d="M2 8.99999C1.85833 8.99999 1.73967 8.95199 1.644 8.85599C1.54833 8.75999 1.50033 8.64133 1.5 8.49999C1.49967 8.35866 1.54767 8.23999 1.644 8.14399C1.74033 8.04799 1.859 7.99999 2 7.99999H8C8.14166 7.99999 8.2605 8.04799 8.3565 8.14399C8.4525 8.23999 8.50033 8.35866 8.5 8.49999C8.49966 8.64133 8.45166 8.76016 8.356 8.85649C8.26033 8.95283 8.14166 9.00066 8 8.99999H2ZM2.35 7.24999C2.10833 7.24999 1.89383 7.17083 1.7065 7.0125C1.51917 6.85416 1.4045 6.65416 1.3625 6.4125L0.862501 3.2375C0.845834 3.2375 0.827167 3.23967 0.806501 3.244C0.785834 3.24833 0.767001 3.25033 0.750001 3.25C0.541667 3.25 0.364668 3.17717 0.219001 3.0315C0.0733344 2.88583 0.000334469 2.70867 1.13636e-06 2.5C-0.000332197 2.29133 0.0726677 2.11433 0.219001 1.969C0.365334 1.82367 0.542334 1.75067 0.750001 1.75C0.957667 1.74933 1.13483 1.82233 1.2815 1.969C1.42817 2.11567 1.501 2.29267 1.5 2.5C1.5 2.55833 1.49367 2.6125 1.481 2.6625C1.46833 2.7125 1.45383 2.75833 1.4375 2.8L3 3.5L4.5625 1.3625C4.47083 1.29583 4.39583 1.20833 4.3375 1.1C4.27917 0.991667 4.25 0.875 4.25 0.75C4.25 0.541667 4.323 0.364501 4.469 0.218501C4.615 0.0725011 4.792 -0.000332194 5 1.13895e-06C5.208 0.000334472 5.38516 0.0733344 5.5315 0.219001C5.67783 0.364667 5.75066 0.541667 5.75 0.75C5.75 0.875 5.72083 0.991667 5.6625 1.1C5.60416 1.20833 5.52916 1.29583 5.4375 1.3625L7 3.5L8.5625 2.8C8.54583 2.75833 8.53116 2.7125 8.5185 2.6625C8.50583 2.6125 8.49966 2.55833 8.5 2.5C8.5 2.29167 8.573 2.1145 8.719 1.9685C8.865 1.8225 9.042 1.74967 9.25 1.75C9.458 1.75033 9.63516 1.82333 9.7815 1.969C9.92783 2.11467 10.0007 2.29167 10 2.5C9.99933 2.70833 9.92649 2.8855 9.7815 3.0315C9.6365 3.1775 9.45933 3.25033 9.25 3.25C9.23333 3.25 9.21466 3.248 9.194 3.244C9.17333 3.24 9.1545 3.23783 9.1375 3.2375L8.6375 6.4125C8.59583 6.65416 8.48133 6.85416 8.294 7.0125C8.10666 7.17083 7.892 7.24999 7.65 7.24999H2.35ZM2.35 6.25H7.65L7.975 4.1625L7.4 4.4125C7.18333 4.50416 6.9625 4.52083 6.7375 4.4625C6.5125 4.40416 6.32916 4.27916 6.1875 4.0875L5 2.45L3.8125 4.0875C3.67083 4.27916 3.4875 4.40416 3.2625 4.4625C3.0375 4.52083 2.81667 4.50416 2.6 4.4125L2.025 4.1625L2.35 6.25Z"
                                                                fill="white" />
                                                        </svg>
                                                    </button>
                                                    <button class="second-icon" title="Favourite">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="9" height="11"
                                                            viewBox="0 0 9 11" fill="none">
                                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                                d="M3.79701 0.30821C3.81025 0.23997 3.84191 0.176658 3.88858 0.125138C3.93524 0.0736173 3.99512 0.0358558 4.06172 0.0159479C4.12832 -0.00396001 4.1991 -0.00525449 4.26638 0.0122049C4.33367 0.0296642 4.39489 0.0652111 4.4434 0.114991C4.56671 0.240837 4.80378 0.489988 5.04467 0.777274C5.28111 1.05884 5.53916 1.39761 5.68788 1.69951C5.8328 1.99443 5.98661 2.37578 6.10801 2.69421L6.67305 1.75354C6.70456 1.701 6.74826 1.65683 6.80046 1.62476C6.85265 1.59269 6.91181 1.57367 6.97292 1.56931C7.03402 1.56494 7.09528 1.57536 7.1515 1.59969C7.20773 1.62401 7.25727 1.66152 7.29592 1.70905C8.09867 2.70057 8.49846 3.76263 8.6974 4.57365C8.79718 4.97979 8.8474 5.32491 8.87282 5.57025C8.88576 5.69278 8.89424 5.81574 8.89824 5.93889V5.97131C8.89824 8.4482 6.93364 10.4649 4.44785 10.4649C1.96206 10.4649 0 8.44756 0 5.97004C0 5.28805 0.322244 3.68192 1.27563 2.36498C1.31266 2.31422 1.36166 2.27341 1.41826 2.24615C1.47487 2.2189 1.53734 2.20605 1.60011 2.20876C1.66287 2.21146 1.724 2.22963 1.77806 2.26166C1.83211 2.29368 1.87741 2.33856 1.90994 2.39231L2.55507 3.46709C2.75083 3.16073 3.01269 2.73044 3.21163 2.3332C3.49765 1.76117 3.72455 0.682572 3.79701 0.308845M4.3201 0.912655C4.20506 1.42113 4.01501 2.14697 3.77985 2.61858C3.46714 3.24336 3.0165 3.9298 2.86142 4.16051C2.82554 4.21345 2.77693 4.25651 2.72005 4.28574C2.66317 4.31497 2.59986 4.32943 2.53593 4.32778C2.472 4.32614 2.40952 4.30844 2.35422 4.27632C2.29892 4.24421 2.25258 4.1987 2.21948 4.14399L1.57118 3.06476C0.87457 4.19166 0.635589 5.45839 0.635589 5.97131C0.635589 8.10561 2.32244 9.82806 4.44785 9.82806C6.57326 9.82806 8.26265 8.10561 8.26265 5.97131V5.95351L8.26011 5.88995C8.25568 5.80484 8.24911 5.71986 8.24041 5.63508C8.20712 5.3287 8.15362 5.02487 8.08024 4.72555C7.87826 3.89157 7.52027 3.10334 7.02516 2.40248L6.38068 3.47535C6.34338 3.53732 6.28925 3.58743 6.22459 3.61985C6.15993 3.65227 6.08739 3.66566 6.01542 3.65847C5.94344 3.65128 5.87499 3.6238 5.81802 3.57923C5.76105 3.53466 5.71791 3.47483 5.6936 3.40671C5.59064 3.11815 5.33831 2.42917 5.11713 1.98044C5.00463 1.751 4.78916 1.46117 4.55781 1.18596C4.4801 1.09353 4.40086 1.00242 4.3201 0.912655Z"
                                                                fill="#FEFEFE" />
                                                        </svg>
                                                    </button>
                                                    <button class="third-icon" title="lock">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="8" height="10"
                                                            viewBox="0 0 8 10" fill="none">
                                                            <path
                                                                d="M4 7.61905C3.73478 7.61905 3.48043 7.51871 3.29289 7.3401C3.10536 7.1615 3 6.91925 3 6.66667C3 6.1381 3.445 5.71429 4 5.71429C4.26522 5.71429 4.51957 5.81463 4.70711 5.99323C4.89464 6.17184 5 6.41408 5 6.66667C5 6.91925 4.89464 7.1615 4.70711 7.3401C4.51957 7.51871 4.26522 7.61905 4 7.61905ZM7 9.04762V4.28571H1V9.04762H7ZM7 3.33333C7.26522 3.33333 7.51957 3.43367 7.70711 3.61228C7.89464 3.79089 8 4.03313 8 4.28571V9.04762C8 9.30021 7.89464 9.54245 7.70711 9.72105C7.51957 9.89966 7.26522 10 7 10H1C0.734784 10 0.48043 9.89966 0.292893 9.72105C0.105357 9.54245 0 9.30021 0 9.04762V4.28571C0 3.75714 0.445 3.33333 1 3.33333H1.5V2.38095C1.5 1.74948 1.76339 1.14388 2.23223 0.697365C2.70107 0.25085 3.33696 0 4 0C4.3283 0 4.65339 0.0615852 4.95671 0.181239C5.26002 0.300893 5.53562 0.476273 5.76777 0.697365C5.99991 0.918457 6.18406 1.18093 6.3097 1.4698C6.43534 1.75867 6.5 2.06828 6.5 2.38095V3.33333H7ZM4 0.952381C3.60218 0.952381 3.22064 1.10289 2.93934 1.3708C2.65804 1.63871 2.5 2.00207 2.5 2.38095V3.33333H5.5V2.38095C5.5 2.00207 5.34196 1.63871 5.06066 1.3708C4.77936 1.10289 4.39782 0.952381 4 0.952381Z"
                                                                fill="white" />
                                                        </svg>
                                                    </button>
                                                </div>
                                            </div>

                                            <h2 class="name">The Garden Grooming Spot</h2>
                                            <p class="hosted-by">Hosted by <span>Dev É.</span></p>

                                            <div class="studio-details mt-1 d-flex flex-column justify-content-between mt-2">

                                                <div class="meta d-flex align-items-center justify-content-between">
                                                    <div class="distance" title="Distance">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="10" height="14"
                                                            viewBox="0 0 10 14" fill="none">
                                                            <path
                                                                d="M5 6.65C4.5264 6.65 4.0722 6.46563 3.73731 6.13744C3.40242 5.80925 3.21429 5.36413 3.21429 4.9C3.21429 4.43587 3.40242 3.99075 3.73731 3.66256C4.0722 3.33437 4.5264 3.15 5 3.15C5.4736 3.15 5.9278 3.33437 6.26269 3.66256C6.59758 3.99075 6.78571 4.43587 6.78571 4.9C6.78571 5.12981 6.73953 5.35738 6.64979 5.5697C6.56004 5.78202 6.42851 5.97493 6.26269 6.13744C6.09687 6.29994 5.90002 6.42884 5.68336 6.51679C5.46671 6.60473 5.2345 6.65 5 6.65ZM5 0C3.67392 0 2.40215 0.516248 1.46447 1.43518C0.526784 2.3541 0 3.60044 0 4.9C0 8.575 5 14 5 14C5 14 10 8.575 10 4.9C10 3.60044 9.47322 2.3541 8.53553 1.43518C7.59785 0.516248 6.32608 0 5 0Z"
                                                                fill="var(--active-bg)" />
                                                        </svg>
                                                        <span>2.5 mi</span>
                                                    </div>


                                                    <div class="rating" title="Rating">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                            viewBox="0 0 14 14" fill="none">
                                                            <path
                                                                d="M6.12956 0.660476C6.40354 -0.220161 7.59647 -0.220158 7.87045 0.660479L8.89548 3.95519C9.01801 4.34902 9.36942 4.61566 9.76593 4.61566H13.083C13.9696 4.61566 14.3383 5.80055 13.621 6.34481L10.9374 8.38106C10.6166 8.62446 10.4824 9.0559 10.6049 9.44973L11.63 12.7444C11.9039 13.6251 10.9388 14.3574 10.2215 13.8131L7.53797 11.7769C7.21719 11.5335 6.78282 11.5335 6.46204 11.7769L3.77846 13.8131C3.06117 14.3574 2.09607 13.6251 2.37005 12.7444L3.39508 9.44973C3.51761 9.0559 3.38338 8.62446 3.0626 8.38106L0.37903 6.34481C-0.338258 5.80055 0.0303816 4.61566 0.916998 4.61566H4.23408C4.63058 4.61566 4.98199 4.34902 5.10452 3.95519L6.12956 0.660476Z"
                                                                fill="var(--active-bg)" />
                                                        </svg>
                                                        <span>4.3 <small style="color:var(--muted)">(20)</small></span>
                                                    </div>
                                                </div>
                                            </div>



                                            <p class="experience">Outdoor garden grooming area. Calm, <br> spacious,
                                                and ideal for stress-free <br> sessions in fresh air.</p>


                                            <p class="amenities d-flex">
                                                <b>Amenities:</b>&nbsp;Bath &#8226; Table &#8226; Dryer ...
                                            </p>


                                            <div class="availability mt-3">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15"
                                                    viewBox="0 0 15 15" fill="none">
                                                    <path
                                                        d="M7.5 0C3.375 0 0 3.375 0 7.5C0 11.625 3.375 15 7.5 15C11.625 15 15 11.625 15 7.5C15 3.375 11.625 0 7.5 0ZM6 11.25L2.25 7.5L3.3075 6.4425L6 9.1275L11.6925 3.435L12.75 4.5L6 11.25Z"
                                                        fill="#D8E8B7" />
                                                </svg>
                                                <span>Availability</span>
                                            </div>


                                            <div class="slots-price d-flex flex-column">
                                                <div class="slots d-flex flex-column" aria-label="Available slots">
                                                    <div class="slot highlight">Mon 1, 08:30 AM</div>
                                                    <div class="slot">Wed 27, 09:15 AM</div>
                                                </div>
                                                <div class="price">From <span>£38</span> <span class="time-frame">/
                                                        hour</span></div>
                                            </div>



                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="card space-cards flex-column active">
                                        <div class="left">
                                            <div class="top-left-svg">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="21" height="22"
                                                    viewBox="0 0 21 22" fill="none">
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
                                                        d="M6.83331 13.4703C6.83331 13.4703 8.2222 13.7392 9.61109 12.667L6.83331 13.4703Z"
                                                        fill="#CBDCE8" />
                                                    <path d="M6.83331 13.4703C6.83331 13.4703 8.2222 13.7392 9.61109 12.667"
                                                        stroke="white" stroke-linecap="round" stroke-linejoin="round" />
                                                    <path
                                                        d="M9.05558 8.36144C9.05558 8.54561 8.98241 8.72225 8.85218 8.85248C8.72194 8.98272 8.54531 9.05588 8.36113 9.05588C8.17695 9.05588 8.00032 8.98272 7.87009 8.85248C7.73985 8.72225 7.66669 8.54561 7.66669 8.36144C7.66669 8.17726 7.73985 8.00062 7.87009 7.87039C8.00032 7.74016 8.17695 7.66699 8.36113 7.66699C8.54531 7.66699 8.72194 7.74016 8.85218 7.87039C8.98241 8.00062 9.05558 8.17726 9.05558 8.36144Z"
                                                        fill="#CBDCE8" stroke="white" />
                                                    <path d="M10.4445 6.55554V6.6111V6.55554Z" fill="#CBDCE8" />
                                                    <path d="M10.4445 6.55554V6.6111" stroke="white" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                </svg>
                                            </div>
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 255 130" fill="none">
                                                <defs>
                                                    <pattern id="pattern-card-4" patternUnits="userSpaceOnUse" width="255"
                                                        height="130">
                                                        <image href="<?= BASE_URL ?>/assets/images/space_card1.png" width="255"
                                                            height="130" preserveAspectRatio="xMidYMid slice" />
                                                    </pattern>
                                                </defs>

                                                <path
                                                    d="M255 124.417C255 127.178 252.761 129.417 250 129.417H5C2.23858 129.417 0 127.178 0 124.417V37C0 34.2386 2.23858 32 5 32H27C29.7614 32 32 29.7614 32 27V5C32 2.23858 34.2386 0 37 0H250C252.761 0 255 2.23858 255 5V124.417Z"
                                                    fill="url(#pattern-card-4)" />
                                            </svg>

                                        </div>
                                        <div class="right">
                                            <div class="top-row">
                                                <div class="tags" aria-hidden="true">
                                                    <div class="tag">Salons</div>
                                                </div>
                                                <div class="icons" aria-hidden="true">
                                                    <button class="first-icon" title="Top-rated">
                                                        <!-- crown -->
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="10" height="9"
                                                            viewBox="0 0 10 9" fill="none">
                                                            <path
                                                                d="M2 8.99999C1.85833 8.99999 1.73967 8.95199 1.644 8.85599C1.54833 8.75999 1.50033 8.64133 1.5 8.49999C1.49967 8.35866 1.54767 8.23999 1.644 8.14399C1.74033 8.04799 1.859 7.99999 2 7.99999H8C8.14166 7.99999 8.2605 8.04799 8.3565 8.14399C8.4525 8.23999 8.50033 8.35866 8.5 8.49999C8.49966 8.64133 8.45166 8.76016 8.356 8.85649C8.26033 8.95283 8.14166 9.00066 8 8.99999H2ZM2.35 7.24999C2.10833 7.24999 1.89383 7.17083 1.7065 7.0125C1.51917 6.85416 1.4045 6.65416 1.3625 6.4125L0.862501 3.2375C0.845834 3.2375 0.827167 3.23967 0.806501 3.244C0.785834 3.24833 0.767001 3.25033 0.750001 3.25C0.541667 3.25 0.364668 3.17717 0.219001 3.0315C0.0733344 2.88583 0.000334469 2.70867 1.13636e-06 2.5C-0.000332197 2.29133 0.0726677 2.11433 0.219001 1.969C0.365334 1.82367 0.542334 1.75067 0.750001 1.75C0.957667 1.74933 1.13483 1.82233 1.2815 1.969C1.42817 2.11567 1.501 2.29267 1.5 2.5C1.5 2.55833 1.49367 2.6125 1.481 2.6625C1.46833 2.7125 1.45383 2.75833 1.4375 2.8L3 3.5L4.5625 1.3625C4.47083 1.29583 4.39583 1.20833 4.3375 1.1C4.27917 0.991667 4.25 0.875 4.25 0.75C4.25 0.541667 4.323 0.364501 4.469 0.218501C4.615 0.0725011 4.792 -0.000332194 5 1.13895e-06C5.208 0.000334472 5.38516 0.0733344 5.5315 0.219001C5.67783 0.364667 5.75066 0.541667 5.75 0.75C5.75 0.875 5.72083 0.991667 5.6625 1.1C5.60416 1.20833 5.52916 1.29583 5.4375 1.3625L7 3.5L8.5625 2.8C8.54583 2.75833 8.53116 2.7125 8.5185 2.6625C8.50583 2.6125 8.49966 2.55833 8.5 2.5C8.5 2.29167 8.573 2.1145 8.719 1.9685C8.865 1.8225 9.042 1.74967 9.25 1.75C9.458 1.75033 9.63516 1.82333 9.7815 1.969C9.92783 2.11467 10.0007 2.29167 10 2.5C9.99933 2.70833 9.92649 2.8855 9.7815 3.0315C9.6365 3.1775 9.45933 3.25033 9.25 3.25C9.23333 3.25 9.21466 3.248 9.194 3.244C9.17333 3.24 9.1545 3.23783 9.1375 3.2375L8.6375 6.4125C8.59583 6.65416 8.48133 6.85416 8.294 7.0125C8.10666 7.17083 7.892 7.24999 7.65 7.24999H2.35ZM2.35 6.25H7.65L7.975 4.1625L7.4 4.4125C7.18333 4.50416 6.9625 4.52083 6.7375 4.4625C6.5125 4.40416 6.32916 4.27916 6.1875 4.0875L5 2.45L3.8125 4.0875C3.67083 4.27916 3.4875 4.40416 3.2625 4.4625C3.0375 4.52083 2.81667 4.50416 2.6 4.4125L2.025 4.1625L2.35 6.25Z"
                                                                fill="white" />
                                                        </svg>
                                                    </button>
                                                    <button class="second-icon" title="Favourite">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="9" height="11"
                                                            viewBox="0 0 9 11" fill="none">
                                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                                d="M3.79701 0.30821C3.81025 0.23997 3.84191 0.176658 3.88858 0.125138C3.93524 0.0736173 3.99512 0.0358558 4.06172 0.0159479C4.12832 -0.00396001 4.1991 -0.00525449 4.26638 0.0122049C4.33367 0.0296642 4.39489 0.0652111 4.4434 0.114991C4.56671 0.240837 4.80378 0.489988 5.04467 0.777274C5.28111 1.05884 5.53916 1.39761 5.68788 1.69951C5.8328 1.99443 5.98661 2.37578 6.10801 2.69421L6.67305 1.75354C6.70456 1.701 6.74826 1.65683 6.80046 1.62476C6.85265 1.59269 6.91181 1.57367 6.97292 1.56931C7.03402 1.56494 7.09528 1.57536 7.1515 1.59969C7.20773 1.62401 7.25727 1.66152 7.29592 1.70905C8.09867 2.70057 8.49846 3.76263 8.6974 4.57365C8.79718 4.97979 8.8474 5.32491 8.87282 5.57025C8.88576 5.69278 8.89424 5.81574 8.89824 5.93889V5.97131C8.89824 8.4482 6.93364 10.4649 4.44785 10.4649C1.96206 10.4649 0 8.44756 0 5.97004C0 5.28805 0.322244 3.68192 1.27563 2.36498C1.31266 2.31422 1.36166 2.27341 1.41826 2.24615C1.47487 2.2189 1.53734 2.20605 1.60011 2.20876C1.66287 2.21146 1.724 2.22963 1.77806 2.26166C1.83211 2.29368 1.87741 2.33856 1.90994 2.39231L2.55507 3.46709C2.75083 3.16073 3.01269 2.73044 3.21163 2.3332C3.49765 1.76117 3.72455 0.682572 3.79701 0.308845M4.3201 0.912655C4.20506 1.42113 4.01501 2.14697 3.77985 2.61858C3.46714 3.24336 3.0165 3.9298 2.86142 4.16051C2.82554 4.21345 2.77693 4.25651 2.72005 4.28574C2.66317 4.31497 2.59986 4.32943 2.53593 4.32778C2.472 4.32614 2.40952 4.30844 2.35422 4.27632C2.29892 4.24421 2.25258 4.1987 2.21948 4.14399L1.57118 3.06476C0.87457 4.19166 0.635589 5.45839 0.635589 5.97131C0.635589 8.10561 2.32244 9.82806 4.44785 9.82806C6.57326 9.82806 8.26265 8.10561 8.26265 5.97131V5.95351L8.26011 5.88995C8.25568 5.80484 8.24911 5.71986 8.24041 5.63508C8.20712 5.3287 8.15362 5.02487 8.08024 4.72555C7.87826 3.89157 7.52027 3.10334 7.02516 2.40248L6.38068 3.47535C6.34338 3.53732 6.28925 3.58743 6.22459 3.61985C6.15993 3.65227 6.08739 3.66566 6.01542 3.65847C5.94344 3.65128 5.87499 3.6238 5.81802 3.57923C5.76105 3.53466 5.71791 3.47483 5.6936 3.40671C5.59064 3.11815 5.33831 2.42917 5.11713 1.98044C5.00463 1.751 4.78916 1.46117 4.55781 1.18596C4.4801 1.09353 4.40086 1.00242 4.3201 0.912655Z"
                                                                fill="#FEFEFE" />
                                                        </svg>
                                                    </button>
                                                    <button class="third-icon" title="lock">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="8" height="10"
                                                            viewBox="0 0 8 10" fill="none">
                                                            <path
                                                                d="M4 7.61905C3.73478 7.61905 3.48043 7.51871 3.29289 7.3401C3.10536 7.1615 3 6.91925 3 6.66667C3 6.1381 3.445 5.71429 4 5.71429C4.26522 5.71429 4.51957 5.81463 4.70711 5.99323C4.89464 6.17184 5 6.41408 5 6.66667C5 6.91925 4.89464 7.1615 4.70711 7.3401C4.51957 7.51871 4.26522 7.61905 4 7.61905ZM7 9.04762V4.28571H1V9.04762H7ZM7 3.33333C7.26522 3.33333 7.51957 3.43367 7.70711 3.61228C7.89464 3.79089 8 4.03313 8 4.28571V9.04762C8 9.30021 7.89464 9.54245 7.70711 9.72105C7.51957 9.89966 7.26522 10 7 10H1C0.734784 10 0.48043 9.89966 0.292893 9.72105C0.105357 9.54245 0 9.30021 0 9.04762V4.28571C0 3.75714 0.445 3.33333 1 3.33333H1.5V2.38095C1.5 1.74948 1.76339 1.14388 2.23223 0.697365C2.70107 0.25085 3.33696 0 4 0C4.3283 0 4.65339 0.0615852 4.95671 0.181239C5.26002 0.300893 5.53562 0.476273 5.76777 0.697365C5.99991 0.918457 6.18406 1.18093 6.3097 1.4698C6.43534 1.75867 6.5 2.06828 6.5 2.38095V3.33333H7ZM4 0.952381C3.60218 0.952381 3.22064 1.10289 2.93934 1.3708C2.65804 1.63871 2.5 2.00207 2.5 2.38095V3.33333H5.5V2.38095C5.5 2.00207 5.34196 1.63871 5.06066 1.3708C4.77936 1.10289 4.39782 0.952381 4 0.952381Z"
                                                                fill="white" />
                                                        </svg>
                                                    </button>
                                                </div>
                                            </div>

                                            <h2 class="name">Furs & Co. Studio</h2>
                                            <p class="hosted-by">Hosted by <span>Dev É.</span></p>

                                            <div class="studio-details mt-1 d-flex flex-column justify-content-between mt-2">

                                                <div class="meta d-flex align-items-center justify-content-between">
                                                    <div class="distance" title="Distance">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="10" height="14"
                                                            viewBox="0 0 10 14" fill="none">
                                                            <path
                                                                d="M5 6.65C4.5264 6.65 4.0722 6.46563 3.73731 6.13744C3.40242 5.80925 3.21429 5.36413 3.21429 4.9C3.21429 4.43587 3.40242 3.99075 3.73731 3.66256C4.0722 3.33437 4.5264 3.15 5 3.15C5.4736 3.15 5.9278 3.33437 6.26269 3.66256C6.59758 3.99075 6.78571 4.43587 6.78571 4.9C6.78571 5.12981 6.73953 5.35738 6.64979 5.5697C6.56004 5.78202 6.42851 5.97493 6.26269 6.13744C6.09687 6.29994 5.90002 6.42884 5.68336 6.51679C5.46671 6.60473 5.2345 6.65 5 6.65ZM5 0C3.67392 0 2.40215 0.516248 1.46447 1.43518C0.526784 2.3541 0 3.60044 0 4.9C0 8.575 5 14 5 14C5 14 10 8.575 10 4.9C10 3.60044 9.47322 2.3541 8.53553 1.43518C7.59785 0.516248 6.32608 0 5 0Z"
                                                                fill="var(--active-bg)" />
                                                        </svg>
                                                        <span>2.5 mi</span>
                                                    </div>


                                                    <div class="rating" title="Rating">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                            viewBox="0 0 14 14" fill="none">
                                                            <path
                                                                d="M6.12956 0.660476C6.40354 -0.220161 7.59647 -0.220158 7.87045 0.660479L8.89548 3.95519C9.01801 4.34902 9.36942 4.61566 9.76593 4.61566H13.083C13.9696 4.61566 14.3383 5.80055 13.621 6.34481L10.9374 8.38106C10.6166 8.62446 10.4824 9.0559 10.6049 9.44973L11.63 12.7444C11.9039 13.6251 10.9388 14.3574 10.2215 13.8131L7.53797 11.7769C7.21719 11.5335 6.78282 11.5335 6.46204 11.7769L3.77846 13.8131C3.06117 14.3574 2.09607 13.6251 2.37005 12.7444L3.39508 9.44973C3.51761 9.0559 3.38338 8.62446 3.0626 8.38106L0.37903 6.34481C-0.338258 5.80055 0.0303816 4.61566 0.916998 4.61566H4.23408C4.63058 4.61566 4.98199 4.34902 5.10452 3.95519L6.12956 0.660476Z"
                                                                fill="var(--active-bg)" />
                                                        </svg>
                                                        <span>4.3 <small style="color:var(--muted)">(20)</small></span>
                                                    </div>
                                                </div>
                                            </div>



                                            <p class="experience">Professional grooming spaces in <br> London.
                                                Spotless, well-equipped, easy <br> to access.</p>


                                            <p class="amenities d-flex">
                                                <b>Amenities:</b>&nbsp;Bath &#8226; Table &#8226; Dryer ...
                                            </p>


                                            <div class="availability mt-3">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15"
                                                    viewBox="0 0 15 15" fill="none">
                                                    <path
                                                        d="M7.5 0C3.375 0 0 3.375 0 7.5C0 11.625 3.375 15 7.5 15C11.625 15 15 11.625 15 7.5C15 3.375 11.625 0 7.5 0ZM6 11.25L2.25 7.5L3.3075 6.4425L6 9.1275L11.6925 3.435L12.75 4.5L6 11.25Z"
                                                        fill="#D8E8B7" />
                                                </svg>
                                                <span>Availability</span>
                                            </div>


                                            <div class="slots-price d-flex flex-column">
                                                <div class="slots d-flex flex-column" aria-label="Available slots">
                                                    <div class="slot highlight">Mon 1, 08:30 AM</div>
                                                    <div class="slot">Wed 27, 09:15 AM</div>
                                                </div>
                                                <div class="price">From <span>£38</span> <span class="time-frame">/
                                                        hour</span></div>
                                            </div>



                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- BOTTOM CONTROLS -->
                        <div class="scroll-controls mt-4">
                            <!-- LEFT ARROW -->
                            <button class="scroll-btn left" aria-label="Scroll left">
                                <svg xmlns="http://www.w3.org/2000/svg" width="44" height="44" viewBox="0 0 44 44" fill="none">
                                    <g filter="url(#filter0_d_10_1531)">
                                        <circle cx="18" cy="18" r="18" transform="matrix(-1 0 0 1 40 0)" fill="white" />
                                    </g>
                                    <path d="M24.1943 25.1943L16.44 17.44L24.0642 9.81591" stroke="#3B3731" stroke-opacity="0.5"
                                        stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    <defs>
                                        <filter id="filter0_d_10_1531" x="0" y="0" width="44" height="44"
                                            filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                                            <feFlood flood-opacity="0" result="BackgroundImageFix" />
                                            <feColorMatrix in="SourceAlpha" type="matrix"
                                                values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha" />
                                            <feOffset dy="4" />
                                            <feGaussianBlur stdDeviation="2" />
                                            <feComposite in2="hardAlpha" operator="out" />
                                            <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.03 0" />
                                            <feBlend mode="normal" in2="BackgroundImageFix"
                                                result="effect1_dropShadow_10_1531" />
                                            <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_10_1531"
                                                result="shape" />
                                        </filter>
                                    </defs>
                                </svg>
                            </button>

                            <div class="scroll-track">
                                <div class="scroll-progress"></div>
                            </div>

                            <!-- RIGHT ARROW -->
                            <button class="scroll-btn right" aria-label="Scroll right">
                                <svg xmlns="http://www.w3.org/2000/svg" width="44" height="44" viewBox="0 0 44 44" fill="none">
                                    <g filter="url(#filter0_d_10_1530)">
                                        <circle cx="22" cy="18" r="18" fill="white" />
                                    </g>
                                    <path d="M19.8057 25.1943L27.56 17.44L19.9358 9.81591" stroke="#3B3731" stroke-opacity="0.5"
                                        stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    <defs>
                                        <filter id="filter0_d_10_1530" x="0" y="0" width="44" height="44"
                                            filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                                            <feFlood flood-opacity="0" result="BackgroundImageFix" />
                                            <feColorMatrix in="SourceAlpha" type="matrix"
                                                values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha" />
                                            <feOffset dy="4" />
                                            <feGaussianBlur stdDeviation="2" />
                                            <feComposite in2="hardAlpha" operator="out" />
                                            <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.03 0" />
                                            <feBlend mode="normal" in2="BackgroundImageFix"
                                                result="effect1_dropShadow_10_1530" />
                                            <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_10_1530"
                                                result="shape" />
                                        </filter>
                                    </defs>
                                </svg>
                            </button>
                        </div>
                    </div>


                    <div class="modal-footer d-flex align-items-center justify-content-center mt-4 gap-10">
                        <button class="modal-footer-btn apply">Continue</button>
                    </div>
                </div>

                <div data-tab-content="groomer-map-view" class="tabcontent" style="display: none;" data-display="block"
                    style="padding: 0 35px;">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="space-scroll-wrapper mt-5">

                                <div class="space-scroll">
                                    <div class="row flex-nowrap g-3">
                                        <div class="col-lg-6">
                                            <div class="card space-cards flex-column active">
                                                <div class="left">
                                                    <div class="top-left-svg">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="21" height="22"
                                                            viewBox="0 0 21 22" fill="none">
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
                                                                d="M6.83331 13.4703C6.83331 13.4703 8.2222 13.7392 9.61109 12.667L6.83331 13.4703Z"
                                                                fill="#CBDCE8" />
                                                            <path d="M6.83331 13.4703C6.83331 13.4703 8.2222 13.7392 9.61109 12.667"
                                                                stroke="white" stroke-linecap="round" stroke-linejoin="round" />
                                                            <path
                                                                d="M9.05558 8.36144C9.05558 8.54561 8.98241 8.72225 8.85218 8.85248C8.72194 8.98272 8.54531 9.05588 8.36113 9.05588C8.17695 9.05588 8.00032 8.98272 7.87009 8.85248C7.73985 8.72225 7.66669 8.54561 7.66669 8.36144C7.66669 8.17726 7.73985 8.00062 7.87009 7.87039C8.00032 7.74016 8.17695 7.66699 8.36113 7.66699C8.54531 7.66699 8.72194 7.74016 8.85218 7.87039C8.98241 8.00062 9.05558 8.17726 9.05558 8.36144Z"
                                                                fill="#CBDCE8" stroke="white" />
                                                            <path d="M10.4445 6.55554V6.6111V6.55554Z" fill="#CBDCE8" />
                                                            <path d="M10.4445 6.55554V6.6111" stroke="white" stroke-linecap="round"
                                                                stroke-linejoin="round" />
                                                        </svg>
                                                    </div>
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 255 130" fill="none">
                                                        <defs>
                                                            <pattern id="pattern-card-6" patternUnits="userSpaceOnUse" width="255"
                                                                height="130">
                                                                <image href="<?= BASE_URL ?>/assets/images/space_card1.png" width="255"
                                                                    height="130" preserveAspectRatio="xMidYMid slice" />
                                                            </pattern>
                                                        </defs>

                                                        <path
                                                            d="M255 124.417C255 127.178 252.761 129.417 250 129.417H5C2.23858 129.417 0 127.178 0 124.417V37C0 34.2386 2.23858 32 5 32H27C29.7614 32 32 29.7614 32 27V5C32 2.23858 34.2386 0 37 0H250C252.761 0 255 2.23858 255 5V124.417Z"
                                                            fill="url(#pattern-card-6)" />
                                                    </svg>

                                                </div>
                                                <div class="right">
                                                    <div class="top-row">
                                                        <div class="tags" aria-hidden="true">
                                                            <div class="tag">Salons</div>
                                                        </div>
                                                        <div class="icons" aria-hidden="true">
                                                            <button class="first-icon" title="Top-rated">
                                                                <!-- crown -->
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="10" height="9"
                                                                    viewBox="0 0 10 9" fill="none">
                                                                    <path
                                                                        d="M2 8.99999C1.85833 8.99999 1.73967 8.95199 1.644 8.85599C1.54833 8.75999 1.50033 8.64133 1.5 8.49999C1.49967 8.35866 1.54767 8.23999 1.644 8.14399C1.74033 8.04799 1.859 7.99999 2 7.99999H8C8.14166 7.99999 8.2605 8.04799 8.3565 8.14399C8.4525 8.23999 8.50033 8.35866 8.5 8.49999C8.49966 8.64133 8.45166 8.76016 8.356 8.85649C8.26033 8.95283 8.14166 9.00066 8 8.99999H2ZM2.35 7.24999C2.10833 7.24999 1.89383 7.17083 1.7065 7.0125C1.51917 6.85416 1.4045 6.65416 1.3625 6.4125L0.862501 3.2375C0.845834 3.2375 0.827167 3.23967 0.806501 3.244C0.785834 3.24833 0.767001 3.25033 0.750001 3.25C0.541667 3.25 0.364668 3.17717 0.219001 3.0315C0.0733344 2.88583 0.000334469 2.70867 1.13636e-06 2.5C-0.000332197 2.29133 0.0726677 2.11433 0.219001 1.969C0.365334 1.82367 0.542334 1.75067 0.750001 1.75C0.957667 1.74933 1.13483 1.82233 1.2815 1.969C1.42817 2.11567 1.501 2.29267 1.5 2.5C1.5 2.55833 1.49367 2.6125 1.481 2.6625C1.46833 2.7125 1.45383 2.75833 1.4375 2.8L3 3.5L4.5625 1.3625C4.47083 1.29583 4.39583 1.20833 4.3375 1.1C4.27917 0.991667 4.25 0.875 4.25 0.75C4.25 0.541667 4.323 0.364501 4.469 0.218501C4.615 0.0725011 4.792 -0.000332194 5 1.13895e-06C5.208 0.000334472 5.38516 0.0733344 5.5315 0.219001C5.67783 0.364667 5.75066 0.541667 5.75 0.75C5.75 0.875 5.72083 0.991667 5.6625 1.1C5.60416 1.20833 5.52916 1.29583 5.4375 1.3625L7 3.5L8.5625 2.8C8.54583 2.75833 8.53116 2.7125 8.5185 2.6625C8.50583 2.6125 8.49966 2.55833 8.5 2.5C8.5 2.29167 8.573 2.1145 8.719 1.9685C8.865 1.8225 9.042 1.74967 9.25 1.75C9.458 1.75033 9.63516 1.82333 9.7815 1.969C9.92783 2.11467 10.0007 2.29167 10 2.5C9.99933 2.70833 9.92649 2.8855 9.7815 3.0315C9.6365 3.1775 9.45933 3.25033 9.25 3.25C9.23333 3.25 9.21466 3.248 9.194 3.244C9.17333 3.24 9.1545 3.23783 9.1375 3.2375L8.6375 6.4125C8.59583 6.65416 8.48133 6.85416 8.294 7.0125C8.10666 7.17083 7.892 7.24999 7.65 7.24999H2.35ZM2.35 6.25H7.65L7.975 4.1625L7.4 4.4125C7.18333 4.50416 6.9625 4.52083 6.7375 4.4625C6.5125 4.40416 6.32916 4.27916 6.1875 4.0875L5 2.45L3.8125 4.0875C3.67083 4.27916 3.4875 4.40416 3.2625 4.4625C3.0375 4.52083 2.81667 4.50416 2.6 4.4125L2.025 4.1625L2.35 6.25Z"
                                                                        fill="white" />
                                                                </svg>
                                                            </button>
                                                            <button class="second-icon" title="Favourite">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="9" height="11"
                                                                    viewBox="0 0 9 11" fill="none">
                                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                                        d="M3.79701 0.30821C3.81025 0.23997 3.84191 0.176658 3.88858 0.125138C3.93524 0.0736173 3.99512 0.0358558 4.06172 0.0159479C4.12832 -0.00396001 4.1991 -0.00525449 4.26638 0.0122049C4.33367 0.0296642 4.39489 0.0652111 4.4434 0.114991C4.56671 0.240837 4.80378 0.489988 5.04467 0.777274C5.28111 1.05884 5.53916 1.39761 5.68788 1.69951C5.8328 1.99443 5.98661 2.37578 6.10801 2.69421L6.67305 1.75354C6.70456 1.701 6.74826 1.65683 6.80046 1.62476C6.85265 1.59269 6.91181 1.57367 6.97292 1.56931C7.03402 1.56494 7.09528 1.57536 7.1515 1.59969C7.20773 1.62401 7.25727 1.66152 7.29592 1.70905C8.09867 2.70057 8.49846 3.76263 8.6974 4.57365C8.79718 4.97979 8.8474 5.32491 8.87282 5.57025C8.88576 5.69278 8.89424 5.81574 8.89824 5.93889V5.97131C8.89824 8.4482 6.93364 10.4649 4.44785 10.4649C1.96206 10.4649 0 8.44756 0 5.97004C0 5.28805 0.322244 3.68192 1.27563 2.36498C1.31266 2.31422 1.36166 2.27341 1.41826 2.24615C1.47487 2.2189 1.53734 2.20605 1.60011 2.20876C1.66287 2.21146 1.724 2.22963 1.77806 2.26166C1.83211 2.29368 1.87741 2.33856 1.90994 2.39231L2.55507 3.46709C2.75083 3.16073 3.01269 2.73044 3.21163 2.3332C3.49765 1.76117 3.72455 0.682572 3.79701 0.308845M4.3201 0.912655C4.20506 1.42113 4.01501 2.14697 3.77985 2.61858C3.46714 3.24336 3.0165 3.9298 2.86142 4.16051C2.82554 4.21345 2.77693 4.25651 2.72005 4.28574C2.66317 4.31497 2.59986 4.32943 2.53593 4.32778C2.472 4.32614 2.40952 4.30844 2.35422 4.27632C2.29892 4.24421 2.25258 4.1987 2.21948 4.14399L1.57118 3.06476C0.87457 4.19166 0.635589 5.45839 0.635589 5.97131C0.635589 8.10561 2.32244 9.82806 4.44785 9.82806C6.57326 9.82806 8.26265 8.10561 8.26265 5.97131V5.95351L8.26011 5.88995C8.25568 5.80484 8.24911 5.71986 8.24041 5.63508C8.20712 5.3287 8.15362 5.02487 8.08024 4.72555C7.87826 3.89157 7.52027 3.10334 7.02516 2.40248L6.38068 3.47535C6.34338 3.53732 6.28925 3.58743 6.22459 3.61985C6.15993 3.65227 6.08739 3.66566 6.01542 3.65847C5.94344 3.65128 5.87499 3.6238 5.81802 3.57923C5.76105 3.53466 5.71791 3.47483 5.6936 3.40671C5.59064 3.11815 5.33831 2.42917 5.11713 1.98044C5.00463 1.751 4.78916 1.46117 4.55781 1.18596C4.4801 1.09353 4.40086 1.00242 4.3201 0.912655Z"
                                                                        fill="#FEFEFE" />
                                                                </svg>
                                                            </button>
                                                            <button class="third-icon" title="lock">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="8" height="10"
                                                                    viewBox="0 0 8 10" fill="none">
                                                                    <path
                                                                        d="M4 7.61905C3.73478 7.61905 3.48043 7.51871 3.29289 7.3401C3.10536 7.1615 3 6.91925 3 6.66667C3 6.1381 3.445 5.71429 4 5.71429C4.26522 5.71429 4.51957 5.81463 4.70711 5.99323C4.89464 6.17184 5 6.41408 5 6.66667C5 6.91925 4.89464 7.1615 4.70711 7.3401C4.51957 7.51871 4.26522 7.61905 4 7.61905ZM7 9.04762V4.28571H1V9.04762H7ZM7 3.33333C7.26522 3.33333 7.51957 3.43367 7.70711 3.61228C7.89464 3.79089 8 4.03313 8 4.28571V9.04762C8 9.30021 7.89464 9.54245 7.70711 9.72105C7.51957 9.89966 7.26522 10 7 10H1C0.734784 10 0.48043 9.89966 0.292893 9.72105C0.105357 9.54245 0 9.30021 0 9.04762V4.28571C0 3.75714 0.445 3.33333 1 3.33333H1.5V2.38095C1.5 1.74948 1.76339 1.14388 2.23223 0.697365C2.70107 0.25085 3.33696 0 4 0C4.3283 0 4.65339 0.0615852 4.95671 0.181239C5.26002 0.300893 5.53562 0.476273 5.76777 0.697365C5.99991 0.918457 6.18406 1.18093 6.3097 1.4698C6.43534 1.75867 6.5 2.06828 6.5 2.38095V3.33333H7ZM4 0.952381C3.60218 0.952381 3.22064 1.10289 2.93934 1.3708C2.65804 1.63871 2.5 2.00207 2.5 2.38095V3.33333H5.5V2.38095C5.5 2.00207 5.34196 1.63871 5.06066 1.3708C4.77936 1.10289 4.39782 0.952381 4 0.952381Z"
                                                                        fill="white" />
                                                                </svg>
                                                            </button>
                                                        </div>
                                                    </div>

                                                    <h2 class="name">Furs & Co. Studio</h2>
                                                    <p class="hosted-by">Hosted by <span>Dev É.</span></p>

                                                    <div class="studio-details mt-1 d-flex flex-column justify-content-between mt-2">

                                                        <div class="meta d-flex align-items-center justify-content-between">
                                                            <div class="distance" title="Distance">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="10" height="14"
                                                                    viewBox="0 0 10 14" fill="none">
                                                                    <path
                                                                        d="M5 6.65C4.5264 6.65 4.0722 6.46563 3.73731 6.13744C3.40242 5.80925 3.21429 5.36413 3.21429 4.9C3.21429 4.43587 3.40242 3.99075 3.73731 3.66256C4.0722 3.33437 4.5264 3.15 5 3.15C5.4736 3.15 5.9278 3.33437 6.26269 3.66256C6.59758 3.99075 6.78571 4.43587 6.78571 4.9C6.78571 5.12981 6.73953 5.35738 6.64979 5.5697C6.56004 5.78202 6.42851 5.97493 6.26269 6.13744C6.09687 6.29994 5.90002 6.42884 5.68336 6.51679C5.46671 6.60473 5.2345 6.65 5 6.65ZM5 0C3.67392 0 2.40215 0.516248 1.46447 1.43518C0.526784 2.3541 0 3.60044 0 4.9C0 8.575 5 14 5 14C5 14 10 8.575 10 4.9C10 3.60044 9.47322 2.3541 8.53553 1.43518C7.59785 0.516248 6.32608 0 5 0Z"
                                                                        fill="var(--active-bg)" />
                                                                </svg>
                                                                <span>2.5 mi</span>
                                                            </div>


                                                            <div class="rating" title="Rating">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                                    viewBox="0 0 14 14" fill="none">
                                                                    <path
                                                                        d="M6.12956 0.660476C6.40354 -0.220161 7.59647 -0.220158 7.87045 0.660479L8.89548 3.95519C9.01801 4.34902 9.36942 4.61566 9.76593 4.61566H13.083C13.9696 4.61566 14.3383 5.80055 13.621 6.34481L10.9374 8.38106C10.6166 8.62446 10.4824 9.0559 10.6049 9.44973L11.63 12.7444C11.9039 13.6251 10.9388 14.3574 10.2215 13.8131L7.53797 11.7769C7.21719 11.5335 6.78282 11.5335 6.46204 11.7769L3.77846 13.8131C3.06117 14.3574 2.09607 13.6251 2.37005 12.7444L3.39508 9.44973C3.51761 9.0559 3.38338 8.62446 3.0626 8.38106L0.37903 6.34481C-0.338258 5.80055 0.0303816 4.61566 0.916998 4.61566H4.23408C4.63058 4.61566 4.98199 4.34902 5.10452 3.95519L6.12956 0.660476Z"
                                                                        fill="var(--active-bg)" />
                                                                </svg>
                                                                <span>4.3 <small style="color:var(--muted)">(20)</small></span>
                                                            </div>
                                                        </div>
                                                    </div>



                                                    <p class="experience">Professional grooming spaces in <br> London.
                                                        Spotless, well-equipped, easy <br> to access.</p>


                                                    <p class="amenities d-flex">
                                                        <b>Amenities:</b>&nbsp;Bath &#8226; Table &#8226; Dryer ...
                                                    </p>


                                                    <div class="availability mt-3">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15"
                                                            viewBox="0 0 15 15" fill="none">
                                                            <path
                                                                d="M7.5 0C3.375 0 0 3.375 0 7.5C0 11.625 3.375 15 7.5 15C11.625 15 15 11.625 15 7.5C15 3.375 11.625 0 7.5 0ZM6 11.25L2.25 7.5L3.3075 6.4425L6 9.1275L11.6925 3.435L12.75 4.5L6 11.25Z"
                                                                fill="#D8E8B7" />
                                                        </svg>
                                                        <span>Availability</span>
                                                    </div>


                                                    <div class="slots-price d-flex flex-column">
                                                        <div class="slots d-flex flex-column" aria-label="Available slots">
                                                            <div class="slot highlight">Mon 1, 08:30 AM</div>
                                                            <div class="slot">Wed 27, 09:15 AM</div>
                                                        </div>
                                                        <div class="price">From <span>£38</span> <span class="time-frame">/
                                                                hour</span></div>
                                                    </div>



                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="card space-cards flex-column active">
                                                <div class="left">
                                                    <div class="top-left-svg">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="21" height="22"
                                                            viewBox="0 0 21 22" fill="none">
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
                                                                d="M6.83331 13.4703C6.83331 13.4703 8.2222 13.7392 9.61109 12.667L6.83331 13.4703Z"
                                                                fill="#CBDCE8" />
                                                            <path d="M6.83331 13.4703C6.83331 13.4703 8.2222 13.7392 9.61109 12.667"
                                                                stroke="white" stroke-linecap="round" stroke-linejoin="round" />
                                                            <path
                                                                d="M9.05558 8.36144C9.05558 8.54561 8.98241 8.72225 8.85218 8.85248C8.72194 8.98272 8.54531 9.05588 8.36113 9.05588C8.17695 9.05588 8.00032 8.98272 7.87009 8.85248C7.73985 8.72225 7.66669 8.54561 7.66669 8.36144C7.66669 8.17726 7.73985 8.00062 7.87009 7.87039C8.00032 7.74016 8.17695 7.66699 8.36113 7.66699C8.54531 7.66699 8.72194 7.74016 8.85218 7.87039C8.98241 8.00062 9.05558 8.17726 9.05558 8.36144Z"
                                                                fill="#CBDCE8" stroke="white" />
                                                            <path d="M10.4445 6.55554V6.6111V6.55554Z" fill="#CBDCE8" />
                                                            <path d="M10.4445 6.55554V6.6111" stroke="white" stroke-linecap="round"
                                                                stroke-linejoin="round" />
                                                        </svg>
                                                    </div>
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 255 130" fill="none">
                                                        <defs>
                                                            <pattern id="pattern-card-7" patternUnits="userSpaceOnUse" width="255"
                                                                height="130">
                                                                <image href="<?= BASE_URL ?>/assets/images/space_card2.png" width="255"
                                                                    height="130" preserveAspectRatio="xMidYMid slice" />
                                                            </pattern>
                                                        </defs>

                                                        <path
                                                            d="M255 124.417C255 127.178 252.761 129.417 250 129.417H5C2.23858 129.417 0 127.178 0 124.417V37C0 34.2386 2.23858 32 5 32H27C29.7614 32 32 29.7614 32 27V5C32 2.23858 34.2386 0 37 0H250C252.761 0 255 2.23858 255 5V124.417Z"
                                                            fill="url(#pattern-card-7)" />
                                                    </svg>

                                                </div>
                                                <div class="right">
                                                    <div class="top-row">
                                                        <div class="tags" aria-hidden="true">
                                                            <div class="tag">Salons</div>
                                                        </div>
                                                        <div class="icons" aria-hidden="true">
                                                            <button class="first-icon" title="Top-rated">
                                                                <!-- crown -->
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="10" height="9"
                                                                    viewBox="0 0 10 9" fill="none">
                                                                    <path
                                                                        d="M2 8.99999C1.85833 8.99999 1.73967 8.95199 1.644 8.85599C1.54833 8.75999 1.50033 8.64133 1.5 8.49999C1.49967 8.35866 1.54767 8.23999 1.644 8.14399C1.74033 8.04799 1.859 7.99999 2 7.99999H8C8.14166 7.99999 8.2605 8.04799 8.3565 8.14399C8.4525 8.23999 8.50033 8.35866 8.5 8.49999C8.49966 8.64133 8.45166 8.76016 8.356 8.85649C8.26033 8.95283 8.14166 9.00066 8 8.99999H2ZM2.35 7.24999C2.10833 7.24999 1.89383 7.17083 1.7065 7.0125C1.51917 6.85416 1.4045 6.65416 1.3625 6.4125L0.862501 3.2375C0.845834 3.2375 0.827167 3.23967 0.806501 3.244C0.785834 3.24833 0.767001 3.25033 0.750001 3.25C0.541667 3.25 0.364668 3.17717 0.219001 3.0315C0.0733344 2.88583 0.000334469 2.70867 1.13636e-06 2.5C-0.000332197 2.29133 0.0726677 2.11433 0.219001 1.969C0.365334 1.82367 0.542334 1.75067 0.750001 1.75C0.957667 1.74933 1.13483 1.82233 1.2815 1.969C1.42817 2.11567 1.501 2.29267 1.5 2.5C1.5 2.55833 1.49367 2.6125 1.481 2.6625C1.46833 2.7125 1.45383 2.75833 1.4375 2.8L3 3.5L4.5625 1.3625C4.47083 1.29583 4.39583 1.20833 4.3375 1.1C4.27917 0.991667 4.25 0.875 4.25 0.75C4.25 0.541667 4.323 0.364501 4.469 0.218501C4.615 0.0725011 4.792 -0.000332194 5 1.13895e-06C5.208 0.000334472 5.38516 0.0733344 5.5315 0.219001C5.67783 0.364667 5.75066 0.541667 5.75 0.75C5.75 0.875 5.72083 0.991667 5.6625 1.1C5.60416 1.20833 5.52916 1.29583 5.4375 1.3625L7 3.5L8.5625 2.8C8.54583 2.75833 8.53116 2.7125 8.5185 2.6625C8.50583 2.6125 8.49966 2.55833 8.5 2.5C8.5 2.29167 8.573 2.1145 8.719 1.9685C8.865 1.8225 9.042 1.74967 9.25 1.75C9.458 1.75033 9.63516 1.82333 9.7815 1.969C9.92783 2.11467 10.0007 2.29167 10 2.5C9.99933 2.70833 9.92649 2.8855 9.7815 3.0315C9.6365 3.1775 9.45933 3.25033 9.25 3.25C9.23333 3.25 9.21466 3.248 9.194 3.244C9.17333 3.24 9.1545 3.23783 9.1375 3.2375L8.6375 6.4125C8.59583 6.65416 8.48133 6.85416 8.294 7.0125C8.10666 7.17083 7.892 7.24999 7.65 7.24999H2.35ZM2.35 6.25H7.65L7.975 4.1625L7.4 4.4125C7.18333 4.50416 6.9625 4.52083 6.7375 4.4625C6.5125 4.40416 6.32916 4.27916 6.1875 4.0875L5 2.45L3.8125 4.0875C3.67083 4.27916 3.4875 4.40416 3.2625 4.4625C3.0375 4.52083 2.81667 4.50416 2.6 4.4125L2.025 4.1625L2.35 6.25Z"
                                                                        fill="white" />
                                                                </svg>
                                                            </button>
                                                            <button class="second-icon" title="Favourite">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="9" height="11"
                                                                    viewBox="0 0 9 11" fill="none">
                                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                                        d="M3.79701 0.30821C3.81025 0.23997 3.84191 0.176658 3.88858 0.125138C3.93524 0.0736173 3.99512 0.0358558 4.06172 0.0159479C4.12832 -0.00396001 4.1991 -0.00525449 4.26638 0.0122049C4.33367 0.0296642 4.39489 0.0652111 4.4434 0.114991C4.56671 0.240837 4.80378 0.489988 5.04467 0.777274C5.28111 1.05884 5.53916 1.39761 5.68788 1.69951C5.8328 1.99443 5.98661 2.37578 6.10801 2.69421L6.67305 1.75354C6.70456 1.701 6.74826 1.65683 6.80046 1.62476C6.85265 1.59269 6.91181 1.57367 6.97292 1.56931C7.03402 1.56494 7.09528 1.57536 7.1515 1.59969C7.20773 1.62401 7.25727 1.66152 7.29592 1.70905C8.09867 2.70057 8.49846 3.76263 8.6974 4.57365C8.79718 4.97979 8.8474 5.32491 8.87282 5.57025C8.88576 5.69278 8.89424 5.81574 8.89824 5.93889V5.97131C8.89824 8.4482 6.93364 10.4649 4.44785 10.4649C1.96206 10.4649 0 8.44756 0 5.97004C0 5.28805 0.322244 3.68192 1.27563 2.36498C1.31266 2.31422 1.36166 2.27341 1.41826 2.24615C1.47487 2.2189 1.53734 2.20605 1.60011 2.20876C1.66287 2.21146 1.724 2.22963 1.77806 2.26166C1.83211 2.29368 1.87741 2.33856 1.90994 2.39231L2.55507 3.46709C2.75083 3.16073 3.01269 2.73044 3.21163 2.3332C3.49765 1.76117 3.72455 0.682572 3.79701 0.308845M4.3201 0.912655C4.20506 1.42113 4.01501 2.14697 3.77985 2.61858C3.46714 3.24336 3.0165 3.9298 2.86142 4.16051C2.82554 4.21345 2.77693 4.25651 2.72005 4.28574C2.66317 4.31497 2.59986 4.32943 2.53593 4.32778C2.472 4.32614 2.40952 4.30844 2.35422 4.27632C2.29892 4.24421 2.25258 4.1987 2.21948 4.14399L1.57118 3.06476C0.87457 4.19166 0.635589 5.45839 0.635589 5.97131C0.635589 8.10561 2.32244 9.82806 4.44785 9.82806C6.57326 9.82806 8.26265 8.10561 8.26265 5.97131V5.95351L8.26011 5.88995C8.25568 5.80484 8.24911 5.71986 8.24041 5.63508C8.20712 5.3287 8.15362 5.02487 8.08024 4.72555C7.87826 3.89157 7.52027 3.10334 7.02516 2.40248L6.38068 3.47535C6.34338 3.53732 6.28925 3.58743 6.22459 3.61985C6.15993 3.65227 6.08739 3.66566 6.01542 3.65847C5.94344 3.65128 5.87499 3.6238 5.81802 3.57923C5.76105 3.53466 5.71791 3.47483 5.6936 3.40671C5.59064 3.11815 5.33831 2.42917 5.11713 1.98044C5.00463 1.751 4.78916 1.46117 4.55781 1.18596C4.4801 1.09353 4.40086 1.00242 4.3201 0.912655Z"
                                                                        fill="#FEFEFE" />
                                                                </svg>
                                                            </button>
                                                            <button class="third-icon" title="lock">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="8" height="10"
                                                                    viewBox="0 0 8 10" fill="none">
                                                                    <path
                                                                        d="M4 7.61905C3.73478 7.61905 3.48043 7.51871 3.29289 7.3401C3.10536 7.1615 3 6.91925 3 6.66667C3 6.1381 3.445 5.71429 4 5.71429C4.26522 5.71429 4.51957 5.81463 4.70711 5.99323C4.89464 6.17184 5 6.41408 5 6.66667C5 6.91925 4.89464 7.1615 4.70711 7.3401C4.51957 7.51871 4.26522 7.61905 4 7.61905ZM7 9.04762V4.28571H1V9.04762H7ZM7 3.33333C7.26522 3.33333 7.51957 3.43367 7.70711 3.61228C7.89464 3.79089 8 4.03313 8 4.28571V9.04762C8 9.30021 7.89464 9.54245 7.70711 9.72105C7.51957 9.89966 7.26522 10 7 10H1C0.734784 10 0.48043 9.89966 0.292893 9.72105C0.105357 9.54245 0 9.30021 0 9.04762V4.28571C0 3.75714 0.445 3.33333 1 3.33333H1.5V2.38095C1.5 1.74948 1.76339 1.14388 2.23223 0.697365C2.70107 0.25085 3.33696 0 4 0C4.3283 0 4.65339 0.0615852 4.95671 0.181239C5.26002 0.300893 5.53562 0.476273 5.76777 0.697365C5.99991 0.918457 6.18406 1.18093 6.3097 1.4698C6.43534 1.75867 6.5 2.06828 6.5 2.38095V3.33333H7ZM4 0.952381C3.60218 0.952381 3.22064 1.10289 2.93934 1.3708C2.65804 1.63871 2.5 2.00207 2.5 2.38095V3.33333H5.5V2.38095C5.5 2.00207 5.34196 1.63871 5.06066 1.3708C4.77936 1.10289 4.39782 0.952381 4 0.952381Z"
                                                                        fill="white" />
                                                                </svg>
                                                            </button>
                                                        </div>
                                                    </div>

                                                    <h2 class="name">Paws & Bubbles</h2>
                                                    <p class="hosted-by">Hosted by <span>Dev É.</span></p>

                                                    <div class="studio-details mt-1 d-flex flex-column justify-content-between mt-2">

                                                        <div class="meta d-flex align-items-center justify-content-between">
                                                            <div class="distance" title="Distance">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="10" height="14"
                                                                    viewBox="0 0 10 14" fill="none">
                                                                    <path
                                                                        d="M5 6.65C4.5264 6.65 4.0722 6.46563 3.73731 6.13744C3.40242 5.80925 3.21429 5.36413 3.21429 4.9C3.21429 4.43587 3.40242 3.99075 3.73731 3.66256C4.0722 3.33437 4.5264 3.15 5 3.15C5.4736 3.15 5.9278 3.33437 6.26269 3.66256C6.59758 3.99075 6.78571 4.43587 6.78571 4.9C6.78571 5.12981 6.73953 5.35738 6.64979 5.5697C6.56004 5.78202 6.42851 5.97493 6.26269 6.13744C6.09687 6.29994 5.90002 6.42884 5.68336 6.51679C5.46671 6.60473 5.2345 6.65 5 6.65ZM5 0C3.67392 0 2.40215 0.516248 1.46447 1.43518C0.526784 2.3541 0 3.60044 0 4.9C0 8.575 5 14 5 14C5 14 10 8.575 10 4.9C10 3.60044 9.47322 2.3541 8.53553 1.43518C7.59785 0.516248 6.32608 0 5 0Z"
                                                                        fill="var(--active-bg)" />
                                                                </svg>
                                                                <span>2.5 mi</span>
                                                            </div>


                                                            <div class="rating" title="Rating">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                                    viewBox="0 0 14 14" fill="none">
                                                                    <path
                                                                        d="M6.12956 0.660476C6.40354 -0.220161 7.59647 -0.220158 7.87045 0.660479L8.89548 3.95519C9.01801 4.34902 9.36942 4.61566 9.76593 4.61566H13.083C13.9696 4.61566 14.3383 5.80055 13.621 6.34481L10.9374 8.38106C10.6166 8.62446 10.4824 9.0559 10.6049 9.44973L11.63 12.7444C11.9039 13.6251 10.9388 14.3574 10.2215 13.8131L7.53797 11.7769C7.21719 11.5335 6.78282 11.5335 6.46204 11.7769L3.77846 13.8131C3.06117 14.3574 2.09607 13.6251 2.37005 12.7444L3.39508 9.44973C3.51761 9.0559 3.38338 8.62446 3.0626 8.38106L0.37903 6.34481C-0.338258 5.80055 0.0303816 4.61566 0.916998 4.61566H4.23408C4.63058 4.61566 4.98199 4.34902 5.10452 3.95519L6.12956 0.660476Z"
                                                                        fill="var(--active-bg)" />
                                                                </svg>
                                                                <span>4.3 <small style="color:var(--muted)">(20)</small></span>
                                                            </div>
                                                        </div>
                                                    </div>



                                                    <p class="experience">Fully equipped mobile grooming van. <br> Clean,
                                                        convenient, and perfect for on-<br>the-go appointments!</p>


                                                    <p class="amenities d-flex">
                                                        <b>Amenities:</b>&nbsp;Bath &#8226; Table &#8226; Dryer ...
                                                    </p>


                                                    <div class="availability mt-3">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15"
                                                            viewBox="0 0 15 15" fill="none">
                                                            <path
                                                                d="M7.5 0C3.375 0 0 3.375 0 7.5C0 11.625 3.375 15 7.5 15C11.625 15 15 11.625 15 7.5C15 3.375 11.625 0 7.5 0ZM6 11.25L2.25 7.5L3.3075 6.4425L6 9.1275L11.6925 3.435L12.75 4.5L6 11.25Z"
                                                                fill="#D8E8B7" />
                                                        </svg>
                                                        <span>Availability</span>
                                                    </div>


                                                    <div class="slots-price d-flex flex-column">
                                                        <div class="slots d-flex flex-column" aria-label="Available slots">
                                                            <div class="slot highlight">Mon 1, 08:30 AM</div>
                                                            <div class="slot">Wed 27, 09:15 AM</div>
                                                        </div>
                                                        <div class="price">From <span>£38</span> <span class="time-frame">/
                                                                hour</span></div>
                                                    </div>



                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="card space-cards flex-column active">
                                                <div class="left">
                                                    <div class="top-left-svg">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="21" height="22"
                                                            viewBox="0 0 21 22" fill="none">
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
                                                                d="M6.83331 13.4703C6.83331 13.4703 8.2222 13.7392 9.61109 12.667L6.83331 13.4703Z"
                                                                fill="#CBDCE8" />
                                                            <path d="M6.83331 13.4703C6.83331 13.4703 8.2222 13.7392 9.61109 12.667"
                                                                stroke="white" stroke-linecap="round" stroke-linejoin="round" />
                                                            <path
                                                                d="M9.05558 8.36144C9.05558 8.54561 8.98241 8.72225 8.85218 8.85248C8.72194 8.98272 8.54531 9.05588 8.36113 9.05588C8.17695 9.05588 8.00032 8.98272 7.87009 8.85248C7.73985 8.72225 7.66669 8.54561 7.66669 8.36144C7.66669 8.17726 7.73985 8.00062 7.87009 7.87039C8.00032 7.74016 8.17695 7.66699 8.36113 7.66699C8.54531 7.66699 8.72194 7.74016 8.85218 7.87039C8.98241 8.00062 9.05558 8.17726 9.05558 8.36144Z"
                                                                fill="#CBDCE8" stroke="white" />
                                                            <path d="M10.4445 6.55554V6.6111V6.55554Z" fill="#CBDCE8" />
                                                            <path d="M10.4445 6.55554V6.6111" stroke="white" stroke-linecap="round"
                                                                stroke-linejoin="round" />
                                                        </svg>
                                                    </div>
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 255 130" fill="none">
                                                        <defs>
                                                            <pattern id="pattern-card-8" patternUnits="userSpaceOnUse" width="255"
                                                                height="130">
                                                                <image href="<?= BASE_URL ?>/assets/images/space_card3.png" width="255"
                                                                    height="130" preserveAspectRatio="xMidYMid slice" />
                                                            </pattern>
                                                        </defs>

                                                        <path
                                                            d="M255 124.417C255 127.178 252.761 129.417 250 129.417H5C2.23858 129.417 0 127.178 0 124.417V37C0 34.2386 2.23858 32 5 32H27C29.7614 32 32 29.7614 32 27V5C32 2.23858 34.2386 0 37 0H250C252.761 0 255 2.23858 255 5V124.417Z"
                                                            fill="url(#pattern-card-8)" />
                                                    </svg>

                                                </div>
                                                <div class="right">
                                                    <div class="top-row">
                                                        <div class="tags" aria-hidden="true">
                                                            <div class="tag">Salons</div>
                                                        </div>
                                                        <div class="icons" aria-hidden="true">
                                                            <button class="first-icon" title="Top-rated">
                                                                <!-- crown -->
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="10" height="9"
                                                                    viewBox="0 0 10 9" fill="none">
                                                                    <path
                                                                        d="M2 8.99999C1.85833 8.99999 1.73967 8.95199 1.644 8.85599C1.54833 8.75999 1.50033 8.64133 1.5 8.49999C1.49967 8.35866 1.54767 8.23999 1.644 8.14399C1.74033 8.04799 1.859 7.99999 2 7.99999H8C8.14166 7.99999 8.2605 8.04799 8.3565 8.14399C8.4525 8.23999 8.50033 8.35866 8.5 8.49999C8.49966 8.64133 8.45166 8.76016 8.356 8.85649C8.26033 8.95283 8.14166 9.00066 8 8.99999H2ZM2.35 7.24999C2.10833 7.24999 1.89383 7.17083 1.7065 7.0125C1.51917 6.85416 1.4045 6.65416 1.3625 6.4125L0.862501 3.2375C0.845834 3.2375 0.827167 3.23967 0.806501 3.244C0.785834 3.24833 0.767001 3.25033 0.750001 3.25C0.541667 3.25 0.364668 3.17717 0.219001 3.0315C0.0733344 2.88583 0.000334469 2.70867 1.13636e-06 2.5C-0.000332197 2.29133 0.0726677 2.11433 0.219001 1.969C0.365334 1.82367 0.542334 1.75067 0.750001 1.75C0.957667 1.74933 1.13483 1.82233 1.2815 1.969C1.42817 2.11567 1.501 2.29267 1.5 2.5C1.5 2.55833 1.49367 2.6125 1.481 2.6625C1.46833 2.7125 1.45383 2.75833 1.4375 2.8L3 3.5L4.5625 1.3625C4.47083 1.29583 4.39583 1.20833 4.3375 1.1C4.27917 0.991667 4.25 0.875 4.25 0.75C4.25 0.541667 4.323 0.364501 4.469 0.218501C4.615 0.0725011 4.792 -0.000332194 5 1.13895e-06C5.208 0.000334472 5.38516 0.0733344 5.5315 0.219001C5.67783 0.364667 5.75066 0.541667 5.75 0.75C5.75 0.875 5.72083 0.991667 5.6625 1.1C5.60416 1.20833 5.52916 1.29583 5.4375 1.3625L7 3.5L8.5625 2.8C8.54583 2.75833 8.53116 2.7125 8.5185 2.6625C8.50583 2.6125 8.49966 2.55833 8.5 2.5C8.5 2.29167 8.573 2.1145 8.719 1.9685C8.865 1.8225 9.042 1.74967 9.25 1.75C9.458 1.75033 9.63516 1.82333 9.7815 1.969C9.92783 2.11467 10.0007 2.29167 10 2.5C9.99933 2.70833 9.92649 2.8855 9.7815 3.0315C9.6365 3.1775 9.45933 3.25033 9.25 3.25C9.23333 3.25 9.21466 3.248 9.194 3.244C9.17333 3.24 9.1545 3.23783 9.1375 3.2375L8.6375 6.4125C8.59583 6.65416 8.48133 6.85416 8.294 7.0125C8.10666 7.17083 7.892 7.24999 7.65 7.24999H2.35ZM2.35 6.25H7.65L7.975 4.1625L7.4 4.4125C7.18333 4.50416 6.9625 4.52083 6.7375 4.4625C6.5125 4.40416 6.32916 4.27916 6.1875 4.0875L5 2.45L3.8125 4.0875C3.67083 4.27916 3.4875 4.40416 3.2625 4.4625C3.0375 4.52083 2.81667 4.50416 2.6 4.4125L2.025 4.1625L2.35 6.25Z"
                                                                        fill="white" />
                                                                </svg>
                                                            </button>
                                                            <button class="second-icon" title="Favourite">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="9" height="11"
                                                                    viewBox="0 0 9 11" fill="none">
                                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                                        d="M3.79701 0.30821C3.81025 0.23997 3.84191 0.176658 3.88858 0.125138C3.93524 0.0736173 3.99512 0.0358558 4.06172 0.0159479C4.12832 -0.00396001 4.1991 -0.00525449 4.26638 0.0122049C4.33367 0.0296642 4.39489 0.0652111 4.4434 0.114991C4.56671 0.240837 4.80378 0.489988 5.04467 0.777274C5.28111 1.05884 5.53916 1.39761 5.68788 1.69951C5.8328 1.99443 5.98661 2.37578 6.10801 2.69421L6.67305 1.75354C6.70456 1.701 6.74826 1.65683 6.80046 1.62476C6.85265 1.59269 6.91181 1.57367 6.97292 1.56931C7.03402 1.56494 7.09528 1.57536 7.1515 1.59969C7.20773 1.62401 7.25727 1.66152 7.29592 1.70905C8.09867 2.70057 8.49846 3.76263 8.6974 4.57365C8.79718 4.97979 8.8474 5.32491 8.87282 5.57025C8.88576 5.69278 8.89424 5.81574 8.89824 5.93889V5.97131C8.89824 8.4482 6.93364 10.4649 4.44785 10.4649C1.96206 10.4649 0 8.44756 0 5.97004C0 5.28805 0.322244 3.68192 1.27563 2.36498C1.31266 2.31422 1.36166 2.27341 1.41826 2.24615C1.47487 2.2189 1.53734 2.20605 1.60011 2.20876C1.66287 2.21146 1.724 2.22963 1.77806 2.26166C1.83211 2.29368 1.87741 2.33856 1.90994 2.39231L2.55507 3.46709C2.75083 3.16073 3.01269 2.73044 3.21163 2.3332C3.49765 1.76117 3.72455 0.682572 3.79701 0.308845M4.3201 0.912655C4.20506 1.42113 4.01501 2.14697 3.77985 2.61858C3.46714 3.24336 3.0165 3.9298 2.86142 4.16051C2.82554 4.21345 2.77693 4.25651 2.72005 4.28574C2.66317 4.31497 2.59986 4.32943 2.53593 4.32778C2.472 4.32614 2.40952 4.30844 2.35422 4.27632C2.29892 4.24421 2.25258 4.1987 2.21948 4.14399L1.57118 3.06476C0.87457 4.19166 0.635589 5.45839 0.635589 5.97131C0.635589 8.10561 2.32244 9.82806 4.44785 9.82806C6.57326 9.82806 8.26265 8.10561 8.26265 5.97131V5.95351L8.26011 5.88995C8.25568 5.80484 8.24911 5.71986 8.24041 5.63508C8.20712 5.3287 8.15362 5.02487 8.08024 4.72555C7.87826 3.89157 7.52027 3.10334 7.02516 2.40248L6.38068 3.47535C6.34338 3.53732 6.28925 3.58743 6.22459 3.61985C6.15993 3.65227 6.08739 3.66566 6.01542 3.65847C5.94344 3.65128 5.87499 3.6238 5.81802 3.57923C5.76105 3.53466 5.71791 3.47483 5.6936 3.40671C5.59064 3.11815 5.33831 2.42917 5.11713 1.98044C5.00463 1.751 4.78916 1.46117 4.55781 1.18596C4.4801 1.09353 4.40086 1.00242 4.3201 0.912655Z"
                                                                        fill="#FEFEFE" />
                                                                </svg>
                                                            </button>
                                                            <button class="third-icon" title="lock">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="8" height="10"
                                                                    viewBox="0 0 8 10" fill="none">
                                                                    <path
                                                                        d="M4 7.61905C3.73478 7.61905 3.48043 7.51871 3.29289 7.3401C3.10536 7.1615 3 6.91925 3 6.66667C3 6.1381 3.445 5.71429 4 5.71429C4.26522 5.71429 4.51957 5.81463 4.70711 5.99323C4.89464 6.17184 5 6.41408 5 6.66667C5 6.91925 4.89464 7.1615 4.70711 7.3401C4.51957 7.51871 4.26522 7.61905 4 7.61905ZM7 9.04762V4.28571H1V9.04762H7ZM7 3.33333C7.26522 3.33333 7.51957 3.43367 7.70711 3.61228C7.89464 3.79089 8 4.03313 8 4.28571V9.04762C8 9.30021 7.89464 9.54245 7.70711 9.72105C7.51957 9.89966 7.26522 10 7 10H1C0.734784 10 0.48043 9.89966 0.292893 9.72105C0.105357 9.54245 0 9.30021 0 9.04762V4.28571C0 3.75714 0.445 3.33333 1 3.33333H1.5V2.38095C1.5 1.74948 1.76339 1.14388 2.23223 0.697365C2.70107 0.25085 3.33696 0 4 0C4.3283 0 4.65339 0.0615852 4.95671 0.181239C5.26002 0.300893 5.53562 0.476273 5.76777 0.697365C5.99991 0.918457 6.18406 1.18093 6.3097 1.4698C6.43534 1.75867 6.5 2.06828 6.5 2.38095V3.33333H7ZM4 0.952381C3.60218 0.952381 3.22064 1.10289 2.93934 1.3708C2.65804 1.63871 2.5 2.00207 2.5 2.38095V3.33333H5.5V2.38095C5.5 2.00207 5.34196 1.63871 5.06066 1.3708C4.77936 1.10289 4.39782 0.952381 4 0.952381Z"
                                                                        fill="white" />
                                                                </svg>
                                                            </button>
                                                        </div>
                                                    </div>

                                                    <h2 class="name">The Garden Grooming Spot</h2>
                                                    <p class="hosted-by">Hosted by <span>Dev É.</span></p>

                                                    <div class="studio-details mt-1 d-flex flex-column justify-content-between mt-2">

                                                        <div class="meta d-flex align-items-center justify-content-between">
                                                            <div class="distance" title="Distance">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="10" height="14"
                                                                    viewBox="0 0 10 14" fill="none">
                                                                    <path
                                                                        d="M5 6.65C4.5264 6.65 4.0722 6.46563 3.73731 6.13744C3.40242 5.80925 3.21429 5.36413 3.21429 4.9C3.21429 4.43587 3.40242 3.99075 3.73731 3.66256C4.0722 3.33437 4.5264 3.15 5 3.15C5.4736 3.15 5.9278 3.33437 6.26269 3.66256C6.59758 3.99075 6.78571 4.43587 6.78571 4.9C6.78571 5.12981 6.73953 5.35738 6.64979 5.5697C6.56004 5.78202 6.42851 5.97493 6.26269 6.13744C6.09687 6.29994 5.90002 6.42884 5.68336 6.51679C5.46671 6.60473 5.2345 6.65 5 6.65ZM5 0C3.67392 0 2.40215 0.516248 1.46447 1.43518C0.526784 2.3541 0 3.60044 0 4.9C0 8.575 5 14 5 14C5 14 10 8.575 10 4.9C10 3.60044 9.47322 2.3541 8.53553 1.43518C7.59785 0.516248 6.32608 0 5 0Z"
                                                                        fill="var(--active-bg)" />
                                                                </svg>
                                                                <span>2.5 mi</span>
                                                            </div>


                                                            <div class="rating" title="Rating">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                                    viewBox="0 0 14 14" fill="none">
                                                                    <path
                                                                        d="M6.12956 0.660476C6.40354 -0.220161 7.59647 -0.220158 7.87045 0.660479L8.89548 3.95519C9.01801 4.34902 9.36942 4.61566 9.76593 4.61566H13.083C13.9696 4.61566 14.3383 5.80055 13.621 6.34481L10.9374 8.38106C10.6166 8.62446 10.4824 9.0559 10.6049 9.44973L11.63 12.7444C11.9039 13.6251 10.9388 14.3574 10.2215 13.8131L7.53797 11.7769C7.21719 11.5335 6.78282 11.5335 6.46204 11.7769L3.77846 13.8131C3.06117 14.3574 2.09607 13.6251 2.37005 12.7444L3.39508 9.44973C3.51761 9.0559 3.38338 8.62446 3.0626 8.38106L0.37903 6.34481C-0.338258 5.80055 0.0303816 4.61566 0.916998 4.61566H4.23408C4.63058 4.61566 4.98199 4.34902 5.10452 3.95519L6.12956 0.660476Z"
                                                                        fill="var(--active-bg)" />
                                                                </svg>
                                                                <span>4.3 <small style="color:var(--muted)">(20)</small></span>
                                                            </div>
                                                        </div>
                                                    </div>



                                                    <p class="experience">Outdoor garden grooming area. Calm, <br> spacious,
                                                        and ideal for stress-free <br> sessions in fresh air.</p>


                                                    <p class="amenities d-flex">
                                                        <b>Amenities:</b>&nbsp;Bath &#8226; Table &#8226; Dryer ...
                                                    </p>


                                                    <div class="availability mt-3">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15"
                                                            viewBox="0 0 15 15" fill="none">
                                                            <path
                                                                d="M7.5 0C3.375 0 0 3.375 0 7.5C0 11.625 3.375 15 7.5 15C11.625 15 15 11.625 15 7.5C15 3.375 11.625 0 7.5 0ZM6 11.25L2.25 7.5L3.3075 6.4425L6 9.1275L11.6925 3.435L12.75 4.5L6 11.25Z"
                                                                fill="#D8E8B7" />
                                                        </svg>
                                                        <span>Availability</span>
                                                    </div>


                                                    <div class="slots-price d-flex flex-column">
                                                        <div class="slots d-flex flex-column" aria-label="Available slots">
                                                            <div class="slot highlight">Mon 1, 08:30 AM</div>
                                                            <div class="slot">Wed 27, 09:15 AM</div>
                                                        </div>
                                                        <div class="price">From <span>£38</span> <span class="time-frame">/
                                                                hour</span></div>
                                                    </div>



                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="card space-cards flex-column active">
                                                <div class="left">
                                                    <div class="top-left-svg">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="21" height="22"
                                                            viewBox="0 0 21 22" fill="none">
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
                                                                d="M6.83331 13.4703C6.83331 13.4703 8.2222 13.7392 9.61109 12.667L6.83331 13.4703Z"
                                                                fill="#CBDCE8" />
                                                            <path d="M6.83331 13.4703C6.83331 13.4703 8.2222 13.7392 9.61109 12.667"
                                                                stroke="white" stroke-linecap="round" stroke-linejoin="round" />
                                                            <path
                                                                d="M9.05558 8.36144C9.05558 8.54561 8.98241 8.72225 8.85218 8.85248C8.72194 8.98272 8.54531 9.05588 8.36113 9.05588C8.17695 9.05588 8.00032 8.98272 7.87009 8.85248C7.73985 8.72225 7.66669 8.54561 7.66669 8.36144C7.66669 8.17726 7.73985 8.00062 7.87009 7.87039C8.00032 7.74016 8.17695 7.66699 8.36113 7.66699C8.54531 7.66699 8.72194 7.74016 8.85218 7.87039C8.98241 8.00062 9.05558 8.17726 9.05558 8.36144Z"
                                                                fill="#CBDCE8" stroke="white" />
                                                            <path d="M10.4445 6.55554V6.6111V6.55554Z" fill="#CBDCE8" />
                                                            <path d="M10.4445 6.55554V6.6111" stroke="white" stroke-linecap="round"
                                                                stroke-linejoin="round" />
                                                        </svg>
                                                    </div>
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 255 130" fill="none">
                                                        <defs>
                                                            <pattern id="pattern-card-9" patternUnits="userSpaceOnUse" width="255"
                                                                height="130">
                                                                <image href="<?= BASE_URL ?>/assets/images/space_card1.png" width="255"
                                                                    height="130" preserveAspectRatio="xMidYMid slice" />
                                                            </pattern>
                                                        </defs>

                                                        <path
                                                            d="M255 124.417C255 127.178 252.761 129.417 250 129.417H5C2.23858 129.417 0 127.178 0 124.417V37C0 34.2386 2.23858 32 5 32H27C29.7614 32 32 29.7614 32 27V5C32 2.23858 34.2386 0 37 0H250C252.761 0 255 2.23858 255 5V124.417Z"
                                                            fill="url(#pattern-card-9)" />
                                                    </svg>

                                                </div>
                                                <div class="right">
                                                    <div class="top-row">
                                                        <div class="tags" aria-hidden="true">
                                                            <div class="tag">Salons</div>
                                                        </div>
                                                        <div class="icons" aria-hidden="true">
                                                            <button class="first-icon" title="Top-rated">
                                                                <!-- crown -->
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="10" height="9"
                                                                    viewBox="0 0 10 9" fill="none">
                                                                    <path
                                                                        d="M2 8.99999C1.85833 8.99999 1.73967 8.95199 1.644 8.85599C1.54833 8.75999 1.50033 8.64133 1.5 8.49999C1.49967 8.35866 1.54767 8.23999 1.644 8.14399C1.74033 8.04799 1.859 7.99999 2 7.99999H8C8.14166 7.99999 8.2605 8.04799 8.3565 8.14399C8.4525 8.23999 8.50033 8.35866 8.5 8.49999C8.49966 8.64133 8.45166 8.76016 8.356 8.85649C8.26033 8.95283 8.14166 9.00066 8 8.99999H2ZM2.35 7.24999C2.10833 7.24999 1.89383 7.17083 1.7065 7.0125C1.51917 6.85416 1.4045 6.65416 1.3625 6.4125L0.862501 3.2375C0.845834 3.2375 0.827167 3.23967 0.806501 3.244C0.785834 3.24833 0.767001 3.25033 0.750001 3.25C0.541667 3.25 0.364668 3.17717 0.219001 3.0315C0.0733344 2.88583 0.000334469 2.70867 1.13636e-06 2.5C-0.000332197 2.29133 0.0726677 2.11433 0.219001 1.969C0.365334 1.82367 0.542334 1.75067 0.750001 1.75C0.957667 1.74933 1.13483 1.82233 1.2815 1.969C1.42817 2.11567 1.501 2.29267 1.5 2.5C1.5 2.55833 1.49367 2.6125 1.481 2.6625C1.46833 2.7125 1.45383 2.75833 1.4375 2.8L3 3.5L4.5625 1.3625C4.47083 1.29583 4.39583 1.20833 4.3375 1.1C4.27917 0.991667 4.25 0.875 4.25 0.75C4.25 0.541667 4.323 0.364501 4.469 0.218501C4.615 0.0725011 4.792 -0.000332194 5 1.13895e-06C5.208 0.000334472 5.38516 0.0733344 5.5315 0.219001C5.67783 0.364667 5.75066 0.541667 5.75 0.75C5.75 0.875 5.72083 0.991667 5.6625 1.1C5.60416 1.20833 5.52916 1.29583 5.4375 1.3625L7 3.5L8.5625 2.8C8.54583 2.75833 8.53116 2.7125 8.5185 2.6625C8.50583 2.6125 8.49966 2.55833 8.5 2.5C8.5 2.29167 8.573 2.1145 8.719 1.9685C8.865 1.8225 9.042 1.74967 9.25 1.75C9.458 1.75033 9.63516 1.82333 9.7815 1.969C9.92783 2.11467 10.0007 2.29167 10 2.5C9.99933 2.70833 9.92649 2.8855 9.7815 3.0315C9.6365 3.1775 9.45933 3.25033 9.25 3.25C9.23333 3.25 9.21466 3.248 9.194 3.244C9.17333 3.24 9.1545 3.23783 9.1375 3.2375L8.6375 6.4125C8.59583 6.65416 8.48133 6.85416 8.294 7.0125C8.10666 7.17083 7.892 7.24999 7.65 7.24999H2.35ZM2.35 6.25H7.65L7.975 4.1625L7.4 4.4125C7.18333 4.50416 6.9625 4.52083 6.7375 4.4625C6.5125 4.40416 6.32916 4.27916 6.1875 4.0875L5 2.45L3.8125 4.0875C3.67083 4.27916 3.4875 4.40416 3.2625 4.4625C3.0375 4.52083 2.81667 4.50416 2.6 4.4125L2.025 4.1625L2.35 6.25Z"
                                                                        fill="white" />
                                                                </svg>
                                                            </button>
                                                            <button class="second-icon" title="Favourite">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="9" height="11"
                                                                    viewBox="0 0 9 11" fill="none">
                                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                                        d="M3.79701 0.30821C3.81025 0.23997 3.84191 0.176658 3.88858 0.125138C3.93524 0.0736173 3.99512 0.0358558 4.06172 0.0159479C4.12832 -0.00396001 4.1991 -0.00525449 4.26638 0.0122049C4.33367 0.0296642 4.39489 0.0652111 4.4434 0.114991C4.56671 0.240837 4.80378 0.489988 5.04467 0.777274C5.28111 1.05884 5.53916 1.39761 5.68788 1.69951C5.8328 1.99443 5.98661 2.37578 6.10801 2.69421L6.67305 1.75354C6.70456 1.701 6.74826 1.65683 6.80046 1.62476C6.85265 1.59269 6.91181 1.57367 6.97292 1.56931C7.03402 1.56494 7.09528 1.57536 7.1515 1.59969C7.20773 1.62401 7.25727 1.66152 7.29592 1.70905C8.09867 2.70057 8.49846 3.76263 8.6974 4.57365C8.79718 4.97979 8.8474 5.32491 8.87282 5.57025C8.88576 5.69278 8.89424 5.81574 8.89824 5.93889V5.97131C8.89824 8.4482 6.93364 10.4649 4.44785 10.4649C1.96206 10.4649 0 8.44756 0 5.97004C0 5.28805 0.322244 3.68192 1.27563 2.36498C1.31266 2.31422 1.36166 2.27341 1.41826 2.24615C1.47487 2.2189 1.53734 2.20605 1.60011 2.20876C1.66287 2.21146 1.724 2.22963 1.77806 2.26166C1.83211 2.29368 1.87741 2.33856 1.90994 2.39231L2.55507 3.46709C2.75083 3.16073 3.01269 2.73044 3.21163 2.3332C3.49765 1.76117 3.72455 0.682572 3.79701 0.308845M4.3201 0.912655C4.20506 1.42113 4.01501 2.14697 3.77985 2.61858C3.46714 3.24336 3.0165 3.9298 2.86142 4.16051C2.82554 4.21345 2.77693 4.25651 2.72005 4.28574C2.66317 4.31497 2.59986 4.32943 2.53593 4.32778C2.472 4.32614 2.40952 4.30844 2.35422 4.27632C2.29892 4.24421 2.25258 4.1987 2.21948 4.14399L1.57118 3.06476C0.87457 4.19166 0.635589 5.45839 0.635589 5.97131C0.635589 8.10561 2.32244 9.82806 4.44785 9.82806C6.57326 9.82806 8.26265 8.10561 8.26265 5.97131V5.95351L8.26011 5.88995C8.25568 5.80484 8.24911 5.71986 8.24041 5.63508C8.20712 5.3287 8.15362 5.02487 8.08024 4.72555C7.87826 3.89157 7.52027 3.10334 7.02516 2.40248L6.38068 3.47535C6.34338 3.53732 6.28925 3.58743 6.22459 3.61985C6.15993 3.65227 6.08739 3.66566 6.01542 3.65847C5.94344 3.65128 5.87499 3.6238 5.81802 3.57923C5.76105 3.53466 5.71791 3.47483 5.6936 3.40671C5.59064 3.11815 5.33831 2.42917 5.11713 1.98044C5.00463 1.751 4.78916 1.46117 4.55781 1.18596C4.4801 1.09353 4.40086 1.00242 4.3201 0.912655Z"
                                                                        fill="#FEFEFE" />
                                                                </svg>
                                                            </button>
                                                            <button class="third-icon" title="lock">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="8" height="10"
                                                                    viewBox="0 0 8 10" fill="none">
                                                                    <path
                                                                        d="M4 7.61905C3.73478 7.61905 3.48043 7.51871 3.29289 7.3401C3.10536 7.1615 3 6.91925 3 6.66667C3 6.1381 3.445 5.71429 4 5.71429C4.26522 5.71429 4.51957 5.81463 4.70711 5.99323C4.89464 6.17184 5 6.41408 5 6.66667C5 6.91925 4.89464 7.1615 4.70711 7.3401C4.51957 7.51871 4.26522 7.61905 4 7.61905ZM7 9.04762V4.28571H1V9.04762H7ZM7 3.33333C7.26522 3.33333 7.51957 3.43367 7.70711 3.61228C7.89464 3.79089 8 4.03313 8 4.28571V9.04762C8 9.30021 7.89464 9.54245 7.70711 9.72105C7.51957 9.89966 7.26522 10 7 10H1C0.734784 10 0.48043 9.89966 0.292893 9.72105C0.105357 9.54245 0 9.30021 0 9.04762V4.28571C0 3.75714 0.445 3.33333 1 3.33333H1.5V2.38095C1.5 1.74948 1.76339 1.14388 2.23223 0.697365C2.70107 0.25085 3.33696 0 4 0C4.3283 0 4.65339 0.0615852 4.95671 0.181239C5.26002 0.300893 5.53562 0.476273 5.76777 0.697365C5.99991 0.918457 6.18406 1.18093 6.3097 1.4698C6.43534 1.75867 6.5 2.06828 6.5 2.38095V3.33333H7ZM4 0.952381C3.60218 0.952381 3.22064 1.10289 2.93934 1.3708C2.65804 1.63871 2.5 2.00207 2.5 2.38095V3.33333H5.5V2.38095C5.5 2.00207 5.34196 1.63871 5.06066 1.3708C4.77936 1.10289 4.39782 0.952381 4 0.952381Z"
                                                                        fill="white" />
                                                                </svg>
                                                            </button>
                                                        </div>
                                                    </div>

                                                    <h2 class="name">Furs & Co. Studio</h2>
                                                    <p class="hosted-by">Hosted by <span>Dev É.</span></p>

                                                    <div class="studio-details mt-1 d-flex flex-column justify-content-between mt-2">

                                                        <div class="meta d-flex align-items-center justify-content-between">
                                                            <div class="distance" title="Distance">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="10" height="14"
                                                                    viewBox="0 0 10 14" fill="none">
                                                                    <path
                                                                        d="M5 6.65C4.5264 6.65 4.0722 6.46563 3.73731 6.13744C3.40242 5.80925 3.21429 5.36413 3.21429 4.9C3.21429 4.43587 3.40242 3.99075 3.73731 3.66256C4.0722 3.33437 4.5264 3.15 5 3.15C5.4736 3.15 5.9278 3.33437 6.26269 3.66256C6.59758 3.99075 6.78571 4.43587 6.78571 4.9C6.78571 5.12981 6.73953 5.35738 6.64979 5.5697C6.56004 5.78202 6.42851 5.97493 6.26269 6.13744C6.09687 6.29994 5.90002 6.42884 5.68336 6.51679C5.46671 6.60473 5.2345 6.65 5 6.65ZM5 0C3.67392 0 2.40215 0.516248 1.46447 1.43518C0.526784 2.3541 0 3.60044 0 4.9C0 8.575 5 14 5 14C5 14 10 8.575 10 4.9C10 3.60044 9.47322 2.3541 8.53553 1.43518C7.59785 0.516248 6.32608 0 5 0Z"
                                                                        fill="var(--active-bg)" />
                                                                </svg>
                                                                <span>2.5 mi</span>
                                                            </div>


                                                            <div class="rating" title="Rating">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                                    viewBox="0 0 14 14" fill="none">
                                                                    <path
                                                                        d="M6.12956 0.660476C6.40354 -0.220161 7.59647 -0.220158 7.87045 0.660479L8.89548 3.95519C9.01801 4.34902 9.36942 4.61566 9.76593 4.61566H13.083C13.9696 4.61566 14.3383 5.80055 13.621 6.34481L10.9374 8.38106C10.6166 8.62446 10.4824 9.0559 10.6049 9.44973L11.63 12.7444C11.9039 13.6251 10.9388 14.3574 10.2215 13.8131L7.53797 11.7769C7.21719 11.5335 6.78282 11.5335 6.46204 11.7769L3.77846 13.8131C3.06117 14.3574 2.09607 13.6251 2.37005 12.7444L3.39508 9.44973C3.51761 9.0559 3.38338 8.62446 3.0626 8.38106L0.37903 6.34481C-0.338258 5.80055 0.0303816 4.61566 0.916998 4.61566H4.23408C4.63058 4.61566 4.98199 4.34902 5.10452 3.95519L6.12956 0.660476Z"
                                                                        fill="var(--active-bg)" />
                                                                </svg>
                                                                <span>4.3 <small style="color:var(--muted)">(20)</small></span>
                                                            </div>
                                                        </div>
                                                    </div>



                                                    <p class="experience">Professional grooming spaces in <br> London.
                                                        Spotless, well-equipped, easy <br> to access.</p>


                                                    <p class="amenities d-flex">
                                                        <b>Amenities:</b>&nbsp;Bath &#8226; Table &#8226; Dryer ...
                                                    </p>


                                                    <div class="availability mt-3">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15"
                                                            viewBox="0 0 15 15" fill="none">
                                                            <path
                                                                d="M7.5 0C3.375 0 0 3.375 0 7.5C0 11.625 3.375 15 7.5 15C11.625 15 15 11.625 15 7.5C15 3.375 11.625 0 7.5 0ZM6 11.25L2.25 7.5L3.3075 6.4425L6 9.1275L11.6925 3.435L12.75 4.5L6 11.25Z"
                                                                fill="#D8E8B7" />
                                                        </svg>
                                                        <span>Availability</span>
                                                    </div>


                                                    <div class="slots-price d-flex flex-column">
                                                        <div class="slots d-flex flex-column" aria-label="Available slots">
                                                            <div class="slot highlight">Mon 1, 08:30 AM</div>
                                                            <div class="slot">Wed 27, 09:15 AM</div>
                                                        </div>
                                                        <div class="price">From <span>£38</span> <span class="time-frame">/
                                                                hour</span></div>
                                                    </div>



                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- BOTTOM CONTROLS -->
                                <div class="scroll-controls mt-4">
                                    <!-- LEFT ARROW -->
                                    <button class="scroll-btn left" aria-label="Scroll left">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="44" height="44" viewBox="0 0 44 44" fill="none">
                                            <g filter="url(#filter0_d_10_1531)">
                                                <circle cx="18" cy="18" r="18" transform="matrix(-1 0 0 1 40 0)" fill="white" />
                                            </g>
                                            <path d="M24.1943 25.1943L16.44 17.44L24.0642 9.81591" stroke="#3B3731" stroke-opacity="0.5"
                                                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                            <defs>
                                                <filter id="filter0_d_10_1531" x="0" y="0" width="44" height="44"
                                                    filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                                                    <feFlood flood-opacity="0" result="BackgroundImageFix" />
                                                    <feColorMatrix in="SourceAlpha" type="matrix"
                                                        values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha" />
                                                    <feOffset dy="4" />
                                                    <feGaussianBlur stdDeviation="2" />
                                                    <feComposite in2="hardAlpha" operator="out" />
                                                    <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.03 0" />
                                                    <feBlend mode="normal" in2="BackgroundImageFix"
                                                        result="effect1_dropShadow_10_1531" />
                                                    <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_10_1531"
                                                        result="shape" />
                                                </filter>
                                            </defs>
                                        </svg>
                                    </button>

                                    <div class="scroll-track">
                                        <div class="scroll-progress"></div>
                                    </div>

                                    <!-- RIGHT ARROW -->
                                    <button class="scroll-btn right" aria-label="Scroll right">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="44" height="44" viewBox="0 0 44 44" fill="none">
                                            <g filter="url(#filter0_d_10_1530)">
                                                <circle cx="22" cy="18" r="18" fill="white" />
                                            </g>
                                            <path d="M19.8057 25.1943L27.56 17.44L19.9358 9.81591" stroke="#3B3731" stroke-opacity="0.5"
                                                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                            <defs>
                                                <filter id="filter0_d_10_1530" x="0" y="0" width="44" height="44"
                                                    filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                                                    <feFlood flood-opacity="0" result="BackgroundImageFix" />
                                                    <feColorMatrix in="SourceAlpha" type="matrix"
                                                        values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha" />
                                                    <feOffset dy="4" />
                                                    <feGaussianBlur stdDeviation="2" />
                                                    <feComposite in2="hardAlpha" operator="out" />
                                                    <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.03 0" />
                                                    <feBlend mode="normal" in2="BackgroundImageFix"
                                                        result="effect1_dropShadow_10_1530" />
                                                    <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_10_1530"
                                                        result="shape" />
                                                </filter>
                                            </defs>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="map-div mt-5">
                                <img src="<?= BASE_URL ?>assets/images/profile_tab_map.png" class="map-image" alt="">
                            </div>
                        </div>

                        <div class="modal-footer d-flex align-items-center justify-content-center mt-4 gap-10">
                            <button class="modal-footer-btn apply">Continue</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- Modal 1 -->

        <div class="row">
            <div class="col-lg-12">
                <div class="profile-header" role="banner">
                    <div class="left">
                        <div class="avatar-wrap">
                            <img class="avatar" src="<?= BASE_URL ?>/assets/images/groomer-profile.png" alt="Sarah's avatar">
                            <div class="badge-shield" title="Verified">
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="33" viewBox="0 0 30 33" fill="none">
                                    <ellipse cx="15.873" cy="16.5256" rx="9.3645" ry="8.81365" fill="white" />
                                    <path d="M15.44 0.185076C15.1841 0.0638192 14.9099 0 14.6235 0C14.3372 0 14.063 0.0638192 13.8071 0.185076L2.3337 5.28423C0.993208 5.87775 -0.00606541 7.26263 2.77146e-05 8.93469C0.0304934 15.2656 2.51649 26.8487 13.015 32.1138C14.0325 32.6244 15.2146 32.6244 16.2321 32.1138C26.7306 26.8487 29.2166 15.2656 29.247 8.93469C29.2531 7.26263 28.2539 5.87775 26.9134 5.28423L15.44 0.185076ZM8.82897 18.2651C9.12144 18.3416 9.43219 18.3799 9.74903 18.3799C11.8999 18.3799 13.6486 16.5483 13.6486 14.2955V10.2111H16.3418C17.0791 10.2111 17.7554 10.645 18.0844 11.3407L18.5231 12.2533H22.4227C22.9589 12.2533 23.3976 12.7128 23.3976 13.2744V15.3166C23.3976 18.1374 21.2163 20.4222 18.5231 20.4222H15.5984V23.6578C15.5984 24.1237 15.2389 24.5066 14.7881 24.5066C14.6784 24.5066 14.5687 24.4811 14.4712 24.4364L8.45729 21.7368C8.05514 21.5581 7.79923 21.1433 7.79923 20.6902C7.79923 20.5115 7.83579 20.3392 7.915 20.1796L8.82897 18.2651ZM8.77413 10.2111H11.6988V14.2955C11.6988 15.4251 10.8275 16.3377 9.74903 16.3377C8.67055 16.3377 7.79923 15.4251 7.79923 14.2955V11.2322C7.79923 10.6706 8.23794 10.2111 8.77413 10.2111ZM16.5733 13.2744C16.5733 13.0036 16.4706 12.7439 16.2878 12.5524C16.105 12.3609 15.857 12.2533 15.5984 12.2533C15.3399 12.2533 15.0919 12.3609 14.9091 12.5524C14.7262 12.7439 14.6235 13.0036 14.6235 13.2744C14.6235 13.5452 14.7262 13.8049 14.9091 13.9964C15.0919 14.1879 15.3399 14.2955 15.5984 14.2955C15.857 14.2955 16.105 14.1879 16.2878 13.9964C16.4706 13.8049 16.5733 13.5452 16.5733 13.2744Z" fill="#C9DDA0" />
                                </svg>
                            </div>
                        </div>

                        <div class="meta">
                            <h1>Sarah's Grooming Studio</h1>
                            <div class="owner">Sarah W.</div>

                            <div style="display:flex; align-items:center; gap:12px;">
                                <div class="tags-row mt-2">
                                    <span class="pill popular">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="10" height="9" viewBox="0 0 10 9" fill="none">
                                            <path d="M2 8.99999C1.85833 8.99999 1.73967 8.95199 1.644 8.85599C1.54833 8.75999 1.50033 8.64133 1.5 8.49999C1.49967 8.35866 1.54767 8.23999 1.644 8.14399C1.74033 8.04799 1.859 7.99999 2 7.99999H8C8.14166 7.99999 8.2605 8.04799 8.3565 8.14399C8.4525 8.23999 8.50033 8.35866 8.5 8.49999C8.49966 8.64133 8.45166 8.76016 8.356 8.85649C8.26033 8.95283 8.14166 9.00066 8 8.99999H2ZM2.35 7.24999C2.10833 7.24999 1.89383 7.17083 1.7065 7.0125C1.51917 6.85416 1.4045 6.65416 1.3625 6.4125L0.862501 3.2375C0.845834 3.2375 0.827167 3.23967 0.806501 3.244C0.785834 3.24833 0.767001 3.25033 0.750001 3.25C0.541667 3.25 0.364668 3.17717 0.219001 3.0315C0.0733344 2.88583 0.000334469 2.70867 1.13636e-06 2.5C-0.000332197 2.29133 0.0726677 2.11433 0.219001 1.969C0.365334 1.82367 0.542334 1.75067 0.750001 1.75C0.957667 1.74933 1.13483 1.82233 1.2815 1.969C1.42817 2.11567 1.501 2.29267 1.5 2.5C1.5 2.55833 1.49367 2.6125 1.481 2.6625C1.46833 2.7125 1.45383 2.75833 1.4375 2.8L3 3.5L4.5625 1.3625C4.47083 1.29583 4.39583 1.20833 4.3375 1.1C4.27917 0.991667 4.25 0.875 4.25 0.75C4.25 0.541667 4.323 0.364501 4.469 0.218501C4.615 0.0725011 4.792 -0.000332194 5 1.13895e-06C5.208 0.000334472 5.38516 0.0733344 5.5315 0.219001C5.67783 0.364667 5.75066 0.541667 5.75 0.75C5.75 0.875 5.72083 0.991667 5.6625 1.1C5.60416 1.20833 5.52916 1.29583 5.4375 1.3625L7 3.5L8.5625 2.8C8.54583 2.75833 8.53116 2.7125 8.5185 2.6625C8.50583 2.6125 8.49966 2.55833 8.5 2.5C8.5 2.29167 8.573 2.1145 8.719 1.9685C8.865 1.8225 9.042 1.74967 9.25 1.75C9.458 1.75033 9.63516 1.82333 9.7815 1.969C9.92783 2.11467 10.0007 2.29167 10 2.5C9.99933 2.70833 9.92649 2.8855 9.7815 3.0315C9.6365 3.1775 9.45933 3.25033 9.25 3.25C9.23333 3.25 9.21466 3.248 9.194 3.244C9.17333 3.24 9.1545 3.23783 9.1375 3.2375L8.6375 6.4125C8.59583 6.65416 8.48133 6.85416 8.294 7.0125C8.10666 7.17083 7.892 7.24999 7.65 7.24999H2.35ZM2.35 6.25H7.65L7.975 4.1625L7.4 4.4125C7.18333 4.50416 6.9625 4.52083 6.7375 4.4625C6.5125 4.40416 6.32916 4.27916 6.1875 4.0875L5 2.45L3.8125 4.0875C3.67083 4.27916 3.4875 4.40416 3.2625 4.4625C3.0375 4.52083 2.81667 4.50416 2.6 4.4125L2.025 4.1625L2.35 6.25Z" fill="white" />
                                        </svg>
                                        Popular
                                    </span>
                                    <span class="pill toprated">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="9" height="11" viewBox="0 0 9 11" fill="none">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M3.79701 0.30821C3.81025 0.23997 3.84191 0.176658 3.88858 0.125138C3.93524 0.0736173 3.99512 0.0358558 4.06172 0.0159479C4.12832 -0.00396001 4.1991 -0.00525449 4.26638 0.0122049C4.33367 0.0296642 4.39489 0.0652111 4.4434 0.114991C4.56671 0.240837 4.80378 0.489988 5.04467 0.777274C5.28111 1.05884 5.53916 1.39761 5.68788 1.69951C5.8328 1.99443 5.98661 2.37578 6.10801 2.69421L6.67305 1.75354C6.70456 1.701 6.74826 1.65683 6.80046 1.62476C6.85265 1.59269 6.91181 1.57367 6.97292 1.56931C7.03402 1.56494 7.09528 1.57536 7.1515 1.59969C7.20773 1.62401 7.25727 1.66152 7.29592 1.70905C8.09867 2.70057 8.49846 3.76263 8.6974 4.57365C8.79718 4.97979 8.8474 5.32491 8.87282 5.57025C8.88576 5.69278 8.89424 5.81574 8.89824 5.93889V5.97131C8.89824 8.4482 6.93364 10.4649 4.44785 10.4649C1.96206 10.4649 0 8.44756 0 5.97004C0 5.28805 0.322244 3.68192 1.27563 2.36498C1.31266 2.31422 1.36166 2.27341 1.41826 2.24615C1.47487 2.2189 1.53734 2.20605 1.60011 2.20876C1.66287 2.21146 1.724 2.22963 1.77806 2.26166C1.83211 2.29368 1.87741 2.33856 1.90994 2.39231L2.55507 3.46709C2.75083 3.16073 3.01269 2.73044 3.21163 2.3332C3.49765 1.76117 3.72455 0.682572 3.79701 0.308845M4.3201 0.912655C4.20506 1.42113 4.01501 2.14697 3.77985 2.61858C3.46714 3.24336 3.0165 3.9298 2.86142 4.16051C2.82554 4.21345 2.77693 4.25651 2.72005 4.28574C2.66317 4.31497 2.59986 4.32943 2.53593 4.32778C2.472 4.32614 2.40952 4.30844 2.35422 4.27632C2.29892 4.24421 2.25258 4.1987 2.21948 4.14399L1.57118 3.06476C0.87457 4.19166 0.635589 5.45839 0.635589 5.97131C0.635589 8.10561 2.32244 9.82806 4.44785 9.82806C6.57326 9.82806 8.26265 8.10561 8.26265 5.97131V5.95351L8.26011 5.88995C8.25568 5.80484 8.24911 5.71986 8.24041 5.63508C8.20712 5.3287 8.15362 5.02487 8.08024 4.72555C7.87826 3.89157 7.52027 3.10334 7.02516 2.40248L6.38068 3.47535C6.34338 3.53732 6.28925 3.58743 6.22459 3.61985C6.15993 3.65227 6.08739 3.66566 6.01542 3.65847C5.94344 3.65128 5.87499 3.6238 5.81802 3.57923C5.76105 3.53466 5.71791 3.47483 5.6936 3.40671C5.59064 3.11815 5.33831 2.42917 5.11713 1.98044C5.00463 1.751 4.78916 1.46117 4.55781 1.18596C4.4801 1.09353 4.40086 1.00242 4.3201 0.912655Z" fill="#FEFEFE" />
                                        </svg>
                                        Top Rated
                                    </span>
                                </div>

                                <div class="socials mt-2" aria-label="social links">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="121" height="20" viewBox="0 0 121 20" fill="none">
                                        <path d="M48.75 0.75H46.0227C44.8172 0.75 43.661 1.22411 42.8086 2.06802C41.9562 2.91193 41.4773 4.05653 41.4773 5.25V7.95H38.75V11.55H41.4773V18.75H45.1136V11.55H47.8409L48.75 7.95H45.1136V5.25C45.1136 5.01131 45.2094 4.78239 45.3799 4.6136C45.5504 4.44482 45.7816 4.35 46.0227 4.35H48.75V0.75Z" stroke="#3B3731" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M9.75 13.75C10.8109 13.75 11.8283 13.3286 12.5784 12.5784C13.3286 11.8283 13.75 10.8109 13.75 9.75C13.75 8.68913 13.3286 7.67172 12.5784 6.92157C11.8283 6.17143 10.8109 5.75 9.75 5.75C8.68913 5.75 7.67172 6.17143 6.92157 6.92157C6.17143 7.67172 5.75 8.68913 5.75 9.75C5.75 10.8109 6.17143 11.8283 6.92157 12.5784C7.67172 13.3286 8.68913 13.75 9.75 13.75Z" stroke="#3B3731" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M0.75 13.75V5.75C0.75 4.42392 1.27678 3.15215 2.21447 2.21447C3.15215 1.27678 4.42392 0.75 5.75 0.75H13.75C15.0761 0.75 16.3479 1.27678 17.2855 2.21447C18.2232 3.15215 18.75 4.42392 18.75 5.75V13.75C18.75 15.0761 18.2232 16.3479 17.2855 17.2855C16.3479 18.2232 15.0761 18.75 13.75 18.75H5.75C4.42392 18.75 3.15215 18.2232 2.21447 17.2855C1.27678 16.3479 0.75 15.0761 0.75 13.75Z" stroke="#3B3731" stroke-width="1.5" />
                                        <path d="M15.25 4.25999L15.26 4.24899" stroke="#3B3731" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M84.749 7.95013C84.749 8.15856 84.5734 8.33003 84.3588 8.31961C83.2121 8.26378 82.0922 7.96294 81.079 7.43854C80.8049 7.29643 80.4566 7.48117 80.4566 7.78339V13.066C80.4565 14.1741 80.123 15.258 79.4969 16.1844C78.8709 17.1109 77.9797 17.8394 76.9329 18.2804C75.8861 18.7214 74.7295 18.8557 73.6051 18.6667C72.4808 18.4778 71.4379 17.9738 70.6046 17.2168C69.7713 16.4598 69.1841 15.4828 68.915 14.406C68.646 13.3291 68.7069 12.1994 69.0903 11.1557C69.4737 10.112 70.1629 9.19995 71.073 8.53163C71.9831 7.8633 73.0746 7.46789 74.2131 7.39401C74.264 7.3914 74.3148 7.399 74.3626 7.41634C74.4103 7.43368 74.4538 7.46038 74.4904 7.49479C74.527 7.52919 74.556 7.57056 74.5754 7.6163C74.5948 7.66204 74.6043 7.71118 74.6033 7.76065V10.4133C74.6033 10.6218 74.4277 10.7894 74.215 10.8236C73.7748 10.8955 73.3648 11.0881 73.0336 11.3788C72.7023 11.6695 72.4635 12.0461 72.3454 12.4642C72.2273 12.8823 72.2347 13.3245 72.3669 13.7387C72.499 14.1528 72.7503 14.5217 73.0911 14.8017C73.432 15.0817 73.8482 15.2613 74.2907 15.3192C74.7331 15.3771 75.1834 15.3109 75.5884 15.1285C75.9934 14.946 76.3363 14.6549 76.5766 14.2895C76.8169 13.9241 76.9446 13.4996 76.9446 13.066V1.12895C76.9446 1.02845 76.9857 0.932061 77.0589 0.860993C77.1321 0.789925 77.2314 0.75 77.3348 0.75H80.0664C80.1707 0.752584 80.2703 0.792844 80.3457 0.862918C80.4211 0.932991 80.4669 1.02785 80.4742 1.12895C80.5654 2.09976 81.0041 3.00881 81.714 3.69805C82.4239 4.38728 83.3601 4.81309 84.3598 4.90144C84.5744 4.92039 84.75 5.08808 84.75 5.29745L84.749 7.95013Z" stroke="#3B3731" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M113.15 8.712L108.364 2.002C108.309 1.92404 108.235 1.86049 108.15 1.81666C108.065 1.77282 107.971 1.74996 107.875 1.75H105.349C105.239 1.75014 105.131 1.78057 105.037 1.83797C104.943 1.89536 104.867 1.9775 104.817 2.07539C104.766 2.17328 104.744 2.28315 104.752 2.39296C104.759 2.50278 104.797 2.60831 104.861 2.698L110.988 11.288M113.15 8.712L119.277 17.302C119.341 17.3917 119.379 17.4972 119.387 17.607C119.395 17.7169 119.372 17.8267 119.322 17.9246C119.272 18.0225 119.195 18.1046 119.101 18.162C119.007 18.2194 118.899 18.2499 118.789 18.25H116.263C116.168 18.25 116.073 18.2272 115.988 18.1833C115.903 18.1395 115.83 18.076 115.774 17.998L110.988 11.288M113.15 8.712L118.992 1.75M110.988 11.288L105.146 18.25" stroke="#3B3731" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="right">
                        <div class="action-row">
                            <div class="fav" role="button" aria-pressed="false" title="Add to favourites">
                                <svg xmlns="http://www.w3.org/2000/svg" width="23" height="21" viewBox="0 0 23 21" fill="none">
                                    <path d="M11.25 4.3125C11.25 4.3125 11.25 4.3125 10.3633 3.125C9.33667 1.7475 7.82 0.75 6 0.75C3.095 0.75 0.75 3.13687 0.75 6.09375C0.75 7.19813 1.07667 8.21938 1.63667 9.0625C2.58167 10.4994 11.25 19.75 11.25 19.75M11.25 4.3125C11.25 4.3125 11.25 4.3125 12.1367 3.125C13.1633 1.7475 14.68 0.75 16.5 0.75C19.405 0.75 21.75 3.13687 21.75 6.09375C21.75 7.19813 21.4233 8.21938 20.8633 9.0625C19.9183 10.4994 11.25 19.75 11.25 19.75" stroke="#3B3731" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <span>Add to Favourites</span>
                            </div>

                            <!-- <button class="icon-btn" title="Copy link">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                                    <path d="M8 7h9v9" stroke="#333" stroke-width="1.4" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <rect x="3" y="3" width="13" height="13" rx="2" stroke="#333" stroke-width="1.4" />
                                </svg>
                            </button>
                            <button class="icon-btn" title="Share">
                                <svg xmlns="http://www.w3.org/2000/svg" width="17" height="20" viewBox="0 0 17 20" fill="none">
                                    <path d="M0.75 11.25V17.25C0.75 17.6478 0.893668 18.0294 1.1494 18.3107C1.40513 18.592 1.75198 18.75 2.11364 18.75H14.3864C14.748 18.75 15.0949 18.592 15.3506 18.3107C15.6063 18.0294 15.75 17.6478 15.75 17.25V11.25M8.25 13.5V1.125M12.3409 5.25L8.25 0.75L4.15909 5.25" stroke="#3B3731" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </button> -->
                            <svg xmlns="http://www.w3.org/2000/svg" width="51" height="20" viewBox="0 0 51 20" fill="none">
                                <path d="M34.9999 11.25V17.25C34.9999 17.6478 35.1435 18.0294 35.3993 18.3107C35.655 18.592 36.0019 18.75 36.3635 18.75H48.6362C48.9979 18.75 49.3447 18.592 49.6005 18.3107C49.8562 18.0294 49.9999 17.6478 49.9999 17.25V11.25M42.4999 13.5V1.125M46.5908 5.25L42.4999 0.75L38.409 5.25" stroke="#3B3731" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                <mask id="path-2-inside-1_1_80" fill="white">
                                    <rect x="3.12488" y="3.12497" width="11.875" height="16.625" rx="1" />
                                </mask>
                                <rect x="3.12488" y="3.12497" width="11.875" height="16.625" rx="1" stroke="#3B3731" stroke-width="3" mask="url(#path-2-inside-1_1_80)" />
                                <path d="M12.625 3.125V1.75C12.625 1.19772 12.1773 0.75 11.625 0.75H1.75C1.19772 0.75 0.75 1.19772 0.75 1.75V16.375C0.75 16.9273 1.19771 17.375 1.75 17.375H3.125" stroke="#3B3731" stroke-width="1.5" />
                            </svg>
                        </div>

                        <div class="meta-stats mt-2">
                            <div class="stat distance"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="20" viewBox="0 0 14 20" fill="none">
                                    <path d="M7 9.5C6.33696 9.5 5.70107 9.23661 5.23223 8.76777C4.76339 8.29893 4.5 7.66304 4.5 7C4.5 6.33696 4.76339 5.70107 5.23223 5.23223C5.70107 4.76339 6.33696 4.5 7 4.5C7.66304 4.5 8.29893 4.76339 8.76777 5.23223C9.23661 5.70107 9.5 6.33696 9.5 7C9.5 7.3283 9.43534 7.65339 9.3097 7.95671C9.18406 8.26002 8.99991 8.53562 8.76777 8.76777C8.53562 8.99991 8.26002 9.18406 7.95671 9.3097C7.65339 9.43534 7.3283 9.5 7 9.5ZM7 0C5.14348 0 3.36301 0.737498 2.05025 2.05025C0.737498 3.36301 0 5.14348 0 7C0 12.25 7 20 7 20C7 20 14 12.25 14 7C14 5.14348 13.2625 3.36301 11.9497 2.05025C10.637 0.737498 8.85652 0 7 0Z" fill="#FFC97A" />
                                </svg><span>2.5 mi</span></div>
                            <div class="stat"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                    <path d="M8.75651 0.943537C9.14791 -0.314515 10.8521 -0.314511 11.2435 0.943541L12.7078 5.65027C12.8829 6.21288 13.3849 6.5938 13.9513 6.5938H18.69C19.9566 6.5938 20.4832 8.2865 19.4585 9.06402L15.6249 11.9729C15.1666 12.3207 14.9748 12.937 15.1499 13.4996L16.6142 18.2063C17.0056 19.4644 15.6269 20.5105 14.6022 19.733L10.7685 16.8241C10.3103 16.4764 9.68974 16.4764 9.23148 16.8241L5.3978 19.733C4.37311 20.5105 2.99439 19.4644 3.38579 18.2063L4.85012 13.4996C5.02516 12.937 4.83341 12.3207 4.37515 11.9729L0.541471 9.06402C-0.483225 8.2865 0.0434023 6.5938 1.31 6.5938H6.04868C6.61512 6.5938 7.11714 6.21288 7.29217 5.65027L8.75651 0.943537Z" fill="#FFC97A" />
                                </svg><span>4.3</span><span style="color:var(--muted); font-weight:400;">(20 reviews)</span></div>
                            <div class="stat">
                                <svg class="block-svg cursor" xmlns="http://www.w3.org/2000/svg" width="25" height="5" viewBox="0 0 25 5" fill="none">
                                    <circle cx="2.5" cy="2.5" r="2.5" fill="#3B3731" />
                                    <circle cx="12.5" cy="2.5" r="2.5" fill="#3B3731" />
                                    <circle cx="22.5" cy="2.5" r="2.5" fill="#3B3731" />
                                </svg>

                                <div class="block-btn-div">
                                    <button class="block-btn d-flex align-items-center justify-content-between">
                                        Block
                                        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 15 15" fill="none">
                                            <path d="M7.05664 0.375C7.86761 0.375004 8.63276 0.509461 9.35449 0.777344L9.66113 0.900391C10.4786 1.25264 11.1862 1.72915 11.7871 2.3291C12.3879 2.92892 12.8651 3.63584 13.2178 4.45312C13.5673 5.26324 13.7432 6.12989 13.7432 7.05664C13.7432 7.98354 13.5669 8.85036 13.2178 9.66113C12.8656 10.4789 12.3889 11.1868 11.7881 11.7871C11.187 12.3876 10.4798 12.8646 9.66406 13.2178C8.8559 13.5676 7.98971 13.7437 7.06152 13.7432C6.13461 13.7432 5.26684 13.5669 4.45605 13.2178C3.63899 12.8651 2.93181 12.3883 2.33105 11.7881C1.73017 11.1877 1.25306 10.4812 0.900391 9.66504C0.550891 8.85611 0.375027 7.98939 0.375 7.06152C0.375 6.24972 0.509614 5.4845 0.777344 4.76367L0.900391 4.45703C1.25262 3.63963 1.72876 2.93196 2.32812 2.33105C2.92737 1.73033 3.63433 1.25309 4.45215 0.900391C5.26288 0.550756 6.12982 0.375 7.05664 0.375Z" stroke="#3B3731" stroke-width="0.75" />
                                            <line x1="1.92618" y1="2.22623" x2="11.8918" y2="12.1918" stroke="#3B3731" stroke-width="0.75" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="image-grid mt-4">
                    <div class="image-grid-item large-image" style="grid-area: img-1;">
                        <img src="<?= BASE_URL ?>/assets/images/profile-img-1.png" alt="">
                    </div>
                    <div class="image-grid-item large-image" style="grid-area: img-2;">
                        <img src="<?= BASE_URL ?>/assets/images/profile-img-2.png" alt="">
                    </div>
                    <div class="image-grid-item small-image" style="grid-area: img-3;">
                        <img src="<?= BASE_URL ?>/assets/images/profile-img-3.png" alt="">
                    </div>
                    <div class="image-grid-item small-image" style="grid-area: img-4;">
                        <img src="<?= BASE_URL ?>/assets/images/profile-img-4.png" alt="">
                    </div>
                    <div class="image-grid-item small-image" style="grid-area: img-5;">
                        <img src="<?= BASE_URL ?>/assets/images/profile-img-5.png" alt="">
                    </div>
                    <div class="image-grid-item small-image last-image-text" style="grid-area: img-6;">
                        <img src="<?= BASE_URL ?>/assets/images/profile-img-6.png" alt="">
                        <p class="show-all-pics">
                            <svg xmlns="http://www.w3.org/2000/svg" width="11" height="11" viewBox="0 0 11 11" fill="none">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M9.77778 4.88889C10.0861 4.88879 10.3831 5.00525 10.6092 5.21491C10.8353 5.42458 10.9738 5.71196 10.9969 6.01944L11 6.11111V9.77778C11.0001 10.0861 10.8836 10.3831 10.674 10.6092C10.4643 10.8353 10.1769 10.9738 9.86944 10.9969L9.77778 11H7.33333C7.02498 11.0001 6.72799 10.8836 6.50189 10.674C6.27579 10.4643 6.13729 10.1769 6.11417 9.86944L6.11111 9.77778V6.11111C6.11101 5.80276 6.22747 5.50576 6.43714 5.27966C6.6468 5.05357 6.93418 4.91507 7.24167 4.89194L7.33333 4.88889H9.77778ZM3.66667 7.33333C3.99082 7.33333 4.3017 7.4621 4.53091 7.69131C4.76012 7.92053 4.88889 8.2314 4.88889 8.55556V9.77778C4.88889 10.1019 4.76012 10.4128 4.53091 10.642C4.3017 10.8712 3.99082 11 3.66667 11H1.22222C0.898069 11 0.587192 10.8712 0.357981 10.642C0.128769 10.4128 0 10.1019 0 9.77778V8.55556C0 8.2314 0.128769 7.92053 0.357981 7.69131C0.587192 7.4621 0.898069 7.33333 1.22222 7.33333H3.66667ZM3.66667 0C3.99082 0 4.3017 0.128769 4.53091 0.357981C4.76012 0.587192 4.88889 0.898069 4.88889 1.22222V4.88889C4.88889 5.21304 4.76012 5.52392 4.53091 5.75313C4.3017 5.98234 3.99082 6.11111 3.66667 6.11111H1.22222C0.898069 6.11111 0.587192 5.98234 0.357981 5.75313C0.128769 5.52392 0 5.21304 0 4.88889V1.22222C0 0.898069 0.128769 0.587192 0.357981 0.357981C0.587192 0.128769 0.898069 0 1.22222 0H3.66667ZM9.77778 0C10.1019 0 10.4128 0.128769 10.642 0.357981C10.8712 0.587192 11 0.898069 11 1.22222V2.44444C11 2.7686 10.8712 3.07947 10.642 3.30869C10.4128 3.5379 10.1019 3.66667 9.77778 3.66667H7.33333C7.00918 3.66667 6.6983 3.5379 6.46909 3.30869C6.23988 3.07947 6.11111 2.7686 6.11111 2.44444V1.22222C6.11111 0.898069 6.23988 0.587192 6.46909 0.357981C6.6983 0.128769 7.00918 0 7.33333 0H9.77778Z" fill="white" />
                            </svg>
                            Show all photos
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-4">
                <div class="service-card mt-4 mb-5">
                    <div class="service__header">
                        <h2 class="section-heading">Sarah W.</h2>
                        <span class="section-heading-span fs-16">Sarah’s Grooming Studio</span>
                        <div class="tags-row mt-3">
                            <span class="pill serive-card">
                                Home Visit
                            </span>
                            <span class="pill serive-card">
                                Mobile Station
                            </span>
                        </div>
                        <div class="personal-info d-flex align-items-center flex-wrap mt-3">
                            <span class="listing-option">ID-Verified</span>
                            <span class="listing-option">5+ years of experience</span>
                            <span class="listing-option">City & Guilds Certified</span>
                            <span class="listing-option">Insured</span>
                            <span class="listing-option">Animal-handling certified</span>
                        </div>
                        <div class="message-btn-div d-flex justify-content-center mt-4">
                            <button class="message-btn">Message Groomer</button>
                        </div>
                        <p class="responding-time text-center mt-2">Typically responds within 1 hour.</p>
                    </div>
                    <div class="service__availability mt-5">
                        <h2 class="section-heading mb-2">Availability</h2>
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12" fill="none">
                                <path d="M6 0C2.68631 0 0 2.68631 0 6C0 9.31388 2.68631 12 6 12C9.31388 12 12 9.31388 12 6C12 2.68631 9.31388 0 6 0ZM6 11.2618C3.10519 11.2618 0.75 8.89481 0.75 5.99998C0.75 3.10516 3.10519 0.749977 6 0.749977C8.89481 0.749977 11.25 3.10518 11.25 5.99998C11.25 8.89478 8.89481 11.2618 6 11.2618Z" fill="#9D9B98" />
                                <path d="M3.3 6.3L5.1 8.1L8.7 4.5" stroke="#9D9B98" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            Availability updated yesterday.
                        </span>

                        <div class="service-type-select mt-4">
                            <p class="label">Service Type</p>
                            <div class="custom-select" data-multiselect data-color="#FBAC83">
                                <div class="select-trigger w-auto">
                                    <span class="selected-text">Full groom</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="8"
                                        viewBox="0 0 15 8" fill="none">
                                        <path d="M13.8737 0.5L7.13022 7.24344L0.499976 0.613201"
                                            stroke="#3B3731" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                </div>

                                <ul class="select-options">
                                    <li data-value="full-groom">Full groom</li>
                                    <li data-value="face-trim">Face Trim Only</li>
                                    <li data-value="tail-trim">Tail Trim Only</li>
                                    <li data-value="bath-brush">Bath & Brush</li>
                                    <li data-value="nail-trim">Nail Trim</li>
                                </ul>

                                <input type="hidden" name="serviceType">
                            </div>
                            <div class="service-selected-options d-flex align-items-center flex-wrap gap-10 mt-4">
                                <div class="selected-item d-flex align-items-center gap-10" data-value="full-groom" style="background: none;color: #FBAC83; border:1px solid #FBAC83">
                                    <p>Full groom</p>
                                    <svg style="cursor: pointer" xmlns="http://www.w3.org/2000/svg" width="9" height="9" viewBox="0 0 9 9" fill="none">
                                        <path d="M0.5 7.57L7.572 0.5M0.5 0.5L7.572 7.57" stroke="#FBAC83" stroke-linecap="round" />
                                    </svg>
                                </div>
                                <div class="selected-item d-flex align-items-center gap-10" data-value="face-trim" style="background: none;color: #FBAC83; border:1px solid #FBAC83">
                                    <p>Face Trim Only</p>
                                    &nbsp;
                                    <svg style="cursor: pointer" xmlns="http://www.w3.org/2000/svg" width="9" height="9" viewBox="0 0 9 9" fill="none">
                                        <path d="M0.5 7.57L7.572 0.5M0.5 0.5L7.572 7.57" stroke="#FBAC83" stroke-linecap="round" />
                                    </svg>
                                </div>
                                <div class="selected-item d-flex align-items-center gap-10" data-value="bath-brush" style="background: none;color: #FBAC83; border:1px solid #FBAC83">
                                    <p>Bath & Brush</p>
                                    <svg style="cursor: pointer" xmlns="http://www.w3.org/2000/svg" width="9" height="9" viewBox="0 0 9 9" fill="none">
                                        <path d="M0.5 7.57L7.572 0.5M0.5 0.5L7.572 7.57" stroke="#FBAC83" stroke-linecap="round" />
                                    </svg>
                                </div>
                            </div>
                        </div>



                        <div class="service-type-select mt-4">
                            <p class="label">Extra’s & Add-ons</p>
                            <div class="custom-select" data-multiselect data-color="#FFC97A">
                                <div class="select-trigger w-auto">
                                    <span class="selected-text">Hypoallergenic Shampoo Upgrade</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="8"
                                        viewBox="0 0 15 8" fill="none">
                                        <path d="M13.8737 0.5L7.13022 7.24344L0.499976 0.613201"
                                            stroke="#3B3731" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                </div>

                                <ul class="select-options">
                                    <li data-value="hypoallergenic-shampoo-upgrade">Hypoallergenic Shampoo Upgrade</li>
                                    <li data-value="flea-&-tick-treatment">Flea & Tick Treatment</li>
                                    <li data-value="hypoallergenic-shampoo">Hypoallergenic Shampoo</li>
                                </ul>

                                <input type="hidden" name="extras-addons">
                            </div>
                            <div class="service-selected-options d-flex align-items-center flex-wrap gap-10 mt-4">
                                <div class="selected-item d-flex align-items-center gap-10" data-value="flea-&-tick-treatment" style="background: none;color: #FFC97A;border:1px solid #FFC97A">
                                    <p>Flea & Tick Treatment</p>
                                    <svg style="cursor: pointer" xmlns="http://www.w3.org/2000/svg" width="9" height="9" viewBox="0 0 9 9" fill="none">
                                        <path d="M0.5 7.57L7.572 0.5M0.5 0.5L7.572 7.57" stroke="#FFC97A" stroke-linecap="round" />
                                    </svg>
                                </div>
                                <div class="selected-item d-flex align-items-center gap-10" data-value="hypoallergenic-shampoo" style="background: none;color: #FFC97A;border:1px solid #FFC97A">
                                    <p>Hypoallergenic Shampoo</p>
                                    &nbsp;
                                    <svg style="cursor: pointer" xmlns="http://www.w3.org/2000/svg" width="9" height="9" viewBox="0 0 9 9" fill="none">
                                        <path d="M0.5 7.57L7.572 0.5M0.5 0.5L7.572 7.57" stroke="#FFC97A" stroke-linecap="round" />
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <div class="calendar mt-4">
                            <div class="calendar-header">
                                <button class="nav-btn">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="7" height="11" viewBox="0 0 7 11" fill="none">
                                        <path d="M5.53426 10.484L0.499999 5.44975L5.44975 0.500005" stroke="#3B3731" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                </button>
                                <span>October 2025</span>
                                <button class="nav-btn">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="7" height="11" viewBox="0 0 7 11" fill="none">
                                        <path d="M0.5 10.484L5.53426 5.44975L0.58451 0.500005" stroke="#3B3731" stroke-linecap="round"
                                            stroke-linejoin="round" />
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
                                <div class="date selected">14</div>
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

                            <div class="availability mt-4">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                                    <path
                                        d="M9 0C4.05 0 0 4.05 0 9C0 13.95 4.05 18 9 18C13.95 18 18 13.95 18 9C18 4.05 13.95 0 9 0ZM7.2 13.5L2.7 9L3.969 7.731L7.2 10.953L14.031 4.122L15.3 5.4L7.2 13.5Z"
                                        fill="#D8E8B7" />
                                </svg>
                                Availability
                            </div>

                            <div class="times mt-4">
                                <div class="time">09:00 AM</div>
                                <div class="time">11:00 AM</div>
                                <div class="time selected">12:00 PM</div>
                                <div class="time">16:00 PM</div>
                                <div class="time">20:00 PM</div>
                            </div>

                            <div class="book-btn-div mt-4">
                                <button class="book-btn" data-modal-open="groomer_prompt">Book now</button>
                            </div>
                            <div class="last-booked">
                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12" fill="none">
                                    <path
                                        d="M6.06678 12C5.22451 12 4.43583 11.8435 3.70074 11.5305C2.96564 11.2175 2.32358 10.789 1.77453 10.245C1.22549 9.701 0.79222 9.066 0.474725 8.34001C0.158242 7.61251 0 6.83251 0 6.00001C0 5.16801 0.158242 4.38801 0.474725 3.66001C0.791209 2.93201 1.22448 2.29702 1.77453 1.75502C2.32459 1.21302 2.96666 0.784518 3.70074 0.469518C4.43482 0.154519 5.2235 -0.00198107 6.06678 1.89274e-05C6.93736 1.89274e-05 7.76674 0.178019 8.55492 0.534018C9.34309 0.889518 10.0302 1.38552 10.6161 2.02202V0.606018C10.6161 0.499518 10.6525 0.410268 10.7253 0.338269C10.7981 0.266269 10.8884 0.230519 10.996 0.231019C11.1037 0.231519 11.1937 0.267269 11.266 0.338269C11.3383 0.409268 11.3745 0.498518 11.3745 0.606018V2.74051C11.3745 2.91201 11.3158 3.05576 11.1985 3.17176C11.0812 3.28776 10.9359 3.34601 10.7625 3.34651H8.60421C8.49653 3.34651 8.40628 3.31026 8.33348 3.23776C8.26118 3.16626 8.22504 3.07726 8.22504 2.97076C8.22504 2.86426 8.26118 2.77526 8.33348 2.70376C8.40578 2.63227 8.49602 2.59627 8.60421 2.59577H10.1057C9.57793 2.02077 8.96872 1.56952 8.27812 1.24202C7.58853 0.914018 6.85142 0.750018 6.06678 0.750018C4.5875 0.750018 3.33294 1.25952 2.3031 2.27852C1.27327 3.29751 0.758095 4.53801 0.757589 6.00001C0.757084 7.46201 1.27225 8.70275 2.3031 9.72225C3.33395 10.7418 4.58826 11.251 6.06602 11.25C7.31578 11.25 8.4217 10.8625 9.38379 10.0875C10.3459 9.31251 10.9644 8.32901 11.2395 7.13701C11.2733 7.02301 11.331 6.93551 11.4124 6.87451C11.4943 6.81251 11.5891 6.78926 11.6968 6.80476C11.8115 6.81976 11.8957 6.87426 11.9493 6.96826C12.0029 7.06226 12.014 7.16451 11.9826 7.27501C11.694 8.65701 10.9998 9.79 9.90023 10.674C8.80062 11.558 7.52331 12 6.06678 12ZM6.4452 5.84401L8.72024 8.09401C8.79102 8.16401 8.82893 8.25001 8.83399 8.35201C8.83905 8.45451 8.80113 8.54551 8.72024 8.62501C8.63935 8.70501 8.54986 8.74501 8.45178 8.74501C8.3537 8.74501 8.26447 8.70501 8.18409 8.62501L5.87113 6.33751C5.8049 6.27251 5.75763 6.20401 5.72932 6.13201C5.701 6.06001 5.68685 5.98576 5.68685 5.90926V2.62502C5.68685 2.51852 5.72325 2.42952 5.79605 2.35802C5.86885 2.28602 5.95909 2.25002 6.06678 2.25002C6.17447 2.25002 6.26446 2.28602 6.33675 2.35802C6.40905 2.43002 6.4452 2.51902 6.4452 2.62502V5.84401Z"
                                        fill="#9D9B98" />
                                </svg> Last booked 2 days ago
                            </div>

                            <div class="note mt-4">
                                <svg xmlns="http://www.w3.org/2000/svg" width="120" height="100" viewBox="0 0 48 48" fill="none">
                                    <path
                                        d="M24 4.8C34.5864 4.8 43.2 13.4136 43.2 24C43.2 34.5864 34.5864 43.2 24 43.2C13.4136 43.2 4.8 34.5864 4.8 24C4.8 13.4136 13.4136 4.8 24 4.8ZM24 0C10.7448 0 0 10.7448 0 24C0 37.2552 10.7448 48 24 48C37.2552 48 48 37.2552 48 24C48 10.7448 37.2552 0 24 0ZM26.4 31.2H21.6V36H26.4V31.2ZM21.6 26.4H26.4L27.6 12H20.4L21.6 26.4Z"
                                        fill="#FFC97A" />
                                </svg> Free cancellations up to 24 hours before appointment. Tools sanitised after every pet.
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- <button class="normal-font-bold btn-custom btn-no-bg text-center" data-modal-open="groomer_prompt" style="color:#FBAC83;border:1px solid #FBAC83">Submit request</button> -->

            <!-- Modal  -->

            <div class="modal" id="groomer_prompt">
                <div class="modal-content">
                    <div class="groomer-cross-svg cursor d-flex justify-content-end" data-modal-close>
                        <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 36 36" fill="none">
                            <circle cx="18" cy="18" r="17.5" stroke="#3B3731" />
                            <path d="M12.8 23.9998L24 12.7998M12.8 12.7998L24 23.9998" stroke="#3B3731" stroke-width="1.5" stroke-linecap="round" />
                        </svg>
                    </div>
                    <div class="d-flex flex-column align-items-center justify-content-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="76" height="52" viewBox="0 0 76 52" fill="none">
                            <rect x="11.8813" y="1.00977" width="50.0001" height="17.8218" rx="8.91091" fill="#FFA899" />
                            <rect y="18.3369" width="50.0001" height="17.3268" rx="8.66339" fill="#FFA899" />
                            <rect x="25.2478" y="33.188" width="50.0001" height="17.8218" rx="8.91091" fill="#FFA899" />
                            <path d="M23.0199 18.9307L36.4798 6.89581C40.1369 3.631 41.9626 2 44.1833 2C46.4041 2 48.2326 3.631 51.8868 6.89581L65.3467 18.9307M27.2526 16.1089V49.9704M61.1141 49.9704V16.1089" stroke="#3B3731" stroke-width="4" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M13.1436 33.0396C15.4813 33.0396 17.3763 30.5129 17.3763 27.396C17.3763 24.2792 15.4813 21.7524 13.1436 21.7524C10.806 21.7524 8.91095 24.2792 8.91095 27.396C8.91095 30.5129 10.806 33.0396 13.1436 33.0396Z" stroke="#3B3731" stroke-width="4" />
                            <path d="M13.1437 33.0396V49.9703" stroke="#3B3731" stroke-width="4" stroke-linecap="round" />
                            <path d="M8.91095 49.9704H65.3467M37.1288 49.9704V38.6832C37.1288 36.0223 37.1288 34.6932 37.9556 33.8664C38.7824 33.0396 40.1115 33.0396 42.7724 33.0396H45.5942C48.2552 33.0396 49.5842 33.0396 50.411 33.8664C51.2378 34.6932 51.2378 36.0223 51.2378 38.6832V49.9704M41.3615 24.5743H47.0051M41.3615 16.1089H47.0051" stroke="#3B3731" stroke-width="4" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <p class="normal-font-weight font-bg-color mt-3" style="color:#FFA899">
                            You’ve selected a Visiting Groomer

                            <span class="tooltip cursor">
                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12" fill="none">
                                    <path d="M5.4 8.4C5.4 8.73137 5.66863 9 6 9C6.33137 9 6.6 8.73137 6.6 8.4V6C6.6 5.66863 6.33137 5.4 6 5.4C5.66863 5.4 5.4 5.66863 5.4 6V8.4ZM6 4.2C6.17 4.2 6.3126 4.1424 6.4278 4.0272C6.543 3.912 6.6004 3.7696 6.6 3.6C6.5996 3.4304 6.542 3.288 6.4272 3.1728C6.3124 3.0576 6.17 3 6 3C5.83 3 5.6876 3.0576 5.5728 3.1728C5.458 3.288 5.4004 3.4304 5.4 3.6C5.3996 3.7696 5.4572 3.9122 5.5728 4.0278C5.6884 4.1434 5.8308 4.2008 6 4.2ZM6 12C5.17 12 4.39 11.8424 3.66 11.5272C2.93 11.212 2.295 10.7846 1.755 10.245C1.215 9.7054 0.7876 9.0704 0.4728 8.34C0.158001 7.6096 0.000400759 6.8296 7.59493e-07 6C-0.00039924 5.1704 0.157201 4.3904 0.4728 3.66C0.7884 2.9296 1.2158 2.2946 1.755 1.755C2.2942 1.2154 2.9292 0.788 3.66 0.4728C4.3908 0.1576 5.1708 0 6 0C6.8292 0 7.6092 0.1576 8.33999 0.4728C9.07079 0.788 9.7058 1.2154 10.245 1.755C10.7842 2.2946 11.2118 2.9296 11.5278 3.66C11.8438 4.3904 12.0012 5.1704 12 6C11.9988 6.8296 11.8412 7.6096 11.5272 8.34C11.2132 9.0704 10.7858 9.7054 10.245 10.245C9.7042 10.7846 9.06919 11.2122 8.33999 11.5278C7.6108 11.8434 6.8308 12.0008 6 12ZM6 10.8C7.34 10.8 8.47499 10.335 9.40499 9.405C10.335 8.475 10.8 7.34 10.8 6C10.8 4.66 10.335 3.525 9.40499 2.595C8.47499 1.665 7.34 1.2 6 1.2C4.66 1.2 3.525 1.665 2.595 2.595C1.665 3.525 1.2 4.66 1.2 6C1.2 7.34 1.665 8.475 2.595 9.405C3.525 10.335 4.66 10.8 6 10.8Z" fill="#FFA899" />
                                </svg>

                                <span class="tooltiptext">
                                    Visiting Groomers provide mobile services and don’t have a grooming space.
                                </span>
                            </span>
                        </p>
                        <h1 class="large-font text-center mt-3" style="line-height: normal;">Where would you like the <br> service to take place?</h1>
                    </div>

                    <div class="d-flex flex-column align-items-center justify-content-center">
                        <div class="groomer-find-card cursor d-flex flex-column justify-content-center mt-4">
                            <p class="medium-font-m-bold">At my home</p>
                            <p class="normal-light-color-font">The groomer comes to you.</p>
                        </div>

                        <div class="groomer-find-card cursor d-flex flex-column justify-content-center mt-4">
                            <p class="medium-font-m-bold">Find a grooming space for me</p>
                            <p class="normal-light-color-font">We’ll match you with a nearby available space.</p>
                        </div>
                    </div>

                    <div class="modal-footer d-flex align-items-center justify-content-center mt-4 gap-10">
                        <button class="modal-footer-btn">Go Back</button>
                        <button class="modal-footer-btn apply">Continue</button>
                    </div>

                </div>
            </div>

            <!-- Modal  -->

            <div class="col-lg-8">
                <div class="service-content mt-4 mb-5">
                    <div class="service-content-header">
                        <h2 class="section-content-heading">About Me</h2>
                        <div class="avatar-wrap d-flex align-items-center mt-3">
                            <img class="avatar" src="<?= BASE_URL ?>/assets/images/groomer-profile.png" alt="Sarah's avatar">
                            <p>Hi, I’m Sarah — a professional groomer in West London, specialising in small breeds, anxious pets, & gentle handling!</p>
                        </div>
                    </div>
                    <div class="tab-go-to-section d-flex align-items-center flex-wrap justify-content-between mt-5">
                        <a href="#services_and_pricing" class="active">Services & Add-ons</a>
                        <a href="#preference_and_restrictions">Preference & Restrictions</a>
                        <a href="#reviews">Reviews</a>
                        <a href="#location">Location</a>
                    </div>
                    <div id="services_and_pricing" class="mt-5 section-offset">
                        <h2 class="section-content-heading">Services & Pricing</h2>
                        <div class="services-list d-flex align-items-center justify-content-between mt-4">
                            <div class="service-list-left d-flex align-items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="27" viewBox="0 0 25 27" fill="none">
                                    <path d="M22.6808 2.95467C23.0165 2.61894 23.5608 2.61896 23.8965 2.95467C25.2459 4.30411 25.2257 6.44019 24.5413 8.49354C23.8387 10.6014 22.3573 12.9175 20.2931 14.9817C18.2289 17.0458 15.9128 18.5272 13.805 19.2299C11.7516 19.9143 9.61553 19.9345 8.26608 18.5851C7.93035 18.2494 7.93035 17.7051 8.26608 17.3694C8.60182 17.0337 9.14603 17.0337 9.48177 17.3694C10.1226 18.0102 11.4016 18.2186 13.2609 17.5989C15.0659 16.9972 17.1611 15.6823 19.0774 13.766C20.9938 11.8496 22.3087 9.75444 22.9103 7.94951C23.53 6.09018 23.3216 4.81116 22.6808 4.17035C22.3451 3.83462 22.3451 3.2904 22.6808 2.95467Z" fill="#3B3731" />
                                    <path d="M14.1219 1.60312C14.4576 1.26738 15.0018 1.26738 15.3375 1.60312L16.2387 2.50425C16.5742 2.84001 16.5743 3.38427 16.2387 3.71994C15.903 4.05561 15.3587 4.05547 15.023 3.71994L14.1219 2.81881C13.7861 2.48307 13.7861 1.93886 14.1219 1.60312Z" fill="#3B3731" />
                                    <path d="M10.969 4.75632C11.3047 4.42058 11.8489 4.42058 12.1847 4.75632L13.0858 5.65745C13.4213 5.99321 13.4215 6.53747 13.0858 6.87314C12.7501 7.2088 12.2059 7.20866 11.8701 6.87314L10.969 5.97201C10.6332 5.63627 10.6332 5.09206 10.969 4.75632Z" fill="#3B3731" />
                                    <path d="M8.26578 8.36045C8.60152 8.02471 9.14573 8.02471 9.48147 8.36045L10.3826 9.26158C10.7181 9.59733 10.7183 10.1416 10.3826 10.4773C10.0469 10.8129 9.50267 10.8128 9.16691 10.4773L8.26578 9.57613C7.93004 9.2404 7.93004 8.69618 8.26578 8.36045Z" fill="#3B3731" />
                                    <path d="M7.36502 12.8646C7.70076 12.5289 8.24497 12.5289 8.58071 12.8646L9.48184 13.7657C9.81736 14.1015 9.81751 14.6457 9.48184 14.9814C9.14618 15.3171 8.60191 15.3169 8.26615 14.9814L7.36502 14.0803C7.02929 13.7445 7.02929 13.2003 7.36502 12.8646Z" fill="#3B3731" />
                                    <path d="M19.0771 0.251804C19.4128 -0.0839344 19.957 -0.0839347 20.2927 0.251804L21.1939 1.15293C21.5294 1.48869 21.5295 2.03295 21.1939 2.36862C20.8582 2.70429 20.3139 2.70415 19.9782 2.36862L19.0771 1.46749C18.7413 1.13175 18.7413 0.587542 19.0771 0.251804Z" fill="#3B3731" />
                                    <path d="M18.1763 5.65744C18.512 5.3217 19.0562 5.32171 19.392 5.65744L21.1942 7.4597C21.5296 7.79546 21.5298 8.33978 21.1942 8.67539C20.8586 9.01095 20.3143 9.01072 19.9786 8.67539L18.1763 6.87312C17.8406 6.53739 17.8406 5.99318 18.1763 5.65744Z" fill="#3B3731" />
                                    <path d="M15.0233 8.81076C15.359 8.47503 15.9032 8.47503 16.239 8.81076L18.0412 10.613C18.3765 10.9488 18.3768 11.4931 18.0412 11.8287C17.7056 12.1643 17.1613 12.164 16.8255 11.8287L15.0233 10.0265C14.6875 9.69071 14.6876 9.1465 15.0233 8.81076Z" fill="#3B3731" />
                                    <path d="M11.4193 11.5135C11.755 11.1778 12.2992 11.1778 12.635 11.5135L14.4372 13.3158C14.7726 13.6515 14.7728 14.1959 14.4372 14.5315C14.1016 14.8671 13.5573 14.8668 13.2215 14.5315L11.4193 12.7292C11.0835 12.3935 11.0835 11.8493 11.4193 11.5135Z" fill="#3B3731" />
                                    <path d="M8.26615 20.0722C8.67655 19.6616 8.6759 18.9955 8.26536 18.5849C7.8548 18.1746 7.18939 18.1746 6.77883 18.5849L3.1749 22.1888C2.76437 22.5994 2.76451 23.2647 3.1749 23.6754C3.58551 24.086 4.25161 24.0868 4.66223 23.6761L8.26615 20.0722ZM5.87805 24.892C4.79595 25.974 3.04117 25.9733 1.95908 24.8912C0.877208 23.8091 0.877068 22.055 1.95908 20.973L5.56301 17.3691C6.64505 16.2873 8.39914 16.2873 9.48118 17.3691C10.5632 18.4511 10.5638 20.2059 9.48197 21.2881L5.87805 24.892Z" fill="#3B3731" />
                                </svg>
                                &nbsp;
                                &nbsp;
                                <p>Full Groom</p>
                            </div>
                            <div class="service-list-right">
                                <div class="price">
                                    <p>From <span>£38</span></p>
                                </div>
                                <div class="reach-time">
                                    <p>60 - 90 min</p>
                                </div>
                            </div>
                        </div>
                        <div class="services-list d-flex align-items-center justify-content-between mt-4">
                            <div class="service-list-left d-flex align-items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="23" viewBox="0 0 25 23" fill="none">
                                    <path d="M22.3518 11.4419L22.3403 11.3626C22.321 11.2858 22.281 11.2148 22.2243 11.1581C22.1485 11.0824 22.0474 11.0376 21.9405 11.0306V11.0295H3.05839C2.95189 11.0366 2.85125 11.0826 2.77576 11.1581C2.70002 11.2339 2.65518 11.335 2.64823 11.4419C2.64773 11.4516 2.64708 11.4729 2.64708 11.5683C2.64708 11.8041 2.64734 11.9735 2.64938 12.1129L2.66317 12.4771V12.4805C2.88515 15.9886 5.89367 19.1126 9.39225 19.467H9.39111C9.62526 19.4904 9.75727 19.4954 10.0598 19.5072H10.0586C10.9158 19.5387 11.7456 19.5577 12.4977 19.5577C13.3116 19.5556 14.1258 19.5392 14.9391 19.5072H14.9403C15.2427 19.4954 15.3739 19.4902 15.6078 19.4658H15.6101C19.107 19.1124 22.1149 15.9887 22.338 12.4805L22.3507 12.114C22.3526 11.9739 22.353 11.8041 22.353 11.5683C22.353 11.4719 22.3523 11.4515 22.3518 11.4419ZM23.8213 12.1347L23.8052 12.5736C23.5365 16.799 19.9714 20.5023 15.7583 20.9284L15.7594 20.9295C15.474 20.9592 15.3012 20.9648 14.9977 20.9766C14.1665 21.0094 13.3342 21.0273 12.5023 21.0295H12.5C11.7234 21.0295 10.8736 21.0086 10.0046 20.9766H10.0035C9.85153 20.9707 9.7325 20.9672 9.61629 20.9605L9.24405 20.9306C5.03085 20.5039 1.46519 16.8016 1.19602 12.577L1.17879 12.1347C1.17642 11.9762 1.17649 11.7969 1.17649 11.5683C1.17649 11.4894 1.17583 11.4151 1.17994 11.3488V11.3465C1.21006 10.8834 1.4078 10.4466 1.73601 10.1184C2.06421 9.79018 2.50101 9.59243 2.96418 9.56231H2.96762C3.03409 9.5583 3.10466 9.55887 3.18591 9.55887H21.8141C21.8941 9.55887 21.9659 9.5583 22.0324 9.56231H22.0359C22.499 9.59243 22.9358 9.79018 23.264 10.1184C23.5512 10.4056 23.7381 10.7759 23.8006 11.1742L23.8201 11.3465V11.3488C23.8242 11.4151 23.8236 11.4881 23.8236 11.5683C23.8236 11.7975 23.8235 11.9767 23.8213 12.1347Z" fill="#3B3731" />
                                    <path d="M4.78401 19.3773C4.96562 19.0141 5.40654 18.8671 5.76976 19.0487C6.13298 19.2303 6.27995 19.6713 6.09835 20.0345L4.92188 22.3874C4.74026 22.7506 4.29934 22.8976 3.93612 22.716C3.57291 22.5344 3.42594 22.0935 3.60754 21.7303L4.78401 19.3773ZM19.2302 19.0487C19.5935 18.8671 20.0344 19.0141 20.216 19.3773L21.3925 21.7303C21.5741 22.0935 21.4271 22.5344 21.0639 22.716C20.7007 22.8976 20.2597 22.7506 20.0781 22.3874L18.9017 20.0345C18.72 19.6713 18.867 19.2303 19.2302 19.0487ZM24.2647 9.55884C24.6708 9.55884 25 9.88804 25 10.2941C25 10.7002 24.6708 11.0294 24.2647 11.0294H0.735294C0.329202 11.0294 0 10.7002 0 10.2941C0 9.88804 0.329202 9.55884 0.735294 9.55884H24.2647Z" fill="#3B3731" />
                                    <path d="M1.91174 9.95294C1.91174 10.1214 1.98056 10.283 2.10306 10.4022C2.22557 10.5213 2.39171 10.5882 2.56496 10.5882C2.7382 10.5882 2.90435 10.5213 3.02685 10.4022C3.14935 10.283 3.21817 10.1214 3.21817 9.95294H1.91174ZM5.47916 6.34616L4.87124 6.57911C4.90339 6.65817 4.95154 6.73015 5.01283 6.79079C5.07411 6.85142 5.14729 6.89947 5.22802 6.9321C5.30875 6.96472 5.3954 6.98125 5.48282 6.98071C5.57024 6.98017 5.65666 6.96256 5.73696 6.92894L5.47916 6.34616ZM10.67 4.17176L10.9287 4.75624C11.0846 4.69093 11.2082 4.56918 11.2734 4.41676C11.3386 4.26435 11.3402 4.09324 11.278 3.93967L10.67 4.17176ZM3.21817 9.95294V2.65553H1.91174V9.95294H3.21817ZM4.64218 1.27059C5.22484 1.27059 5.74828 1.61534 5.96428 2.14136L7.17751 1.66871C6.97493 1.17599 6.62521 0.754448 6.17347 0.456865C5.72172 0.159282 5.18866 0.000152063 4.64305 0L4.64218 1.27059ZM3.21817 2.65553C3.21817 1.89064 3.85571 1.27059 4.64218 1.27059L4.64305 0C3.91889 0 3.22352 0.279778 2.71147 0.777787C2.19941 1.27579 1.91174 1.95124 1.91174 2.65553H3.21817ZM5.96428 2.14136L6.29524 2.94438L7.5076 2.47256L7.17751 1.66871L5.96428 2.14136ZM6.08621 6.11322C5.86721 5.57014 5.87158 4.96591 6.09841 4.42588L4.88778 3.94729C4.5345 4.7898 4.52913 5.73225 4.87124 6.57911L6.08621 6.11322ZM10.4122 3.58899L5.22049 5.76254L5.73696 6.92894L10.9278 4.75539L10.4122 3.58899ZM8.90722 3.23407C9.44895 3.45939 9.85221 3.88546 10.063 4.40471L11.278 3.93967C11.112 3.52304 10.8622 3.14192 10.5434 2.82021C10.2246 2.4985 9.84306 2.24181 9.42108 2.06513L8.90722 3.23407ZM6.09841 4.42588C6.30305 3.92583 6.6909 3.51809 7.18709 3.27981L6.61575 2.13798C5.82981 2.51289 5.21431 3.15737 4.88778 3.94729L6.09841 4.42588ZM7.18709 3.27981C7.45345 3.15188 7.74514 3.08162 8.0421 3.07387C8.33905 3.06612 8.6342 3.12022 8.90722 3.23407L9.42108 2.06513C8.97575 1.87988 8.49451 1.79125 8.01032 1.80368C7.52613 1.8161 7.05042 1.93014 6.61575 2.13798L7.18709 3.27981Z" fill="#3B3731" />
                                </svg>
                                &nbsp;
                                &nbsp;
                                <p>Bath & Tidy</p>
                            </div>
                            <div class="service-list-right">
                                <div class="price">
                                    <p>From <span>£30</span></p>
                                </div>
                            </div>
                        </div>
                        <div class="services-list d-flex align-items-center justify-content-between mt-4">
                            <div class="service-list-left d-flex align-items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="24" viewBox="0 0 25 24" fill="none">
                                    <path d="M11.1621 9.58842C12.0295 9.29401 12.9692 9.29407 13.8366 9.58842C14.7981 9.91503 15.4985 10.7259 16.1473 11.7619C16.7984 12.8039 17.508 14.2554 18.408 16.1028L19.4627 18.264C19.6949 18.7376 19.8783 19.1155 20.0107 19.4161C20.1421 19.7123 20.2547 20.0023 20.3013 20.2833C20.622 22.1716 19.2354 23.9438 17.3216 24C17.0194 23.999 16.7187 23.9581 16.4268 23.8791C16.0203 23.7795 15.615 23.6726 15.2123 23.5584L15.194 23.5535C14.825 23.4443 14.4524 23.3479 14.0771 23.2636C13.0366 23.0504 11.9633 23.0504 10.9228 23.2636C10.5475 23.3479 10.1749 23.4444 9.80593 23.5535L9.78763 23.5584C9.28881 23.6954 8.88938 23.8065 8.57428 23.8791C8.28205 23.9583 7.98092 23.9991 7.67831 24L7.50009 23.9901C5.67915 23.8333 4.38683 22.1126 4.69743 20.2833C4.74394 20.0023 4.85773 19.7123 4.98795 19.4161C5.05274 19.2691 5.13078 19.1039 5.21988 18.9178L5.52139 18.2961L5.53725 18.264L6.59191 16.1028L6.61266 16.0584C7.39217 14.4603 8.02741 13.1607 8.60724 12.169L8.85259 11.7619C9.46077 10.7908 10.1128 10.0171 10.9851 9.65503L11.1621 9.58842ZM13.4386 10.785C12.8296 10.5783 12.1691 10.5795 11.56 10.7862C11.0931 10.9448 10.6503 11.3367 10.1343 12.0913L9.90847 12.4379C9.30552 13.4 8.63783 14.7651 7.73446 16.6172L7.71249 16.6604L6.65783 18.8216L6.64196 18.8549C6.41377 19.3224 6.24766 19.6646 6.1305 19.9305C6.00423 20.2178 5.94861 20.3812 5.93031 20.4918V20.4967C5.73505 21.6457 6.57593 22.6949 7.7015 22.7356C7.88704 22.7328 8.07162 22.7077 8.2508 22.6591L8.274 22.653L8.29597 22.648C8.57901 22.5828 8.94534 22.4808 9.45926 22.3396L9.47269 22.3359L9.4849 22.3335C9.87065 22.2201 10.2597 22.1181 10.6519 22.03L10.6628 22.0276L10.6751 22.0251C11.8793 21.7784 13.1206 21.7784 14.3249 22.0251L14.3358 22.0276L14.348 22.03C14.7337 22.1166 15.116 22.2175 15.4955 22.3285L15.515 22.3335L15.5321 22.3372L15.5504 22.3421C15.7445 22.3972 15.9389 22.4509 16.1339 22.5025L16.721 22.6517L16.7503 22.6591C16.9284 22.7073 17.1116 22.7326 17.296 22.7356C18.4226 22.6961 19.265 21.6464 19.0696 20.4967L19.0684 20.4918C19.0499 20.38 18.9953 20.2141 18.8706 19.933L18.8694 19.9305C18.7493 19.6578 18.5771 19.3031 18.3421 18.824L18.3409 18.8216L17.2862 16.6604C16.3748 14.7894 15.6978 13.409 15.0902 12.4367C14.4746 11.4539 13.9718 10.9661 13.4386 10.785ZM1.66895 8.9112C2.50374 8.61394 3.35196 8.85555 4.00653 9.31211C4.66554 9.77219 5.20769 10.4919 5.52505 11.3462C5.84241 12.2007 5.90025 13.0978 5.69228 13.875C5.48533 14.65 4.98391 15.3774 4.14569 15.676L3.98945 15.7253C3.20584 15.9416 2.42196 15.7032 1.80811 15.2751C1.23129 14.8724 0.744281 14.271 0.418987 13.5543L0.289596 13.241C0.0129539 12.4934 -0.0671517 11.7134 0.0564481 11.0095L0.122364 10.7122C0.316349 9.98577 0.768893 9.30167 1.51515 8.97288L1.66895 8.9112ZM20.9934 9.31211C21.648 8.85669 22.4961 8.61377 23.331 8.90997C24.1692 9.20852 24.6706 9.93718 24.8775 10.7122C25.0856 11.4895 25.0277 12.3864 24.7103 13.241C24.393 14.0965 23.8508 14.815 23.1918 15.2751L22.9367 15.4355C22.3245 15.7828 21.5846 15.9361 20.8542 15.676C20.0159 15.3775 19.5146 14.65 19.3076 13.875C19.1008 13.0977 19.1586 12.2007 19.4749 11.3462C19.7923 10.4907 20.3343 9.77216 20.9934 9.31211ZM22.9147 10.1003C22.5641 9.97694 22.1334 10.0524 21.7026 10.352C21.2749 10.6509 20.8826 11.1511 20.6455 11.7903C20.409 12.4299 20.3842 13.0557 20.5149 13.5469L20.571 13.7233C20.7169 14.1169 20.9659 14.3762 21.2692 14.4844C21.6196 14.6092 22.0507 14.5357 22.4826 14.2352C22.9101 13.9363 23.3027 13.4359 23.5397 12.7969C23.7475 12.2373 23.7919 11.6885 23.7118 11.2315L23.6703 11.0415C23.5382 10.547 23.2609 10.2249 22.9147 10.1016V10.1003ZM3.2961 10.352C2.86607 10.052 2.43527 9.97768 2.08398 10.1028C1.73716 10.2264 1.46139 10.5481 1.32961 11.0415H1.32839C1.19745 11.5306 1.22337 12.156 1.46022 12.7969L1.55665 13.03C1.79694 13.5585 2.1443 13.9753 2.51854 14.2364L2.67967 14.3376C3.05386 14.5501 3.42192 14.5937 3.73066 14.4844L3.85639 14.4289C4.14346 14.278 4.36964 13.9786 4.48504 13.5469V13.5457C4.61634 13.0552 4.5919 12.4297 4.35443 11.7903C4.11686 11.1508 3.72375 10.6492 3.2961 10.3508V10.352ZM6.74328 0.0900743C7.73261 -0.193113 8.67304 0.225792 9.35551 0.867212C10.045 1.51461 10.5776 2.46891 10.8508 3.55882C11.1252 4.64995 11.1062 5.75179 10.8179 6.66614L10.697 6.9992C10.3778 7.76706 9.81065 8.44789 8.95513 8.69286L8.76959 8.73727C7.84848 8.92217 6.98153 8.5159 6.34168 7.91449C5.65224 7.26714 5.11962 6.31393 4.84636 5.22412C4.60629 4.26954 4.59122 3.30659 4.7841 2.46836L4.87931 2.1168C5.14635 1.27397 5.69121 0.476331 6.56384 0.149285L6.74328 0.0900743ZM15.6444 0.868445C16.3269 0.227062 17.2673 -0.193197 18.2566 0.0900743C19.2344 0.369915 19.8357 1.21771 20.1206 2.1168C20.41 3.02992 20.4279 4.1331 20.1536 5.22412C19.8803 6.31392 19.3476 7.26713 18.6582 7.91449C18.0184 8.51588 17.1513 8.92202 16.2303 8.73727L16.0448 8.69286C15.1891 8.44696 14.6221 7.76687 14.3029 6.9992L14.1808 6.66614C13.9285 5.86616 13.8825 4.9226 14.0587 3.96836L14.1491 3.55882C14.3882 2.60517 14.8254 1.75545 15.3929 1.12502L15.6444 0.868445ZM8.5047 1.79238C8.01407 1.33119 7.50852 1.18357 7.08384 1.30512C6.65672 1.42734 6.28174 1.83092 6.06947 2.4992C5.88705 3.0776 5.84295 3.80848 5.98524 4.5802L6.05848 4.91203V4.91326C6.2826 5.80728 6.70742 6.53244 7.19248 6.98809L7.1937 6.98933C7.68521 7.45118 8.19088 7.59913 8.61456 7.47781C9.04161 7.35547 9.41539 6.94931 9.62772 6.28004C9.80951 5.70206 9.85399 4.97335 9.71194 4.20273L9.63992 3.86968C9.4437 3.08693 9.09332 2.43243 8.68414 1.97617L8.5047 1.79238ZM17.9161 1.30512C17.4923 1.18378 16.9868 1.3315 16.4952 1.79361L16.494 1.79484C16.0704 2.19182 15.6923 2.79696 15.454 3.54155L15.36 3.86968C15.1357 4.76141 15.1633 5.61948 15.371 6.28004C15.5829 6.94822 15.9576 7.35447 16.3866 7.47781H16.3853C16.8091 7.59915 17.3158 7.4502 17.8074 6.98809C18.2924 6.53243 18.7173 5.80717 18.9414 4.91326V4.91203C19.1662 4.01806 19.1389 3.15912 18.9304 2.50167C18.7183 1.83206 18.3437 1.42748 17.9161 1.30512Z" fill="#3B3731" />
                                </svg>
                                &nbsp;
                                &nbsp;
                                <p>Nail Trim</p>
                            </div>
                            <div class="service-list-right">
                                <div class="price">
                                    <p>From <span>£10</span></p>
                                </div>
                            </div>
                        </div>
                        <div class="services-list d-flex align-items-center justify-content-between mt-4">
                            <div class="service-list-left d-flex align-items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="20" viewBox="0 0 25 20" fill="none">
                                    <path d="M7.14286 10V5.88235H4.16667C3.62029 5.88235 3.18073 5.88222 2.82389 5.85823C2.46174 5.83384 2.14114 5.78236 1.83803 5.65832C1.47669 5.51051 1.14846 5.29396 0.871931 5.02068C0.595401 4.7474 0.376275 4.42303 0.226702 4.06595C0.101183 3.7664 0.0490882 3.44958 0.0244141 3.09168C0.000130046 2.73905 0 2.30466 0 1.76471V0.588235C0 0.263362 0.266497 0 0.595238 0C0.923979 0 1.19048 0.263362 1.19048 0.588235V1.76471C1.19048 2.32098 1.19048 2.70895 1.2114 3.01241C1.23195 3.31031 1.27118 3.48346 1.3265 3.61558V3.61673C1.41624 3.83076 1.54786 4.02506 1.71363 4.18888C1.87941 4.3527 2.07602 4.48278 2.2926 4.57146H2.29376C2.42745 4.62613 2.60266 4.6649 2.90411 4.6852C3.08925 4.69767 3.30559 4.70153 3.57143 4.70358V3.52941C3.57143 2.90537 3.82246 2.30707 4.26897 1.86581C4.71549 1.42455 5.32091 1.17647 5.95238 1.17647H16.0714C17.177 1.17647 18.0657 1.17576 18.7628 1.26838C19.4771 1.36335 20.0789 1.56601 20.5566 2.03814C21.0344 2.51027 21.2395 3.10493 21.3356 3.81089C21.3721 4.07919 21.3908 4.37633 21.4042 4.70358C21.6812 4.70165 21.9051 4.69805 22.0959 4.6852C22.3973 4.6649 22.5725 4.62613 22.7062 4.57146H22.7074C22.924 4.48278 23.1206 4.3527 23.2864 4.18888C23.4521 4.02506 23.5838 3.83076 23.6735 3.61673V3.61558C23.7288 3.48346 23.768 3.31031 23.7886 3.01241C23.8095 2.70895 23.8095 2.32098 23.8095 1.76471V0.588235C23.8095 0.263362 24.076 0 24.4048 0C24.7335 0 25 0.263362 25 0.588235V1.76471C25 2.30466 24.9999 2.73905 24.9756 3.09168C24.9509 3.44958 24.8988 3.7664 24.7733 4.06595C24.6237 4.42303 24.4046 4.7474 24.1281 5.02068C23.8515 5.29396 23.5233 5.51051 23.162 5.65832C22.8589 5.78236 22.5383 5.83384 22.1761 5.85823C21.959 5.87283 21.7112 5.87791 21.4274 5.88006C21.4279 6.06952 21.4286 6.26631 21.4286 6.47059V10C21.4286 11.0925 21.4293 11.9708 21.3356 12.6597C21.2395 13.3657 21.0344 13.9603 20.5566 14.4324C20.1434 14.8408 19.6377 15.0474 19.0465 15.1574C19.0451 16.0435 19.0351 16.7743 18.9546 17.3656C18.8585 18.0715 18.6534 18.6662 18.1757 19.1383C17.6979 19.6105 17.0962 19.8131 16.3818 19.9081C15.6848 20.0007 14.796 20 13.6905 20H8.92857C7.82302 20 6.93427 20.0007 6.23721 19.9081C5.52285 19.8131 4.92111 19.6105 4.44336 19.1383C3.96561 18.6662 3.76054 18.0715 3.66443 17.3656C3.57071 16.6767 3.57143 15.7984 3.57143 14.7059V8.82353C3.57143 8.49866 3.83793 8.23529 4.16667 8.23529C4.49541 8.23529 4.7619 8.49866 4.7619 8.82353V14.7059C4.7619 15.8319 4.76266 16.6171 4.84329 17.2093C4.92159 17.7845 5.0652 18.0893 5.28506 18.3065C5.50493 18.5238 5.81328 18.6657 6.39532 18.7431C6.99462 18.8228 7.78911 18.8235 8.92857 18.8235H13.6905C14.8299 18.8235 15.6244 18.8228 16.2237 18.7431C16.8058 18.6657 17.1141 18.5238 17.334 18.3065C17.5538 18.0893 17.6975 17.7845 17.7758 17.2093C17.8422 16.7214 17.8501 16.1025 17.8525 15.27C17.3351 15.2904 16.7434 15.2941 16.0714 15.2941H12.5C11.3945 15.2941 10.5057 15.2948 9.80864 15.2022C9.09428 15.1072 8.49254 14.9046 8.01479 14.4324C7.53704 13.9603 7.33196 13.3657 7.23586 12.6597C7.14214 11.9708 7.14286 11.0925 7.14286 10ZM4.7619 4.70588H7.14286V3.52941C7.14286 3.21739 7.01734 2.91824 6.79408 2.69761C6.57083 2.47698 6.26812 2.35294 5.95238 2.35294C5.63665 2.35294 5.33393 2.47698 5.11068 2.69761C4.88742 2.91824 4.7619 3.21739 4.7619 3.52941V4.70588ZM8.33333 10C8.33333 11.1261 8.33409 11.9112 8.41471 12.5034C8.49302 13.0786 8.63663 13.3834 8.85649 13.6006C9.07635 13.8179 9.38471 13.9598 9.96675 14.0372C10.5661 14.1169 11.3605 14.1176 12.5 14.1176H16.0714C17.2109 14.1176 18.0054 14.1169 18.6047 14.0372C19.1867 13.9598 19.4951 13.8179 19.7149 13.6006C19.9348 13.3834 20.0784 13.0786 20.1567 12.5034C20.2373 11.9112 20.2381 11.1261 20.2381 10V6.47059C20.2381 5.34453 20.2373 4.55939 20.1567 3.96714C20.0784 3.39195 19.9348 3.08722 19.7149 2.86995C19.4951 2.65267 19.1867 2.51075 18.6047 2.43336C18.0054 2.35369 17.2109 2.35294 16.0714 2.35294H8.0113C8.21897 2.7079 8.33333 3.11229 8.33333 3.52941V10Z" fill="#3B3731" />
                                </svg>
                                &nbsp;
                                &nbsp;
                                <p>Pet Spa</p>
                            </div>
                            <div class="service-list-right">
                                <div class="price">
                                    <p>From <span>£50</span></p>
                                </div>
                            </div>
                        </div>
                        <div class="services-list d-flex align-items-center justify-content-between mt-4">
                            <div class="service-list-left d-flex align-items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="16" viewBox="0 0 25 16" fill="none">
                                    <path d="M24.8464 5.66628L20.0212 0.487716C19.8818 0.334782 19.7077 0.211853 19.5111 0.127587C19.3145 0.0433216 19.1003 -0.00022993 18.8835 9.12899e-07H1.48305C1.08972 9.12899e-07 0.712502 0.143877 0.434376 0.399977C0.15625 0.656077 0 1.00342 0 1.3656V12.2904C0 12.6526 0.15625 13 0.434376 13.2561C0.712502 13.5122 1.08972 13.656 1.48305 13.656H3.45339C3.59927 14.3175 3.98902 14.9123 4.55661 15.3395C5.12421 15.7666 5.83473 16 6.5678 16C7.30086 16 8.01138 15.7666 8.57898 15.3395C9.14657 14.9123 9.53632 14.3175 9.6822 13.656H15.3178C15.4637 14.3175 15.8534 14.9123 16.421 15.3395C16.9886 15.7666 17.6991 16 18.4322 16C19.1653 16 19.8758 15.7666 20.4434 15.3395C21.011 14.9123 21.4007 14.3175 21.5466 13.656H23.5169C23.9103 13.656 24.2875 13.5122 24.5656 13.2561C24.8437 13 25 12.6526 25 12.2904V6.04767C25 5.90772 24.9455 5.77241 24.8464 5.66628ZM19.0519 1.24563L22.9809 5.46241H16.5254V1.17052H18.8835C18.9159 1.17033 18.948 1.177 18.9772 1.19002C19.0064 1.20304 19.032 1.22207 19.0519 1.24563ZM8.8983 5.46241V1.17052H15.2542V5.46241H8.8983ZM1.48305 1.17052H7.62712V5.46241H1.27119V1.3656C1.27119 1.31386 1.29351 1.26424 1.33324 1.22766C1.37297 1.19107 1.42686 1.17052 1.48305 1.17052ZM6.5678 14.8266C6.19067 14.8266 5.82201 14.7236 5.50845 14.5306C5.19488 14.3377 4.95048 14.0635 4.80616 13.7427C4.66184 13.4219 4.62408 13.0688 4.69765 12.7282C4.77123 12.3877 4.95283 12.0748 5.2195 11.8293C5.48617 11.5837 5.82592 11.4165 6.1958 11.3487C6.56568 11.281 6.94907 11.3158 7.29749 11.4486C7.64591 11.5815 7.94371 11.8066 8.15323 12.0953C8.36275 12.3841 8.47458 12.7235 8.47458 13.0708C8.47458 13.5364 8.27368 13.983 7.91609 14.3123C7.5585 14.6416 7.07351 14.8266 6.5678 14.8266ZM18.4322 14.8266C18.0551 14.8266 17.6864 14.7236 17.3729 14.5306C17.0593 14.3377 16.8149 14.0635 16.6706 13.7427C16.5262 13.4219 16.4885 13.0688 16.5621 12.7282C16.6356 12.3877 16.8172 12.0748 17.0839 11.8293C17.3506 11.5837 17.6903 11.4165 18.0602 11.3487C18.4301 11.281 18.8135 11.3158 19.1619 11.4486C19.5103 11.5815 19.8081 11.8066 20.0176 12.0953C20.2271 12.3841 20.339 12.7235 20.339 13.0708C20.339 13.5364 20.1381 13.983 19.7805 14.3123C19.4229 14.6416 18.9379 14.8266 18.4322 14.8266ZM23.5169 12.4855H21.5466C21.4007 11.824 21.011 11.2293 20.4434 10.8021C19.8758 10.3749 19.1653 10.1415 18.4322 10.1415C17.6991 10.1415 16.9886 10.3749 16.421 10.8021C15.8534 11.2293 15.4637 11.824 15.3178 12.4855H9.6822C9.53632 11.824 9.14657 11.2293 8.57898 10.8021C8.01138 10.3749 7.30086 10.1415 6.5678 10.1415C5.83473 10.1415 5.12421 10.3749 4.55661 10.8021C3.98902 11.2293 3.59927 11.824 3.45339 12.4855H1.48305C1.42686 12.4855 1.37297 12.465 1.33324 12.4284C1.29351 12.3918 1.27119 12.3422 1.27119 12.2904V6.63293H23.7288V12.2904C23.7288 12.3422 23.7065 12.3918 23.6668 12.4284C23.627 12.465 23.5731 12.4855 23.5169 12.4855Z" fill="#3B3731" />
                                </svg>
                                &nbsp;
                                &nbsp;
                                <p>Mobile Grooming</p>
                            </div>
                            <div class="service-list-right">
                                <div class="price">
                                    <p>From <span>£10</span></p>
                                </div>
                            </div>
                        </div>

                        <h2 class="section-content-heading mt-5">Add-on Services</h2>

                        <div class="add-on-services d-flex align-items-center mt-4 flex-wrap">
                            <div class="selected-item">
                                Flea & Tick Treatment
                            </div>
                            <div class="selected-item">
                                Hypoallergenic Shampoo
                            </div>
                            <div class="selected-item">
                                Deep Conditioning Mask
                            </div>
                            <div class="selected-item">
                                Shed-Control Shampoo
                            </div>
                            <div class="selected-item">
                                Tear-Stain Treatment
                            </div>
                            <div class="selected-item">
                                Deodorising Treatment
                            </div>
                            <div class="selected-item">
                                Coat Shine Spray
                            </div>
                            <div class="selected-item">
                                Anti-itch Treatment
                            </div>
                            <div class="selected-item">
                                Breath Freshener Gel
                            </div>
                            <div class="selected-item">
                                Nail Grinding
                            </div>
                            <div class="selected-item">
                                Paw Fur Shaping
                            </div>
                            <div class="selected-item">
                                Coat Colour Enhancing Shampoo
                            </div>
                            <div class="selected-item">
                                Premium Fragrance Upgrade
                            </div>
                            <div class="selected-item">
                                Fast-Dry Service
                            </div>
                            <div class="selected-item">
                                Soft-Claws / Nail Caps Application
                            </div>
                        </div>

                    </div>

                    <div id="preference_and_restrictions" class="mt-5 section-offset">
                        <h2 class="section-content-heading mt-5">Preferences & Restrictions</h2>

                        <div class="preferences-list d-flex align-items-center mt-4">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                <path d="M10 0C4.47719 0 0 4.47719 0 10C0 15.5231 4.47719 20 10 20C15.5231 20 20 15.5231 20 10C20 4.47719 15.5231 0 10 0ZM10 18.7697C5.17531 18.7697 1.25 14.8247 1.25 9.99996C1.25 5.17527 5.17531 1.24996 10 1.24996C14.8247 1.24996 18.75 5.17529 18.75 9.99996C18.75 14.8246 14.8247 18.7697 10 18.7697Z" fill="#3B3731" />
                                <path d="M5.5 10.5L8.5 13.5L14.5 7.5" stroke="#3B3731" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            &nbsp;
                            &nbsp;
                            <p>Works with dogs & cats up to 35kg</p>
                        </div>
                        <div class="preferences-list d-flex align-items-center mt-4">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                <path d="M10 0C4.47719 0 0 4.47719 0 10C0 15.5231 4.47719 20 10 20C15.5231 20 20 15.5231 20 10C20 4.47719 15.5231 0 10 0ZM10 18.7697C5.17531 18.7697 1.25 14.8247 1.25 9.99996C1.25 5.17527 5.17531 1.24996 10 1.24996C14.8247 1.24996 18.75 5.17529 18.75 9.99996C18.75 14.8246 14.8247 18.7697 10 18.7697Z" fill="#3B3731" />
                                <path d="M5.5 10.5L8.5 13.5L14.5 7.5" stroke="#3B3731" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            &nbsp;
                            &nbsp;
                            <p>Special care for seniors & anxious pets</p>
                        </div>
                        <div class="preferences-list d-flex align-items-center mt-4">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                <path d="M6.11099 13.8891C6.01726 13.7953 5.9646 13.6681 5.9646 13.5356C5.9646 13.403 6.01726 13.2758 6.11099 13.1821L9.29299 10.0001L6.11099 6.81806C6.01991 6.72376 5.96952 6.59746 5.97066 6.46636C5.9718 6.33526 6.02438 6.20985 6.11708 6.11715C6.20979 6.02445 6.33519 5.97186 6.46629 5.97072C6.59739 5.96958 6.72369 6.01998 6.81799 6.11106L9.99999 9.29306L13.182 6.11106C13.2763 6.01998 13.4026 5.96958 13.5337 5.97072C13.6648 5.97186 13.7902 6.02445 13.8829 6.11715C13.9756 6.20985 14.0282 6.33526 14.0293 6.46636C14.0305 6.59746 13.9801 6.72376 13.889 6.81806L10.707 10.0001L13.889 13.1821C13.9801 13.2764 14.0305 13.4027 14.0293 13.5338C14.0282 13.6649 13.9756 13.7903 13.8829 13.883C13.7902 13.9757 13.6648 14.0283 13.5337 14.0294C13.4026 14.0305 13.2763 13.9801 13.182 13.8891L9.99999 10.7071L6.81799 13.8891C6.72423 13.9828 6.59708 14.0355 6.46449 14.0355C6.33191 14.0355 6.20476 13.9828 6.11099 13.8891Z" fill="#3B3731" />
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M10 20C15.523 20 20 15.523 20 10C20 4.477 15.523 0 10 0C4.477 0 0 4.477 0 10C0 15.523 4.477 20 10 20ZM10 19C14.9705 19 19 14.9705 19 10C19 5.0295 14.9705 1 10 1C5.0295 1 1 5.0295 1 10C1 14.9705 5.0295 19 10 19Z" fill="#3B3731" />
                            </svg>
                            &nbsp;
                            &nbsp;
                            <p>Not suitable for aggressive pets</p>
                        </div>
                    </div>

                    <div id="reviews" class="mt-5 section-offset">
                        <h2 class="section-content-heading d-flex align-items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="26" height="25" viewBox="0 0 26 25" fill="none">
                                <path d="M10.7229 1.39752C11.3115 -0.465884 13.9485 -0.465882 14.5371 1.39753L16.1175 6.40049C16.3803 7.23246 17.1521 7.79805 18.0246 7.79805H23.2562C25.1799 7.79805 25.9944 10.2485 24.4534 11.4001L20.125 14.6348C19.4436 15.1439 19.1589 16.0282 19.4151 16.8393L21.0454 22.0002C21.6306 23.8527 19.4973 25.3677 17.941 24.2047L13.8272 21.1304C13.1173 20.5999 12.1428 20.5999 11.4328 21.1304L7.31899 24.2047C5.76272 25.3677 3.62943 23.8527 4.21465 22.0002L5.84494 16.8393C6.10114 16.0282 5.81637 15.1439 5.13506 14.6348L0.80663 11.4001C-0.734386 10.2485 0.080081 7.79805 2.00386 7.79805H7.23538C8.10787 7.79805 8.87968 7.23246 9.14249 6.40049L10.7229 1.39752Z" fill="#3B3731" />
                            </svg>
                            &nbsp;
                            4.9/6 Based on 120 verified reviews.
                        </h2>

                        <div class="reviews d-flex align-items-center flex-wrap">
                            <div class="review-card">
                                <div class="review-header">
                                    <div class="avatar" style="background: #FFC97A;"></div>
                                    <div class="reviewer-info">
                                        <span class="reviewer-name">Jane R.</span>
                                        <span class="review-date">1 Day ago</span>
                                    </div>
                                </div>

                                <p class="review-text">
                                    Such a lovely experience! He came back looking fluffy and smelling amazing.
                                </p>

                                <div class="stars">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="110" height="17" viewBox="0 0 110 17" fill="none">
                                        <path d="M7.58757 0.802006C7.92672 -0.267338 9.40341 -0.267334 9.74256 0.80201L11.0114 4.80273C11.1631 5.28095 11.5981 5.60473 12.0889 5.60473H16.195C17.2925 5.60473 17.7488 7.04353 16.8609 7.70442L13.539 10.177C13.1419 10.4726 12.9758 10.9964 13.1275 11.4747L14.3963 15.4754C14.7355 16.5447 13.5408 17.434 12.6529 16.7731L9.33099 14.3005C8.93391 14.0049 8.39622 14.0049 7.99913 14.3005L4.67723 16.7731C3.78932 17.434 2.59466 16.5447 2.93381 15.4754L4.20266 11.4747C4.35433 10.9964 4.18818 10.4726 3.79109 10.177L0.469188 7.70442C-0.418717 7.04353 0.0376084 5.60473 1.13512 5.60473H5.24122C5.73204 5.60473 6.16704 5.28095 6.31871 4.80273L7.58757 0.802006Z" fill="#FFC97A" />
                                        <path d="M53.9225 0.802006C54.2617 -0.267338 55.7384 -0.267334 56.0775 0.80201L57.3464 4.80273C57.498 5.28095 57.933 5.60473 58.4239 5.60473H62.53C63.6275 5.60473 64.0838 7.04353 63.1959 7.70442L59.874 10.177C59.4769 10.4726 59.3107 10.9964 59.4624 11.4747L60.7313 15.4754C61.0704 16.5447 59.8758 17.434 58.9879 16.7731L55.666 14.3005C55.2689 14.0049 54.7312 14.0049 54.3341 14.3005L51.0122 16.7731C50.1243 17.434 48.9296 16.5447 49.2688 15.4754L50.5376 11.4747C50.6893 10.9964 50.5231 10.4726 50.1261 10.177L46.8041 7.70442C45.9162 7.04353 46.3726 5.60473 47.4701 5.60473H51.5762C52.067 5.60473 52.502 5.28095 52.6537 4.80273L53.9225 0.802006Z" fill="#FFC97A" />
                                        <path d="M30.755 0.802006C31.0942 -0.267338 32.5709 -0.267334 32.91 0.80201L34.1789 4.80273C34.3306 5.28095 34.7656 5.60473 35.2564 5.60473H39.3625C40.46 5.60473 40.9163 7.04353 40.0284 7.70442L36.7065 10.177C36.3094 10.4726 36.1433 10.9964 36.2949 11.4747L37.5638 15.4754C37.9029 16.5447 36.7083 17.434 35.8204 16.7731L32.4985 14.3005C32.1014 14.0049 31.5637 14.0049 31.1666 14.3005L27.8447 16.7731C26.9568 17.434 25.7621 16.5447 26.1013 15.4754L27.3701 11.4747C27.5218 10.9964 27.3557 10.4726 26.9586 10.177L23.6367 7.70442C22.7488 7.04353 23.2051 5.60473 24.3026 5.60473H28.4087C28.8995 5.60473 29.3345 5.28095 29.4862 4.80273L30.755 0.802006Z" fill="#FFC97A" />
                                        <path d="M77.09 0.802006C77.4291 -0.267338 78.9058 -0.267334 79.245 0.80201L80.5138 4.80273C80.6655 5.28095 81.1005 5.60473 81.5913 5.60473H85.6974C86.7949 5.60473 87.2512 7.04353 86.3633 7.70442L83.0414 10.177C82.6444 10.4726 82.4782 10.9964 82.6299 11.4747L83.8987 15.4754C84.2379 16.5447 83.0432 17.434 82.1553 16.7731L78.8334 14.3005C78.4363 14.0049 77.8986 14.0049 77.5015 14.3005L74.1796 16.7731C73.2917 17.434 72.0971 16.5447 72.4362 15.4754L73.7051 11.4747C73.8567 10.9964 73.6906 10.4726 73.2935 10.177L69.9716 7.70442C69.0837 7.04353 69.54 5.60473 70.6375 5.60473H74.7436C75.2344 5.60473 75.6694 5.28095 75.8211 4.80273L77.09 0.802006Z" fill="#FFC97A" />
                                        <path d="M100.257 0.802006C100.597 -0.267338 102.073 -0.267334 102.412 0.80201L103.681 4.80273C103.833 5.28095 104.268 5.60473 104.759 5.60473H108.865C109.962 5.60473 110.419 7.04353 109.531 7.70442L106.209 10.177C105.812 10.4726 105.646 10.9964 105.797 11.4747L107.066 15.4754C107.405 16.5447 106.211 17.434 105.323 16.7731L102.001 14.3005C101.604 14.0049 101.066 14.0049 100.669 14.3005L97.3471 16.7731C96.4592 17.434 95.2645 16.5447 95.6037 15.4754L96.8726 11.4747C97.0242 10.9964 96.8581 10.4726 96.461 10.177L93.1391 7.70442C92.2512 7.04353 92.7075 5.60473 93.805 5.60473H97.9111C98.4019 5.60473 98.8369 5.28095 98.9886 4.80273L100.257 0.802006Z" fill="#FFC97A" />
                                    </svg>
                                </div>
                            </div>
                            <div class="review-card">
                                <div class="review-header">
                                    <div class="avatar" style="background: #FFA899;"></div>
                                    <div class="reviewer-info">
                                        <span class="reviewer-name">Sunny T.</span>
                                        <span class="review-date">2 week ago</span>
                                    </div>
                                </div>

                                <p class="review-text">
                                    Hands down the best groomer we’ve tried. The studio is spotless and she really listens ...
                                </p>

                                <div class="stars">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="110" height="17" viewBox="0 0 110 17" fill="none">
                                        <path d="M7.58757 0.802006C7.92672 -0.267338 9.40341 -0.267334 9.74256 0.80201L11.0114 4.80273C11.1631 5.28095 11.5981 5.60473 12.0889 5.60473H16.195C17.2925 5.60473 17.7488 7.04353 16.8609 7.70442L13.539 10.177C13.1419 10.4726 12.9758 10.9964 13.1275 11.4747L14.3963 15.4754C14.7355 16.5447 13.5408 17.434 12.6529 16.7731L9.33099 14.3005C8.93391 14.0049 8.39622 14.0049 7.99913 14.3005L4.67723 16.7731C3.78932 17.434 2.59466 16.5447 2.93381 15.4754L4.20266 11.4747C4.35433 10.9964 4.18818 10.4726 3.79109 10.177L0.469188 7.70442C-0.418717 7.04353 0.0376084 5.60473 1.13512 5.60473H5.24122C5.73204 5.60473 6.16704 5.28095 6.31871 4.80273L7.58757 0.802006Z" fill="#FFC97A" />
                                        <path d="M53.9225 0.802006C54.2617 -0.267338 55.7384 -0.267334 56.0775 0.80201L57.3464 4.80273C57.498 5.28095 57.933 5.60473 58.4239 5.60473H62.53C63.6275 5.60473 64.0838 7.04353 63.1959 7.70442L59.874 10.177C59.4769 10.4726 59.3107 10.9964 59.4624 11.4747L60.7313 15.4754C61.0704 16.5447 59.8758 17.434 58.9879 16.7731L55.666 14.3005C55.2689 14.0049 54.7312 14.0049 54.3341 14.3005L51.0122 16.7731C50.1243 17.434 48.9296 16.5447 49.2688 15.4754L50.5376 11.4747C50.6893 10.9964 50.5231 10.4726 50.1261 10.177L46.8041 7.70442C45.9162 7.04353 46.3726 5.60473 47.4701 5.60473H51.5762C52.067 5.60473 52.502 5.28095 52.6537 4.80273L53.9225 0.802006Z" fill="#FFC97A" />
                                        <path d="M30.755 0.802006C31.0942 -0.267338 32.5709 -0.267334 32.91 0.80201L34.1789 4.80273C34.3306 5.28095 34.7656 5.60473 35.2564 5.60473H39.3625C40.46 5.60473 40.9163 7.04353 40.0284 7.70442L36.7065 10.177C36.3094 10.4726 36.1433 10.9964 36.2949 11.4747L37.5638 15.4754C37.9029 16.5447 36.7083 17.434 35.8204 16.7731L32.4985 14.3005C32.1014 14.0049 31.5637 14.0049 31.1666 14.3005L27.8447 16.7731C26.9568 17.434 25.7621 16.5447 26.1013 15.4754L27.3701 11.4747C27.5218 10.9964 27.3557 10.4726 26.9586 10.177L23.6367 7.70442C22.7488 7.04353 23.2051 5.60473 24.3026 5.60473H28.4087C28.8995 5.60473 29.3345 5.28095 29.4862 4.80273L30.755 0.802006Z" fill="#FFC97A" />
                                        <path d="M77.09 0.802006C77.4291 -0.267338 78.9058 -0.267334 79.245 0.80201L80.5138 4.80273C80.6655 5.28095 81.1005 5.60473 81.5913 5.60473H85.6974C86.7949 5.60473 87.2512 7.04353 86.3633 7.70442L83.0414 10.177C82.6444 10.4726 82.4782 10.9964 82.6299 11.4747L83.8987 15.4754C84.2379 16.5447 83.0432 17.434 82.1553 16.7731L78.8334 14.3005C78.4363 14.0049 77.8986 14.0049 77.5015 14.3005L74.1796 16.7731C73.2917 17.434 72.0971 16.5447 72.4362 15.4754L73.7051 11.4747C73.8567 10.9964 73.6906 10.4726 73.2935 10.177L69.9716 7.70442C69.0837 7.04353 69.54 5.60473 70.6375 5.60473H74.7436C75.2344 5.60473 75.6694 5.28095 75.8211 4.80273L77.09 0.802006Z" fill="#FFC97A" />
                                        <path d="M100.257 0.802006C100.597 -0.267338 102.073 -0.267334 102.412 0.80201L103.681 4.80273C103.833 5.28095 104.268 5.60473 104.759 5.60473H108.865C109.962 5.60473 110.419 7.04353 109.531 7.70442L106.209 10.177C105.812 10.4726 105.646 10.9964 105.797 11.4747L107.066 15.4754C107.405 16.5447 106.211 17.434 105.323 16.7731L102.001 14.3005C101.604 14.0049 101.066 14.0049 100.669 14.3005L97.3471 16.7731C96.4592 17.434 95.2645 16.5447 95.6037 15.4754L96.8726 11.4747C97.0242 10.9964 96.8581 10.4726 96.461 10.177L93.1391 7.70442C92.2512 7.04353 92.7075 5.60473 93.805 5.60473H97.9111C98.4019 5.60473 98.8369 5.28095 98.9886 4.80273L100.257 0.802006Z" fill="#FFC97A" />
                                    </svg>
                                </div>
                            </div>
                            <div class="review-card">
                                <div class="review-header">
                                    <div class="avatar" style="background: #CBDCE8;"></div>
                                    <div class="reviewer-info">
                                        <span class="reviewer-name">Raj K.</span>
                                        <span class="review-date">3 months ago</span>
                                    </div>
                                </div>

                                <p class="review-text">
                                    Thanks for looking after our Nina again. She very clearly had a great time!
                                </p>

                                <div class="stars">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="110" height="17" viewBox="0 0 110 17" fill="none">
                                        <path d="M7.58757 0.802006C7.92672 -0.267338 9.40341 -0.267334 9.74256 0.80201L11.0114 4.80273C11.1631 5.28095 11.5981 5.60473 12.0889 5.60473H16.195C17.2925 5.60473 17.7488 7.04353 16.8609 7.70442L13.539 10.177C13.1419 10.4726 12.9758 10.9964 13.1275 11.4747L14.3963 15.4754C14.7355 16.5447 13.5408 17.434 12.6529 16.7731L9.33099 14.3005C8.93391 14.0049 8.39622 14.0049 7.99913 14.3005L4.67723 16.7731C3.78932 17.434 2.59466 16.5447 2.93381 15.4754L4.20266 11.4747C4.35433 10.9964 4.18818 10.4726 3.79109 10.177L0.469188 7.70442C-0.418717 7.04353 0.0376084 5.60473 1.13512 5.60473H5.24122C5.73204 5.60473 6.16704 5.28095 6.31871 4.80273L7.58757 0.802006Z" fill="#FFC97A" />
                                        <path d="M53.9225 0.802006C54.2617 -0.267338 55.7384 -0.267334 56.0775 0.80201L57.3464 4.80273C57.498 5.28095 57.933 5.60473 58.4239 5.60473H62.53C63.6275 5.60473 64.0838 7.04353 63.1959 7.70442L59.874 10.177C59.4769 10.4726 59.3107 10.9964 59.4624 11.4747L60.7313 15.4754C61.0704 16.5447 59.8758 17.434 58.9879 16.7731L55.666 14.3005C55.2689 14.0049 54.7312 14.0049 54.3341 14.3005L51.0122 16.7731C50.1243 17.434 48.9296 16.5447 49.2688 15.4754L50.5376 11.4747C50.6893 10.9964 50.5231 10.4726 50.1261 10.177L46.8041 7.70442C45.9162 7.04353 46.3726 5.60473 47.4701 5.60473H51.5762C52.067 5.60473 52.502 5.28095 52.6537 4.80273L53.9225 0.802006Z" fill="#FFC97A" />
                                        <path d="M30.755 0.802006C31.0942 -0.267338 32.5709 -0.267334 32.91 0.80201L34.1789 4.80273C34.3306 5.28095 34.7656 5.60473 35.2564 5.60473H39.3625C40.46 5.60473 40.9163 7.04353 40.0284 7.70442L36.7065 10.177C36.3094 10.4726 36.1433 10.9964 36.2949 11.4747L37.5638 15.4754C37.9029 16.5447 36.7083 17.434 35.8204 16.7731L32.4985 14.3005C32.1014 14.0049 31.5637 14.0049 31.1666 14.3005L27.8447 16.7731C26.9568 17.434 25.7621 16.5447 26.1013 15.4754L27.3701 11.4747C27.5218 10.9964 27.3557 10.4726 26.9586 10.177L23.6367 7.70442C22.7488 7.04353 23.2051 5.60473 24.3026 5.60473H28.4087C28.8995 5.60473 29.3345 5.28095 29.4862 4.80273L30.755 0.802006Z" fill="#FFC97A" />
                                        <path d="M77.09 0.802006C77.4291 -0.267338 78.9058 -0.267334 79.245 0.80201L80.5138 4.80273C80.6655 5.28095 81.1005 5.60473 81.5913 5.60473H85.6974C86.7949 5.60473 87.2512 7.04353 86.3633 7.70442L83.0414 10.177C82.6444 10.4726 82.4782 10.9964 82.6299 11.4747L83.8987 15.4754C84.2379 16.5447 83.0432 17.434 82.1553 16.7731L78.8334 14.3005C78.4363 14.0049 77.8986 14.0049 77.5015 14.3005L74.1796 16.7731C73.2917 17.434 72.0971 16.5447 72.4362 15.4754L73.7051 11.4747C73.8567 10.9964 73.6906 10.4726 73.2935 10.177L69.9716 7.70442C69.0837 7.04353 69.54 5.60473 70.6375 5.60473H74.7436C75.2344 5.60473 75.6694 5.28095 75.8211 4.80273L77.09 0.802006Z" fill="#FFC97A" />
                                        <path d="M100.257 0.802006C100.597 -0.267338 102.073 -0.267334 102.412 0.80201L103.681 4.80273C103.833 5.28095 104.268 5.60473 104.759 5.60473H108.865C109.962 5.60473 110.419 7.04353 109.531 7.70442L106.209 10.177C105.812 10.4726 105.646 10.9964 105.797 11.4747L107.066 15.4754C107.405 16.5447 106.211 17.434 105.323 16.7731L102.001 14.3005C101.604 14.0049 101.066 14.0049 100.669 14.3005L97.3471 16.7731C96.4592 17.434 95.2645 16.5447 95.6037 15.4754L96.8726 11.4747C97.0242 10.9964 96.8581 10.4726 96.461 10.177L93.1391 7.70442C92.2512 7.04353 92.7075 5.60473 93.805 5.60473H97.9111C98.4019 5.60473 98.8369 5.28095 98.9886 4.80273L100.257 0.802006Z" fill="#FFC97A" />
                                    </svg>
                                </div>
                            </div>
                            <div class="review-card">
                                <div class="review-header">
                                    <div class="avatar" style="background: #CBDCE8;"></div>
                                    <div class="reviewer-info">
                                        <span class="reviewer-name">Raj K.</span>
                                        <span class="review-date">3 months ago</span>
                                    </div>
                                </div>

                                <p class="review-text">
                                    Thanks for looking after our Nina again. She very clearly had a great time!
                                </p>

                                <div class="stars">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="110" height="17" viewBox="0 0 110 17" fill="none">
                                        <path d="M7.58757 0.802006C7.92672 -0.267338 9.40341 -0.267334 9.74256 0.80201L11.0114 4.80273C11.1631 5.28095 11.5981 5.60473 12.0889 5.60473H16.195C17.2925 5.60473 17.7488 7.04353 16.8609 7.70442L13.539 10.177C13.1419 10.4726 12.9758 10.9964 13.1275 11.4747L14.3963 15.4754C14.7355 16.5447 13.5408 17.434 12.6529 16.7731L9.33099 14.3005C8.93391 14.0049 8.39622 14.0049 7.99913 14.3005L4.67723 16.7731C3.78932 17.434 2.59466 16.5447 2.93381 15.4754L4.20266 11.4747C4.35433 10.9964 4.18818 10.4726 3.79109 10.177L0.469188 7.70442C-0.418717 7.04353 0.0376084 5.60473 1.13512 5.60473H5.24122C5.73204 5.60473 6.16704 5.28095 6.31871 4.80273L7.58757 0.802006Z" fill="#FFC97A" />
                                        <path d="M53.9225 0.802006C54.2617 -0.267338 55.7384 -0.267334 56.0775 0.80201L57.3464 4.80273C57.498 5.28095 57.933 5.60473 58.4239 5.60473H62.53C63.6275 5.60473 64.0838 7.04353 63.1959 7.70442L59.874 10.177C59.4769 10.4726 59.3107 10.9964 59.4624 11.4747L60.7313 15.4754C61.0704 16.5447 59.8758 17.434 58.9879 16.7731L55.666 14.3005C55.2689 14.0049 54.7312 14.0049 54.3341 14.3005L51.0122 16.7731C50.1243 17.434 48.9296 16.5447 49.2688 15.4754L50.5376 11.4747C50.6893 10.9964 50.5231 10.4726 50.1261 10.177L46.8041 7.70442C45.9162 7.04353 46.3726 5.60473 47.4701 5.60473H51.5762C52.067 5.60473 52.502 5.28095 52.6537 4.80273L53.9225 0.802006Z" fill="#FFC97A" />
                                        <path d="M30.755 0.802006C31.0942 -0.267338 32.5709 -0.267334 32.91 0.80201L34.1789 4.80273C34.3306 5.28095 34.7656 5.60473 35.2564 5.60473H39.3625C40.46 5.60473 40.9163 7.04353 40.0284 7.70442L36.7065 10.177C36.3094 10.4726 36.1433 10.9964 36.2949 11.4747L37.5638 15.4754C37.9029 16.5447 36.7083 17.434 35.8204 16.7731L32.4985 14.3005C32.1014 14.0049 31.5637 14.0049 31.1666 14.3005L27.8447 16.7731C26.9568 17.434 25.7621 16.5447 26.1013 15.4754L27.3701 11.4747C27.5218 10.9964 27.3557 10.4726 26.9586 10.177L23.6367 7.70442C22.7488 7.04353 23.2051 5.60473 24.3026 5.60473H28.4087C28.8995 5.60473 29.3345 5.28095 29.4862 4.80273L30.755 0.802006Z" fill="#FFC97A" />
                                        <path d="M77.09 0.802006C77.4291 -0.267338 78.9058 -0.267334 79.245 0.80201L80.5138 4.80273C80.6655 5.28095 81.1005 5.60473 81.5913 5.60473H85.6974C86.7949 5.60473 87.2512 7.04353 86.3633 7.70442L83.0414 10.177C82.6444 10.4726 82.4782 10.9964 82.6299 11.4747L83.8987 15.4754C84.2379 16.5447 83.0432 17.434 82.1553 16.7731L78.8334 14.3005C78.4363 14.0049 77.8986 14.0049 77.5015 14.3005L74.1796 16.7731C73.2917 17.434 72.0971 16.5447 72.4362 15.4754L73.7051 11.4747C73.8567 10.9964 73.6906 10.4726 73.2935 10.177L69.9716 7.70442C69.0837 7.04353 69.54 5.60473 70.6375 5.60473H74.7436C75.2344 5.60473 75.6694 5.28095 75.8211 4.80273L77.09 0.802006Z" fill="#FFC97A" />
                                        <path d="M100.257 0.802006C100.597 -0.267338 102.073 -0.267334 102.412 0.80201L103.681 4.80273C103.833 5.28095 104.268 5.60473 104.759 5.60473H108.865C109.962 5.60473 110.419 7.04353 109.531 7.70442L106.209 10.177C105.812 10.4726 105.646 10.9964 105.797 11.4747L107.066 15.4754C107.405 16.5447 106.211 17.434 105.323 16.7731L102.001 14.3005C101.604 14.0049 101.066 14.0049 100.669 14.3005L97.3471 16.7731C96.4592 17.434 95.2645 16.5447 95.6037 15.4754L96.8726 11.4747C97.0242 10.9964 96.8581 10.4726 96.461 10.177L93.1391 7.70442C92.2512 7.04353 92.7075 5.60473 93.805 5.60473H97.9111C98.4019 5.60473 98.8369 5.28095 98.9886 4.80273L100.257 0.802006Z" fill="#FFC97A" />
                                    </svg>
                                </div>
                            </div>
                            <div class="review-card">
                                <div class="review-header">
                                    <div class="avatar" style="background: #FFC97A;"></div>
                                    <div class="reviewer-info">
                                        <span class="reviewer-name">Jane R.</span>
                                        <span class="review-date">1 Day ago</span>
                                    </div>
                                </div>

                                <p class="review-text">
                                    Such a lovely experience! He came back looking fluffy and smelling amazing.
                                </p>

                                <div class="stars">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="110" height="17" viewBox="0 0 110 17" fill="none">
                                        <path d="M7.58757 0.802006C7.92672 -0.267338 9.40341 -0.267334 9.74256 0.80201L11.0114 4.80273C11.1631 5.28095 11.5981 5.60473 12.0889 5.60473H16.195C17.2925 5.60473 17.7488 7.04353 16.8609 7.70442L13.539 10.177C13.1419 10.4726 12.9758 10.9964 13.1275 11.4747L14.3963 15.4754C14.7355 16.5447 13.5408 17.434 12.6529 16.7731L9.33099 14.3005C8.93391 14.0049 8.39622 14.0049 7.99913 14.3005L4.67723 16.7731C3.78932 17.434 2.59466 16.5447 2.93381 15.4754L4.20266 11.4747C4.35433 10.9964 4.18818 10.4726 3.79109 10.177L0.469188 7.70442C-0.418717 7.04353 0.0376084 5.60473 1.13512 5.60473H5.24122C5.73204 5.60473 6.16704 5.28095 6.31871 4.80273L7.58757 0.802006Z" fill="#FFC97A" />
                                        <path d="M53.9225 0.802006C54.2617 -0.267338 55.7384 -0.267334 56.0775 0.80201L57.3464 4.80273C57.498 5.28095 57.933 5.60473 58.4239 5.60473H62.53C63.6275 5.60473 64.0838 7.04353 63.1959 7.70442L59.874 10.177C59.4769 10.4726 59.3107 10.9964 59.4624 11.4747L60.7313 15.4754C61.0704 16.5447 59.8758 17.434 58.9879 16.7731L55.666 14.3005C55.2689 14.0049 54.7312 14.0049 54.3341 14.3005L51.0122 16.7731C50.1243 17.434 48.9296 16.5447 49.2688 15.4754L50.5376 11.4747C50.6893 10.9964 50.5231 10.4726 50.1261 10.177L46.8041 7.70442C45.9162 7.04353 46.3726 5.60473 47.4701 5.60473H51.5762C52.067 5.60473 52.502 5.28095 52.6537 4.80273L53.9225 0.802006Z" fill="#FFC97A" />
                                        <path d="M30.755 0.802006C31.0942 -0.267338 32.5709 -0.267334 32.91 0.80201L34.1789 4.80273C34.3306 5.28095 34.7656 5.60473 35.2564 5.60473H39.3625C40.46 5.60473 40.9163 7.04353 40.0284 7.70442L36.7065 10.177C36.3094 10.4726 36.1433 10.9964 36.2949 11.4747L37.5638 15.4754C37.9029 16.5447 36.7083 17.434 35.8204 16.7731L32.4985 14.3005C32.1014 14.0049 31.5637 14.0049 31.1666 14.3005L27.8447 16.7731C26.9568 17.434 25.7621 16.5447 26.1013 15.4754L27.3701 11.4747C27.5218 10.9964 27.3557 10.4726 26.9586 10.177L23.6367 7.70442C22.7488 7.04353 23.2051 5.60473 24.3026 5.60473H28.4087C28.8995 5.60473 29.3345 5.28095 29.4862 4.80273L30.755 0.802006Z" fill="#FFC97A" />
                                        <path d="M77.09 0.802006C77.4291 -0.267338 78.9058 -0.267334 79.245 0.80201L80.5138 4.80273C80.6655 5.28095 81.1005 5.60473 81.5913 5.60473H85.6974C86.7949 5.60473 87.2512 7.04353 86.3633 7.70442L83.0414 10.177C82.6444 10.4726 82.4782 10.9964 82.6299 11.4747L83.8987 15.4754C84.2379 16.5447 83.0432 17.434 82.1553 16.7731L78.8334 14.3005C78.4363 14.0049 77.8986 14.0049 77.5015 14.3005L74.1796 16.7731C73.2917 17.434 72.0971 16.5447 72.4362 15.4754L73.7051 11.4747C73.8567 10.9964 73.6906 10.4726 73.2935 10.177L69.9716 7.70442C69.0837 7.04353 69.54 5.60473 70.6375 5.60473H74.7436C75.2344 5.60473 75.6694 5.28095 75.8211 4.80273L77.09 0.802006Z" fill="#FFC97A" />
                                        <path d="M100.257 0.802006C100.597 -0.267338 102.073 -0.267334 102.412 0.80201L103.681 4.80273C103.833 5.28095 104.268 5.60473 104.759 5.60473H108.865C109.962 5.60473 110.419 7.04353 109.531 7.70442L106.209 10.177C105.812 10.4726 105.646 10.9964 105.797 11.4747L107.066 15.4754C107.405 16.5447 106.211 17.434 105.323 16.7731L102.001 14.3005C101.604 14.0049 101.066 14.0049 100.669 14.3005L97.3471 16.7731C96.4592 17.434 95.2645 16.5447 95.6037 15.4754L96.8726 11.4747C97.0242 10.9964 96.8581 10.4726 96.461 10.177L93.1391 7.70442C92.2512 7.04353 92.7075 5.60473 93.805 5.60473H97.9111C98.4019 5.60473 98.8369 5.28095 98.9886 4.80273L100.257 0.802006Z" fill="#FFC97A" />
                                    </svg>
                                </div>
                            </div>
                            <div class="review-card">
                                <div class="review-header">
                                    <div class="avatar" style="background: #FFA899;"></div>
                                    <div class="reviewer-info">
                                        <span class="reviewer-name">Sunny T.</span>
                                        <span class="review-date">2 week ago</span>
                                    </div>
                                </div>

                                <p class="review-text">
                                    Hands down the best groomer we’ve tried. The studio is spotless and she really listens ...
                                </p>

                                <div class="stars">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="110" height="17" viewBox="0 0 110 17" fill="none">
                                        <path d="M7.58757 0.802006C7.92672 -0.267338 9.40341 -0.267334 9.74256 0.80201L11.0114 4.80273C11.1631 5.28095 11.5981 5.60473 12.0889 5.60473H16.195C17.2925 5.60473 17.7488 7.04353 16.8609 7.70442L13.539 10.177C13.1419 10.4726 12.9758 10.9964 13.1275 11.4747L14.3963 15.4754C14.7355 16.5447 13.5408 17.434 12.6529 16.7731L9.33099 14.3005C8.93391 14.0049 8.39622 14.0049 7.99913 14.3005L4.67723 16.7731C3.78932 17.434 2.59466 16.5447 2.93381 15.4754L4.20266 11.4747C4.35433 10.9964 4.18818 10.4726 3.79109 10.177L0.469188 7.70442C-0.418717 7.04353 0.0376084 5.60473 1.13512 5.60473H5.24122C5.73204 5.60473 6.16704 5.28095 6.31871 4.80273L7.58757 0.802006Z" fill="#FFC97A" />
                                        <path d="M53.9225 0.802006C54.2617 -0.267338 55.7384 -0.267334 56.0775 0.80201L57.3464 4.80273C57.498 5.28095 57.933 5.60473 58.4239 5.60473H62.53C63.6275 5.60473 64.0838 7.04353 63.1959 7.70442L59.874 10.177C59.4769 10.4726 59.3107 10.9964 59.4624 11.4747L60.7313 15.4754C61.0704 16.5447 59.8758 17.434 58.9879 16.7731L55.666 14.3005C55.2689 14.0049 54.7312 14.0049 54.3341 14.3005L51.0122 16.7731C50.1243 17.434 48.9296 16.5447 49.2688 15.4754L50.5376 11.4747C50.6893 10.9964 50.5231 10.4726 50.1261 10.177L46.8041 7.70442C45.9162 7.04353 46.3726 5.60473 47.4701 5.60473H51.5762C52.067 5.60473 52.502 5.28095 52.6537 4.80273L53.9225 0.802006Z" fill="#FFC97A" />
                                        <path d="M30.755 0.802006C31.0942 -0.267338 32.5709 -0.267334 32.91 0.80201L34.1789 4.80273C34.3306 5.28095 34.7656 5.60473 35.2564 5.60473H39.3625C40.46 5.60473 40.9163 7.04353 40.0284 7.70442L36.7065 10.177C36.3094 10.4726 36.1433 10.9964 36.2949 11.4747L37.5638 15.4754C37.9029 16.5447 36.7083 17.434 35.8204 16.7731L32.4985 14.3005C32.1014 14.0049 31.5637 14.0049 31.1666 14.3005L27.8447 16.7731C26.9568 17.434 25.7621 16.5447 26.1013 15.4754L27.3701 11.4747C27.5218 10.9964 27.3557 10.4726 26.9586 10.177L23.6367 7.70442C22.7488 7.04353 23.2051 5.60473 24.3026 5.60473H28.4087C28.8995 5.60473 29.3345 5.28095 29.4862 4.80273L30.755 0.802006Z" fill="#FFC97A" />
                                        <path d="M77.09 0.802006C77.4291 -0.267338 78.9058 -0.267334 79.245 0.80201L80.5138 4.80273C80.6655 5.28095 81.1005 5.60473 81.5913 5.60473H85.6974C86.7949 5.60473 87.2512 7.04353 86.3633 7.70442L83.0414 10.177C82.6444 10.4726 82.4782 10.9964 82.6299 11.4747L83.8987 15.4754C84.2379 16.5447 83.0432 17.434 82.1553 16.7731L78.8334 14.3005C78.4363 14.0049 77.8986 14.0049 77.5015 14.3005L74.1796 16.7731C73.2917 17.434 72.0971 16.5447 72.4362 15.4754L73.7051 11.4747C73.8567 10.9964 73.6906 10.4726 73.2935 10.177L69.9716 7.70442C69.0837 7.04353 69.54 5.60473 70.6375 5.60473H74.7436C75.2344 5.60473 75.6694 5.28095 75.8211 4.80273L77.09 0.802006Z" fill="#FFC97A" />
                                        <path d="M100.257 0.802006C100.597 -0.267338 102.073 -0.267334 102.412 0.80201L103.681 4.80273C103.833 5.28095 104.268 5.60473 104.759 5.60473H108.865C109.962 5.60473 110.419 7.04353 109.531 7.70442L106.209 10.177C105.812 10.4726 105.646 10.9964 105.797 11.4747L107.066 15.4754C107.405 16.5447 106.211 17.434 105.323 16.7731L102.001 14.3005C101.604 14.0049 101.066 14.0049 100.669 14.3005L97.3471 16.7731C96.4592 17.434 95.2645 16.5447 95.6037 15.4754L96.8726 11.4747C97.0242 10.9964 96.8581 10.4726 96.461 10.177L93.1391 7.70442C92.2512 7.04353 92.7075 5.60473 93.805 5.60473H97.9111C98.4019 5.60473 98.8369 5.28095 98.9886 4.80273L100.257 0.802006Z" fill="#FFC97A" />
                                    </svg>
                                </div>
                            </div>
                            <div class="d-flex align-items-center justify-content-between mt-3" style="width: 100%;">
                                <div class="d-flex align-items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 15 15" fill="none">
                                        <path d="M7.5 0C3.375 0 0 3.375 0 7.5C0 11.625 3.375 15 7.5 15C11.625 15 15 11.625 15 7.5C15 3.375 11.625 0 7.5 0ZM6 11.25L2.25 7.5L3.3075 6.4425L6 9.1275L11.6925 3.435L12.75 4.5L6 11.25Z" fill="#D8E8B7"></path>
                                    </svg>
                                    &nbsp;
                                    &nbsp;
                                    <p class="confirm-review-text">All reviews are from verified Fursgo bookings.</p>
                                </div>
                                <a href="" class="review-link">Read more reviews</a>
                            </div>
                        </div>


                    </div>

                    <div id="location" class="mt-5 section-offset">
                        <h2 class="section-content-heading">Location</h2>

                        <div class="map-location-section">
                            <div class="location-svg-text d-flex align-items-center gap-20">
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 11 16" fill="none">
                                    <path d="M5.5 7.6C4.97904 7.6 4.47942 7.38929 4.11104 7.01421C3.74267 6.63914 3.53571 6.13043 3.53571 5.6C3.53571 5.06957 3.74267 4.56086 4.11104 4.18579C4.47942 3.81071 4.97904 3.6 5.5 3.6C6.02096 3.6 6.52058 3.81071 6.88896 4.18579C7.25733 4.56086 7.46429 5.06957 7.46429 5.6C7.46429 5.86264 7.41348 6.12272 7.31476 6.36537C7.21605 6.60802 7.07136 6.8285 6.88896 7.01421C6.70656 7.19993 6.49002 7.34725 6.2517 7.44776C6.01338 7.54827 5.75795 7.6 5.5 7.6ZM5.5 0C4.04131 0 2.64236 0.589998 1.61091 1.6402C0.579463 2.69041 0 4.11479 0 5.6C0 9.8 5.5 16 5.5 16C5.5 16 11 9.8 11 5.6C11 4.11479 10.4205 2.69041 9.38909 1.6402C8.35764 0.589998 6.95869 0 5.5 0Z" fill="#FFC97A" />
                                </svg>
                                <p>Based in West London</p>
                            </div>

                            <div class="inverted-radius mt-5">
                                <div id="map" style="width:100%; height:400px;"></div>
                            </div>
                        </div>

                        <h2 class="section-content-heading">Accessbility</h2>
                        <p class="fs-16 mt-3">
                            Located near Victoria Embankment, with excellent public transport connections and free on-site parking available.
                        </p>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <?php include '../../components/footer.php' ?>

    <script src="<?= BASE_URL ?>/assets/js/profile.js"></script>
    <script src="<?= BASE_URL ?>/assets/js/common.js"></script>

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const map = L.map('map', {
                zoomControl: true,
                attributionControl: false,
                preferCanvas: true
            }).setView([51.510131, -0.146812], 15);

            L.tileLayer('https://{s}.basemaps.cartocdn.com/light_nolabels/{z}/{x}/{y}{r}.png', {
                subdomains: 'abcd',
                maxZoom: 20
            }).addTo(map);

            L.tileLayer('https://{s}.basemaps.cartocdn.com/light_only_labels/{z}/{x}/{y}{r}.png', {
                subdomains: 'abcd',
                maxZoom: 20
            }).addTo(map);

            const yellowPin = L.icon({
                iconUrl: 'data:image/svg+xml;utf8,' + encodeURIComponent(`
            <svg xmlns="http://www.w3.org/2000/svg" width="34" height="48" viewBox="0 0 34 48" fill="none">
                <path d="M17 22.8C15.3898 22.8 13.8455 22.1679 12.7069 21.0426C11.5682 19.9174 10.9286 18.3913 10.9286 16.8C10.9286 15.2087 11.5682 13.6826 12.7069 12.5574C13.8455 11.4321 15.3898 10.8 17 10.8C18.6102 10.8 20.1545 11.4321 21.2931 12.5574C22.4318 13.6826 23.0714 15.2087 23.0714 16.8ZM17 0C12.4913 0 8.1673 1.76999 4.97918 4.92061C1.79107 8.07122 0 12.3444 0 16.8C0 29.4 17 48 17 48C17 48 34 29.4 34 16.8C34 12.3444 32.2089 8.07122 29.0208 4.92061C25.8327 1.76999 21.5087 0 17 0Z" fill="#FFC97A"/>
            </svg>
        `),
                iconSize: [28, 28],
                iconAnchor: [14, 28]
            });

            // Location object (keeps name available for the tooltip)
            const location = {
                loc_name: "Sarah's Grooming Studio",
                lat: 51.510131,
                lng: -0.146812
            };

            // Marker + hover tooltip showing the location name (no other changes)
            const marker = L.marker([location.lat, location.lng], {
                    icon: yellowPin
                })
                .addTo(map)
                .bindTooltip(location.loc_name, {
                    direction: 'top',
                    offset: [0, -24],
                    opacity: 0.95
                });

        });

        // groomer-find-card

        const groomerFindCard = document.querySelectorAll('.groomer-find-card');

        groomerFindCard.forEach(card => {
            card.addEventListener('click', () => {
                // remove active from all cards
                groomerFindCard.forEach(c => c.classList.remove('active'));

                card.classList.toggle('active');
            });
        });

        const blockSvg = document.querySelectorAll('.block-svg');
        const blockBtnDiv = document.querySelector('.block-btn-div');

        blockSvg.forEach(svg => {
            svg.addEventListener('click', () => {
                blockBtnDiv.style.display = blockBtnDiv.style.display === 'block' ? 'none' : 'block';
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const scrollers = document.querySelectorAll('.space-scroll');

            scrollers.forEach(scroller => {
                const progress = scroller.parentElement.querySelector('.scroll-progress');
                const leftBtn = scroller.parentElement.querySelector('.scroll-btn.left');
                const rightBtn = scroller.parentElement.querySelector('.scroll-btn.right');
                const scrollAmount = 200;

                if (!progress || !leftBtn || !rightBtn) return;

                function updateProgress() {
                    const visible = scroller.clientWidth;
                    const total = scroller.scrollWidth;
                    const left = scroller.scrollLeft;

                    if (total === 0 || visible === 0) {
                        requestAnimationFrame(updateProgress);
                        return;
                    }

                    if (total <= visible) {
                        progress.style.left = '0%';
                        progress.style.width = '100%';
                        return;
                    }

                    let widthPercent = (visible / total) * 100;
                    let leftPercent = (left / total) * 100;

                    widthPercent = Math.max(15, widthPercent);
                    leftPercent = Math.min(100 - widthPercent, leftPercent);

                    progress.style.left = leftPercent + '%';
                    progress.style.width = widthPercent + '%';
                }

                scroller.addEventListener('scroll', updateProgress);
                window.addEventListener('resize', updateProgress);
                setTimeout(updateProgress, 100);

                leftBtn.addEventListener('click', () => {
                    scroller.scrollBy({
                        left: -scrollAmount,
                        behavior: 'smooth'
                    });
                });

                rightBtn.addEventListener('click', () => {
                    scroller.scrollBy({
                        left: scrollAmount,
                        behavior: 'smooth'
                    });
                });
            });
        });
    </script>
    <script>
        document.querySelectorAll('.custom-select').forEach(select => {
            const trigger = select.querySelector('.select-trigger');
            const options = select.querySelectorAll('.select-options li');
            const datePopovers = document.querySelectorAll('.popover');
            const text = select.querySelector('.selected-text');
            const hiddenInput = select.querySelector('input[type="hidden"]');

            trigger.addEventListener('click', e => {
                e.stopPropagation();

                datePopovers.forEach(popover => {
                    popover.style.display = 'none';
                });

                document.querySelectorAll('.custom-select').forEach(s => {
                    if (s !== select) {
                        s.classList.remove('open');
                        const t = s.querySelector('.select-trigger');
                        t.style.cssText = `
                    border-bottom-left-radius: 12px;
                    border-bottom-right-radius: 12px;
                `;
                    }
                });

                const isOpen = select.classList.toggle('open');

                trigger.style.cssText = isOpen ?
                    `border-bottom-left-radius: 0; border-bottom-right-radius: 0;` :
                    `border-bottom-left-radius: 12px; border-bottom-right-radius: 12px;`;
            });

            options.forEach(option => {
                option.addEventListener('click', () => {
                    text.textContent = option.textContent;
                    hiddenInput.value = option.dataset.value;

                    select.classList.remove('open');
                    select.classList.add('has-value'); // add class to highlight border

                    trigger.style.cssText = `
                border-bottom-left-radius: 12px;
                border-bottom-right-radius: 12px;
            `;
                });
            });
        });

        // Remove 'has-value' if clicked outside and no value
        document.addEventListener('click', (e) => {
            document.querySelectorAll('.custom-select').forEach(select => {
                if (!select.contains(e.target) && !select.querySelector('input[type="hidden"]').value) {
                    select.classList.remove('has-value');
                }
            });
        });
    </script>

</body>

</html>