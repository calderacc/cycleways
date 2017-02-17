define(['Map', 'bootstrap-slider'], function () {
    TrackRangePage = function (context, options) {

    };

    TrackRangePage.prototype._map = null;
    TrackRangePage.prototype._startPoint = null;
    TrackRangePage.prototype._endPoint = null;
    TrackRangePage.prototype._gapWidth = null;
    TrackRangePage.prototype._track = null;
    TrackRangePage.prototype._polylineLatLngs = null;
    TrackRangePage.prototype._colorRed = null;
    TrackRangePage.prototype._colorGreen = null;
    TrackRangePage.prototype._colorBlue = null;

    TrackRangePage.prototype._loadStyles = function () {
        var $link = $('<link>', {
            rel: 'stylesheet',
            type: 'text/css',
            href: '/bundles/calderacriticalmasssite/css/external/bootstrap-slider.min.css'
        });

        $link.appendTo('head');
    };

    TrackRangePage.prototype.setStartPoint = function (startPoint) {
        this._startPoint = startPoint;
    };

    TrackRangePage.prototype.setEndPoint = function (endPoint) {
        this._endPoint = endPoint;
    };

    TrackRangePage.prototype.setGapWidth = function (gapWidth) {
        this._gapWidth = gapWidth;
    };

    TrackRangePage.prototype.setPolylineLatLngs = function (polylineLatLngs) {
        this._polylineLatLngs = polylineLatLngs;
    };

    TrackRangePage.prototype.setColor = function (colorRed, colorGreen, colorBlue) {
        this._colorRed = colorRed;
        this._colorGreen = colorGreen;
        this._colorBlue = colorBlue;
    };

    TrackRangePage.prototype.init = function () {
        this._loadStyles();
        this._initMap();
        this._initControl();
        this._initTrack();
        this._initSlider();

        this._map.fitBounds(this._polyline.getBounds());
    };

    TrackRangePage.prototype._initTrack = function () {
        this._polyline = L.polyline(this._polylineLatLngs, {color: 'rgb(' + this._colorRed + ', ' + this._colorGreen + ', ' + this._colorBlue + ')'});

        this._polyline.addTo(this._map.map);
    };

    TrackRangePage.prototype._initMap = function () {
        this._map = new Map('map');
    };

    TrackRangePage.prototype._initControl = function () {

    };

    TrackRangePage.prototype._initSlider = function () {
        var sliderOptions = {
            id: "rangeSlider",
            min: 0,
            max: this._polylineLatLngs.length,
            range: true,
            value: [this._startPoint / this._gapWidth, this._endPoint / this._gapWidth],
            tooltip: 'hide'
        };

        $slider = $('#slider');
        $slider.slider(sliderOptions);

        var that = this;

        $slider.on("slide", function (slideEvt) {
            var gapWidth = that._gapWidth;
            var endValue = slideEvt.value.pop();
            var beginValue = slideEvt.value.pop();

            $('#form_startPoint').val(beginValue * gapWidth);
            $('#form_endPoint').val(endValue * gapWidth);

            var newLatLngs = that._polylineLatLngs.slice();

            endValue -= beginValue;

            newLatLngs.splice(0, beginValue);
            newLatLngs.splice(endValue, newLatLngs.length - endValue);

            that._polyline.setLatLngs(newLatLngs);
        });
    };

    return TrackRangePage;
});