@extends('layouts.app')

@section('title', '| Search Results')

@section('content')

<div class='col-lg-4 col-lg-offset-4'>

    <h1><i class='fa fa-key'></i> Search Results</h1>

    <ul class="skill-list">
        @foreach($skills  as $skill)
        <li>{{ $skill}}</li>
        @endforeach
    </ul>

    <div id="map" style="width: 500px; height: 500px; display: block; border: 1px solid red;"></div>
    <script>
function initMap() {
    var uluru = {lat: -25.344, lng: 131.036};
    var map = new google.maps.Map(
        document.getElementById('map'), {zoom: 4, center: uluru});
    var marker = new google.maps.Marker({position: uluru, map: map});
}

    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=<?php echo config('app.mapsApiKey'); ?>&callback=initMap"async defer></script>

</div>

@endsection

