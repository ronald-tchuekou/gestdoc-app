
<div id="app-config" data-role="{{strtolower(Auth::user()->role)}}" data-user_id="{{Auth::id()}}"></div>

<!-- BEGIN: Vendor JS-->
<script src="{{asset('vendors/js/vendors.min.js')}}"></script>
<!-- BEGIN Vendor JS-->

<!-- BEGIN: Page Vendor JS-->
<script src="{{asset('vendors/js/charts/apexcharts.min.js')}}"></script>
<script src="{{asset('vendors/js/extensions/tether.min.js')}}"></script>
<script src="{{asset('vendors/js/extensions/shepherd.min.js')}}"></script>
<script src="{{asset('vendors/js/extensions/toastr.min.js')}}"></script>
<!-- END: Page Vendor JS-->

<!-- BEGIN: Theme JS-->
<script src="{{asset('js/core/app-menu.min.js')}}"></script>
<script src="{{asset('js/core/app.min.js')}}"></script>
<script src="{{asset('js/scripts/customizer.min.js')}}"></script>
<script src="{{asset('js/scripts/components.min.js')}}"></script>
<!-- END: Theme JS-->

<!-- BEGIN: Page JS-->
<script src="{{asset('js/scripts/pages/dashboard-analytics.js')}}"></script>
<script src="{{asset('js/scripts/pages/dashboard-ecommerce.js')}}"></script>
<script src="{{asset('js/scripts/extensions/toastr.min.js')}}"></script>
<!-- END: Page JS-->

<script src="{{ asset('js/axios.min.js') }}"></script>
<script src="{{ asset('js/rest.api.js') }}"></script>
<script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/services-manager.js') }}"></script>
<script src="{{ asset('js/categories-manager.js') }}"></script>
<script src="{{ asset('js/locations-manager.js') }}"></script>
<script src="{{ asset('js/notifyEventListener.js') }}"></script>

<script>
    var pusher = new Pusher("{{env('PUSHER_APP_KEY', 'b46572e408aed6297050')}}", {
        cluster: 'eu'
    });

    // Listen to channel with id account.
    var channel = pusher.subscribe('gestdoc-channel.{{Auth::id()}}');
    channel.bind('gestdoc-notify', function(data) {

        // Update the correspondant component.
        var action = data.courrier.action;

        axios.get(HOST_BACKEND + '/courrier/info/all/' + data.courrier.id)
        .then(response => {
            let status = response.status;
            if(status == 200){
                let courrier = response.data;
                if(default_user_role == "Accueil"){
                    accuiel_listener(action, courrier);
                }else if(default_user_role == 'Agent'){
                    agent_listener(courrier);
                }
            }
        })

        // Display the notification.
        setNotification(data)
    });

    // Listent to admin channel.
    var channel = pusher.subscribe('gestdoc-channel.{{strtolower(Auth::user()->role)}}');
    channel.bind('gestdoc-notify-admin', function(data) {

        // Update the correspondant component.
        var action = data.courrier.action;
        axios.get(HOST_BACKEND + '/courrier/info/all/' + data.courrier.id)
        .then(response => {
            let status = response.status;
            if(status == 200){
                let courrier = response.data;
                admin_listener(courrier, action);
            }
        })

        // Display the notification.
        setNotification(data)
    });

</script>
