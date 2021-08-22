<?php
require('connect_db.php');
if($_GET['tried']=='true')
{
    $login = $_POST['login'];
//    var_dump($_POST['password']);
    $query = "SELECT count(login) as count FROM users WHERE login = '$login'";
    $result = mysqli_query($con, $query);
    $user_count = mysqli_fetch_assoc($result)['count'];
    if($user_count == 0){
        echo "<div style='color:red; font-size: 3rem; text-align: center;  margin-left: auto; margin-right: auto;'>Логин неверен</div>";
    }
    else{
        $query = "SELECT * FROM users WHERE login = '$login'";
        $result = mysqli_query($con, $query);
        $user = mysqli_fetch_assoc($result);
         if(password_verify($_POST['password'], $user['password'])){
             session_start();
             $_SESSION['user_id']=$user['user_id'];
             $_SESSION['login']=$user['login'];
             $_SESSION['first_name']=$user['first_name'];
             $_SESSION['user_type']=$user['user_type'];
             $_SESSION['user_status']=$user['status'];
             header("Location: http://placenevents/index.php");
         }
         else{
             echo "<div style='color:red; font-size: 3rem; text-align: center;  margin-left: auto; margin-right: auto;'>Пароль неверен</div>";
         }
    }


}
?>
<html>
    <head>
        <title>Авторизация</title>
        <meta charset="utf-8">
        <link href="https://fonts.googleapis.com/css?family=Alegreya+Sans:300,400,500,700&display=swap&subset=cyrillic"
              rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="http://placenevents/normalize.css">
        <link rel="stylesheet" href="http://placenevents/main.css">
    </head>
    <body>

        <form class="login__form" action="http://placenevents/login.php?tried=true" method ="post">
            <div class="login-register-link">
                <a href="http://placenevents/login.php">Авторизация</a>/
                <a href="http://placenevents/register.php">Регистрация</a>
            </div>
            <?php
            if($_GET[registered]==true){
                echo " <span style='color:green; font-size:1rem;'>Вы зарегистрировались, а теперь</span>";
            }
            ?>
            <h1 class = "login__header">Введите логин и пароль</h1>
            <label class="login__label" for="login">
                Введите логин
                <input type="text" name="login" id="login">
            </label>
            <label class="login__label" for="password">
                Введите пароль
                <input type="password"  name="password" id="password">
            </label>
            <button class="submit-button" type="submit" class="submit">Войти</button>
        </form>
    </body>
</html>
<?php
?>