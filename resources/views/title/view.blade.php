 @extends('layouts.app')
 @section('content')
     <div class="container">
         <div class="row">
             <div class="col-sm-1"></div>
             <div class="col-sm-10 mt-sm-5">
                 <div class="table-responsive">
                     <table class="table  table-borderless shadow-sm" id="myTable">
                         <thead>
                             <tr>
                                 <th colspan="7" style="font-size:30px;  border-bottom: 2px solid white !important;"
                                     scope="col">标题 Title</th>
                             </tr>
                             <tr>
                                 <th colspan="7" style="border-bottom: 2px solid white !important;" scope="col">
                                     <div class="input-group">
                                         <div class="input-group-prepend">
                                             <span class="input-group-text" id="basic-addon1"><i
                                                     class="fa fa-search"></i></span>
                                         </div>
                                         <input type="text" class="form-control" id="searchKey"
                                             placeholder="搜索中文名字 Search by chinese name" onkeyup="searchFunction()"
                                             aria-describedby="basic-addon1">
                                     </div>

                                 </th>
                             </tr>
                             <tr>
                                 <th>#</th>
                                 <th>中文名称 Chinese Name</th>
                                 <th>英文名称 English Name</th>
                                 <th>图片 Image</th>
                                 <th class="text-center" colspan="2">操作 Operate</th>
                             </tr>
                         </thead>
                         <tbody>
                             @foreach ($titles as $key => $title)
                                 <tr>
                                     <th>{{$key+1}}</th>
                                     <td>{{ $title->c_name }}</td>
                                     <td>{{ $title->e_name }}</td>
                                     @if (isset($title->image))
                                         <td><a class="viewImage" data-toggle="modal"
                                                 data-id="{{ asset('title_images') }}/{{ $title->image }}"
                                                 data-target="#imageModal">{{ $title->image }}</a></td>
                                     @else
                                         <td style="color:grey;">-</td>
                                     @endif
                                     <td>
                                         <a href="{{ route('title_edit', ['id' => $title->id]) }}"
                                             class="btn btn-warning btn-xs">Edit</a>
                                     </td>
                                     @if ($title->status == 'exist')
                                         <td>
                                             <a href="{{ route('title_deactivate', ['id' => $title->id]) }}"
                                                 class="btn btn-danger btn-xs"
                                                 onClick="return confirm('Are you sure to deactivate?')">Deactivate</a>
                                         </td>
                                 </tr>
                             @else
                                 <td><a href="{{ route('title_reactivate', ['id' => $title->id]) }}"
                                         class="btn btn-success btn-xs"
                                         onClick="return confirm('Are you sure to reactivate?')">Reactivate</a></td>
                                 </tr>
                             @endif
                             @endforeach
                         </tbody>
                     </table>
                 </div>

             </div>
             <div class="col-sm-1"></div>
         </div>
     </div>

     <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
         <div class="modal-dialog">
             <div class="modal-content">
                 <div class="modal-header">
                     <h1 class="modal-title fs-5">Branch Image</h1>
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

         function searchFunction() {
             // Declare variables
             var input, filter, table, tr, td, i, txtValue;
             input = document.getElementById("searchKey");
             filter = input.value.toUpperCase();
             table = document.getElementById("myTable");
             tr = table.getElementsByTagName("tr");

             // Loop through all table rows, and hide those who don't match the search query
             for (i = 0; i < tr.length; i++) {
                 td = tr[i].getElementsByTagName("td")[0];
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
