// calendar
const monthNames = [
    "January", "February", "March", "April", "May", "June",
    "July", "August", "September", "October", "November", "December"
];

let currentDate = new Date(2025, 9); // October 2025
let selectedDay = 14;

const bookingSidebar = document.getElementById('booking-sidebar');
const headerTitle = document.querySelector('.calendar-header span');
const datesContainer = document.querySelector('.dates');
const prevBtn = document.querySelector('.nav-btn:first-child');
const nextBtn = document.querySelector('.nav-btn:last-child');
const bookingCtaBtn = document.querySelector('.booking-cta-btn');

// Example available dates (can come from backend later)
const availableDates = [
    "2025-10-07",
    "2025-10-09",
    "2025-10-14",
    "2025-10-15",
    "2025-10-20",
    "2025-10-26",
    "2025-10-29",
    "2025-10-30"
];

function parseTimeParts(value) {
    const match = String(value || '').trim().match(/^(\d{1,2}):(\d{2})/);
    if (!match) return null;
    return { hours: Number(match[1]), minutes: Number(match[2]) };
}

function formatTime24({ hours, minutes }) {
    return `${String(hours).padStart(2, '0')}:${String(minutes).padStart(2, '0')}`;
}

function formatTimeAmPm({ hours, minutes }) {
    const suffix = hours >= 12 ? 'PM' : 'AM';
    const hour12 = hours % 12 === 0 ? 12 : hours % 12;
    return `${String(hour12).padStart(2, '0')}:${String(minutes).padStart(2, '0')} ${suffix}`;
}

function addOneHour(parts) {
    const total = parts.hours * 60 + parts.minutes + 60;
    return {
        hours: Math.floor(total / 60) % 24,
        minutes: total % 60,
    };
}

function getSelectedSlotTimes() {
    const selectedTime = document.querySelector('#booking-sidebar .time.selected, .times .time.selected');
    const raw = selectedTime?.dataset.time || selectedTime?.textContent.trim() || '';
    const start = parseTimeParts(raw);
    if (!start) return null;
    return { start, end: addOneHour(start) };
}

function getSelectedTimeLabel() {
    const slot = getSelectedSlotTimes();
    if (!slot) return '';

    if (document.querySelector('[data-selected-time-range]')) {
        return `${formatTime24(slot.start)}-${formatTime24(slot.end)}`;
    }

    return formatTime24(slot.start);
}

function updateSelectedTimeRangeDisplay() {
    const rangeEl = document.querySelector('[data-selected-time-range]');
    if (!rangeEl) return;

    const slot = getSelectedSlotTimes();
    if (!slot) {
        rangeEl.textContent = '';
        return;
    }

    rangeEl.textContent = `${formatTimeAmPm(slot.start)} - ${formatTimeAmPm(slot.end)}`;
}

function updateBookingCta() {
    if (!bookingCtaBtn) return;

    const monthShort = monthNames[currentDate.getMonth()].slice(0, 3);
    const timeLabel = getSelectedTimeLabel();
    const dayLabel = selectedDay ? String(selectedDay) : '';

    updateSelectedTimeRangeDisplay();

    if (dayLabel && timeLabel) {
        bookingCtaBtn.textContent = `Book for ${monthShort} ${dayLabel}, ${timeLabel}`;
    } else if (dayLabel) {
        bookingCtaBtn.textContent = `Book for ${monthShort} ${dayLabel}`;
    } else {
        bookingCtaBtn.textContent = 'Book now';
    }
}

function formatBookingMoney(amount, { plus = false } = {}) {
    const value = Number(amount) || 0;
    const formatted = `£${value.toFixed(2)}`;
    return plus ? `+${formatted}` : formatted;
}

function getBookingSummaryItems(summaryKey) {
    const select = document.querySelector(`#booking-sidebar .custom-select[data-summary="${summaryKey}"]`);
    if (!select) return [];

    return [...select.querySelectorAll('.select-options li.selected')].map(option => ({
        value: option.dataset.value,
        label: option.dataset.label
            || option.querySelector('.option-label')?.textContent.trim()
            || option.textContent.trim(),
        amount: Number(option.dataset.amount) || 0,
    }));
}

