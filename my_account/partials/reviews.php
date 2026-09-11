<?php
/**
 * Reviews tab — Written + Received
 * Edit / delete states matched to Figma.
 */

$revStarOn = '<svg width="18" height="17" viewBox="0 0 14 14" fill="none" aria-hidden="true"><path d="M6.13.66c.27-.88 1.47-.88 1.74 0l1.03 3.3c.12.39.47.66.87.66h3.31c.89 0 1.26 1.18.54 1.73l-2.68 2.03c-.32.24-.45.68-.33 1.07l1.03 3.29c.27.88-.7 1.61-1.41 1.07L7.54 11.8a.9.9 0 0 0-1.08 0L3.78 13.81c-.72.54-1.68-.19-1.41-1.07l1.03-3.29a.9.9 0 0 0-.33-1.07L.38 6.34c-.72-.54-.4-1.73.54-1.73h3.31c.4 0 .75-.27.87-.66L6.13.66z" fill="#FFC97A"/></svg>';
$revStarOff = '<svg width="18" height="17" viewBox="0 0 14 14" fill="none" aria-hidden="true"><path d="M6.13.66c.27-.88 1.47-.88 1.74 0l1.03 3.3c.12.39.47.66.87.66h3.31c.89 0 1.26 1.18.54 1.73l-2.68 2.03c-.32.24-.45.68-.33 1.07l1.03 3.29c.27.88-.7 1.61-1.41 1.07L7.54 11.8a.9.9 0 0 0-1.08 0L3.78 13.81c-.72.54-1.68-.19-1.41-1.07l1.03-3.29a.9.9 0 0 0-.33-1.07L.38 6.34c-.72-.54-.4-1.73.54-1.73h3.31c.4 0 .75-.27.87-.66L6.13.66z" fill="#E8E8E8"/></svg>';

function rev_stars($filled = 4) {
    global $revStarOn, $revStarOff;
    $html = '<span class="rev-card__stars" aria-label="' . (int) $filled . ' out of 5 stars">';
    for ($i = 1; $i <= 5; $i++) {
        $html .= $i <= $filled ? $revStarOn : $revStarOff;
    }
    $html .= '</span>';
    return $html;
}

$revEditIcon = '<svg width="14" height="14" viewBox="0 0 16 15" fill="none" aria-hidden="true"><path d="M10.2 2.38L12.85 4.98M8.44 14.5H15.5M1.38 11.04L.5 14.5l3.53-.87L14.25 3.6a1.88 1.88 0 0 0 0-2.45L14.1 1.01a1.88 1.88 0 0 0-2.5 0L1.38 11.04z" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/></svg>';
$revTrashIcon = '<svg width="13" height="14" viewBox="0 0 14 15" fill="none" aria-hidden="true"><path d="M1.5 3.5h11M5 3.5V2a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v1.5M11.5 3.5l-.7 9.2a1.5 1.5 0 0 1-1.5 1.3H4.7a1.5 1.5 0 0 1-1.5-1.3L2.5 3.5" stroke="currentColor" stroke-width="1.2" stroke-linecap="round"/></svg>';
$revWarnIcon = '<svg width="22" height="20" viewBox="0 0 24 22" fill="none" aria-hidden="true"><path d="M10.3 2.9 1.8 17.5a2 2 0 0 0 1.7 3h17a2 2 0 0 0 1.7-3L13.7 2.9a2 2 0 0 0-3.4 0z" stroke="#FF8E8E" stroke-width="1.5"/><path d="M12 8v5M12 16.5h.01" stroke="#FF8E8E" stroke-width="1.8" stroke-linecap="round"/></svg>';
$revChevron = '<svg width="12" height="7" viewBox="0 0 13 7" fill="none" aria-hidden="true"><path d="M11.9.5 6.16 6.25.5.6" stroke="#FBAC83" stroke-linecap="round" stroke-linejoin="round"/></svg>';

