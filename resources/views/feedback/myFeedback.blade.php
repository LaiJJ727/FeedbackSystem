@extends('layouts.app')

@section('styles')
@endsection

@section('content')
    @inject('carbon', 'Carbon\Carbon')

    <div class="container mt-3">
        <h1 style="text-align:center;">我的反馈 My Feedback</h1>
        <div class="row equal">
            @foreach ($feedbacks as $feedback)
                <div class="col-sm-4 d-flex">
                    <div class="card mb-3 ">
                        <section class="card-header">
                            <img src="{{ asset('images') }}/{{ $feedback->image }}" alt="" class="img-fluid">
                        </section>
                        <div class="card-body flex-fill">
                            <p class="my_id">反馈编号 Feedback Id: {{ $feedback->id }}</p>
                            <p>Date: {{ $feedback->createdAtDiff }}</p>
                            <p class="my_branch">分行 Branch: {{ $feedback->branches->name }}</p>
                            <p>区 Zone:
                                {{ Auth::user()->language == 'Chinese' ? $feedback->zones->c_name : $feedback->zones->e_name }}
                            </p>
                            <p class="my_place">地点 Place:
                                {{ Auth::user()->language == 'Chinese' ? $feedback->places->c_name : $feedback->places->e_name }}
                            </p>
                            <p>种类 Category:
                                {{ Auth::user()->language == 'Chinese' ? $feedback->categories->c_name : $feedback->categories->e_name }}
                            </p>
                            <p>标题 Title:
                                {{ Auth::user()->language == 'Chinese' ? $feedback->titles->c_name : $feedback->titles->e_name }}
                            </p>
                            <p>描述 Description: {{ $feedback->description }}</p>
                            <p>创建人 Created By: {{ $feedback->users->username }}</p>
                            <p class="my_level" style="display: none;">{{ $feedback->feedback_to }}</p>
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('feedback_index_comment', ['id' => $feedback->id]) }}"><button
                                    class="btn btn-main bottom-radius btn-block">评论 Comment</button></a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    </div>
@endsection
