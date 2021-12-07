<script>

    $('#sector-info').submit(function (action) {
        action.preventDefault();
        let formData = new FormData($('#sector-info')[0]);

        $.ajax({

            type: 'POST',
            url: "{{route('sectors.store')}}",
            data: formData,
            processData: false,
            contentType: false,
            cache: false,

            success: function (data) {

                $.each(data, function (key, value) {
                    if (data.{{__('dashboard.success')}}) {
                        toastr.success(value, key);
                        playSoundSuccess();
                    } else {
                        key = key.replace(".", "_");
                        $("#" + key).addClass("is-invalid");
                        toastr.error(value, key);
                        playSoundError();
                    }
                });
            },
            error: function () {
                let errorTitle = "{{__('dashboard.error')}}";
                let errorMessage = "{{__('dashboard.oops_an_error_occurred')}}";
                toastr.error(errorMessage, errorTitle);
                playSoundError();
            }
        });

    });

</script>
