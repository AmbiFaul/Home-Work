<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('register-title')</title>
    <link rel="stylesheet" href="{{asset('css/main-style.css')}}">
</head>
<body>
<div class="box">
    <h1><a href="/">@yield('top-h1')</a></h1>
    @if($errors->any())
        <div class="errorblock">
            <ul>
                @foreach($errors->all() as $error) @endforeach
                <li>{{$error}}</li>
            </ul>
        </div>
    @endif
    @yield('register-sample')
</div>
</body>
</html>
