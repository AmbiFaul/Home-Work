@extends('sample_sig-log-in')
@section('register-title')Войти@endsection
@section('top-h1')Войти@endsection
@section('register-sample')
    <form action="/login/check" method="post">
        @csrf
        <input class="input-style" type="email" id="email" name="email" placeholder="Введите адрес электронной почты" autocomplete="true" required>
        <input class="input-style" type="password" id="password" name="password" placeholder="Введите пароль" autocomplete="true" required>
        <a class="input-a" href="/signup">У меня нет аккаунта</a>
        <input class="input-style" type="submit">
    </form>
@endsection
