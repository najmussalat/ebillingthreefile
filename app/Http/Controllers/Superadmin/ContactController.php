<?php

namespace App\Http\Controllers\Superadmin;
use App\Models\Contact;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Kamaln7\Toastr\Facades\Toastr;
use App\Mail\ContactMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Contact=Contact::wherestatus(2)->latest()->get();
        $pageConfigs = ['bodyCustomClass' => 'app-page'];
        return view('superadmin.contact.index', ['pageConfigs' => $pageConfigs],['contactus'=>$Contact]);
        // return view('pages.app-email', ['pageConfigs' => $pageConfigs]);
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
    public function store(Request $request)
    {
        $this->validate($request,[
            'subject' => 'required|min:3|max:192',
             'email' => 'required',
            'reply' => 'required|min:3|max:5000',
           
            ]);
        
        $list = Contact::find($request->id);
    $list->reply = $request->reply;
    $list->status = 1;
    $list->save();
   
         $data= array(
             'subject'=> $request->subject,
            'name'=> $list['name'],
            'email'=> $request->email,
            'message'=> $request->reply,
             );
        // dd($data['subject']);
          Mail::to($request->email)->send(new ContactMail($data));
          Toastr::success("Email Send  Successfully", "Well Done");
          return Redirect::to('superadmin/emaillist');
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
        $Contact=Contact::find($id);
        $pageConfigs = ['bodyCustomClass' => 'app-page'];
        return view('superadmin.contact.reply', ['pageConfigs' => $pageConfigs],['contactinfo'=>$Contact]);
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
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
