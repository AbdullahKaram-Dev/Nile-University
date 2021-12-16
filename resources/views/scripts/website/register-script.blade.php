<script>
    $('#register-form').submit(function(action) {
        action.preventDefault();
        $("#submit-register").attr('disabled', 'disabled');
        $("#submit-register").val("{{ __('dashboard.registration_in_progress_please_wait') }}");
        let formData = new FormData($('#register-form')[0]);
        $.ajax({
            type: 'POST',
            url: "{{ url('register') }}",
            data: formData,
            processData: false,
            contentType: false,
            cache: false,

            success: function(data) {

                if (data.success === true) {
                    let successMessage =
                        "{{ __('dashboard.registration_completed_successfully_transfer_is_in_progress') }}";
                    successTitle = "{{ __('dashboard.success') }}";
                    toastr.info(successMessage, successTitle);
                    $("#info-alert").removeClass("d-none");
                    setTimeout(function() {
                        window.location = data.redirectUrl;
                    }, 2000);


                } else if (data.success === false) {
                    $("#submit-register").removeAttr('disabled');
                    $("#submit-register").val("{{ __('dashboard.register') }}");
                    $.each(data.error, function(key, value) {
                        $("#" + key).addClass("is-invalid");
                        toastr.error(value[0], key);
                    });
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
