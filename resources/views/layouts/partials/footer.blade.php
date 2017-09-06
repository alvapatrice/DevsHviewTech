<div class="row site-footer" id="footer">
    @include('layouts.partials.subscription-form')
    <div class="container">
        <div class="row">
            <div class="col-xs-4">
                <h3>Quick links</h3>
                <ul class="list-unstyled footer-navigation-list">
                    <li><a href="{{ route('threads.list') }}">Forum</a></li>
                    <li><a href="{{ route('contact') }}">Contact us</a></li>
                    <li><a href="{{ route('about') }}">About us</a></li>
                    <li><a href="{{ route('privacy') }}">Privacy Policy</a></li>
                </ul>
            </div>
            <div class="col-xs-4">
                <h3>Share</h3>
                <ul class="list-unstyled footer-navigation-list">
                    <li><a href="{{ getenv('FACEBOOK_PAGE_URL') }}"><span class="fa fa-facebook-official"></span> Facebook</a></li>
                    <li><a href="{{ getenv('TWITTER_PAGE_URL') }}"><span class="fa fa-twitter"></span> Twitter</a></li>
                    <li><a href="{{ getenv('GOOGLEPLUS_PAGE_URL')}}"><span class="fa fa-google-plus"></span> Google</a></li>
                </ul>
            </div>
            <div class="col-xs-4">
                <h3>Other Links</h3>
                <ul class="list-unstyled footer-navigation-list">
                    <li><a href="http://laravel.com/">Laravel</a></li>
                    <li><a href="https://angularjs.org/">AngularJS</a></li>
                </ul>
            </div>
        </div>
        <div class="row text-center">
            <p class="padding-top-20">Copyright &copy; 2017 HviewTech Ltd.</p>
        </div>
    </div>
</div>
{{--<div class="modal fade" id="subscription_modal" tabindex="-1" role="dialog" aria-labelledby="Subscription Modal" aria-hidden="true">--}}
    {{--<div class="modal-dialog modal-lg">--}}
        {{--<div class="modal-content">--}}
            {{--<p>This is subscription Modal</p>--}}
        {{--</div>--}}
    {{--</div>--}}
{{--</div>--}}

