<?php include '../../function_helper.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FursGo - Space Profile</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/responsive.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/bootstrap.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/media_query.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/groomer_space_profile.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/common.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <style>
        .image-grid {
            display: grid;
            grid-template-columns: 3fr 1fr 1fr;
            grid-template-rows: repeat(2, 200px);
            gap: 12px;
            grid-template-areas:
                "img-1 img-2 img-3"
                "img-1 img-4 img-5";
        }

        .image-grid-item {
            overflow: hidden;
            border-radius: 10px;
        }

        .image-grid-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .inverted-radius {
            --r: 21px;
            --s: 18px;
            --x: 325px;
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

        /* modal css starts */
        #groomer_book_space .modal-content {
            width: 1200px;
            height: auto;
            background: #FDFCF8;
            padding: 45px;
            margin-bottom: 5rem;
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
            background: #FBAC83;
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
            border: 1px solid #FBAC83 !important;
            padding: 10px 20px 10px 20px;
            text-align: center;
            font-family: Lato;
            font-size: 14px;
            font-weight: 500;
            background: #fff;
            color: #FBAC83 !important;
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
            border: 1px solid #FFC97A;
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
            /* align-items: center; */
            flex-direction: column;
            justify-content: space-between;
        }

        .card .tags {
            display: flex;
            gap: 10px
        }

        .card .tag {
            background: #FBAC83;
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
            height: 555px;
            aspect-ratio: 107 / 32;
            border-radius: 10px 0 0 10px;
            object-fit: none;
        }
    </style>
</head>

