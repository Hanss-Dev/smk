/**
 * modules/reply-modal.js
 * Handles: reply modal channel switching (WA/Email), opening the modal
 * with data from the clicked row, and AJAX submission.
 *
 * Required markup changes (see reply-modal.blade.php):
 *   <div id="replyModal"
 *        data-reply-url-template="{{ route('admin.pesan.replyEmail', ':id') }}"
 *        data-mark-read-url-template="{{ route('admin.pesan.markRead', ':id') }}">
 *
 * Uses jQuery ($) — already loaded globally in admin layout.
 */

export function initReplyModal() {
  const modal = document.getElementById('replyModal');
  if (!modal || typeof $ === 'undefined') return;

  const replyUrlTemplate = modal.dataset.replyUrlTemplate || '';
  const markReadUrlTemplate = modal.dataset.markReadUrlTemplate || '';

  bindOpenModal(replyUrlTemplate);
  bindChannelSwitch();
  bindCollapseChevron();
  bindFormSubmit(markReadUrlTemplate);
}

function buildUrl(template, id) {
  return template.replace(':id', id);
}

function cleanWhatsAppNumber(phone) {
  if (!phone) return '';
  let cleaned = phone.toString().replace(/\D/g, '');
  if (cleaned.startsWith('0')) {
    cleaned = '62' + cleaned.substring(1);
  } else if (cleaned.startsWith('8')) {
    cleaned = '62' + cleaned;
  }
  return cleaned;
}

function bindOpenModal(replyUrlTemplate) {
  $(document).on('click', '.btn-balas', function () {
    const id = $(this).data('id');
    const nama = $(this).data('nama');
    const email = $(this).data('email');
    const telepon = $(this).data('telepon');
    const pesan = $(this).data('pesan');

    $('#reply-nama-title').text(nama);
    $('#wa-number').val(telepon);
    $('#email-address').val(email);
    $('#original-message-text').text(pesan);
    $('#reply-message').val('');

    $('#reply-alert').addClass('d-none').removeClass('alert-success alert-danger').text('');

    const actionUrl = buildUrl(replyUrlTemplate, id);
    $('#replyForm').attr('action', actionUrl).attr('data-message-id', id);

    $('#replyModal').modal('show');
  });
}

function bindChannelSwitch() {
  $('input[name="reply_channel"]').on('change', function () {
    const val = $(this).val();

    $('.select-channel-card').removeClass('active-wa active-email');

    if (val === 'wa') {
      $('#card-wa').addClass('active-wa');
      $('#section-wa').removeClass('d-none');
      $('#section-email').addClass('d-none');
      $('#btn-submit-reply')
        .removeClass('btn-danger btn-primary')
        .addClass('btn-success')
        .html('<i class="fab fa-whatsapp mr-1"></i> Kirim via WhatsApp');
    } else {
      $('#card-email').addClass('active-email');
      $('#section-email').removeClass('d-none');
      $('#section-wa').addClass('d-none');
      $('#btn-submit-reply')
        .removeClass('btn-success btn-primary')
        .addClass('btn-danger')
        .html('<i class="fas fa-paper-plane mr-1"></i> Kirim via Email');
    }
  });

  $('#card-wa').on('click', () => $('#channel-wa').prop('checked', true).trigger('change'));
  $('#card-email').on('click', () => $('#channel-email').prop('checked', true).trigger('change'));
}

function bindCollapseChevron() {
  $('#originalMessageCollapse')
    .on('show.bs.collapse', function () {
      $('#collapse-chevron i').removeClass('fa-chevron-down').addClass('fa-chevron-up');
    })
    .on('hide.bs.collapse', function () {
      $('#collapse-chevron i').removeClass('fa-chevron-up').addClass('fa-chevron-down');
    });
}

function bindFormSubmit(markReadUrlTemplate) {
  $('#replyForm').on('submit', function (e) {
    const channel = $('input[name="reply_channel"]:checked').val();
    const id = $(this).attr('data-message-id');

    if (channel === 'wa') {
      e.preventDefault();
      submitWhatsApp(id, markReadUrlTemplate);
    } else {
      e.preventDefault();
      submitEmail.call(this);
    }
  });
}

function submitWhatsApp(id, markReadUrlTemplate) {
  const phoneInput = $('#wa-number').val();
  const cleanedPhone = cleanWhatsAppNumber(phoneInput);
  const message = $('#reply-message').val();

  if (!cleanedPhone) {
    alert('Nomor telepon/WhatsApp tidak boleh kosong.');
    return;
  }
  if (!message) {
    alert('Isi pesan balasan tidak boleh kosong.');
    return;
  }

  const waUrl = 'https://api.whatsapp.com/send?phone=' + encodeURIComponent(cleanedPhone) + '&text=' + encodeURIComponent(message);
  window.open(waUrl, '_blank');

  const markReadUrl = buildUrl(markReadUrlTemplate, id);

  $.ajax({
    url: markReadUrl,
    type: 'POST',
    data: { _token: $('input[name="_token"]').val() },
    success: () => {
      $('#replyModal').modal('hide');
      window.location.reload();
    },
    error: () => {
      $('#replyModal').modal('hide');
      window.location.reload();
    },
  });
}

function submitEmail() {
  const email = $('#email-address').val();
  const subject = $('#email-subject').val();
  const message = $('#reply-message').val();

  if (!email) return alert('Email penerima tidak boleh kosong.');
  if (!subject) return alert('Subjek email tidak boleh kosong.');
  if (!message) return alert('Isi pesan balasan tidak boleh kosong.');

  const btnSubmit = $('#btn-submit-reply');
  const originalBtnHtml = btnSubmit.html();

  btnSubmit.prop('disabled', true).html('<i class="fas fa-spinner fa-spin mr-1"></i> Mengirim...');
  $('#reply-alert').addClass('d-none').removeClass('alert-success alert-danger').text('');

  $.ajax({
    url: $(this).attr('action'),
    type: 'POST',
    data: {
      _token: $('input[name="_token"]').val(),
      email,
      subject,
      message,
    },
    success: (response) => {
      btnSubmit.prop('disabled', false).html(originalBtnHtml);
      $('#reply-alert')
        .removeClass('d-none alert-danger')
        .addClass('alert-success')
        .html('<i class="fas fa-check-circle mr-1"></i> ' + response.message);

      $('#reply-message').val('');

      setTimeout(() => {
        $('#replyModal').modal('hide');
        window.location.reload();
      }, 1500);
    },
    error: (xhr) => {
      btnSubmit.prop('disabled', false).html(originalBtnHtml);

      let errMsg = 'Gagal mengirim email balasan.';
      if (xhr.responseJSON && xhr.responseJSON.message) {
        errMsg = xhr.responseJSON.message;
      }

      $('#reply-alert')
        .removeClass('d-none alert-success')
        .addClass('alert-danger')
        .html('<i class="fas fa-exclamation-triangle mr-1"></i> ' + errMsg);
    },
  });
}