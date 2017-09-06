@extends('layouts.app')

@section('navbar')
    @include('layouts.partials.navbar')
@stop

@section('content')
    <div class="container">
        <div class="row">
            <h1>About Us</h1>
            <div>
                <p>Devs@HviewTech is an online Modern Web development site which provides tutorials covering software development and other web related technologies in the surrounding Backend and Frontend eco-systems.</p>

                <p>We are dedicated team of developers, designers, writers and always learning new things and as we learn, we also eagar to share with you.</p>

                <p>We love standards based technologies and we know you do too, if you want to share your knowledge with others, we are more than happy to accept new members, please
                <a href="{{ route('contact') }}">send us email</a>.</p>

                <p>Devs@HviewTech is optimized for phones and tablets, so you can use any device to connect with us.</p>
            </div>
            <div>
                <h3>We are on twitter, facebook and googleplus.</h3>
                <div class="social_media margin-top-20">
                    <social-button site-url="https://twitter.com/p_nostalgie" icon="fa fa-twitter fa-4x" social-site="twitter">Twitter</social-button>
                    <social-button site-url="https://facebook.com/nostalgie.alvapatrice" icon="fa fa-facebook fa-4x" social-site="facebook"></social-button>
                    <social-button site-url="https://plus.google.com/+p_nostalgie" icon="fa fa-google-plus fa-4x" social-site="google-plus"></social-button>
                </div>
            </div>
        </div>
    </div>
@stop