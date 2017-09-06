var devArt;
(function (devArt) {
    var bookmark;
    (function (bookmark_1) {
        'use strict';
        var SetBookmarksController = (function () {
            function SetBookmarksController($cookieStore) {
                this.$cookieStore = $cookieStore;
            }
            SetBookmarksController.prototype.getCookie = function (cookieName) {
                if (typeof this.$cookieStore.get(cookieName) === "undefined") {
                    this.$cookieStore.put(cookieName, []);
                }
                return this.$cookieStore.get(cookieName);
            };
            SetBookmarksController.prototype.getIndexOfObj = function (slug, bookmark) {
                for (var i = 0, len = bookmark.length; i < len; i++) {
                    if (bookmark[i].slug === slug) {
                        return i;
                    }
                }
                return -1;
            };
            SetBookmarksController.prototype.setBookmarks = function (obj, cookieName) {
                var bookmark = this.getCookie(cookieName);
                var index = this.getIndexOfObj(obj.slug, bookmark);
                var indexExist;
                if (index >= 0) {
                    bookmark.splice(index, 1);
                    indexExist = false;
                }
                else {
                    bookmark.push(obj);
                    indexExist = true;
                }
                this.$cookieStore.put(cookieName, bookmark);
                return indexExist;
            };
            SetBookmarksController.prototype.isBookmarked = function (slug) {
                var bookmark = this.getCookie('favourites');
                var index = this.getIndexOfObj(slug, bookmark);
                if (index >= 0) {
                    return true;
                }
                return false;
            };
            SetBookmarksController.prototype.setFavourites = function (slug, title) {
                this.setBookmarks({ "slug": slug, "title": title }, 'favourites');
            };
            SetBookmarksController.$inject = ['$cookieStore'];
            return SetBookmarksController;
        })();
        angular.module('devArt').controller('SetBookmarksController', SetBookmarksController);
    })(bookmark = devArt.bookmark || (devArt.bookmark = {}));
})(devArt || (devArt = {}));
//# sourceMappingURL=setbookmarks.controller.js.map