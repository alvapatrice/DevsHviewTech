<div class="row">
    <nav class="navbar navbar-default navbar-fixed-top navbar-full" nav-theme-change>
        <div class="container-fluid">

            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="fa fa-bars"></span>
                </button>
                <a class="navbar-brand" href="{{ route('home') }}"><img class="img-responsive pull-left" src="{{ asset('images/logos/logo-top.png') }}" alt="devartisans logo"></h1></a>
            </div>


            <div class="collapse navbar-collapse">
                <div>
                    <ul class="nav navbar-nav navbar-right top-navigation">
                        <li><a href="">Notifications : 0</a></li>
                        <li class="active"><a href="{{ route('home') }}" target="_blank">Preview Site</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#">Settings</a></li>
                                <li><a href="#">Edit Profile</a></li>
                                <li class="divider"></li>
                                <li><a href="{{ route('user.logout') }}">Logout</a></li>
                            </ul>
                        </li>
                        <li class="mlr-15">
                            <div class="pull-right hidden-xs">
                                <div class="pin" id="pin">
                                    <span class="fa fa-thumb-tack" navbar-display-state state="toggleDisplayState()"></span>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div><!--/.nav-collapse -->

        </div>
    </nav>
</div>
