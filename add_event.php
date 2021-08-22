<?php
    session_start();
    require('connect_db.php');

    $title = $_POST['title'];
    $address = $_POST['address'];
    $description=$_POST['description'];
    $author_id = $_SESSION['user_id'];//Чет не знаю что
    $event_type=$_POST['event_type'];
    $city=$_POST['event_city'];
    $meeting_begin = $_POST['meeting_begin'];
    $meeting_end = $_POST['meeting_end'];
    if($_POST['category'] == ""){
        $category = $_POST['category_option'];
    }
    else{
        $category = $_POST['category'];
    }
    $add = false;
    if($_POST['add'] == "on"){
        $add = true;
    }
//    echo $add;



    $pubdate = date_create()->format('Y-m-d H:i:s');
//    var_dump($category);
    $query = "INSERT INTO events (title,   address,     description, author_id, pubdate, event_type, meeting_begin,meeting_end, city, category, adds)
                        VALUES ('$title', '$address', '$description','$author_id','$pubdate','$event_type', '$meeting_begin','$meeting_end', '$city', '$category', '$add')";
//    var_dump($query);
    $result = mysqli_query($con, $query);

    $query = "SELECT count(name) as count FROM categories WHERE name = '$category'";
    $result = mysqli_query($con, $query);
    $category_count = mysqli_fetch_assoc($result)['count'];
    if($category_count == 0){
        $query = "INSERT INTO categories(name) VALUES ('$category')";
        $result = mysqli_query($con, $query);
    }
    $query = "SELECT MAX(event_id) as event_id FROM events WHERE category = '$category'";
    $result = mysqli_query($con, $query);
    $event_id = mysqli_fetch_assoc($result)['event_id'];

    $query = "SELECT * FROM categories WHERE name = '$category' ";

    $result = mysqli_query($con, $query);
    $category_id = mysqli_fetch_assoc($result)['category_id'];
//    echo  $category_id;

    $query = "SELECT count(*) as count FROM category_event WHERE category_id = '$category_id' and event_id = '$event_id'";
    $result = mysqli_query($con, $query);
    $category_event_count = mysqli_fetch_assoc($result)['count'];
    if($category_event_count == 0){
        $query = "INSERT INTO category_event(category_id, event_id) VALUES ('$category_id','$event_id')";
        $result = mysqli_query($con, $query);
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
    <?php include('header.php');?>

    <div class="main-wrapper" style="justify-content: center;">
       <div style="text-align: center;"><?php if($result){
                echo "<p>Событие отправлено, ожидайте подтверждения</p>";
            }
            else{
                echo "<p>Произошла ошибка на сервере</p>";
            }
            if($add){
                echo "<p>Ваше id = $event_id </p>";
                echo "<p>перешлите 100р. на карту Сбербанка с номером 4276 3522 3342 1232 с комментарием \"Реклама, id =  $event_id\" </p>";
            }
        ?>
        <p><a href="http://placenevents/index.php">На главную</a></p></div>
    </div>

    <footer class="main-footer">
        <span>Обратная связь</span>
    </footer>
</div>
</body>

</html>

