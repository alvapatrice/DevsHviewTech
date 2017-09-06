angular.module('devArt').controller('LikeController', ['$http', '$cookieStore', function ($http, $cookieStore) {
        var self = this;
        var className = '';
        this.likeComment = function (comment_id) {
            var comment = {
                'id': comment_id
            };
            var promise = $http({
                method: 'POST',
                url: 'api/comment/like',
                data: $.param(comment)
            });
            promise.success(function (data, status, header, config) {
                self.likes = data;
                self.className = 'liked';
            });
        };
    }]);
//# sourceMappingURL=like.controller.js.map