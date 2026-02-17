@extends('web.layouts.app')

@section('content')
<div class="trending-area fix pt-25 gray-bg">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="section-tittle mb-30">
                    <h3>My Posts</h3>
                </div>

                @forelse($posts as $post)
                <div class="whats-news-single mb-40">
                    <div class="whates-img">
                        @if($post->image)
                        <img src="{{ asset('storage/' . $post->image) }}" alt="" style="width: 100%; height: auto;">
                        @endif
                    </div>
                    <div class="whates-caption">
                        <h4><a href="#">{{ $post->content }}</a></h4>

                        <div class="d-flex align-items-center mb-2">
                            @if($post->user->image)
                            <img src="{{ asset('storage/' . $post->user->image) }}" alt="" style="width: 40px; height: 40px; border-radius: 50%; margin-right: 10px;">
                            @else
                            <img src="{{ asset('news-master/assets/img/comment/comment_1.png') }}" alt="" style="width: 40px; height: 40px; border-radius: 50%; margin-right: 10px;">
                            @endif
                            <span>by {{ $post->user->name }} - {{ $post->created_at->diffForHumans() }}</span>
                        </div>

                        <p class="mt-2"><i class="fa fa-heart text-danger"></i> {{ $post->likes->count() }} Likes</p>

                        <div class="comments-area mt-4" style="padding: 20px; background: #f9f9f9; border-radius: 5px;">
                            <h4 style="font-size: 18px;">{{ $post->comments->count() }} Comments</h4>
                            <div class="comment-list">
                                @php
                                $sortedComments = $post->comments->sortByDesc('created_at');
                                $visibleComments = $sortedComments->take(2);
                                $hiddenComments = $sortedComments->slice(2);
                                $hiddenCount = $hiddenComments->count();
                                @endphp
                                @foreach($visibleComments as $comment)
                                <div class="single-comment justify-content-between d-flex mb-3">
                                    <div class="user justify-content-between d-flex w-100">
                                        <div class="thumb">
                                            @if($comment->user->image)
                                            <img src="{{ asset('storage/' . $comment->user->image) }}" alt="" style="width: 50px; height: 50px; border-radius: 50%;">
                                            @else
                                            <img src="{{ asset('news-master/assets/img/comment/comment_1.png') }}" alt="" style="width: 50px;">
                                            @endif
                                        </div>
                                        <div class="desc w-100 ml-3">
                                            <div class="d-flex justify-content-between">
                                                <div class="d-flex align-items-center">
                                                    <h5><a href="#">{{ $comment->user->name }}</a></h5>
                                                    <p class="date pl-2">{{ $comment->created_at->diffForHumans() }}</p>
                                                </div>
                                            </div>
                                            <p class="comment mb-1">{{ $comment->content }}</p>

                                            @if($comment->reply)
                                            <div class="reply-comment mt-2 ml-4 p-2 bg-white border rounded">
                                                <p class="mb-1"><strong>Reply:</strong> {{ $comment->reply->text }}</p>
                                                <small class="text-muted">{{ $comment->reply->created_at->diffForHumans() }}</small>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                @endforeach

                                @if($hiddenCount > 0)
                                <div id="more-comments-{{ $post->id }}" style="display:none;">
                                    @foreach($hiddenComments as $comment)
                                    <div class="single-comment justify-content-between d-flex mb-3">
                                        <div class="user justify-content-between d-flex w-100">
                                            <div class="thumb">
                                                @if($comment->user->image)
                                                <img src="{{ asset('storage/' . $comment->user->image) }}" alt="" style="width: 50px; height: 50px; border-radius: 50%;">
                                                @else
                                                <img src="{{ asset('news-master/assets/img/comment/comment_1.png') }}" alt="" style="width: 50px;">
                                                @endif
                                            </div>
                                            <div class="desc w-100 ml-3">
                                                <div class="d-flex justify-content-between">
                                                    <div class="d-flex align-items-center">
                                                        <h5><a href="#">{{ $comment->user->name }}</a></h5>
                                                        <p class="date pl-2">{{ $comment->created_at->diffForHumans() }}</p>
                                                    </div>
                                                </div>
                                                <p class="comment mb-1">{{ $comment->content }}</p>

                                                @if($comment->reply)
                                                <div class="reply-comment mt-2 ml-4 p-2 bg-white border rounded">
                                                    <p class="mb-1"><strong>Reply:</strong> {{ $comment->reply->text }}</p>
                                                    <small class="text-muted">{{ $comment->reply->created_at->diffForHumans() }}</small>
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                <a href="#" class="show-more-comments" data-post="{{ $post->id }}" data-hidden="{{ $hiddenCount }}" style="display:inline-block; margin-top:5px; font-size:14px; color:#0056b3;">
                                    Show more ({{ $hiddenCount }})
                                </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="mb-40">
                @empty
                <div class="alert alert-info">No posts found.</div>
                @endforelse

            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.show-more-comments').forEach(function(link) {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                var postId = this.getAttribute('data-post');
                var hiddenCount = this.getAttribute('data-hidden');
                var wrapper = document.getElementById('more-comments-' + postId);
                if (wrapper.style.display === 'none') {
                    wrapper.style.display = 'block';
                    this.textContent = 'Show less';
                } else {
                    wrapper.style.display = 'none';
                    this.textContent = 'Show more (' + hiddenCount + ')';
                }
            });
        });
    });
</script>
@endsection