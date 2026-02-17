@extends('web.layouts.app')
@section('title', 'Notifications')

@section('content')
<div class="about-area gray-bg pt-50 pb-50">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-tittle mb-30">
                    <h3>Notifications</h3>
                </div>
            </div>
        </div>
        <div class="row">
            
            <div class="col-lg-12">
                <div class="whats-news-wrapper mb-40">
                    <div class="row justify-content-between align-items-end mb-15">
                        <div class="col-xl-12">
                            <div class="section-tittle mb-30">
                                <h4>New Connection Requests</h4>
                            </div>
                        </div>
                    </div>
                    <div class="comments-area" style="padding: 30px; background: #fff;">
                        @if($connectionRequests->count() > 0)
                        <div class="comment-list">
                            @foreach($connectionRequests as $request)
                            <div class="single-comment justify-content-between d-flex mb-30">
                                <div class="user justify-content-between d-flex w-100">
                                    <div class="thumb">
                                        <img src="{{ $request->sender->image ? asset($request->sender->image) : asset('news-master/assets/img/comment/comment_1.png') }}"
                                            alt="" style="width: 50px; height: 50px; border-radius: 50%;">
                                    </div>
                                    <div class="desc w-100 ml-3">
                                        <div class="d-flex justify-content-between">
                                            <div class="d-flex align-items-center">
                                                <h5><a href="#">{{ $request->sender->name }}</a></h5>
                                                <p class="date pl-2">{{ $request->created_at->diffForHumans() }}</p>
                                            </div>
                                        </div>
                                        <p class="comment mb-2">Sent you a connection request.</p>
                                        
                                    </div>
                                </div>
                            </div>
                            <hr>
                            @endforeach
                        </div>
                        @else
                        <p>No new connection requests.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            
            <div class="col-lg-6">
                <div class="whats-news-wrapper mb-40">
                    <div class="row justify-content-between align-items-end mb-15">
                        <div class="col-xl-12">
                            <div class="section-tittle mb-30">
                                <h4>Comments on My Posts</h4>
                            </div>
                        </div>
                    </div>
                    <div class="comments-area" style="padding: 30px; background: #fff;">
                        @if($commentNotifications->count() > 0)
                        <div class="comment-list">
                            @foreach($commentNotifications as $notification)
                            <div class="single-comment justify-content-between d-flex mb-30">
                                <div class="user justify-content-between d-flex w-100">
                                    <div class="thumb">
                                        <img src="{{ $notification->user->image ? asset($notification->user->image) : asset('news-master/assets/img/comment/comment_1.png') }}" alt="" style="width: 50px; height: 50px; border-radius: 50%;">
                                    </div>
                                    <div class="desc w-100 ml-3">
                                        <div class="d-flex justify-content-between">
                                            <div class="d-flex align-items-center">
                                                <h5><a href="#">{{ $notification->user->name }}</a></h5>
                                                <p class="date pl-2">{{ $notification->created_at->diffForHumans() }}</p>
                                            </div>
                                        </div>
                                        <p class="comment mb-2">{{ $notification->content }}</p>
                                        <p class="text-muted" style="font-size: 13px;">
                                            <i class="fas fa-quote-left mr-2"></i> On post: "{{ Str::limit($notification->post->content, 60) }}"
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            @endforeach
                        </div>
                        @else
                        <p>No new comments.</p>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="whats-news-wrapper mb-40">
                    <div class="row justify-content-between align-items-end mb-15">
                        <div class="col-xl-12">
                            <div class="section-tittle mb-30">
                                <h4>Replies to My Comments</h4>
                            </div>
                        </div>
                    </div>
                    <div class="comments-area" style="padding: 30px; background: #fff;">
                        @if($replyNotifications->count() > 0)
                        <div class="comment-list">
                            @foreach($replyNotifications as $notification)
                            <div class="single-comment justify-content-between d-flex mb-30">
                                <div class="user justify-content-between d-flex w-100">
                                    <div class="thumb">
                                        <img src="{{ $notification->user->image ? asset($notification->user->image) : asset('news-master/assets/img/comment/comment_1.png') }}" alt="" style="width: 50px; height: 50px; border-radius: 50%;">
                                    </div>
                                    <div class="desc w-100 ml-3">
                                        <div class="d-flex justify-content-between">
                                            <div class="d-flex align-items-center">
                                                <h5><a href="#">{{ $notification->user->name }}</a></h5>
                                                <p class="date pl-2">{{ $notification->created_at->diffForHumans() }}</p>
                                            </div>
                                        </div>
                                        <p class="comment mb-2">{{ $notification->text }}</p>
                                        <p class="text-muted" style="font-size: 13px;">
                                            <i class="fas fa-reply mr-2"></i> Replying to: "{{ Str::limit($notification->comment->content, 60) }}"
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            @endforeach
                        </div>
                        @else
                        <p>No new replies.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
