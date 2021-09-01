
@extends('layouts.superadminMaster')

@section('content')
@section('title', "Division List")
    
                
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
                                        
                                          <a href="{{url('superadmin/createdivision')}}" class="waves-effect waves-light  btn "><i class="material-icons right">gps_fixed</i> Create New</a>
                                      </div>
                                     
                                      <div class="row">
                                          <div class="col s12">
                                              <table id="page-length-option" class="display responsive-table">
                                                  <thead>
                                              
                                                      <tr>
                                                         <th>SL</th>
                                                          <th>Date</th>
                                                          <th>Country</th>
                                                          <th>Division</th>
                                                            <th>Edit</th>
                                                          <th>Delete</th>
                                                         
                                                      </tr>
                                                  </thead>
                                                  <tbody>
                                                    @if(count($divisioninfo)>0)
                                                    @foreach ($divisioninfo as $tha)
                                                       <tr>
                                                           <td>{{++$i}}</td>
                                                    <td>{{$tha->created_at->diffForHumans()}}</td>
                                                    <td>{{$tha->country->countryname}}</td>
                                                       <td>{{$tha->division}}</td>
                                                     <td> <a href="{{url('superadmin/editdivision/'.$tha->id) }}" class="invoice-action-edit">
                                                                  <i class="material-icons">edit</i>
                                                              </a></td>
                                                         
                                                               <td> {!! Form::open(['method' => 'DELETE','url' => ['superadmin/deletedivision', $tha->id],'onsubmit' => 'return confirm("are you sure ?")']) !!}
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
                                          {{ $divisioninfo->links() }}
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
        <th>Division</th>
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
          url:url+'/superadmin/searchdivision',
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
          url:url+'/admin/blogstatus',
          data: {
              id:$(this).attr('rid'),
              action:"allow"
          },
          dataType: "json",
          success: function (d) {
            swal({
    title: "Nice Work",
    text: "Blog De-Active Successfully",
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
          url:url+'/admin/blogstatus',
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
    text: "Blog Active Successfully",
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