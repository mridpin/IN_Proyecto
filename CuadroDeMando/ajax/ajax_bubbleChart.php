<?php

ini_set('memory_limit', '1024M');
// Estructura de $data: [BORO, poblacion, crimenes, crime/population, densidad poblacion] 
$data = [[]];
$offenseByBoro = [];
$crimeFile = fopen("../csv/offenseByBoro.csv", "r");
$linea = fgets($crimeFile);
$i = 0;
// Bucle que guarda un array asociativo de tipo $offenseByBoro["boro"] = # 
while ($linea = fgets($crimeFile)) {
    $aux = explode(";", trim($linea));
    $offenseByBoro[$aux[0]] = $aux[1];
}
fclose($crimeFile);


$popFile = fopen("../csv/nyc_pop_by_boro.csv", "r");
$linea = fgets($popFile);
$i = 0;
while ($linea = fgets($popFile)) {
    $aux = explode(";", trim($linea));
    $data[$i] = [];
    $data[$i][0] = $aux[0]; // Contiene el nombre del boro
    $data[$i][1] = $aux[1]; // Poblacion total del boro
    $data[$i][2] = $offenseByBoro[$aux[0]]; // Crimenes totales en el boro
    $data[$i][3] = $aux[1] / $offenseByBoro[$aux[0]]; // Poblacion / crimenes
    $data[$i][4] = $aux[2]; // Densidad de poblacion por km2
    $i++;
}
fclose($popFile);
echo json_encode($data);

