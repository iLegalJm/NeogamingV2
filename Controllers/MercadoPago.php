<?php

require_once __DIR__ . '/vendor/autoload.php';
$access_token = 'TEST-1465155314365261-071523-c7b1e9f5cbc13d45582b61224165c5d5-1424312923';
MercadoPago\SDK::setAccessToken($access_token);

$preference = new MercadoPago\Preference();

$preference->back_urls = array(
 
);

$productos = [];
$item = new MercadoPago\Item();
$item->title = "Zapatillas";
$item->quantity = 1;
$item->unit_prices = 60;
array_push($productos, $item);

$preference->items = $productos;
$preference->save();

?>