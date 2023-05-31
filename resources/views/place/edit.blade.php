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
                        <label for="zoneName">Zone Name</label>
                        <input class="form-control @error('zoneName') is-invalid @enderror" type="text" id="zoneName"
                            name="zoneName" value="{{ $place->zone }}" required>
                        @error('zoneName')
                            <span class="invalid-message" style="color:red;" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            <br>
                        @enderror
                        <label for="placeCnName">Chinese Place Name</label>
                        <input class="form-control @error('placeCnName') is-invalid @enderror" type="text" id="placeCnName"
                            name="placeCnName" value="{{ $place->c_name }}" required>
                        @error('placeCnName')
                            <span class="invalid-message" style="color:red;" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            <br>
                        @enderror
                        <label for="placeEngName">English Place Name</label>
                        <input class="form-control @error('placeEngName') is-invalid @enderror" type="text" id="placeEngName"
                            name="placeEngName" value="{{ $place->e_name }}">
                        @error('placeEngName')
                            <span class="invalid-message" style="color:red;" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            <br>
                        @enderror
                        <label for="branch">Branch</label>
                        <select name="branch" id="branch" class="form-control" value="{{ $place->branch_id }}" required>
                            @foreach ($branches as $branch)
                                @if ($place->branch_id == $branch->id)
                                    <option value="{{ $branch->id }}"selected>{{ $branch->name }}</option>
                                @else
                                    <option value="{{ $branch->id }}">{{ $branch->name }}</option>
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
