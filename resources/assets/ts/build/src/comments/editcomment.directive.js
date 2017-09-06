var devArt;
(function (devArt) {
    var comments;
    (function (comments) {
        'use strict';
        var EditCommentDirectiveController = (function () {
            function EditCommentDirectiveController($http) {
                this.$http = $http;
            }
            EditCommentDirectiveController.prototype.editPost = function (id) {
                var promise = this.$http.get('api/comment/' + id + '/edit');
                return promise;
            };
            EditCommentDirectiveController.$inject = ['$http'];
            return EditCommentDirectiveController;
        })();
        var EditCommentDirective = (function () {
            function EditCommentDirective() {
                this.restrict = 'A';
                this.controller = EditCommentDirectiveController;
            }
            EditCommentDirective.instance = function () {
                return new EditCommentDirective;
            };
            EditCommentDirective.prototype.link = function (scope, element, attrs, controller) {
                element.on('click', function () {
                    var $id = attrs.replyId, $modal = $('#editCommentModal'), $textareaDiv = $modal.find('.cke_editable'), $commentId = $('#comment_id');
                    controller.editPost($id)
                        .then(function (data) {
                        var results = data.data;
                        $textareaDiv.html(results.body);
                        $commentId.val(results.id.toString());
                        $modal.modal();
                    });
                });
            };
            return EditCommentDirective;
        })();
        angular.module('devArt').directive('editCommentDirective', EditCommentDirective.instance);
    })(comments = devArt.comments || (devArt.comments = {}));
})(devArt || (devArt = {}));
//# sourceMappingURL=editcomment.directive.js.map