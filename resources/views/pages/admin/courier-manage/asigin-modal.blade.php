<div class="modal fade modal-primary" data-backdrop="static" id="assign-doc-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm modal-dialog-centered modal-primary">
    <div class="modal-content" id="assign-modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Assignation du dossier à un service</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="/{{strtolower(Auth::user()->role)}}/couriers/assignment" method="post" id="assign-form">
        @csrf
          <div class="row px-1">
            <div class="col-md-3 col-3 m-0 p-0" style="padding: 0 3px">
              <div class="form-group m-0" style="padding: 0 2px;">
                <label for="courier_id" class="col-form-label text-nowrap">N° Dossier</label>
                <input readonly type="text" class="form-control" name="courier_id" id="courier_id">
              </div>
            </div>
            <div class="col-md-3 col-3 m-0 p-0" style="padding: 0 3px">
              <div class="form-group m-0" style="padding: 0 2px;">
                <label for="courier_nb" class="col-form-label text-nowrap">nb Pièce</label>
                <input readonly type="text" class="form-control" name="courier_nb" id="courier_nb">
              </div>
            </div>
            <div class="col-md-6 col-6 m-0 p-0" style="padding: 0 3px">
              <div class="form-group m-0" style="padding: 0 2px;">
                <label for="courier_cat" class="col-form-label">Categorie</label>
                <input readonly type="text" class="form-control" name="courier_cat" id="courier_cat">
              </div>
            </div>
          </div>
          <div class="form-group m-0" style="padding: 0 2px;">
            <label for="agent_id" class="col-form-label">Selectionner le service (Agent de traitement)</label>
            <select class="select2 form-control" id="agent_id" name="agent_id">
                <option value="">....</option>
                @foreach($agents as $agent)
                    <option value="{{$agent->id}}" > {{ $agent->personne->nom }}&nbsp;{{ $agent->personne->prenom }} </option>
                @endforeach
            </select>
          </div>
          <div class="form-group m-0" style="padding: 0 2px;">
            <label for="tache" class="col-form-label">Indiquer la tâche à éffectuer sur ce dossier</label>
            <textarea maxlength="100" class="form-control" name="tache" id="tache"></textarea>
          </div>
          <div class="container d-flex justify-content-between py-1 m-0">
            <button type="button" class="btn  btn-sm btn-secondary" data-dismiss="modal">Fermer</button>
            <button id="btn-assign-doc" type="submit" class="btn btn-sm  btn-primary btn-card-block-overlay">Valider</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade modal-primary" data-backdrop="static" id="confirm-reject-modal" tabindex="-1" aria-labelledby="title-reject-modal" aria-hidden="true">
  <div class="modal-dialog modal-sm modal-dialog-centered modal-primary">
    <div class="modal-content" id="confirm-reject-modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="title-reject-modal">Confirmation et raison</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="/{{strtolower(Auth::user()->role)}}/couriers/reject" method="post" id="reject-form">
        @csrf

          <div class="form-group m-0" style="padding: 0 2px;">
            <label for="reason" class="col-form-label" id="label-reject-modal">Indiquer la raison du rejet et/ou les modifications à aporter sur ce dossier</label>
            <textarea maxlength="100" class="form-control" name="reason" id="reason"></textarea>
          </div>

        </form>
      </div>
      <div class="modal-footer d-flex justify-content-between">
        <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Annuler</button>
        <button id="btn-reject-doc" type="button" class="btn btn-sm btn-primary btn-card-block-overlay">Valider</button>
      </div>
    </div>
  </div>
</div>
