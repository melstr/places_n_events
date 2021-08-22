<?php
    session_start();
require('connect_db.php');
    if (isset($_POST['add'])){
        if($_POST[category]==""){
            $_POST[category] = $_POST[category_option];
        }
        $query = "SELECT count(name) as count FROM categories WHERE name = '$_POST[category]'";
        $result = mysqli_query($con, $query);
        $category_count = mysqli_fetch_assoc($result)['count'];
        if($category_count == 0){
            $query = "INSERT INTO categories(name) VALUES ('$_POST[category]')";
            $result = mysqli_query($con, $query);
        }

        $query = "SELECT category_id  FROM categories WHERE name = '$_POST[category]'";
        $result = mysqli_query($con, $query);
        $category_id= mysqli_fetch_assoc($result)['category_id'];

        $query = "SELECT count(*) as count FROM user_category WHERE category_id = '".$category_id."' AND user_id ='". $_SESSION['user_id']."'";
        $result = mysqli_query($con, $query);
        $category_event_count = mysqli_fetch_assoc($result)['count'];
        if($category_event_count == 0){
            $query = "INSERT INTO user_category(category_id, user_id) VALUES ('$category_id','".$_SESSION['user_id']."')";
            $result = mysqli_query($con, $query);
        }
    }
    if(isset($_POST['delete'])){
        $query = "DELETE FROM user_category WHERE bound_id = '$_POST[bound_id]'";
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
    <?php include('header.php'); ?>

    <div class="main-wrapper">
        <section class="main-articles">

                <h1 class = "add-event__header">Ваши любимые категории</h1>


                <?php

                    $query = "SELECT * FROM user_category WHERE user_id = '".$_SESSION['user_id']."'";
                    $result = mysqli_query($con, $query);

                    while($category_id = mysqli_fetch_assoc($result)){

                        $query = "SELECT name FROM categories WHERE category_id = '".$category_id['category_id']."'";
                        $result1 = mysqli_query($con, $query);
                        $category_name = mysqli_fetch_assoc($result1)['name'];
                        echo "<form action='http://placenevents/my_categories.php' method='post'>";
                        echo "<input type='text' value='".$category_name."' disabled>";
                        echo "<input type = 'hidden' value='".$category_id['bound_id']."' name ='bound_id'>";
                        echo "<button type='submit' name='delete'>Удалить</button>";
                        echo "</form>";

                    }
                ?>
            <form action="http://placenevents/my_categories.php" method="post">
                <label for="category">Введите любимую категорию</label>
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
                <button type="submit" name ="add">Добавить</button>
            </form>
        </section>

    </div>
    <footer class="main-footer">
        <span>Обратная связь</span>
    </footer>
</div>
</body>

</html>
