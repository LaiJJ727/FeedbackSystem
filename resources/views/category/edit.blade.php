@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-sm-12">
            <h3>Edit Category</h3>
            <form action="{{ route('category_update') }}" method="POST" enctype="multipart/form-data">
                @CSRF
                @foreach ($categories as $category)
                    <div class="form-group">
                        <input type="hidden" name="categoryId" value="{{ $category->id }}">
                        <div class="form-group">
                            <label for="categoryCnName">Chinese Category Name</label>
                            <input class="form-control  @error('categoryCnName') is-invalid @enderror" type="text"
                                id="categoryCnName" name="categoryCnName"  value="{{ $category->c_name }}">
                            @error('categoryCnName')
                                <span class="invalid-message" style="color:red;" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                <br>
                            @enderror
                            <label for="categoryEngName">English Category Name</label>
                            <input class="form-control" type="text" id="categoryEngName" name="categoryEngName" 
                                value="{{ $category->e_name }}">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Edit Category</button>
                @endforeach
            </form>
        </div>
    </div>
@endsection
