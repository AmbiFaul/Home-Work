<?php
    $id = session()->get('id');
    $bd = array();
    $column = array("created_at", "firstname", "lastname", "surname", "gender", "number", "seria", "data", "password");
    for($i = 0; $i < count($column); $i++)
    {
        $dummy = DB::table('contacts')
            ->where('id', $id)
            ->pluck($column[$i]);
        $bd[$i] =str_replace(['["','"]'], "", $dummy);
    }
    if($bd[4] == 'male')
    {
        $bd[4] = 'Мужчина';
    }
    else if($bd[4] == 'female')
    {
        $bd[4] = 'Прекрасная дама';
    }

?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Личный кабинет</title>
    <link rel="stylesheet" href="{{asset('css/main-style.css')}}">
    <script>
        function showDiv(x) {
            var myDiv = document.getElementById("setting");
            if(x == 1) {
                myDiv.style.display = "block";
            }
            else{
                myDiv.style.display = "none";
            }
        }
        function showSet(x) {
            var myDiv = document.getElementById("set");
            if(x == 1) {
                myDiv.style.display = "block";
            }
            else{
                myDiv.style.display = "none";
            }
        }
        function showLeave(x) {
            var myDiv = document.getElementById("leave");
            if(x == 1) {
                myDiv.style.display = "block";
            }
            else{
                myDiv.style.display = "none";
            }
        }
        function setConfirm(x){
            var firB = document.getElementById("first_set-btn");
            var secB = document.getElementById("set-confirm-btn");
            var pasC = document.getElementById("password-confirm");

            if(x == 1){
                secB.style.display = "none";
                pasC.style.display = "none";
                firB.style.display = "block";
            }
            else if(x == 2)
            {
                secB.style.display = "block";
                pasC.style.display = "block";
                firB.style.display = "none";
            }
        }
    </script>
</head>
<body>
    <section>
        <header class="profil-header header">
            <div class="fio">
                <?php
                    echo "
                        <h2>$bd[1]</h2>
                        <h2>$bd[2]</h2>
                        <h2>$bd[3]</h2>
                        <h4 style='color: #adadad;'>$bd[4]</4>
                        ";
                ?>
            </div>
            <nav>
                <lu class="menu profil-menu">
                    <li><button onclick="window.location.href = '/'">Главная</button></li>
                    <li><button onclick="showDiv(1)">Настройки</button></li>
                </lu>
            </nav>
        </header>
        <hr>
    </section>
    <div class="conteiner">
        <h3>Информация о пользователе</h3>
        <p>Конечно вся личная информация полностью секретна и не показывается так открыто, но это сайт для дз, и мне надо продемострировать что данные которые вы ввели могут использоваться на сайте<br>
            <?php
            echo "Номер паспорта: $bd[5],<br>
            Серия паспорта: $bd[6],<br>
            Дата рождения: $bd[7],<br>
            Дата создания профиля: $bd[0],<br>";
            ?>
            А также используется адрес электронной почты, пароль, ваш пол, фио, но вы могли наблюдать их ранее.
        </p>
        <h2>Кстати</h2>
        <p>Пароли не просто сохраняются, а хэшируются с помощью метода "md5" и ваш пароль выглядит так: <?php echo $bd[8];?>.</p>
    </div>
    <div id="setting" class="setting-box box">
        <h1><a class="setting-btn" onclick="showDiv(2)">Настройки</a></h1>
        <hr>
        <h3><a class="set-btn" onclick="showSet(1); showDiv(2); setConfirm(1)">Редактировать данные</a></h3>
        <h3><a class="leave-btn" onclick="showLeave(1); showDiv(2)">Выйти из аккаунта</a></h3>
    </div>
    <div id="leave" class="leave-box setting-box">
        <h1>Вы подтверждаете действия?</h1>
        <div class="leave-box_btn">
            <button onclick="window.location.href='/leave'" class="leave-btn_yes">Да</button>
            <button onclick="showLeave(2); showDiv(1)" class="leave-btn_yes leave-btn_no">Нет</button>
        </div>
    </div>
    <div id="set" class="set-box box setting-box">
        <h1>Редактировать данные</h1>
        <hr>
        <form method="post" action="/dataset">
            @csrf
            <section class="">
                <input class="input-style" type="text" name="first-name" id="first-name" placeholder="Введите имя">
                <input class="input-style" type="text" name="last-name" id="last-name" placeholder="Введите фамилию">
                <input class="input-style" type="text" name="surname" id="surname" placeholder="Введите отчество">
            </section>
            <section class="">
                <input class="input-style" type="number" name="number" id="number" placeholder="Номер паспорта">
                <input class="input-style" type="text" name="seria" id="seria" placeholder="Серия паспорта">
                <input class="input-style" type="password" name="password" id="password" placeholder="Придумайте пароль">
            </section>
            <hr id="set-confirm" class="set-hr_confirm">
            <div id="set-confirm" class="set-confirm">
                <input class="input-style" type="password" name="password-confirm" id="password-confirm" placeholder="Подтвердите паролем" required>
                <button id="set-confirm-btn" type="submit">Сохранить</button>
            </div>
        </form>
        <div id="first_set-btn" class="first_set-btn">
            <button onclick="showSet(2); showDiv(1)">Отмена</button>
            <button onclick="setConfirm(2)">Сохранить</button>
        </div>
    </div>
</body>
</html>
