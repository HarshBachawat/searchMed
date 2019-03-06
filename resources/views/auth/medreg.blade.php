
@extends('layouts.medapp')



@section('content')


    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card">
                <div class="card-body">
              <h5 class="card-title">{{ __(' Medical Shop Registration') }}</h5>

                <div class="card-body">
                        <form method="POST" action='{{ url("register/medshop") }}' id="details" aria-label="{{ __('Register') }}">
                            
                            @csrf

                        <div class="form-group ">
                            <label for="name" >{{ __('Name') }}</label>

                            
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}"  placeholder="Enter Shop Name" autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            
                        </div>

                        <div class="form-group ">
                            <label for="email" >{{ __('E-Mail Address') }}</label>

                            
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}"  placeholder="Enter Email">

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            
                        </div>

                        <div class="form-group ">
                            <label for="password" >{{ __('Password') }}</label>

                            
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password"  placeholder="Password">

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            
                        </div>

                        <div class="form-group ">
                            <label for="password-confirm" >{{ __('Confirm Password') }}</label>

                            
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation"  placeholder="Confirm Password">
                            
                        </div>

                        <div class="form-group">
                            <label for="inputAddress">{{ __('Address Line 1') }}</label>
                            <input type="text" class="form-control" name="add1" id="inputAddress" placeholder="Shop No, Market, or Floor" >
                        </div>

                        <!--<div class="form-group">
                            <label for="inputAddress2">{{ __('Address Line 2') }}</label>
                            <input type="text" class="form-control" id="inputAddress2" placeholder="Street, Locality, LandMark" >
                        </div>-->

                        
                       <div class="form-group">
                        <div id="map" style="width:532px; height:380px;"></div>
                        <button type="button" class="btn btn-default" style="position: relative; top: 10px" onclick="getLocation()">Get My Current Location</button>
                       
                        </div>

                        <div class="form-group">
                            <label for="add2">Address Line 2</label>                   
                            <input type="text" id="address-input" name="add2" class="form-control map-input" placeholder="Street, Locality, LandMark" >
                            <input  name="add_lat"  type="hidden" id="address-latitude" placeholder="0" >
                            <input  name="add_lng"  type="hidden" id="address-longitude" placeholder="0" >
                        </div>

                       <!--<div id="address-map-container" style="width:100%;height:400px; ">
                            <div style="width: 100%; height: 100%" id="address-map"></div>
                        </div>-->
                        
                        </br>
                        <div class="form-group  mb-0">
                            <div class="col-md-6 offset-md-5">
                                <button type="submit" style="position: relative;top: 20px" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>

@endsection


@section('scripts')
    @parent
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBGCql0HlN4C_D7B2BcIIhtuFvjrdfvoew"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script type="text/javascript" >
            var map; //Will contain map object.
            var marker = false; ////Has the user plotted their location marker? 
            var x = document.getElementById("demo");
            var set = false;

            function getLocation() {
              if (navigator.geolocation) {

                navigator.geolocation.getCurrentPosition(showPosition);
              } else { 
                x.innerHTML = "Geolocation is not supported by this browser.";
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
                else{
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
                var currentLocation = marker.getPosition();
                var add;
                document.getElementById('address-latitude').value = currentLocation.lat(); //latitude
                document.getElementById('address-longitude').value = currentLocation.lng(); //longitude

                var url = "https://maps.googleapis.com/maps/api/geocode/json?latlng="+currentLocation.lat()+","+currentLocation.lng()+"&key=AIzaSyBGCql0HlN4C_D7B2BcIIhtuFvjrdfvoew";
                $.getJSON(url,function(data){
                document.getElementById('address-input').value = data.results[0].formatted_address;
            });
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
    @stop