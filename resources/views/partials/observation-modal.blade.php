<div class="modal fade modal-primary" data-backdrop="static" id="observation-modal" tabindex="-1" aria-labelledby="title-observation-modal" aria-hidden="true">
  <div class="modal-dialog modal-sm modal-dialog-centered modal-primary">
    <div class="modal-content" id="observation-modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="title-observation-modal">Modifier l'observation</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="/{{strtolower(Auth::user()->role)}}/couriers/observation" method="post" id="observation-form">
        @csrf

          <div class="form-group m-0" style="padding: 0 2px;">
            <label for="observation" class="col-form-label" id="label-observation-modal">Indiquer votre observation</label>
            <textarea maxlength="100" class="form-control" name="observation" id="observation"></textarea>
          </div>

        </form>
      </div>
      <div class="modal-footer d-flex justify-content-between">
        <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Annuler</button>
        <button id="btn-observation-doc" type="button" class="btn btn-sm btn-primary btn-card-block-overlay">Valider</button>
      </div>
    </div>
  </div>
</div>