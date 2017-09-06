<!-------------------------------------------- Top Navigation Bar Markup ------------------------------------------------------------->
<nav class="navbar navbar-default navbar-fixed-top navbar-full" navbar-hover nav-theme-change>
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="fa fa-bars"></span>
            </button>
            <a class="navbar-brand" href="{{ route('home') }}">
                <img class="img-responsive pull-left" src="{{ asset('images/logos/logo-top.png') }}"
                     alt="devartisans">
            </a>
        </div>
        <div class="collapse navbar-collapse">
            <div class="top-nav-serach" ng-controller="SearchController as searchCtrl">
                <form class="navbar-form navbar-left" role="search">
                    <div class="input-group table-cell searchInputContainer">
                        <input type="search" autocomplete="off" results="0" ng-keyDown="keyPressed($event)" class="form-control search-expanded"
                               placeholder="Search Articles" id="searchInputBox" ng-model="searchInput">
                                <span class="input-group-btn">
                                    <button class="btn" id="topSearchBtn" type="button" ng-click="nevigateToArticle()"><span class="fa fa-search"></span></button>
                                </span>
                    </div>
                    <!-- /input-group -->
                    <div class="searchResults card-shadow ng-cloak" ng-if="searchCtrl.showResultsFunc()" search-directive="results" search-term="searchInput">
                        <ul class="list-unstyled">
                            <li ng-repeat="data in results">
                                <a href="/articles/[[data.slug]]" ng-class="{ active : data.title == selectedElement }" ng-bind="data.title"></a>
                            </li>
                        </ul>
                    </div>
                </form>
                <ul class="nav navbar-nav navbar-right top-navigation">
                    <li class="@if(if_route(['home', 'articles.list']) ||  if_route(['articles.single'], 'highlight')) active @endif"><a href="{{ route('home') }}">Articles</a>
                    </li>
                    <li class="@if(if_route(['categories.list'])) active  @endif"><a
                            href="{{ route('categories.list') }}">Categories</a></li>
                    <li class="@if(if_route(['threads.list', 'threads.single.show', 'threads.list.single', 'threads.new.create'])) active  @endif"><a href="{{ route('threads.list') }}">Forum</a>
                    </li>
                    {{--<li><a href="{{ route('portfolio') }}">Portfolio</a></li>--}}
                    @if ( Auth::check() )
                        <li class="dropdown hidden-xs">
                            <a class="dropdown-toggle" data-toggle="dropdown" role="button"
                               aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li> <a href="{{ route('admin.home') }}"><span class="fa fa-user padding-right-5"></span> Admin</a></li>
                                <li class="divider"></li>
                                {{--<li><a href="#">Settings</a></li>--}}
                                {{--<li><a href="#">Edit Profile</a></li>--}}
                                <li><a class="highlight-dark" ng-click="changeTheme('darkGray')">Dark</a></li>
                                <li><a class="highlight-blue" ng-click="changeTheme('blue')">Blue</a></li>
                                <li><a class="highlight-darkblue" ng-click="changeTheme('darkBlue')">Dark Blue</a></li>
                                <li><a class="highlight-yellow" ng-click="changeTheme('yellow')">Yellow</a></li>
                                <li class="divider"></li>
                                <li><a href="{{ route('user.logout') }}">Logout</a></li>
                            </ul>
                        </li>
                    @else
                        <li class="@if(if_route(['user.login'])) active @endif"><a href="{{ route('user.login') }}">
                                Login</a></li>
                        <li class="dropdown hidden-xs">
                            <a class="dropdown-toggle" data-toggle="dropdown" role="button"
                               aria-expanded="false"><i class="fa fa-adjust"></i></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a class="highlight-dark" ng-click="changeTheme('darkGray')">Default</a></li>
                                <li><a class="highlight-blue" ng-click="changeTheme('blue')">Blue</a></li>
                                <li><a class="highlight-darkblue" ng-click="changeTheme('darkBlue')">Dark Blue</a></li>
                                <li><a class="highlight-yellow" ng-click="changeTheme('yellow')">Yellow</a></li>
                            </ul>
                        </li>
                    @endif

                    <li>
                        <div class="pin" id="pin">
                            <span class="fa fa-thumb-tack active" navbar-display-state state="toggleDisplayState()"></span>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <!--/.nav-collapse -->
    </div>
</nav>
<!-------------------------------------------- Top Navigation Bar Markup ends ------------------------------------------------------------->
