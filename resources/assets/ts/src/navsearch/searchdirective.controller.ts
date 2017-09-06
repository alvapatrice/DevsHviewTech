module devArt.navsearch {
    'use strict';

    export interface ISearchDirectiveController {
        getSearchResults(newVal : string) : ng.IPromise<any>;
    }

    export class SearchDirectiveController implements ISearchDirectiveController {
        static $inject = ['$http', 'searchService'];

        constructor(private $http : ng.IHttpService, private searchService : ISearchService) {
        }

        getSearchResults(newVal : string) : ng.IPromise<any> {
            var promise =  this.$http.get('/api/search/' + newVal);

            promise.success( (data : Array<any>) : void => {
                this.searchService.results = data;
            });

            return promise;
        }

    }
}