$revShieldGreen = '<svg width="18" height="19" viewBox="0 0 21 22" fill="none" aria-hidden="true"><path d="M10.95.13a1.6 1.6 0 0 0-1.16 0L1.65 3.58A2.5 2.5 0 0 0 0 6.05c.02 4.28 1.78 12.13 9.23 15.69a2.2 2.2 0 0 0 2.28 0c7.44-3.56 9.21-11.4 9.23-15.69a2.5 2.5 0 0 0-1.65-2.47L10.95.13z" fill="#C9DDA0"/></svg>';
$revShieldBlue = '<svg width="18" height="19" viewBox="0 0 21 22" fill="none" aria-hidden="true"><path d="M10.95.13a1.6 1.6 0 0 0-1.16 0L1.65 3.58A2.5 2.5 0 0 0 0 6.05c.02 4.28 1.78 12.13 9.23 15.69a2.2 2.2 0 0 0 2.28 0c7.44-3.56 9.21-11.4 9.23-15.69a2.5 2.5 0 0 0-1.65-2.47L10.95.13z" fill="#CBDCE8"/></svg>';

$revMenuDots = '<svg width="21" height="5" viewBox="0 0 25 5" fill="none" aria-hidden="true"><circle cx="2.5" cy="2.5" r="2.5" fill="#3B3731"/><circle cx="12.5" cy="2.5" r="2.5" fill="#3B3731"/><circle cx="22.5" cy="2.5" r="2.5" fill="#3B3731"/></svg>';
?>

