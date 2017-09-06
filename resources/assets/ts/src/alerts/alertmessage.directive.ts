angular.module('devArt').directive('alertMessage', ['$timeout', function ($timeout) {
    return {
        link: function ($scope, element) {
            element.addClass('alert-show');
            $timeout(function () {
                element.removeClass('alert-show');
            }, 10000);
        }

    }
}]);