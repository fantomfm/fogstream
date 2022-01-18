<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app_custom.css') }}">
    
</head>
<body class="bg-dark text-white text-center">
    @include('inc.header')
  
    <div class="container-md"> 
      @yield('content')
    </div>

    @include('inc.footer')
</body>
</html>