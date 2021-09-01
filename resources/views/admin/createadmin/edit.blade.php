@extends('layouts.admin')
@section('title', "Update Admin")
@section('admin')

    <div class="card o-hidden border-0 shadow-lg my-5">
      <a  class=" btn  btn-success rounde" href="{{url('admin/admin')}}">View Users </a>
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        
        <div class="row">
          {{-- <div class="col-lg-5 d-none d-lg-block"></div> --}}
          <div class="col-lg-7">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Update Admin Account!</h1>
                 <h3 class=" text-warning">@include('partial.formerror')</h3>
                </div>
 
         {{-- {!! Form::model($admin, array('method'=>'PATCH','route'=>['addusers.update',$admin->id,],'class'=>'form-horizontal form-label-left','files' => true))!!} --}}
             {!!Form::model($admin,array('method'=>'PATCH','route'=>['admin.update',$admin->id],'class'=>'user','id'=>'admin','files'=>true))!!}
            <input type="hidden" name="oldimage" type="hide" value="{{$admin->image}}">
              @include('admin.createadmin.form')
               
                {!!Form::submit('Update',array('class'=>'btn btn-info btn-user btn-block'))!!}
               
              <hr>
              
            </div>
          </div>
        </div>
      </div>
    </div>
    {!!Form::close()!!}
                                        
@endsection
