{{-- layout extend --}}
@extends('layouts.adminMaster')

{{-- Page title --}}
@section('title','Complaindetails')

{{-- page styles --}}
@section('page-style')
<link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/pages/app-chat.css')}}">
@endsection

{{-- main page content --}}
@section('content')
<div class="chat-application">
  <div class="chat-content-head">
    <div class="header-details">
      <h5 class="m-0 sidebar-title"><i class="material-icons app-header-icon text-top">mail_outline</i> Reply Complain</h5>
    </div>
  </div>
  <div class="app-chat">
    <div class="content-area content-right">
      <div class="app-wrapper">
        <!-- Sidebar menu for small screen -->
        <a href="{{url('admin/complainlist')}}" data-target="chat-sidenav" class="sidenav-trigger hide-on-large-only">
          <i class="material-icons">back</i>
        </a>
        <!--/ Sidebar menu for small screen -->

        <div class="card card card-default scrollspy border-radius-6 fixed-width">
          <div class="card-content chat-content p-0">
      
            <!-- Content Area -->
            <div class="chat-content-area animate fadeUp">
              <!-- Chat header -->
              <div class="chat-header">
                <div class="row valign-wrapper">
                  <div class="col media-image online pr-0">
                    <img  src="{{@url('storage/app/files/shares/uploads/'.$infos->customer->path.'/'.$infos->customer->photo)}}" class="circle z-depth-2 responsive-img">
                  </div>
                  <div class="col">
                    <p class="m-0 blue-grey-text text-darken-4 font-weight-700">{{$infos->customer->customername}}</p>
                    <p class="m-0 chat-text truncate">@foreach (json_decode($infos->complainheding) as $item)
                        {{$item}}
                        @endforeach
                  </div>
                </div>
                <span class="option-icon">
                  <span class="favorite">
                    <a href="{{url('admin/complainlist')}}" title="Click for Back" >
                    <i class="material-icons">arrow_back</i>
                    </a>
                  </span>
                  
                  <i class="material-icons" id="Closepomplain" title="Click for Close Complain " >done_all</i>
                  <i class="material-icons">more_vert</i>
                </span>
              </div>
              <!--/ Chat header -->

              <!-- Chat content area -->
              <div class="chat-area">
                @foreach ($infos->complaindetils as $info )
                    
             
                  <div class="chats">
                    @if ((@$info->message))
                    <div class="chat chat-right">
                      <div class="chat-avatar">
                        <a class="avatar">
                          <img src="{{@url('storage/app/files/shares/uploads/'.$infos->customer->path.'/'.$infos->customer->photo)}}" class="circle" alt="avatar" />
                        </a>
                      </div>
                      <div class="chat-body">
                        <div class="chat-text">
                          <p> 
                               {{$info->message}} 
                           </p>
                        </div>
                      </div>
                      
                    </div>
                    @endif
                    <div class="chat">
                      <div class="chat-avatar">
                        <a class="avatar">
                          <img src="{{@asset('storage/app/files/shares/profileimage/'.Auth::user()->image)}}"  class="circle" alt="avatar" />
                        </a>
                      </div>
                      <div class="chat-body">
                        <div class="chat-text"> 
                          <p>{{@$info->replymessage}}   @if (empty(@$info->replymessage

                          ))
                              <span  title="Click For Reply" rid="{{$info->id}}" id="Replysms"><i class="material-icons app-header-icon text-top">reply</i></span>
                          @endif </p>
                        </div>
                       
                      </div>
                    </div>
                   
                </div>
                @endforeach
              </div>
              <!--/ Chat content area -->

              <!-- Chat footer <-->
              <div class="chat-footer">
                <div  class="chat-input">
                 <input type="text" placeholder="Type message here.." class="message mb-0" id="textmessage">
                  <a class="btn waves-effect waves-light send" id="Reply" >Send</a>
                </div>
              </div>
              <!--/ Chat footer -->
            </div>
            <!--/ Content Area -->
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div id="Replytextsms" class="modal">
    <div class="modal-content">
    
      
        <div class="row">
            <div class="input-field col m12 s12">
              <input type="hidden" value="" id="replymsmsid">
                {!!Form::text('replysmstext',null, array('id'=>'replysmstext','class'=>'validate', 'placeholder'=>'type some complate title','required'))!!}
                {!! Form::label('replysmstext', 'Reply Text') !!}
            </div>
            
            </div>


        </div>

    <div class="modal-footer">
        
        <input type="button" id="addBtn" value="Save" class="btn cyan waves-effect waves-light right">
        <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat" id="close">Close</a>
    </div>
    {!! Form::close() !!}
</div>
@endsection

{{-- page scripts --}}
@section('page-script')

<script src="{{asset('app-assets/js/scripts/app-chat.js')}}"></script>
<script>
    $(document).ready(function () {
        $("#Reply").on('click', function() {
            console.log('{{$infos->id}}');
                if ($("#textmessage").val() == '') {
                  toastr.warning('Please Type some Text');
                    $("#textmessage").focus();
                    return false;
              
                }
                $.ajax({
                    
                    url: url + '/admin/addcomplaintext',
                    method: "POST",
                    type: "POST",
                    data: {
                        replysms: $("#textmessage").val(),
                        id: '{{$infos->id}}',
                       
                       

                    },
                    success: function(d) {

                        if (d) {
                            $("#search").focus();
                            // swal({
                            //     title: "Collection Done",
                            //     text: "collection submit successfully",
                            //     timer: 2000,
                            //     buttons: false
                            // });
                            toastr.info('Message Sent Successfully');
                            location.reload();
                           
                        } else {
                            $.each(d.errors, function(key, value) {
                                $("#collection").focus();
                                toastr.warning(value);
                            });
                        }

                    },
                    error: function(d) {

                        toastr.warning('Bii Allready Paid');
                    }
                });

            });

            $(document).on('click', '#Replysms', function() {
          $("#replymsmsid").val($(this).attr('rid'));
            $('#Replytextsms').modal('open');
     
});
$(document).on('click','#addBtn', function(){
      
      
      $.ajax({
          type: "post",
          url:url+'/admin/replycomplaintext',
          data: {
              id:$('#replymsmsid').val(),
              replymessage:$('#replysmstext').val(),
              
          },
          dataType: "json",
          success: function (d) {
              toastr.success("Reply Done");
              location.reload();

          }
      });

  
});

$(document).on('click','#Closepomplain', function(){
     
      $.ajax({
          type: "post",
          url:url+'/admin/closecomplain/'+'{{$infos->id}}',
          data: {
             
              
          },
          dataType: "json",
          success: function (d) {
              toastr.success("Complain Colse");
              window.history.back();

          }
      });

  
});

            

    });
</script>
@endsection