<div class="content-header-left col-md-9 col-12 mb-2">
    <div class="row breadcrumbs-top">
        <div class="col-12">
            @if($current_action != 'dashboard')
            <h2 class="content-header-title float-left mb-0"><?=ucwords($current_action);?></h2>
            @endif
            <div class="breadcrumb-wrapper">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"> <a href="/{{$current_account}}/dashboard">Dashboard</a> </li>
                    @if($current_action != 'dashboard')
                    <li class="breadcrumb-item">{{ $current_action }}</li>
                    @endif
                </ol>
            </div>
        </div>
    </div>
</div>