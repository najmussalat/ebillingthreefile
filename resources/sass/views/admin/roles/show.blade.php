@extends('layouts.superadmin')
@section('superadmin')
@section('title','Permission')
@include('partial.formerror')
<hr>
<div class="row">

    <div class="col-lg-12 margin-tb">

        <div class="pull-left">

            <h2> Show Role</h2>

        </div>

        <div class="pull-right">

            <a class="btn btn-primary" href="{{ route('role.index') }}"> Back</a>

        </div>

    </div>

</div>


<div class="row">

    <div class="col-xs-12 col-sm-12 col-md-12">

        <div class="form-group">

            <strong>Name:</strong>

            {{ @$role->name }}

        </div>

    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">

        <div class="form-group">

            <strong>Permissions:</strong>

            @if(!empty($rolePermissions))

                @foreach($rolePermissions as $v)

                    <label class="label label-success">{{ $v->name }},</label>

                @endforeach

            @endif

        </div>

    </div>

</div>
@endsection

@section('script')

<script>
$(document).ready( function () {
    $('#myTable').DataTable();
} );
</script>
    
@endsection