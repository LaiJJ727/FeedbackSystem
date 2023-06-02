@extends('layouts.app')
@section('content')
    <div class="container col-sm-12   mt-3">
        <h3>添加新的反馈 Add New Feedback</h3>
        <form action="{{ route('feedback_add') }}" method="POST" enctype="multipart/form-data">
            @CSRF
            <div class="form-group">
                <input class="form-control" type="hidden" id="branch" name="branch" value="{{ $branch->id }}">
                <label for="branchName">分行 Branch</label>
                <input class="form-control" type="text" id="branchName" name="branchName" value="{{ $branch->name }}"
                    disabled>
                <label for="place">地点 Place</label>
                <select name="place" id="place" class="form-control @error('place') is-invalid @enderror">
                    <option disabled selected value>-- 选择一个地点 Select one place --</option>
                    @foreach ($places as $place)
                        <option value="{{ $place->id }}">
                            {{ Auth::user()->language == 'Chinese' ? $place->c_name : $place->e_name }}</option>
                    @endforeach
                </select>
                @error('place')
                    <span class="invalid-message" style="color:red;" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    <br>
                @enderror
                <label for="category">类别 Category</label>
                <select name="category" id="category" class="form-control @error('category') is-invalid @enderror"
                    value="">
                    <option disabled selected value>-- 选择一个类别 Select one category --</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">
                            {{ Auth::user()->language == 'Chinese' ? $category->c_name : $category->e_name }}</option>
                    @endforeach
                </select>
                @error('category')
                    <span class="invalid-message" style="color:red;" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    <br>
                @enderror
                <label for="title">标题 Title</label>
                <select name="title" id="title" class="form-control @error('title') is-invalid @enderror" required>
                    <option disabled selected value>-- 选择一个标题 Select one title --</option>
                    @foreach ($titles as $title)
                        <option value="{{ $title->id }}">
                            {{ Auth::user()->language == 'Chinese' ? $title->c_name : $title->e_name }}</option>
                    @endforeach
                </select>
                @error('title')
                    <span class="invalid-message" style="color:red;" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    <br>
                @enderror
                <label for="description">描述 Description</label>
                <input class="form-control @error('description') is-invalid @enderror" type="text" id="description"
                    name="description" value="">
                <small>选择填充 Quick Description [<a onclick="autoFill('请打扫 Please Cleaning')" href="#">请打扫 Please
                        Cleaning</a>] [<a onclick="autoFill('故障请安排维修 Broken Please Arrange Fix')" href="#">故障请安排维修
                        Broken Please Arrange Fix</a>]</small>
                <br>
                @error('description')
                    <span class="invalid-message" style="color:red;" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    <br>
                @enderror
                <label for="feedbackTo">情况 Situation</label>
                <select name="feedbackTo" id="feedbackTo" class="form-control @error('feedbackTo') is-invalid @enderror">
                    <option disabled selected value>-- 选择一个情况 Select one situation --</option>
                    <option value="Emergency">紧急 Emergency</option>
                    <option value="General">普通 General</option>
                    <option value="Housekeeping">保洁 Housekeeping</option>
                </select>
                @error('feedbackTo')
                    <span class="invalid-message" style="color:red;" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    <br>
                @enderror
                <label for="image">图片 Image</label>
                <input class="form-control @error('image') is-invalid @enderror" type="file" id="image"
                    name="image">
                @error('image')
                    <span class="invalid-message" style="color:red;" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    <br>
                @enderror
            </div>
            <button type="submit" class="btn btn-main btn-block">提交 Submit</button>


        </form>
    </div>
    <script>
        document.getElementById("title").disabled = true;

        function autoFill(text) {
            document.getElementById('description').value = document.getElementById('description').value + text;
        };
        document.getElementById('category').addEventListener('change', function() {
            var selectedCategory = this.value;
            var selectTitleElement = document.getElementById("title");
            document.getElementById("title").disabled = false;
            var options = selectTitleElement.options; // get the options of the select element
            for (let i = options.length - 1; i >= 1; i--) {
                // loop through the options in reverse order (excluding the first option)
                options[i].remove(); // remove the current option
            }
            //get title data
            var titlesData = {!! json_encode($titles->toArray()) !!};
            //get user data
            var userData = {!! json_encode(Auth::user()->toArray()) !!};

            for (let i = 0; i < titlesData.length; i++) {
                if (selectedCategory == titlesData[i].category_id) {
                    var option = document.createElement("option");
                    option.value = titlesData[i].id;
                    option.text = userData.language == 'Chinese' ? titlesData[i].c_name : titlesData[i]
                        .e_name;
                    document.getElementById("title").appendChild(option);
                }
            }
        });
    </script>
@endsection
