@extends('main_design')

@section('post.view_post_details')

<div class="single-property section">
    <div class="container">
      <div class="row">
        <div class="col-lg-8">
          <div class="main-image">
            @php
                $images = json_decode($post->images, true);
            @endphp
            @if(!empty($images))
                <img src="{{ asset($images[0]) }}" alt="Post Image">
            @else
                <img src="{{ asset('default.jpg') }}"
                        alt="No Image"
                        class="img-fluid"
                        style="width:100%; height:500px; object-fit:cover;">
            @endif
            <img src="assets/images/single-property.jpg" alt="">
          </div>
          <div class="main-content">
            <span class="category">{{ $post->title }}</span>
            <h4>Occurrence Date: {{ \Carbon\Carbon::parse($post->occurrence_date)->format('d M, Y') }}</h4>
            <p><strong>Category:</strong> {{ $post->category->category_name ?? 'Uncategorized' }}</p>
            <p>{{ $post->description ?? 'No description provided.' }}</p>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="info-table">
            <ul>
              <li>
                <img src="assets/images/info-icon-01.png" alt="" style="max-width: 52px;">
                <h4>450 m2<br><span>Total Flat Space</span></h4>
              </li>
              <li>
                <img src="assets/images/info-icon-02.png" alt="" style="max-width: 52px;">
                <h4>Contract<br><span>Contract Ready</span></h4>
              </li>
              <li>
                <img src="assets/images/info-icon-03.png" alt="" style="max-width: 52px;">
                <h4>Payment<br><span>Payment Process</span></h4>
              </li>
              <li>
                <img src="assets/images/info-icon-04.png" alt="" style="max-width: 52px;">
                <h4>Safety<br><span>24/7 Under Control</span></h4>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>



<div class="container py-5">
    <!-- Comment Section -->
    <div class="mt-5">
        <h4 class="fw-bold text-secondary">Comments</h4>

        @if(session('success'))
            <div class="alert alert-success small">{{ session('success') }}</div>
        @endif

        <!-- Comment Form (top-level) -->
        @auth
            <form action="{{ route('comments.store') }}" method="POST" class="mb-4">
                @csrf
                <input type="hidden" name="post_id" value="{{ $post->id }}">
                <div class="mb-3">
                    <textarea name="comment" class="form-control" rows="3" placeholder="Write your comment..." required></textarea>
                    @error('comment') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
                <button type="submit" class="btn btn-success">Submit Comment</button>
                
            </form>
        @else
            <p><small>Please <a href="{{ route('login') }}">log in</a> to post a comment.</small></p>
        @endauth

        <!-- Show top-level comments -->
        @if($post->comments && $post->comments->count())
            @foreach($post->comments as $comment)
                @include('comments.comment', ['comment' => $comment, 'level' => 0])
            @endforeach
        @else
            <p class="text-muted">No comments yet. Be the first to comment!</p>
        @endif
    </div>

</div>
@endsection
