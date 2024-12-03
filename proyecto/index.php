<?php include "./views/encabezado.php"; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda Online</title>
    <link rel="stylesheet" href="./css/cards.css">
</head>

<body>
    <div class="container">
        <br>
        <h1 class="text-center"><b>DECORANDO</b></h1>

        <?php echo $mensaje; ?>

        <div class="row">
            <?php
            include "./includes/db.php";
            $consult = "SELECT * FROM inventario ORDER BY id DESC";
            $result = mysqli_query($conexion, $consult);
            if ($result && mysqli_num_rows($result) > 0) {
                while ($fila = mysqli_fetch_assoc($result)) {

                    
                    $imagen = './img/default.png'; 

                    
                    $imagenes = [
                        1 => './img/producto1.png',
                        2 => './img/producto2.png',
                        3 => './img/producto3.png',
                        4 => './img/producto4.png',
                        5 => './img/producto5.png',
                        6 => './img/producto6.png',
                        7 => './img/producto7.png',
                        8 => './img/producto8.png',
                        11 => './img/producto11.png',
                        12 => './img/producto12.png',
                        13 => './img/producto13.png',
                        14 => './img/producto14.png',
                        15 => './img/producto15.png',
                    ];

                    
                    if (isset($imagenes[$fila['id']])) {
                        $imagen = $imagenes[$fila['id']];
                    }

            ?>
                    <div class="col-md-4">
                        <br>
                        <div class="card">
                           
                            <img src="<?php echo $imagen; ?>" class="card-img-top">
                            <div class="card-body">
                                <h5 class="card-title text-center"><b><?php echo $fila['descripcion']; ?></b></h5>
                                <p class="card-text text-center stock">Stock: <?php echo $fila['stock']; ?></p>
                                <p class="card-text text-center status">Status: <?php echo $fila['status']; ?></p>
                                <p class="card-text text-center">Precio: <?php echo '$' . $fila['precioVenta']; ?></p>
                                <div class="row">
                                    <div class="col-md-8 offset-md-2">
                                        <input type="hidden" class="precioVenta" value="<?php echo $fila['precioVenta']; ?>">
                                        <button class="btn btn-primary agregar-carrito" style="width: 100%;"
                                            data-id="<?php echo $fila['id']; ?>"
                                            data-descripcion="<?php echo $fila['descripcion']; ?>"
                                            data-precioVenta="<?php echo $fila['precioVenta']; ?>"
                                            data-status="<?php echo $fila['status']; ?>"
                                            data-stock="<?php echo $fila['stock']; ?>">
                                            <b>Añadir al carrito</b> <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            <?php
                }
            }
            ?>
        </div>
    </div>
    <br>
    <br>
    <?php include "./views/pie.php"; ?>
</body>

</html>
