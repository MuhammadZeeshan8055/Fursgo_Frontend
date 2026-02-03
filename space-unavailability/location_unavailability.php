<?php include '../function_helper.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FursGo</title>
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

    <!-- filters section -->
    <?php include '../components/filters_section.php' ?>   
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


                    <?php include('../components/groomer_venue_sort_options.php'); ?>




                    <div data-tab-content="groomer-calendar-view" class="tabcontent">
                        <?php include('../components/calendar_view.php'); ?>
                        
                        <div class="container">
                            <hr style="border-top: 1px solid #DFDFDF;">
                        </div>

                        <?php include('../components/groomer_tab_card_view.php'); ?>
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
                        <?php include('../components/calendar_view.php'); ?>

                        <div class="container">
                            <hr style="border-top: 1px solid #DFDFDF;">
                        </div>

                        <?php include('../components/space_tab_card_view.php'); ?>
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