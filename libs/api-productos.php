<?php

require_once '../Config/config.php';
require_once '../libs/database.php';
// require_once '../libs/imodel.php';
require_once '../libs/model.php';
require_once '../Model/Producto.php';
$res = [];
$productoModel = new ProductoModel();
$productos = $productoModel->get(1)->toArray();
// foreach ($productos as $producto) {
//     array_push($res, $producto->toArray());
// }
echo json_encode($productos);

?>