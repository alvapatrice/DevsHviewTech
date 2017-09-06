<div class="list-group">
    @foreach( $categories as $category)
        <a href="{{ route('categories.single', [ $category[0]->slug]) }}" class="list-group-item">
            {{ $category[0]->title }}
            <span class="badge">
                            <?php $i = 0 ?>
                @foreach($category as $node)
                    <?php $i += intval($node->post->count()) ?>
                @endforeach
                {{ $i }}
                        </span>
        </a>
    @endforeach
</div>