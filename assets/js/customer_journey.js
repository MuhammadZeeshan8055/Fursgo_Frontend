// document.addEventListener('DOMContentLoaded', function () {
//     // Initialize Leaflet map globally
//     window.map = L.map('map', {
//         zoomControl: true,
//         attributionControl: false,
//         preferCanvas: true
//     });

//     // Grey base map
//     L.tileLayer('https://{s}.basemaps.cartocdn.com/light_nolabels/{z}/{x}/{y}{r}.png', {
//         subdomains: 'abcd', maxZoom: 20
//     }).addTo(window.map);

//     // Labels overlay
//     L.tileLayer('https://{s}.basemaps.cartocdn.com/light_only_labels/{z}/{x}/{y}{r}.png', {
//         subdomains: 'abcd', maxZoom: 20, pane: 'overlayPane'
//     }).addTo(window.map);

//     // Yellow pin
//     const yellowPin = L.icon({
//         iconUrl: 'data:image/svg+xml;utf8,' + encodeURIComponent(`
//             <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
//                 <path fill="#F5C400" d="M12 2C8.1 2 5 5.1 5 9c0 5.2 7 13 7 13s7-7.8 7-13c0-3.9-3.1-7-7-7zm0 9.5c-1.4 0-2.5-1.1-2.5-2.5S10.6 6.5 12 6.5s2.5 1.1 2.5 2.5S13.4 11.5 12 11.5z"/>
//             </svg>
//         `),
//         iconSize: [28, 28],
//         iconAnchor: [14, 28],
//         popupAnchor: [0, -26]
//     });

//     // Locations
//     const locations = [
//         { name: 'Waterloo Station', lat: 51.5033, lng: -0.1147 },
//         { name: 'Westminster', lat: 51.4995, lng: -0.1248 },
//         { name: 'Strand', lat: 51.511227, lng: -0.119470 }
//     ];

//     // Add markers now
//     locations.forEach(loc => {
//         L.marker([loc.lat, loc.lng], { icon: yellowPin })
//             .addTo(window.map)
//             .bindPopup(`<strong>${loc.name}</strong>`);
//     });

//     // ---- Custom Tabs ----
//     document.querySelectorAll('.tabs').forEach(tabSection => {
//         const buttons = tabSection.querySelectorAll('.tablinks');
//         const contents = tabSection.querySelectorAll('.tabcontent');

//         function activateTab(tabName) {
//             contents.forEach(c => {
//                 const isActive = c.dataset.tabContent === tabName;
//                 c.style.display = isActive ? 'block' : 'none';

//                 // Only when map tab is active
//                 if (isActive && tabName === 'groomer-map-view' && window.map) {
//                     setTimeout(() => {
//                         // Force map resize
//                         window.map.invalidateSize();

//                         // Fit all markers properly now that container is visible
//                         window.map.invalidateSize();

//                             window.map.fitBounds(
//                                 locations.map(l => [l.lat, l.lng]),
//                                 {
//                                     padding: [40, 40],
//                                     maxZoom: 15
//                                 }
//                             );

//                     }, 100);
//                 }
//             });

//             buttons.forEach(b => {
//                 b.classList.toggle('active', b.dataset.tab === tabName);
//             });
//         }

//         buttons.forEach(button => {
//             button.addEventListener('click', () => {
//                 activateTab(button.dataset.tab);
//             });
//         });

//         // Auto-activate first tab
//         if (buttons.length) {
//             activateTab(buttons[0].dataset.tab);
//         }
//     });
// });

