@extends('layouts.app')
@section('content')
    <div class="container col-sm-12   mt-3">
        <h3>Add New Place</h3>
        <form action="{{ route('place_add') }}" method="POST" enctype="multipart/form-data">
            @CSRF
            <div class="form-group">
                <label for="placeName">Place Name</label>
                <input class="form-control" type="text" id="placeName" name="placeName">
                <label for="branch">Branch</label>
                <select name="branch" id="branch" class="form-control" required>
                    @foreach ($branches as $branch)
                        <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Add New Place</button>
        </form>
        <div>
@endsection
