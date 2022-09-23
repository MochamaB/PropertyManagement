<?php

namespace App\Http\Controllers;

use App\Models\Apartment;
use App\Models\Housecategories;
use App\Models\House;
use Illuminate\Http\Request;

class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $apartments = Apartment:: with('house')->get();
        return view('apartment.index',compact('apartments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('apartment.create');
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
            'name' => 'required',
            'apartmentno' => 'required',
            'logo' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'signature_photo' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ], [
            'name.required' => '* Name cannot be blank!',
            'apartmentno.required' => '* Apartment No cannot be blank!',
            'logo.image' => '* Image type is not supported!',
            'signature_photo.image' => '* Image type is not supported!',

        ]);

        

        if (Apartment::where('apartmentno', $request->get('apartmentno'))->exists()) {
            return redirect('/apartments')->with('statuserror','Apartment is already in the system');
         }
        
        else
        {

            $apartment = new Apartment;
            $apartment->name = $request->input('name');
            $apartment->apartmentno = $request->input('apartmentno');
            $apartment->email = $request->input('email');
            $apartment->postalcode = $request->input('postalcode');
            $apartment->tel = $request->input('tel');
            
            if($request->file('logo')){
                $file= $request->file('logo');
                $filename= date('YmdHi').$file->getClientOriginalName();
                $file-> move(public_path('uploads/Images'), $filename);
                $apartment['logo']= $filename;
            }
            $apartment->location = $request->input('location');
            $apartment->authorized_person = $request->input('authorized_person');

            if($request->file('signature_photo')){
                $file= $request->file('signature_photo');
                $filename= date('YmdHi').$file->getClientOriginalName();
                $file-> move(public_path('uploads/Images'), $filename);
                $apartment['signature_photo']= $filename;
            }

            $apartment->save();
            return redirect('apartments')->with('status','Apartment Added Successfully');
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
        $apartment = Apartment::find($id);
        return view('apartment.edit',compact('apartment'));
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
            'name' => 'required',
            'logo' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'signature_photo' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ], [
            'name.required' => '* Name cannot be blank!',
            'logo.image' => '* Image type is not supported!',
            'signature_photo.image' => '* Image type is not supported!',

        ]);

       

            $apartment = Apartment::find($id);
            $apartment->name = $request->input('name');
            $apartment->email = $request->input('email');
            $apartment->postalcode = $request->input('postalcode');
            $apartment->tel = $request->input('tel');
            
            if($request->file('logo')){
                $file= $request->file('logo');
                $filename= date('YmdHi').$file->getClientOriginalName();
                $file-> move(public_path('uploads/Images'), $filename);
                $apartment['logo']= $filename;
            }
            $apartment->location = $request->input('location');
            $apartment->authorized_person = $request->input('authorized_person');

            if($request->file('signature_photo')){
                $file= $request->file('signature_photo');
                $filename= date('YmdHi').$file->getClientOriginalName();
                $file-> move(public_path('uploads/Images'), $filename);
                $apartment['signature_photo']= $filename;
            }

            
            $apartment->update();
            return redirect('apartments')->with('status','Apartment Edit Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $apartment = Apartment::find($id);
        if(Housecategories::where('apartment_id',$id)->exists()){
            return redirect('apartments')->with('statuserror','Cannot Delete Apartment, Delete All Houses and Categories attached to the apartment'); 
        }
        else{       
            $apartment->delete();
            return redirect('apartments')->with('status','Apartment Deleted Successfully');
                }
    }
}
