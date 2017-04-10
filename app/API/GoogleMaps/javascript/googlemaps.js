function initMap() 
{
    var uluru = {lat: 49.28403929999999, lng: -123.10831569999999};
    
    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 17,
      center: uluru
    });
    
    var marker = new google.maps.Marker({
      position: uluru,
      map: map
    });
}