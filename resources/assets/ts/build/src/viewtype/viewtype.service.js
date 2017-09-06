var devArt;
(function (devArt) {
    var viewtype;
    (function (viewtype) {
        'use strict';
        var ViewTypeService = (function () {
            function ViewTypeService($cookieStore) {
                this.$cookieStore = $cookieStore;
                this.view = (typeof this.$cookieStore.get('viewType') === "undefined") ? 'large' :
                    this.$cookieStore.get('viewType');
            }
            ViewTypeService.$inject = ['$cookieStore'];
            return ViewTypeService;
        })();
        viewtype.ViewTypeService = ViewTypeService;
        angular.module('devArt').service('viewTypeService', ViewTypeService);
    })(viewtype = devArt.viewtype || (devArt.viewtype = {}));
})(devArt || (devArt = {}));
//# sourceMappingURL=viewtype.service.js.map