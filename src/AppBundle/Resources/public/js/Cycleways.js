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
        "localforage": bundleBaseDirectory + "js/external/localforage/localforage-1.4.3",
        "leaflet": bundleBaseDirectory + "js/external/leaflet/leaflet",
        "leaflet-activearea": bundleBaseDirectory + "js/external/leaflet/L.activearea",
        "leaflet-locate": bundleBaseDirectory + "js/external/leaflet/L.Control.Locate",
        "leaflet-sidebar": bundleBaseDirectory + "js/external/leaflet/L.Control.Sidebar",
        "leaflet-geometry": bundleBaseDirectory + "js/external/leaflet/leaflet.geometryutil",
        "leaflet-groupedlayer": bundleBaseDirectory + "js/external/leaflet/leaflet.groupedlayercontrol",
        "leaflet-snap": bundleBaseDirectory + "js/external/leaflet/leaflet.snap",
        "leaflet-hash": bundleBaseDirectory + "js/external/leaflet/leaflet-hash",
        "leaflet-polyline": bundleBaseDirectory + "js/external/leaflet/leaflet-polyline",
        "leaflet-extramarkers": bundleBaseDirectory + "js/external/leaflet/ExtraMarkers",
        "leaflet-markercluster": bundleBaseDirectory + "js/external/leaflet/leaflet-markercluster",
        "leaflet-draw": bundleBaseDirectory + "js/external/leaflet/leaflet.draw",
        "leaflet-routing-draw": bundleBaseDirectory + "js/external/leaflet/L.Routing.Draw",
        "leaflet-routing-edit": bundleBaseDirectory + "js/external/leaflet/L.Routing.Edit",
        "leaflet-routing": bundleBaseDirectory + "js/external/leaflet/L.Routing",
        "leaflet-routing-storage": bundleBaseDirectory + "js/external/leaflet/L.Routing.Storage",
        "leaflet-snapping-lineutil": bundleBaseDirectory + "js/external/leaflet/LineUtil.Snapping",
        "leaflet-snapping-marker": bundleBaseDirectory + "js/external/leaflet/Marker.Snapping",
        "leaflet-snapping-polyline": bundleBaseDirectory + "js/external/leaflet/Polyline.Snapping",
        "bootstrap-slider": bundleBaseDirectory + "js/external/bootstrap/bootstrap-slider",
        "dropzone": bundleBaseDirectory + "js/external/dropzone/dropzone.min",
        "typeahead": bundleBaseDirectory + "js/external/typeahead/typeahead",
        "bloodhound": bundleBaseDirectory + "js/external/typeahead/bloodhound",
        "jquery": bundleBaseDirectory + "js/external/jquery/jquery-2.1.4.min",
        "dateformat": bundleBaseDirectory + "js/external/dateformat/dateformat",
        "bootstrap-datepicker": bundleBaseDirectory + "js/external/bootstrap-datepicker/bootstrap-datepicker.min"
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
