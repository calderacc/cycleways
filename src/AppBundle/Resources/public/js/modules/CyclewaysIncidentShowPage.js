define(['CriticalService', 'Map', 'IncidentEntity', 'bootstrap-select'], function (CriticalService) {
    CyclewaysIncidentShowPage = function (context, options) {
        this._CriticalService = CriticalService;

        this._options = options;

        this._initMap();
        this._setHeaderRow();
        this._initSelect();
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

    CyclewaysIncidentShowPage.prototype._initSelect = function () {
        $('#status-select').on('changed.bs.select', function (event, clickedIndex, newValue, oldValue) {
            var statusId = $(event.target).val();

            $.ajax({
                method: 'POST',
                url: Routing.generate('caldera_cycleways_incident_status_update', { slug: this._incident._slug }),
                data: { statusId: statusId }
            });
        }.bind(this));

        $('#issuer-select').on('changed.bs.select', function (event, clickedIndex, newValue, oldValue) {
            var userId = $(event.target).val();

            $.ajax({
                method: 'POST',
                url: Routing.generate('caldera_cycleways_incident_issuer_update', { slug: this._incident._slug }),
                data: { userId: userId }
            });
        }.bind(this));

        $('#tag-select').on('changed.bs.select', function (event, clickedIndex, newValue, oldValue) {
            var tagList = $(event.target).val();

            $.ajax({
                method: 'POST',
                url: Routing.generate('caldera_cycleways_incident_tag_update', { slug: this._incident._slug }),
                data: { tagList: tagList }
            });
        }.bind(this));
    };

    return CyclewaysIncidentShowPage;
});
