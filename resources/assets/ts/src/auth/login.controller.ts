angular.module('devArt').controller('LoginController', ['$http', function($http) {
    var self = this;
    self.credentials = {};
    self.credentials.email = '';
    self.credentials.password = '';
    self.message = '';
    self.postAsGuest = function() {
        var form = $('#replyForm');
        $('<input />', {
            'type' : 'hidden',
            'name' : 'posttype',
            'value' : 'guest'
        }).appendTo(form);
        form.submit();
    }
    self.loginUser = function(event) {
        event.preventDefault();

        var promise = $http({
            method: 'POST',
            url: '/api/login',
            data: $.param( self.credentials )
        });

        promise.success(function (data, status, header, config) {
            if(data == "true")
            {
                $('#replyForm').submit();
            }
            else
            {
                self.message="Please enter the right credentials";
            }
        });
    }

}]);
