
<nav class="navbar header-navbar navbar navbar-shadow align-items-center navbar-light navbar-expand fixed-top">
    <div class="navbar-wrapper">
        <div class="navbar-container content">
            <div class="navbar-collapse" id="navbar-mobile">
                <div class="mr-auto float-left bookmark-wrapper d-flex align-items-center">
                    <ul class="nav navbar-nav d-xl-none">
                        <li class="nav-item">
                            <a class="nav-link menu-toggle is-active" href="javascript:void(0);">
                            <i class="ficon feather icon-menu"></i>
                            </a>
                        </li>
                    </ul> 
                </div>

                <ul class="nav navbar-nav float-right">
                    
                    <li class="nav-item d-none d-lg-block"><a class="nav-link nav-link-expand"><i
                                class="ficon feather icon-maximize"></i></a>
                    </li>
                    
                    <li class="nav-item nav-search"><a class="nav-link nav-link-search"><i
                                class="ficon feather icon-search"></i></a>
                        <div class="search-input">
                            <div class="search-input-icon"><i class="feather icon-search primary"></i></div>
                            <input class="input" type="text" placeholder="Search GesCom..." tabindex="-1"
                                data-search="template-list">
                            <div class="search-input-close"><i class="feather icon-x"></i></div>
                            <ul class="search-list search-list-main"></ul>
                        </div>
                    </li>

                    @include('partials.notifications')

                    @include('partials.user')

                </ul>

            </div>
        </div>
    </div>
</nav>

<ul class="main-search-list-defaultlist-other-list d-none">
    <li class="auto-suggestion d-flex align-items-center justify-content-between cursor-pointer"><a
            class="d-flex align-items-center justify-content-between w-100 py-50">
            <div class="d-flex justify-content-start"><span class="mr-75 feather icon-alert-circle"></span><span>No
                    results found.</span></div>
        </a></li>
</ul>