var devArt;
(function (devArt) {
    var comments;
    (function (comments) {
        'use strict';
        var ReplyQuoteDirective = (function () {
            function ReplyQuoteDirective() {
                this.restrict = 'A';
            }
            ReplyQuoteDirective.instance = function () {
                return new ReplyQuoteDirective;
            };
            ReplyQuoteDirective.prototype.link = function (scope, element, attrs) {
                var $commentDiv = element.closest('.reply'), $textareaDiv = $('.reply-box').find('.cke_editable'), $username = $commentDiv.find('.user-name').text(), $answer = $commentDiv.find('.reply-body').html(), $html, $body = $('body');
                element.on('click', function (e) {
                    e.preventDefault();
                    $textareaDiv = $('.reply-box').find('.cke_editable');
                    $html = $('<blockquote></blockquote>', {
                        'class': 'quoted-reply',
                        'html': '<span class="quoted-user">' + $username + ' said, </span>' + $answer
                    });
                    $body.animate({ scrollTop: $(document).height() - 1000 }, 1000);
                    $textareaDiv.prepend($html).focus();
                });
            };
            return ReplyQuoteDirective;
        })();
        angular.module('devArt').directive('replyQuoteDirective', ReplyQuoteDirective.instance);
    })(comments = devArt.comments || (devArt.comments = {}));
})(devArt || (devArt = {}));
//# sourceMappingURL=replyquote.directive.js.map