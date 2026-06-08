<?php include 'function_helper.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="icon" href="<?= BASE_URL ?>assets/images/favicon.ico" type="image/x-icon">
    <title>FursGo</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/responsive.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/bootstrap.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/media_query.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/common.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/customer_journey.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

</head>

<body>

    <!-- header -->
    <?php include 'components/header.php' ?>
    <!-- header -->

    <!-- filter modal  -->
    <?php include 'components/filter_modals.php' ?>
    <!-- filter modal  -->

    <!-- filters section -->
    <?php include 'components/filters_section.php' ?>
    <!-- filters section -->

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


                    <?php include('components/groomer_venue_sort_options.php'); ?>

                    <div data-tab-content="groomer-calendar-view" class="tabcontent">
                        <?php include('components/calendar_view.php'); ?>

                        <div class="section-divider" style="background-color: #DFDFDF"></div>

                        <?php include('components/groomer_tab_card_view.php'); ?>
                    </div>

                    <div data-tab-content="groomer-map-view" class="tabcontent" style="display: none;">
                        <?php include('components/groomer_tab_map_view.php'); ?>
                    </div>

                    <div data-tab-content="groomer-list-view" class="tabcontent" style="display: none;">
                        <?php include('components/groomer_tab_list_view.php'); ?>
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

                    <?php include('components/space_venue_sort_options.php'); ?>

                    <div data-tab-content="space-calendar-view" class="tabcontent">
                        <?php include('components/calendar_view.php'); ?>

                        <div class="section-divider" style="background-color: #DFDFDF"></div>

                        <?php include('components/space_tab_card_view.php'); ?>
                    </div>

                    <div data-tab-content="space-map-view" class="tabcontent" style="display: none;">
                        <?php include('components/space_tab_map_view.php'); ?>
                    </div>

                    <div data-tab-content="space-list-view" class="tabcontent" style="display: none;">
                        <?php include('components/space_tab_list_view.php'); ?>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- footer -->
    <?php include 'components/footer.php' ?>
    <!-- footer -->

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="<?= BASE_URL ?>/assets/js/customer_journey.js"></script>
    <script>
        // Groomer Module and Space Module
        const groomModal = document.querySelector('#groomModal');
        const spaceModal = document.querySelector('#spaceModal');

        const groomApplyBtn = document.querySelector('#groomModal .modal-footer-btn.apply');
        const spaceApplyBtn = document.querySelector('#spaceModal .modal-footer-btn.apply');

        const groomSelectedSection = document.querySelector('#groomerSelectedSection');
        const spaceSelectedSection = document.querySelector('#spaceSelectedSection');


        // ================================
        // GLOBAL CLICK: REMOVE ANY PILL
        // ================================
        document.addEventListener('click', (e) => {

            const pill = e.target.closest('.selected-item');
            if (!pill) return;

            const value = pill.dataset.value;

            pill.remove();

            document
                .querySelectorAll(`input[type="checkbox"][value="${value}"]`)
                .forEach(input => input.checked = false);
        });


        // ================================
        // APPLY GROOM FILTERS
        // ================================
        groomApplyBtn.addEventListener('click', () => {

            syncModalToPills('#groomModal', groomSelectedSection);

            groomModal.style.display = 'none';
        });


        // ================================
        // APPLY SPACE FILTERS (NOW ADDED)
        // ================================
        spaceApplyBtn.addEventListener('click', () => {

            syncModalToPills('#spaceModal', spaceSelectedSection);

            spaceModal.style.display = 'none';
        });


        // ================================
        // CORE SYNC FUNCTION (SINGLE VERSION)
        // ================================
        function syncModalToPills(modalSelector, targetBox) {

            const checkedItems = document.querySelectorAll(
                `${modalSelector} .filter-options-section input[type="checkbox"]:checked`
            );

            // remove ONLY dynamic pills
            targetBox.querySelectorAll('.selected-item[data-dynamic="true"]').forEach(el => el.remove());

            checkedItems.forEach(input => {
                createPill(input, targetBox);
            });
        }


        // ================================
        // CREATE PILL
        // ================================
        function createPill(input, box) {

            const value = input.value;

            if (box.querySelector(`[data-value="${value}"]`)) return;

            const div = document.createElement('div');

            div.className = 'selected-item cursor d-flex align-items-center gap-10';

            div.dataset.value = value;
            div.dataset.dynamic = "true";

            div.innerHTML = `
        <p>${value}</p>
        <img src="<?= BASE_URL ?>/assets/icons/cross.svg" class="cross svg" alt="remove">
    `;

            box.appendChild(div);
        }
    </script>


    <!-- adding pills for groomer and space filters (checkboxes + radios) -->

    <script>
        const groomBox = document.querySelector('#groomerSelectedSection');
        const spaceBox = document.querySelector('#spaceSelectedSection');

        // ================================
        // INIT INPUTS → CREATE PILLS
        // ================================
        document.querySelectorAll(
            'input[name="groomer-venue[]"], input[name="space-venue[]"], input[name="groomer-sort"], input[name="space-sort"]'
        ).forEach(input => {

            const box = getBox(input);

            // initial state
            if (input.checked) {
                createPill(input, box);
            }

            input.addEventListener('change', () => {

                const box = getBox(input);

                // RADIO: clear same group pills
                if (input.type === 'radio') {
                    box.querySelectorAll(`[data-group="${input.name}"]`)
                        .forEach(el => el.remove());
                }

                if (input.checked) {
                    createPill(input, box);
                } else {
                    removePill(input, box);
                }
            });
        });


        // ================================
        // GLOBAL CLICK (STATIC + DYNAMIC)
        // ================================
        document.addEventListener('click', (e) => {

            const pill = e.target.closest('.selected-item');
            if (!pill) return;

            const value = pill.dataset.value;
            const group = pill.dataset.group;

            // remove UI
            pill.remove();

            // sync input if exists
            if (value && group) {
                const input = document.querySelector(
                    `[name="${group}"][value="${value}"]`
                );

                if (input) input.checked = false;
            }
        });


        // ================================
        // GET CONTAINER
        // ================================
        function getBox(input) {
            if (input.name === 'groomer-venue[]' || input.name === 'groomer-sort') {
                return groomBox;
            }
            return spaceBox;
        }


        // ================================
        // CREATE PILL
        // ================================
        function createPill(input, box) {

            const value = input.value;

            if (box.querySelector(`[data-value="${value}"]`)) return;

            const text = input.closest('label')
                .querySelector('.option-text')
                .innerText.trim();

            const div = document.createElement('div');
            div.className = 'selected-item cursor d-flex align-items-center gap-10';

            div.dataset.value = value;
            div.dataset.group = input.name;

            div.innerHTML = `
        <p>${text}</p>
        <img src="/assets/icons/cross.svg" class="cross svg" alt="">
    `;

            box.appendChild(div);
        }


        // ================================
        // REMOVE PILL (when input unchecked)
        // ================================
        function removePill(input, box) {

            const el = box.querySelector(
                `.selected-item[data-value="${input.value}"][data-group="${input.name}"]`
            );

            if (el) el.remove();
        }
    </script>

    <!-- adding pills for groomer and space filters (checkboxes + radios) ends -->


</body>

</html>

</body>

</html>