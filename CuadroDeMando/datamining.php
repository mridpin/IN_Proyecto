<?php
include 'header.php';
?>

<div class="container-fluid">
    <div class="text-center col-xs-12"><h1>Table title 1</h1></div>
    <div class="col-xs-0 col-md-1"></div>
    <div class="col-xs-12 col-md-10">
        <table id="table_datamining0" class="table table-striped">
            <thead id="table_thead0"></thead>
            <tbody id="table_tbody0"></tbody>
        </table>
    </div>
    <div class="col-xs-0 col-md-1"></div>

    <div class="text-center col-xs-12"><h1>Table title 2</h1></div>
    <div class="col-xs-0 col-md-1"></div>
    <div class="col-xs-12 col-md-10">
        <table id="table_datamining1" class="table table-striped">
            <thead id="table_thead1"></thead>
            <tbody id="table_tbody1"></tbody>
        </table>
    </div>
    <div class="col-xs-0 col-md-1"></div>
</div>
<script type="text/javascript">
    
    function pintarTablas(numTabla, aDatos){
        for (var i = 0; i < aDatos.length; i++) {
            var cadHTML = "<tr>";
            for (var j = 0; j < aDatos[i].length; j++) {
                if (i == 0) {
                    cadHTML += "<th>" + aDatos[i][j] + "</th>";
                } else {
                    cadHTML += "<td>" + aDatos[i][j] + "</td>";
                }
            }

            if (i == 0) {
                $('#table_thead'+numTabla).append(cadHTML);
            } else {
                $('#table_tbody'+numTabla).append(cadHTML);
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
        
        for(var l=0; l < datos.length ;l++){
            pintarTablas(l, datos[l]);
        }
            
        
    });
</script>

<?php
include 'footer.php';
?>