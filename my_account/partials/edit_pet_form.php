<?php

/**
 * Edit pet details form (shown when user clicks Edit details on a pet card).
 * Prefill is done in my_pets_form.js from the card’s data-* attributes.
 */
?>
<div id="pets-edit-view" class="ep-view" hidden>
    <h2 class="ep-title" id="ep-title">Edit pet details</h2>

    <form id="ep-form" class="ep-form" novalidate>
        <input type="hidden" id="ep-pet-id" name="pet_id" value="">

        <!-- ========== General details ========== -->
        <section class="ep-section" aria-labelledby="ep-general-heading">
            <div class="ep-section__head">
                <h3 class="ep-section__title" id="ep-general-heading">General details</h3>
                <p class="ep-section__sub">Who your pet is.</p>
            </div>

            <div class="ep-top">
                <div class="ep-avatar-col">
                    <div class="ep-avatar" id="ep-avatar">
                        <img id="ep-avatar-img" src="" alt="" hidden>
                        <span class="ep-avatar-ph" id="ep-avatar-ph" aria-hidden="true">
                            <svg xmlns="http://www.w3.org/2000/svg" width="122" height="122" viewBox="0 0 122 122" fill="none">
                                <circle cx="61" cy="61" r="61" fill="#E5E5E5" />
                                <path d="M24.0703 103.944C30.4873 63.836 91.5334 63.8551 97.8986 104.002C98.3553 106.882 97.1596 109.741 94.7635 111.404C89.249 115.231 77.6016 121.594 61.1092 121.594C44.627 121.594 32.8575 115.239 27.2628 111.411C24.8286 109.745 23.6043 106.857 24.0703 103.944Z" fill="white" />
                                <path d="M79.4515 47.9769C79.4515 52.9355 77.4817 57.6911 73.9755 61.1974C70.4692 64.7037 65.7137 66.6735 60.7551 66.6735C55.7964 66.6735 51.0409 64.7037 47.5347 61.1974C44.0284 57.6911 42.0586 52.9355 42.0586 47.9769C42.0586 43.0182 44.0284 38.2627 47.5347 34.7564C51.0409 31.2501 55.7964 29.2803 60.7551 29.2803C65.7137 29.2803 70.4692 31.2501 73.9755 34.7564C77.4817 38.2627 79.4515 43.0182 79.4515 47.9769Z" fill="white" />
                            </svg>
                        </span>
                    </div>
                    <input type="file" id="ep-avatar-input" accept="image/*" hidden>
                    <button type="button" class="ep-upload-btn" id="ep-avatar-btn">
                        <svg width="18" height="14" viewBox="0 0 20 15" fill="none" aria-hidden="true">
                            <path d="M1.25 12.5c0 .69.56 1.25 1.25 1.25h15c.69 0 1.25-.56 1.25-1.25V5c0-.69-.56-1.25-1.25-1.25h-1.47a2.5 2.5 0 0 1-1.77-.73L12.35 1.6A1.25 1.25 0 0 0 11.47 1.25H8.54c-.33 0-.65.13-.88.36L6.62 3.02a2.5 2.5 0 0 1-1.77.73H2.5C1.81 3.75 1.25 4.31 1.25 5v7.5z" stroke="#3B3731" stroke-width="1.2" />
                            <circle cx="10" cy="8.1" r="2.6" stroke="#3B3731" stroke-width="1.2" />
                        </svg>
                        Upload photo
                    </button>
                    <p class="ep-avatar-hint">A clear photo helps your groomer recognise them.</p>
                </div>

                <div class="ep-toggles">
                    <div class="pet-type-wrapper">
                        <p class="label">Select Pet Type</p>
                        <div class="pet-toggle" id="ep-type-group" role="group" aria-label="Pet type">
                            <button type="button" class="pet-option" data-pet="cat">
                                <span>Cat</span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="23" viewBox="0 0 16 23" fill="none" aria-hidden="true">
                                    <path d="M7.06607 3.58301C7.8265 3.48922 8.87941 3.51287 9.88638 3.85352C10.9998 4.23021 12.076 5.00399 12.6022 6.43945L14.7711 7.47949L14.818 7.64941C15.1058 8.68692 15.2774 10.2987 14.8317 11.7656C14.6072 12.5047 14.2229 13.2153 13.611 13.791C12.9973 14.3682 12.1722 14.7931 11.0944 14.9854C7.21594 15.6769 5.01487 18.9931 4.40787 20.5596C4.16903 21.2436 3.62369 22.8966 3.62369 23C-3.55897 11.9396 1.57217 3.05801 5.0358 0L7.06607 3.58301ZM9.46841 7.20898C8.89932 7.20905 8.29568 7.49145 8.29556 8.62109C8.29556 9.40123 9.29039 8.62109 9.93814 8.62109C10.5855 8.6214 10.6413 9.40108 10.6413 8.62109C10.6411 7.84111 10.1161 7.20898 9.46841 7.20898Z" />
                                </svg>
                            </button>
                            <button type="button" class="pet-option" data-pet="dog">
                                <span>Dog</span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="21" viewBox="0 0 22 21" fill="none" aria-hidden="true">
                                    <path d="M11.4592 0C12.0763 -1.81872e-05 12.6594 0.284475 13.0383 0.771484L16.2531 4.90625C16.4122 5.1107 16.6451 5.24555 16.9016 5.28223L19.9856 5.72266C20.3435 5.77379 20.646 6.01307 20.759 6.35645C21.0768 7.32331 21.6368 9.33324 21.2541 10.5C20.7993 11.8862 20.0695 12.5798 18.7541 12.9189C16.5012 13.4996 14.6389 12.8358 12.4377 14.5137C11.758 15.0318 11.2942 15.7094 10.9895 16.4668C9.95231 19.0452 6.72483 21.7058 4.32932 20.2969L1.40646 18.5781L2.88596 12.9932C3.03734 12.9827 3.18545 12.9709 3.32639 12.9531C3.72903 12.9023 4.11589 12.815 4.36935 12.6543C4.5727 12.5253 4.78067 12.3019 4.97775 12.0498C5.17867 11.7928 5.3839 11.4855 5.57834 11.168C5.96741 10.5326 6.32411 9.84071 6.53439 9.39648C6.59333 9.27178 6.53985 9.1226 6.41525 9.06348C6.29076 9.00482 6.14244 9.05746 6.08322 9.18164C5.87884 9.61345 5.53038 10.2892 5.15256 10.9062C4.96359 11.2149 4.76927 11.5055 4.5842 11.7422C4.39523 11.9839 4.23009 12.1511 4.10178 12.2324C3.94892 12.3293 3.65905 12.4071 3.26389 12.457C2.87952 12.5055 2.43081 12.5234 1.98947 12.5225C1.58423 12.5216 1.18935 12.5013 0.862518 12.4795C0.852878 12.4768 0.842809 12.4744 0.833221 12.4717C0.259699 12.3089 -0.117574 11.6851 0.0334167 11.1084C1.50838 5.48346 2.34844 2.92212 3.76584 1.50488C5.26577 0.00544894 8.2594 1.93192e-05 8.28146 0H11.4592ZM11.8508 5.01758C11.2139 5.01758 10.5383 5.33425 10.5383 6.59863C10.5386 7.47085 11.6506 6.59869 12.3752 6.59863C13.0999 6.59863 13.1623 7.47088 13.1623 6.59863C13.1623 5.72593 12.5754 5.01786 11.8508 5.01758Z" />
                                </svg>
                            </button>
                            <button type="button" class="pet-option" data-pet="other">
                                <span>Other</span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="16" viewBox="0 0 20 16" fill="none" aria-hidden="true">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M6.42074 0C5.71446 0 5.16085 0.437285 4.81841 0.961736C4.47169 1.49055 4.28049 2.18061 4.28049 2.90555C4.28049 3.63048 4.47169 4.32055 4.81841 4.84936C5.16085 5.37236 5.71446 5.8111 6.42074 5.8111C7.12702 5.8111 7.68063 5.37381 8.02307 4.84936C8.36979 4.32055 8.56099 3.63048 8.56099 2.90555C8.56099 2.18061 8.36979 1.49055 8.02307 0.961736C7.68063 0.438738 7.12702 0 6.42074 0ZM13.5549 0C12.8486 0 12.295 0.437285 11.9526 0.961736C11.6058 1.49055 11.4147 2.18061 11.4147 2.90555C11.4147 3.63048 11.6058 4.32055 11.9526 4.84936C12.295 5.37236 12.8486 5.8111 13.5549 5.8111C14.2612 5.8111 14.8148 5.37381 15.1572 4.84936C15.504 4.32055 15.6951 3.63048 15.6951 2.90555C15.6951 2.18061 15.504 1.49055 15.1572 0.961736C14.8148 0.438738 14.2612 0 13.5549 0ZM2.14025 6.53748C1.43397 6.53748 0.880355 6.97477 0.537915 7.49922C0.191195 8.02803 0 8.7181 0 9.44303C0 10.168 0.191195 10.858 0.537915 11.3868C0.880355 11.9098 1.43397 12.3486 2.14025 12.3486C2.84653 12.3486 3.40014 11.9113 3.74258 11.3868C4.0893 10.858 4.28049 10.168 4.28049 9.44303C4.28049 8.7181 4.0893 8.02803 3.74258 7.49922C3.40014 6.97622 2.84653 6.53748 2.14025 6.53748ZM9.98782 6.53748C8.27562 6.53748 7.00717 7.47307 6.19673 8.63383C5.39628 9.77717 4.99391 11.1965 4.99391 12.3486C4.99391 13.6909 5.7858 14.6251 6.75747 15.1844C7.71345 15.7364 8.91199 15.9805 9.98782 15.9805C11.0637 15.9805 12.2622 15.7379 13.2182 15.1844C14.1884 14.6236 14.9817 13.6909 14.9817 12.3486C14.9817 11.1965 14.5794 9.77717 13.7789 8.63383C12.9699 7.47162 11.7014 6.53748 9.98782 6.53748ZM17.8354 6.53748C17.1291 6.53748 16.5755 6.97477 16.2331 7.49922C15.8863 8.02803 15.6951 8.7181 15.6951 9.44303C15.6951 10.168 15.8863 10.858 16.2331 11.3868C16.5755 11.9098 17.1291 12.3486 17.8354 12.3486C18.5417 12.3486 19.0953 11.9113 19.4377 11.3868C19.7844 10.858 19.9756 10.168 19.9756 9.44303C19.9756 8.7181 19.7844 8.02803 19.4377 7.49922C19.0953 6.97622 18.5417 6.53748 17.8354 6.53748Z" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div class="ep-field" id="ep-other-type-wrap" hidden>
                        <label class="ep-label" for="ep-other-type">Pet Type <span class="ep-label-hint">(for 'other' pets)</span></label>
                        <div class="ep-input-wrap">
                            <input type="text" id="ep-other-type" class="ep-input" placeholder="e.g. Rabbit, Guinea Pig ..." autocomplete="off">
                            <span class="ep-check" id="ep-other-check" hidden aria-hidden="true">
                                <svg width="18" height="18" viewBox="0 0 19 19" fill="none">
                                    <path d="M9.5 0a9.5 9.5 0 1 0 0 19 9.5 9.5 0 0 0 0-19zm-1.9 14.25L2.85 9.5l1.34-1.34L7.6 11.56l7.21-7.21L16.15 5.7 7.6 14.25z" fill="#C9DDA0" />
                                </svg>
                            </span>
                        </div>
                    </div>

                    <div class="pet-weight-wrapper">
                        <p class="label">Select Pet Size</p>
                        <div class="weight-toggle" id="ep-size-group" role="group" aria-label="Pet size">
                            <button type="button" class="weight-option" data-weight="small">
                                <span>Small 0–7 kg</span>
                            </button>
                            <button type="button" class="weight-option medium" data-weight="medium">
                                <span>Medium 8–18 kg</span>
                            </button>
                            <button type="button" class="weight-option large" data-weight="large">
                                <span>Large 19+ kg</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="ep-grid ep-grid--2">
                <div class="ep-field">
                    <label class="ep-label" for="ep-name">Name</label>
                    <div class="ep-input-wrap">
                        <input type="text" id="ep-name" name="pet_name" class="ep-input" autocomplete="off">
                        <span class="ep-check" id="ep-name-check" hidden aria-hidden="true">
                            <svg width="18" height="18" viewBox="0 0 19 19" fill="none">
                                <path d="M9.5 0a9.5 9.5 0 1 0 0 19 9.5 9.5 0 0 0 0-19zm-1.9 14.25L2.85 9.5l1.34-1.34L7.6 11.56l7.21-7.21L16.15 5.7 7.6 14.25z" fill="#C9DDA0" />
                            </svg>
                        </span>
                    </div>
                </div>

                <div class="ep-field">
                    <label class="ep-label" for="ep-breed">Breed(s)</label>
                    <select id="ep-breed" class="ep-input ep-select">
                        <option value="">Select breed</option>
                    </select>
                </div>
            </div>

            <div class="ep-grid ep-grid--2">
                <div class="ep-field ep-field--birthday">
                    <?php renderBirthdayCalendar('ep_birthday', '', 'Birthday', 'dd/mm/yyyy'); ?>
                </div>

                <div class="ep-inline-fields">
                    <div class="ep-field ep-field--weight">
                        <label class="ep-label" for="ep-weight">Weight <span class="ep-label-hint">(kg)</span></label>
                        <div class="ep-weight-wrap">
                            <input type="number" id="ep-weight" name="pet_weight" class="ep-input ep-input--no-spin" min="0" step="1" inputmode="decimal">
                            <div class="ep-weight-steppers" aria-hidden="true">
                                <button type="button" class="ep-weight-step" id="ep-weight-up" aria-label="Increase weight">
                                    <svg width="12" height="7" viewBox="0 0 12 7" fill="none">
                                        <path d="M1 6L6 1l5 5" stroke="#3B3731" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </button>
                                <button type="button" class="ep-weight-step" id="ep-weight-down" aria-label="Decrease weight">
                                    <svg width="12" height="7" viewBox="0 0 12 7" fill="none">
                                        <path d="M1 1l5 5 5-5" stroke="#3B3731" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="ep-field ep-field--sex">
                        <span class="ep-label">Sex</span>
                        <div class="ep-radios" role="radiogroup" aria-label="Sex">
                            <label class="ep-radio"><input type="radio" name="ep_sex" value="male"> Male</label>
                            <label class="ep-radio"><input type="radio" name="ep_sex" value="female"> Female</label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="ep-field">
                <label class="ep-label" for="ep-personality">Personality &amp; behaviour <span class="ep-label-hint">(optional)</span></label>
                <textarea id="ep-personality" class="ep-textarea" rows="3" placeholder="Any behaviour we should know about? (e.g. friendly with people, nervous around loud noises)."></textarea>
            </div>
        </section>

        <!-- ========== Grooming preferences ========== -->
        <section class="ep-section" aria-labelledby="ep-grooming-heading">
            <div class="ep-section__head">
                <h3 class="ep-section__title" id="ep-grooming-heading">Grooming preferences</h3>
                <p class="ep-section__sub">Help your groomer get the look and the experience right.</p>
            </div>

            <div class="ep-field">
                <label class="ep-label" for="ep-grooming">Preferred grooming style <span class="ep-label-hint">(optional)</span></label>
                <input type="text" id="ep-grooming" class="ep-input" placeholder="Any style preferences? (e.g clip length, shampoo type, sensitive areas)." autocomplete="off">
            </div>

            <div class="ep-field">
                <label class="ep-label" for="ep-grooming-behaviour">How does your pet behave during grooming? <span class="ep-label-hint">(optional)</span></label>
                <input type="text" id="ep-grooming-behaviour" class="ep-input" placeholder="e.g. Generally calm, slightly nervous with nail trimming." autocomplete="off">
            </div>

            <div class="ep-field">
                <label class="ep-label" for="ep-product-prefs">Product Preferences <span class="ep-label-hint">(optional)</span></label>
                <input type="text" id="ep-product-prefs" class="ep-input" placeholder="e.g. Hypoallergenic / sensitive skin shampoo" autocomplete="off">
            </div>
        </section>

        <!-- ========== Health & vaccinations ========== -->
        <section class="ep-section" aria-labelledby="ep-health-heading">
            <div class="ep-section__head">
                <h3 class="ep-section__title" id="ep-health-heading">Health &amp; vaccinations</h3>
                <p class="ep-section__sub">Keeps your pet safe during grooming.</p>
            </div>

            <div class="ep-field">
                <label class="ep-label" for="ep-medication">Current medication <span class="ep-label-hint">(optional)</span></label>
                <input type="text" id="ep-medication" class="ep-input" placeholder="List any medications your pet is currently taking." autocomplete="off">
            </div>

            <div class="ep-field">
                <label class="ep-label" for="ep-condition-input">Health conditions <span class="ep-label-hint">(optional)</span></label>
                <div class="ep-add-row">
                    <input type="text" id="ep-condition-input" class="ep-input" placeholder="Add a condition..." autocomplete="off">
                    <button type="button" class="ep-add-btn" id="ep-condition-add" aria-label="Add health condition">
                        <svg width="14" height="14" viewBox="0 0 14 14" fill="none" aria-hidden="true">
                            <path d="M7 1v12M1 7h12" stroke="#fff" stroke-width="2" stroke-linecap="round" />
                        </svg>
                    </button>
                </div>
                <ul class="ep-tag-list" id="ep-condition-list" aria-label="Health conditions"></ul>
            </div>

            <div class="ep-field">
                <label class="ep-label" for="ep-allergy-input">Allergies <span class="ep-label-hint">(optional)</span></label>
                <div class="ep-add-row">
                    <input type="text" id="ep-allergy-input" class="ep-input" placeholder="Add an allergy..." autocomplete="off">
                    <button type="button" class="ep-add-btn" id="ep-allergy-add" aria-label="Add allergy">
                        <svg width="14" height="14" viewBox="0 0 14 14" fill="none" aria-hidden="true">
                            <path d="M7 1v12M1 7h12" stroke="#fff" stroke-width="2" stroke-linecap="round" />
                        </svg>
                    </button>
                </div>
                <ul class="ep-tag-list" id="ep-allergy-list" aria-label="Allergies"></ul>
            </div>

            <div class="ep-field">
                <label class="ep-label" for="ep-vaccine-input">Vaccinations <span class="ep-label-hint">(optional)</span></label>
                <div class="ep-add-row">
                    <input type="text" id="ep-vaccine-input" class="ep-input" placeholder="Add a vaccine..." autocomplete="off">
                    <button type="button" class="ep-add-btn" id="ep-vaccine-add" aria-label="Add vaccine">
                        <svg width="14" height="14" viewBox="0 0 14 14" fill="none" aria-hidden="true">
                            <path d="M7 1v12M1 7h12" stroke="#fff" stroke-width="2" stroke-linecap="round" />
                        </svg>
                    </button>
                </div>
                <div class="ep-vaccine-list" id="ep-vaccine-list" aria-label="Vaccinations"></div>
            </div>

            <div class="ep-grid ep-grid--2">
                <div class="ep-field">
                    <label class="ep-label" for="ep-emergency-name">Emergency contact name <span class="ep-label-hint">(optional)</span></label>
                    <input type="text" id="ep-emergency-name" class="ep-input" placeholder="Contact name" autocomplete="off">
                </div>
                <div class="ep-field">
                    <label class="ep-label" for="ep-emergency-phone">Phone Number <span class="ep-label-hint">(optional)</span></label>
                    <input type="tel" id="ep-emergency-phone" class="ep-input" placeholder="Phone number" autocomplete="off">
                </div>
            </div>

            <div class="ep-field">
                <label class="ep-label" for="ep-medical">Any other medical notes <span class="ep-label-hint">(optional)</span></label>
                <textarea id="ep-medical" class="ep-textarea" rows="3" placeholder="Anything else related to your pet's health we should know?"></textarea>
            </div>
        </section>

        <!-- ========== Photos & notes ========== -->
        <section class="ep-section" aria-labelledby="ep-photos-heading">
            <div class="ep-section__head">
                <h3 class="ep-section__title" id="ep-photos-heading">Photos &amp; notes</h3>
                <p class="ep-section__sub">Optional extras that help your groomer.</p>
            </div>

            <div class="ep-gallery">
                <div class="ep-gallery-grid" id="ep-gallery-grid">
                    <?php for ($i = 0; $i < 5; $i++): ?>
                        <div class="ep-gallery-slot">
                            <input type="file" class="ep-gallery-input" accept="image/*" hidden>
                            <img class="ep-gallery-preview" alt="" hidden>
                            <button type="button" class="ep-gallery-delete" aria-label="Remove photo" hidden>
                                <svg xmlns="http://www.w3.org/2000/svg" width="34" height="34" viewBox="0 0 34 34" fill="none" aria-hidden="true">
                                    <circle cx="16.9201" cy="16.9201" r="16.4201" fill="white" stroke="#E2E2E2" />
                                    <path d="M21.306 14.9461V22.0337C21.306 22.4226 21.1476 22.7956 20.8655 23.0706C20.5835 23.3456 20.2009 23.5001 19.802 23.5001H14.0366C13.6378 23.5001 13.2552 23.3456 12.9732 23.0706C12.6911 22.7956 12.5326 22.4226 12.5326 22.0337V14.9461M19.426 13.113V12.0132C19.426 11.61 19.0876 11.28 18.674 11.28H15.1647C14.7511 11.28 14.4126 11.61 14.4126 12.0132V13.113M19.426 13.113H14.4126M19.426 13.113H22.5594M14.4126 13.113H11.2793M16.9193 16.7791V20.4451M18.7993 16.7791V20.4451M15.0393 16.7791V20.4451" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" stroke="#3B3731" />
                                </svg>
                            </button>
                            <button type="button" class="ep-gallery-trigger" aria-label="Add photo">
                                <span class="ep-gallery-empty">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="36" height="33" viewBox="0 0 36 33" fill="none">
                                        <path d="M8.68457 23.1656C-2.86015 24.4483 -1.5774 10.3381 8.68457 11.6209C4.83633 -2.48932 26.643 -2.48932 25.3603 7.77265C38.1877 3.92441 38.1877 24.4483 26.643 23.1656M24.0775 18.0346L17.6638 12.9036L11.2501 18.0346M17.6638 12.9036V32.1448" stroke-linecap="round" stroke-linejoin="round" stroke="black" />
                                    </svg>
                                    <span class="ep-gallery-drop-title">Drag &amp; Drop</span>
                                    <span class="ep-gallery-drop-link">or browse files</span>
                                </span>
                            </button>
                        </div>
                    <?php endfor; ?>
                </div>
            </div>

            <div class="ep-field">
                <label class="ep-label" for="ep-notes">Notes for your groomer <span class="ep-label-hint">(optional)</span></label>
                <textarea id="ep-notes" class="ep-textarea" rows="3" placeholder="Anything else your groomer should know?"></textarea>
            </div>
        </section>

        <div class="ep-footer">
            <button type="button" class="ep-btn ep-btn--ghost" id="ep-cancel">Cancel</button>
            <button type="submit" class="ep-btn ep-btn--primary" id="ep-save">Save changes</button>
        </div>
    </form>

    <!-- Cloned in JS when the user adds a vaccine -->
    <template id="ep-vaccine-card-template">
        <div class="ep-vaccine is-renewing">
            <button type="button" class="ep-vaccine__summary">
                <span class="ep-vaccine__summary-text"></span>
                <svg class="ep-vaccine__chevron" width="14" height="8" viewBox="0 0 14 8" fill="none" aria-hidden="true">
                    <path d="M1 1l6 6 6-6" stroke="#9D9B98" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </button>

            <div class="ep-vaccine__body">
                <button type="button" class="ep-vaccine__icon-btn ep-vaccine-collapse" aria-label="Collapse">
                    <svg width="14" height="8" viewBox="0 0 14 8" fill="none" aria-hidden="true">
                        <path d="M1 7l6-6 6 6" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </button>

                <div class="ep-vaccine__grid">
                    <div class="ep-field ep-vaccine__name-field">
                        <label class="ep-label">Vaccine</label>
                        <input type="text" class="ep-input ep-vaccine-name" autocomplete="off">
                    </div>

                    <div class="ep-vaccine__renew-row">
                        <div class="ep-vaccine__renew">
                            <label class="ep-switch">
                                <input type="checkbox" class="ep-vaccine-renew" checked>
                                <span class="ep-switch__track"></span>
                            </label>
                            <div class="ep-vaccine__renew-copy">
                                <span class="ep-vaccine__renew-label">Needs renewing</span>
                                <span class="ep-vaccine__renew-hint">We'll track the next due date</span>
                            </div>
                        </div>
                        <button type="button" class="ep-vaccine__icon-btn ep-vaccine-delete" aria-label="Delete vaccine">
                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="13" viewBox="0 0 12 13" fill="none" aria-hidden="true">
                                <path d="M2.24229 13C1.86115 13 1.53515 12.8695 1.26429 12.6084C0.993433 12.3474 0.857719 12.0344 0.857148 11.6695V1.4591H0.428577C0.306863 1.4591 0.205149 1.41953 0.123434 1.34039C0.0417202 1.26126 0.000577299 1.16316 5.87083e-06 1.0461C-0.000565557 0.929043 0.0405773 0.83122 0.123434 0.752632C0.206291 0.674044 0.308006 0.634749 0.428577 0.634749H3.42857C3.42857 0.464384 3.49429 0.316001 3.62572 0.189601C3.75714 0.0632002 3.91143 0 4.08857 0H7.91143C8.08857 0 8.24286 0.0632002 8.37428 0.189601C8.50571 0.316001 8.57143 0.464384 8.57143 0.634749H11.5714C11.6931 0.634749 11.7949 0.674318 11.8766 0.753456C11.9583 0.832594 11.9994 0.930691 12 1.04775C12.0006 1.16481 11.9594 1.26263 11.8766 1.34122C11.7937 1.41981 11.692 1.4591 11.5714 1.4591H11.1429V11.6687C11.1429 12.0347 11.0071 12.3479 10.7357 12.6084C10.4643 12.8689 10.1386 12.9995 9.75857 13H2.24229ZM10.2857 1.4591H1.71429V11.6687C1.71429 11.8165 1.76372 11.938 1.86258 12.033C1.96143 12.1281 2.088 12.1756 2.24229 12.1756H9.75857C9.91228 12.1756 10.0386 12.1281 10.1374 12.033C10.2363 11.938 10.2857 11.8165 10.2857 11.6687V1.4591ZM4.54972 10.5269C4.67143 10.5269 4.77343 10.4874 4.85572 10.4082C4.938 10.3291 4.97886 10.2313 4.97829 10.1148V3.51997C4.97829 3.40292 4.93714 3.30509 4.85486 3.22651C4.77257 3.14792 4.67057 3.10835 4.54886 3.1078C4.42714 3.10725 4.32543 3.14682 4.24372 3.22651C4.162 3.30619 4.12114 3.40402 4.12114 3.51997V10.1148C4.12114 10.2318 4.16229 10.3297 4.24457 10.4082C4.32686 10.4874 4.42857 10.5269 4.54972 10.5269ZM7.45114 10.5269C7.57286 10.5269 7.67457 10.4874 7.75628 10.4082C7.838 10.3291 7.87886 10.2313 7.87886 10.1148V3.51997C7.87886 3.40292 7.83771 3.30509 7.75543 3.22651C7.67314 3.14737 7.57143 3.1078 7.45028 3.1078C7.32857 3.1078 7.22657 3.14737 7.14428 3.22651C7.062 3.30564 7.02114 3.40347 7.02171 3.51997V10.1148C7.02171 10.2318 7.06286 10.3297 7.14514 10.4082C7.22743 10.4868 7.32943 10.5264 7.45114 10.5269Z" fill="#3B3731"/>
                            </svg>
                        </button>
                    </div>

                    <div class="ep-field ep-vaccine__meta-item ep-vaccine__last-field">
                        <label class="ep-label">Last given <span class="ep-label-hint">(optional)</span></label>
                        <div class="ep-vaccine__calendar-host"></div>
                    </div>

                    <div class="ep-field ep-vaccine__meta-item">
                        <label class="ep-label">Frequency</label>
                        <div class="ep-select-wrap">
                            <select class="ep-input ep-select ep-vaccine-freq">
                                <option value="">Select</option>
                                <option value="Yearly">Yearly</option>
                                <option value="Every 6 months">Every 6 months</option>
                                <option value="Every 3 years">Every 3 years</option>
                                <option value="One-time">One-time</option>
                            </select>
                            <svg class="ep-select-chevron" width="12" height="7" viewBox="0 0 12 7" fill="none" aria-hidden="true">
                                <path d="M1 1l5 5 5-5" stroke="#9D9B98" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </template>

    <!-- Cloned into each vaccine card for the "Last given" date picker -->
    <template id="ep-vaccine-calendar-template">
        <?php renderBirthdayCalendar('ep_vaccine_last_tpl', '', '', 'dd/mm/yyyy'); ?>
    </template>
</div>