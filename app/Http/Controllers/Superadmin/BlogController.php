<?php

namespace App\Http\Controllers\superadmin;
use App\Models\Blog;
use App\Helpers\CommonFx;
use App\Models\Medicine;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Kamaln7\Toastr\Facades\Toastr;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Intervention\Image\ImageManagerStatic as Image;
//use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Redirect;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blog=Blog::with('category','admin')->latest()->paginate(10);
        return view('superadmin.blog.index')->with('blogs',$blog)->with('i', (request()->input('page', 1) - 1) * 10);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $breadcrumbs = [
            ['link' => "superadmin", 'name' => "Home"], ['link' => "superadmin/bloglist", 'name' => "Blog"], ['name' => "Create"],
        ];
        //Pageheader set true for breadcrumbs
        $category=Category::pluck('category','id');
        $tag=Category::pluck('category','category');
        $pageConfigs = ['pageHeader' => true, 'isFabButton' => false];
        
        return view('superadmin.blog.create', ['pageConfigs' => $pageConfigs], ['breadcrumbs' => $breadcrumbs])->with('categories',$category)->with('tags',$tag);
    }


    
        public function store(Request $request)
        {
                 
    //return response(dd($request));exit;
    
      $this->validate($request,[
        'title' => 'required|min:30|max:190|unique:blogs',
        'keyword' => 'required|min:3|max:190',
        'metadescription' => 'required|min:3|max:160',
         'category_id' => 'required',
       'description' => 'min:3|required',
        ]);

            try {
                DB::beginTransaction();
                if ($request->hasfile('photo')) {
        
      
                     $rand = uniqid(CommonFx::make_slug(Str::limit($request->title,30)));
         $name = $rand.".webp";
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
                $userinfo =Blog::create(array(
                'title' => $request->title,
                 'slug' =>CommonFx::bnslug($request->title),
                'keyword' => $request->keyword,
                'photo' => $name,
                'category_id' => $request->category_id,
                'metadescription' => $request->metadescription,
                 'tag' => json_encode($request->tag, JSON_FORCE_OBJECT),
                 'admin_id' => 1,
                'description' => $request->description,
                    ));
             DB::commit();
            
                    Toastr::success("Blog Create Successfully", "Well Done");
                return Redirect::to('superadmin/bloglist'); 
                    }
                    catch (\Exception $e) {
                        DB::rollBack();
                        Toastr::warning("Blog Create Successfully Fail", "Sorry Done");
                       return Redirect::to('superadmin/bloglist'); 
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
            ['link' => "superadmin", 'name' => "Home"], ['link' => "superadmin/bloglist", 'name' => "Blog"], ['name' => "Edit"],
        ];
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true, 'isFabButton' => false];
        $category=Category::pluck('category','id');
       $blogid =Blog::with('category')->find($id);
       $tag=Category::pluck('category','category');
       return view('superadmin.blog.edit', ['pageConfigs' => $pageConfigs], ['breadcrumbs' => $breadcrumbs])->with('categories',$category)->with('blogid',$blogid)->with('tags',$tag);
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
        'title' => 'required|min:3|max:190|unique:blogs,title,'.$id,
        'keyword' => 'required|min:3|max:190',
        'metadescription' => 'required|min:3|max:160',
         'category_id' => 'required',
       'description' => 'min:3|required',
        ]);
        try {
            DB::beginTransaction();
     if ($request->hasfile('photo')) {
    
  
               $rand = uniqid(CommonFx::make_slug(Str::limit($request->title,60)));
         $name = $rand.".".$request->photo->extension();
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
        $list->title = $request->title;
        $list->keyword = $request->keyword;
        $list->metadescription= $request->metadescription;
        $list->category_id= $request->category_id;
        $list->description= $request->description;
        $list->photo= $name;
        $list->update();
            
        DB::commit();
        
                Toastr::info("Blog Update Successfully", "Done");
            return Redirect::to('superadmin/bloglist'); 
                }
                catch (\Exception $e) {
                    DB::rollBack();
                    Toastr::warning("Blog Create Successfully Fail", "Sorry Done");
                  return Redirect::to('superadmin/bloglist'); 
                }
    }


 
    public function destroy($id)
    {
        $delete=Blog::forceDeleted($id);
        
        if($delete) {
           
             Toastr::danger("Blog Delete Successfully", "Done");
            return Redirect::to('superadmin/bloglist'); 
         } else {
              Toastr::warning("Blog Delete Successfully Fail", "Sorry Done");
             return Redirect::to('superadmin/bloglist'); 
         }
    }

   public function setapproval(Request $request){
        $id =$request->id;
        $roomapproval = Blog::find($id);
        if($request->action=="allow"){
            $roomapproval->status=2;
        }
        if($request->action=="deny"){
            $roomapproval->status=1;


        }
            $roomapproval->update();
            if($roomapproval->update()){
              
                return response()->json(['success' => true, 'message' =>' !']);
            }



    }
    // account active inactive start
   
      public function searchblog(Request $request){
        $output="";
        $searchvalue = Blog::Where('title','LIKE','%%%'.$request->id."%%%")->orwhere('metadescription','LIKE','%'.$request->id."%")->latest()->take(30)->get();
        if(count($searchvalue))
{
foreach ($searchvalue as $key => $searchval) {
$output.='<tr>'.
'<td>'.$searchval->id.'</td>'.
'<td>'.$searchval->title.'</td>'.
'<td>'.$searchval->metadescription.'</td>'.
'<td>'.$searchval->status.'</td>'.
'<td>'.'<a target="_blank" href="'.url('superadmin/editblog/'.$searchval->id).'" class="btn-floating mb-1 waves-effect waves-light"> <i class="material-icons">edit</i></a>'.'</td>'.
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
