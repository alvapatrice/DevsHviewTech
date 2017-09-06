<div class="col-md-12 text-center">
    <div class="inline-block">
        <social-button site-url="{{ route('articles.single', $article->slug) }}" icon="fa fa-twitter" social-site="twitter-top" id="twitter_share" link-text="Tweet"></social-button>
        <social-button site-url="{{ route('articles.single', $article->slug) }}" icon="fa fa-facebook" social-site="facebook-top" id="facebook_share" link-text="Share"></social-button>
    </div>
    <div ng-controller="SetBookmarksController as setBookmarks" class="bookmark inline-block">
        <h4 class="hidden-xs">Favorite</h4>
                                <span class="fa fa-star-o bookmark-toggle-btn"
                                      bookmark-toggle="setBookmarks.isBookmarked('{{ $article->slug }}')"
                                      bookmark-directive="setBookmarks.isBookmarked('{{ $article->slug }}')"
                                      ng-click="setBookmarks.setFavourites('{{ $article->slug }}', '{{$article->title}}')"></span>
    </div>
</div>