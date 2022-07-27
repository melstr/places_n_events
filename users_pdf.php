<h1 class = "add-event__header">Список пользователей сайта</h1>

<table border="1" cellspacing="0">
    <tr><th>ID</th><th>Имя</th><th>Тип</th><th>Статус</th></tr>
<?php

$query = "SELECT * FROM users";
$result = mysqli_query($con, $query);

while($user = mysqli_fetch_assoc($result)){
    echo "<tr>";
    echo "<td>$user[user_id]</td>";
    echo "<td>".$user['first_name']." ".$user['middle_name']." ".$user['second_name']."</td>";
    echo "<td>";
    if($user['user_type'] == 1){
        echo " Горожанин ";
    }elseif($user['user_type'] == 2){
        echo " Организатор ";
    }
    elseif($user['user_type'] == 3){
        echo " Модератор ";
    }
    elseif($user['user_type'] == 4){
        echo " Администратор ";
    }
    echo "</td>";
    if($user['status'] != 1){
        echo "<td>Заблокирован!</td>";
    }else{
        echo "<td>Активен</td>";
    }
    echo "</tr>";
    echo "</form>";
}

?>
</table>
