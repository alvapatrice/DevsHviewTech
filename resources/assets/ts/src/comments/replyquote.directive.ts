module devArt.comments {
    'use strict';

    class ReplyQuoteDirective implements ng.IDirective {
        static instance() : ng.IDirective {
            return new ReplyQuoteDirective;
        }

        restrict = 'A';

        link(scope : ng.IScope, element : ng.IAugmentedJQuery, attrs : ng.IAttributes) {

            var $commentDiv : JQuery        =       element.closest('.reply'),
                $textareaDiv : JQuery       =       $('.reply-box').find('.cke_editable'),
                $username : string          =       $commentDiv.find('.user-name').text(),
                $answer : any               =       $commentDiv.find('.reply-body').html(),
                $html : JQuery,
                $body : JQuery = $('body');

            element.on('click', function (e) {
                e.preventDefault();

                $textareaDiv = $('.reply-box').find('.cke_editable');

                $html = $('<blockquote></blockquote>', {
                    'class': 'quoted-reply',
                    'html': '<span class="quoted-user">' + $username + ' said, </span>' + $answer
                });

                $body.animate({scrollTop: $(document).height() - 1000}, 1000);
                $textareaDiv.prepend($html).focus();
            })
        }
    }

    angular.module('devArt').directive('replyQuoteDirective', ReplyQuoteDirective.instance);
}