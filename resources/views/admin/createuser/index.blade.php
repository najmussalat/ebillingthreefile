
@extends('layouts.adminMaster')

@section('content')
@section('title', "Admin List")
    
                
                        <div class="row">
                          <div class="col s12">
                              <div class="card">
                                  <div class="card-content">
                                    <div class="input-field col s12 m9">
                                      <form>
                                     
                                      <input placeholder="Search" id="search" type="text" class="search-box validate white search-circle">
                                    </form>
                                  </div>
                                 
                                      
                                      <div class="col s12 m3 l3 input-field">
                                        
                                          <a href="{{url('admin/createuser')}}" class="waves-effect waves-light  btn "><i class="material-icons right">gps_fixed</i> Create User</a>
                                      </div>
                                     
                                      <div class="row">
                                          <div class="col s12">
                                              <table id="page-length-option" class="display">
                                                  <thead>
                                              
                                                      <tr>
                                                         
                                                          <th>SL</th>
                                                         <th>Name</th>
                                                          <th>Phone</th>
                                                          <th>Email</th>
                                                          <th>Role</th>
                                                          {{-- <th>Status</th> --}}
                                                          <th>Edit</th>
                                                          <th>Delete</th>
                                                         
                                                      </tr>
                                                  </thead>
                                                  <tbody>
                                                    @if(count($usersinfo)>0)
                                                    @foreach ($usersinfo as $admin)
                                                       <tr>
                                                        <td>{{++$i}}</td>
                                                        
                                                          <td>{{$admin->username}}</td>
                                                          <td>{{@$admin->phone}}</td>
                                                              <td>{{@$admin->email}}</td>
                                                               <td>@if(!empty($admin->getRoleNames()))

                                                            @foreach($admin->getRoleNames() as $v)
                                                    
                                                               <label class="badge badge-primary">{{ $v }}</label>
                                                    
                                                            @endforeach
                                                    
                                                          @endif</td>
                                                     {{-- <td>@if($admin->status==1)
                                                            <button type="button"  class="btn-floating mb-1 waves-effect waves-light approved"  rid="{{$admin->id}}"><i class="material-icons">beenhere</i>   </button>@else
                                                            <button type="button" class="btn-floating mb-1 waves-effect waves-light notapproved"  rid="{{$admin->id}}"><i class="material-icons">block</i> </button>
                                                         @endif</td> --}}
                                                         <td>
                                                          <div class="invoice-action">
                                                              {{-- <a href="https://www.homeobari.com/profile/{{$admin->username}}" target='_blank' class="invoice-action-view mr-4">
                                                                  <i class="material-icons">remove_red_eye</i>
                                                              </a> --}}
                                                              <a  href="{{url('admin/edituser/'.$admin->id) }}" class="invoice-action-edit">
                                                                  <i class="material-icons">edit</i>
                                                              </a>
                                                            
                                                              
                                                            
                                                          </div>
                                                      </td>
                                                         <td> {!! Form::open(['method' => 'DELETE','url' => ['admin/deleteuser/'.$admin->id],'onsubmit' => 'return confirm("are you sure ?")']) !!}
                                                          <button type="submit" class="btn-floating">  <i class="material-icons">delete_forever</i></button>
                                                          {!! Form::close() !!} 
                                                         </td>
                                                                                                       
                                                           
                                                          
                                                      </tr>
                                                     
                                                     
                                                  </tbody>
                                                  <tfoot>
                                                    @endforeach
                                                    @else
                                                   <h3 class="text-danger">Data Not Found</h3>
                                                   @endif
                                                  </tfoot>
                                              </table>
                                          {{ $usersinfo->links() }}
                                          </div>
                                         
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div><!-- START RIGHT SIDEBAR NAV -->


                 
  <!-- Modal Structure -->
  <div id="SearchModal" class="modal">
    <div class="modal-content">
      <table class="table table-bordered table-hover">
        <thead>
        <tr>
        <th>ID</th>
       <th>Name </th>
       <th>Email</th>
       <th>Phone</th>
        <th>Edit</th>
      </tr>
        </thead>
        <tbody id="dd">
        </tbody>
        </table>
    </div>
    <div class="modal-footer">
      <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Close</a>
    </div>
  </div>
@endsection

@section('page-script')

<script>
$(document).ready(function () {

  $('#search').on('keyup',function(){

function timer(){
  $search = $('#search').val();
  $.ajax({
          type: "post",
          url:url+'/admin/searchuser',
          data: {
              id:$search
             
          },
     
          success: function (data) {
            
            $('.modal').modal('open');
            $('#dd').html(data);
            $('#search').val(' ');
          }
     
      });
  }

//setTimeout(myFunc,5000);
setTimeout(timer,3000);   

});
  
  $(".approved").click(function(){
    
      $.ajax({
          type: "post",
          url:url+'/superadmin/adminstatus',
          data: {
              id:$(this).attr('rid'),
              action:"allow"
          },
          dataType: "json",
          success: function (d) {
            swal({
    title: "Nice Work",
    text: "Admin De-Active Successfully",
    timer: 2000,
    buttons: false
  });
    location.reload();

          }
      });

  });

  $(".notapproved").click(function(){

      //console.log($roomid);
      $.ajax({
          type: "post",
          url:url+'/superadmin/adminstatus',
          data: {
              id:$(this).attr('rid'),
              action:"deny"
          },
          dataType: "json",
          success: function (d) {
//             M.toast({
//     html: 'I am a toast!11'
// });
swal({
    title: "Nice Work",
    text: "Admin Active Successfully",
    timer: 2000,
    buttons: false
  });

           //   location.reload();

          }
      });

  });
});
</script>


@endsection

