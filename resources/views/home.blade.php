
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBGCql0HlN4C_D7B2BcIIhtuFvjrdfvoew"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style type="text/css">

body{
  background: #f2f2f2;
  font-family: 'Open Sans', sans-serif;
}

.search {
  width: 40%;
  position: relative
}

.searchTerm {
  float: left;
  width: 100%;
  border: 3px solid #00B4CC;
  padding: 5px;
  height: 37px;
  border-radius: 5px;
  outline: none;
  color: #9DBFAF;
}

.searchTerm:focus{
  color: #00B4CC;
}

.searchButton {
  position: absolute;  
  right: -50px;
  width: 40px;
  height: 36px;
  border: 1px solid #00B4CC;
  background: #00B4CC;
  text-align: center;
  color: #fff;
  border-radius: 5px;
  cursor: pointer;
  font-size: 20px;
}

/*Resize the wrap to see the search bar change!*/
.wrap{
  width: 30%;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
}
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}" >
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->email }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
           <div style="height: 30px">
           </div>
           
           <div align="center" type="hidden">
            <div class="form-group">
                <div id="map" style="width:590px; height:380px;"></div>
                <button type="button" class="btn btn-success" style="position: relative; top: 10px" onclick="getLocation()">Get My Current Location</button>
            </div>
            <div style="height: 30px">
                <button id="getshop" class="btn btn-success">All Nearest Medical Shops</button>
           <div class="search" align="center">
                 <form>
                     <input type="text" id="search" class="searchTerm" placeholder="What are you looking for?">
                     <button type="button" id="searchmed" class="searchButton">
                     <i class="fa fa-search"></i>
                 </form>
                </button>
            </div>
            </div>
        </main>
    </div>
    <script type="text/javascript">
            $(document).on('click','#getshop',function() {
                $.ajax({
                    type: 'get',
                    url: '/getNearest',
                    data: {
                        'lat': lat,
                        'lng': lng
                    },
                    success: function(data) {
                        console.log(data);
                        setStores(data);
                    }
                });
            });

            $(document).on('click','#searchmed',function() {
                $.ajax({
                    type: 'get',
                    url: '/searchmed',
                    data: {
                        'name': document.getElementById('search').value,
                        'lat': lat,
                        'lng': lng 
                    },
                    success: function(data) {
                        console.log(data);
                        setStores(data);
                    }
                });
            });

            function clearOverlays() {
              for (var i = 0; i < stores.length; i++ ) {
                stores[i].setMap(null);
              }
              stores.length = 0;
            }

            function setStores(data) {
                if (stores.length > 0) {
                    clearOverlays();

                }
                 for (var i = 0; i < data.length; i++) {
                            var pos ={lat: data[i].add_lat, lng:data[i].add_lng};
                           stores[i] = new google.maps.Marker({
                            position: pos ,
                            map:map,
                            label: data[i].name
                           });
                           bounds.extend(stores[i].position);
                        }
                        map.fitBounds(bounds);
            }

        </script>
</body>
<script type="text/javascript" >
            var map; //Will contain map object.
            var marker = false; ////Has the user plotted their location marker? 
            var set = false;
            var lat,lng;
            var bounds = new google.maps.LatLngBounds();
            var stores = [];

            function getLocation() {
              if (navigator.geolocation) {

                navigator.geolocation.getCurrentPosition(showPosition);
              } else { 
                alert("Geolocation is not supported by this browser.");
              }
            }

            function showPosition(position) {
                var mark = {lat: position.coords.latitude, lng: position.coords.longitude};

                if (set==false){
                set = true;
                
                //x.innerHTML = map.getBounds();
                
              marker = new google.maps.Marker({
                            position: mark ,
                            map: map,
                            draggable: true //make it draggable
                        });
              google.maps.event.addListener(marker, 'dragend', function(event){
                    
                                markerLocation();
                            });
                }
                else
                {
                    marker.setPosition(mark);
                }

                markerLocation();
                zzom();
            }
            //Function called to initialize / create the map.
            //This is called when the page has loaded.
            function initMap() {
             
                //The center location of our map.
                var centerOfMap = new google.maps.LatLng(19.152063, 73.134255);
             
                //Map options.
                var options = {
                  center: centerOfMap, //Set center.
                  zoom: 10, clickableLabels: false, clickableIcons:false//The zoom value.
                };
             
                //Create the map object.
                map = new google.maps.Map(document.getElementById('map'), options);
             
                //Listen for any clicks on the map.
                google.maps.event.addListener(map, 'click', function(event) {                
                    //Get the location that the user clicked.
                    var clickedLocation = event.latLng;
                    if(set === true){
                        //Create the marker.
                        
                        //Marker has already been added, so just change its location.
                        marker.setPosition(clickedLocation);
                        
                    }
                    else{
                        
                    }
                    //Get the marker's location.
                    markerLocation();
                });


            }
                    
            //This function will get the marker's current location and then add the lat/long
            //values to our textfields so that we can save the location.
            function markerLocation(){
                bounds.extend(marker.position);
                var currentLocation = marker.getPosition();
                lat = currentLocation.lat(); //latitude
                lng = currentLocation.lng(); //longitude
                //alert(lat+"  "+lng);
            }

            function zzom(){
                var currentLocation = marker.getPosition();
                map.setCenter(currentLocation);
                map.setZoom(17);
            }

            function foo() {
                if(set == false){
               alert("Please select your location");
           }
               return false;
            }


                    
            //Load the map when the page has finished loading.
            google.maps.event.addDomListener(window, 'load', initMap);
        </script>
        
</html>
