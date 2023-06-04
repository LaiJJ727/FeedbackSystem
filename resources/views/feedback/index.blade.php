@extends('layouts.app')

@section('styles')
    <style>
        .container {
            background-color: ;
        }
    </style>
@endsection

@section('content')
    <div class="container mt-3">
        <h1 style="text-align:center;">Emergency</h1>
        <div class="row">
            @foreach ($feedbacks as $feedback)
                @if ($feedback->feedback_to == 'Emergency')
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
                                <a href="{{ route('feedback_index_comment', ['id' => $feedback->id]) }}"><button
                                        class="btn btn-main bottom-radius btn-block">Comment</button></a>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach

        </div>
        <h1 style="text-align:center;">General</h1>
        <div class="row">
            @foreach ($feedbacks as $feedback)
                @if ($feedback->feedback_to == 'General')
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
                                <a href="{{ route('feedback_index_comment', ['id' => $feedback->id]) }}"><button
                                        class="btn btn-main bottom-radius btn-block">Comment</button></a>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>

        <h1 style="text-align:center;">Housekeeping</h1>
        <div class="row">
            @foreach ($feedbacks as $feedback)
                @if ($feedback->feedback_to == 'Housekeeping')
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
                                <a href="{{ route('feedback_index_comment', ['id' => $feedback->id]) }}"><button
                                        class="btn btn-main bottom-radius btn-block">Comment</button></a>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>

    </div>
@endsection
