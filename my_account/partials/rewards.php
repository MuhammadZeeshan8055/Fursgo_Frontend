<?php
/**
 * Rewards & Referrals tab — matched to Figma.
 */

$rwdCode = 'FURSGO-9X3P';
$rwdLink = 'fursgo.com/ref/FURSGO-9X3P';
?>

<div class="rwd" id="rewards-root">
    <h2 class="rwd-title">Rewards &amp; Referrals</h2>

    <div class="rwd-balances">
        <div class="rwd-balance rwd-balance--green">
            <span class="rwd-balance__amount">£26.40</span>
            <span class="rwd-balance__label">Rewards Balance</span>
        </div>
        <div class="rwd-balance rwd-balance--muted">
            <span class="rwd-balance__amount">£14.60</span>
            <span class="rwd-balance__sub">£24.60</span>
        </div>
    </div>

    <div class="rwd-referral">
        <div class="rwd-referral__fields">
            <div class="rwd-field">
                <label for="rwd-code">Your referral code</label>
                <div class="rwd-copy">
                    <input id="rwd-code" type="text" value="<?= htmlspecialchars($rwdCode) ?>" readonly>
                    <button type="button" class="rwd-copy__btn" data-rwd-copy>Copy</button>
                </div>
            </div>
            <div class="rwd-field">
                <label for="rwd-link">Share your referral link</label>
                <div class="rwd-copy">
                    <input id="rwd-link" type="text" value="<?= htmlspecialchars($rwdLink) ?>" readonly>
                    <button type="button" class="rwd-copy__btn" data-rwd-copy>Copy</button>
                </div>
            </div>
        </div>

        <div class="rwd-referral__aside">
            <div class="rwd-promo">
                <p><strong>You get £10 credit</strong>. <br> Your friends gets £5 off their first booking.</p>
            </div>
            <div class="rwd-share">
                <p class="rwd-share__label">Share to</p>
                <div class="rwd-share__icons" aria-label="Share referral">
                    <a class="rwd-share__icon" href="#" aria-label="Share on Facebook">
                        <svg width="44" height="44" viewBox="0 0 48 48" fill="none" aria-hidden="true">
                            <path d="M48 24C48 10.7452 37.2547 0 24 0C10.7452 0 0 10.7452 0 24C0 35.979 8.7765 45.9081 20.25 47.7084V30.9375H14.1562V24H20.25V18.7125C20.25 12.6975 23.8331 9.375 29.3153 9.375C31.941 9.375 34.6875 9.84375 34.6875 9.84375V15.75H31.6613C28.6798 15.75 27.75 17.6001 27.75 19.4981V24H34.4062L33.3422 30.9375H27.75V47.7084C39.2235 45.9081 48 35.9792 48 24Z" fill="#1877F2"/>
                        </svg>
                    </a>
                    <a class="rwd-share__icon" href="#" aria-label="Share on X">
                        <svg width="44" height="44" viewBox="0 0 48 48" fill="none" aria-hidden="true">
                            <circle cx="24" cy="24" r="24" fill="#000"/>
                            <path d="M31.4337 12L24.7723 19.6147L19.0123 12H10.667L20.6363 25.0347L11.1883 35.8333H15.2337L22.5257 27.5L28.899 35.8333H37.035L26.643 22.0947L35.4763 12H31.4337ZM30.015 33.4133L15.3897 14.292H17.7937L32.255 33.412L30.015 33.4133Z" fill="#fff"/>
                        </svg>
                    </a>
                    <a class="rwd-share__icon" href="#" aria-label="Share on WhatsApp">
                        <svg width="44" height="44" viewBox="0 0 48 48" fill="none" aria-hidden="true">
                            <circle cx="24" cy="24" r="24" fill="#25CC64"/>
                            <path d="M24.14 7.27a16.75 16.75 0 0 1 16.86 16.74c0 9.22-7.56 16.73-16.87 16.73h-.01l-.57-.01a16.7 16.7 0 0 1-8.02-2.32l-.64-.38-.21-.12-.24.06-5.61 1.46 1.49-5.39.07-.26-.14-.22-.42-.66a16.7 16.7 0 0 1-2.58-8.9C7.27 14.78 14.83 7.27 24.14 7.27Z" stroke="#fff" stroke-width="1.2"/>
                            <path d="M16.7 14.62c.17 0 .35 0 .52.01l.48.01c.19.01.33.02.47.1.12.07.27.21.43.51l.07.14c.23.51.6 1.41.93 2.22.33.79.63 1.51.7 1.66.12.23.17.44.04.69-.14.27-.21.44-.34.62l-.15.2a7.6 7.6 0 0 1-.78.9c-.12.12-.3.3-.39.52-.08.22-.07.46.06.73l.06.11c.31.53 1.38 2.26 2.97 3.67 2.04 1.8 3.78 2.37 4.28 2.62.28.14.54.22.79.19.26-.03.47-.18.64-.38.3-.34 1.32-1.53 1.68-2.07.15-.22.27-.27.36-.28.13-.02.28.03.53.12l1.75.8c.77.37 1.55.75 1.81.88.28.14.48.23.64.32.16.09.23.15.26.2v.01c0 .01.01.02.01.04.01.04.02.09.02.16.01.13.01.3-.01.51a5.4 5.4 0 0 1-.28 1.33l-.07.22c-.19.53-.77 1.09-1.47 1.54-.7.45-1.43.74-1.86.78h-.01c-.5.04-.93.15-1.79.03-.87-.12-2.19-.46-4.4-1.32-4.6-1.8-7.72-6.12-8.61-7.42l-.25-.36c-.13-.17-.65-.86-1.15-1.83-.49-.97-.94-2.18-.94-3.41 0-2.46 1.29-3.65 1.77-4.17.43-.46.93-.57 1.22-.57Z" fill="#fff"/>
                        </svg>
                    </a>
                    <a class="rwd-share__icon" href="#" aria-label="Share on Telegram">
                        <svg width="44" height="44" viewBox="0 0 48 48" fill="none" aria-hidden="true">
                            <circle cx="24" cy="24" r="24" fill="#2AABEE"/>
                            <path d="M10.86 23.75c7-3.05 11.66-5.06 14-6.03 6.67-2.77 8.05-3.25 8.95-3.27.2 0 .64.05.93.28.24.2.31.46.34.65.03.19.07.61.04.94-.36 3.8-1.92 13.01-2.72 17.26-.33 1.8-1 2.4-1.64 2.46-1.39.13-2.45-.92-3.8-1.8-2.11-1.39-3.3-2.25-5.36-3.6-2.37-1.56-.83-2.42.52-3.82.35-.37 6.5-5.95 6.61-6.46.02-.06.03-.3-.11-.42-.14-.13-.35-.08-.5-.05-.21.05-3.58 2.28-10.12 6.69-.96.66-1.82.98-2.6.96-.86-.02-2.51-.48-3.73-.88-1.5-.49-2.7-.75-2.59-1.58.05-.43.65-.87 1.78-1.33Z" fill="#fff"/>
                        </svg>
                    </a>
                    <a class="rwd-share__icon" href="#" aria-label="Share on LinkedIn">
                        <svg width="44" height="44" viewBox="0 0 48 48" fill="none" aria-hidden="true">
                            <circle cx="24" cy="24" r="24" fill="#2667B4"/>
                            <path d="M17.33 14.67a2.67 2.67 0 1 1-5.33-.01 2.67 2.67 0 0 1 5.33.01ZM17.41 19.31H12.08V36h5.33V19.31ZM25.84 19.31h-5.31V36h5.25v-8.76c0-4.88 6.36-5.33 6.36 0V36H37.41V25.43c0-8.23-9.41-7.92-11.63-3.88l.06-2.24Z" fill="#fff"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="rwd-steps" aria-label="How referrals work">
        <div class="rwd-step">
            <div class="rwd-step__visual rwd-step__visual--pink">
                <svg class="rwd-step__icon" width="88" height="80" viewBox="0 0 109 100" fill="none" aria-hidden="true">
                    <path d="M2.87 50.69A9.78 9.78 0 0 1 9.78 47.83h45.65a9.78 9.78 0 0 1 6.92 2.86L55.75 60.87C48.55 70.32 65.22 82.61 32.61 82.61S0 59.78 0 59.78v-2.17a9.78 9.78 0 0 1 2.87-6.92Z" fill="#3B3731"/>
                    <path d="M93.48 23.91a15.22 15.22 0 1 1-30.44 0 15.22 15.22 0 0 1 30.44 0Z" fill="#3B3731"/>
                    <path d="M32.61 39.13a19.57 19.57 0 1 0 0-39.13 19.57 19.57 0 0 0 0 39.13Z" fill="#3B3731"/>
                    <path d="M77.08 43.68a28.3 28.3 0 0 1 30.63 35.49l-.16.56a28.3 28.3 0 0 1-27.1 20.27 28.3 28.3 0 0 1-13.69-3.53l-11.81 3.43a2.17 2.17 0 0 1-2.71-2.57l3.47-11.8a28.3 28.3 0 0 1 21.37-41.85Zm15.18 8.02a21.74 21.74 0 1 0-21.87 36.52l1.82 1.01-8.86 2.57 2.59-8.85 1.01-1.82a21.74 21.74 0 0 0 25.31-29.43Z" fill="#3B3731"/>
                    <path d="M69.58 65.22h21.74a2.17 2.17 0 1 1 0 4.35H69.58a2.17 2.17 0 1 1 0-4.35ZM69.58 73.91h10.87a2.17 2.17 0 1 1 0 4.35H69.58a2.17 2.17 0 1 1 0-4.35Z" fill="#3B3731"/>
                </svg>
            </div>
            <div class="rwd-step__text">
                <span class="rwd-step__num">1</span>
                <p>Share your referral link</p>
            </div>
        </div>

        <div class="rwd-steps__connector rwd-steps__connector--down" aria-hidden="true">
            <svg width="123" height="20" viewBox="0 0 123 20" fill="none">
                <path d="M0.57 0.84C19.92 14.22 71.3 32.95 122.02 0.84" stroke="#3B3731" stroke-width="2" stroke-dasharray="10 10"/>
            </svg>
        </div>

        <div class="rwd-step">
            <div class="rwd-step__visual rwd-step__visual--blue">
                <svg class="rwd-step__icon" width="86" height="80" viewBox="0 0 106 100" fill="none" aria-hidden="true">
                    <path d="M31.8 0a19.7 19.7 0 1 0 0 39.4 19.7 19.7 0 0 0 0-39.4Zm0 6.06a13.64 13.64 0 1 1 0 27.27 13.64 13.64 0 0 1 0-27.27ZM12.11 45.45h39.37a12.1 12.1 0 0 1 6.02 1.6 36.4 36.4 0 0 0-4.59 4.63H12.11a6.06 6.06 0 0 0-6.05 6.06v.51l.04.5a18.2 18.2 0 0 0 3.03 12.1C12.18 76.24 18.36 81.82 31.8 81.82c5.78 0 10.22-.88 13.64-2.22.05 2.12.3 4.18.73 6.18A42.4 42.4 0 0 1 31.8 87.88C16.58 87.88 8.38 82.3 4.13 76.16A24.3 24.3 0 0 1 0 57.58v-.01a18.2 18.2 0 0 1 12.11-12.12ZM78.74 9.09a15.15 15.15 0 1 0 0 30.3 15.15 15.15 0 0 0 0-30.3Zm0 6.06a9.09 9.09 0 1 1 0 18.18 9.09 9.09 0 0 1 0-18.18ZM78.74 45.45a27.27 27.27 0 1 0 0 54.55 27.27 27.27 0 0 0 0-54.55Zm0 12.13v9.09h9.09a3.03 3.03 0 1 1 0 6.06h-9.09v9.09a3.03 3.03 0 1 1-6.06 0v-9.09h-9.09a3.03 3.03 0 1 1 0-6.06h9.09v-9.09a3.03 3.03 0 1 1 6.06 0Z" fill="#3B3731"/>
                </svg>
            </div>
            <div class="rwd-step__text">
                <span class="rwd-step__num">2</span>
                <p>Your friend signs up and books</p>
            </div>
        </div>

        <div class="rwd-steps__connector rwd-steps__connector--up" aria-hidden="true">
            <svg width="121" height="20" viewBox="0 0 121 20" fill="none">
                <path d="M0.57 18.73C19.64 5.35 70.27-13.38 120.25 18.73" stroke="#3B3731" stroke-width="2" stroke-dasharray="10 10"/>
            </svg>
        </div>

        <div class="rwd-step">
            <div class="rwd-step__visual rwd-step__visual--green">
                <svg class="rwd-step__icon" width="86" height="80" viewBox="0 0 106 99" fill="none" aria-hidden="true">
                    <path d="M2.87 50.69A9.78 9.78 0 0 1 9.78 47.83h45.65a9.78 9.78 0 0 1 6.92 2.86L55.75 60.87C48.55 70.32 65.22 82.61 32.61 82.61S0 59.78 0 59.78v-2.17a9.78 9.78 0 0 1 2.87-6.92Z" fill="#3B3731"/>
                    <path d="M93.48 23.91a15.22 15.22 0 1 1-30.44 0 15.22 15.22 0 0 1 30.44 0Z" fill="#3B3731"/>
                    <path d="M32.61 39.13a19.57 19.57 0 1 0 0-39.13 19.57 19.57 0 0 0 0 39.13Z" fill="#3B3731"/>
                    <path d="M79 45c14.91 0 27 12.09 27 27s-12.09 27-27 27v-5.19a21.81 21.81 0 1 0 0-43.62V45Zm-2.32 13.57 1.94 6.47h6.38l-5.25 4.14 1.98 6.62-5.05-3.98-5.05 3.98 1.98-6.62-5.25-4.14h6.38l1.94-6.47Z" fill="#3B3731"/>
                </svg>
            </div>
            <div class="rwd-step__text">
                <span class="rwd-step__num">3</span>
                <p>You both earn rewards</p>
            </div>
        </div>
    </div>
</div>
