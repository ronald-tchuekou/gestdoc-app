
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
            let user_id = parseInt('{{Auth::id()}}');
            var intervalID = -1;

            // intervalID = setInterval(() => {

            //     // GET THE HOSTNAME.
            //     let host = window.location;
            //     new ListenChange(current_account, user_id, intervalID);

            // }, 1000);
        });
    })(window, document, jQuery);
</script>

<!-- // About the home enter account. -->
@if($current_account == 'accueil')

<script>
    $(document).ready(function () {

        let init_courrier_table = document.querySelector('#accueil-init-courrier')

        if(init_courrier_table != null) {
            setInterval(() => {
    
                axios.get(HOST_BACKEND + "/{{$current_account}}/all-init-courriers/{{Auth::id()}}")
                    .then(response => {
                    
                        let result = response.data
    
                        if(response.data.record != null) {
                            let row = $(`#accueil-init-courrier tr[data-row="${result.record.id}"]`)
                            // remove the row.
                            $(row).remove()
                            toastr.info(`Le courrier N° ${result.record.id} à été ${result.context}`)
                        }
                        
                        console.log('The content of this page is reloaded.')
    
                        console.log('The response : ', response.data)
                    }).catch(reason => {
                        console.error(reason)
                    })
                    
            }, 10000);
        }

    })
</script>

@endif
