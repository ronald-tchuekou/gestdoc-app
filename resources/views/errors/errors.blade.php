@if ($errors->any())
<!-- Modal -->
<div class="modal fade" id="alertDialog" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="alertDialogLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content ">
      <div class="modal-header">
        <h5 class="modal-title" id="alertDialogLabel">Formulaire non valide.</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
      </div>
    </div>
  </div>
</div>

@endif