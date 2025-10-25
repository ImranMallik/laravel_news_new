<footer class="main-footer">
    <div class="footer-left">
        {{ __('Copyright') }} &copy; <span id="currentYear"></span>
        <div class="bullet"></div> <em>{{ __('Design By') }}</em> <strong>-- Imran Mallik</strong>
    </div>
    <div class="footer-right">

    </div>
</footer>
<script>
    document.getElementById("currentYear").textContent = new Date().getFullYear();
</script>
