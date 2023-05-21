@extends('layouts.app')
@section('content')
    <div class="container col-sm-12   mt-3">
        <h3>Select Branch</h3>
        <form action="{{ route('feedback_add_view') }}" method="POST" enctype="multipart/form-data">
            @CSRF
            <div class="form-group">
                <label for="branch">Branch</label>
                <select name="branch" id="branch" class="form-control" required>
                    @foreach ($branches as $branch)
                        <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Enter</button>
        </form>
    @endsection
