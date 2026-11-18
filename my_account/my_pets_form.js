/**
 * Pet form — Edit details OR Add pet (same UI).
 * Events: pets:edit { card }, pets:add
 */
(function () {
    const listShell = document.getElementById('pets-list-shell');
    const editView = document.getElementById('pets-edit-view');
    const form = document.getElementById('ep-form');
    const activeGrid = document.getElementById('pets-grid');
    const addBtn = document.getElementById('pets-add-btn');
    if (!editView || !form) return;

    const titleEl = document.getElementById('ep-title');
    const saveBtn = document.getElementById('ep-save');
    const petIdInput = document.getElementById('ep-pet-id');
    const nameInput = document.getElementById('ep-name');
    const nameCheck = document.getElementById('ep-name-check');
    const birthdayHidden = form.querySelector('input[name="ep_birthday"]');
    const otherTypeWrap = document.getElementById('ep-other-type-wrap');
    const otherTypeInput = document.getElementById('ep-other-type');
    const otherCheck = document.getElementById('ep-other-check');
    const breedSelect = document.getElementById('ep-breed');
    const weightInput = document.getElementById('ep-weight');
    const weightUpBtn = document.getElementById('ep-weight-up');
    const weightDownBtn = document.getElementById('ep-weight-down');
    const medicalInput = document.getElementById('ep-medical');
    const personalityInput = document.getElementById('ep-personality');
    const groomingInput = document.getElementById('ep-grooming');
    const groomingBehaviourInput = document.getElementById('ep-grooming-behaviour');
    const productPrefsInput = document.getElementById('ep-product-prefs');
    const medicationInput = document.getElementById('ep-medication');
    const emergencyNameInput = document.getElementById('ep-emergency-name');
    const emergencyPhoneInput = document.getElementById('ep-emergency-phone');
    const notesInput = document.getElementById('ep-notes');
    const avatarImg = document.getElementById('ep-avatar-img');
    const avatarPh = document.getElementById('ep-avatar-ph');
    const avatarInput = document.getElementById('ep-avatar-input');
    const avatarBtn = document.getElementById('ep-avatar-btn');
    const cancelBtn = document.getElementById('ep-cancel');

    const conditionInput = document.getElementById('ep-condition-input');
    const conditionAdd = document.getElementById('ep-condition-add');
    const conditionList = document.getElementById('ep-condition-list');
    const allergyInput = document.getElementById('ep-allergy-input');
    const allergyAdd = document.getElementById('ep-allergy-add');
    const allergyList = document.getElementById('ep-allergy-list');
    const vaccineInput = document.getElementById('ep-vaccine-input');
    const vaccineAdd = document.getElementById('ep-vaccine-add');
    const vaccineList = document.getElementById('ep-vaccine-list');

    const BREEDS = {
        cat: ['British Shorthair', 'Persian', 'Siamese', 'Maine Coon', 'Ragdoll', 'Other'],
        dog: ['Cockapoo', 'French Bulldog', 'Labrador', 'Golden Retriever', 'Poodle', 'Other'],
        other: ['Mini Lop', 'Holland Lop', 'Guinea Pig', 'Hamster', 'Other']
    };

    /** 'edit' | 'add' */
    let mode = 'edit';
    let editingCard = null;

    function setType(value) {
        document.querySelectorAll('#ep-type-group .pet-option').forEach(function (btn) {
            btn.classList.toggle('highlight', btn.getAttribute('data-pet') === value);
        });
    }

    function getType() {
        const active = document.querySelector('#ep-type-group .pet-option.highlight');
        return active ? active.getAttribute('data-pet') : '';
    }

    function setSize(value) {
        document.querySelectorAll('#ep-size-group .weight-option').forEach(function (btn) {
            btn.classList.toggle('active', btn.getAttribute('data-weight') === value);
        });
    }

    function getSize() {
        const active = document.querySelector('#ep-size-group .weight-option.active');
        return active ? active.getAttribute('data-weight') : '';
    }

    function fillBreeds(type, selected) {
        const list = BREEDS[type] || BREEDS.other;
        breedSelect.innerHTML = '<option value="">Select breed</option>';
        list.forEach(function (b) {
            const opt = document.createElement('option');
            opt.value = b;
            opt.textContent = b;
            breedSelect.appendChild(opt);
        });
        if (selected) {
            if (list.indexOf(selected) === -1) {
                const opt = document.createElement('option');
                opt.value = selected;
                opt.textContent = selected;
                breedSelect.appendChild(opt);
            }
            breedSelect.value = selected;
        }
    }

    function setAvatar(src) {
        if (src) {
            avatarImg.src = src;
            avatarImg.hidden = false;
            if (avatarPh) avatarPh.hidden = true;
        } else {
            avatarImg.removeAttribute('src');
            avatarImg.hidden = true;
            if (avatarPh) avatarPh.hidden = false;
        }
    }

    /** Convert card birthday (dd/mm/yyyy) → ISO (Y-m-d) for the calendar hidden input */
    function toIsoBirthday(value) {
        if (!value) return '';
        if (/^\d{4}-\d{2}-\d{2}$/.test(value)) return value;
        const m = String(value).match(/(\d{1,2})[\/\-](\d{1,2})[\/\-](\d{4})/);
        if (!m) return '';
        return m[3] + '-' + m[2].padStart(2, '0') + '-' + m[1].padStart(2, '0');
    }

    /** Convert ISO (Y-m-d) → dd/mm/yyyy for pet cards */
    function toDisplayBirthday(iso) {
        if (!iso) return '';
        if (/^\d{2}\/\d{2}\/\d{4}$/.test(iso)) return iso;
        const parts = String(iso).split('-');
        if (parts.length !== 3) return iso;
        return parts[2] + '/' + parts[1] + '/' + parts[0];
    }

    function setBirthdayField(value) {
        if (!birthdayHidden) return;
        const iso = toIsoBirthday(value);
        const uid = birthdayHidden.id.replace('bc-input-', '');
        const display = document.getElementById('bc-display-' + uid);
        const trigger = document.getElementById('bc-trigger-' + uid);

        if (iso) {
            birthdayHidden.value = iso;
            const parts = iso.split('-');
            if (display && parts.length === 3) {
                display.textContent = parts[2] + ' / ' + parts[1] + ' / ' + parts[0];
            }
            if (trigger) trigger.classList.remove('bc-empty');
        } else {
            birthdayHidden.value = '';
            if (display) {
                display.textContent =
                    (trigger && trigger.dataset.placeholder) || 'dd/mm/yyyy';
            }
            if (trigger) trigger.classList.add('bc-empty');
        }
        birthdayHidden.dispatchEvent(new Event('change', { bubbles: true }));
    }

    function getBirthdayDisplay() {
        if (!birthdayHidden || !birthdayHidden.value) return '';
        return toDisplayBirthday(birthdayHidden.value);
    }

    function updateChecks() {
        if (nameCheck) nameCheck.hidden = !(nameInput.value || '').trim();
        if (otherCheck) otherCheck.hidden = !(otherTypeInput.value || '').trim();
    }

    function syncOtherTypeVisibility() {
        const type = getType();
        if (otherTypeWrap) otherTypeWrap.hidden = type !== 'other';
    }

    function clearSlot(slot) {
        slot.classList.remove('has-photo');
        const img = slot.querySelector('.ep-gallery-preview');
        const input = slot.querySelector('.ep-gallery-input');
        const del = slot.querySelector('.ep-gallery-delete');
        if (img) {
            img.hidden = true;
            img.removeAttribute('src');
        }
        if (input) input.value = '';
        if (del) del.hidden = true;
    }

    function setSlotPhoto(slot, src) {
        const img = slot.querySelector('.ep-gallery-preview');
        const del = slot.querySelector('.ep-gallery-delete');
        if (!img) return;
        img.src = src;
        img.hidden = false;
        slot.classList.add('has-photo');
        if (del) del.hidden = false;
    }

    function resetGallery() {
        editView.querySelectorAll('.ep-gallery-slot').forEach(clearSlot);
    }

    function createTag(text) {
        const li = document.createElement('li');
        li.className = 'ep-tag';
        li.innerHTML =
            '<span class="ep-tag__text"></span>' +
            '<button type="button" class="ep-tag__remove" aria-label="Remove">' +
            '<svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12" fill="none" aria-hidden="true">' +
            '<path d="M11.2314 0.625061L0.624844 11.2317" stroke="#615A51" stroke-width="1.25" stroke-linecap="round"/>' +
            '<path d="M11.2402 11.2316L0.633634 0.625026" stroke="#615A51" stroke-width="1.25" stroke-linecap="round"/>' +
            '</svg></button>';
        li.querySelector('.ep-tag__text').textContent = text;
        return li;
    }

    function addTag(listEl, inputEl) {
        if (!listEl || !inputEl) return;
        const value = (inputEl.value || '').trim();
        if (!value) return;
        listEl.appendChild(createTag(value));
        inputEl.value = '';
        inputEl.focus();
    }

    function clearTagList(listEl) {
        if (listEl) listEl.innerHTML = '';
    }

    /* ---------- Vaccinations (simple helpers) ---------- */

    // Is the "Needs renewing" toggle on?
    function isVaccineRenewing(card) {
        const toggle = card.querySelector('.ep-vaccine-renew');
        if (!toggle) return false;
        return toggle.checked;
    }

    // Get Last given date as dd/mm/yyyy (calendar stores Y-m-d)
    function getVaccineLastDisplay(card) {
        const lastInput = card.querySelector('.ep-vaccine-last');
        if (!lastInput || !lastInput.value) return '';
        return toDisplayBirthday(lastInput.value);
    }

    // Build the collapsed row text: name + grey meta
    function getVaccineSummaryParts(card) {
        const nameInput = card.querySelector('.ep-vaccine-name');
        const name = (nameInput && nameInput.value) ? nameInput.value : 'Vaccine';

        // Toggle off → one-time vaccine
        if (!isVaccineRenewing(card)) {
            return {
                name: name,
                meta: '- One-time vaccine'
            };
        }

        // Toggle on → show last given + frequency when set
        const last = getVaccineLastDisplay(card);
        const freqInput = card.querySelector('.ep-vaccine-freq');
        const freq = (freqInput && freqInput.value) ? freqInput.value : '';

        let meta = '';
        if (last) meta += '- Last given: ' + last;
        if (freq) meta += ' (' + freq + ')';

        return {
            name: name,
            meta: meta
        };
    }

    // Show / hide Last given + Frequency based on the renew toggle
    function syncVaccineRenewUI(card) {
        const renewing = isVaccineRenewing(card);
        const hint = card.querySelector('.ep-vaccine__renew-hint');
        const metaItems = card.querySelectorAll('.ep-vaccine__meta-item');

        if (hint) {
            if (renewing) {
                hint.textContent = "We'll track the next due date";
            } else {
                hint.textContent = 'One-time vaccine';
            }
        }

        metaItems.forEach(function (item) {
            item.hidden = !renewing;
        });

        card.classList.toggle('is-renewing', renewing);
    }

    // Update the collapsed summary text + renew UI
    function syncVaccineSummary(card) {
        const summary = card.querySelector('.ep-vaccine__summary-text');

        if (summary) {
            const parts = getVaccineSummaryParts(card);

            // Two spans so name and meta can have different colors
            summary.innerHTML =
                '<span class="ep-vaccine__summary-name"></span>' +
                '<span class="ep-vaccine__summary-meta"></span>';

            const nameEl = summary.querySelector('.ep-vaccine__summary-name');
            const metaEl = summary.querySelector('.ep-vaccine__summary-meta');

            if (nameEl) nameEl.textContent = parts.name;
            if (metaEl) metaEl.textContent = parts.meta;
        }

        syncVaccineRenewUI(card);
    }

    // Give every id inside the cloned calendar a unique suffix
    function makeCalendarIdsUnique(wrap) {
        const oldId = wrap.id.replace('bc-wrap-', '');
        const newId = 'ep_vaccine_last_' + Date.now() + '_' + Math.floor(Math.random() * 100000);

        wrap.id = 'bc-wrap-' + newId;
        wrap.removeAttribute('data-bc-inited');

        wrap.querySelectorAll('[id]').forEach(function (el) {
            el.id = el.id.split(oldId).join(newId);
        });

        return newId;
    }

    // Reset a cloned calendar to the empty placeholder state
    function resetClonedCalendar(wrap) {
        const hidden = wrap.querySelector('input[type="hidden"]');
        const trigger = wrap.querySelector('.bc-trigger');
        const display = wrap.querySelector('.bc-display');
        const dropdown = wrap.querySelector('.bc-dropdown');

        if (hidden) {
            hidden.name = 'ep_vaccine_last[]';
            hidden.classList.add('ep-vaccine-last');
            hidden.value = '';
        }

        if (trigger) {
            trigger.classList.add('bc-empty');
            trigger.classList.remove('bc-open');
            trigger.setAttribute('aria-expanded', 'false');
        }

        if (display && trigger) {
            display.textContent = trigger.dataset.placeholder || 'dd/mm/yyyy';
        }

        if (dropdown) {
            dropdown.style.display = 'none';
        }
    }

    // Clone the calendar template into a vaccine card and turn it on
    function mountVaccineCalendar(container) {
        const tpl = document.getElementById('ep-vaccine-calendar-template');
        if (!tpl || !container) return;

        const source = tpl.content.querySelector('.bc-wrapper');
        if (!source) return;

        const wrap = source.cloneNode(true);
        makeCalendarIdsUnique(wrap);
        resetClonedCalendar(wrap);

        container.appendChild(wrap);

        // Card is already in the page, so init is safe
        if (typeof window.initBcWrapper === 'function') {
            window.initBcWrapper(wrap);
        }
    }

    // Clone the vaccine card template and set the name
    function createVaccineCard(name, open) {
        const tpl = document.getElementById('ep-vaccine-card-template');
        if (!tpl) return null;

        const card = tpl.content.querySelector('.ep-vaccine').cloneNode(true);

        if (open) {
            card.classList.add('is-open');
        }

        const nameField = card.querySelector('.ep-vaccine-name');
        if (nameField) {
            nameField.value = name || '';
        }

        syncVaccineSummary(card);
        return card;
    }

    // Add a vaccine card to the list
    function addVaccine(name, open) {
        if (!vaccineList) return;

        const value = (name || '').trim();
        if (!value) return;

        const shouldOpen = open !== false;
        const card = createVaccineCard(value, shouldOpen);
        if (!card) return;

        // 1) Put the card in the page
        vaccineList.appendChild(card);

        // 2) Then attach the date picker (needs to be in the DOM first)
        const calendarHost = card.querySelector('.ep-vaccine__calendar-host');
        mountVaccineCalendar(calendarHost);

        // 3) Refresh summary after calendar is ready
        syncVaccineSummary(card);

        if (vaccineInput) {
            vaccineInput.value = '';
            vaccineInput.focus();
        }
    }

    function clearVaccines() {
        if (vaccineList) {
            vaccineList.innerHTML = '';
        }
    }

    function resetForm() {
        form.reset();
        petIdInput.value = '';
        setAvatar('');
        setBirthdayField('');
        resetGallery();
        clearTagList(conditionList);
        clearTagList(allergyList);
        clearVaccines();
        setType('');
        setSize('');
        fillBreeds('dog', '');
        updateChecks();
        syncOtherTypeVisibility();
        editingCard = null;
    }

    function showForm() {
        if (listShell) listShell.hidden = true;
        editView.hidden = false;
        editView.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }

    function closeForm() {
        editView.hidden = true;
        if (listShell) listShell.hidden = false;
        resetForm();
        mode = 'edit';
        document.dispatchEvent(new CustomEvent('pets:form-closed'));
    }

    function readCard(card) {
        const avatar = card.querySelector('.pet-card__avatar');
        return {
            id: card.getAttribute('data-pet-id') || '',
            name: card.getAttribute('data-pet-name') || '',
            type: card.getAttribute('data-pet-type') || 'other',
            otherType: card.getAttribute('data-pet-other-type') || '',
            breed: card.getAttribute('data-pet-breed') || '',
            sex: card.getAttribute('data-pet-sex') || '',
            birthday: card.getAttribute('data-pet-birthday') || '',
            weight: card.getAttribute('data-pet-weight') || '',
            size: card.getAttribute('data-pet-size') || '',
            notes: card.getAttribute('data-pet-notes') || '',
            image: avatar ? avatar.getAttribute('src') : ''
        };
    }

    function readFormValues() {
        return {
            name: (nameInput.value || '').trim(),
            type: getType() || 'other',
            otherType: (otherTypeInput.value || '').trim(),
            breed: breedSelect.value || '',
            sex: (form.querySelector('input[name="ep_sex"]:checked') || {}).value || '',
            birthday: getBirthdayDisplay(),
            weight: (weightInput.value || '').trim(),
            size: getSize() || '',
            notes: (personalityInput.value || '').trim(),
            image: avatarImg && !avatarImg.hidden ? avatarImg.src : ''
        };
    }

    function populate(data) {
        petIdInput.value = data.id || '';
        nameInput.value = data.name || '';
        setBirthdayField(data.birthday || '');
        weightInput.value = data.weight || '';
        otherTypeInput.value = data.otherType || '';
        personalityInput.value = data.notes || '';
        if (medicalInput) medicalInput.value = '';
        if (groomingInput) groomingInput.value = '';
        if (groomingBehaviourInput) groomingBehaviourInput.value = '';
        if (productPrefsInput) productPrefsInput.value = '';
        if (medicationInput) medicationInput.value = '';
        if (emergencyNameInput) emergencyNameInput.value = '';
        if (emergencyPhoneInput) emergencyPhoneInput.value = '';
        if (notesInput) notesInput.value = '';

        setType(data.type || '');
        setSize(data.size || '');
        fillBreeds(data.type || 'dog', data.breed || '');
        syncOtherTypeVisibility();

        form.querySelectorAll('input[name="ep_sex"]').forEach(function (r) {
            r.checked = r.value === data.sex;
        });

        setAvatar(data.image || '');
        updateChecks();
    }

    function openEditForm(card) {
        if (!card) return;
        mode = 'edit';
        resetForm();
        editingCard = card;
        populate(readCard(card));

        if (titleEl) {
            const n = card.getAttribute('data-pet-name') || 'pet';
            titleEl.textContent = "Edit " + n + "'s details";
        }
        if (saveBtn) saveBtn.textContent = 'Save changes';
        showForm();
    }

    function openAddForm() {
        mode = 'add';
        resetForm();
        setType('other');
        setSize('medium');
        fillBreeds('other', '');
        syncOtherTypeVisibility();

        if (titleEl) titleEl.textContent = 'Add Pet';
        if (saveBtn) saveBtn.textContent = 'Add Pet';
        showForm();
    }

    function applyValuesToCard(card, v) {
        const id = card.getAttribute('data-pet-id') || 'pet-' + Date.now();
        card.setAttribute('data-pet-id', id);
        card.setAttribute('data-pet-name', v.name);
        card.setAttribute('data-pet-type', v.type);
        card.setAttribute('data-pet-other-type', v.otherType);
        card.setAttribute('data-pet-breed', v.breed);
        card.setAttribute('data-pet-sex', v.sex);
        card.setAttribute('data-pet-birthday', v.birthday);
        card.setAttribute('data-pet-weight', v.weight);
        card.setAttribute('data-pet-size', v.size);
        card.setAttribute('data-pet-notes', v.notes);
        card.setAttribute('data-pet-pronoun', v.sex === 'male' ? 'he' : 'she');
        card.dataset.mode = 'active';
        card.classList.remove('pet-card--archived', 'is-confirming');

        const nameEl = card.querySelector('.pet-card__name');
        if (nameEl) nameEl.textContent = v.name || 'Pet';

        const species =
            v.type === 'cat' ? 'Cat' : v.type === 'dog' ? 'Dog' : v.otherType || 'Other';
        const breedEl = card.querySelector('.pet-card__breed');
        if (breedEl) breedEl.textContent = species + (v.breed ? ' • ' + v.breed : '');

        const meta = card.querySelectorAll('.pet-card__meta li');
        if (meta[0]) {
            meta[0].lastChild.textContent =
                ' ' + (v.sex === 'male' ? 'Male' : v.sex === 'female' ? 'Female' : '—');
        }
        if (meta[1]) meta[1].lastChild.textContent = ' ' + (v.birthday || '—');
        if (meta[2]) meta[2].lastChild.textContent = ' ' + (v.weight ? v.weight + ' kg' : '—');
        if (meta[3]) meta[3].lastChild.textContent = ' ' + (v.notes || '—');

        const cardAvatar = card.querySelector('.pet-card__avatar');
        if (cardAvatar) {
            if (v.image) cardAvatar.src = v.image;
            cardAvatar.alt = v.name || 'Pet';
        }

        const activeMenu = card.querySelector('.pet-card__menu-active');
        const archivedMenu = card.querySelector('.pet-card__menu-archived');
        if (activeMenu) activeMenu.hidden = false;
        if (archivedMenu) archivedMenu.hidden = true;
        card.querySelectorAll('.pet-card__confirm').forEach(function (box) {
            box.hidden = true;
        });
        const dropdown = card.querySelector('.pet-card__dropdown');
        if (dropdown) dropdown.hidden = true;
    }

    function createPetCard(v) {
        const template =
            (activeGrid && activeGrid.querySelector(':scope > .pet-card')) ||
            document.querySelector('#archived-pets-grid > .pet-card') ||
            document.querySelector('.pet-card');
        if (!template) return null;

        const card = template.cloneNode(true);
        applyValuesToCard(card, v);
        card.setAttribute('data-pet-id', 'pet-' + Date.now());

        const archiveTitle = card.querySelector('.pet-card__confirm--archive h4');
        if (archiveTitle) archiveTitle.textContent = 'Archive ' + (v.name || 'pet') + '?';
        const deleteTitle = card.querySelector('.pet-card__confirm--delete h4');
        if (deleteTitle) {
            deleteTitle.textContent = "Delete " + (v.name || 'pet') + "'s profile?";
        }

        return card;
    }

    function saveForm() {
        const v = readFormValues();
        if (!v.name) {
            nameInput.focus();
            return;
        }

        if (mode === 'edit' && editingCard) {
            applyValuesToCard(editingCard, v);
        } else {
            const card = createPetCard(v);
            if (card && activeGrid) activeGrid.appendChild(card);
            const activeView = document.getElementById('pets-active-view');
            const archivedView = document.getElementById('pets-archived-view');
            if (activeView) activeView.hidden = false;
            if (archivedView) archivedView.hidden = true;
            document.dispatchEvent(new CustomEvent('pets:added'));
        }

        closeForm();
    }

    /* Toggles */
    document.getElementById('ep-type-group')?.addEventListener('click', function (e) {
        const btn = e.target.closest('.pet-option');
        if (!btn) return;
        setType(btn.getAttribute('data-pet'));
        fillBreeds(btn.getAttribute('data-pet'), '');
        syncOtherTypeVisibility();
    });

    document.getElementById('ep-size-group')?.addEventListener('click', function (e) {
        const btn = e.target.closest('.weight-option');
        if (!btn) return;
        setSize(btn.getAttribute('data-weight'));
    });

    nameInput?.addEventListener('input', updateChecks);
    otherTypeInput?.addEventListener('input', updateChecks);

    function stepWeight(delta) {
        if (!weightInput) return;
        const step = parseFloat(weightInput.step) || 1;
        const min = weightInput.min !== '' ? parseFloat(weightInput.min) : 0;
        const max = weightInput.max !== '' ? parseFloat(weightInput.max) : Infinity;
        const current = parseFloat(weightInput.value);
        const base = Number.isFinite(current) ? current : 0;
        let next = Math.round((base + delta * step) * 10) / 10;
        if (next < min) next = min;
        if (next > max) next = max;
        weightInput.value = String(next);
        weightInput.dispatchEvent(new Event('input', { bubbles: true }));
        weightInput.dispatchEvent(new Event('change', { bubbles: true }));
    }

    weightUpBtn?.addEventListener('click', function () {
        stepWeight(1);
    });
    weightDownBtn?.addEventListener('click', function () {
        stepWeight(-1);
    });

    avatarBtn?.addEventListener('click', function () {
        avatarInput?.click();
    });

    avatarInput?.addEventListener('change', function () {
        const file = avatarInput.files && avatarInput.files[0];
        if (!file) return;
        setAvatar(URL.createObjectURL(file));
    });

    /* Conditions / allergies */
    conditionAdd?.addEventListener('click', function () {
        addTag(conditionList, conditionInput);
    });
    conditionInput?.addEventListener('keydown', function (e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            addTag(conditionList, conditionInput);
        }
    });
    conditionList?.addEventListener('click', function (e) {
        const btn = e.target.closest('.ep-tag__remove');
        if (btn) btn.closest('.ep-tag')?.remove();
    });

    allergyAdd?.addEventListener('click', function () {
        addTag(allergyList, allergyInput);
    });
    allergyInput?.addEventListener('keydown', function (e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            addTag(allergyList, allergyInput);
        }
    });
    allergyList?.addEventListener('click', function (e) {
        const btn = e.target.closest('.ep-tag__remove');
        if (btn) btn.closest('.ep-tag')?.remove();
    });

    /* Vaccinations */
    vaccineAdd?.addEventListener('click', function () {
        addVaccine(vaccineInput && vaccineInput.value, true);
    });
    vaccineInput?.addEventListener('keydown', function (e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            addVaccine(vaccineInput.value, true);
        }
    });
    vaccineList?.addEventListener('click', function (e) {
        const card = e.target.closest('.ep-vaccine');
        if (!card) return;

        if (e.target.closest('.ep-vaccine-delete')) {
            card.remove();
            return;
        }
        if (e.target.closest('.ep-vaccine-collapse')) {
            syncVaccineSummary(card);
            card.classList.remove('is-open');
            return;
        }
        if (e.target.closest('.ep-vaccine__summary')) {
            card.classList.add('is-open');
        }
    });
    vaccineList?.addEventListener('input', function (e) {
        const card = e.target.closest('.ep-vaccine');
        if (card) syncVaccineSummary(card);
    });
    vaccineList?.addEventListener('change', function (e) {
        const card = e.target.closest('.ep-vaccine');
        if (!card) return;
        if (e.target.classList.contains('ep-vaccine-renew')) {
            syncVaccineRenewUI(card);
        }
        syncVaccineSummary(card);
    });

    /* Gallery */
    editView.addEventListener('click', function (e) {
        const del = e.target.closest('.ep-gallery-delete');
        if (del) {
            const slot = del.closest('.ep-gallery-slot');
            if (slot) clearSlot(slot);
            return;
        }
        const trigger = e.target.closest('.ep-gallery-trigger');
        if (trigger) {
            const slot = trigger.closest('.ep-gallery-slot');
            const input = slot && slot.querySelector('.ep-gallery-input');
            if (input) input.click();
        }
    });

    editView.querySelectorAll('.ep-gallery-input').forEach(function (input) {
        input.addEventListener('change', function () {
            const file = input.files && input.files[0];
            if (!file) return;
            const slot = input.closest('.ep-gallery-slot');
            if (!slot) return;
            setSlotPhoto(slot, URL.createObjectURL(file));
        });
    });

    editView.querySelectorAll('.ep-gallery-slot').forEach(function (slot) {
        slot.addEventListener('dragover', function (e) {
            e.preventDefault();
            slot.classList.add('is-dragover');
        });
        slot.addEventListener('dragleave', function () {
            slot.classList.remove('is-dragover');
        });
        slot.addEventListener('drop', function (e) {
            e.preventDefault();
            slot.classList.remove('is-dragover');
            if (slot.classList.contains('has-photo')) return;
            const file = e.dataTransfer && e.dataTransfer.files && e.dataTransfer.files[0];
            if (!file || !file.type.startsWith('image/')) return;
            const input = slot.querySelector('.ep-gallery-input');
            if (input) {
                try {
                    const dt = new DataTransfer();
                    dt.items.add(file);
                    input.files = dt.files;
                } catch (err) {
                    /* ignore DataTransfer failures */
                }
            }
            setSlotPhoto(slot, URL.createObjectURL(file));
        });
    });

    cancelBtn?.addEventListener('click', closeForm);

    form.addEventListener('submit', function (e) {
        e.preventDefault();
        saveForm();
    });

    addBtn?.addEventListener('click', openAddForm);

    document.addEventListener('pets:edit', function (e) {
        openEditForm(e.detail && e.detail.card);
    });

    document.addEventListener('pets:add', openAddForm);
})();
