<?php

namespace Controllers;

use Templates\OrderTemplate;
use Services\FileStorage;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Order
{
    public function create(): string
    {
        $objStorage = new FileStorage();

        $arr = [];
        $arr['name'] = urldecode($_POST['name']);
        $arr['address'] = urldecode($_POST['address']);
        $arr['phone'] = $_POST['phone'];
        $arr['created_at'] = date("d-m-Y H:i:s");
        $products = $objStorage->loadData('data.json');

        session_start();
        $all_sum = 0;
        $items = [];
        foreach ($products as $product) {
            $id = $product['id'];
            if (array_key_exists($id, $_SESSION['basket'])) {
                $item = [];
                $item['name'] = urldecode($product['name']);
                $item['quantity'] = $_SESSION['basket'][$id]['quantity'];
                $item['price'] = $product['price'];
                $item['sum'] = $item['price'] * $item['quantity'];
                $all_sum += $item['sum'];
                array_push($items, $item);
            }
        }
        $arr['all_sum'] = $all_sum;
        $arr['products'] = $items;

        
        $_SESSION['flash'] = "Заказ создан";
        $_SESSION['basket'] = [];
        header("location: /");
        return '';
    }

    public function get(): string
    {
        session_start();

        if (!isset($_SESSION['basket'])) {
            $_SESSION['basket'] = [];
        }

        $objStorage = new FileStorage();
        $products = $objStorage->loadData('data.json');

        $all_sum = 0;
        $str_list = '<h1>Создать заказ</h1><h3>Корзина (список выбранных вами товаров)</h3>';
        foreach ($products as $product) {
            $id = $product['id'];
            if (array_key_exists($id, $_SESSION['basket'])) {
                $quantity = $_SESSION['basket'][$id]['quantity'];
                $name = $product['name'];
                $price = $product['price'];

                $sum = $price * $quantity;
                $all_sum += $sum;
                $str_list .= <<<LINE
                <div class="row mb-3">
                    <div class="col-6">
                    {$name}
                    </div>
                    <div class="col-2">
                    {$quantity}
                    </div>
                    <div class="col-2">
                    {$sum}
                    </div> 
                </div>   
                LINE;
            }
        }
        if ($all_sum === 0) {
            $str_list .= <<<LINE
            <div class="row">
                <div class="col-12">
                    нет добавленных товаров
                </div>
            </div>
            LINE;
        } else {
            $str_list .= <<<LINE
            <div class="row">
                <div class="col-6">
                <hr>
                Общая сумма заказа:
                </div>
                <div class="col-2">
                <hr>
                &nbsp;
                </div>
                <div class="col-2">
                <hr>
                {$all_sum} ₽
                </div>
                </div>
                <div class="row">
                <div class="col-6">
                &nbsp;
                </div>
                <div class="col-6">
                    <form action="/basket_add" method="POST">
                        <button type="submit" class = "btn btn-primary mt-3">Очистить корзину</button>
                    </form>
                </div>
            </div>
            
            LINE;
            $str_list .= <<<LINE
            <div class="row">
                <div class="col-6">
                    <form action="/orders" method="POST">

                        <label for="name">Ваше ФИО:</label><br>
                        <input type="text" id="name" name="name" class="form-control" required><br><br>

                        <label for="address">Адрес доставки:</label><br>
                        <input type="text" id="address" name="address" class="form-control" required><br><br>

                        <label for="phone">Телефон:</label><br>
                        <input type="text" id="phone" name="phone" class="form-control" required><br><br>

                        <button type="submit">Создать заказ</button>
                </div>
            </div>
            LINE;
        }
        $objTemplate = new OrderTemplate();
        $template = $objTemplate->getTemplate($str_list);

        return $template;


    }
    public function sendMail($email)
    {
        $mail = new PHPMailer();
        if (isset($email) && !empty($email)) {
            try {
                $mail->SMTPDebug = 2;
                $mail->CharSet = 'UTF-8';
                $mail->SetFrom("v.milevskiy@coopteh.ru", "ОАЗИС ПИЦЦЫ");
                $mail->addAddress($email);
                $mail->isHTML(true);
                $mail->isSMTP();                                            //Send using SMTP
                $mail->Host = 'ssl://smtp.mail.ru';                     //Set the SMTP server to send through
                $mail->SMTPAuth = true;                                   //Enable SMTP authentication
                $mail->Username = 'v.milevskiy@coopteh.ru';                     //SMTP username
                $mail->Password = 'hF8xTWxXyKcCnEg1n9Wz';
                $mail->Port = 465;
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                $mail->Subject = 'Заявка с сайта: ОАЗИС ПИЦЦЫ';
                $mail->Body = 'Информационное сообщение c сайта ОАЗИС ПИЦЦЫ <br><br>
                ------------------------------------------<br>
                <br>
                Спасибо!<br>
                <br>
                Ваш заказ успешно создан и передан службе доставки.<br>
                <br>
                Сообщение сгенерировано автоматически.';

                if ($mail->send()) {
                    return true;
                } else {
                    throw new Exception('Ошибка с отправкой письма');
                }
            } catch (Exception $error) {
                $message = $error->getMessage();
            }
        }
        return false;
    }
}