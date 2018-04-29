<?php

ini_set('memory_limit', '1024M');
// Estructura de $data: [BORO, poblacion, crimenes, crime/population, densidad poblacion] 
$data = [[]];
$myfile = fopen("nyc_pop_by_boro.csv", "r");
$linea = fgets($myfile);
$i = 0;
while ($linea = fgets($myfile)) {
    $aux = explode(";", $linea);
    $data[$i] = [];
    $data[$i][0] = $aux[0];
    $data[$i][1] = $aux[1];
    $data[$i][2] = 10000;
    $data[$i][3] = 10000 / $aux[1];
    $data[$i][4] = $aux[2];
    $i++;
}
fclose($myfile);
echo json_encode($data);

