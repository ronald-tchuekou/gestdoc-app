@if(Session::has('success'))
<!-- Modal -->
<div class="modal fade" id="alertSuccessDialog" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="alertSuccessDialogLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content ">
      <div class="modal-header">
        <h5 class="modal-title" id="alertSuccessDialogLabel">Formulaire non valide.</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
      </div>
    </div>
  </div>
</div>

@endif
