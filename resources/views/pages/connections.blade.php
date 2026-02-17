@extends('web.layouts.app')

@section('content')
<div class="trending-area fix pt-25 gray-bg">
    <div class="container">

        <div class="row mb-5">
            <div class="col-lg-12">
                <div class="section-tittle mb-30">
                    <h3>Pending Requests (Received)</h3>
                </div>
                <div class="row">
                    @forelse($receivedRequests as $connection)
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="single-follow mb-45" style="background: white; padding: 20px; border-radius: 5px;">
                            <div class="follow-us d-flex align-items-center mb-2">
                                <div class="follow-social">
                                    @if($connection->sender->image)
                                    <img src="{{ imageUrl($connection->sender->image) }}" alt="" style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover;">
                                    @else
                                    <img src="{{ asset('news-master/assets/img/comment/comment_1.png') }}" alt="" style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover;">
                                    @endif
                                </div>
                                <div class="follow-count ml-3">
                                    <span style="font-size: 16px; font-weight: bold; display: block;">{{ $connection->sender->name }}</span>
                                </div>
                            </div>
                            <div class="text-center mt-2">
                                <form method="POST" action="{{ route('front.connections.accept', $connection->id) }}" style="display: inline-block;">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-success" style="padding: 5px 15px; font-size: 13px;">
                                        <i class="fa fa-check"></i> Accept
                                    </button>
                                </form>
                                <form method="POST" action="{{ route('front.connections.reject', $connection->id) }}" style="display: inline-block;">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-danger" style="padding: 5px 15px; font-size: 13px;">
                                        <i class="fa fa-times"></i> Reject
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-12">
                        <div class="alert alert-info">No pending received requests.</div>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="section-tittle mb-30">
                    <h3>Pending Requests (Sent)</h3>
                </div>
                <div class="row">
                    @forelse($sentRequests as $connection)
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="single-follow mb-45" style="background: white; padding: 20px; border-radius: 5px;">
                            <div class="follow-us d-flex align-items-center mb-2">
                                <div class="follow-social">
                                    @if($connection->receiver->image)
                                    <img src="{{ imageUrl($connection->receiver->image) }}" alt="" style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover;">
                                    @else
                                    <img src="{{ asset('news-master/assets/img/comment/comment_1.png') }}" alt="" style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover;">
                                    @endif
                                </div>
                                <div class="follow-count ml-3">
                                    <span style="font-size: 16px; font-weight: bold; display: block;">{{ $connection->receiver->name }}</span>
                                </div>
                            </div>
                            <div class="text-center">
                                <span class="badge badge-secondary">{{ $connection->status }}</span>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-12">
                        <div class="alert alert-info">No pending sent requests.</div>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection