/**
 * Kaira E-Commerce - Profile & Photo Management Module
 */

(function () {
  'use strict';

  const STORAGE_KEY = 'kaira_user_profile';

  const DEFAULT_PROFILE = {
    avatar: 'images/insta-item1.jpg',
    firstName: 'Elena',
    lastName: 'Rostova',
    displayName: 'Elena Rostova',
    email: 'elena.rostova@example.com',
    phone: '+43 720 11 52 78',
    secondaryEmail: 'elena.backup@example.com',
    gender: 'Female',
    dob: '1995-06-15',
    bio: 'Fashion enthusiast & luxury lifestyle curator based in Vienna.',
    address: 'Kärntner Straße 18',
    city: 'Vienna',
    postalCode: '1010',
    country: 'Austria',
    currency: 'USD ($)',
    language: 'English',
    preferredStyle: 'Contemporary Luxury',
    topSize: 'S (EU 36)',
    bottomSize: 'EU 36',
    shoeSize: 'EU 38',
    emailNotif: true,
    smsNotif: false,
    orderNotif: true
  };

  // Load saved profile or fallback to defaults
  function getProfile() {
    try {
      const saved = localStorage.getItem(STORAGE_KEY);
      if (saved) {
        return { ...DEFAULT_PROFILE, ...JSON.parse(saved) };
      }
    } catch (e) {
      console.error('Error loading profile from localStorage:', e);
    }
    return { ...DEFAULT_PROFILE };
  }

  // Save profile to localStorage
  function saveProfile(data) {
    try {
      const current = getProfile();
      const updated = { ...current, ...data };
      localStorage.setItem(STORAGE_KEY, JSON.stringify(updated));
      updateUI(updated);
      showToast('Profile updated successfully!');
      return updated;
    } catch (e) {
      console.error('Error saving profile to localStorage:', e);
      showToast('Failed to save profile changes.', 'danger');
    }
  }

  // Update all UI elements with current profile data
  function updateUI(profile) {
    // 1. Update Avatars across the page
    const avatarImgs = document.querySelectorAll('.user-avatar-img');
    avatarImgs.forEach(img => {
      img.src = profile.avatar;
    });

    // 2. Update Header/Offcanvas User Info text
    const nameEls = document.querySelectorAll('.user-display-name');
    nameEls.forEach(el => {
      el.textContent = `${profile.firstName} ${profile.lastName}`.trim() || profile.displayName || 'Elena Rostova';
    });

    const emailEls = document.querySelectorAll('.user-display-email');
    emailEls.forEach(el => {
      el.textContent = profile.email || 'elena.rostova@example.com';
    });

    // 3. Update Form Inputs inside modalProfile if present
    const form = document.getElementById('formProfileDetails');
    if (form) {
      setInputValue(form, 'firstName', profile.firstName);
      setInputValue(form, 'lastName', profile.lastName);
      setInputValue(form, 'displayName', profile.displayName);
      setInputValue(form, 'email', profile.email);
      setInputValue(form, 'phone', profile.phone);
      setInputValue(form, 'secondaryEmail', profile.secondaryEmail);
      setInputValue(form, 'gender', profile.gender);
      setInputValue(form, 'dob', profile.dob);
      setInputValue(form, 'bio', profile.bio);
      setInputValue(form, 'address', profile.address);
      setInputValue(form, 'city', profile.city);
      setInputValue(form, 'postalCode', profile.postalCode);
      setInputValue(form, 'country', profile.country);
      setInputValue(form, 'currency', profile.currency);
      setInputValue(form, 'language', profile.language);
      setInputValue(form, 'preferredStyle', profile.preferredStyle);
      setInputValue(form, 'topSize', profile.topSize);
      setInputValue(form, 'bottomSize', profile.bottomSize);
      setInputValue(form, 'shoeSize', profile.shoeSize);

      setCheckboxValue(form, 'emailNotif', profile.emailNotif);
      setCheckboxValue(form, 'smsNotif', profile.smsNotif);
      setCheckboxValue(form, 'orderNotif', profile.orderNotif);
    }
  }

  function setInputValue(form, name, value) {
    const input = form.querySelector(`[name="${name}"]`);
    if (input) input.value = value || '';
  }

  function setCheckboxValue(form, name, value) {
    const input = form.querySelector(`[name="${name}"]`);
    if (input) input.checked = !!value;
  }

  // Toast Notification helper
  function showToast(message, type = 'success') {
    const toastEl = document.getElementById('profileToast');
    if (!toastEl) {
      alert(message);
      return;
    }
    const toastBody = toastEl.querySelector('.toast-body');
    if (toastBody) {
      toastBody.textContent = message;
    }
    toastEl.className = `toast align-items-center text-white bg-${type} border-0 show`;
    
    // Auto hide after 3.5s
    setTimeout(() => {
      toastEl.classList.remove('show');
    }, 3500);
  }

  // Process image file for avatar
  function handlePhotoUpload(file) {
    if (!file) return;

    if (!file.type.startsWith('image/')) {
      showToast('Please select a valid image file (JPG, PNG, WebP).', 'danger');
      return;
    }

    // Limit to 5MB
    if (file.size > 5 * 1024 * 1024) {
      showToast('Image size should be less than 5MB.', 'warning');
      return;
    }

    const reader = new FileReader();
    reader.onload = function (e) {
      const dataUrl = e.target.result;
      saveProfile({ avatar: dataUrl });
      showToast('Profile photo updated successfully!');
    };
    reader.readAsDataURL(file);
  }

  // Initialize event listeners
  document.addEventListener('DOMContentLoaded', function () {
    const profile = getProfile();
    updateUI(profile);

    // Photo input change listener
    const photoInput = document.getElementById('profilePhotoInput');
    if (photoInput) {
      photoInput.addEventListener('change', function (e) {
        if (e.target.files && e.target.files[0]) {
          handlePhotoUpload(e.target.files[0]);
        }
      });
    }

    // Drag & Drop for avatar dropzone
    const dropzone = document.getElementById('avatarDropzone');
    if (dropzone) {
      ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        dropzone.addEventListener(eventName, preventDefaults, false);
      });

      function preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
      }

      ['dragenter', 'dragover'].forEach(eventName => {
        dropzone.addEventListener(eventName, () => dropzone.classList.add('drag-active'), false);
      });

      ['dragleave', 'drop'].forEach(eventName => {
        dropzone.addEventListener(eventName, () => dropzone.classList.remove('drag-active'), false);
      });

      dropzone.addEventListener('drop', function (e) {
        const dt = e.dataTransfer;
        const files = dt.files;
        if (files && files[0]) {
          handlePhotoUpload(files[0]);
        }
      });
    }

    // Remove photo button listener
    const removePhotoBtn = document.getElementById('btnRemovePhoto');
    if (removePhotoBtn) {
      removePhotoBtn.addEventListener('click', function () {
        saveProfile({ avatar: DEFAULT_PROFILE.avatar });
        showToast('Profile photo reset to default.');
      });
    }

    // Preset avatar selector listener
    const presetBtns = document.querySelectorAll('.btn-preset-avatar');
    presetBtns.forEach(btn => {
      btn.addEventListener('click', function () {
        const src = this.getAttribute('data-avatar-src');
        if (src) {
          saveProfile({ avatar: src });
          showToast('Preset avatar selected!');
        }
      });
    });

    // Save profile form submission
    const formProfile = document.getElementById('formProfileDetails');
    if (formProfile) {
      formProfile.addEventListener('submit', function (e) {
        e.preventDefault();
        const formData = new FormData(formProfile);
        const updatedData = {
          firstName: formData.get('firstName'),
          lastName: formData.get('lastName'),
          displayName: formData.get('displayName'),
          email: formData.get('email'),
          phone: formData.get('phone'),
          secondaryEmail: formData.get('secondaryEmail'),
          gender: formData.get('gender'),
          dob: formData.get('dob'),
          bio: formData.get('bio'),
          address: formData.get('address'),
          city: formData.get('city'),
          postalCode: formData.get('postalCode'),
          country: formData.get('country'),
          currency: formData.get('currency'),
          language: formData.get('language'),
          preferredStyle: formData.get('preferredStyle'),
          topSize: formData.get('topSize'),
          bottomSize: formData.get('bottomSize'),
          shoeSize: formData.get('shoeSize'),
          emailNotif: formProfile.querySelector('[name="emailNotif"]')?.checked ?? false,
          smsNotif: formProfile.querySelector('[name="smsNotif"]')?.checked ?? false,
          orderNotif: formProfile.querySelector('[name="orderNotif"]')?.checked ?? false
        };

        saveProfile(updatedData);

        // Hide modal
        const modalEl = document.getElementById('modalProfile');
        if (modalEl && window.bootstrap && window.bootstrap.Modal) {
          const bsModal = window.bootstrap.Modal.getInstance(modalEl);
          if (bsModal) bsModal.hide();
        }
      });
    }

    // Password change form submission
    const formPassword = document.getElementById('formChangePassword');
    if (formPassword) {
      formPassword.addEventListener('submit', function (e) {
        e.preventDefault();
        const currentPass = formPassword.querySelector('[name="currentPassword"]').value;
        const newPass = formPassword.querySelector('[name="newPassword"]').value;
        const confirmPass = formPassword.querySelector('[name="confirmPassword"]').value;

        if (newPass !== confirmPass) {
          showToast('New passwords do not match.', 'danger');
          return;
        }

        if (newPass.length < 6) {
          showToast('Password should be at least 6 characters long.', 'warning');
          return;
        }

        formPassword.reset();
        showToast('Password changed successfully!', 'success');

        const modalEl = document.getElementById('modalProfile');
        if (modalEl && window.bootstrap && window.bootstrap.Modal) {
          const bsModal = window.bootstrap.Modal.getInstance(modalEl);
          if (bsModal) bsModal.hide();
        }
      });
    }
  });

  // Expose global helper to open profile modal to a specific tab
  window.openProfileTab = function (tabId) {
    const modalEl = document.getElementById('modalProfile');
    if (modalEl && window.bootstrap && window.bootstrap.Modal) {
      const bsModal = window.bootstrap.Modal.getOrCreateInstance(modalEl);
      bsModal.show();
      if (tabId) {
        const tabTrigger = document.querySelector(`#profileTabNav button[data-bs-target="${tabId}"]`);
        if (tabTrigger && window.bootstrap.Tab) {
          const tab = window.bootstrap.Tab.getOrCreateInstance(tabTrigger);
          tab.show();
        }
      }
    }
  };

  // Always scroll to top of home page on refresh & clear URL hash fragments (#blog)
  if ('scrollRestoration' in history) {
    history.scrollRestoration = 'manual';
  }
  window.addEventListener('beforeunload', function () {
    window.scrollTo(0, 0);
  });
  window.addEventListener('load', function () {
    if (window.location.hash) {
      history.replaceState(null, null, window.location.pathname);
    }
    setTimeout(function () {
      window.scrollTo(0, 0);
    }, 10);
  });

  // Product Quick View click handler
  document.addEventListener('click', function (e) {
    const productCard = e.target.closest('.product-item');
    if (productCard && !e.target.closest('.btn-wishlist')) {
      e.preventDefault();
      
      const img = productCard.querySelector('img.product-image') || productCard.querySelector('img');
      const title = productCard.querySelector('h5 a') || productCard.querySelector('h5');
      const price = productCard.querySelector('.text-decoration-none span') || productCard.querySelector('span');

      const modalEl = document.getElementById('modalQuickView');
      if (modalEl) {
        if (img) {
          const mainImg = modalEl.querySelector('#qvMainImage');
          if (mainImg) mainImg.src = img.src;
          const thumbs = modalEl.querySelectorAll('.qv-thumb-btn img');
          if (thumbs.length) thumbs[0].src = img.src;
        }
        if (title) {
          const mainTitle = modalEl.querySelector('#qvTitle');
          if (mainTitle) mainTitle.textContent = title.textContent.trim();
        }
        if (price) {
          const mainPrice = modalEl.querySelector('#qvPrice');
          if (mainPrice) mainPrice.textContent = price.textContent.trim();
        }

        const qtyInput = modalEl.querySelector('#qvQty');
        if (qtyInput) qtyInput.value = 1;

        if (window.bootstrap && window.bootstrap.Modal) {
          const bsModal = window.bootstrap.Modal.getOrCreateInstance(modalEl);
          bsModal.show();
        }
      }
    }
  });

  // Size Unit Toggle Handler (Inches vs Centimeters)
  window.toggleSizeUnits = function (unit) {
    const cells = document.querySelectorAll('#modalSizing .size-val');
    cells.forEach(function (cell) {
      if (unit === 'cm') {
        cell.textContent = cell.getAttribute('data-cm');
      } else {
        cell.textContent = cell.getAttribute('data-in');
      }
    });
  };

})();
