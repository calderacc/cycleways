define(['CriticalService', 'js-cookie'], function (CriticalService, Cookie) {
    PhotoShowPage = function (context, options) {
        this._initEventListeners();
    };

    PhotoShowPage.prototype._CriticalService = null;

    PhotoShowPage.prototype._initEventListeners = function() {
        $('#photo').click(this.toggleDisplay.bind(this));
    };

    PhotoShowPage.prototype.toggleDisplay = function() {
        var $photoCol = $('#photo-col');
        var $detailCol = $('#detail-col');

        if ($detailCol.is(":visible")) {
            $photoCol.removeClass('col-md-9').addClass('col-md-12');

            $detailCol.hide();

            Cookie.set('cycleways-photo-full', true, { expires: 7 });
        } else {
            $photoCol.removeClass('col-md-12').addClass('col-md-9');

            $detailCol.show();

            Cookie.set('cycleways-photo-full', false, { expires: 7 });
        }
    };

    return PhotoShowPage;
});
