module devArt.social {
    'use strict';

    interface ISocialScope extends ng.IScope {
        url : string;
        socialIcon : string;
        className : string;
        text : string;
    }

    interface ISocialAttrs extends  ng.IAttributes {
        siteUrl : string;
        icon : string;
        socialSite : string;
        linkText : string;
    }
    class SocialButton implements ng.IDirective {
        static instance() : ng.IDirective {
            return new SocialButton;
        }

        restrict = 'AE';
        scope = true;
        transclude = true;
        template = '<a class="btn btn-[[ className ]]" href="[[url]]" ><i class="[[ socialIcon ]]"></i> <span class="hidden-xs">[[ text ]]</span>  </a>';
        link( scope : ISocialScope, element : ng.IAugmentedJQuery, attrs : ISocialAttrs) : void {
            scope.url = attrs.siteUrl;
            scope.socialIcon = attrs.icon;
            scope.className = attrs.socialSite;
            scope.text = attrs.linkText;
        }

    }

    angular.module('devArt').directive('socialButton', SocialButton.instance);
}
