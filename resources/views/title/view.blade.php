 @extends('layouts.app')
 @section('content')
     <div class="row">
         <div class="col-sm-3"></div>
         <div class="col-sm-6">
             <br><br>

             <table class="table  table-borderless shadow-sm">
                 <thead>
                     <tr>
                         <th>中文标题名称 Chinese Title Name</th>
                         <th>英文标题名称 English Title Name</th>
                         <th>图片 Image</th>
                         <th class="text-center" colspan="2">操作 Operate</th>
                     </tr>
                 </thead>
                 <tbody>
                     @foreach ($titles as $title)
                         <tr>
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
                         <td><a href="{{ route('title_reactivate', ['id' => $title->id]) }}" class="btn btn-success btn-xs"
                                 onClick="return confirm('Are you sure to reactivate?')">Reactivate</a></td>
                         </tr>
                     @endif
                     @endforeach


                 </tbody>
             </table>
         </div>
         <div class="col-sm-3"></div>
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
     </script>
 @endsection
