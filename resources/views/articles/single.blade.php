@extends('layouts.app')
@section('navbar')
    @include('layouts.partials.navbar')
@stop
@section('optionsbar')
    @include('layouts.partials.optionsbar')
@stop
@section('head')
    @include('layouts.partials.single-header')
@stop
@section('content')
    <div class="row">
        <div class="article-options">
            <div class="container">
                <div class="row">
                    @include('layouts.partials.share_fav')
                </div>
            </div>
        </div>
        <div class="single-page-div" ng-controller="syntaxHighlightController">
            <section class="page-article col-sm-12">

                <div class="row">
                    <!-- Structured data format for schema.org -->

                    <article class="article-main-body" itemscope itemtype="http://schema.org/TechArticle">
                        <div class="row">
                            <div class="title text-center" id="title">
                                <h1 itemprop="name"><span class="inline-heading">{{ $article->title }}</span>
                                </h1>
                            </div>
                        </div>
                        <meta itemprop="educationalUse" content="{{ $keywords }}">
                        <meta itemprop="keywords" content="{{ $keywords }}">
                        <div class="main-content">

                            @if( getenv('APP_ENV') == 'production')
                                <div class="google_ads_top">
                                    {!! $ads[3]  !!}
                                </div>
                            @endif
                            <div class="article-body" id="articleBody" itemprop="articleBody" body-image-directive attach-blanktarget-ancher-directive>
                                {!! $article->body !!}
                            </div>
                            @if( getenv('APP_ENV') == 'production')
                                <div class="google_ads_top">
                                    {!! $ads[1]  !!}
                                </div>
                            @endif
                            <div class="social_media margin-top-20 text-center">
                                <social-button site-url="{{ route('articles.single', $article->slug) }}" icon="fa fa-twitter" social-site="twitter" class="twitter_share" link-text="Tweet"></social-button>
                                <social-button site-url="{{ route('articles.single', $article->slug) }}" icon="fa fa-facebook" social-site="facebook" class="facebook_share" link-text="Share"></social-button>
                                <social-button site-url="{{ route('articles.single', $article->slug) }}" icon="fa fa-google-plus" social-site="google-plus" class="google_share" link-text="+1"></social-button>
                            </div>
                            <div class="article-threads">
                                @include('layouts.partials.single-article-footer-thread')
                            </div>
                            <div class="nav_articles clearfix">
                                <a href="{{ route('articles.single', $prevArticle['slug']) }}" class="prev_article">
                                    <h4>Previous Article</h4>
                                    <p>{{ $prevArticle['title'] }}</p>
                                </a>
                                <a href="{{ route('articles.single', $nextArticle['slug']) }}" class="next_article">
                                    <h4>Next Article</h4>
                                    <p>{{ $nextArticle['title'] }}</p>
                                </a>
                            </div>
                        </div>
                        <div class="sidebar-content">
                            @include('layouts.partials.subscription-form-aside')
                            {{--@include('layouts.partials.single-amazon-book')--}}

                                {{--<div class="sidebar_category">--}}
                                    {{--<div class="panel panel-default">--}}
                                        {{--<div class="panel-heading">--}}
                                            {{--Articles by Categories--}}
                                        {{--</div>--}}
                                        {{--<div class="panel-body">--}}
                                            {{--@include('layouts.partials.category-partials')--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}

                            {{--Section For Ads--}}
                            @if( getenv('APP_ENV') == 'production')
                                <div class="google_ads">
                                    {!! $ads[2]  !!}
                                </div>
                            @endif
                            @include('layouts.partials.category_articles_sidebar')
                    </article>
                </div>
                <div class="related_articles row" related-articles-directive>
                    <h5><span>Articles you might be interested in</span></h5>
                    <ul class="list-unstyled">
                        @foreach($relatedArticles as $relatedArticle)
                            @if($relatedArticle['slug'] != $article->slug)
                                <li class="card-shadow">
                                    <a href="{{ route('articles.single', $relatedArticle['slug']) }}"><img src="http://devartisans.com/{{ $relatedArticle['image'] }}"
                                         alt="{{ $relatedArticle['image'] }}"></a>
                                    <a href="{{ route('articles.single', $relatedArticle['slug']) }}">{{ $relatedArticle['title'] }}</a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </section>
        </div>
    </div>
@stop

@if( getenv('APP_ENV') == 'production')
@section('disquss')
    @include('layouts.partials.disquss')
@stop
@endif
@section('scripts')
    @include('layouts.partials.aceui')
    <script src="http://platform.twitter.com/widgets.js" async></script>
    {{--Facebook share--}}

    <div id="fb-root"></div>
    <script>
        $(document).ready(function() {
            $.ajaxSetup({ cache: true });
            $.getScript('//connect.facebook.net/en_US/sdk.js', function(){
                FB.init({
                    appId: '{{ getenv("FACEBOOK_CLIENT_ID") }}',
                    version: 'v2.3' // or v2.0, v2.1, v2.0
                });

            });
            $('.btn-facebook, .btn-facebook-top').on('click', function(e) {
                e.preventDefault();
                FB.ui({
                    method: 'share_open_graph',
                    action_type: 'og.likes',
                    action_properties: JSON.stringify({
                        object:'{{ route('articles.single', $article->slug) }}',
                    })
                }, function(response){});
            })
            var twitterBtn = $('.btn-twitter, .btn-twitter-top'),
                href = 'https://twitter.com/intent/tweet?';
                href += 'url={{ route('articles.single', $article->slug) }}&';
                href += 'text={{ $article->title }}&';
                href += 'via=devartisans';

                twitterBtn.attr('href', href);

            $('.btn-twitter, .btn-twitter-top').on('click', function(e) {
                e.preventDefault();
                twitterBtn.trigger('click');
            })


            var googlePlusBtn = $('.btn-google-plus'),
                ghref = 'https://plus.google.com/share?';
                ghref += 'url={{ route('articles.single', $article->slug) }}';
                onclickevt = "javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;";

                googlePlusBtn.attr('href', ghref);
                googlePlusBtn.attr('onclick', onclickevt);

            $('.btn-google-plus').on('click', function(e) {
                e.preventDefault();
                googlePlusBtn.trigger('click');
            });
        });

    </script>
@stop
