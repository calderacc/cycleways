define(['Map', 'LocationMarker', 'CityMarker', 'Geocoding'], function () {
    var EditCityPage = function (settings) {
        this.settings = $.extend(this._defaults, settings);

        this._geocoding = new Geocoding();
        this._geocoding.setCountry(this._defaults.country);
        this._geocoding.setState(this._defaults.state);

        this._init();
    };


    EditCityPage.prototype._defaults = {
        mapContainerId: 'map',
        cityLatitudeInputSelector: '#city_latitude',
        cityLongitudeInputSelector: '#city_longitude',
        cityStandardLatitudeInputSelector: '#city_standardLatitude',
        cityStandardLongitudeInputSelector: '#city_standardLongitude',
        cityIsStandardableLocationInputSelector: '#city_isStandardableLocation',
        cityIsLocationInputSelector: '#city_standardLocation',
        cityMarkerPopupText: 'Zieh mich auf den Mittelpunkt der Stadt!',
        cityStandardLocationPopupText: 'Zieh mich auf den Treffpunkt!',
        defaultCenterLatitude: 51.163375,
        defaultCenterLongitude: 10.447683
    };

    EditCityPage.prototype.map = null;
    EditCityPage.prototype.cityLatLng = null;
    EditCityPage.prototype.standardLocationLatLng = null;
    EditCityPage.prototype.defaultCenterLatLng = null;
    EditCityPage.prototype.mapCenter = null;
    EditCityPage.prototype.mapZoom = null;
    EditCityPage.prototype.cityMarker = null;
    EditCityPage.prototype.locationMarker = null;
    EditCityPage.prototype._geocoding = null;

    EditCityPage.prototype._init = function () {
        this._initLatLngs();
        this._initMap();
        this._initGeolocationEvents();
    };

    EditCityPage.prototype._initLatLngs = function () {
        var cityLatitude = $(this.settings.cityLatitudeInputSelector).val();
        var cityLongitude = $(this.settings.cityLongitudeInputSelector).val();

        if (this.isFloat(cityLatitude) && this.isFloat(cityLongitude)) {
            this.cityLatLng = L.latLng(cityLatitude, cityLongitude);
        }

        var standardLocationLatitude = $(this.settings.cityStandardLatitudeInputSelector).val();
        var standardLocationLongitude = $(this.settings.cityStandardLongitudeInputSelector).val();

        if (this.isFloat(standardLocationLatitude) && this.isFloat(standardLocationLongitude)) {
            this.standardLocationLatLng = L.latLng(standardLocationLatitude, standardLocationLongitude);
        }

        this.defaultCenterLatLng = L.latLng(this.settings.defaultCenterLatitude, this.settings.defaultCenterLongitude);
    };

    EditCityPage.prototype._initMap = function () {
        var that = this;

        this.map = new Map(this.settings.mapContainerId, []);

        if (this.cityLatLng) {
            this.mapCenter = this.cityLatLng;
            this.mapZoom = 12;

            this.map.setView(this.mapCenter, this.mapZoom);

            this._initCityMarker();
            this._initLocationMarker();
        } else {
            this._geocoding.searchState(this.settings.state, function (data) {
                that.mapCenter = L.latLng(data.lat, data.lon);

                that.mapZoom = 5;

                that.map.setView(that.mapCenter, that.mapZoom);

                that._initCityMarker();
                that._initLocationMarker();
            });
        }
    };

    EditCityPage.prototype._initCityMarker = function () {
        this.cityMarker = new CityMarker(this.mapCenter, true);
        this.cityMarker.addToMap(this.map);
        this.cityMarker.addPopupText(this.settings.cityMarkerPopupText, true);

        that = this;

        this.cityMarker.on('dragend', function (event) {
            var marker = event.target;
            var position = marker.getLatLng();

            that._updateCityPosition(position);
        });
    };

    EditCityPage.prototype._initLocationMarker = function () {
        var that = this;

        if (this.standardLocationLatLng) {
            this._addStandardLocationMarker();
        }

        $(this.settings.cityIsStandardableLocationInputSelector).on('click', function () {
            if ($(this).prop('checked')) {
                that._addStandardLocationMarker();
                $(that.settings.cityIsLocationInputSelector).prop('disabled', '');
            } else {
                that._removeStandardLocationMarker();
                $(that.settings.cityIsLocationInputSelector).prop('disabled', 'disabled');
            }
        });
    };

    EditCityPage.prototype._addStandardLocationMarker = function () {
        var that = this;

        var cityMarkerLatLng = this.cityMarker.getLatLng();

        if (this.standardLocationLatLng) {
            this.locationMarker = new LocationMarker(this.standardLocationLatLng, true);
        } else {
            this.locationMarker = new LocationMarker(cityMarkerLatLng, true);
        }

        this.locationMarker.addToMap(this.map);
        this.locationMarker.addPopupText(this.settings.cityStandardLocationPopupText, true);

        this.locationMarker.on('dragend', function (event) {
            var marker = event.target;
            var position = marker.getLatLng();

            that._updateLocationPosition(position);
        });

    };

    EditCityPage.prototype._removeStandardLocationMarker = function () {
        this.locationMarker.removeFromMap(this.map);
    };

    EditCityPage.prototype.isFloat = function (n) {
        n = parseFloat(n);
        return n === Number(n) && n % 1 !== 0;
    };

    EditCityPage.prototype._updateCityPosition = function (position) {
        $(this.settings.cityLatitudeInputSelector).val(position.lat);
        $(this.settings.cityLongitudeInputSelector).val(position.lng);
    };

    EditCityPage.prototype._moveCityMarker = function (latLng) {
        this.cityMarker.setLatLng(latLng);
    };

    EditCityPage.prototype._moveLocationMarker = function (latLng) {
        this.locationMarker.setLatLng(latLng);
    };

    EditCityPage.prototype._getStandardLocationLatLng = function () {
        return {
            lat: $(this.settings.cityStandardLatitudeInputSelector).val(),
            lng: $(this.settings.cityStandardLongitudeInputSelector).val()
        };
    };

    EditCityPage.prototype._updateLocationPosition = function (position) {
        $(this.settings.cityStandardLatitudeInputSelector).val(position.lat);
        $(this.settings.cityStandardLongitudeInputSelector).val(position.lng);
    };

    EditCityPage.prototype._initGeolocationEvents = function () {
        var that = this;

        this._$searchCityButton = $('#search-city-button');
        this._$searchLocationButton = $('#search-location-button');
        this._$countrySelect = $('#city_region');

        this._$searchCityButton.on('click', function () {
            var cityName = $('#city_city').val();

            that._geocoding.searchCity(cityName, function (data) {
                that._handleGeocodingCity(data);
            });
        });

        this._$searchLocationButton.on('click', function () {
            var cityName = $('#city_city').val();
            var locationName = $('#city_standardLocation').val();

            if (cityName.length == 0) {
                alert('Bitte gib zuerst den Namen einer Stadt ein.');
            } else {
                that._geocoding.searchPlace(locationName, cityName, function (data) {
                    that._handleGeocodingLocation(data);
                });
            }
        });

        this._$countrySelect.on('change', function (value) {
            var stateName = that._$countrySelect.find('option:selected').text();

            that._geocoding.setState(stateName);
        });
    };

    EditCityPage.prototype._handleGeocodingCity = function (data) {
        if (data && data.lat && data.lon) {
            var latLng = {
                lat: data.lat,
                lng: data.lon
            };

            this._updateCityPosition(latLng);
            this._moveCityMarker(latLng);
            this.map.setView(latLng, 15);
        } else {
            alert('Die Stadt wurde nicht gefunden. Bitte schiebe den Marker mauell auf den Mittelpunkt der Stadt.');
        }
    };

    EditCityPage.prototype._handleGeocodingLocation = function (data) {
        var latLng = {
            lat: data.lat,
            lng: data.lon
        };

        this._updateLocationPosition(latLng);
        this._moveLocationMarker(latLng);
        this.map.setView(latLng, 15);
    };

    return EditCityPage;
});