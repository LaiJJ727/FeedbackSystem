@extends('layouts.app')
@section('content')
    <div class="container col-sm-12   mt-3">
        <h3>Add New Category</h3>
        <form action="{{ route('category_add') }}" method="POST" enctype="multipart/form-data">
            @CSRF
            <div class="form-group">
                <label for="categoryCnName">Chinese Category Name</label>
                <input class="form-control  @error('categoryCnName') is-invalid @enderror" type="text" id="categoryCnName"
                    name="categoryCnName" value="{{ old('categoryCnName') }}">
                @error('categoryCnName')
                    <span class="invalid-message" style="color:red;" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    <br>
                @enderror
                <label for="categoryEngName">English Category Name</label>
                <input class="form-control" type="text" id="categoryEngName" name="categoryEngName"
                    value="{{ old('categoryEngName') }}">
            </div>

            <button type="submit" class="btn btn-primary">Add New Category</button>
        </form>
        <div>
        @endsection
