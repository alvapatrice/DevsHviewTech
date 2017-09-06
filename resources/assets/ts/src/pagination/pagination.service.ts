module devArt.pagination {
    'use strict';

    export interface IPaginationService {
        getPaginationResults(href : string) : ng.IPromise<any>;
    }
    export class PaginationService implements IPaginationService {

        static $inject = ['$http'];

        $http : ng.IHttpService;

        constructor($http : ng.IHttpService) {
            this.$http = $http;
        }

        getPaginationResults( href : string ) : ng.IPromise<any> {

            return this.$http
                        .get(href)
                        .then((response : ng.IHttpPromiseCallbackArg<any>) : any => {
                            return response.data;
                        });
        }

    }

    angular.module('devArt').service('paginationService', PaginationService);
}