document.addEventListener('DOMContentLoaded', function () {
    // Initialize Leaflet map globally
    window.map = L.map('map', {
        zoomControl: true,
        attributionControl: false,
        preferCanvas: true
    });

    // Grey base map
    L.tileLayer('https://{s}.basemaps.cartocdn.com/light_nolabels/{z}/{x}/{y}{r}.png', {
        subdomains: 'abcd', maxZoom: 20
    }).addTo(window.map);

    // Labels overlay
    L.tileLayer('https://{s}.basemaps.cartocdn.com/light_only_labels/{z}/{x}/{y}{r}.png', {
        subdomains: 'abcd', maxZoom: 20, pane: 'overlayPane'
    }).addTo(window.map);

    // Initialize SECOND map for space view
    window.spaceMap = L.map('space-map', {
        zoomControl: true,
        attributionControl: false,
        preferCanvas: true
    });

    // Grey base map for space map
    L.tileLayer('https://{s}.basemaps.cartocdn.com/light_nolabels/{z}/{x}/{y}{r}.png', {
        subdomains: 'abcd', maxZoom: 20
    }).addTo(window.spaceMap);

    // Labels overlay for space map
    L.tileLayer('https://{s}.basemaps.cartocdn.com/light_only_labels/{z}/{x}/{y}{r}.png', {
        subdomains: 'abcd', maxZoom: 20, pane: 'overlayPane'
    }).addTo(window.spaceMap);

    // Yellow pin
    const yellowPin = L.icon({
        iconUrl: 'data:image/svg+xml;utf8,' + encodeURIComponent(`
            <svg xmlns="http://www.w3.org/2000/svg" width="34" height="48" viewBox="0 0 34 48" fill="none">
                <path d="M17 22.8C15.3898 22.8 13.8455 22.1679 12.7069 21.0426C11.5682 19.9174 10.9286 18.3913 10.9286 16.8C10.9286 15.2087 11.5682 13.6826 12.7069 12.5574C13.8455 11.4321 15.3898 10.8 17 10.8C18.6102 10.8 20.1545 11.4321 21.2931 12.5574C22.4318 13.6826 23.0714 15.2087 23.0714 16.8C23.0714 17.5879 22.9144 18.3681 22.6093 19.0961C22.3042 19.8241 21.8569 20.4855 21.2931 21.0426C20.7294 21.5998 20.0601 22.0417 19.3234 22.3433C18.5868 22.6448 17.7973 22.8 17 22.8ZM17 0C12.4913 0 8.1673 1.76999 4.97918 4.92061C1.79107 8.07122 0 12.3444 0 16.8C0 29.4 17 48 17 48C17 48 34 29.4 34 16.8C34 12.3444 32.2089 8.07122 29.0208 4.92061C25.8327 1.76999 21.5087 0 17 0Z" fill="#FFC97A"/>
            </svg>
        `),
        iconSize: [28, 28],
        iconAnchor: [14, 28],
        popupAnchor: [0, -26]
    });

    // Locations for groomer map
    const locations = [
        { name: 'Waterloo Station', lat: 51.5033, lng: -0.1147 },
        { name: 'Westminster', lat: 51.4995, lng: -0.1248 },
        { name: 'Strand', lat: 51.511227, lng: -0.119470 }
    ];

    // Locations for space map (different locations as example)
    const spaceLocations = [
        { name: 'Hyde Park', lat: 51.5074, lng: -0.1657 },
        { name: 'Kensington Gardens', lat: 51.5074, lng: -0.1850 },
        { name: 'Regent\'s Park', lat: 51.5313, lng: -0.1568 }
    ];

    // Add markers to groomer map
    locations.forEach(loc => {
        L.marker([loc.lat, loc.lng], { icon: yellowPin })
            .addTo(window.map)
            .bindPopup(`<strong>${loc.name}</strong>`);
    });

    // Add markers to space map
    spaceLocations.forEach(loc => {
        L.marker([loc.lat, loc.lng], { icon: yellowPin })
            .addTo(window.spaceMap)
            .bindPopup(`<strong>${loc.name}</strong>`);
    });

    // ---- Custom Tabs ----
    document.querySelectorAll('.tabs').forEach(tabSection => {
        const buttons = tabSection.querySelectorAll('.tablinks');
        const contents = tabSection.querySelectorAll('.tabcontent');

        function activateTab(tabName) {
            contents.forEach(c => {
                const isActive = c.dataset.tabContent === tabName;
                c.style.display = isActive ? 'block' : 'none';

                // Handle groomer map tab
                if (isActive && tabName === 'groomer-map-view' && window.map) {
                    setTimeout(() => {
                        window.map.invalidateSize();
                        window.map.fitBounds(
                            locations.map(l => [l.lat, l.lng]),
                            {
                                padding: [40, 40],
                                maxZoom: 15
                            }
                        );
                    }, 100);
                }

                // Handle space map tab
                if (isActive && tabName === 'space-map-view' && window.spaceMap) {
                    setTimeout(() => {
                        window.spaceMap.invalidateSize();
                        window.spaceMap.fitBounds(
                            spaceLocations.map(l => [l.lat, l.lng]),
                            {
                                padding: [40, 40],
                                maxZoom: 15
                            }
                        );
                    }, 100);
                }
            });

            buttons.forEach(b => {
                b.classList.toggle('active', b.dataset.tab === tabName);
            });
        }

        buttons.forEach(button => {
            button.addEventListener('click', () => {
                activateTab(button.dataset.tab);
            });
        });

        // Auto-activate first tab
        if (buttons.length) {
            activateTab(buttons[0].dataset.tab);
        }
    });
});

