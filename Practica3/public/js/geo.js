jQuery(function() {
  if(!!navigator.geolocation) {

    var mapOptions = {
      zoom: 15,
    };

    var map = new google.maps.Map(document.getElementById('google_canvas'), mapOptions);

    navigator.geolocation.getCurrentPosition(function(position) {

      var geolocate = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);

      var infowindow = new google.maps.InfoWindow({
        map: map,
        position: geolocate,
        content:
        '<p>Location pinned from HTML5 Geolocation!</p>' +
          '<p>Latitude: ' + position.coords.latitude + '</p>' +
          '<p>Longitude: ' + position.coords.longitude + '</p>'
      });

      map.setCenter(geolocate);

    });

  } else {
    document.getElementById('google_canvas').innerHTML = 'No Geolocation Support.';
  }
});
