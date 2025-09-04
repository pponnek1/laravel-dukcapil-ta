<!DOCTYPE html>
<html
  lang="en"
  class="dark-style layout-wide customizer-hide "
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="{{ asset('assetsl') }}/"
  data-template="vertical-menu-template-no-customizer"
  data-style="dark">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no" />
  <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
  <title>@yield('title', 'Authentication')</title>

  <!-- Favicon -->
  <link rel="icon" type="image/x-icon" href="{{ asset('assetsl/img/favicon/favicon.ico') }}" />

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet" />

  <!-- Icons -->
  <link rel="stylesheet" href="{{ asset('assetsl/vendor/fonts/fontawesome.css') }}" />
  <link rel="stylesheet" href="{{ asset('assetsl/vendor/fonts/tabler-icons.css') }}" />
  <link rel="stylesheet" href="{{ asset('assetsl/vendor/fonts/flag-icons.css') }}" />

  <!-- Core CSS -->
  <link rel="stylesheet" href="{{ asset('assetsl/vendor/css/rtl/core-dark.css') }}" />
  <link rel="stylesheet" href="{{ asset('assetsl/vendor/css/rtl/theme-default-dark.css') }}" />
  <link rel="stylesheet" href="{{ asset('assetsl/css/demo.css') }}" />

  <!-- Vendors CSS -->
  <link rel="stylesheet" href="{{ asset('assetsl/vendor/libs/node-waves/node-waves.css') }}" />
  <link rel="stylesheet" href="{{ asset('assetsl/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
  <link rel="stylesheet" href="{{ asset('assetsl/vendor/libs/typeahead-js/typeahead.css') }}" />
  <link rel="stylesheet" href="{{ asset('assetsl/vendor/libs/@form-validation/form-validation.css') }}" />

  <!-- Page CSS -->
  <link rel="stylesheet" href="{{ asset('assetsl/vendor/css/pages/page-auth.css') }}" />

  <!-- Helpers -->
  <script src="{{ asset('assetsl/vendor/js/helpers.js') }}"></script>
  <script src="{{ asset('assetsl/js/config.js') }}"></script>
</head>

<body>
  @yield('content')

  <!-- Core JS -->
  <script src="{{ asset('assetsl/vendor/libs/jquery/jquery.js') }}"></script>
  <script src="{{ asset('assetsl/vendor/libs/popper/popper.js') }}"></script>
  <script src="{{ asset('assetsl/vendor/js/bootstrap.js') }}"></script>
  <script src="{{ asset('assetsl/vendor/libs/node-waves/node-waves.js') }}"></script>
  <script src="{{ asset('assetsl/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
  <script src="{{ asset('assetsl/vendor/libs/hammer/hammer.js') }}"></script>
  <script src="{{ asset('assetsl/vendor/libs/i18n/i18n.js') }}"></script>
  <script src="{{ asset('assetsl/vendor/libs/typeahead-js/typeahead.js') }}"></script>
  <script src="{{ asset('assetsl/vendor/js/menu.js') }}"></script>

  <!-- Vendors JS -->
  <script src="{{ asset('assetsl/vendor/libs/@form-validation/popular.js') }}"></script>
  <script src="{{ asset('assetsl/vendor/libs/@form-validation/bootstrap5.js') }}"></script>
  <script src="{{ asset('assetsl/vendor/libs/@form-validation/auto-focus.js') }}"></script>

  <!-- Main JS -->
  <script src="{{ asset('assetsl/js/main.js') }}"></script>
  <script src="{{ asset('assetsl/js/pages-auth.js') }}"></script>

  @stack('scripts')
</body>
</html>
