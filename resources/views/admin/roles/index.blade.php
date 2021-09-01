@extends('layouts.superadmin')
@section('superadmin')
@section('title','Role')
<div class="row">

    <div class="col-lg-12 margin-tb">

        <div class="pull-left">

            <h2 class="text-center">Role Management</h2>
            <a class="btn btn-success mb-2" href="{{ route('role.create') }}"> Create New Role</a>
        </div>

        <div class="pull-right">

        @can('role-create')

            <a class="btn btn-success" href="{{ route('role.create') }}"> Create New Role</a>
          

            @endcan

        </div>

    </div>

</div>


@if ($message = Session::get('success'))

    <div class="alert alert-success">

        <p>{{ $message }}</p>

    </div>

@endif


<table class="table table-bordered">

  <tr>

     <th>No</th>

     <th>Name</th>

     <th width="280px">Action</th>

  </tr>

    @foreach ($roles as $key => $role)

    <tr>

        <td>{{ ++$i }}</td>

        <td>{{ $role->name }}</td>

        <td>

            <a class="btn btn-info" href="{{ route('role.show',$role->id) }}">Show</a>

            

                <a class="btn btn-primary" href="{{ route('role.edit',$role->id) }}">Edit</a>

            

        

                {!! Form::open(['method' => 'DELETE','route' => ['role.destroy', $role->id],'style'=>'display:inline']) !!}

                    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}

                {!! Form::close() !!}

           

        </td>

    </tr>

    @endforeach

</table>


{!! $roles->render() !!}

@endsection

@section('script')

<script>
$(document).ready( function () {
    $('#myTable').DataTable();
} );
</script>
    
@endsection