<?php
    session_start();
    require("connect_db.php");
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
        <section class="main-articles">
            <form action="add_event.php" class="add-event__form" method="post">
                <h1 class = "add-event__header">Введите данные события</h1>
                <label class="add-event__label" for="title">
                    Введите называние места/события
                    <input type="text" name="title" id="title" required>
                </label>
                <label class="add-event__label" for="event_type"">
                Выберете тип - место или событие
                    <select name="event_type" id="event_type">
                        <option value="1" selected>Событие</option>
                        <option value="2">Место</option>
                    </select>
                </label>
                <label class="add-event__label" for="description">
                    Введите описание места/события
                    <textarea type="text"  cols="80" rows="30" name="description" id="description" required></textarea>
                </label>
                <label class="add-event__label">
                    Введите категорию из списка
                    <select name="category_option" >
                        <?php
                        $query = "SELECT name FROM categories";
                        $result = mysqli_query($con, $query);
                        while($cat = mysqli_fetch_assoc($result)['name']){
                            echo "<option value='$cat' selected>$cat</option>";
                        }
                        ?>
                    </select>
                    или напишите свою (тогда выбирется написанная вручную)
                    <input type="text"  name="category" id="category">
                </label>
                <label class="add-event__lab el" for="address" >
                    Введите адрес проведения
                    <input type="text"  name="address" id="address" required>
                </label>
                <label class="add-event__label" for="event_city">
                 Выберете город
                    <select name="event_city" id="event_city">
                        <?php

                            $query = "SELECT city FROM city";
                            $result = mysqli_query($con, $query);
                            while($city = mysqli_fetch_assoc($result)['city']){
                                echo "<option value='$city' selected>$city</option>";
                            }
                        ?>
                    </select>
                </label>
                <label class="add-event__label" for="meeting_begin">
                    Введите время начала мероприятия
                    <input type="datetime-local"  name="meeting_begin" id="meeting_begin" >
                </label>
                <label class="add-event__label" for="meeting_end">
                    Введите время конца мероприятия
                    <input type="datetime-local"  name="meeting_end" id="meeting_end" >
                </label>
                <input type="checkbox" name="add">Купить рекламу</p>
                <button class="submit-button" type="submit" class="submit">Отправить на проверку</button>
            </form>
        </section>
        <aside class="my-events">
                <p>Если хотите, чтобы ваше событие точно увидели, вы можете помочь нам и купить рекламу. Для этого отметьте галочкой "Рекламу", нажмите на кнопку "Отправить".
                Вы увидите id вашего события, затем перешлите 100р. на карту Сбербанка с номером 4276 3522 3342 1232 с комментарием "Реклама id = ваше id"</p>
        </aside>
    </div>
    <footer class="main-footer">
        <span>Обратная связь</span>
    </footer>
</div>
</body>
</html>