const toggleBtn = document.querySelector('.menu-toggle');
const menu = document.querySelector('.menu-items');
const header = document.querySelector('.logo-toggle-button');

toggleBtn.addEventListener('click', () => {
    menu.classList.toggle('active');
    header.classList.toggle('fixed');
    document.body.classList.toggle('menu-open');

    toggleBtn.innerHTML = menu.classList.contains('active') ? '✖' : '&#9776;';
});

// sort and venue selection starts

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

document.querySelector('.selected-item-section')
    .addEventListener('click', e => {
        if (e.target.classList.contains('cross')) {
            e.target.closest('.selected-item').remove();
        }
    });

// selected filter remove js ends


// main tabs content view starts

const main_tabs = document.querySelectorAll('.top-tabs');
const groomer_form_fields = document.querySelector('.find-groomer-search-content-area');
const space_form_fields = document.querySelector('.find-space-search-content-area');

main_tabs.forEach(button => {
    button.addEventListener('click', () => {
        const tabName = button.dataset.section;

        if (tabName === 'groomer') {
            groomer_form_fields.style.display = 'block';
            space_form_fields.style.display = 'none';
        } else {
            groomer_form_fields.style.display = 'none';
            space_form_fields.style.display = 'block';
        }

        // Hide all tab contents
        document.querySelectorAll('.main-tab-content').forEach(tc => {
            tc.style.display = 'none';
            tc.classList.remove('active');
        });

        // Remove active class from all buttons
        main_tabs.forEach(btn => btn.classList.remove('active'));

        // Show clicked tab content
        document.getElementById(tabName).style.display = 'block';

        // Set clicked button as active
        setTimeout(() => {
            button.classList.add('active');
        }, 10);
    });
});

// main tabs content view ends


// inner tabs content view starts

// const tabButtons = document.querySelectorAll('.tablinks');

// tabButtons.forEach(button => {
//     button.addEventListener('click', () => {
//         const tabName = button.dataset.tab;

//         // Hide all tab contents
//         document.querySelectorAll('.tabcontent').forEach(tc => tc.style.display = 'none');

//         // Remove active class from all buttons
//         tabButtons.forEach(btn => btn.classList.remove('active'));

//         // Show clicked tab content
//         document.getElementById(tabName).style.display = 'block';

//         // Set clicked button as active
//         button.classList.add('active');
//     });
// });


// loop through each .tabs section
// document.querySelectorAll('.tabs').forEach(tabSection => {
//     const tabButtons = tabSection.querySelectorAll('.tablinks');
//     const tabContents = tabSection.querySelectorAll('.tabcontent');

//     tabButtons.forEach(button => {
//         button.addEventListener('click', () => {
//             const tabName = button.dataset.tab;

//             // Hide all tab contents in this section only
//             tabContents.forEach(tc => tc.style.display = 'none');

//             // Remove active class from all buttons in this section
//             tabButtons.forEach(btn => btn.classList.remove('active'));

//             // Show clicked tab content
//             const content = tabSection.querySelector(`#${tabName}`);
//             if (content) content.style.display = 'block';

//             // Set clicked button as active
//             button.classList.add('active');
//         });
//     });
// });

