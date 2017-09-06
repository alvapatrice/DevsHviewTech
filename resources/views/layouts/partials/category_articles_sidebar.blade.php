<div class="category_content">
    <ul class="list-unstyled card-shadow">
        <li>
            <h4>Top Articles in <a href="{{ route('categories.single', [ $article->category->slug]) }}">{{  $article->category->title }}</a></h4>
        </li>
        @foreach($categoryArticles as $categoryArticle)
            <li>
                <a href="{{ route('articles.single', $categoryArticle->slug) }}">
                    <p class="article_counter">{{ ++$articleCounter }}</p>
                    <p class="category_article_title">{{ $categoryArticle->title }}</p>
                </a>
            </li>
        @endforeach
    </ul>
</div>