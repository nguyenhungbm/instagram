
var myLatLng ,map,lat,lng,name,lat2,lng2,name2;
geoLocationInit();
function geoLocationInit(){
    if(navigator.geolocation){
        navigator.geolocation.getCurrentPosition(success,fail);
    }else{
        alert('Browser not supported');
    }
}
  
function success(position){
    lat = position.coords.latitude;
    lng = position.coords.longitude; 
}
function fail(){
    alert('Không thấy địa chỉ');
}
function createMap(location){
    map = new google.maps.Map(document.getElementById("map"), {
        center: location,
        zoom: 8,
    });
}
function initMap() {
myLatLng = new google.maps.LatLng(lat, lng);
createMap(myLatLng);
getLocation();

function createMarker(location,place){
    new google.maps.Marker({
      position: location,
      map,
      title: place,
    });
}

function getLocation(){
    $.get('/address',function(res){
        $.each(res,function(i,val){
            lat2 = val.lat;
            lng2 = val.lng;
            name2 = val.address;
            myLatLng = new google.maps.LatLng(lat2, lng2);
            console.log(myLatLng);
            createMarker(myLatLng,name2);
        })
    });
} 
var request = {
    location: myLatLng,
    radius: '500',
    type: ['restaurant']
  };
service = new google.maps.places.PlacesService(map);
service.nearbySearch(request, callback);
function callback(results, status) {
  if (status == google.maps.places.PlacesServiceStatus.OK) {
    for (var i = 0; i < results.length; i++) {
        name = results[0].name;
        createMarker(myLatLng,results[0].name);
        var url = '/address';
        $.ajax({
            url:url,
            method:"POST",
            data:{lat:lat,lng:lng,name:name},
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
            }
        });
    }
  }
}
}