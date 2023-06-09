@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-sm-12">
            <h3>编辑标题 Edit Title</h3>
            <form action="{{ route('title_update') }}" method="POST" enctype="multipart/form-data">
                @CSRF
                @foreach ($titles as $title)
                    <div class="form-group">
                        <input type="hidden" name="titleId" value="{{ $title->id }}">
                        <label for="titleCnName">中文标题名称 Chinese Title Name</label>
                        <input class="form-control" type="text" id="titleCnName" name="titleCnName"
                            value="{{ $title->c_name }}" required>
                        @error('titleCnName')
                            <span class="invalid-message" style="color:red;" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            <br>
                        @enderror
                        <label for="titleEngName">英文标题名称 English Title Name</label>
                        <input class="form-control" type="text" id="titleEngName" name="titleEngName"
                            value="{{ $title->e_name }}">
                        @error('titleEngName')
                            <span class="invalid-message" style="color:red;" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            <br>
                        @enderror
                        <label for="category">类别 Category</label>
                        <select name="category" id="category" class="form-control" value="{{ $title->category_id }}"
                            required>
                            @foreach ($categories as $category)
                                @if ($title->category_id == $category->id)
                                    <option value="{{ $category->id }}" selected>{{ $category->c_name }}
                                        {{ $category->e_name }}</option>
                                @else
                                    <option value="{{ $category->id }}">{{ $category->c_name }} {{ $category->e_name }}
                                    </option>
                                @endif
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
                    <button type="submit" class="btn btn-primary">提交 Submit</button>
                @endforeach
            </form>
        </div>
    </div>
@endsection
