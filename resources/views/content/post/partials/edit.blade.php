@extends('layouts/contentNavbarLayout')

@section('title', trns('Edit Post'))

@section('content')
<h4 class="py-3 mb-4">
  <span class="text-muted fw-light">
    <a href="{{ route($route.'.index') }}">{{ trns('Posts') }}</a> /
  </span> {{ trns('Edit Post') }}
</h4>

<div class="card">
  <div class="card-body">
    <form action="{{ route($route.'.update', $obj->id) }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')
      <div class="row m-3">

        <div class="col-12 mb-3">
          <label class="form-label" for="content">{{ trns('content') }}</label>
          <textarea class="form-control" id="content" name="content" rows="5" required>{{ old('content', $obj->content) }}</textarea>
          @error('content')
          <div class="text-danger">{{ $message }}</div>
          @enderror
        </div>

        <div class="col-12 mb-3">
          <label class="form-label" for="image">{{ trns('image') }}</label>
          <input class="form-control" type="file" id="image" name="image">
          @if($obj->image)
          <div class="mt-2">
            <img src="{{ asset($obj->image) }}" alt="Current Image"
              class="rounded" width="100">
          </div>
          @endif
          @error('image')
          <div class="text-danger">{{ $message }}</div>
          @enderror
        </div>

      </div>

      <button type="submit" class="btn btn-primary">{{ trns('update') }}</button>
      <a href="{{ route($route.'.index') }}" class="btn btn-secondary">{{ trns('cancel') }}</a>
    </form>
  </div>
</div>
@endsection
