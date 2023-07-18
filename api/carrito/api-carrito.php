<?php
require_once '../../classes/session.php';
require_once 'carrito.php';

if (isset($_GET['action'])) {
    $accion = $_GET['action'];

    $carrito = new Carrito();

    switch ($accion) {
        case 'mostrar':
            mostrar($carrito);
            break;
        case 'add':
            add($carrito);
            break;
        case 'remove':
            remove($carrito);
            break;
        default:
            echo "error";
            break;
    }
} else {
    echo json_encode(['statuscode' => 404, 'response' => 'No se puede procesar la solicitud']);
}

function mostrar($carrito)
{
    //?Cargar el arreglo en la sesion activa
    //?consultar a la base de datos para actualizar los productos
    $itemsCarrito = json_decode($carrito->load(), 1);
    $fullItems = [];
    $total = 0;
    $totalItems = 0;

    foreach ($itemsCarrito as $itemCarrito) {
        require_once '../../Config/config.php';
        require_once '../../libs/database.php';
        require_once '../../libs/model.php';
        require_once '../../Model/Producto.php';
        $productoModel = new ProductoModel();
        $item = $productoModel->get($itemCarrito['id'])->toArray();

        $itemProducto = json_decode(json_encode([
            'statuscode' => 200,
            'item' => $item
        ]), 1)['item'];
        $itemProducto['cantidad'] = $itemCarrito['cantidad'];
        $itemProducto['subtotal'] = $itemProducto['cantidad'] * $itemProducto['precio'];

        $total += $itemProducto['subtotal'];
        $totalItems += $itemProducto['cantidad'];
        array_push($fullItems, $itemProducto);
    }

    $resArray = array('info' => ['count' => $totalItems, 'total' => $total], 'items' => $fullItems);
    echo json_encode($resArray);
}

function add($carrito)
{
    if (isset($_GET['id'])) {
        $res = $carrito->add($_GET['id']);
        echo $res;
    } else {
        echo json_encode(['statuscode' => 404, 'response' => 'No se puede procesar la solicitud, id vacio']);
    }
}

function remove($carrito)
{
    if (isset($_GET['id'])) {
        $res = $carrito->remove($_GET['id']);
        if ($res) {
            echo json_encode(['statuscode' => 200]);
        } else {
            echo json_encode(['statuscode' => 400]);
        }
    } else {
        // error
    }
}


?>