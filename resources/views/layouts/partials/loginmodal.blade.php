<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="devartisans login"
     aria-hidden="true">
    <div class="modal-dialog modal-sm" ng-controller="LoginController as loginctrl">
        <div class="modal-content">

            <div class="modal-heading padding-left-20 padding-top-10 padding-bottom-10 graybg">
                <h4>Login</h4>
            </div>
            <div class="modal-body clearfix">
                <!-- Form for Save Edited Comment -->
                {!! Form::open([ 'route' => [ 'login.ajax.api'], 'class' => '', 'ng-submit' => 'loginctrl.loginUser($event)' ]) !!}
                <div class="logincarea">
                    <div class="form-group">
                        {!! Form::label('email', 'Email:') !!}
                        {!! Form::email('email', null, [ 'class' => 'form-control', 'placeholder' => 'jhon@doe.com', 'ng-model' => 'loginctrl.credentials.email']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('password', 'Password:') !!}
                        {!! Form::password('password', [ 'class' => 'form-control', 'placeholder' => 'password', 'ng-model' => 'loginctrl.credentials.password']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::submit('Login and Post',[ 'class' => 'btn btn-success btn-sm btn-block']) !!}
                    </div>
                </div>
                <div ng-if="loginctrl.message" class="alert-danger">
                    <p ng-bind="loginctrl.message" class="margin-left-10 padding-bottom-5"></p>
                </div>
                {!! Form::close() !!}
 
                <div class="divider"><span>Or</span></div>
 
                <div class="socialLoginProviders clearfix">
                    <a href="{{ route('social.login', ['github']) }}" class="btn btn-github btn-block margin-bottom-5 btn-icon-left"><i class="fa fa-github"></i> Login with Github</a>
                    <a href="{{ route('social.login', ['facebook']) }}" class="btn btn-facebook btn-block margin-bottom-5 btn-icon-left"><i class="fa fa-facebook"></i> Login with facebook</a>
                    <a href="{{ route('social.login', ['google']) }}" class="btn btn-google-plus btn-block margin-bottom-5 btn-icon-left"><i class="fa fa-google-plus"></i> Login with google</a>
                </div>
 
                {{--<div class="divider"><span>Or</span></div>--}}
                {{--<div>--}}
                    {{--<button class="btn btn-danger btn-block" ng-click="loginctrl.postAsGuest()">Post as guest</button>--}}
                {{--</div>--}}
                
            </div>
        </div>
    </div>
</div>