
@extends('layouts.adminMaster')

{{-- page styles --}}
@section('title','Merchant List')

@section('page-style')
<link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/pages/app-invoice.css')}}">
@endsection

@section('content')
{{-- @can('Merchant-List') --}}
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
                  
                    <a href="{{url('admin/createmerchant')}}" class="waves-effect waves-light  btn "><i class="material-icons right">gps_fixed</i> Create  Merchant</a>
                </div>
               
                <div class="row">
                    <div class="col s12">
                        <table id="page-length-option" class="display responsive-table">
                            <thead>
                        
                                <tr>
                                   <td>SL</td>
                                 
                                    <th>Merchant</th>
                                    {{-- <th>Status</th> --}}
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                              @if(count($infos)>0)
                              @foreach ($infos as $info)
                                 
                                <tr>
                                  <td>{{ ++$i }}</td>
                                   
                                    <td>{{$info->merchantname}}</td>
                                   {{-- <td>@if($info->status==1)
                                      <button type="button"  class="btn-floating mb-1 waves-effect waves-light approved" rid="{{$info->id}}"><i class="material-icons">beenhere</i></button> @else
                                      <button type="button" class="btn-floating mb-1 waves-effect waves-light notapproved"  rid="{{$info->id}}"><i class="material-icons">block</i> </button>
                                   @endif</td> --}}
                                   <td>
                                    <a href="{{url('admin/editmerchant/'.$info->id) }}" class="btn-floating mb-1 waves-effect waves-light">
                                      <i class="material-icons">edit</i>
                                    </a>
                                  </td>
                                   
                                      <td> {!! Form::open(['method' => 'DELETE','url' => ['admin/deletemerchant', $info->id],'onsubmit' => 'return confirm("are you sure ?")']) !!}
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

</section>
                
      
  <!-- Modal Structure -->
  <div id="SearchModal" class="modal">
    <div class="modal-content">
      <table class="table table-bordered table-hover">
        <thead>
        <tr>
        <th>ID</th>
        <th>Merchant</th>
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
  $(".select2").select2({
    dropdownAutoWidth: true,
    width: '100%'
});
$(document).ready(function () {

  $('#search').on('keyup',function(){

function timer(){
  $search = $('#search').val();
  $.ajax({
          type: "post",
          url:url+'/admin/searchmerchant',
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
          url:url+'/admin/merchantstatus',
          data: {
              id:$(this).attr('rid'),
              action:"allow"
          },
          dataType: "json",
          success: function (d) {
            swal({
    title: "Nice Work",
    text: "Disease De-Active Successfully",
    timer: 2000,
    buttons: false
  });
             location.reload();

          }
      });

  });

//   $("#notapproved").click(function(){
  $(".notapproved").click(function(){

      //console.log($roomid);
      $.ajax({
          type: "post",
          url:url+'/admin/diseasestatus',
          data: {
              id:$(this).attr('rid'),
              action:"deny"
          },
          dataType: "json",
          success: function (d) {

swal({
    title: "Nice Work",
    text: "Disease Active Successfully",
    timer: 2000,
    buttons: false
  });

              location.reload();

          }
      });

  });
});
</script>


@endsection