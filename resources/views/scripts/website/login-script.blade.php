<script>
    $('#login-form').submit(function(action) {
        action.preventDefault();
        $("#submit-login").attr('disabled', 'disabled');
        $("#submit-login").val("{{ __('dashboard.login_in_progress_please_wait') }}");
        let formData = new FormData($('#login-form')[0]);
        $.ajax({
            type: 'POST',
            url: "{{ url('login') }}",
            data: formData,
            processData: false,
            contentType: false,
            cache: false,

            success: function(data) {

                if (data.success === true) {
                    let successMessage =
                        "{{ __('dashboard.login_completed_successfully_transfer_is_in_progress') }}";
                    successTitle = "{{ __('dashboard.success') }}";
                    toastr.info(successMessage, successTitle);
                    $("#login-wrong-message").text('');
                    $("#success-alert").removeClass("d-none");
                    setTimeout(function() {
                        window.location = data.redirectUrl;
                    }, 10000);


                } else if (data.success === false) {

                    $("#login-wrong-message").text(data.error);
                    $("#submit-login").removeAttr('disabled');
                    $("#submit-login").val("{{ __('dashboard.login') }}");
                    let errorTitle = "{{ __('dashboard.error') }}";
                    toastr.error(data.error, errorTitle);
                }
            },
            error: function() {

                let errorTitle = "{{ __('dashboard.error') }}";
                errorMessage = "{{ __('dashboard.oops_an_error_occurred') }}";
                toastr.error(errorMessage, errorTitle);
            }
        });

    });
</script>
