 @extends('layouts.app')
 @section('content')
     <div class="container px-4">
         <div class="row">
             <div class="card p-0 rounded-4">
                 <div class="card-header">
                     <div class="d-flex w-100">
                         <h2 class="text-center mb-md-3 mt-md-3">分行 Branch</h2>
                         <div class="ms-auto align-self-center">
                             <form action="{{ route('place_search') }}" method="POST" enctype="multipart/form-data">
                                 @csrf
                                 <div class="input-group">
                                     <input type="text" name="keyword" class="form-control" placeholder="搜索分行"
                                         aria-describedby="button-addon2">
                                     <button class="btn btn-main" type="submit" id="button-addon2"><i
                                             class="fa fa-search"></i></button>

                                 </div>
                             </form>
                         </div>
                     </div>
                 </div>
                 <div class="card-body">
                     <div class="row">
                         <div class="col-sm-12 mt-sm-5">
                             <div class="table-responsive">
                                 @foreach ($branches as $branch)
                                     <section class="table_header">
                                         <h1 class="table_header_body"
                                             style="font-size:20px;  border-bottom: 2px solid white !important;"
                                             scope="col"><b>{{ $branch->name }}</b></h1>
                                         <div class="input-group table_header_body">
                                             <div class="input-group-prepend">
                                                 <span class="input-group-text" id="basic-addon1"><i
                                                         class="fa fa-search"></i></span>
                                             </div>
                                             <input type="text" class="form-control clear-border"
                                                 id="searchKey{{ $branch->id }}" placeholder="搜索中文名字 Search by name"
                                                 onkeyup="searchFunction({{ $branch->id }})"
                                                 aria-describedby="basic-addon1">
                                         </div>
                                     </section>
                                     <section class="table_body">
                                         <table class="table table-borderless shadow-sm mb-sm-5"
                                             id="myTable{{ $branch->id }}">
                                             <thead>
                                                 <tr>
                                                     <th>#</th>
                                                     <th>区 Zone</th>
                                                     <th>中文名 Chinese name</th>
                                                     <th>英文名 English name</th>
                                                     <th>分行名 Branch name</th>
                                                     <th>照片 Image</th>
                                                     <th colspan="2" class="text-center">操作 Operate</th>
                                                 </tr>
                                             </thead>
                                             <tbody>
                                                 @if ($branch->places->isNotEmpty())
                                                     @foreach ($branch->places as $key => $place)
                                                         <tr>
                                                             <th>{{ $key + 1 }}</th>
                                                             <td>{{ $place->zones->c_name }} {{ $place->zones->e_name }}</td>
                                                             <td>{{ $place->c_name }}</td>
                                                             <td>{{ $place->e_name ? $place->e_name : '-' }}</td>
                                                             <td>{{ $place->branches->name }}</td>
                                                             @if (isset($place->image))
                                                                 <td><a class="viewImage" data-toggle="modal"
                                                                         data-id="{{ asset('place_images') }}/{{ $place->image }}"
                                                                         data-target="#imageModal">{{ $place->image }}</a>
                                                                 </td>
                                                             @else
                                                                 <td style="color:grey;">-</td>
                                                             @endif
                                                             <td><a href="{{ route('place_edit', ['id' => $place->id]) }}"
                                                                     class="btn btn-warning btn-xs">Edit</a>
                                                             </td>
                                                             @if ($place->status == 'exist')
                                                                 <td>
                                                                     <a href="{{ route('place_deactivate', ['id' => $place->id]) }}"
                                                                         class="btn btn-danger btn-xs"
                                                                         onClick="return confirm('Are you sure to deactivate?')">Deactivate</a>
                                                                 </td>
                                                             @else
                                                                 <td><a href="{{ route('place_reactivate', ['id' => $place->id]) }}"
                                                                         class="btn btn-success btn-xs"
                                                                         onClick="return confirm('Are you sure to reactivate?')">Reactivate</a>
                                                                 </td>
                                                             @endif
                                                         </tr>
                                                     @endforeach
                                                 @else
                                                     <tr>
                                                         <td colspan="8" class="text-center">Empty Place</td>
                                                     </tr>
                                                 @endif
                                             </tbody>
                                         </table>
                                     </section>
                                 @endforeach
                                 <div>
                                 </div>
                             </div>
                         </div>

                     </div>

                 </div>

             </div>

             <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
                 <div class="modal-dialog">
                     <div class="modal-content">
                         <div class="modal-header">
                             <h1 class="modal-title fs-5">Place Image</h1>
                             <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                         </div>
                         <div class="modal-body">
                             <img id="image" alt="" class="img-fluid image">
                         </div>
                     </div>
                 </div>
             </div>
             <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
             <script>
                 //for using bootstrap js need to use '$(document).ready(function (){' and above src to call
                 $(document).ready(function() {
                     //id should be unique so instead of using id it is better to use class
                     $('.viewImage').click(function() {

                         var image = $(this).data('id');
                         console.log(image);
                         $('.image').attr('src', image);
                         $('#imageModal').modal('show');
                     });
                 });

                 function searchFunction($branchId) {
                     // Declare variables
                     var input, filter, table, tr, td, i, txtValue;
                     input = document.getElementById("searchKey" + $branchId);
                     filter = input.value.toUpperCase();
                     table = document.getElementById("myTable" + $branchId);
                     tr = table.getElementsByTagName("tr");

                     // Loop through all table rows, and hide those who don't match the search query
                     for (i = 0; i < tr.length; i++) {
                         td = tr[i].getElementsByTagName("td")[1];
                         if (td) {
                             txtValue = td.textContent || td.innerText;
                             if (txtValue.toUpperCase().indexOf(filter) > -1) {
                                 tr[i].style.display = "";
                             } else {
                                 tr[i].style.display = "none";
                             }
                         }
                     }
                 }
             </script>
         @endsection