// dynamic tabs 
document.querySelectorAll('.tabs').forEach(tabSection => {
    const buttons = tabSection.querySelectorAll('.tablinks');
    const contents = tabSection.querySelectorAll('.tabcontent');

    function activateTab(tabName) {
        contents.forEach(c => {
            const isActive = c.dataset.tabContent === tabName;
            c.style.display = isActive ? 'block' : 'none';

            // If this is the map tab, force Leaflet to recalc size
            if (isActive && tabName === 'groomer-map-view' && window.map) {
                setTimeout(() => {
                    map.invalidateSize(); // map is your Leaflet map instance
                }, 100); // small delay to let layout finish
            }
        });

        buttons.forEach(b => {
            b.classList.toggle('active', b.dataset.tab === tabName);
        });
    }

    buttons.forEach(button => {
        button.addEventListener('click', () => {
            activateTab(button.dataset.tab);
        });
    });

    // Auto-activate first tab
    if (buttons.length) {
        activateTab(buttons[0].dataset.tab);
    }
});




// inner tabs content view ends



// venu and sort by JS to handle selection
document.querySelectorAll('.dropdown').forEach(dropdown => {
    const items = dropdown.querySelectorAll('ul li');

    items.forEach(item => {
        item.addEventListener('click', () => {
            items.forEach(i => i.classList.remove('active'));
            item.classList.add('active');
        });
    });
});

// tabs content view ends

// custom select dropdown js  

