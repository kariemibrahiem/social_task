    @extends('web.layouts.app')

    @section('content')

    <div class="trending-area fix pt-25 gray-bg">
        <div class="container">

        </div>
    </div>

    <section class="whats-news-area pt-50 pb-20 gray-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="whats-news-wrapper">

                        <div class="row justify-content-between align-items-end mb-15">
                            <div class="col-xl-4">
                                <div class="section-tittle mb-30">
                                    <h3>Latest News</h3>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                @forelse($posts as $post)
                                <div class="whats-news-single mb-40">
                                    <div class="whates-img">
                                        @if($post->image)
                                        <img src="{{ imageUrl($post->image) }}" alt="" style="width: 100%; height: auto;">
                                        @endif
                                    </div>
                                    <div class="whates-caption">
                                        <h4><a href="#">{{ $post->content }}</a></h4>

                                        <div class="d-flex align-items-center mb-2">
                                            @if($post->user->image)
                                            <img src="{{ imageUrl($post->user->image) }}" alt="" style="width: 40px; height: 40px; border-radius: 50%; margin-right: 10px;">
                                            @else
                                            <img src="{{ asset('news-master/assets/img/comment/comment_1.png') }}" alt="" style="width: 40px; height: 40px; border-radius: 50%; margin-right: 10px;">
                                            @endif
                                            <span>by {{ $post->user->name }} - {{ $post->created_at->diffForHumans() }}</span>
                                        </div>

                                        <div class="mt-2">
                                            @auth
                                            <form action="{{ route('front.posts.like', $post->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                <button type="submit" style="background:none; border:none; padding:0; cursor:pointer;">
                                                    <i class="fa fa-heart {{ $post->likes->where('user_id', auth()->id())->count() > 0 ? 'text-danger' : 'text-muted' }}"></i>
                                                </button>
                                            </form>
                                            @else
                                            <i class="fa fa-heart text-muted"></i>
                                            @endauth
                                            <span class="ml-2">{{ $post->likes->count() }} Likes</span>
                                        </div>

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
                                                            <img src="{{ imageUrl($comment->user->image) }}" alt="" style="width: 50px; height: 50px; border-radius: 50%;">
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
                                                                <img src="{{ imageUrl($comment->user->image) }}" alt="" style="width: 50px; height: 50px; border-radius: 50%;">
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
                                            @auth
                                            <div class="mt-3">
                                                <form action="{{ route('front.posts.comments.store', $post->id) }}" method="POST">
                                                    @csrf
                                                    <div class="input-group">
                                                        <input type="text" name="content" class="form-control" placeholder="Write a comment..." required>
                                                        <div class="input-group-append">
                                                            <button class="btn btn-primary" type="submit" style="padding: 0 20px;">Post</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            @endauth
                                        </div>
                                    </div>
                                </div>
                                <hr class="mb-40">
                                @empty
                                <div class="alert alert-info">No posts available.</div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">

                    <div class="single-follow mb-45">
                        <div class="single-box">
                            <div class="follow-us d-flex align-items-center">
                                <div class="follow-social">
                                    <a href="#"><i class="fas fa-users" style="font-size: 24px; color: #0056b3;"></i></a>
                                </div>
                                <div class="follow-count">
                                    <span>{{ $stats['friends'] }}</span>
                                    <p>Fans</p>
                                </div>
                            </div>
                            <div class="follow-us d-flex align-items-center">
                                <div class="follow-social">
                                    <a href="#"><i class="fas fa-user-friends" style="font-size: 24px; color: #6610f2;"></i></a>
                                </div>
                                <div class="follow-count">
                                    <span>{{ $stats['connections'] }}</span>
                                    <p>connections</p>
                                </div>
                            </div>
                            <div class="follow-us d-flex align-items-center">
                                <div class="follow-social">
                                    <a href="#"><i class="fas fa-file-alt" style="font-size: 24px; color: #fd7e14;"></i></a>
                                </div>
                                <div class="follow-count">
                                    <span>{{ $stats['posts'] }}</span>
                                    <p>posts</p>
                                </div>
                            </div>
                            <div class="follow-us d-flex align-items-center">
                                <div class="follow-social">
                                    <a href="#"><i class="fas fa-comments" style="font-size: 24px; color: #dc3545;"></i></a>
                                </div>
                                <div class="follow-count">
                                    <span>{{ $stats['comments'] }}</span>
                                    <p>comments</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="most-recent-area">

                        <div class="small-tittle mb-20">
                            <h4>Most Recent</h4>
                        </div>

                        @foreach($posts->take(4) as $post)
                        <div class="most-recent mb-40">
                            <div class="most-recent-img">
                                @if($post->image)
                                <img src="{{ imageUrl($post->image) }}" alt="">
                                @else

                                @endif

                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="weekly2-news-area pt-50 pb-30 gray-bg">
        <div class="container">
            <div class="weekly2-wrapper">
                <div class="row">

                    <div class="col-lg-12">
                        <div class="slider-wrapper">

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="small-tittle mb-30">
                                        <h4>Most Popular</h4>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="weekly2-news-active d-flex">
                                        @foreach($popularUsers as $user)

                                        <div class="weekly2-single">
                                            <div class="weekly2-img">
                                                @if($user->image)
                                                <img src="{{ imageUrl($user->image) }}" alt="" style="width: 100%; height: 200px; object-fit: cover;">
                                                @else
                                                <img src="{{ asset('news-master/assets/img/comment/comment_1.png') }}" alt="" style="width: 100%; height: 200px; object-fit: cover;">
                                                @endif
                                            </div>
                                            <div class="weekly2-caption">
                                                <h4><a href="#">{{ $user->name }}</a></h4>
                                                <p>User</p>

                                                <div class="mt-2">
                                                    @php
                                                    $status = $connectionStatuses[$user->id] ?? null;
                                                    @endphp
                                                    @if($status === 'accepted')
                                                    <p class=" btn-sm btn-success" style="padding: 2px 10px; color: white; font-size: 12px;">Friends</p>
                                                    @elseif($status === 'pending')
                                                    <p class=" btn-sm btn-warning" style="padding: 2px 10px; color: white; font-size: 12px;">Pending</p>
                                                    @else
                                                    <form method="POST" action="{{ route('front.connections.send', $user->id) }}">
                                                        @csrf
                                                        <button type="submit" class="btn btn-sm btn-primary" style="padding: 10px 20px; font-size: 12px;">Connect</button>
                                                    </form>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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