<?php
require('connect_db.php');
session_start();
if($_GET['destroy']==true){
    session_destroy();
    unset($_SESSION);
}

?>
<html>

<head>
    <title>О нас</title>
    <link href="https://fonts.googleapis.com/css?family=Alegreya+Sans:300,400,500,700&display=swap&subset=cyrillic"
          rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="http://placenevents/normalize.css">
    <link rel="stylesheet" href="http://placenevents/main.css">
</head>

<body>
<div class="main-container">
    <?php include('header.php'); ?>

        <section class="main-articles" style="width: 100%;">
            <h2 class="articles__header">О нас</h2>
        <p>Мы - создали сайт, который позволит каждому из вас создавать самолично места и события вашего города или просмотреть предстоящие события.
        Если вы зарегистрируетесь как пользователь, то сможете добавлять любимые категории и получать по ним рекомендации.
        Если вы - организация, вы можете зарегистрироваться как организатор и самолично предложить (либо купить рекламу) вашего события или места.</p>
        </section>


    <?php include('footer.php'); ?>
</div>
</body>

</html>