document.querySelectorAll('.service-type-select .custom-select').forEach(select => {
    const trigger = select.querySelector('.service-type-select .custom-select .select-trigger');
    const options = select.querySelectorAll('.service-type-select .custom-select .select-options li');
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

        trigger.style.cssText = isOpen
            ? `border-bottom-left-radius: 0; border-bottom-right-radius: 0;`
            : `border-bottom-left-radius: 12px; border-bottom-right-radius: 12px;`;
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

// date time picker js  

(function () {
    const datetimeWrappers = document.querySelectorAll('.datetime-wrapper');

    datetimeWrappers.forEach((wrapper) => {
        const dateField = wrapper.querySelector('.field.date');
        const dateInput = dateField.querySelector('.fake-input');
        const datePopover = dateField.querySelector('.popover');
        const daysGrid = datePopover.querySelector('.days-grid');
        const monthLabel = datePopover.querySelector('#monthLabel');
        const prevMonthBtn = datePopover.querySelector('#prevMonth');
        const nextMonthBtn = datePopover.querySelector('#nextMonth');
        const weekdayRow = datePopover.querySelector('.weekday-row');

        const timeField = wrapper.querySelector('.field.time');
        const timeInput = timeField.querySelector('.fake-input');
        const timeList = datePopover.querySelector('.time-list');

        const weekdays = ['M', 'T', 'W', 'T', 'F', 'S', 'S'];

        let selectedDate = new Date();
        let viewYear = selectedDate.getFullYear();
        let viewMonth = selectedDate.getMonth();
        let selectedTime = '13:00'; // internal 24h value

        /* ---------------------- Utility ---------------------- */
        function pad(n) { return n < 10 ? '0' + n : n; }
        function monthName(m) { return new Date(2000, m, 1).toLocaleString('en', { month: 'long' }); }
        function formatDateForInput(d) {
            const day = pad(d.getDate());
            const month = pad(d.getMonth() + 1);
            const year = d.getFullYear().toString().slice(-2);
            return `${day}/${month}/${year}`;
        }

        function isSameDate(a, b) { return a && b && a.getFullYear() === b.getFullYear() && a.getMonth() === b.getMonth() && a.getDate() === b.getDate(); }
        function isToday(d) { const t = new Date(); return isSameDate(d, t); }

        // AM / PM helper (KEEP 24h numbers)
        function withMeridiem(hour) {
            return hour < 12 ? 'AM' : 'PM';
        }

        /* ---------------------- Calendar ---------------------- */
        function renderWeekdays() {
            weekdayRow.innerHTML = '';
            weekdays.forEach(d => {
                const el = document.createElement('div');
                el.textContent = d;
                weekdayRow.appendChild(el);
            });
        }

        function renderCalendar(year, month) {
            monthLabel.textContent = `${monthName(month)} ${year}`;
            daysGrid.innerHTML = '';

            const firstDay = new Date(year, month, 1);
            const startOffset = (firstDay.getDay() + 6) % 7;
            const daysInMonth = new Date(year, month + 1, 0).getDate();
            const prevMonthLastDay = new Date(year, month, 0).getDate();
            const totalCells = Math.ceil((startOffset + daysInMonth) / 7) * 7;

            for (let i = 0; i < totalCells; i++) {
                const cell = document.createElement('div');
                cell.className = 'day';
                const dayIndex = i - startOffset + 1;

                if (i < startOffset) {
                    cell.textContent = prevMonthLastDay - (startOffset - 1 - i);
                    cell.classList.add('outside');
                } else if (dayIndex > daysInMonth) {
                    cell.textContent = dayIndex - daysInMonth;
                    cell.classList.add('outside');
                } else {
                    const cellDate = new Date(year, month, dayIndex);
                    cell.textContent = dayIndex;

                    if (isSameDate(cellDate, selectedDate)) cell.classList.add('selected');
                    else if (isToday(cellDate)) cell.classList.add('today');

                    cell.tabIndex = 0;
                    cell.addEventListener('click', () => {
                        selectedDate = cellDate;
                        dateInput.value = formatDateForInput(selectedDate);
                        dateField.classList.add('has-value');
                        closeAllPopovers();
                        renderCalendar(viewYear, viewMonth);
                    });
                }

                daysGrid.appendChild(cell);
            }
        }

        /* ---------------------- Time List ---------------------- */
        function generateTimes() {
            timeList.innerHTML = '';

            for (let hour = 0; hour < 24; hour++) {
                const timeValue = pad(hour) + ':00';
                const item = document.createElement('div');

                item.className = 'time-item';
                item.dataset.time = timeValue;
                item.tabIndex = 0;

                // DISPLAY: 24h + AM/PM
                item.textContent = `${timeValue} ${withMeridiem(hour)}`;

                item.addEventListener('click', () => {
                    selectedTime = timeValue;
                    timeInput.value = `${timeValue} ${withMeridiem(hour)}`;
                    timeField.classList.add('has-value');

                    timeList.querySelectorAll('.time-item')
                        .forEach(i => i.classList.remove('selected'));

                    item.classList.add('selected');
                    closeAllPopovers();
                });

                timeList.appendChild(item);
            }
        }

        /* ---------------------- Popover ---------------------- */
        function openPopover() {
            datePopover.style.display = 'block';
            dateField.classList.add('focused');
            timeField.classList.add('focused');

            dateField.style.borderBottomLeftRadius = '0px';
            timeField.style.borderBottomRightRadius = '0px';

            // Auto scroll to selected time
            const el = timeList.querySelector(`.time-item[data-time="${selectedTime}"]`);
            if (el) el.scrollIntoView({ block: 'center', behavior: 'smooth' });
        }

        function closeAllPopovers() {
            document.querySelectorAll('.popover').forEach(p => p.style.display = 'none');

            dateField.classList.remove('focused');
            timeField.classList.remove('focused');

            dateField.style.borderBottomLeftRadius = '10px';
            timeField.style.borderBottomRightRadius = '10px';
        }

        /* ---------------------- Events ---------------------- */
        dateField.querySelector('.input-row').addEventListener('click', () => {
            datePopover.style.display === 'block' ? closeAllPopovers() : openPopover();
        });

        timeField.querySelector('.input-row').addEventListener('click', () => {
            if (datePopover.style.display !== 'block') openPopover();
            else {
                const el = timeList.querySelector(`.time-item[data-time="${selectedTime}"]`);
                if (el) el.scrollIntoView({ block: 'center', behavior: 'smooth' });
            }
        });

        prevMonthBtn.addEventListener('click', () => {
            viewMonth--;
            if (viewMonth < 0) { viewMonth = 11; viewYear--; }
            renderCalendar(viewYear, viewMonth);
        });

        nextMonthBtn.addEventListener('click', () => {
            viewMonth++;
            if (viewMonth > 11) { viewMonth = 0; viewYear++; }
            renderCalendar(viewYear, viewMonth);
        });

        /* ---------------------- Init ---------------------- */
        function init() {
            renderWeekdays();
            renderCalendar(viewYear, viewMonth);
            generateTimes();

            dateInput.value = formatDateForInput(selectedDate);
            timeInput.value = `${selectedTime} ${withMeridiem(parseInt(selectedTime))}`;

            const selectedEl = timeList.querySelector(`.time-item[data-time="${selectedTime}"]`);
            if (selectedEl) {
                selectedEl.classList.add('selected');
                selectedEl.scrollIntoView({ block: 'center' });
            }
        }

        init();
    });

    document.addEventListener('click', (e) => {
        if (!e.target.closest('.datetime-wrapper')) {
            document.querySelectorAll('.popover').forEach(p => p.style.display = 'none');
        }
    });

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            document.querySelectorAll('.popover').forEach(p => p.style.display = 'none');
        }
    });
})();


