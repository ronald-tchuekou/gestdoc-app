@if(Auth::user()->role != 'AppAdmin')
<li class="dropdown dropdown-user nav-item">
    <a class="nav-link" href="" data-toggle="dropdown">
        <i class="ficon feather icon-bell"></i>
        <span class="badge badge-pill badge-danger badge-up noti">0</span>
    </a>
    <ul class="dropdown-menu dropdown-menu-right" style="width: 350px;">
        <li class="dropdown-menu-header">
            <div class="dropdown-header d-flex">
                <h4 class="notification-title mb-0 mr-auto">Notifications</h4>
                <span class="badge badge-light-primary badge-pill noti"> 0 </span>
            </div>
        </li>
        <li id="notify-list" class="ps-container scrollable-container media-list scroll-area ps hover">
        </li>
        <li class="dropdown-menu-footer m-1"><button type="button" class="btn btn-primary btn-block">Lire tous les notifications</button></li>
    </ul>
</li>
@endif