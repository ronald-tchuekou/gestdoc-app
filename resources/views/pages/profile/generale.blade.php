<div role="tabpanel" class="tab-pane @if(old('type') != 'password') active @else fade @endif" id="profile-vertical-general" aria-labelledby="profile-pill-general" aria-expanded="@if(old('type') != 'password') true @else false @endif ">
@if(old('type') != 'password')
    @include('errors.errors')
    @include('success.success')
@endif
    <div class="media">
        <a href="javascript:void(0);" class="mr-25">
            <img src="{{Auth::user()->profile}}" id="profile-upload-img" class="rounded mr-50" alt="profile image" height="80" width="80"/>
        </a>
        <div class="media-body mt-75 ml-1">
            <form method="post" action="/profile/upload-profile" enctype="multipart/form-data">
                <label for="profile-upload" class="btn btn-sm btn-outline-secondary text-dark mb-75 mr-75 waves-effect waves-float ">Changer</label>
                <input type="file" id="profile-upload" hidden="" name="profile" accept="image/*"/>
                <input type="text" hidden="" name="user_id" value="{{ Auth::user()->id }}"/>
                <button type="submit" class="btn btn-sm btn-primary mb-75 waves-effect">Valider</button>
                <p>Autorisé JPG, GIF or PNG. Taille max 800kB</p>
            </form>
        </div>
    </div>

    <div class="row">
    @if(Auth::user()->role == 'Agent')
        <div class="col-12 d-flex flex-row justify-content-center align-items-center">
            <label class="mx-1">Service de gestion :</label>
            <input disabled class="form-control w-25" value="{{Auth::user()->service->intitule}}"/>
        </div>
    @endif
        <div class="col-12 col-sm-6">
            <div class="form-group">
                <label>Nom :</label>
                <input disabled class="form-control" value="{{Auth::user()->personne->nom}}"/>
            </div>
        </div>
        <div class="col-12 col-sm-6">
            <div class="form-group">
                <label>Prenom :</label>
                <input disabled class="form-control" value="{{Auth::user()->personne->prenom}}"/>
            </div>
        </div>
        <div class="col-12 col-sm-6">
            <div class="form-group">
                <label>Téléphone :</label>
                <input disabled class="form-control" value="{{Auth::user()->personne->telephone}}"/>
            </div>
        </div>
        <div class="col-12 col-sm-6">
            <div class="form-group">
                <label>CNI :</label>
                <input disabled class="form-control" value="{{Auth::user()->personne->cni}}"/>
            </div>
        </div>
        <div class="col-12 col-sm-6">
            <div class="form-group">
                <label>E-mail :</label>
                <input disabled class="form-control" value="{{Auth::user()->personne->email}}"/>
            </div>
        </div>
        <div class="col-12 col-sm-6">
            <div class="form-group">
                <label>Localisation :</label>
                <input disabled class="form-control" value="{{Auth::user()->personne->localisation}}"/>
            </div>
        </div>
        <div class="col-12 col-sm-6">
            <div class="form-group">
                <label>Sexe :</label>
                <input disabled class="form-control" value="{{Auth::user()->personne->sexe}}"/>
            </div>
        </div>
        <div class="col-12 col-sm-6">
            <div class="form-group">
                <label>Situation matrimonial :</label>
                <input disabled class="form-control" value="{{Auth::user()->personne->status}}"/>
            </div>
        </div>
    </div>
</div>