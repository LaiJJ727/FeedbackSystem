@extends('layouts.app')
@section('content')
    <div class="container col-sm-12  mt-3">
        <h3>加新标题 Add New Title</h3>
        <form action="{{ route('title_add') }}" method="POST" enctype="multipart/form-data">
            @CSRF
            <div class="form-group">
                <label for="titleCnName">中文标题名称 Chinese Title Name</label>
                <input class="form-control" type="text" id="titleCnName" name="titleCnName">
                @error('titleCnName')
                    <span class="invalid-message" style="color:red;" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    <br>
                @enderror
                <label for="titleEngName">英文标题名称 English Title Name</label>
                <input class="form-control" type="text" id="titleEngName" name="titleEngName">
                @error('titleEngName')
                    <span class="invalid-message" style="color:red;" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    <br>
                @enderror
            <label for="category">Category</label>
            <select name="category" id="category" class="form-control" required>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->c_name }} {{ $category->e_name }}</option>
                @endforeach
            </select>
                <label for="titleImg">图片 Image</label>
                <input type="file" name="titleImg" id="titleImg" class="form-control" />
                @error('titleImg')
                    <span class="invalid-message" style="color:red;" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    <br>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">填加 Add</button>
        </form>
        <div>
        @endsection
