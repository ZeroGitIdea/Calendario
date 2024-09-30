<?php
/** 
 * Dado el mes y año almacenados en variables, 
 * escribir un programa que muestre el calendario mensual correspondiente. 
 * Marcar el día actual en verde y los festivos en rojo.
 */

// Establecer el mes y año deseados
$mes = 9; // Septiembre
$año = 2024;

// Obtener el día actual
$día_actual = date('j');

// Crear un array de días festivos
$festivos = [
    1 => 'Día de la Hispanidad', // 1 de Octubre
    12 => 'Día de la Constitución', // 12 de Octubre
];

// Calcular el primer día del mes
$primer_dia = mktime(0, 0, 0, $mes, 1, $año);
$días_del_mes = date('t', $primer_dia); // Total de días en el mes
$nombre_mes = date('F', $primer_dia); // Nombre del mes

// Obtener el día de la semana del primer día del mes
$inicio_semana = date('w', $primer_dia);

// Crear un array para el calendario
$calendario = [];

// Llenar el calendario
for ($i = 0; $i < $inicio_semana; $i++) {
    $calendario[] = ''; // Espacios vacíos antes del primer día
}

for ($día = 1; $día <= $días_del_mes; $día++) {
    $calendario[] = $día; // Agregar cada día del mes
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Calendario de <?php echo $nombre_mes . ' ' . $año; ?></title>
</head>
<body>
    <h1>Calendario de <?php echo ucfirst($nombre_mes) . ' ' . $año; ?></h1>
    <table>
        <tr>
            <th>Domingo</th>
            <th>Lunes</th>
            <th>Martes</th>
            <th>Miércoles</th>
            <th>Jueves</th>
            <th>Viernes</th>
            <th>Sábado</th>
        </tr>
        <tr>
            <?php
            // Mostrar los días en el calendario
            foreach ($calendario as $día) {
                if ($día === '') {
                    echo '<td></td>'; // Celda vacía
                } else {
                    $clase = '';

                    // Verificar si es el día actual
                    if ($día == $día_actual) {
                        $clase = 'hoy'; // Clase para el día actual
                    }
                    
                    // Verificar si es un festivo
                    if (array_key_exists($día, $festivos)) {
                        $clase = 'festivo'; // Clase para festivos
                    }

                    echo "<td class='$clase'>$día" . (array_key_exists($día, $festivos) ? "<br><small>{$festivos[$día]}</small>" : '') . "</td>";
                }

                // Nueva fila cada 7 días
                if ((($día + $inicio_semana) % 7) == 0) {
                    echo '</tr><tr>';
                }
            }
            ?>
        </tr>
    </table>
</body>
</html>
