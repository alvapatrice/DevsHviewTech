module devArt.viewtype {
    'use strict';

    export interface IViewTypeService {
        view : string;
    }
    export class ViewTypeService implements IViewTypeService {

        view : string;

        static $inject = ['$cookieStore'];

        constructor(private $cookieStore: ng.cookies.ICookieStoreService) {
            this.view =  (typeof this.$cookieStore.get('viewType') === "undefined") ? 'large' :
                this.$cookieStore.get('viewType');
        }


    }

    angular.module('devArt').service('viewTypeService', ViewTypeService);
}