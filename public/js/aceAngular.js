angular.module('devArt').requires[angular.module('devArt').requires.length] = 'ui.ace';

var aceEditorValue = '';

angular.module('devArt').controller('syntaxHighlightController', ['$scope', '$log', '$http', '$timeout', function($scope, $log, $http, $timeout) {
    function setEditorConfig(_editor) {
        var lang = '';
        if(typeof $scope.classNames[1] !== "undefined") {
            lang = $scope.classNames[0].substr($scope.classNames[0].indexOf('-')+ 1, $scope.classNames[0].length);
        }
        lang = (lang === '') ? 'html' : lang;
        _editor.getSession().setMode("ace/mode/"+lang);

        //both options works
        //_editor.setOptions({maxLines: Infinity});
        _editor.renderer.setOptions({maxLines: Infinity, printMargin : false});
        //_editor.renderer.setScrollMargin(20);
        _editor.setHighlightActiveLine(false);
        //_editor.setPrintMarginColumn(3);
        //_editor.renderer.setPadding(20);
        _editor.setReadOnly('true');

        _editor.getSession().setUseWrapMode(true);
        //_editor.getSession().setWrapLimitRange();
    }

    $scope.aceChanged = function(_editor) {
        // // console.log($('#langtype').val());
        //  _editor[1].getSession().setMode("ace/mode/"+$('#langtype').val());
    };

    $scope.aceLoaded = function(_editor) {
        // waiting for digest loop to run and set className varrialbe in scope
        $timeout(function(){
            setEditorConfig(_editor);
        }, 10 );
    };
}]);

//directive to convert pre tag to ace ui
angular.module('devArt').directive('pre', function() {

    return {
        templateUrl : '/js/directives/syntaxHighliter.html',
        replace : true ,
        scope : {
            langType : '@'
        },
        transclude : true,
        link: function(scope, element, attrs, ctrl,  transclude) {
            transclude(scope, function(clone) {
                scope.classNames = clone.attr('class').split(' ');
            });
            scope.name = 'satish';
        },
        controller : 'syntaxHighlightController'
    };

});

angular.module('devArt').filter('removeLangPrefix', function () {
    return function (text) {
        text = text.replace('language-', '');
        if(text == 'bash')
        {
            text = 'terminal'
        }
        if(text == 'ng-scope')
        {
            text = '';
        }
        return text;
    };
});
