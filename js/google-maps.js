//ACF Google Map
(function ($) {

    /*
    *  new_map
    *
    *  This function will render a Google Map onto the selected jQuery element
    *
    *  @type    function
    *  @date    8/11/2013
    *  @since   4.3.0
    *
    *  @param   $el (jQuery element)
    *  @return  n/a
    */


    function new_map($el) {

        // var
        var $markers = $el.find('.marker'),
            $mapstyles = JSON.parse(script_vars.mapstyles),
            args = {
                zoom: 18,
                center: new google.maps.LatLng(32.7513994,-97.3643357),
                mapTypeId: google.maps.MapTypeId.ROADMAP,
                scrollwheel: false,
                streetViewControl: false,
                styles: $mapstyles
            };

        // create map               
        var map = new google.maps.Map($el[0], args);

        // add a markers reference
        map.markers = [];

         // add markers
        $markers.each(function(){
            add_marker( $(this), map );
        });

        // center map
        center_map(map);

        // return
        return map;
    }

    /*
    *  add_marker
    *
    *  This function will add a marker to the selected Google Map
    *
    *  @type    function
    *  @date    8/11/2013
    *  @since   4.3.0
    *
    *  @param   $marker (jQuery element)
    *  @param   map (Google Map object)
    *  @return  n/a
    */

    function add_marker($marker, map) {
        // var
        var latlng = new google.maps.LatLng($marker.attr('data-lat'), $marker.attr('data-lng')),
            color = $marker.attr('data-color');

        var myMarker = {
        path: 'M25 0c-8.284 0-15 6.656-15 14.866 0 8.211 15 35.135 15 35.135s15-26.924 15-35.135c0-8.21-6.716-14.866-15-14.866zm-.049 19.312c-2.557 0-4.629-2.055-4.629-4.588 0-2.535 2.072-4.589 4.629-4.589 2.559 0 4.631 2.054 4.631 4.589 0 2.533-2.072 4.588-4.631 4.588z',
        fillColor: color,
        fillOpacity: 1,
        scale: 1,
        strokeColor: 'white',
        strokeWeight: 1,
        labelOrigin: new google.maps.Point(0, -25)
        };

        // create marker
        var marker = new google.maps.Marker({
            position: latlng,
            map: map,
            animation: google.maps.Animation.DROP,
            icon: myMarker

        });

        // add to array
        map.markers.push(marker);

        // if marker contains HTML, add it to an infoWindow
        if ($marker.html()) {
            // create info window
            var infowindow = new google.maps.InfoWindow({
                content: $marker.html(),
            });


            // show info window when marker is clicked
            google.maps.event.addListener(marker, 'click', function () {
                infowindow.open(map, marker);
            });
        }
    }

    /*
    *  center_map
    *
    *  This function will center the map, showing all markers attached to this map
    *
    *  @type    function
    *  @date    8/11/2013
    *  @since   4.3.0
    *
    *  @param   map (Google Map object)
    *  @return  n/a
    */

    function center_map(map) {
        // vars
        var bounds = new google.maps.LatLngBounds();

        // loop through all markers and create bounds
        $.each(map.markers, function (i, marker) {
            var latlng = new google.maps.LatLng(marker.position.lat(), marker.position.lng());
            bounds.extend(latlng);
        });

        // only 1 marker?
        if (map.markers.length == 1) {
            // set center of map
            map.setCenter(bounds.getCenter());
            map.setZoom(14);
        } else {
            // fit to bounds
            map.fitBounds(bounds);
        }
    }

    /*
    *  document ready
    *
    *  This function will render each map when the document is ready (page has loaded)
    *
    *  @type    function
    *  @date    8/11/2013
    *  @since   5.0.0
    *
    *  @param   n/a
    *  @return  n/a
    */
    // global var
    var map = null;

    $(document).ready(function () {
        $('.acf-map').each(function () {
            // create map
            map = new_map($(this));
        });
     });

})(jQuery);
