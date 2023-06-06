@extends('layouts.app')
@section('content')
    <div class="container col-sm-12   mt-3">
        <h3>添加新的反馈 Add New Feedback</h3>
        <form action="{{ route('feedback_add') }}" method="POST" enctype="multipart/form-data">
            @CSRF
            <div class="form-group">
                <label for="branch">分行 Branch</label>
                <div class="dropdown">
                    <button class="btn btn-secondary btn-block bg-transparent"
                        style="color:black; text-align:left; border: 1px solid #ced4da" type="button" id="dropdownMenuButton"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        @if (Auth::user()->branch_id == 'all')
                            @if (old('branch_id'))
                                @foreach ($branches as $branch)
                                    @if (old('branch_id') == $branch->id)
                                        <input type="hidden" id="branch_id" name="branch_id" value="{{ $branch->id }}">
                                        <a id="branch">{{ $branch->name }}</a>
                                    @endif
                                @endforeach
                            @else
                                <input type="hidden" id="branch_id" name="branch_id" value="">
                                <a id="branch">-- 选择一个分行 Select one branch --</a>
                            @endif
                        @else
                            @foreach ($branches as $branch)
                                @if (old('branch_id'))
                                    @if (old('branch_id') == $branch->id)
                                        <input type="hidden" id="branch_id" name="branch_id" value="{{ $branch->id }}">
                                        <a id="branch">{{ $branch->name }}</a>
                                    @endif
                                @else
                                    @if ($branch->id == Auth::user()->branch_id)
                                        <input type="hidden" id="branch_id" name="branch_id" value="{{ $branch->id }}">
                                        <a id="branch">{{ $branch->name }}</a>
                                    @endif
                                @endif
                            @endforeach
                        @endif
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="width: 100%;">
                        @foreach ($branches as $branch)
                            <a class="dropdown-item border-bottom text-center" href="#"
                                onclick="selectBranch({{ $branch->id }})"><img
                                    src="{{ asset('branch_images') }}/{{ $branch->image ? $branch->image : 'null.png' }}"
                                    alt="" class="img-fluid" style="height: 100px;"><br>{{ $branch->name }}</a>
                        @endforeach
                    </div>
                </div>
                @error('branch_id')
                    <span class="invalid-message" style="color:red;" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    <br>
                @enderror
                <label for="zone">区 Zone</label>
                <select name="zone" id="zone" class="form-control @error('zone') is-invalid @enderror"
                    value="{{ old('zone') }}">
                    <option disabled selected value>-- 选择一个区 Select one zone --</option>
                    @foreach ($zones as $zone)
                        <option value="{{ $zone->id }}">
                            {{ Auth::user()->language == 'Chinese' ? $zone->c_name : $zone->e_name }}</option>
                    @endforeach
                </select>
                @error('zone')
                    <span class="invalid-message" style="color:red;" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    <br>
                @enderror
                <label for="place">地点 Place</label>
                <select name="place" id="place" class="form-control @error('place') is-invalid @enderror"
                    value="{{ old('place') }}">
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
                    value="{{ old('category') }}">
                    <option disabled selected value>-- 选择一个类别 Select one category --</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @if (old('category') == $category->id) selected @endif>
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
                <select name="title" id="title" class="form-control @error('title') is-invalid @enderror"
                    value="{{ old('title') }}">
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
                    name="description" value="{{ old('description') }}">
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
                <select name="feedbackTo" id="feedbackTo" class="form-control @error('feedbackTo') is-invalid @enderror"
                    value="{{ old('feedbackTo') }}">
                    <option disabled selected value>-- 选择一个情况 Select one situation --</option>
                    <option value="Emergency" @if (old('feedbackTo') == 'Emergency') selected @endif>紧急 Emergency</option>
                    <option value="General" @if (old('feedbackTo') == 'General') selected @endif>普通 General</option>
                    <option value="Housekeeping" @if (old('feedbackTo') == 'Housekeeping') selected @endif>保洁 Housekeeping
                    </option>
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
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    <script>
        var oldInput = @json(old());
        console.log(oldInput);
        document.getElementById("zone").disabled = true;
        document.getElementById("place").disabled = true;
        document.getElementById("title").disabled = true;

        var userData = {!! json_encode(Auth::user()->toArray()) !!};
        //return old value checking
        if (document.getElementById("branch_id").value) {
            console.log("branch_id: " + document.getElementById('branch_id').value);
            var zoneData = {!! json_encode($zones->toArray()) !!};
            document.getElementById("zone").disabled = false;
            var selectZoneElement = document.getElementById("zone");
            var options = selectZoneElement.options; // get the options of the select element
            for (let i = options.length - 1; i >= 1; i--) {
                // loop through the options in reverse order (excluding the first option)
                options[i].remove(); // remove the current option
            }
            for (let i = 0; i < zoneData.length; i++) {
                if (document.getElementById("branch_id").value == zoneData[i].branch_id) {
                    var option = document.createElement("option");
                    option.value = zoneData[i].id;
                    if (option.value == oldInput.zone) {
                        option.selected = true;
                    }
                    option.text = userData.language == 'Chinese' ? zoneData[i].c_name : zoneData[i]
                        .e_name;
                    document.getElementById("zone").appendChild(option);
                }
            }
        }
        //return old value checking
        if (oldInput.zone) {
            var selectPlaceElement = document.getElementById("place");
            document.getElementById("place").disabled = false;
            var options = selectPlaceElement.options; // get the options of the select element
            for (let i = options.length - 1; i >= 1; i--) {
                // loop through the options in reverse order (excluding the first option)
                options[i].remove(); // remove the current option
            }
            //get place data
            var placeData = {!! json_encode($places->toArray()) !!};
            //get user data

            for (let i = 0; i < placeData.length; i++) {
                if (oldInput.zone == placeData[i].zone_id) {
                    var option = document.createElement("option");
                    option.value = placeData[i].id;
                    if (option.value == oldInput.place) {
                        option.selected = true;
                    }
                    option.text = userData.language == 'Chinese' ? placeData[i].c_name : placeData[i]
                        .e_name;
                    document.getElementById("place").appendChild(option);
                }
            }
        }
        //return old value checking
        if (oldInput.category) {
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

            for (let i = 0; i < titlesData.length; i++) {
                if (oldInput.category == titlesData[i].category_id) {
                    var option = document.createElement("option");
                    option.value = titlesData[i].id;
                    if (option.value == oldInput.title) {
                        option.selected = true;
                    }
                    option.text = userData.language == 'Chinese' ? titlesData[i].c_name : titlesData[i]
                        .e_name;
                    document.getElementById("title").appendChild(option);
                    //document.getElementById("title").selectedIndex = oldInput.title;
                }
            }
        }

        //fill select branch function
        function selectBranch(branch_id) {
            var branchesData = {!! json_encode($branches->toArray()) !!};
            for (let i = 0; i < branchesData.length; i++) {
                if (branchesData[i].id == branch_id) {
                    document.getElementById('branch_id').value = branch_id;
                    console.log("branch_id(change to): " + branch_id);
                    document.getElementById("branch").innerHTML = branchesData[i].name;

                    var zoneData = {!! json_encode($zones->toArray()) !!};
                    document.getElementById("zone").disabled = false;
                    var selectZoneElement = document.getElementById("zone");
                    var options = selectZoneElement.options; // get the options of the select element
                    for (let i = options.length - 1; i >= 1; i--) {
                        // loop through the options in reverse order (excluding the first option)
                        options[i].remove(); // remove the current option
                    }
                    for (let i = 0; i < zoneData.length; i++) {
                        if (branch_id == zoneData[i].branch_id) {
                            var option = document.createElement("option");
                            option.value = zoneData[i].id;
                            option.text = userData.language == 'Chinese' ? zoneData[i].c_name : zoneData[i]
                                .e_name;
                            document.getElementById("zone").appendChild(option);
                        }
                    }
                }
            }
        };
        // filter place function
        document.getElementById('zone').addEventListener('change', function() {
            var selectedZone = this.value;
            console.log("zone_id(change):" + selectedZone);
            var selectPlaceElement = document.getElementById("place");
            document.getElementById("place").disabled = false;
            var options = selectPlaceElement.options; // get the options of the select element
            for (let i = options.length - 1; i >= 1; i--) {
                // loop through the options in reverse order (excluding the first option)
                options[i].remove(); // remove the current option
            }
            //get place data
            var placeData = {!! json_encode($places->toArray()) !!};
            //get user data

            for (let i = 0; i < placeData.length; i++) {
                if (selectedZone == placeData[i].zone_id) {
                    var option = document.createElement("option");
                    option.value = placeData[i].id;
                    option.text = userData.language == 'Chinese' ? placeData[i].c_name : placeData[i]
                        .e_name;
                    document.getElementById("place").appendChild(option);
                }
            }
        });

        // filter title function
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

        //description function
        function autoFill(text) {
            document.getElementById('description').value = document.getElementById('description').value + text;
        };
    </script>
@endsection
