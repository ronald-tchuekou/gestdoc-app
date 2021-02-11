<div role="tabpanel" class="tab-pane active" id="account-vertical-general" aria-labelledby="account-pill-general" aria-expanded="true">
    <div class="media">
        <a href="javascript:void(0);" class="mr-25">
        <img src="../images/portrait/small/avatar-s-11.jpg" id="account-upload-img" class="rounded mr-50" alt="profile image" height="80" width="80"/>
        </a>
        <div class="media-body mt-75 ml-1">
        <label for="account-upload" class="btn btn-sm btn-primary mb-75 mr-75 waves-effect waves-float waves-light">Upload</label>
        <input type="file" id="account-upload" hidden="" accept="image/*"/>
        <button class="btn btn-sm btn-outline-secondary mb-75 waves-effect">Reset</button>
        <p>Allowed JPG, GIF or PNG. Max size of 800kB</p>
        </div>
    </div>

    <form class="validate-form mt-2" novalidate="novalidate">
        <div class="row">
        <div class="col-12 col-sm-6">
            <div class="form-group">
            <label for="account-username">Username</label>
            <input type="text" class="form-control" id="account-username" name="username" placeholder="Username" value="johndoe"/>
            </div>
        </div>
        <div class="col-12 col-sm-6">
            <div class="form-group">
            <label for="account-name">Name</label>
            <input type="text" class="form-control" id="account-name" name="name" placeholder="Name" value="John Doe"/>
            </div>
        </div>
        <div class="col-12 col-sm-6">
            <div class="form-group">
            <label for="account-e-mail">E-mail</label>
            <input type="email" class="form-control" id="account-e-mail" name="email" placeholder="Email" value="granger007@hogward.com"/>
            </div>
        </div>
        <div class="col-12 col-sm-6">
            <div class="form-group">
            <label for="account-company">Company</label>
            <input type="text" class="form-control" id="account-company" name="company" placeholder="Company name" value="Crystal Technologies"/>
            </div>
        </div>
        <div class="col-12 mt-75">
            <div class="alert alert-warning mb-50" role="alert">
            <h4 class="alert-heading">Your email is not confirmed. Please check your inbox.</h4>
            <div class="alert-body">
                <a href="javascript: void(0);" class="alert-link">Resend confirmation</a>
            </div>
            </div>
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-primary mt-2 mr-1 waves-effect waves-float waves-light">Save changes</button>
            <button type="reset" class="btn btn-outline-secondary mt-2 waves-effect">Cancel</button>
        </div>
        </div>
    </form>
</div>