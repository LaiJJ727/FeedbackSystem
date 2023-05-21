@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-sm-12">
            <h3>Edit Place</h3>
            <form action="{{ route('place_update') }}" method="POST" enctype="multipart/form-data">
                @CSRF
                @foreach ($places as $place)
                    <div class="form-group">
                        <input type="hidden" name="placeId" value="{{ $place->id }}">
                        <label for="placeName">Place Name</label>
                        <input class="form-control" type="text" id="placeName" name="placeName"
                            value="{{ $place->name }}" requiered>
                        <label for="branch">Branch</label>
                        <select name="branch" id="branch" class="form-control" value="{{ $place->branch_id }}"
                            readonly>
                            @foreach ($branches as $branch)
                                @if ($place->branch_id == $branch->id)
                                    <option hidden value="{{ $branch->id }}"selected>{{ $branch->name }}</option>
                                @else
                                    <option hidden value="{{ $branch->id }}">{{ $branch->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Edit Place</button>
                @endforeach
            </form>
        </div>
    </div>
@endsection
