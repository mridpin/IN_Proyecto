<?php
include 'header.php';
?>


<div id="loading"></div>

<div style="width:100%; height:100%" id="map"></div>
<script type='text/javascript'>
    // Crear un mapa en el div “map”, fijar la posición y el zoom
    var map = L.map('map').setView([40.719214,  -73.990492], 10);
    // añadir una capa de OpenStreetMap
    L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    getPoints();

    function getPoints() {
        $.ajax({
            type: 'POST',
            url: "ajax/ajax_police_stations.php",
            success: function (data) {
                for (var i = 0; i < data.length; i++) {
                    var position = data[i];
                    ponerPunto(position);
                    console.log(position);
                }
            },
            dataType: "json"
        });
    }

    function ponerPunto(position) {
        L.marker(position).addTo(map).bindPopup('Aqui hay una comisaria').openPopup();

    }

</script>

<?php
include 'footer.php';
?>