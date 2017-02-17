define(['leaflet'], function () {
    Marker = function (latLng, draggable) {
        this._latLng = latLng;
        this._draggable = draggable;
    };

    Marker.prototype._latLng = null;
    Marker.prototype._draggable = false;
    Marker.prototype._map = false;
    Marker.prototype._layer = false;
    Marker.prototype._icon = null;
    Marker.prototype._baseIconUrl = bundleBaseDirectory + 'images/marker/';
    Marker.prototype._isMapped = false;

    Marker.prototype._initIcon = function () {

    };

    Marker.prototype.getLatLng = function () {
        return this._marker.getLatLng();
    };

    Marker.prototype.setLatLng = function (latLng) {
        this._latLng = latLng;

        if (this._marker) {
            // before moving the marker, popups have to be closed
            this._marker.closePopup();
            this._marker.setLatLng(latLng);
        }
    };

    Marker.prototype.addTo = function (layer) {
        this._initIcon();

        this._marker = L.marker(this._latLng,
            {
                icon: this._icon,
                draggable: this._draggable
            });

        this._marker.addTo(layer);
    };

    Marker.prototype.addToMap = function (map) {
        this._map = map;
        this._isMapped = true;

        this.addTo(map.map);
    };

    Marker.prototype.addToLayer = function (layer) {
        this._layer = layer;
        this._isMapped = true;

        this.addTo(layer);
    };

    Marker.prototype.removeFromMap = function (map) {
        map.map.removeLayer(this._marker);

        this._isMapped = false;
    };

    Marker.prototype.addPopupText = function (popupText, openPopup) {
        if (openPopup) {
            this._marker.bindPopup(popupText).openPopup();
        } else {
            this._marker.bindPopup(popupText);
        }
    };

    Marker.prototype.on = function (event, func) {
        this._marker.on(event, func);
    };

    Marker.prototype.isMapped = function () {
        return this._isMapped;
    };

    return Marker;
});