function updateBookingSummary() {
    const summary = document.querySelector('#booking-sidebar .booking-summary');
    if (!summary) return;

    const serviceSection = summary.querySelector('[data-summary-section="service"]');
    const addonsSection = summary.querySelector('[data-summary-section="addons"]');
    const serviceRows = summary.querySelector('[data-summary-rows="service"]');
    const addonsRows = summary.querySelector('[data-summary-rows="addons"]');
    const addonsHeading = summary.querySelector('[data-summary-addons-heading]');
    const totalEl = summary.querySelector('[data-summary-total]');

    const services = getBookingSummaryItems('service');
    const addons = getBookingSummaryItems('addons');

    if (serviceRows) {
        const timeRange = getSelectedTimeLabel();
        serviceRows.innerHTML = services.map(item => {
            const label = timeRange ? `${item.label} (${timeRange})` : item.label;
            return `
            <div class="booking-summary__row" data-value="${item.value}">
                <span>${label}</span>
                <span>${formatBookingMoney(item.amount)}</span>
            </div>
        `;
        }).join('');
    }

    if (addonsRows) {
        addonsRows.innerHTML = addons.map(item => `
            <div class="booking-summary__row" data-value="${item.value}">
                <span>${item.label}</span>
                <span>${formatBookingMoney(item.amount, { plus: true })}</span>
            </div>
        `).join('');
    }

    if (serviceSection) serviceSection.hidden = services.length === 0;
    if (addonsSection) addonsSection.hidden = addons.length === 0;

    if (addonsHeading) {
        addonsHeading.textContent = `Add-Ons (${addons.length})`;
    }

    const total = [...services, ...addons].reduce((sum, item) => sum + item.amount, 0);
    if (totalEl) totalEl.textContent = formatBookingMoney(total);
}

window.updateBookingSummary = updateBookingSummary;
window.updateBookingCta = updateBookingCta;
updateBookingSummary();

function renderCalendar() {
    if (!datesContainer || !headerTitle) return;

    datesContainer.innerHTML = '';

    const year = currentDate.getFullYear();
    const month = currentDate.getMonth();

    headerTitle.textContent = `${monthNames[month]} ${year}`;

    const firstDay = new Date(year, month, 1).getDay() || 7;
    const daysInMonth = new Date(year, month + 1, 0).getDate();

    for (let i = 1; i < firstDay; i++) {
        datesContainer.appendChild(document.createElement('div'));
    }

    for (let day = 1; day <= daysInMonth; day++) {
        const dateDiv = document.createElement('div');
        dateDiv.classList.add('date');
        dateDiv.textContent = day;

        const dateKey = `${year}-${String(month + 1).padStart(2, '0')}-${String(day).padStart(2, '0')}`;

        if (availableDates.includes(dateKey)) {
            dateDiv.classList.add('available');

            if (selectedDay === day) {
                dateDiv.classList.add('selected');
            }

            dateDiv.addEventListener('click', () => {
                document.querySelectorAll('.date').forEach(d => d.classList.remove('selected'));
                dateDiv.classList.add('selected');
                selectedDay = day;
                updateBookingCta();
            });
        }

        datesContainer.appendChild(dateDiv);
    }

    updateBookingCta();
}

if (prevBtn) {
    prevBtn.addEventListener('click', () => {
        currentDate.setMonth(currentDate.getMonth() - 1);
        selectedDay = null;
        renderCalendar();
    });
}

if (nextBtn) {
    nextBtn.addEventListener('click', () => {
        currentDate.setMonth(currentDate.getMonth() + 1);
        selectedDay = null;
        renderCalendar();
    });
}

// Time selection (unchanged)
document.querySelectorAll('.time').forEach(time => {
    time.addEventListener('click', () => {
        const scope = time.closest('.times') || document;
        scope.querySelectorAll('.time').forEach(t => t.classList.remove('selected'));
        time.classList.add('selected');
        updateBookingCta();
        if (typeof window.updateBookingSummary === 'function') {
            window.updateBookingSummary();
        }
    });
});

renderCalendar();


const tabs_go_to = document.querySelectorAll('.tab-go-to-section a');

tabs_go_to.forEach((tab) => {
    tab.addEventListener('click', () => {
        document.querySelectorAll('.tab-go-to-section a').forEach((tab) => {
            tab.classList.remove('active');
        });
        tab.classList.add('active');
    });
});

// map shown tab js 
document.querySelectorAll('[data-tab]').forEach(tab => {
    tab.addEventListener('click', function () {
        if (this.dataset.tab === 'groomer-map-view') {
            // small delay ensures the element is visible before Leaflet measures it
            setTimeout(initModalMap, 100);
        }
    });
});
// map shown tab js 


// fav button
const favButton = document.querySelector('.fav');

favButton.addEventListener('click', () => {
    favButton.classList.toggle('active');

    const pressed = favButton.getAttribute('aria-pressed') === 'true';
    favButton.setAttribute('aria-pressed', !pressed);
});
// fav button



// show images js slider starts
let images = [];
let idx = 0;

document.addEventListener('DOMContentLoaded', () => {
    const gridImages = document.querySelectorAll('.image-grid-item img');

    gridImages.forEach((img, i) => {
        images.push({
            src: img.src,
            title: img.alt || `Photo ${i + 1}`,
            desc: img.dataset.desc || '' // ✅ THIS IS THE KEY CHANGE
        });

        img.parentElement.addEventListener('click', () => openLb(i));
    });

    const showAll = document.querySelector('.show-all-pics');
    if (showAll) {
        showAll.addEventListener('click', (e) => {
            e.stopPropagation();
            openLb(0);
        });
    }
});

