@extends('layouts.superadmin')
@section('superadmin')
@section('title','Admin Role')
@include('partial.formerror')
<hr>
{!! Form::open(array('route' =>'role.store','method'=>'POST')) !!}

<div class="row">

    <div class="col-xs-12 col-sm-12 col-md-12">

        <div class="form-group">

            <strong>Name:</strong>

            {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}

        </div>

    </div>
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          
          <div class="x_content">
            <!--style="width:50%";-->
            <table  class="table table-striped table-hover">
              <thead>
                <tr>
                   <th>Permission Name</th>
                 <th><a rel="group_1" href="#invert_selection">Click For All Selection</a> </th>
                                 
                </tr>
              </thead>
      
      
              <tbody>
                @if(count($permission)>0)
                @foreach($permission as $value)
                     
                <tr>
                 <td>{{ $value->name }}</td>
                 <td id="group_1">  <div class="pretty p-icon p-round p-pulse">
                    {{ Form::checkbox('permission[]', $value->id, false, array('class' => 'name')) }}
                        <div class="state p-success">
                            <i class="icon mdi mdi-check"></i>
                            <label>Allow</label>
                        </div>
                    </div></td>
                 
               
                </tr>
                @endforeach
                @else
               <h3 class="text-danger">No Barcode found</h3>
               @endif
                          
              </tbody>
            </table>
          </div>
        </div>
      </div>
      



   

    <div class="col-xs-12 col-sm-12 col-md-12 text-center">

        <button type="submit" class="btn btn-primary">Submit</button>

    </div>

</div>

{!! Form::close() !!}
       
       


@endsection

@section('script')

{{-- <script>
$(document).ready( function () {
    $('#myTable').DataTable();
} );
</script> --}}

<script type="text/javascript">
    $(document).ready( function() {
        // Select all
        $("A[href='#select_all']").click( function() {
            $("#" + $(this).attr('rel') + " INPUT[type='checkbox']").attr('checked', true);
            return false;
        });
        // Select none
        $("A[href='#select_none']").click( function() {
            $("#" + $(this).attr('rel') + " INPUT[type='checkbox']").attr('checked', false);
            return false;
        });
        // Invert selection
        $("A[href='#invert_selection']").click( function() {
            $("#" + $(this).attr('rel') + " INPUT[type='checkbox']").each( function() {
                $(this).attr('checked', !$(this).attr('checked'));
            });
            return false;
        });
    });
</script>
    
@endsection

