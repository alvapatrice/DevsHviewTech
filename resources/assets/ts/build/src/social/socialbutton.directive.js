var devArt;
(function (devArt) {
    var social;
    (function (social) {
        'use strict';
        var SocialButton = (function () {
            function SocialButton() {
                this.restrict = 'AE';
                this.scope = true;
                this.transclude = true;
                this.template = '<a class="btn btn-[[ className ]]" href="[[url]]" ><i class="[[ socialIcon ]]"></i> <span class="hidden-xs">[[ text ]]</span>  </a>';
            }
            SocialButton.instance = function () {
                return new SocialButton;
            };
            SocialButton.prototype.link = function (scope, element, attrs) {
                scope.url = attrs.siteUrl;
                scope.socialIcon = attrs.icon;
                scope.className = attrs.socialSite;
                scope.text = attrs.linkText;
            };
            return SocialButton;
        })();
        angular.module('devArt').directive('socialButton', SocialButton.instance);
    })(social = devArt.social || (devArt.social = {}));
})(devArt || (devArt = {}));
//# sourceMappingURL=socialbutton.directive.js.map