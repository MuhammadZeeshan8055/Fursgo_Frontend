// calendar
const monthNames = [
    "January", "February", "March", "April", "May", "June",
    "July", "August", "September", "October", "November", "December"
];

let currentDate = new Date(2025, 9); // October 2025

const headerTitle = document.querySelector('.calendar-header span');
const datesContainer = document.querySelector('.dates');
const prevBtn = document.querySelector('.nav-btn:first-child');
const nextBtn = document.querySelector('.nav-btn:last-child');

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

function renderCalendar() {
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

            dateDiv.addEventListener('click', () => {
                document.querySelectorAll('.date').forEach(d => d.classList.remove('selected'));
                dateDiv.classList.add('selected');
            });
        }

        datesContainer.appendChild(dateDiv);
    }
}

prevBtn.addEventListener('click', () => {
    currentDate.setMonth(currentDate.getMonth() - 1);
    renderCalendar();
});

nextBtn.addEventListener('click', () => {
    currentDate.setMonth(currentDate.getMonth() + 1);
    renderCalendar();
});

// Time selection (unchanged)
document.querySelectorAll('.time').forEach(time => {
    time.addEventListener('click', () => {
        document.querySelectorAll('.time').forEach(t => t.classList.remove('selected'));
        time.classList.add('selected');
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

selectedSection.addEventListener('click', e => {
    const pill = e.target.closest('.selected-item');
    if (!pill) return;

    removePill(pill.dataset.value);
});

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


/* -------------------------
   CHANGE HANDLER
--------------------------*/
document.addEventListener('change', (e) => {
    const input = e.target;

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
    const color = select.dataset.color || '#FBAC83';

    const selected = new Set();

    // ✅ update selected text
    function updateSelectedText() {
        if (selected.size === 0) {
            selectedText.textContent = select.dataset.placeholder || 'Select add-ons';
            return;
        }

        const last = [...selected].pop();

        const label = select.querySelector(
            `li[data-value="${CSS.escape(last)}"]`
        )?.textContent.trim();

        selectedText.textContent = label || 'Select add-ons';
    }

    // Open / close
    trigger.addEventListener('click', e => {
        e.stopPropagation();
        closeOthers(select);

        select.classList.toggle('open');

        const isOpen = select.classList.contains('open');
        trigger.style.cssText = isOpen
            ? 'border-bottom-left-radius:0;border-bottom-right-radius:0;'
            : 'border-bottom-left-radius:12px;border-bottom-right-radius:12px;';
    });

    // Option click
    optionItems.forEach(option => {
        option.addEventListener('click', e => {
            e.stopPropagation();

            const val = option.dataset.value;
            const label = option.textContent.trim();

            if (selected.has(val)) {
                selected.delete(val);
                option.classList.remove('selected');
                removePill(val);
            } else {
                selected.add(val);
                option.classList.add('selected');
                createPill(val, label);
            }

            select.classList.remove('open');

            trigger.style.cssText =
                'border-bottom-left-radius:12px;border-bottom-right-radius:12px;';

            select.classList.toggle('has-value', selected.size > 0);

            hiddenInput.value = [...selected].join(',');

            updateSelectedText(); // ✅ ADDED
        });
    });

    function createPill(val, label) {
        const pill = document.createElement('div');
        pill.className = 'selected-item d-flex align-items-center gap-10';
        pill.dataset.value = val;

        pill.style.cssText = `
        background:none;
        color:${color};
        border:1px solid ${color};
        cursor:pointer;
    `;

        pill.innerHTML = `
        <p>${label}</p>
        <svg style="flex-shrink:0;pointer-events:none;"
            xmlns="http://www.w3.org/2000/svg"
            width="9" height="9" viewBox="0 0 9 9" fill="none">
            <path d="M0.5 7.57L7.572 0.5M0.5 0.5L7.572 7.57"
                stroke="${color}" stroke-linecap="round"/>
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

function closeOthers(current) {
    document.querySelectorAll('.custom-select:not([data-multiselect])').forEach(s => {
        if (s === current) return;
        s.classList.remove('open');
    });
}

document.addEventListener('click', () => {
    document.querySelectorAll('.custom-select:not([data-multiselect]').forEach(s => {
        if (!s.classList.contains('open')) return;

        s.classList.remove('open');
        s.querySelector('.select-trigger').style.cssText =
            'border-bottom-left-radius:12px;border-bottom-right-radius:12px;';
    });
});