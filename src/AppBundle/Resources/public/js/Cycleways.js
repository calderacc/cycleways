var Cycleways = Cycleways || {};

Cycleways.loadModule = function(name, context, options, callback) {
    require([name], function(Module) {
        var module = new Module(context, options);

        if (callback) {
            callback(module);
        }
    });
};

require.config({
    baseUrl: '/bundles/app/js/modules/',
    paths:
    {
        "localforage": "/bundles/app/js/external/localforage/localforage-1.4.3",
        "leaflet": "/bundles/app/js/external/leaflet/leaflet",
        "leaflet-activearea": "/bundles/app/js/external/leaflet/L.activearea",
        "leaflet-locate": "/bundles/app/js/external/leaflet/L.Control.Locate",
        "leaflet-sidebar": "/bundles/app/js/external/leaflet/L.Control.Sidebar",
        "leaflet-geometry": "/bundles/app/js/external/leaflet/leaflet.geometryutil",
        "leaflet-groupedlayer": "/bundles/app/js/external/leaflet/leaflet.groupedlayercontrol",
        "leaflet-snap": "/bundles/app/js/external/leaflet/leaflet.snap",
        "leaflet-hash": "/bundles/app/js/external/leaflet/leaflet-hash",
        "leaflet-polyline": "/bundles/app/js/external/leaflet/leaflet-polyline",
        "leaflet-extramarkers": "/bundles/app/js/external/leaflet/ExtraMarkers",
        "leaflet-markercluster": "/bundles/app/js/external/leaflet/leaflet-markercluster",
        "leaflet-draw": "/bundles/app/js/external/leaflet/leaflet.draw",
        "leaflet-routing-draw": "/bundles/app/js/external/leaflet/L.Routing.Draw",
        "leaflet-routing-edit": "/bundles/app/js/external/leaflet/L.Routing.Edit",
        "leaflet-routing": "/bundles/app/js/external/leaflet/L.Routing",
        "leaflet-routing-storage": "/bundles/app/js/external/leaflet/L.Routing.Storage",
        "leaflet-snapping-lineutil": "/bundles/app/js/external/leaflet/LineUtil.Snapping",
        "leaflet-snapping-marker": "/bundles/app/js/external/leaflet/Marker.Snapping",
        "leaflet-snapping-polyline": "/bundles/app/js/external/leaflet/Polyline.Snapping",
        "bootstrap-slider": "/bundles/app/js/external/bootstrap/bootstrap-slider",
        "dropzone": "/bundles/app/js/external/dropzone/dropzone.min",
        "js-cookie": "/bundles/app/js/external/js-cookie/js-cookie",
        "typeahead": "/bundles/app/js/external/typeahead/typeahead",
        "bloodhound": "/bundles/app/js/external/typeahead/bloodhound",
        "jquery": "/bundles/app/js/external/jquery/jquery-2.1.4.min",
        "dateformat": "/bundles/app/js/external/dateformat/dateformat",
        "bootstrap-datepicker": "/bundles/app/js/external/bootstrap-datepicker/bootstrap-datepicker.min",
        "bootstrap-select": "/bundles/app/js/external/bootstrap-select/bootstrap-select.min"
    },
    shim: {
        'leaflet-locate': {
            deps: ['leaflet'],
            exports: 'L.Control.Locate'
        },
        'leaflet-groupedlayer': {
            deps: ['leaflet'],
            exports: 'L.Control.GroupedLayers'
        },
        'leaflet-snap': {
            deps: ['leaflet'],
            exports: 'L.Handler.MarkerSnap'
        },
        'leaflet-hash': {
            deps: ['leaflet'],
            exports: 'L.Hash'
        },
        'leaflet-polyline': {
            deps: ['leaflet'],
            exports: 'L.PolylineUtil'
        },
        'leaflet-playback': {
            deps: ['leaflet'],
            exports: 'L.Playback'
        },
        'leaflet-extramarkers': {
            deps: ['leaflet'],
            exports: 'L.ExtraMarkers'
        },
        'leaflet-markercluster': {
            deps: ['leaflet'],
            exports: 'L.MarkerClusterGroup'
        },
        'leaflet-draw': {
            deps: ['leaflet'],
            exports: 'L.Control.Draw'
        },
        'leaflet-routing': {
            deps: ['leaflet'],
            exports: 'L.Routing'
        },
        'leaflet-routing-draw': {
            deps: ['leaflet', 'leaflet-routing'],
            exports: 'L.Routing.Draw'
        },
        'leaflet-routing-edit': {
            deps: ['leaflet', 'leaflet-routing'],
            exports: 'L.Routing.Edit'
        },
        'leaflet-routing-storage': {
            deps: ['leaflet', 'leaflet-routing'],
            exports: 'L.Routing.Storage'
        },
        'leaflet-snapping-marker': {
            deps: ['leaflet'],
            exports: 'L.Marker'
        },
        'leaflet-snapping-lineutil': {
            deps: ['leaflet'],
            exports: 'L.LineUtil'
        },
        'leaflet-snapping-polyline': {
            deps: ['leaflet'],
            exports: 'L.Polyline'
        },
        'socketio': {
            exports: 'io'
        },
        typeahead:{
            deps: ['jquery'],
            init: function ($) {
                return require.s.contexts._.registry['typeahead.js'].factory( $ );
            }
        },
        bloodhound: {
            deps: [],
            exports: 'Bloodhound'
        }
    }
});
