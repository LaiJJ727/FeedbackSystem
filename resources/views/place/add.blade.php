@extends('layouts.app')
@section('content')
    <div class="container col-sm-12 mt-3">
        <h3>Add New Place</h3>
        <form action="{{ route('place_add') }}" method="POST" enctype="multipart/form-data">
            @CSRF
            <div class="form-group">
                <label for="zoneName">Zone Name</label>
                <input class="form-control  @error('zoneName') is-invalid @enderror" type="text" id="zoneName"
                    name="zoneName" value="{{ old('zoneName') }}">
                @error('zoneName')
                    <span class="invalid-message" style="color:red;" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    <br>
                @enderror
                <label for="placeCname">Chinese Place Name</label>
                <input class="form-control  @error('placeCname') is-invalid @enderror" type="text" id="placeCname"
                    name="placeCname" value="{{ old('placeCname') }}">
                @error('placeCname')
                    <span class="invalid-message" style="color:red;" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    <br>
                @enderror
                <label for="placeEname">English Place Name</label>
                <input class="form-control" type="text" id="placeEname" name="placeEname"
                    value="{{ old('placeEname') }}">
                <label for="branch">Branch</label>
                <select name="branch" id="branch" class="form-control" required>
                    @foreach ($branches as $branch)
                        <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                    @endforeach
                </select>
                <label for="placeImage">Image</label>
                <input type="file" name="placeImage" id="placeImage" class="form-control" />
                @error('placeImage')
                    <span class="invalid-message" style="color:red;" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    <br>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Add New Place</button>
        </form>
        <div>
        @endsection
