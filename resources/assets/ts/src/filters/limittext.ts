module devArt {
    'use strict';
    angular.module('devArt').filter('limitText', function () {
        return function (text) {
            if (text.length >= 35) {
                return text.substr(0, 35) + '...';
            }
            return text;
        };
    });
}
