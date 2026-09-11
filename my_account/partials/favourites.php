<?php
/**
 * Favourites tab — Groomers + Space Hosts
 * Card patterns adapted from my_profile_old.php, styled for the new account page.
 */
$favTrash = '<svg width="13" height="15" viewBox="0 0 13 15" fill="none" aria-hidden="true"><path d="M2.43 15c-.41 0-.77-.15-1.06-.45A1.55 1.55 0 0 1 .93 13.46V1.68H.46a.48.48 0 0 1-.33-.14A.45.45 0 0 1 0 1.21c0-.14.04-.25.13-.34.09-.09.2-.14.33-.14h3.25V.73A1 1 0 0 1 4.43 0h4.14a1 1 0 0 1 1 1v.73h3.25c.13 0 .24.05.33.14.09.09.13.2.13.34 0 .13-.04.25-.13.34a.48.48 0 0 1-.33.14h-.46v11.78c0 .42-.15.78-.44 1.08-.29.3-.64.45-1.05.45H2.43zm8.71-13.32H1.86v11.78c0 .17.05.31.16.42.11.11.25.16.41.16h8.14c.17 0 .3-.05.41-.16.11-.11.16-.25.16-.42V1.68zM4.93 12.15c.13 0 .24-.05.33-.14.09-.09.13-.2.13-.34V4.06c0-.13-.04-.25-.13-.34a.45.45 0 0 0-.33-.14c-.13 0-.24.05-.33.14-.09.09-.13.2-.13.34v7.61c0 .14.04.25.13.34.09.09.2.14.33.14zm3.14 0c.13 0 .24-.05.33-.14.09-.09.13-.2.13-.34V4.06c0-.13-.04-.25-.13-.34a.45.45 0 0 0-.33-.14c-.13 0-.24.05-.33.14-.09.09-.13.2-.13.34v7.61c0 .14.04.25.13.34.09.09.2.14.33.14z" fill="#3B3731"/></svg>';

$favShieldGroomer = '<svg xmlns="http://www.w3.org/2000/svg" width="21" height="22" viewBox="0 0 21 22" fill="none" aria-hidden="true"><path d="M10.9482 0.125295C10.7667 0.043205 10.5723 0 10.3692 0C10.1662 0 9.97174 0.043205 9.79028 0.125295L1.65477 3.57738C0.704262 3.97918 -0.00430085 4.91673 1.96518e-05 6.0487C0.0216222 10.3346 1.78439 18.1764 9.22861 21.7408C9.95014 22.0864 10.7883 22.0864 11.5098 21.7408C18.9541 18.1764 20.7168 10.3346 20.7384 6.0487C20.7428 4.91673 20.0342 3.97918 19.0837 3.57738L10.9482 0.125295ZM6.26043 12.3653C6.46781 12.4171 6.68816 12.443 6.91282 12.443C8.43796 12.443 9.67795 11.2031 9.67795 9.67793V6.9128H11.5876C12.1104 6.9128 12.59 7.2066 12.8233 7.67753L13.1343 8.29537H15.8995C16.2797 8.29537 16.5907 8.60644 16.5907 8.98665V10.3692C16.5907 12.2789 15.044 13.8256 13.1343 13.8256H11.0605V16.0161C11.0605 16.3315 10.8056 16.5907 10.4859 16.5907C10.4081 16.5907 10.3303 16.5734 10.2612 16.5432L5.99688 14.7156C5.71172 14.5947 5.53026 14.3138 5.53026 14.0071C5.53026 13.8861 5.55619 13.7694 5.61235 13.6614L6.26043 12.3653ZM6.22154 6.9128H8.29538V9.67793C8.29538 10.4427 7.67755 11.0605 6.91282 11.0605C6.1481 11.0605 5.53026 10.4427 5.53026 9.67793V7.60408C5.53026 7.22388 5.84134 6.9128 6.22154 6.9128ZM11.7518 8.98665C11.7518 8.80331 11.679 8.62748 11.5493 8.49784C11.4197 8.3682 11.2438 8.29537 11.0605 8.29537C10.8772 8.29537 10.7013 8.3682 10.5717 8.49784C10.4421 8.62748 10.3692 8.80331 10.3692 8.98665C10.3692 9.16998 10.4421 9.34581 10.5717 9.47545C10.7013 9.60509 10.8772 9.67793 11.0605 9.67793C11.2438 9.67793 11.4197 9.60509 11.5493 9.47545C11.679 9.34581 11.7518 9.16998 11.7518 8.98665Z" fill="#C9DDA0"/></svg>';

