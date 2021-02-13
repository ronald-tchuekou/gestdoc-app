<div class="tab-pane @if(old('type') == 'password') active @else fade @endif" id="account-vertical-password" role="tabpanel" aria-labelledby="account-pill-password" aria-expanded="@if(old('type') == 'password') true @else false @endif">
    <form method="post" novalidate="novalidate"  action="/profile/update-password">
        @csrf
        <div class="h3">Changer de mot de passe</div>
        @if(old('type') == 'password')
            @include('errors.errors')
            @include('success.success')
        @endif
        <div class="row">
            <div class="col-12 col-sm-6">
                <div class="form-group">
                    <label for="account-old-password">Ancien mot de passe : </label>
                    <input type="password" class="form-control" id="account-old-password" name="old_password" placeholder="Ancien mot de passe : "/>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-sm-6">
                <div class="form-group">
                    <label for="account-new-password">Nouveau mot de passe : </label>
                    <input type="password" id="account-new-password" name="new_password" class="form-control" placeholder="Nouveau mot de passe : "/>
                </div>
            </div>
            <div class="col-12 col-sm-6">
                <div class="form-group">
                    <label for="account-retype-new-password">Confirmé le nouveau mot de passe : </label>
                    <input type="password" class="form-control" id="account-retype-new-password" name="confirm_new_password" placeholder="Confirmé le nouveau mot de passe : "/>
                </div>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary mr-1 mt-1 waves-effect waves-float waves-light">Enregistrer</button>
                <button type="reset" class="btn btn-outline-secondary mt-1 waves-effect">Annuler</button>
            </div>
        </div>
    </form>
</div>