<?php

namespace App\Http\Controllers;

use App\Models\Systemsettings;
use Illuminate\Http\Request;


class SystemsettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $settings = Systemsettings::first();
        return view('settings/index',compact('settings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('settings/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'systemname' => 'required',
            'companyname' => 'required',
            'logo' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'flavicon' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ], [
            'systemname.required' => '* Name cannot be blank!',
            'companyname.required' => '* company No cannot be blank!',
            'logo.image' => '* Image type is not supported!',
            'flavicon.image' => '* Image type is not supported!',

        ]);

            $systemsettings = new systemsettings;
            $systemsettings->systemname = $request->input('systemname');
            $systemsettings->companyname = $request->input('companyname');
            $systemsettings->email = $request->input('email');
            $systemsettings->postal_code = $request->input('postal_code');
            $systemsettings->phonenumber = $request->input('phonenumber');
            
            if($request->file('logo')){
                $file= $request->file('logo');
                $filename= date('YmdHi').$file->getClientOriginalName();
                $file-> move(base_path('uploads/Images'), $filename);
                $systemsettings['logo']= $filename;
            }
            $systemsettings->location = $request->input('location');

            if($request->file('flavicon')){
                $file= $request->file('flavicon');
                $filename= date('YmdHi').$file->getClientOriginalName();
                $file-> move(base_path('uploads/Images'), $filename);
                $systemsettings['flavicon']= $filename;
            }

            $systemsettings->save();
            return redirect('settings')->with('status','Settings Added Successfully');
        
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
        $settings = Systemsettings::find($id);
        return view('settings.edit',compact('settings'));
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
        $validatedData = $request->validate([
            'systemname' => 'required',
            'companyname' => 'required',
            'logo' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'flavicon' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ], [
            'systemname.required' => '* Name cannot be blank!',
            'companyname.required' => '* Apartment No cannot be blank!',
            'logo.image' => '* Image type is not supported!',
            'flavicon.image' => '* Image type is not supported!',

        ]);

            $systemsettings = Systemsettings::find($id);
            $systemsettings->systemname = $request->input('systemname');
            $systemsettings->companyname = $request->input('companyname');
            $systemsettings->email = $request->input('email');
            $systemsettings->postal_code = $request->input('postal_code');
            $systemsettings->phonenumber = $request->input('phonenumber');
            
            if($request->file('logo')){
                $file= $request->file('logo');
                $filename= date('YmdHi').$file->getClientOriginalName();
                $file-> move(base_path('uploads/Images'), $filename);
                $systemsettings['logo']= $filename;
            }
            $systemsettings->location = $request->input('location');

            if($request->file('flavicon')){
                $file= $request->file('flavicon');
                $filename= date('YmdHi').$file->getClientOriginalName();
                $file-> move(base_path('uploads/Images'), $filename);
                $systemsettings['flavicon']= $filename;
            }

            $systemsettings->update();
            return redirect('settings')->with('status','Settings Updated Successfully');
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
