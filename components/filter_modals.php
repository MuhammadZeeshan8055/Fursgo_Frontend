<!-- filters modals  -->
<div class="container">
    <div class="row">
        <div class="col-lg-12 d-flex align-items-center justify-content-center">
            <div id="groomModal" class="modal">
                <div class="modal-dialog mb-5">
                    <button class="modal-close" aria-label="Close">&times;</button>

                    <h2 class="modal-filter-svg d-flex align-items-center modal-title">
                        Filter
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"
                            fill="none">
                            <path
                                d="M3 9.75C2.40326 9.75 1.83097 9.51295 1.40901 9.09099C0.987053 8.66903 0.75 8.09674 0.75 7.5C0.75 6.90326 0.987053 6.33097 1.40901 5.90901C1.83097 5.48705 2.40326 5.25 3 5.25M3 9.75C3.59674 9.75 4.16903 9.51295 4.59099 9.09099C5.01295 8.66903 5.25 8.09674 5.25 7.5C5.25 6.90326 5.01295 6.33097 4.59099 5.90901C4.16903 5.48705 3.59674 5.25 3 5.25M3 9.75V18.75M3 5.25V0.75M9.75 16.5C9.15326 16.5 8.58097 16.2629 8.15901 15.841C7.73705 15.419 7.5 14.8467 7.5 14.25C7.5 13.6533 7.73705 13.081 8.15901 12.659C8.58097 12.2371 9.15326 12 9.75 12M9.75 16.5C10.3467 16.5 10.919 16.2629 11.341 15.841C11.7629 15.419 12 14.8467 12 14.25C12 13.6533 11.7629 13.081 11.341 12.659C10.919 12.2371 10.3467 12 9.75 12M9.75 16.5V18.75M9.75 12V0.75M16.5 6.375C15.9033 6.375 15.331 6.13795 14.909 5.71599C14.4871 5.29403 14.25 4.72174 14.25 4.125C14.25 3.52826 14.4871 2.95597 14.909 2.53401C15.331 2.11205 15.9033 1.875 16.5 1.875M16.5 6.375C17.0967 6.375 17.669 6.13795 18.091 5.71599C18.5129 5.29403 18.75 4.72174 18.75 4.125C18.75 3.52826 18.5129 2.95597 18.091 2.53401C17.669 2.11205 17.0967 1.875 16.5 1.875M16.5 6.375V18.75M16.5 1.875V0.75"
                                stroke="#3B3731" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                    </h2>

                    <h2 class="modal-title mt-5">Price Range</h2>
                    <div class="range-slider">
                        <span class="output"></span>
                        <span class="full-range"></span>
                        <span class="incl-range"></span>
                        <input type="range" name="rangeOne" min="0" max="95" step="1" value="75">
                        <span class="max-price fs-14-600-f-color">£95</span>
                    </div>

                    <div class="filter-options-section dropdown mt-4">
                        <h2 class="modal-title mt-3 mb-2">Housing Conditions</h2>
                        <ul>
                            <li>
                                <label>
                                    <input type="checkbox" name="home_condition[]" value="Fenced yard">
                                    <span class="check-circle"></span>
                                    <span class="option-text">Fenced yard</span>
                                </label>
                            </li>
                            <li>
                                <label>
                                    <input type="checkbox" name="home_condition[]" value="No other pets">
                                    <span class="check-circle"></span>
                                    <span class="option-text">No other pets</span>
                                </label>
                            </li>
                            <li>
                                <label>
                                    <input type="checkbox" name="home_condition[]" value="No children">
                                    <span class="check-circle"></span>
                                    <span class="option-text">No children</span>
                                </label>
                            </li>
                        </ul>
                    </div>
                    <div class="filter-options-section dropdown mt-3">
                        <h2 class="modal-title mb-2">Other main service</h2>
                        <ul>
                            <li>
                                <label>
                                    <input type="checkbox" name="main-service[]" value="Full Groom (bath, dry, haircut)" checked>
                                    <span class="check-circle"></span>
                                    <span class="option-text">Full Groom (bath, dry, haircut)</span>
                                </label>
                            </li>
                            <li>
                                <label>
                                    <input type="checkbox" name="main-service[]" value="Face Trim Only">
                                    <span class="check-circle"></span>
                                    <span class="option-text">Face Trim Only</span>
                                </label>
                            </li>
                            <li>
                                <label>
                                    <input type="checkbox" name="main-service[]" value="Tail Trim Only">
                                    <span class="check-circle"></span>
                                    <span class="option-text">Tail Trim Only</span>
                                </label>
                            </li>
                            <li>
                                <label>
                                    <input type="checkbox" name="main-service[]" value="Bath & Brush">
                                    <span class="check-circle"></span>
                                    <span class="option-text">Bath & Brush</span>
                                </label>
                            </li>
                            <li>
                                <label>
                                    <input type="checkbox" name="main-service[]" value="Nail Trim">
                                    <span class="check-circle"></span>
                                    <span class="option-text">Nail Trim</span>
                                </label>
                            </li>
                            <li>
                                <label>
                                    <input type="checkbox" name="main-service[]" value="Ear Cleaning">
                                    <span class="check-circle"></span>
                                    <span class="option-text">Ear Cleaning</span>
                                </label>
                            </li>
                            <li>
                                <label>
                                    <input type="checkbox" name="main-service[]" value="Luxury Spa">
                                    <span class="check-circle"></span>
                                    <span class="option-text">Luxury Spa</span>
                                </label>
                            </li>
                        </ul>
                    </div>

                    <div class="filter-options-section dropdown mt-3">
                        <h2 class="modal-title mb-2">Add-on</h2>
                        <ul>
                            <li>
                                <label>
                                    <input type="checkbox" name="addon[]" value="Flea & Tick Treatment" checked>
                                    <span class="check-circle"></span>
                                    <span class="option-text">Flea & Tick Treatment</span>
                                </label>
                            </li>
                            <li>
                                <label>
                                    <input type="checkbox" name="addon[]" value="Deep Conditioning Masky">
                                    <span class="check-circle"></span>
                                    <span class="option-text">Deep Conditioning Masky</span>
                                </label>
                            </li>
                            <li>
                                <label>
                                    <input type="checkbox" name="addon[]" value="Hypoallergenic Shampoo Upgrade">
                                    <span class="check-circle"></span>
                                    <span class="option-text">Hypoallergenic Shampoo Upgrade</span>
                                </label>
                            </li>
                            <li>
                                <label>
                                    <input type="checkbox" name="addon[]" value="Shed-Control Shampoo">
                                    <span class="check-circle"></span>
                                    <span class="option-text">Shed-Control Shampoo</span>
                                </label>
                            </li>
                            <li>
                                <label>
                                    <input type="checkbox" name="addon[]" value="Tear-Stain Treatment">
                                    <span class="check-circle"></span>
                                    <span class="option-text">Tear-Stain Treatment</span>
                                </label>
                            </li>
                            <li>
                                <label>
                                    <input type="checkbox" name="addon[]" value="Deodorising Treatment">
                                    <span class="check-circle"></span>
                                    <span class="option-text">Deodorising Treatment</span>
                                </label>
                            </li>
                            <li>
                                <label>
                                    <input type="checkbox" name="addon[]" value="Coat Shine Spray">
                                    <span class="check-circle"></span>
                                    <span class="option-text">Coat Shine Spray</span>
                                </label>
                            </li>
                            <li>
                                <label>
                                    <input type="checkbox" name="addon[]" value="Anti-Itch Treatment">
                                    <span class="check-circle"></span>
                                    <span class="option-text">Anti-Itch Treatment</span>
                                </label>
                            </li>
                            <li>
                                <label>
                                    <input type="checkbox" name="addon[]" value="Breath Freshner Gel">
                                    <span class="check-circle"></span>
                                    <span class="option-text">Breath Freshner Gel</span>
                                </label>
                            </li>
                            <li>
                                <label>
                                    <input type="checkbox" name="addon[]" value="Nail Grinding">
                                    <span class="check-circle"></span>
                                    <span class="option-text">Nail Grinding</span>
                                </label>
                            </li>
                            <li>
                                <label>
                                    <input type="checkbox" name="addon[]" value="Soft-Claws / Nail Caps Application">
                                    <span class="check-circle"></span>
                                    <span class="option-text">Soft-Claws / Nail Caps Application</span>
                                </label>
                            </li>
                            <li>
                                <label>
                                    <input type="checkbox" name="addon[]" value="Coat Colour Enhancing Shampoo">
                                    <span class="check-circle"></span>
                                    <span class="option-text">Coat Colour Enhancing Shampoo</span>
                                </label>
                            </li>
                            <li>
                                <label>
                                    <input type="checkbox" name="addon[]" value="Premium Fragrance Upgrade">
                                    <span class="check-circle"></span>
                                    <span class="option-text">Premium Fragrance Upgrade</span>
                                </label>
                            </li>
                            <li>
                                <label>
                                    <input type="checkbox" name="addon[]" value="Fast-Dry Service (express grooming)">
                                    <span class="check-circle"></span>
                                    <span class="option-text">Fast-Dry Service (express grooming)</span>
                                </label>
                            </li>
                            <li>
                                <label>
                                    <input type="checkbox" name="addon[]" value="Paw Fur Shaping">
                                    <span class="check-circle"></span>
                                    <span class="option-text">Paw Fur Shaping</span>
                                </label>
                            </li>
                        </ul>
                    </div>
                    <div class="filter-options-section dropdown mt-3">
                        <h2 class="modal-title mb-2">Accepts non-neutered pets</h2>
                        <ul>
                            <li>
                                <label>
                                    <input type="checkbox" name="non-neutered[]" value="Accepts non-neutered pets" checked>
                                    <span class="check-circle"></span>
                                    <span class="option-text">Accepts non-neutered pets</span>
                                </label>
                            </li>
                        </ul>
                    </div>

                    <div class="filter-options-section dropdown mt-3">
                        <h2 class="modal-title mb-2">Extras</h2>
                        <ul>
                            <li>
                                <label>
                                    <input type="checkbox" name="extras[]" value="Bathing" checked>
                                    <span class="check-circle"></span>
                                    <span class="option-text">Bathing</span>
                                </label>
                            </li>
                            <li>
                                <label>
                                    <input type="checkbox" name="extras[]" value="First-aid certified">
                                    <span class="check-circle"></span>
                                    <span class="option-text">First-aid certified</span>
                                </label>
                            </li>
                        </ul>
                    </div>

                    <div class="filter-options-section dropdown mt-3">
                        <h2 class="modal-title mb-2">Space Type</h2>
                        <ul>
                            <li>
                                <label>
                                    <input type="checkbox" name="space-type[]" value="Shared space" checked>
                                    <span class="check-circle"></span>
                                    <span class="option-text">Shared space</span>
                                </label>
                            </li>
                            <li>
                                <label>
                                    <input type="checkbox" name="space-type[]" value="Entire Space just for you">
                                    <span class="check-circle"></span>
                                    <span class="option-text">Entire Space just for you</span>
                                </label>
                            </li>
                        </ul>
                    </div>


                    <div class="modal-footer mt-3">
                        <button class="modal-footer-btn">Clear All</button>
                        <button class="modal-footer-btn apply">Apply</button>
                    </div>

                </div>
            </div>
            <div id="spaceModal" class="modal">
                <div class="modal-dialog mb-5">
                    <button class="modal-close" aria-label="Close">&times;</button>

                    <h2 class="modal-filter-svg d-flex align-items-center modal-title">
                        Filter
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"
                            fill="none">
                            <path
                                d="M3 9.75C2.40326 9.75 1.83097 9.51295 1.40901 9.09099C0.987053 8.66903 0.75 8.09674 0.75 7.5C0.75 6.90326 0.987053 6.33097 1.40901 5.90901C1.83097 5.48705 2.40326 5.25 3 5.25M3 9.75C3.59674 9.75 4.16903 9.51295 4.59099 9.09099C5.01295 8.66903 5.25 8.09674 5.25 7.5C5.25 6.90326 5.01295 6.33097 4.59099 5.90901C4.16903 5.48705 3.59674 5.25 3 5.25M3 9.75V18.75M3 5.25V0.75M9.75 16.5C9.15326 16.5 8.58097 16.2629 8.15901 15.841C7.73705 15.419 7.5 14.8467 7.5 14.25C7.5 13.6533 7.73705 13.081 8.15901 12.659C8.58097 12.2371 9.15326 12 9.75 12M9.75 16.5C10.3467 16.5 10.919 16.2629 11.341 15.841C11.7629 15.419 12 14.8467 12 14.25C12 13.6533 11.7629 13.081 11.341 12.659C10.919 12.2371 10.3467 12 9.75 12M9.75 16.5V18.75M9.75 12V0.75M16.5 6.375C15.9033 6.375 15.331 6.13795 14.909 5.71599C14.4871 5.29403 14.25 4.72174 14.25 4.125C14.25 3.52826 14.4871 2.95597 14.909 2.53401C15.331 2.11205 15.9033 1.875 16.5 1.875M16.5 6.375C17.0967 6.375 17.669 6.13795 18.091 5.71599C18.5129 5.29403 18.75 4.72174 18.75 4.125C18.75 3.52826 18.5129 2.95597 18.091 2.53401C17.669 2.11205 17.0967 1.875 16.5 1.875M16.5 6.375V18.75M16.5 1.875V0.75"
                                stroke="#3B3731" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                    </h2>

                    <h2 class="modal-title mt-5">Price Range</h2>
                    <div class="range-slider">
                        <span class="output"></span>
                        <span class="full-range"></span>
                        <span class="incl-range"></span>
                        <input type="range" name="rangeOne" min="0" max="95" step="1" value="75">
                        <span class="max-price fs-14-600-f-color">£95</span>
                    </div>

                    <div class="filter-options-section dropdown mt-4">
                        <h2 class="modal-title mb-2">Amenities</h2>
                        <ul>
                            <li>
                                <label>
                                    <input type="checkbox" name="amenities" value="Bath" checked>
                                    <span class="check-circle"></span>
                                    <span class="option-text">Bath</span>
                                </label>
                            </li>
                            <li>
                                <label>
                                    <input type="checkbox" name="amenities" value="Table">
                                    <span class="check-circle"></span>
                                    <span class="option-text">Table</span>
                                </label>
                            </li>
                            <li>
                                <label>
                                    <input type="checkbox" name="amenities" value="Dryer">
                                    <span class="check-circle"></span>
                                    <span class="option-text">Dryer</span>
                                </label>
                            </li>
                            <li>
                                <label>
                                    <input type="checkbox" name="amenities" value="Towels">
                                    <span class="check-circle"></span>
                                    <span class="option-text">Towels</span>
                                </label>
                            </li>
                            <li>
                                <label>
                                    <input type="checkbox" name="amenities" value="Parking">
                                    <span class="check-circle"></span>
                                    <span class="option-text">Parking</span>
                                </label>
                            </li>
                            <li>
                                <label>
                                    <input type="checkbox" name="amenities" value="Wi-Fi">
                                    <span class="check-circle"></span>
                                    <span class="option-text">Wi-Fi</span>
                                </label>
                            </li>
                        </ul>
                    </div>

                    <div class="filter-options-section dropdown mt-3">
                        <h2 class="modal-title mb-2">Housing Conditions</h2>
                        <ul>
                            <li>
                                <label>
                                    <input type="checkbox" name="housing-conditions" value="Fenced yard" checked>
                                    <span class="check-circle"></span>
                                    <span class="option-text">Fenced yard</span>
                                </label>
                            </li>
                            <li>
                                <label>
                                    <input type="checkbox" name="housing-conditions" value="No other pets">
                                    <span class="check-circle"></span>
                                    <span class="option-text">No other pets</span>
                                </label>
                            </li>
                            <li>
                                <label>
                                    <input type="checkbox" name="housing-conditions" value="No children">
                                    <span class="check-circle"></span>
                                    <span class="option-text">No children</span>
                                </label>
                            </li>
                        </ul>
                    </div>
                    <div class="filter-options-section dropdown mt-3">
                        <h2 class="modal-title mb-2">Space Type</h2>
                        <ul>
                            <li>
                                <label>
                                    <input type="checkbox" name="space-type[]" value="Shared space" checked>
                                    <span class="check-circle"></span>
                                    <span class="option-text">Shared space</span>
                                </label>
                            </li>
                            <li>
                                <label>
                                    <input type="checkbox" name="space-type[]" value="Entire space just for you">
                                    <span class="check-circle"></span>
                                    <span class="option-text">Entire space just for you</span>
                                </label>
                            </li>
                        </ul>
                    </div>

                    <div class="filter-options-section dropdown mt-3">
                        <h2 class="modal-title mb-2">Accepts non-neutered pets</h2>
                        <ul>
                            <li>
                                <label>
                                    <input type="checkbox" name="non-neutered[]" value="Accepts non-neutered pets" checked>
                                    <span class="check-circle"></span>
                                    <span class="option-text">Accepts non-neutered pets</span>
                                </label>
                            </li>
                        </ul>
                    </div>

                    <div class="filter-options-section dropdown mt-3">
                        <h2 class="modal-title mb-2">Suitable service</h2>
                        <ul>
                            <li>
                                <label>
                                    <input type="checkbox" name="suitable-service" value="Full Groom (bath, dry, haircut)" checked>
                                    <span class="check-circle"></span>
                                    <span class="option-text">Full Groom (bath, dry, haircut)</span>
                                </label>
                            </li>
                            <li>
                                <label>
                                    <input type="checkbox" name="suitable-service" value="Face Trim Only">
                                    <span class="check-circle"></span>
                                    <span class="option-text">Face Trim Only</span>
                                </label>
                            </li>
                            <li>
                                <label>
                                    <input type="checkbox" name="suitable-service" value="Tail Trim Only">
                                    <span class="check-circle"></span>
                                    <span class="option-text">Tail Trim Only</span>
                                </label>
                            </li>
                            <li>
                                <label>
                                    <input type="checkbox" name="suitable-service" value="Bath & Brush">
                                    <span class="check-circle"></span>
                                    <span class="option-text">Bath & Brush</span>
                                </label>
                            </li>
                            <li>
                                <label>
                                    <input type="checkbox" name="suitable-service" value="Nail Trim">
                                    <span class="check-circle"></span>
                                    <span class="option-text">Nail Trim</span>
                                </label>
                            </li>
                            <li>
                                <label>
                                    <input type="checkbox" name="suitable-service" value="Ear Cleaning">
                                    <span class="check-circle"></span>
                                    <span class="option-text">Ear Cleaning</span>
                                </label>
                            </li>
                            <li>
                                <label>
                                    <input type="checkbox" name="suitable-service" value="Luxury Spa">
                                    <span class="check-circle"></span>
                                    <span class="option-text">Luxury Spa</span>
                                </label>
                            </li>
                        </ul>
                    </div>

                    <div class="filter-options-section dropdown mt-3">
                        <h2 class="modal-title mb-2">Extras</h2>
                        <ul>
                            <li>
                                <label>
                                    <input type="checkbox" name="extras[]" value="Bathing" checked>
                                    <span class="check-circle"></span>
                                    <span class="option-text">Bathing</span>
                                </label>
                            </li>
                            <li>
                                <label>
                                    <input type="checkbox" name="extras[]" value="First-aid certified">
                                    <span class="check-circle"></span>
                                    <span class="option-text">First-aid certified</span>
                                </label>
                            </li>
                        </ul>
                    </div>

                    <div class="modal-footer mt-3">
                        <button class="modal-footer-btn">Clear All</button>
                        <button class="modal-footer-btn apply">Apply</button>
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>
<!-- filters modals  -->