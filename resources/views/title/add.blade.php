@extends('layouts.app')
@section('content')
    <div class="container col-sm-12  mt-3">
        <h3>加新标题 Add New Title</h3>
        <form action="{{ route('title_add') }}" method="POST" enctype="multipart/form-data">
            @CSRF
            <div class="form-group">
                <label for="titleCnName">中文标题名称 Chinese Title Name</label>
                <input class="form-control  @error('titleCnName') is-invalid @enderror" type="text" id="titleCnName" name="titleCnName" value="{{ old('titleCnName') }}">
                @error('titleCnName')
                    <span class="invalid-message" style="color:red;" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    <br>
                @enderror
                <label for="titleEngName">英文标题名称 English Title Name</label>
                <input class="form-control" type="text" id="titleEngName" name="titleEngName">
            <label for="category">类别 Category</label>
            <select name="category" id="category" class="form-control" required>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->c_name }} {{ $category->e_name }}</option>
                @endforeach
            </select>
                <label for="titleImg">图片 Image</label>
                <input type="file" name="titleImg" id="titleImg" class="form-control @error('titleImg') is-invalid @enderror" />
                @error('titleImg')
                    <span class="invalid-message" style="color:red;" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    <br>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">提交 Submit</button>
        </form>
        <div>
        @endsection
