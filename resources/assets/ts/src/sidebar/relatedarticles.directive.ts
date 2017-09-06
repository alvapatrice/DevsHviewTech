module devArt.sidebar {
    'use strict';

    class RelatedArticlesDirective implements ng.IDirective {
        static instance() : ng.IDirective {
            return new RelatedArticlesDirective;
        }

        restrict = 'A';

        link( scope : ng.IScope, element : ng.IAugmentedJQuery, attr : ng.IAttributes) : void {

            var rightCategoryArticlesContainer = $('.category_content'),
                rightCategoryArticlesList = rightCategoryArticlesContainer.find('ul'),
                articlesSidebarTopPos : number,
                heightToStick : number,
                showArticlesSidebarList : boolean,
                positionFixed : boolean,
                scrollTop : number = $(document).scrollTop();


            $(document).on('scroll', function () {
                    scrollTop = $(document).scrollTop();
                    heightToStick = element.offset().top - (rightCategoryArticlesList.height() + 85);
                    articlesSidebarTopPos = rightCategoryArticlesContainer.offset().top;

                    //console.log('scroll top: ' + scrollTop + ' and height to stick: ' + heightToStick);
                    //console.log('scroll top: ' + scrollTop +' and article sidebar top position: ' + articlesSidebarTopPos);

                    if (scrollTop > heightToStick){
                        if( positionFixed != true) {
                            rightCategoryArticlesList.addClass('fix_ul');
                            rightCategoryArticlesList.css('top', (heightToStick -articlesSidebarTopPos + 85)+'px');
                            positionFixed = true;
                        }
                    }
                    else {
                        if(positionFixed != false) {
                            rightCategoryArticlesList.removeClass('fix_ul');
                            rightCategoryArticlesList.css('top', '75px');
                            positionFixed = false;
                        }
                    }

                    if( scrollTop > articlesSidebarTopPos ) {
                        if(showArticlesSidebarList != true) {
                            rightCategoryArticlesList.addClass('show_right_ul');
                            showArticlesSidebarList = true;
                        }
                    } else {
                        if(showArticlesSidebarList != false) {
                            rightCategoryArticlesList.removeClass('show_right_ul');
                            showArticlesSidebarList = false;
                        }
                    }
            });
        }
    }

    angular.module('devArt').directive('relatedArticlesDirective', RelatedArticlesDirective.instance);
}