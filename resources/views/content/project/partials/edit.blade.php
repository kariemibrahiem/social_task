@extends('layouts/contentNavbarLayout')

@section('title', trns('Edit Admin'))

@section('content')
    <h4 class="py-3 mb-4">
        <span class="text-muted fw-light">
            <a href="{{ route($route . '.index') }}">{{ trns('Users') }}</a> /
        </span> {{ trns('Edit Admin') }}
    </h4>

    <div class="card">
        <div class="card-body">
            <form action="{{ route($route . '.update', $obj->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row m-3">

                    <div class="col-5">
                        <label class="form-label" for="title">{{ trns('title') }}</label>
                        <input value="{{ $obj->title }}" type="text" class="form-control" id="title" name="title" value="{{ old('title') }}"
                            required>
                    </div>

                    <div class="col-5">
                        <label class="form-label" for="url">{{ trns('url') }}</label>
                        <input value="{{ $obj->url }}" type="text" class="form-control" id="url" name="url" value="{{ old('url') }}"
                            >
                    </div>

                     <div class="col-5">
                        <label class="form-label" for="category">{{ trns('category') }}</label>
                        <input value="{{ $obj->category }}" type="text" class="form-control" id="category" name="category" value="{{ old('category') }}"
                            required>
                    </div>

                     <div class="col-5">
                        <label class="form-label" for="sort_order">{{ trns('sort_order') }}</label>
                        <input value="{{ $obj->sort_order }}" type="number" class="form-control" id="sort_order" name="sort_order" value="{{ old('sort_order') }}"
                            >
                    </div>

                    <div class="col-5">
                        <label class="form-label" for="description">{{ trns('description') }}</label>
                        <textarea type="text" class="form-control" id="description" name="description"
                            required>{{ old('description', $obj->description) }}</textarea>
                    </div>

                     <div class="col-5">
                        <label class="form-label" for="partner_id">{{ trns('partner') }}</label>
                        <select class="form-control" id="partner_id" name="partner_id">
                            <option value="">{{ trns('select_partner') }}</option>
                            @foreach ($partners as $partner)
                                <option value="{{ $partner->id }}"
                                    {{ (old('partner_id') ?? $obj->partner_id) == $partner->id ? 'selected' : '' }}>
                                    {{ $partner->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-5">
                        <label class="form-label" for="collaboration">{{ trns('collaboration') }}</label>
                        <select class="form-control" id="collaborator_ids" name="collaborator_ids[]" multiple>
                            @foreach ($collaborations as $item)
                                <option value="{{ $item->id }}"
                                    {{ (collect(old('collaborator_ids'))->contains($item->id)) || $obj->collaborators->contains($item->id) ? 'selected' : '' }}>
                                    {{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-5">
                        <label class="form-label" for="image">{{ trns('image') }}</label>
                        <input  value="{{ $obj->image }}" class="form-control" type="file" id="image" name="image">
                    </div>


                </div>

                <button type="submit" class="btn btn-primary">{{ trns('update') }}</button>
                <a href="{{ route($route . '.index') }}" class="btn btn-secondary">{{ trns('cancel') }}</a>
            </form>
        </div>
    </div>
@endsection
