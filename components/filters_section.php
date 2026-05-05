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
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="6" height="10" viewBox="0 0 6 10" fill="none">
                                                                        <path d="M4.56836 0.5L0.500066 4.56829L4.50007 8.56829" stroke="#3B3731" stroke-linecap="round" stroke-linejoin="round" />
                                                                    </svg>
                                                                </button>

                                                                <div id="monthLabel">November 2025</div>

                                                                <button type="button" id="nextMonth"
                                                                    title="Next month" aria-label="Next month">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                                                        <circle cx="10" cy="10" r="9.5" fill="#F5F5F5" stroke="#F5F5F5" />
                                                                        <path d="M9 6L13.0683 10.0683L9.06829 14.0683" stroke="#3B3731" stroke-linecap="round" stroke-linejoin="round" />
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
                                                            <div class="time-list d-flex flex-column align-items-center justify-content-center" id="timeList" role="listbox"
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

                                        <div class="pet-toggle" id="petTypeToggle" style="cursor:pointer;" onclick="
                                                var opts = document.getElementById('petTypeOptions');
                                                var isOpen = opts.style.display === 'block';
                                                opts.style.display = isOpen ? 'none' : 'block';
                                                document.getElementById('petTypeToggle').style.borderRadius = isOpen ? '10px' : '10px 10px 0px 0';
                                            ">
                                            <button type="button" id="petTypeTriggerBtn" class="pet-option highlight search-custom-width" data-pet="other">
                                                <span>Other</span>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="16" viewBox="0 0 20 16" fill="none">
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M6.42074 0C5.71446 0 5.16085 0.437285 4.81841 0.961736C4.47169 1.49055 4.28049 2.18061 4.28049 2.90555C4.28049 3.63048 4.47169 4.32055 4.81841 4.84936C5.16085 5.37236 5.71446 5.8111 6.42074 5.8111C7.12702 5.8111 7.68063 5.37381 8.02307 4.84936C8.36979 4.32055 8.56099 3.63048 8.56099 2.90555C8.56099 2.18061 8.36979 1.49055 8.02307 0.961736C7.68063 0.438738 7.12702 0 6.42074 0ZM13.5549 0C12.8486 0 12.295 0.437285 11.9526 0.961736C11.6058 1.49055 11.4147 2.18061 11.4147 2.90555C11.4147 3.63048 11.6058 4.32055 11.9526 4.84936C12.295 5.37236 12.8486 5.8111 13.5549 5.8111C14.2612 5.8111 14.8148 5.37381 15.1572 4.84936C15.504 4.32055 15.6951 3.63048 15.6951 2.90555C15.6951 2.18061 15.504 1.49055 15.1572 0.961736C14.8148 0.438738 14.2612 0 13.5549 0ZM2.14025 6.53748C1.43397 6.53748 0.880355 6.97477 0.537915 7.49922C0.191195 8.02803 0 8.7181 0 9.44303C0 10.168 0.191195 10.858 0.537915 11.3868C0.880355 11.9098 1.43397 12.3486 2.14025 12.3486C2.84653 12.3486 3.40014 11.9113 3.74258 11.3868C4.0893 10.858 4.28049 10.168 4.28049 9.44303C4.28049 8.7181 4.0893 8.02803 3.74258 7.49922C3.40014 6.97622 2.84653 6.53748 2.14025 6.53748ZM9.98782 6.53748C8.27562 6.53748 7.00717 7.47307 6.19673 8.63383C5.39628 9.77717 4.99391 11.1965 4.99391 12.3486C4.99391 13.6909 5.7858 14.6251 6.75747 15.1844C7.71345 15.7364 8.91199 15.9805 9.98782 15.9805C11.0637 15.9805 12.2622 15.7379 13.2182 15.1844C14.1884 14.6236 14.9817 13.6909 14.9817 12.3486C14.9817 11.1965 14.5794 9.77717 13.7789 8.63383C12.9699 7.47162 11.7014 6.53748 9.98782 6.53748ZM17.8354 6.53748C17.1291 6.53748 16.5755 6.97477 16.2331 7.49922C15.8863 8.02803 15.6951 8.7181 15.6951 9.44303C15.6951 10.168 15.8863 10.858 16.2331 11.3868C16.5755 11.9098 17.1291 12.3486 17.8354 12.3486C18.5417 12.3486 19.0953 11.9113 19.4377 11.3868C19.7844 10.858 19.9756 10.168 19.9756 9.44303C19.9756 8.7181 19.7844 8.02803 19.4377 7.49922C19.0953 6.97622 18.5417 6.53748 17.8354 6.53748Z" fill="white" />
                                                </svg>
                                            </button>
                                        </div>

                                        <div id="petTypeOptions" style="display:none;">
                                            <div class="pet-toggle" style="border-radius:0;">
                                                <button type="button" class="pet-option search-custom-width" data-pet="cat" style="flex:1; border-radius:0;" onclick="
                                                    document.getElementById('petTypeTriggerBtn').innerHTML = '<span>Cat</span><svg xmlns=\'http://www.w3.org/2000/svg\' width=\'16\' height=\'23\' viewBox=\'0 0 16 23\' fill=\'none\'><path fill-rule=\'evenodd\' clip-rule=\'evenodd\' d=\'M7.06676 3.58301C7.8272 3.48926 8.88019 3.51288 9.88707 3.85352C11.0004 4.23022 12.0757 5.00405 12.6019 6.43945L14.7718 7.47949L14.8187 7.64941C15.1065 8.68692 15.2771 10.2987 14.8314 11.7656C14.6068 12.5047 14.2228 13.2153 13.6107 13.791C12.997 14.3682 12.1721 14.7931 11.0941 14.9854C7.21594 15.6771 5.0156 18.9931 4.40856 20.5596C4.16972 21.2436 3.6234 22.8966 3.6234 23C-3.55928 11.9396 1.57287 3.05798 5.03649 0L7.06676 3.58301ZM9.46911 7.20898C8.89995 7.20898 8.29637 7.49132 8.29625 8.62109C8.29625 9.4011 9.2901 8.62135 9.93786 8.62109C10.5856 8.62109 10.642 9.40123 10.642 8.62109C10.6418 7.84114 10.1167 7.20904 9.46911 7.20898Z\' fill=\'white\'/></svg>';
                                                    document.getElementById('petTypeOptions').style.display='none';
                                                    document.getElementById('petTypeToggle').style.borderRadius='10px';
                                                ">
                                                    <span>Cat</span>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="23" viewBox="0 0 16 23" fill="none">
                                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M7.06676 3.58301C7.8272 3.48926 8.88019 3.51288 9.88707 3.85352C11.0004 4.23022 12.0757 5.00405 12.6019 6.43945L14.7718 7.47949L14.8187 7.64941C15.1065 8.68692 15.2771 10.2987 14.8314 11.7656C14.6068 12.5047 14.2228 13.2153 13.6107 13.791C12.997 14.3682 12.1721 14.7931 11.0941 14.9854C7.21594 15.6771 5.0156 18.9931 4.40856 20.5596C4.16972 21.2436 3.6234 22.8966 3.6234 23C-3.55928 11.9396 1.57287 3.05798 5.03649 0L7.06676 3.58301ZM9.46911 7.20898C8.89995 7.20898 8.29637 7.49132 8.29625 8.62109C8.29625 9.4011 9.2901 8.62135 9.93786 8.62109C10.5856 8.62109 10.642 9.40123 10.642 8.62109C10.6418 7.84114 10.1167 7.20904 9.46911 7.20898Z" fill="#D4D4D4" />
                                                    </svg>
                                                </button>
                                            </div>
                                            <div class="pet-toggle" style="border-radius:0 0 10px 10px;">
                                                <button type="button" class="pet-option search-custom-width" data-pet="dog" style="flex:1; border-radius:0 0 10px 10px;" onclick="
                                                    document.getElementById('petTypeTriggerBtn').innerHTML = '<span>Dog</span><svg xmlns=\'http://www.w3.org/2000/svg\' width=\'22\' height=\'21\' viewBox=\'0 0 22 21\' fill=\'none\'><path fill-rule=\'evenodd\' clip-rule=\'evenodd\' d=\'M11.4592 0C12.0762 1.17851e-05 12.6594 0.284537 13.0383 0.771484L16.2531 4.90625C16.4122 5.11061 16.6453 5.24551 16.9016 5.28223L19.9856 5.72266C20.3434 5.77382 20.646 6.01312 20.759 6.35645C21.0768 7.32333 21.6368 9.33325 21.2541 10.5C20.7993 11.8862 20.0695 12.5798 18.7541 12.9189C16.5013 13.4995 14.6388 12.8359 12.4377 14.5137C11.7581 15.0318 11.2942 15.7094 10.9895 16.4668C9.95231 19.0452 6.72481 21.7057 4.32931 20.2969L1.40646 18.5781L2.88595 12.9932C3.03721 12.9827 3.18554 12.9709 3.32638 12.9531C3.72891 12.9023 4.1159 12.8149 4.36935 12.6543C4.57266 12.5253 4.78069 12.3018 4.97774 12.0498C5.17866 11.7928 5.38389 11.4855 5.57833 11.168C5.96742 10.5325 6.3241 9.84072 6.53439 9.39648C6.59336 9.2718 6.53981 9.12263 6.41524 9.06348C6.29077 9.00495 6.14238 9.05747 6.08321 9.18164C5.87882 9.61347 5.53039 10.2892 5.15255 10.9062C4.96358 11.2149 4.76927 11.5055 4.58419 11.7422C4.39527 11.9838 4.23006 12.151 4.10177 12.2324C3.94889 12.3293 3.65885 12.4072 3.26388 12.457C2.87959 12.5055 2.43068 12.5234 1.98946 12.5225C1.58435 12.5216 1.18926 12.5013 0.86251 12.4795C0.852906 12.4768 0.842764 12.4744 0.833213 12.4717C0.259745 12.3089 -0.117591 11.6851 0.0334085 11.1084C1.50836 5.48351 2.34847 2.92214 3.76583 1.50488C5.26191 0.00930829 8.24426 5.72137e-05 8.28146 0H11.4592ZM11.8498 5.01758C11.2131 5.01772 10.5383 5.33454 10.5383 6.59863C10.5386 7.47088 11.6506 6.59863 12.3752 6.59863C13.0998 6.59867 13.1623 7.47086 13.1623 6.59863C13.1623 5.72576 12.5746 5.01758 11.8498 5.01758Z\' fill=\'white\'/></svg>';
                                                    document.getElementById('petTypeOptions').style.display='none';
                                                    document.getElementById('petTypeToggle').style.borderRadius='10px';
                                                ">
                                                    <span>Dog</span>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="21" viewBox="0 0 22 21" fill="none">
                                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M11.4592 0C12.0762 1.17851e-05 12.6594 0.284537 13.0383 0.771484L16.2531 4.90625C16.4122 5.11061 16.6453 5.24551 16.9016 5.28223L19.9856 5.72266C20.3434 5.77382 20.646 6.01312 20.759 6.35645C21.0768 7.32333 21.6368 9.33325 21.2541 10.5C20.7993 11.8862 20.0695 12.5798 18.7541 12.9189C16.5013 13.4995 14.6388 12.8359 12.4377 14.5137C11.7581 15.0318 11.2942 15.7094 10.9895 16.4668C9.95231 19.0452 6.72481 21.7057 4.32931 20.2969L1.40646 18.5781L2.88595 12.9932C3.03721 12.9827 3.18554 12.9709 3.32638 12.9531C3.72891 12.9023 4.1159 12.8149 4.36935 12.6543C4.57266 12.5253 4.78069 12.3018 4.97774 12.0498C5.17866 11.7928 5.38389 11.4855 5.57833 11.168C5.96742 10.5325 6.3241 9.84072 6.53439 9.39648C6.59336 9.2718 6.53981 9.12263 6.41524 9.06348C6.29077 9.00495 6.14238 9.05747 6.08321 9.18164C5.87882 9.61347 5.53039 10.2892 5.15255 10.9062C4.96358 11.2149 4.76927 11.5055 4.58419 11.7422C4.39527 11.9838 4.23006 12.151 4.10177 12.2324C3.94889 12.3293 3.65885 12.4072 3.26388 12.457C2.87959 12.5055 2.43068 12.5234 1.98946 12.5225C1.58435 12.5216 1.18926 12.5013 0.86251 12.4795C0.852906 12.4768 0.842764 12.4744 0.833213 12.4717C0.259745 12.3089 -0.117591 11.6851 0.0334085 11.1084C1.50836 5.48351 2.34847 2.92214 3.76583 1.50488C5.26191 0.00930829 8.24426 5.72137e-05 8.28146 0H11.4592ZM11.8498 5.01758C11.2131 5.01772 10.5383 5.33454 10.5383 6.59863C10.5386 7.47088 11.6506 6.59863 12.3752 6.59863C13.0998 6.59867 13.1623 7.47086 13.1623 6.59863C13.1623 5.72576 12.5746 5.01758 11.8498 5.01758Z" fill="#D4D4D4" />
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="w-auto">
                                    <div class="pet-weight-wrapper wider">
                                        <p class="label">Pet Size</p>

                                        <div class="weight-toggle flex-column" id="petSizeToggle" style="cursor:pointer;" onclick="
                                                var opts = document.getElementById('petSizeOptions');
                                                var isOpen = opts.style.display === 'block';
                                                opts.style.display = isOpen ? 'none' : 'block';
                                                document.getElementById('petSizeToggle').style.borderRadius = isOpen ? '10px' : '10px 10px 0px 0';
                                            ">
                                            <button type="button" class="weight-option search-custom-large-btn-width large active" data-weight="large">
                                                <span id="petSizeLabel">Large 19+ kg</span>
                                            </button>
                                        </div>

                                        <div id="petSizeOptions" style="display:none;">
                                            <div class="weight-toggle" style="border-radius:0;">
                                                <button type="button" class="weight-option search-custom-large-btn-width large" data-weight="small" style="flex:1; border-radius:0;" onclick="document.getElementById('petSizeLabel').textContent='Small 0-7 kg'; document.getElementById('petSizeOptions').style.display='none'; document.getElementById('petSizeToggle').style.borderRadius='10px';">
                                                    <span>Small 0-7 kg</span>
                                                </button>
                                            </div>
                                            <div class="weight-toggle" style="border-radius:0 0 10px 10px;">
                                                <button type="button" class="weight-option search-custom-large-btn-width large" data-weight="medium" style="flex:1; border-radius:0 0 10px 10px;" onclick="document.getElementById('petSizeLabel').textContent='Medium 8-18 kg'; document.getElementById('petSizeOptions').style.display='none'; document.getElementById('petSizeToggle').style.borderRadius='10px';">
                                                    <span>Medium 8-18 kg</span>
                                                </button>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="w-auto cursor">
                                    <p class="label" style="visibility: hidden;">search</p>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48" fill="none">
                                        <rect width="48" height="48" rx="24" fill="#FBAC83" />
                                        <path d="M22.4121 17C25.4011 17 27.8241 19.423 27.8242 22.4121C27.8242 23.9471 27.1868 25.3321 26.1592 26.3183C25.1858 27.2524 23.8667 27.8242 22.4121 27.8242C19.4231 27.8241 17 25.4012 17 22.4121C17.0001 19.4231 19.4231 17 22.4121 17Z" stroke="white" stroke-width="2" />
                                        <path d="M32.0634 33.4776C32.454 33.8681 33.0871 33.8681 33.4776 33.4776C33.8682 33.0871 33.8682 32.4539 33.4777 32.0634L32.7705 32.7705L32.0634 33.4776ZM26.8516 26.8515L26.1445 27.5586L32.0634 33.4776L32.7705 32.7705L33.4777 32.0634L27.5587 26.1444L26.8516 26.8515Z" fill="white" />
                                    </svg>
                                </div>
                                <div class="w-auto" style="margin-left: 2%;">
                                    <p class="label">Filter</p>
                                    <div class="filter-svg">
                                        <svg data-modal-open="groomModal" class="filters-icon" xmlns="http://www.w3.org/2000/svg" width="27" height="27" viewBox="0 0 27 27" fill="none">
                                            <path d="M3.875 13.25C3.0462 13.25 2.25134 12.9208 1.66529 12.3347C1.07924 11.7487 0.75 10.9538 0.75 10.125C0.75 9.2962 1.07924 8.50134 1.66529 7.91529C2.25134 7.32924 3.0462 7 3.875 7M3.875 13.25C4.7038 13.25 5.49866 12.9208 6.08471 12.3347C6.67076 11.7487 7 10.9538 7 10.125C7 9.2962 6.67076 8.50134 6.08471 7.91529C5.49866 7.32924 4.7038 7 3.875 7M3.875 13.25V25.75M3.875 7V0.75M13.25 22.625C12.4212 22.625 11.6263 22.2958 11.0403 21.7097C10.4542 21.1237 10.125 20.3288 10.125 19.5C10.125 18.6712 10.4542 17.8763 11.0403 17.2903C11.6263 16.7042 12.4212 16.375 13.25 16.375M13.25 22.625C14.0788 22.625 14.8737 22.2958 15.4597 21.7097C16.0458 21.1237 16.375 20.3288 16.375 19.5C16.375 18.6712 16.0458 17.8763 15.4597 17.2903C14.8737 16.7042 14.0788 16.375 13.25 16.375M13.25 22.625V25.75M13.25 16.375V0.75M22.625 8.5625C21.7962 8.5625 21.0013 8.23326 20.4153 7.64721C19.8292 7.06116 19.5 6.2663 19.5 5.4375C19.5 4.6087 19.8292 3.81384 20.4153 3.22779C21.0013 2.64174 21.7962 2.3125 22.625 2.3125M22.625 8.5625C23.4538 8.5625 24.2487 8.23326 24.8347 7.64721C25.4208 7.06116 25.75 6.2663 25.75 5.4375C25.75 4.6087 25.4208 3.81384 24.8347 3.22779C24.2487 2.64174 23.4538 2.3125 22.625 2.3125M22.625 8.5625V25.75M22.625 2.3125V0.75" stroke="#3B3731" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
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
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="6" height="10" viewBox="0 0 6 10" fill="none">
                                                                        <path d="M4.56836 0.5L0.500066 4.56829L4.50007 8.56829" stroke="#3B3731" stroke-linecap="round" stroke-linejoin="round" />
                                                                    </svg>
                                                                </button>

                                                                <div id="monthLabel">November 2025</div>

                                                                <button type="button" id="nextMonth"
                                                                    title="Next month" aria-label="Next month">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                                                        <circle cx="10" cy="10" r="9.5" fill="#F5F5F5" stroke="#F5F5F5" />
                                                                        <path d="M9 6L13.0683 10.0683L9.06829 14.0683" stroke="#3B3731" stroke-linecap="round" stroke-linejoin="round" />
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
                                                            <div class="time-list d-flex flex-column align-items-center justify-content-center" id="timeList" role="listbox"
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

                                        <div class="pet-toggle" id="spaceTypeToggle" style="cursor:pointer;" onclick="
                                                var opts = document.getElementById('spaceTypeOptions');
                                                var isOpen = opts.style.display === 'block';
                                                opts.style.display = isOpen ? 'none' : 'block';
                                                document.getElementById('spaceTypeToggle').style.borderRadius = isOpen ? '10px' : '10px 10px 0px 0';
                                            ">
                                            <button type="button" id="spaceTypeTriggerBtn" class="pet-option highlight search-custom-width" data-pet="other">
                                                <span>Other</span>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="16" viewBox="0 0 20 16" fill="none">
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M6.42074 0C5.71446 0 5.16085 0.437285 4.81841 0.961736C4.47169 1.49055 4.28049 2.18061 4.28049 2.90555C4.28049 3.63048 4.47169 4.32055 4.81841 4.84936C5.16085 5.37236 5.71446 5.8111 6.42074 5.8111C7.12702 5.8111 7.68063 5.37381 8.02307 4.84936C8.36979 4.32055 8.56099 3.63048 8.56099 2.90555C8.56099 2.18061 8.36979 1.49055 8.02307 0.961736C7.68063 0.438738 7.12702 0 6.42074 0ZM13.5549 0C12.8486 0 12.295 0.437285 11.9526 0.961736C11.6058 1.49055 11.4147 2.18061 11.4147 2.90555C11.4147 3.63048 11.6058 4.32055 11.9526 4.84936C12.295 5.37236 12.8486 5.8111 13.5549 5.8111C14.2612 5.8111 14.8148 5.37381 15.1572 4.84936C15.504 4.32055 15.6951 3.63048 15.6951 2.90555C15.6951 2.18061 15.504 1.49055 15.1572 0.961736C14.8148 0.438738 14.2612 0 13.5549 0ZM2.14025 6.53748C1.43397 6.53748 0.880355 6.97477 0.537915 7.49922C0.191195 8.02803 0 8.7181 0 9.44303C0 10.168 0.191195 10.858 0.537915 11.3868C0.880355 11.9098 1.43397 12.3486 2.14025 12.3486C2.84653 12.3486 3.40014 11.9113 3.74258 11.3868C4.0893 10.858 4.28049 10.168 4.28049 9.44303C4.28049 8.7181 4.0893 8.02803 3.74258 7.49922C3.40014 6.97622 2.84653 6.53748 2.14025 6.53748ZM9.98782 6.53748C8.27562 6.53748 7.00717 7.47307 6.19673 8.63383C5.39628 9.77717 4.99391 11.1965 4.99391 12.3486C4.99391 13.6909 5.7858 14.6251 6.75747 15.1844C7.71345 15.7364 8.91199 15.9805 9.98782 15.9805C11.0637 15.9805 12.2622 15.7379 13.2182 15.1844C14.1884 14.6236 14.9817 13.6909 14.9817 12.3486C14.9817 11.1965 14.5794 9.77717 13.7789 8.63383C12.9699 7.47162 11.7014 6.53748 9.98782 6.53748ZM17.8354 6.53748C17.1291 6.53748 16.5755 6.97477 16.2331 7.49922C15.8863 8.02803 15.6951 8.7181 15.6951 9.44303C15.6951 10.168 15.8863 10.858 16.2331 11.3868C16.5755 11.9098 17.1291 12.3486 17.8354 12.3486C18.5417 12.3486 19.0953 11.9113 19.4377 11.3868C19.7844 10.858 19.9756 10.168 19.9756 9.44303C19.9756 8.7181 19.7844 8.02803 19.4377 7.49922C19.0953 6.97622 18.5417 6.53748 17.8354 6.53748Z" fill="white" />
                                                </svg>
                                            </button>
                                        </div>

                                        <div id="spaceTypeOptions" style="display:none;">
                                            <div class="pet-toggle" style="border-radius:0;">
                                                <button type="button" class="pet-option search-custom-width" data-pet="cat" style="flex:1; border-radius:0;" onclick="
                                                    document.getElementById('spaceTypeTriggerBtn').innerHTML = '<span>Cat</span><svg xmlns=\'http://www.w3.org/2000/svg\' width=\'16\' height=\'23\' viewBox=\'0 0 16 23\' fill=\'none\'><path fill-rule=\'evenodd\' clip-rule=\'evenodd\' d=\'M7.06676 3.58301C7.8272 3.48926 8.88019 3.51288 9.88707 3.85352C11.0004 4.23022 12.0757 5.00405 12.6019 6.43945L14.7718 7.47949L14.8187 7.64941C15.1065 8.68692 15.2771 10.2987 14.8314 11.7656C14.6068 12.5047 14.2228 13.2153 13.6107 13.791C12.997 14.3682 12.1721 14.7931 11.0941 14.9854C7.21594 15.6771 5.0156 18.9931 4.40856 20.5596C4.16972 21.2436 3.6234 22.8966 3.6234 23C-3.55928 11.9396 1.57287 3.05798 5.03649 0L7.06676 3.58301ZM9.46911 7.20898C8.89995 7.20898 8.29637 7.49132 8.29625 8.62109C8.29625 9.4011 9.2901 8.62135 9.93786 8.62109C10.5856 8.62109 10.642 9.40123 10.642 8.62109C10.6418 7.84114 10.1167 7.20904 9.46911 7.20898Z\' fill=\'white\'/></svg>';
                                                    document.getElementById('spaceTypeOptions').style.display='none';
                                                    document.getElementById('spaceTypeToggle').style.borderRadius='10px';
                                                ">
                                                    <span>Cat</span>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="23" viewBox="0 0 16 23" fill="none">
                                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M7.06676 3.58301C7.8272 3.48926 8.88019 3.51288 9.88707 3.85352C11.0004 4.23022 12.0757 5.00405 12.6019 6.43945L14.7718 7.47949L14.8187 7.64941C15.1065 8.68692 15.2771 10.2987 14.8314 11.7656C14.6068 12.5047 14.2228 13.2153 13.6107 13.791C12.997 14.3682 12.1721 14.7931 11.0941 14.9854C7.21594 15.6771 5.0156 18.9931 4.40856 20.5596C4.16972 21.2436 3.6234 22.8966 3.6234 23C-3.55928 11.9396 1.57287 3.05798 5.03649 0L7.06676 3.58301ZM9.46911 7.20898C8.89995 7.20898 8.29637 7.49132 8.29625 8.62109C8.29625 9.4011 9.2901 8.62135 9.93786 8.62109C10.5856 8.62109 10.642 9.40123 10.642 8.62109C10.6418 7.84114 10.1167 7.20904 9.46911 7.20898Z" fill="#D4D4D4" />
                                                    </svg>
                                                </button>
                                            </div>
                                            <div class="pet-toggle" style="border-radius:0 0 10px 10px;">
                                                <button type="button" class="pet-option search-custom-width" data-pet="dog" style="flex:1; border-radius:0 0 10px 10px;" onclick="
                                                        document.getElementById('spaceTypeTriggerBtn').innerHTML = '<span>Dog</span><svg xmlns=\'http://www.w3.org/2000/svg\' width=\'22\' height=\'21\' viewBox=\'0 0 22 21\' fill=\'none\'><path fill-rule=\'evenodd\' clip-rule=\'evenodd\' d=\'M11.4592 0C12.0762 1.17851e-05 12.6594 0.284537 13.0383 0.771484L16.2531 4.90625C16.4122 5.11061 16.6453 5.24551 16.9016 5.28223L19.9856 5.72266C20.3434 5.77382 20.646 6.01312 20.759 6.35645C21.0768 7.32333 21.6368 9.33325 21.2541 10.5C20.7993 11.8862 20.0695 12.5798 18.7541 12.9189C16.5013 13.4995 14.6388 12.8359 12.4377 14.5137C11.7581 15.0318 11.2942 15.7094 10.9895 16.4668C9.95231 19.0452 6.72481 21.7057 4.32931 20.2969L1.40646 18.5781L2.88595 12.9932C3.03721 12.9827 3.18554 12.9709 3.32638 12.9531C3.72891 12.9023 4.1159 12.8149 4.36935 12.6543C4.57266 12.5253 4.78069 12.3018 4.97774 12.0498C5.17866 11.7928 5.38389 11.4855 5.57833 11.168C5.96742 10.5325 6.3241 9.84072 6.53439 9.39648C6.59336 9.2718 6.53981 9.12263 6.41524 9.06348C6.29077 9.00495 6.14238 9.05747 6.08321 9.18164C5.87882 9.61347 5.53039 10.2892 5.15255 10.9062C4.96358 11.2149 4.76927 11.5055 4.58419 11.7422C4.39527 11.9838 4.23006 12.151 4.10177 12.2324C3.94889 12.3293 3.65885 12.4072 3.26388 12.457C2.87959 12.5055 2.43068 12.5234 1.98946 12.5225C1.58435 12.5216 1.18926 12.5013 0.86251 12.4795C0.852906 12.4768 0.842764 12.4744 0.833213 12.4717C0.259745 12.3089 -0.117591 11.6851 0.0334085 11.1084C1.50836 5.48351 2.34847 2.92214 3.76583 1.50488C5.26191 0.00930829 8.24426 5.72137e-05 8.28146 0H11.4592ZM11.8498 5.01758C11.2131 5.01772 10.5383 5.33454 10.5383 6.59863C10.5386 7.47088 11.6506 6.59863 12.3752 6.59863C13.0998 6.59867 13.1623 7.47086 13.1623 6.59863C13.1623 5.72576 12.5746 5.01758 11.8498 5.01758Z\' fill=\'white\'/></svg>';
                                                        document.getElementById('spaceTypeOptions').style.display='none';
                                                        document.getElementById('spaceTypeToggle').style.borderRadius='10px';
                                                    ">
                                                    <span>Dog</span>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="21" viewBox="0 0 22 21" fill="none">
                                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M11.4592 0C12.0762 1.17851e-05 12.6594 0.284537 13.0383 0.771484L16.2531 4.90625C16.4122 5.11061 16.6453 5.24551 16.9016 5.28223L19.9856 5.72266C20.3434 5.77382 20.646 6.01312 20.759 6.35645C21.0768 7.32333 21.6368 9.33325 21.2541 10.5C20.7993 11.8862 20.0695 12.5798 18.7541 12.9189C16.5013 13.4995 14.6388 12.8359 12.4377 14.5137C11.7581 15.0318 11.2942 15.7094 10.9895 16.4668C9.95231 19.0452 6.72481 21.7057 4.32931 20.2969L1.40646 18.5781L2.88595 12.9932C3.03721 12.9827 3.18554 12.9709 3.32638 12.9531C3.72891 12.9023 4.1159 12.8149 4.36935 12.6543C4.57266 12.5253 4.78069 12.3018 4.97774 12.0498C5.17866 11.7928 5.38389 11.4855 5.57833 11.168C5.96742 10.5325 6.3241 9.84072 6.53439 9.39648C6.59336 9.2718 6.53981 9.12263 6.41524 9.06348C6.29077 9.00495 6.14238 9.05747 6.08321 9.18164C5.87882 9.61347 5.53039 10.2892 5.15255 10.9062C4.96358 11.2149 4.76927 11.5055 4.58419 11.7422C4.39527 11.9838 4.23006 12.151 4.10177 12.2324C3.94889 12.3293 3.65885 12.4072 3.26388 12.457C2.87959 12.5055 2.43068 12.5234 1.98946 12.5225C1.58435 12.5216 1.18926 12.5013 0.86251 12.4795C0.852906 12.4768 0.842764 12.4744 0.833213 12.4717C0.259745 12.3089 -0.117591 11.6851 0.0334085 11.1084C1.50836 5.48351 2.34847 2.92214 3.76583 1.50488C5.26191 0.00930829 8.24426 5.72137e-05 8.28146 0H11.4592ZM11.8498 5.01758C11.2131 5.01772 10.5383 5.33454 10.5383 6.59863C10.5386 7.47088 11.6506 6.59863 12.3752 6.59863C13.0998 6.59867 13.1623 7.47086 13.1623 6.59863C13.1623 5.72576 12.5746 5.01758 11.8498 5.01758Z" fill="#D4D4D4" />
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="w-auto">
                                    <div class="pet-weight-wrapper wider">
                                        <p class="label">Pet Size</p>

                                        <div class="weight-toggle flex-column" id="spaceSizeToggle" style="cursor:pointer;" onclick="
                                                var opts = document.getElementById('spaceSizeOptions');
                                                var isOpen = opts.style.display === 'block';
                                                opts.style.display = isOpen ? 'none' : 'block';
                                                document.getElementById('spaceSizeToggle').style.borderRadius = isOpen ? '10px' : '10px 10px 0px 0';
                                            ">
                                            <button type="button" class="weight-option search-custom-large-btn-width large active" data-weight="large">
                                                <span id="spaceSizeLabel">Large 19+ kg</span>
                                            </button>
                                        </div>

                                        <div id="spaceSizeOptions" style="display:none;">
                                            <div class="weight-toggle" style="border-radius:0;">
                                                <button type="button" class="weight-option search-custom-large-btn-width large" data-weight="small" style="flex:1; border-radius:0;"
                                                    onclick="document.getElementById('spaceSizeLabel').textContent='Small 0-7 kg'; document.getElementById('spaceSizeOptions').style.display='none'; document.getElementById('spaceSizeToggle').style.borderRadius='10px';">
                                                    <span>Small 0-7 kg</span>
                                                </button>
                                            </div>
                                            <div class="weight-toggle" style="border-radius:0 0 10px 10px;">
                                                <button type="button" class="weight-option search-custom-large-btn-width large" data-weight="medium" style="flex:1; border-radius:0 0 10px 10px;"
                                                    onclick="document.getElementById('spaceSizeLabel').textContent='Medium 8-18 kg'; document.getElementById('spaceSizeOptions').style.display='none'; document.getElementById('spaceSizeToggle').style.borderRadius='10px';">
                                                    <span>Medium 8-18 kg</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="w-auto cursor">
                                    <p class="label" style="visibility: hidden;">search</p>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48" fill="none">
                                        <rect width="48" height="48" rx="24" fill="#ffa899" />
                                        <path d="M22.4121 17C25.4011 17 27.8241 19.423 27.8242 22.4121C27.8242 23.9471 27.1868 25.3321 26.1592 26.3183C25.1858 27.2524 23.8667 27.8242 22.4121 27.8242C19.4231 27.8241 17 25.4012 17 22.4121C17.0001 19.4231 19.4231 17 22.4121 17Z" stroke="white" stroke-width="2" />
                                        <path d="M32.0634 33.4776C32.454 33.8681 33.0871 33.8681 33.4776 33.4776C33.8682 33.0871 33.8682 32.4539 33.4777 32.0634L32.7705 32.7705L32.0634 33.4776ZM26.8516 26.8515L26.1445 27.5586L32.0634 33.4776L32.7705 32.7705L33.4777 32.0634L27.5587 26.1444L26.8516 26.8515Z" fill="white" />
                                    </svg>
                                </div>
                                <div class="w-auto" style="margin-left: 2%;">
                                    <p class="label">Filter</p>
                                    <div class="filter-svg">
                                        <svg data-modal-open="spaceModal" class="filters-icon" xmlns="http://www.w3.org/2000/svg" width="27" height="27" viewBox="0 0 27 27" fill="none">
                                            <path d="M3.875 13.25C3.0462 13.25 2.25134 12.9208 1.66529 12.3347C1.07924 11.7487 0.75 10.9538 0.75 10.125C0.75 9.2962 1.07924 8.50134 1.66529 7.91529C2.25134 7.32924 3.0462 7 3.875 7M3.875 13.25C4.7038 13.25 5.49866 12.9208 6.08471 12.3347C6.67076 11.7487 7 10.9538 7 10.125C7 9.2962 6.67076 8.50134 6.08471 7.91529C5.49866 7.32924 4.7038 7 3.875 7M3.875 13.25V25.75M3.875 7V0.75M13.25 22.625C12.4212 22.625 11.6263 22.2958 11.0403 21.7097C10.4542 21.1237 10.125 20.3288 10.125 19.5C10.125 18.6712 10.4542 17.8763 11.0403 17.2903C11.6263 16.7042 12.4212 16.375 13.25 16.375M13.25 22.625C14.0788 22.625 14.8737 22.2958 15.4597 21.7097C16.0458 21.1237 16.375 20.3288 16.375 19.5C16.375 18.6712 16.0458 17.8763 15.4597 17.2903C14.8737 16.7042 14.0788 16.375 13.25 16.375M13.25 22.625V25.75M13.25 16.375V0.75M22.625 8.5625C21.7962 8.5625 21.0013 8.23326 20.4153 7.64721C19.8292 7.06116 19.5 6.2663 19.5 5.4375C19.5 4.6087 19.8292 3.81384 20.4153 3.22779C21.0013 2.64174 21.7962 2.3125 22.625 2.3125M22.625 8.5625C23.4538 8.5625 24.2487 8.23326 24.8347 7.64721C25.4208 7.06116 25.75 6.2663 25.75 5.4375C25.75 4.6087 25.4208 3.81384 24.8347 3.22779C24.2487 2.64174 23.4538 2.3125 22.625 2.3125M22.625 8.5625V25.75M22.625 2.3125V0.75" stroke="#3B3731" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
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