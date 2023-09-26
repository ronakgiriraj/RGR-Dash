<!DOCTYPE html>
<html lang="en" class="light-style layout-navbar-fixed layout-menu-fixed " dir="ltr" data-theme="theme-default"
    data-assets-path="/assets/admin/" data-template="vertical-menu-template-starter">

<head>
    <meta charset="utf-8" />
    <title>{{ $pageTitle ?? '' }} | {{ $coreSetting['site_name'] ?? env('APP_NAME') }}</title>
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <link rel="icon" type="image/x-icon" href="{{ $coreSetting['site_favicon'] ?? '/assets/admin/img/favicon/favicon.png' }}" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="/assets/admin/vendor/fonts/boxicons.css" />

    <link rel="stylesheet" href="/assets/admin/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="/assets/admin/vendor/css/theme-default.css" class="template-customizer-theme-css" />

    <link rel="stylesheet" href="/assets/admin/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <link rel="stylesheet" href="/assets/vendor/libs/animate-css/animate.css">
    <link rel="stylesheet" href="/assets/vendor/libs/sweetalert2/sweetalert2.css">

    <script src="/assets/admin/vendor/js/helpers.js"></script>

    {{-- <script src="/assets/admin/vendor/js/template-customizer.js"></script> --}}
    <script src="/assets/admin/js/config.js"></script>

    @include('admin.includes.headScript')
    @stack('styles_top')
    @stack('scripts_top')
    <link rel="stylesheet" href="/assets/admin/css/new.css" />

</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">

            <div style="backdrop-color: rgba(0,0,0,.3);" class="modal fade show" id="defaultDeleteModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-simple">
                    <div class="modal-content p-3">
                        <div class="modal-body">
                            <button type="button" style="top: 0; right: 0;" class="btn-close defaultDeleteModalClose btn-pinned" data-bs-dismiss="modal" aria-label="Close"></button>
                            <div class="text-center mb-4">
                                <h3>Are you want to delete !</h3>
                            </div>
                            <div class="modal-body">
                                {{-- <div class="alert alert-warning">
                                    <h6 class="alert-heading fw-bold mb-2">Warning</h6>
                                    <p class="mb-0">
                                        Are you sure you want to delete this user and all his data<br>
                                        Becouse this data can't be recover
                                    </p>
                                </div> --}}
                                <div class="col-12 text-center demo-vertical-spacing">
                                    <input type="hidden" id="user_id" name="user_id" value="">
                                    <a id="deleteModelHref" style="margin-right: 20px" type="submit" class="btn btn-danger">Yes, Delete</a>
                                    <button type="reset" class="btn btn defaultDeleteModalClose btn-label-secondary" data-bs-dismiss="modal"
                                        aria-label="Close">Discard</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @include('admin.includes.sidebar')
            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->
                @include('admin.includes.nav')

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->
                    @yield('contant')
                    @include('admin.includes.footer')
                    <div class="content-backdrop fade"></div>
                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>

    </div>

    <script src="/assets/admin/vendor/libs/jquery/jquery.js"></script>
    <script src="/assets/admin/vendor/libs/popper/popper.js"></script>
    <script src="/assets/admin/vendor/js/bootstrap.js"></script>
    <script src="/assets/admin/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="/assets/vendor/libs/sweetalert2/sweetalert2.js"></script>
    <script src="/assets/admin/vendor/js/menu.js"></script>
    <script src="/assets/admin/js/main.js"></script>

    @stack('scripts_bottom')
    @stack('styles_bottom')

    <script>
        $('form').on('focus', 'input[type=number]', function (e) {
        $(this).on('wheel.disableScroll', function (e) {
            e.preventDefault()
        })
        })
        $('form').on('blur', 'input[type=number]', function (e) {
            $(this).off('wheel.disableScroll')
        })
    </script>

    <script>
        $('.defaultDeleteModelBtn').click(function (e) {
            $('#deleteModelHref').attr('href', $(this).attr('delete-href'))
            $('#defaultDeleteModal').show()
        });
        $('.defaultDeleteModalClose').click(function (e) {
            $('#deleteModelHref').attr('href', '#')
            $('#defaultDeleteModal').hide()
        });
    </script>
</body>

</html>
