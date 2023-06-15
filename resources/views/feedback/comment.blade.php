@extends('layouts.app')

@section('styles')
    <style>
        .containe {
            text-align: center;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <h2 class="text-center">反馈 Feedback</h2>
        <div class="row">
            <div class="col-sm-2">
            </div>
            <div class="col-12 col-sm-8">
                @if ($feedback)
                    <div class="card">
                        <div class="card-header p-0">
                            <img src="{{ asset('images') }}/{{ $feedback->image }}" alt="" class="img-fluid rounded">
                        </div>
                        <div class="card-body border-bottom">
                            <h5><b>情况 Situation: {{ $feedback->feedback_to }}</b></h5>
                            <p>反馈编号 Feedback Id: {{ $feedback->id }}</p>
                            <p>日期 Date: {{ $feedback->createdAtDiff }}</p>
                            <p>分行 Branch: {{ $feedback->branches->name }}</p>
                            <p>区 Zone:
                                {{ Auth::user()->language == 'Chinese' ? $feedback->zones->c_name : $feedback->zones->e_name }}
                            </p>
                            <p class="my_place">地点 Place:
                                {{ Auth::user()->language == 'Chinese' ? $feedback->places->c_name : $feedback->places->e_name }}
                            </p>
                            <p>类别 Category:
                                {{ Auth::user()->language == 'Chinese' ? $feedback->categories->c_name : $feedback->categories->e_name }}
                            </p>
                            <p>标题 Title:
                                {{ Auth::user()->language == 'Chinese' ? $feedback->titles->c_name : $feedback->titles->e_name }}
                            </p>
                            <p>描述 Description: {{ $feedback->description }}</p>
                            <p>反馈人员 Report Person: {{ $feedback->users->name }}</p>
                            @if ($feedback->status == 0)
                                <p>情况 Status: 新 New</p>
                            @elseif($feedback->status == 1)
                                <p>情况 Status: 搁置 On Hold</p>
                            @elseif ($feedback->status == 2)
                                <p>情况 Status: 待定 Pending</p>
                            @else
                                <p>情况 Status: 完成 Complete</p>
                            @endif
                        </div>
                        <div class="card-footer m-3">
                            <h4>添加新的评论 Add New Comment</h4>
                            <form action="{{ route('add_comment') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{ $feedback->id }}">
                                @if ($feedback->feedback_to == 'Houskeeping' && Auth::user()->role == 'Housekeep')
                                    <label for="status">Status</label>
                                    <select name="status" id="status" class="form-control"
                                        value="{{ $feedback->status }}">
                                        <option disabled selected value>-- 选择一个情况 Select one stauts --</option>
                                        <option value="1">搁置 On Hold</option>
                                        <option value="2">待定 Pending</option>
                                        <option value="3">完成 Complete</option>
                                    </select>
                                @elseif(
                                    (Auth::user()->role == 'Admin' || Auth::user()->role == 'Agent') &&
                                        ($feedback->feedback_to == 'General' || $feedback->feedback_to == 'Emergency'))
                                    <label for="status">情况 Status</label> <small style="color:red"> 非必要选择 Non essential selection</small>
                                    <select name="status" id="status" class="form-control"
                                        value="{{ $feedback->status }}">
                                        <option disabled selected value>-- 选择一个情况 Select one stauts --</option>
                                        <option value="1"  @if (old('status') == '1') selected @endif>搁置 On Hold</option>
                                        <option value="2" @if (old('status') == '2') selected @endif>待定 Pending</option>
                                        <option value="3" @if (old('status') == '3') selected @endif>完成 Complete</option>
                                    </select>
                                @endif
                                <label for="description">评论 Comment</label>
                                <input class="form-control  @error('description') is-invalid @enderror" id="description" name="description" value="">
                                @error('description')
                                    <span class="invalid-message" style="color:red;" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    <br>
                                @enderror
                                <label for="image">图片 Image</label><small style="color:red"> 非必要选择 Non essential selection</small>
                                <input class="form-control  @error('image') is-invalid @enderror" type="file" id="image" name="image"> 
                                @error('image')
                                    <span class="invalid-message" style="color:red;" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    <br>
                                @enderror
                                <button class="btn btn-main btn-lg btn-block mt-3 mb-3">发送 Send</button>
                                <form>
                        </div>
                    </div>
            </div>
            @endif
            <div class="col-sm-2">
            </div>
            <div class="mb-2 mb-sm-3">
            </div>
            <div class="col-sm-2">
            </div>
            <div class="col-12 col-sm-8">
                <h5><strong>历史评论 History Comment<strong></h5>
                @if ($feedback)
                    @foreach ($feedback->comments as $comment)
                        <div class="card">
                            <div class="card-header m-3">

                                <div>{{ $comment->createdAtDiff }}
                                    @if ($comment->click_status == 1)
                                        <strong class="py-1" style="border: 5px; background-color:red;">#搁置 On
                                            Hold</strong>
                                    @elseif ($comment->click_status == 2)
                                        <strong class="p-1" style="border: 5px; background-color:yellow; color:black">#待定
                                            Pending</strong>
                                    @elseif ($comment->click_status == 3)
                                        <strong class="p-1" style="border: 5px; background-color:green;">#完成
                                            Complete</strong>
                                    @endif
                                </div>
                            </div>
                            <div class="card-body">
                                @if ($comment->image != '')
                                    <img src="{{ asset('comment_images/') }}/{{ $comment->image }}" alt=""
                                        class="img-fluid">
                                @endif
                                <p>{{ $comment->users->name }}: {{ $comment->description }}</p>
                            </div>
                        </div>
                    @endforeach
            </div>
            @endif
            <div class="col-sm-2">
            </div>
        </div>
    </div>
@endsection