// calendar js simple
/* ---------- STATE ---------- */
// let selectedDate = new Date();
// const weekEl = document.getElementById('week');
// const rangeEl = document.getElementById('range');
// const monthEl = document.getElementById('month');

// /* ---------- HELPERS ---------- */
// const addDays = (d, n) => new Date(d.getFullYear(), d.getMonth(), d.getDate() + n);
// const monday = d => addDays(d, -((d.getDay() + 6) % 7));
// const pad = n => String(n).padStart(2, '0');

// /* ---------- RENDER ---------- */
// function render() {
//     weekEl.innerHTML = '';

//     const start = monday(selectedDate);
//     const end = addDays(start, 6);

//     rangeEl.textContent = `${pad(start.getDate())} - ${pad(end.getDate())} ${start.toLocaleString(undefined, { month: 'long' })}`;
//     monthEl.textContent = selectedDate.toLocaleString(undefined, { month: 'long', year: 'numeric' });

//     for (let i = 0; i < 7; i++) {
//         const d = addDays(start, i);
//         const day = document.createElement('div');
//         day.className = 'week-days';

//         // add inner HTML
//         day.innerHTML = `
//             <div class="dow${d.toDateString() === selectedDate.toDateString() ? ' active' : ''}">
//             ${d.toLocaleString(undefined, { weekday: 'short' })}
//             </div>
//             <div class="date${d.toDateString() === selectedDate.toDateString() ? ' active' : ''}">
//             ${pad(d.getDate())}
//             </div>
//         `;

//         day.onclick = () => { selectedDate = d; render(); };
//         weekEl.appendChild(day);
//     }
// }

// /* ---------- WEEK NAV ---------- */
// prev.onclick = () => { selectedDate = addDays(selectedDate, -7); render(); }
// next.onclick = () => { selectedDate = addDays(selectedDate, 7); render(); }

// /* ---------- INIT ---------- */
// render();


// draggable js 

