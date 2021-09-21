<div class="row">
    <div class="input-field col m12 s12">
        {!!Form::text('name',null, array('id'=>'name','required'))!!}

        {!!Form::label('name',' * Permission Name')!!}
        <div class="col s12">
            <table  class="table table-striped table-hover">
                <thead>
                  <tr>
                     <th>Permission Name</th>
                   <th><a rel="check" href="#invert_selection">All Selection/Un Select</a> </th>
                  
                                   
                  </tr>
                </thead>
        
        
                <tbody>
                  @if(count($permission)>0)
                  @foreach($permission as $value)
                       
                  <tr>
                   <td>{{ $value->name }}</td>
                  
                   
                 <td id="check"> <label>
                    {{ Form::checkbox('permission[]', $value->id, false, array('class' => 'name filled-in')) }}
                    <span>Click</span>
                  </label></td>
                  </tr>
                  @endforeach
                  @else
                 <h3 class="text-danger">No Barcode found</h3>
                 @endif
                            
                </tbody>
              </table>
            <!-- </div> -->
          </div>
         
    </div>
      
    </div>
      
  





