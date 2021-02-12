<li class="dropdown dropdown-user nav-item">
    <a id="account" class="dropdown-toggle nav-link dropdown-user-link" href="/" data-toggle="dropdown">
        <div class="user-nav d-sm-flex d-none">
            <span class="user-name text-bold-600">{{ucwords(Auth::user()->personne->nom)}}</span>
            <span class="user-status">{{Auth::user()->login}}</span>
        </div>
        <span>
            <img class="round" src="{{$user->profile}}" alt="avatar" height="40" width="40">
        </span>
    </a>
    <div class="dropdown-menu dropdown-menu-right">
        <a class="dropdown-item" href="/{{$current_account}}/profile"><i class="feather icon-user"></i> Edit Profile</a>
        <a class="dropdown-item" href="/"><i class="feather icon-mail"></i> My Inbox</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="/loginOut"><i class="feather icon-power"></i> Logout</a>
    </div>
</li>