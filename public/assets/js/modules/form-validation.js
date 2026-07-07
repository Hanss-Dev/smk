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
    if (dropzone) {
      dropzone.classList.add('border-danger');
      const existingFeedback = dropzone.parentElement?.querySelector('.invalid-feedback[data-field-error="true"]');
      if (!existingFeedback) {
        const feedback = document.createElement('div');
        feedback.className = 'invalid-feedback d-block text-danger mt-2';
        feedback.setAttribute('data-field-error', 'true');
        feedback.textContent = INVALID_MESSAGE;
        dropzone.insertAdjacentElement('afterend', feedback);
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
  if (!field.hasAttribute('required')) {
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

    form.dataset.formValidationInitialized = 'true';

    form.querySelectorAll('input[required], textarea[required], select[required]').forEach((field) => {
      field.addEventListener('input', () => {
        if (!isFieldEmpty(field)) {
          clearFieldError(field);
        }
      });

      field.addEventListener('change', () => {
        if (!isFieldEmpty(field)) {
          clearFieldError(field);
        }
      });
    });

    form.addEventListener('submit', (event) => {
      const fields = Array.from(form.querySelectorAll('input[required], textarea[required], select[required]'));
      const invalidFields = [];

      form.querySelectorAll('.invalid-feedback[data-field-error="true"], .border-danger, .is-invalid').forEach((element) => {
        element.classList.remove('is-invalid', 'border-danger');
        if (element.matches('.invalid-feedback[data-field-error="true"]')) {
          element.remove();
        }
      });

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

        const firstInvalid = invalidFields[0];
        if (firstInvalid) {
          firstInvalid.focus({ preventScroll: true });
          firstInvalid.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }
      }
    });
  });
}
