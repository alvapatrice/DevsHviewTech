var devArt;
(function (devArt) {
    var subscription;
    (function (subscription) {
        'use strict';
        var SubscriptionController = (function () {
            function SubscriptionController($scope, $http, $timeout) {
                var vm = this;
                vm.$http = $http;
                vm.$timeout = $timeout;
                vm.$scope = $scope;
                vm.$scope.subscribeUser = function (event) {
                    event.preventDefault();
                    return vm.subscribeUser(vm);
                };
            }
            SubscriptionController.prototype.subscribeUser = function (vm) {
                event.preventDefault();
                vm.$scope.showStatus = true;
                console.log(vm.$scope.formData);
                var promise = vm.$http({
                    method: 'POST',
                    url: '/subscribe',
                    data: $.param(vm.$scope.formData)
                });
                promise.success(function (data, status, header, config) {
                    if (data == "true") {
                        vm.$scope.subscriptionStatus = "All good! Thanks for joining our mailing list, check your email.";
                    }
                    else {
                        vm.$scope.subscriptionStatus = "Opps! Sorry for inconvenience, some problem occured.";
                    }
                    vm.$timeout(function () {
                        vm.$scope.subscriptionStatus = false;
                        vm.$scope.showStatus = false;
                    }, 4000);
                });
            };
            SubscriptionController.$inject = ['$scope', '$http', '$timeout'];
            return SubscriptionController;
        })();
        angular.module('devArt').controller('SubscriptionController', SubscriptionController);
    })(subscription = devArt.subscription || (devArt.subscription = {}));
})(devArt || (devArt = {}));
//# sourceMappingURL=subscription.controller.js.map