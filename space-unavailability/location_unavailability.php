<?php include '../function_helper.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fursgo</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/responsive.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/bootstrap.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/media_query.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/customer_journey.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

</head>

<body>

    <!-- header -->
    <?php include '../components/header.php' ?>
    <!-- header -->

    <!-- filter modal  -->
    <?php include '../components/filter_modals.php' ?>
    <!-- filter modal  -->

    <section>
        <div class="container mt-3 mt-xs-5">
            <div class="row">
                <div class="col-lg-12">
                    <div class="mini-search-widget">
                        <div class="find-groomer-search-content">
                            <div data-section="groomer" class="top-tabs find-groomer-search active">
                                <p>Find Groomer</p>
                            </div>
                        </div>
                        <div class="find-groomer-search-content-area">
                            <form action="">
                                <div class="row gx-2 g-xs-5 input-fields mt-0 d-flex justify-content-center">
                                    <div class="w-auto">
                                        <div class="search-input">
                                            <p class="label">Search Groomer</p>
                                            <input type="text" value="London, NW3 1AA">
                                            <svg class="search-icon" xmlns="http://www.w3.org/2000/svg" width="16"
                                                height="16" fill="gray" viewBox="0 0 16 16">
                                                <path
                                                    d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85zm-5.242.656a5 5 0 1 1 0-10 5 5 0 0 1 0 10z" />
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="w-auto">
                                        <div class="service-type-select">
                                            <p class="label">Service Type</p>
                                            <div class="custom-select custom-select-streched">
                                                <div class="select-trigger">
                                                    <span class="selected-text">Full Groom</span>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="8"
                                                        viewBox="0 0 15 8" fill="none">
                                                        <path d="M13.8737 0.5L7.13022 7.24344L0.499976 0.613201"
                                                            stroke="#3B3731" stroke-linecap="round"
                                                            stroke-linejoin="round" />
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
                                    <div class="w-auto">
                                        <div class="datetime-wrapper" id="datetime">
                                            <!-- Date field -->
                                            <div class="field-group">
                                                <p class="label">Date</p>
                                                <div class="field date streched" id="dateField">
                                                    <div class="input-row streched" tabindex="0" role="button"
                                                        aria-haspopup="dialog" aria-expanded="false">
                                                        <input class="fake-input" id="dateInput" readonly
                                                            placeholder="02/11/25" aria-label="Date input" />
                                                        <!-- chevron down svg -->
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="8"
                                                            viewBox="0 0 15 8" fill="none">
                                                            <path d="M13.5105 0.5L6.95017 7.06033L0.499971 0.610127"
                                                                stroke="#3B3731" stroke-linecap="round"
                                                                stroke-linejoin="round" />
                                                        </svg>
                                                    </div>

                                                    <div class="popover" id="datePopover" data-type="date">
                                                        <div style="display:flex;flex-direction: column;">
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
                                                                    <div>Time</div>
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
                                                <div class="field time streched" id="timeField">
                                                    <div class="input-row streched" tabindex="0" role="button"
                                                        aria-haspopup="dialog" aria-expanded="false">
                                                        <input class="fake-input" id="timeInput" readonly
                                                            placeholder="13:00" aria-label="Time input" />
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="8"
                                                            viewBox="0 0 15 8" fill="none">
                                                            <path d="M13.5105 0.5L6.95017 7.06033L0.499971 0.610127"
                                                                stroke="#3B3731" stroke-linecap="round"
                                                                stroke-linejoin="round" />
                                                        </svg>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="w-auto">
                                        <div class="pet-type-wrapper wider">
                                            <p class="label">Pet Type</p>

                                            <div class="pet-toggle">
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
                                    </div>
                                    <div class="w-auto">
                                        <div class="pet-weight-wrapper wider">
                                            <p class="label">Pet Size</p>

                                            <div class="weight-toggle">
                                                <button type="button" class="weight-option large active"
                                                    data-weight="large">
                                                    <span>Large 19+ kg</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="w-auto">
                                        <div class="filter-section">
                                            <div class="filter-svg">
                                                <button type="button" class="filter-button">Filter</button>
                                                <svg data-modal-open="groomModal" class="filters-icon" xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                    viewBox="0 0 20 20" fill="none">
                                                    <path
                                                        d="M3 9.75C2.40326 9.75 1.83097 9.51295 1.40901 9.09099C0.987053 8.66903 0.75 8.09674 0.75 7.5C0.75 6.90326 0.987053 6.33097 1.40901 5.90901C1.83097 5.48705 2.40326 5.25 3 5.25M3 9.75C3.59674 9.75 4.16903 9.51295 4.59099 9.09099C5.01295 8.66903 5.25 8.09674 5.25 7.5C5.25 6.90326 5.01295 6.33097 4.59099 5.90901C4.16903 5.48705 3.59674 5.25 3 5.25M3 9.75V18.75M3 5.25V0.75M9.75 16.5C9.15326 16.5 8.58097 16.2629 8.15901 15.841C7.73705 15.419 7.5 14.8467 7.5 14.25C7.5 13.6533 7.73705 13.081 8.15901 12.659C8.58097 12.2371 9.15326 12 9.75 12M9.75 16.5C10.3467 16.5 10.919 16.2629 11.341 15.841C11.7629 15.419 12 14.8467 12 14.25C12 13.6533 11.7629 13.081 11.341 12.659C10.919 12.2371 10.3467 12 9.75 12M9.75 16.5V18.75M9.75 12V0.75M16.5 6.375C15.9033 6.375 15.331 6.13795 14.909 5.71599C14.4871 5.29403 14.25 4.72174 14.25 4.125C14.25 3.52826 14.4871 2.95597 14.909 2.53401C15.331 2.11205 15.9033 1.875 16.5 1.875M16.5 6.375C17.0967 6.375 17.669 6.13795 18.091 5.71599C18.5129 5.29403 18.75 4.72174 18.75 4.125C18.75 3.52826 18.5129 2.95597 18.091 2.53401C17.669 2.11205 17.0967 1.875 16.5 1.875M16.5 6.375V18.75M16.5 1.875V0.75"
                                                        stroke="#3B3731" stroke-width="1.5" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="find-space-search-content">
                            <div data-section="space" class="top-tabs find-space-search">
                                <p>Find Space</p>
                            </div>
                        </div>
                        <div class="find-space-search-content-area">
                            <form action="">
                                <div class="row gx-2 g-xs-5 input-fields mt-0 d-flex justify-content-center">
                                    <div class="w-auto">
                                        <div class="search-input">
                                            <p class="label">Search Space</p>
                                            <input type="text" value="London, NW3 1AA">
                                            <svg class="search-icon" xmlns="http://www.w3.org/2000/svg" width="16"
                                                height="16" fill="gray" viewBox="0 0 16 16">
                                                <path
                                                    d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85zm-5.242.656a5 5 0 1 1 0-10 5 5 0 0 1 0 10z" />
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="w-auto">
                                        <div class="service-type-select">
                                            <p class="label">Space Type</p>
                                            <div class="custom-select custom-select-streched">
                                                <div class="select-trigger">
                                                    <span class="selected-text">Full Groom</span>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="8"
                                                        viewBox="0 0 15 8" fill="none">
                                                        <path d="M13.8737 0.5L7.13022 7.24344L0.499976 0.613201"
                                                            stroke="#3B3731" stroke-linecap="round"
                                                            stroke-linejoin="round" />
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
                                    <div class="w-auto">
                                        <div class="datetime-wrapper" id="datetime">
                                            <!-- Date field -->
                                            <div class="field-group">
                                                <p class="label">Date</p>
                                                <div class="field date streched" id="dateField">
                                                    <div class="input-row streched" tabindex="0" role="button"
                                                        aria-haspopup="dialog" aria-expanded="false">
                                                        <input class="fake-input" id="dateInput" readonly
                                                            placeholder="02/11/25" aria-label="Date input" />
                                                        <!-- chevron down svg -->
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="8"
                                                            viewBox="0 0 15 8" fill="none">
                                                            <path d="M13.5105 0.5L6.95017 7.06033L0.499971 0.610127"
                                                                stroke="#3B3731" stroke-linecap="round"
                                                                stroke-linejoin="round" />
                                                        </svg>
                                                    </div>

                                                    <div class="popover" id="datePopover" data-type="date">
                                                        <div style="display:flex;flex-direction: column;">
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
                                                                    <div>Time</div>
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
                                                <div class="field time streched" id="timeField">
                                                    <div class="input-row streched" tabindex="0" role="button"
                                                        aria-haspopup="dialog" aria-expanded="false">
                                                        <input class="fake-input" id="timeInput" readonly
                                                            placeholder="13:00" aria-label="Time input" />
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="8"
                                                            viewBox="0 0 15 8" fill="none">
                                                            <path d="M13.5105 0.5L6.95017 7.06033L0.499971 0.610127"
                                                                stroke="#3B3731" stroke-linecap="round"
                                                                stroke-linejoin="round" />
                                                        </svg>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="w-auto">
                                        <div class="pet-type-wrapper wider">
                                            <p class="label">Pet Type</p>

                                            <div class="pet-toggle">
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
                                    </div>
                                    <div class="w-auto">
                                        <div class="pet-weight-wrapper wider">
                                            <p class="label">Pet Size</p>

                                            <div class="weight-toggle">
                                                <button type="button" class="weight-option large active"
                                                    data-weight="large">
                                                    <span>Large 19+ kg</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="w-auto">
                                        <div class="filter-section">
                                            <div class="filter-svg">
                                                <button type="button" class="filter-button">Filter</button>
                                                <svg data-modal-open="spaceModal" xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                    viewBox="0 0 20 20" fill="none">
                                                    <path
                                                        d="M3 9.75C2.40326 9.75 1.83097 9.51295 1.40901 9.09099C0.987053 8.66903 0.75 8.09674 0.75 7.5C0.75 6.90326 0.987053 6.33097 1.40901 5.90901C1.83097 5.48705 2.40326 5.25 3 5.25M3 9.75C3.59674 9.75 4.16903 9.51295 4.59099 9.09099C5.01295 8.66903 5.25 8.09674 5.25 7.5C5.25 6.90326 5.01295 6.33097 4.59099 5.90901C4.16903 5.48705 3.59674 5.25 3 5.25M3 9.75V18.75M3 5.25V0.75M9.75 16.5C9.15326 16.5 8.58097 16.2629 8.15901 15.841C7.73705 15.419 7.5 14.8467 7.5 14.25C7.5 13.6533 7.73705 13.081 8.15901 12.659C8.58097 12.2371 9.15326 12 9.75 12M9.75 16.5C10.3467 16.5 10.919 16.2629 11.341 15.841C11.7629 15.419 12 14.8467 12 14.25C12 13.6533 11.7629 13.081 11.341 12.659C10.919 12.2371 10.3467 12 9.75 12M9.75 16.5V18.75M9.75 12V0.75M16.5 6.375C15.9033 6.375 15.331 6.13795 14.909 5.71599C14.4871 5.29403 14.25 4.72174 14.25 4.125C14.25 3.52826 14.4871 2.95597 14.909 2.53401C15.331 2.11205 15.9033 1.875 16.5 1.875M16.5 6.375C17.0967 6.375 17.669 6.13795 18.091 5.71599C18.5129 5.29403 18.75 4.72174 18.75 4.125C18.75 3.52826 18.5129 2.95597 18.091 2.53401C17.669 2.11205 17.0967 1.875 16.5 1.875M16.5 6.375V18.75M16.5 1.875V0.75"
                                                        stroke="#3B3731" stroke-width="1.5" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="groomer-tab-content main-tab-content" id="groomer">
        <section class="tabs section-gap">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="outer-tab-div d-flex align-items-center">
                            <div class="heading-count d-flex align-items-center">
                                <h1 class="heading">Groomer Results</h1>
                                <span class="count">25</span>
                            </div>

                            <div class="groomer-tabs text-center">
                                <a data-tab="groomer-calendar-view" class="tablinks active">Calendar View</a>
                                <a data-tab="groomer-map-view" class="tablinks">Map View</a>
                                <a data-tab="groomer-list-view" class="tablinks">List View</a>
                            </div>
                        </div>
                    </div>


                    <?php include('../components/groomer_venue_sort_options.php'); ?>




                    <div data-tab-content="groomer-calendar-view" class="tabcontent">
                        <?php include('../components/groomer_tab_calendar_view.php'); ?>
                    </div>

                    <div data-tab-content="groomer-map-view" class="tabcontent" style="display: none;">
                        <?php include('../components/groomer_tab_map_view.php'); ?>
                    </div>

                    <div data-tab-content="groomer-list-view" class="tabcontent" style="display: none;">
                        <?php include('../components/groomer_tab_list_view.php'); ?>
                    </div>
                </div>
            </div>
        </section>


    </div>
    <div class="space-tab-content main-tab-content" id="space">
        <section class="tabs section-gap">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="outer-tab-div d-flex align-items-center">
                            <div class="heading-count d-flex align-items-center">
                                <h1 class="heading">Space Results</h1>
                                <span class="count">25</span>
                            </div>

                            <div class="groomer-tabs text-center">
                                <a data-tab="space-calendar-view" class="tablinks active">Calendar View</a>
                                <a data-tab="space-map-view" class="tablinks">Map View</a>
                                <a data-tab="space-list-view" class="tablinks">List View</a>
                            </div>
                        </div>
                    </div>

                    <?php include('../components/space_venue_sort_options.php'); ?>


                    <!-- not found groomers -->
                    <div class="col-lg-12 d-flex align-items-center justify-content-center section-gap">
                        <p class="not-found-message">Sorry, <span class="not-found-message">your preferred location isn't available today, <br>
                                please see below for groomers in the nearest proximity!</span></p>
                    </div>


                    <div data-tab-content="space-calendar-view" class="tabcontent">
                        <?php include('../components/space_tab_calendar_view.php'); ?>
                    </div>

                    <div data-tab-content="space-map-view" class="tabcontent" style="display: none;">
                        <?php include('../components/space_tab_map_view.php'); ?>
                    </div>

                    <div data-tab-content="space-list-view" class="tabcontent" style="display: none;">
                        <?php include('../components/space_tab_list_view.php'); ?>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- footer -->
    <?php include '../components/footer.php' ?>
    <!-- footer -->

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="<?= BASE_URL ?>/assets/js/customer_journey.js"></script>


</body>

</html>

</body>

</html>