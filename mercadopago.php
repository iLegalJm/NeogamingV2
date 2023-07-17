<?php
require 'vendor/autoload.php';

MercadoPago\SDK::setAccessToken('TEST-1465155314365261-071523-c7b1e9f5cbc13d45582b61224165c5d5-1424312923');

$preference = new MercadoPago\Preference();

$utem = new MercadoPago\Item();
$utem->id = 001;
$utem->title = 'ProductoOP';
$utem->quantity = 1;
$utem->unit_price = 150;
if (isset($_COOKIE['total'])) {
    $utem->unit_price = $_COOKIE['total'];
}
$utem->currency_id =
    "PEN";
$preference->items = array($utem);
$preference->back_urls = array(
    'success' => "http://localhost:8080/Producto",
    'failure' =>
    'http://localhost:8080/Producto'
);
$preference->auto_return = "approved";
$preference->binary_mode = true;
$preference->save();

echo json_encode($preference->id);
?>