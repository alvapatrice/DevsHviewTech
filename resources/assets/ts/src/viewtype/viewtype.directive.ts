module devArt.viewtype {
    'use strict';

    interface IViewDirectiveController {
        getViewType() : string;
    }
    class ViewDirectiveController implements IViewDirectiveController {

        static $inject = ['viewTypeService'];

        viewTypeService : devArt.viewtype.IViewTypeService;

        constructor(viewTypeService : devArt.viewtype.IViewTypeService) {
            this.viewTypeService = viewTypeService;
        }

        getViewType():string {
            return this.viewTypeService.view;
        }

    }

    class ViewDirective implements ng.IDirective {

        static instance() : ng.IDirective {
            return new ViewDirective;
        }

        restrict = 'AE';
        controller = ViewDirectiveController;

        link(scope : ng.IScope, element : ng.IAugmentedJQuery, attr : ng.IAttributes, controller : ViewDirectiveController) : void {
            var element : ng.IAugmentedJQuery = <ng.IAugmentedJQuery>element.find('.articleContainer'),
                article : ng.IAugmentedJQuery = <ng.IAugmentedJQuery>element.find('div.article'),
                parent : ng.IAugmentedJQuery = <ng.IAugmentedJQuery>element.closest('div.body-width');

           element.hover(function() {
                $(this).find('.article-header').addClass('dark-blue');
            }, function() {
                $(this).find('.article-header').removeClass('dark-blue')
            });

            scope.$watch(function() {
                return controller.getViewType();
            }, function(newVal : string , oldVal : string) {
                if (newVal == 'list') {
                    article.addClass('article-list').removeClass('article-grid');
                    element.addClass('col-lg-10 col-lg-offset-1').removeClass('col-lg-3');
                    parent.addClass('container').removeClass('container-fluid body-width');
                }
                else {
                    article.addClass('article-grid').removeClass('article-list');
                    element.addClass('col-lg-3').removeClass('col-lg-10 col-lg-offset-1');
                    parent.removeClass('container ').addClass('container-fluid body-width');
                }
            });
        }


    }

    angular.module('devArt').directive('viewDirective', ViewDirective.instance);

    /**
     *Without a Class
     *
     *
     *
     *
     * angular.module('devArt').directive('viewDirective', viewDirective);
     * viewDirective.$inject = ['viewTypeService'];
     *
     * function viewDirective(viewTypeService : devArt.viewtype.IViewTypeService) : ng.IDirective {
     *  var directive = <ng.IDirective> {
     *      restrict : 'AE',
     *      link : link
     *
     *  };
     *
     *  function link( scope : ng.IScope, element : ng.IAugmentedJQuery, attr : ng.IAttributes) : void {
     *      var article = element.find('div.article'),
     *          header = element.find('.article-header'),
     *          parent = element.closest('div.body-width');
     *
     *
     *      element.hover(function() {
     *          header.addClass('dark-blue');
     *      }, function() {
     *          header.removeClass('dark-blue')
     *      })
     *      scope.$watch(function() {
     *          return viewTypeService.view;
     *      }, changeViewtype);
     *
     *      function changeViewtype(newValue : string) {
     *          if (newValue == 'list') {
     *              article.addClass('article-list').removeClass('article-grid');
     *              element.addClass('col-lg-10 col-lg-offset-1').removeClass('col-lg-3');
     *              parent.addClass('container').removeClass('container-fluid body-width');
     *          }
     *          else {
     *              article.addClass('article-grid').removeClass('article-list');
     *              element.addClass('col-lg-3').removeClass('col-lg-10 col-lg-offset-1');
     *              parent.removeClass('container ').addClass('container-fluid body-width');
     *          }
     *      }
     *
     *  }
     *
     *  return directive;
     *
     **/


}