$favShieldSpace = '<svg xmlns="http://www.w3.org/2000/svg" width="21" height="22" viewBox="0 0 21 22" fill="none" aria-hidden="true"><path d="M10.9482 0.125295C10.7667 0.043205 10.5723 0 10.3692 0C10.1662 0 9.97174 0.043205 9.79028 0.125295L1.65477 3.57738C0.704261 3.97918 -0.00430085 4.91673 1.96518e-05 6.0487C0.0216222 10.3346 1.78439 18.1764 9.22861 21.7408C9.95014 22.0864 10.7883 22.0864 11.5098 21.7408C18.9541 18.1764 20.7168 10.3346 20.7384 6.0487C20.7428 4.91673 20.0342 3.97918 19.0837 3.57738L10.9482 0.125295Z" fill="#CBDCE8"/><path d="M16 6L11.5556 10.7222L16 6ZM9.58111 10.4917C8.20333 11.0206 7.10167 10.93 6 10.4933C6.27778 14.0728 7.94667 15.4489 10.1717 16C10.1717 16 11.8478 14.8144 12.0894 12.0039C12.1156 11.6994 12.1283 11.5478 12.0656 11.3761C12.0022 11.2044 11.8778 11.0817 11.6294 10.8356C11.2206 10.4311 11.0167 10.2289 10.7739 10.1778C10.5311 10.1278 10.2144 10.2489 9.58111 10.4917Z" fill="#CBDCE8"/><path d="M16 6L11.5556 10.7222M9.58111 10.4917C8.20333 11.0206 7.10167 10.93 6 10.4933C6.27778 14.0728 7.94667 15.4489 10.1717 16C10.1717 16 11.8478 14.8144 12.0894 12.0039C12.1156 11.6994 12.1283 11.5478 12.0656 11.3761C12.0022 11.2044 11.8778 11.0817 11.6294 10.8356C11.2206 10.4311 11.0167 10.2289 10.7739 10.1778C10.5311 10.1278 10.2144 10.2489 9.58111 10.4917Z" stroke="white" stroke-linecap="round" stroke-linejoin="round"/><path d="M6.83331 13.4703C6.83331 13.4703 8.2222 13.7392 9.61109 12.667" stroke="white" stroke-linecap="round" stroke-linejoin="round"/><path d="M9.05558 8.36144C9.05558 8.54561 8.98241 8.72225 8.85218 8.85248C8.72194 8.98272 8.54531 9.05588 8.36113 9.05588C8.17695 9.05588 8.00032 8.98272 7.87009 8.85248C7.73985 8.72225 7.66669 8.54561 7.66669 8.36144C7.66669 8.17726 7.73985 8.00062 7.87009 7.87039C8.00032 7.74016 8.17695 7.66699 8.36113 7.66699C8.54531 7.66699 8.72194 7.74016 8.85218 7.87039C8.98241 8.00062 9.05558 8.17726 9.05558 8.36144Z" fill="#CBDCE8" stroke="white"/><path d="M10.4445 6.55554V6.6111" stroke="white" stroke-linecap="round" stroke-linejoin="round"/></svg>';

$favArrow = '<svg width="14" height="12" viewBox="0 0 14 12" fill="none" aria-hidden="true"><path d="M1 6h11M8 1.5 12.5 6 8 10.5" stroke="#fff" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>';

$favBookIcon = '<svg width="16" height="16" viewBox="0 0 17 17" fill="none" aria-hidden="true"><path d="M2.3 15.5v-2.9h2.9" stroke="currentColor" stroke-width="1.2" stroke-linecap="round"/><path d="M15.4 6.7a6.9 6.9 0 0 1-13.1 6.1M.7 9.4A6.9 6.9 0 0 1 13.8 3.3" stroke="currentColor" stroke-width="1.2" stroke-linecap="round"/><path d="M13.8.6v2.9h-2.9" stroke="currentColor" stroke-width="1.2" stroke-linecap="round"/></svg>';

$favPin = '<svg width="10" height="14" viewBox="0 0 10 14" fill="none" aria-hidden="true"><path d="M5 6.65a1.75 1.75 0 1 1 0-3.5 1.75 1.75 0 0 1 0 3.5zM5 0C2.24 0 0 2.2 0 4.9 0 8.58 5 14 5 14s5-5.42 5-9.1C10 2.2 7.76 0 5 0z" fill="#FFC97A"/></svg>';

