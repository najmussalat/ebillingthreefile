<?php

namespace App\Http\Controllers\Admin;
use Validator;
use App\Models\Area;
use App\Models\Bill;
use App\Models\Thana;
use App\Models\Customer;
use App\Helpers\CommonFx;
use App\Models\Collection;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Kamaln7\Toastr\Facades\Toastr;
use App\Http\Controllers\Controller;
use GrahamCampbell\ResultType\Success;
use Illuminate\Support\Facades\Auth;
//use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;
 use Illuminate\Database\Eloquent\Builder;

class CollectionController extends Controller
{
    public function index(){
     
        $pageConfigs = ['pageHeader' => false, 'isFabButton' => false];
           
            return view('admin.collection.index')->with('pageConfigs',$pageConfigs);
        }
      
      
       public function create(){
     $breadcrumbs = [
            ['link' => "admin", 'name' => "Home"], ['link' => "admin/createcollection", 'name' => "Collection"], ['name' => "Create"],
        ];
      
          $pageConfigs = ['pageHeader' => true, 'isFabButton' => false];
        
        return view('admin.collection.create', ['pageConfigs' => $pageConfigs], ['breadcrumbs' => $breadcrumbs]);
      
        }

       public function cancelcollection(){
     $breadcrumbs = [
            ['link' => "admin", 'name' => "Home"], ['link' => "admin/arealist", 'name' => "Cancel"], ['name' => "Collection"],
        ];
      
          $pageConfigs = ['pageHeader' => true, 'isFabButton' => false];
        
        return view('admin.collection.cancel', ['pageConfigs' => $pageConfigs], ['breadcrumbs' => $breadcrumbs]);
      
        }
      
      
      public function store(Request $request){
      //  return response($request->all());exit;
        $validator = Validator::make($request->all(),[
          'paid'=>'required|min:1', 'max:60',
          'billid'=>'required|min:1', 'max:160',
          'payby'=>'required|min:1', 'max:160',
          
       ]);
     
       if ($validator->fails()) {


        return response()->json
        (['success' =>false,
         'errors'=>$validator->errors()->all()]);
    }
         $collectioninfo = Bill::find($request->billid);
        // return response($collectioninfo);


         
         if($collectioninfo->total>$request->paid){
           // return response('hi');exit;
          
            $due=$collectioninfo->total-$request->paid;
           $advance=$collectioninfo->advance;
         }
         if($collectioninfo->total<=$request->paid){
         // return response('hi2');exit;
          $advance=$request->paid-$collectioninfo->total;
          $due=$collectioninfo->due;
          
        }
       
           $cus=Customer::find($collectioninfo->customer_id);
           $cus->discount =0;
           $cus->vat =0;
           $cus->addicrg =0;
           $cus->advance =$advance;
           $cus->due =$due;
          // $cus->total =$collectioninfo->monthlyrent+$due)-$advance;
           $cus->save();
           if($cus){
           $info= Bill::find($request->billid);
          //  $info->paid=$request->paid;
           $info->total=$request->totall-$request->paid;
           $info->save();
          $pay= new Collection();
          $pay->paid =trim($request->paid);
         $pay->bill_id =trim($request->billid);
         $pay->payby_id =trim($request->payby);
         $pay->note =trim($request->note);
         $pay->invoice =trim($request->invoicesl);
         $pay->admin_id =Auth::id();
          $pay->save();
           }
           $smsinfo=['name'=>$cus->customername,'mobile'=>$cus->customermobile,'id'=>$cus->loginid,'paid'=>$request->paid,'due'=>$info->total];
           CommonFx::sentsmscustomerbillpaid($smsinfo);
     if($pay){
      return response()->json([
        'suceess'=>true,
      ],201);
      }
      
         else{
          return response()->json([
            'success'=>false
          
          ],404 );
         
        } 
     
                  
    
          
      }


      public function edit($id){
        $breadcrumbs = [
               ['link' => "admin", 'name' => "Home"], ['link' => "admin/arealist", 'name' => "Area"], ['name' => "edit"],
           ];
           $thana=Thana::pluck('thana','id');
             $pageConfigs = ['pageHeader' => true, 'isFabButton' => false];
           $divisioninfo=Area::whereadmin_id(Auth::id())->find($id);
           return view('admin.area.edit', ['pageConfigs' => $pageConfigs], ['breadcrumbs' => $breadcrumbs])->with('countryinfo',$divisioninfo)->with('thana', $thana);
         
           }



           public function update(Request $request,$id){
            $validator = Validator::make($request->all(),[
              'paid'=>'required|min:1', 'max:60',
              
           ]);
           if ($validator->fails()) {


            return response()->json
            (['success' =>false,
             'errors'=>$validator->errors()->all()]);
        }
             $collectioninfo = Bill::find($id);
             if($collectioninfo->paid==null){

             
             if($collectioninfo->total<$request->paid){
                $advance=$request->paid-$collectioninfo->total;
                $due=0;
             }
             if($collectioninfo->total>=$request->paid){
               $due=$collectioninfo->total-$request->paid;
               $advance=0;
            }
               
        
         if($collectioninfo){
          return response()->json([
            'suceess'=>true
          
          ],201);
          }
          
             else{
              return response()->json([
                'success'=>false
              
              ],404 );
             
            } 
         }
                      
         else{
          return response()->json([
            'success'=>false
          
          ],404 );
         
        }  
         }



         public function destroy($id){
         
             $divisioninfo=Area::whereadmin_id(Auth::id())->findOrFail($id)->delete();
            if($divisioninfo){
              Toastr::success("Area Delete Successfully", "Well Done");
                   return Redirect::to('admin/arealist'); 
            }
            else{
              Toastr::warning("Area Delete Fail", "Sorry");
              return Redirect::to('admin/arealist'); 
            }
             }


      public function searchsinglecustomer(Request $request){
        if(! $request->id==null){
        $searchvalue = Customer::with('district','thana','area','bill.collection')->whereadmin_id(Auth::id())->Where('loginid','LIKE','%'.$request->id."%")->orwhere('customermobile','LIKE','%'.$request->id."%")->orwhere('customername','LIKE','%'.$request->id."%")->orwhere('secretname','LIKE','%'.$request->id."%")->first();
        
        if($searchvalue)
{
return response()->json([
  'result'=>$searchvalue

],200);
}
}
   else{
    return response()->json([
      'success'=>false
    
    ],204 );
   }
    
      }


      public function singlecustomerbill(Request $request){
        $output = "";
        if(! $request->id==null){
        $searchvalue = Customer::with('district','thana','area','bill.collection.admin','bill.collection.payby')->whereadmin_id(Auth::id())->Where('loginid','LIKE','%'.$request->id."%")->orwhere('customermobile','LIKE','%'.$request->id."%")->orwhere('customername','LIKE','%'.$request->id."%")->orwhere('secretname','LIKE','%'.$request->id."%")->first();
        
        if($searchvalue)
{
  
return response()->json([
  'result'=>$searchvalue

],200);
}
}
   else{
    return response()->json([
      'success'=>false
    
    ],204 );
   }
    
      }

   public function collectiondelete(Request $request,$id){
$info=Collection::whereadmin_id(Auth::id())->find($id);
if($info){
  $pa=Bill::find($info->bill_id);
  $pa->total=$pa->total+$request->payamount;
  $pa->save();
}
if($pa){
$q=Customer::find($pa->customer_id);
$q->total=$q->total+$request->payamount;
//$q->due=$q->due+$request->payamount;
$q->save();
}
$info->delete();
return response()->json([
  'success'=>true
],200);
      }
  
}
