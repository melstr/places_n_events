<?php
    session_start();
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
            <h2 class="articles__header">Предложенные места и события</h2>
            <?php require('connect_db.php');
            $query ="SELECT * FROM events WHERE status = 'requested'";
            $request = mysqli_query($con, $query );

            while($article = mysqli_fetch_assoc($request)){


                 echo "<a href='http://placenevents/event_check.php/?id=".$article['event_id']. "' class='article__link'> <article class='article'> <div class='article__text'>";
                if($article['adds']){
                    echo "<p style = 'color:red;'><strong>РЕКЛАМА</strong></p>";
                    $query1= "SELECT * FROM transactions WHERE event_id = '".$article['event_id']."'";
                    $result1 = mysqli_query($con, $query1);
                    if (mysqli_fetch_assoc($result1)){
                        echo "<p style = 'color:green;'><strong>Оплачено</strong></p>";
                    }else{
                        echo "<p style = 'color:red;'><strong>Не оплачено</strong></p>";
                    }
                }
                 echo "<h2 class=\"article__name\">".$article['title']."</h2>";
                 echo "<p>".substr($article['description'],0,200)."...</p>";
                 echo "</div></article></a>";
            }
            ?>
           

        </section>

    </div>
    <?php include('footer.php'); ?>
</div>
</body>

</html>
