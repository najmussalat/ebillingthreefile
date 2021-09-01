<?php

namespace App\Http\Controllers\superadmin;

use App\Banner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Storage;
class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $staus = Banner::find(1);
        if ($staus) {
            return response()->json([
                'success' => true,
               'banner' => $staus
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'Message' => 'Record Not Found.'
            ], 404);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    { }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        
        $this->validate($request,[
            
            'topbanner' => 'required',
            'blogtopbanner' => 'required',
            'blogsidebarbannerfast' => 'required',
            'blogsidebarbannersecond' => 'required',
            'productleftbanner' => 'required',
            'productrightbanner' => 'required',

         ]);
         $rand = mt_rand(100000, 999999);
         $topbanner = time() . "_" . Auth::id() . "_" . $rand.$request->topbanner->extension();  
         $top= $request->topbanner->move(public_path('images/banner/'), $topbanner); 
         
         if($top){
            $rand = mt_rand(100000, 999999);
            $blogtopbanner = time() . "_" . Auth::id() . "_" . $rand.$request->blogtopbanner->extension();  
            $top1= $request->blogtopbanner->move(public_path('images/banner/'), $blogtopbanner); 
         }

         if($top1){
            $rand = mt_rand(100000, 999999);
            $blogsidebarbannerfast = time() . "_" . Auth::id() . "_" . $rand.$request->blogsidebarbannerfast->extension();  
            $top2= $request->blogsidebarbannerfast->move(public_path('images/banner/'), $blogsidebarbannerfast); 
         } 
         if($top2){
            $rand = mt_rand(100000, 999999);
            $blogsidebarbannersecond = time() . "_" . Auth::id() . "_" . $rand.$request->blogsidebarbannersecond->extension();  
            $top3= $request->blogsidebarbannersecond->move(public_path('images/banner/'), $blogsidebarbannersecond); 
         }
         if($top3){
            $rand = mt_rand(100000, 999999);
            $productleftbanner = time() . "_" . Auth::id() . "_" . $rand.$request->productleftbanner->extension();  
            $top4= $request->productleftbanner->move(public_path('images/banner/'), $productleftbanner); 
         }
         if($top4){
            $rand = mt_rand(100000, 999999);
            $productrightbanner = time() . "_" . Auth::id() . "_" . $rand.$request->productrightbanner->extension();  
            $top= $request->productrightbanner->move(public_path('images/banner/'), $productrightbanner); 
         }
        
        $list = new Banner();
        $list->topbanner = $topbannername;
        $list->blogtopbanner = $blogtopbanner;
        $list->blogsidebarbannerfast = $blogsidebarbannerfast;
        $list->blogsidebarbannersecond = $blogsidebarbannersecond;
        $list->productleftbanner = $productleftbanner;
        $list->productrightbanner = $productrightbanner;
         $list->superadmin_id =  Auth::guard('superadmin')->user()->id;
        $list->save();
      
        if ($list->save()) {
            return response()->json([
                'success' => true,
              
            ], 201);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Data Create Fails',
            ], 404);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    $info = Banner::find($id);
    if($info){
        return response()->json([
            'success'=>true,
            'message'=>'Record Found',
            'status' => $info], 200);
    }
    else{
        return response()->json([
            'success'=>false,
            'message'=>'Record Not Found',
            'id' => $id], 404);
    }

    
}

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $this->validate($request,[
            
            'status_name' => 'required|min:3|max:15|unique:statuses,status_name,' . $id,

        ],
    [
        'status_name.required'=>"The status  field is required",
        'status_name.min'=>"The status  must be at least 3 characters",
        'status_name.max'=>"The status  must be at least 15 characters",
         ]);



        // if ($validator->fails()) {
        //     return response()->json([
        //         'success' => false,
        //         'message' => 'Validation Fails',
        //         'errors' => $validator->errors()->all()
        //     ], 422);
        // }
        $list = Banner::find($id);
        $list->status_name = $request->status_name;
        $list->created_by  =  Auth::guard('superadmin')->user()->superadminname;
        $list->superadmin_id =  Auth::guard('superadmin')->user()->id;
        $list->update();
       
        if ($list->update()) {
            return response()->json([
                'success' => true,
                 'message'=>'Record Update Successfully',
                 'status'=>$list
            ],200);
          } else {
              return response()->json([
                  'success' => false,
                   'message'=>'Record Update Faild',
                   
              ],404);
          }
      }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Banner::destroy($id)) {
           
            return response()->json([
                'success' => true,
                'message'=>'Record Delete Successfully'
            ],200);
        } else {
            
            return response()->json([
                'success' => false,
                 'message'=>'Record Not Found',
                'id'=>$id],404);
        }
    
    }
}