function buildThumbs() {
    const wrap = document.getElementById('lbThumbs');
    wrap.innerHTML = '';

    images.forEach((p, i) => {
        const d = document.createElement('div');
        d.className = 'lb-thumb' + (i === idx ? ' active' : '');
        d.onclick = () => goTo(i);

        const img = document.createElement('img');
        img.src = p.src;
        img.alt = p.title;

        d.appendChild(img);
        wrap.appendChild(d);
    });
}

function render(animate) {
    const img = document.getElementById('lbImg');
    const item = images[idx];
    if (!item) return;

    if (animate) {
        img.classList.add('fading');
        setTimeout(() => {
            img.src = item.src;
            img.classList.remove('fading');
        }, 180);
    } else {
        img.src = item.src;
    }

    document.getElementById('lbTitle').textContent = item.title;
    document.getElementById('lbDesc').textContent = item.desc || '';
    document.getElementById('lbCount').textContent = `${idx + 1}/${images.length}`;

    document.querySelectorAll('.lb-thumb').forEach((t, i) => {
        t.classList.toggle('active', i === idx);
    });
}

function goTo(i) {
    idx = i;
    render(true);
}

function slide(dir) {
    idx = (idx + dir + images.length) % images.length;
    render(true);
}

function openLb(i) {
    idx = i;
    buildThumbs();
    render(false);
    document.getElementById('lbOverlay').classList.add('active');
    document.body.style.overflow = 'hidden';
}

function closeLb() {
    document.getElementById('lbOverlay').classList.remove('active');
    document.body.style.overflow = '';
}

function handleBgClick(e) {
    if (e.target.id === 'lbOverlay') closeLb();
}

document.addEventListener('keydown', (e) => {
    const overlay = document.getElementById('lbOverlay');
    if (!overlay.classList.contains('active')) return;

    if (e.key === 'ArrowLeft') slide(-1);
    if (e.key === 'ArrowRight') slide(1);
    if (e.key === 'Escape') closeLb();
});
// show images js slider ends


// link copy button  
document.getElementById('copy-link').addEventListener('click', function () {

    // Your copy logic here

    const tooltip = document.getElementById('copy-msg');

    tooltip.classList.add('show');

    setTimeout(() => {
        tooltip.classList.remove('show');
    }, 2000);
});

function copyLink() {
    const copyBtn = document.querySelector('.copy-btn');

    navigator.clipboard.writeText('groomerpage/share-link-fursgo.com').catch(() => { });

    copyBtn.textContent = 'Copied!';
    setTimeout(() => {
        copyBtn.textContent = 'Copy';
    }, 2000);
}


const selectedSection = document.getElementById('groomerSelectedSection');

if (selectedSection) {
    selectedSection.addEventListener('click', e => {
        const pill = e.target.closest('.selected-item');
        if (!pill) return;

        removePill(pill.dataset.value);
    });
}

function initPartnerBookingModal() {
    const modal = document.getElementById('groomer_book_space');
    if (!modal) return;

    const checkoutUrl = modal.dataset.partnerCheckout || '';
    const cards = modal.querySelectorAll('.space-cards');
    const continueBtns = modal.querySelectorAll('.modal-footer-btn.apply');
    let selectedCard = null;

    cards.forEach(card => card.classList.remove('active'));

    function setContinueEnabled(enabled) {
        continueBtns.forEach(btn => {
            btn.disabled = !enabled;
            btn.classList.toggle('is-disabled', !enabled);
        });
    }

    function selectCard(card) {
        cards.forEach(c => c.classList.remove('selected'));
        card.classList.add('selected');
        selectedCard = card;
        setContinueEnabled(true);
    }

    function resetSelection() {
        cards.forEach(c => c.classList.remove('selected'));
        selectedCard = null;
        setContinueEnabled(false);
    }

    cards.forEach(card => {
        card.addEventListener('click', e => {
            if (e.target.closest('.icons, .first-icon, .second-icon, .third-icon')) return;

            const slot = e.target.closest('.slot');
            if (slot) {
                e.stopPropagation();
                card.querySelectorAll('.slot').forEach(s => s.classList.remove('highlight'));
                slot.classList.add('highlight');
                selectCard(card);
                return;
            }

            selectCard(card);
        });
    });

    continueBtns.forEach(btn => {
        btn.addEventListener('click', e => {
            if (!selectedCard || !checkoutUrl) return;
            e.preventDefault();
            window.location.href = checkoutUrl;
        });
    });

    modal.querySelectorAll('[data-modal-close]').forEach(btn => {
        btn.addEventListener('click', resetSelection);
    });

    document.getElementById('goBack')?.addEventListener('click', resetSelection);

    resetSelection();
}

document.addEventListener('DOMContentLoaded', initPartnerBookingModal);

/* -------------------------
   Partner modal map (same as search_results)
--------------------------*/
function getAssetBaseUrl() {
    if (window.BASE_URL) return String(window.BASE_URL).replace(/\/?$/, '/');
    return '/';
}

