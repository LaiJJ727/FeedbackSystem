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
                        <label for="titleName">中文标题名称 Chinese Title Name</label>
                        <input class="form-control" type="text" id="titleName" name="titleName" value="{{ $title->c_name }}" requiered>
                        <label for="engTitleName">英文标题名称 English Title Name</label>
                        <input class="form-control" type="text" id="engTitleName" name="engTitleName" value="{{ $title->e_name }}">
                    </div>
                    <button type="submit" class="btn btn-primary">编辑 Edit</button>
                @endforeach
            </form>
        </div>
    </div>
@endsection
