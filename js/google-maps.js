(function ($) {
    let args = {
        zoom: 18,
        center: new google.maps.LatLng(0, 150),
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        scrollwheel: false,
        mapTypeControl: false,
        streetViewControl: false,
        styles: JSON.parse(wp.mapstyle)
    };

    // Setup New Google Map
    function newMap($el, location) {
        let map = new google.maps.Map($el[0], args);
        map.markers = [];

        addMarker(location, map);

        centerMap(map);
        return map;
    }

    // Add Google Map Marker
    function addMarker(location, map) {
        let latlng = new google.maps.LatLng(location.lat, location.lng);
        let marker = new google.maps.Marker({
            position: latlng,
            map: map,
            animation: google.maps.Animation.DROP,
            icon: location.poi ? wp.poimarker : wp.mapmarker
        });

        map.markers.push(marker);
    }

    // Center Google Map
    function centerMap(map, zoom = 16) {
        let bounds = new google.maps.LatLngBounds();
        let visibile = 0;

        map.markers.forEach(marker => {
            if (marker.visible) {
                bounds.extend(marker.position);
                visibile++;
            }
        });

        if (map.markers.length == 1 || visibile == 1) {
            map.setCenter(bounds.getCenter());
            map.setZoom(zoom);
        } else {
            map.fitBounds(bounds);
        }
    }

    $('.acf-map').each((i, e) => {
        let location = {
            lng: $(e).data('lng'),
            lat: $(e).data('lat'),
            poi: $(e).data('poi')
        }

        newMap($(e), location);
    })
})(jQuery);