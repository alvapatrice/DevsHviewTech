module devArt.helpers {
    'use strict';

    class BodyImageDirective implements ng.IDirective {
        static instance() : ng.IDirective {
            return new BodyImageDirective;
        }
        restrict = 'A';

        link(scope : ng.IScope, element : ng.IAugmentedJQuery, attrs : ng.IAttributes) {
            console.log('hello');
            var hidable_image = element.find('.hidable_image'),
                btnObj = {
                    'class' : 'btn btn-default image_demo_toggle',
                    'text' : 'Toggle Image'
                },
                btn = $('<button></button>', btnObj);

            btn.insertBefore(hidable_image);

            btn.on('click', function() {
                $('.hidable_image').toggle();
            });

            element.find('p > img').each( function(index, val) {
                    var ancher = $('<a></a>', {
                        'href' : $(val).attr('src'),
                        'data-lighter': ''
                    });
                    $(val).wrap(ancher);
            });
        }
    }


    angular.module('devArt').directive('bodyImageDirective', BodyImageDirective.instance);
}
