/* eslint no-undef: 0 */
const addMarker = function (marker, map) {
  // var
  const latlng = new google.maps.LatLng(marker.getAttribute('data-lat'), marker.getAttribute('data-lng'));

  // create marker
  const gmarker = new google.maps.Marker({
    position: latlng,
    map,
  });

  // add to array
  map.markers.push(gmarker);

  // if marker contains HTML, add it to an infoWindow
  if (marker.innerHTML) {
    // create info window
    const infowindow = new google.maps.InfoWindow({
      content: marker.innerHTML,
    });

    // show info window when marker is clicked
    google.maps.event.addListener(gmarker, 'click', () => {
      infowindow.open(map, gmarker);
    });
  }
};

const centerMap = function (map) {
  // vars
  const bounds = new google.maps.LatLngBounds();

  // loop through all markers and create bounds
  map.markers.forEach((marker) => {
    const latlng = new google.maps.LatLng(marker.position.lat(), marker.position.lng());
    bounds.extend(latlng);
  });

  // only 1 marker?
  if (map.markers.length === 1) {
    // set center of map
    map.setCenter(bounds.getCenter());
    map.setZoom(16);
  } else {
    // fit to bounds
    map.fitBounds(bounds);
  }
};

const newMap = function (el) {
  // var
  const markers = [...el.getElementsByClassName('marker')];

  // vars
  const args = {
    zoom: 13,
    center: new google.maps.LatLng(0, 0),
    mapTypeId: google.maps.MapTypeId.ROADMAP,
  };


  // create map
  const map = new google.maps.Map(el, args);

  // add a markers reference
  map.markers = [];

  // add markers
  markers.forEach((marker) => {
    addMarker(marker, map);
  });


  // center map
  centerMap(map);


  // return
  return map;
};

(function () {
  document.addEventListener('DOMContentLoaded', () => {
    if (document.getElementsByClassName('acf-map')[0]) {
      [...document.getElementsByClassName('acf-map')].forEach((map) => {
        // create map
        newMap(map);
      });
    }
  });
}());