function partnerModalTooltipImage(imageUrl, clipId) {
    return `
    <svg xmlns="http://www.w3.org/2000/svg" width="41" height="60" viewBox="0 0 41 60" style="display:block;">
        <defs>
            <clipPath id="${clipId}">
                <path d="M41 58C41 59.1046 40.1046 60 39 60H2C0.895431 60 0 59.1046 0 58V14C0 12.8954 0.895431 12 2 12H10C11.1046 12 12 11.1046 12 10V2C12 0.895431 12.8954 0 14 0H39C40.1046 0 41 0.895431 41 2V58Z"/>
            </clipPath>
        </defs>
        <image href="${imageUrl}" width="41" height="60" preserveAspectRatio="xMidYMid slice" clip-path="url(#${clipId})" />
    </svg>`;
}

function partnerModalBadgeSvg(color) {
    return `
    <svg xmlns="http://www.w3.org/2000/svg" width="8" height="11" viewBox="0 0 21 22" fill="none">
        <rect x="4.14746" y="4.14746" width="12.443" height="13.8256" rx="3" fill="white" />
        <path d="M10.9482 0.125295C10.7667 0.043205 10.5723 0 10.3692 0C10.1662 0 9.97174 0.043205 9.79028 0.125295L1.65477 3.57738C0.704262 3.97918 -0.00430085 4.91673 1.96518e-05 6.0487C0.0216222 10.3346 1.78439 18.1764 9.22861 21.7408C9.95014 22.0864 10.7883 22.0864 11.5098 21.7408C18.9541 18.1764 20.7168 10.3346 20.7384 6.0487C20.7428 4.91673 20.0342 3.97918 19.0837 3.57738L10.9482 0.125295ZM6.26043 12.3653C6.46781 12.4171 6.68816 12.443 6.91282 12.443C8.43796 12.443 9.67795 11.2031 9.67795 9.67793V6.9128H11.5876C12.1104 6.9128 12.59 7.2066 12.8233 7.67753L13.1343 8.29537H15.8995C16.2797 8.29537 16.5907 8.60644 16.5907 8.98665V10.3692C16.5907 12.2789 15.044 13.8256 13.1343 13.8256H11.0605V16.0161C11.0605 16.3315 10.8056 16.5907 10.4859 16.5907C10.4081 16.5907 10.3303 16.5734 10.2612 16.5432L5.99688 14.7156C5.71172 14.5947 5.53026 14.3138 5.53026 14.0071C5.53026 13.8861 5.55619 13.7694 5.61235 13.6614L6.26043 12.3653ZM6.22154 6.9128H8.29538V9.67793C8.29538 10.4427 7.67755 11.0605 6.91282 11.0605C6.1481 11.0605 5.53026 10.4427 5.53026 9.67793V7.60408C5.53026 7.22388 5.84134 6.9128 6.22154 6.9128ZM11.7518 8.98665C11.7518 8.80331 11.679 8.62748 11.5493 8.49784C11.4197 8.3682 11.2438 8.29537 11.0605 8.29537C10.8772 8.29537 10.7013 8.3682 10.5717 8.49784C10.4421 8.62748 10.3692 8.80331 10.3692 8.98665C10.3692 9.16998 10.4421 9.34581 10.5717 9.47545C10.7013 9.60509 10.8772 9.67793 11.0605 9.67793C11.2438 9.67793 11.4197 9.60509 11.5493 9.47545C11.679 9.34581 11.7518 9.16998 11.7518 8.98665Z" fill="${color}" />
    </svg>`;
}

