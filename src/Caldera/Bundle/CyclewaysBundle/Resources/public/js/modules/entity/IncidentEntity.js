define(['CriticalService', 'leaflet', 'BaseEntity', 'leaflet-polyline', 'leaflet-extramarkers', 'Modal', 'CloseModalButton', 'ModalButton', 'IncidentMarker'], function (CriticalService) {
    IncidentEntity = function () {
    };

    IncidentEntity.prototype = new MarkerEntity();
    IncidentEntity.prototype.constructor = IncidentEntity;

    IncidentEntity.prototype._CriticalService = CriticalService;

    IncidentEntity.prototype._id = null;
    IncidentEntity.prototype._title = null;
    IncidentEntity.prototype._description = null;
    IncidentEntity.prototype._geometryType = null;
    IncidentEntity.prototype._incidentType = null;
    IncidentEntity.prototype._dangerLevel = null;
    IncidentEntity.prototype._polyline = null;
    IncidentEntity.prototype._polyLayer = null;
    IncidentEntity.prototype._expires = null;
    IncidentEntity.prototype._visibleFrom = null;
    IncidentEntity.prototype._visibleTo = null;
    IncidentEntity.prototype._layer = null;

    IncidentEntity.prototype.addPolylineToMap = function (map) {
        var latLngList = null;
        var polyOptions = {color: 'red'};

        if (this._polyline) {
            latLngList = L.PolylineUtil.decode(this._polyline);
        }

        if (this._geometryType == 'polygon') {
            this._polyLayer = new L.polygon(latLngList, polyOptions);
        }

        if (this._geometryType == 'polyline') {
            this._polyLayer = new L.polyline(latLngList, polyOptions)
        }

        this._polyLayer.addTo(map.map);
    };

    IncidentEntity.prototype.addTo = function (layer) {
        var latLng = null;

        if (this._latitude && this._longitude) {
            latLng = L.latLng(this._latitude, this._longitude);

            this._layer = new IncidentMarker(
                latLng,
                this._incidentType,
                this._dangerLevel
            );
        }

        if (this._layer) {
            this._layer.addTo(layer);

            this._initPopup();

            var that = this;

            this._layer.on('click', function () {
                that.openPopup();
            });
        }
    };

    IncidentEntity.prototype.addToMap = function (map) {
        this.addTo(map.map);
    };

    IncidentEntity.prototype.addToLayer = function (markerLayer) {
        this.addTo(markerLayer);
    };

    IncidentEntity.prototype.hasPolyline = function () {
        return this._polyline != null;
    };
    
    IncidentEntity.prototype._initPopup = function () {
        this._modal = new Modal();

        this._modal.setSize('md');

        this._modal.setTitle(this._title);
        this._modal.setBody(this._description);

        this._modal.resetButtons();
        this._modal.addButton(new CloseModalButton());

        var url = Routing.generate('caldera_cycleways_incident_show', { slug: this._slug });
        
        var focusButton = new ModalButton();
        focusButton.setCaption('Anzeigen');
        focusButton.setHref(url);
        focusButton.setClass('btn-primary btn-success');

        var that = this;
        focusButton.setOnClickEvent(function () {
            that._CriticalService.getMap().fitBounds(that.getBounds());
        });

        this._modal.addButton(focusButton);

    };

    IncidentEntity.prototype.openPopup = function () {
        this._modal.show();
    };

    IncidentEntity.prototype.getBounds = function () {
        return this._layer.getBounds();
    };

    return IncidentEntity;
});
