@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-sm-12">
            <h3>Edit Title</h3>
            <form action="{{ route('title_update') }}" method="POST" enctype="multipart/form-data">
                @CSRF
                @foreach ($titles as $title)
                    <div class="form-group">
                        <input type="hidden" name="titleId" value="{{ $title->id }}">
                        <label for="titleName">Title Name</label>
                        <input class="form-control" type="text" id="titleName" name="titleName"   value="{{ $title->name }}" requiered>
                    </div>

                    <button type="submit" class="btn btn-primary">Edit Title</button>
                @endforeach
            </form>
        </div>
    </div>
@endsection