<div class="rev" id="reviews-root">
    <div class="rev-head">
        <h2 class="rev-title" id="rev-title">Reviews Written</h2>
        <div class="rev-toolbar">
            <div class="rev-tabs" role="tablist" aria-label="Reviews type">
                <button type="button" class="rev-tab is-active" role="tab" aria-selected="true" data-rev-tab="written">Reviews Written</button>
                <button type="button" class="rev-tab" role="tab" aria-selected="false" data-rev-tab="received">Reviews Received</button>
            </div>
            <label class="rev-search">
                <input type="search" id="rev-search" placeholder="Type to search..." autocomplete="off">
                <svg class="rev-search__icon" width="16" height="16" viewBox="0 0 16 16" fill="none" aria-hidden="true">
                    <circle cx="6.2" cy="6.2" r="5.2" stroke="#9D9B98"/>
                    <path d="m10.2 10.2 4.8 4.8" stroke="#9D9B98" stroke-linecap="round"/>
                </svg>
            </label>
        </div>

        <div class="rev-filters">
            <div class="rev-filter-tags" id="rev-filter-tags">
                <button type="button" class="rev-filter-tag" data-rev-clear-tag data-rev-tag-label>
                    Garden / Shed
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="rev-filter-pills">
                <button type="button" class="rev-filter-pill" data-rev-filter="groomer">Groomer Venue <?= $revChevron ?></button>
                <button type="button" class="rev-filter-pill" data-rev-filter="space">Space Venue <?= $revChevron ?></button>
                <button type="button" class="rev-filter-pill" data-rev-filter="sort">Sort <?= $revChevron ?></button>
            </div>
        </div>
    </div>

    <!-- Written -->
    <div class="rev-panel" id="rev-panel-written" data-rev-panel="written">
        <div class="rev-list" id="rev-written-list">

            <article class="rev-card" data-rev-id="w1" data-rev-name="Sarah's Grooming Studio Full Groom Bella">
                <div class="rev-card__head">
                    <div class="rev-card__avatar-wrap">
                        <img class="rev-card__avatar" src="<?= BASE_URL ?>assets/images/groomer-profile.png" alt="">
                        <span class="rev-card__shield" title="Verified"><?= $revShieldGreen ?></span>
                    </div>
                    <div class="rev-card__who">
                        <div class="rev-card__title-row">
                            <h3 class="rev-card__studio">Sarah's Grooming Studio</h3>
                            <span class="rev-card__badge">Reviews Written</span>
                        </div>
                        <p class="rev-card__service">Full Groom · Bella</p>
                    </div>
                    <span class="rev-card__edit-link" hidden>Edit review</span>
                    <div class="rev-card__menu">
                        <button type="button" class="rev-card__menu-btn" aria-label="Review options" data-rev-menu><?= $revMenuDots ?></button>
                        <div class="rev-card__dropdown" hidden>
                            <button type="button" class="rev-card__option" data-rev-edit><?= $revEditIcon ?> Edit details</button>
                            <button type="button" class="rev-card__option rev-card__option--danger" data-rev-delete><?= $revTrashIcon ?> Delete post</button>
                        </div>
                    </div>
                </div>
                <div class="rev-card__view">
                    <p class="rev-card__text">I booked this groomer through Fursgo for my anxious little cockapoo and honestly couldn't be happier. They took the time to let him settle and never rushed him...</p>
                    <div class="rev-card__foot">
                        <span class="rev-card__date">Posted 12 Nov 2025</span>
                        <?= rev_stars(4) ?>
                    </div>
                </div>
                <div class="rev-card__edit" hidden>
                    <textarea class="rev-card__textarea" rows="4">I booked this groomer through Fursgo for my anxious little cockapoo and honestly couldn't be happier. They took the time to let him settle and never rushed him...</textarea>
                    <div class="rev-card__edit-actions">
                        <button type="button" class="rev-btn rev-btn--ghost" data-rev-cancel-edit>Cancel</button>
                        <button type="button" class="rev-btn rev-btn--primary" data-rev-save>Save changes</button>
                    </div>
                </div>
                <div class="rev-card__remove" hidden>
                    <div class="rev-card__remove-copy">
                        <div class="rev-card__remove-title">
                            <?= $revWarnIcon ?>
                            <strong>Delete this review?</strong>
                        </div>
                        <span>Your review of <b>Sarah's Grooming Studio</b> will be permanently removed.</span>
                    </div>
                    <div class="rev-card__remove-actions">
                        <button type="button" class="rev-btn rev-btn--ghost" data-rev-cancel-delete>Cancel</button>
                        <button type="button" class="rev-btn rev-btn--danger" data-rev-confirm-delete>Yes, delete</button>
                    </div>
                </div>
            </article>

            <article class="rev-card" data-rev-id="w2" data-rev-name="Paws & Bubbles Studio Full Groom Bella">
                <div class="rev-card__head">
                    <div class="rev-card__avatar-wrap">
                        <img class="rev-card__avatar" src="<?= BASE_URL ?>assets/images/space_card3.png" alt="">
                        <span class="rev-card__shield" title="Verified"><?= $revShieldBlue ?></span>
                    </div>
                    <div class="rev-card__who">
                        <div class="rev-card__title-row">
                            <h3 class="rev-card__studio">Paws &amp; Bubbles Studio</h3>
                            <span class="rev-card__badge">Reviews Written</span>
                        </div>
                        <p class="rev-card__service">Half-day · Surf</p>
                    </div>
                    <span class="rev-card__edit-link" hidden>Edit review</span>
                    <div class="rev-card__menu">
                        <button type="button" class="rev-card__menu-btn" aria-label="Review options" data-rev-menu><?= $revMenuDots ?></button>
                        <div class="rev-card__dropdown" hidden>
                            <button type="button" class="rev-card__option" data-rev-edit><?= $revEditIcon ?> Edit details</button>
                            <button type="button" class="rev-card__option rev-card__option--danger" data-rev-delete><?= $revTrashIcon ?> Delete post</button>
                        </div>
                    </div>
                </div>
                <div class="rev-card__view">
                    <p class="rev-card__text">Beautiful space — clean, calm, and perfect for a full groom. Bella came out looking fluffy and smelling amazing.</p>
                    <div class="rev-card__foot">
                        <span class="rev-card__date">Posted 03 Oct 2025</span>
                        <?= rev_stars(5) ?>
                    </div>
                </div>
                <div class="rev-card__edit" hidden>
                    <textarea class="rev-card__textarea" rows="4">Beautiful space — clean, calm, and perfect for a full groom. Bella came out looking fluffy and smelling amazing.</textarea>
                    <div class="rev-card__edit-actions">
                        <button type="button" class="rev-btn rev-btn--ghost" data-rev-cancel-edit>Cancel</button>
                        <button type="button" class="rev-btn rev-btn--primary" data-rev-save>Save changes</button>
                    </div>
                </div>
                <div class="rev-card__remove" hidden>
                    <div class="rev-card__remove-copy">
                        <div class="rev-card__remove-title">
                            <?= $revWarnIcon ?>
                            <strong>Delete this review?</strong>
                        </div>
                        <span>Your review of <b>Paws &amp; Bubbles Studio</b> will be permanently removed.</span>
                    </div>
                    <div class="rev-card__remove-actions">
                        <button type="button" class="rev-btn rev-btn--ghost" data-rev-cancel-delete>Cancel</button>
                        <button type="button" class="rev-btn rev-btn--danger" data-rev-confirm-delete>Yes, delete</button>
                    </div>
                </div>
            </article>

            <article class="rev-card" data-rev-id="w3" data-rev-name="Cathy's Pawfect Studio Nail Trim Surf">
                <div class="rev-card__head">
                    <div class="rev-card__avatar-wrap">
                        <img class="rev-card__avatar" src="<?= BASE_URL ?>assets/images/profile_modal_image2.jpg" alt="">
                        <span class="rev-card__shield" title="Verified"><?= $revShieldGreen ?></span>
                    </div>
                    <div class="rev-card__who">
                        <div class="rev-card__title-row">
                            <h3 class="rev-card__studio">Cathy's Pawfect Studio</h3>
                            <span class="rev-card__badge">Reviews Written</span>
                        </div>
                        <p class="rev-card__service">Nail Trim · Surf</p>
                    </div>
                    <span class="rev-card__edit-link" hidden>Edit review</span>
                    <div class="rev-card__menu">
                        <button type="button" class="rev-card__menu-btn" aria-label="Review options" data-rev-menu><?= $revMenuDots ?></button>
                        <div class="rev-card__dropdown" hidden>
                            <button type="button" class="rev-card__option" data-rev-edit><?= $revEditIcon ?> Edit details</button>
                            <button type="button" class="rev-card__option rev-card__option--danger" data-rev-delete><?= $revTrashIcon ?> Delete post</button>
                        </div>
                    </div>
                </div>
                <div class="rev-card__view">
                    <p class="rev-card__text">Such a calming experience for my anxious pup. Cathy is amazing with nervous dogs and the studio is spotless.</p>
                    <div class="rev-card__foot">
                        <span class="rev-card__date">Posted 18 Sep 2025</span>
                        <?= rev_stars(4) ?>
                    </div>
                </div>
                <div class="rev-card__edit" hidden>
                    <textarea class="rev-card__textarea" rows="4">Such a calming experience for my anxious pup. Cathy is amazing with nervous dogs and the studio is spotless.</textarea>
                    <div class="rev-card__edit-actions">
                        <button type="button" class="rev-btn rev-btn--ghost" data-rev-cancel-edit>Cancel</button>
                        <button type="button" class="rev-btn rev-btn--primary" data-rev-save>Save changes</button>
                    </div>
                </div>
                <div class="rev-card__remove" hidden>
                    <div class="rev-card__remove-copy">
                        <div class="rev-card__remove-title">
                            <?= $revWarnIcon ?>
                            <strong>Delete this review?</strong>
                        </div>
                        <span>Your review of <b>Cathy's Pawfect Studio</b> will be permanently removed.</span>
                    </div>
                    <div class="rev-card__remove-actions">
                        <button type="button" class="rev-btn rev-btn--ghost" data-rev-cancel-delete>Cancel</button>
                        <button type="button" class="rev-btn rev-btn--danger" data-rev-confirm-delete>Yes, delete</button>
                    </div>
                </div>
            </article>

        </div>
        <p class="rev-empty" id="rev-written-empty" hidden>No written reviews match your search.</p>
        <div class="rev-more">
            <button type="button" class="rev-btn rev-btn--outline" data-rev-load-more>Load More</button>
        </div>
    </div>

    <!-- Received -->
    <div class="rev-panel" id="rev-panel-received" data-rev-panel="received" hidden>
        <div class="rev-list" id="rev-received-list">

            <article class="rev-card" data-rev-id="r1" data-rev-name="Sarah's Grooming Studio Full Groom Bella">
                <div class="rev-card__head">
                    <div class="rev-card__avatar-wrap">
                        <img class="rev-card__avatar" src="<?= BASE_URL ?>assets/images/groomer-profile.png" alt="">
                        <span class="rev-card__shield" title="Verified"><?= $revShieldGreen ?></span>
                    </div>
                    <div class="rev-card__who">
                        <div class="rev-card__title-row">
                            <h3 class="rev-card__studio">Sarah's Grooming Studio</h3>
                            <span class="rev-card__badge rev-card__badge--received">Reviews Received</span>
                        </div>
                        <p class="rev-card__service">Full Groom · Bella</p>
                    </div>
                </div>
                <div class="rev-card__view">
                    <p class="rev-card__text">I booked this groomer through Fursgo for my anxious little cockapoo and honestly couldn't be happier. They took the time to let him settle, talked me through what they were doing, and never rushed him...</p>
                    <div class="rev-card__foot">
                        <span class="rev-card__date">Posted 12 Nov 2025</span>
                        <?= rev_stars(4) ?>
                    </div>
                </div>
            </article>

            <article class="rev-card" data-rev-id="r2" data-rev-name="Sarah's Grooming Studio Full Groom Bella">
                <div class="rev-card__head">
                    <div class="rev-card__avatar-wrap">
                        <img class="rev-card__avatar" src="<?= BASE_URL ?>assets/images/groomer-profile.png" alt="">
                        <span class="rev-card__shield" title="Verified"><?= $revShieldGreen ?></span>
                    </div>
                    <div class="rev-card__who">
                        <div class="rev-card__title-row">
                            <h3 class="rev-card__studio">Sarah's Grooming Studio</h3>
                            <span class="rev-card__badge rev-card__badge--received">Reviews Received</span>
                        </div>
                        <p class="rev-card__service">Full Groom · Bella</p>
                    </div>
                </div>
                <div class="rev-card__view">
                    <p class="rev-card__text">I booked this groomer through Fursgo for my anxious little cockapoo and honestly couldn't be happier. They took the time to let him settle, talked me through what they were doing, and never rushed him...</p>
                    <div class="rev-card__foot">
                        <span class="rev-card__date">Posted 12 Nov 2025</span>
                        <?= rev_stars(4) ?>
                    </div>
                </div>
            </article>

            <article class="rev-card" data-rev-id="r3" data-rev-name="Sarah's Grooming Studio Full Groom Bella">
                <div class="rev-card__head">
                    <div class="rev-card__avatar-wrap">
                        <img class="rev-card__avatar" src="<?= BASE_URL ?>assets/images/groomer-profile.png" alt="">
                        <span class="rev-card__shield" title="Verified"><?= $revShieldGreen ?></span>
                    </div>
                    <div class="rev-card__who">
                        <div class="rev-card__title-row">
                            <h3 class="rev-card__studio">Sarah's Grooming Studio</h3>
                            <span class="rev-card__badge rev-card__badge--received">Reviews Received</span>
                        </div>
                        <p class="rev-card__service">Full Groom · Bella</p>
                    </div>
                </div>
                <div class="rev-card__view">
                    <p class="rev-card__text">I booked this groomer through Fursgo for my anxious little cockapoo and honestly couldn't be happier. They took the time to let him settle, talked me through what they were doing, and never rushed him...</p>
                    <div class="rev-card__foot">
                        <span class="rev-card__date">Posted 12 Nov 2025</span>
                        <?= rev_stars(4) ?>
                    </div>
                </div>
            </article>

        </div>
        <p class="rev-empty" id="rev-received-empty" hidden>No received reviews match your search.</p>
        <div class="rev-more">
            <button type="button" class="rev-btn rev-btn--outline" data-rev-load-more>Load More</button>
        </div>
    </div>
</div>
