@extends('layouts.app')
@section('navbar')
	@include('layouts.partials.navbar')
@stop
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
            <div class="text-center padd-tb-15">
                <a href="{{ route('home')}}" title="go back to devartisans home page">
                    <img src="{{asset('images/logos/devart-logo-tiny.png')}}" alt="Devartisans.com Logo"/>
                </a>
            </div>
			<div class="panel panel-default">
				<div class="panel-heading">Login to Devartisans</div>
				<div class="panel-body">
					<div class="col-md-8">
						<h2 class="text-center margin-bottom-20">Login</h2>
						<form class="form-horizontal" role="form" method="POST" action="/auth/login">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">

							<div class="form-group margin-bottom-15">
								<label class="col-md-4 control-label">E-Mail Address</label>
								<div class="col-md-6">
									<input type="email" class="form-control" name="email" value="{{ old('email') }}">
								</div>
							</div>

							<div class="form-group margin-bottom-15">
								<label class="col-md-4 control-label">Password</label>
								<div class="col-md-6">
									<input type="password" class="form-control" name="password">
								</div>
							</div>

							<div class="form-group margin-bottom-15">
								<div class="col-md-6 col-md-offset-4">
									<div class="checkbox">
										<label>
											<input type="checkbox" name="remember"> Remember Me
										</label>
									</div>
								</div>
							</div>

							<div class="form-group margin-bottom-15">
								<div class="col-md-6 col-md-offset-4">
									<button type="submit" class="btn btn-primary btn-block margin-bottom-10" style="margin-right: 15px;">
										Login
									</button>

									<a href="/password/email">Forgot Your Password?</a>
								</div>
							</div>
						</form>
					</div>

                    <div class="col-md-4">
						<h2 class="text-center margin-bottom-20">Quick login</h2>
                        <a href="{{ route('social.login', ['github']) }}" class="btn btn-github btn-block margin-bottom-5 btn-icon-left"><i class="fa fa-github margin-right-5"></i> Login using github</a>
                        <a href="{{ route('social.login', ['facebook']) }}" class="btn btn-facebook btn-block margin-bottom-5 btn-icon-left"><i class="fa fa-facebook margin-right-5"></i> Login using facebook</a>
                        <a href="{{ route('social.login', ['google']) }}" class="btn btn-google-plus btn-block margin-bottom-5 btn-icon-left"><i class="fa fa-google-plus margin-right-5"></i> Login using google</a>
                    </div>
				</div>
                <div class="panel-footer">
                    <div class="text-center">
                        <p>Don't have account, <a href="{{ url('auth/register') }}">Signup</a> with us.</p>
                    </div>
                </div>
			</div>
		</div>
	</div>
</div>
@endsection