function buildPartnerModalPopup(loc, index, type) {
    const base = getAssetBaseUrl();
    const imageUrl = loc.image.startsWith('http') ? loc.image : base + loc.image.replace(/^\//, '');
    const badgeColor = type === 'space' ? '#CBDCE8' : '#C9DDA0';
    const subtitle = type === 'space'
        ? `<h2 class="name" style="margin:0;font-size:14px;font-weight:600;color:#3B3731;">Hosted by <span class="studio">${loc.name}</span></h2>`
        : `<span class="studio">${loc.name}</span>`;

    const locationSVG = `
        <svg xmlns="http://www.w3.org/2000/svg" width="10" height="14" viewBox="0 0 10 14" fill="none" style="vertical-align:middle;margin-right:2px;">
            <path d="M5 6.65C4.5264 6.65 4.0722 6.46563 3.73731 6.13744C3.40242 5.80925 3.21429 5.36413 3.21429 4.9C3.21429 4.43587 3.40242 3.99075 3.73731 3.66256C4.0722 3.33437 4.5264 3.15 5 3.15C5.4736 3.15 5.9278 3.33437 6.26269 3.66256C6.59758 3.99075 6.78571 4.43587 6.78571 4.9C6.78571 5.12981 6.73953 5.35738 6.64979 5.5697C6.56004 5.78202 6.42851 5.97493 6.26269 6.13744C6.09687 6.29994 5.90002 6.42884 5.68336 6.51679C5.46671 6.60473 5.2345 6.65 5 6.65ZM5 0C3.67392 0 2.40215 0.516248 1.46447 1.43518C0.526784 2.3541 0 3.60044 0 4.9C0 8.575 5 14 5 14C5 14 10 8.575 10 4.9C10 3.60044 9.47322 2.3541 8.53553 1.43518C7.59785 0.516248 6.32608 0 5 0Z" fill="#FFC97A"/>
        </svg>`;

    const starSVG = `
        <svg xmlns="http://www.w3.org/2000/svg" width="10" height="14" viewBox="0 0 14 14" fill="none" style="vertical-align:middle;margin-right:2px;">
            <path d="M6.12956 0.660476C6.40354 -0.220161 7.59647 -0.220158 7.87045 0.660479L8.89548 3.95519C9.01801 4.34902 9.36942 4.61566 9.76593 4.61566H13.083C13.9696 4.61566 14.3383 5.80055 13.621 6.34481L10.9374 8.38106C10.6166 8.62446 10.4824 9.0559 10.6049 9.44973L11.63 12.7444C11.9039 13.6251 10.9388 14.3574 10.2215 13.8131L7.53797 11.7769C7.21719 11.5335 6.78282 11.5335 6.46204 11.7769L3.77846 13.8131C3.06117 14.3574 2.09607 13.6251 2.37005 12.7444L3.39508 9.44973C3.51761 9.0559 3.38338 8.62446 3.0626 8.38106L0.37903 6.34481C-0.338258 5.80055 0.0303816 4.61566 0.916998 4.61566H4.23408C4.63058 4.61566 4.98199 4.34902 5.10452 3.95519L6.12956 0.660476Z" fill="#FFC97A"/>
        </svg>`;

    return `
        <div style="min-width:215px;position:relative;">
            <div class="map-top-left-svg">${partnerModalBadgeSvg(badgeColor)}</div>
            <div style="display:flex;gap:10px;align-items:center;">
                <div>${partnerModalTooltipImage(imageUrl, `modal-clip-${type}-${index}`)}</div>
                <div style="flex:1;">
                    <h2 class="name" style="margin:0 0 0px;font-size:14px;font-weight:600;color:#3B3731;">${loc.loc_name}</h2>
                    ${subtitle}
                    <div class="map-meta d-flex align-items-center justify-content-between mt-2" style="font-size:14px;color:#3B3731;font-weight:500;line-height:1.4;">
                        <span class="d-flex align-items-center">${locationSVG} ${loc.distance}</span>
                        <span class="d-flex align-items-center">${starSVG} ${loc.rating} (${loc.reviews})</span>
                    </div>
                </div>
            </div>
        </div>`;
}

function enablePartnerModalMapCtrlZoom(map) {
    map.scrollWheelZoom.disable();
    const container = map.getContainer();
    const wrapper = container.closest('.map-wrapper') || container.closest('.map-div') || container.parentElement;

    if (wrapper && !wrapper.querySelector('.map-zoom-hint')) {
        const hint = document.createElement('div');
        hint.className = 'map-zoom-hint';
        hint.setAttribute('aria-hidden', 'true');
        hint.innerHTML = '<span class="map-zoom-hint__key">Ctrl</span> + scroll to zoom';
        wrapper.appendChild(hint);
    }

    container.addEventListener('wheel', function (e) {
        if (e.ctrlKey || e.metaKey) {
            e.preventDefault();
            map.scrollWheelZoom.enable();
            clearTimeout(map._ctrlZoomTimeout);
            map._ctrlZoomTimeout = setTimeout(() => map.scrollWheelZoom.disable(), 1000);
        } else {
            map.scrollWheelZoom.disable();
        }
    }, { passive: false });
}

window.initPartnerModalMap = function initPartnerModalMap() {
    if (typeof L === 'undefined') return;

    const mapEl = document.getElementById('modal-map');
    if (!mapEl) return;

    if (window.partnerModalMap) {
        setTimeout(() => {
            window.partnerModalMap.invalidateSize(true);
        }, 80);
        return;
    }

    const mapType = mapEl.dataset.mapType || (document.body.classList.contains('space-profile') ? 'groomer' : 'space');
    const base = getAssetBaseUrl();

    const groomerLocations = [
        {
            loc_name: "Sarah's Grooming Studio",
            name: 'Sarah W.',
            lat: 51.5033,
            lng: -0.1147,
            image: base + 'assets/images/card1.png',
            distance: '2.5 mi',
            rating: '4.3',
            reviews: '20'
        },
        {
            loc_name: 'Westminster Pet Spa',
            name: 'Sarah W.',
            lat: 51.4995,
            lng: -0.1248,
            image: base + 'assets/images/card2.png',
            distance: '3.1 mi',
            rating: '4.7',
            reviews: '45'
        },
        {
            loc_name: 'Sarah Grooming',
            name: 'Sarah W.',
            lat: 51.511227,
            lng: -0.119470,
            image: base + 'assets/images/card3.png',
            distance: '1.8 mi',
            rating: '4.5',
            reviews: '32'
        }
    ];

    const spaceLocations = [
        {
            loc_name: 'Furs & Co. Studio',
            name: 'Dev É',
            lat: 51.5074,
            lng: -0.1657,
            image: base + 'assets/images/space_card3.png',
            distance: '2.5 mi',
            rating: '4.3',
            reviews: '20'
        },
        {
            loc_name: 'Kensington Gardens',
            name: 'Kensington Gardens',
            lat: 51.5074,
            lng: -0.1850,
            image: base + 'assets/images/space_card1.png',
            distance: '3.1 mi',
            rating: '4.7',
            reviews: '45'
        },
        {
            loc_name: "Regent's Park",
            name: "Regent's Park",
            lat: 51.5313,
            lng: -0.1568,
            image: base + 'assets/images/space_card2.png',
            distance: '1.8 mi',
            rating: '4.5',
            reviews: '32'
        }
    ];

    const locations = mapType === 'space' ? spaceLocations : groomerLocations;

    const map = L.map('modal-map', {
        zoomControl: false,
        attributionControl: false,
        preferCanvas: true,
        dragging: true,
        scrollWheelZoom: false,
        doubleClickZoom: true,
        boxZoom: true,
        keyboard: true,
        touchZoom: true
    });

    L.control.zoom({
        position: 'bottomright',
        zoomInTitle: 'Zoom in',
        zoomOutTitle: 'Zoom out'
    }).addTo(map);

    enablePartnerModalMapCtrlZoom(map);

    L.tileLayer('https://{s}.basemaps.cartocdn.com/light_nolabels/{z}/{x}/{y}{r}.png', {
        subdomains: 'abcd',
        maxZoom: 20
    }).addTo(map);

    L.tileLayer('https://{s}.basemaps.cartocdn.com/light_only_labels/{z}/{x}/{y}{r}.png', {
        subdomains: 'abcd',
        maxZoom: 20,
        pane: 'overlayPane'
    }).addTo(map);

    const yellowPin = L.icon({
        iconUrl: 'data:image/svg+xml;utf8,' + encodeURIComponent(`
            <svg xmlns="http://www.w3.org/2000/svg" width="34" height="48" viewBox="0 0 34 48" fill="none">
                <path d="M17 22.8C15.3898 22.8 13.8455 22.1679 12.7069 21.0426C11.5682 19.9174 10.9286 18.3913 10.9286 16.8C10.9286 15.2087 11.5682 13.6826 12.7069 12.5574C13.8455 11.4321 15.3898 10.8 17 10.8C18.6102 10.8 20.1545 11.4321 21.2931 12.5574C22.4318 13.6826 23.0714 15.2087 23.0714 16.8ZM17 0C12.4913 0 8.1673 1.76999 4.97918 4.92061C1.79107 8.07122 0 12.3444 0 16.8C0 29.4 17 48 17 48C17 48 34 29.4 34 16.8C34 12.3444 32.2089 8.07122 29.0208 4.92061C25.8327 1.76999 21.5087 0 17 0Z" fill="#FFC97A"/>
            </svg>
        `),
        iconSize: [28, 28],
        iconAnchor: [14, 28],
        popupAnchor: [0, -26]
    });

    const markers = [];
    locations.forEach((loc, index) => {
        const marker = L.marker([loc.lat, loc.lng], { icon: yellowPin })
            .addTo(map)
            .bindPopup(buildPartnerModalPopup(loc, index, mapType), {
                closeButton: false,
                autoClose: false,
                closeOnClick: false,
                className: 'custom-popup',
                offset: [0, -35]
            });

        // Remove Leaflet's default click-to-open so we control toggle ourselves
        marker.off('click');

        marker.on('mouseover', function () {
            this.openPopup();
        });

        marker.on('click', function (e) {
            L.DomEvent.stopPropagation(e);
            if (this.isPopupOpen()) {
                this.closePopup();
            } else {
                this.openPopup();
            }
        });

        markers.push(marker);
    });

    // Click empty map area to close open popups
    map.on('click', () => {
        markers.forEach(marker => marker.closePopup());
    });

    window.partnerModalMap = map;
    window.partnerModalMapMarkers = markers;

    setTimeout(() => {
        map.invalidateSize(true);
        map.fitBounds(locations.map(l => [l.lat, l.lng]), {
            padding: [40, 40],
            maxZoom: 15
        });
    }, 120);
};

document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('#groomer_book_space [data-tab="groomer-map-view"]').forEach(btn => {
        btn.addEventListener('click', () => {
            setTimeout(() => window.initPartnerModalMap?.(), 50);
        });
    });
});

