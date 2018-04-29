<?php
ini_set('memory_limit', '1024M');
$dataList = [];
$dataBorosOffense = [];


$myfile = fopen("../csv/list_of_offenses.csv", "r");
$linea = fgets($myfile);
while ($linea = fgets($myfile)) {
    $aux = explode(";", $linea);
    $dataList[] = (string)$aux[0];
}
fclose($myfile);

$myfile = fopen("../csv/countOffenseByBoro.csv", "r");
$linea = fgets($myfile);
while ($linea = fgets($myfile)) {
    $aux = explode(";", $linea);
    $dataBorosOffense[] = [$aux[0], (string)$aux[1], $aux[2]];
}
fclose($myfile);
$data = [$dataList,$dataBorosOffense];
echo json_encode($data);
