<!doctype html>
<html lang="en">

<head>
    <title>
        @yield('title')
    </title>
    @include('includes.head')

    @stack('style')
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        @include('includes.navbar')

        @include('includes.sidebar')

        <div class="content-wrapper">
            <main id="main">
                @yield('content')
            </main>
        </div>

        @include('includes.footer')

        @include('includes.scripts')

    </div>

    @stack('scripts')
    
</body>

</html>