window.initModalMap = function () {
    window.initPartnerModalMap?.();
};

/* -------------------------
   CREATE PILL
--------------------------*/
function addPill(label, value, group, type) {

    // prevent duplicates (checkbox only)
    if (type === 'checkbox' &&
        selectedSection.querySelector(`[data-value="${value}"]`)
    ) return;

    const pill = document.createElement('div');
    pill.className = 'selected-item d-flex align-items-center gap-10 cursor';

    pill.dataset.value = value;
    pill.dataset.group = group;
    pill.dataset.type = type;

    pill.innerHTML = `
        <p>${label}</p>
        <svg class="cross cursor" width="9" height="9" viewBox="0 0 9 9">
            <path d="M0.5 7.57L7.57 0.5M0.5 0.5L7.57 7.57" stroke="#FBAC83"/>
        </svg>
    `;

    selectedSection.appendChild(pill);
}


/* -------------------------
   REMOVE PILL + INPUT RESET
--------------------------*/
function removePill(value) {

    // remove pill
    const pill = selectedSection.querySelector(`[data-value="${value}"]`);
    if (pill) pill.remove();

    // uncheck input
    document.querySelectorAll(`input[value="${value}"]`)
        .forEach(i => i.checked = false);
}


/* -------------------------
   CLOSE DROPDOWN
--------------------------*/
function closeDropdown(input) {
    const wrapper = input.closest('.sort-by, .venu-sorting-section');
    if (!wrapper) return;

    const dropdown = wrapper.querySelector('.sort-by-filter, .venue-list');
    if (dropdown) dropdown.style.display = 'none';

    wrapper.classList.remove('open');
}


