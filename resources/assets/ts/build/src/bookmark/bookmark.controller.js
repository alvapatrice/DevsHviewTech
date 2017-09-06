var devArt;
(function (devArt) {
    var bookmark;
    (function (bookmark_1) {
        'use strict';
        var BookmarksController = (function () {
            function BookmarksController($scope, $cookieStore) {
                this.$scope = $scope;
                this.$cookieStore = $cookieStore;
                this.$scope.listData = [];
            }
            BookmarksController.prototype.getBookmarks = function (cookieName) {
                var listData = this.$cookieStore.get(cookieName);
                return listData;
            };
            BookmarksController.prototype.showBookmarks = function () {
                this.$scope.listData = this.getBookmarks('favourites');
            };
            BookmarksController.prototype.removeElement = function (selectedObj) {
                var index = this.$scope.listData.map(function (obj, index) {
                    if (obj.slug == selectedObj.slug) {
                        return index;
                    }
                }).filter(isFinite)[0];
                this.$scope.listData.splice(index, 1);
            };
            BookmarksController.prototype.removeBookmarks = function (object, cookieName) {
                var bookmark = this.getBookmarks(cookieName);
                this.removeElement(object);
                this.$cookieStore.put(cookieName, this.$scope.listData);
            };
            BookmarksController.prototype.removeFavourites = function (slug, title) {
                this.removeBookmarks({ "slug": slug, "title": title }, 'favourites');
            };
            BookmarksController.$inject = ['$scope', '$cookieStore'];
            return BookmarksController;
        })();
        angular.module('devArt').controller('BookmarksController', BookmarksController);
    })(bookmark = devArt.bookmark || (devArt.bookmark = {}));
})(devArt || (devArt = {}));
//# sourceMappingURL=bookmark.controller.js.map