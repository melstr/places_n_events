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
  <meta name="viewport" content="width=device-width,initial-scale=1">
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
        <h2 class="articles__header">Самые популярные места и события</h2>
          <?php require('connect_db.php');
          if($_SESSION['user_type']==1){
              $query ="SELECT * FROM events WHERE adds = '1' ORDER BY pubdate desc";
              $request = mysqli_query($con, $query);

             while($article = mysqli_fetch_assoc($request)){
                  echo "<a href='http://placenevents/event_show.php/?id=".$article['event_id']. "' class='article__link'> <article class='article'> <div class='article__text'>";
                  echo "<h2 class=\"article__name\">".$article['title']."</h2>";
                  echo "<p>".substr($article['description'],0,200)."...</p>";
                  echo "<p><em>Реклама</em></p>";
                  echo "</div></article></a>";
              }

              $query ="SELECT COUNT(DISTINCT wanna_go.user_id) as coun, events.event_id as event_id, events.title as title, events.description as description FROM events, wanna_go, category_event, user_category WHERE events.event_id = wanna_go.event_id AND events.status='approved' AND events.event_id = category_event.event_id AND category_event.category_id = user_category.category_id AND user_category.user_id = '$_SESSION[user_id]' AND events.adds != 1 GROUP BY events.event_id ORDER BY COUNT(wanna_go.event_id) DESC";
              $request = mysqli_query($con, $query);

              while($article = mysqli_fetch_assoc($request)){
                  echo "<a href='http://placenevents/event_show.php/?id=".$article['event_id']. "' class='article__link'> <article class='article'> <div class='article__text'>";
                  echo "<h2 class=\"article__name\">".$article['title']."</h2>";
                  echo "<p>".substr($article['description'],0,200)."...</p>";
                  echo "<p><em>Популярность: ".$article['coun']." чел.</em></p>";
                  echo "</div></article></a>";
              }

              $query ="SELECT events.event_id as event_id, events.title as title, events.description as description 
                FROM events,  category_event, user_category 
                WHERE events.event_id NOT IN (SELECT event_id FROM wanna_go) 
                AND events.adds != 1  
                AND events.event_id = category_event.event_id 
                AND events.status='approved'
                AND category_event.category_id = user_category.category_id AND user_category.user_id = $_SESSION[user_id] ORDER BY events.pubdate DESC ";

              $request = mysqli_query($con, $query);

              while($article = mysqli_fetch_assoc($request)){
                  echo "<a href='http://placenevents/event_show.php/?id=".$article['event_id']. "' class='article__link'> <article class='article'> <div class='article__text'>";
                  echo "<h2 class=\"article__name\">".$article['title']."</h2>";
                  echo "<p>".substr($article['description'],0,200)."...</p>";
                  echo "<p><em>Популярность: 0 чел.</em></p>";
                  echo "</div></article></a>";
              }

              $query ="SELECT COUNT(DISTINCT wanna_go.user_id) as coun, events.event_id as event_id, events.title as title, events.description as description 
                        FROM events, wanna_go, category_event, user_category 
                        WHERE events.event_id = wanna_go.event_id
                         AND events.status='approved'
                          AND events.event_id = category_event.event_id 
                          AND category_event.category_id NOT IN (SELECT category_id FROM user_category WHERE user_id = '$_SESSION[user_id]' ) AND events.adds != '1' GROUP BY events.event_id ORDER BY COUNT(wanna_go.event_id) DESC";
              $request = mysqli_query($con, $query);

              while($article = mysqli_fetch_assoc($request)){
                  echo "<a href='http://placenevents/event_show.php/?id=".$article['event_id']. "' class='article__link'> <article class='article'> <div class='article__text'>";
                  echo "<h2 class=\"article__name\">".$article['title']."</h2>";
                  echo "<p>".substr($article['description'],0,200)."...</p>";
                  echo "<p><em>Популярность: ".$article['coun']." чел.</em></p>";
                  echo "</div></article></a>";
              }

              $query ="SELECT DISTINCT events.event_id as event_id, events.title as title, events.description as description 
                FROM events,  category_event, user_category 
                WHERE events.event_id NOT IN (SELECT event_id FROM wanna_go) 
                AND events.adds != '1' 
                AND events.event_id = category_event.event_id 
                  AND events.status='approved'
                AND category_event.category_id NOT IN (SELECT category_id FROM user_category WHERE user_id = '$_SESSION[user_id]') ORDER BY events.pubdate DESC ";

              $request = mysqli_query($con, $query);

              while($article = mysqli_fetch_assoc($request)){
                  echo "<a href='http://placenevents/event_show.php/?id=".$article['event_id']. "' class='article__link'> <article class='article'> <div class='article__text'>";
                  echo "<h2 class=\"article__name\">".$article['title']."</h2>";
                  echo "<p>".substr($article['description'],0,200)."...</p>";
                  echo "<p><em>Популярность: 0 чел.</em></p>";
                  echo "</div></article></a>";
              }
          }else{
              $query ="SELECT * FROM events WHERE adds = '1' AND events.status='approved' ORDER BY pubdate";
              $request = mysqli_query($con, $query);

              while($article = mysqli_fetch_assoc($request)){
                  echo "<a href='http://placenevents/event_show.php/?id=".$article['event_id']. "' class='article__link'> <article class='article'> <div class='article__text'>";
                  echo "<h2 class=\"article__name\">".$article['title']."</h2>";
                  echo "<p>".substr($article['description'],0,200)."...</p>";
                  echo "<p><em>Реклама</em></p>";
                  echo "</div></article></a>";
              }

              $query ="SELECT COUNT(DISTINCT wanna_go.user_id) as coun, events.event_id as event_id, events.title as title, events.description as description FROM events, wanna_go WHERE events.event_id = wanna_go.event_id AND events.status='approved' AND events.adds != 1 GROUP BY events.event_id ORDER BY COUNT(wanna_go.event_id) DESC";
              $request = mysqli_query($con, $query);

              while($article = mysqli_fetch_assoc($request)){
                  echo "<a href='http://placenevents/event_show.php/?id=".$article['event_id']. "' class='article__link'> <article class='article'> <div class='article__text'>";
                  echo "<h2 class=\"article__name\">".$article['title']."</h2>";
                  echo "<p>".substr($article['description'],0,200)."...</p>";
                  echo "<p><em>Популярность: ".$article['coun']." чел.</em></p>";
                  echo "</div></article></a>";
              }

              $query ="SELECT DISTINCT events.event_id as event_id, events.title as title, events.description as description 
                FROM events,  category_event, user_category 
                WHERE events.event_id NOT IN (SELECT event_id FROM wanna_go) 
                AND events.adds != '1' 
                AND events.status='approved'
                ORDER BY events.pubdate DESC ";

              $request = mysqli_query($con, $query);

              while($article = mysqli_fetch_assoc($request)){
                  echo "<a href='http://placenevents/event_show.php/?id=".$article['event_id']. "' class='article__link'> <article class='article'> <div class='article__text'>";
                  echo "<h2 class=\"article__name\">".$article['title']."</h2>";
                  echo "<p>".substr($article['description'],0,200)."...</p>";
                  echo "<p><em>Популярность: 0 чел.</em></p>";
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