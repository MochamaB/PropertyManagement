<?php

namespace App\Http\Controllers;

use App\Models\Apartment;
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
            'email' => 'required'
        ], [
            'name.required' => '* Name cannot be blank!',
            'apartmentno.required' => '* Apartment No cannot be blank!',

        ]);

        

        if (Apartment::where('apartmentno', $request->get('name'))->exists()) {
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
            $apartment->logo = $request->input('logo');
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
        return view('apartment.edit');
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
        //
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
