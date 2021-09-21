@extends('layouts.superadminMaster')

@section('content')
@section('title', 'Smssetting List')


<div class="row">
    <div class="col s12">
        <div class="card">
            <div class="card-content">
                <div class="input-field col s12 m9">
                   
                </div>


                <div class="col s12 m3 l3 input-field">

                </div>

                <div class="row">
                    <div class="col s12">
                        <table id="page-length-option" class="display responsive-table">
                            <thead>

                                <tr>
                                    <th>SL</th>
                                    <th>Admin</th>
                                    <th>email</th>
                                    <th>User</th>
                                    <th>password</th>
                                    <th>Blance</th>
                                    <th>Rate</th>
                                    <th>Edit</th>

                                </tr>
                            </thead>
                            <tbody>
                                @if (count($infos) > 0)
                                    @foreach ($infos as $info)
                                        <tr>

                                            <td>{{ ++$i }}</td>
                                            <td>{{ $info->admin->name }}</td>
                                            <td>{{ $info->admin->email }}</td>
                                            <td>{{ $info->username }}</td>
                                            <td>{{ $info->password }}</td>
                                            <td>{{ $info->blance }}</td>
                                            <td>{{ $info->smsrate }}</td>
                                            <td> <a href="{{ url('superadmin/editsmssetting/' . $info->id) }}"
                                                    class="invoice-action-edit">
                                                    <i class="material-icons">edit</i>
                                                </a></td>

                                           
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
</div><!-- START RIGHT SIDEBAR NAV -->



<!-- Modal Structure -->
<div id="SearchModal" class="modal">
    <div class="modal-content">
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Country</th>
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
