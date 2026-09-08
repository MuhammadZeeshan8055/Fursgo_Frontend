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
    <script>window.BASE_URL = "<?= rtrim(BASE_URL, '/') ?>";</script>
    <script src="<?= BASE_URL ?>/assets/js/customer_journey.js"></script>
    <script>
        // Groomer Module and Space Module
        const groomModal = document.querySelector('#groomModal');
        const spaceModal = document.querySelector('#spaceModal');

        const groomApplyBtn = document.querySelector('#groomModal .modal-footer-btn.apply');
        const spaceApplyBtn = document.querySelector('#spaceModal .modal-footer-btn.apply');

        const groomSelectedSection = document.querySelector('#groomerSelectedSection');
        const spaceSelectedSection = document.querySelector('#spaceSelectedSection');

        // Remove modal filter pills only (venue pills handled in customer_journey.js)
        document.addEventListener('click', (e) => {
            const pill = e.target.closest('.selected-item');
            if (!pill) return;

            const group = pill.dataset.group;
            if (group === 'groomer-venue[]' || group === 'space-venue[]') return;
            if (group === 'groomer-sort' || group === 'space-sort') return;

            const value = pill.dataset.value;
            pill.remove();

            if (value) {
                document
                    .querySelectorAll(`input[type="checkbox"][value="${CSS.escape(value)}"]`)
                    .forEach(input => { input.checked = false; });
            }
        });

        groomApplyBtn.addEventListener('click', () => {
            syncModalToPills('#groomModal', groomSelectedSection);
            groomModal.style.display = 'none';
        });

        spaceApplyBtn.addEventListener('click', () => {
            syncModalToPills('#spaceModal', spaceSelectedSection);
            spaceModal.style.display = 'none';
        });

        function syncModalToPills(modalSelector, targetBox) {
            const checkboxes = [...document.querySelectorAll(
                `${modalSelector} .filter-options-section input[type="checkbox"]`
            )];

            const modalGroups = new Set(checkboxes.map(input => input.name));
            const modalValues = new Set(checkboxes.map(input => input.value));

            targetBox.querySelectorAll('.selected-item').forEach(el => {
                if (el.dataset.group === 'groomer-venue[]' || el.dataset.group === 'space-venue[]') return;
                if (el.dataset.group === 'groomer-sort' || el.dataset.group === 'space-sort') return;

                if (el.dataset.dynamic === 'true') {
                    el.remove();
                    return;
                }
                if (el.dataset.group && modalGroups.has(el.dataset.group)) {
                    el.remove();
                    return;
                }
                if (!el.dataset.group && el.dataset.value && modalValues.has(el.dataset.value)) {
                    el.remove();
                }
            });

            checkboxes.forEach(input => {
                if (input.checked) createModalPill(input, targetBox);
            });
        }

        function createModalPill(input, box) {
            const value = input.value;
            if ([...box.querySelectorAll('.selected-item')].some(el => el.dataset.value === value)) return;

            const div = document.createElement('div');
            div.className = 'selected-item cursor d-flex align-items-center gap-10';
            div.dataset.value = value;
            div.dataset.group = input.name;
            div.dataset.dynamic = 'true';
            div.innerHTML = `
                <p>${value}</p>
                <img src="<?= BASE_URL ?>/assets/icons/cross.svg" class="cross svg" alt="remove">
            `;
            box.appendChild(div);
        }
    </script>

</body>

</html>
