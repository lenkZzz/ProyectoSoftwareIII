<?php
ob_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('path/to/background-image.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            padding: 20px;
        }
        .container {
            background-color: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 10px;
        }
        .jumbotron {
            background-color: #6e91c1;
            color: #fff;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            margin-bottom: 20px;
        }
        th {
            background-color: #6e91c1;
            color: #fff;
            font-weight: bold;
            padding: 10px;
            text-align: center;
        }
        td {
            padding: 10px;
            text-align: center;
        }

        h1{
            font-size: 50px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="jumbotron">
            <h1 class="display-4">Reporte</h1>
            <p>Fecha y hora de generación: <?php
date_default_timezone_set('America/Bogota'); // Establecer la zona horaria de Colombia

$fecha_actual = date('Y-m-d'); // Obtener la fecha actual en formato YYYY-MM-DD
$hora_actual = date('H:i:s'); // Obtener la hora actual en formato HH:MM:SS

echo ' ' . $fecha_actual ;
echo ' -- ' . $hora_actual;
?></p>
        </div>
        </div>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Tipo Producto</th>
                        <th>Nombre Producto</th>
                        <th>Cantidad Producto</th>
                        <th>Fecha Producto</th>
                        <th>Correo Donante</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    require_once 'conexion.php';
                    $sql = "SELECT * FROM donacion";
                    $resultado = mysqli_query($conexion, $sql);

                    if ($resultado) {
                        while ($row = $resultado->fetch_array()) {
                            $tipo_prod = $row['tipo_prod'];
                            $nombre_prod = $row['nombre_prod'];
                            $cantidad_prod = $row['cantidad_prod'];
                            $fecha_prod = $row['fecha_prod'];
                            $correo_donante = $row['correo_donante'];
                            ?>
                            <tr>
                                <td><?php echo $tipo_prod; ?></td>
                                <td><?php echo $nombre_prod; ?></td>
                                <td><?php echo $cantidad_prod; ?></td>
                                <td><?php echo $fecha_prod; ?></td>
                                <td><?php echo $correo_donante; ?></td>
                            </tr>
                            <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<?php 
$html = ob_get_clean();

require_once '../dompdf/autoload.inc.php';
use Dompdf\Dompdf;
$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('letter');
$dompdf->render();
$dompdf->stream("reporte.pdf", array("Attachment" => true));
?>