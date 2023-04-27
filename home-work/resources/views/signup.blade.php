@extends('sample_sig-log-in')
@section('register-title')Регистрация@endsection
@section('top-h1')Регистрация@endsection
@section('register-sample')
    <form action="/signup/check" method="post">
        @csrf
        <div class="signup-colon">
            <section>
                <input class="input-style" type="text" name="first-name" id="first-name" placeholder="Введите имя" required>
                <input class="input-style" type="text" name="last-name" id="last-name" placeholder="Введите фамилию" required>
                <input class="input-style" type="text" name="surname" id="surname" placeholder="Введите отчество" required>
                <input type="radio" id="male" name="gender" value="male" required>
                <label for="male">Мужчина</label>
                <input type="radio" id="female" name="gender" value="female" required>
                <label for="female">Женщина</label>
            </section>
            <section>
                <input class="input-style" type="date" name="data" id="data" placeholder="Ваша дата рождения" required>
                <input class="input-style" type="number" name="number" id="number" placeholder="Номер паспорта" required>
                <input class="input-style" type="text" name="seria" id="seria" placeholder="Серия паспорта" required>
            </section>
            <section>
                <input class="input-style" type="email" name="email" id="email" placeholder="Введите email" required autocomplete="true">
                <input class="input-style" type="password" name="password" id="password" placeholder="Придумайте пароль" required>
                <input class="input-style" type="password" name="password-confirm" id="password-confirm" placeholder="Подтвердите пароль" required>
                <a class="input-a" href="/login">У меня есть аккаунт</a>
            </section>
        </div>
        <input class="input-style" type="submit">
    </form>

@endsection
