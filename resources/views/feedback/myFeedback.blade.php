@extends('layouts.app')

@section('styles')
    <style>
        .container {
            background-color: ;
        }
    </style>
@endsection

@section('content')
    @inject('carbon', 'Carbon\Carbon')

    <div class="container mt-3">
        <h1 style="text-align:center;">我的反馈 My Feeback</h1>
        <div class="row">
            @foreach ($feedbacks as $feedback)
                <div class="col-sm-4">
                    <div class="card mb-3">
                        <div class="card-header">
                            <img src="{{ asset('images') }}/{{ $feedback->image }}" alt="" class="img-fluid">
                        </div>
                        <div class="card-body">
                            <p>Feedback Id: {{ $feedback->id }}</p>
                            <p>Date: {{ $feedback->createdAtDiff }}</p>
                            <p>Branch: {{ $feedback->branches->name }}</p>
                            <p>Place: {{ $feedback->places->c_name }} {{ $feedback->places->e_name }}</p>
                            <p>Title: {{ $feedback->titles->c_name }} {{ $feedback->titles->e_name }}</p>
                            <p>Description: {{ $feedback->description }}</p>
                            <p>Report Person: {{ $feedback->users->name }}</p>
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-12">
                                    <a href="{{ route('edit_feedback', ['id' => $feedback->id]) }}"
                                        class="btn btn-warning clear-radius btn-block">更改
                                        Edit</a>
                                </div>
                                <div class="col-12">
                                    <a href="{{ route('feedback_index_comment', ['id' => $feedback->id]) }}"
                                        class="btn btn-main bottom-radius btn-block">评论 Comment</a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    </div>
@endsection
