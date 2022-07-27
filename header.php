<header class="header">
    <div class="header__logo">
        <h1 class="header__name"><a href="index.php">Места и события</a></h1>
        <?php
        if(isset($_SESSION['first_name'])){
            echo "<span class='auth_text'>Здравствуйте, ".  $_SESSION['first_name'] ."! </span><a href='http://placenevents/index.php/?destroy=true' class='auth'><span class='auth_text'>Выйти</span></a>";
        }
        else{
            echo "<a href='http://placenevents/login.php' class=\"auth\"><span class=\"auth_text\">Войти/Регистрация</span></a>";
        }
        ?>

    </div>
    <nav class="nav">
        <ul class="nav__list">
            <li class="nav__item"><a href="http://placenevents/index.php" class="nav__link">Главная</a></li>
            <? if($_SESSION['user_type']==2){
                echo "<li class=\"nav__item\"><a href=\"http://placenevents/new_event.php\" class=\"nav__link\">Создать место или событие</a></li>";
            }
            if($_SESSION['user_type'] > 2){
                echo "<li class=\"nav__item\"><a href=\"http://placenevents/requested_events.php\" class=\"nav__link\">Предложенные события</a></li>";
                echo "<li class=\"nav__item\"><a href=\"http://placenevents/sendnews.php\" class=\"nav__link\">Написать рассылку</a></li>";
            }
            if($_SESSION['user_type'] == 4){
                echo "<li class=\"nav__item\"><a href=\"http://placenevents/users.php\" class=\"nav__link\">Изменить пользователей</a></li>";
            }
            if($_SESSION['user_type']==1){
                echo "<li class=\"nav__item\"><a href='http://placenevents/my_categories.php' class=\"nav__link\">Любимые категории</a></li>";
                echo "<li class=\"nav__item\"><a href='http://placenevents/category_events.php' class=\"nav__link\">Отсортировать по категориям И городам</a></li>";
            }
            if($_SESSION['user_type'] > 0){
                echo "<li class=\"nav__item\"><a href='http://placenevents/forum.php' class=\"nav__link\">Форум</a></li>";
            }
            ?>

            <li class="nav__item"><a href="http://placenevents/about.php" class="nav__link">О нас</a></li>
            <li class="nav__item"><a href="http://placenevents/sendemail.php" class="nav__link">Задать вопрос</a></li>
            <li class="nav__item"><a href="http://placenevents/subscribe.php" class="nav__link">Подписаться на новости</a></li>
        </ul>
    </nav>
</header>
<script>
    let href  = window.location.href;
    let navigation = document.getElementsByClassName("nav__link");
    for(let i = 0; i < navigation.length; i++)
    {
        if (href === navigation[i].href) navigation[i].className += " active";
    }
</script>