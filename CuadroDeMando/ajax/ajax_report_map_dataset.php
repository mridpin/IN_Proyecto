<?php
ini_set('memory_limit', '1024M');
$data = [];
$myfile = fopen("../csv/report_map_dataset.csv", "r");
$linea = fgets($myfile);
while ($linea = fgets($myfile)) {
    $aux = explode(";", trim($linea));
    $data[] = [$aux[3], $aux[4]];
}
fclose($myfile);
echo json_encode($data);
