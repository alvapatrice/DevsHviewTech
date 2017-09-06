<div class="col-md-12" ng-controller="SetBookmarksController as setBookmarks" id="article-view-wrapper">
        <div class="row" id="article-view" view-directive>
        @foreach($articles as $article)
                @if( getenv('APP_ENV') == 'production')
{{--                    @if(++$articles_count && ($articles_count == 3 || $articles_count == 8 || $articles_count == 9))--}}
                    @if(++$articles_count && ($articles_count == 3 || $articles_count == 9))
                    {{--@if(++$count && ($count == 8))--}}
                        <div class="col-xs-12 col-sm-6 col-lg-3 articleContainer adsContainer">
                            <div class="googld_ads card-shadow">
                                    {!! $ads[$ads_count++]  !!}
                            </div>
                        </div>
                    @endif
                @endif
                <div class="col-xs-12 col-sm-6 col-lg-3 articleContainer">
                    <div class="article article-grid card-shadow">
                        <div class="article-header {{ $article->category->slug }}">
                            <div class="article-content">
                                <h4 class="article-category">{!! link_to_route('categories.single',
                                    $article->category->title, [$article->category->slug] ) !!}</h4>
                                <p class="published_date">{{ $article->published_at->toFormattedDateString() }}</p>
                                <div class="article-header-options" data-toggle="tooltip" data-placement="top"
                                     title="Add to Favourites">
                                    <span class="fa fa-star"
                                          bookmark-directive="setBookmarks.isBookmarked('{{ $article->slug }}')"
                                          ng-click="setBookmarks.setFavourites('{{ $article->slug }}', '{{$article->title}}')"></span>
                                </div>
                            </div>
                        </div>
                        <div class="article-body">
                            <a href="{{ route('articles.single', [$article->slug]) }}">
                                <div class="article-header-image" image-directive image-src="{{ $article->image }}"
                                     ></div>
                            </a>

                            <div class="article-data">

                                <h1 class="text-center title">{!! link_to_route('articles.single', $article->title,
                                    $parameters = array($article->slug), $attributes = array()) !!}</h1>
                                @if($article->subtitle)
                                    <h2 class="text-center subtitle">{{ $article->subtitle }}</h2>
                                @endif
                                <p class="showInListView description">{!! $article->description !!}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    <div class="text-center" id="article-pagination" article-paginator>
        {!! $articles->render() !!}
    </div>
</div>