function isFilterInput(input) {
    return !input.closest('#block_profile_modal');
}

/* -------------------------
   CHANGE HANDLER
--------------------------*/
document.addEventListener('change', (e) => {
    const input = e.target;

    if (!isFilterInput(input)) return;

    const label =
        input.closest('label')?.querySelector('.option-text')?.innerText
        || input.value;

    const group = input.name;


    // CHECKBOX
    if (input.type === 'checkbox') {

        if (input.checked) {
            addPill(label, input.value, group, 'checkbox');
        } else {
            removePill(input.value);
        }
    }


    // RADIO
    if (input.type === 'radio') {

        // remove old radio pill(s)
        selectedSection
            .querySelectorAll('[data-type="radio"]')
            .forEach(el => el.remove());

        addPill(label, input.value, group, 'radio');
        closeDropdown(input);
    }
});


/* -------------------------
   INIT PRE-CHECKED INPUTS
--------------------------*/
document.querySelectorAll('input[type="checkbox"]:checked').forEach(input => {
    if (!isFilterInput(input)) return;

    const label =
        input.closest('label')?.querySelector('.option-text')?.innerText
        || input.value;
    addPill(label, input.value, input.name, 'checkbox');
});


// custom select multiselect dropdown  

document.querySelectorAll('.custom-select[data-multiselect]').forEach(select => {

    const trigger = select.querySelector('.select-trigger');
    const optionItems = select.querySelectorAll('.select-options li');
    const hiddenInput = select.querySelector('input[type="hidden"]');
    const pillContainer = select.closest('.service-type-select')
        .querySelector('.service-selected-options');

    const selectedText = select.querySelector('.selected-text');
    const selectedPrice = select.querySelector('.selected-price');
    const color = select.dataset.color || '#FBAC83';
    const placeholder = select.dataset.placeholder || 'Select add-ons';

    const selected = new Set();

    function getOptionLabel(option) {
        return option.dataset.label
            || option.querySelector('.option-label')?.textContent.trim()
            || option.textContent.trim();
    }

    function getOptionPrice(option) {
        return option?.dataset.price || '';
    }

    // ✅ update selected text
    function updateSelectedText() {
        if (selected.size === 0) {
            selectedText.textContent = placeholder;
            if (selectedPrice) selectedPrice.textContent = '';
            return;
        }

        const last = [...selected].pop();

        const option = select.querySelector(
            `li[data-value="${CSS.escape(last)}"]`
        );

        selectedText.textContent = getOptionLabel(option) || placeholder;
        if (selectedPrice) selectedPrice.textContent = getOptionPrice(option);
    }

    // Open / close
    trigger.addEventListener('click', e => {
        e.stopPropagation();
        closeOthers(select);

        select.classList.toggle('open');

        const isOpen = select.classList.contains('open');
        trigger.style.borderBottomLeftRadius = isOpen ? '0' : '12px';
        trigger.style.borderBottomRightRadius = isOpen ? '0' : '12px';
    });

    // Option click
    optionItems.forEach(option => {
        option.addEventListener('click', e => {
            e.stopPropagation();

            const val = option.dataset.value;
            const label = getOptionLabel(option);
            const price = getOptionPrice(option);

            if (selected.has(val)) {
                selected.delete(val);
                option.classList.remove('selected');
                removePill(val);
            } else {
                selected.add(val);
                option.classList.add('selected');
                createPill(val, label, price);
            }

            select.classList.remove('open');

            trigger.style.borderBottomLeftRadius = '12px';
            trigger.style.borderBottomRightRadius = '12px';

            select.classList.toggle('has-value', selected.size > 0);

            hiddenInput.value = [...selected].join(',');

            updateSelectedText(); // ✅ ADDED
            if (select.closest('#booking-sidebar') && typeof window.updateBookingSummary === 'function') {
                window.updateBookingSummary();
            }
        });
    });

    function createPill(val, label, price = '') {
        const pill = document.createElement('div');
        const variant = select.dataset.pill || 'custom';
        pill.className = `selected-item selected-item--${variant} d-flex align-items-center gap-10`;
        pill.dataset.value = val;

        // Dynamic theme only when no preset variant (e.g. space profile)
        if (variant === 'custom') {
            const bg = select.dataset.bg || 'transparent';
            const borderColor = select.dataset.border || color;
            pill.style.setProperty('--pill-bg', bg);
            pill.style.setProperty('--pill-color', color);
            pill.style.setProperty('--pill-border', borderColor);
        }

        const pillLabel = price ? `${label} ${price}` : label;

        pill.innerHTML = `
        <p>${pillLabel}</p>
        <svg xmlns="http://www.w3.org/2000/svg" width="9" height="9" viewBox="0 0 9 9" fill="none">
            <path d="M0.5 7.57L7.572 0.5M0.5 0.5L7.572 7.57"
                stroke="currentColor" stroke-linecap="round"/>
        </svg>
    `;

        pill.addEventListener('click', ev => {
            ev.stopPropagation();

            selected.delete(val);
            pill.remove();

            select.querySelector(`li[data-value="${CSS.escape(val)}"]`)
                ?.classList.remove('selected');

            select.classList.toggle('has-value', selected.size > 0);
            hiddenInput.value = [...selected].join(',');

            updateSelectedText();
            if (select.closest('#booking-sidebar') && typeof window.updateBookingSummary === 'function') {
                window.updateBookingSummary();
            }
        });

        pillContainer.appendChild(pill);
    }

    function removePill(val) {
        pillContainer
            .querySelector(`.selected-item[data-value="${CSS.escape(val)}"]`)
            ?.remove();

        updateSelectedText(); // optional safety sync
    }
});

