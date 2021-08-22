<?php
    session_start();
    require ('connect_db.php');
    $query = "SELECT * FROM events WHERE event_id = '".$_GET['id']."' ";
    $result = mysqli_query($con, $query);
    if(!($article = mysqli_fetch_assoc($result))){
        echo "<div style='color:red; font-size: 3rem; text-align: center;  margin-left: auto; margin-right: auto;'>Событие не найдено</div>";
        die("Ошибка");
    }

    $query = "SELECT * FROM users WHERE user_id = '".$article['author_id']."' ";
    $result = mysqli_query($con, $query);
    $author = mysqli_fetch_assoc($result);
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
            <form action="http://placenevents/approve-reject.php" method="post">

                <input type="hidden" name="event_id" value=<?php  echo "'".$article['event_id']."'"?>>
                <button type="submit" name="approve">Принять</button>
                <button type="submit" name="reject">Отклонить</button>
            </form>
            <h1 class = "add-event__header">
                <?php
                if($article['adds']){
                    echo "<p style = 'color:red;'><strong>РЕКЛАМА id = $article[event_id] </strong></p>";

                }
                if ($article['event_type']==1){
                    echo "Событие: ";
                }
                else{
                    echo "Место: ";
                }
                    echo $article['title'];
                ?>
            </h1>
             <p>
                 <?php
                    echo $article['description'];
                 ?>
             </p>
            <p>
                <strong>Категория:</strong>
                <?php
                echo $article['category'];
                ?>
            </p>
            <p>
                <strong>Организатор:</strong>
                <?php
                    echo $author['first_name'].' ' .$author['middle_name'].' '.$author['second_name'];
                ?>
            </p>
            <p>
                <strong>Дата публикации:</strong>
                <?php
                    echo $article['pubdate'];
                ?>
            </p>
            <p>
                <strong>Время начала:</strong>
                <?php
                    echo $article['meeting_begin'];
                ?>
            </p>
            <p>
                <strong>Время конца:</strong>
                <?php
                echo $article['meeting_end'];
                ?>
            </p>

            
        </section>

    </div>
    <footer class="main-footer">
        <span>Обратная связь</span>
    </footer>
</div>
</body>

</html>