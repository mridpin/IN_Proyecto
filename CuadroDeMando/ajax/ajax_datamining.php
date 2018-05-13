<?php
ini_set('memory_limit', '1024M');
$dataFull = [];
$data1 = [];
$data2 = [];

$myfile = fopen("../csv/nyc_pop_by_boro.csv", "r");
//$linea = fgets($myfile);
while ($linea = fgets($myfile)) {
    $aux = explode(";", $linea);
    $data1[] = $aux;//[$aux[0], $aux[1]];
}
fclose($myfile);

$myfile = fopen("../csv/nyc_pop_by_boro.csv", "r");
//$linea = fgets($myfile);
while ($linea = fgets($myfile)) {
    $aux = explode(";", $linea);
    $data2[] = $aux;//[$aux[0], $aux[1]];
}
fclose($myfile);

$dataFull[] = $data1;
$dataFull[] = $data2; 

echo json_encode($dataFull);