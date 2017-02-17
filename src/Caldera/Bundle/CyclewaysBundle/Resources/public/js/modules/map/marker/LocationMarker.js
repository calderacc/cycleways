define(['Marker'], function () {
    LocationMarker = function (latLng, draggable) {
        this._latLng = latLng;
        this._draggable = draggable;
    };

    LocationMarker.prototype = new Marker();
    LocationMarker.prototype.constructor = LocationMarker;

    LocationMarker.prototype._initIcon = function () {
        this._icon = L.icon({
            iconUrl: this._baseIconUrl + 'marker-yellow.png',
            iconRetinaUrl: this._baseIconUrl + 'marker-yellow-2x.png',
            iconSize: [25, 41],
            iconAnchor: [13, 41],
            popupAnchor: [0, -36],
            shadowUrl: this._baseIconUrl + 'defaultshadow.png',
            shadowSize: [41, 41],
            shadowAnchor: [13, 41]
        });
    };

    return LocationMarker;
});