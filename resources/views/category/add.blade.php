@extends('layouts.app')
@section('content')
    <div class="container col-sm-12   mt-3">
        <h3>添加新的类别 Add New Category</h3>
        <form action="{{ route('category_add') }}" method="POST" enctype="multipart/form-data">
            @CSRF
            <div class="form-group">
                <label for="categoryCnName">中文类别名称 Chinese Category Name</label>
                <input class="form-control  @error('categoryCnName') is-invalid @enderror" type="text" id="categoryCnName"
                    name="categoryCnName" value="{{ old('categoryCnName') }}">
                @error('categoryCnName')
                    <span class="invalid-message" style="color:red;" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    <br>
                @enderror
                <label for="categoryEngName">英文类别名称 English Category Name</label>
                <input class="form-control" type="text" id="categoryEngName" name="categoryEngName"
                    value="{{ old('categoryEngName') }}">
            </div>

            <button type="submit" class="btn btn-primary">提交 Submit</button>
        </form>
        <div>
        @endsection
