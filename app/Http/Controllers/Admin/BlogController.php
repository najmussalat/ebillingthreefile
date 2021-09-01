<?php

namespace App\Http\Controllers\admin;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Superadmin;
use App\Helpers\CommonFx;
use App\Models\Medicine;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Kamaln7\Toastr\Facades\Toastr;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Carbon;
use App\Notifications\Superadminnotification;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Redirect;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
    $pageConfigs = ['pageHeader' => false, 'isFabButton' => false];
        $blog=Blog::with('category')->whereadmin_id(Auth::guard('admin')->user()->id)->latest()->paginate(10);
        return view('admin.blog.index')->with('blogs',$blog)->with('pageConfigs',$pageConfigs)->with('i', (request()->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $breadcrumbs = [
            ['link' => "admin", 'name' => "Home"], ['link' => "admin/bloglist", 'name' => "Blog"], ['name' => "Create"],
        ];
        //Pageheader set true for breadcrumbs
        $category=Category::pluck('category','id');
        $tag=Category::pluck('category','category');
        $pageConfigs = ['pageHeader' => true, 'isFabButton' => false];
        
        return view('admin.blog.create', ['pageConfigs' => $pageConfigs], ['breadcrumbs' => $breadcrumbs])->with('categories',$category)->with('tags',$tag);
    }


    
        public function store(Request $request)
        {
                 
       $this->validate($request,[
        'title' => 'required|min:30|max:190|unique:blogs,title',
        'keyword' => 'required|min:1|max:190',
        'metadescription' => 'required|min:3|max:160',
         'category_id' => 'required',
       'description' => 'min:3|required',
        ]);
    
    

            try {
                DB::beginTransaction();
                if ($request->hasfile('photo')) {
          $ex =$request->photo->extension();
           $rand = uniqid(CommonFx::make_slug(Str::limit($request->title,30)));
         $name = $rand.".". $ex;
           $waterMarkUrl = storage_path().'/app/files/shares/backend/watermark.png';
               $img=Image::make($request->photo->move(storage_path().'/app/files/shares/blog/', $name,60));
           
               $img->insert($waterMarkUrl, 'bottom-right', 5, 5);
               $img->save();
                 $resizedImage_thumbs = Image::make(storage_path().'/app/files/shares/blog/' . $name)->resize(35, null, function ($constraint) {
                     $constraint->aspectRatio();
                 });
               
  $resizedImage_thumb = Image::make(storage_path().'/app/files/shares/blog/' . $name)->resize(330, 232);
                  // save file as jpg with medium quality
                  $resizedImage_thumb->save(storage_path() . '/app/files/shares/blog/thumb/'.$name,60);
                   $resizedImage_thumbs->save(storage_path() . '/app/files/shares/blog/thumbs/'.$name, 60);
              }
              else{
               $name ='not-found.jpg';
              };
              
               $schema='
{
  "@context": "https://schema.org",
  "@type": "BlogPosting",
  "mainEntityOfPage": {
    "@type": "WebPage",
    "@id": "https://homeobari.com/info/'. CommonFx::bnslug($request->title).'"
  },
  "headline": "'. $request->title.'",
  "image": "https://homeobari.com/den/storage/app/files/shares/blog/'.$name.'",
  "author": {
    "@type": "Person",
    "name": "'. Auth::guard('admin')->user()->name .'"
  },  
  "publisher": {
    "@type": "Organization",
    "name": "person",
    "logo": {
      "@type": "ImageObject",
      "url": "https://homeobari.com/den/storage/app/files/shares/profileimage/'.Auth::user()->image.'"
    }
  },
  "datePublished":"'.date("Y m d") .'",
  "dateModified":"'. date("Y-m-d").'"

}';
              
             

                $userinfo =Blog::create(array(
                'title' => $request->title,
                'slug' =>CommonFx::bnslug($request->title),
                'keyword' => $request->keyword,
                'photo' => $name,
                'category_id' => $request->category_id,
                'metadescription' => $request->metadescription,
                 'tag' => json_encode($request->tag, JSON_FORCE_OBJECT),
                 'admin_id' => Auth::guard('admin')->user()->id,
                 'schemainfo' => $schema,
                'description' => $request->description,
                    ));
             DB::commit();
             
                    Toastr::success("Blog Create Successfully", "Well Done");
                return Redirect::to('admin/bloglist'); 
                    }
                    catch (\Exception $e) {
                        DB::rollBack();
                        Toastr::warning("Blog Create Successfully Fail", "Sorry Done");
                      return Redirect::to('admin/createblog'); 
                    }
                }

    /**
     * Display the specified resource.
     *
     * @param  \App\Medisine  $disease
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Medisine  $disease
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $breadcrumbs = [
            ['link' => "admin", 'name' => "Home"], ['link' => "admin/bloglist", 'name' => "Blog"], ['name' => "Edit"],
        ];
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true, 'isFabButton' => false];
        $category=Category::pluck('category','id');
       $blogid =Blog::with('category')->whereadmin_id(Auth::guard('admin')->user()->id)->find($id);
       $tag=Category::pluck('category','category');
       return view('admin.blog.edit', ['pageConfigs' => $pageConfigs], ['breadcrumbs' => $breadcrumbs])->with('categories',$category)->with('blogid',$blogid)->with('tags',$tag);
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
        //dd($request->all());
        $this->validate($request,[
        'title' => 'required|min:30|max:190|unique:blogs,title,'.$id,
        'keyword' => 'required|min:1|max:190',
        'metadescription' => 'required|min:3|max:160',
         'category_id' => 'required',
       'description' => 'min:3|required',
        ]);
        try {
            DB::beginTransaction();
     if ($request->hasfile('photo')) {
      $ex =$request->photo->extension();
           $rand = uniqid(CommonFx::make_slug(Str::limit($request->title,30)));
         $name = $rand.".".$ex;
           $waterMarkUrl = storage_path().'/app/files/shares/backend/watermark.png';
               $img=Image::make($request->photo->move(storage_path().'/app/files/shares/blog/', $name,60));
           
               $img->insert($waterMarkUrl, 'bottom-right', 5, 5);
               $img->save();
                 $resizedImage_thumbs = Image::make(storage_path().'/app/files/shares/blog/' . $name)->resize(35, null, function ($constraint) {
                     $constraint->aspectRatio();
                 });
               
                  $resizedImage_thumb = Image::make(storage_path().'/app/files/shares/blog/' . $name)->resize(330, 232);
                  // save file as jpg with medium quality
                  $resizedImage_thumb->save(storage_path() . '/app/files/shares/blog/thumb/'.$name,60);
                   $resizedImage_thumbs->save(storage_path() . '/app/files/shares/blog/thumbs/'.$name, 60);
              }
          else{
           $name =$request->oldphoto;
          };
            $list =  Blog::find($id);
 $schema='
{
  "@context": "https://schema.org",
  "@type": "BlogPosting",
  "mainEntityOfPage": {
    "@type": "WebPage",
    "@id": "https://homeobari.com/info/'. CommonFx::bnslug($request->title) .'"
  },
  "headline": "'. $request->title.'",
  "image": "https://homeobari.com/storage/app/files/shares/blog/'.$name.'",
  "author": {
    "@type": "Person",
    "name": "'. Auth::guard('admin')->user()->name .'"
  },  
  "publisher": {
    "@type": "Organization",
    "name": "person",
    "logo": {
      "@type": "ImageObject",
      "url": "https://homeobari.com/storage/app/files/shares/profileimage/'.Auth::user()->image.'"
    }
  },
  "datePublished":"'.date('Y-m-d', strtotime($list->created_at)) .'",
  "dateModified":"'. date("Y-m-d").'"

}';
     // dd($schema);exit;
        $list->title = $request->title;
        $list->keyword = $request->keyword;
        $list->metadescription= $request->metadescription;
        $list->category_id= $request->category_id;
        $list->schemainfo= $schema;
        $list->description= $request->description;
        $list->slug=CommonFx::bnslug($request->title);
        $list->photo= $name;
        $list->update();
            
        DB::commit();
         $data = [  
            
            'superadminboady' => '<a class="black-text"  href="'. url('/superadmin/editblog/'.$list->id) . '">'.Auth::user()->name .' edit ' .$list->title. '</a>'
  ];

       
       Superadmin::first()->notify(new Superadminnotification($data));
                Toastr::info("Blog Update Successfully", "Well Done");
            return Redirect::to('admin/bloglist'); 
                }
                catch (\Exception $e) {
                    DB::rollBack();
                    Toastr::warning("Blog Create Successfully Fail", "Sorry Done");
                 
                 return Redirect::back(); 
                }
    }


 
    public function destroy($id)
    {
        $delete=Blog::whereadmin_id(Auth::guard('admin')->user()->id)->destroy($id);
        
        if($delete) {
            $data = [
            
            'superadminboady' =>  '<a class="black-text"  href="'. url('/superadmin/restore/'.$delete->id) . '">'.Auth::user()->name .' delete ' .$delete->title. '</a>'
  ];
    
       
           Superadmin::first()->notify(new Superadminnotification($data));
             Toastr::danger("Blog Delete Successfully", "Done");
            return Redirect::to('admin/bloglist'); 
         } else {
              Toastr::warning("Blog Delete Successfully Fail", "Sorry Done");
             return Redirect::to('admin/bloglist'); 
         }
    }

   public function setapproval(Request $request){
        $id =$request->id;
        $roomapproval = Blog::find($id);
        if($request->action=="allow"){
            $roomapproval->status=2;
             $data = [  
            
            'superadminboady' => '<a class="black-text"  href="'. url('/superadmin/editblog/'.$roomapproval->id) . '">'.Auth::user()->name .' Draft  ' .$roomapproval->title. '</a>'
  ];

       
       Superadmin::first()->notify(new Superadminnotification($data));
        }
        if($request->action=="deny"){
            $roomapproval->status=1;
 $data = [  
            
            'superadminboady' => '<a class="black-text"  href="'. url('/superadmin/editblog/'.$roomapproval->id) . '">'.Auth::user()->name .' Publish ' .$roomapproval->title. '</a>'
  ];

       
       Superadmin::first()->notify(new Superadminnotification($data));

        }
            $roomapproval->update();
            if($roomapproval->update()){
                return response()->json(['success' => true, 'message' =>' !']);
            }



    }
    // account active inactive start
   
      public function searchblog(Request $request){
        $output="";
        $searchvalue = Blog::whereadmin_id(Auth::guard('admin')->user()->id)->Where('title','LIKE','%%%'.$request->id."%%%")->orwhere('metadescription','LIKE','%'.$request->id."%")->latest()->take(30)->get();
        if(count($searchvalue))
{
foreach ($searchvalue as $key => $searchval) {
$output.='<tr>'.
'<td>'.$searchval->id.'</td>'.
'<td>'.$searchval->title.'</td>'.
'<td>'.$searchval->metadescription.'</td>'.
'<td>'.$searchval->status.'</td>'.
'<td>'.'<a target="_blank" href="'.url('admin/editblog/'.$searchval->id).'" class="btn-floating mb-1 waves-effect waves-light"> <i class="material-icons">edit</i></a>'.'</td>'.
'</tr>';
}
return Response($output);
   }
   else{
    $output.='<tr>'
    .'<td><h1>Sorry</h1></td>'.
    '<td><h1>NO </h1></td>'.
    '<td><h1>Data</h1></td>'.
    '<td><h1> Found</h1></td>'.
    '<td><h1>Type</h1></td>'.
    '<td><h1> Another</h1></td>'.
    '<td><h1>Info</h1></td>'.
    '</tr>';
    return Response( $output);
    
   }
    }


}
