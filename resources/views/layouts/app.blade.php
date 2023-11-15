<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'ZK Super Store') }}</title>

    <!-- Fonts -->
    
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">
    
    <!-- Style -->
    
    <link rel="stylesheet" href="{{ asset('assets/css/user/style.css') }}">
    @livewireStyles  
</head>
<body>
    <div class="container-scroller">
        @include('layouts.inc.admin.navbar')
        <div class="container-fluid page-body-wrapper">
           <div class="main-panel">
            <div class="content-wrapper">
              @yield('content')
              @include('layouts.inc.user.footer')
            </div>
          </div>  
        </div>
      </div>

@livewireScripts
</body>
</html>