// custom select single-select (booking service type — highlight in trigger, no pills)
document.querySelectorAll('.custom-select[data-singleselect]').forEach(select => {
    const trigger = select.querySelector('.select-trigger');
    const optionItems = select.querySelectorAll('.select-options li');
    const hiddenInput = select.querySelector('input[type="hidden"]');
    const selectedText = select.querySelector('.selected-text');
    const selectedPrice = select.querySelector('.selected-price');
    const placeholder = select.dataset.placeholder || 'Select';

    function getOptionLabel(option) {
        return option.dataset.label
            || option.querySelector('.option-label')?.textContent.trim()
            || option.textContent.trim();
    }

    function getOptionPrice(option) {
        return option?.dataset.price || '';
    }

    function setSelection(option) {
        optionItems.forEach(item => item.classList.remove('selected'));

        if (!option) {
            if (selectedText) selectedText.textContent = placeholder;
            if (selectedPrice) selectedPrice.textContent = '';
            if (hiddenInput) hiddenInput.value = '';
            select.classList.remove('has-value');
            return;
        }

        option.classList.add('selected');
        if (selectedText) selectedText.textContent = getOptionLabel(option);
        if (selectedPrice) selectedPrice.textContent = getOptionPrice(option);
        if (hiddenInput) hiddenInput.value = option.dataset.value || '';
        select.classList.add('has-value');
    }

    trigger?.addEventListener('click', e => {
        e.stopPropagation();
        closeOthers(select);

        select.classList.toggle('open');
        const isOpen = select.classList.contains('open');
        trigger.style.borderBottomLeftRadius = isOpen ? '0' : '12px';
        trigger.style.borderBottomRightRadius = isOpen ? '0' : '12px';
    });

    optionItems.forEach(option => {
        option.addEventListener('click', e => {
            e.stopPropagation();

            const alreadySelected = option.classList.contains('selected');
            setSelection(alreadySelected ? null : option);

            select.classList.remove('open');
            trigger.style.borderBottomLeftRadius = '12px';
            trigger.style.borderBottomRightRadius = '12px';

            if (select.closest('#booking-sidebar') && typeof window.updateBookingSummary === 'function') {
                window.updateBookingSummary();
            }
        });
    });
});

function closeOthers(current) {
    document.querySelectorAll('.custom-select:not([data-multiselect])').forEach(s => {
        if (s === current) return;
        s.classList.remove('open');
        const t = s.querySelector('.select-trigger');
        if (t) {
            t.style.borderBottomLeftRadius = '12px';
            t.style.borderBottomRightRadius = '12px';
        }
    });
    document.querySelectorAll('.custom-select[data-multiselect]').forEach(s => {
        if (s === current) return;
        s.classList.remove('open');
        const t = s.querySelector('.select-trigger');
        if (t) {
            t.style.borderBottomLeftRadius = '12px';
            t.style.borderBottomRightRadius = '12px';
        }
    });
}

document.addEventListener('click', () => {
    document.querySelectorAll('.custom-select[data-multiselect], .custom-select[data-singleselect]').forEach(s => {
        if (!s.classList.contains('open')) return;

        s.classList.remove('open');
        const trigger = s.querySelector('.select-trigger');
        if (trigger) {
            trigger.style.borderBottomLeftRadius = '12px';
            trigger.style.borderBottomRightRadius = '12px';
        }
    });
});