@if(session()->has('error'))
    <script>
        $(document).ready(function (){
            var errorMessage = "{{ session()->get('error') }}";
            var errorTitle = "{{__('dashboard.error')}}";
            toastr.error(errorMessage, errorTitle);
            playSoundError();
        });
    </script>
@endif

@if(session()->has('info'))
    <script>
        $(document).ready(function (){
        var infoMessage = "{{ session()->get('info') }}";
        var infoTitle = "{{__('dashboard.info_message')}}";
        toastr.info(infoMessage, infoTitle);
        playSoundSuccess();
        });
    </script>
@endif

@if(session()->has('warning'))
    <script>
        $(document).ready(function (){
        var warningMessage = "{{ session()->get('warning') }}";
        var warningTitle = "{{__('dashboard.warning')}}";
        toastr.warning(warningMessage, warningTitle);
        playSoundError();
        });
    </script>
@endif


@if(session()->has('success'))
    <script>
        $(document).ready(function (){
        var successMessage = "{{ session()->get('success') }}";
        var successTitle = "{{__('dashboard.success')}}";
        toastr.success(successMessage, successTitle);
        playSoundSuccess();
        });
    </script>
@endif
