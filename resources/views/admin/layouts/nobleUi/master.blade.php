<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin</title>

    @include($themeLayout.'css')
</head>

<body>
<div class="main-wrapper">

    @include($themeLayout.'sidebar')

    <div class="page-wrapper">

        @include($themeLayout.'navbar')

        @yield('content')

        @include($themeLayout.'footer')

    </div>
</div>

@include($themeLayout.'scripts')

@stack('script')

</body>
</html>