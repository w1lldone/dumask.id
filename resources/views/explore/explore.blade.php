@extends('layouts.app')
@section('content')

<div class="container w-md-75 my-4">
    <h2 class="text-primary text-center font-weight-bold mt-2 mb-0">Yuk, Buang Maskermu Pada Tempatnya !</h2>
    <p class="text-secondary text-center font-weight-bold">Temukan dropboxes DUMASK.ID di sekitar mu</p>

    <form action="">
        <div class="d-md-flex justify-content-between form-group mx-auto">
            <div class="col-md-8 col-12">
                <input type="text" placeholder="Cari Station" class="form-control shadow">
            </div>
            <div class="d-flex col-md-4 col-12 justify-content-between">
                <button class="btn btn-primary shadow mr-2"><img src="{{ asset('img/icon_location.svg')}}"></i></button>
                <button class="btn btn-primary shadow ml-2 w-100">Station Terdekat</i></button>
            </div>
            
        </div>
    </form>
    <div id="map-id" class="mx-auto" style="height: 400px;"></div>
</div>

@include('layouts.footer')
    
<script>            
    navigator.geolocation.getCurrentPosition(function(location) {
    
    var latlng = new L.LatLng(location.coords.latitude, location.coords.longitude);

    var mymap = L.map('map-id').setView(latlng, 13)
    L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(mymap);

    var marker = L.marker(latlng).addTo(mymap);

    });
</script>
@endsection
