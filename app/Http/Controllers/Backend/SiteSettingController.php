<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SiteSettingController extends Controller
{
    public function viewsitesetting()
    {
        $setting=DB::table('sitesettings')->first();
        return view('admin.masters.viewsetting',compact('setting'));
    }

    public function updatesitesetting(Request $request)
    {
        $request->validate([
            'phone_one'=>'required',
            'phone_two'=>'nullable',
            'email'=>'required',
            'company_name'=>'required',
            'company_address'=>'required', //wont update if value is null
            'facebook'=>'nullable',
            'instgram'=>'nullable',
            'twitter'=>'nullable',
            'youtube'=>'nullable',
            'created_by_company_link'=>'required',
            'created_by_company'=>'required',

        ]);
        $id=$request->id;
        $data=[];
        $data['phone_one']=$request->phone_one;
        $data['phone_two']=$request->phone_two;
        $data['email']=$request->email;
        $data['company_name']=$request->company_name;
        $data['company_address']=$request->company_address;
        $data['facebook']=$request->facebook;
        $data['instagram']=$request->instagram;
        $data['twitter']=$request->twitter;
        $data['youtube']=$request->youtube;
        $data['created_by_company_link']=$request->created_by_company_link;
        $data['created_by_company']=$request->created_by_company;
      
       DB::table('sitesettings')->where('id',$id)->update($data);
       return redirect()->back()->with('success','Website Settings Updated Successfully');
    }
}
