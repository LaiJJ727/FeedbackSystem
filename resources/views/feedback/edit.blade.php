@extends('layouts.app')
@section('content')
    <div class="container col-sm-12   mt-3">
        <h3>更改反馈 Edit Feedback</h3>
        <form action="{{ route('update_feedback') }}" method="POST" enctype="multipart/form-data">
            @CSRF
            <div class="form-group">
                <input class="form-control" type="hidden" id="id" name="id" value="{{ $feedback->id }}" required>
                <label for="place">Place</label>
                <select name="place" id="place" class="form-control" value="{{ $feedback->place }}" required>
                    @foreach ($places as $place)
                        @if ($feedback->place == $place->id)
                            <option value="{{ $place->id }}"selected>{{ $place->name }}</option>
                        @else
                            <option value="{{ $place->id }}">{{ $place->name }}</option>
                        @endif
                    @endforeach
                </select>
                <label for="title">Title</label>
                <select name="title" id="title" class="form-control" value="{{ $feedback->title }}" required>
                    @foreach ($titles as $title)
                        @if ($feedback->title == $title->id)
                            <option value="{{ $title->id }}">{{ $title->name }}</option>
                        @else
                            <option value="{{ $title->id }}">{{ $title->name }}</option>
                        @endif
                    @endforeach
                </select>
                <label for="description">Description</label>
                <input class="form-control" type="text" id="description" name="description"
                    value="{{ $feedback->description }}" required>
                <label for="level">Level</label>
                <select name="level" id="level" class="form-control" required>
                    @if ($feedback->level == 1)
                        <option value="1" selected>Emergency</option>
                        <option value="2">General</option>
                    @else
                        <option value="1">Emergency</option>
                        <option value="2"selected>General</option>
                    @endif
                </select>
                <label for="image">Image</label>
                <input class="form-control" type="file" id="image" name="image">
            </div>
            <button type="submit" class="btn btn-main btn-block">提交 Submit</button>
        </form>
        <script>
        <script>
    @endsection
