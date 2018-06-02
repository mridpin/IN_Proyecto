<?php
include 'header.php';
?>

<div class="container-fluid">
    <!--<div class="col-xs-0 col-md-1"></div>-->
    <div class="col-xs-12 col-md-12">

        <div class="panel panel-default">
            <!-- Default panel contents -->
            <div class="panel-heading text-center"><h3>Accuracy statistics</h3></div>
            <div class="panel-body">
                <p> En esta tabla se muestra ...</p>
            </div>
            <table id="table_datamining0" class="table table-striped">
                <thead id="table_thead0"></thead>
                <tbody id="table_tbody0"></tbody>
            </table>
        </div>
    </div>
    <!--<div class="col-xs-0 col-md-1"></div>-->

    <div class="col-xs-12"></div>
    <!--<div class="col-xs-0 col-md-1"></div>-->
    <div class="col-xs-12 col-md-12">
        <div class="panel panel-default">
            <!-- Default panel contents -->
            <div class="panel-heading text-center"><h3>Confusion matrix</h3></div>
            <div class="panel-body">
                <p>En esta tabla se muestra ...</p>
            </div>
            <table id="table_datamining1" class="table table-striped">
                <thead id="table_thead1"></thead>
                <tbody id="table_tbody1"></tbody>
            </table>
        </div>
    </div>
    <!--<div class="col-xs-0 col-md-1"></div>-->
</div>
<script type="text/javascript">

    function pintarTablas(numTabla, aDatos) {
        for (var i = 0; i < aDatos.length; i++) {
            var cadHTML = "<tr>";
            for (var j = 0; j < aDatos[i].length; j++) {
                if (i == 0) {
                    cadHTML += "<th>" + aDatos[i][j].replace(/['"]+/g, '') + "</th>";
                } else {
                    if( aDatos.length-1 == i && aDatos[i].length-2 == j && numTabla == 0){ //Colo
                        cadHTML += "<td class='important-value'>";
                    } else {
                        cadHTML += "<td>";
                    }
                    
                    
                    if(aDatos[i][j] == "" || j == 0){
                        cadHTML += aDatos[i][j].replace(/['"]+/g, '');
                    } else if(isNaN(parseFloat(aDatos[i][j]))){
                        cadHTML += "";
                    } else {
                        cadHTML += parseFloat(aDatos[i][j]).toFixed(3);
                    }
                    
                    cadHTML += "</td>";
                }
            }

            if (i == 0) {
                $('#table_thead' + numTabla).append(cadHTML);
            } else {
                $('#table_tbody' + numTabla).append(cadHTML);
            }
            cadHTML += "</tr>";
        }
    }


    $.ajax({
        type: 'POST',
        async: false,
        url: "ajax/ajax_datamining.php",
    }).done(function (data) {
        var datos = JSON.parse(data);

        for (var l = 0; l < datos.length; l++) {
            pintarTablas(l, datos[l]);
        }


    });
</script>

<?php
include 'footer.php';
?>