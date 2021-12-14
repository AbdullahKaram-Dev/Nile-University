<script>
    $(document).ready(function () {
        let Li    = "{{request()->segment(2)}}";
        $("."+Li+" a").attr('aria-expanded',true);
        $("."+Li+" ul").addClass('show');
        console.log("request segment is : "+ Li);
    });
</script>
