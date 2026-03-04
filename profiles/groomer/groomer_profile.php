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
    </style>
</head>

<body class="groomer-profile">

    <?php include '../../components/header.php' ?>

    <div class="container mt-5">
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
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="5" viewBox="0 0 25 5" fill="none">
                                    <circle cx="2.5" cy="2.5" r="2.5" fill="#3B3731" />
                                    <circle cx="12.5" cy="2.5" r="2.5" fill="#3B3731" />
                                    <circle cx="22.5" cy="2.5" r="2.5" fill="#3B3731" />
                                </svg>
                            </div>
                        </div>
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
                                <button class="book-btn">Book now</button>
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
                        <a href="#services_and_pricing" class="active">Services & Pricing</a>
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

</body>

</html>