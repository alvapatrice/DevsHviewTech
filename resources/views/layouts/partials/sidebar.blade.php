<div id="sidebar" class="sidebar sidebar-hide" toggle-sidebar="app.isCategoryShow">
    <ul class="list-unstyled category-list">
        @foreach($categories as $category)
            <li>
                <a href="{{ route('categories.single', [ $category[0]->slug ]) }}">
                    {{$category[0]->title}}
                    <div class="category-badges pull-right">
                            <span class="badge">
                                 <?php $i = 0 ?>
                                @foreach($category as $node)
                                    <?php $i += intval($node->post->count()) ?>
                                @endforeach
                                {{ $i }}
                            </span>
                    </div>
                </a>
            </li>
        @endforeach
        <li><a href="{{ route('categories.list') }}">More...</a></li>
    </ul>
</div>