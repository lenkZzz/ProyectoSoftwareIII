<?php 
$inc = include('conexion.php');
if($inc){
    $sql = "SELECT * FROM donacion";
    $resultado = mysqli_query($conexion, $sql);
    if($resultado){
        ?>
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap');
            @import url('https://fonts.googleapis.com/css2?family=Darumadrop+One&display=swap');
            @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@500&display=swap');

            *{
                margin: 0;
                padding: 0;
                box-sizing: border-box;
                font-family: 'Poppins', sans-serif;
                
            }
            body{
                background-color: #6e91c1;
            }
            .main_text{
                background-color: #72c1e8;
                color: #FFFFFF;
                display: flex;
                justify-content: center;
                padding: 22px;
                width: 1200px; 
                height: 100px; 
                margin: 20px auto;
                border-radius: 10px
            }
            .body_table{
                width: 1200px; 
                height: 600px; /* Ajusta la altura según tus necesidades */
                max-width: 1200px; /* Establece el ancho máximo para evitar que se vuelva demasiado grande */
                background-color: #ccc;
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                border-radius: 10px;
                
            }
            .table{
                display: flex;
                justify-content: center;
            }
            table{
                border-collapse: separate;
                border-spacing: 10px
            }
            th {
                 background-color: #6e91c1; /* Color de fondo */
                color: #FFFFFF; /* Color de texto */
                font-weight: bold; /* Fuente en negrita */
                 padding: 10px; /* Espaciado interno */
                 border: 1px solid #ccc; /* Borde */
                }
            td, th {
            padding: 10px; /* Ajusta el valor para obtener el espaciado deseado */
            }
        </style>
        <body>
            <div class="main_text">
                <h1>Consulta donaciones</h1>
            </div>
            <div class="body_table">
                <div class="table">
                <table>
            <thead>
                <tr>
                    <th>Tipo prod</th>
                    <th>Nombre prod</th>
                    <th>Cantidad prod</th>
                    <th>Fecha prod</th>
                    <th>Correo donante</th>
                    <th>Estado donación</th>
                </tr>
            </thead>
            <tbody>
            <?php
            while($row = $resultado->fetch_array()){
                $tipo_prod = $row['tipo_prod'];
                $nombre_prod = $row['nombre_prod'];
                $cantidad_prod = $row['cantidad_prod'];
                $fecha_prod = $row['fecha_prod'];
                $correo_donante = $row['correo_donante'];
                $estado_don = $row['estado_don']
                ?>
                <tr>
                    <td><?php echo $tipo_prod; ?></td>
                    <td><?php echo $nombre_prod; ?></td>
                    <td><?php echo $cantidad_prod; ?></td>
                    <td><?php echo $fecha_prod; ?></td>
                    <td><?php echo $correo_donante; ?></td>
                    <td><?php echo $estado_don; ?></td>
                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
                </div>
            </div>
        
            
        </body>
        
        <?php
    }
}
?>