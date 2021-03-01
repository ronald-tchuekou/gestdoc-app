@extends('layouts.template')
 
@section('content')

<section>
    <div class="row">
        <div class="col-md-3 mb-2 mb-md-0">
            <ul class="nav nav-pills flex-column nav-left">
                <li class="nav-item">
                    <a class="nav-link @if(old('type') != 'password') active @endif  py-1" id="profile-pill-general" data-toggle="pill" href="#profile-vertical-general" aria-expanded="@if(old('type') != 'password') true @else false @endif">
                    <i class="feather icon-user"></i>&nbsp;&nbsp;&nbsp;
                        <span class="font-weight-bold">General</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(old('type') == 'password') active @endif py-1" id="account-pill-password" data-toggle="pill" href="#account-vertical-password" aria-expanded="@if(old('type') == 'password') true @else false @endif">
                    <i class="feather icon-lock"></i>&nbsp;&nbsp;&nbsp;
                        <span class="font-weight-bold">Mot de passe</span>
                    </a>
                </li>
                <!-- <li class="nav-item">
                    <a class="nav-link py-1" id="account-pill-notifications" data-toggle="pill" href="#account-vertical-notifications" aria-expanded="false">
                    <i class="feather icon-bell"></i>&nbsp;&nbsp;&nbsp;
                        <span class="font-weight-bold">Notifications</span>
                    </a>
                </li> -->
            </ul>
        </div>

        <div class="col-md-9">
            <div class="card">
                <div class="card-body">
                    <div class="tab-content">

                        @include('pages.profile.generale')

                        @include('pages.profile.password')

                        <!-- @include('pages.profile.notifications') -->

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endSection