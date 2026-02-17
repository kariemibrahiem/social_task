@extends('web.layouts.app')

@section('content')
<div class="trending-area fix pt-25 gray-bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-tittle mb-30">
                    <h3>My Friends</h3>
                </div>
                <div class="row">
                    @forelse($friends as $friend)
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="single-follow mb-45" style="background: white; padding: 20px; border-radius: 5px;">
                            <div class="follow-us d-flex align-items-center">
                                <div class="follow-social">
                                    @if($friend->image)
                                    <img src="{{ asset('storage/' . $friend->image) }}" alt="" style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover;">
                                    @else
                                    <img src="{{ asset('news-master/assets/img/comment/comment_1.png') }}" alt="" style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover;">
                                    @endif
                                </div>
                                <div class="follow-count ml-3">
                                    <span style="font-size: 16px; font-weight: bold; display: block;">{{ $friend->name }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-12">
                        <div class="alert alert-info">No friends added yet.</div>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