<body class="space-profile">

    <?php include '../../components/header.php' ?>

    <div class="container mt-5" style="padding: 0 80px">

        <!-- <button class="book-btn" data-modal-open="groomer_book_space">Book a Space for Your Groomer</button> -->

        <!-- Modal 1 -->

        <div class="modal" id="groomer_book_space">
            <div class="modal-content">
                <div class="d-flex align-items-center justify-content-between">
                    <button type="button" class="btn-custom btn-no-bg text-center" id="goBack" fdprocessedid="y45oyo" style="display: inline;">Go Back</button>
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
                        <h1 class="heading">Groomer Results</h1>
                        <span class="count">5</span>
                    </div>

                    <div class="tab-wrapper">
                        <div class="tabs groomer-tabs text-center">
                            <a data-tab="groomer-map-view" class="tablinks">Map View</a>
                            <a data-tab="groomer-list-view" class="tablinks active">List View</a>
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
                        <div class="d-flex align-items-center gap-10 cursor">
                            <p class="underlined-font normal-font-bold">Filter</p>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                <path d="M2.5 7.75C2.03587 7.75 1.59075 7.56563 1.26256 7.23744C0.934374 6.90925 0.75 6.46413 0.75 6C0.75 5.53587 0.934374 5.09075 1.26256 4.76256C1.59075 4.43437 2.03587 4.25 2.5 4.25M2.5 7.75C2.96413 7.75 3.40925 7.56563 3.73744 7.23744C4.06563 6.90925 4.25 6.46413 4.25 6C4.25 5.53587 4.06563 5.09075 3.73744 4.76256C3.40925 4.43437 2.96413 4.25 2.5 4.25M2.5 7.75V14.75M2.5 4.25V0.75M7.75 13C7.28587 13 6.84075 12.8156 6.51256 12.4874C6.18437 12.1592 6 11.7141 6 11.25C6 10.7859 6.18437 10.3408 6.51256 10.0126C6.84075 9.68437 7.28587 9.5 7.75 9.5M7.75 13C8.21413 13 8.65925 12.8156 8.98744 12.4874C9.31563 12.1592 9.5 11.7141 9.5 11.25C9.5 10.7859 9.31563 10.3408 8.98744 10.0126C8.65925 9.68437 8.21413 9.5 7.75 9.5M7.75 13V14.75M7.75 9.5V0.75M13 5.125C12.5359 5.125 12.0908 4.94063 11.7626 4.61244C11.4344 4.28425 11.25 3.83913 11.25 3.375C11.25 2.91087 11.4344 2.46575 11.7626 2.13756C12.0908 1.80937 12.5359 1.625 13 1.625M13 5.125C13.4641 5.125 13.9092 4.94063 14.2374 4.61244C14.5656 4.28425 14.75 3.83913 14.75 3.375C14.75 2.91087 14.5656 2.46575 14.2374 2.13756C13.9092 1.80937 13.4641 1.625 13 1.625M13 5.125V14.75M13 1.625V0.75" stroke="#3B3731" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
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
                                                <svg xmlns="http://www.w3.org/2000/svg" width="21" height="22" viewBox="0 0 21 22" fill="none">
                                                    <path d="M10.9482 0.125295C10.7667 0.043205 10.5723 0 10.3692 0C10.1662 0 9.97174 0.043205 9.79028 0.125295L1.65477 3.57738C0.704262 3.97918 -0.00430085 4.91673 1.96518e-05 6.0487C0.0216222 10.3346 1.78439 18.1764 9.22861 21.7408C9.95014 22.0864 10.7883 22.0864 11.5098 21.7408C18.9541 18.1764 20.7168 10.3346 20.7384 6.0487C20.7428 4.91673 20.0342 3.97918 19.0837 3.57738L10.9482 0.125295ZM6.26043 12.3653C6.46781 12.4171 6.68816 12.443 6.91282 12.443C8.43796 12.443 9.67795 11.2031 9.67795 9.67793V6.9128H11.5876C12.1104 6.9128 12.59 7.2066 12.8233 7.67753L13.1343 8.29537H15.8995C16.2797 8.29537 16.5907 8.60644 16.5907 8.98665V10.3692C16.5907 12.2789 15.044 13.8256 13.1343 13.8256H11.0605V16.0161C11.0605 16.3315 10.8056 16.5907 10.4859 16.5907C10.4081 16.5907 10.3303 16.5734 10.2612 16.5432L5.99688 14.7156C5.71172 14.5947 5.53026 14.3138 5.53026 14.0071C5.53026 13.8861 5.55619 13.7694 5.61235 13.6614L6.26043 12.3653ZM6.22154 6.9128H8.29538V9.67793C8.29538 10.4427 7.67755 11.0605 6.91282 11.0605C6.1481 11.0605 5.53026 10.4427 5.53026 9.67793V7.60408C5.53026 7.22388 5.84134 6.9128 6.22154 6.9128ZM11.7518 8.98665C11.7518 8.80331 11.679 8.62748 11.5493 8.49784C11.4197 8.3682 11.2438 8.29537 11.0605 8.29537C10.8772 8.29537 10.7013 8.3682 10.5717 8.49784C10.4421 8.62748 10.3692 8.80331 10.3692 8.98665C10.3692 9.16998 10.4421 9.34581 10.5717 9.47545C10.7013 9.60509 10.8772 9.67793 11.0605 9.67793C11.2438 9.67793 11.4197 9.60509 11.5493 9.47545C11.679 9.34581 11.7518 9.16998 11.7518 8.98665Z" fill="#C9DDA0" />
                                                </svg>
                                            </div>
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 255 130" fill="none">
                                                <defs>
                                                    <pattern id="pattern-card-1" patternUnits="userSpaceOnUse" width="255"
                                                        height="130">
                                                        <image href="<?= BASE_URL ?>/assets/images/profile_modal_image.jpg" width="255"
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
                                                <div class="tags mt-3" aria-hidden="true">
                                                    <div class="tag">Groomer’s Studio</div>
                                                </div>
                                            </div>

                                            <h2 class="name">Sarah W.</h2>
                                            <p class="hosted-by"><span>Sarah’s Grooming Studio</span></p>

                                            <div class="studio-details mt-1 d-flex flex-column justify-content-between mt-2">

                                                <div class="meta d-flex align-items-center justify-content-between">
                                                    <div class="distance" title="Distance">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="10" height="14"
                                                            viewBox="0 0 10 14" fill="none">
                                                            <path
                                                                d="M5 6.65C4.5264 6.65 4.0722 6.46563 3.73731 6.13744C3.40242 5.80925 3.21429 5.36413 3.21429 4.9C3.21429 4.43587 3.40242 3.99075 3.73731 3.66256C4.0722 3.33437 4.5264 3.15 5 3.15C5.4736 3.15 5.9278 3.33437 6.26269 3.66256C6.59758 3.99075 6.78571 4.43587 6.78571 4.9C6.78571 5.12981 6.73953 5.35738 6.64979 5.5697C6.56004 5.78202 6.42851 5.97493 6.26269 6.13744C6.09687 6.29994 5.90002 6.42884 5.68336 6.51679C5.46671 6.60473 5.2345 6.65 5 6.65ZM5 0C3.67392 0 2.40215 0.516248 1.46447 1.43518C0.526784 2.3541 0 3.60044 0 4.9C0 8.575 5 14 5 14C5 14 10 8.575 10 4.9C10 3.60044 9.47322 2.3541 8.53553 1.43518C7.59785 0.516248 6.32608 0 5 0Z"
                                                                fill="#FFC97A" />
                                                        </svg>
                                                        <span>2.5 mi</span>
                                                    </div>


                                                    <div class="rating" title="Rating">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                            viewBox="0 0 14 14" fill="none">
                                                            <path
                                                                d="M6.12956 0.660476C6.40354 -0.220161 7.59647 -0.220158 7.87045 0.660479L8.89548 3.95519C9.01801 4.34902 9.36942 4.61566 9.76593 4.61566H13.083C13.9696 4.61566 14.3383 5.80055 13.621 6.34481L10.9374 8.38106C10.6166 8.62446 10.4824 9.0559 10.6049 9.44973L11.63 12.7444C11.9039 13.6251 10.9388 14.3574 10.2215 13.8131L7.53797 11.7769C7.21719 11.5335 6.78282 11.5335 6.46204 11.7769L3.77846 13.8131C3.06117 14.3574 2.09607 13.6251 2.37005 12.7444L3.39508 9.44973C3.51761 9.0559 3.38338 8.62446 3.0626 8.38106L0.37903 6.34481C-0.338258 5.80055 0.0303816 4.61566 0.916998 4.61566H4.23408C4.63058 4.61566 4.98199 4.34902 5.10452 3.95519L6.12956 0.660476Z"
                                                                fill="#FFC97A" />
                                                        </svg>
                                                        <span>4.3 <small style="color:var(--muted)">(20)</small></span>
                                                    </div>
                                                </div>
                                            </div>



                                            <p class="experience">Gentle, breed-specific trims · 6+ years <br> experience.</p>


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
                                                <svg xmlns="http://www.w3.org/2000/svg" width="21" height="22" viewBox="0 0 21 22" fill="none">
                                                    <path d="M10.9482 0.125295C10.7667 0.043205 10.5723 0 10.3692 0C10.1662 0 9.97174 0.043205 9.79028 0.125295L1.65477 3.57738C0.704262 3.97918 -0.00430085 4.91673 1.96518e-05 6.0487C0.0216222 10.3346 1.78439 18.1764 9.22861 21.7408C9.95014 22.0864 10.7883 22.0864 11.5098 21.7408C18.9541 18.1764 20.7168 10.3346 20.7384 6.0487C20.7428 4.91673 20.0342 3.97918 19.0837 3.57738L10.9482 0.125295ZM6.26043 12.3653C6.46781 12.4171 6.68816 12.443 6.91282 12.443C8.43796 12.443 9.67795 11.2031 9.67795 9.67793V6.9128H11.5876C12.1104 6.9128 12.59 7.2066 12.8233 7.67753L13.1343 8.29537H15.8995C16.2797 8.29537 16.5907 8.60644 16.5907 8.98665V10.3692C16.5907 12.2789 15.044 13.8256 13.1343 13.8256H11.0605V16.0161C11.0605 16.3315 10.8056 16.5907 10.4859 16.5907C10.4081 16.5907 10.3303 16.5734 10.2612 16.5432L5.99688 14.7156C5.71172 14.5947 5.53026 14.3138 5.53026 14.0071C5.53026 13.8861 5.55619 13.7694 5.61235 13.6614L6.26043 12.3653ZM6.22154 6.9128H8.29538V9.67793C8.29538 10.4427 7.67755 11.0605 6.91282 11.0605C6.1481 11.0605 5.53026 10.4427 5.53026 9.67793V7.60408C5.53026 7.22388 5.84134 6.9128 6.22154 6.9128ZM11.7518 8.98665C11.7518 8.80331 11.679 8.62748 11.5493 8.49784C11.4197 8.3682 11.2438 8.29537 11.0605 8.29537C10.8772 8.29537 10.7013 8.3682 10.5717 8.49784C10.4421 8.62748 10.3692 8.80331 10.3692 8.98665C10.3692 9.16998 10.4421 9.34581 10.5717 9.47545C10.7013 9.60509 10.8772 9.67793 11.0605 9.67793C11.2438 9.67793 11.4197 9.60509 11.5493 9.47545C11.679 9.34581 11.7518 9.16998 11.7518 8.98665Z" fill="#C9DDA0" />
                                                </svg>
                                            </div>
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 255 130" fill="none">
                                                <defs>
                                                    <pattern id="pattern-card-2" patternUnits="userSpaceOnUse" width="255"
                                                        height="130">
                                                        <image href="<?= BASE_URL ?>/assets/images/profile_modal_image2.jpg" width="255"
                                                            height="130" preserveAspectRatio="xMinYMax slice" />
                                                    </pattern>
                                                </defs>

                                                <path
                                                    d="M255 124.417C255 127.178 252.761 129.417 250 129.417H5C2.23858 129.417 0 127.178 0 124.417V37C0 34.2386 2.23858 32 5 32H27C29.7614 32 32 29.7614 32 27V5C32 2.23858 34.2386 0 37 0H250C252.761 0 255 2.23858 255 5V124.417Z"
                                                    fill="url(#pattern-card-2)" />
                                            </svg>

                                        </div>
                                        <div class="right">
                                            <div class="top-row">
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
                                                <div class="d-flex align-items-center gap-10">
                                                    <div class="tags mt-3" aria-hidden="true">
                                                        <div class="tag">Home Visit</div>
                                                    </div>
                                                    <div class="tags mt-3" aria-hidden="true">
                                                        <div class="tag">Mobile Station</div>
                                                    </div>
                                                </div>

                                            </div>

                                            <h2 class="name">Ken T.</h2>
                                            <p class="hosted-by"><span>Ken’s Grooming Mobile</span></p>

                                            <div class="studio-details mt-1 d-flex flex-column justify-content-between mt-2">

                                                <div class="meta d-flex align-items-center justify-content-between">
                                                    <div class="distance" title="Distance">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="10" height="14"
                                                            viewBox="0 0 10 14" fill="none">
                                                            <path
                                                                d="M5 6.65C4.5264 6.65 4.0722 6.46563 3.73731 6.13744C3.40242 5.80925 3.21429 5.36413 3.21429 4.9C3.21429 4.43587 3.40242 3.99075 3.73731 3.66256C4.0722 3.33437 4.5264 3.15 5 3.15C5.4736 3.15 5.9278 3.33437 6.26269 3.66256C6.59758 3.99075 6.78571 4.43587 6.78571 4.9C6.78571 5.12981 6.73953 5.35738 6.64979 5.5697C6.56004 5.78202 6.42851 5.97493 6.26269 6.13744C6.09687 6.29994 5.90002 6.42884 5.68336 6.51679C5.46671 6.60473 5.2345 6.65 5 6.65ZM5 0C3.67392 0 2.40215 0.516248 1.46447 1.43518C0.526784 2.3541 0 3.60044 0 4.9C0 8.575 5 14 5 14C5 14 10 8.575 10 4.9C10 3.60044 9.47322 2.3541 8.53553 1.43518C7.59785 0.516248 6.32608 0 5 0Z"
                                                                fill="#FFC97A" />
                                                        </svg>
                                                        <span>2.5 mi</span>
                                                    </div>


                                                    <div class="rating" title="Rating">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                            viewBox="0 0 14 14" fill="none">
                                                            <path
                                                                d="M6.12956 0.660476C6.40354 -0.220161 7.59647 -0.220158 7.87045 0.660479L8.89548 3.95519C9.01801 4.34902 9.36942 4.61566 9.76593 4.61566H13.083C13.9696 4.61566 14.3383 5.80055 13.621 6.34481L10.9374 8.38106C10.6166 8.62446 10.4824 9.0559 10.6049 9.44973L11.63 12.7444C11.9039 13.6251 10.9388 14.3574 10.2215 13.8131L7.53797 11.7769C7.21719 11.5335 6.78282 11.5335 6.46204 11.7769L3.77846 13.8131C3.06117 14.3574 2.09607 13.6251 2.37005 12.7444L3.39508 9.44973C3.51761 9.0559 3.38338 8.62446 3.0626 8.38106L0.37903 6.34481C-0.338258 5.80055 0.0303816 4.61566 0.916998 4.61566H4.23408C4.63058 4.61566 4.98199 4.34902 5.10452 3.95519L6.12956 0.660476Z"
                                                                fill="#FFC97A" />
                                                        </svg>
                                                        <span>4.3 <small style="color:var(--muted)">(20)</small></span>
                                                    </div>
                                                </div>
                                            </div>



                                            <p class="experience">Gentle, breed-specific trims · 6+ years <br> experience.</p>


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
                                                <svg xmlns="http://www.w3.org/2000/svg" width="21" height="22" viewBox="0 0 21 22" fill="none">
                                                    <path d="M10.9482 0.125295C10.7667 0.043205 10.5723 0 10.3692 0C10.1662 0 9.97174 0.043205 9.79028 0.125295L1.65477 3.57738C0.704262 3.97918 -0.00430085 4.91673 1.96518e-05 6.0487C0.0216222 10.3346 1.78439 18.1764 9.22861 21.7408C9.95014 22.0864 10.7883 22.0864 11.5098 21.7408C18.9541 18.1764 20.7168 10.3346 20.7384 6.0487C20.7428 4.91673 20.0342 3.97918 19.0837 3.57738L10.9482 0.125295ZM6.26043 12.3653C6.46781 12.4171 6.68816 12.443 6.91282 12.443C8.43796 12.443 9.67795 11.2031 9.67795 9.67793V6.9128H11.5876C12.1104 6.9128 12.59 7.2066 12.8233 7.67753L13.1343 8.29537H15.8995C16.2797 8.29537 16.5907 8.60644 16.5907 8.98665V10.3692C16.5907 12.2789 15.044 13.8256 13.1343 13.8256H11.0605V16.0161C11.0605 16.3315 10.8056 16.5907 10.4859 16.5907C10.4081 16.5907 10.3303 16.5734 10.2612 16.5432L5.99688 14.7156C5.71172 14.5947 5.53026 14.3138 5.53026 14.0071C5.53026 13.8861 5.55619 13.7694 5.61235 13.6614L6.26043 12.3653ZM6.22154 6.9128H8.29538V9.67793C8.29538 10.4427 7.67755 11.0605 6.91282 11.0605C6.1481 11.0605 5.53026 10.4427 5.53026 9.67793V7.60408C5.53026 7.22388 5.84134 6.9128 6.22154 6.9128ZM11.7518 8.98665C11.7518 8.80331 11.679 8.62748 11.5493 8.49784C11.4197 8.3682 11.2438 8.29537 11.0605 8.29537C10.8772 8.29537 10.7013 8.3682 10.5717 8.49784C10.4421 8.62748 10.3692 8.80331 10.3692 8.98665C10.3692 9.16998 10.4421 9.34581 10.5717 9.47545C10.7013 9.60509 10.8772 9.67793 11.0605 9.67793C11.2438 9.67793 11.4197 9.60509 11.5493 9.47545C11.679 9.34581 11.7518 9.16998 11.7518 8.98665Z" fill="#C9DDA0" />
                                                </svg>
                                            </div>
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 255 130" fill="none">
                                                <defs>
                                                    <pattern id="pattern-card-3" patternUnits="userSpaceOnUse" width="255"
                                                        height="130">
                                                        <image href="<?= BASE_URL ?>/assets/images/profile_modal_image3.jpg" width="255"
                                                            height="130" preserveAspectRatio="xMinYMax slice" />
                                                    </pattern>
                                                </defs>

                                                <path
                                                    d="M255 124.417C255 127.178 252.761 129.417 250 129.417H5C2.23858 129.417 0 127.178 0 124.417V37C0 34.2386 2.23858 32 5 32H27C29.7614 32 32 29.7614 32 27V5C32 2.23858 34.2386 0 37 0H250C252.761 0 255 2.23858 255 5V124.417Z"
                                                    fill="url(#pattern-card-3)" />
                                            </svg>

                                        </div>
                                        <div class="right">
                                            <div class="top-row">
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
                                                <div class="tags mt-3" aria-hidden="true">
                                                    <div class="tag">Salons</div>
                                                </div>
                                            </div>

                                            <h2 class="name">Cathy P.</h2>
                                            <p class="hosted-by"><span>Cathy’s Services</span></p>

                                            <div class="studio-details mt-1 d-flex flex-column justify-content-between mt-2">

                                                <div class="meta d-flex align-items-center justify-content-between">
                                                    <div class="distance" title="Distance">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="10" height="14"
                                                            viewBox="0 0 10 14" fill="none">
                                                            <path
                                                                d="M5 6.65C4.5264 6.65 4.0722 6.46563 3.73731 6.13744C3.40242 5.80925 3.21429 5.36413 3.21429 4.9C3.21429 4.43587 3.40242 3.99075 3.73731 3.66256C4.0722 3.33437 4.5264 3.15 5 3.15C5.4736 3.15 5.9278 3.33437 6.26269 3.66256C6.59758 3.99075 6.78571 4.43587 6.78571 4.9C6.78571 5.12981 6.73953 5.35738 6.64979 5.5697C6.56004 5.78202 6.42851 5.97493 6.26269 6.13744C6.09687 6.29994 5.90002 6.42884 5.68336 6.51679C5.46671 6.60473 5.2345 6.65 5 6.65ZM5 0C3.67392 0 2.40215 0.516248 1.46447 1.43518C0.526784 2.3541 0 3.60044 0 4.9C0 8.575 5 14 5 14C5 14 10 8.575 10 4.9C10 3.60044 9.47322 2.3541 8.53553 1.43518C7.59785 0.516248 6.32608 0 5 0Z"
                                                                fill="#FFC97A" />
                                                        </svg>
                                                        <span>2.5 mi</span>
                                                    </div>


                                                    <div class="rating" title="Rating">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                            viewBox="0 0 14 14" fill="none">
                                                            <path
                                                                d="M6.12956 0.660476C6.40354 -0.220161 7.59647 -0.220158 7.87045 0.660479L8.89548 3.95519C9.01801 4.34902 9.36942 4.61566 9.76593 4.61566H13.083C13.9696 4.61566 14.3383 5.80055 13.621 6.34481L10.9374 8.38106C10.6166 8.62446 10.4824 9.0559 10.6049 9.44973L11.63 12.7444C11.9039 13.6251 10.9388 14.3574 10.2215 13.8131L7.53797 11.7769C7.21719 11.5335 6.78282 11.5335 6.46204 11.7769L3.77846 13.8131C3.06117 14.3574 2.09607 13.6251 2.37005 12.7444L3.39508 9.44973C3.51761 9.0559 3.38338 8.62446 3.0626 8.38106L0.37903 6.34481C-0.338258 5.80055 0.0303816 4.61566 0.916998 4.61566H4.23408C4.63058 4.61566 4.98199 4.34902 5.10452 3.95519L6.12956 0.660476Z"
                                                                fill="#FFC97A" />
                                                        </svg>
                                                        <span>4.3 <small style="color:var(--muted)">(20)</small></span>
                                                    </div>
                                                </div>
                                            </div>



                                            <p class="experience">Gentle, breed-specific trims · 6+ years <br> experience.</p>


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
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="21" height="22" viewBox="0 0 21 22" fill="none">
                                                            <path d="M10.9482 0.125295C10.7667 0.043205 10.5723 0 10.3692 0C10.1662 0 9.97174 0.043205 9.79028 0.125295L1.65477 3.57738C0.704262 3.97918 -0.00430085 4.91673 1.96518e-05 6.0487C0.0216222 10.3346 1.78439 18.1764 9.22861 21.7408C9.95014 22.0864 10.7883 22.0864 11.5098 21.7408C18.9541 18.1764 20.7168 10.3346 20.7384 6.0487C20.7428 4.91673 20.0342 3.97918 19.0837 3.57738L10.9482 0.125295ZM6.26043 12.3653C6.46781 12.4171 6.68816 12.443 6.91282 12.443C8.43796 12.443 9.67795 11.2031 9.67795 9.67793V6.9128H11.5876C12.1104 6.9128 12.59 7.2066 12.8233 7.67753L13.1343 8.29537H15.8995C16.2797 8.29537 16.5907 8.60644 16.5907 8.98665V10.3692C16.5907 12.2789 15.044 13.8256 13.1343 13.8256H11.0605V16.0161C11.0605 16.3315 10.8056 16.5907 10.4859 16.5907C10.4081 16.5907 10.3303 16.5734 10.2612 16.5432L5.99688 14.7156C5.71172 14.5947 5.53026 14.3138 5.53026 14.0071C5.53026 13.8861 5.55619 13.7694 5.61235 13.6614L6.26043 12.3653ZM6.22154 6.9128H8.29538V9.67793C8.29538 10.4427 7.67755 11.0605 6.91282 11.0605C6.1481 11.0605 5.53026 10.4427 5.53026 9.67793V7.60408C5.53026 7.22388 5.84134 6.9128 6.22154 6.9128ZM11.7518 8.98665C11.7518 8.80331 11.679 8.62748 11.5493 8.49784C11.4197 8.3682 11.2438 8.29537 11.0605 8.29537C10.8772 8.29537 10.7013 8.3682 10.5717 8.49784C10.4421 8.62748 10.3692 8.80331 10.3692 8.98665C10.3692 9.16998 10.4421 9.34581 10.5717 9.47545C10.7013 9.60509 10.8772 9.67793 11.0605 9.67793C11.2438 9.67793 11.4197 9.60509 11.5493 9.47545C11.679 9.34581 11.7518 9.16998 11.7518 8.98665Z" fill="#C9DDA0" />
                                                        </svg>
                                                    </div>
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 255 130" fill="none">
                                                        <defs>
                                                            <pattern id="pattern-card-4" patternUnits="userSpaceOnUse" width="255"
                                                                height="130">
                                                                <image href="<?= BASE_URL ?>/assets/images/profile_modal_image.jpg" width="255"
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
                                                        <div class="tags mt-3" aria-hidden="true">
                                                            <div class="tag">Groomer’s Studio</div>
                                                        </div>
                                                    </div>

                                                    <h2 class="name">Sarah W.</h2>
                                                    <p class="hosted-by"><span>Sarah’s Grooming Studio</span></p>

                                                    <div class="studio-details mt-1 d-flex flex-column justify-content-between mt-2">

                                                        <div class="meta d-flex align-items-center justify-content-between">
                                                            <div class="distance" title="Distance">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="10" height="14"
                                                                    viewBox="0 0 10 14" fill="none">
                                                                    <path
                                                                        d="M5 6.65C4.5264 6.65 4.0722 6.46563 3.73731 6.13744C3.40242 5.80925 3.21429 5.36413 3.21429 4.9C3.21429 4.43587 3.40242 3.99075 3.73731 3.66256C4.0722 3.33437 4.5264 3.15 5 3.15C5.4736 3.15 5.9278 3.33437 6.26269 3.66256C6.59758 3.99075 6.78571 4.43587 6.78571 4.9C6.78571 5.12981 6.73953 5.35738 6.64979 5.5697C6.56004 5.78202 6.42851 5.97493 6.26269 6.13744C6.09687 6.29994 5.90002 6.42884 5.68336 6.51679C5.46671 6.60473 5.2345 6.65 5 6.65ZM5 0C3.67392 0 2.40215 0.516248 1.46447 1.43518C0.526784 2.3541 0 3.60044 0 4.9C0 8.575 5 14 5 14C5 14 10 8.575 10 4.9C10 3.60044 9.47322 2.3541 8.53553 1.43518C7.59785 0.516248 6.32608 0 5 0Z"
                                                                        fill="#FFC97A" />
                                                                </svg>
                                                                <span>2.5 mi</span>
                                                            </div>


                                                            <div class="rating" title="Rating">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                                    viewBox="0 0 14 14" fill="none">
                                                                    <path
                                                                        d="M6.12956 0.660476C6.40354 -0.220161 7.59647 -0.220158 7.87045 0.660479L8.89548 3.95519C9.01801 4.34902 9.36942 4.61566 9.76593 4.61566H13.083C13.9696 4.61566 14.3383 5.80055 13.621 6.34481L10.9374 8.38106C10.6166 8.62446 10.4824 9.0559 10.6049 9.44973L11.63 12.7444C11.9039 13.6251 10.9388 14.3574 10.2215 13.8131L7.53797 11.7769C7.21719 11.5335 6.78282 11.5335 6.46204 11.7769L3.77846 13.8131C3.06117 14.3574 2.09607 13.6251 2.37005 12.7444L3.39508 9.44973C3.51761 9.0559 3.38338 8.62446 3.0626 8.38106L0.37903 6.34481C-0.338258 5.80055 0.0303816 4.61566 0.916998 4.61566H4.23408C4.63058 4.61566 4.98199 4.34902 5.10452 3.95519L6.12956 0.660476Z"
                                                                        fill="#FFC97A" />
                                                                </svg>
                                                                <span>4.3 <small style="color:var(--muted)">(20)</small></span>
                                                            </div>
                                                        </div>
                                                    </div>



                                                    <p class="experience">Gentle, breed-specific trims · 6+ years <br> experience.</p>


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
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="21" height="22" viewBox="0 0 21 22" fill="none">
                                                            <path d="M10.9482 0.125295C10.7667 0.043205 10.5723 0 10.3692 0C10.1662 0 9.97174 0.043205 9.79028 0.125295L1.65477 3.57738C0.704262 3.97918 -0.00430085 4.91673 1.96518e-05 6.0487C0.0216222 10.3346 1.78439 18.1764 9.22861 21.7408C9.95014 22.0864 10.7883 22.0864 11.5098 21.7408C18.9541 18.1764 20.7168 10.3346 20.7384 6.0487C20.7428 4.91673 20.0342 3.97918 19.0837 3.57738L10.9482 0.125295ZM6.26043 12.3653C6.46781 12.4171 6.68816 12.443 6.91282 12.443C8.43796 12.443 9.67795 11.2031 9.67795 9.67793V6.9128H11.5876C12.1104 6.9128 12.59 7.2066 12.8233 7.67753L13.1343 8.29537H15.8995C16.2797 8.29537 16.5907 8.60644 16.5907 8.98665V10.3692C16.5907 12.2789 15.044 13.8256 13.1343 13.8256H11.0605V16.0161C11.0605 16.3315 10.8056 16.5907 10.4859 16.5907C10.4081 16.5907 10.3303 16.5734 10.2612 16.5432L5.99688 14.7156C5.71172 14.5947 5.53026 14.3138 5.53026 14.0071C5.53026 13.8861 5.55619 13.7694 5.61235 13.6614L6.26043 12.3653ZM6.22154 6.9128H8.29538V9.67793C8.29538 10.4427 7.67755 11.0605 6.91282 11.0605C6.1481 11.0605 5.53026 10.4427 5.53026 9.67793V7.60408C5.53026 7.22388 5.84134 6.9128 6.22154 6.9128ZM11.7518 8.98665C11.7518 8.80331 11.679 8.62748 11.5493 8.49784C11.4197 8.3682 11.2438 8.29537 11.0605 8.29537C10.8772 8.29537 10.7013 8.3682 10.5717 8.49784C10.4421 8.62748 10.3692 8.80331 10.3692 8.98665C10.3692 9.16998 10.4421 9.34581 10.5717 9.47545C10.7013 9.60509 10.8772 9.67793 11.0605 9.67793C11.2438 9.67793 11.4197 9.60509 11.5493 9.47545C11.679 9.34581 11.7518 9.16998 11.7518 8.98665Z" fill="#C9DDA0" />
                                                        </svg>
                                                    </div>
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 255 130" fill="none">
                                                        <defs>
                                                            <pattern id="pattern-card-5" patternUnits="userSpaceOnUse" width="255"
                                                                height="130">
                                                                <image href="<?= BASE_URL ?>/assets/images/profile_modal_image2.jpg" width="255"
                                                                    height="130" preserveAspectRatio="xMinYMax slice" />
                                                            </pattern>
                                                        </defs>

                                                        <path
                                                            d="M255 124.417C255 127.178 252.761 129.417 250 129.417H5C2.23858 129.417 0 127.178 0 124.417V37C0 34.2386 2.23858 32 5 32H27C29.7614 32 32 29.7614 32 27V5C32 2.23858 34.2386 0 37 0H250C252.761 0 255 2.23858 255 5V124.417Z"
                                                            fill="url(#pattern-card-5)" />
                                                    </svg>

                                                </div>
                                                <div class="right">
                                                    <div class="top-row">
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
                                                        <div class="d-flex align-items-center gap-10">
                                                            <div class="tags mt-3" aria-hidden="true">
                                                                <div class="tag">Home Visit</div>
                                                            </div>
                                                            <div class="tags mt-3" aria-hidden="true">
                                                                <div class="tag">Mobile Station</div>
                                                            </div>
                                                        </div>

                                                    </div>

                                                    <h2 class="name">Ken T.</h2>
                                                    <p class="hosted-by"><span>Ken’s Grooming Mobile</span></p>

                                                    <div class="studio-details mt-1 d-flex flex-column justify-content-between mt-2">

                                                        <div class="meta d-flex align-items-center justify-content-between">
                                                            <div class="distance" title="Distance">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="10" height="14"
                                                                    viewBox="0 0 10 14" fill="none">
                                                                    <path
                                                                        d="M5 6.65C4.5264 6.65 4.0722 6.46563 3.73731 6.13744C3.40242 5.80925 3.21429 5.36413 3.21429 4.9C3.21429 4.43587 3.40242 3.99075 3.73731 3.66256C4.0722 3.33437 4.5264 3.15 5 3.15C5.4736 3.15 5.9278 3.33437 6.26269 3.66256C6.59758 3.99075 6.78571 4.43587 6.78571 4.9C6.78571 5.12981 6.73953 5.35738 6.64979 5.5697C6.56004 5.78202 6.42851 5.97493 6.26269 6.13744C6.09687 6.29994 5.90002 6.42884 5.68336 6.51679C5.46671 6.60473 5.2345 6.65 5 6.65ZM5 0C3.67392 0 2.40215 0.516248 1.46447 1.43518C0.526784 2.3541 0 3.60044 0 4.9C0 8.575 5 14 5 14C5 14 10 8.575 10 4.9C10 3.60044 9.47322 2.3541 8.53553 1.43518C7.59785 0.516248 6.32608 0 5 0Z"
                                                                        fill="#FFC97A" />
                                                                </svg>
                                                                <span>2.5 mi</span>
                                                            </div>


                                                            <div class="rating" title="Rating">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                                    viewBox="0 0 14 14" fill="none">
                                                                    <path
                                                                        d="M6.12956 0.660476C6.40354 -0.220161 7.59647 -0.220158 7.87045 0.660479L8.89548 3.95519C9.01801 4.34902 9.36942 4.61566 9.76593 4.61566H13.083C13.9696 4.61566 14.3383 5.80055 13.621 6.34481L10.9374 8.38106C10.6166 8.62446 10.4824 9.0559 10.6049 9.44973L11.63 12.7444C11.9039 13.6251 10.9388 14.3574 10.2215 13.8131L7.53797 11.7769C7.21719 11.5335 6.78282 11.5335 6.46204 11.7769L3.77846 13.8131C3.06117 14.3574 2.09607 13.6251 2.37005 12.7444L3.39508 9.44973C3.51761 9.0559 3.38338 8.62446 3.0626 8.38106L0.37903 6.34481C-0.338258 5.80055 0.0303816 4.61566 0.916998 4.61566H4.23408C4.63058 4.61566 4.98199 4.34902 5.10452 3.95519L6.12956 0.660476Z"
                                                                        fill="#FFC97A" />
                                                                </svg>
                                                                <span>4.3 <small style="color:var(--muted)">(20)</small></span>
                                                            </div>
                                                        </div>
                                                    </div>



                                                    <p class="experience">Gentle, breed-specific trims · 6+ years <br> experience.</p>


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
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="21" height="22" viewBox="0 0 21 22" fill="none">
                                                            <path d="M10.9482 0.125295C10.7667 0.043205 10.5723 0 10.3692 0C10.1662 0 9.97174 0.043205 9.79028 0.125295L1.65477 3.57738C0.704262 3.97918 -0.00430085 4.91673 1.96518e-05 6.0487C0.0216222 10.3346 1.78439 18.1764 9.22861 21.7408C9.95014 22.0864 10.7883 22.0864 11.5098 21.7408C18.9541 18.1764 20.7168 10.3346 20.7384 6.0487C20.7428 4.91673 20.0342 3.97918 19.0837 3.57738L10.9482 0.125295ZM6.26043 12.3653C6.46781 12.4171 6.68816 12.443 6.91282 12.443C8.43796 12.443 9.67795 11.2031 9.67795 9.67793V6.9128H11.5876C12.1104 6.9128 12.59 7.2066 12.8233 7.67753L13.1343 8.29537H15.8995C16.2797 8.29537 16.5907 8.60644 16.5907 8.98665V10.3692C16.5907 12.2789 15.044 13.8256 13.1343 13.8256H11.0605V16.0161C11.0605 16.3315 10.8056 16.5907 10.4859 16.5907C10.4081 16.5907 10.3303 16.5734 10.2612 16.5432L5.99688 14.7156C5.71172 14.5947 5.53026 14.3138 5.53026 14.0071C5.53026 13.8861 5.55619 13.7694 5.61235 13.6614L6.26043 12.3653ZM6.22154 6.9128H8.29538V9.67793C8.29538 10.4427 7.67755 11.0605 6.91282 11.0605C6.1481 11.0605 5.53026 10.4427 5.53026 9.67793V7.60408C5.53026 7.22388 5.84134 6.9128 6.22154 6.9128ZM11.7518 8.98665C11.7518 8.80331 11.679 8.62748 11.5493 8.49784C11.4197 8.3682 11.2438 8.29537 11.0605 8.29537C10.8772 8.29537 10.7013 8.3682 10.5717 8.49784C10.4421 8.62748 10.3692 8.80331 10.3692 8.98665C10.3692 9.16998 10.4421 9.34581 10.5717 9.47545C10.7013 9.60509 10.8772 9.67793 11.0605 9.67793C11.2438 9.67793 11.4197 9.60509 11.5493 9.47545C11.679 9.34581 11.7518 9.16998 11.7518 8.98665Z" fill="#C9DDA0" />
                                                        </svg>
                                                    </div>
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 255 130" fill="none">
                                                        <defs>
                                                            <pattern id="pattern-card-6" patternUnits="userSpaceOnUse" width="255"
                                                                height="130">
                                                                <image href="<?= BASE_URL ?>/assets/images/profile_modal_image3.jpg" width="255"
                                                                    height="130" preserveAspectRatio="xMinYMax slice" />
                                                            </pattern>
                                                        </defs>

                                                        <path
                                                            d="M255 124.417C255 127.178 252.761 129.417 250 129.417H5C2.23858 129.417 0 127.178 0 124.417V37C0 34.2386 2.23858 32 5 32H27C29.7614 32 32 29.7614 32 27V5C32 2.23858 34.2386 0 37 0H250C252.761 0 255 2.23858 255 5V124.417Z"
                                                            fill="url(#pattern-card-6)" />
                                                    </svg>

                                                </div>
                                                <div class="right">
                                                    <div class="top-row">
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
                                                        <div class="tags mt-3" aria-hidden="true">
                                                            <div class="tag">Salons</div>
                                                        </div>
                                                    </div>

                                                    <h2 class="name">Cathy P.</h2>
                                                    <p class="hosted-by"><span>Cathy’s Services</span></p>

                                                    <div class="studio-details mt-1 d-flex flex-column justify-content-between mt-2">

                                                        <div class="meta d-flex align-items-center justify-content-between">
                                                            <div class="distance" title="Distance">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="10" height="14"
                                                                    viewBox="0 0 10 14" fill="none">
                                                                    <path
                                                                        d="M5 6.65C4.5264 6.65 4.0722 6.46563 3.73731 6.13744C3.40242 5.80925 3.21429 5.36413 3.21429 4.9C3.21429 4.43587 3.40242 3.99075 3.73731 3.66256C4.0722 3.33437 4.5264 3.15 5 3.15C5.4736 3.15 5.9278 3.33437 6.26269 3.66256C6.59758 3.99075 6.78571 4.43587 6.78571 4.9C6.78571 5.12981 6.73953 5.35738 6.64979 5.5697C6.56004 5.78202 6.42851 5.97493 6.26269 6.13744C6.09687 6.29994 5.90002 6.42884 5.68336 6.51679C5.46671 6.60473 5.2345 6.65 5 6.65ZM5 0C3.67392 0 2.40215 0.516248 1.46447 1.43518C0.526784 2.3541 0 3.60044 0 4.9C0 8.575 5 14 5 14C5 14 10 8.575 10 4.9C10 3.60044 9.47322 2.3541 8.53553 1.43518C7.59785 0.516248 6.32608 0 5 0Z"
                                                                        fill="#FFC97A" />
                                                                </svg>
                                                                <span>2.5 mi</span>
                                                            </div>


                                                            <div class="rating" title="Rating">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                                    viewBox="0 0 14 14" fill="none">
                                                                    <path
                                                                        d="M6.12956 0.660476C6.40354 -0.220161 7.59647 -0.220158 7.87045 0.660479L8.89548 3.95519C9.01801 4.34902 9.36942 4.61566 9.76593 4.61566H13.083C13.9696 4.61566 14.3383 5.80055 13.621 6.34481L10.9374 8.38106C10.6166 8.62446 10.4824 9.0559 10.6049 9.44973L11.63 12.7444C11.9039 13.6251 10.9388 14.3574 10.2215 13.8131L7.53797 11.7769C7.21719 11.5335 6.78282 11.5335 6.46204 11.7769L3.77846 13.8131C3.06117 14.3574 2.09607 13.6251 2.37005 12.7444L3.39508 9.44973C3.51761 9.0559 3.38338 8.62446 3.0626 8.38106L0.37903 6.34481C-0.338258 5.80055 0.0303816 4.61566 0.916998 4.61566H4.23408C4.63058 4.61566 4.98199 4.34902 5.10452 3.95519L6.12956 0.660476Z"
                                                                        fill="#FFC97A" />
                                                                </svg>
                                                                <span>4.3 <small style="color:var(--muted)">(20)</small></span>
                                                            </div>
                                                        </div>
                                                    </div>



                                                    <p class="experience">Gentle, breed-specific trims · 6+ years <br> experience.</p>


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
                                <div id="modal-map" style="width:100%; height:565px; border-radius:10px;"></div>
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
                        <div class="meta">
                            <h1>The Garden Grooming Spot</h1>
                            <div class="owner">Dev Émile</div>

                            <div style="display:flex; align-items:center; gap:12px;">
                                <div class="tags-row gap mt-2">
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
                                    <span class="pill security-verified">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="8" height="10" viewBox="0 0 8 10" fill="none">
                                            <path d="M4 7.61905C3.73478 7.61905 3.48043 7.51871 3.29289 7.3401C3.10536 7.1615 3 6.91925 3 6.66667C3 6.1381 3.445 5.71429 4 5.71429C4.26522 5.71429 4.51957 5.81463 4.70711 5.99323C4.89464 6.17184 5 6.41408 5 6.66667C5 6.91925 4.89464 7.1615 4.70711 7.3401C4.51957 7.51871 4.26522 7.61905 4 7.61905ZM7 9.04762V4.28571H1V9.04762H7ZM7 3.33333C7.26522 3.33333 7.51957 3.43367 7.70711 3.61228C7.89464 3.79089 8 4.03313 8 4.28571V9.04762C8 9.30021 7.89464 9.54245 7.70711 9.72105C7.51957 9.89966 7.26522 10 7 10H1C0.734784 10 0.48043 9.89966 0.292893 9.72105C0.105357 9.54245 0 9.30021 0 9.04762V4.28571C0 3.75714 0.445 3.33333 1 3.33333H1.5V2.38095C1.5 1.74948 1.76339 1.14388 2.23223 0.697365C2.70107 0.25085 3.33696 0 4 0C4.3283 0 4.65339 0.0615852 4.95671 0.181239C5.26002 0.300893 5.53562 0.476273 5.76777 0.697365C5.99991 0.918457 6.18406 1.18093 6.3097 1.4698C6.43534 1.75867 6.5 2.06828 6.5 2.38095V3.33333H7ZM4 0.952381C3.60218 0.952381 3.22064 1.10289 2.93934 1.3708C2.65804 1.63871 2.5 2.00207 2.5 2.38095V3.33333H5.5V2.38095C5.5 2.00207 5.34196 1.63871 5.06066 1.3708C4.77936 1.10289 4.39782 0.952381 4 0.952381Z" fill="white" />
                                        </svg>
                                        Security Verified
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
                                <span class="add-to-fav">Add to Favourites</span>
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
                        <img src="<?= BASE_URL ?>/assets/images/space_profile_1.png"
                            alt="Front Entrance"
                            data-desc="Clear signage and easy access, so drop-off and pick-up are smooth and stress-free.">
                    </div>

                    <div class="image-grid-item large-image" style="grid-area: img-2;">
                        <img src="<?= BASE_URL ?>/assets/images/space_profile_2.png"
                            alt="Space Image 2"
                            data-desc="Well-organized grooming station with professional tools and a hygienic setup.">
                    </div>

                    <div class="image-grid-item small-image" style="grid-area: img-3;">
                        <img src="<?= BASE_URL ?>/assets/images/space_profile_3.png"
                            alt="Space Image 3"
                            data-desc="Comfortable grooming area designed to keep pets relaxed during sessions.">
                    </div>

                    <div class="image-grid-item small-image" style="grid-area: img-4;">
                        <img src="<?= BASE_URL ?>/assets/images/space_profile_4.png"
                            alt="Space Image 4"
                            data-desc="Professional grooming environment focused on hygiene and precision care.">
                    </div>

                    <div class="image-grid-item small-image last-image-text" style="grid-area: img-5;">
                        <img src="<?= BASE_URL ?>/assets/images/space_profile_5.png"
                            alt="Space Image 5"
                            data-desc="Final overview of a premium grooming space built for comfort and efficiency.">

                        <p class="show-all-pics">
                            <svg xmlns="http://www.w3.org/2000/svg" width="11" height="11" viewBox="0 0 11 11" fill="none">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M9.77778 4.88889C10.0861 4.88879 10.3831 5.00525 10.6092 5.21491C10.8353 5.42458 10.9738 5.71196 10.9969 6.01944L11 6.11111V9.77778C11.0001 10.0861 10.8836 10.3831 10.674 10.6092C10.4643 10.8353 10.1769 10.9738 9.86944 10.9969L9.77778 11H7.33333C7.02498 11.0001 6.72799 10.8836 6.50189 10.674C6.27579 10.4643 6.13729 10.1769 6.11417 9.86944L6.11111 9.77778V6.11111C6.11101 5.80276 6.22747 5.50576 6.43714 5.27966C6.6468 5.05357 6.93418 4.91507 7.24167 4.89194L7.33333 4.88889H9.77778ZM3.66667 7.33333C3.99082 7.33333 4.3017 7.4621 4.53091 7.69131C4.76012 7.92053 4.88889 8.2314 4.88889 8.55556V9.77778C4.88889 10.1019 4.76012 10.4128 4.53091 10.642C4.3017 10.8712 3.99082 11 3.66667 11H1.22222C0.898069 11 0.587192 10.8712 0.357981 10.642C0.128769 10.4128 0 10.1019 0 9.77778V8.55556C0 8.2314 0.128769 7.92053 0.357981 7.69131C0.587192 7.4621 0.898069 7.33333 1.22222 7.33333H3.66667ZM3.66667 0C3.99082 0 4.3017 0.128769 4.53091 0.357981C4.76012 0.587192 4.88889 0.898069 4.88889 1.22222V4.88889C4.88889 5.21304 4.76012 5.52392 4.53091 5.75313C4.3017 5.98234 3.99082 6.11111 3.66667 6.11111H1.22222C0.898069 6.11111 0.587192 5.98234 0.357981 5.75313C0.128769 5.52392 0 5.21304 0 4.88889V1.22222C0 0.898069 0.128769 0.587192 0.357981 0.357981C0.587192 0.128769 0.898069 0 1.22222 0H3.66667ZM9.77778 0C10.1019 0 10.4128 0.128769 10.642 0.357981C10.8712 0.587192 11 0.898069 11 1.22222V2.44444C11 2.7686 10.8712 3.07947 10.642 3.30869C10.4128 3.5379 10.1019 3.66667 9.77778 3.66667H7.33333C7.00918 3.66667 6.6983 3.5379 6.46909 3.30869C6.23988 3.07947 6.11111 2.7686 6.11111 2.44444V1.22222C6.11111 0.898069 6.23988 0.587192 6.46909 0.357981C6.6983 0.128769 7.00918 0 7.33333 0H9.77778Z"
                                    fill="white" />
                            </svg>
                            Show all photos
                        </p>
                    </div>

                </div>
            </div>
        </div>

        <div class="lb-overlay" id="lbOverlay" onclick="handleBgClick(event)">
            <div class="lb-modal" id="lbModal">
                <div class="lb-header">
                    <div class="lb-title-block">
                        <span class="lb-title">The Garden Grooming Spot</span>
                        <span class="lb-subtitle">Dev Émile</span>
                    </div>

                    <div class="lb-header-right">

                        <svg class="cursor" onclick="closeLb()" xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 36 36" fill="none">
                            <circle cx="18" cy="18" r="17" stroke="white" stroke-width="2" />
                            <path d="M12.7998 23.9998L23.9998 12.7998M12.7998 12.7998L23.9998 23.9998" stroke="white" stroke-width="2" stroke-linecap="round" />
                        </svg>
                    </div>
                </div>

                <div class="lb-image-wrap">
                    <img id="lbImg" src="" alt="">
                </div>

                <div class="lb-nav-bar">
                    <svg class="cursor" onclick="slide(-1)" xmlns="http://www.w3.org/2000/svg" width="13" height="24" viewBox="0 0 13 24" fill="none">
                        <path d="M11.8719 22.5615L1 11.6897L11.6894 1.00031" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>

                    <div class="lb-caption-block">
                        <div class="lb-cap-title" id="lbTitle"></div>
                        <div class="lb-cap-desc" id="lbDesc"></div>
                    </div>

                    <div class="lb-count" id="lbCount"></div>

                    <svg class="cursor" onclick="slide(1)" xmlns="http://www.w3.org/2000/svg" width="13" height="24" viewBox="0 0 13 24" fill="none">
                        <path d="M1 22.5615L11.8719 11.6897L1.18251 1.00031" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </div>

                <div class="lb-thumbs" id="lbThumbs"></div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8">
                <div class="service-content mt-4 mb-5">
                    <div class="service-content-header">
                        <h2 class="section-content-heading">About Me</h2>
                        <div class="avatar-wrap d-flex align-items-center mt-3">
                            <p>A bright, clean, fully equipped grooming outdoor space ideal for professional use. Outdoor garden grooming area. Calm, spacious, and ideal for stress-free sessions in fresh air.
                            </p>
                        </div>
                    </div>
                    <div class="tab-go-to-section less-gap d-flex align-items-center flex-wrap justify-content-between mt-5">
                        <a href="#services_and_pricing" class="active">Services & Add-ons</a>
                        <a href="#amenities">Amenities</a>
                        <a href="#rules_and_restrictions">Rules & Restrictions</a>
                        <a href="#reviews">Reviews</a>
                        <a href="#location">Location</a>
                    </div>
                    <div id="services_and_pricing" class="mt-5 section-offset">
                        <h2 class="section-content-heading">Services & Pricing</h2>
                        <div class="services-list d-flex align-items-center justify-content-between mt-4">
                            <div class="service-list-left d-flex align-items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="22" viewBox="0 0 26 22" fill="none">
                                    <path d="M10.9401 0C15.9387 0 20.1532 3.35263 21.4601 7.93179C21.5815 8.35738 21.2287 8.75207 20.7861 8.75207C20.6431 8.75207 20.5181 8.65675 20.4831 8.5181C19.4037 4.25167 15.5419 1.09401 10.9401 1.09401C5.50224 1.09401 1.09401 5.50225 1.09401 10.9401C1.09401 15.8782 4.72947 19.9655 9.46984 20.6752C9.71705 20.7122 9.912 20.9111 9.94481 21.1589C9.99054 21.5043 9.71174 21.8142 9.36694 21.7645C4.07035 21.0019 0 16.4479 0 10.9401C0 4.89805 4.89804 0 10.9401 0Z" fill="#3B3731" />
                                    <path d="M22.3843 17.0281C22.6177 16.7911 22.8748 16.5996 23.1556 16.4538C23.44 16.3079 23.7664 16.235 24.1347 16.235C24.441 16.235 24.7091 16.286 24.9388 16.3881C25.1722 16.4902 25.3673 16.6343 25.5241 16.8203C25.6809 17.0026 25.7994 17.2232 25.8796 17.4821C25.9599 17.7411 26 18.0273 26 18.3409V21.8801H24.9279V18.3409C24.9279 17.9435 24.8367 17.6353 24.6544 17.4165C24.472 17.1941 24.193 17.0828 23.8174 17.0828C23.5439 17.0828 23.2868 17.1485 23.0462 17.2798C22.8091 17.4074 22.5885 17.5824 22.3843 17.8049V21.8801H21.3176V13.8063H22.3843V17.0281Z" fill="#3B3731" />
                                    <path d="M19.8125 21.0651V21.8802H15.5677V21.0651H17.2306V15.9178C17.2306 15.7537 17.2361 15.5842 17.247 15.4091L15.9124 16.5414C15.8613 16.5815 15.8102 16.6071 15.7592 16.618C15.7081 16.6289 15.6589 16.6308 15.6115 16.6235C15.5677 16.6162 15.5276 16.6016 15.4912 16.5797C15.4583 16.5542 15.431 16.5287 15.4091 16.5031L15.0754 16.0382L17.4276 14.0088H18.2973V21.0651H19.8125Z" fill="#3B3731" />
                                    <path d="M11.487 7.65809C11.487 7.35599 11.7319 7.11108 12.034 7.11108C12.3361 7.11108 12.581 7.35599 12.581 7.65809V12.5811H8.75196C8.44986 12.5811 8.20496 12.3362 8.20496 12.0341C8.20496 11.732 8.44986 11.4871 8.75196 11.4871H11.487V7.65809Z" fill="#3B3731" />
                                </svg>
                                &nbsp;
                                &nbsp;
                                <p>Hourly</p>
                            </div>
                            <div class="service-list-right">
                                <div class="price space d-flex align-items-center">
                                    <p>£25</p><span> / </span> <span>Hourly</span>
                                </div>
                            </div>
                        </div>
                        <div class="services-list d-flex align-items-center justify-content-between mt-4">
                            <div class="service-list-left d-flex align-items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="22" viewBox="0 0 26 22" fill="none">
                                    <path d="M10.94 0C15.9386 0 20.1531 3.35262 21.4599 7.93175C21.5813 8.35734 21.2285 8.75203 20.786 8.75203C20.643 8.75203 20.518 8.65671 20.4829 8.51806C19.4036 4.25165 15.5418 1.094 10.94 1.094C5.5022 1.094 1.094 5.50222 1.094 10.94C1.094 15.8781 4.72943 19.9654 9.46977 20.6751C9.71697 20.7121 9.91192 20.911 9.94473 21.1588C9.99046 21.5042 9.71166 21.8141 9.36686 21.7644C4.07032 21.0018 0 16.4478 0 10.94C0 4.89802 4.898 0 10.94 0Z" fill="#3B3731" />
                                    <path d="M22.3842 17.0281C22.6175 16.7911 22.8746 16.5996 23.1554 16.4538C23.4399 16.3079 23.7662 16.235 24.1346 16.235C24.4409 16.235 24.7089 16.286 24.9386 16.3881C25.172 16.4902 25.3671 16.6343 25.5239 16.8203C25.6807 17.0026 25.7993 17.2232 25.8795 17.4821C25.9597 17.741 25.9998 18.0273 25.9998 18.3409V21.88H24.9277V18.3409C24.9277 17.9434 24.8365 17.6353 24.6542 17.4165C24.4719 17.194 24.1929 17.0828 23.8173 17.0828C23.5438 17.0828 23.2867 17.1485 23.046 17.2797C22.809 17.4074 22.5884 17.5824 22.3842 17.8049V21.88H21.3175V13.8063H22.3842V17.0281Z" fill="#3B3731" />
                                    <path d="M18.1931 19.0137V15.9504C18.1931 15.8447 18.1949 15.7335 18.1986 15.6168C18.2059 15.4964 18.2186 15.3724 18.2369 15.2448L15.4854 19.0137H18.1931ZM20.2662 19.0137V19.6318C20.2662 19.6938 20.2462 19.7466 20.206 19.7904C20.1659 19.8342 20.1094 19.856 20.0365 19.856H19.1285V21.88H18.1931V19.856H14.747C14.6668 19.856 14.5993 19.8342 14.5446 19.7904C14.4899 19.743 14.4534 19.6846 14.4352 19.6154L14.3258 19.0684L18.122 14.0195H19.1285V19.0137H20.2662Z" fill="#3B3731" />
                                    <path d="M11.487 7.65809C11.487 7.35599 11.7319 7.11108 12.034 7.11108C12.3361 7.11108 12.581 7.35599 12.581 7.65809V12.5811H8.75196C8.44986 12.5811 8.20496 12.3362 8.20496 12.0341C8.20496 11.732 8.44986 11.4871 8.75196 11.4871H11.487V7.65809Z" fill="#3B3731" />
                                </svg>
                                &nbsp;
                                &nbsp;
                                <p>Half-Day (4 hours)</p>
                            </div>
                            <div class="service-list-right">
                                <div class="price space d-flex align-items-center">
                                    <p>£25</p><span> / </span> <span>Hourly</span>
                                </div>
                            </div>
                        </div>
                        <div class="services-list d-flex align-items-center justify-content-between mt-4">
                            <div class="service-list-left d-flex align-items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="22" viewBox="0 0 26 22" fill="none">
                                    <path d="M10.9401 0C15.9387 0 20.1532 3.35263 21.46 7.93179C21.5815 8.35737 21.2287 8.75207 20.7861 8.75207C20.6431 8.75207 20.5181 8.65675 20.4831 8.51809C19.4037 4.25167 15.5419 1.09401 10.9401 1.09401C5.50224 1.09401 1.09401 5.50225 1.09401 10.9401C1.09401 15.8782 4.72946 19.9655 9.46984 20.6752C9.71704 20.7122 9.91199 20.9111 9.9448 21.1589C9.99053 21.5042 9.71173 21.8142 9.36693 21.7645C4.07035 21.0019 0 16.4479 0 10.9401C0 4.89804 4.89803 0 10.9401 0Z" fill="#3B3731" />
                                    <path d="M22.3843 17.0281C22.6177 16.7911 22.8748 16.5996 23.1556 16.4538C23.44 16.3079 23.7664 16.235 24.1347 16.235C24.441 16.235 24.709 16.286 24.9388 16.3881C25.1722 16.4902 25.3673 16.6343 25.5241 16.8203C25.6809 17.0026 25.7994 17.2232 25.8796 17.4821C25.9599 17.7411 26 18.0273 26 18.3409V21.8801H24.9279V18.3409C24.9279 17.9435 24.8367 17.6353 24.6543 17.4165C24.472 17.1941 24.193 17.0828 23.8174 17.0828C23.5439 17.0828 23.2868 17.1485 23.0462 17.2798C22.8091 17.4074 22.5885 17.5824 22.3843 17.8049V21.8801H21.3176V13.8063H22.3843V17.0281Z" fill="#3B3731" />
                                    <path d="M17.3947 21.1199C17.6427 21.1199 17.8633 21.0853 18.0566 21.016C18.2499 20.9467 18.414 20.8501 18.5489 20.7261C18.6838 20.5984 18.7859 20.4471 18.8552 20.2721C18.9245 20.097 18.9591 19.9056 18.9591 19.6977C18.9591 19.4424 18.9172 19.2236 18.8333 19.0413C18.7495 18.8553 18.6364 18.704 18.4942 18.5873C18.352 18.4669 18.1861 18.3794 17.9964 18.3247C17.8068 18.2664 17.6062 18.2372 17.3947 18.2372C17.1796 18.2372 16.9772 18.2664 16.7875 18.3247C16.5979 18.3794 16.432 18.4669 16.2898 18.5873C16.1476 18.704 16.0345 18.8553 15.9506 19.0413C15.8704 19.2236 15.8303 19.4424 15.8303 19.6977C15.8303 19.9056 15.8649 20.097 15.9342 20.2721C16.0035 20.4471 16.1056 20.5984 16.2405 20.7261C16.3755 20.8501 16.5396 20.9467 16.7328 21.016C16.9261 21.0853 17.1467 21.1199 17.3947 21.1199ZM17.3947 14.7583C17.1686 14.7583 16.9699 14.7929 16.7985 14.8622C16.6307 14.9278 16.4903 15.019 16.3773 15.1357C16.2642 15.2524 16.1785 15.3873 16.1202 15.5405C16.0655 15.6936 16.0382 15.8577 16.0382 16.0328C16.0382 16.2042 16.0619 16.3719 16.1093 16.536C16.1603 16.6965 16.2387 16.8405 16.3445 16.9681C16.4539 17.0921 16.5943 17.1924 16.7657 17.269C16.9371 17.3456 17.1467 17.3839 17.3947 17.3839C17.639 17.3839 17.8469 17.3456 18.0183 17.269C18.1933 17.1924 18.3337 17.0921 18.4395 16.9681C18.5489 16.8405 18.6273 16.6965 18.6747 16.536C18.7258 16.3719 18.7513 16.2042 18.7513 16.0328C18.7513 15.8577 18.7221 15.6936 18.6638 15.5405C18.6091 15.3873 18.5252 15.2524 18.4121 15.1357C18.2991 15.019 18.1569 14.9278 17.9855 14.8622C17.8177 14.7929 17.6208 14.7583 17.3947 14.7583ZM18.5708 17.7832C19.0594 17.9291 19.4296 18.1643 19.6812 18.4888C19.9365 18.8134 20.0641 19.2236 20.0641 19.7196C20.0641 20.0624 19.9985 20.3723 19.8672 20.6495C19.7395 20.9266 19.5572 21.1637 19.3202 21.3606C19.0868 21.5539 18.806 21.7034 18.4778 21.8091C18.1496 21.9149 17.7886 21.9678 17.3947 21.9678C17.0009 21.9678 16.6399 21.9149 16.3117 21.8091C15.9834 21.7034 15.7008 21.5539 15.4638 21.3606C15.2304 21.1637 15.0481 20.9266 14.9168 20.6495C14.7892 20.3723 14.7253 20.0624 14.7253 19.7196C14.7253 19.2236 14.8512 18.8134 15.1028 18.4888C15.358 18.1643 15.73 17.9291 16.2187 17.7832C15.8139 17.63 15.5094 17.4021 15.3052 17.0994C15.101 16.7931 14.9988 16.4303 14.9988 16.0109C14.9988 15.7192 15.0554 15.4475 15.1684 15.1959C15.2851 14.9406 15.4474 14.72 15.6552 14.534C15.8668 14.348 16.1202 14.2021 16.4156 14.0964C16.711 13.9906 17.0373 13.9377 17.3947 13.9377C17.7521 13.9377 18.0785 13.9906 18.3739 14.0964C18.6692 14.2021 18.9209 14.348 19.1287 14.534C19.3402 14.72 19.5025 14.9406 19.6156 15.1959C19.7322 15.4475 19.7906 15.7192 19.7906 16.0109C19.7906 16.4303 19.6885 16.7931 19.4843 17.0994C19.2801 17.4021 18.9756 17.63 18.5708 17.7832Z" fill="#3B3731" />
                                    <path d="M11.487 7.65809C11.487 7.35599 11.7319 7.11108 12.034 7.11108C12.3361 7.11108 12.581 7.35599 12.581 7.65809V12.5811H8.75196C8.44986 12.5811 8.20496 12.3362 8.20496 12.0341C8.20496 11.732 8.44986 11.4871 8.75196 11.4871H11.487V7.65809Z" fill="#3B3731" />
                                </svg>
                                &nbsp;
                                &nbsp;
                                <p>Full-Day (8 hours)</p>
                            </div>
                            <div class="service-list-right">
                                <div class="price space d-flex align-items-center">
                                    <p>£25</p><span> / </span> <span> Hourly</span>
                                </div>
                            </div>
                        </div>

                        <h2 class="section-content-heading mt-5">Add-on Services</h2>

                        <div class="services-list no-bg-border d-flex align-items-center justify-content-between mt-4">
                            <div class="service-list-left d-flex align-items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="23" viewBox="0 0 26 23" fill="none">
                                    <path d="M21.4783 4.3125C21.4783 4.43958 21.4187 4.56146 21.3127 4.65132C21.2067 4.74118 21.0629 4.79167 20.913 4.79167H17.5217C17.3718 4.79167 17.2281 4.74118 17.1221 4.65132C17.0161 4.56146 16.9565 4.43958 16.9565 4.3125C16.9565 4.18542 17.0161 4.06354 17.1221 3.97368C17.2281 3.88382 17.3718 3.83333 17.5217 3.83333H20.913C21.0629 3.83333 21.2067 3.88382 21.3127 3.97368C21.4187 4.06354 21.4783 4.18542 21.4783 4.3125ZM20.913 7.66667H17.5217C17.3718 7.66667 17.2281 7.71715 17.1221 7.80701C17.0161 7.89687 16.9565 8.01875 16.9565 8.14583C16.9565 8.27292 17.0161 8.39479 17.1221 8.48466C17.2281 8.57452 17.3718 8.625 17.5217 8.625H20.913C21.0629 8.625 21.2067 8.57452 21.3127 8.48466C21.4187 8.39479 21.4783 8.27292 21.4783 8.14583C21.4783 8.01875 21.4187 7.89687 21.3127 7.80701C21.2067 7.71715 21.0629 7.66667 20.913 7.66667ZM5.08696 4.79167H8.47826C8.62817 4.79167 8.77193 4.74118 8.87793 4.65132C8.98393 4.56146 9.04348 4.43958 9.04348 4.3125C9.04348 4.18542 8.98393 4.06354 8.87793 3.97368C8.77193 3.88382 8.62817 3.83333 8.47826 3.83333H5.08696C4.93705 3.83333 4.79329 3.88382 4.68729 3.97368C4.58129 4.06354 4.52174 4.18542 4.52174 4.3125C4.52174 4.43958 4.58129 4.56146 4.68729 4.65132C4.79329 4.74118 4.93705 4.79167 5.08696 4.79167ZM8.47826 7.66667H5.08696C4.93705 7.66667 4.79329 7.71715 4.68729 7.80701C4.58129 7.89687 4.52174 8.01875 4.52174 8.14583C4.52174 8.27292 4.58129 8.39479 4.68729 8.48466C4.79329 8.57452 4.93705 8.625 5.08696 8.625H8.47826C8.62817 8.625 8.77193 8.57452 8.87793 8.48466C8.98393 8.39479 9.04348 8.27292 9.04348 8.14583C9.04348 8.01875 8.98393 7.89687 8.87793 7.80701C8.77193 7.71715 8.62817 7.66667 8.47826 7.66667ZM26 1.4375V22.5208C26 22.6479 25.9405 22.7698 25.8345 22.8597C25.7285 22.9495 25.5847 23 25.4348 23C25.2849 23 25.1411 22.9495 25.0351 22.8597C24.9291 22.7698 24.8696 22.6479 24.8696 22.5208V20.125H13.5652V22.5208C13.5652 22.6479 13.5057 22.7698 13.3997 22.8597C13.2937 22.9495 13.1499 23 13 23C12.8501 23 12.7063 22.9495 12.6003 22.8597C12.4943 22.7698 12.4348 22.6479 12.4348 22.5208V20.125H1.13043V22.5208C1.13043 22.6479 1.07089 22.7698 0.964886 22.8597C0.858887 22.9495 0.715122 23 0.565217 23C0.415312 23 0.271547 22.9495 0.165548 22.8597C0.0595496 22.7698 0 22.6479 0 22.5208V1.4375C0 1.05625 0.178648 0.690617 0.496645 0.421034C0.814641 0.15145 1.24594 0 1.69565 0H24.3043C24.7541 0 25.1854 0.15145 25.5034 0.421034C25.8214 0.690617 26 1.05625 26 1.4375ZM12.4348 19.1667V0.958333H1.69565C1.54575 0.958333 1.40198 1.00882 1.29598 1.09868C1.18998 1.18854 1.13043 1.31042 1.13043 1.4375V19.1667H12.4348ZM13.5652 19.1667H24.8696V1.4375C24.8696 1.31042 24.81 1.18854 24.704 1.09868C24.598 1.00882 24.4543 0.958333 24.3043 0.958333H13.5652V19.1667Z" fill="#3B3731" />
                                </svg>
                                &nbsp;
                                &nbsp;
                                <p>Storage Locker</p>
                            </div>
                            <div class="service-list-right">
                                <div class="price space d-flex align-items-center">
                                    <p>£5</p><span> / </span> <span> day</span>
                                </div>
                            </div>
                        </div>
                        <div class="services-list no-bg-border d-flex align-items-center justify-content-between mt-4">
                            <div class="service-list-left d-flex align-items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 26 26" fill="none">
                                    <path d="M25.1356 0.157339C25.3249 -0.0437372 25.6416 -0.0533737 25.8427 0.135855C26.0437 0.325102 26.0534 0.641795 25.8641 0.842883L15.0369 12.3448C15.4974 12.8008 15.8389 13.1434 16.0466 13.5655L16.1326 13.7676L16.1336 13.7686C16.3358 14.3217 16.2842 14.8207 16.2214 15.5528C15.911 19.1627 14.6773 21.7425 13.5105 23.4248C12.9279 24.2648 12.363 24.8796 11.9401 25.2871C11.7286 25.4909 11.5519 25.6434 11.4265 25.7461C11.3639 25.7973 11.3135 25.8364 11.278 25.8633C11.2604 25.8766 11.2462 25.8871 11.236 25.8945L11.2204 25.9062L11.2184 25.9072V25.9082L10.9284 25.5L11.2175 25.9082C11.0989 25.9921 10.9493 26.0203 10.8083 25.9853C7.96118 25.2801 5.42094 24.0342 3.50741 21.7793C1.59497 19.5256 0.354279 16.3173 0.00150955 11.7725C-0.0118332 11.6006 0.0639331 11.4335 0.202684 11.3311C0.341519 11.2287 0.523768 11.2051 0.684135 11.2686C3.33074 12.3176 5.95486 12.5365 9.27311 11.2628C10.0564 10.9625 10.6744 10.7254 11.1716 10.5821C11.6674 10.4392 12.1115 10.368 12.5349 10.4551H12.5378C12.9508 10.5422 13.3021 10.7542 13.6628 11.0469C13.8642 11.2104 14.0808 11.4114 14.323 11.6446L25.1356 0.157339ZM12.3337 11.4346C12.1504 11.3969 11.8953 11.4141 11.4479 11.543C11.2249 11.6073 10.9708 11.6939 10.6725 11.8028L9.63152 12.1963C6.37382 13.4468 3.68812 13.3588 1.06891 12.4727C1.48508 16.4533 2.63665 19.2069 4.27012 21.1319C5.95651 23.1191 8.19967 24.2721 10.8141 24.9531C10.9192 24.8662 11.0678 24.7389 11.2458 24.5674C11.6274 24.1996 12.1487 23.6337 12.6892 22.8545C13.7684 21.2983 14.9316 18.8829 15.2253 15.4668C15.293 14.6779 15.3052 14.418 15.1941 14.1133C15.1105 13.887 14.9712 13.7049 14.6326 13.3565L14.2214 12.9444C13.7031 12.4317 13.3404 12.0729 13.0329 11.8233C12.733 11.5798 12.5267 11.4747 12.3337 11.4337V11.4346Z" fill="#3B3731" />
                                    <path d="M9.22351 16.7723C9.44201 16.6036 9.75589 16.6437 9.92469 16.8621C10.0934 17.0806 10.0533 17.3945 9.83484 17.5633C8.01569 18.9676 6.19097 19.4966 4.81818 19.6726C4.13281 19.7605 3.55961 19.7606 3.15409 19.7381C2.95117 19.7268 2.7894 19.7107 2.67655 19.6961C2.6203 19.6888 2.57612 19.6816 2.54471 19.6765C2.529 19.674 2.51578 19.6713 2.50663 19.6697C2.50228 19.6689 2.49867 19.6683 2.49588 19.6678C2.49445 19.6675 2.49299 19.6679 2.49198 19.6678L2.491 19.6668H2.49002C2.21891 19.6143 2.04105 19.352 2.09353 19.0808C2.14607 18.8099 2.40851 18.633 2.67948 18.6853H2.68241C2.68661 18.6861 2.69431 18.6875 2.70487 18.6892C2.72595 18.6927 2.7594 18.6981 2.80448 18.7039C2.89508 18.7156 3.03291 18.7302 3.20976 18.74C3.56369 18.7597 4.0751 18.7605 4.69122 18.6814C5.92256 18.5235 7.57049 18.0483 9.22351 16.7723Z" fill="#3B3731" />
                                    <path d="M7.63969 6.40392C7.63969 6.07619 7.50907 5.76169 7.27738 5.5299C7.04562 5.29814 6.73111 5.16766 6.40335 5.1676C6.07551 5.1676 5.76113 5.29809 5.52931 5.5299C5.2975 5.76172 5.167 6.07608 5.167 6.40392C5.16706 6.73168 5.29755 7.04618 5.52931 7.27794C5.76111 7.50962 6.07561 7.64024 6.40335 7.64024C6.73111 7.64019 7.04562 7.5097 7.27738 7.27794C7.50915 7.04618 7.63964 6.73168 7.63969 6.40392ZM8.63971 6.40392C8.63965 6.99689 8.40373 7.56567 7.98442 7.98497C7.56512 8.40427 6.99633 8.64018 6.40335 8.64024C5.81039 8.64024 5.24161 8.40418 4.82227 7.98497C4.40297 7.56567 4.16705 6.99689 4.16699 6.40392C4.16699 5.81087 4.40292 5.24222 4.82227 4.82287C5.24163 4.40352 5.81029 4.1676 6.40335 4.1676C6.99633 4.16766 7.56512 4.40357 7.98442 4.82287C8.40365 5.2422 8.63971 5.81097 8.63971 6.40392Z" fill="#3B3731" />
                                    <path d="M11.1115 2.02771V1.88904C11.1115 1.61289 11.3353 1.38904 11.6115 1.38904C11.8876 1.38904 12.1115 1.61289 12.1115 1.88904V2.02771C12.1115 2.30385 11.8876 2.5277 11.6115 2.5277C11.3353 2.5277 11.1115 2.30385 11.1115 2.02771Z" fill="#3B3731" />
                                </svg>
                                &nbsp;
                                &nbsp;
                                <p>Deep Clean</p>
                            </div>
                            <div class="service-list-right">
                                <div class="price space d-flex align-items-center">
                                    <p>£10</p>
                                </div>
                            </div>
                        </div>
                        <div class="services-list no-bg-border d-flex align-items-center justify-content-between mt-4">
                            <div class="service-list-left d-flex align-items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 26 26" fill="none">
                                    <path d="M25.3158 24.6316C25.6937 24.6316 26 24.9379 26 25.3158C26 25.6937 25.6937 26 25.3158 26H0.684211C0.306331 26 0 25.6937 0 25.3158C0 24.9379 0.306331 24.6316 0.684211 24.6316H25.3158ZM2.05263 19.1579C2.43051 19.1579 2.73684 19.4642 2.73684 19.8421C2.73684 20.22 2.43051 20.5263 2.05263 20.5263H0.684211C0.306331 20.5263 0 20.22 0 19.8421C0 19.4642 0.306331 19.1579 0.684211 19.1579H2.05263ZM17.7895 19.8421C17.7895 18.5719 17.2845 17.354 16.3863 16.4558C15.4881 15.5576 14.2702 15.0526 13 15.0526C11.7298 15.0526 10.5119 15.5576 9.61369 16.4558C8.71549 17.354 8.21053 18.5719 8.21053 19.8421C8.21053 20.22 7.90419 20.5263 7.52632 20.5263C7.14844 20.5263 6.84211 20.22 6.84211 19.8421C6.84211 18.2089 7.49135 16.6431 8.64618 15.4883C9.80101 14.3335 11.3668 13.6842 13 13.6842C14.6332 13.6842 16.199 14.3335 17.3538 15.4883C18.5087 16.6431 19.1579 18.2089 19.1579 19.8421C19.1579 20.22 18.8516 20.5263 18.4737 20.5263C18.0958 20.5263 17.7895 20.22 17.7895 19.8421ZM25.3158 19.1579C25.6937 19.1579 26 19.4642 26 19.8421C26 20.22 25.6937 20.5263 25.3158 20.5263H23.9474C23.5695 20.5263 23.2632 20.22 23.2632 19.8421C23.2632 19.4642 23.5695 19.1579 23.9474 19.1579H25.3158ZM3.75781 10.5999C4.02484 10.3329 4.45809 10.3333 4.72533 10.5999L5.68349 11.5581C5.95069 11.8253 5.95069 12.2584 5.68349 12.5256C5.41629 12.7928 4.98318 12.7928 4.71597 12.5256L3.75781 11.5674C3.49115 11.3002 3.49079 10.8669 3.75781 10.5999ZM21.2747 10.5999C21.5419 10.3333 21.9752 10.3329 22.2422 10.5999C22.5092 10.8669 22.5089 11.3002 22.2422 11.5674L21.284 12.5256C21.0168 12.7928 20.5837 12.7928 20.3165 12.5256C20.0493 12.2584 20.0493 11.8253 20.3165 11.5581L21.2747 10.5999ZM12.3158 0.684211C12.3158 0.306331 12.6221 0 13 0C13.3779 0 13.6842 0.306331 13.6842 0.684211V7.24301L16.6215 4.30572C16.8887 4.03851 17.3218 4.03851 17.589 4.30572C17.8562 4.57292 17.8562 5.00603 17.589 5.27323L13.4838 9.3785C13.2166 9.6457 12.7834 9.6457 12.5162 9.3785L8.41098 5.27323C8.14378 5.00603 8.14378 4.57292 8.41098 4.30572C8.67818 4.03851 9.11129 4.03851 9.3785 4.30572L12.3158 7.24301V0.684211Z" fill="#3B3731" />
                                </svg>
                                &nbsp;
                                &nbsp;
                                <p>After-hours access</p>
                            </div>
                            <div class="service-list-right">
                                <div class="price space d-flex align-items-center">
                                    <p>£20</p>
                                </div>
                            </div>
                        </div>

                        <h2 class="section-content-heading mt-5">Suitable For</h2>

                        <div class="add-on-services d-flex align-items-center mt-4 flex-wrap">
                            <div class="selected-item">
                                Full Groom
                            </div>
                            <div class="selected-item">
                                Bath & Brush
                            </div>
                            <div class="selected-item">
                                Nail Trim
                            </div>
                            <div class="selected-item">
                                Ear Cleaning
                            </div>
                            <div class="selected-item">
                                Tear-Stain Treatment
                            </div>
                            <div class="selected-item">
                                Deshedding
                            </div>
                            <div class="selected-item">
                                Dematting
                            </div>
                            <div class="selected-item">
                                Medicated / Sensitive Skin Bath
                            </div>
                            <div class="selected-item">
                                Sanitary Trim
                            </div>
                            <div class="selected-item">
                                Paw Pad Trim
                            </div>
                            <div class="selected-item">
                                Teeth Brushing
                            </div>
                            <div class="selected-item">
                                Anal Gland Expression
                            </div>
                            <div class="selected-item">
                                Paw Balm
                            </div>
                            <div class="selected-item">
                                Perfume
                            </div>
                            <div class="selected-item">
                                Bandana / Bow
                            </div>
                        </div>

                    </div>

                    <div id="rules_and_restrictions" class="mt-5 section-offset">
                        <h2 class="section-content-heading mt-5">Rules & Restrictions</h2>

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
                            <p>Leave space tidy</p>
                        </div>
                        <div class="preferences-list d-flex align-items-center mt-4">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                <path d="M6.11099 13.8891C6.01726 13.7953 5.9646 13.6681 5.9646 13.5356C5.9646 13.403 6.01726 13.2758 6.11099 13.1821L9.29299 10.0001L6.11099 6.81806C6.01991 6.72376 5.96952 6.59746 5.97066 6.46636C5.9718 6.33526 6.02438 6.20985 6.11708 6.11715C6.20979 6.02445 6.33519 5.97186 6.46629 5.97072C6.59739 5.96958 6.72369 6.01998 6.81799 6.11106L9.99999 9.29306L13.182 6.11106C13.2763 6.01998 13.4026 5.96958 13.5337 5.97072C13.6648 5.97186 13.7902 6.02445 13.8829 6.11715C13.9756 6.20985 14.0282 6.33526 14.0293 6.46636C14.0305 6.59746 13.9801 6.72376 13.889 6.81806L10.707 10.0001L13.889 13.1821C13.9801 13.2764 14.0305 13.4027 14.0293 13.5338C14.0282 13.6649 13.9756 13.7903 13.8829 13.883C13.7902 13.9757 13.6648 14.0283 13.5337 14.0294C13.4026 14.0305 13.2763 13.9801 13.182 13.8891L9.99999 10.7071L6.81799 13.8891C6.72423 13.9828 6.59708 14.0355 6.46449 14.0355C6.33191 14.0355 6.20476 13.9828 6.11099 13.8891Z" fill="#3B3731" />
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M10 20C15.523 20 20 15.523 20 10C20 4.477 15.523 0 10 0C4.477 0 0 4.477 0 10C0 15.523 4.477 20 10 20ZM10 19C14.9705 19 19 14.9705 19 10C19 5.0295 14.9705 1 10 1C5.0295 1 1 5.0295 1 10C1 14.9705 5.0295 19 10 19Z" fill="#3B3731" />
                            </svg>
                            &nbsp;
                            &nbsp;
                            <p>Not suitable for aggressive animals in heat</p>
                        </div>
                        <div class="preferences-list d-flex align-items-center mt-4">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                <path d="M6.11099 13.8891C6.01726 13.7953 5.9646 13.6681 5.9646 13.5356C5.9646 13.403 6.01726 13.2758 6.11099 13.1821L9.29299 10.0001L6.11099 6.81806C6.01991 6.72376 5.96952 6.59746 5.97066 6.46636C5.9718 6.33526 6.02438 6.20985 6.11708 6.11715C6.20979 6.02445 6.33519 5.97186 6.46629 5.97072C6.59739 5.96958 6.72369 6.01998 6.81799 6.11106L9.99999 9.29306L13.182 6.11106C13.2763 6.01998 13.4026 5.96958 13.5337 5.97072C13.6648 5.97186 13.7902 6.02445 13.8829 6.11715C13.9756 6.20985 14.0282 6.33526 14.0293 6.46636C14.0305 6.59746 13.9801 6.72376 13.889 6.81806L10.707 10.0001L13.889 13.1821C13.9801 13.2764 14.0305 13.4027 14.0293 13.5338C14.0282 13.6649 13.9756 13.7903 13.8829 13.883C13.7902 13.9757 13.6648 14.0283 13.5337 14.0294C13.4026 14.0305 13.2763 13.9801 13.182 13.8891L9.99999 10.7071L6.81799 13.8891C6.72423 13.9828 6.59708 14.0355 6.46449 14.0355C6.33191 14.0355 6.20476 13.9828 6.11099 13.8891Z" fill="#3B3731" />
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M10 20C15.523 20 20 15.523 20 10C20 4.477 15.523 0 10 0C4.477 0 0 4.477 0 10C0 15.523 4.477 20 10 20ZM10 19C14.9705 19 19 14.9705 19 10C19 5.0295 14.9705 1 10 1C5.0295 1 1 5.0295 1 10C1 14.9705 5.0295 19 10 19Z" fill="#3B3731" />
                            </svg>
                            &nbsp;
                            &nbsp;
                            <p>No overnight stays</p>
                        </div>
                        <div class="preferences-list d-flex align-items-center mt-4">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                <path d="M6.11099 13.8891C6.01726 13.7953 5.9646 13.6681 5.9646 13.5356C5.9646 13.403 6.01726 13.2758 6.11099 13.1821L9.29299 10.0001L6.11099 6.81806C6.01991 6.72376 5.96952 6.59746 5.97066 6.46636C5.9718 6.33526 6.02438 6.20985 6.11708 6.11715C6.20979 6.02445 6.33519 5.97186 6.46629 5.97072C6.59739 5.96958 6.72369 6.01998 6.81799 6.11106L9.99999 9.29306L13.182 6.11106C13.2763 6.01998 13.4026 5.96958 13.5337 5.97072C13.6648 5.97186 13.7902 6.02445 13.8829 6.11715C13.9756 6.20985 14.0282 6.33526 14.0293 6.46636C14.0305 6.59746 13.9801 6.72376 13.889 6.81806L10.707 10.0001L13.889 13.1821C13.9801 13.2764 14.0305 13.4027 14.0293 13.5338C14.0282 13.6649 13.9756 13.7903 13.8829 13.883C13.7902 13.9757 13.6648 14.0283 13.5337 14.0294C13.4026 14.0305 13.2763 13.9801 13.182 13.8891L9.99999 10.7071L6.81799 13.8891C6.72423 13.9828 6.59708 14.0355 6.46449 14.0355C6.33191 14.0355 6.20476 13.9828 6.11099 13.8891Z" fill="#3B3731" />
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M10 20C15.523 20 20 15.523 20 10C20 4.477 15.523 0 10 0C4.477 0 0 4.477 0 10C0 15.523 4.477 20 10 20ZM10 19C14.9705 19 19 14.9705 19 10C19 5.0295 14.9705 1 10 1C5.0295 1 1 5.0295 1 10C1 14.9705 5.0295 19 10 19Z" fill="#3B3731" />
                            </svg>
                            &nbsp;
                            &nbsp;
                            <p>Pets must remain supervised</p>
                        </div>
                        <div class="preferences-list d-flex align-items-center mt-4">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                <path d="M6.11099 13.8891C6.01726 13.7953 5.9646 13.6681 5.9646 13.5356C5.9646 13.403 6.01726 13.2758 6.11099 13.1821L9.29299 10.0001L6.11099 6.81806C6.01991 6.72376 5.96952 6.59746 5.97066 6.46636C5.9718 6.33526 6.02438 6.20985 6.11708 6.11715C6.20979 6.02445 6.33519 5.97186 6.46629 5.97072C6.59739 5.96958 6.72369 6.01998 6.81799 6.11106L9.99999 9.29306L13.182 6.11106C13.2763 6.01998 13.4026 5.96958 13.5337 5.97072C13.6648 5.97186 13.7902 6.02445 13.8829 6.11715C13.9756 6.20985 14.0282 6.33526 14.0293 6.46636C14.0305 6.59746 13.9801 6.72376 13.889 6.81806L10.707 10.0001L13.889 13.1821C13.9801 13.2764 14.0305 13.4027 14.0293 13.5338C14.0282 13.6649 13.9756 13.7903 13.8829 13.883C13.7902 13.9757 13.6648 14.0283 13.5337 14.0294C13.4026 14.0305 13.2763 13.9801 13.182 13.8891L9.99999 10.7071L6.81799 13.8891C6.72423 13.9828 6.59708 14.0355 6.46449 14.0355C6.33191 14.0355 6.20476 13.9828 6.11099 13.8891Z" fill="#3B3731" />
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M10 20C15.523 20 20 15.523 20 10C20 4.477 15.523 0 10 0C4.477 0 0 4.477 0 10C0 15.523 4.477 20 10 20ZM10 19C14.9705 19 19 14.9705 19 10C19 5.0295 14.9705 1 10 1C5.0295 1 1 5.0295 1 10C1 14.9705 5.0295 19 10 19Z" fill="#3B3731" />
                            </svg>
                            &nbsp;
                            &nbsp;
                            <p>No smoking</p>
                        </div>
                    </div>

                    <div id="amenities" class="mt-5 section-offset">
                        <h2 class="section-content-heading">Amenities Included</h2>
                        <div class="amenities-options d-flex align-items-center mt-4 flex-wrap gap-30">
                            <div class="selected-item dark-bg">
                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="9" viewBox="0 0 12 9" fill="none">
                                    <path d="M0.75 4.75L4.25 8.25L11.25 0.75" stroke="#3B3731" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                Grooming Table
                            </div>
                            <div class="selected-item dark-bg">
                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="9" viewBox="0 0 12 9" fill="none">
                                    <path d="M0.75 4.75L4.25 8.25L11.25 0.75" stroke="#3B3731" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                Bath
                            </div>
                            <div class="selected-item dark-bg">
                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="9" viewBox="0 0 12 9" fill="none">
                                    <path d="M0.75 4.75L4.25 8.25L11.25 0.75" stroke="#3B3731" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                Dryer
                            </div>
                            <div class="selected-item dark-bg">
                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="9" viewBox="0 0 12 9" fill="none">
                                    <path d="M0.75 4.75L4.25 8.25L11.25 0.75" stroke="#3B3731" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                Towels
                            </div>
                            <div class="selected-item dark-bg">
                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="9" viewBox="0 0 12 9" fill="none">
                                    <path d="M0.75 4.75L4.25 8.25L11.25 0.75" stroke="#3B3731" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                Waiting area
                            </div>
                            <div class="selected-item dark-bg">
                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="9" viewBox="0 0 12 9" fill="none">
                                    <path d="M0.75 4.75L4.25 8.25L11.25 0.75" stroke="#3B3731" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                Parking
                            </div>
                            <div class="selected-item dark-bg">
                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="9" viewBox="0 0 12 9" fill="none">
                                    <path d="M0.75 4.75L4.25 8.25L11.25 0.75" stroke="#3B3731" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                Wi-Fi
                            </div>
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
                                <p>Located near Victoria Embankment</p>
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
            <div class="col-lg-4">
                <div class="service-card mt-4 mb-5">
                    <div class="service__header">
                        <div class="d-flex align-items-center gap-20">
                            <div class="avatar-wrap">
                                <img class="avatar" src="<?= BASE_URL ?>/assets/images/space_profile_avatar.png" alt="Sarah's avatar">
                                <div class="badge-shield" title="Verified">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="29" height="31" viewBox="0 0 29 31" fill="none">
                                        <path d="M15.3096 0.175208C15.0558 0.0604166 14.784 0 14.5 0C14.216 0 13.9442 0.0604166 13.6904 0.175208L2.31398 5.00249C0.984817 5.56436 -0.00601417 6.8754 2.74804e-05 8.45832C0.0302358 14.4516 2.49523 25.4172 12.905 30.4016C13.914 30.8849 15.086 30.8849 16.095 30.4016C26.5048 25.4172 28.9698 14.4516 29 8.45832C29.006 6.8754 28.0152 5.56436 26.686 5.00249L15.3096 0.175208Z" fill="#CBDCE8" />
                                        <path d="M22.3736 8.3902L16.1586 14.9936L22.3736 8.3902ZM13.3976 14.6712C11.471 15.4108 9.93043 15.2842 8.38989 14.6735C8.77833 19.6789 11.112 21.6032 14.2234 22.3739C14.2234 22.3739 16.5672 20.716 16.9052 16.7858C16.9417 16.3601 16.9596 16.148 16.8718 15.908C16.7832 15.6679 16.6092 15.4962 16.2619 15.1521C15.6902 14.5865 15.405 14.3037 15.0655 14.2323C14.7261 14.1624 14.2832 14.3317 13.3976 14.6712Z" fill="#CBDCE8" />
                                        <path d="M22.3736 8.3902L16.1586 14.9936M13.3976 14.6712C11.471 15.4108 9.93043 15.2842 8.38989 14.6735C8.77833 19.6789 11.112 21.6032 14.2234 22.3739C14.2234 22.3739 16.5672 20.716 16.9052 16.7858C16.9417 16.3601 16.9596 16.148 16.8718 15.908C16.7832 15.6679 16.6092 15.4962 16.2619 15.1521C15.6902 14.5865 15.405 14.3037 15.0655 14.2323C14.7261 14.1624 14.2832 14.3317 13.3976 14.6712Z" stroke="white" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M9.55615 18.8365C9.55615 18.8365 11.4983 19.2125 13.4405 17.7131L9.55615 18.8365Z" fill="#CBDCE8" />
                                        <path d="M9.55615 18.8365C9.55615 18.8365 11.4983 19.2125 13.4405 17.7131" stroke="white" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M12.6631 11.6924C12.6631 11.95 12.5608 12.197 12.3787 12.3791C12.1966 12.5612 11.9496 12.6635 11.692 12.6635C11.4345 12.6635 11.1875 12.5612 11.0054 12.3791C10.8233 12.197 10.7209 11.95 10.7209 11.6924C10.7209 11.4349 10.8233 11.1879 11.0054 11.0057C11.1875 10.8236 11.4345 10.7213 11.692 10.7213C11.9496 10.7213 12.1966 10.8236 12.3787 11.0057C12.5608 11.1879 12.6631 11.4349 12.6631 11.6924Z" fill="#CBDCE8" stroke="white" />
                                        <path d="M14.6052 9.16711V9.2448V9.16711Z" fill="#CBDCE8" />
                                        <path d="M14.6052 9.16711V9.2448" stroke="white" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </div>
                            </div>
                            <div>
                                <h2 class="section-heading-name">Hosted by Dev Émile</h2>
                                <span class="section-heading-span mt-2">5+ years experience</span>
                                <div class="tags-row mt-3">
                                    <span class="pill serive-card">
                                        Garden / Shed
                                    </span>
                                </div>
                            </div>
                        </div>
                        <p class="size mt-3">Fits 1–3 groomers · Up to 4 pets at a time · Approx. 400 sq. ft.</p>
                        <div class="message-btn-div d-flex justify-content-center mt-4">
                            <button class="message-btn">Message Host</button>
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

                            <div class="availability mt-4">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                                    <path
                                        d="M9 0C4.05 0 0 4.05 0 9C0 13.95 4.05 18 9 18C13.95 18 18 13.95 18 9C18 4.05 13.95 0 9 0ZM7.2 13.5L2.7 9L3.969 7.731L7.2 10.953L14.031 4.122L15.3 5.4L7.2 13.5Z"
                                        fill="#D8E8B7" />
                                </svg>
                                Availability
                            </div>

                            <div class="space times mt-4">
                                <div class="time">09:00 AM</div>
                                <div class="time selected">11:00 AM</div>
                                <div class="time">12:00 PM</div>
                                <div class="time" id="halfDay">Half Day</div>
                                <div class="time" id="fullDay">Full-Day</div>
                            </div>

                            <div class="timeslot-card mt-4">
                                <h3>Select your Half-Day timeslot</h3>

                                <div class="grid">

                                    <!-- Start Time -->
                                    <div>
                                        <div class="label">Start Time</div>
                                        <div class="time-box">
                                            <div class="card-time" id="startBtn">
                                                <span id="startText">13:00 PM</span>
                                                <span class="caret">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="8" viewBox="0 0 15 8" fill="none">
                                                        <path d="M13.5105 0.5L6.95017 7.06033L0.499971 0.610127" stroke="#3B3731" stroke-linecap="round" stroke-linejoin="round" />
                                                    </svg>
                                                </span>
                                            </div>
                                            <ul class="time dropdown" id="startList"></ul>
                                        </div>
                                    </div>

                                    <!-- End Time -->
                                    <div>
                                        <div class="label">End Time</div>
                                        <div class="time-box">
                                            <div class="card-time end" id="endBtn">
                                                <span id="endText">17:00 PM</span>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>

                        <div class="service-type-select mt-4">
                            <p class="label">Add-ons Services</p>
                            <div class="custom-select" data-multiselect data-color="#FFA899">
                                <div class="select-trigger w-auto">
                                    <span class="selected-text">Storage Locker</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="8"
                                        viewBox="0 0 15 8" fill="none">
                                        <path d="M13.8737 0.5L7.13022 7.24344L0.499976 0.613201"
                                            stroke="#3B3731" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                </div>

                                <ul class="select-options">
                                    <li data-value="storage-locker">Storage Locker</li>
                                    <li data-value="deep-clean">Deep Clean</li>
                                </ul>

                                <input type="hidden" name="addons">
                            </div>
                            <div class="service-selected-options d-flex align-items-center flex-wrap gap-10 mt-4">
                                <div class="selected-item d-flex align-items-center gap-10" data-value="storage-locker" style="background: none;color: #FFA899;">
                                    <p>Storage Locker</p>
                                    <svg style="cursor: pointer" xmlns="http://www.w3.org/2000/svg" width="9" height="9" viewBox="0 0 9 9" fill="none">
                                        <path d="M0.5 7.57L7.572 0.5M0.5 0.5L7.572 7.57" stroke="#FFA899" stroke-linecap="round" />
                                    </svg>
                                </div>
                                <div class="selected-item d-flex align-items-center gap-10" data-value="deep-clean" style="background: none;color: #FFA899;">
                                    <p>Deep Clean</p>
                                    &nbsp;
                                    <svg style="cursor: pointer" xmlns="http://www.w3.org/2000/svg" width="9" height="9" viewBox="0 0 9 9" fill="none">
                                        <path d="M0.5 7.57L7.572 0.5M0.5 0.5L7.572 7.57" stroke="#FFA899" stroke-linecap="round" />
                                    </svg>
                                </div>
                            </div>
                        </div>



                        <div class="book-btn-div mt-4">
                            <button class="book-btn" data-modal-open="space_prompt">Book now</button>
                        </div>

                        <!-- Modal  -->

                        <!-- SPACE PROMPT MODAL -->
                        <div class="modal" id="space_prompt">
                            <div class="modal-content">
                                <div class="groomer-cross-svg cursor d-flex justify-content-end" data-modal-close>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 36 36" fill="none">
                                        <circle cx="18" cy="18" r="17.5" stroke="#3B3731" />
                                        <path d="M12.8 23.9998L24 12.7998M12.8 12.7998L24 23.9998" stroke="#3B3731" stroke-width="1.5" stroke-linecap="round" />
                                    </svg>
                                </div>
                                <div class="d-flex flex-column align-items-center justify-content-center">
                                    <div class="svg-wrapper">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="76" height="50" viewBox="0 0 76 50" fill="none">
                                            <rect x="11.8813" width="50.0001" height="17.8218" rx="8.91091" fill="#FFC97A" />
                                            <rect y="17.3271" width="50.0001" height="17.3268" rx="8.66339" fill="#FFC97A" />
                                            <rect x="25.2476" y="32.1782" width="50.0001" height="17.8218" rx="8.91091" fill="#FFC97A" />
                                        </svg>
                                        <svg class="space-modal-svg" xmlns="http://www.w3.org/2000/svg" width="74" height="52" viewBox="0 0 74 52" fill="none">
                                            <path d="M27.5 27.5448C24.2602 27.5448 21.4854 26.3909 19.1754 24.0831C16.8654 21.7754 15.7117 19.0045 15.7143 15.7705C15.7169 12.5365 16.8706 9.76298 19.1754 7.44998C21.4801 5.13699 24.255 3.98703 27.5 4.00011C30.745 4.01319 33.5199 5.16446 35.8246 7.45391C38.1294 9.74335 39.2831 12.5169 39.2857 15.7744C39.2883 19.032 38.1346 21.8029 35.8246 24.0871C33.5146 26.3713 30.7398 27.5212 27.5 27.5448ZM0 47.9261V45.5712C0 43.9045 0.480596 42.3726 1.44179 40.9753C2.40298 39.5781 3.66536 38.4883 5.22893 37.706C8.75417 36.0445 12.3815 34.7415 16.1111 33.7969C19.8406 32.8524 23.6421 32.3788 27.5157 32.3762C31.3893 32.3736 35.1856 32.8471 38.9046 33.7969C42.6237 34.7467 46.2458 36.0498 49.7711 37.706C51.3346 38.4857 52.597 39.5755 53.5582 40.9753C54.5194 42.3752 55 43.9058 55 45.5673V47.9222C55 49.0734 54.6085 50.0415 53.8254 50.8265C53.0423 51.6088 52.0732 52 50.9182 52H4.08571C2.93071 52 1.96167 51.6075 1.17857 50.8226C0.392858 50.0402 0 49.0774 0 47.9261ZM27.5 23.62C29.6607 23.62 31.5111 22.8508 33.0511 21.3123C34.5911 19.7737 35.3598 17.9265 35.3571 15.7705C35.3545 13.6145 34.5858 11.7659 33.0511 10.2248C31.5163 8.68367 29.666 7.91572 27.5 7.92095C25.334 7.92619 23.485 8.69413 21.9529 10.2248C20.4207 11.7555 19.6507 13.604 19.6429 15.7705C19.635 17.937 20.405 19.7842 21.9529 21.3123C23.5007 22.8403 25.3498 23.6096 27.5 23.62ZM40.9475 38.3654V48.0752H51.0714V45.5359C51.0714 44.5652 50.7571 43.7109 50.1286 42.973C49.5 42.2352 48.7562 41.6255 47.8971 41.1441C46.7788 40.5685 45.6369 40.0569 44.4714 39.6095C43.306 39.1621 42.1313 38.7474 40.9475 38.3654ZM17.9811 37.3645V42.1881H37.0189V37.3606C35.458 36.9995 33.8774 36.7327 32.2771 36.56C30.6795 36.3873 29.0819 36.3009 27.4843 36.3009C25.8814 36.3009 24.2877 36.3873 22.7032 36.56C21.1187 36.7327 19.5446 37.0009 17.9811 37.3645ZM3.92857 48.0752H14.0525V38.3654C12.8687 38.7448 11.694 39.1595 10.5286 39.6095C9.36309 40.0596 8.22119 40.5711 7.10286 41.1441C6.24643 41.6229 5.50393 42.2326 4.87536 42.973C4.24417 43.7109 3.92857 44.5652 3.92857 45.5359V48.0752Z" fill="#3B3731" />
                                            <path d="M69.5056 12.1945L65.0523 10.0763C64.2465 9.69593 63.7499 10.8177 64.5276 11.1796L68.9809 13.2977L68.7116 13.8639L64.2583 11.7457C63.4612 11.3586 62.9642 12.4795 63.7335 12.849L68.1868 14.9672L67.9116 15.5457L63.4584 13.4276C62.6582 13.047 62.1615 14.1672 62.9336 14.5308L67.3869 16.649L67.1246 17.2003L62.6713 15.0822C61.8853 14.7148 61.3714 15.8283 62.1404 16.1985L66.5937 18.3166L66.3309 18.8692L61.8776 16.751C61.0952 16.376 60.5661 17.4801 61.3528 17.8543L65.8061 19.9724L65.5439 20.5238L61.0906 18.4056C60.3059 18.0353 59.7763 19.1406 60.5655 19.5095L65.0188 21.6277L64.7501 22.1926L60.2968 20.0745C59.5164 19.6953 58.9873 20.7994 59.7721 21.1777L64.2253 23.2959L63.9637 23.8461L59.5104 21.7279C58.7271 21.3546 58.2129 22.4687 58.9853 22.8318L63.4386 24.9499L58.3291 35.6923C57.5531 37.3304 60.2599 38.5816 61.0321 36.9779L72.9891 11.8391C73.3371 11.0877 73.1217 9.82603 72.0289 9.3026L66.6396 6.73924C65.8346 6.35709 65.338 7.47884 66.1148 7.84252L70.5616 9.97428L70.3 10.5244L65.8467 8.40629C65.045 8.02061 64.5486 9.14176 65.3216 9.51016L69.7749 11.6283L69.5056 12.1945ZM55.6875 28.9757C56.5938 27.0637 55.4263 23.9884 52.2306 24.1005L55.7067 16.7922L59.7823 3.9506C59.8993 3.61529 59.6423 3.4009 59.4481 3.30202C59.2425 3.21075 58.8 3.09238 58.6041 3.39021L51.222 14.6591L47.7459 21.9674C45.8163 19.4175 42.7569 20.4983 41.8606 22.381C41.0644 24.0566 41.8066 26.0969 43.6985 26.9917C45.6006 27.9015 47.7039 27.0108 48.4217 25.5017L52.0326 17.91L52.6732 18.2147L49.0624 25.8064C48.2587 27.4959 49.0811 29.4206 50.6181 30.2489C50.1512 31.1628 49.85 32.6401 50.217 33.4573C50.6471 34.4163 51.8817 34.0388 51.8335 33.2302C51.7762 32.4718 51.6098 31.9595 52.5007 30.7867C53.8667 30.8416 55.1109 30.1813 55.6875 28.9757ZM44.4989 25.4972C44.0669 25.2917 43.7279 24.9362 43.5566 24.5089C43.3853 24.0815 43.3957 23.6173 43.5854 23.2184C43.7751 22.8195 44.1287 22.5185 44.5683 22.3818C45.008 22.245 45.4977 22.2836 45.9297 22.4891C46.8154 22.9162 47.2188 23.9328 46.8316 24.7635C46.6414 25.1594 46.29 25.4583 45.8535 25.5957C45.4169 25.733 44.9302 25.6976 44.4989 25.4972ZM50.705 26.6059C50.8953 26.2097 51.2468 25.9105 51.6836 25.7729C52.1204 25.6353 52.6074 25.6704 53.0392 25.8706C53.4672 26.079 53.8019 26.4346 53.9707 26.8603C54.1395 27.286 54.1289 27.7476 53.9411 28.145C53.7516 28.5416 53.4003 28.8411 52.9635 28.9785C52.5266 29.1159 52.0396 29.0801 51.6084 28.8788C51.1805 28.6707 50.8458 28.3155 50.6768 27.8901C50.5077 27.4647 50.5178 27.0033 50.705 26.6059Z" fill="#3B3731" />
                                        </svg>
                                    </div>
                                    <h1 class="large-font text-center mt-3" style="line-height: normal;">Do you have a groomer?</h1>
                                    <p class="normal-light-color">Tell us how you’d like to continue.</p>
                                </div>

                                <div class="d-flex flex-column align-items-center justify-content-center">
                                    <div class="groomer-find-card cursor d-flex flex-column justify-content-center mt-4">
                                        <p class="medium-font-m-bold">Find a groomer for me</p>
                                        <p class="normal-light-color-font">We’ll match you with a trusted professional.</p>
                                    </div>

                                    <div class="service-type-select mt-4" id="find-groomer-for-me" style="display:none;">
                                        <p class="label">Main Service Type</p>
                                        <div class="custom-select">
                                            <div class="select-trigger full-width">
                                                <span class="selected-text">Full Grooming, Pet Spa ...</span>
                                                <svg width="16" height="16" viewBox="0 0 24 24">
                                                    <path d="M6 9l6 6 6-6" fill="none" stroke="#666" stroke-width="2" />
                                                </svg>
                                            </div>

                                            <ul class="select-options">
                                                <li data-value="full-groom">Full Groom</li>
                                                <li data-value="bath-and-brush" class="disabled">Bath & Brush</li>
                                                <li data-value="medicated-bath">Medicated / Sensitive Skin Bath</li>
                                                <li data-value="ear-cleaning">Ear Cleaning</li>
                                                <li data-value="deshedding" class="disabled">Deshedding</li>
                                            </ul>

                                            <input type="hidden" name="main_service">
                                        </div>
                                    </div>

                                    <div class="space-find-card dont-need-groomer cursor d-flex flex-column justify-content-center mt-4">
                                        <p class="medium-font-m-bold">I don’t need a groomer</p>
                                        <p class="normal-light-color-font">Continue with booking this space only.</p>
                                    </div>
                                </div>

                                <div class="modal-footer d-flex align-items-center justify-content-center mt-4 gap-10">
                                    <button type="button" class="modal-footer-btn" data-modal-close>Go Back</button>
                                    <button type="button" class="modal-footer-btn apply">Continue</button>
                                </div>
                            </div>
                        </div>

                        <!-- Modal  -->

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
                            </svg> Cancellations within 24 hours of your booking start may incur a one-hour charge.
                        </div>

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
    <script>
        const timeElements = document.querySelectorAll('.space.times .time');
        const timeSlotCard = document.querySelector('.timeslot-card');

        timeElements.forEach(el => {
            el.addEventListener('click', () => {
                // Remove 'selected' class from all
                timeElements.forEach(t => t.classList.remove('selected'));

                // Add 'selected' to the clicked one
                el.classList.add('selected');

                // Show timeslot-card only if 'Half Day' is clicked
                if (el.id === 'halfDay') {
                    timeSlotCard.style.display = 'block';
                } else {
                    timeSlotCard.style.display = 'none';
                }
            });
        });

        document.addEventListener('DOMContentLoaded', () => {

            const times = [
                '08:00', '09:00', '10:00', '11:00',
                '12:00', '13:00', '14:00', '15:00',
                '16:00', '17:00', '18:00'
            ];

            const startBtn = document.getElementById('startBtn');
            const startList = document.getElementById('startList');
            const startText = document.getElementById('startText');
            const endText = document.getElementById('endText');

            /* build start dropdown */
            times.forEach(time => {
                const li = document.createElement('li');
                li.textContent = `${time} PM`;
                li.addEventListener('click', () => {
                    setStartTime(time);
                    startList.classList.remove('open');
                });
                startList.appendChild(li);
            });

            /* toggle dropdown */
            startBtn.addEventListener('click', e => {
                e.stopPropagation();
                startList.classList.toggle('open');
            });

            /* close on outside click */
            document.addEventListener('click', () => {
                startList.classList.remove('open');
            });

            /* HALF DAY LOGIC */
            function setStartTime(startTime) {
                startText.textContent = `${startTime} PM`;

                const hour = parseInt(startTime.split(':')[0], 10);
                const endHour = hour + 4;

                endText.textContent = `${endHour}:00 PM`;
            }

            /* default */
            setStartTime('13:00');

        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const spacePromptModal = document.getElementById('space_prompt');
            const bookSpaceModal = document.getElementById('groomer_book_space');

            const groomerCard = spacePromptModal.querySelector('.groomer-find-card');
            const dontNeedGroomer = spacePromptModal.querySelector('.dont-need-groomer');
            const serviceBox = spacePromptModal.querySelector('#find-groomer-for-me');

            const continueBtn = spacePromptModal.querySelector('.modal-footer-btn.apply');
            const options = serviceBox.querySelectorAll('.select-options li');
            const selectedText = serviceBox.querySelector('.selected-text');
            const hiddenInput = serviceBox.querySelector('input[name="main_service"]');

            let groomerSelected = false;

            function openModal(modal) {
                modal.style.display = 'flex';
            }

            function closeModal(modal) {
                modal.style.display = 'none';
            }

            groomerCard.addEventListener('click', function() {
                groomerSelected = true;
                groomerCard.classList.add('active');
                dontNeedGroomer.classList.remove('active');
                serviceBox.style.display = 'block';
            });

            dontNeedGroomer.addEventListener('click', function() {
                groomerSelected = false;
                dontNeedGroomer.classList.add('active');
                groomerCard.classList.remove('active');
                serviceBox.style.display = 'none';
            });

            options.forEach(function(option) {
                option.addEventListener('click', function() {
                    if (this.classList.contains('disabled')) return;

                    selectedText.textContent = this.textContent.trim();
                    hiddenInput.value = this.getAttribute('data-value');
                });
            });

            continueBtn.addEventListener('click', function() {
                if (!groomerSelected) return;

                closeModal(spacePromptModal);
                openModal(bookSpaceModal);
            });

            document.querySelectorAll('[data-modal-close]').forEach(function(btn) {
                btn.addEventListener('click', function() {
                    const modal = this.closest('.modal');
                    if (modal) closeModal(modal);
                });
            });
        });

        const blockSvg = document.querySelectorAll('.block-svg');
        const blockBtnDiv = document.querySelector('.block-btn-div');

        blockSvg.forEach(svg => {
            svg.addEventListener('click', () => {
                blockBtnDiv.style.display = blockBtnDiv.style.display === 'block' ? 'none' : 'block';
            });
        });


        // loop through all venu-sorting-section blocks
        document.querySelectorAll('.venu-sorting-section').forEach(container => {
            const sortBy = container.querySelector('.sort-by');
            const sortByFilter = container.querySelector('.sort-by-filter');

            const venueSelection = container.querySelector('.venue-selection');
            const venueList = container.querySelector('.venue-list');

            sortBy.addEventListener('click', () => {
                // hide venue dropdown only inside this container
                venueList.style.display = 'none';

                // toggle sort dropdown
                sortByFilter.style.display = (sortByFilter.style.display === 'block') ? 'none' : 'block';
            });

            venueSelection.addEventListener('click', () => {
                // hide sort dropdown only inside this container
                sortByFilter.style.display = 'none';

                // toggle venue dropdown
                venueList.style.display = (venueList.style.display === 'block') ? 'none' : 'block';
            });
        });


        // sort and venue selection ends


        // selected filter remove js starts

        document.querySelectorAll('.selected-item-section').forEach(section => {
            section.addEventListener('click', e => {
                if (e.target.classList.contains('cross')) {
                    e.target.closest('.selected-item')?.remove();
                }
            });
        });


        // tab map js starts

        let modalMap = null;

        function initModalMap() {
            if (modalMap) {
                modalMap.invalidateSize(true);
                return;
            }

            modalMap = L.map('modal-map', {
                zoomControl: false,
                attributionControl: false,
                preferCanvas: true
            }).setView([51.510131, -0.146812], 14);

            L.tileLayer('https://{s}.basemaps.cartocdn.com/light_nolabels/{z}/{x}/{y}{r}.png', {
                subdomains: 'abcd',
                maxZoom: 20
            }).addTo(modalMap);

            L.tileLayer('https://{s}.basemaps.cartocdn.com/light_only_labels/{z}/{x}/{y}{r}.png', {
                subdomains: 'abcd',
                maxZoom: 20
            }).addTo(modalMap);

            const yellowPin = L.icon({
                iconUrl: 'data:image/svg+xml;utf8,' + encodeURIComponent(`
            <svg xmlns="http://www.w3.org/2000/svg" width="34" height="48" viewBox="0 0 34 48" fill="none">
                <path d="M17 22.8C15.3898 22.8 13.8455 22.1679 12.7069 21.0426C11.5682 19.9174 10.9286 18.3913 10.9286 16.8C10.9286 15.2087 11.5682 13.6826 12.7069 12.5574C13.8455 11.4321 15.3898 10.8 17 10.8C18.6102 10.8 20.1545 11.4321 21.2931 12.5574C22.4318 13.6826 23.0714 15.2087 23.0714 16.8ZM17 0C12.4913 0 8.1673 1.76999 4.97918 4.92061C1.79107 8.07122 0 12.3444 0 16.8C0 29.4 17 48 17 48C17 48 34 29.4 34 16.8C34 12.3444 32.2089 8.07122 29.0208 4.92061C25.8327 1.76999 21.5087 0 17 0Z" fill="#FFC97A"/>
            </svg>
        `),
                iconSize: [28, 28],
                iconAnchor: [14, 28]
            });

            // 📍 Multiple locations
            const locations = [{
                    coords: [51.510131, -0.146812],
                    name: "Sarah's Grooming Studio"
                },
                {
                    coords: [51.515000, -0.140000],
                    name: "London Pet Care Center"
                },
                {
                    coords: [51.507500, -0.128000],
                    name: "City Grooming Hub"
                }
            ];

            locations.forEach(loc => {
                L.marker(loc.coords, {
                        icon: yellowPin
                    })
                    .addTo(modalMap)
                    .bindTooltip(loc.name, {
                        direction: 'top',
                        offset: [0, -24],
                        opacity: 0.95
                    });
            });

            modalMap.invalidateSize(true);
        }

        // tab map js ends

    </script>

</body>

</html>