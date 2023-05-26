@extends('layouts.app')
@section('content')
    <div class="container col-sm-12  mt-3">
        <h3>加新标题 Add New Title</h3>
        <form action="{{ route('title_add') }}" method="POST" enctype="multipart/form-data">
            @CSRF
            <div class="form-group">
                <label for="titleName">中文标题名称 Chinese Title Name</label>
                <input class="form-control" type="text" id="titleName" name="titleName">
            </div>
            <div class="form-group">
                <label for="titleEngName">英文标题名称 English Title Name</label>
                <input class="form-control" type="text" id="titleEngName" name="titleEngName">
            </div>
            <button type="submit" class="btn btn-primary">填加 Add</button>
        </form>
        <div>
@endsection
