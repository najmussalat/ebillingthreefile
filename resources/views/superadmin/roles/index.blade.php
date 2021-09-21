
@extends('layouts.superadminMaster')

{{-- page styles --}}
@section('title','Role List')

@section('page-style')
<link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/pages/app-invoice.css')}}">
@endsection

@section('content')

<section class="invoice-list-wrapper section">
 
  <div class="row">
    <div class="col s12">
        <div class="card">
            <div class="card-content">
              <div class="input-field col s12 m9">
                <form>
               
                <input placeholder="Search Any text" id="search" type="text" class="search-box validate white search-circle">
              </form>
            </div>
           
                
                <div class="col s12 m3 l3 input-field">
                  
                    <a href="{{url('superadmin/createaccountrole')}}" class="waves-effect waves-light  btn "><i class="material-icons right">gps_fixed</i> Create New Role</a>
                </div>
              
                <div class="row">
                    <div class="col s12">
                        <table id="page-length-option" class="table invoice-data-table white border-radius-4 pt-1 highlight">
                            <thead>
                        
                                <tr>
                                   
                                    <th>SL</th>
                                    <th>Date</th>
                                    <th>Role</th>
                                    <th>Permission</th>
                                     <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                              @if(count($roles)>0)
                              @foreach ($roles as $role)
                                
                                <tr>
                                  <td>{{++$i}}</td>
                                    <td>{{$role->created_at->diffForHumans()}}</td>
                                    <td>{{$role->name}}</td>
                                   <td>
                                    @foreach($role->permissions as $v)
                    
                                      <label class="">{{@$v->name}},</label>
                    
                                    @endforeach
                    
                                   </td>                    
                                   <td>
                                    <a href="{{url('superadmin/editaccountrole/'.$role->id) }}" class="btn-floating mb-1 waves-effect waves-light">
                                      <i class="material-icons">edit</i>
                                    </a>
                                  </td>
                                   
                                      <td> {!! Form::open(['method' => 'DELETE','url' => ['superadmin/deleteaccountrole', $role->id],'onsubmit' => 'return confirm("are you sure ?")']) !!}
                                        <button type="submit" class="btn-floating mb-1 waves-effect waves-light" >  <i class="material-icons">delete_forever</i></button>
                                        {!! Form::close() !!} </td>
                                        
                                     
                                    
                                </tr>
                               
                               
                            </tbody>
                            <tfoot>
                              @endforeach
                              @else
                             <h3 class="text-danger">Data Not Found</h3>
                             @endif
                            </tfoot>
                        </table>
                    
                    {{ $roles->links() }}
                   
                    </div>
                   
                </div>
            </div>
        </div>
    </div>
</div>

</section>
                
      
  <!-- Modal Structure -->
  <div id="SearchModal" class="modal">
    <div class="modal-content">
      <table class="table table-bordered table-hover">
        <thead>
        <tr>
        <th>ID</th>
        <th>Role</th>
        <th>Permission</th>
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
          url:url+'/superadmin/rolesearch',
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

});
</script>


@endsection