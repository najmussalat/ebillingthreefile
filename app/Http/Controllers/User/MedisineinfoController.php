<?php

namespace App\Http\Controllers\user;
use App\Medisine;
use App\Medisineinfo;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class MedisineinfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Medisineinfo::latest()->paginate(10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
 
             
//return response(dd($request));exit;

    /**
     * Display the specified resource.
     *
     * @param  \App\Medisine  $disease
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $disease =Medisineinfo::find($id);
        return response()->json(['diseaseinfo'=>$disease],200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Medisine  $disease
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $disease =Medisineinfo::find($id);
        return response()->json(['diseaseinfo'=>$disease],200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Medisine  $disease
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
    

    }

 
    public function destroy($id)
    {
        $delete=Medisineinfo::destroy($id);
        
      
        if($delete) {
            return response()->json([
                 'success' => true,
                
             ],200);
         } else {
             
             return response()->json([
                 'success' => false,
                  ],404);
         }
    }
}
