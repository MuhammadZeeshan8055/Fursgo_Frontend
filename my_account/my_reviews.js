(function () {
    const root = document.getElementById('reviews-root');
    if (!root || root.dataset.revReady === '1') return;
    root.dataset.revReady = '1';

    const titleEl = document.getElementById('rev-title');
    const searchInput = document.getElementById('rev-search');
    const tabs = root.querySelectorAll('.rev-tab');
    const panels = root.querySelectorAll('[data-rev-panel]');
    const filterTags = document.getElementById('rev-filter-tags');

    const titles = {
        written: 'Reviews Written',
        received: 'Reviews Received'
    };

    const filterLabels = {
        written: 'Garden / Shed',
        received: 'Salon'
    };

    function activePanel() {
        return root.querySelector('[data-rev-panel]:not([hidden])');
    }

    function updateFilterTag(id) {
        const tag = root.querySelector('[data-rev-tag-label]');
        if (!tag) return;
        const label = filterLabels[id] || filterLabels.written;
        tag.innerHTML = label + ' <span aria-hidden="true">&times;</span>';
        tag.hidden = false;
    }

    function closeMenus(except) {
        root.querySelectorAll('.rev-card__dropdown').forEach(function (menu) {
            if (menu !== except) menu.hidden = true;
        });
    }

    function resetCard(card) {
        if (!card) return;
        card.classList.remove('is-editing', 'is-removing');
        const view = card.querySelector('.rev-card__view');
        const edit = card.querySelector('.rev-card__edit');
        const remove = card.querySelector('.rev-card__remove');
        const menu = card.querySelector('.rev-card__menu');
        const editLink = card.querySelector('.rev-card__edit-link');
        if (view) view.hidden = false;
        if (edit) edit.hidden = true;
        if (remove) remove.hidden = true;
        if (menu) menu.hidden = false;
        if (editLink) editLink.hidden = true;
        closeMenus();
    }

    function applySearch() {
        const panel = activePanel();
        if (!panel) return;

        const q = (searchInput && searchInput.value || '').trim().toLowerCase();
        const cards = panel.querySelectorAll('.rev-card');
        let visible = 0;

        cards.forEach(function (card) {
            const name = (card.getAttribute('data-rev-name') || '').toLowerCase();
            const text = (card.querySelector('.rev-card__text')?.textContent || '').toLowerCase();
            const match = !q || name.indexOf(q) !== -1 || text.indexOf(q) !== -1;
            card.hidden = !match;
            if (match) visible += 1;
        });

        const empty = panel.querySelector('.rev-empty');
        if (empty) empty.hidden = visible > 0;
    }

    function switchTab(id) {
        tabs.forEach(function (tab) {
            const on = tab.getAttribute('data-rev-tab') === id;
            tab.classList.toggle('is-active', on);
            tab.setAttribute('aria-selected', on ? 'true' : 'false');
        });

        panels.forEach(function (panel) {
            panel.hidden = panel.getAttribute('data-rev-panel') !== id;
        });

        if (titleEl) titleEl.textContent = titles[id] || titles.written;
        if (searchInput) searchInput.value = '';
        updateFilterTag(id);

        root.querySelectorAll('.rev-card').forEach(resetCard);
        applySearch();
    }

    tabs.forEach(function (tab) {
        tab.addEventListener('click', function () {
            switchTab(tab.getAttribute('data-rev-tab'));
        });
    });

    if (searchInput) {
        searchInput.addEventListener('input', applySearch);
    }

    if (filterTags) {
        filterTags.addEventListener('click', function (e) {
            const btn = e.target.closest('[data-rev-clear-tag]');
            if (btn) btn.remove();
        });
    }

    root.addEventListener('click', function (e) {
        const menuBtn = e.target.closest('[data-rev-menu]');
        if (menuBtn) {
            e.preventDefault();
            const dropdown = menuBtn.parentElement.querySelector('.rev-card__dropdown');
            const open = dropdown && !dropdown.hidden;
            closeMenus();
            if (dropdown && !open) dropdown.hidden = false;
            return;
        }

        const editBtn = e.target.closest('[data-rev-edit]');
        if (editBtn) {
            e.preventDefault();
            const card = editBtn.closest('.rev-card');
            root.querySelectorAll('.rev-card').forEach(function (c) {
                if (c !== card) resetCard(c);
            });
            card.classList.add('is-editing');
            card.classList.remove('is-removing');
            card.querySelector('.rev-card__view').hidden = true;
            card.querySelector('.rev-card__edit').hidden = false;
            card.querySelector('.rev-card__remove').hidden = true;
            const menu = card.querySelector('.rev-card__menu');
            const editLink = card.querySelector('.rev-card__edit-link');
            if (menu) menu.hidden = true;
            if (editLink) editLink.hidden = false;
            closeMenus();
            return;
        }

        const deleteBtn = e.target.closest('[data-rev-delete]');
        if (deleteBtn) {
            e.preventDefault();
            const card = deleteBtn.closest('.rev-card');
            root.querySelectorAll('.rev-card').forEach(function (c) {
                if (c !== card) resetCard(c);
            });
            card.classList.add('is-removing');
            card.classList.remove('is-editing');
            card.querySelector('.rev-card__view').hidden = false;
            card.querySelector('.rev-card__edit').hidden = true;
            card.querySelector('.rev-card__remove').hidden = false;
            const editLink = card.querySelector('.rev-card__edit-link');
            if (editLink) editLink.hidden = true;
            closeMenus();
            return;
        }

        const cancelEdit = e.target.closest('[data-rev-cancel-edit]');
        if (cancelEdit) {
            e.preventDefault();
            resetCard(cancelEdit.closest('.rev-card'));
            return;
        }

        const saveBtn = e.target.closest('[data-rev-save]');
        if (saveBtn) {
            e.preventDefault();
            const card = saveBtn.closest('.rev-card');
            const textarea = card.querySelector('.rev-card__textarea');
            const textEl = card.querySelector('.rev-card__text');
            if (textarea && textEl) textEl.textContent = textarea.value.trim();
            resetCard(card);
            return;
        }

        const cancelDelete = e.target.closest('[data-rev-cancel-delete]');
        if (cancelDelete) {
            e.preventDefault();
            resetCard(cancelDelete.closest('.rev-card'));
            return;
        }

        const confirmDelete = e.target.closest('[data-rev-confirm-delete]');
        if (confirmDelete) {
            e.preventDefault();
            const card = confirmDelete.closest('.rev-card');
            if (card) card.remove();
            applySearch();
            return;
        }

        if (!e.target.closest('.rev-card__menu')) {
            closeMenus();
        }
    });

    root.querySelectorAll('[data-rev-load-more]').forEach(function (btn) {
        btn.addEventListener('click', function () {
            btn.textContent = 'No more reviews';
            btn.disabled = true;
        });
    });
})();
