@extends('layouts.app')

@section('title', '| Search Results')

@section('content')

<div class='col-lg-4 col-lg-offset-4'>

    <h1><i class='fa fa-key'></i> Search Results</h1>

    <ul class="skill-list">
        <li>{{ $skills }}</li>
    </ul>

    <div id="map" style="width: 800px; height: 500px; display: block; border: 1px solid red;"></div>
    
    <script src="https://maps.googleapis.com/maps/api/js?sensor=false" ></script>
    <script>        
        var cities = <?php echo json_encode($jcities); ?>;
        function initMap() {
            var map;
            var bounds = new google.maps.LatLngBounds();
            var mapOptions = {
                mapTypeId: 'roadmap'
            };

            // Display a map on the web page
            map = new google.maps.Map(document.getElementById("map"), mapOptions);
            map.setTilt(50);

            var infoWindow = new google.maps.InfoWindow(), markers, i;
            var markers = cities;
            // Place each marker on the map 
            for( i = 0; i < markers.length; i++ ) {

                var position = new google.maps.LatLng(markers[i].latitude, markers[i].longitude);
                bounds.extend(position);
                marker = new google.maps.Marker({
                    position: position,
                    map: map,
                    title: markers[i].name + ' ' + markers[i].state
                });

                // Add info window to marker    
                google.maps.event.addListener(marker, 'click', (function(marker, i) {
                    
                    return function() {
                        if(markers[i].growth > 0){ 
                                    arrow = "&#8593;";
                                    arrowClass = "arrow-class-up";
                        } else {
                                    arrow = "&#8595;";
                                    arrowClass = "arrow-class-down";
                        }
                        perGrowth = '%' + markers[i].growth.replace('-', '');
                        var infoWindowContent = 
                            '<div class="info-content">' +
                            '<h3>' + markers[i].name + ', ' + markers[i].state + '</h3>' +
                            '<ul>' +
                            '<li><strong>Population: </strong>' + markers[i].population + '</li>' + 
                            '<li><strong>Job count: </strong>' + markers[i].job_total + '</li>' +
                            '<li><strong>Growth: </strong>' + perGrowth + ' <span class="'+ arrowClass +'">' + arrow + '</span></li>' +
                            '</ul>' + 
                            '</div>';
        
                        infoWindow.setContent(infoWindowContent);
//                        infoWindow.setContent('<strong style="font-weight: 900;">Population: </strong>' + markers[i].population);
                        infoWindow.open(map, marker);
                    };
                })(marker, i));

                // Center the map to fit all markers on the screen
                map.fitBounds(bounds);
            }

            // Set zoom level
            var boundsListener = google.maps.event.addListener((map), 'bounds_changed', function(event) {
                this.setZoom(14);
                google.maps.event.removeListener(boundsListener);
            });

        }
        // Load initialize function
        google.maps.event.addDomListener(window, 'load', initMap);

    </script>
    <!--
    <script src="https://maps.googleapis.com/maps/api/js?sensor=false&callback=initMap"async defer></script>
    -->
    

</div>

@endsection

