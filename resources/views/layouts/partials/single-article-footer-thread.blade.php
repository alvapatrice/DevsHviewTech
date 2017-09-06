<div class="article-footer">
    <div class="forum-section-header clearfix">
        <h3 class="pull-left"><i class="fa fa-comments-o margin-h-10"></i>Discussions</h3>
        <a href="{{ route('threads.new.create') }}" class="btn btn-primary pull-right">Create New
            Thread</a>
    </div>
    <div class="forum-section-body margin-top-15">
        <ul class="list-unstyled margin-left-20">
            @if(count($threads) > 0)
                @foreach($threads as $thread)
            <li><i class="fa fa-comments margin-h-10"></i><a href="{{ route('threads.single.show', [$threadCategories[$thread->category_id], $thread->slug]) }}">
                    @if($thread->category_id == 6)
                        <strong>General Discussion About This Article</strong>
                    @elseif($thread->category_id == 4)
                        <strong>Common Errors Related To This Article</strong>
                    @elseif($thread->category_id == 3)
                        <strong>Ask Questions Related This Article</strong>
                    @else
                        {!!  $thread->title !!}
                    @endif
                </a></li>
                @endforeach
            @else
                <li>No topic yet.</li>
            @endif
        </ul>
    </div>
</div>