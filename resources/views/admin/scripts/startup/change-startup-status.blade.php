<script>
    function changeStartupStatus(startup_id, startup_status) {

        $.post("{{route('admin.change.startup.status')}}", {
            _token: "{{csrf_token()}}",
            startup_id: startup_id,
            startup_current_status: startup_status
        }, function (response, status, xhr) {
        }).done(function (response) {
            $.each(response, function (key, value) {
                if (response.{{__('dashboard.success')}}) {
                    $("#startups-datatable").DataTable().ajax.reload();
                    toastr.success(value, key);
                    playSoundSuccess();
                } else {
                    toastr.error(value, key);
                    playSoundError();
                }
            });

        }).fail(function (jqxhr, settings, ex) {

            let errorTitle = "{{__('dashboard.error')}}";
            let errorMessage = "{{__('dashboard.oops_an_error_occurred')}}";
            toastr.error(errorMessage, errorTitle);
            playSoundError();

        });

    }
</script>
