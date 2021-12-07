<script>
    $("input").on('click', function() {
        $(this).removeClass("is-invalid");
    });
    $("textarea").keyup(function() {
        $(this).removeClass("is-invalid");
    });
</script>
