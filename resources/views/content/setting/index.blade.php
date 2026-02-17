@extends('layouts/contentNavbarLayout')

@section('title', trns('Settings'))

@section('content')
<div class="card">
    <div class="card-header">
        <h5>{{ trns('Update Settings') }}</h5>
    </div>

    <div class="card-body">
        <form action="{{ $updateRoute }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">{{ trns('Site Name') }}</label>
                <input type="text" name="name" class="form-control"
                    value="{{ $siteName->value ?? '' }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">{{ trns('Logo') }}</label><br>

                @if(!empty($logo->value))
                    <img src="{{ asset( $logo->value) }}" alt="Logo" class="mb-2" width="100">
                @endif

                <input type="file" name="logo" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary">{{ trns('Save Changes') }}</button>
        </form>
    </div>
</div>
@endsection
