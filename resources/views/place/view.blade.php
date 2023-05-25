 @extends('layouts.app')
 @section('content')
     <div class="row">
         <div class="col-sm-3"></div>
         <div class="col-sm-6">
             <br><br>
             @foreach ($branches as $branch)
                 <h3>{{ $branch->name }}</h3>
                 <table class="table table-bordered">
                     <thead>
                         <tr>
                             <th>Place id</th>
                             <td>Zone</th>
                             <td>Chinese place name</th>
                             <td>English place name</th>
                             <td>Branch name</th>
                             <th>Operate</th>
                         </tr>
                     </thead>
                     <tbody>
                         @foreach ($branch->places as $place)
                             <tr>
                                 <td>{{ $place->id }}</td>
                                 <td>{{ $place->zone }}</td>
                                 <td>{{ $place->c_name }}</td>
                                 <td>{{ $place->e_name ? $place->e_name : '-' }}</td>
                                 <td>{{ $place->branches->name }}</td>
                                 @if (isset($place->image))
                                     <td><a class="viewImage" data-toggle="modal"
                                             data-id="{{ asset('place_images') }}/{{ $place->image }}"
                                             data-target="#imageModal">{{ $place->image }}</a></td>
                                 @else
                                     <td style="color:grey;">-</td>
                                 @endif
                                 @if ($place->status == 'exist')
                                     <td><a href="{{ route('place_edit', ['id' => $place->id]) }}"
                                             class="btn btn-warning btn-xs">Edit</a>
                                         <a href="{{ route('place_deactivate', ['id' => $place->id]) }}"
                                             class="btn btn-danger btn-xs"
                                             onClick="return confirm('Are you sure to deactivate?')">Deactivate</a>
                                     </td>
                                 @else
                                     <td><a href="{{ route('place_reactivate', ['id' => $place->id]) }}"
                                             class="btn btn btn-xs" style=" background-color:red;"
                                             onClick="return confirm('Are you sure to reactivate?')">Reactivate</a></td>
                             </tr>
                         @endif
             @endforeach


             </tbody>
             </table>
             @endforeach
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
