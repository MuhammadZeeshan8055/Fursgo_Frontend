<!-- Booking Space -->

<?php include '../function_helper.php';
include_once __DIR__ . '/../components/birthday-calendar.php';
$imagePath = BASE_URL . '/assets/images/booking-space-card-image.svg';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FursGo - Booking</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/responsive.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/bootstrap.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/media_query.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/common.css">
    <style>
        body {
            background: #FDFCF8;
        }

        /* ── STEPPER ── */
        .step-indicator {
            width: 100%;
            max-width: 250px;
        }

        .steps-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 12px;
        }

        .step-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            flex: 1;
            position: relative;
        }

        .step-circle {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 10px;
            position: relative;
            z-index: 2;
            color: #FDFCF8;
            text-align: center;
            font-family: Lato;
            font-size: 14px;
            font-style: normal;
            font-weight: 600;
            line-height: normal;
        }

        .step-item.active .step-circle {
            background-color: #C9DDA0;
        }

        .step-item.inactive .step-circle {
            background-color: #e8e8e8;
        }

        .step-label {
            text-align: center;
            font-family: Lato;
            font-size: 14px;
            font-style: normal;
            font-weight: 600;
            line-height: normal;
        }

        .step-item.active .step-label {
            color: #C9DDA0;
        }

        .step-item.inactive .step-label {
            color: #d0d0d0;
        }

        .progress-bar {
            width: 100%;
            height: 8px;
            background-color: #e8e8e8;
            border-radius: 4px;
            overflow: hidden;
            position: relative;
        }

        .progress-fill {
            height: 100%;
            background-color: #C9DDA0;
            border-radius: 4px;
            transition: width 0.3s ease;
        }

        @keyframes pulse {

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }
        }

        .step-item.active .step-circle {
            animation: pulse 2s infinite;
        }

        .step-one h1 {
            color: #3B3731;
            font-family: "Playfair Display";
            font-size: 28px;
            font-style: normal;
            font-weight: 800;
            line-height: normal;
        }

        .card {
            margin-top: 2rem;
            border-radius: 10px;
            background: #F8F8F8;
            padding: 30px;
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .card>div {
            display: flex;
            justify-content: space-between;
        }


        .card>div>.card-img {
            display: flex;
            align-items: end;
            gap: 1.5rem;
            position: relative;
        }

        .card>div>.card-img>svg>image {
            width: 100%;
            height: 100%;
        }

        .card>div>.card-img>.svg-icon {
            position: absolute;
            left: 3px;
            top: 3px;
        }

        .card-img>:nth-child(3) p {
            display: flex;
            gap: 5px;
            color: #3B3731;
            font-family: Lato;
            font-size: 14px;
            font-style: normal;
            font-weight: 600;
            line-height: normal;
        }

        .card-img-content p>span {
            color: #9D9B98;
            font-family: Lato;
            font-size: 14px;
            font-style: normal;
            font-weight: 400;
            line-height: normal;
        }

        .card-img-content>div:nth-child(1) {
            margin-bottom: 2rem;
        }

        .card-img-content>div:nth-child(2)>p {
            color: #FFF;
            text-align: center;
            font-family: Lato;
            font-size: 14px;
            font-style: normal;
            font-weight: 500;
            line-height: normal;
            width: 107px;
            height: 24px;
            border-radius: 100px;
            background: #FFA899;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .ratings {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .ratings>div {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.8rem;
        }

        .ratings>div>div {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
        }

        .ratings>div:first-child>div:nth-child(1) {
            width: 82px;
            height: 24px;
            border-radius: 100px;
            background: #CBDCE8;
            color: #FFF;
            font-family: Lato;
            font-size: 14px;
            font-style: normal;
            font-weight: 500;
            line-height: normal;
        }

        .ratings>div:first-child>div:nth-child(2) {
            width: 93px;
            height: 24px;
            color: #FFF;
            font-family: Lato;
            font-size: 14px;
            font-style: normal;
            font-weight: 500;
            line-height: normal;
            border-radius: 100px;
            background: #FFA899;
        }

        .ratings>div:last-child>div>p {
            color: #3B3731;
            font-family: Lato;
            font-size: 14px;
            font-style: normal;
            font-weight: 500;
            line-height: normal;
        }

        .ratings>div:last-child>div>span {
            color: #9D9B98;
            font-family: Lato;
            font-size: 14px;
            font-style: normal;
            font-weight: 500;
            line-height: normal;
        }

        .card-booking-info>div:first-child {
            display: flex;
            gap: 3.5rem;
            justify-content: start;
            align-items: center;
        }

        .card-booking-info>div:first-child>div>span {
            display: flex;
            gap: 0.5rem;
            justify-content: start;
            align-items: center;
            color: #9D9B98;
            font-family: Lato;
            font-size: 14px;
            font-style: normal;
            font-weight: 600;
            line-height: normal;
        }

        .card-booking-info>div:first-child>div>p {
            color: #3B3731;
            font-family: Lato;
            font-size: 14px;
            font-style: normal;
            font-weight: 400;
            line-height: normal;
        }



        .card-booking-info>div:last-child>button {
            background: transparent;
            border: none;
            width: 67px;
            height: 32px;
            border-radius: 100px;
            background: #EAE8E5;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            color: #3B3731;
            text-align: center;
            font-family: Lato;
            font-size: 14px;
            font-style: normal;
            font-weight: 500;
            line-height: normal;
        }

        .information {
            margin-top: 2rem;
        }

        .information>h2 {
            color: #3B3731;
            font-family: "Playfair Display";
            font-size: 28px;
            font-style: normal;
            font-weight: 800;
            line-height: normal;
        }

        .information>.btns {
            display: flex;
            gap: 1rem;
            justify-content: center;
            align-items: center;
            margin-top: 1rem;
        }

        .information>.btns>button:nth-child(1) {
            background: transparent;
            border: none;
            border-radius: 75px;
            background: #FFC97A;
            width: 400px;
            height: 48px;
            color: #FFF;
            text-align: center;
            font-family: Lato;
            font-size: 18px;
            font-style: normal;
            font-weight: 700;
            line-height: normal;
            cursor: pointer;
        }

        .information>.btns>button:nth-child(2) {
            border-radius: 75px;
            border: 1px solid #3B3731;
            background: #FFF;
            width: 400px;
            height: 48px;
            color: #3B3731;
            text-align: center;
            font-family: Lato;
            font-size: 18px;
            font-style: normal;
            font-weight: 600;
            line-height: normal;
            cursor: pointer;
        }

        /* ── ADD-ONS ── */
        .add-ons {
            margin-top: 3rem;
            margin-bottom: 2rem;
        }

        .add-ons-title {
            color: #3B3731;
            font-family: "Playfair Display";
            font-size: 28px;
            font-style: normal;
            font-weight: 800;
            line-height: normal;
            margin-bottom: 1.5rem;
        }

        .add-ons-list {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
        }

        .add-on-card {
            position: relative;
            cursor: pointer;
            flex: 1;
            min-width: 200px;
            border-radius: 8px;
            background: #F8F8F8;
            padding: 25px 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            border: 1px solid transparent;
            transition: all 0.3s ease;
        }

        .add-on-checkbox {
            display: none;
        }

        .add-on-card.active {
            background: #FFF;
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.03);
            border: 1px solid #EAE8E5;
        }

        .add-on-content {
            display: flex;
            align-items: baseline;
            gap: 15px;
            width: 100%;
            justify-content: center;
        }

        .add-on-name {
            color: #3B3731;
            font-family: Lato;
            font-size: 18px;
            font-style: normal;
            font-weight: 500;
            line-height: normal;
        }

        .add-on-price-container {
            display: flex;
            align-items: baseline;
            gap: 4px;
        }

        .add-on-price {
            color: #3B3731;
            text-align: right;
            font-family: Lato;
            font-size: 20px;
            font-style: normal;
            font-weight: 600;
            line-height: 25px;
            /* 125% */
            text-decoration-line: underline;
            text-decoration-style: solid;
            text-decoration-skip-ink: auto;
            text-decoration-thickness: auto;
            text-underline-offset: auto;
            text-underline-position: from-font;
        }

        .add-on-unit {
            color: #9D9B98;
            font-family: Lato;
            font-size: 14px;
            font-style: normal;
            font-weight: 600;
            line-height: 25px;
        }

        .checkmark-icon {
            position: absolute;
            top: 10px;
            right: 10px;
            display: none;
            align-items: center;
            justify-content: center;
        }

        .add-on-card.active .checkmark-icon {
            display: flex;
        }

        .add-ons-actions {
            margin-top: 2.5rem;
            display: flex;
            justify-content: flex-end;
        }

        .continue-action-btn {
            background-color: #C9DDA0;
            color: #FFF;
            border: none;
            border-radius: 75px;
            width: 400px;
            height: 48px;
            text-align: center;
            font-family: Lato;
            font-size: 18px;
            font-style: normal;
            font-weight: 700;
            line-height: normal;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: opacity 0.3s;
        }

        .continue-action-btn:hover {
            opacity: 0.9;
        }


        /* ── Pet List Container ── */
        .pet-list {
            display: none;
            flex-direction: column;
            gap: 14px;
            margin-top: 1.5rem;
            animation: petListFadeIn 0.25s ease;
        }

        .pet-list.visible {
            display: flex;
        }

        @keyframes petListFadeIn {
            from {
                opacity: 0;
                transform: translateY(8px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* ── Pet Card ── */
        .pet-card {
            background: #F8F8F8;
            border-radius: 12px;
            padding: 20px 24px;
            display: flex;
            align-items: center;
            gap: 1rem;
            cursor: pointer;
            border: 1px solid transparent;
            transition: all 0.2s;
            position: relative;
        }

        .pet-card::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(248, 248, 248, 0.6);
            border-radius: 12px;
            opacity: 0.5;
            pointer-events: none;
            transition: opacity 0.2s;
        }

        .pet-card.selected::after {
            opacity: 0;
        }

        .pet-card:hover {
            box-shadow: 0 4px 14px rgba(59, 55, 49, 0.04);
        }

        .pet-card.selected {
            background: #F8F8F8;
        }

        /* ── Radio Dot ── */
        .pet-radio {
            width: 22px;
            height: 22px;
            border-radius: 50%;
            border: 1px solid #D0CEC9;
            background: #fff;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: border-color 0.2s;
        }

        .pet-card.selected .pet-radio {
            border-color: #FFC97A;
        }

        .pet-radio-inner {
            width: 14px;
            height: 14px;
            border-radius: 50%;
            background: #FFC97A;
            opacity: 0;
            transition: opacity 0.2s;
        }

        .pet-card.selected .pet-radio-inner {
            opacity: 1;
        }

        /* ── Avatar ── */
        .pet-avatar {
            width: 76px;
            height: 76px;
            border-radius: 50%;
            overflow: hidden;
            flex-shrink: 0;
            background: #EAE8E5;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 26px;
        }

        .pet-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* ── Info Grid ── */
        .pet-info-grid {
            flex: 1;
            display: grid;
            grid-template-columns: 2fr 1fr 0.8fr 2fr;
            align-items: center;
            gap: 20px;
        }

        .pet-field {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .pet-field-label {
            display: flex;
            align-items: center;
            gap: 6px;
            color: #9D9B98;
            font-family: Lato, sans-serif;
            font-size: 15px;
            font-weight: 500;
        }

        .pet-field-label svg {
            width: 15px;
            height: 15px;
        }

        .pet-field-value {
            color: #3B3731;
            font-family: Lato, sans-serif;
            font-size: 16px;
            font-weight: 500;
            margin: 0;
        }

        .pet-field.notes .pet-field-value {
            max-width: 200px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        /* ── Edit Button ── */
        .pet-edit-btn {
            visibility: hidden;
            opacity: 0;
            background: #EAE8E5;
            border: none;
            border-radius: 100px;
            padding: 7px 20px;
            color: #3B3731;
            font-family: Lato, sans-serif;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            white-space: nowrap;
            flex-shrink: 0;
            transition: background 0.2s, opacity 0.2s, visibility 0.2s;
        }

        .pet-card.selected .pet-edit-btn {
            visibility: visible;
            opacity: 1;
        }

        .pet-edit-btn:hover {
            background: #d6d3cf;
        }

        /* ── Confirm Row ── */
        .pet-list-actions {
            display: flex;
            justify-content: flex-end;
            margin-top: 8px;
            gap: 2rem;
        }

        .pet-save-btn {
            width: 120px;
            height: 48px;
            border-radius: 96px;
            border: 1px solid #FFC97A;
            background: #FFF;
            box-shadow: 0 5px 8px 0 rgba(0, 0, 0, 0.05);

            color: #FFC97A;
            text-align: center;
            font-family: Lato;
            font-size: 16px;
            font-style: normal;
            font-weight: 600;
            line-height: normal;
            transition: opacity 0.2s;
            cursor: pointer;
        }

        .pet-save-btn:disabled {
            opacity: 0.4;
            cursor: not-allowed;
        }

        .pet-save-btn:not(:disabled):hover {
            opacity: 0.88;
        }

        pet-save-btn:not(:disabled):hover {
            opacity: 0.88;
        }

        .pet-cancel-btn {
            color: #3B3731;
            text-align: center;
            font-family: Lato;
            font-size: 16px;
            font-style: normal;
            font-weight: 600;
            line-height: normal;
            text-decoration-line: underline;
            text-decoration-style: solid;
            text-decoration-skip-ink: auto;
            text-decoration-thickness: auto;
            text-underline-offset: auto;
            text-underline-position: from-font;
            background: transparent;
            border: none;
            cursor: pointer;
        }

        /* Pet Details Display Styles */
        .pet-details-display {
            display: none;
            margin-top: 30px;
            padding: 30px;
            border-radius: 10px;
            border-radius: 10px;
            background: #F8F8F8;
            border: none;
        }

        .pet-details-display.active {
            display: flex;
            align-items: center;
            justify-content: space-between
        }

        .pet-details-display h2 {
            color: #3B3731;
            font-family: "Playfair Display";
            font-size: 24px;
            font-weight: 800;
            margin-bottom: 20px;
        }

        .pet-details-display-content {
            display: flex;
            gap: 4rem;
        }

        .pet-detail-item {
            display: flex;
            flex-direction: column;
        }

        .pet-detail-item label {
            display: flex;
            align-items: center;
            color: #9D9B98;
            font-family: Lato;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 8px;
            gap: 5px
        }

        .pet-detail-item span {
            color: #3B3731;
            font-family: Lato;
            font-size: 16px;
            font-weight: 400;
        }

        .pet-detail-item.full-width {
            grid-column: span 2;
        }

        .pet-display-action-btns {
            display: flex;
            gap: 15px;
            margin-top: 20px;
            justify-content: flex-end;
        }

        .pet-display-action-btns button {
            width: 67px;
            height: 32px;
            border-radius: 100px;
            background: #EAE8E5;
            border: none;
            cursor: pointer;
            color: #3B3731;
            text-align: center;
            font-family: Lato;
            font-size: 14px;
            font-style: normal;
            font-weight: 500;
            line-height: normal;
        }


        .pet-details-form.hidden {
            display: none;
        }

        .pet-photo-preview {
            position: relative;
            width: 85px;
            height: 85px;
            border-radius: 50%;
            overflow: hidden;
            flex-shrink: 0;
        }

        .pet-photo-preview img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .pet-photo-col-wrapper {
            display: flex;
            align-items: center;
            gap: 20px;
            width: 100%;
            margin-bottom: 20px;
        }

        .pet-photo-action-btns {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex: 1;
        }

        .pet-photo-edit-btn {
            background-color: transparent;
            color: #3B3731;
            border: 1px solid #D4D4D4;
            height: 48px;
            padding: 0 20px;
            border-radius: 96px;
            cursor: pointer;
            font-family: Lato;
            font-size: 14px;
            font-weight: 600;
            white-space: nowrap;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .pet-photo-save-btn {
            background-color: transparent;
            border: 1px solid #FFC97A;
            color: #FFC97A;
            height: 48px;
            padding: 0 20px;
            border-radius: 96px;
            cursor: pointer;
            font-family: Lato;
            font-size: 14px;
            font-weight: 600;
            white-space: nowrap;
        }

        .pet-photo-edit-btn,
        .pet-photo-save-btn {
            padding: 10px 15px;
            border: none;
            border-radius: 96px;
            cursor: pointer;
            font-family: Lato;
            font-size: 14px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .pet-photo-edit-btn {
            background-color: transparent;
            color: #3B3731;
            border: 1px solid #D4D4D4;
            width: 139px;
            height: 48px;

        }

        .pet-photo-edit-btn:hover {
            background-color: #E8E7E6;
            border-color: #C0BFBE;
        }

        .pet-photo-save-btn {
            background-color: transparent;
            border: 1px solid #FFC97A;
            color: #FFC97A;
            width: 120px;
            height: 48px;
        }

        .pet-photo-save-btn:hover {
            background-color: #FFB85C;
            color: #FFF;
        }

        .dot {
            width: 6px;
            height: 6px;
            background-color: #3B3731;
            border-radius: 50%;
            display: inline-block;
            margin: 0 4px;
        }

        .confirm-pay {
            max-width: 100%;
            margin: 0 auto;
        }

        .confirm-pay form {
            width: 100%;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 18px 24px;
            align-items: start;
        }

        .full-row {
            grid-column: 1 / -1;
        }


        .form-grid>div>label {
            color: #3B3731;
            font-family: Lato;
            font-size: 16px;
            font-style: normal;
            font-weight: 600;
            line-height: normal;
        }

        .form-grid>div>label>span {
            color: #9D9B98;
            font-family: Lato;
            font-size: 16px;
            font-style: normal;
            font-weight: 600;
            line-height: normal;
        }

        .input-wrap {
            position: relative;
            margin: 8px 0;
        }

        .input-wrap>input,
        .input-wrap>select {
            border-radius: 10px !important;
            border: 1px solid #D4D4D4 !important;
            background: #FFF !important;
        }

        .input-wrap input[type="text"],
        .input-wrap input[type="tel"],
        .input-wrap input[type="email"],
        .input-wrap select,
        .input-wrap textarea {
            width: 100%;
            box-sizing: border-box;
            padding: 12px 44px 12px 14px;
            border-radius: 8px;
            border: 1px solid #eee6dd;
            background: #FFF;
            font-size: 14px;
            outline: none;
            transition: border-color .15s, box-shadow .12s;
        }

        .input-wrap select {
            -webkit-appearance: none;
            appearance: none;
            padding-right: 44px;
            background-image: none;
            cursor: pointer;
        }

        .input-wrap.select-wrap {
            position: relative;
        }


        .input-wrap.select-wrap.open::after {
            transform: translateY(-50%) rotate(180deg);
        }



        .input-wrap select {
            -webkit-appearance: none;
            appearance: none;
            padding-right: 44px;
            background-color: #FFF;
            background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="15" height="8" viewBox="0 0 15 8" fill="none"><path d="M13.5105 0.5L6.95017 7.06033L0.499971 0.610127" stroke="%233B3731" stroke-linecap="round" stroke-linejoin="round"/></svg>');
            background-repeat: no-repeat;
            background-position: right 14px center;
            background-size: 15px 8px;
            cursor: pointer;
        }

        .input-wrap textarea {
            min-height: 38px;
            resize: vertical;
        }

        .input-wrap input:focus,
        .input-wrap select:focus,
        .input-wrap textarea:focus {
            border-color: #e6dccd;
            box-shadow: 0 0 0 3px rgba(201, 221, 160, 0.12);
        }




        /* window.__autogenerated_css_start__ */
        .pet-details-form {
            margin-top: 30px;
        }

        .pet-details-form>div>h2 {
            color: #3B3731;
            font-family: "Playfair Display";
            font-size: 28px;
            font-style: normal;
            font-weight: 800;
            line-height: normal;
        }

        .pet-details-form>div:nth-child(2) {
            margin-top: 25px;
            display: flex;
            align-items: center;
            justify-content: start;
            gap: 40px;
        }

        .pet-details-form>div>button {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 0.5rem;
            width: 189px;
            height: 48px;
            border-radius: 96px;
            border: 1px solid #3B3731;
            background: transparent;
            cursor: pointer;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
            margin-top: 2rem;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            position: relative;
            /* ADDED: for pseudo icon and opener button */
        }

        .form-group .input-check-icon {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            pointer-events: none;
            display: none;
            line-height: 0;
            z-index: 5;
        }

        .form-group .input-check-icon.visible {
            display: block;
        }

        .form-group label {
            margin-bottom: 15px;
            color: #3B3731;
            font-family: Lato;
            font-size: 16px;
            font-style: normal;
            font-weight: 600;
            line-height: normal;
        }

        .form-group label>span {
            color: #9D9B98;
            font-family: Lato;
            font-size: 16px;
            font-style: normal;
            font-weight: 600;
            line-height: normal;
        }

        .form-group input,
        .form-group select,
        .form-group option {
            padding: 8px 10px;
            font-size: 14px;
            border-radius: 10px;
            border: 1px solid #D4D4D4;
            background: #FFF;
            color: #3B3731;
            font-family: Lato;
            font-size: 16px;
            font-style: normal;
            font-weight: 400;
            line-height: normal;
            height: 48px;
        }

        .form-group select {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            padding-right: 40px;
            background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="15" height="8" viewBox="0 0 15 8" fill="none"><path d="M13.5105 0.5L6.95017 7.06033L0.499971 0.610127" stroke="%233B3731" stroke-linecap="round" stroke-linejoin="round"/></svg>') !important;
            background-repeat: no-repeat !important;
            background-position: right 14px center;
            background-size: 15px 8px;
            cursor: pointer;
        }

        .form-group input[type="number"] {
            width: 85px;
            height: 48px;
        }

        .form-group textarea {
            padding: 8px 10px;
            border-radius: 10px;
            border: 1px solid #D4D4D4;
            background: #FFF;
            color: #D4D4D4;
            font-family: Lato;
            font-size: 16px;
            font-style: normal;
            font-weight: 400;
            line-height: normal;
        }

        /* REPLACE the entire rule for the date input with this */
        .form-group input[type="date"] {
            -webkit-appearance: none;
            -moz-appearance: textfield;
            appearance: none;

            padding: 8px 44px 8px 10px;
            cursor: pointer;
            font-size: 16px;
            border-radius: 10px 10px 0 0;
            border: 1px solid #D4D4D4;

            /* keep color separate so it doesn't override background-image */
            background-color: #FFF;
            color: #3B3731;

            /* SVG arrow (note: # must be encoded as %23) */
            background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="15" height="8" viewBox="0 0 15 8" fill="none"><path d="M13.5105 0.5L6.95017 7.06033L0.499971 0.610127" stroke="%233B3731" stroke-linecap="round" stroke-linejoin="round"/></svg>');
            background-repeat: no-repeat;
            background-position: right 14px center;
            /* 14px from right + vertically centered */
            background-size: 15px 8px;

            height: 48px;
            box-sizing: border-box;
            outline: none;
        }

        /* Hide native calendar picker in WebKit (Chrome/Safari) */
        .form-group input[type="date"]::-webkit-calendar-picker-indicator {
            display: none;
        }

        /* hide inner clear/spin controls if present */
        .form-group input[type="date"]::-webkit-clear-button,
        .form-group input[type="date"]::-webkit-inner-spin-button {
            display: none;
        }

        /* Firefox tweaks */
        .form-group input[type="date"]::-moz-focus-inner {
            border: 0;
        }

        /* Pet Type Auto-Detection Suggestions */
        #petTypeSuggestions {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        #petTypeSuggestions>div:last-child {
            border-bottom: none;
        }

        /* clickable (transparent) button that forwards to the input picker */
        .form-group .picker-opener {
            position: absolute;
            right: 6px;
            top: 50%;
            transform: translateY(-50%);
            width: 34px;
            height: 34px;
            border: 0;
            background: transparent;
            cursor: pointer;
            padding: 0;
            margin: 0;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        /* sex small circular radios (matches the screenshot) */
        .sex-options {
            display: flex;
            gap: 28px;
            height: 100%;
            align-items: center;
            margin-top: 1.3rem;
        }

        /* label that wraps each radio */
        .radio--small {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            /* gap between circle and text */
            cursor: pointer;
            user-select: none;
            position: relative;
        }

        /* keep native input for accessibility but hide native radio */
        .radio--small input[type="radio"] {
            position: absolute;
            opacity: 0;
            width: 1px;
            height: 1px;
            margin: 0;
            pointer-events: none;
        }

        /* the visible circle */
        .radio--visual {
            width: 22px;
            height: 22px;
            border-radius: 50%;
            border: 2px solid #ccc;
            box-sizing: border-box;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: #fff;
            transition: border-color 0.15s;
            flex: 0 0 auto;
            position: relative;
        }

        /* inner dot for checked state */
        .radio--visual::after {
            content: "";
            position: absolute;
            left: 50%;
            top: 50%;
            width: 0.9rem;
            height: 0.9rem;
            transform: translate(-50%, -50%) scale(0);
            border-radius: 50%;
            background: #FFD88C;
            transition: transform 0.18s cubic-bezier(0.34, 1.56, 0.64, 1);
            pointer-events: none;
        }

        /* checked styles */
        .radio--small input[type="radio"]:checked+.radio--visual {
            border-color: #FFD88C;
        }

        .radio--small input[type="radio"]:checked+.radio--visual::after {
            transform: translate(-50%, -50%) scale(1);
        }

        /* label text styling */
        .radio--text {
            color: #9D9B98;
            font-family: Lato;
            font-size: 16px;
            font-style: normal;
            font-weight: 400;
            line-height: normal;
        }



        .radio--small input[type="radio"]:checked+.radio--visual::after {
            transform: translate(-50%, -50%) scale(1);
        }

        /* focus-visible for keyboard users */
        .radio--small input[type="radio"]:focus+.radio--visual {
            outline: 3px solid rgba(201, 221, 160, 0.22);
            outline-offset: 2px;
        }




        .full-width {
            grid-column: span 3;
        }

        /* placeholder color for inputs & textareas (cross-browser) */
        .form-group input::placeholder,
        .form-group textarea::placeholder {
            color: #D4D4D4;
            opacity: 1;
            /* ensure consistent opacity across browsers */
        }

        /* WebKit/Blink */
        .form-group input::-webkit-input-placeholder,
        .form-group textarea::-webkit-input-placeholder {
            color: #D4D4D4;
        }

        /* Mozilla Firefox 19+ */
        .form-group input::-moz-placeholder,
        .form-group textarea::-moz-placeholder {
            color: #D4D4D4;
        }

        /* Mozilla Firefox 4 - 18 */
        .form-group input:-moz-placeholder,
        .form-group textarea:-moz-placeholder {
            color: #D4D4D4;
        }

        /* Internet Explorer 10+ */
        .form-group input:-ms-input-placeholder,
        .form-group textarea:-ms-input-placeholder {
            color: #D4D4D4;
        }

        /* Select "placeholder" (first disabled option) — note: styling options is inconsistent across browsers */
        .form-group select option[disabled][selected] {
            color: #D4D4D4;
        }

        .form-btns {
            display: flex;
            justify-content: flex-end;
            margin-top: 2rem;
        }

        .form-btns div {
            display: flex;
            justify-content: flex-end;
            gap: 30px;

        }

        .form-btns div>button:first-child {
            color: #3B3731;
            text-align: center;
            font-family: Lato;
            font-size: 16px;
            font-style: normal;
            font-weight: 600;
            line-height: normal;
            text-decoration-line: underline;
            text-decoration-style: solid;
            text-decoration-skip-ink: auto;
            text-decoration-thickness: auto;
            text-underline-offset: auto;
            text-underline-position: from-font;
            background: transparent;
            border: none;
            cursor: pointer;
        }

        .form-btns div>button:last-child {
            border-radius: 96px;
            border: 1px solid #FFC97A;
            background: #FFF;
            box-shadow: 0 5px 8px 0 rgba(0, 0, 0, 0.05);
            width: 120px;
            height: 48px;
            cursor: pointer;
            color: #FFC97A;
            text-align: center;
            font-family: Lato;
            font-size: 16px;
            font-style: normal;
            font-weight: 600;
            line-height: normal;

        }

        /* window.__autogenerated_css_end__ */
    </style>
</head>

<body>
    <?php include '../components/header.php'; ?>

    <!-- STEPPER -->
    <section class="container">
        <div class="d-flex align-items-end justify-content-between">
            <!-- Back button -->
            <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 2rem;">
                <button
                    style="display: flex; align-items: center; gap: 8px; background: transparent; border: none; cursor: pointer; font-family: Lato; font-size: 16px; font-weight: 600; color: #3B3731; text-decoration: underline;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48" fill="none">
                        <rect width="48" height="48" rx="24" transform="matrix(-1 0 0 1 48 0)" fill="#EAE8E5" />
                        <path
                            d="M15.2902 23.1723C14.8946 23.5641 14.8952 24.2036 15.2915 24.5947L19.8487 29.0918C20.204 29.4424 20.7767 29.4378 21.1263 29.0815C21.2649 28.9448 21.3203 28.8081 21.2926 28.6714C21.2579 28.5347 21.1818 28.4049 21.064 28.2819L18.0826 25.3603C17.9164 25.1963 17.7606 25.0493 17.6152 24.9195C17.5 24.8167 17.5887 24.6111 17.7423 24.6266C17.9201 24.6446 18.1028 24.6603 18.2904 24.6735C18.6713 24.7008 19.066 24.7145 19.4746 24.7145H32.1645C32.6259 24.7145 33 24.3404 33 23.879C33 23.4176 32.6259 23.0435 32.1645 23.0435H19.4746C19.066 23.0435 18.6678 23.0572 18.28 23.0846C18.0952 23.0976 17.9151 23.1129 17.7398 23.1306C17.584 23.1463 17.496 22.9401 17.6152 22.8385C17.7606 22.7087 17.9164 22.5617 18.0826 22.3977L21.0848 19.4557C21.2095 19.3326 21.2856 19.2028 21.3133 19.0661C21.341 18.9294 21.2891 18.7928 21.1575 18.6561C20.8023 18.2942 20.2205 18.2901 19.8602 18.6469L15.2902 23.1723Z"
                            fill="#3B3731" />
                    </svg>
                </button>
            </div>
            <div class="steps-and-btn w-15">
                <div class="active-inactive-div d-flex align-items-center justify-content-center">
                    <div class="step-indicator">
                        <div class="steps-container">
                            <div class="step-item active">
                                <div class="step-circle">1</div>
                                <div class="step-label">Groomer Details</div>
                            </div>
                            <div class="step-item inactive">
                                <div class="step-circle">2</div>
                                <div class="step-label">Confirm & Pay</div>
                            </div>
                        </div>
                        <div class="progress-bar">
                            <div class="progress-fill" style="width: 50%;"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div>
            </div>
        </div>
    </section>
    <section class="container">
        <div class="row" style="margin-top: 4rem;">
            <div class="col-lg-8">
                <div class="step-one">
                    <h1>
                        Booking Details
                    </h1>
                    <div class="card">
                        <div>
                            <div class="card-img">
                                <div class="svg-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="21" height="22" viewBox="0 0 21 22"
                                        fill="none">
                                        <path
                                            d="M10.9482 0.125295C10.7667 0.043205 10.5723 0 10.3692 0C10.1662 0 9.97174 0.043205 9.79028 0.125295L1.65477 3.57738C0.704261 3.97918 -0.00430085 4.91673 1.96518e-05 6.0487C0.0216222 10.3346 1.78439 18.1764 9.22861 21.7408C9.95014 22.0864 10.7883 22.0864 11.5098 21.7408C18.9541 18.1764 20.7168 10.3346 20.7384 6.0487C20.7428 4.91673 20.0342 3.97918 19.0837 3.57738L10.9482 0.125295Z"
                                            fill="#CBDCE8" />
                                        <path
                                            d="M16 6L11.5556 10.7222L16 6ZM9.58111 10.4917C8.20333 11.0206 7.10167 10.93 6 10.4933C6.27778 14.0728 7.94667 15.4489 10.1717 16C10.1717 16 11.8478 14.8144 12.0894 12.0039C12.1156 11.6994 12.1283 11.5478 12.0656 11.3761C12.0022 11.2044 11.8778 11.0817 11.6294 10.8356C11.2206 10.4311 11.0167 10.2289 10.7739 10.1778C10.5311 10.1278 10.2144 10.2489 9.58111 10.4917Z"
                                            fill="#CBDCE8" />
                                        <path
                                            d="M16 6L11.5556 10.7222M9.58111 10.4917C8.20333 11.0206 7.10167 10.93 6 10.4933C6.27778 14.0728 7.94667 15.4489 10.1717 16C10.1717 16 11.8478 14.8144 12.0894 12.0039C12.1156 11.6994 12.1283 11.5478 12.0656 11.3761C12.0022 11.2044 11.8778 11.0817 11.6294 10.8356C11.2206 10.4311 11.0167 10.2289 10.7739 10.1778C10.5311 10.1278 10.2144 10.2489 9.58111 10.4917Z"
                                            stroke="white" stroke-linecap="round" stroke-linejoin="round" />
                                        <path
                                            d="M6.83325 13.4703C6.83325 13.4703 8.22214 13.7392 9.61103 12.667L6.83325 13.4703Z"
                                            fill="#CBDCE8" />
                                        <path d="M6.83325 13.4703C6.83325 13.4703 8.22214 13.7392 9.61103 12.667"
                                            stroke="white" stroke-linecap="round" stroke-linejoin="round" />
                                        <path
                                            d="M9.05564 8.36144C9.05564 8.54561 8.98247 8.72225 8.85224 8.85248C8.72201 8.98272 8.54537 9.05588 8.36119 9.05588C8.17701 9.05588 8.00038 8.98272 7.87015 8.85248C7.73991 8.72225 7.66675 8.54561 7.66675 8.36144C7.66675 8.17726 7.73991 8.00062 7.87015 7.87039C8.00038 7.74016 8.17701 7.66699 8.36119 7.66699C8.54537 7.66699 8.72201 7.74016 8.85224 7.87039C8.98247 8.00062 9.05564 8.17726 9.05564 8.36144Z"
                                            fill="#CBDCE8" stroke="white" />
                                        <path d="M10.4443 6.55554V6.6111V6.55554Z" fill="#CBDCE8" />
                                        <path d="M10.4443 6.55554V6.6111" stroke="white" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                </div>
                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        width="255" height="129" viewBox="0 0 255 129" fill="none">

                                        <path
                                            d="M255 124C255 126.761 252.761 129 250 129H5C2.23858 129 0 126.761 0 124V37C0 34.2386 2.23858 32 5 32H27C29.7614 32 32 29.7614 32 27V5C32 2.23858 34.2386 0 37 0H250C252.761 0 255 2.23858 255 5V124Z"
                                            fill="url(#pattern0)" />

                                        <defs>
                                            <pattern id="pattern0" patternContentUnits="objectBoundingBox" width="1"
                                                height="1">
                                                <use xlink:href="#image0" transform="scale(0.0039 0.0078)" />
                                            </pattern>

                                            <image id="image0" href="<?php echo htmlspecialchars($imagePath); ?>"
                                                width="255" height="129" preserveAspectRatio="xMidYMid slice" />
                                        </defs>

                                    </svg>
                                </div>
                                <div class="card-img-content">
                                    <div>
                                        <p>Furs & Co. Studio</p>
                                        <p>Hosted by<span> Dev É.</span></p>
                                    </div>
                                    <div>
                                        <p>Garden / Shed</p>
                                    </div>
                                </div>
                            </div>
                            <div class="ratings">
                                <div>
                                    <div>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="10" height="9" viewBox="0 0 10 9"
                                            fill="none">
                                            <path
                                                d="M2 8.99999C1.85833 8.99999 1.73967 8.95199 1.644 8.85599C1.54833 8.75999 1.50033 8.64133 1.5 8.49999C1.49967 8.35866 1.54767 8.23999 1.644 8.14399C1.74033 8.04799 1.859 7.99999 2 7.99999H8C8.14166 7.99999 8.2605 8.04799 8.3565 8.14399C8.4525 8.23999 8.50033 8.35866 8.5 8.49999C8.49966 8.64133 8.45166 8.76016 8.356 8.85649C8.26033 8.95283 8.14166 9.00066 8 8.99999H2ZM2.35 7.24999C2.10833 7.24999 1.89383 7.17083 1.7065 7.0125C1.51917 6.85416 1.4045 6.65416 1.3625 6.4125L0.862501 3.2375C0.845834 3.2375 0.827167 3.23967 0.806501 3.244C0.785834 3.24833 0.767001 3.25033 0.750001 3.25C0.541667 3.25 0.364668 3.17717 0.219001 3.0315C0.0733344 2.88583 0.000334469 2.70867 1.13636e-06 2.5C-0.000332197 2.29133 0.0726677 2.11433 0.219001 1.969C0.365334 1.82367 0.542334 1.75067 0.750001 1.75C0.957667 1.74933 1.13483 1.82233 1.2815 1.969C1.42817 2.11567 1.501 2.29267 1.5 2.5C1.5 2.55833 1.49367 2.6125 1.481 2.6625C1.46833 2.7125 1.45383 2.75833 1.4375 2.8L3 3.5L4.5625 1.3625C4.47083 1.29583 4.39583 1.20833 4.3375 1.1C4.27917 0.991667 4.25 0.875 4.25 0.75C4.25 0.541667 4.323 0.364501 4.469 0.218501C4.615 0.0725011 4.792 -0.000332194 5 1.13895e-06C5.208 0.000334472 5.38516 0.0733344 5.5315 0.219001C5.67783 0.364667 5.75066 0.541667 5.75 0.75C5.75 0.875 5.72083 0.991667 5.6625 1.1C5.60416 1.20833 5.52916 1.29583 5.4375 1.3625L7 3.5L8.5625 2.8C8.54583 2.75833 8.53116 2.7125 8.5185 2.6625C8.50583 2.6125 8.49966 2.55833 8.5 2.5C8.5 2.29167 8.573 2.1145 8.719 1.9685C8.865 1.8225 9.042 1.74967 9.25 1.75C9.458 1.75033 9.63516 1.82333 9.7815 1.969C9.92783 2.11467 10.0007 2.29167 10 2.5C9.99933 2.70833 9.92649 2.8855 9.7815 3.0315C9.6365 3.1775 9.45933 3.25033 9.25 3.25C9.23333 3.25 9.21466 3.248 9.194 3.244C9.17333 3.24 9.1545 3.23783 9.1375 3.2375L8.6375 6.4125C8.59583 6.65416 8.48133 6.85416 8.294 7.0125C8.10666 7.17083 7.892 7.24999 7.65 7.24999H2.35ZM2.35 6.25H7.65L7.975 4.1625L7.4 4.4125C7.18333 4.50416 6.9625 4.52083 6.7375 4.4625C6.5125 4.40416 6.32916 4.27916 6.1875 4.0875L5 2.45L3.8125 4.0875C3.67083 4.27916 3.4875 4.40416 3.2625 4.4625C3.0375 4.52083 2.81667 4.50416 2.6 4.4125L2.025 4.1625L2.35 6.25Z"
                                                fill="white" />
                                        </svg>
                                        <p>Popular</p>
                                    </div>
                                    <div>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="9" height="11" viewBox="0 0 9 11"
                                            fill="none">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M6.41298 7.89331C6.44191 7.34386 6.31555 6.79737 6.04836 6.31639C5.78117 5.83541 5.38396 5.43938 4.90218 5.17363C4.81663 5.12414 4.7152 5.1098 4.61928 5.13363C4.52336 5.15746 4.44044 5.2176 4.38799 5.30138L3.77528 6.28209L3.26554 5.66557C3.23754 5.63178 3.20283 5.60415 3.16362 5.58443C3.12441 5.56471 3.08154 5.55333 3.03771 5.551C2.99388 5.54867 2.95005 5.55545 2.90896 5.5709C2.86788 5.58635 2.83045 5.61015 2.79902 5.64078C2.49895 5.93115 2.26456 6.28243 2.11162 6.67097C1.95868 7.05952 1.89074 7.47631 1.91237 7.89331C1.91237 8.49004 2.14943 9.06234 2.57138 9.48429C2.99333 9.90624 3.56563 10.1433 4.16236 10.1433C4.75909 10.1433 5.33138 9.90624 5.75334 9.48429C6.17529 9.06234 6.41234 8.49004 6.41234 7.89331M3.01004 6.35519L2.97063 6.4073C2.67173 6.82484 2.52196 7.33078 2.54542 7.84374L2.54733 7.88124C2.54733 8.3094 2.71741 8.72003 3.02017 9.02279C3.32293 9.32554 3.73356 9.49563 4.16172 9.49563C4.58989 9.49563 5.00052 9.32554 5.30327 9.02279C5.60603 8.72003 5.77612 8.3094 5.77612 7.88124L5.77803 7.84437C5.78247 7.80306 5.88163 6.66662 4.8418 5.89375L4.79032 5.85625L4.12677 6.91768C4.09473 6.96887 4.05098 7.01172 3.99915 7.0427C3.94731 7.07368 3.88885 7.09191 3.82859 7.09588C3.76833 7.09985 3.70799 7.08946 3.65253 7.06555C3.59708 7.04164 3.54809 7.0049 3.50961 6.95836L3.01004 6.35519Z"
                                                fill="#FEFEFE" />
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M3.79701 0.30821C3.81025 0.23997 3.84191 0.176658 3.88858 0.125138C3.93524 0.0736173 3.99512 0.0358558 4.06172 0.0159479C4.12832 -0.00396001 4.1991 -0.00525449 4.26638 0.0122049C4.33367 0.0296642 4.39489 0.0652111 4.4434 0.114991C4.56671 0.240837 4.80378 0.489988 5.04467 0.777274C5.28111 1.05884 5.53916 1.39761 5.68788 1.69951C5.8328 1.99443 5.98661 2.37578 6.10801 2.69421L6.67305 1.75354C6.70456 1.701 6.74826 1.65683 6.80046 1.62476C6.85265 1.59269 6.91181 1.57367 6.97292 1.56931C7.03402 1.56494 7.09528 1.57536 7.1515 1.59969C7.20773 1.62401 7.25727 1.66152 7.29592 1.70905C8.09867 2.70057 8.49846 3.76263 8.6974 4.57365C8.79718 4.97979 8.8474 5.32491 8.87282 5.57025C8.88576 5.69278 8.89424 5.81574 8.89824 5.93889V5.97131C8.89824 8.4482 6.93364 10.4649 4.44785 10.4649C1.96206 10.4649 0 8.44756 0 5.97004C0 5.28805 0.322244 3.68192 1.27563 2.36498C1.31266 2.31422 1.36166 2.27341 1.41826 2.24615C1.47487 2.2189 1.53734 2.20605 1.60011 2.20876C1.66287 2.21146 1.724 2.22963 1.77806 2.26166C1.83211 2.29368 1.87741 2.33856 1.90994 2.39231L2.55507 3.46709C2.75083 3.16073 3.01269 2.73044 3.21163 2.3332C3.49765 1.76117 3.72455 0.682572 3.79701 0.308845M4.3201 0.912655C4.20506 1.42113 4.01501 2.14697 3.77985 2.61858C3.46714 3.24336 3.0165 3.9298 2.86142 4.16051C2.82554 4.21345 2.77693 4.25651 2.72005 4.28574C2.66317 4.31497 2.59986 4.32943 2.53593 4.32778C2.472 4.32614 2.40952 4.30844 2.35422 4.27632C2.29892 4.24421 2.25258 4.1987 2.21948 4.14399L1.57118 3.06476C0.87457 4.19166 0.635589 5.45839 0.635589 5.97131C0.635589 8.10561 2.32244 9.82806 4.44785 9.82806C6.57326 9.82806 8.26265 8.10561 8.26265 5.97131V5.95351L8.26011 5.88995C8.25568 5.80484 8.24911 5.71986 8.24041 5.63508C8.20712 5.3287 8.15362 5.02487 8.08024 4.72555C7.87826 3.89157 7.52027 3.10334 7.02516 2.40248L6.38068 3.47535C6.34338 3.53732 6.28925 3.58743 6.22459 3.61985C6.15993 3.65227 6.08739 3.66566 6.01542 3.65847C5.94344 3.65128 5.87499 3.6238 5.81802 3.57923C5.76105 3.53466 5.71791 3.47483 5.6936 3.40671C5.59064 3.11815 5.33831 2.42917 5.11713 1.98044C5.00463 1.751 4.78916 1.46117 4.55781 1.18596C4.4801 1.09353 4.40086 1.00242 4.3201 0.912655Z"
                                                fill="#FEFEFE" />
                                        </svg>
                                        <p>Top Rated</p>
                                    </div>
                                </div>
                                <div>
                                    <div>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="10" height="14"
                                            viewBox="0 0 10 14" fill="none">
                                            <path
                                                d="M5 6.65C4.5264 6.65 4.0722 6.46563 3.73731 6.13744C3.40242 5.80925 3.21429 5.36413 3.21429 4.9C3.21429 4.43587 3.40242 3.99075 3.73731 3.66256C4.0722 3.33437 4.5264 3.15 5 3.15C5.4736 3.15 5.9278 3.33437 6.26269 3.66256C6.59758 3.99075 6.78571 4.43587 6.78571 4.9C6.78571 5.12981 6.73953 5.35738 6.64979 5.5697C6.56004 5.78202 6.42851 5.97493 6.26269 6.13744C6.09687 6.29994 5.90002 6.42884 5.68336 6.51679C5.46671 6.60473 5.2345 6.65 5 6.65ZM5 0C3.67392 0 2.40215 0.516248 1.46447 1.43518C0.526784 2.3541 0 3.60044 0 4.9C0 8.575 5 14 5 14C5 14 10 8.575 10 4.9C10 3.60044 9.47322 2.3541 8.53553 1.43518C7.59785 0.516248 6.32608 0 5 0Z"
                                                fill="#FFC97A" />
                                        </svg>
                                        <p>2.5 mi</p>
                                    </div>
                                    <div>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                            viewBox="0 0 14 14" fill="none">
                                            <path
                                                d="M6.12956 0.660476C6.40354 -0.220161 7.59647 -0.220158 7.87045 0.660479L8.89548 3.95519C9.01801 4.34902 9.36942 4.61566 9.76593 4.61566H13.083C13.9696 4.61566 14.3383 5.80055 13.621 6.34481L10.9374 8.38106C10.6166 8.62446 10.4824 9.0559 10.6049 9.44973L11.63 12.7444C11.9039 13.6251 10.9388 14.3574 10.2215 13.8131L7.53797 11.7769C7.21719 11.5335 6.78282 11.5335 6.46204 11.7769L3.77846 13.8131C3.06117 14.3574 2.09607 13.6251 2.37005 12.7444L3.39508 9.44973C3.51761 9.0559 3.38338 8.62446 3.0626 8.38106L0.37903 6.34481C-0.338258 5.80055 0.0303816 4.61566 0.916998 4.61566H4.23408C4.63058 4.61566 4.98199 4.34902 5.10452 3.95519L6.12956 0.660476Z"
                                                fill="#FFC97A" />
                                        </svg>
                                        <p>4.3</p>
                                        <span>
                                            (20 reviews)
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-booking-info">
                            <div>
                                <div>
                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="13"
                                            viewBox="0 0 15 13" fill="none">
                                            <path
                                                d="M13.1094 12.1166V3.83417C13.1094 3.81429 13.1111 3.79482 13.1141 3.77576L10.8748 1.86616C10.3986 1.46067 10.0696 1.18119 9.79046 0.998982C9.52095 0.823101 9.33983 0.766834 9.16658 0.766834C8.99347 0.766835 8.81349 0.823306 8.54428 0.998982C8.26512 1.18121 7.93524 1.46044 7.45838 1.86616L5.21745 3.77576C5.22054 3.7949 5.22374 3.81422 5.22374 3.83417V12.1166C5.2234 12.3281 5.04341 12.5 4.82144 12.5C4.59961 12.4998 4.41948 12.328 4.41914 12.1166V4.45573L4.00427 4.81069C3.83864 4.95183 3.58349 4.93709 3.43539 4.77924C3.28788 4.62148 3.30169 4.3796 3.46682 4.23856L6.92094 1.29553H6.92251C7.38342 0.90337 7.75667 0.583679 8.08855 0.366942C8.43046 0.143752 8.76989 2.24995e-07 9.16658 0C9.56323 0 9.9026 0.143743 10.2446 0.366942C10.5767 0.583731 10.9515 0.903225 11.4122 1.29553L14.8663 4.23856C15.0315 4.3796 15.0453 4.62148 14.8978 4.77924C14.7497 4.93709 14.4945 4.95183 14.3289 4.81069L13.914 4.45573V12.1166C13.9137 12.328 13.7336 12.4998 13.5117 12.5C13.2898 12.5 13.1098 12.3281 13.1094 12.1166Z"
                                                fill="#9D9B98" />
                                            <path
                                                d="M1.82418 6.66737C1.82418 6.37816 1.74192 6.13002 1.62487 5.96249C1.50777 5.79507 1.37173 5.7247 1.25 5.7247C1.12833 5.7248 0.992145 5.79519 0.875132 5.96249C0.758177 6.13002 0.675818 6.37832 0.675818 6.66737C0.675926 6.95653 0.758033 7.20483 0.875132 7.37226C0.992124 7.53946 1.12837 7.60853 1.25 7.60863C1.37164 7.60863 1.50783 7.53939 1.62487 7.37226C1.74197 7.20483 1.82407 6.95653 1.82418 6.66737ZM2.5 6.66737C2.49989 7.09818 2.37897 7.50235 2.16605 7.80679C1.95294 8.11149 1.63215 8.33333 1.25 8.33333C0.868121 8.33323 0.548331 8.11124 0.335269 7.80679C0.12233 7.50234 0.000106589 7.0982 0 6.66737C0 6.23634 0.122237 5.83113 0.335269 5.52654C0.548331 5.22219 0.868196 5.0001 1.25 5C1.63209 5 1.95294 5.22191 2.16605 5.52654C2.37908 5.83113 2.5 6.23634 2.5 6.66737Z"
                                                fill="#9D9B98" />
                                            <path
                                                d="M0.833252 12.1094V7.8906C0.833252 7.67488 1.0198 7.5 1.24992 7.5C1.48004 7.5 1.66659 7.67488 1.66659 7.8906V12.1094C1.66641 12.325 1.47993 12.5 1.24992 12.5C1.01991 12.5 0.833428 12.325 0.833252 12.1094Z"
                                                fill="#9D9B98" />
                                            <path
                                                d="M10.6579 9.31364C10.6579 8.9734 10.6564 8.75738 10.6348 8.59906C10.6147 8.4523 10.584 8.41411 10.5654 8.39576C10.5468 8.37748 10.5083 8.34577 10.3588 8.32597C10.1978 8.30466 9.97715 8.30473 9.63096 8.30473H8.92167C8.57549 8.30473 8.35488 8.30466 8.19387 8.32597C8.04438 8.34577 8.00583 8.37748 7.98725 8.39576C7.96865 8.41411 7.93793 8.4523 7.91787 8.59906C7.89622 8.75738 7.89474 8.9734 7.89474 9.31364V11.7229H10.6579V9.31364ZM9.98715 5.42972C10.2048 5.42988 10.3816 5.60399 10.3819 5.81811C10.3819 6.03251 10.205 6.20634 9.98715 6.2065H8.56548C8.34762 6.20634 8.17074 6.03251 8.17074 5.81811C8.17108 5.60399 8.34782 5.42988 8.56548 5.42972H9.98715ZM9.98715 3.33301L10.0658 3.34059C10.246 3.37657 10.3819 3.53349 10.3819 3.7214C10.3819 3.90931 10.246 4.06623 10.0658 4.10221L9.98715 4.10979H8.56548C8.34762 4.10963 8.17074 3.9358 8.17074 3.7214C8.17074 3.507 8.34762 3.33317 8.56548 3.33301H9.98715ZM11.4474 11.7229H14.6053C14.8233 11.7229 15 11.8968 15 12.1113C14.9997 12.3255 14.8231 12.4997 14.6053 12.4997H0.394737C0.176935 12.4997 0.000332468 12.3255 0 12.1113C0 11.8968 0.17673 11.7229 0.394737 11.7229H7.10526V9.31364C7.10526 8.99552 7.10427 8.71791 7.13456 8.4959C7.16648 8.26247 7.23958 8.03308 7.42907 7.84655C7.61867 7.66 7.85172 7.58819 8.08902 7.55678C8.31486 7.52691 8.59793 7.52795 8.92167 7.52795H9.63096C9.95471 7.52795 10.2378 7.52691 10.4636 7.55678C10.7009 7.58819 10.934 7.66 11.1236 7.84655C11.313 8.03308 11.3862 8.26247 11.4181 8.4959C11.4484 8.71791 11.4474 8.99552 11.4474 9.31364V11.7229Z"
                                                fill="#9D9B98" />
                                        </svg>
                                        Space
                                    </span>
                                    <p>Garden / Shed</p>
                                </div>
                                <div>
                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="15"
                                            viewBox="0 0 16 15" fill="none">
                                            <path
                                                d="M0.5 7.32052C0.5 4.61314 0.5 3.25909 1.379 2.41837C2.258 1.57765 3.67175 1.57693 6.5 1.57693H9.5C12.3282 1.57693 13.7427 1.57693 14.621 2.41837C15.4992 3.2598 15.5 4.61314 15.5 7.32052V8.75641C15.5 11.4638 15.5 12.8178 14.621 13.6586C13.742 14.4993 12.3282 14.5 9.5 14.5H6.5C3.67175 14.5 2.25725 14.5 1.379 13.6586C0.50075 12.8171 0.5 11.4638 0.5 8.75641V7.32052Z"
                                                stroke="#9D9B98" />
                                            <path d="M4.25 1.57692V0.5M11.75 1.57692V0.5M0.875 5.16666H15.125"
                                                stroke="#9D9B98" stroke-linecap="round" />
                                            <path
                                                d="M12.5 10.9101C12.5 11.1005 12.421 11.2831 12.2803 11.4177C12.1397 11.5524 11.9489 11.628 11.75 11.628C11.5511 11.628 11.3603 11.5524 11.2197 11.4177C11.079 11.2831 11 11.1005 11 10.9101C11 10.7196 11.079 10.537 11.2197 10.4024C11.3603 10.2677 11.5511 10.1921 11.75 10.1921C11.9489 10.1921 12.1397 10.2677 12.2803 10.4024C12.421 10.537 12.5 10.7196 12.5 10.9101ZM12.5 8.03826C12.5 8.22867 12.421 8.41128 12.2803 8.54593C12.1397 8.68057 11.9489 8.75621 11.75 8.75621C11.5511 8.75621 11.3603 8.68057 11.2197 8.54593C11.079 8.41128 11 8.22867 11 8.03826C11 7.84785 11.079 7.66524 11.2197 7.53059C11.3603 7.39595 11.5511 7.32031 11.75 7.32031C11.9489 7.32031 12.1397 7.39595 12.2803 7.53059C12.421 7.66524 12.5 7.84785 12.5 8.03826ZM8.75 10.9101C8.75 11.1005 8.67098 11.2831 8.53033 11.4177C8.38968 11.5524 8.19891 11.628 8 11.628C7.80109 11.628 7.61032 11.5524 7.46967 11.4177C7.32902 11.2831 7.25 11.1005 7.25 10.9101C7.25 10.7196 7.32902 10.537 7.46967 10.4024C7.61032 10.2677 7.80109 10.1921 8 10.1921C8.19891 10.1921 8.38968 10.2677 8.53033 10.4024C8.67098 10.537 8.75 10.7196 8.75 10.9101ZM8.75 8.03826C8.75 8.22867 8.67098 8.41128 8.53033 8.54593C8.38968 8.68057 8.19891 8.75621 8 8.75621C7.80109 8.75621 7.61032 8.68057 7.46967 8.54593C7.32902 8.41128 7.25 8.22867 7.25 8.03826C7.25 7.84785 7.32902 7.66524 7.46967 7.53059C7.61032 7.39595 7.80109 7.32031 8 7.32031C8.19891 7.32031 8.38968 7.39595 8.53033 7.53059C8.67098 7.66524 8.75 7.84785 8.75 8.03826ZM5 10.9101C5 11.1005 4.92098 11.2831 4.78033 11.4177C4.63968 11.5524 4.44891 11.628 4.25 11.628C4.05109 11.628 3.86032 11.5524 3.71967 11.4177C3.57902 11.2831 3.5 11.1005 3.5 10.9101C3.5 10.7196 3.57902 10.537 3.71967 10.4024C3.86032 10.2677 4.05109 10.1921 4.25 10.1921C4.44891 10.1921 4.63968 10.2677 4.78033 10.4024C4.92098 10.537 5 10.7196 5 10.9101ZM5 8.03826C5 8.22867 4.92098 8.41128 4.78033 8.54593C4.63968 8.68057 4.44891 8.75621 4.25 8.75621C4.05109 8.75621 3.86032 8.68057 3.71967 8.54593C3.57902 8.41128 3.5 8.22867 3.5 8.03826C3.5 7.84785 3.57902 7.66524 3.71967 7.53059C3.86032 7.39595 4.05109 7.32031 4.25 7.32031C4.44891 7.32031 4.63968 7.39595 4.78033 7.53059C4.92098 7.66524 5 7.84785 5 8.03826Z"
                                                fill="#9D9B98" />
                                        </svg>
                                        Date
                                    </span>
                                    <p>18/12/2025</p>
                                </div>
                                <div>
                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            viewBox="0 0 48 48">
                                            <path
                                                d="M 24 4 C 12.972066 4 4 12.972074 4 24 C 4 35.027926 12.972066 44 24 44 C 35.027934 44 44 35.027926 44 24 C 44 12.972074 35.027934 4 24 4 z
       M 24 7 C 33.406615 7 41 14.593391 41 24 C 41 33.406609 33.406615 41 24 41 C 14.593385 41 7 33.406609 7 24 C 7 14.593391 14.593385 7 24 7 z
       M 22.476562 11.978516 A 1.50015 1.50015 0 0 0 21 13.5 L 21 24.5 A 1.50015 1.50015 0 0 0 21.439453 25.560547 L 26.439453 30.560547 A 1.50015 1.50015 0 1 0 28.560547 28.439453 L 24 23.878906 L 24 13.5 A 1.50015 1.50015 0 0 0 22.476562 11.978516 z"
                                                fill="#9D9B98" />
                                        </svg>
                                        Time
                                    </span>
                                    <p>Half-Day (14:30 - 18:30)</p>
                                </div>
                                <div>
                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="11" height="15"
                                            viewBox="0 0 11 15" fill="none">
                                            <path
                                                d="M5.5 0.5C6.83339 0.5 8.10786 1.00588 9.04395 1.89941C9.9792 2.79219 10.5 3.99796 10.5 5.25C10.5 6.6294 9.73861 8.338 8.73145 9.9707C7.73727 11.5823 6.5574 13.0362 5.82422 13.8867C5.6489 14.0901 5.3511 14.0901 5.17578 13.8867C4.4426 13.0362 3.26273 11.5823 2.26855 9.9707C1.26139 8.338 0.5 6.6294 0.5 5.25C0.5 3.99796 1.0208 2.79219 1.95605 1.89941C2.89214 1.00588 4.16661 0.5 5.5 0.5ZM5.5 2.875C4.85374 2.875 4.22936 3.11984 3.76562 3.5625C3.30115 4.00591 3.03613 4.61245 3.03613 5.25C3.03613 5.88755 3.30115 6.49409 3.76562 6.9375C4.22936 7.38016 4.85374 7.625 5.5 7.625C5.82047 7.625 6.13831 7.56479 6.43555 7.44727C6.73282 7.32973 7.00457 7.15686 7.23438 6.9375C7.46409 6.7182 7.64771 6.45659 7.77344 6.16699C7.89921 5.87715 7.96387 5.5652 7.96387 5.25C7.96387 4.61245 7.69885 4.00591 7.23438 3.5625C6.77064 3.11984 6.14626 2.875 5.5 2.875Z"
                                                stroke="#9D9B98" />
                                        </svg>
                                        Location
                                    </span>
                                    <p>Victoria Embankment</p>
                                </div>
                            </div>
                            <div>
                                <button>Change</button>
                            </div>
                        </div>
                    </div>
                    <div class="information">
                        <h2>Pet Information for Space Use</h2>

                        <!-- Buttons — hidden once list is shown -->
                        <div class="btns" id="petActionBtns">
                            <button id="selectPetsBtn">Select existing pet/s</button>
                            <button id="addNewPetBtn">+ Add new pet/s</button>
                        </div>

                        <!-- Inline pet list (shown in place of buttons) -->
                        <div class="pet-list" id="petList"></div>
<div class="pet-details-form hidden">
                                <div>
                                    <h2>Pet Details</h2>
                                </div>
                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="85" height="85" viewBox="0 0 85 85"
                                        fill="none" id="petPhotoPlaceholder">
                                        <mask id="path-1-inside-1_85_569" fill="white">
                                            <path
                                                d="M43.5 0C66.4198 0 85 18.5802 85 41.5V43.5C85 66.4198 66.4198 85 43.5 85H41.5C18.5802 85 0 66.4198 0 43.5V41.5C0 18.5802 18.5802 0 41.5 0H43.5ZM43 39.3184C39.2287 39.3184 36.4346 41.367 34.6494 43.9092C32.8863 46.4133 32 49.5227 32 52.0459C32.0002 54.9857 33.7446 57.0319 35.8848 58.2568C37.9904 59.4658 40.6304 60 43 60C45.3696 60 48.0096 59.469 50.1152 58.2568C52.2523 57.0287 53.9998 54.9857 54 52.0459C54 49.5227 53.1137 46.4133 51.3506 43.9092C49.5686 41.3638 46.7745 39.3184 43 39.3184ZM25.7139 39.3184C24.1584 39.3185 22.9388 40.2763 22.1846 41.4248C21.421 42.5829 21 44.0941 21 45.6816C21 47.2694 21.4209 48.7813 22.1846 49.9395C22.9388 51.0848 24.1584 52.0457 25.7139 52.0459C27.2696 52.0459 28.4899 51.0881 29.2441 49.9395C30.0079 48.7813 30.4287 47.2694 30.4287 45.6816C30.4287 44.0942 30.0077 42.5829 29.2441 41.4248C28.4899 40.2794 27.2696 39.3184 25.7139 39.3184ZM60.2861 39.3184C58.7304 39.3184 57.5101 40.2762 56.7559 41.4248C55.9923 42.5829 55.5713 44.0942 55.5713 45.6816C55.5713 47.2694 55.9921 48.7813 56.7559 49.9395C57.5102 51.0849 58.7304 52.0459 60.2861 52.0459C61.8416 52.0457 63.0612 51.0879 63.8154 49.9395C64.5791 48.7813 65 47.2694 65 45.6816C65 44.0941 64.579 42.5829 63.8154 41.4248C63.0612 40.2795 61.8416 39.3185 60.2861 39.3184ZM35.1426 25C33.587 25.0001 32.3675 25.9579 31.6133 27.1064C30.8497 28.2645 30.4288 29.7757 30.4287 31.3633C30.4287 32.951 30.8496 34.4629 31.6133 35.6211C32.3675 36.7665 33.587 37.7274 35.1426 37.7275C36.6982 37.7275 37.9176 36.7696 38.6719 35.6211C39.4356 34.4629 39.8574 32.951 39.8574 31.3633C39.8574 29.7757 39.4355 28.2645 38.6719 27.1064C37.9176 25.961 36.6982 25 35.1426 25ZM50.8574 25C49.3018 25 48.0824 25.9579 47.3281 27.1064C46.5645 28.2645 46.1426 29.7757 46.1426 31.3633C46.1426 32.951 46.5644 34.4629 47.3281 35.6211C48.0824 36.7664 49.3019 37.7275 50.8574 37.7275C52.413 37.7274 53.6325 36.7696 54.3867 35.6211C55.1504 34.4629 55.5713 32.951 55.5713 31.3633C55.5712 29.7757 55.1503 28.2645 54.3867 27.1064C53.6325 25.9611 52.413 25.0001 50.8574 25Z" />
                                        </mask>
                                        <path
                                            d="M43.5 0C66.4198 0 85 18.5802 85 41.5V43.5C85 66.4198 66.4198 85 43.5 85H41.5C18.5802 85 0 66.4198 0 43.5V41.5C0 18.5802 18.5802 0 41.5 0H43.5ZM43 39.3184C39.2287 39.3184 36.4346 41.367 34.6494 43.9092C32.8863 46.4133 32 49.5227 32 52.0459C32.0002 54.9857 33.7446 57.0319 35.8848 58.2568C37.9904 59.4658 40.6304 60 43 60C45.3696 60 48.0096 59.469 50.1152 58.2568C52.2523 57.0287 53.9998 54.9857 54 52.0459C54 49.5227 53.1137 46.4133 51.3506 43.9092C49.5686 41.3638 46.7745 39.3184 43 39.3184ZM25.7139 39.3184C24.1584 39.3185 22.9388 40.2763 22.1846 41.4248C21.421 42.5829 21 44.0941 21 45.6816C21 47.2694 21.4209 48.7813 22.1846 49.9395C22.9388 51.0848 24.1584 52.0457 25.7139 52.0459C27.2696 52.0459 28.4899 51.0881 29.2441 49.9395C30.0079 48.7813 30.4287 47.2694 30.4287 45.6816C30.4287 44.0942 30.0077 42.5829 29.2441 41.4248C28.4899 40.2794 27.2696 39.3184 25.7139 39.3184ZM60.2861 39.3184C58.7304 39.3184 57.5101 40.2762 56.7559 41.4248C55.9923 42.5829 55.5713 44.0942 55.5713 45.6816C55.5713 47.2694 55.9921 48.7813 56.7559 49.9395C57.5102 51.0849 58.7304 52.0459 60.2861 52.0459C61.8416 52.0457 63.0612 51.0879 63.8154 49.9395C64.5791 48.7813 65 47.2694 65 45.6816C65 44.0941 64.579 42.5829 63.8154 41.4248C63.0612 40.2795 61.8416 39.3185 60.2861 39.3184ZM35.1426 25C33.587 25.0001 32.3675 25.9579 31.6133 27.1064C30.8497 28.2645 30.4288 29.7757 30.4287 31.3633C30.4287 32.951 30.8496 34.4629 31.6133 35.6211C32.3675 36.7665 33.587 37.7274 35.1426 37.7275C36.6982 37.7275 37.9176 36.7696 38.6719 35.6211C39.4356 34.4629 39.8574 32.951 39.8574 31.3633C39.8574 29.7757 39.4355 28.2645 38.6719 27.1064C37.9176 25.961 36.6982 25 35.1426 25ZM50.8574 25C49.3018 25 48.0824 25.9579 47.3281 27.1064C46.5645 28.2645 46.1426 29.7757 46.1426 31.3633C46.1426 32.951 46.5644 34.4629 47.3281 35.6211C48.0824 36.7664 49.3019 37.7275 50.8574 37.7275C52.413 37.7274 53.6325 36.7696 54.3867 35.6211C55.1504 34.4629 55.5713 32.951 55.5713 31.3633C55.5712 29.7757 55.1503 28.2645 54.3867 27.1064C53.6325 25.9611 52.413 25.0001 50.8574 25Z"
                                            fill="#D4D4D4" />
                                        <path
                                            d="M43.5 0V-1V0ZM43.5 85V86V85ZM34.6494 43.9092L35.4671 44.4849L35.4678 44.4839L34.6494 43.9092ZM32 52.0459H31V52.046L32 52.0459ZM35.8848 58.2568L36.3827 57.3896L36.3815 57.3889L35.8848 58.2568ZM50.1152 58.2568L49.617 57.3898L49.6163 57.3902L50.1152 58.2568ZM54 52.0459L55 52.046V52.0459H54ZM51.3506 43.9092L50.5314 44.4827L50.5329 44.4849L51.3506 43.9092ZM25.7139 39.3184V38.3184H25.7138L25.7139 39.3184ZM22.1846 41.4248L23.0194 41.9753L23.0205 41.9737L22.1846 41.4248ZM21 45.6816L20 45.6816V45.6816H21ZM22.1846 49.9395L23.0197 49.3895L23.0194 49.389L22.1846 49.9395ZM25.7139 52.0459L25.7138 53.0459H25.7139V52.0459ZM29.2441 49.9395L28.4093 49.389L28.4083 49.3905L29.2441 49.9395ZM30.4287 45.6816H31.4287V45.6816L30.4287 45.6816ZM29.2441 41.4248L28.409 41.9748L28.4093 41.9752L29.2441 41.4248ZM60.2861 39.3184L60.2862 38.3184H60.2861V39.3184ZM56.7559 41.4248L57.5907 41.9752L57.5917 41.9737L56.7559 41.4248ZM55.5713 45.6816L54.5713 45.6816V45.6816H55.5713ZM56.7559 49.9395L57.591 49.3895L57.5907 49.389L56.7559 49.9395ZM60.2861 52.0459V53.0459H60.2862L60.2861 52.0459ZM63.8154 49.9395L62.9806 49.389L62.9796 49.3905L63.8154 49.9395ZM65 45.6816H66V45.6816L65 45.6816ZM63.8154 41.4248L62.9802 41.9748L62.9806 41.9753L63.8154 41.4248ZM35.1426 25V24H35.1425L35.1426 25ZM31.6133 27.1064L32.4481 27.6569L32.4492 27.6554L31.6133 27.1064ZM30.4287 31.3633L29.4287 31.3632V31.3633H30.4287ZM31.6133 35.6211L32.4485 35.0711L32.4481 35.0706L31.6133 35.6211ZM35.1426 37.7275L35.1425 38.7275H35.1426V37.7275ZM38.6719 35.6211L37.837 35.0706L37.836 35.0721L38.6719 35.6211ZM39.8574 31.3633H40.8574V31.3632L39.8574 31.3633ZM38.6719 27.1064L37.8367 27.6564L37.837 27.6569L38.6719 27.1064ZM50.8574 25L50.8575 24H50.8574V25ZM47.3281 27.1064L48.163 27.6569L48.164 27.6554L47.3281 27.1064ZM46.1426 31.3633L45.1426 31.3632V31.3633H46.1426ZM47.3281 35.6211L48.1633 35.0711L48.163 35.0706L47.3281 35.6211ZM50.8574 37.7275V38.7275H50.8575L50.8574 37.7275ZM54.3867 35.6211L53.5519 35.0706L53.5508 35.0722L54.3867 35.6211ZM55.5713 31.3633H56.5713V31.3632L55.5713 31.3633ZM54.3867 27.1064L53.5515 27.6564L53.5519 27.6569L54.3867 27.1064ZM43.5 0V1C65.8675 1 84 19.1325 84 41.5H85H86C86 18.0279 66.9721 -1 43.5 -1V0ZM85 41.5H84V43.5H85H86V41.5H85ZM85 43.5H84C84 65.8675 65.8675 84 43.5 84V85V86C66.9721 86 86 66.9721 86 43.5H85ZM43.5 85V84H41.5V85V86H43.5V85ZM41.5 85V84C19.1325 84 1 65.8675 1 43.5H0H-1C-1 66.9721 18.0279 86 41.5 86V85ZM0 43.5H1V41.5H0H-1V43.5H0ZM0 41.5H1C1 19.1325 19.1325 1 41.5 1V0V-1C18.0279 -1 -1 18.0279 -1 41.5H0ZM41.5 0V1H43.5V0V-1H41.5V0ZM43 39.3184V38.3184C38.8207 38.3184 35.7506 40.601 33.831 43.3345L34.6494 43.9092L35.4678 44.4839C37.1186 42.1331 39.6367 40.3184 43 40.3184V39.3184ZM34.6494 43.9092L33.8318 43.3335C31.9482 46.0085 31 49.3196 31 52.0459H32H33C33 49.7258 33.8243 46.818 35.4671 44.4849L34.6494 43.9092ZM32 52.0459L31 52.046C31.0002 55.4494 33.0401 57.7809 35.388 59.1247L35.8848 58.2568L36.3815 57.3889C34.4491 56.2829 33.0001 54.5219 33 52.0458L32 52.0459ZM35.8848 58.2568L35.3869 59.1241C37.6792 60.4402 40.5013 61 43 61V60V59C40.7595 59 38.3016 58.4914 36.3827 57.3896L35.8848 58.2568ZM43 60V61C45.4977 61 48.3206 60.4438 50.6141 59.1235L50.1152 58.2568L49.6163 57.3902C47.6986 58.4942 45.2415 59 43 59V60ZM50.1152 58.2568L50.6135 59.1239C52.9556 57.7779 54.9998 55.4505 55 52.046L54 52.0459L53 52.0458C52.9999 54.5208 51.549 56.2795 49.617 57.3898L50.1152 58.2568ZM54 52.0459H55C55 49.3196 54.0518 46.0085 52.1682 43.3335L51.3506 43.9092L50.5329 44.4849C52.1757 46.818 53 49.7258 53 52.0459H54ZM51.3506 43.9092L52.1698 43.3357C50.2525 40.5971 47.1818 38.3184 43 38.3184V39.3184V40.3184C46.3671 40.3184 48.8846 42.1305 50.5314 44.4827L51.3506 43.9092ZM25.7139 39.3184L25.7138 38.3184C23.7118 38.3186 22.2182 39.5518 21.3487 40.8759L22.1846 41.4248L23.0205 41.9737C23.6594 41.0007 24.6049 40.3185 25.714 40.3184L25.7139 39.3184ZM22.1846 41.4248L21.3497 40.8744C20.4636 42.2183 20 43.9272 20 45.6816L21 45.6816L22 45.6817C22 44.2611 22.3784 42.9475 23.0194 41.9753L22.1846 41.4248ZM21 45.6816H20C20 47.4362 20.4634 49.1458 21.3497 50.49L22.1846 49.9395L23.0194 49.389C22.3783 48.4167 22 47.1026 22 45.6816H21ZM22.1846 49.9395L21.3494 50.4894C22.2178 51.8082 23.7109 53.0457 25.7138 53.0459L25.7139 52.0459L25.714 51.0459C24.6059 51.0458 23.6598 50.3614 23.0197 49.3895L22.1846 49.9395ZM25.7139 52.0459V53.0459C27.7159 53.0459 29.2103 51.8127 30.08 50.4884L29.2441 49.9395L28.4083 49.3905C27.7694 50.3634 26.8232 51.0459 25.7139 51.0459V52.0459ZM29.2441 49.9395L30.079 50.49C30.9653 49.1458 31.4287 47.4362 31.4287 45.6816H30.4287H29.4287C29.4287 47.1026 29.0504 48.4167 28.4093 49.389L29.2441 49.9395ZM30.4287 45.6816L31.4287 45.6816C31.4287 43.9272 30.965 42.2183 30.079 40.8744L29.2441 41.4248L28.4093 41.9752C29.0503 42.9475 29.4287 44.2611 29.4287 45.6817L30.4287 45.6816ZM29.2441 41.4248L30.0793 40.8748C29.2107 39.5558 27.7169 38.3184 25.7139 38.3184V39.3184V40.3184C26.8223 40.3184 27.769 41.0029 28.409 41.9748L29.2441 41.4248ZM60.2861 39.3184V38.3184C58.2841 38.3184 56.7896 39.5515 55.92 40.8759L56.7559 41.4248L57.5917 41.9737C58.2306 41.0008 59.1768 40.3184 60.2861 40.3184V39.3184ZM56.7559 41.4248L55.921 40.8744C55.035 42.2183 54.5713 43.9272 54.5713 45.6816L55.5713 45.6816L56.5713 45.6817C56.5713 44.2611 56.9497 42.9475 57.5907 41.9752L56.7559 41.4248ZM55.5713 45.6816H54.5713C54.5713 47.4362 55.0347 49.1458 55.921 50.49L56.7559 49.9395L57.5907 49.389C56.9496 48.4167 56.5713 47.1026 56.5713 45.6816H55.5713ZM56.7559 49.9395L55.9207 50.4894C56.7893 51.8085 58.2832 53.0459 60.2861 53.0459V52.0459V51.0459C59.1777 51.0459 58.231 50.3613 57.591 49.3895L56.7559 49.9395ZM60.2861 52.0459L60.2862 53.0459C62.2881 53.0457 63.7818 51.8124 64.6513 50.4884L63.8154 49.9395L62.9796 49.3905C62.3406 50.3635 61.395 51.0458 60.286 51.0459L60.2861 52.0459ZM63.8154 49.9395L64.6503 50.49C65.5366 49.1458 66 47.4362 66 45.6816H65H64C64 47.1026 63.6217 48.4167 62.9806 49.389L63.8154 49.9395ZM65 45.6816L66 45.6816C66 43.9272 65.5364 42.2183 64.6503 40.8744L63.8154 41.4248L62.9806 41.9753C63.6216 42.9475 64 44.2611 64 45.6817L65 45.6816ZM63.8154 41.4248L64.6506 40.8748C63.7822 39.556 62.2891 38.3186 60.2862 38.3184L60.2861 39.3184L60.286 40.3184C61.3942 40.3185 62.3402 41.0029 62.9802 41.9748L63.8154 41.4248ZM35.1426 25L35.1425 24C33.1404 24.0001 31.6469 25.2335 30.7774 26.5575L31.6133 27.1064L32.4492 27.6554C33.0882 26.6823 34.0336 26.0001 35.1427 26L35.1426 25ZM31.6133 27.1064L30.7784 26.556C29.8923 27.8999 29.4288 29.6088 29.4287 31.3632L30.4287 31.3633L31.4287 31.3633C31.4288 29.9427 31.8071 28.6291 32.4481 27.6569L31.6133 27.1064ZM30.4287 31.3633H29.4287C29.4287 33.1178 29.8921 34.8275 30.7784 36.1716L31.6133 35.6211L32.4481 35.0706C31.807 34.0984 31.4287 32.7842 31.4287 31.3633H30.4287ZM31.6133 35.6211L30.7781 36.1711C31.6465 37.4898 33.1395 38.7274 35.1425 38.7275L35.1426 37.7275L35.1427 36.7275C34.0345 36.7275 33.0885 36.0431 32.4485 35.0711L31.6133 35.6211ZM35.1426 37.7275V38.7275C37.1448 38.7275 38.6383 37.4939 39.5077 36.1701L38.6719 35.6211L37.836 35.0721C37.1969 36.0453 36.2515 36.7275 35.1426 36.7275V37.7275ZM38.6719 35.6211L39.5067 36.1716C40.3928 34.8278 40.8574 33.1183 40.8574 31.3633H39.8574H38.8574C38.8574 32.7837 38.4784 34.098 37.837 35.0706L38.6719 35.6211ZM39.8574 31.3633L40.8574 31.3632C40.8574 29.6083 40.3927 27.8996 39.5067 26.5559L38.6719 27.1064L37.837 27.6569C38.4784 28.6295 38.8574 29.9431 38.8574 31.3633L39.8574 31.3633ZM38.6719 27.1064L39.507 26.5565C38.6386 25.2378 37.1458 24 35.1426 24V25V26C36.2507 26 37.1965 26.6843 37.8367 27.6564L38.6719 27.1064ZM50.8574 25V24C48.8552 24 47.3617 25.2335 46.4923 26.5575L47.3281 27.1064L48.164 27.6554C48.8031 26.6822 49.7484 26 50.8574 26V25ZM47.3281 27.1064L46.4933 26.5559C45.6073 27.8996 45.1426 29.6083 45.1426 31.3632L46.1426 31.3633L47.1426 31.3633C47.1426 29.9431 47.5217 28.6295 48.163 27.6569L47.3281 27.1064ZM46.1426 31.3633H45.1426C45.1426 33.1183 45.6072 34.8278 46.4933 36.1716L47.3281 35.6211L48.163 35.0706C47.5216 34.098 47.1426 32.7837 47.1426 31.3633H46.1426ZM47.3281 35.6211L46.493 36.1711C47.3614 37.4897 48.8543 38.7275 50.8574 38.7275V37.7275V36.7275C49.7494 36.7275 48.8035 36.0431 48.1633 35.0711L47.3281 35.6211ZM50.8574 37.7275L50.8575 38.7275C52.8595 38.7274 54.3531 37.494 55.2226 36.17L54.3867 35.6211L53.5508 35.0722C52.9118 36.0452 51.9664 36.7275 50.8573 36.7275L50.8574 37.7275ZM54.3867 35.6211L55.2216 36.1716C56.1079 34.8275 56.5713 33.1178 56.5713 31.3633H55.5713H54.5713C54.5713 32.7842 54.193 34.0984 53.5519 35.0706L54.3867 35.6211ZM55.5713 31.3633L56.5713 31.3632C56.5712 29.6088 56.1077 27.8999 55.2216 26.556L54.3867 27.1064L53.5519 27.6569C54.1929 28.6291 54.5712 29.9427 54.5713 31.3633L55.5713 31.3633ZM54.3867 27.1064L55.2219 26.5565C54.3535 25.2377 52.8605 24.0001 50.8575 24L50.8574 25L50.8573 26C51.9655 26.0001 52.9115 26.6844 53.5515 27.6564L54.3867 27.1064Z"
                                            fill="#C9C9C9" mask="url(#path-1-inside-1_85_569)" />
                                    </svg>
                                    <!-- Hidden file input -->
                                    <input type="file" id="petPhotoInput" accept="image/*" style="display: none;">
                                    <button type="button" id="petPhotoUploadBtn">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                            viewBox="0 0 14 14" fill="none">
                                            <path
                                                d="M7 10.3162C6.72386 10.3162 6.5 10.0923 6.5 9.8162V1.6662L4.52903 3.63716C4.33115 3.83504 4.00998 3.83392 3.81349 3.63465C3.61896 3.43738 3.62005 3.1201 3.81593 2.92416L6.55492 0.184403C6.80072 -0.0614672 7.19931 -0.0614954 7.44514 0.184341L10.185 2.92419C10.3809 3.12014 10.3822 3.43747 10.1877 3.63493C9.99116 3.83455 9.66959 3.83579 9.47149 3.63769L7.5 1.6662V9.8162C7.5 10.0923 7.27614 10.3162 7 10.3162ZM1.616 13.7392C1.15533 13.7392 0.771 13.5852 0.463 13.2772C0.155 12.9692 0.000666667 12.5845 0 12.1232V10.2002C0 9.92405 0.223858 9.7002 0.5 9.7002C0.776142 9.7002 1 9.92406 1 10.2002V12.1232C1 12.2772 1.064 12.4185 1.192 12.5472C1.32 12.6759 1.461 12.7399 1.615 12.7392H12.385C12.5383 12.7392 12.6793 12.6752 12.808 12.5472C12.9367 12.4192 13.0007 12.2779 13 12.1232V10.2002C13 9.92405 13.2239 9.7002 13.5 9.7002C13.7761 9.7002 14 9.92406 14 10.2002V12.1232C14 12.5839 13.846 12.9682 13.538 13.2762C13.23 13.5842 12.8453 13.7385 12.384 13.7392H1.616Z"
                                                fill="#3B3731" />
                                        </svg>
                                        Upload Pet Photo
                                    </button>
                                </div>
                                <div class="form-grid">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <div style="position:relative; display:block;">
                                            <input type="text" id="petName"
                                                style="padding-right:40px; width:100%; display:block;">
                                            <span class="input-check-icon" id="petNameCheck">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19"
                                                    viewBox="0 0 19 19" fill="none">
                                                    <path
                                                        d="M9.5 0C4.275 0 0 4.275 0 9.5C0 14.725 4.275 19 9.5 19C14.725 19 19 14.725 19 9.5C19 4.275 14.725 0 9.5 0ZM7.6 14.25L2.85 9.5L4.1895 8.1605L7.6 11.5615L14.8105 4.351L16.15 5.7L7.6 14.25Z"
                                                        fill="#C9DDA0" />
                                                </svg>
                                            </span>
                                        </div>
                                    </div>

                                    <?php renderBirthdayCalendar('birthday'); ?>

                                    <div class="form-group">
                                        <label>Pet Type</label>
                                        <div style="position:relative; display:block;">
                                            <input type="text" id="petTypeInput" placeholder="e.g. Dog, Cat, Rabbit..."
                                                autocomplete="off"
                                                style="padding-right:40px; width:100%; display:block;">
                                            <span class="input-check-icon" id="petTypeCheck">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19"
                                                    viewBox="0 0 19 19" fill="none">
                                                    <path
                                                        d="M9.5 0C4.275 0 0 4.275 0 9.5C0 14.725 4.275 19 9.5 19C14.725 19 19 14.725 19 9.5C19 4.275 14.725 0 9.5 0ZM7.6 14.25L2.85 9.5L4.1895 8.1605L7.6 11.5615L14.8105 4.351L16.15 5.7L7.6 14.25Z"
                                                        fill="#C9DDA0" />
                                                </svg>
                                            </span>
                                        </div>
                                        <div id="petTypeSuggestions"
                                            style="display: none; border: 1px solid #D4D4D4; border-top: none; border-radius: 0 0 10px 10px; background: #FFF; max-height: 200px; overflow-y: auto; position: absolute; width: calc(100% - 20px); z-index: 10;">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Breed(s)</label>
                                        <div class="input-wrap select-wrap">
                                            <select data-furs-dropdown data-furs-searchable id="petBreedSelect">
                                                <option value="">Select a Breed</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Sex</label>

                                        <div class="sex-options" role="radiogroup" aria-label="Sex">
                                            <label class="radio--small">
                                                <input type="radio" name="sex" value="male" id="petSexMale">
                                                <span class="radio--visual" aria-hidden="true"></span>
                                                <span class="radio--text">Male</span>
                                            </label>

                                            <label class="radio--small">
                                                <input type="radio" name="sex" value="female" id="petSexFemale">
                                                <span class="radio--visual" aria-hidden="true"></span>
                                                <span class="radio--text">Female</span>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Weight <span>(kg)</span></label>
                                        <input value="4" type="number" id="petWeight">
                                    </div>

                                    <div class="form-group full-width">
                                        <label>Notes <span>(Optional)</span></label>
                                        <textarea placeholder="Anything your groomer should know?
(e.g. anxious around dryers, allergies, behaviour cues)" rows="4" cols="50" id="petNotes"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-btns" id="petFormBtns">
                                <div>
                                    <button type="button" id="petFormCancelBtn">Cancel</button>
                                    <button type="button" id="petFormSaveBtn">Save</button>
                                </div>
                            </div>

                            <!-- Pet Details Display Section -->
                            <div class="pet-details-display" id="petDetailsDisplay">
                                <div class="pet-details-display-content" id="petDetailsContent">
                                </div>
                                <div class="pet-display-action-btns">
                                    <button type="button" id="petDisplayChangeBtn">Edit</button>
                                </div>
                            </div>
                            
                    </div>
                    <div class="add-ons">
                        <h2 class="add-ons-title">Add-ons Services</h2>
                        <div class="add-ons-list">
                            <label class="add-on-card">
                                <input type="checkbox" name="addons[]" value="storage_locker" class="add-on-checkbox"
                                    checked>
                                <div class="add-on-content">
                                    <span class="add-on-name">Storage Locker</span>
                                    <span class="add-on-price-container">
                                        <span class="add-on-price">£5</span> <span class="add-on-unit">/ day</span>
                                    </span>
                                </div>
                                <div class="checkmark-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"
                                        fill="none">
                                        <circle cx="10" cy="10" r="10" fill="#C9DDA0" />
                                        <path d="M6 10L8.5 12.5L14 7" stroke="white" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </div>
                            </label>

                            <label class="add-on-card">
                                <input type="checkbox" name="addons[]" value="deep_clean" class="add-on-checkbox"
                                    checked>
                                <div class="add-on-content">
                                    <span class="add-on-name">Deep Clean</span>
                                    <span class="add-on-price-container">
                                        <span class="add-on-price">£10</span>
                                    </span>
                                </div>
                                <div class="checkmark-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"
                                        fill="none">
                                        <circle cx="10" cy="10" r="10" fill="#C9DDA0" />
                                        <path d="M6 10L8.5 12.5L14 7" stroke="white" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </div>
                            </label>

                            <label class="add-on-card">
                                <input type="checkbox" name="addons[]" value="after_hours_access"
                                    class="add-on-checkbox">
                                <div class="add-on-content">
                                    <span class="add-on-name">After-hours access</span>
                                    <span class="add-on-price-container">
                                        <span class="add-on-price">£20</span>
                                    </span>
                                </div>
                                <div class="checkmark-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"
                                        fill="none">
                                        <circle cx="10" cy="10" r="10" fill="#C9DDA0" />
                                        <path d="M6 10L8.5 12.5L14 7" stroke="white" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </div>
                            </label>
                        </div>
                        <div class="add-ons-actions">
                            <button type="button" class="continue-action-btn" id="addonsContinueBtn">
                                Continue
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path d="M5 12h14"></path>
                                    <path d="m12 5 7 7-7 7"></path>
                                </svg>
                            </button>
                        </div>
                    </div>

                </div>
                <!-- <div class="step-two"></div> -->
            </div>
            <div class="col-lg-4"></div>
        </div>
    </section>
    <?php include('../components/footer.php'); ?>
    <?php
    bcAssets(); ?>
    <script src=" <?= BASE_URL ?>/assets/js/custom.js"></script>
    <script src="<?= BASE_URL ?>/assets/js/custom-dropdown.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // JS to handle add-on card selection styling
            const addonCards = document.querySelectorAll('.add-on-card');
            addonCards.forEach(card => {
                const checkbox = card.querySelector('.add-on-checkbox');

                // Initialize state
                if (checkbox && checkbox.checked) {
                    card.classList.add('active');
                }

                checkbox.addEventListener('change', function () {
                    if (this.checked) {
                        card.classList.add('active');
                    } else {
                        card.classList.remove('active');
                    }
                });
            });

            const continueBtn = document.getElementById("addonsContinueBtn");
            if (continueBtn) {
                continueBtn.addEventListener("click", function () {
                    const selectedAddons = Array.from(document.querySelectorAll('.add-on-checkbox:checked'))
                        .map(cb => cb.value);
                    console.log("Selected Add-ons:", selectedAddons);
                });
            }
        });


        (function () {

            const icons = {
                paw: `<svg xmlns="http://www.w3.org/2000/svg" width="16" height="15" viewBox="0 0 16 15" fill="none">
  <path d="M8 6.02632C5.73786 6.02632 3.82643 8.06405 3.20929 10.6813C2.93786 11.8323 3.34714 13.0539 4.35179 13.6279C5.14821 14.0829 6.33286 14.5 8 14.5C9.66714 14.5 10.8521 14.0829 11.6486 13.6279C12.6532 13.0539 13.0621 11.8323 12.7907 10.6813C12.1736 8.06368 10.2621 6.02632 8 6.02632ZM0.5 5.45305C0.5 6.47063 1.13929 7.5 1.92857 7.5C2.71786 7.5 3.35714 6.47063 3.35714 5.45305C3.35714 4.43547 2.71786 3.81579 1.92857 3.81579C1.13929 3.81579 0.5 4.43584 0.5 5.45305ZM15.5 5.45305C15.5 6.47063 14.8607 7.5 14.0714 7.5C13.2821 7.5 12.6429 6.47063 12.6429 5.45305C12.6429 4.43547 13.2821 3.81579 14.0714 3.81579C14.8607 3.81579 15.5 4.43584 15.5 5.45305ZM4.25 2.13726C4.25 3.15484 4.88929 4.18421 5.67857 4.18421C6.46786 4.18421 7.10714 3.15484 7.10714 2.13726C7.10714 1.11968 6.46786 0.5 5.67857 0.5C4.88929 0.5 4.25 1.12005 4.25 2.13726ZM11.75 2.13726C11.75 3.15484 11.1107 4.18421 10.3214 4.18421C9.53214 4.18421 8.89286 3.15484 8.89286 2.13726C8.89286 1.11968 9.53214 0.5 10.3214 0.5C11.1107 0.5 11.75 1.12005 11.75 2.13726Z" stroke="#9D9B98" stroke-linecap="round" stroke-linejoin="round"/>
</svg>`,
                birthday: `<svg xmlns="http://www.w3.org/2000/svg" width="15" height="17" viewBox="0 0 15 17" fill="none">
  <path d="M1.27778 11.7778V14.5C1.27778 14.9126 1.44167 15.3082 1.73339 15.5999C2.02511 15.8917 2.42077 16.0556 2.83333 16.0556H12.1667C12.5792 16.0556 12.9749 15.8917 13.2666 15.5999C13.5583 15.3082 13.7222 14.9126 13.7222 14.5V11.7778M0.5 9.83333V9.05556C0.5 8.643 0.663888 8.24734 0.955612 7.95561C1.24733 7.66389 1.643 7.5 2.05556 7.5H12.9444C13.357 7.5 13.7527 7.66389 14.0444 7.95561C14.3361 8.24734 14.5 8.643 14.5 9.05556V9.83333M7.5 5.16667V7.5M7.5 5.16667C8.48156 5.16667 9.05556 4.41378 9.05556 3.125C9.05556 1.83622 7.5 0.5 7.5 0.5C7.5 0.5 5.94444 1.83622 5.94444 3.125C5.94444 4.41378 6.51844 5.16667 7.5 5.16667Z" stroke="#9D9B98" stroke-linecap="round" stroke-linejoin="round"/>
  <path d="M0.5 9.83325C0.5 10.4521 0.745833 11.0456 1.18342 11.4832C1.621 11.9208 2.21449 12.1666 2.83333 12.1666C3.45217 12.1666 4.04566 11.9208 4.48325 11.4832C4.92083 11.0456 5.16667 10.4521 5.16667 9.83325C5.16667 10.4521 5.4125 11.0456 5.85008 11.4832C6.28767 11.9208 6.88116 12.1666 7.5 12.1666C8.11884 12.1666 8.71233 11.9208 9.14992 11.4832C9.5875 11.0456 9.83333 10.4521 9.83333 9.83325C9.83333 10.4521 10.0792 11.0456 10.5168 11.4832C10.9543 11.9208 11.5478 12.1666 12.1667 12.1666C12.7855 12.1666 13.379 11.9208 13.8166 11.4832C14.2542 11.0456 14.5 10.4521 14.5 9.83325" stroke="#9D9B98" stroke-linecap="round" stroke-linejoin="round"/>
</svg>`,
                sexMale: `<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#9D9B98" class="bi bi-gender-male" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M9.5 2a.5.5 0 0 1 0-1h5a.5.5 0 0 1 .5.5v5a.5.5 0 0 1-1 0V2.707L9.871 6.836a5 5 0 1 1-.707-.707L13.293 2zM6 6a4 4 0 1 0 0 8 4 4 0 0 0 0-8"/>
</svg>`,
                sexFemale: `<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#9D9B98" class="bi bi-gender-female" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M8 1a4 4 0 1 0 0 8 4 4 0 0 0 0-8M3 5a5 5 0 1 1 5.5 4.975V12h2a.5.5 0 0 1 0 1h-2v2.5a.5.5 0 0 1-1 0V13h-2a.5.5 0 0 1 0-1h2V9.975A5 5 0 0 1 3 5"/>
</svg>`,
                notes: `<svg xmlns="http://www.w3.org/2000/svg" width="15" height="16" viewBox="0 0 15 16" fill="none">
  <path d="M13.5905 8.11123L13.9601 6.73016C14.3918 5.1182 14.6084 4.31257 14.4462 3.61489C14.3176 3.0641 14.0285 2.56382 13.6155 2.17734C13.093 1.68768 12.2866 1.4718 10.6747 1.04003C9.0627 0.607553 8.25636 0.391671 7.55939 0.55394C7.0086 0.682549 6.50833 0.971618 6.12185 1.38458C5.70224 1.83207 5.4835 2.48758 5.15824 3.67851L4.98382 4.32544L4.61425 5.70651C4.18177 7.31847 3.96589 8.1241 4.12816 8.82178C4.25677 9.37257 4.54584 9.87285 4.9588 10.2593C5.48135 10.749 6.28769 10.9649 7.89966 11.3974C9.35221 11.7862 10.1507 12 10.8048 11.9192C10.8763 11.9101 10.9463 11.8977 11.0149 11.882C11.5655 11.7538 12.0658 11.4652 12.4525 11.0528C12.9421 10.5295 13.158 9.7232 13.5905 8.11123Z" stroke="#9D9B98"/>
  <path d="M10.8047 11.9191C10.6553 12.3769 10.3927 12.7895 10.0413 13.1186C9.51875 13.6083 8.71241 13.8242 7.10045 14.2559C5.48848 14.6877 4.68214 14.9043 3.98517 14.7413C3.43447 14.6129 2.9342 14.3241 2.54763 13.9114C2.05796 13.3888 1.84137 12.5825 1.4096 10.9705L1.04003 9.58946C0.607553 7.9775 0.391671 7.17116 0.55394 6.47419C0.682549 5.9234 0.971618 5.42313 1.38458 5.03665C1.90713 4.54698 2.71347 4.3311 4.32544 3.89862C4.62948 3.81665 4.90708 3.74302 5.15823 3.67773" stroke="#9D9B98"/>
  <path d="M7.48951 6.21899L10.9422 7.144M6.93408 8.2906L9.00569 8.84532" stroke="#9D9B98" stroke-linecap="round"/>
</svg>`,
            };

            function petEmoji(type) {
                return { Dog: '🐶', Cat: '🐱', Rabbit: '🐰', Bird: '🐦', Fish: '🐟', Hamster: '🐹' }[type] || '🐾';
            }

            let allPets = [];
            let selectedIds = new Set();

            const actionBtns = document.getElementById('petActionBtns');
            const petList = document.getElementById('petList');
            const selectBtn = document.getElementById('selectPetsBtn');

            // ── Open: hide buttons, show list ─────────────────────────────────────
            selectBtn.addEventListener('click', async function () {
                actionBtns.style.display = 'none';
                petList.classList.add('visible');
                if (allPets.length === 0) await loadPets();
                else renderCards();
            });

            // ── Load pets ──────────────────────────────────────────────────────────
            async function loadPets() {
                petList.innerHTML = '<p style="color:#9D9B98;font-family:Lato,sans-serif;font-size:14px;padding:8px 0;">Loading…</p>';
                try {
                    const res = await fetch('<?= BASE_URL ?>/assets/data/pets-data.json');
                    allPets = await res.json();
                } catch (err) {
                    console.error('Failed to load pets from pets-data.json:', err);
                    allPets = [];
                }
                allPets = allPets.map((p, i) => ({ id: p.id ?? i + 1, ...p }));
                renderCards();
            }

            // ── Render ─────────────────────────────────────────────────────────────
            function renderCards() {
                petList.innerHTML = '';

                allPets.forEach(pet => {
                    const card = document.createElement('div');
                    card.className = 'pet-card' + (selectedIds.has(pet.id) ? ' selected' : '');
                    card.dataset.petId = pet.id;

                    card.innerHTML = `
        <div class="pet-radio"><div class="pet-radio-inner"></div></div>
        <div class="pet-avatar">
          <img src="${pet.image}" alt="${pet.name}"
               onerror="this.parentElement.innerHTML='${petEmoji(pet.type)}'">
        </div>
        <div class="pet-info-grid">
          <div class="pet-field">
            <span class="pet-field-label">${icons.paw} ${pet.name}</span>
            <p class="pet-field-value">${pet.type} &bull; ${pet.breed}</p>
          </div>
          <div class="pet-field">
            ${pet.birthday ? `
            <span class="pet-field-label">${icons.birthday} Birthday</span>
            <p class="pet-field-value">${pet.birthday}</p>
            ` : ''}
          </div>
          <div class="pet-field">
            <span class="pet-field-label">${pet.sex && pet.sex.toLowerCase() === 'female' ? icons.sexFemale : icons.sexMale} Sex</span>
            <p class="pet-field-value">${pet.sex}</p>
          </div>
          <div class="pet-field notes">
            ${pet.notes ? `
            <span class="pet-field-label">${icons.notes} Notes</span>
            <p class="pet-field-value" title="${pet.notes}">${pet.notes}</p>
            ` : ''}
          </div>
        </div>
        <button class="pet-edit-btn" data-pet-id="${pet.id}">Edit</button>
      `;

                    card.addEventListener('click', function (e) {
                        if (e.target.closest('.pet-edit-btn')) return;
                        selectedIds.has(pet.id) ? selectedIds.delete(pet.id) : selectedIds.add(pet.id);
                        card.classList.toggle('selected');
                        updateConfirmBtn();
                    });

                    card.querySelector('.pet-edit-btn').addEventListener('click', function (e) {
                        e.stopPropagation();
                        // Wire to your edit pet flow here
                        console.log('Edit pet:', pet);
                    });

                    petList.appendChild(card);
                });

                // Confirm + Cancel button row
                const actions = document.createElement('div');
                actions.className = 'pet-list-actions';
                actions.innerHTML = `
      <button class="pet-cancel-btn" id="petCancelBtn">Cancel</button>
      <button class="pet-save-btn" id="petConfirmBtn" disabled>
        Save
      </button>
    `;
                petList.appendChild(actions);

                updateConfirmBtn();

                document.getElementById('petCancelBtn').addEventListener('click', function () {
                    selectedIds.clear();
                    petList.classList.remove('visible', 'has-selection');
                    petList.innerHTML = '';
                    actionBtns.style.display = '';
                });

                document.getElementById('petConfirmBtn').addEventListener('click', function () {
                    const chosen = allPets.filter(p => selectedIds.has(p.id));
                    console.log('Selected pets:', chosen);
                    // Fire your next step / form submit here
                });
            }

            function updateConfirmBtn() {
                const btn = document.getElementById('petConfirmBtn');
                if (btn) btn.disabled = selectedIds.size === 0;

                if (selectedIds.size > 0) {
                    petList.classList.add('has-selection');
                } else {
                    petList.classList.remove('has-selection');
                }
            }

        })();
    
// ===== Pet Type Auto-Detection and Breed Population ===== 
        let petBreedsData = {};
        let selectedPetType = '';

        // Load the pet breeds JSON file
        async function loadPetBreedsData() {
            try {
                const response = await fetch('<?= BASE_URL ?>/assets/data/pet-breeds.json');
                if (!response.ok) {
                    throw new Error(`Failed to load pet breeds: ${response.statusText}`);
                }
                const data = await response.json();
                petBreedsData = data;
                setupPetTypeAutoDetection();
            } catch (error) {
                console.error('Error loading pet breeds data:', error);
            }
        }

        // Setup auto-detection for pet type input
        function setupPetTypeAutoDetection() {
            const petTypeInput = document.getElementById('petTypeInput');
            const suggestionBox = document.getElementById('petTypeSuggestions');
            const petBreedSelect = document.getElementById('petBreedSelect');

            if (!petTypeInput || !petBreedsData.petTypes) return;

            // Listen for input changes
            petTypeInput.addEventListener('input', function () {
                const inputValue = this.value.trim().toLowerCase();
                suggestionBox.innerHTML = '';

                if (inputValue.length === 0) {
                    suggestionBox.style.display = 'none';
                    petBreedSelect.innerHTML = '<option value="">Select a Breed</option>';
                    if (petBreedSelect._fursDD) petBreedSelect._fursDD.refresh();
                    selectedPetType = '';
                    return;
                }

                // Find matching pet types
                const matches = petBreedsData.petTypes.filter(petType =>
                    petType.name.toLowerCase().includes(inputValue)
                );

                if (matches.length > 0) {
                    suggestionBox.style.display = 'block';
                    suggestionBox.innerHTML = '';

                    matches.forEach(match => {
                        const suggestionItem = document.createElement('div');
                        suggestionItem.style.cssText = 'padding: 10px; cursor: pointer; border-bottom: 1px solid #EEE; color: #3B3731; font-family: Lato;';
                        suggestionItem.textContent = match.name;

                        suggestionItem.addEventListener('mouseover', function () {
                            this.style.backgroundColor = '#f5f5f5';
                        });
                        suggestionItem.addEventListener('mouseout', function () {
                            this.style.backgroundColor = 'transparent';
                        });

                        suggestionItem.addEventListener('click', function () {
                            petTypeInput.value = match.name;
                            selectedPetType = match.name;
                            suggestionBox.style.display = 'none';
                            populateBreeds(match);
                        });

                        suggestionBox.appendChild(suggestionItem);
                    });
                } else {
                    suggestionBox.style.display = 'none';
                    petBreedSelect.innerHTML = '<option value="">Select a Breed</option>';
                    if (petBreedSelect._fursDD) petBreedSelect._fursDD.refresh();
                }

                // Check for exact match and auto-populate breeds
                const exactMatch = petBreedsData.petTypes.find(p => p.name.toLowerCase() === inputValue);
                if (exactMatch) {
                    selectedPetType = exactMatch.name;
                    populateBreeds(exactMatch);
                    suggestionBox.style.display = 'none';
                }
            });

            // Hide suggestions when clicking outside
            document.addEventListener('click', function (e) {
                if (e.target !== petTypeInput && e.target !== suggestionBox) {
                    suggestionBox.style.display = 'none';
                }
            });

            // Show suggestions on focus if input has value
            petTypeInput.addEventListener('focus', function () {
                if (this.value.trim().length > 0) {
                    suggestionBox.style.display = 'block';
                }
            });
        }

        // Populate breed dropdown based on selected pet type
        function populateBreeds(petType) {
            const petBreedSelect = document.getElementById('petBreedSelect');
            petBreedSelect.innerHTML = '<option value="">Select a Breed</option>';

            if (petType && petType.breeds) {
                petType.breeds.forEach(breed => {
                    const option = document.createElement('option');
                    option.value = breed;
                    option.textContent = breed;
                    petBreedSelect.appendChild(option);
                });
            }
            if (petBreedSelect._fursDD) petBreedSelect._fursDD.refresh();
        }

        // Initialize on DOM ready
        document.addEventListener('DOMContentLoaded', function () {
            loadPetBreedsData();
        });
        // ===== End Pet Type Auto-Detection =====

// ===== Pet Details Storage & Display =====
        const petFormCancelBtn = document.getElementById('petFormCancelBtn');
        const petFormSaveBtn = document.getElementById('petFormSaveBtn');
        const petDisplayChangeBtn = document.getElementById('petDisplayChangeBtn');
        const petDetailsDisplay = document.getElementById('petDetailsDisplay');
        const petDetailsContent = document.getElementById('petDetailsContent');
        const petDetailsForm = document.querySelector('.pet-details-form');
        const petFormBtns = document.getElementById('petFormBtns');
        const petPhotoUploadBtn = document.getElementById('petPhotoUploadBtn');
        const petPhotoInput = document.getElementById('petPhotoInput');
        const petPhotoPlaceholder = document.getElementById('petPhotoPlaceholder');

        // Store pet photo base64
        let petPhotoBase64 = null;

        // Image upload button click
        petPhotoUploadBtn.addEventListener('click', function (e) {
            e.preventDefault();
            petPhotoInput.click();
        });

        // Handle file selection
        petPhotoInput.addEventListener('change', function (e) {
            const file = e.target.files[0];
            if (!file) return;

            // Validate file type
            if (!file.type.startsWith('image/')) {
                alert('Please select an image file');
                return;
            }

            // Validate file size (max 5MB)
            const maxSize = 5 * 1024 * 1024;
            if (file.size > maxSize) {
                alert('Image size must be less than 5MB');
                return;
            }

            // Read file as base64
            const reader = new FileReader();
            reader.onload = function (event) {
                petPhotoBase64 = event.target.result;
                displayPetPhotoPreview(petPhotoBase64);
            };
            reader.readAsDataURL(file);
        });

        function displayPetPhotoPreview(photoBase64) {
            // Remove existing wrapper if any
            const existingWrapper = petPhotoPlaceholder.parentElement.querySelector('.pet-photo-col-wrapper');
            if (existingWrapper) existingWrapper.remove();

            // Create preview element
            const previewDiv = document.createElement('div');
            previewDiv.className = 'pet-photo-preview';
            const img = document.createElement('img');
            img.src = photoBase64;
            previewDiv.appendChild(img);

            // Hide placeholder and upload button
            petPhotoPlaceholder.style.display = 'none';
            petPhotoUploadBtn.style.display = 'none';

            // Create column wrapper
            const colWrapper = document.createElement('div');
            colWrapper.className = 'pet-photo-col-wrapper';

            // Create action buttons container
            const actionBtnsDiv = document.createElement('div');
            actionBtnsDiv.className = 'pet-photo-action-btns';

            const editBtn = document.createElement('button');
            editBtn.type = 'button';
            editBtn.className = 'pet-photo-edit-btn';
            editBtn.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
<path d="M7.78125 2.1875L11.8125 6.21875M1.3125 12.6875H3.64583L11.8125 4.52083C12.4419 3.89148 12.4419 2.87114 11.8125 2.2418C11.1832 1.61245 10.1628 1.61245 9.53345 2.2418L1.3125 10.4627V12.6875Z" stroke="#3B3731" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
</svg> Edit photo`;
            editBtn.addEventListener('click', function () {
                petPhotoInput.click();
            });

            const saveBtn = document.createElement('button');
            saveBtn.type = 'button';
            saveBtn.className = 'pet-photo-save-btn';
            saveBtn.textContent = 'Save';
            saveBtn.addEventListener('click', onPhotosaveConfirm);

            actionBtnsDiv.appendChild(editBtn);
            actionBtnsDiv.appendChild(saveBtn);

            // Display: preview on left, buttons on right
            colWrapper.appendChild(previewDiv);
            colWrapper.appendChild(actionBtnsDiv);

            petPhotoPlaceholder.parentElement.insertBefore(colWrapper, petPhotoPlaceholder);
        }

        // Function to handle photo save confirmation
        function onPhotosaveConfirm() {
            console.log('Photo saved successfully');
        }

        function removePetPhoto() {
            petPhotoBase64 = null;
            petPhotoInput.value = '';
            const wrapper = petPhotoPlaceholder.parentElement.querySelector('.pet-photo-col-wrapper');
            if (wrapper) wrapper.remove();
            petPhotoPlaceholder.style.display = 'block';
            petPhotoUploadBtn.style.display = 'block';
        }

        // Function to collect pet details from form
        function collectPetDetails() {
            // Get pet name
            const petNameInput = document.getElementById('petName');
            const petName = petNameInput ? petNameInput.value.trim() : '';

            // Get birthday from hidden input (created by renderBirthdayCalendar)
            const petBirthdayInput = document.querySelector('input[name="birthday"]');
            const petBirthday = petBirthdayInput ? petBirthdayInput.value : '';

            // Get pet type
            const petTypeInput = document.getElementById('petTypeInput');
            const petType = petTypeInput ? petTypeInput.value.trim() : '';

            // Get pet breed
            const petBreedSelect = document.getElementById('petBreedSelect');
            const petBreed = petBreedSelect ? petBreedSelect.value : '';

            // Get pet sex
            const petSexInput = document.querySelector('input[name="sex"]:checked');
            const petSex = petSexInput ? petSexInput.value : '';

            // Get pet weight
            const petWeightInput = document.getElementById('petWeight');
            const petWeight = petWeightInput ? petWeightInput.value : '';

            // Get pet notes
            const petNotesInput = document.getElementById('petNotes');
            const petNotes = petNotesInput ? petNotesInput.value.trim() : '';

            return {
                name: petName,
                birthday: petBirthday,
                type: petType,
                breed: petBreed,
                sex: petSex,
                weight: petWeight,
                notes: petNotes,
                photo: petPhotoBase64
            };
        }

        // Function to display pet details
        function displayPetDetails(details) {
            // Format birthday
            let birthdayDisplay = 'Not provided';
            if (details.birthday) {
                try {
                    const dateObj = new Date(details.birthday + 'T00:00:00');
                    if (!isNaN(dateObj.getTime())) {
                        const day = String(dateObj.getDate()).padStart(2, '0');
                        const month = String(dateObj.getMonth() + 1).padStart(2, '0');
                        const year = dateObj.getFullYear();
                        birthdayDisplay = `${day} / ${month} / ${year}`;
                    }
                } catch (e) {
                    birthdayDisplay = details.birthday;
                }
            }

            // Handle photo separately — inject ABOVE the grid, not inside it
            const existingPhoto = document.getElementById('petDisplayPhoto');
            if (existingPhoto) existingPhoto.remove();

            if (details.photo) {
                const photoEl = document.createElement('div');
                photoEl.id = 'petDisplayPhoto';
                photoEl.innerHTML = `<img src="${details.photo}" alt="Pet photo" style="width: 85px;height: 85px;aspect-ratio: 1/1; border-radius: 50%; object-fit: cover;">`;
                petDetailsDisplay.insertBefore(photoEl, petDetailsContent);
            }

            // Grid content — no photo here
            petDetailsContent.innerHTML = `
        <div class="pet-detail-item">
            <label>
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="15" viewBox="0 0 16 15" fill="none">
  <path d="M8 6.02632C5.73786 6.02632 3.82643 8.06405 3.20929 10.6813C2.93786 11.8323 3.34714 13.0539 4.35179 13.6279C5.14821 14.0829 6.33286 14.5 8 14.5C9.66714 14.5 10.8521 14.0829 11.6486 13.6279C12.6532 13.0539 13.0621 11.8323 12.7907 10.6813C12.1736 8.06368 10.2621 6.02632 8 6.02632ZM0.5 5.45305C0.5 6.47063 1.13929 7.5 1.92857 7.5C2.71786 7.5 3.35714 6.47063 3.35714 5.45305C3.35714 4.43547 2.71786 3.81579 1.92857 3.81579C1.13929 3.81579 0.5 4.43584 0.5 5.45305ZM15.5 5.45305C15.5 6.47063 14.8607 7.5 14.0714 7.5C13.2821 7.5 12.6429 6.47063 12.6429 5.45305C12.6429 4.43547 13.2821 3.81579 14.0714 3.81579C14.8607 3.81579 15.5 4.43584 15.5 5.45305ZM4.25 2.13726C4.25 3.15484 4.88929 4.18421 5.67857 4.18421C6.46786 4.18421 7.10714 3.15484 7.10714 2.13726C7.10714 1.11968 6.46786 0.5 5.67857 0.5C4.88929 0.5 4.25 1.12005 4.25 2.13726ZM11.75 2.13726C11.75 3.15484 11.1107 4.18421 10.3214 4.18421C9.53214 4.18421 8.89286 3.15484 8.89286 2.13726C8.89286 1.11968 9.53214 0.5 10.3214 0.5C11.1107 0.5 11.75 1.12005 11.75 2.13726Z" stroke="#9D9B98" stroke-linecap="round" stroke-linejoin="round"/>
</svg>
            ${details.name || 'N/A'}</label>
            <span>${details.type || 'Not provided'} <span class="dot"></span> ${details.breed || 'Not provided'}</span>
        </div>
        <div class="pet-detail-item">
            <label>
            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="17" viewBox="0 0 15 17" fill="none">
  <path d="M1.27778 11.7778V14.5C1.27778 14.9126 1.44167 15.3082 1.73339 15.5999C2.02511 15.8917 2.42077 16.0556 2.83333 16.0556H12.1667C12.5792 16.0556 12.9749 15.8917 13.2666 15.5999C13.5583 15.3082 13.7222 14.9126 13.7222 14.5V11.7778M0.5 9.83333V9.05556C0.5 8.643 0.663888 8.24734 0.955612 7.95561C1.24733 7.66389 1.643 7.5 2.05556 7.5H12.9444C13.357 7.5 13.7527 7.66389 14.0444 7.95561C14.3361 8.24734 14.5 8.643 14.5 9.05556V9.83333M7.5 5.16667V7.5M7.5 5.16667C8.48156 5.16667 9.05556 4.41378 9.05556 3.125C9.05556 1.83622 7.5 0.5 7.5 0.5C7.5 0.5 5.94444 1.83622 5.94444 3.125C5.94444 4.41378 6.51844 5.16667 7.5 5.16667Z" stroke="#9D9B98" stroke-linecap="round" stroke-linejoin="round"/>
  <path d="M0.5 9.8335C0.5 10.4523 0.745833 11.0458 1.18342 11.4834C1.621 11.921 2.21449 12.1668 2.83333 12.1668C3.45217 12.1668 4.04566 11.921 4.48325 11.4834C4.92083 11.0458 5.16667 10.4523 5.16667 9.8335C5.16667 10.4523 5.4125 11.0458 5.85008 11.4834C6.28767 11.921 6.88116 12.1668 7.5 12.1668C8.11884 12.1668 8.71233 11.921 9.14992 11.4834C9.5875 11.0458 9.83333 10.4523 9.83333 9.8335C9.83333 10.4523 10.0792 11.0458 10.5168 11.4834C10.9543 11.921 11.5478 12.1668 12.1667 12.1668C12.7855 12.1668 13.379 11.921 13.8166 11.4834C14.2542 11.0458 14.5 10.4523 14.5 9.8335" stroke="#9D9B98" stroke-linecap="round" stroke-linejoin="round"/>
</svg>
            Birthday</label>
            <span>${birthdayDisplay}</span>
        </div>

        <div class="pet-detail-item">
            <label>
          <svg fill="#9D9B98" width="15" height="15" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 61.13 61.13" xml:space="preserve" stroke="#000000" stroke-width="0.00061132" transform="matrix(-1, 0, 0, 1, 0, 0)"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" stroke="#CCCCCC" stroke-width="2.689808"></g><g id="SVGRepo_iconCarrier"> <path d="M27.482,34.031v12.317h-6.92c-1.703,0-3.084,1.381-3.084,3.084s1.381,3.084,3.084,3.084h6.92v5.531 c0,1.703,1.381,3.084,3.084,3.084s3.084-1.381,3.084-3.084v-5.531h6.92c1.703,0,3.084-1.381,3.084-3.084s-1.381-3.084-3.084-3.084 h-6.92V34.031c7.993-1.458,14.072-8.467,14.072-16.874C47.723,7.697,40.026,0,30.566,0c-9.46,0-17.157,7.697-17.157,17.157 C13.409,25.564,19.489,32.573,27.482,34.031z M30.566,6.169c6.059,0,10.988,4.929,10.988,10.988s-4.929,10.988-10.988,10.988 s-10.988-4.929-10.988-10.988S24.507,6.169,30.566,6.169z"></path> </g></svg>
 Sex
            </label>
            <span>${details.sex ? details.sex.charAt(0).toUpperCase() + details.sex.slice(1) : 'Not provided'}</span>
        </div>
        <div class="pet-detail-item full-width">
            <label>
            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="16" viewBox="0 0 15 16" fill="none">
  <path d="M13.5905 8.11123L13.9601 6.73016C14.3918 5.1182 14.6084 4.31257 14.4462 3.61489C14.3176 3.0641 14.0285 2.56382 13.6155 2.17734C13.093 1.68768 12.2866 1.4718 10.6747 1.04003C9.0627 0.607553 8.25636 0.391671 7.55939 0.55394C7.0086 0.682549 6.50833 0.971618 6.12185 1.38458C5.70224 1.83207 5.4835 2.48758 5.15824 3.67851L4.98382 4.32544L4.61425 5.70651C4.18177 7.31847 3.96589 8.1241 4.12816 8.82178C4.25677 9.37257 4.54584 9.87285 4.9588 10.2593C5.48135 10.749 6.28769 10.9649 7.89966 11.3974C9.35221 11.7862 10.1507 12 10.8048 11.9192C10.8763 11.9101 10.9463 11.8977 11.0149 11.882C11.5655 11.7538 12.0658 11.4652 12.4525 11.0528C12.9421 10.5295 13.158 9.7232 13.5905 8.11123Z" stroke="#9D9B98"/>
  <path d="M10.8047 11.9191C10.6553 12.3769 10.3927 12.7895 10.0413 13.1186C9.51875 13.6083 8.71241 13.8242 7.10045 14.2559C5.48848 14.6877 4.68214 14.9043 3.98517 14.7413C3.43447 14.6129 2.9342 14.3241 2.54763 13.9114C2.05796 13.3888 1.84137 12.5825 1.4096 10.9705L1.04003 9.58946C0.607553 7.9775 0.391671 7.17116 0.55394 6.47419C0.682549 5.9234 0.971618 5.42313 1.38458 5.03665C1.90713 4.54698 2.71347 4.3311 4.32544 3.89862C4.62948 3.81665 4.90708 3.74302 5.15823 3.67773" stroke="#9D9B98"/>
  <path d="M7.48927 6.21924L10.9419 7.14424M6.93384 8.29084L9.00544 8.84556" stroke="#9D9B98" stroke-linecap="round"/>
</svg>
            Notes</label>
            <span>${details.notes || 'No notes added'}</span>
        </div>
    `;
        }
        // Function to toggle between form and display
        function toggleFormDisplay(showDisplay = true) {
            if (showDisplay) {
                petDetailsForm.classList.add('hidden');
                petDetailsDisplay.classList.add('active');
                petFormBtns.style.display = 'none';
            } else {
                petDetailsForm.classList.remove('hidden');
                petDetailsDisplay.classList.remove('active');
                petFormBtns.style.display = 'block';
                // Populate form with saved data and restore photo preview
                populateFormWithSavedData();
            }
        }

        // Populate form fields with saved pet details
        function populateFormWithSavedData() {
            const savedPetDetails = sessionStorage.getItem('petDetails');
            if (!savedPetDetails) return;

            try {
                const details = JSON.parse(savedPetDetails);

                // Populate pet name
                const petNameInput = document.getElementById('petName');
                if (petNameInput) petNameInput.value = details.name || '';

                // Populate pet type
                const petTypeInput = document.getElementById('petTypeInput');
                if (petTypeInput) petTypeInput.value = details.type || '';

                // Populate pet breed
                const petBreedSelect = document.getElementById('petBreedSelect');
                if (petBreedSelect && details.breed) {
                    // First populate the options if needed
                    if (petBreedsData.petTypes) {
                        const selectedType = petBreedsData.petTypes.find(pt => pt.name === details.type);
                        if (selectedType) {
                            populateBreeds(selectedType);
                        }
                    }
                    if (petBreedSelect._fursDD) {
                        petBreedSelect._fursDD.setValue(details.breed);
                    } else {
                        petBreedSelect.value = details.breed;
                    }
                }

                // Populate pet birthday
                const petBirthdayInput = document.querySelector('input[name="birthday"]');
                if (petBirthdayInput) petBirthdayInput.value = details.birthday || '';

                // Populate pet sex
                const petSexInputs = document.querySelectorAll('input[name="sex"]');
                if (petSexInputs.length > 0 && details.sex) {
                    petSexInputs.forEach(input => {
                        input.checked = input.value === details.sex;
                    });
                }

                // Populate pet weight
                const petWeightInput = document.getElementById('petWeight');
                if (petWeightInput) petWeightInput.value = details.weight || '';

                // Populate pet notes
                const petNotesInput = document.getElementById('petNotes');
                if (petNotesInput) petNotesInput.value = details.notes || '';

                // Restore photo if available
                if (details.photo) {
                    petPhotoBase64 = details.photo;
                    displayPetPhotoPreview(petPhotoBase64);
                }
            } catch (e) {
                console.error('Error populating form with saved details:', e);
            }
        }

        petFormSaveBtn.addEventListener('click', function () {
            const petDetails = collectPetDetails();

            if (!petDetails.name) {
                alert('Please enter pet name');
                return;
            }

            sessionStorage.setItem('petDetails', JSON.stringify(petDetails));

            toggleFormDisplay(true);      // show the display div FIRST
            displayPetDetails(petDetails); // THEN inject content including photo
        });

        // Cancel button click handler
        petFormCancelBtn.addEventListener('click', function () {
            if (confirm('Are you sure you want to cancel? Any unsaved changes will be lost.')) {
                // Check if there's saved pet details in sessionStorage
                const savedPetDetails = sessionStorage.getItem('petDetails');

                if (savedPetDetails) {
                    // If there's saved data, just return to the display view
                    toggleFormDisplay(true);
                } else {
                    // If no saved data, clear all form fields
                    const petNameInput = document.getElementById('petName');
                    if (petNameInput) petNameInput.value = '';

                    const petBirthdayInput = document.querySelector('input[name="birthday"]');
                    if (petBirthdayInput) petBirthdayInput.value = '';

                    const petTypeInput = document.getElementById('petTypeInput');
                    if (petTypeInput) petTypeInput.value = '';

                    const petBreedSelect = document.getElementById('petBreedSelect');
                    if (petBreedSelect) {
                        if (petBreedSelect._fursDD) {
                            petBreedSelect._fursDD.setValue('');
                        } else {
                            petBreedSelect.value = '';
                        }
                    }

                    document.querySelectorAll('input[name="sex"]').forEach(input => input.checked = false);

                    const petWeightInput = document.getElementById('petWeight');
                    if (petWeightInput) petWeightInput.value = '4';

                    const petNotesInput = document.getElementById('petNotes');
                    if (petNotesInput) petNotesInput.value = '';

                    // Clear photo
                    petPhotoBase64 = null;
                    petPhotoInput.value = '';
                    petPhotoPlaceholder.style.display = 'block';
                }
            }
        });

        // Edit button click handler
        // Change button click handler
        petDisplayChangeBtn.addEventListener('click', function () {
            toggleFormDisplay(false);
        });

        // Check if there are existing pet details in sessionStorage on page load
        function checkSavedPetDetails() {
            const savedPetDetails = sessionStorage.getItem('petDetails');
            if (savedPetDetails) {
                try {
                    const petDetails = JSON.parse(savedPetDetails);

                    if (petDetails.photo) {
                        petPhotoBase64 = petDetails.photo;
                        displayPetPhotoPreview(petPhotoBase64);
                    }

                    toggleFormDisplay(true); // makes petDetailsDisplay visible FIRST
                    displayPetDetails(petDetails); // NOW inject photo into visible element

                } catch (e) {
                    console.error('Error parsing saved pet details:', e);
                }
            }
        }

        // Run on DOM ready
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', checkSavedPetDetails);
        } else {
            checkSavedPetDetails();
        }
        // ===== End Pet Details Storage & Display =====


document.addEventListener('DOMContentLoaded', function() {
    const addNewPetBtn = document.getElementById('addNewPetBtn');
    const petActionBtns = document.getElementById('petActionBtns');
    const petDetailsForm = document.querySelector('.pet-details-form');
    const petList = document.getElementById('petList');
    const petFormCancelBtn = document.getElementById('petFormCancelBtn');
    
    if (addNewPetBtn) {
        addNewPetBtn.addEventListener('click', function() {
            petActionBtns.style.display = 'none';
            if (petList) petList.classList.remove('visible');
            if (petDetailsForm) {
                petDetailsForm.classList.remove('hidden');
            }
        });
    }

    if (petFormCancelBtn) {
        petFormCancelBtn.addEventListener('click', function() {
            setTimeout(() => {
                const savedPetDetails = sessionStorage.getItem('petDetails');
                if (!savedPetDetails) {
                    petDetailsForm.classList.add('hidden');
                    petActionBtns.style.display = 'flex';
                }
            }, 10);
        });
    }
    
    const petDisplayChangeBtn = document.getElementById('petDisplayChangeBtn');
    if (petDisplayChangeBtn) {
        petDisplayChangeBtn.addEventListener('click', function () {
            petActionBtns.style.display = 'none';
        });
    }
});


        document.querySelectorAll('.input-wrap.select-wrap select').forEach(select => {
            const wrap = select.closest('.input-wrap.select-wrap');
            let isOpen = false;

            select.addEventListener('mousedown', function () {
                if (isOpen) {
                    wrap.classList.remove('open');
                    isOpen = false;
                } else {
                    wrap.classList.add('open');
                    isOpen = true;
                }
            });

            select.addEventListener('blur', function () {
                setTimeout(() => {
                    if(wrap) wrap.classList.remove('open');
                    isOpen = false;
                }, 100);
            });

            select.addEventListener('change', function () {
                wrap.classList.remove('open');
                isOpen = false;
            });
        });

</script>
</body>

</html>