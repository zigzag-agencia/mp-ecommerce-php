<?php
require 'vendor/autoload.php';

$url = 'https://zigzag-agencia-mp-commerce-php.herokuapp.com/';
//$url = 'http://pruebamp/';

MercadoPago\SDK::setAccessToken('APP_USR-6317427424180639-042414-47e969706991d3a442922b0702a0da44-469485398');
MercadoPago\SDK::setIntegratorId("dev_24c65fb163bf11ea96500242ac130004");

/* Armo preferencia de pago */
$preference = new MercadoPago\Preference();

$preference->back_urls = array(
    "success" => $url."pago-aprobado.php",
    "failure" => $url."pago-rechazado.php",
    "pending" => $url."pago-pendiente.php"
);
$preference->auto_return = "approved";
$preference->external_reference = 'leo.j.diaz@gmail.com';
$preference->notification_url = 'https://zigzag-agencia-mp-commerce-php.herokuapp.com/mp_notifications.php';
$preference->payment_methods = array(
    "excluded_payment_methods" => array(
        array("id" => "amex")
    ),
    "excluded_payment_types" => array(
        array("id" => "atm")
    ),
    "installments" => 6
);

/* ARMO PERFIL DE COMPRADOR */
$payer = new MercadoPago\Payer();
$payer->name = "Lalo";
$payer->surname = "Landa";
$payer->email = "test_user_63274575@testuser.com";
$payer->phone = array(
    "area_code" => "11",
    "number" => "22223333"
);
$payer->address = array(
    "street_name" => "False",
    "street_number" => 123,
    "zip_code" => "1111"
);
$preference->payer = $payer;


/* Armo Item*/
$item = new MercadoPago\Item();
$item->id = 1234;
$item->title = $_POST['title'];
$item->description = 'Dispositivo móvil de Tienda e-commerce';
$item->quantity = 1;
$item->unit_price = $_POST['price'];
$item->picture_url = "https://zigzag-agencia-mp-commerce-php.herokuapp.com/".str_replace("./","",$_POST['img']);

$preference->items = array($item);

$preference->save();
?>