<script src="{{ asset('dist/js/tabler.min.js?1744816593') }}" defer></script>
<script src="{{ asset('preview/js/demo.min.js?1744816593') }}" defer></script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const alerts = document.querySelectorAll('.auto-dismiss');
        alerts.forEach(function(alert) {
            setTimeout(function() {
                alert.style.transition = "opacity 0.5s ease";
                alert.style.opacity = 0;

                setTimeout(function() {
                    alert.remove();
                }, 500);
            }, 3000);
        });
    });
</script>


<!-- Preloader -->
<script>
    $(document).ready(function() {
        $("#preloader").fadeOut("slow");

        $("form").on("submit", function() {
            $("#preloader").fadeIn();
        });

        $(document).ajaxStart(function() {
            $("#preloader").fadeIn();
        }).ajaxStop(function() {
            $("#preloader").fadeOut();
        });

        $(".download-link").on("click", function() {
            $("#preloader").fadeIn();

            setTimeout(function() {
                $("#preloader").fadeOut();
            }, 2000);
        });
    });
</script>

<!-- JS Pages -->
@stack('js')