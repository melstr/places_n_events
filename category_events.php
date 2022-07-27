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
    <title>Главная</title>
    <link href="https://fonts.googleapis.com/css?family=Alegreya+Sans:300,400,500,700&display=swap&subset=cyrillic"
          rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="http://placenevents/normalize.css">
    <link rel="stylesheet" href="http://placenevents/main.css">
</head>

<body>
<div class="main-container">
    <?php include('header.php'); ?>

    <div class="main-wrapper">
        <section class="main-articles" style="width: 100%;">
            <h2 class="articles__header">Выберете город и категорию</h2>
            <form action="http://placenevents/category_events.php" method="post">
                <label class="add-event__label" for="event_city">
                    Выберете город
                    <select name="city" id="event_city">
                        <?php

                        $query = "SELECT city FROM city";
                        $result = mysqli_query($con, $query);
                        while($city = mysqli_fetch_assoc($result)['city']){
                            echo "<option value='$city' selected>$city</option>";
                        }
                        ?>
                    </select>
                </label>
                <label class="add-event__label">
                    Введите категорию из списка
                    <select name="category" >
                        <?php
                        $query = "SELECT name FROM categories";
                        $result = mysqli_query($con, $query);
                        while($cat = mysqli_fetch_assoc($result)['name']){
                            echo "<option value='$cat' selected>$cat</option>";
                        }
                        ?>
                    </select>

                </label>
                <button type="submit" name="submit">Показать</button>
            </form>

            <?php require('connect_db.php');

            if(isset($_POST['submit'])){
                $query = "SELECT * FROM events WHERE category = '$_POST[category]' AND city = '$_POST[city]' ORDER BY pubdate desc";
                $request = mysqli_query($con, $query);

                while ($article = mysqli_fetch_assoc($request)) {
                    echo "<a href='http://placenevents/event_show.php/?id=" . $article['event_id'] . "' class='article__link'> <article class='article'> <div class='article__text'>";
                    echo "<h2 class=\"article__name\">" . $article['title'] . "</h2>";
                    echo "<p>" . substr($article['description'], 0, 200) . "...</p>";
                    echo "</div></article></a>";
                }
            }


            ?>

        </section>

    </div>
    <?php include('footer.php'); ?>
</div>
</body>

</html>