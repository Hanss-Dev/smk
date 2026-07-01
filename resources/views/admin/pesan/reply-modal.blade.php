<!-- Modal Balas Pesan -->
<div class="modal fade" id="replyModal" tabindex="-1" role="dialog" aria-labelledby="replyModalLabel" aria-hidden="true"
     data-reply-url-template="{{ route('admin.pesan.replyEmail', ':id') }}"
     data-mark-read-url-template="{{ route('admin.pesan.markRead', ':id') }}">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content shadow-lg border-0 rounded-lg">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="replyModalLabel">
          <i class="fas fa-reply mr-2"></i>Balas Pesan dari <span id="reply-nama-title" class="font-weight-bold"></span>
        </h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="replyForm" method="POST" action="">
        @csrf
        <div class="modal-body">
          <!-- Alert status for AJAX -->
          <div id="reply-alert" class="alert d-none shadow-sm" role="alert"></div>

          <!-- Pilihan Media Balas -->
          <div class="form-group mb-4">
            <label class="font-weight-bold text-secondary">Metode Pengiriman Balasan</label>
            <div class="row">
              <div class="col-md-6 mb-2">
                <div class="card h-100 border p-3 select-channel-card active-wa" id="card-wa" style="cursor: pointer; transition: all 0.2s ease;">
                  <div class="custom-control custom-radio">
                    <input type="radio" id="channel-wa" name="reply_channel" value="wa" class="custom-control-input" checked>
                    <label class="custom-control-label w-100 text-success font-weight-bold" for="channel-wa" style="cursor: pointer;">
                      <i class="fab fa-whatsapp fa-lg mr-2"></i> WhatsApp (WA)
                    </label>
                  </div>
                  <small class="text-muted mt-2 ml-4">Kirim balasan langsung ke aplikasi/web WhatsApp tujuan.</small>
                </div>
              </div>
              <div class="col-md-6 mb-2">
                <div class="card h-100 border p-3 select-channel-card" id="card-email" style="cursor: pointer; transition: all 0.2s ease;">
                  <div class="custom-control custom-radio">
                    <input type="radio" id="channel-email" name="reply_channel" value="email" class="custom-control-input">
                    <label class="custom-control-label w-100 text-danger font-weight-bold" for="channel-email" style="cursor: pointer;">
                      <i class="fas fa-envelope fa-lg mr-2"></i> Email Resmi
                    </label>
                  </div>
                  <small class="text-muted mt-2 ml-4">Kirim balasan menggunakan mailer server website.</small>
                </div>
              </div>
            </div>
          </div>

          <!-- Section untuk WhatsApp -->
          <div id="section-wa" class="channel-section bg-light p-3 rounded mb-3 border">
            <div class="form-group">
              <label for="wa-number" class="font-weight-bold"><i class="fas fa-phone-alt text-success mr-1"></i> Nomor WhatsApp / HP</label>
              <input type="text" class="form-control form-control-lg" id="wa-number" name="wa_number" placeholder="Contoh: 08123456789">
              <small class="form-text text-muted">Nomor telepon pengirim otomatis diformat untuk kecocokan WhatsApp Web/App.</small>
            </div>
          </div>

          <!-- Section untuk Email -->
          <div id="section-email" class="channel-section d-none bg-light p-3 rounded mb-3 border">
            <div class="form-group">
              <label for="email-address" class="font-weight-bold"><i class="fas fa-envelope text-danger mr-1"></i> Alamat Email Penerima</label>
              <input type="email" class="form-control form-control-lg" id="email-address" name="email" placeholder="Contoh: pengirim@email.com">
            </div>
            <div class="form-group">
              <label for="email-subject" class="font-weight-bold"><i class="fas fa-heading text-info mr-1"></i> Subjek Email</label>
              <input type="text" class="form-control" id="email-subject" name="subject" value="Balasan Pesan - SMK Mitra Industri MM2100">
            </div>
          </div>

          <!-- Riwayat Pesan Asli (Collapse/Read-only) -->
          <div class="card card-outline card-secondary bg-light mb-3">
            <div class="card-header py-2" style="cursor: pointer;" data-toggle="collapse" data-target="#originalMessageCollapse">
              <span class="font-weight-bold text-muted text-sm">
                <i class="fas fa-info-circle mr-1"></i> Detail Pesan Asli
              </span>
              <span class="float-right text-muted" id="collapse-chevron"><i class="fas fa-chevron-down"></i></span>
            </div>
            <div id="originalMessageCollapse" class="collapse">
              <div class="card-body p-3 text-sm text-secondary bg-white rounded-bottom" id="original-message-text" style="max-height: 150px; overflow-y: auto; white-space: pre-line;">
              </div>
            </div>
          </div>

          <!-- Isi Balasan -->
          <div class="form-group">
            <label for="reply-message" class="font-weight-bold text-secondary">
              <i class="fas fa-edit mr-1"></i> Isi Pesan Balasan
            </label>
            <textarea class="form-control shadow-sm" id="reply-message" name="message" rows="5" placeholder="Tulis balasan pesan di sini..." required></textarea>
          </div>
        </div>

        <div class="modal-footer bg-light">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">
            <i class="fas fa-times mr-1"></i> Batal
          </button>
          <button type="submit" id="btn-submit-reply" class="btn btn-success">
            <i class="fab fa-whatsapp mr-1"></i> Kirim via WhatsApp
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<style>
  .select-channel-card:hover {
    border-color: #007bff !important;
    background-color: #f8f9fa;
  }
  .select-channel-card.active-wa {
    border-color: #28a745 !important;
    background-color: #eafaf1;
    box-shadow: 0 4px 6px rgba(40, 167, 69, 0.1);
  }
  .select-channel-card.active-email {
    border-color: #dc3545 !important;
    background-color: #fdf2f2;
    box-shadow: 0 4px 6px rgba(220, 53, 69, 0.1);
  }
</style>
