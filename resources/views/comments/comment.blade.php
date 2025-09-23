@php $level = $level ?? 0; @endphp
<div class="border p-3 mb-3 rounded {{ $level ? 'ms-4' : '' }}">
    <div class="d-flex justify-content-between">
        <div>
            <strong>{{ $comment->user->name ?? 'Anonymous' }}</strong>
            <div class="text-muted small">{{ $comment->created_at->diffForHumans() }}</div>
        </div>
    </div>

    <div class="mt-2">
        <p class="mb-1">{{ $comment->comment }}</p>
    </div>

    @auth
        <!-- Reply form (always visible; no JS required) -->
        <form action="{{ route('comments.store') }}" method="POST" class="mt-2">
            @csrf
            <input type="hidden" name="post_id" value="{{ $comment->post_id }}">
            <input type="hidden" name="parent_id" value="{{ $comment->id }}">
            <div class="mb-2">
                <textarea name="comment" rows="2" class="form-control form-control-sm" placeholder="Write a reply..." required></textarea>
            </div>
            <button type="submit" class="btn btn-sm btn-outline-primary">Reply</button>
        </form>
    @else
        <div class="mt-2"><small>Please <a href="{{ route('login') }}">log in</a> to reply.</small></div>
    @endauth

    <!-- Recursively show replies -->
    @if($comment->replies && $comment->replies->count())
        @foreach($comment->replies as $reply)
            @include('comments.comment', ['comment' => $reply, 'level' => $level + 1])
        @endforeach
    @endif
</div>
