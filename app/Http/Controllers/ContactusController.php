<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class ContactusController extends Controller
{
    public function store(Request $request){
        $request->validate([
            'fullname'=>'bail|required|min:3|max:25',
            'email'=>'required',
            'phonenumber'=>'bail|required|max:15',
            'message'=>'bail|required|max:200'

        ]);

        Contact::create([
            'fullname'=>$request->fullname,
            'email'=>$request->email,
            'phonenumber'=>$request->phonenumber,
            'message'=>$request->message

        ]);
        return redirect()->back()->with('success','Thank you for your message. We will get back to you shortly');
    }



    public function viewallmessage(){
        $contact= Contact::all();
        return view('admin.masters.contactus.viewallmessage',compact('contact'));
    }
}
