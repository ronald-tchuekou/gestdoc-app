<li class="dropdown dropdown-user nav-item">
    <a class="nav-link" href="" data-toggle="dropdown">
        <i class="ficon feather icon-bell"></i>
        <span class="badge badge-pill badge-danger badge-up">5</span>
    </a>
    <ul class="dropdown-menu dropdown-menu-right" style="width: 350px;">
        <li class="dropdown-menu-header">
            <div class="dropdown-header d-flex">
                <h4 class="notification-title mb-0 mr-auto">Notifications</h4>
                <span class="badge badge-light-primary badge-pill"> 5 </span>
            </div>
        </li>
        <li class="ps-container scrollable-container media-list scroll-area ps hover">
        @for($i=0; $i<5; $i++)
            <a class="d-flex" href="">
                <div class="media d-flex align-items-start">
                    <div class="media-left">
                    <div class="avatar"><img src="/images/default_profile.png?w=100&h=100&fit=crop" alt="avatar" width="32" height="32"></div>
                    </div>
                    <div class="media-body">
                    <p class="media-heading"><span class="font-weight-bolder">Congratulation Sam 🎉</span>winner!</p><small class="notification-text"> Won the monthly best seller badge.</small>
                    </div>
                </div>
            </a>
        @endfor
        </li>
        <li class="dropdown-menu-footer m-1"><button type="button" class="btn btn-primary btn-block">Lire tous les notifications</button></li>
    </ul>
</li>
