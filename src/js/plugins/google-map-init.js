(function($) {

/*
*  render_map
*
*  This function will render a Google Map onto the selected jQuery element
*
*  @type	function
*  @date	8/11/2013
*  @since	4.3.0
*
*  @param	$el (jQuery element)
*  @return	n/a
*/

function render_map( $el ) {

	// var
	var $markers = $el.find('.marker');

	// vars
	var args = {
		zoom		: 16,
		center		: new google.maps.LatLng(0, 0),
		mapTypeId	: google.maps.MapTypeId.ROADMAP,
        draggable: true,
        scrollwheel: false,
//        Styles below taken from https://snazzymaps.com/
//        styles: [
//            {
//                "featureType": "landscape",
//                "stylers": [
//                    {
//                        "saturation": -100
//                    },
//                    {
//                        "lightness": 65
//                    },
//                    {
//                        "visibility": "on"
//                    }
//                ]
//            },
//            {
//                "featureType": "poi",
//                "stylers": [
//                    {
//                        "saturation": -100
//                    },
//                    {
//                        "lightness": 51
//                    },
//                    {
//                        "visibility": "simplified"
//                    }
//                ]
//            },
//            {
//                "featureType": "road.highway",
//                "stylers": [
//                    {
//                        "saturation": -100
//                    },
//                    {
//                        "visibility": "simplified"
//                    }
//                ]
//            },
//            {
//                "featureType": "road.arterial",
//                "stylers": [
//                    {
//                        "saturation": -100
//                    },
//                    {
//                        "lightness": 30
//                    },
//                    {
//                        "visibility": "on"
//                    }
//                ]
//            },
//            {
//                "featureType": "road.local",
//                "stylers": [
//                    {
//                        "saturation": -100
//                    },
//                    {
//                        "lightness": 40
//                    },
//                    {
//                        "visibility": "on"
//                    }
//                ]
//            },
//            {
//                "featureType": "transit",
//                "stylers": [
//                    {
//                        "saturation": -100
//                    },
//                    {
//                        "visibility": "simplified"
//                    }
//                ]
//            },
//            {
//                "featureType": "administrative.province",
//                "stylers": [
//                    {
//                        "visibility": "off"
//                    }
//                ]
//            },
//            {
//                "featureType": "water",
//                "elementType": "labels",
//                "stylers": [
//                    {
//                        "visibility": "on"
//                    },
//                    {
//                        "lightness": -25
//                    },
//                    {
//                        "saturation": -100
//                    }
//                ]
//            },
//            {
//                "featureType": "water",
//                "elementType": "geometry",
//                "stylers": [
//                    {
//                        "hue": "#ffff00"
//                    },
//                    {
//                        "lightness": -25
//                    },
//                    {
//                        "saturation": -97
//                    }
//                ]
//            }
//        ]

	};

	// create map
	var map = new google.maps.Map( $el[0], args);

	// add a markers reference
	map.markers = [];

	// add markers
	$markers.each(function(){

    	add_marker( $(this), map );

	});

	// center map
	center_map( map );

}

/*
*
* custom marker
*
* http://stackoverflow.com/questions/7095574/google-maps-api-3-custom-marker-color-for-default-dot-marker
*
*/
function pinSymbol(color) {
    return {
        path: 'M 0,0 C -2,-20 -10,-22 -10,-30 A 10,10 0 1,1 10,-30 C 10,-22 2,-20 0,0 z M -2,-30 a 2,2 0 1,1 4,0 2,2 0 1,1 -4,0',
        fillColor: color,
        fillOpacity: 0.8,
        strokeColor: '#fff',
        strokeWeight: 2,
        scale: 1,
   };
}

/*
*  add_marker
*
*  This function will add a marker to the selected Google Map
*
*  @type	function
*  @date	8/11/2013
*  @since	4.3.0
*
*  @param	$marker (jQuery element)
*  @param	map (Google Map object)
*  @return	n/a
*/

function add_marker( $marker, map ) {

	// var
	var latlng = new google.maps.LatLng( $marker.attr('data-lat'), $marker.attr('data-lng') );

	// create marker
	var marker = new google.maps.Marker({
		position	: latlng,
		map			: map,
        icon: pinSymbol("#ed7703")
	});

	// add to array
	map.markers.push( marker );

	// if marker contains HTML, add it to an infoWindow
	if( $marker.html() )
	{
		// create info window
		var infowindow = new google.maps.InfoWindow({
			content		: $marker.html()
		});

		// show info window when marker is clicked
		google.maps.event.addListener(marker, 'click', function() {

			infowindow.open( map, marker );

		});
	}

}

/*
*  center_map
*
*  This function will center the map, showing all markers attached to this map
*
*  @type	function
*  @date	8/11/2013
*  @since	4.3.0
*
*  @param	map (Google Map object)
*  @return	n/a
*/

function center_map( map ) {

	// vars
	var bounds = new google.maps.LatLngBounds();

	// loop through all markers and create bounds
	$.each( map.markers, function( i, marker ){

		var latlng = new google.maps.LatLng( marker.position.lat(), marker.position.lng() );

		bounds.extend( latlng );

	});

	// only 1 marker?
	if( map.markers.length == 1 )
	{
		// set center of map
	    map.setCenter( bounds.getCenter() );
	    map.setZoom( 16 );
	}
	else
	{
		// fit to bounds
		map.fitBounds( bounds );
	}

}

/*
*  document ready
*
*  This function will render each map when the document is ready (page has loaded)
*
*  @type	function
*  @date	8/11/2013
*  @since	5.0.0
*
*  @param	n/a
*  @return	n/a
*/

$(document).ready(function(){

	$('.acf-map').each(function(){

		render_map( $(this) );

	});

});

})(jQuery);
