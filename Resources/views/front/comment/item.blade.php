<li id="comment-16" class="comment-item">
    <article class="comment-wrap clearfix">
        <div class="gravatar">
            <img src="{{$comment->user->present()->gravatar()??'https://via.placeholder.com/80x80.png'}}" alt="{{$comment->user->id?$comment->user->present()->fullName():$comment->guest_name}}" class="">
        </div>
        <div class="comment-content">
            <div class="comment-meta">
                <h6 class="comment-author">{{isset($comment->user->id)?$comment->user->present()->fullName():$comment->guest_name}}</h6>
                <span class="comment-time">{{format_date($comment->created_at)}}</span>
                <a rel="nofollow" class="comment-reply-link" href="#">{{trans('comments::comments.button.reply')}}</a>
            </div>
            <div class="comment-text">
                <p>{{$comment->comment}}</p>
            </div>
        </div>
    </article>
</li>
@section ('scripts')
    @parent

@stop
