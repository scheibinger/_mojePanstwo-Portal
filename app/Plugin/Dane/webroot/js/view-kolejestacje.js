var googleMapKolejeStacje = {
    googleMap: $('mapa'),
    map: null,
    geocoder: null,

    /*CREATE GOOGLE MAP*/
    init: function () {
        var that = this;

        if (this.googleMap) {
            var mapOptions = {
                center: new google.maps.LatLng(51.95972581431439, 18.51660156250001),
                zoom: 6,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };
            that.map = new google.maps.Map(that.googleMap, mapOptions);
            that.geocoder = new google.maps.Geocoder();

            that.station();
        }
    },
    /*ADD STATION WITH CUSTOM INFOVIEW*/
    station: function () {
        var that = this,
            stationData = jQuery.parseJSON(stationLineData),
            stationPos = new google.maps.LatLng(stationData.loc_lat, stationData.loc_lng),
            stationName = stationData.nazwa,
            stationContent = '<div class="infoWindowBox"><strong>' + stationName + '</strong></div>',
            infowindow = new google.maps.InfoWindow({content: "<div><strong> ... </strong></div>"});

        marker = new google.maps.Marker({
            map: that.map,
            position: stationPos,
            content: stationContent,
            title: stationName
        });

        google.maps.event.addListener(marker, 'click', function () {
            infowindow.setContent(this.content);
            infowindow.open(that.map, this);
        });

        that.map.setCenter(stationPos);
        that.map.setZoom(14);
    }
};

jQuery(document).ready(function () {
    googleMapKolejeStacje.init();
});