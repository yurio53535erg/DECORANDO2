<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idArt = $_POST['idArt'];
    $descripcion = $_POST['descripcion'];
    $cantidad = $_POST['cantidad'];
    $status = $_POST['status'];
    $precioVenta = $_POST['precioVenta'];

    if (!isset($_SESSION['carrito'])) {
        $_SESSION['carrito'] = [];
    }

    $itemExists = false;
    foreach ($_SESSION['carrito'] as &$item) {
        if ($item['idArt'] == $idArt) {
            $item['cantidad'] += $cantidad;  
            $itemExists = true;
            break;
        }
    }
    if (!$itemExists) {
        $_SESSION['carrito'][] = [
            'idArt' => $idArt,
            'descripcion' => $descripcion,
            'cantidad' => $cantidad,
            'status' => $status,
            'precioVenta' => $precioVenta
        ];
    }

    echo json_encode(['success' => true]);
}
?>
