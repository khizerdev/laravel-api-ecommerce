<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;

class SettingController extends Controller
{
    public function getSetting(){

        $setting = Setting::first();
        return $setting;

    } // End Method



    public function index(){

        $setting = Setting::first();
        return view('backend.siteinfo.siteinfo_update',compact('setting'));

    } // End Method



    public function update(Request $request){

        $setting = Setting::first();

        Setting::findOrFail($setting)->update([
            'logo' => $request->logo,
            'sticky_logo' => $request->sticky_logo,
            'email' => $request->email,
            'address' => $request->address,
            'github' => $request->github,
            'linkedin' => $request->linkedin,
            'phone' => $request->phone,
            'footer_text' => $request->footer_text,
            'copy_right' => $request->copy_right,
            'about' => $request->about,

        ]);

        return back()->with('success' , 'Site Setting Updated');

    } // End Method





}
  