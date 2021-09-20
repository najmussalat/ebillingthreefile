@extends('layouts.admin')
@section('title', "Admin View")
@section('admin')
<div class="text-right mb-2"><a  class=" btn  btn-success rounde" href="{{url('admin/admin/create')}}">Create New Admin</a></div>
         <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">All Admin Show</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Sl</th>
                      <th>Datetime</th>
                      <th>Name</th>
                      <th>Image</th>
                      <th>Gender</th>
                      <th>Phone</th>
                      <th>Email</th>
                      <th>Role</th>
                      <th>Status</th>
                      <th>Edit</th>
                      <th>Delete</th>
                    </tr>
                  </thead>
                 
                  <tbody>
                         @if(count($admininfo)>0)
                         @foreach ($admininfo as $admin)
                              <?php $imageinfo = pathinfo(url('/storage/profileimage/'.$admin->image)); ?>
                       
                    <tr>
                            <td>{{$loop->index+001}}</td>
                      <td style="10px">{{@$admin->created_at}}</td>
                      <td>{{@$admin->name}}</span></td>
                      
                      <td><a data-lightbox="roadtrip" href="{{@asset('storage/profileimage/'.$admin->image)}}"> <img src="{{url('/storage/profileimage/'.$imageinfo['filename']."_thumb.".$imageinfo['extension'])}}" alt="" height="40px"></a> </td>
                      <td>@if ($admin->gender==1)
                                  <span style="font-size: 2em; color: blue;">
                  <i class="fas fa-male"></i>
                </span>
                
                        
                          @else
                               <span style="font-size: 2em; color: Tomato;">
                  <i class="fas fa-female"></i>
                </span>
                            @endif
                             
               
                      </td>
                      <td>{{@$admin->phone}}</td>
                      <td>{{@$admin->email}}</td>
                      <td>

      @if(!empty($admin->getRoleNames()))

        @foreach($admin->getRoleNames() as $v)

           <label class="badge badge-primary">{{ $v }}</label>

        @endforeach

      @endif

    </td>
                        <td> 

                    <?php 
                    if($admin->status==1){?>
                        <button type="button" class="btn btn-success btn-circle approved" rid="{{$admin->id}}"><i class="fa fa-check-square"></i>  </button>  <?php }
                    else{ ?>
                        <button type="button" class="btn btn-danger btn-circle notapproved" rid="{{$admin->id}}"><i class="fa fa-ban"></i> </button>
                        <?php
    
                    }
    
                     ?>
                  </td>
                  <td>
                        <a href="{{url('admin/admin/'.$admin->id.'/edit') }}" class="btn btn-warning"><i class="fa fa-edit"></i></a> 
                    
                     </td>
                     <td>{!! Form::open(array('route' => array('admin.destroy', $admin->id), 'method' => 'delete')) !!}
                
                       <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')"><i class="fa fa-trash"></i></button>
          
                       {!! Form::close() !!}</td>
                    </tr>
                      @endforeach
                     @else
           <h3 class="text-danger text-center">Admin Not Found</h3>
           @endif
                  </tbody>
                </table>
              </div>
            </div>
          </div>

        </div> 
@endsection
@section('script')
    

    <script>
    
    $(document).ready(function () {
        
        $(".approved").click(function(){
            
            $statusid = $(this).attr('rid');
            console.log($statusid);
            $.ajax({
                type: "post",
                url:url+'/admin/adminstatus',
                data: {
                    id:$statusid,
                    action:"allow"
                },
                dataType: "json",
                success: function (d) {
                    swal(d.message);
                    location.reload();
    
                }
            });
    
        });
    
        $(".notapproved").click(function(){
            $statusid = $(this).attr('rid');
            $.ajax({
                type: "post",
                url:url+'/admin/adminstatus',
                data: {
                    id:$statusid,
                    action:"deny"
                },
                dataType: "json",
                success: function (d) {
                    swal(d.message);
                    location.reload();
    
                }
            });
    
        });
    });
    </script>
@endsection