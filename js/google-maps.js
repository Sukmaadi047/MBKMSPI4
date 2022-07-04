function initMap() {
    // Latitude and Longitude
    var myLatLng = {lat: -7.428418469826258, lng: 109.33629108177328};

     

    var map = new google.maps.Map(document.getElementById('google-maps'), {
        zoom: 17,
        center: myLatLng
    });

    var marker = new google.maps.Marker({
        position: myLatLng,
        map: map,
        title: 'South Jakarta, INA' // Title Location
    });
}