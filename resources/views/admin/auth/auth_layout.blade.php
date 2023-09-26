<!DOCTYPE html>
<html
  lang="en"
  class="light-style customizer-hide"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="/assets/admin/"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>{{ $pageTitle ?? '' }} | {{ $coreSetting['site_name'] ?? env('APP_NAME') }}</title>

    <meta name="description" content="" />

    <link rel="icon" type="image/x-icon" href="/assets/admin/img/favicon/favicon.ico" />

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="/assets/admin/vendor/fonts/boxicons.css" />
    <link rel="stylesheet" href="/assets/admin/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="/assets/admin/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="/assets/admin/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <link rel="stylesheet" href="/assets/admin/vendor/css/pages/page-auth.css" />
    <!-- Helpers -->
    <script src="/assets/admin/vendor/js/helpers.js"></script>

    <script src="/assets/admin/js/config.js"></script>
  </head>

  <body>
    <!-- Content -->
    <div class="container-xxl">
      <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
          @yield('contant')
        </div>
      </div>
    </div>

    <!-- / Content -->


    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="/assets/admin/vendor/libs/jquery/jquery.js"></script>
    <script src="/assets/admin/vendor/libs/popper/popper.js"></script>
    <script src="/assets/admin/vendor/js/bootstrap.js"></script>
    <script src="/assets/admin/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->

    <!-- Main JS -->
    <script src="/assets/admin/js/main.js"></script>

    <!-- Page JS -->

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
  </body>
</html>
