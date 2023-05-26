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
        <h1 style="text-align:center;">My Feeback</h1>
        <div class="row">
                @foreach ($feedbacks as $feedback)
                        <div class="col-sm-3">
                            <div class="card mb-3">
                               <div class="card-header">
                                <p style="margin-bottom:5px !important;">Id: {{ $feedback->id }}</p>
                                <p style="margin-bottom:5px !important;">Date: {{$carbon::parse($feedback->created_at)->format('Y-m-d g:i A')}}</p>
                                <p style="margin-bottom:5px !important;">Place: {{ $feedback->places->name }}</p>
                                <p style="margin-bottom:5px !important;">Branch: {{ $feedback->branches->name }}</p>
                                 <p style="margin-bottom:5px !important;">Title: {{ $feedback->titles->name }}</p>
                            </div>
                                <div class="card-body"><img src="{{ asset('images') }}/{{ $feedback->image }}" alt=""
                                        width="300" class="img-fluid"></div>
                                <div class="card-footer">
                                    <p style="margin-bottom:5px !important;">Description: {{ $feedback->description }}</p>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <p style="margin-bottom:5px !important;"></p>
                                        </div>
                                        <div class="col-sm-6">
                                            <a href="{{ route('edit_feedback', ['id' => $feedback->id]) }}"><button
                                                    class="btn btn-primary">Edit</button></a>
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