document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.scroll-calendar').forEach(calendar => {
        // ---------- state ----------
        let selectedDate = new Date();
        const weekEl = calendar.querySelector('.week');
        const rangeEl = calendar.querySelector('.range');
        const monthEl = calendar.querySelector('.month');
        const prev = calendar.querySelector('.prev');
        const next = calendar.querySelector('.next');

        weekEl.tabIndex = 0;
        weekEl.setAttribute('role', 'list');

        const addDays = (d, n) => new Date(d.getFullYear(), d.getMonth(), d.getDate() + n);
        const monday = d => addDays(d, -((d.getDay() + 6) % 7));
        const pad = n => String(n).padStart(2, '0');

        let DAY_WIDTH = 0;
        let isDragging = false;
        let startX = 0;
        let dragOffset = 0;
        let movedSinceDown = false;
        const posHistory = [];
        const POS_HISTORY_MS = 120;

        function computeDayWidth() {
            const children = Array.from(weekEl.children);
            if (children.length >= 2) {
                const r0 = children[0].getBoundingClientRect();
                const r1 = children[1].getBoundingClientRect();
                DAY_WIDTH = Math.round(r1.left - r0.left) || Math.round(children[0].offsetWidth);
            } else {
                DAY_WIDTH = 60;
            }
        }

        function applyTransform(offsetPx, withTransition = false) {
            Array.from(weekEl.children).forEach(child => {
                child.style.transition = withTransition ? 'transform 240ms cubic-bezier(.22,.9,.25,1)' : 'none';
                child.style.transform = `translateX(${offsetPx}px)`;
            });
        }

        function pushPos(x) {
            const now = performance.now();
            posHistory.push({ x, t: now });
            while (posHistory.length && now - posHistory[0].t > POS_HISTORY_MS) posHistory.shift();
        }

        function calcVelocityPxPerMs() {
            if (posHistory.length < 2) return 0;
            const first = posHistory[0];
            const last = posHistory[posHistory.length - 1];
            const dt = last.t - first.t;
            if (dt <= 0) return 0;
            return (last.x - first.x) / dt;
        }

        function consumeWholeDaysIfNeeded() {
            if (DAY_WIDTH <= 5) return;
            if (dragOffset <= -DAY_WIDTH || dragOffset >= DAY_WIDTH) {
                if (dragOffset <= -DAY_WIDTH) {
                    const n = Math.floor((-dragOffset) / DAY_WIDTH);
                    selectedDate = addDays(selectedDate, n);
                    startX += n * DAY_WIDTH * -1;
                    dragOffset += n * DAY_WIDTH;
                    render();
                    computeDayWidth();
                } else {
                    const n = Math.floor(dragOffset / DAY_WIDTH);
                    selectedDate = addDays(selectedDate, -n);
                    startX += n * DAY_WIDTH;
                    dragOffset -= n * DAY_WIDTH;
                    render();
                    computeDayWidth();
                }
                applyTransform(dragOffset, false);
            }
        }

        function render() {
            weekEl.innerHTML = '';
            const start = monday(selectedDate);
            rangeEl.textContent = `${pad(start.getDate())} - ${pad(addDays(start, 6).getDate())} ${start.toLocaleString(undefined, { month: 'long' })}`;
            monthEl.textContent = selectedDate.toLocaleString(undefined, { month: 'long', year: 'numeric' });

            for (let i = 0; i < 7; i++) {
                const d = addDays(start, i);
                const day = document.createElement('div');
                day.className = 'week-days';
                day.setAttribute('role', 'listitem');
                day.innerHTML = `
                    <div class="dow${d.toDateString() === selectedDate.toDateString() ? ' active' : ''}">
                        ${d.toLocaleString(undefined, { weekday: 'short' })}
                    </div>
                    <div class="date${d.toDateString() === selectedDate.toDateString() ? ' active' : ''}">
                        ${pad(d.getDate())}
                    </div>
                `;
                day.onclick = () => { selectedDate = d; render(); };
                weekEl.appendChild(day);
            }

            Array.from(weekEl.children).forEach(c => {
                c.style.transition = '';
                c.style.transform = '';
            });
        }

        // ---------- navigation ----------
        if (prev) prev.onclick = () => { selectedDate = addDays(selectedDate, -7); render(); };
        if (next) next.onclick = () => { selectedDate = addDays(selectedDate, 7); render(); };

        // ---------- dragging ----------
        function getClientXFromEvent(ev) {
            if (ev.touches && ev.touches[0]) return ev.touches[0].clientX;
            if (ev.changedTouches && ev.changedTouches[0]) return ev.changedTouches[0].clientX;
            return ev.clientX;
        }

        function onDown(e) {
            if (e.type === 'mousedown' && e.button !== 0) return;
            e.preventDefault();
            isDragging = true;
            movedSinceDown = false;
            startX = getClientXFromEvent(e);
            dragOffset = 0;
            posHistory.length = 0;
            pushPos(startX);
            computeDayWidth();
            weekEl.style.userSelect = 'none';
            weekEl.style.cursor = 'grabbing';
        }

        function onMove(e) {
            if (!isDragging) return;
            const x = getClientXFromEvent(e);
            const diff = x - startX;
            if (Math.abs(diff) > 3) movedSinceDown = true;
            dragOffset = diff;
            pushPos(x);
            applyTransform(dragOffset, false);
            consumeWholeDaysIfNeeded();
        }

        function onUp(e) {
            if (!isDragging) return;
            isDragging = false;
            weekEl.style.userSelect = '';
            weekEl.style.cursor = 'grab';

            const vel = calcVelocityPxPerMs();
            const velPxPerSec = vel * 1000;

            if (DAY_WIDTH <= 5) {
                applyTransform(0, true);
                setTimeout(render, 200);
                return;
            }

            let finalDays = 0;
            if (dragOffset < 0) {
                const base = Math.round((-dragOffset) / DAY_WIDTH);
                const extra = Math.round((Math.max(0, -velPxPerSec) / DAY_WIDTH) * 0.18);
                finalDays = base + extra;
                if (finalDays === 0 && movedSinceDown) finalDays = 1;
                selectedDate = addDays(selectedDate, finalDays);
            } else if (dragOffset > 0) {
                const base = Math.round(dragOffset / DAY_WIDTH);
                const extra = Math.round((Math.max(0, velPxPerSec) / DAY_WIDTH) * 0.18);
                finalDays = base + extra;
                if (finalDays === 0 && movedSinceDown) finalDays = 1;
                selectedDate = addDays(selectedDate, -finalDays);
            }

            applyTransform(0, true);

            const onTransitionEnd = () => {
                Array.from(weekEl.children).forEach(c => { c.style.transition = ''; c.style.transform = ''; });
                render();
                const first = weekEl.firstChild;
                if (first) first.removeEventListener('transitionend', onTransitionEnd);
            };
            if (weekEl.firstChild) weekEl.firstChild.addEventListener('transitionend', onTransitionEnd);
            else setTimeout(render, 220);
        }

        const supportsPointer = !!window.PointerEvent;
        if (supportsPointer) {
            weekEl.addEventListener('pointerdown', onDown, { passive: false });
            document.addEventListener('pointermove', onMove);
            document.addEventListener('pointerup', onUp);
            weekEl.addEventListener('pointercancel', onUp);
        } else {
            weekEl.addEventListener('mousedown', onDown, { passive: false });
            document.addEventListener('mousemove', onMove);
            document.addEventListener('mouseup', onUp);
            weekEl.addEventListener('touchstart', onDown, { passive: false });
            weekEl.addEventListener('touchmove', onMove, { passive: false });
            weekEl.addEventListener('touchend', onUp);
            weekEl.addEventListener('touchcancel', onUp);
        }

        // ---------- keyboard support ----------
        weekEl.addEventListener('keydown', ev => {
            if (ev.key === 'ArrowLeft') { selectedDate = addDays(selectedDate, -1); render(); ev.preventDefault(); }
            else if (ev.key === 'ArrowRight') { selectedDate = addDays(selectedDate, 1); render(); ev.preventDefault(); }
            else if (ev.key === 'PageUp') { selectedDate = addDays(selectedDate, -7); render(); ev.preventDefault(); }
            else if (ev.key === 'PageDown') { selectedDate = addDays(selectedDate, 7); render(); ev.preventDefault(); }
        });

        // ---------- init ----------
        render();
        requestAnimationFrame(() => computeDayWidth());
    });
});


// modal js starts 

// Open modal
document.addEventListener('click', e => {
    const openBtn = e.target.closest('[data-modal-open]');
    if (!openBtn) return;

    const modalId = openBtn.dataset.modalOpen;
    const modal = document.getElementById(modalId);
    if (modal) modal.style.display = 'flex';
});

// Close modal (close button or backdrop)
document.addEventListener('click', e => {
    // Close button
    if (e.target.classList.contains('modal-close')) {
        e.target.closest('.modal').style.display = 'none';
    }

    // Backdrop click
    if (e.target.classList.contains('modal')) {
        e.target.style.display = 'none';
    }
});

// modal js ends 


// range js starts 

document.addEventListener('DOMContentLoaded', () => {

    document.querySelectorAll('.range-slider').forEach(slider => {
        const range = slider.querySelector('input[type="range"]');
        const output = slider.querySelector('.output');
        const inclRange = slider.querySelector('.incl-range');
        const max = range.max;

        function updateView() {
            const value = range.value;
            const percent = (value / max) * 100;

            output.textContent = '£' + value;
            output.style.left = percent + '%';
            inclRange.style.width = percent + '%';
        }

        updateView();
        range.addEventListener('input', updateView);
    });

});

// range js ends  