var CriticalMass = CriticalMass || {};

CriticalMass.loadModule = function(name, context, options, callback) {
    require([name], function(Module) {
        var module = new Module(context, options);

        if (callback) {
            callback(module);
        }
    });
};

require.config({
    baseUrl: '/',
    paths:
    {
        "CalderaCityMapPage": bundleBaseDirectory + "js/modules/page/CalderaCityMapPage",
        "CyclewaysIncidentPage": bundleBaseDirectory + "js/modules/page/CyclewaysIncidentPage",
        "CyclewaysIncidentEditPage": bundleBaseDirectory + "js/modules/page/CyclewaysIncidentEditPage",
        "CyclewaysIncidentShowPage": bundleBaseDirectory + "js/modules/page/CyclewaysIncidentShowPage",
        "CyclewaysLocationSearch": bundleBaseDirectory + "js/modules/CyclewaysLocationSearch",
        "CityEntity": bundleBaseDirectory + "js/modules/entity/CityEntity",
        "WritePost": bundleBaseDirectory + "js/modules/WritePost",
        "CriticalService": bundleBaseDirectory + "js/modules/CriticalService",
        "RideEntity": bundleBaseDirectory + "js/modules/entity/RideEntity",
        "EventEntity": bundleBaseDirectory + "js/modules/entity/EventEntity",
        "LiveRideEntity": bundleBaseDirectory + "js/modules/entity/LiveRideEntity",
        "Factory": bundleBaseDirectory + "js/modules/entity/Factory",
        "NoLocationRideEntity": bundleBaseDirectory + "js/modules/entity/NoLocationRideEntity",
        "TrackEntity": bundleBaseDirectory + "js/modules/entity/TrackEntity",
        "TimelapseTrackEntity": bundleBaseDirectory + "js/modules/entity/TimelapseTrackEntity",
        "SubrideEntity": bundleBaseDirectory + "js/modules/entity/SubrideEntity",
        "PositionEntity": bundleBaseDirectory + "js/modules/entity/PositionEntity",
        "IncidentEntity": bundleBaseDirectory + "js/modules/entity/IncidentEntity",
        "UserEntity": bundleBaseDirectory + "js/modules/entity/UserEntity",
        "BaseEntity": bundleBaseDirectory + "js/modules/entity/BaseEntity",
        "MarkerEntity": bundleBaseDirectory + "js/modules/entity/MarkerEntity",
        "PhotoEntity": bundleBaseDirectory + "js/modules/entity/PhotoEntity",
        "Container": bundleBaseDirectory + "js/modules/entity/Container",
        "LocalContainer": bundleBaseDirectory + "js/modules/entity/LocalContainer",
        "ClusterContainer": bundleBaseDirectory + "js/modules/entity/ClusterContainer",
        "IncidentContainer": bundleBaseDirectory + "js/modules/entity/IncidentContainer",
        "EditCityPage": bundleBaseDirectory + "js/modules/page/EditCityPage",
        "EditRidePage": bundleBaseDirectory + "js/modules/page/EditRidePage",
        "LivePage": bundleBaseDirectory + "js/modules/page/LivePage",
        "LiveFrontPage": bundleBaseDirectory + "js/modules/page/LiveFrontPage",
        "RegionPage": bundleBaseDirectory + "js/modules/page/RegionPage",
        "StravaImportPage": bundleBaseDirectory + "js/modules/page/StravaImportPage",
        "TrackListPage": bundleBaseDirectory + "js/modules/page/TrackListPage",
        "FacebookImportRidePage": bundleBaseDirectory + "js/modules/page/FacebookImportRidePage",
        "RidePage": bundleBaseDirectory + "js/modules/page/RidePage",
        "RideStatisticPage": bundleBaseDirectory + "js/modules/page/RideStatisticPage",
        "IncidentEditPage": bundleBaseDirectory + "js/modules/page/IncidentEditPage",
        "PhotoViewModal": bundleBaseDirectory + "js/modules/PhotoViewModal",
        "Notification": bundleBaseDirectory + "js/modules/Notification",
        "Timelapse": bundleBaseDirectory + "js/modules/map/Timelapse",
        "TrackRangePage": bundleBaseDirectory + "js/modules/page/TrackRangePage",
        "TrackUploadPage": bundleBaseDirectory + "js/modules/page/TrackUploadPage",
        "TrackViewPage": bundleBaseDirectory + "js/modules/page/TrackViewPage",
        "TrackDrawPage": bundleBaseDirectory + "js/modules/page/TrackDrawPage",
        "ViewPhotoPage": bundleBaseDirectory + "js/modules/page/ViewPhotoPage",
        "UploadPhotoPage": bundleBaseDirectory + "js/modules/page/UploadPhotoPage",
        "ChatPage": bundleBaseDirectory + "js/modules/page/ChatPage",
        "CityStatisticPage": bundleBaseDirectory + "js/modules/page/CityStatisticPage",
        "EditSubridePage": bundleBaseDirectory + "js/modules/page/EditSubridePage",
        "FacebookStatisticPage": bundleBaseDirectory + "js/modules/page/FacebookStatisticPage",
        "StatisticPage": bundleBaseDirectory + "js/modules/page/StatisticPage",
        "Map": bundleBaseDirectory + "js/modules/map/Map",
        "AutoMap": bundleBaseDirectory + "js/modules/map/AutoMap",
        "DrawMap": bundleBaseDirectory + "js/modules/map/DrawMap",
        "Geocoding": bundleBaseDirectory + "js/modules/Geocoding",
        "Modal": bundleBaseDirectory + "js/modules/modal/Modal",
        "BaseModalButton": bundleBaseDirectory + "js/modules/modal/BaseModalButton",
        "CloseModalButton": bundleBaseDirectory + "js/modules/modal/CloseModalButton",
        "ModalButton": bundleBaseDirectory + "js/modules/modal/ModalButton",
        "MapLayerControl": bundleBaseDirectory + "js/modules/map/MapLayerControl",
        "MapLocationControl": bundleBaseDirectory + "js/modules/map/MapLocationControl",
        "MapPositions": bundleBaseDirectory + "js/modules/map/MapPositions",
        "Marker": bundleBaseDirectory + "js/modules/map/marker/Marker",
        "CityMarker": bundleBaseDirectory + "js/modules/map/marker/CityMarker",
        "LocationMarker": bundleBaseDirectory + "js/modules/map/marker/LocationMarker",
        "IncidentMarker": bundleBaseDirectory + "js/modules/map/marker/IncidentMarker",
        "PhotoMarker": bundleBaseDirectory + "js/modules/map/marker/PhotoMarker",
        "PositionMarker": bundleBaseDirectory + "js/modules/map/marker/PositionMarker",
        "SubrideMarker": bundleBaseDirectory + "js/modules/map/marker/SubrideMarker",
        "SnapablePhotoMarker": bundleBaseDirectory + "js/modules/map/marker/SnapablePhotoMarker",
        "IncidentMarkerIcon": bundleBaseDirectory + "js/modules/map/icon/IncidentMarkerIcon",
        "Search": bundleBaseDirectory + "js/modules/Search",
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
        "socketio": bundleBaseDirectory + "js/external/socketio/socketio",
        "chartjs": bundleBaseDirectory + "js/external/chartjs/chartjs",
        "hammerjs": bundleBaseDirectory + "js/external/hammerjs/hammer.min",
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
