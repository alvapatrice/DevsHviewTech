<!-------------------------------------------- Options bar markup ------------------------------------------------------------->
<div id="topOptionsBar">
    <div class="row top-bar">
        <div class="col-xs-12 ">
            <div class="row">
                <div class="container-fluid">
                    <div class="row">
                        <div class="category-btn col-xs-4 col-sm-3 col-md-2"
                             ng-click="app.setIsCategoryShow(); app.stopProp($event)">
                            <h1 id="category_heading" category-button ng-class="{active : app.isCategoryShow}">Categories</h1>
                            @include('layouts.partials.sidebar')
                        </div>
                        <div class="hidden-xs col-sm-6 col-md-7">
                            @if(isset($breadcrumb))
                                <ul class="breadcrumb">
                                    @foreach($breadcrumb as $breadcrumbnode)
                                        <li>
                                            <a href=" {{ route('categories.single', [ $breadcrumbnode['slug'] ]) }}">{{$breadcrumbnode['title']}}</a>
                                        </li>
                                    @endforeach
                                </ul>

                            @endif
                            @if(Route::getCurrentRoute()->getPath() == '/')
                                    <div class="hero-container row">
                                        <div class="col-md-3 col-xs-2 no-padding">
                                            <h2 class="category-heading"><a href="{{ route('categories.single', [ 'laravel5' ]) }}"><span >Laravel</span></a></h2>
                                        </div>
                                        <div class="col-md-3 col-xs-2 no-padding">
                                            <h2 class="category-heading"><a href="{{ route('categories.single', [ 'angular' ]) }}"><span >Angular</span></a></h2>
                                        </div>
                                        <div class="col-md-3 col-xs-2 no-padding">
                                            <h2 class="category-heading"><a href="{{ route('categories.single', ['reactjs']) }}"><span>React</span></a></h2>
                                        </div>
                                        <div class="col-md-3 col-xs-2 no-padding">
                                            <h2 class="category-heading"><a href="{{ route('categories.list') }}"><span>Explore All</span></a></h2>
                                        </div>
                                    </div>
                            @endif
                        </div>
                        <div class="col-xs-8 col-sm-3 col-md-3">
                            <div class="row">
                                <div class="view-size-container col-xs-7 col-md-7 no-padding-left"
                                     ng-controller="ViewTypeController as view">
                                    @if( isset($viewtypes) )
                                        <div class="pull-right">
                                            @foreach( $viewtypes as $viewtype)
                                                <span class="fa fa-th-{{$viewtype}} view-type"
                                                      ng-click="view.changeView('{{$viewtype}}')"
                                                      ng-class="{active:view.isSelected('{{$viewtype}}')}"></span>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                                <div class="options-bar-options col-xs-5 col-md-5 text-center"
                                     ng-controller="BookmarksController as bookmarks">
                                    <span class="fa fa-star view-type"
                                          ng-click="bookmarks.showBookmarks(); app.setIsBookmarkShow(); app.stopProp($event)"></span>
                                    @include('layouts.partials.rightsidebar')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-------------------------------------------- Options bar markup ends ------------------------------------------------------------->
