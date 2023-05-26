 @extends('layouts.app')
 @section('content')
     <div class="container">

         <div class="row">
             <div class="col-sm-1"></div>

             <div class="col-sm-10 mt-sm-5">
                 <div class="table-responsive">
                     <table class="table table-borderless shadow-sm">
                         <thead>
                             <tr>
                                 <th scope="col">#</th>
                                 <th scope="col">Bracnh name</th>
                                 <th scope="col">Address</th>
                                 <th scope="col">Description</th>
                                 <th scope="col">Image</th>
                                 <th scope="col" class="text-center" colspan="2">Operate</th>
                             </tr>
                         </thead>
                         <tbody>
                             @foreach ($branches as $key => $branch)
                                 <tr>
                                     <th scope="row">{{ $key + 1 }}</th>
                                     <td>{{ $branch->name }}</td>
                                     <td>{{ $branch->address }}</td>
                                     <td>{{ $branch->description ? $branch->description : '-' }}</td>
                                     @if (isset($branch->image))
                                         <td><a class="viewImage" data-toggle="modal"
                                                 data-id="{{ asset('images') }}/{{ $branch->image }}"
                                                 data-target="#imageModal">{{ $branch->image }}</a></td>
                                     @else
                                         <td style="color:grey;">-</td>
                                     @endif
                                     <td class="border: 5px !important"><a
                                             href="{{ route('branch_edit', ['id' => $branch->id]) }}"
                                             class="btn btn-warning btn-xs">Edit</a>
                                     </td>
                                     @if ($branch->status == 'exist')
                                         <td><a href="{{ route('branch_deactivate', ['id' => $branch->id]) }}"
                                                 class="btn btn-danger btn-xs"
                                                 onClick="return confirm('Are you sure to deactivate?')">Deactivate</a></td>
                                     @else
                                         <td><a href="{{ route('branch_reactivate', ['id' => $branch->id]) }}"
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
                     <img alt="" class="img-fluid image">
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
                 $('.image').attr('src', image);
                 $('#imageModal').modal('show');
             });
         });
     </script>
 @endsection
