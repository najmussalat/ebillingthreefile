
@extends('layouts.adminMaster')
@section('title', "Payment Method List")
@section('content')

{{-- @can('Package-Create')  --}}
                
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
                                        
                                          <a href="{{url('admin/createpayby')}}" class="waves-effect waves-light  btn "><i class="material-icons right">gps_fixed</i> Create  Payment</a>
                                      </div>
                                     
                                      <div class="row">
                                          <div class="col s12">
                                              <table id="page-length-option" class="display responsive-table">
                                                  <thead>
                                              
                                                      <tr>
                                                         <td>SL</td>
                                                   
                                                          <th>Payby </th>
                                                         <th>Description</th>
                                                         <th>Edit</th>
                                                          <th>Delete</th>
                                                      </tr>
                                                  </thead>
                                                  <tbody>
                                                    @if(count($infos)>0)
                                                    @foreach ($infos as $info)
                                                       <tr>
                                                            <td>{{++$i}}</td>
                                                         
                                                          <td>{{$info->paybyname}}</td>
                                                         <td>{{@$info->description}}</td>
                                                          
                                                         <td>
                                                          <a href="{{url('admin/editpayby/'.$info->id) }}" class="btn-floating mb-1 waves-effect waves-light">
                                                            <i class="material-icons">edit</i>
                                                          </a>
                                                        </td>
                                                         
                                                            <td> {!! Form::open(['method' => 'DELETE','url' => ['admin/deletepayby/'. $info->id],'onsubmit' => 'return confirm("are you sure ?")']) !!}
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
                                          {{ $infos->links() }}
                                          </div>
                                         
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                 
                 
  <!-- Modal Structure -->
  <div id="SearchModal" class="modal">
    <div class="modal-content">
      <table class="table table-bordered table-hover">
        <thead>
        <tr>
        <th>ID</th>
       <th>Payby </th>
       <th>Description </th>
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


  {{-- @endcan --}}
@endsection

@section('page-script')

<script>
$(document).ready(function () {

  $('#search').on('keyup',function(){

function timer(){
  $search = $('#search').val();
  $.ajax({
          type: "post",
          url:url+'/admin/searchpayby',
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