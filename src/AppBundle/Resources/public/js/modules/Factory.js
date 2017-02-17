define([], function () {

    Factory = function () {
    };

    Factory.prototype.createIncident = function (incidentJson) {
        var incidentEntity = new IncidentEntity();

        incidentEntity = this._transferProperties(incidentEntity, incidentJson);

        return incidentEntity;
    };

    Factory.prototype._transferProperties = function (entity, data) {
        var object = null;

        if (data !== null && typeof data === 'object') {
            object = data;
        } else {
            object = JSON.parse(data);
        }

        for (var property in object) {
            if (object.hasOwnProperty(property)) {
                entityProperty = property.charAt(0).toLowerCase() + property.slice(1);

                var prefix = '';

                if (entityProperty.charAt(0) != '_') {
                    prefix = '_';
                }

                if (entityProperty == 'timestamp') {
                    entity[prefix + entityProperty] = new Date(object[property] * 1000);
                } else if (entityProperty == 'city') {
                    entity[prefix + entityProperty] = this.createCity(object[property]);
                } else if (entityProperty == 'user') {
                    entity[prefix + entityProperty] = this.createUser(object[property]);
                } else {
                    entity[prefix + entityProperty] = object[property];
                }
            }
        }

        return entity;
    };

    return new Factory;
});
