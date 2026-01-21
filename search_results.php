<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fursgo</title>
    <link rel="stylesheet" href="assets/css/responsive.css">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/css/media_query.css">
    <link rel="stylesheet" href="assets/css/customer_journey.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

</head>

<body>

    <!-- header -->
    <?php include 'components/header.php' ?>
    <!-- header -->

    <!-- filter modal  -->
    <?php include 'components/filter_modals.php' ?>
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
                                                <svg data-modal-open="groomModal" class="filters-icon"
                                                    xmlns="http://www.w3.org/2000/svg" width="20" height="20"
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
                                                    <span class="selected-text">Mobile Station</span>
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
                                                <svg data-modal-open="spaceModal" xmlns="http://www.w3.org/2000/svg"
                                                    width="20" height="20" viewBox="0 0 20 20" fill="none">
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


                    <div class="col-lg-12 section-gap">
                        <div class="selection-box d-flex align-items-center justify-content-between">
                            <div class="selected-item-section d-flex align-items-center">
                                <div class="selected-item d-flex align-items-center">
                                    <img src="assets/icons/fire.svg" class="svg" alt="">
                                    <p>Top Rated</p>
                                    <img src="assets/icons/cross.svg" class="cross svg" alt="">
                                </div>
                                <div class="selected-item d-flex align-items-center">
                                    <p>Mobile Station</p>
                                    <img src="assets/icons/cross.svg" class="cross svg" alt="">
                                </div>
                            </div>
                            <div class="venu-sorting-section d-flex align-items-center">
                                <div class="venue-selection">
                                    Groomer Venue
                                    &nbsp;
                                    <img src="assets/icons/filter-arrow-down.svg" class="svg" alt="">
                                    <div class="venue-list">
                                        <div class="venu dropdown">
                                            <ul>
                                                <li class="active">
                                                    <span class="option-text">Recommended (default)</span>
                                                    <span class="radio-circle"></span>
                                                </li>
                                                <li>
                                                    <span class="option-text">Salons</span>
                                                    <span class="radio-circle"></span>
                                                </li>
                                                <li>
                                                    <span class="option-text">Groomer’s studio</span>
                                                    <span class="radio-circle"></span>
                                                </li>
                                                <li>
                                                    <span class="option-text">Homevisit</span>
                                                    <span class="radio-circle"></span>
                                                </li>
                                                <li>
                                                    <span class="option-text">
                                                        Visiting Groomers
                                                        &nbsp;&nbsp;

                                                        <span class="tooltip">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="12"
                                                                height="12" viewBox="0 0 12 12" fill="none">
                                                                <path
                                                                    d="M5.4 8.4C5.4 8.73137 5.66863 9 6 9C6.33137 9 6.6 8.73137 6.6 8.4V6C6.6 5.66863 6.33137 5.4 6 5.4C5.66863 5.4 5.4 5.66863 5.4 6V8.4ZM6 4.2C6.17 4.2 6.3126 4.1424 6.4278 4.0272C6.543 3.912 6.6004 3.7696 6.6 3.6C6.5996 3.4304 6.542 3.288 6.4272 3.1728C6.3124 3.0576 6.17 3 6 3C5.83 3 5.6876 3.0576 5.5728 3.1728C5.458 3.288 5.4004 3.4304 5.4 3.6C5.3996 3.7696 5.4572 3.9122 5.5728 4.0278C5.6884 4.1434 5.8308 4.2008 6 4.2ZM6 12C5.17 12 4.39 11.8424 3.66 11.5272C2.93 11.212 2.295 10.7846 1.755 10.245C1.215 9.7054 0.7876 9.0704 0.4728 8.34C0.158001 7.6096 0.000400759 6.8296 7.59493e-07 6C-0.00039924 5.1704 0.157201 4.3904 0.4728 3.66C0.7884 2.9296 1.2158 2.2946 1.755 1.755C2.2942 1.2154 2.9292 0.788 3.66 0.4728C4.3908 0.1576 5.1708 0 6 0C6.8292 0 7.6092 0.1576 8.33999 0.4728C9.07079 0.788 9.7058 1.2154 10.245 1.755C10.7842 2.2946 11.2118 2.9296 11.5278 3.66C11.8438 4.3904 12.0012 5.1704 12 6C11.9988 6.8296 11.8412 7.6096 11.5272 8.34C11.2132 9.0704 10.7858 9.7054 10.245 10.245C9.7042 10.7846 9.06919 11.2122 8.33999 11.5278C7.6108 11.8434 6.8308 12.0008 6 12ZM6 10.8C7.34 10.8 8.47499 10.335 9.40499 9.405C10.335 8.475 10.8 7.34 10.8 6C10.8 4.66 10.335 3.525 9.40499 2.595C8.47499 1.665 7.34 1.2 6 1.2C4.66 1.2 3.525 1.665 2.595 2.595C1.665 3.525 1.2 4.66 1.2 6C1.2 7.34 1.665 8.475 2.595 9.405C3.525 10.335 4.66 10.8 6 10.8Z"
                                                                    fill="#9D9B98" />
                                                            </svg>

                                                            <span class="tooltiptext">
                                                                Visiting Groomers provide mobile services
                                                                and don’t have
                                                                a
                                                                grooming space.
                                                            </span>
                                                        </span>
                                                    </span>

                                                    <span class="radio-circle"></span>
                                                </li>
                                                <li>
                                                    <span class="option-text">Mobile Station</span>
                                                    <span class="radio-circle"></span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="sort-by">
                                    Sort
                                    &nbsp;
                                    <img src="assets/icons/filter-arrow-down.svg" class="svg" alt="">
                                    <div class="sort-by-filter">
                                        <div class="sort dropdown">
                                            <ul>
                                                <li class="active">
                                                    <span class="option-text">Recommended (default)</span>
                                                    <span class="radio-circle"></span>
                                                </li>
                                                <li>
                                                    <span class="option-text">Distance</span>
                                                    <span class="radio-circle"></span>
                                                </li>
                                                <li>
                                                    <span class="option-text">Lowest price</span>
                                                    <span class="radio-circle"></span>
                                                </li>
                                                <li>
                                                    <span class="option-text">Soonest available</span>
                                                    <span class="radio-circle"></span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div data-tab-content="groomer-calendar-view" class="tabcontent">
                        <section class="section-gap">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="scroll-calendar">
                                            <div class="calendar-header">
                                                <div class="nav">
                                                    <button class="prev">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="8" height="15"
                                                            viewBox="0 0 8 15" fill="none">
                                                            <path d="M7.24344 13.8737L0.499997 7.13025L7.13024 0.500006"
                                                                stroke="#3B3731" stroke-linecap="round"
                                                                stroke-linejoin="round" />
                                                        </svg>
                                                    </button>
                                                    <span class="range" id="range"></span>
                                                    <button class="next">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="8" height="15"
                                                            viewBox="0 0 8 15" fill="none">
                                                            <path d="M0.5 13.8737L7.24344 7.13025L0.613202 0.500006"
                                                                stroke="#3B3731" stroke-linecap="round"
                                                                stroke-linejoin="round" />
                                                        </svg>
                                                    </button>
                                                </div>
                                                <div class="month"></div>
                                            </div>

                                            <div class="week"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>

                        <div class="container">
                            <hr style="border-top: 1px solid #DFDFDF;">
                        </div>

                        <section class="section">
                            <div class="container">
                                <div class="row g-3">
                                    <div class="col-lg-6">
                                        <div class="card active">
                                            <div class="left">
                                                <div class="top-left-svg">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="21" height="22"
                                                        viewBox="0 0 21 22" fill="none">
                                                        <rect x="4.14746" y="4.14746" width="12.443" height="13.8256"
                                                            rx="3" fill="white" />
                                                        <path
                                                            d="M10.9482 0.125295C10.7667 0.043205 10.5723 0 10.3692 0C10.1662 0 9.97174 0.043205 9.79028 0.125295L1.65477 3.57738C0.704262 3.97918 -0.00430085 4.91673 1.96518e-05 6.0487C0.0216222 10.3346 1.78439 18.1764 9.22861 21.7408C9.95014 22.0864 10.7883 22.0864 11.5098 21.7408C18.9541 18.1764 20.7168 10.3346 20.7384 6.0487C20.7428 4.91673 20.0342 3.97918 19.0837 3.57738L10.9482 0.125295ZM6.26043 12.3653C6.46781 12.4171 6.68816 12.443 6.91282 12.443C8.43796 12.443 9.67795 11.2031 9.67795 9.67793V6.9128H11.5876C12.1104 6.9128 12.59 7.2066 12.8233 7.67753L13.1343 8.29537H15.8995C16.2797 8.29537 16.5907 8.60644 16.5907 8.98665V10.3692C16.5907 12.2789 15.044 13.8256 13.1343 13.8256H11.0605V16.0161C11.0605 16.3315 10.8056 16.5907 10.4859 16.5907C10.4081 16.5907 10.3303 16.5734 10.2612 16.5432L5.99688 14.7156C5.71172 14.5947 5.53026 14.3138 5.53026 14.0071C5.53026 13.8861 5.55619 13.7694 5.61235 13.6614L6.26043 12.3653ZM6.22154 6.9128H8.29538V9.67793C8.29538 10.4427 7.67755 11.0605 6.91282 11.0605C6.1481 11.0605 5.53026 10.4427 5.53026 9.67793V7.60408C5.53026 7.22388 5.84134 6.9128 6.22154 6.9128ZM11.7518 8.98665C11.7518 8.80331 11.679 8.62748 11.5493 8.49784C11.4197 8.3682 11.2438 8.29537 11.0605 8.29537C10.8772 8.29537 10.7013 8.3682 10.5717 8.49784C10.4421 8.62748 10.3692 8.80331 10.3692 8.98665C10.3692 9.16998 10.4421 9.34581 10.5717 9.47545C10.7013 9.60509 10.8772 9.67793 11.0605 9.67793C11.2438 9.67793 11.4197 9.60509 11.5493 9.47545C11.679 9.34581 11.7518 9.16998 11.7518 8.98665Z"
                                                            fill="#C9DDA0" />
                                                    </svg>
                                                </div>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="270" height="246"
                                                    viewBox="0 0 170 246">
                                                    <defs>
                                                        <clipPath id="cardClip">
                                                            <path
                                                                d="M165 0C167.761 2.57702e-06 170 2.23858 170 5V241C170 243.761 167.761 246 165 246H5C2.23858 246 0 243.761 0 241V37C0 34.2386 2.23858 32 5 32H27C29.7614 32 32 29.7614 32 27V5C32 2.23858 34.2386 0 37 0H165Z" />
                                                        </clipPath>
                                                    </defs>

                                                    <!-- Image with clip path -->
                                                    <image href="assets/images/card1.png"
                                                        preserveAspectRatio="xMidYMid slice"
                                                        clip-path="url(#cardClip)" />
                                                </svg>
                                            </div>
                                            <div class="right">
                                                <div class="top-row">
                                                    <div class="tags" aria-hidden="true">
                                                        <div class="tag">Home Visit</div>
                                                        <div class="tag">Mobile Station</div>
                                                    </div>
                                                    <div class="icons" aria-hidden="true">
                                                        <button class="first-icon" title="Top-rated">
                                                            <!-- crown -->
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="10"
                                                                height="9" viewBox="0 0 10 9" fill="none">
                                                                <path
                                                                    d="M2 8.99999C1.85833 8.99999 1.73967 8.95199 1.644 8.85599C1.54833 8.75999 1.50033 8.64133 1.5 8.49999C1.49967 8.35866 1.54767 8.23999 1.644 8.14399C1.74033 8.04799 1.859 7.99999 2 7.99999H8C8.14166 7.99999 8.2605 8.04799 8.3565 8.14399C8.4525 8.23999 8.50033 8.35866 8.5 8.49999C8.49966 8.64133 8.45166 8.76016 8.356 8.85649C8.26033 8.95283 8.14166 9.00066 8 8.99999H2ZM2.35 7.24999C2.10833 7.24999 1.89383 7.17083 1.7065 7.0125C1.51917 6.85416 1.4045 6.65416 1.3625 6.4125L0.862501 3.2375C0.845834 3.2375 0.827167 3.23967 0.806501 3.244C0.785834 3.24833 0.767001 3.25033 0.750001 3.25C0.541667 3.25 0.364668 3.17717 0.219001 3.0315C0.0733344 2.88583 0.000334469 2.70867 1.13636e-06 2.5C-0.000332197 2.29133 0.0726677 2.11433 0.219001 1.969C0.365334 1.82367 0.542334 1.75067 0.750001 1.75C0.957667 1.74933 1.13483 1.82233 1.2815 1.969C1.42817 2.11567 1.501 2.29267 1.5 2.5C1.5 2.55833 1.49367 2.6125 1.481 2.6625C1.46833 2.7125 1.45383 2.75833 1.4375 2.8L3 3.5L4.5625 1.3625C4.47083 1.29583 4.39583 1.20833 4.3375 1.1C4.27917 0.991667 4.25 0.875 4.25 0.75C4.25 0.541667 4.323 0.364501 4.469 0.218501C4.615 0.0725011 4.792 -0.000332194 5 1.13895e-06C5.208 0.000334472 5.38516 0.0733344 5.5315 0.219001C5.67783 0.364667 5.75066 0.541667 5.75 0.75C5.75 0.875 5.72083 0.991667 5.6625 1.1C5.60416 1.20833 5.52916 1.29583 5.4375 1.3625L7 3.5L8.5625 2.8C8.54583 2.75833 8.53116 2.7125 8.5185 2.6625C8.50583 2.6125 8.49966 2.55833 8.5 2.5C8.5 2.29167 8.573 2.1145 8.719 1.9685C8.865 1.8225 9.042 1.74967 9.25 1.75C9.458 1.75033 9.63516 1.82333 9.7815 1.969C9.92783 2.11467 10.0007 2.29167 10 2.5C9.99933 2.70833 9.92649 2.8855 9.7815 3.0315C9.6365 3.1775 9.45933 3.25033 9.25 3.25C9.23333 3.25 9.21466 3.248 9.194 3.244C9.17333 3.24 9.1545 3.23783 9.1375 3.2375L8.6375 6.4125C8.59583 6.65416 8.48133 6.85416 8.294 7.0125C8.10666 7.17083 7.892 7.24999 7.65 7.24999H2.35ZM2.35 6.25H7.65L7.975 4.1625L7.4 4.4125C7.18333 4.50416 6.9625 4.52083 6.7375 4.4625C6.5125 4.40416 6.32916 4.27916 6.1875 4.0875L5 2.45L3.8125 4.0875C3.67083 4.27916 3.4875 4.40416 3.2625 4.4625C3.0375 4.52083 2.81667 4.50416 2.6 4.4125L2.025 4.1625L2.35 6.25Z"
                                                                    fill="white" />
                                                            </svg>
                                                        </button>
                                                        <button class="second-icon" title="Favourite">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="9"
                                                                height="11" viewBox="0 0 9 11" fill="none">
                                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                                    d="M3.79701 0.30821C3.81025 0.23997 3.84191 0.176658 3.88858 0.125138C3.93524 0.0736173 3.99512 0.0358558 4.06172 0.0159479C4.12832 -0.00396001 4.1991 -0.00525449 4.26638 0.0122049C4.33367 0.0296642 4.39489 0.0652111 4.4434 0.114991C4.56671 0.240837 4.80378 0.489988 5.04467 0.777274C5.28111 1.05884 5.53916 1.39761 5.68788 1.69951C5.8328 1.99443 5.98661 2.37578 6.10801 2.69421L6.67305 1.75354C6.70456 1.701 6.74826 1.65683 6.80046 1.62476C6.85265 1.59269 6.91181 1.57367 6.97292 1.56931C7.03402 1.56494 7.09528 1.57536 7.1515 1.59969C7.20773 1.62401 7.25727 1.66152 7.29592 1.70905C8.09867 2.70057 8.49846 3.76263 8.6974 4.57365C8.79718 4.97979 8.8474 5.32491 8.87282 5.57025C8.88576 5.69278 8.89424 5.81574 8.89824 5.93889V5.97131C8.89824 8.4482 6.93364 10.4649 4.44785 10.4649C1.96206 10.4649 0 8.44756 0 5.97004C0 5.28805 0.322244 3.68192 1.27563 2.36498C1.31266 2.31422 1.36166 2.27341 1.41826 2.24615C1.47487 2.2189 1.53734 2.20605 1.60011 2.20876C1.66287 2.21146 1.724 2.22963 1.77806 2.26166C1.83211 2.29368 1.87741 2.33856 1.90994 2.39231L2.55507 3.46709C2.75083 3.16073 3.01269 2.73044 3.21163 2.3332C3.49765 1.76117 3.72455 0.682572 3.79701 0.308845M4.3201 0.912655C4.20506 1.42113 4.01501 2.14697 3.77985 2.61858C3.46714 3.24336 3.0165 3.9298 2.86142 4.16051C2.82554 4.21345 2.77693 4.25651 2.72005 4.28574C2.66317 4.31497 2.59986 4.32943 2.53593 4.32778C2.472 4.32614 2.40952 4.30844 2.35422 4.27632C2.29892 4.24421 2.25258 4.1987 2.21948 4.14399L1.57118 3.06476C0.87457 4.19166 0.635589 5.45839 0.635589 5.97131C0.635589 8.10561 2.32244 9.82806 4.44785 9.82806C6.57326 9.82806 8.26265 8.10561 8.26265 5.97131V5.95351L8.26011 5.88995C8.25568 5.80484 8.24911 5.71986 8.24041 5.63508C8.20712 5.3287 8.15362 5.02487 8.08024 4.72555C7.87826 3.89157 7.52027 3.10334 7.02516 2.40248L6.38068 3.47535C6.34338 3.53732 6.28925 3.58743 6.22459 3.61985C6.15993 3.65227 6.08739 3.66566 6.01542 3.65847C5.94344 3.65128 5.87499 3.6238 5.81802 3.57923C5.76105 3.53466 5.71791 3.47483 5.6936 3.40671C5.59064 3.11815 5.33831 2.42917 5.11713 1.98044C5.00463 1.751 4.78916 1.46117 4.55781 1.18596C4.4801 1.09353 4.40086 1.00242 4.3201 0.912655Z"
                                                                    fill="#FEFEFE" />
                                                            </svg>
                                                        </button>
                                                    </div>
                                                </div>

                                                <h2 class="name">Sarah W.</h2>

                                                <div
                                                    class="studio-details mt-1 d-flex align-items-center justify-content-between">

                                                    <div class="studio">
                                                        <div class="studio">Sarah’s Grooming Studio</div>
                                                    </div>

                                                    <div class="meta d-flex align-items-center justify-content-between">
                                                        <div class="distance" title="Distance">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="10"
                                                                height="14" viewBox="0 0 10 14" fill="none">
                                                                <path
                                                                    d="M5 6.65C4.5264 6.65 4.0722 6.46563 3.73731 6.13744C3.40242 5.80925 3.21429 5.36413 3.21429 4.9C3.21429 4.43587 3.40242 3.99075 3.73731 3.66256C4.0722 3.33437 4.5264 3.15 5 3.15C5.4736 3.15 5.9278 3.33437 6.26269 3.66256C6.59758 3.99075 6.78571 4.43587 6.78571 4.9C6.78571 5.12981 6.73953 5.35738 6.64979 5.5697C6.56004 5.78202 6.42851 5.97493 6.26269 6.13744C6.09687 6.29994 5.90002 6.42884 5.68336 6.51679C5.46671 6.60473 5.2345 6.65 5 6.65ZM5 0C3.67392 0 2.40215 0.516248 1.46447 1.43518C0.526784 2.3541 0 3.60044 0 4.9C0 8.575 5 14 5 14C5 14 10 8.575 10 4.9C10 3.60044 9.47322 2.3541 8.53553 1.43518C7.59785 0.516248 6.32608 0 5 0Z"
                                                                    fill="var(--active-bg)" />
                                                            </svg>
                                                            <span>2.5 mi</span>
                                                        </div>


                                                        <div class="rating" title="Rating">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="14"
                                                                height="14" viewBox="0 0 14 14" fill="none">
                                                                <path
                                                                    d="M6.12956 0.660476C6.40354 -0.220161 7.59647 -0.220158 7.87045 0.660479L8.89548 3.95519C9.01801 4.34902 9.36942 4.61566 9.76593 4.61566H13.083C13.9696 4.61566 14.3383 5.80055 13.621 6.34481L10.9374 8.38106C10.6166 8.62446 10.4824 9.0559 10.6049 9.44973L11.63 12.7444C11.9039 13.6251 10.9388 14.3574 10.2215 13.8131L7.53797 11.7769C7.21719 11.5335 6.78282 11.5335 6.46204 11.7769L3.77846 13.8131C3.06117 14.3574 2.09607 13.6251 2.37005 12.7444L3.39508 9.44973C3.51761 9.0559 3.38338 8.62446 3.0626 8.38106L0.37903 6.34481C-0.338258 5.80055 0.0303816 4.61566 0.916998 4.61566H4.23408C4.63058 4.61566 4.98199 4.34902 5.10452 3.95519L6.12956 0.660476Z"
                                                                    fill="var(--active-bg)" />
                                                            </svg>
                                                            <span>4.3 <small
                                                                    style="color:var(--muted)">(20)</small></span>
                                                        </div>
                                                    </div>
                                                </div>



                                                <p class="experience">Gentle, breed-specific trims · 6+ years
                                                    experience.</p>


                                                <div class="availability">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15"
                                                        viewBox="0 0 15 15" fill="none">
                                                        <path
                                                            d="M7.5 0C3.375 0 0 3.375 0 7.5C0 11.625 3.375 15 7.5 15C11.625 15 15 11.625 15 7.5C15 3.375 11.625 0 7.5 0ZM6 11.25L2.25 7.5L3.3075 6.4425L6 9.1275L11.6925 3.435L12.75 4.5L6 11.25Z"
                                                            fill="#D8E8B7" />
                                                    </svg>
                                                    <span>Availability</span>
                                                </div>


                                                <div class="slots-price d-flex align-items-center">
                                                    <div class="slots d-flex" aria-label="Available slots">
                                                        <div class="slot highlight">Mon 1, 08:30 AM</div>
                                                        <div class="slot">Tue 15, 12:30 PM</div>
                                                        <div class="slot">Wed 27, 09:15 AM</div>
                                                        <div class="slot">Thu 9, 15:45 PM</div>
                                                    </div>
                                                    <div class="price">From <span>£38</span></div>
                                                </div>



                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="card">
                                            <div class="left">
                                                <div class="top-left-svg">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="21" height="22"
                                                        viewBox="0 0 21 22" fill="none">
                                                        <rect x="4.14746" y="4.14746" width="12.443" height="13.8256"
                                                            rx="3" fill="white" />
                                                        <path
                                                            d="M10.9482 0.125295C10.7667 0.043205 10.5723 0 10.3692 0C10.1662 0 9.97174 0.043205 9.79028 0.125295L1.65477 3.57738C0.704262 3.97918 -0.00430085 4.91673 1.96518e-05 6.0487C0.0216222 10.3346 1.78439 18.1764 9.22861 21.7408C9.95014 22.0864 10.7883 22.0864 11.5098 21.7408C18.9541 18.1764 20.7168 10.3346 20.7384 6.0487C20.7428 4.91673 20.0342 3.97918 19.0837 3.57738L10.9482 0.125295ZM6.26043 12.3653C6.46781 12.4171 6.68816 12.443 6.91282 12.443C8.43796 12.443 9.67795 11.2031 9.67795 9.67793V6.9128H11.5876C12.1104 6.9128 12.59 7.2066 12.8233 7.67753L13.1343 8.29537H15.8995C16.2797 8.29537 16.5907 8.60644 16.5907 8.98665V10.3692C16.5907 12.2789 15.044 13.8256 13.1343 13.8256H11.0605V16.0161C11.0605 16.3315 10.8056 16.5907 10.4859 16.5907C10.4081 16.5907 10.3303 16.5734 10.2612 16.5432L5.99688 14.7156C5.71172 14.5947 5.53026 14.3138 5.53026 14.0071C5.53026 13.8861 5.55619 13.7694 5.61235 13.6614L6.26043 12.3653ZM6.22154 6.9128H8.29538V9.67793C8.29538 10.4427 7.67755 11.0605 6.91282 11.0605C6.1481 11.0605 5.53026 10.4427 5.53026 9.67793V7.60408C5.53026 7.22388 5.84134 6.9128 6.22154 6.9128ZM11.7518 8.98665C11.7518 8.80331 11.679 8.62748 11.5493 8.49784C11.4197 8.3682 11.2438 8.29537 11.0605 8.29537C10.8772 8.29537 10.7013 8.3682 10.5717 8.49784C10.4421 8.62748 10.3692 8.80331 10.3692 8.98665C10.3692 9.16998 10.4421 9.34581 10.5717 9.47545C10.7013 9.60509 10.8772 9.67793 11.0605 9.67793C11.2438 9.67793 11.4197 9.60509 11.5493 9.47545C11.679 9.34581 11.7518 9.16998 11.7518 8.98665Z"
                                                            fill="#C9DDA0" />
                                                    </svg>
                                                </div>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="270" height="246"
                                                    viewBox="0 0 170 246">
                                                    <defs>
                                                        <clipPath id="cardClip">
                                                            <path
                                                                d="M165 0C167.761 2.57702e-06 170 2.23858 170 5V241C170 243.761 167.761 246 165 246H5C2.23858 246 0 243.761 0 241V37C0 34.2386 2.23858 32 5 32H27C29.7614 32 32 29.7614 32 27V5C32 2.23858 34.2386 0 37 0H165Z" />
                                                        </clipPath>
                                                    </defs>

                                                    <!-- Image with clip path -->
                                                    <image href="assets/images/card2.png"
                                                        preserveAspectRatio="xMidYMid slice"
                                                        clip-path="url(#cardClip)" />
                                                </svg>
                                            </div>
                                            <div class="right">
                                                <div class="top-row">
                                                    <div class="tags" aria-hidden="true">
                                                        <div class="tag">Home Visit</div>
                                                        <div class="tag">Mobile Station</div>
                                                    </div>
                                                    <div class="icons" aria-hidden="true">
                                                        <button class="first-icon" title="Top-rated">
                                                            <!-- crown -->
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="10"
                                                                height="9" viewBox="0 0 10 9" fill="none">
                                                                <path
                                                                    d="M2 8.99999C1.85833 8.99999 1.73967 8.95199 1.644 8.85599C1.54833 8.75999 1.50033 8.64133 1.5 8.49999C1.49967 8.35866 1.54767 8.23999 1.644 8.14399C1.74033 8.04799 1.859 7.99999 2 7.99999H8C8.14166 7.99999 8.2605 8.04799 8.3565 8.14399C8.4525 8.23999 8.50033 8.35866 8.5 8.49999C8.49966 8.64133 8.45166 8.76016 8.356 8.85649C8.26033 8.95283 8.14166 9.00066 8 8.99999H2ZM2.35 7.24999C2.10833 7.24999 1.89383 7.17083 1.7065 7.0125C1.51917 6.85416 1.4045 6.65416 1.3625 6.4125L0.862501 3.2375C0.845834 3.2375 0.827167 3.23967 0.806501 3.244C0.785834 3.24833 0.767001 3.25033 0.750001 3.25C0.541667 3.25 0.364668 3.17717 0.219001 3.0315C0.0733344 2.88583 0.000334469 2.70867 1.13636e-06 2.5C-0.000332197 2.29133 0.0726677 2.11433 0.219001 1.969C0.365334 1.82367 0.542334 1.75067 0.750001 1.75C0.957667 1.74933 1.13483 1.82233 1.2815 1.969C1.42817 2.11567 1.501 2.29267 1.5 2.5C1.5 2.55833 1.49367 2.6125 1.481 2.6625C1.46833 2.7125 1.45383 2.75833 1.4375 2.8L3 3.5L4.5625 1.3625C4.47083 1.29583 4.39583 1.20833 4.3375 1.1C4.27917 0.991667 4.25 0.875 4.25 0.75C4.25 0.541667 4.323 0.364501 4.469 0.218501C4.615 0.0725011 4.792 -0.000332194 5 1.13895e-06C5.208 0.000334472 5.38516 0.0733344 5.5315 0.219001C5.67783 0.364667 5.75066 0.541667 5.75 0.75C5.75 0.875 5.72083 0.991667 5.6625 1.1C5.60416 1.20833 5.52916 1.29583 5.4375 1.3625L7 3.5L8.5625 2.8C8.54583 2.75833 8.53116 2.7125 8.5185 2.6625C8.50583 2.6125 8.49966 2.55833 8.5 2.5C8.5 2.29167 8.573 2.1145 8.719 1.9685C8.865 1.8225 9.042 1.74967 9.25 1.75C9.458 1.75033 9.63516 1.82333 9.7815 1.969C9.92783 2.11467 10.0007 2.29167 10 2.5C9.99933 2.70833 9.92649 2.8855 9.7815 3.0315C9.6365 3.1775 9.45933 3.25033 9.25 3.25C9.23333 3.25 9.21466 3.248 9.194 3.244C9.17333 3.24 9.1545 3.23783 9.1375 3.2375L8.6375 6.4125C8.59583 6.65416 8.48133 6.85416 8.294 7.0125C8.10666 7.17083 7.892 7.24999 7.65 7.24999H2.35ZM2.35 6.25H7.65L7.975 4.1625L7.4 4.4125C7.18333 4.50416 6.9625 4.52083 6.7375 4.4625C6.5125 4.40416 6.32916 4.27916 6.1875 4.0875L5 2.45L3.8125 4.0875C3.67083 4.27916 3.4875 4.40416 3.2625 4.4625C3.0375 4.52083 2.81667 4.50416 2.6 4.4125L2.025 4.1625L2.35 6.25Z"
                                                                    fill="white" />
                                                            </svg>
                                                        </button>
                                                        <button class="second-icon" title="Favourite">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="9"
                                                                height="11" viewBox="0 0 9 11" fill="none">
                                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                                    d="M3.79701 0.30821C3.81025 0.23997 3.84191 0.176658 3.88858 0.125138C3.93524 0.0736173 3.99512 0.0358558 4.06172 0.0159479C4.12832 -0.00396001 4.1991 -0.00525449 4.26638 0.0122049C4.33367 0.0296642 4.39489 0.0652111 4.4434 0.114991C4.56671 0.240837 4.80378 0.489988 5.04467 0.777274C5.28111 1.05884 5.53916 1.39761 5.68788 1.69951C5.8328 1.99443 5.98661 2.37578 6.10801 2.69421L6.67305 1.75354C6.70456 1.701 6.74826 1.65683 6.80046 1.62476C6.85265 1.59269 6.91181 1.57367 6.97292 1.56931C7.03402 1.56494 7.09528 1.57536 7.1515 1.59969C7.20773 1.62401 7.25727 1.66152 7.29592 1.70905C8.09867 2.70057 8.49846 3.76263 8.6974 4.57365C8.79718 4.97979 8.8474 5.32491 8.87282 5.57025C8.88576 5.69278 8.89424 5.81574 8.89824 5.93889V5.97131C8.89824 8.4482 6.93364 10.4649 4.44785 10.4649C1.96206 10.4649 0 8.44756 0 5.97004C0 5.28805 0.322244 3.68192 1.27563 2.36498C1.31266 2.31422 1.36166 2.27341 1.41826 2.24615C1.47487 2.2189 1.53734 2.20605 1.60011 2.20876C1.66287 2.21146 1.724 2.22963 1.77806 2.26166C1.83211 2.29368 1.87741 2.33856 1.90994 2.39231L2.55507 3.46709C2.75083 3.16073 3.01269 2.73044 3.21163 2.3332C3.49765 1.76117 3.72455 0.682572 3.79701 0.308845M4.3201 0.912655C4.20506 1.42113 4.01501 2.14697 3.77985 2.61858C3.46714 3.24336 3.0165 3.9298 2.86142 4.16051C2.82554 4.21345 2.77693 4.25651 2.72005 4.28574C2.66317 4.31497 2.59986 4.32943 2.53593 4.32778C2.472 4.32614 2.40952 4.30844 2.35422 4.27632C2.29892 4.24421 2.25258 4.1987 2.21948 4.14399L1.57118 3.06476C0.87457 4.19166 0.635589 5.45839 0.635589 5.97131C0.635589 8.10561 2.32244 9.82806 4.44785 9.82806C6.57326 9.82806 8.26265 8.10561 8.26265 5.97131V5.95351L8.26011 5.88995C8.25568 5.80484 8.24911 5.71986 8.24041 5.63508C8.20712 5.3287 8.15362 5.02487 8.08024 4.72555C7.87826 3.89157 7.52027 3.10334 7.02516 2.40248L6.38068 3.47535C6.34338 3.53732 6.28925 3.58743 6.22459 3.61985C6.15993 3.65227 6.08739 3.66566 6.01542 3.65847C5.94344 3.65128 5.87499 3.6238 5.81802 3.57923C5.76105 3.53466 5.71791 3.47483 5.6936 3.40671C5.59064 3.11815 5.33831 2.42917 5.11713 1.98044C5.00463 1.751 4.78916 1.46117 4.55781 1.18596C4.4801 1.09353 4.40086 1.00242 4.3201 0.912655Z"
                                                                    fill="#FEFEFE" />
                                                            </svg>
                                                        </button>
                                                    </div>
                                                </div>

                                                <h2 class="name">Sarah W.</h2>

                                                <div
                                                    class="studio-details mt-1 d-flex align-items-center justify-content-between">

                                                    <div class="studio">
                                                        <div class="studio">Sarah’s Grooming Studio</div>
                                                    </div>

                                                    <div class="meta d-flex align-items-center justify-content-between">
                                                        <div class="distance" title="Distance">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="10"
                                                                height="14" viewBox="0 0 10 14" fill="none">
                                                                <path
                                                                    d="M5 6.65C4.5264 6.65 4.0722 6.46563 3.73731 6.13744C3.40242 5.80925 3.21429 5.36413 3.21429 4.9C3.21429 4.43587 3.40242 3.99075 3.73731 3.66256C4.0722 3.33437 4.5264 3.15 5 3.15C5.4736 3.15 5.9278 3.33437 6.26269 3.66256C6.59758 3.99075 6.78571 4.43587 6.78571 4.9C6.78571 5.12981 6.73953 5.35738 6.64979 5.5697C6.56004 5.78202 6.42851 5.97493 6.26269 6.13744C6.09687 6.29994 5.90002 6.42884 5.68336 6.51679C5.46671 6.60473 5.2345 6.65 5 6.65ZM5 0C3.67392 0 2.40215 0.516248 1.46447 1.43518C0.526784 2.3541 0 3.60044 0 4.9C0 8.575 5 14 5 14C5 14 10 8.575 10 4.9C10 3.60044 9.47322 2.3541 8.53553 1.43518C7.59785 0.516248 6.32608 0 5 0Z"
                                                                    fill="var(--active-bg)" />
                                                            </svg>
                                                            <span>2.5 mi</span>
                                                        </div>


                                                        <div class="rating" title="Rating">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="14"
                                                                height="14" viewBox="0 0 14 14" fill="none">
                                                                <path
                                                                    d="M6.12956 0.660476C6.40354 -0.220161 7.59647 -0.220158 7.87045 0.660479L8.89548 3.95519C9.01801 4.34902 9.36942 4.61566 9.76593 4.61566H13.083C13.9696 4.61566 14.3383 5.80055 13.621 6.34481L10.9374 8.38106C10.6166 8.62446 10.4824 9.0559 10.6049 9.44973L11.63 12.7444C11.9039 13.6251 10.9388 14.3574 10.2215 13.8131L7.53797 11.7769C7.21719 11.5335 6.78282 11.5335 6.46204 11.7769L3.77846 13.8131C3.06117 14.3574 2.09607 13.6251 2.37005 12.7444L3.39508 9.44973C3.51761 9.0559 3.38338 8.62446 3.0626 8.38106L0.37903 6.34481C-0.338258 5.80055 0.0303816 4.61566 0.916998 4.61566H4.23408C4.63058 4.61566 4.98199 4.34902 5.10452 3.95519L6.12956 0.660476Z"
                                                                    fill="var(--active-bg)" />
                                                            </svg>
                                                            <span>4.3 <small
                                                                    style="color:var(--muted)">(20)</small></span>
                                                        </div>
                                                    </div>
                                                </div>



                                                <p class="experience">Gentle, breed-specific trims · 6+ years
                                                    experience.</p>


                                                <div class="availability">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15"
                                                        viewBox="0 0 15 15" fill="none">
                                                        <path
                                                            d="M7.5 0C3.375 0 0 3.375 0 7.5C0 11.625 3.375 15 7.5 15C11.625 15 15 11.625 15 7.5C15 3.375 11.625 0 7.5 0ZM6 11.25L2.25 7.5L3.3075 6.4425L6 9.1275L11.6925 3.435L12.75 4.5L6 11.25Z"
                                                            fill="#D8E8B7" />
                                                    </svg>
                                                    <span>Availability</span>
                                                </div>


                                                <div class="slots-price d-flex align-items-center">
                                                    <div class="slots d-flex" aria-label="Available slots">
                                                        <div class="slot highlight">Mon 1, 08:30 AM</div>
                                                        <div class="slot">Tue 15, 12:30 PM</div>
                                                        <div class="slot">Wed 27, 09:15 AM</div>
                                                        <div class="slot">Thu 9, 15:45 PM</div>
                                                    </div>
                                                    <div class="price">From <span>£38</span></div>
                                                </div>



                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="card">
                                            <div class="left">
                                                <div class="top-left-svg">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="21" height="22"
                                                        viewBox="0 0 21 22" fill="none">
                                                        <rect x="4.14746" y="4.14746" width="12.443" height="13.8256"
                                                            rx="3" fill="white" />
                                                        <path
                                                            d="M10.9482 0.125295C10.7667 0.043205 10.5723 0 10.3692 0C10.1662 0 9.97174 0.043205 9.79028 0.125295L1.65477 3.57738C0.704262 3.97918 -0.00430085 4.91673 1.96518e-05 6.0487C0.0216222 10.3346 1.78439 18.1764 9.22861 21.7408C9.95014 22.0864 10.7883 22.0864 11.5098 21.7408C18.9541 18.1764 20.7168 10.3346 20.7384 6.0487C20.7428 4.91673 20.0342 3.97918 19.0837 3.57738L10.9482 0.125295ZM6.26043 12.3653C6.46781 12.4171 6.68816 12.443 6.91282 12.443C8.43796 12.443 9.67795 11.2031 9.67795 9.67793V6.9128H11.5876C12.1104 6.9128 12.59 7.2066 12.8233 7.67753L13.1343 8.29537H15.8995C16.2797 8.29537 16.5907 8.60644 16.5907 8.98665V10.3692C16.5907 12.2789 15.044 13.8256 13.1343 13.8256H11.0605V16.0161C11.0605 16.3315 10.8056 16.5907 10.4859 16.5907C10.4081 16.5907 10.3303 16.5734 10.2612 16.5432L5.99688 14.7156C5.71172 14.5947 5.53026 14.3138 5.53026 14.0071C5.53026 13.8861 5.55619 13.7694 5.61235 13.6614L6.26043 12.3653ZM6.22154 6.9128H8.29538V9.67793C8.29538 10.4427 7.67755 11.0605 6.91282 11.0605C6.1481 11.0605 5.53026 10.4427 5.53026 9.67793V7.60408C5.53026 7.22388 5.84134 6.9128 6.22154 6.9128ZM11.7518 8.98665C11.7518 8.80331 11.679 8.62748 11.5493 8.49784C11.4197 8.3682 11.2438 8.29537 11.0605 8.29537C10.8772 8.29537 10.7013 8.3682 10.5717 8.49784C10.4421 8.62748 10.3692 8.80331 10.3692 8.98665C10.3692 9.16998 10.4421 9.34581 10.5717 9.47545C10.7013 9.60509 10.8772 9.67793 11.0605 9.67793C11.2438 9.67793 11.4197 9.60509 11.5493 9.47545C11.679 9.34581 11.7518 9.16998 11.7518 8.98665Z"
                                                            fill="#C9DDA0" />
                                                    </svg>
                                                </div>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="270" height="246"
                                                    viewBox="0 0 170 246">
                                                    <defs>
                                                        <clipPath id="cardClip">
                                                            <path
                                                                d="M165 0C167.761 2.57702e-06 170 2.23858 170 5V241C170 243.761 167.761 246 165 246H5C2.23858 246 0 243.761 0 241V37C0 34.2386 2.23858 32 5 32H27C29.7614 32 32 29.7614 32 27V5C32 2.23858 34.2386 0 37 0H165Z" />
                                                        </clipPath>
                                                    </defs>

                                                    <!-- Image with clip path -->
                                                    <image href="assets/images/card3.png"
                                                        preserveAspectRatio="xMidYMid slice"
                                                        clip-path="url(#cardClip)" />
                                                </svg>
                                            </div>
                                            <div class="right">
                                                <div class="top-row">
                                                    <div class="tags" aria-hidden="true">
                                                        <div class="tag">Home Visit</div>
                                                        <div class="tag">Mobile Station</div>
                                                    </div>
                                                    <div class="icons" aria-hidden="true">
                                                        <button class="first-icon" title="Top-rated">
                                                            <!-- crown -->
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="10"
                                                                height="9" viewBox="0 0 10 9" fill="none">
                                                                <path
                                                                    d="M2 8.99999C1.85833 8.99999 1.73967 8.95199 1.644 8.85599C1.54833 8.75999 1.50033 8.64133 1.5 8.49999C1.49967 8.35866 1.54767 8.23999 1.644 8.14399C1.74033 8.04799 1.859 7.99999 2 7.99999H8C8.14166 7.99999 8.2605 8.04799 8.3565 8.14399C8.4525 8.23999 8.50033 8.35866 8.5 8.49999C8.49966 8.64133 8.45166 8.76016 8.356 8.85649C8.26033 8.95283 8.14166 9.00066 8 8.99999H2ZM2.35 7.24999C2.10833 7.24999 1.89383 7.17083 1.7065 7.0125C1.51917 6.85416 1.4045 6.65416 1.3625 6.4125L0.862501 3.2375C0.845834 3.2375 0.827167 3.23967 0.806501 3.244C0.785834 3.24833 0.767001 3.25033 0.750001 3.25C0.541667 3.25 0.364668 3.17717 0.219001 3.0315C0.0733344 2.88583 0.000334469 2.70867 1.13636e-06 2.5C-0.000332197 2.29133 0.0726677 2.11433 0.219001 1.969C0.365334 1.82367 0.542334 1.75067 0.750001 1.75C0.957667 1.74933 1.13483 1.82233 1.2815 1.969C1.42817 2.11567 1.501 2.29267 1.5 2.5C1.5 2.55833 1.49367 2.6125 1.481 2.6625C1.46833 2.7125 1.45383 2.75833 1.4375 2.8L3 3.5L4.5625 1.3625C4.47083 1.29583 4.39583 1.20833 4.3375 1.1C4.27917 0.991667 4.25 0.875 4.25 0.75C4.25 0.541667 4.323 0.364501 4.469 0.218501C4.615 0.0725011 4.792 -0.000332194 5 1.13895e-06C5.208 0.000334472 5.38516 0.0733344 5.5315 0.219001C5.67783 0.364667 5.75066 0.541667 5.75 0.75C5.75 0.875 5.72083 0.991667 5.6625 1.1C5.60416 1.20833 5.52916 1.29583 5.4375 1.3625L7 3.5L8.5625 2.8C8.54583 2.75833 8.53116 2.7125 8.5185 2.6625C8.50583 2.6125 8.49966 2.55833 8.5 2.5C8.5 2.29167 8.573 2.1145 8.719 1.9685C8.865 1.8225 9.042 1.74967 9.25 1.75C9.458 1.75033 9.63516 1.82333 9.7815 1.969C9.92783 2.11467 10.0007 2.29167 10 2.5C9.99933 2.70833 9.92649 2.8855 9.7815 3.0315C9.6365 3.1775 9.45933 3.25033 9.25 3.25C9.23333 3.25 9.21466 3.248 9.194 3.244C9.17333 3.24 9.1545 3.23783 9.1375 3.2375L8.6375 6.4125C8.59583 6.65416 8.48133 6.85416 8.294 7.0125C8.10666 7.17083 7.892 7.24999 7.65 7.24999H2.35ZM2.35 6.25H7.65L7.975 4.1625L7.4 4.4125C7.18333 4.50416 6.9625 4.52083 6.7375 4.4625C6.5125 4.40416 6.32916 4.27916 6.1875 4.0875L5 2.45L3.8125 4.0875C3.67083 4.27916 3.4875 4.40416 3.2625 4.4625C3.0375 4.52083 2.81667 4.50416 2.6 4.4125L2.025 4.1625L2.35 6.25Z"
                                                                    fill="white" />
                                                            </svg>
                                                        </button>
                                                        <button class="second-icon" title="Favourite">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="9"
                                                                height="11" viewBox="0 0 9 11" fill="none">
                                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                                    d="M3.79701 0.30821C3.81025 0.23997 3.84191 0.176658 3.88858 0.125138C3.93524 0.0736173 3.99512 0.0358558 4.06172 0.0159479C4.12832 -0.00396001 4.1991 -0.00525449 4.26638 0.0122049C4.33367 0.0296642 4.39489 0.0652111 4.4434 0.114991C4.56671 0.240837 4.80378 0.489988 5.04467 0.777274C5.28111 1.05884 5.53916 1.39761 5.68788 1.69951C5.8328 1.99443 5.98661 2.37578 6.10801 2.69421L6.67305 1.75354C6.70456 1.701 6.74826 1.65683 6.80046 1.62476C6.85265 1.59269 6.91181 1.57367 6.97292 1.56931C7.03402 1.56494 7.09528 1.57536 7.1515 1.59969C7.20773 1.62401 7.25727 1.66152 7.29592 1.70905C8.09867 2.70057 8.49846 3.76263 8.6974 4.57365C8.79718 4.97979 8.8474 5.32491 8.87282 5.57025C8.88576 5.69278 8.89424 5.81574 8.89824 5.93889V5.97131C8.89824 8.4482 6.93364 10.4649 4.44785 10.4649C1.96206 10.4649 0 8.44756 0 5.97004C0 5.28805 0.322244 3.68192 1.27563 2.36498C1.31266 2.31422 1.36166 2.27341 1.41826 2.24615C1.47487 2.2189 1.53734 2.20605 1.60011 2.20876C1.66287 2.21146 1.724 2.22963 1.77806 2.26166C1.83211 2.29368 1.87741 2.33856 1.90994 2.39231L2.55507 3.46709C2.75083 3.16073 3.01269 2.73044 3.21163 2.3332C3.49765 1.76117 3.72455 0.682572 3.79701 0.308845M4.3201 0.912655C4.20506 1.42113 4.01501 2.14697 3.77985 2.61858C3.46714 3.24336 3.0165 3.9298 2.86142 4.16051C2.82554 4.21345 2.77693 4.25651 2.72005 4.28574C2.66317 4.31497 2.59986 4.32943 2.53593 4.32778C2.472 4.32614 2.40952 4.30844 2.35422 4.27632C2.29892 4.24421 2.25258 4.1987 2.21948 4.14399L1.57118 3.06476C0.87457 4.19166 0.635589 5.45839 0.635589 5.97131C0.635589 8.10561 2.32244 9.82806 4.44785 9.82806C6.57326 9.82806 8.26265 8.10561 8.26265 5.97131V5.95351L8.26011 5.88995C8.25568 5.80484 8.24911 5.71986 8.24041 5.63508C8.20712 5.3287 8.15362 5.02487 8.08024 4.72555C7.87826 3.89157 7.52027 3.10334 7.02516 2.40248L6.38068 3.47535C6.34338 3.53732 6.28925 3.58743 6.22459 3.61985C6.15993 3.65227 6.08739 3.66566 6.01542 3.65847C5.94344 3.65128 5.87499 3.6238 5.81802 3.57923C5.76105 3.53466 5.71791 3.47483 5.6936 3.40671C5.59064 3.11815 5.33831 2.42917 5.11713 1.98044C5.00463 1.751 4.78916 1.46117 4.55781 1.18596C4.4801 1.09353 4.40086 1.00242 4.3201 0.912655Z"
                                                                    fill="#FEFEFE" />
                                                            </svg>
                                                        </button>
                                                    </div>
                                                </div>

                                                <h2 class="name">Sarah W.</h2>

                                                <div
                                                    class="studio-details mt-1 d-flex align-items-center justify-content-between">

                                                    <div class="studio">
                                                        <div class="studio">Sarah’s Grooming Studio</div>
                                                    </div>

                                                    <div class="meta d-flex align-items-center justify-content-between">
                                                        <div class="distance" title="Distance">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="10"
                                                                height="14" viewBox="0 0 10 14" fill="none">
                                                                <path
                                                                    d="M5 6.65C4.5264 6.65 4.0722 6.46563 3.73731 6.13744C3.40242 5.80925 3.21429 5.36413 3.21429 4.9C3.21429 4.43587 3.40242 3.99075 3.73731 3.66256C4.0722 3.33437 4.5264 3.15 5 3.15C5.4736 3.15 5.9278 3.33437 6.26269 3.66256C6.59758 3.99075 6.78571 4.43587 6.78571 4.9C6.78571 5.12981 6.73953 5.35738 6.64979 5.5697C6.56004 5.78202 6.42851 5.97493 6.26269 6.13744C6.09687 6.29994 5.90002 6.42884 5.68336 6.51679C5.46671 6.60473 5.2345 6.65 5 6.65ZM5 0C3.67392 0 2.40215 0.516248 1.46447 1.43518C0.526784 2.3541 0 3.60044 0 4.9C0 8.575 5 14 5 14C5 14 10 8.575 10 4.9C10 3.60044 9.47322 2.3541 8.53553 1.43518C7.59785 0.516248 6.32608 0 5 0Z"
                                                                    fill="var(--active-bg)" />
                                                            </svg>
                                                            <span>2.5 mi</span>
                                                        </div>


                                                        <div class="rating" title="Rating">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="14"
                                                                height="14" viewBox="0 0 14 14" fill="none">
                                                                <path
                                                                    d="M6.12956 0.660476C6.40354 -0.220161 7.59647 -0.220158 7.87045 0.660479L8.89548 3.95519C9.01801 4.34902 9.36942 4.61566 9.76593 4.61566H13.083C13.9696 4.61566 14.3383 5.80055 13.621 6.34481L10.9374 8.38106C10.6166 8.62446 10.4824 9.0559 10.6049 9.44973L11.63 12.7444C11.9039 13.6251 10.9388 14.3574 10.2215 13.8131L7.53797 11.7769C7.21719 11.5335 6.78282 11.5335 6.46204 11.7769L3.77846 13.8131C3.06117 14.3574 2.09607 13.6251 2.37005 12.7444L3.39508 9.44973C3.51761 9.0559 3.38338 8.62446 3.0626 8.38106L0.37903 6.34481C-0.338258 5.80055 0.0303816 4.61566 0.916998 4.61566H4.23408C4.63058 4.61566 4.98199 4.34902 5.10452 3.95519L6.12956 0.660476Z"
                                                                    fill="var(--active-bg)" />
                                                            </svg>
                                                            <span>4.3 <small
                                                                    style="color:var(--muted)">(20)</small></span>
                                                        </div>
                                                    </div>
                                                </div>



                                                <p class="experience">Gentle, breed-specific trims · 6+ years
                                                    experience.</p>


                                                <div class="availability">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15"
                                                        viewBox="0 0 15 15" fill="none">
                                                        <path
                                                            d="M7.5 0C3.375 0 0 3.375 0 7.5C0 11.625 3.375 15 7.5 15C11.625 15 15 11.625 15 7.5C15 3.375 11.625 0 7.5 0ZM6 11.25L2.25 7.5L3.3075 6.4425L6 9.1275L11.6925 3.435L12.75 4.5L6 11.25Z"
                                                            fill="#D8E8B7" />
                                                    </svg>
                                                    <span>Availability</span>
                                                </div>


                                                <div class="slots-price d-flex align-items-center">
                                                    <div class="slots d-flex" aria-label="Available slots">
                                                        <div class="slot highlight">Mon 1, 08:30 AM</div>
                                                        <div class="slot">Tue 15, 12:30 PM</div>
                                                        <div class="slot">Wed 27, 09:15 AM</div>
                                                        <div class="slot">Thu 9, 15:45 PM</div>
                                                    </div>
                                                    <div class="price">From <span>£38</span></div>
                                                </div>



                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="card">
                                            <div class="left">
                                                <div class="top-left-svg">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="21" height="22"
                                                        viewBox="0 0 21 22" fill="none">
                                                        <rect x="4.14746" y="4.14746" width="12.443" height="13.8256"
                                                            rx="3" fill="white" />
                                                        <path
                                                            d="M10.9482 0.125295C10.7667 0.043205 10.5723 0 10.3692 0C10.1662 0 9.97174 0.043205 9.79028 0.125295L1.65477 3.57738C0.704262 3.97918 -0.00430085 4.91673 1.96518e-05 6.0487C0.0216222 10.3346 1.78439 18.1764 9.22861 21.7408C9.95014 22.0864 10.7883 22.0864 11.5098 21.7408C18.9541 18.1764 20.7168 10.3346 20.7384 6.0487C20.7428 4.91673 20.0342 3.97918 19.0837 3.57738L10.9482 0.125295ZM6.26043 12.3653C6.46781 12.4171 6.68816 12.443 6.91282 12.443C8.43796 12.443 9.67795 11.2031 9.67795 9.67793V6.9128H11.5876C12.1104 6.9128 12.59 7.2066 12.8233 7.67753L13.1343 8.29537H15.8995C16.2797 8.29537 16.5907 8.60644 16.5907 8.98665V10.3692C16.5907 12.2789 15.044 13.8256 13.1343 13.8256H11.0605V16.0161C11.0605 16.3315 10.8056 16.5907 10.4859 16.5907C10.4081 16.5907 10.3303 16.5734 10.2612 16.5432L5.99688 14.7156C5.71172 14.5947 5.53026 14.3138 5.53026 14.0071C5.53026 13.8861 5.55619 13.7694 5.61235 13.6614L6.26043 12.3653ZM6.22154 6.9128H8.29538V9.67793C8.29538 10.4427 7.67755 11.0605 6.91282 11.0605C6.1481 11.0605 5.53026 10.4427 5.53026 9.67793V7.60408C5.53026 7.22388 5.84134 6.9128 6.22154 6.9128ZM11.7518 8.98665C11.7518 8.80331 11.679 8.62748 11.5493 8.49784C11.4197 8.3682 11.2438 8.29537 11.0605 8.29537C10.8772 8.29537 10.7013 8.3682 10.5717 8.49784C10.4421 8.62748 10.3692 8.80331 10.3692 8.98665C10.3692 9.16998 10.4421 9.34581 10.5717 9.47545C10.7013 9.60509 10.8772 9.67793 11.0605 9.67793C11.2438 9.67793 11.4197 9.60509 11.5493 9.47545C11.679 9.34581 11.7518 9.16998 11.7518 8.98665Z"
                                                            fill="#C9DDA0" />
                                                    </svg>
                                                </div>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="270" height="246"
                                                    viewBox="0 0 170 246">
                                                    <defs>
                                                        <clipPath id="cardClip">
                                                            <path
                                                                d="M165 0C167.761 2.57702e-06 170 2.23858 170 5V241C170 243.761 167.761 246 165 246H5C2.23858 246 0 243.761 0 241V37C0 34.2386 2.23858 32 5 32H27C29.7614 32 32 29.7614 32 27V5C32 2.23858 34.2386 0 37 0H165Z" />
                                                        </clipPath>
                                                    </defs>

                                                    <!-- Image with clip path -->
                                                    <image href="assets/images/card1.png"
                                                        preserveAspectRatio="xMidYMid slice"
                                                        clip-path="url(#cardClip)" />
                                                </svg>
                                            </div>
                                            <div class="right">
                                                <div class="top-row">
                                                    <div class="tags" aria-hidden="true">
                                                        <div class="tag">Home Visit</div>
                                                        <div class="tag">Mobile Station</div>
                                                    </div>
                                                    <div class="icons" aria-hidden="true">
                                                        <button class="first-icon" title="Top-rated">
                                                            <!-- crown -->
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="10"
                                                                height="9" viewBox="0 0 10 9" fill="none">
                                                                <path
                                                                    d="M2 8.99999C1.85833 8.99999 1.73967 8.95199 1.644 8.85599C1.54833 8.75999 1.50033 8.64133 1.5 8.49999C1.49967 8.35866 1.54767 8.23999 1.644 8.14399C1.74033 8.04799 1.859 7.99999 2 7.99999H8C8.14166 7.99999 8.2605 8.04799 8.3565 8.14399C8.4525 8.23999 8.50033 8.35866 8.5 8.49999C8.49966 8.64133 8.45166 8.76016 8.356 8.85649C8.26033 8.95283 8.14166 9.00066 8 8.99999H2ZM2.35 7.24999C2.10833 7.24999 1.89383 7.17083 1.7065 7.0125C1.51917 6.85416 1.4045 6.65416 1.3625 6.4125L0.862501 3.2375C0.845834 3.2375 0.827167 3.23967 0.806501 3.244C0.785834 3.24833 0.767001 3.25033 0.750001 3.25C0.541667 3.25 0.364668 3.17717 0.219001 3.0315C0.0733344 2.88583 0.000334469 2.70867 1.13636e-06 2.5C-0.000332197 2.29133 0.0726677 2.11433 0.219001 1.969C0.365334 1.82367 0.542334 1.75067 0.750001 1.75C0.957667 1.74933 1.13483 1.82233 1.2815 1.969C1.42817 2.11567 1.501 2.29267 1.5 2.5C1.5 2.55833 1.49367 2.6125 1.481 2.6625C1.46833 2.7125 1.45383 2.75833 1.4375 2.8L3 3.5L4.5625 1.3625C4.47083 1.29583 4.39583 1.20833 4.3375 1.1C4.27917 0.991667 4.25 0.875 4.25 0.75C4.25 0.541667 4.323 0.364501 4.469 0.218501C4.615 0.0725011 4.792 -0.000332194 5 1.13895e-06C5.208 0.000334472 5.38516 0.0733344 5.5315 0.219001C5.67783 0.364667 5.75066 0.541667 5.75 0.75C5.75 0.875 5.72083 0.991667 5.6625 1.1C5.60416 1.20833 5.52916 1.29583 5.4375 1.3625L7 3.5L8.5625 2.8C8.54583 2.75833 8.53116 2.7125 8.5185 2.6625C8.50583 2.6125 8.49966 2.55833 8.5 2.5C8.5 2.29167 8.573 2.1145 8.719 1.9685C8.865 1.8225 9.042 1.74967 9.25 1.75C9.458 1.75033 9.63516 1.82333 9.7815 1.969C9.92783 2.11467 10.0007 2.29167 10 2.5C9.99933 2.70833 9.92649 2.8855 9.7815 3.0315C9.6365 3.1775 9.45933 3.25033 9.25 3.25C9.23333 3.25 9.21466 3.248 9.194 3.244C9.17333 3.24 9.1545 3.23783 9.1375 3.2375L8.6375 6.4125C8.59583 6.65416 8.48133 6.85416 8.294 7.0125C8.10666 7.17083 7.892 7.24999 7.65 7.24999H2.35ZM2.35 6.25H7.65L7.975 4.1625L7.4 4.4125C7.18333 4.50416 6.9625 4.52083 6.7375 4.4625C6.5125 4.40416 6.32916 4.27916 6.1875 4.0875L5 2.45L3.8125 4.0875C3.67083 4.27916 3.4875 4.40416 3.2625 4.4625C3.0375 4.52083 2.81667 4.50416 2.6 4.4125L2.025 4.1625L2.35 6.25Z"
                                                                    fill="white" />
                                                            </svg>
                                                        </button>
                                                        <button class="second-icon" title="Favourite">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="9"
                                                                height="11" viewBox="0 0 9 11" fill="none">
                                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                                    d="M3.79701 0.30821C3.81025 0.23997 3.84191 0.176658 3.88858 0.125138C3.93524 0.0736173 3.99512 0.0358558 4.06172 0.0159479C4.12832 -0.00396001 4.1991 -0.00525449 4.26638 0.0122049C4.33367 0.0296642 4.39489 0.0652111 4.4434 0.114991C4.56671 0.240837 4.80378 0.489988 5.04467 0.777274C5.28111 1.05884 5.53916 1.39761 5.68788 1.69951C5.8328 1.99443 5.98661 2.37578 6.10801 2.69421L6.67305 1.75354C6.70456 1.701 6.74826 1.65683 6.80046 1.62476C6.85265 1.59269 6.91181 1.57367 6.97292 1.56931C7.03402 1.56494 7.09528 1.57536 7.1515 1.59969C7.20773 1.62401 7.25727 1.66152 7.29592 1.70905C8.09867 2.70057 8.49846 3.76263 8.6974 4.57365C8.79718 4.97979 8.8474 5.32491 8.87282 5.57025C8.88576 5.69278 8.89424 5.81574 8.89824 5.93889V5.97131C8.89824 8.4482 6.93364 10.4649 4.44785 10.4649C1.96206 10.4649 0 8.44756 0 5.97004C0 5.28805 0.322244 3.68192 1.27563 2.36498C1.31266 2.31422 1.36166 2.27341 1.41826 2.24615C1.47487 2.2189 1.53734 2.20605 1.60011 2.20876C1.66287 2.21146 1.724 2.22963 1.77806 2.26166C1.83211 2.29368 1.87741 2.33856 1.90994 2.39231L2.55507 3.46709C2.75083 3.16073 3.01269 2.73044 3.21163 2.3332C3.49765 1.76117 3.72455 0.682572 3.79701 0.308845M4.3201 0.912655C4.20506 1.42113 4.01501 2.14697 3.77985 2.61858C3.46714 3.24336 3.0165 3.9298 2.86142 4.16051C2.82554 4.21345 2.77693 4.25651 2.72005 4.28574C2.66317 4.31497 2.59986 4.32943 2.53593 4.32778C2.472 4.32614 2.40952 4.30844 2.35422 4.27632C2.29892 4.24421 2.25258 4.1987 2.21948 4.14399L1.57118 3.06476C0.87457 4.19166 0.635589 5.45839 0.635589 5.97131C0.635589 8.10561 2.32244 9.82806 4.44785 9.82806C6.57326 9.82806 8.26265 8.10561 8.26265 5.97131V5.95351L8.26011 5.88995C8.25568 5.80484 8.24911 5.71986 8.24041 5.63508C8.20712 5.3287 8.15362 5.02487 8.08024 4.72555C7.87826 3.89157 7.52027 3.10334 7.02516 2.40248L6.38068 3.47535C6.34338 3.53732 6.28925 3.58743 6.22459 3.61985C6.15993 3.65227 6.08739 3.66566 6.01542 3.65847C5.94344 3.65128 5.87499 3.6238 5.81802 3.57923C5.76105 3.53466 5.71791 3.47483 5.6936 3.40671C5.59064 3.11815 5.33831 2.42917 5.11713 1.98044C5.00463 1.751 4.78916 1.46117 4.55781 1.18596C4.4801 1.09353 4.40086 1.00242 4.3201 0.912655Z"
                                                                    fill="#FEFEFE" />
                                                            </svg>
                                                        </button>
                                                    </div>
                                                </div>

                                                <h2 class="name">Sarah W.</h2>

                                                <div
                                                    class="studio-details mt-1 d-flex align-items-center justify-content-between">

                                                    <div class="studio">
                                                        <div class="studio">Sarah’s Grooming Studio</div>
                                                    </div>

                                                    <div class="meta d-flex align-items-center justify-content-between">
                                                        <div class="distance" title="Distance">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="10"
                                                                height="14" viewBox="0 0 10 14" fill="none">
                                                                <path
                                                                    d="M5 6.65C4.5264 6.65 4.0722 6.46563 3.73731 6.13744C3.40242 5.80925 3.21429 5.36413 3.21429 4.9C3.21429 4.43587 3.40242 3.99075 3.73731 3.66256C4.0722 3.33437 4.5264 3.15 5 3.15C5.4736 3.15 5.9278 3.33437 6.26269 3.66256C6.59758 3.99075 6.78571 4.43587 6.78571 4.9C6.78571 5.12981 6.73953 5.35738 6.64979 5.5697C6.56004 5.78202 6.42851 5.97493 6.26269 6.13744C6.09687 6.29994 5.90002 6.42884 5.68336 6.51679C5.46671 6.60473 5.2345 6.65 5 6.65ZM5 0C3.67392 0 2.40215 0.516248 1.46447 1.43518C0.526784 2.3541 0 3.60044 0 4.9C0 8.575 5 14 5 14C5 14 10 8.575 10 4.9C10 3.60044 9.47322 2.3541 8.53553 1.43518C7.59785 0.516248 6.32608 0 5 0Z"
                                                                    fill="var(--active-bg)" />
                                                            </svg>
                                                            <span>2.5 mi</span>
                                                        </div>


                                                        <div class="rating" title="Rating">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="14"
                                                                height="14" viewBox="0 0 14 14" fill="none">
                                                                <path
                                                                    d="M6.12956 0.660476C6.40354 -0.220161 7.59647 -0.220158 7.87045 0.660479L8.89548 3.95519C9.01801 4.34902 9.36942 4.61566 9.76593 4.61566H13.083C13.9696 4.61566 14.3383 5.80055 13.621 6.34481L10.9374 8.38106C10.6166 8.62446 10.4824 9.0559 10.6049 9.44973L11.63 12.7444C11.9039 13.6251 10.9388 14.3574 10.2215 13.8131L7.53797 11.7769C7.21719 11.5335 6.78282 11.5335 6.46204 11.7769L3.77846 13.8131C3.06117 14.3574 2.09607 13.6251 2.37005 12.7444L3.39508 9.44973C3.51761 9.0559 3.38338 8.62446 3.0626 8.38106L0.37903 6.34481C-0.338258 5.80055 0.0303816 4.61566 0.916998 4.61566H4.23408C4.63058 4.61566 4.98199 4.34902 5.10452 3.95519L6.12956 0.660476Z"
                                                                    fill="var(--active-bg)" />
                                                            </svg>
                                                            <span>4.3 <small
                                                                    style="color:var(--muted)">(20)</small></span>
                                                        </div>
                                                    </div>
                                                </div>



                                                <p class="experience">Gentle, breed-specific trims · 6+ years
                                                    experience.</p>


                                                <div class="availability">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15"
                                                        viewBox="0 0 15 15" fill="none">
                                                        <path
                                                            d="M7.5 0C3.375 0 0 3.375 0 7.5C0 11.625 3.375 15 7.5 15C11.625 15 15 11.625 15 7.5C15 3.375 11.625 0 7.5 0ZM6 11.25L2.25 7.5L3.3075 6.4425L6 9.1275L11.6925 3.435L12.75 4.5L6 11.25Z"
                                                            fill="#D8E8B7" />
                                                    </svg>
                                                    <span>Availability</span>
                                                </div>


                                                <div class="slots-price d-flex align-items-center">
                                                    <div class="slots d-flex" aria-label="Available slots">
                                                        <div class="slot highlight">Mon 1, 08:30 AM</div>
                                                        <div class="slot">Tue 15, 12:30 PM</div>
                                                        <div class="slot">Wed 27, 09:15 AM</div>
                                                        <div class="slot">Thu 9, 15:45 PM</div>
                                                    </div>
                                                    <div class="price">From <span>£38</span></div>
                                                </div>



                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 text-center section-gap">
                                        <button class="load-more">Load More</button>
                                    </div>
                                </div>
                        </section>
                    </div>

                    <div data-tab-content="groomer-map-view" class="tabcontent" style="display: none;">
                        <section class="section-gap">
                            <div class="container">
                                <div class="row">

                                    <div class="col-lg-6">
                                        <div class="card mt-3">
                                            <div class="left">
                                                <div class="top-left-svg">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="21" height="22"
                                                        viewBox="0 0 21 22" fill="none">
                                                        <rect x="4.14746" y="4.14746" width="12.443" height="13.8256"
                                                            rx="3" fill="white" />
                                                        <path
                                                            d="M10.9482 0.125295C10.7667 0.043205 10.5723 0 10.3692 0C10.1662 0 9.97174 0.043205 9.79028 0.125295L1.65477 3.57738C0.704262 3.97918 -0.00430085 4.91673 1.96518e-05 6.0487C0.0216222 10.3346 1.78439 18.1764 9.22861 21.7408C9.95014 22.0864 10.7883 22.0864 11.5098 21.7408C18.9541 18.1764 20.7168 10.3346 20.7384 6.0487C20.7428 4.91673 20.0342 3.97918 19.0837 3.57738L10.9482 0.125295ZM6.26043 12.3653C6.46781 12.4171 6.68816 12.443 6.91282 12.443C8.43796 12.443 9.67795 11.2031 9.67795 9.67793V6.9128H11.5876C12.1104 6.9128 12.59 7.2066 12.8233 7.67753L13.1343 8.29537H15.8995C16.2797 8.29537 16.5907 8.60644 16.5907 8.98665V10.3692C16.5907 12.2789 15.044 13.8256 13.1343 13.8256H11.0605V16.0161C11.0605 16.3315 10.8056 16.5907 10.4859 16.5907C10.4081 16.5907 10.3303 16.5734 10.2612 16.5432L5.99688 14.7156C5.71172 14.5947 5.53026 14.3138 5.53026 14.0071C5.53026 13.8861 5.55619 13.7694 5.61235 13.6614L6.26043 12.3653ZM6.22154 6.9128H8.29538V9.67793C8.29538 10.4427 7.67755 11.0605 6.91282 11.0605C6.1481 11.0605 5.53026 10.4427 5.53026 9.67793V7.60408C5.53026 7.22388 5.84134 6.9128 6.22154 6.9128ZM11.7518 8.98665C11.7518 8.80331 11.679 8.62748 11.5493 8.49784C11.4197 8.3682 11.2438 8.29537 11.0605 8.29537C10.8772 8.29537 10.7013 8.3682 10.5717 8.49784C10.4421 8.62748 10.3692 8.80331 10.3692 8.98665C10.3692 9.16998 10.4421 9.34581 10.5717 9.47545C10.7013 9.60509 10.8772 9.67793 11.0605 9.67793C11.2438 9.67793 11.4197 9.60509 11.5493 9.47545C11.679 9.34581 11.7518 9.16998 11.7518 8.98665Z"
                                                            fill="#C9DDA0" />
                                                    </svg>
                                                </div>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="270" height="246"
                                                    viewBox="0 0 170 246">
                                                    <defs>
                                                        <clipPath id="cardClip-map-1">
                                                            <path
                                                                d="M165 0C167.761 2.57702e-06 170 2.23858 170 5V241C170 243.761 167.761 246 165 246H5C2.23858 246 0 243.761 0 241V37C0 34.2386 2.23858 32 5 32H27C29.7614 32 32 29.7614 32 27V5C32 2.23858 34.2386 0 37 0H165Z" />
                                                        </clipPath>
                                                    </defs>

                                                    <!-- Image with clip path -->
                                                    <image href="assets/images/card1.png"
                                                        preserveAspectRatio="xMidYMid slice"
                                                        clip-path="url(#cardClip-map-1)" />
                                                </svg>
                                            </div>
                                            <div class="right">
                                                <div class="top-row">
                                                    <div class="tags" aria-hidden="true">
                                                        <div class="tag">Home Visit</div>
                                                        <div class="tag">Mobile Station</div>
                                                    </div>
                                                    <div class="icons" aria-hidden="true">
                                                        <button class="first-icon" title="Top-rated">
                                                            <!-- crown -->
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="10"
                                                                height="9" viewBox="0 0 10 9" fill="none">
                                                                <path
                                                                    d="M2 8.99999C1.85833 8.99999 1.73967 8.95199 1.644 8.85599C1.54833 8.75999 1.50033 8.64133 1.5 8.49999C1.49967 8.35866 1.54767 8.23999 1.644 8.14399C1.74033 8.04799 1.859 7.99999 2 7.99999H8C8.14166 7.99999 8.2605 8.04799 8.3565 8.14399C8.4525 8.23999 8.50033 8.35866 8.5 8.49999C8.49966 8.64133 8.45166 8.76016 8.356 8.85649C8.26033 8.95283 8.14166 9.00066 8 8.99999H2ZM2.35 7.24999C2.10833 7.24999 1.89383 7.17083 1.7065 7.0125C1.51917 6.85416 1.4045 6.65416 1.3625 6.4125L0.862501 3.2375C0.845834 3.2375 0.827167 3.23967 0.806501 3.244C0.785834 3.24833 0.767001 3.25033 0.750001 3.25C0.541667 3.25 0.364668 3.17717 0.219001 3.0315C0.0733344 2.88583 0.000334469 2.70867 1.13636e-06 2.5C-0.000332197 2.29133 0.0726677 2.11433 0.219001 1.969C0.365334 1.82367 0.542334 1.75067 0.750001 1.75C0.957667 1.74933 1.13483 1.82233 1.2815 1.969C1.42817 2.11567 1.501 2.29267 1.5 2.5C1.5 2.55833 1.49367 2.6125 1.481 2.6625C1.46833 2.7125 1.45383 2.75833 1.4375 2.8L3 3.5L4.5625 1.3625C4.47083 1.29583 4.39583 1.20833 4.3375 1.1C4.27917 0.991667 4.25 0.875 4.25 0.75C4.25 0.541667 4.323 0.364501 4.469 0.218501C4.615 0.0725011 4.792 -0.000332194 5 1.13895e-06C5.208 0.000334472 5.38516 0.0733344 5.5315 0.219001C5.67783 0.364667 5.75066 0.541667 5.75 0.75C5.75 0.875 5.72083 0.991667 5.6625 1.1C5.60416 1.20833 5.52916 1.29583 5.4375 1.3625L7 3.5L8.5625 2.8C8.54583 2.75833 8.53116 2.7125 8.5185 2.6625C8.50583 2.6125 8.49966 2.55833 8.5 2.5C8.5 2.29167 8.573 2.1145 8.719 1.9685C8.865 1.8225 9.042 1.74967 9.25 1.75C9.458 1.75033 9.63516 1.82333 9.7815 1.969C9.92783 2.11467 10.0007 2.29167 10 2.5C9.99933 2.70833 9.92649 2.8855 9.7815 3.0315C9.6365 3.1775 9.45933 3.25033 9.25 3.25C9.23333 3.25 9.21466 3.248 9.194 3.244C9.17333 3.24 9.1545 3.23783 9.1375 3.2375L8.6375 6.4125C8.59583 6.65416 8.48133 6.85416 8.294 7.0125C8.10666 7.17083 7.892 7.24999 7.65 7.24999H2.35ZM2.35 6.25H7.65L7.975 4.1625L7.4 4.4125C7.18333 4.50416 6.9625 4.52083 6.7375 4.4625C6.5125 4.40416 6.32916 4.27916 6.1875 4.0875L5 2.45L3.8125 4.0875C3.67083 4.27916 3.4875 4.40416 3.2625 4.4625C3.0375 4.52083 2.81667 4.50416 2.6 4.4125L2.025 4.1625L2.35 6.25Z"
                                                                    fill="white" />
                                                            </svg>
                                                        </button>
                                                        <button class="second-icon" title="Favourite">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="9"
                                                                height="11" viewBox="0 0 9 11" fill="none">
                                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                                    d="M3.79701 0.30821C3.81025 0.23997 3.84191 0.176658 3.88858 0.125138C3.93524 0.0736173 3.99512 0.0358558 4.06172 0.0159479C4.12832 -0.00396001 4.1991 -0.00525449 4.26638 0.0122049C4.33367 0.0296642 4.39489 0.0652111 4.4434 0.114991C4.56671 0.240837 4.80378 0.489988 5.04467 0.777274C5.28111 1.05884 5.53916 1.39761 5.68788 1.69951C5.8328 1.99443 5.98661 2.37578 6.10801 2.69421L6.67305 1.75354C6.70456 1.701 6.74826 1.65683 6.80046 1.62476C6.85265 1.59269 6.91181 1.57367 6.97292 1.56931C7.03402 1.56494 7.09528 1.57536 7.1515 1.59969C7.20773 1.62401 7.25727 1.66152 7.29592 1.70905C8.09867 2.70057 8.49846 3.76263 8.6974 4.57365C8.79718 4.97979 8.8474 5.32491 8.87282 5.57025C8.88576 5.69278 8.89424 5.81574 8.89824 5.93889V5.97131C8.89824 8.4482 6.93364 10.4649 4.44785 10.4649C1.96206 10.4649 0 8.44756 0 5.97004C0 5.28805 0.322244 3.68192 1.27563 2.36498C1.31266 2.31422 1.36166 2.27341 1.41826 2.24615C1.47487 2.2189 1.53734 2.20605 1.60011 2.20876C1.66287 2.21146 1.724 2.22963 1.77806 2.26166C1.83211 2.29368 1.87741 2.33856 1.90994 2.39231L2.55507 3.46709C2.75083 3.16073 3.01269 2.73044 3.21163 2.3332C3.49765 1.76117 3.72455 0.682572 3.79701 0.308845M4.3201 0.912655C4.20506 1.42113 4.01501 2.14697 3.77985 2.61858C3.46714 3.24336 3.0165 3.9298 2.86142 4.16051C2.82554 4.21345 2.77693 4.25651 2.72005 4.28574C2.66317 4.31497 2.59986 4.32943 2.53593 4.32778C2.472 4.32614 2.40952 4.30844 2.35422 4.27632C2.29892 4.24421 2.25258 4.1987 2.21948 4.14399L1.57118 3.06476C0.87457 4.19166 0.635589 5.45839 0.635589 5.97131C0.635589 8.10561 2.32244 9.82806 4.44785 9.82806C6.57326 9.82806 8.26265 8.10561 8.26265 5.97131V5.95351L8.26011 5.88995C8.25568 5.80484 8.24911 5.71986 8.24041 5.63508C8.20712 5.3287 8.15362 5.02487 8.08024 4.72555C7.87826 3.89157 7.52027 3.10334 7.02516 2.40248L6.38068 3.47535C6.34338 3.53732 6.28925 3.58743 6.22459 3.61985C6.15993 3.65227 6.08739 3.66566 6.01542 3.65847C5.94344 3.65128 5.87499 3.6238 5.81802 3.57923C5.76105 3.53466 5.71791 3.47483 5.6936 3.40671C5.59064 3.11815 5.33831 2.42917 5.11713 1.98044C5.00463 1.751 4.78916 1.46117 4.55781 1.18596C4.4801 1.09353 4.40086 1.00242 4.3201 0.912655Z"
                                                                    fill="#FEFEFE" />
                                                            </svg>
                                                        </button>
                                                    </div>
                                                </div>

                                                <h2 class="name">Sarah W.</h2>

                                                <div
                                                    class="studio-details mt-1 d-flex align-items-center justify-content-between">

                                                    <div class="studio">
                                                        <div class="studio">Sarah’s Grooming Studio</div>
                                                    </div>

                                                    <div class="meta d-flex align-items-center justify-content-between">
                                                        <div class="distance" title="Distance">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="10"
                                                                height="14" viewBox="0 0 10 14" fill="none">
                                                                <path
                                                                    d="M5 6.65C4.5264 6.65 4.0722 6.46563 3.73731 6.13744C3.40242 5.80925 3.21429 5.36413 3.21429 4.9C3.21429 4.43587 3.40242 3.99075 3.73731 3.66256C4.0722 3.33437 4.5264 3.15 5 3.15C5.4736 3.15 5.9278 3.33437 6.26269 3.66256C6.59758 3.99075 6.78571 4.43587 6.78571 4.9C6.78571 5.12981 6.73953 5.35738 6.64979 5.5697C6.56004 5.78202 6.42851 5.97493 6.26269 6.13744C6.09687 6.29994 5.90002 6.42884 5.68336 6.51679C5.46671 6.60473 5.2345 6.65 5 6.65ZM5 0C3.67392 0 2.40215 0.516248 1.46447 1.43518C0.526784 2.3541 0 3.60044 0 4.9C0 8.575 5 14 5 14C5 14 10 8.575 10 4.9C10 3.60044 9.47322 2.3541 8.53553 1.43518C7.59785 0.516248 6.32608 0 5 0Z"
                                                                    fill="var(--active-bg)" />
                                                            </svg>
                                                            <span>2.5 mi</span>
                                                        </div>


                                                        <div class="rating" title="Rating">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="14"
                                                                height="14" viewBox="0 0 14 14" fill="none">
                                                                <path
                                                                    d="M6.12956 0.660476C6.40354 -0.220161 7.59647 -0.220158 7.87045 0.660479L8.89548 3.95519C9.01801 4.34902 9.36942 4.61566 9.76593 4.61566H13.083C13.9696 4.61566 14.3383 5.80055 13.621 6.34481L10.9374 8.38106C10.6166 8.62446 10.4824 9.0559 10.6049 9.44973L11.63 12.7444C11.9039 13.6251 10.9388 14.3574 10.2215 13.8131L7.53797 11.7769C7.21719 11.5335 6.78282 11.5335 6.46204 11.7769L3.77846 13.8131C3.06117 14.3574 2.09607 13.6251 2.37005 12.7444L3.39508 9.44973C3.51761 9.0559 3.38338 8.62446 3.0626 8.38106L0.37903 6.34481C-0.338258 5.80055 0.0303816 4.61566 0.916998 4.61566H4.23408C4.63058 4.61566 4.98199 4.34902 5.10452 3.95519L6.12956 0.660476Z"
                                                                    fill="var(--active-bg)" />
                                                            </svg>
                                                            <span>4.3 <small
                                                                    style="color:var(--muted)">(20)</small></span>
                                                        </div>
                                                    </div>
                                                </div>



                                                <p class="experience">Gentle, breed-specific trims · 6+ years
                                                    experience.</p>


                                                <div class="availability">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15"
                                                        viewBox="0 0 15 15" fill="none">
                                                        <path
                                                            d="M7.5 0C3.375 0 0 3.375 0 7.5C0 11.625 3.375 15 7.5 15C11.625 15 15 11.625 15 7.5C15 3.375 11.625 0 7.5 0ZM6 11.25L2.25 7.5L3.3075 6.4425L6 9.1275L11.6925 3.435L12.75 4.5L6 11.25Z"
                                                            fill="#D8E8B7" />
                                                    </svg>
                                                    <span>Availability</span>
                                                </div>


                                                <div class="slots-price d-flex align-items-center">
                                                    <div class="slots d-flex" aria-label="Available slots">
                                                        <div class="slot highlight">Mon 1, 08:30 AM</div>
                                                        <div class="slot">Tue 15, 12:30 PM</div>
                                                        <div class="slot">Wed 27, 09:15 AM</div>
                                                        <div class="slot">Thu 9, 15:45 PM</div>
                                                    </div>
                                                    <div class="price">From <span>£38</span></div>
                                                </div>



                                            </div>
                                        </div>
                                        <div class="card mt-3">
                                            <div class="left">
                                                <div class="top-left-svg">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="21" height="22"
                                                        viewBox="0 0 21 22" fill="none">
                                                        <rect x="4.14746" y="4.14746" width="12.443" height="13.8256"
                                                            rx="3" fill="white" />
                                                        <path
                                                            d="M10.9482 0.125295C10.7667 0.043205 10.5723 0 10.3692 0C10.1662 0 9.97174 0.043205 9.79028 0.125295L1.65477 3.57738C0.704262 3.97918 -0.00430085 4.91673 1.96518e-05 6.0487C0.0216222 10.3346 1.78439 18.1764 9.22861 21.7408C9.95014 22.0864 10.7883 22.0864 11.5098 21.7408C18.9541 18.1764 20.7168 10.3346 20.7384 6.0487C20.7428 4.91673 20.0342 3.97918 19.0837 3.57738L10.9482 0.125295ZM6.26043 12.3653C6.46781 12.4171 6.68816 12.443 6.91282 12.443C8.43796 12.443 9.67795 11.2031 9.67795 9.67793V6.9128H11.5876C12.1104 6.9128 12.59 7.2066 12.8233 7.67753L13.1343 8.29537H15.8995C16.2797 8.29537 16.5907 8.60644 16.5907 8.98665V10.3692C16.5907 12.2789 15.044 13.8256 13.1343 13.8256H11.0605V16.0161C11.0605 16.3315 10.8056 16.5907 10.4859 16.5907C10.4081 16.5907 10.3303 16.5734 10.2612 16.5432L5.99688 14.7156C5.71172 14.5947 5.53026 14.3138 5.53026 14.0071C5.53026 13.8861 5.55619 13.7694 5.61235 13.6614L6.26043 12.3653ZM6.22154 6.9128H8.29538V9.67793C8.29538 10.4427 7.67755 11.0605 6.91282 11.0605C6.1481 11.0605 5.53026 10.4427 5.53026 9.67793V7.60408C5.53026 7.22388 5.84134 6.9128 6.22154 6.9128ZM11.7518 8.98665C11.7518 8.80331 11.679 8.62748 11.5493 8.49784C11.4197 8.3682 11.2438 8.29537 11.0605 8.29537C10.8772 8.29537 10.7013 8.3682 10.5717 8.49784C10.4421 8.62748 10.3692 8.80331 10.3692 8.98665C10.3692 9.16998 10.4421 9.34581 10.5717 9.47545C10.7013 9.60509 10.8772 9.67793 11.0605 9.67793C11.2438 9.67793 11.4197 9.60509 11.5493 9.47545C11.679 9.34581 11.7518 9.16998 11.7518 8.98665Z"
                                                            fill="#C9DDA0" />
                                                    </svg>
                                                </div>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="270" height="246"
                                                    viewBox="0 0 170 246">
                                                    <defs>
                                                        <clipPath id="cardClip-map-1">
                                                            <path
                                                                d="M165 0C167.761 2.57702e-06 170 2.23858 170 5V241C170 243.761 167.761 246 165 246H5C2.23858 246 0 243.761 0 241V37C0 34.2386 2.23858 32 5 32H27C29.7614 32 32 29.7614 32 27V5C32 2.23858 34.2386 0 37 0H165Z" />
                                                        </clipPath>
                                                    </defs>

                                                    <!-- Image with clip path -->
                                                    <image href="assets/images/card1.png"
                                                        preserveAspectRatio="xMidYMid slice"
                                                        clip-path="url(#cardClip-map-1)" />
                                                </svg>
                                            </div>
                                            <div class="right">
                                                <div class="top-row">
                                                    <div class="tags" aria-hidden="true">
                                                        <div class="tag">Home Visit</div>
                                                        <div class="tag">Mobile Station</div>
                                                    </div>
                                                    <div class="icons" aria-hidden="true">
                                                        <button class="first-icon" title="Top-rated">
                                                            <!-- crown -->
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="10"
                                                                height="9" viewBox="0 0 10 9" fill="none">
                                                                <path
                                                                    d="M2 8.99999C1.85833 8.99999 1.73967 8.95199 1.644 8.85599C1.54833 8.75999 1.50033 8.64133 1.5 8.49999C1.49967 8.35866 1.54767 8.23999 1.644 8.14399C1.74033 8.04799 1.859 7.99999 2 7.99999H8C8.14166 7.99999 8.2605 8.04799 8.3565 8.14399C8.4525 8.23999 8.50033 8.35866 8.5 8.49999C8.49966 8.64133 8.45166 8.76016 8.356 8.85649C8.26033 8.95283 8.14166 9.00066 8 8.99999H2ZM2.35 7.24999C2.10833 7.24999 1.89383 7.17083 1.7065 7.0125C1.51917 6.85416 1.4045 6.65416 1.3625 6.4125L0.862501 3.2375C0.845834 3.2375 0.827167 3.23967 0.806501 3.244C0.785834 3.24833 0.767001 3.25033 0.750001 3.25C0.541667 3.25 0.364668 3.17717 0.219001 3.0315C0.0733344 2.88583 0.000334469 2.70867 1.13636e-06 2.5C-0.000332197 2.29133 0.0726677 2.11433 0.219001 1.969C0.365334 1.82367 0.542334 1.75067 0.750001 1.75C0.957667 1.74933 1.13483 1.82233 1.2815 1.969C1.42817 2.11567 1.501 2.29267 1.5 2.5C1.5 2.55833 1.49367 2.6125 1.481 2.6625C1.46833 2.7125 1.45383 2.75833 1.4375 2.8L3 3.5L4.5625 1.3625C4.47083 1.29583 4.39583 1.20833 4.3375 1.1C4.27917 0.991667 4.25 0.875 4.25 0.75C4.25 0.541667 4.323 0.364501 4.469 0.218501C4.615 0.0725011 4.792 -0.000332194 5 1.13895e-06C5.208 0.000334472 5.38516 0.0733344 5.5315 0.219001C5.67783 0.364667 5.75066 0.541667 5.75 0.75C5.75 0.875 5.72083 0.991667 5.6625 1.1C5.60416 1.20833 5.52916 1.29583 5.4375 1.3625L7 3.5L8.5625 2.8C8.54583 2.75833 8.53116 2.7125 8.5185 2.6625C8.50583 2.6125 8.49966 2.55833 8.5 2.5C8.5 2.29167 8.573 2.1145 8.719 1.9685C8.865 1.8225 9.042 1.74967 9.25 1.75C9.458 1.75033 9.63516 1.82333 9.7815 1.969C9.92783 2.11467 10.0007 2.29167 10 2.5C9.99933 2.70833 9.92649 2.8855 9.7815 3.0315C9.6365 3.1775 9.45933 3.25033 9.25 3.25C9.23333 3.25 9.21466 3.248 9.194 3.244C9.17333 3.24 9.1545 3.23783 9.1375 3.2375L8.6375 6.4125C8.59583 6.65416 8.48133 6.85416 8.294 7.0125C8.10666 7.17083 7.892 7.24999 7.65 7.24999H2.35ZM2.35 6.25H7.65L7.975 4.1625L7.4 4.4125C7.18333 4.50416 6.9625 4.52083 6.7375 4.4625C6.5125 4.40416 6.32916 4.27916 6.1875 4.0875L5 2.45L3.8125 4.0875C3.67083 4.27916 3.4875 4.40416 3.2625 4.4625C3.0375 4.52083 2.81667 4.50416 2.6 4.4125L2.025 4.1625L2.35 6.25Z"
                                                                    fill="white" />
                                                            </svg>
                                                        </button>
                                                        <button class="second-icon" title="Favourite">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="9"
                                                                height="11" viewBox="0 0 9 11" fill="none">
                                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                                    d="M3.79701 0.30821C3.81025 0.23997 3.84191 0.176658 3.88858 0.125138C3.93524 0.0736173 3.99512 0.0358558 4.06172 0.0159479C4.12832 -0.00396001 4.1991 -0.00525449 4.26638 0.0122049C4.33367 0.0296642 4.39489 0.0652111 4.4434 0.114991C4.56671 0.240837 4.80378 0.489988 5.04467 0.777274C5.28111 1.05884 5.53916 1.39761 5.68788 1.69951C5.8328 1.99443 5.98661 2.37578 6.10801 2.69421L6.67305 1.75354C6.70456 1.701 6.74826 1.65683 6.80046 1.62476C6.85265 1.59269 6.91181 1.57367 6.97292 1.56931C7.03402 1.56494 7.09528 1.57536 7.1515 1.59969C7.20773 1.62401 7.25727 1.66152 7.29592 1.70905C8.09867 2.70057 8.49846 3.76263 8.6974 4.57365C8.79718 4.97979 8.8474 5.32491 8.87282 5.57025C8.88576 5.69278 8.89424 5.81574 8.89824 5.93889V5.97131C8.89824 8.4482 6.93364 10.4649 4.44785 10.4649C1.96206 10.4649 0 8.44756 0 5.97004C0 5.28805 0.322244 3.68192 1.27563 2.36498C1.31266 2.31422 1.36166 2.27341 1.41826 2.24615C1.47487 2.2189 1.53734 2.20605 1.60011 2.20876C1.66287 2.21146 1.724 2.22963 1.77806 2.26166C1.83211 2.29368 1.87741 2.33856 1.90994 2.39231L2.55507 3.46709C2.75083 3.16073 3.01269 2.73044 3.21163 2.3332C3.49765 1.76117 3.72455 0.682572 3.79701 0.308845M4.3201 0.912655C4.20506 1.42113 4.01501 2.14697 3.77985 2.61858C3.46714 3.24336 3.0165 3.9298 2.86142 4.16051C2.82554 4.21345 2.77693 4.25651 2.72005 4.28574C2.66317 4.31497 2.59986 4.32943 2.53593 4.32778C2.472 4.32614 2.40952 4.30844 2.35422 4.27632C2.29892 4.24421 2.25258 4.1987 2.21948 4.14399L1.57118 3.06476C0.87457 4.19166 0.635589 5.45839 0.635589 5.97131C0.635589 8.10561 2.32244 9.82806 4.44785 9.82806C6.57326 9.82806 8.26265 8.10561 8.26265 5.97131V5.95351L8.26011 5.88995C8.25568 5.80484 8.24911 5.71986 8.24041 5.63508C8.20712 5.3287 8.15362 5.02487 8.08024 4.72555C7.87826 3.89157 7.52027 3.10334 7.02516 2.40248L6.38068 3.47535C6.34338 3.53732 6.28925 3.58743 6.22459 3.61985C6.15993 3.65227 6.08739 3.66566 6.01542 3.65847C5.94344 3.65128 5.87499 3.6238 5.81802 3.57923C5.76105 3.53466 5.71791 3.47483 5.6936 3.40671C5.59064 3.11815 5.33831 2.42917 5.11713 1.98044C5.00463 1.751 4.78916 1.46117 4.55781 1.18596C4.4801 1.09353 4.40086 1.00242 4.3201 0.912655Z"
                                                                    fill="#FEFEFE" />
                                                            </svg>
                                                        </button>
                                                    </div>
                                                </div>

                                                <h2 class="name">Sarah W.</h2>

                                                <div
                                                    class="studio-details mt-1 d-flex align-items-center justify-content-between">

                                                    <div class="studio">
                                                        <div class="studio">Sarah’s Grooming Studio</div>
                                                    </div>

                                                    <div class="meta d-flex align-items-center justify-content-between">
                                                        <div class="distance" title="Distance">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="10"
                                                                height="14" viewBox="0 0 10 14" fill="none">
                                                                <path
                                                                    d="M5 6.65C4.5264 6.65 4.0722 6.46563 3.73731 6.13744C3.40242 5.80925 3.21429 5.36413 3.21429 4.9C3.21429 4.43587 3.40242 3.99075 3.73731 3.66256C4.0722 3.33437 4.5264 3.15 5 3.15C5.4736 3.15 5.9278 3.33437 6.26269 3.66256C6.59758 3.99075 6.78571 4.43587 6.78571 4.9C6.78571 5.12981 6.73953 5.35738 6.64979 5.5697C6.56004 5.78202 6.42851 5.97493 6.26269 6.13744C6.09687 6.29994 5.90002 6.42884 5.68336 6.51679C5.46671 6.60473 5.2345 6.65 5 6.65ZM5 0C3.67392 0 2.40215 0.516248 1.46447 1.43518C0.526784 2.3541 0 3.60044 0 4.9C0 8.575 5 14 5 14C5 14 10 8.575 10 4.9C10 3.60044 9.47322 2.3541 8.53553 1.43518C7.59785 0.516248 6.32608 0 5 0Z"
                                                                    fill="var(--active-bg)" />
                                                            </svg>
                                                            <span>2.5 mi</span>
                                                        </div>


                                                        <div class="rating" title="Rating">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="14"
                                                                height="14" viewBox="0 0 14 14" fill="none">
                                                                <path
                                                                    d="M6.12956 0.660476C6.40354 -0.220161 7.59647 -0.220158 7.87045 0.660479L8.89548 3.95519C9.01801 4.34902 9.36942 4.61566 9.76593 4.61566H13.083C13.9696 4.61566 14.3383 5.80055 13.621 6.34481L10.9374 8.38106C10.6166 8.62446 10.4824 9.0559 10.6049 9.44973L11.63 12.7444C11.9039 13.6251 10.9388 14.3574 10.2215 13.8131L7.53797 11.7769C7.21719 11.5335 6.78282 11.5335 6.46204 11.7769L3.77846 13.8131C3.06117 14.3574 2.09607 13.6251 2.37005 12.7444L3.39508 9.44973C3.51761 9.0559 3.38338 8.62446 3.0626 8.38106L0.37903 6.34481C-0.338258 5.80055 0.0303816 4.61566 0.916998 4.61566H4.23408C4.63058 4.61566 4.98199 4.34902 5.10452 3.95519L6.12956 0.660476Z"
                                                                    fill="var(--active-bg)" />
                                                            </svg>
                                                            <span>4.3 <small
                                                                    style="color:var(--muted)">(20)</small></span>
                                                        </div>
                                                    </div>
                                                </div>



                                                <p class="experience">Gentle, breed-specific trims · 6+ years
                                                    experience.</p>


                                                <div class="availability">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15"
                                                        viewBox="0 0 15 15" fill="none">
                                                        <path
                                                            d="M7.5 0C3.375 0 0 3.375 0 7.5C0 11.625 3.375 15 7.5 15C11.625 15 15 11.625 15 7.5C15 3.375 11.625 0 7.5 0ZM6 11.25L2.25 7.5L3.3075 6.4425L6 9.1275L11.6925 3.435L12.75 4.5L6 11.25Z"
                                                            fill="#D8E8B7" />
                                                    </svg>
                                                    <span>Availability</span>
                                                </div>


                                                <div class="slots-price d-flex align-items-center">
                                                    <div class="slots d-flex" aria-label="Available slots">
                                                        <div class="slot highlight">Mon 1, 08:30 AM</div>
                                                        <div class="slot">Tue 15, 12:30 PM</div>
                                                        <div class="slot">Wed 27, 09:15 AM</div>
                                                        <div class="slot">Thu 9, 15:45 PM</div>
                                                    </div>
                                                    <div class="price">From <span>£38</span></div>
                                                </div>



                                            </div>
                                        </div>
                                        <div class="card mt-3">
                                            <div class="left">
                                                <div class="top-left-svg">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="21" height="22"
                                                        viewBox="0 0 21 22" fill="none">
                                                        <rect x="4.14746" y="4.14746" width="12.443" height="13.8256"
                                                            rx="3" fill="white" />
                                                        <path
                                                            d="M10.9482 0.125295C10.7667 0.043205 10.5723 0 10.3692 0C10.1662 0 9.97174 0.043205 9.79028 0.125295L1.65477 3.57738C0.704262 3.97918 -0.00430085 4.91673 1.96518e-05 6.0487C0.0216222 10.3346 1.78439 18.1764 9.22861 21.7408C9.95014 22.0864 10.7883 22.0864 11.5098 21.7408C18.9541 18.1764 20.7168 10.3346 20.7384 6.0487C20.7428 4.91673 20.0342 3.97918 19.0837 3.57738L10.9482 0.125295ZM6.26043 12.3653C6.46781 12.4171 6.68816 12.443 6.91282 12.443C8.43796 12.443 9.67795 11.2031 9.67795 9.67793V6.9128H11.5876C12.1104 6.9128 12.59 7.2066 12.8233 7.67753L13.1343 8.29537H15.8995C16.2797 8.29537 16.5907 8.60644 16.5907 8.98665V10.3692C16.5907 12.2789 15.044 13.8256 13.1343 13.8256H11.0605V16.0161C11.0605 16.3315 10.8056 16.5907 10.4859 16.5907C10.4081 16.5907 10.3303 16.5734 10.2612 16.5432L5.99688 14.7156C5.71172 14.5947 5.53026 14.3138 5.53026 14.0071C5.53026 13.8861 5.55619 13.7694 5.61235 13.6614L6.26043 12.3653ZM6.22154 6.9128H8.29538V9.67793C8.29538 10.4427 7.67755 11.0605 6.91282 11.0605C6.1481 11.0605 5.53026 10.4427 5.53026 9.67793V7.60408C5.53026 7.22388 5.84134 6.9128 6.22154 6.9128ZM11.7518 8.98665C11.7518 8.80331 11.679 8.62748 11.5493 8.49784C11.4197 8.3682 11.2438 8.29537 11.0605 8.29537C10.8772 8.29537 10.7013 8.3682 10.5717 8.49784C10.4421 8.62748 10.3692 8.80331 10.3692 8.98665C10.3692 9.16998 10.4421 9.34581 10.5717 9.47545C10.7013 9.60509 10.8772 9.67793 11.0605 9.67793C11.2438 9.67793 11.4197 9.60509 11.5493 9.47545C11.679 9.34581 11.7518 9.16998 11.7518 8.98665Z"
                                                            fill="#C9DDA0" />
                                                    </svg>
                                                </div>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="270" height="246"
                                                    viewBox="0 0 170 246">
                                                    <defs>
                                                        <clipPath id="cardClip-map-1">
                                                            <path
                                                                d="M165 0C167.761 2.57702e-06 170 2.23858 170 5V241C170 243.761 167.761 246 165 246H5C2.23858 246 0 243.761 0 241V37C0 34.2386 2.23858 32 5 32H27C29.7614 32 32 29.7614 32 27V5C32 2.23858 34.2386 0 37 0H165Z" />
                                                        </clipPath>
                                                    </defs>

                                                    <!-- Image with clip path -->
                                                    <image href="assets/images/card1.png"
                                                        preserveAspectRatio="xMidYMid slice"
                                                        clip-path="url(#cardClip-map-1)" />
                                                </svg>
                                            </div>
                                            <div class="right">
                                                <div class="top-row">
                                                    <div class="tags" aria-hidden="true">
                                                        <div class="tag">Home Visit</div>
                                                        <div class="tag">Mobile Station</div>
                                                    </div>
                                                    <div class="icons" aria-hidden="true">
                                                        <button class="first-icon" title="Top-rated">
                                                            <!-- crown -->
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="10"
                                                                height="9" viewBox="0 0 10 9" fill="none">
                                                                <path
                                                                    d="M2 8.99999C1.85833 8.99999 1.73967 8.95199 1.644 8.85599C1.54833 8.75999 1.50033 8.64133 1.5 8.49999C1.49967 8.35866 1.54767 8.23999 1.644 8.14399C1.74033 8.04799 1.859 7.99999 2 7.99999H8C8.14166 7.99999 8.2605 8.04799 8.3565 8.14399C8.4525 8.23999 8.50033 8.35866 8.5 8.49999C8.49966 8.64133 8.45166 8.76016 8.356 8.85649C8.26033 8.95283 8.14166 9.00066 8 8.99999H2ZM2.35 7.24999C2.10833 7.24999 1.89383 7.17083 1.7065 7.0125C1.51917 6.85416 1.4045 6.65416 1.3625 6.4125L0.862501 3.2375C0.845834 3.2375 0.827167 3.23967 0.806501 3.244C0.785834 3.24833 0.767001 3.25033 0.750001 3.25C0.541667 3.25 0.364668 3.17717 0.219001 3.0315C0.0733344 2.88583 0.000334469 2.70867 1.13636e-06 2.5C-0.000332197 2.29133 0.0726677 2.11433 0.219001 1.969C0.365334 1.82367 0.542334 1.75067 0.750001 1.75C0.957667 1.74933 1.13483 1.82233 1.2815 1.969C1.42817 2.11567 1.501 2.29267 1.5 2.5C1.5 2.55833 1.49367 2.6125 1.481 2.6625C1.46833 2.7125 1.45383 2.75833 1.4375 2.8L3 3.5L4.5625 1.3625C4.47083 1.29583 4.39583 1.20833 4.3375 1.1C4.27917 0.991667 4.25 0.875 4.25 0.75C4.25 0.541667 4.323 0.364501 4.469 0.218501C4.615 0.0725011 4.792 -0.000332194 5 1.13895e-06C5.208 0.000334472 5.38516 0.0733344 5.5315 0.219001C5.67783 0.364667 5.75066 0.541667 5.75 0.75C5.75 0.875 5.72083 0.991667 5.6625 1.1C5.60416 1.20833 5.52916 1.29583 5.4375 1.3625L7 3.5L8.5625 2.8C8.54583 2.75833 8.53116 2.7125 8.5185 2.6625C8.50583 2.6125 8.49966 2.55833 8.5 2.5C8.5 2.29167 8.573 2.1145 8.719 1.9685C8.865 1.8225 9.042 1.74967 9.25 1.75C9.458 1.75033 9.63516 1.82333 9.7815 1.969C9.92783 2.11467 10.0007 2.29167 10 2.5C9.99933 2.70833 9.92649 2.8855 9.7815 3.0315C9.6365 3.1775 9.45933 3.25033 9.25 3.25C9.23333 3.25 9.21466 3.248 9.194 3.244C9.17333 3.24 9.1545 3.23783 9.1375 3.2375L8.6375 6.4125C8.59583 6.65416 8.48133 6.85416 8.294 7.0125C8.10666 7.17083 7.892 7.24999 7.65 7.24999H2.35ZM2.35 6.25H7.65L7.975 4.1625L7.4 4.4125C7.18333 4.50416 6.9625 4.52083 6.7375 4.4625C6.5125 4.40416 6.32916 4.27916 6.1875 4.0875L5 2.45L3.8125 4.0875C3.67083 4.27916 3.4875 4.40416 3.2625 4.4625C3.0375 4.52083 2.81667 4.50416 2.6 4.4125L2.025 4.1625L2.35 6.25Z"
                                                                    fill="white" />
                                                            </svg>
                                                        </button>
                                                        <button class="second-icon" title="Favourite">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="9"
                                                                height="11" viewBox="0 0 9 11" fill="none">
                                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                                    d="M3.79701 0.30821C3.81025 0.23997 3.84191 0.176658 3.88858 0.125138C3.93524 0.0736173 3.99512 0.0358558 4.06172 0.0159479C4.12832 -0.00396001 4.1991 -0.00525449 4.26638 0.0122049C4.33367 0.0296642 4.39489 0.0652111 4.4434 0.114991C4.56671 0.240837 4.80378 0.489988 5.04467 0.777274C5.28111 1.05884 5.53916 1.39761 5.68788 1.69951C5.8328 1.99443 5.98661 2.37578 6.10801 2.69421L6.67305 1.75354C6.70456 1.701 6.74826 1.65683 6.80046 1.62476C6.85265 1.59269 6.91181 1.57367 6.97292 1.56931C7.03402 1.56494 7.09528 1.57536 7.1515 1.59969C7.20773 1.62401 7.25727 1.66152 7.29592 1.70905C8.09867 2.70057 8.49846 3.76263 8.6974 4.57365C8.79718 4.97979 8.8474 5.32491 8.87282 5.57025C8.88576 5.69278 8.89424 5.81574 8.89824 5.93889V5.97131C8.89824 8.4482 6.93364 10.4649 4.44785 10.4649C1.96206 10.4649 0 8.44756 0 5.97004C0 5.28805 0.322244 3.68192 1.27563 2.36498C1.31266 2.31422 1.36166 2.27341 1.41826 2.24615C1.47487 2.2189 1.53734 2.20605 1.60011 2.20876C1.66287 2.21146 1.724 2.22963 1.77806 2.26166C1.83211 2.29368 1.87741 2.33856 1.90994 2.39231L2.55507 3.46709C2.75083 3.16073 3.01269 2.73044 3.21163 2.3332C3.49765 1.76117 3.72455 0.682572 3.79701 0.308845M4.3201 0.912655C4.20506 1.42113 4.01501 2.14697 3.77985 2.61858C3.46714 3.24336 3.0165 3.9298 2.86142 4.16051C2.82554 4.21345 2.77693 4.25651 2.72005 4.28574C2.66317 4.31497 2.59986 4.32943 2.53593 4.32778C2.472 4.32614 2.40952 4.30844 2.35422 4.27632C2.29892 4.24421 2.25258 4.1987 2.21948 4.14399L1.57118 3.06476C0.87457 4.19166 0.635589 5.45839 0.635589 5.97131C0.635589 8.10561 2.32244 9.82806 4.44785 9.82806C6.57326 9.82806 8.26265 8.10561 8.26265 5.97131V5.95351L8.26011 5.88995C8.25568 5.80484 8.24911 5.71986 8.24041 5.63508C8.20712 5.3287 8.15362 5.02487 8.08024 4.72555C7.87826 3.89157 7.52027 3.10334 7.02516 2.40248L6.38068 3.47535C6.34338 3.53732 6.28925 3.58743 6.22459 3.61985C6.15993 3.65227 6.08739 3.66566 6.01542 3.65847C5.94344 3.65128 5.87499 3.6238 5.81802 3.57923C5.76105 3.53466 5.71791 3.47483 5.6936 3.40671C5.59064 3.11815 5.33831 2.42917 5.11713 1.98044C5.00463 1.751 4.78916 1.46117 4.55781 1.18596C4.4801 1.09353 4.40086 1.00242 4.3201 0.912655Z"
                                                                    fill="#FEFEFE" />
                                                            </svg>
                                                        </button>
                                                    </div>
                                                </div>

                                                <h2 class="name">Sarah W.</h2>

                                                <div
                                                    class="studio-details mt-1 d-flex align-items-center justify-content-between">

                                                    <div class="studio">
                                                        <div class="studio">Sarah’s Grooming Studio</div>
                                                    </div>

                                                    <div class="meta d-flex align-items-center justify-content-between">
                                                        <div class="distance" title="Distance">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="10"
                                                                height="14" viewBox="0 0 10 14" fill="none">
                                                                <path
                                                                    d="M5 6.65C4.5264 6.65 4.0722 6.46563 3.73731 6.13744C3.40242 5.80925 3.21429 5.36413 3.21429 4.9C3.21429 4.43587 3.40242 3.99075 3.73731 3.66256C4.0722 3.33437 4.5264 3.15 5 3.15C5.4736 3.15 5.9278 3.33437 6.26269 3.66256C6.59758 3.99075 6.78571 4.43587 6.78571 4.9C6.78571 5.12981 6.73953 5.35738 6.64979 5.5697C6.56004 5.78202 6.42851 5.97493 6.26269 6.13744C6.09687 6.29994 5.90002 6.42884 5.68336 6.51679C5.46671 6.60473 5.2345 6.65 5 6.65ZM5 0C3.67392 0 2.40215 0.516248 1.46447 1.43518C0.526784 2.3541 0 3.60044 0 4.9C0 8.575 5 14 5 14C5 14 10 8.575 10 4.9C10 3.60044 9.47322 2.3541 8.53553 1.43518C7.59785 0.516248 6.32608 0 5 0Z"
                                                                    fill="var(--active-bg)" />
                                                            </svg>
                                                            <span>2.5 mi</span>
                                                        </div>


                                                        <div class="rating" title="Rating">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="14"
                                                                height="14" viewBox="0 0 14 14" fill="none">
                                                                <path
                                                                    d="M6.12956 0.660476C6.40354 -0.220161 7.59647 -0.220158 7.87045 0.660479L8.89548 3.95519C9.01801 4.34902 9.36942 4.61566 9.76593 4.61566H13.083C13.9696 4.61566 14.3383 5.80055 13.621 6.34481L10.9374 8.38106C10.6166 8.62446 10.4824 9.0559 10.6049 9.44973L11.63 12.7444C11.9039 13.6251 10.9388 14.3574 10.2215 13.8131L7.53797 11.7769C7.21719 11.5335 6.78282 11.5335 6.46204 11.7769L3.77846 13.8131C3.06117 14.3574 2.09607 13.6251 2.37005 12.7444L3.39508 9.44973C3.51761 9.0559 3.38338 8.62446 3.0626 8.38106L0.37903 6.34481C-0.338258 5.80055 0.0303816 4.61566 0.916998 4.61566H4.23408C4.63058 4.61566 4.98199 4.34902 5.10452 3.95519L6.12956 0.660476Z"
                                                                    fill="var(--active-bg)" />
                                                            </svg>
                                                            <span>4.3 <small
                                                                    style="color:var(--muted)">(20)</small></span>
                                                        </div>
                                                    </div>
                                                </div>



                                                <p class="experience">Gentle, breed-specific trims · 6+ years
                                                    experience.</p>


                                                <div class="availability">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15"
                                                        viewBox="0 0 15 15" fill="none">
                                                        <path
                                                            d="M7.5 0C3.375 0 0 3.375 0 7.5C0 11.625 3.375 15 7.5 15C11.625 15 15 11.625 15 7.5C15 3.375 11.625 0 7.5 0ZM6 11.25L2.25 7.5L3.3075 6.4425L6 9.1275L11.6925 3.435L12.75 4.5L6 11.25Z"
                                                            fill="#D8E8B7" />
                                                    </svg>
                                                    <span>Availability</span>
                                                </div>


                                                <div class="slots-price d-flex align-items-center">
                                                    <div class="slots d-flex" aria-label="Available slots">
                                                        <div class="slot highlight">Mon 1, 08:30 AM</div>
                                                        <div class="slot">Tue 15, 12:30 PM</div>
                                                        <div class="slot">Wed 27, 09:15 AM</div>
                                                        <div class="slot">Thu 9, 15:45 PM</div>
                                                    </div>
                                                    <div class="price">From <span>£38</span></div>
                                                </div>



                                            </div>
                                        </div>
                                        <div class="col-lg-12 text-center section-gap">
                                            <button class="load-more">Load More</button>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 map-col">
                                        <div class="map-wrapper">
                                            <div id="map"></div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </section>
                    </div>

                    <div data-tab-content="groomer-list-view" class="tabcontent" style="display: none;">
                        <section class="section-gap">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-1"></div>
                                    <div class="col-lg-10">
                                        <div class="card mt-3">
                                            <div class="left">
                                                <div class="top-left-svg">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="21" height="22"
                                                        viewBox="0 0 21 22" fill="none">
                                                        <rect x="4.14746" y="4.14746" width="12.443" height="13.8256"
                                                            rx="3" fill="white" />
                                                        <path
                                                            d="M10.9482 0.125295C10.7667 0.043205 10.5723 0 10.3692 0C10.1662 0 9.97174 0.043205 9.79028 0.125295L1.65477 3.57738C0.704262 3.97918 -0.00430085 4.91673 1.96518e-05 6.0487C0.0216222 10.3346 1.78439 18.1764 9.22861 21.7408C9.95014 22.0864 10.7883 22.0864 11.5098 21.7408C18.9541 18.1764 20.7168 10.3346 20.7384 6.0487C20.7428 4.91673 20.0342 3.97918 19.0837 3.57738L10.9482 0.125295ZM6.26043 12.3653C6.46781 12.4171 6.68816 12.443 6.91282 12.443C8.43796 12.443 9.67795 11.2031 9.67795 9.67793V6.9128H11.5876C12.1104 6.9128 12.59 7.2066 12.8233 7.67753L13.1343 8.29537H15.8995C16.2797 8.29537 16.5907 8.60644 16.5907 8.98665V10.3692C16.5907 12.2789 15.044 13.8256 13.1343 13.8256H11.0605V16.0161C11.0605 16.3315 10.8056 16.5907 10.4859 16.5907C10.4081 16.5907 10.3303 16.5734 10.2612 16.5432L5.99688 14.7156C5.71172 14.5947 5.53026 14.3138 5.53026 14.0071C5.53026 13.8861 5.55619 13.7694 5.61235 13.6614L6.26043 12.3653ZM6.22154 6.9128H8.29538V9.67793C8.29538 10.4427 7.67755 11.0605 6.91282 11.0605C6.1481 11.0605 5.53026 10.4427 5.53026 9.67793V7.60408C5.53026 7.22388 5.84134 6.9128 6.22154 6.9128ZM11.7518 8.98665C11.7518 8.80331 11.679 8.62748 11.5493 8.49784C11.4197 8.3682 11.2438 8.29537 11.0605 8.29537C10.8772 8.29537 10.7013 8.3682 10.5717 8.49784C10.4421 8.62748 10.3692 8.80331 10.3692 8.98665C10.3692 9.16998 10.4421 9.34581 10.5717 9.47545C10.7013 9.60509 10.8772 9.67793 11.0605 9.67793C11.2438 9.67793 11.4197 9.60509 11.5493 9.47545C11.679 9.34581 11.7518 9.16998 11.7518 8.98665Z"
                                                            fill="#C9DDA0" />
                                                    </svg>
                                                </div>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="270" height="246"
                                                    viewBox="0 0 170 246">
                                                    <defs>
                                                        <clipPath id="cardClip-list-1">
                                                            <path
                                                                d="M165 0C167.761 2.57702e-06 170 2.23858 170 5V241C170 243.761 167.761 246 165 246H5C2.23858 246 0 243.761 0 241V37C0 34.2386 2.23858 32 5 32H27C29.7614 32 32 29.7614 32 27V5C32 2.23858 34.2386 0 37 0H165Z" />
                                                        </clipPath>
                                                    </defs>

                                                    <!-- Image with clip path -->
                                                    <image href="assets/images/card1.png"
                                                        preserveAspectRatio="xMidYMid slice"
                                                        clip-path="url(#cardClip-list-1)" />
                                                </svg>
                                            </div>
                                            <div class="right">
                                                <div class="top-row">
                                                    <div class="tags" aria-hidden="true">
                                                        <div class="tag">Home Visit</div>
                                                        <div class="tag">Mobile Station</div>
                                                    </div>
                                                    <div class="icons" aria-hidden="true">
                                                        <button class="first-icon" title="Top-rated">
                                                            <!-- crown -->
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="10"
                                                                height="9" viewBox="0 0 10 9" fill="none">
                                                                <path
                                                                    d="M2 8.99999C1.85833 8.99999 1.73967 8.95199 1.644 8.85599C1.54833 8.75999 1.50033 8.64133 1.5 8.49999C1.49967 8.35866 1.54767 8.23999 1.644 8.14399C1.74033 8.04799 1.859 7.99999 2 7.99999H8C8.14166 7.99999 8.2605 8.04799 8.3565 8.14399C8.4525 8.23999 8.50033 8.35866 8.5 8.49999C8.49966 8.64133 8.45166 8.76016 8.356 8.85649C8.26033 8.95283 8.14166 9.00066 8 8.99999H2ZM2.35 7.24999C2.10833 7.24999 1.89383 7.17083 1.7065 7.0125C1.51917 6.85416 1.4045 6.65416 1.3625 6.4125L0.862501 3.2375C0.845834 3.2375 0.827167 3.23967 0.806501 3.244C0.785834 3.24833 0.767001 3.25033 0.750001 3.25C0.541667 3.25 0.364668 3.17717 0.219001 3.0315C0.0733344 2.88583 0.000334469 2.70867 1.13636e-06 2.5C-0.000332197 2.29133 0.0726677 2.11433 0.219001 1.969C0.365334 1.82367 0.542334 1.75067 0.750001 1.75C0.957667 1.74933 1.13483 1.82233 1.2815 1.969C1.42817 2.11567 1.501 2.29267 1.5 2.5C1.5 2.55833 1.49367 2.6125 1.481 2.6625C1.46833 2.7125 1.45383 2.75833 1.4375 2.8L3 3.5L4.5625 1.3625C4.47083 1.29583 4.39583 1.20833 4.3375 1.1C4.27917 0.991667 4.25 0.875 4.25 0.75C4.25 0.541667 4.323 0.364501 4.469 0.218501C4.615 0.0725011 4.792 -0.000332194 5 1.13895e-06C5.208 0.000334472 5.38516 0.0733344 5.5315 0.219001C5.67783 0.364667 5.75066 0.541667 5.75 0.75C5.75 0.875 5.72083 0.991667 5.6625 1.1C5.60416 1.20833 5.52916 1.29583 5.4375 1.3625L7 3.5L8.5625 2.8C8.54583 2.75833 8.53116 2.7125 8.5185 2.6625C8.50583 2.6125 8.49966 2.55833 8.5 2.5C8.5 2.29167 8.573 2.1145 8.719 1.9685C8.865 1.8225 9.042 1.74967 9.25 1.75C9.458 1.75033 9.63516 1.82333 9.7815 1.969C9.92783 2.11467 10.0007 2.29167 10 2.5C9.99933 2.70833 9.92649 2.8855 9.7815 3.0315C9.6365 3.1775 9.45933 3.25033 9.25 3.25C9.23333 3.25 9.21466 3.248 9.194 3.244C9.17333 3.24 9.1545 3.23783 9.1375 3.2375L8.6375 6.4125C8.59583 6.65416 8.48133 6.85416 8.294 7.0125C8.10666 7.17083 7.892 7.24999 7.65 7.24999H2.35ZM2.35 6.25H7.65L7.975 4.1625L7.4 4.4125C7.18333 4.50416 6.9625 4.52083 6.7375 4.4625C6.5125 4.40416 6.32916 4.27916 6.1875 4.0875L5 2.45L3.8125 4.0875C3.67083 4.27916 3.4875 4.40416 3.2625 4.4625C3.0375 4.52083 2.81667 4.50416 2.6 4.4125L2.025 4.1625L2.35 6.25Z"
                                                                    fill="white" />
                                                            </svg>
                                                        </button>
                                                        <button class="second-icon" title="Favourite">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="9"
                                                                height="11" viewBox="0 0 9 11" fill="none">
                                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                                    d="M3.79701 0.30821C3.81025 0.23997 3.84191 0.176658 3.88858 0.125138C3.93524 0.0736173 3.99512 0.0358558 4.06172 0.0159479C4.12832 -0.00396001 4.1991 -0.00525449 4.26638 0.0122049C4.33367 0.0296642 4.39489 0.0652111 4.4434 0.114991C4.56671 0.240837 4.80378 0.489988 5.04467 0.777274C5.28111 1.05884 5.53916 1.39761 5.68788 1.69951C5.8328 1.99443 5.98661 2.37578 6.10801 2.69421L6.67305 1.75354C6.70456 1.701 6.74826 1.65683 6.80046 1.62476C6.85265 1.59269 6.91181 1.57367 6.97292 1.56931C7.03402 1.56494 7.09528 1.57536 7.1515 1.59969C7.20773 1.62401 7.25727 1.66152 7.29592 1.70905C8.09867 2.70057 8.49846 3.76263 8.6974 4.57365C8.79718 4.97979 8.8474 5.32491 8.87282 5.57025C8.88576 5.69278 8.89424 5.81574 8.89824 5.93889V5.97131C8.89824 8.4482 6.93364 10.4649 4.44785 10.4649C1.96206 10.4649 0 8.44756 0 5.97004C0 5.28805 0.322244 3.68192 1.27563 2.36498C1.31266 2.31422 1.36166 2.27341 1.41826 2.24615C1.47487 2.2189 1.53734 2.20605 1.60011 2.20876C1.66287 2.21146 1.724 2.22963 1.77806 2.26166C1.83211 2.29368 1.87741 2.33856 1.90994 2.39231L2.55507 3.46709C2.75083 3.16073 3.01269 2.73044 3.21163 2.3332C3.49765 1.76117 3.72455 0.682572 3.79701 0.308845M4.3201 0.912655C4.20506 1.42113 4.01501 2.14697 3.77985 2.61858C3.46714 3.24336 3.0165 3.9298 2.86142 4.16051C2.82554 4.21345 2.77693 4.25651 2.72005 4.28574C2.66317 4.31497 2.59986 4.32943 2.53593 4.32778C2.472 4.32614 2.40952 4.30844 2.35422 4.27632C2.29892 4.24421 2.25258 4.1987 2.21948 4.14399L1.57118 3.06476C0.87457 4.19166 0.635589 5.45839 0.635589 5.97131C0.635589 8.10561 2.32244 9.82806 4.44785 9.82806C6.57326 9.82806 8.26265 8.10561 8.26265 5.97131V5.95351L8.26011 5.88995C8.25568 5.80484 8.24911 5.71986 8.24041 5.63508C8.20712 5.3287 8.15362 5.02487 8.08024 4.72555C7.87826 3.89157 7.52027 3.10334 7.02516 2.40248L6.38068 3.47535C6.34338 3.53732 6.28925 3.58743 6.22459 3.61985C6.15993 3.65227 6.08739 3.66566 6.01542 3.65847C5.94344 3.65128 5.87499 3.6238 5.81802 3.57923C5.76105 3.53466 5.71791 3.47483 5.6936 3.40671C5.59064 3.11815 5.33831 2.42917 5.11713 1.98044C5.00463 1.751 4.78916 1.46117 4.55781 1.18596C4.4801 1.09353 4.40086 1.00242 4.3201 0.912655Z"
                                                                    fill="#FEFEFE" />
                                                            </svg>
                                                        </button>
                                                    </div>
                                                </div>

                                                <h2 class="name">Sarah W.</h2>

                                                <div
                                                    class="studio-details mt-1 d-flex align-items-center justify-content-between">

                                                    <div class="studio">
                                                        <div class="studio">Sarah’s Grooming Studio</div>
                                                    </div>

                                                    <div class="meta d-flex align-items-center justify-content-between">
                                                        <div class="distance" title="Distance">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="10"
                                                                height="14" viewBox="0 0 10 14" fill="none">
                                                                <path
                                                                    d="M5 6.65C4.5264 6.65 4.0722 6.46563 3.73731 6.13744C3.40242 5.80925 3.21429 5.36413 3.21429 4.9C3.21429 4.43587 3.40242 3.99075 3.73731 3.66256C4.0722 3.33437 4.5264 3.15 5 3.15C5.4736 3.15 5.9278 3.33437 6.26269 3.66256C6.59758 3.99075 6.78571 4.43587 6.78571 4.9C6.78571 5.12981 6.73953 5.35738 6.64979 5.5697C6.56004 5.78202 6.42851 5.97493 6.26269 6.13744C6.09687 6.29994 5.90002 6.42884 5.68336 6.51679C5.46671 6.60473 5.2345 6.65 5 6.65ZM5 0C3.67392 0 2.40215 0.516248 1.46447 1.43518C0.526784 2.3541 0 3.60044 0 4.9C0 8.575 5 14 5 14C5 14 10 8.575 10 4.9C10 3.60044 9.47322 2.3541 8.53553 1.43518C7.59785 0.516248 6.32608 0 5 0Z"
                                                                    fill="var(--active-bg)" />
                                                            </svg>
                                                            <span>2.5 mi</span>
                                                        </div>


                                                        <div class="rating" title="Rating">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="14"
                                                                height="14" viewBox="0 0 14 14" fill="none">
                                                                <path
                                                                    d="M6.12956 0.660476C6.40354 -0.220161 7.59647 -0.220158 7.87045 0.660479L8.89548 3.95519C9.01801 4.34902 9.36942 4.61566 9.76593 4.61566H13.083C13.9696 4.61566 14.3383 5.80055 13.621 6.34481L10.9374 8.38106C10.6166 8.62446 10.4824 9.0559 10.6049 9.44973L11.63 12.7444C11.9039 13.6251 10.9388 14.3574 10.2215 13.8131L7.53797 11.7769C7.21719 11.5335 6.78282 11.5335 6.46204 11.7769L3.77846 13.8131C3.06117 14.3574 2.09607 13.6251 2.37005 12.7444L3.39508 9.44973C3.51761 9.0559 3.38338 8.62446 3.0626 8.38106L0.37903 6.34481C-0.338258 5.80055 0.0303816 4.61566 0.916998 4.61566H4.23408C4.63058 4.61566 4.98199 4.34902 5.10452 3.95519L6.12956 0.660476Z"
                                                                    fill="var(--active-bg)" />
                                                            </svg>
                                                            <span>4.3 <small
                                                                    style="color:var(--muted)">(20)</small></span>
                                                        </div>
                                                    </div>
                                                </div>



                                                <p class="experience">Hi, I’m Sarah — a professional groomer in West
                                                    London,
                                                    specialising in small breeds, <br> anxious pets, & gentle handling!
                                                    Gentle,
                                                    breed-specific trims · 6+ years experience.</p>


                                                <div class="availability">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15"
                                                        viewBox="0 0 15 15" fill="none">
                                                        <path
                                                            d="M7.5 0C3.375 0 0 3.375 0 7.5C0 11.625 3.375 15 7.5 15C11.625 15 15 11.625 15 7.5C15 3.375 11.625 0 7.5 0ZM6 11.25L2.25 7.5L3.3075 6.4425L6 9.1275L11.6925 3.435L12.75 4.5L6 11.25Z"
                                                            fill="#D8E8B7" />
                                                    </svg>
                                                    <span>Availability</span>
                                                </div>


                                                <div class="slots-price d-flex align-items-center">
                                                    <div class="slots d-flex" aria-label="Available slots">
                                                        <div class="slot highlight">Mon 1, 08:30 AM</div>
                                                        <div class="slot">Tue 15, 12:30 PM</div>
                                                        <div class="slot">Wed 27, 09:15 AM</div>
                                                        <div class="slot">Thu 9, 15:45 PM</div>
                                                    </div>
                                                    <div class="price">From <span>£38</span></div>
                                                </div>



                                            </div>
                                        </div>
                                        <div class="card mt-3">
                                            <div class="left">
                                                <div class="top-left-svg">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="21" height="22"
                                                        viewBox="0 0 21 22" fill="none">
                                                        <rect x="4.14746" y="4.14746" width="12.443" height="13.8256"
                                                            rx="3" fill="white" />
                                                        <path
                                                            d="M10.9482 0.125295C10.7667 0.043205 10.5723 0 10.3692 0C10.1662 0 9.97174 0.043205 9.79028 0.125295L1.65477 3.57738C0.704262 3.97918 -0.00430085 4.91673 1.96518e-05 6.0487C0.0216222 10.3346 1.78439 18.1764 9.22861 21.7408C9.95014 22.0864 10.7883 22.0864 11.5098 21.7408C18.9541 18.1764 20.7168 10.3346 20.7384 6.0487C20.7428 4.91673 20.0342 3.97918 19.0837 3.57738L10.9482 0.125295ZM6.26043 12.3653C6.46781 12.4171 6.68816 12.443 6.91282 12.443C8.43796 12.443 9.67795 11.2031 9.67795 9.67793V6.9128H11.5876C12.1104 6.9128 12.59 7.2066 12.8233 7.67753L13.1343 8.29537H15.8995C16.2797 8.29537 16.5907 8.60644 16.5907 8.98665V10.3692C16.5907 12.2789 15.044 13.8256 13.1343 13.8256H11.0605V16.0161C11.0605 16.3315 10.8056 16.5907 10.4859 16.5907C10.4081 16.5907 10.3303 16.5734 10.2612 16.5432L5.99688 14.7156C5.71172 14.5947 5.53026 14.3138 5.53026 14.0071C5.53026 13.8861 5.55619 13.7694 5.61235 13.6614L6.26043 12.3653ZM6.22154 6.9128H8.29538V9.67793C8.29538 10.4427 7.67755 11.0605 6.91282 11.0605C6.1481 11.0605 5.53026 10.4427 5.53026 9.67793V7.60408C5.53026 7.22388 5.84134 6.9128 6.22154 6.9128ZM11.7518 8.98665C11.7518 8.80331 11.679 8.62748 11.5493 8.49784C11.4197 8.3682 11.2438 8.29537 11.0605 8.29537C10.8772 8.29537 10.7013 8.3682 10.5717 8.49784C10.4421 8.62748 10.3692 8.80331 10.3692 8.98665C10.3692 9.16998 10.4421 9.34581 10.5717 9.47545C10.7013 9.60509 10.8772 9.67793 11.0605 9.67793C11.2438 9.67793 11.4197 9.60509 11.5493 9.47545C11.679 9.34581 11.7518 9.16998 11.7518 8.98665Z"
                                                            fill="#C9DDA0" />
                                                    </svg>
                                                </div>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="270" height="246"
                                                    viewBox="0 0 170 246">
                                                    <defs>
                                                        <clipPath id="cardClip-list-1">
                                                            <path
                                                                d="M165 0C167.761 2.57702e-06 170 2.23858 170 5V241C170 243.761 167.761 246 165 246H5C2.23858 246 0 243.761 0 241V37C0 34.2386 2.23858 32 5 32H27C29.7614 32 32 29.7614 32 27V5C32 2.23858 34.2386 0 37 0H165Z" />
                                                        </clipPath>
                                                    </defs>

                                                    <!-- Image with clip path -->
                                                    <image href="assets/images/card1.png"
                                                        preserveAspectRatio="xMidYMid slice"
                                                        clip-path="url(#cardClip-list-1)" />
                                                </svg>
                                            </div>
                                            <div class="right">
                                                <div class="top-row">
                                                    <div class="tags" aria-hidden="true">
                                                        <div class="tag">Home Visit</div>
                                                        <div class="tag">Mobile Station</div>
                                                    </div>
                                                    <div class="icons" aria-hidden="true">
                                                        <button class="first-icon" title="Top-rated">
                                                            <!-- crown -->
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="10"
                                                                height="9" viewBox="0 0 10 9" fill="none">
                                                                <path
                                                                    d="M2 8.99999C1.85833 8.99999 1.73967 8.95199 1.644 8.85599C1.54833 8.75999 1.50033 8.64133 1.5 8.49999C1.49967 8.35866 1.54767 8.23999 1.644 8.14399C1.74033 8.04799 1.859 7.99999 2 7.99999H8C8.14166 7.99999 8.2605 8.04799 8.3565 8.14399C8.4525 8.23999 8.50033 8.35866 8.5 8.49999C8.49966 8.64133 8.45166 8.76016 8.356 8.85649C8.26033 8.95283 8.14166 9.00066 8 8.99999H2ZM2.35 7.24999C2.10833 7.24999 1.89383 7.17083 1.7065 7.0125C1.51917 6.85416 1.4045 6.65416 1.3625 6.4125L0.862501 3.2375C0.845834 3.2375 0.827167 3.23967 0.806501 3.244C0.785834 3.24833 0.767001 3.25033 0.750001 3.25C0.541667 3.25 0.364668 3.17717 0.219001 3.0315C0.0733344 2.88583 0.000334469 2.70867 1.13636e-06 2.5C-0.000332197 2.29133 0.0726677 2.11433 0.219001 1.969C0.365334 1.82367 0.542334 1.75067 0.750001 1.75C0.957667 1.74933 1.13483 1.82233 1.2815 1.969C1.42817 2.11567 1.501 2.29267 1.5 2.5C1.5 2.55833 1.49367 2.6125 1.481 2.6625C1.46833 2.7125 1.45383 2.75833 1.4375 2.8L3 3.5L4.5625 1.3625C4.47083 1.29583 4.39583 1.20833 4.3375 1.1C4.27917 0.991667 4.25 0.875 4.25 0.75C4.25 0.541667 4.323 0.364501 4.469 0.218501C4.615 0.0725011 4.792 -0.000332194 5 1.13895e-06C5.208 0.000334472 5.38516 0.0733344 5.5315 0.219001C5.67783 0.364667 5.75066 0.541667 5.75 0.75C5.75 0.875 5.72083 0.991667 5.6625 1.1C5.60416 1.20833 5.52916 1.29583 5.4375 1.3625L7 3.5L8.5625 2.8C8.54583 2.75833 8.53116 2.7125 8.5185 2.6625C8.50583 2.6125 8.49966 2.55833 8.5 2.5C8.5 2.29167 8.573 2.1145 8.719 1.9685C8.865 1.8225 9.042 1.74967 9.25 1.75C9.458 1.75033 9.63516 1.82333 9.7815 1.969C9.92783 2.11467 10.0007 2.29167 10 2.5C9.99933 2.70833 9.92649 2.8855 9.7815 3.0315C9.6365 3.1775 9.45933 3.25033 9.25 3.25C9.23333 3.25 9.21466 3.248 9.194 3.244C9.17333 3.24 9.1545 3.23783 9.1375 3.2375L8.6375 6.4125C8.59583 6.65416 8.48133 6.85416 8.294 7.0125C8.10666 7.17083 7.892 7.24999 7.65 7.24999H2.35ZM2.35 6.25H7.65L7.975 4.1625L7.4 4.4125C7.18333 4.50416 6.9625 4.52083 6.7375 4.4625C6.5125 4.40416 6.32916 4.27916 6.1875 4.0875L5 2.45L3.8125 4.0875C3.67083 4.27916 3.4875 4.40416 3.2625 4.4625C3.0375 4.52083 2.81667 4.50416 2.6 4.4125L2.025 4.1625L2.35 6.25Z"
                                                                    fill="white" />
                                                            </svg>
                                                        </button>
                                                        <button class="second-icon" title="Favourite">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="9"
                                                                height="11" viewBox="0 0 9 11" fill="none">
                                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                                    d="M3.79701 0.30821C3.81025 0.23997 3.84191 0.176658 3.88858 0.125138C3.93524 0.0736173 3.99512 0.0358558 4.06172 0.0159479C4.12832 -0.00396001 4.1991 -0.00525449 4.26638 0.0122049C4.33367 0.0296642 4.39489 0.0652111 4.4434 0.114991C4.56671 0.240837 4.80378 0.489988 5.04467 0.777274C5.28111 1.05884 5.53916 1.39761 5.68788 1.69951C5.8328 1.99443 5.98661 2.37578 6.10801 2.69421L6.67305 1.75354C6.70456 1.701 6.74826 1.65683 6.80046 1.62476C6.85265 1.59269 6.91181 1.57367 6.97292 1.56931C7.03402 1.56494 7.09528 1.57536 7.1515 1.59969C7.20773 1.62401 7.25727 1.66152 7.29592 1.70905C8.09867 2.70057 8.49846 3.76263 8.6974 4.57365C8.79718 4.97979 8.8474 5.32491 8.87282 5.57025C8.88576 5.69278 8.89424 5.81574 8.89824 5.93889V5.97131C8.89824 8.4482 6.93364 10.4649 4.44785 10.4649C1.96206 10.4649 0 8.44756 0 5.97004C0 5.28805 0.322244 3.68192 1.27563 2.36498C1.31266 2.31422 1.36166 2.27341 1.41826 2.24615C1.47487 2.2189 1.53734 2.20605 1.60011 2.20876C1.66287 2.21146 1.724 2.22963 1.77806 2.26166C1.83211 2.29368 1.87741 2.33856 1.90994 2.39231L2.55507 3.46709C2.75083 3.16073 3.01269 2.73044 3.21163 2.3332C3.49765 1.76117 3.72455 0.682572 3.79701 0.308845M4.3201 0.912655C4.20506 1.42113 4.01501 2.14697 3.77985 2.61858C3.46714 3.24336 3.0165 3.9298 2.86142 4.16051C2.82554 4.21345 2.77693 4.25651 2.72005 4.28574C2.66317 4.31497 2.59986 4.32943 2.53593 4.32778C2.472 4.32614 2.40952 4.30844 2.35422 4.27632C2.29892 4.24421 2.25258 4.1987 2.21948 4.14399L1.57118 3.06476C0.87457 4.19166 0.635589 5.45839 0.635589 5.97131C0.635589 8.10561 2.32244 9.82806 4.44785 9.82806C6.57326 9.82806 8.26265 8.10561 8.26265 5.97131V5.95351L8.26011 5.88995C8.25568 5.80484 8.24911 5.71986 8.24041 5.63508C8.20712 5.3287 8.15362 5.02487 8.08024 4.72555C7.87826 3.89157 7.52027 3.10334 7.02516 2.40248L6.38068 3.47535C6.34338 3.53732 6.28925 3.58743 6.22459 3.61985C6.15993 3.65227 6.08739 3.66566 6.01542 3.65847C5.94344 3.65128 5.87499 3.6238 5.81802 3.57923C5.76105 3.53466 5.71791 3.47483 5.6936 3.40671C5.59064 3.11815 5.33831 2.42917 5.11713 1.98044C5.00463 1.751 4.78916 1.46117 4.55781 1.18596C4.4801 1.09353 4.40086 1.00242 4.3201 0.912655Z"
                                                                    fill="#FEFEFE" />
                                                            </svg>
                                                        </button>
                                                    </div>
                                                </div>

                                                <h2 class="name">Sarah W.</h2>

                                                <div
                                                    class="studio-details mt-1 d-flex align-items-center justify-content-between">

                                                    <div class="studio">
                                                        <div class="studio">Sarah’s Grooming Studio</div>
                                                    </div>

                                                    <div class="meta d-flex align-items-center justify-content-between">
                                                        <div class="distance" title="Distance">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="10"
                                                                height="14" viewBox="0 0 10 14" fill="none">
                                                                <path
                                                                    d="M5 6.65C4.5264 6.65 4.0722 6.46563 3.73731 6.13744C3.40242 5.80925 3.21429 5.36413 3.21429 4.9C3.21429 4.43587 3.40242 3.99075 3.73731 3.66256C4.0722 3.33437 4.5264 3.15 5 3.15C5.4736 3.15 5.9278 3.33437 6.26269 3.66256C6.59758 3.99075 6.78571 4.43587 6.78571 4.9C6.78571 5.12981 6.73953 5.35738 6.64979 5.5697C6.56004 5.78202 6.42851 5.97493 6.26269 6.13744C6.09687 6.29994 5.90002 6.42884 5.68336 6.51679C5.46671 6.60473 5.2345 6.65 5 6.65ZM5 0C3.67392 0 2.40215 0.516248 1.46447 1.43518C0.526784 2.3541 0 3.60044 0 4.9C0 8.575 5 14 5 14C5 14 10 8.575 10 4.9C10 3.60044 9.47322 2.3541 8.53553 1.43518C7.59785 0.516248 6.32608 0 5 0Z"
                                                                    fill="var(--active-bg)" />
                                                            </svg>
                                                            <span>2.5 mi</span>
                                                        </div>


                                                        <div class="rating" title="Rating">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="14"
                                                                height="14" viewBox="0 0 14 14" fill="none">
                                                                <path
                                                                    d="M6.12956 0.660476C6.40354 -0.220161 7.59647 -0.220158 7.87045 0.660479L8.89548 3.95519C9.01801 4.34902 9.36942 4.61566 9.76593 4.61566H13.083C13.9696 4.61566 14.3383 5.80055 13.621 6.34481L10.9374 8.38106C10.6166 8.62446 10.4824 9.0559 10.6049 9.44973L11.63 12.7444C11.9039 13.6251 10.9388 14.3574 10.2215 13.8131L7.53797 11.7769C7.21719 11.5335 6.78282 11.5335 6.46204 11.7769L3.77846 13.8131C3.06117 14.3574 2.09607 13.6251 2.37005 12.7444L3.39508 9.44973C3.51761 9.0559 3.38338 8.62446 3.0626 8.38106L0.37903 6.34481C-0.338258 5.80055 0.0303816 4.61566 0.916998 4.61566H4.23408C4.63058 4.61566 4.98199 4.34902 5.10452 3.95519L6.12956 0.660476Z"
                                                                    fill="var(--active-bg)" />
                                                            </svg>
                                                            <span>4.3 <small
                                                                    style="color:var(--muted)">(20)</small></span>
                                                        </div>
                                                    </div>
                                                </div>



                                                <p class="experience">Hi, I’m Sarah — a professional groomer in West
                                                    London,
                                                    specialising in small breeds, <br> anxious pets, & gentle handling!
                                                    Gentle,
                                                    breed-specific trims · 6+ years experience.</p>


                                                <div class="availability">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15"
                                                        viewBox="0 0 15 15" fill="none">
                                                        <path
                                                            d="M7.5 0C3.375 0 0 3.375 0 7.5C0 11.625 3.375 15 7.5 15C11.625 15 15 11.625 15 7.5C15 3.375 11.625 0 7.5 0ZM6 11.25L2.25 7.5L3.3075 6.4425L6 9.1275L11.6925 3.435L12.75 4.5L6 11.25Z"
                                                            fill="#D8E8B7" />
                                                    </svg>
                                                    <span>Availability</span>
                                                </div>


                                                <div class="slots-price d-flex align-items-center">
                                                    <div class="slots d-flex" aria-label="Available slots">
                                                        <div class="slot highlight">Mon 1, 08:30 AM</div>
                                                        <div class="slot">Tue 15, 12:30 PM</div>
                                                        <div class="slot">Wed 27, 09:15 AM</div>
                                                        <div class="slot">Thu 9, 15:45 PM</div>
                                                    </div>
                                                    <div class="price">From <span>£38</span></div>
                                                </div>



                                            </div>
                                        </div>
                                        <div class="card mt-3">
                                            <div class="left">
                                                <div class="top-left-svg">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="21" height="22"
                                                        viewBox="0 0 21 22" fill="none">
                                                        <rect x="4.14746" y="4.14746" width="12.443" height="13.8256"
                                                            rx="3" fill="white" />
                                                        <path
                                                            d="M10.9482 0.125295C10.7667 0.043205 10.5723 0 10.3692 0C10.1662 0 9.97174 0.043205 9.79028 0.125295L1.65477 3.57738C0.704262 3.97918 -0.00430085 4.91673 1.96518e-05 6.0487C0.0216222 10.3346 1.78439 18.1764 9.22861 21.7408C9.95014 22.0864 10.7883 22.0864 11.5098 21.7408C18.9541 18.1764 20.7168 10.3346 20.7384 6.0487C20.7428 4.91673 20.0342 3.97918 19.0837 3.57738L10.9482 0.125295ZM6.26043 12.3653C6.46781 12.4171 6.68816 12.443 6.91282 12.443C8.43796 12.443 9.67795 11.2031 9.67795 9.67793V6.9128H11.5876C12.1104 6.9128 12.59 7.2066 12.8233 7.67753L13.1343 8.29537H15.8995C16.2797 8.29537 16.5907 8.60644 16.5907 8.98665V10.3692C16.5907 12.2789 15.044 13.8256 13.1343 13.8256H11.0605V16.0161C11.0605 16.3315 10.8056 16.5907 10.4859 16.5907C10.4081 16.5907 10.3303 16.5734 10.2612 16.5432L5.99688 14.7156C5.71172 14.5947 5.53026 14.3138 5.53026 14.0071C5.53026 13.8861 5.55619 13.7694 5.61235 13.6614L6.26043 12.3653ZM6.22154 6.9128H8.29538V9.67793C8.29538 10.4427 7.67755 11.0605 6.91282 11.0605C6.1481 11.0605 5.53026 10.4427 5.53026 9.67793V7.60408C5.53026 7.22388 5.84134 6.9128 6.22154 6.9128ZM11.7518 8.98665C11.7518 8.80331 11.679 8.62748 11.5493 8.49784C11.4197 8.3682 11.2438 8.29537 11.0605 8.29537C10.8772 8.29537 10.7013 8.3682 10.5717 8.49784C10.4421 8.62748 10.3692 8.80331 10.3692 8.98665C10.3692 9.16998 10.4421 9.34581 10.5717 9.47545C10.7013 9.60509 10.8772 9.67793 11.0605 9.67793C11.2438 9.67793 11.4197 9.60509 11.5493 9.47545C11.679 9.34581 11.7518 9.16998 11.7518 8.98665Z"
                                                            fill="#C9DDA0" />
                                                    </svg>
                                                </div>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="270" height="246"
                                                    viewBox="0 0 170 246">
                                                    <defs>
                                                        <clipPath id="cardClip-list-1">
                                                            <path
                                                                d="M165 0C167.761 2.57702e-06 170 2.23858 170 5V241C170 243.761 167.761 246 165 246H5C2.23858 246 0 243.761 0 241V37C0 34.2386 2.23858 32 5 32H27C29.7614 32 32 29.7614 32 27V5C32 2.23858 34.2386 0 37 0H165Z" />
                                                        </clipPath>
                                                    </defs>

                                                    <!-- Image with clip path -->
                                                    <image href="assets/images/card1.png"
                                                        preserveAspectRatio="xMidYMid slice"
                                                        clip-path="url(#cardClip-list-1)" />
                                                </svg>
                                            </div>
                                            <div class="right">
                                                <div class="top-row">
                                                    <div class="tags" aria-hidden="true">
                                                        <div class="tag">Home Visit</div>
                                                        <div class="tag">Mobile Station</div>
                                                    </div>
                                                    <div class="icons" aria-hidden="true">
                                                        <button class="first-icon" title="Top-rated">
                                                            <!-- crown -->
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="10"
                                                                height="9" viewBox="0 0 10 9" fill="none">
                                                                <path
                                                                    d="M2 8.99999C1.85833 8.99999 1.73967 8.95199 1.644 8.85599C1.54833 8.75999 1.50033 8.64133 1.5 8.49999C1.49967 8.35866 1.54767 8.23999 1.644 8.14399C1.74033 8.04799 1.859 7.99999 2 7.99999H8C8.14166 7.99999 8.2605 8.04799 8.3565 8.14399C8.4525 8.23999 8.50033 8.35866 8.5 8.49999C8.49966 8.64133 8.45166 8.76016 8.356 8.85649C8.26033 8.95283 8.14166 9.00066 8 8.99999H2ZM2.35 7.24999C2.10833 7.24999 1.89383 7.17083 1.7065 7.0125C1.51917 6.85416 1.4045 6.65416 1.3625 6.4125L0.862501 3.2375C0.845834 3.2375 0.827167 3.23967 0.806501 3.244C0.785834 3.24833 0.767001 3.25033 0.750001 3.25C0.541667 3.25 0.364668 3.17717 0.219001 3.0315C0.0733344 2.88583 0.000334469 2.70867 1.13636e-06 2.5C-0.000332197 2.29133 0.0726677 2.11433 0.219001 1.969C0.365334 1.82367 0.542334 1.75067 0.750001 1.75C0.957667 1.74933 1.13483 1.82233 1.2815 1.969C1.42817 2.11567 1.501 2.29267 1.5 2.5C1.5 2.55833 1.49367 2.6125 1.481 2.6625C1.46833 2.7125 1.45383 2.75833 1.4375 2.8L3 3.5L4.5625 1.3625C4.47083 1.29583 4.39583 1.20833 4.3375 1.1C4.27917 0.991667 4.25 0.875 4.25 0.75C4.25 0.541667 4.323 0.364501 4.469 0.218501C4.615 0.0725011 4.792 -0.000332194 5 1.13895e-06C5.208 0.000334472 5.38516 0.0733344 5.5315 0.219001C5.67783 0.364667 5.75066 0.541667 5.75 0.75C5.75 0.875 5.72083 0.991667 5.6625 1.1C5.60416 1.20833 5.52916 1.29583 5.4375 1.3625L7 3.5L8.5625 2.8C8.54583 2.75833 8.53116 2.7125 8.5185 2.6625C8.50583 2.6125 8.49966 2.55833 8.5 2.5C8.5 2.29167 8.573 2.1145 8.719 1.9685C8.865 1.8225 9.042 1.74967 9.25 1.75C9.458 1.75033 9.63516 1.82333 9.7815 1.969C9.92783 2.11467 10.0007 2.29167 10 2.5C9.99933 2.70833 9.92649 2.8855 9.7815 3.0315C9.6365 3.1775 9.45933 3.25033 9.25 3.25C9.23333 3.25 9.21466 3.248 9.194 3.244C9.17333 3.24 9.1545 3.23783 9.1375 3.2375L8.6375 6.4125C8.59583 6.65416 8.48133 6.85416 8.294 7.0125C8.10666 7.17083 7.892 7.24999 7.65 7.24999H2.35ZM2.35 6.25H7.65L7.975 4.1625L7.4 4.4125C7.18333 4.50416 6.9625 4.52083 6.7375 4.4625C6.5125 4.40416 6.32916 4.27916 6.1875 4.0875L5 2.45L3.8125 4.0875C3.67083 4.27916 3.4875 4.40416 3.2625 4.4625C3.0375 4.52083 2.81667 4.50416 2.6 4.4125L2.025 4.1625L2.35 6.25Z"
                                                                    fill="white" />
                                                            </svg>
                                                        </button>
                                                        <button class="second-icon" title="Favourite">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="9"
                                                                height="11" viewBox="0 0 9 11" fill="none">
                                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                                    d="M3.79701 0.30821C3.81025 0.23997 3.84191 0.176658 3.88858 0.125138C3.93524 0.0736173 3.99512 0.0358558 4.06172 0.0159479C4.12832 -0.00396001 4.1991 -0.00525449 4.26638 0.0122049C4.33367 0.0296642 4.39489 0.0652111 4.4434 0.114991C4.56671 0.240837 4.80378 0.489988 5.04467 0.777274C5.28111 1.05884 5.53916 1.39761 5.68788 1.69951C5.8328 1.99443 5.98661 2.37578 6.10801 2.69421L6.67305 1.75354C6.70456 1.701 6.74826 1.65683 6.80046 1.62476C6.85265 1.59269 6.91181 1.57367 6.97292 1.56931C7.03402 1.56494 7.09528 1.57536 7.1515 1.59969C7.20773 1.62401 7.25727 1.66152 7.29592 1.70905C8.09867 2.70057 8.49846 3.76263 8.6974 4.57365C8.79718 4.97979 8.8474 5.32491 8.87282 5.57025C8.88576 5.69278 8.89424 5.81574 8.89824 5.93889V5.97131C8.89824 8.4482 6.93364 10.4649 4.44785 10.4649C1.96206 10.4649 0 8.44756 0 5.97004C0 5.28805 0.322244 3.68192 1.27563 2.36498C1.31266 2.31422 1.36166 2.27341 1.41826 2.24615C1.47487 2.2189 1.53734 2.20605 1.60011 2.20876C1.66287 2.21146 1.724 2.22963 1.77806 2.26166C1.83211 2.29368 1.87741 2.33856 1.90994 2.39231L2.55507 3.46709C2.75083 3.16073 3.01269 2.73044 3.21163 2.3332C3.49765 1.76117 3.72455 0.682572 3.79701 0.308845M4.3201 0.912655C4.20506 1.42113 4.01501 2.14697 3.77985 2.61858C3.46714 3.24336 3.0165 3.9298 2.86142 4.16051C2.82554 4.21345 2.77693 4.25651 2.72005 4.28574C2.66317 4.31497 2.59986 4.32943 2.53593 4.32778C2.472 4.32614 2.40952 4.30844 2.35422 4.27632C2.29892 4.24421 2.25258 4.1987 2.21948 4.14399L1.57118 3.06476C0.87457 4.19166 0.635589 5.45839 0.635589 5.97131C0.635589 8.10561 2.32244 9.82806 4.44785 9.82806C6.57326 9.82806 8.26265 8.10561 8.26265 5.97131V5.95351L8.26011 5.88995C8.25568 5.80484 8.24911 5.71986 8.24041 5.63508C8.20712 5.3287 8.15362 5.02487 8.08024 4.72555C7.87826 3.89157 7.52027 3.10334 7.02516 2.40248L6.38068 3.47535C6.34338 3.53732 6.28925 3.58743 6.22459 3.61985C6.15993 3.65227 6.08739 3.66566 6.01542 3.65847C5.94344 3.65128 5.87499 3.6238 5.81802 3.57923C5.76105 3.53466 5.71791 3.47483 5.6936 3.40671C5.59064 3.11815 5.33831 2.42917 5.11713 1.98044C5.00463 1.751 4.78916 1.46117 4.55781 1.18596C4.4801 1.09353 4.40086 1.00242 4.3201 0.912655Z"
                                                                    fill="#FEFEFE" />
                                                            </svg>
                                                        </button>
                                                    </div>
                                                </div>

                                                <h2 class="name">Sarah W.</h2>

                                                <div
                                                    class="studio-details mt-1 d-flex align-items-center justify-content-between">

                                                    <div class="studio">
                                                        <div class="studio">Sarah’s Grooming Studio</div>
                                                    </div>

                                                    <div class="meta d-flex align-items-center justify-content-between">
                                                        <div class="distance" title="Distance">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="10"
                                                                height="14" viewBox="0 0 10 14" fill="none">
                                                                <path
                                                                    d="M5 6.65C4.5264 6.65 4.0722 6.46563 3.73731 6.13744C3.40242 5.80925 3.21429 5.36413 3.21429 4.9C3.21429 4.43587 3.40242 3.99075 3.73731 3.66256C4.0722 3.33437 4.5264 3.15 5 3.15C5.4736 3.15 5.9278 3.33437 6.26269 3.66256C6.59758 3.99075 6.78571 4.43587 6.78571 4.9C6.78571 5.12981 6.73953 5.35738 6.64979 5.5697C6.56004 5.78202 6.42851 5.97493 6.26269 6.13744C6.09687 6.29994 5.90002 6.42884 5.68336 6.51679C5.46671 6.60473 5.2345 6.65 5 6.65ZM5 0C3.67392 0 2.40215 0.516248 1.46447 1.43518C0.526784 2.3541 0 3.60044 0 4.9C0 8.575 5 14 5 14C5 14 10 8.575 10 4.9C10 3.60044 9.47322 2.3541 8.53553 1.43518C7.59785 0.516248 6.32608 0 5 0Z"
                                                                    fill="var(--active-bg)" />
                                                            </svg>
                                                            <span>2.5 mi</span>
                                                        </div>


                                                        <div class="rating" title="Rating">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="14"
                                                                height="14" viewBox="0 0 14 14" fill="none">
                                                                <path
                                                                    d="M6.12956 0.660476C6.40354 -0.220161 7.59647 -0.220158 7.87045 0.660479L8.89548 3.95519C9.01801 4.34902 9.36942 4.61566 9.76593 4.61566H13.083C13.9696 4.61566 14.3383 5.80055 13.621 6.34481L10.9374 8.38106C10.6166 8.62446 10.4824 9.0559 10.6049 9.44973L11.63 12.7444C11.9039 13.6251 10.9388 14.3574 10.2215 13.8131L7.53797 11.7769C7.21719 11.5335 6.78282 11.5335 6.46204 11.7769L3.77846 13.8131C3.06117 14.3574 2.09607 13.6251 2.37005 12.7444L3.39508 9.44973C3.51761 9.0559 3.38338 8.62446 3.0626 8.38106L0.37903 6.34481C-0.338258 5.80055 0.0303816 4.61566 0.916998 4.61566H4.23408C4.63058 4.61566 4.98199 4.34902 5.10452 3.95519L6.12956 0.660476Z"
                                                                    fill="var(--active-bg)" />
                                                            </svg>
                                                            <span>4.3 <small
                                                                    style="color:var(--muted)">(20)</small></span>
                                                        </div>
                                                    </div>
                                                </div>



                                                <p class="experience">Hi, I’m Sarah — a professional groomer in West
                                                    London,
                                                    specialising in small breeds, <br> anxious pets, & gentle handling!
                                                    Gentle,
                                                    breed-specific trims · 6+ years experience.</p>


                                                <div class="availability">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15"
                                                        viewBox="0 0 15 15" fill="none">
                                                        <path
                                                            d="M7.5 0C3.375 0 0 3.375 0 7.5C0 11.625 3.375 15 7.5 15C11.625 15 15 11.625 15 7.5C15 3.375 11.625 0 7.5 0ZM6 11.25L2.25 7.5L3.3075 6.4425L6 9.1275L11.6925 3.435L12.75 4.5L6 11.25Z"
                                                            fill="#D8E8B7" />
                                                    </svg>
                                                    <span>Availability</span>
                                                </div>


                                                <div class="slots-price d-flex align-items-center">
                                                    <div class="slots d-flex" aria-label="Available slots">
                                                        <div class="slot highlight">Mon 1, 08:30 AM</div>
                                                        <div class="slot">Tue 15, 12:30 PM</div>
                                                        <div class="slot">Wed 27, 09:15 AM</div>
                                                        <div class="slot">Thu 9, 15:45 PM</div>
                                                    </div>
                                                    <div class="price">From <span>£38</span></div>
                                                </div>



                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-1"></div>
                                    <div class="col-lg-12 text-center section-gap">
                                        <button class="load-more">Load More</button>
                                    </div>
                                </div>
                            </div>
                        </section>
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

                    <div class="col-lg-12 section-gap">
                        <div class="selection-box d-flex align-items-center justify-content-between">
                            <div class="selected-item-section d-flex align-items-center">
                                <div class="selected-item d-flex align-items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="10" height="11" viewBox="0 0 10 11"
                                        fill="none">
                                        <path
                                            d="M4.44238 0.607422C4.57185 0.744073 4.74616 0.931439 4.91992 1.13867C5.10303 1.35674 5.28259 1.59 5.41504 1.80273L5.53027 2.00781C5.67188 2.29613 5.82691 2.67871 5.95312 3.00977L6.31934 3.9707L6.84863 3.08984L7.36816 2.22363C8.00034 3.03951 8.36478 3.89752 8.57324 4.61523L8.65625 4.92676C8.75477 5.32776 8.80434 5.66743 8.8291 5.90625V5.90723L8.85352 6.25879V6.27637C8.85352 8.61074 7.00462 10.5 4.6748 10.5C2.34575 10.4997 0.500054 8.61074 0.5 6.27539C0.5 5.67251 0.793512 4.17103 1.65918 2.90527L2.25684 3.90137L2.67285 4.59375L3.10742 3.91406C3.3166 3.5867 3.60263 3.11726 3.82324 2.67676V2.67578C3.99818 2.3258 4.14299 1.84921 4.25098 1.43652C4.33332 1.12184 4.39789 0.822897 4.44238 0.607422Z"
                                            fill="#FBAC83" stroke="#FBAC83" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M6.74108 8.29709C6.77149 7.71955 6.63866 7.14511 6.35782 6.63954C6.07697 6.13397 5.65944 5.71769 5.15303 5.43835C5.06311 5.38633 4.95649 5.37125 4.85567 5.3963C4.75484 5.42135 4.66768 5.48457 4.61255 5.57263L3.96852 6.60349L3.43271 5.95545C3.40327 5.91992 3.3668 5.89088 3.32558 5.87016C3.28436 5.84943 3.2393 5.83747 3.19323 5.83502C3.14716 5.83257 3.10108 5.83969 3.0579 5.85593C3.01472 5.87218 2.97537 5.89719 2.94233 5.92939C2.62692 6.23461 2.38055 6.60384 2.21979 7.01225C2.05903 7.42066 1.98761 7.85877 2.01035 8.29709C2.01035 8.92434 2.25953 9.52589 2.70305 9.96942C3.14658 10.4129 3.74814 10.6621 4.37538 10.6621C5.00263 10.6621 5.60418 10.4129 6.04771 9.96942C6.49124 9.52589 6.74108 8.92434 6.74108 8.29709Z"
                                            fill="white" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M6.74108 8.29709C6.77149 7.71955 6.63867 7.14511 6.35782 6.63954C6.07697 6.13397 5.65944 5.71769 5.15304 5.43835C5.06311 5.38633 4.95649 5.37125 4.85567 5.3963C4.75484 5.42135 4.66768 5.48457 4.61255 5.57263L3.96852 6.60349L3.43271 5.95545C3.40327 5.91992 3.3668 5.89088 3.32558 5.87016C3.28436 5.84943 3.2393 5.83747 3.19323 5.83502C3.14716 5.83257 3.10108 5.83969 3.0579 5.85593C3.01472 5.87218 2.97537 5.89719 2.94233 5.92939C2.62692 6.23461 2.38055 6.60384 2.21979 7.01225C2.05903 7.42066 1.98761 7.85877 2.01035 8.29709C2.01035 8.92434 2.25953 9.52589 2.70305 9.96942C3.14658 10.4129 3.74814 10.6621 4.37538 10.6621C5.00263 10.6621 5.60418 10.4129 6.04771 9.96942C6.49124 9.52589 6.74108 8.92434 6.74108 8.29709ZM3.16414 6.68032L3.12272 6.7351C2.80853 7.17399 2.65111 7.70579 2.67577 8.24498L2.67777 8.2844C2.67777 8.73445 2.85656 9.16608 3.17479 9.48432C3.49303 9.80255 3.92466 9.98134 4.37471 9.98134C4.82477 9.98134 5.25639 9.80255 5.57463 9.48432C5.89287 9.16608 6.07165 8.73445 6.07165 8.2844L6.07366 8.24565C6.07834 8.20222 6.18256 7.00768 5.08957 6.19529L5.03545 6.15587L4.33797 7.27158C4.30429 7.32539 4.25831 7.37043 4.20382 7.40299C4.14933 7.43556 4.08789 7.45471 4.02455 7.45889C3.96121 7.46306 3.89778 7.45214 3.83949 7.427C3.7812 7.40187 3.72971 7.36326 3.68926 7.31434L3.16414 6.68032Z"
                                            fill="#FBAC83" />
                                        <mask id="path-4-inside-1_164_345" fill="white">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M3.99115 0.323969C4.00507 0.25224 4.03835 0.18569 4.0874 0.131536C4.13645 0.0773814 4.19939 0.0376891 4.2694 0.0167633C4.33941 -0.00416248 4.4138 -0.00552315 4.48453 0.0128289C4.55525 0.031181 4.6196 0.0685454 4.6706 0.12087C4.80021 0.253151 5.0494 0.515042 5.30261 0.817017C5.55114 1.11298 5.82238 1.46907 5.97871 1.78641C6.13103 2.0964 6.29271 2.49726 6.42032 2.83197L7.01425 1.8432C7.04737 1.78798 7.0933 1.74155 7.14817 1.70784C7.20304 1.67413 7.26522 1.65414 7.32945 1.64955C7.39368 1.64496 7.45807 1.65591 7.51717 1.68148C7.57627 1.70705 7.62834 1.74648 7.66897 1.79643C8.51276 2.83865 8.93299 3.95502 9.1421 4.8075C9.24699 5.23441 9.29977 5.59718 9.32649 5.85506C9.34009 5.98386 9.34901 6.11311 9.35322 6.24255V6.27662C9.35322 8.88016 7.28816 11 4.67527 11C2.06238 11 0 8.87949 0 6.27529C0 5.55843 0.33872 3.87017 1.34085 2.4859C1.37978 2.43255 1.43128 2.38965 1.49078 2.361C1.55028 2.33235 1.61594 2.31885 1.68192 2.3217C1.7479 2.32454 1.81215 2.34364 1.86897 2.3773C1.92579 2.41095 1.97341 2.45813 2.0076 2.51463L2.68571 3.64436C2.89148 3.32234 3.16673 2.87005 3.37584 2.45249C3.67648 1.85122 3.91499 0.717472 3.99115 0.324637M4.54099 0.959319C4.42006 1.49379 4.22031 2.25674 3.97311 2.75247C3.64441 3.40919 3.17074 4.13073 3.00773 4.37324C2.97001 4.42889 2.91891 4.47415 2.85913 4.50488C2.79934 4.5356 2.73279 4.5508 2.66559 4.54907C2.5984 4.54734 2.53272 4.52874 2.47459 4.49498C2.41646 4.46122 2.36776 4.41338 2.33296 4.35587L1.65151 3.22146C0.919288 4.40598 0.668087 5.73748 0.668087 6.27662C0.668087 8.52006 2.44119 10.3306 4.67527 10.3306C6.90936 10.3306 8.68513 8.52006 8.68513 6.27662V6.25792L8.68246 6.19111C8.6778 6.10165 8.6709 6.01232 8.66175 5.92321C8.62676 5.60117 8.57052 5.28179 8.49339 4.96717C8.28108 4.09054 7.90478 3.26201 7.38437 2.52532L6.70693 3.65305C6.66772 3.71819 6.61082 3.77086 6.54286 3.80494C6.47489 3.83901 6.39864 3.85309 6.32299 3.84553C6.24734 3.83797 6.17538 3.80909 6.1155 3.76224C6.05562 3.71539 6.01027 3.6525 5.98472 3.58089C5.87649 3.27758 5.61126 2.55338 5.37877 2.08171C5.26052 1.84053 5.03404 1.53588 4.79085 1.2466C4.70917 1.14945 4.62587 1.05368 4.54099 0.959319Z" />
                                        </mask>
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M3.99115 0.323969C4.00507 0.25224 4.03835 0.18569 4.0874 0.131536C4.13645 0.0773814 4.19939 0.0376891 4.2694 0.0167633C4.33941 -0.00416248 4.4138 -0.00552315 4.48453 0.0128289C4.55525 0.031181 4.6196 0.0685454 4.6706 0.12087C4.80021 0.253151 5.0494 0.515042 5.30261 0.817017C5.55114 1.11298 5.82238 1.46907 5.97871 1.78641C6.13103 2.0964 6.29271 2.49726 6.42032 2.83197L7.01425 1.8432C7.04737 1.78798 7.0933 1.74155 7.14817 1.70784C7.20304 1.67413 7.26522 1.65414 7.32945 1.64955C7.39368 1.64496 7.45807 1.65591 7.51717 1.68148C7.57627 1.70705 7.62834 1.74648 7.66897 1.79643C8.51276 2.83865 8.93299 3.95502 9.1421 4.8075C9.24699 5.23441 9.29977 5.59718 9.32649 5.85506C9.34009 5.98386 9.34901 6.11311 9.35322 6.24255V6.27662C9.35322 8.88016 7.28816 11 4.67527 11C2.06238 11 0 8.87949 0 6.27529C0 5.55843 0.33872 3.87017 1.34085 2.4859C1.37978 2.43255 1.43128 2.38965 1.49078 2.361C1.55028 2.33235 1.61594 2.31885 1.68192 2.3217C1.7479 2.32454 1.81215 2.34364 1.86897 2.3773C1.92579 2.41095 1.97341 2.45813 2.0076 2.51463L2.68571 3.64436C2.89148 3.32234 3.16673 2.87005 3.37584 2.45249C3.67648 1.85122 3.91499 0.717472 3.99115 0.324637M4.54099 0.959319C4.42006 1.49379 4.22031 2.25674 3.97311 2.75247C3.64441 3.40919 3.17074 4.13073 3.00773 4.37324C2.97001 4.42889 2.91891 4.47415 2.85913 4.50488C2.79934 4.5356 2.73279 4.5508 2.66559 4.54907C2.5984 4.54734 2.53272 4.52874 2.47459 4.49498C2.41646 4.46122 2.36776 4.41338 2.33296 4.35587L1.65151 3.22146C0.919288 4.40598 0.668087 5.73748 0.668087 6.27662C0.668087 8.52006 2.44119 10.3306 4.67527 10.3306C6.90936 10.3306 8.68513 8.52006 8.68513 6.27662V6.25792L8.68246 6.19111C8.6778 6.10165 8.6709 6.01232 8.66175 5.92321C8.62676 5.60117 8.57052 5.28179 8.49339 4.96717C8.28108 4.09054 7.90478 3.26201 7.38437 2.52532L6.70693 3.65305C6.66772 3.71819 6.61082 3.77086 6.54286 3.80494C6.47489 3.83901 6.39864 3.85309 6.32299 3.84553C6.24734 3.83797 6.17538 3.80909 6.1155 3.76224C6.05562 3.71539 6.01027 3.6525 5.98472 3.58089C5.87649 3.27758 5.61126 2.55338 5.37877 2.08171C5.26052 1.84053 5.03404 1.53588 4.79085 1.2466C4.70917 1.14945 4.62587 1.05368 4.54099 0.959319Z"
                                            fill="#FBAC83" />
                                        <path
                                            d="M4.6706 0.12087L3.95446 0.818836L3.95631 0.820725L4.6706 0.12087ZM5.30261 0.817017L4.53633 1.45953L4.5368 1.46009L5.30261 0.817017ZM5.97871 1.78641L6.87621 1.3454L6.87577 1.34449L5.97871 1.78641ZM6.42032 2.83197L5.48592 3.1882L6.21855 5.10991L7.27755 3.34689L6.42032 2.83197ZM7.01425 1.8432L7.87148 2.35812L7.87182 2.35756L7.01425 1.8432ZM7.66897 1.79643L8.44618 1.16719L8.44473 1.1654L7.66897 1.79643ZM9.1421 4.8075L8.17089 5.04574L8.17098 5.0461L9.1421 4.8075ZM9.32649 5.85506L8.33182 5.95814L8.33202 5.96007L9.32649 5.85506ZM9.35322 6.24255H10.3532V6.22629L10.3527 6.21005L9.35322 6.24255ZM1.34085 2.4859L0.533031 1.89646L0.530832 1.89949L1.34085 2.4859ZM2.0076 2.51463L2.86501 1.99998L2.86312 1.99686L2.0076 2.51463ZM2.68571 3.64436L1.82831 4.15901L2.65911 5.54314L3.52836 4.18282L2.68571 3.64436ZM3.37584 2.45249L4.26999 2.90028L4.27027 2.89971L3.37584 2.45249ZM4.54099 0.959319L5.28441 0.290499L3.99205 -1.14602L3.56564 0.738647L4.54099 0.959319ZM3.97311 2.75247L4.86736 3.20004L4.86802 3.19871L3.97311 2.75247ZM3.00773 4.37324L3.83552 4.9343L3.83766 4.93111L3.00773 4.37324ZM2.33296 4.35587L1.47573 4.87082L1.47741 4.87359L2.33296 4.35587ZM1.65151 3.22146L2.50874 2.70652L1.66374 1.29985L0.800909 2.69565L1.65151 3.22146ZM8.68513 6.25792H9.68513V6.23793L9.68433 6.21795L8.68513 6.25792ZM8.68246 6.19111L9.68173 6.15114L9.68111 6.13912L8.68246 6.19111ZM8.66175 5.92321L9.65654 5.82109L9.6559 5.8152L8.66175 5.92321ZM8.49339 4.96717L7.52148 5.20256L7.52215 5.20527L8.49339 4.96717ZM7.38437 2.52532L8.20113 1.94834L7.31659 0.69619L6.52714 2.01037L7.38437 2.52532ZM6.70693 3.65305L7.56372 4.16871L7.56415 4.16799L6.70693 3.65305ZM5.98472 3.58089L6.9266 3.24493L6.92656 3.24482L5.98472 3.58089ZM5.37877 2.08171L4.48088 2.52194L4.48181 2.52383L5.37877 2.08171ZM4.79085 1.2466L5.55631 0.603115L5.55628 0.60307L4.79085 1.2466ZM3.99115 0.323969L4.97285 0.51442C4.95199 0.621931 4.9021 0.721679 4.82858 0.802848L4.0874 0.131536L3.34623 -0.539776C3.17461 -0.350298 3.05814 -0.117451 3.00946 0.133517L3.99115 0.323969ZM4.0874 0.131536L4.82858 0.802848C4.75506 0.884017 4.66072 0.94351 4.5558 0.974874L4.2694 0.0167633L3.983 -0.941348C3.73807 -0.868132 3.51785 -0.729254 3.34623 -0.539776L4.0874 0.131536ZM4.2694 0.0167633L4.5558 0.974874C4.45087 1.00624 4.33936 1.00828 4.23335 0.980771L4.48453 0.0128289L4.7357 -0.955114C4.48825 -1.01932 4.22794 -1.01456 3.983 -0.941348L4.2694 0.0167633ZM4.48453 0.0128289L4.23335 0.980771C4.12735 0.953265 4.0309 0.897261 3.95446 0.818834L4.6706 0.12087L5.38673 -0.577094C5.2083 -0.760171 4.98315 -0.890903 4.7357 -0.955114L4.48453 0.0128289ZM4.6706 0.12087L3.95631 0.820725C4.07517 0.942031 4.30529 1.18398 4.53633 1.45953L5.30261 0.817017L6.06888 0.174501C5.79352 -0.153898 5.52524 -0.435728 5.38488 -0.578985L4.6706 0.12087ZM5.30261 0.817017L4.5368 1.46009C4.7767 1.74578 4.98159 2.0252 5.08166 2.22833L5.97871 1.78641L6.87577 1.34449C6.66317 0.912941 6.32557 0.480181 6.06841 0.173946L5.30261 0.817017ZM5.97871 1.78641L5.08121 2.22742C5.21241 2.49442 5.3608 2.86002 5.48592 3.1882L6.42032 2.83197L7.35471 2.47574C7.22462 2.13449 7.04966 1.69839 6.87621 1.3454L5.97871 1.78641ZM6.42032 2.83197L7.27755 3.34689L7.87148 2.35812L7.01425 1.8432L6.15701 1.32828L5.56308 2.31705L6.42032 2.83197ZM7.01425 1.8432L7.87182 2.35756C7.82231 2.4401 7.75365 2.5095 7.67164 2.55988L7.14817 1.70784L6.6247 0.855795C6.43296 0.973593 6.27242 1.13585 6.15667 1.32884L7.01425 1.8432ZM7.14817 1.70784L7.67164 2.55988C7.58964 2.61026 7.4967 2.64015 7.40069 2.64701L7.32945 1.64955L7.2582 0.652089C7.03373 0.668122 6.81644 0.737997 6.6247 0.855795L7.14817 1.70784ZM7.32945 1.64955L7.40069 2.64701C7.30469 2.65386 7.20844 2.63749 7.12011 2.59928L7.51717 1.68148L7.91422 0.763687C7.70769 0.674336 7.48267 0.636056 7.2582 0.652089L7.32945 1.64955ZM7.51717 1.68148L7.12011 2.59928C7.03178 2.56106 6.95395 2.50213 6.89321 2.42746L7.66897 1.79643L8.44473 1.1654C8.30273 0.99083 8.12076 0.853037 7.91422 0.763687L7.51717 1.68148ZM7.66897 1.79643L6.89176 2.42567C7.61847 3.32328 7.98627 4.2931 8.17089 5.04574L9.1421 4.8075L10.1133 4.56927C9.87971 3.61695 9.40706 2.35402 8.44618 1.16719L7.66897 1.79643ZM9.1421 4.8075L8.17098 5.0461C8.26324 5.42159 8.30904 5.73834 8.33182 5.95814L9.32649 5.85506L10.3212 5.75199C10.2905 5.45602 10.2307 5.04722 10.1132 4.5689L9.1421 4.8075ZM9.32649 5.85506L8.33202 5.96007C8.34308 6.06477 8.35032 6.16984 8.35375 6.27506L9.35322 6.24255L10.3527 6.21005C10.3477 6.05638 10.3371 5.90295 10.321 5.75005L9.32649 5.85506ZM9.35322 6.24255H8.35322V6.27662H9.35322H10.3532V6.24255H9.35322ZM9.35322 6.27662H8.35322C8.35322 8.34183 6.72202 10 4.67527 10V11V12C7.8543 12 10.3532 9.41848 10.3532 6.27662H9.35322ZM4.67527 11V10C2.62954 10 1 8.3422 1 6.27529H0H-1C-1 9.41679 1.49523 12 4.67527 12V11ZM0 6.27529H1C1 5.74637 1.28489 4.26851 2.15087 3.0723L1.34085 2.4859L0.530832 1.89949C-0.60745 3.47184 -1 5.3705 -1 6.27529H0ZM1.34085 2.4859L2.14866 3.07534C2.09048 3.15507 2.0135 3.2192 1.92456 3.26202L1.49078 2.361L1.057 1.45998C0.849056 1.56009 0.669069 1.71003 0.533037 1.89646L1.34085 2.4859ZM1.49078 2.361L1.92456 3.26202C1.83563 3.30484 1.73749 3.32502 1.63887 3.32077L1.68192 2.3217L1.72497 1.32262C1.4944 1.31269 1.26494 1.35987 1.057 1.45998L1.49078 2.361ZM1.68192 2.3217L1.63887 3.32077C1.54026 3.31652 1.44422 3.28797 1.35929 3.23766L1.86897 2.3773L2.37864 1.51693C2.18008 1.3993 1.95554 1.33256 1.72497 1.32262L1.68192 2.3217ZM1.86897 2.3773L1.35929 3.23766C1.27437 3.18735 1.20319 3.11684 1.15208 3.0324L2.0076 2.51463L2.86312 1.99686C2.74363 1.79941 2.5772 1.63455 2.37864 1.51693L1.86897 2.3773ZM2.0076 2.51463L1.1502 3.02927L1.82831 4.15901L2.68571 3.64436L3.54311 3.12972L2.86501 1.99998L2.0076 2.51463ZM2.68571 3.64436L3.52836 4.18282C3.74101 3.85004 4.03784 3.36382 4.26998 2.90028L3.37584 2.45249L2.4817 2.00471C2.29562 2.37628 2.04195 2.79465 1.84306 3.1059L2.68571 3.64436ZM3.37584 2.45249L4.27027 2.89971C4.46993 2.50039 4.62575 1.98129 4.73508 1.56364C4.84917 1.12779 4.93245 0.723448 4.97287 0.51497L3.99115 0.324637L3.00943 0.134303C2.97369 0.31866 2.89963 0.677604 2.80027 1.05715C2.69615 1.45491 2.58239 1.80332 2.48142 2.00528L3.37584 2.45249ZM4.54099 0.959319L3.56564 0.738647C3.44418 1.27548 3.26562 1.93036 3.0782 2.30622L3.97311 2.75247L4.86802 3.19871C5.17499 2.58313 5.39595 1.7121 5.51634 1.17999L4.54099 0.959319ZM3.97311 2.75247L3.07887 2.30489C2.78051 2.90099 2.33726 3.57815 2.17779 3.81538L3.00773 4.37324L3.83766 4.93111C4.00422 4.68331 4.50832 3.9174 4.86736 3.20004L3.97311 2.75247ZM3.00773 4.37324L2.17995 3.81219C2.23631 3.72903 2.31269 3.66137 2.40205 3.61545L2.85913 4.50488L3.3162 5.3943C3.52514 5.28693 3.70372 5.12875 3.83551 4.9343L3.00773 4.37324ZM2.85913 4.50488L2.40205 3.61545C2.49142 3.56952 2.59089 3.54681 2.69133 3.5494L2.66559 4.54907L2.63986 5.54873C2.87469 5.55478 3.10727 5.50167 3.3162 5.3943L2.85913 4.50488ZM2.66559 4.54907L2.69133 3.5494C2.79177 3.55198 2.88994 3.57978 2.97682 3.63024L2.47459 4.49498L1.97236 5.35971C2.17549 5.47769 2.40503 5.54269 2.63986 5.54873L2.66559 4.54907ZM2.47459 4.49498L2.97682 3.63024C3.0637 3.6807 3.1365 3.7522 3.18851 3.83816L2.33296 4.35587L1.47741 4.87359C1.59902 5.07457 1.76923 5.24173 1.97236 5.35971L2.47459 4.49498ZM2.33296 4.35587L3.19019 3.84093L2.50874 2.70652L1.65151 3.22146L0.794286 3.7364L1.47573 4.87082L2.33296 4.35587ZM1.65151 3.22146L0.800909 2.69565C-0.0307801 4.04108 -0.331913 5.55519 -0.331913 6.27662H0.668087H1.66809C1.66809 5.91977 1.86936 4.77088 2.50211 3.74727L1.65151 3.22146ZM0.668087 6.27662H-0.331913C-0.331913 9.05867 1.87532 11.3306 4.67527 11.3306V10.3306V9.33058C3.00706 9.33058 1.66809 7.98146 1.66809 6.27662H0.668087ZM4.67527 10.3306V11.3306C7.47436 11.3306 9.68513 9.05954 9.68513 6.27662H8.68513H7.68513C7.68513 7.98058 6.34435 9.33058 4.67527 9.33058V10.3306ZM8.68513 6.27662H9.68513V6.25792H8.68513H7.68513V6.27662H8.68513ZM8.68513 6.25792L9.68433 6.21795L9.68166 6.15114L8.68246 6.19111L7.68326 6.23107L7.68593 6.29788L8.68513 6.25792ZM8.68246 6.19111L9.68111 6.13912C9.67558 6.03292 9.66738 5.92688 9.65652 5.82109L8.66175 5.92321L7.66698 6.02532C7.67441 6.09776 7.68003 6.17038 7.68381 6.2431L8.68246 6.19111ZM8.66175 5.92321L9.6559 5.8152C9.61615 5.44934 9.55225 5.0865 9.46463 4.72907L8.49339 4.96717L7.52215 5.20527C7.58878 5.47708 7.63737 5.753 7.6676 6.03121L8.66175 5.92321ZM8.49339 4.96717L9.46529 4.73179C9.22328 3.73253 8.79434 2.78809 8.20113 1.94834L7.38437 2.52532L6.5676 3.10229C7.01522 3.73593 7.33888 4.44856 7.52149 5.20256L8.49339 4.96717ZM7.38437 2.52532L6.52714 2.01037L5.8497 3.1381L6.70693 3.65305L7.56415 4.16799L8.24159 3.04026L7.38437 2.52532ZM6.70693 3.65305L5.85013 3.13739C5.90857 3.04029 5.99338 2.96178 6.09468 2.91099L6.54286 3.80494L6.99103 4.69888C7.22827 4.57994 7.42687 4.39609 7.56372 4.16871L6.70693 3.65305ZM6.54286 3.80494L6.09468 2.91099C6.19599 2.8602 6.30964 2.83922 6.4224 2.85048L6.32299 3.84553L6.22358 4.84058C6.48765 4.86696 6.75379 4.81782 6.99103 4.69888L6.54286 3.80494ZM6.32299 3.84553L6.4224 2.85048C6.53517 2.86175 6.64242 2.9048 6.73167 2.97463L6.1155 3.76224L5.49933 4.54985C5.70835 4.71338 5.9595 4.81419 6.22358 4.84058L6.32299 3.84553ZM6.1155 3.76224L6.73167 2.97463C6.82093 3.04446 6.88853 3.13819 6.9266 3.24493L5.98472 3.58089L5.04285 3.91685C5.13201 4.16681 5.2903 4.38633 5.49933 4.54985L6.1155 3.76224ZM5.98472 3.58089L6.92656 3.24482C6.82032 2.94707 6.53738 2.17042 6.27572 1.63958L5.37877 2.08171L4.48181 2.52383C4.68514 2.93633 4.93267 3.60809 5.04289 3.91697L5.98472 3.58089ZM5.37877 2.08171L6.27665 1.64147C6.10174 1.28472 5.80807 0.902591 5.55631 0.603115L4.79085 1.2466L4.02539 1.89008C4.26 2.16917 4.4193 2.39633 4.48089 2.52194L5.37877 2.08171ZM4.79085 1.2466L5.55628 0.60307C5.46741 0.497369 5.37677 0.393164 5.28441 0.290499L4.54099 0.959319L3.79756 1.62814C3.87498 1.71419 3.95094 1.80153 4.02543 1.89012L4.79085 1.2466Z"
                                            fill="#FBAC83" mask="url(#path-4-inside-1_164_345)" />
                                    </svg>
                                    <p>Top Rated</p>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="9" height="9" viewBox="0 0 9 9"
                                        fill="none">
                                        <path d="M0.5 7.57L7.572 0.5M0.5 0.5L7.572 7.57" stroke="#FBAC83"
                                            stroke-linecap="round" />
                                    </svg>
                                </div>
                                <div class="selected-item d-flex align-items-center">
                                    <p>Garden / Shed</p>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="9" height="9" viewBox="0 0 9 9"
                                        fill="none">
                                        <path d="M0.5 7.57L7.572 0.5M0.5 0.5L7.572 7.57" stroke="#FBAC83"
                                            stroke-linecap="round" />
                                    </svg>
                                </div>
                            </div>
                            <div class="venu-sorting-section d-flex align-items-center">
                                <div class="venue-selection">
                                    Space Venue
                                    &nbsp;
                                    <svg xmlns="http://www.w3.org/2000/svg" width="13" height="7" viewBox="0 0 13 7"
                                        fill="none">
                                        <path d="M11.9103 0.5L6.15684 6.25344L0.499989 0.596581" stroke="#FBAC83"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <div class="venue-list">
                                        <div class="venu dropdown">
                                            <ul>
                                                <li class="active">
                                                    <span class="option-text">Private rooms</span>
                                                    <span class="radio-circle"></span>
                                                </li>
                                                <li>
                                                    <span class="option-text">Salon</span>
                                                    <span class="radio-circle"></span>
                                                </li>
                                                <li>
                                                    <span class="option-text">Mobile station</span>
                                                    <span class="radio-circle"></span>
                                                </li>
                                                <li>
                                                    <span class="option-text">Garden / Shed</span>
                                                    <span class="radio-circle"></span>
                                                </li>
                                                <li>
                                                    <span class="option-text">Others</span>
                                                    <span class="radio-circle"></span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="sort-by">
                                    Sort
                                    &nbsp;
                                    <svg xmlns="http://www.w3.org/2000/svg" width="13" height="7" viewBox="0 0 13 7"
                                        fill="none">
                                        <path d="M11.9103 0.5L6.15684 6.25344L0.499989 0.596581" stroke="#FBAC83"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <div class="sort-by-filter">
                                        <div class="sort dropdown">
                                            <ul>
                                                <li class="active">
                                                    <span class="option-text">Recommended (default)</span>
                                                    <span class="radio-circle"></span>
                                                </li>
                                                <li>
                                                    <span class="option-text">Distance</span>
                                                    <span class="radio-circle"></span>
                                                </li>
                                                <li>
                                                    <span class="option-text">Lowest price</span>
                                                    <span class="radio-circle"></span>
                                                </li>
                                                <li>
                                                    <span class="option-text">Soonest available</span>
                                                    <span class="radio-circle"></span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>


                    <div data-tab-content="space-calendar-view" class="tabcontent">
                        <section class="section-gap">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="scroll-calendar">
                                            <div class="calendar-header">
                                                <div class="nav">
                                                    <button class="prev">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="8" height="15"
                                                            viewBox="0 0 8 15" fill="none">
                                                            <path d="M7.24344 13.8737L0.499997 7.13025L7.13024 0.500006"
                                                                stroke="#3B3731" stroke-linecap="round"
                                                                stroke-linejoin="round" />
                                                        </svg>
                                                    </button>
                                                    <span class="range" id="range"></span>
                                                    <button class="next">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="8" height="15"
                                                            viewBox="0 0 8 15" fill="none">
                                                            <path d="M0.5 13.8737L7.24344 7.13025L0.613202 0.500006"
                                                                stroke="#3B3731" stroke-linecap="round"
                                                                stroke-linejoin="round" />
                                                        </svg>
                                                    </button>
                                                </div>
                                                <div class="month"></div>
                                            </div>

                                            <div class="week"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>

                        <div class="container">
                            <hr style="border-top: 1px solid #DFDFDF;">
                        </div>

                        <section class="section">
                            <div class="container">
                                <div class="row g-3">
                                    <div class="col-lg-3">
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
                                                            stroke="white" stroke-linecap="round"
                                                            stroke-linejoin="round" />
                                                        <path
                                                            d="M6.83331 13.4703C6.83331 13.4703 8.2222 13.7392 9.61109 12.667L6.83331 13.4703Z"
                                                            fill="#CBDCE8" />
                                                        <path
                                                            d="M6.83331 13.4703C6.83331 13.4703 8.2222 13.7392 9.61109 12.667"
                                                            stroke="white" stroke-linecap="round"
                                                            stroke-linejoin="round" />
                                                        <path
                                                            d="M9.05558 8.36144C9.05558 8.54561 8.98241 8.72225 8.85218 8.85248C8.72194 8.98272 8.54531 9.05588 8.36113 9.05588C8.17695 9.05588 8.00032 8.98272 7.87009 8.85248C7.73985 8.72225 7.66669 8.54561 7.66669 8.36144C7.66669 8.17726 7.73985 8.00062 7.87009 7.87039C8.00032 7.74016 8.17695 7.66699 8.36113 7.66699C8.54531 7.66699 8.72194 7.74016 8.85218 7.87039C8.98241 8.00062 9.05558 8.17726 9.05558 8.36144Z"
                                                            fill="#CBDCE8" stroke="white" />
                                                        <path d="M10.4445 6.55554V6.6111V6.55554Z" fill="#CBDCE8" />
                                                        <path d="M10.4445 6.55554V6.6111" stroke="white"
                                                            stroke-linecap="round" stroke-linejoin="round" />
                                                    </svg>
                                                </div>
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 255 130"
                                                    fill="none">
                                                    <defs>
                                                        <pattern id="pattern-card-1" patternUnits="userSpaceOnUse"
                                                            width="255" height="130">
                                                            <image href="assets/images/space_card1.png" width="255"
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
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="10"
                                                                height="9" viewBox="0 0 10 9" fill="none">
                                                                <path
                                                                    d="M2 8.99999C1.85833 8.99999 1.73967 8.95199 1.644 8.85599C1.54833 8.75999 1.50033 8.64133 1.5 8.49999C1.49967 8.35866 1.54767 8.23999 1.644 8.14399C1.74033 8.04799 1.859 7.99999 2 7.99999H8C8.14166 7.99999 8.2605 8.04799 8.3565 8.14399C8.4525 8.23999 8.50033 8.35866 8.5 8.49999C8.49966 8.64133 8.45166 8.76016 8.356 8.85649C8.26033 8.95283 8.14166 9.00066 8 8.99999H2ZM2.35 7.24999C2.10833 7.24999 1.89383 7.17083 1.7065 7.0125C1.51917 6.85416 1.4045 6.65416 1.3625 6.4125L0.862501 3.2375C0.845834 3.2375 0.827167 3.23967 0.806501 3.244C0.785834 3.24833 0.767001 3.25033 0.750001 3.25C0.541667 3.25 0.364668 3.17717 0.219001 3.0315C0.0733344 2.88583 0.000334469 2.70867 1.13636e-06 2.5C-0.000332197 2.29133 0.0726677 2.11433 0.219001 1.969C0.365334 1.82367 0.542334 1.75067 0.750001 1.75C0.957667 1.74933 1.13483 1.82233 1.2815 1.969C1.42817 2.11567 1.501 2.29267 1.5 2.5C1.5 2.55833 1.49367 2.6125 1.481 2.6625C1.46833 2.7125 1.45383 2.75833 1.4375 2.8L3 3.5L4.5625 1.3625C4.47083 1.29583 4.39583 1.20833 4.3375 1.1C4.27917 0.991667 4.25 0.875 4.25 0.75C4.25 0.541667 4.323 0.364501 4.469 0.218501C4.615 0.0725011 4.792 -0.000332194 5 1.13895e-06C5.208 0.000334472 5.38516 0.0733344 5.5315 0.219001C5.67783 0.364667 5.75066 0.541667 5.75 0.75C5.75 0.875 5.72083 0.991667 5.6625 1.1C5.60416 1.20833 5.52916 1.29583 5.4375 1.3625L7 3.5L8.5625 2.8C8.54583 2.75833 8.53116 2.7125 8.5185 2.6625C8.50583 2.6125 8.49966 2.55833 8.5 2.5C8.5 2.29167 8.573 2.1145 8.719 1.9685C8.865 1.8225 9.042 1.74967 9.25 1.75C9.458 1.75033 9.63516 1.82333 9.7815 1.969C9.92783 2.11467 10.0007 2.29167 10 2.5C9.99933 2.70833 9.92649 2.8855 9.7815 3.0315C9.6365 3.1775 9.45933 3.25033 9.25 3.25C9.23333 3.25 9.21466 3.248 9.194 3.244C9.17333 3.24 9.1545 3.23783 9.1375 3.2375L8.6375 6.4125C8.59583 6.65416 8.48133 6.85416 8.294 7.0125C8.10666 7.17083 7.892 7.24999 7.65 7.24999H2.35ZM2.35 6.25H7.65L7.975 4.1625L7.4 4.4125C7.18333 4.50416 6.9625 4.52083 6.7375 4.4625C6.5125 4.40416 6.32916 4.27916 6.1875 4.0875L5 2.45L3.8125 4.0875C3.67083 4.27916 3.4875 4.40416 3.2625 4.4625C3.0375 4.52083 2.81667 4.50416 2.6 4.4125L2.025 4.1625L2.35 6.25Z"
                                                                    fill="white" />
                                                            </svg>
                                                        </button>
                                                        <button class="second-icon" title="Favourite">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="9"
                                                                height="11" viewBox="0 0 9 11" fill="none">
                                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                                    d="M3.79701 0.30821C3.81025 0.23997 3.84191 0.176658 3.88858 0.125138C3.93524 0.0736173 3.99512 0.0358558 4.06172 0.0159479C4.12832 -0.00396001 4.1991 -0.00525449 4.26638 0.0122049C4.33367 0.0296642 4.39489 0.0652111 4.4434 0.114991C4.56671 0.240837 4.80378 0.489988 5.04467 0.777274C5.28111 1.05884 5.53916 1.39761 5.68788 1.69951C5.8328 1.99443 5.98661 2.37578 6.10801 2.69421L6.67305 1.75354C6.70456 1.701 6.74826 1.65683 6.80046 1.62476C6.85265 1.59269 6.91181 1.57367 6.97292 1.56931C7.03402 1.56494 7.09528 1.57536 7.1515 1.59969C7.20773 1.62401 7.25727 1.66152 7.29592 1.70905C8.09867 2.70057 8.49846 3.76263 8.6974 4.57365C8.79718 4.97979 8.8474 5.32491 8.87282 5.57025C8.88576 5.69278 8.89424 5.81574 8.89824 5.93889V5.97131C8.89824 8.4482 6.93364 10.4649 4.44785 10.4649C1.96206 10.4649 0 8.44756 0 5.97004C0 5.28805 0.322244 3.68192 1.27563 2.36498C1.31266 2.31422 1.36166 2.27341 1.41826 2.24615C1.47487 2.2189 1.53734 2.20605 1.60011 2.20876C1.66287 2.21146 1.724 2.22963 1.77806 2.26166C1.83211 2.29368 1.87741 2.33856 1.90994 2.39231L2.55507 3.46709C2.75083 3.16073 3.01269 2.73044 3.21163 2.3332C3.49765 1.76117 3.72455 0.682572 3.79701 0.308845M4.3201 0.912655C4.20506 1.42113 4.01501 2.14697 3.77985 2.61858C3.46714 3.24336 3.0165 3.9298 2.86142 4.16051C2.82554 4.21345 2.77693 4.25651 2.72005 4.28574C2.66317 4.31497 2.59986 4.32943 2.53593 4.32778C2.472 4.32614 2.40952 4.30844 2.35422 4.27632C2.29892 4.24421 2.25258 4.1987 2.21948 4.14399L1.57118 3.06476C0.87457 4.19166 0.635589 5.45839 0.635589 5.97131C0.635589 8.10561 2.32244 9.82806 4.44785 9.82806C6.57326 9.82806 8.26265 8.10561 8.26265 5.97131V5.95351L8.26011 5.88995C8.25568 5.80484 8.24911 5.71986 8.24041 5.63508C8.20712 5.3287 8.15362 5.02487 8.08024 4.72555C7.87826 3.89157 7.52027 3.10334 7.02516 2.40248L6.38068 3.47535C6.34338 3.53732 6.28925 3.58743 6.22459 3.61985C6.15993 3.65227 6.08739 3.66566 6.01542 3.65847C5.94344 3.65128 5.87499 3.6238 5.81802 3.57923C5.76105 3.53466 5.71791 3.47483 5.6936 3.40671C5.59064 3.11815 5.33831 2.42917 5.11713 1.98044C5.00463 1.751 4.78916 1.46117 4.55781 1.18596C4.4801 1.09353 4.40086 1.00242 4.3201 0.912655Z"
                                                                    fill="#FEFEFE" />
                                                            </svg>
                                                        </button>
                                                        <button class="third-icon" title="lock">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="8"
                                                                height="10" viewBox="0 0 8 10" fill="none">
                                                                <path
                                                                    d="M4 7.61905C3.73478 7.61905 3.48043 7.51871 3.29289 7.3401C3.10536 7.1615 3 6.91925 3 6.66667C3 6.1381 3.445 5.71429 4 5.71429C4.26522 5.71429 4.51957 5.81463 4.70711 5.99323C4.89464 6.17184 5 6.41408 5 6.66667C5 6.91925 4.89464 7.1615 4.70711 7.3401C4.51957 7.51871 4.26522 7.61905 4 7.61905ZM7 9.04762V4.28571H1V9.04762H7ZM7 3.33333C7.26522 3.33333 7.51957 3.43367 7.70711 3.61228C7.89464 3.79089 8 4.03313 8 4.28571V9.04762C8 9.30021 7.89464 9.54245 7.70711 9.72105C7.51957 9.89966 7.26522 10 7 10H1C0.734784 10 0.48043 9.89966 0.292893 9.72105C0.105357 9.54245 0 9.30021 0 9.04762V4.28571C0 3.75714 0.445 3.33333 1 3.33333H1.5V2.38095C1.5 1.74948 1.76339 1.14388 2.23223 0.697365C2.70107 0.25085 3.33696 0 4 0C4.3283 0 4.65339 0.0615852 4.95671 0.181239C5.26002 0.300893 5.53562 0.476273 5.76777 0.697365C5.99991 0.918457 6.18406 1.18093 6.3097 1.4698C6.43534 1.75867 6.5 2.06828 6.5 2.38095V3.33333H7ZM4 0.952381C3.60218 0.952381 3.22064 1.10289 2.93934 1.3708C2.65804 1.63871 2.5 2.00207 2.5 2.38095V3.33333H5.5V2.38095C5.5 2.00207 5.34196 1.63871 5.06066 1.3708C4.77936 1.10289 4.39782 0.952381 4 0.952381Z"
                                                                    fill="white" />
                                                            </svg>
                                                        </button>
                                                    </div>
                                                </div>

                                                <h2 class="name">Furs & Co. Studio</h2>
                                                <p class="hosted-by">Hosted by <span>Dev É.</span></p>

                                                <div
                                                    class="studio-details mt-1 d-flex flex-column justify-content-between mt-2">

                                                    <div class="meta d-flex align-items-center justify-content-between">
                                                        <div class="distance" title="Distance">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="10"
                                                                height="14" viewBox="0 0 10 14" fill="none">
                                                                <path
                                                                    d="M5 6.65C4.5264 6.65 4.0722 6.46563 3.73731 6.13744C3.40242 5.80925 3.21429 5.36413 3.21429 4.9C3.21429 4.43587 3.40242 3.99075 3.73731 3.66256C4.0722 3.33437 4.5264 3.15 5 3.15C5.4736 3.15 5.9278 3.33437 6.26269 3.66256C6.59758 3.99075 6.78571 4.43587 6.78571 4.9C6.78571 5.12981 6.73953 5.35738 6.64979 5.5697C6.56004 5.78202 6.42851 5.97493 6.26269 6.13744C6.09687 6.29994 5.90002 6.42884 5.68336 6.51679C5.46671 6.60473 5.2345 6.65 5 6.65ZM5 0C3.67392 0 2.40215 0.516248 1.46447 1.43518C0.526784 2.3541 0 3.60044 0 4.9C0 8.575 5 14 5 14C5 14 10 8.575 10 4.9C10 3.60044 9.47322 2.3541 8.53553 1.43518C7.59785 0.516248 6.32608 0 5 0Z"
                                                                    fill="var(--active-bg)" />
                                                            </svg>
                                                            <span>2.5 mi</span>
                                                        </div>


                                                        <div class="rating" title="Rating">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="14"
                                                                height="14" viewBox="0 0 14 14" fill="none">
                                                                <path
                                                                    d="M6.12956 0.660476C6.40354 -0.220161 7.59647 -0.220158 7.87045 0.660479L8.89548 3.95519C9.01801 4.34902 9.36942 4.61566 9.76593 4.61566H13.083C13.9696 4.61566 14.3383 5.80055 13.621 6.34481L10.9374 8.38106C10.6166 8.62446 10.4824 9.0559 10.6049 9.44973L11.63 12.7444C11.9039 13.6251 10.9388 14.3574 10.2215 13.8131L7.53797 11.7769C7.21719 11.5335 6.78282 11.5335 6.46204 11.7769L3.77846 13.8131C3.06117 14.3574 2.09607 13.6251 2.37005 12.7444L3.39508 9.44973C3.51761 9.0559 3.38338 8.62446 3.0626 8.38106L0.37903 6.34481C-0.338258 5.80055 0.0303816 4.61566 0.916998 4.61566H4.23408C4.63058 4.61566 4.98199 4.34902 5.10452 3.95519L6.12956 0.660476Z"
                                                                    fill="var(--active-bg)" />
                                                            </svg>
                                                            <span>4.3 <small
                                                                    style="color:var(--muted)">(20)</small></span>
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
                                    <div class="col-lg-3">
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
                                                            stroke="white" stroke-linecap="round"
                                                            stroke-linejoin="round" />
                                                        <path
                                                            d="M6.83331 13.4703C6.83331 13.4703 8.2222 13.7392 9.61109 12.667L6.83331 13.4703Z"
                                                            fill="#CBDCE8" />
                                                        <path
                                                            d="M6.83331 13.4703C6.83331 13.4703 8.2222 13.7392 9.61109 12.667"
                                                            stroke="white" stroke-linecap="round"
                                                            stroke-linejoin="round" />
                                                        <path
                                                            d="M9.05558 8.36144C9.05558 8.54561 8.98241 8.72225 8.85218 8.85248C8.72194 8.98272 8.54531 9.05588 8.36113 9.05588C8.17695 9.05588 8.00032 8.98272 7.87009 8.85248C7.73985 8.72225 7.66669 8.54561 7.66669 8.36144C7.66669 8.17726 7.73985 8.00062 7.87009 7.87039C8.00032 7.74016 8.17695 7.66699 8.36113 7.66699C8.54531 7.66699 8.72194 7.74016 8.85218 7.87039C8.98241 8.00062 9.05558 8.17726 9.05558 8.36144Z"
                                                            fill="#CBDCE8" stroke="white" />
                                                        <path d="M10.4445 6.55554V6.6111V6.55554Z" fill="#CBDCE8" />
                                                        <path d="M10.4445 6.55554V6.6111" stroke="white"
                                                            stroke-linecap="round" stroke-linejoin="round" />
                                                    </svg>
                                                </div>
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 255 130"
                                                    fill="none">
                                                    <defs>
                                                        <pattern id="pattern-card-2" patternUnits="userSpaceOnUse"
                                                            width="255" height="130">
                                                            <image href="assets/images/space_card2.png" width="255"
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
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="10"
                                                                height="9" viewBox="0 0 10 9" fill="none">
                                                                <path
                                                                    d="M2 8.99999C1.85833 8.99999 1.73967 8.95199 1.644 8.85599C1.54833 8.75999 1.50033 8.64133 1.5 8.49999C1.49967 8.35866 1.54767 8.23999 1.644 8.14399C1.74033 8.04799 1.859 7.99999 2 7.99999H8C8.14166 7.99999 8.2605 8.04799 8.3565 8.14399C8.4525 8.23999 8.50033 8.35866 8.5 8.49999C8.49966 8.64133 8.45166 8.76016 8.356 8.85649C8.26033 8.95283 8.14166 9.00066 8 8.99999H2ZM2.35 7.24999C2.10833 7.24999 1.89383 7.17083 1.7065 7.0125C1.51917 6.85416 1.4045 6.65416 1.3625 6.4125L0.862501 3.2375C0.845834 3.2375 0.827167 3.23967 0.806501 3.244C0.785834 3.24833 0.767001 3.25033 0.750001 3.25C0.541667 3.25 0.364668 3.17717 0.219001 3.0315C0.0733344 2.88583 0.000334469 2.70867 1.13636e-06 2.5C-0.000332197 2.29133 0.0726677 2.11433 0.219001 1.969C0.365334 1.82367 0.542334 1.75067 0.750001 1.75C0.957667 1.74933 1.13483 1.82233 1.2815 1.969C1.42817 2.11567 1.501 2.29267 1.5 2.5C1.5 2.55833 1.49367 2.6125 1.481 2.6625C1.46833 2.7125 1.45383 2.75833 1.4375 2.8L3 3.5L4.5625 1.3625C4.47083 1.29583 4.39583 1.20833 4.3375 1.1C4.27917 0.991667 4.25 0.875 4.25 0.75C4.25 0.541667 4.323 0.364501 4.469 0.218501C4.615 0.0725011 4.792 -0.000332194 5 1.13895e-06C5.208 0.000334472 5.38516 0.0733344 5.5315 0.219001C5.67783 0.364667 5.75066 0.541667 5.75 0.75C5.75 0.875 5.72083 0.991667 5.6625 1.1C5.60416 1.20833 5.52916 1.29583 5.4375 1.3625L7 3.5L8.5625 2.8C8.54583 2.75833 8.53116 2.7125 8.5185 2.6625C8.50583 2.6125 8.49966 2.55833 8.5 2.5C8.5 2.29167 8.573 2.1145 8.719 1.9685C8.865 1.8225 9.042 1.74967 9.25 1.75C9.458 1.75033 9.63516 1.82333 9.7815 1.969C9.92783 2.11467 10.0007 2.29167 10 2.5C9.99933 2.70833 9.92649 2.8855 9.7815 3.0315C9.6365 3.1775 9.45933 3.25033 9.25 3.25C9.23333 3.25 9.21466 3.248 9.194 3.244C9.17333 3.24 9.1545 3.23783 9.1375 3.2375L8.6375 6.4125C8.59583 6.65416 8.48133 6.85416 8.294 7.0125C8.10666 7.17083 7.892 7.24999 7.65 7.24999H2.35ZM2.35 6.25H7.65L7.975 4.1625L7.4 4.4125C7.18333 4.50416 6.9625 4.52083 6.7375 4.4625C6.5125 4.40416 6.32916 4.27916 6.1875 4.0875L5 2.45L3.8125 4.0875C3.67083 4.27916 3.4875 4.40416 3.2625 4.4625C3.0375 4.52083 2.81667 4.50416 2.6 4.4125L2.025 4.1625L2.35 6.25Z"
                                                                    fill="white" />
                                                            </svg>
                                                        </button>
                                                        <button class="second-icon" title="Favourite">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="9"
                                                                height="11" viewBox="0 0 9 11" fill="none">
                                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                                    d="M3.79701 0.30821C3.81025 0.23997 3.84191 0.176658 3.88858 0.125138C3.93524 0.0736173 3.99512 0.0358558 4.06172 0.0159479C4.12832 -0.00396001 4.1991 -0.00525449 4.26638 0.0122049C4.33367 0.0296642 4.39489 0.0652111 4.4434 0.114991C4.56671 0.240837 4.80378 0.489988 5.04467 0.777274C5.28111 1.05884 5.53916 1.39761 5.68788 1.69951C5.8328 1.99443 5.98661 2.37578 6.10801 2.69421L6.67305 1.75354C6.70456 1.701 6.74826 1.65683 6.80046 1.62476C6.85265 1.59269 6.91181 1.57367 6.97292 1.56931C7.03402 1.56494 7.09528 1.57536 7.1515 1.59969C7.20773 1.62401 7.25727 1.66152 7.29592 1.70905C8.09867 2.70057 8.49846 3.76263 8.6974 4.57365C8.79718 4.97979 8.8474 5.32491 8.87282 5.57025C8.88576 5.69278 8.89424 5.81574 8.89824 5.93889V5.97131C8.89824 8.4482 6.93364 10.4649 4.44785 10.4649C1.96206 10.4649 0 8.44756 0 5.97004C0 5.28805 0.322244 3.68192 1.27563 2.36498C1.31266 2.31422 1.36166 2.27341 1.41826 2.24615C1.47487 2.2189 1.53734 2.20605 1.60011 2.20876C1.66287 2.21146 1.724 2.22963 1.77806 2.26166C1.83211 2.29368 1.87741 2.33856 1.90994 2.39231L2.55507 3.46709C2.75083 3.16073 3.01269 2.73044 3.21163 2.3332C3.49765 1.76117 3.72455 0.682572 3.79701 0.308845M4.3201 0.912655C4.20506 1.42113 4.01501 2.14697 3.77985 2.61858C3.46714 3.24336 3.0165 3.9298 2.86142 4.16051C2.82554 4.21345 2.77693 4.25651 2.72005 4.28574C2.66317 4.31497 2.59986 4.32943 2.53593 4.32778C2.472 4.32614 2.40952 4.30844 2.35422 4.27632C2.29892 4.24421 2.25258 4.1987 2.21948 4.14399L1.57118 3.06476C0.87457 4.19166 0.635589 5.45839 0.635589 5.97131C0.635589 8.10561 2.32244 9.82806 4.44785 9.82806C6.57326 9.82806 8.26265 8.10561 8.26265 5.97131V5.95351L8.26011 5.88995C8.25568 5.80484 8.24911 5.71986 8.24041 5.63508C8.20712 5.3287 8.15362 5.02487 8.08024 4.72555C7.87826 3.89157 7.52027 3.10334 7.02516 2.40248L6.38068 3.47535C6.34338 3.53732 6.28925 3.58743 6.22459 3.61985C6.15993 3.65227 6.08739 3.66566 6.01542 3.65847C5.94344 3.65128 5.87499 3.6238 5.81802 3.57923C5.76105 3.53466 5.71791 3.47483 5.6936 3.40671C5.59064 3.11815 5.33831 2.42917 5.11713 1.98044C5.00463 1.751 4.78916 1.46117 4.55781 1.18596C4.4801 1.09353 4.40086 1.00242 4.3201 0.912655Z"
                                                                    fill="#FEFEFE" />
                                                            </svg>
                                                        </button>
                                                        <button class="third-icon" title="lock">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="8"
                                                                height="10" viewBox="0 0 8 10" fill="none">
                                                                <path
                                                                    d="M4 7.61905C3.73478 7.61905 3.48043 7.51871 3.29289 7.3401C3.10536 7.1615 3 6.91925 3 6.66667C3 6.1381 3.445 5.71429 4 5.71429C4.26522 5.71429 4.51957 5.81463 4.70711 5.99323C4.89464 6.17184 5 6.41408 5 6.66667C5 6.91925 4.89464 7.1615 4.70711 7.3401C4.51957 7.51871 4.26522 7.61905 4 7.61905ZM7 9.04762V4.28571H1V9.04762H7ZM7 3.33333C7.26522 3.33333 7.51957 3.43367 7.70711 3.61228C7.89464 3.79089 8 4.03313 8 4.28571V9.04762C8 9.30021 7.89464 9.54245 7.70711 9.72105C7.51957 9.89966 7.26522 10 7 10H1C0.734784 10 0.48043 9.89966 0.292893 9.72105C0.105357 9.54245 0 9.30021 0 9.04762V4.28571C0 3.75714 0.445 3.33333 1 3.33333H1.5V2.38095C1.5 1.74948 1.76339 1.14388 2.23223 0.697365C2.70107 0.25085 3.33696 0 4 0C4.3283 0 4.65339 0.0615852 4.95671 0.181239C5.26002 0.300893 5.53562 0.476273 5.76777 0.697365C5.99991 0.918457 6.18406 1.18093 6.3097 1.4698C6.43534 1.75867 6.5 2.06828 6.5 2.38095V3.33333H7ZM4 0.952381C3.60218 0.952381 3.22064 1.10289 2.93934 1.3708C2.65804 1.63871 2.5 2.00207 2.5 2.38095V3.33333H5.5V2.38095C5.5 2.00207 5.34196 1.63871 5.06066 1.3708C4.77936 1.10289 4.39782 0.952381 4 0.952381Z"
                                                                    fill="white" />
                                                            </svg>
                                                        </button>
                                                    </div>
                                                </div>

                                                <h2 class="name">Paws & Bubbles</h2>
                                                <p class="hosted-by">Hosted by <span>Dev É.</span></p>

                                                <div
                                                    class="studio-details mt-1 d-flex flex-column justify-content-between mt-2">

                                                    <div class="meta d-flex align-items-center justify-content-between">
                                                        <div class="distance" title="Distance">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="10"
                                                                height="14" viewBox="0 0 10 14" fill="none">
                                                                <path
                                                                    d="M5 6.65C4.5264 6.65 4.0722 6.46563 3.73731 6.13744C3.40242 5.80925 3.21429 5.36413 3.21429 4.9C3.21429 4.43587 3.40242 3.99075 3.73731 3.66256C4.0722 3.33437 4.5264 3.15 5 3.15C5.4736 3.15 5.9278 3.33437 6.26269 3.66256C6.59758 3.99075 6.78571 4.43587 6.78571 4.9C6.78571 5.12981 6.73953 5.35738 6.64979 5.5697C6.56004 5.78202 6.42851 5.97493 6.26269 6.13744C6.09687 6.29994 5.90002 6.42884 5.68336 6.51679C5.46671 6.60473 5.2345 6.65 5 6.65ZM5 0C3.67392 0 2.40215 0.516248 1.46447 1.43518C0.526784 2.3541 0 3.60044 0 4.9C0 8.575 5 14 5 14C5 14 10 8.575 10 4.9C10 3.60044 9.47322 2.3541 8.53553 1.43518C7.59785 0.516248 6.32608 0 5 0Z"
                                                                    fill="var(--active-bg)" />
                                                            </svg>
                                                            <span>2.5 mi</span>
                                                        </div>


                                                        <div class="rating" title="Rating">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="14"
                                                                height="14" viewBox="0 0 14 14" fill="none">
                                                                <path
                                                                    d="M6.12956 0.660476C6.40354 -0.220161 7.59647 -0.220158 7.87045 0.660479L8.89548 3.95519C9.01801 4.34902 9.36942 4.61566 9.76593 4.61566H13.083C13.9696 4.61566 14.3383 5.80055 13.621 6.34481L10.9374 8.38106C10.6166 8.62446 10.4824 9.0559 10.6049 9.44973L11.63 12.7444C11.9039 13.6251 10.9388 14.3574 10.2215 13.8131L7.53797 11.7769C7.21719 11.5335 6.78282 11.5335 6.46204 11.7769L3.77846 13.8131C3.06117 14.3574 2.09607 13.6251 2.37005 12.7444L3.39508 9.44973C3.51761 9.0559 3.38338 8.62446 3.0626 8.38106L0.37903 6.34481C-0.338258 5.80055 0.0303816 4.61566 0.916998 4.61566H4.23408C4.63058 4.61566 4.98199 4.34902 5.10452 3.95519L6.12956 0.660476Z"
                                                                    fill="var(--active-bg)" />
                                                            </svg>
                                                            <span>4.3 <small
                                                                    style="color:var(--muted)">(20)</small></span>
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
                                    <div class="col-lg-3">
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
                                                            stroke="white" stroke-linecap="round"
                                                            stroke-linejoin="round" />
                                                        <path
                                                            d="M6.83331 13.4703C6.83331 13.4703 8.2222 13.7392 9.61109 12.667L6.83331 13.4703Z"
                                                            fill="#CBDCE8" />
                                                        <path
                                                            d="M6.83331 13.4703C6.83331 13.4703 8.2222 13.7392 9.61109 12.667"
                                                            stroke="white" stroke-linecap="round"
                                                            stroke-linejoin="round" />
                                                        <path
                                                            d="M9.05558 8.36144C9.05558 8.54561 8.98241 8.72225 8.85218 8.85248C8.72194 8.98272 8.54531 9.05588 8.36113 9.05588C8.17695 9.05588 8.00032 8.98272 7.87009 8.85248C7.73985 8.72225 7.66669 8.54561 7.66669 8.36144C7.66669 8.17726 7.73985 8.00062 7.87009 7.87039C8.00032 7.74016 8.17695 7.66699 8.36113 7.66699C8.54531 7.66699 8.72194 7.74016 8.85218 7.87039C8.98241 8.00062 9.05558 8.17726 9.05558 8.36144Z"
                                                            fill="#CBDCE8" stroke="white" />
                                                        <path d="M10.4445 6.55554V6.6111V6.55554Z" fill="#CBDCE8" />
                                                        <path d="M10.4445 6.55554V6.6111" stroke="white"
                                                            stroke-linecap="round" stroke-linejoin="round" />
                                                    </svg>
                                                </div>
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 255 130"
                                                    fill="none">
                                                    <defs>
                                                        <pattern id="pattern-card-3" patternUnits="userSpaceOnUse"
                                                            width="255" height="130">
                                                            <image href="assets/images/space_card3.png" width="255"
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
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="10"
                                                                height="9" viewBox="0 0 10 9" fill="none">
                                                                <path
                                                                    d="M2 8.99999C1.85833 8.99999 1.73967 8.95199 1.644 8.85599C1.54833 8.75999 1.50033 8.64133 1.5 8.49999C1.49967 8.35866 1.54767 8.23999 1.644 8.14399C1.74033 8.04799 1.859 7.99999 2 7.99999H8C8.14166 7.99999 8.2605 8.04799 8.3565 8.14399C8.4525 8.23999 8.50033 8.35866 8.5 8.49999C8.49966 8.64133 8.45166 8.76016 8.356 8.85649C8.26033 8.95283 8.14166 9.00066 8 8.99999H2ZM2.35 7.24999C2.10833 7.24999 1.89383 7.17083 1.7065 7.0125C1.51917 6.85416 1.4045 6.65416 1.3625 6.4125L0.862501 3.2375C0.845834 3.2375 0.827167 3.23967 0.806501 3.244C0.785834 3.24833 0.767001 3.25033 0.750001 3.25C0.541667 3.25 0.364668 3.17717 0.219001 3.0315C0.0733344 2.88583 0.000334469 2.70867 1.13636e-06 2.5C-0.000332197 2.29133 0.0726677 2.11433 0.219001 1.969C0.365334 1.82367 0.542334 1.75067 0.750001 1.75C0.957667 1.74933 1.13483 1.82233 1.2815 1.969C1.42817 2.11567 1.501 2.29267 1.5 2.5C1.5 2.55833 1.49367 2.6125 1.481 2.6625C1.46833 2.7125 1.45383 2.75833 1.4375 2.8L3 3.5L4.5625 1.3625C4.47083 1.29583 4.39583 1.20833 4.3375 1.1C4.27917 0.991667 4.25 0.875 4.25 0.75C4.25 0.541667 4.323 0.364501 4.469 0.218501C4.615 0.0725011 4.792 -0.000332194 5 1.13895e-06C5.208 0.000334472 5.38516 0.0733344 5.5315 0.219001C5.67783 0.364667 5.75066 0.541667 5.75 0.75C5.75 0.875 5.72083 0.991667 5.6625 1.1C5.60416 1.20833 5.52916 1.29583 5.4375 1.3625L7 3.5L8.5625 2.8C8.54583 2.75833 8.53116 2.7125 8.5185 2.6625C8.50583 2.6125 8.49966 2.55833 8.5 2.5C8.5 2.29167 8.573 2.1145 8.719 1.9685C8.865 1.8225 9.042 1.74967 9.25 1.75C9.458 1.75033 9.63516 1.82333 9.7815 1.969C9.92783 2.11467 10.0007 2.29167 10 2.5C9.99933 2.70833 9.92649 2.8855 9.7815 3.0315C9.6365 3.1775 9.45933 3.25033 9.25 3.25C9.23333 3.25 9.21466 3.248 9.194 3.244C9.17333 3.24 9.1545 3.23783 9.1375 3.2375L8.6375 6.4125C8.59583 6.65416 8.48133 6.85416 8.294 7.0125C8.10666 7.17083 7.892 7.24999 7.65 7.24999H2.35ZM2.35 6.25H7.65L7.975 4.1625L7.4 4.4125C7.18333 4.50416 6.9625 4.52083 6.7375 4.4625C6.5125 4.40416 6.32916 4.27916 6.1875 4.0875L5 2.45L3.8125 4.0875C3.67083 4.27916 3.4875 4.40416 3.2625 4.4625C3.0375 4.52083 2.81667 4.50416 2.6 4.4125L2.025 4.1625L2.35 6.25Z"
                                                                    fill="white" />
                                                            </svg>
                                                        </button>
                                                        <button class="second-icon" title="Favourite">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="9"
                                                                height="11" viewBox="0 0 9 11" fill="none">
                                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                                    d="M3.79701 0.30821C3.81025 0.23997 3.84191 0.176658 3.88858 0.125138C3.93524 0.0736173 3.99512 0.0358558 4.06172 0.0159479C4.12832 -0.00396001 4.1991 -0.00525449 4.26638 0.0122049C4.33367 0.0296642 4.39489 0.0652111 4.4434 0.114991C4.56671 0.240837 4.80378 0.489988 5.04467 0.777274C5.28111 1.05884 5.53916 1.39761 5.68788 1.69951C5.8328 1.99443 5.98661 2.37578 6.10801 2.69421L6.67305 1.75354C6.70456 1.701 6.74826 1.65683 6.80046 1.62476C6.85265 1.59269 6.91181 1.57367 6.97292 1.56931C7.03402 1.56494 7.09528 1.57536 7.1515 1.59969C7.20773 1.62401 7.25727 1.66152 7.29592 1.70905C8.09867 2.70057 8.49846 3.76263 8.6974 4.57365C8.79718 4.97979 8.8474 5.32491 8.87282 5.57025C8.88576 5.69278 8.89424 5.81574 8.89824 5.93889V5.97131C8.89824 8.4482 6.93364 10.4649 4.44785 10.4649C1.96206 10.4649 0 8.44756 0 5.97004C0 5.28805 0.322244 3.68192 1.27563 2.36498C1.31266 2.31422 1.36166 2.27341 1.41826 2.24615C1.47487 2.2189 1.53734 2.20605 1.60011 2.20876C1.66287 2.21146 1.724 2.22963 1.77806 2.26166C1.83211 2.29368 1.87741 2.33856 1.90994 2.39231L2.55507 3.46709C2.75083 3.16073 3.01269 2.73044 3.21163 2.3332C3.49765 1.76117 3.72455 0.682572 3.79701 0.308845M4.3201 0.912655C4.20506 1.42113 4.01501 2.14697 3.77985 2.61858C3.46714 3.24336 3.0165 3.9298 2.86142 4.16051C2.82554 4.21345 2.77693 4.25651 2.72005 4.28574C2.66317 4.31497 2.59986 4.32943 2.53593 4.32778C2.472 4.32614 2.40952 4.30844 2.35422 4.27632C2.29892 4.24421 2.25258 4.1987 2.21948 4.14399L1.57118 3.06476C0.87457 4.19166 0.635589 5.45839 0.635589 5.97131C0.635589 8.10561 2.32244 9.82806 4.44785 9.82806C6.57326 9.82806 8.26265 8.10561 8.26265 5.97131V5.95351L8.26011 5.88995C8.25568 5.80484 8.24911 5.71986 8.24041 5.63508C8.20712 5.3287 8.15362 5.02487 8.08024 4.72555C7.87826 3.89157 7.52027 3.10334 7.02516 2.40248L6.38068 3.47535C6.34338 3.53732 6.28925 3.58743 6.22459 3.61985C6.15993 3.65227 6.08739 3.66566 6.01542 3.65847C5.94344 3.65128 5.87499 3.6238 5.81802 3.57923C5.76105 3.53466 5.71791 3.47483 5.6936 3.40671C5.59064 3.11815 5.33831 2.42917 5.11713 1.98044C5.00463 1.751 4.78916 1.46117 4.55781 1.18596C4.4801 1.09353 4.40086 1.00242 4.3201 0.912655Z"
                                                                    fill="#FEFEFE" />
                                                            </svg>
                                                        </button>
                                                        <button class="third-icon" title="lock">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="8"
                                                                height="10" viewBox="0 0 8 10" fill="none">
                                                                <path
                                                                    d="M4 7.61905C3.73478 7.61905 3.48043 7.51871 3.29289 7.3401C3.10536 7.1615 3 6.91925 3 6.66667C3 6.1381 3.445 5.71429 4 5.71429C4.26522 5.71429 4.51957 5.81463 4.70711 5.99323C4.89464 6.17184 5 6.41408 5 6.66667C5 6.91925 4.89464 7.1615 4.70711 7.3401C4.51957 7.51871 4.26522 7.61905 4 7.61905ZM7 9.04762V4.28571H1V9.04762H7ZM7 3.33333C7.26522 3.33333 7.51957 3.43367 7.70711 3.61228C7.89464 3.79089 8 4.03313 8 4.28571V9.04762C8 9.30021 7.89464 9.54245 7.70711 9.72105C7.51957 9.89966 7.26522 10 7 10H1C0.734784 10 0.48043 9.89966 0.292893 9.72105C0.105357 9.54245 0 9.30021 0 9.04762V4.28571C0 3.75714 0.445 3.33333 1 3.33333H1.5V2.38095C1.5 1.74948 1.76339 1.14388 2.23223 0.697365C2.70107 0.25085 3.33696 0 4 0C4.3283 0 4.65339 0.0615852 4.95671 0.181239C5.26002 0.300893 5.53562 0.476273 5.76777 0.697365C5.99991 0.918457 6.18406 1.18093 6.3097 1.4698C6.43534 1.75867 6.5 2.06828 6.5 2.38095V3.33333H7ZM4 0.952381C3.60218 0.952381 3.22064 1.10289 2.93934 1.3708C2.65804 1.63871 2.5 2.00207 2.5 2.38095V3.33333H5.5V2.38095C5.5 2.00207 5.34196 1.63871 5.06066 1.3708C4.77936 1.10289 4.39782 0.952381 4 0.952381Z"
                                                                    fill="white" />
                                                            </svg>
                                                        </button>
                                                    </div>
                                                </div>

                                                <h2 class="name">The Garden Grooming Spot</h2>
                                                <p class="hosted-by">Hosted by <span>Dev É.</span></p>

                                                <div
                                                    class="studio-details mt-1 d-flex flex-column justify-content-between mt-2">

                                                    <div class="meta d-flex align-items-center justify-content-between">
                                                        <div class="distance" title="Distance">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="10"
                                                                height="14" viewBox="0 0 10 14" fill="none">
                                                                <path
                                                                    d="M5 6.65C4.5264 6.65 4.0722 6.46563 3.73731 6.13744C3.40242 5.80925 3.21429 5.36413 3.21429 4.9C3.21429 4.43587 3.40242 3.99075 3.73731 3.66256C4.0722 3.33437 4.5264 3.15 5 3.15C5.4736 3.15 5.9278 3.33437 6.26269 3.66256C6.59758 3.99075 6.78571 4.43587 6.78571 4.9C6.78571 5.12981 6.73953 5.35738 6.64979 5.5697C6.56004 5.78202 6.42851 5.97493 6.26269 6.13744C6.09687 6.29994 5.90002 6.42884 5.68336 6.51679C5.46671 6.60473 5.2345 6.65 5 6.65ZM5 0C3.67392 0 2.40215 0.516248 1.46447 1.43518C0.526784 2.3541 0 3.60044 0 4.9C0 8.575 5 14 5 14C5 14 10 8.575 10 4.9C10 3.60044 9.47322 2.3541 8.53553 1.43518C7.59785 0.516248 6.32608 0 5 0Z"
                                                                    fill="var(--active-bg)" />
                                                            </svg>
                                                            <span>2.5 mi</span>
                                                        </div>


                                                        <div class="rating" title="Rating">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="14"
                                                                height="14" viewBox="0 0 14 14" fill="none">
                                                                <path
                                                                    d="M6.12956 0.660476C6.40354 -0.220161 7.59647 -0.220158 7.87045 0.660479L8.89548 3.95519C9.01801 4.34902 9.36942 4.61566 9.76593 4.61566H13.083C13.9696 4.61566 14.3383 5.80055 13.621 6.34481L10.9374 8.38106C10.6166 8.62446 10.4824 9.0559 10.6049 9.44973L11.63 12.7444C11.9039 13.6251 10.9388 14.3574 10.2215 13.8131L7.53797 11.7769C7.21719 11.5335 6.78282 11.5335 6.46204 11.7769L3.77846 13.8131C3.06117 14.3574 2.09607 13.6251 2.37005 12.7444L3.39508 9.44973C3.51761 9.0559 3.38338 8.62446 3.0626 8.38106L0.37903 6.34481C-0.338258 5.80055 0.0303816 4.61566 0.916998 4.61566H4.23408C4.63058 4.61566 4.98199 4.34902 5.10452 3.95519L6.12956 0.660476Z"
                                                                    fill="var(--active-bg)" />
                                                            </svg>
                                                            <span>4.3 <small
                                                                    style="color:var(--muted)">(20)</small></span>
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
                                    <div class="col-lg-3">
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
                                                            stroke="white" stroke-linecap="round"
                                                            stroke-linejoin="round" />
                                                        <path
                                                            d="M6.83331 13.4703C6.83331 13.4703 8.2222 13.7392 9.61109 12.667L6.83331 13.4703Z"
                                                            fill="#CBDCE8" />
                                                        <path
                                                            d="M6.83331 13.4703C6.83331 13.4703 8.2222 13.7392 9.61109 12.667"
                                                            stroke="white" stroke-linecap="round"
                                                            stroke-linejoin="round" />
                                                        <path
                                                            d="M9.05558 8.36144C9.05558 8.54561 8.98241 8.72225 8.85218 8.85248C8.72194 8.98272 8.54531 9.05588 8.36113 9.05588C8.17695 9.05588 8.00032 8.98272 7.87009 8.85248C7.73985 8.72225 7.66669 8.54561 7.66669 8.36144C7.66669 8.17726 7.73985 8.00062 7.87009 7.87039C8.00032 7.74016 8.17695 7.66699 8.36113 7.66699C8.54531 7.66699 8.72194 7.74016 8.85218 7.87039C8.98241 8.00062 9.05558 8.17726 9.05558 8.36144Z"
                                                            fill="#CBDCE8" stroke="white" />
                                                        <path d="M10.4445 6.55554V6.6111V6.55554Z" fill="#CBDCE8" />
                                                        <path d="M10.4445 6.55554V6.6111" stroke="white"
                                                            stroke-linecap="round" stroke-linejoin="round" />
                                                    </svg>
                                                </div>
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 255 130"
                                                    fill="none">
                                                    <defs>
                                                        <pattern id="pattern-card-4" patternUnits="userSpaceOnUse"
                                                            width="255" height="130">
                                                            <image href="assets/images/space_card1.png" width="255"
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
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="10"
                                                                height="9" viewBox="0 0 10 9" fill="none">
                                                                <path
                                                                    d="M2 8.99999C1.85833 8.99999 1.73967 8.95199 1.644 8.85599C1.54833 8.75999 1.50033 8.64133 1.5 8.49999C1.49967 8.35866 1.54767 8.23999 1.644 8.14399C1.74033 8.04799 1.859 7.99999 2 7.99999H8C8.14166 7.99999 8.2605 8.04799 8.3565 8.14399C8.4525 8.23999 8.50033 8.35866 8.5 8.49999C8.49966 8.64133 8.45166 8.76016 8.356 8.85649C8.26033 8.95283 8.14166 9.00066 8 8.99999H2ZM2.35 7.24999C2.10833 7.24999 1.89383 7.17083 1.7065 7.0125C1.51917 6.85416 1.4045 6.65416 1.3625 6.4125L0.862501 3.2375C0.845834 3.2375 0.827167 3.23967 0.806501 3.244C0.785834 3.24833 0.767001 3.25033 0.750001 3.25C0.541667 3.25 0.364668 3.17717 0.219001 3.0315C0.0733344 2.88583 0.000334469 2.70867 1.13636e-06 2.5C-0.000332197 2.29133 0.0726677 2.11433 0.219001 1.969C0.365334 1.82367 0.542334 1.75067 0.750001 1.75C0.957667 1.74933 1.13483 1.82233 1.2815 1.969C1.42817 2.11567 1.501 2.29267 1.5 2.5C1.5 2.55833 1.49367 2.6125 1.481 2.6625C1.46833 2.7125 1.45383 2.75833 1.4375 2.8L3 3.5L4.5625 1.3625C4.47083 1.29583 4.39583 1.20833 4.3375 1.1C4.27917 0.991667 4.25 0.875 4.25 0.75C4.25 0.541667 4.323 0.364501 4.469 0.218501C4.615 0.0725011 4.792 -0.000332194 5 1.13895e-06C5.208 0.000334472 5.38516 0.0733344 5.5315 0.219001C5.67783 0.364667 5.75066 0.541667 5.75 0.75C5.75 0.875 5.72083 0.991667 5.6625 1.1C5.60416 1.20833 5.52916 1.29583 5.4375 1.3625L7 3.5L8.5625 2.8C8.54583 2.75833 8.53116 2.7125 8.5185 2.6625C8.50583 2.6125 8.49966 2.55833 8.5 2.5C8.5 2.29167 8.573 2.1145 8.719 1.9685C8.865 1.8225 9.042 1.74967 9.25 1.75C9.458 1.75033 9.63516 1.82333 9.7815 1.969C9.92783 2.11467 10.0007 2.29167 10 2.5C9.99933 2.70833 9.92649 2.8855 9.7815 3.0315C9.6365 3.1775 9.45933 3.25033 9.25 3.25C9.23333 3.25 9.21466 3.248 9.194 3.244C9.17333 3.24 9.1545 3.23783 9.1375 3.2375L8.6375 6.4125C8.59583 6.65416 8.48133 6.85416 8.294 7.0125C8.10666 7.17083 7.892 7.24999 7.65 7.24999H2.35ZM2.35 6.25H7.65L7.975 4.1625L7.4 4.4125C7.18333 4.50416 6.9625 4.52083 6.7375 4.4625C6.5125 4.40416 6.32916 4.27916 6.1875 4.0875L5 2.45L3.8125 4.0875C3.67083 4.27916 3.4875 4.40416 3.2625 4.4625C3.0375 4.52083 2.81667 4.50416 2.6 4.4125L2.025 4.1625L2.35 6.25Z"
                                                                    fill="white" />
                                                            </svg>
                                                        </button>
                                                        <button class="second-icon" title="Favourite">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="9"
                                                                height="11" viewBox="0 0 9 11" fill="none">
                                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                                    d="M3.79701 0.30821C3.81025 0.23997 3.84191 0.176658 3.88858 0.125138C3.93524 0.0736173 3.99512 0.0358558 4.06172 0.0159479C4.12832 -0.00396001 4.1991 -0.00525449 4.26638 0.0122049C4.33367 0.0296642 4.39489 0.0652111 4.4434 0.114991C4.56671 0.240837 4.80378 0.489988 5.04467 0.777274C5.28111 1.05884 5.53916 1.39761 5.68788 1.69951C5.8328 1.99443 5.98661 2.37578 6.10801 2.69421L6.67305 1.75354C6.70456 1.701 6.74826 1.65683 6.80046 1.62476C6.85265 1.59269 6.91181 1.57367 6.97292 1.56931C7.03402 1.56494 7.09528 1.57536 7.1515 1.59969C7.20773 1.62401 7.25727 1.66152 7.29592 1.70905C8.09867 2.70057 8.49846 3.76263 8.6974 4.57365C8.79718 4.97979 8.8474 5.32491 8.87282 5.57025C8.88576 5.69278 8.89424 5.81574 8.89824 5.93889V5.97131C8.89824 8.4482 6.93364 10.4649 4.44785 10.4649C1.96206 10.4649 0 8.44756 0 5.97004C0 5.28805 0.322244 3.68192 1.27563 2.36498C1.31266 2.31422 1.36166 2.27341 1.41826 2.24615C1.47487 2.2189 1.53734 2.20605 1.60011 2.20876C1.66287 2.21146 1.724 2.22963 1.77806 2.26166C1.83211 2.29368 1.87741 2.33856 1.90994 2.39231L2.55507 3.46709C2.75083 3.16073 3.01269 2.73044 3.21163 2.3332C3.49765 1.76117 3.72455 0.682572 3.79701 0.308845M4.3201 0.912655C4.20506 1.42113 4.01501 2.14697 3.77985 2.61858C3.46714 3.24336 3.0165 3.9298 2.86142 4.16051C2.82554 4.21345 2.77693 4.25651 2.72005 4.28574C2.66317 4.31497 2.59986 4.32943 2.53593 4.32778C2.472 4.32614 2.40952 4.30844 2.35422 4.27632C2.29892 4.24421 2.25258 4.1987 2.21948 4.14399L1.57118 3.06476C0.87457 4.19166 0.635589 5.45839 0.635589 5.97131C0.635589 8.10561 2.32244 9.82806 4.44785 9.82806C6.57326 9.82806 8.26265 8.10561 8.26265 5.97131V5.95351L8.26011 5.88995C8.25568 5.80484 8.24911 5.71986 8.24041 5.63508C8.20712 5.3287 8.15362 5.02487 8.08024 4.72555C7.87826 3.89157 7.52027 3.10334 7.02516 2.40248L6.38068 3.47535C6.34338 3.53732 6.28925 3.58743 6.22459 3.61985C6.15993 3.65227 6.08739 3.66566 6.01542 3.65847C5.94344 3.65128 5.87499 3.6238 5.81802 3.57923C5.76105 3.53466 5.71791 3.47483 5.6936 3.40671C5.59064 3.11815 5.33831 2.42917 5.11713 1.98044C5.00463 1.751 4.78916 1.46117 4.55781 1.18596C4.4801 1.09353 4.40086 1.00242 4.3201 0.912655Z"
                                                                    fill="#FEFEFE" />
                                                            </svg>
                                                        </button>
                                                        <button class="third-icon" title="lock">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="8"
                                                                height="10" viewBox="0 0 8 10" fill="none">
                                                                <path
                                                                    d="M4 7.61905C3.73478 7.61905 3.48043 7.51871 3.29289 7.3401C3.10536 7.1615 3 6.91925 3 6.66667C3 6.1381 3.445 5.71429 4 5.71429C4.26522 5.71429 4.51957 5.81463 4.70711 5.99323C4.89464 6.17184 5 6.41408 5 6.66667C5 6.91925 4.89464 7.1615 4.70711 7.3401C4.51957 7.51871 4.26522 7.61905 4 7.61905ZM7 9.04762V4.28571H1V9.04762H7ZM7 3.33333C7.26522 3.33333 7.51957 3.43367 7.70711 3.61228C7.89464 3.79089 8 4.03313 8 4.28571V9.04762C8 9.30021 7.89464 9.54245 7.70711 9.72105C7.51957 9.89966 7.26522 10 7 10H1C0.734784 10 0.48043 9.89966 0.292893 9.72105C0.105357 9.54245 0 9.30021 0 9.04762V4.28571C0 3.75714 0.445 3.33333 1 3.33333H1.5V2.38095C1.5 1.74948 1.76339 1.14388 2.23223 0.697365C2.70107 0.25085 3.33696 0 4 0C4.3283 0 4.65339 0.0615852 4.95671 0.181239C5.26002 0.300893 5.53562 0.476273 5.76777 0.697365C5.99991 0.918457 6.18406 1.18093 6.3097 1.4698C6.43534 1.75867 6.5 2.06828 6.5 2.38095V3.33333H7ZM4 0.952381C3.60218 0.952381 3.22064 1.10289 2.93934 1.3708C2.65804 1.63871 2.5 2.00207 2.5 2.38095V3.33333H5.5V2.38095C5.5 2.00207 5.34196 1.63871 5.06066 1.3708C4.77936 1.10289 4.39782 0.952381 4 0.952381Z"
                                                                    fill="white" />
                                                            </svg>
                                                        </button>
                                                    </div>
                                                </div>

                                                <h2 class="name">Furs & Co. Studio</h2>
                                                <p class="hosted-by">Hosted by <span>Dev É.</span></p>

                                                <div
                                                    class="studio-details mt-1 d-flex flex-column justify-content-between mt-2">

                                                    <div class="meta d-flex align-items-center justify-content-between">
                                                        <div class="distance" title="Distance">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="10"
                                                                height="14" viewBox="0 0 10 14" fill="none">
                                                                <path
                                                                    d="M5 6.65C4.5264 6.65 4.0722 6.46563 3.73731 6.13744C3.40242 5.80925 3.21429 5.36413 3.21429 4.9C3.21429 4.43587 3.40242 3.99075 3.73731 3.66256C4.0722 3.33437 4.5264 3.15 5 3.15C5.4736 3.15 5.9278 3.33437 6.26269 3.66256C6.59758 3.99075 6.78571 4.43587 6.78571 4.9C6.78571 5.12981 6.73953 5.35738 6.64979 5.5697C6.56004 5.78202 6.42851 5.97493 6.26269 6.13744C6.09687 6.29994 5.90002 6.42884 5.68336 6.51679C5.46671 6.60473 5.2345 6.65 5 6.65ZM5 0C3.67392 0 2.40215 0.516248 1.46447 1.43518C0.526784 2.3541 0 3.60044 0 4.9C0 8.575 5 14 5 14C5 14 10 8.575 10 4.9C10 3.60044 9.47322 2.3541 8.53553 1.43518C7.59785 0.516248 6.32608 0 5 0Z"
                                                                    fill="var(--active-bg)" />
                                                            </svg>
                                                            <span>2.5 mi</span>
                                                        </div>


                                                        <div class="rating" title="Rating">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="14"
                                                                height="14" viewBox="0 0 14 14" fill="none">
                                                                <path
                                                                    d="M6.12956 0.660476C6.40354 -0.220161 7.59647 -0.220158 7.87045 0.660479L8.89548 3.95519C9.01801 4.34902 9.36942 4.61566 9.76593 4.61566H13.083C13.9696 4.61566 14.3383 5.80055 13.621 6.34481L10.9374 8.38106C10.6166 8.62446 10.4824 9.0559 10.6049 9.44973L11.63 12.7444C11.9039 13.6251 10.9388 14.3574 10.2215 13.8131L7.53797 11.7769C7.21719 11.5335 6.78282 11.5335 6.46204 11.7769L3.77846 13.8131C3.06117 14.3574 2.09607 13.6251 2.37005 12.7444L3.39508 9.44973C3.51761 9.0559 3.38338 8.62446 3.0626 8.38106L0.37903 6.34481C-0.338258 5.80055 0.0303816 4.61566 0.916998 4.61566H4.23408C4.63058 4.61566 4.98199 4.34902 5.10452 3.95519L6.12956 0.660476Z"
                                                                    fill="var(--active-bg)" />
                                                            </svg>
                                                            <span>4.3 <small
                                                                    style="color:var(--muted)">(20)</small></span>
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
                                    <div class="col-lg-12 text-center section-gap">
                                        <button class="load-more">Load More</button>
                                    </div>
                                </div>
                        </section>
                    </div>

                    <div data-tab-content="space-map-view" class="tabcontent" style="display: none;">
                        <section class="section-gap">
                            <div class="container">
                                <div class="row">

                                    <div class="col-lg-6">
                                        <div class="row">
                                            <div class="col-lg-6 mt-2">
                                                <div class="card space-cards flex-column active">
                                                    <div class="left">
                                                        <div class="top-left-svg">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="21"
                                                                height="22" viewBox="0 0 21 22" fill="none">
                                                                <path
                                                                    d="M10.9482 0.125295C10.7667 0.043205 10.5723 0 10.3692 0C10.1662 0 9.97174 0.043205 9.79028 0.125295L1.65477 3.57738C0.704261 3.97918 -0.00430085 4.91673 1.96518e-05 6.0487C0.0216222 10.3346 1.78439 18.1764 9.22861 21.7408C9.95014 22.0864 10.7883 22.0864 11.5098 21.7408C18.9541 18.1764 20.7168 10.3346 20.7384 6.0487C20.7428 4.91673 20.0342 3.97918 19.0837 3.57738L10.9482 0.125295Z"
                                                                    fill="#CBDCE8" />
                                                                <path
                                                                    d="M16 6L11.5556 10.7222L16 6ZM9.58111 10.4917C8.20333 11.0206 7.10167 10.93 6 10.4933C6.27778 14.0728 7.94667 15.4489 10.1717 16C10.1717 16 11.8478 14.8144 12.0894 12.0039C12.1156 11.6994 12.1283 11.5478 12.0656 11.3761C12.0022 11.2044 11.8778 11.0817 11.6294 10.8356C11.2206 10.4311 11.0167 10.2289 10.7739 10.1778C10.5311 10.1278 10.2144 10.2489 9.58111 10.4917Z"
                                                                    fill="#CBDCE8" />
                                                                <path
                                                                    d="M16 6L11.5556 10.7222M9.58111 10.4917C8.20333 11.0206 7.10167 10.93 6 10.4933C6.27778 14.0728 7.94667 15.4489 10.1717 16C10.1717 16 11.8478 14.8144 12.0894 12.0039C12.1156 11.6994 12.1283 11.5478 12.0656 11.3761C12.0022 11.2044 11.8778 11.0817 11.6294 10.8356C11.2206 10.4311 11.0167 10.2289 10.7739 10.1778C10.5311 10.1278 10.2144 10.2489 9.58111 10.4917Z"
                                                                    stroke="white" stroke-linecap="round"
                                                                    stroke-linejoin="round" />
                                                                <path
                                                                    d="M6.83331 13.4703C6.83331 13.4703 8.2222 13.7392 9.61109 12.667L6.83331 13.4703Z"
                                                                    fill="#CBDCE8" />
                                                                <path
                                                                    d="M6.83331 13.4703C6.83331 13.4703 8.2222 13.7392 9.61109 12.667"
                                                                    stroke="white" stroke-linecap="round"
                                                                    stroke-linejoin="round" />
                                                                <path
                                                                    d="M9.05558 8.36144C9.05558 8.54561 8.98241 8.72225 8.85218 8.85248C8.72194 8.98272 8.54531 9.05588 8.36113 9.05588C8.17695 9.05588 8.00032 8.98272 7.87009 8.85248C7.73985 8.72225 7.66669 8.54561 7.66669 8.36144C7.66669 8.17726 7.73985 8.00062 7.87009 7.87039C8.00032 7.74016 8.17695 7.66699 8.36113 7.66699C8.54531 7.66699 8.72194 7.74016 8.85218 7.87039C8.98241 8.00062 9.05558 8.17726 9.05558 8.36144Z"
                                                                    fill="#CBDCE8" stroke="white" />
                                                                <path d="M10.4445 6.55554V6.6111V6.55554Z"
                                                                    fill="#CBDCE8" />
                                                                <path d="M10.4445 6.55554V6.6111" stroke="white"
                                                                    stroke-linecap="round" stroke-linejoin="round" />
                                                            </svg>
                                                        </div>
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 255 130"
                                                            fill="none">
                                                            <defs>
                                                                <pattern id="pattern-card-5"
                                                                    patternUnits="userSpaceOnUse" width="255"
                                                                    height="130">
                                                                    <image href="assets/images/space_card1.png"
                                                                        width="255" height="130"
                                                                        preserveAspectRatio="xMidYMid slice" />
                                                                </pattern>
                                                            </defs>

                                                            <path
                                                                d="M255 124.417C255 127.178 252.761 129.417 250 129.417H5C2.23858 129.417 0 127.178 0 124.417V37C0 34.2386 2.23858 32 5 32H27C29.7614 32 32 29.7614 32 27V5C32 2.23858 34.2386 0 37 0H250C252.761 0 255 2.23858 255 5V124.417Z"
                                                                fill="url(#pattern-card-5)" />
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
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="10"
                                                                        height="9" viewBox="0 0 10 9" fill="none">
                                                                        <path
                                                                            d="M2 8.99999C1.85833 8.99999 1.73967 8.95199 1.644 8.85599C1.54833 8.75999 1.50033 8.64133 1.5 8.49999C1.49967 8.35866 1.54767 8.23999 1.644 8.14399C1.74033 8.04799 1.859 7.99999 2 7.99999H8C8.14166 7.99999 8.2605 8.04799 8.3565 8.14399C8.4525 8.23999 8.50033 8.35866 8.5 8.49999C8.49966 8.64133 8.45166 8.76016 8.356 8.85649C8.26033 8.95283 8.14166 9.00066 8 8.99999H2ZM2.35 7.24999C2.10833 7.24999 1.89383 7.17083 1.7065 7.0125C1.51917 6.85416 1.4045 6.65416 1.3625 6.4125L0.862501 3.2375C0.845834 3.2375 0.827167 3.23967 0.806501 3.244C0.785834 3.24833 0.767001 3.25033 0.750001 3.25C0.541667 3.25 0.364668 3.17717 0.219001 3.0315C0.0733344 2.88583 0.000334469 2.70867 1.13636e-06 2.5C-0.000332197 2.29133 0.0726677 2.11433 0.219001 1.969C0.365334 1.82367 0.542334 1.75067 0.750001 1.75C0.957667 1.74933 1.13483 1.82233 1.2815 1.969C1.42817 2.11567 1.501 2.29267 1.5 2.5C1.5 2.55833 1.49367 2.6125 1.481 2.6625C1.46833 2.7125 1.45383 2.75833 1.4375 2.8L3 3.5L4.5625 1.3625C4.47083 1.29583 4.39583 1.20833 4.3375 1.1C4.27917 0.991667 4.25 0.875 4.25 0.75C4.25 0.541667 4.323 0.364501 4.469 0.218501C4.615 0.0725011 4.792 -0.000332194 5 1.13895e-06C5.208 0.000334472 5.38516 0.0733344 5.5315 0.219001C5.67783 0.364667 5.75066 0.541667 5.75 0.75C5.75 0.875 5.72083 0.991667 5.6625 1.1C5.60416 1.20833 5.52916 1.29583 5.4375 1.3625L7 3.5L8.5625 2.8C8.54583 2.75833 8.53116 2.7125 8.5185 2.6625C8.50583 2.6125 8.49966 2.55833 8.5 2.5C8.5 2.29167 8.573 2.1145 8.719 1.9685C8.865 1.8225 9.042 1.74967 9.25 1.75C9.458 1.75033 9.63516 1.82333 9.7815 1.969C9.92783 2.11467 10.0007 2.29167 10 2.5C9.99933 2.70833 9.92649 2.8855 9.7815 3.0315C9.6365 3.1775 9.45933 3.25033 9.25 3.25C9.23333 3.25 9.21466 3.248 9.194 3.244C9.17333 3.24 9.1545 3.23783 9.1375 3.2375L8.6375 6.4125C8.59583 6.65416 8.48133 6.85416 8.294 7.0125C8.10666 7.17083 7.892 7.24999 7.65 7.24999H2.35ZM2.35 6.25H7.65L7.975 4.1625L7.4 4.4125C7.18333 4.50416 6.9625 4.52083 6.7375 4.4625C6.5125 4.40416 6.32916 4.27916 6.1875 4.0875L5 2.45L3.8125 4.0875C3.67083 4.27916 3.4875 4.40416 3.2625 4.4625C3.0375 4.52083 2.81667 4.50416 2.6 4.4125L2.025 4.1625L2.35 6.25Z"
                                                                            fill="white" />
                                                                    </svg>
                                                                </button>
                                                                <button class="second-icon" title="Favourite">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="9"
                                                                        height="11" viewBox="0 0 9 11" fill="none">
                                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                                            d="M3.79701 0.30821C3.81025 0.23997 3.84191 0.176658 3.88858 0.125138C3.93524 0.0736173 3.99512 0.0358558 4.06172 0.0159479C4.12832 -0.00396001 4.1991 -0.00525449 4.26638 0.0122049C4.33367 0.0296642 4.39489 0.0652111 4.4434 0.114991C4.56671 0.240837 4.80378 0.489988 5.04467 0.777274C5.28111 1.05884 5.53916 1.39761 5.68788 1.69951C5.8328 1.99443 5.98661 2.37578 6.10801 2.69421L6.67305 1.75354C6.70456 1.701 6.74826 1.65683 6.80046 1.62476C6.85265 1.59269 6.91181 1.57367 6.97292 1.56931C7.03402 1.56494 7.09528 1.57536 7.1515 1.59969C7.20773 1.62401 7.25727 1.66152 7.29592 1.70905C8.09867 2.70057 8.49846 3.76263 8.6974 4.57365C8.79718 4.97979 8.8474 5.32491 8.87282 5.57025C8.88576 5.69278 8.89424 5.81574 8.89824 5.93889V5.97131C8.89824 8.4482 6.93364 10.4649 4.44785 10.4649C1.96206 10.4649 0 8.44756 0 5.97004C0 5.28805 0.322244 3.68192 1.27563 2.36498C1.31266 2.31422 1.36166 2.27341 1.41826 2.24615C1.47487 2.2189 1.53734 2.20605 1.60011 2.20876C1.66287 2.21146 1.724 2.22963 1.77806 2.26166C1.83211 2.29368 1.87741 2.33856 1.90994 2.39231L2.55507 3.46709C2.75083 3.16073 3.01269 2.73044 3.21163 2.3332C3.49765 1.76117 3.72455 0.682572 3.79701 0.308845M4.3201 0.912655C4.20506 1.42113 4.01501 2.14697 3.77985 2.61858C3.46714 3.24336 3.0165 3.9298 2.86142 4.16051C2.82554 4.21345 2.77693 4.25651 2.72005 4.28574C2.66317 4.31497 2.59986 4.32943 2.53593 4.32778C2.472 4.32614 2.40952 4.30844 2.35422 4.27632C2.29892 4.24421 2.25258 4.1987 2.21948 4.14399L1.57118 3.06476C0.87457 4.19166 0.635589 5.45839 0.635589 5.97131C0.635589 8.10561 2.32244 9.82806 4.44785 9.82806C6.57326 9.82806 8.26265 8.10561 8.26265 5.97131V5.95351L8.26011 5.88995C8.25568 5.80484 8.24911 5.71986 8.24041 5.63508C8.20712 5.3287 8.15362 5.02487 8.08024 4.72555C7.87826 3.89157 7.52027 3.10334 7.02516 2.40248L6.38068 3.47535C6.34338 3.53732 6.28925 3.58743 6.22459 3.61985C6.15993 3.65227 6.08739 3.66566 6.01542 3.65847C5.94344 3.65128 5.87499 3.6238 5.81802 3.57923C5.76105 3.53466 5.71791 3.47483 5.6936 3.40671C5.59064 3.11815 5.33831 2.42917 5.11713 1.98044C5.00463 1.751 4.78916 1.46117 4.55781 1.18596C4.4801 1.09353 4.40086 1.00242 4.3201 0.912655Z"
                                                                            fill="#FEFEFE" />
                                                                    </svg>
                                                                </button>
                                                                <button class="third-icon" title="lock">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="8"
                                                                        height="10" viewBox="0 0 8 10" fill="none">
                                                                        <path
                                                                            d="M4 7.61905C3.73478 7.61905 3.48043 7.51871 3.29289 7.3401C3.10536 7.1615 3 6.91925 3 6.66667C3 6.1381 3.445 5.71429 4 5.71429C4.26522 5.71429 4.51957 5.81463 4.70711 5.99323C4.89464 6.17184 5 6.41408 5 6.66667C5 6.91925 4.89464 7.1615 4.70711 7.3401C4.51957 7.51871 4.26522 7.61905 4 7.61905ZM7 9.04762V4.28571H1V9.04762H7ZM7 3.33333C7.26522 3.33333 7.51957 3.43367 7.70711 3.61228C7.89464 3.79089 8 4.03313 8 4.28571V9.04762C8 9.30021 7.89464 9.54245 7.70711 9.72105C7.51957 9.89966 7.26522 10 7 10H1C0.734784 10 0.48043 9.89966 0.292893 9.72105C0.105357 9.54245 0 9.30021 0 9.04762V4.28571C0 3.75714 0.445 3.33333 1 3.33333H1.5V2.38095C1.5 1.74948 1.76339 1.14388 2.23223 0.697365C2.70107 0.25085 3.33696 0 4 0C4.3283 0 4.65339 0.0615852 4.95671 0.181239C5.26002 0.300893 5.53562 0.476273 5.76777 0.697365C5.99991 0.918457 6.18406 1.18093 6.3097 1.4698C6.43534 1.75867 6.5 2.06828 6.5 2.38095V3.33333H7ZM4 0.952381C3.60218 0.952381 3.22064 1.10289 2.93934 1.3708C2.65804 1.63871 2.5 2.00207 2.5 2.38095V3.33333H5.5V2.38095C5.5 2.00207 5.34196 1.63871 5.06066 1.3708C4.77936 1.10289 4.39782 0.952381 4 0.952381Z"
                                                                            fill="white" />
                                                                    </svg>
                                                                </button>
                                                            </div>
                                                        </div>

                                                        <h2 class="name">Furs & Co. Studio</h2>
                                                        <p class="hosted-by">Hosted by <span>Dev É.</span></p>

                                                        <div
                                                            class="studio-details mt-1 d-flex flex-column justify-content-between mt-2">

                                                            <div
                                                                class="meta d-flex align-items-center justify-content-between">
                                                                <div class="distance" title="Distance">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="10"
                                                                        height="14" viewBox="0 0 10 14" fill="none">
                                                                        <path
                                                                            d="M5 6.65C4.5264 6.65 4.0722 6.46563 3.73731 6.13744C3.40242 5.80925 3.21429 5.36413 3.21429 4.9C3.21429 4.43587 3.40242 3.99075 3.73731 3.66256C4.0722 3.33437 4.5264 3.15 5 3.15C5.4736 3.15 5.9278 3.33437 6.26269 3.66256C6.59758 3.99075 6.78571 4.43587 6.78571 4.9C6.78571 5.12981 6.73953 5.35738 6.64979 5.5697C6.56004 5.78202 6.42851 5.97493 6.26269 6.13744C6.09687 6.29994 5.90002 6.42884 5.68336 6.51679C5.46671 6.60473 5.2345 6.65 5 6.65ZM5 0C3.67392 0 2.40215 0.516248 1.46447 1.43518C0.526784 2.3541 0 3.60044 0 4.9C0 8.575 5 14 5 14C5 14 10 8.575 10 4.9C10 3.60044 9.47322 2.3541 8.53553 1.43518C7.59785 0.516248 6.32608 0 5 0Z"
                                                                            fill="var(--active-bg)" />
                                                                    </svg>
                                                                    <span>2.5 mi</span>
                                                                </div>


                                                                <div class="rating" title="Rating">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="14"
                                                                        height="14" viewBox="0 0 14 14" fill="none">
                                                                        <path
                                                                            d="M6.12956 0.660476C6.40354 -0.220161 7.59647 -0.220158 7.87045 0.660479L8.89548 3.95519C9.01801 4.34902 9.36942 4.61566 9.76593 4.61566H13.083C13.9696 4.61566 14.3383 5.80055 13.621 6.34481L10.9374 8.38106C10.6166 8.62446 10.4824 9.0559 10.6049 9.44973L11.63 12.7444C11.9039 13.6251 10.9388 14.3574 10.2215 13.8131L7.53797 11.7769C7.21719 11.5335 6.78282 11.5335 6.46204 11.7769L3.77846 13.8131C3.06117 14.3574 2.09607 13.6251 2.37005 12.7444L3.39508 9.44973C3.51761 9.0559 3.38338 8.62446 3.0626 8.38106L0.37903 6.34481C-0.338258 5.80055 0.0303816 4.61566 0.916998 4.61566H4.23408C4.63058 4.61566 4.98199 4.34902 5.10452 3.95519L6.12956 0.660476Z"
                                                                            fill="var(--active-bg)" />
                                                                    </svg>
                                                                    <span>4.3 <small
                                                                            style="color:var(--muted)">(20)</small></span>
                                                                </div>
                                                            </div>
                                                        </div>



                                                        <p class="experience">Professional grooming spaces in <br>
                                                            London.
                                                            Spotless, well-equipped, easy <br> to access.</p>


                                                        <p class="amenities d-flex">
                                                            <b>Amenities:</b>&nbsp;Bath &#8226; Table &#8226; Dryer ...
                                                        </p>


                                                        <div class="availability mt-3">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="15"
                                                                height="15" viewBox="0 0 15 15" fill="none">
                                                                <path
                                                                    d="M7.5 0C3.375 0 0 3.375 0 7.5C0 11.625 3.375 15 7.5 15C11.625 15 15 11.625 15 7.5C15 3.375 11.625 0 7.5 0ZM6 11.25L2.25 7.5L3.3075 6.4425L6 9.1275L11.6925 3.435L12.75 4.5L6 11.25Z"
                                                                    fill="#D8E8B7" />
                                                            </svg>
                                                            <span>Availability</span>
                                                        </div>


                                                        <div class="slots-price d-flex flex-column">
                                                            <div class="slots d-flex flex-column"
                                                                aria-label="Available slots">
                                                                <div class="slot highlight">Mon 1, 08:30 AM</div>
                                                                <div class="slot">Wed 27, 09:15 AM</div>
                                                            </div>
                                                            <div class="price">From <span>£38</span> <span
                                                                    class="time-frame">/ hour</span></div>
                                                        </div>



                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mt-2">
                                                <div class="card space-cards flex-column active">
                                                    <div class="left">
                                                        <div class="top-left-svg">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="21"
                                                                height="22" viewBox="0 0 21 22" fill="none">
                                                                <path
                                                                    d="M10.9482 0.125295C10.7667 0.043205 10.5723 0 10.3692 0C10.1662 0 9.97174 0.043205 9.79028 0.125295L1.65477 3.57738C0.704261 3.97918 -0.00430085 4.91673 1.96518e-05 6.0487C0.0216222 10.3346 1.78439 18.1764 9.22861 21.7408C9.95014 22.0864 10.7883 22.0864 11.5098 21.7408C18.9541 18.1764 20.7168 10.3346 20.7384 6.0487C20.7428 4.91673 20.0342 3.97918 19.0837 3.57738L10.9482 0.125295Z"
                                                                    fill="#CBDCE8" />
                                                                <path
                                                                    d="M16 6L11.5556 10.7222L16 6ZM9.58111 10.4917C8.20333 11.0206 7.10167 10.93 6 10.4933C6.27778 14.0728 7.94667 15.4489 10.1717 16C10.1717 16 11.8478 14.8144 12.0894 12.0039C12.1156 11.6994 12.1283 11.5478 12.0656 11.3761C12.0022 11.2044 11.8778 11.0817 11.6294 10.8356C11.2206 10.4311 11.0167 10.2289 10.7739 10.1778C10.5311 10.1278 10.2144 10.2489 9.58111 10.4917Z"
                                                                    fill="#CBDCE8" />
                                                                <path
                                                                    d="M16 6L11.5556 10.7222M9.58111 10.4917C8.20333 11.0206 7.10167 10.93 6 10.4933C6.27778 14.0728 7.94667 15.4489 10.1717 16C10.1717 16 11.8478 14.8144 12.0894 12.0039C12.1156 11.6994 12.1283 11.5478 12.0656 11.3761C12.0022 11.2044 11.8778 11.0817 11.6294 10.8356C11.2206 10.4311 11.0167 10.2289 10.7739 10.1778C10.5311 10.1278 10.2144 10.2489 9.58111 10.4917Z"
                                                                    stroke="white" stroke-linecap="round"
                                                                    stroke-linejoin="round" />
                                                                <path
                                                                    d="M6.83331 13.4703C6.83331 13.4703 8.2222 13.7392 9.61109 12.667L6.83331 13.4703Z"
                                                                    fill="#CBDCE8" />
                                                                <path
                                                                    d="M6.83331 13.4703C6.83331 13.4703 8.2222 13.7392 9.61109 12.667"
                                                                    stroke="white" stroke-linecap="round"
                                                                    stroke-linejoin="round" />
                                                                <path
                                                                    d="M9.05558 8.36144C9.05558 8.54561 8.98241 8.72225 8.85218 8.85248C8.72194 8.98272 8.54531 9.05588 8.36113 9.05588C8.17695 9.05588 8.00032 8.98272 7.87009 8.85248C7.73985 8.72225 7.66669 8.54561 7.66669 8.36144C7.66669 8.17726 7.73985 8.00062 7.87009 7.87039C8.00032 7.74016 8.17695 7.66699 8.36113 7.66699C8.54531 7.66699 8.72194 7.74016 8.85218 7.87039C8.98241 8.00062 9.05558 8.17726 9.05558 8.36144Z"
                                                                    fill="#CBDCE8" stroke="white" />
                                                                <path d="M10.4445 6.55554V6.6111V6.55554Z"
                                                                    fill="#CBDCE8" />
                                                                <path d="M10.4445 6.55554V6.6111" stroke="white"
                                                                    stroke-linecap="round" stroke-linejoin="round" />
                                                            </svg>
                                                        </div>
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 255 130"
                                                            fill="none">
                                                            <defs>
                                                                <pattern id="pattern-card-6"
                                                                    patternUnits="userSpaceOnUse" width="255"
                                                                    height="130">
                                                                    <image href="assets/images/space_card2.png"
                                                                        width="255" height="130"
                                                                        preserveAspectRatio="xMidYMid slice" />
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
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="10"
                                                                        height="9" viewBox="0 0 10 9" fill="none">
                                                                        <path
                                                                            d="M2 8.99999C1.85833 8.99999 1.73967 8.95199 1.644 8.85599C1.54833 8.75999 1.50033 8.64133 1.5 8.49999C1.49967 8.35866 1.54767 8.23999 1.644 8.14399C1.74033 8.04799 1.859 7.99999 2 7.99999H8C8.14166 7.99999 8.2605 8.04799 8.3565 8.14399C8.4525 8.23999 8.50033 8.35866 8.5 8.49999C8.49966 8.64133 8.45166 8.76016 8.356 8.85649C8.26033 8.95283 8.14166 9.00066 8 8.99999H2ZM2.35 7.24999C2.10833 7.24999 1.89383 7.17083 1.7065 7.0125C1.51917 6.85416 1.4045 6.65416 1.3625 6.4125L0.862501 3.2375C0.845834 3.2375 0.827167 3.23967 0.806501 3.244C0.785834 3.24833 0.767001 3.25033 0.750001 3.25C0.541667 3.25 0.364668 3.17717 0.219001 3.0315C0.0733344 2.88583 0.000334469 2.70867 1.13636e-06 2.5C-0.000332197 2.29133 0.0726677 2.11433 0.219001 1.969C0.365334 1.82367 0.542334 1.75067 0.750001 1.75C0.957667 1.74933 1.13483 1.82233 1.2815 1.969C1.42817 2.11567 1.501 2.29267 1.5 2.5C1.5 2.55833 1.49367 2.6125 1.481 2.6625C1.46833 2.7125 1.45383 2.75833 1.4375 2.8L3 3.5L4.5625 1.3625C4.47083 1.29583 4.39583 1.20833 4.3375 1.1C4.27917 0.991667 4.25 0.875 4.25 0.75C4.25 0.541667 4.323 0.364501 4.469 0.218501C4.615 0.0725011 4.792 -0.000332194 5 1.13895e-06C5.208 0.000334472 5.38516 0.0733344 5.5315 0.219001C5.67783 0.364667 5.75066 0.541667 5.75 0.75C5.75 0.875 5.72083 0.991667 5.6625 1.1C5.60416 1.20833 5.52916 1.29583 5.4375 1.3625L7 3.5L8.5625 2.8C8.54583 2.75833 8.53116 2.7125 8.5185 2.6625C8.50583 2.6125 8.49966 2.55833 8.5 2.5C8.5 2.29167 8.573 2.1145 8.719 1.9685C8.865 1.8225 9.042 1.74967 9.25 1.75C9.458 1.75033 9.63516 1.82333 9.7815 1.969C9.92783 2.11467 10.0007 2.29167 10 2.5C9.99933 2.70833 9.92649 2.8855 9.7815 3.0315C9.6365 3.1775 9.45933 3.25033 9.25 3.25C9.23333 3.25 9.21466 3.248 9.194 3.244C9.17333 3.24 9.1545 3.23783 9.1375 3.2375L8.6375 6.4125C8.59583 6.65416 8.48133 6.85416 8.294 7.0125C8.10666 7.17083 7.892 7.24999 7.65 7.24999H2.35ZM2.35 6.25H7.65L7.975 4.1625L7.4 4.4125C7.18333 4.50416 6.9625 4.52083 6.7375 4.4625C6.5125 4.40416 6.32916 4.27916 6.1875 4.0875L5 2.45L3.8125 4.0875C3.67083 4.27916 3.4875 4.40416 3.2625 4.4625C3.0375 4.52083 2.81667 4.50416 2.6 4.4125L2.025 4.1625L2.35 6.25Z"
                                                                            fill="white" />
                                                                    </svg>
                                                                </button>
                                                                <button class="second-icon" title="Favourite">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="9"
                                                                        height="11" viewBox="0 0 9 11" fill="none">
                                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                                            d="M3.79701 0.30821C3.81025 0.23997 3.84191 0.176658 3.88858 0.125138C3.93524 0.0736173 3.99512 0.0358558 4.06172 0.0159479C4.12832 -0.00396001 4.1991 -0.00525449 4.26638 0.0122049C4.33367 0.0296642 4.39489 0.0652111 4.4434 0.114991C4.56671 0.240837 4.80378 0.489988 5.04467 0.777274C5.28111 1.05884 5.53916 1.39761 5.68788 1.69951C5.8328 1.99443 5.98661 2.37578 6.10801 2.69421L6.67305 1.75354C6.70456 1.701 6.74826 1.65683 6.80046 1.62476C6.85265 1.59269 6.91181 1.57367 6.97292 1.56931C7.03402 1.56494 7.09528 1.57536 7.1515 1.59969C7.20773 1.62401 7.25727 1.66152 7.29592 1.70905C8.09867 2.70057 8.49846 3.76263 8.6974 4.57365C8.79718 4.97979 8.8474 5.32491 8.87282 5.57025C8.88576 5.69278 8.89424 5.81574 8.89824 5.93889V5.97131C8.89824 8.4482 6.93364 10.4649 4.44785 10.4649C1.96206 10.4649 0 8.44756 0 5.97004C0 5.28805 0.322244 3.68192 1.27563 2.36498C1.31266 2.31422 1.36166 2.27341 1.41826 2.24615C1.47487 2.2189 1.53734 2.20605 1.60011 2.20876C1.66287 2.21146 1.724 2.22963 1.77806 2.26166C1.83211 2.29368 1.87741 2.33856 1.90994 2.39231L2.55507 3.46709C2.75083 3.16073 3.01269 2.73044 3.21163 2.3332C3.49765 1.76117 3.72455 0.682572 3.79701 0.308845M4.3201 0.912655C4.20506 1.42113 4.01501 2.14697 3.77985 2.61858C3.46714 3.24336 3.0165 3.9298 2.86142 4.16051C2.82554 4.21345 2.77693 4.25651 2.72005 4.28574C2.66317 4.31497 2.59986 4.32943 2.53593 4.32778C2.472 4.32614 2.40952 4.30844 2.35422 4.27632C2.29892 4.24421 2.25258 4.1987 2.21948 4.14399L1.57118 3.06476C0.87457 4.19166 0.635589 5.45839 0.635589 5.97131C0.635589 8.10561 2.32244 9.82806 4.44785 9.82806C6.57326 9.82806 8.26265 8.10561 8.26265 5.97131V5.95351L8.26011 5.88995C8.25568 5.80484 8.24911 5.71986 8.24041 5.63508C8.20712 5.3287 8.15362 5.02487 8.08024 4.72555C7.87826 3.89157 7.52027 3.10334 7.02516 2.40248L6.38068 3.47535C6.34338 3.53732 6.28925 3.58743 6.22459 3.61985C6.15993 3.65227 6.08739 3.66566 6.01542 3.65847C5.94344 3.65128 5.87499 3.6238 5.81802 3.57923C5.76105 3.53466 5.71791 3.47483 5.6936 3.40671C5.59064 3.11815 5.33831 2.42917 5.11713 1.98044C5.00463 1.751 4.78916 1.46117 4.55781 1.18596C4.4801 1.09353 4.40086 1.00242 4.3201 0.912655Z"
                                                                            fill="#FEFEFE" />
                                                                    </svg>
                                                                </button>
                                                                <button class="third-icon" title="lock">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="8"
                                                                        height="10" viewBox="0 0 8 10" fill="none">
                                                                        <path
                                                                            d="M4 7.61905C3.73478 7.61905 3.48043 7.51871 3.29289 7.3401C3.10536 7.1615 3 6.91925 3 6.66667C3 6.1381 3.445 5.71429 4 5.71429C4.26522 5.71429 4.51957 5.81463 4.70711 5.99323C4.89464 6.17184 5 6.41408 5 6.66667C5 6.91925 4.89464 7.1615 4.70711 7.3401C4.51957 7.51871 4.26522 7.61905 4 7.61905ZM7 9.04762V4.28571H1V9.04762H7ZM7 3.33333C7.26522 3.33333 7.51957 3.43367 7.70711 3.61228C7.89464 3.79089 8 4.03313 8 4.28571V9.04762C8 9.30021 7.89464 9.54245 7.70711 9.72105C7.51957 9.89966 7.26522 10 7 10H1C0.734784 10 0.48043 9.89966 0.292893 9.72105C0.105357 9.54245 0 9.30021 0 9.04762V4.28571C0 3.75714 0.445 3.33333 1 3.33333H1.5V2.38095C1.5 1.74948 1.76339 1.14388 2.23223 0.697365C2.70107 0.25085 3.33696 0 4 0C4.3283 0 4.65339 0.0615852 4.95671 0.181239C5.26002 0.300893 5.53562 0.476273 5.76777 0.697365C5.99991 0.918457 6.18406 1.18093 6.3097 1.4698C6.43534 1.75867 6.5 2.06828 6.5 2.38095V3.33333H7ZM4 0.952381C3.60218 0.952381 3.22064 1.10289 2.93934 1.3708C2.65804 1.63871 2.5 2.00207 2.5 2.38095V3.33333H5.5V2.38095C5.5 2.00207 5.34196 1.63871 5.06066 1.3708C4.77936 1.10289 4.39782 0.952381 4 0.952381Z"
                                                                            fill="white" />
                                                                    </svg>
                                                                </button>
                                                            </div>
                                                        </div>

                                                        <h2 class="name">Furs & Co. Studio</h2>
                                                        <p class="hosted-by">Hosted by <span>Dev É.</span></p>

                                                        <div
                                                            class="studio-details mt-1 d-flex flex-column justify-content-between mt-2">

                                                            <div
                                                                class="meta d-flex align-items-center justify-content-between">
                                                                <div class="distance" title="Distance">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="10"
                                                                        height="14" viewBox="0 0 10 14" fill="none">
                                                                        <path
                                                                            d="M5 6.65C4.5264 6.65 4.0722 6.46563 3.73731 6.13744C3.40242 5.80925 3.21429 5.36413 3.21429 4.9C3.21429 4.43587 3.40242 3.99075 3.73731 3.66256C4.0722 3.33437 4.5264 3.15 5 3.15C5.4736 3.15 5.9278 3.33437 6.26269 3.66256C6.59758 3.99075 6.78571 4.43587 6.78571 4.9C6.78571 5.12981 6.73953 5.35738 6.64979 5.5697C6.56004 5.78202 6.42851 5.97493 6.26269 6.13744C6.09687 6.29994 5.90002 6.42884 5.68336 6.51679C5.46671 6.60473 5.2345 6.65 5 6.65ZM5 0C3.67392 0 2.40215 0.516248 1.46447 1.43518C0.526784 2.3541 0 3.60044 0 4.9C0 8.575 5 14 5 14C5 14 10 8.575 10 4.9C10 3.60044 9.47322 2.3541 8.53553 1.43518C7.59785 0.516248 6.32608 0 5 0Z"
                                                                            fill="var(--active-bg)" />
                                                                    </svg>
                                                                    <span>2.5 mi</span>
                                                                </div>


                                                                <div class="rating" title="Rating">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="14"
                                                                        height="14" viewBox="0 0 14 14" fill="none">
                                                                        <path
                                                                            d="M6.12956 0.660476C6.40354 -0.220161 7.59647 -0.220158 7.87045 0.660479L8.89548 3.95519C9.01801 4.34902 9.36942 4.61566 9.76593 4.61566H13.083C13.9696 4.61566 14.3383 5.80055 13.621 6.34481L10.9374 8.38106C10.6166 8.62446 10.4824 9.0559 10.6049 9.44973L11.63 12.7444C11.9039 13.6251 10.9388 14.3574 10.2215 13.8131L7.53797 11.7769C7.21719 11.5335 6.78282 11.5335 6.46204 11.7769L3.77846 13.8131C3.06117 14.3574 2.09607 13.6251 2.37005 12.7444L3.39508 9.44973C3.51761 9.0559 3.38338 8.62446 3.0626 8.38106L0.37903 6.34481C-0.338258 5.80055 0.0303816 4.61566 0.916998 4.61566H4.23408C4.63058 4.61566 4.98199 4.34902 5.10452 3.95519L6.12956 0.660476Z"
                                                                            fill="var(--active-bg)" />
                                                                    </svg>
                                                                    <span>4.3 <small
                                                                            style="color:var(--muted)">(20)</small></span>
                                                                </div>
                                                            </div>
                                                        </div>



                                                        <p class="experience">Professional grooming spaces in <br>
                                                            London.
                                                            Spotless, well-equipped, easy <br> to access.</p>


                                                        <p class="amenities d-flex">
                                                            <b>Amenities:</b>&nbsp;Bath &#8226; Table &#8226; Dryer ...
                                                        </p>


                                                        <div class="availability mt-3">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="15"
                                                                height="15" viewBox="0 0 15 15" fill="none">
                                                                <path
                                                                    d="M7.5 0C3.375 0 0 3.375 0 7.5C0 11.625 3.375 15 7.5 15C11.625 15 15 11.625 15 7.5C15 3.375 11.625 0 7.5 0ZM6 11.25L2.25 7.5L3.3075 6.4425L6 9.1275L11.6925 3.435L12.75 4.5L6 11.25Z"
                                                                    fill="#D8E8B7" />
                                                            </svg>
                                                            <span>Availability</span>
                                                        </div>


                                                        <div class="slots-price d-flex flex-column">
                                                            <div class="slots d-flex flex-column"
                                                                aria-label="Available slots">
                                                                <div class="slot highlight">Mon 1, 08:30 AM</div>
                                                                <div class="slot">Wed 27, 09:15 AM</div>
                                                            </div>
                                                            <div class="price">From <span>£38</span> <span
                                                                    class="time-frame">/ hour</span></div>
                                                        </div>



                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mt-2">
                                                <div class="card space-cards flex-column active">
                                                    <div class="left">
                                                        <div class="top-left-svg">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="21"
                                                                height="22" viewBox="0 0 21 22" fill="none">
                                                                <path
                                                                    d="M10.9482 0.125295C10.7667 0.043205 10.5723 0 10.3692 0C10.1662 0 9.97174 0.043205 9.79028 0.125295L1.65477 3.57738C0.704261 3.97918 -0.00430085 4.91673 1.96518e-05 6.0487C0.0216222 10.3346 1.78439 18.1764 9.22861 21.7408C9.95014 22.0864 10.7883 22.0864 11.5098 21.7408C18.9541 18.1764 20.7168 10.3346 20.7384 6.0487C20.7428 4.91673 20.0342 3.97918 19.0837 3.57738L10.9482 0.125295Z"
                                                                    fill="#CBDCE8" />
                                                                <path
                                                                    d="M16 6L11.5556 10.7222L16 6ZM9.58111 10.4917C8.20333 11.0206 7.10167 10.93 6 10.4933C6.27778 14.0728 7.94667 15.4489 10.1717 16C10.1717 16 11.8478 14.8144 12.0894 12.0039C12.1156 11.6994 12.1283 11.5478 12.0656 11.3761C12.0022 11.2044 11.8778 11.0817 11.6294 10.8356C11.2206 10.4311 11.0167 10.2289 10.7739 10.1778C10.5311 10.1278 10.2144 10.2489 9.58111 10.4917Z"
                                                                    fill="#CBDCE8" />
                                                                <path
                                                                    d="M16 6L11.5556 10.7222M9.58111 10.4917C8.20333 11.0206 7.10167 10.93 6 10.4933C6.27778 14.0728 7.94667 15.4489 10.1717 16C10.1717 16 11.8478 14.8144 12.0894 12.0039C12.1156 11.6994 12.1283 11.5478 12.0656 11.3761C12.0022 11.2044 11.8778 11.0817 11.6294 10.8356C11.2206 10.4311 11.0167 10.2289 10.7739 10.1778C10.5311 10.1278 10.2144 10.2489 9.58111 10.4917Z"
                                                                    stroke="white" stroke-linecap="round"
                                                                    stroke-linejoin="round" />
                                                                <path
                                                                    d="M6.83331 13.4703C6.83331 13.4703 8.2222 13.7392 9.61109 12.667L6.83331 13.4703Z"
                                                                    fill="#CBDCE8" />
                                                                <path
                                                                    d="M6.83331 13.4703C6.83331 13.4703 8.2222 13.7392 9.61109 12.667"
                                                                    stroke="white" stroke-linecap="round"
                                                                    stroke-linejoin="round" />
                                                                <path
                                                                    d="M9.05558 8.36144C9.05558 8.54561 8.98241 8.72225 8.85218 8.85248C8.72194 8.98272 8.54531 9.05588 8.36113 9.05588C8.17695 9.05588 8.00032 8.98272 7.87009 8.85248C7.73985 8.72225 7.66669 8.54561 7.66669 8.36144C7.66669 8.17726 7.73985 8.00062 7.87009 7.87039C8.00032 7.74016 8.17695 7.66699 8.36113 7.66699C8.54531 7.66699 8.72194 7.74016 8.85218 7.87039C8.98241 8.00062 9.05558 8.17726 9.05558 8.36144Z"
                                                                    fill="#CBDCE8" stroke="white" />
                                                                <path d="M10.4445 6.55554V6.6111V6.55554Z"
                                                                    fill="#CBDCE8" />
                                                                <path d="M10.4445 6.55554V6.6111" stroke="white"
                                                                    stroke-linecap="round" stroke-linejoin="round" />
                                                            </svg>
                                                        </div>
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 255 130"
                                                            fill="none">
                                                            <defs>
                                                                <pattern id="pattern-card-7"
                                                                    patternUnits="userSpaceOnUse" width="255"
                                                                    height="130">
                                                                    <image href="assets/images/space_card3.png"
                                                                        width="255" height="130"
                                                                        preserveAspectRatio="xMidYMid slice" />
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
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="10"
                                                                        height="9" viewBox="0 0 10 9" fill="none">
                                                                        <path
                                                                            d="M2 8.99999C1.85833 8.99999 1.73967 8.95199 1.644 8.85599C1.54833 8.75999 1.50033 8.64133 1.5 8.49999C1.49967 8.35866 1.54767 8.23999 1.644 8.14399C1.74033 8.04799 1.859 7.99999 2 7.99999H8C8.14166 7.99999 8.2605 8.04799 8.3565 8.14399C8.4525 8.23999 8.50033 8.35866 8.5 8.49999C8.49966 8.64133 8.45166 8.76016 8.356 8.85649C8.26033 8.95283 8.14166 9.00066 8 8.99999H2ZM2.35 7.24999C2.10833 7.24999 1.89383 7.17083 1.7065 7.0125C1.51917 6.85416 1.4045 6.65416 1.3625 6.4125L0.862501 3.2375C0.845834 3.2375 0.827167 3.23967 0.806501 3.244C0.785834 3.24833 0.767001 3.25033 0.750001 3.25C0.541667 3.25 0.364668 3.17717 0.219001 3.0315C0.0733344 2.88583 0.000334469 2.70867 1.13636e-06 2.5C-0.000332197 2.29133 0.0726677 2.11433 0.219001 1.969C0.365334 1.82367 0.542334 1.75067 0.750001 1.75C0.957667 1.74933 1.13483 1.82233 1.2815 1.969C1.42817 2.11567 1.501 2.29267 1.5 2.5C1.5 2.55833 1.49367 2.6125 1.481 2.6625C1.46833 2.7125 1.45383 2.75833 1.4375 2.8L3 3.5L4.5625 1.3625C4.47083 1.29583 4.39583 1.20833 4.3375 1.1C4.27917 0.991667 4.25 0.875 4.25 0.75C4.25 0.541667 4.323 0.364501 4.469 0.218501C4.615 0.0725011 4.792 -0.000332194 5 1.13895e-06C5.208 0.000334472 5.38516 0.0733344 5.5315 0.219001C5.67783 0.364667 5.75066 0.541667 5.75 0.75C5.75 0.875 5.72083 0.991667 5.6625 1.1C5.60416 1.20833 5.52916 1.29583 5.4375 1.3625L7 3.5L8.5625 2.8C8.54583 2.75833 8.53116 2.7125 8.5185 2.6625C8.50583 2.6125 8.49966 2.55833 8.5 2.5C8.5 2.29167 8.573 2.1145 8.719 1.9685C8.865 1.8225 9.042 1.74967 9.25 1.75C9.458 1.75033 9.63516 1.82333 9.7815 1.969C9.92783 2.11467 10.0007 2.29167 10 2.5C9.99933 2.70833 9.92649 2.8855 9.7815 3.0315C9.6365 3.1775 9.45933 3.25033 9.25 3.25C9.23333 3.25 9.21466 3.248 9.194 3.244C9.17333 3.24 9.1545 3.23783 9.1375 3.2375L8.6375 6.4125C8.59583 6.65416 8.48133 6.85416 8.294 7.0125C8.10666 7.17083 7.892 7.24999 7.65 7.24999H2.35ZM2.35 6.25H7.65L7.975 4.1625L7.4 4.4125C7.18333 4.50416 6.9625 4.52083 6.7375 4.4625C6.5125 4.40416 6.32916 4.27916 6.1875 4.0875L5 2.45L3.8125 4.0875C3.67083 4.27916 3.4875 4.40416 3.2625 4.4625C3.0375 4.52083 2.81667 4.50416 2.6 4.4125L2.025 4.1625L2.35 6.25Z"
                                                                            fill="white" />
                                                                    </svg>
                                                                </button>
                                                                <button class="second-icon" title="Favourite">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="9"
                                                                        height="11" viewBox="0 0 9 11" fill="none">
                                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                                            d="M3.79701 0.30821C3.81025 0.23997 3.84191 0.176658 3.88858 0.125138C3.93524 0.0736173 3.99512 0.0358558 4.06172 0.0159479C4.12832 -0.00396001 4.1991 -0.00525449 4.26638 0.0122049C4.33367 0.0296642 4.39489 0.0652111 4.4434 0.114991C4.56671 0.240837 4.80378 0.489988 5.04467 0.777274C5.28111 1.05884 5.53916 1.39761 5.68788 1.69951C5.8328 1.99443 5.98661 2.37578 6.10801 2.69421L6.67305 1.75354C6.70456 1.701 6.74826 1.65683 6.80046 1.62476C6.85265 1.59269 6.91181 1.57367 6.97292 1.56931C7.03402 1.56494 7.09528 1.57536 7.1515 1.59969C7.20773 1.62401 7.25727 1.66152 7.29592 1.70905C8.09867 2.70057 8.49846 3.76263 8.6974 4.57365C8.79718 4.97979 8.8474 5.32491 8.87282 5.57025C8.88576 5.69278 8.89424 5.81574 8.89824 5.93889V5.97131C8.89824 8.4482 6.93364 10.4649 4.44785 10.4649C1.96206 10.4649 0 8.44756 0 5.97004C0 5.28805 0.322244 3.68192 1.27563 2.36498C1.31266 2.31422 1.36166 2.27341 1.41826 2.24615C1.47487 2.2189 1.53734 2.20605 1.60011 2.20876C1.66287 2.21146 1.724 2.22963 1.77806 2.26166C1.83211 2.29368 1.87741 2.33856 1.90994 2.39231L2.55507 3.46709C2.75083 3.16073 3.01269 2.73044 3.21163 2.3332C3.49765 1.76117 3.72455 0.682572 3.79701 0.308845M4.3201 0.912655C4.20506 1.42113 4.01501 2.14697 3.77985 2.61858C3.46714 3.24336 3.0165 3.9298 2.86142 4.16051C2.82554 4.21345 2.77693 4.25651 2.72005 4.28574C2.66317 4.31497 2.59986 4.32943 2.53593 4.32778C2.472 4.32614 2.40952 4.30844 2.35422 4.27632C2.29892 4.24421 2.25258 4.1987 2.21948 4.14399L1.57118 3.06476C0.87457 4.19166 0.635589 5.45839 0.635589 5.97131C0.635589 8.10561 2.32244 9.82806 4.44785 9.82806C6.57326 9.82806 8.26265 8.10561 8.26265 5.97131V5.95351L8.26011 5.88995C8.25568 5.80484 8.24911 5.71986 8.24041 5.63508C8.20712 5.3287 8.15362 5.02487 8.08024 4.72555C7.87826 3.89157 7.52027 3.10334 7.02516 2.40248L6.38068 3.47535C6.34338 3.53732 6.28925 3.58743 6.22459 3.61985C6.15993 3.65227 6.08739 3.66566 6.01542 3.65847C5.94344 3.65128 5.87499 3.6238 5.81802 3.57923C5.76105 3.53466 5.71791 3.47483 5.6936 3.40671C5.59064 3.11815 5.33831 2.42917 5.11713 1.98044C5.00463 1.751 4.78916 1.46117 4.55781 1.18596C4.4801 1.09353 4.40086 1.00242 4.3201 0.912655Z"
                                                                            fill="#FEFEFE" />
                                                                    </svg>
                                                                </button>
                                                                <button class="third-icon" title="lock">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="8"
                                                                        height="10" viewBox="0 0 8 10" fill="none">
                                                                        <path
                                                                            d="M4 7.61905C3.73478 7.61905 3.48043 7.51871 3.29289 7.3401C3.10536 7.1615 3 6.91925 3 6.66667C3 6.1381 3.445 5.71429 4 5.71429C4.26522 5.71429 4.51957 5.81463 4.70711 5.99323C4.89464 6.17184 5 6.41408 5 6.66667C5 6.91925 4.89464 7.1615 4.70711 7.3401C4.51957 7.51871 4.26522 7.61905 4 7.61905ZM7 9.04762V4.28571H1V9.04762H7ZM7 3.33333C7.26522 3.33333 7.51957 3.43367 7.70711 3.61228C7.89464 3.79089 8 4.03313 8 4.28571V9.04762C8 9.30021 7.89464 9.54245 7.70711 9.72105C7.51957 9.89966 7.26522 10 7 10H1C0.734784 10 0.48043 9.89966 0.292893 9.72105C0.105357 9.54245 0 9.30021 0 9.04762V4.28571C0 3.75714 0.445 3.33333 1 3.33333H1.5V2.38095C1.5 1.74948 1.76339 1.14388 2.23223 0.697365C2.70107 0.25085 3.33696 0 4 0C4.3283 0 4.65339 0.0615852 4.95671 0.181239C5.26002 0.300893 5.53562 0.476273 5.76777 0.697365C5.99991 0.918457 6.18406 1.18093 6.3097 1.4698C6.43534 1.75867 6.5 2.06828 6.5 2.38095V3.33333H7ZM4 0.952381C3.60218 0.952381 3.22064 1.10289 2.93934 1.3708C2.65804 1.63871 2.5 2.00207 2.5 2.38095V3.33333H5.5V2.38095C5.5 2.00207 5.34196 1.63871 5.06066 1.3708C4.77936 1.10289 4.39782 0.952381 4 0.952381Z"
                                                                            fill="white" />
                                                                    </svg>
                                                                </button>
                                                            </div>
                                                        </div>

                                                        <h2 class="name">Furs & Co. Studio</h2>
                                                        <p class="hosted-by">Hosted by <span>Dev É.</span></p>

                                                        <div
                                                            class="studio-details mt-1 d-flex flex-column justify-content-between mt-2">

                                                            <div
                                                                class="meta d-flex align-items-center justify-content-between">
                                                                <div class="distance" title="Distance">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="10"
                                                                        height="14" viewBox="0 0 10 14" fill="none">
                                                                        <path
                                                                            d="M5 6.65C4.5264 6.65 4.0722 6.46563 3.73731 6.13744C3.40242 5.80925 3.21429 5.36413 3.21429 4.9C3.21429 4.43587 3.40242 3.99075 3.73731 3.66256C4.0722 3.33437 4.5264 3.15 5 3.15C5.4736 3.15 5.9278 3.33437 6.26269 3.66256C6.59758 3.99075 6.78571 4.43587 6.78571 4.9C6.78571 5.12981 6.73953 5.35738 6.64979 5.5697C6.56004 5.78202 6.42851 5.97493 6.26269 6.13744C6.09687 6.29994 5.90002 6.42884 5.68336 6.51679C5.46671 6.60473 5.2345 6.65 5 6.65ZM5 0C3.67392 0 2.40215 0.516248 1.46447 1.43518C0.526784 2.3541 0 3.60044 0 4.9C0 8.575 5 14 5 14C5 14 10 8.575 10 4.9C10 3.60044 9.47322 2.3541 8.53553 1.43518C7.59785 0.516248 6.32608 0 5 0Z"
                                                                            fill="var(--active-bg)" />
                                                                    </svg>
                                                                    <span>2.5 mi</span>
                                                                </div>


                                                                <div class="rating" title="Rating">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="14"
                                                                        height="14" viewBox="0 0 14 14" fill="none">
                                                                        <path
                                                                            d="M6.12956 0.660476C6.40354 -0.220161 7.59647 -0.220158 7.87045 0.660479L8.89548 3.95519C9.01801 4.34902 9.36942 4.61566 9.76593 4.61566H13.083C13.9696 4.61566 14.3383 5.80055 13.621 6.34481L10.9374 8.38106C10.6166 8.62446 10.4824 9.0559 10.6049 9.44973L11.63 12.7444C11.9039 13.6251 10.9388 14.3574 10.2215 13.8131L7.53797 11.7769C7.21719 11.5335 6.78282 11.5335 6.46204 11.7769L3.77846 13.8131C3.06117 14.3574 2.09607 13.6251 2.37005 12.7444L3.39508 9.44973C3.51761 9.0559 3.38338 8.62446 3.0626 8.38106L0.37903 6.34481C-0.338258 5.80055 0.0303816 4.61566 0.916998 4.61566H4.23408C4.63058 4.61566 4.98199 4.34902 5.10452 3.95519L6.12956 0.660476Z"
                                                                            fill="var(--active-bg)" />
                                                                    </svg>
                                                                    <span>4.3 <small
                                                                            style="color:var(--muted)">(20)</small></span>
                                                                </div>
                                                            </div>
                                                        </div>



                                                        <p class="experience">Professional grooming spaces in <br>
                                                            London.
                                                            Spotless, well-equipped, easy <br> to access.</p>


                                                        <p class="amenities d-flex">
                                                            <b>Amenities:</b>&nbsp;Bath &#8226; Table &#8226; Dryer ...
                                                        </p>


                                                        <div class="availability mt-3">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="15"
                                                                height="15" viewBox="0 0 15 15" fill="none">
                                                                <path
                                                                    d="M7.5 0C3.375 0 0 3.375 0 7.5C0 11.625 3.375 15 7.5 15C11.625 15 15 11.625 15 7.5C15 3.375 11.625 0 7.5 0ZM6 11.25L2.25 7.5L3.3075 6.4425L6 9.1275L11.6925 3.435L12.75 4.5L6 11.25Z"
                                                                    fill="#D8E8B7" />
                                                            </svg>
                                                            <span>Availability</span>
                                                        </div>


                                                        <div class="slots-price d-flex flex-column">
                                                            <div class="slots d-flex flex-column"
                                                                aria-label="Available slots">
                                                                <div class="slot highlight">Mon 1, 08:30 AM</div>
                                                                <div class="slot">Wed 27, 09:15 AM</div>
                                                            </div>
                                                            <div class="price">From <span>£38</span> <span
                                                                    class="time-frame">/ hour</span></div>
                                                        </div>



                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mt-2">
                                                <div class="card space-cards flex-column active">
                                                    <div class="left">
                                                        <div class="top-left-svg">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="21"
                                                                height="22" viewBox="0 0 21 22" fill="none">
                                                                <path
                                                                    d="M10.9482 0.125295C10.7667 0.043205 10.5723 0 10.3692 0C10.1662 0 9.97174 0.043205 9.79028 0.125295L1.65477 3.57738C0.704261 3.97918 -0.00430085 4.91673 1.96518e-05 6.0487C0.0216222 10.3346 1.78439 18.1764 9.22861 21.7408C9.95014 22.0864 10.7883 22.0864 11.5098 21.7408C18.9541 18.1764 20.7168 10.3346 20.7384 6.0487C20.7428 4.91673 20.0342 3.97918 19.0837 3.57738L10.9482 0.125295Z"
                                                                    fill="#CBDCE8" />
                                                                <path
                                                                    d="M16 6L11.5556 10.7222L16 6ZM9.58111 10.4917C8.20333 11.0206 7.10167 10.93 6 10.4933C6.27778 14.0728 7.94667 15.4489 10.1717 16C10.1717 16 11.8478 14.8144 12.0894 12.0039C12.1156 11.6994 12.1283 11.5478 12.0656 11.3761C12.0022 11.2044 11.8778 11.0817 11.6294 10.8356C11.2206 10.4311 11.0167 10.2289 10.7739 10.1778C10.5311 10.1278 10.2144 10.2489 9.58111 10.4917Z"
                                                                    fill="#CBDCE8" />
                                                                <path
                                                                    d="M16 6L11.5556 10.7222M9.58111 10.4917C8.20333 11.0206 7.10167 10.93 6 10.4933C6.27778 14.0728 7.94667 15.4489 10.1717 16C10.1717 16 11.8478 14.8144 12.0894 12.0039C12.1156 11.6994 12.1283 11.5478 12.0656 11.3761C12.0022 11.2044 11.8778 11.0817 11.6294 10.8356C11.2206 10.4311 11.0167 10.2289 10.7739 10.1778C10.5311 10.1278 10.2144 10.2489 9.58111 10.4917Z"
                                                                    stroke="white" stroke-linecap="round"
                                                                    stroke-linejoin="round" />
                                                                <path
                                                                    d="M6.83331 13.4703C6.83331 13.4703 8.2222 13.7392 9.61109 12.667L6.83331 13.4703Z"
                                                                    fill="#CBDCE8" />
                                                                <path
                                                                    d="M6.83331 13.4703C6.83331 13.4703 8.2222 13.7392 9.61109 12.667"
                                                                    stroke="white" stroke-linecap="round"
                                                                    stroke-linejoin="round" />
                                                                <path
                                                                    d="M9.05558 8.36144C9.05558 8.54561 8.98241 8.72225 8.85218 8.85248C8.72194 8.98272 8.54531 9.05588 8.36113 9.05588C8.17695 9.05588 8.00032 8.98272 7.87009 8.85248C7.73985 8.72225 7.66669 8.54561 7.66669 8.36144C7.66669 8.17726 7.73985 8.00062 7.87009 7.87039C8.00032 7.74016 8.17695 7.66699 8.36113 7.66699C8.54531 7.66699 8.72194 7.74016 8.85218 7.87039C8.98241 8.00062 9.05558 8.17726 9.05558 8.36144Z"
                                                                    fill="#CBDCE8" stroke="white" />
                                                                <path d="M10.4445 6.55554V6.6111V6.55554Z"
                                                                    fill="#CBDCE8" />
                                                                <path d="M10.4445 6.55554V6.6111" stroke="white"
                                                                    stroke-linecap="round" stroke-linejoin="round" />
                                                            </svg>
                                                        </div>
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 255 130"
                                                            fill="none">
                                                            <defs>
                                                                <pattern id="pattern-card-8"
                                                                    patternUnits="userSpaceOnUse" width="255"
                                                                    height="130">
                                                                    <image href="assets/images/space_card1.png"
                                                                        width="255" height="130"
                                                                        preserveAspectRatio="xMidYMid slice" />
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
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="10"
                                                                        height="9" viewBox="0 0 10 9" fill="none">
                                                                        <path
                                                                            d="M2 8.99999C1.85833 8.99999 1.73967 8.95199 1.644 8.85599C1.54833 8.75999 1.50033 8.64133 1.5 8.49999C1.49967 8.35866 1.54767 8.23999 1.644 8.14399C1.74033 8.04799 1.859 7.99999 2 7.99999H8C8.14166 7.99999 8.2605 8.04799 8.3565 8.14399C8.4525 8.23999 8.50033 8.35866 8.5 8.49999C8.49966 8.64133 8.45166 8.76016 8.356 8.85649C8.26033 8.95283 8.14166 9.00066 8 8.99999H2ZM2.35 7.24999C2.10833 7.24999 1.89383 7.17083 1.7065 7.0125C1.51917 6.85416 1.4045 6.65416 1.3625 6.4125L0.862501 3.2375C0.845834 3.2375 0.827167 3.23967 0.806501 3.244C0.785834 3.24833 0.767001 3.25033 0.750001 3.25C0.541667 3.25 0.364668 3.17717 0.219001 3.0315C0.0733344 2.88583 0.000334469 2.70867 1.13636e-06 2.5C-0.000332197 2.29133 0.0726677 2.11433 0.219001 1.969C0.365334 1.82367 0.542334 1.75067 0.750001 1.75C0.957667 1.74933 1.13483 1.82233 1.2815 1.969C1.42817 2.11567 1.501 2.29267 1.5 2.5C1.5 2.55833 1.49367 2.6125 1.481 2.6625C1.46833 2.7125 1.45383 2.75833 1.4375 2.8L3 3.5L4.5625 1.3625C4.47083 1.29583 4.39583 1.20833 4.3375 1.1C4.27917 0.991667 4.25 0.875 4.25 0.75C4.25 0.541667 4.323 0.364501 4.469 0.218501C4.615 0.0725011 4.792 -0.000332194 5 1.13895e-06C5.208 0.000334472 5.38516 0.0733344 5.5315 0.219001C5.67783 0.364667 5.75066 0.541667 5.75 0.75C5.75 0.875 5.72083 0.991667 5.6625 1.1C5.60416 1.20833 5.52916 1.29583 5.4375 1.3625L7 3.5L8.5625 2.8C8.54583 2.75833 8.53116 2.7125 8.5185 2.6625C8.50583 2.6125 8.49966 2.55833 8.5 2.5C8.5 2.29167 8.573 2.1145 8.719 1.9685C8.865 1.8225 9.042 1.74967 9.25 1.75C9.458 1.75033 9.63516 1.82333 9.7815 1.969C9.92783 2.11467 10.0007 2.29167 10 2.5C9.99933 2.70833 9.92649 2.8855 9.7815 3.0315C9.6365 3.1775 9.45933 3.25033 9.25 3.25C9.23333 3.25 9.21466 3.248 9.194 3.244C9.17333 3.24 9.1545 3.23783 9.1375 3.2375L8.6375 6.4125C8.59583 6.65416 8.48133 6.85416 8.294 7.0125C8.10666 7.17083 7.892 7.24999 7.65 7.24999H2.35ZM2.35 6.25H7.65L7.975 4.1625L7.4 4.4125C7.18333 4.50416 6.9625 4.52083 6.7375 4.4625C6.5125 4.40416 6.32916 4.27916 6.1875 4.0875L5 2.45L3.8125 4.0875C3.67083 4.27916 3.4875 4.40416 3.2625 4.4625C3.0375 4.52083 2.81667 4.50416 2.6 4.4125L2.025 4.1625L2.35 6.25Z"
                                                                            fill="white" />
                                                                    </svg>
                                                                </button>
                                                                <button class="second-icon" title="Favourite">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="9"
                                                                        height="11" viewBox="0 0 9 11" fill="none">
                                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                                            d="M3.79701 0.30821C3.81025 0.23997 3.84191 0.176658 3.88858 0.125138C3.93524 0.0736173 3.99512 0.0358558 4.06172 0.0159479C4.12832 -0.00396001 4.1991 -0.00525449 4.26638 0.0122049C4.33367 0.0296642 4.39489 0.0652111 4.4434 0.114991C4.56671 0.240837 4.80378 0.489988 5.04467 0.777274C5.28111 1.05884 5.53916 1.39761 5.68788 1.69951C5.8328 1.99443 5.98661 2.37578 6.10801 2.69421L6.67305 1.75354C6.70456 1.701 6.74826 1.65683 6.80046 1.62476C6.85265 1.59269 6.91181 1.57367 6.97292 1.56931C7.03402 1.56494 7.09528 1.57536 7.1515 1.59969C7.20773 1.62401 7.25727 1.66152 7.29592 1.70905C8.09867 2.70057 8.49846 3.76263 8.6974 4.57365C8.79718 4.97979 8.8474 5.32491 8.87282 5.57025C8.88576 5.69278 8.89424 5.81574 8.89824 5.93889V5.97131C8.89824 8.4482 6.93364 10.4649 4.44785 10.4649C1.96206 10.4649 0 8.44756 0 5.97004C0 5.28805 0.322244 3.68192 1.27563 2.36498C1.31266 2.31422 1.36166 2.27341 1.41826 2.24615C1.47487 2.2189 1.53734 2.20605 1.60011 2.20876C1.66287 2.21146 1.724 2.22963 1.77806 2.26166C1.83211 2.29368 1.87741 2.33856 1.90994 2.39231L2.55507 3.46709C2.75083 3.16073 3.01269 2.73044 3.21163 2.3332C3.49765 1.76117 3.72455 0.682572 3.79701 0.308845M4.3201 0.912655C4.20506 1.42113 4.01501 2.14697 3.77985 2.61858C3.46714 3.24336 3.0165 3.9298 2.86142 4.16051C2.82554 4.21345 2.77693 4.25651 2.72005 4.28574C2.66317 4.31497 2.59986 4.32943 2.53593 4.32778C2.472 4.32614 2.40952 4.30844 2.35422 4.27632C2.29892 4.24421 2.25258 4.1987 2.21948 4.14399L1.57118 3.06476C0.87457 4.19166 0.635589 5.45839 0.635589 5.97131C0.635589 8.10561 2.32244 9.82806 4.44785 9.82806C6.57326 9.82806 8.26265 8.10561 8.26265 5.97131V5.95351L8.26011 5.88995C8.25568 5.80484 8.24911 5.71986 8.24041 5.63508C8.20712 5.3287 8.15362 5.02487 8.08024 4.72555C7.87826 3.89157 7.52027 3.10334 7.02516 2.40248L6.38068 3.47535C6.34338 3.53732 6.28925 3.58743 6.22459 3.61985C6.15993 3.65227 6.08739 3.66566 6.01542 3.65847C5.94344 3.65128 5.87499 3.6238 5.81802 3.57923C5.76105 3.53466 5.71791 3.47483 5.6936 3.40671C5.59064 3.11815 5.33831 2.42917 5.11713 1.98044C5.00463 1.751 4.78916 1.46117 4.55781 1.18596C4.4801 1.09353 4.40086 1.00242 4.3201 0.912655Z"
                                                                            fill="#FEFEFE" />
                                                                    </svg>
                                                                </button>
                                                                <button class="third-icon" title="lock">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="8"
                                                                        height="10" viewBox="0 0 8 10" fill="none">
                                                                        <path
                                                                            d="M4 7.61905C3.73478 7.61905 3.48043 7.51871 3.29289 7.3401C3.10536 7.1615 3 6.91925 3 6.66667C3 6.1381 3.445 5.71429 4 5.71429C4.26522 5.71429 4.51957 5.81463 4.70711 5.99323C4.89464 6.17184 5 6.41408 5 6.66667C5 6.91925 4.89464 7.1615 4.70711 7.3401C4.51957 7.51871 4.26522 7.61905 4 7.61905ZM7 9.04762V4.28571H1V9.04762H7ZM7 3.33333C7.26522 3.33333 7.51957 3.43367 7.70711 3.61228C7.89464 3.79089 8 4.03313 8 4.28571V9.04762C8 9.30021 7.89464 9.54245 7.70711 9.72105C7.51957 9.89966 7.26522 10 7 10H1C0.734784 10 0.48043 9.89966 0.292893 9.72105C0.105357 9.54245 0 9.30021 0 9.04762V4.28571C0 3.75714 0.445 3.33333 1 3.33333H1.5V2.38095C1.5 1.74948 1.76339 1.14388 2.23223 0.697365C2.70107 0.25085 3.33696 0 4 0C4.3283 0 4.65339 0.0615852 4.95671 0.181239C5.26002 0.300893 5.53562 0.476273 5.76777 0.697365C5.99991 0.918457 6.18406 1.18093 6.3097 1.4698C6.43534 1.75867 6.5 2.06828 6.5 2.38095V3.33333H7ZM4 0.952381C3.60218 0.952381 3.22064 1.10289 2.93934 1.3708C2.65804 1.63871 2.5 2.00207 2.5 2.38095V3.33333H5.5V2.38095C5.5 2.00207 5.34196 1.63871 5.06066 1.3708C4.77936 1.10289 4.39782 0.952381 4 0.952381Z"
                                                                            fill="white" />
                                                                    </svg>
                                                                </button>
                                                            </div>
                                                        </div>

                                                        <h2 class="name">Furs & Co. Studio</h2>
                                                        <p class="hosted-by">Hosted by <span>Dev É.</span></p>

                                                        <div
                                                            class="studio-details mt-1 d-flex flex-column justify-content-between mt-2">

                                                            <div
                                                                class="meta d-flex align-items-center justify-content-between">
                                                                <div class="distance" title="Distance">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="10"
                                                                        height="14" viewBox="0 0 10 14" fill="none">
                                                                        <path
                                                                            d="M5 6.65C4.5264 6.65 4.0722 6.46563 3.73731 6.13744C3.40242 5.80925 3.21429 5.36413 3.21429 4.9C3.21429 4.43587 3.40242 3.99075 3.73731 3.66256C4.0722 3.33437 4.5264 3.15 5 3.15C5.4736 3.15 5.9278 3.33437 6.26269 3.66256C6.59758 3.99075 6.78571 4.43587 6.78571 4.9C6.78571 5.12981 6.73953 5.35738 6.64979 5.5697C6.56004 5.78202 6.42851 5.97493 6.26269 6.13744C6.09687 6.29994 5.90002 6.42884 5.68336 6.51679C5.46671 6.60473 5.2345 6.65 5 6.65ZM5 0C3.67392 0 2.40215 0.516248 1.46447 1.43518C0.526784 2.3541 0 3.60044 0 4.9C0 8.575 5 14 5 14C5 14 10 8.575 10 4.9C10 3.60044 9.47322 2.3541 8.53553 1.43518C7.59785 0.516248 6.32608 0 5 0Z"
                                                                            fill="var(--active-bg)" />
                                                                    </svg>
                                                                    <span>2.5 mi</span>
                                                                </div>


                                                                <div class="rating" title="Rating">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="14"
                                                                        height="14" viewBox="0 0 14 14" fill="none">
                                                                        <path
                                                                            d="M6.12956 0.660476C6.40354 -0.220161 7.59647 -0.220158 7.87045 0.660479L8.89548 3.95519C9.01801 4.34902 9.36942 4.61566 9.76593 4.61566H13.083C13.9696 4.61566 14.3383 5.80055 13.621 6.34481L10.9374 8.38106C10.6166 8.62446 10.4824 9.0559 10.6049 9.44973L11.63 12.7444C11.9039 13.6251 10.9388 14.3574 10.2215 13.8131L7.53797 11.7769C7.21719 11.5335 6.78282 11.5335 6.46204 11.7769L3.77846 13.8131C3.06117 14.3574 2.09607 13.6251 2.37005 12.7444L3.39508 9.44973C3.51761 9.0559 3.38338 8.62446 3.0626 8.38106L0.37903 6.34481C-0.338258 5.80055 0.0303816 4.61566 0.916998 4.61566H4.23408C4.63058 4.61566 4.98199 4.34902 5.10452 3.95519L6.12956 0.660476Z"
                                                                            fill="var(--active-bg)" />
                                                                    </svg>
                                                                    <span>4.3 <small
                                                                            style="color:var(--muted)">(20)</small></span>
                                                                </div>
                                                            </div>
                                                        </div>



                                                        <p class="experience">Professional grooming spaces in <br>
                                                            London.
                                                            Spotless, well-equipped, easy <br> to access.</p>


                                                        <p class="amenities d-flex">
                                                            <b>Amenities:</b>&nbsp;Bath &#8226; Table &#8226; Dryer ...
                                                        </p>


                                                        <div class="availability mt-3">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="15"
                                                                height="15" viewBox="0 0 15 15" fill="none">
                                                                <path
                                                                    d="M7.5 0C3.375 0 0 3.375 0 7.5C0 11.625 3.375 15 7.5 15C11.625 15 15 11.625 15 7.5C15 3.375 11.625 0 7.5 0ZM6 11.25L2.25 7.5L3.3075 6.4425L6 9.1275L11.6925 3.435L12.75 4.5L6 11.25Z"
                                                                    fill="#D8E8B7" />
                                                            </svg>
                                                            <span>Availability</span>
                                                        </div>


                                                        <div class="slots-price d-flex flex-column">
                                                            <div class="slots d-flex flex-column"
                                                                aria-label="Available slots">
                                                                <div class="slot highlight">Mon 1, 08:30 AM</div>
                                                                <div class="slot">Wed 27, 09:15 AM</div>
                                                            </div>
                                                            <div class="price">From <span>£38</span> <span
                                                                    class="time-frame">/ hour</span></div>
                                                        </div>



                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 text-center section-gap">
                                            <button class="load-more">Load More</button>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 map-col">
                                        <div class="map-wrapper">
                                            <div id="space-map"></div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </section>
                    </div>

                    <div data-tab-content="space-list-view" class="tabcontent" style="display: none;">
                        <section class="section-gap">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-1"></div>
                                    <div class="col-lg-10">
                                        <div class="card space-cards-list-view mt-3">
                                            <div class="left">
                                                <div class="top-left-svg">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="21" height="22"
                                                        viewBox="0 0 21 22" fill="none">
                                                        <rect x="4.14746" y="4.14746" width="12.443" height="13.8256"
                                                            rx="3" fill="white" />
                                                        <path
                                                            d="M10.9482 0.125295C10.7667 0.043205 10.5723 0 10.3692 0C10.1662 0 9.97174 0.043205 9.79028 0.125295L1.65477 3.57738C0.704262 3.97918 -0.00430085 4.91673 1.96518e-05 6.0487C0.0216222 10.3346 1.78439 18.1764 9.22861 21.7408C9.95014 22.0864 10.7883 22.0864 11.5098 21.7408C18.9541 18.1764 20.7168 10.3346 20.7384 6.0487C20.7428 4.91673 20.0342 3.97918 19.0837 3.57738L10.9482 0.125295ZM6.26043 12.3653C6.46781 12.4171 6.68816 12.443 6.91282 12.443C8.43796 12.443 9.67795 11.2031 9.67795 9.67793V6.9128H11.5876C12.1104 6.9128 12.59 7.2066 12.8233 7.67753L13.1343 8.29537H15.8995C16.2797 8.29537 16.5907 8.60644 16.5907 8.98665V10.3692C16.5907 12.2789 15.044 13.8256 13.1343 13.8256H11.0605V16.0161C11.0605 16.3315 10.8056 16.5907 10.4859 16.5907C10.4081 16.5907 10.3303 16.5734 10.2612 16.5432L5.99688 14.7156C5.71172 14.5947 5.53026 14.3138 5.53026 14.0071C5.53026 13.8861 5.55619 13.7694 5.61235 13.6614L6.26043 12.3653ZM6.22154 6.9128H8.29538V9.67793C8.29538 10.4427 7.67755 11.0605 6.91282 11.0605C6.1481 11.0605 5.53026 10.4427 5.53026 9.67793V7.60408C5.53026 7.22388 5.84134 6.9128 6.22154 6.9128ZM11.7518 8.98665C11.7518 8.80331 11.679 8.62748 11.5493 8.49784C11.4197 8.3682 11.2438 8.29537 11.0605 8.29537C10.8772 8.29537 10.7013 8.3682 10.5717 8.49784C10.4421 8.62748 10.3692 8.80331 10.3692 8.98665C10.3692 9.16998 10.4421 9.34581 10.5717 9.47545C10.7013 9.60509 10.8772 9.67793 11.0605 9.67793C11.2438 9.67793 11.4197 9.60509 11.5493 9.47545C11.679 9.34581 11.7518 9.16998 11.7518 8.98665Z"
                                                            fill="#C9DDA0" />
                                                    </svg>
                                                </div>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="312" height="229"
                                                    viewBox="0 0 312 229" fill="none">

                                                    <defs>
                                                        <pattern id="pattern-card-10" patternUnits="userSpaceOnUse"
                                                            width="312" height="229">
                                                            <image href="assets/images/space_card3.png" width="312"
                                                                height="229" preserveAspectRatio="xMidYMid slice" />
                                                        </pattern>
                                                    </defs>

                                                    <path
                                                        d="M312 224C312 226.761 309.761 229 307 229H5.00001C2.23858 229 0 226.761 0 224V37.1406C0 34.3792 2.23858 32.1406 5 32.1406H27C29.7614 32.1406 32 29.902 32 27.1406V5C32 2.23858 34.2386 0 37 0H307C309.761 0 312 2.23858 312 5V224Z"
                                                        fill="url(#pattern-card-10)" />
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
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="10"
                                                                height="9" viewBox="0 0 10 9" fill="none">
                                                                <path
                                                                    d="M2 8.99999C1.85833 8.99999 1.73967 8.95199 1.644 8.85599C1.54833 8.75999 1.50033 8.64133 1.5 8.49999C1.49967 8.35866 1.54767 8.23999 1.644 8.14399C1.74033 8.04799 1.859 7.99999 2 7.99999H8C8.14166 7.99999 8.2605 8.04799 8.3565 8.14399C8.4525 8.23999 8.50033 8.35866 8.5 8.49999C8.49966 8.64133 8.45166 8.76016 8.356 8.85649C8.26033 8.95283 8.14166 9.00066 8 8.99999H2ZM2.35 7.24999C2.10833 7.24999 1.89383 7.17083 1.7065 7.0125C1.51917 6.85416 1.4045 6.65416 1.3625 6.4125L0.862501 3.2375C0.845834 3.2375 0.827167 3.23967 0.806501 3.244C0.785834 3.24833 0.767001 3.25033 0.750001 3.25C0.541667 3.25 0.364668 3.17717 0.219001 3.0315C0.0733344 2.88583 0.000334469 2.70867 1.13636e-06 2.5C-0.000332197 2.29133 0.0726677 2.11433 0.219001 1.969C0.365334 1.82367 0.542334 1.75067 0.750001 1.75C0.957667 1.74933 1.13483 1.82233 1.2815 1.969C1.42817 2.11567 1.501 2.29267 1.5 2.5C1.5 2.55833 1.49367 2.6125 1.481 2.6625C1.46833 2.7125 1.45383 2.75833 1.4375 2.8L3 3.5L4.5625 1.3625C4.47083 1.29583 4.39583 1.20833 4.3375 1.1C4.27917 0.991667 4.25 0.875 4.25 0.75C4.25 0.541667 4.323 0.364501 4.469 0.218501C4.615 0.0725011 4.792 -0.000332194 5 1.13895e-06C5.208 0.000334472 5.38516 0.0733344 5.5315 0.219001C5.67783 0.364667 5.75066 0.541667 5.75 0.75C5.75 0.875 5.72083 0.991667 5.6625 1.1C5.60416 1.20833 5.52916 1.29583 5.4375 1.3625L7 3.5L8.5625 2.8C8.54583 2.75833 8.53116 2.7125 8.5185 2.6625C8.50583 2.6125 8.49966 2.55833 8.5 2.5C8.5 2.29167 8.573 2.1145 8.719 1.9685C8.865 1.8225 9.042 1.74967 9.25 1.75C9.458 1.75033 9.63516 1.82333 9.7815 1.969C9.92783 2.11467 10.0007 2.29167 10 2.5C9.99933 2.70833 9.92649 2.8855 9.7815 3.0315C9.6365 3.1775 9.45933 3.25033 9.25 3.25C9.23333 3.25 9.21466 3.248 9.194 3.244C9.17333 3.24 9.1545 3.23783 9.1375 3.2375L8.6375 6.4125C8.59583 6.65416 8.48133 6.85416 8.294 7.0125C8.10666 7.17083 7.892 7.24999 7.65 7.24999H2.35ZM2.35 6.25H7.65L7.975 4.1625L7.4 4.4125C7.18333 4.50416 6.9625 4.52083 6.7375 4.4625C6.5125 4.40416 6.32916 4.27916 6.1875 4.0875L5 2.45L3.8125 4.0875C3.67083 4.27916 3.4875 4.40416 3.2625 4.4625C3.0375 4.52083 2.81667 4.50416 2.6 4.4125L2.025 4.1625L2.35 6.25Z"
                                                                    fill="white" />
                                                            </svg>
                                                        </button>
                                                        <button class="second-icon" title="Favourite">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="9"
                                                                height="11" viewBox="0 0 9 11" fill="none">
                                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                                    d="M3.79701 0.30821C3.81025 0.23997 3.84191 0.176658 3.88858 0.125138C3.93524 0.0736173 3.99512 0.0358558 4.06172 0.0159479C4.12832 -0.00396001 4.1991 -0.00525449 4.26638 0.0122049C4.33367 0.0296642 4.39489 0.0652111 4.4434 0.114991C4.56671 0.240837 4.80378 0.489988 5.04467 0.777274C5.28111 1.05884 5.53916 1.39761 5.68788 1.69951C5.8328 1.99443 5.98661 2.37578 6.10801 2.69421L6.67305 1.75354C6.70456 1.701 6.74826 1.65683 6.80046 1.62476C6.85265 1.59269 6.91181 1.57367 6.97292 1.56931C7.03402 1.56494 7.09528 1.57536 7.1515 1.59969C7.20773 1.62401 7.25727 1.66152 7.29592 1.70905C8.09867 2.70057 8.49846 3.76263 8.6974 4.57365C8.79718 4.97979 8.8474 5.32491 8.87282 5.57025C8.88576 5.69278 8.89424 5.81574 8.89824 5.93889V5.97131C8.89824 8.4482 6.93364 10.4649 4.44785 10.4649C1.96206 10.4649 0 8.44756 0 5.97004C0 5.28805 0.322244 3.68192 1.27563 2.36498C1.31266 2.31422 1.36166 2.27341 1.41826 2.24615C1.47487 2.2189 1.53734 2.20605 1.60011 2.20876C1.66287 2.21146 1.724 2.22963 1.77806 2.26166C1.83211 2.29368 1.87741 2.33856 1.90994 2.39231L2.55507 3.46709C2.75083 3.16073 3.01269 2.73044 3.21163 2.3332C3.49765 1.76117 3.72455 0.682572 3.79701 0.308845M4.3201 0.912655C4.20506 1.42113 4.01501 2.14697 3.77985 2.61858C3.46714 3.24336 3.0165 3.9298 2.86142 4.16051C2.82554 4.21345 2.77693 4.25651 2.72005 4.28574C2.66317 4.31497 2.59986 4.32943 2.53593 4.32778C2.472 4.32614 2.40952 4.30844 2.35422 4.27632C2.29892 4.24421 2.25258 4.1987 2.21948 4.14399L1.57118 3.06476C0.87457 4.19166 0.635589 5.45839 0.635589 5.97131C0.635589 8.10561 2.32244 9.82806 4.44785 9.82806C6.57326 9.82806 8.26265 8.10561 8.26265 5.97131V5.95351L8.26011 5.88995C8.25568 5.80484 8.24911 5.71986 8.24041 5.63508C8.20712 5.3287 8.15362 5.02487 8.08024 4.72555C7.87826 3.89157 7.52027 3.10334 7.02516 2.40248L6.38068 3.47535C6.34338 3.53732 6.28925 3.58743 6.22459 3.61985C6.15993 3.65227 6.08739 3.66566 6.01542 3.65847C5.94344 3.65128 5.87499 3.6238 5.81802 3.57923C5.76105 3.53466 5.71791 3.47483 5.6936 3.40671C5.59064 3.11815 5.33831 2.42917 5.11713 1.98044C5.00463 1.751 4.78916 1.46117 4.55781 1.18596C4.4801 1.09353 4.40086 1.00242 4.3201 0.912655Z"
                                                                    fill="#FEFEFE" />
                                                            </svg>
                                                        </button>
                                                        <button class="third-icon" title="lock">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="8"
                                                                height="10" viewBox="0 0 8 10" fill="none">
                                                                <path
                                                                    d="M4 7.61905C3.73478 7.61905 3.48043 7.51871 3.29289 7.3401C3.10536 7.1615 3 6.91925 3 6.66667C3 6.1381 3.445 5.71429 4 5.71429C4.26522 5.71429 4.51957 5.81463 4.70711 5.99323C4.89464 6.17184 5 6.41408 5 6.66667C5 6.91925 4.89464 7.1615 4.70711 7.3401C4.51957 7.51871 4.26522 7.61905 4 7.61905ZM7 9.04762V4.28571H1V9.04762H7ZM7 3.33333C7.26522 3.33333 7.51957 3.43367 7.70711 3.61228C7.89464 3.79089 8 4.03313 8 4.28571V9.04762C8 9.30021 7.89464 9.54245 7.70711 9.72105C7.51957 9.89966 7.26522 10 7 10H1C0.734784 10 0.48043 9.89966 0.292893 9.72105C0.105357 9.54245 0 9.30021 0 9.04762V4.28571C0 3.75714 0.445 3.33333 1 3.33333H1.5V2.38095C1.5 1.74948 1.76339 1.14388 2.23223 0.697365C2.70107 0.25085 3.33696 0 4 0C4.3283 0 4.65339 0.0615852 4.95671 0.181239C5.26002 0.300893 5.53562 0.476273 5.76777 0.697365C5.99991 0.918457 6.18406 1.18093 6.3097 1.4698C6.43534 1.75867 6.5 2.06828 6.5 2.38095V3.33333H7ZM4 0.952381C3.60218 0.952381 3.22064 1.10289 2.93934 1.3708C2.65804 1.63871 2.5 2.00207 2.5 2.38095V3.33333H5.5V2.38095C5.5 2.00207 5.34196 1.63871 5.06066 1.3708C4.77936 1.10289 4.39782 0.952381 4 0.952381Z"
                                                                    fill="white" />
                                                            </svg>
                                                        </button>
                                                    </div>
                                                </div>



                                                <div
                                                    class="studio-details mt-1 d-flex align-items-center justify-content-between">

                                                    <div class="studio">
                                                        <h2 class="name">The Garden Grooming Spot</h2>
                                                        <p class="hosted-by">Hosted by <span>Chloe D.</span></p>
                                                    </div>

                                                    <div class="meta d-flex align-items-center justify-content-between">
                                                        <div class="distance" title="Distance">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="10"
                                                                height="14" viewBox="0 0 10 14" fill="none">
                                                                <path
                                                                    d="M5 6.65C4.5264 6.65 4.0722 6.46563 3.73731 6.13744C3.40242 5.80925 3.21429 5.36413 3.21429 4.9C3.21429 4.43587 3.40242 3.99075 3.73731 3.66256C4.0722 3.33437 4.5264 3.15 5 3.15C5.4736 3.15 5.9278 3.33437 6.26269 3.66256C6.59758 3.99075 6.78571 4.43587 6.78571 4.9C6.78571 5.12981 6.73953 5.35738 6.64979 5.5697C6.56004 5.78202 6.42851 5.97493 6.26269 6.13744C6.09687 6.29994 5.90002 6.42884 5.68336 6.51679C5.46671 6.60473 5.2345 6.65 5 6.65ZM5 0C3.67392 0 2.40215 0.516248 1.46447 1.43518C0.526784 2.3541 0 3.60044 0 4.9C0 8.575 5 14 5 14C5 14 10 8.575 10 4.9C10 3.60044 9.47322 2.3541 8.53553 1.43518C7.59785 0.516248 6.32608 0 5 0Z"
                                                                    fill="var(--active-bg)" />
                                                            </svg>
                                                            <span>2.5 mi</span>
                                                        </div>


                                                        <div class="rating" title="Rating">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="14"
                                                                height="14" viewBox="0 0 14 14" fill="none">
                                                                <path
                                                                    d="M6.12956 0.660476C6.40354 -0.220161 7.59647 -0.220158 7.87045 0.660479L8.89548 3.95519C9.01801 4.34902 9.36942 4.61566 9.76593 4.61566H13.083C13.9696 4.61566 14.3383 5.80055 13.621 6.34481L10.9374 8.38106C10.6166 8.62446 10.4824 9.0559 10.6049 9.44973L11.63 12.7444C11.9039 13.6251 10.9388 14.3574 10.2215 13.8131L7.53797 11.7769C7.21719 11.5335 6.78282 11.5335 6.46204 11.7769L3.77846 13.8131C3.06117 14.3574 2.09607 13.6251 2.37005 12.7444L3.39508 9.44973C3.51761 9.0559 3.38338 8.62446 3.0626 8.38106L0.37903 6.34481C-0.338258 5.80055 0.0303816 4.61566 0.916998 4.61566H4.23408C4.63058 4.61566 4.98199 4.34902 5.10452 3.95519L6.12956 0.660476Z"
                                                                    fill="var(--active-bg)" />
                                                            </svg>
                                                            <span>4.3 <small
                                                                    style="color:var(--muted)">(20)</small></span>
                                                        </div>
                                                    </div>
                                                </div>



                                                <p class="list-view-desc">Outdoor garden grooming area. Calm, spacious,
                                                    and
                                                    ideal for stress-free sessions in fresh air.</p>


                                                <p class="amenities d-flex">
                                                    <b>Amenities:</b>&nbsp;Bath &#8226; Table &#8226; Dryer ...
                                                </p>

                                                <div class="availability">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15"
                                                        viewBox="0 0 15 15" fill="none">
                                                        <path
                                                            d="M7.5 0C3.375 0 0 3.375 0 7.5C0 11.625 3.375 15 7.5 15C11.625 15 15 11.625 15 7.5C15 3.375 11.625 0 7.5 0ZM6 11.25L2.25 7.5L3.3075 6.4425L6 9.1275L11.6925 3.435L12.75 4.5L6 11.25Z"
                                                            fill="#D8E8B7" />
                                                    </svg>
                                                    <span>Availability</span>
                                                </div>


                                                <div class="slots-price d-flex align-items-center">
                                                    <div class="slots d-flex" aria-label="Available slots">
                                                        <div class="slot highlight">Mon 1, 08:30 AM</div>
                                                        <div class="slot">Wed 27, 09:15 AM</div>
                                                    </div>
                                                    <div class="price">From <span>£38</span> <span class="time-frame">/
                                                            hour</span></div>
                                                </div>



                                            </div>
                                        </div>
                                        <div class="card space-cards-list-view mt-3">
                                            <div class="left">
                                                <div class="top-left-svg">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="21" height="22"
                                                        viewBox="0 0 21 22" fill="none">
                                                        <rect x="4.14746" y="4.14746" width="12.443" height="13.8256"
                                                            rx="3" fill="white" />
                                                        <path
                                                            d="M10.9482 0.125295C10.7667 0.043205 10.5723 0 10.3692 0C10.1662 0 9.97174 0.043205 9.79028 0.125295L1.65477 3.57738C0.704262 3.97918 -0.00430085 4.91673 1.96518e-05 6.0487C0.0216222 10.3346 1.78439 18.1764 9.22861 21.7408C9.95014 22.0864 10.7883 22.0864 11.5098 21.7408C18.9541 18.1764 20.7168 10.3346 20.7384 6.0487C20.7428 4.91673 20.0342 3.97918 19.0837 3.57738L10.9482 0.125295ZM6.26043 12.3653C6.46781 12.4171 6.68816 12.443 6.91282 12.443C8.43796 12.443 9.67795 11.2031 9.67795 9.67793V6.9128H11.5876C12.1104 6.9128 12.59 7.2066 12.8233 7.67753L13.1343 8.29537H15.8995C16.2797 8.29537 16.5907 8.60644 16.5907 8.98665V10.3692C16.5907 12.2789 15.044 13.8256 13.1343 13.8256H11.0605V16.0161C11.0605 16.3315 10.8056 16.5907 10.4859 16.5907C10.4081 16.5907 10.3303 16.5734 10.2612 16.5432L5.99688 14.7156C5.71172 14.5947 5.53026 14.3138 5.53026 14.0071C5.53026 13.8861 5.55619 13.7694 5.61235 13.6614L6.26043 12.3653ZM6.22154 6.9128H8.29538V9.67793C8.29538 10.4427 7.67755 11.0605 6.91282 11.0605C6.1481 11.0605 5.53026 10.4427 5.53026 9.67793V7.60408C5.53026 7.22388 5.84134 6.9128 6.22154 6.9128ZM11.7518 8.98665C11.7518 8.80331 11.679 8.62748 11.5493 8.49784C11.4197 8.3682 11.2438 8.29537 11.0605 8.29537C10.8772 8.29537 10.7013 8.3682 10.5717 8.49784C10.4421 8.62748 10.3692 8.80331 10.3692 8.98665C10.3692 9.16998 10.4421 9.34581 10.5717 9.47545C10.7013 9.60509 10.8772 9.67793 11.0605 9.67793C11.2438 9.67793 11.4197 9.60509 11.5493 9.47545C11.679 9.34581 11.7518 9.16998 11.7518 8.98665Z"
                                                            fill="#C9DDA0" />
                                                    </svg>
                                                </div>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="312" height="229"
                                                    viewBox="0 0 312 229" fill="none">

                                                    <defs>
                                                        <pattern id="pattern-card-11" patternUnits="userSpaceOnUse"
                                                            width="312" height="229">
                                                            <image href="assets/images/space_card2.png" width="312"
                                                                height="229" preserveAspectRatio="xMidYMid slice" />
                                                        </pattern>
                                                    </defs>

                                                    <path
                                                        d="M312 224C312 226.761 309.761 229 307 229H5.00001C2.23858 229 0 226.761 0 224V37.1406C0 34.3792 2.23858 32.1406 5 32.1406H27C29.7614 32.1406 32 29.902 32 27.1406V5C32 2.23858 34.2386 0 37 0H307C309.761 0 312 2.23858 312 5V224Z"
                                                        fill="url(#pattern-card-11)" />
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
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="10"
                                                                height="9" viewBox="0 0 10 9" fill="none">
                                                                <path
                                                                    d="M2 8.99999C1.85833 8.99999 1.73967 8.95199 1.644 8.85599C1.54833 8.75999 1.50033 8.64133 1.5 8.49999C1.49967 8.35866 1.54767 8.23999 1.644 8.14399C1.74033 8.04799 1.859 7.99999 2 7.99999H8C8.14166 7.99999 8.2605 8.04799 8.3565 8.14399C8.4525 8.23999 8.50033 8.35866 8.5 8.49999C8.49966 8.64133 8.45166 8.76016 8.356 8.85649C8.26033 8.95283 8.14166 9.00066 8 8.99999H2ZM2.35 7.24999C2.10833 7.24999 1.89383 7.17083 1.7065 7.0125C1.51917 6.85416 1.4045 6.65416 1.3625 6.4125L0.862501 3.2375C0.845834 3.2375 0.827167 3.23967 0.806501 3.244C0.785834 3.24833 0.767001 3.25033 0.750001 3.25C0.541667 3.25 0.364668 3.17717 0.219001 3.0315C0.0733344 2.88583 0.000334469 2.70867 1.13636e-06 2.5C-0.000332197 2.29133 0.0726677 2.11433 0.219001 1.969C0.365334 1.82367 0.542334 1.75067 0.750001 1.75C0.957667 1.74933 1.13483 1.82233 1.2815 1.969C1.42817 2.11567 1.501 2.29267 1.5 2.5C1.5 2.55833 1.49367 2.6125 1.481 2.6625C1.46833 2.7125 1.45383 2.75833 1.4375 2.8L3 3.5L4.5625 1.3625C4.47083 1.29583 4.39583 1.20833 4.3375 1.1C4.27917 0.991667 4.25 0.875 4.25 0.75C4.25 0.541667 4.323 0.364501 4.469 0.218501C4.615 0.0725011 4.792 -0.000332194 5 1.13895e-06C5.208 0.000334472 5.38516 0.0733344 5.5315 0.219001C5.67783 0.364667 5.75066 0.541667 5.75 0.75C5.75 0.875 5.72083 0.991667 5.6625 1.1C5.60416 1.20833 5.52916 1.29583 5.4375 1.3625L7 3.5L8.5625 2.8C8.54583 2.75833 8.53116 2.7125 8.5185 2.6625C8.50583 2.6125 8.49966 2.55833 8.5 2.5C8.5 2.29167 8.573 2.1145 8.719 1.9685C8.865 1.8225 9.042 1.74967 9.25 1.75C9.458 1.75033 9.63516 1.82333 9.7815 1.969C9.92783 2.11467 10.0007 2.29167 10 2.5C9.99933 2.70833 9.92649 2.8855 9.7815 3.0315C9.6365 3.1775 9.45933 3.25033 9.25 3.25C9.23333 3.25 9.21466 3.248 9.194 3.244C9.17333 3.24 9.1545 3.23783 9.1375 3.2375L8.6375 6.4125C8.59583 6.65416 8.48133 6.85416 8.294 7.0125C8.10666 7.17083 7.892 7.24999 7.65 7.24999H2.35ZM2.35 6.25H7.65L7.975 4.1625L7.4 4.4125C7.18333 4.50416 6.9625 4.52083 6.7375 4.4625C6.5125 4.40416 6.32916 4.27916 6.1875 4.0875L5 2.45L3.8125 4.0875C3.67083 4.27916 3.4875 4.40416 3.2625 4.4625C3.0375 4.52083 2.81667 4.50416 2.6 4.4125L2.025 4.1625L2.35 6.25Z"
                                                                    fill="white" />
                                                            </svg>
                                                        </button>
                                                        <button class="second-icon" title="Favourite">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="9"
                                                                height="11" viewBox="0 0 9 11" fill="none">
                                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                                    d="M3.79701 0.30821C3.81025 0.23997 3.84191 0.176658 3.88858 0.125138C3.93524 0.0736173 3.99512 0.0358558 4.06172 0.0159479C4.12832 -0.00396001 4.1991 -0.00525449 4.26638 0.0122049C4.33367 0.0296642 4.39489 0.0652111 4.4434 0.114991C4.56671 0.240837 4.80378 0.489988 5.04467 0.777274C5.28111 1.05884 5.53916 1.39761 5.68788 1.69951C5.8328 1.99443 5.98661 2.37578 6.10801 2.69421L6.67305 1.75354C6.70456 1.701 6.74826 1.65683 6.80046 1.62476C6.85265 1.59269 6.91181 1.57367 6.97292 1.56931C7.03402 1.56494 7.09528 1.57536 7.1515 1.59969C7.20773 1.62401 7.25727 1.66152 7.29592 1.70905C8.09867 2.70057 8.49846 3.76263 8.6974 4.57365C8.79718 4.97979 8.8474 5.32491 8.87282 5.57025C8.88576 5.69278 8.89424 5.81574 8.89824 5.93889V5.97131C8.89824 8.4482 6.93364 10.4649 4.44785 10.4649C1.96206 10.4649 0 8.44756 0 5.97004C0 5.28805 0.322244 3.68192 1.27563 2.36498C1.31266 2.31422 1.36166 2.27341 1.41826 2.24615C1.47487 2.2189 1.53734 2.20605 1.60011 2.20876C1.66287 2.21146 1.724 2.22963 1.77806 2.26166C1.83211 2.29368 1.87741 2.33856 1.90994 2.39231L2.55507 3.46709C2.75083 3.16073 3.01269 2.73044 3.21163 2.3332C3.49765 1.76117 3.72455 0.682572 3.79701 0.308845M4.3201 0.912655C4.20506 1.42113 4.01501 2.14697 3.77985 2.61858C3.46714 3.24336 3.0165 3.9298 2.86142 4.16051C2.82554 4.21345 2.77693 4.25651 2.72005 4.28574C2.66317 4.31497 2.59986 4.32943 2.53593 4.32778C2.472 4.32614 2.40952 4.30844 2.35422 4.27632C2.29892 4.24421 2.25258 4.1987 2.21948 4.14399L1.57118 3.06476C0.87457 4.19166 0.635589 5.45839 0.635589 5.97131C0.635589 8.10561 2.32244 9.82806 4.44785 9.82806C6.57326 9.82806 8.26265 8.10561 8.26265 5.97131V5.95351L8.26011 5.88995C8.25568 5.80484 8.24911 5.71986 8.24041 5.63508C8.20712 5.3287 8.15362 5.02487 8.08024 4.72555C7.87826 3.89157 7.52027 3.10334 7.02516 2.40248L6.38068 3.47535C6.34338 3.53732 6.28925 3.58743 6.22459 3.61985C6.15993 3.65227 6.08739 3.66566 6.01542 3.65847C5.94344 3.65128 5.87499 3.6238 5.81802 3.57923C5.76105 3.53466 5.71791 3.47483 5.6936 3.40671C5.59064 3.11815 5.33831 2.42917 5.11713 1.98044C5.00463 1.751 4.78916 1.46117 4.55781 1.18596C4.4801 1.09353 4.40086 1.00242 4.3201 0.912655Z"
                                                                    fill="#FEFEFE" />
                                                            </svg>
                                                        </button>
                                                        <button class="third-icon" title="lock">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="8"
                                                                height="10" viewBox="0 0 8 10" fill="none">
                                                                <path
                                                                    d="M4 7.61905C3.73478 7.61905 3.48043 7.51871 3.29289 7.3401C3.10536 7.1615 3 6.91925 3 6.66667C3 6.1381 3.445 5.71429 4 5.71429C4.26522 5.71429 4.51957 5.81463 4.70711 5.99323C4.89464 6.17184 5 6.41408 5 6.66667C5 6.91925 4.89464 7.1615 4.70711 7.3401C4.51957 7.51871 4.26522 7.61905 4 7.61905ZM7 9.04762V4.28571H1V9.04762H7ZM7 3.33333C7.26522 3.33333 7.51957 3.43367 7.70711 3.61228C7.89464 3.79089 8 4.03313 8 4.28571V9.04762C8 9.30021 7.89464 9.54245 7.70711 9.72105C7.51957 9.89966 7.26522 10 7 10H1C0.734784 10 0.48043 9.89966 0.292893 9.72105C0.105357 9.54245 0 9.30021 0 9.04762V4.28571C0 3.75714 0.445 3.33333 1 3.33333H1.5V2.38095C1.5 1.74948 1.76339 1.14388 2.23223 0.697365C2.70107 0.25085 3.33696 0 4 0C4.3283 0 4.65339 0.0615852 4.95671 0.181239C5.26002 0.300893 5.53562 0.476273 5.76777 0.697365C5.99991 0.918457 6.18406 1.18093 6.3097 1.4698C6.43534 1.75867 6.5 2.06828 6.5 2.38095V3.33333H7ZM4 0.952381C3.60218 0.952381 3.22064 1.10289 2.93934 1.3708C2.65804 1.63871 2.5 2.00207 2.5 2.38095V3.33333H5.5V2.38095C5.5 2.00207 5.34196 1.63871 5.06066 1.3708C4.77936 1.10289 4.39782 0.952381 4 0.952381Z"
                                                                    fill="white" />
                                                            </svg>
                                                        </button>
                                                    </div>
                                                </div>



                                                <div
                                                    class="studio-details mt-1 d-flex align-items-center justify-content-between">

                                                    <div class="studio">
                                                        <h2 class="name">Paws & Bubbles</h2>
                                                        <p class="hosted-by">Hosted by <span>Patrick B.</span></p>
                                                    </div>

                                                    <div class="meta d-flex align-items-center justify-content-between">
                                                        <div class="distance" title="Distance">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="10"
                                                                height="14" viewBox="0 0 10 14" fill="none">
                                                                <path
                                                                    d="M5 6.65C4.5264 6.65 4.0722 6.46563 3.73731 6.13744C3.40242 5.80925 3.21429 5.36413 3.21429 4.9C3.21429 4.43587 3.40242 3.99075 3.73731 3.66256C4.0722 3.33437 4.5264 3.15 5 3.15C5.4736 3.15 5.9278 3.33437 6.26269 3.66256C6.59758 3.99075 6.78571 4.43587 6.78571 4.9C6.78571 5.12981 6.73953 5.35738 6.64979 5.5697C6.56004 5.78202 6.42851 5.97493 6.26269 6.13744C6.09687 6.29994 5.90002 6.42884 5.68336 6.51679C5.46671 6.60473 5.2345 6.65 5 6.65ZM5 0C3.67392 0 2.40215 0.516248 1.46447 1.43518C0.526784 2.3541 0 3.60044 0 4.9C0 8.575 5 14 5 14C5 14 10 8.575 10 4.9C10 3.60044 9.47322 2.3541 8.53553 1.43518C7.59785 0.516248 6.32608 0 5 0Z"
                                                                    fill="var(--active-bg)" />
                                                            </svg>
                                                            <span>2.5 mi</span>
                                                        </div>


                                                        <div class="rating" title="Rating">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="14"
                                                                height="14" viewBox="0 0 14 14" fill="none">
                                                                <path
                                                                    d="M6.12956 0.660476C6.40354 -0.220161 7.59647 -0.220158 7.87045 0.660479L8.89548 3.95519C9.01801 4.34902 9.36942 4.61566 9.76593 4.61566H13.083C13.9696 4.61566 14.3383 5.80055 13.621 6.34481L10.9374 8.38106C10.6166 8.62446 10.4824 9.0559 10.6049 9.44973L11.63 12.7444C11.9039 13.6251 10.9388 14.3574 10.2215 13.8131L7.53797 11.7769C7.21719 11.5335 6.78282 11.5335 6.46204 11.7769L3.77846 13.8131C3.06117 14.3574 2.09607 13.6251 2.37005 12.7444L3.39508 9.44973C3.51761 9.0559 3.38338 8.62446 3.0626 8.38106L0.37903 6.34481C-0.338258 5.80055 0.0303816 4.61566 0.916998 4.61566H4.23408C4.63058 4.61566 4.98199 4.34902 5.10452 3.95519L6.12956 0.660476Z"
                                                                    fill="var(--active-bg)" />
                                                            </svg>
                                                            <span>4.3 <small
                                                                    style="color:var(--muted)">(20)</small></span>
                                                        </div>
                                                    </div>
                                                </div>



                                                <p class="list-view-desc">Fully equipped mobile grooming van. Clean,
                                                    convenient, and perfect for on-the-go appointments!</p>


                                                <p class="amenities d-flex">
                                                    <b>Amenities:</b>&nbsp;Bath &#8226; Table &#8226; Dryer ...
                                                </p>

                                                <div class="availability">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15"
                                                        viewBox="0 0 15 15" fill="none">
                                                        <path
                                                            d="M7.5 0C3.375 0 0 3.375 0 7.5C0 11.625 3.375 15 7.5 15C11.625 15 15 11.625 15 7.5C15 3.375 11.625 0 7.5 0ZM6 11.25L2.25 7.5L3.3075 6.4425L6 9.1275L11.6925 3.435L12.75 4.5L6 11.25Z"
                                                            fill="#D8E8B7" />
                                                    </svg>
                                                    <span>Availability</span>
                                                </div>


                                                <div class="slots-price d-flex align-items-center">
                                                    <div class="slots d-flex" aria-label="Available slots">
                                                        <div class="slot highlight">Mon 1, 08:30 AM</div>
                                                        <div class="slot">Wed 27, 09:15 AM</div>
                                                    </div>
                                                    <div class="price">From <span>£38</span> <span class="time-frame">/
                                                            hour</span></div>
                                                </div>



                                            </div>
                                        </div>
                                        <div class="card space-cards-list-view mt-3">
                                            <div class="left">
                                                <div class="top-left-svg">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="21" height="22"
                                                        viewBox="0 0 21 22" fill="none">
                                                        <rect x="4.14746" y="4.14746" width="12.443" height="13.8256"
                                                            rx="3" fill="white" />
                                                        <path
                                                            d="M10.9482 0.125295C10.7667 0.043205 10.5723 0 10.3692 0C10.1662 0 9.97174 0.043205 9.79028 0.125295L1.65477 3.57738C0.704262 3.97918 -0.00430085 4.91673 1.96518e-05 6.0487C0.0216222 10.3346 1.78439 18.1764 9.22861 21.7408C9.95014 22.0864 10.7883 22.0864 11.5098 21.7408C18.9541 18.1764 20.7168 10.3346 20.7384 6.0487C20.7428 4.91673 20.0342 3.97918 19.0837 3.57738L10.9482 0.125295ZM6.26043 12.3653C6.46781 12.4171 6.68816 12.443 6.91282 12.443C8.43796 12.443 9.67795 11.2031 9.67795 9.67793V6.9128H11.5876C12.1104 6.9128 12.59 7.2066 12.8233 7.67753L13.1343 8.29537H15.8995C16.2797 8.29537 16.5907 8.60644 16.5907 8.98665V10.3692C16.5907 12.2789 15.044 13.8256 13.1343 13.8256H11.0605V16.0161C11.0605 16.3315 10.8056 16.5907 10.4859 16.5907C10.4081 16.5907 10.3303 16.5734 10.2612 16.5432L5.99688 14.7156C5.71172 14.5947 5.53026 14.3138 5.53026 14.0071C5.53026 13.8861 5.55619 13.7694 5.61235 13.6614L6.26043 12.3653ZM6.22154 6.9128H8.29538V9.67793C8.29538 10.4427 7.67755 11.0605 6.91282 11.0605C6.1481 11.0605 5.53026 10.4427 5.53026 9.67793V7.60408C5.53026 7.22388 5.84134 6.9128 6.22154 6.9128ZM11.7518 8.98665C11.7518 8.80331 11.679 8.62748 11.5493 8.49784C11.4197 8.3682 11.2438 8.29537 11.0605 8.29537C10.8772 8.29537 10.7013 8.3682 10.5717 8.49784C10.4421 8.62748 10.3692 8.80331 10.3692 8.98665C10.3692 9.16998 10.4421 9.34581 10.5717 9.47545C10.7013 9.60509 10.8772 9.67793 11.0605 9.67793C11.2438 9.67793 11.4197 9.60509 11.5493 9.47545C11.679 9.34581 11.7518 9.16998 11.7518 8.98665Z"
                                                            fill="#C9DDA0" />
                                                    </svg>
                                                </div>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="312" height="229"
                                                    viewBox="0 0 312 229" fill="none">

                                                    <defs>
                                                        <pattern id="pattern-card-12" patternUnits="userSpaceOnUse"
                                                            width="312" height="229">
                                                            <image href="assets/images/space_card1.png" width="312"
                                                                height="229" preserveAspectRatio="xMidYMid slice" />
                                                        </pattern>
                                                    </defs>

                                                    <path
                                                        d="M312 224C312 226.761 309.761 229 307 229H5.00001C2.23858 229 0 226.761 0 224V37.1406C0 34.3792 2.23858 32.1406 5 32.1406H27C29.7614 32.1406 32 29.902 32 27.1406V5C32 2.23858 34.2386 0 37 0H307C309.761 0 312 2.23858 312 5V224Z"
                                                        fill="url(#pattern-card-12)" />
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
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="10"
                                                                height="9" viewBox="0 0 10 9" fill="none">
                                                                <path
                                                                    d="M2 8.99999C1.85833 8.99999 1.73967 8.95199 1.644 8.85599C1.54833 8.75999 1.50033 8.64133 1.5 8.49999C1.49967 8.35866 1.54767 8.23999 1.644 8.14399C1.74033 8.04799 1.859 7.99999 2 7.99999H8C8.14166 7.99999 8.2605 8.04799 8.3565 8.14399C8.4525 8.23999 8.50033 8.35866 8.5 8.49999C8.49966 8.64133 8.45166 8.76016 8.356 8.85649C8.26033 8.95283 8.14166 9.00066 8 8.99999H2ZM2.35 7.24999C2.10833 7.24999 1.89383 7.17083 1.7065 7.0125C1.51917 6.85416 1.4045 6.65416 1.3625 6.4125L0.862501 3.2375C0.845834 3.2375 0.827167 3.23967 0.806501 3.244C0.785834 3.24833 0.767001 3.25033 0.750001 3.25C0.541667 3.25 0.364668 3.17717 0.219001 3.0315C0.0733344 2.88583 0.000334469 2.70867 1.13636e-06 2.5C-0.000332197 2.29133 0.0726677 2.11433 0.219001 1.969C0.365334 1.82367 0.542334 1.75067 0.750001 1.75C0.957667 1.74933 1.13483 1.82233 1.2815 1.969C1.42817 2.11567 1.501 2.29267 1.5 2.5C1.5 2.55833 1.49367 2.6125 1.481 2.6625C1.46833 2.7125 1.45383 2.75833 1.4375 2.8L3 3.5L4.5625 1.3625C4.47083 1.29583 4.39583 1.20833 4.3375 1.1C4.27917 0.991667 4.25 0.875 4.25 0.75C4.25 0.541667 4.323 0.364501 4.469 0.218501C4.615 0.0725011 4.792 -0.000332194 5 1.13895e-06C5.208 0.000334472 5.38516 0.0733344 5.5315 0.219001C5.67783 0.364667 5.75066 0.541667 5.75 0.75C5.75 0.875 5.72083 0.991667 5.6625 1.1C5.60416 1.20833 5.52916 1.29583 5.4375 1.3625L7 3.5L8.5625 2.8C8.54583 2.75833 8.53116 2.7125 8.5185 2.6625C8.50583 2.6125 8.49966 2.55833 8.5 2.5C8.5 2.29167 8.573 2.1145 8.719 1.9685C8.865 1.8225 9.042 1.74967 9.25 1.75C9.458 1.75033 9.63516 1.82333 9.7815 1.969C9.92783 2.11467 10.0007 2.29167 10 2.5C9.99933 2.70833 9.92649 2.8855 9.7815 3.0315C9.6365 3.1775 9.45933 3.25033 9.25 3.25C9.23333 3.25 9.21466 3.248 9.194 3.244C9.17333 3.24 9.1545 3.23783 9.1375 3.2375L8.6375 6.4125C8.59583 6.65416 8.48133 6.85416 8.294 7.0125C8.10666 7.17083 7.892 7.24999 7.65 7.24999H2.35ZM2.35 6.25H7.65L7.975 4.1625L7.4 4.4125C7.18333 4.50416 6.9625 4.52083 6.7375 4.4625C6.5125 4.40416 6.32916 4.27916 6.1875 4.0875L5 2.45L3.8125 4.0875C3.67083 4.27916 3.4875 4.40416 3.2625 4.4625C3.0375 4.52083 2.81667 4.50416 2.6 4.4125L2.025 4.1625L2.35 6.25Z"
                                                                    fill="white" />
                                                            </svg>
                                                        </button>
                                                        <button class="second-icon" title="Favourite">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="9"
                                                                height="11" viewBox="0 0 9 11" fill="none">
                                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                                    d="M3.79701 0.30821C3.81025 0.23997 3.84191 0.176658 3.88858 0.125138C3.93524 0.0736173 3.99512 0.0358558 4.06172 0.0159479C4.12832 -0.00396001 4.1991 -0.00525449 4.26638 0.0122049C4.33367 0.0296642 4.39489 0.0652111 4.4434 0.114991C4.56671 0.240837 4.80378 0.489988 5.04467 0.777274C5.28111 1.05884 5.53916 1.39761 5.68788 1.69951C5.8328 1.99443 5.98661 2.37578 6.10801 2.69421L6.67305 1.75354C6.70456 1.701 6.74826 1.65683 6.80046 1.62476C6.85265 1.59269 6.91181 1.57367 6.97292 1.56931C7.03402 1.56494 7.09528 1.57536 7.1515 1.59969C7.20773 1.62401 7.25727 1.66152 7.29592 1.70905C8.09867 2.70057 8.49846 3.76263 8.6974 4.57365C8.79718 4.97979 8.8474 5.32491 8.87282 5.57025C8.88576 5.69278 8.89424 5.81574 8.89824 5.93889V5.97131C8.89824 8.4482 6.93364 10.4649 4.44785 10.4649C1.96206 10.4649 0 8.44756 0 5.97004C0 5.28805 0.322244 3.68192 1.27563 2.36498C1.31266 2.31422 1.36166 2.27341 1.41826 2.24615C1.47487 2.2189 1.53734 2.20605 1.60011 2.20876C1.66287 2.21146 1.724 2.22963 1.77806 2.26166C1.83211 2.29368 1.87741 2.33856 1.90994 2.39231L2.55507 3.46709C2.75083 3.16073 3.01269 2.73044 3.21163 2.3332C3.49765 1.76117 3.72455 0.682572 3.79701 0.308845M4.3201 0.912655C4.20506 1.42113 4.01501 2.14697 3.77985 2.61858C3.46714 3.24336 3.0165 3.9298 2.86142 4.16051C2.82554 4.21345 2.77693 4.25651 2.72005 4.28574C2.66317 4.31497 2.59986 4.32943 2.53593 4.32778C2.472 4.32614 2.40952 4.30844 2.35422 4.27632C2.29892 4.24421 2.25258 4.1987 2.21948 4.14399L1.57118 3.06476C0.87457 4.19166 0.635589 5.45839 0.635589 5.97131C0.635589 8.10561 2.32244 9.82806 4.44785 9.82806C6.57326 9.82806 8.26265 8.10561 8.26265 5.97131V5.95351L8.26011 5.88995C8.25568 5.80484 8.24911 5.71986 8.24041 5.63508C8.20712 5.3287 8.15362 5.02487 8.08024 4.72555C7.87826 3.89157 7.52027 3.10334 7.02516 2.40248L6.38068 3.47535C6.34338 3.53732 6.28925 3.58743 6.22459 3.61985C6.15993 3.65227 6.08739 3.66566 6.01542 3.65847C5.94344 3.65128 5.87499 3.6238 5.81802 3.57923C5.76105 3.53466 5.71791 3.47483 5.6936 3.40671C5.59064 3.11815 5.33831 2.42917 5.11713 1.98044C5.00463 1.751 4.78916 1.46117 4.55781 1.18596C4.4801 1.09353 4.40086 1.00242 4.3201 0.912655Z"
                                                                    fill="#FEFEFE" />
                                                            </svg>
                                                        </button>
                                                        <button class="third-icon" title="lock">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="8"
                                                                height="10" viewBox="0 0 8 10" fill="none">
                                                                <path
                                                                    d="M4 7.61905C3.73478 7.61905 3.48043 7.51871 3.29289 7.3401C3.10536 7.1615 3 6.91925 3 6.66667C3 6.1381 3.445 5.71429 4 5.71429C4.26522 5.71429 4.51957 5.81463 4.70711 5.99323C4.89464 6.17184 5 6.41408 5 6.66667C5 6.91925 4.89464 7.1615 4.70711 7.3401C4.51957 7.51871 4.26522 7.61905 4 7.61905ZM7 9.04762V4.28571H1V9.04762H7ZM7 3.33333C7.26522 3.33333 7.51957 3.43367 7.70711 3.61228C7.89464 3.79089 8 4.03313 8 4.28571V9.04762C8 9.30021 7.89464 9.54245 7.70711 9.72105C7.51957 9.89966 7.26522 10 7 10H1C0.734784 10 0.48043 9.89966 0.292893 9.72105C0.105357 9.54245 0 9.30021 0 9.04762V4.28571C0 3.75714 0.445 3.33333 1 3.33333H1.5V2.38095C1.5 1.74948 1.76339 1.14388 2.23223 0.697365C2.70107 0.25085 3.33696 0 4 0C4.3283 0 4.65339 0.0615852 4.95671 0.181239C5.26002 0.300893 5.53562 0.476273 5.76777 0.697365C5.99991 0.918457 6.18406 1.18093 6.3097 1.4698C6.43534 1.75867 6.5 2.06828 6.5 2.38095V3.33333H7ZM4 0.952381C3.60218 0.952381 3.22064 1.10289 2.93934 1.3708C2.65804 1.63871 2.5 2.00207 2.5 2.38095V3.33333H5.5V2.38095C5.5 2.00207 5.34196 1.63871 5.06066 1.3708C4.77936 1.10289 4.39782 0.952381 4 0.952381Z"
                                                                    fill="white" />
                                                            </svg>
                                                        </button>
                                                    </div>
                                                </div>



                                                <div
                                                    class="studio-details mt-1 d-flex align-items-center justify-content-between">

                                                    <div class="studio">
                                                        <h2 class="name">Furs & Co. Studio</h2>
                                                        <p class="hosted-by">Hosted by <span>Dev É.</span></p>
                                                    </div>

                                                    <div class="meta d-flex align-items-center justify-content-between">
                                                        <div class="distance" title="Distance">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="10"
                                                                height="14" viewBox="0 0 10 14" fill="none">
                                                                <path
                                                                    d="M5 6.65C4.5264 6.65 4.0722 6.46563 3.73731 6.13744C3.40242 5.80925 3.21429 5.36413 3.21429 4.9C3.21429 4.43587 3.40242 3.99075 3.73731 3.66256C4.0722 3.33437 4.5264 3.15 5 3.15C5.4736 3.15 5.9278 3.33437 6.26269 3.66256C6.59758 3.99075 6.78571 4.43587 6.78571 4.9C6.78571 5.12981 6.73953 5.35738 6.64979 5.5697C6.56004 5.78202 6.42851 5.97493 6.26269 6.13744C6.09687 6.29994 5.90002 6.42884 5.68336 6.51679C5.46671 6.60473 5.2345 6.65 5 6.65ZM5 0C3.67392 0 2.40215 0.516248 1.46447 1.43518C0.526784 2.3541 0 3.60044 0 4.9C0 8.575 5 14 5 14C5 14 10 8.575 10 4.9C10 3.60044 9.47322 2.3541 8.53553 1.43518C7.59785 0.516248 6.32608 0 5 0Z"
                                                                    fill="var(--active-bg)" />
                                                            </svg>
                                                            <span>2.5 mi</span>
                                                        </div>


                                                        <div class="rating" title="Rating">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="14"
                                                                height="14" viewBox="0 0 14 14" fill="none">
                                                                <path
                                                                    d="M6.12956 0.660476C6.40354 -0.220161 7.59647 -0.220158 7.87045 0.660479L8.89548 3.95519C9.01801 4.34902 9.36942 4.61566 9.76593 4.61566H13.083C13.9696 4.61566 14.3383 5.80055 13.621 6.34481L10.9374 8.38106C10.6166 8.62446 10.4824 9.0559 10.6049 9.44973L11.63 12.7444C11.9039 13.6251 10.9388 14.3574 10.2215 13.8131L7.53797 11.7769C7.21719 11.5335 6.78282 11.5335 6.46204 11.7769L3.77846 13.8131C3.06117 14.3574 2.09607 13.6251 2.37005 12.7444L3.39508 9.44973C3.51761 9.0559 3.38338 8.62446 3.0626 8.38106L0.37903 6.34481C-0.338258 5.80055 0.0303816 4.61566 0.916998 4.61566H4.23408C4.63058 4.61566 4.98199 4.34902 5.10452 3.95519L6.12956 0.660476Z"
                                                                    fill="var(--active-bg)" />
                                                            </svg>
                                                            <span>4.3 <small
                                                                    style="color:var(--muted)">(20)</small></span>
                                                        </div>
                                                    </div>
                                                </div>



                                                <p class="list-view-desc">Professional grooming spaces in London.
                                                    Spotless, well-equipped, easy to access.</p>


                                                <p class="amenities d-flex">
                                                    <b>Amenities:</b>&nbsp;Bath &#8226; Table &#8226; Dryer ...
                                                </p>

                                                <div class="availability">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15"
                                                        viewBox="0 0 15 15" fill="none">
                                                        <path
                                                            d="M7.5 0C3.375 0 0 3.375 0 7.5C0 11.625 3.375 15 7.5 15C11.625 15 15 11.625 15 7.5C15 3.375 11.625 0 7.5 0ZM6 11.25L2.25 7.5L3.3075 6.4425L6 9.1275L11.6925 3.435L12.75 4.5L6 11.25Z"
                                                            fill="#D8E8B7" />
                                                    </svg>
                                                    <span>Availability</span>
                                                </div>


                                                <div class="slots-price d-flex align-items-center">
                                                    <div class="slots d-flex" aria-label="Available slots">
                                                        <div class="slot highlight">Mon 1, 08:30 AM</div>
                                                        <div class="slot">Wed 27, 09:15 AM</div>
                                                    </div>
                                                    <div class="price">From <span>£38</span> <span class="time-frame">/
                                                            hour</span></div>
                                                </div>



                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-1"></div>
                                    <div class="col-lg-12 text-center section-gap">
                                        <button class="load-more">Load More</button>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- footer -->
    <?php include 'components/footer.php' ?>
    <!-- footer -->

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="assets/js/customer_journey.js"></script>


</body>

</html>

</body>

</html>