$favStar = '<svg width="14" height="14" viewBox="0 0 14 14" fill="none" aria-hidden="true"><path d="M6.13.66c.27-.88 1.47-.88 1.74 0l1.03 3.3c.12.39.47.66.87.66h3.31c.89 0 1.26 1.18.54 1.73l-2.68 2.03c-.32.24-.45.68-.33 1.07l1.03 3.29c.27.88-.7 1.61-1.41 1.07L7.54 11.8a.9.9 0 0 0-1.08 0L3.78 13.81c-.72.54-1.68-.19-1.41-1.07l1.03-3.29a.9.9 0 0 0-.33-1.07L.38 6.34c-.72-.54-.4-1.73.54-1.73h3.31c.4 0 .75-.27.87-.66L6.13.66z" fill="#FFC97A"/></svg>';

$favAmenity = '
<span class="fav-card__amenity fav-card__amenity--blue" aria-hidden="true"></span>
<span class="fav-card__amenity fav-card__amenity--coral" aria-hidden="true"></span>
<span class="fav-card__amenity fav-card__amenity--green" aria-hidden="true"></span>
';
?>

<div class="fav" id="favourites-root">
    <div class="fav-head">
        <h2 class="fav-title" id="fav-title">Favourite Groomers</h2>
        <div class="fav-toolbar">
            <div class="fav-tabs" role="tablist" aria-label="Favourites type">
                <button type="button" class="fav-tab is-active" role="tab" aria-selected="true" data-fav-tab="groomers">Groomers</button>
                <button type="button" class="fav-tab" role="tab" aria-selected="false" data-fav-tab="spaces">Space Hosts</button>
            </div>
            <label class="fav-search">
                <input type="search" id="fav-search" placeholder="Type to search..." autocomplete="off">
                <svg class="fav-search__icon" width="16" height="16" viewBox="0 0 16 16" fill="none" aria-hidden="true">
                    <circle cx="6.2" cy="6.2" r="5.2" stroke="#9D9B98"/>
                    <path d="m10.2 10.2 4.8 4.8" stroke="#9D9B98" stroke-linecap="round"/>
                </svg>
            </label>
        </div>
    </div>

    <!-- Groomers -->
    <div class="fav-panel" id="fav-panel-groomers" data-fav-panel="groomers">
        <div class="fav-slider" id="fav-groomers-slider">
            <button type="button" class="fav-slider__arrow fav-slider__arrow--prev is-hidden" id="fav-groomers-prev" aria-label="Previous groomers">
                <svg width="8" height="14" viewBox="0 0 8 14" fill="none" aria-hidden="true"><path d="M7 1L1 7l6 6" stroke="#3B3731" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </button>
            <div class="fav-grid" id="fav-groomers-grid">

            <article class="fav-card" data-fav-name="Sarah W. Sarah's Grooming Studio" data-booked="1">
                <div class="fav-card__body">
                    <div class="fav-card__media">
                        <div class="fav-card__badge" title="Verified"><?= $favShieldGroomer ?></div>
                        <svg class="fav-card__photo" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 255 130" fill="none" role="img" aria-label="Sarah W.">
                            <defs>
                                <pattern id="fav-pattern-1" patternUnits="userSpaceOnUse" width="255" height="130">
                                    <image href="<?= BASE_URL ?>assets/images/profile_modal_image.jpg" width="255" height="130" preserveAspectRatio="xMinYMax slice"></image>
                                </pattern>
                            </defs>
                            <path d="M255 124.417C255 127.178 252.761 129.417 250 129.417H5C2.23858 129.417 0 127.178 0 124.417V37C0 34.2386 2.23858 32 5 32H27C29.7614 32 32 29.7614 32 27V5C32 2.23858 34.2386 0 37 0H250C252.761 0 255 2.23858 255 5V124.417Z" fill="url(#fav-pattern-1)"></path>
                        </svg>
                        <button type="button" class="fav-card__delete" aria-label="Remove favourite" data-fav-delete><?= $favTrash ?></button>
                    </div>
                    <div class="fav-card__amenities"><?= $favAmenity ?></div>
                    <span class="fav-card__tag">Groomer's Studio</span>
                    <h3 class="fav-card__name">Sarah W.</h3>
                    <p class="fav-card__sub">Sarah's Grooming Studio</p>
                    <div class="fav-card__meta">
                        <span><?= $favPin ?> 2.5 mi</span>
                        <span><?= $favStar ?> 4.3 <strong>(20)</strong></span>
                    </div>
                    <p class="fav-card__quote">"Hands down the best groomer we've tried. The studio is spotless..."</p>
                    <div class="fav-card__price-row">
                        <p class="fav-card__price">From <strong>£38</strong></p>
                        <a class="fav-card__go" href="<?= BASE_URL ?>profiles/groomer/groomer_profile.php" aria-label="View profile"><?= $favArrow ?></a>
                    </div>
                </div>
                <a class="fav-card__cta fav-card__cta--book" href="<?= BASE_URL ?>profiles/groomer/groomer_profile.php#booking-sidebar"><?= $favBookIcon ?> Book Again</a>
                <div class="fav-card__confirm" hidden>
                    <svg width="28" height="26" viewBox="0 0 24 22" fill="none" aria-hidden="true"><path d="M10.3 2.9 1.8 17.5a2 2 0 0 0 1.7 3h17a2 2 0 0 0 1.7-3L13.7 2.9a2 2 0 0 0-3.4 0z" stroke="#FF8E8E" stroke-width="1.5"/><path d="M12 8v5M12 16.5h.01" stroke="#FF8E8E" stroke-width="1.8" stroke-linecap="round"/></svg>
                    <h4>Remove this groomer?</h4>
                    <p>Are you sure you want to delete this groomer from your favourites?</p>
                    <div class="fav-card__confirm-actions">
                        <button type="button" class="fav-card__btn fav-card__btn--ghost" data-fav-cancel>Cancel</button>
                        <button type="button" class="fav-card__btn fav-card__btn--danger" data-fav-confirm-delete>Yes, delete</button>
                    </div>
                </div>
            </article>

            <article class="fav-card" data-fav-name="Cathy P. Cathy's Pawfect Studio" data-booked="0">
                <div class="fav-card__body">
                    <div class="fav-card__media">
                        <div class="fav-card__badge" title="Verified"><?= $favShieldGroomer ?></div>
                        <svg class="fav-card__photo" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 255 130" fill="none" role="img" aria-label="Cathy P.">
                            <defs>
                                <pattern id="fav-pattern-2" patternUnits="userSpaceOnUse" width="255" height="130">
                                    <image href="<?= BASE_URL ?>assets/images/profile_modal_image2.jpg" width="255" height="130" preserveAspectRatio="xMinYMax slice"></image>
                                </pattern>
                            </defs>
                            <path d="M255 124.417C255 127.178 252.761 129.417 250 129.417H5C2.23858 129.417 0 127.178 0 124.417V37C0 34.2386 2.23858 32 5 32H27C29.7614 32 32 29.7614 32 27V5C32 2.23858 34.2386 0 37 0H250C252.761 0 255 2.23858 255 5V124.417Z" fill="url(#fav-pattern-2)"></path>
                        </svg>
                        <button type="button" class="fav-card__delete" aria-label="Remove favourite" data-fav-delete><?= $favTrash ?></button>
                    </div>
                    <div class="fav-card__amenities"><?= $favAmenity ?></div>
                    <span class="fav-card__tag fav-card__tag--peach">Salons</span>
                    <h3 class="fav-card__name">Cathy P.</h3>
                    <p class="fav-card__sub">Cathy's Pawfect Studio</p>
                    <div class="fav-card__meta">
                        <span><?= $favPin ?> 1.5 mi</span>
                        <span><?= $favStar ?> 4.6 <strong>(34)</strong></span>
                    </div>
                    <p class="fav-card__quote">"Such a calming experience for my anxious pup. Cathy is amazing!"</p>
                    <div class="fav-card__price-row">
                        <p class="fav-card__price">From <strong>£42</strong></p>
                        <a class="fav-card__go" href="<?= BASE_URL ?>profiles/groomer/groomer_profile.php" aria-label="View profile"><?= $favArrow ?></a>
                    </div>
                </div>
                <a class="fav-card__cta fav-card__cta--view" href="<?= BASE_URL ?>profiles/groomer/groomer_profile.php"><?= $favArrow ?> View Profile</a>
                <div class="fav-card__confirm" hidden>
                    <svg width="28" height="26" viewBox="0 0 24 22" fill="none" aria-hidden="true"><path d="M10.3 2.9 1.8 17.5a2 2 0 0 0 1.7 3h17a2 2 0 0 0 1.7-3L13.7 2.9a2 2 0 0 0-3.4 0z" stroke="#FF8E8E" stroke-width="1.5"/><path d="M12 8v5M12 16.5h.01" stroke="#FF8E8E" stroke-width="1.8" stroke-linecap="round"/></svg>
                    <h4>Remove this groomer?</h4>
                    <p>Are you sure you want to delete this groomer from your favourites?</p>
                    <div class="fav-card__confirm-actions">
                        <button type="button" class="fav-card__btn fav-card__btn--ghost" data-fav-cancel>Cancel</button>
                        <button type="button" class="fav-card__btn fav-card__btn--danger" data-fav-confirm-delete>Yes, delete</button>
                    </div>
                </div>
            </article>

            <article class="fav-card" data-fav-name="Mia L. Mia's Mobile Grooming" data-booked="1">
                <div class="fav-card__body">
                    <div class="fav-card__media">
                        <div class="fav-card__badge" title="Verified"><?= $favShieldGroomer ?></div>
                        <svg class="fav-card__photo" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 255 130" fill="none" role="img" aria-label="Mia L.">
                            <defs>
                                <pattern id="fav-pattern-3" patternUnits="userSpaceOnUse" width="255" height="130">
                                    <image href="<?= BASE_URL ?>assets/images/profile_modal_image3.jpg" width="255" height="130" preserveAspectRatio="xMinYMax slice"></image>
                                </pattern>
                            </defs>
                            <path d="M255 124.417C255 127.178 252.761 129.417 250 129.417H5C2.23858 129.417 0 127.178 0 124.417V37C0 34.2386 2.23858 32 5 32H27C29.7614 32 32 29.7614 32 27V5C32 2.23858 34.2386 0 37 0H250C252.761 0 255 2.23858 255 5V124.417Z" fill="url(#fav-pattern-3)"></path>
                        </svg>
                        <button type="button" class="fav-card__delete" aria-label="Remove favourite" data-fav-delete><?= $favTrash ?></button>
                    </div>
                    <div class="fav-card__amenities"><?= $favAmenity ?></div>
                    <span class="fav-card__tag">Mobile Station</span>
                    <h3 class="fav-card__name">Mia L.</h3>
                    <p class="fav-card__sub">Mia's Mobile Grooming</p>
                    <div class="fav-card__meta">
                        <span><?= $favPin ?> 3.1 mi</span>
                        <span><?= $favStar ?> 4.8 <strong>(51)</strong></span>
                    </div>
                    <p class="fav-card__quote">"Comes to our door and my dog looks fabulous every time."</p>
                    <div class="fav-card__price-row">
                        <p class="fav-card__price">From <strong>£45</strong></p>
                        <a class="fav-card__go" href="<?= BASE_URL ?>profiles/groomer/groomer_profile.php" aria-label="View profile"><?= $favArrow ?></a>
                    </div>
                </div>
                <a class="fav-card__cta fav-card__cta--book" href="<?= BASE_URL ?>profiles/groomer/groomer_profile.php#booking-sidebar"><?= $favBookIcon ?> Book Again</a>
                <div class="fav-card__confirm" hidden>
                    <svg width="28" height="26" viewBox="0 0 24 22" fill="none" aria-hidden="true"><path d="M10.3 2.9 1.8 17.5a2 2 0 0 0 1.7 3h17a2 2 0 0 0 1.7-3L13.7 2.9a2 2 0 0 0-3.4 0z" stroke="#FF8E8E" stroke-width="1.5"/><path d="M12 8v5M12 16.5h.01" stroke="#FF8E8E" stroke-width="1.8" stroke-linecap="round"/></svg>
                    <h4>Remove this groomer?</h4>
                    <p>Are you sure you want to delete this groomer from your favourites?</p>
                    <div class="fav-card__confirm-actions">
                        <button type="button" class="fav-card__btn fav-card__btn--ghost" data-fav-cancel>Cancel</button>
                        <button type="button" class="fav-card__btn fav-card__btn--danger" data-fav-confirm-delete>Yes, delete</button>
                    </div>
                </div>
            </article>

            <article class="fav-card" data-fav-name="Ken T. Ken's Grooming Mobile" data-booked="0">
                <div class="fav-card__body">
                    <div class="fav-card__media">
                        <div class="fav-card__badge" title="Verified"><?= $favShieldGroomer ?></div>
                        <svg class="fav-card__photo" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 255 130" fill="none" role="img" aria-label="Ken T.">
                            <defs>
                                <pattern id="fav-pattern-4" patternUnits="userSpaceOnUse" width="255" height="130">
                                    <image href="<?= BASE_URL ?>assets/images/groomer-profile.png" width="255" height="130" preserveAspectRatio="xMinYMax slice"></image>
                                </pattern>
                            </defs>
                            <path d="M255 124.417C255 127.178 252.761 129.417 250 129.417H5C2.23858 129.417 0 127.178 0 124.417V37C0 34.2386 2.23858 32 5 32H27C29.7614 32 32 29.7614 32 27V5C32 2.23858 34.2386 0 37 0H250C252.761 0 255 2.23858 255 5V124.417Z" fill="url(#fav-pattern-4)"></path>
                        </svg>
                        <button type="button" class="fav-card__delete" aria-label="Remove favourite" data-fav-delete><?= $favTrash ?></button>
                    </div>
                    <div class="fav-card__amenities"><?= $favAmenity ?></div>
                    <span class="fav-card__tag">Home Visit</span>
                    <h3 class="fav-card__name">Ken T.</h3>
                    <p class="fav-card__sub">Ken's Grooming Mobile</p>
                    <div class="fav-card__meta">
                        <span><?= $favPin ?> 4.2 mi</span>
                        <span><?= $favStar ?> 4.5 <strong>(27)</strong></span>
                    </div>
                    <p class="fav-card__quote">"Reliable home visits — my dog settles quickly with Ken."</p>
                    <div class="fav-card__price-row">
                        <p class="fav-card__price">From <strong>£40</strong></p>
                        <a class="fav-card__go" href="<?= BASE_URL ?>profiles/groomer/groomer_profile.php" aria-label="View profile"><?= $favArrow ?></a>
                    </div>
                </div>
                <a class="fav-card__cta fav-card__cta--view" href="<?= BASE_URL ?>profiles/groomer/groomer_profile.php"><?= $favArrow ?> View Profile</a>
                <div class="fav-card__confirm" hidden>
                    <svg width="28" height="26" viewBox="0 0 24 22" fill="none" aria-hidden="true"><path d="M10.3 2.9 1.8 17.5a2 2 0 0 0 1.7 3h17a2 2 0 0 0 1.7-3L13.7 2.9a2 2 0 0 0-3.4 0z" stroke="#FF8E8E" stroke-width="1.5"/><path d="M12 8v5M12 16.5h.01" stroke="#FF8E8E" stroke-width="1.8" stroke-linecap="round"/></svg>
                    <h4>Remove this groomer?</h4>
                    <p>Are you sure you want to delete this groomer from your favourites?</p>
                    <div class="fav-card__confirm-actions">
                        <button type="button" class="fav-card__btn fav-card__btn--ghost" data-fav-cancel>Cancel</button>
                        <button type="button" class="fav-card__btn fav-card__btn--danger" data-fav-confirm-delete>Yes, delete</button>
                    </div>
                </div>
            </article>

            </div>
            <button type="button" class="fav-slider__arrow fav-slider__arrow--next is-hidden" id="fav-groomers-next" aria-label="Next groomers">
                <svg width="8" height="14" viewBox="0 0 8 14" fill="none" aria-hidden="true"><path d="M1 1l6 6-6 6" stroke="#3B3731" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </button>
        </div>
        <p class="fav-empty" id="fav-groomers-empty" hidden>No favourite groomers match your search.</p>
    </div>

    <!-- Space Hosts -->
    <div class="fav-panel" id="fav-panel-spaces" data-fav-panel="spaces" hidden>
        <div class="fav-slider" id="fav-spaces-slider">
            <button type="button" class="fav-slider__arrow fav-slider__arrow--prev is-hidden" id="fav-spaces-prev" aria-label="Previous spaces">
                <svg width="8" height="14" viewBox="0 0 8 14" fill="none" aria-hidden="true"><path d="M7 1L1 7l6 6" stroke="#3B3731" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </button>
            <div class="fav-grid" id="fav-spaces-grid">

            <article class="fav-card" data-fav-name="Furs & Co. Studio Dev É." data-booked="1" data-fav-kind="space">
                <div class="fav-card__body">
                    <div class="fav-card__media">
                        <div class="fav-card__badge" title="Verified"><?= $favShieldSpace ?></div>
                        <svg class="fav-card__photo" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 255 130" fill="none" role="img" aria-label="Furs & Co. Studio">
                            <defs>
                                <pattern id="fav-pattern-5" patternUnits="userSpaceOnUse" width="255" height="130">
                                    <image href="<?= BASE_URL ?>assets/images/space_card1.png" width="255" height="130" preserveAspectRatio="xMinYMax slice"></image>
                                </pattern>
                            </defs>
                            <path d="M255 124.417C255 127.178 252.761 129.417 250 129.417H5C2.23858 129.417 0 127.178 0 124.417V37C0 34.2386 2.23858 32 5 32H27C29.7614 32 32 29.7614 32 27V5C32 2.23858 34.2386 0 37 0H250C252.761 0 255 2.23858 255 5V124.417Z" fill="url(#fav-pattern-5)"></path>
                        </svg>
                        <button type="button" class="fav-card__delete" aria-label="Remove favourite" data-fav-delete><?= $favTrash ?></button>
                    </div>
                    <div class="fav-card__amenities"><?= $favAmenity ?></div>
                    <span class="fav-card__tag fav-card__tag--peach">Salons</span>
                    <h3 class="fav-card__name">Furs &amp; Co. Studio</h3>
                    <p class="fav-card__sub">Hosted by <strong>Dev É.</strong></p>
                    <div class="fav-card__meta">
                        <span><?= $favPin ?> 1.2 mi</span>
                        <span><?= $favStar ?> 4.7 <strong>(18)</strong></span>
                    </div>
                    <p class="fav-card__quote">"Beautiful space — clean, calm, and perfect for full grooms."</p>
                    <div class="fav-card__price-row">
                        <p class="fav-card__price">From <strong>£28</strong> / hour</p>
                        <a class="fav-card__go" href="<?= BASE_URL ?>profiles/space/space_profile.php" aria-label="View profile"><?= $favArrow ?></a>
                    </div>
                </div>
                <a class="fav-card__cta fav-card__cta--book" href="<?= BASE_URL ?>profiles/space/space_profile.php"><?= $favBookIcon ?> Book Again</a>
                <div class="fav-card__confirm" hidden>
                    <svg width="28" height="26" viewBox="0 0 24 22" fill="none" aria-hidden="true"><path d="M10.3 2.9 1.8 17.5a2 2 0 0 0 1.7 3h17a2 2 0 0 0 1.7-3L13.7 2.9a2 2 0 0 0-3.4 0z" stroke="#FF8E8E" stroke-width="1.5"/><path d="M12 8v5M12 16.5h.01" stroke="#FF8E8E" stroke-width="1.8" stroke-linecap="round"/></svg>
                    <h4>Remove this space?</h4>
                    <p>Are you sure you want to delete this space from your favourites?</p>
                    <div class="fav-card__confirm-actions">
                        <button type="button" class="fav-card__btn fav-card__btn--ghost" data-fav-cancel>Cancel</button>
                        <button type="button" class="fav-card__btn fav-card__btn--danger" data-fav-confirm-delete>Yes, delete</button>
                    </div>
                </div>
            </article>

            <article class="fav-card" data-fav-name="Garden Retreat Space Hosted by Alex" data-booked="0" data-fav-kind="space">
                <div class="fav-card__body">
                    <div class="fav-card__media">
                        <div class="fav-card__badge" title="Verified"><?= $favShieldSpace ?></div>
                        <svg class="fav-card__photo" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 255 130" fill="none" role="img" aria-label="Garden Retreat Space">
                            <defs>
                                <pattern id="fav-pattern-6" patternUnits="userSpaceOnUse" width="255" height="130">
                                    <image href="<?= BASE_URL ?>assets/images/space_card2.png" width="255" height="130" preserveAspectRatio="xMinYMax slice"></image>
                                </pattern>
                            </defs>
                            <path d="M255 124.417C255 127.178 252.761 129.417 250 129.417H5C2.23858 129.417 0 127.178 0 124.417V37C0 34.2386 2.23858 32 5 32H27C29.7614 32 32 29.7614 32 27V5C32 2.23858 34.2386 0 37 0H250C252.761 0 255 2.23858 255 5V124.417Z" fill="url(#fav-pattern-6)"></path>
                        </svg>
                        <button type="button" class="fav-card__delete" aria-label="Remove favourite" data-fav-delete><?= $favTrash ?></button>
                    </div>
                    <div class="fav-card__amenities"><?= $favAmenity ?></div>
                    <span class="fav-card__tag">Garden/Shed</span>
                    <h3 class="fav-card__name">Garden Retreat Space</h3>
                    <p class="fav-card__sub">Hosted by <strong>Alex R.</strong></p>
                    <div class="fav-card__meta">
                        <span><?= $favPin ?> 2.8 mi</span>
                        <span><?= $favStar ?> 4.4 <strong>(12)</strong></span>
                    </div>
                    <p class="fav-card__quote">"Quiet garden studio — my clients love the outdoor drying area."</p>
                    <div class="fav-card__price-row">
                        <p class="fav-card__price">From <strong>£22</strong> / hour</p>
                        <a class="fav-card__go" href="<?= BASE_URL ?>profiles/space/space_profile.php" aria-label="View profile"><?= $favArrow ?></a>
                    </div>
                </div>
                <a class="fav-card__cta fav-card__cta--view" href="<?= BASE_URL ?>profiles/space/space_profile.php"><?= $favArrow ?> View Profile</a>
                <div class="fav-card__confirm" hidden>
                    <svg width="28" height="26" viewBox="0 0 24 22" fill="none" aria-hidden="true"><path d="M10.3 2.9 1.8 17.5a2 2 0 0 0 1.7 3h17a2 2 0 0 0 1.7-3L13.7 2.9a2 2 0 0 0-3.4 0z" stroke="#FF8E8E" stroke-width="1.5"/><path d="M12 8v5M12 16.5h.01" stroke="#FF8E8E" stroke-width="1.8" stroke-linecap="round"/></svg>
                    <h4>Remove this space?</h4>
                    <p>Are you sure you want to delete this space from your favourites?</p>
                    <div class="fav-card__confirm-actions">
                        <button type="button" class="fav-card__btn fav-card__btn--ghost" data-fav-cancel>Cancel</button>
                        <button type="button" class="fav-card__btn fav-card__btn--danger" data-fav-confirm-delete>Yes, delete</button>
                    </div>
                </div>
            </article>

            <article class="fav-card" data-fav-name="Central Salon Bay Hosted by Priya" data-booked="1" data-fav-kind="space">
                <div class="fav-card__body">
                    <div class="fav-card__media">
                        <div class="fav-card__badge" title="Verified"><?= $favShieldSpace ?></div>
                        <svg class="fav-card__photo" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 255 130" fill="none" role="img" aria-label="Central Salon Bay">
                            <defs>
                                <pattern id="fav-pattern-7" patternUnits="userSpaceOnUse" width="255" height="130">
                                    <image href="<?= BASE_URL ?>assets/images/space_card3.png" width="255" height="130" preserveAspectRatio="xMinYMax slice"></image>
                                </pattern>
                            </defs>
                            <path d="M255 124.417C255 127.178 252.761 129.417 250 129.417H5C2.23858 129.417 0 127.178 0 124.417V37C0 34.2386 2.23858 32 5 32H27C29.7614 32 32 29.7614 32 27V5C32 2.23858 34.2386 0 37 0H250C252.761 0 255 2.23858 255 5V124.417Z" fill="url(#fav-pattern-7)"></path>
                        </svg>
                        <button type="button" class="fav-card__delete" aria-label="Remove favourite" data-fav-delete><?= $favTrash ?></button>
                    </div>
                    <div class="fav-card__amenities"><?= $favAmenity ?></div>
                    <span class="fav-card__tag fav-card__tag--peach">Private rooms</span>
                    <h3 class="fav-card__name">Central Salon Bay</h3>
                    <p class="fav-card__sub">Hosted by <strong>Priya S.</strong></p>
                    <div class="fav-card__meta">
                        <span><?= $favPin ?> 0.9 mi</span>
                        <span><?= $favStar ?> 4.9 <strong>(40)</strong></span>
                    </div>
                    <p class="fav-card__quote">"Professional setup in a great location — highly recommend."</p>
                    <div class="fav-card__price-row">
                        <p class="fav-card__price">From <strong>£35</strong> / hour</p>
                        <a class="fav-card__go" href="<?= BASE_URL ?>profiles/space/space_profile.php" aria-label="View profile"><?= $favArrow ?></a>
                    </div>
                </div>
                <a class="fav-card__cta fav-card__cta--book" href="<?= BASE_URL ?>profiles/space/space_profile.php"><?= $favBookIcon ?> Book Again</a>
                <div class="fav-card__confirm" hidden>
                    <svg width="28" height="26" viewBox="0 0 24 22" fill="none" aria-hidden="true"><path d="M10.3 2.9 1.8 17.5a2 2 0 0 0 1.7 3h17a2 2 0 0 0 1.7-3L13.7 2.9a2 2 0 0 0-3.4 0z" stroke="#FF8E8E" stroke-width="1.5"/><path d="M12 8v5M12 16.5h.01" stroke="#FF8E8E" stroke-width="1.8" stroke-linecap="round"/></svg>
                    <h4>Remove this space?</h4>
                    <p>Are you sure you want to delete this space from your favourites?</p>
                    <div class="fav-card__confirm-actions">
                        <button type="button" class="fav-card__btn fav-card__btn--ghost" data-fav-cancel>Cancel</button>
                        <button type="button" class="fav-card__btn fav-card__btn--danger" data-fav-confirm-delete>Yes, delete</button>
                    </div>
                </div>
            </article>

            </div>
            <button type="button" class="fav-slider__arrow fav-slider__arrow--next is-hidden" id="fav-spaces-next" aria-label="Next spaces">
                <svg width="8" height="14" viewBox="0 0 8 14" fill="none" aria-hidden="true"><path d="M1 1l6 6-6 6" stroke="#3B3731" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </button>
        </div>
        <p class="fav-empty" id="fav-spaces-empty" hidden>No favourite spaces match your search.</p>
    </div>
</div>
