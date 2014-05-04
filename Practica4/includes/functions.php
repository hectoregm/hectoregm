<?php

// Create full name from row data
function fullname($row) {
    return $row['nombre'] . ' ' .  $row['a_paterno'] . ' ' . $row['a_materno'];
}

function gender($row) {
    return $row['sexo'] == 0 ? 'Femenino' : 'Masculino';
}

function age($row) {
    $tz  = new DateTimeZone('America/Mexico_City');
    return $age = DateTime::createFromFormat('Y-m-d', $row['f_nacimiento'], $tz)->diff(new DateTime('now', $tz))->y;
}

?>