<?php session_start();
    require('connect_db.php');
    $event_id = $_POST['event_id'];
    $price = $_POST['price'];


    $confirmed = false;
    $payed = false;
    $money_enough = true;
    $outdated = false;
    if($_POST['submit']){

        $event_id = $_POST['event_id'];
        $account_number = $_POST['account_number'];
        $expiry_date = $_POST['expiry_date'];
        $payment_system = $_POST['payment_system'];
        $account_name = $_POST['account_name'];
        $CVV = $_POST['CVV'];
        $query = "SELECT * FROM `bank_accounts`
                    WHERE `account_number` = '$account_number'
                    AND `payment_system` = '$payment_system'
                    AND `account_name` = '$account_name'
                    AND `expiry_date` = '$expiry_date'                 
                    AND `cvv` = '$CVV'";

        $result = mysqli_query($con,$query);
        $card = mysqli_fetch_assoc($result);
        $money = $card['money'];
        $card_id = $card['account_id'];


        $card_month = (int)substr($expiry_date, 0, 2);
        $card_year = (int)substr($expiry_date, 2, 2);

        $now_month = (int)date('m');
        $now_year = (int)date('y');

        if($card_year < $now_year)
        {
            $outdated = true;
            $payed = false;
        }elseif (($card_year == $now_year) && ($card_month < $now_month)){
            $outdated = true;
            $payed = false;
        }

        if($card)
        {

            $confirmed = true;
            if(($price <= $money) AND !$outdated){
                $query = "UPDATE bank_accounts SET money = money - $price WHERE account_id = $card_id";
                $result = mysqli_query($con,$query);
                if($result){
                    $payed = true;
                }
                if($payed){
                    $query = "UPDATE bank_accounts SET money = money + $price 
                    WHERE `account_number` = '4672893289182378'
                    AND `payment_system` = 'Mastercard'
                    AND `account_name` = 'Administrator'
                    AND `expiry_date` = '0123'                 
                    AND `cvv` = '123'";
                    mysqli_query($con,$query);

                    $query = "INSERT INTO transactions (event_id, account_number, expiry_date, payment_system, account_name, cvv, price) VALUES ('$event_id', '$account_number', '$expiry_date', '$payment_system', '$account_name', '$CVV', '$price')";
                    mysqli_query($con,$query);
                }
            }else{
                $payed = false;
                $money_enough = false;
            }

        }if(!$payed){
          //$query = "DELETE FROM events WHERE event_id = $event_id";
          //mysqli_query($con, $query);
        }
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
            <div style="text-align: center;">
                <?php
                if ($payed) {
                    echo "<strong style='color: green; font-size: 1.2rem;'>Заказ удачно оформен </strong>
                           <form action='pdf.php' method='post'>
                               <input type='text' name='event_id' value='$event_id' hidden>
                               <input type='text' name='price' value='$price' hidden>
                               
                               <input type='submit' name ='print_payed' value='Распечатать чек!'>
                           </form>";
                }elseif($outdated){
                    echo "<strong style='color: red; font-size: 1.2rem;'>Закончился срок службы карты</strong>";
                }elseif (!$money_enough){
                    echo "<strong style='color: red; font-size: 1.2rem;'>Не хватает средств</strong>";
                }
                elseif(!$confirmed AND isset($_POST['submit'])){
                    echo "<strong style='color:red; font-size: 1.2rem; '>Ошибка ввода данных карты</strong>";
                }


                if(!$payed){ ?>
                <div class="account__wrapper">
                    <form action="pay_for_adds.php" class="account__input" method="post">
                        <?php
                            echo "<input type=\"hidden\" name=\"event_id\" class=\"\"  value=\"".$event_id."\"required>";
                            echo "<input type=\"hidden\" name=\"price\" class=\"\"  value=\"".$price."\"required>";
                            ?>
                            <label for="account_number">
                            Введите номер банковской карты
                            <input type="text" name="account_number" class="" required>
                        </label>
                        <label for="expiry_date">
                            Введите срок действия карты
                            <input type="text" name="expiry_date" class="" required>
                        </label>
                        <label for="payment_system">
                            Название платежной системы (Visa/MasterCard)
                            <input type="text" name="payment_system" class="" required>
                        </label>
                        <label for="account_name">
                            Введите имя владельца
                            <input type="text" name="account_name" class="" required >
                        </label>
                        <label for="СVV"  >
                            Введите CVV код
                            <input type="text" name="CVV" size="3" maxlength="3" class="" required>
                        </label>
                        <input type="submit" name="submit">
                    </form>
                </div>
                <?php }


                ?>
            </div>
        </div>
            <?php include('footer.php'); ?>

    </div>
    </body>

    </html>


