
{{-- modal logout --}}
<div id="danger-alert-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content modal-filled bg-danger">
            <div class="modal-body">
                <div class="text-center">
                    <i class="dripicons-exit h1 text-white"></i>
                    <h4 class="mt-2 text-white">Keluar</h4>
                    <p class="text-white">Anda yakin akan Keluar!</p>
                    <a href="{{ route("logout") }}" class="btn btn-light my-2">Keluar</a>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

