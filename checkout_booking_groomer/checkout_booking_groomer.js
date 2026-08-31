(function () {
  "use strict";

  const STEPS = ["Pet", "Service", "Extras", "Review", "Pay"];
  const SERVICE_PRICE = 40;

  let currentStep = 0;
  let petSubView = "choice";
  let selectedPetId = null;
  let newPetData = null;
  let selectedService = { name: "Full Groom", price: SERVICE_PRICE };
  let petBreedsData = {};
  let addressMode = "home"; // 'home' | 'different'
  let addressEditing = false;
  let appliedPromo = null;
  let promoDiscount = 0;
  let selectedPayMethod = null;

  const VALID_PROMOS = {
    PROMO25: 3,
  };

  const els = {
    stepItems: document.querySelectorAll(".cbg-step-item"),
    stepPanels: document.querySelectorAll(".cbg-step-panel"),
    continueWraps: {
      addNew: document.getElementById("cbgContinueAddNew"),
      selectExisting: document.getElementById("cbgContinueSelectExisting"),
      service: document.getElementById("cbgContinueService"),
      extras: document.getElementById("cbgContinueExtras"),
    },
    subPanels: {
      choice: document.getElementById("cbgPetChoice"),
      addNew: document.getElementById("cbgPetAddNew"),
      selectExisting: document.getElementById("cbgPetSelectExisting"),
    },
    summaryService: document.getElementById("cbgSummaryService"),
    summaryServiceName: document.getElementById("cbgSummaryServiceName"),
    summaryServiceItemPrice: document.getElementById("cbgSummaryServiceItemPrice"),
    summaryExtras: document.getElementById("cbgSummaryExtras"),
    summaryExtrasBadge: document.getElementById("cbgSummaryExtrasBadge"),
    summaryExtrasList: document.getElementById("cbgSummaryExtrasList"),
    summaryExtrasAccordion: document.getElementById("cbgSummaryExtrasAccordion"),
    summaryTotal: document.getElementById("cbgSummaryTotal"),
  };

  function getAddonsApi() {
    const root = document.getElementById("furs-addons-checkout");
    return root && root.fursAddons ? root.fursAddons : null;
  }

  function getAddonsTotal() {
    const api = getAddonsApi();
    return api ? api.getTotal() : 0;
  }

  function getAddonsCount() {
    const api = getAddonsApi();
    return api ? api.getSelected().length : 0;
  }

  function updateSummary() {
    const extrasTotal = getAddonsTotal();
    const extrasCount = getAddonsCount();
    const servicePriceText = "£" + selectedService.price.toFixed(2);
    const total = Math.max(
      0,
      selectedService.price + extrasTotal - promoDiscount,
    );

    if (els.summaryService) {
      els.summaryService.textContent = servicePriceText;
    }
    if (els.summaryServiceName) {
      els.summaryServiceName.textContent = selectedService.name;
    }
    if (els.summaryServiceItemPrice) {
      els.summaryServiceItemPrice.textContent = servicePriceText;
    }
    if (els.summaryExtrasAccordion) {
      const showExtras = extrasCount > 0;
      const divider = els.summaryExtrasAccordion.previousElementSibling;
      els.summaryExtrasAccordion.style.display = showExtras ? "" : "none";
      if (divider?.classList.contains("cbg-summary-divider")) {
        divider.style.display = showExtras ? "" : "none";
      }
    }
    if (els.summaryExtrasBadge) {
      els.summaryExtrasBadge.textContent = String(extrasCount);
      els.summaryExtrasBadge.style.display = extrasCount > 0 ? "" : "none";
    }
    if (els.summaryExtras) {
      els.summaryExtras.textContent = "£" + extrasTotal.toFixed(2);
    }
    if (els.summaryExtrasList) {
      const api = getAddonsApi();
      const addons = api ? api.getAddons() : [];
      els.summaryExtrasList.innerHTML = addons
        .map(
          (addon) =>
            `<li><span>${addon.name}</span><span>£${addon.price.toFixed(2)}</span></li>`,
        )
        .join("");
    }

    const promoDivider = document.getElementById("cbgSummaryPromoDivider");
    const promoLine = document.getElementById("cbgSummaryPromoLine");
    const promoAmount = document.getElementById("cbgSummaryPromo");
    const promoLabel = document.getElementById("cbgSummaryPromoLabel");
    if (promoDivider) promoDivider.hidden = !appliedPromo;
    if (promoLine) promoLine.style.display = appliedPromo ? "flex" : "none";
    if (promoAmount) promoAmount.textContent = "-£" + promoDiscount.toFixed(2);
    if (promoLabel && appliedPromo)
      promoLabel.textContent = "Promo (" + appliedPromo + ")";

    if (els.summaryTotal) {
      els.summaryTotal.textContent = "£" + total.toFixed(2);
    }

    updateExtrasFooter();
    updateReviewPricing();
    if (currentStep === 4) updatePayStep();
  }

  function updateExtrasFooter() {
    const count = getAddonsCount();
    const total = getAddonsTotal();
    const labelEl = document.getElementById("cbgExtrasSummaryLabel");
    const totalEl = document.getElementById("cbgExtrasSummaryTotal");

    if (labelEl) {
      labelEl.textContent = count + " Extra's & Add-ons selected";
    }
    if (totalEl) {
      totalEl.textContent = "£" + total.toFixed(2);
    }
  }

  window.handleCheckoutExtrasChange = function () {
    updateSummary();
    updateContinueState();
  };

  function showStep(stepIndex) {
    currentStep = stepIndex;

    els.stepPanels.forEach((panel, i) => {
      panel.classList.toggle("active", i === stepIndex);
    });

    els.stepItems.forEach((item, i) => {
      item.classList.remove("active", "completed");
      if (i < stepIndex) item.classList.add("completed");
      if (i === stepIndex) item.classList.add("active");

      const circle = item.querySelector(".cbg-step-circle");
      if (circle) circle.textContent = i < stepIndex ? "✓" : String(i + 1);
    });

    updateContinueState();

    if (stepIndex === 3) populateReview();
    if (stepIndex === 4) {
      updateSummary();
      updatePayStep();
      positionPayFooter();
    }

    window.scrollTo({ top: 0, behavior: "smooth" });
  }

  function showPetSubView(view) {
    petSubView = view;
    Object.keys(els.subPanels).forEach((key) => {
      if (els.subPanels[key]) {
        els.subPanels[key].classList.toggle("active", key === view);
      }
    });
    updateContinueState();
    window.scrollTo({ top: 0, behavior: "smooth" });
  }

  function getSelectedPetInfo() {
    if (newPetData) return newPetData;
    if (selectedPetId == null) return null;
    const card = document.querySelector(
      '.cbg-pet-card[data-pet-id="' + selectedPetId + '"]',
    );
    if (!card) return null;
    return {
      name: card.dataset.name,
      type: card.dataset.type,
      breed: card.dataset.breed,
      birthday: card.dataset.birthday,
      sex: card.dataset.sex,
      notes: card.dataset.notes,
    };
  }

  function getSelectedPetType() {
    const btn = document.querySelector("#cbgPetAddNew .pet-option.highlight");
    if (!btn) return "";
    const map = { cat: "Cat", dog: "Dog", other: "Other" };
    return map[btn.dataset.pet] || "";
  }

  function validateNewPetForm(showErrors) {
    const name = document.getElementById("cbgPetName");
    const birthday = document.querySelector(
      '#cbgPetAddNew input[name="birthday"]',
    );
    const breed = document.getElementById("cbgPetBreed");
    const sex = document.querySelector(
      '#cbgPetAddNew input[name="sex"]:checked',
    );
    const weight = document.getElementById("cbgPetWeight");
    const petType = getSelectedPetType();

    const valid = !!(
      name &&
      name.value.trim() &&
      birthday &&
      birthday.value &&
      petType &&
      breed &&
      breed.value &&
      sex &&
      weight &&
      weight.value
    );

    if (showErrors && !valid) {
      alert("Please fill in all required pet details before continuing.");
    }
    return valid;
  }

  function setContinueState(wrap, canContinue) {
    if (!wrap) return;
    const btn = wrap.querySelector("button");
    wrap.classList.toggle("active", canContinue);
    if (btn) btn.disabled = !canContinue;
  }

  function isServiceStepValid() {
    if (addressEditing) return false;
    if (addressMode === "home") return true;

    const input = document.getElementById("cbgDifferentAddressInput");
    const value = input ? input.value.trim() : "";
    if (!value) return false;

    const outOfArea =
      value.toLowerCase().includes("manchester") ||
      value.toLowerCase().includes("outside");
    const errorEl = document.getElementById("cbgAddressError");
    if (input) input.classList.toggle("error", outOfArea);
    if (errorEl) errorEl.hidden = !outOfArea;
    return !outOfArea;
  }

  function updateContinueState() {
    setContinueState(
      els.continueWraps.addNew,
      petSubView === "addNew" && validateNewPetForm(false),
    );
    setContinueState(
      els.continueWraps.selectExisting,
      petSubView === "selectExisting" && selectedPetId != null,
    );
    setContinueState(
      els.continueWraps.service,
      currentStep === 1 && isServiceStepValid(),
    );
    setContinueState(els.continueWraps.extras, currentStep === 2);
    updateConfirmPayState();
  }

  function updateConfirmPayState() {
    const btn = document.getElementById("cbgConfirmPayBtn");
    const terms = document.getElementById("cbgReviewTerms");
    if (!btn) return;
    const enabled = currentStep === 3 && terms?.checked;
    btn.disabled = !enabled;
    btn.classList.toggle("active", enabled);
  }

  function saveNewPetData() {
    const name = document.getElementById("cbgPetName").value.trim();
    const birthday = document.querySelector(
      '#cbgPetAddNew input[name="birthday"]',
    ).value;
    const type = getSelectedPetType();
    const breed = document.getElementById("cbgPetBreed").value;
    const sex =
      document.querySelector('#cbgPetAddNew input[name="sex"]:checked')
        ?.value || "";
    const weight = document.getElementById("cbgPetWeight").value;
    const notes = document.getElementById("cbgPetNotes").value.trim();

    newPetData = { name, birthday, type, breed, sex, weight, notes };
    selectedPetId = null;
  }

  function goForward(context) {
    if (currentStep === 0) {
      if (context === "addNew") {
        if (!validateNewPetForm(true)) return;
        saveNewPetData();
      } else if (context === "selectExisting") {
        if (selectedPetId == null) return;
        newPetData = null;
      } else {
        return;
      }
    }

    if (currentStep >= STEPS.length - 1) return;
    showStep(currentStep + 1);
  }

  function populateReview() {
    const pet = getSelectedPetInfo();
    const addons = getAddonsApi() ? getAddonsApi().getAddons() : [];

    document.getElementById("cbgReviewPetName").textContent = pet?.name || "—";
    document.getElementById("cbgReviewPetType").textContent = pet?.type || "—";
    document.getElementById("cbgReviewPetBreed").textContent =
      pet?.breed || "—";
    document.getElementById("cbgReviewServiceName").textContent =
      selectedService.name;

    const extrasList = document.getElementById("cbgReviewExtrasList");
    const extrasCard = document.getElementById("cbgReviewExtrasCard");
    if (extrasList) {
      extrasList.innerHTML = "";
      if (addons.length) {
        addons.forEach((a) => {
          const row = document.createElement("div");
          row.className = "cbg-review-extra-row";
          row.innerHTML =
            "<span>" +
            escapeHtml(a.name) +
            "</span><span>£" +
            a.price.toFixed(2) +
            "</span>";
          extrasList.appendChild(row);
        });
        extrasCard?.classList.remove("is-hidden");
      } else {
        extrasCard?.classList.add("is-hidden");
      }
    }

    updateReviewPricing();
    updateConfirmPayState();
  }

  function updateReviewPricing() {
    const extrasTotal = getAddonsTotal();
    const total = Math.max(
      0,
      selectedService.price + extrasTotal - promoDiscount,
    );

    const serviceEl = document.getElementById("cbgReviewServicePrice");
    const extrasEl = document.getElementById("cbgReviewExtrasPrice");
    const extrasLine = document.getElementById("cbgReviewExtrasLine");
    const promoLine = document.getElementById("cbgReviewPromoLine");
    const promoLabel = document.getElementById("cbgReviewPromoLabel");
    const promoAmount = document.getElementById("cbgReviewPromoAmount");
    const totalEl = document.getElementById("cbgReviewTotal");

    if (serviceEl)
      serviceEl.textContent = "£" + selectedService.price.toFixed(2);
    if (extrasEl) extrasEl.textContent = "£" + extrasTotal.toFixed(2);
    if (extrasLine)
      extrasLine.style.display = extrasTotal > 0 ? "flex" : "none";
    if (promoLine) promoLine.hidden = !appliedPromo;
    if (promoLabel && appliedPromo)
      promoLabel.textContent = "Promo (" + appliedPromo + ")";
    if (promoAmount) promoAmount.textContent = "-£" + promoDiscount.toFixed(2);
    if (totalEl) totalEl.textContent = "£" + total.toFixed(2);
  }

  function setPromoError(show) {
    const input = document.getElementById("cbgPromoInput");
    const errorEl = document.getElementById("cbgPromoError");
    if (errorEl) errorEl.hidden = !show;
    input?.classList.toggle("is-error", show);
  }

  function updatePromoUI() {
    const hasPromo = !!appliedPromo;

    document
      .getElementById("cbgReviewPromoEntry")
      ?.classList.toggle("is-hidden", hasPromo);
    const reviewApplied = document.getElementById("cbgReviewPromoApplied");
    if (reviewApplied) reviewApplied.hidden = !hasPromo;

    const sidebarPromo = document.getElementById("cbgSidebarPromo");
    if (sidebarPromo) sidebarPromo.hidden = !hasPromo;

    ["cbgReviewPromoAppliedCode", "cbgSidebarPromoCode"].forEach((id) => {
      const el = document.getElementById(id);
      if (el) el.textContent = appliedPromo || "";
    });
  }

  function applyPromoCode() {
    const input = document.getElementById("cbgPromoInput");
    const code = (input?.value || "").trim().toUpperCase();
    const discount = VALID_PROMOS[code];

    if (!code) {
      setPromoError(false);
      return;
    }

    if (!discount) {
      setPromoError(true);
      return;
    }

    appliedPromo = code;
    promoDiscount = discount;
    setPromoError(false);
    if (input) input.value = code;

    updatePromoUI();
    updateSummary();
  }

  function removePromoCode() {
    appliedPromo = null;
    promoDiscount = 0;

    const input = document.getElementById("cbgPromoInput");

    if (input) input.value = "";
    setPromoError(false);
    updatePromoUI();
    updateSummary();
  }

  function getPayableTotal() {
    return Math.max(
      0,
      selectedService.price + getAddonsTotal() - promoDiscount,
    );
  }

  function updatePayStep() {
    const total = getPayableTotal();
    const totalEl = document.getElementById("cbgPayTotalAmount");
    const payLabel = document.getElementById("cbgPayBtnLabel");

    if (totalEl) totalEl.textContent = "£" + total.toFixed(2);
    if (payLabel) payLabel.textContent = "Pay £" + total.toFixed(2);

    updatePayFieldValidation();
    updatePayButtonState();
  }

  function updatePayFieldValidation() {
    const fields = {
      firstName: document.getElementById("cbgPayFirstName"),
      lastName: document.getElementById("cbgPayLastName"),
      cardNumber: document.getElementById("cbgPayCardNumber"),
      expiry: document.getElementById("cbgPayExpiry"),
      cvv: document.getElementById("cbgPayCvv"),
      city: document.getElementById("cbgPayCity"),
      postcode: document.getElementById("cbgPayPostcode"),
    };

    Object.entries(fields).forEach(([key, input]) => {
      const wrap = document.querySelector('[data-pay-field="' + key + '"]');
      if (!wrap || !input) return;
      const valid = !!input.value.trim();
      wrap.classList.toggle("valid", valid);
    });
  }

  function isCardFormValid() {
    const ids = [
      "cbgPayFirstName",
      "cbgPayLastName",
      "cbgPayCardNumber",
      "cbgPayExpiry",
      "cbgPayCvv",
      "cbgPayCity",
      "cbgPayPostcode",
    ];
    return ids.every((id) => {
      const el = document.getElementById(id);
      return el && el.value.trim().length > 0;
    });
  }

  function updatePayHeading() {
    const heading = document.getElementById("cbgPayHeading");
    if (!heading) return;
    heading.textContent = selectedPayMethod
      ? "Confirm & Pay"
      : "Select Payment Method";
  }

  function updatePayButtonState() {
    const btn = document.getElementById("cbgPayBtn");
    if (!btn || currentStep !== 4) return;

    const canPay =
      !selectedPayMethod
        ? false
        : selectedPayMethod === "card"
          ? isCardFormValid()
          : true;
    btn.disabled = !canPay;
    btn.classList.toggle("active", canPay);
  }

  function scrollActivePayMethodIntoView() {
    if (currentStep !== 4) return;

    const activeMethod = document.querySelector(".cbg-pay-method.active");
    const head = activeMethod?.querySelector(".cbg-pay-method-head");
    if (!head) return;

    const stickyOffset = 100;
    const rect = head.getBoundingClientRect();
    const targetY = window.scrollY + rect.top - stickyOffset;

    window.scrollTo({
      top: Math.max(0, targetY),
      behavior: "smooth",
    });
  }

  function selectPayMethod(method) {
    const isSame = selectedPayMethod === method;
    selectedPayMethod = method;

    document.querySelectorAll(".cbg-pay-method").forEach((el) => {
      el.classList.toggle("active", el.dataset.payMethod === method);
    });

    updatePayHeading();
    positionPayFooter();
    updatePayButtonState();

    if (!isSame) {
      requestAnimationFrame(() => {
        requestAnimationFrame(scrollActivePayMethodIntoView);
      });
    }
  }

  function positionPayFooter() {
    const footer = document.getElementById("cbgPayFooter");
    const methods = document.getElementById("cbgPayMethods");
    const activeMethod = document.querySelector(".cbg-pay-method.active");
    if (!footer) return;

    if (activeMethod) {
      activeMethod.insertAdjacentElement("afterend", footer);
    } else if (methods) {
      methods.appendChild(footer);
    }
  }

  function setupPayStep() {
    document.querySelectorAll(".cbg-pay-method-head").forEach((head) => {
      head.addEventListener("click", (e) => {
        const method = head.closest(".cbg-pay-method")?.dataset.payMethod;
        if (!method) return;
        head.blur();
        selectPayMethod(method);
      });
    });

    document
      .getElementById("cbgPayBackBtn")
      ?.addEventListener("click", () => showStep(3));

    document.getElementById("cbgPayBtn")?.addEventListener("click", () => {
      const btn = document.getElementById("cbgPayBtn");
      const baseUrl = document.body.dataset.baseUrl || "";

      if (btn && !btn.disabled) {
        // alert('Payment processing demo — booking confirmed!');
        window.location.href =
          baseUrl + "/booking-groomer/booking_groomer_confirmed.php";
      }
    });

    [
      "cbgPayFirstName",
      "cbgPayLastName",
      "cbgPayCardNumber",
      "cbgPayExpiry",
      "cbgPayCvv",
      "cbgPayCity",
      "cbgPayPostcode",
    ].forEach((id) => {
      document.getElementById(id)?.addEventListener("input", () => {
        updatePayFieldValidation();
        updatePayButtonState();
      });
    });

    positionPayFooter();
  }

  function escapeHtml(str) {
    if (!str) return "";
    const div = document.createElement("div");
    div.textContent = str;
    return div.innerHTML;
  }

  function populateBreeds(petType) {
    const select = document.getElementById("cbgPetBreed");
    if (!select || !petBreedsData.petTypes) return;

    const typeData = petBreedsData.petTypes.find((t) => t.name === petType);
    select.innerHTML = '<option value="">Select a Breed</option>';

    if (typeData && typeData.breeds) {
      typeData.breeds.forEach((breed) => {
        const opt = document.createElement("option");
        opt.value = breed;
        opt.textContent = breed;
        select.appendChild(opt);
      });
    }

    if (select._fursDD) select._fursDD.refresh();
  }

  async function loadPetBreeds() {
    try {
      const baseUrl = document.body.dataset.baseUrl || "";
      const res = await fetch(baseUrl + "assets/data/pet-breeds.json");
      petBreedsData = await res.json();
    } catch (e) {
      console.error("Failed to load pet breeds", e);
    }
  }

  function setupPetTypeToggle() {
    document.querySelectorAll("#cbgPetAddNew .pet-option").forEach((btn) => {
      btn.addEventListener("click", () => {
        document
          .querySelectorAll("#cbgPetAddNew .pet-option")
          .forEach((b) => b.classList.remove("highlight"));
        btn.classList.add("highlight");
        const map = { cat: "Cat", dog: "Dog", other: "Other" };
        populateBreeds(map[btn.dataset.pet] || "Other");
        updateContinueState();
      });
    });
  }

  function setupNewPetValidation() {
    const fields = ["cbgPetName", "cbgPetBreed", "cbgPetWeight", "cbgPetNotes"];
    fields.forEach((id) => {
      const el = document.getElementById(id);
      if (el)
        el.addEventListener("input", () => {
          if (id === "cbgPetName") {
            document
              .getElementById("cbgPetNameWrap")
              ?.classList.toggle("valid", el.value.trim().length > 0);
          }
          updateContinueState();
        });
    });

    document
      .querySelectorAll('#cbgPetAddNew input[name="sex"]')
      .forEach((r) => {
        r.addEventListener("change", updateContinueState);
      });

    document
      .querySelector('#cbgPetAddNew input[name="birthday"]')
      ?.addEventListener("change", updateContinueState);
    document
      .getElementById("cbgPetBreed")
      ?.addEventListener("change", updateContinueState);
  }

  function setupWeightStepper() {
    const input = document.getElementById("cbgPetWeight");
    document.getElementById("cbgWeightMinus")?.addEventListener("click", () => {
      const val = Math.max(1, parseInt(input.value || 4, 10) - 1);
      input.value = val;
      updateContinueState();
    });
    document.getElementById("cbgWeightPlus")?.addEventListener("click", () => {
      const val = Math.min(99, parseInt(input.value || 4, 10) + 1);
      input.value = val;
      updateContinueState();
    });
  }

  function setupPetPhotoUpload() {
    const input = document.getElementById("cbgPetPhotoInput");
    const btn = document.getElementById("cbgPetPhotoBtn");
    const preview = document.getElementById("cbgPetPhotoPreview");
    const placeholder = document.getElementById("cbgPetPhotoPlaceholder");

    btn?.addEventListener("click", () => input?.click());
    input?.addEventListener("change", (e) => {
      const file = e.target.files[0];
      if (!file) return;
      const reader = new FileReader();
      reader.onload = (ev) => {
        preview.src = ev.target.result;
        preview.style.display = "block";
        placeholder.style.display = "none";
      };
      reader.readAsDataURL(file);
    });
  }

  function setupPetCards() {
    document.querySelectorAll(".cbg-pet-card").forEach((card) => {
      card.addEventListener("click", (e) => {
        if (e.target.closest(".btn-edit")) return;
        document
          .querySelectorAll(".cbg-pet-card")
          .forEach((c) => c.classList.remove("selected"));
        card.classList.add("selected");
        selectedPetId = card.dataset.petId;
        updateContinueState();
      });
    });
  }

  function showAddressPanel(panelId) {
    document
      .querySelectorAll(".cbg-address-panel")
      .forEach((p) => p.classList.remove("active"));
    document.getElementById(panelId)?.classList.add("active");
  }

  function toggleAddressEditUI() {
    const editing = addressEditing;
    document
      .getElementById("cbgServiceFooter")
      ?.classList.toggle("is-hidden", editing);
    document
      .getElementById("cbgAddressNormalView")
      ?.classList.toggle("is-hidden", editing);
  }

  function updateAddressFieldValidation() {
    const line1 = document.getElementById("cbgAddrLine1");
    const line2 = document.getElementById("cbgAddrLine2");
    const city = document.getElementById("cbgAddrCity");
    const postcode = document.getElementById("cbgAddrPostcode");

    document
      .getElementById("cbgAddrLine1Wrap")
      ?.classList.toggle("valid", !!line1?.value.trim());
    document
      .getElementById("cbgAddrLine2Wrap")
      ?.classList.toggle("valid", true);
    document
      .getElementById("cbgAddrCityWrap")
      ?.classList.toggle("valid", !!city?.value.trim());
    document
      .getElementById("cbgAddrPostcodeWrap")
      ?.classList.toggle("valid", !!postcode?.value.trim());
  }

  function isAddressEditValid() {
    const line1 = document.getElementById("cbgAddrLine1")?.value.trim();
    const city = document.getElementById("cbgAddrCity")?.value.trim();
    const postcode = document.getElementById("cbgAddrPostcode")?.value.trim();
    return !!(line1 && city && postcode);
  }

  function setAddressMode(mode) {
    addressMode = mode;
    addressEditing = false;

    document.querySelectorAll(".cbg-address-toggle-btn").forEach((btn) => {
      btn.classList.toggle("active", btn.dataset.addressMode === mode);
    });

    if (mode === "home") {
      showAddressPanel("cbgAddressHomePanel");
    } else {
      showAddressPanel("cbgAddressDifferentPanel");
    }
    toggleAddressEditUI();
    updateContinueState();
  }

  function openAddressEdit() {
    addressEditing = true;
    const homeText =
      document.getElementById("cbgHomeAddressText")?.textContent || "";
    const parts = homeText.split(",").map((s) => s.trim());

    document.getElementById("cbgAddrLine1").value = parts[0] || "";
    document.getElementById("cbgAddrLine2").value = "";
    document.getElementById("cbgAddrCity").value = parts[1] || "";
    document.getElementById("cbgAddrPostcode").value = parts[2] || "";

    showAddressPanel("cbgAddressEditPanel");
    updateAddressFieldValidation();
    toggleAddressEditUI();
    updateContinueState();
  }

  function saveAddressEdit() {
    if (!isAddressEditValid()) {
      updateAddressFieldValidation();
      return;
    }

    const line1 = document.getElementById("cbgAddrLine1").value.trim();
    const city = document.getElementById("cbgAddrCity").value.trim();
    const postcode = document.getElementById("cbgAddrPostcode").value.trim();
    const full = [line1, city, postcode].filter(Boolean).join(", ");

    document.getElementById("cbgHomeAddressText").textContent = full;
    addressEditing = false;
    showAddressPanel("cbgAddressHomePanel");
    toggleAddressEditUI();
    updateContinueState();
  }

  function cancelAddressEdit() {
    addressEditing = false;
    showAddressPanel(
      addressMode === "home"
        ? "cbgAddressHomePanel"
        : "cbgAddressDifferentPanel",
    );
    toggleAddressEditUI();
    updateContinueState();
  }

  function setupServiceStep() {
    document.getElementById("cbgServiceDetailName").textContent =
      selectedService.name + " – £" + selectedService.price;

    document.querySelectorAll(".cbg-address-toggle-btn").forEach((btn) => {
      btn.addEventListener("click", () =>
        setAddressMode(btn.dataset.addressMode),
      );
    });

    document
      .getElementById("cbgEditHomeBtn")
      ?.addEventListener("click", (e) => {
        e.stopPropagation();
        openAddressEdit();
      });

    document
      .getElementById("cbgAddressSaveBtn")
      ?.addEventListener("click", saveAddressEdit);
    document
      .getElementById("cbgAddressCancelBtn")
      ?.addEventListener("click", cancelAddressEdit);
    document
      .getElementById("cbgServiceBackBtn")
      ?.addEventListener("click", () => showStep(0));

    document
      .getElementById("cbgDifferentAddressInput")
      ?.addEventListener("input", updateContinueState);

    ["cbgAddrLine1", "cbgAddrLine2", "cbgAddrCity", "cbgAddrPostcode"].forEach(
      (id) => {
        document
          .getElementById(id)
          ?.addEventListener("input", updateAddressFieldValidation);
      },
    );
  }

  function setupExtrasStep() {
    document
      .getElementById("cbgExtrasBackBtn")
      ?.addEventListener("click", () => showStep(1));
  }

  function setupReviewStep() {
    document.querySelectorAll(".cbg-review-edit").forEach((btn) => {
      btn.addEventListener("click", () => {
        const step = parseInt(btn.dataset.reviewStep, 10);
        if (!isNaN(step)) showStep(step);
      });
    });

    document
      .getElementById("cbgReviewBackBtn")
      ?.addEventListener("click", () => showStep(2));

    document
      .getElementById("cbgConfirmPayBtn")
      ?.addEventListener("click", () => {
        const btn = document.getElementById("cbgConfirmPayBtn");
        if (btn && !btn.disabled) showStep(4);
      });

    document
      .getElementById("cbgPromoApplyBtn")
      ?.addEventListener("click", applyPromoCode);
    document
      .getElementById("cbgPromoInput")
      ?.addEventListener("keydown", (e) => {
        if (e.key === "Enter") {
          e.preventDefault();
          applyPromoCode();
        }
      });
    document
      .getElementById("cbgPromoInput")
      ?.addEventListener("input", () => setPromoError(false));
    document
      .getElementById("cbgRemovePromoBtn")
      ?.addEventListener("click", removePromoCode);
    document
      .getElementById("cbgReviewRemovePromoBtn")
      ?.addEventListener("click", removePromoCode);

    document
      .getElementById("cbgReviewTerms")
      ?.addEventListener("change", updateConfirmPayState);

    document.querySelectorAll(".cbg-review-accordion-head").forEach((head) => {
      head.addEventListener("click", () => {
        const accordion = head.closest(".cbg-review-accordion");
        accordion?.classList.toggle("open");
      });
    });

    document.querySelectorAll(".cbg-summary-accordion-head").forEach((head) => {
      head.addEventListener("click", () => {
        head.closest(".cbg-summary-accordion")?.classList.toggle("open");
      });
    });
  }

  function setupStepNavigation() {
    els.stepItems.forEach((item, i) => {
      item.addEventListener("click", () => {
        if (i < currentStep) showStep(i);
      });
    });
  }

  function init() {
    Object.values(els.continueWraps).forEach((wrap) => {
      wrap?.addEventListener("click", () => {
        if (wrap.classList.contains("active")) {
          goForward(wrap.dataset.continueContext);
        }
      });
    });

    document
      .getElementById("cbgAddNewPetBtn")
      ?.addEventListener("click", () => showPetSubView("addNew"));
    document
      .getElementById("cbgSelectExistingBtn")
      ?.addEventListener("click", () => showPetSubView("selectExisting"));
    document
      .getElementById("cbgPetAddNewBackBtn")
      ?.addEventListener("click", () => showPetSubView("choice"));
    document
      .getElementById("cbgPetSelectExistingBackBtn")
      ?.addEventListener("click", () => showPetSubView("choice"));

    setupPetTypeToggle();
    setupNewPetValidation();
    setupWeightStepper();
    setupPetPhotoUpload();
    setupPetCards();
    setupServiceStep();
    setupExtrasStep();
    setupReviewStep();
    setupPayStep();
    setupStepNavigation();

    loadPetBreeds().then(() => {
      populateBreeds("Other");
    });

    document
      .getElementById("furs-addons-checkout")
      ?.addEventListener("furs:addons:change", updateSummary);

    showStep(0);
    updateSummary();
    updateConfirmPayState();
    updatePromoUI();
    setTimeout(updateSummary, 400);
  }

  if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", init);
  } else {
    init();
  }
})();

const navheader = document.querySelector("header");

function updateHeader() {
  navheader.style.backgroundColor = window.scrollY > 10 ? "white" : "#FDFCF8";
}

window.addEventListener("scroll", updateHeader);
updateHeader();
