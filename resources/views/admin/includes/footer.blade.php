 <!-- Footer -->
 <footer class="content-footer footer bg-footer-theme">
    <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
        <div class="mb-2 mb-md-0">
            ©
            <script>
                document.write(new Date().getFullYear());
            </script>
            <a href="{{ $coreSetting['site_url'] ?? env('APP_URL') }}" target="_blank" class="footer-link fw-bolder">{{ $coreSetting['site_name'] ?? env('APP_NAME') }}</a>, made with ❤️ by
            <a href="https://linkedin.com/in/ronakgiriraj" target="_blank" class="footer-link fw-bolder">ronakgiriraj</a>
        </div>
        <div>
            <a href="https://linkedin.com/in/ronakgiriraj"
                target="_blank" class="footer-link me-4">Question</a>

            <a href="https://instagram.com/ronakgiriraj" target="_blank"
                class="footer-link me-4">Support</a>
        </div>
    </div>
</footer>
<!-- / Footer -->
