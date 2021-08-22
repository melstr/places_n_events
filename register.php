<?php
    require('connect_db.php');
    if(isset($_POST[login]) and isset($_POST[password]) and isset($_POST[first_name]) and isset($_POST[second_name]))
    {
        $login = $_POST['login'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $first_name=$_POST['first_name'];
        $second_name=$_POST['second_name'];
        $middle_name=$_POST['middle_name'];
        $user_type = $_POST['user_type'];

        $query = "INSERT INTO users (login, password, first_name, second_name, middle_name, user_type, status) VALUES ('$login', '$password', '$first_name', '$second_name','$middle_name','$user_type', '1')";
        $result = mysqli_query($con, $query);

        if($result){
            header("Location: http://placenevents/login.php/?registered=true");
        }
        else{
            echo "<div style='color:red; font-size: 3rem; text-align: center;  margin-left: auto; margin-right: auto;'>Ошибка базы данных.<br>Возможно пользователь с таким логином уже существует</div>";
        }

    }
?>
<html>
    <head>
        <title>Регистрация</title>
        <meta charset="utf-8">
        <link href="https://fonts.googleapis.com/css?family=Alegreya+Sans:300,400,500,700&display=swap&subset=cyrillic"
              rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="http://placenevents/normalize.css">
        <link rel="stylesheet" href="http://placenevents/main.css">
    </head>
    <body>
        <form class="register__form" action="http://placenevents/register.php/" method ="post">
            <div class="login-register-link">
                <a href="login.php">Авторизация</a>/
                <a href="register.php">Регистрация</a>
            </div>
            <h1 class = "register__header">Введите данные регистрации</h1>
            <label class="register__label" for="login">
            Введите логин
            <input type="text" name="login" id="login" required>
            </label>
            <label class="register__label" for="password">
            Введите пароль
            <input type="password"  name="password" id="password" required>
            </label>
            <label class="register__label" for="first_name" >
                Введите имя
                <input type="text"  name="first_name" id="first_name" required>
            </label>
            <label class="register__label" for="second_name">
                Введите фамилию
                <input type="text"  name="second_name" id="name" required>
            </label>
                <label class="register__label" for="middle_name">
                    Введите отчество
                <input type="text"  name="middle_name" id="name">
            </label>

            </label>
            <label class="register__label" for="user_type"">
                    Выберете ваш тип:
            <select name="user_type" id="user_type">
                <option value="1" selected>Обычный горожанин</option>
                <option value="2">Организатор</option>
            </select>
            </label>
            <button class="submit-button" type="submit" class="submit">Зарегистрироваться</button>
        </form>
    </body>
</html>
<?php
?>