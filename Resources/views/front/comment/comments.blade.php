<div id="comments" class="comments-area">
    <h2 class="comments-title">{{trans('comments::comments.title.comments')}}({{count($comments)}})</h2>
    <ol class="comment-list">
        @foreach($comments as $i=>$comment)
           @include('comments::front.comment.item',['comment'=>$comment])
            @if(count($comment->children ))
                <ul class="children">
                    @foreach($comment->children as $j=>$item)
                        @include('comments::front.comment.item',['comment'=>$comment])
                @endforeach
                <!-- #comment-## -->
                </ul>
            @endif
        @endforeach
    </ol>
    <div id="respond" class="comment-respond">
        <div id="loading-form">
            <div class="lds-spinner">
                <div class="spinner-border" style="width: 3rem; height: 3rem;" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
            </div>
        </div>
        <h3 id="reply-title" class="comment-reply-title">{{trans('comments::comments.title.leave a comment')}}</h3>
        <form action="{{route('api.comments.comment.create')}}" method="post" id="commentform" class="comment-form">
            <input id="commentable_type" name="commentable_type" type="hidden" value="{{$commentableType}}">
            <input id="commentable_id" name="commentable_id" type="hidden" value="{{$commentableId}}">
            @auth
                <input id="user_id" name="user_id" type="hidden" value="{{$currentUser->id}}">
            @endauth

            <p class="comment-form-website">
                <input id="website" name="website" type="text" value="" size="30" placeholder="Website">
            </p>
            <div class="row">
                <p class="comment-form-author col-md-6">
                    <input id="author" name="author" type="text" value="{{$currentUser?$currentUser->present()->fullName():''}}" size="30" placeholder="{{trans('comments::comments.form.name')}} *" required="">
                </p>
                <p class="comment-form-email col-md-6">
                    <input id="email" name="email" type="text" value="{{$currentUser?$currentUser->email:''}}" size="30" placeholder="{{trans('comments::comments.form.email')}} *" required="">
                </p>
            </div>
            <p class="comment-form-comment">
                <textarea id="comment" name="comment" cols="45" rows="4" placeholder="{{trans('comments::comments.form.comment')}}*" required=""></textarea>
            </p>
            <p class="comment-form-comment">
                {!!app('captcha')->display($attributes = ['data-sitekey'=>Setting::get('form::api')])!!}
                </br>
            </p>
            <p class="form-submit">
                <input name="submit" type="submit" id="submit" class="octf-btn octf-btn-secondary" value="{{trans('comments::comments.button.send')}}">
            </p>
        </form>
    </div>
</div>
@section ('scripts')
    @parent
    <style>
        #loading-form {
            display: none;
            position: absolute;
            background-color: rgba(0, 0, 0, 0.6);
            z-index: 1000000;
            width: 100%;
            height: 100%;
        }

        .lds-spinner {
            color: #fff;
            display: block;
            position: relative;
            width: 64px;
            height: 64px;
            margin: auto;
            background: #fff;
            top: 50%;
        }
    </style>
    <script src="https://www.google.com/recaptcha/api.js"></script>
    <script>
        jQuery(function ($) {
            $(document).ready(function () {
                var formid = '#commentform';
                $(formid).submit(function (event) {
                    event.preventDefault();
                    var info = objectifyForm($(this).serializeArray());

                    info.captcha = {'version': '2', 'token': info['g-recaptcha-response']};
                    delete info['g-recaptcha-response'];
                    $.ajax({
                        type: 'POST',
                        url: $(this).attr('action'),
                        dataType: 'json',
                        data: {attributes: info},
                        beforeSend: function (data) {
                            $('#loading-form').css('display', 'block');
                        },
                        success: function (data) {
                            $('#loading-form').css('display', 'none');
                            location.reload();
                        },
                        error: function (data) {
                            $('#loading-form').css('display', 'none');
                        }
                    })
                })
            });

            function objectifyForm(formArray) {//serialize data function

                var returnArray = {};
                for (var i = 0; i < formArray.length; i++) {
                    returnArray[formArray[i]['name']] = formArray[i]['value'];
                }
                return returnArray;
            }

        });
    </script>
@stop
