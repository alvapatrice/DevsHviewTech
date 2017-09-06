module devArt.comments {
    'use strict';

    interface IComment {
        id: number;
        body: string;
        likes: number;
        thread_id: number;
        user_id: number;
        created_at: string;
        updated_at: string;
    }
    interface ICommentAttributes extends ng.IAttributes {
        replyId : string;
    }

    interface IEditCommentDirectiveController  {
        editPost(id : string) : ng.IHttpPromise<IComment>
    }

    class EditCommentDirectiveController implements IEditCommentDirectiveController {

        static $inject = ['$http'];

        constructor(private $http : ng.IHttpService){}

        editPost(id) {
            var promise =  this.$http.get('api/comment/' + id + '/edit');
            return promise;
        }
    }

    class EditCommentDirective implements ng.IDirective {
        static instance() : ng.IDirective {
            return new EditCommentDirective;
        }

        restrict = 'A';
        controller = EditCommentDirectiveController;

        link( scope : ng.IScope, element : ng.IAugmentedJQuery, attrs : ICommentAttributes, controller : EditCommentDirectiveController) {

            element.on('click', function () {

                var $id = attrs.replyId,
                    $modal : any = $('#editCommentModal'),
                    $textareaDiv = $modal.find('.cke_editable'),
                    $commentId = $('#comment_id');

                controller.editPost($id)
                            .then(function(data) {
                                var results : IComment = <IComment>data.data;
                                $textareaDiv.html(results.body);
                                $commentId.val(results.id.toString());
                                $modal.modal();
                            });
            });
        }

    }

    angular.module('devArt').directive('editCommentDirective', EditCommentDirective.instance);
}