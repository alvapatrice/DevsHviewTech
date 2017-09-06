(function() {
    var devArt = angular.module('devArt');
    devArt.requires[devArt.requires.length] = 'ngCkeditor';
    devArt.controller('ckEditorController', ['$scope', function($scope) {
        $scope.ckeditorModel = document.getElementById('body').value;
        $scope.editorOptions = {
            language: 'html',
            toolbar : 'Full'
        };
        $scope.editorOptionsLight = {
            language: 'html',
            toolbar  : 'Forum'
        };
    }]);


    devArt.controller('ckEditorReplyController', ['$scope', function($scope) {
        $scope.ckeditorModel = document.getElementById('editedComment').value;
       $scope.editorOptionsLight = {
            language: 'html',
            toolbar  : 'Forum'
        };
    }]);
})();
