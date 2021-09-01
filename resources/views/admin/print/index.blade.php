@extends('layouts.adminMaster')
@section('title', 'Print Setting')

@section('content')

    {{-- @can('Medicineinformation-Create') --}}
    <div class="section">
        <!-- Snow Editor start -->
        <section class="snow-editor">
            @include('partial.formerror')
            <!-- Form Advance -->
            <div class="col s12 m12 l12">

                <div id="Form-advance" class="card card card-default scrollspy">
                    <div class="card-content">
                        <h4 class="card-title">Print Setting</h4>

                        {!! Form::model($printset, ['url' => ['admin/updateprintsetting/' . $printset->id], 'method' => 'PATCH', 'id' => 'myForm', 'files' => true]) !!}
                        <input type="hidden" name="oldphoto" value="{{ $printset->singnature }}">
                        @include('admin.print.form')

                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
    </div>
    </div>
    {{-- @endcan --}}
@endsection


@section('page-script')
    <script>
        $(document).ready(function() {
            $('#padbillid').hide();
            $('#twobillid').hide();
            $('#threebillid').hide();
            $('#myForm input').on('change', function() {
                if ($('input[name=papersetting]:checked', '#myForm').val() == 'onewithheadin') {
                    $('#onebillid').show();
                    $('#padbillid').hide();
                    $('#twobillid').hide();
                    $('#threebillid').hide();
                } if ($('input[name=papersetting]:checked', '#myForm').val() == 'twowithheadin') {
                    $('#onebillid').hide();
                    $('#twobillid').show();
                    $('#padbillid').hide();
                    $('#threebillid').hide();
                } if ($('input[name=papersetting]:checked', '#myForm').val() == 'threewithheadin') {
                    $('#onebillid').hide();
                    $('#twobillid').hide();
                    $('#padbillid').hide();
                    $('#threebillid').show();
                } if ($('input[name=papersetting]:checked', '#myForm').val() == 'padwithheadin') {
                    $('#onebillid').hide();
                    $('#twobillid').hide();
                    $('#padbillid').show();
                    $('#threebillid').hide();
                }
                

            });
        });
    </script>
@endsection
