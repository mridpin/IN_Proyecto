<div class="container-fluid">
            <div class="row">
                <div class="col-xs-4">
                    <div id="regions_div1" style="width: 100%; height: 200px;"></div>
                </div>
                <div class="col-xs-4">
                    <div id="series_chart_div" style="width: 100%; height: 200px;"></div>
                </div>
                <div class="col-xs-4">
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
                /*
                 $.ajax({
                 url: "https://data.cityofnewyork.us/resource/7x9x-zpz6.json?$where=lat_lon is not null",
                 //url: "https://data.cityofnewyork.us/resource/7x9x-zpz6.json?$select=law_cat_cd&$group=law_cat_cd",
                 //url: "https://data.cityofnewyork.us/resource/7x9x-zpz6.json?$select=ofns_desc&$group=ofns_desc",
                 type: "GET",
                 data: {
                 "$limit" : 10000,
                 "$$app_token" : "bjp8KrRvAPtuf809u1UXnI0Z8"
                 }
                 }).done(function(data) {
                 alert("Retrieved " + data.length + " records from the dataset!");
                 //console.log(data);
                 var aDatos = data;
                 var cont = 0;
                 for (var obj in aDatos) {
                 //for(var i=0; i < aDatos.length;i++){
                 //if(aDatos[obj].ofns_desc != undefined){
                 $('#tabla').append("<tr><td>" + aDatos[obj].boro_nm + "<td><td>"+ (cont+1) +"</td><tr>");
                 //$('#tabla').append("<tr><td>" + aDatos[obj].law_cat_cd + "<td><tr>");
                 //$('#tabla').append("<tr><td>" + aDatos[obj].ofns_desc + "<td><tr>");
                 //}
                 //console.log(aDatos[obj].boro_nm);
                 console.log(aDatos.length);
                 cont++;
                 
                 }
                 console.log(cont)
                 });
                 */



                //MAPA
                /*           google.charts.load('current', {
                 'packages': ['geochart'],
                 // Note: you will need to get a mapsApiKey for your project.
                 // See: https://developers.google.com/chart/interactive/docs/basic_load_libs#load-settings
                 'mapsApiKey': 'AIzaSyD-9tSrke72PouQMnMX-a7eZSW0jkFMBWY'
                 });
                 google.charts.setOnLoadCallback(drawRegionsMap);
                 
                 function drawRegionsMap() {
                 var data = google.visualization.arrayToDataTable([
                 ['Boro', 'Crimes'],
                 ['BROOKLYN', 200],
                 ['MANHATTAN', 300],
                 ['QUEENS', 400],
                 ['BRONX', 500],
                 ['STATEN ISLAND', 600]
                 ]);
                 
                 var options = {
                 region: 'US',
                 displayMode: 'markers',
                 colorAxis: {colors: ['green', 'blue']}
                 };
                 
                 
                 var chart = new google.visualization.GeoChart(document.getElementById('regions_div1'));
                 
                 chart.draw(data, options);
                 }
                 */
           //BUBBLE
        google.charts.load('current', {'packages': ['corechart']});
        google.charts.setOnLoadCallback(drawSeriesChart);

        function ajax_bubbleChart() {
            var data = [];
            data.push(['Boro', 'Población', 'Crímenes', 'Crimenes/Población', 'Densidad de población']);

            $.ajax({
                type: 'POST',
                async: false,
                url: "ajax_bubbleChart.php",
            }).done(function (input) {
                var datos = JSON.parse(input);
                for (var i = 0; i < datos.length; i++) {
                    data.push([datos[i][0], parseInt(datos[i][1]), parseInt(datos[i][2]), parseFloat(datos[i][3]), parseFloat(datos[i][4])]);
                }
            });
            return data;
        }
        function drawSeriesChart() {

//                    var data = google.visualization.arrayToDataTable([
//                        ['Boro', 'Eje X', 'Eje Y', 'Crime/Population', 'Population Density'],
//                        ['BROOKLYN', 80.66, 1.67, 10, 33739900],
//                        ['MANHATTAN', 79.84, 1.36, 12, 81902307],
//                        ['QUEENS', 78.6, 1.84, 20, 5523095],
//                        ['BRONX', 72.73, 2.78, 6, 79716203],
//                        ['STATEN ISLAND', 80.05, 2, 15, 61801570],
//                    ]);

                    var data = google.visualization.arrayToDataTable(ajax_bubbleChart());

            var options = {
                title: 'Correlation between x axis, y axis, crime ' +
                        'and population of NYC Boros',
                hAxis: {title: 'Población'},
                vAxis: {title: 'Crímines'},
                bubble: {textStyle: {fontSize: 11}},
                colorAxis: {colors: ['green', 'red']}
            };

            var chart = new google.visualization.BubbleChart(document.getElementById('series_chart_div'));
            chart.draw(data, options);
        }



                //PIE
                function ajax_offenseByBoro(){
                var aData = [['Boro', 'Number crimes']];

                    $.ajax({
                        type: 'POST',
                        async: false,
                        url: "ajax/ajax_offenseByBoro.php",
                    }).done(function (data) {
                        var datos = JSON.parse(data);
                        for(var i=0; i < datos.length;i++){
                            aData[aData.length] = [datos[i][0],parseInt(datos[i][1])];
                        }
                    });
                    return aData;
                }
                google.charts.load("current", {packages: ["corechart"]});
                google.charts.setOnLoadCallback(drawChart);
                function drawChart() {

                    var data = google.visualization.arrayToDataTable(ajax_offenseByBoro()/*[
                        ['Boro', 'Number crimes'],
                        ['BROOKLYN', 11],
                        ['MANHATTAN', 2],
                        ['QUEENS', 2],
                        ['BRONX', 2],
                        ['STATEN ISLAND', 7]
                    ]*/);

                    var options = {
                        title: 'Crimes in New York by boro',
                        is3D: true,
                    };

                    var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
                    chart.draw(data, options);
                }


                //COLUMNAS
                
                
                
                function ajax_countOffenseByBoro(){
                var aData = [];

                    function indexOffense(offense,aOffenses){
                        var index = -1;
                        var cont = 0;
                        var encontrado = false;
                        while( encontrado == false && cont < aOffenses.length){
                            if(aOffenses[cont].localeCompare(offense) == 0){
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
                        url: "ajax/ajax_countOffenseByBoro.php",
                    }).done(function (data) {
                        var datos = JSON.parse(data);
                        
                        var fila1 = ["Boro"];
                        var BROOKLYN = ["BROOKLYN"];
                        var MANHATTAN = ["MANHATTAN"];
                        var QUEENS = ["QUEENS"];
                        var BRONX = ["BRONX"];
                        var STATEN_ISLAND = ["STATEN ISLAND"];
                        
                        //Inicializo arrays
                        for(var i=0; i < datos[0].length;i++){
                            fila1[fila1.length] = String(datos[0][i].slice(0,-1).replace("\r",""));
                            BROOKLYN[BROOKLYN.length] = 0;
                            MANHATTAN[MANHATTAN.length] = 0;
                            QUEENS[QUEENS.length] = 0;
                            BRONX[BRONX.length] = 0;
                            STATEN_ISLAND[STATEN_ISLAND.length] = 0;
                        }
                            
                        
                        
                        for(var i=0; i < datos[1].length;i++){
                            //aData[aData.length] = [datos[i][0],parseInt(datos[i][1])];
                            switch(datos[1][i][0]) {
                                case "BROOKLYN":
                                    var index = indexOffense(String(datos[1][i][1]),fila1);
                                    if(index > 0){
                                        BROOKLYN[index] = parseInt(datos[1][i][2]);
                                    }    
                                    break;
                                case "MANHATTAN":
                                    var index = indexOffense(String(datos[1][i][1]),fila1);
                                    if(index > 0){
                                        MANHATTAN[index] = parseInt(datos[1][i][2]);
                                    }    
                                    break;
                                case "QUEENS":
                                    var index = indexOffense(String(datos[1][i][1]),fila1);
                                    if(index > 0){
                                        QUEENS[index] = parseInt(datos[1][i][2]);
                                    } 
                                    break;
                                case "BRONX":
                                    var index = indexOffense(String(datos[1][i][1]),fila1);
                                    if(index > 0){
                                        BRONX[index] = parseInt(datos[1][i][2]);
                                    } 
                                    break;
                                case "STATEN ISLAND":
                                    var index = indexOffense(String(datos[1][i][1]),fila1);
                                    if(index > 0){
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
                    var data = google.visualization.arrayToDataTable(ajax_countOffenseByBoro()/*[
                        ['Boro', 'Bolivia', 'Ecuador', 'Madagascar', 'Papua New Guinea', 'Rwanda', 'Average', 'Bolivia', 'Ecuador', 'Madagascar', 'Papua New Guinea'],
                        ['BROOKLYN', 165, 938, 522, 998, 450, 614.6, 165, 938, 522, 998],
                        ['MANHATTAN', 135, 1120, 599, 1268, 288, 682, 135, 1120, 599, 1268],
                        ['QUEENS', 157, 1167, 587, 807, 397, 623, 157, 1167, 587, 807],
                        ['BRONX', 139, 1110, 615, 968, 215, 609.4, 139, 1110, 615, 968],
                        ['STATEN ISLAND', 136, 691, 629, 1026, 366, 569.6, 136, 691, 629, 1026]
                    ]*/);

                    var options = {
                        title: 'Crimes in New York by boro',
                        vAxis: {title: 'Numbers of crimes'},
                        hAxis: {title: 'Boro'},
                        seriesType: 'bars',
                        series: {10: {type: 'line'}}
                    };

                    var chart = new google.visualization.ComboChart(document.getElementById('chart_div1'));
                    chart.draw(data, options);
                }





            });
        </script>

