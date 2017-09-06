var devArt;
(function (devArt) {
    'use strict';
    var AppController = (function () {
        function AppController() {
            this.isBookmarkShow = false;
            this.isCategoryShow = false;
        }
        AppController.prototype.setIsBookmarkShow = function () {
            this.isBookmarkShow = !this.isBookmarkShow;
        };
        AppController.prototype.setIsCategoryShow = function () {
            this.isCategoryShow = !this.isCategoryShow;
        };
        AppController.prototype.hideSidebar = function () {
            this.isBookmarkShow = false;
            this.isCategoryShow = false;
        };
        AppController.prototype.stopProp = function ($event) {
            $event.stopPropagation();
        };
        return AppController;
    })();
    angular.module('devArt').controller('AppController', AppController);
})(devArt || (devArt = {}));
//# sourceMappingURL=app.controller.js.map