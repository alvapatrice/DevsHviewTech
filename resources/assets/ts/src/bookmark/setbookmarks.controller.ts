module devArt.bookmark {
    'use strict';

    interface ISetBookmarksController {
        getCookie(cookieName : string) : Array<any>;
        getIndexOfObj(slug : string , bookmark : Array<any>) : number;
        setBookmarks(obj : IBookmarkObject, cookieName : string) : boolean;
        isBookmarked(slug : string) : boolean;
        setFavourites(slug : string, title : string) : void;

    }

    class SetBookmarksController implements ISetBookmarksController {
        static $inject = ['$cookieStore'];

        private $cookieStore : ng.cookies.ICookieStoreService;

        constructor($cookieStore : ng.cookies.ICookieStoreService) {
            this.$cookieStore = $cookieStore;
        }

        getCookie(cookieName:string):Array<any> {

            if (typeof this.$cookieStore.get(cookieName) === "undefined") {
                this.$cookieStore.put(cookieName, []);
            }

            return this.$cookieStore.get(cookieName);
        }

        getIndexOfObj(slug:string, bookmark:Array<any>):number {
            for (var i = 0, len = bookmark.length; i < len; i++) {
                if (bookmark[i].slug === slug) {
                    return i;
                }
            }
            return -1;
        }

        setBookmarks(obj:devArt.bookmark.IBookmarkObject, cookieName:string):boolean {
            var bookmark = this.getCookie(cookieName);
            var index : number = this.getIndexOfObj(obj.slug, bookmark);

            var indexExist : boolean;

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
        }

        isBookmarked(slug:string):boolean {
            var bookmark = this.getCookie('favourites');
            var index: number = this.getIndexOfObj(slug, bookmark);
            if (index >= 0) {
                return true;
            }
            return false;
        }

        setFavourites(slug:string, title:string):void {
            this.setBookmarks({"slug": slug, "title": title}, 'favourites');
        }

    }

    angular.module('devArt').controller('SetBookmarksController', SetBookmarksController);
}