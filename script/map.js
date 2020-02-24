var mapClass = {
  menuWidth: 576,
  isMobile: 801 > screen.width,
  pickers: [],
  isMapCalled: false
}
function isMapCalled () {
  mapClass.isMapCalled = true
  google.maps.Map.prototype.setCenterWithOffset= function(latlng, offsetX, offsetY) {
    var map = this;
    var ov = new google.maps.OverlayView();
    ov.onAdd = function() {
        var proj = this.getProjection();
        var aPoint = proj.fromLatLngToContainerPixel(latlng);
        aPoint.x = aPoint.x+offsetX;
        aPoint.y = aPoint.y+offsetY;
        map.setCenter(proj.fromContainerPixelToLatLng(aPoint));
    }; 
    ov.draw = function() {}; 
    ov.setMap(this); 
  };
}
mapClass.initMap = function (lat, lng, id, zoom, callback) {
  if (mapClass.isMapCalled) {
    if (!zoom) zoom = 4;
    mapClass.latlng = new google.maps.LatLng({lat: lat, lng: lng});
    mapClass.map = new google.maps.Map(
        document.getElementById(id), {zoom: zoom, center: mapClass.latlng});
    if (!mapClass.isMobile) {
      mapClass.map.setCenterWithOffset(mapClass.latlng, - mapClass.menuWidth / 3, 0);
    }
    if (callback) callback()
  } else {
    setTimeout(function () {
      mapClass.initMap(lat, lng, id, zoom)
      if (callback) callback()
    }, 1000)
  }
}
mapClass.clearPickers = function () {
  $.each(mapClass.pickers, function (index, picker) {
    picker.setMap(null);
  });
}
mapClass.setPicker = function (lat, lng, func) {
  var uluru = {lat: lat, lng: lng};
  var picker = new google.maps.Marker({position: uluru, map: mapClass.map, icon: '../assets/marker.png',});
  if (func) {
    picker.addListener('click', func);
  }
  mapClass.pickers.push(picker);
}
mapClass.setCenter = function (lat, lng, zoom) {
  if (!zoom) zoom = 4;
  mapClass.latlng = new google.maps.LatLng({lat: lat, lng: lng});
  // mobile
  if (mapClass.isMobile) {
    mapClass.map.setCenterWithOffset(mapClass.latlng, 0, 0);
  } else {
    mapClass.map.setCenterWithOffset(mapClass.latlng, - mapClass.menuWidth / 3, 0);
  }
  mapClass.map.setZoom(zoom)
}