<script>
function changeDealStatus(event) {
    let selected_text = event.options[event.selectedIndex].innerHTML;
    let selected_value = event.value;

    $.post("{{route('admin.change.deal.status')}}", {
        _token: "{{csrf_token()}}",
        status: selected_text,
        deal_id: selected_value
    }, function (response, status, xhr) {
    }).done(function (response) {
        $.each(response, function (key, value) {
            if (response.{{__('dashboard.success')}}) {
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
