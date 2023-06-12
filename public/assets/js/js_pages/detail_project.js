function alertSet(type, title, message) {
  Command: toastr[type](message,
      title)

  toastr.options = {
      "closeButton": true,
      "debug": true,
      "newestOnTop": true,
      "progressBar": true,
      "positionClass": "toast-top-center",
      "preventDuplicates": true,
      "onclick": null,
      "showDuration": "300",
      "hideDuration": "1000",
      "timeOut": "5000",
      "extendedTimeOut": "1000",
      "showEasing": "swing",
      "hideEasing": "linear",
      "showMethod": "fadeIn",
      "hideMethod": "fadeOut"
  }

}

function buttonState(id, state, text = null) {
  var tombol = $(id);
  if (state == "enable") {
      tombol.prop("disabled", false);
      tombol.html(text == null ? "Submit" : text );
  } else {
      tombol.prop("disabled", true);
      tombol.html(`<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                  Loading...`);
  }

}

CKEDITOR.replace('editor1');

function copyLink() {
  var text = "{{ route('invite', $project->invite_code) }}";
  // Buat elemen textarea dinamis
  var textarea = document.createElement("textarea");
  textarea.value = text;
  textarea.style.position = "fixed"; // agar elemen tidak terlihat pada halaman
  document.body.appendChild(textarea);

  // Salin teks dari textarea ke clipboard
  textarea.select();
  document.execCommand("copy");

  // Hapus elemen textarea yang sudah tidak diperlukan
  document.body.removeChild(textarea);
  alertSet("success","Berhasil","Berhasil menyalin link undangan!")

}


