module devArt.subscription {
    'use strict';

    interface ISubscriberScope extends ng.IScope {
        formData : any;
        subscriptionStatus : string;
        showStatus : boolean;
        subscribeUser(event : ng.IAngularEvent) :void;
    }


    class SubscriptionController {
        static $inject = ['$scope', '$http', '$timeout'];

        private $scope : ISubscriberScope;
        private $http : ng.IHttpService;
        private $timeout : ng.ITimeoutService;


        constructor($scope : ISubscriberScope, $http : ng.IHttpService, $timeout : ng.ITimeoutService) {
            var vm = this;
            vm.$http = $http;
            vm.$timeout = $timeout;
            vm.$scope = $scope;
            vm.$scope.subscribeUser = function(event) {
                event.preventDefault();
                return vm.subscribeUser(vm);
            }
        }

        subscribeUser(vm) {
            event.preventDefault();
            vm.$scope.showStatus = true;
            console.log(vm.$scope.formData);

            var promise : ng.IHttpPromise<string> = vm.$http({
                method: 'POST',
                url: '/subscribe',
                data: $.param( vm.$scope.formData )
            });

            promise.success(function (data : string, status, header, config) {
                if( data == "true") {
                    vm.$scope.subscriptionStatus = "All good! Thanks for joining our mailing list, check your email.";
                } else {
                    vm.$scope.subscriptionStatus = "Opps! Sorry for inconvenience, some problem occured.";
                }
                vm.$timeout(function() {
                    vm.$scope.subscriptionStatus = false;
                    vm.$scope.showStatus = false;
                }, 4000);
            });


        }

    }

    angular.module('devArt').controller('SubscriptionController', SubscriptionController);
}
