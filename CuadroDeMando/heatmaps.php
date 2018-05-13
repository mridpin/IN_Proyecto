<?php
include 'header.php';
?>


<div id="loading"></div>

<div id="floating-panel">
            <p id="contador"></p>
            <button onclick="toggleHeatmap()">Toggle Heatmap</button>
            <button onclick="changeGradient()">Change gradient</button>
            <button onclick="changeRadius()">Change radius</button>
            <button onclick="changeOpacity()">Change opacity</button>
        </div>
        <div id="map"></div>
        <script>

            // This example requires the Visualization library. Include the libraries=visualization
            // parameter when you first load the API. For example:
            // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=visualization">

            var map, heatmap;

            function initMap() {
                map = new google.maps.Map(document.getElementById('map'), {
                    zoom: 12,
                    center: {lat: 40.777, lng: -73.971},
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                });

                heatmap = new google.maps.visualization.HeatmapLayer({
                    data: getPoints(),
                    map: map
                });
            }

            function toggleHeatmap() {
                heatmap.setMap(heatmap.getMap() ? null : map);
            }

            function changeGradient() {
                var gradient = [
                    'rgba(0, 255, 255, 0)',
                    'rgba(0, 255, 255, 1)',
                    'rgba(0, 191, 255, 1)',
                    'rgba(0, 127, 255, 1)',
                    'rgba(0, 63, 255, 1)',
                    'rgba(0, 0, 255, 1)',
                    'rgba(0, 0, 223, 1)',
                    'rgba(0, 0, 191, 1)',
                    'rgba(0, 0, 159, 1)',
                    'rgba(0, 0, 127, 1)',
                    'rgba(63, 0, 91, 1)',
                    'rgba(127, 0, 63, 1)',
                    'rgba(191, 0, 31, 1)',
                    'rgba(255, 0, 0, 1)'
                ]
                heatmap.set('gradient', heatmap.get('gradient') ? null : gradient);
            }

            function changeRadius() {
                heatmap.set('radius', heatmap.get('radius') ? null : 3);
            }

            function changeOpacity() {
                heatmap.set('opacity', heatmap.get('opacity') ? null : 0.2);
            }

            function getPoints() {
                var points = [];
                $('#loading').addClass("loading");
                $('#loading').html('<img class="img-loading" src="img/bx_loader.gif" />');
                $.ajax({
                    type: 'POST',
                    url: "ajax/ajax_report_map_dataset.php",
                    success: function (data) {
                        for (var i = 0; i < data.length; i++) {
                            points[i] = new google.maps.LatLng(parseFloat(data[i][0]), parseFloat(data[i][1]));
                            console.log(i);
                            //$("#contador").text(i + " de " + data.length);
                        }
                        $('#loading').removeClass("loading");
                        $('#loading').html('');
                    },
                    dataType: "json"
                });
                
                return points;
            }
        </script>
        <script async defer
                src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC-6syV9rPryZyXCm-V_kjnLJ9ft4ukvnw&libraries=visualization&callback=initMap">
        </script>
        
<?php
include 'footer.php';
?>