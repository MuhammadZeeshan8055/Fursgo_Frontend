<div class="col-lg-12 section-gap">
    <div class="selection-box d-flex justify-content-between">
        <div class="selected-item-section d-flex align-items-center flex-wrap" id="spaceSelectedSection" style="width: 100%; max-width: 75%;">
            <div class="selected-item d-flex align-items-center">
                <img src="<?= BASE_URL ?>/assets/icons/fire.svg" class="svg" alt="">
                <p>Top Rated</p>
                <img src="<?= BASE_URL ?>/assets/icons/cross.svg" class="cross svg" alt="">
            </div>
            <div class="selected-item d-flex align-items-center">
                <p>Garden / Shed</p>
                <img src="<?= BASE_URL ?>/assets/icons/cross.svg" class="cross svg" alt="">
            </div>
        </div>
        <div class="venu-sorting-section d-flex">
            <div class="venue-selection">
                Space Venue
                &nbsp;
                <img src="<?= BASE_URL ?>/assets/icons/filter-arrow-down.svg" class="svg" alt="">
                <div class="venue-list">
                    <div class="venu dropdown">
                        <ul>
                            <li>
                                <label>
                                    <span class="option-text">Private rooms</span>
                                    <input type="checkbox" name="space-venue[]" value="Full Groom (bath, dry, haircut)" checked>
                                    <span class="check-circle"></span>

                                </label>
                            </li>
                            <li>
                                <label>
                                    <span class="option-text">Salon</span>
                                    <input type="checkbox" name="space-venue[]" value="Face Trim Only">
                                    <span class="check-circle"></span>
                                </label>
                            </li>
                            <li>
                                <label>
                                    <span class="option-text">Mobile station</span>
                                    <input type="checkbox" name="space-venue[]" value="Tail Trim Only">
                                    <span class="check-circle"></span>
                                </label>
                            </li>
                            <li>
                                <label>
                                    <span class="option-text">Garden / Shed </span>
                                    <input type="checkbox" name="space-venue[]" value="Bath & Brush">
                                    <span class="check-circle"></span>
                                </label>
                            </li>
                            <li>
                                <label>
                                    <span class="option-text">Others</span>
                                    <input type="checkbox" name="space-venue[]" value="Nail Trim">
                                    <span class="check-circle"></span>
                                </label>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="sort-by">
                Sort
                &nbsp;
                <img src="<?= BASE_URL ?>/assets/icons/filter-arrow-down.svg" class="svg" alt="">
                <div class="sort-by-filter">
                    <div class="sort dropdown">
                        <ul>
                            <li>
                                <label>
                                    <span class="option-text">Recommended (default)</span>
                                    <input type="checkbox" name="space-venue[]" value="default" checked> <span class="check-circle"></span>
                                </label>
                            </li>
                            <li>
                                <label>
                                    <span class="option-text">Distance</span>
                                    <input type="checkbox" name="space-venue[]" value="distance">
                                    <span class="check-circle"></span>
                                </label>
                            </li>
                            <li>
                                <label>
                                    <span class="option-text">Lowest price</span>
                                    <input type="checkbox" name="space-venue[]" value="lowest_price">
                                    <span class="check-circle"></span>
                                </label>
                            </li>
                            <li>
                                <label>
                                    <span class="option-text">Soonest available</span>
                                    <input type="checkbox" name="space-venue[]" value="soonest_available">
                                    <span class="check-circle"></span>
                                </label>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>