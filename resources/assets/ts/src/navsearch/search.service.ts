module devArt.navsearch  {
    'use strict';

    export interface ISearchService {
        results : Array<any>;
        selectedElement : Array<any>;
    }

    export class SearchService implements ISearchService {
        results:Array<any>;
        selectedElement:Array<any>;

        constructor() {
            this.results = [];
            this.selectedElement = [];
        }

    }

    angular.module('devArt').service('searchService', SearchService);
}