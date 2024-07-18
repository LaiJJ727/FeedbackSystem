@extends('layouts.app')
@section('content')
    <div class="container col-sm-12   mt-3">
        <h3>On Send API Key</h3>
        @if ($check == 'none')
            <form action="{{ route('api_edit') }}" method="POST" enctype="multipart/form-data">
                @CSRF

                <div class="form-group">
                    <label for="key">On Send API</label>
                    <input class="form-control" type="text" id="key" name="key" value="{{ $api }}"
                        readonly>
                </div>
                <h3>Whatsapp Service</h3>
                <div class="form-group">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="radio" name="switch" id="rdoBtnOnsend" value="T" {{ $isOnSend == 'T' ? 'checked' : '' }} disabled="true">
                        <label class="form-check-label" style="opacity: initial; color:black;" for="rdoBtnOnsend">Send Whatsapp With OnSend</label>
                    </div>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="radio" name="switch" id="rdoBtnTwilio" value="F" {{ $isOnSend == 'F' ? 'checked' : '' }} disabled="true">
                        <label class="form-check-label" style="opacity: initial; color:black;" for="rdoBtnTwilio">Send Whatsapp With Twilio</label>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">编辑 Edit</button>


            </form>
        @else
            <form action="{{ route('api_update') }}" method="POST" enctype="multipart/form-data">
                @CSRF
                <div class="form-group">
                    <label for="key">On Send API</label>
                    <input class="form-control" type="text" id="key" name="key" value="{{ $api }}">
                </div>
                <h3>Whatsapp Service</h3>
                <div class="form-group">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="radio" name="switch" id="rdoBtnOnsend" value="T" {{ $isOnSend == 'T' ? 'checked' : '' }}>
                        <label class="form-check-label" for="rdoBtnOnsend">Send Whatsapp With OnSend</label>
                    </div>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="radio" name="switch" id="rdoBtnTwilio" value="F" {{ $isOnSend == 'F' ? 'checked' : '' }}>
                        <label class="form-check-label" for="rdoBtnTwilio">Send Whatsapp With Twilio</label>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">更新 Update</button>
            </form>
        @endif
        <div>
@endsection
