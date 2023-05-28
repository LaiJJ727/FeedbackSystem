@extends('layouts.app')
@section('content')
    <div class="container col-sm-12   mt-3">
        <h3>Add New Category</h3>
        <form action="{{ route('category_add') }}" method="POST" enctype="multipart/form-data">
            @CSRF
            <div class="form-group">
                <label for="categoryCname">Chinese Category Name</label>
                <input class="form-control  @error('categoryCname') is-invalid @enderror" type="text" id="categoryCname"
                    name="categoryCname" value="{{ old('categoryCname') }}">
                @error('categoryCname')
                    <span class="invalid-message" style="color:red;" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    <br>
                @enderror
                <label for="categoryEname">English Category Name</label>
                <input class="form-control" type="text" id="categoryEname" name="categoryEname"
                    value="{{ old('categoryEname') }}">
            </div>

            <button type="submit" class="btn btn-primary">Add New Category</button>
        </form>
        <div>
        @endsection
