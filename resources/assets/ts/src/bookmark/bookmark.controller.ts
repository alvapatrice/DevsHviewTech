module devArt.bookmark {
    'use strict';

    export interface IBookmarkObject {
        slug : string;
        title : string;

    }

    interface IBookmarksScope extends ng.IScope {
        listData : Array<any>;
    }


    interface IBookmarksController {
        getBookmarks(cookieName : string) : Array<any>;
        showBookmarks() : void;
        removeElement(selectedObj : IBookmarkObject) : void;
        removeBookmarks(object :IBookmarkObject, cookieName : string )  : void;
        removeFavourites(slug : string, title : string) : void;

    }

    class BookmarksController implements IBookmarksController{

        static $inject = ['$scope', '$cookieStore'];

        private $cookieStore : ng.cookies.ICookieStoreService;
        private $scope : IBookmarksScope;

        constructor($scope: IBookmarksScope, $cookieStore: ng.cookies.ICookieStoreService) {
            this.$scope = $scope;
            this.$cookieStore = $cookieStore;
            this.$scope.listData = [];
        }

        getBookmarks(cookieName:string):Array<string> {
            var listData = this.$cookieStore.get(cookieName);
            return listData;
        }

        showBookmarks():void {
            this.$scope.listData = this.getBookmarks('favourites');
        }

        removeElement(selectedObj:IBookmarkObject):void {
            var index = this.$scope.listData.map(function(obj: IBookmarkObject, index) {
                    if(obj.slug == selectedObj.slug)
                    {
                        return index;
                    }
                }).filter(isFinite)[0];
                this.$scope.listData.splice(index, 1);
        }

        removeBookmarks(object:IBookmarkObject, cookieName:string):void {
            var bookmark = this.getBookmarks(cookieName);
                this.removeElement(object);
                this.$cookieStore.put(cookieName, this.$scope.listData);
        }

        removeFavourites(slug:string, title:string):void {
            this.removeBookmarks(<IBookmarkObject>{"slug": slug, "title": title}, 'favourites');
        }
    }

    angular.module('devArt').controller('BookmarksController', BookmarksController);

}
