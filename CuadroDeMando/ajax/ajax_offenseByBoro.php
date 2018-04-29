<?php
ini_set('memory_limit', '1024M');
$data = [];
$myfile = fopen("../csv/offenseByBoro.csv", "r");
$linea = fgets($myfile);
while ($linea = fgets($myfile)) {
    $aux = explode(";", $linea);
    $data[] = [$aux[0], $aux[1]];
}
fclose($myfile);
echo json_encode($data);
