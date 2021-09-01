
@extends('layouts.adminMaster')
@section('title', "Medicineinformation List")
@section('content')
@can('Medicineinformation-List') 
                
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
                                        
                                          <a href="{{url('admin/createmedicineinformation')}}" class="waves-effect waves-light  btn "><i class="material-icons right">gps_fixed</i> Create New</a>
                                      </div>
                                     
                                      <div class="row">
                                          <div class="col s12">
                                              <table id="page-length-option" class="display responsive-table">
                                                  <thead>
                                              
                                                      <tr>
                                                         <td>SL</td>
                                                          <th>Date</th>
                                                          <th>Title </th>
                                                          <th>Photo</th>
                                                         <th>Disease</th>
                                                          <th>Metadescription</th>
                                                          <th>Status</th>
                                                          <th>Action</th>
                                                         
                                                      </tr>
                                                  </thead>
                                                  <tbody>
                                                    @if(count($medicineinformation)>0)
                                                    @foreach ($medicineinformation as $medicine)
                                                       <tr>
                                                         <td>{{++$i}}</td>
                                                          <td>{{$medicine->created_at->diffForHumans()}}</td>
                                                          <td>{{$medicine->title}}</td>
                                                          <td><img  src="{{@url('storage/app/files/shares/medicineinformation/thumbs/'.$medicine->photo)}}" class="circle z-depth-2 responsive-img avtar"></td>
                                                          <td>{{@$medicine->disease->diseasename}}</td>
                                                          <td>{{$medicine->metadescription}}</td>
                                                     <td>@if($medicine->status==1)
                                                            <button type="button"  class="btn-floating mb-1 waves-effect waves-light approved"  rid="{{$medicine->id}}"><i class="material-icons">beenhere</i>   </button>@else
                                                            <button type="button" class="btn-floating mb-1 waves-effect waves-light notapproved"  rid="{{$medicine->id}}"><i class="material-icons">block</i> </button>
                                                         @endif</td>
                                                         <td>
                                                          <div class="invoice-action">
                                                              <a href="https://www.homeobari.com/homeo-info/{{$medicine->slug}}" target='_blank' class="invoice-action-view mr-4">
                                                                  <i class="material-icons">remove_red_eye</i>
                                                              </a>
                                                              <a  href="{{url('admin/editmedicineinformation/'.$medicine->id) }}" class="invoice-action-edit">
                                                                  <i class="material-icons">edit</i>
                                                              </a>
                                                              <a  href="{{url('admin/deletemedicineinformation/'.$medicine->id) }}" class="invoice-action-edit">
                                                                  <i class="material-icons">delete_forever</i>
                                                              </a>
                                                          </div>
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
                                          {{ $medicineinformation->links() }}
                                          </div>
                                         
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                
  <!-- Modal Structure -->
  <div id="SearchModal" class="modal">
    <div class="modal-content">
          <table id="page-length-option" class="display responsive-table">
        <thead>
        <tr>
        <th>ID</th>
       <th>Medicine </th>
       <th>Medicine (ওষুধ)</th>
        <th>Description</th>
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
  @endcan
@endsection

@section('page-script')

<script>
$(document).ready(function () {

  $('#search').on('keyup',function(){

function timer(){
  $search = $('#search').val();
  $.ajax({
          type: "post",
          url:url+'/admin/searchmedicine',
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
          url:url+'/admin/medicineinfostatus',
          data: {
              id:$(this).attr('rid'),
              action:"allow"
          },
          dataType: "json",
          success: function (d) {
            swal({
    title: "Nice Work",
    text: "Active Successfully",
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
          url:url+'/admin/medicineinfostatus',
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
    text: " In-Active Successfully",
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