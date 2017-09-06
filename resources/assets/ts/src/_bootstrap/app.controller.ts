module devArt {
    'use strict';

    interface IAppController {
        setIsBookmarkShow() : void;
        setIsCategoryShow() : void;
        hideSidebar() : void;
        stopProp($event : ng.IAngularEvent) : void;


    }

    class AppController implements IAppController{

        private isBookmarkShow : boolean;
        private isCategoryShow : boolean;

        constructor() {
            this.isBookmarkShow = false;
            this.isCategoryShow = false;
        }

        setIsBookmarkShow():void {
            this.isBookmarkShow = !this.isBookmarkShow;
        }

        setIsCategoryShow():void {
            this.isCategoryShow = !this.isCategoryShow;
        }

        hideSidebar():void {
            this.isBookmarkShow = false;
            this.isCategoryShow = false;
        }

        stopProp($event: ng.IAngularEvent):void {
            $event.stopPropagation();
        }
    }

    angular.module('devArt').controller('AppController', AppController);

}