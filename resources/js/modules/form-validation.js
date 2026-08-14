const INVALID_MESSAGE = 'Harap isi data terlebih dahulu';

function getFieldValue(field) {
  if (field.type === 'checkbox' || field.type === 'radio') {
    return field.checked ? 'checked' : '';
  }

  if (field.type === 'file') {
    return field.files && field.files.length ? field.files[0].name : '';
  }

  return field.value.trim();
}

function clearFieldError(field) {
  field.classList.remove('is-invalid', 'border-danger');
  field.setAttribute('aria-invalid', 'false');

  const feedback = field.parentElement?.querySelector('.invalid-feedback[data-field-error="true"]');
  if (feedback) {
    feedback.remove();
  }

  const formGroup = field.closest('.form-group');
  if (formGroup) {
    formGroup.classList.remove('has-error');
  }

  if (field.type === 'file') {
    const dropzone = formGroup?.querySelector('#dropzone, .dropzone');
    if (dropzone) {
      dropzone.classList.remove('border-danger');
      const dropzoneFeedback = dropzone.parentElement?.querySelector('.invalid-feedback[data-field-error="true"]');
      if (dropzoneFeedback) {
        dropzoneFeedback.remove();
      }
    }
  }
}

function showFieldError(field) {
  field.classList.add('is-invalid', 'border-danger');
  field.setAttribute('aria-invalid', 'true');

  const formGroup = field.closest('.form-group');
  if (formGroup) {
    formGroup.classList.add('has-error');
  }

  if (field.type === 'file') {
    const dropzone = formGroup?.querySelector('#dropzone, .dropzone');
    const targetZone = dropzone || field.parentElement || field;
    targetZone.classList.add('border-danger');
    if (dropzone) {
      dropzone.style.borderColor = '#dc3545';
    }
    const existingFeedback = targetZone.parentElement?.querySelector('.invalid-feedback[data-field-error="true"]');
    if (!existingFeedback) {
      const feedback = document.createElement('div');
      feedback.className = 'invalid-feedback d-block text-danger mt-2';
      feedback.setAttribute('data-field-error', 'true');
      feedback.textContent = INVALID_MESSAGE;
      if (dropzone) {
        dropzone.insertAdjacentElement('afterend', feedback);
      } else {
        targetZone.insertAdjacentElement('afterend', feedback);
      }
    }
    return;
  }

  const existingFeedback = field.parentElement?.querySelector('.invalid-feedback[data-field-error="true"]');
  if (!existingFeedback) {
    const feedback = document.createElement('div');
    feedback.className = 'invalid-feedback d-block';
    feedback.setAttribute('data-field-error', 'true');
    feedback.textContent = INVALID_MESSAGE;
    field.insertAdjacentElement('afterend', feedback);
  }
}

function isFieldEmpty(field) {
  if (!field.hasAttribute('required') && !field.dataset.validateRequired) {
    return false;
  }

  if (field.disabled) {
    return false;
  }

  if (field.type === 'hidden') {
    return false;
  }

  if (field.type === 'checkbox' || field.type === 'radio') {
    return !field.checked;
  }

  if (field.type === 'file' || field.dataset.validateRequired === 'true') {
    return getFieldValue(field) === '';
  }

  return getFieldValue(field) === '';
}

export function initFormValidation() {
  const forms = Array.from(document.querySelectorAll('form'));

  forms.forEach((form) => {
    if (form.closest('.login-box') || form.dataset.formValidationInitialized === 'true') {
      return;
    }

    if (!form.closest('.content-wrapper')) {
      return;
    }

    form.noValidate = true;
    form.setAttribute('novalidate', 'novalidate');
    form.dataset.formValidationInitialized = 'true';

    form.querySelectorAll('input[type=file][required]').forEach((field) => {
      field.dataset.validateRequired = 'true';
      field.required = false;
    });

    const clearFormAlert = () => {
      const alert = form.querySelector('.form-validation-alert');
      if (alert) {
        alert.remove();
      }
    };

    const showFormAlert = () => {
      clearFormAlert();
      const alert = document.createElement('div');
      alert.className = 'alert alert-danger form-validation-alert';
      alert.textContent = 'Data Anda belum lengkap. Mohon lengkapi semua field wajib sebelum melanjutkan.';
      form.insertAdjacentElement('afterbegin', alert);
    };

    form.querySelectorAll('input[required], textarea[required], select[required], input[data-validate-required="true"]').forEach((field) => {
      field.addEventListener('input', () => {
        if (!isFieldEmpty(field)) {
          clearFieldError(field);
        }
        clearFormAlert();
      });

      field.addEventListener('change', () => {
        if (!isFieldEmpty(field)) {
          clearFieldError(field);
        }
        clearFormAlert();
      });
    });

    form.addEventListener('submit', (event) => {
      const fields = Array.from(form.querySelectorAll('input[required], textarea[required], select[required], input[data-validate-required="true"]'));
      const invalidFields = [];

      form.querySelectorAll('.invalid-feedback[data-field-error="true"], .is-invalid, .border-danger').forEach((element) => {
        if (element.matches('.invalid-feedback[data-field-error="true"]')) {
          element.remove();
        } else {
          element.classList.remove('is-invalid', 'border-danger');
        }
      });

      form.querySelectorAll('#dropzone').forEach((dropzone) => {
        dropzone.classList.remove('border-danger');
        dropzone.style.borderColor = '';
      });

      clearFormAlert();

      fields.forEach((field) => {
        if (isFieldEmpty(field)) {
          showFieldError(field);
          invalidFields.push(field);
        } else {
          clearFieldError(field);
        }
      });

      if (invalidFields.length > 0) {
        event.preventDefault();
        event.stopPropagation();
        showFormAlert();

        const firstInvalid = invalidFields[0];
        if (firstInvalid) {
          const target = firstInvalid.type === 'file'
            ? firstInvalid.closest('.form-group') || firstInvalid
            : firstInvalid;

          if (typeof target.scrollIntoView === 'function') {
            target.scrollIntoView({ behavior: 'smooth', block: 'center' });
          }

          if (firstInvalid.type !== 'file' && typeof firstInvalid.focus === 'function') {
            firstInvalid.focus({ preventScroll: true });
          }
        }
      }
    });
  });
}
