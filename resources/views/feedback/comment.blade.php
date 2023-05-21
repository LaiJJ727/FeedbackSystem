@extends('layouts.app')

@section('styles')
    <style>
        .containe {
            text-align: center;
        }
    </style>
@endsection

@section('content')
    @inject('carbon', 'Carbon\Carbon')
    <div class="container my-5 mt-3 ">
        <div class="card">
            <h2 style="text-align: center;">Feedback</h2>
            <div class="row" style="text-align: center;">
                <div class="col-sm-12">
                    <div class="card m-3 ">
                        @if ($feedback)
                            <div class="card-header">
                                <p style="margin-bottom:5px !important;">Date:
                                    {{ $carbon::parse($feedback->created_at)->format('Y-m-d g:i A') }}</p>
                                <p style="margin-bottom:5px !important;">Place: {{ $feedback->branches->name }}</p>
                            </div>
                            <div class="card-body"><img src="{{ asset('images') }}/{{ $feedback->image }}" alt=""
                                    width="500" class="img-fluid">
                                <p style="margin-bottom:5px !important;">Place: {{ $feedback->places->name }}</p>
                                @if ($feedback->level == 1)
                                    <p style="margin-bottom:5px !important;">Level: Emergency</p>
                                @else
                                    <p style="margin-bottom:5px !important;">Status: General</p>
                                @endif
                                <p style="margin-bottom:5px !important;">Description: {{ $feedback->description }}</p>
                                <p style="margin-bottom:5px !important;">Report Person: {{ $feedback->users->name }}</p>

                            </div>
                    </div>
                </div>
                @endif
            </div>
            @if (Auth::user()->role == 0)
                <div class="card m-3">
                    <div class="row">
                        <div class="col-sm-12">
                            <form action="{{ route('add_comment') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{ $feedback->id }}" required>
                                <h2 style="text-align: center;">Comment</h2>
                                <!--For Loop the exisiting comment-->
                                @foreach ($feedback->comments as $comment)
                                    <p>{{ $carbon::parse($comment->created_at)->format('Y-m-d g:i A') }}-
                                        {{ $comment->users->name }}: {{ $comment->description }}</p>
                                    @if ($comment->image != '')
                                        <img src="{{ asset('comment_images/') }}/{{ $comment->image }}" alt=""
                                            width="300" class="img">
                                    @endif
                                    <hr>
                                @endforeach
                                <!--end for loop-->
                                <label for="description">Comment</label>
                                <input class="form-control" id="description" name="description" value="">
                                <label for="image">Image</label>
                                <input class="form-control" type="file" id="image" name="image">
                                <button class="btn btn-primary  btn-lg btn-block mt-3 mb-3">Save</button>
                                <form>

                        </div>
                        <div>
                        </div>
                    @else
                        <div class="card m-3">
                            <div class="row">
                                <div class="col-sm-12">
                                    <form action="{{ route('add_comment') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div style="margin:2%;">
                                            @if (Auth::user()->role == 1 || 2)
                                                <label for="status">Status</label>
                                                <select name="status" id="status" class="form-control"
                                                    value="{{ $feedback->status }}" required>
                                                    <option value="1">On Hold</option>
                                                    <option value="2">Complete</option>
                                                    <option value="3">Pending</option>
                                                </select>
                                            @endif
                                            <input type="hidden" name="id" value="{{ $feedback->id }}">
                                            <h2 style="margin-top: 15px;">Comment</h2>
                                            <!--For Loop the exisiting comment-->
                                            @foreach ($feedback->comments as $comment)
                                                <p>{{ $carbon::parse($comment->created_at)->format('Y-m-d g:i A') }}-
                                                    {{ $comment->users->name }}: {{ $comment->description }}</p>
                                                @if ($comment->image != '')
                                                    <img src="{{ asset('comment_images/') }}/{{ $comment->image }}"
                                                        alt="" width="300" class="img">
                                                @endif
                                                <hr>
                                            @endforeach
                                            <!--end for loop-->
                                            <label for="description">Comment</label>
                                            <input class="form-control" id="description" name="description" value="" required>
                                            <label for="image">Image</label>
                                            <input class="form-control" type="file" id="image" name="image">
                                            <button class="btn btn-primary  btn-lg btn-block mt-3 mb-3">Save</button>
                                        </div>
                                        <form>

                                </div>
                                <div>
                                    <div>
            @endif
        </div>
    </div>
@endsection
