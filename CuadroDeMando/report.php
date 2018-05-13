<div class="container-fluid">
    <div class="row">
        <div class="col-xs-7">
            <div id="series_chart_div" style="width: 100%; height: 200px;"></div>
        </div>
        <div class="col-xs-5">
            <div id="piechart_3d" style="width: 100%; height: 200px;"></div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div id="chart_div1" style="width: 100%; height: 400px;"></div>
        </div>
    </div>
</div>



<script type="text/javascript">
    $(document).ready(function () {

        //BUBBLE
        google.charts.load('current', {'packages': ['corechart']});
        google.charts.setOnLoadCallback(drawSeriesChart);

        function ajax_bubbleChart() {
            var data = [];
            data.push(['Borough', 'Population', 'Crimes', 'People per Crime', 'Population Density(km2)']);

            $.ajax({
                type: 'POST',
                async: false,
                url: "ajax/ajax_bubbleChart.php",
            }).done(function (input) {
                console.log(input);
                var datos = JSON.parse(input);
                for (var i = 0; i < datos.length; i++) {
                    data.push([datos[i][0], parseInt(datos[i][1]), parseInt(datos[i][2]), parseFloat(datos[i][3]), parseFloat(datos[i][4])]);
                }
            });
            return data;
        }
        function drawSeriesChart() {

            var data = google.visualization.arrayToDataTable(ajax_bubbleChart());

            var options = {
                title: 'Correlation between population, crimes and population density in NYC boroughs',
                hAxis: {title: 'Population'},
                vAxis: {title: 'Crimes'},
                bubble: {textStyle: {fontSize: 11}},
                colorAxis: {colors: ['red', 'green']}
            };

            var chart = new google.visualization.BubbleChart(document.getElementById('series_chart_div'));
            chart.draw(data, options);
        }



        //PIE
        function ajax_offenseByBoro() {
            var aData = [['Boro', 'Number crimes']];

            $.ajax({
                type: 'POST',
                async: false,
                url: "ajax/ajax_pieChart.php",
            }).done(function (data) {
                var datos = JSON.parse(data);
                for (var i = 0; i < datos.length; i++) {
                    aData[aData.length] = [datos[i][0], parseInt(datos[i][1])];
                }
            });
            return aData;
        }
        google.charts.load("current", {packages: ["corechart"]});
        google.charts.setOnLoadCallback(drawChart);
        function drawChart() {

            var data = google.visualization.arrayToDataTable(ajax_offenseByBoro());

            var options = {
                title: 'Crimes in New York by borough',
                is3D: true,
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
            chart.draw(data, options);
        }


        //COLUMSCHART
        function ajax_ajax_columsChart() {
            var aData = [];

            function indexOffense(offense, aOffenses) {
                var index = -1;
                var cont = 0;
                var encontrado = false;
                while (encontrado == false && cont < aOffenses.length) {
                    if (aOffenses[cont].localeCompare(offense) == 0) {
                        index = cont;
                        encontrado = true;
                    }
                    cont++;

                }
                return index;
            }


            $.ajax({
                type: 'POST',
                async: false,
                url: "ajax/ajax_columsChart.php",
            }).done(function (data) {
                var datos = JSON.parse(data);

                var fila1 = ["Boro"];
                var BROOKLYN = ["BROOKLYN"];
                var MANHATTAN = ["MANHATTAN"];
                var QUEENS = ["QUEENS"];
                var BRONX = ["BRONX"];
                var STATEN_ISLAND = ["STATEN ISLAND"];

                //Inicializo arrays
                for (var i = 0; i < datos[0].length; i++) {
                    fila1[fila1.length] = String(datos[0][i].slice(0, -1).replace("\r", ""));
                    BROOKLYN[BROOKLYN.length] = 0;
                    MANHATTAN[MANHATTAN.length] = 0;
                    QUEENS[QUEENS.length] = 0;
                    BRONX[BRONX.length] = 0;
                    STATEN_ISLAND[STATEN_ISLAND.length] = 0;
                }



                for (var i = 0; i < datos[1].length; i++) {
                    //aData[aData.length] = [datos[i][0],parseInt(datos[i][1])];
                    switch (datos[1][i][0]) {
                        case "BROOKLYN":
                            var index = indexOffense(String(datos[1][i][1]), fila1);
                            if (index > 0) {
                                BROOKLYN[index] = parseInt(datos[1][i][2]);
                            }
                            break;
                        case "MANHATTAN":
                            var index = indexOffense(String(datos[1][i][1]), fila1);
                            if (index > 0) {
                                MANHATTAN[index] = parseInt(datos[1][i][2]);
                            }
                            break;
                        case "QUEENS":
                            var index = indexOffense(String(datos[1][i][1]), fila1);
                            if (index > 0) {
                                QUEENS[index] = parseInt(datos[1][i][2]);
                            }
                            break;
                        case "BRONX":
                            var index = indexOffense(String(datos[1][i][1]), fila1);
                            if (index > 0) {
                                BRONX[index] = parseInt(datos[1][i][2]);
                            }
                            break;
                        case "STATEN ISLAND":
                            var index = indexOffense(String(datos[1][i][1]), fila1);
                            if (index > 0) {
                                STATEN_ISLAND[index] = parseInt(datos[1][i][2]);
                            }
                            break;
                        default:

                    }
                }
                aData[aData.length] = fila1;
                aData[aData.length] = BROOKLYN;
                aData[aData.length] = MANHATTAN;
                aData[aData.length] = QUEENS;
                aData[aData.length] = BRONX;
                aData[aData.length] = STATEN_ISLAND;
            });
            return aData;
        }
        google.charts.load('current', {'packages': ['corechart']});
        google.charts.setOnLoadCallback(drawVisualization);

        function drawVisualization() {
            // Some raw data (not necessarily accurate)
            var data = google.visualization.arrayToDataTable(ajax_ajax_columsChart());

            var options = {
                title: 'Crimes in New York by borough and type offense',
                vAxis: {title: 'Numbers of crimes'},
                hAxis: {title: 'Boroughs'},
                seriesType: 'bars',
                series: {10: {type: 'line'}}
            };

            var chart = new google.visualization.ComboChart(document.getElementById('chart_div1'));
            chart.draw(data, options);
        }
    });
</script>

