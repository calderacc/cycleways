define(['CriticalService', 'Map', 'IncidentEntity'], function (CriticalService) {
    CyclewaysIncidentShowPage = function (context, options) {
        this._CriticalService = CriticalService;

        this._options = options;

        this._initMap();
        this._setHeaderRow();
    };

    CyclewaysIncidentShowPage.prototype._CriticalService = null;
    CyclewaysIncidentShowPage.prototype._map = null;
    CyclewaysIncidentShowPage.prototype._incident = null;

    CyclewaysIncidentShowPage.prototype._initMap = function () {
        this._map = new Map('map', []);

        this._CriticalService.setMap(this._map);
    };

    CyclewaysIncidentShowPage.prototype.focus = function () {
        this._map.setView(this._incident.getLatLng(), 15);
    };

    CyclewaysIncidentShowPage.prototype.setIncident = function (incidentJson) {
        this._incident = this._CriticalService.factory.createIncident(incidentJson);

        this._incident.addToMap(this._map);

        if (this._incident.hasPolyline()) {
            this._incident.addPolylineToMap(this._map);
        }
    };

    CyclewaysIncidentShowPage.prototype._setHeaderRow = function () {
        var $featuredPhoto = $('#featured-photo');

        if ($featuredPhoto) {
            var height = $featuredPhoto.height();

            $('#map').height(height);
        }
    };


    return CyclewaysIncidentShowPage;
});
