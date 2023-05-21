@extends('layouts.app')
@section('content')
    <div class="container col-sm-12   mt-3">
        <h3>Add New Feedback</h3>
        <form action="{{ route('feedback_add') }}" method="POST" enctype="multipart/form-data">
            @CSRF
            <div class="form-group">
                <input class="form-control" type="hidden" id="branch" name="branch" value="{{$branchId}}">
                 <label for="place">Place</label>
                <select name="place" id="place" class="form-control" required>
                    @foreach ($places as $place)
                        <option value="{{ $place->id }}">{{ $place->name }}</option>
                    @endforeach
                </select>
                {{-- <label for="branch">Branch</label>
                <select name="branch" id="branch" class="form-control" required>
                    @foreach ($branches as $branch)
                        <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                    @endforeach
                </select> --}}

                <label for="title">Title</label>
                    <select name="title" id="title" class="form-control" required>
                    @foreach ($titles as $title)
                        <option value="{{ $title->id }}">{{ $title->name }}</option>
                    @endforeach
                </select>
                <label for="description">Description</label>
                <input class="form-control" type="text" id="description" name="description" required>
                <label for="level">Level</label>
                <select name="level" id="level" class="form-control" required>
                    <option value="1">Emergency</option>
                    <option value="2">General</option>
                </select>
                    <label for="image">Image</label>
                    <input class="form-control" type="file" id="image" name="image" required>
            </div>

            <button type="submit" class="btn btn-primary">Add New Feedback</button>
        </form>
    @endsection
