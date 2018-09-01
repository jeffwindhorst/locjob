@extends('layouts.app')

@section('title', '| Search Results')

@section('content')

<div class='col-lg-4 col-lg-offset-4'>

    <h1><i class='fa fa-key'></i> Search Results</h1>

    <ul class="skill-list">
        <li>{{ $skills }}</li>
    </ul>

    <div id="map" style="width: 800px; height: 500px; display: block; border: 1px solid red;"></div>
    <!--
    <script src="https://maps.googleapis.com/maps/api/js?sensor=false" async defer></script>
    -->
    <script src="https://maps.googleapis.com/maps/api/js?sensor=false" ></script>
    <script>
        /*
        var cities = <?php // echo json_encode($jcities); ?>;
        function initMap() {
            var locations = cities;
            var map = new google.maps.Map(document.getElementById('map'), {
              zoom: 10,
              center: new google.maps.LatLng(41.850033, -87.6500523),
              mapTypeId: google.maps.MapTypeId.ROADMAP
            });

            var markers = [], chHtmls = [], i;

            for (i = 0; i < locations.length; i++) {
                markers[i] = new google.maps.Marker({
                    position: new google.maps.LatLng(locations[i].latitude, locations[i].longitude),
                    map: map
                });
                chHtmls[i] = "<ul><li><strong>"+locations[i].name+", "+ locations[i].state+"</strong></li><li>Population: "+locations[i].population+"</li><li>Jobs: "+locations[i].job_total+"</li></ul>";
                if(i === 0) {console.log(chHtmls[i]); }
                
                //open infowindow on click event on marker.
                
                var chInfoWindows = new google.maps.InfoWindow({
                    content:chHtmls[i]
                });
                
                google.maps.event.addListener(markers[i], 'click', function(markers[i], chHtmls[i], chInfoWindows) {
                    return function() {
                        chInfoWindows.setContent(chHtmls[i]);
                        chInfoWindows.open(map, marker);
                    };
                })(markers[i], content, chInfoWindows);
                
            }
        }
        */
        
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

            // Multiple markers location, latitude, and longitude
//            var markers = [
//                ['Brooklyn Museum, NY', 40.671531, -73.963588],
//                ['Brooklyn Public Library, NY', 40.672587, -73.968146],
//                ['Prospect Park Zoo, NY', 40.665588, -73.965336]
//            ];

            var markers = cities;
            
            // Info window content
            var infoWindowContent = [
                ['<div class="info_content">' +
                '<h3>Brooklyn Museum</h3>' +
                '<p>The Brooklyn Museum is an art museum located in the New York City borough of Brooklyn.</p>' + '</div>'],
                ['<div class="info_content">' +
                '<h3>Brooklyn Public Library</h3>' +
                '<p>The Brooklyn Public Library (BPL) is the public lib rary system of the borough of Brooklyn, in New York City.</p>' +
                '</div>'],
                ['<div class="info_content">' +
                '<h3>Prospect Park Zoo</h3>' +
                '<p>The Prospect Park Zoo is a 12-acre (4.9 ha) zoo located off Flatbush Avenue on the eastern side of Prospect Park, Brooklyn, New York City.</p>' +
                '</div>']
            ];

            // Add multiple markers to map
            var infoWindow = new google.maps.InfoWindow(), markers, i;

            // Place each marker on the map 
            console.log("Length: " + markers.length);
            for( i = 0; i < markers.length; i++ ) {
                console.log('I: ' +i);

                console.log('passed');
                var position = new google.maps.LatLng(markers[i].latitude, markers[i].longitude);
                console.log('Position: ' + position);
                bounds.extend(position);
                console.log('here 1');
                marker = new google.maps.Marker({
                    position: position,
                    map: map,
                    title: markers[i].name + ' ' + markers[i].state
                });

                // Add info window to marker    
                google.maps.event.addListener(marker, 'click', (function(marker, i) {
                    return function() {
                        infoWindow.setContent('Population: ' + marker.population);
                        infoWindow.open(map, marker);
                    };
                })(marker, i));

                // Center the map to fit all markers on the screen
                map.fitBounds(bounds);
                console.log('HERE');
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

