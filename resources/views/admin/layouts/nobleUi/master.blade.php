<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>NobleUI Responsive Bootstrap 4 Dashboard Template</title>

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

</body>
</html>