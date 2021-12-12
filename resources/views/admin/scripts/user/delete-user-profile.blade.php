<script>
    function deleteUser(user_id) {

        $.post("{{route('admin.delete.user')}}", {
            user_id: user_id,
            _token:"{{csrf_token()}}"
        }, function (response, status, xhr) {
        }).done(function (response) {
            $.each(response, function (key, value) {
                if (response.{{__('dashboard.success')}}) {
                    $('#users-datatable').DataTable().ajax.reload();
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
