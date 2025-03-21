var styledMapType = new google.maps.StyledMapType(

[{
        "featureType": "administrative",
        "elementType": "all",
        "stylers": [{
                "visibility": "on"
            },
            {
                "lightness": 33
            }
        ]
    },
    {
        "featureType": "landscape",
        "elementType": "all",
        "stylers": [{
            "color": "#f7f7f7"
        }]
    },
    {
        "featureType": "poi.business",
        "elementType": "all",
        "stylers": [{
            "visibility": "off"
        }]
    },
    {
        "featureType": "poi.park",
        "elementType": "geometry",
        "stylers": [{
            "color": "#deecdb"
        }]
    },
    {
        "featureType": "poi.park",
        "elementType": "labels",
        "stylers": [{
                "visibility": "on"
            },
            {
                "lightness": "25"
            }
        ]
    },
    {
        "featureType": "road",
        "elementType": "all",
        "stylers": [{
            "lightness": "25"
        }]
    },
    {
        "featureType": "road",
        "elementType": "labels.icon",
        "stylers": [{
            "visibility": "off"
        }]
    },
    {
        "featureType": "road.highway",
        "elementType": "geometry",
        "stylers": [{
            "color": "#ffffff"
        }]
    },
    {
        "featureType": "road.highway",
        "elementType": "labels",
        "stylers": [{
                "saturation": "-90"
            },
            {
                "lightness": "25"
            }
        ]
    },
    {
        "featureType": "road.arterial",
        "elementType": "all",
        "stylers": [{
            "visibility": "on"
        }]
    },
    {
        "featureType": "road.arterial",
        "elementType": "geometry",
        "stylers": [{
            "color": "#ffffff"
        }]
    },
    {
        "featureType": "road.local",
        "elementType": "geometry",
        "stylers": [{
            "color": "#ffffff"
        }]
    },
    {
        "featureType": "transit.line",
        "elementType": "all",
        "stylers": [{
            "visibility": "off"
        }]
    },
    {
        "featureType": "transit.station",
        "elementType": "all",
        "stylers": [{
            "visibility": "off"
        }]
    },
    {
        "featureType": "water",
        "elementType": "all",
        "stylers": [{
                "visibility": "on"
            },
            {
                "color": "#e0f1f9"
            }
        ]
    }
]

, {
    name: 'Styled Map'
});