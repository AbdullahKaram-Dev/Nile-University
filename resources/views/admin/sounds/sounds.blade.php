<script>
    function playSoundSuccess() {
        const audio = new Audio("{{asset('sound/success-sound.mp3')}}");
        audio.play();
    }

    function playSoundError() {
        const audio = new Audio("{{asset('sound/error-sound.mp3')}}");
        audio.play();
    }
</script>
