<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;
 
class ContactController extends Controller
{
    public function store(Request $request){

        $name = $request->name;
        $email = $request->email;
        $message = $request->message;

        $contact = Contact::create([

            'name' => $name,
            'email' => $email,
            'message' => $message,

        ]);

        return 1;
    
    } // End Method


    public function index(){

        $message = Contact::latest()->get();
        return view('backend.contact.contact_all', compact('message'));

    } // End Method


    public function DeleteMessage($id){

        Contact::findOrFail($id)->delete();

         $notification = array(
            'message' => 'Message Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);


    }// End Method



}
 