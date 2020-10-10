@foreach($comments as $comment)
    <div class="display-comment" @if($comment->parent_id != null) style="margin-left:40px;" @endif>
        <strong>{{ $comment->user->name }}</strong>
        <p>{{ $comment->body }}</p>
        <form method="post" action="{{ route('comments.store') }}">
            @csrf
            <div class="form-group">
                <input type="text" name="body" class="form-control" />
                <input type="hidden" name="lession_id" value="{{ $ddcourse_id }}" />
                <input type="hidden" name="parent_id" value="{{ $comment->id }}" />
            </div>
            <div class="form-group">
                <a href="javascript:void(none)" id="reply_{{$comment->id}}" class="traloi">Trả lời</a>
                <input type="submit" class="text-primary submit_btn" value="Gửi" />
            </div>
        </form>
        {{-- @include('khoahoc.commentsDisplay', ['comments' => $comment->replies]) --}}
    </div>
@endforeach