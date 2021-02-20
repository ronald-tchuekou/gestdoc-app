
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
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/notifyEventListener.js') }}"></script>

<script>
    (function (window, document, $) {
        $(document).ready(() => {

            let current_account = window.location.pathname.split('/')[1];
            let user_id = {{Auth::id()}};
            var intervalID = -1;

            intervalID = setInterval(() => {

                // GET THE HOSTNAME.
                let host = window.location;
                new ListenChange(current_account, user_id, intervalID);

            }, 1000);
        });
    })(window, document, jQuery);
</script>
