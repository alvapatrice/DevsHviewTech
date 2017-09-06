module devArt.viewtype {
    interface IViewTypeController {
        changeView(setView:string) : void;
        isSelected(checkView:string) : boolean;
    }

    class ViewTypeController implements IViewTypeController {

        static $inject = ['$scope', 'viewTypeService', '$cookieStore'];
        constructor(private $scope:IViewTypeController, private viewTypeService: IViewTypeService,  private $cookieStore:ng.cookies.ICookieStoreService) {
            this.viewTypeService = viewTypeService;
        }

        changeView(setView:string):void {

            this.viewTypeService.view = setView;
            this.$cookieStore.put('viewType', setView);

        }

        isSelected(checkView:string):boolean {

            return this.viewTypeService.view === checkView;

        }

    }
    angular.module('devArt').controller('ViewTypeController', ViewTypeController);
}