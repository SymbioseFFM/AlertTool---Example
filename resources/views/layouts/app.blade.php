<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    @livewireStyles
    <script src="{{ mix('js/app.js') }}" defer></script>
</head>

<body class="sidebar-mini layout-fixed" style="height: auto;">
    <div class="wrapper">
        <main>
            <aside class="main-sidebar sidebar-dark-primary elevation-4">
                <div class="sidebar min-h-full">
                    <div class="row">
                        <div class="col">
                            <p class="text-white text-lg px-4 py-2 text-center">
                                <img src="{{ asset('img/logo.png') }}" class="img-fluid">
                            </p>
                        </div>
                    </div>
                    <div class="user-panel pb-3 mb-3 d-flex">
                        <div class="info d-block text-sm text-white">
                            {{ auth()->user()->fullname }}
                        </div>
                    </div>
                    <nav class="mt-2">
                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                            data-accordion="false">
                            <x-navigation-menu-single name="Meldungen" icon="fa-envelope" link="/alerts" />
                            <x-navigation-menu-single name="Kunden" icon="fa-users" link="/customers" />
                            <x-navigation-menu-single name="Standorte" icon="fa-location-crosshairs" link="/locations" />
                            <x-navigation-menu-single name="Server" icon="fa-server" link="/servers" />
                            <x-navigation-menu-single name="Sensoren" icon="fa-eye" link="/sensors" />
                        </ul>
                    </nav>
                </div>
            </aside>
            <nav class="main-header navbar navbar-expand navbar-white navbar-light">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                    </li>
                </ul>
            </nav>
            <div class="content-wrapper p-2 bg-white">
                {{ $slot }}
            </div>
        </main>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
    @livewireScripts
    <script>
        window.addEventListener('modal', event => {
            $(event.detail.name).modal(event.detail.method);
        })
    </script>
    @stack('scripts')
</body>

</html>
