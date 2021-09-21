@extends('layouts.superadminMaster')

@section('content')
@section('title', 'Sms type List')
<div class="col s12 m12 l12">
                               
    <div id="Form-advance" class="card card card-default scrollspy">
        <div class="card-content">
            <h4 class="card-title">SMS Type Form</h4>
         
            {!! Form::open(array('url' => 'superadmin/createsmstype','method'=>'POST','id'=>'theform')) !!}
            <div class="input-field col m6 s12">
                {!!Form::text('maskingnonmasking',null, array('id'=>'username','required','placeholder'=>'ex: Masking'))!!}
                {!!Form::label('maskingnonmasking',' * Sms type Name * ')!!}
                
            </div>
            <div class="input-field col m6 s12">
              {!!Form::number('charge',null, array('id'=>'charge', 'required','placeholder'=>'ex: default 0.25','step'=>'any'))!!}
              {!!Form::label('charge',' * Charge (Price Per Sms) * ')!!}
              
            </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <button class="btn cyan waves-effect waves-light right" type="submit" name="action">Submit
                                <i class="material-icons right">send</i>
                            </button>
                        </div>
                    </div>
                </div>
         {!! Form::close() !!}
        </div>
    </div>
  </section>
</div>
@endsection

@section('page-script')

<script>
    $(document).ready(function() {

        $('#search').on('keyup', function() {

            function timer() {
                $search = $('#search').val();
                $.ajax({
                    type: "post",
                    url: url + '/superadmin/searchcountry',
                    data: {
                        id: $search

                    },

                    success: function(data) {

                        $('.modal').modal('open');
                        $('#dd').html(data);
                        $('#search').val(' ');
                    }

                });
            }

            //setTimeout(myFunc,5000);
            setTimeout(timer, 3000);

        });

        $(".approved").click(function() {

            $.ajax({
                type: "post",
                url: url + '/admin/blogstatus',
                data: {
                    id: $(this).attr('rid'),
                    action: "allow"
                },
                dataType: "json",
                success: function(d) {
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

        $(".notapproved").click(function() {

            //console.log($roomid);
            $.ajax({
                type: "post",
                url: url + '/admin/blogstatus',
                data: {
                    id: $(this).attr('rid'),
                    action: "deny"
                },
                dataType: "json",
                success: function(d) {
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
