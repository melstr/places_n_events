<?php
session_start();
//var_dump($_SESSION);
$first_name = $_SESSION['first_name'];
$middle_name = $_SESSION['middle_name'];
$second_name = $_SESSION['second_name'];
$user_status = $_SESSION['user_status'];
$user_id = $_SESSION['user_id'];

include('connect_db.php');
require_once("vendor/autoload.php");
if(isset($_POST['print_payed'])){

    $event_id = $_POST['event_id'];
    $price = $_POST['price'];

    $query = "SELECT * FROM events WHERE event_id = '$event_id'";
    $result = mysqli_query($con, $query);
    $event = mysqli_fetch_assoc($result);

    $query = "SELECT * FROM transactions WHERE event_id = '$event_id'";
    $result = mysqli_query($con, $query);
    $transaction = mysqli_fetch_assoc($result);

    $html_part = "<h1>Вы оплатили $price рублей за оплату рекламы</h1>
                    <div><strong>ID события:</strong> $event_id</div>
                    <div><strong>Название события:</strong> $event[title]</div>
                    <div><strong>ID организатора:</strong> $user_id</div>
                    <div><strong>Имя организатора:</strong> $first_name $middle_name $second_name</div>
                    <div><strong>№ транзакции:</strong> $transaction[payment_id]</div>";


    $mpdf = new \Mpdf\Mpdf();
    $mpdf->SetTitle("Чек за оплату рекламы:");
    $mpdf->Bookmark('Start of the document');
    $mpdf->WriteHTML($html_part);
    $mpdf->Output("Чек за оплату.pdf", 'I');
}
if(isset($_POST['users_print'])){
    ob_start();
    include('users_pdf.php');
    $body = ob_get_clean();

    $mpdf = new \Mpdf\Mpdf();
    $mpdf->SetTitle("Список пользователей");
    $mpdf->Bookmark('Start of the document');
    $mpdf->WriteHTML($body);

    $mpdf->Output("Список пользователей.pdf", 'I');
}