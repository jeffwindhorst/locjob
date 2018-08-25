@extends('layouts.app')

@section('title', '| Search Results')

@section('content')

<div class='col-lg-4 col-lg-offset-4'>

    <h1><i class='fa fa-key'></i> Search Results</h1>

    <ul class="skill-list">
        <li>{{ $skills }}</li>
    </ul>

    <div id="map" style="width: 800px; height: 500px; display: block; border: 1px solid red;"></div>
    <script>
        var cities = <?php echo json_encode($jcities); ?>;
        function initMap() {
            var locations = cities;
            var map = new google.maps.Map(document.getElementById('map'), {
              zoom: 10,
              center: new google.maps.LatLng(41.850033, -87.6500523),
              mapTypeId: google.maps.MapTypeId.ROADMAP
            });

            var infowindow = new google.maps.InfoWindow();

            var marker, i;

            for (i = 0; i < locations.length; i++) {
                marker = new google.maps.Marker({
                    position: new google.maps.LatLng(locations[i].latitude, locations[i].longitude),
                    map: map
                });
            }
        }

    </script>
    <script src="https://maps.googleapis.com/maps/api/js?sensor=false&callback=initMap"async defer></script>

</div>

@endsection

