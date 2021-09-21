
@extends('layouts.superadminMaster')

@section('content')
@section('title', "Edit Role")
@include('partial.formerror')
                            <!-- Form Advance -->
                            <div class="col s12 m12 l12">
                               
                                <div id="Form-advance" class="card card card-default scrollspy">
                                    <div class="card-content">
                                        <h4 class="card-title">Role Update Form</h4>
                                     
                                       
                                        {!! Form::model($role, array('url' =>['superadmin/updateaccountrole/'.$role->id], 'method'=>'PUT','files'=>true)) !!}
                                 
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
                                                          
                                                                   {{-- {{dd($rolePermissions)   }}      --}}
                                                          </tr>
                                                        </thead>
                                                
                                          
                                                        <tbody>
                                                          @if(count($permission)>0)
                                                          @foreach($permission as $value)
                                                               
                                                          <tr>
                                                           <td>{{ $value->name }}</td>
                                                          
                                                           
                                                         <td id="check"> <label>
                                                        
                                                            {{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'filled-in')) }}
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
                                              
                                          
                                        
                                        
                                        
                                        
                                        
                                        
                                                <div class="row">
                                                    <div class="input-field col s12">
                                                        <button class="btn cyan waves-effect waves-light right" type="submit" name="action">Update
                                                            <i class="material-icons right">send</i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                     {!! Form::close() !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                           
                            </div>
@endsection